<?php

require_once "../../../assets/template/layout.top.php";



$title='COMPREHENSIVE INCOME STATEMENT';





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

                                        <td width="22%" align="right">

		    Period :                                       </td>

                                        <td align="left"><input name="fdate" type="text" id="fdate" size="12" maxlength="12" value="<?php echo $_REQUEST['fdate'];?>" /> 

                                          ---  

                                            <input name="tdate" type="text" id="tdate" size="12" maxlength="12" value="<?php echo $_REQUEST['tdate'];?>"/></td>

                                      </tr>
									  
									  
									  
									  
									<tr>
										
                                        <td align="right"> </td>

                                        <td align="left">
											<br />
										</td>

                                      </tr>
                                      

                                      

                                      <tr>

                                        <td colspan="2" align="center"><input class="btn" name="show" type="submit" id="show" value="Show" /></td>

                                      </tr>

                                    </table>

								    </form></div></td>

						      </tr>

								  <tr>

									<td align="right"><? include('PrintFormat.php');?></td>

								  </tr>

								  <tr>

									<td>

									<div id="reporting" style="overflow:hidden">
									  <div id="grp">



<table width="98%" cellspacing="0" cellpadding="2" border="0" class="tabledesign">

<thead>

				 <tr>

					<th width="61%"><span class="style1">PARTICULARS</span></th>

					 <th width="9%">NOTE</th>

					 <th width="30%">Amount</th>
				 </tr>
				    </thead>

				 <tr>

				   <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
				   </tr>

				<!-- <tr>

				   <td colspan="2" bgcolor="#FF9999"><strong>GROSS PROFIT/(Loss) [FROM TRADING A/C] </strong></td>

				   <td align="right" bgcolor="#FF9999"><? $amount = sum_com(13,$fdate,$tdate)-sum_com(14,$fdate,$tdate); $total = $total + $amount;  echo '<a href="financial_trading_statement.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount,2).'</a>';?></td>
				   </tr>
