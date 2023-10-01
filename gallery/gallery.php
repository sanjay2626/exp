<?php include("../connection.php");
  ob_start();
  if(!empty($_GET['serial'])){
   
    $check_user_query = "SELECT * from session_completed where sno=".$_GET['serial'];
    $res_check = mysqli_query($con,$check_user_query);
    $row = mysqli_fetch_assoc($res_check);  
    
if($row['session_user_id']!= $_SESSION['exp_dash_id'] and !in_array("6",$_SESSION['permissions']) and !(in_array("5",$_SESSION['permissions']) and (in_array($row['project_id'],explode(",",$_SESSION['projects'])))) and !(in_array("4",$_SESSION['permissions']) and (in_array($row['school_id'],explode(",",$_SESSION['school_id'])))) and !(in_array("3",$_SESSION['permissions']) and (in_array($row['project_id'],explode(",",$_SESSION['projects']))) and (in_array($row['school_id'],explode(",",$_SESSION['school_id']))) )  ){
      header("location:../dashboard.php");
      }
  include("../head.php");
  ?>
        <style>
          .padded{
            padding:20px;
          }
          .modal.show .modal-lg{
            max-width:900px;
            margin: 1.75rem auto;
          }
          .modal.show{
            padding-right:0px !important;
          }
          @media only screen and (max-width: 576px){
            .modal.show .modal-lg{
              max-width:100vw;
              height: auto;
            }

          }
          #video_viewer video{
            max-height: 400px
          }
        </style>
         <div style="padding-top:20px" class="container-fluid">
           <h2 class="light" align="center">Your Uploads for the Session</h2><hr>
           <ul class="nav nav-tabs">
             <li class="nav-item">
               <a class="nav-link active" data-toggle="tab" href="#images">Images</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" data-toggle="tab" href="#videos">Videos</a>
             </li>
           </ul>
            <div id="images" class="tab-pane fade active show">
              <!--div for showing images-->
              <div class="row justify-content-center" style="padding-top: 20px; text-align: center;display:none;  border-bottom:1px solid rgba(0,0,0,.1); " id="image_viewer">
                <div class="col-sm-9" style='margin-bottom:10px;'>
                  <img style="margin: 0 auto; max-height:350px; width:auto" src="" id="currently_viewing">
                </div>
              </div>
              <!--div for showing images-->
              <div  class="row justify-content-center">
                <?php
                  $dir = "../uploads/user_".$_GET['session_user_id']."/".$_GET['serial']."_";
                foreach (glob($dir."{*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) {
                  ?>
                    <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php
                }
                ?>

              </div>
            </div>
            <div id="videos" class=" tab-pane fade ">

              <!--div for playing video-->
              <div class="row justify-content-center" style="padding-top: 20px; text-align: center;display:none" id="video_viewer">
                <div class="col-sm-9">
                  <video style="margin: 0 auto" src=""  controls>
                  </video><hr>
                </div>
              </div>
              <!--div for playing video-->

              <div  class="row  justify-content-center">
                <?php
                  $dir = "../uploads/user_".$_GET['session_user_id']."/".$_GET['serial']."_";
                foreach (glob($dir."{*.avi,*.mov,*.wmv,*.mp4,*.webm,*.flv,*.AVI,*.MOV,*.WMV,*.MP4,*.WEBM,*.FLV}",GLOB_BRACE) as $file) {
                  ?>
                    <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div id="<?php echo $file; ?>" onclick="watch_video(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img  style="height:100px; width:100%; border-radius:10px 10px 0px 0px" src="video_play.png">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                 <?php } ?>

              </div>
            </div>
          </div>

        <script>
        function light_box_images(e){
          var image = $(e).find("img");
          $("#currently_viewing").prop("src",$(image).prop("src"));
          if($("#image_viewer").css("display")=="none"){
          $("#image_viewer").hide().fadeIn(700);
          }
        }

        function watch_video(e){

          var source  = e.id;
          var ext = source.split(".");
          extension = ext[ext.length-1];
          $("#video_viewer").find("video").prop("src",source);

          if($("#video_viewer").css("display")=="none"){
          $("#video_viewer").hide().fadeIn(700);
          }

        }

        </script>
      <?php
    }
  
  include("../footer.php");
?>
