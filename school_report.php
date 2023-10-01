<?php
  require_once('connection.php');
  require_once('check_login.php');
  require_once('head.php');
//  require_once('card_generator.php');

?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php

if(!empty($_GET['pid'])){
    $nnboysx = array();
$nnboysy = array();
$city = array();
//Best practice is to create a separate file for handling connection to database
try{
  
    $handle = $con_new->prepare("select SUM(nboys) as nnboys , SUM(ngirls) as nngirls, school.city as city from student_count inner join school on school.id=student_count.schoolid where student_count.projectid = '".$_GET['pid']."' group by city"); 
    $handle->execute(); 
    $result = $handle->fetchAll(\PDO::FETCH_OBJ);
    


    
    foreach($result as $row){
        array_push($nnboysx, $row->nnboys);
        array_push($nnboysy, $row->nngirls);
        array_push($city, $row->city);
    }

    // print_r($city); exit;

   // print_r(json_encode($dataPointsy)); exit;
  $link = null;
}
catch(\PDOException $ex){
    print($ex->getMessage());
}



$nnboysx2 = array();
$nnboysy2 = array();
$state = array();
//Best practice is to create a separate file for handling connection to database
try{
  
    $handle2 = $con_new->prepare("select SUM(nboys) as nnboys , SUM(ngirls) as nngirls, school.state as state from student_count inner join school on school.id=student_count.schoolid where student_count.projectid = '".$_GET['pid']."'  group by state"); 
    $handle2->execute(); 
    $result2 = $handle2->fetchAll(\PDO::FETCH_OBJ);
    


    
    foreach($result2 as $row2){
        array_push($nnboysx2, $row2->nnboys);
        array_push($nnboysy2, $row2->nngirls);
        array_push($state, $row2->state);
    }

  // print_r($state); exit;

    // print_r($city); exit;

   // print_r(json_encode($dataPointsy)); exit;
  $link = null;
}
catch(\PDOException $ex){
    print($ex->getMessage());
}
}else{
   $nnboysx = array();
$nnboysy = array();
$city = array();
//Best practice is to create a separate file for handling connection to database
try{
  
    $handle = $con_new->prepare("select SUM(nboys) as nnboys , SUM(ngirls) as nngirls, school.city as city from student_count inner join school on school.id=student_count.schoolid  group by city"); 
    $handle->execute(); 
    $result = $handle->fetchAll(\PDO::FETCH_OBJ);
    


    
    foreach($result as $row){
        array_push($nnboysx, $row->nnboys);
        array_push($nnboysy, $row->nngirls);
        array_push($city, $row->city);
    }

    // print_r($city); exit;

   // print_r(json_encode($dataPointsy)); exit;
  $link = null;
}
catch(\PDOException $ex){
    print($ex->getMessage());
}



$nnboysx2 = array();
$nnboysy2 = array();
$state = array();
//Best practice is to create a separate file for handling connection to database
try{
  
    $handle2 = $con_new->prepare("select SUM(nboys) as nnboys , SUM(ngirls) as nngirls, school.state as state from student_count inner join school on school.id=student_count.schoolid   group by state"); 
    $handle2->execute(); 
    $result2 = $handle2->fetchAll(\PDO::FETCH_OBJ);
    


    
    foreach($result2 as $row2){
        array_push($nnboysx2, $row2->nnboys);
        array_push($nnboysy2, $row2->nngirls);
        array_push($state, $row2->state);
    }

  // print_r($state); exit;

    // print_r($city); exit;

   // print_r(json_encode($dataPointsy)); exit;
  $link = null;
}
catch(\PDOException $ex){
    print($ex->getMessage());
} 
}
 

  
?>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.5.0"></script>
<script>
Chart.helpers.merge(Chart.defaults.global.plugins.datalabels, {
    align: "top",
    anchor: "end"
});
</script>



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
    	 th#stemstatus {
    width: 112px !important;
    }
      th#city {
        width: 142px !important
     }

     th#school {
    width: 152px;
    }

      .table thead th {
    vertical-align: middle !important;
    border-bottom: 2px solid #0C0101 !important;
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
          <h4 class="c"><b>Program<?php if(sizeof($prog_arr>1)){echo "s";} ?></b></h4>
        </div>
        <div class="col-3">
          <h1  class="incremental"><b><?php echo sizeof($module_arr); ?></b></h1>
          <h4 class="c"><b>Module<?php if(sizeof($module_arr>1)){echo "s";} ?></b></h4>
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
     <?php if($_SESSION['user_role']!='17'){ ?>
       <li class="nav-item">
        <a class="nav-link" href="academic.php?pid=<?php echo $_GET['pid']; ?>">Academic Report</a>
      </li> <?php } ?>
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


   <div class="section container-fluid">
      <h2 class="head">City Wise Count of Students Gender Wise</h2>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-sm-10">
            <canvas id="myChart" width="400" height="400"></canvas>
          </div>
        </div>
        <div style="margin-top: 19px;">
            <button id="download_grade_subject_chart">Download</button>
              <button id="Print_grade_subject_chart">Print</button>
        </div>
      </div>
       
    </div> 


    <div class="section container-fluid">
      <h2 class="head">State Wise Count of Students Gender Wise</h2>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-sm-10">
            <canvas id="myChart2" width="400" height="400"></canvas>
          </div>
        </div>
        <div style="margin-top: 19px;">
            <button id="download_grade_subject_chart2">Download</button>
              <button id="Print_grade_subject_chart2">Print</button>
        </div>
      </div>
    </div> 

  <div class="container">
      <div class="row">
        
<script>
const ctx = document.getElementById('myChart');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($city); ?>,
        datasets: [{
      label: 'Boys',
      data: <?php echo json_encode($nnboysx); ?>,
     backgroundColor: [
                'rgba(245, 54, 39, 0.8)'
            ],
       borderWidth: 1,
    },
    {
      label: 'Girls',
     data: <?php echo json_encode($nnboysy); ?>,
       backgroundColor: ['rgba(41, 39, 245, 0.8)'
            ],
      borderWidth: 1,
    }]
    },
     options: {

      scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            title: {
                display: true,
                text: 'City Wise Count of Students Gender Wise'
            }
        }
    } 
});

