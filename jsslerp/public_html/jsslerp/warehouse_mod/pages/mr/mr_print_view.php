<?php
require_once "../../../assets/template/layout.top.php";

$oi_no 		= $_REQUEST['req_no'];

  		  $barcode_content = $oi_no;
		  $barcodeText = $barcode_content;
          $barcodeType='code128';
		  $barcodeDisplay='horizontal';
          $barcodeSize=40;
          $printText='';
		  
$group = find_all_field('user_group','','id="'.$_SESSION['user']['group'].'"');
$req_no 		= $_REQUEST['req_no'];

$sql="select * from requisition_master where  req_no='$req_no'";
$data=mysql_query($sql);
$all=mysql_fetch_object($data);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Requsition Copy</title>
<link href="../../../assets/css/invoice.css" type="text/css" rel="stylesheet"/>
	<?php include("../../../assets/css/theme_responsib_new_table_report.php");?>
<script type="text/javascript">
function hide()
{
    document.getElementById("pr").style.display="none";
}
</script>
    <style type="text/css">
        #pr input[type="button"] {
            width: 70px;
            height: 25px;
            background-color: #6cff36;
            color: #333;
            font-weight: bolder;
            border-radius: 5px;
            border: 1px solid #333;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div id="pr">
    <h5 align="center"> <input name="button" type="button" onclick="hide();window.print();" value="Print" /></h5>
</div>

<table width="1200px" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
      <td>
	  
	  <div class="header">
		<table class="table1">
		<tr>
		<td class="logo">
			<img src="../../../logo/1.png" class="logo-img"/>
		</td>
		
		<td class="titel">
				<h2 class="text-titel"> <?=$group->group_name?> </h2>			
				<p class="text"><b><?=find_a_field('user_group','address','1')?></b></p>
				<p class="text" style="line-height: 0px !important;"><?=find_a_field('user_group','factory_address','1')?></p>
				<?php /*?><p class="text">Cell: <?=$group->mobile?>. Email: <?=$group->email?> <br> <?=$group_data->vat_reg?></p><?php */?>
				<p class="text" style="line-height: 30px !important;"> <b>Warehouse:
                     <? $war=find_all_field('warehouse','','warehouse_id='.$all->warehouse_id);
                      echo $war->warehouse_name;?></b>
				</p>
		</td>
		
		
		<td class="Qrl_code">
				<?php /*?>	<?='<img class="barcode Qrl_code_barcode" alt="'.$barcodeText.'" src="barcode.php?text='.$barcodeText.'&codetype='.$barcodeType.'&orientation='.$barcodeDisplay.'&size='.$barcodeSize.'&print='.$printText.'"/>' ?>
			<p class="qrl-text"><?=$all->req_no;?></p><?php */?>
		</td>
		
		</tr>
		 
		</table>
	</div>
	
 
      </td>
  </tr>
  <tr>
    
	<td>	</td>
  </tr>
  <tr>
    <td><div class="line"></div></td>
  </tr>
	<tr><td style="text-align:center"><p><span style="font-weight:bold; font-size:24px;">Purchase Requisition</span></td></tr></br>
    <tr>
        <td><div class="header2">
                <div class="header2_left">
                    <p style="font-size:16px"><strong>Date:</strong> <?php echo $all->req_date;?><br />
                        <strong>Requisition  No :</strong>  <?php echo $all->req_no;?><br />
                        <strong>Requisition For :</strong>  <?php echo $all->req_for;?><br />
						<strong>Note : </strong> <?php echo $all->req_note;?><br />
                        <strong>Need By :</strong> <?php echo $all->need_by;?><br />
                    </p>
                </div>
                <?php /*?><div class="header2_right" style="text-align:right">
                    <p>
                        <strong>Note : </strong> <?php echo $all->req_note;?><br />
                        <strong>Need By :</strong> <?php echo $all->need_by;?><br />
                    </p>
                </div><?php */?>
            </div></td>
    </tr>

  <tr>
<td>
<br /><br />
<table width="100%" class="tabledesign" border="1" bordercolor="#000000" cellspacing="2" cellpadding="2" style="border-collapse:collapse;">
       <tr bgcolor="#C0C0C0">
        <td width="2%"><strong>SL.</strong></td>
        <td><strong>REQ-ID</strong></td>
        <td><strong>Description of the Goods </strong></td>
		<td><strong>Remarks</strong></td>
        <td><strong>In Stock</strong></td>
		<td><strong>Last Pur. Price</strong></td>
        <td><strong>Last Pur. Date</strong></td>
        <td><strong>Last Pur. QTY</strong></td>
		  <td><strong>Unit</strong></td>
        <td><strong>Req QTY</strong></td>
		<td><strong>Est. Price</strong></td>
		<td><strong>Est. Amount</strong></td>
       </tr>
	  <?php
