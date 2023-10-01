<?php
  require("connection.php"); //the connection
  require('check_login.php');

  if(!empty($_POST || $_FILES)){
$user_id = $_SESSION['exp_dash_id'];
$date_es = str_replace('/', '-', $_POST['EWork_sdate']);
$EWork_sdate = date('Y-m-d', strtotime($date_es));
$date_es2 = str_replace('/', '-', $_POST['EWork_edate']);
$EWork_edate = date('Y-m-d', strtotime($date_es2));

$EWork_progress = $_POST['EWork_progress'];
$EWork_units = $_POST['EWork_units'];
$schoolid = $_POST['schoolid'];
$projectid = $_POST['projectid'];
$EWork_brefore1 = $_FILES['EWork_brefore']['name'];
$EWork_wip1 = $_FILES['EWork_wip']['name'];
$EWork_after1 = $_FILES['EWork_after']['name'];
 if(!empty($EWork_brefore1)){ $EWork_brefore = $_FILES['EWork_brefore']['name']; }else{ $EWork_brefore = $_POST['EWork_brefore'];}
if(!empty($EWork_wip1)){ $EWork_wip = $_FILES['EWork_wip']['name']; }else{$EWork_wip = $_POST['EWork_wip'];}
if(!empty($EWork_after1)){$EWork_after = $_FILES['EWork_after']['name']; }else{$EWork_after = $_POST['EWork_after'];}
$EWork_issues = $_POST['EWork_issues'];
$EWork_remarks = $_POST['EWork_remarks'];
$date_es3 = str_replace('/', '-', $_POST['painting_sdate']);
$painting_sdate = date('Y-m-d', strtotime($date_es3));
$date_es4 = str_replace('/', '-', $_POST['painting_edate']);
$painting_edate = date('Y-m-d', strtotime($date_es4));
$painting_progress = $_POST['painting_progress'];
$painting_units = $_POST['painting_units'];
$painting_brefore1 = $_FILES['painting_brefore']['name'];
$painting_wip1 = $_FILES['painting_wip']['name'];
$painting_after1 = $_FILES['painting_after']['name'];
if(!empty($painting_brefore1)){ $painting_brefore = $_FILES['painting_brefore']['name']; }else{ $painting_brefore = $_POST['painting_brefore'];}
if(!empty($painting_wip1)){ $painting_wip = $_FILES['painting_wip']['name']; }else{$painting_wip = $_POST['painting_wip'];}
if(!empty($painting_after1)){$painting_after = $_FILES['painting_after']['name']; }else{$painting_after = $_POST['painting_after'];}
$painting_issues = $_POST['painting_issues'];
$painting_remarks = $_POST['painting_remarks'];
$date_es5 = str_replace('/', '-', $_POST['modelDesks_sdate']);
$modelDesks_sdate = date('Y-m-d', strtotime($date_es5));
$date_es6 = str_replace('/', '-', $_POST['modelDesks_edate']);
$modelDesks_edate = date('Y-m-d', strtotime($date_es6));
$modelDesks_progress = $_POST['modelDesks_progress'];
$modelDesks_units = $_POST['modelDesks_units'];
$modelDesks_brefore1 = $_FILES['modelDesks_brefore']['name'];
$modelDesks_wip1 = $_FILES['modelDesks_wip']['name'];
$modelDesks_after1 =$_FILES['modelDesks_after']['name'];
if(!empty($modelDesks_brefore1)){ $modelDesks_brefore = $_FILES['modelDesks_brefore']['name']; }else{ $modelDesks_brefore = $_POST['modelDesks_brefore'];}
if(!empty($modelDesks_wip1)){ $modelDesks_wip = $_FILES['modelDesks_wip']['name']; }else{$modelDesks_wip = $_POST['modelDesks_wip'];}
if(!empty($modelDesks_after1)){$modelDesks_after = $_FILES['modelDesks_after']['name']; }else{$modelDesks_after = $_POST['modelDesks_after'];}
$modelDesks_issues = $_POST['modelDesks_issues'];
$modelDesks_remarks = $_POST['modelDesks_remarks'];

$date_es7 = str_replace('/', '-', $_POST['cupboard_sdate']);
$cupboard_sdate = date('Y-m-d', strtotime($date_es7));
$date_es8 = str_replace('/', '-', $_POST['cupboard_sdate']);
$cupboard_edate = date('Y-m-d',strtotime($date_es8));
$cupboard_progress = $_POST['cupboard_progress'];
$cupboard_units = $_POST['cupboard_units'];
$cupboard_brefore1 = $_FILES['cupboard_brefore']['name'];
$cupboard_wip1 = $_FILES['cupboard_wip']['name'];
$cupboard_after1 = $_FILES['cupboard_after']['name'];
if(!empty($cupboard_brefore1)){ $cupboard_brefore = $_FILES['cupboard_brefore']['name']; }else{ $cupboard_brefore = $_POST['cupboard_brefore'];}
if(!empty($cupboard_wip1)){ $cupboard_wip = $_FILES['cupboard_wip']['name']; }else{$cupboard_wip = $_POST['cupboard_wip'];}
if(!empty($cupboard_after1)){$cupboard_after = $_FILES['cupboard_after']['name']; }else{$cupboard_after = $_POST['cupboard_after'];}
$cupboard_issues = $_POST['cupboard_issues'];
$cupboard_remarks = $_POST['cupboard_remarks'];
$date_es9 = str_replace('/', '-', $_POST['flooring_sdate']);
$flooring_sdate = date('Y-m-d',strtotime($date_es9));
$date_es10 = str_replace('/', '-', $_POST['flooring_edate']);
$flooring_edate = date('Y-m-d',strtotime($date_es10));
$flooring_progress = $_POST['flooring_progress'];
$flooring_units = $_POST['flooring_units'];
$flooring_brefore1 = $_FILES['flooring_brefore']['name'];
$flooring_wip1 = $_FILES['flooring_wip']['name'];
$flooring_after1 = $_FILES['flooring_after']['name'];
if(!empty($flooring_brefore1)){ $flooring_brefore = $_FILES['flooring_brefore']['name']; }else{ $flooring_brefore = $_POST['flooring_brefore'];}
if(!empty($flooring_wip1)){ $flooring_wip = $_FILES['flooring_wip']['name']; }else{$flooring_wip = $_POST['flooring_wip'];}
if(!empty($flooring_after1)){$flooring_after = $_FILES['flooring_after']['name']; }else{
  $flooring_after = $_POST['flooring_after'];}
  $flooring_issues = $_POST['flooring_issues'];
  $flooring_remarks = $_POST['flooring_remarks'];


   if(!empty($_FILES['EWork_brefore']['name'][0])){
   $file_count = count($_FILES['EWork_brefore']['name']);
   if($file_count>0){
     if(!file_exists('uploads/'.$user_id)){
       mkdir('uploads/'.$user_id, 0777, true);
     }
     if(!file_exists('uploads/'.$user_id.'/stem_infra_EWork_brefore_'.$schoolid)){
       mkdir('uploads/'.$user_id.'/stem_infra_EWork_brefore_'.$schoolid, 0777, true);
     }
     $target_dir = 'uploads/'.$user_id.'/stem_infra_EWork_brefore_'.$schoolid."/";

// print_r($target_dir); exit;
     for ($i = 0; $i < $file_count; $i++)
     {
       $target_file = $target_dir."_".$i."_".basename($_FILES["EWork_brefore"]["name"][$i]);
       $file_tmp_name    = $_FILES['EWork_brefore']['tmp_name'][$i];
       $file_name      = $_FILES['EWork_brefore']['name'][$i];
       $file_size      = $_FILES['EWork_brefore']['size'][$i];
       $file_type      = $_FILES['EWork_brefore']['type'][$i];
       $file_error     = $_FILES['EWork_brefore']['error'][$i];
       $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
       $allowed_extension = array('png','gif','jpeg','jpg', 'jfif');
       if($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mov" && $imageFileType != "3gp" && $imageFileType != "mpeg" && $imageFileType != "doc" && $imageFileType != "pdf" && $imageFileType != "docx")
           {
               if(!in_array(strtolower($imageFileType),$allowed_extension)){
         $output = "file extension error";
         die($output);
       }
       else{
         include_once("Ajax_pages/compressor.php");
         $target = $file_tmp_name;
         $resized_file = $target_file;
         $wmax = 1024;
         $hmax = 768;
         compressor($target, $resized_file, $wmax, $hmax, $imageFileType);
       }
           } else {
           move_uploaded_file($_FILES["files"]["tmp_name"][$i],$target_file);

           }
     }
     }
   }
  
 if(!empty($_FILES['EWork_wip']['name'][0])){
  $file_count = count($_FILES['EWork_wip']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stem_infra_EWork_wip_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stem_infra_EWork_wip_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stem_infra_EWork_wip_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["EWork_wip"]["name"][$i]);
      $file_tmp_name    = $_FILES['EWork_wip']['tmp_name'][$i];
      $file_name      = $_FILES['EWork_wip']['name'][$i];
      $file_size      = $_FILES['EWork_wip']['size'][$i];
      $file_type      = $_FILES['EWork_wip']['type'][$i];
      $file_error     = $_FILES['EWork_wip']['error'][$i];
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      $allowed_extension = array('png','gif','jpeg','jpg', 'jfif');
      if($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mov" && $imageFileType != "3gp" && $imageFileType != "mpeg" && $imageFileType != "doc" && $imageFileType != "pdf" && $imageFileType != "docx")
          {
              if(!in_array(strtolower($imageFileType),$allowed_extension)){
        $output = "file extension error";
        die($output);
      }
      else{
        include_once("Ajax_pages/compressor.php");
        $target = $file_tmp_name;
        $resized_file = $target_file;
        $wmax = 1024;
        $hmax = 768;
        compressor($target, $resized_file, $wmax, $hmax, $imageFileType);
      }
          } else {
          move_uploaded_file($_FILES["files"]["tmp_name"][$i],$target_file);

          }
    }
    }
  }

 if(!empty($_FILES['EWork_after']['name'][0])){
  $file_count = count($_FILES['EWork_after']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stem_infra_EWork_after_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stem_infra_EWork_after_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stem_infra_EWork_after_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["EWork_after"]["name"][$i]);
      $file_tmp_name    = $_FILES['EWork_after']['tmp_name'][$i];
      $file_name      = $_FILES['EWork_after']['name'][$i];
      $file_size      = $_FILES['EWork_after']['size'][$i];
      $file_type      = $_FILES['EWork_after']['type'][$i];
      $file_error     = $_FILES['EWork_after']['error'][$i];
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      $allowed_extension = array('png','gif','jpeg','jpg', 'jfif');
      if($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mov" && $imageFileType != "3gp" && $imageFileType != "mpeg" && $imageFileType != "doc" && $imageFileType != "pdf" && $imageFileType != "docx")
          {
              if(!in_array(strtolower($imageFileType),$allowed_extension)){
        $output = "file extension error";
        die($output);
      }
      else{
        include_once("Ajax_pages/compressor.php");
        $target = $file_tmp_name;
        $resized_file = $target_file;
        $wmax = 1024;
        $hmax = 768;
        compressor($target, $resized_file, $wmax, $hmax, $imageFileType);
      }
          } else {
          move_uploaded_file($_FILES["files"]["tmp_name"][$i],$target_file);

          }
    }
    }
  }

   if(!empty($_FILES['painting_brefore']['name'][0])){
   $file_count = count($_FILES['painting_brefore']['name']);
   if($file_count>0){
     if(!file_exists('uploads/'.$user_id)){
       mkdir('uploads/'.$user_id, 0777, true);
     }
     if(!file_exists('uploads/'.$user_id.'/stem_infra_painting_brefore_'.$schoolid)){
       mkdir('uploads/'.$user_id.'/stem_infra_painting_brefore_'.$schoolid, 0777, true);
     }
     $target_dir = 'uploads/'.$user_id.'/stem_infra_painting_brefore_'.$schoolid."/";


     for ($i = 0; $i < $file_count; $i++)
     {
       $target_file = $target_dir."_".$i."_".basename($_FILES["painting_brefore"]["name"][$i]);
       $file_tmp_name    = $_FILES['painting_brefore']['tmp_name'][$i];
       $file_name      = $_FILES['painting_brefore']['name'][$i];
       $file_size      = $_FILES['painting_brefore']['size'][$i];
       $file_type      = $_FILES['painting_brefore']['type'][$i];
       $file_error     = $_FILES['painting_brefore']['error'][$i];
       $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
       $allowed_extension = array('png','gif','jpeg','jpg', 'jfif');
       if($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mov" && $imageFileType != "3gp" && $imageFileType != "mpeg" && $imageFileType != "doc" && $imageFileType != "pdf" && $imageFileType != "docx")
           {
               if(!in_array(strtolower($imageFileType),$allowed_extension)){
         $output = "file extension error";
         die($output);
       }
       else{
         include_once("Ajax_pages/compressor.php");
         $target = $file_tmp_name;
         $resized_file = $target_file;
         $wmax = 1024;
         $hmax = 768;
         compressor($target, $resized_file, $wmax, $hmax, $imageFileType);
       }
           } else {
           move_uploaded_file($_FILES["files"]["tmp_name"][$i],$target_file);

           }
     }
     }
   }

  if(!empty($_FILES['painting_wip']['name'][0])){
  $file_count = count($_FILES['painting_wip']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stem_infra_painting_wip_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stem_infra_painting_wip_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stem_infra_painting_wip_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["painting_wip"]["name"][$i]);
      $file_tmp_name    = $_FILES['painting_wip']['tmp_name'][$i];
      $file_name      = $_FILES['painting_wip']['name'][$i];
      $file_size      = $_FILES['painting_wip']['size'][$i];
      $file_type      = $_FILES['painting_wip']['type'][$i];
      $file_error     = $_FILES['painting_wip']['error'][$i];
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      $allowed_extension = array('png','gif','jpeg','jpg', 'jfif');
      if($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mov" && $imageFileType != "3gp" && $imageFileType != "mpeg" && $imageFileType != "doc" && $imageFileType != "pdf" && $imageFileType != "docx")
          {
              if(!in_array(strtolower($imageFileType),$allowed_extension)){
        $output = "file extension error";
        die($output);
      }
      else{
        include_once("Ajax_pages/compressor.php");
        $target = $file_tmp_name;
        $resized_file = $target_file;
        $wmax = 1024;
        $hmax = 768;
        compressor($target, $resized_file, $wmax, $hmax, $imageFileType);
      }
          } else {
          move_uploaded_file($_FILES["files"]["tmp_name"][$i],$target_file);

          }
    }
    }
  }

  if(!empty($_FILES['painting_after']['name'][0])){
  $file_count = count($_FILES['painting_after']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stem_infra_painting_after_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stem_infra_painting_after_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stem_infra_painting_after_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["painting_after"]["name"][$i]);
      $file_tmp_name    = $_FILES['painting_after']['tmp_name'][$i];
      $file_name      = $_FILES['painting_after']['name'][$i];
      $file_size      = $_FILES['painting_after']['size'][$i];
      $file_type      = $_FILES['painting_after']['type'][$i];
      $file_error     = $_FILES['painting_after']['error'][$i];
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      $allowed_extension = array('png','gif','jpeg','jpg', 'jfif');
      if($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mov" && $imageFileType != "3gp" && $imageFileType != "mpeg" && $imageFileType != "doc" && $imageFileType != "pdf" && $imageFileType != "docx")
          {
              if(!in_array(strtolower($imageFileType),$allowed_extension)){
        $output = "file extension error";
        die($output);
      }
      else{
        include_once("Ajax_pages/compressor.php");
        $target = $file_tmp_name;
        $resized_file = $target_file;
        $wmax = 1024;
        $hmax = 768;
        compressor($target, $resized_file, $wmax, $hmax, $imageFileType);
      }
          } else {
          move_uploaded_file($_FILES["files"]["tmp_name"][$i],$target_file);

          }
    }
    }
  }

   if(!empty($_FILES['modelDesks_brefore']['name'][0])){
   $file_count = count($_FILES['modelDesks_brefore']['name']);
   if($file_count>0){
     if(!file_exists('uploads/'.$user_id)){
       mkdir('uploads/'.$user_id, 0777, true);
     }
     if(!file_exists('uploads/'.$user_id.'/stem_infra_modelDesks_brefore_'.$schoolid)){
       mkdir('uploads/'.$user_id.'/stem_infra_modelDesks_brefore_'.$schoolid, 0777, true);
     }
     $target_dir = 'uploads/'.$user_id.'/stem_infra_modelDesks_brefore_'.$schoolid."/";


     for ($i = 0; $i < $file_count; $i++)
     {
       $target_file = $target_dir."_".$i."_".basename($_FILES["modelDesks_brefore"]["name"][$i]);
       $file_tmp_name    = $_FILES['modelDesks_brefore']['tmp_name'][$i];
       $file_name      = $_FILES['modelDesks_brefore']['name'][$i];
       $file_size      = $_FILES['modelDesks_brefore']['size'][$i];
       $file_type      = $_FILES['modelDesks_brefore']['type'][$i];
       $file_error     = $_FILES['modelDesks_brefore']['error'][$i];
       $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
       $allowed_extension = array('png','gif','jpeg','jpg', 'jfif');
       if($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mov" && $imageFileType != "3gp" && $imageFileType != "mpeg" && $imageFileType != "doc" && $imageFileType != "pdf" && $imageFileType != "docx")
           {
               if(!in_array(strtolower($imageFileType),$allowed_extension)){
         $output = "file extension error";
         die($output);
       }
       else{
         include_once("Ajax_pages/compressor.php");
         $target = $file_tmp_name;
         $resized_file = $target_file;
         $wmax = 1024;
         $hmax = 768;
         compressor($target, $resized_file, $wmax, $hmax, $imageFileType);
       }
           } else {
           move_uploaded_file($_FILES["files"]["tmp_name"][$i],$target_file);

           }
     }
     }
   }

  if(!empty($_FILES['modelDesks_wip']['name'][0])){
  $file_count = count($_FILES['modelDesks_wip']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stem_infra_modelDesks_wip_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stem_infra_modelDesks_wip_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stem_infra_modelDesks_wip_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["modelDesks_wip"]["name"][$i]);
      $file_tmp_name    = $_FILES['modelDesks_wip']['tmp_name'][$i];
      $file_name      = $_FILES['modelDesks_wip']['name'][$i];
      $file_size      = $_FILES['modelDesks_wip']['size'][$i];
      $file_type      = $_FILES['modelDesks_wip']['type'][$i];
      $file_error     = $_FILES['modelDesks_wip']['error'][$i];
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      $allowed_extension = array('png','gif','jpeg','jpg', 'jfif');
      if($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mov" && $imageFileType != "3gp" && $imageFileType != "mpeg" && $imageFileType != "doc" && $imageFileType != "pdf" && $imageFileType != "docx")
          {
              if(!in_array(strtolower($imageFileType),$allowed_extension)){
        $output = "file extension error";
        die($output);
      }
      else{
        include_once("Ajax_pages/compressor.php");
        $target = $file_tmp_name;
        $resized_file = $target_file;
        $wmax = 1024;
        $hmax = 768;
        compressor($target, $resized_file, $wmax, $hmax, $imageFileType);
      }
          } else {
          move_uploaded_file($_FILES["files"]["tmp_name"][$i],$target_file);

          }
    }
    }
  }

  if(!empty($_FILES['modelDesks_after']['name'][0])){
  $file_count = count($_FILES['modelDesks_after']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stem_infra_modelDesks_after_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stem_infra_modelDesks_after_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stem_infra_modelDesks_after_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["modelDesks_after"]["name"][$i]);
      $file_tmp_name    = $_FILES['modelDesks_after']['tmp_name'][$i];
      $file_name      = $_FILES['modelDesks_after']['name'][$i];
      $file_size      = $_FILES['modelDesks_after']['size'][$i];
      $file_type      = $_FILES['modelDesks_after']['type'][$i];
      $file_error     = $_FILES['modelDesks_after']['error'][$i];
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      $allowed_extension = array('png','gif','jpeg','jpg', 'jfif');
      if($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mov" && $imageFileType != "3gp" && $imageFileType != "mpeg" && $imageFileType != "doc" && $imageFileType != "pdf" && $imageFileType != "docx")
          {
              if(!in_array(strtolower($imageFileType),$allowed_extension)){
        $output = "file extension error";
        die($output);
      }
      else{
        include_once("Ajax_pages/compressor.php");
        $target = $file_tmp_name;
        $resized_file = $target_file;
        $wmax = 1024;
        $hmax = 768;
        compressor($target, $resized_file, $wmax, $hmax, $imageFileType);
      }
          } else {
          move_uploaded_file($_FILES["files"]["tmp_name"][$i],$target_file);

          }
    }
    }
  }

   if(!empty($_FILES['cupboard_brefore']['name'][0])){
   $file_count = count($_FILES['cupboard_brefore']['name']);
   if($file_count>0){
     if(!file_exists('uploads/'.$user_id)){
       mkdir('uploads/'.$user_id, 0777, true);
     }
     if(!file_exists('uploads/'.$user_id.'/stem_infra_cupboard_brefore_'.$schoolid)){
       mkdir('uploads/'.$user_id.'/stem_infra_cupboard_brefore_'.$schoolid, 0777, true);
     }
     $target_dir = 'uploads/'.$user_id.'/stem_infra_cupboard_brefore_'.$schoolid."/";


     for ($i = 0; $i < $file_count; $i++)
     {
       $target_file = $target_dir."_".$i."_".basename($_FILES["cupboard_brefore"]["name"][$i]);
       $file_tmp_name    = $_FILES['cupboard_brefore']['tmp_name'][$i];
       $file_name      = $_FILES['cupboard_brefore']['name'][$i];
       $file_size      = $_FILES['cupboard_brefore']['size'][$i];
       $file_type      = $_FILES['cupboard_brefore']['type'][$i];
       $file_error     = $_FILES['cupboard_brefore']['error'][$i];
       $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
       $allowed_extension = array('png','gif','jpeg','jpg', 'jfif');
       if($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mov" && $imageFileType != "3gp" && $imageFileType != "mpeg" && $imageFileType != "doc" && $imageFileType != "pdf" && $imageFileType != "docx")
           {
               if(!in_array(strtolower($imageFileType),$allowed_extension)){
         $output = "file extension error";
         die($output);
       }
       else{
         include_once("Ajax_pages/compressor.php");
         $target = $file_tmp_name;
         $resized_file = $target_file;
         $wmax = 1024;
         $hmax = 768;
         compressor($target, $resized_file, $wmax, $hmax, $imageFileType);
       }
           } else {
           move_uploaded_file($_FILES["files"]["tmp_name"][$i],$target_file);

           }
     }
     }
   }

  if(!empty($_FILES['cupboard_wip']['name'][0])){
  $file_count = count($_FILES['cupboard_wip']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stem_infra_cupboard_wip_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stem_infra_cupboard_wip_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stem_infra_cupboard_wip_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["cupboard_wip"]["name"][$i]);
      $file_tmp_name    = $_FILES['cupboard_wip']['tmp_name'][$i];
      $file_name      = $_FILES['cupboard_wip']['name'][$i];
      $file_size      = $_FILES['cupboard_wip']['size'][$i];
      $file_type      = $_FILES['cupboard_wip']['type'][$i];
      $file_error     = $_FILES['cupboard_wip']['error'][$i];
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      $allowed_extension = array('png','gif','jpeg','jpg', 'jfif');
      if($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mov" && $imageFileType != "3gp" && $imageFileType != "mpeg" && $imageFileType != "doc" && $imageFileType != "pdf" && $imageFileType != "docx")
          {
              if(!in_array(strtolower($imageFileType),$allowed_extension)){
        $output = "file extension error";
        die($output);
      }
      else{
        include_once("Ajax_pages/compressor.php");
        $target = $file_tmp_name;
        $resized_file = $target_file;
        $wmax = 1024;
        $hmax = 768;
        compressor($target, $resized_file, $wmax, $hmax, $imageFileType);
      }
          } else {
          move_uploaded_file($_FILES["files"]["tmp_name"][$i],$target_file);

          }
    }
    }
  }

  if(!empty($_FILES['cupboard_after']['name'][0])){
  $file_count = count($_FILES['cupboard_after']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stem_infra_cupboard_after_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stem_infra_cupboard_after_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stem_infra_cupboard_after_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["cupboard_after"]["name"][$i]);
      $file_tmp_name    = $_FILES['cupboard_after']['tmp_name'][$i];
      $file_name      = $_FILES['cupboard_after']['name'][$i];
      $file_size      = $_FILES['cupboard_after']['size'][$i];
      $file_type      = $_FILES['cupboard_after']['type'][$i];
      $file_error     = $_FILES['cupboard_after']['error'][$i];
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      $allowed_extension = array('png','gif','jpeg','jpg', 'jfif');
      if($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mov" && $imageFileType != "3gp" && $imageFileType != "mpeg" && $imageFileType != "doc" && $imageFileType != "pdf" && $imageFileType != "docx")
          {
              if(!in_array(strtolower($imageFileType),$allowed_extension)){
        $output = "file extension error";
        die($output);
      }
      else{
        include_once("Ajax_pages/compressor.php");
        $target = $file_tmp_name;
        $resized_file = $target_file;
        $wmax = 1024;
        $hmax = 768;
        compressor($target, $resized_file, $wmax, $hmax, $imageFileType);
      }
          } else {
          move_uploaded_file($_FILES["files"]["tmp_name"][$i],$target_file);

          }
    }
    }
  }

   if(!empty($_FILES['flooring_brefore']['name'][0])){
   $file_count = count($_FILES['flooring_brefore']['name']);
   if($file_count>0){
     if(!file_exists('uploads/'.$user_id)){
       mkdir('uploads/'.$user_id, 0777, true);
     }
     if(!file_exists('uploads/'.$user_id.'/stem_infra_flooring_brefore_'.$schoolid)){
       mkdir('uploads/'.$user_id.'/stem_infra_flooring_brefore_'.$schoolid, 0777, true);
     }
     $target_dir = 'uploads/'.$user_id.'/stem_infra_flooring_brefore_'.$schoolid."/";


     for ($i = 0; $i < $file_count; $i++)
     {
       $target_file = $target_dir."_".$i."_".basename($_FILES["flooring_brefore"]["name"][$i]);
       $file_tmp_name    = $_FILES['flooring_brefore']['tmp_name'][$i];
       $file_name      = $_FILES['flooring_brefore']['name'][$i];
       $file_size      = $_FILES['flooring_brefore']['size'][$i];
       $file_type      = $_FILES['flooring_brefore']['type'][$i];
       $file_error     = $_FILES['flooring_brefore']['error'][$i];
       $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
       $allowed_extension = array('png','gif','jpeg','jpg', 'jfif');
       if($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mov" && $imageFileType != "3gp" && $imageFileType != "mpeg" && $imageFileType != "doc" && $imageFileType != "pdf" && $imageFileType != "docx")
           {
               if(!in_array(strtolower($imageFileType),$allowed_extension)){
         $output = "file extension error";
         die($output);
       }
       else{
         include_once("Ajax_pages/compressor.php");
         $target = $file_tmp_name;
         $resized_file = $target_file;
         $wmax = 1024;
         $hmax = 768;
         compressor($target, $resized_file, $wmax, $hmax, $imageFileType);
       }
           } else {
           move_uploaded_file($_FILES["files"]["tmp_name"][$i],$target_file);

           }
     }
     }
   }

  if(!empty($_FILES['flooring_wip']['name'][0])){
  $file_count = count($_FILES['flooring_wip']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stem_infra_flooring_wip_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stem_infra_flooring_wip_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stem_infra_flooring_wip_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["flooring_wip"]["name"][$i]);
      $file_tmp_name    = $_FILES['flooring_wip']['tmp_name'][$i];
      $file_name      = $_FILES['flooring_wip']['name'][$i];
      $file_size      = $_FILES['flooring_wip']['size'][$i];
      $file_type      = $_FILES['flooring_wip']['type'][$i];
      $file_error     = $_FILES['flooring_wip']['error'][$i];
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      $allowed_extension = array('png','gif','jpeg','jpg', 'jfif');
      if($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mov" && $imageFileType != "3gp" && $imageFileType != "mpeg" && $imageFileType != "doc" && $imageFileType != "pdf" && $imageFileType != "docx")
          {
              if(!in_array(strtolower($imageFileType),$allowed_extension)){
        $output = "file extension error";
        die($output);
      }
      else{
        include_once("Ajax_pages/compressor.php");
        $target = $file_tmp_name;
        $resized_file = $target_file;
        $wmax = 1024;
        $hmax = 768;
        compressor($target, $resized_file, $wmax, $hmax, $imageFileType);
      }
          } else {
          move_uploaded_file($_FILES["files"]["tmp_name"][$i],$target_file);

          }
    }
    }
  }

  if(!empty($_FILES['flooring_after']['name'][0])){
  $file_count = count($_FILES['flooring_after']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stem_infra_flooring_after_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stem_infra_flooring_after_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stem_infra_flooring_after_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["flooring_after"]["name"][$i]);
      $file_tmp_name    = $_FILES['flooring_after']['tmp_name'][$i];
      $file_name      = $_FILES['flooring_after']['name'][$i];
      $file_size      = $_FILES['flooring_after']['size'][$i];
      $file_type      = $_FILES['flooring_after']['type'][$i];
      $file_error     = $_FILES['flooring_after']['error'][$i];
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      $allowed_extension = array('png','gif','jpeg','jpg', 'jfif');
      if($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mov" && $imageFileType != "3gp" && $imageFileType != "mpeg" && $imageFileType != "doc" && $imageFileType != "pdf" && $imageFileType != "docx")
          {
              if(!in_array(strtolower($imageFileType),$allowed_extension)){
        $output = "file extension error";
        die($output);
      }
      else{
        include_once("Ajax_pages/compressor.php");
        $target = $file_tmp_name;
        $resized_file = $target_file;
        $wmax = 1024;
        $hmax = 768;
        compressor($target, $resized_file, $wmax, $hmax, $imageFileType);
      }
          } else {
          move_uploaded_file($_FILES["files"]["tmp_name"][$i],$target_file);

          }
    }
    }
  }


