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
        <title>TAX ENFORCEMENT</title>
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
                <h2>Tax Enforcement</h2><hr/>
                <span id="error">
                    <?php
                    if (!empty($_SESSION['error_page4'])) {
                        echo $_SESSION['error_page4'];
                        unset($_SESSION['error_page4']);
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
			$sql=mysqli_query($con, "SELECT survey_id,last_conducted,working_cases,concluded_cases,taxpayer_audit,hnwi_unit,hnwi_id,hnwi_action,sirs_lead,agency_coop,tin_tcc,debt_enforce,agent_involve,court_enforce,action_num,taxpayer_aware,tax_edu,tax_edu1,tax_edu2,tax_edu3,tax_edu4,tax_edu5,other_taxedu,igr_effect,tin_effect,tat_effect,complaint_effect,servicom,yes_servicom,complaint_num,no_servicom,process_num,process_timetcc,taxpayer_favor,sbirs_favor,sjtb_functioning,num_timemet,utility_charges,utility_charges1,utility_charges2,utility_charges3,utility_charges4,utility_charges5,utility_charges6,other_charges,edu_charges,health_charges,comment,trained_auditor,vaids_unit,vaid_staff,case_handled,cd_name,cd_designation,cd_mobile,cd_email,completed FROM survey3 WHERE survey_id='$surveyid'");
			
		//	$result=mysql_query($sql,$db) or die(mysql_error()); //echo $result;
			while($row=mysqli_fetch_array($sql)) {
				//$lgaId=$row['mysession'];
				$last_conducted=$row['last_conducted']; 
				$working_cases=$row['working_cases'];
				$concluded_cases=$row['concluded_cases'];
				$taxpayer_audit=$row['taxpayer_audit'];
				$hnwi_unit=$row['hnwi_unit'];
				$hnwi_id=$row['hnwi_id'];
				$hnwi_action=$row['hnwi_action'];
				$sirs_lead=$row['sirs_lead'];
				$agency_coop=$row['agency_coop'];
				$tin_tcc=$row['tin_tcc'];
				$debt_enforce=$row['debt_enforce'];
				$agent_involve=$row['agent_involve'];
				$court_enforce=$row['court_enforce'];
				$action_num=$row['action_num'];
				$taxpayer_aware=$row['taxpayer_aware'];
				$tax_edu=$row['tax_edu'];
				$tax_edu1=$row['tax_edu1'];
				$tax_edu2=$row['tax_edu2'];
				$tax_edu3=$row['tax_edu3'];
				$tax_edu4=$row['tax_edu4'];
				$tax_edu5=$row['tax_edu5'];
				$other_taxedu=$row['other_taxedu'];
				$igr_effect=$row['igr_effect'];
				$tin_effect=$row['tin_effect'];
				$tat_effect=$row['tat_effect'];
				$complaint_effect=$row['complaint_effect'];
				$servicom=$row['servicom'];
				$yes_servicom=$row['yes_servicom'];
				$complaint_num=$row['complaint_num'];
				$no_servicom=$row['no_servicom'];
				$process_num=$row['process_num'];
				$process_timetcc=$row['process_timetcc'];
				$taxpayer_favor=$row['taxpayer_favor'];
				$sbirs_favor=$row['sbirs_favor'];
				$sjtb_functioning=$row['sjtb_functioning'];
				$num_timemet=$row['num_timemet'];
				$utility_charges=$row['utility_charges'];
				$utility_charges1=$row['utility_charges1'];
				$utility_charges2=$row['utility_charges2'];
				$utility_charges3=$row['utility_charges3'];
				$utility_charges4=$row['utility_charges4'];
				$utility_charges5=$row['utility_charges5'];
				$utility_charges6=$row['utility_charges6'];
				$other_charges=$row['other_charges'];
				$edu_charges=$row['edu_charges'];
				$health_charges=$row['health_charges'];
				$comment=$row['comment'];
				$trained_auditor=$row['trained_auditor'];
				$vaids_unit=$row['vaids_unit'];
				$vaid_staff=$row['vaid_staff'];
				$case_handled=$row['case_handled'];
				$cd_name=$row['cd_name'];
				$cd_designation=$row['cd_designation'];
				$cd_mobile=$row['cd_mobile'];
				$cd_email=$row['cd_email'];
				$completed=$row['completed'];
			}
		?>
                <h3>Capacity for taxpayer audits</h3>
              <form action="page4_update.php?mode=update" method="post" novalidate>
              <input name="surveyid" type="text" value="<?php echo $surveyid; ?>" hidden="true"  ><br>
                <label>56a. Has the state conducted taxpayer tax audits?<span>*</span></label><br />
                <input type="radio" name="taxpayer_audit" value="4" <?php if($taxpayer_audit=="4"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="taxpayer_audit" value="1" <?php if($taxpayer_audit=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    
                    <i>If yes, has it been conducted in the last:</i><br/>
                      <input type="radio" name="last_conducted" value="5" <?php if($last_conducted=="5"){ echo "checked";}?> ><i>Six months</i><br />
                <input type="radio" name="last_conducted" value="3" <?php if($last_conducted=="3"){ echo "checked";}?> ><i>One year</i><br />
                <input type="radio" name="last_conducted" value="1" <?php if($last_conducted=="1"){ echo "checked";}?> ><i>Never</i>
                    <br /><br />
                    
                    <i>If Yes - How many cases are:</i><br/><br /><i>Working?</i><br />
                      <input type="radio" name="working_cases" value="1" <?php if($working_cases=="1"){ echo "checked";}?> ><i>1 - 10</i><br />
                <input type="radio" name="working_cases" value="2" <?php if($working_cases=="2"){ echo "checked";}?> ><i>10 - 20</i><br />
                <input type="radio" name="working_cases" value="4" <?php if($working_cases=="4"){ echo "checked";}?> ><i>20 - 50</i><br />
                <input type="radio" name="working_cases" value="6" <?php if($working_cases=="6"){ echo "checked";}?> ><i>50+</i>
                    <br /><br />
                    
                    <i>Concluded in the last one year</i><br />
                      <input type="radio" name="concluded_cases" value="1" <?php if($concluded_cases=="1"){ echo "checked";}?> ><i>1 - 10</i><br />
                <input type="radio" name="concluded_cases" value="2" <?php if($concluded_cases=="2"){ echo "checked";}?> ><i>10 - 20</i><br />
                <input type="radio" name="concluded_cases" value="4" <?php if($concluded_cases=="4"){ echo "checked";}?> ><i>20 - 50</i><br />
                <input type="radio" name="concluded_cases" value="6" <?php if($concluded_cases=="6"){ echo "checked";}?> ><i>50+</i>
                    <br /><br>
                    
                    <label>57. How many trained Audit Staff are working in the SIRS?<span>*</span></label><br />
                <input type="radio" name="trained_auditor" value="2" required <?php if($trained_auditor=="2"){ echo "checked";}?> ><i>0 - 2</i><br />
                <input type="radio" name="trained_auditor" value="3" <?php if($trained_auditor=="3"){ echo "checked";}?> ><i>3 - 5</i><br />
                <input type="radio" name="trained_auditor" value="5" <?php if($trained_auditor=="5"){ echo "checked";}?> ><i>more than 5</i>
                    <br />
                    
                    <h3>High Net Worth Individuals (HNWI)</h3>
                    <label>58. Is there a special unit for HNWI?<span>*</span></label><br />
                <input type="radio" name="hnwi_unit" value="4" <?php if($hnwi_unit=="4"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="hnwi_unit" value="1" <?php if($hnwi_unit=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    
                    <label>59a. Does the SBIR have a HNWI unit ?<span>*</span></label><br />
                <input type="radio" name="vaids_unit" id="vaidsunity" value="4" required <?php if($vaids_unit=="4"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="vaids_unit" id="vaidsunitn" value="1" <?php if($vaids_unit=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    
                    <i>59b. If yes, how many staff are in the unit?<br/>
                      <input type="radio" name="vaid_staff" value="1" required <?php if($vaid_staff=="1"){ echo "checked";}?> >0 - 3<br />
                <input type="radio" name="vaid_staff" value="3" <?php if($vaid_staff=="3"){ echo "checked";}?> >3 - 9<br />
                <input type="radio" name="vaid_staff" value="4" <?php if($vaid_staff=="4"){ echo "checked";}?> >10+
                    </i><br /><br />
                    
                    <i>59c. How are such cases usually handled?<br/>
                      <input type="radio" name="case_handled" value="4" required <?php if($case_handled=="4"){ echo "checked";}?> >By the HNWI unit<br />
                <input type="radio" name="case_handled" value="3" <?php if($case_handled=="3"){ echo "checked";}?> >By a special team<br />
                <input type="radio" name="case_handled" value="2" <?php if($case_handled=="2"){ echo "checked";}?> >No special arrangement
                <br />
                <input type="radio" name="case_handled" value="1" <?php if($case_handled=="1"){ echo "checked";}?> >Other
                    </i><br /><br />
                    
                    <label>60. Are the HNWI identified in the database?<span>*</span></label><br />
                <input type="radio" name="hnwi_id" value="4" <?php if($hnwi_id=="4"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="hnwi_id" value="1" <?php if($hnwi_id=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    <label>61. Has action been taken to assess and/or recover taxes from HNWI?<span>*</span></label><br />
                <input type="radio" name="hnwi_action" value="4" <?php if($hnwi_action=="4"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="hnwi_action" value="1" <?php if($hnwi_action=="1"){ echo "checked";}?> ><i>No</i>
                    <br />
                    <h3>Other inter-agency cooperation</h3>
                    
                    <label>62a. Does the SIRS lead or support the computation of the State’s IGR revenue forecast in the annual budget process?<span>*</span></label><br />
                <input type="radio" name="sirs_lead" value="4" <?php if($sirs_lead=="4"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="sirs_lead" value="1" <?php if($sirs_lead=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    
                    <label>62. Is there any inter-agency cooperation in the State?<span>*</span></label><br />
                <input type="radio" name="agency_coop" value="4" <?php if($agency_coop=="4"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="agency_coop" value="1" <?php if($agency_coop=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    <label>63. Does the SIR make presentations of TIN and Tax Clearance Certificate (TCC) mandatory for processing Driver's licences and number plates?</label><br />
                <input type="radio" name="tin_tcc" value="4" <?php if($tin_tcc=="4"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="tin_tcc" value="1" <?php if($tin_tcc=="1"){ echo "checked";}?> ><i>No</i>
                    <h3>Tax Debt Enforcement:</h3>
                <label>64.  Does the SIRS have a tax debt enforcement department?<span>*</span></label><br />
                <input type="radio" name="debt_enforce" value="4" <?php if($debt_enforce=="4"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="debt_enforce" value="1" <?php if($debt_enforce=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    <label>65. Are agents or consultants involved in collecting the outstanding taxes?<span>*</span></label><br />
                <input type="radio" name="agent_involve" value="4" <?php if($agent_involve=="4"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="agent_involve" value="1" <?php if($agent_involve=="1"){ echo "checked";}?> ><i>No</i><br />
                    <label>66a. Has the SIRS conducted any tax enforcement action either through the courts or by distrain action in the last one year?<span>*</span></label><br />
                <input type="radio" name="court_enforce" value="4" <?php if($court_enforce=="4"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="court_enforce" value="1" <?php if($court_enforce=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />

                    <i>If yes, how many actions</i><br/>
                      <input type="radio" name="action_num" value="1" <?php if($action_num=="1"){ echo "checked";}?> ><i>0 -10 Enforcement actions</i><br />
                    <input type="radio" name="action_num" value="2" <?php if($action_num=="2"){ echo "checked";}?> ><i>10 – 20 Enforcement actions</i><br />
                    <input type="radio" name="action_num" value="4" <?php if($action_num=="4"){ echo "checked";}?> ><i>20 – 50 Enforcement actions</i><br />
                    <input type="radio" name="action_num" value="6" <?php if($action_num=="6"){ echo "checked";}?> ><i>50+ Enforcement actions</i>
                    <br />
                    <h3>Tax Awareness Campaigns</h3>
                <label>67. Are the State taxpayers aware of the taxes they have to pay, the rates of tax and the procedures for making a return and self-assessment?<span>*</span></label><br />
                <input type="radio" name="taxpayer_aware" value="4" <?php if($taxpayer_aware=="4"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="taxpayer_aware" value="1" <?php if($taxpayer_aware=="1"){ echo "checked";}?> ><i>No</i><br />
                <input type="radio" name="taxpayer_aware" value="2" <?php if($taxpayer_aware=="2"){ echo "checked";}?> ><i>Partially</i>
                    <br /><br />
                    <label>68. Which of the following tax education programmes or channels have you used in the last 12 months? (Tick all that Apply)<span>*</span></label><br />
                    <input type="checkbox" name="tax_edu" value="1" <?php if($tax_edu=="1"){ echo "checked";}?> ><i>Newspapers</i><br />
                    <input type="checkbox" name="tax_edu1" value="1" <?php if($tax_edu1=="1"){ echo "checked";}?> >
                    <i>Radio jingles</i><br />
                    <input type="checkbox" name="tax_edu2" value="1" <?php if($tax_edu2=="1"){ echo "checked";}?> >
                    <i>TV programmes</i><br />
                    <input type="checkbox" name="tax_edu3" value="1" <?php if($tax_edu3=="1"){ echo "checked";}?> >
                    <i>Road shows</i><br />
                    <input type="checkbox" name="tax_edu4" value="1" <?php if($tax_edu4=="1"){ echo "checked";}?> ><i>Workshops</i><br />
                    <input type="checkbox" name="tax_edu5" value="1" <?php if($tax_edu5=="1"){ echo "checked";}?> >
                    <i>Other</i>
                    <i>, please specify</i>
                    <input name="other_taxedu" id="other_taxedu" type="text" value="<?php echo $other_taxedu; ?>">
                    <br />
                    <label>69. Does the SIRS evaluate the effectiveness of these channels by increase in:<span>*</span></label><br /><br />
                    <i>IGR?</i><br />
                <input type="radio" name="igr_effect" value="3" <?php if($igr_effect=="3"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="igr_effect" value="1" <?php if($igr_effect=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                     <i>TIN Registration?</i><br />
                <input type="radio" name="tin_effect" value="3" <?php if($tin_effect=="3"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="tin_effect" value="1" <?php if($tin_effect=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                     <i>Tax Appeal Tribunal (TAT Cases)?</i><br />
                <input type="radio" name="tat_effect" value="3" <?php if($tat_effect=="3"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="tat_effect" value="1" <?php if($tat_effect=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    <i>Complaints?</i><br />
                <input type="radio" name="complaint_effect" value="3" <?php if($complaint_effect=="3"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="complaint_effect" value="1" <?php if($complaint_effect=="1"){ echo "checked";}?> ><i>No</i>
                    <br />
                    <h3>Complaints</h3>
                    <label>70a. Does the SIRS have a service charter?<span>*</span></label><br />
                <input type="radio" name="servicom" value="3" <?php if($servicom=="3"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="servicom" value="1" <?php if($servicom=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    <i>70b. Please explain the usual process and the channel(s) for receiving and resolving taxpayer complaints:</i><input name="yes_servicom" id="yes_servicom" type="text" size="20" value="<?php echo $yes_servicom; ?>" >
                    <br /><br />
                    <i>If no, what system do you use to track complaints and customer standards?</i>
                     <input name="no_servicom" id="no_servicom" type="text" size="20" value="<?php echo $no_servicom; ?>" >
                    <br /><br />
                    <label>71. Number of complaints handled in last 6 months<span>*</span></label> <i>(Please note that complaints do not include objections to assessments. It is about complaints such as staff behaviour etc.)</i><br />
                <input type="radio" name="complaint_num" value="1" <?php if($complaint_num=="1"){ echo "checked";}?> ><i>< 20</i><br />
                <input type="radio" name="complaint_num" value="2" <?php if($complaint_num=="2"){ echo "checked";}?> ><i>20 - 50</i><br />
                <input type="radio" name="complaint_num" value="5" <?php if($complaint_num=="5"){ echo "checked";}?> ><i>50+</i>
                    <br /><br />
                    <label>72. Number of process changes as a result of complaints in last six months<span>*</span></label> <i>(Please note this does not include changes to assessments as a result of Objections)</i><br />
                <input type="radio" name="process_num" value="0" <?php if($process_num=="0"){ echo "checked";}?> ><i>0</i><br />
                <input type="radio" name="process_num" value="1" <?php if($process_num=="1"){ echo "checked";}?> ><i>1</i><br />
                <input type="radio" name="process_num" value="2" <?php if($process_num=="2"){ echo "checked";}?> ><i>2</i><br />
                <input type="radio" name="process_num" value="5" <?php if($process_num=="5"){ echo "checked";}?> ><i>3+</i><br />
                    <br />
                    <label>73. How long does it take to process TCCs?<span>*</span></label><br />
                <input type="radio" name="process_timetcc" value="4" <?php if($process_timetcc=="4"){ echo "checked";}?> ><i>Same day</i><br />
                <input type="radio" name="process_timetcc" value="3" <?php if($process_timetcc=="3"){ echo "checked";}?> ><i>1-2 weeks</i><br />
                <input type="radio" name="process_timetcc" value="2" <?php if($process_timetcc=="2"){ echo "checked";}?> ><i>3 week</i><br />
                <input type="radio" name="process_timetcc" value="1" <?php if($process_timetcc=="1"){ echo "checked";}?> ><i>Over 4 weeks</i><br />
                    <br />
                    <label>74. In the last 12 months, what is the total number of complaints resolved in taxpayer favour?<span>*</span></label><br />
                <input name="taxpayer_favor" id="taxpayer_favor" type="number" value="<?php echo $taxpayer_favor; ?>" >
                    <br />
                    <label>75. In the last 12 months, what is the total number of complaints resolved in the SBIR's favour?<span>*</span></label><br />
                <input name="sbirs_favor" id="sbirs_favor" type="number" value="<?php echo $sbirs_favor; ?>" >
                    
                    <h3>Tax Harmonisation</h3>
                    <label>76a. Does the state have a consolidated revenue code?<span>*</span></label><br />
                <input type="radio" name="sjtb_functioning" value="4" <?php if($sjtb_functioning=="4"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="sjtb_functioning" value="1" <?php if($sjtb_functioning=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    <i>76b. If yes, are all applicable taxes, fines, levies, and charges in the State harmonised?</i><br />
                    <input type="radio" name="num_timemet" value="4" <?php if($num_timemet=="4"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="num_timemet" value="1" <?php if($num_timemet=="1"){ echo "checked";}?> ><i>No</i>
                    <br />
                    <h3>User Charges for Public Services</h3>
                    <label>77. Does the State have charges for utilities? (Tick all that apply)<span>*</span></label><br />
                    <input type="checkbox" name="utility_charges" value="Water" <?php if($utility_charges=="Water"){ echo "checked";}?> ><i>Water</i><br />
                    <input type="checkbox" name="utility_charges1" value="Electricity" <?php if($utility_charges1=="Electricity"){ echo "checked";}?> ><i>Electricity</i><br />
                    <input type="checkbox" name="utility_charges2" value="Sanitation" <?php if($utility_charges2=="Sanitation"){ echo "checked";}?> ><i>Sanitation</i><br />
                    <input type="checkbox" name="utility_charges3" value="Markets" <?php if($utility_charges3=="Markets"){ echo "checked";}?> ><i>Markets</i><br />
                    <input type="checkbox" name="utility_charges4" value="Transportation" <?php if($utility_charges4=="Transportation"){ echo "checked";}?> ><i>Transportation</i><br />
                    <input type="checkbox" name="utility_charges5" value="Public Transport" <?php if($utility_charges5=="Public Transport"){ echo "checked";}?> ><i>Public Transport</i><br />
                    <input type="checkbox" name="utility_charges6" value="Other" <?php if($utility_charges6=="Other"){ echo "checked";}?> >
                    <i>Other</i>
                    <i>, please specify</i>
                    <input name="other_charges" id="other_charges" type="text" size="20" value="<?php echo $other_charges; ?>" >
                    <br />
                    <label>78. Does the State have charges for education?<span>*</span></label><br />
                <input type="radio" name="edu_charges" value="yes" <?php if($edu_charges=="yes"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="edu_charges" value="no" <?php if($edu_charges=="no"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    <label>79. Does the State have charges for health?<span>*</span></label><br />
                <input type="radio" name="health_charges" value="yes" <?php if($health_charges=="yes"){ echo "checked";}?> ><i>Yes</i><br />
                <input type="radio" name="health_charges" value="no" <?php if($health_charges=="no"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    <label>80. Please add any comments on how to improve this questionnaire.<span>*</span></label><br />
                      <input name="comment" id="comment" type="text" value="<?php echo $comment; ?>" >
                      <br>
                      
                      <h3>Contact Details</h3>
<label>81. Add contact details of individual completing this form<span>*</span></label><br />
<label><i>Name: </i></label><input type="text" name="cd_name" placeholder="Enter Full Name" value="<?php echo $cd_name; ?>" ><br />
<label><i>Designation: </i></label><input type="text" name="cd_designation" placeholder="Your Position" value="<?php echo $cd_designation; ?>" ><br />
<label><i>Phone Number: </i></label><input type="number" name="cd_mobile" placeholder="Your Valid Contact Phone Number" value="<?php echo $cd_mobile; ?>" ><br />
<label><i>Email: </i></label><input type="text" name="cd_email" placeholder="Your Valid Email Address" value="<?php echo $cd_email; ?>" ><br />
                      
                    <input type="checkbox" name="completed" value="1" <?php if($completed=="1"){ echo "checked";}?>/><i>Mark This Form Entry As Finalized</i><br>
                    <i>Note: You will not be able to edit the form entry if you check this box</i>
                    
                    <br><br />
                    
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