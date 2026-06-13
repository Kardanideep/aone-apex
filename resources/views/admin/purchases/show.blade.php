@extends('layouts.admin')

@section('title', 'Verify Purchase Request | AONE APEX')

@section('content')

<!-- Header & Navigation back -->
<div class="mb-6">
    <a href="{{ route('admin.purchases.index') }}" class="inline-flex items-center gap-1.5 text-slate-500 hover:text-slate-800 text-sm font-semibold transition-colors mb-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Back to Requests
    </a>
    <h1 class="font-serif text-2xl text-slate-800 font-bold">Verify Purchase Proof</h1>
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

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left Column: Details -->
    <div class="lg:col-span-2 space-y-6">
        
        <!-- Submission details -->
        <div class="admin-card p-6 space-y-6">
            <h2 class="font-serif text-lg text-slate-800 font-bold border-b border-slate-100 pb-3 flex items-center gap-2">
                <svg class="w-5 h-5 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Purchase Info
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Package details -->
                <div>
                    <span class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Package / Tier</span>
                    <span class="font-semibold text-slate-800 text-base">{{ $purchase->package->name ?? 'N/A' }}</span>
                </div>

                <!-- Status badge -->
                <div>
                    <span class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Current Status</span>
                    @if($purchase->status === 'completed')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Approved / Active
                        </span>
                    @elseif($purchase->status === 'pending')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Pending Review
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-red-50 text-red-700 border border-red-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Rejected / Failed
                        </span>
                    @endif
                </div>

                <!-- USD Amount -->
                <div>
                    <span class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Amount (USD)</span>
                    <span class="font-mono font-bold text-slate-800 text-lg">${{ number_format($purchase->amount, 2) }}</span>
                </div>

                <!-- INR Amount -->
                <div>
                    <span class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Calculated Amount (INR @ 95.57)</span>
                    <span class="font-mono font-bold text-emerald-600 text-lg">₹{{ number_format($purchase->amount * 95.57, 2) }}</span>
                </div>

                <!-- UTR / Transaction ID -->
                <div>
                    <span class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Transaction ID / UTR</span>
                    <div class="flex items-center gap-2">
                        <span class="font-mono text-slate-700 bg-slate-100 px-2.5 py-1 rounded border border-slate-200 text-sm font-semibold select-all">{{ $purchase->transaction_id ?? 'N/A' }}</span>
                    </div>
                </div>

                <!-- Submitted Date -->
                <div>
                    <span class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Submitted Date</span>
                    <span class="text-slate-600 text-sm">{{ $purchase->created_at->format('F d, Y - H:i:s') }}</span>
                </div>
            </div>
        </div>

        <!-- Payment Proof Screen Shot -->
        <div class="admin-card p-6">
            <h2 class="font-serif text-lg text-slate-800 font-bold border-b border-slate-100 pb-3 mb-5 flex items-center justify-between">
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Screenshot Proof
                </span>
                @if($purchase->screenshot)
                    <a href="{{ Storage::url($purchase->screenshot) }}" target="_blank" class="text-xs text-violet-600 hover:text-violet-800 font-semibold flex items-center gap-1">
                        Open in New Tab
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                @endif
            </h2>

            @if($purchase->screenshot)
                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-4 flex justify-center items-center overflow-hidden max-h-[500px]">
                    <img src="{{ Storage::url($purchase->screenshot) }}" alt="Receipt Screenshot" class="max-w-full max-h-[460px] object-contain rounded-lg shadow-sm hover:scale-[1.01] transition-transform duration-200 cursor-zoom-in" onclick="window.open(this.src, '_blank')">
                </div>
            @else
                <div class="bg-slate-50 border border-slate-200 border-dashed rounded-2xl p-8 text-center text-slate-400">
                    No screenshot uploaded.
                </div>
            @endif
        </div>
    </div>

    <!-- Right Column: User Info & Actions -->
    <div class="space-y-6">
        
        <!-- User card -->
        <div class="admin-card p-6 space-y-4">
            <h2 class="font-serif text-lg text-slate-800 font-bold border-b border-slate-100 pb-3 flex items-center gap-2">
                <svg class="w-5 h-5 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                Investor Profile
            </h2>
            
            <div class="flex items-center gap-3 py-2">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-violet-500 to-pink-400 flex items-center justify-center text-white font-serif text-lg font-bold shadow-sm">
                    {{ substr($purchase->user->name ?? 'U', 0, 1) }}
                </div>
                <div>
                    <span class="font-semibold text-slate-800 text-sm block leading-tight">{{ $purchase->user->name ?? 'N/A' }}</span>
                    <span class="text-xs text-slate-400 font-mono">{{ $purchase->user->user_id ?? 'N/A' }}</span>
                </div>
            </div>

            <div class="space-y-3 pt-2 text-sm text-slate-600 border-t border-slate-50">
                <div>
                    <span class="block text-xs text-slate-400 font-semibold uppercase tracking-wider">Email</span>
                    <span>{{ $purchase->user->email ?? 'N/A' }}</span>
                </div>
                <div>
                    <span class="block text-xs text-slate-400 font-semibold uppercase tracking-wider">Mobile</span>
                    <span>{{ $purchase->user->mobile ?? 'N/A' }}</span>
                </div>
                <div>
                    <span class="block text-xs text-slate-400 font-semibold uppercase tracking-wider">Account Status</span>
                    @if($purchase->user->status === 'active')
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-600">
                            Active
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-slate-500">
                            {{ ucfirst($purchase->user->status ?? 'Inactive') }}
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sponsor Details -->
        <div class="admin-card p-6 space-y-4">
            <h2 class="font-serif text-lg text-slate-800 font-bold border-b border-slate-100 pb-3 flex items-center gap-2">
                <svg class="w-5 h-5 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                Referral / Sponsor
            </h2>
            
            <div class="text-sm space-y-3">
                <div>
                    <span class="block text-xs text-slate-400 font-semibold uppercase tracking-wider">Sponsor Designated for Purchase</span>
                    @if($purchase->sponsor)
                        <div class="flex flex-col mt-1 bg-violet-50/50 border border-violet-100 rounded-xl p-3">
                            <span class="font-semibold text-slate-800 text-sm">{{ $purchase->sponsor->name }}</span>
                            <span class="text-xs text-slate-500 font-mono">ID: {{ $purchase->sponsor->user_id }}</span>
                        </div>
                    @else
                        <span class="text-slate-400 text-xs italic mt-1 block">No sponsor designated for this transaction. System direct bonus distribution will default to the profile sponsor: {{ $purchase->user->sponsor->name ?? 'No Sponsor' }} (ID: {{ $purchase->user->sponsor->user_id ?? 'None' }})</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Verification Actions -->
        @if($purchase->status === 'pending')
        <div class="admin-card p-6 space-y-4 bg-slate-50 border-violet-200">
            <h2 class="font-serif text-lg text-slate-800 font-bold border-b border-slate-200 pb-3 flex items-center gap-2">
                <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                Actions Required
            </h2>
            
            <p class="text-xs text-slate-500 leading-relaxed">Please review the transaction UTR and payment receipt carefully. Approving will immediately activate their package plan, credit daily ROI, and distribute direct and level commissions.</p>
            
            <div class="space-y-2.5 pt-2">
                <!-- Approve Action Form -->
                <form action="{{ route('admin.purchases.approve', $purchase->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to APPROVE this payment? This will activate the package and distribute commissions.');">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl py-3 text-sm font-semibold tracking-wide shadow-sm hover:shadow transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Approve & Activate Plan
                    </button>
                </form>

                <!-- Reject Action Form -->
                <form action="{{ route('admin.purchases.reject', $purchase->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to REJECT this payment proof?');">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 rounded-xl py-2.5 text-sm font-semibold tracking-wide transition-all">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        Reject Submission
                    </button>
                </form>
            </div>
        </div>
        @else
        <div class="admin-card p-6 bg-slate-50 border-slate-200">
            <h2 class="font-serif text-sm text-slate-400 uppercase tracking-widest font-bold border-b border-slate-200 pb-2 mb-3">Verification Details</h2>
            <p class="text-xs text-slate-500 leading-relaxed">This request was processed on {{ $purchase->updated_at->format('M d, Y H:i:s') }}. No further actions can be performed on processed requests.</p>
        </div>
        @endif
    </div>
</div>

@endsection
