<?php

require_once "../../../assets/template/layout.top.php";


// ::::: Start Edit Section ::::: 

$title='Duplicate Item Tranfer and Remove';			// Page Name and Page Title

$page="old_2_new_item.php";			// PHP File Name





// ::::: End Edit Section :::::

do_calander('#chalan_date');



$chalan_no = $_REQUEST['chalan_no'];

$crud      =new crud($table);



$$unique = $_GET[$unique];



	$old_ledger = $_REQUEST['old_ledger'];

	$new_ledger = $_REQUEST['new_ledger'];



if(isset($_REQUEST['change_ledger'])&&$_REQUEST['old_ledger']>0&&$_REQUEST['new_ledger']>0&&$_REQUEST['new']!=''&&$_REQUEST['new_ledger']!='')

{

	$old_ledger = $_REQUEST['old_ledger'];

	$new_ledger = $_REQUEST['new_ledger'];



$sql1 = "update journal_item set item_id = '".$new_ledger."' where item_id='".$old_ledger."'";

$sql2 = "update production_floor_issue_master set item_id = '".$new_ledger."' where item_id='".$old_ledger."'";

$sql3 = "update production_floor_issue_detail set item_id = '".$new_ledger."' where item_id='".$old_ledger."'";

$sql4 = "update purchase_invoice set item_id = '".$new_ledger."' where item_id='".$old_ledger."'";

$sql5 = "update requisition_order set item_id = '".$new_ledger."' where item_id='".$old_ledger."'";

$sql6 = "update purchase_receive set item_id = '".$new_ledger."' where item_id='".$old_ledger."'";

$sql7 = "update master_requisition_details set item_id = '".$new_ledger."' where item_id='".$old_ledger."'";

$sql8 = "update production_issue_detail set item_id = '".$new_ledger."' where item_id='".$old_ledger."'";

$sql9 = "update warehouse_other_issue set item_id = '".$new_ledger."' where item_id='".$old_ledger."'";

$sql10 = "update production_floor_receive_detail set item_id = '".$new_ledger."' where item_id='".$old_ledger."'";

$sql11 = "update production_line_fg set item_id = '".$new_ledger."' where item_id='".$old_ledger."'";

$sql12 = "update production_line_raw set item_id = '".$new_ledger."' where item_id='".$old_ledger."'";

$sql13 = "update warehouse_other_receive_detail set item_id = '".$new_ledger."' where item_id='".$old_ledger."'";

$sql14 = "update purchase_invoice_local set item_id = '".$new_ledger."' where item_id='".$old_ledger."'";

$sql15 = "update purchase_receive_local set item_id = '".$new_ledger."' where item_id='".$old_ledger."'";

$sql16 = "update Sales_damage_receive_detail set item_id = '".$new_ledger."' where item_id='".$old_ledger."'";

$sql17 = "update warehouse_damage_receive_detail set item_id = '".$new_ledger."' where item_id='".$old_ledger."'";

$sql18 = "update production_floor_return_detail set item_id = '".$new_ledger."' where item_id='".$old_ledger."'";

$sql19 = "update purchase_item_return_details set item_id = '".$new_ledger."' where item_id='".$old_ledger."'";

$sql20 = "update sale_other_details set item_id = '".$new_ledger."' where item_id='".$old_ledger."'";

$sql21 = "update direct_sale_chalan set item_id = '".$new_ledger."' where item_id='".$old_ledger."'";

$sql22 = "update direct_sale_details set item_id = '".$new_ledger."' where item_id='".$old_ledger."'";

$sql23 = "update sale_do_details set item_id = '".$new_ledger."' where item_id='".$old_ledger."'";

$sql24 = "update sale_do_chalan set item_id = '".$new_ledger."' where item_id='".$old_ledger."'";

$sql25 = "update warehouse_other_issue_detail set item_id = '".$new_ledger."' where item_id='".$old_ledger."'";

$sql26 = "update requsition_order_local set item_id = '".$new_ledger."' where item_id='".$old_ledger."'";




	

	

	@mysql_query($sql1);@mysql_query($sql2);@mysql_query($sql3);@mysql_query($sql4);@mysql_query($sql5);@mysql_query($sql6);@mysql_query($sql7);@mysql_query($sql8);@mysql_query($sql9);@mysql_query($sql10);@mysql_query($sql11);@mysql_query($sql12);@mysql_query($sql13);@mysql_query($sql14);@mysql_query($sql15);@mysql_query($sql16);@mysql_query($sql17);@mysql_query($sql18);@mysql_query($sql19);@mysql_query($sql20);@mysql_query($sql21);@mysql_query($sql22);@mysql_query($sql23);@mysql_query($sql24);@mysql_query($sql25);@mysql_query($sql26);

	//$sql5 = 'delete from item_info where item_id = "'.$old_ledger.'"';

	//mysql_query($sql5);

echo "Data Transfer successfully done.";
}

