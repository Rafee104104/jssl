
<?php
session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";

$title='New Consumption';
$page = "other_issue.php";
$ajax_page = "packing_issue_ajax.php";
$page_for = 'Consumption';
do_calander('#oi_date','-250','0');

$table_master='warehouse_other_issue';
$table_details='warehouse_other_issue_detail';
$unique='oi_no';

if($_POST[$unique]>0){
	$_SESSION[$unique] = $_POST[$unique] ;
}


if(isset($_POST['new']))
{
		$crud   = new crud($table_master);

		if(!isset($_SESSION[$unique])) {
		$_POST['entry_by']=$_SESSION['user']['id'];
		$_POST['entry_at']=date('Y-m-d h:s:i');
		$_POST['edit_by']=$_SESSION['user']['id'];
		$_POST['edit_at']=date('Y-m-d h:s:i');
		$$unique=$_SESSION[$unique]=$crud->insert();
		unset($$unique);
		$type=1;
		$msg=$title.'  No Created. (No :-'.$_SESSION[$unique].')';
		}
		else {
		$_POST['edit_by']=$_SESSION['user']['id'];
		$_POST['edit_at']=date('Y-m-d h:s:i');
		$crud->update($unique);
		$type=1;
		$msg='Successfully Updated.';
		}
}

$$unique=$_SESSION[$unique];

if(isset($_POST['delete']))
{
		$crud   = new crud($table_master);
		$condition=$unique."=".$$unique;		
		$crud->delete($condition);
		$crud   = new crud($table_details);
		$condition=$unique."=".$$unique;		
		$crud->delete_all($condition);
		unset($$unique);
		unset($_SESSION[$unique]);
		$type=1;
		$msg='Successfully Deleted.';
}

if($_GET['del']>0)
{
		$crud   = new crud($table_details);
		$condition="id=".$_GET['del'];		
		$crud->delete_all($condition);
		
		$sql = "delete from journal_item where tr_from = '".$page_for."' and tr_no = '".$_GET['del']."'";
		mysql_query($sql);
		$type=1;
		$msg='Successfully Deleted.';
		
}


