<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\State;
use App\Models\Zone;
use App\Models\Quarter;
use App\Models\NgfYear;

class DashboardController extends Controller
{
    /**
     * Helper to compute questionnaire scores out of 100 for a state's survey answers.
     */
    private function calculateScores($stateName, $year, $quarter)
    {
        $sessionUser = $stateName . ' State Officer';

        // 1. Tax Administration (survey table)
        $survey = DB::table('survey')
            ->where('year', $year)
            ->where('quarter', $quarter)
            ->where(function($q) use ($stateName, $sessionUser) {
                $q->where('mysession', $sessionUser)->orWhere('mysession', $stateName);
            })
            ->first();

        // 2. Tax Procedures (survey1 table)
        $survey1 = DB::table('survey1')
            ->where('year', $year)
            ->where('quarter', $quarter)
            ->where(function($q) use ($stateName, $sessionUser) {
                $q->where('mysession', $sessionUser)->orWhere('mysession', $stateName);
            })
            ->first();

        // 3. Tax Processing (survey2 table)
        $survey2 = DB::table('survey2')
            ->where('year', $year)
            ->where('quarter', $quarter)
            ->where(function($q) use ($stateName, $sessionUser) {
                $q->where('mysession', $sessionUser)->orWhere('mysession', $stateName);
            })
            ->first();

        // 4. Tax Enforcement (survey3 table)
        $survey3 = DB::table('survey3')
            ->where('year', $year)
            ->where('quarter', $quarter)
            ->where(function($q) use ($stateName, $sessionUser) {
                $q->where('mysession', $sessionUser)->orWhere('mysession', $stateName);
            })
            ->first();

        // Scores calculation (percentage of positive/yes responses)
        $adminScore = 0;
        if ($survey) {
            $yesFields = [
                'sbirs_mship_top', 'sbirs_mship_toplus', 'ext_rep', 'ext_govt', 
                'sbirs_policy', 'nature_por', 'sbirs_scf', 'sbirs_sha', 
                'sbirs_is', 'cap_cost_cov', 'tax_staff', 'capacity_building', 
                'attended_training', 'perform_app', 'field_report', 'standardrpt_format', 
                'function_website', 'tax_guide', 'tax_ret_form', 'tax_calc', 
                'tax_reg_pack', 'field_off_add', 'contact_help'
            ];
            $yesCount = 0;
            foreach ($yesFields as $field) {
                if (isset($survey->$field) && in_array(strtolower($survey->$field), ['yes', 'autonomous'])) {
                    $yesCount++;
                }
            }
            $adminScore = count($yesFields) > 0 ? ($yesCount / count($yesFields)) * 100 : 0;
        }

        $procScore = 0;
        if ($survey1) {
            $yesFields = [
                'tin_captured', 'reg_pack', 'new_tax', 'standard_form', 'avail_public', 
                'guidance', 'avail_online', 'sbirs_assessment', 'self_assessment', 
                'self_assesscover', 'desk_guide', 'object_right', 'doc_appeal', 
                'make_assess', 'taxpayer_engage', 'target_setting', 'pit_rates', 
                'validity', 'have_tin'
            ];
            $yesCount = 0;
            foreach ($yesFields as $field) {
                if (isset($survey1->$field) && strtolower($survey1->$field) === 'yes') {
                    $yesCount++;
                }
            }
            $procScore = count($yesFields) > 0 ? ($yesCount / count($yesFields)) * 100 : 0;
        }

        $processScore = 0;
        if ($survey2) {
            $yesFields = [
                'central_platform', 'auto_platform', 'online_acc', 'realtime_acc', 
                'tax_agent', 'levy_collect', 'govt_dept', 'govtdept_levy', 
                'sbircollect_lg', 'sbircollectlg_levy', 'collate_mda_levies', 'collate_lga_levies', 
                'sbircollect_mda', 'all_cases', 'state_mechanism', 'payment_audit', 
                'a2013_audit', 'a2014_audit', 'a2015_audit', 'conext_audit'
            ];
            $yesCount = 0;
            foreach ($yesFields as $field) {
                if (isset($survey2->$field) && strtolower($survey2->$field) === 'yes') {
                    $yesCount++;
                }
            }
            // For use_consultant, 'No' is positive
            if (isset($survey2->use_consultant) && strtolower($survey2->use_consultant) === 'no') {
                $yesCount++;
            }
            $processScore = (count($yesFields) + 1) > 0 ? ($yesCount / (count($yesFields) + 1)) * 100 : 0;
        }

        $enforceScore = 0;
        if ($survey3) {
            $yesFields = [
                'taxpayer_audit', 'hnwi_unit', 'hnwi_id', 'hnwi_action', 'sirs_lead', 
                'agency_coop', 'tin_tcc', 'debt_enforce', 'court_enforce', 'taxpayer_aware', 
                'tax_edu', 'servicom', 'sjtb_functioning', 'trained_auditor', 'vaids_unit'
            ];
            $yesCount = 0;
            foreach ($yesFields as $field) {
                if (isset($survey3->$field) && strtolower($survey3->$field) === 'yes') {
                    $yesCount++;
                }
            }
            $enforceScore = count($yesFields) > 0 ? ($yesCount / count($yesFields)) * 100 : 0;
        }

        $overallScore = ($adminScore + $procScore + $processScore + $enforceScore) / 4;

        return [
            'admin' => round($adminScore, 2),
            'procedure' => round($procScore, 2),
            'processing' => round($processScore, 2),
            'enforcement' => round($enforceScore, 2),
            'overall' => round($overallScore, 2),
        ];
    }

