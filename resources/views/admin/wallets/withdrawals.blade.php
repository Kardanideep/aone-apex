@extends('layouts.admin')

@section('title', 'Withdrawals | AONE APEX Admin')

@section('content')

<!-- Header -->
<div class="mb-6">
    <h1 class="font-serif text-2xl text-slate-800 font-bold mb-1">Withdrawal Requests</h1>
    <p class="text-slate-500 text-sm">Review and manage user withdrawal requests.</p>
</div>

@if (session('success'))
    <div class="mb-5 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 p-4 rounded-xl text-sm">
        <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="mb-5 flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl text-sm">
        <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        {{ session('error') }}
    </div>
@endif

<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="admin-card stat-card-amber p-4 rounded-xl">
        <div class="flex items-start justify-between">
            <div>
                <div class="text-slate-500 text-[10px] font-semibold uppercase tracking-widest mb-1">Pending</div>
                <div class="text-2xl font-serif font-bold text-amber-600">{{ number_format($pendingCount) }}</div>
                <div class="text-xs text-slate-400 mt-1">Awaiting approval</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center text-amber-500 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
    </div>

    <div class="admin-card stat-card-cyan p-4 rounded-xl">
        <div class="flex items-start justify-between">
            <div>
                <div class="text-slate-500 text-[10px] font-semibold uppercase tracking-widest mb-1">Approved</div>
                <div class="text-2xl font-serif font-bold text-emerald-600">{{ number_format($completedCount) }}</div>
                <div class="text-xs text-slate-400 mt-1">Successfully processed</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-500 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
    </div>

    <div class="admin-card stat-card-pink p-4 rounded-xl">
        <div class="flex items-start justify-between">
            <div>
                <div class="text-slate-500 text-[10px] font-semibold uppercase tracking-widest mb-1">Rejected</div>
                <div class="text-2xl font-serif font-bold text-red-500">{{ number_format($rejectedCount) }}</div>
                <div class="text-xs text-slate-400 mt-1">Declined requests</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center text-red-500 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
    </div>
</div>

<!-- Filter Tabs -->
<div class="flex gap-2 mb-5">
    <a href="{{ route('admin.wallets.withdrawals') }}"
        class="px-4 py-2 text-sm font-medium rounded-lg transition-all {{ !request('status') ? 'bg-violet-600 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">
        All
    </a>
    <a href="{{ route('admin.wallets.withdrawals', ['status' => 'pending']) }}"
        class="px-4 py-2 text-sm font-medium rounded-lg transition-all {{ request('status') === 'pending' ? 'bg-amber-500 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">
        Pending ({{ $pendingCount }})
    </a>
    <a href="{{ route('admin.wallets.withdrawals', ['status' => 'completed']) }}"
        class="px-4 py-2 text-sm font-medium rounded-lg transition-all {{ request('status') === 'completed' ? 'bg-emerald-500 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">
        Approved
    </a>
    <a href="{{ route('admin.wallets.withdrawals', ['status' => 'rejected']) }}"
        class="px-4 py-2 text-sm font-medium rounded-lg transition-all {{ request('status') === 'rejected' ? 'bg-red-500 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">
        Rejected
    </a>
</div>

<!-- Withdrawals Table -->
<div class="admin-card rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Requested On</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($withdrawals as $wd)
                <tr>
                    <td class="font-mono text-xs text-slate-400">{{ $wd->id }}</td>
                    <td>
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-violet-500 to-pink-400 flex items-center justify-center text-white text-xs font-bold">
                                {{ substr($wd->user->name ?? '?', 0, 1) }}
                            </div>
                            <div>
                                <div class="text-sm text-slate-700 font-medium">{{ $wd->user->name ?? 'Unknown' }}</div>
                                <div class="text-xs text-slate-400">{{ $wd->user->user_id ?? '' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="font-semibold text-slate-800">${{ number_format($wd->amount, 2) }}</td>
                    <td>
                        @if($wd->status === 'completed')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-600 border border-emerald-200">Approved</span>
                        @elseif($wd->status === 'pending')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-600 border border-amber-200">Pending</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-600 border border-red-200">Rejected</span>
                        @endif
                    </td>
                    <td class="text-slate-400 text-xs">{{ $wd->created_at->format('M d, Y h:i A') }}</td>
                    <td >
                        <div class="flex items-center justify-center gap-2">
                            <button type="button" onclick="openDetailsModal({{ json_encode([
                                'id' => $wd->id,
                                'user' => $wd->user->name ?? 'Unknown',
                                'amount' => number_format($wd->amount, 2),
                                'status' => $wd->status,
                                'date' => $wd->created_at->format('M d, Y h:i A'),
                                'account_holder' => $wd->account_holder_name,
                                'bank_name' => $wd->bank_name,
                                'account_number' => $wd->account_number,
                                'ifsc_code' => $wd->ifsc_code
                            ]) }})"
                                class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-violet-600 bg-violet-50 hover:bg-violet-100 border border-violet-200 rounded-lg transition-all">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                View
                            </button>

                            @if($wd->status === 'pending')
                                <form action="{{ route('admin.wallets.withdrawals.approve', $wd) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Approve this withdrawal of ${{ number_format($wd->amount, 2) }}? Make sure you have sent the payment to the bank account.')"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-emerald-600 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 rounded-lg transition-all">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        Approve
                                    </button>
                                </form>
                                <form action="{{ route('admin.wallets.withdrawals.reject', $wd) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Reject this withdrawal? Amount will be refunded to user wallet.')"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-red-600 bg-red-50 hover:bg-red-100 border border-red-200 rounded-lg transition-all">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        Reject
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-12">
                        <svg class="w-10 h-10 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <p class="text-slate-400 text-sm">No withdrawal requests found.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($withdrawals->hasPages())
    <div class="px-6 py-4 border-t border-slate-100">
        {{ $withdrawals->links() }}
    </div>
    @endif
