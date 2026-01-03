<?php
require_once "../../../assets/template/layout.top.php";

// run a query to delete the note
$sql = "DELETE FROM product_asign WHERE asign_id = '".$_GET['asign_id']." '";
$result = mysql_query($sql);
if($result){
header('location:product_received.php');
}else{
echo 'error';  
}

?>