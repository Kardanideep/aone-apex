<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AONE APEX ALLIANCE')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Mixing an elegant Serif with a clean Sans-serif for a human/editorial feel -->
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                    },
                    colors: {
                        brand: {
                            dark: '#030009',
                            purple: '#6B46C1',
                            pink: '#D53F8C',
                            gold: '#D4AF37', /* Added gold for financial aspect */
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background-color: #030009;
            color: #FAF9F6;
            overflow-x: hidden;
        }

        .text-gradient {
            background: linear-gradient(to right, #D53F8C, #6B46C1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .text-gradient-gold {
            background: linear-gradient(to right, #FDE047, #D4AF37);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Subtle, organic noise overlay to break up the "perfect" digital background */
        .noise-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            pointer-events: none;
            z-index: 50;
            opacity: 0.03;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
        }

        /* Custom image masking for organic feel */
        .image-mask-organic {
            border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
            overflow: hidden;
            transition: border-radius 0.5s ease;
        }

        .image-mask-organic:hover {
            border-radius: 50% 50% 50% 50% / 50% 50% 50% 50%;
        }

        .nav-scrolled {
            background: rgba(3, 0, 9, 0.92);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* Table Styles */
        .plan-table th {
            background-color: rgba(255, 255, 255, 0.05);
            color: #fff;
            font-weight: 500;
            padding: 1rem;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .plan-table td {
            padding: 1rem;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.05);
            color: #d1d5db;
        }

        .plan-table tr:hover td {
            background-color: rgba(255, 255, 255, 0.02);
            color: #fff;
        }
    </style>
    @yield('head')
</head>

<body class="antialiased font-sans font-light selection:bg-brand-pink selection:text-white relative">
    <div class="noise-bg"></div>

    <!-- Navbar -->
    <nav class="fixed w-full z-40 transition-all duration-300 py-5" id="navbar">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <a href="{{ route('home') }}"
                    class="flex-shrink-0 font-serif font-bold text-2xl tracking-wide hover:opacity-80 transition-opacity">
                    AONE <span class="text-gradient text-sm uppercase tracking-widest font-sans ml-1">Apex</span>
                </a>

                <!-- Desktop Nav -->
                <div class="hidden lg:flex items-center space-x-8 text-sm tracking-wide">
                    <a href="{{ route('home') }}"
                        class="{{ request()->routeIs('home') ? 'text-white border-b border-white pb-1' : 'text-gray-400 hover:text-white transition-colors' }}">Home</a>
                    <a href="{{ route('about') }}"
                        class="{{ request()->routeIs('about') ? 'text-white border-b border-white pb-1' : 'text-gray-400 hover:text-white transition-colors' }}">About
                        Us</a>
                    <a href="{{ route('packages') }}"
                        class="{{ request()->routeIs('packages') ? 'text-white border-b border-white pb-1' : 'text-gray-400 hover:text-white transition-colors' }}">Packages</a>
                    <a href="{{ route('business-plan') }}"
                        class="{{ request()->routeIs('business-plan') ? 'text-white border-b border-white pb-1' : 'text-gray-400 hover:text-white transition-colors' }}">Income
                        Plan</a>
                    <a href="{{ route('contact') }}"
                        class="{{ request()->routeIs('contact') ? 'text-white border-b border-white pb-1' : 'text-gray-400 hover:text-white transition-colors' }}">Contact</a>
                    <div class="h-4 w-px bg-white/20 mx-1"></div>
                    <a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition-colors">Log in</a>
                    <a href="{{ route('register') }}"
                        class="bg-brand-purple hover:bg-brand-pink text-white px-6 py-2.5 rounded-full transition-all">Sign
                        Up</a>
                </div>

                <!-- Hamburger Button (Mobile) -->
                <button id="menu-toggle"
                    class="lg:hidden flex flex-col justify-center items-center w-10 h-10 gap-1.5 focus:outline-none group"
                    aria-label="Toggle Menu">
                    <span id="bar1" class="block w-6 h-0.5 bg-white transition-all duration-300 origin-center"></span>
                    <span id="bar2" class="block w-6 h-0.5 bg-white transition-all duration-300"></span>
                    <span id="bar3" class="block w-6 h-0.5 bg-white transition-all duration-300 origin-center"></span>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu" class="fixed inset-0 z-30 bg-[#030009]/95 backdrop-blur-xl flex flex-col justify-between px-8 py-8 lg:hidden
               translate-x-full transition-transform duration-500 ease-in-out">

        <!-- Top: Logo + Close area
        <div class="flex items-center justify-between pt-2">
            <a href="{{ route('home') }}" class="font-serif font-bold text-2xl tracking-wide text-white">
                AONE <span class="text-gradient text-sm uppercase tracking-widest font-sans ml-1">Apex</span>
            </a>
        </div> -->

        <!-- Center: Links -->
        <nav class="flex flex-col gap-2 mt-10">
            <a href="{{ route('home') }}"
                class="group flex items-center justify-between border-b border-white/5 py-5 text-3xl font-serif text-white hover:text-brand-pink transition-colors mobile-link">
                Home
                <svg class="w-5 h-5 text-gray-600 group-hover:text-brand-pink group-hover:translate-x-1 transition-all"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
            <a href="{{ route('about') }}"
                class="group flex items-center justify-between border-b border-white/5 py-5 text-3xl font-serif text-white hover:text-brand-pink transition-colors mobile-link">
                About Us
                <svg class="w-5 h-5 text-gray-600 group-hover:text-brand-pink group-hover:translate-x-1 transition-all"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
            <a href="{{ route('packages') }}"
                class="group flex items-center justify-between border-b border-white/5 py-5 text-3xl font-serif text-white hover:text-brand-pink transition-colors mobile-link">
                Packages
                <svg class="w-5 h-5 text-gray-600 group-hover:text-brand-pink group-hover:translate-x-1 transition-all"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
            <a href="{{ route('business-plan') }}"
                class="group flex items-center justify-between border-b border-white/5 py-5 text-3xl font-serif text-white hover:text-brand-pink transition-colors mobile-link">
                Income Plan
                <svg class="w-5 h-5 text-gray-600 group-hover:text-brand-pink group-hover:translate-x-1 transition-all"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
            <a href="{{ route('contact') }}"
                class="group flex items-center justify-between py-5 text-3xl font-serif text-white hover:text-brand-pink transition-colors mobile-link">
                Contact
                <svg class="w-5 h-5 text-gray-600 group-hover:text-brand-pink group-hover:translate-x-1 transition-all"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </nav>

        <!-- Bottom: Auth Buttons -->
        <div class="flex flex-col gap-4">
            <a href="{{ route('register') }}"
                class="w-full text-center bg-gradient-to-r from-brand-pink to-brand-purple text-white font-medium py-4 rounded-full text-sm uppercase tracking-widest hover:opacity-90 transition-opacity">
                Sign Up
            </a>
            <a href="{{ route('login') }}"
                class="w-full text-center border border-white/20 text-white font-medium py-4 rounded-full text-sm uppercase tracking-widest hover:border-white/60 transition-colors">
                Log In
            </a>
        </div>
    </div>

    <script>
        // Scroll-based navbar style
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 50) {
                nav.classList.add('nav-scrolled', 'py-4');
                nav.classList.remove('py-5');
            } else {
                nav.classList.remove('nav-scrolled', 'py-4');
                nav.classList.add('py-5');
            }
        });

        // Mobile menu toggle
        const toggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const bar1 = document.getElementById('bar1');
        const bar2 = document.getElementById('bar2');
        const bar3 = document.getElementById('bar3');
        let isOpen = false;

        toggle.addEventListener('click', () => {
            isOpen = !isOpen;
            if (isOpen) {
                mobileMenu.classList.remove('translate-x-full');
                mobileMenu.classList.add('translate-x-0');
                bar1.classList.add('rotate-45', 'translate-y-2');
                bar2.classList.add('opacity-0', 'scale-x-0');
                bar3.classList.add('-rotate-45', '-translate-y-2');
                document.body.classList.add('overflow-hidden');
            } else {
                mobileMenu.classList.add('translate-x-full');
                mobileMenu.classList.remove('translate-x-0');
                bar1.classList.remove('rotate-45', 'translate-y-2');
                bar2.classList.remove('opacity-0', 'scale-x-0');
                bar3.classList.remove('-rotate-45', '-translate-y-2');
                document.body.classList.remove('overflow-hidden');
            }
        });

        // Close menu when any link is clicked
        document.querySelectorAll('.mobile-link').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('translate-x-full');
                mobileMenu.classList.remove('translate-x-0');
                bar1.classList.remove('rotate-45', 'translate-y-2');
                bar2.classList.remove('opacity-0', 'scale-x-0');
                bar3.classList.remove('-rotate-45', '-translate-y-2');
                document.body.classList.remove('overflow-hidden');
                isOpen = false;
            });
        });
    </script>


    @yield('content')

    <!-- Footer -->
    <footer class="pt-16 pb-12 px-6 lg:px-12 relative border-t border-white/5 bg-black/20 mt-auto">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-12 mb-16">
                <div class="col-span-2">
                    <div class="font-serif font-bold text-2xl tracking-wide mb-6">
                        AONE <span class="text-gradient text-sm uppercase tracking-widest font-sans ml-1">Apex</span>
                    </div>
                    <p class="text-gray-400 font-light max-w-sm mb-8 leading-relaxed">
                        A modern digital platform created with the vision of empowering people through technology,
                        transparency, and community-driven growth.
                    </p>
                </div>

                <div>
                    <h4 class="font-serif text-lg mb-6 text-white">Navigation</h4>
                    <ul class="space-y-4 text-gray-400 font-light text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="{{ route('packages') }}" class="hover:text-white transition-colors">Packages</a>
                        </li>
                        <li><a href="{{ route('business-plan') }}" class="hover:text-white transition-colors">Income
                                Plan</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-serif text-lg mb-6 text-white">Connect</h4>
                    <ul class="space-y-4 text-gray-400 font-light text-sm">
                        <li><a href="#" class="hover:text-white transition-colors">LinkedIn</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Twitter</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Instagram</a></li>
                    </ul>
                </div>
            </div>

            <div
                class="flex flex-col md:flex-row justify-between items-center pt-8 border-t border-white/10 text-xs text-gray-500 font-light tracking-wide">
                <p>&copy; {{ date('Y') }} AONE APEX ALLIANCE. All rights reserved.</p>
                <div class="flex gap-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-gray-300 transition-colors">Privacy</a>
                    <a href="#" class="hover:text-gray-300 transition-colors">Terms</a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>