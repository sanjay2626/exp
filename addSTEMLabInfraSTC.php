<?php
  require("connection.php"); //the connection
  require('check_login.php');

  if(!empty($_POST || $_FILES)){


$user_id = $_SESSION['exp_dash_id'];
$schoolid = $_POST['schoolid'];
$projectid = $_POST['projectid'];

$date_es = str_replace('/', '-', $_POST['EWork_sdate']);
$EWork_sdate = date('Y-m-d', strtotime($date_es));
$date_es2 = str_replace('/', '-', $_POST['EWork_edate']);
$EWork_edate = date('Y-m-d', strtotime($date_es2));

$EWork_progress = $_POST['EWork_progress'];
$EWork_units = $_POST['EWork_units'];
$EWork_wip1 = $_FILES['EWork_Wip']['name'];
$EWork_after1 = $_FILES['EWork_After']['name'];

if(!empty($EWork_wip1)){ $EWork_Wip = $_FILES['EWork_Wip']['name']; }else{$EWork_Wip = $_POST['EWork_Wip'];}
if(!empty($EWork_after1)){$EWork_After = $_FILES['EWork_After']['name']; }else{$EWork_After = $_POST['EWork_After'];}
$EWork_issues = $_POST['EWork_issues'];
$EWork_remarks = $_POST['EWork_remarks'];


$date_es5 = str_replace('/', '-', $_POST['modelDesks_sdate']);
$modelDesks_sdate = date('Y-m-d', strtotime($date_es5));
$date_es6 = str_replace('/', '-', $_POST['modelDesks_edate']);
$modelDesks_edate = date('Y-m-d', strtotime($date_es6));
$modelDesks_progress = $_POST['modelDesks_progress'];
$modelDesks_units = $_POST['modelDesks_units'];
//$modelDesks_brefore1 = $_FILES['modelDesks_brefore']['name'];
$modelDesks_wip1 = $_FILES['modelDesks_Wip']['name'];
$modelDesks_after1 =$_FILES['modelDesks_After']['name'];
// if(!empty($modelDesks_brefore1)){ $modelDesks_brefore = $_FILES['modelDesks_brefore']['name']; }else{ $modelDesks_brefore = $_POST['modelDesks_brefore'];}
if(!empty($modelDesks_wip1)){ $modelDesks_Wip = $_FILES['modelDesks_Wip']['name']; }else{$modelDesks_Wip = $_POST['modelDesks_Wip'];}
if(!empty($modelDesks_after1)){$modelDesks_After = $_FILES['modelDesks_After']['name']; }else{$modelDesks_After = $_POST['modelDesks_After'];}
$modelDesks_issues = $_POST['modelDesks_issues'];
$modelDesks_remarks = $_POST['modelDesks_remarks'];

$date_es7 = str_replace('/', '-', $_POST['cupboard_sdate']);
$cupboard_sdate = date('Y-m-d', strtotime($date_es7));
$date_es8 = str_replace('/', '-', $_POST['cupboard_edate']);
$cupboard_edate = date('Y-m-d',strtotime($date_es8));
$cupboard_progress = $_POST['cupboard_progress'];
$cupboard_units = $_POST['cupboard_units'];
//$cupboard_brefore1 = $_FILES['cupboard_brefore']['name'];
$cupboard_wip1 = $_FILES['cupboard_Wip']['name'];
$cupboard_after1 = $_FILES['cupboard_After']['name'];
// if(!empty($cupboard_brefore1)){ $cupboard_brefore = $_FILES['cupboard_brefore']['name']; }else{ $cupboard_brefore = $_POST['cupboard_brefore'];}
if(!empty($cupboard_wip1)){ $cupboard_Wip = $_FILES['cupboard_Wip']['name']; }else{$cupboard_Wip = $_POST['cupboard_Wip'];}
if(!empty($cupboard_after1)){$cupboard_After = $_FILES['cupboard_After']['name']; }else{$cupboard_After = $_POST['cupboard_After'];}
$cupboard_issues = $_POST['cupboard_issues'];
$cupboard_remarks = $_POST['cupboard_remarks'];

$date_es9 = str_replace('/', '-', $_POST['Solar_sdate']);
$Solar_sdate = date('Y-m-d',strtotime($date_es9));
$date_es10 = str_replace('/', '-', $_POST['Solar_edate']);
$Solar_edate = date('Y-m-d',strtotime($date_es10));
$Solar_progress = $_POST['Solar_progress'];
$Solar_units = $_POST['Solar_units'];
//$flooring_brefore1 = $_FILES['flooring_brefore']['name'];
$flooring_wip1 = $_FILES['Solar_Wip']['name'];
$flooring_after1 = $_FILES['Solar_After']['name'];
// if(!empty($flooring_brefore1)){ $flooring_brefore = $_FILES['flooring_brefore']['name']; }else{ $flooring_brefore = $_POST['flooring_brefore'];}
if(!empty($flooring_wip1)){ $Solar_Wip = $_FILES['Solar_Wip']['name']; }else{$Solar_Wip = $_POST['Solar_Wip'];}
if(!empty($flooring_after1)){$Solar_After = $_FILES['Solar_After']['name']; }else{
  $Solar_After = $_POST['Solar_After'];}
  $Solar_issues = $_POST['Solar_issues'];
  $Solar_remarks = $_POST['Solar_remarks'];


if(!empty($_FILES['EWork_Before']['name'][0])){
  $file_count = count($_FILES['EWork_Before']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stemlabinfrastc_EWork_Before_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stemlabinfrastc_EWork_Before_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stemlabinfrastc_EWork_Before_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["EWork_Before"]["name"][$i]);
      $file_tmp_name    = $_FILES['EWork_Before']['tmp_name'][$i];
      $file_name      = $_FILES['EWork_Before']['name'][$i];
      $file_size      = $_FILES['EWork_Before']['size'][$i];
      $file_type      = $_FILES['EWork_Before']['type'][$i];
      $file_error     = $_FILES['EWork_Before']['error'][$i];
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
          move_uploaded_file($_FILES["EWork_Before"]["tmp_name"][$i],$target_file);

          }
    }
    }
  }

  
 if(!empty($_FILES['EWork_Wip']['name'][0])){
  $file_count = count($_FILES['EWork_Wip']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stemlabinfrastc_EWork_wip_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stemlabinfrastc_EWork_wip_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stemlabinfrastc_EWork_wip_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["EWork_Wip"]["name"][$i]);
      $file_tmp_name    = $_FILES['EWork_Wip']['tmp_name'][$i];
      $file_name      = $_FILES['EWork_Wip']['name'][$i];
      $file_size      = $_FILES['EWork_Wip']['size'][$i];
      $file_type      = $_FILES['EWork_Wip']['type'][$i];
      $file_error     = $_FILES['EWork_Wip']['error'][$i];
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
          move_uploaded_file($_FILES["EWork_Wip"]["tmp_name"][$i],$target_file);

          }
    }
    }
  }

 if(!empty($_FILES['EWork_After']['name'][0])){
  $file_count = count($_FILES['EWork_After']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stemlabinfrastc_EWork_after_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stemlabinfrastc_EWork_after_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stemlabinfrastc_EWork_after_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["EWork_After"]["name"][$i]);
      $file_tmp_name    = $_FILES['EWork_After']['tmp_name'][$i];
      $file_name      = $_FILES['EWork_After']['name'][$i];
      $file_size      = $_FILES['EWork_After']['size'][$i];
      $file_type      = $_FILES['EWork_After']['type'][$i];
      $file_error     = $_FILES['EWork_After']['error'][$i];
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
          move_uploaded_file($_FILES["EWork_After"]["tmp_name"][$i],$target_file);

          }
    }
    }
  }

  if(!empty($_FILES['modelDesks_Before']['name'][0])){
  $file_count = count($_FILES['modelDesks_Before']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stemlabinfrastc_modelDesks_Before_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stemlabinfrastc_modelDesks_Before_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stemlabinfrastc_modelDesks_Before_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["modelDesks_Before"]["name"][$i]);
      $file_tmp_name    = $_FILES['modelDesks_Before']['tmp_name'][$i];
      $file_name      = $_FILES['modelDesks_Before']['name'][$i];
      $file_size      = $_FILES['modelDesks_Before']['size'][$i];
      $file_type      = $_FILES['modelDesks_Before']['type'][$i];
      $file_error     = $_FILES['modelDesks_Before']['error'][$i];
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
          move_uploaded_file($_FILES["modelDesks_Before"]["tmp_name"][$i],$target_file);

          }
    }
    }
  }

  if(!empty($_FILES['modelDesks_Wip']['name'][0])){
  $file_count = count($_FILES['modelDesks_Wip']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stemlabinfrastc_modelDesks_wip_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stemlabinfrastc_modelDesks_wip_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stemlabinfrastc_modelDesks_wip_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["modelDesks_Wip"]["name"][$i]);
      $file_tmp_name    = $_FILES['modelDesks_Wip']['tmp_name'][$i];
      $file_name      = $_FILES['modelDesks_Wip']['name'][$i];
      $file_size      = $_FILES['modelDesks_Wip']['size'][$i];
      $file_type      = $_FILES['modelDesks_Wip']['type'][$i];
      $file_error     = $_FILES['modelDesks_Wip']['error'][$i];
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
          move_uploaded_file($_FILES["modelDesks_Wip"]["tmp_name"][$i],$target_file);

          }
    }
    }
  }

  if(!empty($_FILES['modelDesks_After']['name'][0])){
  $file_count = count($_FILES['modelDesks_After']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stemlabinfrastc_modelDesks_after_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stemlabinfrastc_modelDesks_after_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stemlabinfrastc_modelDesks_after_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["modelDesks_After"]["name"][$i]);
      $file_tmp_name    = $_FILES['modelDesks_After']['tmp_name'][$i];
      $file_name      = $_FILES['modelDesks_After']['name'][$i];
      $file_size      = $_FILES['modelDesks_After']['size'][$i];
      $file_type      = $_FILES['modelDesks_After']['type'][$i];
      $file_error     = $_FILES['modelDesks_After']['error'][$i];
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
          move_uploaded_file($_FILES["modelDesks_After"]["tmp_name"][$i],$target_file);

          }
    }
    }
  }

  if(!empty($_FILES['cupboard_Before']['name'][0])){
  $file_count = count($_FILES['cupboard_Before']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stemlabinfrastc_cupboard_Before_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stemlabinfrastc_cupboard_Before_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stemlabinfrastc_cupboard_Before_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["cupboard_Before"]["name"][$i]);
      $file_tmp_name    = $_FILES['cupboard_Before']['tmp_name'][$i];
      $file_name      = $_FILES['cupboard_Before']['name'][$i];
      $file_size      = $_FILES['cupboard_Before']['size'][$i];
      $file_type      = $_FILES['cupboard_Before']['type'][$i];
      $file_error     = $_FILES['cupboard_Before']['error'][$i];
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
          move_uploaded_file($_FILES["cupboard_Before"]["tmp_name"][$i],$target_file);

          }
    }
    }
  }

  
  if(!empty($_FILES['cupboard_Wip']['name'][0])){
  $file_count = count($_FILES['cupboard_Wip']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stemlabinfrastc_cupboard_wip_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stemlabinfrastc_cupboard_wip_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stemlabinfrastc_cupboard_wip_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["cupboard_Wip"]["name"][$i]);
      $file_tmp_name    = $_FILES['cupboard_Wip']['tmp_name'][$i];
      $file_name      = $_FILES['cupboard_Wip']['name'][$i];
      $file_size      = $_FILES['cupboard_Wip']['size'][$i];
      $file_type      = $_FILES['cupboard_Wip']['type'][$i];
      $file_error     = $_FILES['cupboard_Wip']['error'][$i];
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
          move_uploaded_file($_FILES["cupboard_Wip"]["tmp_name"][$i],$target_file);

          }
    }
    }
  }

  if(!empty($_FILES['cupboard_After']['name'][0])){
  $file_count = count($_FILES['cupboard_After']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stemlabinfrastc_cupboard_after_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stemlabinfrastc_cupboard_after_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stemlabinfrastc_cupboard_after_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["cupboard_After"]["name"][$i]);
      $file_tmp_name    = $_FILES['cupboard_After']['tmp_name'][$i];
      $file_name      = $_FILES['cupboard_After']['name'][$i];
      $file_size      = $_FILES['cupboard_After']['size'][$i];
      $file_type      = $_FILES['cupboard_After']['type'][$i];
      $file_error     = $_FILES['cupboard_After']['error'][$i];
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
          move_uploaded_file($_FILES["cupboard_After"]["tmp_name"][$i],$target_file);

          }
    }
    }
  }


  if(!empty($_FILES['Solar_Before']['name'][0])){
  $file_count = count($_FILES['Solar_Before']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stemlabinfrastc_Solar_Before_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stemlabinfrastc_Solar_Before_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stemlabinfrastc_Solar_Before_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["Solar_Before"]["name"][$i]);
      $file_tmp_name    = $_FILES['Solar_Before']['tmp_name'][$i];
      $file_name      = $_FILES['Solar_Before']['name'][$i];
      $file_size      = $_FILES['Solar_Before']['size'][$i];
      $file_type      = $_FILES['Solar_Before']['type'][$i];
      $file_error     = $_FILES['Solar_Before']['error'][$i];
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
          move_uploaded_file($_FILES["Solar_Before"]["tmp_name"][$i],$target_file);

          }
    }
    }
  }

  

  if(!empty($_FILES['Solar_Wip']['name'][0])){
  $file_count = count($_FILES['Solar_Wip']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stemlabinfrastc_Solar_Wip_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stemlabinfrastc_Solar_Wip_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stemlabinfrastc_Solar_Wip_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["Solar_Wip"]["name"][$i]);
      $file_tmp_name    = $_FILES['Solar_Wip']['tmp_name'][$i];
      $file_name      = $_FILES['Solar_Wip']['name'][$i];
      $file_size      = $_FILES['Solar_Wip']['size'][$i];
      $file_type      = $_FILES['Solar_Wip']['type'][$i];
      $file_error     = $_FILES['Solar_Wip']['error'][$i];
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
          move_uploaded_file($_FILES["Solar_Wip"]["tmp_name"][$i],$target_file);

          }
    }
    }
  }

  if(!empty($_FILES['Solar_After']['name'][0])){
  $file_count = count($_FILES['Solar_After']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/stemlabinfrastc_Solar_After_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/stemlabinfrastc_Solar_After_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/stemlabinfrastc_Solar_After_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["Solar_After"]["name"][$i]);
      $file_tmp_name    = $_FILES['Solar_After']['tmp_name'][$i];
      $file_name      = $_FILES['Solar_After']['name'][$i];
      $file_size      = $_FILES['Solar_After']['size'][$i];
      $file_type      = $_FILES['Solar_After']['type'][$i];
      $file_error     = $_FILES['Solar_After']['error'][$i];
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
          move_uploaded_file($_FILES["Solar_After"]["tmp_name"][$i],$target_file);

          }
    }
    }
  }


