<?php
  require_once('connection.php');
  require_once('check_login.php');
  if(!in_array("1",$_SESSION['permissions'])){
    header("location:dashboard.php");
  }
  require_once('head.php');
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
    <script type="text/javascript" src="js/rangeslider.js-2.3.0/rangeslider.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js"></script>
    <script type="text/javascript" src="js/additional-methods.js"></script>
    <script type="text/javascript" src="js/extension.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="js/rangeslider.js-2.3.0/rangeslider.css">

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
      <div class="container-fluid" style="background-color:white; padding-bottom:10px;padding-top:30px; margin-bottom:0px;">
          <h2 style="margin-bottom:20px" class="light" align="center" >Welcome <?php echo $_SESSION['exp_dash_name']; ?><h2>
            <div class="row justify-content-center">
              <div class="col-sm-4 top_row">
              <h5 class="light">School Name</h5>
              <select name="school" id="school_drop" class="form-control">
                <?php if(!isset($cp)){
                    foreach($_SESSION['exp_dash_schools'] as $id => $name){
                        echo "<option value='$id'>$name</option>";
                    }
                }else{
                     foreach($_SESSION['exp_dash_schools'] as $id => $name){
                        ?>
                        <option <?php if($cp['school_id'] == $id){ echo "selected"; }  ?> value=<?php echo $id; ?>> <?php echo $name; ?></option>;
                    <?php }
                }
                ?>
              </select>
            </div>
            <div class="col-sm-4 col-md-3 top_row">
              <!--Select program name and session type-->
              <h5 class="light">Project Name</h5>
              <select id="project_drop" class="form-control">

              </select>
            </div>
            <div class="col-sm-4 col-md-3 top_row">
              <!--Select program name and session type-->
              <h5 class="light">Program Name</h5>
              <select id="program_drop" class="form-control">

              </select>
            </div>
          </div>
      </div>

      <div class="container-fluid">
        <div class="row justify-content-center">


<!--<?php print_r($_SESSION); ?>-->
          <div class="col-sm-3 col-md-2  top_row">
          <h5   class="light">Module Name</h5>
          <select id="module_drop" name="module" class="form-control" required>';

          </select>
          </div>

         
         
          <div class="col-sm-3 col-md-2  top_row">
            <h5 class="light">Session Type</h5>
            <select multiple  id="session_category_drop" name="session" class="form-control">
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
            <select class="form-control" id="board" ></select>
          </div>

          <div class="col-sm-3  top_row">
            <h5 class="light">Language</h5>
            <select class="form-control" id="language" ></select>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-sm-4">
            <button id="add_session" style="margin-top:24px;" class="btn form-control btn-lg btn-primary">Add Session</button>
          </div>
        </div>
        <hr>
        <div id="content"></div>
      </div>

      <script>
      var session_names = <?php echo json_encode($session_names); ?>;
      //school drop onchange event

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
               console.log(html);
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

         <?php   if (in_array("1",$_SESSION['permissions'])) {  ?>
          //session add button
      $("#add_session").on("click",function(){
      if($("#session_category_drop :selected").length == 0){
        alert("Select atleast one session category!");
        return;
      }     
      add_session($("#program_drop").val(),$("#session_category_drop").val(),$("#project_drop").val(),$("#board").val(),$("#language").val(),$("#school_drop").val(),$("#module_drop").val());
      $('input[type="range"]').rangeslider({
    polyfill : false,
    onInit : function() {
        this.output = $( '<div class="range-output" style="text-align:center; margin-top:5px "/>' ).insertAfter( this.$range ).html( this.$element.val() );
    },
    onSlide : function( position, value ) {
        this.output.html( value );
      }
    });
  });
          
  <?php }else{ ?>

    //session add button
      $("#add_session").on("click",function(){
      if($("#session_category_drop :selected").length == 0){
        alert("Select atleast one session category!");
        return;
      }     

      add_session($("#program_drop").val(),$("#session_category_drop").val(),$("#project_drop").val(),$("#board").val(),$("#language").val(),$("#school_drop").val(),$("#module_drop").val());
      $('input[type="range"]').rangeslider({
    polyfill : false,
    onInit : function() {
        this.output = $( '<div class="range-output" style="text-align:center; margin-top:5px "/>' ).insertAfter( this.$range ).html( this.$element.val() );
    },
    onSlide : function( position, value ) {
        this.output.html( value );
      }
    });
  });
     
  <?php } ?>


    
  </script>
  <script type="text/javascript" src="js/add_session.js"></script>

  <?php require_once('footer.php'); ?>