-->

				 <tr style="background-color:#FFFFFF">

				   <td colspan="3" bgcolor="#99CCFF"><strong>Depot Sales </strong></td>
				   </tr>

				 <tr>

				   <td colspan="2">Sales (A) </td>

				   <td align="right"><? $com_id = 10; $amount1 = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format(($amount1*(-1)),2).'</a>';?></td>
				   </tr>

				 <tr>

				   <td colspan="2" bgcolor="#FFFFFF">Less: Sales Return (B) </td>

				   <td align="right" bgcolor="#FFFFFF"><? $com_id = 15; $amount2 = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount2,2).'</a>';?></td>
				   </tr>
				 <tr>
				   <td bgcolor="#FFFFFF">&nbsp;</td>
				   <td bgcolor="#FFFFFF"><div align="right">Total (C): </div></td>
				   <td align="right" bgcolor="#FFFFFF"><strong><?= number_format($total_net_sate = (($amount1*(-1))-$amount2),2); ?></strong></td>
				   </tr>

				 <tr>

				   <td colspan="2">&nbsp;</td>

				   <td align="right">&nbsp;</td>
				   </tr>

				 <tr>

				   <td colspan="2" bgcolor="#FFCCFF"><strong>Less: VAT Paid (D) </strong></td>

				   <td align="right" bgcolor="#FFCCFF"><strong><? $com_id = 17; $amount3 = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount3,2).'</a>';?></strong></td>
				   </tr>

				 <tr>

				   <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
				   </tr>

				 <tr>

				   <td colspan="2" bgcolor="#FF9999"><strong>Net Sale E=(C-D) </strong></td>

				   <td align="right" bgcolor="#FF9999"><strong><?= number_format($Sale_e = (($total_net_sate)-$amount3),2); ?></strong></td>
				   </tr>

				 <tr>

				   <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
				   </tr>

				 <tr>

				   <td colspan="2" bgcolor="#99CCFF"><strong>Less: Cost of Good Sold (F) </strong></td>

				   <td align="right" bgcolor="#99CCFF">&nbsp;</td>
				   </tr>

				 

				 <tr>
				   <td>Opening Stock of Raw Tea and Packet Tea </td>
				   <td><div align="center">a</div></td>
				   <td align="right"><strong>
				     <? $com_id = 21; $amount4 = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount4,2).'</a>';?>
				   </strong></td>
				   </tr>
				 <tr>
				   <td>Add: Purchase on Auction </td>
				   <td><div align="center">b</div></td>
				   <td align="right"><strong>
				     <? $com_id = 22; $amount5 = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount5,2).'</a>';?>
				   </strong></td>
				   </tr>
				 <tr>
				   <td>Add: Factory Overhead Charge</td>
				   <td><div align="center">c</div></td>
				   <td align="right"><strong>
				     <? $com_id = 23; $amount6 = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount6,2).'</a>';?>
				   </strong></td>
				   </tr>
				 <tr>
				   <td>&nbsp;</td>
				   <td><div align="right">Total (G) </div></td>
				   <td align="right"><strong><?= number_format($SGS_tot = ($amount4+$amount5+$amount6),2); ?></strong></td>
				 </tr>
				 <tr>
				   <td colspan="2">Less: Closing Stock of Raw Tea and Packet Tea (H) </td>
				   <td align="right"><strong>
				     <? $com_id = 24; $amount7 = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount7,2).'</a>';?>
				   </strong></td>
				 </tr>
				 <tr>
				   <td colspan="3">&nbsp;</td>
				   </tr>
				 <tr>
                   <td colspan="2" bgcolor="#99CCFF"><strong>Less: Cost of Good Sold (F=G-H) </strong></td>
				   <td align="right" bgcolor="#99CCFF"><?= number_format($SGS_final = (($SGS_tot)-$amount7),2); ?></td>
				   </tr>
				 <tr>

				   <td colspan="3">&nbsp;</td>
				   </tr>
				 <tr>

				   <td colspan="2" bgcolor="#FFCCFF"><strong>Gross  Profit I=(E-F) </strong></td>

				   <td align="right" bgcolor="#FFCCFF"><strong>
				     <?= number_format($gross_profit = (($Sale_e)-$SGS_final),2); ?>
				   </strong></td>
				   </tr>

				 <tr>

				   <td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>

				   <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
				   </tr>

				 <tr>

                   <td colspan="2" bgcolor="#FF9999"><strong>Less: Administrative Expensive (J) </strong></td>

				   <td align="right" bgcolor="#FF9999"><strong></strong></td>
				   </tr>

				 <tr>

				   <td bgcolor="#FFFFFF">Indirect Expenses  </td>

				   <td bgcolor="#FFFFFF"><div align="center">a</div></td>
				   <td align="right" bgcolor="#FFFFFF"><? $com_id = 18; $amount7 = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount7,2).'</a>';?></td>
				   </tr>
				 <tr>
				   <td bgcolor="#FFFFFF">Marketing Expenses </td>
				   <td bgcolor="#FFFFFF"><div align="center">b</div></td>
				   <td align="right" bgcolor="#FFFFFF"><? $com_id = 19; $amount8 = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount8,2).'</a>';?></td>
				   </tr>
				 <tr>
				   <td bgcolor="#FFFFFF">&nbsp;</td>
				   <td bgcolor="#FFFFFF"><div align="right">Total (K):</div></td>
				   <td align="right" bgcolor="#FFFFFF"><strong><?= number_format($tot_exp = (($amount7)+$amount8),2); ?></strong></td>
				   </tr>
				 <tr>
				   <td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
				   <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
				   </tr>

				 <tr>

				   <td colspan="2" bgcolor="#99CCFF"><strong>Less: Financial Expenses (L) </strong></td>

				   <td align="right" bgcolor="#99CCFF">&nbsp;</td>
				   </tr>

				 <tr>

				   <td colspan="2" bgcolor="#FFFFFF">Financial Expenses 
				     <div align="center"></div></td>

				   <td align="right" bgcolor="#FFFFFF"><strong><? $com_id = 20; $amount9 = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount9,2).'</a>';?></strong></td>
				   </tr>

				 <tr>

				   <td colspan="2">&nbsp;</td>

				   <td align="right">&nbsp;</td>
				   </tr>

				 <tr>

				   <td colspan="2" bgcolor="#FFCCFF"><strong>Total Expenses (M) </strong></td>

				   <td align="right" bgcolor="#FFCCFF"><strong><?= number_format($gross_tot_exp = (($tot_exp)+$amount9),2); ?></strong></td>
				   </tr>

				 <tr>

				   <td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>

				   <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
				   </tr>

				 

				 <tr> 

				   <td colspan="2" bgcolor="#FF9999"><strong>OPERATING  PROFIT/(LOSS)</strong></td>

				   <td align="right" bgcolor="#FF9999"><strong><?= number_format($Operating_p_L = (($gross_profit)-$gross_tot_exp),2); ?></strong></td>
				   </tr>

				 <tr>

				   <td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>

				   <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
				   </tr>
</table>



</div>

</div>



		</td>

		</tr>

		</table>

		</div></td>    

  </tr>

</table>

<?

require_once "../../../assets/template/layout.bottom.php";

?>