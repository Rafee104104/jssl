<?php



session_start();

require_once "../../../assets/template/layout.top.php";

require_once ('../../../acc_mod/common/class.numbertoword.php');

$chalan_no 		= $_REQUEST['v_no'];

$group_data = find_all_field('user_group','group_name','id='.$_SESSION['user']['group']);


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
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?=$master->job_no;?> - CH<?=$chalan_no;?></title>
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

@media print {
  .brack {page-break-after: always;}
}


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
                        <td width="20%">
                        <img src="../../../logo/1.png" style="width:100%;" />
                        <td width="60%"><table  width="80%" border="0" align="center" cellpadding="3" cellspacing="0">
                            <tr>
                              <td style="text-align:center; color:#000; font-size:14px; font-weight:bold;">
						
								<p style="font-size:18px; color:#000000; margin:0; padding: 0 0 5px 0; text-transform:uppercase;  font-weight:700; font-family: 'TradeGothicLTStd-Extended';"><?=find_a_field('user_group','group_name','id='.$master->group_for)?></p>
<p style="font-size:14px; font-weight:300; color:#000000; margin:0; padding:0;"><?=find_a_field('user_group','address','id='.$master->group_for)?></p>
<p style="font-size:14px; font-weight:300; color:#000000; margin:0; padding:0;"><?=find_a_field('user_group','factory_address','id='.$master->group_for)?></p>
								<p style="font-size:12px; font-weight:300; color:#000000; margin:0; padding:0;">Phon No. : <?=$group_data->mobile?>,  Email : <?=$group_data->email?></p>                              </td>
                            </tr>
                            <tr>


        <!--<td bgcolor="#666666" style="text-align:center; color:#FFF; font-size:18px; font-weight:bold;">WORK ORDER </td>-->
      </tr>
                          </table>
                        <td width="20%"> 
						
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					
					<tr>
					  
					  <td align="center"><h4 style="font-size:16px;">কাস্টমার কপি</h4></td>
					  </tr>
                      
					  
					  <tr>
					  
					  <td><?='<img class="barcode" alt="'.$barcodeText.'" src="barcode.php?text='.$barcodeText.'&codetype='.$barcodeType.'&orientation='.$barcodeDisplay.'&size='.$barcodeSize.'&print='.$printText.'"/>' ?></td>
					  </tr>
					  
					  <tr>
					  
					  <td><span style="font-size:14px; padding: 3px 0 0 10px; letter-spacing:7px;"><?=$chalan_no?></span></td>
					  </tr>
					  </table>						</td>
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
  	  <td width="50%"  style="text-align:center; color:#FFF; font-size:18px; padding:0px 0px 10px 0px; color:#000000; font-weight:bold;"><span style="text-decoration:underline">ডেলিভারী চালান </span> </td>
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
		          <td width="13%" align="left" valign="middle" style="font-size:15px; font-weight:700;">ক্রেতার নাম</td>
		          <td width="30%" style="font-size:15px; font-weight:700;">:	&nbsp;
		            <?=$ch_data->rec_name; // find_a_field('dealer_info','dealer_name_e','dealer_code="'.$master->dealer_code.'"');?></td>
	              <td width="10%" style="font-size:15px; font-weight:700;" >Do No </td>
	              <td width="18%" style="font-size:15px; font-weight:700;">: &nbsp;<?=$ch_data->chalan_no;?></td>
	              <td>অর্ডার নং</td>
	              <td>: &nbsp;<?php echo $ch_data->do_no;?></td>
		        </tr>
		        <tr>
					
					<td align="left" valign="middle">বুকিংকারীর নাম</td>
		          <td>:	&nbsp;
                    <?= find_a_field('paid_booking','name','booking_number_eng="'.$ch_data->booking_no.'"');?></td>
					
		          <td>অর্ডার তারিখ </td>
	              <td>: &nbsp;<?php echo date('d-m-Y',strtotime($ch_data->do_date));?> </td>
	              <td>বুকিং নং </td>
	              <td>: 
	                &nbsp;<?=$ch_data->booking_no;?></td>
	              
		        </tr>
		        <tr>
		          <td align="left" valign="middle">সংরক্ষণকারীর নাম</td>
		          <td>:	&nbsp;
				  
		            <? 
						$chalan_sql='select c.chalan_no,c.booking_no,r.farmer_name,c.sr_no from sale_do_chalan c,warehouse_other_receive r where c.sr_no=r.bag_mark and r.booking_number=c.booking_no and  c.chalan_no="'.$chalan_no .'"';
					$querys_chalan=mysql_query($chalan_sql);
					while($chalanvalue=mysql_fetch_object($querys_chalan))
					{
					
					echo $chalanvalue->farmer_name.',';
					
					}
					
					 ?></td>
	              <td style="font-size:15px; font-weight:600;" >চালানের তারিখ </td>
	              <td style="font-size:15px; font-weight:700;">: &nbsp;<?php echo date('d-m-Y',strtotime($ch_data->chalan_date));?></td>
	              <!--<td>Delivery Man </td>
	              <td>: &nbsp;<?=$ch_data->delivery_man;?></td>-->
		        </tr>
		        
		        
		        
		        </table>		      </td>
		  </tr>


		</table>		</td></tr>
  
  
 
  <tr>
    <td><div id="pr">
        <div align="left">
          <p>
            <input name="button" type="button" onClick="hide();window.print();" value="Print" />
          </p>
          <nobr>
          <!--<a href="chalan_bill_view.php?v_no=<?=$_REQUEST['v_no']?>">Bill</a>&nbsp;&nbsp;--><!--<a href="do_view.php?v_no=<?=$_REQUEST['v_no']?>" target="_blank"><span style="display:inline-block; font-size:14px; color: #0033FF;">Bill Copy</span></a>-->
          </nobr>
		  <nobr>
          
          <!--<a href="chalan_bill_distributor_vat_copy.php?v_no=<?=$_REQUEST['v_no']?>" target="_blank">Vat Copy</a>-->
          </nobr>	    </div>
      </div>
      <br><br>
      <table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#000000" class="tabledesign"  style="font-size:12px">
        <tr>
          <th width="4%" bgcolor="#CCCCCC">ক্রমিক নং</th>
          <th width="9%"  bgcolor="#CCCCCC">এস.আর নং </th>
		  
          <th width="10%" bgcolor="#CCCCCC">পরিমান</th>
          
          <th width="10%" bgcolor="#CCCCCC">কেজি</th>
		  <th width="10%" bgcolor="#CCCCCC">ইউনিট মূল্য </th>
          <th width="10%" bgcolor="#CCCCCC">ভাড়া </th>
		  <th width="10%" bgcolor="#CCCCCC">লেবার চার্জ </th>
          <th width="10%" bgcolor="#CCCCCC">এস.আর লোন</th>
          
          <th width="10%" bgcolor="#CCCCCC">বীজ লোন </th>
          <th width="9%" bgcolor="#CCCCCC">বস্তা লোন </th>
          <th width="10%" bgcolor="#CCCCCC">চাষী লোন </th>
          <th width="10%" bgcolor="#CCCCCC">অনন্যা লোন </th>
          <th width="21%" bgcolor="#CCCCCC">দিন </th>
          <th width="21%" bgcolor="#CCCCCC">ইন্টারেস্ট</th>
		  <?
		  $btype=find_a_field('paid_booking','booking_type','booking_number_eng="'.$ch_data->booking_no.'"');
			$paid_booking_amt=$unit_price*$total_quantity;
		
		if($btype!='Paid Booking'){ ?>
		
          <th width="21%" bgcolor="#CCCCCC">লেস(0.75) পয়সা </th>
		  
		 
          <th width="21%" bgcolor="#CCCCCC">সর্বমোট</th>
		  
		   <? }elseif($btype=='Paid Booking') {  ?>
		   <th width="21%" bgcolor="#CCCCCC">অগ্রিম বাদ</th>
		   <th width="21%" bgcolor="#CCCCCC">সর্বমোট</th>
		   <? } ?>
        </tr>
        <? 

   
 $res='select  s.*,i.item_name

 from sale_do_chalan s,item_info i
 
 WHERE s.item_id=i.item_id and s.chalan_no='.$chalan_no.' group by s.id';
   
   $i=1;

