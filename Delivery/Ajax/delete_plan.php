<?php
  require '../../check_login.php';
  if(!empty($_POST)){
    $id = mysqli_real_escape_string($con,$_POST['id']);
    $query = "UPDATE delivery_plan set delete_flag=1 where sub_id='{$id}'";
    mysqli_query($con,$query) or die("Query Error: ".mysqli_error($con));
    echo "success";
  }else{
    echo "Error: No data sent!";
  }
?>
