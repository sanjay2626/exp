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

// $prog_query = "SELECT program_id from project where id in ({$projects}) and delete_flag=0";

// $prog_res = mysqli_query($con,$prog_query) or die(mysqli_error($con));

// $prog_arr = [];

// while ($prog_row = mysqli_fetch_assoc($prog_res)) {

// foreach (explode(",",$prog_row['program_id']) as $program) {

// if(!in_array($program,$prog_arr)){

//   array_push($prog_arr,$program);

// }

// }

// }

// $programs = join(",",$prog_arr);

// $module_query = "SELECT module_list from program where id in ($programs) and delete_flag=0";

// $module_res = mysqli_query($con,$module_query) or die(mysqli_error($con));

// $module_arr = [];

// while ($module_row = mysqli_fetch_assoc($module_res)) {

// foreach (explode(",",$module_row['module_list']) as $module) {

// if(!in_array($module,$module_arr)){

//   array_push($module_arr,$module);

// }

// }

// }

// $session_count = mysqli_fetch_row(mysqli_query($con,"SELECT count(*) from session_completed where project_id in ({$projects})"))[0];


  
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

   


  <!--   <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->


<?php 
require_once('main_screen.php');
require_once('bottom_menu.php'); ?>

<link rel="stylesheet" href="table.css">





   <?php if(count($tags)>=2 || empty($_GET['pid'])){ ?>

    <div class="container">

        <div class="row justify-content-center" style="margin-bottom:10px">

            <h3 style="padding:15px" class="head">Projects</h3>

        </div>

               <div class="row justify-content-center">

            <select id='project_drop' class="form-control" style="max-width:200px">

                 <option value="">All Projects</option>

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




<div id="Locations_data"></div>

<div class="container" id="all_stem_data">

      <div class="row">

     <table class="table table-bordered" >

    <thead>

      <tr style="background-color: #ffc107">  

<th rowspan="2">

  <select name="Locations" class="get_locations" id="get_locations">



  <option>Locations</option>

  <option value="all">All Locations</option>

  <?php 

$infradata10 = "select DISTINCT(city) from school

 inner join project_school on school.id=project_school.school_id where project_school.project_id = '".$_GET['pid']."' and project_school.delete_flag=0 order by school.city";

 $result10 = $con -> query($infradata10);

 //print_r($infradata9); exit;

$i=0; 

while($data10=mysqli_fetch_assoc($result10)){

  $row10[$i]=$data10;

  $i++;

}

foreach($row10 as $steminfra10){  ?>

<option value="<?php echo $steminfra10['city']; ?>"><?php echo $steminfra10['city']; ?></option>

<?php } ?>

</select></th>

<th  rowspan="2">Schools</th>

<th colspan="3" style="text-align: center;"><span >STEM Lab Setup</span></th>

<!--<th rowspan="2" style="text-align: center;">Inaugration Dates</th>-->

<!--<th rowspan="2" style="width: 149px; text-align: center;">Teacher Training Dates</th>-->

<!--<th rowspan="2" style="text-align: center;">Assessment Dates</th>-->

<th rowspan="2" style="text-align: center;">Photos / Video</th>

      </tr>

  <tr style="background-color: #ffc107">

    <th style="text-align: center;">Infra</th>

    <th style="text-align: center;">Models</th>

    <th style="text-align: center;">Posters</th>

    

  </tr>

  <tr>

<?php 

 $infradata9 = "select * from project_school inner join school on school.id=project_school.school_id where project_school.project_id = '".$_GET['pid']."' and project_school.delete_flag=0 order by school.city";



 $result9 = $con -> query($infradata9);

 //print_r($infradata9); exit;

$i=0; 

while($data9=mysqli_fetch_assoc($result9)){

  $row9[$i]=$data9;

  $i++;

}

foreach($row9 as $steminfra9){

// print_r($steminfra9);





  if(isset($total9[$steminfra9['city']]['jml'])) { 

    $total9[$steminfra9['city']]['jml']++; 

  }else{

    $total9[$steminfra9['city']]['jml']=1; 

  } 

}



$n9=count($row9);

 $cekinstansi9=""; ?>









<?php



for($i=0;$i<$n9;$i++){

 $steminfra9=$row9[$i];

  $stem_models_data123 = "select DISTINCT school.id, school.city, school.name, stem_lab_infra_data.EWork_progress,  
  stem_lab_infra_data.painting_progress, stem_lab_infra_data.modelDesks_progress, stem_lab_infra_data.cupboard_progress,
   stem_lab_infra_data.flooring_progress, stem_models_data.science_progress, stem_models_data.math_progress, stem_models_data.robotics_progress,
    stem_models_data.computer_progress, stempostersdata.bWall_progress, stempostersdata.concepts_progress, stempostersdata.sSystem_progress,
     stempostersdata.inCorner_progress, stempostersdata.cutouts_progress, stem_models_data.user_id, stem_lab_infra_data.user_id,
      stempostersdata.user_id, innaugration.InnaugrationDate , stemimpactassessment.StemImpactDate, teachertraining.teacherTrainingDate,
       teachertraining.teacherTraining_eDate  from school 

  left join stempostersdata on school.id=stempostersdata.schoolid

  left join stem_lab_infra_data on school.id=stem_lab_infra_data.schoolid

  left join stem_models_data on school.id=stem_models_data.schoolid

  left join innaugration on school.id=innaugration.schoolid

  left join stemimpactassessment on school.id=stemimpactassessment.schoolid

  left join teachertraining on school.id=teachertraining.schoolid



  where stempostersdata.schoolid = '".$steminfra9['school_id']."' OR stem_lab_infra_data.schoolid = '".$steminfra9['school_id']."' OR stem_models_data.schoolid = '".$steminfra9['school_id']."' OR innaugration.schoolid = '".$steminfra9['school_id']."' order by school.city";

   

$result_stem_models_data123 = $mysqli->query($stem_models_data123);
if ($result_stem_models_data123) {

$row_stem_models_data123 = $result_stem_models_data123->fetch_assoc();

if ($row_stem_models_data123) {
print_r($row_stem_models_data123);





 





if($row_stem_models_data123['flooring_progress']=="NA"){$e1='0';}else{$e1='1';}

if($row_stem_models_data123['painting_progress']=="NA"){$e2='0';}else{$e2='1';}

if($row_stem_models_data123['modelDesks_progress']=="NA"){$e3='0';}else{$e3='1';}

if($row_stem_models_data123['EWork_progress']=="NA"){$e4='0';}else{$e4='1';}

if($row_stem_models_data123['cupboard_progress']=="NA"){$e5='0';}else{$e5='1';}

$e1total = $e1+$e2+$e3+$e4+$e5;

$infra = $row_stem_models_data123['flooring_progress']+$row_stem_models_data123['painting_progress']+$row_stem_models_data123['modelDesks_progress']+$row_stem_models_data123['EWork_progress']+$row_stem_models_data123['cupboard_progress'];



$infratotal = $infra/$e1total;

$finfratotal = number_format((float)$infratotal, 2, '.', '');



$infra_progress = $finfratotal;

  if($infra_progress>=100){

   $infra_progressclr = '#59b71ab8';

  }elseif($infra_progress>100 || $infra_progress>=1){

   $infra_progressclr = '#ed7d31';

  }elseif($infra_progress=='NA'){

   $infra_progressclr = '#a5a5a5';

  }else{

    $infra_progressclr = '#FF0000';

  }





   if($row_stem_models_data123['science_progress']=="NA"){$m1='0';}else{$m1='1';}

if($row_stem_models_data123['math_progress']=="NA"){$m2='0';}else{$m2='1';}

if($row_stem_models_data123['robotics_progress']=="NA"){$m3='0';}else{$m3='1';}

if($row_stem_models_data123['computer_progress']=="NA"){$m4='0';}else{$m4='1';}

$m1total = $m1+$m2+$m3+$m4;

  $Models = $row_stem_models_data123['science_progress']+$row_stem_models_data123['math_progress']+$row_stem_models_data123['robotics_progress']+$row_stem_models_data123['computer_progress'];

$Modelstotal = $Models/$m1total;

$fModelstotal = number_format((float)$Modelstotal, 2, '.', '');



$Models_progress = $fModelstotal;

  if($Models_progress>=100){

   $Models_progressclr = '#59b71ab8';

  }elseif($Models_progress>100 || $Models_progress>=1){

   $Models_progressclr = '#ed7d31';

  }elseif($Models_progress=='NA'){

   $Models_progressclr = '#a5a5a5';

  }else{

    $Models_progressclr = '#FF0000';

  }

  

  

  if($row_stem_models_data123['bWall_progress']=="NA"){$p1='0';}else{$p1='1';}

if($row_stem_models_data123['concepts_progress']=="NA"){$p2='0';}else{$p2='1';}

if($row_stem_models_data123['sSystem_progress']=="NA"){$p3='0';}else{$p3='1';}

if($row_stem_models_data123['inCorner_progress']=="NA"){$p5='0';}else{$p5='1';}

if($row_stem_models_data123['cutouts_progress']=="NA"){$p5='0';}else{$p5='1';}

$p1total = $p1+$p2+$p3+$p4+$p5;

$Posters = $row_stem_models_data123['bWall_progress']+$row_stem_models_data123['concepts_progress']+$row_stem_models_data123['sSystem_progress']+$row_stem_models_data123['inCorner_progress']+$row_stem_models_data123['cutouts_progress'];

$Posterstotal = $Posters/$p1total ;

$fPosterstotal = number_format((float)$Posterstotal, 2, '.', '');



$Posters_progress = $fPosterstotal;

  if($Posters_progress>=100){

   $Posters_progressclr = '#59b71ab8';

  }elseif($Posters_progress>100 || $Posters_progress>=1){

   $Posters_progressclr = '#ed7d31';

  }elseif($Posters_progress=='NA'){

   $Posters_progressclr = '#a5a5a5';

  }else{

    $Posters_progressclr = '#FF0000';

  }





  

 ?>



  <tr >



    <?php

if($cekinstansi9!=$steminfra9['city']){

    echo '<th id="city"' .($total9[$steminfra9['city']]['jml']>1?' rowspan="' .($total9[$steminfra9['city']]['jml']).'">':'>') .$steminfra9['city'].'</th>';

    $cekinstansi9=$steminfra9['city'];

  }

   ?>

   

    <th id="school"><?php echo $steminfra9['name']; ?></th>

    <th class="fontcolor" style="text-align: center;background-color: <?php echo $infra_progressclr; ?>;"><?php echo round( $finfratotal, 0); ?>%</th>

    <th class="fontcolor" style="text-align: center;background-color: <?php echo $Models_progressclr; ?>;"><?php echo round($fModelstotal, 0); ?>%</th>

    <th class="fontcolor" style="text-align: center;background-color: <?php echo $Posters_progressclr; ?>;"><?php echo round($fPosterstotal, 0);  ?>%</th>

    <!--<th class="fontcolor" style="text-align: center; <?php  if(!empty($row_stem_models_data123['InnaugrationDate'])){ $date = date('d/m/Y',strtotime($row_stem_models_data123['InnaugrationDate']));  if($date<=date('d/m/Y')){ echo "background-color: #59b71ab8;";  }else{ echo "background-color: #ed7d31;";   } }else{ echo "background-color: #FF0000;"; } ?>"><?php if(!empty($row_stem_models_data123['InnaugrationDate'])){echo date('d/m/Y',strtotime($row_stem_models_data123['InnaugrationDate']));}else{ echo "Undecided"; } ?></th>-->

  

    <!-- <th class="fontcolor" style="text-align: center; <?php  if(!empty($row_stem_models_data123['teacherTrainingDate'])){ $date = date('d/m/Y',strtotime($row_stem_models_data123['teacherTrainingDate']));  if($date<=date('d/m/Y')){ echo "background-color: #59b71ab8;";  }else{ echo "background-color: #ed7d31;";   } }else{ echo "background-color: #FF0000;"; } ?>"><?php if(!empty($row_stem_models_data123['teacherTrainingDate'])){echo date('d/m/Y',strtotime($row_stem_models_data123['teacherTrainingDate']));}else{ echo "Undecided"; } ?></th>-->

    <!--<th class="fontcolor" style="text-align: center;-->

    <!-- <?php  if(!empty($row_stem_models_data123['StemImpactDate'])){ $date = date('d/m/Y',strtotime($row_stem_models_data123['StemImpactDate']));  if($date<=date('d/m/Y')){ echo "background-color: #59b71ab8;";  }else{ echo "background-color: #ed7d31;";   } }else{ echo "background-color: #FF0000;"; } ?>"><?php if(!empty($row_stem_models_data123['StemImpactDate'])){echo date('d/m/Y',strtotime($row_stem_models_data123['StemImpactDate']));}else{ echo "Undecided"; } ?></th>-->

     

    <th class="fontcolor" style="text-align: center;"><a target="_blank" href="stemgallery.php?schoolid=<?php echo $steminfra9['school_id']; ?>&user=<?php echo $row_stem_models_data123['user_id']; ?>&sno=<?php echo $steminfra9['sno']; ?>"><img src="https://i.postimg.cc/zvhWkmCP/imgicon.png" class="wpimg"></th>

  </tr>
  <?php  } } ?>
<?php  }  ?>



</div>

</thead>

</tr>

     <tbody>

  </tbody>

  </table>

  

      </div>

    </div>





<?php if($_GET['pid'] =='5744'){ ?>

    <div class="container">

   <div class="row">

        

      <table class="table table-bordered">

    <thead>

      <tr style="text-align: center;  background-color: #ffc107"> 

       <th colspan="10" ><h5>STEM Lab Infra - STC BLR</h5></th>

       </tr>

  <tr style="background-color: #ffc107">

    <th style="width: 0px; text-align: center;">City</th>

    <th style="text-align: center;">School</th>

    <th style="text-align: center;">Electric work</th>

    <th style="text-align: center;">Model Desk</th>

    <th style="text-align: center;">Cupboard</th>

    <th style="text-align: center;">Solar power</th>

<!--     <th style="text-align: center;">Before</th> -->

    <th style="text-align: center;">WIP</th>

    <th style="text-align: center;">After</th>

  </tr>

<?php $infradata2 = "select * from project_school inner join school on school.id=project_school.school_id where project_school.project_id = '".$_GET['pid']."' and project_school.delete_flag=0 order by school.city";

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

  $science_progress = $row_stem_models_data['EWork_progress'];



  // if (($value > 1 && $value < 10) || ($value > 20 && $value < 40))



  if($science_progress>=100){

   $science_progressclr = '#59b71ab8';

  }elseif($science_progress>100 || $row_stem_models_data>=1){

   $science_progressclr = '#ed7d31';

  }elseif($science_progress=='NA'){

   $science_progressclr = '#a5a5a5';

  }else{

    $science_progressclr = '#FF0000';

  }





  $math_progress = $row_stem_models_data['modelDesks_progress'];

  if($math_progress>=100){

   $math_progressclr = '#59b71ab8';

  }elseif($math_progress>100 || $math_progress>=1){

   $math_progressclr = '#ed7d31';

  }elseif($math_progress=='NA'){

   $math_progressclr = '#a5a5a5';

  }else{

    $math_progressclr = '#FF0000';

  }



  $robotics_progress = $row_stem_models_data['cupboard_progress'];

  if($robotics_progress>=100){

   $robotics_progressclr = '#59b71ab8';

  }elseif($robotics_progress>100 || $robotics_progress>=1){

   $robotics_progressclr = '#ed7d31';

  }elseif($robotics_progress=='NA'){

   $robotics_progressclr = '#a5a5a5';

  }else{

    $robotics_progressclr = '#FF0000';

  }



  $computer_progress = $row_stem_models_data['Solar_progress'];

  if($computer_progress>=100){

   $computer_progressclr = '#59b71ab8';

  }elseif($computer_progress>100 || $computer_progress>=1){

   $computer_progressclr = '#ed7d31';

  }elseif($computer_progress=='NA'){

   $computer_progressclr = '#a5a5a5';

  }else{

    $computer_progressclr = '#FF0000';

  }



 ?>

<tr>

   <?php

if($cekinstansi2!=$steminfra2['city']){

    echo '<th id="city"' .($total2[$steminfra2['city']]['jml']>1?' rowspan="' .($total2[$steminfra2['city']]['jml']).'">':'>') .$steminfra2['city'].'</th>';

    $cekinstansi2=$steminfra2['city'];

  }

   ?>



    <th id="school"><?php echo $steminfra2['name']; ?></th>

    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $science_progressclr; ?>;"><?php if(!empty($row_stem_models_data['EWork_progress'])){ if($row_stem_models_data['EWork_progress']=='NA'){ echo "NA";}else{ echo $row_stem_models_data['EWork_progress'].'%';}  }else{ echo "0%";}  ?></th>



    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $math_progressclr; ?>;"><?php if(!empty($row_stem_models_data['modelDesks_progress'])){ if($row_stem_models_data['modelDesks_progress']=='NA'){ echo "NA";}else{ echo $row_stem_models_data['modelDesks_progress'].'%';}  }else{ echo "0%";}  ?></th>



    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $robotics_progressclr; ?>;"><?php if(!empty($row_stem_models_data['cupboard_progress'])){ if($row_stem_models_data['cupboard_progress']=='NA'){ echo "NA";}else{ echo $row_stem_models_data['cupboard_progress'].'%';}  }else{ echo "0%";}  ?></th>



    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $computer_progressclr; ?>;"><?php if(!empty($row_stem_models_data['Solar_progress'])){ if($row_stem_models_data['Solar_progress']=='NA'){ echo "NA";}else{ echo $row_stem_models_data['Solar_progress'].'%';}  }else{ echo "0%";}  ?></th>



    <!--  <th class="fontcolor"><a target="_blank" href="steminfrabefore.php?schoolid=<?php echo $steminfra['sno']; ?>&user=<?php echo $row_stem_models_data['user_id']; ?>"><img src="https://i.postimg.cc/zvhWkmCP/imgicon.png" class="wpimg"></a></th> -->

     <th class="fontcolor"><a target="_blank" href="StemStcWip.php?schoolid=<?php echo $row_stem_models_data['schoolid']; ?>&user=<?php echo $row_stem_models_data['user_id']; ?>"><img src="https://i.postimg.cc/zvhWkmCP/imgicon.png" class="wpimg"></a></th>

    <th class="fontcolor"><a target="_blank" href="StemStcAfter.php?schoolid=<?php echo $row_stem_models_data['schoolid']; ?>&user=<?php echo $row_stem_models_data['user_id']; ?>"><img src="https://i.postimg.cc/zvhWkmCP/imgicon.png" class="wpimg"></a></th>

  </tr>

 <?php  }  ?>

</thead>

    </tbody>

  </table>

  

      </div>

    </div>

<?php }else{ ?>

<div class="container" id="all_get_locations_wise_infra">

      <div class="row">

        

      <table class="table table-bordered">

    <thead>

      <tr style="text-align: center;  background-color: #ffc107"> 

       <th colspan="10" ><h5>Location-Wise Infra Status</h5></th>

       </tr>

      

  <tr style="background-color: #ffc107">

   <th style="text-align: center;">City</th>

    <th style="text-align: center;">School</th>

    <th style="text-align: center;">Electricals</th>

    <th style="text-align: center;">Painting</th>

    <th style="text-align: center;">Model Desks</th>

    <th style="text-align: center;">Cupboard</th>

    <th style="text-align: center;">Flooring</th>

    <th style="text-align: center;">Before</th>

    <th style="text-align: center;">WIP</th>

    <th style="text-align: center;">After</th>

  </tr>

<?php $infradata = "select * from project_school inner join school on school.id=project_school.school_id where project_school.project_id = '".$_GET['pid']."' and project_school.delete_flag=0 order by school.city";

 $result = $con -> query($infradata);

$i=0; 

while($data=mysqli_fetch_assoc($result)){

  $row[$i]=$data;

  $i++;

}



foreach($row as $steminfra){

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
if ($result_stem_lab_infra_data) {
$row_stem_lab_infra_data = $result_stem_lab_infra_data->fetch_assoc();
if ($row_stem_lab_infra_data){
  $flooring_progress = $row_stem_lab_infra_data['flooring_progress'];



  // if (($value > 1 && $value < 10) || ($value > 20 && $value < 40))



  if($flooring_progress>=100){

   $flooring_progressclr = '#59b71ab8';

  }elseif($flooring_progress>100 || $flooring_progress>=1){

   $flooring_progressclr = '#ed7d31';

  }elseif($flooring_progress=='NA'){

   $flooring_progressclr = '#a5a5a5';

  }else{

    $flooring_progressclr = '#FF0000';

  }





  $painting_progress = $row_stem_lab_infra_data['painting_progress'];

  if($painting_progress>=100){

   $painting_progressclr = '#59b71ab8';

  }elseif($painting_progress>100 || $painting_progress>=1){

   $painting_progressclr = '#ed7d31';

  }elseif($painting_progress=='NA'){

   $painting_progressclr = '#a5a5a5';

  }else{

    $painting_progressclr = '#FF0000';

  }



  $modelDesks_progress = $row_stem_lab_infra_data['modelDesks_progress'];

  if($modelDesks_progress>=100){

   $modelDesks_progressclr = '#59b71ab8';

  }elseif($modelDesks_progress>100 || $modelDesks_progress>=1){

   $modelDesks_progressclr = '#ed7d31';

  }elseif($modelDesks_progress=='NA'){

   $modelDesks_progressclr = '#a5a5a5';

  }else{

    $modelDesks_progressclr = '#FF0000';

  }



  $EWork_progress = $row_stem_lab_infra_data['EWork_progress'];

  if($EWork_progress>=100){

   $EWork_progressclr = '#59b71ab8';

  }elseif($EWork_progress>100 || $EWork_progress>=1){

   $EWork_progressclr = '#ed7d31';

  }elseif($EWork_progress=='NA'){

   $EWork_progressclr = '#a5a5a5';

  }else{

    $EWork_progressclr = '#FF0000';

  }



  $cupboard_progress = $row_stem_lab_infra_data['cupboard_progress'];

  if($cupboard_progress>=100){

   $cupboard_progressclr = '#59b71ab8';

  }elseif($cupboard_progress>100 || $cupboard_progress>=1){

   $cupboard_progressclr = '#ed7d31';

  }elseif($cupboard_progress=='NA'){

   $cupboard_progressclr = '#a5a5a5';

  }else{

    $cupboard_progressclr = '#FF0000';

  }

 ?>

<tr>

  <?php

if($cekinstansi!=$steminfra['city']){

    echo '<th id="city"' .($total[$steminfra['city']]['jml']>1?' rowspan="' .($total[$steminfra['city']]['jml']).'">':'>') .$steminfra['city'].'</th>';

    $cekinstansi=$steminfra['city'];

  }

   ?>

   <!--  <th ><p><?php echo $steminfra['city']; ?></p></th> -->

    <th class="padd" id="school"><?php echo $steminfra['name']; ?></th>



    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $EWork_progressclr; ?>;"><?php if(!empty($row_stem_lab_infra_data['EWork_progress'])){ if($row_stem_lab_infra_data['EWork_progress']=='NA'){ echo "NA";}else{ echo $row_stem_lab_infra_data['EWork_progress'].'%';}  }else{ echo "0%";}  ?></th>



    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $painting_progressclr; ?>;"><?php if(!empty($row_stem_lab_infra_data['painting_progress'])){ if($row_stem_lab_infra_data['painting_progress']=='NA'){ echo "NA";}else{ echo $row_stem_lab_infra_data['painting_progress'].'%';}  }else{ echo "0%";}  ?></th>



    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $modelDesks_progressclr; ?>;"><?php if(!empty($row_stem_lab_infra_data['modelDesks_progress'])){ if($row_stem_lab_infra_data['modelDesks_progress']=='NA'){ echo "NA";}else{ echo $row_stem_lab_infra_data['modelDesks_progress'].'%';}  }else{ echo "0%";}  ?></th>

    

    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $cupboard_progressclr; ?>;"><?php if(!empty($row_stem_lab_infra_data['cupboard_progress'])){ if($row_stem_lab_infra_data['cupboard_progress']=='NA'){ echo "NA";}else{ echo $row_stem_lab_infra_data['cupboard_progress'].'%';}  }else{ echo "0%";}  ?></th>



    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $flooring_progressclr; ?>;"><?php if(!empty($row_stem_lab_infra_data['flooring_progress'])){ if($row_stem_lab_infra_data['flooring_progress']=='NA'){ echo "NA";}else{ echo $row_stem_lab_infra_data['flooring_progress'].'%';}  }else{ echo "0%";}  ?></th>

    

     <th class="fontcolor"><a target="_blank" href="steminfrabefore.php?schoolid=<?php echo $steminfra['sno']; ?>&user=<?php echo $row_stem_lab_infra_data['user_id']; ?>" ><img src="https://i.postimg.cc/zvhWkmCP/imgicon.png" class="wpimg"></a></th>

     <th class="fontcolor"><a target="_blank" href="steminfrawip.php?schoolid=<?php echo $row_stem_lab_infra_data['schoolid']; ?>&user=<?php echo $row_stem_lab_infra_data['user_id']; ?>"><img src="https://i.postimg.cc/zvhWkmCP/imgicon.png" class="wpimg"></a></th>

    <th class="fontcolor"><a target="_blank" href="steminfraafter.php?schoolid=<?php echo $row_stem_lab_infra_data['schoolid']; ?>&user=<?php echo $row_stem_lab_infra_data['user_id']; ?>"><img src="https://i.postimg.cc/zvhWkmCP/imgicon.png" class="wpimg"></a></th>

  </tr>

 <?php  }  ?>

</thead>

    </tbody>

  </table>

  

      </div>

    </div>

<?php } ?>

     



<div class="container">

   <div class="row">

        

      <table class="table table-bordered">

    <thead>

      <tr style="text-align: center;  background-color: #ffc107"> 

       <th colspan="10" ><h5>Location-Wise Model setup status</h5></th>

       </tr>

  <tr style="background-color: #ffc107">

    <th style="width: 0px; text-align: center;">City</th>

    <th style="text-align: center;">School</th>

    <th style="text-align: center;">Science</th>

    <th style="text-align: center;">Math</th>

    <th style="text-align: center;">Robotics</th>

    <th style="text-align: center;">Computer</th>

   <!--  <th style="text-align: center;">Before</th> -->

    <th style="text-align: center;">WIP</th>

    <th style="text-align: center;">After</th>

  </tr>

<?php $infradata2 = "select * from project_school inner join school on school.id=project_school.school_id where project_school.project_id = '".$_GET['pid']."' and project_school.delete_flag=0 order by school.city";

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
if ($result_stem_models_data){
$row_stem_models_data = $result_stem_models_data->fetch_assoc();
if ($row_stem_models_data){


 

 $rows2 = mysqli_num_rows($result2); 

  $science_progress = $row_stem_models_data['science_progress'];



  // if (($value > 1 && $value < 10) || ($value > 20 && $value < 40))



  if($science_progress>=100){

   $science_progressclr = '#59b71ab8';

  }elseif($science_progress>100 || $row_stem_models_data>=1){

   $science_progressclr = '#ed7d31';

  }elseif($science_progress=='NA'){

   $science_progressclr = '#a5a5a5';

  }else{

    $science_progressclr = '#FF0000';

  }





  $math_progress = $row_stem_models_data['math_progress'];

  if($math_progress>=100){

   $math_progressclr = '#59b71ab8';

  }elseif($math_progress>100 || $math_progress>=1){

   $math_progressclr = '#ed7d31';

  }elseif($math_progress=='NA'){

   $math_progressclr = '#a5a5a5';

  }else{

    $math_progressclr = '#FF0000';

  }



  $robotics_progress = $row_stem_models_data['robotics_progress'];

  if($robotics_progress>=100){

   $robotics_progressclr = '#59b71ab8';

  }elseif($robotics_progress>100 || $robotics_progress>=1){

   $robotics_progressclr = '#ed7d31';

  }elseif($robotics_progress=='NA'){

   $robotics_progressclr = '#a5a5a5';

  }else{

    $robotics_progressclr = '#FF0000';

  }



  $computer_progress = $row_stem_models_data['computer_progress'];

  if($computer_progress>=100){

   $computer_progressclr = '#59b71ab8';

  }elseif($computer_progress>100 || $computer_progress>=1){

   $computer_progressclr = '#ed7d31';

  }elseif($computer_progress=='NA'){

   $computer_progressclr = '#a5a5a5';

  }else{

    $computer_progressclr = '#FF0000';

  }



 ?>

<tr>

   <?php

if($cekinstansi2!=$steminfra2['city']){

    echo '<th id="city"' .($total2[$steminfra2['city']]['jml']>1?' rowspan="' .($total2[$steminfra2['city']]['jml']).'">':'>') .$steminfra2['city'].'</th>';

    $cekinstansi2=$steminfra2['city'];

  }

   ?>



    <th id="school"><?php echo $steminfra2['name']; ?></th>



    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $science_progressclr; ?>;"><?php if(!empty($row_stem_models_data['science_progress'])){ if($row_stem_models_data['science_progress']=='NA'){ echo "NA";}else{ echo $row_stem_models_data['science_progress'].'%';}  }else{ echo "0%";}  ?></th>



     <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $math_progressclr; ?>;"><?php if(!empty($row_stem_models_data['math_progress'])){ if($row_stem_models_data['math_progress']=='NA'){ echo "NA";}else{ echo $row_stem_models_data['math_progress'].'%';}  }else{ echo "0%";}  ?></th>



     <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $robotics_progressclr; ?>;"><?php if(!empty($row_stem_models_data['robotics_progress'])){ if($row_stem_models_data['robotics_progress']=='NA'){ echo "NA";}else{ echo $row_stem_models_data['robotics_progress'].'%';}  }else{ echo "0%";}  ?></th>



     <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $computer_progressclr; ?>;"><?php if(!empty($row_stem_models_data['computer_progress'])){ if($row_stem_models_data['computer_progress']=='NA'){ echo "NA";}else{ echo $row_stem_models_data['computer_progress'].'%';}  }else{ echo "0%";}  ?></th>

     

     <!-- <th class="fontcolor"><a target="_blank" href="steminfrabefore.php?schoolid=<?php echo $steminfra['sno']; ?>&user=<?php echo $row_stem_lab_infra_data['user_id']; ?>" ><img src="https://i.postimg.cc/zvhWkmCP/imgicon.png" class="wpimg"></a></th> -->

     <th class="fontcolor"><a target="_blank" href="stemmodelwip.php?schoolid=<?php echo $row_stem_models_data['schoolid']; ?>&user=<?php echo $row_stem_models_data['user_id']; ?>"><img src="https://i.postimg.cc/zvhWkmCP/imgicon.png" class="wpimg"></a></th>

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

      <tr style="text-align: center;  background-color: #ffc107"> 

       <th colspan="10" ><h5>Location-Wise Posters delivery Status</h5></th>

       </tr>

      

  <tr style="background-color: #ffc107">



    <th style="width: 141px !important; text-align: center;">City</th>

    <th style="text-align: center;">School</th>

    <th style="text-align: center;">Branding Wall</th>

    <th style="text-align: center;">Concepts</th>

    <th style="text-align: center;">Solar System</th>

    <th style="text-align: center;">Innovation Corner</th>

    <th style="text-align: center;">Cutouts</th>

   <!--  <th style="text-align: center;">Before</th> -->

    <th style="text-align: center;">WIP</th>

    <th style="text-align: center;">After</th>

  </tr>
  </thead>
<?php $infradata3 = "select * from project_school inner join school on school.id=project_school.school_id where project_school.project_id = '".$_GET['pid']."' and project_school.delete_flag=0 order by school.city";

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
if ($result_stempostersdata){
$row_stempostersdata = $result_stempostersdata->fetch_assoc();

if ($row_stempostersdata) {

 

  $bWall_progress = $row_stempostersdata['bWall_progress'];



  // if (($value > 1 && $value < 10) || ($value > 20 && $value < 40))



  if($bWall_progress>=100){

   $bWall_progressclr = '#59b71ab8';

  }elseif($bWall_progress>100 || $bWall_progress>=1){

   $bWall_progressclr = '#ed7d31';

  }elseif($bWall_progress=='NA'){

   $bWall_progressclr = '#a5a5a5';

  }else{

    $bWall_progressclr = '#FF0000';

  }





  $concepts_progress = $row_stempostersdata['concepts_progress'];

  if($concepts_progress>=100){

   $concepts_progressclr = '#59b71ab8';

  }elseif($concepts_progress>100 || $concepts_progress>=1){

   $concepts_progressclr = '#ed7d31';

  }elseif($concepts_progress=='NA'){

   $concepts_progressclr = '#a5a5a5';

  }else{

    $concepts_progressclr = '#FF0000';

  }



  $sSystem_progress = $row_stempostersdata['sSystem_progress'];

  if($sSystem_progress>=100){

   $sSystem_progressclr = '#59b71ab8';

  }elseif($sSystem_progress>100 || $sSystem_progress>=1){

   $sSystem_progressclr = '#ed7d31';

  }elseif($sSystem_progress=='NA'){

   $sSystem_progressclr = '#a5a5a5';

  }else{

    $sSystem_progressclr = '#FF0000';

  }



  $inCorner_progress = $row_stempostersdata['inCorner_progress'];

  if($inCorner_progress>=100){

   $inCorner_progressclr = '#59b71ab8';

  }elseif($inCorner_progress>100 || $inCorner_progress>=1){

   $inCorner_progressclr = '#ed7d31';

  }elseif($inCorner_progress=='NA'){

   $inCorner_progressclr = '#a5a5a5';

  }else{

    $inCorner_progressclr = '#FF0000';

  }



  $cutouts_progress = $row_stempostersdata['cutouts_progress'];

  if($cutouts_progress>=100){

   $cutouts_progressclr = '#59b71ab8';

  }elseif($cutouts_progress>100 || $cutouts_progress>=1){

   $cutouts_progressclr = '#ed7d31';

  }elseif($cutouts_progress=='NA'){

   $cutouts_progressclr = '#a5a5a5';

  }else{

    $cutouts_progressclr = '#FF0000';

  }

 ?>
<tbody>
<tr>

     <?php

if($cekinstansi3!=$steminfra3['city']){

    echo '<th id="city"' .($total3[$steminfra3['city']]['jml']>1?' rowspan="' .($total3[$steminfra3['city']]['jml']).'">':'>') .$steminfra3['city'].'</th>';

    $cekinstansi3=$steminfra3['city'];

  }

   ?>

    <th id="school"><?php echo $steminfra3['name']; ?></th>



    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $bWall_progressclr; ?>;"><?php if(!empty($row_stempostersdata['bWall_progress'])){ if($row_stempostersdata['bWall_progress']=='NA'){ echo "<span class='NAcolor'>NA</span>";}else{ echo $row_stempostersdata['bWall_progress'].'%';}  }else{ echo "0%";}  ?></th>



    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $concepts_progressclr; ?>;"><?php if(!empty($row_stempostersdata['concepts_progress'])){ if($row_stempostersdata['concepts_progress']=='NA'){ echo "NA";}else{ echo $row_stempostersdata['concepts_progress'].'%';}  }else{ echo "0%";}  ?></th>

     

     <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $sSystem_progressclr; ?>;"><?php if(!empty($row_stempostersdata['sSystem_progress'])){ if($row_stempostersdata['sSystem_progress']=='NA'){ echo "NA";}else{ echo $row_stempostersdata['sSystem_progress'].'%';}  }else{ echo "0%";}  ?></th>



      <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $inCorner_progressclr; ?>;"><?php if(!empty($row_stempostersdata['inCorner_progress'])){ if($row_stempostersdata['inCorner_progress']=='NA'){ echo "NA";}else{ echo $row_stempostersdata['inCorner_progress'].'%';}  }else{ echo "0%";}  ?></th>



       <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $cutouts_progressclr; ?>;"><?php if(!empty($row_stempostersdata['cutouts_progress'])){ if($row_stempostersdata['cutouts_progress']=='NA'){ echo "NA";}else{ echo $row_stempostersdata['cutouts_progress'].'%';}  }else{ echo "0%";}  ?></th>



     <!-- <th class="fontcolor"><a target="_blank" href="steminfrabefore.php?schoolid=<?php echo $steminfra['sno']; ?>&user=<?php echo $row_stem_lab_infra_data['user_id']; ?>" ><img src="https://i.postimg.cc/zvhWkmCP/imgicon.png" class="wpimg"></a></th> -->

     <th class="fontcolor"><a target="_blank" href="stemposterswip.php?schoolid=<?php echo $row_stempostersdata['schoolid']; ?>&user=<?php echo $row_stempostersdata['user_id']; ?>"><img src="https://i.postimg.cc/zvhWkmCP/imgicon.png" class="wpimg"></a></th>

    <th class="fontcolor"><a target="_blank" href="stempostersafter.php?schoolid=<?php echo $row_stempostersdata['schoolid']; ?>&user=<?php echo $row_stempostersdata['user_id']; ?>"><img src="https://i.postimg.cc/zvhWkmCP/imgicon.png" class="wpimg"></a></th>

  </tr>

 <?php  } }} }}?>



    </tbody>

  </table>

      </div>

    </div>





    



 <?php if($_GET['pid'] =='5744'){ ?>

    <!-- STEM Infra Material Delivery -->



<div class="container">

   <div class="row">

        

      <table class="table table-bordered">

    <thead>

      <tr style="text-align: center;  background-color: #ffc107"> 

       <th colspan="10" ><h5>STEM Infra Material Delivery</h5></th>

       </tr>

  <tr style="background-color: #ffc107">

    <th style="width: 0px; text-align: center;">City</th>

    <th style="text-align: center;">School</th>

    <th style="text-align: center;">Electric Work</th>

    <th style="text-align: center;">Painting</th>

    <th style="text-align: center;">Model Desks</th>

    <th style="text-align: center;">Cupboard</th>

    <th style="text-align: center;">Flooring</th>

    <th style="text-align: center;">Solar power</th>

    <th style="text-align: center;">Photos</th>

  </tr>

<?php $infradata22 = "select * from project_school inner join school on school.id=project_school.school_id where project_school.project_id = '".$_GET['pid']."' and project_school.delete_flag=0 order by school.city";

 $result22 = $con -> query($infradata22);

 $i=0; 

while($data22=mysqli_fetch_assoc($result22)){

  $row22[$i]=$data22;

  $i++;

}

foreach($row22 as $steminfra22){

  if(isset($total22[$steminfra22['city']]['jml'])) { 

    $total22[$steminfra22['city']]['jml']++; 

  }else{

    $total22[$steminfra22['city']]['jml']=1; 

  } 

}





 $n22=count($row22);

 $cekinstansi22="";

for($i=0;$i<$n22;$i++){

$steminfra22=$row22[$i];

   $stem_models_data2 = "select * from steminframaterialdelivery inner join school on school.id=steminframaterialdelivery.schoolid where steminframaterialdelivery.schoolid = '".$steminfra22['school_id']."'  order by school.city";

$result_stem_models_data2 = $mysqli->query($stem_models_data2);

$row_stem_models_data2 = $result_stem_models_data2->fetch_assoc();



 

 $rows22 = mysqli_num_rows($result22); 

  $science_progress2 = $row_stem_models_data2['EWork_progress'];



  // if (($value > 1 && $value < 10) || ($value > 20 && $value < 40))



  if($science_progress2>=100){

   $EWork_progress = '#59b71ab8';

  }elseif($science_progress2>100 || $row_stem_models_data2>=1){

   $EWork_progress = '#ed7d31';

  }elseif($science_progress2=='NA'){

   $EWork_progress = '#a5a5a5';

  }else{

    $EWork_progress = '#FF0000';

  }





  $math_progress2 = $row_stem_models_data2['painting_progress'];

  if($math_progress2>=100){

   $painting_progress = '#59b71ab8';

  }elseif($math_progress2>100 || $math_progress2>=1){

   $painting_progress = '#ed7d31';

  }elseif($math_progress2=='NA'){

   $painting_progress = '#a5a5a5';

  }else{

    $painting_progress = '#FF0000';

  }



  $robotics_progress2 = $row_stem_models_data2['modelDesks_progress'];

  if($robotics_progress2>=100){

   $modelDesks_progress = '#59b71ab8';

  }elseif($robotics_progress2>100 || $robotics_progress2>=1){

   $modelDesks_progress = '#ed7d31';

  }elseif($robotics_progress2=='NA'){

   $modelDesks_progress = '#a5a5a5';

  }else{

    $modelDesks_progress = '#FF0000';

  }



  $computer_progress2 = $row_stem_models_data2['cupboard_progress'];

  if($computer_progress2>=100){

   $cupboard_progress = '#59b71ab8';

  }elseif($computer_progress2>100 || $computer_progress2>=1){

   $cupboard_progress = '#ed7d31';

  }elseif($computer_progress2=='NA'){

   $cupboard_progress = '#a5a5a5';

  }else{

    $cupboard_progress = '#FF0000';

  }





  $flooring_progress2 = $row_stem_models_data2['flooring_progress'];

  if($flooring_progress2>=100){

   $flooring_progress = '#59b71ab8';

  }elseif($flooring_progress2>100 || $flooring_progress2>=1){

   $flooring_progress = '#ed7d31';

  }elseif($flooring_progress2=='NA'){

   $flooring_progress = '#a5a5a5';

  }else{

    $flooring_progress = '#FF0000';

  }



   $Solar_progress2 = $row_stem_models_data2['Solar_progress'];

  if($Solar_progress2>=100){

   $Solar_progress = '#59b71ab8';

  }elseif($Solar_progress2>100 || $Solar_progress2>=1){

   $Solar_progress = '#ed7d31';

  }elseif($Solar_progress2=='NA'){

   $Solar_progress = '#a5a5a5';

  }else{

    $Solar_progress = '#FF0000';

  }



 ?>

<tr>

   <?php

if($cekinstansi22!=$steminfra22['city']){

    echo '<th id="city"' .($total22[$steminfra22['city']]['jml']>1?' rowspan="' .($total22[$steminfra22['city']]['jml']).'">':'>') .$steminfra22['city'].'</th>';

    $cekinstansi22=$steminfra22['city'];

  }

   ?>



    <th id="school"><?php echo $steminfra22['name']; ?></th>



    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $EWork_progress; ?>;"><?php if(!empty($row_stem_models_data2['EWork_progress'])){ if($row_stem_models_data2['EWork_progress']=='NA'){ echo "NA";}else{ echo $row_stem_models_data2['EWork_progress'].'%';}  }else{ echo "0%";}  ?></th>



    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $painting_progress; ?>;"><?php if(!empty($row_stem_models_data2['painting_progress'])){ if($row_stem_models_data2['painting_progress']=='NA'){ echo "NA";}else{ echo $row_stem_models_data2['painting_progress'].'%';}  }else{ echo "0%";}  ?></th>



    <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $modelDesks_progress; ?>;"><?php if(!empty($row_stem_models_data2['modelDesks_progress'])){ if($row_stem_models_data2['modelDesks_progress']=='NA'){ echo "NA";}else{ echo $row_stem_models_data2['modelDesks_progress'].'%';}  }else{ echo "0%";}  ?></th>



     <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $cupboard_progress; ?>;"><?php if(!empty($row_stem_models_data2['cupboard_progress'])){ if($row_stem_models_data2['cupboard_progress']=='NA'){ echo "NA";}else{ echo $row_stem_models_data2['cupboard_progress'].'%';}  }else{ echo "0%";}  ?></th>



     <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $flooring_progress; ?>;"><?php if(!empty($row_stem_models_data2['flooring_progress'])){ if($row_stem_models_data2['flooring_progress']=='NA'){ echo "NA";}else{ echo $row_stem_models_data2['flooring_progress'].'%';}  }else{ echo "0%";}  ?></th>



     <th class="fontcolor" id="stemstatus" style="text-align: center;background-color: <?php echo $Solar_progress; ?>;"><?php if(!empty($row_stem_models_data2['Solar_progress'])){ if($row_stem_models_data2['Solar_progress']=='NA'){ echo "NA";}else{ echo $row_stem_models_data2['Solar_progress'].'%';}  }else{ echo "0%";}  ?></th>

  

    <th class="fontcolor"><a target="_blank" href="steminfradelivery.php?schoolid=<?php echo $row_stem_models_data2['schoolid']; ?>&user=<?php echo $row_stem_models_data2['user_id']; ?>"><img src="https://i.postimg.cc/zvhWkmCP/imgicon.png" class="wpimg"></a></th>

  </tr>

 <?php  } }} ?>

