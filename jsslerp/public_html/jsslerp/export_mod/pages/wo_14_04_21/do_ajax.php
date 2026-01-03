<?php
session_start();
require_once "../../../assets/template/layout.top.php";
@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');
$str = $_POST['data'];
$data=explode('##',$str);
$item=$data[0];
 
$do_no = $data[1];

$item_all = find_all_field('item_info','','item_id="'.$item.'"');

$formula_id = find_a_field('item_info','formula_id','item_id="'.$item_all->item_id.'"');

$formula_cal = find_a_field('item_formula','item_formula','id="'.$formula_id.'"');

?>



<input  name="item_id" type="hidden" class="input3" id="item_id" style="width:60px; height:30px;" value="<?=$item_all->item_id?>" required="required"  tabindex="0"/>
<input  name="unit_name" type="hidden" class="input3" id="unit_name" style="width:60px; height:30px;" value="<?=$item_all->unit_name?>" required="required"  tabindex="0"/>
<input  name="formula_id" type="hidden" class="input3" id="formula_id" style="width:60px; height:30px;" value="<?=$formula_id?>" onchange="count_formula()" required="required"  tabindex="0"/>
<input  name="formula_cal" type="hidden" class="input3" id="formula_cal" style="width:60px; height:30px;" value="<?=$formula_cal?>" required="required"  tabindex="0"/>


	<table width="100%" border="1" align="left"  style="border-collapse:collapse; border:1px solid #caf5a5;" cellpadding="0" cellspacing="2">
<tr bgcolor="#CCCCCC">
	<td> <input name="WL" type="text" class="input3" id="WL" style="width:40px; height:30px;" value="<?=$item_all->WL?>" required="required" onchange="count_formula()" tabindex="0"/></td>
	<td>  <input name="WW" type="text" class="input3" id="WW" style="width:40px; height:30px;" value="<?=$item_all->WW?>" required="required" onchange="count_formula()" tabindex="0"/></td>
</tr>

</table>



