<?php
//Session starts here
session_start();
include_once '../connection.php';
if(!isset($_SESSION['user']))
{
 header("Location: login.php");
}
$privilege=$_SESSION['privilege'];
if ($privilege==5)
{
	echo "<p><font style='tahoma' color='red' size='3px'>Invalid user!</font></p><p><font style='tahoma' color='red' size='3px'>You do not have authorized access to this page</font></p>";
	exit();
}
$con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
$res=mysqli_query($con, "SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Tax Enforcement Report</title>
<script type="text/javascript" src="script.js"> </script>
        <link rel="stylesheet" href="style.css" />
       <style type="text/css">
        .mytr {
	font-family: 'Raleway', sans-serif;
	font-size: x-small;
	background-color: #CCC;
}
        .mytrhead {
	font-family: 'Raleway', sans-serif;
	font-size: 9px;
	font-weight: bold;
	color: #FFF;
	background-color: #000;
}
.mytitlehead{
	background-color: #CCFF99;
	padding: 32px;
	margin: 0 -50px;
	text-align: center;
	border-radius: 5px 5px 0 0;
}
        </style>
</head>

<body>
            
                <h2>Tax Enforcement Submissions</h2><hr/>
<span id="error">
			<!----Initializing Session for errors--->
                    <?php
                    if (!empty($_SESSION['error'])) {
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    }
                    ?>
</span>
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="outer_table">
  <tr>
    <td colspan="43">&nbsp;</td>
    </tr>
  <tr class="mytrhead">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="5">Capacity for taxpayer audits</td>
    <td colspan="6">High Net Worth Individuals (HNWI)</td>
    <td colspan="3">Other inter-agency cooperation</td>
    <td colspan="4">Tax Debt Enforcement:</td>
    <td colspan="6">Tax Awareness Campaigns</td>
    <td colspan="8">Complaints</td>
    <td colspan="2">Tax Harmonisation</td>
    <td colspan="4">User Charges for Public Services</td>
    <td colspan="4">Contact Detail</td>
    </tr>
  <tr class="mytrhead">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>56a. Has the state conducted taxpayer tax audits?*</td>
    <td>56b. If yes, has it been conducted in the last:</td>
    <td colspan="2">56c. If Yes - How many cases are:</td>
    <td>57. How many trained audit staff does the SBIRS have?*</td>
    <td>58. Is there a special unit for HNWI?*</td>
    <td>59a. Does the SIRS have any ongoing amnesty or compliance relief schemes for taxpayers?*</td>
    <td>59b. If yes, how many staff are responsible for such schemes?</td>
    <td>59c. How are such cases usually handled?</td>
    <td>60. Are the HNWI identified in the database?*</td>
    <td>61. Have actions been taken to assess and/or recover taxes from HNWI?*</td>
    <td>62a. Does the SBIRS lead or support the computation of the State’s IGR revenue forecast in the annual budget process?*</td>
    <td>62b. What is the level of inter-agency cooperation in tax collection and reporting?*</td>
    <td>63. Does the SBIRS make the presentation of TIN and Tax Clearance Certificate (TCC) mandatory for processing Driver's licences and number plates?</td>
    <td>64. Does the SBIRS have a tax debt enforcement department?*</td>
    <td>65. Are agents or consultants involved in collecting the outstanding taxes?*</td>
    <td>66. Has the SBIRS conducted any tax enforcement action either through the courts or by distrain action in the last one year?*</td>
    <td>66b. If yes, how many actions?</td>
    <td>67. Are taxpayers aware of the taxes they have to pay, the rates and the procedures for making a return and self-assessment?*</td>
    <td>68. Which of the following tax education programmes or channels has the SBIRS used in the last 12 months? (Tick all that apply)*</td>
    <td colspan="4">69. Do you evaluate the effectiveness of the different channels by increase in:*</td>
    <td>70a. Does the SIRS have a service charter?*</td>
    <td>70b. Please explain the usual process and the channel(s) for receiving and resolving taxpayer complaints</td>
    <td>70c. If no, what system do you use to track complaints and customer standards?</td>
    <td>71. Number of complaints handled in last 6 months* (Please note that complaints do not include objections to assessments. It is about complaints such as staff behaviour etc.)</td>
    <td>72. Number of process changes as a result of complaints in the last six months<span>*</span></label> <i>(Please note this does not include changes to assessments as a result of objections. They refer to internal processes only.)</td>
    <td>73. How long does it take to process TCCs?*</td>
    <td>74. In the last 12 months, what is the total number of complaints resolved in taxpayer favour?*</td>
    <td>75. In the last 12 months, what is the total number of complaints resolved in the SBIR's favour?*</td>
    <td>76a. Does the state have a consolidated revenue code?*</td>
    <td>76b. If yes, are all applicable taxes, fines, levies, and charges in the State harmonised?</td>
    <td>77. Does the State have charges for utilities? (Tick all that apply)*</td>
    <td>78. Does the State have charges for education?*</td>
    <td>79. Does the State have charges for health?*</td>
    <td>80. Please add any comments or areas you would like to expand on.*</td>
    <td colspan="4">81. Add contact detail of individual completing this form*</td>
    </tr>
  <tr class="mytrhead">
    <td>S/No.</td>
    <td>Year</td>
    <td>State</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Working?</td>
    <td>Concluded in the last one year</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>IGR?</td>
    <td>TIN Registration?</td>
    <td>Tax Appeal Tribunal (TAT Cases)?</td>
    <td>Complaints?</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Name:</td>
    <td>Designation:</td>
    <td>Phone Number:</td>
    <td>Email:</td>
    </tr>
  <?php
		  //include("../connection.php");
		  $con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
		  $sql=mysqli_query($con, "SELECT users.username, users.state, survey3.survey_id, survey3.mysession, survey3.quarter, survey3.year,survey3.last_conducted,survey3.working_cases,survey3.concluded_cases,survey3.taxpayer_audit,survey3.hnwi_unit,survey3.hnwi_id,survey3.hnwi_action,survey3.agency_coop,survey3.tin_tcc,survey3.debt_enforce,survey3.agent_involve,survey3.court_enforce,survey3.action_num,survey3.taxpayer_aware,survey3.tax_edu,survey3.tax_edu1,survey3.tax_edu2,survey3.tax_edu3,survey3.tax_edu4,survey3.tax_edu5,survey3.other_taxedu,survey3.igr_effect,survey3.tin_effect,survey3.tat_effect,survey3.complaint_effect,survey3.servicom,survey3.yes_servicom,survey3.complaint_num,survey3.no_servicom,survey3.process_num,survey3.process_timetcc,survey3.taxpayer_favor,survey3.sbirs_favor,survey3.sjtb_functioning,survey3.num_timemet,survey3.utility_charges,survey3.utility_charges1,survey3.utility_charges2,survey3.utility_charges3,survey3.utility_charges4,survey3.utility_charges5,survey3.utility_charges6,survey3.other_charges,survey3.edu_charges,survey3.health_charges,survey3.comment,survey3.trained_auditor,survey3.vaids_unit,survey3.vaid_staff,survey3.cd_name,survey3.cd_designation,survey3.cd_mobile,survey3.cd_email,survey3.case_handled,survey3.sirs_lead
FROM users, survey3
WHERE users.username = survey3.mysession
ORDER BY survey3.year");
		  //$result=mysql_query($sql,$db) or die(mysql_error());
		  $i = 1;
		  while($row=mysqli_fetch_array($sql)) {
			  
		$year=$row['year']; 
		$state=$row['state'];
		$last_conducted=$row['last_conducted'];
		if ($last_conducted==5){$last_conducted='Six months';}
		if ($last_conducted==3){$last_conducted='One year';}
				if ($last_conducted==1){$last_conducted='Never';}
				else {}
		if ($working_cases==5){$working_cases='Six month';}
				if ($working_cases==3){$working_cases='One year';}
				if ($working_cases==1){$working_cases='Never';}
				else {}
				$mysession=$row['mysession'];
				$working_cases=$row['working_cases'];
				if ($working_cases==1){$working_cases='1 - 10';}
				if ($working_cases==2){$working_cases='10 - 20';}
				if ($working_cases==4){$working_cases='20 - 50';}
				if ($working_cases==6){$working_cases='50+';}
				else {}
				$concluded_cases=$row['concluded_cases'];
				if ($concluded_cases==1){$concluded_cases='1 - 10';}
				if ($concluded_cases==2){$concluded_cases='10 - 20';}
				if ($concluded_cases==4){$concluded_cases='20 - 50';}
				if ($concluded_cases==6){$concluded_cases='50+';}
				else {}
				$taxpayer_audit=$row['taxpayer_audit'];
				if ($taxpayer_audit==4){$taxpayer_audit='Yes';}
				if ($taxpayer_audit==1){$taxpayer_audit='No';}
				else {}
				$hnwi_unit=$row['hnwi_unit'];
				if ($hnwi_unit==4){$hnwi_unit='Yes';}
				if ($hnwi_unit==1){$hnwi_unit='No';}
				else {}
				$hnwi_id=$row['hnwi_id'];
				if ($hnwi_id==4){$hnwi_id='Yes';}
				if ($hnwi_id==1){$hnwi_id='No';}
				else {}
				$hnwi_action=$row['hnwi_action'];
				if ($hnwi_action==4){$hnwi_action='Yes';}
				if ($hnwi_action==1){$hnwi_action='No';}
				else {}
				$agency_coop=$row['agency_coop'];
				if ($agency_coop==4){$agency_coop='Yes';}
				if ($agency_coop==1){$agency_coop='No';}
				else {}
				$tin_tcc=$row['tin_tcc'];
				if ($tin_tcc==4){$tin_tcc='Yes';}
				if ($tin_tcc==1){$tin_tcc='No';}
				else {}
				$debt_enforce=$row['debt_enforce'];
				if ($debt_enforce==4){$debt_enforce='Yes';}
				if ($debt_enforce==1){$debt_enforce='No';}
				else {}
				$agent_involve=$row['agent_involve'];
				if ($agent_involve==4){$agent_involve='Yes';}
				if ($agent_involve==1){$agent_involve='No';}
				else {}
				$court_enforce=$row['court_enforce'];
				if ($court_enforce==4){$court_enforce='Yes';}
				if ($court_enforce==1){$court_enforce='No';}
				else {}
				$action_num=$row['action_num'];
				if ($action_num==1){$action_num='0 -10 Enforcement actions';}
				if ($action_num==2){$action_num='10 – 20 Enforcement actions';}
				if ($action_num==4){$action_num='20 – 50 Enforcement actions';}
				if ($action_num==6){$action_num='50+ Enforcement actions';}
				else {}
				$taxpayer_aware=$row['taxpayer_aware'];
				if ($taxpayer_aware==4){$taxpayer_aware='Yes';}
				if ($taxpayer_aware==1){$taxpayer_aware='No';}
				if ($taxpayer_aware==2){$taxpayer_aware='Partially';}
				else {}
				$tax_edu=$row['tax_edu'];
				if ($tax_edu==1){$tax_edu='Newspapers';}
				else {}
				$tax_edu1=$row['tax_edu1'];
				if ($tax_edu1==1){$tax_edu1='Radio jingles';}
				else {}
				$tax_edu2=$row['tax_edu2'];
				if ($tax_edu2==1){$tax_edu2='TV programmes';}
				else {}
				$tax_edu3=$row['tax_edu3'];
				if ($tax_edu3==1){$tax_edu3='Road shows';}
				else {}
				$tax_edu4=$row['tax_edu4'];
				if ($tax_edu4==1){$tax_edu4='Workshops';}
				else {}
				$tax_edu5=$row['tax_edu5'];
				if ($tax_edu5==1){$tax_edu5='Other';}
				else {}
				$other_taxedu=$row['other_taxedu'];
				$igr_effect=$row['igr_effect'];
				if ($igr_effect==3){$igr_effect='Yes';}
				if ($igr_effect==1){$igr_effect='No';}
				else {}
				$tin_effect=$row['tin_effect'];
				if ($tin_effect==3){$tin_effect='Yes';}
				if ($tin_effect==1){$tin_effect='No';}
				else {}
				$tat_effect=$row['tat_effect'];
				if ($tat_effect==3){$tat_effect='Yes';}
				if ($tat_effect==1){$tat_effect='No';}
				else {}
				$complaint_effect=$row['complaint_effect'];
				if ($complaint_effect==3){$complaint_effect='Yes';}
				if ($complaint_effect==1){$complaint_effect='No';}
				else {}
				$servicom=$row['servicom'];
				if ($servicom==3){$servicom='Yes';}
				if ($servicom==1){$servicom='No';}
				else {}
				$yes_servicom=$row['yes_servicom'];
				$complaint_num=$row['complaint_num'];
				if ($complaint_num==1){$complaint_num='< 20';}
				if ($complaint_num==2){$complaint_num='20 - 50';}
				if ($complaint_num==5){$complaint_num='50+';}
				else {}
				$no_servicom=$row['no_servicom'];
				$process_num=$row['process_num'];
				if ($process_num==0){$process_num='0';}
				if ($process_num==1){$process_num='1';}
				if ($process_num==2){$process_num='3';}
				if ($process_num==5){$process_num='3+';}
				else {}
				$process_timetcc=$row['process_timetcc'];
				if ($process_timetcc==4){$process_timetcc='Same day';}
				if ($process_timetcc==3){$process_timetcc='1 - 2 weeks';}
				if ($process_timetcc==2){$process_timetcc='3 weeks';}
				if ($process_timetcc==1){$process_timetcc='Over 4 weeks';}
				else {}
				$taxpayer_favor=$row['taxpayer_favor'];
				$sbirs_favor=$row['sbirs_favor'];
				$sjtb_functioning=$row['sjtb_functioning'];
				if ($sjtb_functioning==4){$sjtb_functioning='Yes';}
				if ($sjtb_functioning==1){$sjtb_functioning='No';}
				else {}
				$num_timemet=$row['num_timemet'];
				if ($num_timemet==1){$num_timemet='No';}
				if ($num_timemet==4){$num_timemet='Yes';}
				//if ($num_timemet==3){$num_timemet='Quarterly';}
				//if ($num_timemet==2){$num_timemet='Annually';}
				//if ($num_timemet==1){$num_timemet='Never';}
				else {}
				$utility_charges=$row['utility_charges'];
				$utility_charges1=$row['utility_charges1'];
				$utility_charges2=$row['utility_charges2'];
				$utility_charges3=$row['utility_charges3'];
				$utility_charges4=$row['utility_charges4'];
				$utility_charges5=$row['utility_charges5'];
				$utility_charges6=$row['utility_charges6'];
				$other_charges=$row['other_charges'];
				$edu_charges=$row['edu_charges'];
				$health_charges=$row['health_charges'];
				$trained_auditor=$row['trained_auditor'];
				if ($trained_auditor==2){$trained_auditor='0 - 2';}
				if ($trained_auditor==3){$trained_auditor='3 - 5';}
				if ($trained_auditor==5){$trained_auditor='more than 5';}
				else {}
				$vaids_unit=$row['vaids_unit'];
				if ($vaids_unit==4){$vaids_unit='Yes';}
				if ($vaids_unit==1){$vaids_unit='No';}
				else {}
				$vaid_staff=$row['vaid_staff'];
				if ($vaid_staff==1){$vaid_staff='0 - 3';}
				if ($vaid_staff==3){$vaid_staff='3 - 9';}
				if ($vaid_staff==4){$vaid_staff='10+';}
				else {}
				$case_handled=$row['case_handled'];
				if ($case_handled==1){$case_handled='Other';}
				if ($case_handled==2){$case_handled='No special arrangement';}
				if ($case_handled==3){$case_handled='By a special team';}
				if ($case_handled==4){$case_handled='By the HNWI unit';}
				else {}
				$sirs_lead=$row['sirs_lead'];
				if ($sirs_lead==4){$sirs_lead='Yes';}
				if ($sirs_lead==1){$sirs_lead='No';}
				else {}
				$cd_name=$row['cd_name'];
				$cd_designation=$row['cd_designation'];
				$cd_mobile=$row['cd_mobile'];
				$cd_email=$row['cd_email'];
				$comment=$row['comment'];
		
			  
		  ?>
  <tr class="mytr">
    <td><?php echo $i; $i++; ?></td>
    <td><?php echo $year; ?></td>
    <td><?php echo $state; ?></td>
    <td><?php echo $taxpayer_audit; ?></td>
    <td><?php echo $last_conducted; ?></td>
    <td><?php echo $working_cases; ?></td>
    <td><?php echo $concluded_cases; ?></td>
    <td><?php echo $trained_auditor; ?></td>
    <td><?php echo $hnwi_unit; ?></td>
    <td><?php echo $vaids_unit; ?></td>
    <td><?php echo $vaid_staff; ?></td>
    <td><?php echo $case_handled; ?></td>
    <td><?php echo $hnwi_id; ?></td>
    <td><?php echo $hnwi_action; ?></td>
    <td><?php echo $sirs_lead; ?></td>
    <td><?php echo $agency_coop; ?></td>
    <td><?php echo $tin_tcc; ?></td>
    <td><?php echo $debt_enforce; ?></td>
    <td><?php echo $agent_involve; ?></td>
    <td><?php echo $court_enforce; ?></td>
    <td><?php echo $action_num; ?></td>
    <td><?php echo $taxpayer_aware; ?></td>
    <td><?php echo $tax_edu.", ".$tax_edu1.", ".$tax_edu2.", ".$tax_edu3.", ".$tax_edu4.", ".$tax_edu5.", ".$other_taxedu; ?></td>
    <td><?php echo $igr_effect; ?></td>
    <td><?php echo $tin_effect; ?></td>
    <td><?php echo $tat_effect; ?></td>
    <td><?php echo $complaint_effect; ?></td>
    <td><?php echo $servicom; ?></td>
    <td><?php echo $yes_servicom; ?></td>
    <td><?php echo $no_servicom; ?></td>
    <td><?php echo $complaint_num; ?></td>
    <td><?php echo $process_num; ?></td>
    <td><?php echo $process_timetcc; ?></td>
    <td><?php echo $taxpayer_favor; ?></td>
    <td><?php echo $sbirs_favor; ?></td>
    <td><?php echo $sjtb_functioning; ?></td>
    <td><?php echo $num_timemet; ?></td>
    <td><?php echo $utility_charges.", ".$utility_charges1.", ".$utility_charges2.", ".$utility_charges3.", ".$utility_charges4.", ".$utility_charges5.", ".$utility_charges6.", ".$other_charges; ?></td>
    <td><?php echo $edu_charges; ?></td>
    <td><?php echo $health_charges; ?></td>
    <td><?php echo $comment; ?></td>
    <td><?php echo $cd_name; ?></td>
    <td><?php echo $cd_designation; ?></td>
    <td><?php echo $cd_mobile; ?></td>
    <td><?php echo $cd_email; ?></td>
    
    </tr>
  <?php } ?>
</table>

</body>
</html>
