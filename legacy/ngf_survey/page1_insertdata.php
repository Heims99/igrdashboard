<?php
session_start();
//checking first page values for empty,If it finds any blank field then redirected to first page
if (isset($_POST['sbirs_meet'])){
    if (empty($_POST['sbirs_meet'])
	|| empty($_POST['mysession'])
	|| empty($_POST['quarter'])
	|| empty($_POST['year'])
	//|| empty($_POST['sbirs_policy'])
	/*|| empty($_POST['sbirs_gov'])
	|| empty($_POST['sbirs_scf'])
	|| empty($_POST['sbirs_sha'])
	|| empty($_POST['sbirs_chair'])
	|| empty($_POST['sbirs_is'])
	|| empty($_POST['sbirs_fund'])
	|| empty($_POST['sbirs_cost'])
	|| empty($_POST['sbirs_emp'])
	|| empty($_POST['core_tax'])
	|| empty($_POST['support_role'])
	|| empty($_POST['tax_staff'])
	|| empty($_POST['capacity_building'])
	|| empty($_POST['attended_training'])
	|| empty($_POST['sal_structure'])
	|| empty($_POST['pay_scheme'])
	|| empty($_POST['contract_staff'])
	|| empty($_POST['num_contract'])
	|| empty($_POST['num_political'])
	|| empty($_POST['ad_hoc'])
	|| empty($_POST['num_adhoc'])
	|| empty($_POST['task'])
	|| empty($_POST['num_offices'])
	|| empty($_POST['zone_num'])
	|| empty($_POST['full_ict'])
	|| empty($_POST['partial_ict'])
	|| empty($_POST['no_ict'])
	|| empty($_POST['tech_staff'])
	|| empty($_POST['internet'])*/){
        
		//setting error message
		$_SESSION['error'] = "Mandatory field(s) are missing, Please fill it again";
        header("location: page1_form.php"); //redirecting to first page
    
	//} else {
	//Sanitizing email field to remove unwanted characters
      /*  $_POST['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	
	//After sanitization Validation is performed
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
		
	//Validating Contact Field	using regex
            if (!preg_match("/^[0-9]{10}$/", $_POST['contact'])){
			
                $_SESSION['error'] = "10 digit contact number is required.";
                header("location: page1_form.php");*/
	} else {
                if ((($_POST['num_offices']) == ($_POST['full_ict']) + ($_POST['partial_ict']) + ($_POST['no_ict'])) && ($_POST['num_offices']) >= ($_POST['tech_staff']) && ($_POST['num_offices']) >= ($_POST['internet'])) {
                   foreach ($_POST as $key => $value) {
                       $_SESSION['post'][$key] = $value;
					   //echo $_SESSION['post'][$key];
                   }
                } else {
					
					
                    $_SESSION['error'] = "The total sum of values entered for questions 19(a)(i), 19(a)(ii), and 19(a)(iii) should be equal to the number of field offices in the State, as stated in question 17.";
                   header("location: page1_form.php"); //redirecting to first page
                }
//            }
   //     } else {
           /* $_SESSION['error'] = "Invalid Email Address";
            header("location: page1_form.php");*///redirecting to first page
 //       }
    }
} else {
    if (empty($_SESSION['error'])) {
        header("location: page1_form.php");//redirecting to first page
    }
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Submit Form Content</title>
        <link rel="stylesheet" href="style.css" />
    </head>
    <body>
        <div class="container">
            <div class="main">
                <h2>Thank You For Your Time</h2><hr/>

                <?php
                session_start();
                if (isset($_POST['sbirs_meet'])) {
                    if (!empty($_SESSION['post'])){

                        if (empty($_POST['quarter'])
						/*|| empty($_POST['working_cases'])
						|| empty($_POST['concluded_cases'])
						|| empty($_POST['taxpayer_audit'])
						|| empty($_POST['hnwi_unit'])
						|| empty($_POST['hnwi_id'])
						|| empty($_POST['hnwi_action'])
						|| empty($_POST['agency_coop'])
						|| empty($_POST['tin_tcc'])
						|| empty($_POST['debt_enforce'])
						|| empty($_POST['agent_involve'])
						|| empty($_POST['court_enforce'])
						|| empty($_POST['action_num'])
						|| empty($_POST['taxpayer_aware'])
						|| empty($_POST['other_taxedu'])
						|| empty($_POST['igr_effect'])
						|| empty($_POST['tin_effect'])
						|| empty($_POST['tat_effect'])
						|| empty($_POST['complaint_effect'])
						|| empty($_POST['servicom'])
						|| empty($_POST['yes_servicom'])
						|| empty($_POST['complaint_num'])
						|| empty($_POST['process_num'])
						|| empty($_POST['sjtb_functioning'])
						|| empty($_POST['num_timemet'])
						|| empty($_POST['other_charges'])
						|| empty($_POST['edu_charges'])*/
						|| empty($_POST['sbirs_meet'])){
                            
							//Setting error for page 4
							$_SESSION['error'] = "Mandatory field(s) are missing, Please fill it again";
                            header("location: page1_form.php"); //redirecting to fourth page
                        } else {
                            foreach ($_POST as $key => $value) {
                                $_SESSION['post'][$key] = $value;
								//echo $_SESSION['post'][$key];
                            }
							
							//function to extract array
                            extract($_SESSION['post']);  							
						
							//Storing values in database
                           // $connection = mysql_connect("localhost", "nggovern_Garki", "NgfBassi1!");
                           // $db = mysql_select_db("nggovern_dashboard", $connection);
                           $con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
							
							//check for duplicate entry
$query1=mysqli_query($con, "select * from survey where mysession='".$mysession."' AND quarter='".$quarter."' AND year='".$year."'");  //die(mysql_error());
$duplicate=mysqli_num_rows($query1);
   if($duplicate==0)
   //if($num_offices < $full_ict)
    {			
        $conn = new mysqli("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
							
                            $query = "insert into survey 
(sbirs_meet,mysession,quarter,year,sbirs_policy,sbirs_gov,sbirs_scf,sbirs_sha,sbirs_chair,sbirs_is,sbirs_fund,sbirs_cost,sbirs_emp,core_tax,support_role,tax_staff,capacity_building,attended_training,trainin_program,min_training,sal_structure,pay_scheme,contract_staff,num_contract,num_political,ad_hoc,num_adhoc,task,num_offices,zone_num,full_ict,partial_ict,no_ict,tech_staff,internet,field_report,field_report1,field_report2,field_report3,field_report4,report_method,standardrpt_format,tin_captured,reg_pack,new_tax,num_page,standard_form,paper_size,avail_public,pack_content,avail_req,avail_req1,avail_req2,avail_req3,avail_req4,avail_req5,avail_req6,guidance,avail_online,sbirs_assessment,self_assessment,self_assesscover,self_assesscover1,self_assesscover2,self_assesscover3,desk_guide,object_right,doc_appeal,referred,central_platform,platform_work,auto_platform,online_acc,realtime_acc,use_consultant,tax_agent,exclu_agent,levy_collect,levy_collect1,levy_collect2,levy_collect3,levy_collect4,levy_collect5,levy_collect6,other_tax,govt_dept,govtdept_levy,sbircollect_lg,sbircollectlg_levy,all_cases,state_mechanism,payment_audit,a2013_audit,a2014_audit,a2015_audit,rev_dept,revdept_diff,last_conducted,working_cases,concluded_cases,taxpayer_audit,hnwi_unit,hnwi_id,hnwi_action,agency_coop,tin_tcc,debt_enforce,agent_involve,court_enforce,action_num,taxpayer_aware,tax_edu,tax_edu1,tax_edu2,tax_edu3,tax_edu4,tax_edu5,other_taxedu,igr_effect,tin_effect,tat_effect,complaint_effect,servicom,yes_servicom,complaint_num,no_servicom,process_num,process_timetcc,taxpayer_favor,sbirs_favor,sjtb_functioning,num_timemet,utility_charges,utility_charges1,utility_charges2,utility_charges3,utility_charges4,utility_charges5,utility_charges6,other_charges,edu_charges,health_charges,comment,completed,sbirs_mship_top,sbirs_mship_toplus,ext_rep,ext_govt,ext_other,nature_por,nature_por1,nature_por2,nature_por3,nature_por4,cap_cost_cov,perform_app,how_often,alter_target,function_website,tax_guide,tax_ret_form,tax_calc,tax_reg_pack,field_off_add,contact_help) 
values('$sbirs_meet','$mysession','$quarter','$year','$sbirs_policy','$sbirs_gov','$sbirs_scf','$sbirs_sha','$sbirs_chair','$sbirs_is','$sbirs_fund','$sbirs_cost','$sbirs_emp','$core_tax','$support_role','$tax_staff','$capacity_building','$attended_training','$trainin_program','$min_training','$sal_structure','$pay_scheme','$contract_staff','$num_contract','$num_political','$ad_hoc','$num_adhoc','$task','$num_offices','$zone_num','$full_ict','$partial_ict','$no_ict','$tech_staff','$internet','$field_report','$field_report1','$field_report2','$field_report3','$field_report4','$report_method','$standardrpt_format','$tin_captured','$reg_pack','$new_tax','$num_page','$standard_form','$paper_size','$avail_public','$pack_content','$avail_req','$avail_req1','$avail_req2','$avail_req3','$avail_req4','$avail_req5','$avail_req6','$guidance','$avail_online','$sbirs_assessment','$self_assessment','$self_assesscover','$self_assesscover1','$self_assesscover2','$self_assesscover3','$desk_guide','$object_right','$doc_appeal','$referred','$central_platform','$platform_work','$auto_platform','$online_acc','$realtime_acc','$use_consultant','$tax_agent','$exclu_agent','$levy_collect','$levy_collect1','$levy_collect2','$levy_collect3','$levy_collect4','$levy_collect5','$levy_collect6','$other_tax','$govt_dept','$govtdept_levy','$sbircollect_lg','$sbircollectlg_levy','$all_cases','$state_mechanism','$payment_audit','$audit_2013','$audit_2014','$audit_2015','$rev_dept','$revdept_diff','$last_conducted','$working_cases','$concluded_cases','$taxpayer_audit','$hnwi_unit','$hnwi_id','$hnwi_action','$agency_coop','$tin_tcc','$debt_enforce','$agent_involve','$court_enforce','$action_num','$taxpayer_aware','$tax_edu','$tax_edu1','$tax_edu2','$tax_edu3','$tax_edu4','$tax_edu5','$other_taxedu','$igr_effect','$tin_effect','$tat_effect','$complaint_effect','$servicom','$yes_servicom','$complaint_num','$no_servicom','$process_num','$process_timetcc','$taxpayer_favor','$sbirs_favor','$sjtb_functioning','$num_timemet','$utility_charges','$utility_charges1','$utility_charges2','$utility_charges3','$utility_charges4','$utility_charges5','$utility_charges6','$other_charges','$edu_charges','$health_charges','$comment','$completed','$sbirs_mship_top','$sbirs_mship_toplus','$ext_rep','$ext_govt','$ext_other','$nature_por','$nature_por1','$nature_por2','$nature_por3','$nature_por4','$cap_cost_cov','$perform_app','$how_often','$alter_target','$function_website','$tax_guide','$tax_ret_form','$tax_calc','$tax_reg_pack','$field_off_add','$contact_help')"; //or die(mysql_error()); //echo $query;
	//}
						    //if ($query) {
						    if ($conn->query($query) === TRUE) {
                                echo '<p><span id="success">Tax Administration Form Submitted successfully..!!</span></p>';
								echo '<p><span><a href="page2_form.php">Continue with questionnaire</a></span>';
                            }} else {
                                echo '<p><span>Form Submission Failed..!!</span></p>';
								echo '<p><span>OR</span></p>';
								echo '<p><span>Entry for '.$quarter.' of '.$year.' is already in the database table</span></p>';
								echo '<p><span><a href="submitted_view.php">Click here</a> to check if entry has already been made</span>';
                            }
							//destroying session
                            unset($_SESSION['post']);
                        }
                    } else {
                        header("location: page1_form.php"); //redirecting to first page
                    }
                } else {
                    header("location: page1_form.php"); //redirecting to first page
                }
               ?>
            </div>

        </div>
    </body>
</html>