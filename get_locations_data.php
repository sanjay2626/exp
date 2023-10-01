<?php
  require("connection.php");
  if(isset($_GET['Location']) && !empty($_GET['Location']) ){ ?>
<div class="container">
      <div class="row">
     <table class="table table-bordered" >
    <thead>
      <tr style="background-color: #ffc107;">  
<th rowspan="2">
  <select name="Locations" class="get_locations get_locations2 get_locations23" id="get_locations22">

  <option>Locations</option>
  <option value="all">All Locations</option>
  <?php 
$infradata10 = "select DISTINCT(city) from school
 inner join project_school on school.id=project_school.school_id where project_school.project_id = '".$_GET['projectid']."' and project_school.delete_flag=0 order by school.city";
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
<th rowspan="2">Schools</th>
<th colspan="3" style="text-align: center;"><span >STEM Lab Setup</span></th>
<!--<th rowspan="2" style="text-align: center;">Inaugration Dates</th>-->
<!--<th rowspan="2" style="width: 149px; text-align: center;">Teacher Training Dates</th>-->
<!--<th rowspan="2" style="text-align: center;">Assessment Dates</th>-->
<th rowspan="2" style="text-align: center;">Photos / Video</th>
      </tr>
  <tr style="background-color: #ffc107;">
    <th>Infra</th>
    <th>Models</th>
    <th>Posters</th>
    
  </tr>
  <tr>

    <?php 

$Locations2 = $_GET['Location'];
if($Locations2 =='all'){
$infradata9 = "select * from project_school inner join school on school.id=project_school.school_id where project_school.project_id='".$_GET['projectid']."' and project_school.delete_flag='0' order by school.city";
}else{
$infradata9 = "select * from project_school inner join school on school.id=project_school.school_id where school.city = '".$_GET['Location']."' and project_school.project_id='".$_GET['projectid']."' order by school.city";
}
    
 $result9 = $con -> query($infradata9);
$i=0; 
while($data9=mysqli_fetch_assoc($result9)){
  $row9[$i]=$data9;
  $i++;
}
foreach($row9 as $steminfra9){ 


  if(isset($total9[$steminfra9['city']]['jml'])) { 
    $total9[$steminfra9['city']]['jml']++; 
  }else{
    $total9[$steminfra9['city']]['jml']=1; 
  } 
}

$n9=count($row9);
 $cekinstansi9="";
for($i=0;$i<$n9;$i++){
 $steminfra9=$row9[$i];

  $stem_models_data123 = "select DISTINCT school.id, school.city, school.name, stem_lab_infra_data.EWork_progress, stem_lab_infra_data.painting_progress, stem_lab_infra_data.modelDesks_progress, stem_lab_infra_data.cupboard_progress, stem_lab_infra_data.flooring_progress, stem_models_data.science_progress, stem_models_data.math_progress, stem_models_data.robotics_progress, stem_models_data.computer_progress, stempostersdata.bWall_progress, stempostersdata.concepts_progress, stempostersdata.sSystem_progress, stempostersdata.inCorner_progress, stempostersdata.cutouts_progress, stem_models_data.user_id, stem_lab_infra_data.user_id, stempostersdata.user_id, innaugration.InnaugrationDate , stemimpactassessment.StemImpactDate, teachertraining.teacherTrainingDate, teachertraining.teacherTraining_eDate  from school 
  left join stempostersdata on school.id=stempostersdata.schoolid
  left join stem_lab_infra_data on school.id=stem_lab_infra_data.schoolid
  left join stem_models_data on school.id=stem_models_data.schoolid
  left join innaugration on school.id=innaugration.schoolid
  left join stemimpactassessment on school.id=stemimpactassessment.schoolid
  left join teachertraining on school.id=teachertraining.schoolid

  where stempostersdata.schoolid = '".$steminfra9['school_id']."' OR stem_lab_infra_data.schoolid = '".$steminfra9['school_id']."' OR stem_models_data.schoolid = '".$steminfra9['school_id']."' OR innaugration.schoolid = '".$steminfra9['school_id']."' order by school.city";
   
$result_stem_models_data123 = $mysqli->query($stem_models_data123);
$row_stem_models_data123 = $result_stem_models_data123->fetch_assoc();



 


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
  } ?>



<tr>
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
    <!--<th class="fontcolor" style="text-align: center; <?php  if(!empty($row_stem_models_data123['InnaugrationDate'])){ $date = date('d/m/Y',strtotime($row_stem_models_data123['InnaugrationDate']));  if($date<=date('d/m/Y')){ echo "background-color: #70AD47;";  }else{ echo "background-color: #1DA29F;";   } }else{ echo "background-color: #F83E6A;"; } ?>"><?php if(!empty($row_stem_models_data123['InnaugrationDate'])){echo date('d/m/Y',strtotime($row_stem_models_data123['InnaugrationDate']));}else{ echo "Undecided"; }?></th>-->
  
    <!-- <th class="fontcolor" style="text-align: center; <?php  if(!empty($row_stem_models_data123['teacherTrainingDate'])){ $date = date('d/m/Y',strtotime($row_stem_models_data123['teacherTrainingDate']));  if($date<=date('d/m/Y')){ echo "background-color: #70AD47;";  }else{ echo "background-color: #1DA29F;";   } }else{ echo "background-color: #F83E6A;"; } ?>"><?php if(!empty($row_stem_models_data123['teacherTrainingDate'])){echo date('d/m/Y',strtotime($row_stem_models_data123['teacherTrainingDate']));}else{ echo "Undecided"; } ?></th>-->
    <!--<th class="fontcolor" style="text-align: center;-->
    <!-- <?php  if(!empty($row_stem_models_data123['StemImpactDate'])){ $date = date('d/m/Y',strtotime($row_stem_models_data123['StemImpactDate']));  if($date<=date('d/m/Y')){ echo "background-color: #70AD47;";  }else{ echo "background-color: #1DA29F;";   } }else{ echo "background-color: #F83E6A;"; } ?>"><?php if(!empty($row_stem_models_data123['StemImpactDate'])){echo date('d/m/Y',strtotime($row_stem_models_data123['StemImpactDate']));}else{ echo "Undecided"; } ?></th>-->
     
    <th class="fontcolor" style="text-align: center;"><a target="_blank" href="stemgallery.php?schoolid=<?php echo $steminfra9['school_id']; ?>&user=<?php echo $row_stem_models_data123['user_id']; ?>&sno=<?php echo $steminfra9['sno']; ?>"><img src="https://i.postimg.cc/zvhWkmCP/imgicon.png" class="wpimg"></th>
  </tr> 

<?php }   ?>

</div>
</thead>
</tr>
     <tbody>
  </tbody>
  </table>
  
      </div>
    </div>


 <?php }  ?>


 <script type="text/javascript">

$('body').on('change','#get_locations22',function(){
  var Location = $("#get_locations22").val();
  var projectid = <?php echo $_GET['projectid']; ?>;
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

   

  // $(".get_locations2").on("change",function(e){
  //  var Location = $("#get_locations").val();
  //  //alert(Location);
  //  var projectid = <?php echo $_GET['pid']; ?>;
  //  $("#Locations_data").html('');
  //     $.ajax({
  //       url:"get_locations_data.php",
  //       method:"GET",
  //       data:{Location: Location, projectid:projectid},
  //       success:function(html){
  //         console.log(html);
  //          $("#Locations_data").append(html);
  //          $("#all_stem_data").hide();
           
  //       },
  //     })
  //   })


  $("#stats_button").on('click',function(){

    let pid = $("#project_drop").val();
    window.open("dashboard.php?pid="+pid, "_self");
});
</script>