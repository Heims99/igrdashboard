<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2011
 */

$base = "../";
if ( isset( $_SESSION['baseroot'])  && $_SESSION['baseroot'] == "root"){
	$base="";
}
elseif(isset( $_SESSION['baseroot'])  && $_SESSION['baseroot'] == "Point")
{
	$base="admin/";
}

include_once $base.'Core/Login.php';
include_once $base.'DbEngine/CoreDAO.php';
include_once($base."DbEngine/CreateQuery.php");


class LoginDAO extends CoreDAO{

	function LoginDAO(){

		$this->Connect();

	}


	function AddLogin($Login){

		return $this->Add("users","user_id",$Login);
	}

	function UpdateLogin($Login){

		$oldLogin = new Login();
		$oldLogin->Property["user_id"] = $Login->Property["user_id"];
		$this->Update("users",$oldLogin,$Login);

	}

function FindLogin($Login,$orderType,$key,$rp,$pg){

	return $this->FindRecords("users",$Login,$orderType,$key,$rp,$pg);

}

function DeleteLogins($field,$value){

	$this->DeleteRecord("users",$field,$value);
}

function RetrieveAllLogins(){

	$Login = new Login();
	return	$this->RetrieveAll("users",$Login,"ASC","user_id");
}


function RetrieveLoginByID($Id){

	$Login = new Login();
	$Login->Property["user_id"] = $Id;
	return $this->RetrieveByID("user_id",$Login,null,null)	;

}

function FindLoginBy($activationCode)
{
	$criteria =  new CreateQuery();
	$criteria->Add($criteria->Eq("codeGen",$activationCode ));
	$criteriasql = $criteria->GetQuery();
	$sql = $this->dbEngine->CreateSqlUsingCriteria("users",$criteriasql);
    $recordset =	$this->dbEngine->FindRecord($sql);
	if(!$recordset->RecordCount()){

		return null;

	}
	else{

		return $recordset;

	}

}

	function FindLoginByLoginID($LoginID)
	{
		$criteria =  new CreateQuery();
		$criteria->Add($criteria->Eq("user_id",$LoginID ));
		$criteriasql = $criteria->GetQuery();
		$sql = $this->dbEngine->CreateSqlUsingCriteria("users",$criteriasql);
		$recordset =	$this->dbEngine->FindRecord($sql);
		if(!$recordset->RecordCount()){

			return null;

		}
		else{

			return $recordset;

		}

	}

	function Authenticate($username,$password)
	{
		$criteria =  new CreateQuery();
		$criteria->Add($criteria->Eq("username",$username ));
		$decryptedPassword = md5($password);
		$criteria->Add($criteria->Eq("password",$decryptedPassword));
		$criteriasql = $criteria->GetQuery();
		$sql = $this->dbEngine->CreateSqlUsingCriteria("users",$criteriasql);
		$recordset =	$this->dbEngine->FindRecord($sql);
		if(!$recordset->RecordCount()){

			return null;

		}
		else{

			return $recordset;

		}

	}

	function SearchBy($Loginname)
	{
		$criteria =  new CreateQuery();
		$criteria->Add($criteria->Eq("username",$Loginname ));
		$criteriasql = $criteria->GetQuery();
		$sql = $this->dbEngine->CreateSqlUsingCriteria("users",$criteriasql);
		$recordset =	$this->dbEngine->FindRecord($sql);
		if(!$recordset->RecordCount()){

			return null;

		}
		else{

			return $recordset;

		}

	}



	function SearchByParameter($username,$state)
	{
		$criteria =  new CreateQuery();

		if(isset($username) && !empty($username))
			$criteria->Add($criteria->Like("username",$username,"anywhere"));

		if(isset($state) && !empty($state))
			$criteria->Add($criteria->Like("state",$state,"anywhere"));

		$criteriasql = $criteria->GetQuery();
		$sql = $this->dbEngine->CreateSqlUsingCriteria("users",$criteriasql);

		$recordset =	$this->dbEngine->FindRecord($sql);

		if(!$recordset->RecordCount()){

			return null;

		}
		else{

			return $recordset;

		}

	}

}



?>