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
        <title>Questionnaire Annex</title>
        <link rel="stylesheet" href="style.css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
        <button onclick="myFunction()">Print Form</button>

    </head>
    <body>

        <div class="container">
            <div class="main">
                <h2>Monthly Data</h2><hr/>
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
			$annexId=$_GET["annexId"]; //echo $annexId;
			//$sql="select stateId,stateName,zoneId, statePopulation from $state where stateId='$stateId'";
			$sql=mysqli_query($con, "SELECT annexId,mysession,state,month,year,paye,tax_audit,wht,direct_assess,direct_informal,capital_gain,levies,taxpayer_reg,monthly_tin,num_levies,num_education,num_appeal,num_cases,num_hinwi,num_license,completed,mda_revenue FROM annex WHERE annexId='$annexId'");
			
			//$result=mysql_query($sql,$db) or die(mysql_error());
			while($row=mysqli_fetch_array($sql)) {
				$annexId=$row['annexId'];
				$state=$row['state'];
				$month=$row['month'];
				$year=$row['year'];
				$paye=$row['paye'];
				$tax_audit=$row['tax_audit'];
				$wht=$row['wht'];
				$direct_assess=$row['direct_assess'];
				$direct_informal=$row['direct_informal'];
				$capital_gain=$row['capital_gain'];
				$levies=$row['levies'];
				$taxpayer_reg=$row['taxpayer_reg'];
				$monthly_tin=$row['monthly_tin'];
				$num_levies=$row['num_levies'];
				$num_education=$row['num_education'];
				$num_appeal=$row['num_appeal'];
				$num_cases=$row['num_cases'];
				$num_hinwi=$row['num_hinwi'];
				$num_license=$row['num_license'];
				$completed=$row['completed'];
				$mda_revenue=$row['mda_revenue'];
			}
		?>
                
                <form action="annex_update.php?mode=update" method="post">
               <input name="annexId" type="text" value="<?php echo $annexId; ?>" hidden="true"  >
                <input name="mysession" type="text" value="<?php echo $userRow['username']; ?>" hidden="true"  >
                
                <label>Which State are you filling for?<span>*</span></label><br />
                    <input name="state" type="text" value="<?php echo $state; ?>" readonly >
				
                <label>Which month of the year are you filling for?<span>*</span></label><br />
                    <input name="month" type="text" value="<?php echo $month; ?>" readonly >
                    
                    <label>Which year are you filling for?<span>*</span></label><br />
                    <input name="year" type="text" value="<?php echo $year; ?>" readonly >                    <br />

                    <br />
                  <label>PAYE</label>
                    <br />
                  <input name="paye" step="any" type="number" value="<?php echo $paye; ?>"  >
                    <br />
                    <label>Tax Audit/Back Duty</label><br />
                  <input name="tax_audit" step="any" type="number" value="<?php echo $tax_audit; ?>"  >
                    <br />
                    <label>WHT (All)</label><br />
                   <input name="wht" step="any" type="number" value="<?php echo $wht; ?>" >
                    <br />
<label>Direct Assessment</label><br /><input type="number" step="any" name="direct_assess" value="<?php echo $direct_assess; ?>"  >
                    <br />
                    <label>Direct Assessment (Informal Sector)</label><br />
                    <input name="direct_informal" step="any" type="number" value="<?php echo $direct_informal; ?>"  >
                    <br />
                    <label>Capital Gains Tax</label><input name="capital_gain" step="any" type="number" value="<?php echo $capital_gain; ?>"  >
                    <br />
                    <label>MDA Revenues</label><input name="mda_revenue" step="any" type="number" value="<?php echo $mda_revenue; ?>"  >
                    <br />
                    <label>Other Taxes/Levies/Charges</label><input name="levies" step="any" type="number" value="<?php echo $levies; ?>"  >
                    <br />
                    <label>Taxpayer Registration No of TINs per JTB</label><input name="taxpayer_reg" type="number" value="<?php echo $taxpayer_reg; ?>"  >
                    <br />
                    <label>New Monthly TINs registered</label><input name="monthly_tin" type="number" value="<?php echo $monthly_tin; ?>"  >
                    <br />
                    <label>No of Taxes/Levies Instruments amended/passed/signed in the month</label><input name="num_levies" type="number" value="<?php echo $num_levies; ?>"  >
                    <br />
                    <label>Number of Tax Education Activities</label><input name="num_education" type="number" value="<?php echo $num_education; ?>"  >
                    <br />
                    <label>Number of Tax Appeal Tribunal (TAT) cases</label><input name="num_appeal" type="number" value="<?php echo $num_appeal; ?>"  >
                    <br />
                    <label>Number of Tax debt cases in Court</label><input name="num_cases" type="number" value="<?php echo $num_cases; ?>"  >
                    <br />
                    <label>Number of HINWI Taxpayers</label><input name="num_hinwi" type="number" value="<?php echo $num_hinwi; ?>"  >
                    <br />
                    <label>Number of Motor Vehicle Licenses Issued</label><input name="num_license" type="number" value="<?php echo $num_license; ?>"  >
                    <br>
                    <input type="checkbox" name="completed" value="1" <?php if($completed=="1"){ echo "checked";}?>/><i>Mark This Form Entry As Finalized</i><br>
                    <i>Note: You will not be able to VIEW OR edit the form entry if you check this box</i>
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