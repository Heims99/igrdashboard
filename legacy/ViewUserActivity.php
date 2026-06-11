<?php
//Session starts here
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
?><!DOCTYPE HTML>
<html>
    <head>
        <title>User Submission</title>
        <script type="text/javascript" src="script.js"> </script>
        <link rel="stylesheet" href="ngf_survey/style.css" />
    </head>
    <body>

        <div class="container">
            <div class="main">
                <h2>User Activity Log</h2><hr/>
                <span id="error">
			<!----Initializing Session for errors--->
                    <?php
                    if (!empty($_SESSION['error'])) {
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    }
                    ?>
                </span>
                <form action="" method="post" name="" id="">
        <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="outer_table">
          
          <tr class="">
            
            
			<th width="25%"><strong>Name</strong></th>
            <th width="15%"><strong>Username</strong></th>
			<th width="25%"><strong>Last Login</strong></th>
            <th width="15%"><strong>Number of Logins</strong></th>
            <th width="20%"><strong>Details</strong></th>
          </tr>
		  <?php
		  //include("connection.php");
		  $con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
		  $sql=mysqli_query ($con,"SELECT users.user_id, users.username, users.state, users.lastLogin, users.totalLogin
FROM users WHERE users.totalLogin > 0");
		  //$result=mysql_query($sql,$db) or die(mysql_error());
		  while($row=mysqli_fetch_array($sql)) {
		  ?>
          <tr class="status_tr">
            
           
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['state']; ?></td>
            <td><?php echo $row['lastLogin']; ?></td>
			<td><?php echo $row['totalLogin']; ?></td>
            <td><a href="<?php echo "viewActivity_edit.php?user_id=".$row['user_id']."&mode=update"; ?>">View Details</a></td>
          </tr>
		  <?php } ?>
          
        </table>
        <br>
    </form>
            </div>

        </div>
    </body>
</html>