@extends('layouts.admin')

@section('title', 'Edit User Investment | AONE APEX')

@section('content')

<!-- Header -->
<div class="mb-6">
    <div class="flex items-center gap-3 mb-1">
        <a href="{{ route('admin.user-investments.index') }}" class="w-9 h-9 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-slate-500 hover:text-violet-600 hover:border-violet-200 hover:bg-violet-50 transition-all shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h1 class="font-serif text-2xl text-slate-800 font-bold">Edit Investment #{{ $investment->id }}</h1>
            <p class="text-slate-500 text-sm">Update the details of this user investment.</p>
        </div>
    </div>
</div>

<div class="max-w-2xl">
    <div class="admin-card rounded-xl p-8">
        <form action="{{ route('admin.user-investments.update', $investment->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="space-y-6">

                <!-- User Name -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2" for="user_name">
                        User Name <span class="text-red-400">*</span>
                    </label>
                    <input
                        id="user_name"
                        name="user_name"
                        type="text"
                        value="{{ old('user_name', $investment->user_name) }}"
                        required
                        placeholder="e.g. John Doe"
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl bg-white text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 transition-all text-sm"
                    />
                    @error('user_name')
                        <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p>
                    @enderror
                </div>

                <!-- Investment Amount -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2" for="investment_amount">
                        Investment Amount ($) <span class="text-red-400">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 font-medium">$</span>
                        <input
                            id="investment_amount"
                            name="investment_amount"
                            type="number"
                            step="0.01"
                            min="0"
                            value="{{ old('investment_amount', $investment->investment_amount) }}"
                            required
                            placeholder="0.00"
                            class="w-full pl-8 pr-4 py-3 border border-slate-300 rounded-xl bg-white text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 transition-all text-sm"
                        />
                    </div>
                    @error('investment_amount')
                        <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p>
                    @enderror
                </div>

                <!-- User Image -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2" for="user_img">
                        User Image
                    </label>
                    @if($investment->user_img)
                        <div class="mb-3">
                            <img src="{{ asset('storage/'.$investment->user_img) }}" class="w-16 h-16 rounded-lg object-cover border border-slate-200">
                        </div>
                    @endif
                    <input
                        id="user_img"
                        name="user_img"
                        type="file"
                        accept="image/*"
                        class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 transition-all text-sm"
                    />
                    <p class="text-xs text-slate-500 mt-1">Leave empty to keep the current image.</p>
                    @error('user_img')
                        <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Actions -->
            <div class="mt-8 flex items-center gap-3 pt-6 border-t border-slate-100">
                <button type="submit" class="px-6 py-2.5 bg-violet-600 hover:bg-violet-700 text-white text-sm font-semibold rounded-xl transition-colors shadow-sm">
                    Update Investment
                </button>
                <a href="{{ route('admin.user-investments.index') }}" class="px-6 py-2.5 bg-white hover:bg-slate-50 text-slate-600 text-sm font-semibold rounded-xl transition-colors border border-slate-200">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
