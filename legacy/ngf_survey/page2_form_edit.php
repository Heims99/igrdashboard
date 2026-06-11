<?php
//Session starts here
session_start();
include_once '../connection.php';
if(!isset($_SESSION['user']))
{
 header("Location: login.php");
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
<!DOCTYPE HTML>
<html>
    <head>
        <title>TAX PROCEDURES</title>
        <link rel="stylesheet" href="style.css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
        <button onclick="myFunction()">Print Form</button>

<script>
function myFunction() {
    window.print();
}
</script>
        <script>

		$(document).ready(function (){
            $("#newtaxy").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#num_page").show();
                }else{
                    $("#num_page").hide();
                } 
            });
        });
		
		$(document).ready(function (){
            $("#newtaxn").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#num_page").hide();
                }else{
                    $("#num_page").show();
                } 
            });
        });
        
        $(document).ready(function (){
            $("#standardformy").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#paper_size").show();
                }else{
                    $("#paper_size").hide();
                } 
            });
        });
		
		$(document).ready(function (){
            $("#standardformn").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#paper_size").hide();
                }else{
                    $("#paper_size").show();
                } 
            });
        });
		
		$(document).ready(function (){
            $("#guidanceyes").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#pit_rates").show();
                }else{
                    $("#pit_rates").hide();
                } 
            });
        });
		
		$(document).ready(function (){
            $("#guidanceno").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#pit_rates").hide();
                }else{
                    $("#pit_rates").show();
                } 
            });
        });
		
		$(document).ready(function (){
            $("#docappealy").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#validity").show();
                }else{
                    $("#validity").hide();
                } 
            });
        });
		
		$(document).ready(function (){
            $("#docappealn").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#validity").hide();
                }else{
                    $("#validity").show();
                } 
            });
        });
		
		</script>
    </head>
    <body>
        <div class="container">
            <div class="main">
                <h2>Tax Procedures (Registration, Filing, Assessment and Payment)<br><i>These procedures and processes are at the core of any tax administration. Taxpayers need to be enumerated and registered; they need to file returns (with a self-assessment) and they need to pay their taxes either self-assessed or assessed by the SBIRS (best of judgement assessments).</i></h2><hr/>
                <span id="error">
			<!----Initializing Session for errors--->
                    <?php
                    if (!empty($_SESSION['error'])) {
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    }
                    ?>
                </span>
               <?php		
		  $mode=$_GET["mode"];
		  if($mode=="update") {
		  	//include("../connection.php");
		  	$con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
			$surveyid=$_GET["survey_id"]; //echo $surveyid;
			//$sql="select stateId,stateName,zoneId, statePopulation from $state where stateId='$stateId'";
			$sql=mysqli_query($con, "SELECT survey_id,tin_captured,reg_pack,new_tax,num_page,standard_form,paper_size,avail_public,pack_content,avail_req,avail_req1,avail_req2,avail_req3,avail_req4,avail_req5,avail_req6,guidance,avail_online,sbirs_assessment,self_assessment,self_assesscover,self_assesscover1,self_assesscover2,self_assesscover3,desk_guide,object_right,doc_appeal,referred,num_reg_taxpayer,tin_often_updated,make_assess,taxpayer_engage,target_setting,have_tin,pit_rates,validity,completed FROM survey1 WHERE survey_id='$surveyid'");
			
			//$result=mysql_query($sql,$db) or die(mysql_error()); //echo $result;
			while($row=mysqli_fetch_array($sql)) {
				//$lgaId=$row['mysession'];
				$tin_captured=$row['tin_captured']; //echo $tin_database;
				$reg_pack=$row['reg_pack'];
				$new_tax=$row['new_tax'];
				$num_page=$row['num_page'];
				$standard_form=$row['standard_form'];
				$paper_size=$row['paper_size'];
				$avail_public=$row['avail_public'];
				$pack_content=$row['pack_content'];
				$avail_req=$row['avail_req'];
				$avail_req1=$row['avail_req1'];
				$avail_req2=$row['avail_req2'];
				$avail_req3=$row['avail_req3'];
				$avail_req4=$row['avail_req4'];
				$avail_req5=$row['avail_req5'];
				$avail_req6=$row['avail_req6'];
				$guidance=$row['guidance'];
				$avail_online=$row['avail_online'];
				$sbirs_assessment=$row['sbirs_assessment'];
				$self_assessment=$row['self_assessment'];
				$self_assesscover=$row['self_assesscover'];
				$self_assesscover1=$row['self_assesscover1'];
				$self_assesscover2=$row['self_assesscover2'];
				$self_assesscover3=$row['self_assesscover3'];
				$desk_guide=$row['desk_guide'];
				$object_right=$row['object_right'];
				$doc_appeal=$row['doc_appeal'];
				$referred=$row['referred'];
				$num_reg_taxpayer=$row['num_reg_taxpayer'];
				$tin_often_updated=$row['tin_often_updated'];
				$make_assess=$row['make_assess'];
				$taxpayer_engage=$row['taxpayer_engage'];
				$target_setting=$row['target_setting'];
				$have_tin=$row['have_tin'];
				$pit_rates=$row['pit_rates'];
				$validity=$row['validity'];
				$completed=$row['completed'];
			}
		?>
                <h3>Tax registration using Unified Tax Identification Number (TIN)</h3>
                <form action="page2_update.php?mode=update" method="post" novalidate>
                    <input name="surveyid" type="text" value="<?php echo $surveyid; ?>" hidden="true"  >
                <input name="mysession" type="text" value="<?php echo $userRow['username']; ?>" hidden="true"  >
                    <label>27. What is the number of registered taxpayers under TIN?</label><br />
                    <input name="num_reg_taxpayer" type="text" placeholder="Enter integer number" value="<?php echo $num_reg_taxpayer; ?>" >
<br />

                    <label>28. Is the state's TIN record fully captured on the national JTB database?<span>*</span></label><br />
                    <input type="radio" name="tin_captured" value="4" required <?php if($tin_captured=="4"){ echo "checked";}?> ><i>Yes</i><br />
                    <input type="radio" name="tin_captured" value="1" <?php if($tin_captured=="1"){ echo "checked";}?> ><i>No</i><br>
                    <input type="radio" name="tin_captured" value="2" <?php if($tin_captured=="2"){ echo "checked";}?> ><i>Partially</i>
                    <br /><br />
                    
                    <label>29. How often are TINs issued by the SIRS updated on the national database?<span>*</span></label><br />
                    <input type="radio" name="tin_often_updated" value="Daily"  <?php if($tin_often_updated=="Daily"){ echo "checked";}?> ><i>Daily</i><br />
                    <input type="radio" name="tin_often_updated" value="Monthly" <?php if($tin_often_updated=="Monthly"){ echo "checked";}?> ><i>Monthly</i><br>
                    <input type="radio" name="tin_often_updated" value="Quarterly" <?php if($tin_often_updated=="Quarterly"){ echo "checked";}?> ><i>Quarterly</i><br>
                    <input type="radio" name="tin_often_updated" value="Annually" <?php if($tin_often_updated=="Annually"){ echo "checked";}?> ><i>Annually</i>
                    <br /><br />
                    
                    <label>30. How is the TIN database used in the administration of tax in the State?<span>*</span></label><br /><br>
                    
                    <i>Used in making assessments in the absence of a self-assessment?<span>*</span></i><br />
                    <input type="radio" name="make_assess" value="4" required <?php if($make_assess=="4"){ echo "checked";}?> ><i>Yes</i><br />
                    <input type="radio" name="make_assess" value="1" <?php if($make_assess=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    
                    <i>Used in taxpayer engagement strategies to identify target groups?<span>*</span></i><br />
                    <input type="radio" name="taxpayer_engage" value="4" required <?php if($taxpayer_engage=="4"){ echo "checked";}?> ><i>Yes</i><br />
                    <input type="radio" name="taxpayer_engage" value="1" <?php if($taxpayer_engage=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    
                    <i>Used in target setting and planning?<span>*</span></i><br />
                    <input type="radio" name="target_setting" value="4" required <?php if($target_setting=="4"){ echo "checked";}?> ><i>Yes</i><br />
                    <input type="radio" name="target_setting" value="1" <?php if($target_setting=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    
                    <label>31.  Do all government employees at State MDA and LGA level have TINs?<span>*</span></label><br />
                    <input type="radio" name="have_tin" value="4" required <?php if($have_tin=="4"){ echo "checked";}?> ><i>Yes</i><br />
                    <input type="radio" name="have_tin" value="1" <?php if($have_tin=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br>
                    
                    <label>32.  Does the SIRS issue a registration pack with basic guidance to new taxpayers at the point of registration?<span>*</span></label><i> (This should be a document that gives the taxpayer basic information such as rights, obligations, filing and payment due dates.)</i><br />
                    <input type="radio" name="reg_pack" value="4" required <?php if($reg_pack=="4"){ echo "checked";}?> ><i>Yes</i><br />
                    <input type="radio" name="reg_pack" value="1" <?php if($reg_pack=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br>
                    
<label>33a. Does the SIRS use a new and simplified tax return?</label><i> (This should not be the print of the return form that refers to allowances etc that are no longer applicable.)</i><br />
                    <input type="radio" name="new_tax" id="newtaxy" value="4" required <?php if($new_tax=="4"){ echo "checked";}?> ><i>Yes</i><br />
                    <input type="radio" name="new_tax" id="newtaxn" value="1" <?php if($new_tax=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    <i id="num_page" style="display:none;">33b. If Yes, how many pages long?<br><input type="radio" name="num_page" value="6" required <?php if($num_page=="6"){ echo "checked";}?> >1 page<br />
                    <input type="radio" name="num_page" value="5" <?php if($num_page=="5"){ echo "checked";}?> >2 pages<br />
                    <input type="radio" name="num_page" value="4" <?php if($num_page=="4"){ echo "checked";}?> >3 pages<br />
                    <input type="radio" name="num_page" value="2" <?php if($num_page=="2"){ echo "checked";}?> >4 pages<br />
                    <input type="radio" name="num_page" value="1" <?php if($num_page=="1"){ echo "checked";}?> >5 pages<br />
                    <input type="radio" name="num_page" value="0" <?php if($num_page=="0"){ echo "checked";}?> >6 pages<br />
                    <input type="radio" name="num_page" value="0" <?php if($num_page=="0"){ echo "checked";}?> >6+ pages</i>
                    <br /><br />
                    <label>33c. Is the form standardised, well laid out and legible?<span>*</span></label><br />
                    <input type="radio" name="standard_form" id="standardformy" value="4" required <?php if($standard_form=="4"){ echo "checked";}?> ><i>Yes</i><br />
                    <input type="radio" name="standard_form" id="standardformn" value="1" <?php if($standard_form=="1"){ echo "checked";}?> ><i>No</i>
                    <br />
<i id="paper_size" style="display:none;">33d. If yes, what is the form standard used?<br>
                    <input type="radio" name="paper_size" value="5" required <?php if($paper_size=="5"){ echo "checked";}?> >A4 size<br>
                    <input type="radio" name="paper_size" value="3" <?php if($paper_size=="3"){ echo "checked";}?> >Legal page size<br>
                    <input type="radio" name="paper_size" value="1" <?php if($paper_size=="1"){ echo "checked";}?> >Other size</i>
                    <br /><br />
                    <label>34a. Are these tax returns freely and publicly available?<span>*</span></label><br />
                    <input type="radio" name="avail_public" value="4" required <?php if($avail_public=="4"){ echo "checked";}?> ><i>Yes</i><br />
                    <input type="radio" name="avail_public" value="1" <?php if($avail_public=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    <label>34b. Are they given out as part of the TIN registration pack?<span>*</span></label> <i>(If yes, we would like to see a copy of the pack and staff guidance.)</i><br />
                    <input type="radio" name="pack_content" value="4" required <?php if($pack_content=="4"){ echo "checked";}?> ><i>Yes</i><br />
                    <input type="radio" name="pack_content" value="1" <?php if($pack_content=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    <label>34c. Are they available on request? (Tick all that apply)<span>*</span></label><br />
                    <input type="checkbox" name="avail_req" value="1" required <?php if($avail_req=="1"){ echo "checked";}?> ><i>Field offices</i><br />
                    <input type="checkbox" name="avail_req1" value="1" <?php if($avail_req1=="1"){ echo "checked";}?> ><i>Head office</i><br />
                    <input type="checkbox" name="avail_req2" value="1" required <?php if($avail_req2=="1"){ echo "checked";}?> ><i>Mobile information points</i><br />
                    <input type="checkbox" name="avail_req3" value="1" <?php if($avail_req3=="1"){ echo "checked";}?> ><i>Sensitisation events</i><br />
                    <input type="checkbox" name="avail_req4" value="1" <?php if($avail_req4=="1"){ echo "checked";}?> ><i>Help desks</i><br />
                    <input type="checkbox" name="avail_req5" value="1" required <?php if($avail_req5=="1"){ echo "checked";}?> ><i>Online</i><br />
                    <input type="checkbox" name="avail_req6" value="1" <?php if($avail_req6=="1"){ echo "checked";}?> ><i>Others</i>
                    <br /><br />
                    
                    <label>35a. Is there clear guidance to completing tax returns?<span>*</span></label><br />
                    <input type="radio" name="guidance" id="guidanceyes" value="4" required <?php if($guidance=="4"){ echo "checked";}?> ><i>Yes</i><br />
                    <input type="radio" name="guidance" id="guidanceno" value="1" <?php if($guidance=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    
                    <i id="pit_rates" style="display:none;">35b. If Yes do these include examples and PIT rates table to ease computation? And references to each box for clarity? If yes please be ready to share for peer learning<span>*</span><br />
                    <input type="radio" name="pit_rates" value="4" required <?php if($pit_rates=="4"){ echo "checked";}?> >Yes<br />
                    <input type="radio" name="pit_rates" value="1" <?php if($pit_rates=="1"){ echo "checked";}?> >No</i>
                    <br /><br />
                    
                    <label>36. Are they available online?<span>*</span></label><br />
                    <input type="radio" name="avail_online" value="5" required <?php if($avail_online=="5"){ echo "checked";}?> ><i>Yes</i><br />
                    <input type="radio" name="avail_online" value="1" <?php if($avail_online=="1"){ echo "checked";}?> ><i>No</i>
                    <br />
                    <h3>Efficiency of tax assessment method (best of judgement by tax officers versus self-assessment)</h3>
<label>37. Are assessments almost always issued by the SIRS?<span>*</span></label><br />
                    <input type="radio" name="sbirs_assessment" value="1" required <?php if($sbirs_assessment=="1"){ echo "checked";}?> ><i>Yes</i><br />
                    <input type="radio" name="sbirs_assessment" value="4" <?php if($sbirs_assessment=="4"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    <label>38. How does self-assessment operate in practice in the State?<span>*</span></label><br />
                    <input type="radio" name="self_assessment" value="4" required <?php if($self_assessment=="4"){ echo "checked";}?> ><i>Most of the time</i><br />
                    <input type="radio" name="self_assessment" value="2" <?php if($self_assessment=="2"){ echo "checked";}?> ><i>Sometimes</i><br />
                    <input type="radio" name="self_assessment" value="1" required <?php if($self_assessment=="1"){ echo "checked";}?> ><i>Rarely</i><br />
                    <input type="radio" name="self_assessment" value="0" <?php if($self_assessment=="0"){ echo "checked";}?> ><i>Never</i>
                    <br /><br />
                    <label>39.  Do you get self-assessment returns covering the following taxes? (Please tick as apply)<span>*</span></label><br />
                    <input type="checkbox" name="self_assesscover" value="1" required <?php if($self_assesscover=="1"){ echo "checked";}?> ><i>Personal Income Tax</i><br />
                    <input type="checkbox" name="self_assesscover1" value="1" <?php if($self_assesscover1=="1"){ echo "checked";}?> ><i>Capital Gains Tax</i><br />
                    <input type="checkbox" name="self_assesscover2" value="1" required <?php if($self_assesscover2=="1"){ echo "checked";}?> ><i>Sales Tax</i><br />
                    <input type="checkbox" name="self_assesscover3" value="1" <?php if($self_assesscover3=="1"){ echo "checked";}?> ><i>Others</i>
                    <br /><br />
                    <label>40.  Do you have any desk guidance for staff making objective Best of Judgement (BoJ) assessments?<span>*</span></label><br />
                    <input type="radio" name="desk_guide" value="4" required <?php if($desk_guide=="4"){ echo "checked";}?> ><i>Yes</i><br>
                    <input type="radio" name="desk_guide" value="1" <?php if($desk_guide=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    <label>41. Are the taxpayers' rights to object to an SIRS best of judgement assessment clearly communicated?<span>*</span></label><br />
                    <input type="radio" name="object_right" value="4" required <?php if($object_right=="4"){ echo "checked";}?> ><i>Yes</i><br />
                    <input type="radio" name="object_right" value="1" <?php if($object_right=="1"){ echo "checked";}?> ><i>No</i>
                    <br /><br />
                    <label>42a.  Do you have a documented Objection to Assessments Process?<span>*</span></label><br />
                    <input type="radio" name="doc_appeal" id="docappealy" value="4" required <?php if($doc_appeal=="4"){ echo "checked";}?> ><i>Yes</i><br />
                    <input type="radio" name="doc_appeal" id="docappealn" value="1" <?php if($doc_appeal=="1"){ echo "checked";}?>><i>No</i>
                    <br /><br />
                    
                    <i id="validity" style="display:none;">42b. If Yes does this process ensure that the same person who rasied the assessment does not decide on the final validity of the assessment? And Does the guidance make it clear that the taxpayer can ask that his/her objection is settled by going to court or the tax appeal tribunal?<span>*</span><br />
                    <input type="radio" name="validity" value="4" required <?php if($pit_rates=="4"){ echo "checked";}?> >Yes<br />
                    <input type="radio" name="validity" value="1" <?php if($pit_rates=="1"){ echo "checked";}?> >No</i>
                    <br /><br />
                    
                    <label>43. In the last year, how many objections have been referred to the Tax Appeal Tribunal that covers your state in the last year?<span>*</span></label><br />
                    <input type="radio" name="referred" value="1" required <?php if($referred=="1"){ echo "checked";}?> ><i>0 -10 Objections</i><br />
                    <input type="radio" name="referred" value="2" <?php if($referred=="2"){ echo "checked";}?> ><i>10 – 20 Objections</i><br />
                    <input type="radio" name="referred" value="4" required <?php if($referred=="4"){ echo "checked";}?> ><i>20 – 50 Objections</i><br />
                    <input type="radio" name="referred" value="6" <?php if($referred=="6"){ echo "checked";}?> ><i>50+ Objections</i>
                    <br><br>
                    <input type="checkbox" name="completed" value="1" <?php if($completed=="1"){ echo "checked";}?>/><i>Mark This Form Entry As Finalized</i><br>
                    <i>Note: You will not be able to edit this form if you check this box</i>
                    <br /><br />

                    <input  type="reset" value="Reset" />
                    <input  type="submit" value="Update Entry" name="update" />

                </form>
                 <?php	
			
		  }
		  ?>
            </div>

        </div>
    </body>
</html>