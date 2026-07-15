@extends('layouts.app')

@section('title', 'Welcome to NGF IGR Dashboard')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden bg-slate-900 text-white rounded-3xl mb-12 shadow-xl">
    <!-- Gradient background overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-emerald-900/90 to-slate-900/95 z-0"></div>
    
    <div class="relative z-10 px-8 py-16 sm:px-12 lg:px-16 flex flex-col lg:flex-row items-center justify-between gap-12">
        <div class="max-w-xl text-left">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 mb-6">
                <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                Official NGF Platform
            </span>
            <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-white mb-6 leading-tight">
                Nigeria Governors' Forum <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-300">IGR Dashboard</span>
            </h1>
            <p class="text-base text-slate-300 mb-8 leading-relaxed">
                An interactive framework designed to track, analyze, and optimize Internally Generated Revenue (IGR) across Nigeria's 36 States and the Federal Capital Territory. Assess tax environments, monitor reforms, and share commendable practices.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="/group-explorer" class="px-6 py-3 bg-emerald-500 hover:bg-emerald-400 text-white font-semibold rounded-xl shadow-lg shadow-emerald-500/20 transition-all">
                    Explore Geopolitical Rankings
                </a>
                <a href="#about" class="px-6 py-3 bg-slate-800/80 hover:bg-slate-800 text-slate-200 border border-slate-700 font-semibold rounded-xl transition-all">
                    Learn More
                </a>
            </div>
        </div>

        <!-- Hero Stats Cards -->
        <div class="w-full lg:max-w-sm grid grid-cols-2 gap-4">
            <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-2xl p-5 shadow-lg">
                <i class="fa-solid fa-map-location-dot text-emerald-400 text-2xl mb-3"></i>
                <span class="block text-2xl font-bold text-white mb-1">36+1</span>
                <span class="block text-xs font-medium text-slate-400 uppercase tracking-wider">States & FCT</span>
            </div>
            <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-2xl p-5 shadow-lg">
                <i class="fa-solid fa-chart-pie text-emerald-400 text-2xl mb-3"></i>
                <span class="block text-2xl font-bold text-white mb-1">6</span>
                <span class="block text-xs font-medium text-slate-400 uppercase tracking-wider">Geopolitical Zones</span>
            </div>
            <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-2xl p-5 shadow-lg">
                <i class="fa-solid fa-clock-rotate-left text-emerald-400 text-2xl mb-3"></i>
                <span class="block text-2xl font-bold text-white mb-1">5+ Years</span>
                <span class="block text-xs font-medium text-slate-400 uppercase tracking-wider">Historical Data</span>
            </div>
            <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-2xl p-5 shadow-lg">
                <i class="fa-solid fa-shield-halved text-emerald-400 text-2xl mb-3"></i>
                <span class="block text-2xl font-bold text-white mb-1">Secure</span>
                <span class="block text-xs font-medium text-slate-400 uppercase tracking-wider">SIRS Access Only</span>
            </div>
        </div>
    </div>
</div>

