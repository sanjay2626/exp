<?php
  require '../connection.php';
  require '../check_login.php';
  require '../head.php';
  $query = "SELECT SUM(total) as sum from plans where
  teacher_id='{$_SESSION['exp_dash_id']}' and delete_flag=0";
  $res =mysqli_query($con,$query) or die(mysqli_error($con));
  $total_plan = mysqli_fetch_assoc($res)['sum'];

  $taken_query = "SELECT COUNT(*) as count FROM session_completed where
  session_user_id='{$_SESSION['exp_dash_id']}'";
  $taken_res = mysqli_query($con,$taken_query) or die(mysqli_error($con));
  $total_taken = mysqli_fetch_assoc($taken_res)['count'];

  $session_query = "SELECT COUNT(*) AS count,module_id as module from session_completed
  where session_user_id='{$_SESSION['exp_dash_id']}' group by module_id ";
  $session_res = mysqli_query($con,$session_query);
  while ($session_row = mysqli_fetch_assoc($session_res)) {
    $sessions[$session_row['module']]= $session_row['count'];
  }

  $plan_query = "SELECT SUM(total) AS count,module_id as module from plans
  where teacher_id='{$_SESSION['exp_dash_id']}' and delete_flag=0 group by module_id";
  $plan_res = mysqli_query($con,$plan_query) or die(mysqli_error($con));
  while ($plan_row = mysqli_fetch_assoc($plan_res)) {
    $plans[$plan_row['module']]= $plan_row['count'];
  }

  $session_keys = array_keys($sessions);
  $plan_keys = array_keys($plans);
  foreach (array_diff($session_keys,$plan_keys) as $key) {
    $plans[$key]=0;
  }
  foreach (array_diff($plan_keys,$session_keys) as $key) {
    $sessions[$key]=0;
  }
  // print_r($sessions);
  // print_r($plans);
//   $running_plans=  [];
//   $today = date("Y-m-d");
//   $running = "SELECT * FROM plans where to_date>='{$today}' and from_date<='{$today}' and delete_flag=0";
//   $running_res = mysqli_query($con,$running) or die(mysqli_error($con));
//   while($running_row = mysqli_fetch_assoc($running_res)){
//     $running_plans[$running_row['module_id']]['from'] = $running_row['from_date'];
//     $running_plans[$running_row['module_id']]['to'] = $running_row['to_date'];
//     for($i=1;$i<11;$i++){
//       if($running_row['grade_'.$i] != ""){
//         $running_plans[$running_row['module_id']]['grades'][''.$i] = $running_row['grade_'.$i];
//       }
//     }
//   }
//
  // $running_taken = "SELECT COUNT(*) as count,grade FROM session_completed where
  // session_user_id='{$_SESSION['exp_dash_id']}' and session_date<='{$running_plans['to']}'
  // and session_date>='{$running_plans['from']}' group by grade,module_id";
//   //echo $running_taken;
//   $running_taken_res = mysqli_query($con,$running_taken) or die(mysqli_error($con));
//   $running_taken_array = [];
//   while($rt_row = mysqli_fetch_assoc($running_taken_res)){
//     $running_taken_array[$rt_row['module_id']][$rt_row['grade']] = $rt_row['count'];
//   }
// //  print_r($running_plans);
// mysqli_free_result($taken_res);
// mysqli_free_result($running_res);
// mysqli_free_result($running_taken_res);
?>
<style>
  #wrapper{
    height: calc(100vh - 80px) !important;
  }
  #bottom{
    min-height:calc((100vh - 80px)/2) !important;
    background: white;
  }
  #top{
    background: #eeeeee;
  }
  .center{
    text-align:center
  }
  h3{
    margin-bottom: 0px
  }
  #side{
    padding: 20px
  }
</style>
<div id="wrapper" class="container-fluid">
  <div id="top" class="row justify-content-center">
    <div class="col-10">
      <div class="container-fluid" style="height:100%">
        <div style="padding-top:10px" class="row justify-content-center">
          <div class="col-md-5 col-6">
            <h3 class="light center">Total Planned</h3>
            <h4 class="light center"><?php echo $total_plan; ?></h4>
          </div>
          <div class="col-md-5 col-6">
            <h3 class="light center">Sessions Taken</h3>
            <h4 class="light center"><?php echo $total_taken; ?></h4>
          </div>
        </div>
      </div>
    </div>
  </div>
  <h2 style="margin-bottom:20px; padding:10px; font-weight: 300 !important" class="center">On-going plan</h2><hr>
  <div id="bottom" class="row justify-content-center">
    <div class="col-sm-8 table table-responsive">
      <table class="table">
        <thead class=" bg-dark text-white">
          <th>Module</th>
          <th>Plans</th>
          <th>Sessions Taken</th>
          <th>Variation</th>
        </thead>
        <tbody>
          <?php foreach ($sessions as $key => $value): ?>
            <tr>
              <td><?php echo $_SESSION['module_name'][$key]; ?></td>
              <td><?php echo $plans[$key]; ?></td>
              <td><?php echo $sessions[$key]; ?></td>
              <td><?php
              if($sessions[$key]>=$plans[$key]){
                echo "<span style='color:green'>";
                echo ($sessions[$key]-$plans[$key]);
              }else{
                echo "<span style='color:red'>";
                echo ($sessions[$key]-$plans[$key]);
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
<?php
  require '../footer.php';
?>
