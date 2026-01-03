<?php
session_start();
require_once "../../../assets/template/layout.top.php";
//require_once ('../../../acc_mod/common/class.numbertoword.php');


$chalan_no 		= $_REQUEST['v_no'];

$master     = find_all_field('warehouse_ds_issue','','oi_no='.$chalan_no);

$dealer_code = $master->vendor_id;
$dealer = findall("select * from dealer_info where dealer_code='".$dealer_code."'");

$winfo =findall("select * from warehouse where warehouse_id='".$master->warehouse_id."'");
$warehouse_name = $winfo->warehouse_name;



?>

<script>
function hide()

{
    document.getElementById("pr").style.display="none";
	window.print();
	
	setTimeout(function(){
   $('#cvd').show();// or fade, css display however you'd like.
   $('#pr').show();
}, 500);
}
</script>
<style>
@media print {
  #cvd,#pr {
    display: none;
  }
</style>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title><?=$master->job_no;?> - CH<?=$chalan_no;?></title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

</head>

<body>

<div class="container mt-5 mt-5">
    
<div class="row">
    <div class="col-6">
        <img src="../../../logo/group_logo.png" style=" height:50px; width:auto;" />
        <br>House# 13, Road#7, Block#F, Banani,
        <br>Dhaka# 1213 Mob:01713058372
        <br>Eail: info@sencillo.com.bd
        <br>Web: www.sencillo.com.bd
        
    </div>
    <div class="col-6 text-right">
        <img src="../../../logo/company_qrcode.PNG" style=" height:100px; width:auto;" />
    </div>
</div> 

<div class="row mt-5">
    <div class="col-6">
        <span style="font-size: 18px;"><strong>BILL TO</strong></span>
        <br>Name:
        <br>Address:
        <br>Mobile: 
        <br>Email:
        
    </div>
    <div class="col-6 text-right">
        Order No: <?=$chalan_no;?><br>Date: <?php echo date('d-M-Y',strtotime($master->oi_date));?>
    </div>
</div> 
    
  
<div class="item mt-5">
    
  <button id="pr" class="btn btn-info" onclick="hide();">Print</button> <button style="display:none" onClick="location.href = 'direct_sales.php?pal=2'" class="btn btn-warning" id="cvd">GO Back</button>
<table class="table" width="100%" class="tabledesign" border="0" bordercolor="#000000" cellspacing="0" cellpadding="5"  style="font-size:12px">
<thead>
<tr>
    <th width="40%" bgcolor="#CCCCCC">Description</th>
    <th width="20%" bgcolor="#CCCCCC">Product Code</th>
    <th width="10%" bgcolor="#CCCCCC">Price</th>
    <th width="10%" bgcolor="#CCCCCC">Qty</th>
    <th width="10%" bgcolor="#CCCCCC">Total</th>
</tr>
</thead>
<tbody>
<? 
$res='select  b.item_name, a.*, b.finish_goods_code
from warehouse_ds_issue_detail a, item_info b 
where b.item_id=a.item_id and a.oi_no='.$chalan_no.' order by a.id desc';
   
$i=1;
$query = mysql_query($res);
while($data=mysql_fetch_object($query)){
?>
<tr>
    <td><strong><?=$data->item_name?></strong></td>
    <td><?=$data->finish_goods_code?></td>
    <td><div align="right"><?=$data->rate?></div></td>
    <td><div align="center"><?=$data->qty; $gqty+=$data->qty;?></div></td>
    <td><div align="right"><?=$data->amount; $tot_total_amt +=$data->amount;?></div></td>
    
</tr>
<?  } ?>
</tbody>
</table>
<hr>


<table width="100%" class="tabledesign" border="0" bordercolor="#000000" cellspacing="0" cellpadding="5"  style="font-size:12px">
<tr>
    <td width="75%"colspan="8">&nbsp;</td>
    <td style="text-align:right;"><strong>Sub Total :</strong></td>
    <td style="text-align:right;"><strong><?=number_format($tot_total_amt,2)?></strong></td>
</tr>

<tr>
    <td width="75%"colspan="8">&nbsp;</td>
    <td style="text-align:right;"><strong>Vat :</strong></td>
    <td style="text-align:right;">Included</td>
</tr>

<tr>
    <td width="75%"colspan="8">&nbsp;</td>
    <td style="text-align:right;"><strong>Shipping :</strong></td>
    <td style="text-align:right;"></td>
</tr>
    

<tr>
    <td width="75%"colspan="8">&nbsp;</td>
    <td style="text-align:right;"><strong>Discount :</strong></td>
    <td style="text-align:right;"><strong><?=$master->discount_amt?></strong></td>
</tr>

<tr>
    <td width="75%"colspan="8">&nbsp;</td>
    <td style="text-align:right;"><strong>Grand Amount :</strong></td>
    <td style="text-align:right;"><strong><?=$gnamt=($tot_total_amt-$master->discount_amt);?></strong></td>
</tr>

<tr>
    <td width="75%"colspan="8">&nbsp;</td>
    <td style="text-align:right;"><strong>Paid Amount :</strong></td>
    <td style="text-align:right;"><strong><?=$master->collection;?></strong></td>
</tr>


<tr>
    <td width="75%"colspan="8">&nbsp;</td>
    <td style="text-align:right;"><strong>Due Amount :</strong></td>
    <td style="text-align:right;"><strong><?=$due=($gnamt-$master->collection);?></strong></td>
</tr>


</table> 

</div> <!--end item row-->
    
    
  
  
  
<div class="terms mt-5"> 
<strong>Terms & Conditions :</strong>
<br>i. <strong>Warranty:</strong> 1-year free service Warranty for any manufacturing fault. No warranty/guaranty for glass, fabric, Leather and rexin.
<br>ii. <strong>Delivery Time:</strong> Delivery Time is 3 between 6 weeks after order confirmation. Delivery date may be change any unavoidable circumstances.  
<br>iii. <strong>Terms of Payment:</strong> 70% advance with invoice amount and rest of balance have to pay before delivery date.
<br>iv. <strong>Mode of Payment:</strong> By Cash/ Card/ Cheque at our cash counter. If payment were made by cheque the delivery would be after encashment of cheque.
<br>v. <strong>Vat:</strong> Vat included with price. Vat challan will be provided to the customer. 
<br>vi. <strong>Exchange policy:</strong> Furniture can be exchanged in good condition within 3 days with additional 15% service charge. It is not applicable for customized Products/ Accessories. Exchanged does not applied if the product is found to be dirty, stained, scratched, damaged or abused. 
<br>vii. <strong>Cancellation:</strong> Customers can cancel an order within 3 days from the order date and get a full refund. Any cancellation after 3 days will be subject to a 15% charge of the invoice value. 
<br>viii. As marble is a natural product, it’s texture fiber and pattern may vary.

<p>
<div class="footer text-right">THANK YOU</div>     
</div> <!--end terms row-->
  
  
  
  
  
  
   
    
</div>
<!--end container-->








<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>
