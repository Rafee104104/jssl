<?php
session_start();
require_once "../../../assets/template/layout.top.php";
@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');
$str = $_POST['data'];
$data=explode('##',$str);
 
$barcode = $data[0];

//$dataList = find_all_field('journal_item', '', 'barcode="'.$barcode.'"');



?>
<?php /*?>
				<table  width="100%" border="1" align="left" cellpadding="0" cellspacing="2">
                <tr>
				 
                
				  <td width="20%"><input name="ctn_price" type="text" id="ctn_price" readonly="" required  value="<?=$do_data->ctn_price;?>" /></td>
                  <td width="20%"><input name="pcs_price" type="text" id="pcs_price" readonly="" required="required"  value="<?=$do_data->pcs_price;?>"  /></td>
				  </tr>
              </table><?php */?>

<table  width="100%" border="1" align="left"  style="border-collapse:collapse; border:1px solid #caf5a5;" cellpadding="0" cellspacing="2">
  <tr bgcolor="#CCCCCC">
    <td width="50%"><input name="item_name" type="text" readonly=""  autocomplete="off"  value="<?=find_a_field('item_info a, journal_item b', 'a.item_name', 'a.item_id=b.item_id AND b.barcode="'.$barcode.'"')?>" id="item_name" /></td>
	
    <td width="20%"><input name="unit_name" type="text" class="input3"  value="<?=find_a_field('item_info a , journal_item b', 'a.unit_name', 'a.item_id=b.item_id AND b.barcode="'.$barcode.'"')?>" id="unit_name" style="width:90%; height:30px;" /></td>
	
    <td width="30%"><input name="pcs_stock" type="text" readonly=""  autocomplete="off"  value="<?=find_a_field('journal_item', 'sum(item_in)-sum(item_ex)', 'barcode="'.$barcode.'"')?>" id="pcs_stock" /></td>
<?php /*?>	
    <td width="12%"><input name="unit_price" type="text" class="input3" id="unit_price" onkeyup="count()"  style="width:90%; height:30px;" required="required"  value="<?=$item_sales_price?>"   /></td><?php */?>
  </tr>
</table>
