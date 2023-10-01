<?php
  require '../connect.php';
  if(isset($_POST) && !empty($_POST)){
      //print_r($_POST);
      $query = "SELECT * from plans where teacher_id='{$_SESSION['exp_dash_id']}'
      and school_id=:school_id and NOT(from_date>:to_date  or to_date<:from_date) and delete_flag=0 ORDER BY id desc ";
      $statement = $conn -> prepare($query);
      try{
      $from = $_POST['from_date'];
      $to = $_POST['to_date'];
      $statement -> bindParam(":school_id",$_POST['school_id'],PDO::PARAM_INT);
      $statement -> bindParam(":to_date",$to);
      $statement -> bindParam(":from_date",$from);
      $statement -> execute();
      //$statement -> debugDumpParams();
      }
      catch(PDOException $ex){
        die($ex -> getMessage());
      }
      while($row = $statement -> fetch()){
       
      ?>
        <tr>
          <td><?php echo $row['module_id']; ?></td>
          <td><?php echo $row['from_date']; ?></td>
          <td><?php echo $row['to_date']; ?></td>
          <td><?php
          $string = "";
          for($i=1;$i<11;$i++){
            if(!empty($row["grade_".$i])){
              $string.= "Grade {$i}: {$row["grade_".$i]}, ";
            }
          }
          $string = trim($string,", ");
          echo $string;
          ?></td>
          <td><span data-t="<?php echo $row['id']; ?>" class="view">View/Edit</span></td>
          <td><span data-t="<?php echo $row['id']; ?>" class="delete">Delete</span></td>
        </tr>
      <?php
      }
    }
?>
