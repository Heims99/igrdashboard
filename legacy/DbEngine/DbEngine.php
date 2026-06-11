<?php

include 'adodb/adodb.inc.php';
include 'adodb/adodb-exceptions.inc.php';
	class DbEngine{
	 private $conn;


	 function DbEngine($databaseEngine){



		try{

		$this->conn = ADONewConnection($databaseEngine);
	    //$this->conn->debug = true;

		}
		catch(exception $ex){

		//	var_dump($ex->getMessage());
            adodb_backtrace($ex->gettrace());

		}
	}


	function Connect($server,$user,$password,$database){

	   try{

	      $this->conn->PConnect($server,$user,$password,$database);
	      }
       catch(exception $ex){

//var_dump($ex->message);
			var_dump($ex->getMessage());
            adodb_backtrace($ex->gettrace());

	   }
	}

	function Add($tablename,$field,$table){
	try{

        $sql = "SELECT * FROM ". strtolower($tablename) ." WHERE ".$field." = -1";
        $this->conn->StartTrans();
        $rs = $this->conn->Execute($sql);
        $insertSQL = $this->conn->GetInsertSQL($rs, $table->Property);

        $this->conn->Execute($insertSQL);
        $this->conn->CompleteTrans(); ;
        $sql = $this->CreateSqlQueryUsingAllFieldsEq(strtolower($tablename),$table);

        $rec = $this->FindRecord($sql);
        return $rec->fields["ID"];
      }
      catch(exception $ex){

			var_dump($ex->getMessage());
            adodb_backtrace($ex->gettrace());

		}
}
	function FindRecord($sql){

	    $this->conn->StartTrans();
	    $rs = $this->conn->Execute($sql);
	    $this->conn->CompleteTrans();
		return $rs ;

	}

	function Update($tablename,$oldrec,$record){

			try{

				$sql = $this->CreateSqlQueryUsingAllFields($tablename,$oldrec);

				$this->conn->StartTrans();
				$rs = $this->conn->Execute($sql);
				$updateSQL = $this->conn->GetUpdateSQL($rs, $record->Property);

				$this->conn->Execute($updateSQL);
				$this->conn->CompleteTrans();

				$sql = $this->CreateSqlQueryUsingAllFields($tablename,$record);
				$rec = $this->FindRecord($sql);

				return 1;
			}
			catch(exception $ex){

		//		var_dump($ex->getMessage());
				$message =$ex->getMessage();
		//		adodb_backtrace($ex->gettrace());

			}

		}
	function DeleteRecord($tablename,$field,$value){

	 $sql =	"DELETE FROM ".strtolower($tablename)." WHERE ".$field."=".$value."";
	 $this->conn->StartTrans();
	 $rs = $this->conn->Execute($sql);
	 $this->conn->CompleteTrans();

	}



    function CreateSqlQueryWithOrdering_Limit($tblname,$table,$isOrdered,$ordernature,$orderfield,$limit,$number,$lower){


	$sql = $this->CreateSqlQueryUsingAllFields(strtolower($tblname),$table);

	if($isOrdered && isset($ordernature)){

	$sql = $sql." ORDER by " . $orderfield ." ". $ordernature;

	}

    if($limit){
      $sql = $sql. " LIMIT ".$lower.",".$number;
    }

    return $sql;

 }

 	function GetRecordUsingDate($tblname,$startdate,$enddate,$stockName){


	$sql =	"SELECT * FROM ".strtolower($tblname)." WHERE Date BETWEEN '". $startdate ."' AND '". $enddate."'  AND  CompanyID=".$stockName." ";

	   return $this->FindRecord($sql);


	}

	function CreateSqlQueryUsingAllFields($tblname,$table){


	return "SELECT * FROM ".strtolower($tblname) .$this->CreateSqlQuery($table->Key ,$table->Property," AND ");

	}
    function CreateSqlQueryUsingAllFieldsEq($tblname,$table){

		return "SELECT * FROM ". strtolower($tblname) .$this->CreateSqlQueryEq($table->Key ,$table->Property," AND ");

}


	function CreateSqlQueryEq($Name ,$Value,$separator){

	 $myQuery="";

	 foreach($Name as $name){

		if($Value[$name] !="" && $Value[$name] != NULL){

	     	if ($myQuery == NULL || $myQuery == "" ) {

            $myQuery = $name."='".$Value[$name]."'" ;

	        }
            else {

                $myQuery =  $myQuery.$separator.$name."='".$Value[$name]."'" ;
            }

		}

	}

	if($myQuery != ""){

	$myQuery = " WHERE ".$myQuery;
	}

	return $myQuery	;

	}

	function CreateSqlQuery($Name ,$Value,$separator){

	 $myQuery="";


	if($Name != null){

	 foreach($Name as $name){

		if($Value[$name] !="" && $Value[$name] != NULL){

	     if($name == "Trans_ID" || $name == "InvoiceNumber"){ $isString = 0;}
	     else{
	         $isString = (int) ($Value[$name]);
	     }
	     	if ($myQuery == NULL || $myQuery == "" ) {



			   if(!$isString && $name != "Section_Id" ){

			    $myQuery = $name." Like '%".$Value[$name]."%'" ;

	         	}


				 else{
	            $myQuery = $name."='".$Value[$name]."'" ;
	            }
	        }
            else {
               if(!$isString && $name != "Section_Id" ){

				$myQuery =  $myQuery.$separator.$name." Like '%".$Value[$name]."%'" ;
			   }
               else{
                $myQuery =  $myQuery.$separator.$name."='".$Value[$name]."'" ;
                }
            }

		}

	}

	if($myQuery != ""){

	$myQuery = " WHERE ".$myQuery;
	}
  }
	return $myQuery	;

	}

    function CreateSqlUsingCriteria($tblname,$criteria)
    {
      if(isset($criteria))
    	return "SELECT * FROM ". strtolower($tblname)." WHERE ".$criteria;
    	else
    	return "SELECT * FROM ". strtolower($tblname)."  ";

    }


	function CreateSqlUsingCriteriaWithJoin($tblname1,$fields1,$tblname2,$fields2,$relations,$criteria){

		$tblField1 = $this->JoinFields($tblname1,$fields1);
		$tblField2 = $this->JoinFields($tblname2,$fields2);
		$tblname ="";
		$tblFields="";

		if(isset($tblField2) && !empty($tblField2) )
		{
			$tblname = $tblname1." , ".$tblname2;
			$tblFields = $tblField1." , ".$tblField2;
		}
		else
		{
			$tblname = $tblname1;
			$tblFields = $tblField1;
		}

		if(isset($relations) && !empty($relations))
			$relations = $relations." AND ";

			return "SELECT ".$tblFields." FROM ". strtolower($tblname) ." WHERE ".$relations.$criteria;

	}

	function JoinFields($tblname,$fields){

			$fieldLst ="";

			if(isset($tblname) && isset($fields))
			{
				if(count($fields) > 0)
				{
					foreach($fields as $key=>$value)
					{
						if(empty($fieldLst))
						{
							$fieldLst = $tblname.".".$value;
						}
						else
						{
							$fieldLst = $fieldLst ." , ".$tblname.".".$value;
						}
					}

				}
			}

			return $fieldLst;

		}


}

?>