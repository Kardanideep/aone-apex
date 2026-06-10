@extends('layouts.auth')

@section('title', 'Forgot Password | AONE APEX ALLIANCE')

@section('content')
<section class="min-h-screen relative flex items-center justify-center pt-24 pb-12">
    <!-- Background Effects -->
    <div class="absolute top-1/3 left-1/3 w-[300px] h-[300px] bg-brand-gold/10 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="w-full max-w-md px-6 relative z-10">
        <div class="text-center mb-10">
            <h1 class="font-serif text-4xl text-white mb-4">Reset Password</h1>
            <p class="text-gray-400 font-light">Enter your email and we'll send you a link to reset your password.</p>
        </div>

        <div class="bg-white/[0.02] border border-white/10 p-8 rounded-3xl backdrop-blur-md relative overflow-hidden shadow-2xl">
            <!-- Decorative corner accent -->
            <div class="absolute -top-12 -left-12 w-32 h-32 bg-brand-gold/20 rounded-full blur-[40px] pointer-events-none"></div>

            <form id="forgot-password-form" class="space-y-6 relative z-10">
                @csrf
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                    <input type="email" id="email" name="email" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-brand-purple focus:ring-1 focus:ring-brand-purple transition-all" placeholder="you@example.com" required>
                </div>

                <!-- Error Container -->
                <div id="forgot-error" class="hidden text-red-500 text-sm mt-2"></div>
                <div id="forgot-success" class="hidden text-green-500 text-sm mt-2"></div>

                <!-- Submit Button -->
                <button type="submit" id="forgot-btn" class="w-full bg-white/10 hover:bg-white/20 border border-white/20 text-white font-medium py-3 px-4 rounded-xl transition-all duration-300 transform hover:-translate-y-0.5">
                    Send Reset Link
                </button>
            </form>

            <div class="mt-8 text-center text-sm text-gray-400">
                Remember your password? 
                <a href="{{ route('login') }}" class="text-white hover:text-brand-pink font-medium transition-colors">Back to log in</a>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const forgotForm = document.getElementById('forgot-password-form');
        const forgotBtn = document.getElementById('forgot-btn');
        const forgotError = document.getElementById('forgot-error');
        const forgotSuccess = document.getElementById('forgot-success');

        forgotForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            forgotBtn.disabled = true;
            forgotBtn.innerText = 'Sending...';
            forgotError.classList.add('hidden');
            forgotSuccess.classList.add('hidden');
            forgotError.innerText = '';
            forgotSuccess.innerText = '';

            const formData = new FormData(forgotForm);

            fetch('/api/forgot-password', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => response.json().then(data => ({ status: response.status, body: data })))
            .then(({ status, body }) => {
                if (status === 200 && body.success) {
                    forgotSuccess.classList.remove('hidden');
                    forgotSuccess.innerText = body.message || 'We have emailed your password reset link!';
                    forgotForm.reset();
                    forgotBtn.innerText = 'Send Reset Link';
                    forgotBtn.disabled = false;
                } else {
                    forgotError.classList.remove('hidden');
                    forgotError.innerText = body.message || 'Error sending password reset link.';
                    forgotBtn.disabled = false;
                    forgotBtn.innerText = 'Send Reset Link';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                forgotError.classList.remove('hidden');
                forgotError.innerText = 'Network error. Please try again later.';
                forgotBtn.disabled = false;
                forgotBtn.innerText = 'Send Reset Link';
            });
        });
    });
</script>
@endpush
@endsection
