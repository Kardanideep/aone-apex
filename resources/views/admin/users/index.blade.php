@extends('layouts.admin')

@section('title', 'User Management | AONE APEX')

@section('content')

<!-- Header -->
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="font-serif text-2xl text-slate-800 font-bold mb-1">User Management</h1>
        <p class="text-slate-500 text-sm">View and manage all registered members.</p>
    </div>
    <div class="flex items-center gap-2">
        <div class="bg-white border border-slate-200 rounded-lg p-1 flex items-center gap-1 shadow-sm">
            <a href="{{ route('admin.users.index') }}" 
               class="px-3 py-1.5 text-xs {{ !request('status') ? 'font-semibold bg-violet-100 text-violet-700' : 'font-medium text-slate-500 hover:bg-slate-100 hover:text-slate-800' }} rounded-md transition-colors">All</a>
            <a href="{{ route('admin.users.index', ['status' => 'active']) }}" 
               class="px-3 py-1.5 text-xs {{ request('status') === 'active' ? 'font-semibold bg-violet-100 text-violet-700' : 'font-medium text-slate-500 hover:bg-slate-100 hover:text-slate-800' }} rounded-md transition-colors">Active</a>
            <a href="{{ route('admin.users.index', ['status' => 'pending']) }}" 
               class="px-3 py-1.5 text-xs {{ request('status') === 'pending' ? 'font-semibold bg-violet-100 text-violet-700' : 'font-medium text-slate-500 hover:bg-slate-100 hover:text-slate-800' }} rounded-md transition-colors">Pending</a>
            <a href="{{ route('admin.users.index', ['status' => 'blocked']) }}" 
               class="px-3 py-1.5 text-xs {{ request('status') === 'blocked' ? 'font-semibold bg-violet-100 text-violet-700' : 'font-medium text-slate-500 hover:bg-slate-100 hover:text-slate-800' }} rounded-md transition-colors">Blocked</a>
        </div>
    </div>
</div>

<!-- Table Card -->
<div class="admin-card rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full admin-table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Name / Email</th>
                    <th>Sponsor</th>
                    <th>Joined Date</th>
                    <th>Status</th>
                    <th>KYC Status</th>
                    <th class="text-right pr-6">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>
                        <span class="font-mono text-slate-400 text-xs bg-slate-100 px-2 py-1 rounded">#{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </td>
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-violet-400 to-pink-400 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="font-semibold text-slate-800 text-sm">{{ $user->name }}</div>
                                <div class="text-xs text-slate-400">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        @if($user->sponsor_id)
                            @php $sponsor = \App\Models\User::find($user->sponsor_id); @endphp
                            @if($sponsor)
                                <div class="text-xs text-slate-800 font-medium">{{ $sponsor->name }}</div>
                                <div class="text-[10px] text-slate-400 font-mono">{{ $sponsor->user_id }}</div>
                            @else
                                <span class="text-xs text-slate-400">Unknown</span>
                            @endif
                        @else
                            <span class="text-xs text-slate-400">None</span>
                        @endif
                    </td>
                    <td>
                        <span class="text-slate-600 text-sm">{{ $user->created_at->format('M d, Y') }}</span>
                    </td>
                    <td>
                        @if($user->status === 'active')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Active
                            </span>
                        @elseif($user->status === 'pending')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Pending
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-red-50 text-red-700 border border-red-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Blocked
                            </span>
                        @endif
                    </td>
                    <td>
                        @if(!$user->kyc)
                            <span class="text-slate-400 text-xs">Not Submitted</span>
                        @elseif($user->kyc->status === 'approved')
                            <span class="text-emerald-600 text-xs font-medium">✓ Verified</span>
                        @elseif($user->kyc->status === 'pending')
                            <span class="text-amber-600 text-xs font-medium">Under Review</span>
                        @else
                            <span class="text-red-500 text-xs font-medium">Rejected</span>
                        @endif
                    </td>
                    <td class="text-right pr-6">
                        <a href="{{ route('admin.users.show', $user->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-violet-600 hover:bg-violet-700 text-white rounded-lg text-xs font-semibold transition-colors shadow-sm">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            View
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-16">
                        <svg class="w-12 h-12 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        <p class="text-slate-400 font-medium">No users found in the system.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50">
        {{ $users->links() }}
    </div>
    @endif
</div>

@endsection
