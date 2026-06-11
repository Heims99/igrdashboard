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
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>TAX PROCESSING</title>
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
            $("#centralplatform").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#platformwork").show();
                }else{
                    $("#platformwork").hide();
                } 
            });
        });
		$(document).ready(function (){
            $("#centralplatformn").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#platformwork").hide();
                }else{
                    $("#platformwork").show();
                } 
            });
        });
		$(document).ready(function (){
            $("#use_consultant").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#tax_agent").show();
					$("#exclu_agent").show();
					$("#collect_by_agent").show();
                }else{
                    $("#tax_agent").hide();
					$("#exclu_agent").hide();
					$("#collect_by_agent").hide();
                } 
            });
        });
		
		$(document).ready(function (){
            $("#use_consultantn").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#tax_agent").hide();
					$("#exclu_agent").hide();
					$("#collect_by_agent").hide();
                }else{
                    $("#tax_agent").show();
					$("#exclu_agent").show();
					$("#collect_by_agent").show();
                } 
            });
        });
		$(document).ready(function (){
            $("#exclu_agent").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#levycollect").show();
                }else{
                    $("#levycollect").hide();
                } 
            });
        });
		
		$(document).ready(function (){
            $("#govt_dept").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#govtdept_levy").show();
					
                }else{
                    $("#govtdept_levy").hide();
					
                } 
            });
        });
		$(document).ready(function (){
            $("#govt_deptn").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#govtdept_levy").hide();
					
                }else{
                    $("#govtdept_levy").show();
					
                } 
            });
        });
		
		$(document).ready(function (){
            $("#sbircollect_lgy").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#sbircollectlg_levy").show();
					
                }else{
                    $("#sbircollectlg_levy").hide();
					
                } 
            });
        });
		$(document).ready(function (){
            $("#sbircollect_lgn").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#sbircollectlg_levy").hide();
					
                }else{
                    $("#sbircollectlg_levy").show();
					
                } 
            });
        });
		
		$(document).ready(function (){
            $("#sbircollect_mday").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#sbircollectmda_levy").show();
					
                }else{
                    $("#sbircollectmda_levy").hide();
					
                } 
            });
        });
		$(document).ready(function (){
            $("#sbircollect_mdan").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#sbircollectmda_levy").hide();
					
                }else{
                    $("#sbircollectmda_levy").show();
					
                } 
            });
        });
		
		$(document).ready(function (){
            $("#all_casesn").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#state_mechanism").show();
					
                }else{
                    $("#state_mechanism").hide();
					
                } 
            });
        });
		$(document).ready(function (){
            $("#all_cases").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#state_mechanism").hide();
					
                }else{
                    $("#state_mechanism").show();
					
                } 
            });
        });
		
		$(document).ready(function (){
            $("#payment_audit").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#payment_auditall").show();
					
                }else{
                    $("#payment_auditall").hide();
					
                } 
            });
        });
		$(document).ready(function (){
            $("#payment_auditn").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#payment_auditall").hide();
					
                }else{
                    $("#payment_auditall").show();
					
                } 
            });
        });
        
        $(document).ready(function (){
            $("#conext_audit").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#conext_auditall").show();
					
                }else{
                    $("#conext_auditall").hide();
					
                } 
            });
        });
		$(document).ready(function (){
            $("#conext_auditn").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#conext_auditall").hide();
					
                }else{
                    $("#conext_auditall").show();
					
                } 
            });
        });
    </script>
    </head>
    <body>
        <div class="container">
            <div class="main">
                <h2>Tax Processing (Manual Versus Automated)</h2><hr/>
                <span id="error">
                    <?php
                    if (!empty($_SESSION['error_page3'])) {
                        echo $_SESSION['error_page3'];
                        unset($_SESSION['error_page3']);
                    }
                    ?>
                </span>
                
                <?php
                $con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
				$sql= mysqli_query ($con, "SELECT survey_id,central_platform,platform_work,auto_platform,online_acc,realtime_acc,use_consultant,tax_agent,exclu_agent,levy_collect,levy_collect1,levy_collect2,levy_collect3,levy_collect4,levy_collect5,levy_collect6,other_tax,govt_dept,govtdept_levy,sbircollect_lg,sbircollectlg_levy,all_cases,state_mechanism,payment_audit,a2013_audit,a2014_audit,a2015_audit,rev_dept,conext_audit,a2013_extaudit,a2014_extaudit,a2015_extaudit,revdept_diff,collate_mda_levies,collate_lga_levies,collect_by_agent,sbircollect_mda,sbircollectmda_levy FROM survey2,users WHERE mysession='$userRow[username]'");
			
			//$result=mysql_query($sql,$db) or die(mysql_error()); //echo $result;
			while($row=mysqli_fetch_array($sql)) {
				//$lgaId=$row['mysession'];
				$central_platform=$row['central_platform']; //echo $tin_database;
				$platform_work=$row['platform_work'];
				$auto_platform=$row['auto_platform'];
				$online_acc=$row['online_acc'];
				$realtime_acc=$row['realtime_acc'];
				$use_consultant=$row['use_consultant'];
				$tax_agent=$row['tax_agent'];
				$exclu_agent=$row['exclu_agent'];
				$levy_collect=$row['levy_collect'];
				$levy_collect1=$row['levy_collect1'];
				$levy_collect2=$row['levy_collect2'];
				$levy_collect3=$row['levy_collect3'];
				$levy_collect4=$row['levy_collect4'];
				$levy_collect5=$row['levy_collect5'];
				$levy_collect6=$row['levy_collect6'];
				$other_tax=$row['other_tax'];
				$govt_dept=$row['govt_dept'];
				$govtdept_levy=$row['govtdept_levy'];
				$sbircollect_lg=$row['sbircollect_lg'];
				$sbircollectlg_levy=$row['sbircollectlg_levy'];
				$all_cases=$row['all_cases'];
				$state_mechanism=$row['state_mechanism'];
				$payment_audit=$row['payment_audit'];
				$audit_2013=$row['a2013_audit'];
				$audit_2014=$row['a2014_audit'];
				$audit_2015=$row['a2015_audit'];
				$conext_audit=$row['conext_audit'];
				$extaudit_2013=$row['a2013_extaudit'];
				$extaudit_2014=$row['a2014_extaudit'];
				$extaudit_2015=$row['a2015_extaudit'];
				$rev_dept=$row['rev_dept'];
				$revdept_diff=$row['revdept_diff'];
				$collate_mda_levies=$row['collate_mda_levies'];
				$collate_lga_levies=$row['collate_lga_levies'];
				$collect_by_agent=$row['collect_by_agent'];
				$sbircollect_mda=$row['sbircollect_mda'];
				$sbircollectmda_levy=$row['sbircollectmda_levy'];
			}
		?>
                
                <h3>Tax payment (cash paid to tax officers versus bank and electronic payment)</h3>
              <form action="page3_insertdata.php" method="post" novalidate>
              <input name="mysession" type="text" value="<?php echo $userRow['username']; ?>" hidden="true"  >
				
                
                    <select name="quarter" hidden="true">
                        
                        <option value="All Quarter" value="">All Quarter (Jan to Dec) </options>
                        
                    </select>
                    <label>Which year are you filling for?<span>*</span></label><br />
                    <select name="year">
                        
                        <!--<option value="2019" value="">2019 </options>-->
                        <option value="2025" selected="2025" value="">2025</option>
                        
                    </select>
                    <br />
                <label>44a. Is there a central platform for collection of taxes in the state?<span>*</span></label><br />
                <input type="radio" name="central_platform" id="centralplatform" value="4" required <?php if($central_platform=="4"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="central_platform" id="centralplatformn" value="1" <?php if($central_platform=="1"){ echo "checked";}?>><i>No</i>
                    <br /><br />

                    <i id="platformwork" style="display:none;">If yes, describe how it works?<br/>
                      <textarea name="platform_work" ><?php echo $platform_work; ?></textarea><br><br>
                      
                      44b. Does the platform collect ALL taxes, levies and charges including those of MDAs?<br>
                      <input type="radio" name="collate_mda_levies" value="4" required <?php if($collate_mda_levies=="4"){ echo "checked";}?> >Yes<br />
                <input type="radio" name="collate_mda_levies" value="1" <?php if($collate_mda_levies=="1"){ echo "checked";}?> >No
                    <br /><br />
                      
                      44c. Does the platform collect ALL taxes, levies and charges including those of LGAs?<br>
                      <input type="radio" name="collate_lga_levies" value="4" required <?php if($collate_lga_levies=="4"){ echo "checked";}?> >Yes<br />
                <input type="radio" name="collate_lga_levies" value="1" <?php if($collate_lga_levies=="1"){ echo "checked";}?> >No</i>
                    <br />
                      
                    
                    <br />
                    <label>45.  Is the platform automated?<span>*</span></label><br />
                <input type="radio" name="auto_platform" value="4" required <?php if($auto_platform=="4"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="auto_platform" value="1" <?php if($auto_platform=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    <label>46.  Does it provide management and accounting information?<span>*</span></label><br /><br />
                    <i>Online:</i><br />
                <input type="radio" name="online_acc" value="4" required <?php if($online_acc=="4"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="online_acc" value="1" <?php if($online_acc=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    <i>In real time:</i><br />
                <input type="radio" name="realtime_acc" value="6" required <?php if($realtime_acc=="6"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="realtime_acc" value="1" <?php if($realtime_acc=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    <label>47a. Does the SIRS use agents/tax consultants to collect taxes/levies on their behalf?<span>*</span></label><br />
                <input type="radio" name="use_consultant" id="use_consultant" value="1" required <?php if($use_consultant=="1"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="use_consultant" id="use_consultantn" value="4" <?php if($use_consultant=="4"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    <i id="tax_agent" style="display:none;">47b. If yes, are these:<br><br />
                    
                    Taxes collected by agents in addition to SIRS staff:<br />
                <input type="radio" name="tax_agent" value="3" <?php if($tax_agent=="3"){ echo "checked";}?> >Yes<br />
                <input type="radio" name="tax_agent" value="1" <?php if($tax_agent=="1"){ echo "checked";}?> >No
               </i>     <br /><br />
               
                    <i id="exclu_agent" style="display:none;">Taxes exclusively collected by agents:<br />
                <input type="radio" name="exclu_agent" value="1" required <?php if($exclu_agent=="1"){ echo "checked";}?> >Yes<br />
                <input type="radio" name="exclu_agent" value="3" <?php if($exclu_agent=="3"){ echo "checked";}?> >No
              </i>      <br /><br />
              
              <i id="collect_by_agent" style="display:none;">Are the taxes etc collected by agents first paid into an escrow account?<br />
                <input type="radio" name="collect_by_agent" value="1" required <?php if($collect_by_agent=="1"){ echo "checked";}?> >Yes<br />
                <input type="radio" name="collect_by_agent" value="3" <?php if($collect_by_agent=="3"){ echo "checked";}?> >No
              </i>      <br /><br />
              
                    <i id="levycollect" style="display:none;">If Yes, which of the following taxes/levies are collected by agents/consultants: (please tick as apply)<br />
                <input type="checkbox" name="levy_collect" value="1" required <?php if($levy_collect=="1"){ echo "checked";}?> >Personal Income Tax<br />
                <input type="checkbox" name="levy_collect1" value="1" <?php if($levy_collect1=="1"){ echo "checked";}?> >Pay As You Earn (PAYE)<br />
                <input type="checkbox" name="levy_collect2" value="1" required <?php if($levy_collect2=="1"){ echo "checked";}?> >Withholding Tax (WHT) (Individuals and partnerships)<br />
                <input type="checkbox" name="levy_collect3" value="1" <?php if($levy_collect3=="1"){ echo "checked";}?> >Sales Taxes<br />
                <input type="checkbox" name="levy_collect4" value="1" <?php if($levy_collect4=="1"){ echo "checked";}?> >Advertising Taxes<br />
                <input type="checkbox" name="levy_collect5" value="1" required <?php if($levy_collect5=="1"){ echo "checked";}?> >Property Taxes<br />
                <input type="checkbox" name="levy_collect6" value="1" <?php if($levy_collect6=="1"){ echo "checked";}?> >Other Taxes/Levies, Please Specify<input name="other_tax" id="other_tax" type="text" size="20" value="<?php echo $other_tax; ?>"></i>
                    <br />
                    
                    <label>48a. Does any MDA collect taxes/levies/charges on behalf of the SIRS?<span>*</span></label><br />
                <input type="radio" name="govt_dept" id="govt_dept" value="2" required <?php if($govt_dept=="2"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="govt_dept" id="govt_deptn" value="1" <?php if($govt_dept=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />

                    <i id="govtdept_levy" style="display:none;">48b. If yes, which taxes/levies?<br/>
                      <textarea name="govtdept_levy" id="govtdept_levy"><?php echo $govtdept_levy; ?></textarea>
                 </i>   <br />
                    <label>49a. Does the SIRS collect any revenue on behalf of the Local Government?<span>*</span></label><br />
                <input type="radio" name="sbircollect_lg" id="sbircollect_lgy" value="3" required <?php if($sbircollect_lg=="3"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="sbircollect_lg" id="sbircollect_lgn" value="1" <?php if($sbircollect_lg=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />

                    <i id="sbircollectlg_levy" style="display:none;">49b. If yes, which taxes/levies?<br/>
                      <textarea name="sbircollectlg_levy" id="sbircollectlg_levy"><?php echo $sbircollectlg_levy; ?></textarea></i>
                    <br />
                    
                    <label>50. Does the SIRS collect all MDA revenues?<span>*</span></label><br />
                <input type="radio" name="sbircollect_mda" id="sbircollect_mday" value="3" required <?php if($sbircollect_mda=="3"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="sbircollect_mda" id="sbircollect_mdan" value="1" <?php if($sbircollect_mda=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />

                    <i id="sbircollectmda_levy" style="display:none;">If yes, which taxes/levies?<br/>
                      <textarea name="sbircollectmda_levy" id="sbircollectmda_levy"><?php echo $sbircollectmda_levy; ?></textarea></i>
                    <br />
                    
                    <label>51a. What is the accounting mechanism?<span>*</span></label><br /><br />
                    <i>Is the payment of all taxes and levies direct to a nominated government account held in a bank in:</i><br>
                    <i>All cases?</i><br />
                <input type="radio" name="all_cases" id="all_cases" value="4" required <?php if($all_cases=="4"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="all_cases" id="all_casesn" value="1" <?php if($all_cases=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    <i id="state_mechanism" style="display:none;">51b. If No, what is the mechanism for the state?<br/>
                      <textarea name="state_mechanism" id="state_mechanism"><?php echo $state_mechanism; ?></textarea></i>
                    <br />
                    <label>52a. What checks and balances for audit purposes?<span>*</span></label><br /><br />
                    <i>Does the State Internal Audit unit audit the payments of taxes and levies collected?</i><br>
                <input type="radio" name="payment_audit" id="payment_audit" value="4" required <?php if($payment_audit=="4"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="payment_audit" id="payment_auditn" value="1" <?php if($payment_audit=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    <i id="payment_auditall" style="display:none;">52b. If yes, has this been carried out for the following years?<br><br />
                    2019<br />
                <input type="radio" name="audit_2013" value="4" required <?php if($audit_2013=="4"){ echo "checked";}?> >Yes<br />
                <input type="radio" name="audit_2013" value="1" <?php if($audit_2013=="1"){ echo "checked";}?> >No
                    <br /><br />
                     2020<br />
                <input type="radio" name="audit_2014" value="4" required <?php if($audit_2014=="4"){ echo "checked";}?> >Yes<br />
                <input type="radio" name="audit_2014" value="1" <?php if($audit_2014=="1"){ echo "checked";}?> >No
                    <br /><br />
                     2021<br />
                <input type="radio" name="audit_2015" value="4" required <?php if($audit_2015=="4"){ echo "checked";}?> >Yes<br />
                <input type="radio" name="audit_2015" value="1" <?php if($audit_2015=="1"){ echo "checked";}?> >No
                    </i><br /><br />
                    
                    <label>53a. Does the State conduct external audits for payments collected in respect of taxes and levies?<span>*</span></label><br />
                <input type="radio" name="conext_audit" id="conext_audit" value="4" required <?php if($conext_audit=="4"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="conext_audit" id="conext_auditn" value="1" <?php if($conext_audit=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    <i id="conext_auditall" style="display:none;">53b. If yes, has this been carried out for the following years?<br><br />
                    2019<br />
                <input type="radio" name="extaudit_2013" value="4" required <?php if($extaudit_2013=="4"){ echo "checked";}?> >Yes<br />
                <input type="radio" name="extaudit_2013" value="1" <?php if($extaudit_2013=="1"){ echo "checked";}?> >No
                    <br /><br />
                     2020<br />
                <input type="radio" name="extaudit_2014" value="4" required <?php if($extaudit_2014=="4"){ echo "checked";}?> >Yes<br />
                <input type="radio" name="extaudit_2014" value="1" <?php if($extaudit_2014=="1"){ echo "checked";}?> >No
                    <br /><br />
                     2021<br />
                <input type="radio" name="extaudit_2015" value="4" required <?php if($extaudit_2015=="4"){ echo "checked";}?> >Yes<br />
                <input type="radio" name="extaudit_2015" value="1" <?php if($extaudit_2015=="1"){ echo "checked";}?> >No
                    </i><br /><br />
                    
                    <label>54. Is there a revenue accounting department in the SIRS?<span>*</span></label><br />
                <input type="radio" name="rev_dept" value="4" required <?php if($rev_dept=="4"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="rev_dept" value="1" <?php if($rev_dept=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    <label>55. Is the revenue accounting department different from the assessment and tax collection department?<span>*</span></label><br />
                <input type="radio" name="revdept_diff" value="4" required <?php if($revdept_diff=="4"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="revdept_diff" value="1" <?php if($revdept_diff=="1"){ echo "checked";}?> ><i>No</i>
                <br><br>
                    <input type="checkbox" name="completed" value="1" <?php echo $checked;?>/><i>Mark This Form Entry As Finalized</i><br>
                    <i>Note: You will not be able to edit the form entry if you check this box</i>
                    <br /><br />
                    
                    <input  type="reset" value="Reset" />
                    <input  type="submit" value="Submit" />

                </form>
            </div>
           
        </div>
    </body>
</html>