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


if($_GET['mhafuz']>0){
	unset($_SESSION[$unique]);
}

if($_POST['old_oi_no']>0){
	$_SESSION[$unique] = $_POST['old_oi_no'];
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
		if($_POST['oi_date'] != ''){
			echo $sql = "update ".$table_details." set oi_date = '".$_POST['oi_date']."' where ".$unique." = ".$_POST['oi_no'];
				mysql_query($sql);
		}
		$msg='Successfully Updated.';
		}
		
		header('Location:packing_issue.php');
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
        $req = $_POST['req_noo'];
		unset($_POST);
		$_POST[$unique]=$$unique;
		$_POST['entry_by']=$_SESSION['user']['id'];
		$_POST['entry_at']=date('Y-m-d h:s:i');
		$_POST['status']='UNCHECKED';
		$crud   = new crud($table_master);
		$crud->update($unique);
		$total_amt = 0;
		
		if($req>0){
			echo'ar'; $sql = "update requisition_master_stationary set status = 'COMPLETE' where req_no = ".$req;
			mysql_query($sql);
		}
		
		/*$sql = 'select * from warehouse_other_issue_detail where oi_no='.$$unique;
		$query = mysql_query($sql);
		while($oii = mysql_fetch_object($query)){
		journal_item_control($oii->item_id, $_SESSION['user']['depot'],$oii->oi_date,0,$oii->qty,$page_for,$oii->id,$oii->rate,'',$$unique);
		$total_amt = $total_amt + ($oii->qty*$oii->rate);
		$oi_date = $oii->oi_date;
		}
		$jv_date = strtotime($oi_date);
		$jv_no=next_journal_sec_voucher_id('',$page_for);
		$cc_code = find_a_field_sql("select w.cc_code from warehouse w where  w.warehouse_id=".$_SESSION['user']['depot']);

		$narration = 'Packing Consumption # '.$$unique.' Issue of '.date('F',$jv_date);
		add_to_sec_journal($proj_id, $jv_no, $jv_date, '4007000500000000', $narration, $total_amt, '0',   'Consumption', $$unique,'',$$unique,$cc_code);
		add_to_sec_journal($proj_id, $jv_no, $jv_date, '1172000300000000', $narration, '0',  $total_amt, 'Consumption', $$unique,'',$$unique,$cc_code);*/
		
		unset($$unique);
		unset($_SESSION[$unique]);
		$type=1;
		$msg='Successfully Forwarded.';
}


