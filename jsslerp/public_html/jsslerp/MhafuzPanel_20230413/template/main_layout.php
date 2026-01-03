<?php
if(!isset($_SESSION))
session_start();
$level=$_SESSION['user']['level'];
$module_name = 'Master Panel';

require_once "../../../assets/template/inc.main_panel.php";

?>
