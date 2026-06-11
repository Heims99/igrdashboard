<?php
//Session starts here
session_start();
include_once '../connection.php';
if(!isset($_SESSION['user']))
{
 header("Location: login.php");
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
        <link rel="stylesheet" href="style.css" />
    </head>
    <body>

        <div class="container">
            <div class="main">
                <h2>User Submission(s)</h2><hr/>
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
          <tr>
            <td width="15%" class="status_tr"><input name="topcheckbox" type="checkbox" class="check" id="topcheckbox" onClick="selectall();" value="ON">
Select All</td>
            <td colspan="6" align="center" bgcolor="#dfefff"><strong></td>
          </tr>
          <tr class="">
            <th width="15%"><strong><a href="javascript:goDel()">Delete</a></strong></th>
            
			<th width="15%"><strong>Username</strong></th>
            <th width="15%"><strong>State</strong></th>
			<th width="15%"><strong>Month</strong></th>
            <th width="15%"><strong>Year</strong></th>
            <th width="25%"><strong>Update</strong></th>
          </tr>
		  <?php
		  //include("../connection.php");
		  $con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
		  $sql=mysqli_query($con, "SELECT users.username, users.state, annex.annexId, annex.mysession, annex.month, annex.year, annex.state
FROM users, annex
WHERE users.username = annex.mysession
AND annex.mysession ='" . $userRow['username'] . "'
AND completed = 0");
		  //$result=mysql_query($sql,$db) or die(mysql_error());
		  while($row=mysqli_fetch_array($sql)) {
		  ?>
          <tr class="status_tr">
            <td><input name="<?php echo $row['annexId']; ?>" type="checkbox" class="check"></td>
           
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['state']; ?></td>
            <td><?php echo $row['month']; ?></td>
			<td><?php echo $row['year']; ?></td>
            <td><a href="<?php echo "annex_edit.php?annexId=".$row['annexId']."&mode=update"; ?>">View/Edit Entry</a></td>
          </tr>
		  <?php } ?>
          
        </table>
        <br>
    </form>
            </div>

        </div>
    </body>
</html>