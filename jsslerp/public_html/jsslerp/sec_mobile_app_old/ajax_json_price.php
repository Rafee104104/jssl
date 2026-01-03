<?php
//error_reporting(E_ALL);
session_start();
include 'config/db.php';
include 'config/function.php';

$item_id =$_POST['id'];

$info = findall("select * from item_info where item_id='".$item_id."'");

$price      = $info->d_price;
//$cost_rate  = round(get_avg_cost($item_id),4);
//$stock      = (int)get_stock($item_id);
$unit       = $info->unit_name;


// if($info->type=='Discount'){$stock=100;}


//$arr = array('price' => $price, 'cost_rate' => $cost_rate, 'stock' => $stock, 'unit' => $unit);

$arr = array('price' => $price, 'unit' => $unit);

echo json_encode($arr);

?>