if(isset($_POST['confirmm']))
{
		unset($_POST);
		$_POST[$unique]=$$unique;
		$_POST['entry_by']=$_SESSION['user']['id'];
		$_POST['entry_at']=date('Y-m-d h:s:i');
		$_POST['status']='CHECKED';
		$crud   = new crud($table_master);
		$crud->update($unique);
		$total_amt = 0;
		
		$req_no_st = find_a_field('warehouse_other_issue','req_no','oi_no='.$$unique);
		if($req_no_st>0){
			$upql = 'update requisition_master_stationary set status = "COMPLETE" where req_no='.$req_no_st;
			mysql_query($upql);
		}	
		
		$sql = 'select * from warehouse_other_issue_detail where oi_no='.$$unique;
		$query = mysql_query($sql);
		while($oii = mysql_fetch_object($query)){
		$item_name = find_a_field('item_info','item_name','item_id='.$oii->item_id);
		$item_sub_group = find_a_field('item_info','sub_group_id','item_id='.$oii->item_id);
		
		journal_item_control($oii->item_id, $_SESSION['user']['depot'],$oii->oi_date,0,$oii->qty,$page_for,$oii->id,$oii->rate,'',$$unique);
		$total_amt = $total_amt + ($oii->qty*$oii->rate);
		$oi_date = $oii->oi_date;
		$item_id = $oii->item_id;
		}
		
		
		
		
		
		$details_sql = 'select sum(d.amount) as total_amt, i.item_id, s.item_ledger, s.cogs_ledger, d.oi_no 
                from warehouse_other_issue_detail d, item_info i, item_sub_group s 
                where s.sub_group_id = i.sub_group_id 
                and d.item_id = i.item_id 
                and d.issue_type = "Consumption" 
                and d.oi_no = "' . $$unique . '" 
                group by s.item_ledger';
$details_query = mysql_query($details_sql);

$tot_cogs_amt = 0;
$cogs_amt = 0;
$jv_date = $oi_date;
$jv_no=next_journal_sec_voucher_id('',$page_for);

$cc_code = find_a_field_sql("select w.cc_code from warehouse w where w.warehouse_id=" . $_SESSION['user']['depot']);

				while ($det_row = mysql_fetch_object($details_query)) {
				   $item_sql = 'SELECT i.item_id, s.item_ledger, s.cogs_ledger, i.item_name, d.rate, d.qty
							 FROM warehouse_other_issue_detail d
							 JOIN item_info i ON d.item_id = i.item_id
							 JOIN item_sub_group s ON s.sub_group_id = i.sub_group_id
							 WHERE d.issue_type = "Consumption"
							 AND d.oi_no = "' . $$unique . '"
							 AND s.item_ledger = "' . $det_row->item_ledger . '"
							 GROUP BY i.item_id';
				$item_query = mysql_query($item_sql);
				
				$item_names = [];
				$rates = [];
				$qtys = [];
				
				while ($row = mysql_fetch_object($item_query)) {
					$item_names[] = $row->item_name;
					$rates[] = $row->rate;
					$qtys[] = $row->qty;
				}
				
				// Construct the narration with items, rates, and quantities
				$narration_parts = [];
				for ($i = 0; $i < count($item_names); $i++) {
					$narration_parts[] = $item_names[$i] . " (Rate: " . $rates[$i] . ", Qty: " . $qtys[$i] . ")";
				}
				
				$narration = implode(',<br>', $narration_parts);
				
				
				
					
					echo $cogs_amt = $det_row->total_amt;
					$tot_cogs_amt += $cogs_amt;
				
					add_to_sec_journal($proj_id, $jv_no, $jv_date, $det_row->item_ledger, $narration, '0', $cogs_amt, 'Consumption', $$unique, '', $$unique, $cc_code);
					add_to_sec_journal($proj_id, $jv_no, $jv_date, $det_row->cogs_ledger, $narration, $cogs_amt, '0', 'Consumption', $$unique, '', $$unique, $cc_code);
				}
		
		sec_journal_journal($jv_no,$jv_no,'Consumption');
		
		//$jv_date = $oi_date;
//		$jv_no=next_journal_sec_voucher_id('',$page_for);
//		$cc_code = find_a_field_sql("select w.cc_code from warehouse w where  w.warehouse_id=".$_SESSION['user']['depot']);
//		
//		$sub_group_all = find_all_field('item_sub_group','*','sub_group_id='.$item_sub_group);
//		
//		$dr_ledger = $sub_group_all->cogs_ledger;
//		$cr_ledger = $sub_group_all->item_ledger;
//		
//		
//		$issuTo = find_a_field('warehouse_other_issue','issued_to','oi_no='.$$unique);
//		$issueTo = 'Issued To '.find_a_field('personnel_basic_info','PBI_NAME','PBI_ID='.$issuTo);
//
//		$narration = 'Printing and Stationary '.$issueTo.' ('.$item_name.') ';
//		add_to_sec_journal($proj_id, $jv_no, $jv_date, $dr_ledger, $narration, $total_amt, '0',   'Consumption', $$unique,'',$$unique,$cc_code);
//		add_to_sec_journal($proj_id, $jv_no, $jv_date, $cr_ledger, $narration, '0',  $total_amt, 'Consumption', $$unique,'',$$unique,$cc_code);
		unset($$unique);
		unset($_SESSION[$unique]);
		$type=1;
		$msg='Successfully Forwarded.';

    
}



if(isset($_POST['add'])&&($_POST[$unique]>0))
{
		$crud   = new crud($table_details);
		$iii=explode('#>',$_POST['item_id']);
		$_POST['item_id']=$iii[1];
		$_POST['entry_by']=$_SESSION['user']['id'];
		$_POST['entry_at']=date('Y-m-d h:s:i');
		$_POST['edit_by']=$_SESSION['user']['id'];
		$_POST['edit_at']=date('Y-m-d h:s:i');
		$xid = $crud->insert();
}

if($$unique>0)
{
		$condition=$unique."=".$$unique;
		$data=db_fetch_object($table_master,$condition);
		while (list($key, $value)=each($data))
		{ $$key=$value;}

}
if($$unique>0) $btn_name='Update OI Information'; else $btn_name='Initiate OI Information';
if($_SESSION[$unique]<1)
$$unique=db_last_insert_id($table_master,$unique);

