<?php
require_once('connection.php');
require_once('check_login.php');
require_once('head.php');
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

 //module session mappings
 $all_modules_string = join(",",array_keys($all_modules));
 $module_session_list_query = "SELECT * FROM module_sessions where module_id in({$all_modules_string})";
 $res = mysqli_query($con,$module_session_list_query) or die(mysqli_error($con));
 while($row = mysqli_fetch_assoc($res)){
   $module_session[$row['module_id']] = $row['session_list'];
 }
 $all_sessions = [];
 foreach ($module_session as $key => $value) {
     foreach (explode(",",$value) as $session) {
       if(!in_array($session,array_keys($all_sessions))){
         array_push($all_sessions,$session);
       }
     }
 }
 $all_sessions_string = join(",",$all_sessions);
 //fetching session names
 $session_names_query = "SELECT * from session_type where id in({$all_sessions_string})";
 $res = mysqli_query($con,$session_names_query) or die(mysqli_error($con));
 while($row = mysqli_fetch_assoc($res)){
   $session_names[$row['id']] = $row['session_type'];
 }
foreach ($_SESSION['exp_dash_project'] as $key => $value) {
  foreach ($value as $k => $v) {
    array_push($project[$v]['school'],$key);
  }
}
?>
<style>
  h6.label{
    font-weight: 350;
  }
  .col-md-3{
    margin-bottom:15px
  }
  input,select{
    padding:5px !important;
    border-radius: 0px !important;
    max-width:200px
  }
  canvas.full{
    padding:20px;
    box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2)
  }