$query = mysql_query($res);

while($data=mysql_fetch_object($query)){

?>
        <tr>
          <td><?=$i++?></td>
          <td style="font-size:15px; font-weight:600;" ><?=$data->sr_no?></td>
		   
          <td><?=$data->total_unit?></td>
         
          <td><?=$data->challan_in_kg?></td>
		  <td><?=$data->challan_per_kg_price?></td>
          <td><?=$data->store_rent?></td>
		  <td><?=$data->labour_charge?></td>
          <td><?=$data->sr_loan?></td>
          
          <td><?=$data->seeds_loan?></td>
          <td><?=$data->bag_loan?></td>
          <td><?=$data->farmer_loan?></td>
          <td><?=$data->others_loan?></td>
          <td><?=$data->loan_days?></td>
          <td><?=$data->total_interest?></td>
		  <?
		  $btype=find_a_field('paid_booking','booking_type','booking_number_eng="'.$ch_data->booking_no.'"');
			$paid_booking_amt=$unit_price*$total_quantity;
		
		if( $btype!='Paid Booking'){ ?>
		
          <td style="text-align:right"><?=number_format($less_bal=($data->challan_in_kg*0.75),2);?></td>
		  
		 
          <td style="text-align:right"><?=number_format($total_amt=($data->store_rent+$data->bag_loan+$data->sr_loan+$data->farmer_loan+$data->total_interest)-$less_bal,2)?></td>
		  
		   <? } elseif($btype=='Paid Booking') {  ?>
		    <td style="text-align:right"><?=number_format($data->store_rent,2);?></td>
		   <td style="text-align:right"><?=$total_paid_amt=$data->labour_charge+$data->bag_loan+$data->sr_loan+$data->farmer_loan?></td>
		    <? } ?>
        </tr>
        <?
		$price = $data->challan_per_kg_price;
 $decimalPart = fmod($price, 1);
$total_less_bal+=$less_bal;
$total_quantity = $total_quantity + $data->total_unit;
$total_bag_size = $total_bag_size + $data->bag_size;
$tot_store_rent+=$data->store_rent;
$tot_labour_charge+=$data->labour_charge;
$tot_bag+=$data->bag_loan;
$tot_seeds+=$data->seeds_loan;
$tot_farmer+=$data->farmer_loan;
$tot_others+=$data->others_loan;
$tot_interest+=$data->total_interest;
$tot_sr_loan+=$data->sr_loan;
$unit_price=$data->unit_price;
$total_amount2 = $total_amount2 + $total_amt;
$total_amount = $total_amount + $data->total_amt;
$tot_chalan_kg+=$data->challan_in_kg;
$total_paid_balance+=$total_paid_amt;
		 }
		
		?>
        <tr>
          <td colspan="2"><div align="right"><strong>মোট:</strong></div></td>
          
          <td><strong>
            <?=number_format($total_quantity,0);?>
          </strong></td>
		 
          <td><strong><?=number_format($tot_chalan_kg,0);?></strong></td>
		   <td></td>
          <td><strong>
            <?=number_format($tot_store_rent,0);?>
          </strong></td>
		   <td><strong>
            <?=number_format($tot_labour_charge,0);?>
          </strong></td>
		  <td><strong>
            <?=number_format($tot_sr_loan,0);?>
          </strong></td>
		 
		  <td><strong>
            <?=number_format($tot_seeds,0);?>
          </strong></td>
		  <td><strong>
            <?=number_format($tot_bag,0);?>
          </strong></td>
		  <td><strong>
            <?=number_format($tot_farmer,0);?>
          </strong></td>
		  <td><strong>
            <?=number_format($tot_others,0);?>
          </strong></td>
          <td><strong>
            
          </strong></td>
          <td><strong>
            <?=number_format($tot_interest,0);?>
          </strong></td>
          <td style="text-align:right"><strong><?=number_format($total_less_bal,2);?></strong></td>
          <td style="text-align:right"><strong>
              <?php
			  
			  if($btype=='Paid Booking')
			{
			echo number_format($net_amt=$total_paid_balance,2);
			
			}
			else{
			$floor = floor($total_amount2);
			$decimal = $total_amount2 - $floor;
			if ($decimal >= 0.50) {
				$floor += 1;
			}
			echo number_format($floor, 2, '.', '');
			}

