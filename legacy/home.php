<?php
session_start();
include_once 'connection.php';

if(!isset($_SESSION['user']))
{
 header("Location: login.php");
}
//Jul 3
$privilege=$_SESSION['privilege'];
if ($privilege==0)
{
	?>
	<script>alert('you do not have authorized access to this page');</script> 
<?php
exit("Oops!!! You are trying to access a page that requires permission. Please use the back arrow button at the top of your browser to go back to the previous page");
}
$con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
$res=mysqli_query($con, "SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res);
//$userRow=mysql_fetch_array($res);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Welcome - <?php echo $userRow['state']; ?></title>
<link rel="stylesheet" href="css/newStyle.css" type="text/css" />
</head>
<body>
<div id="header">
 <div id="left">
   &nbsp;&nbsp;<a href="index.php"><img src="images/NGF_logo.png" width="168" height="70" alt="NGF Logo" /></a><label>Nigeria Governors' Forum Dashboard Management</label>
  </div>
    <div id="right">
     <div id="content">
         Welcome, <?php echo $userRow['username']; ?>&nbsp;<a href="logout.php?logout">Sign Out</a>
      </div>
  </div>
</div>

</div>
</div>
<?php include ("main.php"); ?>
</body>
</html>