document.getElementById('download_grade_subject_chart').onclick = function() {
  // Trigger the download
  var a = document.createElement('a');
  a.href = myChart.toBase64Image();
  a.download = 'City_wise_Count_of_Students.png';
  a.click();
}

document.getElementById('Print_grade_subject_chart').onclick = function() {
var canvas = document.getElementById('myChart');
var data = canvas.toDataURL();
var html  = '<html><head><title></title></head>';
    html += '<body style="width: 100%; padding: 0; margin: 0;"';
    html += ' onload="window.focus(); window.print(); window.close()">';
    html += '<img src="' + data + '" /></body></html>';
var printWindow = window.open('_self', 'height=600,width=800');
printWindow.document.open();
printWindow.document.write(html);
printWindow.document.close();
}


const ctx2 = document.getElementById('myChart2');
const myChart2 = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($state); ?>,
        datasets: [{
      label: 'Boys',
      data: <?php echo json_encode($nnboysx2); ?>,
     backgroundColor: [
                'rgba(245, 54, 39, 0.8)'
            ],
       borderWidth: 1,
    },
    {
      label: 'Girls',
     data: <?php echo json_encode($nnboysy2); ?>,
       backgroundColor: ['rgba(41, 39, 245, 0.8)'
            ],
      borderWidth: 1,
    }]
    },
     options: {

      scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            title: {
                display: true,
                text: 'State Wise Count of Students Gender Wise'
            }
        }
    } 
});

document.getElementById('download_grade_subject_chart2').onclick = function() {
  // Trigger the download
  var a = document.createElement('a');
  a.href = myChart2.toBase64Image();
  a.download = 'State_Wise_Count_of_Students.png';
  a.click();
}

