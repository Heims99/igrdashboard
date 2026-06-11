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
            
			<th width="15%"><strong>Username </strong></th>
            <th width="15%"><strong>State </strong></th>
			<th width="15%"><strong>Period (Quarter) </strong></th>
            <th width="15%"><strong>Year </strong></th>
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
		  $sql= mysqli_query ($con, "SELECT users.username, users.state, survey.survey_id, survey.mysession, survey.quarter, survey.year
FROM users, survey
WHERE users.username = survey.mysession
AND survey.mysession ='" . $userRow['username'] . "'
AND completed = 0");
		  //$result=mysql_query($sql,$db) or die(mysql_error());
		  while($row=mysqli_fetch_array($sql)) {
		  ?>
          <tr class="status_tr">
            <td><input name="<?php echo $row['survey_id']; ?>" type="checkbox" class="check"></td>
           
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['state']; ?></td>
            <td><?php echo $row['quarter']; ?></td>
			<td><?php echo $row['year']; ?></td>
            <td><a href="<?php echo "page1_form_edit.php?survey_id=".$row['survey_id']."&mode=update"; ?>">Tax Administration</a></td>
          </tr>
		  <?php } ?>
          
        </table>
        <br>
    </form>
    
    <form action="" method="post" name="" id="">
        <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="outer_table">
          <tr>
            <td width="15%" class="status_tr"><input name="topcheckbox" type="checkbox" class="check" id="topcheckbox" onClick="selectall();" value="ON">
Select All</td>
            <td colspan="6" align="center" bgcolor="#dfefff"><strong></td>
          </tr>
          <tr class="">
            <th width="15%"><strong><a href="javascript:goDel()">Delete</a></strong></th>
            
			<th width="15%"><strong>Username </strong></th>
            <th width="15%"><strong>State </strong></th>
			<th width="15%"><strong>Period (Quarter) </strong></th>
            <th width="15%"><strong>Year </strong></th>
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
		  $sql= mysqli_query ($con, "SELECT users.username, users.state, survey1.survey_id, survey1.mysession, survey1.quarter, survey1.year
FROM users, survey1
WHERE users.username = survey1.mysession
AND survey1.mysession ='" . $userRow['username'] . "'
AND completed = 0");
		  //$result=mysql_query($sql,$db) or die(mysql_error());
		  while($row=mysqli_fetch_array($sql)) {
		  ?>
          <tr class="status_tr">
            <td><input name="<?php echo $row['survey_id']; ?>" type="checkbox" class="check"></td>
           
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['state']; ?></td>
            <td><?php echo $row['quarter']; ?></td>
			<td><?php echo $row['year']; ?></td>
            <td><a href="<?php echo "page2_form_edit.php?survey_id=".$row['survey_id']."&mode=update"; ?>">Tax Procedures</a></td>
          </tr>
		  <?php } ?>
          
        </table>
    </form>
    <br>
    <form action="" method="post" name="" id="">
        <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="outer_table">
          <tr>
            <td width="15%" class="status_tr"><input name="topcheckbox" type="checkbox" class="check" id="topcheckbox" onClick="selectall();" value="ON">
Select All</td>
            <td colspan="6" align="center" bgcolor="#dfefff"><strong></td>
          </tr>
          <tr class="">
            <th width="15%"><strong><a href="javascript:goDel()">Delete</a></strong></th>
            
			<th width="15%"><strong>Username </strong></th>
            <th width="15%"><strong>State </strong></th>
			<th width="15%"><strong>Period (Quarter) </strong></th>
            <th width="15%"><strong>Year </strong></th>
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
		  $sql= mysqli_query ($con, "SELECT users.username, users.state, survey2.survey_id, survey2.mysession, survey2.quarter, survey2.year
FROM users, survey2
WHERE users.username = survey2.mysession
AND survey2.mysession ='" . $userRow['username'] . "'
AND completed = 0");
		  //$result=mysql_query($sql,$db) or die(mysql_error());
		  while($row=mysqli_fetch_array($sql)) {
		  ?>
          <tr class="status_tr">
            <td><input name="<?php echo $row['survey_id']; ?>" type="checkbox" class="check"></td>
           
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['state']; ?></td>
            <td><?php echo $row['quarter']; ?></td>
			<td><?php echo $row['year']; ?></td>
            <td><a href="<?php echo "page3_form_edit.php?survey_id=".$row['survey_id']."&mode=update"; ?>">Tax Processing</a></td>
          </tr>
		  <?php } ?>
          
        </table>
    </form>
    <br>
    <form action="" method="post" name="" id="">
        <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="outer_table">
          <tr>
            <td width="15%" class="status_tr"><input name="topcheckbox" type="checkbox" class="check" id="topcheckbox" onClick="selectall();" value="ON">
Select All</td>
            <td colspan="6" align="center" bgcolor="#dfefff"><strong></td>
          </tr>
          <tr class="">
            <th width="15%"><strong><a href="javascript:goDel()">Delete</a></strong></th>
            
			<th width="15%"><strong>Username </strong></th>
            <th width="15%"><strong>State </strong></th>
			<th width="15%"><strong>Period (Quarter) </strong></th>
            <th width="15%"><strong>Year </strong></th>
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
		  $sql= mysqli_query ($con, "SELECT users.username, users.state, survey3.survey_id, survey3.mysession, survey3.quarter, survey3.year
FROM users, survey3
WHERE users.username = survey3.mysession
AND survey3.mysession ='" . $userRow['username'] . "'
AND completed = 0");
		  //$result=mysql_query($sql,$db) or die(mysql_error());
		  while($row=mysqli_fetch_array($sql)) {
		  ?>
          <tr class="status_tr">
            <td><input name="<?php echo $row['survey_id']; ?>" type="checkbox" class="check"></td>
           
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['state']; ?></td>
            <td><?php echo $row['quarter']; ?></td>
			<td><?php echo $row['year']; ?></td>
            <td><a href="<?php echo "page4_form_edit.php?survey_id=".$row['survey_id']."&mode=update"; ?>">Tax Enforcement</a></td>
          </tr>
		  <?php } ?>
          
        </table>
    </form>
            </div>

        </div>
    </body>
</html>