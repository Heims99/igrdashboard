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
<title>Tax Administration Report</title>
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
            
                <h2>Tax Administration Submissions</h2><hr/>
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
    <td colspan="48">&nbsp;</td>
    </tr>
  <tr class="mytrhead">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="10">Organisational and Institutional Arrangements</td>
    <td colspan="4">Availability and Sufficiency of SIRS Budget</td>
    <td colspan="18">Salary Incentives, SIRS Staffs' Skills and Training Levels</td>
    <td colspan="13">SIRS Outreach in Districts (Number of Tax Offices)</td>
  </tr>
  <tr class="mytrhead">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">1. What is the composition of the Board of the SIRS?</td>
    <td>2. The Board of the SIRS meets:*</td>
    <td>3a. The Board/SIRS issues policy and regulatory guidance:*</td>
    <td>3b. What is the nature of the policy/regulatory guidance? (tick as apply):*</td>
    <td>4. The Board/SIRS reports to the Governor:*</td>
    <td>5. The Board/SIRS reports to the State Commissioner of Finance*</td>
    <td>6. The Board/SIRS reports to the State House of Assembly:*</td>
    <td>7. The Executive Chairman of the SIRS has a relevant professional qualification and/or experience:*</td>
    <td>8. The SIRS is:*</td>
    <td>9a. The SIRS is funded:*</td>
    <td>9b. The funding covers operating costs:*</td>
    <td>10. How are capital costs covered?*</td>
    <td>11a. What is the number of the SIRS employees?*</td>
    <td>11b. How many of the staff are in core tax roles?</td>
    <td>11c. How many are in support roles (i.e.. non-tax)?</td>
    <td>11d. Number of staff with professional tax qualification (certified by FIRS, JTB, CITN etc):*</td>
    <td>12. Has the SIRS undertaken any capacity building programme facilitated by experts?*</td>
    <td>13. When was the last JTB Inspector of Taxes training conducted for the SIRS technical staff?*</td>
    <td>14a. Is there a training programme for all staff or only technical staff?*</td>
    <td>14b. What is the minimum number of trainings per staff to be attended annually: 1, 2, 3 or 4.</td>
    <td>15. Does the SIRS have a separate salary/incentive structure from the civil service?*</td>
    <td>16a. Does the SIRS conduct performance appraisals?*</td>
    <td>16b. If Yes, How often?</td>
    <td>17. Does the SIRS have any performance pay scheme(s)?*</td>
    <td>18a. Does the SIRS have any contracted staff on a special salary scale?*</td>
    <td>18b. If yes, how many?</td>
    <td>19. How many of the SIRS staff are political appointees?*</td>
    <td>20a. Does the SIRS have ad hoc or temporary staff?*</td>
    <td>20b. If yes, how many?</td>
    <td>20c. What task(s) do they carry out?</td>
    <td>21. How many field offices does the SIRS have?*</td>
    <td>22. Does the SIRS have a field office in each local government?*</td>
    <td colspan="3">23a. How many field offices have the following: (please insert numbers that apply)*</td>
    <td>23b. How many field offices have technically trained staff?</td>
    <td>23c. How many field offices have internet connection?</td>
    <td>24a. What is the frequency for field offices to submit reports: (tick as apply)*</td>
    <td>24b. How are the reports submitted?</td>
    <td>24c. Has any process been altered due to reports submitted in the last year?</td>
    <td>25. Is there a standard format for most reports?</td>
    <td>26a. Does the SIRS own a functional and up-to-date website?</td>
    <td>26b. If yes, which of these are domiciled on the website? (tick as apply)</td>
  </tr>
  <tr class="mytrhead">
    <td>S/No.</td>
    <td>Year</td>
    <td>State</td>
    <td>Top management of the SIRS only?*</td>
    <td>Top management of SIRS plus non-SIRS members?*</td>
    <td>If Yes, who are the external members?</td>
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
    <td>23a(i). Full ICT capability</td>
    <td>23a(ii). Partial ICT capability</td>
    <td>23a(iii). No ICT capability</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
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
		  $sql=mysqli_query($con, "SELECT users.username, users.state, survey.survey_id, survey.mysession, survey.quarter, survey.year,survey.sbirs_meet,survey.sbirs_policy,survey.sbirs_gov,survey.sbirs_scf,survey.sbirs_sha,survey.sbirs_chair,survey.sbirs_is,survey.sbirs_fund,survey.sbirs_cost,survey.sbirs_emp,survey.core_tax,survey.support_role,survey.tax_staff,survey.capacity_building,survey.attended_training,survey.trainin_program,survey.min_training,survey.sal_structure,survey.pay_scheme,survey.contract_staff,survey.num_contract,survey.num_political,survey.ad_hoc,survey.num_adhoc,survey.task,survey.num_offices,survey.zone_num,survey.full_ict,survey.partial_ict,survey.no_ict,survey.tech_staff,survey.internet,survey.field_report,survey.field_report1,survey.field_report2,survey.field_report3,survey.field_report4,survey.report_method,survey.standardrpt_format,survey.sbirs_mship_top,survey.sbirs_mship_toplus,survey.ext_rep,survey.ext_govt,survey.ext_other,survey.nature_por,survey.nature_por1,survey.nature_por2,survey.nature_por3,survey.nature_por4,survey.cap_cost_cov,survey.perform_app,survey.how_often,survey.alter_target,survey.function_website,survey.tax_guide,survey.tax_ret_form,survey.tax_calc,survey.tax_reg_pack,field_off_add,survey.contact_help 
FROM users, survey
WHERE users.username = survey.mysession
ORDER BY survey.year");
		  //$result=mysql_query($sql,$db) or die(mysql_error());
		  $i = 1;
		  while($row=mysqli_fetch_array($sql)) {
			  
		$year=$row['year']; 
		$state=$row['state'];
		$sbirs_mship_top=$row['sbirs_mship_top'];
		$sbirs_mship_toplus=$row['sbirs_mship_toplus'];
		$ext_rep=$row['ext_rep']; 
		$ext_govt=$row['ext_govt'];
		$ext_other=$row['ext_other'];
		$sbirs_meet=$row['sbirs_meet'];
		if ($sbirs_meet==5){$sbirs_meet='Monthly';}
		if ($sbirs_meet==4){$sbirs_meet='Weekly';}
		if ($sbirs_meet==3){$sbirs_meet='Quarterly';}
		if ($sbirs_meet==2){$sbirs_meet='Ad hoc';}
		if ($sbirs_meet==1){$sbirs_meet='Never';}
		else {}
		$sbirs_policy=$row['sbirs_policy'];
		if ($sbirs_policy==3){$sbirs_policy='Regularly';}
		if ($sbirs_policy==2){$sbirs_policy='Ad hoc';}
		if ($sbirs_policy==1){$sbirs_policy='Never';}
		else {}
		$nature_por=$row['nature_por']; 
		if ($nature_por==1){$nature_por='Tax policy changes';}
		else {$nature_por='0';}
		$nature_por1=$row['nature_por1'];
		if ($nature_por1==1){$nature_por1='Tax guidance for staff';}
		else {$nature_por1='0';}
		$nature_por2=$row['nature_por2'];
		if ($nature_por2==1){$nature_por2='Tax guidance for public';}
		else {$nature_por2='0';}
		$nature_por3=$row['nature_por3'];
		if ($nature_por3==1){$nature_por3='Non-tax staff guidance (HR policy)';}
		else {$nature_por3='0';}
		$nature_por4=$row['nature_por4'];
		if ($nature_por4==1){$nature_por4='Other';}
		else {$nature_por4='0';}
		$sbirs_gov=$row['sbirs_gov'];
		if ($sbirs_gov==5){$sbirs_gov='Weekly';}
		if ($sbirs_gov==4){$sbirs_gov='Monthly';}
		if ($sbirs_gov==3){$sbirs_gov='Quarterly';}
		if ($sbirs_gov==2){$sbirs_gov='Annually';}
		if ($sbirs_gov==1){$sbirs_gov='Never';}
		else {}
		$sbirs_scf=$row['sbirs_scf'];
		if ($sbirs_scf==5){$sbirs_scf='Weekly';}
		if ($sbirs_scf==4){$sbirs_scf='Monthly';}
		if ($sbirs_scf==3){$sbirs_scf='Quarterly';}
		if ($sbirs_scf==2){$sbirs_scf='Annually';}
		if ($sbirs_scf==1){$sbirs_scf='Never';}
		else {}
		$sbirs_sha=$row['sbirs_sha'];
		if ($sbirs_sha==5){$sbirs_sha='Weekly';}
		if ($sbirs_sha==2){$sbirs_sha='Monthly';}
		if ($sbirs_sha==3){$sbirs_sha='Quarterly';}
		if ($sbirs_sha==4){$sbirs_sha='Annually';}
		if ($sbirs_sha==1){$sbirs_sha='Ad hoc';}
		//if ($sbirs_sha==0){$sbirs_sha='Never';}
		else {$sbirs_sha='Never';}
		$sbirs_chair=$row['sbirs_chair'];
		if ($sbirs_chair==2){$sbirs_chair='Yes';}
		if ($sbirs_chair==1){$sbirs_chair='No';}
		else {}
		$sbirs_is=$row['sbirs_is'];
		if ($sbirs_is==3){$sbirs_is='Autonomous (full implementation of a law)';}
		if ($sbirs_is==2){$sbirs_is='Semi-autonomous (partial implementation of a law)';}
		if ($sbirs_is==1){$sbirs_is='A department or agency (no law in place)';}
		else {}
		$sbirs_fund=$row['sbirs_fund'];
		if ($sbirs_fund==5){$sbirs_fund='With a percentage of collection';}
		if ($sbirs_fund==4){$sbirs_fund='By appropriation in the state budget';}
		if ($sbirs_fund==3){$sbirs_fund='With a fixed sum from collection';}
		if ($sbirs_fund==2){$sbirs_fund='With a combination of income from collection while salaries are covered by the civil service';}
		else {}
		$sbirs_cost=$row['sbirs_cost'];
		if ($sbirs_cost==3){$sbirs_cost='Yes';}
		if ($sbirs_cost==2){$sbirs_cost='Partially';}
		if ($sbirs_cost==1){$sbirs_cost='No';}
		else {}
		$cap_cost_cov=$row['cap_cost_cov'];
		if ($cap_cost_cov==5){$cap_cost_cov='Regular funding from budget/cost of collection?';}
		if ($cap_cost_cov==3){$cap_cost_cov='Special funding by State government?';}
		if ($cap_cost_cov==2){$cap_cost_cov='Development partners?';}
		if ($cap_cost_cov==1){$cap_cost_cov='None';}
		else {}
		$sbirs_emp=$row['sbirs_emp'];
		if ($sbirs_emp==6){$sbirs_emp='1000+';}
		if ($sbirs_emp==4){$sbirs_emp='600 - 1000';}
		if ($sbirs_emp==3){$sbirs_emp='400 - 600';}
		if ($sbirs_emp==2){$sbirs_emp='200 - 400';}
		if ($sbirs_emp==1){$sbirs_emp='100 - 200';}
		else {}
		$core_tax=$row['core_tax'];
		$support_role=$row['support_role'];
		$tax_staff=$row['tax_staff'];
		if ($tax_staff==1){$tax_staff='1 to 10';}
		if ($tax_staff==2){$tax_staff='11 to 25';}
		if ($tax_staff==3){$tax_staff='26 to 50';}
		if ($tax_staff==4){$tax_staff='51 to 100';}
		if ($tax_staff==5){$tax_staff='100+';}
		else {}
		$capacity_building=$row['capacity_building'];
		if ($capacity_building==4){$capacity_building='In the last 6months';}
		if ($capacity_building==3){$capacity_building='In the last year';}
		if ($capacity_building==2){$capacity_building='More than 1 year ago';}
		if ($capacity_building==1){$capacity_building='Never';}
		else {}
		$attended_training=$row['attended_training'];
		if ($attended_training==3){$attended_training='Last year';}
		if ($attended_training==2){$attended_training='Last 2 years';}
		if ($attended_training==1){$attended_training='Last 5 years';}
		else {}
		$trainin_program=$row['trainin_program'];
		if ($trainin_program==4){$trainin_program='All staff';}
		if ($trainin_program==3){$trainin_program='Technical staff only';}
		//if ($trainin_program==0){$trainin_program='Ad-hoc';}
		else {$trainin_program='Ad-hoc';}
		$min_training=$row['min_training'];
		$sal_structure=$row['sal_structure'];
		if ($sal_structure==3){$sal_structure='Yes';}
		if ($sal_structure==1){$sal_structure='No';}
		else {}
		$perform_app=$row['perform_app'];
		if ($perform_app==3){$perform_app='Yes';}
		if ($perform_app==1){$perform_app='No';}
		else {}
		$how_often=$row['how_often'];
		if ($how_often==3){$how_often='Monthly';}
		if ($how_often==2){$how_often='Quarterly';}
		if ($how_often==1){$how_often='Anually';}
		else {}
		$pay_scheme=$row['pay_scheme'];
		if ($pay_scheme==3){$pay_scheme='Yes';}
		if ($pay_scheme==1){$pay_scheme='No';}
		else {}
		$contract_staff=$row['contract_staff'];
		if ($contract_staff==1){$contract_staff='Yes';}
		if ($contract_staff==3){$contract_staff='No';}
		else {}
		$num_contract=$row['num_contract'];
		$num_political=$row['num_political'];
		$ad_hoc=$row['ad_hoc'];
		$num_adhoc=$row['num_adhoc'];
		$task=$row['task'];
		$num_offices=$row['num_offices'];
		$zone_num=$row['zone_num'];
		if ($zone_num==3){$zone_num='Yes';}
		if ($zone_num==1){$zone_num='No';}
		else {}
		$full_ict=$row['full_ict'];
		$partial_ict=$row['partial_ict'];
		$no_ict=$row['no_ict'];
		$tech_staff=$row['tech_staff'];
		$internet=$row['internet'];
		$field_report=$row['field_report']; 
		if ($field_report==5){$field_report='Weekly';}
		else {}
		$field_report1=$row['field_report1'];
		if ($field_report1==4){$field_report1='Monthly';}
		else {}
		$field_report2=$row['field_report2'];
		if ($field_report2==3){$field_report2='Quarterly';}
		else {}
		$field_report3=$row['field_report3'];
		if ($field_report3==2){$field_report3='Ad hoc';}
		else {}
		$field_report4=$row['field_report4'];
		if ($field_report4==1){$field_report4='Never';}
		else {}
		$report_method=$row['report_method'];
		if ($report_method==3){$report_method='Electronically';}
		if ($report_method==2){$report_method='Paper';}
		if ($report_method==3){$report_method='Both';}
		else {}
		$alter_target=$row['alter_target'];
		if ($alter_target==3){$alter_target='Yes';}
		if ($alter_target==1){$alter_target='No';}
		else {}
		$standardrpt_format=$row['standardrpt_format'];
		if ($standardrpt_format==3){$standardrpt_format='Yes';}
		if ($standardrpt_format==1){$standardrpt_format='No';}
		else {}
		$function_website=$row['function_website'];
		if ($function_website==3){$function_website='Yes';}
		if ($function_website==1){$function_website='No';}
		else {}
		$tax_guide=$row['tax_guide']; 
		if ($tax_guide==1){$tax_guide='Tax guides';}
		else {}
		$tax_ret_form=$row['tax_ret_form'];
		if ($tax_ret_form==1){$tax_ret_form='Tax return form';}
		else {}
		$tax_calc=$row['tax_calc'];
		if ($tax_calc==1){$tax_calc='Tax calculator';}
		else {}
		$tax_reg_pack=$row['tax_reg_pack'];
		if ($tax_reg_pack==1){$tax_reg_pack='Tax registeration pack';}
		else {}
		$field_off_add=$row['field_off_add'];
		if ($field_off_add==1){$field_off_add='Field office addresses';}
		else {}
		$contact_help=$row['contact_help'];
		if ($contact_help==1){$contact_help='Contact center details/enquiry lines';}
		else {}
		
			  
		  ?>
  <tr class="mytr">
    <td><?php echo $i; $i++; ?></td>
    <td><?php echo $year; ?></td>
    <td><?php echo $state; ?></td>
    <td><?php echo $sbirs_mship_top; ?></td>
    <td><?php echo $sbirs_mship_toplus; ?></td>
    <td><?php echo $ext_rep. ', '. $ext_govt. ', '. $ext_other; ?></td>
    <td><?php echo $sbirs_meet; ?></td>
    <td><?php echo $sbirs_policy; ?></td>
    <td><?php echo $nature_por. ', '. $nature_por1. ', '. $nature_por2. ', '. $nature_por3. ', '. $nature_por4; ?></td>
    <td><?php echo $sbirs_gov; ?></td>
    <td><?php echo $sbirs_scf; ?></td>
    <td><?php echo $sbirs_sha; ?></td>
    <td><?php echo $sbirs_chair; ?></td>
    <td><?php echo $sbirs_is; ?></td>
    <td><?php echo $sbirs_fund; ?></td>
    <td><?php echo $sbirs_cost; ?></td>
    <td><?php echo $cap_cost_cov; ?></td>
    <td><?php echo $sbirs_emp; ?></td>
    <td><?php echo $core_tax; ?></td>
    <td><?php echo $support_role; ?></td>
    <td><?php echo $tax_staff; ?></td>
    <td><?php echo $capacity_building; ?></td>
    <td><?php echo $attended_training; ?></td>
    <td><?php echo $trainin_program; ?></td>
    <td><?php echo $min_training; ?></td>
    <td><?php echo $sal_structure; ?></td>
    <td><?php echo $perform_app; ?></td>
    <td><?php echo $how_often; ?></td>
    <td><?php echo $pay_scheme; ?></td>
    <td><?php echo $contract_staff; ?></td>
    <td><?php echo $num_contract; ?></td>
    <td><?php echo $num_political; ?></td>
    <td><?php echo $ad_hoc; ?></td>
    <td><?php echo $num_adhoc; ?></td>
    <td><?php echo $task; ?></td>
    <td><?php echo $num_offices; ?></td>
    <td><?php echo $zone_num; ?></td>
    <td><?php echo $full_ict; ?></td>
    <td><?php echo $partial_ict; ?></td>
    <td><?php echo $no_ict; ?></td>
    <td><?php echo $tech_staff; ?></td>
    <td><?php echo $internet; ?></td>
    <td><?php echo $field_report. ', '. $field_report1. ', '. $field_report2. ', '. $field_report3. ', '. $field_report4; ?></td>
    <td><?php echo $report_method; ?></td>
    <td><?php echo $alter_target; ?></td>
    <td><?php echo $standardrpt_format; ?></td>
    <td><?php echo $function_website; ?></td>
    <td><?php echo $tax_guide. ', '. $tax_ret_form. ', '; echo $tax_calc. ', '. $tax_reg_pack. ', '. $field_off_add. ', '. $contact_help; ?></td>
  </tr>
  <?php } ?>
</table>

</body>
</html>
