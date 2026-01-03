<?php
@session_start();
$host	='localhost';
date_default_timezone_set('Asia/Dhaka');
$user 	= $_SESSION['db_user'];
$pass 	= $_SESSION['db_pass'];
$db 	= $_SESSION['db_name'];

$link 	= @mysql_connect($host, $user, $pass);
if (!$link) die('Could not connect: ' . mysql_error());
@mysql_select_db($db); 
?>
