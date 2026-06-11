<?php
 
include("../connection.php");
$mode=$_GET["mode"];
if($mode=="update")
 
{
				$last_conducted=$_POST['last_conducted']; 
				$working_cases=$_POST['working_cases'];
				$concluded_cases=$_POST['concluded_cases'];
				$taxpayer_audit=$_POST['taxpayer_audit'];
				$hnwi_unit=$_POST['hnwi_unit'];
				$hnwi_id=$_POST['hnwi_id'];
				$hnwi_action=$_POST['hnwi_action'];
				$sirs_lead=$_POST['sirs_lead'];
				$agency_coop=$_POST['agency_coop'];
				$tin_tcc=$_POST['tin_tcc'];
				$debt_enforce=$_POST['debt_enforce'];
				$agent_involve=$_POST['agent_involve'];
				$court_enforce=$_POST['court_enforce'];
				$action_num=$_POST['action_num'];
				$taxpayer_aware=$_POST['taxpayer_aware'];
				$tax_edu=$_POST['tax_edu'];
				$tax_edu1=$_POST['tax_edu1'];
				$tax_edu2=$_POST['tax_edu2'];
				$tax_edu3=$_POST['tax_edu3'];
				$tax_edu4=$_POST['tax_edu4'];
				$tax_edu5=$_POST['tax_edu5'];
				$other_taxedu=$_POST['other_taxedu'];
				$igr_effect=$_POST['igr_effect'];
				$tin_effect=$_POST['tin_effect'];
				$tat_effect=$_POST['tat_effect'];
				$complaint_effect=$_POST['complaint_effect'];
				$servicom=$_POST['servicom'];
				$yes_servicom=$_POST['yes_servicom'];
				$complaint_num=$_POST['complaint_num'];
				$no_servicom=$_POST['no_servicom'];
				$process_num=$_POST['process_num'];
				$process_timetcc=$_POST['process_timetcc'];
				$taxpayer_favor=$_POST['taxpayer_favor'];
				$sbirs_favor=$_POST['sbirs_favor'];
				$sjtb_functioning=$_POST['sjtb_functioning'];
				$num_timemet=$_POST['num_timemet'];
				$utility_charges=$_POST['utility_charges'];
				$utility_charges1=$_POST['utility_charges1'];
				$utility_charges2=$_POST['utility_charges2'];
				$utility_charges3=$_POST['utility_charges3'];
				$utility_charges4=$_POST['utility_charges4'];
				$utility_charges5=$_POST['utility_charges5'];
				$utility_charges6=$_POST['utility_charges6'];
				$other_charges=$_POST['other_charges'];
				$edu_charges=$_POST['edu_charges'];
				$health_charges=$_POST['health_charges'];
				$comment=$_POST['comment'];
				$trained_auditor=$_POST['trained_auditor'];
				$vaids_unit=$_POST['vaids_unit'];
				$vaid_staff=$_POST['vaid_staff'];
				$case_handled=$_POST['case_handled'];
				$cd_name=$_POST['cd_name'];
				$cd_designation=$_POST['cd_designation'];
				$cd_mobile=$_POST['cd_mobile'];
				$cd_email=$_POST['cd_email'];
				$completed=$_POST['completed'];
				$surveyid=$_POST['surveyid'];
 
$con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
$sql="update survey3 SET last_conducted='$last_conducted', working_cases='$working_cases', concluded_cases='$concluded_cases', taxpayer_audit='$taxpayer_audit', hnwi_unit='$hnwi_unit', hnwi_id='$hnwi_id', hnwi_action='$hnwi_action', sirs_lead='$sirs_lead', agency_coop='$agency_coop', tin_tcc='$tin_tcc', debt_enforce='$debt_enforce', agent_involve='$agent_involve', court_enforce='$court_enforce', action_num='$action_num', taxpayer_aware='$taxpayer_aware', tax_edu='$tax_edu', tax_edu1='$tax_edu1',tax_edu2='$tax_edu2', tax_edu3='$tax_edu3', tax_edu4='$tax_edu4', tax_edu5='$tax_edu5', other_taxedu='$other_taxedu', igr_effect='$igr_effect', tin_effect='$tin_effect', tat_effect='$tat_effect', complaint_effect='$complaint_effect', servicom='$servicom', yes_servicom='$yes_servicom', complaint_num='$complaint_num', no_servicom='$no_servicom', process_num='$process_num', process_timetcc='$process_timetcc', taxpayer_favor='$taxpayer_favor', sbirs_favor='$sbirs_favor', sjtb_functioning='$sjtb_functioning', num_timemet='$num_timemet', utility_charges='$utility_charges', utility_charges1='$utility_charges1', utility_charges2='$utility_charges2', utility_charges3='$utility_charges3', utility_charges4='$utility_charges4', utility_charges5='$utility_charges5', utility_charges6='$utility_charges6', other_charges='$other_charges', edu_charges='$edu_charges', health_charges='$health_charges', comment='$comment', trained_auditor='$trained_auditor', vaids_unit='$vaids_unit', vaid_staff='$vaid_staff', case_handled='$case_handled', cd_name='$cd_name', cd_designation='$cd_designation', cd_mobile='$cd_mobile', cd_email='$cd_email', completed='$completed' WHERE survey_id='$surveyid'";
 
//	$result=mysql_query($sql,$db) or die(mysql_error());
				if (mysqli_query($con, $sql)) {
      header("location: submitted_view.php");
   } else {
      echo "Error updating record: " . mysqli_error($con);
   }
   mysqli_close($con);
		//	header("location: submitted_view.php");
		  }
		  ?>