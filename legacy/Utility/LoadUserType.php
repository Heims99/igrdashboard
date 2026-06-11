<?php

session_start();
$_SESSION['baseroot'] = null;
$base = "../";
if ( isset( $_SESSION['baseroot'])  && $_SESSION['baseroot'] == "root"){
	$base="";
}


include_once($base."System/UserTypeSystem.php");

$records = isset($_SESSION['UserTypeRec'])?$_SESSION['UserTypeRec']:Array();
$act = isset($_GET['act'])?$_GET['act']:null;
if( $act == null){
	$act = isset($_POST['act'])?$_POST['act']:null;
}

$name = isset($_GET['name'])?$_GET['name']:null;
if( $name == null){
	$name = isset($_POST['name'])?$_POST['name']:null;
}

switch(strtolower($act)){

	case 'search':

		$isSucessful = LoadUserTypes($name);
		echo $isSucessful;
		break;

	default:


		if(isset($name) && !empty($name))
		{
			LoadUserTypes($name);
		}
		else
		{
			LoadUserTypes(null);
		}

		$records = $_SESSION['UserTypeRec'];
		$result =$records;
		echo json_encode(Array('totalCount' => count($result),'success'=>true,
				 'rows' => $result
				 ));

}





function LoadUserTypes($name){

	$eSystem =  new UserTypeSystem();
	$UserTypes = $eSystem->RetrieveUserTypesByName($name);

	$eSummary = array();
	if(isset($UserTypes))
	{
		while(!$UserTypes->EOF)
		{
            $dUserType["ID"] = $UserTypes->fields["ID"];
			$dUserType["Name"] = $UserTypes->fields["Name"];
			$dUserType["Description"] = $UserTypes->fields["Description"];
		    $eSummary[]= $dUserType;

			$UserTypes->MoveNext();
		}
		$records =$eSummary;
    	$_SESSION['UserTypeRec'] = $records;
	}
	else
	{

		$_SESSION['UserTypeRec'] =array();
	}


	return 1;


}




?>