<?php include("../connection.php");
  ob_start();

  ?>
  <html>
  <head>
  <title>Experifun Dashboard</title>
  <link rel="icon" href="http://dashboard.experifun.com/favicon.png" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
  <style>
    nav{
      box-shadow: 0 1px 2px 1px rgba(0, 0, 0, 0.5);
      min-height:80px;
    }
    .navbar-brand{
      margin-left:20px;
    }

    .nav-item{
      margin-right:10px;
      font-size: 1.1em;
      
    }
    .light{
      font-weight: lighter !important;
    }
    .shadow{
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    .card-row{
      margin-bottom:30px;

    }
    .padded{
      padding:0px 5px 0px 5px;
      cursor:pointer;
    }
    .blue{
      color:#0074D9 !important; 
    }
    @media only screen and (max-width: 575px){
    .nav-item{
     margin-left:20px;
     }
    }
  </style>
  </head>
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
           <h2 class="light" align="center">Your Uploads</h2><hr>
           <ul class="nav nav-tabs">
             <li class="nav-item">
               <a class="nav-link active" data-toggle="tab" id="InfraBefore2" href="#InfraBefore">Infra Before</a>
             </li>

             <li class="nav-item">
               <a class="nav-link" data-toggle="tab" id="InfraWIP2" href="#InfraWIP">Infra WIP</a>
             </li>

             <li class="nav-item">
               <a class="nav-link" data-toggle="tab" id="InfraAfter2" href="#InfraAfter">Infra After</a>
             </li>


            <!--   <li class="nav-item">
               <a class="nav-link" data-toggle="tab" id="ModelsBefore2" href="#ModelsBefore">Models Before</a>
             </li> -->

             <li class="nav-item">
               <a class="nav-link" data-toggle="tab" id="ModelsWIP2" href="#ModelsWIP">Models WIP</a>
             </li>

             <li class="nav-item">
               <a class="nav-link" data-toggle="tab" id="ModelsAfter2" href="#ModelsAfter">Models After</a>
             </li>

             <!--  <li class="nav-item">
               <a class="nav-link" data-toggle="tab" id="PostersBefore2" href="#PostersBefore">Posters Before</a>
             </li> -->

             <li class="nav-item">
               <a class="nav-link" data-toggle="tab" id="PostersWIP2" href="#PostersWIP">Posters WIP</a>
             </li>

             <li class="nav-item">
               <a class="nav-link" data-toggle="tab" id="PostersAfter2" href="#PostersAfter">Posters After</a>
             </li>

             <li class="nav-item">
               <a class="nav-link" data-toggle="tab" id="Innaugration2" href="#Innaugration">Innaugration</a>
             </li>

             <li class="nav-item">
               <a class="nav-link" data-toggle="tab" id="TeacherTraining2" href="#TeacherTraining">Teacher Training</a>
             </li>

             <li class="nav-item">
               <a class="nav-link" data-toggle="tab" id="StemImpact2" href="#StemImpact">Stem Impact</a>
             </li>
             
           </ul>


             <div id="InfraBefore" class="tab-pane fade active show">
              <!--div for showing images-->
              <div class="row justify-content-center" style="padding-top: 20px; text-align: center;display:none" id="InfraBefore_view">
                 
                <div class="col-sm-9" style='margin-bottom:10px;'>
                  <img style="margin: 0 auto; max-height:350px; width:auto" src="" id="currently_viewing1">
                </div>
              </div>

               <!--div for playing video-->
               <div><h3>School Photos</h3></div>
              <div  class="row justify-content">
                
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
          $dir = "uploads/school_photos_".$_GET['sno']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images1(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>
              

               <!--div for playing video-->
                <div><h3>Room Photos</h3></div>
             <div  class="row justify-content">
            
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/school_room_photos_".$_GET['sno']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images1(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>



            </div>

            <div id="InfraWIP" class="tab-pane fade ">
              <!--div for playing video-->
              <div class="row justify-content-center" style="padding-top: 20px; text-align: center;display:none" id="InfraWIP_view">
                <div class="col-sm-9" style='margin-bottom:10px;'>
                  <img style="margin: 0 auto; max-height:350px; width:auto" src="" id="currently_viewing2">
                </div>
              </div>

              <!--div for playing video-->
              <div><h3>STEM Infra Electric Work</h3></div>
              <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_infra_EWork_wip_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images2(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>
             

              <!--div for playing video-->
              <div><h3>STEM Infra Painting</h3></div>
             <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_infra_painting_wip_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images2(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>

               <!--div for playing video-->
               <div><h3>STEM Infra ModelDesks</h3></div>
              <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_infra_modelDesks_wip_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images2(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>

              

              <!--div for playing video-->
              <div><h3>STEM Infra Cupboard wip</h3></div>
              <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_infra_cupboard_wip_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images2(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>

               <!--div for playing video-->
              <div><h3>STEM Infra Flooring</h3></div>
            <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_infra_flooring_wip_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images2(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>




            </div>

            <div id="InfraAfter" class="tab-pane fade ">
              <!--div for playing video-->
              <div class="row justify-content-center" style="padding-top: 20px; text-align: center;display:none" id="InfraAfter_view">
                <div class="col-sm-9" style='margin-bottom:10px;'>
                  <img style="margin: 0 auto; max-height:350px; width:auto" src="" id="currently_viewing3">
                </div>
              </div>

               <!--div for playing video-->
               <div><h3>STEM Infra Electric Work</h3></div>
              <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_infra_EWork_after_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images3(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>
              

              <!--div for playing video-->
              <div><h3>STEM Infra painting</h3></div>
             <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_infra_painting_after_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images3(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>

              <!--div for playing video-->
              <div><h3>STEM Infra ModelDesks</h3></div>
              <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_infra_modelDesks_after_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images3(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>

              

              <!--div for playing video-->
              <div><h3>STEM Infra Cupboard</h3></div>
              <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_infra_cupboard_after_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images3(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>

              <!--div for showing images-->
              <div><h3>STEM Infra flooring</h3></div>
               <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_infra_flooring_after_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images3(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>

            </div>

            <div id="ModelsBefore" class="tab-pane fade ">
              <!--div for playing video-->
              <div class="row justify-content-center" style="padding-top: 20px; text-align: center;display:none" id="ModelsBefore_view">
                <div class="col-sm-9" style='margin-bottom:10px;'>
                  <img style="margin: 0 auto; max-height:350px; width:auto" src="" id="currently_viewing4">
                </div>
              </div>
              <!--div for showing images-->
               <div><h3>STEM Models science</h3></div>  
               <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_models_science_brefore_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images4(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>
             
              <!--div for playing video-->
              <div><h3>STEM Models math</h3></div>
             <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_models_math_brefore_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images4(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>

              <!--div for playing video-->
              <div><h3>STEM Models robotics</h3></div>
              <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_models_robotics_brefore_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images4(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>

               <!--div for playing video-->
               <div><h3>STEM Models computer</h3></div>
              <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_models_computer_brefore_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images4(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>

            </div>

            <div id="ModelsWIP" class="tab-pane fade ">
              <!--div for playing video-->
              <div class="row justify-content-center" style="padding-top: 20px; text-align: center;display:none" id="ModelsWIP_view">
                <div class="col-sm-9" style='margin-bottom:10px;'>
                  <img style="margin: 0 auto; max-height:350px; width:auto" src="" id="currently_viewing5">
                </div>
              </div>
              <!--div for showing images-->
               <div><h3>STEM Models science</h3></div>  
               <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_models_science_wip_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images5(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>

               <!--div for playing video-->
               <div><h3>STEM Models math</h3></div>
             <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_models_math_wip_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images5(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>

              <!--div for playing video-->
              <div><h3>STEM Models robotics</h3></div>
              <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_models_robotics_wip_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images5(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>

              <!--div for playing video-->
              <div><h3>STEM Models computer</h3></div>
              <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_models_computer_wip_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images5(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>
            </div>

            <div id="ModelsAfter" class="tab-pane fade ">
              <!--div for playing video-->
              <div class="row justify-content-center" style="padding-top: 20px; text-align: center;display:none" id="ModelsAfter_view">
                <div class="col-sm-9" style='margin-bottom:10px;'>
                  <img style="margin: 0 auto; max-height:350px; width:auto" src="" id="currently_viewing6">
                </div>
              </div>
               <!--div for showing images-->
                <div><h3>STEM Models science</h3></div>  
               <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_models_science_after_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images6(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>

               <!--div for playing video-->
               <div><h3>STEM Models math</h3></div>
             <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_models_math_after_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images6(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>

               <!--div for playing video-->
               <div><h3>STEM Models robotics</h3></div>
              <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_models_robotics_after_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images6(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>

              <!--div for playing video-->
              <div><h3>STEM Models computer</h3></div>
              <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_models_computer_after_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images6(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>



            </div>

            <div id="PostersBefore" class="tab-pane fade ">
              <!--div for playing video-->
              <div class="row justify-content-center" style="padding-top: 20px; text-align: center;display:none" id="PostersBefore_view">
                <div class="col-sm-9" style='margin-bottom:10px;'>
                  <img style="margin: 0 auto; max-height:350px; width:auto" src="" id="currently_viewing7">
                </div>
              </div>
               <!--div for showing images-->
                <div><h3>STEM Posters Branding Wall</h3></div>  
               <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_Posters_bWall_brefore_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images7(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>

           <!--div for playing video-->
           <div><h3>STEM Posters Concepts</h3></div>
             <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_Posters_concepts_brefore_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images7(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>

              <!--div for playing video-->
              <div><h3>STEM Posters Solar System</h3></div>
              <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_Posters_sSystem_brefore_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images7(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>

              <!--div for playing video-->
              <div><h3>STEM Posters Innovation Corner</h3></div>
              <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_Posters_inCorner_brefore_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images7(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>

              <!--div for playing video-->
              <div><h3>STEM Posters Cutouts</h3></div>
              <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_Posters_cutouts_brefore_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images7(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>
            </div>

            <div id="PostersWIP" class="tab-pane fade ">
              <!--div for playing video-->
               <div class="row justify-content-center" style="padding-top: 20px; text-align: center;display:none" id="PostersWIP_view">
                <div class="col-sm-9" style='margin-bottom:10px;'>
                  <img style="margin: 0 auto; max-height:350px; width:auto" src="" id="currently_viewing8">
                </div>
              </div>
             <!--div for showing images-->
              <div><h3>STEM Posters Branding Wall</h3></div>  
               <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_Posters_bWall_wip_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images8(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>
            
            <!--div for playing video-->
            <div><h3>STEM Posters Concepts</h3></div>
             <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_Posters_concepts_wip_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images8(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>

              <!--div for playing video-->
              <div><h3>STEM Posters Solar System</h3></div>
              <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_Posters_sSystem_wip_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images8(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>

               <!--div for playing video-->
               <div><h3>STEM Posters Innovation Corner</h3></div>
              <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_Posters_inCorner_wip_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images8(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>

              <!--div for playing video-->
              <div><h3>STEM Posters Cutouts</h3></div>
              <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_Posters_cutouts_wip_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images8(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>

            </div>

            <div id="PostersAfter" class="tab-pane fade ">
              <!--div for playing video-->
              <div class="row justify-content-center" style="padding-top: 20px; text-align: center;display:none" id="PostersAfter_view">
                <div class="col-sm-9" style='margin-bottom:10px;'>
                  <img style="margin: 0 auto; max-height:350px; width:auto" src="" id="currently_viewing9">
                </div>
              </div> 

              <!--div for playing video-->
               <div><h3>STEM Posters Branding Wall</h3></div>  
             <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_Posters_bWall_after_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images9(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>

              
              <!--div for playing video-->
               <div><h3>STEM Posters Concepts</h3></div>  
             <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_Posters_concepts_after_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images9(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>

              <!--div for playing video-->
              <div><h3>STEM Posters Solar System</h3></div>
              <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_Posters_sSystem_after_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images9(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>

              <!--div for playing video-->
              <div><h3>STEM Posters Innovation Corner</h3></div>
              <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_Posters_inCorner_after_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images9(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>

              <!--div for playing video-->
              <div><h3>STEM Posters cutouts</h3></div>  
              <div  class="row justify-content">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_Posters_cutouts_after_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images9(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>


            </div>



<!-- inarguation -->

<div id="Innaugration" class="tab-pane fade ">
              <!--div for playing video-->
              <div class="row justify-content-center" style="padding-top: 20px; text-align: center;display:none" id="Innaugration_view">
                <div class="col-sm-9" style='margin-bottom:10px;'>
                  <img style="margin: 0 auto; max-height:350px; width:auto" src="" id="currently_viewing10">
                </div>
              </div> 
              <!--div for playing video-->
               <div><h3>Innaugration Photos</h3></div>  
             <div  class="row justify-content-center">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/Innaugration".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images10(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>
            </div>
           
<!-- teacher Training -->
            
            <div id="TeacherTraining" class="tab-pane fade ">
              <!--div for playing video-->
              <div class="row justify-content-center" style="padding-top: 20px; text-align: center;display:none" id="TeacherTraining_view">
                <div class="col-sm-9" style='margin-bottom:10px;'>
                  <img style="margin: 0 auto; max-height:350px; width:auto" src="" id="currently_viewing11">
                </div>
              </div> 
              <!--div for playing video-->
               <div><h3>Teacher Training Photos</h3></div>  
             <div  class="row justify-content-center">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/teacherTraining".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images11(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>
            </div>


            <!-- stem Impact -->
            
            <div id="StemImpact" class="tab-pane fade ">
              <!--div for playing video-->
              <div class="row justify-content-center" style="padding-top: 20px; text-align: center;display:none" id="StemImpact_view">
                <div class="col-sm-9" style='margin-bottom:10px;'>
                  <img style="margin: 0 auto; max-height:350px; width:auto" src="" id="currently_viewing12">
                </div>
              </div> 
              <!--div for playing video-->
               <div><h3>STEM Impact Assessment Photos</h3></div>  
             <div  class="row justify-content-center">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/StemImpact".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images12(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>
            </div>


          </div>
        <script>
$('#InfraBefore2').click(function(){
   $("#InfraBefore").show();
   $("#InfraWIP").hide();
   $("#InfraAfter").hide();
   $("#ModelsBefore").hide();
   $("#ModelsWIP").hide();
   $("#ModelsAfter").hide();
   $("#PostersBefore").hide();
   $("#PostersWIP").hide();
   $("#PostersAfter").hide();
   $("#Innaugration").hide();
   $("#TeacherTraining").hide();
   $("#StemImpact").hide();
});

$('#InfraWIP2').click(function(){
   $("#InfraBefore").hide();
   $("#InfraWIP").show();
   $("#InfraAfter").hide();
   $("#ModelsBefore").hide();
   $("#ModelsWIP").hide();
   $("#ModelsAfter").hide();
   $("#PostersBefore").hide();
   $("#PostersWIP").hide();
   $("#PostersAfter").hide();
   $("#Innaugration").hide();
   $("#TeacherTraining").hide();
   $("#StemImpact").hide();
});

$('#InfraAfter2').click(function(){
   $("#InfraBefore").hide();
   $("#InfraWIP").hide();
   $("#InfraAfter").show();
   $("#ModelsBefore").hide();
   $("#ModelsWIP").hide();
   $("#ModelsAfter").hide();
   $("#PostersBefore").hide();
   $("#PostersWIP").hide();
   $("#PostersAfter").hide();
   $("#Innaugration").hide();
   $("#TeacherTraining").hide();
   $("#StemImpact").hide();
});

$('#ModelsBefore2').click(function(){
   $("#InfraBefore").hide();
   $("#InfraWIP").hide();
   $("#InfraAfter").hide();
   $("#ModelsBefore").show();
   $("#ModelsWIP").hide();
   $("#ModelsAfter").hide();
   $("#PostersBefore").hide();
   $("#PostersWIP").hide();
   $("#PostersAfter").hide();
   $("#Innaugration").hide();
   $("#TeacherTraining").hide();
   $("#StemImpact").hide();
});

$('#ModelsWIP2').click(function(){
   $("#InfraBefore").hide();
   $("#InfraWIP").hide();
   $("#InfraAfter").hide();
   $("#ModelsBefore").hide();
   $("#ModelsWIP").show();
   $("#ModelsAfter").hide();
   $("#PostersBefore").hide();
   $("#PostersWIP").hide();
   $("#PostersAfter").hide();
   $("#Innaugration").hide();
   $("#TeacherTraining").hide();
   $("#StemImpact").hide();
});

$('#ModelsAfter2').click(function(){
   $("#InfraBefore").hide();
   $("#InfraWIP").hide();
   $("#InfraAfter").hide();
   $("#ModelsBefore").hide();
   $("#ModelsWIP").hide();
   $("#ModelsAfter").show();
   $("#PostersBefore").hide();
   $("#PostersWIP").hide();
   $("#PostersAfter").hide();
   $("#Innaugration").hide();
   $("#TeacherTraining").hide();
   $("#StemImpact").hide();
});

$('#PostersBefore2').click(function(){
   $("#InfraBefore").hide();
   $("#InfraWIP").hide();
   $("#InfraAfter").hide();
   $("#ModelsBefore").hide();
   $("#ModelsWIP").hide();
   $("#ModelsAfter").hide();
   $("#PostersBefore").show();
   $("#PostersWIP").hide();
   $("#PostersAfter").hide();
   $("#Innaugration").hide();
   $("#TeacherTraining").hide();
   $("#StemImpact").hide();
});

$('#PostersWIP2').click(function(){
   $("#InfraBefore").hide();
   $("#InfraWIP").hide();
   $("#InfraAfter").hide();
   $("#ModelsBefore").hide();
   $("#ModelsWIP").hide();
   $("#ModelsAfter").hide();
   $("#PostersBefore").hide();
   $("#PostersWIP").show();
   $("#PostersAfter").hide();
   $("#Innaugration").hide();
   $("#TeacherTraining").hide();
   $("#StemImpact").hide();
});

$('#PostersAfter2').click(function(){
   $("#InfraBefore").hide();
   $("#InfraWIP").hide();
   $("#InfraAfter").hide();
   $("#ModelsBefore").hide();
   $("#ModelsWIP").hide();
   $("#ModelsAfter").hide();
   $("#PostersBefore").hide();
   $("#PostersWIP").hide();
   $("#PostersAfter").show();
   $("#Innaugration").hide();
   $("#TeacherTraining").hide();
   $("#StemImpact").hide();
});

$('#Innaugration2').click(function(){
   $("#InfraBefore").hide();
   $("#InfraWIP").hide();
   $("#InfraAfter").hide();
   $("#ModelsBefore").hide();
   $("#ModelsWIP").hide();
   $("#ModelsAfter").hide();
   $("#PostersBefore").hide();
   $("#PostersWIP").hide();
   $("#PostersAfter").hide();
   $("#Innaugration").show();
   $("#TeacherTraining").hide();
   $("#StemImpact").hide();
});

$('#TeacherTraining2').click(function(){
   $("#InfraBefore").hide();
   $("#InfraWIP").hide();
   $("#InfraAfter").hide();
   $("#ModelsBefore").hide();
   $("#ModelsWIP").hide();
   $("#ModelsAfter").hide();
   $("#PostersBefore").hide();
   $("#PostersWIP").hide();
   $("#PostersAfter").hide();
   $("#Innaugration").hide();
   $("#TeacherTraining").show();
   $("#StemImpact").hide();
});

$('#StemImpact2').click(function(){
   $("#InfraBefore").hide();
   $("#InfraWIP").hide();
   $("#InfraAfter").hide();
   $("#ModelsBefore").hide();
   $("#ModelsWIP").hide();
   $("#ModelsAfter").hide();
   $("#PostersBefore").hide();
   $("#PostersWIP").hide();
   $("#PostersAfter").hide();
   $("#Innaugration").hide();
   $("#TeacherTraining").hide();
   $("#StemImpact").show();
});



        function light_box_images1(e){
          var image = $(e).find("img");
          $("#currently_viewing1").prop("src",$(image).prop("src"));
          if($("#InfraBefore_view").css("display")=="none"){
          $("#InfraBefore_view").hide().fadeIn(700);
          }
        }

         function light_box_images2(e){
          var image = $(e).find("img");
          $("#currently_viewing2").prop("src",$(image).prop("src"));
          if($("#InfraWIP_view").css("display")=="none"){
          $("#InfraWIP_view").hide().fadeIn(700);
          }
        }

         function light_box_images3(e){
          var image = $(e).find("img");
          $("#currently_viewing3").prop("src",$(image).prop("src"));
          if($("#InfraAfter_view").css("display")=="none"){
          $("#InfraAfter_view").hide().fadeIn(700);
          }
        }

         function light_box_images4(e){
          var image = $(e).find("img");
          $("#currently_viewing4").prop("src",$(image).prop("src"));
          if($("#ModelsBefore_view").css("display")=="none"){
          $("#ModelsBefore_view").hide().fadeIn(700);
          }
        }

         function light_box_images5(e){
          var image = $(e).find("img");
          $("#currently_viewing5").prop("src",$(image).prop("src"));
          if($("#ModelsWIP_view").css("display")=="none"){
          $("#ModelsWIP_view").hide().fadeIn(700);
          }
        }

         function light_box_images6(e){
          var image = $(e).find("img");
          $("#currently_viewing6").prop("src",$(image).prop("src"));
          if($("#ModelsAfter_view").css("display")=="none"){
          $("#ModelsAfter_view").hide().fadeIn(700);
          }
        }

         function light_box_images7(e){
          var image = $(e).find("img");
          $("#currently_viewing7").prop("src",$(image).prop("src"));
          if($("#PostersBefore_view").css("display")=="none"){
          $("#PostersBefore_view").hide().fadeIn(700);
          }
        }

         function light_box_images8(e){
          var image = $(e).find("img");
          $("#currently_viewing8").prop("src",$(image).prop("src"));
          if($("#PostersWIP_view").css("display")=="none"){
          $("#PostersWIP_view").hide().fadeIn(700);
          }
        }

         function light_box_images9(e){
          var image = $(e).find("img");
          $("#currently_viewing9").prop("src",$(image).prop("src"));
          if($("#PostersAfter_view").css("display")=="none"){
          $("#PostersAfter_view").hide().fadeIn(700);
          }
        }

        function light_box_images10(e){
          var image = $(e).find("img");
          $("#currently_viewing10").prop("src",$(image).prop("src"));
          if($("#Innaugration_view").css("display")=="none"){
          $("#Innaugration_view").hide().fadeIn(700);
          }
        }

        function light_box_images11(e){
          var image = $(e).find("img");
          $("#currently_viewing11").prop("src",$(image).prop("src"));
          if($("#TeacherTraining_view").css("display")=="none"){
          $("#TeacherTraining_view").hide().fadeIn(700);
          }
        }

        function light_box_images12(e){
          var image = $(e).find("img");
          $("#currently_viewing12").prop("src",$(image).prop("src"));
          if($("#StemImpact_view").css("display")=="none"){
          $("#StemImpact_view").hide().fadeIn(700);
          }
        }

        </script>
      <?php
    
  
  include("../footer.php");
?>