?><title>AFPL MIS</title>

<form action="" method="post">

<div class="oe_view_manager oe_view_manager_current">

        

    <? include('../../common/title_bar.php');?>

        <div class="oe_view_manager_body">

            

                <div  class="oe_view_manager_view_list"></div>

            

                <div class="oe_view_manager_view_form"><div style="opacity: 1;" class="oe_formview oe_view oe_form_editable">

        <div class="oe_form_buttons"></div>

        <div class="oe_form_sidebar"></div>

        <div class="oe_form_pager"></div>

        <div class="oe_form_container"><div class="oe_form">

          <div class="">

<div class="oe_form_sheetbg" style="min-height:10px;">

        <div class="oe_form_sheet oe_form_sheet_width">



          <div  class="oe_view_manager_view_list"><div  class="oe_list oe_view">

           	 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">

  <tr>

    <td height="35" bgcolor="#33CCFF"><strong>Duplicate Item ID : </strong></td>

    <td bgcolor="#33CCFF"><strong>

      <label>

      <input name="old_ledger" type="text" id="old_ledger" maxlength="16" value="<?=$old_ledger?>" required <? if($new_ledger>0&&$old_ledger>0) echo 'readonly';?> / class="form-control">

        </label>

    </strong></td>

    <td rowspan="2" align="center" valign="middle" bgcolor="#33CCCC"><strong>

      <label>

      <input name="search" type="submit" id="search" value="Search Item"  style="width:100px;"/ class="form-control">

        </label>

    </strong></td>

  </tr>

  <tr>

    <td height="35" bgcolor="#FFCCCC"><strong>Real Item ID : </strong></td>

    <td bgcolor="#FFCCCC"><input name="new_ledger" type="text" id="new_ledger" maxlength="16" value="<?=$new_ledger?>" required <? if($new_ledger>0&&$old_ledger>0) echo 'readonly';?>/ class="form-control"></td>

    </tr>

  <? if($new_ledger>0&&$old_ledger>0){?>

  

    <tr>

    <td bgcolor="#FFFFFF">&nbsp;</td>

    <td bgcolor="#FFFFFF">&nbsp;</td>

    <td bgcolor="#FFFFFF">&nbsp;</td>

  </tr>

  <tr>

    <td height="35" colspan="2" align="center" valign="middle" bgcolor="#33CCCC"><label>

      <input name="old" type="text" id="old" value="<?=find_a_field('item_info','item_name','item_id='.$old_ledger);?>" style="width:320px; font-size:11px;" / class="form-control">

      transfer to 

      <input name="new" type="text" id="new" value="<?=find_a_field('item_info','item_name','item_id='.$new_ledger);?>" style="width:320px;font-size:11px;" / class="form-control">

    </label></td>

    <td bgcolor="#CC99CC"><div align="center">

      <input name="change_ledger" type="submit" id="change_ledger" value="Transfer & Delete"  style="width:130px;" / class="form-control">

    </div></td>

  </tr>

  <? }?>

</table>



		

		  

          </div></div>

          </div>

    </div>

    <div class="oe_chatter"><div class="oe_followers oe_form_invisible">

      <div class="oe_follower_list"></div>

    </div></div></div></div></div>

    </div></div>

            

        </div>

  </div>

</form>

<?

require_once "../../../assets/template/layout.bottom.php";

?>