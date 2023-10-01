<?php
  require("connection.php"); //the connection
  require('check_login.php');

 if(!empty($_POST)){
$path = dirname(__FILE__).'/'.$_POST['file'];
unlink($path);
echo '1';
  }

?>