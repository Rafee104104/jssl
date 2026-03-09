<?php
@session_start();
require_once __DIR__ . '/mysql_compat.php';
$host	='localhost';
date_default_timezone_set('Asia/Dhaka');
$user 	= isset($_SESSION['db_user']) ? $_SESSION['db_user'] : 'root';
$pass 	= isset($_SESSION['db_pass']) ? $_SESSION['db_pass'] : '';
$db 	= isset($_SESSION['db_name']) ? $_SESSION['db_name'] : 'jsslerp';

$link 	= @mysql_connect($host, $user, $pass);
if (!$link) die('Could not connect: ' . mysql_error());
@mysql_select_db($db); 
?>
