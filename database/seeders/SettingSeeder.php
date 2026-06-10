<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $generalTerms = <<<HTML
<ul class="space-y-4 text-gray-400 font-light text-sm relative z-10">
    <li class="flex items-start gap-3">
        <span class="text-brand-purple mt-0.5 flex-shrink-0">✦</span>
        <span>Reference / PIN System applies for all registrations.</span>
    </li>
    <li class="flex items-start gap-3">
        <span class="text-brand-purple mt-0.5 flex-shrink-0">✦</span>
        <span>Minimum age: 18 years to participate.</span>
    </li>
    <li class="flex items-start gap-3">
        <span class="text-brand-purple mt-0.5 flex-shrink-0">✦</span>
        <span>Valid ID proof mandatory (Aadhaar Card / Passport / DL).</span>
    </li>
    <li class="flex items-start gap-3">
        <span class="text-brand-purple mt-0.5 flex-shrink-0">✦</span>
        <span>Only one account per person allowed (unless approved by the company).</span>
    </li>
    <li class="flex items-start gap-3">
        <span class="text-brand-purple mt-0.5 flex-shrink-0">✦</span>
        <span>100% Guaranteed Income (Fixed) with certificate through Company.</span>
    </li>
    <li class="flex items-start gap-3">
        <span class="text-brand-purple mt-0.5 flex-shrink-0">✦</span>
        <span>No misleading advertising is allowed under any circumstances.</span>
    </li>
    <li class="flex items-start gap-3">
        <span class="text-brand-purple mt-0.5 flex-shrink-0">✦</span>
        <span>Fraudulent activity results in immediate commission cancellation.</span>
    </li>
</ul>
HTML;

        $financialTerms = <<<HTML
<ul class="space-y-4 text-gray-400 font-light text-sm relative z-10">
    <li class="flex items-start gap-3">
        <span class="text-brand-pink mt-0.5 flex-shrink-0">✦</span>
        <span>KYC Documents: Aadhaar Card / Passport / Driving Licence.</span>
    </li>
    <li class="flex items-start gap-3">
        <span class="text-brand-pink mt-0.5 flex-shrink-0">✦</span>
        <span>5% Admin and TAX charges deducted by Government.</span>
    </li>
    <li class="flex items-start gap-3">
        <span class="text-brand-pink mt-0.5 flex-shrink-0">✦</span>
        <span>Fixed income and profits at success levels as per plan.</span>
    </li>
    <li class="flex items-start gap-3">
        <span class="text-brand-pink mt-0.5 flex-shrink-0">✦</span>
        <span>Worldwide Tour offer as per Company announcement.</span>
    </li>
    <li class="flex items-start gap-3">
        <span class="text-brand-pink mt-0.5 flex-shrink-0">✦</span>
        <span>Generation Plan withdrawal: Monday to Monday weekly.</span>
    </li>
    <li class="flex items-start gap-3">
        <span class="text-brand-pink mt-0.5 flex-shrink-0">✦</span>
        <span>Driving Licence and Aadhaar Card valid in India only for KYC.</span>
    </li>
    <li class="flex items-start gap-3">
        <span class="text-brand-pink mt-0.5 flex-shrink-0">✦</span>
        <span>Every month one ID required to collect monthly salary — No Amount Limit.</span>
    </li>
    <li class="flex items-start gap-3">
        <span class="text-brand-pink mt-0.5 flex-shrink-0">✦</span>
        <span>Funds transferred from the Wallet to the Compounding Fund will earn 0.4% daily compound interest, with the balance expected to approximately double within 5 months.</span>
    </li>
</ul>
HTML;

        \App\Models\Setting::updateOrCreate(
            ['key' => 'general_terms'],
            ['value' => $generalTerms]
        );

        \App\Models\Setting::updateOrCreate(
            ['key' => 'financial_operational_terms'],
            ['value' => $financialTerms]
        );
    }
}
