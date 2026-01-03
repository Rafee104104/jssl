<?php
session_start();
ob_start();
 require_once "../../../assets/support/inc.all.php";

header("location:../home/home.php");
?>
<?
$main_content=ob_get_contents();
ob_end_clean();
include ("../../template/main_layout.php");
?>