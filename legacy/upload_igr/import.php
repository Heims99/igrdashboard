<?php
//Session starts here
session_start();
include_once '../connection.php';
if(!isset($_SESSION['user']))
{ 
header("Location: login.php");
}
$privilege=$_SESSION['privilege'];
if ($privilege==5)
{
	echo "<p><font style='tahoma' color='red' size='3px'>Invalid user!</font></p><p><font style='tahoma' color='red' size='3px'>You do not have authorized access to this page</font></p>";
	exit();
}
$con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
$res=mysqli_query($con, "SELECT * FROM users WHERE user_id='".$_SESSION['user']."'"); //echo $res;
$userRow=mysqli_fetch_array($res);
?>
<?php  

//connect to the database 
$con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
// 

if ($_FILES[csv][size] > 0) { 

    //get the csv file 
    $file = $_FILES[csv][tmp_name]; 
    $handle = fopen($file,"r"); 
     
    //loop through the csv file and insert into database 
    do { 
        if ($data[0]) { 
            mysqli_query($con, "INSERT INTO faacMonthly (state, january, february, march, april, may, june, july, august, september, october, november, december, faacYear) VALUES 
                ( 
                    '".addslashes($data[0])."', 
                    '".addslashes($data[1])."', 
                    '".addslashes($data[2])."',
					'".addslashes($data[3])."', 
                    '".addslashes($data[4])."',
					'".addslashes($data[5])."', 
                    '".addslashes($data[6])."',
					'".addslashes($data[7])."', 
                    '".addslashes($data[8])."',
					'".addslashes($data[9])."', 
                    '".addslashes($data[10])."',
					'".addslashes($data[11])."', 
                    '".addslashes($data[12])."',
					'".addslashes($data[13])."'
                ) 
            "); 
        } 
    } while ($data = fgetcsv($handle,200,",","'")); 
    // 

    //redirect 
    header('Location: import.php?success=1'); die; 

} 

?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
<title>Import FAAC Data</title> 
<link href="../css/style.css" rel="stylesheet" type="text/css" />
</head> 

<body>
<table width="100%" border="0" class="outer_table">
  <tr><td>
<?php if (!empty($_GET[success])) { echo "<h4>Your file has been uploaded successfully!</h4><br><br>"; } //generic success notice ?> 

<form action="import.php" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
  <h4>Choose  CSV file from your PC: </h4><br /> 
  <input name="csv" type="file" id="csv" /> 
  <input type="submit" name="Submit" value="Submit" /> 
</form> 
</td></tr><tr><td><h4>Instruction on how to upload CVS file for FAAC data:</h4>
Before uploading a CSV file, delete the column headers in the excel sheet containing the FAAC data. Also delete the  'Total' for both column and row. Finally add a column at  the end of the last column with the FAAC year for each state, then save as CSV (.csv) file. </td></tr></table>
<table width="100%"><tr><td><table width="100%" border="0">
  
</table></td></tr></table>
</body> 
</html> 