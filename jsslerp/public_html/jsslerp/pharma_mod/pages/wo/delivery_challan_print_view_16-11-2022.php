<?php 
require_once "../../../assets/template/layout.top.php";
require_once ('../../../acc_mod/common/class.numbertoword.php');

$chalan_no 		= $_GET['v_no'];
$ch_data= find_all_field('sale_do_chalan','','chalan_no='.$chalan_no);
$master= find_all_field('sale_do_master','','do_no='.$ch_data->do_no);
 $dealer_all=find_all_field('dealer_info','*','dealer_code="'.$master->dealer_code.'"'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Challan View</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <style>
  table.table-bordered > thead > tr > th{
  border:1px solid black;
}
 table.table-bordered > tbody > tr > td{
  border:1px solid black;
}
  </style>
</head>
<script type="text/javascript">
function hide()
{
    document.getElementById("pr").style.display="none";
	document.getElementById('footer').style.position="absolute";
	document.getElementById('footer').style.bottom="0px";
}
</script>
<body>
  
<div class="container">
 
 <div class="row">
 	<div class="col-sm-8"></div>
	<div class="col-sm-4 text-right">
		<img src="../../../logo/<?=$_SESSION['user']['group']?>.png" style=" width:50%" />
	</div>
 </div>
  <h2 style="text-align:center;">Challan</h2>
  
  <div class="row">
  <div id="pr">
        <div align="left">
          <p>
            <input name="button" type="button" onclick="hide();window.print();" value="Print" />
          </p>
          <nobr>
          <!--<a href="chalan_bill_view.php?v_no=<?=$_REQUEST['v_no']?>">Bill</a>&nbsp;&nbsp;--><!--<a href="do_view.php?v_no=<?=$_REQUEST['v_no']?>" target="_blank"><span style="display:inline-block; font-size:14px; color: #0033FF;">Bill Copy</span></a>-->
          </nobr>
		  <nobr>
          
          <!--<a href="chalan_bill_distributor_vat_copy.php?v_no=<?=$_REQUEST['v_no']?>" target="_blank">Vat Copy</a>-->
          </nobr>	    </div>
      </div>
<table class="table table-bordered table-sm border-dark" >
	<thead></thead>
	<tbody>
		<tr>
			<td>
				<span style="font-weight:bold;">Name & Address of Receipient/Challan TO</span>
			</td>
			<td>
				<span style="font-weight:bold;">Challan Date:  <?php echo $ch_data->chalan_date;?></span>
			</td>
		</tr>
		
		<tr>
			<td>
				<span style="font-weight:bold;">Customer Code:</span> <?=$dealer_all->customer_code;?>
			</td>
			<td>
				<span style="font-weight:bold;">Challan NO:</span>  <?php echo $ch_data->chalan_no;?>
			</td>
		</tr>
		
		<tr>
			<td>
				<span style="font-weight:bold;">Customer Name: <?=$dealer_all->dealer_name_e;?></span>
			</td>
			<td>
				<span style="font-weight:bold;">PO NO: <?=$master->po_no;?></span>
			</td>
		</tr>
		
		<tr>
			<td>
				<span style="font-weight:bold;">Address:</span> <?=$dealer_all->address_e;?>
			</td>
			<td>
				<span style="font-weight:bold;">Delivery Address:</span> <?=$dealer_all->delivery_address;?>
			</td>
		</tr>
		
	</tbody>
</table>
<br>
<table class="table table-bordered table-sm">
	<thead>
		<tr>
			<th>RPL Product Name</th>
			<th>Product Code</th>
			<th>Item Name</th>
			<th>UOM</th>
			<th>Qty</th>
		</tr>
	</thead>
	
	<tbody>
	<?php 
	$sql='select * from sale_do_chalan where chalan_no="'.$chalan_no.'"';
	$query=mysql_query($sql);
	while($row=mysql_fetch_object($query)){
	$item_all=find_all_field('item_info','*','item_id="'.$row->item_id.'"');
	?>
		<tr>
			<td><?php echo find_a_field('item_sub_group','sub_group_name','sub_group_id='.$item_all->sub_group_id);?></td>
			<td><?php echo $item_all->finish_goods_code;?></td>
			<td><?php echo $item_all->item_name;?></td>
			<td><?php echo $item_all->unit_name;?></td>
			<td><?php echo $row->total_unit;?></td>
		</tr>
		<?php 
		$total_unit+=$row->total_unit;
		} ?>
		<tr style="font-weight:bold;">
			<td colspan="4" style="text-align:right;">Total</td>
			<td><?php echo $total_unit;?></td>
		</tr>
	</tbody>
</table>

</div>
<p> <span class="style8" style="font-size:14px; font-weight:500; letter-spacing:.3px;">In Word:
             <? $scs =  $total_unit;
				$credit_amt = explode('.',$scs);

	 if($credit_amt[0]>0){
	  echo convertNumberToWordsForIndia($credit_amt[0]);}

		 if($credit_amt[1]>0){
		 if($credit_amt[1]<10) $credit_amt[1] = $credit_amt[1]*10;
		 echo  ' & '.convertNumberToWordsForIndia($credit_amt[1]).' paisa ';
							 }
	  echo ' Only.';

		?></span></p>

<span>Thank you in anticipation.</span>
<br><br><br> 
<div class="footer" id="footer"> 
	
	<table width="100%" cellspacing="0" cellpadding="0"  >
	
	
		
 
		 
		   <tr>
		 	  <td align="center" ><?php
		  
		 $ucid=find_a_field('sale_do_master','entry_by','do_no="'.$do_no.'"');
		   echo find_a_field('user_activity_management','fname','user_id="'.$ucid.'"')?></td>
		     <td align="center">
		  <?php
		  
		 $uid=find_a_field('sale_do_chalan','entry_by','chalan_no="'.$chalan_no.'"');
		   echo find_a_field('user_activity_management','fname','user_id="'.$uid.'"')?>		  </td>
		  <td align="center"><?php
		  
		 $uid=find_a_field('sale_do_chalan','checked_by','chalan_no="'.$chalan_no.'"');
		   echo find_a_field('user_activity_management','fname','user_id="'.$uid.'"')?>		  </td>
		
		   
		   
		 
		  </tr>
		<tr>
		  <td align="center">________________________________</td>
		  <td align="center">________________________________</td>
		  <td align="center">________________________________</td>
	 
		  </tr>
		<tr>
		  <td align="center"></td>
		  <td align="center"></td>
		  <td align="center"></td>
 
		  </tr>
		<tr style="font-size:12px">
            <td align="center" width="20%"><strong>Customer Signature</strong></td>
		    
			<td  align="center" width="20%"><strong>Prepared By</strong></td>
			
			<td  align="center" width="20%"><strong>Authorized Signature</strong></td>
		 
		    </tr>
		<tr style="font-size:12px">
		  <td align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
 
		  </tr>
		
	
		 
			
	
			 
			
				 
	
	 
	</table>
	<table width="100%" cellspacing="0" cellpadding="0" >
		<tr>
		<td style="text-align:right;border-right:1px solid black;padding-right:5px;width:50%;">রেডিয়েন্ট কেয়ার লিমিটেড</td>
		<td style="padding-left:5px;">Radiant Care Limited</td>
		</tr>
		<tr>
	<td style="text-align:right;border-right:1px solid black;padding-right:5px;">এস কে এস টাওয়ার (লেভেল ৮), ৭  ভিআইপি রোড</td>
		<td style="padding-left:5px;" >SKS Tower(Level-8),7 VIP Road</td>
		</tr>
			<tr>
		<td style="text-align:right;border-right:1px solid black;padding-right:5px;">মহাখালি , ঢাকা ১২০৬,বাংলাদেশ </td>
		<td style="padding-left:5px;">Mohakhali,Dhaka-1206,Bangladesh</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center;">Tel: +88028411614, Fax: 880-2-8411613, Email: care@radiant.com.bd,Web: www.radiant.com.bd</td>
		</tr>
	</table>
	<br><br>
	  </div>
</div> <!--container-->



</body>
</html>
