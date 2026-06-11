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
function getRank($statenames, $scores)
{
	$ranks = array();
	
	$len = sizeof($statenames);	
	if(isset($scores))
	{
    	arsort($scores);	
	 
	for($i =1; $i <= $len; $i++)
	{  
	  $position = 1;
	
	  foreach ($scores as $key => $val) 
	  {
		  if($statenames[$i] == $key)
		  {
			  $ranks[$statenames[$i]] = $position;		
			  break;	  
		  }
		  $position = $position + 1;
	  }    
 	}
  } 
	
	
	return $ranks;	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="NGF IGR Dashboard">
<meta name="keywords" content="IGR,NGF,Dashboard,Tax,Allocation,Revenue">
<meta name="author" content="Maduka Okafor">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<title>States' Scoring - <?php echo $userRow['state']; ?></title>
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
<li><a href="#">Group Explorer</a></li>
<li><a href="state_explorer.php">State Explorer</a></li>
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
    <td><table width="100%" border="0" class="inner_table">
      <tr>
        <td><table width="100%" border="0">
          <tr>
            <td colspan="2"><form id="form1" name="form1" method="post" action="#">
              <label>Select View<span></span></label>
              <select name="select_view">
                  <option value="overall" value="">OVERALL, CATEGORY</options>
                  
                  </select>
<label>Zone<span></span></label>
              <select name="zone" size="1">
                  
                  
                  <?php 
$con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}

// ----------This creates the drop down box using records in the table -----------
    echo '<option value="">'.' ---select zone ---'.'</option>';
    $query = mysqli_query($con,"SELECT zoneId, zoneName FROM zone ORDER BY zoneName");
    while($row=mysqli_fetch_array($query))
    { echo "<option class=highlight value='". $row[0]."'>".$row[1]
    .'</option>';}
    ?></select>
              
              <select name="quarter" size="1" hidden="true">
                  
                   <?php 
$con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}

// ----------This creates the drop down box using records in the table -----------
    //echo '<option value="">'.' ---select quarter ---'.'</option>';
    $query = mysqli_query($con,"SELECT quarterId, quarter FROM quarter ORDER BY quarter");
    while($row=mysqli_fetch_array($query))
    { echo "<option class=highlight value='". $row[1]."'>".$row[1]
    .'</option>';}
    ?></select>
                  
			  
              <label>Year<span></span></label>
              <select name="year" size="1">
			  
			  <?php 
$con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}

// ----------This creates the drop down box using records in the table -----------
    echo '<option value="">'.' ---select year ---'.'</option>';
    $query = mysqli_query($con,"SELECT DISTINCT(year) FROM ngfYear ORDER BY year");
    while($row=mysqli_fetch_array($query))
    { echo "<option class=highlight value='". $row[0]."'>".$row[0]
    .'</option>';}
    ?></select>
			  
			  
              <input name="Submit" type="submit" class="" value="Display" />
              <br />
            </form></td>
            </tr>
          <tr>
            <td><h3>States' Scoring</h3><br /><font size="1">∆ = change since previous year</font></td>
            <td align="right"><button onclick="myFunction()">Print page</button>

<script>
function myFunction() {
    window.print();
}
</script></td>
          </tr>
        </table></td>
      </tr>
      <tr>
      <?php
