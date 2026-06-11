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

class UserType extends connector{
/**
 * Constructor
 */

function UserType(){

	$this->AddProperty("ID");
	$this->AddProperty("Name");
	$this->AddProperty("Description");

}


}

?>