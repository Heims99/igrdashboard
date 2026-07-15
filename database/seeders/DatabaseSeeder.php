<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Usertype
        $usertypes = [
            ['usertypeId' => 1, 'Name' => 'Super Admin'],
            ['usertypeId' => 4, 'Name' => 'NGF Admin'],
            ['usertypeId' => 5, 'Name' => 'State User'],
        ];
        DB::table('usertype')->insert($usertypes);

        // 2. Zone
        $zones = [
            ['zoneId' => 1, 'zoneName' => 'North Central'],
            ['zoneId' => 2, 'zoneName' => 'North East'],
            ['zoneId' => 3, 'zoneName' => 'North West'],
            ['zoneId' => 4, 'zoneName' => 'South East'],
            ['zoneId' => 5, 'zoneName' => 'South South'],
            ['zoneId' => 6, 'zoneName' => 'South West'],
        ];
        DB::table('zone')->insert($zones);

        // 3. State
        $states = [
            // North Central (1)
            ['stateName' => 'Benue', 'zoneId' => 1],
            ['stateName' => 'Kogi', 'zoneId' => 1],
            ['stateName' => 'Kwara', 'zoneId' => 1],
            ['stateName' => 'Nasarawa', 'zoneId' => 1],
            ['stateName' => 'Niger', 'zoneId' => 1],
            ['stateName' => 'Plateau', 'zoneId' => 1],
            ['stateName' => 'FCT', 'zoneId' => 1],

            // North East (2)
            ['stateName' => 'Adamawa', 'zoneId' => 2],
            ['stateName' => 'Bauchi', 'zoneId' => 2],
            ['stateName' => 'Borno', 'zoneId' => 2],
            ['stateName' => 'Gombe', 'zoneId' => 2],
            ['stateName' => 'Taraba', 'zoneId' => 2],
            ['stateName' => 'Yobe', 'zoneId' => 2],

            // North West (3)
            ['stateName' => 'Jigawa', 'zoneId' => 3],
            ['stateName' => 'Kaduna', 'zoneId' => 3],
            ['stateName' => 'Kano', 'zoneId' => 3],
            ['stateName' => 'Katsina', 'zoneId' => 3],
            ['stateName' => 'Kebbi', 'zoneId' => 3],
            ['stateName' => 'Sokoto', 'zoneId' => 3],
            ['stateName' => 'Zamfara', 'zoneId' => 3],

            // South East (4)
            ['stateName' => 'Abia', 'zoneId' => 4],
            ['stateName' => 'Anambra', 'zoneId' => 4],
            ['stateName' => 'Ebonyi', 'zoneId' => 4],
            ['stateName' => 'Enugu', 'zoneId' => 4],
            ['stateName' => 'Imo', 'zoneId' => 4],

            // South South (5)
            ['stateName' => 'Akwa Ibom', 'zoneId' => 5],
            ['stateName' => 'Bayelsa', 'zoneId' => 5],
            ['stateName' => 'Cross River', 'zoneId' => 5],
            ['stateName' => 'Delta', 'zoneId' => 5],
            ['stateName' => 'Edo', 'zoneId' => 5],
            ['stateName' => 'Rivers', 'zoneId' => 5],

            // South West (6)
            ['stateName' => 'Ekiti', 'zoneId' => 6],
            ['stateName' => 'Lagos', 'zoneId' => 6],
            ['stateName' => 'Ogun', 'zoneId' => 6],
            ['stateName' => 'Ondo', 'zoneId' => 6],
            ['stateName' => 'Osun', 'zoneId' => 6],
            ['stateName' => 'Oyo', 'zoneId' => 6],
        ];

        foreach ($states as $state) {
            DB::table('state')->insert([
                'stateName' => $state['stateName'],
                'zoneId' => $state['zoneId'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 4. ngfYear
        $years = ['2016', '2017', '2018', '2019', '2020', '2021'];
        foreach ($years as $year) {
            DB::table('ngfYear')->insert([
                'year' => $year,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 5. quarter
        $quarters = ['Quarter 1', 'Quarter 2', 'Quarter 3', 'Quarter 4'];
        foreach ($quarters as $q) {
            DB::table('quarter')->insert([
                'quarter' => $q,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 6. Users
        // NGF Admin
        DB::table('users')->insert([
            'username' => 'NGF Admin User',
            'state' => 'NGF',
            'password' => Hash::make('password'),
            'usertypeId' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // State Users
        foreach ($states as $state) {
            DB::table('users')->insert([
                'username' => $state['stateName'] . ' State Officer',
                'state' => $state['stateName'],
                'password' => Hash::make('password'),
                'usertypeId' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 7. Mock Data: FAAC Monthly
        // For years 2017 and 2018
        $months = ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'];
        foreach (['2017', '2018'] as $yearStr) {
            foreach ($states as $state) {
                $faacData = [
                    'state' => $state['stateName'],
                    'faacYear' => $yearStr,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                foreach ($months as $month) {
                    // Seed between 1.5 billion and 8.5 billion Naira
                    $faacData[$month] = rand(1500000000, 8500000000) / 100;
                }
                DB::table('faacMonthly')->insert($faacData);
            }
        }

        // 8. Mock Data: Annex (Monthly Revenue Metrics)
        $monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        foreach (['2017', '2018'] as $yearStr) {
            foreach ($states as $state) {
                foreach ($monthNames as $monthName) {
                    DB::table('annex')->insert([
                        'mysession' => $state['stateName'] . ' State Officer',
                        'state' => $state['stateName'],
                        'month' => $monthName,
                        'year' => $yearStr,
                        'paye' => rand(200000000, 1500000000) / 100,
                        'tax_audit' => rand(10000000, 150000000) / 100,
                        'wht' => rand(30000000, 400000000) / 100,
                        'direct_assess' => rand(5000000, 50000000) / 100,
                        'direct_informal' => rand(1000000, 20000000) / 100,
                        'capital_gain' => rand(2000000, 30000000) / 100,
                        'levies' => rand(5000000, 40000000) / 100,
                        'mda_revenue' => rand(50000000, 600000000) / 100,
                        'taxpayer_reg' => rand(500, 5000),
                        'monthly_tin' => rand(100, 1500),
                        'num_levies' => rand(2, 10),
                        'num_education' => rand(5, 50),
                        'num_appeal' => rand(0, 5),
                        'num_cases' => rand(1, 20),
                        'num_hinwi' => rand(10, 200),
                        'num_license' => rand(5, 100),
                        'completed' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        // 9. Mock Data: Surveys
        // Create survey responses for each state, year (2017, 2018), and quarter
        foreach (['2017', '2018'] as $yearStr) {
            foreach ($quarters as $qStr) {
                foreach ($states as $state) {
                    $sessionUser = $state['stateName'] . ' State Officer';
                    
                    // Survey 1 (Tax Administration)
                    DB::table('survey')->insert([
                        'mysession' => $sessionUser,
                        'quarter' => $qStr,
                        'year' => $yearStr,
                        'completed' => '1',
                        'sbirs_mship_top' => rand(0, 1) ? 'Yes' : 'No',
                        'sbirs_mship_toplus' => rand(0, 1) ? 'Yes' : 'No',
                        'ext_rep' => rand(0, 1) ? 'Yes' : 'No',
                        'ext_govt' => 'Yes',
                        'ext_other' => 'No',
                        'sbirs_meet' => 'Monthly',
                        'sbirs_policy' => 'Yes',
                        'nature_por' => 'Yes',
                        'sbirs_gov' => 'Autonomous',
                        'sbirs_scf' => 'Yes',
                        'sbirs_sha' => 'Yes',
                        'sbirs_chair' => 'Executive Chairman',
                        'sbirs_is' => 'Yes',
                        'sbirs_fund' => 'Retained Earnings',
                        'sbirs_cost' => '5%',
                        'cap_cost_cov' => 'Yes',
                        'sbirs_emp' => (string)rand(100, 800),
                        'core_tax' => rand(50, 400),
                        'support_role' => rand(30, 200),
                        'tax_staff' => 'Yes',
                        'capacity_building' => 'Yes',
                        'attended_training' => 'Yes',
                        'trainin_program' => 'Annual',
                        'min_training' => rand(5, 20),
                        'sal_structure' => 'Harmonized',
                        'perform_app' => 'Yes',
                        'how_often' => 'Annually',
                        'pay_scheme' => 'Bonus Based',
                        'contract_staff' => 'No',
                        'num_contract' => 0,
                        'num_political' => rand(1, 5),
                        'ad_hoc' => 'No',
                        'num_adhoc' => 0,
                        'task' => 'None',
                        'num_offices' => rand(5, 30),
                        'zone_num' => (string)rand(2, 6),
                        'full_ict' => rand(2, 10),
                        'partial_ict' => rand(1, 8),
                        'no_ict' => rand(0, 5),
                        'tech_staff' => rand(10, 50),
                        'internet' => rand(0, 1) ? 1 : 0,
                        'field_report' => 'Yes',
                        'report_method' => 'Email',
                        'alter_target' => 'Yes',
                        'standardrpt_format' => 'Yes',
                        'function_website' => 'Yes',
                        'tax_guide' => 'Yes',
                        'tax_ret_form' => 'Yes',
                        'tax_calc' => 'Yes',
                        'tax_reg_pack' => 'Yes',
                        'field_off_add' => 'Yes',
                        'contact_help' => 'Yes',
                        'comment' => 'Standard questionnaire setup.',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    // Survey 2 (Tax Procedures)
                    DB::table('survey1')->insert([
                        'mysession' => $sessionUser,
                        'quarter' => $qStr,
                        'year' => $yearStr,
                        'completed' => '1',
                        'tin_captured' => rand(0, 1) ? 'Yes' : 'No',
                        'reg_pack' => 'Yes',
                        'new_tax' => 'Yes',
                        'num_page' => '4',
                        'standard_form' => 'Yes',
                        'paper_size' => 'A4',
                        'avail_public' => 'Yes',
                        'pack_content' => 'Forms and guidelines',
                        'avail_req' => 'Yes',
                        'guidance' => 'Yes',
                        'avail_online' => 'Yes',
                        'sbirs_assessment' => 'Yes',
                        'self_assessment' => 'Yes',
                        'self_assesscover' => 'Yes',
                        'desk_guide' => 'Yes',
                        'object_right' => 'Yes',
                        'doc_appeal' => 'Yes',
                        'referred' => 'JTB',
                        'num_reg_taxpayer' => rand(5000, 150000),
                        'tin_often_updated' => 'Monthly',
                        'make_assess' => 'Yes',
                        'taxpayer_engage' => 'Yes',
                        'target_setting' => 'Yes',
                        'pit_rates' => 'Yes',
                        'validity' => 'Yes',
                        'have_tin' => 'Yes',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    // Survey 3 (Tax Processing)
                    DB::table('survey2')->insert([
                        'mysession' => $sessionUser,
                        'quarter' => $qStr,
                        'year' => $yearStr,
                        'completed' => '1',
                        'central_platform' => 'Yes',
                        'platform_work' => 'Web based portal',
                        'auto_platform' => 'Yes',
                        'online_acc' => 'Yes',
                        'realtime_acc' => 'Yes',
                        'use_consultant' => 'No',
                        'tax_agent' => 'Yes',
                        'exclu_agent' => 'No',
                        'levy_collect' => 'Yes',
                        'other_tax' => 'No',
                        'govt_dept' => 'Yes',
                        'govtdept_levy' => 'Yes',
                        'sbircollect_lg' => 'Yes',
                        'sbircollectlg_levy' => 'Yes',
                        'collate_mda_levies' => 'Yes',
                        'collate_lga_levies' => 'Yes',
                        'collect_by_agent' => 'No',
                        'sbircollect_mda' => 'Yes',
                        'sbircollectmda_levy' => 'Yes',
                        'all_cases' => 'Yes',
                        'state_mechanism' => 'Yes',
                        'payment_audit' => 'Yes',
                        'a2013_audit' => 'Yes',
                        'a2014_audit' => 'Yes',
                        'a2015_audit' => 'Yes',
                        'conext_audit' => 'Yes',
                        'a2013_extaudit' => 'Yes',
                        'a2014_extaudit' => 'Yes',
                        'a2015_extaudit' => 'Yes',
                        'rev_dept' => 'Yes',
                        'revdept_diff' => 'Yes',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    // Survey 4 (Tax Enforcement)
                    DB::table('survey3')->insert([
                        'mysession' => $sessionUser,
                        'quarter' => $qStr,
                        'year' => $yearStr,
                        'completed' => '1',
                        'last_conducted' => '2017',
                        'working_cases' => (string)rand(5, 50),
                        'concluded_cases' => (string)rand(2, 30),
                        'taxpayer_audit' => 'Yes',
                        'hnwi_unit' => 'Yes',
                        'hnwi_id' => 'Yes',
                        'hnwi_action' => 'Yes',
                        'sirs_lead' => 'Yes',
                        'agency_coop' => 'Yes',
                        'tin_tcc' => 'Yes',
                        'debt_enforce' => 'Yes',
                        'agent_involve' => 'No',
                        'court_enforce' => 'Yes',
                        'action_num' => (string)rand(1, 10),
                        'taxpayer_aware' => 'Yes',
                        'tax_edu' => 'Yes',
                        'other_taxedu' => 'Radio, TV, Pamphlets',
                        'igr_effect' => 'High',
                        'tin_effect' => 'Medium',
                        'tat_effect' => 'High',
                        'complaint_effect' => 'High',
                        'servicom' => 'Yes',
                        'yes_servicom' => 'Customer help desk',
                        'complaint_num' => (string)rand(10, 100),
                        'no_servicom' => 'N/A',
                        'process_num' => (string)rand(50, 500),
                        'process_timetcc' => '2 Weeks',
                        'taxpayer_favor' => 'Yes',
                        'sbirs_favor' => 'Yes',
                        'sjtb_functioning' => 'Yes',
                        'num_timemet' => '4',
                        'utility_charges' => 'Yes',
                        'other_charges' => 'None',
                        'edu_charges' => 'Yes',
                        'health_charges' => 'No',
                        'comment' => 'Completed survey 4.',
                        'trained_auditor' => 'Yes',
                        'vaids_unit' => 'Yes',
                        'vaid_staff' => (string)rand(5, 20),
                        'case_handled' => (string)rand(10, 100),
                        'cd_name' => 'John Doe',
                        'cd_designation' => 'Director of IT',
                        'cd_mobile' => '08012345678',
                        'cd_email' => 'john.doe@sirs.gov.ng',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
