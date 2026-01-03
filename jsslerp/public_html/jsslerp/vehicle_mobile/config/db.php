<?php

date_default_timezone_set('Asia/Dhaka');


$conn = mysqli_connect("localhost","root","","jsslerp");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

?>