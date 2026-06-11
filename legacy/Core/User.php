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

include_once $base.'DbEngine/connector.php';

class User extends connector{
	/**
	 * Constructor
	 */
	

	function User(){

		$this->AddProperty("ID");
		$this->AddProperty("UserName");
		$this->AddProperty("Password");
		$this->AddProperty("UserRoleID");
		$this->AddProperty("OtherName");
		$this->AddProperty("LastName");
		$this->AddProperty("CreatedDate");
		$this->AddProperty("EmailAddress");		
		$this->AddProperty("LastLoginDate");		
		$this->AddProperty("IsActive");
		

	}
}
?>