@extends('layouts.app')

@section('title', 'Income Plan | AONE APEX ALLIANCE')

@section('content')

    <!-- Page Header -->
    <section class="pt-32 md:pt-48 pb-16 md:pb-20 relative overflow-hidden">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-brand-purple/10 rounded-full blur-[150px] pointer-events-none"></div>
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
                Discover the various avenues for generating active and passive income through the AONE APEX ALLIANCE ecosystem.
            </p>
        </div>
    </section>

    <!-- Investment & Joining Plans Section -->
    <section class="py-20 relative border-t border-white/5">
        <div class="max-w-5xl mx-auto px-6 lg:px-12">
            <div class="text-center mb-16">
                <h2 class="font-serif text-3xl md:text-4xl text-white mb-6">Investment & Joining Plans</h2>
                <p class="text-gray-400 font-light text-lg max-w-3xl mx-auto">
                    Members can join at any of the 10 investment levels. Daily returns of 1% are credited on a 7-days working income basis. The higher the investment, the greater the returns.
                </p>
            </div>

            <!-- Highlights Cards -->
            <div class="grid md:grid-cols-2 gap-8 mb-16">
                <div class="bg-gradient-to-br from-brand-purple/20 to-transparent border border-brand-purple/30 p-8 rounded-2xl relative overflow-hidden group hover:border-brand-purple/60 transition-colors">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-brand-purple/10 rounded-full blur-3xl group-hover:bg-brand-purple/20 transition-colors"></div>
                    <div class="flex items-center gap-3 mb-4">
                        <svg class="w-6 h-6 text-brand-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        <h3 class="text-xl font-medium text-white">Investment Returns</h3>
                    </div>
                    <ul class="text-gray-300 font-light space-y-2">
                        <li>Daily: 2% on investment amount</li>
                        <li>Working: 7 days per week</li>
                    </ul>
                </div>
                <div class="bg-gradient-to-br from-brand-gold/20 to-transparent border border-brand-gold/30 p-8 rounded-2xl relative overflow-hidden group hover:border-brand-gold/60 transition-colors">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-brand-gold/10 rounded-full blur-3xl group-hover:bg-brand-gold/20 transition-colors"></div>
                    <div class="flex items-center gap-3 mb-4">
                        <svg class="w-6 h-6 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="text-xl font-medium text-white">Direct Income Lifetime</h3>
                    </div>
                    <ul class="text-gray-300 font-light space-y-2">
                        <li>5% direct referral commission</li>
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
                            <th>Daily Returns (2%/day)</th>
                            <th class="text-brand-purple">7-Day Working Income</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>1</td><td class="font-medium text-white">$20</td><td>$0.40 / day</td><td class="text-white">$2.80</td></tr>
                        <tr><td>2</td><td class="font-medium text-white">$50</td><td>$1.00 / day</td><td class="text-white">$7.00</td></tr>
                        <tr><td>3</td><td class="font-medium text-white">$100</td><td>$2.00 / day</td><td class="text-white">$14.00</td></tr>
                        <tr><td>4</td><td class="font-medium text-white">$200</td><td>$4.00 / day</td><td class="text-white">$28.00</td></tr>
                        <tr><td>5</td><td class="font-medium text-white">$500</td><td>$10.00 / day</td><td class="text-white">$70.00</td></tr>
                        <tr><td>6</td><td class="font-medium text-white">$1,000</td><td>$20.00 / day</td><td class="text-white">$140.00</td></tr>
                        <tr><td>7</td><td class="font-medium text-white">$2,000</td><td>$40.00 / day</td><td class="text-white">$280.00</td></tr>
                        <tr><td>8</td><td class="font-medium text-white">$5,000</td><td>$100.00 / day</td><td class="text-white">$700.00</td></tr>
                        <tr><td>9</td><td class="font-medium text-white">$10,000</td><td>$200.00 / day</td><td class="text-white">$1,400.00</td></tr>
                        <tr><td>10</td><td class="font-medium text-white">$20,000</td><td>$400.00 / day</td><td class="text-white">$2,800.00</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Level Income Plan Section -->
    <section class="py-20 relative bg-white/[0.02] border-t border-white/5">
        <div class="absolute right-0 top-0 w-[400px] h-[400px] bg-brand-pink/5 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="max-w-5xl mx-auto px-6 lg:px-12 relative z-10">
            <div class="text-center mb-16">
                <h2 class="font-serif text-3xl md:text-4xl text-white mb-6">Level Income Plan</h2>
                <p class="text-gray-400 font-light text-lg max-w-3xl mx-auto">
                    Earn passive income from up to 5 levels of your network. The deeper your team, the greater your earnings.
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
                        <tr><td class="text-white">Level 1</td><td class="font-medium text-brand-gold text-lg">5%</td><td>Direct referral income</td></tr>
                        <tr><td class="text-white">Level 2</td><td class="font-medium text-brand-gold text-lg">4%</td><td>Second-tier network income</td></tr>
                        <tr><td class="text-white">Level 3</td><td class="font-medium text-brand-gold text-lg">3%</td><td>Third-tier network income</td></tr>
                        <tr><td class="text-white">Level 4</td><td class="font-medium text-brand-gold text-lg">2%</td><td>Fourth-tier network income</td></tr>
                        <tr><td class="text-white">Level 5</td><td class="font-medium text-brand-gold text-lg">1%</td><td>Passive network income</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Salary Income Section -->
    <section class="py-20 relative border-t border-white/5">
        <div class="absolute left-0 bottom-0 w-[400px] h-[400px] bg-brand-purple/5 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="max-w-6xl mx-auto px-6 lg:px-12 relative z-10">
            <div class="text-center mb-16">
                <h2 class="font-serif text-3xl md:text-4xl text-white mb-6">Salary Income — Lifetime</h2>
                <p class="text-gray-400 font-light text-lg max-w-4xl mx-auto">
                    Achieve fixed salary milestones by growing your self-business and team network. Once unlocked, salary is paid every month for lifetime — from either Self Business or Direct Business achievements.
                </p>
            </div>

            <!-- Salary Table -->
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
                        <tr><td>1</td><td>100</td><td>500</td><td>2,500</td><td class="font-medium text-brand-purple text-lg">100</td></tr>
                        <tr><td>2</td><td>100</td><td>1,000</td><td>5,000</td><td class="font-medium text-brand-purple text-lg">250</td></tr>
                        <tr><td>3</td><td>100</td><td>2,500</td><td>10,000</td><td class="font-medium text-brand-purple text-lg">500</td></tr>
                        <tr><td>4</td><td>250</td><td>5,000</td><td>25,000</td><td class="font-medium text-brand-purple text-lg">1,000</td></tr>
                        <tr><td>5</td><td>250</td><td>15,000</td><td>50,000</td><td class="font-medium text-brand-purple text-lg">2,500</td></tr>
                        <tr><td>6</td><td>500</td><td>30,000</td><td>70,000</td><td class="font-medium text-brand-purple text-lg">5,000</td></tr>
                        <tr><td>7</td><td>500</td><td>60,000</td><td>2,00,000</td><td class="font-medium text-brand-purple text-lg">10,000</td></tr>
                        <tr><td>8</td><td>500</td><td>1,00,000</td><td>4,00,000</td><td class="font-medium text-brand-purple text-lg">25,000</td></tr>
                        <tr><td>9</td><td>1,000</td><td>2,00,000</td><td>8,00,000</td><td class="font-medium text-brand-purple text-lg">50,000</td></tr>
                        <tr><td>10</td><td>1,000</td><td>5,00,000</td><td>1,00,00,000</td><td class="font-medium text-brand-purple text-lg">1,00,000</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Terms and Conditions Section -->
    <section class="py-20 relative border-t border-white/5">
        <div class="max-w-5xl mx-auto px-6 lg:px-12 relative z-10">
            <div class="bg-gradient-to-br from-brand-pink/5 to-brand-purple/5 border border-white/10 p-8 md:p-12 rounded-3xl relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-brand-pink/10 rounded-full blur-[80px] pointer-events-none"></div>
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                    <h2 class="font-serif text-2xl md:text-3xl text-white">Terms And Conditions</h2>
                </div>
                
                <div class="grid md:grid-cols-2 gap-x-12 gap-y-4 text-gray-400 font-light text-base">
                    <div class="flex items-start group">
                        <span class="text-brand-purple mr-4 mt-0.5 group-hover:scale-110 transition-transform">✦</span>
                        <span>PIN System applies for all registrations and transactions.</span>
                    </div>
                    <div class="flex items-start group">
                        <span class="text-brand-purple mr-4 mt-0.5 group-hover:scale-110 transition-transform">✦</span>
                        <span>Minimum age requirement: 18 years.</span>
                    </div>
                    <div class="flex items-start group">
                        <span class="text-brand-purple mr-4 mt-0.5 group-hover:scale-110 transition-transform">✦</span>
                        <span>Applicant must provide valid ID proof (Aadhaar Card / Passport / etc.).</span>
                    </div>
                    <div class="flex items-start group">
                        <span class="text-brand-purple mr-4 mt-0.5 group-hover:scale-110 transition-transform">✦</span>
                        <span>Only one account per person is allowed, unless explicitly approved by the company.</span>
                    </div>
                    <div class="flex items-start group">
                        <span class="text-brand-purple mr-4 mt-0.5 group-hover:scale-110 transition-transform">✦</span>
                        <span>100% Guaranteed Income as per the plan structure.</span>
                    </div>
                    <div class="flex items-start group">
                        <span class="text-brand-purple mr-4 mt-0.5 group-hover:scale-110 transition-transform">✦</span>
                        <span>Fixed income, profits, and success levels as defined in plan.</span>
                    </div>
                    <div class="flex items-start group">
                        <span class="text-brand-purple mr-4 mt-0.5 group-hover:scale-110 transition-transform">✦</span>
                        <span>No misleading advertising is allowed under any circumstances.</span>
                    </div>
                    <div class="flex items-start group">
                        <span class="text-brand-purple mr-4 mt-0.5 group-hover:scale-110 transition-transform">✦</span>
                        <span>Fraudulent activity can result in immediate commission cancellation.</span>
                    </div>
                    <div class="flex items-start group">
                        <span class="text-brand-purple mr-4 mt-0.5 group-hover:scale-110 transition-transform">✦</span>
                        <span>KYC Documents required: Aadhaar Card / Passport / or equivalent.</span>
                    </div>
                    <div class="flex items-start group">
                        <span class="text-brand-purple mr-4 mt-0.5 group-hover:scale-110 transition-transform">✦</span>
                        <span>5% Admin charges apply on transactions.</span>
                    </div>
                    <div class="flex items-start group md:col-span-2">
                        <span class="text-brand-purple mr-4 mt-0.5 group-hover:scale-110 transition-transform">✦</span>
                        <span>Worldwide Tour offer available as per company announcement from time to time.</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