if(isset($_POST['Submit']))
{ 
    
include "libchart/libchart/classes/libchart.php";
	$chart = new HorizontalBarChart(250, 500);
	$dataSet = new XYDataSet();
	$chart->setDataSet($dataSet);
	$chart->getPlot()->setGraphPadding(new Padding(5, 30, 20, 25));    
    
$zone=$_POST['zone']; //echo $zone;
$quarter=$_POST['quarter']; //echo $quarter;
$year=$_POST['year']; //echo $year;
$link = mysqli_connect("localhost", "nggovern_Garki", "NgfBassi1!", "nggovern_dashboard");
if(mysqli_errno($link))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
mysqli_query($link, "SET SQL_BIG_SELECTS=1");

$sq10 = "SELECT 
				case sbirs_meet
					WHEN 4 THEN 53.33
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 2 THEN 0.00
					WHEN 1 THEN 0.00
				end as sbirsmeet, 
				case sbirs_policy
					WHEN 2 THEN 22.22
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as sbirspolicy, 
				case sbirs_gov
					WHEN 5 THEN 100.00
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 2 THEN 25.00
					WHEN 1 THEN 0.00
				end as sbirsgov, 
				case sbirs_scf
					WHEN 5 THEN 100.00
					WHEN 4 THEN 53.33
					WHEN 3 THEN 20.00
					WHEN 2 THEN 0.00
					WHEN 1 THEN 0.00
				end as sbirsscf, 
				case sbirs_sha
					WHEN 5 THEN 0.00
					WHEN 2 THEN 25.33
					WHEN 3 THEN 37.50
					WHEN 4 THEN 100.00
					WHEN 1 THEN 25.00
					WHEN 0 THEN 0.00
				end as sbirssha, 
				case sbirs_chair
					WHEN 2 THEN 100.00
					WHEN 1 THEN 0.00
				end as sbirschair,
				case sbirs_is
					WHEN 3 THEN 100.00
					WHEN 2 THEN 44.44
					WHEN 1 THEN 0.00
				end as sbirsis,
				case sbirs_fund
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 2 THEN 13.33
					WHEN 4 THEN 53.33
				end as sbirsfund,
				case sbirs_cost
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
					WHEN 2 THEN 22.22
				end as sbirscost,
				case sbirs_emp
					WHEN 1 THEN 0.00
					WHEN 2 THEN 16.67
					WHEN 3 THEN 75.00
					WHEN 4 THEN 100.00
					WHEN 6 THEN 150.00
				end as sbirsemp,
				case tax_staff
					WHEN 1 THEN 0.00
					WHEN 2 THEN 26.67
					WHEN 3 THEN 40.00
					WHEN 4 THEN 80.00
					WHEN 6 THEN 100.00
				end as taxstaff,
				case capacity_building
					WHEN 4 THEN 100.00
					WHEN 3 THEN 50.00
					WHEN 2 THEN 16.67
					WHEN 1 THEN 0.00
				end as capacitybuilding,
				case attended_training
					WHEN 3 THEN 100.00
					WHEN 2 THEN 44.44
					WHEN 1 THEN 11.11
				end as attendedtraining,
				case trainin_program
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 0 THEN 0.00
				end as traininprogram,
				case sal_structure
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as salstructure,
				case pay_scheme
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as payscheme,
				case contract_staff
					WHEN 1 THEN 22.22
					WHEN 3 THEN 100.00
				end as contractstaff,
				case zone_num
					WHEN 4 THEN 100.00
					WHEN 3 THEN 50.00
					WHEN 2 THEN 16.67
					WHEN 1 THEN 0.00
				end as zonenum,
				 full_ict,
				 partial_ict,
				 no_ict,
				 tech_staff,
				case field_report
					WHEN 4 THEN 100.00
					WHEN NULL THEN 0.00
				end as fieldreport,
				case field_report1
					WHEN 4 THEN 100.00
					WHEN NULL THEN 0.00
				end as fieldreport1,
				case field_report2
					WHEN 3 THEN 50.00
					WHEN NULL THEN 0.00
				end as fieldreport2,
				case field_report3
					WHEN 2 THEN 16.67
					WHEN NULL THEN 0.00
				end as fieldreport3,
				case field_report4
					WHEN 1 THEN 0.00
					WHEN NULL THEN 0.00
				end as fieldreport4,
				case report_method
					WHEN 3 THEN 66.67
					WHEN 2 THEN 22.22
					WHEN 3 THEN 100.00
				end as reportmethod,
				case tin_captured
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as tindatabase,
				case make_assess
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as makeassess,
				case taxpayer_engage
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as taxpayerengage,
				case target_setting
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as targetsetting,
				case pit_rates
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as pitrates,
				case validity
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as validity,
				case have_tin
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as havetin,
				case reg_pack
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as regpack,
				case new_tax
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as newtax,
				case num_page
					WHEN 6 THEN 100.00
					WHEN 5 THEN 83.33
					WHEN 4 THEN 44.44
					WHEN 2 THEN 11.11
					WHEN 1 THEN 5.56
					WHEN 0 THEN 0.00
					WHEN 0 THEN 0.00
				end as numpage,
				case standard_form
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as standardform,
				case paper_size
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 1 THEN 6.67
				end as papersize,
				case avail_public
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as availpublic,
				case pack_content
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as packcontent,
				case avail_req
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as availreq,
				case avail_req1
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as availreq1,
				case avail_req2
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as availreq2,
				case avail_req3
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as availreq3,
				case avail_req4
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as availreq4,
				case avail_req5
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as availreq5,
				case avail_req6
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as availreq6,
				case guidance
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as guidance,
				case avail_online
					WHEN 5 THEN 100.00
					WHEN 1 THEN 6.67
				end as availonline,
				case sbirs_assessment
					WHEN 1 THEN 100.00
					WHEN 4 THEN 0.00
				end as sirsassessment,
				case self_assessment
					WHEN 4 THEN 100.00
					WHEN 2 THEN 16.67
					WHEN 1 THEN 8.33
					WHEN 0 THEN 0.00
				end as selfassessment,
				case self_assesscover
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as selfassesscover,
				case self_assesscover1
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as selfassesscover1,
				case self_assesscover2
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as selfassesscover2,
				case self_assesscover3
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as selfassesscover3,
				case desk_guide
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as deskguide,
				case object_right
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as objectright,
				case doc_appeal
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as docappeal,
				case referred
					WHEN 1 THEN 8.33
					WHEN 2 THEN 16.67
					WHEN 4 THEN 66.67
					WHEN 6 THEN 100.00
				end as referred,
				case central_platform
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as centralplatform,
				case auto_platform
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as autoplatform,
				case online_acc
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as onlineacc,
				case realtime_acc
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as realtimeacc,
				case use_consultant
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as useconsultant,
				case tax_agent
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as taxagent,
				case exclu_agent
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as excluagent,
				case govt_dept
					WHEN 2 THEN 100.00
					WHEN 1 THEN 100.00
				end as govtdept,
				case sbircollect_lg
					WHEN 3 THEN 100.00
					WHEN 1 THEN 100.00
				end as sbircollectlg,
				case all_cases
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as allcases,
				case payment_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as paymentaudit,
				case a2013_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as audit2013,
				case a2014_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as audit2014,
				case a2015_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as audit2015,
				case rev_dept
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as revdept,
				case revdept_diff
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as revdeptdiff,
				case taxpayer_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as taxpayeraudit,
				case last_conducted
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 1 THEN 0.00
				end as lastconducted,
				case working_cases
					WHEN 1 THEN 5.56
					WHEN 2 THEN 11.11
					WHEN 4 THEN 44.44
					WHEN 6 THEN 100.00
				end as workingcases,
				case concluded_cases
					WHEN 1 THEN 5.56
					WHEN 2 THEN 11.11
					WHEN 4 THEN 44.44
					WHEN 6 THEN 100.00
				end as concludedcases,
				case hnwi_unit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as hnwiunit,
				case hnwi_id
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as hnwiid,
				case hnwi_action
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as hnwiaction,
				case agency_coop
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as agencycoop,
				case tin_tcc
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as tintcc,
				case debt_enforce
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as debtenforce,
				case agent_involve
					WHEN 4 THEN 100.00
					WHEN 1 THEN 75.00
				end as agentinvolve,
				case court_enforce
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as courtenforce,
				case action_num
					WHEN 1 THEN 5.56
					WHEN 2 THEN 11.11
					WHEN 4 THEN 44.44
					WHEN 6 THEN 100.00
				end as actionnum,
				case taxpayer_aware
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
					WHEN 2 THEN 16.67
				end as taxpayeraware,
				case tax_edu
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxedu,
				case tax_edu1
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxedu1,
				case tax_edu2
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxedu2,
				case tax_edu3
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxedu3,
				case tax_edu4
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxedu4,
				case tax_edu5
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxedu5,
				case igr_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as igreffect,
				case tin_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as tineffect,
				case tat_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as tateffect,
				case complaint_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as complainteffect,
				case servicom
					WHEN 3 THEN 100.00
					WHEN 1 THEN 11.11
				end as servicom,
				case complaint_num
					WHEN 1 THEN 6.67
					WHEN 2 THEN 26.67
					WHEN 5 THEN 100.00
				end as complaintnum,
				case process_num
					WHEN 1 THEN 6.67
					WHEN 2 THEN 26.67
					WHEN 5 THEN 100.00
				end as processnum,
				case process_timetcc
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 2 THEN 33.33
					WHEN 1 THEN 8.33
				end as processtimetcc,
				case sjtb_functioning
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as sjtbfunctioning,
				case num_timemet
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 2 THEN 33.33
					WHEN 1 THEN 8.33
				end as numtimemet,
				users.state, state.stateName, num_offices, internet, zone.zoneName, 
				case standardrpt_format
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as standardrptformat,
				case nature_por
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as naturepor,
				case cap_cost_cov
					WHEN 5 THEN 100.00
					WHEN 3 THEN 40.00
					WHEN 2 THEN 13.33
					WHEN 1 THEN 6.67
				end as capcostcov,
				case perform_app
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as performapp,
				case how_often
					WHEN 3 THEN 100.00
					WHEN 2 THEN 44.44
					WHEN 1 THEN 11.11
				end as howoften,
				case alter_target
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as altertarget,
				case function_website
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as functionwebsite,
				case tax_guide
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as taxguide,
				case tax_ret_form
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as taxretform,
				case tax_calc
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as taxcalc,
				case tax_reg_pack
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as taxregpack,
				case field_off_add
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as fieldoffadd,
				case contact_help
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as contacthelp,
				case collate_mda_levies
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as collatemdalevies,
				case collate_lga_levies
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as collatelgalevies,
				case collect_by_agent
					WHEN 1 THEN 0.00
					WHEN 3 THEN 100.00
				end as collectbyagent,
				case sbircollect_mda
					WHEN 3 THEN 100.00
					WHEN 1 THEN 11.11
				end as sbircollectmda,
				case conext_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as conextaudit,
				case a2013_extaudit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as 2013extaudit,
				case a2014_extaudit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as 2014extaudit,
				case a2015_extaudit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as 2015extaudit,
				case trained_auditor
					WHEN 2 THEN 13.33
					WHEN 3 THEN 40.00
					WHEN 5 THEN 100.00
				end as trainedauditor,
				case vaids_unit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as vaidsunit,
				case vaid_staff
					WHEN 1 THEN 8.33
					WHEN 3 THEN 50.00
					WHEN 4 THEN 100.00
				end as vaidstaff,
				case nature_por1
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as naturepor1,
				case nature_por2
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as naturepor2,
				case nature_por3
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as naturepor3,
				case nature_por4
					WHEN 1 THEN 1
					WHEN 0 THEN 0
				end as naturepor4
FROM state, survey, users, zone WHERE state.stateName = users.state AND survey.quarter = '" . $quarter . "' AND survey.year = '2017' AND zone.zoneId = '" . $zone . "' AND zone.zoneId = state.zoneId AND users.username = survey.mysession ORDER BY state.stateName";

$result=mysqli_query($link, $sq10); 
if($result === FALSE) { 
    die(mysqli_error($link)); // TODO: better error handling
}


			  
			  $rank = 0;
  $last_score = false;
  $rows = 0;
  
 
  
              $states =  array();
			  $taxAdminscores10 = array();

?>      
		  <?php		  			  
			  
			
			
			 while($rs10=mysqli_fetch_array($result,MYSQLI_NUM)){
			    //while($rs10=mysqli_fetch_array($sq10)){
				  
				  $rows++;
				
		$sbirsmeet=$rs10[0]; 
		$sbirspolicy=$rs10[1];
		$sbirsgov=$rs10[2];
		$sbirsscf=$rs10[3];
		$sbirssha=$rs10[4];
		$sbirschair=$rs10[5];
		$naturepor=$rs10[113];
		$naturepor1=$rs10[136];
		$naturepor2=$rs10[137];
		$naturepor3=$rs10[138];
		$naturepor4=$rs10[139];
		$natureporall=(($naturepor + $naturepor1 + $naturepor2 + $naturepor3 + $naturepor4)/9)*100;
		$orginstave=($sbirsmeet + $sbirspolicy + $sbirsgov + $sbirsscf + $sbirssha + $sbirschair + $natureporall)/7;
		$sbirsis=$rs10[6];
		$sbirsfund=$rs10[7];
		$sbirscost=$rs10[8];
		$capcostcov=$rs10[114];
		$budgetavailability=($sbirsis + $sbirsfund + $sbirscost + $capcostcov)/4;
		$sbirsemp=$rs10[9];
		$taxstaff=$rs10[10];
		$capacitybuilding=$rs10[11];
		$attendedtraining=$rs10[12];
		$traininprogram=$rs10[13];
		$salstructure=$rs10[14];
		$payscheme=$rs10[15];
		$contractstaff=$rs10[16];
		$performapp=$rs10[115];
		$howoften=$rs10[116];
		$remuneration=($sbirsemp + $taxstaff + $capacitybuilding + $attendedtraining + $traininprogram + $salstructure + $payscheme + $contractstaff + $performapp + $howoften)/10;
		$numoffices=$rs10[109];
		$internet=$rs10[110];
		$zonenum=$rs10[17];
		$fullit=$rs10[18];
		$partialit=$rs10[19];
		$noict=$rs10[20];
		$techstaff=$rs10[21];
		$fullits=@($fullit/$numoffices)*100;
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
		$partialits=@($partialit/$numoffices)*100;
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
		$noicts=@($noict/$numoffices)*100;
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
		$techstaffs=@($techstaff/$numoffices)*100;
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
		$internets=@($internet/$numoffices)*100;
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
		$fieldreport=$rs10[22];
		$fieldreport1=$rs10[23];
		$fieldreport2=$rs10[24];
		$fieldreport3=$rs10[25];
		$fieldreport4=$rs10[26];
		$highest_fieldreport = max($fieldreport, $fieldreport1, $fieldreport2, $fieldreport3, $fieldreport4);
		$reportmethod=$rs10[27];
		$standardrptformat=$rs10[112];
		$altertarget=$rs10[117];
		$functionwebsite=$rs10[118];
		$taxguide=$rs10[119];
		$taxretform=$rs10[120];
		$taxcalc=$rs10[121];
		$taxregpack=$rs10[122];
		$fieldoffadd=$rs10[123];
		$contacthelp=$rs10[124];
		$websitestuff=(($taxguide + $taxretform + $taxcalc + $taxregpack + $fieldoffadd + $contacthelp)/12)*100;
		$outreach=($zonenum + $highest_ict + $techstaffs + $internets + $highest_fieldreport + $reportmethod + $standardrptformat + $altertarget + $functionwebsite + $websitestuff)/10;
		$taxadmin=($orginstave + $budgetavailability + $remuneration + $outreach)/4; 
		$showme=$rs10[107];
		
		//Modified Code by Coker
		$states[$rows]=$rs10[108];
		//var_dump($rs10);
		$taxAdminscores10[$states[$rows]] = $taxadmin;
	 }
	 
	 
	 
	 //Modified Code Coker
         $ranking = getRank($states,$taxAdminscores10);
		  
		   for($i= 1; $i <= $rows; $i++)
           {
          
		   }

//tax procedure
$link = mysqli_connect("localhost", "nggovern_Garki", "NgfBassi1!", "nggovern_dashboard");
if(mysqli_errno($link))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
    mysqli_query($link, "SET SQL_BIG_SELECTS=1");
$sq10 ="SELECT 
				case sbirs_meet
					WHEN 4 THEN 53.33
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 2 THEN 0.00
					WHEN 1 THEN 0.00
				end as sbirsmeet, 
				case sbirs_policy
					WHEN 2 THEN 22.22
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as sbirspolicy, 
				case sbirs_gov
					WHEN 5 THEN 100.00
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 2 THEN 25.00
					WHEN 1 THEN 0.00
				end as sbirsgov, 
				case sbirs_scf
					WHEN 5 THEN 100.00
					WHEN 4 THEN 53.33
					WHEN 3 THEN 20.00
					WHEN 2 THEN 0.00
					WHEN 1 THEN 0.00
				end as sbirsscf, 
				case sbirs_sha
					WHEN 5 THEN 0.00
					WHEN 2 THEN 25.33
					WHEN 3 THEN 37.50
					WHEN 4 THEN 100.00
					WHEN 1 THEN 25.00
					WHEN 0 THEN 0.00
				end as sbirssha, 
				case sbirs_chair
					WHEN 2 THEN 100.00
					WHEN 1 THEN 0.00
				end as sbirschair,
				case sbirs_is
					WHEN 3 THEN 100.00
					WHEN 2 THEN 44.44
					WHEN 1 THEN 0.00
				end as sbirsis,
				case sbirs_fund
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 2 THEN 13.33
					WHEN 4 THEN 53.33
				end as sbirsfund,
				case sbirs_cost
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
					WHEN 2 THEN 22.22
				end as sbirscost,
				case sbirs_emp
					WHEN 1 THEN 0.00
					WHEN 2 THEN 16.67
					WHEN 3 THEN 75.00
					WHEN 4 THEN 100.00
					WHEN 6 THEN 150.00
				end as sbirsemp,
				case tax_staff
					WHEN 1 THEN 0.00
					WHEN 2 THEN 26.67
					WHEN 3 THEN 40.00
					WHEN 4 THEN 80.00
					WHEN 6 THEN 100.00
				end as taxstaff,
				case capacity_building
					WHEN 4 THEN 100.00
					WHEN 3 THEN 50.00
					WHEN 2 THEN 16.67
					WHEN 1 THEN 0.00
				end as capacitybuilding,
				case attended_training
					WHEN 3 THEN 100.00
					WHEN 2 THEN 44.44
					WHEN 1 THEN 11.11
				end as attendedtraining,
				case trainin_program
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 0 THEN 0.00
				end as traininprogram,
				case sal_structure
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as salstructure,
				case pay_scheme
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as payscheme,
				case contract_staff
					WHEN 1 THEN 22.22
					WHEN 3 THEN 100.00
				end as contractstaff,
				case zone_num
					WHEN 4 THEN 100.00
					WHEN 3 THEN 50.00
					WHEN 2 THEN 16.67
					WHEN 1 THEN 0.00
				end as zonenum,
				 full_ict,
				 partial_ict,
				 no_ict,
				 tech_staff,
				case field_report
					WHEN 4 THEN 100.00
					WHEN NULL THEN 0.00
				end as fieldreport,
				case field_report1
					WHEN 4 THEN 100.00
					WHEN NULL THEN 0.00
				end as fieldreport1,
				case field_report2
					WHEN 3 THEN 50.00
					WHEN NULL THEN 0.00
				end as fieldreport2,
				case field_report3
					WHEN 2 THEN 16.67
					WHEN NULL THEN 0.00
				end as fieldreport3,
				case field_report4
					WHEN 1 THEN 0.00
					WHEN NULL THEN 0.00
				end as fieldreport4,
				case report_method
					WHEN 3 THEN 66.67
					WHEN 2 THEN 22.22
					WHEN 3 THEN 100.00
				end as reportmethod,
				case tin_captured
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as tindatabase,
				case make_assess
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as makeassess,
				case taxpayer_engage
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as taxpayerengage,
				case target_setting
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as targetsetting,
				case pit_rates
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as pitrates,
				case validity
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as validity,
				case have_tin
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as havetin,
				case reg_pack
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as regpack,
				case new_tax
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as newtax,
				case num_page
					WHEN 6 THEN 100.00
					WHEN 5 THEN 83.33
					WHEN 4 THEN 44.44
					WHEN 2 THEN 11.11
					WHEN 1 THEN 5.56
					WHEN 0 THEN 0.00
					WHEN 0 THEN 0.00
				end as numpage,
				case standard_form
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as standardform,
				case paper_size
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 1 THEN 6.67
				end as papersize,
				case avail_public
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as availpublic,
				case pack_content
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as packcontent,
				case avail_req
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq,
				case avail_req1
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq1,
				case avail_req2
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq2,
				case avail_req3
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq3,
				case avail_req4
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq4,
				case avail_req5
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq5,
				case avail_req6
					WHEN 1 THEN 1
					WHEN 0 THEN 0
				end as availreq6,
				case guidance
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as guidance,
				case avail_online
					WHEN 5 THEN 100.00
					WHEN 1 THEN 6.67
				end as availonline,
				case sbirs_assessment
					WHEN 1 THEN 100.00
					WHEN 4 THEN 0.00
				end as sirsassessment,
				case self_assessment
					WHEN 4 THEN 100.00
					WHEN 2 THEN 16.67
					WHEN 1 THEN 8.33
					WHEN 0 THEN 0.00
				end as selfassessment,
				case self_assesscover
					WHEN 1 THEN 3
					WHEN NULL THEN 0
				end as selfassesscover,
				case self_assesscover1
					WHEN 1 THEN 3
					WHEN NULL THEN 0
				end as selfassesscover1,
				case self_assesscover2
					WHEN 1 THEN 3
					WHEN NULL THEN 0
				end as selfassesscover2,
				case self_assesscover3
					WHEN 1 THEN 3
					WHEN NULL THEN 0
				end as selfassesscover3,
				case desk_guide
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as deskguide,
				case object_right
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as objectright,
				case doc_appeal
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as docappeal,
				case referred
					WHEN 1 THEN 8.33
					WHEN 2 THEN 16.67
					WHEN 4 THEN 66.67
					WHEN 6 THEN 100.00
				end as referred,
				case central_platform
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as centralplatform,
				case auto_platform
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as autoplatform,
				case online_acc
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as onlineacc,
				case realtime_acc
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as realtimeacc,
				case use_consultant
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as useconsultant,
				case tax_agent
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as taxagent,
				case exclu_agent
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as excluagent,
				case govt_dept
					WHEN 2 THEN 100.00
					WHEN 1 THEN 100.00
				end as govtdept,
				case sbircollect_lg
					WHEN 3 THEN 100.00
					WHEN 1 THEN 100.00
				end as sbircollectlg,
				case all_cases
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as allcases,
				case payment_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as paymentaudit,
				case a2013_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as audit2013,
				case a2014_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as audit2014,
				case a2015_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as audit2015,
				case rev_dept
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as revdept,
				case revdept_diff
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as revdeptdiff,
				case taxpayer_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as taxpayeraudit,
				case last_conducted
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 1 THEN 0.00
				end as lastconducted,
				case working_cases
					WHEN 1 THEN 5.56
					WHEN 2 THEN 11.11
					WHEN 4 THEN 44.44
					WHEN 6 THEN 100.00
				end as workingcases,
				case concluded_cases
					WHEN 1 THEN 5.56
					WHEN 2 THEN 11.11
					WHEN 4 THEN 44.44
					WHEN 6 THEN 100.00
				end as concludedcases,
				case hnwi_unit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as hnwiunit,
				case hnwi_id
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as hnwiid,
				case hnwi_action
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as hnwiaction,
				case agency_coop
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as agencycoop,
				case tin_tcc
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as tintcc,
				case debt_enforce
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as debtenforce,
				case agent_involve
					WHEN 4 THEN 100.00
					WHEN 1 THEN 75.00
				end as agentinvolve,
				case court_enforce
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as courtenforce,
				case action_num
					WHEN 1 THEN 5.56
					WHEN 2 THEN 11.11
					WHEN 4 THEN 44.44
					WHEN 6 THEN 100.00
				end as actionnum,
				case taxpayer_aware
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
					WHEN 2 THEN 16.67
				end as taxpayeraware,
				case tax_edu
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxedu,
				case tax_edu1
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxedu1,
				case tax_edu2
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxedu2,
				case tax_edu3
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxedu3,
				case tax_edu4
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxedu4,
				case tax_edu5
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxedu5,
				case igr_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as igreffect,
				case tin_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as tineffect,
				case tat_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as tateffect,
				case complaint_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as complainteffect,
				case servicom
					WHEN 3 THEN 100.00
					WHEN 1 THEN 11.11
				end as servicom,
				case complaint_num
					WHEN 1 THEN 6.67
					WHEN 2 THEN 26.67
					WHEN 5 THEN 100.00
				end as complaintnum,
				case process_num
					WHEN 1 THEN 6.67
					WHEN 2 THEN 26.67
					WHEN 5 THEN 100.00
				end as processnum,
				case process_timetcc
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 2 THEN 33.33
					WHEN 1 THEN 8.33
				end as processtimetcc,
				case sjtb_functioning
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as sjtbfunctioning,
				case num_timemet
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 2 THEN 33.33
					WHEN 1 THEN 8.33
				end as numtimemet,
				users.state, state.stateName, num_offices, internet, zone.zoneName, 
				case standardrpt_format
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as standardrptformat,
				case nature_por
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as naturepor,
				case cap_cost_cov
					WHEN 5 THEN 100.00
					WHEN 3 THEN 40.00
					WHEN 2 THEN 13.33
					WHEN 1 THEN 6.67
				end as capcostcov,
				case perform_app
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as performapp,
				case how_often
					WHEN 3 THEN 100.00
					WHEN 2 THEN 44.44
					WHEN 1 THEN 11.11
				end as howoften,
				case alter_target
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as altertarget,
				case function_website
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as functionwebsite,
				case tax_guide
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxguide,
				case tax_ret_form
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxretform,
				case tax_calc
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxcalc,
				case tax_reg_pack
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxregpack,
				case field_off_add
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as fieldoffadd,
				case contact_help
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as contacthelp,
				case collate_mda_levies
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as collatemdalevies,
				case collate_lga_levies
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as collatelgalevies,
				case collect_by_agent
					WHEN 1 THEN 0.00
					WHEN 3 THEN 100.00
				end as collectbyagent,
				case sbircollect_mda
					WHEN 3 THEN 100.00
					WHEN 1 THEN 11.11
				end as sbircollectmda,
				case conext_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as conextaudit,
				case a2013_extaudit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as 2013extaudit,
				case a2014_extaudit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as 2014extaudit,
				case a2015_extaudit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as 2015extaudit,
				case trained_auditor
					WHEN 2 THEN 13.33
					WHEN 3 THEN 40.00
					WHEN 5 THEN 100.00
				end as trainedauditor,
				case vaids_unit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as vaidsunit,
				case vaid_staff
					WHEN 1 THEN 8.33
					WHEN 3 THEN 50.00
					WHEN 4 THEN 100.00
				end as vaidstaff
FROM state, survey1, users, zone WHERE state.stateName = users.state AND survey1.quarter = '" . $quarter . "' AND survey1.year = '2017' AND zone.zoneId = '" . $zone . "' AND zone.zoneId = state.zoneId AND users.username = survey1.mysession ORDER BY state.stateName";
$result=mysqli_query($link, $sq10); 
if($result === FALSE) { 
    die(mysqli_error($link)); // TODO: better error handling
}
	?>
	
	<?php	
	
	$rank = 0;
  $last_score = false;
  $rows = 0;
  
              $states =  array();
			  $taxProcscores10 = array();
	
//}
?>
		
		  <?php
while($rs10=mysqli_fetch_array($result,MYSQLI_NUM)){
    //while($rs10=mysqli_fetch_array($sq10)) {
	
	$rows++;
	
		$tindatabase=$rs10[28];
		$makeassess=$rs10[29];
		$taxpayerengage=$rs10[30];
		$targetsetting=$rs10[31];
		$pitrates=$rs10[32];
		$havetin=$rs10[34];
		$regpack=$rs10[35];
		$newtax=$rs10[36];
		$numpage=$rs10[37];
		$standardform=$rs10[38];
		$papersize=$rs10[39];
		$availpublic=$rs10[40];
		$packcontent=$rs10[41];
		$availreq=$rs10[42];
		$availreq1=$rs10[43];
		$availreq2=$rs10[44];
		$availreq3=$rs10[45];
		$availreq4=$rs10[46];
		$availreq5=$rs10[47];
		$availreq6=$rs10[48];
		$availreqall=(($availreq + $availreq1 + $availreq2 + $availreq3 + $availreq4 + $availreq5 + $availreq6)/13)*100;
		$guidance=$rs10[49];
		$availonline=$rs10[50];
		$taxregtin=($tindatabase + $makeassess + $taxpayerengage + $targetsetting + $pitrates + $havetin + $regpack + $newtax + $numpage + $standardform + $papersize + $availpublic + $packcontent + $availreqall + $guidance + $availonline)/16;
		$sirsassessment=$rs10[51];
		$selfassessment=$rs10[52];
		$selfassesscover=$rs10[53];
		$selfassesscover1=$rs10[54];
		$selfassesscover2=$rs10[55];
		$selfassesscover3=$rs10[56];
		$selfassesscoverall=(($selfassesscover + $selfassesscover1 + $selfassesscover2 + $selfassesscover3)/12)*100;
		$deskguide=$rs10[57];
		$objectright=$rs10[58];
		$docappeal=$rs10[59];
		$referred=$rs10[60];
		$validity=$rs10[33];
		$taxefficient=($sirsassessment + $selfassessment + $selfassesscoverall + $deskguide + $objectright + $docappeal + $referred + $validity)/8;
		$taxprocedure=($taxregtin + $taxefficient)/2;
		$showme=$rs10[107];
		$states[$rows]=$rs10[108];
		$taxProcscores10[$states[$rows]] = $taxprocedure;
			  }
           ?>
               
    <?php
		
   // }
		
		$ranking = getRank($states,$taxProcscores10);
		  
		   for($i= 1; $i <= $rows; $i++)
           {
		
		   }

//tax processiong
$link = mysqli_connect("localhost", "nggovern_Garki", "NgfBassi1!", "nggovern_dashboard");
if(mysqli_errno($link))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
    mysqli_query($link, "SET SQL_BIG_SELECTS=1");
		$sq10 ="SELECT 
				case sbirs_meet
					WHEN 4 THEN 53.33
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 2 THEN 0.00
					WHEN 1 THEN 0.00
				end as sbirsmeet, 
				case sbirs_policy
					WHEN 2 THEN 22.22
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as sbirspolicy, 
				case sbirs_gov
					WHEN 5 THEN 100.00
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 2 THEN 25.00
					WHEN 1 THEN 0.00
				end as sbirsgov, 
				case sbirs_scf
					WHEN 5 THEN 100.00
					WHEN 4 THEN 53.33
					WHEN 3 THEN 20.00
					WHEN 2 THEN 0.00
					WHEN 1 THEN 0.00
				end as sbirsscf, 
				case sbirs_sha
					WHEN 5 THEN 0.00
					WHEN 2 THEN 25.33
					WHEN 3 THEN 37.50
					WHEN 4 THEN 100.00
					WHEN 1 THEN 25.00
					WHEN 0 THEN 0.00
				end as sbirssha, 
				case sbirs_chair
					WHEN 2 THEN 100.00
					WHEN 1 THEN 0.00
				end as sbirschair,
				case sbirs_is
					WHEN 3 THEN 100.00
					WHEN 2 THEN 44.44
					WHEN 1 THEN 0.00
				end as sbirsis,
				case sbirs_fund
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 2 THEN 13.33
					WHEN 4 THEN 53.33
				end as sbirsfund,
				case sbirs_cost
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
					WHEN 2 THEN 22.22
				end as sbirscost,
				case sbirs_emp
					WHEN 1 THEN 0.00
					WHEN 2 THEN 16.67
					WHEN 3 THEN 75.00
					WHEN 4 THEN 100.00
					WHEN 6 THEN 150.00
				end as sbirsemp,
				case tax_staff
					WHEN 1 THEN 0.00
					WHEN 2 THEN 26.67
					WHEN 3 THEN 40.00
					WHEN 4 THEN 80.00
					WHEN 6 THEN 100.00
				end as taxstaff,
				case capacity_building
					WHEN 4 THEN 100.00
					WHEN 3 THEN 50.00
					WHEN 2 THEN 16.67
					WHEN 1 THEN 0.00
				end as capacitybuilding,
				case attended_training
					WHEN 3 THEN 100.00
					WHEN 2 THEN 44.44
					WHEN 1 THEN 11.11
				end as attendedtraining,
				case trainin_program
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 0 THEN 0.00
				end as traininprogram,
				case sal_structure
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as salstructure,
				case pay_scheme
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as payscheme,
				case contract_staff
					WHEN 1 THEN 22.22
					WHEN 3 THEN 100.00
				end as contractstaff,
				case zone_num
					WHEN 4 THEN 100.00
					WHEN 3 THEN 50.00
					WHEN 2 THEN 16.67
					WHEN 1 THEN 0.00
				end as zonenum,
				 full_ict,
				 partial_ict,
				 no_ict,
				 tech_staff,
				case field_report
					WHEN 4 THEN 100.00
					WHEN NULL THEN 0.00
				end as fieldreport,
				case field_report1
					WHEN 4 THEN 100.00
					WHEN NULL THEN 0.00
				end as fieldreport1,
				case field_report2
					WHEN 3 THEN 50.00
					WHEN NULL THEN 0.00
				end as fieldreport2,
				case field_report3
					WHEN 2 THEN 16.67
					WHEN NULL THEN 0.00
				end as fieldreport3,
				case field_report4
					WHEN 1 THEN 0.00
					WHEN NULL THEN 0.00
				end as fieldreport4,
				case report_method
					WHEN 3 THEN 66.67
					WHEN 2 THEN 22.22
					WHEN 3 THEN 100.00
				end as reportmethod,
				case tin_captured
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as tindatabase,
				case make_assess
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as makeassess,
				case taxpayer_engage
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as taxpayerengage,
				case target_setting
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as targetsetting,
				case pit_rates
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as pitrates,
				case validity
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as validity,
				case have_tin
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as havetin,
				case reg_pack
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as regpack,
				case new_tax
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as newtax,
				case num_page
					WHEN 6 THEN 100.00
					WHEN 5 THEN 83.33
					WHEN 4 THEN 44.44
					WHEN 2 THEN 11.11
					WHEN 1 THEN 5.56
					WHEN 0 THEN 0.00
					WHEN 0 THEN 0.00
				end as numpage,
				case standard_form
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as standardform,
				case paper_size
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 1 THEN 6.67
				end as papersize,
				case avail_public
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as availpublic,
				case pack_content
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as packcontent,
				case avail_req
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq,
				case avail_req1
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq1,
				case avail_req2
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq2,
				case avail_req3
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq3,
				case avail_req4
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq4,
				case avail_req5
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq5,
				case avail_req6
					WHEN 1 THEN 1
					WHEN 0 THEN 0
				end as availreq6,
				case guidance
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as guidance,
				case avail_online
					WHEN 5 THEN 100.00
					WHEN 1 THEN 6.67
				end as availonline,
				case sbirs_assessment
					WHEN 1 THEN 100.00
					WHEN 4 THEN 0.00
				end as sirsassessment,
				case self_assessment
					WHEN 4 THEN 100.00
					WHEN 2 THEN 16.67
					WHEN 1 THEN 8.33
					WHEN 0 THEN 0.00
				end as selfassessment,
				case self_assesscover
					WHEN 1 THEN 3
					WHEN 0 THEN 0
				end as selfassesscover,
				case self_assesscover1
					WHEN 1 THEN 3
					WHEN 0 THEN 0
				end as selfassesscover1,
				case self_assesscover2
					WHEN 1 THEN 3
					WHEN 0 THEN 0
				end as selfassesscover2,
				case self_assesscover3
					WHEN 1 THEN 3
					WHEN 0 THEN 0
				end as selfassesscover3,
				case desk_guide
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as deskguide,
				case object_right
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as objectright,
				case doc_appeal
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as docappeal,
				case referred
					WHEN 1 THEN 8.33
					WHEN 2 THEN 16.67
					WHEN 4 THEN 66.67
					WHEN 6 THEN 100.00
				end as referred,
				case central_platform
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as centralplatform,
				case auto_platform
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as autoplatform,
				case online_acc
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as onlineacc,
				case realtime_acc
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as realtimeacc,
				case use_consultant
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as useconsultant,
				case tax_agent
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as taxagent,
				case exclu_agent
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as excluagent,
				case govt_dept
					WHEN 2 THEN 100.00
					WHEN 1 THEN 100.00
				end as govtdept,
				case sbircollect_lg
					WHEN 3 THEN 100.00
					WHEN 1 THEN 100.00
				end as sbircollectlg,
				case all_cases
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as allcases,
				case payment_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as paymentaudit,
				case a2013_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as audit2013,
				case a2014_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as audit2014,
				case a2015_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as audit2015,
				case rev_dept
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as revdept,
				case revdept_diff
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as revdeptdiff,
				case taxpayer_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as taxpayeraudit,
				case last_conducted
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 1 THEN 0.00
				end as lastconducted,
				case working_cases
					WHEN 1 THEN 5.56
					WHEN 2 THEN 11.11
					WHEN 4 THEN 44.44
					WHEN 6 THEN 100.00
				end as workingcases,
				case concluded_cases
					WHEN 1 THEN 5.56
					WHEN 2 THEN 11.11
					WHEN 4 THEN 44.44
					WHEN 6 THEN 100.00
				end as concludedcases,
				case hnwi_unit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as hnwiunit,
				case hnwi_id
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as hnwiid,
				case hnwi_action
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as hnwiaction,
				case agency_coop
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as agencycoop,
				case tin_tcc
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as tintcc,
				case debt_enforce
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as debtenforce,
				case agent_involve
					WHEN 4 THEN 100.00
					WHEN 1 THEN 75.00
				end as agentinvolve,
				case court_enforce
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as courtenforce,
				case action_num
					WHEN 1 THEN 5.56
					WHEN 2 THEN 11.11
					WHEN 4 THEN 44.44
					WHEN 6 THEN 100.00
				end as actionnum,
				case taxpayer_aware
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
					WHEN 2 THEN 16.67
				end as taxpayeraware,
				case tax_edu
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxedu,
				case tax_edu1
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxedu1,
				case tax_edu2
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxedu2,
				case tax_edu3
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxedu3,
				case tax_edu4
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxedu4,
				case tax_edu5
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxedu5,
				case igr_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as igreffect,
				case tin_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as tineffect,
				case tat_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as tateffect,
				case complaint_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as complainteffect,
				case servicom
					WHEN 3 THEN 100.00
					WHEN 1 THEN 11.11
				end as servicom,
				case complaint_num
					WHEN 1 THEN 6.67
					WHEN 2 THEN 26.67
					WHEN 5 THEN 100.00
				end as complaintnum,
				case process_num
					WHEN 1 THEN 6.67
					WHEN 2 THEN 26.67
					WHEN 5 THEN 100.00
				end as processnum,
				case process_timetcc
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 2 THEN 33.33
					WHEN 1 THEN 8.33
				end as processtimetcc,
				case sjtb_functioning
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as sjtbfunctioning,
				case num_timemet
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 2 THEN 33.33
					WHEN 1 THEN 8.33
				end as numtimemet,
				users.state, state.stateName, num_offices, internet, zone.zoneName, 
				case standardrpt_format
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as standardrptformat,
				case nature_por
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as naturepor,
				case cap_cost_cov
					WHEN 5 THEN 100.00
					WHEN 3 THEN 40.00
					WHEN 2 THEN 13.33
					WHEN 1 THEN 6.67
				end as capcostcov,
				case perform_app
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as performapp,
				case how_often
					WHEN 3 THEN 100.00
					WHEN 2 THEN 44.44
					WHEN 1 THEN 11.11
				end as howoften,
				case alter_target
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as altertarget,
				case function_website
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as functionwebsite,
				case tax_guide
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxguide,
				case tax_ret_form
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxretform,
				case tax_calc
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxcalc,
				case tax_reg_pack
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxregpack,
				case field_off_add
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as fieldoffadd,
				case contact_help
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as contacthelp,
				case collate_mda_levies
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as collatemdalevies,
				case collate_lga_levies
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as collatelgalevies,
				case collect_by_agent
					WHEN 1 THEN 0.00
					WHEN 3 THEN 100.00
				end as collectbyagent,
				case sbircollect_mda
					WHEN 3 THEN 100.00
					WHEN 1 THEN 11.11
				end as sbircollectmda,
				case conext_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as conextaudit,
				case a2013_extaudit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as 2013extaudit,
				case a2014_extaudit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as 2014extaudit,
				case a2015_extaudit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as 2015extaudit,
				case trained_auditor
					WHEN 2 THEN 13.33
					WHEN 3 THEN 40.00
					WHEN 5 THEN 100.00
				end as trainedauditor,
				case vaids_unit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as vaidsunit,
				case vaid_staff
					WHEN 1 THEN 8.33
					WHEN 3 THEN 50.00
					WHEN 4 THEN 100.00
				end as vaidstaff
FROM state, survey2, users, zone WHERE state.stateName = users.state AND survey2.quarter = '" . $quarter . "' AND survey2.year = '2017' AND zone.zoneId = '" . $zone . "' AND zone.zoneId = state.zoneId AND users.username = survey2.mysession ORDER BY state.stateName";
$result=mysqli_query($link, $sq10); 
if($result === FALSE) { 
    die(mysqli_error($link)); // TODO: better error handling
}
	?>
	
	<?php	
	
	$rank = 0;
  $last_score = false;
  $rows = 0;
  
              $states =  array();
			  $taxProscores10 = array();
	
//}
?>
		
		  <?php
while($rs10=mysqli_fetch_array($result,MYSQLI_NUM)){
	//while($rs10=mysqli_fetch_array($sq10)) {
	$rows++;
	
		$centralplatform=$rs10[61];
		$autoplatform=$rs10[62];
		$onlineacc=$rs10[63];
		$realtimeacc=$rs10[64];
		$useconsultant=$rs10[65];
		$taxagent=$rs10[66];
		$excluagent=$rs10[67];
		$govtdept=$rs10[68];
		$sbircollectlg=$rs10[69];
		$allcases=$rs10[70];
		$paymentaudit=$rs10[71];
		$audit2013=$rs10[72];
		$audit2014=$rs10[73];
		$audit2015=$rs10[74];
		$revdept=$rs10[75];
		$revdeptdiff=$rs10[76];
		$collatemdalevies=$rs10[125];
		$collatelgalevies=$rs10[126];
		$collectbyagent=$rs10[127];
		$sbircollectmda=$rs10[128];
		$conextaudit=$rs10[129];
		$extaudit2013=$rs10[130];
		$extaudit2014=$rs10[131];
		$extaudit2015=$rs10[132];
		if($useconsultant == 100.00){
    	$taxprocessing=($centralplatform + $autoplatform + $onlineacc + $realtimeacc + $useconsultant + $govtdept + $sbircollectlg + $allcases + $paymentaudit + $audit2013 + $audit2014 + $audit2015 + $revdept + $revdeptdiff + $collatemdalevies + $collatelgalevies + $collectbyagent + $sbircollectmda + $conextaudit + $extaudit2013 + $extaudit2014 + $extaudit2015)/22;
		} else {
		$taxprocessing=($centralplatform + $autoplatform + $onlineacc + $realtimeacc + $useconsultant + $taxagent + $excluagent + $govtdept + $sbircollectlg + $allcases + $paymentaudit + $audit2013 + $audit2014 + $audit2015 + $revdept + $revdeptdiff + $collatemdalevies + $collatelgalevies + $collectbyagent + $sbircollectmda + $conextaudit + $extaudit2013 + $extaudit2014 + $extaudit2015)/24;
		}
		$showme=$rs10[107];
		$states[$rows]=$rs10[108];
		$taxProscores10[$states[$rows]] = $taxprocessing;
			  }
           ?>
               
    <?php
		
   // }
		
		$ranking = getRank($states,$taxProscores10);
		  
		   for($i= 1; $i <= $rows; $i++)
           {
		
		   }

//tax enforcement
$link = mysqli_connect("localhost", "nggovern_Garki", "NgfBassi1!", "nggovern_dashboard");
if(mysqli_errno($link))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
    mysqli_query($link, "SET SQL_BIG_SELECTS=1");
$sq10 ="SELECT 
				case sbirs_meet
					WHEN 4 THEN 53.33
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 2 THEN 0.00
					WHEN 1 THEN 0.00
				end as sbirsmeet, 
				case sbirs_policy
					WHEN 2 THEN 22.22
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as sbirspolicy, 
				case sbirs_gov
					WHEN 5 THEN 100.00
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 2 THEN 25.00
					WHEN 1 THEN 0.00
				end as sbirsgov, 
				case sbirs_scf
					WHEN 5 THEN 100.00
					WHEN 4 THEN 53.33
					WHEN 3 THEN 20.00
					WHEN 2 THEN 0.00
					WHEN 1 THEN 0.00
				end as sbirsscf, 
				case sbirs_sha
					WHEN 5 THEN 0.00
					WHEN 2 THEN 25.33
					WHEN 3 THEN 37.50
					WHEN 4 THEN 100.00
					WHEN 1 THEN 25.00
					WHEN 0 THEN 0.00
				end as sbirssha, 
				case sbirs_chair
					WHEN 2 THEN 100.00
					WHEN 1 THEN 0.00
				end as sbirschair,
				case sbirs_is
					WHEN 3 THEN 100.00
					WHEN 2 THEN 44.44
					WHEN 1 THEN 0.00
				end as sbirsis,
				case sbirs_fund
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 2 THEN 13.33
					WHEN 4 THEN 53.33
				end as sbirsfund,
				case sbirs_cost
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
					WHEN 2 THEN 22.22
				end as sbirscost,
				case sbirs_emp
					WHEN 1 THEN 0.00
					WHEN 2 THEN 16.67
					WHEN 3 THEN 75.00
					WHEN 4 THEN 100.00
					WHEN 6 THEN 150.00
				end as sbirsemp,
				case tax_staff
					WHEN 1 THEN 0.00
					WHEN 2 THEN 26.67
					WHEN 3 THEN 40.00
					WHEN 4 THEN 80.00
					WHEN 6 THEN 100.00
				end as taxstaff,
				case capacity_building
					WHEN 4 THEN 100.00
					WHEN 3 THEN 50.00
					WHEN 2 THEN 16.67
					WHEN 1 THEN 0.00
				end as capacitybuilding,
				case attended_training
					WHEN 3 THEN 100.00
					WHEN 2 THEN 44.44
					WHEN 1 THEN 11.11
				end as attendedtraining,
				case trainin_program
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 0 THEN 0.00
				end as traininprogram,
				case sal_structure
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as salstructure,
				case pay_scheme
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as payscheme,
				case contract_staff
					WHEN 1 THEN 22.22
					WHEN 3 THEN 100.00
				end as contractstaff,
				case zone_num
					WHEN 4 THEN 100.00
					WHEN 3 THEN 50.00
					WHEN 2 THEN 16.67
					WHEN 1 THEN 0.00
				end as zonenum,
				 full_ict,
				 partial_ict,
				 no_ict,
				 tech_staff,
				case field_report
					WHEN 4 THEN 100.00
					WHEN NULL THEN 0.00
				end as fieldreport,
				case field_report1
					WHEN 4 THEN 100.00
					WHEN NULL THEN 0.00
				end as fieldreport1,
				case field_report2
					WHEN 3 THEN 50.00
					WHEN NULL THEN 0.00
				end as fieldreport2,
				case field_report3
					WHEN 2 THEN 16.67
					WHEN NULL THEN 0.00
				end as fieldreport3,
				case field_report4
					WHEN 1 THEN 0.00
					WHEN NULL THEN 0.00
				end as fieldreport4,
				case report_method
					WHEN 3 THEN 66.67
					WHEN 2 THEN 22.22
					WHEN 3 THEN 100.00
				end as reportmethod,
				case tin_captured
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as tindatabase,
				case make_assess
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as makeassess,
				case taxpayer_engage
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as taxpayerengage,
				case target_setting
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as targetsetting,
				case pit_rates
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as pitrates,
				case validity
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as validity,
				case have_tin
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as havetin,
				case reg_pack
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as regpack,
				case new_tax
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as newtax,
				case num_page
					WHEN 6 THEN 100.00
					WHEN 5 THEN 83.33
					WHEN 4 THEN 44.44
					WHEN 2 THEN 11.11
					WHEN 1 THEN 5.56
					WHEN 0 THEN 0.00
					WHEN 0 THEN 0.00
				end as numpage,
				case standard_form
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as standardform,
				case paper_size
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 1 THEN 6.67
				end as papersize,
				case avail_public
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as availpublic,
				case pack_content
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as packcontent,
				case avail_req
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq,
				case avail_req1
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq1,
				case avail_req2
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq2,
				case avail_req3
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq3,
				case avail_req4
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq4,
				case avail_req5
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq5,
				case avail_req6
					WHEN 1 THEN 1
					WHEN 0 THEN 0
				end as availreq6,
				case guidance
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as guidance,
				case avail_online
					WHEN 5 THEN 100.00
					WHEN 1 THEN 6.67
				end as availonline,
				case sbirs_assessment
					WHEN 1 THEN 100.00
					WHEN 4 THEN 0.00
				end as sirsassessment,
				case self_assessment
					WHEN 4 THEN 100.00
					WHEN 2 THEN 16.67
					WHEN 1 THEN 8.33
					WHEN 0 THEN 0.00
				end as selfassessment,
				case self_assesscover
					WHEN 1 THEN 3
					WHEN 0 THEN 0
				end as selfassesscover,
				case self_assesscover1
					WHEN 1 THEN 3
					WHEN 0 THEN 0
				end as selfassesscover1,
				case self_assesscover2
					WHEN 1 THEN 3
					WHEN 0 THEN 0
				end as selfassesscover2,
				case self_assesscover3
					WHEN 1 THEN 3
					WHEN 0 THEN 0
				end as selfassesscover3,
				case desk_guide
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as deskguide,
				case object_right
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as objectright,
				case doc_appeal
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as docappeal,
				case referred
					WHEN 1 THEN 8.33
					WHEN 2 THEN 16.67
					WHEN 4 THEN 66.67
					WHEN 6 THEN 100.00
				end as referred,
				case central_platform
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as centralplatform,
				case auto_platform
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as autoplatform,
				case online_acc
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as onlineacc,
				case realtime_acc
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as realtimeacc,
				case use_consultant
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as useconsultant,
				case tax_agent
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as taxagent,
				case exclu_agent
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as excluagent,
				case govt_dept
					WHEN 2 THEN 100.00
					WHEN 1 THEN 100.00
				end as govtdept,
				case sbircollect_lg
					WHEN 3 THEN 100.00
					WHEN 1 THEN 100.00
				end as sbircollectlg,
				case all_cases
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as allcases,
				case payment_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as paymentaudit,
				case a2013_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as audit2013,
				case a2014_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as audit2014,
				case a2015_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as audit2015,
				case rev_dept
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as revdept,
				case revdept_diff
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as revdeptdiff,
				case taxpayer_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as taxpayeraudit,
				case last_conducted
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 1 THEN 0.00
				end as lastconducted,
				case working_cases
					WHEN 1 THEN 5.56
					WHEN 2 THEN 11.11
					WHEN 4 THEN 44.44
					WHEN 6 THEN 100.00
				end as workingcases,
				case concluded_cases
					WHEN 1 THEN 5.56
					WHEN 2 THEN 11.11
					WHEN 4 THEN 44.44
					WHEN 6 THEN 100.00
				end as concludedcases,
				case hnwi_unit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as hnwiunit,
				case hnwi_id
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as hnwiid,
				case hnwi_action
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as hnwiaction,
				case agency_coop
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as agencycoop,
				case tin_tcc
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as tintcc,
				case debt_enforce
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as debtenforce,
				case agent_involve
					WHEN 4 THEN 100.00
					WHEN 1 THEN 75.00
				end as agentinvolve,
				case court_enforce
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as courtenforce,
				case action_num
					WHEN 1 THEN 5.56
					WHEN 2 THEN 11.11
					WHEN 4 THEN 44.44
					WHEN 6 THEN 100.00
				end as actionnum,
				case taxpayer_aware
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
					WHEN 2 THEN 16.67
				end as taxpayeraware,
				case tax_edu
					WHEN 1 THEN 1
					WHEN NULL THEN 0
				end as taxedu,
				case tax_edu1
					WHEN 1 THEN 1
					WHEN NULL THEN 0
				end as taxedu1,
				case tax_edu2
					WHEN 1 THEN 1
					WHEN NULL THEN 0
				end as taxedu2,
				case tax_edu3
					WHEN 1 THEN 1
					WHEN NULL THEN 0
				end as taxedu3,
				case tax_edu4
					WHEN 1 THEN 1
					WHEN NULL THEN 0
				end as taxedu4,
				case tax_edu5
					WHEN 1 THEN 1
					WHEN NULL THEN 0
				end as taxedu5,
				case igr_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as igreffect,
				case tin_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as tineffect,
				case tat_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as tateffect,
				case complaint_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as complainteffect,
				case servicom
					WHEN 3 THEN 100.00
					WHEN 1 THEN 11.11
				end as servicom,
				case complaint_num
					WHEN 1 THEN 6.67
					WHEN 2 THEN 26.67
					WHEN 5 THEN 100.00
				end as complaintnum,
				case process_num
					WHEN 1 THEN 6.67
					WHEN 2 THEN 26.67
					WHEN 5 THEN 100.00
				end as processnum,
				case process_timetcc
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 2 THEN 33.33
					WHEN 1 THEN 8.33
				end as processtimetcc,
				case sjtb_functioning
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as sjtbfunctioning,
				case num_timemet
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 2 THEN 33.33
					WHEN 1 THEN 8.33
				end as numtimemet,
				users.state, state.stateName, num_offices, internet, zone.zoneName, 
				case standardrpt_format
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as standardrptformat,
				case nature_por
					WHEN 1 THEN 100.00
					WHEN 1 THEN 100.00
					WHEN 1 THEN 100.00
					WHEN 1 THEN 100.00
					WHEN 1 THEN 100.00
				end as naturepor,
				case cap_cost_cov
					WHEN 5 THEN 100.00
					WHEN 3 THEN 40.00
					WHEN 2 THEN 13.33
					WHEN 1 THEN 6.67
				end as capcostcov,
				case perform_app
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as performapp,
				case how_often
					WHEN 3 THEN 100.00
					WHEN 2 THEN 44.44
					WHEN 1 THEN 11.11
				end as howoften,
				case alter_target
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as altertarget,
				case function_website
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as functionwebsite,
				case tax_guide
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxguide,
				case tax_ret_form
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxretform,
				case tax_calc
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxcalc,
				case tax_reg_pack
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxregpack,
				case field_off_add
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as fieldoffadd,
				case contact_help
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as contacthelp,
				case collate_mda_levies
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as collatemdalevies,
				case collate_lga_levies
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as collatelgalevies,
				case collect_by_agent
					WHEN 1 THEN 0.00
					WHEN 3 THEN 100.00
				end as collectbyagent,
				case sbircollect_mda
					WHEN 3 THEN 100.00
					WHEN 1 THEN 11.11
				end as sbircollectmda,
				case conext_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as conextaudit,
				case a2013_extaudit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as 2013extaudit,
				case a2014_extaudit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as 2014extaudit,
				case a2015_extaudit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as 2015extaudit,
				case trained_auditor
					WHEN 2 THEN 13.33
					WHEN 3 THEN 40.00
					WHEN 5 THEN 100.00
				end as trainedauditor,
				case vaids_unit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as vaidsunit,
				case vaid_staff
					WHEN 1 THEN 8.33
					WHEN 3 THEN 50.00
					WHEN 4 THEN 100.00
				end as vaidstaff
FROM state, survey3, users, zone WHERE state.stateName = users.state AND survey3.quarter = '" . $quarter . "' AND survey3.year = '2017' AND zone.zoneId = '" . $zone . "' AND zone.zoneId = state.zoneId AND users.username = survey3.mysession ORDER BY state.stateName";

$result=mysqli_query($link, $sq10); 
if($result === FALSE) { 
    die(mysqli_error($link)); // TODO: better error handling
}
	?>
            
              <?php
              $rank = 0;
  $last_score = false;
  $rows = 0;
  
              $states =  array();
			  $taxEnfoscores10 = array();
			  ?>
		
		  <?php
			  while($rs10=mysqli_fetch_array($result,MYSQLI_NUM)){
			  //while($rs10=mysqli_fetch_array($sq10)){
			      $rows++;
		$taxpayeraudit=$rs10[77];
		$lastconducted=$rs10[78];
		$workingcases=$rs10[79];
		$concludedcases=$rs10[80];
		$hnwiunit=$rs10[81];
		$hnwiid=$rs10[82];
		$hnwiaction=$rs10[83];
		$agencycoop=$rs10[84];
		$tintcc=$rs10[85];
		$debtenforce=$rs10[86];
		$agentinvolve=$rs10[87];
		$courtenforce=$rs10[88];
		$actionnum=$rs10[89];
		$trainedauditor=$rs10[133];
		$vaidsunit=$rs10[134];
		$vaidstaff=$rs10[135];
		$taxenforce=($taxpayeraudit + $lastconducted + $workingcases + $concludedcases + $hnwiunit + $hnwiid + $hnwiaction + $agencycoop + $tintcc + $debtenforce + $agentinvolve + $courtenforce + $actionnum + $trainedauditor + $vaidsunit + $vaidstaff)/16;
		$taxpayeraware=$rs10[90];
		$taxedu=$rs10[91];
		$taxedu1=$rs10[92];
		$taxedu2=$rs10[93];
		$taxedu3=$rs10[94];
		$taxedu4=$rs10[95];
		$taxedu5=$rs10[96];
		$taxeduall=(($taxedu + $taxedu1 + $taxedu2 + $taxedu3 + $taxedu4 + $taxedu5)/6)*100;
		$igreffect=$rs10[97];
		$tineffect=$rs10[98];
		$tateffect=$rs10[99];
		$complainteffect=$rs10[100];
		$taxaware=($taxpayeraware + $taxeduall + $igreffect + $tineffect + $tateffect + $complainteffect)/6;
		$servicom=$rs10[101];
		$complaintnum=$rs10[102];
		$processnum=$rs10[103];
		$processtimetcc=$rs10[104];
		$complaints=($servicom + $complaintnum + $processnum + $processtimetcc)/4;
		$sjtbfunctioning=$rs10[105];
		$numtimemet=$rs10[106];
		$doubletax=($sjtbfunctioning + $numtimemet)/2;
		$taxenforcem=($taxenforce + $taxaware + $complaints + $doubletax)/4;
		$showme=$rs10[107];
		$states[$rows]=$rs10[108];
		$taxEnfoscores10[$states[$rows]] = $taxenforcem;
		
			  }
           ?>
               
    
    <?php
		
   // }
		
		$ranking = getRank($states,$taxEnfoscores10);
		  
		   for($i= 1; $i <= $rows; $i++)
           {
		
		   }

//overall score
$link = mysqli_connect("localhost", "nggovern_Garki", "NgfBassi1!", "nggovern_dashboard");
if(mysqli_errno($link))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
    mysqli_query($link, "SET SQL_BIG_SELECTS=1");
$sq10 ="SELECT 
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
				users.state, state.stateName, survey.num_offices, survey.internet, zone.zoneName, 
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
FROM state, survey, survey1, survey2, survey3, users, zone WHERE state.stateName = users.state AND survey.quarter = '" . $quarter . "' AND survey.year = '2017' AND survey1.quarter = '" . $quarter . "' AND survey1.year = '2017' AND survey2.quarter = '" . $quarter . "' AND survey2.year = '2017' AND survey3.quarter = '" . $quarter . "' AND survey3.year = '2017' AND zone.zoneId = '" . $zone . "' AND zone.zoneId = state.zoneId AND users.username = survey.mysession AND users.username = survey1.mysession AND users.username = survey2.mysession AND users.username = survey3.mysession ORDER BY state.stateName";

$result=mysqli_query($link, $sq10); //echo $result;
if($result === FALSE) { 
   die(mysqli_error($link)); // TODO: better error handling
}
	?>
            
              <?php
              $rank = 0;
  $last_score = false;
  $rows = 0;
  
              $states =  array();
			  $taxOverscores10 = array();
			  
			  ?>
		
		  <?php
			  
			  while($rs10=mysqli_fetch_array($result,MYSQLI_NUM)){
			  //while($rs10=mysqli_fetch_array($sq10)){
			      $rows++;
		$sbirsmeet=$rs10[0]; 
		$sbirspolicy=$rs10[1];
		$sbirsgov=$rs10[2];
		$sbirsscf=$rs10[3];
		$sbirssha=$rs10[4];
		$sbirschair=$rs10[5];
		$naturepor=$rs10[113];
		$naturepor1=$rs10[136];
		$naturepor2=$rs10[137];
		$naturepor3=$rs10[138];
		$naturepor4=$rs10[139];
		$natureporall=(($naturepor + $naturepor1 + $naturepor2 + $naturepor3 + $naturepor4)/9)*100;
		$orginstave=($sbirsmeet + $sbirspolicy + $sbirsgov + $sbirsscf + $sbirssha + $sbirschair +$natureporall)/7;
		$sbirsis=$rs10[6];
		$sbirsfund=$rs10[7];
		$sbirscost=$rs10[8];
		$capcostcov=$rs10[114];
		$budgetavailability=($sbirsis + $sbirsfund + $sbirscost + $capcostcov)/4;
		$sbirsemp=$rs10[9];
		$taxstaff=$rs10[10];
		$capacitybuilding=$rs10[11];
		$attendedtraining=$rs10[12];
		$traininprogram=$rs10[13];
		$salstructure=$rs10[14];
		$payscheme=$rs10[15];
		$contractstaff=$rs10[16];
		$performapp=$rs10[115];
		$howoften=$rs10[116];
		$remuneration=($sbirsemp + $taxstaff + $capacitybuilding + $attendedtraining + $traininprogram + $salstructure + $payscheme + $contractstaff + $performapp + $howoften)/10;
		$numoffices=$rs10[109];
		$standardrptformat=$rs10[112];
		$zonenum=$rs10[17];
		$fullit=$rs10[18];
		$fullits=@($fullit/$numoffices)*100;
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
		$partialit=$rs10[19];
		$partialits=@($partialit/$numoffices)*100;
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
		$noict=$rs10[20];
		$noicts=@($noict/$numoffices)*100;
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
		$techstaff=$rs10[21];
		$techstaffs=@($techstaff/$numoffices)*100;
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
		$internet=$rs10[110];
		$internets=@($internet/$numoffices)*100;
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
		$fieldreport=$rs10[22];
		$fieldreport1=$rs10[23];
		$fieldreport2=$rs10[24];
		$fieldreport3=$rs10[25];
		$fieldreport4=$rs10[26];
		$highest_fieldreport = max($fieldreport, $fieldreport1, $fieldreport2, $fieldreport3, $fieldreport4);
		$reportmethod=$rs10[27];
		$altertarget=$rs10[117];
		$functionwebsite=$rs10[118];
		$taxguide=$rs10[119];
		$taxretform=$rs10[120];
		$taxcalc=$rs10[121];
		$taxregpack=$rs10[122];
		$fieldoffadd=$rs10[123];
		$contacthelp=$rs10[124];
		$websitestuff=(($taxguide + $taxretform + $taxcalc + $taxregpack + $fieldoffadd + $contacthelp)/12)*100;
		$outreach=($zonenum + $highest_ict + $techstaffs + $internets + $highest_fieldreport + $reportmethod + $standardrptformat + $altertarget + $functionwebsite + $websitestuff)/10;
		$taxadmin=($orginstave + $budgetavailability + $remuneration + $outreach)/4; //echo $taxadmin;
		$tindatabase=$rs10[28];
		$makeassess=$rs10[29];
		$taxpayerengage=$rs10[30];
		$targetsetting=$rs10[31];
		$pitrates=$rs10[32];
		$havetin=$rs10[34];
		$regpack=$rs10[35];
		$newtax=$rs10[36];
		$numpage=$rs10[37];
		$standardform=$rs10[38];
		$papersize=$rs10[39];
		$availpublic=$rs10[40];
		$packcontent=$rs10[41];
		$availreq=$rs10[42];
		$availreq1=$rs10[43];
		$availreq2=$rs10[44];
		$availreq3=$rs10[45];
		$availreq4=$rs10[46];
		$availreq5=$rs10[47];
		$availreq6=$rs10[48];
		$availreqall=(($availreq + $availreq1 + $availreq2 + $availreq3 + $availreq4 + $availreq5 + $availreq6)/13)*100;
		$guidance=$rs10[49];
		$availonline=$rs10[50];
		$taxregtin=($tindatabase + $makeassess + $taxpayerengage + $targetsetting + $pitrates + $havetin + $regpack + $newtax + $numpage + $standardform + $papersize + $availpublic + $packcontent + $availreqall + $guidance + $availonline)/16;
		$sirsassessment=$rs10[51];
		$selfassessment=$rs10[52];
		$selfassesscover=$rs10[53];
		$selfassesscover1=$rs10[54];
		$selfassesscover2=$rs10[55];
		$selfassesscover3=$rs10[56];
		$selfassesscoverall=(($selfassesscover + $selfassesscover1 + $selfassesscover2 + $selfassesscover3)/12)*100;
		$deskguide=$rs10[57];
		$objectright=$rs10[58];
		$docappeal=$rs10[59];
		$referred=$rs10[60];
		$validity=$rs10[33];
		$taxefficient=($sirsassessment + $selfassessment + $selfassesscoverall + $deskguide + $objectright + $docappeal + $referred + $validity)/8;
		$taxprocedure=($taxregtin + $taxefficient)/2; //echo $taxprocedure;
		$centralplatform=$rs10[61];
		$autoplatform=$rs10[62];
		$onlineacc=$rs10[63];
		$realtimeacc=$rs10[64];
		$useconsultant=$rs10[65];
		$taxagent=$rs10[66];
		$excluagent=$rs10[67];
		$govtdept=$rs10[68];
		$sbircollectlg=$rs10[69];
		$allcases=$rs10[70];
		$paymentaudit=$rs10[71];
		$audit2013=$rs10[72];
		$audit2014=$rs10[73];
		$audit2015=$rs10[74];
		$revdept=$rs10[75];
		$revdeptdiff=$rs10[76];
		$collatemdalevies=$rs10[125];
		$collatelgalevies=$rs10[126];
		$collectbyagent=$rs10[127];
		$sbircollectmda=$rs10[128];
		$conextaudit=$rs10[129];
		$extaudit2013=$rs10[130];
		$extaudit2014=$rs10[131];
		$extaudit2015=$rs10[132];
		if($useconsultant == 100.00){
		$taxprocessing=($centralplatform + $autoplatform + $onlineacc + $realtimeacc + $useconsultant + $govtdept + $sbircollectlg + $allcases + $paymentaudit + $audit2013 + $audit2014 + $audit2015 + $revdept + $revdeptdiff + $collatemdalevies + $collatelgalevies + $collectbyagent + $sbircollectmda + $conextaudit + $extaudit2013 + $extaudit2014 + $extaudit2015)/22;
} else {
		$taxprocessing=($centralplatform + $autoplatform + $onlineacc + $realtimeacc + $useconsultant + $taxagent + $excluagent + $govtdept + $sbircollectlg + $allcases + $paymentaudit + $audit2013 + $audit2014 + $audit2015 + $revdept + $revdeptdiff + $collatemdalevies + $collatelgalevies + $collectbyagent + $sbircollectmda + $conextaudit + $extaudit2013 + $extaudit2014 + $extaudit2015)/24; //echo $taxprocessing;
		}
		$taxpayeraudit=$rs10[77];
		$lastconducted=$rs10[78];
		$workingcases=$rs10[79];
		$concludedcases=$rs10[80];
		$hnwiunit=$rs10[81];
		$hnwiid=$rs10[82];
		$hnwiaction=$rs10[83];
		$agencycoop=$rs10[84];
		$tintcc=$rs10[85];
		$debtenforce=$rs10[86];
		$agentinvolve=$rs10[87];
		$courtenforce=$rs10[88];
		$actionnum=$rs10[89];
		$trainedauditor=$rs10[133];
		$vaidsunit=$rs10[134];
		$vaidstaff=$rs10[135];
		$taxenforce=($taxpayeraudit + $lastconducted + $workingcases + $concludedcases + $hnwiunit + $hnwiid + $hnwiaction + $agencycoop + $tintcc + $debtenforce + $agentinvolve + $courtenforce + $actionnum + $trainedauditor + $vaidsunit + $vaidstaff)/16;
		$taxpayeraware=$rs10[90];
		$taxedu=$rs10[91];
		$taxedu1=$rs10[92];
		$taxedu2=$rs10[93];
		$taxedu3=$rs10[94];
		$taxedu4=$rs10[95];
		$taxedu5=$rs10[96];
		$taxeduall=(($taxedu + $taxedu1 + $taxedu2 + $taxedu3 + $taxedu4 + $taxedu5)/6)*100;
		$igreffect=$rs10[97];
		$tineffect=$rs10[98];
		$tateffect=$rs10[99];
		$complainteffect=$rs10[100];
		$taxaware=($taxpayeraware + $taxeduall + $igreffect + $tineffect + $tateffect + $complainteffect)/6;
		$servicom=$rs10[101];
		$complaintnum=$rs10[102];
		$processnum=$rs10[103];
		$processtimetcc=$rs10[104];
		$complaints=($servicom + $complaintnum + $processnum + $processtimetcc)/4;
		$sjtbfunctioning=$rs10[105];
		$numtimemet=$rs10[106];
		$doubletax=($sjtbfunctioning + $numtimemet)/2;
		$taxenforcem=($taxenforce + $taxaware + $complaints + $doubletax)/4; //echo $taxenforcem;
		$overall=($taxadmin + $taxprocedure + $taxprocessing + $taxenforcem)/4;
		$showme=$rs10[107];
		$states[$rows]=$rs10[108];
		$taxOverscores10[$states[$rows]] = $overall;
		
			  }
           ?>
               
    <?php
		
    //}

         $ranking = getRank($states,$taxOverscores10);
		  
		   for($i= 1; $i <= $rows; $i++)
           {
               
		   }
			

//tax administration
$link = mysqli_connect("localhost", "nggovern_Garki", "NgfBassi1!", "nggovern_dashboard");
if(mysqli_errno($link))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
    mysqli_query($link, "SET SQL_BIG_SELECTS=1");
$sq1 ="SELECT 
				case sbirs_meet
					WHEN 4 THEN 53.33
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 2 THEN 0.00
					WHEN 1 THEN 0.00
				end as sbirsmeet, 
				case sbirs_policy
					WHEN 2 THEN 22.22
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as sbirspolicy, 
				case sbirs_gov
					WHEN 5 THEN 100.00
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 2 THEN 25.00
					WHEN 1 THEN 0.00
				end as sbirsgov, 
				case sbirs_scf
					WHEN 5 THEN 100.00
					WHEN 4 THEN 53.33
					WHEN 3 THEN 20.00
					WHEN 2 THEN 0.00
					WHEN 1 THEN 0.00
				end as sbirsscf, 
				case sbirs_sha
					WHEN 5 THEN 0.00
					WHEN 2 THEN 25.33
					WHEN 3 THEN 37.50
					WHEN 4 THEN 100.00
					WHEN 1 THEN 25.00
					WHEN 0 THEN 0.00
				end as sbirssha, 
				case sbirs_chair
					WHEN 2 THEN 100.00
					WHEN 1 THEN 0.00
				end as sbirschair,
				case sbirs_is
					WHEN 3 THEN 100.00
					WHEN 2 THEN 44.44
					WHEN 1 THEN 0.00
				end as sbirsis,
				case sbirs_fund
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 2 THEN 13.33
					WHEN 4 THEN 53.33
				end as sbirsfund,
				case sbirs_cost
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
					WHEN 2 THEN 22.22
				end as sbirscost,
				case sbirs_emp
					WHEN 1 THEN 0.00
					WHEN 2 THEN 16.67
					WHEN 3 THEN 75.00
					WHEN 4 THEN 100.00
					WHEN 6 THEN 150.00
				end as sbirsemp,
				case tax_staff
					WHEN 1 THEN 0.00
					WHEN 2 THEN 26.67
					WHEN 3 THEN 40.00
					WHEN 4 THEN 80.00
					WHEN 6 THEN 100.00
				end as taxstaff,
				case capacity_building
					WHEN 4 THEN 100.00
					WHEN 3 THEN 50.00
					WHEN 2 THEN 16.67
					WHEN 1 THEN 0.00
				end as capacitybuilding,
				case attended_training
					WHEN 3 THEN 100.00
					WHEN 2 THEN 44.44
					WHEN 1 THEN 11.11
				end as attendedtraining,
				case trainin_program
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 0 THEN 0.00
				end as traininprogram,
				case sal_structure
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as salstructure,
				case pay_scheme
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as payscheme,
				case contract_staff
					WHEN 1 THEN 22.22
					WHEN 3 THEN 100.00
				end as contractstaff,
				case zone_num
					WHEN 4 THEN 100.00
					WHEN 3 THEN 50.00
					WHEN 2 THEN 16.67
					WHEN 1 THEN 0.00
				end as zonenum,
				 full_ict,
				 partial_ict,
				 no_ict,
				 tech_staff,
				case field_report
					WHEN 4 THEN 100.00
					WHEN NULL THEN 0.00
				end as fieldreport,
				case field_report1
					WHEN 4 THEN 100.00
					WHEN NULL THEN 0.00
				end as fieldreport1,
				case field_report2
					WHEN 3 THEN 50.00
					WHEN NULL THEN 0.00
				end as fieldreport2,
				case field_report3
					WHEN 2 THEN 16.67
					WHEN NULL THEN 0.00
				end as fieldreport3,
				case field_report4
					WHEN 1 THEN 0.00
					WHEN NULL THEN 0.00
				end as fieldreport4,
				case report_method
					WHEN 3 THEN 66.67
					WHEN 2 THEN 22.22
					WHEN 3 THEN 100.00
				end as reportmethod,
				case tin_captured
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as tindatabase,
				case make_assess
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as makeassess,
				case taxpayer_engage
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as taxpayerengage,
				case target_setting
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as targetsetting,
				case pit_rates
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as pitrates,
				case validity
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as validity,
				case have_tin
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as havetin,
				case reg_pack
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as regpack,
				case new_tax
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as newtax,
				case num_page
					WHEN 6 THEN 100.00
					WHEN 5 THEN 83.33
					WHEN 4 THEN 44.44
					WHEN 2 THEN 11.11
					WHEN 1 THEN 5.56
					WHEN 0 THEN 0.00
					WHEN 0 THEN 0.00
				end as numpage,
				case standard_form
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as standardform,
				case paper_size
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 1 THEN 6.67
				end as papersize,
				case avail_public
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as availpublic,
				case pack_content
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as packcontent,
				case avail_req
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as availreq,
				case avail_req1
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as availreq1,
				case avail_req2
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as availreq2,
				case avail_req3
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as availreq3,
				case avail_req4
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as availreq4,
				case avail_req5
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as availreq5,
				case avail_req6
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as availreq6,
				case guidance
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as guidance,
				case avail_online
					WHEN 5 THEN 100.00
					WHEN 1 THEN 6.67
				end as availonline,
				case sbirs_assessment
					WHEN 1 THEN 100.00
					WHEN 4 THEN 0.00
				end as sirsassessment,
				case self_assessment
					WHEN 4 THEN 100.00
					WHEN 2 THEN 16.67
					WHEN 1 THEN 8.33
					WHEN 0 THEN 0.00
				end as selfassessment,
				case self_assesscover
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as selfassesscover,
				case self_assesscover1
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as selfassesscover1,
				case self_assesscover2
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as selfassesscover2,
				case self_assesscover3
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as selfassesscover3,
				case desk_guide
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as deskguide,
				case object_right
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as objectright,
				case doc_appeal
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as docappeal,
				case referred
					WHEN 1 THEN 8.33
					WHEN 2 THEN 16.67
					WHEN 4 THEN 66.67
					WHEN 6 THEN 100.00
				end as referred,
				case central_platform
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as centralplatform,
				case auto_platform
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as autoplatform,
				case online_acc
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as onlineacc,
				case realtime_acc
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as realtimeacc,
				case use_consultant
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as useconsultant,
				case tax_agent
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as taxagent,
				case exclu_agent
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as excluagent,
				case govt_dept
					WHEN 2 THEN 100.00
					WHEN 1 THEN 100.00
				end as govtdept,
				case sbircollect_lg
					WHEN 3 THEN 100.00
					WHEN 1 THEN 100.00
				end as sbircollectlg,
				case all_cases
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as allcases,
				case payment_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as paymentaudit,
				case a2013_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as audit2013,
				case a2014_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as audit2014,
				case a2015_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as audit2015,
				case rev_dept
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as revdept,
				case revdept_diff
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as revdeptdiff,
				case taxpayer_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as taxpayeraudit,
				case last_conducted
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 1 THEN 0.00
				end as lastconducted,
				case working_cases
					WHEN 1 THEN 5.56
					WHEN 2 THEN 11.11
					WHEN 4 THEN 44.44
					WHEN 6 THEN 100.00
				end as workingcases,
				case concluded_cases
					WHEN 1 THEN 5.56
					WHEN 2 THEN 11.11
					WHEN 4 THEN 44.44
					WHEN 6 THEN 100.00
				end as concludedcases,
				case hnwi_unit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as hnwiunit,
				case hnwi_id
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as hnwiid,
				case hnwi_action
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as hnwiaction,
				case agency_coop
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as agencycoop,
				case tin_tcc
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as tintcc,
				case debt_enforce
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as debtenforce,
				case agent_involve
					WHEN 4 THEN 100.00
					WHEN 1 THEN 75.00
				end as agentinvolve,
				case court_enforce
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as courtenforce,
				case action_num
					WHEN 1 THEN 5.56
					WHEN 2 THEN 11.11
					WHEN 4 THEN 44.44
					WHEN 6 THEN 100.00
				end as actionnum,
				case taxpayer_aware
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
					WHEN 2 THEN 16.67
				end as taxpayeraware,
				case tax_edu
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxedu,
				case tax_edu1
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxedu1,
				case tax_edu2
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxedu2,
				case tax_edu3
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxedu3,
				case tax_edu4
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxedu4,
				case tax_edu5
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxedu5,
				case igr_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as igreffect,
				case tin_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as tineffect,
				case tat_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as tateffect,
				case complaint_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as complainteffect,
				case servicom
					WHEN 3 THEN 100.00
					WHEN 1 THEN 11.11
				end as servicom,
				case complaint_num
					WHEN 1 THEN 6.67
					WHEN 2 THEN 26.67
					WHEN 5 THEN 100.00
				end as complaintnum,
				case process_num
					WHEN 1 THEN 6.67
					WHEN 2 THEN 26.67
					WHEN 5 THEN 100.00
				end as processnum,
				case process_timetcc
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 2 THEN 33.33
					WHEN 1 THEN 8.33
				end as processtimetcc,
				case sjtb_functioning
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as sjtbfunctioning,
				case num_timemet
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 2 THEN 33.33
					WHEN 1 THEN 8.33
				end as numtimemet,
				users.state, state.stateName, num_offices, internet, zone.zoneName, 
				case standardrpt_format
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as standardrptformat,
				case nature_por
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as naturepor,
				case cap_cost_cov
					WHEN 5 THEN 100.00
					WHEN 3 THEN 40.00
					WHEN 2 THEN 13.33
					WHEN 1 THEN 6.67
				end as capcostcov,
				case perform_app
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as performapp,
				case how_often
					WHEN 3 THEN 100.00
					WHEN 2 THEN 44.44
					WHEN 1 THEN 11.11
				end as howoften,
				case alter_target
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as altertarget,
				case function_website
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as functionwebsite,
				case tax_guide
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as taxguide,
				case tax_ret_form
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as taxretform,
				case tax_calc
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as taxcalc,
				case tax_reg_pack
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as taxregpack,
				case field_off_add
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as fieldoffadd,
				case contact_help
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as contacthelp,
				case collate_mda_levies
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as collatemdalevies,
				case collate_lga_levies
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as collatelgalevies,
				case collect_by_agent
					WHEN 1 THEN 0.00
					WHEN 3 THEN 100.00
				end as collectbyagent,
				case sbircollect_mda
					WHEN 3 THEN 100.00
					WHEN 1 THEN 11.11
				end as sbircollectmda,
				case conext_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as conextaudit,
				case a2013_extaudit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as 2013extaudit,
				case a2014_extaudit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as 2014extaudit,
				case a2015_extaudit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as 2015extaudit,
				case trained_auditor
					WHEN 2 THEN 13.33
					WHEN 3 THEN 40.00
					WHEN 5 THEN 100.00
				end as trainedauditor,
				case vaids_unit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as vaidsunit,
				case vaid_staff
					WHEN 1 THEN 8.33
					WHEN 3 THEN 50.00
					WHEN 4 THEN 100.00
				end as vaidstaff,
				case nature_por1
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as naturepor1,
				case nature_por2
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as naturepor2,
				case nature_por3
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as naturepor3,
				case nature_por4
					WHEN 1 THEN 1
					WHEN 0 THEN 0
				end as naturepor4
FROM state, survey, users, zone WHERE state.stateName = users.state AND survey.quarter = '" . $quarter . "' AND survey.year = '" . $year . "' AND zone.zoneId = '" . $zone . "' AND zone.zoneId = state.zoneId AND users.username = survey.mysession ORDER BY state.stateName";

$result=mysqli_query($link, $sq1); 
if($result === FALSE) { 
   die(mysqli_error($link)); // TODO: better error handling
}
		
//}
?>

        <td><table width="100%" border="0" cellspacing="7" cellpadding="7">
          <tr>
            <td width="12.5%" valign="top"><table border="0" cellspacing="0" class="status_table" width="100%">
              <tr>
                <td colspan="4" class="taxadmin">TAX ADMINISTRATION <?php echo '<i>(Year: '.$year.')</i>'; ?></td>
              </tr>
              <tr class="taxadmin">
              <td>Rank/36</td>
                <td>State</td>
                <td>Score %</td>
                <td align="center">∆</td>
              </tr>
              <?php
			  $rank = 0;
  $last_score = false;
  $rows = 0;
  $states =  array();
			  $taxAdminscores = array();
			  $taxAdminDiff = array();
			  ?>
		<!-- New Chart -->
        <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['State', 'Rating (%)'],
		  <?php	
			  while($rs=mysqli_fetch_array($result,MYSQLI_NUM)){
			  
			      $rows++;
			$sbirsmeet=$rs[0]; 
		$sbirspolicy=$rs[1];
		$sbirsgov=$rs[2];
		$sbirsscf=$rs[3];
		$sbirssha=$rs[4];
		$sbirschair=$rs[5];
		$naturepor=$rs[113];
		$naturepor1=$rs[136];
		$naturepor2=$rs[137];
		$naturepor3=$rs[138];
		$naturepor4=$rs[139];
		$natureporall=(($naturepor + $naturepor1 + $naturepor2 + $naturepor3 + $naturepor4)/9)*100;
		$orginstave=($sbirsmeet + $sbirspolicy + $sbirsgov + $sbirsscf + $sbirssha + $sbirschair + $natureporall)/7;
		$sbirsis=$rs[6];
		$sbirsfund=$rs[7];
		$sbirscost=$rs[8];
		$capcostcov=$rs[114];
		$budgetavailability=($sbirsis + $sbirsfund + $sbirscost + $capcostcov)/4;
		$sbirsemp=$rs[9];
		$taxstaff=$rs[10];
		$capacitybuilding=$rs[11];
		$attendedtraining=$rs[12];
		$traininprogram=$rs[13];
		$salstructure=$rs[14];
		$payscheme=$rs[15];
		$contractstaff=$rs[16];
		$performapp=$rs[115];
		$howoften=$rs[116];
		$remuneration=($sbirsemp + $taxstaff + $capacitybuilding + $attendedtraining + $traininprogram + $salstructure + $payscheme + $contractstaff + $performapp + $howoften)/10;
		$numoffices=$rs[109];
		$internet=$rs[110];
		$zonenum=$rs[17];
		$fullit=$rs[18];
		$partialit=$rs[19];
		$noict=$rs[20];
		$techstaff=$rs[21];
		$fullits=@($fullit/$numoffices)*100;
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
		$partialits=@($partialit/$numoffices)*100;
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
		$noicts=@($noict/$numoffices)*100;
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
		$internets=@($internet/$numoffices)*100;
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
		$standardrptformat=$rs[112];
		$altertarget=$rs10[117];
		$functionwebsite=$rs10[118];
		$taxguide=$rs10[119];
		$taxretform=$rs10[120];
		$taxcalc=$rs10[121];
		$taxregpack=$rs10[122];
		$fieldoffadd=$rs10[123];
		$contacthelp=$rs10[124];
		$websitestuff=(($taxguide + $taxretform + $taxcalc + $taxregpack + $fieldoffadd + $contacthelp)/12)*100;
		$outreach=($zonenum + $highest_ict + $techstaffs + $internets + $highest_fieldreport + $reportmethod + $standardrptformat + $altertarget + $functionwebsite + $websitestuff)/10;
		$taxadmin=($orginstave + $budgetavailability + $remuneration + $outreach)/4;
		if($taxadmin == 0){$taxadmin = 0;}
		$showme=$rs[107];
		//Modified Code by Ranking
		$states[$rows]=$rs[108];
		$taxAdminscores[$states[$rows]] = $taxadmin;
		//2nd Q - 1st Q
		$taxAdminDiff[$states[$rows]] = $taxAdminscores[$states[$rows]] - $taxAdminscores10[$states[$rows]];
		
		$dataSet->addPoint(new Point($rs[108],number_format($taxadmin,2)));
		
		echo "['".$rs[108]."', ".number_format($taxadmin,2)."],";
			  }
           ?>
               ]);
	  
        var options = {
          title: 'Tax Administration',
          width: 550,
          legend: { position: 'none' },
          chart: { title: 'Tax Administration',
                   subtitle: 'Governance rating' },
          bars: 'horizontal', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'bottom', label: 'Rating (%)'} // Top x-axis.
            }
          },
          bar: { groupWidth: "85%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, options);
      };
    </script>
    
    <?php
		
    //}

