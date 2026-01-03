<?php
session_start();
require_once "api_dbc.php";
require_once "token_check.php";

@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');



 $sql = "SELECT 
    warehouse_id as depo_id,
    warehouse_name as depo_name
 FROM warehouse WHERE use_type='WH' ORDER BY warehouse_name asc";
$query = mysql_query($sql);
$warehouse_list = array();
while($row = mysql_fetch_assoc($query)){
    $warehouse_list[] = $row;
}
echo json_encode($warehouse_list);


?>