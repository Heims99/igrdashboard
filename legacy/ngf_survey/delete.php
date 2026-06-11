<?
include("../connection.php");
$recsno=$_GET["recsno"]; //echo $recsno;
$data=trim($recsno); //echo $data;
$ex=explode(" ",$data); //echo $ex;
$size=sizeof($ex);
for($i=0;$i<$size;$i++) {
	$id=trim($ex[$i]); echo $id;
	$sql="DELETE FROM survey WHERE survey_id='$id'"; echo $sql;
	$result=mysql_query($sql,$connection) or die(mysql_error()); //echo $result;
	//header("location: submitted_view.php");
}

?>