//auto_complete_from_db($table,$show,$id,$con,$text_field_id);
$depot_type = find_a_field('warehouse','use_type','warehouse_id="'.$_SESSION['user']['depot'].'"');

auto_complete_from_db('item_info','item_id','concat(item_name,"#>",item_id)','1','item_id');
?>
<script language="javascript">
function focuson(id) {
  if(document.getElementById('item_id').value=='')
  document.getElementById('item_id').focus();
  else
  document.getElementById(id).focus();
}
window.onload = function() {
if(document.getElementById("warehouse_id").value>0)
  document.getElementById("item_id").focus();
  else
  document.getElementById("req_date").focus();
}
</script>
<script language="javascript">
function count()
{
var num=((document.getElementById('qty').value)*1)*((document.getElementById('rate').value)*1);
document.getElementById('amount').value = num.toFixed(2);	
}
</script>
<div class="form-container_large">
<form action="" method="post" name="codz" id="codz" onSubmit="if(!confirm('Are You Sure Execute this?')){return false;}">
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td valign="top"><fieldset>
    <? $field='oi_no';?>
      <div>
        <label for="<?=$field?>">OI  No: </label>
        <input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>"/>
      </div>
	<? $field='oi_date'; if($oi_date=='') $oi_date =''; ?>
      <div>
        <label for="<?=$field?>">OI Date:</label>
        <input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>" readonly="readonly" required/>
      </div>
	  
	  <div>
        <label >Req No.:</label>
        <select name="req_no" id="req_no"  onchange="getData2('organization_ajax.php', 'org',this.value,document.getElementById('warehouse_id').value);">
			<option></option>
			<? foreign_relation('requisition_master_stationary','req_no','req_no',$req_no,' status="PRE-CHECKED"');?>
		</select>
      </div>
	  
    <? $field='requisition_from';?>
      <div>
        <label for="<?=$field?>">Requisition From:</label>
        <input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>" required/>
      </div>

        <input  name="warehouse_id" type="hidden" id="warehouse_id" value="<?=$_SESSION['user']['depot']?>"  required/>

        <input  name="issue_type" type="hidden" id="issue_type" value="<?=$page_for?>"  required="required"/>
    </fieldset></td>
    <td>
			<fieldset>
			
    <? $field='oi_subject';?>
      <div>
        <label for="<?=$field?>">Note:</label>
        <input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>" required/>
      </div>
      <div></div>
	  <? auto_complete_from_db('personnel_basic_info','PBI_NAME','PBI_ID','PBI_JOB_STATUS like "In Service"','issued_to');?>
      <? $field='issued_to'; ?>
      <div>
        <label for="<?=$field?>">Issued To :</label>
		<input  name="" type="text" id="" readonly="" value="<?=find_a_field('personnel_basic_info','PBI_NAME','PBI_ID='.$$field)?>" />
        <input  name="<?=$field?>" type="hidden" id="<?=$field?>" value="<?=$$field?>" required="required"/>
      </div>
	  
	  <? $field='organization'; ?>
      <div>
        <label for="<?=$field?>">Organization :</label>
		
			<input  name="<?=$field?>" type="hidden" id="<?=$field?>" value="<?=$$field?>" />
			<input  name="organization2" type="text" id="organization2" value="<?=$organization2?>" readonly/>
		
      </div>
	  
      <div>
        <? $field='approved_by';?>
<div>
          <label for="<?=$field?>">Approved By :</label>
          <input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>" required/>
        </div>
      </div>
	  
	  <div>
        <? $field='manual_oi_no';?>
	  <div>
          <label for="<?=$field?>">SR No :</label>
          <input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?
		  	if($manual_oi_no>0){
				echo $manual_oi_no;
			}else{
				echo find_a_field('warehouse_other_issue','manual_oi_no',' issue_type = "Consumption" and warehouse_id='.$_SESSION['user']['depot'].' order by manual_oi_no desc')+1;
			}
		  ?>" required/>
        </div>
      </div>
			</fieldset>	</td>
  </tr>
  <tr>
    <td colspan="2"><div class="buttonrow" style="margin-left:240px;">
      <input name="new" type="submit" class="btn1" value="<?=$btn_name?>" style="width:250px; font-weight:bold; font-size:12px;" />
    </div></td>
    </tr>
