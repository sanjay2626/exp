<?php
  require("connection.php"); //the connection
  require('check_login.php');

  if(!empty($_POST || $_FILES)){



$user_id = $_SESSION['exp_dash_id'];

if(!empty($_POST['EWork_sdate'])){
$date_es = str_replace('/', '-', $_POST['EWork_sdate']);
$EWork_sdate = "'".date('Y-m-d',strtotime($date_es))."'";
// $EWork_sdate1 = "'".$EWork_sdate."'";
}else{
$EWork_sdate = 'NULL';
}

if(!empty($_POST['EWork_edate'])){
$date_es2 = str_replace('/', '-', $_POST['EWork_edate']);
$EWork_edate = "'".date('Y-m-d',strtotime($date_es2))."'";
}else{
$EWork_edate = 'NULL';
}

// $date_es = str_replace('/', '-', $_POST['EWork_sdate']);
// $EWork_sdate = date('Y-m-d', strtotime($date_es));

// $date_es2 = str_replace('/', '-', $_POST['EWork_edate']);
// $EWork_edate = date('Y-m-d', strtotime($date_es2));

$EWork_progress = $_POST['EWork_progress'];
$EWork_units = $_POST['EWork_units'];
$schoolid = $_POST['schoolid'];
$projectid = $_POST['projectid'];
$EWork_brefore1 = $_FILES['EWork_brefore']['name'];
 if(!empty($EWork_brefore1)){ $EWork_brefore = $_FILES['EWork_brefore']['name']; }else{ $EWork_brefore = $_POST['EWork_brefore'];}
$EWork_remarks = $_POST['EWork_remarks'];

// $date_es3 = str_replace('/', '-', $_POST['painting_sdate']);
// $painting_sdate = date('Y-m-d', strtotime($date_es3));
// $date_es4 = str_replace('/', '-', $_POST['painting_edate']);
// $painting_edate = date('Y-m-d', strtotime($date_es4));

if(!empty($_POST['painting_sdate'])){
$date_es3 = str_replace('/', '-', $_POST['painting_sdate']);
$painting_sdate = "'".date('Y-m-d',strtotime($date_es3))."'";
}else{
$painting_sdate = 'NULL';
}

if(!empty($_POST['painting_edate'])){
$date_es4 = str_replace('/', '-', $_POST['painting_edate']);
$painting_edate = "'".date('Y-m-d',strtotime($date_es4))."'";
}else{
$painting_edate = 'NULL';
}


$painting_progress = $_POST['painting_progress'];
$painting_units = $_POST['painting_units'];
$painting_brefore1 = $_FILES['painting_brefore']['name'];
 if(!empty($painting_brefore1)){ $painting_brefore = $_FILES['painting_brefore']['name']; }else{ $painting_brefore = $_POST['painting_brefore'];}
$painting_remarks = $_POST['painting_remarks'];


// $date_es5 = str_replace('/', '-', $_POST['modelDesks_sdate']);
// $modelDesks_sdate = date('Y-m-d', strtotime($date_es5));
// $date_es6 = str_replace('/', '-', $_POST['modelDesks_edate']);
// $modelDesks_edate = date('Y-m-d', strtotime($date_es6));

if(!empty($_POST['modelDesks_sdate'])){
$date_es5 = str_replace('/', '-', $_POST['modelDesks_sdate']);
$modelDesks_sdate = "'".date('Y-m-d',strtotime($date_es5))."'";
}else{
$modelDesks_sdate = 'NULL';
}

if(!empty($_POST['modelDesks_edate'])){
$date_es6 = str_replace('/', '-', $_POST['modelDesks_edate']);
$modelDesks_edate = "'".date('Y-m-d',strtotime($date_es6))."'";
}else{
$modelDesks_edate = 'NULL';
}

$modelDesks_progress = $_POST['modelDesks_progress'];
$modelDesks_units = $_POST['modelDesks_units'];
$modelDesks_brefore1 = $_FILES['modelDesks_brefore']['name'];
if(!empty($modelDesks_brefore1)){ $modelDesks_brefore = $_FILES['modelDesks_brefore']['name']; }else{ $modelDesks_brefore = $_POST['modelDesks_brefore'];}
$modelDesks_remarks = $_POST['modelDesks_remarks'];



// $date_es7 = str_replace('/', '-', $_POST['cupboard_sdate']);
// $cupboard_sdate = date('Y-m-d', strtotime($date_es7));
// $date_es8 = str_replace('/', '-', $_POST['cupboard_sdate']);
// $cupboard_edate = date('Y-m-d',strtotime($date_es8));


if(!empty($_POST['cupboard_sdate'])){
$date_es7 = str_replace('/', '-', $_POST['cupboard_sdate']);
$cupboard_sdate = "'".date('Y-m-d',strtotime($date_es7))."'";
}else{
$cupboard_sdate = 'NULL';
}

if(!empty($_POST['cupboard_edate'])){
$date_es8 = str_replace('/', '-', $_POST['cupboard_edate']);
$cupboard_edate = "'".date('Y-m-d',strtotime($date_es8))."'";
}else{
$cupboard_edate = 'NULL';
}

$cupboard_progress = $_POST['cupboard_progress'];
$cupboard_units = $_POST['cupboard_units'];
$cupboard_brefore1 = $_FILES['cupboard_brefore']['name'];
if(!empty($cupboard_brefore1)){ $cupboard_brefore = $_FILES['cupboard_brefore']['name']; }else{ $cupboard_brefore = $_POST['cupboard_brefore'];}
$cupboard_remarks = $_POST['cupboard_remarks'];


// $date_es9 = str_replace('/', '-', $_POST['flooring_sdate']);
// $flooring_sdate = date('Y-m-d',strtotime($date_es9));
// $date_es10 = str_replace('/', '-', $_POST['flooring_edate']);
// $flooring_edate = date('Y-m-d',strtotime($date_es10));

if(!empty($_POST['flooring_sdate'])){
$date_es9 = str_replace('/', '-', $_POST['flooring_sdate']);
$flooring_sdate = "'".date('Y-m-d',strtotime($date_es9))."'";
}else{
$flooring_sdate = 'NULL';
}

if(!empty($_POST['flooring_edate'])){
$date_es10 = str_replace('/', '-', $_POST['flooring_edate']);
$flooring_edate = "'".date('Y-m-d',strtotime($date_es10))."'";
}else{
$flooring_edate = 'NULL';
}


$flooring_progress = $_POST['flooring_progress'];
$flooring_units = $_POST['flooring_units'];
$flooring_brefore1 = $_FILES['flooring_brefore']['name'];
if(!empty($flooring_brefore1)){ $flooring_brefore = $_FILES['flooring_brefore']['name']; }else{ $flooring_brefore = $_POST['flooring_brefore'];}
  $flooring_remarks = $_POST['flooring_remarks'];


//   $date_es11 = str_replace('/', '-', $_POST['Solar_sdate']);
// $Solar_sdate = date('Y-m-d',strtotime($date_es11));
// $date_es12 = str_replace('/', '-', $_POST['Solar_edate']);
// $Solar_edate = date('Y-m-d',strtotime($date_es12));

  if(!empty($_POST['Solar_sdate'])){
$date_es91 = str_replace('/', '-', $_POST['Solar_sdate']);
$Solar_sdate = "'".date('Y-m-d',strtotime($date_es91))."'";
}else{
$Solar_sdate = 'NULL';
}

if(!empty($_POST['Solar_edate'])){
$date_es101 = str_replace('/', '-', $_POST['Solar_edate']);
$Solar_edate = "'".date('Y-m-d',strtotime($date_es101))."'";
}else{
$Solar_edate = 'NULL';
}

$Solar_progress = $_POST['Solar_progress'];
$Solar_units = $_POST['Solar_units'];
$Solar_brefore1 = $_FILES['Solar_brefore']['name'];
if(!empty($Solar_brefore1)){ $flooring_brefore = $_FILES['Solar_brefore']['name']; }else{ $flooring_brefore = $_POST['Solar_brefore'];}
  $Solar_remarks = $_POST['Solar_remarks'];


  if(!empty($_FILES['EWork_brefore']['name'][0])){
  $file_count = count($_FILES['EWork_brefore']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/StemInfraMaterialDelivery_EWork_brefore_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/StemInfraMaterialDelivery_EWork_brefore_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/StemInfraMaterialDelivery_EWork_brefore_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["EWork_brefore"]["name"][$i]);
      $file_tmp_name    = $_FILES['EWork_brefore']['tmp_name'][$i];
      $file_name      = $_FILES['EWork_brefore']['name'][$i];
      $file_size      = $_FILES['EWork_brefore']['size'][$i];
      $file_type      = $_FILES['EWork_brefore']['type'][$i];
      $file_error     = $_FILES['EWork_brefore']['error'][$i];
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      $allowed_extension = array('png','gif','jpeg','jpg', 'jfif', 'jfif');
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
          move_uploaded_file($_FILES["EWork_brefore"]["tmp_name"][$i],$target_file);

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
    if(!file_exists('uploads/'.$user_id.'/StemInfraMaterialDelivery_painting_brefore_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/StemInfraMaterialDelivery_painting_brefore_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/StemInfraMaterialDelivery_painting_brefore_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["painting_brefore"]["name"][$i]);
      $file_tmp_name    = $_FILES['painting_brefore']['tmp_name'][$i];
      $file_name      = $_FILES['painting_brefore']['name'][$i];
      $file_size      = $_FILES['painting_brefore']['size'][$i];
      $file_type      = $_FILES['painting_brefore']['type'][$i];
      $file_error     = $_FILES['painting_brefore']['error'][$i];
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      $allowed_extension = array('png','gif','jpeg','jpg', 'jfif', 'jfif');
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
          move_uploaded_file($_FILES["painting_brefore"]["tmp_name"][$i],$target_file);

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
    if(!file_exists('uploads/'.$user_id.'/StemInfraMaterialDelivery_modelDesks_brefore_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/StemInfraMaterialDelivery_modelDesks_brefore_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/StemInfraMaterialDelivery_modelDesks_brefore_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["modelDesks_brefore"]["name"][$i]);
      $file_tmp_name    = $_FILES['modelDesks_brefore']['tmp_name'][$i];
      $file_name      = $_FILES['modelDesks_brefore']['name'][$i];
      $file_size      = $_FILES['modelDesks_brefore']['size'][$i];
      $file_type      = $_FILES['modelDesks_brefore']['type'][$i];
      $file_error     = $_FILES['modelDesks_brefore']['error'][$i];
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      $allowed_extension = array('png','gif','jpeg','jpg', 'jfif', 'jfif');
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
          move_uploaded_file($_FILES["modelDesks_brefore"]["tmp_name"][$i],$target_file);

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
    if(!file_exists('uploads/'.$user_id.'/StemInfraMaterialDelivery_cupboard_brefore_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/StemInfraMaterialDelivery_cupboard_brefore_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/StemInfraMaterialDelivery_cupboard_brefore_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["cupboard_brefore"]["name"][$i]);
      $file_tmp_name    = $_FILES['cupboard_brefore']['tmp_name'][$i];
      $file_name      = $_FILES['cupboard_brefore']['name'][$i];
      $file_size      = $_FILES['cupboard_brefore']['size'][$i];
      $file_type      = $_FILES['cupboard_brefore']['type'][$i];
      $file_error     = $_FILES['cupboard_brefore']['error'][$i];
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      $allowed_extension = array('png','gif','jpeg','jpg', 'jfif', 'jfif');
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
          move_uploaded_file($_FILES["cupboard_brefore"]["tmp_name"][$i],$target_file);

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
    if(!file_exists('uploads/'.$user_id.'/StemInfraMaterialDelivery_flooring_brefore_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/StemInfraMaterialDelivery_flooring_brefore_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/StemInfraMaterialDelivery_flooring_brefore_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["flooring_brefore"]["name"][$i]);
      $file_tmp_name    = $_FILES['flooring_brefore']['tmp_name'][$i];
      $file_name      = $_FILES['flooring_brefore']['name'][$i];
      $file_size      = $_FILES['flooring_brefore']['size'][$i];
      $file_type      = $_FILES['flooring_brefore']['type'][$i];
      $file_error     = $_FILES['flooring_brefore']['error'][$i];
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      $allowed_extension = array('png','gif','jpeg','jpg', 'jfif', 'jfif');
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
          move_uploaded_file($_FILES["flooring_brefore"]["tmp_name"][$i],$target_file);

          }
    }
    }
  }


  if(!empty($_FILES['Solar_brefore']['name'][0])){
  $file_count = count($_FILES['Solar_brefore']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/StemInfraMaterialDelivery_Solar_brefore_'.$schoolid)){
      mkdir('uploads/'.$user_id.'/StemInfraMaterialDelivery_Solar_brefore_'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/StemInfraMaterialDelivery_Solar_brefore_'.$schoolid."/";


    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["Solar_brefore"]["name"][$i]);
      $file_tmp_name    = $_FILES['Solar_brefore']['tmp_name'][$i];
      $file_name      = $_FILES['Solar_brefore']['name'][$i];
      $file_size      = $_FILES['Solar_brefore']['size'][$i];
      $file_type      = $_FILES['Solar_brefore']['type'][$i];
      $file_error     = $_FILES['Solar_brefore']['error'][$i];
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      $allowed_extension = array('png','gif','jpeg','jpg', 'jfif', 'jfif');
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
          move_uploaded_file($_FILES["Solar_brefore"]["tmp_name"][$i],$target_file);

          }
    }
    }
  }


if($_POST['action']=='add'){

    $sql5 = "INSERT INTO steminframaterialdelivery (projectid, schoolid, user_id, EWork_sdate, EWork_edate, EWork_progress, EWork_units, EWork_brefore,EWork_remarks, painting_sdate,painting_edate,painting_progress,painting_units,painting_brefore,painting_remarks, modelDesks_sdate,modelDesks_edate,modelDesks_progress,modelDesks_units,modelDesks_brefore,modelDesks_remarks,cupboard_sdate,cupboard_edate,cupboard_progress,cupboard_units,cupboard_brefore,cupboard_remarks,flooring_sdate,flooring_edate,flooring_progress,flooring_units,flooring_brefore,flooring_remarks,Solar_sdate,Solar_edate,Solar_progress,Solar_units, Solar_brefore,Solar_remarks)
            VALUES('$projectid','$schoolid','$user_id',$EWork_sdate, $EWork_edate, '$EWork_progress', '$EWork_units',  '$EWork_brefore', '$EWork_remarks',$painting_sdate,$painting_edate,'$painting_progress','$painting_units', '$painting_brefore','$painting_remarks',$modelDesks_sdate,$modelDesks_edate,'$modelDesks_progress','$modelDesks_units','$modelDesks_brefore','$modelDesks_remarks',$cupboard_sdate,$cupboard_edate,'$cupboard_progress','$cupboard_units','$cupboard_brefore','$cupboard_remarks',$flooring_sdate,$flooring_edate,'$flooring_progress','$flooring_units','$flooring_brefore','$flooring_remarks' ,$Solar_sdate ,$Solar_edate ,'$Solar_progress' ,'$Solar_units' ,'$Solar_brefore' ,'$Solar_remarks')";
            //print_r($sql5); exit;
  $res =   mysqli_query($con, $sql5);
header('Location: dashboard.php?pid='.$_SESSION['projectid']);
}elseif($_POST['action']=='update'){
  
$sql8 = "UPDATE steminframaterialdelivery ". "SET projectid = '$projectid', EWork_sdate = $EWork_sdate, EWork_edate = $EWork_edate,EWork_progress = '$EWork_progress',EWork_units = '$EWork_units',EWork_brefore = '$EWork_brefore',EWork_remarks = '$EWork_remarks', painting_sdate = $painting_sdate,painting_edate = $painting_edate,painting_progress = '$painting_progress',painting_units = '$painting_units',painting_brefore = '$painting_brefore',painting_remarks = '$painting_remarks',modelDesks_sdate = $modelDesks_sdate,modelDesks_edate = $modelDesks_edate,modelDesks_progress = '$modelDesks_progress',modelDesks_units = '$modelDesks_units',modelDesks_brefore = '$modelDesks_brefore',modelDesks_remarks = '$modelDesks_remarks',cupboard_sdate = $cupboard_sdate,cupboard_edate = $cupboard_edate,cupboard_progress = '$cupboard_progress',cupboard_units = '$cupboard_units',cupboard_brefore = '$cupboard_brefore',cupboard_remarks = '$cupboard_remarks',flooring_sdate = $flooring_sdate,flooring_edate = $flooring_edate,flooring_progress = '$flooring_progress',flooring_units = '$flooring_units',flooring_brefore = '$flooring_brefore',flooring_remarks = '$flooring_remarks' ,Solar_sdate = $Solar_sdate ,Solar_edate = $Solar_edate ,Solar_units = '$Solar_units' ,Solar_brefore = '$Solar_brefore' , Solar_progress = '$Solar_progress' , Solar_remarks = '$Solar_remarks' ". 
               "WHERE schoolid = '$schoolid'" ;

//print_r($sql8); exit;
$retval = mysqli_query($con, $sql8);
header('Location: dashboard.php?pid='.$_SESSION['projectid']);
}else{
  echo "string";
}

}else{
    echo "No data sent";
  }
?>
