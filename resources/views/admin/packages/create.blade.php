@extends('layouts.admin')

@section('title', 'Create Package | AONE APEX')

@section('content')

<!-- Header -->
<div class="mb-6">
    <div class="flex items-center gap-3 mb-1">
        <a href="{{ route('admin.packages.index') }}" class="w-9 h-9 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-slate-500 hover:text-violet-600 hover:border-violet-200 hover:bg-violet-50 transition-all shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h1 class="font-serif text-2xl text-slate-800 font-bold">Create New Package</h1>
            <p class="text-slate-500 text-sm">Add a new investment plan to the system.</p>
        </div>
    </div>
</div>

<div class="max-w-2xl">
    <div class="admin-card rounded-xl p-8">
        <form action="{{ route('admin.packages.store') }}" method="POST">
            @csrf
            <div class="space-y-6">

                <!-- Package Name -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2" for="name">
                        Package Name <span class="text-red-400">*</span>
                    </label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        value="{{ old('name') }}"
                        required
                        placeholder="e.g. Starter Plan"
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl bg-white text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 transition-all text-sm"
                    />
                    @error('name')
                        <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p>
                    @enderror
                </div>

                <!-- Amount -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2" for="amount">
                        Amount ($) <span class="text-red-400">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 font-medium">$</span>
                        <input
                            id="amount"
                            name="amount"
                            type="number"
                            step="0.01"
                            min="0"
                            value="{{ old('amount') }}"
                            required
                            placeholder="0.00"
                            class="w-full pl-8 pr-4 py-3 border border-slate-300 rounded-xl bg-white text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 transition-all text-sm"
                        />
                    </div>
                    @error('amount')
                        <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status Toggle -->
                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl border border-slate-200">
                    <div>
                        <div class="text-sm font-semibold text-slate-700">Active Status</div>
                        <div class="text-xs text-slate-400 mt-0.5">Package will be visible to users when active</div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="status" class="sr-only peer" checked>
                        <div class="w-10 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-violet-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-violet-600"></div>
                    </label>
                </div>

            </div>

            <!-- Actions -->
            <div class="mt-8 flex items-center gap-3 pt-6 border-t border-slate-100">
                <button type="submit" class="px-6 py-2.5 bg-violet-600 hover:bg-violet-700 text-white text-sm font-semibold rounded-xl transition-colors shadow-sm">
                    Create Package
                </button>
                <a href="{{ route('admin.packages.index') }}" class="px-6 py-2.5 bg-white hover:bg-slate-50 text-slate-600 text-sm font-semibold rounded-xl transition-colors border border-slate-200">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
