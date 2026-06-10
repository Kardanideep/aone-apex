@extends('layouts.admin')

@section('title', 'User Details | AONE APEX')

@section('content')

<!-- Header -->
<div class="mb-6">
    <div class="flex items-center gap-3 mb-1">
        <a href="{{ route('admin.users.index') }}" class="w-9 h-9 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-slate-500 hover:text-violet-600 hover:border-violet-200 hover:bg-violet-50 transition-all shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h1 class="font-serif text-2xl text-slate-800 font-bold">User Details</h1>
            <p class="text-slate-500 text-sm">Managing account for <span class="font-medium text-slate-700">{{ $user->name }}</span></p>
        </div>
    </div>
</div>

@if(session('success'))
<div class="mb-6 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 p-4 rounded-xl text-sm">
    <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    {{ session('success') }}
</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Left Column -->
    <div class="lg:col-span-1 space-y-5">

        <!-- Profile Card -->
        <div class="admin-card rounded-xl p-6">
            <div class="flex items-center gap-4 mb-5">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-violet-500 to-pink-400 flex items-center justify-center text-white font-serif text-2xl font-bold shadow-md">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <h2 class="text-lg text-slate-800 font-bold">{{ $user->name }}</h2>
                    <p class="text-sm text-slate-500">{{ $user->email }}</p>
                </div>
            </div>

            <div class="space-y-3 pt-5 border-t border-slate-100">
                <div class="flex justify-between items-center text-sm">
                    <span class="text-slate-400">User ID</span>
                    <span class="text-slate-700 font-mono font-semibold bg-slate-100 px-2 py-0.5 rounded text-xs">#{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <span class="text-slate-400">Sponsor</span>
                    @if($user->sponsor_id)
                        @php $sponsor = \App\Models\User::find($user->sponsor_id); @endphp
                        @if($sponsor)
                            <a href="{{ route('admin.users.show', $sponsor->id) }}" class="text-violet-600 hover:text-violet-700 font-medium text-xs">{{ $sponsor->name }} ({{ $sponsor->user_id }})</a>
                        @else
                            <span class="text-slate-700 font-medium text-xs">Unknown</span>
                        @endif
                    @else
                        <span class="text-slate-700 font-medium text-xs">None</span>
                    @endif
                </div>
                <div class="flex justify-between items-center text-sm">
                    <span class="text-slate-400">Joined</span>
                    <span class="text-slate-700 font-medium">{{ $user->created_at->format('F j, Y') }}</span>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <span class="text-slate-400">Account Status</span>
                    @if($user->status === 'active')
                        <span class="inline-flex items-center gap-1 text-emerald-700 font-semibold text-xs bg-emerald-50 border border-emerald-200 px-2.5 py-1 rounded-full"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Active</span>
                    @elseif($user->status === 'pending')
                        <span class="inline-flex items-center gap-1 text-amber-700 font-semibold text-xs bg-amber-50 border border-amber-200 px-2.5 py-1 rounded-full"><span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Pending</span>
                    @else
                        <span class="inline-flex items-center gap-1 text-red-700 font-semibold text-xs bg-red-50 border border-red-200 px-2.5 py-1 rounded-full"><span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Blocked</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Account Status Control -->
        <div class="admin-card rounded-xl p-6">
            <h3 class="text-base text-slate-800 font-bold mb-1">Account Status</h3>
            <p class="text-xs text-slate-400 mb-5">Change the user's access level and permissions.</p>

            <form action="{{ route('admin.users.status', $user->id) }}" method="POST" class="space-y-3">
                @csrf
                <div>
                    <select name="status" class="w-full bg-white border border-slate-300 rounded-xl px-4 py-2.5 text-slate-700 text-sm focus:outline-none focus:border-violet-400 focus:ring-2 focus:ring-violet-100 transition-all appearance-none">
                        <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>✓ Active (Full Access)</option>
                        <option value="pending" {{ $user->status === 'pending' ? 'selected' : '' }}>⏳ Pending (Restricted)</option>
                        <option value="blocked" {{ $user->status === 'blocked' ? 'selected' : '' }}>✗ Blocked (No Access)</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-violet-600 hover:bg-violet-700 text-white text-sm font-semibold py-2.5 rounded-xl transition-colors shadow-sm">
                    Update Status
                </button>
            </form>
        </div>
    </div>

    <!-- Right Column: KYC -->
    <div class="lg:col-span-2 space-y-5">

        <div class="admin-card rounded-xl p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-base text-slate-800 font-bold">KYC Verification</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Identity document review</p>
                </div>
                @if(!$user->kyc)
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-500 border border-slate-200">Not Submitted</span>
                @elseif($user->kyc->status === 'approved')
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">✓ Approved</span>
                @elseif($user->kyc->status === 'pending')
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">⏳ Under Review</span>
                @else
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-200">✗ Rejected</span>
                @endif
            </div>

            @if($user->kyc)
                <div class="grid grid-cols-2 gap-5 mb-6">
                    <div class="bg-slate-50 border border-slate-100 rounded-xl p-4">
                        <div class="text-xs text-slate-400 uppercase tracking-widest font-semibold mb-1">Document Type</div>
                        <div class="text-slate-800 font-semibold capitalize">{{ str_replace('_', ' ', $user->kyc->document_type) }}</div>
                    </div>
                    <div class="bg-slate-50 border border-slate-100 rounded-xl p-4">
                        <div class="text-xs text-slate-400 uppercase tracking-widest font-semibold mb-1">Document Number</div>
                        <div class="text-slate-800 font-bold font-mono">{{ $user->kyc->document_number }}</div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <div class="text-xs text-slate-400 uppercase tracking-widest font-semibold mb-2">Front Image</div>
                        <div class="rounded-xl overflow-hidden border border-slate-200 bg-slate-100 aspect-video flex items-center justify-center">
                            @if($user->kyc->front_image)
                                <img src="{{ asset('storage/' . $user->kyc->front_image) }}" class="w-full h-full object-cover" alt="Front Image">
                            @else
                                <div class="text-center">
                                    <svg class="w-8 h-8 text-slate-300 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span class="text-slate-400 text-xs">Image not found</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div>
                        <div class="text-xs text-slate-400 uppercase tracking-widest font-semibold mb-2">Back Image</div>
                        <div class="rounded-xl overflow-hidden border border-slate-200 bg-slate-100 aspect-video flex items-center justify-center">
                            @if($user->kyc->back_image)
                                <img src="{{ asset('storage/' . $user->kyc->back_image) }}" class="w-full h-full object-cover" alt="Back Image">
                            @else
                                <div class="text-center">
                                    <svg class="w-8 h-8 text-slate-300 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span class="text-slate-400 text-xs">Image not found</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                @if($user->kyc->status === 'pending')
                <div class="mt-6 flex gap-3 pt-5 border-t border-slate-100">
                    <form action="{{ route('admin.users.kyc.status', $user->id) }}" method="POST" class="flex-1">
                        @csrf
                        <input type="hidden" name="status" value="approved">
                        <button type="submit" onclick="return confirm('Are you sure you want to approve this KYC document?')" class="w-full bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 py-2.5 rounded-xl text-sm font-semibold transition-colors">
                            ✓ Approve KYC
                        </button>
                    </form>
                    <form action="{{ route('admin.users.kyc.status', $user->id) }}" method="POST" class="flex-1">
                        @csrf
                        <input type="hidden" name="status" value="rejected">
                        <button type="submit" onclick="return confirm('Are you sure you want to reject this KYC document?')" class="w-full bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 py-2.5 rounded-xl text-sm font-semibold transition-colors">
                            ✗ Reject KYC
                        </button>
                    </form>
                </div>
                @endif
            @else
                <div class="py-14 text-center border-2 border-dashed border-slate-200 rounded-xl bg-slate-50">
                    <svg class="w-10 h-10 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <p class="text-slate-500 font-medium text-sm">No KYC documents submitted</p>
                    <p class="text-slate-400 text-xs mt-1">This user hasn't submitted their KYC documents yet.</p>
                </div>
            @endif
        </div>

        <!-- Referral Network Tree -->
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
            <div class="flex items-center justify-between mb-6 pb-5 border-b border-slate-100">
                <div>
                    <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        Referral Network Tree
                    </h2>
                    <p class="text-sm text-slate-500 mt-1">Downline structure for this user.</p>
                </div>
                <div class="text-right bg-indigo-50 px-4 py-2 rounded-xl">
                    <div class="text-2xl font-bold text-indigo-600">{{ $user->nestedChildren->count() }}</div>
                    <div class="text-[10px] font-bold uppercase tracking-wider text-indigo-400">Direct Referrals</div>
                </div>
            </div>

            @if($user->nestedChildren->count() > 0)
                <div class="relative bg-slate-900 rounded-xl p-4">
                    <div class="absolute left-[36px] top-4 bottom-4 w-px bg-white/10"></div>
                    <x-referral-tree :users="$user->nestedChildren" :level="1" :maxLevel="5" />
                </div>
            @else
                <div class="py-12 text-center border-2 border-dashed border-slate-200 rounded-xl bg-slate-50">
                    <svg class="w-10 h-10 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <p class="text-slate-500 font-medium text-sm">No Referrals</p>
                    <p class="text-slate-400 text-xs mt-1">This user hasn't referred anyone yet.</p>
                </div>
            @endif
        </div>

    </div>

</div>

@push('scripts')
<script>
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
</script>
@endpush
@endsection
