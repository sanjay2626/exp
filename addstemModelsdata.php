<?php
  require("connection.php"); //the connection
  require('check_login.php');


  if(!empty($_POST || $_FILES)){

$user_id = $_SESSION['exp_dash_id'];
$date_es11 = str_replace('/', '-', $_POST['science_sdate']);
$science_sdate = date('Y-m-d',strtotime($date_es11));
$date_es12 = str_replace('/', '-', $_POST['science_edate']);
$science_edate = date('Y-m-d',strtotime($date_es12));
$science_progress = $_POST['science_progress'];
$schoolid = $_POST['schoolid'];
$projectid = $_POST['projectid'];
$science_units = $_POST['science_units'];
//$science_brefore1 = $_FILES['science_brefore']['name'];
$science_wip1 = $_FILES['science_wip']['name'];
$science_after1 = $_FILES['science_after']['name'];
// if(!empty($science_brefore1)){ $science_brefore = $_FILES['science_brefore']['name']; }else{ $science_brefore = $_POST['science_brefore'];}
if(!empty($science_wip1)){ $science_wip = $_FILES['science_wip']['name']; }else{$science_wip = $_POST['science_wip'];}
if(!empty($science_after1)){$science_after = $_FILES['science_after']['name']; }else{$science_after = $_POST['science_after'];}
$science_issues = $_POST['science_issues'];
$science_remarks = $_POST['science_remarks'];
$date_es13 = str_replace('/', '-', $_POST['math_sdate']);
$math_sdate = date('Y-m-d',strtotime($date_es13));
$date_es14 = str_replace('/', '-', $_POST['math_edate']);
$math_edate = date('Y-m-d',strtotime($date_es14));
$math_progress = $_POST['math_progress'];
$math_units = $_POST['math_units'];
//$math_brefore1 = $_FILES['math_brefore']['name'];
$math_wip1 = $_FILES['math_wip']['name'];
$math_after1 = $_FILES['math_after']['name'];
// if(!empty($math_brefore1)){ $math_brefore = $_FILES['math_brefore']['name']; }else{ $math_brefore = $_POST['math_brefore'];}
if(!empty($math_wip1)){ $math_wip = $_FILES['math_wip']['name']; }else{$math_wip = $_POST['math_wip'];}
if(!empty($math_after1)){$math_after = $_FILES['math_after']['name']; }else{$math_after = $_POST['math_after'];}
$math_issues = $_POST['math_issues'];
$math_remarks = $_POST['math_remarks'];
$date_es15 = str_replace('/', '-', $_POST['robotics_sdate']);
$robotics_sdate = date('Y-m-d',strtotime($date_es15));
$date_es16 = str_replace('/', '-', $_POST['robotics_edate']);
$robotics_edate = date('Y-m-d',strtotime($date_es16));
$robotics_progress = $_POST['robotics_progress'];
$robotics_units = $_POST['robotics_units'];
// $robotics_brefore1 = $_FILES['robotics_brefore']['name'];
$robotics_wip1 = $_FILES['robotics_wip']['name'];
$robotics_after1 =$_FILES['robotics_after']['name'];
// if(!empty($robotics_brefore1)){ $robotics_brefore = $_FILES['robotics_brefore']['name']; }else{ $robotics_brefore = $_POST['robotics_brefore'];}
if(!empty($robotics_wip1)){ $robotics_wip = $_FILES['robotics_wip']['name']; }else{$robotics_wip = $_POST['robotics_wip'];}
if(!empty($robotics_after1)){$robotics_after = $_FILES['robotics_after']['name']; }else{$robotics_after = $_POST['robotics_after'];}
$robotics_issues = $_POST['robotics_issues'];
$robotics_remarks = $_POST['robotics_remarks'];
$date_es17 = str_replace('/', '-', $_POST['computer_sdate']);
$computer_sdate = date('Y-m-d',strtotime($date_es17));
$date_es18 = str_replace('/', '-', $_POST['computer_edate']);
$computer_edate = date('Y-m-d',strtotime($date_es18));
$computer_progress = $_POST['computer_progress'];
$computer_units = $_POST['computer_units'];
// $computer_brefore1 = $_FILES['computer_brefore']['name'];
$computer_wip1 = $_FILES['computer_wip']['name'];
$computer_after1 = $_FILES['computer_after']['name'];
// if(!empty($computer_brefore1)){ $computer_brefore = $_FILES['computer_brefore']['name']; }else{ $computer_brefore = $_POST['computer_brefore'];}
if(!empty($computer_wip1)){ $computer_wip = $_FILES['computer_wip']['name']; }else{$computer_wip = $_POST['computer_wip'];}
if(!empty($computer_after1)){$computer_after = $_FILES['computer_after']['name']; }else{
  $computer_after = $_POST['computer_after'];}
  $computer_issues = $_POST['computer_issues'];
  $computer_remarks = $_POST['computer_remarks'];




  // if(!empty($_FILES['science_brefore']['name'][0])){
  // $file_count = count($_FILES['science_brefore']['name']);
  // if($file_count>0){
  //   if(!file_exists('uploads/'.$user_id)){
  //     mkdir('uploads/'.$user_id, 0777, true);
  //   }
  //   if(!file_exists('uploads/'.$user_id.'/stem_models_science_brefore_'.$schoolid)){
  //     mkdir('uploads/'.$user_id.'/stem_models_science_brefore_'.$schoolid, 0777, true);
  //   }
  //   $target_dir = 'uploads/'.$user_id.'/stem_models_science_brefore_'.$schoolid."/";


  //   for ($i = 0; $i < $file_count; $i++)
  //   {
  //     $target_file = $target_dir."_".$i."_".basename($_FILES["science_brefore"]["name"][$i]);
  //     $file_tmp_name    = $_FILES['science_brefore']['tmp_name'][$i];
  //     $file_name      = $_FILES['science_brefore']['name'][$i];
  //     $file_size      = $_FILES['science_brefore']['size'][$i];
  //     $file_type      = $_FILES['science_brefore']['type'][$i];
  //     $file_error     = $_FILES['science_brefore']['error'][$i];
  //     $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  //     $allowed_extension = array('png','gif','jpeg','jpg', 'jfif');
  //     if($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mov" && $imageFileType != "3gp" && $imageFileType != "mpeg" && $imageFileType != "doc" && $imageFileType != "pdf" && $imageFileType != "docx")
  //         {
  //             if(!in_array(strtolower($imageFileType),$allowed_extension)){
  //       $output = "file extension error";
  //       die($output);
  //     }
  //     else{
  //       include_once("Ajax_pages/compressor.php");
  //       $target = $file_tmp_name;
  //       $resized_file = $target_file;
  //       $wmax = 1024;
  //       $hmax = 768;
  //       compressor($target, $resized_file, $wmax, $hmax, $imageFileType);
  //     }
  //         } else {
  //         move_uploaded_file($_FILES["files"]["tmp_name"][$i],$target_file);

  //         }
  //   }
  //   }
  // }

 if(!empty($_FILES['science_wip']['name'][0])){
  $file_count = count($_FILES['science_wip']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stem_models_science_wip_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stem_models_science_wip_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stem_models_science_wip_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["science_wip"]["name"][$i]);
      $file_tmp_name    = $_FILES['science_wip']['tmp_name'][$i];
      $file_name      = $_FILES['science_wip']['name'][$i];
      $file_size      = $_FILES['science_wip']['size'][$i];
      $file_type      = $_FILES['science_wip']['type'][$i];
      $file_error     = $_FILES['science_wip']['error'][$i];
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


  if(!empty($_FILES['science_after']['name'][0])){
  $file_count = count($_FILES['science_after']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stem_models_science_after_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stem_models_science_after_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stem_models_science_after_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["science_after"]["name"][$i]);
      $file_tmp_name    = $_FILES['science_after']['tmp_name'][$i];
      $file_name      = $_FILES['science_after']['name'][$i];
      $file_size      = $_FILES['science_after']['size'][$i];
      $file_type      = $_FILES['science_after']['type'][$i];
      $file_error     = $_FILES['science_after']['error'][$i];
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

  // if(!empty($_FILES['math_brefore']['name'][0])){
  // $file_count = count($_FILES['math_brefore']['name']);
  // if($file_count>0){
  //   if(!file_exists('uploads/'.$user_id)){
  //     mkdir('uploads/'.$user_id, 0777, true);
  //   }
  //   if(!file_exists('uploads/'.$user_id.'/stem_models_math_brefore_'.$schoolid)){
  //     mkdir('uploads/'.$user_id.'/stem_models_math_brefore_'.$schoolid, 0777, true);
  //   }
  //   $target_dir = 'uploads/'.$user_id.'/stem_models_math_brefore_'.$schoolid."/";


  //   for ($i = 0; $i < $file_count; $i++)
  //   {
  //     $target_file = $target_dir."_".$i."_".basename($_FILES["math_brefore"]["name"][$i]);
  //     $file_tmp_name    = $_FILES['math_brefore']['tmp_name'][$i];
  //     $file_name      = $_FILES['math_brefore']['name'][$i];
  //     $file_size      = $_FILES['math_brefore']['size'][$i];
  //     $file_type      = $_FILES['math_brefore']['type'][$i];
  //     $file_error     = $_FILES['math_brefore']['error'][$i];
  //     $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  //     $allowed_extension = array('png','gif','jpeg','jpg', 'jfif');
  //     if($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mov" && $imageFileType != "3gp" && $imageFileType != "mpeg" && $imageFileType != "doc" && $imageFileType != "pdf" && $imageFileType != "docx")
  //         {
  //             if(!in_array(strtolower($imageFileType),$allowed_extension)){
  //       $output = "file extension error";
  //       die($output);
  //     }
  //     else{
  //       include_once("Ajax_pages/compressor.php");
  //       $target = $file_tmp_name;
  //       $resized_file = $target_file;
  //       $wmax = 1024;
  //       $hmax = 768;
  //       compressor($target, $resized_file, $wmax, $hmax, $imageFileType);
  //     }
  //         } else {
  //         move_uploaded_file($_FILES["files"]["tmp_name"][$i],$target_file);

  //         }
  //   }
  //   }
  // }

  if(!empty($_FILES['math_wip']['name'][0])){
  $file_count = count($_FILES['math_wip']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stem_models_math_wip_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stem_models_math_wip_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stem_models_math_wip_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["math_wip"]["name"][$i]);
      $file_tmp_name    = $_FILES['math_wip']['tmp_name'][$i];
      $file_name      = $_FILES['math_wip']['name'][$i];
      $file_size      = $_FILES['math_wip']['size'][$i];
      $file_type      = $_FILES['math_wip']['type'][$i];
      $file_error     = $_FILES['math_wip']['error'][$i];
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

  if(!empty($_FILES['math_after']['name'][0])){
  $file_count = count($_FILES['math_after']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stem_models_math_after_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stem_models_math_after_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stem_models_math_after_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["math_after"]["name"][$i]);
      $file_tmp_name    = $_FILES['math_after']['tmp_name'][$i];
      $file_name      = $_FILES['math_after']['name'][$i];
      $file_size      = $_FILES['math_after']['size'][$i];
      $file_type      = $_FILES['math_after']['type'][$i];
      $file_error     = $_FILES['math_after']['error'][$i];
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

  // if(!empty($_FILES['robotics_brefore']['name'][0])){
  // $file_count = count($_FILES['robotics_brefore']['name']);
  // if($file_count>0){
  //   if(!file_exists('uploads/'.$user_id)){
  //     mkdir('uploads/'.$user_id, 0777, true);
  //   }
  //   if(!file_exists('uploads/'.$user_id.'/stem_models_robotics_brefore_'.$schoolid)){
  //     mkdir('uploads/'.$user_id.'/stem_models_robotics_brefore_'.$schoolid, 0777, true);
  //   }
  //   $target_dir = 'uploads/'.$user_id.'/stem_models_robotics_brefore_'.$schoolid."/";


  //   for ($i = 0; $i < $file_count; $i++)
  //   {
  //     $target_file = $target_dir."_".$i."_".basename($_FILES["robotics_brefore"]["name"][$i]);
  //     $file_tmp_name    = $_FILES['robotics_brefore']['tmp_name'][$i];
  //     $file_name      = $_FILES['robotics_brefore']['name'][$i];
  //     $file_size      = $_FILES['robotics_brefore']['size'][$i];
  //     $file_type      = $_FILES['robotics_brefore']['type'][$i];
  //     $file_error     = $_FILES['robotics_brefore']['error'][$i];
  //     $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  //     $allowed_extension = array('png','gif','jpeg','jpg', 'jfif');
  //     if($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mov" && $imageFileType != "3gp" && $imageFileType != "mpeg" && $imageFileType != "doc" && $imageFileType != "pdf" && $imageFileType != "docx")
  //         {
  //             if(!in_array(strtolower($imageFileType),$allowed_extension)){
  //       $output = "file extension error";
  //       die($output);
  //     }
  //     else{
  //       include_once("Ajax_pages/compressor.php");
  //       $target = $file_tmp_name;
  //       $resized_file = $target_file;
  //       $wmax = 1024;
  //       $hmax = 768;
  //       compressor($target, $resized_file, $wmax, $hmax, $imageFileType);
  //     }
  //         } else {
  //         move_uploaded_file($_FILES["files"]["tmp_name"][$i],$target_file);

  //         }
  //   }
  //   }
  // }

  if(!empty($_FILES['robotics_wip']['name'][0])){
  $file_count = count($_FILES['robotics_wip']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stem_models_robotics_wip_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stem_models_robotics_wip_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stem_models_robotics_wip_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["robotics_wip"]["name"][$i]);
      $file_tmp_name    = $_FILES['robotics_wip']['tmp_name'][$i];
      $file_name      = $_FILES['robotics_wip']['name'][$i];
      $file_size      = $_FILES['robotics_wip']['size'][$i];
      $file_type      = $_FILES['robotics_wip']['type'][$i];
      $file_error     = $_FILES['robotics_wip']['error'][$i];
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

  if(!empty($_FILES['robotics_after']['name'][0])){
  $file_count = count($_FILES['robotics_after']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stem_models_robotics_after_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stem_models_robotics_after_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stem_models_robotics_after_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["robotics_after"]["name"][$i]);
      $file_tmp_name    = $_FILES['robotics_after']['tmp_name'][$i];
      $file_name      = $_FILES['robotics_after']['name'][$i];
      $file_size      = $_FILES['robotics_after']['size'][$i];
      $file_type      = $_FILES['robotics_after']['type'][$i];
      $file_error     = $_FILES['robotics_after']['error'][$i];
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

  // if(!empty($_FILES['computer_brefore']['name'][0])){
  // $file_count = count($_FILES['computer_brefore']['name']);
  // if($file_count>0){
  //   if(!file_exists('uploads/'.$user_id)){
  //     mkdir('uploads/'.$user_id, 0777, true);
  //   }
  //   if(!file_exists('uploads/'.$user_id.'/stem_models_computer_brefore_'.$schoolid)){
  //     mkdir('uploads/'.$user_id.'/stem_models_computer_brefore_'.$schoolid, 0777, true);
  //   }
  //   $target_dir = 'uploads/'.$user_id.'/stem_models_computer_brefore_'.$schoolid."/";


  //   for ($i = 0; $i < $file_count; $i++)
  //   {
  //     $target_file = $target_dir."_".$i."_".basename($_FILES["computer_brefore"]["name"][$i]);
  //     $file_tmp_name    = $_FILES['computer_brefore']['tmp_name'][$i];
  //     $file_name      = $_FILES['computer_brefore']['name'][$i];
  //     $file_size      = $_FILES['computer_brefore']['size'][$i];
  //     $file_type      = $_FILES['computer_brefore']['type'][$i];
  //     $file_error     = $_FILES['computer_brefore']['error'][$i];
  //     $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  //     $allowed_extension = array('png','gif','jpeg','jpg', 'jfif');
  //     if($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mov" && $imageFileType != "3gp" && $imageFileType != "mpeg" && $imageFileType != "doc" && $imageFileType != "pdf" && $imageFileType != "docx")
  //         {
  //             if(!in_array(strtolower($imageFileType),$allowed_extension)){
  //       $output = "file extension error";
  //       die($output);
  //     }
  //     else{
  //       include_once("Ajax_pages/compressor.php");
  //       $target = $file_tmp_name;
  //       $resized_file = $target_file;
  //       $wmax = 1024;
  //       $hmax = 768;
  //       compressor($target, $resized_file, $wmax, $hmax, $imageFileType);
  //     }
  //         } else {
  //         move_uploaded_file($_FILES["files"]["tmp_name"][$i],$target_file);

  //         }
  //   }
  //   }
  // }

  if(!empty($_FILES['computer_wip']['name'][0])){
  $file_count = count($_FILES['computer_wip']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stem_models_computer_wip_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stem_models_computer_wip_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stem_models_computer_wip_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["computer_wip"]["name"][$i]);
      $file_tmp_name    = $_FILES['computer_wip']['tmp_name'][$i];
      $file_name      = $_FILES['computer_wip']['name'][$i];
      $file_size      = $_FILES['computer_wip']['size'][$i];
      $file_type      = $_FILES['computer_wip']['type'][$i];
      $file_error     = $_FILES['computer_wip']['error'][$i];
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

  if(!empty($_FILES['computer_after']['name'][0])){
  $file_count = count($_FILES['computer_after']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stem_models_computer_after_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stem_models_computer_after_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stem_models_computer_after_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["computer_after"]["name"][$i]);
      $file_tmp_name    = $_FILES['computer_after']['tmp_name'][$i];
      $file_name      = $_FILES['computer_after']['name'][$i];
      $file_size      = $_FILES['computer_after']['size'][$i];
      $file_type      = $_FILES['computer_after']['type'][$i];
      $file_error     = $_FILES['computer_after']['error'][$i];
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
    $sql5 = "INSERT INTO stem_models_data(projectid, schoolid,user_id, science_sdate, science_edate, science_progress, science_units, science_wip, science_after,science_issues,science_remarks,math_sdate,math_edate,math_progress,math_units,math_wip,math_after,math_issues,math_remarks,robotics_sdate,robotics_edate,robotics_progress,robotics_units,robotics_wip,robotics_after,robotics_issues,robotics_remarks,computer_sdate,computer_edate,computer_progress,computer_units,computer_wip,computer_after,computer_issues,computer_remarks)
            VALUES('$projectid','$schoolid','$user_id','$science_sdate', '$science_edate', '$science_progress', '$science_units', '$science_wip', '$science_after','$science_issues','$science_remarks','$math_sdate','$math_edate','$math_progress','$math_units','$math_wip','$math_after','$math_issues','$math_remarks','$robotics_sdate','$robotics_edate','$robotics_progress','$robotics_units','$robotics_wip','$robotics_after','$robotics_issues','$robotics_remarks','$computer_sdate','$computer_edate','$computer_progress','$computer_units','$computer_wip','$computer_after','$computer_issues','$computer_remarks')";

  $res =   mysqli_query($con, $sql5);

header('Location: dashboard.php?pid='.$_SESSION['projectid']);
}elseif($_POST['action']=='update'){
$sql8 = "UPDATE stem_models_data ". "SET projectid = '$projectid', science_sdate = '$science_sdate', science_edate = '$science_edate',science_progress = '$science_progress',science_units = '$science_units',science_wip = '$science_wip',science_after = '$science_after',science_issues = '$science_issues',science_remarks = '$science_remarks',math_sdate = '$math_sdate',math_edate = '$math_edate',math_progress = '$math_progress',math_units = '$math_units',math_wip = '$math_wip',math_after = '$math_after',math_issues = '$math_issues',math_remarks = '$math_remarks',robotics_sdate = '$robotics_sdate',robotics_edate = '$robotics_edate',robotics_progress = '$robotics_progress',robotics_units = '$robotics_units',robotics_wip = '$robotics_wip',robotics_after = '$robotics_after',robotics_issues = '$robotics_issues',robotics_remarks = '$robotics_remarks',computer_sdate = '$computer_sdate',computer_edate = '$computer_edate',computer_progress = '$computer_progress',computer_units = '$computer_units',computer_wip = '$computer_wip',computer_after = '$computer_after',computer_issues = '$computer_issues',computer_remarks = '$computer_remarks' ". 
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
