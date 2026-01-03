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

                                        <td width="22%" align="right">

		    Currrent Period as On:      </td>

                                        <td align="left"><input name="fdate" type="text" id="fdate" size="12" maxlength="12" value="<?php echo $_REQUEST['fdate'];?>" />

                                             <input name="tdate" type="text" id="tdate" size="12" maxlength="12" value="<?php echo $_REQUEST['tdate'];?>"/></td>

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
				   
				   
				    <?php



	
  echo $g="select a.ledger_id, a.ledger_name, SUM(dr_amt) dr_amt,SUM(cr_amt) cr_amt,c.group_id 
  FROM accounts_ledger a, journal b,ledger_group c 
  where a.ledger_id=b.ledger_id and a.ledger_group_id=c.group_id and a.ledger_group_id=1032 and b.jv_date BETWEEN '$fdate' AND '$tdate' ".$grp_con.$cc_con.$depot_con." and c.group_for='".$_SESSION['user']['group']."' group by ledger_id  order by c.u_id";


  $gsql=mysql_query($g);
  while($info=mysql_fetch_object($gsql))
  {
  
  $ledger_name=$info->ledger_name;
   $dr_amt=$info->dr_amt;
 

  ?>

				 <tr>
				   <td><?= $ledger_name; ?></td>
				   <td>&nbsp;</td>
				   <td align="right"><?= $dr_amt; ?></td>
				   </tr>
				 <tr>
				 
				 <?php }?>

				   <td>At Cost Less Depreciation </td>

				   <td><div align="center">1</div></td>

				   <td align="right">&nbsp;

