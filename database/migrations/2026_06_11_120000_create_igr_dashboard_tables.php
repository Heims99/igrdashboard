<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Usertype table
        Schema::create('usertype', function (Blueprint $table) {
            $table->id('usertypeId');
            $table->string('Name');
            $table->timestamps();
        });

        // 2. Zone table
        Schema::create('zone', function (Blueprint $table) {
            $table->id('zoneId');
            $table->string('zoneName');
            $table->timestamps();
        });

        // 3. State table
        Schema::create('state', function (Blueprint $table) {
            $table->id('stateId');
            $table->string('stateName');
            $table->integer('zoneId')->nullable();
            $table->timestamps();
        });

        // 4. NgfYear table
        Schema::create('ngfYear', function (Blueprint $table) {
            $table->id('yearId');
            $table->string('year');
            $table->timestamps();
        });

        // 5. Quarter table
        Schema::create('quarter', function (Blueprint $table) {
            $table->id('quarterId');
            $table->string('quarter');
            $table->timestamps();
        });

        // Helper to add common survey columns
        $addCommonSurveyFields = function (Blueprint $table) {
            $table->string('mysession')->nullable();
            $table->string('quarter')->nullable();
            $table->string('year')->nullable();
            $table->string('completed')->nullable();
        };

        // 6. Survey table (Part 1 - Tax Administration / General Survey)
        Schema::create('survey', function (Blueprint $table) use ($addCommonSurveyFields) {
            $table->id('survey_id');
            $addCommonSurveyFields($table);

            // Organisational & Budget
            $table->string('sbirs_mship_top')->nullable();
            $table->string('sbirs_mship_toplus')->nullable();
            $table->string('ext_rep')->nullable();
            $table->string('ext_govt')->nullable();
            $table->string('ext_other')->nullable();
            $table->string('sbirs_meet')->nullable();
            $table->string('sbirs_policy')->nullable();
            $table->string('nature_por')->nullable();
            $table->string('nature_por1')->nullable();
            $table->string('nature_por2')->nullable();
            $table->string('nature_por3')->nullable();
            $table->string('nature_por4')->nullable();
            $table->string('sbirs_gov')->nullable();
            $table->string('sbirs_scf')->nullable();
            $table->string('sbirs_sha')->nullable();
            $table->string('sbirs_chair')->nullable();
            $table->string('sbirs_is')->nullable();
            $table->string('sbirs_fund')->nullable();
            $table->string('sbirs_cost')->nullable();
            $table->string('cap_cost_cov')->nullable();

            // Staff & Training
            $table->string('sbirs_emp')->nullable();
            $table->integer('core_tax')->nullable();
            $table->integer('support_role')->nullable();
            $table->string('tax_staff')->nullable();
            $table->string('capacity_building')->nullable();
            $table->string('attended_training')->nullable();
            $table->string('trainin_program')->nullable();
            $table->integer('min_training')->nullable();
            $table->string('sal_structure')->nullable();
            $table->string('perform_app')->nullable();
            $table->string('how_often')->nullable();
            $table->string('pay_scheme')->nullable();
            $table->string('contract_staff')->nullable();
            $table->integer('num_contract')->nullable();
            $table->integer('num_political')->nullable();
            $table->string('ad_hoc')->nullable();
            $table->integer('num_adhoc')->nullable();
            $table->string('task')->nullable();

            // Field Offices & Outreach
            $table->integer('num_offices')->nullable();
            $table->string('zone_num')->nullable();
            $table->integer('full_ict')->nullable();
            $table->integer('partial_ict')->nullable();
            $table->integer('no_ict')->nullable();
            $table->integer('tech_staff')->nullable();
            $table->integer('internet')->nullable();
            $table->string('field_report')->nullable();
            $table->string('field_report1')->nullable();
            $table->string('field_report2')->nullable();
            $table->string('field_report3')->nullable();
            $table->string('field_report4')->nullable();
            $table->string('report_method')->nullable();
            $table->string('alter_target')->nullable();
            $table->string('standardrpt_format')->nullable();
            $table->string('function_website')->nullable();
            $table->string('tax_guide')->nullable();
            $table->string('tax_ret_form')->nullable();
            $table->string('tax_calc')->nullable();
            $table->string('tax_reg_pack')->nullable();
            $table->string('field_off_add')->nullable();
            $table->string('contact_help')->nullable();

            // Legacy schema also has placeholder columns in page 1 insert
            $table->text('comment')->nullable();
            $table->timestamps();
        });

        // 7. Survey1 table (Part 2 - Tax Procedures)
        Schema::create('survey1', function (Blueprint $table) use ($addCommonSurveyFields) {
            $table->id('survey_id');
            $addCommonSurveyFields($table);

            $table->string('tin_captured')->nullable();
            $table->string('reg_pack')->nullable();
            $table->string('new_tax')->nullable();
            $table->string('num_page')->nullable();
            $table->string('standard_form')->nullable();
            $table->string('paper_size')->nullable();
            $table->string('avail_public')->nullable();
            $table->string('pack_content')->nullable();
            $table->string('avail_req')->nullable();
            $table->string('avail_req1')->nullable();
            $table->string('avail_req2')->nullable();
            $table->string('avail_req3')->nullable();
            $table->string('avail_req4')->nullable();
            $table->string('avail_req5')->nullable();
            $table->string('avail_req6')->nullable();
            $table->string('guidance')->nullable();
            $table->string('avail_online')->nullable();
            $table->string('sbirs_assessment')->nullable();
            $table->string('self_assessment')->nullable();
            $table->string('self_assesscover')->nullable();
            $table->string('self_assesscover1')->nullable();
            $table->string('self_assesscover2')->nullable();
            $table->string('self_assesscover3')->nullable();
            $table->string('desk_guide')->nullable();
            $table->string('object_right')->nullable();
            $table->string('doc_appeal')->nullable();
            $table->string('referred')->nullable();
            $table->integer('num_reg_taxpayer')->nullable();
            $table->string('tin_often_updated')->nullable();
            $table->string('make_assess')->nullable();
            $table->string('taxpayer_engage')->nullable();
            $table->string('target_setting')->nullable();
            $table->string('pit_rates')->nullable();
            $table->string('validity')->nullable();
            $table->string('have_tin')->nullable();
            $table->timestamps();
        });

        // 8. Survey2 table (Part 3 - Tax Processing)
        Schema::create('survey2', function (Blueprint $table) use ($addCommonSurveyFields) {
            $table->id('survey_id');
            $addCommonSurveyFields($table);

            $table->string('central_platform')->nullable();
            $table->string('platform_work')->nullable();
            $table->string('auto_platform')->nullable();
            $table->string('online_acc')->nullable();
            $table->string('realtime_acc')->nullable();
            $table->string('use_consultant')->nullable();
            $table->string('tax_agent')->nullable();
            $table->string('exclu_agent')->nullable();
            $table->string('levy_collect')->nullable();
            $table->string('levy_collect1')->nullable();
            $table->string('levy_collect2')->nullable();
            $table->string('levy_collect3')->nullable();
            $table->string('levy_collect4')->nullable();
            $table->string('levy_collect5')->nullable();
            $table->string('levy_collect6')->nullable();
            $table->string('other_tax')->nullable();
            $table->string('govt_dept')->nullable();
            $table->string('govtdept_levy')->nullable();
            $table->string('sbircollect_lg')->nullable();
            $table->string('sbircollectlg_levy')->nullable();
            $table->string('collate_mda_levies')->nullable();
            $table->string('collate_lga_levies')->nullable();
            $table->string('collect_by_agent')->nullable();
            $table->string('sbircollect_mda')->nullable();
            $table->string('sbircollectmda_levy')->nullable();
            $table->string('all_cases')->nullable();
            $table->string('state_mechanism')->nullable();
            $table->string('payment_audit')->nullable();
            $table->string('a2013_audit')->nullable();
            $table->string('a2014_audit')->nullable();
            $table->string('a2015_audit')->nullable();
            $table->string('conext_audit')->nullable();
            $table->string('a2013_extaudit')->nullable();
            $table->string('a2014_extaudit')->nullable();
            $table->string('a2015_extaudit')->nullable();
            $table->string('rev_dept')->nullable();
            $table->string('revdept_diff')->nullable();
            $table->timestamps();
        });

        // 9. Survey3 table (Part 4 - Tax Enforcement)
        Schema::create('survey3', function (Blueprint $table) use ($addCommonSurveyFields) {
            $table->id('survey_id');
            $addCommonSurveyFields($table);

            $table->string('last_conducted')->nullable();
            $table->string('working_cases')->nullable();
            $table->string('concluded_cases')->nullable();
            $table->string('taxpayer_audit')->nullable();
            $table->string('hnwi_unit')->nullable();
            $table->string('hnwi_id')->nullable();
            $table->string('hnwi_action')->nullable();
            $table->string('sirs_lead')->nullable();
            $table->string('agency_coop')->nullable();
            $table->string('tin_tcc')->nullable();
            $table->string('debt_enforce')->nullable();
            $table->string('agent_involve')->nullable();
            $table->string('court_enforce')->nullable();
            $table->string('action_num')->nullable();
            $table->string('taxpayer_aware')->nullable();
            $table->string('tax_edu')->nullable();
            $table->string('tax_edu1')->nullable();
            $table->string('tax_edu2')->nullable();
            $table->string('tax_edu3')->nullable();
            $table->string('tax_edu4')->nullable();
            $table->string('tax_edu5')->nullable();
            $table->string('other_taxedu')->nullable();
            $table->string('igr_effect')->nullable();
            $table->string('tin_effect')->nullable();
            $table->string('tat_effect')->nullable();
            $table->string('complaint_effect')->nullable();
            $table->string('servicom')->nullable();
            $table->string('yes_servicom')->nullable();
            $table->string('complaint_num')->nullable();
            $table->string('no_servicom')->nullable();
            $table->string('process_num')->nullable();
            $table->string('process_timetcc')->nullable();
            $table->string('taxpayer_favor')->nullable();
            $table->string('sbirs_favor')->nullable();
            $table->string('sjtb_functioning')->nullable();
            $table->string('num_timemet')->nullable();
            $table->string('utility_charges')->nullable();
            $table->string('utility_charges1')->nullable();
            $table->string('utility_charges2')->nullable();
            $table->string('utility_charges3')->nullable();
            $table->string('utility_charges4')->nullable();
            $table->string('utility_charges5')->nullable();
            $table->string('utility_charges6')->nullable();
            $table->string('other_charges')->nullable();
            $table->string('edu_charges')->nullable();
            $table->string('health_charges')->nullable();
            $table->text('comment')->nullable();
            $table->string('trained_auditor')->nullable();
            $table->string('vaids_unit')->nullable();
            $table->string('vaid_staff')->nullable();
            $table->string('case_handled')->nullable();
            $table->string('cd_name')->nullable();
            $table->string('cd_designation')->nullable();
            $table->string('cd_mobile')->nullable();
            $table->string('cd_email')->nullable();
            $table->timestamps();
        });

        // 10. Annex table (Monthly Metrics)
        Schema::create('annex', function (Blueprint $table) {
            $table->id('annexid');
            $table->string('mysession')->nullable();
            $table->string('state')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->decimal('paye', 18, 2)->default(0.00);
            $table->decimal('tax_audit', 18, 2)->default(0.00);
            $table->decimal('wht', 18, 2)->default(0.00);
            $table->decimal('direct_assess', 18, 2)->default(0.00);
            $table->decimal('direct_informal', 18, 2)->default(0.00);
            $table->decimal('capital_gain', 18, 2)->default(0.00);
            $table->decimal('levies', 18, 2)->default(0.00);
            $table->decimal('mda_revenue', 18, 2)->default(0.00);
            $table->integer('taxpayer_reg')->default(0);
            $table->integer('monthly_tin')->default(0);
            $table->integer('num_levies')->default(0);
            $table->integer('num_education')->default(0);
            $table->integer('num_appeal')->default(0);
            $table->integer('num_cases')->default(0);
            $table->integer('num_hinwi')->default(0);
            $table->integer('num_license')->default(0);
            $table->integer('completed')->default(0);
            $table->timestamps();
        });

        // 11. FaacMonthly table (Federation Allocation)
        Schema::create('faacMonthly', function (Blueprint $table) {
            $table->id('faacid');
            $table->string('state')->nullable();
            $table->decimal('january', 18, 2)->default(0.00);
            $table->decimal('february', 18, 2)->default(0.00);
            $table->decimal('march', 18, 2)->default(0.00);
            $table->decimal('april', 18, 2)->default(0.00);
            $table->decimal('may', 18, 2)->default(0.00);
            $table->decimal('june', 18, 2)->default(0.00);
            $table->decimal('july', 18, 2)->default(0.00);
            $table->decimal('august', 18, 2)->default(0.00);
            $table->decimal('september', 18, 2)->default(0.00);
            $table->decimal('october', 18, 2)->default(0.00);
            $table->decimal('november', 18, 2)->default(0.00);
            $table->decimal('december', 18, 2)->default(0.00);
            $table->string('faacYear')->nullable();
            $table->timestamps();
        });

        // 12. User_log table
        Schema::create('user_log', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable();
            $table->timestamp('loginDate')->nullable();
            $table->string('ip')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_log');
        Schema::dropIfExists('faacMonthly');
        Schema::dropIfExists('annex');
        Schema::dropIfExists('survey3');
        Schema::dropIfExists('survey2');
        Schema::dropIfExists('survey1');
        Schema::dropIfExists('survey');
        Schema::dropIfExists('quarter');
        Schema::dropIfExists('ngfYear');
        Schema::dropIfExists('state');
        Schema::dropIfExists('zone');
        Schema::dropIfExists('usertype');
    }
};
