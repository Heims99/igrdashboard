<?
require_once("edit_faac/dbcontroller.php");
$db_handle = new DBController();
$recsno=$_GET["recsno"]; //echo $recsno;
$data=trim($recsno); //echo $data;
$ex=explode(" ",$data); //echo $ex;
$size=sizeof($ex);
for($i=0;$i<$size;$i++) {
	$id=trim($ex[$i]); //echo $id;
	$sql="DELETE FROM faacMonthly WHERE faacYear='$id'"; //echo $sql;
	$faq = $db_handle->runQuery($sql); //echo $result;
	header("location: submitted_view_faac.php");
}

?>