<?php



session_start();



//====================== EOF ===================



//var_dump($_SESSION);



require_once "../../../assets/template/layout.top.php";

require_once ('../../../acc_mod/common/class.numbertoword.php');

$lc_no 		= $_REQUEST['v_no'];


$lc_data = find_all_field('lc_master','','lc_no='.$lc_no); 



 $buyer_bank = find_all_field('bank_buyers','','bank_id='.$lc_data->bank_buyers); 
 $seller_bank = find_all_field('bank_sellers','','bank_id='.$lc_data->bank_sellers); 
 $dealer = find_all_field('dealer_info','','dealer_code='.$lc_data->dealer_code); 



		  $barcode_content = $lc_data->lc_no_view;
		  $barcodeText = $barcode_content;
          $barcodeType='code128';
		  $barcodeDisplay='horizontal';
          $barcodeSize=40;
          $printText='';



foreach($challan as $key=>$value){
$$key=$value;
}
 $vl_sql = 'SELECT  sum(s.total_amt) as lc_value FROM lc_receive a, pi_details b, sale_do_details s WHERE  a.pi_id=b.pi_id and b.do_no=s.do_no and a.lc_no="'.$lc_no.'" GROUP by a.lc_no ';
$lc_value = find_all_field_sql($vl_sql);




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset="UTF-8"" />

<title><?=$lc_data->lc_no_view;?></title>
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



.number {
    width: 8em;
    display: block;
    word-wrap: break-word;
    columns: 6;
    column-gap: 0.2em;
}


