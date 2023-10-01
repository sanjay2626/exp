<?php
  
    echo '<link rel="stylesheet" href="css/dashboard_normal.css">';
  if(date('D')=="Sun"){
    $last_monday = date("Y-m-d",strtotime("last Monday"));
    $last_saturday = date("Y-m-d",strtotime("last Saturday"));
    $monday = date("Y-m-d",strtotime("next monday"));
    $saturday = date("Y-m-d",strtotime("next saturday"));
  }else{
  $last_monday = date("Y-m-d",strtotime("previous week Monday"));
  $last_saturday = date("Y-m-d",strtotime("previous week Saturday"));
  $monday = date("Y-m-d",strtotime("monday this week"));
  $saturday = date("Y-m-d",strtotime("saturday this week"));
}

  //weekly plans and actual
  //last week and this week boiler plate
  if(in_array("1",$_SESSION['permissions'])){
  $lwb = " where session_user_id='{$_SESSION['exp_dash_id']}' and session_date>='{$last_monday}' and session_date<='{$last_saturday}' and delete_flag=0 group by entity ";
  $twb = " where session_user_id='{$_SESSION['exp_dash_id']}' and session_date>='{$monday}' and session_date<='{$saturday}' and delete_flag=0 group by entity ";
  $session_weekly = "SELECT COUNT(*) as count,school_id as entity,'last-week' as week FROM `session_completed` {$lwb}
  UNION ALL SELECT COUNT(*) as count,school_id as entity,'this-week' as week FROM `session_completed` {$twb}
  UNION SELECT 'module','module','module'
  UNION ALL SELECT COUNT(*) as count,module_id as entity,'last-week' as week FROM `session_completed` {$lwb}
  UNION ALL SELECT COUNT(*) as count,module_id as entity,'this-week' as week FROM `session_completed` {$twb}
  UNION SELECT 'grade','grade','grade'
  UNION ALL SELECT COUNT(*) as count,grade as entity,'last-week' as week FROM `session_completed` {$lwb}
  UNION ALL SELECT COUNT(*) as count,grade as entity,'this-week' as week FROM `session_completed` {$twb} ";
  // die($session_weekly);
  $session_weekly_res = mysqli_query($con,$session_weekly) or die(mysqli_error($con));
  $type="school";
  while($ws = mysqli_fetch_assoc($session_weekly_res)){
    switch ($type) {
      case 'school':  if($ws['entity'] == "module"){
                        $type="module"; // school -> module -> grade union
                        break;
                      }
                      $school_week[$ws['week']][$ws['entity']] = $ws['count'];
                      break;
      case 'module':  if($ws['entity'] == "grade"){
                        $type="grade"; // school -> module -> grade union
                        break;
                      }
                      $module_week[$ws['week']][$ws['entity']] = $ws['count'];
                      break;
      case 'grade':
                      $grade_week[$ws['week']][$ws['entity']] = $ws['count'];
                      break;
    }
  }
  $lwb = " where teacher_id='{$_SESSION['exp_dash_id']}' and from_date>='{$last_monday}' and to_date<='{$last_saturday}' and delete_flag=0 group by entity ";
  $twb = " where teacher_id ='{$_SESSION['exp_dash_id']}' and from_date>='{$monday}' and to_date<='{$saturday}' and delete_flag=0 group by entity ";
  $plan_weekly = "SELECT SUM(total) as count,school_id as entity,'last-week' as week FROM `plans` {$lwb}
  UNION ALL SELECT SUM(total) as count,school_id as entity,'this-week' as week FROM `plans` {$twb}
  UNION SELECT 'module','module','module'
  UNION ALL SELECT SUM(total) as count,module_id as entity,'last-week' as week FROM `plans` {$lwb}
  UNION ALL SELECT SUM(total) as count,module_id as entity,'this-week' as week FROM `plans` {$twb}";
  // die($plan_weekly);
  $plan_weekly_res = mysqli_query($con,$plan_weekly) or die(mysqli_error($con));
  $type="school";
  while($ws = mysqli_fetch_assoc($plan_weekly_res)){
    switch ($type) {
      case 'school':  if($ws['entity'] == "module"){
                        $type="module"; // school -> module -> grade union
                        break;
                      }
                      $school_week_plan[$ws['week']][$ws['entity']] = $ws['count'];
                      break;
      case 'module':  if($ws['entity'] == "grade"){
                        $type="grade"; // school -> module -> grade union
                        break;
                      }
                      $module_week_plan[$ws['week']][$ws['entity']] = $ws['count'];
                      break;
      case 'grade':
                      $grade_week_plan[$ws['week']][$ws['entity']] = $ws['count'];
                      break;
    }
  }
   // print_r($school_week);
  //weekly plans and actual end

  //overall planned and actual
  $sessions_query = "SELECT COUNT(*) as count,school_id as entity FROM `session_completed` where session_user_id='{$_SESSION['exp_dash_id']}' group by entity
  Union SELECT 'module-separate','module-separate'
  UNION SELECT COUNT(*) as count,module_id as entity FROM `session_completed` where session_user_id='{$_SESSION['exp_dash_id']}' group by entity
  Union SELECT 'grade-separate','grade-separate'
  UNION SELECT COUNT(*) as count,grade as entity FROM `session_completed` where session_user_id='{$_SESSION['exp_dash_id']}' group by entity
  Union SELECT 'weekly','weekly'
  Union SELECT COUNT(*) as count,'last-week' as entity FROM `session_completed` where session_user_id='{$_SESSION['exp_dash_id']}' and session_date>='{$last_monday}' and session_date<='{$last_saturday}'
  Union SELECT COUNT(*) as count,'this-week' as entity FROM `session_completed` where session_user_id='{$_SESSION['exp_dash_id']}' and session_date>='{$monday}' and session_date<='{$saturday}'";
  $sessions_query_res = mysqli_query($con,$sessions_query) or die(mysqli_error($con));
  //fill actual school
  $type = "school";
  $total_actual = 0;
  while($sessions_row = mysqli_fetch_assoc($sessions_query_res)){
    switch($type){
      case "school" : if($sessions_row['entity'] == "module-separate"){
                        $type="module"; // school -> module -> grade union
                        break;
                      }
                      $school_actual[$sessions_row['entity']] = $sessions_row['count'];
                      $total_actual+=$sessions_row['count'];
                      break;

      case "module" : if($sessions_row['entity'] == "grade-separate"){
                        $type="grade"; // school -> module -> grade union
                        break;
                      }
                      $module_actual[$sessions_row['entity']] = $sessions_row['count'];
                      break;

      case "grade" :  if($sessions_row['entity'] == "weekly"){
                        $type="weekly"; // school -> module union
                        break;
                      }
                      $grade_actual[$sessions_row['entity']] = $sessions_row['count'];
                      break;
      case "weekly" : $week_actual[$sessions_row['entity']] = $sessions_row['count'];
                      break;
    }
  }
  //print_r($grade_actual);
  $plans_query = "SELECT SUM(total) as count,school_id as entity FROM `plans` where teacher_id='{$_SESSION['exp_dash_id']}' and delete_flag=0 group by entity
  Union SELECT 'module-separate','module-separate'
  UNION SELECT SUM(total) as count,module_id as entity FROM `plans` where teacher_id='{$_SESSION['exp_dash_id']}' and delete_flag=0  group by entity
  Union SELECT 'grade-separate','grade-separate'";
  for($i=1;$i<11;$i++){
    $plans_query.=" UNION SELECT SUM(grade_{$i}) as count,'{$i}' from plans where teacher_id='{$_SESSION['exp_dash_id']}' and delete_flag=0 ";
  }
  $plans_query.="Union SELECT 'weekly','weekly'
  Union select SUM(total) as count, 'last-week' as entity from `plans` where teacher_id='{$_SESSION['exp_dash_id']}' and delete_flag=0 and from_date>='{$last_monday}' and to_date<='{$last_saturday}' group by entity
  Union select SUM(total) as count, 'this-week' as entity from `plans` where teacher_id='{$_SESSION['exp_dash_id']}' and delete_flag=0 and from_date>='{$monday}' and to_date<='{$saturday}' group by entity ";

  $plans_query_res = mysqli_query($con,$plans_query) or die(mysqli_error($con));
  //fill actual school
  $type = "school";
  $total_plan = 0;
  $school_plan = [];
  $module_plan = [];
  $grade_plan = [];
  while($plans_row = mysqli_fetch_assoc($plans_query_res)){
    switch($type){
      case "school" : if($plans_row['entity'] == "module-separate"){
                        $type="module"; // school -> module union
                        break;
                      }
                      $school_plan[$plans_row['entity']] = $plans_row['count'];
                      $total_plan+=$plans_row['count'];
                      break;

      case "module" : if($plans_row['entity'] == "grade-separate"){
                        $type="grade"; // school -> module union
                        break;
                      }
                      $module_plan[$plans_row['entity']] = $plans_row['count'];
                      break;
      case "grade" :  if($plans_row['entity'] == "weekly"){
                        $type="weekly"; // school -> module union
                        break;
                      }
                      if($plans_row['count']>0)
                      $grade_plan[$plans_row['entity']] = $plans_row['count'];
                      break;

      case "weekly" : $week_plan[$plans_row['entity']] = $plans_row['count'];
                      break;
        }
      }




      // print_r($school_week);
      // print_r($module_week);
  

?>
<link rel="stylesheet" href="css/dashboard_normal.css">
<div class="top container-fluid" style="background:#C00000 !importent;">
  <div style="padding:10px" class="row justify-content-center">
    <div class="col-3">
      <h1  class="incremental"><?php echo $total_plan; ?></h1>
      <h4 class="c">Plans</h4>
    </div>
    <div class="col-3">
      <h1  class="incremental"><?php echo $total_actual; ?></h1>
      <h4 class="c">Sessions</h4>
    </div>
  </div>
</div>
<?php } ?>
<!-- Options -->
<div class="container">
<div class="row justify-content-center" style="padding:20px">
      <?php if(in_array("1",$_SESSION['permissions'])){ ?>
      <div class="col-sm-3 col-4 center_flex">
          <a href="add_session.php"><div id="add" class="center_flex circle"><i class="fas fa-plus"></i></div></a>
          <h4 style="text-align:center" class="basis light">Add Sessions</h4>
      </div>
      <?php } ?>
      <?php if(in_array("1",$_SESSION['permissions']) || in_array("2",$_SESSION['permissions']) || in_array("3",$_SESSION['permissions']) || in_array("4",$_SESSION['permissions']) || in_array("5",$_SESSION['permissions'])){ ?>
      <div class="col-sm-3 col-4 center_flex">
          <a href="your_sessions.php"><div id="view" class="center_flex circle"><i class="fas fa-file-alt"></i></div></a>
          <h4 style="text-align:center" class="basis light">View Sessions</h4>
      </div>
      <?php } ?>
      <?php if(in_array("1",$_SESSION['permissions']) || in_array("9",$_SESSION['permissions'])){ ?>
      <div class="col-sm-3 col-4 center_flex">
          <a href="Plan/add_plan.php"><div id="plans" class="center_flex circle"><i class="fas fa-plus"></i></div></a>
          <h4 style="text-align:center" class="basis light">Add Plans</h4>
      </div>
      <div class="col-sm-3 col-4 center_flex">
          <a href="Plan/view_plan.php"><div id="view_plans" class="center_flex circle"><i class="fas fa-file-alt"></i></div></a>
          <h4 style="text-align:center" class="basis light">View/Modify Plans</h4>
      </div>
      <?php } ?>
      <?php if(in_array("12",$_SESSION['permissions'])){ ?>
         <div class="col-sm-3 col-4 center_flex">
          <a href="teacher_analysis"><div id="teacher_perf" class="center_flex circle"><i class="fas fa-file-alt"></i></div></a>
          <h4 style="text-align:center" class="basis light">Teacher Performance</h4>
      </div>
      <?php } ?>
  </div>
