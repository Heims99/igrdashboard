<?php
//Session starts here
session_start();
include_once 'connection.php';
if(!isset($_SESSION['user']))
{
 header("Location: login.php");
}
$con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$res=mysqli_query($con, "SELECT * FROM users WHERE user_id=".$_SESSION['user']); //echo $res;
$userRow=mysqli_fetch_array($res); //echo $userRow;
?>
<link href="css/style.css" rel="stylesheet" type="text/css">
<?php
$sql=mysqli_query($con, "SELECT user_id, state, password FROM users WHERE user_id=".$_SESSION['user']); //echo $sql;
//$result=mysqli_fetch_array($sql);

while($row=mysqli_fetch_array($sql)) {
$username = $row[1]; //echo $username;
$password = $row[2]; //echo $password;
}

if(isset($_POST['btnSave'])) {
$cur_password=md5($_POST['txtPassword']); //echo $cur_password;
$password1=md5($_POST['txtnewPassword']); //echo $password1;
$password2=md5($_POST['txtConfirm']); //echo $password2;
}

if (empty ($_POST['txtPassword'])){
echo "<font color='red'>Please fill out all fields.</font>";
}
else if ($cur_password != $password) {
echo "<font color='red'>There was a problem. You entered a wrong password.</font>";
} else if ($password1 != $password2) {
echo "<font color='red'>Passwords do not match.</font>";
} else {
$sql = mysqli_query($con, "UPDATE users SET password = '$password1' WHERE state='$username' LIMIT 1");
$query = @mysqli_fetch_array($sql);
echo "<font color='green'>Success! Password has been changed.<br>Please logout, and then re-login to use your new password.</font>";
}
?>