</style>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">


  <tr>
     <td colspan="2"><div class="header" style="margin-top:0;">
       <table width="100%" border="0" cellspacing="0" cellpadding="0">
    
		  <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="20%">    </td>
                        
                        <td width="60%">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td colspan="2" align="center">
									<h4 style="font-size:24px; padding:5px 0; margin:0; font-family:  'MYRIADPRO-REGULAR'; letter-spacing:1px;text-decoration:underline; ">
   TRUCK RECEIPT</h4>
   
						   <h4 style="font-size:20px; padding:0 0; margin:0;  letter-spacing:1px;">মডার্ণ ট্রান্সপোর্ট সার্ভিস</h4>
						   
						     <h4 style="font-size:24px; padding:5px 0; margin:0; font-weight:500; font-family:  'MYRIADPRO-REGULAR'; letter-spacing:1px;text-decoration:underline; ">
   MODERN TRANSPORT SERVICE</h4>
   
   <h4 style="font-size:14px; padding:0 0; margin:0; margin:0; font-weight:300; font-style:italic;  letter-spacing:1px; ">Carrying Contractor & Commission Agent all Over the Bangladesh</h4>
   <h4 style="font-size:14px; padding:0 0; margin:0; margin:0; font-weight:300;  font-style:italic;  letter-spacing:1px;">31, Dhaka Trunk Road, Kadamtali, Chittagong.</h4>
   
   
   
   
   
   
   
   
   </td>
								</tr>
								
								<tr>
									<td colspan="2" align="center">
									</td>
								</tr>
							</table>
						
						</td>
						
						<td width="20%"></td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
        </table>
       </div></td>
 </tr>
  

 
 
 
 
 
 

 <tbody>
  
  
  
 
  
  
 <tr> <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">


		  <tr>


		    <td width="68%" valign="top">&nbsp;	        </td>
		  </tr>


		</table>		</td></tr>
		
		
		<tr> <td colspan="2">
  <table width="100%" border="0" cellspacing="0" cellpadding="0"  >
  	<tr style="font-size:16px" >
		<td width="25%" valign="top">Receipt No: <?=$lc_data->lc_no_view;?></td>
			<td width="50%" valign="middle" align="center">&nbsp;</td>
		<td width="25%" valign="right" align="right">Date: <?php echo date('d-m-Y',strtotime($lc_data->lc_date));?></td>
	</tr>
  	<tr>
  	  <td valign="top">&nbsp;</td>
  	  <td valign="middle" align="center">&nbsp;</td>
  	  <td valign="right" align="right">&nbsp;</td>
	  </tr>
	

	
	
	<tr>
	  <td colspan="3" valign="top" >
	  	<table width="100%" border="0" cellspacing="0" cellpadding="0" >
			<tr>
				<td width="50%">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:16px; text-transform:uppercase;">
						<tr>
							<td width="35%">প্রেরকের নাম</td>
							<td width="2%">:</td>
							<td  width="63%"> <?=find_a_field('user_group','group_name','id='.$_SESSION['user']['group'])?> </td>
						</tr>
						<tr>
						<td valign="top">ঠিকানা</td>
							<td  valign="top">:</td>
							<td  width="63%"  valign="top"> <?=find_a_field('user_group','address','id='.$_SESSION['user']['group'])?> </td>
						</tr>
						<tr>
						<td>ড্রাইভারের নাম</td>
							<td>:</td>
							<td  width="63%">MD. BASAR </td>
						</tr>
						</table>
				
				</td>
				<td width="50%">
				
				<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:16px;  text-transform:uppercase;">
						<tr>
							<td width="28%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;প্রাপকের নাম</td>
							<td width="2%">:</td>
							<td  width="70%"><?=$dealer->dealer_name_e?> </td>
						</tr>
						<tr>
						<td width="28%"  valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ঠিকানা</td>
							<td width="2%"  valign="top">:</td>
							<td  width="70%"  valign="top"><?=$dealer->address_e?> </td>
						</tr>
						<tr>
						<td width="28%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ট্রাক নং</td>
							<td width="2%">:</td>
							<td  width="70%">DHAKA-METRO-11-9076 </td>
						</tr>
						</table>
				
				</td>
			</tr>
		</table>
	  </td>
	</tr>
	

	
	
	
  </table>
  
  </td></tr>
  
  
 
  <tr>
    <td colspan="2"><div id="pr">
        <div align="left">
         
            <input name="button" type="button" onclick="hide();window.print();" value="Print" />
             </div>
      </div>	  </td>
	  </tr>
	  
	  
	  <tr>
	 <td  width="75%"  style="font-size:12px; " align="left"><h5 style="margin:0; padding:0; font-weight:700; font-size:16px; "><em>Freight Terms:  Freight prepaid.</em></h5></td>
	  <td  width="25%"  style="font-size:12px; padding-bottom: 10px; " align="right"><div style=" padding:8px 40px; border:2px solid   #CCCCCC; text-align:center; font-size:12px; font-weight:200;" >
	   H.S. Code 4819.10.00
	  </div></td>
	  </tr>
	  
	  
	  
	  <tr>
    <td colspan="2">
      
      <table width="100%" class="tabledesign"   border="1" bordercolor="#CCCCCC" cellspacing="0" cellpadding="5"  style="font-size:12px">
       
        <tr >
          <td width="4%" align="center" bgcolor="#CCCCCC">SL</td>
          <td width="45%" align="center" bgcolor="#CCCCCC">Item Name </td>
          <td width="12%" align="center"  bgcolor="#CCCCCC">UOM</td>
          <td width="11%" align="center" bgcolor="#CCCCCC">Quantity</td>
          <td width="10%" align="center"  bgcolor="#CCCCCC"> Price  </td>
          <td width="18%" align="center" bgcolor="#CCCCCC">Total Value </td>
        </tr>
        
        <?  
		
		 $sqlc = 'select s.*, i.item_name, i.unit_name from lc_receive r, pi_details c, sale_do_details s, item_info i where r.pi_id=c.pi_id and i.item_id=s.item_id and c.do_no=s.do_no 
		 and r.lc_no='.$lc_no.' group by s.id order by s.item_id ';
			$queryc=mysql_query($sqlc);
			while($datac = mysql_fetch_object($queryc)){
			
			
			
			?>
        <tr style="font-size:12px;">
          <td align="center" valign="top"><?=++$kk;?></td>
          <td align="left" valign="top"><?=$datac->item_name;?></td>
          <td align="center" valign="top"><?=$datac->unit_name;?></td>
          <td align="center" valign="top"><?=number_format($datac->total_unit,0); $grand_tot_unit1 +=$datac->total_unit; ?></td>
          <td align="center" valign="top">$<?=number_format($datac->unit_price,4);?></td>
          <td align="center" valign="top">$<?=number_format($datac->total_amt,2); $grand_total_amt +=$datac->total_amt; ?></td>
        </tr>
        
        <? }
		
		?>
	
        <tr style="font-size:12px;">
        <td colspan="2" align="right" valign="middle"><strong> Total:</strong></td>
        <td align="center" valign="middle">&nbsp;</td>
        <td align="center" valign="middle"><strong>
          <?=number_format($grand_tot_unit1,0) ;?>
        </strong></td>
        <td align="center" valign="middle"></td>
        <td align="center" valign="middle"><strong>
          $<?=number_format($grand_total_amt,2) ;?>
        </strong></td>
        </tr>
      </table>      </td>
  </tr>
	  
	  
	  <tr>
	 
	 <td colspan="2" align="left"  style="font-size:16px; text-transform: uppercase; letter-spacing: .3px; line-height:20px;"> <div align="justify">
	<b>L/C No. <?=$lc_data->export_lc_no;?> Dated <?php echo date('d-m-Y',strtotime($lc_data->export_lc_date));?>.  <? if($lc_data->contact_no!="") {?> EXPORT CONTRACT NO.: <?=$lc_data->contact_no;?><? }?>
 <? if($lc_data->contact_date!="") {?> DTD.:  <?php echo date('d-m-Y',strtotime($lc_data->contact_date));?>. <? }?> PROFORMA INVOICE NO. <?  
