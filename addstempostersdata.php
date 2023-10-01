<?php
  require("connection.php"); //the connection
  require('check_login.php');

  if(!empty($_POST || $_FILES)){
$user_id = $_SESSION['exp_dash_id'];
$date_es19 = str_replace('/', '-', $_POST['bWall_sdate']);
$bWall_sdate = date('Y-m-d',strtotime($date_es19));
$date_es20 = str_replace('/', '-', $_POST['bWall_edate']);
$bWall_edate = date('Y-m-d',strtotime($date_es20));
$bWall_progress = $_POST['bWall_progress'];
$schoolid = $_POST['schoolid'];
$projectid = $_POST['projectid'];
$bWall_units = $_POST['bWall_units'];
//$bWall_brefore1 = $_FILES['bWall_brefore']['name'];
$bWall_wip1 = $_FILES['bWall_wip']['name'];
$bWall_after1 = $_FILES['bWall_after']['name'];
// if(!empty($bWall_brefore1)){ $bWall_brefore = $_FILES['bWall_brefore']['name']; }else{ $bWall_brefore = $_POST['bWall_brefore'];}
if(!empty($bWall_wip1)){ $bWall_wip = $_FILES['bWall_wip']['name']; }else{$bWall_wip = $_POST['bWall_wip'];}
if(!empty($bWall_after1)){$bWall_after = $_FILES['bWall_after']['name']; }else{$bWall_after = $_POST['bWall_after'];}
$bWall_issues = $_POST['bWall_issues'];
$bWall_remarks = $_POST['bWall_remarks'];
$date_es21 = str_replace('/', '-', $_POST['concepts_sdate']);
$concepts_sdate = date('Y-m-d',strtotime($date_es21));
$date_es22 = str_replace('/', '-', $_POST['concepts_edate']);
$concepts_edate = date('Y-m-d',strtotime($date_es22));
$concepts_progress = $_POST['concepts_progress'];
$concepts_units = $_POST['concepts_units'];
// $concepts_brefore1 = $_FILES['concepts_brefore']['name'];
$concepts_wip1 = $_FILES['concepts_wip']['name'];
$concepts_after1 = $_FILES['concepts_after']['name'];
// if(!empty($concepts_brefore1)){ $concepts_brefore = $_FILES['concepts_brefore']['name']; }else{ $concepts_brefore = $_POST['concepts_brefore'];}
if(!empty($concepts_wip1)){ $concepts_wip = $_FILES['concepts_wip']['name']; }else{$concepts_wip = $_POST['concepts_wip'];}
if(!empty($concepts_after1)){$concepts_after = $_FILES['concepts_after']['name']; }else{$concepts_after = $_POST['concepts_after'];}
$concepts_issues = $_POST['concepts_issues'];
$concepts_remarks = $_POST['concepts_remarks'];
$date_es23 = str_replace('/', '-', $_POST['sSystem_sdate']);
$sSystem_sdate = date('Y-m-d',strtotime($date_es23));
$date_es24 = str_replace('/', '-', $_POST['sSystem_edate']);
$sSystem_edate = date('Y-m-d',strtotime($date_es24));
$sSystem_progress = $_POST['sSystem_progress'];
$sSystem_units = $_POST['sSystem_units'];
// $sSystem_brefore1 = $_FILES['sSystem_brefore']['name'];
$sSystem_wip1 = $_FILES['sSystem_wip']['name'];
$sSystem_after1 = $_FILES['sSystem_after']['name'];
// if(!empty($sSystem_brefore1)){ $sSystem_brefore = $_FILES['sSystem_brefore']['name']; }else{ $sSystem_brefore = $_POST['sSystem_brefore'];}
if(!empty($sSystem_wip1)){ $sSystem_wip = $_FILES['sSystem_wip']['name']; }else{$sSystem_wip = $_POST['sSystem_wip'];}
if(!empty($sSystem_after1)){$sSystem_after = $_FILES['sSystem_after']['name']; }else{$sSystem_after = $_POST['sSystem_after'];}
$sSystem_issues = $_POST['sSystem_issues'];
$sSystem_remarks = $_POST['sSystem_remarks'];
$date_es25 = str_replace('/', '-', $_POST['inCorner_sdate']);
$inCorner_sdate = date('Y-m-d',strtotime($date_es25));
$date_es26 = str_replace('/', '-', $_POST['inCorner_edate']);
$inCorner_edate = date('Y-m-d',strtotime($date_es26));
$inCorner_progress = $_POST['inCorner_progress'];
$inCorner_units = $_POST['inCorner_units'];
// $inCorner_brefore1 = $_FILES['inCorner_brefore']['name'];
$inCorner_wip1 = $_FILES['inCorner_wip']['name'];
$inCorner_after1 = $_FILES['inCorner_after']['name'];
// if(!empty($inCorner_brefore1)){ $inCorner_brefore = $_FILES['inCorner_brefore']['name']; }else{ $inCorner_brefore = $_POST['inCorner_brefore'];}
if(!empty($inCorner_wip1)){ $inCorner_wip = $_FILES['inCorner_wip']['name']; }else{$inCorner_wip = $_POST['inCorner_wip'];}
if(!empty($inCorner_after1)){$inCorner_after = $_FILES['inCorner_after']['name']; }else{$inCorner_after = $_POST['inCorner_after'];}
$inCorner_issues = $_POST['inCorner_issues'];
$inCorner_remarks = $_POST['inCorner_remarks'];
$date_es27 = str_replace('/', '-', $_POST['cutouts_sdate']);
$cutouts_sdate = date('Y-m-d',strtotime($date_es27));
$date_es28 = str_replace('/', '-', $_POST['cutouts_edate']);
$cutouts_edate = date('Y-m-d',strtotime($date_es28));
$cutouts_progress = $_POST['cutouts_progress'];
$cutouts_units = $_POST['cutouts_units'];
// $cutouts_brefore1 = $_FILES['cutouts_brefore']['name'];
$cutouts_wip1 = $_FILES['cutouts_wip']['name'];
$cutouts_after1 = $_FILES['cutouts_after']['name'];
// if(!empty($cutouts_brefore1)){ $cutouts_brefore = $_FILES['cutouts_brefore']['name']; }else{ $cutouts_brefore = $_POST['cutouts_brefore'];}
if(!empty($cutouts_wip1)){ $cutouts_wip = $_FILES['cutouts_wip']['name']; }else{$cutouts_wip = $_POST['cutouts_wip'];}
if(!empty($cutouts_after1)){$cutouts_after = $_FILES['cutouts_after']['name']; }else{$cutouts_after = $_POST['cutouts_after'];}
$cutouts_issues = $_POST['cutouts_issues'];
$cutouts_remarks = $_POST['cutouts_remarks'];


 // if(!empty($_FILES['bWall_brefore']['name'][0])){
 //  $file_count = count($_FILES['bWall_brefore']['name']);
 //  if($file_count>0){
 //    if(!file_exists('uploads/'.$user_id)){
 //      mkdir('uploads/'.$user_id, 0777, true);
 //    }
 //    if(!file_exists('uploads/'.$user_id.'/stem_Posters_bWall_brefore_'.$schoolid)){
 //      mkdir('uploads/'.$user_id.'/stem_Posters_bWall_brefore_'.$schoolid, 0777, true);
 //    }
 //    $target_dir = 'uploads/'.$user_id.'/stem_Posters_bWall_brefore_'.$schoolid."/";


 //    for ($i = 0; $i < $file_count; $i++)
 //    {
 //      $target_file = $target_dir."_".$i."_".basename($_FILES["bWall_brefore"]["name"][$i]);
 //      $file_tmp_name    = $_FILES['bWall_brefore']['tmp_name'][$i];
 //      $file_name      = $_FILES['bWall_brefore']['name'][$i];
 //      $file_size      = $_FILES['bWall_brefore']['size'][$i];
 //      $file_type      = $_FILES['bWall_brefore']['type'][$i];
 //      $file_error     = $_FILES['bWall_brefore']['error'][$i];
 //      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
 //      $allowed_extension = array('png','gif','jpeg','jpg', 'jfif');
 //      if($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mov" && $imageFileType != "3gp" && $imageFileType != "mpeg" && $imageFileType != "doc" && $imageFileType != "pdf" && $imageFileType != "docx")
 //          {
 //              if(!in_array(strtolower($imageFileType),$allowed_extension)){
 //        $output = "file extension error";
 //        die($output);
 //      }
 //      else{
 //        include_once("Ajax_pages/compressor.php");
 //        $target = $file_tmp_name;
 //        $resized_file = $target_file;
 //        $wmax = 1024;
 //        $hmax = 768;
 //        compressor($target, $resized_file, $wmax, $hmax, $imageFileType);
 //      }
 //          } else {
 //          move_uploaded_file($_FILES["files"]["tmp_name"][$i],$target_file);

 //          }
 //    }
 //    }
 //  }

  if(!empty($_FILES['bWall_wip']['name'][0])){
  $file_count = count($_FILES['bWall_wip']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stem_Posters_bWall_wip_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stem_Posters_bWall_wip_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stem_Posters_bWall_wip_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["bWall_wip"]["name"][$i]);
      $file_tmp_name    = $_FILES['bWall_wip']['tmp_name'][$i];
      $file_name      = $_FILES['bWall_wip']['name'][$i];
      $file_size      = $_FILES['bWall_wip']['size'][$i];
      $file_type      = $_FILES['bWall_wip']['type'][$i];
      $file_error     = $_FILES['bWall_wip']['error'][$i];
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

  if(!empty($_FILES['bWall_after']['name'][0])){
  $file_count = count($_FILES['bWall_after']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stem_Posters_bWall_after_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stem_Posters_bWall_after_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stem_Posters_bWall_after_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["bWall_after"]["name"][$i]);
      $file_tmp_name    = $_FILES['bWall_after']['tmp_name'][$i];
      $file_name      = $_FILES['bWall_after']['name'][$i];
      $file_size      = $_FILES['bWall_after']['size'][$i];
      $file_type      = $_FILES['bWall_after']['type'][$i];
      $file_error     = $_FILES['bWall_after']['error'][$i];
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

  // if(!empty($_FILES['concepts_brefore']['name'][0])){
  // $file_count = count($_FILES['concepts_brefore']['name']);
  // if($file_count>0){
  //   if(!file_exists('uploads/'.$user_id)){
  //     mkdir('uploads/'.$user_id, 0777, true);
  //   }
  //   if(!file_exists('uploads/'.$user_id.'/stem_Posters_concepts_brefore_'.$schoolid)){
  //     mkdir('uploads/'.$user_id.'/stem_Posters_concepts_brefore_'.$schoolid, 0777, true);
  //   }
  //   $target_dir = 'uploads/'.$user_id.'/stem_Posters_concepts_brefore_'.$schoolid."/";


  //   for ($i = 0; $i < $file_count; $i++)
  //   {
  //     $target_file = $target_dir."_".$i."_".basename($_FILES["concepts_brefore"]["name"][$i]);
  //     $file_tmp_name    = $_FILES['concepts_brefore']['tmp_name'][$i];
  //     $file_name      = $_FILES['concepts_brefore']['name'][$i];
  //     $file_size      = $_FILES['concepts_brefore']['size'][$i];
  //     $file_type      = $_FILES['concepts_brefore']['type'][$i];
  //     $file_error     = $_FILES['concepts_brefore']['error'][$i];
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

if(!empty($_FILES['concepts_wip']['name'][0])){
  $file_count = count($_FILES['concepts_wip']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stem_Posters_concepts_wip_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stem_Posters_concepts_wip_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stem_Posters_concepts_wip_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["concepts_wip"]["name"][$i]);
      $file_tmp_name    = $_FILES['concepts_wip']['tmp_name'][$i];
      $file_name      = $_FILES['concepts_wip']['name'][$i];
      $file_size      = $_FILES['concepts_wip']['size'][$i];
      $file_type      = $_FILES['concepts_wip']['type'][$i];
      $file_error     = $_FILES['concepts_wip']['error'][$i];
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

  
if(!empty($_FILES['concepts_after']['name'][0])){
  $file_count = count($_FILES['concepts_after']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stem_Posters_concepts_after_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stem_Posters_concepts_after_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stem_Posters_concepts_after_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["concepts_after"]["name"][$i]);
      $file_tmp_name    = $_FILES['concepts_after']['tmp_name'][$i];
      $file_name      = $_FILES['concepts_after']['name'][$i];
      $file_size      = $_FILES['concepts_after']['size'][$i];
      $file_type      = $_FILES['concepts_after']['type'][$i];
      $file_error     = $_FILES['concepts_after']['error'][$i];
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

  
  // if(!empty($_FILES['sSystem_brefore']['name'][0])){
  // $file_count = count($_FILES['sSystem_brefore']['name']);
  // if($file_count>0){
  //   if(!file_exists('uploads/'.$user_id)){
  //     mkdir('uploads/'.$user_id, 0777, true);
  //   }
  //   if(!file_exists('uploads/'.$user_id.'/stem_Posters_sSystem_brefore_'.$schoolid)){
  //     mkdir('uploads/'.$user_id.'/stem_Posters_sSystem_brefore_'.$schoolid, 0777, true);
  //   }
  //   $target_dir = 'uploads/'.$user_id.'/stem_Posters_sSystem_brefore_'.$schoolid."/";


  //   for ($i = 0; $i < $file_count; $i++)
  //   {
  //     $target_file = $target_dir."_".$i."_".basename($_FILES["sSystem_brefore"]["name"][$i]);
  //     $file_tmp_name    = $_FILES['sSystem_brefore']['tmp_name'][$i];
  //     $file_name      = $_FILES['sSystem_brefore']['name'][$i];
  //     $file_size      = $_FILES['sSystem_brefore']['size'][$i];
  //     $file_type      = $_FILES['sSystem_brefore']['type'][$i];
  //     $file_error     = $_FILES['sSystem_brefore']['error'][$i];
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

  
  if(!empty($_FILES['sSystem_wip']['name'][0])){
  $file_count = count($_FILES['sSystem_wip']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stem_Posters_sSystem_wip_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stem_Posters_sSystem_wip_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stem_Posters_sSystem_wip_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["sSystem_wip"]["name"][$i]);
      $file_tmp_name    = $_FILES['sSystem_wip']['tmp_name'][$i];
      $file_name      = $_FILES['sSystem_wip']['name'][$i];
      $file_size      = $_FILES['sSystem_wip']['size'][$i];
      $file_type      = $_FILES['sSystem_wip']['type'][$i];
      $file_error     = $_FILES['sSystem_wip']['error'][$i];
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

  
  if(!empty($_FILES['sSystem_after']['name'][0])){
  $file_count = count($_FILES['sSystem_after']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stem_Posters_sSystem_after_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stem_Posters_sSystem_after_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stem_Posters_sSystem_after_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["sSystem_after"]["name"][$i]);
      $file_tmp_name    = $_FILES['sSystem_after']['tmp_name'][$i];
      $file_name      = $_FILES['sSystem_after']['name'][$i];
      $file_size      = $_FILES['sSystem_after']['size'][$i];
      $file_type      = $_FILES['sSystem_after']['type'][$i];
      $file_error     = $_FILES['sSystem_after']['error'][$i];
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

  

  
// if(!empty($_FILES['inCorner_brefore']['name'][0])){
//   $file_count = count($_FILES['inCorner_brefore']['name']);
//   if($file_count>0){
//     if(!file_exists('uploads/'.$user_id)){
//       mkdir('uploads/'.$user_id, 0777, true);
//     }
//     if(!file_exists('uploads/'.$user_id.'/stem_Posters_inCorner_brefore_'.$schoolid)){
//       mkdir('uploads/'.$user_id.'/stem_Posters_inCorner_brefore_'.$schoolid, 0777, true);
//     }
//     $target_dir = 'uploads/'.$user_id.'/stem_Posters_inCorner_brefore_'.$schoolid."/";


//     for ($i = 0; $i < $file_count; $i++)
//     {
//       $target_file = $target_dir."_".$i."_".basename($_FILES["inCorner_brefore"]["name"][$i]);
//       $file_tmp_name    = $_FILES['inCorner_brefore']['tmp_name'][$i];
//       $file_name      = $_FILES['inCorner_brefore']['name'][$i];
//       $file_size      = $_FILES['inCorner_brefore']['size'][$i];
//       $file_type      = $_FILES['inCorner_brefore']['type'][$i];
//       $file_error     = $_FILES['inCorner_brefore']['error'][$i];
//       $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
//       $allowed_extension = array('png','gif','jpeg','jpg', 'jfif');
//       if($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mov" && $imageFileType != "3gp" && $imageFileType != "mpeg" && $imageFileType != "doc" && $imageFileType != "pdf" && $imageFileType != "docx")
//           {
//               if(!in_array(strtolower($imageFileType),$allowed_extension)){
//         $output = "file extension error";
//         die($output);
//       }
//       else{
//         include_once("Ajax_pages/compressor.php");
//         $target = $file_tmp_name;
//         $resized_file = $target_file;
//         $wmax = 1024;
//         $hmax = 768;
//         compressor($target, $resized_file, $wmax, $hmax, $imageFileType);
//       }
//           } else {
//           move_uploaded_file($_FILES["files"]["tmp_name"][$i],$target_file);

//           }
//     }
//     }
//   }

  if(!empty($_FILES['inCorner_wip']['name'][0])){
  $file_count = count($_FILES['inCorner_wip']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stem_Posters_inCorner_wip_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stem_Posters_inCorner_wip_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stem_Posters_inCorner_wip_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["inCorner_wip"]["name"][$i]);
      $file_tmp_name    = $_FILES['inCorner_wip']['tmp_name'][$i];
      $file_name      = $_FILES['inCorner_wip']['name'][$i];
      $file_size      = $_FILES['inCorner_wip']['size'][$i];
      $file_type      = $_FILES['inCorner_wip']['type'][$i];
      $file_error     = $_FILES['inCorner_wip']['error'][$i];
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

if(!empty($_FILES['inCorner_after']['name'][0])){
  $file_count = count($_FILES['inCorner_after']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stem_Posters_inCorner_after_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stem_Posters_inCorner_after_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stem_Posters_inCorner_after_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["inCorner_after"]["name"][$i]);
      $file_tmp_name    = $_FILES['inCorner_after']['tmp_name'][$i];
      $file_name      = $_FILES['inCorner_after']['name'][$i];
      $file_size      = $_FILES['inCorner_after']['size'][$i];
      $file_type      = $_FILES['inCorner_after']['type'][$i];
      $file_error     = $_FILES['inCorner_after']['error'][$i];
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

  // if(!empty($_FILES['cutouts_brefore']['name'][0])){
  // $file_count = count($_FILES['cutouts_brefore']['name']);
  // if($file_count>0){
  //   if(!file_exists('uploads/'.$user_id)){
  //     mkdir('uploads/'.$user_id, 0777, true);
  //   }
  //   if(!file_exists('uploads/'.$user_id.'/stem_Posters_cutouts_brefore_'.$schoolid)){
  //     mkdir('uploads/'.$user_id.'/stem_Posters_cutouts_brefore_'.$schoolid, 0777, true);
  //   }
  //   $target_dir = 'uploads/'.$user_id.'/stem_Posters_cutouts_brefore_'.$schoolid."/";


  //   for ($i = 0; $i < $file_count; $i++)
  //   {
  //     $target_file = $target_dir."_".$i."_".basename($_FILES["cutouts_brefore"]["name"][$i]);
  //     $file_tmp_name    = $_FILES['cutouts_brefore']['tmp_name'][$i];
  //     $file_name      = $_FILES['cutouts_brefore']['name'][$i];
  //     $file_size      = $_FILES['cutouts_brefore']['size'][$i];
  //     $file_type      = $_FILES['cutouts_brefore']['type'][$i];
  //     $file_error     = $_FILES['cutouts_brefore']['error'][$i];
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

  if(!empty($_FILES['cutouts_wip']['name'][0])){
  $file_count = count($_FILES['cutouts_wip']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stem_Posters_cutouts_wip_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stem_Posters_cutouts_wip_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stem_Posters_cutouts_wip_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["cutouts_wip"]["name"][$i]);
      $file_tmp_name    = $_FILES['cutouts_wip']['tmp_name'][$i];
      $file_name      = $_FILES['cutouts_wip']['name'][$i];
      $file_size      = $_FILES['cutouts_wip']['size'][$i];
      $file_type      = $_FILES['cutouts_wip']['type'][$i];
      $file_error     = $_FILES['cutouts_wip']['error'][$i];
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

  if(!empty($_FILES['cutouts_after']['name'][0])){
  $file_count = count($_FILES['cutouts_after']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stem_Posters_cutouts_after_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stem_Posters_cutouts_after_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stem_Posters_cutouts_after_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["cutouts_after"]["name"][$i]);
      $file_tmp_name    = $_FILES['cutouts_after']['tmp_name'][$i];
      $file_name      = $_FILES['cutouts_after']['name'][$i];
      $file_size      = $_FILES['cutouts_after']['size'][$i];
      $file_type      = $_FILES['cutouts_after']['type'][$i];
      $file_error     = $_FILES['cutouts_after']['error'][$i];
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
    $sql5 = "INSERT INTO stempostersdata(projectid, schoolid,user_id, bWall_sdate, bWall_edate, bWall_progress, bWall_units, bWall_wip, bWall_after,bWall_issues,bWall_remarks,concepts_sdate,concepts_edate,concepts_progress,concepts_units,concepts_wip,concepts_after,concepts_issues,concepts_remarks,sSystem_sdate,sSystem_edate,sSystem_progress,sSystem_units,sSystem_wip,sSystem_after,sSystem_issues,sSystem_remarks,inCorner_sdate,inCorner_edate,inCorner_progress,inCorner_units,inCorner_wip,inCorner_after,inCorner_issues,inCorner_remarks,cutouts_sdate,cutouts_edate,cutouts_progress,cutouts_units,cutouts_wip,cutouts_after,cutouts_issues,cutouts_remarks)
            VALUES('$projectid','$schoolid','$user_id','$bWall_sdate', '$bWall_edate', '$bWall_progress', '$bWall_units', '$bWall_wip', '$bWall_after','$bWall_issues','$bWall_remarks','$concepts_sdate','$concepts_edate','$concepts_progress','$concepts_units','$concepts_wip','$concepts_after','$concepts_issues','$concepts_remarks','$sSystem_sdate','$sSystem_edate','$sSystem_progress','$sSystem_units','$sSystem_wip','$sSystem_after','$sSystem_issues','$sSystem_remarks','$inCorner_sdate','$inCorner_edate','$inCorner_progress','$inCorner_units','$inCorner_wip','$inCorner_after','$inCorner_issues','$inCorner_remarks','$cutouts_sdate','$cutouts_edate','$cutouts_progress','$cutouts_units','$cutouts_wip','$cutouts_after','$cutouts_issues','$cutouts_remarks')";

  $res =   mysqli_query($con, $sql5);
header('Location: dashboard.php?pid='.$_SESSION['projectid']);
}elseif($_POST['action']=='update'){

$sql8 = "UPDATE stempostersdata ". "SET projectid = '$projectid', bWall_sdate = '$bWall_sdate', bWall_edate = '$bWall_edate',bWall_progress = '$bWall_progress',bWall_units = '$bWall_units',bWall_wip = '$bWall_wip',bWall_after = '$bWall_after',bWall_issues = '$bWall_issues',bWall_remarks = '$bWall_remarks',concepts_sdate = '$concepts_sdate',concepts_edate = '$concepts_edate',concepts_progress = '$concepts_progress',concepts_units = '$concepts_units',concepts_wip = '$concepts_wip',concepts_after = '$concepts_after',concepts_issues = '$concepts_issues',concepts_remarks = '$concepts_remarks',sSystem_sdate = '$sSystem_sdate',sSystem_edate = '$sSystem_edate',sSystem_progress = '$sSystem_progress',sSystem_units = '$sSystem_units',sSystem_wip = '$sSystem_wip',sSystem_after = '$sSystem_after',sSystem_issues = '$sSystem_issues',sSystem_remarks = '$sSystem_remarks',inCorner_sdate = '$inCorner_sdate',inCorner_edate = '$inCorner_edate',inCorner_progress = '$inCorner_progress',inCorner_units = '$inCorner_units',inCorner_wip = '$inCorner_wip',inCorner_after = '$inCorner_after',inCorner_issues = '$inCorner_issues',inCorner_remarks = '$inCorner_remarks',cutouts_sdate = '$cutouts_sdate',cutouts_edate = '$cutouts_edate',cutouts_progress = '$cutouts_progress',cutouts_units = '$cutouts_units',cutouts_wip = '$cutouts_wip',cutouts_after = '$cutouts_after',cutouts_issues = '$cutouts_issues',cutouts_remarks = '$cutouts_remarks' ". 
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
