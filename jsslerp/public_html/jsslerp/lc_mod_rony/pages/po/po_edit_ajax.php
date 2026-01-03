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


$qty = $in[0];
$rate_usd = $in[1];
$amount_usd = $in[2];
$rate_ud = $in[3];
$amount_ud = $in[4];

			   $new_sql="UPDATE `lc_purchase_invoice` SET 
			 qty = '".$qty."',
			`rate_usd` = '".$rate_usd."',
			`amount_usd` = '".$amount_usd."',
			`rate_ud` = '".$rate_ud."',
			`amount_ud` = '".$amount_ud."'
			
			 WHERE `id` ='".$order_id."'";
			
			mysql_query($new_sql);
?>
<input name="<?='edit#'.$order_id?>" type="button" id="<?='edit#'.$order_id?>" value="Edit" style="width:50px; height:30px; color:#000; font-weight:700; " onclick="submitButtonStyle(this);update_edit(<?=$order_id?>)" />