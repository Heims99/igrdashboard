@extends('layouts.app')

@section('title', 'Group Explorer - NGF IGR Dashboard')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight mb-2">Group Explorer</h1>
    <p class="text-sm text-slate-500">Compare and rank state scoring metrics within their geopolitical zones.</p>
</div>

<!-- Filters Panel -->
<div class="glass-panel rounded-2xl p-6 mb-8 shadow-sm">
    <form method="GET" action="/group-explorer" class="grid grid-cols-1 sm:grid-cols-4 gap-4 items-end">
        <div>
            <label for="zone" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Geopolitical Zone</label>
            <select name="zone" id="zone" class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                @foreach($zones as $zone)
                    <option value="{{ $zone->zoneId }}" {{ $selectedZoneId == $zone->zoneId ? 'selected' : '' }}>
                        {{ $zone->zoneName }}
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
            <label for="year" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Assessment Year</label>
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
                <i class="fa-solid fa-filter mr-1.5"></i> Apply Filters
            </button>
        </div>
    </form>
</div>

<!-- Results Header -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
    <div>
        <h3 class="text-xl font-bold text-slate-900">{{ $selectedZone->zoneName }} Zone Rankings</h3>
        <p class="text-xs text-slate-500">Showing comparisons for {{ $selectedQuarter }} | Year {{ $selectedYear }}</p>
    </div>
</div>

<!-- Rankings Table Card -->
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-8">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/75 border-b border-slate-200 text-slate-600">
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-center">Rank</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider">State</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-center">Tax Admin</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-center">Tax Proc</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-center">Tax Procg</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-center">Tax Enforce</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-center bg-emerald-50 text-emerald-800">Overall</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-center">Growth</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-150">
                @forelse($rankings as $rank)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-4 px-6 text-center font-bold text-sm">
                            <span class="inline-flex items-center justify-center h-7 w-7 rounded-full 
                                  {{ $rank['position'] == 1 ? 'bg-amber-100 text-amber-800' : '' }}
                                  {{ $rank['position'] == 2 ? 'bg-slate-200 text-slate-800' : '' }}
                                  {{ $rank['position'] == 3 ? 'bg-orange-100 text-orange-800' : '' }}
                                  {{ $rank['position'] > 3 ? 'bg-slate-100 text-slate-600' : '' }}">
                                {{ $rank['position'] }}
                            </span>
                        </td>
                        <td class="py-4 px-6 font-semibold text-slate-900 text-sm">
                            <a href="/state-explorer?state={{ $rank['stateName'] }}&quarter={{ $selectedQuarter }}&year={{ $selectedYear }}" class="text-emerald-700 hover:text-emerald-600 hover:underline">
                                {{ $rank['stateName'] }}
                            </a>
                        </td>
                        <td class="py-4 px-6 text-center text-sm font-medium text-slate-700">{{ $rank['admin'] }}%</td>
                        <td class="py-4 px-6 text-center text-sm font-medium text-slate-700">{{ $rank['procedure'] }}%</td>
                        <td class="py-4 px-6 text-center text-sm font-medium text-slate-700">{{ $rank['processing'] }}%</td>
                        <td class="py-4 px-6 text-center text-sm font-medium text-slate-700">{{ $rank['enforcement'] }}%</td>
                        <td class="py-4 px-6 text-center text-sm font-bold bg-emerald-50/50 text-emerald-800">{{ $rank['overall'] }}%</td>
                        <td class="py-4 px-6 text-center text-sm font-bold">
                            @if($rank['diff'] > 0)
                                <span class="text-emerald-600"><i class="fa-solid fa-caret-up mr-0.5"></i> +{{ $rank['diff'] }}%</span>
                            @elseif($rank['diff'] < 0)
                                <span class="text-rose-600"><i class="fa-solid fa-caret-down mr-0.5"></i> {{ $rank['diff'] }}%</span>
                            @else
                                <span class="text-slate-400">0.00%</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="py-8 text-center text-slate-400 text-sm font-medium">
                            No records found for this zone, quarter, and year combination.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
