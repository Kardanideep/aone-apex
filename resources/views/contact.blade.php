@extends('layouts.app')

@section('title', 'Contact Us | AONE APEX ALLIANCE')

@section('content')
<section class="pt-32 md:pt-48 pb-16 md:pb-20 relative overflow-hidden">
    <!-- Background Effects -->
    <div class="absolute top-1/4 right-1/4 w-[400px] h-[400px] bg-brand-pink/20 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute bottom-1/4 left-1/4 w-[500px] h-[500px] bg-brand-purple/10 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
        <!-- Page Header -->
        <div class="text-center mb-16">
            <div class="flex items-center justify-center gap-4 mb-6">
                <div class="h-[1px] w-8 bg-brand-pink"></div>
                <span class="uppercase tracking-[0.2em] text-xs text-brand-pink font-medium">Get in Touch</span>
                <div class="h-[1px] w-8 bg-brand-pink"></div>
            </div>
            <h1 class="font-serif text-4xl sm:text-5xl md:text-7xl mb-6 text-white leading-tight">
                Contact And <span class="text-gradient">Inquiries</span>
            </h1>
            <p class="text-lg text-gray-400 font-light max-w-2xl mx-auto">
                Have a question about our ecosystem, investment plans, or need support? We'd love to hear from you. Drop us a line and we'll get back to you shortly.
            </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-16">
            <!-- Contact Info -->
            <div class="space-y-10 lg:pr-10">
                <div class="bg-white/[0.02] border border-white/5 p-8 rounded-3xl backdrop-blur-sm relative overflow-hidden group hover:border-white/10 transition-colors">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-brand-purple/10 rounded-full blur-[30px] group-hover:bg-brand-purple/20 transition-colors"></div>
                    <h3 class="font-serif text-2xl text-white mb-2 relative z-10">Headquarters</h3>
                    <p class="text-gray-400 font-light relative z-10">
                        123 Global Business Hub<br>
                        Financial District, NY 10004<br>
                        United States
                    </p>
                </div>

                <div class="bg-white/[0.02] border border-white/5 p-8 rounded-3xl backdrop-blur-sm relative overflow-hidden group hover:border-white/10 transition-colors">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-brand-pink/10 rounded-full blur-[30px] group-hover:bg-brand-pink/20 transition-colors"></div>
                    <h3 class="font-serif text-2xl text-white mb-2 relative z-10">Direct Contact</h3>
                    <div class="space-y-2 text-gray-400 font-light relative z-10">
                        <p class="flex items-center gap-3">
                            <span class="text-brand-pink">E:</span> support@aoneapex.com
                        </p>
                        <p class="flex items-center gap-3">
                            <span class="text-brand-pink">P:</span> +1 (555) 123-4567
                        </p>
                    </div>
                </div>

                <div>
                    <h3 class="font-serif text-2xl text-white mb-6">Connect on Social</h3>
                    <div class="flex gap-4">
                        <a href="#" class="w-12 h-12 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-white hover:text-black transition-all">
                            In
                        </a>
                        <a href="#" class="w-12 h-12 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-white hover:text-black transition-all">
                            Tw
                        </a>
                        <a href="#" class="w-12 h-12 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-white hover:text-black transition-all">
                            Ig
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div>
                @include('partials.contact-form')
            </div>
        </div>
    </div>
</section>
@endsection
