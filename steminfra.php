<?php  

    if(isset($_GET['pid']) && $_GET['pid'] !== ""){
        $projects = $_GET['pid'];

         $query = "SELECT * FROM project where id=$projects";
   $result = $con -> query($query);
   $projectdata = $result->fetch_assoc();

//print_r($projectdata); exit;
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
    //Chart query all except session type
    $chart_query_all = "SELECT count(*) as count,project.name as project, program.name as program,module.name as module,module.subject as subject,school.name as school
    from session_completed
    inner join project on session_completed.project_id = project.id
    inner join module on session_completed.module_id = module.id
    INNER JOIN school on session_completed.school_id = school.id
    INNER JOIN program on session_completed.program = program.id
    where project_id in ({$projects})
    group by project_id,program,module_id,school_id";
    $chart_query_res = mysqli_query($con,$chart_query_all);
    while($row = mysqli_fetch_assoc($chart_query_res)){
//print_r($row);
      if(isset($chart['project'][$row['project']])){
        $chart['project'][$row['project']]+= $row['count'];
      }else{
        $chart['project'][$row['project']]= $row['count'];
      }
      if(isset($chart['program'][$row['program']])){
        $chart['program'][$row['program']]+= $row['count'];
      }else{
        $chart['program'][$row['program']]= $row['count'];
      }
      if(isset($chart['module'][$row['module']])){
        $chart['module'][$row['module']]+= $row['count'];
      }else{
        $chart['module'][$row['module']]= $row['count'];
      }

      if(isset($chart['school'][$row['school']])){
        $chart['school'][$row['school']]+= $row['count'];

      }else{
        $chart['school'][$row['school']]= $row['count'];
      }

    }


    
    $project_names_query = "SELECT id,name from project where id in ({$_SESSION['projects']})";
    $project_names_query_res = mysqli_query($con,$project_names_query) or die(mysqli_error($con));
    while($project_row = mysqli_fetch_assoc($project_names_query_res)){
      $project_names[$project_row['id']] = $project_row['name'];
    }
    $chart_grade_query = "SELECT COUNT(*) AS count,school.name as school,grade FROM session_completed
    INNER JOIN school on
    session_completed.school_id = school.id
    where project_id in ({$projects}) group by grade,school";
    $chart_grade_query_res = mysqli_query($con,$chart_grade_query) or die(mysqli_error($con));
    while($grade_row = mysqli_fetch_assoc($chart_grade_query_res)){


      $chart_grade[$grade_row['school']][$grade_row['grade']] = $grade_row['count'];
      isset($chart_grade['total'][$grade_row['grade']])?$chart_grade['total'][$grade_row['grade']]+=$grade_row['count']:$chart_grade['total'][$grade_row['grade']]=$grade_row['count'];
    }

    $grade_subject_query = "SELECT COUNT(*) as count, grade, module.Subject as subject from session_completed
    INNER JOIN module on session_completed.module_id = module.id
    where project_id in ({$projects})
    group by grade,module.subject";
    $grade_subject_res = mysqli_query($con,$grade_subject_query) or die(mysqli_error($con));
    while ($grade_subject_row = mysqli_fetch_assoc($grade_subject_res)) {
      $grade_subject[$grade_subject_row['subject']][$grade_subject_row['grade']] = $grade_subject_row['count'];
     
    }


     // echo "<pre>";print_r($grade_subject);echo "<pre>";


    $chart_grade_query2 = "SELECT COUNT(*) AS count,nboys, student_count.nboys as nboys , student_count.ngirls as ngirls, school.state as state FROM session_completed
    INNER JOIN student_count on session_completed.school_id = student_count.schoolid
    INNER JOIN school on session_completed.school_id = school.id
    where project_id in ({$projects}) group by nboys,ngirls,state";
    $chart_grade_query_res2 = mysqli_query($con,$chart_grade_query2) or die(mysqli_error($con));
    while($grade_row2 = mysqli_fetch_assoc($chart_grade_query_res2)){


      if(isset($chart_grade2['state'][$grade_row2['state']])){
        $chart_grade2['state'][$grade_row2['state']]+= $grade_row2['count'];
      }else{
        $chart_grade2['state'][$grade_row2['state']]= $grade_row2['count'];
      }

     
     // $chart_grade2[$grade_row2['state']][$grade_row2['nboys']] = $grade_row2['count'];
     //  isset($chart_grade2['state'][$grade_row2['state']])?$chart_grade2['state'][$grade_row2['state']]+=$grade_row2['state']:$chart_grade2['nboys'][$grade_row2['nboys']]=$grade_row2['count'];
      //print_r($grade_row2);
    }



    ?>
    <script>
      <?php if($chart != null){ ?>
var chart_array = <?php echo json_encode($chart); ?>;
     <?php }else{ ?>
var chart_array = 'null';
     <?php } ?>
     
     var chart_grade = <?php echo json_encode($chart_grade); ?>;
     var chart_grade2 = <?php echo json_encode($chart_grade2); ?>;
     var grade_subject = <?php echo json_encode($grade_subject); ?>;
    </script>
    <style>

      .fontcolor{
        color: white;
      }

      th#School2 {
         font-weight: 600;
    width: 25%;
}
      th#stemstatus {
    width: 112px !important;
    }
      th#city {
        font-weight: 600;
        width: 142px !important
     }

     th#school {
      font-weight: 600;
    width: 306px;
    }

      .table thead th {
    vertical-align: middle !important;
    border-bottom: 1px solid #0C0101 !important;
}
      
      .table-bordered td, .table-bordered th {
    border: 1px solid #01060c;
    }
      th {
    padding: 1px 12px !important;
    }
      .padd{
        padding:2px 10px !important
      }
     
      .wpimg {
    width: 23px;
    height: 23px;
    margin-left: 12px;
}
      .top{

        background: #311b92;
        color: white;
        padding-top: 10px;
        padding-bottom: 10px
      }
      h4.c,.incremental{
        text-align: center;
        font-weight: lighter;
      }
      .section{
        padding:15vh 30px;
      }
      .section-half{
        padding:10vh 30px;
      }
      canvas.full{
        padding:20px;
        box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2)
      }
      h2.head{
        text-align: center;
        margin-bottom:10vh
      }
      h2,h3{
        font-weight: lighter;
      }
      select{
          margin-bottom:10px;
      }

      .navbar-dark .navbar-nav .nav-link {
    color: rgb(12 40 145 / 50%);
       }
       .nav-link:focus, .nav-link:hover {
    text-decoration: initial;
    color: black !important;
}
th p {
    margin-bottom: 0px;
}
span#basic-addon1 {
    padding: 4px 2px 4px 4px;
}

    </style>

    <style>
