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
<?php include('_header.php') ?>
<script>
function myFunction() {
    window.print();
}
</script>

    <script>
	$(document).ready(function (){
            $("#sbirsmshiptoplusyes").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#sbirs_mship_ext").show();
                }else{
                    $("#sbirs_mship_ext").hide();
                } 
            });
        });
		$(document).ready(function (){
            $("#sbirsmshiptoplusno").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#sbirs_mship_ext").hide();
                }else{
                    $("#sbirs_mship_ext").show();
                } 
            });
        });
	
        $(document).ready(function (){
            $("#tps").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#min_training").show();
                }else{
                    $("#min_training").hide();
                } 
            });
        });
		$(document).ready(function (){
            $("#tps1").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#min_training").show();
                }else{
                    $("#min_training").hide();
                } 
            });
        });
		$(document).ready(function (){
            $("#tpsno").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#min_training").hide();
                }else{
                    $("#min_training").show();
                } 
            });
        });
		
		$(document).ready(function (){
            $("#appyes").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#how_often").show();
                }else{
                    $("#how_often").hide();
                } 
            });
        });
		$(document).ready(function (){
            $("#appno").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#how_often").hide();
                }else{
                    $("#how_often").show();
                } 
            });
        });
		
		$(document).ready(function (){
            $("#ctyes").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#num_contract").show();
                }else{
                    $("#num_contract").hide();
                } 
            });
        });
		$(document).ready(function (){
            $("#ctno").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#num_contract").hide();
                }else{
                    $("#num_contract").show();
                } 
            });
        });
		
		$(document).ready(function (){
            $("#adhocyes").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#num_adhoc").show();
					$("#task").show();
                }else{
                    $("#num_adhoc").hide();
					$("#task").hide();
                } 
            });
        });
		$(document).ready(function (){
            $("#adhocno").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#num_adhoc").hide();
					$("#task").hide();
                }else{
                    $("#num_adhoc").show();
					$("#task").show();
                } 
            });
        });
		
		$(document).ready(function (){
            $("#webyes").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#dom_web").show();
                }else{
                    $("#dom_web").hide();
                } 
            });
        });
		$(document).ready(function (){
            $("#webno").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() != "notinoz") {
                    $("#dom_web").hide();
                }else{
                    $("#dom_web").show();
                } 
            });
        });
    </script>
<div class="container shadow_bg">
    <div class="row mb-4 bg_light_green py-4">
        <div class="col text-center">
            <p class="green"><b>Tax Administration</b></p>
            <!--<p class="small_text">
                These procedures and processes are at the core of any tax administration. Taxpayers need to be enumerated and registered; they need to file returns (with a self-assessment) and they need to pay their taxes either self-assessed or assessed by the SBIRS (best of judgement assessments).
            </p>-->
        </div>
    </div>
    
    <button onclick="window.print()" class="btn btn-outline-primary mb-2 border-dark text-dark mx-auto d-block">Print Page</button>

    <div class="form-container">

        <!--<div class="form-group mt-5 mb-5">
            <label class="archivo" style=" font-size: 24px; ">Date completed: April 16, 2024</label>
        </div>-->
        
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
                $con=mysqli_connect("localhost","nggovern_Garki","NgfBassi1!","nggovern_dashboard");