$a=0;
		 $pi_sql = 'SELECT  c.pi_no, c.pi_date FROM lc_master a, lc_receive b, pi_details c 
		 WHERE a.lc_no=b.lc_no  and b.pi_id=c.pi_id and a.lc_no="'.$lc_no.'" GROUP by c.pi_id ';
			$pi_query=mysql_query($pi_sql);
			while($pi_data= mysql_fetch_object($pi_query)){
			$a++;
			if ($a>1) echo ', ';
echo $pi_data->pi_no.' DT. '.date('d-m-Y',strtotime($pi_data->pi_date));}?>. <? if($lc_data->importer_irc_no!="") {?> Importer IRC No: <?= $lc_data->importer_irc_no; ?><? }?><? if($lc_data->applicants_tin_no!="") {?>, Applicant's TIN No: <?= $lc_data->applicants_tin_no; ?><? }?><? if($lc_data->applicants_bin_no!="") {?>, Applicant's BIN No: <?= $lc_data->applicants_bin_no; ?><? }?><? if($lc_data->bangladesh_bank_dc_no!="") {?>, Bangladesh Bank DC No: <?= $lc_data->bangladesh_bank_dc_no; ?><? }?><? if($lc_data->issuing_bank_bin_no!="") {?>, Issuing Bank BIN No: <?= $lc_data->issuing_bank_bin_no; ?>.<? }?> BENEFICIARY'S BIN NO. 000073153-0403, H. S. CODE. 4819.10.00.</b> 
	 
	 </div></td>
	  </tr>
	  
	  
	  
  
  
  
  
  
  
  
	
	
	
	

	<tr>
		<td colspan="2">
	
	
	<!-- style="border:1px solid #000; color: #000;"-->
	      <div class="footer"> 
	
	<table width="100%" cellspacing="0" cellpadding="0"  >
		<tr style="font-size:12px">
		  <td align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  </tr>
		<tr style="font-size:12px">
		  <td align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  </tr>
		<tr style="font-size:12px">
		  <td align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  </tr>
		<tr style="font-size:12px">
		  <td align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  </tr>
		<tr style="font-size:12px">
		  <td align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  </tr>
		<tr style="font-size:12px">
		  <td align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  </tr>
		<tr style="font-size:12px">
		  <td align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  </tr>
		<tr style="font-size:12px">
		  <td align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  </tr>
		<tr style="font-size:12px">
		  <td align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  </tr>
		<tr style="font-size:12px">
		  <td height="16" align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  </tr>
		<tr style="font-size:12px">
		  <td width="29%" align="center">&nbsp;</td>
		  <td width="21%"  align="center">&nbsp;</td>
		  <td width="20%"  align="center">&nbsp;</td>
		  <td width="30%" align="center">&nbsp;</td>
		  </tr>
		<tr style="font-size:12px">
		  <td align="center" style="font-size:16px; text-transform: capitalize; font-weight:700;">&nbsp;</td>
		  <td  align="left">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td align="center" style="font-size:16px; text-transform: uppercase; font-weight:700;">&nbsp;</td>
		  </tr>
		<tr style="font-size:12px">
		  <td align="left" style="font-size:14px; text-transform:uppercase; font-weight:300">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  </tr>
		<tr style="font-size:12px" >
		  <td align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  <td align="center">&nbsp;				  </td>
		  </tr>
		

		  
		<?php /*?>  <tr style="font-size:12px">
		  <td align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td align="center" style="font-size:12px;  border-left:0;  padding: 0 0 5px 0; letter-spacing:.3px; ">Digitally signed in ERP system</td>
		  </tr>
		  
		  <tr style="font-size:12px">
		  <td align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td align="left" style="font-size:12px;  border-left:0;  padding: 0px 0 0 47px; letter-spacing:1px; "><?=$master->digital_sign?></td>
		  </tr><?php */?>
		  
		
		  <tr style="font-size:12px">
		    <td align="center">&nbsp;</td>
		    <td  align="center">&nbsp;</td>
		    <td  align="center">&nbsp;</td>
		    <td align="center">&nbsp;</td>
		    </tr>
		<tr style="font-size:12px">
		  <td align="center"><hr /></td>
		  <td  align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td align="center"><hr /></td>
		  </tr>
		<tr style="font-size:12px">
		  <td align="center"><span style="text-transform: uppercase; font-size: 16px; font-weight:700;">ড্রাইভারের স্বাক্ষর</span></td>
		  <td  align="center">&nbsp;</td>
		  <td  align="center">&nbsp;</td>
		  <td align="center" style="text-transform: uppercase; font-size: 16px; font-weight:700;">ম্যানেজারের স্বাক্ষর</td>
		  </tr>
	
	<?php /*?><tr>
            <td colspan="4">  <hr /> </td>
		</tr><?php */?>
	
        
	
         <?php /*?> <tr>
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
	  </div>	</td>
  </tr>
   </tbody>
</table>
</body>
</html>
