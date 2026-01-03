<?php
session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";
$title='Sales Order Delete';

create_combobox('dealer_code');
create_combobox('do_no');
create_combobox('chalan_no');

do_calander('#fdate');
do_calander('#tdate');




$do_no 		= $_GET['work_or'];


$master= find_all_field('sale_do_master','','do_no='.$do_no);




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


div.form-container_large input {
    width: 280px;
    height: 38px;
    border-radius: 0px !important;
}

tr:nth-child(odd){
    
    
    color:white;
}

td,th{
 font-weight:200px;
}

</style>
<?




if(isset($_POST['wo_delete']))
{
		$count=find_a_field('sale_do_chalan','count(chalan_no)','do_no="'.$_GET['work_or'].'" ');
			 
		 
		 
		if($count>0)
		{
			echo '<h4 style="color:white;background-color:red;font-weight:bold;text-align:center;" >'."This work order already has challan.So you can not delete this work order.".'</h4>';
		
		
		} 
		else
		{
		    $all_data=find_all_field('sale_do_details','*','do_no="'.$_GET['work_or'].'" ');
		    
		   
		    if($all_data->do_no==$_GET['work_or'])
		    
		    {
			
			$delete_user=$_SESSION['user']['id'];
	 $delete_time=date('Y-m-d  h:i:sa');
		    $in_back_query='insert into sale_do_details_delete_log select * from sale_do_details where do_no="'.$_GET['work_or'].'" ';
		 mysql_query($in_back_query);
		   $up_sql='update sale_do_details_delete_log set delete_by="'.$delete_user.'",delete_at="'.$delete_time.'" where do_no="'.$_GET['work_or'].'" ';
	 mysql_query($up_sql);
			
			
			
			
		
			$delete_do_details="delete from sale_do_details where do_no='".$_GET['work_or']."' ";
			
			 mysql_query($delete_do_details);
			
			$delete_do_master="delete from sale_do_master where do_no='".$_GET['work_or']."' ";
			
			 mysql_query($delete_do_master);
			
		echo "<h2 style='color:white;background-color:green;font-weight:bold;text-align:center;'>Delete Successfully!!!!</h2>";
		
		    }
			
			//else{
//		        
//		        echo "<h2 style='color:white;background-color:red;font-weight:bold;text-align:center;'> Invalid Number!!! </h2>";
//		    }
		}
		
		
	



}

?>

<?
		if(isset($_POST['work_order']))
		{
		
			header("Location: so_view_delete.php?work_or=".$_POST['so_no']." ");
		
		}

?>



