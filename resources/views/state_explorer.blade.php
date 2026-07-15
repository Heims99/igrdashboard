@extends('layouts.app')

@section('title', 'State Explorer - NGF IGR Dashboard')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight mb-2">State Explorer</h1>
    <p class="text-sm text-slate-500">Inspect survey responses and tax administrative parameters for a specific state.</p>
</div>

<!-- Filters Panel -->
<div class="glass-panel rounded-2xl p-6 mb-8 shadow-sm">
    <form method="GET" action="/state-explorer" class="grid grid-cols-1 sm:grid-cols-4 gap-4 items-end">
        <div>
            <label for="state" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Select State</label>
            <select name="state" id="state" class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                @foreach($states as $st)
                    <option value="{{ $st->stateName }}" {{ $selectedState == $st->stateName ? 'selected' : '' }}>
                        {{ $st->stateName }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div>
            <label for="quarter" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Quarter</label>
            <select name="quarter" id="quarter" class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                @foreach($quarters as $q)
                    <option value="{{ $q->quarter }}" {{ $selectedQuarter == $q->quarter ? 'selected' : '' }}>
                        {{ $q->quarter }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="year" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Year</label>
            <select name="year" id="year" class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                @foreach($years as $year)
                    <option value="{{ $year->year }}" {{ $selectedYear == $year->year ? 'selected' : '' }}>
                        {{ $year->year }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <button type="submit" class="w-full bg-emerald-700 hover:bg-emerald-600 text-white font-semibold py-2.5 px-4 rounded-xl shadow-md transition-all">
                <i class="fa-solid fa-magnifying-glass mr-1.5"></i> Inspect State
            </button>
        </div>
    </form>
</div>

<!-- Overview Stats Grid -->
<div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm text-center">
        <span class="block text-xs text-slate-400 font-semibold uppercase tracking-wider mb-1">Overall Rank Score</span>
        <span class="block text-3xl font-extrabold text-emerald-800">{{ $scores['overall'] }}%</span>
    </div>
    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm text-center">
        <span class="block text-xs text-slate-400 font-semibold uppercase tracking-wider mb-1">Tax Administration</span>
        <span class="block text-2xl font-bold text-slate-800">{{ $scores['admin'] }}%</span>
    </div>
    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm text-center">
        <span class="block text-xs text-slate-400 font-semibold uppercase tracking-wider mb-1">Tax Procedures</span>
        <span class="block text-2xl font-bold text-slate-800">{{ $scores['procedure'] }}%</span>
    </div>
    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm text-center">
        <span class="block text-xs text-slate-400 font-semibold uppercase tracking-wider mb-1">Tax Processing</span>
        <span class="block text-2xl font-bold text-slate-800">{{ $scores['processing'] }}%</span>
    </div>
    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm text-center">
        <span class="block text-xs text-slate-400 font-semibold uppercase tracking-wider mb-1">Tax Enforcement</span>
        <span class="block text-2xl font-bold text-slate-800">{{ $scores['enforcement'] }}%</span>
    </div>
</div>

<!-- Tabs Control -->
<div class="border-b border-slate-200 mb-6 flex flex-wrap gap-2" id="tabs">
    <button onclick="switchTab('admin')" class="px-5 py-3 border-b-2 font-bold text-sm transition-all focus:outline-none border-emerald-600 text-emerald-700 active-tab-btn" id="btn-admin">
        1. Tax Administration
    </button>
    <button onclick="switchTab('procedures')" class="px-5 py-3 border-b-2 font-bold text-sm text-slate-500 hover:text-slate-700 transition-all focus:outline-none border-transparent" id="btn-procedures">
        2. Tax Procedures
    </button>
    <button onclick="switchTab('processing')" class="px-5 py-3 border-b-2 font-bold text-sm text-slate-500 hover:text-slate-700 transition-all focus:outline-none border-transparent" id="btn-processing">
        3. Tax Processing
    </button>
    <button onclick="switchTab('enforcement')" class="px-5 py-3 border-b-2 font-bold text-sm text-slate-500 hover:text-slate-700 transition-all focus:outline-none border-transparent" id="btn-enforcement">
        4. Tax Enforcement
    </button>
</div>

<!-- Tabs Content Panels -->
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 mb-8" id="tabContent">
    
    <!-- Tab 1: Tax Administration -->
    <div id="panel-admin" class="space-y-6">
        <h3 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-3"><i class="fa-solid fa-shield-halved mr-2 text-emerald-600"></i> Tax Administration & Infrastructure</h3>
        @if($survey)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">Autonomous SBIRS Structure</span>
                    <span class="font-bold text-slate-800">{{ $survey->sbirs_gov ?: 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">Governing Board Meetings</span>
                    <span class="font-bold text-slate-800">{{ $survey->sbirs_meet ?: 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">Total Core Tax Staff</span>
                    <span class="font-bold text-slate-800">{{ $survey->core_tax ?: 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">Total Support Staff</span>
                    <span class="font-bold text-slate-800">{{ $survey->support_role ?: 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">Field Offices Count</span>
                    <span class="font-bold text-slate-800">{{ $survey->num_offices ?: 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">Internet Connectivity in Offices</span>
                    <span class="font-bold text-slate-800">{{ $survey->internet == '1' ? 'Yes' : 'No' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">Functional Website Available</span>
                    <span class="font-bold text-slate-800">{{ $survey->function_website ?: 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">Tax Guide / Calculators on Website</span>
                    <span class="font-bold text-slate-800">{{ $survey->tax_guide == 'Yes' ? 'Yes' : 'No' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">Standardized Reporting Formats</span>
                    <span class="font-bold text-slate-800">{{ $survey->standardrpt_format ?: 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">Funding Mechanism</span>
                    <span class="font-bold text-slate-800">{{ $survey->sbirs_fund ?: 'N/A' }}</span>
                </div>
            </div>
            @if($survey->comment)
                <div class="bg-slate-50 rounded-xl p-4 mt-6 border border-slate-150">
                    <span class="block text-xs font-bold text-slate-400 uppercase mb-2">Remarks / Comments</span>
                    <p class="text-xs text-slate-600 italic">{{ $survey->comment }}</p>
                </div>
            @endif
        @else
            <p class="text-sm text-slate-400 py-6 text-center">No survey response submitted for Tax Administration.</p>
        @endif
    </div>

    <!-- Tab 2: Tax Procedures -->
    <div id="panel-procedures" class="space-y-6 hidden">
        <h3 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-3"><i class="fa-solid fa-list-check mr-2 text-emerald-600"></i> Taxpayer Registration & Guidance</h3>
        @if($survey1)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">TIN Captured / Maintained</span>
                    <span class="font-bold text-slate-800">{{ $survey1->tin_captured ?: 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">TIN Update Frequency</span>
                    <span class="font-bold text-slate-800">{{ $survey1->tin_often_updated ?: 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">Self Assessment Allowed</span>
                    <span class="font-bold text-slate-800">{{ $survey1->self_assessment ?: 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">Registered Taxpayers Count</span>
                    <span class="font-bold text-slate-800">{{ number_format((double)$survey1->num_reg_taxpayer) ?: 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">Standard Forms Used</span>
                    <span class="font-bold text-slate-800">{{ $survey1->standard_form ?: 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">Forms Available Online</span>
                    <span class="font-bold text-slate-800">{{ $survey1->avail_online ?: 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">Written Guidance Material Available</span>
                    <span class="font-bold text-slate-800">{{ $survey1->guidance ?: 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">Objection Rights Displayed</span>
                    <span class="font-bold text-slate-800">{{ $survey1->object_right ?: 'N/A' }}</span>
                </div>
            </div>
        @else
            <p class="text-sm text-slate-400 py-6 text-center">No survey response submitted for Tax Procedures.</p>
        @endif
    </div>

    <!-- Tab 3: Tax Processing -->
    <div id="panel-processing" class="space-y-6 hidden">
        <h3 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-3"><i class="fa-solid fa-server mr-2 text-emerald-600"></i> Collection Channels & Audits</h3>
        @if($survey2)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">Central Processing Platform</span>
                    <span class="font-bold text-slate-800">{{ $survey2->central_platform ?: 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">Automated Payments Enabled</span>
                    <span class="font-bold text-slate-800">{{ $survey2->auto_platform ?: 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">Real-Time Access to Records</span>
                    <span class="font-bold text-slate-800">{{ $survey2->realtime_acc ?: 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">Uses Consultants for Collections</span>
                    <span class="font-bold text-slate-800">{{ $survey2->use_consultant ?: 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">Exclusive Collection Agents Allowed</span>
                    <span class="font-bold text-slate-800">{{ $survey2->exclu_agent ?: 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">MDA Collections Collated</span>
                    <span class="font-bold text-slate-800">{{ $survey2->collate_mda_levies ?: 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">LGA Collections Collated</span>
                    <span class="font-bold text-slate-800">{{ $survey2->collate_lga_levies ?: 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">Audited Financial Accounts</span>
                    <span class="font-bold text-slate-800">{{ $survey2->payment_audit ?: 'N/A' }}</span>
                </div>
            </div>
        @else
            <p class="text-sm text-slate-400 py-6 text-center">No survey response submitted for Tax Processing.</p>
        @endif
    </div>

    <!-- Tab 4: Tax Enforcement -->
    <div id="panel-enforcement" class="space-y-6 hidden">
        <h3 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-3"><i class="fa-solid fa-gavel mr-2 text-emerald-600"></i> Enforcement Actions & Compliance</h3>
        @if($survey3)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">HNWI Desk Established</span>
                    <span class="font-bold text-slate-800">{{ $survey3->hnwi_unit ?: 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">Active HNWI Audits</span>
                    <span class="font-bold text-slate-800">{{ $survey3->hnwi_action ?: 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">Inter-Agency Data Cooperations</span>
                    <span class="font-bold text-slate-800">{{ $survey3->agency_coop ?: 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">Mandatory TIN for TCC</span>
                    <span class="font-bold text-slate-800">{{ $survey3->tin_tcc ?: 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">Debt Enforcement Actions</span>
                    <span class="font-bold text-slate-800">{{ $survey3->debt_enforce ?: 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">Court Cases Handled</span>
                    <span class="font-bold text-slate-800">{{ $survey3->case_handled ?: 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">Dedicated VAIDS Unit</span>
                    <span class="font-bold text-slate-800">{{ $survey3->vaids_unit ?: 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">Servicom Desk Active</span>
                    <span class="font-bold text-slate-800">{{ $survey3->servicom ?: 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 py-2.5 text-sm">
                    <span class="text-slate-500">State Joint Tax Board (SJTB) active</span>
                    <span class="font-bold text-slate-800">{{ $survey3->sjtb_functioning ?: 'N/A' }}</span>
                </div>
            </div>
            
            <div class="border-t border-slate-100 pt-6 mt-6">
                <h4 class="text-sm font-bold text-slate-700 mb-4"><i class="fa-solid fa-address-card mr-2"></i> Coordinator Details</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                        <span class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Full Name</span>
                        <span class="font-bold text-slate-800">{{ $survey3->cd_name ?: 'N/A' }}</span>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                        <span class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Designation</span>
                        <span class="font-bold text-slate-800">{{ $survey3->cd_designation ?: 'N/A' }}</span>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                        <span class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Phone Number</span>
                        <span class="font-bold text-slate-800">{{ $survey3->cd_mobile ?: 'N/A' }}</span>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                        <span class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Email Address</span>
                        <span class="font-bold text-slate-800">{{ $survey3->cd_email ?: 'N/A' }}</span>
                    </div>
                </div>
            </div>
        @else
            <p class="text-sm text-slate-400 py-6 text-center">No survey response submitted for Tax Enforcement.</p>
        @endif
    </div>

</div>
@endsection

@section('scripts')
<script>
    function switchTab(tabId) {
        // Get all buttons and panels
        const panels = ['admin', 'procedures', 'processing', 'enforcement'];
        
        panels.forEach(p => {
            const panel = document.getElementById('panel-' + p);
            const btn = document.getElementById('btn-' + p);
            
            if (p === tabId) {
                panel.classList.remove('hidden');
                btn.className = "px-5 py-3 border-b-2 font-bold text-sm transition-all focus:outline-none border-emerald-600 text-emerald-700 active-tab-btn";
            } else {
                panel.classList.add('hidden');
                btn.className = "px-5 py-3 border-b-2 font-bold text-sm text-slate-500 hover:text-slate-700 transition-all focus:outline-none border-transparent";
            }
        });
    }
</script>
@endsection
