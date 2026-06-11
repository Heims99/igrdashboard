<?php include('_header.php') ?>
<div class="container shadow_bg">
    <h4>State Explorer</h4>
    <form class="form-inline mt-5 d-flex justify-content-between">
        <div class="d-flex">
            <div class="form-group mx-sm-3 mb-2">
                <label for="zone" class="sr-only">Zone</label>
                <select id="zone" class="form-control">
                    <option>Select State</option>
                    <option value="Abia">Abia</option>
                    <option value="Adamawa">Adamawa</option>
                    <option value="Akwa Ibom">Akwa Ibom</option>
                    <option value="Anambra">Anambra</option>
                    <option value="Bauchi">Bauchi</option>
                    <option value="Bayelsa">Bayelsa</option>
                    <option value="Benue">Benue</option>
                    <option value="Borno">Borno</option>
                    <option value="Cross River">Cross River</option>
                    <option value="Delta">Delta</option>
                    <option value="Ebonyi">Ebonyi</option>
                    <option value="Edo">Edo</option>
                    <option value="Ekiti">Ekiti</option>
                    <option value="Enugu">Enugu</option>
                    <option value="FCT">Federal Capital Territory</option>
                    <option value="Gombe">Gombe</option>
                    <option value="Imo">Imo</option>
                    <option value="Jigawa">Jigawa</option>
                    <option value="Kaduna">Kaduna</option>
                    <option value="Kano">Kano</option>
                    <option value="Katsina">Katsina</option>
                    <option value="Kebbi">Kebbi</option>
                    <option value="Kogi">Kogi</option>
                    <option value="Kwara">Kwara</option>
                    <option value="Lagos">Lagos</option>
                    <option value="Nasarawa">Nasarawa</option>
                    <option value="Niger">Niger</option>
                    <option value="Ogun">Ogun</option>
                    <option value="Ondo">Ondo</option>
                    <option value="Osun">Osun</option>
                    <option value="Oyo">Oyo</option>
                    <option value="Plateau">Plateau</option>
                    <option value="Rivers">Rivers</option>
                    <option value="Sokoto">Sokoto</option>
                    <option value="Taraba">Taraba</option>
                    <option value="Yobe">Yobe</option>
                    <option value="Zamfara">Zamfara</option>
                </select>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="year" class="sr-only">Year</label>
                <select id="year" class="form-control">
                    <option>Select Year</option>
                    <option>2021</option>
                    <option>2020</option>
                </select>
            </div>
        </div>
        <div class="d-flex">
            <button type="submit" class="btn btn-success mb-2">Display</button>
            <button onclick="window.print()" type="button" class="btn btn-outline-primary mb-2 border-dark text-dark">Print Page</button>
        </div>
    </form>

    <button type="submit" class="btn btn-danger my-3 mx-auto d-block">
        <> Change Since Previous Year
    </button>

    <div class="table-wrapper mt-5">
        <!-- <div class="header-info justify-content-center">
            <span class="table_name text-danger">Task Procedure (Year 2022)</span>
        </div> -->
        <div class="overflow-x">
            <table class="table table-bordered red">
                <thead>
                    <tr>
                        <th scope="col">
                            <span class="text-danger">Task Procedure</span>
                        </th>
                        <th scope="col" class="fixed_small">
                            <span class="text-danger">49.22</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="task-name">Tax registration using Unified Tax Identification Number (TIN)</td>
                        <td>49.22</td>
                    </tr>
                    <tr>
                        <td class="task-name">Efficiency of Tax Collection Method (BoJ by Tax Officers v Self- assessment)</td>
                        <td>49.22</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="table-wrapper mt-5">
        <!-- <div class="header-info justify-content-center">
            <span class="table_name text-danger">Task Procedure (Year 2022)</span>
        </div> -->
        <div class="overflow-x">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">
                            <span class="text-dark">Tax Administration</span>
                        </th>
                        <th scope="col" class="fixed_small">
                            <span class="text-dark">49.22</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="task-name">Organisational and Institutional Arrangements</td>
                        <td>49.22</td>
                    </tr>
                    <tr>
                        <td class="task-name">Availability and Sufficiency of IRS Budget</td>
                        <td>49.22</td>
                    </tr>
                    <tr>
                        <td class="task-name">Salary Incentives, IRS Staff Skills and Training Levels</td>
                        <td>49.22</td>
                    </tr>
                    <tr>
                        <td class="task-name">SBIRS Outreach in Districts (No of Tax Offices)</td>
                        <td>49.22</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="table-wrapper mt-5">
        <!-- <div class="header-info justify-content-center">
            <span class="table_name text-danger">Task Procedure (Year 2022)</span>
        </div> -->
        <div class="overflow-x">
            <table class="table table-bordered yellow">
                <thead>
                    <tr>
                        <th scope="col">
                            <span class="text-warning">Tax Processing (Manual v Automated)</span>
                        </th>
                        <th scope="col" class="fixed_small">
                            <span class="text-warning">49.22</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="task-name">Tax payment (cash paid to tax officers versus Bank and electronic payment)</td>
                        <td>49.22</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="table-wrapper mt-5">
        <!-- <div class="header-info justify-content-center">
            <span class="table_name text-danger">Task Procedure (Year 2022)</span>
        </div> -->
        <div class="overflow-x">
            <table class="table table-bordered blue">
                <thead>
                    <tr>
                        <th scope="col">
                            <span class="text-dark">Tax Enforcement</span>
                        </th>
                        <th scope="col" class="fixed_small">
                            <span class="text-dark">49.22</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="task-name">Capacity for Taxpayer Audits</td>
                        <td>49.22</td>
                    </tr>
                    <tr>
                        <td class="task-name">Tax Awareness</td>
                        <td>49.22</td>
                    </tr>
                    <tr>
                        <td class="task-name">Complaints</td>
                        <td>49.22</td>
                    </tr>
                    <tr>
                        <td class="task-name">Double Taxation</td>
                        <td>49.22</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php include('_footer.php') ?>

<style>
    .table th, .table td{
        border: 0;
    }
</style>

<script>
    $('a[href="StateExplorer"]').addClass('active')
</script>