@extends('layouts.app')

@section('title', 'Change Password | AONE APEX ALLIANCE')

@section('content')
<section class="min-h-screen pt-28 pb-24 relative overflow-hidden">

    <!-- Background glow -->
    <div class="absolute top-1/3 left-1/4 w-[500px] h-[500px] bg-brand-pink/6 rounded-full blur-[160px] pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-[300px] h-[300px] bg-brand-purple/8 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-6xl mx-auto px-6 lg:px-12 relative z-10">

        <!-- Back link -->
        <a href="{{ route('profile') }}"
           class="inline-flex items-center gap-3 text-gray-500 hover:text-white transition-colors mb-16 group">
            <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span class="text-xs uppercase tracking-widest">Back to Profile</span>
        </a>

        <div class="grid lg:grid-cols-2 gap-16 lg:gap-28 items-start">

            {{-- ======= LEFT: Editorial Context ======= --}}
            <div>
                <!-- Section label -->
                <div class="flex items-center gap-4 mb-10">
                    <div class="h-[1px] w-8 bg-brand-pink"></div>
                    <span class="uppercase tracking-[0.2em] text-xs text-brand-pink font-medium">Security</span>
                </div>

                <h1 class="font-serif text-4xl md:text-5xl text-white leading-[1.15] mb-8">
                    Keep your<br>
                    <em class="font-light italic text-gray-400">account safe.</em>
                </h1>

                <p class="text-gray-400 font-light leading-relaxed mb-14 max-w-sm text-base">
                    A strong, unique password is your primary defense. We recommend updating it regularly and never reusing passwords from other platforms.
                </p>

                <!-- Security tips -->
                <div class="border-t border-white/5 pt-10 space-y-6">
                    <p class="text-xs uppercase tracking-widest text-gray-600 mb-6">Best Practices</p>

                    <div class="flex items-start gap-4">
                        <div class="w-1.5 h-1.5 rounded-full bg-brand-purple mt-2 flex-shrink-0"></div>
                        <span class="text-gray-500 font-light text-sm leading-relaxed">Use at least 12 characters with numbers, symbols and uppercase letters</span>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-1.5 h-1.5 rounded-full bg-brand-purple mt-2 flex-shrink-0"></div>
                        <span class="text-gray-500 font-light text-sm leading-relaxed">Never share your password with anyone — not even our support team</span>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-1.5 h-1.5 rounded-full bg-brand-purple mt-2 flex-shrink-0"></div>
                        <span class="text-gray-500 font-light text-sm leading-relaxed">Use a password manager to generate and store unique passwords safely</span>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-1.5 h-1.5 rounded-full bg-brand-purple mt-2 flex-shrink-0"></div>
                        <span class="text-gray-500 font-light text-sm leading-relaxed">Change your password every 90 days for maximum protection</span>
                    </div>
                </div>
            </div>

            {{-- ======= RIGHT: Password Form ======= --}}
            <div class="lg:pt-24">

                <form action="{{ route('profile') }}" method="GET" class="space-y-10">

                    {{-- Current Password --}}
                    <div class="group">
                        <label for="current_password" class="block text-xs font-medium text-gray-500 uppercase tracking-widest mb-4">
                            Current Password
                        </label>
                        <div class="relative">
                            <input type="password" id="current_password" name="current_password"
                                class="w-full bg-transparent border-0 border-b border-white/15 pb-3 pr-10 text-white text-base placeholder-gray-700 focus:outline-none focus:border-brand-pink transition-colors duration-300"
                                placeholder="••••••••" required>
                            <button type="button" onclick="togglePasswordVisibility('current_password')" class="absolute right-0 top-1/2 -translate-y-1/2 -mt-1 text-gray-500 hover:text-white transition-colors">
                                <svg id="eye-icon-current_password" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- New Password --}}
                    <div class="group">
                        <label for="password" class="block text-xs font-medium text-gray-500 uppercase tracking-widest mb-4">
                            New Password
                        </label>
                        <div class="relative">
                            <input type="password" id="password" name="password"
                                class="w-full bg-transparent border-0 border-b border-white/15 pb-3 pr-10 text-white text-base placeholder-gray-700 focus:outline-none focus:border-brand-pink transition-colors duration-300"
                                placeholder="minimum 8 characters" required>
                            <button type="button" onclick="togglePasswordVisibility('password')" class="absolute right-0 top-1/2 -translate-y-1/2 -mt-1 text-gray-500 hover:text-white transition-colors">
                                <svg id="eye-icon-password" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Confirm Password --}}
                    <div class="group">
                        <label for="password_confirmation" class="block text-xs font-medium text-gray-500 uppercase tracking-widest mb-4">
                            Confirm New Password
                        </label>
                        <div class="relative">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="w-full bg-transparent border-0 border-b border-white/15 pb-3 pr-10 text-white text-base placeholder-gray-700 focus:outline-none focus:border-brand-pink transition-colors duration-300"
                                placeholder="••••••••" required>
                            <button type="button" onclick="togglePasswordVisibility('password_confirmation')" class="absolute right-0 top-1/2 -translate-y-1/2 -mt-1 text-gray-500 hover:text-white transition-colors">
                                <svg id="eye-icon-password_confirmation" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                        <p class="mt-3 text-xs text-gray-600 font-light">Both passwords must match exactly.</p>
                    </div>

                    {{-- Submit --}}
                    <div class="pt-6 flex flex-wrap items-center gap-8">
                        <button type="submit"
                            class="group flex items-center gap-4 border-b border-white/30 pb-1.5 hover:border-brand-pink transition-colors text-white">
                            <span class="text-sm uppercase tracking-widest">Update Password</span>
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </button>
                        <a href="{{ route('profile') }}" class="text-xs text-gray-600 hover:text-gray-400 transition-colors font-light uppercase tracking-widest">
                            Cancel
                        </a>
                    </div>

                </form>
            </div>

        </div>
    </div>
</section>

@push('scripts')
<script>
    function togglePasswordVisibility(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = document.getElementById('eye-icon-' + fieldId);
        if (field.type === "password") {
            field.type = "text";
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>';
        } else {
            field.type = "password";
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
        }
    }
</script>
@endpush

@endsection
