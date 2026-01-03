<?php
session_start();
require_once "api_dbc.php";
require_once "token_check.php";

@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');

// get the json string
$jsonData = file_get_contents('php://input');

// decode the json string
$decoded = json_decode($jsonData, true);

$_POST['ledger_group_id'] = 122001; 

$proj_id = $_SESSION['proj_id'];
$_POST['entry_at']=date('Y-m-d H:i:s');
$_POST['entry_by']=$_SESSION['user_id'];
$count = 0;

foreach($decoded as $product){ 
    
    $cy_id  = find_a_field('accounts_ledger','max(ledger_sl)','ledger_group_id='.$_POST['ledger_group_id'])+1;

    $_POST['ledger_sl'] = sprintf("%04d", $cy_id);
    $_POST['account_code'] = $_POST['ledger_group_id'].''.$_POST['ledger_sl'];
    $gl_group = find_all_field('ledger_group','','group_id='.$_POST['ledger_group_id']); 
    $_POST['ledger_name'] = $product['customer_name'];

    $ledger_gl_found = find_a_field('accounts_ledger','ledger_id','ledger_name='.$_POST['ledger_name']);

    if($ledger_gl_found==0) {
        $acc_ins_led = 'INSERT INTO accounts_ledger (ledger_id, ledger_sl, ledger_name, ledger_group_id, acc_class, acc_sub_class, acc_sub_sub_class, opening_balance, balance_type, depreciation_rate, credit_limit, proj_id, budget_enable, group_for, parent, cost_center, entry_by, entry_at)
     
       VALUES("'.$_POST['account_code'].'", "'.$_POST['ledger_sl'].'", "'.$_POST['ledger_name'].'", "'.$_POST['ledger_group_id'].'", "'.$gl_group->acc_class.'", "'.$gl_group->acc_sub_class.'",  
     
       "'.$gl_group->acc_sub_sub_class.'", "0", "Both", "0", "0", "'.$proj_id.'", "YES", "'.$_POST['group_for'].'", "0", "0", "'.$_POST['entry_by'].'", "'.$_POST['entry_at'].'")';
      $query = mysql_query($acc_ins_led);
    }

    $customer_name = $product['customer_name'];
    $depot_id = $product['depot_id'];
    $account_code = $_POST['account_code'];
    $ledger_group = $_POST['ledger_group_id'];
    $dealer_type = $product['dealer_type'];
    $group_for = $_SESSION['group_for'];

    $region_code = $product['region_code'];
    $zone_code = $product['zone_code'];
    $area_code = $product['area_code'];
    $contact_no = $product['contact_no'];
    $address = $product['address'];
    $credit_limit = $product['credit_limit'];
    $contact_person_name = $product['contact_person_name'];
    $contact_person_designation = $product['contact_person_designation'];
    $contact_person_mobile = $product['contact_person_mobile'];
    

    $sql = "INSERT INTO dealer_info (dealer_name_e, depot, account_code, ledger_group, group_for, dealer_type, region_code, zone_code, area_code, contact_no, address_e, credit_limit, contact_person_name, contact_person_designation, contact_person_mobile, entry_by, entry_at) 
    VALUES ('$customer_name', '$depot_id', '$account_code', '$ledger_group', $group_for, '$dealer_type', '$region_code', '$zone_code', '$area_code', '$contact_no', '$address', '$credit_limit', '$contact_person_name', '$contact_person_designation', '$contact_person_mobile', '".$_POST['entry_by']."', '".$_POST['entry_at']."')";
    
    $query = mysql_query($sql);
    
}

if($query){
    //JSON SUCCESS WITH 200 RESPONSE
    $msg = "success";
    $status = 200;
    $response = array('status' => $status, 'msg' => $msg);
    echo json_encode($response);
}else{
    //JSON ERROR WITH 400 RESPONSE
    $msg = "error";
    $status = 400;
    $response = array('status' => $status, 'msg' => $msg);
    echo json_encode($response);
}
?>











