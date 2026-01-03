<?php
session_start();
require_once "../../../assets/support/inc.all.php";
@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');

$str = $_POST['data'];
$data=explode('##',$str);
$item=explode('#>',$data[0]);

$item_id = $item[2];
$a= $data[1];
$id= $data[0];

$update = 'update salary_months set status="'.$a.'" where id="'.$id.'"';
$updated = mysql_query($update);
if($updated){

	echo '<span class="btn1 btn1-bg-submit" >Saved Complete</span>';
}

?>
