<?php


session_start();


require_once "../../../assets/template/layout.top.php";


@ini_set('error_reporting', E_ALL);


@ini_set('display_errors', 'Off');


$itemcode=$_POST['itemCode'];


$a2="select * from lc_purchase_invoice where id='".$itemcode."'";

$query=mysql_query($a2);

$data=mysql_fetch_array($query);

 $res= $data;

echo json_encode($res);


?>



