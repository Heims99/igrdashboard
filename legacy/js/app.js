$(function() {
    $.ajax({

        url: 'http://www.nggovernorsforum.org/igrdashboard/chart_data.php',
        type: 'GET',
        success: function(data) {
            chartData = data;
            var chartProperties = {
                "caption": "Total Monthly FAAC for States for the year selected",
                "xAxisName": "State",
                "yAxisName": "Amount in Naira",
                "rotatevalues": "1",
                "theme": "zune"
            };

            apiChart = new FusionCharts({
                type: 'column2d',
                renderAt: 'chart-container',
                width: '550',
                height: '350',
                dataFormat: 'json',
                dataSource: {
                    "chart": chartProperties,
                    "data": chartData
                }
            });
            apiChart.render();
        }
    });
});