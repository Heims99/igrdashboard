<?php
session_start();
//checking first page values for empty,If it finds any blank field then redirected to first page
if (isset($_POST['month'])){
    if (empty($_POST['month'])
	|| empty($_POST['mysession'])
	|| empty($_POST['state'])
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
        header("location: annex.php"); //redirecting to first page
    
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
              //  if (($_POST['password']) === ($_POST['confirm'])) {
                   foreach ($_POST as $key => $value) {
                       $_SESSION['post'][$key] = $value;
					   //echo $_SESSION['post'][$key];
                   }
//                } else {
//                    $_SESSION['error'] = "Password does not match with Confirm Password.";
//                    header("location: page1_form.php"); //redirecting to first page
//                }
//            }
   //     } else {
           /* $_SESSION['error'] = "Invalid Email Address";
            header("location: page1_form.php");*///redirecting to first page
 //       }
    }
} else {
    if (empty($_SESSION['error'])) {
        header("location: annex.php");//redirecting to first page
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
                <h2>Status of Submission</h2><hr/>
                <?php
                session_start();
                if (isset($_POST['month'])) {
                    if (!empty($_SESSION['post'])){

                        if (empty($_POST['state'])
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
						|| empty($_POST['other_charges'])*/
						|| empty($_POST['year'])
						|| empty($_POST['month'])){
                            
							//Setting error for page 4
							$_SESSION['error'] = "Mandatory field(s) are missing, Please fill it again";
                            header("location: annex.php"); //redirecting to fourth page
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
							
							$query1=mysqli_query($con, "select * from annex where mysession='".$mysession."' AND month='".$month."' AND year='".$year."'"); //or die(mysql_error());
$duplicate=mysqli_num_rows($query1);
   if($duplicate==0)
    {
        $conn = new mysqli("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
							
                            $query ="insert into annex 
(mysession,state,month,year,paye,tax_audit,wht,direct_assess,direct_informal,capital_gain,levies,taxpayer_reg,monthly_tin,num_levies,num_education,num_appeal,num_cases,num_hinwi,num_license,completed,mda_revenue) 
values('$mysession','$state','$month','$year','$paye','$tax_audit','$wht','$direct_assess','$direct_informal','$capital_gain','$levies','$taxpayer_reg','$monthly_tin','$num_levies','$num_education','$num_appeal','$num_cases','$num_hinwi','$num_license','$completed','$mda_revenue')"; //or die(mysql_error()); //echo $query;
	//}
                           // if ($query) {
                           if ($conn->query($query) === TRUE) {
                                echo '<p><span id="success">Form Submitted successfully..!!</span></p>';
								echo '<p><span><a href="annex.php">Go Back</a></span>';
                            } } else {
                                echo '<p><span>Form Submission Failed..!!</span></p>';
								echo '<p><span>OR</span></p>';
								echo '<p><span>Entry for '.$month.' of '.$year.' is already in the database table</span></p>';
								echo '<p><span><a href="submitted_view_annex.php">Click here</a> to check if entry has already been made</span>';
                            }
							//destroying session
                           unset($_SESSION['post']);
                        }
                } else {
                        header("location: annex.php"); //redirecting to first page
                    }
                } else {
                    header("location: annex.php"); //redirecting to first page
                }
               ?>
            </div>

        </div>
    </body>
</html>