<?php
session_start();
require_once "api_dbc.php";
require_once "token_check.php";

@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');

 $depot_id = $_GET['depo_id'];
 $item_id = $_GET['product_id'];
 if($depot_id == "" || $item_id == ""){
     $msg = array("code" => 401, "msg" => "Invalid depot or product");
     echo json_encode($msg);
     exit;
 }else{
    $sql = "select sum(item_in-item_ex) as stock from journal_item 
    where warehouse_id='$depot_id' and item_id='$item_id'";
    $query = mysql_query($sql);
    $row = mysql_fetch_assoc($query);
    $num_rows = mysql_num_rows($query);
    if($num_rows == 1){
        $stock = $row['stock'];
        $msg = array("code" => 200, "stock" => $stock);
        echo json_encode($msg);
        exit;
    }else{
        $msg = array("code" => 200, "stock" => 0);
        echo json_encode($msg);
        exit;
    }
 }

?>

