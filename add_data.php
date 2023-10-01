<?php
  require_once('connection.php');
  require_once('check_login.php');
  // if(!in_array("14",$_SESSION['permissions'])){
  //   header("location:dashboard.php");
  // }
  require_once('head.php');
  $projects = $_GET['pid'];
         $query = "SELECT * FROM project where id=$projects";
         $result = $con -> query($query);
         $projectdata = $result->fetch_assoc();
//  require_once('card_generator.php');
      //session mapping fetch
        $session_map = "SELECT * from module_sessions";
        $session_map_res = mysqli_query($con,$session_map) or die(mysqli_error($con));
        while($session_map_row = mysqli_fetch_assoc($session_map_res)){
          $session_map_array[$session_map_row['module_id']]= $session_map_row['session_list'];
          //print_r($session_map_row); exit;
        }
      //----------fetching module list for the school------------//
      //programs
      $programs_query = "select project.id,program_id from project where project.id in(".$_GET['pid'].")";
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
    $proj_list = array_map('trim',explode(",",$_GET['pid']));
    //print_r($_SESSION['exp_dash_project']);
    
    if(isset($_GET['cpyid'])){
        $sno = mysqli_real_escape_string($con,$_GET['cpyid']);
        $cpquery = "SELECT * from session_completed where sno={$sno}";
        $cpres = mysqli_query($con,$cpquery) or die("query error: ".mysqli_error($con));
        $cp = mysqli_fetch_assoc($cpres);
        // echo "<pre>".print_r($cp)."</pre>"; 
        ?>
        <script>
            var cp = <?php echo json_encode($cp); ?>;
        </script>
        <?php
        
    }
    

    ?>
    <style type="text/css">
  .tableres{
    width: 97px; 
  }
</style>

    <script type="text/javascript" src="js/rangeslider.js-2.3.0/rangeslider.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js"></script>
    <script type="text/javascript" src="js/additional-methods.js"></script>
    <script type="text/javascript" src="js/extension.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="js/rangeslider.js-2.3.0/rangeslider.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

    <script>
      var project_list = <?php echo json_encode($proj_list); ?>;
      var program_list = <?php echo json_encode($program); ?>;
      var module_names = <?php echo json_encode($_SESSION['module_name']); ?>;
      var project_names = <?php echo json_encode($project_names); ?>;
      var school_projects = <?php echo json_encode($_SESSION['exp_dash_project']); ?>;
      var project_program_map = <?php echo json_encode($project_program_map); ?>;
      var session_map_array = <?php echo json_encode($session_map_array); ?>;
    </script>

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
      @media only screen and (max-width:780px){
        .form_pad{
          padding: 0px 10px;
        }

      }
      </style>
      <div class="p-5 bg-primary text-white text-center" style="background-color: #343a40 !important;">
      <div  class="Container">
        <div class="row">
        <div class="col-md-2" style="display: flex;">
          <?php if(!empty($projectdata['projectlogo'])){ ?>
          <div style="padding-right: 8px;"><img src="uploads/projectLogo/<?php echo $projectdata['projectlogo']; ?>" style="width: 160px;height: 50px;"></div>
          <?php } ?>

          <?php if(!empty($projectdata['projectlogo2'])){ ?>
           <div><img src="uploads/projectLogo2/<?php echo $projectdata['projectlogo2']; ?>" style="width: 160px;height: 50px;"> </div> 
          <?php } ?> </div> <div class="col-md-8"> <h1>Welcome <?php echo $_SESSION['exp_dash_name']; ?></h1></div>  <div class="col-md-2"><img src="https://i.postimg.cc/KcPmbGz7/download.png"> <img src="https://i.postimg.cc/L64FMjGR/print.png" onclick="window.print()"> <img src="https://i.postimg.cc/CKGc1Qf2/share.png"> </div>
      </div>
      </div>  