    /**
     * Group Explorer view
     */
    public function groupExplorer(Request $request)
    {
        $zones = Zone::all();
        $quarters = Quarter::all();
        $years = NgfYear::orderBy('year', 'desc')->get();

        $selectedZoneId = $request->input('zone', $zones->first()->zoneId ?? 1);
        $selectedQuarter = $request->input('quarter', 'Quarter 1');
        $selectedYear = $request->input('year', '2017');

        $statesInZone = State::where('zoneId', $selectedZoneId)->get();

        $rankings = [];
        foreach ($statesInZone as $state) {
            $scores = $this->calculateScores($state->stateName, $selectedYear, $selectedQuarter);
            
            // Also calculate scores for previous year/same quarter to show diff/growth
            $prevYear = (int)$selectedYear - 1;
            $prevScores = $this->calculateScores($state->stateName, (string)$prevYear, $selectedQuarter);

            $rankings[] = [
                'stateId' => $state->stateId,
                'stateName' => $state->stateName,
                'admin' => $scores['admin'],
                'procedure' => $scores['procedure'],
                'processing' => $scores['processing'],
                'enforcement' => $scores['enforcement'],
                'overall' => $scores['overall'],
                'diff' => round($scores['overall'] - $prevScores['overall'], 2)
            ];
        }

        // Sort descending by overall score
        usort($rankings, function ($a, $b) {
            return $b['overall'] <=> $a['overall'];
        });

        // Add rank positions
        foreach ($rankings as $index => &$rank) {
            $rank['position'] = $index + 1;
        }

        $selectedZone = Zone::find($selectedZoneId);

        return view('group_explorer', compact(
            'zones', 'quarters', 'years', 
            'selectedZoneId', 'selectedQuarter', 'selectedYear', 
            'rankings', 'selectedZone'
        ));
    }

    /**
     * State Explorer view
     */
    public function stateExplorer(Request $request)
    {
        $states = State::orderBy('stateName')->get();
        $quarters = Quarter::all();
        $years = NgfYear::orderBy('year', 'desc')->get();

        $selectedState = $request->input('state', $states->first()->stateName ?? 'Abia');
        $selectedQuarter = $request->input('quarter', 'Quarter 1');
        $selectedYear = $request->input('year', '2017');

        $sessionUser = $selectedState . ' State Officer';

        $survey = DB::table('survey')
            ->where('year', $selectedYear)
            ->where('quarter', $selectedQuarter)
            ->where(function($q) use ($selectedState, $sessionUser) {
                $q->where('mysession', $sessionUser)->orWhere('mysession', $selectedState);
            })->first();

        $survey1 = DB::table('survey1')
            ->where('year', $selectedYear)
            ->where('quarter', $selectedQuarter)
            ->where(function($q) use ($selectedState, $sessionUser) {
                $q->where('mysession', $sessionUser)->orWhere('mysession', $selectedState);
            })->first();

        $survey2 = DB::table('survey2')
            ->where('year', $selectedYear)
            ->where('quarter', $selectedQuarter)
            ->where(function($q) use ($selectedState, $sessionUser) {
                $q->where('mysession', $sessionUser)->orWhere('mysession', $selectedState);
            })->first();

        $survey3 = DB::table('survey3')
            ->where('year', $selectedYear)
            ->where('quarter', $selectedQuarter)
            ->where(function($q) use ($selectedState, $sessionUser) {
                $q->where('mysession', $sessionUser)->orWhere('mysession', $selectedState);
            })->first();

        $scores = $this->calculateScores($selectedState, $selectedYear, $selectedQuarter);

        return view('state_explorer', compact(
            'states', 'quarters', 'years',
            'selectedState', 'selectedQuarter', 'selectedYear',
            'survey', 'survey1', 'survey2', 'survey3', 'scores'
        ));
    }

