@extends('layouts.app')

@section('content')
    <!-- Hero Section: Editorial & Asymmetric -->
    <section class="min-h-screen relative flex items-center pt-20 overflow-hidden">
        <!-- Soft gradient orb in background -->
        <div
            class="absolute top-1/4 left-1/4 w-[500px] h-[500px] bg-brand-purple/20 rounded-full blur-[120px] pointer-events-none">
        </div>
        <div
            class="absolute bottom-1/4 right-1/4 w-[600px] h-[600px] bg-brand-pink/10 rounded-full blur-[150px] pointer-events-none">
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-12 w-full grid lg:grid-cols-12 gap-12 items-center relative z-10">
            <div class="lg:col-span-7 pr-4 lg:pr-12">
                <div class="flex items-center gap-4 mb-8">
                    <div class="h-[1px] w-12 bg-brand-pink"></div>
                    <span class="uppercase tracking-[0.2em] text-xs text-brand-pink font-medium">Digital Ecosystem</span>
                </div>
                <h1 class="font-serif text-4xl sm:text-5xl md:text-6xl lg:text-[5.5rem] leading-[1.1] mb-8 text-white">
                    Empowering<br>
                    <em class="font-light italic text-gray-400">people through</em><br>
                    technology.
                </h1>
                <p class="text-lg text-gray-400 max-w-lg mb-12 leading-relaxed font-light">
                    A modern and innovative digital platform created with a singular vision: to foster transparent,
                    community-driven growth in a secure environment.
                </p>
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-8">
                    <a href="#about"
                        class="group flex items-center gap-3 border-b border-white/30 pb-2 hover:border-white transition-colors text-white">
                        <span class="tracking-wide uppercase text-sm">Discover our vision</span>
                        <svg class="w-4 h-4 group-hover:translate-x-2 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="hidden sm:block lg:col-span-5 relative mt-10 lg:mt-0">
                <div
                    class="image-mask-organic w-full aspect-[4/5] relative bg-white/5 border border-white/10 p-2 shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=2070&auto=format&fit=crop"
                        alt="Team Collaboration"
                        class="w-full h-full object-cover rounded-[inherit] grayscale-[20%] hover:grayscale-0 transition-all duration-700">
                </div>

            </div>
        </div>
    </section>

    <!-- The Story / About (Narrative focus) -->
    <section id="about" class="py-32 relative">
        <div class="max-w-4xl mx-auto px-6 lg:px-12 text-center">
            <h2 class="font-serif text-4xl md:text-5xl mb-12 text-white">Our Story</h2>
            <div class="prose prose-invert prose-lg mx-auto font-light text-gray-300 leading-relaxed text-left md:text-justify"
                style="max-width: 65ch;">
                <p
                    class="first-letter:text-7xl first-letter:font-serif first-letter:text-white first-letter:mr-3 first-letter:float-left">
                    Our company focuses on building a strong ecosystem where individuals can explore new opportunities,
                    connect with a global network, and grow together in a secure and sustainable environment.
                </p>
                <p class="mt-8">
                    At AONE APEX ALLIANCE, we believe success becomes more powerful when communities work together with
                    trust, innovation, and a shared purpose. Our platform is designed to provide a smooth, reliable, and
                    future-focused experience for every participant.
                </p>
                <p class="mt-8 italic font-serif text-xl text-white text-center py-8 border-y border-white/10 my-12">
                    "We are committed to creating long-term value through advanced technology, strong leadership, and
                    continuous development."
                </p>
            </div>
        </div>
    </section>

    <!-- Vision & Mission -->
    <section id="vision" class="py-24 relative bg-white/[0.02]">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="grid md:grid-cols-2 gap-16 md:gap-24">
                <!-- Vision -->
                <div class="relative group">
                    <div
                        class="absolute -inset-4 bg-brand-purple/5 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="h-[1px] w-8 bg-brand-pink"></div>
                            <h3 class="uppercase tracking-widest text-xs font-semibold text-brand-pink">Our Vision</h3>
                        </div>
                        <h2 class="font-serif text-3xl md:text-4xl mb-6 text-white leading-tight">
                            To redefine the landscape of global collaboration.
                        </h2>
                        <p class="text-gray-400 font-light leading-relaxed text-lg">
                            We envision a world where digital boundaries are erased, empowering individuals from all walks
                            of life to connect, innovate, and thrive within a transparent and supportive ecosystem.
                        </p>
                    </div>
                </div>

                <!-- Mission -->
                <div class="relative group mt-12 md:mt-0">
                    <div
                        class="absolute -inset-4 bg-brand-pink/5 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="h-[1px] w-8 bg-brand-purple"></div>
                            <h3 class="uppercase tracking-widest text-xs font-semibold text-brand-purple">Our Mission</h3>
                        </div>
                        <h2 class="font-serif text-3xl md:text-4xl mb-6 text-white leading-tight">
                            Building the tools for tomorrow's leaders.
                        </h2>
                        <p class="text-gray-400 font-light leading-relaxed text-lg">
                            Our mission is to provide accessible, cutting-edge technology and foster a community-driven
                            platform that prioritizes continuous development, shared success, and unshakeable trust.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Business Verticals -->
    <section class="py-24 bg-white/[0.02] border-y border-white/5 relative">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="text-center mb-16">
                <h2 class="font-serif text-4xl md:text-5xl mb-6 text-white">Our Business Verticals</h2>
                <p class="text-gray-400 font-light max-w-2xl mx-auto">Explore the diverse industries and global markets where AONE APEX ALLIANCE operates.</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- 1 -->
                <div class="bg-[#000000] border border-white/5 rounded-2xl overflow-hidden hover:border-brand-pink/50 transition-colors group flex flex-col">
                    <div class="h-48 w-full relative overflow-hidden bg-white/5">
                        <img src="https://images.unsplash.com/photo-1604304194650-3ba3cfa752fd?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fGhlcmJzfGVufDB8fDB8fHww" alt="Herbal Raw" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <strong class="block text-white font-medium mb-2 text-xl">Herbal Raw Ingredients</strong>
                        <span class="text-gray-400 leading-relaxed block">After preparation, supply to world markets.</span>
                    </div>
                </div>
                <!-- 2 -->
                <div class="bg-[#000000] border border-white/5 rounded-2xl overflow-hidden hover:border-brand-purple/50 transition-colors group flex flex-col">
                    <div class="h-48 w-full relative overflow-hidden bg-white/5">
                        <img src="https://rfdtv.brightspotgocdn.com/dims4/default/914d508/2147483647/strip/true/crop/960x539+0+8/resize/730x410!/quality/90/?url=https%3A%2F%2Fbrightspot-go-k1-rfdtv.s3.us-east-1.amazonaws.com%2Fbrightspot%2F6f%2Fdc%2F6717e476461fb56b5ac4d9c60a6b%2Fgold-silver-and-copper-bars-photo-by-oselote-via-adobestock-566808969.png" alt="Gold Silver" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <strong class="block text-white font-medium mb-2 text-xl">Gold, Silver, Copper & Nickel</strong>
                        <span class="text-gray-400 leading-relaxed block">Raw material purification with shareholding.</span>
                    </div>
                </div>
                <!-- 3 -->
                <div class="bg-[#000000] border border-white/5 rounded-2xl overflow-hidden hover:border-brand-pink/50 transition-colors group flex flex-col">
                    <div class="h-48 w-full relative overflow-hidden bg-white/5">
                        <img src="https://swannscoalsupplies.co.uk/cdn/shop/collections/coal-types.jpg?crop=center&height=1200&v=1718282817&width=1200" alt="Coal Mines" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <strong class="block text-white font-medium mb-2 text-xl">Coal & Mines Management</strong>
                        <span class="text-gray-400 leading-relaxed block">Operations across international markets.</span>
                    </div>
                </div>
                <!-- 4 -->
                <div class="bg-[#000000] border border-white/5 rounded-2xl overflow-hidden hover:border-brand-purple/50 transition-colors group flex flex-col">
                    <div class="h-48 w-full relative overflow-hidden bg-white/5">
                        <img src="https://mtroyal.com.tr/en/wp-content/uploads/2024/11/Raw-materials-for-snack-foods.jpg" alt="Premix Raw" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <strong class="block text-white font-medium mb-2 text-xl">Premix Raw Materials (Food)</strong>
                        <span class="text-gray-400 leading-relaxed block">Premium food-grade raw materials.</span>
                    </div>
                </div>
                <!-- 5 -->
                <div class="bg-[#000000] border border-white/5 rounded-2xl overflow-hidden hover:border-brand-pink/50 transition-colors group flex flex-col">
                    <div class="h-48 w-full relative overflow-hidden bg-white/5">
                        <img src="https://www.bakerindustriesinc.com/heavy-equipment-industrial-machinery/wp-content/uploads/sites/8/2023/02/Installation-Content-Card-600x400.jpg" alt="Heavy Machinery" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <strong class="block text-white font-medium mb-2 text-xl">Industrial Heavy Machinery</strong>
                        <span class="text-gray-400 leading-relaxed block">Supply of industrial assets globally.</span>
                    </div>
                </div>
                <!-- 6 -->
                <div class="bg-[#000000] border border-white/5 rounded-2xl overflow-hidden hover:border-brand-purple/50 transition-colors group flex flex-col">
                    <div class="h-48 w-full relative overflow-hidden bg-white/5">
                        <img src="https://5.imimg.com/data5/SELLER/Default/2024/10/459089699/XI/YB/LZ/183774627/air-cargo-service.jpeg" alt="Courier Shipping" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <strong class="block text-white font-medium mb-2 text-xl">Worldwide Courier & Shipping</strong>
                        <span class="text-gray-400 leading-relaxed block">Management Services (Generation Plan).</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Purpose (Clean, staggered list) -->
    <section id="purpose" class="py-24 border-y border-white/5 relative">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="grid lg:grid-cols-12 gap-16">
                <div class="lg:col-span-5 lg:sticky lg:top-32 h-fit">
                    <h2 class="font-serif text-4xl md:text-5xl mb-6 text-white">The Purpose</h2>
                    <p class="text-gray-400 font-light leading-relaxed mb-8">
                        To provide a secure, user-friendly, and innovative environment where individuals can participate,
                        grow, and achieve success together.
                    </p>
                    <div class="h-[1px] w-full bg-gradient-to-r from-brand-pink to-transparent mb-8"></div>
                    <p class="text-sm tracking-wider uppercase text-brand-pink font-medium">We are dedicated to:</p>
                </div>
                <div class="lg:col-span-7 space-y-4">
                    <!-- Custom styled list items -->
                    <div
                        class="group flex gap-6 items-start p-6 rounded-2xl hover:bg-white/5 transition-colors border border-transparent hover:border-white/10">
                        <div
                            class="text-2xl text-brand-purple font-serif italic mt-1 group-hover:-translate-y-1 transition-transform">
                            01</div>
                        <div>
                            <h3 class="text-xl text-white mb-2 font-medium">Advanced Solutions</h3>
                            <p class="text-gray-400 font-light text-sm leading-relaxed">Delivering cutting-edge digital
                                solutions tailored for the modern landscape.</p>
                        </div>
                    </div>

                    <div
                        class="group flex gap-6 items-start p-6 rounded-2xl hover:bg-white/5 transition-colors border border-transparent hover:border-white/10">
                        <div
                            class="text-2xl text-brand-purple font-serif italic mt-1 group-hover:-translate-y-1 transition-transform">
                            02</div>
                        <div>
                            <h3 class="text-xl text-white mb-2 font-medium">Supportive Community</h3>
                            <p class="text-gray-400 font-light text-sm leading-relaxed">Creating a strong ecosystem that
                                fosters networking, collaboration, and mutual support.</p>
                        </div>
                    </div>

                    <div
                        class="group flex gap-6 items-start p-6 rounded-2xl hover:bg-white/5 transition-colors border border-transparent hover:border-white/10">
                        <div
                            class="text-2xl text-brand-purple font-serif italic mt-1 group-hover:-translate-y-1 transition-transform">
                            03</div>
                        <div>
                            <h3 class="text-xl text-white mb-2 font-medium">Teamwork & Leadership</h3>
                            <p class="text-gray-400 font-light text-sm leading-relaxed">Encouraging collaborative efforts
                                while nurturing individual leadership capabilities.</p>
                        </div>
                    </div>

                    <div
                        class="group flex gap-6 items-start p-6 rounded-2xl hover:bg-white/5 transition-colors border border-transparent hover:border-white/10">
                        <div
                            class="text-2xl text-brand-purple font-serif italic mt-1 group-hover:-translate-y-1 transition-transform">
                            04</div>
                        <div>
                            <h3 class="text-xl text-white mb-2 font-medium">Transparent Operations</h3>
                            <p class="text-gray-400 font-light text-sm leading-relaxed">Providing clear, honest systems that
                                build trust across our entire user base.</p>
                        </div>
                    </div>

                    <div
                        class="group flex gap-6 items-start p-6 rounded-2xl hover:bg-white/5 transition-colors border border-transparent hover:border-white/10">
                        <div
                            class="text-2xl text-brand-purple font-serif italic mt-1 group-hover:-translate-y-1 transition-transform">
                            05</div>
                        <div>
                            <h3 class="text-xl text-white mb-2 font-medium">Sustainable Growth</h3>
                            <p class="text-gray-400 font-light text-sm leading-relaxed">Building opportunities designed for
                                long-term impact rather than short-term gains.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us (Editorial Grid) -->
    <section id="why-us" class="py-32 bg-white/[0.02]">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="text-center mb-20">
                <h2 class="font-serif text-4xl md:text-5xl mb-6 text-white">Why Choose Us</h2>
                <p class="text-gray-400 font-light max-w-2xl mx-auto">What sets AONE APEX ALLIANCE apart in a crowded
                    digital landscape.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Large featured item -->
                <div
                    class="lg:col-span-2 md:row-span-2 bg-gradient-to-br from-white/[0.04] to-transparent border border-white/5 p-10 rounded-3xl relative overflow-hidden group">
                    <div
                        class="absolute inset-0 bg-brand-purple/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div class="relative z-10 h-full flex flex-col justify-between">
                        <div class="w-12 h-12 rounded-full border border-white/20 flex items-center justify-center mb-8">
                            <svg class="w-5 h-5 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-serif text-3xl mb-4 text-white">Trusted Ecosystem</h3>
                            <p class="text-gray-400 font-light text-lg leading-relaxed max-w-md">
                                We focus on transparency, reliability, and long-term sustainability. Our ecosystem is built
                                on a foundation of mutual trust and verifiable actions.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Standard item -->
                <div
                    class="bg-white/[0.02] border border-white/5 p-8 rounded-3xl hover:bg-white/5 transition-colors duration-300">
                    <h3 class="font-serif text-2xl mb-3 text-white">Community Driven</h3>
                    <p class="text-gray-400 font-light text-sm leading-relaxed">
                        Our growing global community is the foundation of our success. We listen, adapt, and build for the
                        people who use our platform.
                    </p>
                </div>

                <!-- Standard item -->
                <div
                    class="bg-white/[0.02] border border-white/5 p-8 rounded-3xl hover:bg-white/5 transition-colors duration-300">
                    <h3 class="font-serif text-2xl mb-3 text-white">Innovative Tech</h3>
                    <p class="text-gray-400 font-light text-sm leading-relaxed">
                        We use modern systems and smart solutions to create a seamless, beautiful user experience.
                    </p>
                </div>

                <!-- Horizontal item -->
                <div
                    class="md:col-span-2 lg:col-span-3 bg-white/[0.02] border border-white/5 p-8 rounded-3xl flex flex-col sm:flex-row gap-8 items-center hover:bg-white/5 transition-colors duration-300">
                    <div class="flex-1">
                        <h3 class="font-serif text-2xl mb-3 text-white">Growth Opportunities</h3>
                        <p class="text-gray-400 font-light text-sm leading-relaxed">
                            Designed to support personal, professional, and community development at every stage of your
                            journey.
                        </p>
                    </div>
                    <div
                        class="w-full sm:w-px h-[1px] sm:h-32 bg-gradient-to-r sm:bg-gradient-to-b from-brand-pink/50 to-transparent">
                    </div>
                    <div class="flex-1">
                        <h3 class="font-serif text-2xl mb-3 text-white">Future Focused</h3>
                        <p class="text-gray-400 font-light text-sm leading-relaxed">
                            We continuously work towards expansion, innovation, and global impact, ensuring we stay ahead of
                            the curve.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Principles (Large Typography Index) -->
    <section id="principles" class="py-32">
        <div class="max-w-5xl mx-auto px-6 lg:px-12">
            <h2 class="font-serif text-4xl md:text-5xl mb-16 text-center text-white">Core Principles</h2>

            <div class="space-y-0">
                <!-- Principle 1 -->
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

                <!-- Principle 2 -->
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

                <!-- Principle 3 -->
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

    <!-- Journey Process (Vertical Stepper) -->
    <section id="journey" class="py-32 relative bg-white/[0.02] border-t border-white/5">
        <div class="max-w-5xl mx-auto px-6 lg:px-12">
            <div class="text-center mb-24">
                <h2 class="uppercase tracking-widest text-xs font-semibold text-brand-pink mb-4">The Pathway</h2>
                <h3 class="font-serif text-4xl md:text-5xl text-white">The AONE Apex Alliance Journey</h3>
            </div>

            <div class="relative">
                <!-- Vertical Line -->
                <div
                    class="absolute left-6 md:left-1/2 top-0 bottom-0 w-[1px] bg-gradient-to-b from-brand-pink/50 via-brand-purple/50 to-transparent md:-translate-x-1/2">
                </div>

                <div class="space-y-16 relative z-10">
                    <!-- Step 1 -->
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

                    <!-- Step 2 -->
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

                    <!-- Step 3 -->
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

                    <!-- Step 4 -->
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

    <!-- Contact Section -->
    <section id="contact" class="py-32 relative border-t border-white/5 overflow-hidden">
        <div
            class="absolute top-0 right-0 w-[500px] h-[500px] bg-brand-purple/10 rounded-full blur-[120px] pointer-events-none">
        </div>
        <div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
            <div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">
                <div>
                    <h2 class="font-serif text-5xl md:text-6xl mb-6 text-white leading-tight">
                        Let's start a <br>
                        <em class="font-light italic text-gray-400">conversation.</em>
                    </h2>
                    <p class="text-gray-400 font-light mb-12 text-lg max-w-md">
                        Whether you have a question about our ecosystem, want to explore opportunities, or simply want to
                        connect, we'd love to hear from you.
                    </p>

                    <div class="space-y-8">
                        <div class="flex items-center gap-6">
                            <div
                                class="w-12 h-12 rounded-full border border-white/10 flex items-center justify-center text-brand-pink">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 uppercase tracking-widest mb-1">Email Us</p>
                                <a href="mailto:hello@aoneapex.com"
                                    class="text-white hover:text-brand-pink transition-colors text-lg">hello@aoneapex.com</a>
                            </div>
                        </div>
                        <div class="flex items-center gap-6">
                            <div
                                class="w-12 h-12 rounded-full border border-white/10 flex items-center justify-center text-brand-purple">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 uppercase tracking-widest mb-1">Visit Us</p>
                                <p class="text-white text-lg">Global Innovation Hub</p>
                            </div>
                        </div>
                    </div>
                </div>

                @include('partials.contact-form')
            </div>
        </div>
    </section>

@endsection