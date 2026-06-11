<?php include('_header.php') ?>
<div class="mb-4 container shadow_bg py-4">
    <div class="col text-left">
        <p class="green">Welcome to the Nigerian Governors Forum IGR Dashboard</p>
        <p class="small_text">The IGR Dashboard was launched by the Nigeria Governors’ Forum on February 15, 2017, as one of its flagship programmes to support State governments raise domestic revenues.

The platform is designed to assess the tax/revenue environment of States, track the impact of tax reforms, and facilitate the sharing of commendable practices through peer learning and technical assistance.</p>
    </div>
</div>
<div class="mb-4 container shadow_bg py-4">
    <div class="col text-left">
        <p class="green">How it works</p>
        <p>The Dashboard provides real time access to all 36 States’ Internal Revenue Service (SIRS) to regularly maintain and track data on tax administration, tax processing, tax procedures, tax enforcement as well as monthly internally generated revenues.

The NGF Secretariat drives the operation of the programme and supports the implementation and monitoring of recommended actions of the Dashboard, including those agreed at Joint Tax Board (JTB) meetings.

The platform also provides evidence to drive strong political commitment from State Governors in the implementation of needed reforms.</p>
    </div>
</div>
<div class="container shadow_bg">

        <div class="section-title mt-0">
            <h4>Federation Allocation (2018-2021)</h4>
        </div>
        <div class="chart-container">
            <!-- Placeholder for charts -->
            <div id="federation-allocation-chart"></div>
        </div>

        <div class="section-title">
            <h4>IGR of States (2019-2022)</h4>
        </div>
        <div class="chart-container">
            <!-- Placeholder for charts -->
            <div id="igr-states-chart"></div>
        </div>

        <div class="section-title">
            <h4>Other Revenues (2019-2022)</h4>
        </div>
        <div class="chart-container">
            <!-- Placeholder for charts -->
            <div id="other-revenues-chart"></div>
        </div>

        <div class="section-title">
            <h4>Total Revenue of States (2019-2022)</h4>
        </div>
        <div class="chart-container">
            <!-- Placeholder for charts -->
            <div id="total-revenue-states-chart"></div>
        </div>
        
        
    </div>
    
    <div class="container shadow_bg p-0 shadow-none bg-transparent">

        <div class="section-title">
            <h2>The Dashboard Program</h2>
        </div>
        <div class="card-deck m-0">
            <div class="card red">
                <div class="card-body">
                    <h5 class="card-title">Step <b>01</b></h5>
                    <p class="card-text">SIRS Visits the IGR dashboard</p>
                </div>
            </div>
            <div class="card blue">
                <div class="card-body">
                    <h5 class="card-title">Step <b>02</b></h5>
                    <p class="card-text">State reports are developed and presented to Governors, the SIRS, and JTB.</p>
                </div>
            </div>
            <div class="card yellow">
                <div class="card-body">
                    <h5 class="card-title">Step <b>03</b></h5>
                    <p class="card-text">SIRS visits the IGR Dashboard.</p>
                </div>
            </div>
            <div class="card green">
                <div class="card-body">
                    <h5 class="card-title">Step <b>04</b></h5>
                    <p class="card-text">Step reports are developed and presented to Governors, the SIRS, and JTB.</p>
                </div>
            </div>
        </div>

        <div class="section-title">
            <h2>The IGR Dashboard Framework</h2>
        </div>
        <div class="card-deck m-0">
            <div class="card red">
                <div class="card-body">
                    <h5 class="card-title">Step 01</h5>
                    <p class="card-text">Evidence data analysis through the IGR Dashboard (based on authenticated annual statement by state boards of internal revenue).</p>
                    <p class="card-text">Evidence data analysis through the IGR Dashboard (based on authenticated annual statement by state boards of internal revenue).</p>
                    <p class="card-text">Evidence data analysis through the IGR Dashboard (based on authenticated annual statement by state boards of internal revenue).</p>
                </div>
            </div>
            <div class="card blue">
                <div class="card-body">
                    <h5 class="card-title">Step 02</h5>
                    <p class="card-text">Evidence data analysis through the IGR Dashboard (based on authenticated annual statement by state boards of internal revenue).</p>
                    <p class="card-text">Evidence data analysis through the IGR Dashboard (based on authenticated annual statement by state boards of internal revenue).</p>
                    <p class="card-text">Evidence data analysis through the IGR Dashboard (based on authenticated annual statement by state boards of internal revenue).</p>
                </div>
            </div>
            <div class="card yellow">
                <div class="card-body">
                    <h5 class="card-title">Step 03</h5>
                    <p class="card-text">Evidence data analysis through the IGR Dashboard (based on authenticated annual statement by state boards of internal revenue).</p>
                    <p class="card-text">Evidence data analysis through the IGR Dashboard (based on authenticated annual statement by state boards of internal revenue).</p>
                    <p class="card-text">Evidence data analysis through the IGR Dashboard (based on authenticated annual statement by state boards of internal revenue).</p>
                </div>
            </div>
            <div class="card green">
                <div class="card-body">
                    <h5 class="card-title">Step 04</h5>
                    <p class="card-text">Evidence data analysis through the IGR Dashboard (based on authenticated annual statement by state boards of internal revenue).</p>
                    <p class="card-text">Evidence data analysis through the IGR Dashboard (based on authenticated annual statement by state boards of internal revenue).</p>
                    <p class="card-text">Evidence data analysis through the IGR Dashboard (based on authenticated annual statement by state boards of internal revenue).</p>
                </div>
            </div>
        </div>
    </div>

<?php include('_footer.php') ?>

<script>
        $('a[href="Dashboard"]').addClass('active')
        // Sample data for charts
        var options = {
            series: [{
                name: '2018',
                data: [30, 40, 50, 60, 70, 80, 90]
            }, {
                name: '2019',
                data: [35, 45, 55, 65, 75, 85, 95]
            }, {
                name: '2020',
                data: [40, 50, 60, 70, 80, 90, 100]
            }, {
                name: '2021',
                data: [45, 55, 65, 75, 85, 95, 105]
            }],
            chart: {
                type: 'bar',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '30%',
                    endingShape: 'rounded'
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 0,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Abia', 'Adamawa', 'Akwa Ibom', 'Anambra', 'Bauchi', 'Bayelsa', 'Benue']
            },
            yaxis: {
                title: {
                    text: 'N (Billion)'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return "N " + val + " Billion"
                    }
                }
            }
        };

        var chart1 = new ApexCharts(document.querySelector("#federation-allocation-chart"), options);
        var chart2 = new ApexCharts(document.querySelector("#igr-states-chart"), options);
        var chart3 = new ApexCharts(document.querySelector("#other-revenues-chart"), options);
        var chart4 = new ApexCharts(document.querySelector("#total-revenue-states-chart"), options);

        chart1.render();
        chart2.render();
        chart3.render();
        chart4.render();
    </script>