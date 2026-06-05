@extends('layouts.auth')

@section('title', 'Log In | AONE APEX ALLIANCE')

@section('content')
<div class="min-h-screen flex">

    {{-- LEFT PANEL — Brand Identity --}}
    <div class="hidden lg:flex lg:w-1/2 relative flex-col justify-between p-14 overflow-hidden" style="background: linear-gradient(135deg, #0d0a1a 0%, #12082a 50%, #1a0a20 100%);">

        {{-- Decorative orbs --}}
        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-brand-purple/20 rounded-full blur-[120px] -translate-x-1/2 -translate-y-1/3 pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-brand-pink/15 rounded-full blur-[100px] translate-x-1/3 translate-y-1/4 pointer-events-none"></div>

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
            <div class="h-12 w-1 bg-gradient-to-b from-brand-pink to-brand-purple rounded-full mb-8"></div>
            <p class="font-serif text-3xl text-white leading-relaxed mb-6">
                "Your journey to financial freedom starts with a single, confident step."
            </p>
            <p class="text-gray-400 font-light text-sm leading-relaxed">
                Join thousands of members who are already growing their wealth daily through the AONE ecosystem.
            </p>
        </div>

        {{-- Bottom stats --}}
        <div class="relative z-10 flex gap-10">
            <div>
                <div class="font-serif text-3xl text-white">1%</div>
                <div class="text-xs text-gray-500 uppercase tracking-widest mt-1">Daily Returns</div>
            </div>
            <div class="w-px bg-white/10"></div>
            <div>
                <div class="font-serif text-3xl text-white">7</div>
                <div class="text-xs text-gray-500 uppercase tracking-widest mt-1">Working Days</div>
            </div>
            <div class="w-px bg-white/10"></div>
            <div>
                <div class="font-serif text-3xl text-white">100%</div>
                <div class="text-xs text-gray-500 uppercase tracking-widest mt-1">Guaranteed</div>
            </div>
        </div>
    </div>

    {{-- RIGHT PANEL — Login Form --}}
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
                <h1 class="font-serif text-4xl text-white mb-3">Good to see you again.</h1>
                <p class="text-gray-500 font-light text-base">Sign in to your account and keep the momentum going.</p>
            </div>

            {{-- Form --}}
            <form action="{{ route('profile') }}" method="GET" class="space-y-6">

                {{-- Email --}}
                <div class="group">
                    <label for="email" class="block text-xs font-medium text-gray-500 uppercase tracking-widest mb-3">Your Email</label>
                    <input type="email" id="email" name="email"
                        class="w-full bg-transparent border-0 border-b border-white/15 pb-3 text-white text-base placeholder-gray-700 focus:outline-none focus:border-brand-pink transition-colors duration-300"
                        placeholder="you@example.com" required>
                </div>

                {{-- Password --}}
                <div class="group">
                    <div class="flex items-center justify-between mb-3">
                        <label for="password" class="block text-xs font-medium text-gray-500 uppercase tracking-widest">Password</label>
                        <a href="{{ route('password.request') }}" class="text-xs text-gray-500 hover:text-brand-pink transition-colors">Forgot it?</a>
                    </div>
                    <input type="password" id="password" name="password"
                        class="w-full bg-transparent border-0 border-b border-white/15 pb-3 text-white text-base placeholder-gray-700 focus:outline-none focus:border-brand-pink transition-colors duration-300"
                        placeholder="••••••••" required>
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center gap-3 pt-2">
                    <input id="remember_me" type="checkbox"
                        class="w-4 h-4 border border-white/20 bg-transparent rounded-sm text-brand-purple focus:ring-0 cursor-pointer">
                    <label for="remember_me" class="text-sm text-gray-500 cursor-pointer hover:text-gray-300 transition-colors">
                        Keep me signed in
                    </label>
                </div>

                {{-- Submit --}}
                <div class="pt-4">
                    <button type="submit"
                        class="w-full flex items-center justify-between bg-white text-[#030009] font-medium py-4 px-7 rounded-xl group hover:bg-brand-pink hover:text-white transition-all duration-300">
                        <span class="text-sm uppercase tracking-widest">Sign In</span>
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

            {{-- Register link --}}
            <p class="text-center text-sm text-gray-500">
                New to AONE?
                <a href="{{ route('register') }}" class="text-white font-medium hover:text-brand-pink transition-colors ml-1">
                    Create a free account →
                </a>
            </p>
        </div>
    </div>

</div>
@endsection
