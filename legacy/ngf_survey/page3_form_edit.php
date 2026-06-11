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
        <button onclick="myFunction()">Print Form</button>

<script>
function myFunction() {
    window.print();
}
</script>

    </head>
    <body>
        <div class="container">
            <div class="main">
                <h2>Tax Processing (Manual Versus Automated)</h2><hr/>
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
			$sql=mysqli_query ($con, "SELECT survey_id,central_platform,platform_work,auto_platform,online_acc,realtime_acc,use_consultant,tax_agent,exclu_agent,levy_collect,levy_collect1,levy_collect2,levy_collect3,levy_collect4,levy_collect5,levy_collect6,other_tax,govt_dept,govtdept_levy,sbircollect_lg,sbircollectlg_levy,all_cases,state_mechanism,payment_audit,a2013_audit,a2014_audit,a2015_audit,conext_audit,a2013_extaudit,a2014_extaudit,a2015_extaudit,rev_dept,revdept_diff,collate_mda_levies,collate_lga_levies,collect_by_agent,sbircollect_mda,sbircollectmda_levy,completed FROM survey2 WHERE survey_id='$surveyid'");
			
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
				$completed=$row['completed'];
			}
		?>
                
                <h3>Tax payment (cash paid to tax officers versus bank and electronic payment)</h3>
              <form action="page3_update.php?mode=update" method="post" novalidate>
              <input name="surveyid" type="text" value="<?php echo $surveyid; ?>" hidden="true"  ><br>
                <label>44a. Is there a central platform for collection of taxes in the state?<span>*</span></label><br />
                <input type="radio" name="central_platform" id="" value="4" required <?php if($central_platform=="4"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="central_platform" id="" value="1" <?php if($central_platform=="1"){ echo "checked";}?>><i>No</i>
                    <br /><br />

                    <i>If yes, describe how it works?<br/>
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
                <input type="radio" name="use_consultant" id="" value="1" required <?php if($use_consultant=="1"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="use_consultant" id="" value="4" <?php if($use_consultant=="4"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    <i>47b. If yes, are these:<br><br />
                    
                    Taxes collected by agents in addition to SIRS staff:<br />
                <input type="radio" name="tax_agent" value="3" <?php if($tax_agent=="3"){ echo "checked";}?> >Yes<br />
                <input type="radio" name="tax_agent" value="1" <?php if($tax_agent=="1"){ echo "checked";}?> >No
               </i>     <br /><br />
               
                    <i>Taxes exclusively collected by agents:<br />
                <input type="radio" name="exclu_agent" value="1" required <?php if($exclu_agent=="1"){ echo "checked";}?> >Yes<br />
                <input type="radio" name="exclu_agent" value="3" <?php if($exclu_agent=="3"){ echo "checked";}?> >No
              </i>      <br /><br />
              
              <i>Are the taxes etc collected by agents first paid into an escrow account?<br />
                <input type="radio" name="collect_by_agent" value="1" required <?php if($collect_by_agent=="1"){ echo "checked";}?> >Yes<br />
                <input type="radio" name="collect_by_agent" value="3" <?php if($collect_by_agent=="3"){ echo "checked";}?> >No
              </i>      <br /><br />
              
                    <i>If Yes, which of the following taxes/levies are collected by agents/consultants: (please tick as apply)<br />
                <input type="checkbox" name="levy_collect" value="1" required <?php if($levy_collect=="1"){ echo "checked";}?> >Personal Income Tax<br />
                <input type="checkbox" name="levy_collect1" value="1" <?php if($levy_collect1=="1"){ echo "checked";}?> >Pay As You Earn (PAYE)<br />
                <input type="checkbox" name="levy_collect2" value="1" required <?php if($levy_collect2=="1"){ echo "checked";}?> >Withholding Tax (WHT) (Individuals and partnerships)<br />
                <input type="checkbox" name="levy_collect3" value="1" <?php if($levy_collect3=="1"){ echo "checked";}?> >Sales Taxes<br />
                <input type="checkbox" name="levy_collect4" value="1" <?php if($levy_collect4=="1"){ echo "checked";}?> >Advertising Taxes<br />
                <input type="checkbox" name="levy_collect5" value="1" required <?php if($levy_collect5=="1"){ echo "checked";}?> >Property Taxes<br />
                <input type="checkbox" name="levy_collect6" value="1" <?php if($levy_collect6=="1"){ echo "checked";}?> >Other Taxes/Levies, Please Specify<input name="other_tax" id="other_tax" type="text" size="20" value="<?php echo $other_tax; ?>"></i>
                    <br />
                    
                    <label>48a. Does any MDA collect taxes/levies/charges on behalf of the SIRS?<span>*</span></label><br />
                <input type="radio" name="govt_dept" id="" value="2" required <?php if($govt_dept=="2"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="govt_dept" id="" value="1" <?php if($govt_dept=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />

                    <i>48b. If yes, which taxes/levies?<br/>
                      <textarea name="govtdept_levy" id=""><?php echo $govtdept_levy; ?></textarea>
                 </i>   <br />
                    <label>49a. Does the SIRS collect any revenue on behalf of the Local Government?<span>*</span></label><br />
                <input type="radio" name="sbircollect_lg" id="" value="3" required <?php if($sbircollect_lg=="3"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="sbircollect_lg" id="" value="1" <?php if($sbircollect_lg=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />

                    <i>49b. If yes, which taxes/levies?<br/>
                      <textarea name="sbircollectlg_levy" id=""><?php echo $sbircollectlg_levy; ?></textarea></i>
                    <br />
                    
                    <label>50. Does the SIRS collect all MDA revenues?<span>*</span></label><br />
                <input type="radio" name="sbircollect_mda" id="" value="3" required <?php if($sbircollect_mda=="3"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="sbircollect_mda" id="" value="1" <?php if($sbircollect_mda=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />

                    <i>If yes, which taxes/levies?<br/>
                      <textarea name="sbircollectmda_levy" id=""><?php echo $sbircollectmda_levy; ?></textarea></i>
                    <br />
                    
                    <label>51a. What is the accounting mechanism?<span>*</span></label><br /><br />
                    <i>Is the payment of all taxes and levies direct to a nominated government account held in a bank in:</i><br>
                    <i>All cases?</i><br />
                <input type="radio" name="all_cases" id="" value="4" required <?php if($all_cases=="4"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="all_cases" id="" value="1" <?php if($all_cases=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    <i>51b. If No, what is the mechanism for the state?<br/>
                      <textarea name="state_mechanism" id=""><?php echo $state_mechanism; ?></textarea></i>
                    <br />
                    <label>52a. What checks and balances for audit purposes?<span>*</span></label><br /><br />
                    <i>Does the State Internal Audit unit audit the payments of taxes and levies collected?</i><br>
                <input type="radio" name="payment_audit" id="" value="4" required <?php if($payment_audit=="4"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="payment_audit" id="" value="1" <?php if($payment_audit=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    <i>52b. If yes, has this been carried out for the following years?<br><br />
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
                <input type="radio" name="conext_audit" id="" value="4" required <?php if($conext_audit=="4"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="conext_audit" id="" value="1" <?php if($conext_audit=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    <i>53b. If yes, has this been carried out for the following years?<br><br />
                    2019<br />
                <input type="radio" name="extaudit_2013" value="4" <?php if($extaudit_2013=="4"){ echo "checked";}?> >Yes<br />
                <input type="radio" name="extaudit_2013" value="1" <?php if($extaudit_2013=="1"){ echo "checked";}?> >No
                    <br /><br />
                     2020<br />
                <input type="radio" name="extaudit_2014" value="4" <?php if($extaudit_2014=="4"){ echo "checked";}?> >Yes<br />
                <input type="radio" name="extaudit_2014" value="1" <?php if($extaudit_2014=="1"){ echo "checked";}?> >No
                    <br /><br />
                     2021<br />
                <input type="radio" name="extaudit_2015" value="4" <?php if($extaudit_2015=="4"){ echo "checked";}?> >Yes<br />
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
                    <input type="checkbox" name="completed" value="1" <?php if($completed=="1"){ echo "checked";}?>/><i>Mark This Form Entry As Finalized</i><br>
                    <i>Note: You will not be able to edit the form entry if you check this box</i>
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