<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Package;
use App\Models\User;
use App\Http\Controllers\Api\PurchaseController;

class StripeController extends Controller
{
    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');

        if (!$sessionId) {
            return redirect()->route('home')->with('error', 'Invalid session ID.');
        }

        try {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $session = \Stripe\Checkout\Session::retrieve($sessionId);

            if ($session->payment_status !== 'paid') {
                return redirect()->route('packages')->with('error', 'Payment not completed.');
            }

            // Check if already processed
            $existingPurchase = Purchase::where('stripe_session_id', $sessionId)->first();
            if ($existingPurchase) {
                return redirect()->route('profile')->with('success', 'Payment already processed successfully.');
            }

            $userId = $session->metadata->user_id ?? null;
            $packageId = $session->metadata->package_id ?? null;
            $sponsorId = $session->metadata->sponsor_id ?? null;

            if (!$userId || !$packageId) {
                return redirect()->route('packages')->with('error', 'Invalid session metadata.');
            }

            $user = User::find($userId);
            $package = Package::find($packageId);

            if (!$user || !$package) {
                return redirect()->route('packages')->with('error', 'User or package not found.');
            }

            // Execute purchase and commissions
            $purchaseController = new PurchaseController();
            $success = $purchaseController->executePurchaseAndCommissions($user, $package, $sponsorId, $sessionId);

            if ($success) {
                return redirect()->route('profile')->with('success', 'Package purchased successfully!');
            } else {
                return redirect()->route('profile')->with('error', 'Error recording purchase. Please contact support.');
            }

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Stripe Success Error: ' . $e->getMessage());
            return redirect()->route('packages')->with('error', 'Something went wrong while verifying your payment.');
        }
    }

    public function cancel(Request $request)
    {
        return redirect()->route('packages')->with('error', 'Payment was cancelled.');
    }
}
