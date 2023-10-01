<?php
  require '../connection.php';
  require '../check_login.php';
  require '../head.php';
  date_default_timezone_set('Asia/Kolkata');
  if(date('D')=="Sun"){
   
    $monday = date("Y-m-d",strtotime("next monday"));
    $saturday = date("Y-m-d",strtotime("next saturday"));
  }else{
  
  $monday = date("Y-m-d",strtotime("monday this week"));
  $saturday = date("Y-m-d",strtotime("saturday this week"));
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

?>
<script src="../js/jquery.validate.js" type="text/javascript"></script>
<script src="../js/additional-methods.js" type="text/javascript"></script>
  <style>
    h5{
      font-weight: 400;
    }
    .col-md-3,.col-sm-4,.col-6,.col-sm-3{
      margin-bottom: 20px
    }
  </style>
  <div style="padding:20px" class="container">
    <form id="form" class="row">
      <div class="col-sm-3">
        <h5>From Date</h5>
        <input value="<?php
        echo $monday;
        ?>" type="date" readonly class="form-control data" name="from_date"/>
      </div>
      <div class="col-sm-3">
        <h5>To Date</h5>
        <input value="<?php
        echo $saturday;
        ?>" type="date" readonly class="form-control data" name="to_date"/>
      </div>
      <div class="col-sm-3">
        <h5>School</h5>
        <select data-t="integer" class="form-control data" name="school_id">

          <?php
            foreach ($_SESSION['exp_dash_schools'] as $key => $value) {
              ?>
              <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
              <?php
            }
          ?>
        </select>
      </div>
      <div class="col-sm-3">
        <h5>Module</h5>
        <select data-t="integer" name="module_id" class="form-control data">
          <?php
            foreach ($all_modules as $key => $value) {
              ?>
              <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
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
        <h5>Grade <?php echo $i; ?></h5>
        <input data-t="integer" type="number" class="form-control data data" name="grade_<?php echo $i; ?>"></input>
      </div>
      <?php } ?>
    </form>

    <div class="row justify-content-center">
      <button id="add" class="btn btn-lg btn-primary">Add Plan</button>
    </div>
</div>
<script>
  $("#form").validate({
    rules: {
      from_date: "required",
      to_date: "required"
    }
  })
  $("#add").on("click",function(){
    if($("#form").valid()){
    var fd = new FormData();
    fd.append("table","plans");
    fd.append("action","add");
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
    $.ajax({
      url:"the_ajax.php",
      processData: false,
      contentType: false,
      data:fd,
      type:'POST',
      success: function(html){
          console.log(html);
        if(html=="Successful"){
          alert("Plan has been added!");
          for(var i=0; i<att.length;i++){
            if($(att[i]).prop('type')=="number")
            $(att[i]).val('');
          }
        }  else if (html=="Newer Exists") {
            alert("A newer plan for the specified school and module already exists!");
          }
        else{
          alert("Some error occured! Please retry..(Console might have more information)");
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