<!-- Explorer Tools Section -->
<div class="mb-16">
    <div class="text-center max-w-2xl mx-auto mb-12">
        <h2 class="text-3xl font-bold text-slate-900 tracking-tight mb-3">Dashboard Framework & Resource Tools</h2>
        <p class="text-slate-500 text-sm">Access deep dives, graphical summaries, and metrics analytics across various database dimensions.</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Card 1: Group Explorer -->
        <a href="/group-explorer" class="group bg-white rounded-2xl border border-slate-200 hover:border-emerald-500/50 hover:shadow-lg transition-all p-6 flex flex-col justify-between">
            <div>
                <div class="h-10 w-10 bg-emerald-50 text-emerald-700 group-hover:bg-emerald-500 group-hover:text-white rounded-xl flex items-center justify-center transition-all mb-4">
                    <i class="fa-solid fa-users text-lg"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 group-hover:text-emerald-700 mb-2 transition-colors">Group Explorer</h3>
                <p class="text-slate-500 text-xs leading-relaxed mb-4">
                    Compare and rank multiple states within geopolitical zones side-by-side. Analyze performance across different categories of tax policies and frameworks.
                </p>
            </div>
            <span class="text-xs font-semibold text-emerald-600 flex items-center gap-1 group-hover:gap-2 transition-all">
                Access Tool <i class="fa-solid fa-arrow-right"></i>
            </span>
        </a>

        <!-- Card 2: State Explorer -->
        <a href="/state-explorer" class="group bg-white rounded-2xl border border-slate-200 hover:border-emerald-500/50 hover:shadow-lg transition-all p-6 flex flex-col justify-between">
            <div>
                <div class="h-10 w-10 bg-emerald-50 text-emerald-700 group-hover:bg-emerald-500 group-hover:text-white rounded-xl flex items-center justify-center transition-all mb-4">
                    <i class="fa-solid fa-magnifying-glass-chart text-lg"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 group-hover:text-emerald-700 mb-2 transition-colors">State Explorer</h3>
                <p class="text-slate-500 text-xs leading-relaxed mb-4">
                    Inspect individual state details. Query exact survey answers regarding Tax Administration, Procedures, Processing, and Enforcement in a specific quarter.
                </p>
            </div>
            <span class="text-xs font-semibold text-emerald-600 flex items-center gap-1 group-hover:gap-2 transition-all">
                Access Tool <i class="fa-solid fa-arrow-right"></i>
            </span>
        </a>

        <!-- Card 3: States' IGR -->
        <a href="/states-igr" class="group bg-white rounded-2xl border border-slate-200 hover:border-emerald-500/50 hover:shadow-lg transition-all p-6 flex flex-col justify-between">
            <div>
                <div class="h-10 w-10 bg-emerald-50 text-emerald-700 group-hover:bg-emerald-500 group-hover:text-white rounded-xl flex items-center justify-center transition-all mb-4">
                    <i class="fa-solid fa-sack-dollar text-lg"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 group-hover:text-emerald-700 mb-2 transition-colors">States' IGR</h3>
                <p class="text-slate-500 text-xs leading-relaxed mb-4">
                    Query monthly Internally Generated Revenue. Monitor breakdown details on PAYE, WHT, Capital Gains Tax, levies, MDA collections, and registry counts.
                </p>
            </div>
            <span class="text-xs font-semibold text-emerald-600 flex items-center gap-1 group-hover:gap-2 transition-all">
                Access Tool <i class="fa-solid fa-arrow-right"></i>
            </span>
        </a>

        <!-- Card 4: Federation Allocation -->
        <a href="/faac" class="group bg-white rounded-2xl border border-slate-200 hover:border-emerald-500/50 hover:shadow-lg transition-all p-6 flex flex-col justify-between">
            <div>
                <div class="h-10 w-10 bg-emerald-50 text-emerald-700 group-hover:bg-emerald-500 group-hover:text-white rounded-xl flex items-center justify-center transition-all mb-4">
                    <i class="fa-solid fa-building-columns text-lg"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 group-hover:text-emerald-700 mb-2 transition-colors">Federation Allocation (FAAC)</h3>
                <p class="text-slate-500 text-xs leading-relaxed mb-4">
                    Monitor monthly distributions from the Federation Account Allocation Committee. Analyze national revenue sharing trends per state or geopolitical zone.
                </p>
            </div>
            <span class="text-xs font-semibold text-emerald-600 flex items-center gap-1 group-hover:gap-2 transition-all">
                Access Tool <i class="fa-solid fa-arrow-right"></i>
            </span>
        </a>

        <!-- Card 5: TRR & Analytics -->
        <a href="/trr" class="group bg-white rounded-2xl border border-slate-200 hover:border-emerald-500/50 hover:shadow-lg transition-all p-6 flex flex-col justify-between">
            <div>
                <div class="h-10 w-10 bg-emerald-50 text-emerald-700 group-hover:bg-emerald-500 group-hover:text-white rounded-xl flex items-center justify-center transition-all mb-4">
                    <i class="fa-solid fa-chart-line text-lg"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 group-hover:text-emerald-700 mb-2 transition-colors">Total Recurrent Revenue</h3>
                <p class="text-slate-500 text-xs leading-relaxed mb-4">
                    Aggregate total revenue (IGR + FAAC Allocation) to analyze the complete fiscal health and self-sustainability ratios of the different states.
                </p>
            </div>
            <span class="text-xs font-semibold text-emerald-600 flex items-center gap-1 group-hover:gap-2 transition-all">
                Access Tool <i class="fa-solid fa-arrow-right"></i>
            </span>
        </a>

        <!-- Card 6: TRR Analytics -->
        <a href="/trr-analysis" class="group bg-white rounded-2xl border border-slate-200 hover:border-emerald-500/50 hover:shadow-lg transition-all p-6 flex flex-col justify-between">
            <div>
                <div class="h-10 w-10 bg-emerald-50 text-emerald-700 group-hover:bg-emerald-500 group-hover:text-white rounded-xl flex items-center justify-center transition-all mb-4">
                    <i class="fa-solid fa-chart-column text-lg"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 group-hover:text-emerald-700 mb-2 transition-colors">TRR Analytics</h3>
                <p class="text-slate-500 text-xs leading-relaxed mb-4">
                    Generate comparative visual chart indicators. Contrast dependency on federal FAAC allocation versus domestic state tax generation capacity.
                </p>
            </div>
            <span class="text-xs font-semibold text-emerald-600 flex items-center gap-1 group-hover:gap-2 transition-all">
                Access Tool <i class="fa-solid fa-arrow-right"></i>
            </span>
        </a>
    </div>