</thead>

    </tbody>

  </table>

  

      </div>

    </div>

<?php

}?>



<script type="text/javascript" src="js/chart_dash.js"></script>

<script type="text/javascript">



  $(".get_locations").on("change",function(e){

   var Location = $("#get_locations").val();

   //alert(Location);

   var projectid = <?php echo $_GET['pid']; ?>;

   $("#Locations_data").html('');

      $.ajax({

        url:"get_locations_data.php",

        method:"GET",

        data:{Location: Location, projectid:projectid},

        success:function(html){

          console.log(html);

           $("#Locations_data").append(html);

           $("#all_stem_data").hide();

           

        },

      })

    })



  $(".get_locations_wise_infra").on("change",function(e){

   var Location = $("#get_locations_wise_infra").val();

 // alert(Location); exit;

   var projectid = <?php echo $_GET['pid']; ?>;

   $("#Locations_data").html('');

      $.ajax({

        url:"get_locations_wise_infra.php",

        method:"GET",

        data:{Location: Location, projectid:projectid},

        success:function(html){

          console.log(html);

           $("#get_locations_wise_infra").append(html);

           $("#all_get_locations_wise_infra").hide();

           

        },

      })

    })





  





  $("#stats_button").on('click',function(){



    let pid = $("#project_drop").val();

    window.open("stem_dashboard.php?pid="+pid, "_self");

});

</script>