@extends('layouts.auth')

@section('title', 'Admin Portal | AONE APEX ALLIANCE')

@section('content')
<div class="min-h-screen flex bg-slate-50">

    {{-- LEFT PANEL — Brand --}}
    <div class="hidden lg:flex lg:w-1/2 relative flex-col justify-between p-14 overflow-hidden bg-gradient-to-br from-violet-700 via-violet-600 to-pink-500">

        {{-- Grid overlay --}}
        <div class="absolute inset-0 opacity-[0.08]" style="background-image: linear-gradient(rgba(255,255,255,0.8) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.8) 1px, transparent 1px); background-size: 40px 40px;"></div>

        {{-- Glow blobs --}}
        <div class="absolute top-0 left-0 w-[400px] h-[400px] bg-white/10 rounded-full blur-[120px] -translate-x-1/2 -translate-y-1/3 pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 w-[300px] h-[300px] bg-white/10 rounded-full blur-[100px] translate-x-1/3 translate-y-1/4 pointer-events-none"></div>

        {{-- Logo --}}
        <div class="relative z-10">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5">
                <div class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-sm border border-white/30 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <div>
                    <span class="font-serif font-bold text-xl text-white leading-none">AONE</span>
                    <span class="block text-[10px] uppercase tracking-[0.2em] text-white/60 font-sans leading-none mt-0.5">Admin Portal</span>
                </div>
            </a>
        </div>

        {{-- Central Text --}}
        <div class="relative z-10 max-w-sm">
            <div class="h-14 w-1 bg-white/40 rounded-full mb-8"></div>
            <p class="font-serif text-3xl text-white leading-relaxed mb-6">
                "Control, Monitor, and Empower the AONE Ecosystem."
            </p>
            <p class="text-white/60 font-light text-sm leading-relaxed">
                Secure access portal for authorized administrators only.
            </p>
        </div>

        {{-- Status indicator --}}
        <div class="relative z-10 flex items-center gap-3">
            <div class="w-2 h-2 rounded-full bg-emerald-300 animate-pulse"></div>
            <span class="text-xs text-white/50 uppercase tracking-widest">System Online — All Services Operational</span>
        </div>
    </div>

    {{-- RIGHT PANEL — Login Form --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center px-8 py-20 lg:px-16 bg-white">
        <div class="w-full max-w-md">

            {{-- Mobile logo --}}
            <div class="lg:hidden mb-10 flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-violet-600 to-pink-500 flex items-center justify-center shadow-sm">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <span class="font-serif font-bold text-xl text-slate-800">AONE <span class="text-violet-500 text-sm">Admin</span></span>
            </div>

            {{-- Heading --}}
            <div class="mb-8">
                <h1 class="font-serif text-3xl text-slate-800 font-bold mb-2">Welcome back.</h1>
                <p class="text-slate-500 text-sm">Enter your administrator credentials to access the dashboard.</p>
            </div>

            {{-- Form --}}
            <form id="admin-login-form" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-600 uppercase tracking-widest mb-2">Admin Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <input type="email" id="email" name="email"
                            class="w-full pl-11 pr-4 py-3 border border-slate-300 rounded-xl bg-slate-50 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 focus:bg-white transition-all text-sm"
                            placeholder="admin@aoneapex.com" required>
                    </div>
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-600 uppercase tracking-widest mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <input type="password" id="password" name="password"
                            class="w-full pl-11 pr-4 py-3 border border-slate-300 rounded-xl bg-slate-50 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 focus:bg-white transition-all text-sm"
                            placeholder="••••••••" required>
                    </div>
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center gap-2.5">
                    <input id="remember_me" name="remember_me" value="1" type="checkbox"
                        class="w-4 h-4 border border-slate-300 rounded text-violet-600 focus:ring-violet-400 cursor-pointer accent-violet-600">
                    <label for="remember_me" class="text-sm text-slate-500 cursor-pointer hover:text-slate-700 transition-colors">
                        Keep me signed in
                    </label>
                </div>

                {{-- Error Container --}}
                <div id="login-error" class="hidden flex items-center gap-2 bg-red-50 border border-red-200 text-red-600 text-sm p-3 rounded-xl">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <span id="login-error-text"></span>
                </div>

                {{-- Submit --}}
                <div class="pt-2">
                    <button type="submit" id="login-btn"
                        class="w-full flex items-center justify-between bg-gradient-to-r from-violet-600 to-violet-700 hover:from-violet-700 hover:to-violet-800 text-white font-semibold py-3.5 px-6 rounded-xl transition-all shadow-md shadow-violet-200 hover:shadow-lg hover:shadow-violet-300 group">
                        <span class="text-sm" id="login-btn-text">Sign In to Admin Panel</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </div>
            </form>

            <p class="mt-8 text-center text-xs text-slate-400">
                Restricted access — authorized personnel only.
            </p>
        </div>
    </div>

</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const loginForm = document.getElementById('admin-login-form');
        const loginBtn = document.getElementById('login-btn');
        const loginBtnText = document.getElementById('login-btn-text');
        const loginError = document.getElementById('login-error');
        const loginErrorText = document.getElementById('login-error-text');

        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();

            loginBtn.disabled = true;
            loginBtnText.innerText = 'Authenticating...';
            loginError.classList.add('hidden');

            const formData = new FormData(loginForm);

            fetch('/admin/api/login', {
                method: 'POST',
                headers: { 'Accept': 'application/json' },
                body: formData
            })
            .then(response => response.json().then(data => ({ status: response.status, body: data })))
            .then(({ status, body }) => {
                if (status === 200 && body.success) {
                    loginBtnText.innerText = 'Redirecting...';
                    window.location.href = "{{ route('admin.dashboard') }}";
                } else {
                    loginError.classList.remove('hidden');
                    loginErrorText.innerText = body.message || 'Invalid credentials.';
                    loginBtn.disabled = false;
                    loginBtnText.innerText = 'Sign In to Admin Panel';
                }
            })
            .catch(error => {
                loginError.classList.remove('hidden');
                loginErrorText.innerText = 'Network error. Please try again.';
                loginBtn.disabled = false;
                loginBtnText.innerText = 'Sign In to Admin Panel';
            });
        });
    });
</script>
@endpush
@endsection
