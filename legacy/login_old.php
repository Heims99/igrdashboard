<?php
session_start();
include_once 'connection.php';

if(isset($_SESSION['user'])!="")
{
 header("Location: home.php");
}
if(isset($_POST['btn-login']))
{
 $state = mysql_real_escape_string($_POST['state']);
 $upass = mysql_real_escape_string($_POST['pass']);
 $res=mysql_query("SELECT * FROM users WHERE state='$state' AND usertypeId=5");
 $row=mysql_fetch_array($res);
 if($row['password']==md5($upass))
 {
  $_SESSION['user'] = $row['user_id'];
  header("Location: home.php");
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
<td><a href="contactform.html">Contact System Administrator</a></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>