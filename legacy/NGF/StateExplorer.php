<?php
session_start();
include_once '../connection.php';

if(!isset($_SESSION['user']))
{
 header("Location: Login.php");
}
$con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$res=mysqli_query($con, "SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res);
?>
<?php include('_header.php') ?>
<div class="container shadow_bg">
    <h4>State Explorer</h4>
    <form class="form-inline mt-5 d-flex justify-content-between" id="form1" name="form1" method="post" action="#">
        <div class="d-flex">
            <div class="form-group mx-sm-3 mb-2">
                <label for="zone" class="sr-only">State</label>
                <select id="state" name="state" size="1" class="form-control">
                <?php
		  //include 'connection.php';
		  $con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
   $sql = mysqli_query($con, "SELECT DISTINCT(users.state), survey.mysession FROM survey, users WHERE users.username = survey.mysession ORDER BY users.state");
   $result = mysqli_query($sql);
     if(mysqli_num_rows($sql)) {
       // we have at least one practice, so show all practice as options in select form
       while($row = mysqli_fetch_row($sql))
       {
          print("<option value=\"$row[1]\">$row[0]</option>");
       }
     } else {
       print("<option value=\"\">No year created yet</option>");
     }
?></select>

<select name="quarter" size="1" hidden="true"><?php
		  //include 'connection.php';
		  $con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
   $sql = mysqli_query($con, "SELECT quarterId, quarter FROM quarter ORDER BY quarter");
   $result = mysqli_query($sql);
     if(mysqli_num_rows($sql)) {
       // we have at least one practice, so show all practice as options in select form
       while($row = mysqli_fetch_row($sql))
       {
          print("<option value=\"$row[1]\">$row[1]</option>");
       }
     } else {
       print("<option value=\"\">No quarter created yet</option>");
     }
?></select>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="year" class="sr-only">Year</label>
                <select id="year" name="year" size="1" class="form-control">
                    <?php
		  //include 'connection.php';
		  $con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
   $sql = mysqli_query($con, "SELECT DISTINCT(year) FROM ngfYear ORDER BY year");
   $result = mysqli_query($sql);
     if(mysqli_num_rows($sql)) {
       // we have at least one practice, so show all practice as options in select form
       while($row = mysqli_fetch_row($sql))
       {
          print("<option value=\"$row[0]\">$row[0]</option>");
       }
     } else {
       print("<option value=\"\">No year created yet</option>");
     }
?></select>
            </div>
        </div>
        <div class="d-flex">
            <input name="Submit" type="submit" class="btn btn-success mb-2" value="Display" />
            <!--<button type="submit" class="btn btn-success mb-2">Display</button>-->
            <button onclick="window.print()" type="button" class="btn btn-outline-primary mb-2 border-dark text-dark">Print Page</button>
        </div>
    </form>

    <button type="submit" class="btn btn-danger my-3 mx-auto d-block">
        ∆ = Change Since Previous Year
    </button>

    <div class="table-wrapper mt-5">
        <!-- <div class="header-info justify-content-center">
            <span class="table_name text-danger">Task Procedure (Year 2022)</span>
        </div> -->
        <div class="overflow-x">
            <?php
      
      include "../libchart/libchart/classes/libchart.php";

	$chart = new PieChart(650, 350);

	$dataSet = new XYDataSet();
      
//include 'connection.php';
$con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

if(isset($_POST['Submit']))
{ 
$state=$_POST['state']; //echo $state;
$quarter=$_POST['quarter']; //echo $quarter;
$year=$_POST['year']; //echo $year;
mysqli_query($con, "SET SQL_BIG_SELECTS=1");
$sq1 = "SELECT 
				case survey.sbirs_meet
					WHEN 4 THEN 53.33
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 2 THEN 0.00
					WHEN 1 THEN 0.00
				end as sbirsmeet, 
				case survey.sbirs_policy
					WHEN 2 THEN 22.22
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as sbirspolicy, 
				case survey.sbirs_gov
					WHEN 5 THEN 100.00
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 2 THEN 25.00
					WHEN 1 THEN 0.00
				end as sbirsgov, 
				case survey.sbirs_scf
					WHEN 5 THEN 100.00
					WHEN 4 THEN 53.33
					WHEN 3 THEN 20.00
					WHEN 2 THEN 0.00
					WHEN 1 THEN 0.00
				end as sbirsscf, 
				case survey.sbirs_sha
					WHEN 5 THEN 0.00
					WHEN 2 THEN 25.33
					WHEN 3 THEN 37.50
					WHEN 4 THEN 100.00
					WHEN 1 THEN 25.00
					WHEN 0 THEN 0.00
				end as sbirssha, 
				case survey.sbirs_chair
					WHEN 2 THEN 100.00
					WHEN 1 THEN 0.00
				end as sbirschair,
				case survey.sbirs_is
					WHEN 3 THEN 100.00
					WHEN 2 THEN 44.44
					WHEN 1 THEN 0.00
				end as sbirsis,
				case survey.sbirs_fund
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 2 THEN 13.33
					WHEN 4 THEN 53.33
				end as sbirsfund,
				case survey.sbirs_cost
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
					WHEN 2 THEN 22.22
				end as sbirscost,
				case survey.sbirs_emp
					WHEN 1 THEN 0.00
					WHEN 2 THEN 16.67
					WHEN 3 THEN 75.00
					WHEN 4 THEN 100.00
					WHEN 6 THEN 150.00
				end as sbirsemp,
				case survey.tax_staff
					WHEN 1 THEN 0.00
					WHEN 2 THEN 26.67
					WHEN 3 THEN 40.00
					WHEN 4 THEN 80.00
					WHEN 6 THEN 100.00
				end as taxstaff,
				case survey.capacity_building
					WHEN 4 THEN 100.00
					WHEN 3 THEN 50.00
					WHEN 2 THEN 16.67
					WHEN 1 THEN 0.00
				end as capacitybuilding,
				case survey.attended_training
					WHEN 3 THEN 100.00
					WHEN 2 THEN 44.44
					WHEN 1 THEN 11.11
				end as attendedtraining,
				case survey.trainin_program
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 0 THEN 0.00
				end as traininprogram,
				case survey.sal_structure
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as salstructure,
				case survey.pay_scheme
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as payscheme,
				case survey.contract_staff
					WHEN 1 THEN 22.22
					WHEN 3 THEN 100.00
				end as contractstaff,
				case survey.zone_num
					WHEN 4 THEN 100.00
					WHEN 3 THEN 50.00
					WHEN 2 THEN 16.67
					WHEN 1 THEN 0.00
				end as zonenum,
				survey.full_ict,
				 survey.partial_ict,
				 survey.no_ict,
				 survey.tech_staff,
				case survey.field_report
					WHEN 4 THEN 100.00
					WHEN NULL THEN 0.00
				end as fieldreport,
				case survey.field_report1
					WHEN 4 THEN 100.00
					WHEN NULL THEN 0.00
				end as fieldreport1,
				case survey.field_report2
					WHEN 3 THEN 50.00
					WHEN NULL THEN 0.00
				end as fieldreport2,
				case survey.field_report3
					WHEN 2 THEN 16.67
					WHEN NULL THEN 0.00
				end as fieldreport3,
				case survey.field_report4
					WHEN 1 THEN 0.00
					WHEN NULL THEN 0.00
				end as fieldreport4,
				case survey.report_method
					WHEN 3 THEN 66.67
					WHEN 2 THEN 22.22
					WHEN 3 THEN 100.00
				end as reportmethod,
				case survey1.tin_captured
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as tindatabase,
				case survey1.make_assess
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as makeassess,
				case survey1.taxpayer_engage
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as taxpayerengage,
				case survey1.target_setting
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as targetsetting,
				case survey1.pit_rates
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as pitrates,
				case survey1.validity
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as validity,
				case survey1.have_tin
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as havetin,
				case survey1.reg_pack
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as regpack,
				case survey1.new_tax
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as newtax,
				case survey1.num_page
					WHEN 6 THEN 100.00
					WHEN 5 THEN 83.33
					WHEN 4 THEN 44.44
					WHEN 2 THEN 11.11
					WHEN 1 THEN 5.56
					WHEN 0 THEN 0.00
					WHEN 0 THEN 0.00
				end as numpage,
				case survey1.standard_form
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as standardform,
				case survey1.paper_size
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 1 THEN 6.67
				end as papersize,
				case survey1.avail_public
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as availpublic,
				case survey1.pack_content
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as packcontent,
				case survey1.avail_req
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq,
				case survey1.avail_req1
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq1,
				case survey1.avail_req2
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq2,
				case survey1.avail_req3
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq3,
				case survey1.avail_req4
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq4,
				case survey1.avail_req5
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq5,
				case survey1.avail_req6
					WHEN 1 THEN 1
					WHEN 0 THEN 0
				end as availreq6,
				case survey1.guidance
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as guidance,
				case survey1.avail_online
					WHEN 5 THEN 100.00
					WHEN 1 THEN 6.67
				end as availonline,
				case survey1.sbirs_assessment
					WHEN 1 THEN 100.00
					WHEN 4 THEN 0.00
				end as sirsassessment,
				case survey1.self_assessment
					WHEN 4 THEN 100.00
					WHEN 2 THEN 16.67
					WHEN 1 THEN 8.33
					WHEN 0 THEN 0.00
				end as selfassessment,
				case survey1.self_assesscover
					WHEN 1 THEN 3
					WHEN NULL THEN 0
				end as selfassesscover,
				case survey1.self_assesscover1
					WHEN 1 THEN 3
					WHEN NULL THEN 0
				end as selfassesscover1,
				case survey1.self_assesscover2
					WHEN 1 THEN 3
					WHEN NULL THEN 0
				end as selfassesscover2,
				case survey1.self_assesscover3
					WHEN 1 THEN 3
					WHEN NULL THEN 0
				end as selfassesscover3,
				case survey1.desk_guide
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as deskguide,
				case survey1.object_right
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as objectright,
				case survey1.doc_appeal
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as docappeal,
				case survey1.referred
					WHEN 1 THEN 8.33
					WHEN 2 THEN 16.67
					WHEN 4 THEN 66.67
					WHEN 6 THEN 100.00
				end as referred,
				case survey2.central_platform
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as centralplatform,
				case survey2.auto_platform
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as autoplatform,
				case survey2.online_acc
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as onlineacc,
				case survey2.realtime_acc
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as realtimeacc,
				case survey2.use_consultant
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as useconsultant,
				case survey2.tax_agent
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as taxagent,
				case survey2.exclu_agent
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as excluagent,
				case survey2.govt_dept
					WHEN 2 THEN 100.00
					WHEN 1 THEN 100.00
				end as govtdept,
				case survey2.sbircollect_lg
					WHEN 3 THEN 100.00
					WHEN 1 THEN 100.00
				end as sbircollectlg,
				case survey2.all_cases
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as allcases,
				case survey2.payment_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as paymentaudit,
				case survey2.a2013_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as audit2013,
				case survey2.a2014_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as audit2014,
				case survey2.a2015_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as audit2015,
				case survey2.rev_dept
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as revdept,
				case survey2.revdept_diff
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as revdeptdiff,
				case survey3.taxpayer_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as taxpayeraudit,
				case survey3.last_conducted
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 1 THEN 0.00
				end as lastconducted,
				case survey3.working_cases
					WHEN 1 THEN 5.56
					WHEN 2 THEN 11.11
					WHEN 4 THEN 44.44
					WHEN 6 THEN 100.00
				end as workingcases,
				case survey3.concluded_cases
					WHEN 1 THEN 5.56
					WHEN 2 THEN 11.11
					WHEN 4 THEN 44.44
					WHEN 6 THEN 100.00
				end as concludedcases,
				case survey3.hnwi_unit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as hnwiunit,
				case survey3.hnwi_id
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as hnwiid,
				case survey3.hnwi_action
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as hnwiaction,
				case survey3.agency_coop
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as agencycoop,
				case survey3.tin_tcc
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as tintcc,
				case survey3.debt_enforce
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as debtenforce,
				case survey3.agent_involve
					WHEN 4 THEN 75.00
					WHEN 1 THEN 100.00
				end as agentinvolve,
				case survey3.court_enforce
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as courtenforce,
				case survey3.action_num
					WHEN 1 THEN 5.56
					WHEN 2 THEN 11.11
					WHEN 4 THEN 44.44
					WHEN 6 THEN 100.00
				end as actionnum,
				case survey3.taxpayer_aware
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
					WHEN 2 THEN 16.67
				end as taxpayeraware,
				case survey3.tax_edu
					WHEN 1 THEN 1
					WHEN NULL THEN 0
				end as taxedu,
				case survey3.tax_edu1
					WHEN 1 THEN 1
					WHEN NULL THEN 0
				end as taxedu1,
				case survey3.tax_edu2
					WHEN 1 THEN 1
					WHEN NULL THEN 0
				end as taxedu2,
				case survey3.tax_edu3
					WHEN 1 THEN 1
					WHEN NULL THEN 0
				end as taxedu3,
				case survey3.tax_edu4
					WHEN 1 THEN 1
					WHEN NULL THEN 0
				end as taxedu4,
				case survey3.tax_edu5
					WHEN 1 THEN 1
					WHEN NULL THEN 0
				end as taxedu5,
				case survey3.igr_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as igreffect,
				case survey3.tin_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as tineffect,
				case survey3.tat_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as tateffect,
				case survey3.complaint_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as complainteffect,
				case survey3.servicom
					WHEN 3 THEN 100.00
					WHEN 1 THEN 11.11
				end as servicom,
				case survey3.complaint_num
					WHEN 1 THEN 6.67
					WHEN 2 THEN 26.67
					WHEN 5 THEN 100.00
				end as complaintnum,
				case survey3.process_num
					WHEN 1 THEN 6.67
					WHEN 2 THEN 26.67
					WHEN 5 THEN 100.00
				end as processnum,
				case survey3.process_timetcc
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 2 THEN 33.33
					WHEN 1 THEN 8.33
				end as processtimetcc,
				case survey3.sjtb_functioning
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as sjtbfunctioning,
				case survey3.num_timemet
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 2 THEN 33.33
					WHEN 1 THEN 8.33
				end as numtimemet,
				users.state, survey.num_offices, survey.internet, 
				case survey.standardrpt_format
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as standardrptformat,
				case survey.nature_por
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as naturepor,
				case survey.cap_cost_cov
					WHEN 5 THEN 100.00
					WHEN 3 THEN 40.00
					WHEN 2 THEN 13.33
					WHEN 1 THEN 6.67
				end as capcostcov,
				case survey.perform_app
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as performapp,
				case survey.how_often
					WHEN 3 THEN 100.00
					WHEN 2 THEN 44.44
					WHEN 1 THEN 11.11
				end as howoften,
				case survey.alter_target
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as altertarget,
				case survey.function_website
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as functionwebsite,
				case survey.tax_guide
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as taxguide,
				case survey.tax_ret_form
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as taxretform,
				case survey.tax_calc
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as taxcalc,
				case survey.tax_reg_pack
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as taxregpack,
				case survey.field_off_add
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as fieldoffadd,
				case survey.contact_help
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as contacthelp,
				case survey2.collate_mda_levies
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as collatemdalevies,
				case survey2.collate_lga_levies
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as collatelgalevies,
				case survey2.collect_by_agent
					WHEN 1 THEN 0.00
					WHEN 3 THEN 100.00
				end as collectbyagent,
				case survey2.sbircollect_mda
					WHEN 3 THEN 100.00
					WHEN 1 THEN 11.11
				end as sbircollectmda,
				case survey2.conext_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as conextaudit,
				case survey2.a2013_extaudit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as 2013extaudit,
				case survey2.a2014_extaudit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as 2014extaudit,
				case survey2.a2015_extaudit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as 2015extaudit,
				case survey3.trained_auditor
					WHEN 2 THEN 13.33
					WHEN 3 THEN 40.00
					WHEN 5 THEN 100.00
				end as trainedauditor,
				case survey3.vaids_unit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as vaidsunit,
				case survey3.vaid_staff
					WHEN 1 THEN 8.33
					WHEN 3 THEN 50.00
					WHEN 4 THEN 100.00
				end as vaidstaff,
				case survey.nature_por1
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as naturepor1,
				case survey.nature_por2
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as naturepor2,
				case survey.nature_por3
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as naturepor3,
				case survey.nature_por4
					WHEN 1 THEN 1
					WHEN 0 THEN 0
				end as naturepor4
FROM survey, survey1, survey2, survey3, users WHERE survey.mysession = '" . $state . "' AND survey.quarter = '" . $quarter . "' AND survey.year = '" . $year . "' AND users.username = survey.mysession AND survey1.mysession = '" . $state . "' AND survey1.quarter = '" . $quarter . "' AND survey1.year = '" . $year . "' AND users.username = survey1.mysession AND survey2.mysession = '" . $state . "' AND survey2.quarter = '" . $quarter . "' AND survey2.year = '" . $year . "' AND users.username = survey2.mysession AND survey3.mysession = '" . $state . "' AND survey3.quarter = '" . $quarter . "' AND survey3.year = '" . $year . "' AND users.username = survey3.mysession";
//echo $sql;
//$result = mysql_query($sq1) or die(mysql_error());
//$num_results = mysql_num_rows($result);
//$result = mysql_query($sql) or trigger_error(mysql_error().$sql);
$result=mysqli_query($con, $sq1); //echo $result;
if($result === FALSE) { 
    die(mysqli_error($con)); // TODO: better error handling
}
		
}
?>
            <table class="table table-bordered red">
                <thead>
                    <tr>
            <th style="background-color:black; color:white" align="left"><?php echo $state.' State'; ?></th>
            <th style="background-color:black; color:white;"><?php echo 'Year: '.$year; ?></th>
            <!--<th>∆</th>-->
          </tr>
          <?php
			  while($rs=@mysqli_fetch_array($result,MYSQLI_NUM)){
			$sbirsmeet=$rs[0]; 
		$sbirspolicy=$rs[1];
		$sbirsgov=$rs[2];
		$sbirsscf=$rs[3];
		$sbirssha=$rs[4];
		$sbirschair=$rs[5];
		$naturepor=$rs[111];
		$naturepor1=$rs[134];
		$naturepor2=$rs[135];
		$naturepor3=$rs[136];
		$naturepor4=$rs[137];
		$natureporall=(($naturepor + $naturepor1 + $naturepor2 + $naturepor3 + $naturepor4)/9)*100;
		$orginstave=($sbirsmeet + $sbirspolicy + $sbirsgov + $sbirsscf + $sbirssha + $sbirschair +$natureporall)/7;
		$sbirsis=$rs[6];
		$sbirsfund=$rs[7];
		$sbirscost=$rs[8];
		$capcostcov=$rs[112];
		$budgetavailability=($sbirsis + $sbirsfund + $sbirscost + $capcostcov)/4;
		$sbirsemp=$rs[9];
		$taxstaff=$rs[10];
		$capacitybuilding=$rs[11];
		$attendedtraining=$rs[12];
		$traininprogram=$rs[13];
		$salstructure=$rs[14];
		$payscheme=$rs[15];
		$contractstaff=$rs[16];
		$performapp=$rs[113];
		$howoften=$rs[114];
		$remuneration=($sbirsemp + $taxstaff + $capacitybuilding + $attendedtraining + $traininprogram + $salstructure + $payscheme + $contractstaff + $performapp + $howoften)/10;
		$numoffices=$rs[108];
		$standardrptformat=$rs[110];
		$zonenum=$rs[17];
		$fullit=$rs[18];
		$fullits=($fullit/$numoffices)*100;
		if($fullits == 100){
    $fullits = 100.00;
		}
		if($fullits >= 50 && $fullits <= 99){
    $fullits = 55.56;
		}
		if($fullits >= 25 && $fullits <= 49){
    $fullits = 22.22;
		}
		if($fullits >= 0 && $fullits <= 24){
    $fullits = 0.00;
		} else {
		}
		$partialit=$rs[19];
		$partialits=($partialit/$numoffices)*100;
		if($partialits == 100){
    $partialits = 100.00;
		}
		if($partialits >= 50 && $partialits <= 99){
    $partialits = 55.56;
		}
		if($partialits >= 25 && $partialits <= 49){
    $partialits = 22.22;
		}
		if($partialits >= 0 && $partialits <= 24){
    $partialits = 0.00;
		} else {
		}
		$noict=$rs[20];
		$noicts=($noict/$numoffices)*100;
		if($noicts == 100){
    $noicts = 100.00;
		}
		if($noicts >= 50 && $noicts <= 99){
    $noicts = 55.56;
		}
		if($noicts >= 25 && $noicts <= 49){
    $noicts = 22.22;
		}
		if($noicts >= 0 && $noicts <= 24){
    $noicts = 0.00;
		} else {
		}
		$highest_ict = max($fullits, $partialits, $noicts);
		$techstaff=$rs[21];
		$techstaffs=($techstaff/$numoffices)*100;
		if($techstaffs == 100){
    $techstaffs = 100.00;
		}
		if($techstaffs >= 50 && $techstaffs <= 99){
    $techstaffs = 55.56;
		}
		if($techstaffs >= 25 && $techstaffs <= 49){
    $techstaffs = 22.22;
		}
		if($techstaffs >= 0 && $techstaffs <= 24){
    $techstaffs = 0.00;
		} else {
		}
		$internet=$rs[109];
		$internets=($internet/$numoffices)*100;
		if($internets == 100){
    $internets = 100.00;
		}
		if($internets >= 50 && $internets <= 99){
    $internets = 55.56;
		}
		if($internets >= 25 && $internets <= 49){
    $internets = 22.22;
		}
		if($internets >= 0 && $internets <= 24){
    $internets = 0.00;
		} else {
		}
		$fieldreport=$rs[22];
		$fieldreport1=$rs[23];
		$fieldreport2=$rs[24];
		$fieldreport3=$rs[25];
		$fieldreport4=$rs[26];
		$highest_fieldreport = max($fieldreport, $fieldreport1, $fieldreport2, $fieldreport3, $fieldreport4);
		$reportmethod=$rs[27];
		$altertarget=$rs[115];
		$functionwebsite=$rs[116];
		$taxguide=$rs[117];
		$taxretform=$rs[118];
		$taxcalc=$rs[119];
		$taxregpack=$rs[120];
		$fieldoffadd=$rs[121];
		$contacthelp=$rs[122];
		$websitestuff=(($taxguide + $taxretform + $taxcalc + $taxregpack + $fieldoffadd + $contacthelp)/12)*100;
		$outreach=($zonenum + $highest_ict + $techstaffs + $internets + $highest_fieldreport + $reportmethod + $standardrptformat + $altertarget + $functionwebsite + $websitestuff)/10;
		$taxadmin=($orginstave + $budgetavailability + $remuneration + $outreach)/4; //echo $taxadmin;
		$tindatabase=$rs[28];
		$makeassess=$rs[29];
		$taxpayerengage=$rs[30];
		$targetsetting=$rs[31];
		$pitrates=$rs[32];
		$havetin=$rs[34];
		$regpack=$rs[35];
		$newtax=$rs[36];
		$numpage=$rs[37];
		$standardform=$rs[38];
		$papersize=$rs[39];
		$availpublic=$rs[40];
		$packcontent=$rs[41];
		$availreq=$rs[42];
		$availreq1=$rs[43];
		$availreq2=$rs[44];
		$availreq3=$rs[45];
		$availreq4=$rs[46];
		$availreq5=$rs[47];
		$availreq6=$rs[48];
		$availreqall=(($availreq + $availreq1 + $availreq2 + $availreq3 + $availreq4 + $availreq5 + $availreq6)/13)*100;
		$guidance=$rs[49];
		$availonline=$rs[50];
		$taxregtin=($tindatabase + $makeassess + $taxpayerengage + $targetsetting + $pitrates + $havetin + $regpack + $newtax + $numpage + $standardform + $papersize + $availpublic + $packcontent + $availreqall + $guidance + $availonline)/16;
		$sirsassessment=$rs[51];
		$selfassessment=$rs[52];
		$selfassesscover=$rs[53];
		$selfassesscover1=$rs[54];
		$selfassesscover2=$rs[55];
		$selfassesscover3=$rs[56];
		$selfassesscoverall=(($selfassesscover + $selfassesscover1 + $selfassesscover2 + $selfassesscover3)/12)*100;
		$deskguide=$rs[57];
		$objectright=$rs[58];
		$docappeal=$rs[59];
		$referred=$rs[60];
		$validity=$rs[33];
		$taxefficient=($sirsassessment + $selfassessment + $selfassesscoverall + $deskguide + $objectright + $docappeal + $referred + $validity)/8;
		$taxprocedure=($taxregtin + $taxefficient)/2; //echo $taxprocedure;
		$centralplatform=$rs[61];
		$autoplatform=$rs[62];
		$onlineacc=$rs[63];
		$realtimeacc=$rs[64];
		$useconsultant=$rs[65];
		$taxagent=$rs[66];
		$excluagent=$rs[67];
		$govtdept=$rs[68];
		$sbircollectlg=$rs[69];
		$allcases=$rs[70];
		$paymentaudit=$rs[71];
		$audit2013=$rs[72];
		$audit2014=$rs[73];
		$audit2015=$rs[74];
		$revdept=$rs[75];
		$revdeptdiff=$rs[76];
		$collatemdalevies=$rs[123];
		$collatelgalevies=$rs[124];
		$collectbyagent=$rs[125];
		$sbircollectmda=$rs[126];
		$conextaudit=$rs[127];
		$extaudit2013=$rs[128];
		$extaudit2014=$rs[129];
		$extaudit2015=$rs[130];
		if($useconsultant == 100.00){
		$taxprocessing=($centralplatform + $autoplatform + $onlineacc + $realtimeacc + $useconsultant + $govtdept + $sbircollectlg + $allcases + $paymentaudit + $audit2013 + $audit2014 + $audit2015 + $revdept + $revdeptdiff + $collatemdalevies + $collatelgalevies + $collectbyagent + $sbircollectmda + $conextaudit + $extaudit2013 + $extaudit2014 + $extaudit2015)/22;
} else {
		$taxprocessing=($centralplatform + $autoplatform + $onlineacc + $realtimeacc + $useconsultant + $taxagent + $excluagent + $govtdept + $sbircollectlg + $allcases + $paymentaudit + $audit2013 + $audit2014 + $audit2015 + $revdept + $revdeptdiff + $collatemdalevies + $collatelgalevies + $collectbyagent + $sbircollectmda + $conextaudit + $extaudit2013 + $extaudit2014 + $extaudit2015)/24; //echo $taxprocessing;
		}
		$taxpayeraudit=$rs[77];
		$lastconducted=$rs[78];
		$workingcases=$rs[79];
		$concludedcases=$rs[80];
		$hnwiunit=$rs[81];
		$hnwiid=$rs[82];
		$hnwiaction=$rs[83];
		$agencycoop=$rs[84];
		$tintcc=$rs[85];
		$debtenforce=$rs[86];
		$agentinvolve=$rs[87];
		$courtenforce=$rs[88];
		$actionnum=$rs[89];
		$trainedauditor=$rs[131];
		$vaidsunit=$rs[132];
		$vaidstaff=$rs[133];
		$taxenforce=($taxpayeraudit + $lastconducted + $workingcases + $concludedcases + $hnwiunit + $hnwiid + $hnwiaction + $agencycoop + $tintcc + $debtenforce + $agentinvolve + $courtenforce + $actionnum + $trainedauditor + $vaidsunit + $vaidstaff)/16;
		$taxpayeraware=$rs[90];
		$taxedu=$rs[91];
		$taxedu1=$rs[92];
		$taxedu2=$rs[93];
		$taxedu3=$rs[94];
		$taxedu4=$rs[95];
		$taxedu5=$rs[96];
		$taxeduall=(($taxedu + $taxedu1 + $taxedu2 + $taxedu3 + $taxedu4 + $taxedu5)/6)*100;
		$igreffect=$rs[97];
		$tineffect=$rs[98];
		$tateffect=$rs[99];
		$complainteffect=$rs[100];
		$taxaware=($taxpayeraware + $taxeduall + $igreffect + $tineffect + $tateffect + $complainteffect)/6;
		$servicom=$rs[101];
		$complaintnum=$rs[102];
		$processnum=$rs[103];
		$processtimetcc=$rs[104];
		$complaints=($servicom + $complaintnum + $processnum + $processtimetcc)/4;
		$sjtbfunctioning=$rs[105];
		$numtimemet=$rs[106];
		$doubletax=($sjtbfunctioning + $numtimemet)/2;
		$taxenforcem=($taxenforce + $taxaware + $complaints + $doubletax)/4; //echo $taxenforcem;
		$overall=($taxadmin + $taxprocedure + $taxprocessing + $taxenforcem)/4;
		$showme=$rs[107];
		$taxadmin=number_format($taxadmin,2);
		$taxprocedure=number_format($taxprocedure,2);
		$taxprocessing=number_format($taxprocessing,2);
		$taxenforcem=number_format($taxenforcem,2);		
		$dataSet->addPoint(new Point("Tax Administration ($taxadmin)","$taxadmin"));
		$dataSet->addPoint(new Point("Tax Procedures ($taxprocedure)","$taxprocedure"));
		$dataSet->addPoint(new Point("Tax Processing ($taxprocessing)","$taxprocessing"));
		$dataSet->addPoint(new Point("Tax Enforcement ($taxenforcem)","$taxenforcem"));
		//} 
		echo '<tr>';
				echo '<th style="background-color:powderblue;"><b>Overall Performance, ' . $showme . ' State</b></th><th style="background-color:powderblue;" align="center"><b>' . number_format($overall,2) . '</b></th></tr>';
                  echo '<tr>';
                       echo '<th scope="col">';
                           echo '<span class="text-danger">Tax Administration</span>';
                       echo '</th>';
                       echo '<th scope="col" class="fixed_small">';
                           echo '<span class="text-danger">' . number_format($taxadmin,2) . '</span>';
                       echo '</th>
                    </tr>
                </thead>';
               echo '<tbody>
                    <tr>
                        <td class="task-name">Organisational and Institutional Arrangements</td>
                        <td>' . number_format($orginstave,2) . '</td>
                    </tr>
                    <tr>
                        <td class="task-name">Availability and Sufficiency of IRS Budget</td>
                        <td>' . number_format($budgetavailability,2) . '</td>
                    </tr>
                <tr>
                        <td class="task-name">Salary Incentives, IRS Staff Skills and Training Levels</td>
                        <td>' . number_format($remuneration,2) . '</td>
                    </tr> 
                    <tr>
                        <td class="task-name">SBIRS Outreach in Districts (No of Tax Offices)</td>
                        <td>' . number_format($outreach,2) . '</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>';

   echo '<div class="table-wrapper mt-5">
        <!-- <div class="header-info justify-content-center">
            <span class="table_name text-danger">Task Procedure (Year 2022)</span>
        </div> -->
        <div class="overflow-x">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">
                            <span class="text-dark">Tax Procedures (Registration, Filling, Assessment and Payment)</span>
                        </th>
                        <th scope="col" class="fixed_small">
                            <span class="text-dark">' . number_format($taxprocedure,2) . '</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="task-name">Tax registration using Unified Tax Identification Number (TIN)</td>
                        <td>' . number_format($taxregtin,2) . '</td>
                    </tr>
                    <tr>
                        <td class="task-name">Efficiency of Tax Collection Method (BoJ by Tax Officers v Self- assessment)</td>
                        <td>' . number_format($taxefficient,2) . '</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>';

    echo '<div class="table-wrapper mt-5">
        <!-- <div class="header-info justify-content-center">
            <span class="table_name text-danger">Task Procedure (Year 2022)</span>
        </div> -->
        <div class="overflow-x">
            <table class="table table-bordered yellow">
                <thead>
                    <tr>
                        <th scope="col">
                            <span class="text-warning">Tax Processing (Manual v Automated)</span>
                        </th>
                        <th scope="col" class="fixed_small">
                            <span class="text-warning">' . number_format($taxprocessing,2) . '</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="task-name">Tax payment (cash paid to tax officers versus Bank and electronic payment)</td>
                        <td>' . number_format($taxprocessing,2) . '</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>';

    echo '<div class="table-wrapper mt-5">
        <!-- <div class="header-info justify-content-center">
            <span class="table_name text-danger">Task Procedure (Year 2022)</span>
        </div> -->
        <div class="overflow-x">
            <table class="table table-bordered blue">
                <thead>
                    <tr>
                        <th scope="col">
                            <span class="text-dark">Tax Enforcement</span>
                        </th>
                        <th scope="col" class="fixed_small">
                            <span class="text-dark">' . number_format($taxenforcem,2) . '</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="task-name">Capacity for Taxpayer Audits</td>
                        <td>' . number_format($taxenforce,2) . '</td>
                    </tr>
                    <tr>
                        <td class="task-name">Tax Awareness</td>
                        <td>' . number_format($taxaware,2) . '</td>
                    </tr>
                    <tr>
                        <td class="task-name">Complaints</td>
                        <td>' . number_format($complaints,2) . '</td>
                    </tr>
                    <tr>
                        <td class="task-name">Double Taxation</td>
                        <td>' . number_format($doubletax,2) . '</td>
                    </tr>';
			  }
			  ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php include('_footer.php') ?>

<style>
    .table th, .table td{
        border: 0;
    }
</style>

<script>
    $('a[href="StateExplorer"]').addClass('active')
</script>
<p>&nbsp;</p>
<hr width="100%" />
<table width="100%"><tr><td><table width="100%" border="0">
<tr>
    <td align="center" style="font-family: Tahoma, Geneva, sans-serif; font-size: 11px; text-decoration: none; margin: 1px; padding: 12px;"><a href="faq.php">FAQ</a> | <a href="help.php">Help</a> | <a href="IGR Dashboard How-to-Guide.pdf" target="new">User Guide</a> | <a href="contactform.php" target="new">Contact Us</a></td>
  </tr>
  <tr>
    <td align="center" style="font-size: 11px; color: #093; text-align: center;">&copy;2016 - 2017 Nigeria Governors' Forum </td>
  </tr>
</table></td></tr></table>
<p>&nbsp;</p>