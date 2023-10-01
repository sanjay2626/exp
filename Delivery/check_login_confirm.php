<?php
    require("../connection.php");
    if(!isset($_SESSION['exp_dellivery_user_id'])){
        header("location:http://localhost/experifun/index.php");
      }
?>
