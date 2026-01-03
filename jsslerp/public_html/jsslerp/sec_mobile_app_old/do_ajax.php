<?php
session_start();
include 'config/db.php';
include 'config/crud.php';
include 'config/function.php';
include 'config/access.php';


$item_id =$_POST['id'];

$info = findall("select * from item_info where item_id='".$item_id."'");


$price          = $info->t_price;
$unit           = $info->unit_name;
$pkt_size       = $info->pack_size;
$nsp_per        = $info->nsp_per;
$nsp_amt        = $price-(($info->nsp_per/100)*$price);


$arr = array('price' => $price, 'unit' => $unit, 'pkt_size' => $pkt_size, 'nsp_per' => $nsp_per, 'nsp_amt' => $nsp_amt);

echo json_encode($arr);

?>