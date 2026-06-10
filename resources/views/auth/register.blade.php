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

            {{-- Form Container --}}
            <div id="register-container">
                <form id="register-form" class="space-y-6">
                    @csrf
                    
                    {{-- Full Name --}}
                    <div>
                        <label for="name" class="block text-xs font-medium text-gray-500 uppercase tracking-widest mb-3">Full Name</label>
                        <input type="text" id="name" name="name"
                            class="w-full bg-transparent border-0 border-b border-white/15 pb-3 text-white text-base placeholder-gray-700 focus:outline-none focus:border-brand-purple transition-colors duration-300"
                            placeholder="e.g. Ravi Sharma" required>
                    </div>

                    {{-- Email & Mobile Row --}}
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block text-xs font-medium text-gray-500 uppercase tracking-widest mb-3">Email Address</label>
                            <input type="email" id="email" name="email"
                                class="w-full bg-transparent border-0 border-b border-white/15 pb-3 text-white text-base placeholder-gray-700 focus:outline-none focus:border-brand-purple transition-colors duration-300"
                                placeholder="you@example.com" required>
                        </div>
                        <div>
                            <label for="mobile" class="block text-xs font-medium text-gray-500 uppercase tracking-widest mb-3">Mobile Number</label>
                            <input type="tel" id="mobile" name="mobile"
                                class="w-full bg-transparent border-0 border-b border-white/15 pb-3 text-white text-base placeholder-gray-700 focus:outline-none focus:border-brand-purple transition-colors duration-300"
                                placeholder="+91 9876543210" required>
                        </div>
                    </div>

                    {{-- Referral Code (Optional) --}}
                    <div>
                        <label for="referral_code" class="block text-xs font-medium text-gray-500 uppercase tracking-widest mb-3">Referral Code (Optional)</label>
                        <input type="text" id="referral_code" name="referral_code"
                            class="w-full bg-transparent border-0 border-b border-white/15 pb-3 text-white text-base placeholder-gray-700 focus:outline-none focus:border-brand-purple transition-colors duration-300"
                            placeholder="e.g. AONE123456" value="{{ request('ref') }}">
                    </div>

                    {{-- Password row --}}
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label for="password" class="block text-xs font-medium text-gray-500 uppercase tracking-widest mb-3">Password</label>
                            <div class="relative">
                                <input type="password" id="password" name="password"
                                    class="w-full bg-transparent border-0 border-b border-white/15 pb-3 pr-10 text-white text-base placeholder-gray-700 focus:outline-none focus:border-brand-purple transition-colors duration-300"
                                    placeholder="Min. 8 chars" required>
                                <button type="button" onclick="togglePasswordVisibility('password')" class="absolute right-0 top-1/2 -translate-y-1/2 -mt-1 text-gray-500 hover:text-white transition-colors">
                                    <svg id="eye-icon-password" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-xs font-medium text-gray-500 uppercase tracking-widest mb-3">Confirm</label>
                            <div class="relative">
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="w-full bg-transparent border-0 border-b border-white/15 pb-3 pr-10 text-white text-base placeholder-gray-700 focus:outline-none focus:border-brand-purple transition-colors duration-300"
                                    placeholder="Repeat password" required>
                                <button type="button" onclick="togglePasswordVisibility('password_confirmation')" class="absolute right-0 top-1/2 -translate-y-1/2 -mt-1 text-gray-500 hover:text-white transition-colors">
                                    <svg id="eye-icon-password_confirmation" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Error Message Container --}}
                    <div id="register-error" class="hidden text-red-500 text-sm mt-2"></div>

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
                        <button type="submit" id="register-btn"
                            class="w-full flex items-center justify-between bg-white text-[#030009] font-medium py-4 px-7 rounded-xl group hover:bg-brand-purple hover:text-white transition-all duration-300">
                            <span class="text-sm uppercase tracking-widest" id="register-btn-text">Create Account</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            {{-- OTP Verification Container (Hidden by Default) --}}
            <div id="otp-container" class="hidden">
                <form id="otp-form" class="space-y-6">
                    @csrf
                    <div class="mb-4">
                        <p class="text-gray-400 text-sm">We've sent a 6-digit OTP to your email. Please enter it below to verify your account.</p>
                    </div>
                    
                    <input type="hidden" id="verify_user_id" name="user_id">

                    <div>
                        <label for="otp" class="block text-xs font-medium text-gray-500 uppercase tracking-widest mb-3">Enter OTP</label>
                        <input type="text" id="otp" name="otp" maxlength="6"
                            class="w-full bg-transparent border-0 border-b border-white/15 pb-3 text-center tracking-[0.5em] text-white text-2xl placeholder-gray-700 focus:outline-none focus:border-brand-purple transition-colors duration-300"
                            placeholder="------" required>
                    </div>

                    <div id="otp-error" class="hidden text-red-500 text-sm mt-2"></div>

                    <div class="pt-4">
                        <button type="submit" id="otp-btn"
                            class="w-full flex items-center justify-between bg-brand-purple text-white font-medium py-4 px-7 rounded-xl group hover:bg-brand-pink transition-all duration-300">
                            <span class="text-sm uppercase tracking-widest" id="otp-btn-text">Verify Account</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

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
        const registerForm = document.getElementById('register-form');
        const registerBtn = document.getElementById('register-btn');
        const registerBtnText = document.getElementById('register-btn-text');
        const registerError = document.getElementById('register-error');
        const registerContainer = document.getElementById('register-container');

        const otpForm = document.getElementById('otp-form');
        const otpBtn = document.getElementById('otp-btn');
        const otpBtnText = document.getElementById('otp-btn-text');
        const otpError = document.getElementById('otp-error');
        const otpContainer = document.getElementById('otp-container');
        const verifyUserId = document.getElementById('verify_user_id');

        // Handle Registration Form Submission
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Basic UI State
            registerBtn.disabled = true;
            registerBtnText.innerText = 'Processing...';
            registerError.classList.add('hidden');
            registerError.innerText = '';

            const formData = new FormData(registerForm);
            
            // Frontend Password Match Validation
            if (formData.get('password') !== formData.get('password_confirmation')) {
                registerError.classList.remove('hidden');
                registerError.innerText = 'Passwords do not match.';
                registerBtn.disabled = false;
                registerBtnText.innerText = 'Create Account';
                return;
            }

            fetch('/api/users', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => response.json().then(data => ({ status: response.status, body: data })))
            .then(({ status, body }) => {
                if (status === 201 && body.success) {
                    // Registration successful, OTP sent
                    verifyUserId.value = body.user_id; // Store user_id for OTP verification
                    
                    // Switch UI
                    registerContainer.classList.add('hidden');
                    otpContainer.classList.remove('hidden');
                } else {
                    // Validation or other errors
                    registerError.classList.remove('hidden');
                    registerError.innerText = body.message || 'An error occurred during registration.';
                    registerBtn.disabled = false;
                    registerBtnText.innerText = 'Create Account';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                registerError.classList.remove('hidden');
                registerError.innerText = 'Network error. Please try again later.';
                registerBtn.disabled = false;
                registerBtnText.innerText = 'Create Account';
            });
        });

        // Handle OTP Form Submission
        otpForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Basic UI State
            otpBtn.disabled = true;
            otpBtnText.innerText = 'Verifying...';
            otpError.classList.add('hidden');
            otpError.innerText = '';

            const formData = new FormData(otpForm);

            fetch('/api/verify-otp', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => response.json().then(data => ({ status: response.status, body: data })))
            .then(({ status, body }) => {
                if (status === 200 && body.success) {
                    // OTP verified successfully
                    otpBtnText.innerText = 'Verified! Redirecting...';
                    setTimeout(() => {
                        window.location.href = "{{ route('login') }}"; // Redirect to login page
                    }, 1500);
                } else {
                    // Invalid OTP
                    otpError.classList.remove('hidden');
                    otpError.innerText = body.message || 'Invalid OTP.';
                    otpBtn.disabled = false;
                    otpBtnText.innerText = 'Verify Account';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                otpError.classList.remove('hidden');
                otpError.innerText = 'Network error. Please try again later.';
                otpBtn.disabled = false;
                otpBtnText.innerText = 'Verify Account';
            });
        });
    });
</script>
@endpush
@endsection
