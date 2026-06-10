@extends('layouts.admin')

@section('title', '{{ $user->name }} Wallet | AONE APEX Admin')

@section('content')

<!-- Header -->
<div class="mb-6">
    <div class="flex items-center gap-2 text-sm text-slate-400 mb-3">
        <a href="{{ route('admin.wallets.users') }}" class="hover:text-violet-600 transition-colors">User Wallets</a>
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-slate-600">{{ $user->name }}</span>
    </div>
    <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-violet-500 to-pink-400 flex items-center justify-center text-white text-lg font-bold shadow-md">
            {{ substr($user->name, 0, 1) }}
        </div>
        <div>
            <h1 class="font-serif text-2xl text-slate-800 font-bold">{{ $user->name }}</h1>
            <p class="text-slate-500 text-sm">{{ $user->user_id }} · {{ $user->email }}</p>
        </div>
    </div>
</div>

<!-- Wallet Stats -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
    <div class="admin-card stat-card-blue p-5 rounded-xl">
        <div class="text-slate-500 text-xs font-semibold uppercase tracking-widest mb-2">Available Balance</div>
        <div class="text-3xl font-serif font-bold text-slate-800">${{ number_format($wallet->balance, 2) }}</div>
    </div>
    <div class="admin-card stat-card-cyan p-5 rounded-xl">
        <div class="text-slate-500 text-xs font-semibold uppercase tracking-widest mb-2">Total Earned</div>
        <div class="text-3xl font-serif font-bold text-emerald-600">${{ number_format($wallet->total_earned, 2) }}</div>
    </div>
    <div class="admin-card stat-card-pink p-5 rounded-xl">
        <div class="text-slate-500 text-xs font-semibold uppercase tracking-widest mb-2">Total Withdrawn</div>
        <div class="text-3xl font-serif font-bold text-pink-600">${{ number_format($wallet->total_withdrawn, 2) }}</div>
    </div>
</div>

<!-- Transactions -->
<div class="admin-card rounded-xl overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100">
        <h2 class="text-sm font-bold text-slate-800">Transaction History</h2>
        <p class="text-xs text-slate-400">All income credits and withdrawal debits</p>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>Source</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $txn)
                <tr>
                    <td class="font-mono text-xs text-slate-400">{{ $txn->id }}</td>
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
                    <td>
                        @php
                            $sourceLabels = [
                                'direct_income' => ['Direct Income', 'bg-violet-50 text-violet-600 border-violet-200'],
                                'salary_income' => ['Salary Income', 'bg-blue-50 text-blue-600 border-blue-200'],
                                'level_income' => ['Level Income', 'bg-cyan-50 text-cyan-600 border-cyan-200'],
                                'withdrawal' => ['Withdrawal', 'bg-pink-50 text-pink-600 border-pink-200'],
                                'bonus' => ['Bonus', 'bg-amber-50 text-amber-600 border-amber-200'],
                            ];
                            $label = $sourceLabels[$txn->source] ?? [$txn->source, 'bg-slate-50 text-slate-600 border-slate-200'];
                        @endphp
                        <span class="inline-flex px-2 py-1 rounded-full text-xs font-semibold border {{ $label[1] }}">{{ $label[0] }}</span>
                    </td>
                    <td class="font-semibold {{ $txn->type === 'credit' ? 'text-emerald-600' : 'text-red-500' }}">
                        {{ $txn->type === 'credit' ? '+' : '-' }}${{ number_format($txn->amount, 2) }}
                    </td>
                    <td class="text-slate-500 text-xs">{{ $txn->description ?? '—' }}</td>
                    <td>
                        @if($txn->status === 'completed')
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-600 border border-emerald-200">Completed</span>
                        @elseif($txn->status === 'pending')
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-600 border border-amber-200">Pending</span>
                        @else
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-600 border border-red-200">Rejected</span>
                        @endif
                    </td>
                    <td class="text-slate-400 text-xs">{{ $txn->created_at->format('M d, Y h:i A') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-12">
                        <svg class="w-10 h-10 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        <p class="text-slate-400 text-sm">No transactions for this user yet.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($transactions->hasPages())
    <div class="px-6 py-4 border-t border-slate-100">
        {{ $transactions->links() }}
    </div>
    @endif
</div>

@endsection
