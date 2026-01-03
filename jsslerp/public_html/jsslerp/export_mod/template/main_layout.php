<?php
if(!isset($_SESSION))
session_start();
$level=$_SESSION['user']['level'];
$module_name = 'Commercial Module';
require_once "../../../assets/template/inc.main_layout.php";
?>