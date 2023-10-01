<?php
$conn = new PDO("mysql:host=localhost;dbname=devdb","devuser","*zRw.qRdS2k&") or die("Connection Error!");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (session_id() == "")
  session_start();
 ?>