//Modified Code Ranking
         $ranking = getRank($states,$taxAdminscores,$taxAdminDiff);
		  
		   for($i= 1; $i <= $rows; $i++)
           {
			   if(stripos($taxAdminDiff[$states[$i]], '-') !== FALSE){
                echo '<tr>';
				echo '<td>' . $ranking[$states[$i]] . '</td><td>' . $states[$i] . '</td><td>' . number_format($taxAdminscores[$states[$i]],2) . '</td><td align="center"><font color="#FF0000">'. number_format($taxAdminDiff[$states[$i]],2) .'</font></td></tr>';
			   } else {
				   echo '<tr>';
				echo '<td>' . $ranking[$states[$i]] . '</td><td>' . $states[$i] . '</td><td>' . number_format($taxAdminscores[$states[$i]],2) . '</td><td align="center"><font color="#009900">'. number_format($taxAdminDiff[$states[$i]],2) .'</font></td></tr>';
		   }
		   }
			 
			  ?>
              
            
              <?php
              
              include "libchart/libchart/classes/libchart.php";
	$chart1 = new HorizontalBarChart(250, 500);
	$dataSet1 = new XYDataSet();
	$chart1->setDataSet($dataSet1);
	$chart1->getPlot()->setGraphPadding(new Padding(5, 30, 20, 25));
        
		//tax procedure  
	$link = mysqli_connect("localhost", "nggovern_Garki", "NgfBassi1!", "nggovern_dashboard");
