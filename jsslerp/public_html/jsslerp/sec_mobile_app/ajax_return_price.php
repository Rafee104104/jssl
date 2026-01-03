<?php
//error_reporting(E_ALL);
session_start();
include 'config/db.php';
include 'config/function.php';

$item_id        =$_POST['id'];
$vendor_id   =$_POST['vendor_id'];

$info = findall("select * from item_info where item_id='".$item_id."'");


$price      = find1("select unit_price from ss_do_chalan where item_id='".$item_id."' and dealer_code='".$vendor_id."' order by id desc limit 1");
$unit       = $info->unit_name;


$arr = array('price' => $price, 'unit' => $unit);

echo json_encode($arr);

?>