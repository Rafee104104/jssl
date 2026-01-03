<?php
require_once "../../../assets/template/layout.top.php";

// run a query to delete the note
$sql = "DELETE FROM pf_status WHERE PF_STATUS_ID = '".$_GET['asign_id']." '";
$result = mysql_query($sql);
if($result){
header('location:pf_status.php');
}else{
echo 'error';  
}

?>