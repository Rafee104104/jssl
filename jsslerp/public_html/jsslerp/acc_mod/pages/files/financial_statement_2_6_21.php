<?php

require_once "../../../assets/template/layout.top.php";



$title='Statement of Financial Position';




				   



$tdate=$_REQUEST['tdate'];

//fdate-------------------

$fdate=$_REQUEST["fdate"];



$j=0;

for($i=0;$i<strlen($fdate);$i++)

{

if(is_numeric($fdate[$i]))

$time1[$j]=$time1[$j].$fdate[$i];



else $j++;

}



$fdate=mktime(0,0,-1,$time1[1],$time1[0],$time1[2]);



//tdate-------------------





$j=0;

for($i=0;$i<strlen($tdate);$i++)

{

if(is_numeric($tdate[$i]))

$time[$j]=$time[$j].$tdate[$i];

else $j++;

}

$tdate=mktime(23,59,59,$time[1],$time[0],$time[2]);



if(isset($_REQUEST['tdate'])&&$_REQUEST['tdate']!='')

$report_detail.='<br>Reporting Period: '.$_REQUEST['fdate'].' to '.$_REQUEST['tdate'].'';

?>



<script type="text/javascript">

$(document).ready(function(){

	

	$(function() {

		$("#fdate").datepicker({

			changeMonth: true,

			changeYear: true,

			dateFormat: 'dd-mm-y'

		});

	});

		$(function() {

		$("#tdate").datepicker({

			changeMonth: true,

			changeYear: true,

			dateFormat: 'dd-mm-y'

		});

	});



});

function DoNav(a,b,c)



{



	document.location.href = 'transaction_list.php?fdate='+a+'&tdate='+b+'&ledger_id='+c+'&show=Show';



}

</script>



<style type="text/css">

<!--

