<?php

require_once "../../../assets/template/layout.top.php";

@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');

$str = $_POST['data'];
$data=explode('##',$str);
 $data_id=$data[0];
 
if($data[2]=='yearAjax'){
   $dt = find_all_field('grade_settings','year_no','grade="'.$data_id.'"  and year_no = "'.$data[1].'"');
   
  
?>

							<input name="basic_salary" type="text" id="basic_salary" value="<?=$dt->final_basic?>" onclick="pf_cal()" class="form-control"  />
							<label for="fname">House Rent:</label>
							<input name="house_rent" type="text" id="house_rent" onclick="pf_cal()" class="form-control"  value="<?=$dt->house?>" /><br>
							  
							<label for="fname">Medical Allowance:</label>
							<input name="medical_allowance" type="text" id="medical_allowance" onclick="pf_cal()"  value="<?=$dt->medical?>" class="form-control" />

							
							<label for="fname">Conveyance Allowance:</label>
							<input name="ta" type="text" id="ta" onclick="pf_cal()"  value="<?=$dt->conveyance?>" class="form-control" />
							
							
							<label for="fname">Entertainment Allowance:</label>
							<input name="entertainment" type="text" id="entertainment" onclick="pf_cal()"  value="<?=$dt->entertainment?>" class="form-control" />
							
							

<?
}
?>


<?php /*?>
<select name="ledger_sub_group_id" required id="ledger_sub_group_id"  tabindex="2" style="width:220px;">
<option></option>
<? foreign_relation('ledger_sub_group','sub_group_id','CONCAT(sub_group_id, ": ", sub_group_name)',$ledger_sub_group_id,'group_id="'.$data_id.'"');?>
</select><?php */?>

