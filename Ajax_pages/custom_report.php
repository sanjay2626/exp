<?php
  require '../connection.php';

  if(!empty($_POST)){
    $title_string = ""; // Will be used in chart title
    $where = "where session_date>='{$_POST['where']['from_date']}' and session_date<='{$_POST['where']['to_date']}' ";
    foreach ($_POST['where'] as $key => $value) {
      if(!in_array($key,["x_axis","from_date","to_date","session_type"])){
            $where.=" and {$key}={$value}";
        }else if($key=="x_axis" and $key!="session_type"){
          $group_by = "GROUP BY {$value}";
        }else if ($key=="session_type") {
          $where.=" and {$key} like '%{$value}%'";
        }
      }// end forach
      foreach ($_POST['title'] as $key => $value) {
        if(!in_array($key,["Compare Among","From (M-D-Y)","To (M-D-Y)"])){
              $title_string.="{$key}: {$value}, ";
          }
      }
      $title_string = trim($title_string,", ");
      if($_POST['where']['x_axis']!="session_type"){
        $query = "SELECT COUNT(*) as sessions,{$_POST['where']['x_axis']} from session_completed {$where} {$group_by}";
      }
      else{ // because session_type couldnt be grouped directly as it is comma separated list
        $query = "SELECT ";
        foreach ($_POST['name_array'] as $key => $value) {
          $query.=" SUM(CASE WHEN session_type like '%{$key}%' THEN 1 ELSE 0 END) as '{$key}',";
        }
        $query = trim($query,",");
        $query.=" FROM session_completed {$where}";

      }

      $res = mysqli_query($con,$query) or die(mysqli_error($con));
      $labels_data = [];
      $chart_data = [];

      //fetching when not grouped by session_type
      if($_POST['where']['x_axis']!="session_type"){
        while($row = mysqli_fetch_assoc($res)){
          array_push($labels_data,$_POST['name_array'][$row["".$_POST['where']['x_axis']]]);
          array_push($chart_data,$row['sessions']);
        }
      }// when grouped by session_type
      else{
        $row = mysqli_fetch_assoc($res);
        foreach ($row as $key => $value) {
          array_push($labels_data,$_POST['name_array'][$key]  );
          array_push($chart_data,$value);
        }
      }
      echo "<script>
      var chart_data = ".json_encode($chart_data).";
      var label_data = ".json_encode($labels_data).";
      </script>";
    }

?>
<script>
 $('#custom_chart').remove(); $('#graph-container').append('<canvas class="full" id="custom_chart"><canvas>');
var backgroundColor = "rgba(63,81,181,0.5)";
var borderColor = "rgb(63,81,181)";
var from_date = "<?php echo "".date("d-M-Y",strtotime($_POST['where']['from_date'])); ?>" ;
var to_date = "<?php echo "".date("d-M-Y",strtotime($_POST['where']['to_date'])); ?>" ;

var title_string = [`<?php echo $title_string; ?>`,`(${from_date} to ${to_date})`];
var myChart = new Chart(custom_chart, {
type: 'bar',
data: {
    labels: label_data,
    datasets: [{
        label: '# of Sessions',
        data: chart_data,
        backgroundColor: backgroundColor,
        borderColor: borderColor,
        borderWidth: 1
    }]
  },
    options: {
        title: {
            display: true,
            text: title_string,
            fontSize: 16,
            lineHeight: 1.5,
            padding: 20
        },
        legend:{
          display: true,
          position: "bottom"
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }],
            xAxes: [{
                barPercentage: 0.4,
                ticks: {
                   stepSize: 1,
                   min: 0,
                   autoSkip: false
               }
            }]
        }
    }
});
</script>
