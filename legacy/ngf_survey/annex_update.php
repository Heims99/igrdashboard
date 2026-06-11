<?php
include("../connection.php");
$mode=$_GET["mode"];
if($mode=="update")
{
				$paye=$_POST['paye'];
				$tax_audit=$_POST['tax_audit'];
				$wht=$_POST['wht'];
				$direct_assess=$_POST['direct_assess'];
				$direct_informal=$_POST['direct_informal'];
				$capital_gain=$_POST['capital_gain'];
				$mda_revenue=$_POST['mda_revenue'];
				$levies=$_POST['levies'];
				$taxpayer_reg=$_POST['taxpayer_reg'];
				$monthly_tin=$_POST['monthly_tin'];
				$num_levies=$_POST['num_levies'];
				$num_education=$_POST['num_education'];
				$num_appeal=$_POST['num_appeal'];
				$num_cases=$_POST['num_cases'];
				$num_hinwi=$_POST['num_hinwi'];
				$num_license=$_POST['num_license'];
				$completed=$_POST['completed'];
				$annexId=$_POST['annexId'];
$conn = new mysqli("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql="update annex SET paye='$paye', tax_audit='$tax_audit', wht='$wht', direct_assess='$direct_assess', direct_informal='$direct_informal', capital_gain='$capital_gain', mda_revenue='$mda_revenue', levies='$levies', taxpayer_reg='$taxpayer_reg', monthly_tin='$monthly_tin', num_levies='$num_levies', num_education='$num_education', num_appeal='$num_appeal', num_cases='$num_cases', num_hinwi='$num_hinwi', num_license='$num_license', completed='$completed' WHERE annexId='$annexId'";
if (mysqli_query($conn, $sql)) { 
header("location: submitted_view_annex.php");
   } else {
      echo "Error updating record: " . mysqli_error($conn);
   }
   mysqli_close($conn);
		//	header("location: submitted_view.php");
		  }
?>