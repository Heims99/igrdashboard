<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2011
 */

/**
 *
 *
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
include_once($base."Data/LoginDAO.php");


class LoginSystem{
	/**
	 * Constructor
	 */

	var $theLoginDAO;

	function LoginSystem(){

		$this->theLoginDAO = new LoginDAO();

	}

	function SaveLogin($Login){

      $LoginID =	$this->theLoginDAO->AddLogin($Login)	;
	  return $LoginID;

	}

	function RetrieveAllLogins()
	{
	   return 	$this->theLoginDAO->RetrieveAllLogins()	;
	}

	function UpdateLogin($Login){

	 $this->theLoginDAO->UpdateLogin($Login);

	}

	function RetrieveLoginByID($Id)
	{
		$theLogin = new Login();
		$recordSet = $this->theLoginDAO->RetrieveLoginByID($Id);

		if(isset($recordSet)){

			$theLogin->Load($recordSet->fields);

		}

		return	$theLogin;
	}

	function RetrieveLoginInfoByID($Id)
	{
		$theLogin = new Login();
		$recordSet = $this->theLoginDAO->RetrieveLoginByID($Id);
		if(isset($recordSet))
		$theLogin->Load($recordSet->fields);

		return	$theLogin;
	}

	function FindLoginBy($activationCode)
	{
		$theLogin = new Login();
		$recordSet = $this->theLoginDAO->FindLoginBy($activationCode);
		if(isset($recordSet))
		{
			$theLogin->Load($recordSet->fields);
			return	$theLogin;
		}
		else
		{
			return null;
		}
	}

	function Authenticate($Loginname,$password)
	{
		$theLogin = new Login();
		$recordSet = $this->theLoginDAO->Authenticate($Loginname,$password);
		if(isset($recordSet))
		{
		$theLogin->Load($recordSet->fields);
		return	$theLogin;
		}
		else
		{
			return null;
		}
	}

	function GetByUserName($Loginname)
	{
		$theLogin = new Login();
		$recordSet = $this->theLoginDAO->SearchBy($Loginname);
		if(isset($recordSet))
			$theLogin->Load($recordSet->fields);

		return	$theLogin;
	}

	function LoginExist($Loginname)
	{
		$theLogin = new Login();
		$recordSet = $this->theLoginDAO->SearchBy($Loginname);
		if($recordSet == null)
		{
			return  "false";
		}
		else{
			return  "true";
		}
	}

	function GetLogin($username)
	{
		$theLogin = new Login();
		$recordSet = $this->theLoginDAO->SearchBy($username);
		if(isset($recordSet)){

			$theLogin->Load($recordSet->fields);

		}

		return	$theLogin;
	}

	function SearchByProfileName($pName)
	{
		$theLogin = new Login();
		$recordSet = $this->theLoginDAO->SearchByProfileName($pName);
		if(isset($recordSet))
		{
			$theLogin->Load($recordSet->fields);
			$Id = 	$theLogin->Property["ID"];
			$theBio = new BioDAO();
			$theLogin->Bio = $theBio->RetrieveBioByLoginID($Id);
			$theExp =new ExperienceDAO();
			$theLogin->Experience = $theExp->RetrieveExperienceByLoginID($Id);

			$theEdu =new EducationDAO();
			$theLogin->Education = $theEdu->RetrieveEducationByLoginID($Id);

			$theQuali =new QualificationDAO();
			$theLogin->Qualification = $theQuali->RetrieveQualificationByLoginID($Id);

			$theLink =new LinkDAO();
			$theLogin->Link = $theLink->RetrieveLinkByLoginID($Id);

			$theHobby =new HobbyDAO();
			$theLogin->Hobby = $theHobby->RetrieveHobbyByLoginID($Id);

			$theAffiliation =new AffiliationDAO();
			$theLogin->Affiliations = $theAffiliation->RetrieveAffiliationByLoginID($Id);
			return $theLogin;
		}


	}

	function GetLoginIDs($Loginnames){

		$LoginIDs =  array();

		if(Count($Loginnames)> 0)
		{
			foreach($Loginnames as $key=>$value)
			{

				$recordSet = $this->theLoginDAO->SearchBy(trim($value));
				if($recordSet != null)
				{
				$LoginIDs[] = $recordSet->fields["ID"];
				}
			}
		}

		return $LoginIDs;

	}

	function FindLoginByLoginID($LoginID)
	{
		$theLogin = new Login();
		$recordSet = $this->theLoginDAO->FindLoginByLoginID($LoginID);
		if(isset($recordSet))
			$theLogin->Load($recordSet->fields);

		return	$theLogin;

	}


	function SearchByParameter($username,$state)
	{

		return $this->theLoginDAO->SearchByParameter($username,$state);

	}
}

?>