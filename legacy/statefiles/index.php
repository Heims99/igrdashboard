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
$res=mysqli_query($con, "SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<!-- Add Dropzone -->
<link rel="stylesheet" type="text/css" href="css/dropzone.css" />
<link rel="stylesheet" href="../ngf_survey/style.css" />
<script type="text/javascript" src="js/dropzone.js"></script>
</head>
<body>
<div class="container">
            <div class="main">
                <h2>Drag &amp; Drop File(s)</h2><hr/>
<div class="image_upload_div">
	<form action="upload.php" class="dropzone">
    </form>
</div> 	
</div>

        </div>
</body>
</html>


    

    
    
    
    
    

