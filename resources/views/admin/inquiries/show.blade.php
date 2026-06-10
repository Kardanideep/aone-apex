@extends('layouts.admin')

@section('title', 'Inquiry Details | AONE APEX')

@section('content')

<!-- Header -->
<div class="mb-6">
    <div class="flex items-center gap-3 mb-1">
        <a href="{{ route('admin.inquiries.index') }}" class="w-9 h-9 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-slate-500 hover:text-violet-600 hover:border-violet-200 hover:bg-violet-50 transition-all shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h1 class="font-serif text-2xl text-slate-800 font-bold">Inquiry Details</h1>
            <p class="text-slate-500 text-sm">Submitted by <span class="font-medium text-slate-700">{{ $inquiry->name }}</span></p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Left: Contact Info -->
    <div class="lg:col-span-1 space-y-5">

        <!-- Contact Card -->
        <div class="admin-card rounded-xl p-6">
            <h3 class="text-base text-slate-800 font-bold mb-5">Contact Information</h3>

            <div class="space-y-4">
                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div>
                        <div class="text-[10px] text-slate-400 uppercase tracking-widest font-semibold mb-0.5">Full Name</div>
                        <div class="text-slate-800 font-semibold text-sm">{{ $inquiry->name }}</div>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 rounded-lg bg-emerald-50 border border-emerald-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </div>
                    <div>
                        <div class="text-[10px] text-slate-400 uppercase tracking-widest font-semibold mb-0.5">Phone</div>
                        <div class="text-slate-800 font-semibold text-sm">{{ $inquiry->phone }}</div>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 rounded-lg bg-violet-50 border border-violet-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <div class="text-[10px] text-slate-400 uppercase tracking-widest font-semibold mb-0.5">Email</div>
                        @if($inquiry->email)
                            <div class="text-slate-800 font-semibold text-sm">{{ $inquiry->email }}</div>
                        @else
                            <div class="text-slate-400 italic text-sm">Not provided</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Meta Info -->
        <div class="admin-card rounded-xl p-6">
            <h3 class="text-sm font-bold text-slate-700 mb-4">Inquiry Meta</h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center text-sm">
                    <span class="text-slate-400">Inquiry ID</span>
                    <span class="text-slate-700 font-mono font-bold bg-slate-100 px-2 py-0.5 rounded text-xs">#{{ str_pad($inquiry->id, 5, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <span class="text-slate-400">Submitted</span>
                    <span class="text-slate-700 font-medium text-xs">{{ $inquiry->created_at->format('M d, Y — h:i A') }}</span>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <span class="text-slate-400">Status</span>
                    @if($inquiry->is_read)
                        <span class="text-emerald-600 font-semibold text-xs bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-200">✓ Read</span>
                    @else
                        <span class="text-violet-600 font-semibold text-xs bg-violet-50 px-2.5 py-1 rounded-full border border-violet-200">● Unread</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Right: Message Body -->
    <div class="lg:col-span-2">
        <div class="admin-card rounded-xl p-6 h-full">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="text-base text-slate-800 font-bold">Message</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Full inquiry content</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold bg-violet-100 text-violet-700 border border-violet-200">
                    {{ $inquiry->subject }}
                </span>
            </div>

            <div class="bg-slate-50 border border-slate-200 rounded-xl p-6">
                <p class="text-slate-700 leading-relaxed whitespace-pre-wrap text-sm">{{ $inquiry->message }}</p>
            </div>
        </div>
    </div>

</div>
@endsection
