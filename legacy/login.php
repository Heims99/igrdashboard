<?php
session_start();
include_once 'connection.php';

if(isset($_SESSION['user'])!="")
{
 header("Location: home.php");
}
if(isset($_POST['btn-login']))
{
$con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}    
 $state = mysqli_real_escape_string($con, $_POST['state']);
 $upass = mysqli_real_escape_string($con, $_POST['pass']);
 $res=mysqli_query($con, "SELECT * FROM users WHERE state='$state' AND (usertypeId=5 OR usertypeId=4)");
 $row=mysqli_fetch_array($res);
 if($row['password']==md5($upass))
 {
  $_SESSION['user'] = $row['user_id'];
  $_SESSION['privilege'] = $row['usertypeId'];
  
  /* Update the login date and time*/	
  $connection = mysqli_connect("localhost", "nggovern_Garki", "NgfBassi1!", "nggovern_dashboard");
	$login_date = date("Y-m-d h:i:s"); 
	mysqli_query($connection, "UPDATE `users` SET `lastLogin`='".$login_date."' WHERE user_id='" . $_SESSION['user'] . "'") or die (mysqli_error($connetion)); 
	//$result = mysql_query($sql) or die(mysql_error());
	
	/* Count number of times logged in*/
	$connection = mysqli_connect("localhost", "nggovern_Garki", "NgfBassi1!", "nggovern_dashboard");
	mysqli_query($connection, "UPDATE users SET totalLogin = totalLogin + 1 WHERE user_id ='" . $_SESSION['user'] . "'") or die (mysqli_error($connection));
	//$result1 = mysql_query($sql1) or die(mysql_error());
	
	/* Locate user ip address*/
	$connection = mysqli_connect("localhost", "nggovern_Garki", "NgfBassi1!", "nggovern_dashboard");
    //$db = mysql_select_db("nggovern_dashboard", $connection);
	$ipaddress = $_SERVER['REMOTE_ADDR'];
	mysqli_query($connection, "INSERT INTO user_log (username, loginDate, ip) VALUES ('$state', '$login_date', INET_NTOA('$ipaddress'))") or die(mysqli_error($connection));
  
 // header("Location: home.php");
 }
 else
 {
  ?>
        <script>alert('incorrect login details');</script>
        <?php
 }
 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NGF IGR Dashboard - Content Admin Login</title>
<link rel="stylesheet" href="css/newStyle.css" type="text/css" />
</head>
<body>
<center>
<div id="login-form">
<form method="post">
<table align="center" width="30%" border="0">
<tr>
<td><img src="images/NGF_logo.png" width="353" height="129" /></td>
</tr>
<tr>
<td><input type="text" name="state" placeholder="Your State" required /></td>
</tr>
<tr>
<td><input type="password" name="pass" placeholder="Your Password" required /><br /><p><i>Note: Password is case sensitive</i></p></td>
</tr>
<tr>
<td><button type="submit" name="btn-login">Sign In</button></td>
</tr>
<tr>
<td><a href="contactform.php" target="new">Contact Dashboard Manager</a></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>