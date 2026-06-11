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
<title>Tax Processing Report</title>
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
            
                <h2>Tax Processing Submissions</h2><hr/>
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
    <td colspan="33">&nbsp;</td>
    </tr>
  <tr class="mytrhead">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="30">Tax payment (cash paid to tax officers versus bank and electronic payment)</td>
    </tr>
  <tr class="mytrhead">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>44a. Is there a central platform for collection of taxes in the state?*</td>
    <td>If yes, describe how it works?</td>
    <td>44b. Does the platform collect ALL taxes, levies and charges including those of MDAs?</td>
    <td>44c. Does the platform collect ALL taxes, levies and charges including those of LGAs?</td>
    <td>45. Is the platform automated?*</td>
    <td colspan="2">46. Does it provide management and accounting information?*</td>
    <td>47a. Does the SIRS use agents/tax consultants to collect taxes/levies on their behalf?*</td>
    <td colspan="4">47b. If yes, are these:</td>
    <td>48a. Does any MDA collect taxes/levies/charges on behalf of the SIRS?*</td>
    <td>48b. If yes, which taxes/levies?</td>
    <td>49a. Does the SIRS collect any revenue on behalf of the Local Government?*</td>
    <td>49b. If yes, which taxes/levies?</td>
    <td>50. Does the SIRS collect all MDA revenues?*</td>
    <td>If yes, which taxes/levies?</td>
    <td>51a. What is the accounting mechanism?*</td>
    <td>51b. If No, what is the mechanism for the state?</td>
    <td>52a. What checks and balances for audit purposes?*</td>
    <td colspan="3">52b. If yes, has this been carried out for the following years?</td>
    <td>53a. Does the State conduct external audits for payments collected in respect of taxes and levies?*</td>
    <td colspan="3">53b. If yes, has this been carried out for the following years?</td>
    <td>54. Is there a revenue accounting department in the SIRS?*</td>
    <td>55. Is the revenue accounting department different from the assessment and tax collection department?*</td>
    </tr>
  <tr class="mytrhead">
    <td>S/No.</td>
    <td>Year</td>
    <td>State</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Online:</td>
    <td>In real time:</td>
    <td>&nbsp;</td>
    <td>Taxes collected by agents in addition to SIRS staff:</td>
    <td>Taxes exclusively collected by agents:</td>
    <td>Are the taxes etc collected by agents first paid into an escrow account?</td>
    <td>If Yes, which of the following taxes/levies are collected by agents/consultants: (please tick as apply)</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>2014</td>
    <td>2015</td>
    <td>2016</td>
    <td>&nbsp;</td>
    <td>2014</td>
    <td>2015</td>
    <td>2016</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <?php
		  //include("../connection.php");
		  $con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
		  $sql=mysqli_query($con, "SELECT users.username, users.state, survey2.survey_id, survey2.mysession, survey2.quarter, survey2.year,survey2.central_platform,survey2.platform_work,survey2.auto_platform,survey2.online_acc,survey2.realtime_acc,survey2.use_consultant,survey2.tax_agent,survey2.exclu_agent,survey2.levy_collect,survey2.levy_collect1,survey2.levy_collect2,survey2.levy_collect3,survey2.levy_collect4,survey2.levy_collect5,survey2.levy_collect6,survey2.other_tax,survey2.govt_dept,survey2.govtdept_levy,survey2.sbircollect_lg,survey2.sbircollectlg_levy,survey2.all_cases,survey2.state_mechanism,survey2.payment_audit,survey2.a2013_audit,survey2.a2014_audit,survey2.a2015_audit,survey2.conext_audit,survey2.a2013_extaudit,survey2.a2014_extaudit,survey2.a2015_extaudit,survey2.rev_dept,survey2.revdept_diff,survey2.collate_mda_levies,survey2.collate_lga_levies,survey2.collect_by_agent,survey2.sbircollect_mda,survey2.sbircollectmda_levy 
FROM users, survey2
WHERE users.username = survey2.mysession
ORDER BY survey2.year");
		  //$result=mysql_query($sql,$db) or die(mysql_error());
		  $i = 1;
		  while($row=mysqli_fetch_array($sql)) {
			  
				$year=$row['year']; 
		        $state=$row['state'];
				$central_platform=$row['central_platform'];
				if ($central_platform==4){$central_platform='Yes';}
				if ($central_platform==1){$central_platform='No';}
				else {}
				$platform_work=$row['platform_work'];
				$mysession=$row['mysession'];
				$auto_platform=$row['auto_platform'];
				if ($auto_platform==4){$auto_platform='Yes';}
				if ($auto_platform==1){$auto_platform='No';}
				else {}
				$online_acc=$row['online_acc'];
				if ($online_acc==4){$online_acc='Yes';}
				if ($online_acc==1){$online_acc='No';}
				else {}
				$realtime_acc=$row['realtime_acc'];
				if ($realtime_acc==6){$realtime_acc='Yes';}
				if ($realtime_acc==1){$realtime_acc='No';}
				else {}
				$use_consultant=$row['use_consultant'];
				if ($use_consultant==1){$use_consultant='Yes';}
				if ($use_consultant==4){$use_consultant='No';}
				else {}
				$tax_agent=$row['tax_agent'];
				if ($tax_agent==3){$tax_agent='Yes';}
				if ($tax_agent==1){$tax_agent='No';}
				else {}
				$exclu_agent=$row['exclu_agent'];
				if ($exclu_agent==1){$exclu_agent='Yes';}
				if ($exclu_agent==3){$exclu_agent='No';}
				else {}
				$levy_collect=$row['levy_collect'];
				if ($levy_collect==1){$levy_collect='Personal Income Tax';}
				else {}
				$levy_collect1=$row['levy_collect1'];
				if ($levy_collect1==1){$levy_collect1='Pay As You Earn (PAYE)';}
				else {}
				$levy_collect2=$row['levy_collect2'];
				if ($levy_collect2==1){$levy_collect2='Withholding Tax (WHT) (Individuals and partnerships)';}
				else {}
				$levy_collect3=$row['levy_collect3'];
				if ($levy_collect3==1){$levy_collect3='Sales Taxes';}
				else {}
				$levy_collect4=$row['levy_collect4'];
				if ($levy_collect4==1){$levy_collect4='Advertising Taxes';}
				else {}
				$levy_collect5=$row['levy_collect5'];
				if ($levy_collect5==1){$levy_collect5='Property Taxes';}
				else {}
				$levy_collect6=$row['levy_collect6'];
				if ($levy_collect6==1){$levy_collect6='Other Taxes/Levies, Please Specify';}
				else {}
				$other_tax=$row['other_tax'];
				$govt_dept=$row['govt_dept'];
				if ($govt_dept==2){$govt_dept='Yes';}
				if ($govt_dept==1){$govt_dept='No';}
				else {}
				$govtdept_levy=$row['govtdept_levy'];
				$sbircollect_lg=$row['sbircollect_lg'];
				if ($sbircollect_lg==3){$sbircollect_lg='Yes';}
				if ($sbircollect_lg==1){$sbircollect_lg='No';}
				else {}
				$sbircollectlg_levy=$row['sbircollectlg_levy'];
				$all_cases=$row['all_cases'];
				if ($all_cases==4){$all_cases='Yes';}
				if ($all_cases==1){$all_cases='No';}
				else {}
				$state_mechanism=$row['state_mechanism'];
				$payment_audit=$row['payment_audit'];
				if ($payment_audit==4){$payment_audit='Yes';}
				if ($payment_audit==1){$payment_audit='No';}
				else {}
				$y2013_audit=$row['a2013_audit'];
				if ($y2013_audit==4){$y2013_audit='Yes';}
				if ($y2013_audit==1){$y2013_audit='No';}
				else {}
				$y2014_audit=$row['a2014_audit'];
				if ($y2014_audit==4){$y2014_audit='Yes';}
				if ($y2014_audit==1){$y2014_audit='No';}
				else {}
				$y2015_audit=$row['a2015_audit'];
				if ($y2015_audit==4){$y2015_audit='Yes';}
				if ($y2015_audit==1){$y2015_audit='No';}
				else {}
				$conext_audit=$row['conext_audit'];
				if ($conext_audit==4){$conext_audit='Yes';}
				if ($conext_audit==1){$conext_audit='No';}
				else {}
				$y2013_extaudit=$row['a2013_extaudit'];
				if ($y2013_extaudit==4){$y2013_extaudit='Yes';}
				if ($y2013_extaudit==1){$y2013_extaudit='No';}
				else {}
				$y2014_extaudit=$row['a2014_extaudit'];
				if ($y2014_extaudit==4){$y2014_extaudit='Yes';}
				if ($y2014_extaudit==1){$y2014_extaudit='No';}
				else {}
				$y2015_extaudit=$row['a2015_extaudit'];
				if ($y2015_extaudit==4){$y2015_extaudit='Yes';}
				if ($y2015_extaudit==1){$y2015_extaudit='No';}
				else {}
				$rev_dept=$row['rev_dept'];
				if ($rev_dept==4){$rev_dept='Yes';}
				if ($rev_dept==1){$rev_dept='No';}
				else {}
				$revdept_diff=$row['revdept_diff'];
				if ($revdept_diff==4){$revdept_diff='Yes';}
				if ($revdept_diff==1){$revdept_diff='No';}
				else {}
				$collate_mda_levies=$row['collate_mda_levies'];
				if ($collate_mda_levies==4){$collate_mda_levies='Yes';}
				if ($collate_mda_levies==1){$collate_mda_levies='No';}
				else {}
				$collate_lga_levies=$row['collate_lga_levies'];
				if ($collate_lga_levies==4){$collate_lga_levies='Yes';}
				if ($collate_lga_levies==1){$collate_lga_levies='No';}
				else {}
				$collect_by_agent=$row['collect_by_agent'];
				if ($collect_by_agent==1){$collect_by_agent='Yes';}
				if ($collect_by_agent==3){$collect_by_agent='No';}
				else {}
				$sbircollect_mda=$row['sbircollect_mda'];
				if ($sbircollect_mda==3){$sbircollect_mda='Yes';}
				if ($sbircollect_mda==1){$sbircollect_mda='No';}
				else {}
				$sbircollectmda_levy=$row['sbircollectmda_levy'];
		
			  
		  ?>
  <tr class="mytr">
    <td><?php echo $i; $i++; ?></td>
    <td><?php echo $year; ?></td>
    <td><?php echo $state; ?></td>
    <td><?php echo $central_platform; ?></td>
    <td><?php echo $platform_work; ?></td>
    <td><?php echo $collate_mda_levies; ?></td>
    <td><?php echo $collate_lga_levies; ?></td>
    <td><?php echo $auto_platform; ?></td>
    <td><?php echo $online_acc; ?></td>
    <td><?php echo $realtime_acc; ?></td>
    <td><?php echo $use_consultant; ?></td>
    <td><?php echo $tax_agent; ?></td>
    <td><?php echo $exclu_agent; ?></td>
    <td><?php echo $collect_by_agent; ?></td>
    <td><?php echo $levy_collect.", ".$levy_collect1.", ".$levy_collect2.", ".$levy_collect3.", ".$levy_collect4.", ".$levy_collect5.", ".$levy_collect6.", ".$other_tax; ?></td>
    <td><?php echo $govt_dept; ?></td>
    <td><?php echo $govtdept_levy; ?></td>
    <td><?php echo $sbircollect_lg; ?></td>
    <td><?php echo $sbircollectlg_levy; ?></td>
    <td><?php echo $sbircollect_mda; ?></td>
    <td><?php echo $sbircollectmda_levy; ?></td>
    <td><?php echo $all_cases; ?></td>
    <td><?php echo $state_mechanism; ?></td>
    <td><?php echo $payment_audit; ?></td>
    <td><?php echo $y2013_audit; ?></td>
    <td><?php echo $y2014_audit; ?></td>
    <td><?php echo $y2015_audit; ?></td>
    <td><?php echo $conext_audit; ?></td>
    <td><?php echo $y2013_extaudit; ?></td>
    <td><?php echo $y2014_extaudit; ?></td>
    <td><?php echo $y2015_extaudit; ?></td>
    <td><?php echo $rev_dept; ?></td>
    <td><?php echo $revdept_diff; ?></td>
    </tr>
  <?php } ?>
</table>

</body>
</html>
