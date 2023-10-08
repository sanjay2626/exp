<?php
  
  require_once('connection.php');

  require_once('check_login.php');

  require_once('head.php');

//  require_once('card_generator.php');
?>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.5.0"></script>
<script>
    Chart.helpers.merge(Chart.defaults.global.plugins.datalabels, {
    align: "top",
    anchor: "end"
});
</script>



<?php
  $dataPointsx = array();
  $dataPointsy = array();
  try{
    $handle = $con_new->prepare("select * from project_school inner join school on school.id=project_school.school_id where project_school.project_id = '".$_GET['pid']."' and project_school.delete_flag=0 order by school.city"); 
    $handle->execute(); 
    $result = $handle->fetchAll(\PDO::FETCH_OBJ);
    foreach($result as $row){
        array_push($dataPointsx,$row->name);
        array_push($dataPointsy, $row->id);

    }
    $link = null;
  }
  catch(\PDOException $ex){    print($ex->getMessage());}
?>

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
$chart = array(
  'project' => array(),
  'program' => array(),
  'module' => array(),
  'school' => array(),
);


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

    </style>

  <!--   <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->

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

<center>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark" style="background-color: #ffffff!important;

">



<?php

    if (in_array("13",$_SESSION['permissions'])) { ?>



  <div class="container-fluid">

    <ul class="nav justify-content-end">

      <li class="nav-item">

        <a class="nav-link" href="school_report.php?pid=<?php echo $_GET['pid']; ?>">School Profile Report</a>

      </li>

      <li class="nav-item">

        <a class="nav-link" href="academic.php?pid=<?php echo $_GET['pid']; ?>">Academic Report</a>

      </li>

      <li class="nav-item">

        <a class="nav-link" href="custom_report.php">Custom Report</a>

      </li>



       <?php if($_SESSION['user_role']!='7'){ ?>

      <li class="nav-item">

        <a class="nav-link" href="stem_dashboard.php?pid=<?php echo $_GET['pid']; ?>">Stem Infra</a>

      </li> <?php } ?>



      

      <li class="nav-item">

        <a class="nav-link text-right" href="#">Photo Album</a>

      </li>

      

       <li class="nav-item">

        <a class="nav-link text-right" href="impact_assessment.php?pid=<?php echo $_GET['pid']; ?>">Impact Assessment</a>

      </li>

    </ul>

  </div>



    <?php }else{ ?> 

<div class="container-fluid">

    <ul class="nav justify-content-end">

      <li class="nav-item">

        <a class="nav-link" href="school_report.php?pid=<?php echo $_GET['pid']; ?>">School Profile Report</a>

      </li>

      

      <?php if($_SESSION['user_role']!='17'){ ?>

       <li class="nav-item">

        <a class="nav-link" href="academic.php?pid=<?php echo $_GET['pid']; ?>">Academic Report</a>

      </li> <?php } ?>

      

     

      <li class="nav-item">

        <a class="nav-link" href="custom_report.php">Custom Report</a>

      </li>



      <li class="nav-item">

        <a class="nav-link" href="dashboard.php?pid=<?php echo $_GET['pid']; ?>">Stem Infra</a>

      </li>



      

      <li class="nav-item">

        <a class="nav-link text-right" href="#">Photo Album</a>

      </li>

      

       <li class="nav-item">

        <a class="nav-link text-right" href="impact_assessment.php?pid=<?php echo $_GET['pid']; ?>">Impact Assessment</a>

      </li> 

    </ul>

  </div>



    <?php } ?>



</nav>

  </center>



    

    

   <!--  <div class="container">

        <div class="row justify-content-center" style="margin-bottom:10px">

            <h3 style="padding:15px" class="head">Project</h3>

        </div>

        <p style="text-align: center;"><?php echo $description; ?></p>

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

    </div><hr> -->



    <?php if(!empty($chart == null)){ ?> 

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

  const labels = <?php echo json_encode($dataPointsx); ?>;



  const data = {

    labels: labels,

    datasets: [{

      label: 'School Data',

      backgroundColor: 'rgb(255, 99, 132)',

      borderColor: 'rgb(255, 99, 132)',

      data: [],

    }]

  };



  const config = {

    type: 'bar',

    data: data,

    options: {}

  };

</script>



<div  class=" section container-fluid">

      <h2 class="head">School Sessions Data</h2>

      <div class="container">

        <div class="row justify-content-center">

             <canvas id="myChart"></canvas>

            

        </div>

      </div>

    </div>



<script>

  const myChart = new Chart(

    document.getElementById('myChart'),

    config

  );

</script>





     <?php  } ?> 

   

    <?php



    if(count($chart['program']) > 1){ ?>

    <!-- Program Chart -->

    <div style="background-color:#dfe3e6;" class="section-half" class="container-fluid">

      <div class="container">

        <div class="row justify-content-center">

          <div style="display:flex; justify-content:center; align-items:center" class="col-sm-4">

            <div style="margin-bottom:40px">

              <h2>Program Based</h2>

              <h2>Session Count</h2>

            </div>

          </div>

          <div style="height:400px; padding:20px; background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) !important; "  class="col-sm-8">

           <canvas style="height:350px" id="program_chart">



           </canvas>

          </div>

        </div>

      </div>

    </div>

  <?php } ?>

    <!-- Module Chart --> 

