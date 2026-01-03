<?php
session_start();
include 'config/db.php';
include 'config/function.php';
include 'config/access.php';
$user_id	=$_SESSION['user_id'];
$product_group	=$_SESSION['product_group'];
$entry_by   = $_SESSION['username'];

//var_dump($_REQUEST);

$total_unit  	= $_REQUEST['item_qty'];
$do_no 			= $_REQUEST['do_no'];
$do_date 		= $_REQUEST['do_date'];
$dealer_code 	= $_REQUEST['dealer_code'];
$item_id 		= $_REQUEST['item_id'];


$info = findall('select d_price,t_price,m_price from item_info where item_id="'.$item_id.'"');
$unit_price = $info->d_price;
$total_amt = $unit_price*$total_unit;




$sql = 'delete from ss_do_details where item_id="'.$item_id.'" and dealer_code = "'.$dealer_code.'" and do_no="'.$do_no.'"';
mysqli_query($conn,$sql);

if($total_unit>0){

$sql="INSERT INTO ss_do_details
(do_no,do_date,item_id, dealer_code, unit_price,total_unit,total_amt,entry_by) 
VALUES 
('".$do_no."','".$do_date."','".$item_id."','".$dealer_code."','".$unit_price."','".$total_unit."','".$total_amt."','".$entry_by."'
)";
mysqli_query($conn, $sql);
}


echo 'Done';

?>