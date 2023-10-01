<!DOCTYPE html>
<html>
<head>
  <title>School Wise Infra work</title>
  <!-- Include Highcharts library -->
  <script src="https://code.highcharts.com/highcharts.js"></script>
</head>
<body>
  <div id="stackedColumnChart" style="width: 600px; height: 600;"></div>
  <script>
    // Sample data for the chart
    var data = {
      categories: ["School 1", "School 2", "School 3" , "Schol 4", "Schol 5", "Schol 6", "Schol 7"],
      series: [{
        name: 'Electric',
         color: '#ebb734', 
        data: [25, 0, 50, 100,75, 100, 100]
      }, {
        name: 'Painting',
         color: '#ebb734', 
        data: [100, 25, 50, 75,100, 100, 100]
      }, {
        name: 'Wood work',
         color: '#ebb734', 
        data: [100, 100, 100, 100,100, 100, 100]
      }
      , {
        name: 'Flooring',
         color: '#ebb734', 
        data: [100, 100, 100, 100,100, 100, 100]
      }]
    };

    // Create the stacked column chart
    Highcharts.chart('stackedColumnChart', {
      chart: {
        type: 'column'
      },
      title: {
        text: 'School Wise Infra work'
      },
      xAxis: {
        categories: data.categories
      },
      yAxis: {
        title: {
          text: 'Percentage'
        }
      },
      plotOptions: {
        column: {
          stacking: 'overlap', // Merge all columns into a stacked column
      borderWidth: 0
        }
      },
      tooltip: {
        shared: true, // Show shared tooltip for all points on the same x-value
        formatter: function () {
          var tooltipContent = '<b>' + this.x + '</b><br>';
          var totalValue = 0;

          // Loop through each point to display the data in the tooltip
          this.points.forEach(function (point) {
           tooltipContent += point.series.name + ': ' + point.y + '%<br>';
            totalValue += point.y;
          });

          tooltipContent += '' ;
          return tooltipContent;
        }
      },
      series: data.series
    });
  </script>
</body>
</html>  
