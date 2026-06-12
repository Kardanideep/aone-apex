@extends('layouts.admin')

@section('title', 'Manage User Investments | AONE APEX')

@section('content')

<!-- Header -->
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="font-serif text-2xl text-slate-800 font-bold mb-1">User Investments</h1>
        <p class="text-slate-500 text-sm">Manage all independent user investments.</p>
    </div>
    <a href="{{ route('admin.user-investments.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-violet-600 hover:bg-violet-700 text-white text-sm font-semibold rounded-xl transition-colors shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add Investment
    </a>
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
        <h2 class="font-semibold text-slate-700 text-sm">All Investments <span class="ml-1.5 text-xs bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full">{{ count($investments) }}</span></h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Investment Amount</th>
                    <th>Created</th>
                    <th class="text-center pr-6">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($investments as $investment)
                <tr>
                    <td>
                        <span class="font-mono text-violet-500 font-bold text-xs">#{{ $investment->id }}</span>
                    </td>
                    <td>
                        <div class="flex items-center gap-3">
                            @if($investment->user_img)
                                <img src="{{ asset('storage/'.$investment->user_img) }}" class="w-8 h-8 rounded-lg object-cover border border-slate-200">
                            @else
                                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-violet-100 to-pink-100 border border-violet-200 flex items-center justify-center flex-shrink-0">
                                    <span class="text-xs font-bold text-violet-600">{{ substr($investment->user_name, 0, 1) }}</span>
                                </div>
                            @endif
                            <span class="font-semibold text-slate-800 text-sm">{{ $investment->user_name }}</span>
                        </div>
                    </td>
                    <td>
                        <span class="font-bold text-slate-800 text-sm">${{ number_format($investment->investment_amount, 2) }}</span>
                    </td>
                    <td>
                        <span class="text-slate-500 text-sm">{{ $investment->created_at->format('M d, Y') }}</span>
                    </td>
                    <td class="text-center pr-6">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.user-investments.edit', $investment->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 hover:bg-blue-50 text-slate-600 hover:text-blue-600 rounded-lg text-xs font-semibold transition-all border border-slate-200 hover:border-blue-200">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Edit
                            </a>
                            <form action="{{ route('admin.user-investments.destroy', $investment->id) }}" method="POST" onsubmit="return confirm('Delete this investment?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 hover:bg-red-50 text-slate-600 hover:text-red-600 rounded-lg text-xs font-semibold transition-all border border-slate-200 hover:border-red-200">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
