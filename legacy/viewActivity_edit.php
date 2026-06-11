<?php
//Session starts here
session_start();
include_once 'connection.php';
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
        <title>Questionnaire Annex</title>
        <link rel="stylesheet" href="ngf_survey/style.css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>

    </head>
    <body>

        <div class="container">
            <div class="main">
                <h2>User Activity Log Details</h2><hr/>
                <span id="error">
			<!----Initializing Session for errors--->
                    <?php
                    if (!empty($_SESSION['error'])) {
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    }
                    ?>
                </span>
      <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="outer_table">
          
          <tr class="">
            
            
			<th width="25%"><strong>Name</strong></th>
            <th width="15%"><strong>Username</strong></th>
			<th width="25%"><strong>Login Date</strong></th>
            <th width="15%"><strong>IP Address</strong></th>
            
          </tr>          
                <?php
		  $mode=$_GET["mode"];
		  if($mode=="update") {
		  	//include("connection.php");
			$userId=$_GET["user_id"]; //echo $annexId;
			//$sql="select stateId,stateName,zoneId, statePopulation from $state where stateId='$stateId'";
			$con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
			$sql=mysqli_query ($con, "SELECT user_log.userLogId,user_log.username,user_log.loginDate,user_log.ip,users.user_id, users.username, users.state FROM user_log, users WHERE user_log.username = users.username AND users.user_id='$userId'");
			
			//$result=mysql_query($sql,$db) or die(mysql_error());
			while($row=mysqli_fetch_array($sql)) {
		  ?>
          <tr class="status_tr">
            
           
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['state']; ?></td>
            <td><?php echo $row['loginDate']; ?></td>
			<td><?php echo $row['ip']; ?></td>
          </tr>
		  <?php } ?>
          </table>
                </form>
                <?php	
			
		  }
		  ?>
		 
                
                
            </div>

        </div>
    </body>
</html>