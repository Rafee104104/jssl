<?php
if(!isset($_SESSION))
session_start();
$level=$_SESSION['user']['level'];
$module_name = 'Secondary Sales Module';

require_once "../../../assets/template/inc.main_layout.php";
?>