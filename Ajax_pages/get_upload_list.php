<?php
  require("../connection.php");
  if(!isset($_GET)){
    die("Error");
  }else{
    $verify = mysqli_query($con,"SELECT session_user_id from session_completed where sno=".$_GET['sid']) or die(mysqli_error($con));
    $user_name = mysqli_fetch_assoc($verify)['session_user_id'];
    if($user_name==$_SESSION['exp_dash_id']){
        foreach(glob("../uploads/user_".$_SESSION['exp_dash_id']."/".$_GET['sid']."_*") as $name){
        ?>
        <!--requires exploding name here since otherwise it will create ../../upload path when accessing thru delete_file.php-->
        <li data-d="<?php echo explode("/",$name,2)[1]; ?>"><?php echo explode("_",basename($name),3)[2]; ?><span class="delete_x" style="color:red; margin-left:5px">x</span></li>
        <?php
        }
    }else{
      die("Not authorised!");
    }
  }
?>
