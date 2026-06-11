<?php

include_once 'DbEngine.php';
include_once 'Server.php';

class CoreDAO {

 private $myServer;
 public $dbEngine;
 protected $myrp;
 protected $pgs;
 private $id;
 private $allrecs ;
 public $total;


 function CoreDAO(){


}

function Connect(){

  $this->myServer = new Server();
  $this->dbEngine = new DbEngine($this->myServer->DatabaseEngine);
  $this->dbEngine->Connect($this->myServer->SeverName,$this->myServer->UserName,$this->myServer->Password,$this->myServer->Database);

   }

   function Add($table,$key,$record){

    	 $id = $this->dbEngine->Add($table,$key,$record);

         return $id;
   }

   function GetRecordUsingDate($tblname,$startdate,$enddate,$name){



	 $records = $this->dbEngine->GetRecordUsingDate($tblname,$startdate,$enddate,$name);

         return $records;
   }

   function GetOrder($table,$key,$record,$order){

	$sql = $this->dbEngine->CreateSqlQueryWithOrdering_Limit($table,$record,true,$order,$key,false,NULL,NULL);


	$recordset =$this->dbEngine->FindRecord($sql);
	if($recordset->RecordCount() > 0){
	return $recordset->fields["Ord"]+ 1;
	}
    else{

	return 1;

   }
   }

   function Update($table,$oldrecord,$newrecord){


	$id = $this->dbEngine->Update($table,$oldrecord,$newrecord);
	return $id;
  }

   function RetrieveAll($table,$record,$orderType,$key){

	$this->allrecs = true;
	return $this->GetRecordsInfo($table,$record,$orderType,$key);

   }


   function DeleteRecord($table,$field,$id){


	$this->dbEngine->DeleteRecord($table,$field,$id);

   }

   function RetrieveByID($table,$record,$orderType,$key){


    return $this->GetRecordsInfo($table,$record,$orderType,$key);

   }


  function GetRecordsInfo($table,$record,$orderType,$key){


	 if(($record->Property["ID"] !="" && $record->Property["ID"] != null) || $this->allrecs || $this->pgs == null ){


	 $sql = $this->dbEngine->CreateSqlQueryWithOrdering_Limit($table,$record,true,$orderType,$key,false,null,null);


	 }
 	 else{


         $start = (($this->pgs-1) * $this->myrp);

         $Tsql = $this->dbEngine->CreateSqlQueryUsingAllFields($table,$record);

		 $rec =$this->dbEngine->FindRecord($Tsql);
         $tot = $rec->RecordCount();
         $this->total = $tot;

              $sql = $this->dbEngine->CreateSqlQueryWithOrdering_Limit($table,$record,true,$orderType,$key,true,$this->myrp,$start);




	}

     $recordset =$this->dbEngine->FindRecord($sql);

    if(!$recordset->RecordCount()){

     return null;

	}
	else{

       return $recordset;

    }

 }


  function FindRecords($table,$record,$orderType,$key,$rp,$pg){

   	$this->myrp = $rp;
	$this->pgs = $pg;

    return $this->GetRecordsInfo($table,$record,$orderType,$key);

   }



}
?>