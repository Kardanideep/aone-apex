@extends('layouts.admin')

@section('title', 'Purchase Requests | AONE APEX')

@section('content')

<!-- Header -->
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="font-serif text-2xl text-slate-800 font-bold mb-1">Purchase Requests</h1>
        <p class="text-slate-500 text-sm">Manage user package purchase requests and verify payment proofs.</p>
    </div>
    
    <!-- Filter Tabs -->
    <div class="flex items-center gap-1.5 bg-slate-100 p-1 rounded-xl border border-slate-200 self-start">
        <a href="{{ route('admin.purchases.index') }}" class="px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-all {{ !$status ? 'bg-white text-slate-800 shadow-sm' : 'text-slate-500 hover:text-slate-800' }}">
            All
        </a>
        <a href="{{ route('admin.purchases.index', ['status' => 'pending']) }}" class="px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-all {{ $status === 'pending' ? 'bg-white text-amber-600 shadow-sm' : 'text-slate-500 hover:text-slate-800' }}">
            Pending
        </a>
        <a href="{{ route('admin.purchases.index', ['status' => 'completed']) }}" class="px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-all {{ $status === 'completed' ? 'bg-white text-emerald-600 shadow-sm' : 'text-slate-500 hover:text-slate-800' }}">
            Completed
        </a>
        <a href="{{ route('admin.purchases.index', ['status' => 'failed']) }}" class="px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-all {{ $status === 'failed' ? 'bg-white text-rose-600 shadow-sm' : 'text-slate-500 hover:text-slate-800' }}">
            Failed
        </a>
    </div>
</div>

@if(session('success'))
    <div class="mb-5 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 p-4 rounded-xl text-sm">
        <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="mb-5 flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl text-sm">
        <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        {{ session('error') }}
    </div>
@endif

<!-- Table Card -->
<div class="admin-card rounded-xl overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
        <h2 class="font-semibold text-slate-700 text-sm">Purchase Submissions</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Info</th>
                    <th>Package Details</th>
                    <th>INR (95.57)</th>
                    <th>Transaction ID / UTR</th>
                    <th class="text-center">Status</th>
                    <th>Submitted At</th>
                    <th class="text-center pr-6">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($purchases as $purchase)
                <tr>
                    <td>
                        <span class="font-mono text-violet-500 font-bold text-xs">#{{ $purchase->id }}</span>
                    </td>
                    <td>
                        <div class="flex flex-col">
                            <span class="font-semibold text-slate-800 text-sm leading-tight">{{ $purchase->user->name ?? 'N/A' }}</span>
                            <span class="text-xs text-slate-400 font-mono">{{ $purchase->user->user_id ?? 'N/A' }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="flex flex-col">
                            <span class="font-semibold text-slate-800 text-sm leading-tight">{{ $purchase->package->name ?? 'N/A' }}</span>
                            <span class="text-xs text-brand-pink font-bold">${{ number_format($purchase->amount, 2) }}</span>
                        </div>
                    </td>
                    <td>
                        <span class="font-semibold text-slate-700 text-sm font-serif">₹{{ number_format($purchase->amount * 95.57, 2) }}</span>
                    </td>
                    <td>
                        <span class="font-mono text-slate-600 bg-slate-100 px-2 py-0.5 rounded text-xs border border-slate-200">{{ $purchase->transaction_id ?? 'N/A' }}</span>
                    </td>
                    <td class="text-center">
                        @if($purchase->status === 'completed')
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Approved
                            </span>
                        @elseif($purchase->status === 'pending')
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Pending Approval
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-red-50 text-red-700 border border-red-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Rejected
                            </span>
                        @endif
                    </td>
                    <td>
                        <span class="text-slate-500 text-sm">{{ $purchase->created_at->format('M d, Y H:i') }}</span>
                    </td>
                    <td class="text-center pr-6">
                        <a href="{{ route('admin.purchases.show', $purchase->id) }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-slate-100 hover:bg-violet-50 text-slate-700 hover:text-violet-700 rounded-xl text-xs font-semibold transition-all border border-slate-200 hover:border-violet-200 shadow-sm">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Verify Proof
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-slate-400 py-10">
                        No purchase requests found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($purchases->hasPages())
        <div class="px-6 py-4 border-t border-slate-100">
            {{ $purchases->links() }}
        </div>
    @endif
</div>

@endsection
