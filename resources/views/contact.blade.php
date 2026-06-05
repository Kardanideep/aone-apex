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
                <div class="bg-white/[0.02] border border-white/10 p-8 md:p-12 rounded-3xl backdrop-blur-md relative overflow-hidden shadow-2xl">
                    <form action="#" method="POST" class="space-y-6 relative z-10">
                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- First Name -->
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-300 mb-2">First Name</label>
                                <input type="text" id="first_name" name="first_name" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-brand-purple focus:ring-1 focus:ring-brand-purple transition-all" required>
                            </div>

                            <!-- Last Name -->
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-300 mb-2">Last Name</label>
                                <input type="text" id="last_name" name="last_name" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-brand-purple focus:ring-1 focus:ring-brand-purple transition-all" required>
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                            <input type="email" id="email" name="email" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-brand-purple focus:ring-1 focus:ring-brand-purple transition-all" required>
                        </div>

                        <!-- Subject -->
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-300 mb-2">Subject / Inquiry Type</label>
                            <select id="subject" name="subject" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-brand-purple focus:ring-1 focus:ring-brand-purple transition-all appearance-none">
                                <option value="general">General Inquiry</option>
                                <option value="support">Technical Support</option>
                                <option value="investment">Investment Plans</option>
                                <option value="partnership">Partnership Opportunities</option>
                            </select>
                        </div>

                        <!-- Message -->
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-300 mb-2">Message</label>
                            <textarea id="message" name="message" rows="5" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-brand-purple focus:ring-1 focus:ring-brand-purple transition-all resize-none" placeholder="How can we help you?" required></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full bg-gradient-to-r from-brand-pink to-brand-purple hover:from-brand-purple hover:to-brand-pink text-white font-medium py-4 px-4 rounded-xl transition-all duration-300 transform hover:-translate-y-0.5 shadow-[0_0_20px_rgba(213,63,140,0.3)] mt-2">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