.input-group-addon{color:#ff0000; background-color: #ffffff;}
</style>

  <!--   <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
<div  class=" top container-fluid">
      <div style="padding:10px" class="row justify-content-center">
        <?php if(!isset($_GET['pid']) || $_GET['pid'] == ""){ ?>
        <div class="col-3">
          <h1  class="incremental"><?php echo sizeof(explode(",",$_SESSION['projects'])); ?></h1>
          <h4 class="c">Project<?php if(sizeof(explode(",",$_SESSION['projects']))>1){echo "s";} ?></h4>
        </div>
        <?php } ?>
        <div class="col-3">
          <h1  class="incremental"><?php echo sizeof($prog_arr); ?></h1>
          <h4 class="c">Program<?php if(sizeof($prog_arr>1)){echo "s";} ?></h4>
        </div>
        <div class="col-3">
          <h1  class="incremental"><?php echo sizeof($module_arr); ?></h1>
          <h4 class="c">Module<?php if(sizeof($module_arr>1)){echo "s";} ?></h4>
        </div>
        <div class="col-3">
          <h1  class="incremental"><?php echo $session_count; ?></h1>
          <h4 class="c">Sessions</h4>
        </div>
      </div>
    </div>
  <div class="p-5 bg-primary text-white text-center" style="background-color: #343a40 !important;">
      <div  class="Container">
        <div class="row">
        <div class="col-md-2" style="display: flex;">
          <?php if(!empty($projectdata['projectlogo'])){ ?>
          <div style="padding-right: 8px;"><img src="uploads/projectLogo/<?php echo $projectdata['projectlogo']; ?>" style="width: 160px;height: 50px;"></div>
          <?php } ?>

          <?php if(!empty($projectdata['projectlogo2'])){ ?>
           <div><img src="uploads/projectLogo2/<?php echo $projectdata['projectlogo2']; ?>" style="width: 160px;height: 50px;"> </div> 
          <?php } ?> </div>
           <div class="col-md-8"> <h1><?php echo $title; ?></h1></div>  <div class="col-md-2"><img src="https://i.postimg.cc/KcPmbGz7/download.png" onclick="generate();"> <img src="https://i.postimg.cc/L64FMjGR/print.png" onclick="window.print()"> <img src="https://i.postimg.cc/CKGc1Qf2/share.png"> </div>
      </div>
      </div>  
  
  <p><?php echo $description; ?></p>


  <p style="text-align: end;color: darkorange;"><a href="project.php?pid=<?php echo $_GET['pid']; ?>"><?php echo $more ?></a></p> 
</div>
<center>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark" style="background-color: #ffffff!important;
">

  <div class="container-fluid">
    <ul class="nav justify-content-end">
      <li class="nav-item">
        <a class="nav-link" href="add_data.php?pid=<?php echo $_GET['pid']; ?>">Add School Data</a>
      </li>
      
    </ul>
  </div>

</nav>
  </center>

    
    <?php if($_SESSION['exp_dash_id']=="Rakesh"){ ?>
    <div class="container">
        <div class="row justify-content-center" style="margin-bottom:10px">
            <h3 style="padding:15px" class="head">Project</h3>
        </div>
               <div class="row justify-content-center">
            <select id='project_drop' class="form-control" style="max-width:200px">
                <option value="">All</option>
                <?php 
                    foreach($project_names as $id => $name){
                ?>
                <option <?php if(isset($_GET['pid']) && $_GET['pid'] == $id){ echo "selected"; } ?> value="<?php echo $id; ?>"><?php echo $name; ?></option>
                <?php
                    }
                ?>
            </select>
        </div>
        <div class="row justify-content-center" style="margin-bottom:10px">
            <button id='stats_button' class="btn btn-primary btn-md">View Stats</button>
        </div>
    </div><hr>
<?php } ?>
    
    <?php if($_GET['pid'] =='5744'){ ?>
    <div class="container">
   <div class="row">
        
      <table class="table table-bordered">
    <thead>
      <tr style="text-align: center;  background-color: #a39cdf;"> 
       <th colspan="10" ><p>STEM Lab Infra - STC BLR</p></th>
       </tr>
  <tr>
    <th style="width: 0px;"></th>
    <th></th>
    <th>Electric Work</th>
    <th>Model Desk  </th>
    <th>Cupboard</th>
    <th>Solar power</th>
    <th>Before</th>
    <th>WIP</th>
     <th>After</th>
  </tr>
<?php 
$infradata2 = "select * from project_school inner join school on school.id=project_school.school_id where project_school.project_id = '".$_GET['pid']."' and school.id in(".$_SESSION['school_id'].") and project_school.delete_flag=0 order by school.city";

// $infradata2 = "select * from stem_models_data inner join school on school.id=stem_models_data.schoolid  where stem_models_data.user_id = '".$_SESSION['exp_dash_id']."' and stem_models_data.projectid = '".$_GET['pid']."' and school.delete_flag=0 order by school.city";
 $result2 = $con -> query($infradata2);
 $i=0; 
while($data2=mysqli_fetch_assoc($result2)){
  $row2[$i]=$data2;
  $i++;
}
foreach($row2 as $steminfra2){
  if(isset($total2[$steminfra2['city']]['jml'])) { 
    $total2[$steminfra2['city']]['jml']++; 
  }else{
    $total2[$steminfra2['city']]['jml']=1; 
  } 
}


 $n2=count($row2);
 $cekinstansi2="";
for($i=0;$i<$n2;$i++){
 $steminfra2=$row2[$i];

 $stem_models_data = "select * from stemlabinfrastc inner join school on school.id=stemlabinfrastc.schoolid where stemlabinfrastc.schoolid = '".$steminfra2['school_id']."'  order by school.city";


$result_stem_models_data = $mysqli->query($stem_models_data);
$row_stem_models_data = $result_stem_models_data->fetch_assoc();
 $rows2 = mysqli_num_rows($result2); 
  $EWork_progress = $row_stem_models_data['EWork_progress'];

  // if (($value > 1 && $value < 10) || ($value > 20 && $value < 40))

  if($EWork_progress>=100){
   $EWork_progressclr = '#70AD47';
  }elseif($EWork_progress>100 || $EWork_progress>=1){
   $EWork_progressclr = '#1DA29F';
  }else{
    $EWork_progressclr = '#F83E6A';
  }



  $modelDesks_progress = $row_stem_models_data['modelDesks_progress'];
  if($modelDesks_progress>=100){
   $modelDesks_progressclr = '#70AD47';
  }elseif($modelDesks_progress>100 || $modelDesks_progress>=1){
   $modelDesks_progressclr = '#1DA29F';
  }else{
    $modelDesks_progressclr = '#F83E6A';
  }

  $cupboard_progress = $row_stem_models_data['cupboard_progress'];
  if($cupboard_progress>=100){
   $cupboard_progressclr = '#70AD47';
  }elseif($cupboard_progress>100 || $cupboard_progress>=1){
   $cupboard_progressclr = '#1DA29F';
  }else{
    $cupboard_progressclr = '#F83E6A';
  }


  $Solar_progress = $row_stem_models_data['Solar_progress'];
  if($Solar_progress>=100){
   $Solar_progressclr = '#70AD47';
  }elseif($Solar_progress>100 || $Solar_progress>=1){
   $Solar_progressclr = '#1DA29F';
  }else{
    $Solar_progressclr = '#F83E6A';
  }

 ?>
<tr>
   <?php
if($cekinstansi2!=$steminfra2['city']){
    echo '<th id="city"' .($total2[$steminfra2['city']]['jml']>1?' rowspan="' .($total2[$steminfra2['city']]['jml']).'" >':'>') .$steminfra2['city'].'</th>';
    $cekinstansi2=$steminfra2['city'];
  }
   ?>

    <th id="school"><a href="editdata.php?schoolid=<?php echo $steminfra2['school_id']; ?>&moduleid=172&pid=<?php echo $_GET['pid']; ?>"><?php echo $steminfra2['name']; ?></a></th>

    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $EWork_progressclr; ?>;"><?php if(!empty($row_stem_models_data['EWork_progress'])){ if($row_stem_models_data['EWork_progress']=='NA'){ echo "NA";}else{ echo $row_stem_models_data['EWork_progress'].'%';}  }else{ echo "0%";}  ?></th>

    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $modelDesks_progressclr; ?>;"><?php if(!empty($row_stem_models_data['modelDesks_progress'])){ if($row_stem_models_data['modelDesks_progress']=='NA'){ echo "NA";}else{ echo $row_stem_models_data['modelDesks_progress'].'%';}  }else{ echo "0%";}  ?></th>

    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $cupboard_progressclr; ?>;"><?php if(!empty($row_stem_models_data['cupboard_progress'])){ if($row_stem_models_data['cupboard_progress']=='NA'){ echo "NA";}else{ echo $row_stem_models_data['cupboard_progress'].'%';}  }else{ echo "0%";}  ?></th>

    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $Solar_progressclr; ?>;"><?php if(!empty($row_stem_models_data['Solar_progress'])){ if($row_stem_models_data['Solar_progress']=='NA'){ echo "NA";}else{ echo $row_stem_models_data['Solar_progress'].'%';}  }else{ echo "0%";}  ?></th>




     <th class="fontcolor" id="stemstatus"><a target="_blank" href="StemStcBefore.php?schoolid=<?php echo $row_stem_models_data['schoolid']; ?>&user=<?php echo $row_stem_models_data['user_id']; ?>&school2=<?php echo $steminfra2['school_id']; ?>"><img src="https://i.postimg.cc/zvhWkmCP/imgicon.png" class="wpimg"></a></th>
     
     <th class="fontcolor" id="stemstatus"><a target="_blank" href="StemStcWip.php?schoolid=<?php echo $row_stem_models_data['schoolid']; ?>&user=<?php echo $row_stem_models_data['user_id']; ?>&school2=<?php echo $steminfra2['school_id']; ?>"><img src="https://i.postimg.cc/zvhWkmCP/imgicon.png" class="wpimg"></a></th>

     <th class="fontcolor" id="stemstatus"><a target="_blank" href="StemStcAfter.php?schoolid=<?php echo $row_stem_models_data['schoolid']; ?>&user=<?php echo $row_stem_models_data['user_id']; ?>&school2=<?php echo $steminfra2['school_id']; ?>"><img src="https://i.postimg.cc/zvhWkmCP/imgicon.png" class="wpimg"></a></th>
    
  </tr>
 <?php  }  ?>
</thead>
    </tbody>
  </table>
  
      </div>
    </div>
<?php }else{  ?>
    <div class="container">
      <div class="row">
        
      <table class="table table-bordered">
    <thead>
      <tr style="text-align: center;  background-color: #a39cdf;"> 
       <th colspan="10" ><p>Location-Wise Infra Status</p></th>
       </tr>
      
  <tr>
   
    <th></th>
    <th></th>
    <th>Electricals</th>
    <th>Painting</th>
    <th>Model Desks</th>
    <th>Cupboards</th>
    <th>Flooring</th>
    <th>Before</th>
    <th>WIP</th>
    <th>After</th>
  </tr> 
<?php 

$infradata = "select * from project_school inner join school on school.id=project_school.school_id where project_school.project_id = '".$_GET['pid']."' and school.id in(".$_SESSION['school_id'].") and project_school.delete_flag=0 order by school.city";
//print_r($infradata); exit;
// $infradata = "select * from stem_lab_infra_data 
// inner join school on school.id=stem_lab_infra_data.schoolid
// inner join project_school on project_school.school_id=stem_lab_infra_data.schoolid 
//  where stem_lab_infra_data.user_id = '".$_SESSION['exp_dash_id']."' and stem_lab_infra_data.projectid = '".$_GET['pid']."' and project_school.delete_flag=0 order by school.city";

 $result = $con -> query($infradata);
$i=0; 
while($data=mysqli_fetch_assoc($result)){
  $row[$i]=$data;
  $i++;
}

foreach($row as $steminfra){
 // print_r($steminfra); exit;
  if(isset($total[$steminfra['city']]['jml'])) { 
    $total[$steminfra['city']]['jml']++; 
  }else{
    $total[$steminfra['city']]['jml']=1; 
  } 
}

$n=count($row);
 $cekinstansi="";
for($i=0;$i<$n;$i++){
 $steminfra=$row[$i];

$stem_lab_infra_data = "select * from stem_lab_infra_data inner join school on school.id=stem_lab_infra_data.schoolid where stem_lab_infra_data.schoolid = '".$steminfra['school_id']."'  order by school.city";

$result_stem_lab_infra_data = $mysqli->query($stem_lab_infra_data);
$row_stem_lab_infra_data = $result_stem_lab_infra_data->fetch_assoc();

  $flooring_progress = $row_stem_lab_infra_data['flooring_progress'];

  // if (($value > 1 && $value < 10) || ($value > 20 && $value < 40))

  if($flooring_progress>=100){
   $flooring_progressclr = '#70AD47';
  }elseif($flooring_progress>100 || $flooring_progress>=1){
   $flooring_progressclr = '#1DA29F';
  }else{
    $flooring_progressclr = '#F83E6A';
  }


  $painting_progress = $row_stem_lab_infra_data['painting_progress'];
  if($painting_progress>=100){
   $painting_progressclr = '#70AD47';
  }elseif($painting_progress>100 || $painting_progress>=1){
   $painting_progressclr = '#1DA29F';
  }else{
    $painting_progressclr = '#F83E6A';
  }

  $modelDesks_progress = $row_stem_lab_infra_data['modelDesks_progress'];
  if($modelDesks_progress>=100){
   $modelDesks_progressclr = '#70AD47';
  }elseif($modelDesks_progress>100 || $modelDesks_progress>=1){
   $modelDesks_progressclr = '#1DA29F';
  }else{
    $modelDesks_progressclr = '#F83E6A';
  }

  $EWork_progress = $row_stem_lab_infra_data['EWork_progress'];
  if($EWork_progress>=100){
   $EWork_progressclr = '#70AD47';
  }elseif($EWork_progress>100 || $EWork_progress>=1){
   $EWork_progressclr = '#1DA29F';
  }else{
    $EWork_progressclr = '#F83E6A';
  }

  $cupboard_progress = $row_stem_lab_infra_data['cupboard_progress'];
  if($cupboard_progress>=100){
   $cupboard_progressclr = '#70AD47';
  }elseif($cupboard_progress>100 || $cupboard_progress>=1){
   $cupboard_progressclr = '#1DA29F';
  }else{
    $cupboard_progressclr = '#F83E6A';
  }
  
 ?>
<tr>
  <?php
if($cekinstansi!=$steminfra['city']){
    echo '<th id="city"' .($total[$steminfra['city']]['jml']>1?' rowspan="' .($total[$steminfra['city']]['jml']).'" >':'>') .$steminfra['city'].'</th>';
    $cekinstansi=$steminfra['city'];
  }
   ?>
   <!--  <th ><p><?php echo $steminfra['city']; ?></p></th> -->
    <th class="padd" id="school"><a href="editdata.php?schoolid=<?php echo $steminfra['school_id']; ?>&moduleid=122&pid=<?php echo $_GET['pid']; ?>"><?php echo $steminfra['name']; ?></a></th>

    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $EWork_progressclr; ?>;"><?php if(!empty($row_stem_lab_infra_data['EWork_progress'])){ if($row_stem_lab_infra_data['EWork_progress']=='NA'){ echo "NA";}else{ echo $row_stem_lab_infra_data['EWork_progress'].'%';}  }else{ echo "0%";}  ?></th>

    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $painting_progressclr; ?>;"><?php if(!empty($row_stem_lab_infra_data['painting_progress'])){ if($row_stem_lab_infra_data['painting_progress']=='NA'){ echo "NA";}else{ echo $row_stem_lab_infra_data['painting_progress'].'%';}  }else{ echo "0%";}  ?></th>
    
    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $modelDesks_progressclr; ?>;"><?php if(!empty($row_stem_lab_infra_data['modelDesks_progress'])){ if($row_stem_lab_infra_data['modelDesks_progress']=='NA'){ echo "NA";}else{ echo $row_stem_lab_infra_data['modelDesks_progress'].'%';}  }else{ echo "0%";}  ?></th>

    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $cupboard_progressclr; ?>;"><?php if(!empty($row_stem_lab_infra_data['cupboard_progress'])){ if($row_stem_lab_infra_data['cupboard_progress']=='NA'){ echo "NA";}else{ echo $row_stem_lab_infra_data['cupboard_progress'].'%';}  }else{ echo "0%";}  ?></th>

    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $flooring_progressclr; ?>;"><?php if(!empty($row_stem_lab_infra_data['flooring_progress'])){ if($row_stem_lab_infra_data['flooring_progress']=='NA'){ echo "NA";}else{ echo $row_stem_lab_infra_data['flooring_progress'].'%';}  }else{ echo "0%";}  ?></th>

     <th class="fontcolor" id="stemstatus"><a target="_blank" href="steminfrabefore.php?schoolid=<?php echo $steminfra['sno']; ?>&user=<?php echo $row_stem_lab_infra_data['user_id']; ?>&school2=<?php echo $steminfra['school_id']; ?>" ><img src="https://i.postimg.cc/zvhWkmCP/imgicon.png" class="wpimg"></a></th>
     <th class="fontcolor" id="stemstatus" class=""><a target="_blank" href="steminfrawip.php?schoolid=<?php echo $row_stem_lab_infra_data['schoolid']; ?>&user=<?php echo $row_stem_lab_infra_data['user_id']; ?>&school2=<?php echo $steminfra['school_id']; ?>"><img src="https://i.postimg.cc/zvhWkmCP/imgicon.png" class="wpimg"></a></th>
    <th class="fontcolor"><a target="_blank" href="steminfraafter.php?schoolid=<?php echo $row_stem_lab_infra_data['schoolid']; ?>&user=<?php echo $row_stem_lab_infra_data['user_id']; ?>&school2=<?php echo $steminfra['school_id']; ?>"><img src="https://i.postimg.cc/zvhWkmCP/imgicon.png" class="wpimg"></a></th>
  </tr>
 <?php  }  ?>
</thead>
    </tbody>
  </table>
  
      </div>
    </div>
<?php }  ?>
     

<div class="container">
   <div class="row">
        
      <table class="table table-bordered">
    <thead>
      <tr style="text-align: center;  background-color: #a39cdf;"> 
       <th colspan="10" ><p>Location-Wise Model setup status</p></th>
       </tr>
  <tr>
    <th style="width: 0px;"></th>
    <th></th>
    <th>Science</th>
    <th>Math</th>
    <th>Robotics</th>
    <th>Computer</th>
   <!--  <th>Before</th> -->
    <th>WIP</th>
    <th>After</th>
  </tr>
<?php 
$infradata2 = "select * from project_school inner join school on school.id=project_school.school_id where project_school.project_id = '".$_GET['pid']."' and school.id in(".$_SESSION['school_id'].") and project_school.delete_flag=0 order by school.city";

// $infradata2 = "select * from stem_models_data inner join school on school.id=stem_models_data.schoolid  where stem_models_data.user_id = '".$_SESSION['exp_dash_id']."' and stem_models_data.projectid = '".$_GET['pid']."' and school.delete_flag=0 order by school.city";
 $result2 = $con -> query($infradata2);
 $i=0; 
while($data2=mysqli_fetch_assoc($result2)){
  $row2[$i]=$data2;
  $i++;
}
foreach($row2 as $steminfra2){
  if(isset($total2[$steminfra2['city']]['jml'])) { 
    $total2[$steminfra2['city']]['jml']++; 
  }else{
    $total2[$steminfra2['city']]['jml']=1; 
  } 
}


 $n2=count($row2);
 $cekinstansi2="";
for($i=0;$i<$n2;$i++){
 $steminfra2=$row2[$i];

 $stem_models_data = "select * from stem_models_data inner join school on school.id=stem_models_data.schoolid where stem_models_data.schoolid = '".$steminfra2['school_id']."'  order by school.city";


$result_stem_models_data = $mysqli->query($stem_models_data);
$row_stem_models_data = $result_stem_models_data->fetch_assoc();
 $rows2 = mysqli_num_rows($result2); 
  $science_progress = $row_stem_models_data['science_progress'];

  // if (($value > 1 && $value < 10) || ($value > 20 && $value < 40))

  if($science_progress>=100){
   $science_progressclr = '#70AD47';
  }elseif($science_progress>100 || $science_progress>=1){
   $science_progressclr = '#1DA29F';
  }else{
    $science_progressclr = '#F83E6A';
  }


  $math_progress = $row_stem_models_data['math_progress'];
  if($math_progress>=100){
   $math_progressclr = '#70AD47';
  }elseif($math_progress>100 || $math_progress>=1){
   $math_progressclr = '#1DA29F';
  }else{
    $math_progressclr = '#F83E6A';
  }

  $robotics_progress = $row_stem_models_data['robotics_progress'];
  if($robotics_progress>=100){
   $robotics_progressclr = '#70AD47';
  }elseif($robotics_progress>100 || $robotics_progress>=1){
   $robotics_progressclr = '#1DA29F';
  }else{
    $robotics_progressclr = '#F83E6A';
  }

  $computer_progress = $row_stem_models_data['computer_progress'];
  if($computer_progress>=100){
   $computer_progressclr = '#70AD47';
  }elseif($computer_progress>100 || $computer_progress>=1){
   $computer_progressclr = '#1DA29F';
  }else{
    $computer_progressclr = '#F83E6A';
  }

 ?>
<tr>
   <?php
if($cekinstansi2!=$steminfra2['city']){
    echo '<th id="city"' .($total2[$steminfra2['city']]['jml']>1?' rowspan="' .($total2[$steminfra2['city']]['jml']).'" >':'>') .$steminfra2['city'].'</th>';
    $cekinstansi2=$steminfra2['city'];
  }
   ?>

    <th id="school"><a href="editdata.php?schoolid=<?php echo $steminfra2['school_id']; ?>&moduleid=114&pid=<?php echo $_GET['pid']; ?>"><?php echo $steminfra2['name']; ?></a></th>

    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $science_progressclr; ?>;"><?php if(!empty($row_stem_models_data['science_progress'])){ if($row_stem_models_data['science_progress']=='NA'){ echo "NA";}else{ echo $row_stem_models_data['science_progress'].'%';}  }else{ echo "0%";}  ?></th>

    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $math_progressclr; ?>;"><?php if(!empty($row_stem_models_data['math_progress'])){ if($row_stem_models_data['math_progress']=='NA'){ echo "NA";}else{ echo $row_stem_models_data['math_progress'].'%';}  }else{ echo "0%";}  ?></th>

    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $robotics_progressclr; ?>;"><?php if(!empty($row_stem_models_data['robotics_progress'])){ if($row_stem_models_data['robotics_progress']=='NA'){ echo "NA";}else{ echo $row_stem_models_data['robotics_progress'].'%';}  }else{ echo "0%";}  ?></th>

    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $computer_progressclr; ?>;"><?php if(!empty($row_stem_models_data['computer_progress'])){ if($row_stem_models_data['computer_progress']=='NA'){ echo "NA";}else{ echo $row_stem_models_data['computer_progress'].'%';}  }else{ echo "0%";}  ?></th>

    <!--  <th class="fontcolor" id="stemstatus"><a target="_blank" href="stemmodelbefore.php?schoolid=<?php echo $steminfra2['schoolid']; ?>&user=<?php echo $steminfra2['user_id']; ?>"><img src="https://i.postimg.cc/zvhWkmCP/imgicon.png" class="wpimg"></a></th> -->
     <th class="fontcolor" id="stemstatus"><a target="_blank" href="stemmodelwip.php?schoolid=<?php echo $row_stem_models_data['schoolid']; ?>&user=<?php echo $row_stem_models_data['user_id']; ?>"><img src="https://i.postimg.cc/zvhWkmCP/imgicon.png" class="wpimg"></a></th>
    <th class="fontcolor"><a target="_blank" href="stemmodelafter.php?schoolid=<?php echo $row_stem_models_data['schoolid']; ?>&user=<?php echo $row_stem_models_data['user_id']; ?>"><img src="https://i.postimg.cc/zvhWkmCP/imgicon.png" class="wpimg"></a></th>
  </tr>
 <?php  }  ?>
</thead>
    </tbody>
  </table>
  
      </div>
    </div>



   

<div class="container">
  <div class="row">
       
      <table class="table table-bordered">
    <thead>
      <tr style="text-align: center;  background-color: #a39cdf;"> 
       <th colspan="10" ><p>Location-Wise Posters delivery Status</p></th>
       </tr>
      
  <tr>

    <th style="width: 141px !important;"></th>
    <th></th>
    <th>Branding Wall</th>
    <th>Concepts</th>
    <th>Solar System</th>
    <th>Innovation Corner</th>
    <th>Cutouts</th>
    <!-- <th>Before</th> -->
    <th>WIP</th>
    <th>After</th>
  </tr>
<?php

 // $infradata3 = "select * from stempostersdata inner join school on school.id=stempostersdata.schoolid  where stempostersdata.user_id = '".$_SESSION['exp_dash_id']."' and stempostersdata.projectid = '".$_GET['pid']."' and school.delete_flag=0 order by school.city";

$infradata3 = "select * from project_school inner join school on school.id=project_school.school_id where project_school.project_id = '".$_GET['pid']."' and school.id in(".$_SESSION['school_id'].") and project_school.delete_flag=0 order by school.city";
 $result3 = $con -> query($infradata3);
$i=0; 
while($data3=mysqli_fetch_assoc($result3)){
  $row3[$i]=$data3;
  $i++;
}

foreach($row3 as $steminfra3){
  if(isset($total3[$steminfra3['city']]['jml'])) { 
    $total3[$steminfra3['city']]['jml']++; 
  }else{
    $total3[$steminfra3['city']]['jml']=1; 
  } 
}



$n3=count($row3);
 $cekinstansi3="";



for($i=0;$i<$n3;$i++){
 $steminfra3=$row3[$i];

 $stempostersdata = "select * from stempostersdata inner join school on school.id=stempostersdata.schoolid where stempostersdata.schoolid = '".$steminfra3['school_id']."'  order by school.city";
$result_stempostersdata = $mysqli->query($stempostersdata);
$row_stempostersdata = $result_stempostersdata->fetch_assoc();
  $bWall_progress = $row_stempostersdata['bWall_progress'];

  // if (($value > 1 && $value < 10) || ($value > 20 && $value < 40))
  if($bWall_progress>=100){
   $bWall_progressclr = '#70AD47';
  }elseif($bWall_progress>100 || $bWall_progress>=1){
   $bWall_progressclr = '#1DA29F';
  }else{
    $bWall_progressclr = '#F83E6A';
  }


  $concepts_progress = $row_stempostersdata['concepts_progress'];
  if($concepts_progress>=100){
   $concepts_progressclr = '#70AD47';
  }elseif($concepts_progress>100 || $concepts_progress>=1){
   $concepts_progressclr = '#1DA29F';
  }else{
    $concepts_progressclr = '#F83E6A';
  }

  $sSystem_progress = $row_stempostersdata['sSystem_progress'];
  if($sSystem_progress>=100){
   $sSystem_progressclr = '#70AD47';
  }elseif($sSystem_progress>100 || $sSystem_progress>=1){
   $sSystem_progressclr = '#1DA29F';
  }else{
    $sSystem_progressclr = '#F83E6A';
  }

  $inCorner_progress = $row_stempostersdata['inCorner_progress'];
  if($inCorner_progress>=100){
   $inCorner_progressclr = '#70AD47';
  }elseif($inCorner_progress>100 || $inCorner_progress>=1){
   $inCorner_progressclr = '#1DA29F';
  }else{
    $inCorner_progressclr = '#F83E6A';
  }

  $cutouts_progress = $row_stempostersdata['cutouts_progress'];
  if($cutouts_progress>=100){
   $cutouts_progressclr = '#70AD47';
  }elseif($cutouts_progress>100 || $cutouts_progress>=1){
   $cutouts_progressclr = '#1DA29F';
  }else{
    $cutouts_progressclr = '#F83E6A';
  }
 ?>
<tr>
     <?php
if($cekinstansi3!=$steminfra3['city']){
    echo '<th id="city"' .($total3[$steminfra3['city']]['jml']>1?' rowspan="' .($total3[$steminfra3['city']]['jml']).'">':'>') .$steminfra3['city'].'</th>';
    $cekinstansi3=$steminfra3['city'];
  }
   ?>
    <th id="school"><a href="editdata.php?schoolid=<?php echo $steminfra3['school_id']; ?>&moduleid=121&pid=<?php echo $_GET['pid']; ?>"><?php echo $steminfra3['name']; ?></a></th>

    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $bWall_progressclr; ?>;"><?php if(!empty($row_stempostersdata['bWall_progress'])){ if($row_stempostersdata['bWall_progress']=='NA'){ echo "NA";}else{ echo $row_stempostersdata['bWall_progress'].'%';}  }else{ echo "0%";}  ?></th>

    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $concepts_progressclr; ?>;"><?php if(!empty($row_stempostersdata['concepts_progress'])){ if($row_stempostersdata['concepts_progress']=='NA'){ echo "NA";}else{ echo $row_stempostersdata['concepts_progress'].'%';}  }else{ echo "0%";}  ?></th>

    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $sSystem_progressclr; ?>;"><?php if(!empty($row_stempostersdata['sSystem_progress'])){ if($row_stempostersdata['sSystem_progress']=='NA'){ echo "NA";}else{ echo $row_stempostersdata['sSystem_progress'].'%';}  }else{ echo "0%";}  ?></th>

    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $inCorner_progressclr; ?>;"><?php if(!empty($row_stempostersdata['inCorner_progress'])){ if($row_stempostersdata['inCorner_progress']=='NA'){ echo "NA";}else{ echo $row_stempostersdata['inCorner_progress'].'%';}  }else{ echo "0%";}  ?></th>

    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $cutouts_progressclr; ?>;"><?php if(!empty($row_stempostersdata['cutouts_progress'])){ if($row_stempostersdata['cutouts_progress']=='NA'){ echo "NA";}else{ echo $row_stempostersdata['cutouts_progress'].'%';}  }else{ echo "0%";}  ?></th>

    <!--  <th class="fontcolor" id="stemstatus"><a target="_blank" href="stempostersbefore.php?schoolid=<?php echo $steminfra3['schoolid']; ?>&user=<?php echo $steminfra3['user_id']; ?>"><img src="https://i.postimg.cc/zvhWkmCP/imgicon.png" class="wpimg"></a></th> -->
     <th class="fontcolor" id="stemstatus"><a target="_blank" href="stemposterswip.php?schoolid=<?php echo $row_stempostersdata['schoolid']; ?>&user=<?php echo $row_stempostersdata['user_id']; ?>"><img src="https://i.postimg.cc/zvhWkmCP/imgicon.png" class="wpimg"></a></th>
    <th class="fontcolor"><a target="_blank" href="stempostersafter.php?schoolid=<?php echo $row_stempostersdata['schoolid']; ?>&user=<?php echo $row_stempostersdata['user_id']; ?>"><img src="https://i.postimg.cc/zvhWkmCP/imgicon.png" class="wpimg"></a></th>
  </tr>
 <?php  }  ?>
</thead>
    </tbody>
  </table>
      </div>
    </div>

   <!-- inaugration -->

<div class="container">
  <div class="row">
       
      <table class="table table-bordered">
    <thead>
      <tr style="text-align: center;  background-color: #a39cdf;"> 
       <th colspan="10" ><p>Innaugration Status</p></th>
       </tr>
      
  <tr>

    <th id="School2">City</th>
    <th id="School2">School</th>
    <th id="School2">Dates</th>
    <th id="School2">Photos</th>
  </tr>
<?php 

// $infradata3_innaugration = "select * from innaugration inner join school on school.id=innaugration.schoolid  where innaugration.user_id = '".$_SESSION['exp_dash_id']."' and innaugration.projectid = '".$_GET['pid']."' and school.delete_flag=0 order by school.city";

$infradata3_innaugration = "select * from project_school inner join school on school.id=project_school.school_id where project_school.project_id = '".$_GET['pid']."' and school.id in(".$_SESSION['school_id'].") and project_school.delete_flag=0 order by school.city";

 $result3_innaugration = $con -> query($infradata3_innaugration);
$i=0; 
while($data3_innaugration=mysqli_fetch_assoc($result3_innaugration)){
  $row3_innaugration[$i]=$data3_innaugration;
  $i++;
}

foreach($row3_innaugration as $steminfra3_innaugration){
  if(isset($total3_innaugration[$steminfra3_innaugration['city']]['jml'])) { 
    $total3_innaugration[$steminfra3_innaugration['city']]['jml']++; 
  }else{
    $total3_innaugration[$steminfra3_innaugration['city']]['jml']=1; 
  } 
}

$n3_innaugration=count($row3_innaugration);
 $cekinstansi3_innaugration="";

for($i=0;$i<$n3_innaugration;$i++){
 $steminfra3_innaugration=$row3_innaugration[$i];

 $stempostersdata_Innaugration = "select * from innaugration inner join school on school.id=innaugration.schoolid where innaugration.schoolid = '".$steminfra3_innaugration['school_id']."'  order by school.city";
$result__Innaugration = $mysqli->query($stempostersdata_Innaugration);
$row__Innaugration = $result__Innaugration->fetch_assoc();

//print_r($row__Innaugration); exit;
 ?>
<tr>
     <?php
if($cekinstansi3_innaugration!=$steminfra3_innaugration['city']){
    echo '<th id="city"' .($total3_innaugration[$steminfra3_innaugration['city']]['jml']>1?' rowspan="' .($total3_innaugration[$steminfra3_innaugration['city']]['jml']).'">':'>') .$steminfra3_innaugration['city'].'</th>';
    $cekinstansi3_innaugration=$steminfra3_innaugration['city'];
  }
   ?>
    <th id="school"><a href="editdata.php?schoolid=<?php echo $steminfra3_innaugration['id']; ?>&moduleid=171&pid=<?php echo $_GET['pid']; ?>"><?php echo $steminfra3_innaugration['name']; ?></a></th>
    
     <th id="stemstatus" class="fontcolor" style="text-align: center; <?php  if(!empty($row__Innaugration['InnaugrationDate'])){ $date = date('d/m/Y',strtotime($row__Innaugration['InnaugrationDate']));  if($date<=date('d/m/Y')){ echo "background-color: #70AD47;";  }else{ echo "background-color: #1DA29F;";   } }else{ echo "background-color: #F83E6A;"; } ?>"><?php if(!empty($row__Innaugration['InnaugrationDate'])){echo date('d/m/Y',strtotime($row__Innaugration['InnaugrationDate']));}else{ echo "NA"; } ?></th>


    <th ><a target="_blank" href="Innaugrationgallery.php?schoolid=<?php echo $steminfra3_innaugration['id']; ?>&user=<?php echo $row__Innaugration['user_id']; ?>"><img src="https://i.postimg.cc/zvhWkmCP/imgicon.png" class="wpimg"></a></th>
  </tr>
 <?php  }  ?>
</thead>
    </tbody>
  </table>
      </div>
    </div>

    <!-- Teacher Training -->

<div class="container">
  <div class="row">
       
      <table class="table table-bordered">
    <thead>
      <tr style="text-align: center;  background-color: #a39cdf;"> 
       <th colspan="10" ><p>Teacher Training</p></th>
       </tr>
      
  <tr>
    <th id="School2">City</th>
    <th id="School2">School</th>
    <th id="School2">Start Date</th>
    <th id="School2">End Date</th>
    <th id="School2">Photos</th>
  </tr>
<?php 

// $infradata3_teachertraining = "select * from teachertraining inner join school on school.id=teachertraining.schoolid  where teachertraining.user_id = '".$_SESSION['exp_dash_id']."' and teachertraining.projectid = '".$_GET['pid']."' and school.delete_flag=0 order by school.city";

$infradata3_teachertraining = "select * from project_school inner join school on school.id=project_school.school_id where project_school.project_id = '".$_GET['pid']."' and school.id in(".$_SESSION['school_id'].") and project_school.delete_flag=0 order by school.city";

 $result3_teachertraining = $con -> query($infradata3_teachertraining);
$i=0; 
while($data3_teachertraining=mysqli_fetch_assoc($result3_teachertraining)){
  $row3_teachertraining[$i]=$data3_teachertraining;
  $i++;
}

foreach($row3_teachertraining as $steminfra3_teachertraining){
  if(isset($total3_teachertraining[$steminfra3_teachertraining['city']]['jml'])) { 
    $total3_teachertraining[$steminfra3_teachertraining['city']]['jml']++; 
  }else{
    $total3_teachertraining[$steminfra3_teachertraining['city']]['jml']=1; 
  } 
}

$n3_teachertraining=count($row3_teachertraining);
 $cekinstansi3_teachertraining="";

for($i=0;$i<$n3_teachertraining;$i++){
 $steminfra3_teachertraining=$row3_teachertraining[$i];

 $stempostersdata_Teacher_Training = "select * from teachertraining inner join school on school.id=teachertraining.schoolid where teachertraining.schoolid = '".$steminfra3_teachertraining['school_id']."'  order by school.city";
$result__Teacher_Training = $mysqli->query($stempostersdata_Teacher_Training);
$row__Teacher_Training = $result__Teacher_Training->fetch_assoc();

 ?>
<tr>
     <?php
if($cekinstansi3_teachertraining!=$steminfra3_teachertraining['city']){
    echo '<th id="city"' .($total3_teachertraining[$steminfra3_teachertraining['city']]['jml']>1?' rowspan="' .($total3_teachertraining[$steminfra3_teachertraining['city']]['jml']).'">':'>') .$steminfra3_teachertraining['city'].'</th>';
    $cekinstansi3_teachertraining=$steminfra3_teachertraining['city'];
  }
   ?>
    <th id="school"><a href="editdata.php?schoolid=<?php echo $steminfra3_teachertraining['id']; ?>&moduleid=80&pid=<?php echo $_GET['pid']; ?>"><?php echo $steminfra3_teachertraining['name']; ?></a></th>

    <th id="stemstatus" class="fontcolor" style="text-align: center; <?php  if(!empty($row__Teacher_Training['teacherTrainingDate'])){ $date = date('d/m/Y',strtotime($row__Teacher_Training['teacherTrainingDate']));  if($date<=date('d/m/Y')){ echo "background-color: #70AD47;";  }else{ echo "background-color: #1DA29F;";   } }else{ echo "background-color: #F83E6A;"; } ?>"><?php if(!empty($row__Teacher_Training['teacherTrainingDate'])){echo date('d/m/Y',strtotime($row__Teacher_Training['teacherTrainingDate']));}else{ echo "NA"; } ?></th>
    <th id="stemstatus" class="fontcolor" style="text-align: center;
     <?php  if(!empty($row__Teacher_Training['teacherTraining_eDate'])){ $date = date('d/m/Y',strtotime($row__Teacher_Training['teacherTraining_eDate']));  if($date<=date('d/m/Y')){ echo "background-color: #70AD47;";  }else{ echo "background-color: #1DA29F;";   } }else{ echo "background-color: #F83E6A;"; } ?>"><?php if(!empty($row__Teacher_Training['teacherTraining_eDate'])){echo date('d/m/Y',strtotime($row__Teacher_Training['teacherTraining_eDate']));}else{ echo "NA"; } ?></th>
    <th ><a target="_blank" href="TeacherTraininggal.php?schoolid=<?php echo $steminfra3_teachertraining['id']; ?>&user=<?php echo $steminfra3_teachertraining['user_id']; ?>"><img src="https://i.postimg.cc/zvhWkmCP/imgicon.png" class="wpimg"></a></th>
  </tr>
 <?php  }  ?> 
</thead>
    </tbody>
  </table>
      </div>
    </div>


    <!-- stemimpactassessment -->

<div class="container">
  <div class="row">
       
      <table class="table table-bordered">
    <thead>
      <tr style="text-align: center;  background-color: #a39cdf;"> 
       <th colspan="10" ><p>Impact Assessment Status</p></th>
       </tr>
      
  <tr>

    <th id="School2">City</th>
    <th id="School2">School</th>
    <th style="text-align: center;">Date</th>
    <th id="School2">Photos</th>
  </tr>
<?php 

// $infradata3_stemimpactassessment = "select * from stemimpactassessment inner join school on school.id=stemimpactassessment.schoolid  where stemimpactassessment.user_id = '".$_SESSION['exp_dash_id']."' and stemimpactassessment.projectid = '".$_GET['pid']."' and school.delete_flag=0 order by school.city";


$infradata3_stemimpactassessment = "select * from project_school inner join school on school.id=project_school.school_id where project_school.project_id = '".$_GET['pid']."' and school.id in(".$_SESSION['school_id'].") and project_school.delete_flag=0 order by school.city";

 $result3_stemimpactassessment = $con -> query($infradata3_stemimpactassessment);
$i=0; 
while($data3_stemimpactassessment=mysqli_fetch_assoc($result3_stemimpactassessment)){
  $row3_stemimpactassessment[$i]=$data3_stemimpactassessment;
  $i++;
}

foreach($row3_stemimpactassessment as $steminfra3_stemimpactassessment){
  if(isset($total3_stemimpactassessment[$steminfra3_stemimpactassessment['city']]['jml'])) { 
    $total3_stemimpactassessment[$steminfra3_stemimpactassessment['city']]['jml']++; 
  }else{
    $total3_stemimpactassessment[$steminfra3_stemimpactassessment['city']]['jml']=1; 
  } 
}

$n3_stemimpactassessment=count($row3_stemimpactassessment);
 $cekinstansi3_stemimpactassessment="";

for($i=0;$i<$n3_stemimpactassessment;$i++){
 $steminfra3_stemimpactassessment=$row3_stemimpactassessment[$i];

 $stempostersdata_stemimpactassessment = "select * from stemimpactassessment inner join school on school.id=stemimpactassessment.schoolid where stemimpactassessment.schoolid = '".$steminfra3_stemimpactassessment['school_id']."'  order by school.city";
$result__stemimpactassessment = $mysqli->query($stempostersdata_stemimpactassessment);
$row__stemimpactassessment = $result__stemimpactassessment->fetch_assoc();
 ?>
<tr>
     <?php
if($cekinstansi3_stemimpactassessment!=$steminfra3_stemimpactassessment['city']){
    echo '<th id="city"' .($total3_stemimpactassessment[$steminfra3_stemimpactassessment['city']]['jml']>1?' rowspan="' .($total3_stemimpactassessment[$steminfra3_stemimpactassessment['city']]['jml']).'">':'>') .$steminfra3_stemimpactassessment['city'].'</th>';
    $cekinstansi3_stemimpactassessment=$steminfra3_stemimpactassessment['city'];
  }
   ?>
    <th id="school"><a href="editdata.php?schoolid=<?php echo $steminfra3_stemimpactassessment['id']; ?>&moduleid=167&pid=<?php echo $_GET['pid']; ?>"><?php echo $steminfra3_stemimpactassessment['name']; ?></a></th>

     <th id="stemstatus" class="fontcolor" style="text-align: center;
     <?php  if(!empty($row__stemimpactassessment['StemImpactDate'])){ $date = date('d/m/Y',strtotime($row__stemimpactassessment['StemImpactDate']));  if($date<=date('d/m/Y')){ echo "background-color: #70AD47;";  }else{ echo "background-color: #1DA29F;";   } }else{ echo "background-color: #F83E6A;"; } ?>"><?php if(!empty($row__stemimpactassessment['StemImpactDate'])){echo date('d/m/Y',strtotime($row__stemimpactassessment['StemImpactDate']));}else{ echo "NA"; } ?></th>

    <th ><a target="_blank" href="StemImpactgal.php?schoolid=<?php echo $steminfra3_stemimpactassessment['id']; ?>&user=<?php echo $row__stemimpactassessment['user_id']; ?>"><img src="https://i.postimg.cc/zvhWkmCP/imgicon.png" class="wpimg"></a></th>
  </tr>
 <?php  }  ?>
</thead>
    </tbody>
  </table>
      </div>
    </div>


<?php if($_GET['pid'] =='5744'){ ?>
    <div class="container">
   <div class="row">
        
      <table class="table table-bordered">
    <thead>
      <tr style="text-align: center;  background-color: #a39cdf;"> 
       <th colspan="10" ><p>STEM Infra Material Delivery</p></th>
       </tr>
  <tr>
    <th style="width: 0px;"></th>
    <th></th>
    <th>Electric Work</th>
    <th>Painting</th>
    <th>Model Desks</th>
    <th>Cupboard</th>
    <th>Flooring</th>
    <th>Solar power</th>
    <th>Photos</th>
  </tr>
<?php 
$infradata2 = "select * from project_school inner join school on school.id=project_school.school_id where project_school.project_id = '".$_GET['pid']."' and school.id in(".$_SESSION['school_id'].") and project_school.delete_flag=0 order by school.city";

// $infradata2 = "select * from stem_models_data inner join school on school.id=stem_models_data.schoolid  where stem_models_data.user_id = '".$_SESSION['exp_dash_id']."' and stem_models_data.projectid = '".$_GET['pid']."' and school.delete_flag=0 order by school.city";
 $result2 = $con -> query($infradata2);
 $i=0; 
while($data2=mysqli_fetch_assoc($result2)){
  $row2[$i]=$data2;
  $i++;
}
foreach($row2 as $steminfra2){
  if(isset($total2[$steminfra2['city']]['jml'])) { 
    $total2[$steminfra2['city']]['jml']++; 
  }else{
    $total2[$steminfra2['city']]['jml']=1; 
  } 
}


 $n2=count($row2);
 $cekinstansi2="";
for($i=0;$i<$n2;$i++){
 $steminfra2=$row2[$i];

 $stem_models_data = "select * from steminframaterialdelivery inner join school on school.id=steminframaterialdelivery.schoolid where steminframaterialdelivery.schoolid = '".$steminfra2['school_id']."'  order by school.city";


$result_stem_models_data = $mysqli->query($stem_models_data);
$row_stem_models_data = $result_stem_models_data->fetch_assoc();
 $rows2 = mysqli_num_rows($result2); 
  $EWork_progress = $row_stem_models_data['EWork_progress'];

  // if (($value > 1 && $value < 10) || ($value > 20 && $value < 40))

  if($EWork_progress>=100){
   $EWork_progressclr = '#70AD47';
  }elseif($EWork_progress>100 || $EWork_progress>=1){
   $EWork_progressclr = '#1DA29F';
  }else{
    $EWork_progressclr = '#F83E6A';
  }


  $painting_progress = $row_stem_models_data['painting_progress'];
  if($painting_progress>=100){
   $painting_progressclr = '#70AD47';
  }elseif($painting_progress>100 || $painting_progress>=1){
   $painting_progressclr = '#1DA29F';
  }else{
    $painting_progressclr = '#F83E6A';
  }

  $modelDesks_progress = $row_stem_models_data['modelDesks_progress'];
  if($modelDesks_progress>=100){
   $modelDesks_progressclr = '#70AD47';
  }elseif($modelDesks_progress>100 || $modelDesks_progress>=1){
   $modelDesks_progressclr = '#1DA29F';
  }else{
    $modelDesks_progressclr = '#F83E6A';
  }

  $cupboard_progress = $row_stem_models_data['cupboard_progress'];
  if($cupboard_progress>=100){
   $cupboard_progressclr = '#70AD47';
  }elseif($cupboard_progress>100 || $cupboard_progress>=1){
   $cupboard_progressclr = '#1DA29F';
  }else{
    $cupboard_progressclr = '#F83E6A';
  }

  $flooring_progress = $row_stem_models_data['flooring_progress'];
  if($flooring_progress>=100){
   $flooring_progressclr = '#70AD47';
  }elseif($flooring_progress>100 || $flooring_progress>=1){
   $flooring_progressclr = '#1DA29F';
  }else{
    $flooring_progressclr = '#F83E6A';
  }

  $Solar_progress = $row_stem_models_data['Solar_progress'];
  if($Solar_progress>=100){
   $Solar_progressclr = '#70AD47';
  }elseif($Solar_progress>100 || $Solar_progress>=1){
   $Solar_progressclr = '#1DA29F';
  }else{
    $Solar_progressclr = '#F83E6A';
  }

 ?>
<tr>
   <?php
if($cekinstansi2!=$steminfra2['city']){
    echo '<th id="city"' .($total2[$steminfra2['city']]['jml']>1?' rowspan="' .($total2[$steminfra2['city']]['jml']).'" >':'>') .$steminfra2['city'].'</th>';
    $cekinstansi2=$steminfra2['city'];
  }
   ?>

    <th id="school"><a href="editdata.php?schoolid=<?php echo $steminfra2['school_id']; ?>&moduleid=173&pid=<?php echo $_GET['pid']; ?>"><?php echo $steminfra2['name']; ?></a></th>
    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $EWork_progressclr; ?>;"><?php if(!empty($row_stem_models_data['EWork_progress'])){ if($row_stem_models_data['EWork_progress']=='NA'){ echo "NA";}else{ echo $row_stem_models_data['EWork_progress'].'%';}  }else{ echo "0%";}  ?></th>

     <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $painting_progressclr; ?>;"><?php if(!empty($row_stem_models_data['painting_progress'])){ if($row_stem_models_data['painting_progress']=='NA'){ echo "NA";}else{ echo $row_stem_models_data['painting_progress'].'%';}  }else{ echo "0%";}  ?></th>
 <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $modelDesks_progressclr; ?>;"><?php if(!empty($row_stem_models_data['modelDesks_progress'])){ if($row_stem_models_data['modelDesks_progress']=='NA'){ echo "NA";}else{ echo $row_stem_models_data['modelDesks_progress'].'%';}  }else{ echo "0%";}  ?></th>
      <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $cupboard_progressclr; ?>;"><?php if(!empty($row_stem_models_data['cupboard_progress'])){ if($row_stem_models_data['cupboard_progress']=='NA'){ echo "NA";}else{ echo $row_stem_models_data['cupboard_progress'].'%';}  }else{ echo "0%";}  ?></th>

       <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $flooring_progressclr; ?>;"><?php if(!empty($row_stem_models_data['flooring_progress'])){ if($row_stem_models_data['flooring_progress']=='NA'){ echo "NA";}else{ echo $row_stem_models_data['flooring_progress'].'%';}  }else{ echo "0%";}  ?></th>

        <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $Solar_progressclr; ?>;"><?php if(!empty($row_stem_models_data['Solar_progress'])){ if($row_stem_models_data['Solar_progress']=='NA'){ echo "NA";}else{ echo $row_stem_models_data['Solar_progress'].'%';}  }else{ echo "0%";}  ?></th>

     <th class="fontcolor" id="stemstatus"><a target="_blank" href="steminfradelivery.php?schoolid=<?php echo $row_stem_models_data['schoolid']; ?>&user=<?php echo $row_stem_models_data['user_id']; ?>"><img src="https://i.postimg.cc/zvhWkmCP/imgicon.png" class="wpimg"></a></th>
    
  </tr>
 <?php  }  ?>
</thead>
    </tbody>
  </table>
  
      </div>
    </div>
<?php } ?>

<script type="text/javascript" src="js/chart_dash.js"></script>
<script type="text/javascript">
  $("#stats_button").on('click',function(){

    let pid = $("#project_drop").val();
    window.open("dashboard.php?pid="+pid, "_self");
});
</script>