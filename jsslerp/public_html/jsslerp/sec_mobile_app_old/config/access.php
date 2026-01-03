<?php

session_start();

$emp_code		=$_SESSION['username'];
$user_region_id =$_SESSION['region_id'];
$user_zone_id 	=$_SESSION['zone_id'];
$user_area_id 	=$_SESSION['area_id'];
//$product_group 	=$_SESSION['product_group'];




if(!isset($_SESSION['username']) || $_SESSION['palkey']!="mep2ndsales22"){

	 session_destroy();

	 header("location:index.php");

	

	die("You are not allowed to access this page!");

}

if(isset($_REQUEST['action']) && $_REQUEST['action']=='logout'){

	// echo "YES";

	session_destroy();

	header("location:index.php");

}

?>