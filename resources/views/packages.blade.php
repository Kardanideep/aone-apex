@extends('layouts.app')

@section('title', 'Investment Packages | AONE APEX ALLIANCE')

@section('content')

    <!-- Page Header -->
    <section class="pt-32 md:pt-48 pb-16 md:pb-20 relative overflow-hidden">
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-brand-pink/10 rounded-full blur-[150px] pointer-events-none"></div>
        <div class="max-w-4xl mx-auto px-6 lg:px-12 text-center relative z-10">
            <div class="flex items-center justify-center gap-4 mb-6">
                <div class="h-[1px] w-8 bg-brand-purple"></div>
                <span class="uppercase tracking-[0.2em] text-xs text-brand-purple font-medium">Investment Tiers</span>
                <div class="h-[1px] w-8 bg-brand-purple"></div>
            </div>
            <h1 class="font-serif text-5xl md:text-7xl mb-6 text-white leading-tight">
                Choose Your <br><em class="font-light italic text-gray-400">Opportunity.</em>
            </h1>
            <p class="text-lg text-gray-400 font-light max-w-2xl mx-auto">
                Explore our dynamic package options designed to fit every level of commitment. Secure your place in the global ecosystem.
            </p>
        </div>
    </section>

    <!-- Packages Grid -->
    <section class="py-12 relative z-10">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">

            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 xl:gap-8">
                @forelse($packages as $package)
                @auth
                    @if(auth()->user()->status === 'active')
                    <button onclick="openPurchaseModal({{ $package->id }}, '{{ addslashes($package->name ?? 'Tier ' . $loop->iteration) }}', {{ $package->amount }})" class="package-card relative group w-full text-left bg-white/[0.02] border border-white/5 rounded-3xl p-8 flex flex-col justify-between overflow-hidden">
                    @else
                    <button onclick="alert('Your account must be active to purchase packages. Please complete KYC.')" class="package-card relative group w-full text-left bg-white/[0.02] border border-white/5 rounded-3xl p-8 flex flex-col justify-between overflow-hidden">
                    @endif
                @else
                    <a href="{{ route('login') }}" class="package-card relative group bg-white/[0.02] border border-white/5 rounded-3xl p-8 flex flex-col justify-between overflow-hidden">
                @endauth
                
                    <!-- Hover gradient background -->
                    <div class="absolute inset-0 bg-gradient-to-br from-brand-pink/5 to-brand-purple/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    
                    <div class="relative z-10">
                        <div class="text-xs uppercase tracking-widest text-gray-500 mb-6">{{ $package->name ?? 'Tier ' . $loop->iteration }}</div>
                        <div class="flex items-start gap-1 mb-8">
                            <span class="text-3xl font-light text-brand-pink mt-1">$</span>
                            <h2 class="font-serif text-5xl text-white">{{ number_format($package->amount) }}</h2>
                        </div>
                    </div>
                    
                    <div class="relative z-10 mt-auto pt-8 border-t border-white/5">
                        <div class="flex items-center justify-between group-hover:text-white text-gray-400 transition-colors">
                            <span class="text-sm tracking-wide">@auth {{ auth()->user()->status === 'active' ? 'Buy Now' : 'Requires KYC' }} @else Login to Buy @endauth</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </div>
                    </div>
                
                @auth
                    </button>
                @else
                    </a>
                @endauth
                @empty
                <div class="col-span-full text-center text-gray-400 py-12">
                    No investment packages available at the moment. Please check back later.
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Investment Quote Banner -->
    <section class="py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-brand-pink/10 via-brand-purple/10 to-brand-pink/5 pointer-events-none"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[300px] bg-brand-purple/20 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="max-w-5xl mx-auto px-6 lg:px-12 relative z-10 text-center">
            <!-- Top decorative line -->
            <div class="flex items-center justify-center gap-6 mb-10">
                <div class="h-[1px] flex-1 max-w-[80px] bg-gradient-to-r from-transparent to-brand-pink"></div>
                <div class="w-2 h-2 rounded-full bg-brand-pink"></div>
                <div class="h-[1px] flex-1 max-w-[80px] bg-gradient-to-l from-transparent to-brand-pink"></div>
            </div>

            <blockquote class="font-serif text-2xl sm:text-3xl md:text-4xl lg:text-5xl text-white leading-[1.3] font-light">
                <span class="text-brand-pink text-6xl leading-none font-serif">&ldquo;</span>
                <span>Invest smartly today&mdash;<br class="hidden sm:block">earn
                    <span class="relative inline-block">
                        <span class="text-gradient font-semibold">1% daily returns</span>
                    </span>
                    with income flowing
                    <span class="text-gradient font-semibold">7 working days</span>
                    a week.
                </span>
                <span class="text-brand-pink text-6xl leading-none font-serif">&rdquo;</span>
            </blockquote>

            <!-- Bottom decorative line -->
            <div class="flex items-center justify-center gap-6 mt-10">
                <div class="h-[1px] flex-1 max-w-[80px] bg-gradient-to-r from-transparent to-brand-purple"></div>
                <div class="w-2 h-2 rounded-full bg-brand-purple"></div>
                <div class="h-[1px] flex-1 max-w-[80px] bg-gradient-to-l from-transparent to-brand-purple"></div>
            </div>

            <div class="mt-12">
                <a href="{{ route('business-plan') }}" class="inline-flex items-center gap-3 bg-gradient-to-r from-brand-pink to-brand-purple hover:from-brand-purple hover:to-brand-pink text-white font-medium px-10 py-4 rounded-full transition-all duration-300 transform hover:-translate-y-0.5 shadow-[0_0_30px_rgba(213,63,140,0.3)] text-sm uppercase tracking-widest">
                    View Income Plan
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
@auth
    @if(auth()->user()->status === 'active')
    <!-- Purchase Modal -->
    <div id="purchaseModal" class="fixed inset-0 z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closePurchaseModal()"></div>
        
        <!-- Modal Content -->
        <div class="relative w-full max-w-md bg-[#0a0015] border border-brand-purple/30 rounded-3xl p-8 transform scale-95 transition-transform duration-300 shadow-[0_0_50px_rgba(124,58,237,0.2)]">
            <button onclick="closePurchaseModal()" class="absolute top-6 right-6 text-gray-500 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            
            <h3 class="font-serif text-2xl text-white mb-2">Confirm Purchase</h3>
            <p class="text-sm text-gray-400 font-light mb-6">You are about to invest in the AONE ecosystem.</p>
            
            <div class="bg-white/5 border border-white/10 rounded-xl p-5 mb-6">
                <div class="text-xs uppercase tracking-widest text-gray-500 mb-1">Selected Package</div>
                <div class="flex items-center justify-between">
                    <span id="modalPackageName" class="text-lg text-white font-medium">Tier</span>
                    <span id="modalPackageAmount" class="text-2xl text-brand-pink font-serif font-bold">$0</span>
                </div>
            </div>

            <form id="purchaseForm" class="space-y-6">
                @csrf
                <input type="hidden" id="packageIdInput" name="package_id" value="">
                
                @if(!auth()->user()->sponsor_id)
                <div class="space-y-2">
                    <label for="referral_code" class="block text-xs uppercase tracking-widest text-gray-400">Referral Code / Sponsor ID (Optional)</label>
                    <input type="text" id="referral_code" name="referral_code" placeholder="e.g. AONE123456" class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white text-sm placeholder-gray-600 focus:outline-none focus:border-brand-purple transition-colors">
                    <p class="text-xs text-gray-500">Enter a valid Sponsor ID to give them direct income bonus.</p>
                </div>
                @else
                <div class="bg-brand-purple/10 border border-brand-purple/20 rounded-lg p-4 flex items-center gap-3">
                    <svg class="w-5 h-5 text-brand-purple flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-xs text-gray-400">Your sponsor is already set. They will receive the direct bonus for this purchase.</p>
                </div>
                @endif

                <div id="purchaseMessage" class="hidden rounded-lg p-4 text-sm text-center"></div>

                <button type="submit" id="purchaseSubmitBtn" class="w-full relative overflow-hidden rounded-xl py-4 text-sm uppercase tracking-widest font-semibold text-white transition-all duration-300 hover:shadow-lg hover:shadow-brand-purple/25 hover:-translate-y-0.5" style="background: linear-gradient(135deg, #7c3aed, #ec4899);">
                    <span id="purchaseBtnText">Confirm Purchase</span>
                    <span id="purchaseBtnLoader" class="hidden">
                        <svg class="animate-spin h-5 w-5 mx-auto text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
                </button>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('purchaseModal');
        const modalContent = modal.querySelector('div.relative.w-full');
        const purchaseForm = document.getElementById('purchaseForm');

        function openPurchaseModal(id, name, amount) {
            document.getElementById('packageIdInput').value = id;
            document.getElementById('modalPackageName').textContent = name;
            document.getElementById('modalPackageAmount').textContent = '$' + Number(amount).toLocaleString();
            
            // Reset state
            const msgBox = document.getElementById('purchaseMessage');
            msgBox.classList.add('hidden');
            if (document.getElementById('referral_code')) {
                document.getElementById('referral_code').value = '';
            }

            // Show modal
            modal.classList.remove('hidden');
            // Trigger reflow for animation
            void modal.offsetWidth;
            modal.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95');
        }

        function closePurchaseModal() {
            modal.classList.add('opacity-0');
            modalContent.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        if (purchaseForm) {
            purchaseForm.addEventListener('submit', async function (e) {
                e.preventDefault();

                const btn = document.getElementById('purchaseSubmitBtn');
                const btnText = document.getElementById('purchaseBtnText');
                const btnLoader = document.getElementById('purchaseBtnLoader');
                const msgBox = document.getElementById('purchaseMessage');

                btn.disabled = true;
                btnText.classList.add('hidden');
                btnLoader.classList.remove('hidden');
                msgBox.classList.add('hidden');

                try {
                    const formData = new FormData(purchaseForm);
                    const response = await fetch('/api/packages/checkout', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || purchaseForm.querySelector('input[name="_token"]').value,
                            'Accept': 'application/json',
                        },
                        body: formData,
                    });

                    const data = await response.json();

                    if (response.ok && data.success && data.url) {
                        msgBox.className = 'rounded-lg p-4 text-sm text-center bg-emerald-500/15 border border-emerald-500/30 text-emerald-300';
                        msgBox.textContent = 'Redirecting to secure payment gateway...';
                        msgBox.classList.remove('hidden');

                        setTimeout(() => {
                            window.location.href = data.url; // Redirect to Stripe Checkout
                        }, 1000);
                    } else {
                        msgBox.className = 'rounded-lg p-4 text-sm text-center bg-red-500/15 border border-red-500/30 text-red-300';
                        msgBox.textContent = data.message || 'Checkout failed. Please try again.';
                        msgBox.classList.remove('hidden');
                        
                        btn.disabled = false;
                        btnText.classList.remove('hidden');
                        btnLoader.classList.add('hidden');
                    }
                } catch (err) {
                    msgBox.className = 'rounded-lg p-4 text-sm text-center bg-red-500/15 border border-red-500/30 text-red-300';
                    msgBox.textContent = 'Something went wrong.';
                    msgBox.classList.remove('hidden');

                    btn.disabled = false;
                    btnText.classList.remove('hidden');
                    btnLoader.classList.add('hidden');
                }
            });
        }
    </script>
    @endif
@endauth
@endpush
