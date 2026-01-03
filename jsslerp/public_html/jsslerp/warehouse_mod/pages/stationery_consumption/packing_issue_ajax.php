<?php
session_start();
require "../../support/inc.all.php";
@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');

$str = $_POST['data'];
$data=explode('##',$str);
$item=explode('#>',$data[0]);
$item_id = $item[1];
if($item_id>0){
$item_all= find_all_field('item_info','','item_id="'.$item_id.'"');
//$item_price= find_a_field_sql('select rate from purchase_receive where item_id="'.$item_id.'" order by id desc limit 1');
$item_price= find_a_field_sql('select (sum((item_in*item_price)-(item_ex*item_price))/sum(item_in-item_ex)) as avg_rate from journal_item where tr_from="Purchase" and item_id="'.$item_id.'" ');

$warehouse_id = $data[1];

$stock= find_a_field('journal_item','sum(item_in-item_ex)','item_id="'.$item_id.'" and warehouse_id="'.$_SESSION['user']['depot'].'"');
}
?>
<input name="stock" type="text" class="input3" id="stock" style="width:50px;" value="<?=$stock?>" readonly  />
<input name="unit_name" type="text" class="input3" id="unit_name" style="width:50px;" value="<?=$item_all->unit_name?>" readonly required onfocus="focuson('rate')"/>
<input name="rate" type="text" class="input3" id="rate"  maxlength="100" style="width:50px;" onchange="count()" value="<?=$item_price?>" required />