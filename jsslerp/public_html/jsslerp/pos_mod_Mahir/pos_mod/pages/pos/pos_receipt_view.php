<?php

session_start();

require_once "../../../assets/template/layout.top.php";

require_once ('../../../acc_mod/common/class.numbertoword.php');

$pos_id 		= $_REQUEST['v_no'];

$group_data = find_all_field('user_group','group_name','id='.$_SESSION['user']['group']);

$master= find_all_field('sale_pos_master','','pos_id='.$pos_id);
$dealer = find_all_field('dealer_pos','','dealer_code="'.$master->dealer_id.'"');


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>POS <?=$pos_id;?></title>
<?php include("../../../assets/css/theme_responsib_new_table_report.php");?>
<link href="../css/invoice.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript">



function hide()



{



    document.getElementById("pr").style.display="none";



}



</script>
<style type="text/css">



<!--
.header table tr td table tr td table tr td table tr td {
	color: #000;
}

/*@media print{
.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;

   color: white;
   text-align: center;
}
}*/
-->
<?php /*?>div.page_brack
{
    page-break-after:always;
}<?php */?>



@font-face {
  font-family: 'MYRIADPRO-REGULAR';
  src: url('MYRIADPRO-REGULAR.OTF'); /* IE9 Compat Modes */

}

@font-face {
  font-family: 'TradeGothicLTStd-Extended';
  src: url('TradeGothicLTStd-Extended.otf'); /* IE9 Compat Modes */

}


@font-face {
  font-family: 'Humaira demo';
  src: url('Humaira demo.otf'); /* IE9 Compat Modes */

}

/*@media print {*/
/*  .brack {page-break-after: always;}*/
/*}*/

/*body{*/
/*    width: 17.56mm;*/
/*    height: 123.7mm;*/
/*    margin-left:auto;*/
/*    margin-right:auto;*/
/*}*/
.body{
    font-family:Tahoma, Geneva, sans-serif;
    font-size: 10px; 
    width: 200mm; 
    margin: 0 auto;
}

.table-sr{
    width: 30%;
    padding: 10px;
}

 @page {
      margin: 1cm auto;
 }
 
@media print {
        .body{
            font-family:Tahoma, Geneva, sans-serif;
            font-size: 10px; 
            width: 76.2mm; 
            margin: 0 auto;
                margin-left: 10px;
                margin-top: 10px;
        }

}

</style>


</head>
<body class="body">
<table border="0" cellpadding="0" cellspacing="0" class="table-sr">
				<thead>
				<tr>
					<div align="center" id="pr">
						<br>
						<input type="button" style="text-align:center" value="Print" onclick="hide();window.print();"/>
					</div>

				</tr>

				<tr>
					<th id="company_name" style="text-align: center;"><h2><?=$_SESSION['company_name']?></h2></th>
					<input type="hidden" value="123456" id="tin_number">

				</tr>

				

				<tr>
					<th id="company_address" style="text-align: center;"><?=$group_data->address?></th>
				</tr>

				<tr>
					<td id='sale_type' style="text-align: center;"></td>
				</tr>
				


				<tr>
					<th colspan="6" style="font-size: 1.5625rem; text-align: center; padding-top: 10px; padding-bottom: 10px;">
						<span style="border: 1px solid #000;padding: 5px;padding-left: 10px;padding-right: 10px;">Order #<?=$master->pos_id?></span>
					</th>
				</tr>
				
				

				<tr>
					<td id='time_of_print' style="text-align: right; color:#000;"><?=date('d-m-Y h:i:s a')?></td>
				</tr>
                <tr>
					<th style="font-weight: normal; color:#000;">Customer Name: <?=$dealer->dealer_name?></th>
				</tr>
				<tr>
					<th style="font-weight: normal; color:#000;">Customer Contact: <?=$dealer->contact_no?></th>
				</tr>
				<tr>
					<th style="font-weight: normal; color:#000;">Cashier: <?=find_a_field('user_activity_management','fname','user_id="'.$master->entry_by.'"')?></th>
				</tr>


				<tr>
					<td>
						<table style="width:100%;">
							<tr style="border-bottom:1px solid #000">
								<th valign="middle">Item Name</th>
								<th valign="middle" style="text-align: left;">Qty</th>
								<th valign="middle" style="text-align: left;">Rate</th>
								<th valign="middle" style="text-align: right;">Total</th>
							</tr>
							<tbody id="item_details_info" style="color:#000;">
                              <?
							   $sql = 'select s.*,i.item_name from sale_pos_details s, item_info i where i.item_id=s.item_id and s.pos_id="'.$master->pos_id.'"';
							   $qry = mysql_query($sql);
							   while($data=mysql_fetch_object($qry)){
							   $total_discount +=$data->discount_amt;
							  $data->total_amt=$data->qty*$data->rate;
							   $total_amt += $data->total_amt;
							  ?>
							  <tr>
							  <td><?=$data->item_name?></td>
							  <td><?=$data->qty?></td>
							  <td><?=$data->rate?></td>
							  <td align="right"><?=number_format($data->total_amt,2)?></td>
							  </tr>
							  <? }
							    $vat_amt =  ($total_amt*$master->vat_percent)/100;
								$grnd_total = ($total_amt+$vat_amt)-$total_discount;
							   ?>
							</tbody>
							<tfoot style="border-top:1px solid black">
							<tr class="bold">
								<td colspan="3" style="text-align:right;  border-top:1px solid #333; ">Total Amt :</td>
								<td colspan="1" id="tia" style="text-align: right;  border-top:1px solid #333; "><?=number_format($total_amt,2)?></td>
							</tr>
							
							<tr class="bold">
								<td colspan="3" style="text-align:right;  border-top:1px solid #333; color:#000; ">Total Discount :</td>
								<td colspan="1" id="tot_discount" style="text-align: right;  border-top:1px solid #333; color:#000; "><?=number_format($total_discount,2)?></td>
							</tr>

							<tr class="bold">
								<td colspan="3" style="text-align:right;">VAT <span id="vat_perc"></span>%:</td>
								<td colspan="1" id="vat_amount" style="text-align: right;"><?=number_format($vat_amt,2)?></td>
							</tr>
							
							<tr class="bold">
								<td colspan="3" style="text-align:right;  border-top:1px solid #333; ">Grand Total :</td>
								<td colspan="1" id="grand_total" style="text-align: right;  border-top:1px solid #333; "><?=number_format($grnd_total,2)?></td>
							</tr>
							<!--<tr>
								<td colspan="6" style="text-align:center;">
									<p style="margin: 0px">Prices are VAT Inclusive</p>
									<p style="margin: 0px"></p>
								</td>
							</tr>-->


							<!--<tr>
								<td colspan="6" style="text-align:center;">
									<p style="margin: 0px">Payment Method - </p>
									<p style="margin: 0px"></p>
								</td>
							</tr>
