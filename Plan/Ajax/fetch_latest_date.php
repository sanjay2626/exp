<?php
  require '../connect.php';
  if(isset($_POST)){
    $query = "SELECT from_date,to_date from plans where teacher_id='{$_SESSION['exp_dash_id']}'
    and school_id=:school_id and delete_flag=0 ORDER BY id desc LIMIT 1";
    $statement = $conn -> prepare($query);
    try{
    $statement -> bindParam(":school_id",$_POST['school_id'],PDO::PARAM_INT);
    $statement -> execute();
    $row = $statement -> fetch();
    }
    catch(PDOException $ex){
      echo ($ex -> getMessage());
    }
  }
  if(isset($row['from_date'])){
    $return['from'] = $row['from_date'];
    $return['to'] = $row['to_date'];
  }else{
    $return['none'] = 'none';
  }

  echo json_encode($return);
?>
