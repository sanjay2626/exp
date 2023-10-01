<?php
  require '../../check_login.php';
  function x($data){
    global $con;
    return mysqli_real_escape_string($con,(trim($data)));
  }
  date_default_timezone_set('Asia/Kolkata');
  $date = date('Y-m-d');
  if(!empty($_POST)){
    $sub_id = x($_POST['plan_sub_id']);
    $delivery_id = $rand = substr(md5(microtime()),rand(0,26),10);
    $boiler_plate = "INSERT INTO delivery_data set delivery_id='{$delivery_id}'
    ";
    foreach ($_POST["product"] as $key => $value) {
      $query = $boiler_plate;
      $query.=",plan_id={$key}";
      foreach ($value as $grade => $products) {
        $query.=",{$grade}={$products}";
      }
      mysqli_query($con,$query) or die("Error while trying to add data for plan_id={$key}:".mysqli_error($con));
    }
    $query = "INSERT INTO delivery_status set plan_sub_id='{$sub_id}',delivery_id='{$delivery_id}',
    initiated_by='{$_SESSION['exp_dash_id']}',
    initiation_date='{$date}'";
    mysqli_query($con,$query) or die("Error while trying to add data for delivery status:".mysqli_error($con));
    echo "Success";
  }else{
    die("Error: No data sent!");
  }
?>