<?php if(count($chart['module']) > 1){ ?>

    <div class="section container-fluid">

      <h2 class="head">Module Based Sessions</h2>

      <div class="container">

        <div class="row justify-content-center">

          <div class="col-sm-10">

            <canvas style="margin-bottom:5vh" class="full"  id="module_chart" >

  

            </canvas>

            <button id="download_module_chart">Download</button>

            <button id="print_module_chart">Print</button>

          </div>

        </div>

      </div>

    </div> 

 <?php } ?>

 <?php if(count($chart['school']) > 1){ ?>

    <!-- School Chart -->

    <div style="background-color:#dfe3e6"  class=" section container-fluid">

      <h2 class="head">School Based Sessions</h2>

      <div class="container">

        <div class="row justify-content-center">

            <canvas class="full" style=" background:white" id="school_chart" >

            </canvas>

        </div>

         <div style="margin-top: 19px;">

              <button id="download_school_chart">Download</button>

              <button id="Print_school_chart">Print</button>

        </div>

      </div>

    </div>

 <?php } ?>

  <?php if(count($chart_grade['total']) > 1){ ?>

    <!-- Grade Chart -->

    <div  class=" section container-fluid">

      <h2 class="head">Grade Based Sessions</h2>

      <div class="container">

        <div class="row justify-content-center">

            <canvas class="full" style=" background:white" id="grade_chart" >

            </canvas>

            

        </div>

        <div style="margin-top: 19px;">

              <button id="download_grade_chart">Download</button>

              <button id="Print_grade_chart">Print</button>

        </div>

      </div>

    </div>

 <?php } ?> 

 <?php if(count($chart['school']) > 1){ ?>

    <!-- Grade School Chart -->

    <div style="background-color:#dfe3e6"  class=" section container-fluid">

      <h2 class="head">Grade wise School wise Sessions</h2>

      <div class="container">

        <div class="row justify-content-center">

            <canvas class="full" style=" background:white" id="grade_school_chart" >

            </canvas>

             

        </div>

        <div style="margin-top: 19px;">

             <button id="download_grade_school_chart">Download</button>

              <button id="Print_grade_school_chart">Print</button>

        </div>

      </div>

    </div>

 <?php } ?>



 <!-- <?php if(count($chart['school']) > 1){ ?>

    <div style="background-color:#dfe3e6"  class=" section container-fluid">

      <h2 class="head">School profile reports</h2>

      <div class="container">

        <div class="row justify-content-center">

            <canvas class="full" style=" background:white" id="grade_school_chart" >

            </canvas>

             

        </div>

        <div style="margin-top: 19px;">

             <button id="download_grade_school_chart">Download</button>

              <button id="Print_grade_school_chart">Print</button>

        </div>

      </div>

    </div>

 <?php } ?> -->



  <?php if(count($chart['school']) > 1){ ?>

    <!--Subject Chart -->

    <div  class=" section container-fluid">

      <h2 class="head">Subject Based Comparison</h2>

      <div class="container">

        <div class="row justify-content-center">

            <canvas class="full" style=" background:white" id="subject_chart" >

            </canvas>

            

        </div>

        <div style="margin-top: 19px;">

            <button id="download_subject_chart">Download</button>

              <button id="Print_subject_chart">Print</button>

        </div>

      </div>

    </div>

     <?php } ?>

      <?php if(count($chart['school']) > 1){ ?>

    <!-- Grade Subject Chart -->

    <div style="background-color:#dfe3e6"  class="section container-fluid">

      <h2 class="head">Grade-Wise Subject-Wise Sessions</h2>

      <div class="container">

        <div class="row justify-content-center">

            <canvas class="full" style=" background:white" id="grade_subject_chart" >

            </canvas>

            

        </div>

        <div style="margin-top: 19px;">

            <button id="download_grade_subject_chart">Download</button>

              <button id="Print_grade_subject_chart">Print</button>

        </div>

      </div>

    </div>

     <?php } ?>

    <!-- Grade School Chart -->

    <!-- <div class="section" class="container-fluid">

      <h2 class="head">Grade wise School wise Sessions</h2>

      <div class="container">

        <div class="row justify-content-center">

            <canvas class="full" style=" background:white" id="grade_school_chart" >

            </canvas>

        </div>

      </div>

    </div> -->



<script type="text/javascript" src="js/chart_dash.js"></script>

<script type="text/javascript">

  $("#stats_button").on('click',function(){



    let pid = $("#project_drop").val();

    window.open("dashboard.php?pid="+pid, "_self");

});

</script>