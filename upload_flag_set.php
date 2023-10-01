<?php require("connection.php");
$users = scandir("uploads");
$list = [];
for($i=2;$i<sizeof($users);$i++) {
  $folder_array = scandir("uploads/".$users[$i]);
  foreach($folder_array as $file){
    if(!is_dir($file)){
      $list[explode("_",$file)[0]]=1;
    }
  }
}
$list = array_keys($list);
$list = implode(",",$list);
$query = "UPDATE session_completed set upload_flag=1 where sno in($list)";
mysqli_query($con,$query) or die(mysqli_error($con));
//$res = mysqli_query("UPDATE session_completed set upload_flag=1 where sno in");
?>