<? $com_id = 1; $amount = sum_com($com_id,'2000-01-01',$tdate); $total = $total + $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount,2).'</a>';?>			</td>
				   </tr>

				 

				 <tr>

				   <td bgcolor="#FFCCFF"><strong>TOTAL FIXED  ASSETS</strong></td>

				   <td bgcolor="#FFCCFF">&nbsp;</td>
				   <td bgcolor="#FFCCFF"><div align="right"><strong><? echo number_format($total1,2); $total1 = 0;?></strong></div></td>
				 </tr>

				 <tr>

				   <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
				   </tr>

				 <tr>

				   <td colspan="3" bgcolor="#99CCFF"><strong>CURRENT ASSETS: </strong></td>
				   </tr>

				 <tr>

				   <td>Inventories</td>

				   <td><div align="center">3</div></td>

				   <td align="right">&nbsp;

                       <? $com_id = '22,24,25,26,27,28,29'; $amount = sum_com($com_id,'2000-01-01',$tdate); $total = $total + $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount,2).'</a>';?>                   </td>
				 </tr>

				 <tr>

				   <td bgcolor="#FFFFFF">Trade Debtors </td>

				   <td bgcolor="#FFFFFF"><div align="center">4</div></td>

				   <td align="right" bgcolor="#FFFFFF">&nbsp;

                       <? $com_id = 4; $amount = sum_com($com_id,'1990-01-01',$tdate); $total = $total + $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount,2).'</a>';?>                   </td>
				 </tr>

				 <tr>

				   <td>Inter Unit Balance Receivable </td>

				   <td><div align="center">5</div></td>

				   <td align="right">&nbsp;

                       <? $com_id = 5; $amount = sum_com($com_id,$fdate,$tdate); $total = $total + $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount,2).'</a>';?>                   </td>
				 </tr>

				 <tr>

				   <td bgcolor="#FFFFFF">Advance, Deposit &amp; Pre-payments </td>

				   <td bgcolor="#FFFFFF"><div align="center">6</div></td>

				   <td align="right" bgcolor="#FFFFFF">&nbsp;

                       <? $com_id = '6'; $amount = sum_com($com_id,$fdate,$tdate); $total = $total + $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount,2).'</a>';?>                   </td>
				 </tr>

				 <tr>

				   <td>Cash and Bank Balances</td>

				   <td><div align="center">7</div></td>

				   <td align="right">&nbsp;

                       <? $com_id = 7; $amount = sum_com($com_id,'2000-01-01',$tdate); $total = $total + $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount,2).'</a>';?>                   </td>
				 </tr>

				 

				 <tr>

                   <td bgcolor="#FFCCFF"><strong>TOTAL CURRENT ASSETS</strong></td>

				   <td bgcolor="#FFCCFF">&nbsp;</td>
				   <td bgcolor="#FFCCFF"><div align="right"><strong><? echo number_format($total1,2); $total1 = 0;?></strong></div></td>
				   </tr>

				 <tr>
				   <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
				   </tr>
				 <tr>
				   <td bgcolor="#CCCCFF"><span class="style5">PROFIT & LOSS APPROPRIATION</span></td>
				   <td bgcolor="#CCCCFF">&nbsp;</td>
				   <td bgcolor="#CCCCFF"><span class="style2"></span></td>
				 </tr>
				 
				 <tr>
				   <td bgcolor="#FFFFFF">Profit & Loss Appropriation Accounts</td>
				   <td bgcolor="#FFFFFF">&nbsp;</td>
				   <td bgcolor="#FFFFFF" align="right";><? $com_id = 101; $amount = sum_com($com_id,$fdate,$tdate); $total = $total + $amount; $total11 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount,2).'</a>';?></td>
				 </tr>
				 <tr>

				   <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
				   </tr>

				 <tr>

                   <td bgcolor="#66FFFF"><span class="style5">TOTAL  PROPERTY AND ASSETS </span></td>

				   <td bgcolor="#66FFFF">&nbsp;</td>
				   <td bgcolor="#66FFFF"><div align="right"><strong><?php /*?><? echo number_format($total,2);?></strong><?php */?></div></td>
				   </tr>

				 <tr>

                   <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
				   </tr>

				 

				 <tr>

				   <td colspan="3" bgcolor="#CCCCCC"><strong>CAPITAL  AND LIABILITIES </strong></td>
				   </tr>

				 <tr>

                   <td colspan="3" bgcolor="#99CCFF"><strong>CURRENT LIABILITIES: </strong></td>
				   </tr>

				 <tr>

                   <td bgcolor="#FFFFFF">Sundry Creditors </td>

				   <td bgcolor="#FFFFFF"><div align="center">8</div></td>

				   <td align="right" bgcolor="#FFFFFF">&nbsp;

                       <? $com_id = 8; $amount = sum_com2($com_id,'2000-01-01',$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount,2).'</a>';?>                   </td>
				 </tr>

				 <tr>

                   <td>Inter Unit Balance Payable </td>

				   <td><div align="center">9</div></td>

				   <td align="right">&nbsp;

                       <? $com_id = 9; $amount = sum_com2($com_id,2000-01-01,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount,2).'</a>';?>                   </td>
				 </tr>

				 

				 <tr>

				   <td bgcolor="#FFFFFF">Liability for Expenses </td>

				   <td bgcolor="#FFFFFF"><div align="center">10</div></td>

				   <td align="right" bgcolor="#FFFFFF"><? $com_id = 100; $amount = sum_com2($com_id,2000-01-01,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount,2).'</a>';?>  </td>
				   </tr>

				 <tr>

                   <td bgcolor="#FFFFFF">Others</td>

				   <td bgcolor="#FFFFFF">&nbsp;</td>

				   <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
				   </tr>

				 <tr>

                   <td colspan="3">&nbsp;</td>
				   </tr>

				 <tr>

                   <td bgcolor="#FFCCFF"><strong>CURRENT LIABILITIES</strong></td>

				   <td bgcolor="#FFCCFF">&nbsp;</td>
				   <td bgcolor="#FFCCFF"><div align="right"><strong><? echo number_format($total1,2); $total2 = $total1;$total1 = 0;?></strong></div></td>
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