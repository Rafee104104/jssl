<?php

session_start();

require_once "../../../assets/template/layout.top.php";

@ini_set('error_reporting', E_ALL);

@ini_set('display_errors', 'Off');

$str = $_POST['data'];

$data=explode('##',$str);

$chalan_no = $data[0];

$ch_all = find_all_field('sale_do_chalan','','chalan_no="'.$chalan_no.'"');

$sql = 'select c.*,i.finish_goods_code,d.customer_code from sale_do_chalan c, item_info i, dealer_info d where c.dealer_code=d.dealer_code and i.item_id=c.item_id and chalan_no="'.$chalan_no.'" and gift_id=0 and api_trigger=0';

$qry = mysql_query($sql);

$batch = '';


$expire_date = '';

$url = 'http://157.230.39.154:7012/api/erp/v2/update_distributor_stock/';

while($datas=mysql_fetch_object($qry)){
$sample_qty_pis = find_a_field('sale_do_details','sum(total_unit)','ref_item_id="'.$datas->item_id.'" and ref_id="'.$datas->order_no.'" and do_no="'.$datas->do_no.'"');


$data = [
   "distributor_id" => $datas->customer_code, 
   "do_id" => $datas->do_no, 
   "depot_id" => $datas->depot_id, 
   "delivery_challan_no" => $datas->chalan_no, 
   "product_id" => $datas->finish_goods_code, 
   "quantity_pis" => $datas->total_unit, 
   "sample_quantity_pis" => $sample_qty_pis, 
   "batch_code" => $batch, 
   "expiry_date" => $expire_date,
   "amount" => $datas->total_amt
];  

    $ch=curl_init($url);

    $data_string = json_encode($data);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('x-api-key: XXXXXX', 'Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

//returning here
	$result = curl_exec($ch);
    curl_close($ch);

    

}
	if($result>0){

	 $update = 'update sale_do_chalan set api_trigger=1 where chalan_no="'.$chalan_no.'"';

	 mysql_query($update);

	 echo '<span style="color:green;">Success</span>';

	}else{

	echo '<span style="color:red;">Failed</span>';

	}

?>
