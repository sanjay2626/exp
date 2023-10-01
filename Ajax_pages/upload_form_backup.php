<?php
include_once("../connection.php");
function x($data){
  global $con;
  return mysqli_real_escape_string($con,(trim($data)));
}

if(!isset($_SESSION['exp_dash_id']) || empty($_SESSION['exp_dash_id'])){
	die("Something went wrong! Please try later..");
}

 if(!empty($_POST)){
  $id_exploded = explode("_",$_POST['id']);
  $insert_query= "INSERT INTO session_completed set session_date='".x($_POST['s_date'])."',
  school_id=".$id_exploded[5].",
  session_user_id='".$_SESSION['exp_dash_id']."',
  program=".$id_exploded[1].",
  session_type='".$_POST['session']."',
  project_id='".$id_exploded[2]."',
  board_id='".$id_exploded[3]."',
  language_id='".$id_exploded[4]."',
  from_time='".x($_POST['from_time'])."',
  to_time='".x($_POST['to_time'])."',
  grade=".x($_POST['grade']).",
  section='".x($_POST['section'])."',
  module_id=".$id_exploded[6].",
  topic_chapter='".x($_POST['topic'])."',
  activity='".x($_POST['activity'])."',
  batch_size=".x($_POST['batch_size']).",
  student_count=".x($_POST['student_count']).",
  rate=".x($_POST['rate']).",
  session_summary='".x($_POST['summary'])."'
  ";
  if(!empty($_POST['issues'])){
    $insert_query.=",issues='".$_POST['issues']."'";
  }
// file upload initialize
    if(!empty($_FILES)){
    //compress function
    function compress_image($source_url, $destination_url, $quality) {

      $info = getimagesize($source_url);

          if ($info['mime'] == 'image/jpeg')
          $image = imagecreatefromjpeg($source_url);

          elseif ($info['mime'] == 'image/gif')
          $image = imagecreatefromgif($source_url);

          elseif ($info['mime'] == 'image/png')
          $image = imagecreatefrompng($source_url);

          imagejpeg($image, $destination_url, $quality);
          return $destination_url;
        }
      //compress function

  $file_count = count($_FILES['files']['name']);
  if($file_count>0){
    $session_id_query = "SELECT max(sno) from session_completed";
    $session_row = mysqli_fetch_row(mysqli_query($con,$session_id_query));
    if(!isset($session_row)){
      die(mysqli_error($con));
    }
    $session_id = $session_row[0]+1;
    if(!file_exists('../uploads/user_'.$_SESSION['exp_dash_id'])){
      mkdir('../uploads/user_'.$_SESSION['exp_dash_id'], 0777, true);
    }
    $target_dir = "../uploads/user_".$_SESSION['exp_dash_id']."/";
    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file= $target_dir.$session_id."_".$i."_".basename($_FILES["files"]["name"][$i]);
      $file_tmp_name 	  = $_FILES['files']['tmp_name'][$i];
      $file_name 		  = $_FILES['files']['name'][$i];
      $file_size 		  = $_FILES['files']['size'][$i];
      $file_type 		  = $_FILES['files']['type'][$i];
      $file_error 	  = $_FILES['files']['error'][$i];
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      $allowed_extension = array('avi','mov','wmv','mp4','webm','flv','png','gif','jpeg','jpg');
      
      if(!in_array(strtolower($imageFileType),$allowed_extension)){
        $output = "file extension error";
        die($output);
      }
       elseif(in_array(strtolower($imageFileType),['png','gif','jpeg','jpg'])){
      	 if(filesize($_FILES['files']['tmp_name'][$i])<2000000){
        	$d = compress_image($_FILES['files']['tmp_name'][$i], $target_file, 80);
          }else{
                $d = compress_image($_FILES['files']['tmp_name'][$i], $target_file, 65);
          }
      
      }
      else{
        if(!move_uploaded_file($_FILES["files"]["tmp_name"][$i], $target_file)){
        die("file upload error");
       }
      }
    }
  }
  // file upload
  }
  if(!mysqli_query($con,$insert_query)){
    echo mysqli_error($con);
  }else{
    echo "success";
  }

 }else{
   echo "no";
 }
?>
