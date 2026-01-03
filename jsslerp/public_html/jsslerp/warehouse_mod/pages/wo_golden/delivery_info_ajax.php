<?php

require_once "../../../assets/template/layout.top.php";

@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');
$info = find_a_field('transport_setup','driver_id','transport_id="'.$_POST['transport_id'].'"');
$info1 = find_all_field('transport_driver_info','','driver_id="'.$info.'"');

$info2 = find_all_field('transport_info','','transport_id="'.$_POST['transport_id'].'"');

$all_dealer[]=$info1->driver_name;
$all_dealer[]=$info1->driver_mobile;

$all_dealer[]=$info2->transport_number;

echo json_encode($all_dealer);

?>