</div>

<?php if(in_array("1",$_SESSION['permissions'])){ ?>
<div style="background: black" class="top container-fluid">
  <h4 class="light text-center">Weekly Comparison</h4>
</div>


<!-- Module-wise weekly -->
<?php $module_week_array = [];

if(isset($module_week_plan['last-week'])){
  $module_week_array = array_merge($module_week_array ,array_keys($module_week_plan['last-week']));
}

if(isset($module_week_plan['this-week'])){
  $module_week_array = array_merge($module_week_array,array_keys($module_week_plan['this-week']));
}


if(isset($module_week['last-week'])){
  $module_week_array = array_merge($module_week_array,array_keys($module_week['last-week']));
}

if(isset($module_week['this-week'])){
  $module_week_array = array_merge($module_week_array,array_keys($module_week['this-week']));
}
$module_week_array = array_unique($module_week_array);

?>
<div class="section container-fluid">
  <h2 class="head">Module-based</h2>
  <div class="container">
    <div class="row justify-content-center">
      <div style="padding: 0;background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) !important; "  class="col-sm-8 table-responsive">
        <table style="margin:0px" class=" table table-bordered">
          <thead class=" bg-dark text-white">
            <tr>
              <th class="text-center" style="vertical-align:middle" rowspan="2">Module</th>
              <th class="text-center" colspan="2">Last Week</th>
              <th class="text-center" colspan="2">This Week</th>
            </tr>
            <tr>
              <th class="text-center">Planned</th>
              <th class="text-center">Actual</th>
              <th class="text-center">Planned</th>
              <th class="text-center">Actual</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($module_week_array as $m): ?>
            <tr>
            <td><?php echo $_SESSION['module_name'][$m]; ?></td>
            <td><?php if(isset($module_week_plan['last-week'][$m])){ echo $module_week_plan['last-week'][$m]; }else{ echo "0";} ?></td>
            <td><?php if(isset($module_week['last-week'][$m])){ echo $module_week['last-week'][$m]; }else{ echo "0";} ?></td>
            <td><?php if(isset($module_week_plan['this-week'][$m])){ echo $module_week_plan['this-week'][$m]; }else{ echo "0";} ?></td>
            <td><?php if(isset($module_week['this-week'][$m])){ echo $module_week['this-week'][$m]; }else{ echo "0";} ?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
              <td>Total</td>
              <td><?php if(isset($week_plan['last-week'])){ echo $week_plan['last-week']; }else{ echo "0";} ?></td>
              <td><?php if(isset($week_actual['last-week'])){ echo $week_actual['last-week']; }else{ echo "0";} ?></td>
              <td><?php if(isset($week_plan['this-week'])){ echo $week_plan['this-week']; }else{ echo "0";} ?></td>
              <td><?php if(isset($week_actual['this-week'])){ echo $week_actual['this-week']; }else{ echo "0";} ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Module-wise weekly -->

<?php if(sizeof($_SESSION['exp_dash_schools']) > 1){ ?>
<!-- School Based Weekly -->
<?php $school_week_array = [];
if(isset($school_week_plan['last-week'])){
  $school_week_array = array_merge($school_week_array ,array_keys($school_week_plan['last-week']));
}

if(isset($school_week_plan['this-week'])){
  $school_week_array = array_merge($school_week_array,array_keys($school_week_plan['this-week']));
}


if(isset($school_week['last-week'])){
  $school_week_array = array_merge($school_week_array,array_keys($school_week['last-week']));
}

if(isset($school_week['this-week'])){
  $school_week_array = array_merge($school_week_array,array_keys($school_week['this-week']));
}
$school_week_array = array_unique($school_week_array);
// print_r($school_week['last-week']);
?>
<div class="section container-fluid">
  <h2 class="head">School-based</h2>
  <div class="container">
    <div class="row justify-content-center">
      <div style="padding: 0;background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) !important; "  class="col-sm-8 table-responsive">
        <table style="margin:0px" class=" table table-bordered">
          <thead class=" bg-dark text-white">
            <tr>
              <th class="text-center" style="vertical-align:middle" rowspan="2">School</th>
              <th class="text-center" colspan="2">Last Week</th>
              <th class="text-center" colspan="2">This Week</th>
            </tr>
            <tr>
              <th class="text-center">Planned</th>
              <th class="text-center">Actual</th>
              <th class="text-center">Planned</th>
              <th class="text-center">Actual</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($school_week_array as $m): ?>
            <tr>
              <td><?php echo $_SESSION['exp_dash_schools'][$m]; ?></td>
              <td><?php if(isset($school_week_plan['last-week'][$m])){ echo $school_week_plan['last-week'][$m]; }else{ echo "0";} ?></td>
              <td><?php if(isset($school_week['last-week'][$m])){ echo $school_week['last-week'][$m]; }else{ echo "0";} ?></td>
              <td><?php if(isset($school_week_plan['this-week'][$m])){ echo $school_week_plan['this-week'][$m]; }else{ echo "0";} ?></td>
              <td><?php if(isset($school_week['this-week'][$m])){ echo $school_week['this-week'][$m]; }else{ echo "0";} ?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
              <td>Total</td>
              <td><?php if(isset($week_plan['last-week'])){ echo $week_plan['last-week']; }else{ echo "0";} ?></td>
              <td><?php if(isset($week_actual['last-week'])){ echo $week_actual['last-week']; }else{ echo "0";} ?></td>
              <td><?php if(isset($week_plan['this-week'])){ echo $week_plan['this-week']; }else{ echo "0";} ?></td>
              <td><?php if(isset($week_actual['this-week'])){ echo $week_actual['this-week']; }else{ echo "0";} ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<!-- School-wise weekly -->
<div style="background: black" class="top container-fluid">
  <h4 class="light text-center">Overall Comparison</h4>
</div>
<!--Overall-->
<div  class="section container-fluid">
  <h2 class="head">School-Wise Plan/Session Comparison</h2>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-10">
        <canvas style="margin-bottom:5vh" class="full"  id="school_sessions" >

        </canvas>
      </div>
    </div>
  </div>
</div>

<div  class="section container-fluid">
  <div class="row justify-content-center">
    <div style="display:flex; justify-content:center; align-items:center" class="col-sm-4">
      <div style="margin-bottom:40px">
        <h2>Module Based</h2>
        <h2>Comparison</h2>
      </div>
    </div>
    <div style="padding: 0;background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) !important; "  class="col-sm-8 table-responsive">
      <table style="margin:0px" class=" table table-striped table-bordered">
        <thead class=" bg-dark text-white">
          <th>Module</th>
          <th>Planned</th>
          <th>Sessions Taken</th>
          <th>Variation</th>
        </thead>
        <tbody>
          <?php
          $module_actual_keys = array_keys($module_actual);
          $module_plan_keys = array_keys($module_plan);
          foreach (array_diff($module_actual_keys,$module_plan_keys) as $key) {
            $module_plan[$key]=0;
          }
          foreach (array_diff($module_plan_keys,$module_actual_keys) as $key) {
            $module_actual[$key]=0;
          }
          foreach ($module_actual as $key => $value): ?>
            <tr>
              <td><?php echo $_SESSION['module_name'][$key]; ?></td>
              <td><?php echo $module_plan[$key]; ?></td>
              <td><?php echo $module_actual[$key]; ?></td>
              <td>
              <?php
              if($module_actual[$key]>=$module_plan[$key]){
                echo "<span style='color:green'>";
                if($module_plan[$key]!=0){
                  echo round(($module_actual[$key]-$module_plan[$key])*100/$module_plan[$key],2)."%";
                }else{
                  echo $module_actual[$key]-$module_plan[$key];
                }
              }else{
                echo "<span style='color:red'>";
                if($module_plan[$key]!=0){
                  echo round(($module_actual[$key]-$module_plan[$key])*100/$module_plan[$key],2)."%";
                }else{
                  echo $module_actual[$key]-$module_plan[$key];
                }
              }
              echo "</span>";
              ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>


<div class="section container-fluid">

    <div class="row justify-content-center">
      <div style="display:flex; justify-content:center; align-items:center" class="col-sm-4">
        <div style="margin-bottom:40px">
          <h2>Grade Based</h2>
          <h2>Comparison</h2>
        </div>
      </div>
      <div style="padding: 0;background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) !important; "  class="col-sm-8 table-responsive">
        <table style="margin:0px" class="table table-striped table-bordered">
          <thead class=" bg-dark text-white">
            <th>Grade</th>
            <th>Planned</th>
            <th>Sessions Taken</th>
            <th>Variation</th>
          </thead>
          <tbody>
            <?php
            $actual_keys = array_keys($grade_actual);
            $plan_keys = array_keys($grade_plan);
            // print_r($actual_keys);echo"\n";
            // print_r($plan_keys);echo"\n";
            // print_r(array_diff($actual_keys,$plan_keys));echo"\n";
            // print_r(array_diff($plan_keys,$actual_keys));
            foreach (array_diff($actual_keys,$plan_keys) as $key) {
              $grade_plan[$key] = 0;
            }
            foreach (array_diff($plan_keys,$actual_keys) as $key) {
              $grade_actual[$key] = 0;
            }
            foreach($grade_actual as $key => $value): ?>
              <tr>
                <td><?php echo "Grade {$key}"; ?></td>
                <td><?php echo $grade_plan[$key]; ?></td>
                <td><?php echo $value; ?></td>
                <td><?php
                if($value>=$grade_plan[$key]){
                  echo "<span style='color:green'>";
                  if($grade_plan[$key]!=0){
                    echo round(($value-$grade_plan[$key])*100/$grade_plan[$key],2)."%";
                  }else{
                    echo $value-$grade_plan[$key];
                  }
                }else{
                  echo "<span style='color:red'>";
                  if($grade_plan[$key]!=0){
                    echo round(($value-$grade_plan[$key])*100/$grade_plan[$key],2)."%";
                  }else{
                    echo $value-$grade_plan[$key];
                  }
                }
                echo "</span>";
                ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

</div>



<!-- <div class="section container-fluid">
  <div class="row justify-content-center">
    <div class="col-sm-5 table table-responsive">

    </div>
  </div>
</div> -->

<script>
$(document).ready(function(){
  odd = true;
  section = $("body").find(".section");
  for (var i = 0; i < section.length; i++) {
    if(odd){
    $(section[i]).css("background","#eee");
    odd = false;
  }else{
    odd = true;
  }
  }
})
$('.incremental').each(function () {
  $(this).prop('Counter',0).animate({
    Counter: $(this).text()
  }, {
    duration: 3000,
    easing: 'swing',
    step: function (now) {
      $(this).text(Math.ceil(now));
    }
  });
});
Chart.plugins.register({
afterRender: function(c) {
    console.log("afterRender called");
    var ctx = c.chart.ctx;
    ctx.save();
    ctx.globalCompositeOperation = 'destination-over';
    ctx.fillStyle = 'white';
    ctx.fillRect(0, 0, c.chart.width, c.chart.height);
    ctx.restore();
}
});
var backgroundColor = ["rgba(198, 40, 40, 0.5)","rgba(76, 175, 80, 0.5)"];
var borderColor = ["rgb(198, 40, 40)","rgb(76, 175, 80)"];
var school_plan = <?php echo json_encode($school_plan); ?>;
var school_actual = <?php echo  json_encode($school_actual); ?>;
var schools = <?php echo json_encode($_SESSION['exp_dash_schools']); ?>;
var options = {
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
          barPercentage: 1.0,
          categoryPercentage: 0.5,
            ticks: {
               stepSize: 1,
               min: 0,
               autoSkip: false
           }
        }],
    },
    chartArea: {
      backgroundColor: 'rgba(255, 255, 255, 1)'
    }
}
var plot_plan = [];
var plot_actual = [];
var labels = [];
$.each(schools,function(key,value){
  labels.push(value);
  if(school_plan[key] != undefined){
    plot_plan.push(school_plan[key])
  }
  if(school_actual[key] != undefined){
    plot_actual.push(school_actual[key])
  }
});

var school_canvas = document.getElementById("school_sessions").getContext('2d');
var myChart = new Chart(school_canvas, {
type: 'bar',
data: {
    labels: labels,
    datasets: [{
        label: 'Sessions Planned',
        data: plot_plan,
        backgroundColor:backgroundColor[0],
        borderColor: borderColor[0],
        borderWidth: 1
    },{
      label: 'Sessions Conducted',
      data: plot_actual,
      backgroundColor: backgroundColor[1],
      borderColor: borderColor[1],
      borderWidth: 1
    }]
  },
    options
});

</script>
<?php } ?> <!-- if in_array permission 1 end -->