?>
 </td>
        </tr>
        <?php 
			$btype=find_a_field('paid_booking','booking_type','booking_number_eng="'.$ch_data->booking_no.'"');
			$paid_booking_amt=$unit_price*$total_quantity;
		
	
?>
        <tr>
          <td colspan="12"><div align="right"><strong>সর্বমোট:</strong></div></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td style="text-align:right">&nbsp;</td>
          <td style="text-align:right"><strong>
            <?
			if($btype=='Paid Booking')
			{
			echo number_format($net_amt=$total_paid_balance,2);
			
			}
			else
			{
			echo number_format($net_amt=$floor,2);
			}
			?>
          </strong></td>
        </tr>
        
        <tr style="font-size:16px; font-weight:500; letter-spacing:.3px;">
          <td colspan="17">In Word:
            <?

		

		$scs =  round($net_amt);

			 $credit_amt = explode('.',$scs);

	 if($credit_amt[0]>0){

	 

	 echo convertNumberToWordsForIndia($credit_amt[0]);}

	 if($credit_amt[1]>0){

	 if($credit_amt[1]<10) $credit_amt[1] = $credit_amt[1]*10;

	 echo  ' & '.convertNumberToWordsForIndia($credit_amt[1]).' paisa ';}

	 echo 'Taka Only';

		?>. </td>
        </tr>
      </table></td>
  </tr>
  
  
  
  
  <tr>
  
  	<td>&nbsp;</td>
  </tr>
  

  
  
  
	
	
	

	<tr>
		<td>
	
	
	<!-- style="border:1px solid #000; color: #000;"-->
	      <div class="footer"> 
	
	<table width="100%" cellspacing="0" cellpadding="0"  >
	
	
		
		<tr>
		  <td colspan="3">&nbsp;</td>
		  </tr>
	
		
		
		
		<tr>
		  <td align="center" >&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  
		  </tr>
		   <tr>
		  <td align="center" ></td>
		  <td align="center" ><?php
		  
		 $ucid=find_a_field('sale_do_master','entry_by','do_no="'.$do_no.'"');
		   echo find_a_field('user_activity_management','fname','user_id="'.$ucid.'"')?></td>
		   
		   <td align="center" ><?php
		  
		 $ucid=find_a_field('sale_do_chalan','entry_by','do_no="'.$do_no.'" and chalan_no="'.$_GET['v_no'].'"');
		   echo find_a_field('user_activity_management','fname','user_id="'.$ucid.'"')?></td>
		   <td align="center" ><?php
		  
		 $ucid=find_a_field('sale_do_chalan','aprroved_by3','do_no="'.$do_no.'" and chalan_no="'.$_GET['v_no'].'"');
		   echo find_a_field('user_activity_management','fname','user_id="'.$ucid.'"')?></td>
		  <td align="center">
		   		  </td>
		  
		  </tr>
		<tr>
		  <td align="center" >---------------------------------</td>
		  <td align="center">---------------------------------</td>
		  <td align="center">---------------------------------</td>
		  <td align="center">---------------------------------</td>
		  <td align="center">---------------------------------</td>
		 
		   
		  </tr>
		<tr>
		  <td align="center"></td>
		  <td align="center"></td>
		  <td align="center"></td>
		  
		  </tr>
		<tr style="font-size:12px">
            <td align="center" width="20%"><strong>গ্রহীতার সাক্ষর</strong></td>
			<td  align="center" width="20%"><strong>SO Prepared By</strong></td>
			<td  align="center" width="20%"><strong>DO Prepared By</strong></td>
			 <td  align="center" width="20%"><strong>Approved By</strong></td>
		    <td  align="center" width="20%"><strong>Cash Received</strong></td>
		   
		    
		    </tr>
		<tr style="font-size:12px">
		  <td align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  
		  </tr>
		
		<tr style="font-size:12px">
		  <?
		  
		  if(isset($_POST['approve']))
		  {
		  
		  if($_GET['v_no']>0)
		  {
		  	$sql="select sum(store_rent) as total_store_rent,sum(labour_charge) as total_labour_charge,sum(seeds_loan) as total_seeds_loan,sum(bag_loan) as total_bag_loan,sum(sr_loan) as total_sr_loan,sum(farmer_loan) as total_farmer_loan,sum(others_loan) as total_others_loan,sum(total_interest) as total_total_interest,chalan_date,chalan_no,dealer_code,booking_no,sr_no,sum(challan_in_kg) as kg  from sale_do_chalan where chalan_no='".$_GET['v_no']."' group by chalan_no";
			$sql_query=mysql_query($sql);
			$row=mysql_fetch_object($sql_query);
			
				$tot_store_rent=$row->total_store_rent;
				$tot_labour_charge=$row->total_labour_charge;
				$tot_seeds_loan=$row->total_seeds_loan;
				$tot_bag_loan=$row->total_bag_loan;
				$tot_sr_loan=$row->total_sr_loan;
				$tot_farmer_loan=$row->total_farmer_loan;
				$tot_others_loan=$row->total_others_loan;
				$tot_interests=$row->total_total_interest;
				$tot_challan_in_kg=$row->kg;
			
			if($tot_sr_loan>0)
			{
			
			$loan_return = "INSERT INTO `sr_loan_return`
			( `recdate`,  `dealer_code_eng`, `booking_number`, `sr_number`,   `interest_amt`,
			 `total_paid`,  `entry_by`, `cash_ledger`, chalan_no) 
				VALUES 
			 ( '".$row->chalan_date."','".$row->dealer_code."','".$row->booking_no."','".$row->sr_no."','".$row->total_total_interest."',
			 '".$row->total_sr_loan."', '".$_SESSION['user']['id']."', '".$cash_ledger."', '".$row->chalan_no."')";
			 $query = mysql_query($loan_return);
			
			
			}
			
		  
		  		$total_loan=$tot_seeds_loan+$tot_bag_loan+$tot_farmer_loan+$tot_sr_loan+$tot_others_loan;
				$total_loan_actual=$total_loan;
				//$total_rent+=$store_rent;
				$total_store_rent_actual=$tot_store_rent;
				
				$total_store_rent_actual_normal=round($tot_store_rent-($tot_challan_in_kg*0.75));
				$total_rent_and_loan=$total_loan;
				
				$total_sales_amt = $total_rent_and_loan;
				
				$cash=$total_loan_actual+$tot_labour_charge+$tot_interests+$total_store_rent_actual;
				$total_cash=$cash;
				
				$total_paid_cash=$tot_labour_charge;
				
				
	
  
			  $user_id = $_SESSION['user']['id'];
			  
			  $all_data = find_all_field('sale_do_chalan','','chalan_no = "'.$_GET['v_no'].'" ');
			  $total_bag = find_a_field('sale_do_chalan','sum(total_unit)','chalan_no = "'.$_GET['v_no'].'" ');
			  $bag_rate = find_a_field('sale_do_chalan','unit_price','chalan_no = "'.$_GET['v_no'].'" ');
			   $paid_bag_loan = find_a_field('sale_do_chalan','sum(bag_loan)','chalan_no = "'.$_GET['v_no'].'" ');
			  $booking_info = find_all_field('paid_booking','booking_id','booking_number_eng like "'.$all_data->booking_no.'" ');
			  $jv_date =$all_data->chalan_date;
			   if($booking_info->booking_type=='Paid Booking'){
				  $tr_from='Sales';
				  
				  //$dr_ledger = $_POST['cash_ledger']; 
				  $cr_agent = find_a_field('dealer_info','account_code','dealer_code_eng="'.$booking_info->agent_id.'" '); 
				  $cr_ledger = find_a_field('config_group_class','sales_ledger','1');
				  $cr_interest = find_a_field('config_group_class','interest','1');
				  $cr_labour = find_a_field('config_group_class','labour_charge','1');
			   }else{
			   //$cr_agent = find_a_field('dealer_info','advance_acc_code','dealer_code_eng="'.$booking_info->agent_id.'" '); 
			   $cr_agent = find_a_field('dealer_info','account_code','dealer_code_eng="'.$booking_info->agent_id.'" '); 
				  $tr_from='Sales';
				  $dr_ledger = '22300010001';
				  $cr_ledger = find_a_field('config_group_class','sales_ledger','1');
				   $cr_labour = find_a_field('config_group_class','labour_charge','1');
					$cr_interest = find_a_field('config_group_class','interest','1');
			   }
			  $cash_ledger=12260010003;
			  
			  $jv_no =  next_journal_sec_voucher_id($tr_from,'Journal');
			
			  $tr_no=$chalan_no;
			  $checked='';
			  $amount = $total_sales_amt;
			  $dnarr4 = 'Booking No: '.$all_data->booking_no.', Booking Type: '.$booking_info->booking_type.', Bag Qty: '.$total_bag.', Bag Rate: 25';
			  $dnarr2 = 'Booking No: '.$all_data->booking_no.', Booking Type: '.$booking_info->booking_type.', Bag Loan Return: '.$paid_bag_loan;
			  $dnarr3 = 'Booking No: '.$all_data->booking_no.', Booking Type: '.$booking_info->booking_type.', Bag Qty: '.$total_bag.', Bag Rate: '.$bag_rate;
			  $dnarr = 'Booking No: '.$all_data->booking_no.', Booking Type: '.$booking_info->booking_type.', Bag Qty: '.$total_bag.', Bag Rate: '.$bag_rate;
			  $tr_id = $all_data->do_no;
			  $tot_cr_amt=$amount;
			  
			   if($booking_info->booking_type=='Paid Booking'){
			   $cash_amt=$total_paid_cash;
			  // $tot_labour=$tot_labour_charge+$paid_bag_loan;
			   //DR cash ledger
			   if($cash_amt>0)
				{
				add_to_sec_journal($proj_id, $jv_no, $jv_date, $cash_ledger, $dnarr4, $cash_amt, '0', $tr_from, $tr_no,'',$tr_id,$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_from_ac,$checked,$type,$employee,$remarks,$reference_id);
				}
				// dr cash loan
				if($paid_bag_loan>0)
				{
				add_to_sec_journal($proj_id, $jv_no, $jv_date, $cash_ledger, $dnarr2, $paid_bag_loan, '0', $tr_from, $tr_no,'',$tr_id,$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_from_ac,$checked,$type,$employee,$remarks,$reference_id);
				}
				//Agent DR
				add_to_sec_journal($proj_id, $jv_no, $jv_date, $cr_agent, $dnarr3,  $total_store_rent_actual,'0', $tr_from, $tr_no,'',$tr_id,$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_to_ac,$checked,$type,$employee,$remarks,$reference_id);
				
				//Agent cr loan
				if($paid_bag_loan>0)
				{
				add_to_sec_journal($proj_id, $jv_no, $jv_date, $cr_agent, $dnarr2,  '0',$paid_bag_loan, $tr_from, $tr_no,'',$tr_id,$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_to_ac,$checked,$type,$employee,$remarks,$reference_id);
				}
			   //CR Sapce Rent
				add_to_sec_journal($proj_id, $jv_no, $jv_date, $cr_ledger, $dnarr3, '0', $total_store_rent_actual,  $tr_from, $tr_no,'',$tr_id,$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_from_ac,$checked,$type,$employee,$remarks,$reference_id);

			   //CR Labour
				if($cash_amt>0)
				{
				add_to_sec_journal($proj_id, $jv_no, $jv_date, $cr_labour, $dnarr4, '0', $cash_amt, $tr_from, $tr_no,'',$tr_id,$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_to_ac,$checked,$type,$employee,$remarks,$reference_id);
				}
			   
			   }
			    else if($booking_info->booking_type=='Normal Booking')
				{
				
			   
			  //DR Space Rent
				add_to_sec_journal($proj_id, $jv_no, $jv_date, $cash_ledger, $dnarr.', For Space Rent', $total_store_rent_actual_normal, '0', $tr_from, $tr_no,'',$tr_id,$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_from_ac,$checked,$type,$employee,$remarks,$reference_id);
				
				//DR cash ledger Loan Paid
				if($tot_cr_amt>0)
				{
				add_to_sec_journal($proj_id, $jv_no, $jv_date, $cash_ledger, $dnarr.', For Loan Return', $tot_cr_amt, '0', $tr_from, $tr_no,'',$tr_id,$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_from_ac,$checked,$type,$employee,$remarks,$reference_id);
				}
				
				//DR cash ledger Labour Income
				add_to_sec_journal($proj_id, $jv_no, $jv_date, $cash_ledger, $dnarr.', For Labour Income', $tot_labour_charge, '0', $tr_from, $tr_no,'',$tr_id,$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_from_ac,$checked,$type,$employee,$remarks,$reference_id);
				
				//DR cash Interest
				if($tot_interests>0)
				{
				add_to_sec_journal($proj_id, $jv_no, $jv_date, $cash_ledger, $dnarr.', For Interest Income', $tot_interests, '0', $tr_from, $tr_no,'',$tr_id,$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_from_ac,$checked,$type,$employee,$remarks,$reference_id);
				}
				
				//CR
				add_to_sec_journal($proj_id, $jv_no, $jv_date, $cr_ledger, $dnarr, '0', $total_store_rent_actual_normal, $tr_from, $tr_no,'',$tr_id,$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_to_ac,$checked,$type,$employee,$remarks,$reference_id);
				
				//CR Labour
				if($tot_labour_charge>0)
				{
				add_to_sec_journal($proj_id, $jv_no, $jv_date, $cr_labour, $dnarr, '0', $tot_labour_charge, $tr_from, $tr_no,'',$tr_id,$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_to_ac,$checked,$type,$employee,$remarks,$reference_id);
				}
				//CR Interest
				if($tot_interests>0)
				{
				add_to_sec_journal($proj_id, $jv_no, $jv_date, $cr_interest, $dnarr, '0', $tot_interests, $tr_from, $tr_no,'',$tr_id,$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_to_ac,$checked,$type,$employee,$remarks,$reference_id);
				
				}
				
				//Agent Cr
				if($tot_cr_amt>0)
				{
				add_to_sec_journal($proj_id, $jv_no, $jv_date, $cr_agent, $dnarr, '0', $tot_cr_amt, $tr_from, $tr_no,'',$tr_id,$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_to_ac,$checked,$type,$employee,$remarks,$reference_id);
				}
			//
			
			
			
			
			
			
				}
			   else 
			   {
			   
			  //DR Space Rent
				add_to_sec_journal($proj_id, $jv_no, $jv_date, $cash_ledger, $dnarr.', For Space Rent', $total_store_rent_actual, '0', $tr_from, $tr_no,'',$tr_id,$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_from_ac,$checked,$type,$employee,$remarks,$reference_id);
				
				//DR cash ledger Loan Paid
				if($tot_cr_amt>0)
				{
				add_to_sec_journal($proj_id, $jv_no, $jv_date, $cash_ledger, $dnarr.', For Loan Return', $tot_cr_amt, '0', $tr_from, $tr_no,'',$tr_id,$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_from_ac,$checked,$type,$employee,$remarks,$reference_id);
				}
				
				//DR cash ledger Labour Income
				add_to_sec_journal($proj_id, $jv_no, $jv_date, $cash_ledger, $dnarr.', For Labour Income', $tot_labour_charge, '0', $tr_from, $tr_no,'',$tr_id,$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_from_ac,$checked,$type,$employee,$remarks,$reference_id);
				
				//DR cash Interest
				if($tot_interests>0)
				{
				add_to_sec_journal($proj_id, $jv_no, $jv_date, $cash_ledger, $dnarr.', For Interest Income', $tot_interests, '0', $tr_from, $tr_no,'',$tr_id,$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_from_ac,$checked,$type,$employee,$remarks,$reference_id);
				}
				
				//CR
				add_to_sec_journal($proj_id, $jv_no, $jv_date, $cr_ledger, $dnarr, '0', $total_store_rent_actual, $tr_from, $tr_no,'',$tr_id,$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_to_ac,$checked,$type,$employee,$remarks,$reference_id);
				
				//CR Labour
				if($tot_labour_charge>0)
				{
				add_to_sec_journal($proj_id, $jv_no, $jv_date, $cr_labour, $dnarr, '0', $tot_labour_charge, $tr_from, $tr_no,'',$tr_id,$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_to_ac,$checked,$type,$employee,$remarks,$reference_id);
				}
				//CR Interest
				if($tot_interests>0)
				{
				add_to_sec_journal($proj_id, $jv_no, $jv_date, $cr_interest, $dnarr, '0', $tot_interests, $tr_from, $tr_no,'',$tr_id,$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_to_ac,$checked,$type,$employee,$remarks,$reference_id);
				
				}
				
				//Agent Cr
				if($tot_cr_amt>0)
				{
				add_to_sec_journal($proj_id, $jv_no, $jv_date, $cr_agent, $dnarr, '0', $tot_cr_amt, $tr_from, $tr_no,'',$tr_id,$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_to_ac,$checked,$type,$employee,$remarks,$reference_id);
				}
			//
			
			
			
			
			
			}
		  
		  }
		  
		  
		  $update="update sale_do_chalan set aprroved_by3='".$_SESSION['user']['id']."',aprroved_at3='".date('Y-m-d h:i:sa')."',approved_status='Third App' where chalan_no='".$_GET['v_no']."' ";
		 $update_success= mysql_query($update);
		 
		 if($update_success==true)
		 {
		 	echo '<h3 style="color:red">'."Approved Success".'</h3>';
			header('Location: delivery_challan_approve3.php');
		 
		 }
		  
		  }
		  ?>
		  <? $id=find_a_field('sale_do_chalan','aprroved_by3','chalan_no="'.$chalan_no.'"');  ?>
		  <td colspan="5"  align="center"><form action="" method="post"> <? if($id==0) { ?>  <input type="submit" name="approve" id="approve" value="Approved" class="btn1 btn1-bg-submit" style="text-align:center;"/> <? } ?></form></td>
		  
		  </tr>
		<tr>
            <td colspan="2" style="font-size:12px">
                Note: No claims for shortage will be entertained after five days from the delivered date.  </td>
		    <td>This is an ERP generated report </td>
		    </tr>
			
	
			<tr>
            <td colspan="3">&nbsp;  </td>
		</tr>
			
				<tr>
            <td colspan="3">&nbsp;  </td>
		</tr>
	
	
	</table>
	
<!--	<tr>
	  <td>&nbsp;</td>
	  </tr>
	<tr>
	  <td>&nbsp;</td>
	  </tr>
	<tr>-->
	  <td>&nbsp;</td>
	  </tr>
	<tr>
	  <td>&nbsp;</td>
	  </tr>
  </tbody>
</table>


</div>
<div class="brack">&nbsp;</div>




</body>
</html>
