<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard | AONE APEX')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                    },
                    colors: {
                        brand: {
                            dark: '#030009',
                            purple: '#6B46C1',
                            pink: '#D53F8C',
                            indigo: '#4F46E5',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background-color: #f1f5f9;
            color: #1e293b;
            overflow-x: hidden;
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* Sidebar */
        .admin-sidebar {
            background: #ffffff;
            border-right: 1px solid #e2e8f0;
            box-shadow: 2px 0 8px rgba(0,0,0,0.04);
        }

        /* Top Header */
        .admin-header {
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
        }

        /* Table styles */
        .admin-table th {
            background: #f8fafc;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.08em;
            padding: 0.875rem 1rem;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }
        .admin-table td {
            padding: 0.875rem 1rem;
            border-bottom: 1px solid #f1f5f9;
            color: #475569;
            font-size: 0.875rem;
        }
        .admin-table tbody tr:hover td {
            background: #f8fafc;
        }
        .admin-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Nav active link */
        .nav-active {
            background: linear-gradient(135deg, #ede9fe, #fce7f3);
            color: #6B46C1;
            font-weight: 500;
        }
        .nav-active svg { color: #6B46C1; }

        /* Cards */
        .admin-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            transition: box-shadow 0.2s ease;
        }
        .admin-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.08); }

        /* Stat card accent */
        .stat-card-blue   { border-left: 4px solid #3b82f6; }
        .stat-card-cyan   { border-left: 4px solid #06b6d4; }
        .stat-card-pink   { border-left: 4px solid #ec4899; }
        .stat-card-amber  { border-left: 4px solid #f59e0b; }
    </style>
    @yield('head')
</head>

<body class="antialiased font-sans flex h-screen overflow-hidden bg-slate-50">

    <!-- OVERLAY -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-slate-900/50 z-20 hidden md:hidden transition-opacity opacity-0" onclick="toggleSidebar()"></div>

    <!-- SIDEBAR -->
    <aside id="sidebar" class="admin-sidebar w-64 h-full flex flex-col flex-shrink-0 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition duration-300 ease-in-out z-30 bg-white">

        <!-- Logo -->
        <div class="h-16 flex items-center justify-between px-6 border-b border-slate-100">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-violet-600 to-pink-500 flex items-center justify-center shadow-sm">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <div>
                    <span class="font-serif font-bold text-slate-800 text-base leading-none">AONE</span>
                    <span class="block text-[9px] uppercase tracking-[0.15em] text-violet-500 font-sans font-semibold leading-none mt-0.5">Admin Panel</span>
                </div>
            </a>
            <button class="md:hidden text-slate-400 hover:text-slate-600 focus:outline-none" onclick="toggleSidebar()">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- Navigation -->
        <div class="flex-1 overflow-y-auto py-5 px-3 space-y-6">

            <!-- Overview -->
            <div>
                <div class="px-3 text-[10px] font-semibold text-slate-400 uppercase tracking-widest mb-2">Overview</div>
                <div class="space-y-0.5">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all {{ request()->routeIs('admin.dashboard') ? 'nav-active' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        <svg class="w-4.5 h-4.5 w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                        Dashboard
                    </a>
                </div>
            </div>

            <!-- User Management -->
            <div>
                <div class="px-3 text-[10px] font-semibold text-slate-400 uppercase tracking-widest mb-2">Users</div>
                <div class="space-y-0.5">
                    <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all {{ request()->routeIs('admin.users.*') ? 'nav-active' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        User List
                    </a>
                </div>
            </div>

            <!-- Investment Plans -->
            <div>
                <div class="px-3 text-[10px] font-semibold text-slate-400 uppercase tracking-widest mb-2">Investment Plans</div>
                <div class="space-y-0.5">
                    <a href="{{ route('admin.packages.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all {{ request()->routeIs('admin.packages.*') ? 'nav-active' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        Packages
                    </a>
                    <a href="{{ route('admin.income-plan.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all {{ request()->routeIs('admin.income-plan.*') ? 'nav-active' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                        Income Plan
                    </a>
                </div>
            </div>

            <!-- Inquiries -->
            <div>
                <div class="px-3 text-[10px] font-semibold text-slate-400 uppercase tracking-widest mb-2">Support</div>
                <div class="space-y-0.5">
                    <a href="{{ route('admin.inquiries.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all {{ request()->routeIs('admin.inquiries.*') ? 'nav-active' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                        View Inquiries
                    </a>
                </div>
            </div>

            <!-- Wallets -->
            <div>
                <div class="px-3 text-[10px] font-semibold text-slate-400 uppercase tracking-widest mb-2">Wallets</div>
                <div class="space-y-0.5">
                    <a href="{{ route('admin.wallets.system') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all {{ request()->routeIs('admin.wallets.system') ? 'nav-active' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                        System Wallet
                    </a>
                    <a href="{{ route('admin.wallets.users') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all {{ request()->routeIs('admin.wallets.users') || request()->routeIs('admin.wallets.user-detail') ? 'nav-active' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        User Wallets
                    </a>
                    <a href="{{ route('admin.wallets.withdrawals') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all {{ request()->routeIs('admin.wallets.withdrawals*') ? 'nav-active' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Withdrawals
                    </a>
                </div>
            </div>

            <!-- Settings -->
            <div>
                <div class="px-3 text-[10px] font-semibold text-slate-400 uppercase tracking-widest mb-2">System</div>
                <div class="space-y-0.5">
                    <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all {{ request()->routeIs('admin.settings.*') ? 'nav-active' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Settings
                    </a>
                    <form action="{{ route('admin.logout') }}" method="POST" class="m-0 p-0">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all text-slate-600 hover:bg-red-50 hover:text-red-600">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>

        </div>

        <!-- Admin User Bottom -->
        <div class="p-4 border-t border-slate-100">
            <div class="flex items-center gap-3 px-3 py-3 rounded-xl bg-slate-50 border border-slate-200">
                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-violet-500 to-pink-400 flex items-center justify-center text-white font-serif text-sm font-bold shadow-sm">
                    {{ substr(Auth::guard('admin')->user()->name ?? 'A', 0, 1) }}
                </div>
                <div class="flex-1 overflow-hidden">
                    <div class="text-sm text-slate-800 font-medium truncate">{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</div>
                    <div class="text-xs text-slate-400 truncate">Administrator</div>
                </div>
                <div class="w-2 h-2 rounded-full bg-emerald-400 flex-shrink-0" title="Online"></div>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col h-full overflow-hidden w-full relative">

        <!-- MOBILE HEADER -->
        <div class="md:hidden flex items-center justify-between bg-white border-b border-slate-100 px-4 h-16 flex-shrink-0 z-10 w-full">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-violet-600 to-pink-500 flex items-center justify-center shadow-sm">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <div>
                    <span class="font-serif font-bold text-slate-800 text-base leading-none">AONE</span>
                </div>
            </div>
            <button onclick="toggleSidebar()" class="text-slate-500 hover:text-slate-800 focus:outline-none p-2 rounded-md hover:bg-slate-50">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </div>

        <!-- PAGE CONTENT -->
        <main class="flex-1 overflow-y-auto p-4 md:p-8 relative">
            @yield('content')
        </main>

    </div>

    @stack('scripts')
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            if (sidebar.classList.contains('-translate-x-full')) {
                // Open sidebar
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                setTimeout(() => overlay.classList.remove('opacity-0'), 10); // Fade in
            } else {
                // Close sidebar
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('opacity-0');
                setTimeout(() => overlay.classList.add('hidden'), 300); // Wait for fade out
            }
        }
    </script>
</body>
</html>
