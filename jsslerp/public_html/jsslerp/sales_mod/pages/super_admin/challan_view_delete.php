<?php
session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";

require_once ('../../../acc_mod/common/class.numbertoword.php');
$title='Challan Delete';

create_combobox('dealer_code');
create_combobox('do_no');
create_combobox('chalan_no');

do_calander('#fdate');
do_calander('#tdate');







?>

  
  <?
		if(isset($_POST['challan_view']))
		
		{
		
		header("Location:challan_view_delete.php?chalan_no=".$_POST['challan_no']." ");
		
		
		}


?>
<script language="javascript">
window.onload = function() {
  document.getElementById("dealer").focus();
}
</script>
<script language="javascript">
function custom(theUrl)
{
	window.open('<?=$target_url?>?v_no='+theUrl);
}

function hide()



{



    document.getElementById("pr").style.display="none";



}
</script>


<style type="text/css">

<!--

.style1 {color: #FF0000}
.style2 {
	font-weight: bold;
	color: #000000;
	font-size: 14px;
}
.style3 {color: #FFFFFF}

-->





/*.ui-state-default a, .ui-state-default a:link, .ui-state-default a:visited, a.ui-button, a:link.ui-button, a:visited.ui-button, .ui-button {
    color: #454545;
    text-decoration: none;
    display: none;
}*/

<!--
.header table tr td table tr td table tr td table tr td {
	color: #000;
}




@font-face {
  font-family: 'Andina Demo';
  src: url('Andina Demo.otf'); /* IE9 Compat Modes */

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
div.page_brack
{
    page-break-after:always;
}

div.form-container_large input {
    width: 280px;
    height: 38px;
    border-radius: 0px !important;
}

tr:nth-child(odd){
    
    
    color:white;
}

</style>
<?




if(isset($_POST['delete']))
{
    	$all_data=find_all_field('sale_do_chalan','*','chalan_no="'.$_GET['chalan_no'].'" ');
    	
    	
        if($all_data->chalan_no==$_GET['chalan_no'])
        
        {
    
			$delete_user=$_SESSION['user']['id'];
	 $delete_time=date('Y-m-d  h:i:sa');
		  $in_back_query='insert into journal_item_delete_log select * from journal_item where sr_no="'.$_GET['chalan_no'].'" and tr_from="Sales"';
		 mysql_query($in_back_query);
		   $up_sql='update journal_item_delete_log set delete_by="'.$delete_user.'",delete_at="'.$delete_time.'" where sr_no="'.$_GET['chalan_no'].'" and tr_from="Sales"';
	 	mysql_query($up_sql);
	
	
		 $challan_queyr='insert into sale_do_chalan_delete_log select * from sale_do_chalan where chalan_no="'.$_GET['chalan_no'].'" ';
		 mysql_query($challan_queyr);
		   $up_sql_challan='update sale_do_chalan_delete_log set delete_by="'.$delete_user.'",delete_at="'.$delete_time.'" where chalan_no="'.$_GET['chalan_no'].'"';
	 	mysql_query($up_sql_challan);
	 
	
		 $sql="update sale_do_master set status='PROCESSING' where do_no='".$all_data->do_no."' ";
		 mysql_query($sql);
		 $delete_journal="delete from journal where tr_no='".$_GET['chalan_no']."' and tr_from='Sales' ";
		
		   mysql_query($delete_journal);
		
		 $delete_sec_journal="delete from secondary_journal where tr_no='".$_GET['chalan_no']."' and tr_from='Sales' ";
		 mysql_query($delete_sec_journal);
		
		 $delete_joural_item="delete from journal_item where sr_no='".$_GET['chalan_no']."' and tr_from='Sales' ";
		 mysql_query($delete_joural_item);
		
		
		 $delete_challan="delete from sale_do_chalan where chalan_no='".$_GET['chalan_no']."' ";
		
		 $result=mysql_query($delete_challan);
		 
 		
		     
 		     echo "<h2 style='color:white;background-color:green;font-weight:bold;text-align:center;'>Challan Delete Successfully!!!!</h2>";
 		

        }
		
		//else{
//            
//             echo "<h2 style='color:white;background-color:red;font-weight:bold;text-align:center;'>Invalid Challan NO !!!!</h2>";
//            
//        }

}

?>






<div class="form-container_large">
  <form action="" method="post" name="codz" id="codz">
    <table width="80%" border="0" align="center">
      
      
      <tr>
        <td align="right" bgcolor="#FF9966"><strong>Challan No:</strong></td>
        <td colspan="3" bgcolor="#FF9966">
		<input type="text" name="challan_no" id="challan_no" class="form-control" value="<?=$_POST['challan_no']?>" />		</td>
		<td><input type="submit" name="challan_view" id="challan_view" value="Challan View"  class="btn1 btn1-bg-submit" /></td>
      </tr>
      
      
      
    </table>
  </form>
  
<br /><br />
  
  <? 
  $count= find_a_field('sale_do_chalan','count(chalan_no)','chalan_no="'.$_GET['chalan_no'].'" ');
  	if($count>0){
  
  ?>
  
  <div class="page_brack" >
  
  
  
  <? 
  
  $chalan_no 		= $_GET['chalan_no'];


$destination_count= find_a_field('sale_do_chalan','COUNT(destination)','chalan_no="'.$chalan_no.'" and destination!=""');
$referance_count= find_a_field('sale_do_chalan','COUNT(referance)','chalan_no="'.$chalan_no.'" and referance!=""');
$sku_no_count= find_a_field('sale_do_chalan','COUNT(sku_no)','chalan_no="'.$chalan_no.'" and sku_no!=""');
$pack_type_count= find_a_field('sale_do_chalan','COUNT(pack_type)','chalan_no="'.$chalan_no.'" and pack_type!=""');
$color_count= find_a_field('sale_do_chalan','COUNT(color)','chalan_no="'.$chalan_no.'" and color!=""');
$size_count= find_a_field('sale_do_chalan','COUNT(size)','chalan_no="'.$chalan_no.'" and size!=""');

$do_no= find_a_field('sale_do_chalan','do_no','chalan_no='.$chalan_no);

$master= find_all_field('sale_do_master','','do_no='.$do_no);


$ch_data= find_all_field('sale_do_chalan','','chalan_no='.$chalan_no);



  		  $barcode_content = $chalan_no;
		  $barcodeText = $barcode_content;
          $barcodeType='code128';
		  $barcodeDisplay='horizontal';
          $barcodeSize=40;
          $printText='';


foreach($challan as $key=>$value){
$$key=$value;
}

$ssql = 'select a.*,b.do_date, b.group_for, b.via_customer from dealer_info a, sale_do_master b where a.dealer_code=b.dealer_code and b.do_no='.$do_no;



$dealer = find_all_field_sql($ssql);
$entry_time=$dealer->do_date;


$dept = 'select warehouse_name from warehouse where warehouse_id='.$dept;



$deptt = find_all_field_sql($dept);

$to_ctn = find_a_field('sale_do_chalan','sum(pkt_unit)','chalan_no='.$chalan_no);

$to_pcs = find_a_field('sale_do_chalan','sum(dist_unit)','chalan_no='.$chalan_no); 



$ordered_total_ctn = find_a_field('sale_do_details','sum(pkt_unit)','dist_unit = 0 and do_no='.$do_no);

$ordered_total_pcs = find_a_field('sale_do_details','sum(dist_unit)','do_no='.$do_no);
  
  ?>

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
                      <?php /*?>  <img src="../../../logo/<?=$master->group_for?>.png" width="100%" /><?php */?>
                        <td width="60%"><table  width="80%" border="0" align="center" cellpadding="3" cellspacing="0">
                            <tr>
                              <td style="text-align:center; color:#000; font-size:14px; font-weight:bold;">
						
								<p style="font-size:20px; color:#000000; margin:0; padding:0; text-transform:uppercase;"><?=find_a_field('user_group','group_name','id='.$master->group_for)?></p>
								<p style="font-size:14px; font-weight:300; color:#000000; margin:0; padding:0;"><?=find_a_field('user_group','address','id='.$master->group_for)?></p>                              </td>
                            </tr>
                            <tr>


        <!--<td bgcolor="#666666" style="text-align:center; color:#FFF; font-size:18px; font-weight:bold;">WORK ORDER </td>-->
      </tr>
                          </table>
                        <td width="20%"> 
						
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					
					<tr>
					  
					  <td align="center"><h4 style="font-size:16px;">Customer's Copy</h4></td>
					  
					  </tr>
                      
					  
					  <tr>
					  
					  <td><?='<img class="barcode" alt="'.$barcodeText.'" src="barcode.php?text='.$barcodeText.'&codetype='.$barcodeType.'&orientation='.$barcodeDisplay.'&size='.$barcodeSize.'&print='.$printText.'"/>' ?></td>
					  
					  </tr>
					  
					  <tr>
					  
					  <td><span style="font-size:14px; padding: 3px 0 0 10px; letter-spacing:7px;"><?=$chalan_no?></span></td>
					  
					  </tr>
					  </table>
							
						</td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            
          </tr>
        </table>
      </div></td>
  </tr>
  

 
 
 
 
 
 

 
  <tr> <td><hr /></td></tr>
 
  
  
  <tr> <td>
  <table width="100%" border="0" cellspacing="0" cellpadding="0"  style="font-size:12px">
  
  	<tr height="30">
  	  <td valign="top"></td>
  	  <td  style="text-align:center; color:#FFF; font-size:18px; padding:0px 0px 10px 0px; color:#000000; font-weight:bold;"><span style="text-decoration:underline">
	  DELIVERY CHALLAN</span> </td>
  	  <td valign="right" align="right">&nbsp;</td>
	  </tr>
  	<tr>
		<td width="25%" valign="top"></td>
			<td width="50%" valign="middle" align="center"><strong><!--FSC CERTIFICATE CODE: SCS-COC-007014--> </strong></td>
		<td width="25%" valign="right" align="right"><?php /*?><strong>Challan Date: <?=date("d M, Y",strtotime($ch_data->chalan_date))?><?php */?></strong></td>
	</tr>
	
	
	
  </table>
  
  </td></tr>
  
  
  <tr> <td>&nbsp;</td></tr>
  
  
  
 <tr> <td><table width="100%" border="0" cellspacing="0" cellpadding="0">


		  <tr>


		    <td width="100%" valign="top">


		      <table width="100%" border="0" cellspacing="0" cellpadding="3"  style="font-size:12px">


		        <tr>
		          <td width="10%" align="left" valign="middle">Customer Name</td>
		          <td width="26%">:	&nbsp;
	              <?= find_a_field('dealer_info','dealer_name_e','dealer_code="'.$master->dealer_code.'"');?></td>
	              <td width="5%">PO No </td>
	              <td width="12%">: &nbsp;<?=$master->customer_po_no;?></td>
	              <td width="10%">Challan No </td>
	              <td width="11%">: &nbsp;<?=$ch_data->chalan_no;?></td>
	              <td width="9%">Vehicle No </td>
	              <td width="17%">: &nbsp;<?=$ch_data->vehicle_no;?></td>
		        </tr>
		        <tr>
		          <td align="left" valign="middle">Customer Address</td>
		          <td>:	&nbsp;
                    <?= find_a_field('dealer_info','address_e','dealer_code="'.$master->dealer_code.'"');?></td>
	              <td>Job No </td>
	              <td>: &nbsp;<?=$master->job_no;?></td>
	              <td>Challan Date </td>
	              <td>: &nbsp;<?php echo date('d-m-Y',strtotime($ch_data->chalan_date));?></td>
	              <td>Driver Name </td>
	              <td>: &nbsp;<?=$ch_data->driver_name;?></td>
		        </tr>
		        <tr>
		          <td align="left" valign="middle">Delivery Address</td>
		          <td>:	&nbsp;
	             <?=$ch_data->delivery_address;?></td>
	              <td>Buyer</td>
	              <td>: &nbsp;<?= find_a_field('buyer_info','buyer_name','buyer_code="'.$master->buyer_code.'"');?></td>
	              <td>Gate Pass No </td>
	              <td>: &nbsp;<?=$ch_data->gate_pass;?></td>
	              <td>Driver Contact </td>
	              <td>: &nbsp;<?=$ch_data->driver_mobile;?></td>
		        </tr>
		        <tr>
		          <td align="left" valign="middle">Booking Ref No</td>
		          <td>:<?=$master->booking_no?></td>
	              <td><? if ($master->fsc_claim!=5) {?>FSC Status <? }?></td>
	              <td><? if ($master->fsc_claim!=5) {?>: &nbsp;<?= find_a_field('fsc_claim_type','fsc_claim','id="'.$master->fsc_claim.'"');?> <? }?></td>
	              <td>Gate Pass Date </td>
	              <td>: &nbsp;<?php echo date('d-m-Y',strtotime($ch_data->chalan_date));?></td>
	              <td>Delivery Man </td>
	              <td>: &nbsp;<?=$ch_data->delivery_man;?></td>
		        </tr>
		        <tr>
		          <td align="left" valign="middle">Booking Date  </td>
		          <td>:<?=$master->booking_date?> </td>
	              <td> </td>
	              <td></td>
	              <td> </td>
	              <td></td>
	              <td>Mobile No </td>
	              <td>: &nbsp;<?=$ch_data->delivery_man_mobile;?></td>
		        </tr>
				
				
		        <tr>
		          <td align="right" valign="center">&nbsp;</td>
		          <td colspan="7">&nbsp;</td>
		          </tr>
		        </table>		      </td>


			
		  </tr>


		</table>		</td></tr>
  
  
 
  <tr>
    <td>
      
      <table width="100%" class="tabledesign" border="1" bordercolor="#000000" cellspacing="0" cellpadding="5"  style="font-size:12px">
        
        <tr>
          <td   align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>SL</strong></td>
          <td   align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>Item Name </strong></td>
          <td  align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>SR No</strong></td>
          <td  align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>UOM</strong></td>
          <td   align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>Order Qty </strong></td>
          <td   align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>Delivery Qty </strong></td>
          <td   align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>Balance</strong></td>
          <td   align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>Remarks</strong></td>
        </tr>
        
        <?    $sqlc = 'select c.*
		 
		 from sale_do_chalan c, item_info i where i.item_id=c.item_id  and c.chalan_no='.$chalan_no.' and c.total_unit>0  ';
			$queryc=mysql_query($sqlc);
			while($datac = mysql_fetch_object($queryc)){
			
			
			
			?>
        <tr style="font-size:12px;">
          <td align="center" valign="top"><?=++$kk;?></td>
          <td align="left" valign="top">
		  <?
		 
		   echo find_a_field('item_info','item_name','item_id='.$datac->item_id);
		 
		  ?></td>
          <td align="center" valign="top"><?=$datac->sr_no;?></td>
          <td align="center" valign="top"><?=$datac->unit_name;?></td>
		  
		  
          <td align="center" valign="top"><? echo $tot_unit=find_a_field('sale_do_details','total_unit','id="'.$datac->order_no.'"');?></td>
          <td align="center" valign="top"><?=number_format($datac->total_unit,2); $grand_tot_unit1 +=$datac->total_unit; ?></td>
          <td align="center" valign="top"><?php 
          
          $tot_all_qty_chalan=find_a_field('sale_do_chalan','sum(total_unit)','do_no="'.$datac->do_no.'" and order_no="'.$datac->order_no.'" and id<="'.$datac->id.'" and item_id="'.$datac->item_id.'"');
         // echo 'select sum(total_unit) from sale_do_chalan where do_no="'.$datac->do_no.'" and id<="'.$datac->id.'" and order_no="'.$datac->order_no.'" and item_id="'.$datac->item_id.'"';
            echo number_format($balance=($datac->total_amt),2); 
          
          $tot_balance+=$balance;?></td>
          <td align="center" valign="top">
		  (<? if($datac->qty_1>0) {?><?=$datac->pcs_1?>Pcs<strong>X</strong><?=$datac->bundle_1?>Bndl<? }?><? if($datac->qty_2>0) {?><strong>+</strong><?=$datac->pcs_2?>Pcs<strong>X</strong><?=$datac->bundle_2?>Bndl<? }?><? if($datac->qty_3>0) {?><strong>+</strong><?=$datac->pcs_3?>Pcs<strong>X</strong><?=$datac->bundle_3?>Bndl<? }?>) </td>
        </tr>
        
        <? }
		
		?>
        <tr style="font-size:12px;">
        <td align="right" valign="middle">&nbsp;</td>
        <td align="right" valign="middle"><strong> Total:</strong></td>
        <? if ($destination_count>0) {?>
        <td align="right" valign="middle">&nbsp;</td><? }?>
		<? if ($referance_count>0) {?>
        <td align="right" valign="middle">&nbsp;</td><? }?>
		<? if ($sku_no_count>0) {?>
        <? }?>
		<? if ($pack_type_count>0) {?>
        <? }?>
		 <? if ($color_count>0) {?>
        <? }?>
		<? if ($size_count>0) {?>
        <? }?>
        <td align="center" valign="middle">&nbsp;</td>
        <td align="center" valign="middle">&nbsp;</td>
        <td align="center" valign="middle"><strong><?=number_format($grand_tot_unit1,2) ;?></strong></td>
        <td align="center" valign="middle"><?=number_format($tot_balance,2)?></td>
        <td align="center" valign="middle">&nbsp;</td>
        </tr>
      </table>
        
	 
	  
	  
      </td>
  </tr>
  
  
  
  
  <tr>
  
  	<td>&nbsp;</td>
  
  </tr>
  

  
  
  <tr>
  	<td colspan="2">
			<table width="100%" border="0" bordercolor="#000000" cellspacing="3" cellpadding="3" >
        <tr>
          <td colspan="4" width="50%"><table width="100%" class="tabledesign" border="1" bordercolor="#000000" cellspacing="0" cellpadding="5"  style="font-size:12px">
        
        <tr>
          <td colspan="4" align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>Challan Summary</strong></td>
          </tr>
        <tr>
          <td width="5%" align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>SL</strong></td>
          <td width="46%" align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>Item Name </strong></td>
          <td width="20%" align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>Qty in Bundle </strong></td>
          <td width="29%" align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>Qty in Pcs </strong></td>
          </tr>
        
        <?  $sqlc = 'select s.sub_group_name, c.delivery_date,  c.item_name as ch_item_name, c.delivery_place,c.printing_info,c.additional_info, c.measurement_unit, sum(c.total_unit) as total_unit, c.unit_price, i.unit_name, c.total_amt, i.item_id, i.item_name, c.ply, c.style_no, c.po_no,  c.paper_combination, c.L_cm, c.W_cm, c.H_cm,
		sum(c.bundle_1+c.bundle_2+c.bundle_3) as tot_bundle
		 from sale_do_chalan c, item_info i,  item_sub_group s, item_group g where i.item_id=c.item_id and i.sub_group_id=s.sub_group_id and s.group_id=g.group_id  and c.chalan_no='.$chalan_no.' group by c.item_id order by s.sub_group_id ';
			$queryc=mysql_query($sqlc);
			while($datac = mysql_fetch_object($queryc)){
			
			
			
			?>
        <tr style="font-size:12px;">
          <td align="center" valign="top"><?=++$kksm;?></td>
          <td align="center" valign="top"><?
		  if ($datac->ch_item_name=="") {
		   echo $datac->item_name;
		  } else {
		   echo $datac->ch_item_name;
		  }
		  ?></td>
          <td align="center" valign="top"><?=number_format($datac->tot_bundle,2);  $tot_bundle_sum1 +=$datac->tot_bundle;?></td>
          <td align="center" valign="top"><?=number_format($datac->total_unit,2); $tot_unit_sum1 +=$datac->total_unit; ?></td>
          </tr>
        
        <? }
		
		?>
        <tr style="font-size:12px;">
        <td colspan="2" align="right" valign="middle"><strong> Total:</strong></td>
        <td align="center" valign="middle"><strong><?=number_format($tot_bundle_sum1,2);?></strong></td>
        <td align="center" valign="middle"><strong><?=number_format($tot_unit_sum1,2) ;?></strong></td>
        </tr>
		
		
		
		
		
		
		
		
		 
        
        
        <?  $sqlc = 'select c.delivery_date, c.delivery_place,c.printing_info,c.additional_info, c.measurement_unit, c.total_unit, c.unit_price, i.unit_name, c.total_amt, i.item_id, i.item_name, c.ply, c.paper_combination, c.L_cm, c.W_cm, c.H_cm from sale_do_details c, item_info i,  item_sub_group s, item_group g where i.item_id=c.item_id and i.sub_group_id=s.sub_group_id and s.group_id=g.group_id  and c.do_no='.$do_no.' group by c.id order by c.id asc';
			$queryc=mysql_query($sqlc);
			while($datac = mysql_fetch_object($queryc)){
			
			
			
			?>
        
        
        <? }
		
		?>
        
      </table></td>
		  <td colspan="3" width="10%">&nbsp;</td>
		  
		  <td colspan="3" width="40%">&nbsp;
		  	
		  </td>
        </tr>
		
		</table>
		
		</td>
</tr>
	
	
	

	<tr>
		<td>
	
	
	<!-- style="border:1px solid #000; color: #000;"-->
	      <div class="footer"> 
	
	<table width="100%" cellspacing="0" cellpadding="0"  >
	
	
		
		
		<tr>
            <td colspan="5">&nbsp;  </td>
		</tr>
		
		 
		 
		

		<tr style="font-size:12px">
            <td align="center" width="20%"><strong> </strong></td>
		    <td  align="center" width="20%"><strong> </strong></td>
		    <td  align="center" width="20%"><strong> <?= find_a_field('user_activity_management','fname','user_id='.$ch_data->entry_by);?> </strong></td>
			<td  align="center" width="20%"><strong>  </strong></td>
			<td  align="center" width="20%"><strong>  </strong></td>
		    </tr>
					<tr>
		  <td align="center">---------------------------------------</td>
		  <td align="center">---------------------------------------</td>
		  <td align="center">---------------------------------------</td>
		  <td align="center">---------------------------------------</td>
		 <td align="center">---------------------------------------</td>
		  </tr>
		<tr style="font-size:12px">
		
		  <td  align="center">Customer</td>
		  <td  align="center">Store</td>
		    <td align="center">Prepared By</td>
		  <td  align="center">Audited By</td>
		  <td  align="center">Authorized</td>
		  </tr>
		<tr style="font-size:12px">
		  <td align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  </tr>
		
		
		<tr>
            <td colspan="2" style="font-size:12px">
                Note: No claims for shortage will be entertained after five days from the delivered date.  </td>
		    <td>This is an ERP generated report </td>
		    </tr>
			
	
			<tr>
            <td colspan="5">&nbsp;  </td>
		</tr>
			
				<tr>
            <td colspan="5"><form method="post" action=""><input type="submit" name="delete" id="delete" value="Delete" class="btn1 btn1-bg-cancel"  /> </form></td>
		</tr>
	
	<?php /*?><tr>
            <td colspan="3">  <hr /> </td>
		</tr>
	
        
	
          <tr>
            <td colspan="3" style="border:0px;border-color:#FFF; color: #000; font-size:16px; text-transform:uppercase; font-weight:700;" align="center" >Nassa Group</td>
		</tr>
		  <tr>
			 <td colspan="3" style="border:0px;border-color:#FFF; color: #000;  font-size:12px; " align="center" >Head Office: 238, Tejgaon Industrial Area, Gulshan Link Road, Dhaka -1208.</td>
		</tr>
		  <tr>
			 <td colspan="3" style="border:0px;border-color:#FFF; color: #000; font-size:12px; " align="center" >Phone: 
			  88-02- 8878543-49. Cell :- +88 01401140030</td>
          </tr>
		  <tr>
			 <td colspan="3" style="border:0px;border-color:#FFF; color: #000; font-size:12px; " align="center" >Web: 
			 www.nassagroup.org</td>
          </tr><?php */?>
	</table>
	  </div>
	</td>
  </tr>
  
  </tbody>
</table>


</div>

<? } else{ 

//echo "<h2 style='color:white;background-color:red;font-weight:bold;text-align:center;'>Invalid Challan NO !!!!</h2>";

}
?>
  
</div>

<?
$main_content=ob_get_contents();
ob_end_clean();
include ("../../template/main_layout.php");
?>