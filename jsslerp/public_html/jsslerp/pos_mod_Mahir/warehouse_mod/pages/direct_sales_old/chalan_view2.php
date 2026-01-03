<?php
session_start();


require_once "../../../assets/template/layout.top.php";
require_once ('../../../acc_mod/common/class.numbertoword.php');
$chalan_no 		= $_REQUEST['v_no'];

$master     = find_all_field('warehouse_ds_issue','','oi_no='.$chalan_no);

$dealer_code = $master->vendor_id;
$dealer = findall("select * from dealer_info where dealer_code='".$dealer_code."'");

$winfo =findall("select * from warehouse where warehouse_id='".$master->warehouse_id."'");
$warehouse_name = $winfo->warehouse_name;


foreach($challan as $key=>$value){ $$key=$value;}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=$master->job_no;?> - CH<?=$chalan_no;?></title>
<link href="../css/invoice.css" type="text/css" rel="stylesheet"/>

<script type="text/javascript">

function hide(){
document.getElementById("pr").style.display="none";
}
</script>
<style type="text/css">

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

@media print {
  .brack {page-break-after: always;}
}


</style>
</head>
<body style="font-family:Tahoma, Geneva, sans-serif; font-size: 10px;">

<div class="page_brack" >

<table width="1000" border="0" cellspacing="0" cellpadding="0" align="center">
  <tbody>
  <tr>
    <td><div class="header">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="15%">
                        <img src="../../../logo/group_logo.png" style=" height:50px; width:auto;" />
                        <td width="60%"><table  width="80%" border="0" align="center" cellpadding="3" cellspacing="0">
                            <tr>
                              <td style="text-align:center; color:#000; font-size:14px; font-weight:bold;">
						
								<p style="font-size:18px; color:#000000; margin:0; padding: 0 0 5px 0; text-transform:uppercase;  font-weight:700; font-family: 'TradeGothicLTStd-Extended';">Sencillo</p>
								<p style="font-size:14px; font-weight:300; color:#000000; margin:0; padding:0;"><?=$winfo->address?></p>
								<p style="font-size:12px; font-weight:300; color:#000000; margin:0; padding:0;">Phone No. : <?=$winfo->mobile?>,  Email : <?=$winfo->email?></p></td>
                            </tr>
                            <tr>


        <!--<td bgcolor="#666666" style="text-align:center; color:#FFF; font-size:18px; font-weight:bold;">WORK ORDER </td>-->
      </tr>
                          </table>
                        <td width="20%"> 
						
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					

                      
					  
					
					  </table>	</td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
          <tr>          </tr>
        </table>
      </div></td>
  </tr>
  


  <tr> <td><hr /></td></tr>
 
  
  
  <tr> <td>
  <table width="100%" border="0" cellspacing="0" cellpadding="0"  style="font-size:12px">
  
  	<tr height="30">
  	  <td width="25%" valign="top"></td>
  	  <td width="50%"  style="text-align:center; color:#FFF; font-size:18px; padding:0px 0px 10px 0px; color:#000000; font-weight:bold;"><span style="text-decoration:underline">Invoice </span> </td>
  	  <td width="25%" align="right" valign="right">&nbsp;</td>
	  </tr>
  </table>
  
  </td></tr>
  
  
  <tr> <td>&nbsp;</td></tr>
  
  
  
 <tr> <td><table width="100%" border="0" cellspacing="0" cellpadding="0">


		  <tr>


		    <td width="100%" valign="top">





<table width="100%" border="0" cellspacing="0" cellpadding="3"  style="font-size:12px">


		        <tr>
		          <td align="left" valign="middle" style="font-size:12px; font-weight:700;">Sales NO </td>
		          <td style="font-size:12px; font-weight:700;">:&nbsp;<?=$chalan_no;?></td>
		          <td width="10%"><strong>Sales Date </strong></td>
	              <td width="18%">:&nbsp;<?php echo date('d-m-Y',strtotime($master->oi_date));?></td>
	              <td width="16%"> </td>
	              <td width="13%"> </td>
		        </tr>
		        
		        <tr>
		          <td width="13%" align="left" valign="middle" style="font-size:12px; font-weight:700;">Party Name</td>
		          <td width="30%" style="font-size:12px; font-weight:700;">:&nbsp;<?=$master->customer_name;?></td>
		          <td>Party Address </td>
	              <td>: <?=$master->customer_address;?></td>
	              <td>Party Mobile </td>
	              <td>: <?=$master->customer_mobile;?></td>
		        </tr>
		        </table>
		      


</td>
</tr>


		</table>		</td></tr>
  
  
 
  <tr>
    <td>

<br><br>
      
<table width="100%" class="tabledesign" border="1" bordercolor="#000000" cellspacing="0" cellpadding="5"  style="font-size:12px">
<tr>
    <th width="4%" bgcolor="#CCCCCC">SL</th>
    <th width="10%" bgcolor="#CCCCCC">Product Code</th>
    <th width="25%" bgcolor="#CCCCCC">Description</th>
    <th width="5%" bgcolor="#CCCCCC">Qty</th>
    <th width="5%" bgcolor="#CCCCCC">Unit</th>
    <th width="9%" bgcolor="#CCCCCC">MRP</th>
    <th width="9%" bgcolor="#CCCCCC">Dis%</th>
    <th width="9%" bgcolor="#CCCCCC">Rate</th>
    <th width="8%" bgcolor="#CCCCCC">Amount</th>