</div>

<!-- About Section -->
<div id="about" class="bg-slate-100 rounded-3xl p-8 sm:p-12 border border-slate-200 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-16">
    <div>
        <h2 class="text-3xl font-bold text-slate-900 mb-6">How the IGR Dashboard Works</h2>
        <div class="space-y-6">
            <!-- Step 1 -->
            <div class="flex gap-4">
                <div class="h-8 w-8 rounded-full bg-emerald-100 text-emerald-800 font-bold flex items-center justify-center shrink-0">1</div>
                <div>
                    <h4 class="font-bold text-slate-800 text-sm mb-1">State Submissions</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">Each State's Internal Revenue Service (SIRS) updates quarterly assessment surveys and enters monthly revenue performance indices securely.</p>
                </div>
            </div>
            <!-- Step 2 -->
            <div class="flex gap-4">
                <div class="h-8 w-8 rounded-full bg-emerald-100 text-emerald-800 font-bold flex items-center justify-center shrink-0">2</div>
                <div>
                    <h4 class="font-bold text-slate-800 text-sm mb-1">NGF Coordination</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">The NGF Secretariat drives the operation, collates submissions, updates national FAAC records, and ensures standard verification.</p>
                </div>
            </div>
            <!-- Step 3 -->
            <div class="flex gap-4">
                <div class="h-8 w-8 rounded-full bg-emerald-100 text-emerald-800 font-bold flex items-center justify-center shrink-0">3</div>
                <div>
                    <h4 class="font-bold text-slate-800 text-sm mb-1">Peer Learning & Peer-to-Peer Support</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">State Governors and SIRS utilize the dashboards to implement needed tax reforms, set realistic targets, and share successful methods.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="relative bg-emerald-950 rounded-2xl p-8 text-white shadow-lg overflow-hidden">
        <div class="absolute top-0 right-0 h-40 w-40 bg-emerald-600/10 rounded-full blur-2xl"></div>
        <h3 class="text-xl font-bold text-white mb-4">Launch & Context</h3>
        <p class="text-xs leading-relaxed text-slate-300 mb-4">
            The IGR Dashboard was officially launched by the Nigeria Governors' Forum on February 15, 2017, as a major flagship program to support State governments raise domestic revenue.
        </p>
        <p class="text-xs leading-relaxed text-slate-300">
            The platform regularizes access to records and provides evidence to drive strong political commitment from State Governors for reforms agreed at the Joint Tax Board (JTB).
        </p>
    </div>
</div>
@endsection
