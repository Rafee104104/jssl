<?php

date_default_timezone_set('Asia/Dhaka');


$conn = mysqli_connect("localhost","clouderp_new_erp_mobile","Ly+vN0sPL_f#","clouderp_master_new_erp");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

?>