-->
							<tr>
								<td colspan="6">
									<table width="100%" cellpadding="0" cellspacing="0" style="color:#000;">
										<tr>
											<th align="left" valign="middle" style="text-align: left">Payment Method</th>
											<th align="right" valign="middle" style="text-align: right"> Amount</th>
										</tr>
										<tbody id="r_payment_history">
                                          <?
										   $sql = 'select p.*,l.payment_method from pos_payment p, pos_payment_method l where l.id=p.payment_method and p.pos_id="'.$master->pos_id.'"';
										   $qry = mysql_query($sql);
										   while($pdata=mysql_fetch_object($qry)){
										   $total_paid +=$pdata->paid_amt;
										  ?>
										  <tr>
										  <td><?=$pdata->payment_method?></td>
										  <td align="right"><?=$pdata->paid_amt?></td>
										  </tr>
										  <? } ?>
										  <tr>
										    <td colspan="2"><strong>Total Paid : <?=number_format($total_paid,2)?></strong></td>
										  </tr>
										</tbody>
									</table>
								</td>
							</tr>


							</tfoot>
						</table>
					</td>
				</tr>

				<tr>
					<td align="center">
						<img id="image_id" src="https://chart.googleapis.com/chart?chs=150x150&amp;cht=qr&amp;chl=<?=$_SESSION['company_name']?>. POS ID <?=$master->pos_id?>&amp;choe=UTF-8" alt="QR code">
					</td>
				</tr>
				<tr>
					<td colspan="6" style="text-align:center; color:red;"><? if($master->exchange_notes>0) echo 'Exchanged Order';?></td>
				</tr>
				
				<tr>
					<td colspan="6" style="text-align:center; color:#000;">Exchange items within 3 days of purchase, in original condition with proof of purchase.
</td>
				</tr>

				<!--<tr>-->
				<!--	<td colspan="6" style="text-align:center; color:#000;">-- End --</td>-->
				<!--</tr>-->
				
				<tr>
					<td colspan="6" style="text-align:center; color:#000;">Powerd by <?=$_SESSION['company_name']?></td>
				</tr>
				
				<tr>
					<td colspan="6" style="text-align:center; color:#000;">-- Thank You --</td>
				</tr>

				</thead>
				<tbody id="s_sales"></tbody>
			</table>
<div class="page_brack" ></div>
<div class="brack">&nbsp;</div>


<script>
    
    window.onload = function() {
    window.print();
}
</script>

</body>
</html>
