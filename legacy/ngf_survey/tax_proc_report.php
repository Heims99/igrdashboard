<?php
//Session starts here
session_start();
include_once '../connection.php';
if(!isset($_SESSION['user']))
{
 header("Location: login.php");
}
$privilege=$_SESSION['privilege'];
if ($privilege==5)
{
	echo "<p><font style='tahoma' color='red' size='3px'>Invalid user!</font></p><p><font style='tahoma' color='red' size='3px'>You do not have authorized access to this page</font></p>";
	exit();
}
$con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
$res=mysqli_query($con, "SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Tax Administration Report</title>
<script type="text/javascript" src="script.js"> </script>
        <link rel="stylesheet" href="style.css" />
       <style type="text/css">
        .mytr {
	font-family: 'Raleway', sans-serif;
	font-size: x-small;
	background-color: #CCC;
}
        .mytrhead {
	font-family: 'Raleway', sans-serif;
	font-size: 9px;
	font-weight: bold;
	color: #FFF;
	background-color: #000;
}
.mytitlehead{
	background-color: #CCFF99;
	padding: 32px;
	margin: 0 -50px;
	text-align: center;
	border-radius: 5px 5px 0 0;
}
        </style>
</head>

<body>
            
                <h2>Tax Procedures Submissions</h2><hr/>
<span id="error">
			<!----Initializing Session for errors--->
                    <?php
                    if (!empty($_SESSION['error'])) {
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    }
                    ?>
</span>
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="outer_table">
  <tr>
    <td colspan="29">&nbsp;</td>
    </tr>
  <tr class="mytrhead">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="18">Tax registration using Unified Tax Identification Number (TIN)</td>
    <td colspan="8">Efficiency of tax assessment method (best of judgement by tax officers versus self-assessment)</td>
    </tr>
  <tr class="mytrhead">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>27. What is the number of registered taxpayers under TIN?</td>
    <td>28. Is the state's TIN record fully captured on the national JTB database?*</td>
    <td>29. How often are TINs issued by the SIRS updated on the national database?*</td>
    <td colspan="3">30. How is the TIN database used in the administration of tax in the State?*</td>
    <td>31. Do all government employees at State MDA and LGA level have TINs?*</td>
    <td>32. Does the SIRS issue a registration pack with basic guidance to new taxpayers at the point of registration?* (This should be a document that gives the taxpayer basic information such as rights, obligations, filing and payment due dates.)</td>
    <td>33a. Do the SIRS use a new and simplified tax return? (This should not be the recent print of the return form that refers to allowances etc that are no longer applicable.)</td>
    <td>33b. If Yes, how many pages long?</td>
    <td>33c. Is the form standardised, well laid out and legible?*</td>
    <td>33d. If yes, what is the form standard used?</td>
    <td>34a. Are these tax returns freely and publicly available?*</td>
    <td>34b. Are they given out as part of the TIN registration pack?* (If yes, we would like to see a copy of the pack and staff guidance.)</td>
    <td>34c. Are they available on request? (Tick all that apply)*</td>
    <td>35a. Is there clear guidance to completing tax returns?*</td>
    <td>35b. If Yes do these include examples and PIT rates table to ease computation? And references to each box for clarity? If yes please be ready to share for peer learning*</td>
    <td>36. Are they available online?*</td>
    <td>37. Are assessments almost always issued by the SIRS?*</td>
    <td>38. How does self-assessment operate in practice in the State?*</td>
    <td>39. Do you get self-assessment returns covering the following taxes? (Please tick as apply)*</td>
    <td>40. Do you have any desk guidance for staff making objective Best of Judgement (BoJ) assessments?*</td>
    <td>41. Are the taxpayers' rights to object to an SIRS best of judgement assessment clearly communicated?*</td>
    <td>42a. Do you have a documented Objection to Assessments Process?*</td>
    <td>42b. If Yes does this process ensure that the same person who rasied the assessment does not decide on the final validity of the assessment? And Does the guidance make it clear that the taxpayer can ask that his/her objection is settled by going to court or the tax appeal tribunal?*</td>
    <td>43. In the last year, how many objections have been referred to the Tax Appeal Tribunal that covers your state in the last year?*</td>
    </tr>
  <tr class="mytrhead">
    <td>S/No.</td>
    <td>Year</td>
    <td>State</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Used in making assessments in the absence of a self-assessment?*</td>
    <td>Used in taxpayer engagement strategies to identify target groups?*</td>
    <td>Used in target setting and planning?*</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <?php
		  //include("../connection.php");
		  $con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
		  $sql=mysqli_query($con, "SELECT users.username, users.state, survey1.survey_id, survey1.mysession, survey1.quarter, survey1.year,survey1.tin_captured,survey1.reg_pack,survey1.new_tax,survey1.num_page,survey1.standard_form,survey1.paper_size,survey1.avail_public,survey1.pack_content,survey1.avail_req,survey1.avail_req1,survey1.avail_req2,survey1.avail_req3,survey1.avail_req4,survey1.avail_req5,survey1.avail_req6,survey1.guidance,survey1.avail_online,survey1.sbirs_assessment,survey1.self_assessment,survey1.self_assesscover,survey1.self_assesscover1,survey1.self_assesscover2,survey1.self_assesscover3,survey1.desk_guide,survey1.object_right,survey1.doc_appeal,survey1.referred,survey1.num_reg_taxpayer,survey1.tin_often_updated,survey1.make_assess,survey1.taxpayer_engage,survey1.target_setting,survey1.have_tin,survey1.pit_rates,survey1.validity FROM users, survey1
WHERE users.username = survey1.mysession
ORDER BY survey1.year");
		  //$result=mysql_query($sql,$db) or die(mysql_error());
		  $i = 1;
		  while($row=mysqli_fetch_array($sql)) {
			  
		$year=$row['year']; 
		$state=$row['state'];
		$tin_captured=$row['tin_captured'];
		if ($tin_captured==4){$tin_captured='Yes';}
		if ($tin_captured==1){$tin_captured='No';}
		if ($tin_captured==2){$tin_captured='Partially';}
		else {}
		$reg_pack=$row['reg_pack'];
		if ($reg_pack==4){$reg_pack='Yes';}
		if ($reg_pack==1){$reg_pack='No';}
		else {}
		$new_tax=$row['new_tax']; 
		if ($new_tax==4){$new_tax='Yes';}
		if ($new_tax==1){$new_tax='No';}
		else {}
		$num_page=$row['num_page'];
		if ($num_page==1){$num_page='Five pages';}
		if ($num_page==2){$num_page='Four pages';}
		if ($num_page==4){$num_page='Three pages';}
		if ($num_page==5){$num_page='Two pages';}
		if ($num_page==6){$num_page='One page';}
		//if ($num_page==0){$num_page=' 6 pages';}
		//if ($num_page==0){$num_page=' 6+ pages';}
		else {'Six pages or six plus pages';}
		$standard_form=$row['standard_form'];
		if ($standard_form==4){$standard_form='Yes';}
		if ($standard_form==1){$standard_form='No';}
		else {}
		$paper_size=$row['paper_size'];
		if ($paper_size==5){$paper_size='A4 size';}
		if ($paper_size==3){$paper_size='Legal page size';}
		if ($paper_size==1){$paper_size='Other size';}
		else {}
		$avail_public=$row['avail_public'];
		if ($avail_public==4){$avail_public='Yes';}
		if ($avail_public==1){$avail_public='No';}
		else {}
		$pack_content=$row['pack_content']; 
		if ($pack_content==4){$pack_content='Yes';}
		if ($pack_content==1){$pack_content='No';}
		else {}
		$avail_req=$row['avail_req'];
		if ($avail_req==1){$avail_req='Field offices';}
		else {}
		$avail_req1=$row['avail_req1'];
		if ($avail_req1==1){$avail_req1='Head office';}
		else {}
		$avail_req2=$row['avail_req2'];
		if ($avail_req2==1){$avail_req2='Mobile information points';}
		else {}
		$avail_req3=$row['avail_req3'];
		if ($avail_req3==1){$avail_req3='Sensitisation events';}
		else {}
		$avail_req4=$row['avail_req4'];
		if ($avail_req4==1){$avail_req4='Help desks';}
		else {}
		$avail_req5=$row['avail_req5'];
		if ($avail_req5==1){$avail_req5='Online';}
		else {}
		$avail_req6=$row['avail_req6'];
		if ($avail_req6==1){$avail_req6='Others';}
		else {}
		$guidance=$row['guidance'];
		if ($guidance==4){$guidance='Yes';}
		if ($guidance==1){$guidance='No';}
		else {}
		$avail_online=$row['avail_online'];
		if ($avail_online==5){$avail_online='Yes';}
		if ($avail_online==1){$avail_online='No';}
		else {}
		$sbirs_assessment=$row['sbirs_assessment'];
		if ($sbirs_assessment==1){$sbirs_assessment='Yes';}
		if ($sbirs_assessment==4){$sbirs_assessment='No';}
		else {}
		$self_assessment=$row['self_assessment'];
		if ($self_assessment==4){$self_assessment='Most of the time';}
		if ($self_assessment==2){$self_assessment='Sometimes';}
		if ($self_assessment==1){$self_assessment='Rarely';}
		//if ($self_assessment==0){$self_assessment='Never';}
		else {'Never';}
		$self_assesscover=$row['self_assesscover'];
		if ($self_assesscover==1){$self_assesscover='Personal Income Tax';}
		else {}
		$self_assesscover1=$row['self_assesscover1'];
		if ($self_assesscover1==1){$self_assesscover1='Capital Gains Tax';}
		else {}
		$self_assesscover2=$row['self_assesscover2'];
		if ($self_assesscover2==1){$self_assesscover2='Sales Tax';}
		else {}
		$self_assesscover3=$row['self_assesscover3'];
		if ($self_assesscover3==1){$self_assesscover3='Others';}
		else {}
		$desk_guide=$row['desk_guide'];
		if ($desk_guide==4){$desk_guide='Yes';}
		if ($desk_guide==1){$desk_guide='No';}
		else {}
		$object_right=$row['object_right'];
		if ($object_right==4){$object_right='Yes';}
		if ($object_right==1){$object_right='No';}
		else {}
		$doc_appeal=$row['doc_appeal'];
		if ($doc_appeal==4){$doc_appeal='Yes';}
		if ($doc_appeal==1){$doc_appeal='No';}
		else {}
		$referred=$row['referred'];
		if ($referred==1){$referred='0 -10 Objections';}
		if ($referred==2){$referred='10 – 20 Objections';}
		if ($referred==4){$referred='20 – 50 Objections';}
		if ($referred==6){$referred='50+ Objections';}
		else {}
		$num_reg_taxpayer=$row['num_reg_taxpayer'];
		$tin_often_updated=$row['tin_often_updated'];
		$make_assess=$row['make_assess'];
		if ($make_assess==4){$make_assess='Yes';}
		if ($make_assess==1){$make_assess='No';}
		else {}
		$taxpayer_engage=$row['taxpayer_engage'];
		if ($taxpayer_engage==4){$taxpayer_engage='Yes';}
		if ($taxpayer_engage==1){$taxpayer_engage='No';}
		else {}
		$target_setting=$row['target_setting'];
		if ($target_setting==4){$target_setting='Yes';}
		if ($target_setting==1){$target_setting='No';}
		else {}
		$have_tin=$row['have_tin'];
		if ($have_tin==4){$have_tin='Yes';}
		if ($have_tin==1){$have_tin='No';}
		else {}
		$pit_rates=$row['pit_rates'];
		if ($pit_rates==4){$pit_rates='Yes';}
		if ($pit_rates==1){$pit_rates='No';}
		else {}
		$validity=$row['validity'];
		if ($validity==4){$validity='Yes';}
		if ($validity==1){$validity='No';}
		else {}
		
			  
		  ?>
  <tr class="mytr">
    <td><?php echo $i; $i++; ?></td>
    <td><?php echo $year; ?></td>
    <td><?php echo $state; ?></td>
    <td><?php echo $num_reg_taxpayer; ?></td>
    <td><?php echo $tin_captured; ?></td>
    <td><?php echo $tin_often_updated; ?></td>
    <td><?php echo $make_assess; ?></td>
    <td><?php echo $taxpayer_engage; ?></td>
    <td><?php echo $target_setting; ?></td>
    <td><?php echo $have_tin; ?></td>
    <td><?php echo $reg_pack; ?></td>
    <td><?php echo $new_tax; ?></td>
    <td><?php echo $num_page; ?></td>
    <td><?php echo $standard_form; ?></td>
    <td><?php echo $paper_size; ?></td>
    <td><?php echo $avail_public; ?></td>
    <td><?php echo $pack_content; ?></td>
    <td><?php echo $avail_req.", ".$avail_req1.", ".$avail_req2.", ".$avail_req3.", ".$avail_req4.", ".$avail_req5.", ".$avail_req6; ?></td>
    <td><?php echo $guidance; ?></td>
    <td><?php echo $pit_rates; ?></td>
    <td><?php echo $avail_online; ?></td>
    <td><?php echo $sbirs_assessment; ?></td>
    <td><?php echo $self_assessment; ?></td>
    <td><?php echo $self_assesscover.", ".$self_assesscover1.", ".$self_assesscover2.", ".$self_assesscover3; ?></td>
    <td><?php echo $desk_guide; ?></td>
    <td><?php echo $object_right; ?></td>
    <td><?php echo $doc_appeal; ?></td>
    <td><?php echo $validity; ?></td>
    <td><?php echo $referred; ?></td>
    </tr>
  <?php } ?>
</table>

</body>
</html>
