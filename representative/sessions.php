<?php ob_start();
require_once('../connection.php');
require_once('../head.php');
require_once('count_card.php');
//checking get variable for module id
if(!isset($_GET['id'])){
  header('location:dashboard');
}else{
  $module_id=$_GET['id'];
}
//fetching the number of session for the module
$session_query = "SELECT session_count from module where id=".$module_id;
if(($session_res=mysqli_query($con,$session_query))==false){
  echo mysqli_error($con);
  exit();
}
else{
  $session_count = mysqli_fetch_row($session_res)[0];
}
?>
<div class="jumbotron" style="background-color:white; padding-bottom:0px; padding-top:2
0px;">
  <h1 class="light" align="center">Sessions</h1>
</div>
<div class="container">
  <?php count_card($session_count,"Session"); ?>
</div>

<?php
require_once("../footer.php");
?>
<script>
  //for redirection on selection of a session
  $('document').ready(function(){
    $('.Session').on('click',function(){
      var ses_id=$(this).prop('id');
      var mod_id = <?php echo $module_id; ?>;
      window.open("session_data.php?mod_id="+mod_id+"&ses_id="+ses_id,"_self");
    });
  });
</script>