if(isset($_POST['add'])&&($_POST[$unique]>0))
{

	if($_POST['stock'] >= $_POST['qty'])
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
		else
		{
		echo "<script>alert('Not Engough Stock!!!');</script>";
		//echo "<script>alert(" . json_encode($_POST['qty']) . ");</script>";

		
		}
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
	<? $field='oi_date';  ?>
      <div>
        <label for="<?=$field?>">OI Date:M</label>
        <input  name="<?=$field?>" type="date" id="<?=$field?>" value="<?=$$field?>"  required="required" />
      </div>
	  
	  <div>
        <label >Req No.:</label>
        <select name="req_no" id="req_no"  onchange="getData2('organization_ajax.php', 'org',this.value,document.getElementById('warehouse_id').value);">
			<option></option>
			<? foreign_relation('requisition_master_stationary','req_no','concat(req_no,"-",req_date)',$req_no,' status="APPROVED"');?>
		</select>
      </div>
	  
	  <? $field='oi_subject';?>
      <div>
        <label for="<?=$field?>">Note:</label>
        <input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>" />
      </div>
	  
        <input  name="warehouse_id" type="hidden" id="warehouse_id" value="<?=$_SESSION['user']['depot']?>"  required/>

        <input  name="issue_type" type="hidden" id="issue_type" value="<?=$page_for?>"  required="required"/>
    </fieldset></td>
    <td>
			<fieldset>
	<span id="org">	
       <? $field='requisition_from';?>
      <div>
        <label for="<?=$field?>">Requisition From:</label>
        <input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>" required/>
      </div>
	  
      <div></div>
	  <?php /*?><? auto_complete_from_db('personnel_basic_info','PBI_NAME','PBI_ID','PBI_JOB_STATUS like "In Service"','issued_to');?><?php */?>
      <? $field='issued_to'; ?>
	  
      <div>
        <label for="<?=$field?>">Issued To :</label>
        <input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>" required="required"/>
      </div>
	  
	  <? $field='organization'; ?>
      <div>
        <label for="<?=$field?>">Organization : <?=$organization;?></label>
		
			
			<select  name="organization" id="organization" value="<?=$organization2?>" required >
				<!--<option></option>-->
				<? foreign_relation('user_group','id','group_name',$organization,' 1');?>			</select>
		
      </div>
	  
      <div>
        <? $field='approved_by';?>
		<div>
          <label for="<?=$field?>">Approved By :</label>
          <input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>"/>
        </div>
      </div>
	 </span>
	  
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
                        <td align="center" style="width:45px" bgcolor="#0099FF"><strong>Stock</strong></td>
                        <td align="center" style="width:45px" bgcolor="#0099FF"><strong>Unit</strong></td>
                        <td align="center" style="width:45px" bgcolor="#0099FF"><strong>Price</strong></td>
						<td align="center" style="width:45px" bgcolor="#0099FF"><strong>Req qty</strong></td>
						<td align="center" style="width:45px" bgcolor="#0099FF"><strong>unDel qty</strong></td>
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
	 <input  name="<?=$unique?>" type="hidden" id="<?=$unique?>" value="<?=$$unique?>"  required="required"/>
  <input  name="issue_type" type="hidden" id="issue_type" value="<?=$page_for?>"  required="required"/>
  <input  name="<?=$unique?>" type="hidden" id="<?=$unique?>" value="<?=$$unique?>"/>
<input  name="warehouse_id" type="hidden" id="warehouse_id" value="<?=$warehouse_id?>"/>
<input  name="oi_date" type="hidden" id="oi_date" value="<?=$oi_date?>"/>
<input  name="issued_to" type="hidden" id="issued_to" value="<?=$issued_to?>"/>
<? if($req_no>0){  ?>

	<select  name="item_id" type="text" id="item_id2"  style="width:220px;" required onchange="getData2('requisition_item_ajax.php', 'po',this.value,document.getElementById('warehouse_id').value+'##'+document.getElementById('req_no').value);" auto/>
	<option></option>
	<? foreign_relation('item_info i, requisition_order_stationary d','concat(i.item_name,"#>",i.item_id,"#>",d.id)','i.item_name',$item_id,' i.item_id=d.item_id and d.req_no='.$req_no);?>
	</select>
	
<? }else{ ?>
	<input  name="item_id" type="text" id="item_id" value="<?=$item_id?>" style="width:220px;" required onblur="getData2('<?=$ajax_page?>', 'po',this.value,document.getElementById('warehouse_id').value);"/>
<? } ?>
</td>
<td colspan="5" align="center" bgcolor="#CCCCCC">
<span id="po">
<table style="width:100%">
	<tr>
		<td><input name="stk" type="text" class="input3" id="stk"  readonly="readonly"/></td>
		<td><input name="unit_name" type="text" class="input3" id="unit_name"  readonly="readonly"/></td>
		<td><input name="price" type="text" class="input3" id="price"   readonly="readonly" required/></td>
		<td><input name="undel_qty" type="text" class="input3" id="undel_qty"   readonly="readonly" /></td>
	</tr>
</table>
</span>

</td>
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
$res='select a.id,b.item_name,a.rate as unit_price,a.qty ,a.unit_name,a.remarks,a.amount,"x" from warehouse_other_issue_detail a,item_info b where b.item_id=a.item_id and a.oi_no='.$oi_no;
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
      <td align="center"><input name="delete" type="submit" class="btn1" value="Delete" style="width:270px; font-weight:bold; font-size:12px; height:30px; color:#FF0000" /></td>
      <td align="center">
	  <input name="req_noo" id="req_noo" type="hidden" value="<?=$req_no;?>" />	
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