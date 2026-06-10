<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\SystemWalletTransaction;
use App\Models\User;
use App\Models\UserWallet;
use App\Models\UserWalletTransaction;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * System Wallet — total revenue + recent purchases.
     */
    public function systemWallet()
    {
        $totalRevenue = SystemWalletTransaction::where('type', 'credit')->sum('amount');
        $totalDebit = SystemWalletTransaction::where('type', 'debit')->sum('amount');
        $systemBalance = $totalRevenue - $totalDebit;
        $totalPurchases = Purchase::where('status', 'completed')->count();
        $pendingPurchases = Purchase::where('status', 'pending')->count();

        $recentTransactions = SystemWalletTransaction::with('user')
            ->latest()
            ->paginate(20);

        return view('admin.wallets.system', compact(
            'totalRevenue',
            'totalDebit',
            'systemBalance',
            'totalPurchases',
            'pendingPurchases',
            'recentTransactions'
        ));
    }

    /**
     * User Wallets — list all user wallets with balances.
     */
    public function userWallets(Request $request)
    {
        $query = UserWallet::with('user');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('user_id', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $wallets = $query->latest()->paginate(20);

        $totalUserBalance = UserWallet::sum('balance');
        $totalUserEarned = UserWallet::sum('total_earned');
        $totalUserWithdrawn = UserWallet::sum('total_withdrawn');

        return view('admin.wallets.users', compact(
            'wallets',
            'totalUserBalance',
            'totalUserEarned',
            'totalUserWithdrawn'
        ));
    }

    /**
     * User Wallet Detail — single user transaction history.
     */
    public function userWalletDetail(User $user)
    {
        $wallet = $user->wallet;

        if (!$wallet) {
            // Auto-create wallet if it doesn't exist
            $wallet = UserWallet::create([
                'user_id' => $user->id,
                'balance' => 0,
                'total_earned' => 0,
                'total_withdrawn' => 0,
            ]);
        }

        $transactions = UserWalletTransaction::where('user_id', $user->id)
            ->latest()
            ->paginate(20);

        return view('admin.wallets.user-detail', compact('user', 'wallet', 'transactions'));
    }

    /**
     * Withdrawals — list all withdrawal requests.
     */
    public function withdrawals(Request $request)
    {
        $query = UserWalletTransaction::with('user')
            ->where('source', 'withdrawal')
            ->where('type', 'debit');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $withdrawals = $query->latest()->paginate(20);

        $pendingCount = UserWalletTransaction::where('source', 'withdrawal')
            ->where('status', 'pending')->count();
        $completedCount = UserWalletTransaction::where('source', 'withdrawal')
            ->where('status', 'completed')->count();
        $rejectedCount = UserWalletTransaction::where('source', 'withdrawal')
            ->where('status', 'rejected')->count();

        return view('admin.wallets.withdrawals', compact(
            'withdrawals',
            'pendingCount',
            'completedCount',
            'rejectedCount'
        ));
    }

    /**
     * Approve a withdrawal request.
     */
    public function approveWithdrawal(UserWalletTransaction $transaction)
    {
        if ($transaction->source !== 'withdrawal' || $transaction->status !== 'pending') {
            return redirect()->back()->with('error', 'Invalid withdrawal request.');
        }

        $transaction->update(['status' => 'completed']);

        return redirect()->back()->with('success', 'Withdrawal approved successfully.');
    }

    /**
     * Reject a withdrawal request — refund balance.
     */
    public function rejectWithdrawal(UserWalletTransaction $transaction)
    {
        if ($transaction->source !== 'withdrawal' || $transaction->status !== 'pending') {
            return redirect()->back()->with('error', 'Invalid withdrawal request.');
        }

        $transaction->update(['status' => 'rejected']);

        // Refund the user's wallet
        $wallet = UserWallet::where('user_id', $transaction->user_id)->first();
        if ($wallet) {
            $wallet->increment('balance', $transaction->amount);
            $wallet->decrement('total_withdrawn', $transaction->amount);
        }

        return redirect()->back()->with('success', 'Withdrawal rejected and amount refunded to user wallet.');
    }
}
