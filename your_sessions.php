<?php
require_once('connection.php');
require('check_login.php');
require_once('head.php');
$project_names_query = "SELECT id,name from project where delete_flag=0";
$project_names_res = mysqli_query($con,$project_names_query) or die(mysqli_error($con));
while($p_row = mysqli_fetch_assoc($project_names_res)){
    $project_names[$p_row['id']] = $p_row['name'];
}

$session_names_query = "SELECT id,session_type from session_type";
$session_names_res = mysqli_query($con,$session_names_query) or die(mysqli_error($con));
while($s_row = mysqli_fetch_assoc($session_names_res)){ 
    $session_names[$s_row['id']] = $s_row['session_type'];
}

//program names
if(!isset($_SESSION['program_names'])){
$programs_query = "SELECT id,name from program where delete_flag=0";
$programs_res = mysqli_query($con,$programs_query) or die(mysqli_error($con));

while($prog_row = mysqli_fetch_assoc($programs_res)) {
  $_SESSION['program_names'][$prog_row['id']]=$prog_row['name'];
 }
}
//fetching sessions by the user
$current_year = date("Y");

if(isset($_GET['session']) && is_numeric($_GET['session'])){
    $session_from = date("Y",strtotime("-{$_GET['session']} year"))."-04-01";
    $session_to = date("Y",strtotime("+12 months $session_from"))."-03-31";
}else{
    $session_from = date("Y")."-04-01";
    $session_to = date("Y",strtotime("+12 months $session_from"))."-03-31";
}

//die($session_from."------".$session_to);

$user_sessions_query = "SELECT * from session_completed ";
$date_compare=  " session_date>'{$session_from}' and session_date<'{$session_to}' ";
// viewing by permission level
// starting from top level
if(in_array("6",$_SESSION['permissions'])){
  $user_sessions_query.= " where  {$date_compare}";
}elseif(in_array("5",$_SESSION['permissions'])){
  $user_sessions_query.= " where project_id in(".$_SESSION['projects'].") and {$date_compare} ";
}elseif(in_array("4",$_SESSION['permissions'])){
  $user_sessions_query.= " where school_id in(".$_SESSION['school_id'].") and {$date_compare} ";
}elseif(in_array("3",$_SESSION['permissions'])){
  $user_sessions_query.= " where school_id in(".$_SESSION['school_id'].") and project_id in(".$_SESSION['projects'].") and {$date_compare} ";
}else{
  $user_sessions_query.= " where session_user_id='".$_SESSION['exp_dash_id']."' and {$date_compare} ";
}
$user_sessions_query.= " order by session_date";
$user_sessions_res=mysqli_query($con,$user_sessions_query) or die(mysqli_error($con));
$current_year = (int)$current_year;

?>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<div class="container-fluid" style="padding-top:20px">
  <h3 class="light" align="center"><?php echo $_SESSION['exp_dash_name']."'s";?> Sessions</h3>
  <hr>
  <form action="" method="GET">
  <div class="row justify-content-center">
    
        <div class="col-6 col-sm-4">
            <h4 class="light" style="float:right; margin-right:20px">Academic Session:</h4>
        </div>
         <div class="col-3 col-sm-3">
            <select name="session" style="max-width:200px; padding:3px 7px" class="form-control">
                <?php
                    for($i=0;$current_year > 2017;$i++){
                ?>
                <option <?php 
                    if(isset($_GET['session']) && $_GET['session'] == $i)
                    echo "selected";
                ?> value="<?php echo $i; ?>"><?php echo $current_year."-".($current_year+1); ?></option>
                 <?php
                     $current_year--;
                }
                ?>
            </select>
        </div>
    <div class="col-3">
        <input type="submit" value="Search" class='btn btn-primary btn-md'></input>
    </div>
    
  </div>
  </form>
  <hr>
  <div class="container-fluid">
    <div class=' table table-responsive' style='overflow:auto'>
      <table id='session_table' class="table">
        <thead style='background-color: #1c2a48 !important'>
        <tr style="color:white">
          <th>User</th>
          <th>Date</th>
          <th>Grade</th>
          <th>Project</th>
          <th>Program</th>
          <th>Session Type</th>
          <th>Module</th>
          <th>View</th>
          <th>Edit</th>
          <th>Copy</th>
          <th>Uploads</th>
        </tr>
      </thead>
        <?php
        while($user_sessions_row = mysqli_fetch_assoc($user_sessions_res)){
          $session_type_whole = "";
          ?>
          <tr>
            <td><?php echo $user_sessions_row['session_user_id']; ?></td>
            <td><span style='display:none'><?php echo $user_sessions_row['session_date']; ?></span><?php echo date('d-m-Y', strtotime($user_sessions_row['session_date'])); ?></td>
            <td><?php echo $user_sessions_row['grade']."-".$user_sessions_row['section']; ?></td>
            <td><?php echo $project_names[$user_sessions_row['project_id']]; ?></td>
            <td><?php echo $_SESSION['program_names'][$user_sessions_row['program']]; ?></td>
            <td><?php foreach (explode(",",$user_sessions_row['session_type']) as $session_part) {
              $session_type_whole.=$session_names[$session_part].",";
            } echo trim($session_type_whole,","); ?></td>
            <td><?php echo $_SESSION['module_name'][$user_sessions_row['module_id']]; ?></td>
            <td><a href="view_session.php?id=<?php echo $user_sessions_row['sno']; ?>">View</a></td>
            <td>
              <?php
               if($_SESSION['exp_dash_id']==$user_sessions_row['session_user_id']){ ?>
                <a href="edit_session.php?id=<?php echo $user_sessions_row['sno']; ?>">Edit</a>
              <?php }else{?> Not Allowed <?php } ?>
            </td>
            <td>
                <a href="add_session.php?cpyid=<?php echo $user_sessions_row['sno']; ?>">Copy</a>
            </td>
            <td>
              <?php if($user_sessions_row['upload_flag']==1){ ?>
              <a href="gallery/gallery.php?serial=<?php echo $user_sessions_row['sno']; ?>&session_user_id=<?php echo $user_sessions_row['session_user_id']; ?>">Uploads</a>
            <?php }else{echo "No uploads";} ?>
            </td>
          </tr>
        <?php }
        ?>
      </table>
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
    $("#session_table").DataTable({
      "aaSorting": []
    });
  });
</script>