if(mysqli_errno($link))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
		mysqli_query($link, "SET SQL_BIG_SELECTS=1");	  
			  $sq1 ="SELECT 
							case sbirs_meet
							WHEN 4 THEN 53.33
							WHEN 5 THEN 100.00
							WHEN 3 THEN 20.00
							WHEN 2 THEN 0.00
							WHEN 1 THEN 0.00
							end as sbirsmeet, 
							case sbirs_policy
							WHEN 2 THEN 22.22
							WHEN 3 THEN 100.00
							WHEN 1 THEN 0.00
							end as sbirspolicy, 
							case sbirs_gov
							WHEN 5 THEN 100.00
							WHEN 4 THEN 100.00
							WHEN 3 THEN 75.00
							WHEN 2 THEN 25.00
							WHEN 1 THEN 0.00
							end as sbirsgov, 
							case sbirs_scf
							WHEN 5 THEN 100.00
							WHEN 4 THEN 53.33
							WHEN 3 THEN 20.00
							WHEN 2 THEN 0.00
							WHEN 1 THEN 0.00
							end as sbirsscf, 
							case sbirs_sha
							WHEN 5 THEN 0.00
							WHEN 2 THEN 25.33
							WHEN 3 THEN 37.50
							WHEN 4 THEN 100.00
							WHEN 1 THEN 25.00
							WHEN 0 THEN 0.00
							end as sbirssha, 
							case sbirs_chair
							WHEN 2 THEN 100.00
							WHEN 1 THEN 0.00
							end as sbirschair,
							case sbirs_is
							WHEN 3 THEN 100.00
							WHEN 2 THEN 44.44
							WHEN 1 THEN 0.00
							end as sbirsis,
							case sbirs_fund
							WHEN 5 THEN 100.00
							WHEN 3 THEN 20.00
							WHEN 2 THEN 13.33
							WHEN 4 THEN 53.33
							end as sbirsfund,
							case sbirs_cost
							WHEN 3 THEN 100.00
							WHEN 1 THEN 0.00
							WHEN 2 THEN 22.22
							end as sbirscost,
							case sbirs_emp
							WHEN 1 THEN 0.00
							WHEN 2 THEN 16.67
							WHEN 3 THEN 75.00
							WHEN 4 THEN 100.00
							WHEN 6 THEN 150.00
							end as sbirsemp,
							case tax_staff
							WHEN 1 THEN 0.00
							WHEN 2 THEN 26.67
							WHEN 3 THEN 40.00
							WHEN 4 THEN 80.00
							WHEN 6 THEN 100.00
							end as taxstaff,
							case capacity_building
							WHEN 4 THEN 100.00
							WHEN 3 THEN 50.00
							WHEN 2 THEN 16.67
							WHEN 1 THEN 0.00
							end as capacitybuilding,
							case attended_training
							WHEN 3 THEN 100.00
							WHEN 2 THEN 44.44
							WHEN 1 THEN 11.11
							end as attendedtraining,
							case trainin_program
							WHEN 4 THEN 100.00
							WHEN 3 THEN 75.00
							WHEN 0 THEN 0.00
							end as traininprogram,
							case sal_structure
							WHEN 3 THEN 100.00
							WHEN 1 THEN 0.00
							end as salstructure,
							case pay_scheme
							WHEN 3 THEN 100.00
							WHEN 1 THEN 0.00
							end as payscheme,
							case contract_staff
							WHEN 1 THEN 22.22
							WHEN 3 THEN 100.00
							end as contractstaff,
							case zone_num
							WHEN 4 THEN 100.00
							WHEN 3 THEN 50.00
							WHEN 2 THEN 16.67
							WHEN 1 THEN 0.00
							end as zonenum,
							full_ict,
							partial_ict,
							no_ict,
							tech_staff,
							case field_report
							WHEN 4 THEN 100.00
							WHEN NULL THEN 0.00
							end as fieldreport,
							case field_report1
							WHEN 4 THEN 100.00
							WHEN NULL THEN 0.00
							end as fieldreport1,
							case field_report2
							WHEN 3 THEN 50.00
							WHEN NULL THEN 0.00
							end as fieldreport2,
							case field_report3
							WHEN 2 THEN 16.67
							WHEN NULL THEN 0.00
							end as fieldreport3,
							case field_report4
							WHEN 1 THEN 0.00
							WHEN NULL THEN 0.00
							end as fieldreport4,
							case report_method
							WHEN 3 THEN 66.67
							WHEN 2 THEN 22.22
							WHEN 3 THEN 100.00
							end as reportmethod,
							case tin_captured
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as tindatabase,
							case make_assess
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as makeassess,
							case taxpayer_engage
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as taxpayerengage,
							case target_setting
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as targetsetting,
							case pit_rates
							WHEN 4 THEN 100.00
							WHEN 1 THEN 0.00
							end as pitrates,
							case validity
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as validity,
							case have_tin
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as havetin,
							case reg_pack
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as regpack,
							case new_tax
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as newtax,
							case num_page
							WHEN 6 THEN 100.00
							WHEN 5 THEN 83.33
							WHEN 4 THEN 44.44
							WHEN 2 THEN 11.11
							WHEN 1 THEN 5.56
							WHEN 0 THEN 0.00
							WHEN 0 THEN 0.00
							end as numpage,
							case standard_form
							WHEN 4 THEN 100.00
							WHEN 1 THEN 0.00
							end as standardform,
							case paper_size
							WHEN 5 THEN 100.00
							WHEN 3 THEN 20.00
							WHEN 1 THEN 6.67
							end as papersize,
							case avail_public
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as availpublic,
							case pack_content
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as packcontent,
							case avail_req
							WHEN 1 THEN 2
							WHEN 0 THEN 0
							end as availreq,
							case avail_req1
							WHEN 1 THEN 2
							WHEN 0 THEN 0
							end as availreq1,
							case avail_req2
							WHEN 1 THEN 2
							WHEN 0 THEN 0
							end as availreq2,
							case avail_req3
							WHEN 1 THEN 2
							WHEN 0 THEN 0
							end as availreq3,
							case avail_req4
							WHEN 1 THEN 2
							WHEN 0 THEN 0
							end as availreq4,
							case avail_req5
							WHEN 1 THEN 2
							WHEN 0 THEN 0
							end as availreq5,
							case avail_req6
							WHEN 1 THEN 1
							WHEN 0 THEN 0
							end as availreq6,
							case guidance
							WHEN 4 THEN 100.00
							WHEN 1 THEN 0.00
							end as guidance,
							case avail_online
							WHEN 5 THEN 100.00
							WHEN 1 THEN 6.67
							end as availonline,
							case sbirs_assessment
							WHEN 1 THEN 100.00
							WHEN 4 THEN 0.00
							end as sirsassessment,
							case self_assessment
							WHEN 4 THEN 100.00
							WHEN 2 THEN 16.67
							WHEN 1 THEN 8.33
							WHEN 0 THEN 0.00
							end as selfassessment,
							case self_assesscover
							WHEN 1 THEN 3
							WHEN NULL THEN 0
							end as selfassesscover,
							case self_assesscover1
							WHEN 1 THEN 3
							WHEN NULL THEN 0
							end as selfassesscover1,
							case self_assesscover2
							WHEN 1 THEN 3
							WHEN NULL THEN 0
							end as selfassesscover2,
							case self_assesscover3
							WHEN 1 THEN 3
							WHEN NULL THEN 0
							end as selfassesscover3,
							case desk_guide
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as deskguide,
							case object_right
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as objectright,
							case doc_appeal
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as docappeal,
							case referred
							WHEN 1 THEN 8.33
							WHEN 2 THEN 16.67
							WHEN 4 THEN 66.67
							WHEN 6 THEN 100.00
							end as referred,
							case central_platform
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as centralplatform,
							case auto_platform
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as autoplatform,
							case online_acc
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as onlineacc,
							case realtime_acc
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as realtimeacc,
							case use_consultant
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as useconsultant,
							case tax_agent
							WHEN 3 THEN 100.00
							WHEN 1 THEN 0.00
							end as taxagent,
							case exclu_agent
							WHEN 3 THEN 100.00
							WHEN 1 THEN 0.00
							end as excluagent,
							case govt_dept
							WHEN 2 THEN 100.00
							WHEN 1 THEN 100.00
							end as govtdept,
							case sbircollect_lg
							WHEN 3 THEN 100.00
							WHEN 1 THEN 100.00
							end as sbircollectlg,
							case all_cases
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as allcases,
							case payment_audit
							WHEN 4 THEN 100.00
							WHEN 1 THEN 0.00
							end as paymentaudit,
							case a2013_audit
							WHEN 4 THEN 100.00
							WHEN 1 THEN 0.00
							end as audit2013,
							case a2014_audit
							WHEN 4 THEN 100.00
							WHEN 1 THEN 0.00
							end as audit2014,
							case a2015_audit
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as audit2015,
							case rev_dept
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as revdept,
							case revdept_diff
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as revdeptdiff,
							case taxpayer_audit
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as taxpayeraudit,
							case last_conducted
							WHEN 5 THEN 100.00
							WHEN 3 THEN 20.00
							WHEN 1 THEN 0.00
							end as lastconducted,
							case working_cases
							WHEN 1 THEN 5.56
							WHEN 2 THEN 11.11
							WHEN 4 THEN 44.44
							WHEN 6 THEN 100.00
							end as workingcases,
							case concluded_cases
							WHEN 1 THEN 5.56
							WHEN 2 THEN 11.11
							WHEN 4 THEN 44.44
							WHEN 6 THEN 100.00
							end as concludedcases,
							case hnwi_unit
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as hnwiunit,
							case hnwi_id
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as hnwiid,
							case hnwi_action
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as hnwiaction,
							case agency_coop
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as agencycoop,
							case tin_tcc
							WHEN 4 THEN 100.00
							WHEN 1 THEN 0.00
							end as tintcc,
							case debt_enforce
							WHEN 4 THEN 100.00
							WHEN 1 THEN 0.00
							end as debtenforce,
							case agent_involve
							WHEN 4 THEN 100.00
							WHEN 1 THEN 75.00
							end as agentinvolve,
							case court_enforce
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as courtenforce,
							case action_num
							WHEN 1 THEN 5.56
							WHEN 2 THEN 11.11
							WHEN 4 THEN 44.44
							WHEN 6 THEN 100.00
							end as actionnum,
							case taxpayer_aware
							WHEN 4 THEN 100.00
							WHEN 1 THEN 0.00
							WHEN 2 THEN 16.67
							end as taxpayeraware,
							case tax_edu
							WHEN 1 THEN 100.00
							WHEN NULL THEN 0.00
							end as taxedu,
							case tax_edu1
							WHEN 1 THEN 100.00
							WHEN NULL THEN 0.00
							end as taxedu1,
							case tax_edu2
							WHEN 1 THEN 100.00
							WHEN NULL THEN 0.00
							end as taxedu2,
							case tax_edu3
							WHEN 1 THEN 100.00
							WHEN NULL THEN 0.00
							end as taxedu3,
							case tax_edu4
							WHEN 1 THEN 100.00
							WHEN NULL THEN 0.00
							end as taxedu4,
							case tax_edu5
							WHEN 1 THEN 100.00
							WHEN NULL THEN 0.00
							end as taxedu5,
							case igr_effect
							WHEN 3 THEN 100.00
							WHEN 1 THEN 0.00
							end as igreffect,
							case tin_effect
							WHEN 3 THEN 100.00
							WHEN 1 THEN 0.00
							end as tineffect,
							case tat_effect
							WHEN 3 THEN 100.00
							WHEN 1 THEN 0.00
							end as tateffect,
							case complaint_effect
							WHEN 3 THEN 100.00
							WHEN 1 THEN 0.00
							end as complainteffect,
							case servicom
							WHEN 3 THEN 100.00
							WHEN 1 THEN 11.11
							end as servicom,
							case complaint_num
							WHEN 1 THEN 6.67
							WHEN 2 THEN 26.67
							WHEN 5 THEN 100.00
							end as complaintnum,
							case process_num
							WHEN 1 THEN 6.67
							WHEN 2 THEN 26.67
							WHEN 5 THEN 100.00
							end as processnum,
							case process_timetcc
							WHEN 4 THEN 100.00
							WHEN 3 THEN 75.00
							WHEN 2 THEN 33.33
							WHEN 1 THEN 8.33
							end as processtimetcc,
							case sjtb_functioning
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as sjtbfunctioning,
							case num_timemet
							WHEN 4 THEN 100.00
							WHEN 3 THEN 75.00
							WHEN 2 THEN 33.33
							WHEN 1 THEN 8.33
							end as numtimemet,
							users.state, state.stateName, num_offices, internet, zone.zoneName, 
							case standardrpt_format
							WHEN 3 THEN 100.00
							WHEN 1 THEN 0.00
							end as standardrptformat,
							case nature_por
							WHEN 1 THEN 2
							WHEN 0 THEN 0
							end as naturepor,
							case cap_cost_cov
							WHEN 5 THEN 100.00
							WHEN 3 THEN 40.00
							WHEN 2 THEN 13.33
							WHEN 1 THEN 6.67
							end as capcostcov,
							case perform_app
							WHEN 3 THEN 100.00
							WHEN 1 THEN 0.00
							end as performapp,
							case how_often
							WHEN 3 THEN 100.00
							WHEN 2 THEN 44.44
							WHEN 1 THEN 11.11
							end as howoften,
							case alter_target
							WHEN 3 THEN 100.00
							WHEN 1 THEN 0.00
							end as altertarget,
							case function_website
							WHEN 3 THEN 100.00
							WHEN 1 THEN 0.00
							end as functionwebsite,
							case tax_guide
							WHEN 1 THEN 100.00
							WHEN NULL THEN 0.00
							end as taxguide,
							case tax_ret_form
							WHEN 1 THEN 100.00
							WHEN NULL THEN 0.00
							end as taxretform,
							case tax_calc
							WHEN 1 THEN 100.00
							WHEN NULL THEN 0.00
							end as taxcalc,
							case tax_reg_pack
							WHEN 1 THEN 100.00
							WHEN NULL THEN 0.00
							end as taxregpack,
							case field_off_add
							WHEN 1 THEN 100.00
							WHEN NULL THEN 0.00
							end as fieldoffadd,
							case contact_help
							WHEN 1 THEN 100.00
							WHEN NULL THEN 0.00
							end as contacthelp,
							case collate_mda_levies
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as collatemdalevies,
							case collate_lga_levies
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as collatelgalevies,
							case collect_by_agent
							WHEN 1 THEN 0.00
							WHEN 3 THEN 100.00
							end as collectbyagent,
							case sbircollect_mda
							WHEN 3 THEN 100.00
							WHEN 1 THEN 11.11
							end as sbircollectmda,
							case conext_audit
							WHEN 4 THEN 100.00
							WHEN 1 THEN 0.00
							end as conextaudit,
							case a2013_extaudit
							WHEN 4 THEN 100.00
							WHEN 1 THEN 0.00
							end as 2013extaudit,
							case a2014_extaudit
							WHEN 4 THEN 100.00
							WHEN 1 THEN 0.00
							end as 2014extaudit,
							case a2015_extaudit
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as 2015extaudit,
							case trained_auditor
							WHEN 2 THEN 13.33
							WHEN 3 THEN 40.00
							WHEN 5 THEN 100.00
							end as trainedauditor,
							case vaids_unit
							WHEN 4 THEN 100.00
							WHEN 1 THEN 8.33
							end as vaidsunit,
							case vaid_staff
							WHEN 1 THEN 8.33
							WHEN 3 THEN 50.00
							WHEN 4 THEN 100.00
							end as vaidstaff
