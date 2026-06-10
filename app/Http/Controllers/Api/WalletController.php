<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserWallet;
use App\Models\UserWalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    /**
     * Get user's wallet balance.
     */
    public function balance()
    {
        $user = Auth::user();

        $wallet = UserWallet::firstOrCreate(
            ['user_id' => $user->id],
            ['balance' => 0, 'total_earned' => 0, 'total_withdrawn' => 0]
        );

        return response()->json([
            'success' => true,
            'data' => [
                'balance' => $wallet->balance,
                'total_earned' => $wallet->total_earned,
                'total_withdrawn' => $wallet->total_withdrawn,
            ]
        ]);
    }

    /**
     * Get user's transaction history.
     */
    public function transactions(Request $request)
    {
        $user = Auth::user();

        $query = UserWalletTransaction::where('user_id', $user->id);

        // Filter by source
        if ($request->filled('source')) {
            $query->where('source', $request->source);
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $transactions = $query->latest()->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $transactions
        ]);
    }

    /**
     * Submit a withdrawal request.
     */
    public function withdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10',
            'account_holder_name' => 'required|string|max:150',
            'bank_name' => 'required|string|max:150',
            'account_number' => 'required|string|max:50',
            'ifsc_code' => 'required|string|max:20',
        ]);

        $user = Auth::user();
        $amount = $request->amount;

        $wallet = UserWallet::where('user_id', $user->id)->first();

        if (!$wallet || $wallet->balance < $amount) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient balance.',
            ], 422);
        }

        // Check for existing pending withdrawal
        $pendingWithdrawal = UserWalletTransaction::where('user_id', $user->id)
            ->where('source', 'withdrawal')
            ->where('status', 'pending')
            ->exists();

        if ($pendingWithdrawal) {
            return response()->json([
                'success' => false,
                'message' => 'You already have a pending withdrawal request. Please wait for it to be processed.',
            ], 422);
        }

        DB::transaction(function () use ($user, $wallet, $amount, $request) {
            // Deduct from wallet balance
            $wallet->decrement('balance', $amount);
            $wallet->increment('total_withdrawn', $amount);

            // Create pending withdrawal transaction with bank details
            UserWalletTransaction::create([
                'user_id' => $user->id,
                'type' => 'debit',
                'source' => 'withdrawal',
                'amount' => $amount,
                'description' => 'Withdrawal request of $' . number_format($amount, 2),
                'account_holder_name' => $request->account_holder_name,
                'bank_name' => $request->bank_name,
                'account_number' => $request->account_number,
                'ifsc_code' => $request->ifsc_code,
                'status' => 'pending',
            ]);
        });

        return response()->json([
            'success' => true,
            'message' => 'Withdrawal request submitted successfully. It will be reviewed by admin.',
        ]);
    }
}
