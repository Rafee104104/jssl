<?php
session_start();
require_once "../../../assets/template/layout.top.php";
@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');

$str = $_POST['data'];
$data=explode('##',$str);
$item=explode('#>',$data[0]);
$item_id = $item[1];
$id = $item[2];
if($item_id>0){
$item_all= find_all_field('item_info','','item_id="'.$item_id.'"');
$item_price= find_a_field_sql('select rate from purchase_receive where item_id="'.$item_id.'" order by id desc limit 1');
$warehouse_id = $data[1];

 $stock= find_a_field('journal_item','sum(item_in-item_ex)','item_id="'.$item_id.'" and warehouse_id="'.$_SESSION['user']['depot'].'"');
$req_qty = find_all_field('requisition_order_stationary','','req_no='.$data[2].' and item_id="'.$item_id.'" and id="'.$id.'" order by id');
$issuedQty = find_a_field('warehouse_other_issue_detail','sum(qty)','req_id='.$req_qty->id);
}
?>
<table style="width:100%">
	<tr>
		<td><input name="stock" type="text" class="input3" id="stock"  value="<?=$stock?>" readonly  /></td>
		<td><input name="unit" type="text" class="input3" id="unit"  value="<?=$item_all->unit_name;?>"/></td>
		<td><input name="rate" type="text" class="input3" id="rate"  maxlength="100"  onchange="count()" value="<?=$item_price?>" required /></td>
		<td><input name="req_qty" type="text" class="input3" id="req_qty"  maxlength="100"  value="<?=$req_qty->qty;?>"  /></td>
		<td><input name="undel" type="text" class="input3" id="undel"  maxlength="100"   value="<?=($req_qty->qty-$issuedQty);?>"  />
			<input name="req_id" type="hidden" class="input3" id="req_id"  maxlength="100"   value="<?=$req_qty->id;?>"  />
		</td>
	</tr>
</table>