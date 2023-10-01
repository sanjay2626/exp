<?php
  require '../../check_login.php';
  function x($data){
    global $con;
    return mysqli_real_escape_string($con,(trim($data)));
  }
  date_default_timezone_set('Asia/Kolkata');
  $date = date('Y-m-d');
  if(!empty($_POST)){
    $school = x($_POST['school_id']);
    $module = x($_POST['module_id']);
    $session = x($_POST['session']);
    $sub_id =substr(md5(microtime()),rand(0,26),10); // sub-id for plan
    $boiler_plate = "INSERT INTO delivery_plan set school_id={$school},module_id={$module},session='{$session}', sub_id='{$sub_id}',
    created_by='{$_SESSION['exp_dash_id']}',created_date='{$date}'";
    foreach ($_POST["product"] as $key => $value) {
      $query = $boiler_plate;
      $query.=",product_id={$key}";
      foreach ($value as $field => $count) {
        $query.=",{$field}={$count}";
      }
      mysqli_query($con,$query) or die("Error while trying to add data for product_id={$key}:".$query);
    }
    echo "successful";
  }else{
    die("Error: No data sent!");
  }
?>