</table>
</form>
<? if($_SESSION[$unique]>0){?>
<form action="?<?=$unique?>=<?=$$unique?>" method="post" name="cloud" id="cloud">
<table  width="100%" border="1" align="left"  style="border-collapse:collapse; border:1px solid #caf5a5;" cellpadding="2" cellspacing="2">
                      <tr>
                        <td align="center" bgcolor="#0099FF"><strong>Item Name</strong></td>
                        <td align="center" bgcolor="#0099FF"><strong>Stock</strong></td>
                        <td align="center" bgcolor="#0099FF"><strong>Unit</strong></td>
                        <td align="center" bgcolor="#0099FF"><strong>Price</strong></td>
                        <td align="center" bgcolor="#0099FF"><strong>Qty</strong></td>
						<td align="center" bgcolor="#0099FF"><strong>Remarks</strong></td>
                        <td align="center" bgcolor="#0099FF"><strong>Amount</strong></td>
                          <td  rowspan="2" align="center" bgcolor="#FF0000">
						  <div class="button">
						  <input name="add" type="submit" id="add" value="ADD" tabindex="12" class="update"/>                       
						  </div>				        </td>
      </tr>
                      <tr>
<td align="center" bgcolor="#CCCCCC">
  <input  name="issue_type" type="hidden" id="issue_type" value="<?=$page_for?>"  required="required"/>
  <input  name="<?=$unique?>" type="hidden" id="<?=$unique?>" value="<?=$$unique?>"/>
<input  name="warehouse_id" type="hidden" id="warehouse_id" value="<?=$warehouse_id?>"/>
<input  name="oi_date" type="hidden" id="oi_date" value="<?=$oi_date?>"/>
<input  name="issued_to" type="hidden" id="issued_to" value="<?=$issued_to?>"/>
<input  name="item_id" type="text" id="item_id" value="<?=$item_id?>" style="width:220px;" required onblur="getData2('<?=$ajax_page?>', 'po',this.value,document.getElementById('warehouse_id').value);"/></td>
<td colspan="3" align="center" bgcolor="#CCCCCC">
<span id="po">
<input name="stk" type="text" class="input3" id="stk" style="width:50px;" readonly="readonly"/>
<input name="unit" type="text" class="input3" id="unit" style="width:50px;" readonly="readonly"/>
<input name="price" type="text" class="input3" id="price" style="width:50px;"  readonly="readonly" required/>
</span></td>
<td align="center" bgcolor="#CCCCCC"><input name="qty" type="text" class="input3" id="qty"  maxlength="100" style="width:60px;" onchange="count()" required/></td>
<td align="center" bgcolor="#CCCCCC"><input name="remarks" type="text" class="input3" id="remarks"  maxlength="511" style="width:80px;"/></td>
<td align="center" bgcolor="#CCCCCC"><input name="amount" type="text" class="input3" id="amount" style="width:90px;" readonly="readonly" required/></td>
      </tr>
    </table>
					  <br /><br /><br /><br />


<table width="100%" border="0" cellspacing="0" cellpadding="0">

    <tr>
      <td>
<div class="tabledesign2">
<? 
$res='select a.id,b.item_name,a.rate as unit_price,a.qty ,a.unit_name, a.issued_to,a.remarks,a.amount,"x" from warehouse_other_issue_detail a,item_info b where b.item_id=a.item_id and a.oi_no='.$oi_no;
echo link_report_add_del_auto($res,'',4,7);
?>
</div>
</td>
    </tr>
	    	
	

				
    <tr>
     <td>

 </td>
    </tr>
  </table>
</form>
<form action="" method="post" name="cz" id="cz" onSubmit="if(!confirm('Are You Sure Execute this?')){return false;}">
  <table width="100%" border="0">
    <tr>
      <td align="center">&nbsp;</td>
      <td align="center">

      <input name="confirmm" type="submit" class="btn1" value="CONFIRM AND FORWARD RD" style="width:270px; font-weight:bold; font-size:12px; height:30px; color:#090" />

      </td>
    </tr>
  </table>
</form>
<? }?>
</div>
<script>$("#codz").validate();$("#cloud").validate();</script>
<?
$main_content=ob_get_contents();
ob_end_clean();
include ("../../template/main_layout.php");
?>