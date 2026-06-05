@extends('layouts.app')

@section('title', 'Investment Packages | AONE APEX ALLIANCE')

@section('content')

    <!-- Page Header -->
    <section class="pt-32 md:pt-48 pb-16 md:pb-20 relative overflow-hidden">
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-brand-pink/10 rounded-full blur-[150px] pointer-events-none"></div>
        <div class="max-w-4xl mx-auto px-6 lg:px-12 text-center relative z-10">
            <div class="flex items-center justify-center gap-4 mb-6">
                <div class="h-[1px] w-8 bg-brand-purple"></div>
                <span class="uppercase tracking-[0.2em] text-xs text-brand-purple font-medium">Investment Tiers</span>
                <div class="h-[1px] w-8 bg-brand-purple"></div>
            </div>
            <h1 class="font-serif text-5xl md:text-7xl mb-6 text-white leading-tight">
                Choose Your <br><em class="font-light italic text-gray-400">Opportunity.</em>
            </h1>
            <p class="text-lg text-gray-400 font-light max-w-2xl mx-auto">
                Explore our dynamic package options designed to fit every level of commitment. Secure your place in the global ecosystem.
            </p>
        </div>
    </section>

    <!-- Packages Grid -->
    <section class="py-12 relative z-10">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            @php
                $packages = [20, 50, 100, 200, 500, 1000, 2000, 5000, 10000, 20000];
            @endphp
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 xl:gap-8">
                @foreach($packages as $amount)
                <a href="{{ route('business-plan') }}" class="package-card relative group bg-white/[0.02] border border-white/5 rounded-3xl p-8 flex flex-col justify-between overflow-hidden">
                    <!-- Hover gradient background -->
                    <div class="absolute inset-0 bg-gradient-to-br from-brand-pink/5 to-brand-purple/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    
                    <div class="relative z-10">
                        <div class="text-xs uppercase tracking-widest text-gray-500 mb-6">Tier {{ $loop->iteration }}</div>
                        <div class="flex items-start gap-1 mb-8">
                            <span class="text-3xl font-light text-brand-pink mt-1">$</span>
                            <h2 class="font-serif text-5xl text-white">{{ number_format($amount) }}</h2>
                        </div>
                    </div>
                    
                    <div class="relative z-10 mt-auto pt-8 border-t border-white/5">
                        <div class="flex items-center justify-between group-hover:text-white text-gray-400 transition-colors">
                            <span class="text-sm tracking-wide">View Details</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Investment Quote Banner -->
    <section class="py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-brand-pink/10 via-brand-purple/10 to-brand-pink/5 pointer-events-none"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[300px] bg-brand-purple/20 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="max-w-5xl mx-auto px-6 lg:px-12 relative z-10 text-center">
            <!-- Top decorative line -->
            <div class="flex items-center justify-center gap-6 mb-10">
                <div class="h-[1px] flex-1 max-w-[80px] bg-gradient-to-r from-transparent to-brand-pink"></div>
                <div class="w-2 h-2 rounded-full bg-brand-pink"></div>
                <div class="h-[1px] flex-1 max-w-[80px] bg-gradient-to-l from-transparent to-brand-pink"></div>
            </div>

            <blockquote class="font-serif text-2xl sm:text-3xl md:text-4xl lg:text-5xl text-white leading-[1.3] font-light">
                <span class="text-brand-pink text-6xl leading-none font-serif">&ldquo;</span>
                <span>Invest smartly today&mdash;<br class="hidden sm:block">earn
                    <span class="relative inline-block">
                        <span class="text-gradient font-semibold">1% daily returns</span>
                    </span>
                    with income flowing
                    <span class="text-gradient font-semibold">7 working days</span>
                    a week.
                </span>
                <span class="text-brand-pink text-6xl leading-none font-serif">&rdquo;</span>
            </blockquote>

            <!-- Bottom decorative line -->
            <div class="flex items-center justify-center gap-6 mt-10">
                <div class="h-[1px] flex-1 max-w-[80px] bg-gradient-to-r from-transparent to-brand-purple"></div>
                <div class="w-2 h-2 rounded-full bg-brand-purple"></div>
                <div class="h-[1px] flex-1 max-w-[80px] bg-gradient-to-l from-transparent to-brand-purple"></div>
            </div>

            <div class="mt-12">
                <a href="{{ route('business-plan') }}" class="inline-flex items-center gap-3 bg-gradient-to-r from-brand-pink to-brand-purple hover:from-brand-purple hover:to-brand-pink text-white font-medium px-10 py-4 rounded-full transition-all duration-300 transform hover:-translate-y-0.5 shadow-[0_0_30px_rgba(213,63,140,0.3)] text-sm uppercase tracking-widest">
                    View Income Plan
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
    </section>

@endsection
