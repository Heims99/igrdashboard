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
include_once $base.'Core/UserType.php';
include_once($base."Data/UserTypeDAO.php");

class UserTypeSystem{
	/**
	 * Constructor
	 */

	var $theUserTypeDAO;

	function UserTypeSystem(){

		$this->theUserTypeDAO = new UserTypeDAO();

	}

	function SaveUserType($UserType){

		$UserTypeID = $this->theUserTypeDAO->AddUserType($UserType)	;
		return $UserTypeID;

	}

	function SaveUserTypes($UserTypes)
	{
		foreach($UserTypes as $key=>$theExp)
		{
			$this->theUserTypeDAO->AddUserType($theExp)	;
		}

		return true;

	}

	function UpdateUserType($UserType){

		$this->theUserTypeDAO->UpdateUserType($UserType);

	}

	function RetrieveUserTypeByID($Id)
	{
		$theUserType = new UserType();
		$recordSet = $this->theUserTypeDAO->RetrieveUserTypeByID($Id);
		$theUserType->Load($recordSet->fields);
		return	$theUserType;
	}

	function DeleteAllUserTypes($UserId){

		$exps =	$this->theUserTypeDAO->RetrieveUserTypesByUserID($UserId);
		if(isset($exps))
		{
			while(!$exps->EOF)
			{
				$this->theUserTypeDAO->DeleteUserTypes("ID",$exps->fields["ID"] );
				$exps->MoveNext();
			}
		}

	}

	function DeleteUserType($id){

		$this->theUserTypeDAO->DeleteUserTypes("ID",$id );

	}

	function RetrieveUserTypesByName($UserId){

		return $this->theUserTypeDAO->RetrieveUserTypesByName($UserId);

	}


}

?>