$final_amt=(int)$data1[0];
$pi=0;
$total=0;
$sql2="select * from requisition_order where  req_no='$req_no'";
$data2=mysql_query($sql2);
//echo $sql2;
while($info=mysql_fetch_object($data2)){ 
$pi++;
$amount=$info->qty*$info->rate;
$total=$total+($info->qty*$info->rate);
$sl=$pi;
$item=find_all_field('item_info','concat(item_name," : ",	item_description)','item_id='.$info->item_id);
$qty=$info->qty;
$qoh=$info->qoh;
/*$last_p = find_all_field('purchase_invoice','','item_id="'.$item_id.'" order by id desc');
*/
$last_p_date=$info->last_p_date;
$last_p_date=$info->last_p_date;
$last_p_qty=$info->last_p_qty;
$item_for=$info->item_for;
$total_qty +=$qty;
$totp+=$info->est_price;
?>
      <tr>
        <td valign="top" style="font-size:18px;"><?=$sl?></td>
        <td align="left" valign="top" style="font-size:18px;"><?=$info->id?></td>
        <td align="left" valign="top" style="font-size:18px;">Code:<?=$info->item_id?><br><?=$item->item_name.' : '.$item->item_description?></td>
        <td valign="top" style="font-size:18px;"><?=$info->remarks?></td>
		<td valign="top" style="font-size:18px;"><?=$qoh?></td>
		<td valign="top" style="font-size:18px;"><?=$info->last_pur_rate?></td>
        <td valign="top" style="font-size:18px;"><?=$last_p_date?></td>
        <td align="center" valign="top" style="font-size:18px;"><?=$last_p_qty?></td>
        <td valign="top" style="font-size:18px;"><?=$item->unit_name?></td>
		<td valign="top" style="font-size:18px;"><?=$qty?></td>
		<td valign="top" style="font-size:18px;"><?=$info->est_price?></td>
		<td valign="top" style="font-size:18px;"><?=$info->est_price*$qty; $tot_amt+=$info->est_price*$qty;?></td>
      </tr>
<? }?>
<tr bgcolor="#C0C0C0">
 <th colspan="9" style="text-align:right;">Total</th>
 <th align="right"><?=number_format($total_qty,2)?></th>
  <th align="right"><?=number_format($totp,2)?></th>
  <th><?=number_format($tot_amt,2)?></th>
</tr>
    </table></td>
  </tr>
  <tr>
    <td height="187" style="text-align:left; margin-left:50px;">

    <div class="footer1">
            <table width="1676" border="0">
			<tr><td height="58"></td>
			</tr>
			<tr><td></td></tr>
			<tr><td></td></tr>
				

                <tr>
					<td width="33" align="center"></td>
                    <td width="121" align="center" style="font-size:14px;"><?=find_a_field('user_activity_management','fname','user_id='.$all->entry_by)?></td>
					<td width="216" align="center" style="font-size:14px;"><?=find_a_field('user_activity_management','fname','user_id='.$all->approve0_id)?></td>
                    <td width="216" align="center" style="font-size:14px;"><?=find_a_field('user_activity_management','fname','user_id='.$all->approve2_id)?></td>
                    <td width="168" align="center" style="font-size:14px;"><?=find_a_field('user_activity_management','fname','user_id='.$all->approve1_id)?></td>
					<td width="196" align="center" style="font-size:14px;"><?=find_a_field('user_activity_management','fname','user_id='.$all->approve3gm_id)?></td>
					<td width="196" align="center" style="font-size:14px;"><?=find_a_field('user_activity_management','fname','user_id='.$all->approve3_id)?></td>
		            <td width="150" align="center"><?=find_a_field('user_activity_management','fname','user_id='.$all->approve5_id)?></td>
		            <td width="150" align="center"><?=find_a_field('user_activity_management','fname','user_id='.$all->approve4_id)?></td>
		            <td width="188" align="center"><?=find_a_field('user_activity_management','fname','user_id='.$all->checked_by)?></td>
                </tr>

                <tr>
					<td align="center"></td>
                    <td align="center">----------------</td>
  					<td align="center">----------------</td>
					<td align="center">----------------</td>
  					<td align="center">----------------</td>
  					<td align="center">----------------</td>
  					<td align="center">----------------</td>
  					<td align="center">----------------</td>
  					<td align="center">----------------</td>
  					<td align="center">----------------</td>
                </tr>
                <tr>
					<td align="center"></td>
                    <td align="center"><strong>Prepared By</strong></td>
					<td align="center"><strong>Operation Manager</strong></td>
                    <td align="center"><strong>Accounts Manager (Store)</strong></td>
                    <td align="center"><strong>GM Operation (Store)</strong></td>
                    <td align="center"><strong>AGM (F &amp; A) Factory</strong> </td>
                    <td align="center"><strong>Accounts (H/O)</strong></td>
                    <td align="center"><strong>AGM (F &amp; A H/O) </strong></td>
                    <td align="center"><strong>CFO</strong></td>
                    <td align="center"><strong>DMD</strong></td>
                    <!--<td align="center"><strong>Checked By:</strong></td>-->
                </tr>
        </table>
			

      </div>
	

    </td>
  </tr>
</table>
</body>
</html>

