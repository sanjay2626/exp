<?php
  require("connect.php"); //the connection
  require('../check_login.php');

  if(!empty($_POST)){
      $flag=0;
      // switch start
      // filling the name of person who made changes

      switch($_POST['action']){
        case "add":
          //attributes is the array that has data type and values of all inputs
            $_POST['attributes']['teacher_id']['type'] = "string";
            $_POST['attributes']['teacher_id']['value'] = $_SESSION['exp_dash_id'];
            //checking if overlapping plan already exists
            $check_unique_query = "SELECT COUNT(*) as count FROM plans where
            teacher_id=:teacher_id and school_id=:school_id and module_id=:module_id and
            to_date>:from_date and delete_flag=0";

            try{
              $check_statement = $conn -> prepare($check_unique_query) or die("prepare error!\n".$check_unique_query);
              //binding parameters
              $check_statement -> bindParam(":from_date",$_POST['attributes']['from_date']['value']);
              $check_statement -> bindParam(":teacher_id",$_POST['attributes']['teacher_id']['value'],PDO::PARAM_INT);
              $check_statement -> bindParam(":module_id",$_POST['attributes']['module_id']['value'],PDO::PARAM_INT);
              $check_statement -> bindParam(":school_id",$_POST['attributes']['school_id']['value'],PDO::PARAM_INT);
              $check_statement -> execute();
              $count = $check_statement->fetch();
              if($count['count']>0){
                die("Newer Exists");
              }
            }catch(PDOException $ex){
                $flag = 1; //user friendly message
                echo ($ex->getMessage());
            }


            $query = "INSERT INTO ".$_POST['table']." set ";
            foreach($_POST['attributes'] as $key => $value){
            //  echo $key;
              $query.=$key." =:".$key.",";
            }
            $query = trim($query,",");

            try{
              $statement = $conn -> prepare($query) or die("prepare error!\n".$query);
              //binding parameters
              foreach($_POST['attributes'] as $key => $value){
                if($value['type']=="integer"){
                 $statement -> bindParam(":".$key,$value['value'],PDO::PARAM_INT);
               }else{
                 $statement -> bindParam(":".$key,$value['value']);
               }
              }
              //$statement -> debugDumpParams();
              $statement -> execute();
            }catch(PDOException $ex){
              $flag = 1; //user friendly message
              $message = $ex->getMessage();
              }
        break;

        case "modify":
          $query = "UPDATE {$_POST['table']} set ";
          foreach($_POST['attributes'] as $key => $value){
            $query.=$key." =:".$key.",";
          }
          $query = trim($query,",");
          $where = "";

          foreach($_POST['where'] as $key => $value){
            $where.=" and {$key}=";
            if($value['type']=="integer"){
              $where.=$value['value'];
            }else{
              $where.="'{$value['value']}'";
            }
          }
          $where = ltrim($where,"  and");
          $query.=" where ".$where;

          try{
            $statement = $conn -> prepare($query) or die("prepare error!");
            //binding parameters
            foreach($_POST['attributes'] as $key => $value){
              if($value['type']=="integer"){
               $statement -> bindParam(":".$key,$value['value'],PDO::PARAM_INT);
             }else{
               $statement -> bindParam(":".$key,$value['value']);
             }
            }
            //$statement -> debugDumpParams();
            $statement -> execute();
          }catch(PDOException $ex){
            $flag = 1; //user friendly message
            $message = $ex->getMessage();
            echo ($ex->getMessage());
            }

        break;

        case "delete":
        $query = "UPDATE {$_POST['table']} set delete_flag=1 where ";
        $where = "";

        foreach($_POST['where'] as $key => $value){
          $where.=" and {$key}=";
          if($value['type']=="integer"){
            $where.=$value['value'];
          }else{
            $where.="'{$value['value']}'";
          }
        }
        $where = ltrim($where,"  and"); // remove the beginning and
        $query.=$where;

        try{
          $conn -> query($query);
        }
        catch(PDOException $ex){
          $flag = 1; //user friendly message
          echo ($ex->getMessage());
          }
        break;
        default: die("Not a supported action");
        break;
    }
    //switch end
    //check if Successful
    if($flag==1){
      echo $message."\n".$query;
    }else{
      echo "Successful";
    }
  }else{
    echo "No data sent";
  }
?>
