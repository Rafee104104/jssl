<?php

require_once "../../../assets/template/layout.top.php";



$title='PROFIT & LOSS APPROPRIATION ACCOUNT';





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

									<? if(isset($_REQUEST['show'])){?>

									<div id="reporting" style="overflow:hidden"><div id="grp">



<table width="98%" cellspacing="0" cellpadding="2" border="0" class="tabledesign">

<thead>

				 <tr>

					<th width="57%"><span class="style1">PARTICULARS</span></th>

					 <th width="13%">NOTE</th>

					 <th width="30%">AMOUNT</th>
				 </tr>
					 </thead>

				 <tr>

				   <td colspan="3" bgcolor="#99CCFF">APPROPRIATION ACCOUNT</td>
				   </tr>

				 <tr>

				   <td height="23">Balance of Previous Month (Loss) </td>

				   <td><div align="center">0</div></td>

				   <td align="right"><?
								 $Opening_Appropriation_Accounts = find_a_field('journal j, accounts_ledger a, ledger_group g','sum(j.dr_amt-j.cr_amt)','j.ledger_id=a.ledger_id and a.ledger_group_id=g.group_id and g.com_id=100 and j.jv_date<'.$fdate); echo  number_format($Opening_Appropriation_Accounts,2);
					 
					 ?></td>
				   </tr>

				 <tr style="background-color:#FFFFFF">

				   <td>Net Loss During the Month </td>

				   <td><div align="center">0</div></td>

				   <td align="right"><? $com_id = 100; $amount3 = sum_com($com_id,$fdate,$tdate); $total = $total - $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount3,2).'</a>';?></td>
				   </tr>

				 <tr>

				   <td colspan="2">&nbsp;</td>

				   <td align="right">&nbsp;</td>
				   </tr>

				 <tr>

				   <td bgcolor="#00FFCC"><strong>Balance Transferred to Balance Sheet</strong></td>

				   <td bgcolor="#00FFCC"><div align="center"><strong>Total</strong></div></td>
				   <td align="right" bgcolor="#00FFCC"><strong><?= number_format($total_appropriation_acc = ($Opening_Appropriation_Accounts+$amount3),2); ?></strong></td>
				   </tr>

				 

				 <tr>

				   <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
				   </tr>
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