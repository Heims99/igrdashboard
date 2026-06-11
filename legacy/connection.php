<?php
$db = @mysqli_connect('localhost', 'nggovern_Garki', 'NgfBassi1!') or die('Could not connect.');

if(!$db) 

	die('no db');

if(!mysqli_select_db($db, 'nggovern_dashboard'))

 	die('No database selected.');
 	

?>