{{-- Reusable Contact / Inquiry Form Partial --}}
{{-- Include this with: @include('partials.contact-form') --}}

<div class="bg-white/[0.02] border border-white/10 p-8 md:p-12 rounded-3xl backdrop-blur-md relative overflow-hidden shadow-2xl">
    
    {{-- Success Message --}}
    <div id="contact-success" class="hidden text-center py-12">
        <div class="w-16 h-16 rounded-full bg-emerald-500/20 flex items-center justify-center mx-auto mb-6">
            <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        </div>
        <h3 class="font-serif text-2xl text-white mb-3">Message Sent!</h3>
        <p class="text-gray-400 font-light" id="contact-success-msg">We'll get back to you shortly.</p>
        <button onclick="resetContactForm()" class="mt-6 text-sm text-brand-pink hover:text-white transition-colors underline underline-offset-4">Send another message</button>
    </div>

    {{-- Form --}}
    <form id="contact-form" class="space-y-6 relative z-10">
        @csrf
        <div class="grid md:grid-cols-2 gap-6">
            {{-- Name --}}
            <div>
                <label for="contact-name" class="block text-sm font-medium text-gray-300 mb-2">Full Name <span class="text-brand-pink">*</span></label>
                <input type="text" id="contact-name" name="name" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-brand-purple focus:ring-1 focus:ring-brand-purple transition-all" placeholder="John Doe" required>
            </div>

            {{-- Phone --}}
            <div>
                <label for="contact-phone" class="block text-sm font-medium text-gray-300 mb-2">Phone Number <span class="text-brand-pink">*</span></label>
                <input type="tel" id="contact-phone" name="phone" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-brand-purple focus:ring-1 focus:ring-brand-purple transition-all" placeholder="+1 (555) 123-4567" required>
            </div>
        </div>

        {{-- Email (Optional) --}}
        <div>
            <label for="contact-email" class="block text-sm font-medium text-gray-300 mb-2">Email Address <span class="text-gray-600 text-xs">(Optional)</span></label>
            <input type="email" id="contact-email" name="email" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-brand-purple focus:ring-1 focus:ring-brand-purple transition-all" placeholder="john@example.com">
        </div>

        {{-- Subject / Inquiry Type --}}
        <div>
            <label for="contact-subject" class="block text-sm font-medium text-gray-300 mb-2">Subject / Inquiry Type <span class="text-brand-pink">*</span></label>
            <select id="contact-subject" name="subject" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-brand-purple focus:ring-1 focus:ring-brand-purple transition-all appearance-none" required>
                <option value="" disabled selected class="text-gray-600">Select an inquiry type</option>
                <option value="General Inquiry">General Inquiry</option>
                <option value="Technical Support">Technical Support</option>
                <option value="Investment Plans">Investment Plans</option>
                <option value="Partnership Opportunities">Partnership Opportunities</option>
                <option value="Other">Other</option>
            </select>
        </div>

        {{-- Message --}}
        <div>
            <label for="contact-message" class="block text-sm font-medium text-gray-300 mb-2">Message <span class="text-brand-pink">*</span></label>
            <textarea id="contact-message" name="message" rows="5" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-brand-purple focus:ring-1 focus:ring-brand-purple transition-all resize-none" placeholder="How can we help you?" required></textarea>
        </div>

        {{-- Error Container --}}
        <div id="contact-error" class="hidden bg-red-500/10 border border-red-500/20 text-red-400 p-3 rounded-xl text-sm"></div>

        {{-- Submit Button --}}
        <button type="submit" id="contact-submit-btn" class="w-full bg-gradient-to-r from-brand-pink to-brand-purple hover:from-brand-purple hover:to-brand-pink text-white font-medium py-4 px-4 rounded-xl transition-all duration-300 transform hover:-translate-y-0.5 shadow-[0_0_20px_rgba(213,63,140,0.3)] mt-2">
            <span id="contact-btn-text">Send Message</span>
        </button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('contact-form');
        const successDiv = document.getElementById('contact-success');
        const successMsg = document.getElementById('contact-success-msg');
        const errorDiv = document.getElementById('contact-error');
        const submitBtn = document.getElementById('contact-submit-btn');
        const btnText = document.getElementById('contact-btn-text');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            submitBtn.disabled = true;
            btnText.innerText = 'Sending...';
            errorDiv.classList.add('hidden');

            const formData = new FormData(form);

            fetch('/contact', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || formData.get('_token'),
                },
                body: formData
            })
            .then(response => response.json().then(data => ({ status: response.status, body: data })))
            .then(({ status, body }) => {
                if (status === 200 && body.success) {
                    form.classList.add('hidden');
                    successMsg.innerText = body.message;
                    successDiv.classList.remove('hidden');
                } else {
                    errorDiv.classList.remove('hidden');
                    errorDiv.innerText = body.message || 'Something went wrong. Please try again.';
                    submitBtn.disabled = false;
                    btnText.innerText = 'Send Message';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                errorDiv.classList.remove('hidden');
                errorDiv.innerText = 'Network error. Please check your connection and try again.';
                submitBtn.disabled = false;
                btnText.innerText = 'Send Message';
            });
        });
    });

    function resetContactForm() {
        const form = document.getElementById('contact-form');
        const successDiv = document.getElementById('contact-success');
        const submitBtn = document.getElementById('contact-submit-btn');
        const btnText = document.getElementById('contact-btn-text');

        form.reset();
        form.classList.remove('hidden');
        successDiv.classList.add('hidden');
        submitBtn.disabled = false;
        btnText.innerText = 'Send Message';
    }
</script>
