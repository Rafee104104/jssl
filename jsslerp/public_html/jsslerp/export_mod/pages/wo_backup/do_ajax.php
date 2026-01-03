<?php
session_start();
require_once "../../../assets/template/layout.top.php";
@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');
 $str = $_POST['data'];
$data=explode('##',$str);
$item=$data[0];
  $reference_no = $item;
  $do_no = $data[1];


$reference_data= find_all_field('raw_input_data','','reference_no="'.$reference_no.'"');

//$paper_measurement = $reference_data->L_cm.'X'.$reference_data->W_cm.'X'.$reference_data->H_cm.' cm';


?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr>

<td width="12%">

<input  name="order_no" type="hidden" class="input3" id="order_no" style="width:60px; height:30px;" value="<?=$reference_data->id?>" required="required"  tabindex="0"/>
<input  name="reference_no" type="hidden" class="input3" id="reference_no" style="width:60px; height:30px;" value="<?=$reference_data->reference_no?>" required="required"  tabindex="0"/>
<input  name="item_id" type="hidden" class="input3" id="item_id" style="width:60px; height:30px;" value="<?=$reference_data->item_id?>" required="required"  tabindex="0"/>

<input  name="ply" type="text" class="input3" id="ply" style="width:60px; height:30px;" value="<?=$reference_data->ply?>" required="required"  tabindex="0"/></td>

<td width="16%"><input   name="paper_combination" type="text" class="input3" id="paper_combination" style="width:180px; height:30px;"  value="<?=$reference_data->paper_combination?>"   tabindex="0"/></td>

<td width="13%"><input   name="L_cm" type="text" class="input3" id="L_cm" style="width:70px; height:30px;"  value="<?=$reference_data->L_cm?>" required="required"  tabindex="0"/></td>
<td width="13%"><input  name="W_cm" type="text" class="input3" id="W_cm" style="width:70px; height:30px;" value="<?=$reference_data->W_cm?>" required="required"  tabindex="0"/></td>
<td width="13%"><input name="H_cm" type="text" class="input3" id="H_cm" style="width:70px; height:30px;"  value="<?=$reference_data->H_cm?>" required="required"  tabindex="0"/>

<input name="WL" type="hidden" class="input3" id="WL" style="width:70px; height:30px;" value="<?=$reference_data->WL?>" required="required"  tabindex="0"/>
<input name="WW" type="hidden" class="input3" id="WW" style="width:70px; height:30px;"  value="<?=$reference_data->WW?>" required="required"  tabindex="0"/>

</td>

<td width="13%"><input  name="sqm_rate" type="text" class="input3" id="sqm_rate" style="width:80px; height:30px;" onKeyUp="count()" value="<?=$reference_data->sqm_rate?>" required="required"  tabindex="0"/></td>

<td width="20%">

<input name="unit_price" type="text" class="input3" id="unit_price" style="width:80px; height:30px;" onKeyUp="count()" value="<?=$reference_data->pcs_rate?>"readonly/></td>

</tr>

</table>
