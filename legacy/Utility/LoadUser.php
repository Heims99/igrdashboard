<?php

session_start();
$_SESSION['baseroot'] = null;
$base = "../";
if ( isset( $_SESSION['baseroot'])  && $_SESSION['baseroot'] == "root"){
	$base="";
}


include_once($base."System/LoginSystem.php");

$records = isset($_SESSION['LoginRec'])?$_SESSION['LoginRec']:Array();
$act = isset($_GET['act'])?$_GET['act']:null;
if( $act == null){
	$act = isset($_POST['act'])?$_POST['act']:null;
}

$name = isset($_GET['name'])?$_GET['name']:null;
if( $name == null){
	$name = isset($_POST['name'])?$_POST['name']:null;
}

$fname = isset($_GET['fname'])?$_GET['fname']:null;
if( $fname == null){
	$fname = isset($_POST['fname'])?$_POST['fname']:null;
}

switch(strtolower($act)){

	case 'search':

		$isSucessful = LoadLogins($name,$fname);
		echo $isSucessful;
		break;

	default:


		if(isset($name) && !empty($name) || isset($fname) && !empty($fname))
		{
			LoadLogins($name,$fname);
		}
		else
		{
			LoadLogins(null,null);
		}

		$records = $_SESSION['LoginRec'];
		$result =$records;
		echo json_encode(Array('totalCount' => count($result),'success'=>true,
				 'rows' => $result
				 ));

}





function LoadLogins($name,$fname){

	$eSystem =  new LoginSystem();
	$Logins = $eSystem->SearchByParameter($name,$fname);

	$eSummary = array();
	if(isset($Logins))
	{
		while(!$Logins->EOF)
		{
            $dLogin["user_id"] = $Logins->fields["user_id"];
			$dLogin["username"] = $Logins->fields["username"];
			$dLogin["state"] = $Logins->fields["state"];
			$dLogin["privilege"] = $Logins->fields["privilege"];
		    $eSummary[]= $dLogin;

			$Logins->MoveNext();
		}
		$records =$eSummary;
    	$_SESSION['LoginRec'] = $records;
	}
	else
	{

		$_SESSION['LoginRec'] =array();
	}


	return 1;


}




?>