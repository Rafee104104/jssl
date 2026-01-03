<?php
session_start();
require_once "api_dbc.php";
require_once "token_check.php";


@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');



 $sql = "SELECT 
     	max(do_no+1) as order_no
 		FROM sale_do_master ";
$query = mysql_query($sql);
$row = mysql_fetch_object($query);
$order_no = $row->order_no;
if($order_no == null){
	$order_no = 1;
}
$msg = array("code" => 200, "order_no" => $order_no);
echo json_encode($msg );

?>