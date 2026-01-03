<?php

require_once "../../../assets/template/layout.top.php";



$title='Approving Purchase Order';



do_calander('#po_date');

do_calander('#invoice_date');

do_calander('#quotation_date');



$table_master='purchase_master';

$table_details='purchase_invoice';

$unique='po_no';





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

		$msg='Requisition No Created. (PO No :-'.$_SESSION[$unique].')';

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

		$type=1;

		$msg='Successfully Deleted.';

}

if(isset($_POST['confirmm']))

{

		unset($_POST);
		 $_POST[$unique]=$$unique;
		$_POST['checked_by']=$_SESSION['user']['id'];
		$_POST['checked_at']=date('Y-m-d h:s:i');
		$_POST['status']='CHECKED';
		$crud   = new crud($table_master);
		$crud->update($unique);
		//auto_insert_purchase_secoundary_update_packing($$unique);
		unset($$unique);
		unset($_SESSION[$unique]);
		$type=1;
		$msg='Successfully Forwarded to Relevant Department.';

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

		$crud->insert();

		unset($item_id);

}



if($$unique>0)

{

		$condition=$unique."=".$$unique;

		$data=db_fetch_object($table_master,$condition);

		while (list($key, $value)=each($data))

		{ $$key=$value;}

		

}

if($$unique>0) $btn_name='Update PO Information'; else $btn_name='Initiate PO Information';

if($_SESSION[$unique]<1)

$$unique=db_last_insert_id($table_master,$unique);





auto_complete_from_db('item_info','concat(item_name,"#>",item_id)','concat(item_name,"#>",item_id)','1 ','item_id');


?>

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

        <? $field='po_no';?>

        <div>

          <label for="<?=$field?>">PO  No: </label>

          <input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>"/>
        </div>

        <? $field='po_date';?>

        <div>

          <label for="<?=$field?>">PO Date:</label>

          <input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>" required="required"/>
        </div>

      

        <? $field='warehouse_id'; $table='warehouse';$get_field='warehouse_id';$show_field='warehouse_name';?>

        <div>

          <label for="<?=$field?>">Warehouse:</label>

          <select id="<?=$field?>" name="<?=$field?>" required="required">

            <option></option>

            <? foreign_relation($table,$get_field,$show_field,$$field);?>
          </select>
        </div>
		
		
		
      <? $field='vendor_id2'; $table='vendor'; $get_field='vendor_id2'; $show_field='vendor_name'; ?>

      <div>

        <label for="<?=$field?>">Party :</label>

		<span id="vendor_space">
		
	
<input name="<?=$field?>" type="text" id="<?=$field?>" value="<?php if($vendor_id>0){ 

$vendor = find_all_field('vendor','','vendor_id='.$vendor_id);

echo $vendor->vendor_name; }?>" readonly="readonly" />
<input  name="vendor_id" type="hidden" id="vendor_id" value="<?=$vendor->vendor_id?>"/>	  	


		</span> 

      </div>





<div>
<? $field='tax';?>

<label for="<?=$field?>">VAT:</label>

<input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>" required/>
</div>

      </fieldset></td>

      <td><fieldset>

	        <div>

        <? $field='invoice_no';?>

        <div>

          <label for="<?=$field?>">Invoice No:</label>

          <input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>"/>

        </div>

        <? $field='invoice_date';?>

        <div>

          <label for="<?=$field?>">Invoice Date:</label>

          <input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>"/>

        </div>
		
		<? $field='advance_payment';?>

        <div>

          <label for="<?=$field?>">Advance Payement:</label>

          <input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>"/>

        </div>
		
		
		
		<? $field='cheque_no';?>

        <div>

          <label for="<?=$field?>">Cheque No:</label>

          <input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>"/>

        </div>
		
		

        <div>

          <label>Of Bank:</label>

          <select name="of_bank" id="of_bank">
		  	<option></option>
			<? foreign_relation('bank','BANK_CODE','BANK_NAME',$of_bank);?>
		  </select>

        </div>


       


       

		      

      </div>
      </fieldset></td>
    </tr>

    <tr>
      <td colspan="2"><div align="center">
        <input name="new2" type="submit" class="btn1" value="<?=$btn_name?>" style="width:250px; font-weight:bold; font-size:12px;" />
      </div></td>
    </tr>
    <tr>

      <td colspan="2"><div class="buttonrow" style="margin-left:240px;">

        <div align="center"></div>
      </div></td>
    </tr>
  </table>

</form>





