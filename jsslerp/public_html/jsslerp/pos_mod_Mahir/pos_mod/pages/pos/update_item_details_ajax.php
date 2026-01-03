<?php
session_start();
require_once "../../../assets/support/inc.all.php";
$details_id = $_REQUEST['details_id'];
$qty = $_REQUEST['i_qty'];
$price = $_REQUEST['i_price'];
$disc = $_REQUEST['i_disc'];
$disc_percent = $_REQUEST['i_disc_percent'];
//$position = strpos($disc, "%");
$disc_amt = $_REQUEST['i_disc'];
$total_amt  = $_REQUEST['i_tot_amt'];
$disc_percent_amt = (($qty*$price)*$disc_percent)/100;
$tot_discount_amt = $disc+$disc_percent_amt;
$tot_payable = (($qty*$price)-$tot_discount_amt);

$usql = "update sale_pos_details set qty = '$qty', rate = '$price',discount='$disc', total_amt = '$tot_payable', discount_amt = '$tot_discount_amt', discount_percent='$disc_percent' where id = '$details_id' ";
mysql_query($usql);

$info = find_all_field('sale_pos_details','','id="'.$details_id.'"');
$exchange_checker = $_REQUEST['exchange_checker']+find_a_field('sale_pos_master','exchange_notes','pos_id="'.$info->pos_id.'"');
if($exchange_checker>0){
$master_update = 'update sale_pos_master set exchange_notes="'.$exchange_checker.'" where pos_id="'.$info->pos_id.'"';
mysql_query($master_update);
}
$today = date('Y-m-d');
$total_item_qty = find_a_field('sale_pos_details','sum(qty)','item_id="'.$info->item_id.'" and pos_id="'.$info->pos_id.'" and gift_id=0');

$gift_info = find_all_field('pos_gift_offer','','start_date<="'.$today.'" and end_date>="'.$today.'" and item_id="'.$info->item_id.'" and warehouse_id="'.$_SESSION['user']['depot'].'"');
mysql_query('delete from sale_pos_details where gift_id="'.$gift_info->id.'" and pos_id="'.$info->pos_id.'" and item_id="'.$info->item_id.'" and gift_id>0');
if($gift_info->id>0 && $gift_info->item_qty<=$total_item_qty){
$group_id = $_SESSION['user']['group'];
$warehouse_id = $_SESSION['user']['depot'];
$gift_item_id = $gift_info->gift_id;
$gift_qty = floor(($total_item_qty/$gift_info->item_qty)*$gift_info->gift_qty);
$iisql = "INSERT INTO `sale_pos_details`(`pos_id`, `pos_date`, `group_for`, `item_id`, `dealer_id`, `qty`, `rate`, `total_amt`, `warehouse_id`,`serial_no`,`gift_id`) VALUES ('$info->pos_id','$today','$group_id','$gift_info->gift_id','$info->dealer_id','$gift_qty','0','0','$warehouse_id','$serial_no','$gift_info->id')";
mysql_query($iisql);
}

echo json_encode("ok");
?>