if($_POST['action']=='add'){
    $sql5 = "INSERT INTO stem_lab_infra_data(projectid, schoolid, user_id, EWork_sdate, EWork_edate, EWork_progress, EWork_units, EWork_wip, EWork_after,EWork_issues,EWork_remarks,painting_sdate,painting_edate,painting_progress,painting_units,painting_wip,painting_after,painting_issues,painting_remarks,modelDesks_sdate,modelDesks_edate,modelDesks_progress,modelDesks_units,modelDesks_wip,modelDesks_after,modelDesks_issues,modelDesks_remarks,cupboard_sdate,cupboard_edate,cupboard_progress,cupboard_units,cupboard_wip,cupboard_after,cupboard_issues,cupboard_remarks,flooring_sdate,flooring_edate,flooring_progress,flooring_units,flooring_wip,flooring_after,flooring_issues,flooring_remarks)
            VALUES('$projectid','$schoolid','$user_id','$EWork_sdate', '$EWork_edate', '$EWork_progress', '$EWork_units',  '$EWork_wip', '$EWork_after','$EWork_issues','$EWork_remarks','$painting_sdate','$painting_edate','$painting_progress','$painting_units', '$painting_wip','$painting_after','$painting_issues','$painting_remarks','$modelDesks_sdate','$modelDesks_edate','$modelDesks_progress','$modelDesks_units','$modelDesks_wip','$modelDesks_after','$modelDesks_issues','$modelDesks_remarks','$cupboard_sdate','$cupboard_edate','$cupboard_progress','$cupboard_units','$cupboard_wip','$cupboard_after','$cupboard_issues','$cupboard_remarks','$flooring_sdate','$flooring_edate','$flooring_progress','$flooring_units','$flooring_wip','$flooring_after','$flooring_issues','$flooring_remarks')";

  $res =   mysqli_query($con, $sql5);
header('Location: dashboard.php?pid='.$_SESSION['projectid']);
}elseif($_POST['action']=='update'){
$sql8 = "UPDATE stem_lab_infra_data ". "SET projectid = '$projectid', EWork_sdate = '$EWork_sdate', EWork_edate = '$EWork_edate',EWork_progress = '$EWork_progress',EWork_units = '$EWork_units',EWork_brefore = '$EWork_brefore',EWork_wip = '$EWork_wip',EWork_after = '$EWork_after',EWork_issues = '$EWork_issues',EWork_remarks = '$EWork_remarks',painting_sdate = '$painting_sdate',painting_edate = '$painting_edate',painting_progress = '$painting_progress',painting_units = '$painting_units',painting_brefore = '$painting_brefore',painting_wip = '$painting_wip',painting_after = '$painting_after',painting_issues = '$painting_issues',painting_remarks = '$painting_remarks',modelDesks_sdate = '$modelDesks_sdate',modelDesks_edate = '$modelDesks_edate',modelDesks_progress = '$modelDesks_progress',modelDesks_units = '$modelDesks_units',modelDesks_brefore = '$modelDesks_brefore',modelDesks_wip = '$modelDesks_wip',modelDesks_after = '$modelDesks_after',modelDesks_issues = '$modelDesks_issues',modelDesks_remarks = '$modelDesks_remarks',cupboard_sdate = '$cupboard_sdate',cupboard_edate = '$cupboard_edate',cupboard_progress = '$cupboard_progress',cupboard_units = '$cupboard_units',cupboard_brefore = '$cupboard_brefore',cupboard_wip = '$cupboard_wip',cupboard_after = '$cupboard_after',cupboard_issues = '$cupboard_issues',cupboard_remarks = '$cupboard_remarks',flooring_sdate = '$flooring_sdate',flooring_edate = '$flooring_edate',flooring_progress = '$flooring_progress',flooring_units = '$flooring_units',flooring_brefore = '$flooring_brefore',flooring_wip = '$flooring_wip',flooring_after = '$flooring_after',flooring_issues = '$flooring_issues',flooring_remarks = '$flooring_remarks' ". 
               "WHERE schoolid = '$schoolid'" ;
$retval = mysqli_query($con, $sql8);
header('Location: dashboard.php?pid='.$_SESSION['projectid']);
}else{
  echo "string";
}

}else{
    echo "No data sent";
  }
?>