.style1 {font-weight: bold}
.style2 {color: #00FFFF}
.style5 {
	color: #000000;
	font-weight: bold;
}

-->

</style>











<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td><div class="left_report">

							<table width="100%" border="0" cellspacing="0" cellpadding="0">

								  <tr>

								    <td><div class="box_report"><form id="form1" name="form1" method="post" action="">

									<table width="100%" border="0" cellspacing="2" cellpadding="0">

                                      <tr>

                                        <td width="22%" height="60" align="right">

		    Currrent Period as On:      </td>

                                        <td width="26%" align="left"><div align="right">
                                          <input name="fdate" type="text" id="fdate" size="12" style="max-width:250px;" value="<?php echo $_REQUEST['fdate'];?>" />
                                        </div></td>
												
												
                                            <td width="5%" align="left"><div align="center">---------</div></td>
                                            <td width="47%" align="left"> <div align="left">
                                              <input name="tdate" type="text" id="tdate" size="12" style="max-width:250px;" value="<?php echo $_REQUEST['tdate'];?>"/>
                                        </div></td>
                                      </tr>

                                      

                                      

                                      <tr>

                                        <td align="center">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td align="center"><input class="btn" name="show" type="submit" id="show" value="Show" /></td>
                                      </tr>
                                    </table>

								    </form></div></td>

						      </tr>

								  <tr>

									<td align="right"><? include('PrintFormat.php');?></td>

								  </tr>

								  <tr>

									<td>

									<? if(isset($_POST['show'])){?>

									<div id="reporting" style="overflow:hidden"><div id="grp">



<table width="98%" cellspacing="0" cellpadding="2" border="0" class="tabledesign">

<thead>

				 <tr>

					<th width="57%"><span class="style1">PARTICULARS</span></th>

					 <th width="13%"><div align="center">NOTE</div></th>

					 <th width="30%"><div align="center">AMOUNT(BDT)</div></th>
				 </tr>
				    </thead>

				 

				 

				 <tr>

				   <td colspan="3" bgcolor="#CCCCCC"><strong>PROPERTY AND ASSETS:</strong></td>
				   </tr>

				 <tr>

				   <td colspan="3" bgcolor="#99CCFF"><strong>FIXED ASSETS: </strong></td>
				   </tr>

				 <tr>

				   <td>At Cost Less Depreciation </td>

				   <td><div align="center">1</div></td>

				   <td align="right">&nbsp;

<? $com_id = 1; $property_and_asset = sum_com($com_id,'2000-01-01',$tdate); $total = $total + $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($property_and_asset,2).'</a>';?>			</td>
				   </tr>

				 

				 <tr>

				   <td bgcolor="#FFCCFF"><strong>TOTAL FIXED  ASSETS:</strong></td>

				   <td bgcolor="#FFCCFF">&nbsp;</td>
				   <td bgcolor="#FFCCFF"><div align="right"><strong><? echo number_format($property_and_asset,2);?></strong></div></td>
				 </tr>

				 <tr>

				   <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
				   </tr>

				 <tr>

				   <td colspan="3" bgcolor="#99CCFF"><strong>CURRENT ASSETS: </strong></td>
				   </tr>

				 <tr>

				   <td>Inventories</td>

				   <td><div align="center">2</div></td>

				   <td align="right">&nbsp;

                       <? $com_id = '1093,25,1110,26,27,28,29'; $inventories = sum_com($com_id,'2000-01-01',$tdate); $total = $total + $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($inventories,2).'</a>';?>                   </td>
				 </tr>

				 <tr>

				   <td bgcolor="#FFFFFF">Trade Debtors </td>

				   <td bgcolor="#FFFFFF"><div align="center">3</div></td>

				   <td align="right" bgcolor="#FFFFFF">&nbsp;

                       <? $com_id = 4; $trade_debtors = sum_com($com_id,'1990-01-01',$tdate); $total = $total + $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($trade_debtors,2).'</a>';?>                   </td>
				 </tr>

				 <tr>

				   <td>Inter Unit Balance Receivable </td>

				   <td><div align="center">4</div></td>

				   <td align="right">
    
		
					    <? $com_id = '5'; $Inter_Unit_Receivable = sum_com($com_id,'2000-01-01',$tdate); $total = $total + $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($Inter_Unit_Receivable,2).'</a>';?>					    </td>
				 </tr>
				 <tr>
                   <td bgcolor="#FFFFFF">Cash and Bank Balances</td>
				   <td bgcolor="#FFFFFF"><div align="center">5</div></td>
				   <td bgcolor="#FFFFFF" align="right">
                       <? $com_id = 7; $cash_and_bank = sum_com($com_id,'2000-01-01',$tdate); $total = $total + $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($cash_and_bank,2).'</a>';?>                   </td>
				   </tr>

				 <tr>
				   <td >Advance, Deposit &amp; Pre-payments </td>
				   <td><div align="center">6</div></td>
				   <td align="right" ><? $com_id = '6'; $advance_deposit = sum_com($com_id,'2000-01-01',$tdate); $total = $total + $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($advance_deposit,2).'</a>';?></td>
				   </tr>
				 <tr>
				   <td bgcolor="#FFFFFF">Provident Fund A/C</td>
				   <td bgcolor="#FFFFFF"><div align="center">7</div></td>
				   <td align="right" bgcolor="#FFFFFF"><? $com_id = '66'; $Provident_Fund = sum_com($com_id,'2000-01-01',$tdate); $total = $total + $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($Provident_Fund,2).'</a>';?></td>
				   </tr>
				 <tr>
				   <td >Security Money Field Staff</td>
				   <td><div align="center">8</div></td>
				   <td align="right"><? $com_id = '2032'; $Security_Money_Staff = sum_com($com_id,'2000-01-01',$tdate); $total = $total + $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($Security_Money_Staff,2).'</a>';?></td>
				   </tr>
				 <tr>

				   <td bgcolor="#FFFFFF">
				     Real Estates Division</td>

				   <td bgcolor="#FFFFFF"><div align="center">9</div></td>

				   <td align="right" bgcolor="#FFFFFF"><? $com_id = '2069'; $Real_Estates = sum_com($com_id,'2000-01-01',$tdate); $total = $total + $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($Real_Estates,2).'</a>';?></td>
				 </tr>

				 

				 <tr>

                   <td bgcolor="#FFCCFF"><strong>TOTAL CURRENT ASSETS:</strong></td>

				   <td bgcolor="#FFCCFF">&nbsp;</td>
				   <td bgcolor="#FFCCFF"><div align="right"><strong><? echo number_format($TOTAL_CURRENT_ASSETS = ($inventories+$trade_debtors+$Inter_Unit_Receivable+$cash_and_bank+$advance_deposit+$Provident_Fund+$Security_Money_Staff+$Real_Estates),2);?></strong></div></td>
				   </tr>

				 
				 
				 
				 
				 <tr>
				   <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
				   </tr>
				 <tr>
                   <td bgcolor="#FFFFFF"><strong>Balance Transferred from Profit &amp; Loss Appropriation   A/C:</strong></td>
				   <td bgcolor="#FFFFFF"><div align="center">10</div></td>
				   <td bgcolor="#FFFFFF"><div align="right">
				   
				   
				   
				    <!--Sales Calculation-->
				   
				   <input type="hidden" name="abc" value="<? $com_id = 10; $amount1 = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; 
				   echo number_format(($amount1*(-1)),2);?>" />
				   
				   <input type="hidden" name="abc" value="<? $com_id = 15; $amount2 = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; 
				   echo number_format($amount2,2);?>" />
				   
				   <input type="hidden" name="abc" value="<?= number_format($total_net_sate = (($amount1*(-1))-$amount2),2); ?>" />
				   <!--/Sales Calculation-->
				   
				    <!--Closing Stock Calculation-->
					
					 <input type="hidden" name="closing" value=" <? $openingCTG = find_a_field('journal j, accounts_ledger a, ledger_group g','sum(j.dr_amt-j.cr_amt)','j.ledger_id=a.ledger_id and a.ledger_group_id=g.group_id and g.com_id=1093 and j.jv_date<'.$fdate); echo  number_format($openingCTG,2);?>" />
				   
				   <input type="hidden" name="closing" value=" <? $openingFCT = find_a_field('journal j, accounts_ledger a, ledger_group g','sum(j.dr_amt-j.cr_amt)','j.ledger_id=a.ledger_id and a.ledger_group_id=g.group_id and g.com_id=25 and j.jv_date<'.$fdate); echo  number_format($openingFCT,2);?>" />
				   
				   <input type="hidden" name="closing" value=" <? $openingPKT = find_a_field('journal j, accounts_ledger a, ledger_group g','sum(j.dr_amt-j.cr_amt)','j.ledger_id=a.ledger_id and a.ledger_group_id=g.group_id and g.com_id=1110 and j.jv_date<'.$fdate); echo  number_format($openingPKT,2); ?>" />
				   
				   <input type="hidden" name="closing" value=" <? $openingFGFCT = find_a_field('journal j, accounts_ledger a, ledger_group g','sum(j.dr_amt-j.cr_amt)','j.ledger_id=a.ledger_id and a.ledger_group_id=g.group_id and g.com_id=26 and j.jv_date<'.$fdate); echo  number_format($openingFGFCT,2);?>" />
				   
				   <input type="hidden" name="closing" value=" <? $openingFGSYLHET = find_a_field('journal j, accounts_ledger a, ledger_group g','sum(j.dr_amt-j.cr_amt)','j.ledger_id=a.ledger_id and a.ledger_group_id=g.group_id and g.com_id=27 and j.jv_date<'.$fdate); echo  number_format($openingFGSYLHET,2);?>" />
				   
				   <input type="hidden" name="closing" value=" <? $openingFGDHK = find_a_field('journal j, accounts_ledger a, ledger_group g','sum(j.dr_amt-j.cr_amt)','j.ledger_id=a.ledger_id and a.ledger_group_id=g.group_id and g.com_id=28 and j.jv_date<'.$fdate); echo  number_format($openingFGDHK,2);?>" />
				   
				   <input type="hidden" name="closing" value=" <? $openingFGCTG = find_a_field('journal j, accounts_ledger a, ledger_group g','sum(j.dr_amt-j.cr_amt)','j.ledger_id=a.ledger_id and a.ledger_group_id=g.group_id and g.com_id=29 and j.jv_date<'.$fdate); echo  number_format($openingFGCTG,2); ?>" />	
				   
				   
				   
				   <input type="hidden" name="abc" value="<? $com_id = 1093; $amount10 = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; 
				   echo number_format(($amt_ctg=($amount10+$openingCTG)),2);?>	" />
				   
				   
				   <input type="hidden" name="abc" value="<? $com_id = 25; $amount11 = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; 
				   echo number_format(($amt_fct=($amount11+$openingFCT)),2);?>	" />
				   
				    <input type="hidden" name="abc" value=" <? $com_id = 1110; $amount12 = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; 
				   echo number_format(($amt_pkt_fct=($amount12+$openingPKT)),2);?>" />
				   
				    <input type="hidden" name="abc" value="<? $com_id = 26; $amount13 = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; 
					echo number_format(($amt_fgfct=($amount13+$openingFGFCT)),2);?>" />
					
					<input type="hidden" name="abc" value="<? $com_id = 27; $amount14 = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; 
					echo number_format(($amt_fgsylhet=($amount14+$openingFGSYLHET)),2);?>" />
					
					<input type="hidden" name="abc" value=" <? $com_id = 28; $amount15 = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount;
					 echo number_format(($amt_fgdhk=($amount15+$openingFGDHK)),2);?>" />
					  
					<input type="hidden" name="abc" value="<? $com_id = 29; $amount16 = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; 
					echo number_format(($amt_fgctg=($amount16+$openingFGCTG)),2);?>" />
					
					<input type="hidden" name="abc" value="<?= number_format($closing_tot = ($amt_ctg+$amt_fct+$amt_pkt_fct+$amt_fgfct+$amt_fgsylhet+$amt_fgdhk+$amt_fgctg),2);?>" />
					  
	
					
					 <!--Closing Stock Calculation-->
					 
					 <!--Indirect Income-->
					 
					 <input type="hidden" name="abc" value="<? $com_id = 3024; $indirect_income = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo number_format($indirect_income,2);?>" />
					

					 <!--/Indirect Income-->
					 
					 
					 <!--Total D=(A+B+C)-->
					 
					 <input type="hidden" name="abc" value="<?= number_format($total_Stock_sale = ($total_net_sate+$closing_tot+$indirect_income),2);?>" />
					 
					 <!--/Total D=(A+B+C)-->
					 
					 <!--Opening Stock -->
					 
					 <input type="hidden" name="abc" value="<? $openingCTG = find_a_field('journal j, accounts_ledger a, ledger_group g','sum(j.dr_amt-j.cr_amt)','j.ledger_id=a.ledger_id and a.ledger_group_id=g.group_id and g.com_id=1093 and j.jv_date<'.$fdate); echo  number_format($openingCTG,2); ?>" />
					 
					 
					 <input type="hidden" name="abc" value="<? $openingFCT = find_a_field('journal j, accounts_ledger a, ledger_group g','sum(j.dr_amt-j.cr_amt)','j.ledger_id=a.ledger_id and a.ledger_group_id=g.group_id and g.com_id=25 and j.jv_date<'.$fdate); echo  number_format($openingFCT,2); ?>" />
					 
					 <input type="hidden" name="abc" value=" <? $openingPKT = find_a_field('journal j, accounts_ledger a, ledger_group g','sum(j.dr_amt-j.cr_amt)','j.ledger_id=a.ledger_id and a.ledger_group_id=g.group_id and g.com_id=1110 and j.jv_date<'.$fdate); echo  number_format($openingPKT,2); ?>" />
					 
					  <input type="hidden" name="abc" value=" <? $openingFGFCT = find_a_field('journal j, accounts_ledger a, ledger_group g','sum(j.dr_amt-j.cr_amt)','j.ledger_id=a.ledger_id and a.ledger_group_id=g.group_id and g.com_id=26 and j.jv_date<'.$fdate); echo  number_format($openingFGFCT,2); ?>" />
					  
					  <input type="hidden" name="abc" value=" <?  $openingFGSYLHET = find_a_field('journal j, accounts_ledger a, ledger_group g','sum(j.dr_amt-j.cr_amt)','j.ledger_id=a.ledger_id and a.ledger_group_id=g.group_id and g.com_id=27 and j.jv_date<'.$fdate); echo  number_format($openingFGSYLHET,2);?>" />
					  
					   <input type="hidden" name="abc" value=" <? $openingFGDHK = find_a_field('journal j, accounts_ledger a, ledger_group g','sum(j.dr_amt-j.cr_amt)','j.ledger_id=a.ledger_id and a.ledger_group_id=g.group_id and g.com_id=28 and j.jv_date<'.$fdate); echo  number_format($openingFGDHK,2);?>" />
					   
					    <input type="hidden" name="abc" value="<? $openingFGCTG = find_a_field('journal j, accounts_ledger a, ledger_group g','sum(j.dr_amt-j.cr_amt)','j.ledger_id=a.ledger_id and a.ledger_group_id=g.group_id and g.com_id=29 and j.jv_date<'.$fdate); echo  number_format($openingFGCTG,2);?>" />
						
						<input type="hidden" name="abc" value="<?= number_format($opening_tot = ($openingCTG+$openingFCT+$openingPKT+$openingFGFCT+$openingFGSYLHET+$openingFGDHK+$openingFGCTG),2); ?>" />
					  
					 
					 <!--/Opening Stock -->
					 
					 <!--Purchase on Auction -->
					 
					  
					 
					 <input type="hidden" name="abc" value="<? $com_id = 22; $purchase_auction = sum_com1($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; 
					  echo number_format($purchase_auction,2);?>" />
					 
					 <!--/Purchase on Auction -->
					 
					 <!--Factory Overhead Charge-->
					 
					 <input type="hidden" name="abc" value="<? $com_id = 23; $factory_overhead = sum_com1($com_id,$fdate,$tdate); $total = $total - $amount5; $total1 = $total1 + $amount5; 
					  echo number_format($factory_overhead,2);?>" />
					 
					 
					<!--/Factory Overhead Charge-->
				   
				   
				   <!-- Administrative Expenses-->
				   
				    <input type="hidden" name="abc" value="<? $com_id = 18; $indirect_exp = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; 
					echo number_format($indirect_exp,2);?>" />
					
					<input type="hidden" name="abc" value="<? $com_id = 19; $marketing_exp = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo number_format($marketing_exp,2);?>" />
		
					
					<input type="hidden" name="abc" value="<? $com_id = 17; $vat_paid = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo number_format($vat_paid,2);?>" />
					
					<input type="hidden" name="abc" value="<?= number_format($tot_administrative_exp = ($indirect_exp+$marketing_exp+$vat_paid),2); ?>" />
		
				   <!--/Administrative Expensive-->
				   
				   <!--Financial Expenses-->
		
				   <input type="hidden" name="abc" value="<? $com_id = 20; $financial_exp = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo number_format($financial_exp,2);?>" />
				   
				   <!--/Financial Expenses-->
				   
				   <!-- Depreciation-->
				   
				   <input type="hidden" name="abc" value="<? $com_id = 5656; $depreciation_exp = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo number_format($depreciation_exp,2);?>" />

				   <!--/Depreciation-->
				   
				   
				   <!--Total K=(E+F+G+H+I+J)-->
				   
				   <input type="hidden" name="abc" value="<?= number_format($gross_tot_exp = ($opening_tot+$purchase_auction+$factory_overhead+$tot_administrative_exp+$financial_exp+$depreciation_exp),2); ?>" />
				   
				   <!--/Total K=(E+F+G+H+I+J)-->	
				   
				   
				   <!--Net Profit -->
				   
				   <input type="hidden" name="abc" value="<?= number_format($gross_gross_profit = (($total_Stock_sale)-$gross_tot_exp),2); ?>" />
				   
				   <!--/Net Profit -->
				   
				   
				   <!--Paioryears Adjustment A/C-->
				   
				   
				   <input type="hidden" name="abc" value=" <? $com_id = '1,4,7,6,5,2032,66,2069'; $closing_all_dr_cr = sum_com($com_id,'2000-01-01',$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo number_format($closing_all_dr_cr,2);?>" />
				   
				   <input type="hidden" name="abc" value="<? $all_opening_dr = find_a_field('journal j, accounts_ledger a, ledger_group g','sum(j.dr_amt-j.cr_amt)','j.ledger_id=a.ledger_id and a.ledger_group_id=g.group_id and g.com_id in (1093,1110,25,26,27,28,29 ) and j.jv_date<'.$fdate); echo  number_format($all_opening_dr,2); ?>" />
				   
				   <input type="hidden" name="abc" value=" <? $com_id = '17,15,22,1112,20,19,23,18'; $during_year_all_dr_cr = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo number_format($during_year_all_dr_cr,2);?>" />
				   
				   <input type="hidden" name="abc" value=" <? $com_id = '8,100,1070,1091,2065,2067'; $closing_all_cr_dr = sum_com($com_id,'2000-01-01',$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo number_format($closing_all_cr_dr,2);?>" />
				   
				   
				   <input type="hidden" name="abc" value=" <? $com_id = '10,3024'; $during_year_all_cr_dr = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo number_format($during_year_all_cr_dr,2);?>" />
				   
				   
				    <input type="hidden" name="abc" value=" <?= number_format($Paioryears_Adjustment = ($closing_all_cr_dr+$during_year_all_cr_dr)-($closing_all_dr_cr+$all_opening_dr+$during_year_all_dr_cr),2); ?>" />
				   
				   
				   <!--/Paioryears Adjustment A/C-->
				   
				   
				   
				   
				   <!--Incometax Paid-->
				   
				   
				   
				   <input type="hidden" name="abc" value="<? $com_id = 1112; $ait_paid = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo number_format($ait_paid,2);?>" />
				   
				   <!--/Incometax Paid-->
				   
				   <!--balance_transfer-->
				   
				   
				   <strong><?= number_format($balance_transfer = ($gross_gross_profit-($Paioryears_Adjustment+$ait_paid))*(-1),2); ?></strong>
				   
				   <!--/balance_transfer-->		
				   
				   
				   
				   
				   </div></td>
				   </tr>
				 <tr>

				   <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
				   </tr>

				 <tr>

                   <td bgcolor="#66FFFF"><span class="style5">TOTAL  PROPERTY AND ASSETS:</span></td>

				   <td bgcolor="#66FFFF">&nbsp;</td>
				   <td bgcolor="#66FFFF"><div align="right"><strong><? echo number_format($property_and_asset+$TOTAL_CURRENT_ASSETS+$balance_transfer,2);?></strong></div></td>
				   </tr>

				 <tr>

                   <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
				   </tr>

				 

				 <tr>

				   <td colspan="3" bgcolor="#CCCCCC"><strong>CAPITAL  AND LIABILITIES : </strong></td>
				   </tr>

				 <tr>

                   <td colspan="3" bgcolor="#99CCFF"><strong>CURRENT LIABILITIES: </strong></td>
				   </tr>

				 <tr>

                   <td bgcolor="#FFFFFF">Sundry Creditors </td>

				   <td bgcolor="#FFFFFF"><div align="center">1</div></td>

				   <td align="right" bgcolor="#FFFFFF">&nbsp;

                       <? $com_id = 8; $sundry_creditors = sum_com($com_id,'2000-01-01',$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($sundry_creditors,2).'</a>';?>                   </td>
				 </tr>

				 <tr>

                   <td>Inter Unit Balance Payable </td>

				   <td><div align="center">2</div></td>

				   <td align="right">&nbsp;

                       <? $com_id = 2067; $inter_unit_payable = sum_com($com_id,2000-01-01,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($inter_unit_payable,2).'</a>';?>                   </td>
				 </tr>

				 

				 <tr>

				   <td bgcolor="#FFFFFF">Liability for Expenses </td>

				   <td bgcolor="#FFFFFF"><div align="center">3</div></td>

				   <td align="right" bgcolor="#FFFFFF"> <? $com_id = 100; $liability_exp = sum_com($com_id,'2000-01-01',$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($liability_exp,2).'</a>';?> </td>
				   </tr>

				 <tr>

                   <td>Inter Division Balance </td>
				   <td><div align="center">4</div></td>
				   <td align="right"><? $com_id = 2065; $inter_division = sum_com($com_id,'2000-01-01',$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($inter_division,2).'</a>';?></td>
				 </tr>

				
				 <tr>
				   <td bgcolor="#FFFFFF">Loan and Advance to Associates</td>
				   <td bgcolor="#FFFFFF"><div align="center">5</div></td>
				   <td align="right" bgcolor="#FFFFFF"><? $com_id = 1070; $loan_and_advanced = sum_com($com_id,'2000-01-01',$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($loan_and_advanced,2).'</a>';?></td>
				   </tr>
				 <tr>
				   <td >Factory Revenue A/C</td>
				   <td><div align="center">6</div></td>
				   <td align="right" ><? $com_id = 1091; $factory_revenue = sum_com($com_id,'2000-01-01',$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($factory_revenue,2).'</a>';?></td>
				   </tr>
				 <tr>
				   <td bgcolor="#FFFFFF">&nbsp;</td>
				   <td bgcolor="#FFFFFF">&nbsp;</td>
				   <td bgcolor="#FFFFFF">&nbsp;</td>
				   </tr>
				 <tr>

                   <td bgcolor="#99CC99"><strong>TOTAL CAPITAL AND LIABILITIES:</strong></td>

				   <td bgcolor="#99CC99">&nbsp;</td>
				   <td bgcolor="#99CC99"><div align="right"><strong><?= number_format($grand_total_capital = ($sundry_creditors+$inter_unit_payable+$liability_exp+$inter_division+$loan_and_advanced+$factory_revenue),2)?></strong></div></td>
				 </tr>

				 

				 <!--<tr>

				   <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
				   </tr>

				 <tr>

				   <td bgcolor="#66FFFF"><strong>TOTAL CAPITAL AND LIABILITIES </strong></td>

				   <td bgcolor="#66FFFF">&nbsp;</td>
				   <td align="right" bgcolor="#66FFFF"><div align="right"><strong><? echo number_format($total,2);?></strong></div></td>
				   </tr>-->
</table>



</div>

</div>

<? }?>

		</td>

		</tr>

		</table>

		</div></td>    

  </tr>

</table>

<?

require_once "../../../assets/template/layout.bottom.php";

?>