</div>

<!-- Details Modal -->
<div id="detailsModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity bg-slate-900/50 backdrop-blur-sm" aria-hidden="true" onclick="closeDetailsModal()"></div>

        <!-- Modal panel -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-2xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-lg font-serif font-bold text-slate-800" id="modal-title">Withdrawal Request Details</h3>
                <button type="button" onclick="closeDetailsModal()" class="text-slate-400 hover:text-slate-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4 p-4 bg-slate-50 rounded-xl">
                    <div>
                        <div class="text-[10px] font-semibold text-slate-500 uppercase tracking-widest mb-1">Request ID</div>
                        <div class="text-sm font-medium text-slate-800" id="modal-id"></div>
                    </div>
                    <div>
                        <div class="text-[10px] font-semibold text-slate-500 uppercase tracking-widest mb-1">Status</div>
                        <div class="text-sm font-medium text-slate-800 capitalize" id="modal-status"></div>
                    </div>
                    <div>
                        <div class="text-[10px] font-semibold text-slate-500 uppercase tracking-widest mb-1">User</div>
                        <div class="text-sm font-medium text-slate-800" id="modal-user"></div>
                    </div>
                    <div>
                        <div class="text-[10px] font-semibold text-slate-500 uppercase tracking-widest mb-1">Date</div>
                        <div class="text-sm font-medium text-slate-800" id="modal-date"></div>
                    </div>
                    <div class="col-span-2">
                        <div class="text-[10px] font-semibold text-slate-500 uppercase tracking-widest mb-1">Amount</div>
                        <div class="text-2xl font-serif font-bold text-slate-800" id="modal-amount"></div>
                    </div>
                </div>

                <div class="p-4 border border-slate-100 rounded-xl">
                    <h4 class="text-xs font-semibold text-violet-600 uppercase tracking-widest mb-3">Bank Information</h4>
                    <div class="space-y-3">
                        <div>
                            <div class="text-[10px] font-semibold text-slate-500 uppercase tracking-widest mb-0.5">Account Holder Name</div>
                            <div class="text-sm font-medium text-slate-800" id="modal-account-holder"></div>
                        </div>
                        <div>
                            <div class="text-[10px] font-semibold text-slate-500 uppercase tracking-widest mb-0.5">Bank Name</div>
                            <div class="text-sm font-medium text-slate-800" id="modal-bank-name"></div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <div class="text-[10px] font-semibold text-slate-500 uppercase tracking-widest mb-0.5">Account Number</div>
                                <div class="text-sm font-mono text-slate-800" id="modal-account-number"></div>
                            </div>
                            <div>
                                <div class="text-[10px] font-semibold text-slate-500 uppercase tracking-widest mb-0.5">IFSC Code</div>
                                <div class="text-sm font-mono text-slate-800" id="modal-ifsc-code"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="closeDetailsModal()" class="w-full inline-flex justify-center rounded-lg border border-slate-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-slate-700 hover:bg-slate-50 sm:ml-3 sm:w-auto sm:text-sm">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function openDetailsModal(data) {
        document.getElementById('modal-id').textContent = '#' + data.id;
        document.getElementById('modal-user').textContent = data.user;
        document.getElementById('modal-amount').textContent = '$' + data.amount;
        document.getElementById('modal-status').textContent = data.status;
        document.getElementById('modal-date').textContent = data.date;
        
        document.getElementById('modal-account-holder').textContent = data.account_holder || 'N/A';
        document.getElementById('modal-bank-name').textContent = data.bank_name || 'N/A';
        document.getElementById('modal-account-number').textContent = data.account_number || 'N/A';
        document.getElementById('modal-ifsc-code').textContent = data.ifsc_code || 'N/A';

        const modal = document.getElementById('detailsModal');
        modal.classList.remove('hidden');
    }

    function closeDetailsModal() {
        document.getElementById('detailsModal').classList.add('hidden');
    }
</script>

@endsection
