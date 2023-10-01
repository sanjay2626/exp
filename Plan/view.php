<?php
  require 'connect.php';
  require '../check_login.php';
  require '../head.php';
  if(!empty($_GET['plan_id'])){
    $query = "SELECT * FROM plans where id=:id";
    $statement = $conn -> prepare($query) or die("prepare error!\n".$query);
    $statement -> bindParam(":id",$_GET['plan_id'],PDO::PARAM_INT);
    try{
      $statement -> execute();
      $row = $statement -> fetch();

      if($row['teacher_id'] != $_SESSION['exp_dash_id']){
        header("location:view_plan.php");
      }
      // fehcing filled grades
      for($i=1;$i<11;$i++){
        if(!empty($row['grade_'.$i])){
          $grades[$i] = $row['grade_'.$i];
        }
      }
    }
    catch(PDOException $ex){
      echo ($ex->getMessage());
      }
  }else{
    header("location:view_plan.php");
  }
  $project_program_query = "SELECT id,name,program_id from project
  where id in({$_SESSION['projects']}) and delete_flag=0";
  $project_program_result = mysqli_query($con,$project_program_query);
  while($project_program_row = mysqli_fetch_assoc($project_program_result)){
    $project[$project_program_row['id']]['name']=$project_program_row['name'];
    $project[$project_program_row['id']]['school']=[];
    $project[$project_program_row['id']]['program']=$project_program_row['program_id'];
  }

  $prog_arr = [];
  foreach ($project as $key => $value) {
      foreach (explode(",",$value['program']) as $program) {
        if(!in_array($program,$prog_arr)){
          array_push($prog_arr,$program);
        }
      }
  }
  $programs = join(",",$prog_arr);
  //program names array
  $programs_query = "SELECT id,name,module_list from program where id in({$programs}) and delete_flag=0";
  $programs_res = mysqli_query($con,$programs_query) or die(mysqli_error($con));
  while($prog_row = mysqli_fetch_assoc($programs_res)) {
    $program_names[$prog_row['id']]=$prog_row['name'];
    $program_modules[$prog_row['id']]=$prog_row['module_list'];
   }

   $all_modules = [];
   foreach ($program_modules as $key => $value) {
       foreach (explode(",",$value) as $module) {
         if(!in_array($module,array_keys($all_modules))){
           $all_modules[$module] = $_SESSION['module_name'][$module];
         }
       }
   }

   //fetch progress
   $running_taken = "SELECT COUNT(*) as count,grade FROM session_completed where
   session_user_id='{$_SESSION['exp_dash_id']}' and session_date<=:to_date
   and session_date>=:from_date and school_id=:school_id and  module_id=:module_id group by grade";
   $statement = $conn -> prepare($running_taken) or die("prepare error!\n".$query);
     $statement -> bindParam(":to_date",$row['to_date']);
     $statement -> bindParam(":from_date",$row['from_date']);
     $statement -> bindParam(":module_id",$row['module_id'],PDO::PARAM_INT);
     $statement -> bindParam(":school_id",$row['school_id'],PDO::PARAM_INT);
     try{
       $statement -> execute();
       while($running_row = $statement -> fetch()){
         $running_grades[$running_row['grade']] =$running_row['count'];
       }
       // fetching filled grades
     }
     catch(PDOException $ex){
       echo ($ex->getMessage());
       }
     
     //making grades same for running_grades and grades
     foreach(array_diff(array_keys($running_grades),array_keys($grades)) as $x){
         $grades[$x] = 0;
     }
?>
<script src="../js/jquery.validate.js" type="text/javascript"></script>
<script src="../js/additional-methods.js" type="text/javascript"></script>
<style>
  h3{
    text-align: center;
    padding: 10px
  }
  #details{
    padding:20px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

  }
  li{
    font-weight: 400 !important;
    margin-bottom: 10px;
  }

  h5{
    font-weight: 400;
  }
  .col-md-3,.col-sm-4,.col-6,.col-sm-3{
    margin-bottom: 15px
  }
  #form{
    padding: 10px;

  }
