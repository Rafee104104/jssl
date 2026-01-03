<?php


session_start();

require_once "../../../assets/template/layout.top.php";

@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');


$str = $_POST['data'];

$data=explode('##',$str);

$page_for = 'Other Receive';

$table = "loan_assign";
 
$amount = $data[0];
$or_no=$data[1];
$booking_no=$data[2];

$token_number = $data[3];
$bag_mark = $data[4];
$flag = $data[5];
 
if($flag==1){
	$del="DELETE FROM `loan_assign` WHERE bag_mark like '".$bag_mark."' ";
	mysql_query($del);
} 
 
 $sql = "INSERT INTO `loan_assign`(`booking_no`, `token_number`, `bag_mark`, `amount_in`, `entry_by`) 
 VALUES ('".$booking_no."','".$token_number."','".$bag_mark."','".$amount."','".$_SESSION['user']['id']."')";
 mysql_query($sql);
 
 echo 'Success';
 
 
?>
