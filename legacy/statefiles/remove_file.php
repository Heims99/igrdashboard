<?php
//Session starts here
session_start();
include_once '../connection.php';
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
?>
<?php
//include_once 'dbconfig.php';
if(isset($_GET['remove_id']))
{
    $con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}  
	$res=mysqli_query($con, "SELECT file_name FROM files WHERE id=".$_GET['remove_id']);
	$row=mysqli_fetch_array($res);
	mysqli_query($con, "DELETE FROM files WHERE id=".$_GET['remove_id']);
	unlink("uploads/".$row['file_name']);
	header("Location: remove_file.php");
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Uploaded Document(s)</title>
        <link rel="stylesheet" href="../ngf_survey/style.css" />
        <script type="text/javascript">
function remove(id)
{
	if(confirm(' Sure to remove file ? '))
	{
		window.location='delete.php?remove_id='+id;
	}
}
</script>
    </head>
    <body>

        <div class="container">
            <div class="main">
                <h2>Uploaded Document(s)</h2><hr/>
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
            
            <td colspan="3" align="center" bgcolor="#dfefff" height="15">&nbsp;</td>
          </tr>
          <tr class="">
			<th width=""><strong>Document</strong></th>
            <th width=""><strong>Date Uploaded</strong></th>
            <th width=""><strong>Delete File</strong></th>
          </tr>
		  <?php
		  //include("../connection.php");
		  $con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}  
		  $sql=mysqli_query($con, "SELECT id, file_name, uploaded FROM files");
		  //$result=mysql_query($sql,$db) or die(mysql_error());
		  while($row=mysqli_fetch_array($sql)) {
		  ?>
          <tr class="status_tr">
            <td><?php echo $row['file_name']; ?></td>
            <td><?php echo $row['uploaded']; ?></td>
            <td><a href="javascript:remove(<?php echo $row['id'] ?>)">Delete file</a></td>
          </tr>
		  <?php } ?>
          
        </table>
        <br>
    </form>
            </div>

        </div>
    </body>
</html>