</tr>
<? 
$res='select  b.item_name, a.*, b.finish_goods_code
from warehouse_ds_issue_detail a, item_info b 
where b.item_id=a.item_id and a.oi_no='.$chalan_no.' order by a.id desc';
   
$i=1;
$query = mysql_query($res);
while($data=mysql_fetch_object($query)){
?>
<tr>
    <td><?=$i++?></td>
    <td><?=$data->finish_goods_code?></td>
    <td><strong><?=$data->item_name?></strong></td>
    <td><div align="center"><?=$data->qty; $gqty+=$data->qty;?></div></td>
    <td><div align="center"><?=$data->unit_name?></div></td>
    <td><div align="right"><?=number_format($data->tp,2);?></div></td>
    <td><div align="right"><?=$data->dis_per?></div></td>
    <td><div align="right"><?=$data->rate?></div></td>
    <td><div align="right"><?=$data->amount; $tot_total_amt +=$data->amount;?></div></td>
</tr>
<?  } ?>
<tr>
    <td colspan="3"><div align="right"><strong> Total:</strong></div></td>
    <td><div align="center"><strong><?=$gqty?></strong></div></td>
    <td><div align="right"><strong></strong></div></td>
    <td><div align="right"><strong></strong></div></td>
    <td><div align="right"><strong></strong></div></td>
    <td><div align="right"><strong></strong></div></td>
    <td><div align="right"><strong><?=number_format($tot_total_amt,2)?></strong></div></td>
</tr>
<tr>
    <td colspan="8" style="text-align:right;"><strong>Special Discount :</strong></td>
    <td style="text-align:right;"><strong><?=$master->discount_amt?></strong></td>
</tr>
<tr>
    <td colspan="8" style="text-align:right;"><strong>Invoice Amount :</strong></td>
    <td style="text-align:right;"><strong><?=$gnamt=($tot_total_amt-$master->discount_amt);?></strong></td>
</tr>

<tr>
<td colspan="12"><span class="style8" style="font-size:14px; font-weight:500; letter-spacing:.3px;">In Word:
<?
$scs =  $gnamt;

			 $credit_amt = explode('.',$scs);

	 if($credit_amt[0]>0){

	 

	 echo convertNumberToWordsForIndia($credit_amt[0]);}

	 if($credit_amt[1]>0){

	 if($credit_amt[1]<10) $credit_amt[1] = $credit_amt[1]*10;

	 echo  ' & '.convertNumberToWordsForIndia($credit_amt[1]).' paisa ';}

	 echo ' Only.';

		?></span></td>
</tr>


</table>  
Entry At: <?=$ch_data->entry_at;?>  Print Time: <?=date('Y-m-d H:i:s');?>     
</td>
</tr>
  
  




<tr><td>&nbsp;</td></tr>
  

  
  
  
	
	
	

	<tr>
		<td>

	      <div class="footer"> 
	
<table width="100%" cellspacing="0" cellpadding="0"  >
	
		<tr>
		  <td colspan="4">&nbsp;</td>
		  </tr>
		<tr>
		  <td colspan="4">&nbsp;</td>
		  </tr>
		<tr>
		  <td colspan="4">&nbsp;</td>
		  </tr>
		<tr>
		  <td colspan="4">&nbsp;</td>
		  </tr>
		<tr>
            <td colspan="4">&nbsp;  </td>
		</tr>
		<tr>
		  <td align="center" >&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  </tr>
		<tr>
		  <td align="center" >&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  </tr>
		<tr>
		  <td align="center" >&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  </tr>

<tr>
	<td align="center" ><?php
		 $ucid=find_a_field('sale_do_master','entry_by','do_no="'.$do_no.'"');
		   echo find_a_field('user_activity_management','fname','user_id="'.$ucid.'"')?>
		   </td>
		  
		  <td align="center">
		  <?php
		 $uid=$master->checked_by;
		   echo find_a_field('user_activity_management','fname','user_id="'.$uid.'"')?>		  
		   </td>
		  
		  
		  <td align="center"><?php
		 $uid=$ch_data->entry_by;
		   echo find_a_field('user_activity_management','fname','user_id="'.$uid.'"')?>		  
		   </td>
		
		  <td align="center"></td>
		   
		   
		  <td align="center"></td>
		  </tr>
		
		
		
		<tr>
		  <td align="center">---------------------------------</td>
		  <td align="center">---------------------------------</td>
		  <td align="center">---------------------------------</td>
		  <td align="center">---------------------------------</td>
		  </tr>
		<tr>
		  <td align="center"></td>
		  <td align="center"></td>
		  <td align="center"></td>
		  <td align="center"></td>
		  </tr>
		<tr style="font-size:12px">
            <td align="center"><strong>Prepared By</strong></td>
			<td  align="center"><strong>Checked By</strong></td>
			<td  align="center"><strong>Delivered By</strong></td>
		    <td  align="center"><strong>Received By</strong></td>
		</tr>
		<tr style="font-size:12px">
		  <td align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  </tr>
		
		
		<!--<tr>
            <td colspan="3" style="font-size:12px">
                Note: No claims for shortage will be entertained after five days from the delivered date. </td>
		</tr>-->
			
	
			<tr>
            <td colspan="4">&nbsp;  </td>
		</tr>
			
				<tr>
            <td colspan="4">&nbsp;  </td>
		</tr>
	

	</table>
	  </div>	</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  </tr>
	<tr>
	  <td>&nbsp;</td>
	  </tr>
	<tr>
	  <td>&nbsp;</td>
	  </tr>
	<tr>
	  <td>&nbsp;</td>
	  </tr>
  </tbody>
</table>

</div>




</body>
</html>
