@extends('layouts.app')

@section('title', 'About Us | AONE APEX ALLIANCE')

@section('content')

    <!-- Page Header -->
    <section class="pt-32 md:pt-48 pb-16 md:pb-20 relative overflow-hidden">
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-brand-purple/10 rounded-full blur-[150px] pointer-events-none">
        </div>
        <div class="max-w-4xl mx-auto px-6 lg:px-12 text-center relative z-10">
            <div class="flex items-center justify-center gap-4 mb-6">
                <div class="h-[1px] w-8 bg-brand-pink"></div>
                <span class="uppercase tracking-[0.2em] text-xs text-brand-pink font-medium">Our Identity</span>
                <div class="h-[1px] w-8 bg-brand-pink"></div>
            </div>
            <h1 class="font-serif text-4xl sm:text-5xl md:text-7xl mb-6 text-white leading-tight">
                Global Commodity And Networking
            </h1>
            <p class="text-lg text-gray-400 font-light max-w-2xl mx-auto">
                We are building more than a company — we are building a powerful digital movement designed for the future.
            </p>
        </div>
    </section>

    <!-- Company Introduction -->
    <section class="py-24 relative border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col gap-20">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="font-serif text-3xl md:text-5xl mb-8 text-white">About AONE Apex Alliance</h2>
                <div class="prose prose-invert font-light text-gray-300 leading-relaxed mx-auto text-lg">
                    <p class="text-xl mb-6">
                        Aone Apex Alliance is a globally operating decentralized smart contract project focused on
                        real-world commodity trade and networking income.
                    </p>
                    <p>
                        The company operates on a plan-networking model through a worldwide system, ensuring transparent,
                        reliable, and continuous growth for all our members. We bridge the gap between traditional asset
                        markets and innovative digital frameworks.
                    </p>
                </div>
            </div>
            
            <div class="bg-[#000000] border border-white/5 p-8 md:p-12 rounded-3xl shadow-2xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-64 h-64 bg-brand-pink/5 rounded-full blur-[80px] -mr-32 -mt-32 pointer-events-none"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-brand-purple/5 rounded-full blur-[80px] -ml-32 -mb-32 pointer-events-none"></div>
                
                <h3 class="font-serif text-2xl md:text-4xl mb-12 text-white relative z-10 flex items-center justify-center gap-4 text-center">
                    <span class="hidden sm:block w-12 h-[2px] bg-gradient-to-r from-transparent to-brand-pink rounded-full"></span> 
                    Our Business Verticals
                    <span class="hidden sm:block w-12 h-[2px] bg-gradient-to-r from-brand-purple to-transparent rounded-full"></span> 
                </h3>
                
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 relative z-10">
                    <!-- 1 -->
                    <div class="p-5 rounded-2xl bg-white/[0.02] border border-white/5 hover:border-brand-pink/40 hover:bg-white/[0.04] hover:-translate-y-1 transition-all duration-300 group/item">
                        <div class="w-10 h-10 rounded-full bg-brand-pink/10 flex items-center justify-center mb-4 text-brand-pink group-hover/item:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <strong class="block text-white font-medium text-sm mb-1.5">Herbal Raw Ingredients</strong>
                        <span class="text-xs text-gray-400 leading-relaxed block">After preparation, supply to world markets.</span>
                    </div>
                    
                    <!-- 2 -->
                    <div class="p-5 rounded-2xl bg-white/[0.02] border border-white/5 hover:border-brand-purple/40 hover:bg-white/[0.04] hover:-translate-y-1 transition-all duration-300 group/item">
                        <div class="w-10 h-10 rounded-full bg-brand-purple/10 flex items-center justify-center mb-4 text-brand-purple group-hover/item:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <strong class="block text-white font-medium text-sm mb-1.5">Gold, Silver & Copper</strong>
                        <span class="text-xs text-gray-400 leading-relaxed block">Raw material purification with shareholding.</span>
                    </div>

                    <!-- 3 -->
                    <div class="p-5 rounded-2xl bg-white/[0.02] border border-white/5 hover:border-brand-pink/40 hover:bg-white/[0.04] hover:-translate-y-1 transition-all duration-300 group/item">
                        <div class="w-10 h-10 rounded-full bg-brand-pink/10 flex items-center justify-center mb-4 text-brand-pink group-hover/item:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <strong class="block text-white font-medium text-sm mb-1.5">Coal & Mines</strong>
                        <span class="text-xs text-gray-400 leading-relaxed block">Operations across international markets.</span>
                    </div>

                    <!-- 4 -->
                    <div class="p-5 rounded-2xl bg-white/[0.02] border border-white/5 hover:border-brand-purple/40 hover:bg-white/[0.04] hover:-translate-y-1 transition-all duration-300 group/item">
                        <div class="w-10 h-10 rounded-full bg-brand-purple/10 flex items-center justify-center mb-4 text-brand-purple group-hover/item:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <strong class="block text-white font-medium text-sm mb-1.5">Premix Raw (Food)</strong>
                        <span class="text-xs text-gray-400 leading-relaxed block">Premium food-grade raw materials.</span>
                    </div>

                    <!-- 5 -->
                    <div class="p-5 rounded-2xl bg-white/[0.02] border border-white/5 hover:border-brand-pink/40 hover:bg-white/[0.04] hover:-translate-y-1 transition-all duration-300 group/item">
                        <div class="w-10 h-10 rounded-full bg-brand-pink/10 flex items-center justify-center mb-4 text-brand-pink group-hover/item:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <strong class="block text-white font-medium text-sm mb-1.5">Heavy Machinery</strong>
                        <span class="text-xs text-gray-400 leading-relaxed block">Supply of industrial assets globally.</span>
                    </div>

                    <!-- 6 -->
                    <div class="p-5 rounded-2xl bg-white/[0.02] border border-white/5 hover:border-brand-purple/40 hover:bg-white/[0.04] hover:-translate-y-1 transition-all duration-300 group/item">
                        <div class="w-10 h-10 rounded-full bg-brand-purple/10 flex items-center justify-center mb-4 text-brand-purple group-hover/item:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <strong class="block text-white font-medium text-sm mb-1.5">Worldwide Courier</strong>
                        <span class="text-xs text-gray-400 leading-relaxed block">Management Services (Generation Plan).</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision, Mission, Future Goals -->
    <section class="py-24 bg-white/[0.02] border-y border-white/5 relative">
        <div
            class="absolute right-0 bottom-0 w-[400px] h-[400px] bg-brand-pink/5 rounded-full blur-[100px] pointer-events-none">
        </div>
        <div class="max-w-7xl mx-auto px-6 lg:px-12">

            <div class="grid md:grid-cols-2 gap-16 mb-24">
                <div class="group">
                    <h2 class="font-serif text-3xl mb-4 text-brand-pink">Our Mission</h2>
                    <p class="text-2xl font-light text-white leading-relaxed border-l-2 border-brand-pink pl-6 py-2">
                        Empower global networkers with lifetime income.
                    </p>
                </div>
                <div class="group">
                    <h2 class="font-serif text-3xl mb-4 text-brand-purple">Our Vision</h2>
                    <p class="text-xl font-light text-gray-300 leading-relaxed">
                        To establish AONE APEX ALLIANCE as a trusted name globally, recognized for innovation, strong
                        community values, and unshakeable transparency.
                    </p>
                </div>
            </div>

            <!-- Future Goals from Image -->
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="uppercase tracking-widest text-xs font-semibold text-gray-400 mb-4">Future Goals</h2>
                <h3 class="font-serif text-3xl md:text-5xl text-white mb-10 leading-tight">The Future We Believe In</h3>
                <p class="text-lg text-gray-300 font-light mb-8">
                    AONE APEX ALLIANCE believes in a future where digital innovation creates equal opportunities for
                    everyone. We aim to build a global ecosystem that encourages collaboration, personal growth, and
                    financial empowerment through modern technology and transparent systems.
                </p>

                <div class="flex flex-wrap justify-center gap-4 mt-12">
                    <span
                        class="px-6 py-2 rounded-full border border-white/10 bg-white/5 text-sm text-gray-300 font-light">Innovation
                        & Creativity</span>
                    <span
                        class="px-6 py-2 rounded-full border border-white/10 bg-white/5 text-sm text-gray-300 font-light">Strong
                        Community Values</span>
                    <span
                        class="px-6 py-2 rounded-full border border-white/10 bg-white/5 text-sm text-gray-300 font-light">Transparency
                        & Trust</span>
                    <span
                        class="px-6 py-2 rounded-full border border-white/10 bg-white/5 text-sm text-gray-300 font-light">Sustainable
                        Growth</span>
                    <span
                        class="px-6 py-2 rounded-full border border-white/10 bg-white/5 text-sm text-gray-300 font-light">Global
                        Expansion</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Principles (Imported design from welcome view) -->
    <section class="py-24">
        <div class="max-w-5xl mx-auto px-6 lg:px-12">
            <h2 class="font-serif text-4xl md:text-5xl mb-16 text-center text-white">Core Principles</h2>

            <div class="space-y-0">
                <div
                    class="group border-t border-white/10 py-12 hover:border-brand-pink/50 transition-colors cursor-default">
                    <div class="grid md:grid-cols-12 gap-8 items-start md:items-center">
                        <div
                            class="md:col-span-2 text-gray-600 font-serif text-4xl italic group-hover:text-brand-pink transition-colors">
                            01</div>
                        <div class="md:col-span-4">
                            <h3
                                class="text-3xl md:text-4xl font-light tracking-wide text-white group-hover:translate-x-4 transition-transform duration-500">
                                Transparency</h3>
                        </div>
                        <div class="md:col-span-6">
                            <p
                                class="text-gray-400 font-light text-lg leading-relaxed group-hover:text-gray-300 transition-colors">
                                We believe trust is built through honesty and openness. Every action we take is visible, and
                                our motives are clear.
                            </p>
                        </div>
                    </div>
                </div>
                <div
                    class="group border-t border-white/10 py-12 hover:border-brand-purple/50 transition-colors cursor-default">
                    <div class="grid md:grid-cols-12 gap-8 items-start md:items-center">
                        <div
                            class="md:col-span-2 text-gray-600 font-serif text-4xl italic group-hover:text-brand-purple transition-colors">
                            02</div>
                        <div class="md:col-span-4">
                            <h3
                                class="text-3xl md:text-4xl font-light tracking-wide text-white group-hover:translate-x-4 transition-transform duration-500">
                                Innovation</h3>
                        </div>
                        <div class="md:col-span-6">
                            <p
                                class="text-gray-400 font-light text-lg leading-relaxed group-hover:text-gray-300 transition-colors">
                                We continuously explore new ideas and technologies for better solutions. Settling for the
                                status quo is not in our DNA.
                            </p>
                        </div>
                    </div>
                </div>
                <div
                    class="group border-y border-white/10 py-12 hover:border-brand-pink/50 transition-colors cursor-default">
                    <div class="grid md:grid-cols-12 gap-8 items-start md:items-center">
                        <div
                            class="md:col-span-2 text-gray-600 font-serif text-4xl italic group-hover:text-brand-pink transition-colors">
                            03</div>
                        <div class="md:col-span-4">
                            <h3
                                class="text-3xl md:text-4xl font-light tracking-wide text-white group-hover:translate-x-4 transition-transform duration-500">
                                Empowerment</h3>
                        </div>
                        <div class="md:col-span-6">
                            <p
                                class="text-gray-400 font-light text-lg leading-relaxed group-hover:text-gray-300 transition-colors">
                                We aim to help individuals unlock their full potential by providing the tools, network, and
                                support they need to thrive.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Journey Section -->
    <section class="py-24 relative bg-white/[0.02] border-t border-white/5">
        <div class="max-w-5xl mx-auto px-6 lg:px-12">
            <div class="text-center mb-24">
                <h2 class="uppercase tracking-widest text-xs font-semibold text-brand-pink mb-4">The Pathway</h2>
                <h3 class="font-serif text-4xl md:text-5xl text-white">The AONE Apex Alliance Journey</h3>
            </div>

            <div class="relative">
                <div
                    class="absolute left-6 md:left-1/2 top-0 bottom-0 w-[1px] bg-gradient-to-b from-brand-pink/50 via-brand-purple/50 to-transparent md:-translate-x-1/2">
                </div>
                <div class="space-y-16 relative z-10">
                    <div
                        class="relative flex flex-col md:flex-row items-start md:items-center justify-between group pl-16 md:pl-0">
                        <div class="md:w-5/12 text-left md:text-right md:pr-12 order-2 md:order-1 mt-2 md:mt-0">
                            <h4 class="font-serif text-2xl text-brand-pink mb-3">Join the Community</h4>
                            <p class="text-gray-400 font-light text-base leading-relaxed">
                                Become a part of the AONE APEX ALLIANCE ecosystem and start your journey.
                            </p>
                        </div>
                        <div
                            class="absolute left-0 md:left-1/2 w-12 h-12 rounded-full bg-[#030009] border border-brand-pink flex items-center justify-center md:-translate-x-1/2 order-1 md:order-2 group-hover:bg-brand-pink transition-all duration-500">
                            <span
                                class="text-sm font-serif text-brand-pink group-hover:text-white transition-colors">1</span>
                        </div>
                        <div class="md:w-5/12 order-3 hidden md:block"></div>
                    </div>
                    <div
                        class="relative flex flex-col md:flex-row items-start md:items-center justify-between group pl-16 md:pl-0">
                        <div class="md:w-5/12 hidden md:block order-1"></div>
                        <div
                            class="absolute left-0 md:left-1/2 w-12 h-12 rounded-full bg-[#030009] border border-brand-purple flex items-center justify-center md:-translate-x-1/2 order-1 md:order-2 group-hover:bg-brand-purple transition-all duration-500">
                            <span
                                class="text-sm font-serif text-brand-purple group-hover:text-white transition-colors">2</span>
                        </div>
                        <div class="md:w-5/12 text-left md:pl-12 order-2 md:order-3 mt-2 md:mt-0">
                            <h4 class="font-serif text-2xl text-brand-purple mb-3">Explore Opportunities</h4>
                            <p class="text-gray-400 font-light text-base leading-relaxed">
                                Access innovative features, digital tools, and community benefits.
                            </p>
                        </div>
                    </div>
                    <div
                        class="relative flex flex-col md:flex-row items-start md:items-center justify-between group pl-16 md:pl-0">
                        <div class="md:w-5/12 text-left md:text-right md:pr-12 order-2 md:order-1 mt-2 md:mt-0">
                            <h4 class="font-serif text-2xl text-brand-pink mb-3">Connect & Grow</h4>
                            <p class="text-gray-400 font-light text-base leading-relaxed">
                                Build relationships, collaborate with others, and grow together.
                            </p>
                        </div>
                        <div
                            class="absolute left-0 md:left-1/2 w-12 h-12 rounded-full bg-[#030009] border border-brand-pink flex items-center justify-center md:-translate-x-1/2 order-1 md:order-2 group-hover:bg-brand-pink transition-all duration-500">
                            <span
                                class="text-sm font-serif text-brand-pink group-hover:text-white transition-colors">3</span>
                        </div>
                        <div class="md:w-5/12 order-3 hidden md:block"></div>
                    </div>
                    <div
                        class="relative flex flex-col md:flex-row items-start md:items-center justify-between group pl-16 md:pl-0">
                        <div class="md:w-5/12 hidden md:block order-1"></div>
                        <div
                            class="absolute left-0 md:left-1/2 w-12 h-12 rounded-full bg-[#030009] border border-brand-purple flex items-center justify-center md:-translate-x-1/2 order-1 md:order-2 group-hover:bg-brand-purple transition-all duration-500">
                            <span
                                class="text-sm font-serif text-brand-purple group-hover:text-white transition-colors">4</span>
                        </div>
                        <div class="md:w-5/12 text-left md:pl-12 order-2 md:order-3 mt-2 md:mt-0">
                            <h4 class="font-serif text-2xl text-brand-purple mb-3">Achieve Success</h4>
                            <p class="text-gray-400 font-light text-base leading-relaxed">
                                Reach your goals and unlock your full potential within our thriving ecosystem.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection