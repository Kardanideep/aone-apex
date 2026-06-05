@extends('layouts.auth')

@section('title', 'Verify Email | AONE APEX ALLIANCE')

@section('content')
<section class="min-h-screen relative flex items-center justify-center pt-24 pb-12">
    <!-- Background Effects -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[400px] h-[400px] bg-brand-purple/10 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="w-full max-w-md px-6 relative z-10 text-center">
        <!-- Icon -->
        <div class="w-20 h-20 bg-brand-purple/10 border border-brand-purple/20 rounded-full flex items-center justify-center mx-auto mb-8 text-brand-purple">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
        </div>

        <h1 class="font-serif text-3xl text-white mb-4">Check your email</h1>
        
        <div class="bg-white/[0.02] border border-white/10 p-8 rounded-3xl backdrop-blur-md relative overflow-hidden shadow-2xl">
            <p class="text-gray-400 font-light mb-6 leading-relaxed">
                Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?
            </p>
            <p class="text-gray-500 font-light text-sm mb-8">
                If you didn't receive the email, we will gladly send you another.
            </p>

            <form action="#" method="POST" class="space-y-4">
                <button type="submit" class="w-full bg-white/10 hover:bg-white/20 border border-white/20 text-white font-medium py-3 px-4 rounded-xl transition-all duration-300">
                    Resend Verification Email
                </button>
            </form>

            <div class="mt-6 border-t border-white/10 pt-6">
                <form action="#" method="POST">
                    <button type="submit" class="text-sm text-gray-500 hover:text-white transition-colors">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
