<?php
session_start();
require_once "api_dbc.php";
require_once "token_check.php";

@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');



$sql = "SELECT 
    item_id as product_id,
    finish_goods_code as product_code,
    item_name as product_name,
    unit_name as unit,
    pack_size,
    product_nature,
    d_price as price,
    m_price as mrp,
    status
 FROM item_info WHERE status='Active' ORDER BY item_name asc";
$query = mysql_query($sql);
$product_list = array();
while($row = mysql_fetch_assoc($query)){
    $product_list[] = $row;
}
echo json_encode($product_list);


?>











