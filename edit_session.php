<?php
require_once('connection.php');
require_once('check_login.php');
if(!isset($_GET)){
  header("location:your_sessions.php");
}else{
  
  $verify = mysqli_query($con,"SELECT * FROM session_completed where sno=".$_GET['id']);
  $data = mysqli_fetch_assoc($verify);
  if($data['session_user_id']!=$_SESSION['exp_dash_id']){
    header("location:your_sessions.php");
  }
require_once('head.php');
}
?>

<!--Copied from dashboard-->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/rangeslider.js-2.3.0/rangeslider.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/additional-methods.js"></script>
<script type="text/javascript" src="js/extension.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="js/rangeslider.js-2.3.0/rangeslider.css">
<style>
.uploads_list{
  list-style-type: none;

}
.form-control{
  margin-bottom:15px;
}
.form_pad{
  padding: 0px 30px;
}
h5.light{
  margin-bottom:10px
}
.delete_x{
  padding:0px 5px 3px 5px;
  margin-top:2px
}
li{
  margin-bottom: 5px
}
.delete_x:hover{
  color:white !important;
  background-color: red;
  transition: color,background-color 0.3s;
}

@media only screen and (max-width:780px){
  .form_pad{
    padding: 0px 10px;
  }
}
</style>

<?php
// role check and data fetch
if(in_array("1",$_SESSION['permissions'])){
  //session mapping fetch
  	$session_map = "SELECT * from module_sessions";
  	$session_map_res = mysqli_query($con,$session_map) or die(mysqli_error($con));
  	while($session_map_row = mysqli_fetch_assoc($session_map_res)){
    	$session_map_array[$session_map_row['module_id']]= $session_map_row['session_list'];
  	}
  //----------fetching module list for the school------------//
  //programs
  $programs_query = "select project.id,program_id from project where project.id in(".$_SESSION['projects'].")";
  $programs_res = mysqli_query($con,$programs_query) or die($programs_query."<br>".mysqli_error($con));
  $programs = "";

  while($program_row = mysqli_fetch_row($programs_res)){
    $programs.=",".$program_row[1];
    $project_program_map[$program_row[0]] = explode(",",$program_row[1]);
  }

  $programs = trim($programs);
  $programs = trim($programs,",");
  //data from program table
  $program_list_query = "select name,id,module_list from program where id in(".$programs.")";
  if(($program_list_result = mysqli_query($con,$program_list_query))==false){
    echo $program_list_query."<br>".mysqli_error($con);
    exit();
  }else{
    // creating module list
    $program= array();
    while($program_list_row = mysqli_fetch_assoc($program_list_result)){
      
      $program[$program_list_row['id']]['module']= [];
      $program[$program_list_row['id']]['name']= $program_list_row['name'];
    $module_list = explode(",",$program_list_row['module_list']);
    
    foreach ($module_list as $key => $value) {
      //converting hyphen ranges to separate values
      if(strpos($value,'-')!= FALSE){

        $range = explode("-",$value);
        $i = $range[0];
        while($i<=$range[1]){
            array_push($program[$program_list_row['id']]['module'],trim($i));
            $i++;
        }
      }else{
        array_push($program[$program_list_row['id']]['module'],trim($value));
      }
    }
  }
}
//fetching project names

$project_names_query = "SELECT id,name from project";
$project_names_res = mysqli_query($con,$project_names_query) or die($project_names_query."<br>".mysqli_error($con));
while($p_row = mysqli_fetch_assoc($project_names_res)){
  $project_names[$p_row['id']] = $p_row['name'];
}
$proj_list = array_map('trim',explode(",",$_SESSION['projects']));
//print_r($_SESSION['exp_dash_project']);
?>
<script>
  var project_list = <?php echo json_encode($proj_list); ?>;
  var program_list = <?php echo json_encode($program); ?>;
  var module_names = <?php echo json_encode($_SESSION['module_name']); ?>;
  var project_names = <?php echo json_encode($project_names); ?>;
  var school_projects = <?php echo json_encode($_SESSION['exp_dash_project']); ?>;
  var project_program_map = <?php echo json_encode($project_program_map); ?>;
  var session_map_array = <?php echo json_encode($session_map_array); ?>;
</script>
<?php
  }
  ?>
  <form id="form" action="" method="POST" enctype="multipart/form-data">
  <div class="container-fluid" style="background-color:white; padding-bottom:10px;padding-top:30px; margin-bottom:0px;">
    <h3 class="light" align="center" style="margin-top:10px">Modify Session</h3><hr>
      <?php if(in_array("1",$_SESSION['permissions'])){
        ?>
        <div class="row justify-content-center">
          <div class="col-sm-4 top_row">
          <h5 class="light">School Name</h5>
          <select name="school" name="school" id="school_drop" class="form-control">
            <?php
            foreach($_SESSION['exp_dash_schools'] as $id => $name){
              echo "<option value='$id'";
              if($data['school_id']==$id){ echo "selected";}
              echo " >$name</option>";
            }
            ?>
          </select>
        </div>
        <div class="col-sm-4 col-md-3 top_row">
          <!--Select program name and session type-->
          <h5  class="light">Project Name</h5>
          <select name="project" id="project_drop" class="form-control">

          </select>
        </div>
        <div class="col-sm-4 col-md-3 top_row">
          <!--Select program name and session type-->
          <h5 class="light">Program Name</h5>
          <select name="program" id="program_drop" class="form-control">

          </select>
        </div>
      </div>
        <?php
      } ?>
  </div>