//---------------------- check connection ------------------------
    if(mysqli_errno($con))
    {echo "Can't Connect to mySQL:".mysqli_connect_error();}
    else
    {echo "</br>";}
				$sql= mysqli_query ($con, "SELECT survey_id,sbirs_meet,mysession,quarter,year,sbirs_policy,sbirs_gov,sbirs_scf,sbirs_sha,sbirs_chair,sbirs_is,sbirs_fund,sbirs_cost,sbirs_emp,core_tax,support_role,tax_staff,capacity_building,attended_training,trainin_program,min_training,sal_structure,pay_scheme,contract_staff,num_contract,num_political,ad_hoc,num_adhoc,task,num_offices,zone_num,full_ict,partial_ict,no_ict,tech_staff,internet,field_report,field_report1,field_report2,field_report3,field_report4,report_method,standardrpt_format,completed,sbirs_mship_top,sbirs_mship_toplus,ext_rep,ext_govt,ext_other,nature_por,nature_por1,nature_por2,nature_por3,nature_por4,cap_cost_cov,perform_app,how_often,alter_target,function_website,tax_guide,tax_ret_form,tax_calc,tax_reg_pack,field_off_add,contact_help FROM survey, users WHERE mysession='$userRow[username]'");
			
			//$result=mysql_query($sql,$db) or die(mysql_error());
			while($row=mysqli_fetch_array($sql)) {
				$surveyid=$row['survey_id'];
				$quarter=$row['quarter'];
				$year=$row['year'];
				$sbirs_meet=$row['sbirs_meet'];
				$sbirs_policy=$row['sbirs_policy'];
				$sbirs_gov=$row['sbirs_gov'];
				$sbirs_scf=$row['sbirs_scf'];
				$sbirs_sha=$row['sbirs_sha'];
				$sbirs_chair=$row['sbirs_chair'];
				$sbirs_is=$row['sbirs_is'];
				$sbirs_fund=$row['sbirs_fund'];
				$sbirs_cost=$row['sbirs_cost'];
				$sbirs_emp=$row['sbirs_emp'];
				$core_tax=$row['core_tax'];
				$support_role=$row['support_role'];
				$tax_staff=$row['tax_staff'];
				$capacity_building=$row['capacity_building'];
				$attended_training=$row['attended_training'];
				$trainin_program=$row['trainin_program'];
				$min_training=$row['min_training'];
				$sal_structure=$row['sal_structure'];
				$pay_scheme=$row['pay_scheme'];
				$contract_staff=$row['contract_staff'];
				$num_contract=$row['num_contract'];
				$num_political=$row['num_political'];
				$ad_hoc=$row['ad_hoc'];
				$num_adhoc=$row['num_adhoc'];
				$task=$row['task'];
				$num_offices=$row['num_offices'];
				$zone_num=$row['zone_num'];
				$full_ict=$row['full_ict'];
				$partial_ict=$row['partial_ict'];
				$no_ict=$row['no_ict'];
				$tech_staff=$row['tech_staff'];
				$internet=$row['internet'];
				$field_report=$row['field_report'];
				$field_report1=$row['field_report1'];
				$field_report2=$row['field_report2'];
				$field_report3=$row['field_report3'];
				$field_report4=$row['field_report4'];
				$report_method=$row['report_method'];
				$standardrpt_format=$row['standardrpt_format'];
				$completed=$row['completed'];
				$sbirs_mship_top=$row['sbirs_mship_top'];
				$sbirs_mship_toplus=$row['sbirs_mship_toplus'];
				$ext_rep=$row['ext_rep'];
				$ext_govt=$row['ext_govt'];
				$ext_other=$row['ext_other'];
				$nature_por=$row['nature_por'];
				$nature_por1=$row['nature_por1'];
				$nature_por2=$row['nature_por2'];
				$nature_por3=$row['nature_por3'];
				$nature_por4=$row['nature_por4'];
				$cap_cost_cov=$row['cap_cost_cov'];
				$perform_app=$row['perform_app'];
				$how_often=$row['how_often'];
				$alter_target=$row['alter_target'];
				$function_website=$row['function_website'];
				$tax_guide=$row['tax_guide'];
				$tax_ret_form=$row['tax_ret_form'];
				$tax_calc=$row['tax_calc'];
				$tax_reg_pack=$row['tax_reg_pack'];
				$field_off_add=$row['field_off_add'];
				$contact_help=$row['contact_help'];
			}
		?>
        
        <form action="page1_insertdata.php" method="post" novalidate>
            <div class="question">
                
                <input name="mysession" type="text" value="<?php echo $userRow['username']; ?>" hidden="true"  >
				
                
                    <select name="quarter" hidden="true">
                        
                        <option value="All Quarter" value="">All Quarter (Jan to Dec) </options>
                        
                    </select>
                    <div class="question-title archivo"><b class="archivo"></b>Which year are you filling for?<span> *</span></div>
                    <div><select name="year">
                        <!--<option value="2019" value="">2019 </options>-->
                        <option value="2025" selected="2025" value="">2025 </option>
                    </select></div>
                <div class="question-title archivo"></div>
                <div class="question-title archivo"><b class="archivo">Organisational and Institutional Arrangements</b></div>
                <div class="question-title archivo"><b class="archivo">1:</b> What is the composition of the Board of the SIRS?</div>
                <div class="question-title archivo"><i>Top management of the SIRS only?</i><span> *</span></div>
                <div class="error-message d-none">Error Message</div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sbirs_mship_top" value="Yes" <?php if($sbirs_mship_top=="Yes"){ echo "checked";}?> >
                    <i><em> Yes</em></i>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sbirs_mship_top" value="No" <?php if($sbirs_mship_top=="No"){ echo "checked";}?> >
                    <i> No</i>
                </div>
            </div>

            <div class="question">
                <div class="question-title archivo"><i>Top management of SIRS plus non-SIRS members?</i><span> *</span></div>
                <div class="error-message d-none">Error Message</div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sbirs_mship_toplus" id="sbirsmshiptoplusyes" value="yes" <?php if($sbirs_mship_toplus=="yes"){ echo "checked";}?> >
                    <i>Yes</i>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sbirs_mship_toplus" id="sbirsmshiptoplusno" value="no" <?php if($sbirs_mship_toplus=="no"){ echo "checked";}?> >
                    <i>No</i>
                </div>
            </div>

            <div class="question" id="sbirs_mship_ext" style="display:none;">
                <div class="question-title archivo"><i>If Yes, who are the external members?</i></div>
                <div class="error-message d-none">Error Message</div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="ext_rep" value="Reps of MDAs" <?php if($ext_rep=="Reps of MDAs"){ echo "checked";}?> >
                    <i>Reps of MDAs</i>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="ext_govt" value="Non governmental" <?php if($ext_govt=="Non governmental"){ echo "checked";}?>>
                    <i>Non governmental</i>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="ext_other" value="Others" <?php if($ext_other=="Others"){ echo "checked";}?>>
                    <i>Others</i>
                </div>
            </div>

            <div class="question">
                <div class="question-title archivo"><b class="archivo">Question 4:</b> For Fiscal year 2021, what was your total GhG Carbon Emission for all scopes?</div>
                <div class="error-message d-none">Error Message</div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question4" id="q4-option1" value="Scope 1">
                    <label class="form-check-label" for="q4-option1">Scope 1 - Determine environmental impact levels.</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question4" id="q4-option2" value="Scope 2">
                    <label class="form-check-label" for="q4-option2">Scope 2 - Reduce carbon footprints.</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question4" id="q4-option3" value="Scope 3">
                    <label class="form-check-label" for="q4-option3">Scope 3 - Enhance environmental impacts on a larger scale.</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question4" id="q4-option4" value="Unknown">
                    <label class="form-check-label" for="q4-option4">I do not know the answer to this question.</label>
                </div>
            </div>

            <div class="question">
                <div class="question-title archivo"><b class="archivo">Question 5:</b> For Fiscal year 2021, what was your total GhG Carbon Emission for all scopes?</div>
                <div class="error-message d-none">Error Message</div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question5" id="q5-option1" value="Scope 1">
                    <label class="form-check-label" for="q5-option1">Scope 1 - Determine environmental impact levels.</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question5" id="q5-option2" value="Scope 2">
                    <label class="form-check-label" for="q5-option2">Scope 2 - Reduce carbon footprints.</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question5" id="q5-option3" value="Scope 3">
                    <label class="form-check-label" for="q5-option3">Scope 3 - Enhance environmental impacts on a larger scale.</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question5" id="q5-option5" value="Unknown">
                    <label class="form-check-label" for="q5-option5">I do not know the answer to this question.</label>
                </div>
            </div>

            <div class="question">
                <div class="question-title archivo"><b class="archivo">Question 6:</b> For Fiscal year 2021, what was your total GhG Carbon Emission for all scopes?</div>
                <div class="error-message d-none">Error Message</div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question6" id="q6-option1" value="Scope 1">
                    <label class="form-check-label" for="q6-option1">Scope 1 - Determine environmental impact levels.</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question6" id="q6-option2" value="Scope 2">
                    <label class="form-check-label" for="q6-option2">Scope 2 - Reduce carbon footprints.</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question6" id="q6-option3" value="Scope 3">
                    <label class="form-check-label" for="q6-option3">Scope 3 - Enhance environmental impacts on a larger scale.</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question6" id="q6-option6" value="Unknown">
                    <label class="form-check-label" for="q6-option6">I do not know the answer to this question.</label>
                </div>
            </div>

            <div class="form-group text-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="finalized">
                    <label class="form-check-label" for="finalized">Mark This Form Entry As Finalized</label>
                </div>
            </div>
            <div class="form-group text-center mt-4">
                <button type="reset" class="btn btn-outline-secondary mr-1">Reset</button>
                <button type="submit" class="btn btn-success ml-1">Submit</button>
            </div>
        </form>
    </div>
</div>
<?php include('_footer.php') ?>

<script>
    $('a[href="TaxAdministration"]').addClass('active')
</script>