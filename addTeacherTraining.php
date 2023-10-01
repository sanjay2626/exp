<?php
  require("connection.php"); //the connection
  require('check_login.php');


  if(!empty($_POST || $_FILES)){
$user_id = $_SESSION['exp_dash_id'];


if(!empty($_POST['teacherTrainingDate'])){
$date_es11 = str_replace('/', '-', $_POST['teacherTrainingDate']);
$science_sdate = date('Y-m-d',strtotime($date_es11));
}else{
$science_sdate = '';
}

if(!empty($_POST['teacherTraining_eDate'])){
$date_es12 = str_replace('/', '-', $_POST['teacherTraining_eDate']);
$science_edate = date('Y-m-d',strtotime($date_es12));
}else{
$science_edate = '';
}



$schoolid = $_POST['schoolid'];
$projectid = $_POST['projectid'];
$science_wip1 = $_FILES['teacherTrainingName']['name'];
if(!empty($science_wip1)){ $science_wip = $_FILES['teacherTrainingName']['name']; }else{$science_wip = $_POST['science_wip'];}


 if(!empty($_FILES['teacherTrainingName']['name'][0])){
  $file_count = count($_FILES['teacherTrainingName']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/teacherTraining'.$schoolid)){
      mkdir('uploads/'.$user_id.'/teacherTraining'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/teacherTraining'.$schoolid."/";

   
    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["teacherTrainingName"]["name"][$i]);
      $file_tmp_name    = $_FILES['teacherTrainingName']['tmp_name'][$i];
      $file_name      = $_FILES['teacherTrainingName']['name'][$i];
      $file_size      = $_FILES['teacherTrainingName']['size'][$i];
      $file_type      = $_FILES['teacherTrainingName']['type'][$i];
      $file_error     = $_FILES['teacherTrainingName']['error'][$i];
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
          move_uploaded_file($_FILES["teacherTrainingName"]["tmp_name"][$i],$target_file);

          }
    }
    }
  }


if($_POST['action']=='add'){
    $sql5 = "INSERT INTO teachertraining(projectid, schoolid,user_id, teacherTrainingDate, teacherTraining_eDate)
            VALUES('$projectid','$schoolid','$user_id','$science_sdate' ,'$science_edate')";

  $res =   mysqli_query($con, $sql5);

header('Location: dashboard.php?pid='.$_SESSION['projectid']);
}elseif($_POST['action']=='update'){

  if($science_sdate ==''){
$sql8 = "UPDATE teachertraining ". "SET projectid = '$projectid', teacherTrainingDate = NULL , teacherTraining_eDate = NULL". 
               " WHERE schoolid = '$schoolid'" ;
  }else{
   $sql8 = "UPDATE teachertraining ". "SET projectid = '$projectid', teacherTrainingDate = '$science_sdate' , teacherTraining_eDate = '$science_edate'". 
               " WHERE schoolid = '$schoolid'" ;
  }



$retval = mysqli_query($con, $sql8);
header('Location: dashboard.php?pid='.$_SESSION['projectid']);
}else{
  echo "string";
}

}else{
    echo "No data sent";
     }
?>
