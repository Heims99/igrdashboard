<?php
//Session starts here
session_start();
include_once '../connection.php';
if(!isset($_SESSION['user']))
{
 header("Location: login.php");
}
$con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
$res=mysqli_query($con, "SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res);
?><!DOCTYPE HTML>
<html>
    <head>
        <title>Tax Administration</title>
        <link rel="stylesheet" href="style.css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
        <button onclick="myFunction()">Print Form</button>

<script>
function myFunction() {
    window.print();
}
</script>

    <script>
	$(document).ready(function (){
            $("#sbirsmshiptoplusyes").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#sbirs_mship_ext").show();
                }else{
                    $("#sbirs_mship_ext").hide();
                } 
            });
        });
		$(document).ready(function (){
            $("#sbirsmshiptoplusno").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#sbirs_mship_ext").hide();
                }else{
                    $("#sbirs_mship_ext").show();
                } 
            });
        });
	
        $(document).ready(function (){
            $("#tps").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#min_training").show();
                }else{
                    $("#min_training").hide();
                } 
            });
        });
		$(document).ready(function (){
            $("#tps1").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#min_training").show();
                }else{
                    $("#min_training").hide();
                } 
            });
        });
		$(document).ready(function (){
            $("#tpsno").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#min_training").hide();
                }else{
                    $("#min_training").show();
                } 
            });
        });
		
		$(document).ready(function (){
            $("#appyes").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#how_often").show();
                }else{
                    $("#how_often").hide();
                } 
            });
        });
		$(document).ready(function (){
            $("#appno").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#how_often").hide();
                }else{
                    $("#how_often").show();
                } 
            });
        });
		
		$(document).ready(function (){
            $("#ctyes").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#num_contract").show();
                }else{
                    $("#num_contract").hide();
                } 
            });
        });
		$(document).ready(function (){
            $("#ctno").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#num_contract").hide();
                }else{
                    $("#num_contract").show();
                } 
            });
        });
		
		$(document).ready(function (){
            $("#adhocyes").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#num_adhoc").show();
					$("#task").show();
                }else{
                    $("#num_adhoc").hide();
					$("#task").hide();
                } 
            });
        });
		$(document).ready(function (){
            $("#adhocno").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#num_adhoc").hide();
					$("#task").hide();
                }else{
                    $("#num_adhoc").show();
					$("#task").show();
                } 
            });
        });
		
		$(document).ready(function (){
            $("#webyes").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#dom_web").show();
                }else{
                    $("#dom_web").hide();
                } 
            });
        });
		$(document).ready(function (){
            $("#webno").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#dom_web").hide();
                }else{
                    $("#dom_web").show();
                } 
            });
        });
    </script>
    </head>
    <body>

        <div class="container">
            <div class="main">
                <h2>Tax Administration</h2><hr/>
                <span id="error">
			<!----Initializing Session for errors--->
                    <?php
                    if (!empty($_SESSION['error'])) {
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    }
                    ?>
                </span>
                
                <?php
		  $mode=$_GET["mode"];
		  if($mode=="update") {
		  	//include("../connection.php");
		  	$con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
			$surveyid=$_GET["survey_id"]; //echo $surveyid;
			//$sql="select stateId,stateName,zoneId, statePopulation from $state where stateId='$stateId'";
			$sql=mysqli_query($con, "SELECT survey_id,sbirs_meet,mysession,quarter,year,sbirs_policy,sbirs_gov,sbirs_scf,sbirs_sha,sbirs_chair,sbirs_is,sbirs_fund,sbirs_cost,sbirs_emp,core_tax,support_role,tax_staff,capacity_building,attended_training,trainin_program,min_training,sal_structure,pay_scheme,contract_staff,num_contract,num_political,ad_hoc,num_adhoc,task,num_offices,zone_num,full_ict,partial_ict,no_ict,tech_staff,internet,field_report,field_report1,field_report2,field_report3,field_report4,report_method,standardrpt_format,sbirs_mship_top,sbirs_mship_toplus,ext_rep,ext_govt,ext_other,nature_por,nature_por1,nature_por2,nature_por3,nature_por4,cap_cost_cov,perform_app,how_often,alter_target,function_website,tax_guide,tax_ret_form,tax_calc,tax_reg_pack,field_off_add,contact_help,completed FROM survey WHERE survey_id='$surveyid'");
			
			//$result=mysql_query($sql,$db) or die(mysql_error());
			while($row=mysqli_fetch_array($sql)) {
				$surveyid=$row['survey_id'];
				$quarter=$row['quarter'];
				$year=$row['year'];
				$sbirs_meet=$row['sbirs_meet'];
				$sbirs_policy=$row['sbirs_policy'];
				$sbirs_gov=$row['sbirs_gov'];
				$sbirs_scf=$row['sbirs_scf'];
				$sbirs_sha=$row['sbirs_sha'];
				$sbirs_chair=$row['sbirs_chair'];
				$sbirs_is=$row['sbirs_is'];
				$sbirs_fund=$row['sbirs_fund'];
				$sbirs_cost=$row['sbirs_cost'];
				$sbirs_emp=$row['sbirs_emp'];
				$core_tax=$row['core_tax'];
				$support_role=$row['support_role'];
				$tax_staff=$row['tax_staff'];
				$capacity_building=$row['capacity_building'];
				$attended_training=$row['attended_training'];
				$trainin_program=$row['trainin_program'];
				$min_training=$row['min_training'];
				$sal_structure=$row['sal_structure'];
				$pay_scheme=$row['pay_scheme'];
				$contract_staff=$row['contract_staff'];
				$num_contract=$row['num_contract'];
				$num_political=$row['num_political'];
				$ad_hoc=$row['ad_hoc'];
				$num_adhoc=$row['num_adhoc'];
				$task=$row['task'];
				$num_offices=$row['num_offices'];
				$zone_num=$row['zone_num'];
				$full_ict=$row['full_ict'];
				$partial_ict=$row['partial_ict'];
				$no_ict=$row['no_ict'];
				$tech_staff=$row['tech_staff'];
				$internet=$row['internet'];
				$field_report=$row['field_report'];
				$field_report1=$row['field_report1'];
				$field_report2=$row['field_report2'];
				$field_report3=$row['field_report3'];
				$field_report4=$row['field_report4'];
				$report_method=$row['report_method'];
				$standardrpt_format=$row['standardrpt_format'];
				$completed=$row['completed'];
				$sbirs_mship_top=$row['sbirs_mship_top'];
				$sbirs_mship_toplus=$row['sbirs_mship_toplus'];
				$ext_rep=$row['ext_rep'];
				$ext_govt=$row['ext_govt'];
				$ext_other=$row['ext_other'];
				$nature_por=$row['nature_por'];
				$nature_por1=$row['nature_por1'];
				$nature_por2=$row['nature_por2'];
				$nature_por3=$row['nature_por3'];
				$nature_por4=$row['nature_por4'];
				$cap_cost_cov=$row['cap_cost_cov'];
				$perform_app=$row['perform_app'];
				$how_often=$row['how_often'];
				$alter_target=$row['alter_target'];
				$function_website=$row['function_website'];
				$tax_guide=$row['tax_guide'];
				$tax_ret_form=$row['tax_ret_form'];
				$tax_calc=$row['tax_calc'];
				$tax_reg_pack=$row['tax_reg_pack'];
				$field_off_add=$row['field_off_add'];
				$contact_help=$row['contact_help'];
				$completed=$row['completed'];
			}
		?>
                
                <form action="page1_update.php?mode=update" method="post" novalidate>
               <input name="surveyid" type="text" value="<?php echo $surveyid; ?>" hidden="true"  >
                <input name="mysession" type="text" value="<?php echo $userRow['username']; ?>" hidden="true"  >
				
                <label>Which quarter of the year are you filling for?<span>*</span></label><br />
                    <input name="quarter" type="text" value="<?php echo $quarter; ?>" readonly >
                    <label>Which year are you filling for?<span>*</span></label><br />
                    <input name="year" type="text" value="<?php echo $year; ?>" readonly >                    <br />
<h3>Organisational and Institutional Arrangements</h3>

<?php /*?>additional updates<?php */?>
<label>1. What is the composition of the Board of the SIRS?</label><br><br>
<label><i>Top management of the SIRS only?</i><span>*</span></label><br />
                    <input type="radio" name="sbirs_mship_top" value="Yes" <?php if($sbirs_mship_top=="Yes"){ echo "checked";}?> ><i>Yes</i><br />
                    <input type="radio" name="sbirs_mship_top" value="No" <?php if($sbirs_mship_top=="No"){ echo "checked";}?> ><i>No</i>
                    <br /><br>
                    
<label><i>Top management of SIRS plus non-SIRS members?</i><span>*</span></label><br />
                    <input type="radio" name="sbirs_mship_toplus" id="sbirsmshiptoplusyes" value="yes" <?php if($sbirs_mship_toplus=="yes"){ echo "checked";}?> ><i>Yes</i><br />
                    <input type="radio" name="sbirs_mship_toplus" id="sbirsmshiptoplusno" value="no" <?php if($sbirs_mship_toplus=="no"){ echo "checked";}?> ><i>No</i>
                    <br /><br>
                    <i id="sbirs_mship_ext" style="display:none;">If Yes, who are the external members?<br />
                    <input type="checkbox" name="ext_rep" value="Reps of MDAs" <?php if($ext_rep=="Reps of MDAs"){ echo "checked";}?> >Reps of MDAs<br />
                    <input type="checkbox" name="ext_govt" value="Non governmental" <?php if($ext_govt=="Non governmental"){ echo "checked";}?> >Non governmental<br />
                    <input type="checkbox" name="ext_other" value="Others" <?php if($ext_other=="Others"){ echo "checked";}?> >Others</i>
                    <br /><br>


                    <label>2. The Board of the SIRS meets:<span>*</span></label><br />
                     <input type="radio" name="sbirs_meet" value="4" <?php if($sbirs_meet=="4"){ echo "checked";}?> ><i>Weekly</i><br />
                    <input type="radio" name="sbirs_meet" value="5" <?php if($sbirs_meet=="5"){ echo "checked";}?> ><i>Monthly</i><br />
                    <input type="radio" name="sbirs_meet" value="3" <?php if($sbirs_meet=="3"){ echo "checked";}?> ><i>Quarterly</i><br />
                    <input type="radio" name="sbirs_meet" value="2" <?php if($sbirs_meet=="2"){ echo "checked";}?> ><i>Ad hoc</i><br />
                    <input type="radio" name="sbirs_meet" value="1" <?php if($sbirs_meet=="1"){ echo "checked";}?> ><i>Never</i>
                    <br /><br />

                    <label>3a. The Board/SIRS issues policy and regulatory guidance:<span>*</span></label><br />
                    <input type="radio" name="sbirs_policy" value="3" <?php if($sbirs_policy=="3"){ echo "checked";}?> ><i>Regularly</i><br />
                    <input type="radio" name="sbirs_policy" value="2" <?php if($sbirs_policy=="2"){ echo "checked";}?> >
                    <i>Ad hoc</i><br />
                    <input type="radio" name="sbirs_policy" value="1" <?php if($sbirs_policy=="1"){ echo "checked";}?> ><i>Never</i>
                    <br /><br />
                    
                    <label>3b. What is the nature of the policy/regulatory guidance? (tick as apply):<span>*</span></label><br />
                    <input type="checkbox" name="nature_por" value="1" <?php if($nature_por=="1"){ echo "checked";}?> ><i>Tax policy changes</i><br />
                    <input type="checkbox" name="nature_por1" value="1" <?php if($nature_por1=="1"){ echo "checked";}?> ><i>Tax guidance for staff</i><br />
                    <input type="checkbox" name="nature_por2" value="1" <?php if($nature_por2=="1"){ echo "checked";}?> ><i>Tax guidance for public</i><br />
                    <input type="checkbox" name="nature_por3" value="1" <?php if($nature_por3=="1"){ echo "checked";}?> ><i>Non-tax staff guidance (HR policy)</i><br />
                    <input type="checkbox" name="nature_por4" value="1" <?php if($nature_por4=="1"){ echo "checked";}?> ><i>Other</i>
                    <br /><br />

                    <label>4. The Board/SIRS reports to the Governor:<span>*</span></label><br />
                    <input type="radio" name="sbirs_gov" value="5" <?php if($sbirs_gov=="5"){ echo "checked";}?> ><i>Weekly</i><br />
                    <input type="radio" name="sbirs_gov" value="4" <?php if($sbirs_gov=="4"){ echo "checked";}?> ><i>Monthly</i><br />
                    <input type="radio" name="sbirs_gov" value="3" <?php if($sbirs_gov=="3"){ echo "checked";}?> ><i>Quarterly</i><br />
                    <input type="radio" name="sbirs_gov" value="2" <?php if($sbirs_gov=="2"){ echo "checked";}?> ><i>Annually</i><br />
                    <input type="radio" name="sbirs_gov" value="1" <?php if($sbirs_gov=="1"){ echo "checked";}?> ><i>Never</i>
                    <br /><br />

                    <label>5. The Board/SIRS reports to the State Commissioner of Finance<span>*</span></label><br />
                    <input type="radio" name="sbirs_scf" value="5" <?php if($sbirs_scf=="5"){ echo "checked";}?> ><i>Weekly</i><br />
                    <input type="radio" name="sbirs_scf" value="4" <?php if($sbirs_scf=="4"){ echo "checked";}?> ><i>Monthly</i><br />
                    <input type="radio" name="sbirs_scf" value="3" <?php if($sbirs_scf=="3"){ echo "checked";}?> ><i>Quarterly</i><br />
                    <input type="radio" name="sbirs_scf" value="2" <?php if($sbirs_scf=="2"){ echo "checked";}?> ><i>Annually</i><br />
                    <input type="radio" name="sbirs_scf" value="1" <?php if($sbirs_scf=="1"){ echo "checked";}?> ><i>Never</i>
                    <br /><br />
                    
                    <label>6. The Board/SIRS reports to the State House of Assembly:<span>*</span></label><br />
                    <input type="radio" name="sbirs_sha" value="5" <?php if($sbirs_sha=="5"){ echo "checked";}?> ><i>Weekly</i><br />
                    <input type="radio" name="sbirs_sha" value="2" <?php if($sbirs_sha=="2"){ echo "checked";}?> ><i>Monthly</i><br />
                    <input type="radio" name="sbirs_sha" value="3" <?php if($sbirs_sha=="3"){ echo "checked";}?> ><i>Quarterly</i><br />
                    <input type="radio" name="sbirs_sha" value="4" <?php if($sbirs_sha=="4"){ echo "checked";}?> ><i>Annually</i><br />
                    <input type="radio" name="sbirs_sha" value="1" <?php if($sbirs_sha=="1"){ echo "checked";}?> >
                    <i>Ad hoc</i><br />
                    <input type="radio" name="sbirs_sha" value="0" <?php if($sbirs_sha=="0"){ echo "checked";}?> ><i>Never</i>
                    <br /><br />
                    
                    <label>7. The Executive Chairman of the SIRS has a relevant professional qualification and/or experience:<span>*</span></label><br />
                    <input type="radio" name="sbirs_chair" value="2" <?php if($sbirs_chair=="2"){ echo "checked";}?> ><i>Yes</i><br />
                    <input type="radio" name="sbirs_chair" value="1" <?php if($sbirs_chair=="1"){ echo "checked";}?> ><i>No</i>
                    <br />
                    
<h3>Availability and Sufficiency of SIRS Budget</h3>
<label>8. The SIRS is:<span>*</span></label><br />
                    <input type="radio" name="sbirs_is" value="3" <?php if($sbirs_is=="3"){ echo "checked";}?> ><i>Autonomous (full implementation of a law)</i><br />
                    <input type="radio" name="sbirs_is" value="2" <?php if($sbirs_is=="2"){ echo "checked";}?> >
                    <i>Semi-autonomous (partial implementation of a law)</i><br />
                    <input type="radio" name="sbirs_is" value="1" <?php if($sbirs_is=="1"){ echo "checked";}?> >
                    <i>A department or agency (no law in place)</i>
                    <br /><br />
                    
                    <label>9a. The SIRS is funded:<span>*</span></label><br />
                    <input type="radio" name="sbirs_fund" value="5" <?php if($sbirs_fund=="5"){ echo "checked";}?> ><i>With a percentage of collection</i><br />
                    <input type="radio" name="sbirs_fund" value="4" <?php if($sbirs_fund=="4"){ echo "checked";}?> ><i>By appropriation in the state budget</i><br />
                    <input type="radio" name="sbirs_fund" value="3" <?php if($sbirs_fund=="3"){ echo "checked";}?> ><i>With a fixed sum from collection</i><br />
                    <input type="radio" name="sbirs_fund" value="2" <?php if($sbirs_fund=="2"){ echo "checked";}?> ><i>With a combination of income from collection while salaries are covered by the civil service</i>
                    <br /><br />
                    
                    <label>9b. The funding covers operating costs:<span>*</span></label><br />
                    <input type="radio" name="sbirs_cost" value="3" <?php if($sbirs_cost=="3"){ echo "checked";}?> ><i>Yes</i><br />
                    <input type="radio" name="sbirs_cost" value="2" <?php if($sbirs_cost=="2"){ echo "checked";}?> ><i>Partially</i><br />
                    <input type="radio" name="sbirs_cost" value="1" <?php if($sbirs_cost=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br>
                    
                    <label>10. How are capital costs covered?<span>*</span></label><br />
                    <input type="radio" name="cap_cost_cov" value="5" <?php if($cap_cost_cov=="5"){ echo "checked";}?> ><i>Regular funding from budget/cost of collection?</i><br />
                    <input type="radio" name="cap_cost_cov" value="3" <?php if($cap_cost_cov=="3"){ echo "checked";}?> ><i>Special funding by State government?</i><br />
                    <input type="radio" name="cap_cost_cov" value="2" <?php if($cap_cost_cov=="2"){ echo "checked";}?> ><i>Development partners?</i><br>
                    <input type="radio" name="cap_cost_cov" value="1" <?php if($cap_cost_cov=="1"){ echo "checked";}?> ><i>None</i>
                    <br />
                    
                    <h3>Salary Incentives, SIRS Staffs' Skills and Training Levels</h3>
<label>11a. What is the number of the SIRS employees?<span>*</span></label><br />
                    <input type="radio" name="sbirs_emp" value="6" <?php if($sbirs_emp=="6"){ echo "checked";}?> ><i>1000+</i><br />
                    <input type="radio" name="sbirs_emp" value="4" <?php if($sbirs_emp=="4"){ echo "checked";}?> ><i>600 - 1000</i><br />
                    <input type="radio" name="sbirs_emp" value="3" <?php if($sbirs_emp=="3"){ echo "checked";}?> ><i>400 - 600</i><br />
                    <input type="radio" name="sbirs_emp" value="2" <?php if($sbirs_emp=="2"){ echo "checked";}?> ><i>200 - 400</i><br />
                    <input type="radio" name="sbirs_emp" value="1" <?php if($sbirs_emp=="1"){ echo "checked";}?> ><i>100 - 200</i>
                    <br /><br />
                
                    <label><i>11b. How many of the staff are in core tax roles?</i></label><br />
                    <input name="core_tax" type="number" placeholder="Integer number" value="<?php echo $core_tax; ?>" >
                    <br />
                    <label><i>11c. How many are in support roles (i.e.. non-tax)?</i></label><br />
                    <input name="support_role" type="number" placeholder="Integer number" value="<?php echo $support_role; ?>" >
                    <br />
                    <i>11d. Number of staff with professional tax qualification (certified by FIRS, JTB, CITN etc):<span>*</span></i><br />
                    <input type="radio" name="tax_staff" value="1" <?php if($tax_staff=="1"){ echo "checked";}?> ><i>1 to 10</i><br />
                    <input type="radio" name="tax_staff" value="2" <?php if($tax_staff=="2"){ echo "checked";}?> ><i>11 to 25</i><br />
                    <input type="radio" name="tax_staff" value="3" <?php if($tax_staff=="3"){ echo "checked";}?> ><i>26 to 50</i><br />
                    <input type="radio" name="tax_staff" value="4" <?php if($tax_staff=="4"){ echo "checked";}?> ><i>51 to 100</i><br />
                    <input type="radio" name="tax_staff" value="5" <?php if($tax_staff=="5"){ echo "checked";}?> ><i>100+</i>
                    <br /><br>
                    
                    <label>12. Has the SIRS undertaken any capacity building programme facilitated by experts?<span>*</span></label><br />
                    <input type="radio" name="capacity_building" value="4" <?php if($capacity_building=="4"){ echo "checked";}?> ><i>In the last 6months</i><br />
                    <input type="radio" name="capacity_building" value="3" <?php if($capacity_building=="3"){ echo "checked";}?> ><i>In the last year</i><br />
                    <input type="radio" name="capacity_building" value="2" <?php if($capacity_building=="2"){ echo "checked";}?> ><i>More than 1 year ago</i><br />
                    <input type="radio" name="capacity_building" value="1" <?php if($capacity_building=="1"){ echo "checked";}?> ><i>Never</i>
                    <br /><br />
                    
                    <label>13. When was the last JTB Inspector of Taxes training conducted for the SIRS technical staff?<span>*</span></label><br />
                   <input type="radio" name="attended_training" value="3" <?php if($attended_training=="3"){ echo "checked";}?> ><i>Last year</i><br />
                    <input type="radio" name="attended_training" value="2" <?php if($attended_training=="2"){ echo "checked";}?> ><i>Last 2 years</i><br />
                    <input type="radio" name="attended_training" value="1" <?php if($attended_training=="1"){ echo "checked";}?> ><i>Last 5 years</i>
                    <br /><br>
                     <label>14a. Is there a training programme for all staff or only technical staff?<span>*</span></label><br />
                    <input type="radio" name="trainin_program" id="tps" value="4" <?php if($trainin_program=="4"){ echo "checked";}?> ><i>All staff</i><br />
                    <input type="radio" name="trainin_program" id="tps1" value="3" <?php if($trainin_program=="3"){ echo "checked";}?> ><i>Technical staff only</i><br />
                    <input type="radio" name="trainin_program" id="tpsno" value="0" <?php if($trainin_program=="0"){ echo "checked";}?> ><i>Ad-hoc</i>
                    <br /><br>
                    <i id="min_training" style="display:none;">14b. What is the minimum number of trainings per staff to be attended annually: 1, 2, 3 or 4. <input name="min_training" type="number" placeholder="Integer number" value="<?php echo $min_training; ?>" ></i><br>
                    
                    <label>15. Does the SIRS have a separate salary/incentive structure from the civil service?<span>*</span></label><br />
                    <input type="radio" name="sal_structure" value="3"   <?php if($sal_structure=="3"){ echo "checked";}?> ><i>Yes</i><br />
                    <input type="radio" name="sal_structure" value="1" <?php if($sal_structure=="1"){ echo "checked";}?>><i>No</i>
                    <br /><br />
                    
                    <label>16a. Does the SIRS conduct performance appraisals?<span>*</span></label><br />
                    <input type="radio" name="perform_app" id="appyes" value="3"   <?php if($perform_app=="3"){ echo "checked";}?> ><i>Yes</i><br />
                    <input type="radio" name="perform_app" id="appno" value="1" <?php if($perform_app=="1"){ echo "checked";}?>><i>No</i>
                    <br />
                    
                    <i id="how_often" style="display:none;">16b. If Yes, How often?<br />
                    <input type="radio" name="how_often" value="3" <?php if($how_often=="3"){ echo "checked";}?> >Monthly<br />
                    <input type="radio" name="how_often" value="2" <?php if($how_often=="2"){ echo "checked";}?> >Quarterly<br />
                    <input type="radio" name="how_often" value="1" <?php if($how_often=="1"){ echo "checked";}?> >Anually</i>
                    <br /><br>
                    
                    <label>17. Does the SIRS have any performance pay scheme(s)?<span>*</span></label><br />
                    <input type="radio" name="pay_scheme" value="3" <?php if($pay_scheme=="3"){ echo "checked";}?> ><i>Yes</i><br />
                    <input type="radio" name="pay_scheme" value="1" <?php if($pay_scheme=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    
                    <label>18a. Does the SIRS have any contracted staff on a special salary scale?<span>*</span></label><br />
                    <input type="radio" name="contract_staff" id="ctyes" value="1" <?php if($contract_staff=="1"){ echo "checked";}?> ><i>Yes</i><br />
                    <input type="radio" name="contract_staff" id="ctno" value="3" <?php if($contract_staff=="3"){ echo "checked";}?> ><i>No</i>
                    <br /><br>
                    <i id="num_contract" style="display:none;">18b. If yes, how many?<br />
                   <input name="num_contract" type="number" placeholder="Integer number" value="<?php echo $num_contract; ?>" ></i>
                    <br />
                    
                    <label>19. How many of the SIRS staff are political appointees?<span>*</span></label><br />
                   <input name="num_political" type="number" placeholder="Integer number" value="<?php echo $num_political; ?>" >
                    <br />
                    
                    <label>20a. Does the SIRS have ad hoc or temporary staff?<span>*</span></label><br />
                    <input type="radio" name="ad_hoc" id="adhocyes" value="yes" <?php if($ad_hoc=="yes"){ echo "checked";}?> ><i>Yes</i><br />
                    <input type="radio" name="ad_hoc" id="adhocno" value="no" <?php if($ad_hoc=="no"){ echo "checked";}?> ><i>No</i>
                    <br /><br>
                    <i id="num_adhoc" style="display:none;">20b. If yes, how many?<br />
                   <input name="num_adhoc" type="number" placeholder="Integer number" value="<?php echo $num_adhoc; ?>" ></i>
                    <br />
                    <i id="task" style="display:none;">20c. What task(s) do they carry out?<br />
                   <input name="task" type="text" value="<?php echo $task; ?>" ></i>
                    <br />
                    
                    <h3>SIRS Outreach in Districts (Number of Tax Offices)</h3>
<label>21. How many field offices does the SIRS have?<span>*</span></label><br /><input type="number" name="num_offices" placeholder="Integer number" value="<?php echo $num_offices; ?>" >
                    <br />
                    
                    <label>22. Does the SIRS have a field office in each local government?<span>*</span></label><br />
                    <input type="radio" name="zone_num" value="3" <?php if($zone_num=="3"){ echo "checked";}?> ><i>Yes</i><br />
                    <input type="radio" name="zone_num" value="1" <?php if($zone_num=="1"){ echo "checked";}?> ><i>No</i><br />
                    <br />
                    
                    
                    <label>23a. How many field offices have the following: (please insert numbers that apply)<span>*</span></label><br><font color="#FF0000"><i>Note: The sum of i, ii, and iii should be equal to the number of field offices in the State, as stated in question 21.</i></font><br />
                    <label><i>23a(i). Full ICT capability</i></label><input name="full_ict" type="number" placeholder="Integer number" value="<?php echo $full_ict; ?>" >
                    <br />
                    <label><i>23a(ii). Partial ICT capability</i></label><input name="partial_ict" type="number" placeholder="Integer number" value="<?php echo $partial_ict; ?>" >
                    <br />
                    <label><i>23a(iii). No ICT capability</i></label><input name="no_ict" type="number" placeholder="Integer number" value="<?php echo $no_ict; ?>" >
                    <br />
                    <b><i>23b. How many field offices have technically trained staff?</i></b><input name="tech_staff" type="number" placeholder="Integer number" value="<?php echo $tech_staff; ?>" >
                    <br />
                    <b><i>23c. How many field offices have internet connection?</i></b><input name="internet" type="number" placeholder="Integer number" value="<?php echo $internet; ?>" >
                    <br />
                    
                    <label>24a. What is the frequency for field offices to submit reports: (tick as apply)<span>*</span></label><br />
                    <input type="checkbox" name="field_report" value="5" <?php if($field_report=="5"){ echo "checked";}?> ><i>Weekly</i><br />
                    <input type="checkbox" name="field_report1" value="4" <?php if($field_report1=="4"){ echo "checked";}?> ><i>Monthly</i><br />
                    <input type="checkbox" name="field_report2" value="3" <?php if($field_report2=="3"){ echo "checked";}?> ><i>Quarterly</i><br />
                    <input type="checkbox" name="field_report3" value="2" <?php if($field_report3=="2"){ echo "checked";}?> ><i>Ad hoc</i><br />
                    <input type="checkbox" name="field_report4" value="1" <?php if($field_report4=="1"){ echo "checked";}?> ><i>Never</i>
                    <br /><br>
                    <label><i>24b. How are the reports submitted?</i></label><br>
                    <input type="radio" name="report_method" value="3"   <?php if($report_method=="3"){ echo "checked";}?> ><i>Electronically</i><br>
                    <input type="radio" name="report_method" value="2" <?php if($report_method=="2"){ echo "checked";}?> ><i>Paper</i><br>
                    <input type="radio" name="report_method" value="3" <?php if($report_method=="3"){ echo "checked";}?> ><i>Both</i>
                    <br /><br />
                    <label><i>24c. Has any process been altered due to reports submitted in the last year?</i></label><br>
                    <input type="radio" name="alter_target" value="3"   <?php if($alter_target=="3"){ echo "checked";}?> ><i>Yes</i><br>
                    <input type="radio" name="alter_target" value="1" <?php if($alter_target=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    <label><i>25. Is there a standard format for most reports?</i></label><br>
                    <input type="radio" name="standardrpt_format" value="3" <?php if($standardrpt_format=="3"){ echo "checked";}?> ><i>Yes</i><br>
                    <input type="radio" name="standardrpt_format" value="1" <?php if($standardrpt_format=="1"){ echo "checked";}?> ><i>No</i>
                    <br><br>
                    <label><i>26a. Does the SIRS own a functional and up-to-date website?</i></label><br>
                    <input type="radio" name="function_website" id="webyes" value="3" <?php if($function_website=="3"){ echo "checked";}?> ><i>Yes</i><br>
                    <input type="radio" name="function_website" id="webno" value="1" <?php if($function_website=="1"){ echo "checked";}?> ><i>No</i>
                    <br>
                    <i id="dom_web" style="display:none;">26b. If yes, which of these are domiciled on the website? (tick as apply)<br />
                    <input type="checkbox" name="tax_guide" value="1" <?php if($tax_guide=="1"){ echo "checked";}?> >Tax guides<br />
                    <input type="checkbox" name="tax_ret_form" value="1" <?php if($tax_ret_form=="1"){ echo "checked";}?> >Tax return form<br />
                    <input type="checkbox" name="tax_calc" value="1" <?php if($tax_calc=="1"){ echo "checked";}?> >Tax calculator<br />
                    <input type="checkbox" name="tax_reg_pack" value="1" <?php if($tax_reg_pack=="1"){ echo "checked";}?> >Tax registeration pack<br />
                    <input type="checkbox" name="field_off_add" value="1" <?php if($field_off_add=="1"){ echo "checked";}?> >Field office addresses<br />
                    <input type="checkbox" name="contact_help" value="1" <?php if($contact_help=="1"){ echo "checked";}?> >Contact center details/enquiry lines</i>
                    <br /><br>
                    <input type="checkbox" name="completed" value="1" <?php if($completed=="1"){ echo "checked";}?>/><i>Mark This Form Entry As Finalized</i><br>
                    <i>Note: You will not be able to edit this form if you check this box</i>
                    <br /><br />
                    
                    <input  type="reset" value="Reset" />
                    <input  type="submit" value="Update Entry" name="update" />

                </form>
                <?php	
			
		  }
		  ?>
		 
                
                
            </div>

        </div>
    </body>
</html>