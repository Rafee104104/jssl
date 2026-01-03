<?php

session_start();

ob_start();



require "../../../warehouse_mod/support/inc.all.php";

// ::::: Start Edit Section ::::: 

$title='MRR Entry Delete';			// Page Name and Page Title







$pr_no = $_REQUEST['pr_no'];







if($pr_no>0 && $_POST['type']=="head")

{	

	$sql2 = "DELETE FROM `journal_item` WHERE tr_no=".$pr_no." and tr_from ='Purchase'";

	mysql_query($sql2);

	$sql3 = "DELETE FROM `secondary_journal` WHERE tr_no=".$pr_no." and tr_from ='Purchase'";

	mysql_query($sql3);
	
	$sql4 = "DELETE FROM `journal` WHERE tr_no=".$pr_no." and tr_from ='Purchase'";

	mysql_query($sql4);
	
	
	
 $s="select item_id,rec_date,qty, id,rate, pr_no,pr_status,vendor_id,po_no from purchase_receive where pr_no='".$pr_no."'";







$q = mysql_query($s);



while($data = mysql_fetch_object($q)){
	
	$pr_no=$data->pr_no;
	
	$vendor_id=$data->vendor_id;
	
	$rec_date=$data->rec_date;
	
	$po_no=$data->po_no;
	
	journal_item_control($data->item_id,$_SESSION['user']['depot'],$data->rec_date,$data->qty,0,'Purchase',$data->id,$data->rate,'',$data->pr_no);







}



$vendor = find_all_field('vendor','ledger_id','vendor_id='.$vendor_id);

		

		

		

$vendor_ledger = $vendor->ledger_id;

$jv=next_journal_sec_voucher_id();

		




$pr_recvSql='select item_id,tax,amount as tot_amount from purchase_receive where pr_no='.$pr_no.'';

$pr_recvQuery=mysql_query($pr_recvSql);

 while($pr_recvData=mysql_fetch_object($pr_recvQuery)){

$pr_amt  = $pr_recvData->tot_amount;

$tax_amt = (($pr_recvData->tot_amount*$pr_recvData->tax)/100);



$ledger = find_a_field('item_group ig, item_sub_group isg, item_info ii','isg.sub_group_id',' ii.sub_group_id=isg.sub_group_id and isg.group_id=ig.group_id and ii.item_id='.$pr_recvData->item_id);
$ledger_id = find_all_field('item_sub_group','','sub_group_id='.$ledger);




$sales_ledger = $ledger_id->ledger_id;
$pending_ledger = $ledger_id->ledger_id_2;

$tax_ledger =  find_a_field('config_group_class','vat_ledger','group_for=2');

if($ledger_id->group_id == '1100000000'){

auto_insert_purchase_secoundary($jv,$rec_date,$vendor_ledger,$sales_ledger,$pr_no,$pr_amt,$po_no,'0',$tax_amt,$tax_ledger);
}

else{
auto_insert_purchase_secoundary_new($jv,$rec_date,$vendor_ledger,$pending_ledger,$pr_no,$pr_amt,$po_no,'0',$tax_amt,$tax_ledger,$sales_ledger);
}

}
	
	
	
	
	
	
	






}
else {
	
	
	$sql2 = "DELETE FROM `journal_item` WHERE tr_no=".$pr_no." and tr_from ='Local Purchase'";

	mysql_query($sql2);

	$sql3 = "DELETE FROM `secondary_journal` WHERE tr_no=".$pr_no." and tr_from ='Local Purchase'";

	mysql_query($sql3);
	
	$sql4 = "DELETE FROM `journal` WHERE tr_no=".$pr_no." and tr_from ='Local Purchase'";

	mysql_query($sql4);
	
	
	
 $s="select item_id,rec_date,qty, id,rate, pr_no,pr_status,vendor_id,po_no from purchase_receive_local where pr_no='".$pr_no."'";







$q = mysql_query($s);



while($data = mysql_fetch_object($q)){
	
	$pr_no=$data->pr_no;
	
	$vendor_id=$data->vendor_id;
	
	$rec_date=$data->rec_date;
	
	$po_no=$data->po_no;
	
	journal_item_control($data->item_id,$_SESSION['user']['depot'],$data->rec_date,$data->qty,0,'Local Purchase',$data->id,$data->rate,'',$data->pr_no);







}



$vendor = find_all_field('vendor','ledger_id','vendor_id='.$vendor_id);

		

		

		

$vendor_ledger = $vendor->ledger_id;

$jv=next_journal_sec_voucher_id();

		




$pr_recvSql='select item_id,tax,amount as tot_amount from purchase_receive_local where pr_no='.$pr_no.'';

$pr_recvQuery=mysql_query($pr_recvSql);

 while($pr_recvData=mysql_fetch_object($pr_recvQuery)){

$pr_amt  = $pr_recvData->tot_amount;

$tax_amt = (($pr_recvData->tot_amount*$pr_recvData->tax)/100);



$ledger = find_a_field('item_group ig, item_sub_group isg, item_info ii','isg.sub_group_id',' ii.sub_group_id=isg.sub_group_id and isg.group_id=ig.group_id and ii.item_id='.$pr_recvData->item_id);
$ledger_id = find_all_field('item_sub_group','','sub_group_id='.$ledger);




$sales_ledger = $ledger_id->ledger_id;
$pending_ledger = $ledger_id->ledger_id_2;

$tax_ledger =  find_a_field('config_group_class','vat_ledger','group_for=2');

if($ledger_id->group_id == '1100000000'){

auto_insert_local_purchase_secoundary($jv,$rec_date,$vendor_ledger,$sales_ledger,$pr_no,$pr_amt,$po_no,'0',$tax_amt,$tax_ledger);
}

else{
auto_insert_local_purchase_secoundary_new($jv,$rec_date,$vendor_ledger,$pending_ledger,$pr_no,$pr_amt,$po_no,'0',$tax_amt,$tax_ledger,$sales_ledger);
}

}
	
	
	
	
	


	
}



	?>

<style type="text/css">

<!--

.style1 {

	color: #FF0000;

	font-weight: bold;

}

.style2 {

	color: #006600;

	font-weight: bold;

}

-->

</style>

<? 

if($found=="YES"){

?>

		<title>MRR Delete</title><table width="50%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FF0000">

      <tr>

        <td><div align="center" class="style2">Sorry Journal Exists! </div></td>

      </tr>

    </table>

<? 

}

elseif($pr_no>0)

{



?>

		<table width="50%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#99FF66">

      <tr>

        <td><div align="center" class="style2">MRR Re-hit Successfull </div></td>

      </tr>

    </table>

<? }?>



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

           	 <table width="85%" border="0" align="center" cellpadding="5" cellspacing="0">

  <tr>
  
  	 <td height="35" bgcolor="#33CCFF"><strong>MRR Type: </strong></td>

    <td bgcolor="#33CCFF">
	<select name="type" id="type">
	
	<option value="head">Head Office</option>
	<option value="local">Factory</option>
	
	</select>
	</td>

    <td height="35" bgcolor="#33CCFF"><strong>MRR NO: </strong></td>

    <td bgcolor="#33CCFF"><input name="pr_no" type="text" id="pr_no" maxlength="16" value="<?=$pr_no?>" required /></td>

    <td align="center" valign="middle" bgcolor="#33CCCC"><input name="search" type="submit" id="search" value="Re-hit MRR" /></td>

  </tr>

  



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