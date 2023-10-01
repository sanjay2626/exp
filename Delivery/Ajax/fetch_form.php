<?php
  require '../../check_login.php';
  function x($data){
    global $con;
    return mysqli_real_escape_string($con,(trim($data)));
  }
  if(!empty($_POST)){
    if(in_array(x($_POST['school'])),array_keys($_SESSION['exp_dash_schools']) != -1){
      $fetch_maps = "SELECT * FROM project_school where
      session='{$_POST['session']}' and school_id={$_POST['school']}
      and delete_flag=0";
    }
  }
?>
