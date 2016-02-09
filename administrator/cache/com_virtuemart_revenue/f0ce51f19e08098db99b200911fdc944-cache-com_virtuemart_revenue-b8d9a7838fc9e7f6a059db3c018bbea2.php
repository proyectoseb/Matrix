<?php die("Access Denied"); ?>#x#a:2:{s:6:"output";s:0:"";s:6:"result";a:2:{s:6:"report";a:0:{}s:2:"js";s:1422:"
  google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Day', 'Orders', 'Total Items sold', 'Revenue net'], ['2015-08-25', 0,0,0], ['2015-08-26', 0,0,0], ['2015-08-27', 0,0,0], ['2015-08-28', 0,0,0], ['2015-08-29', 0,0,0], ['2015-08-30', 0,0,0], ['2015-08-31', 0,0,0], ['2015-09-01', 0,0,0], ['2015-09-02', 0,0,0], ['2015-09-03', 0,0,0], ['2015-09-04', 0,0,0], ['2015-09-05', 0,0,0], ['2015-09-06', 0,0,0], ['2015-09-07', 0,0,0], ['2015-09-08', 0,0,0], ['2015-09-09', 0,0,0], ['2015-09-10', 0,0,0], ['2015-09-11', 0,0,0], ['2015-09-12', 0,0,0], ['2015-09-13', 0,0,0], ['2015-09-14', 0,0,0], ['2015-09-15', 0,0,0], ['2015-09-16', 0,0,0], ['2015-09-17', 0,0,0], ['2015-09-18', 0,0,0], ['2015-09-19', 0,0,0], ['2015-09-20', 0,0,0], ['2015-09-21', 0,0,0], ['2015-09-22', 0,0,0]  ]);
        var options = {
          title: 'Report for the period from Tuesday, 25 August 2015 to Wednesday, 23 September 2015',
            series: {0: {targetAxisIndex:0},
                   1:{targetAxisIndex:0},
                   2:{targetAxisIndex:1},
                  },
                  colors: ["#00A1DF", "#A4CA37","#E66A0A"],
        };

        var chart = new google.visualization.LineChart(document.getElementById('vm_stats_chart'));

        chart.draw(data, options);
      }
";}}