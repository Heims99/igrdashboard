<?php

	class connector {

	 public $Property;
	 public $Key;


	 function connector(){

     }

     function AddProperty($propertyname){


	  $this->Property[$propertyname] = "";
	  $this->Key[$propertyname] =$propertyname;
     }


     function ClearAllPropertyValue(){

    	 foreach($keyValue as $this->Key => $value)	{

		       $this->Property[$value] = "";
	     }
 	 }

 	 function ClearPropertyValue($propertyname){

		 $this->Property[$propertyname] = "";

 	 }

		function KeyExist($theKey)
		{
			$hasKey = false;
			foreach($this->Key as $key=>$value)
			{
				$hasKey = $value == $theKey;
				if($hasKey) break;
			}
			return $hasKey;
		}

		// loads a key => value array into the class
		function Load($array)
		{

			if(is_array($array))
			{
				foreach($array as $key=>$value)
				{
					if(!((int)$key))
					$this->Property[$key] = $value;
				}
			}
		}




}
?>