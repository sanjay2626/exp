<?php
  include('connection.php'); 
  require('check_login.php');
  if(!empty($_GET['id'])){
    //checking whether session belongs to user or not
    $user_confirmation = "SELECT * from session_completed where sno=".$_GET['id'];
    $check = mysqli_query($con,$user_confirmation) or die(mysqli_error($con));
    $row = mysqli_fetch_assoc($check);
    if( $row['session_user_id']!= $_SESSION['exp_dash_id'] and !in_array("6",$_SESSION['permissions']) and !(in_array("5",$_SESSION['permissions']) and (in_array($row['project_id'],explode(",",$_SESSION['projects'])))) and !(in_array("4",$_SESSION['permissions']) and (in_array($row['school_id'],explode(",",$_SESSION['school_id'])))) and !(in_array("3",$_SESSION['permissions']) and (in_array($row['project_id'],explode(",",$_SESSION['projects']))) and (in_array($row['school_id'],explode(",",$_SESSION['school_id']))) )){
      //header("location:http://dashboard.experifun.com/your_sessions.php");
    }
    else{
      $query = "SELECT * from session_completed where sno=".$_GET['id'];
      $check = mysqli_query($con,$query) or die(mysqli_error($con));
      $project_names_query = "SELECT id,name from project";
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
      $programs_query = "SELECT id,name from program";
      $programs_res = mysqli_query($con,$programs_query) or die(mysqli_error($con));

      while($prog_row = mysqli_fetch_assoc($programs_res)) {
        $_SESSION['program_names'][$prog_row['id']]=$prog_row['name'];
      }
      
      include('head.php');
      ?>
<style>
  #pdf_button{
    position:absolute;
    z-index:1000 !important;
    height: 40px;
    width: 40px;
    border-radius:50%;
    background-color: #0074D9;
    display:flex;
    justify-content: center;
    align-items: center;
    color:white;
    cursor: pointer;
    box-shadow: 1px 1px 8px rgba(0,0,0,1);
  }
</style>

<div class="container-fluid" id="print_div" style="padding-top:20px; position:relative">
<span id="pdf_button"><i class="far fa-save "></i></span>
  <h3 style="position:relative; z-index:0 !important" class="light" align="center">Session Details</h3>
  <hr>

        <div style="color:#0074D9" class="row justify-content-center">
          <?php $i=0; for( ; $i<$row['rate']; $i++){ ?>
          <i class="fa fa-star"></i>
          <?php } for(; $i<10; $i++){ ?>
          <i class="far fa-star"></i>
          <?php } ?>
        </div>
        <hr>
  <div class="table-responsive">
    <table class="table-bordered table">
      <tr>
        <td>School</td>
        <td><?php 
        $sch_name_query = "SELECT name from school where id=".$row['school_id'];
        $sch_query_res = mysqli_query($con,$sch_name_query);
        $name = mysqli_fetch_assoc($sch_query_res);
        echo $name['name'];  ?></td>
      </tr>
      <tr>
        <td>Language</td>
        <td><?php $language = mysqli_fetch_row(mysqli_query($con,"SELECT language from languages where language_id=".$row['language_id']));
        echo $language[0]; ?></td>
      </tr>
      <tr>
        <td>Board</td>
        <td><?php $batch = mysqli_fetch_row(mysqli_query($con,"SELECT board_name from boards where board_id=".$row['board_id']));
        echo $batch[0]; ?></td>
      </tr>
      <tr>
        <td>Date</td>
        <td><?php echo date("d-m-Y",strtotime($row['session_date'])); ?></td>
      </tr>
      <tr>
        <td>Timing</td>
        <td><?php echo date("g:i A", strtotime($row['from_time']))."-".date("g:i A", strtotime($row['to_time'])); ?></td>
      </tr>
      <tr>
        <td>Project</td>
        <td><?php echo $project_names[$row['project_id']]; ?></td>
      </tr>
      <tr>
        <td>Program</td>
        <td><?php echo $_SESSION['program_names'][$row['program']]; ?></td>
      </tr>
      <tr>
        <td>Session Type</td>
        <td><?php $session_type_whole=""; foreach (explode(",",$row['session_type']) as $session_part) {
              $session_type_whole.=$session_names[$session_part].",";
            } echo trim($session_type_whole,","); ?></td>
      </tr>
      <tr>
        <td>Module</td>
        <td><?php echo $_SESSION['module_name'][$row['module_id']]; ?></td>
      </tr>
      <tr>
        <td>Grade</td>
        <td><?php echo $row['grade']."-".$row['section']; ?></td>
      </tr>
      <tr>
        <td>Batch Size</td>
        <td><?php echo $row['batch_size']; ?></td>
      </tr>
      <tr>
        <td>Attendance Count:</td>
        <td><?php echo $row['student_count']; ?></td>
      </tr>
      <tr>
        <td>Session Summary:</td>
        <td> <?php echo $row['session_summary']; ?></td>
      </tr>
      <tr>
        <td>Issues</td>
        <td><?php if(!empty($row['issues'])){ 
         echo $row['issues']; 
        }else{ echo "None"; }?></td>
      </tr>
    </table>
  </div>
  
</div>
<?php
    }
  }
?>
<script>
  $("#pdf_button").on("click",printer);

  function printer(){
    var divElements = document.getElementById("print_div").innerHTML;
    var oldPage = document.body.innerHTML;
    document.body.innerHTML = 
    "<html><head><title></title></head><body>" + 
    divElements + "</body>";
    window.print();
    document.body.innerHTML = oldPage;
    $("#pdf_button").on("click",printer);
  }
</script>