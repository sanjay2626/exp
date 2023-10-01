<?php session_start();
  if(isset($_SESSION['exp_dash_name'])){
  session_destroy();
   header("location:" ."https://" . $_SERVER['SERVER_NAME'].'/');
}else{
header("location:" ."https://" . $_SERVER['SERVER_NAME'].'/');
}
?>