document.getElementById('Print_grade_subject_chart2').onclick = function() {
var canvas = document.getElementById('myChart2');
var data = canvas.toDataURL();
var html  = '<html><head><title></title></head>';
    html += '<body style="width: 100%; padding: 0; margin: 0;"';
    html += ' onload="window.focus(); window.print(); window.close()">';
    html += '<img src="' + data + '" /></body></html>';
var printWindow = window.open('_self', 'height=600,width=800');
printWindow.document.open();
printWindow.document.write(html);
printWindow.document.close();
}
</script>

        
     <!--  <table class="table table-bordered">
    <thead>
      <tr style="text-align: center;  background-color: #e99021;"> 
       <th colspan="10"><p style="margin-bottom: 1px; vertical-align: middle !important;">State Wise Count of Students Gender Wise</p></th>
       </tr>
      
  <tr>
   
    <th></th>
    <th style="text-align: center;">Number of Boys</th>
    <th style="text-align: center;">Number of Girls</th>
    <th style="text-align: center;">Total Students</th>
  </tr>

  <?php $infradata = "select SUM(nboys) as nnboys , SUM(ngirls) as nngirls, school.state as state from student_count inner join school on school.id=student_count.schoolid where student_count.projectid = '".$_GET['pid']."'  group by state";
 $result = $con -> query($infradata);

$i=0; 
while($data=mysqli_fetch_assoc($result)){

  $row[$i]=$data;
  $i++;
}

foreach($row as $steminfra){

  if(isset($total[$steminfra['state']]['jml'])) { 
    $total[$steminfra['state']]['jml']++; 
  }else{
    $total[$steminfra['state']]['jml']=1; 
  } 
}

$n=count($row);
 $cekinstansi="";
for($i=0;$i<$n;$i++){

	

 $steminfra=$row[$i];

?>
<tr>
  <?php
if($cekinstansi!=$steminfra['state']){
    echo '<th ' .($total[$steminfra['state']]['jml']>1?' rowspan="' .($total[$steminfra['state']]['jml']).'" >':'>') .$steminfra['state'].'</th>';
    $cekinstansi=$steminfra['state'];
  }else{   ?>
<th rowspan="1">No data</th>
 <?php } ?>
    <th style="text-align: center;background-color: #ff8d00;"><?php echo $steminfra['nnboys']; ?></th>
    <th style="text-align: center;background-color: #ff8d00;" class=""><?php echo $steminfra['nngirls']; ?></th>
    <th style="text-align: center;background-color: #ff8d00;" class=""><?php $total = $steminfra['nnboys']+$steminfra['nngirls']; echo $total;  ?></th>
  </tr>
  <?php  }  ?>
 </thead>
    
  </table>
  
      </div>
    </div>


    <div class="container">
      <div class="row">
        
      <table class="table table-bordered">
    <thead>
      <tr style="text-align: center;  background-color: #e99021;"> 
       <th colspan="10"><p style="margin-bottom: 1px; vertical-align: middle !important;">City Wise Count of Students Gender Wise</p></th>
       </tr>
      
  <tr>
   
    <th></th>
    <th style="text-align: center;">Number of Boys</th>
    <th style="text-align: center;">Number of Girls</th>
    <th style="text-align: center;">Total Students</th>
  </tr>

  <?php $infradata = "select SUM(nboys) as nnboys , SUM(ngirls) as nngirls, school.city as city from student_count inner join school on school.id=student_count.schoolid where student_count.projectid = '".$_GET['pid']."' group by city";

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

?>
<tr>
  <?php
if($cekinstansi!=$steminfra['city']){
    echo '<th ' .($total[$steminfra['city']]['jml']>1?' rowspan="' .($total[$steminfra['city']]['jml']).'" >':'>') .$steminfra['city'].'</th>';
    $cekinstansi=$steminfra['city'];
  }else{   ?>
<th rowspan="1">No data</th>
 <?php } ?>
    <th style="text-align: center;background-color: #ff8d00;"><?php echo $steminfra['nnboys']; ?></th>
    <th style="text-align: center;background-color: #ff8d00;" class=""><?php echo $steminfra['nngirls']; ?></th>
    <th style="text-align: center;background-color: #ff8d00;" class=""><?php $total = $steminfra['nnboys']+$steminfra['nngirls']; echo $total;  ?></th>
  </tr>
  <?php  }  ?>
 </thead>
    
  </table> -->
  
      </div>
    </div>