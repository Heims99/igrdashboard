<?php
session_start();
include_once 'connection.php';

if(!isset($_SESSION['user']))
{
 header("Location: login_front.php");
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="NGF IGR Dashboard">
<meta name="keywords" content="IGR,NGF,Dashboard,Tax,Allocation,Revenue">
<meta name="author" content="Maduka Okafor">
<title>State Performance - <?php echo $userRow['state']; ?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.myimg {
	border: thin solid #5D3235;
}
.menu_nav {
	margin:22px 0 0 0;
	padding:0;
	width:1000px;
	float:right;
}
.menu_nav ul {
	list-style:none;
	margin:0;
	padding:0;
	float:right;
}
.menu_nav ul li {
	margin:0;
	padding:0;
	float:left;
}
.menu_nav ul li a {
	display: block;
	margin: 0;
	padding: 25px 15px;
	color: #461D1D;
	text-decoration: none;
	font-size: 13px;
	line-height: 16px;
}
.menu_nav ul li.active a, .menu_nav ul li a:hover {
	color:#7baf30;
	text-decoration:none;
}
</style>
</head>

<body>
<table width="100%" border="0">
  <tr>
    <td><a href="index.php"><img src="images/NGF_logo.png" width="353" height="129" /></a></td>
    <td><table width="100%" border="0">
      <tr>
        <td align="right" valign="top" class="mytopmenunew"><div id="content">
         Welcome, <?php echo $userRow['username']; ?> ::<a href="logout_front.php?logout">Sign Out</a>| <a href="home.php?logout">My Admin</a>| <a href="downloads.php">My Reports</a>
      </div></td>
      </tr>
      
      <tr>
        <td  valign="bottom">
<div class="menu_nav">
<ul>
<li><a href="index.php">Home</a></li>
<li><a href="group_explorer.php">Group Explorer</a></li>
<li><a href="#">State Explorer</a></li>
<li><a href="state_igr.php">States' IGR</a></li>
<li><a href="faac.php">Federation Allocation</a></li>
<li><a href="trr.php">Total Recurrent Revenue</a></li>
<li><a href="trr_analysis.php">TRR Analytics</a></li>
<li><a href="http://www.nggovernorsforum.org/index.php/resources/category/21-igr-dashboard-resource-tools" target="new">Resources</a></li>
</ul>
</div></td>
      </tr>
    </table></td>
  </tr>
</table>
<hr width="100%" />
<table width="100%" border="0" class="outer_table">
  <tr>
    <td width="45%" valign="top"><table width="100%" border="0" class="inner_table">
      <tr>
        <td><table width="100%" border="0">
          <tr>
            <td colspan="2"><form id="form1" name="form1" method="post" action="#">
              <label>State<span></span></label>
              <select name="state" size="1"><?php
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
              <label>Year<span></span></label>
              <select name="year" size="1"><?php
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
              <input name="Submit" type="submit" class="" value="Display" />
              <br />
            </form></td>
            </tr>
          <tr>
            <td><h3>State Performance</h3></td>
            <td align="right"><font size="1">∆ = change since previous year</font></td>
          </tr>
        </table></td>
      </tr>
      <tr>
      <?php
      
      include "libchart/libchart/classes/libchart.php";

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

        <td><table width="100%" border="0" class="status_table" cellpadding="4" cellspacing="0">
          <tr>
            <th align="left"><?php echo $state.' State'; ?></th>
            <th><?php echo 'Year: '.$year; ?></th>
            <th>∆</th>
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
				echo '<td><b>Overall Performance, ' . $showme . ' State</b></td><td align="center"><b>' . number_format($overall,2) . '</b></td><td align="center"></td></tr>';
				echo '<td><b><font color="#930">&nbsp;&nbsp;Tax Administration</b></td><td align="center"><b><font color="#930">' . number_format($taxadmin,2) . '</b></td><td align="center"><b><font color="#930"></b></td></tr>';
                echo '<td><font color="#930"> &nbsp;&nbsp; - Organisational and Institutional Arrangements</td><td align="center"><font color="#930">' . number_format($orginstave,2) . '</td><td align="center"><font color="#930"></td></tr>';
				/*echo '<td>' . $sbirsmeet . '</td>';
                echo '<td>' . $sbirspolicy . '</td>';
                echo '<td>' . $sbirsgov . '</td>';
                echo '<td>' . $sbirsscf . '</td>';
				echo '<td>' . $sbirssha . '</td>';
				echo '<td>' . $sbirschair . '</td>';*/
				echo '<td><font color="#930">&nbsp;&nbsp; - Availability and Sufficiency of IRS Budget</td><td align="center"><font color="#930">' . number_format($budgetavailability,2) . '</td><td align="center"><font color="#930"></td></tr>';
				/*echo '<td>' . $sbirsis . '</td>';
				echo '<td>' . $sbirsfund . '</td>';
				echo '<td>' . $sbirscost . '</td>';*/
				echo '<td><font color="#930">&nbsp;&nbsp; - Salary Incentives, IRS Staff Skills and Training Levels</td><td align="center"><font color="#930">' . number_format($remuneration,2) . '</td><td align="center"><font color="#930"></td></tr>';
				/*echo '<td>' . $sbirsemp . '</td>';
                echo '<td>' . $taxstaff . '</td>';
                echo '<td>' . $capacitybuilding . '</td>';
                echo '<td>' . $attendedtraining . '</td>';
				echo '<td>' . $traininprogram . '</td>';
				echo '<td>' . $salstructure . '</td>';
				echo '<td>' . $payscheme . '</td>';
				echo '<td>' . $contractstaff . '</td>';*/
				echo '<td><font color="#930"> &nbsp;&nbsp; - SBIRS Outreach in Districts (No of Tax Offices)</td><td align="center"><font color="#930">' . number_format($outreach,2) . '</td><td align="center"><font color="#930"></td></tr>';
				/*echo '<td>' . $zonenum . '</td>';
                echo '<td>' . $fullit . '</td>';
                echo '<td>' . $partialit . '</td>';
                echo '<td>' . $noict . '</td>';
				echo '<td>' . $techstaff . '</td>';
				echo '<td>' . $fieldreport . '</td>';
				echo '<td>' . $fieldreport1 . '</td>';
				echo '<td>' . $fieldreport2 . '</td>';
				echo '<td>' . $fieldreport3 . '</td>';
				echo '<td>' . $fieldreport4 . '</td>';
				echo '<td>' . $reportmethod . '</td>';*/
				echo '<td><b><font color="#f30">&nbsp;&nbsp;Tax Procedures (Registration, Filling, Assessment and Payment)</b></td><td align="center"><b><font color="#f30">' . number_format($taxprocedure,2) . '</b></td><td align="center"><b><font color="#f30"></b></td></tr>';
				echo '<td><font color="#f30"> &nbsp;&nbsp; - Tax registration using Unified Tax Identification Number (TIN)</td><td align="center"><font color="#f30">' . number_format($taxregtin,2) . '</td><td align="center"><font color="#f30"></td></tr>';
				/*echo '<td>' . $tindatabase . '</td>';
                echo '<td>' . $tinaction . '</td>';
                echo '<td>' . $tinby . '</td>';
                echo '<td>' . $tinby1 . '</td>';
				echo '<td>' . $tinby2 . '</td>';
				echo '<td>' . $tinby3 . '</td>';
				echo '<td>' . $informal . '</td>';
				echo '<td>' . $moreinformal . '</td>';
				echo '<td>' . $program . '</td>';
				echo '<td>' . $program1 . '</td>';
				echo '<td>' . $program2 . '</td>';
				echo '<td>' . $program3 . '</td>';
                echo '<td>' . $regpack . '</td>';
                echo '<td>' . $dpa . '</td>';
                echo '<td>' . $newtax . '</td>';
				echo '<td>' . $numpage . '</td>';
				echo '<td>' . $standardform . '</td>';
				echo '<td>' . $papersize . '</td>';
				echo '<td>' . $availpublic . '</td>';
				echo '<td>' . $packcontent . '</td>';
				echo '<td>' . $availreq . '</td>';
				echo '<td>' . $availreq1 . '</td>';
				echo '<td>' . $availreq2 . '</td>';
				echo '<td>' . $availreq3 . '</td>';
				echo '<td>' . $availreq4 . '</td>';
				echo '<td>' . $availreq5 . '</td>';
				echo '<td>' . $availreq6 . '</td>';
				echo '<td>' . $guidance . '</td>';
				echo '<td>' . $availonline . '</td>';*/
				echo '<td><font color="#f30"> &nbsp;&nbsp; - Efficiency of Tax Collection Method (BoJ by Tax Officers v Self- assessment)</td><td align="center"><font color="#f30">' . number_format($taxefficient,2) . '</td><td align="center"><font color="#f30"></td></tr>';
				/*echo '<td>' . $sirsassessment . '</td>';
                echo '<td>' . $selfassessment . '</td>';
                echo '<td>' . $selfassesscover . '</td>';
                echo '<td>' . $selfassesscover1 . '</td>';
				echo '<td>' . $selfassesscover2 . '</td>';
				echo '<td>' . $selfassesscover3 . '</td>';
				echo '<td>' . $deskguide . '</td>';
				echo '<td>' . $objectright . '</td>';
				echo '<td>' . $docappeal . '</td>';
				echo '<td>' . $referred . '</td>';*/
				echo '<td><b><font color="#066">&nbsp;&nbsp;Tax Processing (Manual v Automated)</b></td><td align="center"><b><font color="#066">' . number_format($taxprocessing,2) . '</b></td><td align="center"><b><font color="#066"></b></td></tr>';
				echo '<td><font color="#066">&nbsp;&nbsp; - Tax payment (cash paid to tax officers versus Bank and electronic payment)</td><td align="center"><font color="#066">' . number_format($taxprocessing,2) . '</td><td align="center"><font color="#066"></td></tr>';
				/*echo '<td>' . $centralplatform . '</td>';
                echo '<td>' . $autoplatform . '</td>';
                echo '<td>' . $onlineacc . '</td>';
                echo '<td>' . $realtimeacc . '</td>';
				echo '<td>' . $useconsultant . '</td>';
				echo '<td>' . $taxagent . '</td>';
				echo '<td>' . $excluagent . '</td>';
				echo '<td>' . $govtdept . '</td>';
				echo '<td>' . $sbircollectlg . '</td>';
				echo '<td>' . $allcases . '</td>';
				echo '<td>' . $paymentaudit . '</td>';
				echo '<td>' . $audit2013 . '</td>';
                echo '<td>' . $audit2014 . '</td>';
                echo '<td>' . $audit2015 . '</td>';
                echo '<td>' . $revdept . '</td>';
				echo '<td>' . $revdeptdiff . '</td>';*/
				echo '<td><b><font color="#06c">&nbsp;&nbsp;Tax Enforcement</b></td><td align="center"><b><font color="#06c">' . number_format($taxenforcem,2) . '</b></td><td align="center"><b><font color="#06c"></b></td></tr>';
				echo '<td><font color="#06c">&nbsp;&nbsp; - Capacity for Taxpayer Audits</td><td align="center"><font color="#06c">' . number_format($taxenforce,2) . '</td><td align="center"><font color="#06c"></td></tr>';
				/*echo '<td>' . $taxpayeraudit . '</td>';
                echo '<td>' . $last_conducted . '</td>';
                echo '<td>' . $working_cases . '</td>';
                echo '<td>' . $concluded_cases . '</td>';
				echo '<td>' . $hnwi_unit . '</td>';
				echo '<td>' . $hnwi_id . '</td>';
				echo '<td>' . $hnwi_action . '</td>';
				echo '<td>' . $agency_coop . '</td>';
				echo '<td>' . $tin_tcc . '</td>';
				echo '<td>' . $debt_enforce . '</td>';
				echo '<td>' . $agent_involve . '</td>';
                echo '<td>' . $court_enforce . '</td>';
                echo '<td>' . $action_num . '</td>';*/
				echo '<td><font color="#06c">&nbsp;&nbsp; - Tax Awareness</td><td align="center"><font color="#06c">' . number_format($taxaware,2) . '</td><td align="center"><font color="#06c"></td></tr>';
				/*echo '<td>' . $taxpayeraware . '</td>';
                echo '<td>' . $taxedu . '</td>';
                echo '<td>' . $taxedu1 . '</td>';
                echo '<td>' . $taxedu2 . '</td>';
				echo '<td>' . $taxedu3 . '</td>';
				echo '<td>' . $taxedu4 . '</td>';
				echo '<td>' . $taxedu5 . '</td>';
				echo '<td>' . $igreffect . '</td>';
				echo '<td>' . $tineffect . '</td>';
				echo '<td>' . $tateffect . '</td>';
				echo '<td>' . $complainteffect . '</td>';*/
				echo '<td><font color="#06c">&nbsp;&nbsp; - Complaints</td><td align="center"><font color="#06c">' . number_format($complaints,2) . '</td><td align="center"><font color="#06c"></td></tr>';
				/*echo '<td>' . $servicom . '</td>';
                echo '<td>' . $complaintnum . '</td>';
                echo '<td>' . $processnum . '</td>';
                echo '<td>' . $processtimetcc . '</td>';*/
				echo '<td><font color="#06c">&nbsp;&nbsp; - Double Taxation</td><td align="center"><font color="#06c">' . number_format($doubletax,2) . '</td><td align="center"><font color="#06c"></td></tr>';
				/*echo '<td>' . $sjtbfunctioning . '</td>';
                echo '<td>' . $numtimemet . '</td>';*/
              echo '</tr>';
			 }
			  ?>
              
        </table></td>
      </tr>
    </table></td>
    <td width="55%" valign="top"><table width="100%"><tr><td align="center"><?php
    //hide chart
    //$chart->setDataSet($dataSet);

	//$chart->setTitle($state." State Tax Performance (% of Overall)");
	//$chart->render("libchart/demo/generated/demo75.png");
			  ?>
                          <!-- <img alt="Pie chart" src="libchart/demo/generated/demo75.png" /> -->
    </td></tr></table></td>
  </tr>
</table>
<p>&nbsp;</p>
<hr width="100%" />
<table width="100%"><tr><td><table width="100%" border="0">
<tr>
    <td align="center" class="mytopmenu"><a href="faq.php">FAQ</a>| <a href="help.php">Help</a>| <a href="IGR Dashboard How-to-Guide.pdf" target="new">User Guide</a>| <a href="contactform.php" target="new">Contact Us</a></td>
  </tr>
  <tr>
    <td align="center" class="myfooter">&copy;2016 - 2017 Nigeria Governors' Forum </td>
  </tr>
</table></td></tr></table>
</body>
</html>