    /**
     * States' IGR view
     */
    public function stateIgr(Request $request)
    {
        $states = State::orderBy('stateName')->get();
        $years = NgfYear::orderBy('year', 'desc')->get();

        $selectedState = $request->input('state', $states->first()->stateName ?? 'Abia');
        $selectedYear = $request->input('year', '2017');

        // Fetch monthly data for the selected state and year from the annex table
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        
        $igrData = [];
        foreach ($months as $month) {
            $record = DB::table('annex')
                ->where('state', $selectedState)
                ->where('year', $selectedYear)
                ->where('month', $month)
                ->first();

            $igrData[$month] = $record ?: (object)[
                'paye' => 0.00, 'tax_audit' => 0.00, 'wht' => 0.00, 
                'direct_assess' => 0.00, 'direct_informal' => 0.00, 
                'capital_gain' => 0.00, 'levies' => 0.00, 'mda_revenue' => 0.00,
                'taxpayer_reg' => 0, 'monthly_tin' => 0, 'completed' => 0
            ];
        }

        // Totals
        $totals = [
            'paye' => array_sum(array_column($igrData, 'paye')),
            'tax_audit' => array_sum(array_column($igrData, 'tax_audit')),
            'wht' => array_sum(array_column($igrData, 'wht')),
            'direct_assess' => array_sum(array_column($igrData, 'direct_assess')),
            'direct_informal' => array_sum(array_column($igrData, 'direct_informal')),
            'capital_gain' => array_sum(array_column($igrData, 'capital_gain')),
            'levies' => array_sum(array_column($igrData, 'levies')),
            'mda_revenue' => array_sum(array_column($igrData, 'mda_revenue')),
            'taxpayer_reg' => array_sum(array_column($igrData, 'taxpayer_reg')),
            'monthly_tin' => array_sum(array_column($igrData, 'monthly_tin')),
        ];

        $totals['overall_igr'] = $totals['paye'] + $totals['tax_audit'] + $totals['wht'] + $totals['direct_assess'] + 
                                 $totals['direct_informal'] + $totals['capital_gain'] + $totals['levies'] + $totals['mda_revenue'];

        return view('state_igr', compact(
            'states', 'years', 'selectedState', 'selectedYear', 'igrData', 'totals'
        ));
    }

    /**
     * FAAC view
     */
    public function faac(Request $request)
    {
        $zones = Zone::all();
        $states = State::orderBy('stateName')->get();
        $years = NgfYear::orderBy('year', 'desc')->get();

        $selectedYear = $request->input('year', '2017');
        $selectedZoneId = $request->input('zone', $zones->first()->zoneId ?? 1);

        $selectedZoneName = Zone::find($selectedZoneId)->zoneName ?? 'North Central';
        $statesInZone = State::where('zoneId', $selectedZoneId)->pluck('stateName')->toArray();

        // Get FAAC records for the selected year and states
        $faacRecords = DB::table('faacMonthly')
            ->where('faacYear', $selectedYear)
            ->whereIn('state', $statesInZone)
            ->get();

        $faacData = [];
        $months = ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'];
        
        foreach ($statesInZone as $stateName) {
            $record = $faacRecords->where('state', $stateName)->first();
            $stateRow = [];
            $sum = 0;
            foreach ($months as $month) {
                $val = $record ? (double)$record->$month : 0.00;
                $stateRow[$month] = $val;
                $sum += $val;
            }
            $stateRow['state'] = $stateName;
            $stateRow['totalSum'] = $sum;
            $faacData[] = (object)$stateRow;
        }

        return view('faac', compact(
            'zones', 'states', 'years', 'selectedYear', 
            'selectedZoneId', 'selectedZoneName', 'faacData', 'months'
        ));
    }

