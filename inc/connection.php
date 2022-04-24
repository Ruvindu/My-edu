<?php
//$con = mysqli_connect("localhost","my-edu","my-edu@admin000","my-edu");
$con = mysqli_connect("localhost","root","","my-edu");

// Check connection
if (mysqli_connect_errno())
  {
  	die("Failed to connect to database: " . mysqli_connect_error());
  }
?>