FROM state, survey1, users, zone WHERE state.stateName = users.state AND survey1.quarter = '" . $quarter . "' AND survey1.year = '" . $year . "' AND zone.zoneId = '" . $zone . "' AND zone.zoneId = state.zoneId AND users.username = survey1.mysession ORDER BY state.stateName";
//echo $sql;
//$result = mysqli_query($link, $sq1) or die(mysqli_error($link));
//$num_results = mysqli_num_rows($result);
$result=mysqli_query($link, $sq1); //echo $result;
if($result === FALSE) { 
   die(mysqli_error($link)); // TODO: better error handling
}
	?>
	</table></td>
            <td width="12.5%" valign="top"><table border="0" cellspacing="0" class="status_table" width="100%">
              <tr>
                <td colspan="4" class="taxprocedure">TAX PROCEDURE <?php echo '<i>(Year: '.$year.')</i>'; ?></td>
              </tr>
              <tr class="taxprocedure">
                <td>Rank/36</td>
                <td>State</td>
                <td>Score %</td>
                <td align="center">∆</td>
              </tr>
	<?php
	$rank = 0;
  $last_score = false;
  $rows = 0;
  
              $states =  array();
			  $taxProcscores = array();
			  $taxProcDiff = array();
//}
?>
		<!-- New Chart -->
        <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['State', 'Rating (%)'],
		  <?php
