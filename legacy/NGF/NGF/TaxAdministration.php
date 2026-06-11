<?php include('_header.php') ?>

<div class="container shadow_bg">
    <div class="row mb-4 bg_light_green py-4">
        <div class="col text-center">
            <p class="green"><b>Tax Administration</b></p>
            <p class="small_text">
                These procedures and processes are at the core of any tax administration. Taxpayers need to be enumerated and registered; they need to file returns (with a self-assessment) and they need to pay their taxes either self-assessed or assessed by the SBIRS (best of judgement assessments).
            </p>
        </div>
    </div>
    
    <button onclick="window.print()" class="btn btn-outline-primary mb-2 border-dark text-dark mx-auto d-block">Print Page</button>

    <div class="form-container">

        <div class="form-group mt-5 mb-5">
            <label class="archivo" style=" font-size: 24px; ">Date completed: April 16, 2024</label>
        </div>
        <form id="questionnaire-form">
            <div class="question">
                <div class="question-title archivo"><b class="archivo">Question 1:</b> For Fiscal year 2021, what was your total GhG Carbon Emission for all scopes?</div>
                <div class="error-message d-none">Error Message</div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question1" id="q1-option1" value="Scope 1">
                    <label class="form-check-label" for="q1-option1">Scope 1 - Determine environmental impact levels.</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question1" id="q1-option2" value="Scope 2">
                    <label class="form-check-label" for="q1-option2">Scope 2 - Reduce carbon footprints.</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question1" id="q1-option3" value="Scope 3">
                    <label class="form-check-label" for="q1-option3">Scope 3 - Enhance environmental impacts on a larger scale.</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question1" id="q1-option4" value="Unknown">
                    <label class="form-check-label" for="q1-option4">I do not know the answer to this question.</label>
                </div>
            </div>

            <div class="question">
                <div class="question-title archivo"><b class="archivo">Question 2:</b> For Fiscal year 2021, what was your total GhG Carbon Emission for all scopes?</div>
                <div class="error-message">Error Message</div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question2" id="q2-option1" value="Scope 1">
                    <label class="form-check-label" for="q2-option1">Scope 1 - Determine environmental impact levels.</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question2" id="q2-option2" value="Scope 2">
                    <label class="form-check-label" for="q2-option2">Scope 2 - Reduce carbon footprints.</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question2" id="q2-option3" value="Scope 3">
                    <label class="form-check-label" for="q2-option3">Scope 3 - Enhance environmental impacts on a larger scale.</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question2" id="q2-option4" value="Unknown">
                    <label class="form-check-label" for="q2-option4">I do not know the answer to this question.</label>
                </div>
            </div>

            <div class="question">
                <div class="question-title archivo"><b class="archivo">Question 3:</b> For Fiscal year 2021, what was your total GhG Carbon Emission for all scopes?</div>
                <div class="error-message d-none">Error Message</div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question3" id="q3-option1" value="Scope 1">
                    <label class="form-check-label" for="q3-option1">Scope 1 - Determine environmental impact levels.</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question3" id="q3-option2" value="Scope 2">
                    <label class="form-check-label" for="q3-option2">Scope 2 - Reduce carbon footprints.</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question3" id="q3-option3" value="Scope 3">
                    <label class="form-check-label" for="q3-option3">Scope 3 - Enhance environmental impacts on a larger scale.</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question3" id="q3-option4" value="Unknown">
                    <label class="form-check-label" for="q3-option4">I do not know the answer to this question.</label>
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