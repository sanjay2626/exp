<?php
if(isset($_GET['pid']) && $_GET['pid'] !== ""){

  $projects = $_GET['pid'];
  
  
  
   $query = "SELECT * FROM project where id=$projects";
  
  $result = $con -> query($query);
  
  $projectdata = $result->fetch_assoc();
  
  $tags = explode(',' , $_SESSION['projects']);
  
  
  
  if(!empty($projectdata)){
  
  $title = $projectdata['name'];
  
  $description = $projectdata['description'];
  
  $more = 'Click here For More details...';
  
  }else{
  
  $projects = $_SESSION['projects'];
  
  $description = 'All projects';
  
  $title = 'All projects';
  
  $more = '';
  
  }
  
  }else{
  
  
  
  $projects = $_SESSION['projects'];
  
  
  
  $description = 'All projects';
  
   $title = 'All projects';
  
   $more = '';
  
  }
  
  $prog_query = "SELECT program_id from project where id in ({$projects}) and delete_flag=0";
  
  $prog_res = mysqli_query($con,$prog_query) or die(mysqli_error($con));
  
  $prog_arr = [];
  
  while ($prog_row = mysqli_fetch_assoc($prog_res)) {
  
  foreach (explode(",",$prog_row['program_id']) as $program) {
  
  if(!in_array($program,$prog_arr)){
  
    array_push($prog_arr,$program);
  
  }
  
  }
  
  }
  
  $programs = join(",",$prog_arr);
  
  $module_query = "SELECT module_list from program where id in ($programs) and delete_flag=0";
  
  $module_res = mysqli_query($con,$module_query) or die(mysqli_error($con));
  
  $module_arr = [];
  
  while ($module_row = mysqli_fetch_assoc($module_res)) {
  
  foreach (explode(",",$module_row['module_list']) as $module) {
  
  if(!in_array($module,$module_arr)){
  
    array_push($module_arr,$module);
  
  }
  
  }
  
  }
  
  $session_count = mysqli_fetch_row(mysqli_query($con,"SELECT count(*) from session_completed where project_id in ({$projects})"))[0];
?>  
<div  class=" top container-fluid" style="background: #C00000 !important;">

      <div style="padding:10px" class="row justify-content-center">

        <?php if(!isset($_GET['pid']) || $_GET['pid'] == ""){ ?>

        <div class="col-3">

          <h1  class="incremental"><?php echo sizeof(explode(",",$_SESSION['projects'])); ?></h1>

          <h4 class="c">Project<?php if(sizeof(explode(",",$_SESSION['projects']))>1){echo "s";} ?></h4>

        </div>

        <?php } ?>

        <div class="col-3">

          <h1  class="incremental"><b><?php echo sizeof($prog_arr); ?></b></h1>

          <h4 class="c"><b>Program<?php if(sizeof($prog_arr)>1){echo "s";} ?></b></h4>

        </div>

        <div class="col-3">

          <h1  class="incremental"><b><?php echo sizeof($module_arr); ?></b></h1>

          <h4 class="c"><b>Module<?php if(sizeof($module_arr)>1){echo "s";} ?></b></h4>

        </div>

        <div class="col-3">

          <h1  class="incremental"><b><?php echo $session_count; ?></b></h1>

          <h4 class="c"><b>Sessions</b></h4>

        </div>

      </div>

    </div>

  <div class="p-5 bg-primary text-white text-center" style="background-color: #FF9966 !important;">

      <div  class="Container">

        <div class="row">

        <div class="col-md-2" style="display: flex;">

          <?php if(!empty($projectdata['projectlogo'])){ ?>

          <div style="padding-right: 8px;"><img src="uploads/projectLogo/<?php echo $projectdata['projectlogo']; ?>" style="width: 160px;height: 50px;"></div>

          <?php } ?>



          <?php if(!empty($projectdata['projectlogo2'])){ ?>

           <div><img src="uploads/projectLogo2/<?php echo $projectdata['projectlogo2']; ?>" style="width: 160px;height: 50px;"> </div> 

          <?php } ?> </div>  <div class="col-md-8"> <h1><?php echo $title; ?></h1></div>  <div class="col-md-2"><img src="https://i.postimg.cc/KcPmbGz7/download.png"> <img src="https://i.postimg.cc/L64FMjGR/print.png"> <img src="https://i.postimg.cc/CKGc1Qf2/share.png"> </div>

      </div>

      </div>  

  

  <p><?php echo $description; ?></p>





  <p style="text-align: end;color: darkorange;"><a href="project.php?pid=<?php echo $_GET['pid']; ?>"><?php echo $more ?></a></p> 

</div>
