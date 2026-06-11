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
include_once $base.'Core/User.php';
include_once($base."Data/UserDAO.php");


class UserSystem{
	/**
	 * Constructor
	 */

	var $theUserDAO;

	function UserSystem(){

		$this->theUserDAO = new UserDAO();

	}

	function SaveUser($user){

      $userID =	$this->theUserDAO->Adduser($user)	;
	  return $userID;

	}

	function UpdateUser($user){

	 $this->theUserDAO->Updateuser($user);

	}

	function RetrieveuserByID($Id)
	{
		$theUser = new User();
		$recordSet = $this->theUserDAO->RetrieveuserByID($Id);

		if(isset($recordSet)){

			$theUser->Load($recordSet->fields);

		}

		return	$theUser;
	}

	function RetrieveuserInfoByID($Id)
	{
		$theUser = new User();
		$recordSet = $this->theUserDAO->RetrieveuserByID($Id);
		if(isset($recordSet))
		$theUser->Load($recordSet->fields);

		return	$theUser;
	}

	function FindUserBy($activationCode)
	{
		$theUser = new User();
		$recordSet = $this->theUserDAO->FindUserBy($activationCode);
		if(isset($recordSet))
		{
			$theUser->Load($recordSet->fields);
			return	$theUser;
		}
		else
		{
			return null;
		}
	}

	function Authenticate($username,$password)
	{
		$theUser = new User();
		$recordSet = $this->theUserDAO->Authenticate($username,$password);
		if(isset($recordSet))
		{
		$theUser->Load($recordSet->fields);
		return	$theUser;
		}
		else
		{
			return null;
		}
	}

	function UserExist($username)
	{
		$theUser = new User();
		$recordSet = $this->theUserDAO->SearchBy($username);
		if($recordSet == null)
		{
		 return  "false";
		}
		else{
			 return  "true";
		}
	}

	function SearchByProfileName($pName)
	{
		$theUser = new User();
		$recordSet = $this->theUserDAO->SearchByProfileName($pName);
		if(isset($recordSet))
		{
			$theUser->Load($recordSet->fields);
			$Id = 	$theUser->Property["ID"];
			$theBio = new BioDAO();
			$theUser->Bio = $theBio->RetrieveBioByUserID($Id);
			$theExp =new ExperienceDAO();
			$theUser->Experience = $theExp->RetrieveExperienceByUserID($Id);

			$theEdu =new EducationDAO();
			$theUser->Education = $theEdu->RetrieveEducationByUserID($Id);

			$theQuali =new QualificationDAO();
			$theUser->Qualification = $theQuali->RetrieveQualificationByUserID($Id);

			$theLink =new LinkDAO();
			$theUser->Link = $theLink->RetrieveLinkByUserID($Id);

			$theHobby =new HobbyDAO();
			$theUser->Hobby = $theHobby->RetrieveHobbyByUserID($Id);

			$theAffiliation =new AffiliationDAO();
			$theUser->Affiliations = $theAffiliation->RetrieveAffiliationByUserID($Id);
			return $theUser;
		}


	}

	function GetUserIDs($usernames){

		$userIDs =  array();

		if(Count($usernames)> 0)
		{
			foreach($usernames as $key=>$value)
			{

				$recordSet = $this->theUserDAO->SearchBy(trim($value));
				if($recordSet != null)
				{
				$userIDs[] = $recordSet->fields["ID"];
				}
			}
		}

		return $userIDs;

	}
}

?>