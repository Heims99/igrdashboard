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

class Login extends connector{
	/**
	 * Constructor
	 */


	function Login()
	{

		$this->AddProperty("ID");
		$this->AddProperty("user_id");
		$this->AddProperty("username");
		$this->AddProperty("password");
		$this->AddProperty("privilege");
		$this->AddProperty("state");

	}
}
?>