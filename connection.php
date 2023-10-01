<?php

if (session_id() == "")

session_start();

$con = mysqli_connect("localhost","root","",'devdb') or exit("Error");

$mysqli = new mysqli("localhost","root","",'devdb');

$con_new = new PDO("mysql:host=localhost;dbname=devdb","root","") or die("Connection Error!");

$con_new->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 ?>

