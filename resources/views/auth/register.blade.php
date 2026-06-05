@extends('layouts.auth')

@section('title', 'Create Account | AONE APEX ALLIANCE')

@section('content')
<div class="min-h-screen flex">

    {{-- LEFT PANEL — Brand Identity --}}
    <div class="hidden lg:flex lg:w-1/2 relative flex-col justify-between p-14 overflow-hidden" style="background: linear-gradient(135deg, #0d0a1a 0%, #12082a 50%, #1a0a20 100%);">

        {{-- Decorative orbs --}}
        <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-brand-pink/15 rounded-full blur-[100px] translate-x-1/3 -translate-y-1/4 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-brand-purple/20 rounded-full blur-[120px] -translate-x-1/2 translate-y-1/4 pointer-events-none"></div>

        {{-- Fine grid overlay --}}
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: linear-gradient(rgba(255,255,255,0.5) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.5) 1px, transparent 1px); background-size: 40px 40px;"></div>

        {{-- Logo --}}
        <div class="relative z-10">
            <a href="{{ route('home') }}" class="font-serif font-bold text-2xl tracking-wide text-white hover:opacity-80 transition-opacity">
                AONE <span class="text-gradient text-sm uppercase tracking-widest font-sans ml-1">Apex</span>
            </a>
        </div>

        {{-- Central Quote --}}
        <div class="relative z-10 max-w-sm">
            <div class="flex gap-3 mb-8">
                <div class="w-8 h-1 bg-brand-pink rounded-full"></div>
                <div class="w-3 h-1 bg-brand-purple rounded-full"></div>
                <div class="w-1 h-1 bg-white/30 rounded-full"></div>
            </div>
            <p class="font-serif text-3xl text-white leading-relaxed mb-6">
                "The best investment you can make is in an ecosystem built to grow with you."
            </p>
            <ul class="space-y-3 mt-8">
                <li class="flex items-center gap-3 text-gray-400 font-light text-sm">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-pink flex-shrink-0"></span>
                    100% Guaranteed Income Structure
                </li>
                <li class="flex items-center gap-3 text-gray-400 font-light text-sm">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-purple flex-shrink-0"></span>
                    1% Daily Returns, 7 Working Days a Week
                </li>
                <li class="flex items-center gap-3 text-gray-400 font-light text-sm">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-pink flex-shrink-0"></span>
                    Worldwide Community of Members
                </li>
                <li class="flex items-center gap-3 text-gray-400 font-light text-sm">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-purple flex-shrink-0"></span>
                    Multiple Income Streams & Referral Bonuses
                </li>
            </ul>
        </div>

        {{-- Bottom trust line --}}
        <div class="relative z-10">
            <p class="text-xs text-gray-600 font-light tracking-widest uppercase">
                Secure · Transparent · Verified
            </p>
        </div>
    </div>

    {{-- RIGHT PANEL — Registration Form --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center px-8 py-20 lg:px-16 bg-[#030009]">
        <div class="w-full max-w-md">

            {{-- Mobile logo --}}
            <div class="lg:hidden mb-10">
                <a href="{{ route('home') }}" class="font-serif font-bold text-2xl tracking-wide text-white">
                    AONE <span class="text-gradient text-sm uppercase tracking-widest font-sans ml-1">Apex</span>
                </a>
            </div>

            {{-- Heading --}}
            <div class="mb-10">
                <h1 class="font-serif text-4xl text-white mb-3">Start your journey.</h1>
                <p class="text-gray-500 font-light text-base">Create your account. It takes less than two minutes.</p>
            </div>

            {{-- Form --}}
            <form action="{{ route('profile') }}" method="GET" class="space-y-6">

                {{-- Full Name --}}
                <div>
                    <label for="name" class="block text-xs font-medium text-gray-500 uppercase tracking-widest mb-3">Full Name</label>
                    <input type="text" id="name" name="name"
                        class="w-full bg-transparent border-0 border-b border-white/15 pb-3 text-white text-base placeholder-gray-700 focus:outline-none focus:border-brand-purple transition-colors duration-300"
                        placeholder="e.g. Ravi Sharma" required>
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-xs font-medium text-gray-500 uppercase tracking-widest mb-3">Email Address</label>
                    <input type="email" id="email" name="email"
                        class="w-full bg-transparent border-0 border-b border-white/15 pb-3 text-white text-base placeholder-gray-700 focus:outline-none focus:border-brand-purple transition-colors duration-300"
                        placeholder="you@example.com" required>
                </div>

                {{-- Password row --}}
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label for="password" class="block text-xs font-medium text-gray-500 uppercase tracking-widest mb-3">Password</label>
                        <input type="password" id="password" name="password"
                            class="w-full bg-transparent border-0 border-b border-white/15 pb-3 text-white text-base placeholder-gray-700 focus:outline-none focus:border-brand-purple transition-colors duration-300"
                            placeholder="Min. 8 chars" required>
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-xs font-medium text-gray-500 uppercase tracking-widest mb-3">Confirm</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="w-full bg-transparent border-0 border-b border-white/15 pb-3 text-white text-base placeholder-gray-700 focus:outline-none focus:border-brand-purple transition-colors duration-300"
                            placeholder="Repeat password" required>
                    </div>
                </div>

                {{-- Terms --}}
                <div class="flex items-start gap-3 pt-2">
                    <input id="terms" name="terms" type="checkbox"
                        class="w-4 h-4 mt-0.5 border border-white/20 bg-transparent rounded-sm text-brand-purple focus:ring-0 cursor-pointer flex-shrink-0" required>
                    <label for="terms" class="text-sm text-gray-500 leading-relaxed cursor-pointer">
                        I've read and agree to the
                        <a href="#" class="text-white hover:text-brand-pink transition-colors">Terms of Service</a>
                        and
                        <a href="#" class="text-white hover:text-brand-pink transition-colors">Privacy Policy</a>.
                    </label>
                </div>

                {{-- Submit --}}
                <div class="pt-4">
                    <button type="submit"
                        class="w-full flex items-center justify-between bg-white text-[#030009] font-medium py-4 px-7 rounded-xl group hover:bg-brand-purple hover:text-white transition-all duration-300">
                        <span class="text-sm uppercase tracking-widest">Create Account</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </button>
                </div>
            </form>

            {{-- Divider --}}
            <div class="flex items-center gap-4 my-8">
                <div class="flex-1 h-px bg-white/8"></div>
                <span class="text-xs text-gray-600 uppercase tracking-widest">or</span>
                <div class="flex-1 h-px bg-white/8"></div>
            </div>

            {{-- Login link --}}
            <p class="text-center text-sm text-gray-500">
                Already a member?
                <a href="{{ route('login') }}" class="text-white font-medium hover:text-brand-purple transition-colors ml-1">
                    Sign in instead →
                </a>
            </p>
        </div>
    </div>

</div>
@endsection
