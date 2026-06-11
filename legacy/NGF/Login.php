<?php
session_start();
//include_once 'connection.php';

if(isset($_SESSION['user'])!="")
{
 header("Location: Dashboard");
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
  
  header("Location: Dashboard");
 }
 else
 {
  ?>
        <script>alert('incorrect login details or access denied');</script>
        <?php
 }
 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="NGF IGR Dashboard">
    <meta name="keywords" content="IGR,NGF,Dashboard,Tax,Allocation,Revenue">
    <meta name="author" content="Maduka Okafor">
    <title>Login Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
</head>

<body>

<div class="container d-flex flex-column justify-content-center align-items-center vh-100">
    <img src="../images/NGF_logo.png" alt="" width="353px" height="129px">
    <div class="card shadow_bg p-4" style="width: 100%; max-width: 500px;">
        <h3 class="text-center mb-4">Login</h3>
        <form method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="state" name="state" placeholder="Enter username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="pass" name="pass" placeholder="Enter password" required>
            </div>
            <p><i>Note: Password is case sensitive</i></p>
            <div class="form-group custom-radio">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="remember" name="remember" class="custom-control-input">
                    <label class="custom-control-label" for="remember">Remember me</label>
                </div>
            </div>
            <button type="submit" class="btn btn-success btn-block" name="btn-login">Login</button>
        </form>
        <br><a href="../contactform.php" target="new">Contact Dashboard Manager</a>
    </div>
</div>

<style>
    label{
        font-size: 14px;
    }
</style>

</body>

</html>