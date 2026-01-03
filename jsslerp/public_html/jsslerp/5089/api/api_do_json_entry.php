<?php
session_start();
require_once "api_dbc.php";
require_once "token_check.php";

@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');


$json = file_get_contents('php://input');
  
  // Decode JSON data
  $data = json_decode($json, true);

    $customer_code = $data['Chemist']['Code'];
    $do_date = $data['DeliveryDate'];
    $do_no = $data['SalesCenter']['Code']."-".$data['Chemist']['Code']."-".$data['DeliveryDate'];
    $depot_id = $data['SalesCenter']['Code'];
    $payment_type = $data['PaymentType'];
    $total_amount = $data['TotalAmount'];
    $sub_total = $data['SubTotal'];
    $vat_total = $data['VatTotal'];
    $discount_total = $data['DiscountTotal'];
    $adjustment = $data['Adjustment'];
    $entry_by = $_SESSION['user_id'];
    $entry_at = date('Y-m-d H:i:s');
    $status = "PROCESSING";
    
if(empty($customer_code) || empty($do_date) || empty($depot_id)){
    $msg = "Please fill all the fields";
    echo json_encode($msg);
    exit;
}else{
    
    
    $sql = "INSERT INTO sale_do_master(dealer_code, do_date, depot_id, payment_by, 	vat_amt, discount, cash_discount, entry_by, entry_at, status)
    VALUES ('$customer_code', '$do_date', '$depot_id', '$payment_type', '$vat_total', '$discount_total', '$adjustment', '$entry_by', '$entry_at', 'PROCESSING')";
    $query = mysql_query($sql);

    $masterId = mysql_insert_id();
    // Insert data into sale_do_details table
    $detailList = $data["DetailList"];

foreach ($detailList as $detail) {
    $productName = $detail["Product"]["Name"];
    $productCode = $detail["Product"]["Code"];
    $quantity = $detail["Quantity"];
    $price = $detail["Price"];
    $vat = $detail["Vat"];
    $discount = $detail["Discount"];
    $subTotal = $detail["SubTotal"];
    $vatTotal = $detail["VatTotal"];
    $discountTotal = $detail["DiscountTotal"];
    $totalAmount = $detail["TotalAmount"];
    

    $isql = 'select * from item_info where finish_goods_code="'.$productCode.'"';
    $iquery = mysql_query($isql);
    $irow = mysql_fetch_assoc($iquery);

    $product_id = $irow['item_id'];
    $pkt_size = $irow['pack_size'];
    $pkt_unit = (int)($quantity/$pkt_size);
    $dist_unit = fmod($quantity, $pkt_size);

    $sql = "INSERT INTO sale_do_details(do_no, dealer_code, do_date, item_id, unit_price, total_unit, total_amt, pkt_unit, dist_unit, pkt_size, depot_id, entry_by, entry_at, status, discount, vat_amt)
    VALUES ('$masterId', '$customer_code', '$do_date', '$product_id', '$price', '$quantity', '$totalAmount', '$pkt_unit', '$dist_unit', '$pkt_size', '$depot_id', '$entry_by', '$entry_at', 'PROCESSING', '$discount', '$vatTotal')";
    $query = mysql_query($sql);

}

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

?>











