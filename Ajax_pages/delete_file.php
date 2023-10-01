<?php
  require("../connection.php");
  if(!isset($_GET)){
    die("Error");
  }else{
    $verify = mysqli_query($con,"SELECT session_user_id from session_completed where sno=".explode("_",basename($_GET['name']))[0]) or die(mysqli_error($con));
    $user_name = mysqli_fetch_assoc($verify)['session_user_id'];
    if($user_name==$_SESSION['exp_dash_id']){
      unlink("../".$_GET['name']);
      echo "success";
    }else{
      die("Not authorised!");
    }
  }
?>
