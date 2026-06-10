@extends('layouts.admin')

@section('title', 'User Wallets | AONE APEX Admin')

@section('content')

<!-- Header -->
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="font-serif text-2xl text-slate-800 font-bold mb-1">User Wallets</h1>
        <p class="text-slate-500 text-sm">View all user wallet balances and income summaries.</p>
    </div>
</div>

<!-- Summary Stats -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="admin-card stat-card-blue p-4 rounded-xl">
        <div class="flex items-start justify-between">
            <div>
                <div class="text-slate-500 text-[10px] font-semibold uppercase tracking-widest mb-1">Total User Balance</div>
                <div class="text-2xl font-serif font-bold text-slate-800">${{ number_format($totalUserBalance, 2) }}</div>
                <div class="text-xs text-slate-400 mt-1">Combined available balance</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-500 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
            </div>
        </div>
    </div>

    <div class="admin-card stat-card-cyan p-4 rounded-xl">
        <div class="flex items-start justify-between">
            <div>
                <div class="text-slate-500 text-[10px] font-semibold uppercase tracking-widest mb-1">Total Earned</div>
                <div class="text-2xl font-serif font-bold text-slate-800">${{ number_format($totalUserEarned, 2) }}</div>
                <div class="text-xs text-slate-400 mt-1">Lifetime user earnings</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-500 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            </div>
        </div>
    </div>

    <div class="admin-card stat-card-pink p-4 rounded-xl">
        <div class="flex items-start justify-between">
            <div>
                <div class="text-slate-500 text-[10px] font-semibold uppercase tracking-widest mb-1">Total Withdrawn</div>
                <div class="text-2xl font-serif font-bold text-slate-800">${{ number_format($totalUserWithdrawn, 2) }}</div>
                <div class="text-xs text-slate-400 mt-1">Lifetime withdrawals</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-pink-50 flex items-center justify-center text-pink-500 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
        </div>
    </div>
</div>

<!-- Search -->
<div class="mb-5">
    <form method="GET" action="{{ route('admin.wallets.users') }}" class="flex gap-3 max-w-md">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, user ID, or email..."
            class="flex-1 px-4 py-2.5 border border-slate-200 rounded-xl bg-white text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 transition-all">
        <button type="submit" class="px-5 py-2.5 bg-violet-600 hover:bg-violet-700 text-white text-sm font-semibold rounded-xl transition-colors">Search</button>
    </form>
</div>

<!-- Wallets Table -->
<div class="admin-card rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full admin-table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>User ID</th>
                    <th class="text-left">Balance</th>
                    <th class="text-left">Total Earned</th>
                    <th class="text-left">Total Withdrawn</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($wallets as $wallet)
                <tr>
                    <td>
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-violet-500 to-pink-400 flex items-center justify-center text-white text-xs font-bold">
                                {{ substr($wallet->user->name ?? '?', 0, 1) }}
                            </div>
                            <div>
                                <div class="text-sm text-slate-700 font-medium">{{ $wallet->user->name ?? 'Unknown' }}</div>
                                <div class="text-xs text-slate-400">{{ $wallet->user->email ?? '' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="font-mono text-xs text-slate-500">{{ $wallet->user->user_id ?? '—' }}</td>
                    <td class="text-left font-semibold text-slate-800">${{ number_format($wallet->balance, 2) }}</td>
                    <td class="text-left text-emerald-600 font-medium">${{ number_format($wallet->total_earned, 2) }}</td>
                    <td class="text-left text-pink-600 font-medium">${{ number_format($wallet->total_withdrawn, 2) }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.wallets.user-detail', $wallet->user_id) }}"
                            class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-violet-600 bg-violet-50 hover:bg-violet-100 border border-violet-200 rounded-lg transition-all">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            View
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-12">
                        <svg class="w-10 h-10 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                        <p class="text-slate-400 text-sm">No user wallets found.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($wallets->hasPages())
    <div class="px-6 py-4 border-t border-slate-100">
        {{ $wallets->links() }}
    </div>
    @endif
</div>

@endsection
