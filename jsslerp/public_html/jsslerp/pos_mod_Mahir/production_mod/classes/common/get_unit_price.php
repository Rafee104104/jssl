<?php
session_start();
require "../config/db_connect.php";
require "../common/my.php";
@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');
$str = $_REQUEST['a'];

$unit_price=find_a_field('hms_services','amount','id='.$str);
?>
<input name="unit_price" type="text" class="input3" id="unit_price"  maxlength="100" style="width:95px; text-align:right;" onchange="billamt()" value="<?=$unit_price?>"/>