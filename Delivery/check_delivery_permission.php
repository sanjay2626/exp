<?php
  if(!in_array("11",$_SESSION['permissions'])){
    header("location:http://localhost/experifun/dashboard.php");
  }
 ?>
