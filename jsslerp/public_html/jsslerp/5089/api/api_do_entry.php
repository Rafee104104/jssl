<?php
session_start();
require_once "api_dbc.php";
require_once "token_check.php";

@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');


$do_no = mysql_real_escape_string($_POST['order_no']);
$customer_code = mysql_real_escape_string($_POST['customer_code']);
$do_date = mysql_real_escape_string($_POST['do_date']);
$depot_id = mysql_real_escape_string($_POST['depo_id']);
$product_id = mysql_real_escape_string($_POST['product_id']);
$price = mysql_real_escape_string($_POST['price']);
$total_pcs = mysql_real_escape_string($_POST['total_pcs']);
$amount = ($price*$total_pcs);


if($do_no == "" || $customer_code == "" || $do_date == "" || $product_id == "" || $price == "" || $total_pcs == "" || $amount == ""){
    $msg = "Please fill all the fields";
    echo json_encode($msg);
    exit;
}else{

    $entry_by = $_SESSION['user_id'];
    $entry_at = date('Y-m-d H:i:s');
    //sale_do_master check
    $sql = 'select * from sale_do_master where do_no="'.$do_no.'"';
    $query = mysql_query($sql);
    //num rows
    $num_rows = mysql_num_rows($query);
    $row = mysql_fetch_assoc($query);
    if($num_rows == 0){
        $sql = "INSERT INTO sale_do_master(do_no, dealer_code, do_date, depot_id, entry_by, entry_at, status)
        VALUES ('$do_no', '$customer_code', '$do_date', '$depot_id', '$entry_by', '$entry_at', 'PROCESSING')";
        $query = mysql_query($sql);
    }

    $isql = 'select * from item_info where item_id="'.$product_id.'"';
    $iquery = mysql_query($isql);
    $irow = mysql_fetch_assoc($iquery);

    $pkt_size = $irow['pack_size'];
    $pkt_unit = (int)($total_pcs/$pkt_size);
    $dist_unit = fmod($total_pcs, $pkt_size);

    $sql = "INSERT INTO sale_do_details(do_no, dealer_code, do_date, item_id, unit_price, total_unit, total_amt, pkt_unit, dist_unit, pkt_size, depot_id, entry_by, entry_at, status)
    VALUES ('$do_no', '$customer_code', '$do_date', '$product_id', '$price', '$total_pcs', '$amount', '$pkt_unit', '$dist_unit', '$pkt_size', '$depot_id', '$entry_by', '$entry_at', 'PROCESSING')";
    $query = mysql_query($sql);

    if($query){
        $msg = array("code" => 200, "msg" => "Order Entry Successful");
        echo json_encode($msg);
        exit;
    }else{
        $msg = array("code" => 401, "msg" => "Order Entry Failed");
        echo json_encode($msg);
        exit;
    }
}

// $sql = "";
// $query = mysql_query($sql);
// $product_list = array();
// while($row = mysql_fetch_assoc($query)){
//     $product_list[] = $row;
// }
// echo json_encode($product_list);


?>











