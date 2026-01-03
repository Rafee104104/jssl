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
										
                                        <td align="right">Depot : </td>

                                        <td align="left">
											<select name="dealer_depot" id="dealer_depot" >
                           
												<? foreign_relation('warehouse','warehouse_id','warehouse_name',$dealer_depot,'use_type!="PL"');?>
                            
                          					</select>
										</td>

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

									<div id="reporting" style="overflow:hidden"><div id="grp">



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

				 <tr>

				   <td colspan="2" bgcolor="#FF9999"><strong>GROSS PROFIT/(Loss) [FROM TRADING A/C] </strong></td>

				   <td align="right" bgcolor="#FF9999"><? $amount = sum_com(13,$fdate,$tdate)-sum_com(14,$fdate,$tdate); $total = $total + $amount;  echo '<a href="financial_trading_statement.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount,2).'</a>';?></td>

				   </tr>

				 <tr style="background-color:#FFFFFF">

				   <td colspan="2">&nbsp;</td>

				   <td align="right">&nbsp;</td>

				   </tr>

				 <tr style="background-color:#FFFFFF">

				   <td colspan="3" bgcolor="#99CCFF"><strong>OPERATING EXPENSES </strong></td>

				   </tr>

				 <tr>

				   <td>Administrative Expenses </td>

				   <td><div align="center">16</div></td>

				   <td align="right"><? $com_id = 16; $amount = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount,2).'</a>';?></td>

				   </tr>

				 <tr>

				   <td bgcolor="#FFFFFF">Selling &amp; Distributing Expenses </td>

				   <td bgcolor="#FFFFFF"><div align="center">15</div></td>

				   <td align="right" bgcolor="#FFFFFF"><? $com_id = 15; $amount = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount,2).'</a>';?></td>

				   </tr>

				 <tr>

				   <td colspan="2">&nbsp;</td>

				   <td align="right">&nbsp;</td>

				   </tr>

				 <tr>

				   <td colspan="2" bgcolor="#FFCCFF"><strong>NET OPERATING EXPENSES </strong></td>

				   <td align="right" bgcolor="#FFCCFF"><strong><? echo number_format($total1,2); $total1 = 0;?></strong></td>

				   </tr>

				 <tr>

				   <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>

				   </tr>

				 <tr>

				   <td colspan="2" bgcolor="#FF9999"><strong>NET OPERATING PROFIT </strong></td>

				   <td align="right" bgcolor="#FF9999"><strong><? echo number_format($total,2); $total1 = 0;?></strong></td>

				   </tr>

				 <tr>

				   <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>

				   </tr>

				 <tr>

				   <td colspan="2" bgcolor="#99CCFF"><strong>OTHER EXPENSES </strong></td>

				   <td align="right" bgcolor="#99CCFF">&nbsp;</td>

				   </tr>

				 <tr>

				   <td bgcolor="#FFFFFF">Less: Financial Expenses </td>

				   <td bgcolor="#FFFFFF"><div align="center">17</div></td>

				   <td align="right" bgcolor="#FFFFFF"><? $com_id = 17; $amount = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount,2).'</a>';?></td>

				   </tr>

				 <tr>

				   <td>Less: Extra Ordinary Loss </td>

				   <td>&nbsp;</td>

				   <td align="right">&nbsp;</td>

				   </tr>

				 <tr>

				   <td bgcolor="#FFFFFF">Less: Non-Operating Expenses (Royalty) </td>

				   <td bgcolor="#FFFFFF">&nbsp;</td>

				   <td align="right" bgcolor="#FFFFFF">&nbsp;</td>

				   </tr>

				 

				 <tr>

				   <td colspan="3">&nbsp;</td>

				   </tr>

				 <tr>

				   <td colspan="2" bgcolor="#FFCCFF"><strong>NET OTHER EXPENSES </strong></td>

				   <td align="right" bgcolor="#FFCCFF"><strong><? echo number_format($total1,2); $total1 = 0;?></strong></td>

				   </tr>

				 <tr>

				   <td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>

				   <td align="right" bgcolor="#FFFFFF">&nbsp;</td>

				   </tr>

				 <tr>

                   <td colspan="2" bgcolor="#FF9999"><strong>NET OPERATING PROFIT OVER EXPENSES </strong></td>

				   <td align="right" bgcolor="#FF9999"><strong><? echo number_format($total,2); $total1 = 0;?></strong></td>

				   </tr>

				 <tr>

				   <td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>

				   <td align="right" bgcolor="#FFFFFF">&nbsp;</td>

				   </tr>

				 <tr>

				   <td colspan="2" bgcolor="#99CCFF"><strong>OTHER INCOME </strong></td>

				   <td align="right" bgcolor="#99CCFF">&nbsp;</td>

				   </tr>

				 <tr>

				   <td bgcolor="#FFFFFF">Income from Misc. Sales </td>

				   <td bgcolor="#FFFFFF"><div align="center">18</div></td>

				   <td align="right" bgcolor="#FFFFFF"><? $com_id = 18; $amount = sum_com($com_id,$fdate,$tdate); $total = $total + $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount,2).'</a>';?></td>

				   </tr>

				 <tr>

				   <td colspan="2">&nbsp;</td>

				   <td align="right">&nbsp;</td>

				   </tr>

				 <tr>

				   <td colspan="2" bgcolor="#FFCCFF"><strong>NET OTHER INCOME </strong></td>

				   <td align="right" bgcolor="#FFCCFF"><strong><? echo number_format($total1,2); $total1 = 0;?></strong></td>

				   </tr>

				 <tr>

				   <td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>

				   <td align="right" bgcolor="#FFFFFF">&nbsp;</td>

				   </tr>

				 

				 <tr>

				   <td colspan="2" bgcolor="#FF9999"><strong>NET PROFIT/(LOSS) BEFORE TAX </strong></td>

				   <td align="right" bgcolor="#FF9999"><strong><? echo number_format($total,2); $total1 = 0;?></strong></td>

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