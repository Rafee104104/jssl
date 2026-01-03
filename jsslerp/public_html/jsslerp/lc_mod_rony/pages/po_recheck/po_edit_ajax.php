<?php
session_start();
require_once "../../../assets/template/layout.top.php";
@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');

$str = $_POST['data'];
$data=explode('##',$str);
$order_id=$data[0];
$info = $data[1];
$in = explode('<@>',$info);

$warehouse_id = $in[0];
$qty = $in[1];
$unit_price = $in[2];
$amount = $in[3];

			   $new_sql="UPDATE `purchase_sp_invoice` SET 
			 warehouse_id = '".$warehouse_id."',
			`qty` = '".$qty."',
			`rate` = '".$unit_price."', 
			`amount` = '".$amount."'
			
			 WHERE `id` ='".$order_id."'";
			
			mysql_query($new_sql);
?>
<input name="Button" type="button" id="Button" value="Success" style="width:70px; font-size:12px; font-weight:700; height:30px;background-color: #008000;" onclick="submitButtonStyle(this);update_edit(<?=$order_id?>)" />
