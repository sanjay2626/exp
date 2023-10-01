<?php
  require_once('connection.php');
  require_once('check_login.php');
  require_once('head.php');
//  require_once('card_generator.php');

?>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.5.0"></script>
<script>
Chart.helpers.merge(Chart.defaults.global.plugins.datalabels, {
    align: "top",
    anchor: "end"
});
</script>
<!-- Normal Dashboard   -->
<?php
  if (in_array("13",$_SESSION['permissions'])) {
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
<div class="top container-fluid">
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
      <?php if(in_array("2",$_SESSION['permissions']) || in_array("3",$_SESSION['permissions']) || in_array("4",$_SESSION['permissions']) || in_array("5",$_SESSION['permissions'])){ ?>
      <div class="col-sm-3 col-4 center_flex">
          <a href="your_sessions.php"><div id="view" class="center_flex circle"><i class="fas fa-file-alt"></i></div></a>
          <h4 style="text-align:center" class="basis light">View Sessions</h4>
      </div>
      <?php } ?>
      <?php if(in_array("9",$_SESSION['permissions'])){ ?>
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
<?php } ?>
<!-- Normal Dashboard End -->
<!-- Report Dashboard -->
  <?php
    if (in_array("8",$_SESSION['permissions'])) {
    //fetching programs
    $prog_query = "SELECT program_id from project where id in ({$_SESSION['projects']}) and delete_flag=0";
    $prog_res = mysqli_query($con,$prog_query) or die(mysqli_error($con));
    $prog_arr = [];
    while ($prog_row = mysqli_fetch_assoc($prog_res)) {
      foreach (explode(",",$prog_row['program_id']) as $program) {
        if(!in_array($program,$prog_arr)){
          array_push($prog_arr,$program);
        }
      }
    }
    $programs = join(",",$prog_arr);
    $module_query = "SELECT module_list from program where id in ($programs) and delete_flag=0";
    $module_res = mysqli_query($con,$module_query) or die(mysqli_error($con));
    $module_arr = [];
    while ($module_row = mysqli_fetch_assoc($module_res)) {
      foreach (explode(",",$module_row['module_list']) as $module) {
        if(!in_array($module,$module_arr)){
          array_push($module_arr,$module);
        }
      }
    }
    $session_count = mysqli_fetch_row(mysqli_query($con,"SELECT count(*) from session_completed where project_id in ({$_SESSION['projects']})"))[0];
    //Chart query all except session type
    $chart_query_all = "SELECT count(*) as count,project.name as project, program.name as program,module.name as module,module.subject as subject,school.name as school
    from session_completed
    inner join project on session_completed.project_id = project.id
    inner join module on session_completed.module_id = module.id
    INNER JOIN school on session_completed.school_id = school.id
    INNER JOIN program on session_completed.program = program.id
    where project_id in ({$_SESSION['projects']})
    group by project_id,program,module_id,school_id";
    $chart_query_res = mysqli_query($con,$chart_query_all);
    while($row = mysqli_fetch_assoc($chart_query_res)){
      if(isset($chart['project'][$row['project']])){
        $chart['project'][$row['project']]+= $row['count'];
      }else{
        $chart['project'][$row['project']]= $row['count'];
      }
      if(isset($chart['program'][$row['program']])){
        $chart['program'][$row['program']]+= $row['count'];
      }else{
        $chart['program'][$row['program']]= $row['count'];
      }
      if(isset($chart['module'][$row['module']])){
        $chart['module'][$row['module']]+= $row['count'];
      }else{
        $chart['module'][$row['module']]= $row['count'];
      }
      if(isset($chart['school'][$row['school']])){
        $chart['school'][$row['school']]+= $row['count'];
      }else{
        $chart['school'][$row['school']]= $row['count'];
      }

    }

    $chart_grade_query = "SELECT COUNT(*) AS count,school.name as school,grade FROM session_completed
    INNER JOIN school on
    session_completed.school_id = school.id
    where project_id in ({$_SESSION['projects']}) group by grade,school";
    $chart_grade_query_res = mysqli_query($con,$chart_grade_query) or die(mysqli_error($con));
    while($grade_row = mysqli_fetch_assoc($chart_grade_query_res)){
      $chart_grade[$grade_row['school']][$grade_row['grade']] = $grade_row['count'];
      isset($chart_grade['total'][$grade_row['grade']])?$chart_grade['total'][$grade_row['grade']]+=$grade_row['count']:$chart_grade['total'][$grade_row['grade']]=$grade_row['count'];
    }

    $grade_subject_query = "SELECT COUNT(*) as count, grade,module.Subject as subject from session_completed
    INNER JOIN module on session_completed.module_id = module.id
    where project_id in ({$_SESSION['projects']})
    group by grade,module.subject";
    $grade_subject_res = mysqli_query($con,$grade_subject_query) or die(mysqli_error($con));
    while ($grade_subject_row = mysqli_fetch_assoc($grade_subject_res)) {
      $grade_subject[$grade_subject_row['subject']][$grade_subject_row['grade']] = $grade_subject_row['count'];
    }
     // echo "<pre>";print_r($grade_subject);echo "<pre>";
    ?>
    <style>
      .top{

        background: #311b92;
        color: white;
        padding-top: 10px;
        padding-bottom: 10px
      }
      h4.c,.incremental{
        text-align: center;
        font-weight: lighter;
      }
      .section{
        padding:15vh 30px;
      }
      .section-half{
        padding:10vh 30px;
      }
      canvas.full{
        padding:20px;
        box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2)
      }
      h2.head{
        text-align: center;
        margin-bottom:10vh
      }
      h2{
        font-weight: lighter;
      }
    </style>
    <div  class=" top container-fluid">
      <div style="padding:10px" class="row justify-content-center">
        <div class="col-3">
          <h1  class="incremental"><?php echo sizeof(explode(",",$_SESSION['projects'])); ?></h1>
          <h4 class="c">Project<?php if(sizeof(explode(",",$_SESSION['projects']))>1){echo "s";} ?></h4>
        </div>
        <div class="col-3">
          <h1  class="incremental"><?php echo sizeof($prog_arr); ?></h1>
          <h4 class="c">Program<?php if(sizeof($prog_arr>1)){echo "s";} ?></h4>
        </div>
        <div class="col-3">
          <h1  class="incremental"><?php echo sizeof($module_arr); ?></h1>
          <h4 class="c">Module<?php if(sizeof($module_arr>1)){echo "s";} ?></h4>
        </div>
        <div class="col-3">
          <h1  class="incremental"><?php echo $session_count; ?></h1>
          <h4 class="c">Sessions</h4>
        </div>
      </div>
    </div>
    <?php if(count($chart['project']) > 1){ ?>
    <!-- Project Chart -->
    <div class="section" class="container-fluid">
      <h2 class="head">Project Based Sessions</h2>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-sm-10">
            <canvas style="margin-bottom:5vh" class="full" id="project_chart" ></canvas>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
    <?php

    if(count($chart['program']) > 1){ ?>
    <!-- Program Chart -->
    <div style="background-color:#dfe3e6;" class="section-half" class="container-fluid">
      <div class="container">
        <div class="row justify-content-center">
          <div style="display:flex; justify-content:center; align-items:center" class="col-sm-4">
            <div style="margin-bottom:40px">
              <h2>Program Based</h2>
              <h2>Session Count</h2>
            </div>
          </div>
          <div style="height:400px; padding:20px; background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) !important; "  class="col-sm-8">
           <canvas style="height:350px" id="program_chart">

           </canvas>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
    <!-- Module Chart -->

    <div class="section container-fluid">
      <h2 class="head">Module Based Sessions</h2>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-sm-10">
            <canvas style="margin-bottom:5vh" class="full"  id="module_chart" >

            </canvas>
          </div>
        </div>
      </div>
    </div>

    <!-- School Chart -->
    <div style="background-color:#dfe3e6"  class=" section container-fluid">
      <h2 class="head">School Based Sessions</h2>
      <div class="container">
        <div class="row justify-content-center">
            <canvas class="full" style=" background:white" id="school_chart" >
            </canvas>
        </div>
      </div>
    </div>

    <!-- Grade Chart -->
    <div  class=" section container-fluid">
      <h2 class="head">Grade Based Sessions</h2>
      <div class="container">
        <div class="row justify-content-center">
            <canvas class="full" style=" background:white" id="grade_chart" >
            </canvas>
        </div>
      </div>
    </div>

    <!-- Grade School Chart -->
    <div style="background-color:#dfe3e6"  class=" section container-fluid">
      <h2 class="head">Grade wise School wise Sessions</h2>
      <div class="container">
        <div class="row justify-content-center">
            <canvas class="full" style=" background:white" id="grade_school_chart" >
            </canvas>
        </div>
      </div>
    </div>

    <!--Subject Chart -->
    <div  class=" section container-fluid">
      <h2 class="head">Subject Based Comparison</h2>
      <div class="container">
        <div class="row justify-content-center">
            <canvas class="full" style=" background:white" id="subject_chart" >
            </canvas>
        </div>
      </div>
    </div>
    <!-- Grade Subject Chart -->
    <div style="background-color:#dfe3e6"  class="section container-fluid">
      <h2 class="head">Grade-Wise Subject-Wise Sessions</h2>
      <div class="container">
        <div class="row justify-content-center">
            <canvas class="full" style=" background:white" id="grade_subject_chart" >
            </canvas>
        </div>
      </div>
    </div>
    <!-- Grade School Chart -->
    <!-- <div class="section" class="container-fluid">
      <h2 class="head">Grade wise School wise Sessions</h2>
      <div class="container">
        <div class="row justify-content-center">
            <canvas class="full" style=" background:white" id="grade_school_chart" >
            </canvas>
        </div>
      </div>
    </div> -->

<script>
Chart.plugins.register({
afterRender: function(c) {
    console.log("afterRender called");
    var ctx = c.chart.ctx;
    ctx.save();
    // This line is apparently essential to getting the
    // fill to go behind the drawn graph, not on top of it.
    // Technique is taken from:
    // https://stackoverflow.com/a/50126796/165164
    ctx.globalCompositeOperation = 'destination-over';
    ctx.fillStyle = 'white';
    ctx.fillRect(0, 0, c.chart.width, c.chart.height);
    ctx.restore();
}
});
    // initialising variables
   Chart.defaults.global.elements.line.fill = false;
    Chart.defaults.global.animation = false;
    Chart.defaults.global.defaultFontColor = 'black';
    Chart.defaults.global.defaultFontSize = 15;
    var chart_array = <?php echo json_encode($chart); ?>;
    var chart_grade = <?php echo json_encode($chart_grade); ?>;
    var grade_subject = <?php echo json_encode($grade_subject); ?>;
    var labels = [];
    var data = [];
    var backgroundColor = "rgba(63,81,181,0.5)";
    var borderColor = "rgb(63,81,181)";
    var options = {
      legend:{
        display: true,
        position: "bottom"
      },
      layout: {
            padding: {
                left: 0,
                right: 0,
                top: 30,
                bottom: 0
            }
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
            }],
        },
        chartArea: {
          backgroundColor: 'rgba(255, 255, 255, 1)'
        }
    }
    // options with no datalabel
    var no_label_options = {
      legend:{
        display: true,
        position: "bottom"
      },
      plugins:{
            datalabels: {
                display:false
            }
        },
      layout: {
            padding: {
                left: 0,
                right: 0,
                top: 20,
                bottom: 0
            }
        },
        
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }],
            xAxes: [{
                 barPercentage: 0.5,
                categoryPercentage: 0.8,
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
    // no_label_options.push({
    //     plugins:{
    //         datalabels: {
    //             display:false
    //         }
    //     }
    // });
      
    // increasing number animation
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

    //project comparison chart

    if(Object.keys(chart_array['project']).length > 1){
    $.each(chart_array['project'],function(k,v){
      labels.push(""+k);
      data.push(v);
    });
    var project_canvas = document.getElementById("project_chart").getContext('2d');
    var myChart = new Chart(project_canvas, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: '# of Sessions',
            data: data,
            backgroundColor: backgroundColor,
            borderColor: borderColor,
            borderWidth: 1
        }]
      },
        options
    });
}
    //program chart
    if(Object.keys(chart_array['program']).length > 1){
    labels = [];
    data = [];
    $.each(chart_array['program'],function(k,v){
      labels.push(""+k);
      data.push(v);
    });
    var program_canvas = document.getElementById("program_chart").getContext('2d');
    var myChart = new Chart(program_canvas, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: '# of Sessions',
            data: data,
            backgroundColor: backgroundColor,
            borderColor: borderColor,
            borderWidth: 1
        }]
      },
        options
    });
}
//Module Chart
    labels = [];
    data = [];
    $.each(chart_array['module'],function(k,v){
      labels.push(""+k);
      data.push(v);
    });
    var module_canvas = document.getElementById("module_chart").getContext('2d');
    var myChart = new Chart(module_canvas, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: '# of Sessions',
            data: data,
            backgroundColor: backgroundColor,
            borderColor: borderColor,
            borderWidth: 1
        }]
      },
        options
    });

    //School Chart
    labels = [];
    data = [];
    $.each(chart_array['school'],function(k,v){
      labels.push(""+k);
      data.push(v);
    });
    var school_canvas = document.getElementById("school_chart").getContext('2d');
    var myChart = new Chart(school_canvas, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: '# of Sessions',
            data: data,
            backgroundColor: backgroundColor,
            borderColor: borderColor,
            borderWidth: 1
        }]
      },
        options
    });

    //Grade Chart
    labels = [];
    data = [];
    $.each(chart_grade['total'],function(key,value){
      labels.push(""+key);
      data.push(value);
    })
    var grade_canvas = document.getElementById("grade_chart").getContext('2d');
    var myChart = new Chart(grade_canvas, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: '# of Sessions',
            data: data,
            backgroundColor: backgroundColor,
            borderColor: borderColor,
            borderWidth: 1
        }]
      },
        options
    });

    //Grade School Chart
    var bord = ["#3e95cd","#8e5ea2","#e8c3b9","#c45850","#3cba9f","#cddc39","#e91e63","#80deea","#ef9a9a","#263238"];
    labels = [];
    var set = [];
    var arr = [];
    $.each(chart_grade,function(k,v){
      if(k != "total"){
        labels.push(""+k);
      }
    });
    for (var i = 1; i < 11; i++) {
      $.each(chart_grade,function(k,v){
        if(k != "total"){
          //console.log(chart_grade[k][i]);
          if(chart_grade[k][i]){
            arr.push(chart_grade[k][i]);
          }else{
            arr.push(NaN);
          }
        }
      })
      set.push({
        label: "Grade "+i,
        data: arr,
        borderColor: bord[i-1],
        backgroundColor: bord[i-1]
      });
      arr = [];
      //console.dir(struct);

    }
    var grade_school_canvas = document.getElementById("grade_school_chart").getContext('2d');
    var gradeChart = new Chart(grade_school_canvas, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: set,
        fill: false
      },
        options: no_label_options
    });
    gradeChart.update();
    //Subject Comparison Chart
    data=[];
    labels=[];
    var sum=0;
    $.each(grade_subject,function(key,value){
      sum=0;
      $.each(value,function(k,v){
        sum+=parseInt(v);
      })
      labels.push(key);
      data.push(sum);
    })
    console.dir(data);
    var subject_canvas = document.getElementById("subject_chart").getContext('2d');
    var myChart = new Chart(subject_canvas,{
      type: 'bar',
      data: {
          labels: labels,
          datasets: [{
              label: '# of Sessions',
              data: data,
              backgroundColor: backgroundColor,
              borderColor: borderColor,
              borderWidth: 1
          }]
        },
        options
    })

    //Grade Subject Chart

    labels = [];
    set = [];
    arr = [];

    for (var i = 1; i < 11; i++) {
      labels.push("Grade "+i);
      }
      var x=0;
    $.each(grade_subject,function(k,v){

      for (var i = 1; i < 11; i++) {
        if(grade_subject[k][i]){
          arr.push(grade_subject[k][i]);
        }else{
          arr.push(NaN);
        }
      }
      set.push({
        label: ""+k,
        data: arr,
        borderColor: bord[x],
        backgroundColor: bord[x++]
      });
      arr = [];
    })
      //console.dir(struct);

    var grade_subject_canvas = document.getElementById("grade_subject_chart").getContext('2d');
    var myChart = new Chart(grade_subject_canvas, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: set,
        fill: false
      },
        options
    });

<?php  } ?>

</script>
