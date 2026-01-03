<?php
require_once('../../../../../../erpengine/controller/MainEngine/controller/configure/db_connect_acc_main.php');





$sql = "SELECT * from company_info  where company_name='test'";


$query = @mysql_query($sql);

$proj = @mysql_fetch_object($query);



echo	$proj->signup_date;

print_r($proj);
