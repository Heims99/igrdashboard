<?php
session_start();
//checking second page values for empty,If it finds any blank field then redirected to second page
if (isset($_POST['quarter'])){
    if (empty($_POST['quarter'])
	|| empty($_POST['year'])
	/*|| empty($_POST['informal'])
	|| empty($_POST['more_informal'])
	|| empty($_POST['reg_pack'])
	|| empty($_POST['dpa'])
	|| empty($_POST['dp_name'])
	|| empty($_POST['tied_to'])
	|| empty($_POST['other_dpa'])
	|| empty($_POST['new_tax'])
	|| empty($_POST['num_page'])
	|| empty($_POST['standard_form'])
	|| empty($_POST['paper_size'])
	|| empty($_POST['avail_public'])
	|| empty($_POST['pack_content'])
	|| empty($_POST['guidance'])
	|| empty($_POST['avail_online'])
	|| empty($_POST['sbirs_assessment'])
	|| empty($_POST['self_assessment'])
	|| empty($_POST['desk_guide'])
	|| empty($_POST['object_right'])
	|| empty($_POST['doc_appeal'])
	|| empty($_POST['referred'])*/){
		
		//setting error message
        $_SESSION['error_page4'] = "Mandatory field(s) are missing, Please fill it again";
        header("location: page4_form.php");//redirecting to second page
    
	} else {
		//fetching all values posted from second page and storing it in variable
        foreach ($_POST as $key => $value) {
            $_SESSION['post'][$key] = $value;
			//echo $_SESSION['post'][$key];
        }
    }
} else {
    if (empty($_SESSION['error_page4'])) {
        header("location: page4_form.php");//redirecting to first page
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
                if (isset($_POST['quarter'])) {
                    if (!empty($_SESSION['post'])){

                        if (empty($_POST['year'])
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
						|| empty($_POST['quarter'])){
                            
							//Setting error for page 4
							$_SESSION['error_page4'] = "Mandatory field(s) are missing, Please fill it again";
                            header("location: page4_form.php"); //redirecting to fourth page
                        } else {
                            foreach ($_POST as $key => $value) {
                                $_SESSION['post'][$key] = $value;
								//echo $_SESSION['post'][$key];
                            }
							//function to extract array
                            extract($_SESSION['post']);  
							
							//Storing values in database
                           // $connection = mysql_connect("localhost", "nggovern_Garki", "NgfBassi1!");
                          //  $db = mysql_select_db("nggovern_dashboard", $connection);
                          
                          $con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
							
							$query1=mysqli_query($con, "select * from survey3 where mysession='".$mysession."' AND quarter='".$quarter."' AND year='".$year."'"); //or die(mysql_error());
$duplicate=mysqli_num_rows($query1);
   if($duplicate==0)
    {				
			$conn = new mysqli("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}				
                            $query ="insert into survey3 
(mysession,quarter,year,last_conducted,working_cases,concluded_cases,taxpayer_audit,hnwi_unit,hnwi_id,hnwi_action,sirs_lead,agency_coop,tin_tcc,debt_enforce,agent_involve,court_enforce,action_num,taxpayer_aware,tax_edu,tax_edu1,tax_edu2,tax_edu3,tax_edu4,tax_edu5,other_taxedu,igr_effect,tin_effect,tat_effect,complaint_effect,servicom,yes_servicom,complaint_num,no_servicom,process_num,process_timetcc,taxpayer_favor,sbirs_favor,sjtb_functioning,num_timemet,utility_charges,utility_charges1,utility_charges2,utility_charges3,utility_charges4,utility_charges5,utility_charges6,other_charges,edu_charges,health_charges,comment,trained_auditor,vaids_unit,vaid_staff,case_handled,cd_name,cd_designation,cd_mobile,cd_email,completed) 
values('$mysession','$quarter','$year','$last_conducted','$working_cases','$concluded_cases','$taxpayer_audit','$hnwi_unit','$hnwi_id','$hnwi_action','$sirs_lead','$agency_coop','$tin_tcc','$debt_enforce','$agent_involve','$court_enforce','$action_num','$taxpayer_aware','$tax_edu','$tax_edu1','$tax_edu2','$tax_edu3','$tax_edu4','$tax_edu5','$other_taxedu','$igr_effect','$tin_effect','$tat_effect','$complaint_effect','$servicom','$yes_servicom','$complaint_num','$no_servicom','$process_num','$process_timetcc','$taxpayer_favor','$sbirs_favor','$sjtb_functioning','$num_timemet','$utility_charges','$utility_charges1','$utility_charges2','$utility_charges3','$utility_charges4','$utility_charges5','$utility_charges6','$other_charges','$edu_charges','$health_charges','$comment','$trained_auditor','$vaids_unit','$vaid_staff','$case_handled','$cd_name','$cd_designation','$cd_mobile','$cd_email','$completed')"; //or die(mysql_error()); //echo $query;
	//}
						    //if ($query) {
						    if ($conn->query($query) === TRUE) {
                                echo '<p><span id="success">Tax Enforcement Form Submitted successfully..!!</span></p>';
								echo '<p><span><a href="submitted_view.php">Review/update submission</a></span>';
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
                        header("location: page4_form.php"); //redirecting to first page
                    }
                } else {
                    header("location: page4_form.php"); //redirecting to first page
                }
               ?>
            </div>

        </div>
    </body>
</html>