if($_POST['action']=='add'){
    $sql5 = "INSERT INTO stemlabinfrastc(projectid, schoolid, user_id, EWork_sdate, EWork_edate, EWork_progress, EWork_units, EWork_Wip, EWork_After,EWork_issues,EWork_remarks,modelDesks_sdate,modelDesks_edate,modelDesks_progress,modelDesks_units,modelDesks_Wip,modelDesks_After,modelDesks_issues,modelDesks_remarks,cupboard_sdate,cupboard_edate,cupboard_progress,cupboard_units,cupboard_Wip,cupboard_After,cupboard_issues,cupboard_remarks,Solar_sdate,Solar_edate,Solar_progress,Solar_units,Solar_Wip,Solar_After,Solar_issues,Solar_remarks, EWork_Before, modelDesks_Before, cupboard_Before, Solar_Before)
            VALUES('$projectid','$schoolid','$user_id','$EWork_sdate', '$EWork_edate', '$EWork_progress', '$EWork_units',  '$EWork_Wip', '$EWork_After','$EWork_issues','$EWork_remarks','$modelDesks_sdate','$modelDesks_edate','$modelDesks_progress','$modelDesks_units','$modelDesks_Wip','$modelDesks_After','$modelDesks_issues','$modelDesks_remarks','$cupboard_sdate','$cupboard_edate','$cupboard_progress','$cupboard_units','$cupboard_Wip','$cupboard_After','$cupboard_issues','$cupboard_remarks','$Solar_sdate','$Solar_edate','$Solar_progress','$Solar_units','$Solar_Wip','$Solar_After','$Solar_issues','$Solar_remarks','$EWork_Before','$modelDesks_Before','$cupboard_Before','$Solar_Before')";

  $res =   mysqli_query($con, $sql5);
header('Location: dashboard.php?pid='.$_SESSION['projectid']);
}elseif($_POST['action']=='update'){
$sql8 = "UPDATE stemlabinfrastc ". "SET projectid = '$projectid', EWork_sdate = '$EWork_sdate', EWork_edate = '$EWork_edate',EWork_progress = '$EWork_progress',EWork_units = '$EWork_units',EWork_wip = '$EWork_wip',EWork_After = '$EWork_After',EWork_issues = '$EWork_issues',EWork_remarks = '$EWork_remarks',modelDesks_sdate = '$modelDesks_sdate',modelDesks_edate = '$modelDesks_edate',modelDesks_progress = '$modelDesks_progress',modelDesks_units = '$modelDesks_units',modelDesks_Wip = '$modelDesks_Wip',modelDesks_After = '$modelDesks_After',modelDesks_issues = '$modelDesks_issues',modelDesks_remarks = '$modelDesks_remarks',cupboard_sdate = '$cupboard_sdate',cupboard_edate = '$cupboard_edate',cupboard_progress = '$cupboard_progress',cupboard_units = '$cupboard_units',cupboard_Wip = '$cupboard_Wip',cupboard_After = '$cupboard_After',cupboard_issues = '$cupboard_issues',cupboard_remarks = '$cupboard_remarks',Solar_sdate = '$Solar_sdate',Solar_edate = '$Solar_edate',Solar_progress = '$Solar_progress',Solar_units = '$Solar_units',Solar_Wip = '$Solar_Wip',Solar_After = '$Solar_After',Solar_issues = '$Solar_issues',Solar_remarks = '$Solar_remarks' ,EWork_Before = '$EWork_Before' ,modelDesks_Before = '$modelDesks_Before' ,cupboard_Before = '$cupboard_Before' ,Solar_Before = '$Solar_Before' ". 
               "WHERE schoolid = '$schoolid'";

$retval = mysqli_query($con, $sql8);
header('Location: dashboard.php?pid='.$_SESSION['projectid']);
}else{
  echo "string";
}

}else{
    echo "No data sent";
  }
?>
