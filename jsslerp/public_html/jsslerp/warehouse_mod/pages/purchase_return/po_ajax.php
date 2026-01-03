<?php

session_start();

require_once "../../../assets/support/inc.all.php";

@ini_set('error_reporting', E_ALL);

@ini_set('display_errors', 'Off');



 $str = $_POST['data'];

$data=explode('##',$str);

$item=explode('#>',$data[0]);

 $item_id = $item[0];

if($item_id>0){

$stock= find_a_field('journal_item','sum(item_in-item_ex)','item_id="'.$item_id.'" and warehouse_id="'.$_SESSION['user']['depot'].'"');
$item_price= find_a_field_sql('select (sum((item_in*item_price)-(item_ex*item_price))/sum(item_in-item_ex)) as avg_rate from journal_item where tr_from="Purchase" and item_id="'.$item_id.'" ');


$item_all= find_all_field('item_info','','item_id="'.$item_id.'"'); 

}

?>
<table  width="100%" border="1" align="left"  style="border-collapse:collapse; border:1px solid #caf5a5;" cellpadding="0" cellspacing="2">
<tr bgcolor="#CCCCCC">
	 <td width="38%">
	 <input name="pkt_size" type="hidden" class="input3" id="pkt_size"  style="width:98%;"   value="<?=$item_all->pack_size?>" readonly="readonly"/>
	 
	 <input name="item_name" type="text" class="input3"  value="<?=$item_all->item_name;?>" id="item_name" style="width:90%; height:30px;"  readonly="" /> </td>
	 <td width="14%"><input name="unit_name" type="text" class="input3"  value="<?=$item_all->unit_name;?>" id="unit_name" style="width:90%; height:30px;" /></td>
	 <td width="16%"><input name="pcs_stock" type="text" class="input3"  value="<?=(int)$stock;?>" id="pcs_stock" style="width:90%; height:30px;" readonly /></td>
	 <td width="23%"><input name="unit_price" type="text" class="input3" id="unit_price"  style="width:90%; height:30px;" required="required" onkeyup="count()"  value="<?=number_format($item_price, 3, '.', '');?>"   /></td>
</tr>
</table>