    /**
     * TRR view (Total Recurrent Revenue = IGR + FAAC)
     */
    public function trr(Request $request)
    {
        $zones = Zone::all();
        $years = NgfYear::orderBy('year', 'desc')->get();

        $selectedYear = $request->input('year', '2017');
        $selectedZoneId = $request->input('zone', $zones->first()->zoneId ?? 1);

        $selectedZoneName = Zone::find($selectedZoneId)->zoneName ?? 'North Central';
        $statesInZone = State::where('zoneId', $selectedZoneId)->pluck('stateName')->toArray();

        $trrData = [];
        
        foreach ($statesInZone as $stateName) {
            // Calculate Total IGR
            $igrSum = DB::table('annex')
                ->where('state', $stateName)
                ->where('year', $selectedYear)
                ->select(DB::raw('SUM(paye + tax_audit + wht + direct_assess + direct_informal + capital_gain + levies + mda_revenue) as total'))
                ->first()
                ->total ?? 0.00;

            // Calculate Total FAAC
            $faacRecord = DB::table('faacMonthly')
                ->where('state', $stateName)
                ->where('faacYear', $selectedYear)
                ->first();

            $faacSum = 0;
            if ($faacRecord) {
                $months = ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'];
                foreach ($months as $month) {
                    $faacSum += (double)$faacRecord->$month;
                }
            }

            $totalRecRev = $igrSum + $faacSum;

            $trrData[] = (object)[
                'state' => $stateName,
                'igr' => $igrSum,
                'faac' => $faacSum,
                'trr' => $totalRecRev,
                'sustainability' => $totalRecRev > 0 ? round(($igrSum / $totalRecRev) * 100, 2) : 0
            ];
        }

        // Sort descending by TRR
        usort($trrData, function ($a, $b) {
            return $b->trr <=> $a->trr;
        });

        return view('trr', compact(
            'zones', 'years', 'selectedYear', 'selectedZoneId', 'selectedZoneName', 'trrData'
        ));
    }

    /**
     * TRR Analytics view (Visual Charts Comparison)
     */
    public function trrAnalysis(Request $request)
    {
        $states = State::orderBy('stateName')->get();
        $years = NgfYear::orderBy('year', 'desc')->get();

        $selectedState = $request->input('state', $states->first()->stateName ?? 'Abia');
        $selectedYear = $request->input('year', '2017');

        // Fetch Month-by-Month IGR + FAAC for the selected state and year
        $monthsList = [
            'january' => 'January', 'february' => 'February', 'march' => 'March', 
            'april' => 'April', 'may' => 'May', 'june' => 'June', 
            'july' => 'July', 'august' => 'August', 'september' => 'September', 
            'october' => 'October', 'november' => 'November', 'december' => 'December'
        ];

        $analysisData = [];
        
        $faacRecord = DB::table('faacMonthly')
            ->where('state', $selectedState)
            ->where('faacYear', $selectedYear)
            ->first();

        foreach ($monthsList as $faacCol => $monthName) {
            $igrRecord = DB::table('annex')
                ->where('state', $selectedState)
                ->where('year', $selectedYear)
                ->where('month', $monthName)
                ->select(DB::raw('(paye + tax_audit + wht + direct_assess + direct_informal + capital_gain + levies + mda_revenue) as total'))
                ->first();

            $igrVal = $igrRecord ? (double)$igrRecord->total : 0.00;
            $faacVal = $faacRecord ? (double)$faacRecord->$faacCol : 0.00;

            $analysisData[] = (object)[
                'month' => $monthName,
                'igr' => $igrVal,
                'faac' => $faacVal,
                'total' => $igrVal + $faacVal
            ];
        }

        return view('trr_analysis', compact(
            'states', 'years', 'selectedState', 'selectedYear', 'analysisData'
        ));
    }
}
