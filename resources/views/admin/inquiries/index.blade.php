@extends('layouts.admin')

@section('title', 'Inquiries | AONE APEX')

@section('content')

<!-- Header -->
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="font-serif text-2xl text-slate-800 font-bold mb-1">Inquiry Management</h1>
        <p class="text-slate-500 text-sm">View and manage all contact form submissions.</p>
    </div>
    <div class="flex items-center gap-2 text-sm text-slate-500">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
        <span>{{ $inquiries->total() }} total</span>
    </div>
</div>

<!-- Table Card -->
<div class="admin-card rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full admin-table">
            <thead>
                <tr>
                    <th class="w-8 pl-6"></th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th class="text-right pr-6">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inquiries as $inquiry)
                <tr class="{{ !$inquiry->is_read ? 'bg-violet-50/40' : '' }}">
                    <td class="pl-6">
                        @if(!$inquiry->is_read)
                            <span class="block w-2.5 h-2.5 rounded-full bg-violet-500 shadow-sm shadow-violet-200" title="Unread"></span>
                        @endif
                    </td>
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-400 to-cyan-400 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                {{ strtoupper(substr($inquiry->name, 0, 1)) }}
                            </div>
                            <span class="font-semibold {{ !$inquiry->is_read ? 'text-slate-900' : 'text-slate-600' }} text-sm">{{ $inquiry->name }}</span>
                        </div>
                    </td>
                    <td>
                        <span class="text-slate-600 text-sm">{{ $inquiry->phone }}</span>
                    </td>
                    <td>
                        @if($inquiry->email)
                            <span class="text-slate-600 text-sm">{{ $inquiry->email }}</span>
                        @else
                            <span class="text-slate-300 text-xs italic">Not provided</span>
                        @endif
                    </td>
                    <td>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold bg-violet-100 text-violet-700 border border-violet-200">
                            {{ $inquiry->subject }}
                        </span>
                    </td>
                    <td>
                        <div class="text-slate-600 text-sm">{{ $inquiry->created_at->format('M d, Y') }}</div>
                        <div class="text-xs text-slate-400">{{ $inquiry->created_at->format('h:i A') }}</div>
                    </td>
                    <td class="text-right pr-6">
                        <a href="{{ route('admin.inquiries.show', $inquiry->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 hover:bg-violet-600 hover:text-white text-slate-600 rounded-lg text-xs font-semibold transition-all border border-slate-200 hover:border-violet-600 hover:shadow-sm">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            View
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-16">
                        <svg class="w-12 h-12 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                        <p class="text-slate-400 font-medium">No inquiries received yet.</p>
                        <p class="text-xs text-slate-300 mt-1">When users submit contact forms, they'll appear here.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($inquiries->hasPages())
    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50">
        {{ $inquiries->links() }}
    </div>
    @endif
</div>

@endsection
