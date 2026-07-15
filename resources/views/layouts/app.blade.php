<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NGF IGR Dashboard')</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .glass-panel {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }
        .emerald-gradient {
            background: linear-gradient(135deg, #047857 0%, #065f46 100%);
        }
    </style>
    @yield('styles')
</head>
<body class="bg-slate-50 text-slate-800 font-sans min-h-screen flex flex-col antialiased">
    <!-- Header/Navbar -->
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo & Brand -->
                <div class="flex items-center gap-3">
                    <a href="/" class="flex items-center gap-3">
                        <div class="h-12 w-12 emerald-gradient rounded-xl flex items-center justify-center shadow-md shadow-emerald-700/20">
                            <i class="fa-solid fa-chart-line text-white text-xl"></i>
                        </div>
                        <div>
                            <span class="block text-lg font-bold text-slate-900 tracking-tight leading-tight">NGF IGR Dashboard</span>
                            <span class="block text-[10px] font-semibold text-emerald-600 uppercase tracking-widest leading-none">Nigeria Governors' Forum</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Desk -->
                <nav class="hidden xl:flex space-x-1">
                    <a href="/" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ Request::is('/') ? 'text-emerald-700 bg-emerald-50' : 'text-slate-600 hover:text-emerald-600 hover:bg-slate-50' }}">Home</a>
                    <a href="/group-explorer" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ Request::is('group-explorer*') ? 'text-emerald-700 bg-emerald-50' : 'text-slate-600 hover:text-emerald-600 hover:bg-slate-50' }}">Group Explorer</a>
                    <a href="/state-explorer" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ Request::is('state-explorer*') ? 'text-emerald-700 bg-emerald-50' : 'text-slate-600 hover:text-emerald-600 hover:bg-slate-50' }}">State Explorer</a>
                    <a href="/states-igr" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ Request::is('states-igr*') ? 'text-emerald-700 bg-emerald-50' : 'text-slate-600 hover:text-emerald-600 hover:bg-slate-50' }}">States' IGR</a>
                    <a href="/faac" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ Request::is('faac*') ? 'text-emerald-700 bg-emerald-50' : 'text-slate-600 hover:text-emerald-600 hover:bg-slate-50' }}">FAAC</a>
                    <a href="/trr" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ Request::is('trr') ? 'text-emerald-700 bg-emerald-50' : 'text-slate-600 hover:text-emerald-600 hover:bg-slate-50' }}">TRR</a>
                    <a href="/trr-analysis" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ Request::is('trr-analysis*') ? 'text-emerald-700 bg-emerald-50' : 'text-slate-600 hover:text-emerald-600 hover:bg-slate-50' }}">TRR Analytics</a>
                </nav>

                <!-- Auth / Controls -->
                <div class="hidden xl:flex items-center gap-4">
                    @auth
                        <div class="flex items-center gap-3">
                            <div class="text-right">
                                <span class="block text-xs font-semibold text-slate-800 leading-tight">Welcome, {{ Auth::user()->username }}</span>
                                <span class="block text-[10px] text-slate-400 font-medium">{{ Auth::user()->state }} Role</span>
                            </div>
                            <div class="h-9 w-9 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-800 font-bold text-sm">
                                {{ substr(Auth::user()->state, 0, 2) }}
                            </div>
                        </div>
                        <a href="/admin" class="px-4 py-2 border border-emerald-600 text-emerald-700 hover:bg-emerald-50 rounded-lg text-xs font-semibold transition-all">
                            <i class="fa-solid fa-gauge mr-1"></i> Admin Panel
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-rose-600 hover:bg-rose-500 text-white rounded-lg text-xs font-semibold transition-all shadow-md shadow-rose-600/10">
                                <i class="fa-solid fa-sign-out mr-1"></i> Sign Out
                            </button>
                        </form>
                    @else
                        <a href="/login" class="px-5 py-2.5 bg-emerald-700 hover:bg-emerald-600 text-white font-semibold rounded-lg text-sm transition-all shadow-md shadow-emerald-700/20">
                            <i class="fa-solid fa-sign-in mr-1.5"></i> Admin Sign In
                        </a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="flex xl:hidden">
                    <button onclick="toggleMobileMenu()" type="button" class="inline-flex items-center justify-center p-2 rounded-lg text-slate-600 hover:text-emerald-600 hover:bg-slate-100 focus:outline-none transition duration-150">
                        <i class="fa-solid fa-bars text-xl" id="menuIcon"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div class="hidden xl:hidden bg-white border-t border-slate-200 py-3 px-4 space-y-1 shadow-inner" id="mobileMenu">
            <a href="/" class="block px-3 py-2 rounded-lg text-base font-medium text-slate-700 hover:text-emerald-700 hover:bg-emerald-50">Home</a>
            <a href="/group-explorer" class="block px-3 py-2 rounded-lg text-base font-medium text-slate-700 hover:text-emerald-700 hover:bg-emerald-50">Group Explorer</a>
            <a href="/state-explorer" class="block px-3 py-2 rounded-lg text-base font-medium text-slate-700 hover:text-emerald-700 hover:bg-emerald-50">State Explorer</a>
            <a href="/states-igr" class="block px-3 py-2 rounded-lg text-base font-medium text-slate-700 hover:text-emerald-700 hover:bg-emerald-50">States' IGR</a>
            <a href="/faac" class="block px-3 py-2 rounded-lg text-base font-medium text-slate-700 hover:text-emerald-700 hover:bg-emerald-50">FAAC</a>
            <a href="/trr" class="block px-3 py-2 rounded-lg text-base font-medium text-slate-700 hover:text-emerald-700 hover:bg-emerald-50">TRR</a>
            <a href="/trr-analysis" class="block px-3 py-2 rounded-lg text-base font-medium text-slate-700 hover:text-emerald-700 hover:bg-emerald-50">TRR Analytics</a>
            
            <div class="border-t border-slate-200 my-2 pt-2"></div>
            
            @auth
                <div class="px-3 py-2 mb-3">
                    <span class="block text-sm font-semibold text-slate-800 leading-tight">Welcome, {{ Auth::user()->username }}</span>
                    <span class="block text-xs text-slate-400 font-medium">{{ Auth::user()->state }} Role</span>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <a href="/admin" class="w-full text-center px-4 py-2 border border-emerald-600 text-emerald-700 hover:bg-emerald-50 rounded-lg text-sm font-semibold transition-all">
                        Admin Panel
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="w-full px-4 py-2 bg-rose-600 hover:bg-rose-500 text-white rounded-lg text-sm font-semibold transition-all">
                            Sign Out
                        </button>
                    </form>
                </div>
            @else
                <a href="/login" class="block w-full text-center px-4 py-2.5 bg-emerald-700 hover:bg-emerald-600 text-white font-semibold rounded-lg text-sm transition-all shadow-md shadow-emerald-700/20">
                    Admin Sign In
                </a>
            @endauth
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow py-8 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 border-t border-slate-800 mt-12 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="h-10 w-10 emerald-gradient rounded-xl flex items-center justify-center shadow-md">
                        <i class="fa-solid fa-chart-line text-white text-lg"></i>
                    </div>
                    <span class="text-white font-bold tracking-tight">NGF IGR Dashboard</span>
                </div>
                <p class="text-xs leading-relaxed text-slate-500">
                    Launched by the Nigeria Governors' Forum to support raising domestic revenues, track tax reforms, and facilitate commendable practices via peer learning and technical support.
                </p>
            </div>
            
            <div>
                <h4 class="text-white font-semibold text-sm mb-4 uppercase tracking-wider">Dashboard Explorers</h4>
                <ul class="space-y-2 text-xs">
                    <li><a href="/group-explorer" class="hover:text-emerald-400 transition-colors">Group/Geopolitical Rankings</a></li>
                    <li><a href="/state-explorer" class="hover:text-emerald-400 transition-colors">Individual State Details</a></li>
                    <li><a href="/states-igr" class="hover:text-emerald-400 transition-colors">Internally Generated Revenues</a></li>
                    <li><a href="/faac" class="hover:text-emerald-400 transition-colors">Federation Allocation (FAAC)</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="text-white font-semibold text-sm mb-4 uppercase tracking-wider">Resources & Support</h4>
                <p class="text-xs mb-3 text-slate-500">Need access or help regarding submissions?</p>
                <div class="space-y-2 text-xs">
                    <a href="mailto:info@nggovernorsforum.org" class="block hover:text-emerald-400 transition-colors">
                        <i class="fa-solid fa-envelope mr-1"></i> info@nggovernorsforum.org
                    </a>
                    <span class="block text-slate-500">
                        <i class="fa-solid fa-phone mr-1"></i> +234 (0) 9 292 0001
                    </span>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 border-t border-slate-800 mt-8 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-xs text-slate-600">
                &copy; 2016 - {{ date('Y') }} Nigeria Governors' Forum. All rights reserved. Developed for IGR Peer Learning.
            </p>
            <div class="flex gap-4 text-xs text-slate-600">
                <a href="#" class="hover:text-emerald-400">FAQ</a>
                <span>|</span>
                <a href="#" class="hover:text-emerald-400">User Guide</a>
                <span>|</span>
                <a href="#" class="hover:text-emerald-400">Terms of Use</a>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            const icon = document.getElementById('menuIcon');
            menu.classList.toggle('hidden');
            if(menu.classList.contains('hidden')) {
                icon.className = 'fa-solid fa-bars text-xl';
            } else {
                icon.className = 'fa-solid fa-xmark text-xl';
            }
        }
    </script>
    @yield('scripts')
</body>
</html>
