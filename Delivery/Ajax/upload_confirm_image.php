<?php
require '../../connection.php';
ini_set("gd.jpeg_ignore_warning", 1);
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
if(isset($_POST)){
    $delivery_id = mysqli_real_escape_string($con,$_POST['del_id']);
    $target_dir = "../confirmed_receipts/";
    $target_file= $target_dir.$delivery_id.".".pathinfo($_FILES['files']['name'],PATHINFO_EXTENSION);
    $file_tmp_name 	  = $_FILES['files']['tmp_name'];
    $file_name 		  = $_FILES['files']['name'];
    $file_size 		  = $_FILES['files']['size'];
    $file_type 		  = $_FILES['files']['type'];
    $file_error 	  = $_FILES['files']['error'];
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $allowed_extension = array('png','jpeg','jpg');

    if(!in_array(strtolower($imageFileType),$allowed_extension)){
      $output = "file extension error";
      die($output);
    }
    else{
      include_once 'compressor.php';
      $target = $file_tmp_name;
      $resized_file = $target_file;
      $wmax = 1024;
      $hmax = 768;
      compressor($target, $resized_file, $wmax, $hmax, $imageFileType);
      mysqli_query($con,"UPDATE delivery_status set signed_receipt='{$target_file}',status=1,
        received_by='{$_SESSION['exp_dellivery_user_id']}',receiving_date ='{$date}'
        where delivery_id='{$delivery_id}'") or die(mysqli_error($con));
      echo "Success";
    }

  }else{
    echo "Error: No data sent!";
  }


?>
