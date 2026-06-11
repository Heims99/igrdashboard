<?php
session_start();
//include_once 'connection.php';

if(isset($_SESSION['user'])!="")
{
 header("Location: index.php");
}
if(isset($_POST['btn-login']))
{
 $state = $_POST['state'];
 $upass = $_POST['pass'];
 //$res=mysql_query("SELECT * FROM users WHERE state='$state' AND usertypeId=0");
 //Jul 3
 $connection = mysqli_connect("localhost", "nggovern_Garki", "NgfBassi1!");
    $db = mysqli_select_db($connection, "nggovern_dashboard");
 $res=mysqli_query($connection, "SELECT * FROM users WHERE state='$state' AND (usertypeId=0 OR usertypeId=5 OR usertypeId=4)");
 $row=mysqli_fetch_array($res, $db);
 if($row['password']==md5($upass))
 {
  $_SESSION['user'] = $row['user_id'];
 //Jul 3
 $_SESSION['privilege'] = $row['usertypeId'];
  
  /* Update the login date and time*/	
	$login_date = date("Y-m-d h:i:s"); 
	$link = mysqli_connect("localhost", "nggovern_Garki", "NgfBassi1!", "nggovern_dashboard");
    mysqli_query($link, "UPDATE users SET lastLogin='".$login_date."' WHERE user_id='" . $_SESSION['user'] . "'");
//	$sql = "UPDATE `users` SET `lastLogin`='".$login_date."' WHERE user_id='" . $_SESSION['user'] . "'"; 
//	$result = mysqli_query($db, $sql) or die(mysqli_error($db));
	
	/* Count number of times logged in*/
	$link = mysqli_connect("localhost", "nggovern_Garki", "NgfBassi1!", "nggovern_dashboard");
    mysqli_query($link, "UPDATE users SET totalLogin = totalLogin + 1 WHERE user_id ='" . $_SESSION['user'] . "'");
	//$sql1 = "UPDATE users SET totalLogin = totalLogin + 1 WHERE user_id ='" . $_SESSION['user'] . "'";
	//$result1 = mysqli_query($db, $sql1) or die(mysqli_error($db));
	
	/* Locate user ip address*/
	$connection = mysqli_connect("localhost", "nggovern_Garki", "NgfBassi1!");
    $db = mysqli_select_db($connection, "nggovern_dashboard");
	$ipaddress = $_SERVER['REMOTE_ADDR'];
	$query = mysqli_query($connection, "INSERT INTO user_log (username, loginDate, ip) VALUES ('$state', '$login_date', INET_NTOA('$ipaddress'))") or die(mysqli_error($db));
  
  header("Location: index.php");
 }
 else
 {
  ?>
        <script>alert('incorrect login details or access denied');</script>
        <?php
 }
 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="NGF IGR Dashboard">
<meta name="keywords" content="IGR,NGF,Dashboard,Tax,Allocation,Revenue">
<meta name="author" content="Maduka Okafor">
<title>NGF Dashboard - Login & Registration System</title>
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
<td><input type="text" name="state" placeholder="Username" required /></td>
</tr>
<tr>
<td><input type="password" name="pass" placeholder="Password" required /><br /><p><i>Note: Password is case sensitive</i></p></td>
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