<?php
include_once '../connection.php';
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