while($rs=mysqli_fetch_array($result,MYSQLI_NUM)){
//while($rs=mysqli_fetch_array($sq1)){
    $rows++;
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
		$taxprocedure=($taxregtin + $taxefficient)/2;
		$showme=$rs[107];
		$states[$rows]=$rs[108];
		$taxProcscores[$states[$rows]] = $taxprocedure;
		//2nd Q - 1st Q
		$taxProcDiff[$states[$rows]] = $taxProcscores[$states[$rows]] - $taxProcscores10[$states[$rows]];
		
		$dataSet1->addPoint(new Point($rs[108],number_format($taxprocedure,2)));
		
		echo "['".$rs[108]."', ".number_format($taxprocedure,2)."],";
			  }
           ?>
               ]);
	  
        var options = {
          title: 'Tax Procedure',
          width: 550,
          legend: { position: 'none' },
          chart: { title: 'Tax Procedure',
                   subtitle: 'Governance rating' },
          bars: 'horizontal', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'bottom', label: 'Rating (%)'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_y_div'));
        chart.draw(data, options);
      };
    </script>
    
    <?php
		
   // }
		
		$ranking = getRank($states,$taxProcscores,$taxProcDiff);
		  
		   for($i= 1; $i <= $rows; $i++)
           {
			if(stripos($taxProcDiff[$states[$i]], '-') !== FALSE){
			  echo '<tr>';
				echo '<td>' . $ranking[$states[$i]] . '</td><td>' . $states[$i] . '</td><td>' . number_format($taxProcscores[$states[$i]],2) . '</td><td align="center"><font color="#FF0000">' . number_format($taxProcDiff[$states[$i]],2) . '</font></td></tr>';
			} else {
				echo '<tr>';
				echo '<td>' . $ranking[$states[$i]] . '</td><td>' . $states[$i] . '</td><td>' . number_format($taxProcscores[$states[$i]],2) . '</td><td align="center"><font color="#009900">' . number_format($taxProcDiff[$states[$i]],2) . '</font></td></tr>';
			}
		   }
			  ?>
        <?php
        
        include "libchart/libchart/classes/libchart.php";
	$chart2 = new HorizontalBarChart(250, 500);
	$dataSet2 = new XYDataSet();
	$chart2->setDataSet($dataSet2);
	$chart2->getPlot()->setGraphPadding(new Padding(5, 30, 20, 25));
        
		//tax processing
		$link = mysqli_connect("localhost", "nggovern_Garki", "NgfBassi1!", "nggovern_dashboard");