</div>
 
      <div class="container-fluid" style="background-color:white; padding-bottom:10px;padding-top:30px; margin-bottom:0px;">
          <h2 style="margin-bottom:20px" class="light" align="center" ><h2>
            <div class="row justify-content-center">
              
             <div class="col-sm-4 col-md-3 top_row">
              <!--Select program name and session type-->
              <h5 class="light">Program Name</h5>
              <select id="program_drop" class="form-control">

              </select>
            </div>
            <div class="col-sm-4 col-md-3 top_row">
              <!--Select program name and session type-->
              <h5 class="light">Project Name</h5>
              <select id="project_drop" class="form-control">

              </select>
            </div>

<?php if (in_array("16",$_SESSION['permissions'])) { ?>
        <div class="col-sm-4 top_row">
              <h5 class="light">School Name</h5>
              <select name="school" id="school_drop" class="form-control"> 
                <?php 
                $schoolid=$_GET['schoolid'];
                 $infradata9 = "select * from project_school inner join school on school.id=project_school.school_id where project_school.project_id = '".$_GET['pid']."' and project_school.delete_flag=0 order by school.city";
                 $result9 = $con -> query($infradata9);
                 while($data9=mysqli_fetch_assoc($result9)){
                  $row9[$i]=$data9;
                  $i++;
                }
                 foreach($row9 as $steminfra9){ ?>
                        ?>
                        <option <?php if($schoolid == $steminfra9['school_id']){ echo "selected"; }  ?> value=<?php echo $steminfra9['school_id']; ?>> <?php echo $steminfra9['name']; ?></option>;
                    <?php } ?>
              </select>
            </div>
  <?php }else{ ?>
 <div class="col-sm-4 top_row">
              <h5 class="light">School Name</h5>
              <select name="school" id="school_drop" class="form-control"> 
                <?php 
                $schoolid=$_GET['schoolid'];
                     foreach($_SESSION['exp_dash_schools'] as $id => $name){
                        ?>
                        <option <?php if($schoolid == $id){ echo "selected"; }  ?> value=<?php echo $id; ?>> <?php echo $name; ?></option>;
                    <?php }
               
                ?>
              </select>
            </div>

  <?php } ?>


            
             
           
          </div>
      </div>

      <div class="container-fluid">
        <div class="row justify-content-center">
         <div class="col-sm-4 col-md-4  top_row">
          <h5   class="light">Module Name</h5>
          <select id="module_drop" name="module" class="form-control" required>';
          </select>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-sm-4">
            <button onclick="get_inframodeldata()" style="margin-top:24px;" class="btn form-control btn-lg btn-primary">Add</button>
           
          </div>
        </div>
        <hr>
        <div id="content"></div>
      </div>





<!-- stem Infra End -->
<div class="container">
   <div id="viewdata"></div>
</div>


      <script>


        function get_inframodeldata(){
          var schoolid = $("#school_drop").val();
          var moduleid = $("#module_drop").val();
          var projectid = $("#project_drop").val();
          $.ajax({
           url:"Ajax_pages/fetch_stem_feild_data.php", 
           data: {schoolid:schoolid,moduleid:moduleid,projectid:projectid},
           cache: false,
           type: 'POST',
           success: function(data){
            console.log(data);
            $("#viewdata").html(data);
             // $("#board").html(html['board']);
             // $("#language").html(html['language']);
           }
         });
        }

// $(document).ready(function(){
//     $("#stem_lab_infra_data").click(function(){        
//         $("#add_stem_lab_infra_data").submit(); // Submit the form
//     });

//     $("#STEM_Lab_Models_data").click(function(){    
//         $("#add_STEM_Lab_Models").submit(); // Submit the form
//     });

//     $("#STEM_Lab_Posters_data").click(function(){  
//         $("#add_STEM_Lab_Posters").submit(); // Submit the form
//     });
// });

// $(document).ready(function(){
//     $("#stem_lab_infra_datam").click(function(){        
//         $("#add_stem_lab_infra_datam").submit(); // Submit the form
//     });

//     $("#STEM_Lab_Models_datam").click(function(){     
//         $("#add_STEM_Lab_Modelsm").submit(); // Submit the form
//     });

