<?php
session_start();
require "../../support/inc.all.php";
@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');

$str = $_POST['data'];
$data=explode('##',$str);
$req_no = $data[0];

if($req_no>0){
$req_all= find_all_field('requisition_master_stationary','','req_no="'.$req_no.'"');

$orgnization = find_all_field('user_group','','id="'.$req_all->warehouse_id.'"');
}
?>
	  <? $field='requisition_from';?>
      <div>
        <label for="<?=$field?>">Requisition From:</label>
        <input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$req_all->req_for;?>" required/>
      </div>

	  <div>
        <label>Issued To :</label>
        <select  name="issued_to"  id="issued_to"  required="required"/>
			<option value="<?=$req_all->entry_by;?>"><?=find_a_field('hrm_user_access','user_name','emp_id='.$req_all->entry_by);?></option>
		</select>
      </div>
	  
      <div>
        <label>Organization :</label>
			<input  name="organization" type="hidden" id="organization" value="<?=$orgnization->id?>" />
			<input  name="organization2" type="text" id="organization2" value="<?=$orgnization->group_name?>" readonly/>
      </div>
	  
	  <div>
        <? $field='approved_by';?>
		<div>
          <label for="<?=$field?>">Approved By :</label>
          <input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=find_a_field('personnel_basic_info','PBI_NAME','PBI_ID='.$req_all->checked_by);?>" required/>
        </div>
      </div>
