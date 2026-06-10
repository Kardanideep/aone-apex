@extends('layouts.app')

@section('title', 'Income Plan | AONE APEX ALLIANCE')

@section('content')

@php
    $dailyPercent = $settings['daily_investment_percent'] ?? 1;
    $directPercent = $settings['direct_commission_percent'] ?? 5;
    $level1 = $settings['level_1_percent'] ?? 10;
    $level2 = $settings['level_2_percent'] ?? 7;
    $level3 = $settings['level_3_percent'] ?? 6;
    $level4 = $settings['level_4_percent'] ?? 3;
    $level5 = $settings['level_5_percent'] ?? 2;
    $packages = [20, 50, 100, 200, 500, 1000, 2000, 5000, 10000, 20000];
@endphp

    <!-- Page Header -->
    <section class="pt-32 md:pt-48 pb-16 md:pb-20 relative overflow-hidden">
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-brand-purple/10 rounded-full blur-[150px] pointer-events-none">
        </div>
        <div class="max-w-4xl mx-auto px-6 lg:px-12 text-center relative z-10">
            <div class="flex items-center justify-center gap-4 mb-6">
                <div class="h-[1px] w-8 bg-brand-pink"></div>
                <span class="uppercase tracking-[0.2em] text-xs text-brand-pink font-medium">Opportunities</span>
                <div class="h-[1px] w-8 bg-brand-pink"></div>
            </div>
            <h1 class="font-serif text-4xl sm:text-5xl md:text-7xl mb-6 text-white leading-tight">
                <span class="text-gradient-blue">Income Plan</span>
            </h1>
            <p class="text-lg text-gray-400 font-light max-w-2xl mx-auto">
                Discover the various avenues for generating active and passive income through the AONE APEX ALLIANCE
                ecosystem.
            </p>
        </div>
    </section>

    <!-- Investment & Joining Plans Section -->
    <section class="py-20 relative border-t border-white/5">
        <div class="max-w-5xl mx-auto px-6 lg:px-12">
            <div class="text-center mb-16">
                <h2 class="font-serif text-3xl md:text-4xl text-white mb-6">Investment And Joining Plans</h2>
                <p class="text-gray-400 font-light text-lg max-w-3xl mx-auto">
                    Members can join at any of the 10 investment levels. Daily returns of 1% are credited on a 7-days
                    working income basis. The higher the investment, the greater the returns.
                </p>
            </div>

            <!-- Highlights Cards -->
            <div class="grid md:grid-cols-2 gap-8 mb-16">
                <div
                    class="bg-gradient-to-br from-brand-purple/20 to-transparent border border-brand-purple/30 p-8 rounded-2xl relative overflow-hidden group hover:border-brand-purple/60 transition-colors">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-brand-purple/10 rounded-full blur-3xl group-hover:bg-brand-purple/20 transition-colors">
                    </div>
                    <div class="flex items-center gap-3 mb-4">
                        <svg class="w-6 h-6 text-brand-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        <h3 class="text-xl font-medium text-white">Investment Returns</h3>
                    </div>
                    <ul class="text-gray-300 font-light space-y-2">
                        <li>Daily: {{ $dailyPercent }}% on investment amount</li>
                        <li>Working: 7 days per week</li>
                    </ul>
                </div>
                <div
                    class="bg-gradient-to-br from-brand-gold/20 to-transparent border border-brand-gold/30 p-8 rounded-2xl relative overflow-hidden group hover:border-brand-gold/60 transition-colors">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-brand-gold/10 rounded-full blur-3xl group-hover:bg-brand-gold/20 transition-colors">
                    </div>
                    <div class="flex items-center gap-3 mb-4">
                        <svg class="w-6 h-6 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        <h3 class="text-xl font-medium text-white">Direct Income Lifetime</h3>
                    </div>
                    <ul class="text-gray-300 font-light space-y-2">
                        <li>{{ $directPercent }}% direct referral commission</li>
                        <li>Paid for lifetime on every direct join</li>
                    </ul>
                </div>
            </div>

            <!-- Investment Table -->
            <div class="overflow-x-auto bg-white/[0.02] rounded-2xl border border-white/5 p-4 md:p-8">
                <table class="w-full plan-table border-collapse">
                    <thead>
                        <tr>
                            <th>SR. No.</th>
                            <th class="text-brand-pink">Joining Amount ($)</th>
                            <th>Daily ({{ $dailyPercent }}%)</th>
                            <th class="text-brand-purple">7-Day Return</th>
                            <th>Monthly Return</th>
                            <th>Yearly Return</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($packages as $index => $amount)
                        @php
                            $daily = $amount * ($dailyPercent / 100);
                            $weekly = $daily * 7;
                            $monthly = $daily * 30;
                            $yearly = $daily * 365;
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="font-medium text-white">${{ number_format($amount, 0) }}</td>
                            <td>${{ number_format($daily, 2) }}</td>
                            <td class="text-white">${{ number_format($weekly, 2) }}</td>
                            <td>${{ number_format($monthly, 2) }}</td>
                            <td>${{ number_format($yearly, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Level Income Plan Section -->
    <section class="py-20 relative bg-white/[0.02] border-t border-white/5">
        <div
            class="absolute right-0 top-0 w-[400px] h-[400px] bg-brand-pink/5 rounded-full blur-[100px] pointer-events-none">
        </div>
        <div class="max-w-5xl mx-auto px-6 lg:px-12 relative z-10">
            <div class="text-center mb-16">
                <h2 class="font-serif text-3xl md:text-4xl text-white mb-6">Level Income Plan</h2>
                <p class="text-gray-400 font-light text-lg max-w-3xl mx-auto">
                    Earn passive income from up to 5 levels of your network. The deeper your team, the greater your
                    earnings.
                </p>
            </div>

            <!-- Level Table -->
            <div class="overflow-x-auto rounded-2xl border border-white/5 bg-[#08060F] p-4 md:p-8 max-w-3xl mx-auto">
                <table class="w-full plan-table border-collapse">
                    <thead>
                        <tr>
                            <th>Level</th>
                            <th class="text-brand-gold">Commission %</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-white">Level 1</td>
                            <td class="font-medium text-brand-gold text-lg">{{ $level1 }}%</td>
                            <td>Direct referral income</td>
                        </tr>
                        <tr>
                            <td class="text-white">Level 2</td>
                            <td class="font-medium text-brand-gold text-lg">{{ $level2 }}%</td>
                            <td>Second-tier network income</td>
                        </tr>
                        <tr>
                            <td class="text-white">Level 3</td>
                            <td class="font-medium text-brand-gold text-lg">{{ $level3 }}%</td>
                            <td>Third-tier network income</td>
                        </tr>
                        <tr>
                            <td class="text-white">Level 4</td>
                            <td class="font-medium text-brand-gold text-lg">{{ $level4 }}%</td>
                            <td>Fourth-tier network income</td>
                        </tr>
                        <tr>
                            <td class="text-white">Level 5</td>
                            <td class="font-medium text-brand-gold text-lg">{{ $level5 }}%</td>
                            <td>Passive network income</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Salary Income Section -->
    <!-- <section class="py-20 relative border-t border-white/5">
            <div
                class="absolute left-0 bottom-0 w-[400px] h-[400px] bg-brand-purple/5 rounded-full blur-[100px] pointer-events-none">
            </div>
            <div class="max-w-6xl mx-auto px-6 lg:px-12 relative z-10">
                <div class="text-center mb-16">
                    <h2 class="font-serif text-3xl md:text-4xl text-white mb-6">Salary Income — Lifetime</h2>
                    <p class="text-gray-400 font-light text-lg max-w-4xl mx-auto">
                        Achieve fixed salary milestones by growing your self-business and team network. Once unlocked, salary is
                        paid every month for lifetime — from either Self Business or Direct Business achievements.
                    </p>
                </div>

                <div class="overflow-x-auto bg-white/[0.02] rounded-2xl border border-white/5 p-4 md:p-8">
                    <table class="w-full plan-table border-collapse">
                        <thead>
                            <tr>
                                <th>Level</th>
                                <th>Self Business (INR)</th>
                                <th>Direct Business (INR)</th>
                                <th>Team Business (INR)</th>
                                <th class="text-brand-purple">Monthly Salary (INR)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>100</td>
                                <td>500</td>
                                <td>2,500</td>
                                <td class="font-medium text-brand-purple text-lg">100</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>100</td>
                                <td>1,000</td>
                                <td>5,000</td>
                                <td class="font-medium text-brand-purple text-lg">250</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>100</td>
                                <td>2,500</td>
                                <td>10,000</td>
                                <td class="font-medium text-brand-purple text-lg">500</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>250</td>
                                <td>5,000</td>
                                <td>25,000</td>
                                <td class="font-medium text-brand-purple text-lg">1,000</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>250</td>
                                <td>15,000</td>
                                <td>50,000</td>
                                <td class="font-medium text-brand-purple text-lg">2,500</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>500</td>
                                <td>30,000</td>
                                <td>70,000</td>
                                <td class="font-medium text-brand-purple text-lg">5,000</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>500</td>
                                <td>60,000</td>
                                <td>2,00,000</td>
                                <td class="font-medium text-brand-purple text-lg">10,000</td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>500</td>
                                <td>1,00,000</td>
                                <td>4,00,000</td>
                                <td class="font-medium text-brand-purple text-lg">25,000</td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>1,000</td>
                                <td>2,00,000</td>
                                <td>8,00,000</td>
                                <td class="font-medium text-brand-purple text-lg">50,000</td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>1,000</td>
                                <td>5,00,000</td>
                                <td>1,00,00,000</td>
                                <td class="font-medium text-brand-purple text-lg">1,00,000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section> -->

    <!-- Monthly Salary — Generation Plan Condition -->
    <section class="py-16 relative border-t border-white/5">
        <div class="max-w-5xl mx-auto px-6 lg:px-12">
            <div
                class="flex items-start gap-5 bg-brand-gold/5 border border-brand-gold/25 rounded-2xl p-8 relative overflow-hidden">
                <!-- Gold glow -->
                <div class="absolute top-0 right-0 w-48 h-48 bg-brand-gold/10 rounded-full blur-[80px] pointer-events-none">
                </div>
                <!-- Icon -->
                <div
                    class="w-10 h-10 rounded-full bg-brand-gold/15 border border-brand-gold/40 flex items-center justify-center flex-shrink-0 mt-0.5">
                    <svg class="w-5 h-5 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <!-- Content -->
                <div class="relative z-10">
                    <h3 class="font-serif text-xl text-brand-gold mb-1">Monthly Salary — Generation Plan Condition</h3>
                    <p class="text-xs uppercase tracking-widest text-brand-gold/60 font-medium mb-4">Monthly Salary
                        Collection Condition</p>
                    <p class="text-gray-300 font-light leading-relaxed">
                        To collect monthly salary, <span class="text-white font-medium">one ID is compulsory every
                            month</span>. For collecting salary, the minimum monthly self-business must be <span
                            class="text-white font-medium">100 USDT</span> <span class="text-gray-400">(Self OR Team
                            combined)</span>.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Terms and Conditions Section — Two Panels -->

    <section class="py-20 relative border-t border-white/5">
        <div
            class="absolute top-0 left-0 w-[400px] h-[400px] bg-brand-purple/5 rounded-full blur-[120px] pointer-events-none">
        </div>
        <div class="max-w-5xl mx-auto px-6 lg:px-12 relative z-10">

            <!-- Section heading -->
            <div class="text-center mb-12">
                <div class="flex items-center justify-center gap-4 mb-4">
                    <div class="h-[1px] w-8 bg-brand-pink"></div>
                    <span class="uppercase tracking-[0.2em] text-xs text-brand-pink font-medium">Terms And Conditions</span>
                    <div class="h-[1px] w-8 bg-brand-pink"></div>
                </div>
                <h2 class="font-serif text-3xl md:text-4xl text-white">Rules And Guidelines</h2>
            </div>

            <div class="grid md:grid-cols-2 gap-6">

                <!-- LEFT: General Terms -->
                <div class="bg-brand-purple/5 border border-brand-purple/20 p-8 rounded-2xl relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-40 h-40 bg-brand-purple/10 rounded-full blur-[60px] pointer-events-none">
                    </div>
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            class="w-8 h-8 rounded-full bg-brand-purple/20 border border-brand-purple/40 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-brand-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="font-serif text-xl text-white">General Terms</h3>
                    </div>
                    <div class="prose prose-invert prose-sm max-w-none relative z-10">
                        {!! \App\Models\Setting::where('key', 'general_terms')->value('value') !!}
                    </div>
                </div>

                <!-- RIGHT: Financial & Operational -->
                <div class="bg-brand-pink/5 border border-brand-pink/20 p-8 rounded-2xl relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-40 h-40 bg-brand-pink/10 rounded-full blur-[60px] pointer-events-none">
                    </div>
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            class="w-8 h-8 rounded-full bg-brand-pink/20 border border-brand-pink/40 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="font-serif text-xl text-white">Financial And Operational</h3>
                    </div>
                    <div class="prose prose-invert prose-sm max-w-none relative z-10">
                        {!! \App\Models\Setting::where('key', 'financial_operational_terms')->value('value') !!}
                    </div>
                </div>

            </div>
        </div>
    </section>



    <!-- Example Frontend Connection to API -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // This is an example of connecting the frontend with the newly created backend API
            console.log("Attempting to fetch users from the API...");
            fetch('/api/users')
                .then(response => response.json())
                .then(data => {
                    console.log("API Connection Successful. Data:", data);
                })
                .catch(error => {
                    console.error("API Connection Error:", error);
                });
        });
    </script>
@endsection