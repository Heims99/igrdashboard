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
class CreateQuery{
	/**
	 * Constructor
	 */
	var $stringSQL= NULL;
	function CreateQuery(){

	}

	function Like($property, $value,$nature){

		if(strtolower($nature) == "begin")
		{

			return $property." Like '%".$value."'" ;
		}
		else if(strtolower($nature) == "end")
		{
			return $property." Like '".$value."%'" ;
		}
		else if(strtolower($nature) == "anywhere")
		{
			return $property." Like '%".$value."%'" ;
		}


	}

	function Eq($property, $value){

		return $property."='".$value."'" ;

	}

	function NotEq($property, $value){

		return $property."!='".$value."'" ;

	}

	function Gt($property, $value){

		return $property.">".$value."" ;

	}

	function Lt($property, $value){

		return $property."< '".$value."'" ;

	}

	function GE($property, $value){

		return $property.">=".$value."" ;

	}

	function LE($property, $value){

		return $property."<=".$value."" ;

	}

	function Between($property, $lowervalue,$uppervalue){

		return  $property." BETWEEN '".$lowervalue."' AND '".$uppervalue."'" ;

	}

	function Add($strSQl){

		if(isset($this->stringSQL))
		{

		$this->stringSQL =	$this->stringSQL ." AND ". $strSQl;
		}
		else{


		$this->stringSQL = $strSQl;

		}

	}

	function GetQuery(){

		return $this->stringSQL;
	}

	function AddORStatement($statement1, $statement2){

		return "(".$statement1." OR ".$statement2.") " ;

	}

	function AddOR($strSQl){

		if(isset($this->stringSQL))
		{

			$this->stringSQL =	$this->stringSQL ." OR ". $strSQl;
		}
		else{


			$this->stringSQL = $strSQl;

		}

	}



}

?>