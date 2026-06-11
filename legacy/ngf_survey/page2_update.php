<?php
 
include("../connection.php");
$mode=$_GET["mode"];
if($mode=="update")
 
{
				$tin_captured=$_POST['tin_captured'];
				$reg_pack=$_POST['reg_pack'];
				$new_tax=$_POST['new_tax'];
				$num_page=$_POST['num_page'];
				$standard_form=$_POST['standard_form'];
				$paper_size=$_POST['paper_size'];
				$avail_public=$_POST['avail_public'];
				$pack_content=$_POST['pack_content'];
				$avail_req=$_POST['avail_req'];
				$avail_req1=$_POST['avail_req1'];
				$avail_req2=$_POST['avail_req2'];
				$avail_req3=$_POST['avail_req3'];
				$avail_req4=$_POST['avail_req4'];
				$avail_req5=$_POST['avail_req5'];
				$avail_req6=$_POST['avail_req6'];
				$guidance=$_POST['guidance'];
				$avail_online=$_POST['avail_online'];
				$sbirs_assessment=$_POST['sbirs_assessment'];
				$self_assessment=$_POST['self_assessment'];
				$self_assesscover=$_POST['self_assesscover'];
				$self_assesscover1=$_POST['self_assesscover1'];
				$self_assesscover2=$_POST['self_assesscover2'];
				$self_assesscover3=$_POST['self_assesscover3'];
				$desk_guide=$_POST['desk_guide'];
				$object_right=$_POST['object_right'];
				$doc_appeal=$_POST['doc_appeal'];
				$referred=$_POST['referred'];
				$num_reg_taxpayer=$_POST['num_reg_taxpayer'];
				$tin_often_updated=$_POST['tin_often_updated'];
				$make_assess=$_POST['make_assess'];
				$taxpayer_engage=$_POST['taxpayer_engage'];
				$target_setting=$_POST['target_setting'];
				$have_tin=$_POST['have_tin'];
				$pit_rates=$_POST['pit_rates'];
				$validity=$_POST['validity'];
				$completed=$_POST['completed'];
				$surveyid=$_POST['surveyid'];
 
$con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
$sql="update survey1 SET tin_captured='$tin_captured', reg_pack='$reg_pack', new_tax='$new_tax', num_page='$num_page', standard_form='$standard_form', paper_size='$paper_size', avail_public='$avail_public', pack_content='$pack_content', avail_req='$avail_req', avail_req1='$avail_req1', avail_req2='$avail_req2', avail_req3='$avail_req3', avail_req4='$avail_req4', avail_req5='$avail_req5', avail_req6='$avail_req6', guidance='$guidance', avail_online='$avail_online', sbirs_assessment='$sbirs_assessment', self_assessment='$self_assessment', self_assesscover='$self_assesscover', self_assesscover1='$self_assesscover1', self_assesscover2='$self_assesscover2', self_assesscover3='$self_assesscover3', desk_guide='$desk_guide', object_right='$object_right', doc_appeal='$doc_appeal', referred='$referred', num_reg_taxpayer='$num_reg_taxpayer', tin_often_updated='$tin_often_updated', make_assess='$make_assess', taxpayer_engage='$taxpayer_engage', target_setting='$target_setting', have_tin='$have_tin', pit_rates='$pit_rates', validity='$validity', completed='$completed' WHERE survey_id='$surveyid'";
 
	//$result=mysql_query($sql,$db) or die(mysql_error());
	if (mysqli_query($con, $sql)) {
      header("location: submitted_view.php");
   } else {
      echo "Error updating record: " . mysqli_error($con);
   }
   mysqli_close($con);
		//	header("location: submitted_view.php");
		  }
		  ?>