<? if($_SESSION[$unique]>0){?>

<table width="40%" border="1" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse">

  <tr>

    <td colspan="3" align="center" bgcolor="#CCFF99"><strong>Entry Information</strong></td>

    </tr>

  <tr>

    <td align="right" bgcolor="#CCFF99">Created By:</td>

    <td align="left" bgcolor="#CCFF99">&nbsp;&nbsp;<?=find_a_field('user_activity_management','fname','user_id='.$entry_by);?></td>

    <td rowspan="2" align="center" bgcolor="#CCFF99"><a href="po_print_view.php?po_no=<?=$po_no?>" target="_blank"><img src="../../images/print.png" width="26" height="26" /></a></td>

  </tr>

  <tr>

    <td align="right" bgcolor="#CCFF99">Created On:</td>

    <td align="left" bgcolor="#CCFF99">&nbsp;&nbsp;<?=$entry_at?></td>

    </tr>

</table>

<form action="?<?=$unique?>=<?=$$unique?>" method="post" name="cloud" id="cloud" onSubmit="if(!confirm('Are You Sure Execute this?')){return false;}">

  <table  width="100%" border="1" align="left"  style="border-collapse:collapse; border:1px solid #caf5a5;" cellpadding="2" cellspacing="2">

                      <tr>

                        <td width="10%" align="center" bgcolor="#0099FF"><strong>Item Name</strong></td>

                        <td width="9%" align="center" bgcolor="#0099FF"><strong>Stock</strong></td>

                        <td width="9%" align="center" bgcolor="#0099FF"><strong>Unit</strong></td>

                        <td width="9%" align="center" bgcolor="#0099FF"><strong>Price</strong></td>

                        <td width="12%" align="center" bgcolor="#0099FF"><strong>Qty</strong></td>

                        <td width="15%" align="center" bgcolor="#0099FF"><strong>Amount</strong></td>

                          <td width="6%"  rowspan="2" align="center" bgcolor="#FF0000">

						  <div class="button">

						  <input name="add" type="submit" id="add" value="ADD" tabindex="12" class="update"/>                       
					    </div>				        </td>
      </tr>

                      <tr>

<td align="center" bgcolor="#CCCCCC">

<input  name="<?=$unique?>" type="hidden" id="<?=$unique?>" value="<?=$$unique?>"/>

<input  name="warehouse_id" type="hidden" id="warehouse_id" value="<?=$warehouse_id?>"/>

<input  name="po_date" type="hidden" id="po_date" value="<?=$po_date?>"/>

<input  name="vendor_id" type="hidden" id="vendor_id" value="<?=$vendor_id?>"/>

<input  name="item_id" type="text" id="item_id" value="<?=$item_id?>" style="width:247px;" required onblur="getData2('po_ajax.php', 'po',this.value,document.getElementById('warehouse_id').value);"/></td>

<td colspan="3" align="center" bgcolor="#CCCCCC">

  <div align="right"><span id="po">
    <span id="po">
    <input name="stk" type="text" class="input3" id="stk" style="width:110px;float:left;" readonly="readonly"/>
    </span>
    <input name="unit" type="text" class="input3" id="unit" style="width:110px;float:left;" readonly="readonly"/>
    
    <input name="price" type="text" class="input3" id="price" style="width:100px;float:left;"  readonly="readonly"/>
  </span></div></td>

<td align="center" bgcolor="#CCCCCC"><input name="qty" type="text" class="input3" id="qty"  maxlength="100" style="width:120px;" onchange="count()" required/></td>

<td align="center" bgcolor="#CCCCCC"><input name="amount" type="text" class="input3" id="amount" style="width:130px;" readonly="readonly" required/></td>
      </tr>
    </table>

  <br /><br /><br />





<table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr>

<td>

<div class="tabledesign2">

<? 

$res='select a.id,b.finish_goods_code as Item_code, concat(b.sku_code," - ",b.item_name) as item_description , a.qty as Quantity ,a.unit_name as Unit, a.rate as unit_price,a.amount,"x" from purchase_invoice a,item_info b where b.item_id=a.item_id and a.po_no='.$po_no;

echo link_report_add_del_auto($res,'',4,7);

?>

</div>

</td>

</tr>

</table>

</form>

<form action="" method="post" name="cz" id="cz" onSubmit="if(!confirm('Are You Sure Execute this?')){return false;}">

  <table width="100%" border="0">

    <tr>

      <td align="center">



      <input name="delete"  type="submit" class="btn1" value="DELETE AND CANCEL PO" style="width:270px; font-weight:bold; font-size:12px;color:#F00; height:30px" />



      </td>

      <td align="center">



      <input name="confirmm" type="submit" class="btn1" value="CONFIRM AND FORWARD PO" style="width:270px; font-weight:bold; font-size:12px; height:30px; color:#090" />



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