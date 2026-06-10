@extends('layouts.admin')

@section('title', 'System Settings | AONE APEX Admin')

@section('content')

<!-- Header -->
<div class="mb-6">
    <h1 class="font-serif text-2xl text-slate-800 font-bold mb-1">System Settings</h1>
    <p class="text-slate-500 text-sm">Manage terms & conditions displayed on the public website.</p>
</div>

@if (session('success'))
    <div class="mb-5 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 p-4 rounded-xl text-sm">
        <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        {{ session('success') }}
    </div>
@endif

<div class="max-w-4xl space-y-6">

    <!-- General Terms Card -->
    <div class="admin-card rounded-xl overflow-hidden" id="general-terms-card">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-violet-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-slate-800">General Terms</h2>
                    <p class="text-xs text-slate-400">Displayed in the left panel of the Business Plan page</p>
                </div>
            </div>
            <button type="button" onclick="toggleEdit('general')" id="general-edit-btn"
                class="inline-flex items-center gap-1.5 px-4 py-2 text-xs font-semibold rounded-lg border border-violet-200 text-violet-600 bg-violet-50 hover:bg-violet-100 transition-all">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                <span id="general-edit-text">Edit</span>
            </button>
        </div>

        <!-- Preview Mode: render HTML properly -->
        <div id="general-preview" class="p-6">
            @if(!empty($generalTerms->value ?? ''))
                <div class="text-slate-600 text-sm leading-relaxed">
                    {!! $generalTerms->value !!}
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-8 text-center">
                    <svg class="w-10 h-10 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <p class="text-slate-400 text-sm">No general terms added yet.</p>
                    <p class="text-slate-400 text-xs mt-1">Click <strong>Edit</strong> to add content.</p>
                </div>
            @endif
        </div>

        <!-- Edit Mode: plain text only (hidden by default) -->
        <div id="general-editor" class="p-6 hidden">
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                <input type="hidden" name="field" value="general_terms">
                <textarea
                    name="general_terms"
                    id="general_terms"
                    rows="14"
                    placeholder="Enter each term on a new line, e.g.:&#10;Valid ID proof mandatory (Aadhaar Card / Passport / DL).&#10;Minimum investment amount $20.&#10;Withdrawal within 24-48 hours."
                    class="w-full px-4 py-3 border border-slate-300 rounded-xl bg-slate-50 text-slate-700 text-sm leading-relaxed focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 focus:bg-white transition-all resize-y"
                >{{ old('general_terms', $generalTermsPlain) }}</textarea>
                @error('general_terms')
                    <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-xs text-slate-400">✍️ Write each term on a new line. It will automatically be formatted with bullet points on the website.</p>
                <div class="mt-4 flex items-center gap-3 justify-end">
                    <button type="button" onclick="toggleEdit('general')" class="px-4 py-2 text-sm font-medium text-slate-500 bg-slate-100 hover:bg-slate-200 rounded-lg transition-all">Cancel</button>
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2 bg-violet-600 hover:bg-violet-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Financial & Operational Terms Card -->
    <div class="admin-card rounded-xl overflow-hidden" id="financial-terms-card">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-pink-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-slate-800">Financial And Operational Terms</h2>
                    <p class="text-xs text-slate-400">Displayed in the right panel of the Business Plan page</p>
                </div>
            </div>
            <button type="button" onclick="toggleEdit('financial')" id="financial-edit-btn"
                class="inline-flex items-center gap-1.5 px-4 py-2 text-xs font-semibold rounded-lg border border-pink-200 text-pink-600 bg-pink-50 hover:bg-pink-100 transition-all">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                <span id="financial-edit-text">Edit</span>
            </button>
        </div>

        <!-- Preview Mode: render HTML properly -->
        <div id="financial-preview" class="p-6">
            @if(!empty($financialTerms->value ?? ''))
                <div class="text-slate-600 text-sm leading-relaxed">
                    {!! $financialTerms->value !!}
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-8 text-center">
                    <svg class="w-10 h-10 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <p class="text-slate-400 text-sm">No financial & operational terms added yet.</p>
                    <p class="text-slate-400 text-xs mt-1">Click <strong>Edit</strong> to add content.</p>
                </div>
            @endif
        </div>

        <!-- Edit Mode: plain text only (hidden by default) -->
        <div id="financial-editor" class="p-6 hidden">
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                <input type="hidden" name="field" value="financial_operational_terms">
                <textarea
                    name="financial_operational_terms"
                    id="financial_operational_terms"
                    rows="14"
                    placeholder="Enter each term on a new line, e.g.:&#10;KYC Documents: Aadhaar Card / Passport / Driving Licence.&#10;5% Admin and TAX charges deducted by Government.&#10;Fixed income and profits at success levels as per plan."
                    class="w-full px-4 py-3 border border-slate-300 rounded-xl bg-slate-50 text-slate-700 text-sm leading-relaxed focus:outline-none focus:ring-2 focus:ring-pink-300 focus:border-pink-400 focus:bg-white transition-all resize-y"
                >{{ old('financial_operational_terms', $financialTermsPlain) }}</textarea>
                @error('financial_operational_terms')
                    <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-xs text-slate-400">✍️ Write each term on a new line. It will automatically be formatted with bullet points on the website.</p>
                <div class="mt-4 flex items-center gap-3 justify-end">
                    <button type="button" onclick="toggleEdit('financial')" class="px-4 py-2 text-sm font-medium text-slate-500 bg-slate-100 hover:bg-slate-200 rounded-lg transition-all">Cancel</button>
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2 bg-pink-600 hover:bg-pink-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
    function toggleEdit(section) {
        const preview = document.getElementById(section + '-preview');
        const editor = document.getElementById(section + '-editor');
        const btnText = document.getElementById(section + '-edit-text');

        if (editor.classList.contains('hidden')) {
            preview.classList.add('hidden');
            editor.classList.remove('hidden');
            btnText.textContent = 'Cancel';
            const textarea = editor.querySelector('textarea');
            if (textarea) textarea.focus();
        } else {
            editor.classList.add('hidden');
            preview.classList.remove('hidden');
            btnText.textContent = 'Edit';
        }
    }
</script>
@endpush
