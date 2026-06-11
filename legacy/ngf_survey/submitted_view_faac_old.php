<?php
//Session starts here
session_start();
include_once '../connection.php';
if(!isset($_SESSION['user']))
{
 header("Location: login.php");
}
$res=mysql_query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);
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
                <h2>FAAC Submission(s)</h2><hr/>
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
            
			<th width="15%"><strong>FAAC Year</strong></th>
            <th width="25%"><strong>View/Update</strong></th>
          </tr>
		  <?php
		  include("../connection.php");
		  $sql="SELECT DISTINCT(faacYear)
FROM faacMonthly
ORDER BY faacYear";
		  $result=mysql_query($sql,$db) or die(mysql_error());
		  while($row=mysql_fetch_array($result)) {
		  ?>
          <tr class="status_tr">
            <td><input name="<?php echo $row['faacYear']; ?>" type="checkbox" class="check"></td>
           
            <td><?php echo $row['faacYear']; ?></td>
            <td><a href="<?php echo "edit_faac/index.php?faacYear=".$row['faacYear']."&mode=update"; ?>">View/Edit FAAC Entry</a></td>
          </tr>
		  <?php } ?>
          
        </table>
        <br>
    </form>
            </div>

        </div>
    </body>
</html>