<?php
ob_start();
require_once('../connection.php');
require_once('../head.php');
//checking session id
if(!isset($_GET['ses_id'])){
  //header("location:dashboard.php");
}else{
  $ses_id = $_GET['ses_id'];
}
?>
<style>
.session_data_choices{
  padding: 30px;
}
h2,h3{
width:100% !important;
margin-bottom:30px;
}
.inner{
  min-height:300px;
  display:flex;
  justify-content: center;
  align-content: center;
  border-radius: 20px;
  flex-wrap: wrap;
}
</style>
<div class="container" style="margin-top:5%">
  <div class="row">
    <div class="col-sm-6 session_data_choices justify-content-center">
      <div class="inner shadow">
      <h3 align="center"><i class="fa fa-user fa-3x"></i></h3>
      <h2 align='center' class="light">Student Performance</h2>
    </div>
    </div>
    <div class="col-sm-6 session_data_choices justify-content-center">
      <div class="inner shadow">
      <h3 align="center"><i class="fa fa-file-video fa-3x"></i></h3>
      <h2 align='center' class="light">Session Content</h2>
    </div>
    </div>
  </div>
</div>
<?php
require_once('../footer.php'); ?>