if(mysqli_errno($link))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
        mysqli_query($link, "SET SQL_BIG_SELECTS=1");
       		$sq1 ="SELECT 
				case sbirs_meet
					WHEN 4 THEN 53.33
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 2 THEN 0.00
					WHEN 1 THEN 0.00
				end as sbirsmeet, 
				case sbirs_policy
					WHEN 2 THEN 22.22
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as sbirspolicy, 
				case sbirs_gov
					WHEN 5 THEN 100.00
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 2 THEN 25.00
					WHEN 1 THEN 0.00
				end as sbirsgov, 
				case sbirs_scf
					WHEN 5 THEN 100.00
					WHEN 4 THEN 53.33
					WHEN 3 THEN 20.00
					WHEN 2 THEN 0.00
					WHEN 1 THEN 0.00
				end as sbirsscf, 
				case sbirs_sha
					WHEN 5 THEN 0.00
					WHEN 2 THEN 25.33
					WHEN 3 THEN 37.50
					WHEN 4 THEN 100.00
					WHEN 1 THEN 25.00
					WHEN 0 THEN 0.00
				end as sbirssha, 
				case sbirs_chair
					WHEN 2 THEN 100.00
					WHEN 1 THEN 0.00
				end as sbirschair,
				case sbirs_is
					WHEN 3 THEN 100.00
					WHEN 2 THEN 44.44
					WHEN 1 THEN 0.00
				end as sbirsis,
				case sbirs_fund
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 2 THEN 13.33
					WHEN 4 THEN 53.33
				end as sbirsfund,
				case sbirs_cost
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
					WHEN 2 THEN 22.22
				end as sbirscost,
				case sbirs_emp
					WHEN 1 THEN 0.00
					WHEN 2 THEN 16.67
					WHEN 3 THEN 75.00
					WHEN 4 THEN 100.00
					WHEN 6 THEN 150.00
				end as sbirsemp,
				case tax_staff
					WHEN 1 THEN 0.00
					WHEN 2 THEN 26.67
					WHEN 3 THEN 40.00
					WHEN 4 THEN 80.00
					WHEN 6 THEN 100.00
				end as taxstaff,
				case capacity_building
					WHEN 4 THEN 100.00
					WHEN 3 THEN 50.00
					WHEN 2 THEN 16.67
					WHEN 1 THEN 0.00
				end as capacitybuilding,
				case attended_training
					WHEN 3 THEN 100.00
					WHEN 2 THEN 44.44
					WHEN 1 THEN 11.11
				end as attendedtraining,
				case trainin_program
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 0 THEN 0.00
				end as traininprogram,
				case sal_structure
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as salstructure,
				case pay_scheme
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as payscheme,
				case contract_staff
					WHEN 1 THEN 22.22
					WHEN 3 THEN 100.00
				end as contractstaff,
				case zone_num
					WHEN 4 THEN 100.00
					WHEN 3 THEN 50.00
					WHEN 2 THEN 16.67
					WHEN 1 THEN 0.00
				end as zonenum,
				 full_ict,
				 partial_ict,
				 no_ict,
				 tech_staff,
				case field_report
					WHEN 4 THEN 100.00
					WHEN NULL THEN 0.00
				end as fieldreport,
				case field_report1
					WHEN 4 THEN 100.00
					WHEN NULL THEN 0.00
				end as fieldreport1,
				case field_report2
					WHEN 3 THEN 50.00
					WHEN NULL THEN 0.00
				end as fieldreport2,
				case field_report3
					WHEN 2 THEN 16.67
					WHEN NULL THEN 0.00
				end as fieldreport3,
				case field_report4
					WHEN 1 THEN 0.00
					WHEN NULL THEN 0.00
				end as fieldreport4,
				case report_method
					WHEN 3 THEN 66.67
					WHEN 2 THEN 22.22
					WHEN 3 THEN 100.00
				end as reportmethod,
				case tin_captured
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as tindatabase,
				case make_assess
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as makeassess,
				case taxpayer_engage
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as taxpayerengage,
				case target_setting
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as targetsetting,
				case pit_rates
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as pitrates,
				case validity
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as validity,
				case have_tin
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as havetin,
				case reg_pack
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as regpack,
				case new_tax
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as newtax,
				case num_page
					WHEN 6 THEN 100.00
					WHEN 5 THEN 83.33
					WHEN 4 THEN 44.44
					WHEN 2 THEN 11.11
					WHEN 1 THEN 5.56
					WHEN 0 THEN 0.00
					WHEN 0 THEN 0.00
				end as numpage,
				case standard_form
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as standardform,
				case paper_size
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 1 THEN 6.67
				end as papersize,
				case avail_public
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as availpublic,
				case pack_content
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as packcontent,
				case avail_req
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq,
				case avail_req1
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq1,
				case avail_req2
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq2,
				case avail_req3
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq3,
				case avail_req4
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq4,
				case avail_req5
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq5,
				case avail_req6
					WHEN 1 THEN 1
					WHEN 0 THEN 0
				end as availreq6,
				case guidance
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as guidance,
				case avail_online
					WHEN 5 THEN 100.00
					WHEN 1 THEN 6.67
				end as availonline,
				case sbirs_assessment
					WHEN 1 THEN 100.00
					WHEN 4 THEN 0.00
				end as sirsassessment,
				case self_assessment
					WHEN 4 THEN 100.00
					WHEN 2 THEN 16.67
					WHEN 1 THEN 8.33
					WHEN 0 THEN 0.00
				end as selfassessment,
				case self_assesscover
					WHEN 1 THEN 3
					WHEN 0 THEN 0
				end as selfassesscover,
				case self_assesscover1
					WHEN 1 THEN 3
					WHEN 0 THEN 0
				end as selfassesscover1,
				case self_assesscover2
					WHEN 1 THEN 3
					WHEN 0 THEN 0
				end as selfassesscover2,
				case self_assesscover3
					WHEN 1 THEN 3
					WHEN 0 THEN 0
				end as selfassesscover3,
				case desk_guide
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as deskguide,
				case object_right
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as objectright,
				case doc_appeal
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as docappeal,
				case referred
					WHEN 1 THEN 8.33
					WHEN 2 THEN 16.67
					WHEN 4 THEN 66.67
					WHEN 6 THEN 100.00
				end as referred,
				case central_platform
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as centralplatform,
				case auto_platform
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as autoplatform,
				case online_acc
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as onlineacc,
				case realtime_acc
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as realtimeacc,
				case use_consultant
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as useconsultant,
				case tax_agent
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as taxagent,
				case exclu_agent
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as excluagent,
				case govt_dept
					WHEN 2 THEN 100.00
					WHEN 1 THEN 100.00
				end as govtdept,
				case sbircollect_lg
					WHEN 3 THEN 100.00
					WHEN 1 THEN 100.00
				end as sbircollectlg,
				case all_cases
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as allcases,
				case payment_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as paymentaudit,
				case a2013_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as audit2013,
				case a2014_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as audit2014,
				case a2015_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as audit2015,
				case rev_dept
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as revdept,
				case revdept_diff
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as revdeptdiff,
				case taxpayer_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as taxpayeraudit,
				case last_conducted
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 1 THEN 0.00
				end as lastconducted,
				case working_cases
					WHEN 1 THEN 5.56
					WHEN 2 THEN 11.11
					WHEN 4 THEN 44.44
					WHEN 6 THEN 100.00
				end as workingcases,
				case concluded_cases
					WHEN 1 THEN 5.56
					WHEN 2 THEN 11.11
					WHEN 4 THEN 44.44
					WHEN 6 THEN 100.00
				end as concludedcases,
				case hnwi_unit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as hnwiunit,
				case hnwi_id
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as hnwiid,
				case hnwi_action
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as hnwiaction,
				case agency_coop
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as agencycoop,
				case tin_tcc
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as tintcc,
				case debt_enforce
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as debtenforce,
				case agent_involve
					WHEN 4 THEN 100.00
					WHEN 1 THEN 75.00
				end as agentinvolve,
				case court_enforce
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as courtenforce,
				case action_num
					WHEN 1 THEN 5.56
					WHEN 2 THEN 11.11
					WHEN 4 THEN 44.44
					WHEN 6 THEN 100.00
				end as actionnum,
				case taxpayer_aware
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
					WHEN 2 THEN 16.67
				end as taxpayeraware,
				case tax_edu
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxedu,
				case tax_edu1
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxedu1,
				case tax_edu2
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxedu2,
				case tax_edu3
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxedu3,
				case tax_edu4
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxedu4,
				case tax_edu5
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxedu5,
				case igr_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as igreffect,
				case tin_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as tineffect,
				case tat_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as tateffect,
				case complaint_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as complainteffect,
				case servicom
					WHEN 3 THEN 100.00
					WHEN 1 THEN 11.11
				end as servicom,
				case complaint_num
					WHEN 1 THEN 6.67
					WHEN 2 THEN 26.67
					WHEN 5 THEN 100.00
				end as complaintnum,
				case process_num
					WHEN 1 THEN 6.67
					WHEN 2 THEN 26.67
					WHEN 5 THEN 100.00
				end as processnum,
				case process_timetcc
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 2 THEN 33.33
					WHEN 1 THEN 8.33
				end as processtimetcc,
				case sjtb_functioning
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as sjtbfunctioning,
				case num_timemet
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 2 THEN 33.33
					WHEN 1 THEN 8.33
				end as numtimemet,
				users.state, state.stateName, num_offices, internet, zone.zoneName, 
				case standardrpt_format
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as standardrptformat,
				case nature_por
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as naturepor,
				case cap_cost_cov
					WHEN 5 THEN 100.00
					WHEN 3 THEN 40.00
					WHEN 2 THEN 13.33
					WHEN 1 THEN 6.67
				end as capcostcov,
				case perform_app
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as performapp,
				case how_often
					WHEN 3 THEN 100.00
					WHEN 2 THEN 44.44
					WHEN 1 THEN 11.11
				end as howoften,
				case alter_target
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as altertarget,
				case function_website
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as functionwebsite,
				case tax_guide
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxguide,
				case tax_ret_form
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxretform,
				case tax_calc
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxcalc,
				case tax_reg_pack
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxregpack,
				case field_off_add
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as fieldoffadd,
				case contact_help
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as contacthelp,
				case collate_mda_levies
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as collatemdalevies,
				case collate_lga_levies
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as collatelgalevies,
				case collect_by_agent
					WHEN 1 THEN 0.00
					WHEN 3 THEN 100.00
				end as collectbyagent,
				case sbircollect_mda
					WHEN 3 THEN 100.00
					WHEN 1 THEN 11.11
				end as sbircollectmda,
				case conext_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as conextaudit,
				case a2013_extaudit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as 2013extaudit,
				case a2014_extaudit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as 2014extaudit,
				case a2015_extaudit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as 2015extaudit,
				case trained_auditor
					WHEN 2 THEN 13.33
					WHEN 3 THEN 40.00
					WHEN 5 THEN 100.00
				end as trainedauditor,
				case vaids_unit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as vaidsunit,
				case vaid_staff
					WHEN 1 THEN 8.33
					WHEN 3 THEN 50.00
					WHEN 4 THEN 100.00
				end as vaidstaff
FROM state, survey2, users, zone WHERE state.stateName = users.state AND survey2.quarter = '" . $quarter . "' AND survey2.year = '" . $year . "' AND zone.zoneId = '" . $zone . "' AND zone.zoneId = state.zoneId AND users.username = survey2.mysession ORDER BY state.stateName";
$result=mysqli_query($link, $sq1); //echo $result;
if($result === FALSE) { 
   die(mysqli_error($link)); // TODO: better error handling
}
	?>
	</table></td>
            <td width="12.5%" valign="top"><table border="0" cellspacing="0" class="status_table" width="100%">
              <tr>
                <td colspan="4" class="taxprocessing">TAX PROCESSING <?php echo '<i>(Year: '.$year.')</i>'; ?></td>
              </tr>
              <tr class="taxprocessing">
                <td>Rank/36</td>
                <td>State</td>
                <td>Score %</td>
                <td align="center">∆</td>
              </tr>
              <?php
              $rank = 0;
  $last_score = false;
  $rows = 0;
  
              $states =  array();
			  $taxProscores = array();
			  $taxProDiff = array();
			   ?>
		<!-- New Chart -->
        <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['State', 'Rating (%)'],
		  <?php
			  while($rs=mysqli_fetch_array($result,MYSQLI_NUM)){
			  //while($rs=mysqli_fetch_array($sq1)){
			      $rows++;
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
		$collatemdalevies=$rs[125];
		$collatelgalevies=$rs[126];
		$collectbyagent=$rs[127];
		$sbircollectmda=$rs[128];
		$conextaudit=$rs[129];
		$extaudit2013=$rs[130];
		$extaudit2014=$rs[131];
		$extaudit2015=$rs[132];
		if($useconsultant == 100.00){
    	$taxprocessing=($centralplatform + $autoplatform + $onlineacc + $realtimeacc + $useconsultant + $govtdept + $sbircollectlg + $allcases + $paymentaudit + $audit2013 + $audit2014 + $audit2015 + $revdept + $revdeptdiff + $collatemdalevies + $collatelgalevies + $collectbyagent + $sbircollectmda + $conextaudit + $extaudit2013 + $extaudit2014 + $extaudit2015)/22;
		} else {
		$taxprocessing=($centralplatform + $autoplatform + $onlineacc + $realtimeacc + $useconsultant + $taxagent + $excluagent + $govtdept + $sbircollectlg + $allcases + $paymentaudit + $audit2013 + $audit2014 + $audit2015 + $revdept + $revdeptdiff + $collatemdalevies + $collatelgalevies + $collectbyagent + $sbircollectmda + $conextaudit + $extaudit2013 + $extaudit2014 + $extaudit2015)/24;
		}
		$showme=$rs[107];
		$states[$rows]=$rs[108];
		$taxProscores[$states[$rows]] = $taxprocessing;
		//2nd Q - 1st Q
		$taxProDiff[$states[$rows]] = $taxProscores[$states[$rows]] - $taxProscores10[$states[$rows]];
		
		$dataSet2->addPoint(new Point($rs[108],number_format($taxprocessing,2)));
		
		echo "['".$rs[108]."', ".number_format($taxprocessing,2)."],";
			  }
           ?>
               ]);
	  
        var options = {
          title: 'Tax Processing',
          width: 550,
          legend: { position: 'none' },
          chart: { title: 'Tax Processing',
                   subtitle: 'Governance rating' },
          bars: 'horizontal', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'bottom', label: 'Rating (%)'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_z_div'));
        chart.draw(data, options);
      };
    </script>
    
    <?php
		
		
   // }
		
		$ranking = getRank($states,$taxProscores,$taxProDiff);
		  
		   for($i= 1; $i <= $rows; $i++)
           {
		if(stripos($taxProDiff[$states[$i]], '-') !== FALSE){
			  echo '<tr>';
				echo '<td>' . $ranking[$states[$i]] . '</td><td>' . $states[$i] . '</td><td>' . number_format($taxProscores[$states[$i]],2) . '</td><td align="center"><font color="#FF0000">' . number_format($taxProDiff[$states[$i]],2) . '</font></td></tr>';
		} else {
			echo '<tr>';
				echo '<td>' . $ranking[$states[$i]] . '</td><td>' . $states[$i] . '</td><td>' . number_format($taxProscores[$states[$i]],2) . '</td><td align="center"><font color="#009900">' . number_format($taxProDiff[$states[$i]],2) . '</font></td></tr>';
		   }
		   }
			  ?>
              
              <?php
              
              include "libchart/libchart/classes/libchart.php";
	$chart3 = new HorizontalBarChart(250, 500);
	$dataSet3 = new XYDataSet();
	$chart3->setDataSet($dataSet3);
	$chart3->getPlot()->setGraphPadding(new Padding(5, 30, 20, 25));
              
              //tax enforcement
              $link = mysqli_connect("localhost", "nggovern_Garki", "NgfBassi1!", "nggovern_dashboard");
if(mysqli_errno($link))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
			 mysqli_query($link, "SET SQL_BIG_SELECTS=1");
       		$sq1 ="SELECT 
				case sbirs_meet
					WHEN 4 THEN 53.33
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 2 THEN 0.00
					WHEN 1 THEN 0.00
				end as sbirsmeet, 
				case sbirs_policy
					WHEN 2 THEN 22.22
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as sbirspolicy, 
				case sbirs_gov
					WHEN 5 THEN 100.00
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 2 THEN 25.00
					WHEN 1 THEN 0.00
				end as sbirsgov, 
				case sbirs_scf
					WHEN 5 THEN 100.00
					WHEN 4 THEN 53.33
					WHEN 3 THEN 20.00
					WHEN 2 THEN 0.00
					WHEN 1 THEN 0.00
				end as sbirsscf, 
				case sbirs_sha
					WHEN 5 THEN 0.00
					WHEN 2 THEN 25.33
					WHEN 3 THEN 37.50
					WHEN 4 THEN 100.00
					WHEN 1 THEN 25.00
					WHEN 0 THEN 0.00
				end as sbirssha, 
				case sbirs_chair
					WHEN 2 THEN 100.00
					WHEN 1 THEN 0.00
				end as sbirschair,
				case sbirs_is
					WHEN 3 THEN 100.00
					WHEN 2 THEN 44.44
					WHEN 1 THEN 0.00
				end as sbirsis,
				case sbirs_fund
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 2 THEN 13.33
					WHEN 4 THEN 53.33
				end as sbirsfund,
				case sbirs_cost
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
					WHEN 2 THEN 22.22
				end as sbirscost,
				case sbirs_emp
					WHEN 1 THEN 0.00
					WHEN 2 THEN 16.67
					WHEN 3 THEN 75.00
					WHEN 4 THEN 100.00
					WHEN 6 THEN 150.00
				end as sbirsemp,
				case tax_staff
					WHEN 1 THEN 0.00
					WHEN 2 THEN 26.67
					WHEN 3 THEN 40.00
					WHEN 4 THEN 80.00
					WHEN 6 THEN 100.00
				end as taxstaff,
				case capacity_building
					WHEN 4 THEN 100.00
					WHEN 3 THEN 50.00
					WHEN 2 THEN 16.67
					WHEN 1 THEN 0.00
				end as capacitybuilding,
				case attended_training
					WHEN 3 THEN 100.00
					WHEN 2 THEN 44.44
					WHEN 1 THEN 11.11
				end as attendedtraining,
				case trainin_program
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 0 THEN 0.00
				end as traininprogram,
				case sal_structure
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as salstructure,
				case pay_scheme
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as payscheme,
				case contract_staff
					WHEN 1 THEN 22.22
					WHEN 3 THEN 100.00
				end as contractstaff,
				case zone_num
					WHEN 4 THEN 100.00
					WHEN 3 THEN 50.00
					WHEN 2 THEN 16.67
					WHEN 1 THEN 0.00
				end as zonenum,
				 full_ict,
				 partial_ict,
				 no_ict,
				 tech_staff,
				case field_report
					WHEN 4 THEN 100.00
					WHEN NULL THEN 0.00
				end as fieldreport,
				case field_report1
					WHEN 4 THEN 100.00
					WHEN NULL THEN 0.00
				end as fieldreport1,
				case field_report2
					WHEN 3 THEN 50.00
					WHEN NULL THEN 0.00
				end as fieldreport2,
				case field_report3
					WHEN 2 THEN 16.67
					WHEN NULL THEN 0.00
				end as fieldreport3,
				case field_report4
					WHEN 1 THEN 0.00
					WHEN NULL THEN 0.00
				end as fieldreport4,
				case report_method
					WHEN 3 THEN 66.67
					WHEN 2 THEN 22.22
					WHEN 3 THEN 100.00
				end as reportmethod,
				case tin_captured
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as tindatabase,
				case make_assess
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as makeassess,
				case taxpayer_engage
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as taxpayerengage,
				case target_setting
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as targetsetting,
				case pit_rates
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as pitrates,
				case validity
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as validity,
				case have_tin
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as havetin,
				case reg_pack
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as regpack,
				case new_tax
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as newtax,
				case num_page
					WHEN 6 THEN 100.00
					WHEN 5 THEN 83.33
					WHEN 4 THEN 44.44
					WHEN 2 THEN 11.11
					WHEN 1 THEN 5.56
					WHEN 0 THEN 0.00
					WHEN 0 THEN 0.00
				end as numpage,
				case standard_form
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as standardform,
				case paper_size
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 1 THEN 6.67
				end as papersize,
				case avail_public
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as availpublic,
				case pack_content
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as packcontent,
				case avail_req
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq,
				case avail_req1
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq1,
				case avail_req2
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq2,
				case avail_req3
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq3,
				case avail_req4
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq4,
				case avail_req5
					WHEN 1 THEN 2
					WHEN 0 THEN 0
				end as availreq5,
				case avail_req6
					WHEN 1 THEN 1
					WHEN 0 THEN 0
				end as availreq6,
				case guidance
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as guidance,
				case avail_online
					WHEN 5 THEN 100.00
					WHEN 1 THEN 6.67
				end as availonline,
				case sbirs_assessment
					WHEN 1 THEN 100.00
					WHEN 4 THEN 0.00
				end as sirsassessment,
				case self_assessment
					WHEN 4 THEN 100.00
					WHEN 2 THEN 16.67
					WHEN 1 THEN 8.33
					WHEN 0 THEN 0.00
				end as selfassessment,
				case self_assesscover
					WHEN 1 THEN 3
					WHEN 0 THEN 0
				end as selfassesscover,
				case self_assesscover1
					WHEN 1 THEN 3
					WHEN 0 THEN 0
				end as selfassesscover1,
				case self_assesscover2
					WHEN 1 THEN 3
					WHEN 0 THEN 0
				end as selfassesscover2,
				case self_assesscover3
					WHEN 1 THEN 3
					WHEN 0 THEN 0
				end as selfassesscover3,
				case desk_guide
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as deskguide,
				case object_right
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as objectright,
				case doc_appeal
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as docappeal,
				case referred
					WHEN 1 THEN 8.33
					WHEN 2 THEN 16.67
					WHEN 4 THEN 66.67
					WHEN 6 THEN 100.00
				end as referred,
				case central_platform
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as centralplatform,
				case auto_platform
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as autoplatform,
				case online_acc
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as onlineacc,
				case realtime_acc
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as realtimeacc,
				case use_consultant
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as useconsultant,
				case tax_agent
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as taxagent,
				case exclu_agent
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as excluagent,
				case govt_dept
					WHEN 2 THEN 100.00
					WHEN 1 THEN 100.00
				end as govtdept,
				case sbircollect_lg
					WHEN 3 THEN 100.00
					WHEN 1 THEN 100.00
				end as sbircollectlg,
				case all_cases
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as allcases,
				case payment_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as paymentaudit,
				case a2013_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as audit2013,
				case a2014_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as audit2014,
				case a2015_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as audit2015,
				case rev_dept
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as revdept,
				case revdept_diff
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as revdeptdiff,
				case taxpayer_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as taxpayeraudit,
				case last_conducted
					WHEN 5 THEN 100.00
					WHEN 3 THEN 20.00
					WHEN 1 THEN 0.00
				end as lastconducted,
				case working_cases
					WHEN 1 THEN 5.56
					WHEN 2 THEN 11.11
					WHEN 4 THEN 44.44
					WHEN 6 THEN 100.00
				end as workingcases,
				case concluded_cases
					WHEN 1 THEN 5.56
					WHEN 2 THEN 11.11
					WHEN 4 THEN 44.44
					WHEN 6 THEN 100.00
				end as concludedcases,
				case hnwi_unit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as hnwiunit,
				case hnwi_id
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as hnwiid,
				case hnwi_action
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as hnwiaction,
				case agency_coop
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as agencycoop,
				case tin_tcc
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as tintcc,
				case debt_enforce
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as debtenforce,
				case agent_involve
					WHEN 4 THEN 100.00
					WHEN 1 THEN 75.00
				end as agentinvolve,
				case court_enforce
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as courtenforce,
				case action_num
					WHEN 1 THEN 5.56
					WHEN 2 THEN 11.11
					WHEN 4 THEN 44.44
					WHEN 6 THEN 100.00
				end as actionnum,
				case taxpayer_aware
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
					WHEN 2 THEN 16.67
				end as taxpayeraware,
				case tax_edu
					WHEN 1 THEN 1
					WHEN NULL THEN 0
				end as taxedu,
				case tax_edu1
					WHEN 1 THEN 1
					WHEN NULL THEN 0
				end as taxedu1,
				case tax_edu2
					WHEN 1 THEN 1
					WHEN NULL THEN 0
				end as taxedu2,
				case tax_edu3
					WHEN 1 THEN 1
					WHEN NULL THEN 0
				end as taxedu3,
				case tax_edu4
					WHEN 1 THEN 1
					WHEN NULL THEN 0
				end as taxedu4,
				case tax_edu5
					WHEN 1 THEN 1
					WHEN NULL THEN 0
				end as taxedu5,
				case igr_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as igreffect,
				case tin_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as tineffect,
				case tat_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as tateffect,
				case complaint_effect
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as complainteffect,
				case servicom
					WHEN 3 THEN 100.00
					WHEN 1 THEN 11.11
				end as servicom,
				case complaint_num
					WHEN 1 THEN 6.67
					WHEN 2 THEN 26.67
					WHEN 5 THEN 100.00
				end as complaintnum,
				case process_num
					WHEN 1 THEN 6.67
					WHEN 2 THEN 26.67
					WHEN 5 THEN 100.00
				end as processnum,
				case process_timetcc
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 2 THEN 33.33
					WHEN 1 THEN 8.33
				end as processtimetcc,
				case sjtb_functioning
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as sjtbfunctioning,
				case num_timemet
					WHEN 4 THEN 100.00
					WHEN 3 THEN 75.00
					WHEN 2 THEN 33.33
					WHEN 1 THEN 8.33
				end as numtimemet,
				users.state, state.stateName, num_offices, internet, zone.zoneName, 
				case standardrpt_format
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as standardrptformat,
				case nature_por
					WHEN 1 THEN 100.00
					WHEN 1 THEN 100.00
					WHEN 1 THEN 100.00
					WHEN 1 THEN 100.00
					WHEN 1 THEN 100.00
				end as naturepor,
				case cap_cost_cov
					WHEN 5 THEN 100.00
					WHEN 3 THEN 40.00
					WHEN 2 THEN 13.33
					WHEN 1 THEN 6.67
				end as capcostcov,
				case perform_app
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as performapp,
				case how_often
					WHEN 3 THEN 100.00
					WHEN 2 THEN 44.44
					WHEN 1 THEN 11.11
				end as howoften,
				case alter_target
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as altertarget,
				case function_website
					WHEN 3 THEN 100.00
					WHEN 1 THEN 0.00
				end as functionwebsite,
				case tax_guide
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxguide,
				case tax_ret_form
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxretform,
				case tax_calc
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxcalc,
				case tax_reg_pack
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as taxregpack,
				case field_off_add
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as fieldoffadd,
				case contact_help
					WHEN 1 THEN 100.00
					WHEN NULL THEN 0.00
				end as contacthelp,
				case collate_mda_levies
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as collatemdalevies,
				case collate_lga_levies
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as collatelgalevies,
				case collect_by_agent
					WHEN 1 THEN 0.00
					WHEN 3 THEN 100.00
				end as collectbyagent,
				case sbircollect_mda
					WHEN 3 THEN 100.00
					WHEN 1 THEN 11.11
				end as sbircollectmda,
				case conext_audit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as conextaudit,
				case a2013_extaudit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as 2013extaudit,
				case a2014_extaudit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 0.00
				end as 2014extaudit,
				case a2015_extaudit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as 2015extaudit,
				case trained_auditor
					WHEN 2 THEN 13.33
					WHEN 3 THEN 40.00
					WHEN 5 THEN 100.00
				end as trainedauditor,
				case vaids_unit
					WHEN 4 THEN 100.00
					WHEN 1 THEN 8.33
				end as vaidsunit,
				case vaid_staff
					WHEN 1 THEN 8.33
					WHEN 3 THEN 50.00
					WHEN 4 THEN 100.00
				end as vaidstaff