</div>
<?php
// school level representative
 if(in_array("1",$_SESSION['permissions'])){
  ?>
  <div class="container-fluid">
    <div class="row justify-content-center">


      <!---->
      <div class="col-sm-3 col-md-2  top_row">
      <h5   class="light">Module Name</h5>
      <select id="module_drop" name="module" class="form-control" required>';

      </select>
      </div>
      <!---->
      <div class="col-sm-3 col-md-2  top_row">
        <h5 class="light">Session Type</h5>
        <select name="session_type" multiple  id="session_category_drop"  class="form-control">
          <?php
          $session_category_query = "SELECT * FROM  session_type";
          $session_category_res = mysqli_query($con,$session_category_query) or die(mysqli_error($con));
          while($sess_row = mysqli_fetch_row($session_category_res)){
          $session_names[$sess_row[0]]=$sess_row[1];
            ?>
            <option value="<?php echo $sess_cat_row['id']; ?>"><?php echo $sess_cat_row['session_type']; ?></option>
            <?php
          }
          ?>
        </select>
      </div>

      <div class="col-sm-3  top_row">
        <h5 class="light">Board</h5>
        <select name="board" class="form-control" id="board" ></select>
      </div>

      <div class="col-sm-3  top_row">
        <h5 class="light">Language</h5>
        <select name="language" class="form-control" id="language" ></select>
      </div>
    </div>
    <div id="content"></div>
  </div><hr>

  <!--from add_session-->
<div class="container-fluid">
<div class="row justify-content-center">
  <div class="col-sm-4 form_pad col-md-3"  >
    <h5 class="light">Date</h5>
    <input name="s_date" value="<?php echo $data['session_date']; ?>" class="form-control" type="date" required></input>
  </div>
    <div class="col-sm-4 form_pad col-md-3">
      <h5 class="light">Start Time</h5>
      <input value="<?php echo $data['from_time']; ?>" name="from_time" class="form-control" type="time" required></input>
    </div>
    <div class="col-sm-4 form_pad col-md-3">
      <h5 class="light">End Time</h5>
      <input value="<?php echo $data['to_time']; ?>" name="to_time" class="form-control" type="time" required></input>
    </div>
</div>
<div class="row justify-content-center">
    <div  class="col-sm-4 form_pad col-md-3">
    <h5  class="light">Grade</h5>
      <select name="grade" class="form-control" required>';
        <?php
        for($i=1;$i<11;$i++){
          ?>
          <option <?php if($data['grade']==$i){echo "selected";} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
          <?php
        }
        ?>
      </select>
    </div>
    <div class="col-sm-4 form_pad col-md-3">
    <h5 class="light">Section</h5>
      <select id='section' name="section" class="form-control" required>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
      </select>
    </div>
    <div class="col-sm-4 form_pad col-md-3">
      <h5  class="light">Topic/Chapter</h5>
      <input type="text" value="<?php echo $data['topic_chapter']; ?>" class="form-control" name="topic" required/>
    </div>
  </div>
  <div class="row justify-content-center">
    <div  class="col-sm-4 form_pad col-md-3">
      <h5  class="light">Batch Size</h5>
      <input type="number" value="<?php echo $data['batch_size']; ?>" min="0" name="batch_size" class="form-control" required>
    </div>
    <div class="col-sm-4 form_pad col-md-3">
      <h5  class="light">Student Count</h5>
      <input type="number" value="<?php echo $data['student_count']; ?>" min="0" name="student_count" class="form-control" required>
    </div>
    <div class="col-sm-4 form_pad col-md-3">
      <h5  class="light">Activity</h5>
      <input type="text" value="<?php echo $data['activity']; ?>" name="activity" class="form-control" required>
    </div>
  </div><hr>
  <div class="row">
      <div class="col-sm-6">
        <h5 class="light">Issues (If any)</h5>
        <textarea name="issues" style="height:150px"  class="form-control"><?php echo $data['issues']; ?></textarea>
      </div>
      <div class="col-sm-6 form_pad">
        <h5 class="light" align="center" style="margin-bottom:70px">Session Rating</h5>
        <input id="ran" value="<?php echo $data['rate']; ?>"  type="range"  min="0" max="10" name="rate"   required>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-6">
      <h5 class="light">Session Summary</h5>
        <textarea style="min-height:150px !important; max-height:100% !important" name="summary" col="10" class="form-control" required><?php echo $data['session_summary']; ?></textarea>
      </div>
      <div class="col-sm-6" style="padding-top:32px" align="center" >
        <div class="form-control" style="min-height:150px">
        <h5 class="light" align="center">(Click Browse to upload image/video from your system)</h5><hr>
        <div class="row justify-content-center">
          <div class="col-sm-4">
            <input onchange="file_list(this)" type="file" id="file-'+counter+'" name="files[]" style="display:none" multiple/>
            <input style="margin-bottom:10px" type="button" class="btn btn-primary btn-lg" value="Browse" onclick="file_click(this)" />
          </div>
        </div><hr>

          <!--New Uploads-->
          <div class="row ">
            <div class="col-sm-4">
              <h5 class="light" align="center">Currently Selected Files</h5>
            </div>
            <div class="col-sm-8">
              <ul id="selected_files" style="padding-left:15px" class="uploads_list">
              </ul>
            </div>
          </div><hr>
          <!--New Uploads-->

          <!--Previous Uploads-->
          <div class="row ">
            <div class="col-sm-4">
              <h5 class="light" align="center">Previous Uploads</h5>
            </div>
            <div class="col-sm-8">
              <ul id="uploads" style="padding-left:15px" class="uploads_list">
                <!--fetching list of uploads-->
                <?php
                foreach(glob("uploads/user_".$_SESSION['exp_dash_id']."/".$_GET['id']."_*") as $name){
                  ?>
                  <li data-d="<?php echo $name; ?>"><?php echo explode("_",basename($name),3)[2]; ?><span class="delete_x" style="color:red; margin-left:5px">x</span></li>
                  <?php
                }
                ?>
              </ul>
            </div>
          </div>
          <!--Previous Uploads-->
        </div>
      </div>
      </div>
    </div>

  <div style="text-align:center; width:100%; margin-bottom:10px"><button id='save' type="submit" class="btn btn-success btn-lg">Save</button>
</div>
  <!--from add_session-->
<?php
}
?>
<script>
  <?php
  if(in_array("1",$_SESSION['permissions'])){ ?>
      var session_names = <?php echo json_encode($session_names); ?>;
      //school drop onchange event
        $('document').ready(function(){
          $("#school_drop").on("change",function(){
            $("#project_drop").html('');
            $.each(school_projects[$("#school_drop").val()],function(key,val){
              if(project_list.indexOf(""+val)>=0){
                $("#project_drop").append($('<option>',{value:val,text:project_names[val]}));
              }
            });
            $("#project_drop").trigger("change");
          });

          // project drop onchange
          $("#project_drop").on("change",function(){
            $("#program_drop").html('');
            $.each(project_program_map[$("#project_drop").val()],function(key,val){
              $("#program_drop").append($('<option>',{value:val,text:program_list[val]['name']}))
            });
            $("#program_drop").trigger("change");
            board_lang_ajax_call();
          });

          $("#program_drop").on("change",function(){
            $("#module_drop").html('');

            for (mod in program_list[$("#program_drop").val()]['module']){
              $("#module_drop").append('<option value="'+program_list[$("#program_drop").val()]['module'][mod]+'">'+module_names[program_list[$("#program_drop").val()]['module'][mod]]+'</option>');
            }
            $("#module_drop").trigger("change");
          });

          $("#module_drop").on("change",function(){
            $("#session_category_drop").html('');
            var sess= session_map_array[$("#module_drop").val()].trim().split(",");
            for(i in sess){
              $("#session_category_drop").append($("<option>",{value:sess[i].trim(),text:session_names[sess[i].trim()]}))
            }
          });

          function board_lang_ajax_call(){
            var x = $("#project_drop").val();
            var y = $("#school_drop").val();
            $.ajax({
              url:"Ajax_pages/fetch_lang_batch.php",
              data: {project:x,school:y},
              cache: false,
              type: 'POST',
              dataType: 'JSON',
              success: function(html){
                $("#board").html(html['board']);
                $("#language").html(html['language']);
              }
            });
          }
          $("#school_drop").trigger("change");

          //applying range slider
          $('input[type="range"]').rangeslider({
            polyfill : false,
            onInit : function() {
              this.output = $( '<div class="range-output" style="text-align:center; margin-top:5px "/>' ).insertAfter( this.$range ).html( this.$element.val() );
            },
            onSlide : function( position, value ) {
              this.output.html( value );
            }
          });

          //initialise with selected value and triggering change events to load drop-downs
          var data = <?php echo json_encode($data); ?>;
          $("#project_drop").val(data['project_id']);
          $("#project_drop").trigger("change");
          board_lang_ajax_call();
          $("#program_drop").val(data['program']);
          $("#program_drop").trigger("change");
          $("#module_drop").val(data['module_id']);
          $("#module_drop").trigger("change");
          $("#board").val(data['board_id']);
          $("#language").val(data['language_id']);
          $("#session_category_drop").val(data['session_type'].split(","));
          $("#session_category_drop").trigger("change");
          $("#section").val(data['section']);

          // assigning function to delete button in uploads list
          $(".delete_x").on("click",delete_call);
           function delete_call(){
            var filename = $(this).closest("li").data('d');
            if(confirm("Are you sure you want to delete this file?\n"+filename)){
              $.ajax({
                url:"Ajax_pages/delete_file.php?name="+filename,
                success:function(html){
                  if(html!="success"){
                    alert("Some Error Occured! Please try again");
                    console.log(html);
                  }else{
                    $.ajax({
                      url:"Ajax_pages/get_upload_list.php?sid="+<?php echo $_GET['id']; ?>,
                      success:function(html){
                        if(html.startsWith("Error")){
                          alert("Error while trying to fetch uploads list... check console for more info");
                          console.log(html);
                        }else{
                          $("#uploads").html(html);
                          // binding the function again
                          $(".delete_x").on("click",delete_call);
                        }
                      }
                    })
                  }
                }
              });
            };
          }

          // form validation
          $('#form').validate({
            ignore: [],
            rules:{
              summary: "required",
              s_date:"required",
              from_time:"required",
              to_time:"required",
              grade:"required",
              section:"required",
              module:"required",
              product:"required",
              activity:"required",
              batch_size:"required",
              student_count:"required",
              session_type:"required",
              rate:"required",
              "files[]  ":{
                extension:"avi|mov|wmv|mp4|webm|flv|png|bmp|gif|tiff|jpeg|jpg"
              }
            },
            messages:{
              "files[]":{
                extension:"Invalid Format! Use one of the following:-<br>avi|mov|wmv|mp4|webm|flv|png|bmp|gif|tiff|jpeg|jpg"
              }
            }
          });

        }); // document ready end
        //list of selected files
        function file_list(inp){
          var list = $("ul#selected_files");
          list.html("");
          var files = inp.files;
          var file;
          for (var i = 0; i < files.length; i++) {
            file = files[i];
            $(list).append("<li>"+file.name+"</li>");
          }
        }
        //files button action
        function file_click(but){
          $(but).parent().find("input[type='file']").trigger("click");
        }
        //form submit action
        $("#form").submit(function(event){
          event.preventDefault();
          if(!($("#form").valid())){
            alert("Invalid entries! Please note that your actions might refresh some of the fields. Make sure all the fields are filled");
            return false;
          }
          var fd = new FormData(this);
          fd.append("update",true);
          fd.append('id',<?php echo $_GET['id']; ?>);
          if( $('#session_category_drop :selected').length > 0){
            var selectednumbers = [];
            $('#session_category_drop :selected').each(function(i, selected) {
            selectednumbers[i] = $(selected).val();
        });
      }
        fd.append("session_type",selectednumbers.join());

          $.ajax({
            url:"Ajax_pages/upload_form.php",
            data: fd,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(html){
              if(html=="success"){
              alert("Changes have been made successfully!");
              window.open("your_sessions.php","_self");
              }else{
              console.log(html);
              alert("Some error occured! Please try again!");
              }
            }
          });
        })

  <?php } ?>
</script>
<!--Copied from dashboard-->
<?php
  require('footer.php');
?>
