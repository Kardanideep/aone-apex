@extends('layouts.app')

@section('title', 'My Profile | AONE APEX ALLIANCE')

@section('content')
<section class="min-h-screen pt-28 pb-24 relative overflow-hidden">

    <!-- Subtle background glows -->
    <div class="absolute top-0 right-0 w-[700px] h-[700px] bg-brand-purple/8 rounded-full blur-[180px] pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-brand-pink/5 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-6xl mx-auto px-6 lg:px-12 relative z-10">

        <!-- Section label -->
        <div class="flex items-center gap-4 mb-16">
            <div class="h-[1px] w-8 bg-brand-pink"></div>
            <span class="uppercase tracking-[0.2em] text-xs text-brand-pink font-medium">Account</span>
        </div>

        <div class="grid lg:grid-cols-[360px_1fr] gap-12 lg:gap-24 items-start">

            {{-- ======= LEFT: Identity Sidebar ======= --}}
            <aside class="space-y-12">

                <!-- Avatar + Name -->
                <div>
                    <div class="relative inline-block mb-6">
                        <div class="w-28 h-28 rounded-full bg-gradient-to-br from-brand-pink to-brand-purple p-[2px]">
                            <div class="w-full h-full rounded-full bg-[#08060F] flex items-center justify-center text-3xl text-white font-serif select-none">
                                JD
                            </div>
                        </div>
                        <!-- Edit icon overlay -->
                        <button class="absolute bottom-0.5 right-0.5 w-8 h-8 rounded-full bg-[#1a0d30] border border-white/15 flex items-center justify-center hover:bg-brand-purple/60 transition-colors group" title="Change photo">
                            <svg class="w-3.5 h-3.5 text-gray-300 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                        </button>
                    </div>
                    <h1 class="font-serif text-3xl text-white mb-1 leading-tight">John Doe</h1>
                    <p class="text-gray-500 text-sm font-light">john.doe@example.com</p>
                </div>

                <!-- Status badge -->
                <div class="flex items-center gap-2 bg-brand-purple/10 border border-brand-purple/25 px-4 py-2.5 rounded-full w-fit">
                    <div class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></div>
                    <span class="text-xs uppercase tracking-widest text-brand-purple font-medium">Active Member</span>
                </div>

                <!-- Member stats -->
                <div class="border-t border-white/5 pt-10 space-y-0">
                    <div class="flex items-center justify-between py-4 border-b border-white/5 text-sm">
                        <span class="text-gray-500 font-light">Member Since</span>
                        <span class="text-white">June 2026</span>
                    </div>
                    <div class="flex items-center justify-between py-4 border-b border-white/5 text-sm">
                        <span class="text-gray-500 font-light">Investment Level</span>
                        <span class="font-medium" style="background: linear-gradient(to right, #FDE047, #D4AF37); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">$500 — Level 5</span>
                    </div>
                    <div class="flex items-center justify-between py-4 border-b border-white/5 text-sm">
                        <span class="text-gray-500 font-light">Direct Referrals</span>
                        <span class="text-white">12 members</span>
                    </div>
                    <div class="flex items-center justify-between py-4 text-sm">
                        <span class="text-gray-500 font-light">Total Earned</span>
                        <span class="text-brand-pink font-medium">$2,840.00</span>
                    </div>
                </div>

                <!-- Quick nav links -->
                <div class="border-t border-white/5 pt-6 space-y-0">
                    <a href="{{ route('password.change') }}"
                       class="group flex items-center justify-between py-3.5 text-gray-400 hover:text-white transition-colors text-sm border-b border-white/5">
                        <span>Change Password</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <a href="{{ route('packages') }}"
                       class="group flex items-center justify-between py-3.5 text-gray-400 hover:text-white transition-colors text-sm border-b border-white/5">
                        <span>View Packages</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <a href="{{ route('business-plan') }}"
                       class="group flex items-center justify-between py-3.5 text-gray-400 hover:text-white transition-colors text-sm">
                        <span>Income Plan</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </aside>

            {{-- ======= RIGHT: Edit Form ======= --}}
            <div>
                <div class="mb-12 pb-10 border-b border-white/5">
                    <h2 class="font-serif text-2xl md:text-3xl text-white mb-3">Personal Information</h2>
                    <p class="text-gray-500 font-light text-sm leading-relaxed">Keep your details accurate for a seamless experience across the AONE ecosystem.</p>
                </div>

                <form action="#" method="POST" class="space-y-10">

                    {{-- Full Name --}}
                    <div class="group">
                        <label for="name" class="block text-xs font-medium text-gray-500 uppercase tracking-widest mb-4">
                            Full Name
                        </label>
                        <input type="text" id="name" name="name" value="John Doe"
                            class="w-full bg-transparent border-0 border-b border-white/15 pb-3 text-white text-base focus:outline-none focus:border-brand-pink transition-colors duration-300"
                            required>
                    </div>

                    {{-- Email + Phone --}}
                    <div class="grid sm:grid-cols-2 gap-10">
                        <div class="group">
                            <label for="email" class="block text-xs font-medium text-gray-500 uppercase tracking-widest mb-4">
                                Email Address
                            </label>
                            <input type="email" id="email" name="email" value="john.doe@example.com"
                                class="w-full bg-transparent border-0 border-b border-white/15 pb-3 text-white text-base focus:outline-none focus:border-brand-pink transition-colors duration-300"
                                required>
                        </div>
                        <div class="group">
                            <label for="phone" class="block text-xs font-medium text-gray-500 uppercase tracking-widest mb-4">
                                Phone Number
                            </label>
                            <input type="tel" id="phone" name="phone" value="+1 (555) 123-4567"
                                class="w-full bg-transparent border-0 border-b border-white/15 pb-3 text-white text-base focus:outline-none focus:border-brand-pink transition-colors duration-300">
                        </div>
                    </div>

                    {{-- Wallet address --}}
                    <div class="group">
                        <label for="wallet" class="block text-xs font-medium text-gray-500 uppercase tracking-widest mb-4">
                            Withdrawal Wallet Address
                        </label>
                        <input type="text" id="wallet" name="wallet" placeholder="0x…"
                            class="w-full bg-transparent border-0 border-b border-white/15 pb-3 text-white text-base placeholder-gray-700 focus:outline-none focus:border-brand-pink transition-colors duration-300">
                        <p class="mt-3 text-xs text-gray-600 font-light">TRC20 and ERC20 addresses only. Double-check before saving.</p>
                    </div>

                    {{-- Country --}}
                    <div class="group">
                        <label for="country" class="block text-xs font-medium text-gray-500 uppercase tracking-widest mb-4">
                            Country
                        </label>
                        <input type="text" id="country" name="country" placeholder="e.g. United States"
                            class="w-full bg-transparent border-0 border-b border-white/15 pb-3 text-white text-base placeholder-gray-700 focus:outline-none focus:border-brand-pink transition-colors duration-300">
                    </div>

                    {{-- Save button —— underline arrow style, no big gradient button --}}
                    <div class="pt-6 flex flex-wrap items-center gap-8">
                        <button type="submit"
                            class="group flex items-center gap-4 border-b border-white/30 pb-1.5 hover:border-brand-pink transition-colors text-white">
                            <span class="text-sm uppercase tracking-widest">Save Changes</span>
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </button>
                        <span class="text-xs text-gray-600 font-light">Changes reflect immediately across your account</span>
                    </div>

                </form>
            </div>

        </div>
    </div>
</section>
@endsection
