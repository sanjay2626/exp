<?php
  require '../connection.php';
  if(!empty($_POST)){

    if(isset($_POST['from_date']) && !empty($_POST['from_date'])){
      $sess_from = " and session_date>='{$_POST['from_date']}' ";
      $plan_from = " and from_date>='{$_POST['from_date']}' ";
    }else{
      $sess_from = "";
      $plan_from = "";
    }

    if(isset($_POST['to_date']) && !empty($_POST['to_date'])){
      $sess_to = " and session_date<='{$_POST['to_date']}' ";
      $plan_to = " and to_date<='{$_POST['to_date']}' ";
    }else{
      $sess_to = "";
      $plan_to = "";
    }

    $query = "SELECT COALESCE(COUNT(*),0) as count,COALESCE(P.sum,0) as plan,S.session_user_id,S.school_id,U.name from session_completed as S
    INNER JOIN user as U on S.session_user_id = U.user_id
    LEFT JOIN (SELECT SUM(total) as sum,teacher_id,school_id from plans where delete_flag=0 {$plan_from} {$plan_to} group by teacher_id,school_id) as P
    ON P.teacher_id= S.session_user_id and P.school_id= S.school_id
    where S.school_id in ({$_SESSION['school_id']}) and S.delete_flag=0 {$sess_from} {$sess_to}
    group by session_user_id,school_id,U.name,P.sum
    UNION
    SELECT COALESCE(COUNT(*),0) as count,COALESCE(P.sum,0),S.session_user_id,S.school_id,U.name from session_completed as S
    INNER JOIN user as U on S.session_user_id = U.user_id
    RIGHT JOIN (SELECT SUM(total) as sum,teacher_id,school_id from plans where delete_flag=0 {$plan_from} {$plan_to}  group by teacher_id,school_id) as P
    ON P.teacher_id= S.session_user_id and P.school_id= S.school_id
    where S.school_id in ({$_SESSION['school_id']}) and S.delete_flag=0 {$sess_from} {$sess_to}
    group by session_user_id,school_id,U.name,P.sum";

    // echo $query;
    // die();
    $sc_res = mysqli_query($con,$query) or die(mysqli_error($con));



    ?>
    <div class="col-sm-8 table-responsive data_table">
      <table  style="margin-bottom:0px" class=" table table-bordered">
        <thead class=" bg-dark text-white">
        <tr>
          <th>Teacher Id</th>
          <th>Teacher Name</th>
          <th>School Name</th>
          <th>Plans</th>
          <th>Sessions</th>
        </tr>
        </thead>
        <tbody>
          <?php while ($sc_row = mysqli_fetch_assoc($sc_res)) { ?>
            <tr>
              <td><?php echo $sc_row['session_user_id'] ?></td>
              <td><?php echo $sc_row['name'] ?></td>
              <td><?php echo $_SESSION['exp_dash_schools'][$sc_row['school_id']] ?></td>
              <td><?php echo $sc_row['plan'] ?></td>
              <td><?php echo $sc_row['count'] ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <?php
  }else {
    echo "<h5 class='light text-center'>Please select at least one date constraint</h5>";
  }
 ?>