<div class="form-container_large">
  <form action="" method="post" name="codz" id="codz">
    <table width="80%" border="0" align="center">
      
      
      <tr>
        <td align="right" bgcolor="#FF9966"><strong>Work Order No:</strong></td>
        <td colspan="3" bgcolor="#FF9966">
		<input type="text" name="so_no" id="so_no" class="form-control" />		</td>
		<td><input type="submit" name="work_order" id="work_order" value="Work Order View"  class="btn1 btn1-bg-submit" /></td>
      </tr>
      
      
      
    </table>
	
	
	
	
  </form>
  
  <br /><br />
  <?
	$count=find_a_field('sale_do_master','count(do_no)','do_no="'.$do_no .'"');

	if($count>0)
	{
?>
  <table width="1200" border="0" cellspacing="0" cellpadding="0" align="center">

  <tbody>

  <tr>
    <td><div class="header">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="20%">
                        
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
  	  <td  style="text-align:center; color:#FFF; font-size:18px; padding:0px 0px 10px 0px; color:#000000; font-weight:bold;"><span style="text-decoration:underline">WORK ORDER</span> </td>
  	  <td valign="right" align="right">&nbsp;</td>
	  </tr>
  	<tr>
		<td width="25%" valign="top"></td>
			<td width="50%" valign="middle" align="center"><strong>FSC CERTIFICATE CODE: SGSHK-COC-410096 </strong></td>
		<td width="25%" valign="right" align="right"></td>
	</tr>
	
	<tr>
		<td width="25%" valign="top"><strong>Attn: All Concern </strong></td>
			<td width="50%" valign="middle" align="center">&nbsp;</td>
		<td width="25%" valign="right" align="right">&nbsp;</td>
	</tr>
	<tr>
	  <td colspan="3" valign="top" style="font-size:12px; padding: 5px 0px 0px 0px; " >We are pleased to inform you that a PO is received and below is the details :</td>
	  </tr>
  </table>
  
  </td></tr>
  
  
  <tr> <td>&nbsp;</td></tr>
  
  
  
 <tr> <td><table width="100%" border="0" cellspacing="0" cellpadding="0">


		  <tr>


		    <td width="80%" valign="top">


		      <table width="96%" border="0" cellspacing="0" cellpadding="3"  style="font-size:12px">


		        <tr>
		          <td width="20%" align="left" valign="middle"><strong>Job No: </strong></td>
		          <td width="40%"><strong><?php echo $master->job_no;?></strong></td>
				   <td width="40%" align="left" valign="middle"><strong>Booking Ref No:   </strong>  <?php echo $master->booking_reference;?></td>
		         
	            </tr>
		        <tr>
		          <td width="20%" align="left" valign="middle"><strong>Customer Name: </strong></td>
		          <td width="40%"><?= find_a_field('dealer_info','dealer_name_e','dealer_code="'.$master->dealer_code.'"');?></td>
				     <td width="40%" align="left" valign="middle"><strong>Booking Date:   </strong>      <?php echo $master->booking_date;?></td>
		      
	            </tr>
		        <tr>
		          <td align="left" valign="middle"><strong> Buyer Name:</strong></td>
		          <td><?= find_a_field('buyer_info','buyer_name','buyer_code="'.$master->buyer_code.'"');?></td>
				  <td><strong>Order Date: <?=date("d M, Y",strtotime($master->do_date))?></strong></td>
	            </tr>
		        <tr>
		          <td align="left" valign="middle"><strong>Customer's PO: </strong></td>
		          <td><?php echo $master->customer_po_no;?></td>
	            </tr>
		        <tr>
		          <td align="left" valign="middle"><strong> Merchandiser Name:</strong></td>
		          <td><?= find_a_field('merchandizer_info','merchandizer_name','merchandizer_code="'.$master->merchandizer_code.'"');?></td>
	            </tr>
		        <tr>
		          <td align="left" valign="middle"><strong> Mobile No:</strong></td>
		          <td><?= find_a_field('merchandizer_info','mobile_no','merchandizer_code="'.$master->merchandizer_code.'"');?></td>
	            </tr>
		        <tr>
		          <td align="left" valign="middle"><strong>Marketing Officer: </strong></td>
		          <td><?= find_a_field('marketing_person','marketing_person_name','person_code="'.$master->marketing_person.'"');?></td>
	            </tr>
		        <tr>
		          <td align="left" valign="middle"><strong> Mobile No:</strong></td>
		          <td><?= find_a_field('marketing_person','mobile_no','person_code="'.$master->marketing_person.'"');?></td>
	            </tr>
					 <tr>
		          <td align="left" valign="middle"><strong> Remarks:</strong></td>
		          <td><?php echo $master->remarks;?></td>
	            </tr>
				
		        <tr>
		          <td align="right" valign="center">&nbsp;</td>
		          <td>&nbsp;</td>
		          </tr>
		        </table>		      </td>


			
		  </tr>


		</table>		</td></tr>
  
  
 
  <tr>
    <td>
      
      <table width="92%" class="tabledesign" border="1" bordercolor="#000000" cellspacing="0" cellpadding="5"  style="font-size:10px">
       
        <tr>
          <td   align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>SL</strong></td>
          <td   align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>Item Name </strong></td>
          <td   align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>Style No </strong></td>
          <td   align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>PO No </strong></td>
          <td   align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>Color</strong></td>
          <td  align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>Size</strong></td>
      <!--    <td width="3%" align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>Ply</strong></td>-->
          <td   align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>Measurement</strong></td>
               <td   align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>Flap</strong></td>
             <!--   <td   align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>Printing Info </strong></td>-->
		   <td   align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>SKU No </strong></td>
         
          <td   align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>Unit Name  </strong></td>
             <td   align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>Qty in Pcs</strong></td>
          <td   align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>Quantity</strong></td>
          <td   align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>USD Price  </strong></td>
          <td   align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>USD Amount </strong></td>
          <td   align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>Convertion Rate</strong> </td>
          <td   align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>BD Rate </strong></td>
          <td   align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>BD Amount </strong></td>
        </tr>
        
        <?  $sqlc = 'select c.delivery_date, c.delivery_place,c.printing_info,c.additional_info, c.measurement_unit, c.total_unit, c.unit_price, i.unit_name, c.total_amt, i.item_id, i.item_name, c.color, c.style_no, c.po_no,  c.size, c.L_cm, c.W_cm, c.H_cm,c.usd_price,c.usd_amt,c.convert_rate,c.qty_pcs,c.addi_measurement,c.sku_no,c.flap from sale_do_details c, item_info i,  item_sub_group s, item_group g where i.item_id=c.item_id and i.sub_group_id=s.sub_group_id and s.group_id=g.group_id  and c.do_no='.$do_no.' group by c.id order by c.id asc';
			$queryc=mysql_query($sqlc);
			while($datac = mysql_fetch_object($queryc)){
			
			
			
			?>
        <tr style="font-size:12px;">
          <td align="center" valign="top"><?=++$kk;?></td>
          <td align="left" valign="top"><?=$datac->item_name;?></td>
          <td align="left" valign="top"><? 
		  if ($datac->style_no!="") {
		  echo $datac->style_no;
		  } else {
		  echo 'N/A';
		  }
		  ?></td>
          <td align="left" valign="top">
		  
		  <? 
		  if ($datac->po_no!="") {
		  echo $datac->po_no;
		  } else {
		  echo 'N/A';
		  }
		  ?>		  </td>
<td align="left" valign="top"><?=$datac->color;?></td>
          <td align="left" valign="top"><?=$datac->size;?></td>
     
          <td align="center" valign="top"><? if($datac->L_cm>0) {?>L-<?=$datac->L_cm?><? }?><? if($datac->W_cm>0) {?>X W-<?=$datac->W_cm?><? }?><? if($datac->H_cm>0) {?>X H-<?=$datac->H_cm?><? }?> <?=$datac->measurement_unit."<br>".$datac->addi_measurement?></td>
             <td align="center" valign="top"><?=$datac->flap;?></td>
           <!--<td align="center" valign="top"><?=find_a_field('printing_information','printing_information','id='.$datac->printing_info);?></td>-->
        
		    <td align="center" valign="top"><?=$datac->sku_no;?></td>
           

          <td align="center" valign="top"><?=$datac->unit_name;?></td>
           <td align="center" valign="top"><?=number_format($datac->qty_pcs,2);?></td>
          <td align="center" valign="top"><?=number_format($datac->total_unit,2);?></td>
          <td align="center" valign="top"><?=number_format($datac->usd_price,4);?></td>
          <td align="center" valign="top"><?=number_format($datac->usd_amt,4);?></td>
          <td align="center" valign="top"><?=number_format($datac->convert_rate,2);?></td>
          <td align="center" valign="top"><?=number_format($datac->unit_price,2);?></td>
          <td align="center" valign="top"><?=number_format($datac->total_amt,2);?></td>
        </tr>
        
        <? 
		$total_usd_amt+=$datac->usd_amt;
			$total_qty_pcs+=$datac->qty_pcs;
		$total_unit+=$datac->total_unit;
		$total_bd_amt+=$datac->total_amt;
		}
		
		?>
        <tr style="font-size:12px;">
        <td colspan="7" align="right" valign="middle"><strong> Total:</strong></td>
        <td align="center" valign="middle">&nbsp;</td>
        <td align="center" valign="middle">&nbsp;</td>
        <td align="center" valign="middle">&nbsp;</td>
            <td align="center" valign="middle"><strong>
          <?=number_format($total_qty_pcs,2) ;?>
        </strong></td>
        <td align="center" valign="middle"><strong>
          <?=number_format($total_unit,2) ;?>
        </strong></td>
        <td align="center" valign="middle">&nbsp;</td>
        <td align="center" valign="middle"><strong>
          <?=number_format($total_usd_amt,2) ;?>
        </strong></td>
        <td align="center" valign="middle">&nbsp;</td>
        <td align="center" valign="middle">&nbsp;</td>
        <td align="center" valign="middle"><strong>
          <?=number_format($total_bd_amt,2) ;?>
        </strong></td>
        </tr>
      </table>
        
	 
	  

	  
      </td>
  </tr>
  
  
  
  
  <tr>
  
  	<td>&nbsp;</td>
  
  </tr>
  
  
  <tr>
  	<td colspan="2">
			<table width="92%" border="0" bordercolor="#000000" cellspacing="3" cellpadding="3" class="" >
        <tr>
          <td colspan="4" width="50%"><table width="100%" class="tabledesign" border="1" bordercolor="#000000" cellspacing="0" cellpadding="5"  style="font-size:12px">
        
        <tr>
          <td colspan="3" align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>Summary</strong></td>
          </tr>
        <tr>
          <td width="7%" align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>SL</strong></td>
          <td width="65%" align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>Measurement</strong></td>
          <td width="28%" align="center" bordercolor="#000000" bgcolor="#CCCCCC"><strong>Quantity</strong></td>
          </tr>
        
        <?  $sqlc = 'select c.delivery_date, c.delivery_place,c.printing_info,c.additional_info, c.measurement_unit, sum(c.total_unit) as total_unit, c.unit_price, i.unit_name, c.total_amt, i.item_id, i.item_name, c.ply, c.style_no, c.po_no,  c.paper_combination, c.L_cm, c.W_cm, c.H_cm from sale_do_details c, item_info i,  item_sub_group s, item_group g where i.item_id=c.item_id and i.sub_group_id=s.sub_group_id and s.group_id=g.group_id  and c.do_no='.$do_no.' group by c.L_cm, c.W_cm, c.H_cm, c.measurement_unit order by c.id asc';
			$queryc=mysql_query($sqlc);
			while($datac = mysql_fetch_object($queryc)){
			
			
			
			?>
        <tr style="font-size:12px;">
          <td align="center" valign="top"><?=++$kksm;?></td>
          <td align="center" valign="top"><? if($datac->L_cm>0) {?><?=$datac->L_cm?><? }?><? if($datac->W_cm>0) {?>X<?=$datac->W_cm?><? }?><? if($datac->H_cm>0) {?>X<?=$datac->H_cm?><? }?> <?=$datac->measurement_unit?></td>
          <td align="center" valign="top"><?=number_format($datac->total_unit,2); $tot_unit_sum +=$datac->total_unit; ?></td>
          </tr>
        
        <? }
		
		?>
        <tr style="font-size:12px;">
        <td colspan="2" align="right" valign="middle"><strong> Total:</strong></td>
        <td align="center" valign="middle"><strong><?=number_format($tot_unit_sum,2) ;?></strong></td>
        </tr>
		
		
		
		
		
		
		
		
		 
        
        
        <?  $sqlc = 'select c.delivery_date, c.delivery_place,c.printing_info,c.additional_info, c.measurement_unit, c.total_unit, c.unit_price, i.unit_name, c.total_amt, i.item_id, i.item_name, c.ply, c.paper_combination, c.L_cm, c.W_cm, c.H_cm from sale_do_details c, item_info i,  item_sub_group s, item_group g where i.item_id=c.item_id and i.sub_group_id=s.sub_group_id and s.group_id=g.group_id  and c.do_no='.$do_no.' group by c.id order by c.id asc';
			$queryc=mysql_query($sqlc);
			while($datac = mysql_fetch_object($queryc)){
			
			
			
			?>
        
        
        <? }
		
		?>
        
      </table></td>
		  <td colspan="3" width="10%">&nbsp;</td>
		  
		  <td colspan="3" width="40%">
		  	<table width="100%" border="1" style="font-size:12px" class="">
			<tr>
				<td width="61%"><div align="right"><strong>Total Order Quantity: </strong></div></td>
				<td width="39%" align="center"><strong>
				  <?=number_format($total_unit,2) ;?>
				</strong></td>
			</tr>
			
		
			
			<tr>
				<td width="61%"><div align="right"><strong>Total Order Value: </strong></div></td>
				<td width="39%" align="center"><strong><?=number_format($grand_tot_amt=find_a_field('sale_do_details','sum(total_amt)','do_no='.$master->do_no),2);?>
				</strong></td>
			</tr>
	  </table>
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
            <td colspan="4">&nbsp;  </td>
		</tr>
		
		<tr>
		  <td align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  </tr>
		<tr style="font-size:12px">
            <td align="center" width="25%">&nbsp;</td>
		    <td  align="center" width="25%">&nbsp;</td>
		    <td  align="center" width="25%">&nbsp;</td>
		    <td align="center"  width="25%">&nbsp;</td>
		</tr>
		
		<tr>
            <td colspan="2">Prepared By :
                <?=find_a_field('user_activity_management','fname','user_id='.$master->entry_by);?>,&nbsp; Prepared At :
                <?=$master->entry_at?>  </td>
		    <td colspan="2">This is an ERP generated report </td>
		    </tr>
		<tr>
		  <td colspan="2">Approved By :
            <?=find_a_field('user_activity_management','fname','user_id='.$master->checked_by);?>
            ,&nbsp; Approved At :
            <?=$master->checked_at?></td>
		  <td colspan="2">&nbsp;</td>
		  </tr>
		  
		  <tr>
            <td colspan="3">&nbsp;  </td>
		</tr>
		
		<tr>
            <td colspan="6"><form  method="post"><input type="submit" name="wo_delete" id="wo_delete" value="Delete Work Order" class="btn1 btn1-bg-cancel"  /></form> </td>
		</tr>
	
	<?php /*?><tr>
            <td colspan="4">  <hr /> </td>
		</tr>
	
        
	
          <tr>
            <td colspan="4" style="border:0px;border-color:#FFF; color: #000; font-size:16px; text-transform:uppercase; font-weight:700;" align="center" >Nassa Group</td>
		</tr>
		  <tr>
			 <td colspan="4" style="border:0px;border-color:#FFF; color: #000;  font-size:12px; " align="center" >Head Office: 238, Tejgaon Industrial Area, Gulshan Link Road, Dhaka -1208.</td>
		</tr>
		  <tr>
			 <td colspan="4" style="border:0px;border-color:#FFF; color: #000; font-size:12px; " align="center" >Phone: 
			  88-02- 8878543-49. Cell :- +88 01401140030</td>
          </tr>
		  <tr>
			 <td colspan="4" style="border:0px;border-color:#FFF; color: #000; font-size:12px; " align="center" >Web: 
			 www.nassagroup.org</td>
          </tr><?php */?>
	</table>
	  </div>
	</td>
  </tr>
  
  </tbody>
</table>
<? } ?>

</div>



<?
$main_content=ob_get_contents();
ob_end_clean();
include ("../../template/main_layout.php");
?>