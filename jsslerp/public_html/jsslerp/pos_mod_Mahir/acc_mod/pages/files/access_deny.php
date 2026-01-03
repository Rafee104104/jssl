<?php
require_once "../../../assets/template/layout.top.php";
$title='Access Deny';
?>
<img src="../img/access.JPG" width="406" height="304" />
<?
$main_content=ob_get_contents();
ob_end_clean();
require_once "../../template/main_layout.php";
?>
