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
            <form id="login-form" class="space-y-6">
                @csrf

                {{-- Identifier (User ID or Email) --}}
                <div class="group">
                    <label for="identifier" class="block text-xs font-medium text-gray-500 uppercase tracking-widest mb-3">User ID or Email</label>
                    <input type="text" id="identifier" name="identifier"
                        class="w-full bg-transparent border-0 border-b border-white/15 pb-3 text-white text-base placeholder-gray-700 focus:outline-none focus:border-brand-pink transition-colors duration-300"
                        placeholder="AONE123 or you@example.com" required>
                </div>

                {{-- Password --}}
                <div class="group">
                    <div class="flex items-center justify-between mb-3">
                        <label for="password" class="block text-xs font-medium text-gray-500 uppercase tracking-widest">Password</label>
                        <a href="{{ route('password.request') }}" class="text-xs text-gray-500 hover:text-brand-pink transition-colors">Forgot it?</a>
                    </div>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                            class="w-full bg-transparent border-0 border-b border-white/15 pb-3 pr-10 text-white text-base placeholder-gray-700 focus:outline-none focus:border-brand-pink transition-colors duration-300"
                            placeholder="••••••••" required>
                        <button type="button" onclick="togglePasswordVisibility('password')" class="absolute right-0 top-1/2 -translate-y-1/2 -mt-1 text-gray-500 hover:text-white transition-colors">
                            <svg id="eye-icon-password" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center gap-3 pt-2">
                    <input id="remember_me" name="remember_me" value="1" type="checkbox"
                        class="w-4 h-4 border border-white/20 bg-transparent rounded-sm text-brand-purple focus:ring-0 cursor-pointer">
                    <label for="remember_me" class="text-sm text-gray-500 cursor-pointer hover:text-gray-300 transition-colors">
                        Keep me signed in
                    </label>
                </div>

                {{-- Error Container --}}
                <div id="login-error" class="hidden text-red-500 text-sm mt-2"></div>

                {{-- Submit --}}
                <div class="pt-4">
                    <button type="submit" id="login-btn"
                        class="w-full flex items-center justify-between bg-white text-[#030009] font-medium py-4 px-7 rounded-xl group hover:bg-brand-pink hover:text-white transition-all duration-300">
                        <span class="text-sm uppercase tracking-widest" id="login-btn-text">Sign In</span>
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

    document.addEventListener("DOMContentLoaded", function() {
        const loginForm = document.getElementById('login-form');
        const loginBtn = document.getElementById('login-btn');
        const loginBtnText = document.getElementById('login-btn-text');
        const loginError = document.getElementById('login-error');

        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            loginBtn.disabled = true;
            loginBtnText.innerText = 'Signing In...';
            loginError.classList.add('hidden');
            loginError.innerText = '';

            const formData = new FormData(loginForm);

            fetch('/api/login', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => response.json().then(data => ({ status: response.status, body: data })))
            .then(({ status, body }) => {
                if (status === 200 && body.success) {
                    loginBtnText.innerText = 'Redirecting...';
                    window.location.href = "{{ route('profile') }}";
                } else {
                    loginError.classList.remove('hidden');
                    loginError.innerText = body.message || 'Invalid credentials.';
                    loginBtn.disabled = false;
                    loginBtnText.innerText = 'Sign In';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                loginError.classList.remove('hidden');
                loginError.innerText = 'Network error. Please try again later.';
                loginBtn.disabled = false;
                loginBtnText.innerText = 'Sign In';
            });
        });
    });
</script>
@endpush
@endsection
