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
               <a class="nav-link active" data-toggle="tab" id="flooring2" href="#flooring">Science Documents</a>
             </li>
              <li class="nav-item">
               <a class="nav-link" data-toggle="tab" id="Painting2" href="#Painting">Math Documents</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" data-toggle="tab" id="Modeldesks2" href="#Modeldesks">Robotics Documents</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" data-toggle="tab" id="Electrical2" href="#Electrical">Computer Documents</a>
             </li>
            
           </ul>


             <div id="flooring" class="tab-pane fade active show">
              <!--div for showing images-->
              <div class="row justify-content-center" style="padding-top: 20px; text-align: center;display:none" id="flooring_view">
                <div class="col-sm-9" style='margin-bottom:10px;'>
                  <img style="margin: 0 auto; max-height:350px; width:auto" src="" id="currently_viewing">
                </div>
              </div>
              <!--div for showing images-->
               <div  class="row justify-content-center">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_models_science_after_".$_GET['schoolid']."/";
                foreach (glob($dir."{*.pdf,*.docx,*.jpg,*.JPG,*.png,*.PNG,*.bmp,*.BMP,*.gif,*.GIF,*.tiff,*.TIFF,*.jpeg,*.JPEG}",GLOB_BRACE) as $file) { ?>


                   <div  class="col-md-2 col-sm-6  padded" style="text-align:center">
                      <div onclick="light_box_images(this)"  class="shadow" style="cursor:pointer; border-radius:10px;">
                        <img style="height:150px; width:100%; border-radius:10px 10px 0px 0px" src="<?php echo $file; ?>">
                        <h6 style="padding-top:5px; padding-bottom:5px" class="light" align="center"><?php echo explode("_",pathinfo($file,PATHINFO_FILENAME),3)[2]; ?> </h6>
                      </div>
                    </div>
                  <?php }  ?>
              </div>
            </div>

            <div id="Painting" class="tab-pane fade ">
              <!--div for playing video-->
              <div class="row justify-content-center" style="padding-top: 20px; text-align: center;display:none" id="Painting_view">
                <div class="col-sm-9" style='margin-bottom:10px;'>
                  <img style="margin: 0 auto; max-height:350px; width:auto" src="" id="currently_viewing2">
                </div>
              </div>
              <!--div for playing video-->
             <div  class="row justify-content-center">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_models_math_after_".$_GET['schoolid']."/";
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

            <div id="Modeldesks" class="tab-pane fade ">
              <!--div for playing video-->
             <div class="row justify-content-center" style="padding-top: 20px; text-align: center;display:none" id="Modeldesks_view">
                <div class="col-sm-9" style='margin-bottom:10px;'>
                  <img style="margin: 0 auto; max-height:350px; width:auto" src="" id="currently_viewing3">
                </div>
              </div>
              <!--div for playing video-->
              <div  class="row justify-content-center">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_models_robotics_after_".$_GET['schoolid']."/";
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

            <div id="Electrical" class="tab-pane fade ">
              <!--div for playing video-->
              <div class="row justify-content-center" style="padding-top: 20px; text-align: center;display:none" id="Electrical_view">
                <div class="col-sm-9" style='margin-bottom:10px;'>
                  <img style="margin: 0 auto; max-height:350px; width:auto" src="" id="currently_viewing4">
                </div>
              </div>
              <!--div for playing video-->
              <div  class="row justify-content-center">
                <?php
                  // $dir = "/uploads/contract_doc_".$_GET['id'];
            $dir = "uploads/".$_GET['user']."/stem_models_computer_after_".$_GET['schoolid']."/";
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
          </div>
        <script>
$('#flooring2').click(function(){
   $("#flooring").show();
   $("#Painting").hide();
   $("#Modeldesks").hide();
   $("#Electrical").hide();
   $("#Cupboards").hide();
});

$('#Painting2').click(function(){
  $("#flooring").hide();
   $("#Painting").show();
   $("#Modeldesks").hide();
   $("#Electrical").hide();
   $("#Cupboards").hide();
});

$('#Modeldesks2').click(function(){
  $("#flooring").hide();
   $("#Painting").hide();
   $("#Modeldesks").show();
   $("#Electrical").hide();
   $("#Cupboards").hide();
});

$('#Electrical2').click(function(){
  $("#flooring").hide();
   $("#Painting").hide();
   $("#Modeldesks").hide();
   $("#Electrical").show();
   $("#Cupboards").hide();
});

$('#Cupboards2').click(function(){
  $("#flooring").hide();
   $("#Painting").hide();
   $("#Modeldesks").hide();
   $("#Electrical").hide();
   $("#Cupboards").show();
});

        function light_box_images(e){
          var image = $(e).find("img");
          $("#currently_viewing").prop("src",$(image).prop("src"));
          if($("#flooring_view").css("display")=="none"){
          $("#flooring_view").hide().fadeIn(700);
          }
        }


        function light_box_images2(e){
          var image2 = $(e).find("img");
          $("#currently_viewing2").prop("src",$(image2).prop("src"));
          if($("#Painting_view").css("display")=="none"){
          $("#Painting_view").hide().fadeIn(700);
          }
        }

        

        function light_box_images3(e){
          var image2 = $(e).find("img");
          $("#currently_viewing3").prop("src",$(image2).prop("src"));
          if($("#Modeldesks_view").css("display")=="none"){
          $("#Modeldesks_view").hide().fadeIn(700);
          }
        }

        function light_box_images4(e){
          var image2 = $(e).find("img");
          $("#currently_viewing4").prop("src",$(image2).prop("src"));
          if($("#Electrical_view").css("display")=="none"){
          $("#Electrical_view").hide().fadeIn(700);
          }
        }

        function light_box_images5(e){
          var image2 = $(e).find("img");
          $("#currently_viewing5").prop("src",$(image2).prop("src"));
          if($("#Cupboards_view").css("display")=="none"){
          $("#Cupboards_view").hide().fadeIn(700);
          }
        }

        

        </script>
      <?php
    
  
  include("../footer.php");
?>
