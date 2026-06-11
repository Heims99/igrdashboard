<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$result = mysql_query("UPDATE faacMonthly set " . $_POST["column"] . " = '".$_POST["editval"]."' WHERE  faacMonthlyId=".$_POST["id"]);
?>