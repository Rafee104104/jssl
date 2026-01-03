<?php





// $tst = 'omar';



session_start();

require_once "../../../assets/template/layout.top.php";

@ini_set('error_reporting', E_ALL);

@ini_set('display_errors', 'Off');

$str = $_POST['data'];

$data=explode('##',$str);

$chalan_no = $data[0];



$ch_all = find_all_field('sale_do_chalan','','chalan_no="'.$chalan_no.'"');

$sql = 'select c.*,i.finish_goods_code from sale_do_chalan c, item_info i where i.item_id=c.item_id and chalan_no="'.$chalan_no.'" and api_trigger=0';

$qry = mysql_query($sql);

$batch = '';

$expire_date = '';





//api

$url = 'http://157.230.39.154:7012/api/erp/v2/update_distributor_stock/';



while($datas=mysql_fetch_object($qry)){

  

 $data = [

  "distributor_id" => $ch_all->dealer_code, 

  "update_date" => date('Y-m-d H:i:s'), 

  "list" => [

            [

          "distributor_id" => $datas->dealer_code, 

          "product_id" => $datas->finish_goods_code, 

          "qty_ctn" => $datas->pkt_unit, 

          "qty_pis" => $datas->total_unit, 

          "batch_code" => $batch, 

          "expiry_date" => $expire_date

          ]
      ]
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