</style>
<h2 style="background-color:#311b92;padding:10px;color:white;text-align:center" class="light">Custom Report</h2>
<!-- <?php echo "<pre>"; print_r($module_session); echo "</pre>"; ?> -->
<div id="form" class="container-fluid" style="padding:20px">
  <div class="row">
    <div class="col-md-3 col-sm-4 col-6">
      <h6 class="label">From (M-D-Y)</h6>
      <input id="from_date" value='2018-08-01' type="date" class="form-control data" name="from_date"/>
    </div>
    <div class="col-md-3 col-sm-4 col-6">
      <h6 class="label">To (M-D-Y)</h6>
      <input id="to_date" value="<?php $date = date("Y-m-d"); echo $date; ?>" type="date" class="form-control data" name="to_date"/>
    </div>
    <div class="col-md-3 col-sm-4 col-6">
      <h6 class="label">Project</h6>
      <select id='project'  class="form-control data" name="project_id">
        <option value="*">--Select--</option>
        <?php foreach ($project as $key => $value) { ?>
          <option value='<?php echo $key; ?>'><?php echo $value['name']; ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="col-md-3 col-sm-4 col-6">
      <h6 class="label">School</h6>
      <select id="school"  class="form-control data" name="school_id">

      </select>
    </div>
    <div class="col-md-3 col-sm-4 col-6">
      <h6 class="label">Program</h6>
      <select id="program"  class="form-control data" name="program">

      </select>
    </div>
    <div class="col-md-3 col-sm-4 col-6">
      <h6 class="label">Module</h6>
      <select id="module"  class="form-control data" name="module_id">

      </select>
    </div>
    <div class="col-md-3 col-sm-4 col-6">
      <h6 class="label">Session Type</h6>
      <select id="session"  class="form-control data" name="session_type">
      </select>
    </div>
    <div class="col-md-3 col-sm-4 col-6">
      <h6 class="label">Compare Among</h6>
      <select id="x_axis" class="form-control data" name="x_axis">
        <option value="project_id">Projects</option>
        <option value="program">Program</option>
        <option value="school_id">School</option>
        <option value="module_id">Module</option>
        <option value="session_type">Session Type</option>
      </select>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class=" col-sm-4 col-6">
      <button style="width:100%" class="btn btn-primary" id="generate">Generate</button>
    </div>
  </div>
  <hr>

    <div class="container">
      <div id="graph-container" class="row justify-content-center">
          <canvas  style=" background:white" id="custom_chart" >

          </canvas>
      </div>
    </div>

</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.5.0"></script>
<script>
Chart.helpers.merge(Chart.defaults.global.plugins.datalabels, {
    align: "top",
    anchor: "end"
});
</script>
<script>
  var project = <?php echo json_encode($project); ?>;
  var school_names = <?php echo json_encode($_SESSION['exp_dash_schools']); ?>;
  var program_names = <?php echo json_encode($program_names); ?>;
  var program_modules = <?php echo json_encode($program_modules); ?>;
  var all_modules = <?php echo json_encode($all_modules); ?>;
  var module_session = <?php echo json_encode($module_session); ?>;
  var session_names = <?php echo json_encode($session_names); ?>;
  $(document).ready(function(){
    var project_select = $("#project");
    var school_drop = $("#school");
    var program_drop = $("#program");
    var module_drop = $("#module");
    var session_drop = $("#session");
      //module on change
      module_drop.on("change",function(){
        session_drop.html("<option value='*' >--Select--</option>");
        var module_val = module_drop.val();
        if(module_val=="*"){
          var session_content = [];
          $('#module > option').each(function() {
            if($(this).val()!="*" && module_session[$(this).val()] !== undefined){
              $.each(module_session[$(this).val()].split(","),function(key,value){
                if(session_content.indexOf(value)==-1){
                  session_content.push(value);
                  session_drop.append("<option value='"+value+"'>"+session_names[value]+"</option>");
                }
              });
            }
          });
          // $.each(session_names,function(key,value){
          //   session_drop.append("<option value='"+key+"'>"+value+"</option>");
          // });
        }else{
          $.each(module_session[module_val].split(","),function(key,value){
            session_drop.append("<option value='"+value+"'>"+session_names[value]+"</option>");
          });
        }
      })

      //program on change
      program_drop.on("change",function(){
        module_drop.html("<option value='*' >--Select--</option>");
        var prog_val = program_drop.val();
        if(prog_val=="*"){
          var module_content = [];
          $('#program > option').each(function() {
            if($(this).val()!="*"){
              $.each(program_modules[$(this).val()].split(","),function(key,value){
                if(module_content.indexOf(value)==-1){
                  module_content.push(value);
                  module_drop.append("<option value='"+value+"'>"+all_modules[value]+"</option>");
                }
              });
            }
          });
          // $.each(all_modules,function(key,value){
          //   module_drop.append("<option value='"+key+"'>"+value+"</option>");
          // });
        }else{
          $.each(program_modules[prog_val].split(","),function(key,value){
            module_drop.append("<option value='"+value+"'>"+all_modules[value]+"</option>");
          });
        }
        module_drop.trigger('change');
      })
      // project on change event
      $("#project").on('change',function(){
        // populating program and school dropdown
        school_drop.html("<option value='*' >--Select--</option>");
        program_drop.html("<option value='*' >--Select--</option>");
          if(project_select.val()!="*"){
            var val = project_select.val();
            //schools according to project
            $.each(project[val]['school'],function(key,value){
              school_drop.append("<option value='"+value+"'>"+school_names[value]+"</option>");
            });
            //programs according to project
            var selected_project_programs = project[val]['program'].split(",");
            $.each(selected_project_programs,function(key,value){
              program_drop.append("<option value='"+value+"'>"+program_names[value]+"</option>");
            })
        }else{
          $.each(school_names,function(key,value){
            school_drop.append("<option value='"+key+"'>"+value+"</option>");
          })
          //all programs since project is set to --Select--
          $.each(program_names,function(key,value){
            program_drop.append("<option value='"+key+"'>"+value+"</option>");
          })
        }
        //Triggering program change as well
        program_drop.trigger("change");
      })


      //initial triggers
      $("#project").trigger("change");

      //generate button on click function
      $("#generate").on("click",function(){

        var elems = $("#form").find(".data");
        var i = 0;
        var id = "";
        var fd = new FormData();
        for(i;i<elems.length;i++){
          if($(elems[i]).val()!="*"){
            fd.append("where["+$(elems[i]).prop("name")+"]",$(elems[i]).val());
            id = $(elems[i]).prop('id')
            fd.append("title["+$(elems[i]).prev('h6').text()+"]",$("#"+id+" option:selected").html());
          }
        }
        switch ($("#x_axis").val()) {
          case "project_id":
                $.each(project,function(key,value){
                  fd.append("name_array["+key+"]",value['name']);
                })
            break;
          case "program":
                $.each(program_names,function(key,value){
                  fd.append("name_array["+key+"]",value);
                })

            break;
          case "session_type":
          $('#session > option').each(function() {
            if($(this).val()!="*"){
                fd.append("name_array["+$(this).val()+"]",$(this).text());
            }
          });

            break;
          case "school_id":
          $.each(school_names,function(key,value){
            fd.append("name_array["+key+"]",value);
          })
            break;
          case "module_id":
          $.each(all_modules,function(key,value){
            fd.append("name_array["+key+"]",value);
          })
            break;
          default:

        }
        $.ajax({
          url:"Ajax_pages/custom_report.php",
          processData: false,
          contentType: false,
          type: 'POST',
          data: fd,
          success: function(html){
            $("#fetched_script").html(html);
          }
        })
      })
  });// document ready
</script>
<div id="fetched_script">
<div>
<?php
require 'footer.php';
?>
