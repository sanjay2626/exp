<?php 
    require("connection.php");
    if(isset($_SESSION['admin_logged_in'])){
        header("location:" ."https://" . $_SERVER['SERVER_NAME'].'/admin');
    }
    if(!isset($_SESSION['exp_dash_name'])){
        header("location:" ."https://" . $_SERVER['SERVER_NAME'].'/index.php');
      }
?>