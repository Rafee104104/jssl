<?php

session_start();

require_once "../../../assets/support/inc.all.php";

@ini_set('error_reporting', E_ALL);

@ini_set('display_errors', 'Off');



 $str = $_POST['data'];

$data=explode('##',$str);

$item=explode('#>',$data[0]);

$item_id = $item[2];

if($item_id>0){

$stock = (int)warehouse_product_stock($item_id ,$data[1]);

$last_p = find_all_field('purchase_invoice','','item_id="'.$item_id.'" order by id desc');

$item_all= find_all_field('item_info','','item_id="'.$item_id.'"'); 

}

?>
<table>
<tr>
<td width="27%">
<input name="stk" type="text" class="input3" id="stk" style="width:80px;" value="<?=$stock?>"/>
</td>
<td width="23%">
<input name="unit_name" type="text" class="input3" id="unit_name" style="width:80px;" value="<?=$item_all->unit_name?>" />

</td>
<td width="27%">

<input name="rate" type="text" class="input3" id="rate" style="width:80px;" onchange="count()" value="<?=$item_all->cost_price?>" />
</td>
</tr>
</table>