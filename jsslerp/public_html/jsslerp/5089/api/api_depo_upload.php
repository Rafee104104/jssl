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


$proj_id = $_SESSION['proj_id'];
$_POST['entry_at']=date('Y-m-d H:i:s');
$_POST['entry_by']=$_SESSION['user_id'];
$count = 0;
$ecount = 0;

foreach($decoded as $product){ 
    
    $warehouse_name = $product['depo_name'];
    $warehouse_type = 'WH';
    $group_for = $_SESSION['group_for'];
    $address = $product['address'];


    $sql = "INSERT INTO warehouse (warehouse_name, address, use_type, group_for) 
    VALUES ('$warehouse_name', '$address', '$warehouse_type', $group_for)";
    
    $query = mysql_query($sql);

    if($query){
        //JSON SUCCESS WITH 200 RESPONSE
        $count++;
        
    }else{
        //JSON ERROR WITH 400 RESPONSE
        $ecount++;
        $msg = "error";
        $status = 400;
        $response = array('status' => $status, 'msg' => $msg);
    }
    
}

if($count > 0){
    $msg = $count." success";
        $status = 200;
        $response = array('status' => $status, 'msg' => $msg);
    echo json_encode($response);    
}
if($ecount){
    $msg = $ecount." error";
        $status = 400;
        $response = array('status' => $status, 'msg' => $msg);
    echo json_encode($response);
}

?>











