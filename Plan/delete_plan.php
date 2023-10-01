<?php
  require 'connect.php';
  require '../check_login.php';
  if(!empty($_GET)){
    $id = $_GET['id'];
    $query = "UPDATE plans set delete_flag=1 where id=:id";
    $statement = $conn -> prepare($query) or die("prepare error!\n".$query);
    $statement -> bindParam(":id",$id,PDO::PARAM_INT);
    try{
      $statement -> execute();
      header("location:view_plan.php");
    }
    catch(PDOException $ex){
      echo ($ex->getMessage());
      }
  }
?>
