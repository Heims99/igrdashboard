<?php
session_start();
include_once '../connection.php';
if(!isset($_SESSION['user']))
{
 header("Location: index.php");
}
$connection = mysqli_connect("localhost", "nggovern_Garki", "NgfBassi1!");
$db = mysqli_select_db($connection, "nggovern_dashboard");
$res=mysqli_query($connection, "SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res, $db);
?><?php include('_header.php') ?>
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
            <div id=""><iframe width="1237" height="291.5" seamless frameborder="0" scrolling="no" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vSMzpRzxvBm1EQYR_cUBKrBnenRmb3sOH4dZjhaAnDWK1o4w7_vc2e7Tc45V_J_QmZw4GY6FkOIq3Zt/pubchart?oid=231624236&amp;format=interactive"></iframe></div>
        </div>

        <div class="section-title">
            <h4>IGR of States (2018-2021)</h4>
        </div>
        <div class="chart-container">
            <!-- Placeholder for charts -->
            <div id=""><iframe width="1237" height="292" seamless frameborder="0" scrolling="no" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vSMzpRzxvBm1EQYR_cUBKrBnenRmb3sOH4dZjhaAnDWK1o4w7_vc2e7Tc45V_J_QmZw4GY6FkOIq3Zt/pubchart?oid=513088522&amp;format=interactive"></iframe></div>
        </div>

        <div class="section-title">
            <h4>Other Revenues (2018-2021)</h4>
        </div>
        <div class="chart-container">
            <!-- Placeholder for charts -->
            <div id=""><iframe width="1237" height="292" seamless frameborder="0" scrolling="no" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vTWySUaWmQGWzbiXtcx75WvXUaeMMNJTvIhW2uaXcw0_---VZQlu2MaKXFjWa2xXQBWTCd_7wWjwOtj/pubchart?oid=1953004448&format=interactive"></iframe></div>
        </div>

        <div class="section-title">
            <h4>Total Revenue of States (2018-2021)</h4>
        </div>
        <div class="chart-container">
            <!-- Placeholder for charts -->
            <div id=""><iframe width="1237" height="291.5" seamless frameborder="0" scrolling="no" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vTWySUaWmQGWzbiXtcx75WvXUaeMMNJTvIhW2uaXcw0_---VZQlu2MaKXFjWa2xXQBWTCd_7wWjwOtj/pubchart?oid=1335958749&amp;format=interactive"></iframe></div>
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
                    <h5 class="card-title">Advocacy Tools/Instrument</h5>
                    <p class="card-text">Evidence data/research/analysis through the IGR Dashboard (based on authenticated annual statement by state boards of internal revenue).</p>
                    <p class="card-text">Decision-maker engagement (monthly engagement with the 36 state governors at NGF meetings).</p>
                    <p class="card-text">Capacity building for state tax officials (via workshops, peer learning events and state visits).</p>
                </div>
            </div>
            <div class="card blue">
                <div class="card-body">
                    <h5 class="card-title">Key Decision-Makers & Influencers</h5>
                    <p class="card-text">Key decision makers<br><br> - 36 state governors</p>
                    <p class="card-text">Influencers/Partnerships<br><br> - Joint tax board (JTB)<br><br> - 36 state boards of internal revenue<br><br> - Development Partners</p>
                </div>
            </div>
            <div class="card yellow">
                <div class="card-body">
                    <h5 class="card-title">Intermediate Outcomes</h5>
                    <p class="card-text">Increased use of evidence and policy analysis by governors, JTB & SBIR.</p>
                    <p class="card-text">Agenda setting and prioritisation of tax/revenue issues (via monthly briefings to governors and quarterly meetings with the JTB.</p>
                    <p class="card-text">Increased capacity of state governments to address domenstic revenue challenges.</p>
                </div>
            </div>
            <div class="card green">
                <div class="card-body">
                    <h5 class="card-title">Primary Outcomes</h5>
                    <p class="card-text">Increased internally generated revenue and improved tax environment across the 36 states.</p>
                    <!--<p class="card-text"></p>
                    <p class="card-text"></p>-->
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
<p>&nbsp;</p>
<hr width="100%" />
<table width="100%"><tr><td><table width="100%" border="0">
<tr>
    <td align="center" style="font-family: Tahoma, Geneva, sans-serif; font-size: 11px; text-decoration: none; margin: 1px; padding: 12px;"><a href="faq.php">FAQ</a> | <a href="help.php">Help</a> | <a href="IGR Dashboard How-to-Guide.pdf" target="new">User Guide</a> | <a href="contactform.php" target="new">Contact Us</a></td>
  </tr>
  <tr>
    <td align="center" style="font-size: 11px; color: #093; text-align: center;">&copy;2016 - 2017 Nigeria Governors' Forum </td>
  </tr>
</table></td></tr></table>
<p>&nbsp;</p>