<?php
session_start();
require_once "api_dbc.php";
require_once "token_check.php";

function next_value($field,$table,$diff=1,$initiate=100001,$btw1='',$btw2='')
{
    if($btw1>0)
    $sql="select max(".$field.") from ".$table." where ".$field." between '".$btw1."' and '".$btw2."'";
    else
    $sql="select max(".$field.") from ".$table;
    
    //echo $sql;
    $query=mysql_fetch_row(mysql_query($sql));
    $value=$query[0]+$diff;
    if($query[0] == 0)
    {
        $value=$initiate;
    }
    return $value;
}

@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');


// get the json string
$jsonData = file_get_contents('php://input');

// decode the json string
$decoded = json_decode($jsonData, true);

$_POST['sub_group_id'] = 100170000; // FG

$_POST['entry_at']=date('Y-m-d H:i:s');
$_POST['entry_by']=$_SESSION['user_id'];
$count = 0;

foreach($decoded as $product){ 
    $found = find_a_field('item_info','count(item_id)','item_name="'.$product['product_name'].'"');
    if($found > 0){
        $count++;
        continue;
    }
    $min=number_format($_POST['sub_group_id'] + 1, 0, '.', '');
    $max=number_format($_POST['sub_group_id'] + 10000, 0, '.', '');
    $_POST['item_id']=number_format(next_value('item_id','item_info','1',$min,$min,$max), 0, '.', '');

    $product['product_name'] = str_replace(Array("\r\n","\n","\r"), " ", $product['product_name']);
    $product['product_name'] = str_replace('"',"``",$product['product_name']);
    $product['product_name'] = str_replace("'","`",$product['product_name']);

    $_POST['group_for'] = find_a_field('item_sub_group','group_for','sub_group_id='.$_POST['sub_group_id']);

    $product_code = $product['product_code'];
    $unit = $product['unit'];
    $pack_size = $product['pack_size'];
    $price = $product['price'];
    $product_nature = 'Salable';

    $sql = "INSERT INTO item_info (item_id, sub_group_id, finish_goods_code, item_name, unit_name, pack_size, d_price, product_nature, entry_at, entry_by, status) 
    VALUES ('".$_POST['item_id']."', '".$_POST['sub_group_id']."', '".$product_code."', '".$product['product_name']."', '".$unit."', '".$pack_size."', '".$price."', '".$product_nature."', '".$_POST['entry_at']."', '".$_POST['entry_by']."', 'Active')";
    
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

    if($count > 0){
        //JSON ERROR WITH 400 RESPONSE
        $msg = $count." Duplicate Product Found";
        $status = 400;
        $response = array('status' => $status, 'msg' => $msg);
        echo json_encode($response);
    }



?>











