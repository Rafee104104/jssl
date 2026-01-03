<?php
session_start();
require "../config/db_connect.php";
require "../common/my.php";
@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');
$str = $_REQUEST['a'];

$sql="SELECT a.rate,a.discount from hms_room_type a, hms_hotel_room b where b.room_type_id=a.id and b.id=".$str;

$query=mysql_query($sql);
$data=mysql_fetch_object($query);
?>
<input name="unit_price" type="text" class="input3" id="unit_price"  maxlength="100" style="width:95px; text-align:right;" onchange="billamt()" value="<?=$data->rate?>"/>
<input name="temp_dis" type="hidden" class="input3" id="temp_dis" readonly value="<?=$data->discount?>"/>