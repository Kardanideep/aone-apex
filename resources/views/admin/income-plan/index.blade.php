@extends('layouts.admin')

@section('title', 'Income Plan Management | AONE APEX Admin')

@section('content')

<!-- Header -->
<div class="mb-6">
    <h1 class="font-serif text-2xl text-slate-800 font-bold mb-1">Income Plan Management</h1>
    <p class="text-slate-500 text-sm">Manage commission and income percentages displayed on the Business Plan page.</p>
</div>

@if (session('success'))
    <div class="mb-5 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 p-4 rounded-xl text-sm">
        <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        {{ session('success') }}
    </div>
@endif

<div class="max-w-4xl">
    <form action="{{ route('admin.income-plan.update') }}" method="POST">
        @csrf

        <div class="space-y-6">

            <!-- Direct Income -->
            <div class="admin-card rounded-xl overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-violet-100 flex items-center justify-center">
                        <svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-slate-800">Direct Income</h2>
                        <p class="text-xs text-slate-400">Commission earned from direct referrals</p>
                    </div>
                </div>
                <div class="p-6">
                    <div class="max-w-sm">
                        <label for="direct_commission_percent" class="block text-xs font-bold text-slate-700 mb-2">Direct Referral Commission (%)</label>
                        <div class="relative">
                            <input type="number" step="0.01" min="0" max="100" name="direct_commission_percent" id="direct_commission_percent"
                                value="{{ old('direct_commission_percent', $settings['direct_commission_percent'] ?? 5) }}"
                                class="w-full px-4 py-3 border border-slate-300 rounded-xl bg-slate-50 text-slate-700 text-sm focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 focus:bg-white transition-all pr-10">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm font-semibold">%</span>
                        </div>
                        @error('direct_commission_percent')
                            <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-xs text-slate-400">💡 This percentage is paid to users for each direct referral they make.</p>
                    </div>
                </div>
            </div>

            <!-- Salary Plan (Daily Income) -->
            <div class="admin-card rounded-xl overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-slate-800">Salary Plan</h2>
                        <p class="text-xs text-slate-400">Daily return on user investment amount</p>
                    </div>
                </div>
                <div class="p-6">
                    <div class="max-w-sm">
                        <label for="daily_investment_percent" class="block text-xs font-bold text-slate-700 mb-2">Daily Investment Return (%)</label>
                        <div class="relative">
                            <input type="number" step="0.01" min="0" max="100" name="daily_investment_percent" id="daily_investment_percent"
                                value="{{ old('daily_investment_percent', $settings['daily_investment_percent'] ?? 1) }}"
                                class="w-full px-4 py-3 border border-slate-300 rounded-xl bg-slate-50 text-slate-700 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 focus:border-emerald-400 focus:bg-white transition-all pr-10">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm font-semibold">%</span>
                        </div>
                        @error('daily_investment_percent')
                            <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-xs text-slate-400">💡 Daily percentage return calculated on the user's total investment amount.</p>
                    </div>
                </div>
            </div>

            <!-- Level Income -->
            <div class="admin-card rounded-xl overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-pink-100 flex items-center justify-center">
                        <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-slate-800">Level Income</h2>
                        <p class="text-xs text-slate-400">Multi-level network income percentages</p>
                    </div>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full admin-table">
                            <thead>
                                <tr>
                                    <th class="rounded-tl-lg">Level</th>
                                    <th>Description</th>
                                    <th class="rounded-tr-lg text-center">Percentage (%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-violet-100 text-violet-700 text-xs font-bold">1</span>
                                            Level 1
                                        </div>
                                    </td>
                                    <td class="text-slate-500">Direct referral income</td>
                                    <td class="text-center">
                                        <input type="number" step="0.01" min="0" max="100" name="level_1_percent"
                                            value="{{ old('level_1_percent', $settings['level_1_percent'] ?? 10) }}"
                                            class="w-24 mx-auto px-3 py-2 border border-slate-300 rounded-lg bg-slate-50 text-slate-700 text-sm text-center focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 focus:bg-white transition-all">
                                        @error('level_1_percent') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-pink-100 text-pink-700 text-xs font-bold">2</span>
                                            Level 2
                                        </div>
                                    </td>
                                    <td class="text-slate-500">Second-tier network income</td>
                                    <td class="text-center">
                                        <input type="number" step="0.01" min="0" max="100" name="level_2_percent"
                                            value="{{ old('level_2_percent', $settings['level_2_percent'] ?? 7) }}"
                                            class="w-24 mx-auto px-3 py-2 border border-slate-300 rounded-lg bg-slate-50 text-slate-700 text-sm text-center focus:outline-none focus:ring-2 focus:ring-pink-300 focus:border-pink-400 focus:bg-white transition-all">
                                        @error('level_2_percent') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-emerald-100 text-emerald-700 text-xs font-bold">3</span>
                                            Level 3
                                        </div>
                                    </td>
                                    <td class="text-slate-500">Third-tier network income</td>
                                    <td class="text-center">
                                        <input type="number" step="0.01" min="0" max="100" name="level_3_percent"
                                            value="{{ old('level_3_percent', $settings['level_3_percent'] ?? 6) }}"
                                            class="w-24 mx-auto px-3 py-2 border border-slate-300 rounded-lg bg-slate-50 text-slate-700 text-sm text-center focus:outline-none focus:ring-2 focus:ring-emerald-300 focus:border-emerald-400 focus:bg-white transition-all">
                                        @error('level_3_percent') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-amber-100 text-amber-700 text-xs font-bold">4</span>
                                            Level 4
                                        </div>
                                    </td>
                                    <td class="text-slate-500">Fourth-tier network income</td>
                                    <td class="text-center">
                                        <input type="number" step="0.01" min="0" max="100" name="level_4_percent"
                                            value="{{ old('level_4_percent', $settings['level_4_percent'] ?? 3) }}"
                                            class="w-24 mx-auto px-3 py-2 border border-slate-300 rounded-lg bg-slate-50 text-slate-700 text-sm text-center focus:outline-none focus:ring-2 focus:ring-amber-300 focus:border-amber-400 focus:bg-white transition-all">
                                        @error('level_4_percent') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-cyan-100 text-cyan-700 text-xs font-bold">5</span>
                                            Level 5
                                        </div>
                                    </td>
                                    <td class="text-slate-500">Passive network income</td>
                                    <td class="text-center">
                                        <input type="number" step="0.01" min="0" max="100" name="level_5_percent"
                                            value="{{ old('level_5_percent', $settings['level_5_percent'] ?? 2) }}"
                                            class="w-24 mx-auto px-3 py-2 border border-slate-300 rounded-lg bg-slate-50 text-slate-700 text-sm text-center focus:outline-none focus:ring-2 focus:ring-cyan-300 focus:border-cyan-400 focus:bg-white transition-all">
                                        @error('level_5_percent') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <!-- Save Button -->
        <div class="mt-6 flex items-center justify-between p-5 bg-white border border-slate-200 rounded-xl shadow-sm">
            <p class="text-xs text-slate-400">Changes are saved immediately and reflected on the public Business Plan page.</p>
            <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-violet-600 to-pink-500 hover:from-violet-700 hover:to-pink-600 text-white text-sm font-semibold rounded-xl transition-all shadow-sm hover:shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Save Income Plan
            </button>
        </div>
    </form>
</div>

@endsection
