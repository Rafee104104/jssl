<?php

require_once "../../../assets/template/layout.top.php";

@ini_set('error_reporting', E_ALL);

@ini_set('display_errors', 'Off');
$info = find_all_field('vehicle_info','','vehicle_id="'.$_POST['vehicle_no'].'"');

$all_dealer[]=$info->driver_name;
$all_dealer[]=$info->driver_num;
echo json_encode($all_dealer);

?>



