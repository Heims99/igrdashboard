<?php include('_header.php') ?>
<div class="container shadow_bg">
    <h4>Group Explorer</h4>
    <form class="form-inline mt-5 d-flex justify-content-between">
        <div class="d-flex">
            <div class="form-group mb-2">
                <label for="category" class="sr-only">Category</label>
                <select id="category" class="form-control">
                    <option>Select Category</option>
                    <option>Category 1</option>
                    <option>Category 2</option>
                </select>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="zone" class="sr-only">Zone</label>
                <select id="zone" class="form-control">
                    <option>Select Zone</option>
                    <option>Zone 1</option>
                    <option>Zone 2</option>
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

    <div class="d-flex table_list">

        <div class="table-wrapper">
            <div class="header-info justify-content-center">
                <span class="table_name text-danger">Task Procedure (Year 2022)</span>
            </div>
            <div class="overflow-x">
                <table class="table table-bordered red">
                    <thead>
                        <tr>
                            <th scope="col">Rank/36</th>
                            <th scope="col">State</th>
                            <th scope="col">Score%</th>
                            <th scope="col">
                                <>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="task-name">1</td>
                            <td>Ondo</td>
                            <td>52.74</td>
                            <td>52.74</td>
                        </tr>
                        <tr>
                            <td class="task-name">3</td>
                            <td>Edo</td>
                            <td>52.74</td>
                            <td>52.74</td>
                        </tr>
                        <tr>
                            <td class="task-name">4</td>
                            <td>Akwa Ibom</td>
                            <td>52.74</td>
                            <td>52.74</td>
                        </tr>
                        <tr>
                            <td class="task-name">12</td>
                            <td>Lagos</td>
                            <td>52.74</td>
                            <td>52.74</td>
                        </tr>
                        <tr>
                            <td class="task-name">10</td>
                            <td>Abuja</td>
                            <td>52.74</td>
                            <td>52.74</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="table-wrapper">
            <div class="header-info justify-content-center">
                <span class="table_name">Task Administration (Year 2022)</span>
            </div>
            <div class="overflow-x">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Rank/36</th>
                            <th scope="col">State</th>
                            <th scope="col">Score%</th>
                            <th scope="col">
                                <>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="task-name">1</td>
                            <td>Ondo</td>
                            <td>52.74</td>
                            <td>52.74</td>
                        </tr>
                        <tr>
                            <td class="task-name">3</td>
                            <td>Edo</td>
                            <td>52.74</td>
                            <td>52.74</td>
                        </tr>
                        <tr>
                            <td class="task-name">4</td>
                            <td>Akwa Ibom</td>
                            <td>52.74</td>
                            <td>52.74</td>
                        </tr>
                        <tr>
                            <td class="task-name">12</td>
                            <td>Lagos</td>
                            <td>52.74</td>
                            <td>52.74</td>
                        </tr>
                        <tr>
                            <td class="task-name">10</td>
                            <td>Abuja</td>
                            <td>52.74</td>
                            <td>52.74</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="table-wrapper">
            <div class="header-info justify-content-center">
                <span class="table_name text-warning">Task Processing (Year 2022)</span>
            </div>
            <div class="overflow-x">
                <table class="table table-bordered yellow">
                    <thead>
                        <tr>
                            <th scope="col">Rank/36</th>
                            <th scope="col">State</th>
                            <th scope="col">Score%</th>
                            <th scope="col">
                                <>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="task-name">1</td>
                            <td>Ondo</td>
                            <td>52.74</td>
                            <td>52.74</td>
                        </tr>
                        <tr>
                            <td class="task-name">3</td>
                            <td>Edo</td>
                            <td>52.74</td>
                            <td>52.74</td>
                        </tr>
                        <tr>
                            <td class="task-name">4</td>
                            <td>Akwa Ibom</td>
                            <td>52.74</td>
                            <td>52.74</td>
                        </tr>
                        <tr>
                            <td class="task-name">12</td>
                            <td>Lagos</td>
                            <td>52.74</td>
                            <td>52.74</td>
                        </tr>
                        <tr>
                            <td class="task-name">10</td>
                            <td>Abuja</td>
                            <td>52.74</td>
                            <td>52.74</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="table-wrapper">
            <div class="header-info justify-content-center">
                <span class="table_name">Task Enforcement (Year 2022)</span>
            </div>
            <div class="overflow-x">
                <table class="table table-bordered blue">
                    <thead>
                        <tr>
                            <th scope="col">Rank/36</th>
                            <th scope="col">State</th>
                            <th scope="col">Score%</th>
                            <th scope="col">
                                <>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="task-name">1</td>
                            <td>Ondo</td>
                            <td>52.74</td>
                            <td>52.74</td>
                        </tr>
                        <tr>
                            <td class="task-name">3</td>
                            <td>Edo</td>
                            <td>52.74</td>
                            <td>52.74</td>
                        </tr>
                        <tr>
                            <td class="task-name">4</td>
                            <td>Akwa Ibom</td>
                            <td>52.74</td>
                            <td>52.74</td>
                        </tr>
                        <tr>
                            <td class="task-name">12</td>
                            <td>Lagos</td>
                            <td>52.74</td>
                            <td>52.74</td>
                        </tr>
                        <tr>
                            <td class="task-name">10</td>
                            <td>Abuja</td>
                            <td>52.74</td>
                            <td>52.74</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="table-wrapper">
            <div class="header-info justify-content-center">
                <span class="table_name green">Overall Assesment (Year 2022)</span>
            </div>
            <div class="overflow-x">
                <table class="table table-bordered green">
                    <thead>
                        <tr>
                            <th scope="col">Rank/36</th>
                            <th scope="col">State</th>
                            <th scope="col">Score%</th>
                            <th scope="col">
                                <>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="task-name">1</td>
                            <td>Ondo</td>
                            <td>52.74</td>
                            <td>52.74</td>
                        </tr>
                        <tr>
                            <td class="task-name">3</td>
                            <td>Edo</td>
                            <td>52.74</td>
                            <td>52.74</td>
                        </tr>
                        <tr>
                            <td class="task-name">4</td>
                            <td>Akwa Ibom</td>
                            <td>52.74</td>
                            <td>52.74</td>
                        </tr>
                        <tr>
                            <td class="task-name">12</td>
                            <td>Lagos</td>
                            <td>52.74</td>
                            <td>52.74</td>
                        </tr>
                        <tr>
                            <td class="task-name">10</td>
                            <td>Abuja</td>
                            <td>52.74</td>
                            <td>52.74</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<div class="container container p-0">
    <div class="d-flex table_list">
        <div class="chart_item_group shadow_bg">
            <div class="chart-wrapper">
                <div class="chart-title">Tax Processing</div>
                <div class="chart-subtitle">Governance Rating</div>
                <div id="chart1"></div>
            </div>
        </div>
        <div class="chart_item_group shadow_bg">
            <div class="chart-wrapper">
                <div class="chart-title">Tax Processing</div>
                <div class="chart-subtitle">Governance Rating</div>
                <div id="chart2"></div>
            </div>
        </div>
    </div>
    <div class="d-flex table_list">
        <div class="chart_item_group shadow_bg">
            <div class="chart-wrapper">
                <div class="chart-title">Tax Processing</div>
                <div class="chart-subtitle">Governance Rating</div>
                <div id="chart3"></div>
            </div>
        </div>
        <div class="chart_item_group shadow_bg">
            <div class="chart-wrapper">
                <div class="chart-title">Tax Processing</div>
                <div class="chart-subtitle">Governance Rating</div>
                <div id="chart4"></div>
            </div>
        </div>
    </div>
