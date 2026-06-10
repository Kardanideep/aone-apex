@extends('layouts.admin')

@section('title', 'System Wallet | AONE APEX Admin')

@section('content')

<!-- Header -->
<div class="mb-6">
    <h1 class="font-serif text-2xl text-slate-800 font-bold mb-1">System Wallet</h1>
    <p class="text-slate-500 text-sm">Track total platform revenue from package purchases.</p>
</div>

<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="admin-card stat-card-blue p-4 rounded-xl">
        <div class="flex items-start justify-between">
            <div>
                <div class="text-slate-500 text-[10px] font-semibold uppercase tracking-widest mb-1">System Balance</div>
                <div class="text-2xl font-serif font-bold text-slate-800">${{ number_format($systemBalance, 2) }}</div>
                <div class="text-xs text-slate-400 mt-1">Net balance</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-500 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
            </div>
        </div>
    </div>

    <div class="admin-card stat-card-cyan p-4 rounded-xl">
        <div class="flex items-start justify-between">
            <div>
                <div class="text-slate-500 text-[10px] font-semibold uppercase tracking-widest mb-1">Total Revenue</div>
                <div class="text-2xl font-serif font-bold text-slate-800">${{ number_format($totalRevenue, 2) }}</div>
                <div class="text-xs text-slate-400 mt-1">All time credits</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-500 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
    </div>

    <div class="admin-card stat-card-pink p-4 rounded-xl">
        <div class="flex items-start justify-between">
            <div>
                <div class="text-slate-500 text-[10px] font-semibold uppercase tracking-widest mb-1">Completed Purchases</div>
                <div class="text-2xl font-serif font-bold text-slate-800">{{ number_format($totalPurchases) }}</div>
                <div class="text-xs text-slate-400 mt-1">Successful transactions</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-pink-50 flex items-center justify-center text-pink-500 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
    </div>

    <div class="admin-card stat-card-amber p-4 rounded-xl">
        <div class="flex items-start justify-between">
            <div>
                <div class="text-slate-500 text-[10px] font-semibold uppercase tracking-widest mb-1">Pending</div>
                <div class="text-2xl font-serif font-bold text-slate-800">{{ number_format($pendingPurchases) }}</div>
                <div class="text-xs text-slate-400 mt-1">Awaiting completion</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center text-amber-500 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
    </div>
</div>

<!-- Recent Transactions -->
<div class="admin-card rounded-xl overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
        <div>
            <h2 class="text-sm font-bold text-slate-800">Recent System Transactions</h2>
            <p class="text-xs text-slate-400">All credits and debits to the system wallet</p>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentTransactions as $txn)
                <tr>
                    <td class="font-mono text-xs text-slate-400">{{ $txn->id }}</td>
                    <td>
                        @if($txn->user)
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full bg-gradient-to-br from-violet-500 to-pink-400 flex items-center justify-center text-white text-xs font-bold">
                                    {{ substr($txn->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="text-sm text-slate-700 font-medium">{{ $txn->user->name }}</div>
                                    <div class="text-xs text-slate-400">{{ $txn->user->user_id }}</div>
                                </div>
                            </div>
                        @else
                            <span class="text-slate-400 text-xs">System</span>
                        @endif
                    </td>
                    <td>
                        @if($txn->type === 'credit')
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-600 border border-emerald-200">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                                Credit
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-600 border border-red-200">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                                Debit
                            </span>
                        @endif
                    </td>
                    <td class="font-semibold {{ $txn->type === 'credit' ? 'text-emerald-600' : 'text-red-500' }}">
                        {{ $txn->type === 'credit' ? '+' : '-' }}${{ number_format($txn->amount, 2) }}
                    </td>
                    <td class="text-slate-500 text-xs">{{ $txn->description ?? '—' }}</td>
                    <td class="text-slate-400 text-xs">{{ $txn->created_at->format('M d, Y h:i A') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-12">
                        <svg class="w-10 h-10 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                        <p class="text-slate-400 text-sm">No transactions yet.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($recentTransactions->hasPages())
    <div class="px-6 py-4 border-t border-slate-100">
        {{ $recentTransactions->links() }}
    </div>
    @endif
</div>

@endsection
