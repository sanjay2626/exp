<?php
require("../connection.php");
ini_set('memory_limit','-1');
function x($data){
  global $con;
  return mysqli_real_escape_string($con,(trim($data)));
}
$upload_flag = 0;
//file upload funtion
function file_upload(){
    global $con;
    global $upload_flag;
    if(!empty($_FILES['files']['name'][0])){

      $upload_flag = 1;
      //die("yes");
    //compress function

  $file_count = count($_FILES['files']['name']);
  if($file_count>0){
  if(!isset($_POST['update'])){
      $session_id_query = "SELECT max(sno) from session_completed";
      $session_row = mysqli_fetch_row(mysqli_query($con,$session_id_query));
      if(!isset($session_row)){
        die(mysqli_error($con));
      }
      $session_id = $session_row[0]+1;
    }else{$session_id=$_POST['id'];}

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
      $allowed_extension = array('png','gif','jpeg','jpg');

      if(!in_array(strtolower($imageFileType),$allowed_extension)){
        $output = "file extension error";
        die($output);
      }
      else{
        include_once("compressor.php");
        $target = $file_tmp_name;
        $resized_file = $target_file;
        $wmax = 1024;
        $hmax = 768;
        compressor($target, $resized_file, $wmax, $hmax, $imageFileType);
      }
    }
  }
  // file upload
  }
}

if(!isset($_SESSION['exp_dash_id']) || empty($_SESSION['exp_dash_id'])){
	die("Something went wrong! Please try later..");
}else{


}

 if(!empty($_POST)){
  if(!isset($_POST['update'])){
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
    $insert_query.=",issues='".x($_POST['issues'])."'";
  }
// file upload initialize
    file_upload();
    // inserting upload statement later since fileupload function updates upload_flag to 1 if filesa re uploades
    $insert_query.=",upload_flag=".$upload_flag;
    if(!mysqli_query($con,$insert_query)){
       die(mysqli_error($con));
    }else{
      echo "success";
    }
  }else{ // update
    //die(print_r($_POST)."\n".print_r($_FILES)); uncomment for debug
    $update_query="UPDATE session_completed set session_date='".x($_POST['s_date'])."',
    school_id=".x($_POST['school']).",
    program=".x($_POST['program']).",
    session_type='".x($_POST['session_type'])."',
    project_id='".x($_POST['project'])."',
    board_id='".x($_POST['board'])."',
    language_id='".x($_POST['language'])."',
    from_time='".x($_POST['from_time'])."',
    to_time='".x($_POST['to_time'])."',
    grade=".x($_POST['grade']).",
    section='".x($_POST['section'])."',
    module_id=".x($_POST['module']).",
    topic_chapter='".x($_POST['topic'])."',
    activity='".x($_POST['activity'])."',
    batch_size=".x($_POST['batch_size']).",
    student_count=".x($_POST['student_count']).",
    rate=".x($_POST['rate']).",
    session_summary='".x($_POST['summary'])."'";
    if(!empty($_POST['issues'])){
      $update_query.=",issues='".x($_POST['issues'])."'";
    }
  // file upload initialize
      file_upload();
      //checking for number of uploads for session
      if(sizeof(glob("../uploads/user_".$_SESSION['exp_dash_id']."/".$_POST['id']."_*"))>0){
        $upload_flag=1;
      }
      $update_query.=",upload_flag=".$upload_flag;
      $update_query.=" where sno=".$_POST['id'];
      if(!mysqli_query($con,$update_query)){
         die(mysqli_error($con));
      }else{
        echo "success";
      }
    }
 }else{ // no data
   echo "no data";
 }
?>
