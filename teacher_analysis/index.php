<?php
  require '../check_login.php';
  
  if(!in_array("12",$_SESSION['permissions'])){
    header("location:../dashboard.php");
  }
  require '../head.php';
  if(date('D')=="Sun"){
    $last_monday =  date("Y-m-d",strtotime("last Monday"));
    $last_saturday = date("Y-m-d",strtotime("last Saturday"));
    $monday = date("Y-m-d",strtotime("next monday"));
    $saturday = date("Y-m-d",strtotime("next saturday"));
  }else{
  $last_monday = date("Y-m-d",strtotime("previous week Monday"));
  $last_saturday = date("Y-m-d",strtotime("previous week Saturday"));
  $monday = date("Y-m-d",strtotime("monday this week"));
  $saturday = date("Y-m-d",strtotime("saturday this week"));
}
  $last_query = "(SELECT COALESCE(COUNT(*),0) as count,COALESCE(P.sum,0) as plan,S.session_user_id,S.school_id,U.name from session_completed as S
  INNER JOIN user as U on S.session_user_id = U.user_id
  LEFT JOIN (SELECT SUM(total) as sum,teacher_id,school_id from plans where delete_flag=0 and from_date>='{$last_monday}' and  to_date<='{$last_saturday}' group by teacher_id,school_id) as P
  ON P.teacher_id= S.session_user_id and P.school_id= S.school_id
  where S.school_id in ({$_SESSION['school_id']}) and S.delete_flag=0 and session_date>='{$last_monday}' and session_date<='{$last_saturday}'
  group by session_user_id,school_id,U.name,P.sum order by session_user_id,school_id)
  UNION 
  (SELECT COALESCE(COUNT(*),0) as count,COALESCE(P.sum,0) as plan,S.session_user_id,S.school_id,U.name from session_completed as S
  INNER JOIN user as U on S.session_user_id = U.user_id
  RIGHT JOIN (SELECT SUM(total) as sum,teacher_id,school_id from plans where delete_flag=0 and from_date>='{$last_monday}' and  to_date<='{$last_saturday}' group by teacher_id,school_id) as P
  ON P.teacher_id= S.session_user_id and P.school_id= S.school_id
  where S.school_id in ({$_SESSION['school_id']}) and S.delete_flag=0 and session_date>='{$last_monday}' and session_date<='{$last_saturday}'
  group by session_user_id,school_id,U.name,P.sum order by session_user_id,school_id) ";


  $last_res = mysqli_query($con,$last_query) or die(mysqli_error($con));

  $this_query = "(SELECT COALESCE(COUNT(*),0) as count,COALESCE(P.sum,0) as plan,S.session_user_id,S.school_id,U.name from session_completed as S
  INNER JOIN user as U on S.session_user_id = U.user_id
  LEFT JOIN (SELECT SUM(total) as sum,teacher_id,school_id from plans where delete_flag=0 and from_date>='{$monday}' and  to_date<='{$saturday}' group by teacher_id,school_id) as P
  ON P.teacher_id= S.session_user_id and P.school_id= S.school_id
  where S.school_id in ({$_SESSION['school_id']}) and S.delete_flag=0 and session_date>='{$monday}' and session_date<='{$saturday}'
  group by session_user_id,school_id,U.name,P.sum order by session_user_id,school_id)
  UNION 
  (SELECT COALESCE(COUNT(*),0) as count,COALESCE(P.sum,0) as plan,S.session_user_id,S.school_id,U.name from session_completed as S
  INNER JOIN user as U on S.session_user_id = U.user_id
  RIGHT JOIN (SELECT SUM(total) as sum,teacher_id,school_id from plans where delete_flag=0 and from_date>='{$monday}' and  to_date<='{$saturday}' group by teacher_id,school_id) as P
  ON P.teacher_id= S.session_user_id and P.school_id= S.school_id
  where S.school_id in ({$_SESSION['school_id']}) and S.delete_flag=0 and session_date>='{$monday}' and session_date<='{$saturday}'
  group by session_user_id,school_id,U.name,P.sum order by session_user_id,school_id)";


  $this_res = mysqli_query($con,$this_query) or die(mysqli_error($con));

 ?>
  <link rel="stylesheet" href="style.css">
  <div class="container-fluid">
    <h4 class="top light text-center">Teacher Performance</h4><hr>

    <div class="row justify-content-center">
      <div class="col-md-2 col-sm-3 col-4">
        <h5 class="light">From</h5>
        <input id='from' type="date" class="form-control" name="from_date" / >
      </div>
      <div class="col-md-2 col-sm-3 col-4">
        <h5 class="light">To</h5>
        <input id='to' type="date" class="form-control" name="to_date" / >
      </div>
      <div class="col-md-2 col-sm-3 col-4">
        <button id="search" class="btn btn-md btn-primary">Search</button>
      </div>
    </div>
    <div id="table" class="row justify-content-center">
      <div style="padding:20px; margin-bottom:10px" class="col-sm-6 table-responsive">
        <h4 class="light text-center">Last Week</h4>
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
            <?php while ($last_row = mysqli_fetch_assoc($last_res)) { ?>
              <tr>
                <td><?php echo $last_row['session_user_id'] ?></td>
                <td><?php echo $last_row['name'] ?></td>
                <td><?php echo $_SESSION['exp_dash_schools'][$last_row['school_id']] ?></td>
                <td><?php echo $last_row['plan'] ?></td>
                <td><?php echo $last_row['count'] ?></td>
              </tr>
            <?php } ?>
            
          </tbody>
        </table>
      </div>
      <div style="padding:20px; margin-bottom:10px" class="col-sm-6 table-responsive">
        <h4 class="light text-center">This Week</h4>
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
            <?php while ($this_row = mysqli_fetch_assoc($this_res)) { ?>
              <tr>
                <td><?php echo $this_row['session_user_id'] ?></td>
                <td><?php echo $this_row['name'] ?></td>
                <td><?php echo $_SESSION['exp_dash_schools'][$this_row['school_id']] ?></td>
                <td><?php echo $this_row['plan'] ?></td>
                <td><?php echo $this_row['count'] ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="main.js"></script>
 <?php
  require '../footer.php';
  ?>
