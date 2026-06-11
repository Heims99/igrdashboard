<?php
session_start();
include_once 'connection.php';
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

if(isset($_POST['btn-signup']))
{
 $uname = mysqli_real_escape_string($con, $_POST['uname']);
 $state = mysqli_real_escape_string($con, $_POST['state']);
 $utype = mysqli_real_escape_string($con, $_POST['utype']);
 $upass = md5(mysqli_real_escape_string($con, $_POST['pass']));
 
 if(mysqli_query($con, "INSERT INTO users(username,state,usertypeId,password) VALUES('$uname','$state','$utype','$upass')"))
 {
  ?>
        <script>alert('successfully registered ');</script>
        <?php
 }
 else
 {
  ?>
        <script>alert('error while registering you...');</script>
        <?php
 }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login & Registration System</title>
<link rel="stylesheet" href="css/newStyle.css" type="text/css" />

</head>
<body>
<center>
<div id="login-form">
<form method="post">
<table align="center" width="40%" border="0">
<tr>
<td><input type="text" name="uname" placeholder="Full Name" required /></td>
</tr>
<tr>
<td><input type="text" name="state" placeholder="Username" required /></td>
</tr>
<tr>
<td><select name="utype" >
                        <?
		  //include '../connection.php';
		  $con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}  
   $sql = mysqli_query($con, "SELECT usertypeId, Name FROM usertype ORDER BY Name");
  // $result = mysql_query($sql);
     if(mysqli_num_rows($sql)) {
       // we have at least one practice, so show all practice as options in select form
       while($row = mysqli_fetch_row($sql))
       {
          print("<option value=\"$row[0]\">$row[1]</option>");
       }
     } else {
       print("<option value=\"\">No user type created yet</option>");
     }
?>
                    </select></td>
</tr>
<tr>
<td><input type="password" name="pass" placeholder="Your Password" required /></td>
</tr>
<tr>
<td><button type="submit" name="btn-signup">Create User</button></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>