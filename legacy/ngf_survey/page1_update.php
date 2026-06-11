<?php
include("../connection.php");
$mode=$_GET["mode"];
if($mode=="update")
{
				$sbirs_meet=$_POST['sbirs_meet'];
				$sbirs_policy=$_POST['sbirs_policy'];
				$sbirs_gov=$_POST['sbirs_gov'];
				$sbirs_scf=$_POST['sbirs_scf'];
				$sbirs_sha=$_POST['sbirs_sha'];
				$sbirs_chair=$_POST['sbirs_chair'];
				$sbirs_is=$_POST['sbirs_is'];
				$sbirs_fund=$_POST['sbirs_fund'];
				$sbirs_cost=$_POST['sbirs_cost'];
				$sbirs_emp=$_POST['sbirs_emp'];
				$core_tax=$_POST['core_tax'];
				$support_role=$_POST['support_role'];
				$tax_staff=$_POST['tax_staff'];
				$capacity_building=$_POST['capacity_building'];
				$attended_training=$_POST['attended_training'];
				$trainin_program=$_POST['trainin_program'];
				$min_training=$_POST['min_training'];
				$sal_structure=$_POST['sal_structure'];
				$pay_scheme=$_POST['pay_scheme'];
				$contract_staff=$_POST['contract_staff'];
				$num_contract=$_POST['num_contract'];
				$num_political=$_POST['num_political'];
				$ad_hoc=$_POST['ad_hoc'];
				$num_adhoc=$_POST['num_adhoc'];
				$task=$_POST['task'];
				$num_offices=$_POST['num_offices'];
				$zone_num=$_POST['zone_num'];
				$full_ict=$_POST['full_ict'];
				$partial_ict=$_POST['partial_ict'];
				$no_ict=$_POST['no_ict'];
				$tech_staff=$_POST['tech_staff'];
				$internet=$_POST['internet'];
				$field_report=$_POST['field_report'];
				$field_report1=$_POST['field_report1'];
				$field_report2=$_POST['field_report2'];
				$field_report3=$_POST['field_report3'];
				$field_report4=$_POST['field_report4'];
				$report_method=$_POST['report_method'];
				$standardrpt_format=$_POST['standardrpt_format'];
				$sbirs_mship_top=$_POST['sbirs_mship_top'];
				$sbirs_mship_toplus=$_POST['sbirs_mship_toplus'];
				$ext_rep=$_POST['ext_rep'];
				$ext_govt=$_POST['ext_govt'];
				$ext_other=$_POST['ext_other'];
				$nature_por=$_POST['nature_por'];
				$nature_por1=$_POST['nature_por1'];
				$nature_por2=$_POST['nature_por2'];
				$nature_por3=$_POST['nature_por3'];
				$nature_por4=$_POST['nature_por4'];
				$cap_cost_cov=$_POST['cap_cost_cov'];
				$perform_app=$_POST['perform_app'];
				$how_often=$_POST['how_often'];
				$alter_target=$_POST['alter_target'];
				$function_website=$_POST['function_website'];
				$tax_guide=$_POST['tax_guide'];
				$tax_ret_form=$_POST['tax_ret_form'];
				$tax_calc=$_POST['tax_calc'];
				$tax_reg_pack=$_POST['tax_reg_pack'];
				$field_off_add=$_POST['field_off_add'];
				$contact_help=$_POST['contact_help'];
				$completed=$_POST['completed'];
				$surveyid=$_POST['surveyid'];
				if ($num_offices != $full_ict + $partial_ict + $no_ict) {
                    ?><script>alert('The total sum of values entered for questions 19(a)(i), 19(a)(ii), and 19(a)(iii) should be equal to the number of field offioces in the State, as stated in question 17.');</script><?php
					exit('close this current tab, click on View/Edit Submissions, select entry to edit, and then make valid entries for question 19');
                   //header("location: page1_update.php"); //redirecting to first page
                }
				if ($num_offices < $tech_staff) {
                    ?><script>alert('The total sum of values entered for question 19(b) cannot be more than the value entered in number of offices in question 17.');</script><?php
					exit('close this current tab, click on View/Edit Submissions, select entry to edit, and then make valid entries for question 19');
                }
				if ($num_offices < $internet) {
                    ?><script>alert('The total sum of values entered for question 19(c) cannot be more than the value entered in number of offices in question 17.');</script><?php
					exit('close this current tab, click on View/Edit Submissions, select entry to edit, and then make valid entries for question 19');
                }
$con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
$sql="update survey SET sbirs_meet='$sbirs_meet', sbirs_policy='$sbirs_policy', sbirs_gov='$sbirs_gov', sbirs_scf='$sbirs_scf', sbirs_sha='$sbirs_sha', sbirs_chair='$sbirs_chair', sbirs_is='$sbirs_is', sbirs_fund='$sbirs_fund', sbirs_cost='$sbirs_cost', sbirs_emp='$sbirs_emp', core_tax='$core_tax', support_role='$support_role', tax_staff='$tax_staff', capacity_building='$capacity_building', attended_training='$attended_training', trainin_program='$trainin_program', min_training='$min_training', sal_structure='$sal_structure', pay_scheme='$pay_scheme', contract_staff='$contract_staff', num_contract='$num_contract', num_political='$num_political', ad_hoc='$ad_hoc', num_adhoc='$num_adhoc', task='$task', num_offices='$num_offices', zone_num='$zone_num', full_ict='$full_ict', partial_ict='$partial_ict', no_ict='$no_ict', tech_staff='$tech_staff', internet='$internet', field_report='$field_report', field_report1='$field_report1', field_report2='$field_report2', field_report3='$field_report3', field_report4='$field_report4', report_method='$report_method', standardrpt_format='$standardrpt_format', sbirs_mship_top='$sbirs_mship_top', sbirs_mship_toplus='$sbirs_mship_toplus', ext_rep='$ext_rep', ext_govt='$ext_govt', ext_other='$ext_other', nature_por='$nature_por', nature_por1='$nature_por1', nature_por2='$nature_por2', nature_por3='$nature_por3', nature_por4='$nature_por4', cap_cost_cov='$cap_cost_cov', perform_app='$perform_app', how_often='$how_often', alter_target='$alter_target', function_website='$function_website', tax_guide='$tax_guide', tax_ret_form='$tax_ret_form', tax_calc='$tax_calc', tax_reg_pack='$tax_reg_pack', field_off_add='$field_off_add', contact_help='$contact_help', completed='$completed' WHERE survey_id='$surveyid'";
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