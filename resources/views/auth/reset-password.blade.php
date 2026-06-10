@extends('layouts.auth')

@section('title', 'Reset Password | AONE APEX ALLIANCE')

@section('content')
<section class="min-h-screen relative flex items-center justify-center pt-24 pb-12">
    <!-- Background Effects -->
    <div class="absolute top-1/3 left-1/3 w-[300px] h-[300px] bg-brand-gold/10 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="w-full max-w-md px-6 relative z-10">
        <div class="text-center mb-10">
            <h1 class="font-serif text-4xl text-white mb-4">Reset Password</h1>
            <p class="text-gray-400 font-light">Create a new password for your account.</p>
        </div>

        <div class="bg-white/[0.02] border border-white/10 p-8 rounded-3xl backdrop-blur-md relative overflow-hidden shadow-2xl">
            <!-- Decorative corner accent -->
            <div class="absolute -top-12 -left-12 w-32 h-32 bg-brand-gold/20 rounded-full blur-[40px] pointer-events-none"></div>

            <form id="reset-password-form" class="space-y-6 relative z-10">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ request()->email }}" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-brand-purple focus:ring-1 focus:ring-brand-purple transition-all" placeholder="you@example.com" required readonly>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">New Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 pr-10 text-white placeholder-gray-500 focus:outline-none focus:border-brand-purple focus:ring-1 focus:ring-brand-purple transition-all" required>
                        <button type="button" onclick="togglePasswordVisibility('password')" class="absolute right-0 top-1/2 -translate-y-1/2 -mt-0 text-gray-500 hover:text-white transition-colors px-3">
                            <svg id="eye-icon-password" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Confirm Password</label>
                    <div class="relative">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 pr-10 text-white placeholder-gray-500 focus:outline-none focus:border-brand-purple focus:ring-1 focus:ring-brand-purple transition-all" required>
                        <button type="button" onclick="togglePasswordVisibility('password_confirmation')" class="absolute right-0 top-1/2 -translate-y-1/2 -mt-0 text-gray-500 hover:text-white transition-colors px-3">
                            <svg id="eye-icon-password_confirmation" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Error Container -->
                <div id="reset-error" class="hidden text-red-500 text-sm mt-2"></div>
                <div id="reset-success" class="hidden text-green-500 text-sm mt-2"></div>

                <!-- Submit Button -->
                <button type="submit" id="reset-btn" class="w-full bg-white/10 hover:bg-white/20 border border-white/20 text-white font-medium py-3 px-4 rounded-xl transition-all duration-300 transform hover:-translate-y-0.5">
                    Reset Password
                </button>
            </form>
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

    document.addEventListener("DOMContentLoaded", function() {
        const resetForm = document.getElementById('reset-password-form');
        const resetBtn = document.getElementById('reset-btn');
        const resetError = document.getElementById('reset-error');
        const resetSuccess = document.getElementById('reset-success');

        resetForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            resetBtn.disabled = true;
            resetBtn.innerText = 'Resetting...';
            resetError.classList.add('hidden');
            resetSuccess.classList.add('hidden');
            resetError.innerText = '';
            resetSuccess.innerText = '';

            const formData = new FormData(resetForm);

            // Frontend Password Match Validation
            if (formData.get('password') !== formData.get('password_confirmation')) {
                resetError.classList.remove('hidden');
                resetError.innerText = 'Passwords do not match.';
                resetBtn.disabled = false;
                resetBtn.innerText = 'Reset Password';
                return;
            }

            fetch('/api/reset-password', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => response.json().then(data => ({ status: response.status, body: data })))
            .then(({ status, body }) => {
                if (status === 200 && body.success) {
                    resetSuccess.classList.remove('hidden');
                    resetSuccess.innerText = body.message || 'Your password has been reset!';
                    resetBtn.innerText = 'Redirecting to Login...';
                    setTimeout(() => {
                        window.location.href = "{{ route('login') }}";
                    }, 2000);
                } else {
                    resetError.classList.remove('hidden');
                    resetError.innerText = body.message || 'Error resetting password.';
                    resetBtn.disabled = false;
                    resetBtn.innerText = 'Reset Password';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                resetError.classList.remove('hidden');
                resetError.innerText = 'Network error. Please try again later.';
                resetBtn.disabled = false;
                resetBtn.innerText = 'Reset Password';
            });
        });
    });
</script>
@endpush
@endsection
