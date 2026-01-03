<?php
if(!isset($_SESSION))
session_start();
$level=$_SESSION['user']['level'];
$module_name = 'Vehicle Management Module';
require_once "../../../assets/template/inc.main_layout.php";
?>