FROM state, survey3, users, zone WHERE state.stateName = users.state AND survey3.quarter = '" . $quarter . "' AND survey3.year = '" . $year . "' AND zone.zoneId = '" . $zone . "' AND zone.zoneId = state.zoneId AND users.username = survey3.mysession ORDER BY state.stateName";
//echo $sql;
//$result = mysqli_query($link, $sq1) or die(mysqli_error($link));
//$num_results = mysql_num_rows($result);
$result=mysqli_query($link, $sq1); //echo $result;
if($result === FALSE) { 
  die(mysqli_error($link)); // TODO: better error handling
}
	?>
            </table></td>
            
            <td width="12.5%" valign="top"><table border="0" cellspacing="0" class="status_table" width="100%">
              <tr>
                <td colspan="4" class="taxenforcement">TAX ENFORCEMENT <?php echo '<i>(Year: '.$year.')</i>'; ?></td>
              </tr>
              <tr class="taxenforcement">
                <td>Rank/36</td>
                <td>State</td>
                <td>Score %</td>
                <td align="center">∆</td>
              </tr>
              <?php
              $rank = 0;
  $last_score = false;
  $rows = 0;
  
              $states =  array();
			  $taxEnfoscores = array();
			  $taxEnfoDiff = array();
			  ?>
		<!-- New Chart -->
        <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['State', 'Rating (%)'],
		  <?php
			 while($rs=mysqli_fetch_array($result,MYSQLI_NUM)){
			 //     while($rs=mysqli_fetch_array($sq1)){
			      $rows++;
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
		$trainedauditor=$rs[133]; 
	    $vaidsunit=$rs[134]; 
	    $vaidstaff=$rs[135]; 
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
		$taxenforcem=($taxenforce + $taxaware + $complaints + $doubletax)/4;
		$showme=$rs[107];
		$states[$rows]=$rs[108];
		$taxEnfoscores[$states[$rows]] = $taxenforcem;
		//Q2 - Q1
		$taxEnfoDiff[$states[$rows]] = $taxEnfoscores[$states[$rows]] - $taxEnfoscores10[$states[$rows]];
		
		$dataSet3->addPoint(new Point($rs[108],number_format($taxenforcem,2)));
		
		echo "['".$rs[108]."', ".number_format($taxenforcem,2)."],";
			  }
           ?>
               ]);
	  
        var options = {
          title: 'Tax Enforcement',
          width: 550,
          legend: { position: 'none' },
          chart: { title: 'Tax Enforcement',
                   subtitle: 'Governance rating' },
          bars: 'horizontal', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'bottom', label: 'Rating (%)'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_w_div'));
        chart.draw(data, options);
      };
    </script>
    
    <?php
		
   // }
		
		$ranking = getRank($states,$taxEnfoscores,$taxEnfoDiff);
		  
		   for($i= 1; $i <= $rows; $i++)
           {
		if(stripos($taxEnfoDiff[$states[$i]], '-') !== FALSE){
			  echo '<tr>';
				echo '<td>' . $ranking[$states[$i]] . '</td><td>' . $states[$i] . '</td><td>' . number_format($taxEnfoscores[$states[$i]],2) . '</td><td align="center"><font color="#FF0000">' . number_format($taxEnfoDiff[$states[$i]],2) . '</font></td></tr>';
		} else {
			echo '<tr>';
				echo '<td>' . $ranking[$states[$i]] . '</td><td>' . $states[$i] . '</td><td>' . number_format($taxEnfoscores[$states[$i]],2) . '</td><td align="center"><font color="#009900">' . number_format($taxEnfoDiff[$states[$i]],2) . '</font></td></tr>';
		}
		   }
			  ?>
                            <?php
                            
                            include "libchart/libchart/classes/libchart.php";
	$chart4 = new HorizontalBarChart(250, 500);
	$dataSet4 = new XYDataSet();
	$chart4->setDataSet($dataSet4);
	$chart4->getPlot()->setGraphPadding(new Padding(5, 30, 20, 25));
                            
                 //overall score
                 $link = mysqli_connect("localhost", "nggovern_Garki", "NgfBassi1!", "nggovern_dashboard");
if(mysqli_errno($link))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
				 mysqli_query($link, "SET SQL_BIG_SELECTS=1"); 
       		$sq1 ="SELECT 
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
				users.state, state.stateName, survey.num_offices, survey.internet, zone.zoneName, 
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
FROM state, survey, survey1, survey2, survey3, users, zone WHERE state.stateName = users.state AND survey.quarter = '" . $quarter . "' AND survey.year = '" . $year . "' AND survey1.quarter = '" . $quarter . "' AND survey1.year = '" . $year . "' AND survey2.quarter = '" . $quarter . "' AND survey2.year = '" . $year . "' AND survey3.quarter = '" . $quarter . "' AND survey3.year = '" . $year . "' AND zone.zoneId = '" . $zone . "' AND zone.zoneId = state.zoneId AND users.username = survey.mysession AND users.username = survey1.mysession AND users.username = survey2.mysession AND users.username = survey3.mysession ORDER BY state.stateName";
//echo $sql;
//$result = mysql_query($sq1) or die(mysql_error());
//$num_results = mysql_num_rows($result);
$result=mysqli_query($link, $sq1); //echo $result;
if($result === FALSE) { 
   die(mysqli_error($link)); // TODO: better error handling
}
	?>
            </table></td>
            <td width="12.5%" valign="top"><br><table border="0" cellspacing="0" class="status_table" width="100%">
              <tr>
                <td colspan="4" class="overall">OVERALL ASSESSMENT <?php echo '<i>(Year: '.$year.')</i>'; ?></td>
              </tr>
              <tr class="overall">
                <td>Rank/36</td>
                <td>State</td>
                <td>Score %</td>
                <td align="center">∆</td>
              </tr>
              <?php
              $rank = 0;
  $last_score = false;
  $rows = 0;
  
              $states =  array();
			  $taxOverscores = array();
			  $taxOverDiff = array();
			  
			  ?>
		<!-- New Chart -->
        <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ['State', 'Tax Administration', 'Tax Procedure', 'Tax Processing', 'Tax Enforcement'],
		  <?php
			  
			 while($rs=mysqli_fetch_array($result,MYSQLI_NUM)){
			 //while($rs=mysqli_fetch_array($sq1)){
			      $rows++;
		$sbirsmeet=$rs[0]; 
		$sbirspolicy=$rs[1];
		$sbirsgov=$rs[2];
		$sbirsscf=$rs[3];
		$sbirssha=$rs[4];
		$sbirschair=$rs[5];
		$naturepor=$rs[113];
		$naturepor1=$rs[136];
		$naturepor2=$rs[137];
		$naturepor3=$rs[138];
		$naturepor4=$rs[139];
		$natureporall=(($naturepor + $naturepor1 + $naturepor2 + $naturepor3 + $naturepor4)/9)*100;
		$orginstave=($sbirsmeet + $sbirspolicy + $sbirsgov + $sbirsscf + $sbirssha + $sbirschair +$natureporall)/7;
		$sbirsis=$rs[6];
		$sbirsfund=$rs[7];
		$sbirscost=$rs[8];
		$capcostcov=$rs[114];
		$budgetavailability=($sbirsis + $sbirsfund + $sbirscost + $capcostcov)/4;
		$sbirsemp=$rs[9];
		$taxstaff=$rs[10];
		$capacitybuilding=$rs[11];
		$attendedtraining=$rs[12];
		$traininprogram=$rs[13];
		$salstructure=$rs[14];
		$payscheme=$rs[15];
		$contractstaff=$rs[16];
		$performapp=$rs[115];
		$howoften=$rs[116];
		$remuneration=($sbirsemp + $taxstaff + $capacitybuilding + $attendedtraining + $traininprogram + $salstructure + $payscheme + $contractstaff + $performapp + $howoften)/10;
		$numoffices=$rs[109];
		$standardrptformat=$rs[112];
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
		$internet=$rs[110];
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
		$altertarget=$rs[117];
		$functionwebsite=$rs[118];
		$taxguide=$rs[119];
		$taxretform=$rs[120];
		$taxcalc=$rs[121];
		$taxregpack=$rs[122];
		$fieldoffadd=$rs[123];
		$contacthelp=$rs[124];
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
		$collatemdalevies=$rs[125];
		$collatelgalevies=$rs[126];
		$collectbyagent=$rs[127];
		$sbircollectmda=$rs[128];
		$conextaudit=$rs[129];
		$extaudit2013=$rs[130];
		$extaudit2014=$rs[131];
		$extaudit2015=$rs[132];
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
		$trainedauditor=$rs[133];
		$vaidsunit=$rs[134];
		$vaidstaff=$rs[135];
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
		$states[$rows]=$rs[108];
		$taxOverscores[$states[$rows]] = $overall;
		//Q2 - Q1
		$taxOverDiff[$states[$rows]] = $taxOverscores[$states[$rows]] - $taxOverscores10[$states[$rows]];
		
		$dataSet4->addPoint(new Point($rs[108],number_format($overall,2)));
		
		echo "['".$rs[108]."', ".number_format($taxadmin,2).", ".number_format($taxprocedure,2).", ".number_format($taxprocessing,2).", ".number_format($taxenforcem,2)."],";
			  }
           ?>
               ]);
	  
        var options = {
          chart: {
            title: 'States Performance',
            subtitle: 'Tax Administration, Tax Procedure, Tax Processing, and Tax Enforcement <?php echo ' ('.$quarter.', '.$year.')'; ?>',
          },
          bars: 'horizontal', // Required for Material Bar Charts.
          hAxis: {format: 'decimal'},
          height: 1000,
          colors: ['#943100', '#F30', '#066', '#06C']
        };

        var chart = new google.charts.Bar(document.getElementById('chart_div'));

        chart.draw(data, google.charts.Bar.convertOptions(options));

        var btns = document.getElementById('btn-group');

        btns.onclick = function (e) {

          if (e.target.tagName === 'BUTTON') {
            options.hAxis.format = e.target.id === 'none' ? '' : e.target.id;
            chart.draw(data, google.charts.Bar.convertOptions(options));
          }
        }
      }
    </script>
    
    <?php
		
  //  }
    
   

         $ranking = getRank($states,$taxOverscores,$taxOverDiff);
		  
		   for($i= 1; $i <= $rows; $i++)
           {
			   if(stripos($taxOverDiff[$states[$i]], '-') !== FALSE){
                echo '<tr>';
				echo '<td>' . $ranking[$states[$i]] . '</td><td>' . $states[$i] . '</td><td>' . number_format($taxOverscores[$states[$i]],2) . '</td><td align="center"><font color="#FF0000">' . number_format($taxOverDiff[$states[$i]],2) . '</font></td></tr>';
			   } else {
				   echo '<tr>';
				echo '<td>' . $ranking[$states[$i]] . '</td><td>' . $states[$i] . '</td><td>' . number_format($taxOverscores[$states[$i]],2) . '</td><td align="center"><font color="#009900">' . number_format($taxOverDiff[$states[$i]],2) . '</font></td></tr>';
			   }
		   }
			  ?>
              <?php
			  }
			  ?>
            </table></td>
          </tr>
          <tr>
            <td><?php
            //Hide charts
			 //$chart->setDataSet($dataSet);

	//$chart->setTitle("Tax Administration");
	//$chart->render("libchart/demo/generated/demo2.png");
			  ?>
                      <!--    <img alt="Horizontal bars chart"  src="libchart/demo/generated/demo2.png" style="border: 1px solid gray;"/> --></td>
            <td><?php
		//	 $chart1->setDataSet($dataSet1);

	//$chart1->setTitle("Tax Procedure");
	//$chart1->render("libchart/demo/generated/demo3.png");
			  ?>
                        <!--  <img alt="Horizontal bars chart"  src="libchart/demo/generated/demo3.png" style="border: 1px solid gray;"/> --></td>
            <td><?php
		//	 $chart2->setDataSet($dataSet2);

	//$chart2->setTitle("Tax Processing");
	//$chart2->render("libchart/demo/generated/demo4.png");
			  ?>
                      <!--    <img alt="Horizontal bars chart"  src="libchart/demo/generated/demo4.png" style="border: 1px solid gray;"/> --></td>
            <td><?php
		//	 $chart3->setDataSet($dataSet3);

	//$chart3->setTitle("Tax Enforcement");
//	$chart3->render("libchart/demo/generated/demo5.png");
			  ?>
                        <!--  <img alt="Horizontal bars chart"  src="libchart/demo/generated/demo5.png" style="border: 1px solid gray;"/> --></td>
            <td><?php
			// $chart4->setDataSet($dataSet4);

	//$chart4->setTitle("Overall Assessment");
	//$chart4->render("libchart/demo/generated/demo6.png");
			  ?>
                      <!--    <img alt="Horizontal bars chart"  src="libchart/demo/generated/demo6.png" style="border: 1px solid gray;"/> --></td>
            
          </tr>
        </table>
        <table width="100%">
        <tr><td colspan="2"></td></tr>
        <tr><td><div id="top_x_div" style="width: 550px; height: 500px;"></div></td><td><div id="top_y_div" style="width: 550px; height: 500px;"></div></td></tr>
        <tr><td colspan="2" height="30"><hr width="100%" /></td></tr>
        <tr><td>
        <div id="top_z_div" style="width: 550px; height: 500px;"></div></td><td><div id="top_w_div" style="width: 550px; height: 500px;"></div></td></tr></table>
        </td>
      </tr>
    </table></td>
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