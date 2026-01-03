<?php
if(!isset($_SESSION))
session_start();
$level=$_SESSION['user']['level'];
$module_name = 'User Module';
$concern=find_a_field('project_info','company_name','1');

require_once "../../../assets/template/inc.main_layout.php";
?>