</style>
<div class="container-fluid">
  <h3 class="light">View/Edit Plan</h3>
  <hr style="margin-top:0px; margin-bottom: 20px">
  <div class="row">
    <div class="col-md-4 col-sm-6">
      <div id="details">
        <div class="row justify-content-center">
          <h5 class="details_h6"><?php echo date("d M 'y",strtotime($row['from_date']))." - ".date("d M 'y",strtotime($row['to_date'])); ?></h5>
        </div><hr>
        <div class="row">
          <ul style="list-style-type:none">
            <li>School:  <?php echo " ".$_SESSION['exp_dash_schools'][$row['school_id']]; ?></li>
            <li>Module: <?php echo $_SESSION['module_name'][$row['module_id']]; ?></li>  
            <?php foreach ($grades as $key => $value) { ?>
                <li><?php echo "Grade ".$key.":  "; if(isset($running_grades[$key])){
                  echo $running_grades[$key]."/".$value." sessions";
                }else{
                  echo "0/".$value." sessions";                   
                }?> </li>
            <?php } ?>
          </ul>
          
        </div>
      </div>
    </div>
    <div class="col-md-8 col-sm-6">
      <form id="form" class="row">
        <div class="col-md-3 col-sm-6">
          <h6 style='font-weight:400'>From Date</h6>
          <input value="<?php echo $row['from_date']; ?>" type="date" class="form-control data" name="from_date"/>
        </div>
        <div class="col-md-3 col-sm-6">
          <h6 style='font-weight:400'>To Date</h6>
          <input value="<?php echo $row['to_date']; ?>" type="date" class="form-control data" name="to_date"/>
        </div>
        <div class="col-md-3 col-sm-6">
          <h6 style='font-weight:400'>School</h6>
          <select data-t="integer" class="form-control data" name="school_id">

            <?php
              foreach ($_SESSION['exp_dash_schools'] as $key => $value) {
                ?>
                <option <?php if($key == $row['school_id']) echo "selected"; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php
              }
            ?>
          </select>
        </div>
        <div class="col-md-3 col-sm-6">
          <h6 style='font-weight:400'>Module</h6>
          <select data-t="integer" name="module_id" class="form-control data">
            <?php
              foreach ($all_modules as $key => $value) {
                ?>
                <option <?php if($key == $row['module_id']) echo "selected"; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php
              }
            ?>
          </select>
        </div>
        <div class="col-12">
          <h5 style="background-color:#e0e0e0; font-size:0.8em; text-align:center; padding:10px">Note: Leave grade fields empty if not applicable for the timeline.</h5>
        </div>
        <?php for($i=1;$i<11;$i++){ ?>
        <div class="col-md-3 col-sm-4 col-6">
          <h6 style='font-weight:400'>Grade <?php echo $i; ?></h6>
          <input value="<?php echo $row['grade_'.$i]; ?>" data-t="integer" type="number" class="form-control data data" name="grade_<?php echo $i; ?>"></input>
        </div>
        <?php } ?>
      </form>
      <div class="row justify-content-center">
        <button id="update" class="btn btn-md btn-primary">Update</button>
      </div>
    </div>
  </div>
</div>
<script>
  $("#form").validate({
    rules: {
      from_date: "required",
      to_date: "required"
    }
  })
  $("#update").on("click",function(){
    if($("#form").valid()){
    var fd = new FormData();
    fd.append("table","plans");
    fd.append("action","modify");
    var att = $("#form").find("input.data,select.data");
    var total = 0;
    for(var i=0; i<att.length;i++){
      if($(att[i]).prop('name')!=="" && $(att[i]).val()!= ""){

        if($(att[i]).data('t')=="integer"){
            fd.append("attributes["+$(att[i]).prop('name')+"][value]",$(att[i]).val());
            fd.append("attributes["+$(att[i]).prop('name')+"][type]","integer");
            if($(att[i]).prop('name').startsWith("grade")){
            total+=parseInt($(att[i]).val());

            }

          }else{
            fd.append("attributes["+$(att[i]).prop('name')+"][value]",$(att[i]).val());
            fd.append("attributes["+$(att[i]).prop('name')+"][type]","string");
          }
        //attributes[$(att[i]).prop('name')]=$(att[i]).val();
      }
    }
    fd.append("attributes[total][value]",total);
    fd.append("attributes[total][type]","integer");
    fd.append("where[id][type]","string");
    fd.append("where[id][value]",<?php echo $_GET['plan_id']; ?>);
    $.ajax({
      url:"the_ajax.php",
      processData: false,
      contentType: false,
      data:fd,
      type:'POST',
      success: function(html){
        if(html=="Successful"){
          alert("Update Successful");
          window.open("view.php?plan_id=<?php echo $_GET['plan_id']; ?>","_self");
        }else{
          alert("Some error occured! Please retry..");
          console.log(html);
        }
      }
    });
  } // if form valid
})
</script>

<?php
  require '../footer.php';
?>
