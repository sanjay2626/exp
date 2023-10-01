<?php
  require '../../check_login.php';
  function x($data){
    global $con;
    return mysqli_real_escape_string($con,(trim($data)));
  }
  date_default_timezone_set('Asia/Kolkata');
  $date = date('Y-m-d');
  if(!empty($_POST)){

    $boiler_plate = "UPDATE delivery_plan set ";
    foreach ($_POST["product"] as $key => $value) {
      $query = $boiler_plate;

      foreach ($value as $grade => $products) {
        $query.="{$grade}={$products},";
      }
      // die($query);
      $query = trim($query,",");
      $query.= " where id={$key}";
      mysqli_query($con,$query) or die("Error while trying to update data for plan_id={$key}:".mysqli_error($con));
    }
    echo "Success";
  }else{
    die("Error: No data sent!");
  }
?>
