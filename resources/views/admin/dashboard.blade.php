@extends('layouts.admin')

@section('title', 'Admin Dashboard | AONE APEX')

@section('content')

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="font-serif text-2xl text-slate-800 font-bold mb-1">Dashboard Overview</h1>
        <p class="text-slate-500 text-sm">System statistics and current status at a glance.</p>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

        <!-- Total Users -->
        <div class="admin-card stat-card-blue p-4 rounded-xl">
            <div class="flex items-start justify-between">
                <div>
                    <div class="text-slate-500 text-[10px] font-semibold uppercase tracking-widest mb-1">Total Users</div>
                    <div class="text-2xl font-serif font-bold text-slate-800">{{ number_format($totalUsers) }}</div>
                    <div class="text-xs text-slate-400 mt-1">Registered members</div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-500 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Inquiries -->
        <div class="admin-card stat-card-cyan p-4 rounded-xl">
            <div class="flex items-start justify-between">
                <div>
                    <div class="text-slate-500 text-[10px] font-semibold uppercase tracking-widest mb-1">Inquiries</div>
                    <div class="text-2xl font-serif font-bold text-slate-800">{{ number_format($totalInquiries) }}</div>
                    <div class="text-xs text-slate-400 mt-1">Contact submissions</div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-cyan-50 flex items-center justify-center text-cyan-500 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Active Packages -->
        <div class="admin-card stat-card-pink p-4 rounded-xl">
            <div class="flex items-start justify-between">
                <div>
                    <div class="text-slate-500 text-[10px] font-semibold uppercase tracking-widest mb-1">Active Packages</div>
                    <div class="text-2xl font-serif font-bold text-slate-800">{{ number_format($activePackages) }}</div>
                    <div class="text-xs text-slate-400 mt-1">Investment plans</div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-pink-50 flex items-center justify-center text-pink-500 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Amount Received -->
        <div class="admin-card stat-card-amber p-4 rounded-xl">
            <div class="flex items-start justify-between">
                <div>
                    <div class="text-slate-500 text-[10px] font-semibold uppercase tracking-widest mb-1">Total Received</div>
                    <div class="text-2xl font-serif font-bold text-slate-800">${{ number_format($totalAmountReceived, 2) }}</div>
                    <div class="text-xs text-slate-400 mt-1">Total revenue</div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center text-amber-500 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

    </div>

    <!-- Chart/Activity Area -->
    <div class="admin-card rounded-xl p-6">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6 gap-4">
            <div>
                <h2 class="text-base font-semibold text-slate-800">Revenue Statistics</h2>
                <p class="text-xs text-slate-400 mt-0.5">Amount received over time</p>
            </div>
            <div class="flex items-center bg-slate-100 rounded-lg p-1">
                <button onclick="updateChart('currentMonth')" id="btn-currentMonth"
                    class="chart-btn px-4 py-1.5 text-xs font-medium rounded-md bg-white shadow-sm text-slate-800 transition-all">Current
                    Month</button>
                <button onclick="updateChart('currentYear')" id="btn-currentYear"
                    class="chart-btn px-4 py-1.5 text-xs font-medium rounded-md text-slate-500 hover:text-slate-800 transition-all">Current
                    Year</button>
                <button onclick="updateChart('lastYear')" id="btn-lastYear"
                    class="chart-btn px-4 py-1.5 text-xs font-medium rounded-md text-slate-500 hover:text-slate-800 transition-all">Last
                    1 Year</button>
            </div>
        </div>

        <div class="w-full h-80">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const currentMonthData = @json($currentMonthData);
        const currentYearData = @json($currentYearData);
        const lastOneYearData = @json($lastOneYearData);

        let chartInstance = null;

        function renderChart(labels, data) {
            const ctx = document.getElementById('revenueChart').getContext('2d');

            if (chartInstance) {
                chartInstance.destroy();
            }

            // Gradient for the line chart
            const gradient = ctx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(107, 70, 193, 0.4)');
            gradient.addColorStop(1, 'rgba(107, 70, 193, 0.0)');

            const totalDuration = 1000;
            const delayBetweenPoints = totalDuration / data.length;
            const previousY = (ctx) => ctx.index === 0 ? ctx.chart.scales.y.getPixelForValue(0) : ctx.chart.getDatasetMeta(ctx.datasetIndex).data[ctx.index - 1].getProps(['y'], true).y;

            chartInstance = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Amount Received ($)',
                        data: data,
                        borderColor: '#6B46C1',
                        backgroundColor: gradient,
                        borderWidth: 2,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#6B46C1',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        x: {
                            type: 'number',
                            easing: 'linear',
                            duration: delayBetweenPoints,
                            from: NaN,
                            delay(ctx) {
                                if (ctx.type !== 'data' || ctx.xStarted) {
                                    return 0;
                                }
                                ctx.xStarted = true;
                                return ctx.index * delayBetweenPoints;
                            }
                        },
                        y: {
                            type: 'number',
                            easing: 'linear',
                            duration: delayBetweenPoints,
                            from: previousY,
                            delay(ctx) {
                                if (ctx.type !== 'data' || ctx.yStarted) {
                                    return 0;
                                }
                                ctx.yStarted = true;
                                return ctx.index * delayBetweenPoints;
                            }
                        }
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            titleColor: '#f8fafc',
                            bodyColor: '#f8fafc',
                            padding: 12,
                            cornerRadius: 8,
                            displayColors: false,
                            callbacks: {
                                label: function (context) {
                                    return '$' + context.parsed.y.toLocaleString();
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: { color: '#64748b', font: { size: 11, family: '"Plus Jakarta Sans", sans-serif' } }
                        },
                        y: {
                            grid: { color: '#f1f5f9' },
                            grace: '10%',
                            ticks: {
                                color: '#64748b',
                                font: { size: 11, family: '"Plus Jakarta Sans", sans-serif' },
                                callback: function (value) {
                                    if (value >= 1000) return '$' + (value / 1000) + 'k';
                                    return '$' + value;
                                }
                            },
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        function updateChart(period) {
            // Update buttons styling
            document.querySelectorAll('.chart-btn').forEach(btn => {
                btn.classList.remove('bg-white', 'shadow-sm', 'text-slate-800');
                btn.classList.add('text-slate-500');
            });
            const activeBtn = document.getElementById('btn-' + period);
            activeBtn.classList.remove('text-slate-500');
            activeBtn.classList.add('bg-white', 'shadow-sm', 'text-slate-800');

            // Extract data based on period
            let labels = [];
            let data = [];

            const today = new Date();

            if (period === 'currentMonth') {
                const currentYear = today.getFullYear();
                const currentMonth = today.getMonth();
                const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

                for (let i = 1; i <= daysInMonth; i++) {
                    const d = new Date(currentYear, currentMonth, i);
                    labels.push(d.toLocaleDateString('en-US', { month: 'short', day: 'numeric' }));

                    const dateString = currentYear + '-' + String(currentMonth + 1).padStart(2, '0') + '-' + String(i).padStart(2, '0');
                    const match = currentMonthData.find(item => item.date === dateString);
                    data.push(match ? parseFloat(match.total) : 0);
                }
            } else if (period === 'currentYear') {
                const currentYear = today.getFullYear();
                for (let i = 0; i < 12; i++) {
                    const d = new Date(currentYear, i, 1);
                    labels.push(d.toLocaleDateString('en-US', { month: 'short' }));

                    const monthString = currentYear + '-' + String(i + 1).padStart(2, '0');
                    const match = currentYearData.find(item => item.month === monthString);
                    data.push(match ? parseFloat(match.total) : 0);
                }
            } else if (period === 'lastYear') {
                for (let i = 11; i >= 0; i--) {
                    const d = new Date(today.getFullYear(), today.getMonth() - i, 1);
                    labels.push(d.toLocaleDateString('en-US', { month: 'short', year: 'numeric' }));

                    const monthString = d.getFullYear() + '-' + String(d.getMonth() + 1).padStart(2, '0');
                    const match = lastOneYearData.find(item => item.month === monthString);
                    data.push(match ? parseFloat(match.total) : 0);
                }
            }

            renderChart(labels, data);
        }

        // Initialize with current month chart
        document.addEventListener('DOMContentLoaded', () => {
            updateChart('currentMonth');
        });
    </script>
@endpush