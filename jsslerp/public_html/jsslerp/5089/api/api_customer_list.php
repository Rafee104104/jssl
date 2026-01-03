<?php
session_start();

require_once "api_dbc.php";
require_once "token_check.php";

@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');



$sql = "SELECT 
    dealer_code as customer_code,
    dealer_name_e as customer_name,
    propritor_name_e as owner_name,
    account_code,
    area_code,
    zone_code,
    region_code,
    contact_no,
    address_e as address,
    credit_limit,
    contact_person_name,
    contact_person_designation,
    contact_person_mobile
    
 FROM dealer_info WHERE 1 ORDER BY dealer_name_e asc";
$query = mysql_query($sql);
$customer_list = array();
while($row = mysql_fetch_assoc($query)){
    $customer_list[] = $row;
}
echo json_encode($customer_list);


?>











