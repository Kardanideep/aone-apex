<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Purchase;
use App\Models\SystemWalletTransaction;
use App\Models\User;
use App\Models\UserWallet;
use App\Models\UserWalletTransaction;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Create a Stripe Checkout Session for package purchase.
     */
    public function checkout(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'referral_code' => 'nullable|string'
        ]);

        $user = Auth::user();

        // Ensure user is active
        if ($user->status !== 'active') {
            return response()->json([
                'success' => false,
                'message' => 'Your account must be active to purchase packages.'
            ], 403);
        }

        $package = Package::find($request->package_id);

        if (!$package || !$package->status) {
            return response()->json([
                'success' => false,
                'message' => 'Package is not available.'
            ], 404);
        }

        // Validate Referral Code if provided
        $sponsorId = null;
        if ($request->filled('referral_code')) {
            $sponsor = User::where('user_id', $request->referral_code)->first();
            if (!$sponsor) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid referral code.'
                ], 400);
            }
            if ($sponsor->id === $user->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'You cannot use your own referral code.'
                ], 400);
            }
            $sponsorId = $sponsor->id;
        }

        try {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'AONE APEX - ' . ($package->name ?? 'Tier'),
                            'description' => 'Investment Package Purchase',
                        ],
                        'unit_amount' => $package->amount * 100, // Amount in cents
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('stripe.cancel'),
                'metadata' => [
                    'user_id' => $user->id,
                    'package_id' => $package->id,
                    'sponsor_id' => $sponsorId,
                ],
            ]);

            return response()->json([
                'success' => true,
                'url' => $session->url
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error communicating with payment gateway.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Handle package purchase and direct income distribution after payment.
     */
    public function executePurchaseAndCommissions($user, $package, $sponsorId, $stripeSessionId)
    {
        try {
            DB::beginTransaction();

            // Handle Sponsor
            $sponsor = null;
            if ($sponsorId) {
                $sponsor = User::find($sponsorId);
                if ($sponsor) {
                    $user->update(['sponsor_id' => $sponsor->id]);
                }
            } else if ($user->sponsor_id) {
                $sponsor = User::find($user->sponsor_id);
            }

            // 1. Record the Purchase
            $purchase = Purchase::create([
                'user_id' => $user->id,
                'package_id' => $package->id,
                'amount' => $package->amount,
                'status' => 'completed',
                'stripe_session_id' => $stripeSessionId,
            ]);

            // 2. System Wallet Entry (Revenue)
            SystemWalletTransaction::create([
                'type' => 'credit',
                'amount' => $package->amount,
                'source' => 'package_purchase',
                'reference_id' => $purchase->id,
                'description' => "Package purchase by {$user->name} ({$user->user_id})"
            ]);

            // 3. Direct Income Distribution
            if ($sponsor) {
                // Get direct commission percentage from settings
                $setting = Setting::where('key', 'direct_commission_percent')->first();
                $percent = $setting ? (float) $setting->value : 0;
                
                if ($percent > 0) {
                    $commissionAmount = ($package->amount * $percent) / 100;

                    // Ensure sponsor has a wallet
                    $sponsorWallet = UserWallet::firstOrCreate(
                        ['user_id' => $sponsor->id],
                        ['balance' => 0, 'total_earned' => 0, 'total_withdrawn' => 0]
                    );

                    // Credit sponsor wallet
                    $sponsorWallet->increment('balance', $commissionAmount);
                    $sponsorWallet->increment('total_earned', $commissionAmount);

                    // Record transaction
                    UserWalletTransaction::create([
                        'user_id' => $sponsor->id,
                        'type' => 'credit',
                        'amount' => $commissionAmount,
                        'source' => 'direct_income',
                        'status' => 'completed',
                        'reference_id' => $purchase->id,
                        'description' => "Direct income from {$user->name} ({$user->user_id}) package purchase"
                    ]);
                }
            }

            // 4. Generation Level Income Distribution
            $currentUpline = $sponsor;
            $level = 1;
            $maxLevels = 5;

            while ($currentUpline && $level <= $maxLevels) {
                $settingKey = "level_{$level}_percent";
                $levelSetting = Setting::where('key', $settingKey)->first();
                $levelPercent = $levelSetting ? (float) $levelSetting->value : 0;

                if ($levelPercent > 0) {
                    $levelCommissionAmount = ($package->amount * $levelPercent) / 100;

                    $uplineWallet = UserWallet::firstOrCreate(
                        ['user_id' => $currentUpline->id],
                        ['balance' => 0, 'total_earned' => 0, 'total_withdrawn' => 0]
                    );

                    $uplineWallet->increment('balance', $levelCommissionAmount);
                    $uplineWallet->increment('total_earned', $levelCommissionAmount);

                    UserWalletTransaction::create([
                        'user_id' => $currentUpline->id,
                        'type' => 'credit',
                        'amount' => $levelCommissionAmount,
                        'source' => 'level_income',
                        'status' => 'completed',
                        'reference_id' => $purchase->id,
                        'description' => "Level {$level} income from {$user->name} ({$user->user_id}) package purchase"
                    ]);
                }

                // Move to the next upline
                if ($currentUpline->sponsor_id) {
                    $currentUpline = User::find($currentUpline->sponsor_id);
                } else {
                    $currentUpline = null;
                }
                
                $level++;
            }

            DB::commit();

            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            \Illuminate\Support\Facades\Log::error('Purchase Execution Error: ' . $e->getMessage());
            return false;
        }
    }
}
