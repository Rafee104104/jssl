<?php
session_start();
ob_start();
//require "../../config/inc.all.php";
require_once "../../../assets/template/layout.top.php";
// ::::: Start Edit Section ::::: 
$dis_id=$_POST['id'];

?>
<select name="district" required>
	 <? foreign_relation('district_list','id','district_name',$district,'division_id="'.$dis_id.'"' );?>
</select>