//     $("#STEM_Lab_Posters_datam").click(function(){        
//         $("#add_STEM_Lab_Postersm").submit(); // Submit the form
//     });
// });
      var session_names = <?php echo json_encode($session_names); ?>;
      //school drop onchange event
           
           <?php if (in_array("16",$_SESSION['permissions'])) { ?>

          $("#school_drop").on("change",function(){
 console.log(school_projects);
 var projectid = <?php echo $_GET['pid']; ?>;
            $("#project_drop").html('');
             $.ajax({
           url:"Ajax_pages/fetch_project_data.php",
           data: {projectid:projectid},
           cache: false,
           type: 'POST',
           success: function(html){
            console.log(html); 
             $("#project_drop").append(html);
             $("#project_drop").trigger("change");
           }
         });
          });
<?php }else{ ?>
$("#school_drop").on("change",function(){

            $("#project_drop").html('');
            $.each(school_projects[$("#school_drop").val()],function(key,val){
              if(project_list.indexOf(""+val)>=0){
              $("#project_drop").append($('<option>',{value:val,text:project_names[val]}));
             }
            });
            $(".schoolid").val($("#school_drop").val());
            $("#project_drop").trigger("change");
          });
<?php } ?>


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

        //initialise program program_drop
        $('document').ready(function(){
          $("#school_drop").trigger("change");
          <?php 
            if(isset($cp)){
                ?>
                $('#project_drop option[value="'+cp['project_id']+'"]').prop("selected", "selected");
                $("#project_drop").trigger("change");
                $('#program_drop option[value="'+cp['program']+'"]').prop("selected", "selected");
                $("#program_drop").trigger("change");
                $('#module_drop option[value="'+cp['module_id']+'"]').prop("selected", "selected");
                $("#module_drop").trigger("change");
                let sessions = cp['session_type'].split(",");
                for (stype of sessions){
                    $('#session_category_drop option[value="'+stype+'"]').prop("selected", "selected");
                }
                $('#board option[value="'+cp['board_id']+'"]').prop("selected", "selected");
                $('#language option[value="'+cp['language_id']+'"]').prop("selected", "selected");
                <?php
            }
          ?>
          });


    //session add button
      $("#add_session").on("click",function(){
      // if($("#session_category_drop :selected").length == 0){
      //   alert("Select atleast one session category!");
      //   return;
      // }   
      
       var conceptName = $('#module_drop').find(":selected").text();

      if(conceptName=="STEM Lab Models"){
       $("#STEM_Lab_Models").show();
       $("#STEM_Lab_Posters").hide();
       $("#STEM_Lab_infra").hide();
      }

      if(conceptName=="STEM Lab Posters"){
       $("#STEM_Lab_Posters").show();
       $("#STEM_Lab_Models").hide();
       $("#STEM_Lab_infra").hide();
      }

      if(conceptName=="STEM Lab Infra"){
      $("#STEM_Lab_infra").show();
       $("#STEM_Lab_Posters").hide();
       $("#STEM_Lab_Models").hide();
      }

      if(conceptName=="Impact Assessment"){
      $("#STEM_Lab_infra").hide();
       $("#STEM_Lab_Posters").hide();
       $("#STEM_Lab_Models").hide();
      }

      if(conceptName=="Teacher Training"){
      $("#STEM_Lab_infra").hide();
       $("#STEM_Lab_Posters").hide();
       $("#STEM_Lab_Models").hide();
      }

      if(conceptName=="Monitoring & Reporting"){
      $("#STEM_Lab_infra").hide();
       $("#STEM_Lab_Posters").hide();
       $("#STEM_Lab_Models").hide();
      }



    //     add_session($("#program_drop").val(),$("#session_category_drop").val(),$("#project_drop").val(),$("#board").val(),$("#language").val(),$("#school_drop").val(),$("#module_drop").val());
    //   $('input[type="range"]').rangeslider({


    // polyfill : false,
    // onInit : function() {
    //     this.output = $( '<div class="range-output" style="text-align:center; margin-top:5px "/>' ).insertAfter( this.$range ).html( this.$element.val() );
    // },
    // onSlide : function( position, value ) {
    //     this.output.html( value );
    //   }
    // });
  });
  </script>
  <script type="text/javascript" src="js/add_data.js"></script>

  <?php require_once('footer.php'); ?>
