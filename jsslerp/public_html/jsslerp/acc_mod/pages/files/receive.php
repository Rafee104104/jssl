<?
session_start();
require_once "../../../assets/support/inc.all.php";
$proj_id 	= $_SESSION['proj_id'];
$paid_amount=$_GET['paid_amount'];
$id=$_GET['id'];


echo $sql="UPDATE `sales_invoice` SET `paid_amount` = '$paid_amount' WHERE `s_inv_id` ='$id'";
mysql_query($sql);

echo '<font color="green">SUCCESS</font>';


?>
