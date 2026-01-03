<?php
session_start();
ob_start();
require "../../config/inc.all.php";

// run a query to delete the note
$sql = "DELETE FROM product_asign WHERE asign_id = '".$_GET['asign_id']." '";
$result = mysql_query($sql);
if($result){
header('location:product_assign.php');
}else{
echo 'error';  
}

?>