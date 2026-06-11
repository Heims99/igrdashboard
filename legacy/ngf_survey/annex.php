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
        <title>Monthly Data</title>
        <link rel="stylesheet" href="style.css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
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
                <form action="insertdata.php" method="post" novalidate>
                <input name="mysession" type="text" value="<?php echo $userRow['username']; ?>" hidden="true"  >
                <select name="state" hidden="true"><?php
		  //include '../connection.php';
		  $con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
   $sql = mysqli_query($con, "SELECT DISTINCT(state.stateName), state.stateId, users.username FROM state, users WHERE state.stateName=users.state AND users.username='".$userRow['username']."'");
   //$result = mysql_query($sql);
    // if(mysql_num_rows($result)) {
       // we have at least one practice, so show all practice as options in select form
       while($row = mysqli_fetch_row($sql))
       {
          print("<option value=\"$row[0]\">$row[0]</option>");
       } 
?></select>
				
                <label>Which month of the year are you filling for?<span>*</span></label><br />
                    <select name="month">
                        <option value="">----Select Month of the Year----</options>
                        <option value="January" value="">January </options>
                        <option value="February" value="">February </options>
                        <option value="March" value="">March </options>
                        <option value="April" value="">April </options>
                        <option value="May" value="">May </options>
                        <option value="June" value="">June </options>
                        <option value="July" value="">July </options>
                        <option value="August" value="">August </options>
                        <option value="September" value="">September </options>
                        <option value="October" value="">October </options>
                        <option value="November" value="">November </options>
                        <option value="December" value="">December </options>
                    </select>
                    <label>Which year are you filling for?<span>*</span></label><br />
                  <select name="year">
                        <option value="">----Select Year----</options>
                        <option value="2015" value="">2015 </options>
                        <option value="2016" value="">2016 </options>
                        <option value="2017" value="">2017 </options>
                        <option value="2018" value="">2018 </options>
                        <option value="2019" value="">2019 </options>
                        <option value="2020" value="">2020 </options>
                        <option value="2021" value="">2021 </options>
                        <option value="2022" value="">2022 </options>
                        <option value="2023" value="">2023 </options>
                        <option value="2024" value="">2024 </options>
                        <option value="2025" value="">2025 </options>
                    </select>
                  <br />
                    <br />
                  <label>PAYE</label>
                    <br />
                  <input name="paye" step="any" type="number" placeholder="Enter amount without comma e.g 100000000 or 100000000.00 if with decimal"  >
                    <br />
                    <label>Tax Audit/Back Duty</label><br />
                  <input name="tax_audit" step="any" type="number" placeholder="Enter amount without comma e.g 100000000 or 100000000.00 if with decimal"  >
                    <br />
                    <label>WHT (All)</label><br />
                   <input name="wht" step="any" type="number" placeholder="Enter amount without comma e.g 100000000 or 100000000.00 if with decimal">
                    <br />
<label>Direct Assessment</label><br /><input type="number" step="any" name="direct_assess" placeholder="Enter amount without comma e.g 100000000 or 100000000.00 if with decimal"  >
                    <br />
                    <label>Direct Assessment (Informal Sector)</label><br />
                    <input name="direct_informal" step="any" type="number" placeholder="Enter amount without comma e.g 100000000 or 100000000.00 if with decimal"  >
                    <br />
                    <label>Capital Gains Tax</label><input name="capital_gain" step="any" type="number" placeholder="Enter amount without comma e.g 100000000 or 100000000.00 if with decimal"  >
                    <br />
                    <label>MDA Revenues</label><input name="mda_revenue" step="any" type="number" placeholder="Enter amount without comma e.g 100000000 or 100000000.00 if with decimal"  >
                    <br />
                    <label>Other Taxes/Levies/Charges</label><input name="levies" step="any" type="number" placeholder="Enter amount without comma e.g 100000000 or 100000000.00 if with decimal"  >
                    <br />
                    <label>Taxpayer Registration No of TINs per JTB</label><input name="taxpayer_reg" type="number" placeholder="Enter number without comma e.g 1000"  >
                    <br />
                    <label>New Monthly TINs registered</label><input name="monthly_tin" type="number" placeholder="Enter number without comma e.g 1000"  >
                    <br />
                    <label>No of Taxes/Levies Instruments amended/passed/signed in the month</label><input name="num_levies" type="number" placeholder="Enter number without comma e.g 1000"  >
                    <br />
                    <label>Number of Tax Education Activities</label><input name="num_education" type="number" placeholder="Enter number without comma e.g 1000"  >
                    <br />
                    <label>Number of Tax Appeal Tribunal (TAT) cases</label><input name="num_appeal" type="number" placeholder="Enter number without comma e.g 1000"  >
                    <br />
                    <label>Number of Tax debt cases in Court</label><input name="num_cases" type="number" placeholder="Enter number without comma e.g 1000"  >
                    <br />
                    <label>Number of HINWI Taxpayers</label><input name="num_hinwi" type="number" placeholder="Enter number without comma e.g 1000"  >
                    <br />
                    <label>Number of Motor Vehicle Licenses Issued</label><input name="num_license" type="number" placeholder="Enter number without comma e.g 1000"  >
                    <br>
                    <input type="checkbox" name="completed" value="1" <?php echo $checked;?>/><i>Mark This Form Entry As Finalized</i><br>
                    <i>Note: You will not be able to VIEW OR edit the form entry if you check this box</i>
                    <br /><br />
                    
                    <input  type="reset" value="Reset" />
                    <input  type="submit" value="Submit" />

                </form>
            </div>

        </div>
    </body>
</html>