</div>

<?php include('_footer.php') ?>

<style>
    .container {
        max-width: calc(100% - 60px);
    }

    table thead {
        border-top: 1px solid #dee2e6;
        border-bottom: 1px solid #dee2e6
    }
</style>

<script>
    $('a[href="GroupExplorer"]').addClass('active')

    document.addEventListener("DOMContentLoaded", function() {
        const chartOptions = {
            chart: {
                type: 'bar',
                height: 300,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: true
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return val + "%";
                }
            },
            series: [{
                data: [{
                        x: 'Adamawa',
                        y: 80
                    },
                    {
                        x: 'Bauchi',
                        y: 80
                    },
                    {
                        x: 'Bauchi',
                        y: 80
                    },
                    {
                        x: 'Yobe',
                        y: 70
                    }
                ]
            }],
            xaxis: {
                categories: ['Adamawa', 'Bauchi', 'Bauchi', 'Yobe'],
                title: {
                    text: 'Rating%'
                }
            },
            yaxis: {
                title: {
                    text: 'State'
                }
            },
            colors: ['#28a745', '#d1f2eb', '#a3e4d7', '#76d7c4'],
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + "%";
                    }
                }
            }
        };

        const chart1 = new ApexCharts(document.querySelector("#chart1"), chartOptions);
        const chart2 = new ApexCharts(document.querySelector("#chart2"), chartOptions);
        const chart3 = new ApexCharts(document.querySelector("#chart3"), chartOptions);
        const chart4 = new ApexCharts(document.querySelector("#chart4"), chartOptions);

        chart1.render();
        chart2.render();
        chart3.render();
        chart4.render();
    })
</script>