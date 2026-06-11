<?php
 
include("../connection.php");
$mode=$_GET["mode"];
if($mode=="update")
 
{
				$central_platform=$_POST['central_platform']; //echo $tin_database;
				$platform_work=$_POST['platform_work'];
				$auto_platform=$_POST['auto_platform'];
				$online_acc=$_POST['online_acc'];
				$realtime_acc=$_POST['realtime_acc'];
				$use_consultant=$_POST['use_consultant'];
				$tax_agent=$_POST['tax_agent'];
				$exclu_agent=$_POST['exclu_agent'];
				$levy_collect=$_POST['levy_collect'];
				$levy_collect1=$_POST['levy_collect1'];
				$levy_collect2=$_POST['levy_collect2'];
				$levy_collect3=$_POST['levy_collect3'];
				$levy_collect4=$_POST['levy_collect4'];
				$levy_collect5=$_POST['levy_collect5'];
				$levy_collect6=$_POST['levy_collect6'];
				$other_tax=$_POST['other_tax'];
				$govt_dept=$_POST['govt_dept'];
				$govtdept_levy=$_POST['govtdept_levy'];
				$sbircollect_lg=$_POST['sbircollect_lg'];
				$sbircollectlg_levy=$_POST['sbircollectlg_levy'];
				$all_cases=$_POST['all_cases'];
				$state_mechanism=$_POST['state_mechanism'];
				$payment_audit=$_POST['payment_audit'];
				$audit_2013=$_POST['audit_2013'];
				$audit_2014=$_POST['audit_2014'];
				$audit_2015=$_POST['audit_2015'];
				$conext_audit=$_POST['conext_audit'];
				$extaudit_2013=$_POST['extaudit_2013'];
				$extaudit_2014=$_POST['extaudit_2014'];
				$extaudit_2015=$_POST['extaudit_2015'];
				$rev_dept=$_POST['rev_dept'];
				$revdept_diff=$_POST['revdept_diff'];
				$collate_mda_levies=$_POST['collate_mda_levies'];
				$collate_lga_levies=$_POST['collate_lga_levies'];
				$collect_by_agent=$_POST['collect_by_agent'];
				$sbircollect_mda=$_POST['sbircollect_mda'];
				$sbircollectmda_levy=$_POST['sbircollectmda_levy'];
				$completed=$_POST['completed'];
				$surveyid=$_POST['surveyid'];
 
$con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
$sql="update survey2 SET central_platform='$central_platform', platform_work='$platform_work', auto_platform='$auto_platform', online_acc='$online_acc', realtime_acc='$realtime_acc', use_consultant='$use_consultant', tax_agent='$tax_agent', exclu_agent='$exclu_agent', levy_collect='$levy_collect', levy_collect1='$levy_collect1', levy_collect2='$levy_collect2', levy_collect3='$levy_collect3', levy_collect4='$levy_collect4', levy_collect5='$levy_collect5', levy_collect6='$levy_collect6', other_tax='$other_tax', govt_dept='$govt_dept', govtdept_levy='$govtdept_levy', sbircollect_lg='$sbircollect_lg', sbircollectlg_levy='$sbircollectlg_levy', all_cases='$all_cases', state_mechanism='$state_mechanism', payment_audit='$payment_audit', a2013_audit='$audit_2013', a2014_audit='$audit_2014', a2015_audit='$audit_2015', conext_audit='$conext_audit', a2013_extaudit='$extaudit_2013', a2014_extaudit='$extaudit_2014', a2015_extaudit='$extaudit_2015', rev_dept='$rev_dept', revdept_diff='$revdept_diff', collate_mda_levies='$collate_mda_levies', collate_lga_levies='$collate_lga_levies', collect_by_agent='$collect_by_agent', sbircollect_mda='$sbircollect_mda', sbircollectmda_levy='$sbircollectmda_levy', completed='$completed' WHERE survey_id='$surveyid'";
 
	//$result=mysql_query($sql,$db) or die(mysql_error());
		if (mysqli_query($con, $sql)) {
      header("location: submitted_view.php");
   } else {
      echo "Error updating record: " . mysqli_error($con);
   }
   mysqli_close($con);
		//	header("location: submitted_view.php");
		  }
		  ?>