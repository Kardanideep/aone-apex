@extends('layouts.app')

@section('title', 'My Dashboard | AONE APEX ALLIANCE')

@section('head')
<style>
    /* Dashboard-specific styles */
    .dash-tab-btn {
        position: relative;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: rgba(156, 163, 175, 1);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        border: 1px solid transparent;
        background: transparent;
        width: 100%;
        text-align: left;
    }
    .dash-tab-btn:hover {
        color: #fff;
        background: rgba(255,255,255,0.04);
    }
    .dash-tab-btn.active {
        color: #fff;
        background: linear-gradient(135deg, rgba(107,70,193,0.15), rgba(213,63,140,0.1));
        border-color: rgba(107,70,193,0.3);
        box-shadow: 0 0 20px rgba(107,70,193,0.08);
    }
    .dash-tab-btn.active .tab-icon {
        color: #D53F8C;
    }
    .dash-tab-btn .tab-indicator {
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%) scaleY(0);
        width: 3px;
        height: 60%;
        border-radius: 0 4px 4px 0;
        background: linear-gradient(180deg, #D53F8C, #6B46C1);
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .dash-tab-btn.active .tab-indicator {
        transform: translateY(-50%) scaleY(1);
    }

    .tab-panel {
        display: none;
        animation: fadeSlideIn 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .tab-panel.active {
        display: block;
    }

    @keyframes fadeSlideIn {
        from { opacity: 0; transform: translateY(12px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .glass-card {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.07);
        border-radius: 1rem;
        backdrop-filter: blur(12px);
        transition: all 0.3s ease;
    }
    .glass-card:hover {
        border-color: rgba(255,255,255,0.12);
        background: rgba(255,255,255,0.05);
    }

    .stat-card {
        position: relative;
        overflow: hidden;
        border-radius: 1.25rem;
        padding: 1.5rem;
        border: 1px solid rgba(255,255,255,0.08);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .stat-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -30%;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        filter: blur(40px);
        opacity: 0.4;
        transition: opacity 0.4s ease;
    }
    .stat-card:hover::before { opacity: 0.6; }
    .stat-card:hover { transform: translateY(-2px); border-color: rgba(255,255,255,0.15); }

    .stat-card.purple { background: linear-gradient(135deg, rgba(107,70,193,0.12), rgba(107,70,193,0.03)); }
    .stat-card.purple::before { background: rgba(107,70,193,0.5); }
    .stat-card.green { background: linear-gradient(135deg, rgba(16,185,129,0.12), rgba(16,185,129,0.03)); }
    .stat-card.green::before { background: rgba(16,185,129,0.5); }
    .stat-card.pink { background: linear-gradient(135deg, rgba(213,63,140,0.12), rgba(213,63,140,0.03)); }
    .stat-card.pink::before { background: rgba(213,63,140,0.5); }
    .stat-card.gold { background: linear-gradient(135deg, rgba(212,175,55,0.12), rgba(212,175,55,0.03)); }
    .stat-card.gold::before { background: rgba(212,175,55,0.5); }

    .data-table { width: 100%; border-collapse: collapse; }
    .data-table thead th {
        padding: 0.875rem 1.25rem;
        font-size: 0.65rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: rgba(156,163,175,0.7);
        text-align: left;
        border-bottom: 1px solid rgba(255,255,255,0.06);
        background: rgba(255,255,255,0.02);
    }
    .data-table tbody td {
        padding: 1rem 1.25rem;
        font-size: 0.875rem;
        border-bottom: 1px solid rgba(255,255,255,0.04);
        color: rgba(209,213,219,1);
    }
    .data-table tbody tr { transition: background 0.2s ease; }
    .data-table tbody tr:hover { background: rgba(255,255,255,0.03); }

    .copy-toast {
        position: fixed;
        bottom: 2rem;
        left: 50%;
        transform: translateX(-50%) translateY(100px);
        background: rgba(16,185,129,0.9);
        color: #fff;
        padding: 0.75rem 1.5rem;
        border-radius: 0.75rem;
        font-size: 0.875rem;
        font-weight: 500;
        z-index: 999;
        opacity: 0;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        backdrop-filter: blur(8px);
    }
    .copy-toast.show {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
    }

    /* Mobile tab bar */
    .mobile-tab-bar {
        display: none;
        overflow-x: auto;
        gap: 0.5rem;
        padding: 0 1rem;
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .mobile-tab-bar::-webkit-scrollbar { display: none; }
    .mobile-tab-btn {
        flex-shrink: 0;
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        font-size: 0.75rem;
        font-weight: 600;
        color: rgba(156,163,175,1);
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.06);
        transition: all 0.3s ease;
        white-space: nowrap;
        cursor: pointer;
    }
    .mobile-tab-btn.active {
        color: #fff;
        background: linear-gradient(135deg, rgba(107,70,193,0.3), rgba(213,63,140,0.2));
        border-color: rgba(107,70,193,0.4);
    }

    @media (max-width: 1023px) {
        .mobile-tab-bar { display: flex; }
        .desktop-sidebar { display: none !important; }
    }

    /* Custom scrollbar for tables */
    .custom-scroll::-webkit-scrollbar { width: 4px; }
    .custom-scroll::-webkit-scrollbar-track { background: transparent; }
    .custom-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 4px; }
    .custom-scroll::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.2); }
</style>
@endsection

@section('content')
<section class="min-h-screen pt-24 pb-20 relative overflow-hidden">

    <!-- Background orbs -->
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-brand-purple/6 rounded-full blur-[200px] pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-brand-pink/4 rounded-full blur-[150px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10 relative z-10">

        {{-- ===== TOP HEADER BAR ===== --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-brand-pink to-brand-purple p-[2px] shadow-lg shadow-brand-purple/20">
                    <div class="w-full h-full rounded-2xl bg-[#0a0015] flex items-center justify-center text-xl text-white font-serif select-none">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                </div>
                <div>
                    <h1 class="text-xl font-serif text-white leading-tight">{{ $user->name }}</h1>
                    <div class="flex items-center gap-2 mt-0.5">
                        <span class="text-xs text-gray-500 font-mono">{{ $user->user_id }}</span>
                        <span class="text-gray-700">·</span>
                        @if($user->status === 'active')
                            <span class="inline-flex items-center gap-1.5 text-[10px] uppercase tracking-widest text-emerald-400 font-semibold">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>Active
                            </span>
                        @elseif($user->status === 'pending')
                            <span class="inline-flex items-center gap-1.5 text-[10px] uppercase tracking-widest text-amber-400 font-semibold">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>Pending
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 text-[10px] uppercase tracking-widest text-red-400 font-semibold">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>Blocked
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('packages') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 hover:bg-white/8 text-gray-300 hover:text-white text-xs font-medium transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    Buy Package
                </a>
            
            </div>
        </div>

        {{-- ===== KYC ALERT BANNER (if not approved) ===== --}}
        @if(!$user->kyc)
        <div class="mb-6 glass-card p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-amber-500/20 bg-amber-500/5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-amber-500/15 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <div>
                    <div class="text-sm text-white font-medium">Complete KYC Verification</div>
                    <div class="text-xs text-gray-400">Submit your documents to activate your account and unlock all features.</div>
                </div>
            </div>
            <button onclick="switchTab('kyc')" class="flex-shrink-0 px-5 py-2 rounded-lg text-xs font-semibold uppercase tracking-wider text-white transition-all hover:shadow-lg hover:shadow-amber-500/20" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                Verify Now
            </button>
        </div>
        @elseif($user->kyc && $user->kyc->status === 'pending')
        <div class="mb-6 glass-card p-4 flex items-center gap-3 border-blue-500/20 bg-blue-500/5">
            <div class="w-10 h-10 rounded-xl bg-blue-500/15 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-blue-400 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <div class="text-sm text-white font-medium">KYC Under Review</div>
                <div class="text-xs text-gray-400">Your documents are being verified. Typically takes 24-48 hours.</div>
            </div>
        </div>
        @elseif($user->kyc && $user->kyc->status === 'rejected')
        <div class="mb-6 glass-card p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-red-500/20 bg-red-500/5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-red-500/15 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                </div>
                <div>
                    <div class="text-sm text-white font-medium">KYC Verification Rejected</div>
                    <div class="text-xs text-gray-400">Your documents could not be verified. Please resubmit clear and valid documents.</div>
                </div>
            </div>
            <button onclick="switchTab('kyc')" class="flex-shrink-0 px-5 py-2 rounded-lg text-xs font-semibold uppercase tracking-wider text-white bg-red-500 hover:bg-red-600 transition-all">
                Resubmit
            </button>
        </div>
        @endif

        {{-- ===== MOBILE TAB BAR ===== --}}
        <div class="mobile-tab-bar mb-6">
            <button class="mobile-tab-btn active" onclick="switchTab('dashboard')">Dashboard</button>
            <button class="mobile-tab-btn" onclick="switchTab('profile')">Profile</button>
            <button class="mobile-tab-btn" onclick="switchTab('packages')">Packages</button>
            <button class="mobile-tab-btn" onclick="switchTab('transactions')">Transactions</button>
            <button class="mobile-tab-btn" onclick="switchTab('withdraw')">Withdraw</button>
            <button class="mobile-tab-btn" onclick="switchTab('network')">Network</button>
            @if(!$user->kyc || ($user->kyc && $user->kyc->status === 'rejected'))
            <button class="mobile-tab-btn" onclick="switchTab('kyc')">KYC</button>
            @endif
        </div>

        {{-- ===== MAIN LAYOUT: SIDEBAR + CONTENT ===== --}}
        <div class="flex gap-8">

            {{-- Desktop Sidebar --}}
            <aside class="desktop-sidebar w-[220px] flex-shrink-0 hidden lg:block">
                <div class="sticky top-28 space-y-1.5">
                    <button class="dash-tab-btn active" onclick="switchTab('dashboard')">
                        <span class="tab-indicator"></span>
                        <svg class="w-[18px] h-[18px] tab-icon transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zM14 12a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1h-4a1 1 0 01-1-1v-7z"/></svg>
                        Dashboard
                    </button>
                    <button class="dash-tab-btn" onclick="switchTab('profile')">
                        <span class="tab-indicator"></span>
                        <svg class="w-[18px] h-[18px] tab-icon transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        My Profile
                    </button>
                    <button class="dash-tab-btn" onclick="switchTab('packages')">
                        <span class="tab-indicator"></span>
                        <svg class="w-[18px] h-[18px] tab-icon transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        Packages
                    </button>
                    <button class="dash-tab-btn" onclick="switchTab('transactions')">
                        <span class="tab-indicator"></span>
                        <svg class="w-[18px] h-[18px] tab-icon transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z"/></svg>
                        Transactions
                    </button>
                    <button class="dash-tab-btn" onclick="switchTab('withdraw')">
                        <span class="tab-indicator"></span>
                        <svg class="w-[18px] h-[18px] tab-icon transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        Withdraw
                    </button>
                    <button class="dash-tab-btn" onclick="switchTab('network')">
                        <span class="tab-indicator"></span>
                        <svg class="w-[18px] h-[18px] tab-icon transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        Network
                    </button>

                    @if(!$user->kyc || ($user->kyc && $user->kyc->status === 'rejected'))
                    <div class="pt-3 mt-3 border-t border-white/5">
                        <button class="dash-tab-btn" onclick="switchTab('kyc')">
                            <span class="tab-indicator"></span>
                            <svg class="w-[18px] h-[18px] tab-icon transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            KYC Verification
                        </button>
                    </div>
                    @endif

                    {{-- Quick links --}}
                    <div class="pt-4 mt-4 border-t border-white/5 space-y-1">
                        <a href="{{ route('password.change') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs text-gray-500 hover:text-gray-300 transition-colors rounded-lg hover:bg-white/[0.03]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            Change Password
                        </a>
                        <a href="{{ route('business-plan') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs text-gray-500 hover:text-gray-300 transition-colors rounded-lg hover:bg-white/[0.03]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            Income Plan
                        </a>
                    </div>
                </div>
            </aside>

            {{-- Content Area --}}
            <div class="flex-1 min-w-0">

                {{-- ==================== DASHBOARD TAB ==================== --}}
                <div id="tab-dashboard" class="tab-panel active">

                    {{-- Wallet Stats --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                        <div class="stat-card purple">
                            <div class="relative z-10">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-[10px] uppercase tracking-[0.15em] font-semibold text-brand-purple">Balance</span>
                                    <div class="w-8 h-8 rounded-lg bg-brand-purple/15 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-brand-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                    </div>
                                </div>
                                <div class="font-serif text-2xl text-white font-bold">${{ number_format($user->wallet->balance ?? 0, 2) }}</div>
                            </div>
                        </div>
                        <div class="stat-card green">
                            <div class="relative z-10">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-[10px] uppercase tracking-[0.15em] font-semibold text-emerald-400">Earned</span>
                                    <div class="w-8 h-8 rounded-lg bg-emerald-500/15 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                                    </div>
                                </div>
                                <div class="font-serif text-2xl text-white font-bold">${{ number_format($user->wallet->total_earned ?? 0, 2) }}</div>
                            </div>
                        </div>
                        <div class="stat-card pink">
                            <div class="relative z-10">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-[10px] uppercase tracking-[0.15em] font-semibold text-brand-pink">Withdrawn</span>
                                    <div class="w-8 h-8 rounded-lg bg-brand-pink/15 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                    </div>
                                </div>
                                <div class="font-serif text-2xl text-white font-bold">${{ number_format($user->wallet->total_withdrawn ?? 0, 2) }}</div>
                            </div>
                        </div>
                        <div class="stat-card gold">
                            <div class="relative z-10">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-[10px] uppercase tracking-[0.15em] font-semibold text-yellow-400">Referrals</span>
                                    <div class="w-8 h-8 rounded-lg bg-yellow-500/15 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                    </div>
                                </div>
                                <div class="font-serif text-2xl text-white font-bold">{{ $user->nestedChildren->count() }}</div>
                            </div>
                        </div>
                    </div>

                    {{-- Referral Link Card --}}
                    <div class="glass-card p-5 mb-8">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-brand-purple/15 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-brand-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                </div>
                                <div>
                                    <div class="text-xs text-gray-500 uppercase tracking-widest font-medium mb-1">Your Referral Link</div>
                                    <div class="text-sm text-gray-300 font-mono truncate max-w-md select-all">{{ url('/register?ref=' . $user->user_id) }}</div>
                                </div>
                            </div>
                            <button onclick="copyToClipboard('{{ url('/register?ref=' . $user->user_id) }}')" class="flex-shrink-0 flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs font-semibold uppercase tracking-wider text-white transition-all hover:shadow-lg hover:shadow-brand-purple/20 hover:-translate-y-0.5" style="background: linear-gradient(135deg, #6B46C1, #D53F8C);">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                Copy Link
                            </button>
                        </div>
                    </div>

                    {{-- Quick Action Grid --}}
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                        <button onclick="switchTab('profile')" class="glass-card p-5 text-left group cursor-pointer">
                            <div class="w-10 h-10 rounded-xl bg-brand-purple/10 flex items-center justify-center mb-3 group-hover:bg-brand-purple/20 transition-colors">
                                <svg class="w-5 h-5 text-brand-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                            <div class="text-sm text-white font-medium mb-0.5">My Profile</div>
                            <div class="text-xs text-gray-500">View & edit details</div>
                        </button>
                        <button onclick="switchTab('packages')" class="glass-card p-5 text-left group cursor-pointer">
                            <div class="w-10 h-10 rounded-xl bg-emerald-500/10 flex items-center justify-center mb-3 group-hover:bg-emerald-500/20 transition-colors">
                                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            </div>
                            <div class="text-sm text-white font-medium mb-0.5">My Packages</div>
                            <div class="text-xs text-gray-500">{{ $user->purchases->count() }} purchased</div>
                        </button>
                        <button onclick="switchTab('transactions')" class="glass-card p-5 text-left group cursor-pointer">
                            <div class="w-10 h-10 rounded-xl bg-brand-pink/10 flex items-center justify-center mb-3 group-hover:bg-brand-pink/20 transition-colors">
                                <svg class="w-5 h-5 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z"/></svg>
                            </div>
                            <div class="text-sm text-white font-medium mb-0.5">Transactions</div>
                            <div class="text-xs text-gray-500">Recent activity</div>
                        </button>
                        <button onclick="switchTab('network')" class="glass-card p-5 text-left group cursor-pointer">
                            <div class="w-10 h-10 rounded-xl bg-yellow-500/10 flex items-center justify-center mb-3 group-hover:bg-yellow-500/20 transition-colors">
                                <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            </div>
                            <div class="text-sm text-white font-medium mb-0.5">My Network</div>
                            <div class="text-xs text-gray-500">{{ $user->nestedChildren->count() }} referrals</div>
                        </button>
                    </div>
                </div>

                {{-- ==================== PROFILE TAB ==================== --}}
                <div id="tab-profile" class="tab-panel">

                    {{-- View Mode --}}
                    <div id="profileViewMode">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h2 class="font-serif text-2xl text-white mb-1">Personal Information</h2>
                                <p class="text-gray-500 text-sm">Your account details and sponsor information.</p>
                            </div>
                            <button onclick="toggleEditMode()" class="flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white/5 border border-white/10 hover:bg-brand-purple/15 hover:border-brand-purple/30 text-gray-300 hover:text-white text-sm font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                Edit
                            </button>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            {{-- Personal Details --}}
                            <div class="glass-card p-6">
                                <h3 class="text-xs uppercase tracking-[0.15em] font-semibold text-brand-purple mb-5">Account Details</h3>
                                <div class="space-y-5">
                                    <div>
                                        <div class="text-[10px] text-gray-500 uppercase tracking-widest mb-1">Full Name</div>
                                        <div class="text-white text-[15px]" id="viewName">{{ $user->name }}</div>
                                    </div>
                                    <div>
                                        <div class="text-[10px] text-gray-500 uppercase tracking-widest mb-1">Email Address</div>
                                        <div class="text-white text-[15px]">{{ $user->email }}</div>
                                    </div>
                                    <div>
                                        <div class="text-[10px] text-gray-500 uppercase tracking-widest mb-1">Phone Number</div>
                                        <div class="text-white text-[15px]" id="viewPhone">{{ $user->mobile ?? 'Not provided' }}</div>
                                    </div>
                                    <div>
                                        <div class="text-[10px] text-gray-500 uppercase tracking-widest mb-1">Member Since</div>
                                        <div class="text-white text-[15px]">{{ $user->created_at->format('F j, Y') }}</div>
                                    </div>
                                </div>
                            </div>

                            {{-- Network Info --}}
                            <div class="glass-card p-6">
                                <h3 class="text-xs uppercase tracking-[0.15em] font-semibold text-brand-pink mb-5">Network Info</h3>
                                <div class="space-y-5">
                                    <div>
                                        <div class="text-[10px] text-gray-500 uppercase tracking-widest mb-1">Your Referral ID</div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-mono text-lg text-brand-purple font-bold tracking-wider">{{ $user->user_id }}</span>
                                            <button onclick="copyToClipboard('{{ $user->user_id }}')" class="p-1.5 rounded-md bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white transition-colors" title="Copy">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-[10px] text-gray-500 uppercase tracking-widest mb-1">Sponsored By</div>
                                        @if($user->sponsor)
                                            <div class="text-white text-[15px]">{{ $user->sponsor->name }} <span class="text-gray-500 text-sm">({{ $user->sponsor->user_id }})</span></div>
                                        @else
                                            <div class="text-gray-500 text-sm italic">Direct Signup (No Sponsor)</div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="text-[10px] text-gray-500 uppercase tracking-widest mb-1">Direct Referrals</div>
                                        <div class="text-white text-[15px] font-semibold">{{ $user->nestedChildren->count() }} members</div>
                                    </div>
                                    <div>
                                        <div class="text-[10px] text-gray-500 uppercase tracking-widest mb-1">KYC Status</div>
                                        @if(!$user->kyc)
                                            <span class="inline-flex items-center gap-1.5 text-xs font-medium text-gray-400"><span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span>Not Submitted</span>
                                        @elseif($user->kyc->status === 'approved')
                                            <span class="inline-flex items-center gap-1.5 text-xs font-medium text-emerald-400"><span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>Verified</span>
                                        @elseif($user->kyc->status === 'pending')
                                            <span class="inline-flex items-center gap-1.5 text-xs font-medium text-blue-400"><span class="w-1.5 h-1.5 rounded-full bg-blue-400 animate-pulse"></span>Under Review</span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 text-xs font-medium text-red-400"><span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>Rejected</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Edit Mode --}}
                    <div id="profileEditMode" class="hidden">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h2 class="font-serif text-2xl text-white mb-1">Edit Profile</h2>
                                <p class="text-gray-500 text-sm">Update your personal information below.</p>
                            </div>
                            <button onclick="toggleEditMode()" class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 text-gray-300 hover:text-white text-sm font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                                Cancel
                            </button>
                        </div>

                        <form id="profileEditForm" class="glass-card p-8 space-y-8">
                            @csrf
                            <div id="profileFormMsg" class="hidden rounded-xl p-4 text-sm text-center"></div>

                            <div>
                                <label for="name" class="block text-[10px] font-semibold text-gray-500 uppercase tracking-widest mb-3">Full Name</label>
                                <input type="text" id="name" name="name" value="{{ $user->name }}" required
                                    class="w-full bg-transparent border-0 border-b border-white/15 pb-3 text-white text-base focus:outline-none focus:border-brand-pink transition-colors duration-300">
                            </div>

                            <div class="grid sm:grid-cols-2 gap-8">
                                <div>
                                    <label for="email" class="block text-[10px] font-semibold text-gray-500 uppercase tracking-widest mb-3">Email (Cannot be changed)</label>
                                    <input type="email" id="email" name="email" value="{{ $user->email }}" readonly
                                        class="w-full bg-transparent border-0 border-b border-white/5 pb-3 text-gray-500 text-base cursor-not-allowed">
                                </div>
                                <div>
                                    <label for="phone" class="block text-[10px] font-semibold text-gray-500 uppercase tracking-widest mb-3">Phone Number</label>
                                    <input type="tel" id="phone" name="phone" value="{{ $user->mobile }}"
                                        class="w-full bg-transparent border-0 border-b border-white/15 pb-3 text-white text-base focus:outline-none focus:border-brand-pink transition-colors duration-300">
                                </div>
                            </div>

                            <div class="flex items-center gap-4 pt-4">
                                <button type="submit" id="profileSubmitBtn"
                                    class="px-8 py-3 rounded-xl text-sm uppercase tracking-widest font-semibold text-white transition-all hover:shadow-lg hover:shadow-brand-purple/20 hover:-translate-y-0.5"
                                    style="background: linear-gradient(135deg, #6B46C1, #D53F8C);">
                                    <span id="profileBtnText">Save Changes</span>
                                    <span id="profileBtnLoader" class="hidden">
                                        <svg class="animate-spin h-5 w-5 mx-auto text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                    </span>
                                </button>
                                <button type="button" onclick="toggleEditMode()" class="text-sm text-gray-400 hover:text-white transition-colors">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- ==================== PACKAGES TAB ==================== --}}
                <div id="tab-packages" class="tab-panel">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h2 class="font-serif text-2xl text-white mb-1">My Packages</h2>
                            <p class="text-gray-500 text-sm">Your purchased investment packages.</p>
                        </div>
                        <a href="{{ route('packages') }}" class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs font-semibold uppercase tracking-wider text-white transition-all hover:shadow-lg hover:shadow-brand-purple/20 hover:-translate-y-0.5" style="background: linear-gradient(135deg, #6B46C1, #D53F8C);">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                            Buy Package
                        </a>
                    </div>

                    @if($user->purchases->count() > 0)
                    <div class="glass-card overflow-hidden">
                        <div class="overflow-x-auto custom-scroll">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Package</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Purchase Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->purchases as $purchase)
                                    <tr>
                                        <td>
                                            <div class="flex items-center gap-3">
                                                <div class="w-9 h-9 rounded-xl bg-brand-purple/15 flex items-center justify-center flex-shrink-0">
                                                    <svg class="w-4 h-4 text-brand-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                                </div>
                                                <span class="font-medium text-white">{{ $purchase->package->name ?? 'Package' }}</span>
                                            </div>
                                        </td>
                                        <td class="font-semibold text-white">₹{{ number_format($purchase->amount, 2) }}</td>
                                        <td>
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-semibold uppercase tracking-wider bg-emerald-500/15 text-emerald-400 border border-emerald-500/20">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>{{ $purchase->status }}
                                            </span>
                                        </td>
                                        <td class="text-gray-400">{{ $purchase->created_at->format('M d, Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @else
                    <div class="glass-card p-16 text-center">
                        <div class="w-16 h-16 rounded-2xl bg-brand-purple/10 flex items-center justify-center mx-auto mb-5">
                            <svg class="w-8 h-8 text-brand-purple/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </div>
                        <h3 class="text-lg text-white font-medium mb-2">No Packages Yet</h3>
                        <p class="text-gray-500 text-sm mb-6 max-w-sm mx-auto">Start your investment journey by purchasing a package.</p>
                        <a href="{{ route('packages') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-semibold text-white transition-all hover:shadow-lg hover:shadow-brand-purple/20" style="background: linear-gradient(135deg, #6B46C1, #D53F8C);">
                            Browse Packages
                        </a>
                    </div>
                    @endif
                </div>

                {{-- ==================== TRANSACTIONS TAB ==================== --}}
                <div id="tab-transactions" class="tab-panel">
                    <div class="mb-8">
                        <h2 class="font-serif text-2xl text-white mb-1">Transaction History</h2>
                        <p class="text-gray-500 text-sm">Your recent wallet transactions and income history.</p>
                    </div>

                    @if($user->walletTransactions->count() > 0)
                    <div class="glass-card overflow-hidden">
                        <div class="overflow-x-auto custom-scroll">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->walletTransactions as $txn)
                                    <tr>
                                        <td>
                                            <div class="flex items-center gap-3">
                                                @if($txn->type === 'credit')
                                                <div class="w-8 h-8 rounded-lg bg-emerald-500/15 flex items-center justify-center flex-shrink-0">
                                                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                                                </div>
                                                @else
                                                <div class="w-8 h-8 rounded-lg bg-red-500/15 flex items-center justify-center flex-shrink-0">
                                                    <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                                                </div>
                                                @endif
                                                <div>
                                                    <div class="text-sm text-white font-medium capitalize">{{ str_replace('_', ' ', $txn->source) }}</div>
                                                    @if($txn->description)
                                                    <div class="text-[11px] text-gray-500 mt-0.5 truncate max-w-[200px]">{{ $txn->description }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="font-semibold {{ $txn->type === 'credit' ? 'text-emerald-400' : 'text-red-400' }}">
                                                {{ $txn->type === 'credit' ? '+' : '-' }}${{ number_format($txn->amount, 2) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-xs capitalize text-gray-400">{{ $txn->status }}</span>
                                        </td>
                                        <td class="text-gray-400">{{ $txn->created_at->format('M d, Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @else
                    <div class="glass-card p-16 text-center">
                        <div class="w-16 h-16 rounded-2xl bg-brand-pink/10 flex items-center justify-center mx-auto mb-5">
                            <svg class="w-8 h-8 text-brand-pink/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z"/></svg>
                        </div>
                        <h3 class="text-lg text-white font-medium mb-2">No Transactions Yet</h3>
                        <p class="text-gray-500 text-sm max-w-sm mx-auto">Your transaction history will appear here once you make purchases or earn income.</p>
                    </div>
                    @endif
                </div>

                {{-- ==================== WITHDRAW TAB ==================== --}}
                <div id="tab-withdraw" class="tab-panel">
                    <div class="mb-8">
                        <h2 class="font-serif text-2xl text-white mb-1">Request Withdrawal</h2>
                        <p class="text-gray-500 text-sm">Submit a withdrawal request with your bank details. Admin will manually process the payment.</p>
                    </div>

                    {{-- Balance Info --}}
                    <div class="glass-card p-5 mb-6 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-emerald-500/15 flex items-center justify-center">
                                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                            </div>
                            <div>
                                <div class="text-[10px] text-gray-500 uppercase tracking-widest font-semibold mb-0.5">Available Balance</div>
                                <div class="text-xl text-white font-serif font-bold">${{ number_format($user->wallet->balance ?? 0, 2) }}</div>
                            </div>
                        </div>
                        <div class="text-xs text-gray-500">Min. withdrawal: $10.00</div>
                    </div>

                    {{-- Withdrawal Form --}}
                    <form id="withdrawForm" class="glass-card p-8 space-y-6">
                        @csrf

                        <div id="withdrawFormMsg" class="hidden rounded-xl p-4 text-sm text-center"></div>

                        <div>
                            <label for="withdraw_amount" class="block text-[10px] font-semibold text-gray-500 uppercase tracking-widest mb-3">Withdrawal Amount ($)</label>
                            <input type="number" id="withdraw_amount" name="amount" min="10" step="0.01" max="{{ $user->wallet->balance ?? 0 }}" required
                                class="w-full bg-transparent border-0 border-b border-white/15 pb-3 text-white text-lg font-semibold focus:outline-none focus:border-brand-pink transition-colors duration-300"
                                placeholder="Enter amount">
                        </div>

                        <div class="pt-2">
                            <h3 class="text-xs uppercase tracking-[0.15em] font-semibold text-brand-purple mb-4">Bank Details</h3>
                            <div class="grid sm:grid-cols-2 gap-6">
                                <div>
                                    <label for="account_holder_name" class="block text-[10px] font-semibold text-gray-500 uppercase tracking-widest mb-3">Account Holder Name</label>
                                    <input type="text" id="account_holder_name" name="account_holder_name" required
                                        class="w-full bg-transparent border-0 border-b border-white/15 pb-3 text-white text-base focus:outline-none focus:border-brand-pink transition-colors duration-300"
                                        placeholder="e.g. Ravi Sharma" value="{{ $user->name }}">
                                </div>
                                <div>
                                    <label for="bank_name" class="block text-[10px] font-semibold text-gray-500 uppercase tracking-widest mb-3">Bank Name</label>
                                    <input type="text" id="bank_name" name="bank_name" required
                                        class="w-full bg-transparent border-0 border-b border-white/15 pb-3 text-white text-base focus:outline-none focus:border-brand-pink transition-colors duration-300"
                                        placeholder="e.g. State Bank of India">
                                </div>
                                <div>
                                    <label for="account_number" class="block text-[10px] font-semibold text-gray-500 uppercase tracking-widest mb-3">Account Number</label>
                                    <input type="text" id="account_number" name="account_number" required
                                        class="w-full bg-transparent border-0 border-b border-white/15 pb-3 text-white text-base focus:outline-none focus:border-brand-pink transition-colors duration-300"
                                        placeholder="e.g. 1234567890123456">
                                </div>
                                <div>
                                    <label for="ifsc_code" class="block text-[10px] font-semibold text-gray-500 uppercase tracking-widest mb-3">IFSC Code</label>
                                    <input type="text" id="ifsc_code" name="ifsc_code" required
                                        class="w-full bg-transparent border-0 border-b border-white/15 pb-3 text-white text-base focus:outline-none focus:border-brand-pink transition-colors duration-300"
                                        placeholder="e.g. SBIN0001234">
                                </div>
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="submit" id="withdrawSubmitBtn"
                                class="w-full sm:w-auto px-10 py-3.5 rounded-xl text-sm uppercase tracking-widest font-semibold text-white transition-all hover:shadow-lg hover:shadow-brand-pink/25 hover:-translate-y-0.5"
                                style="background: linear-gradient(135deg, #D53F8C, #6B46C1);">
                                <span id="withdrawBtnText">Submit Withdrawal Request</span>
                                <span id="withdrawBtnLoader" class="hidden">
                                    <svg class="animate-spin h-5 w-5 mx-auto text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                </span>
                            </button>
                        </div>
                    </form>

                    {{-- Withdrawal History --}}
                    <div class="mt-8">
                        <h3 class="text-sm uppercase tracking-widest font-semibold text-gray-400 mb-4">Withdrawal History</h3>
                        
                        @php
                            $withdrawals = $user->walletTransactions->where('source', 'withdrawal')->sortByDesc('created_at');
                        @endphp

                        @if($withdrawals->count() > 0)
                        <div class="glass-card overflow-hidden">
                            <div class="overflow-x-auto custom-scroll">
                                <table class="data-table">
                                    <thead>
                                        <tr>
                                            <th>Amount</th>
                                            <th>Bank Details</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($withdrawals as $wd)
                                        <tr>
                                            <td class="font-semibold text-white">${{ number_format($wd->amount, 2) }}</td>
                                            <td>
                                                <div class="text-xs text-gray-400 space-y-0.5">
                                                    <div class="text-gray-300 font-medium">{{ $wd->bank_name }}</div>
                                                    <div>A/C: {{ $wd->account_number }}</div>
                                                    <div>IFSC: {{ $wd->ifsc_code }}</div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($wd->status === 'completed')
                                                    <span class="inline-flex items-center px-2 py-1 rounded border border-emerald-500/20 bg-emerald-500/10 text-[10px] uppercase font-semibold tracking-wider text-emerald-400">Approved</span>
                                                @elseif($wd->status === 'pending')
                                                    <span class="inline-flex items-center px-2 py-1 rounded border border-amber-500/20 bg-amber-500/10 text-[10px] uppercase font-semibold tracking-wider text-amber-400">Pending</span>
                                                @else
                                                    <span class="inline-flex items-center px-2 py-1 rounded border border-red-500/20 bg-red-500/10 text-[10px] uppercase font-semibold tracking-wider text-red-400">Rejected</span>
                                                @endif
                                            </td>
                                            <td class="text-gray-400 text-xs">{{ $wd->created_at->format('M d, Y') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @else
                        <div class="glass-card p-8 text-center">
                            <p class="text-gray-500 text-sm">No withdrawal requests found.</p>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- ==================== NETWORK TAB ==================== --}}
                <div id="tab-network" class="tab-panel">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h2 class="font-serif text-2xl text-white mb-1">Referral Network</h2>
                            <p class="text-gray-500 text-sm">Your downline tree up to 5 levels deep.</p>
                        </div>
                        <div class="stat-card purple !p-3 !rounded-xl">
                            <div class="text-center relative z-10">
                                <div class="text-xl font-serif text-white font-bold leading-none">{{ $user->nestedChildren->count() }}</div>
                                <div class="text-[9px] uppercase tracking-widest text-gray-400 mt-1">Direct</div>
                            </div>
                        </div>
                    </div>

                    @if($user->nestedChildren->count() > 0)
                    <div class="glass-card p-5 relative">
                        <div class="absolute left-[36px] top-5 bottom-5 w-px bg-white/5"></div>
                        <x-referral-tree :users="$user->nestedChildren" :level="1" :maxLevel="5" />
                    </div>
                    @else
                    <div class="glass-card p-16 text-center">
                        <div class="w-16 h-16 rounded-2xl bg-yellow-500/10 flex items-center justify-center mx-auto mb-5">
                            <svg class="w-8 h-8 text-yellow-400/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <h3 class="text-lg text-white font-medium mb-2">No Referrals Yet</h3>
                        <p class="text-gray-500 text-sm mb-6 max-w-sm mx-auto">Share your referral link to build your network and start earning direct income!</p>
                        <button onclick="copyToClipboard('{{ url('/register?ref=' . $user->user_id) }}')" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-semibold text-white transition-all hover:shadow-lg hover:shadow-brand-purple/20" style="background: linear-gradient(135deg, #6B46C1, #D53F8C);">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            Copy Referral Link
                        </button>
                    </div>
                    @endif
                </div>

                {{-- ==================== KYC TAB ==================== --}}
                @if(!$user->kyc || ($user->kyc && $user->kyc->status === 'rejected'))
                <div id="tab-kyc" class="tab-panel">
                    <div class="mb-8">
                        <h2 class="font-serif text-2xl text-white mb-1">KYC Verification</h2>
                        <p class="text-gray-500 text-sm">Submit your identity document to verify your account.</p>
                    </div>

                    @if($user->kyc && $user->kyc->status === 'rejected')
                    <div class="glass-card p-4 mb-6 flex items-center gap-3 border-red-500/20 bg-red-500/5">
                        <svg class="w-5 h-5 text-red-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                        <span class="text-sm text-red-300">Your previous submission was rejected. Please resubmit with clear, valid documents.</span>
                    </div>
                    @endif

                    {{-- Accepted Documents --}}
                    <div class="grid grid-cols-3 gap-4 mb-8">
                        <div class="glass-card p-5 text-center">
                            <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-brand-purple/15 flex items-center justify-center">
                                <svg class="w-6 h-6 text-brand-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0"/></svg>
                            </div>
                            <span class="text-xs text-gray-400 font-medium">Aadhaar Card</span>
                        </div>
                        <div class="glass-card p-5 text-center">
                            <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-brand-purple/15 flex items-center justify-center">
                                <svg class="w-6 h-6 text-brand-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <span class="text-xs text-gray-400 font-medium">Passport</span>
                        </div>
                        <div class="glass-card p-5 text-center">
                            <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-brand-purple/15 flex items-center justify-center">
                                <svg class="w-6 h-6 text-brand-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15A2.25 2.25 0 002.25 6.75v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z"/></svg>
                            </div>
                            <span class="text-xs text-gray-400 font-medium">Driving Licence</span>
                        </div>
                    </div>

                    {{-- KYC Form --}}
                    <form id="kycForm" class="glass-card p-8 space-y-6">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                        <div>
                            <label class="block text-[10px] font-semibold text-gray-500 uppercase tracking-widest mb-3">Document Type</label>
                            <select name="document_type" id="kyc_document_type" required
                                class="w-full bg-white/5 border border-white/15 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-brand-pink transition-colors appearance-none">
                                <option value="" disabled selected class="bg-[#0a0015]">Select document type</option>
                                <option value="aadhaar" class="bg-[#0a0015]">Aadhaar Card</option>
                                <option value="passport" class="bg-[#0a0015]">Passport</option>
                                <option value="driving_license" class="bg-[#0a0015]">Driving Licence</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-[10px] font-semibold text-gray-500 uppercase tracking-widest mb-3">Document Number</label>
                            <input type="text" name="document_number" id="kyc_document_number" required placeholder="Enter document number"
                                class="w-full bg-white/5 border border-white/15 rounded-xl px-4 py-3 text-white text-sm placeholder-gray-600 focus:outline-none focus:border-brand-pink transition-colors">
                        </div>

                        <div class="grid sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-[10px] font-semibold text-gray-500 uppercase tracking-widest mb-3">Front Image</label>
                                <input type="file" name="front_image" id="kyc_front_image" accept="image/*" required
                                    class="w-full bg-white/5 border border-dashed border-white/20 rounded-xl px-4 py-6 text-gray-400 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:bg-brand-purple/20 file:text-brand-purple hover:border-brand-purple/40 transition-colors cursor-pointer">
                            </div>
                            <div>
                                <label class="block text-[10px] font-semibold text-gray-500 uppercase tracking-widest mb-3">Back Image</label>
                                <input type="file" name="back_image" id="kyc_back_image" accept="image/*" required
                                    class="w-full bg-white/5 border border-dashed border-white/20 rounded-xl px-4 py-6 text-gray-400 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:bg-brand-purple/20 file:text-brand-purple hover:border-brand-purple/40 transition-colors cursor-pointer">
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit" id="kycSubmitBtn"
                                class="w-full sm:w-auto px-10 py-3.5 rounded-xl text-sm uppercase tracking-widest font-semibold text-white transition-all hover:shadow-lg hover:shadow-brand-purple/25 hover:-translate-y-0.5"
                                style="background: linear-gradient(135deg, #6B46C1, #D53F8C);">
                                <span id="kycBtnText">Submit KYC Documents</span>
                                <span id="kycBtnLoader" class="hidden">
                                    <svg class="animate-spin h-5 w-5 mx-auto text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                </span>
                            </button>
                        </div>

                        <div id="kycMessage" class="hidden rounded-xl p-4 text-sm text-center"></div>
                    </form>
                </div>
                @endif

            </div>
        </div>
    </div>
</section>

{{-- Copy Toast --}}
<div id="copyToast" class="copy-toast">✓ Copied to clipboard!</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ===== TAB SWITCHING =====
    window.switchTab = function(tabName) {
        // Hide all panels
        document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
        // Deactivate all desktop buttons
        document.querySelectorAll('.dash-tab-btn').forEach(b => b.classList.remove('active'));
        // Deactivate all mobile buttons
        document.querySelectorAll('.mobile-tab-btn').forEach(b => b.classList.remove('active'));

        // Show target panel
        const panel = document.getElementById('tab-' + tabName);
        if (panel) panel.classList.add('active');

        // Activate matching desktop button
        document.querySelectorAll('.dash-tab-btn').forEach(btn => {
            if (btn.textContent.trim().toLowerCase().replace(/\s+/g, '').includes(tabName.toLowerCase())) {
                btn.classList.add('active');
            }
        });
        // Activate matching mobile button
        document.querySelectorAll('.mobile-tab-btn').forEach(btn => {
            if (btn.textContent.trim().toLowerCase().replace(/\s+/g, '').includes(tabName.toLowerCase())) {
                btn.classList.add('active');
            }
        });

        // Scroll to top of content
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    // ===== KYC FORM =====
    const kycForm = document.getElementById('kycForm');
    if (kycForm) {
        kycForm.addEventListener('submit', async function (e) {
            e.preventDefault();

            const btn = document.getElementById('kycSubmitBtn');
            const btnText = document.getElementById('kycBtnText');
            const btnLoader = document.getElementById('kycBtnLoader');
            const msgBox = document.getElementById('kycMessage');

            btn.disabled = true;
            btnText.classList.add('hidden');
            btnLoader.classList.remove('hidden');
            msgBox.classList.add('hidden');

            try {
                const formData = new FormData();
                formData.append('user_id', kycForm.querySelector('input[name="user_id"]').value);
                formData.append('document_type', document.getElementById('kyc_document_type').value);
                formData.append('document_number', document.getElementById('kyc_document_number').value);
                formData.append('front_image', document.getElementById('kyc_front_image').files[0]);
                formData.append('back_image', document.getElementById('kyc_back_image').files[0]);

                const response = await fetch('/api/kyc', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': kycForm.querySelector('input[name="_token"]').value,
                        'Accept': 'application/json',
                    },
                    body: formData,
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    msgBox.className = 'rounded-xl p-4 text-sm text-center bg-emerald-500/15 border border-emerald-500/30 text-emerald-300';
                    msgBox.textContent = 'KYC submitted successfully! Your documents are under review.';
                    msgBox.classList.remove('hidden');
                    setTimeout(() => window.location.reload(), 2000);
                } else {
                    msgBox.className = 'rounded-xl p-4 text-sm text-center bg-red-500/15 border border-red-500/30 text-red-300';
                    msgBox.textContent = data.message || 'Submission failed. Please try again.';
                    msgBox.classList.remove('hidden');
                }
            } catch (err) {
                msgBox.className = 'rounded-xl p-4 text-sm text-center bg-red-500/15 border border-red-500/30 text-red-300';
                msgBox.textContent = 'Something went wrong. Please try again.';
                msgBox.classList.remove('hidden');
            } finally {
                btn.disabled = false;
                btnText.classList.remove('hidden');
                btnLoader.classList.add('hidden');
            }
        });
    }

    // ===== PROFILE EDIT FORM =====
    const profileForm = document.getElementById('profileEditForm');

    // ===== WITHDRAW FORM =====
    const withdrawForm = document.getElementById('withdrawForm');
    if (withdrawForm) {
        withdrawForm.addEventListener('submit', async function (e) {
            e.preventDefault();

            const btn = document.getElementById('withdrawSubmitBtn');
            const btnText = document.getElementById('withdrawBtnText');
            const btnLoader = document.getElementById('withdrawBtnLoader');
            const msgBox = document.getElementById('withdrawFormMsg');

            btn.disabled = true;
            btnText.classList.add('hidden');
            btnLoader.classList.remove('hidden');
            msgBox.classList.add('hidden');

            try {
                const formData = new FormData(withdrawForm);
                const response = await fetch('/api/wallet/withdraw', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': withdrawForm.querySelector('input[name="_token"]').value,
                        'Accept': 'application/json',
                    },
                    body: formData,
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    msgBox.className = 'rounded-xl p-4 text-sm text-center bg-emerald-500/15 border border-emerald-500/30 text-emerald-300';
                    msgBox.textContent = data.message || 'Withdrawal request submitted successfully!';
                    msgBox.classList.remove('hidden');
                    setTimeout(() => window.location.reload(), 2000);
                } else {
                    msgBox.className = 'rounded-xl p-4 text-sm text-center bg-red-500/15 border border-red-500/30 text-red-300';
                    msgBox.textContent = data.message || 'Withdrawal failed.';
                    msgBox.classList.remove('hidden');
                }
            } catch (err) {
                msgBox.className = 'rounded-xl p-4 text-sm text-center bg-red-500/15 border border-red-500/30 text-red-300';
                msgBox.textContent = 'Something went wrong. Please try again.';
                msgBox.classList.remove('hidden');
            } finally {
                btn.disabled = false;
                btnText.classList.remove('hidden');
                btnLoader.classList.add('hidden');
            }
        });
    }
    if (profileForm) {
        profileForm.addEventListener('submit', async function (e) {
            e.preventDefault();

            const btn = document.getElementById('profileSubmitBtn');
            const btnText = document.getElementById('profileBtnText');
            const btnLoader = document.getElementById('profileBtnLoader');
            const msgBox = document.getElementById('profileFormMsg');

            btn.disabled = true;
            btnText.classList.add('hidden');
            btnLoader.classList.remove('hidden');
            msgBox.classList.add('hidden');

            try {
                const formData = new FormData(profileForm);
                const response = await fetch('/api/profile/update', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': profileForm.querySelector('input[name="_token"]').value,
                        'Accept': 'application/json',
                    },
                    body: formData,
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    msgBox.className = 'rounded-xl p-4 text-sm text-center bg-emerald-500/15 border border-emerald-500/30 text-emerald-300';
                    msgBox.textContent = data.message;
                    msgBox.classList.remove('hidden');

                    if(document.getElementById('viewName')) document.getElementById('viewName').textContent = data.data.name;
                    if(document.getElementById('viewPhone')) document.getElementById('viewPhone').textContent = data.data.mobile || 'Not provided';

                    setTimeout(() => {
                        toggleEditMode();
                        msgBox.classList.add('hidden');
                    }, 1500);
                } else {
                    msgBox.className = 'rounded-xl p-4 text-sm text-center bg-red-500/15 border border-red-500/30 text-red-300';
                    msgBox.textContent = data.message || 'Update failed.';
                    msgBox.classList.remove('hidden');
                }
            } catch (err) {
                msgBox.className = 'rounded-xl p-4 text-sm text-center bg-red-500/15 border border-red-500/30 text-red-300';
                msgBox.textContent = 'Something went wrong.';
                msgBox.classList.remove('hidden');
            } finally {
                btn.disabled = false;
                btnText.classList.remove('hidden');
                btnLoader.classList.add('hidden');
            }
        });
    }
});

// ===== HELPER FUNCTIONS =====
function toggleEditMode() {
    const viewMode = document.getElementById('profileViewMode');
    const editMode = document.getElementById('profileEditMode');
    if (viewMode.classList.contains('hidden')) {
        viewMode.classList.remove('hidden');
        editMode.classList.add('hidden');
    } else {
        viewMode.classList.add('hidden');
        editMode.classList.remove('hidden');
    }
}

function toggleReferralTree(nodeId) {
    const node = document.getElementById(nodeId);
    const icon = document.getElementById('icon-' + nodeId);
    if (!node) return;
    if (node.classList.contains('hidden')) {
        node.classList.remove('hidden');
        if (icon) icon.classList.add('rotate-180');
    } else {
        node.classList.add('hidden');
        if (icon) icon.classList.remove('rotate-180');
    }
}

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        const toast = document.getElementById('copyToast');
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 2000);
    }).catch(err => {
        console.error('Failed to copy: ', err);
    });
}
</script>
@endpush
