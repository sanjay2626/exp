<?php
  require("connection.php"); //the connection
  require('check_login.php');


 if(!empty($_POST || $_FILES)){
$user_id = $_SESSION['exp_dash_id'];

if(!empty($_POST['StemImpactDate'])){
$date_es11 = str_replace('/', '-', $_POST['StemImpactDate']);
$science_sdate = date('Y-m-d',strtotime($date_es11));
}else{
$science_sdate = '';
}
$schoolid = $_POST['schoolid'];
$projectid = $_POST['projectid'];
$science_wip1 = $_FILES['StemImpactName']['name'];
if(!empty($science_wip1)){ $science_wip = $_FILES['StemImpactName']['name']; }else{$science_wip = $_POST['science_wip'];}


 if(!empty($_FILES['StemImpactName']['name'][0])){
  $file_count = count($_FILES['StemImpactName']['name']);
  if($file_count>0){
    if(!file_exists('uploads/'.$user_id)){
      mkdir('uploads/'.$user_id, 0777, true);
    }
    if(!file_exists('uploads/'.$user_id.'/StemImpact'.$schoolid)){
      mkdir('uploads/'.$user_id.'/StemImpact'.$schoolid, 0777, true);
    }
    $target_dir = 'uploads/'.$user_id.'/StemImpact'.$schoolid."/";

   
    for ($i = 0; $i < $file_count; $i++)
    {
      $target_file = $target_dir."_".$i."_".basename($_FILES["StemImpactName"]["name"][$i]);
      $file_tmp_name    = $_FILES['StemImpactName']['tmp_name'][$i];
      $file_name      = $_FILES['StemImpactName']['name'][$i];
      $file_size      = $_FILES['StemImpactName']['size'][$i];
      $file_type      = $_FILES['StemImpactName']['type'][$i];
      $file_error     = $_FILES['StemImpactName']['error'][$i];
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
          move_uploaded_file($_FILES["StemImpactName"]["tmp_name"][$i],$target_file);

          }
    }
    }
  }


if($_POST['action']=='add'){
    $sql5 = "INSERT INTO stemimpactassessment(projectid, schoolid,user_id, StemImpactDate)
            VALUES('$projectid','$schoolid','$user_id','$science_sdate')";

  $res =   mysqli_query($con, $sql5);

header('Location: dashboard.php?pid='.$_SESSION['projectid']);
}elseif($_POST['action']=='update'){


  if($science_sdate ==''){
$sql8 = "UPDATE stemimpactassessment ". "SET projectid = '$projectid', StemImpactDate = NULL". 
               " WHERE schoolid = '$schoolid'" ;
  }else{
    $sql8 = "UPDATE stemimpactassessment ". "SET projectid = '$projectid', StemImpactDate = '$science_sdate'". 
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
