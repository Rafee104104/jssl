<?php

require_once "../../../assets/template/layout.top.php";



$title='Statement of Financial Position';





$tdate=$_REQUEST['tdate'];

//fdate-------------------

$fdate='01-01-15';

$comparisonF='01-01-15';
$comparisonT=$_REQUEST["comparisonT"];

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

//comparisonF date 

$j=0;

for($i=0;$i<strlen($comparisonF);$i++)

{

if(is_numeric($fdate[$i]))

$time1[$j]=$time1[$j].$fdate[$i];

else $j++;

}

$comparisonT=mktime(0,0,-1,$time1[1],$time1[0],$time1[2]);
//comparisonF date


//comparisonT date 

$j=0;

for($i=0;$i<strlen($comparisonT);$i++)

{

if(is_numeric($fdate[$i]))

$time1[$j]=$time1[$j].$fdate[$i];

else $j++;

}

$comparisonT=mktime(0,0,-1,$time1[1],$time1[0],$time1[2]);

//comparisonT date

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

	$(function() {

		$("#comparisonF").datepicker({

			changeMonth: true,

			changeYear: true,

			dateFormat: 'dd-mm-y'

		});

	});
	
	
	$(function() {

		$("#comparisonT").datepicker({

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
            <td><div class="box_report">
                <form id="form1" name="form1" method="post" action="">
                  <table width="100%" border="0" cellspacing="2" cellpadding="0">
                    <tr>
                      <td width="22%" align="right"> Currrent Period as On: </td>
                      <td align="left"><input name="tdate" type="text" id="tdate" size="12" maxlength="12" value="<?php echo $_REQUEST['tdate'];?>"/></td></tr>
                    <!--<tr>
                      <td width="22%" align="right">Previous Period as On: </td>
                      <td align="left"><input name="comparisonT" type="text" id="comparisonT" size="12" maxlength="12" value="<?php echo $_REQUEST['comparisonT'];?>"/></td></tr>-->
                    <tr>
                      <td colspan="2" align="center"><input class="btn" name="show" type="submit" id="show" value="Show" /></td>
                    </tr>
                  </table>
                </form>
              </div></td>
          </tr>
          <tr>
            <td align="right"><? include('PrintFormat.php');?></td>
          </tr>
          <tr>
            <td><? if(isset($_POST['show'])){?>
              <div id="reporting" style="overflow:hidden">
                <div id="grp">
                  <table width="98%" cellspacing="0" cellpadding="2" border="0" class="tabledesign">
                    <thead>
                      <tr>
                        <th width="53%"><span class="style1">PARTICULARS</span></th>
                        <th width="16%" align="center"><div align="center">NOTE</div></th>
                        <th width="31%"><div align="center">AMOUNT(BDT) <br>
                         <!-- ( 
                          <?=$_REQUEST['tdate']?> 
                        )--></div></th>
                      </tr>
                    </thead>
                    <tr>
                      <td colspan="3" bgcolor="#CCCCCC"><strong>PROPERTY AND ASSETS:</strong></td>
                    </tr>
                    <tr>
                      <td colspan="3" bgcolor="#99CCFF"><strong>FIXED ASSETS: </strong></td>
                    </tr>
                    <tr>
                      <td>Property, Plant and Equipments </td>
                      <td align="right"><div align="center">1</div></td>
                      <td align="right"><? $com_id = 1; $amount = sum_com($com_id,$fdate,$tdate); $propertyCurrent = $amount; $total = $total + $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount,2).'</a>';?></td>
                    </tr>
                    <tr>
                      <td>Accumulated Depreciation</td>
                      <td align="right"><div align="center">2</div></td>
                      <td align="right"><? $com_id = 2; $amount = sum_com($com_id,$fdate,$tdate); $depriciationCurrent = $amount;  $total = $total + $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount,2).'</a>';?></td>
                    </tr>
                    <tr>
                      <td bgcolor="#FFCCFF"><strong>TOTAL FIXED ASSETS</strong></td>
                      <td bgcolor="#FFCCFF">&nbsp;</td>
                      <td bgcolor="#FFCCFF"><div align="right"><strong>
					  <? $nonCurrentAssetCurrent = ($propertyCurrent-$depriciationCurrent); echo number_format($nonCurrentAssetCurrent,2); $total1 = 0;?></strong></div></td>
                    </tr>
                    <tr>
                      <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3" bgcolor="#99CCFF"><strong>CURRENT ASSETS: </strong></td>
                    </tr>
                    <tr>
                      <td>Inventories</td>
                      <td align="right"><div align="center">3</div></td>
                      <td align="right"><? $com_id =  '24,25,26,27,28,29'; $amount = sum_com($com_id,$fdate,$tdate); $inventoriesCurrent = $amount; $total = $total + $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount,2).'</a>';?></td>
                    </tr>
                    <tr>
                      <td bgcolor="#FFFFFF">Trade Debtors </td>
                      <td align="right" bgcolor="#FFFFFF"><div align="center">4</div></td>
                      <td align="right" bgcolor="#FFFFFF"><? $com_id = 4; $receivableCurrent = $amount; $amount = sum_com($com_id,$fdate,$tdate); $total = $total + $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount,2).'</a>';?></td>
                    </tr>
                    <tr>
                      <td>Inter Unit Balance </td>
                      <td align="right"><div align="center">5</div></td>
                      <td align="right"><? $com_id = 5; $amount = sum_com($com_id,$fdate,$tdate); $interComRecvCurrent = $amount; $total = $total + $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount,2).'</a>';?></td>
                    </tr>
                    <tr>
                      <td bgcolor="#FFFFFF">Advance, Deposit &amp; Pre-payments </td>
                      <td align="right" bgcolor="#FFFFFF"><div align="center">6</div></td>
                      <td align="right" bgcolor="#FFFFFF"><? $com_id = 6; $advDepositCurrent = $amount; $amount = sum_com($com_id,$fdate,$tdate); $total = $total + $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount,2).'</a>';?></td>
                    </tr>
                    
                    <tr>
                      <td>Cash and Bank Balances </td>
                      <td align="right"><div align="center">7</div></td>
                      <td align="right"><? $com_id = 7; $amount = sum_com($com_id,$fdate,$tdate); $cashCurrent = $amount; $total = $total + $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount,2).'</a>';?></td>
                    </tr>
                    <tr>
                      <td bgcolor="#FFCCFF"><strong>TOTAL CURRENT ASSETS</strong></td>
                      <td bgcolor="#FFCCFF">&nbsp;</td>
                      <td bgcolor="#FFCCFF"><div align="right"><strong>
					  <? echo number_format($total1,2); $total1 = 0;?></strong></div></td>
                    </tr>
                    <tr>
                      <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
                    </tr>
                    <tr>
                      <td bgcolor="#66FFFF"><strong>TOTAL  ASSETS </strong></td>
                      <td bgcolor="#66FFFF">&nbsp;</td>
                      <td bgcolor="#66FFFF"><div align="right"><strong><? echo number_format(($nonCurrentAssetCurrent+$currentAssetCurrent),2);?></strong></div></td>
                    </tr>
                    <tr>
                      <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3" bgcolor="#CCCCCC"><strong>EQUITY AND LIABILITIES </strong></td>
                    </tr>
                    <tr>
                      <td colspan="3" bgcolor="#99CCFF"><strong>SHARE HOLDER'S EQUITY:</strong></td>
                    </tr>
                    <tr>
                      <td bgcolor="#FFFFFF">Share Holder's Equity </td>
                      <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
                      <td align="right" bgcolor="#FFFFFF"><? $com_id = 25; $amount = sum_com($com_id,$fdate,$tdate); $equityCurrent = $amount; $total = $total + $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount,2).'</a>';?></td>
                    </tr>
                    <tr>
                      <td>Retained Earning </td>
                      <td align="right">&nbsp;</td>
                      <td align="right"><? $com_id = 26; $amount = sum_com($com_id,$fdate,$tdate); $retainedCurrent = $amount; $total = $total + $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount,2).'</a>';?></td>
                    </tr>
                    <tr>
                      <td bgcolor="#FFCCFF"><strong>TOTAL SHARE HOLDER'S EQUITY</strong></td>
                      <td bgcolor="#FFCCFF">&nbsp;</td>
                      <td bgcolor="#FFCCFF"><div align="right"><strong><? $shareEquityCurrent = ($equityCurrent+$retainedCurrent); echo number_format($shareEquityCurrent,2); $total1 = 0;?></strong></div></td>
                    </tr>
                    <tr>
                      <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3" bgcolor="#99CCFF"><strong>NON-CURRENT LIABILITIES: </strong></td>
                    </tr>
                    <tr>
                      <td>Long Term Loan </td>
                      <td align="right">&nbsp;</td>
                      <td align="right"><? $com_id = 27; $amount = sum_com($com_id,$fdate,$tdate); $longTermLoanCurrent = $amount; $total = $total + $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount,2).'</a>';?></td>
                    </tr>
                    <tr>
                      <td bgcolor="#FFCCFF"><strong>TOTAL NON-CURRENT LIABILITIES </strong></td>
                      <td bgcolor="#FFCCFF">&nbsp;</td>
                      <td bgcolor="#FFCCFF"><div align="right"><strong><? echo number_format($longTermLoanCurrent,2); ?></strong></div></td>
                    </tr>
                    <tr>
                      <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3" bgcolor="#99CCFF"><strong>CURRENT LIABILITIES: </strong></td>
                    </tr>
                    <tr>
                      <td bgcolor="#FFFFFF">Accounts Payable </td>
                      <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
                      <td align="right" bgcolor="#FFFFFF"><? $com_id = 28; $amount = sum_com($com_id,$fdate,$tdate); $accPayableCurrent = $amount; $total = $total + $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount,2).'</a>';?></td>
                    </tr>
                    <tr>
                      <td>Inter Company Payable </td>
                      <td align="right">&nbsp;</td>
                      <td align="right"><? $com_id = 18; $amount = sum_com($com_id,$fdate,$tdate); $interComPayCurrent = $amount; $total = $total + $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount,2).'</a>';?></td>
                    </tr>
                    <tr>
                      <td bgcolor="#FFFFFF">Short  Term Loan </td>
                      <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
                      <td align="right" bgcolor="#FFFFFF"><? $com_id = 29; $amount = sum_com($com_id,$fdate,$tdate); $shortlongTermLoanCurrent = $amount; $total = $total + $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount,2).'</a>';?></td>
                    </tr>
                    <tr>
                      <td bgcolor="#FFFFFF">Liability for Expenses </td>
                      <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
                      <td align="right" bgcolor="#FFFFFF"><? $com_id = '30,31,32,33'; $amount = sum_com($com_id,$fdate,$tdate); $liabilityExpCurrent = $amount; $total = $total + $amount; $total1 = $total1 + $amount; echo '<a href="trial_balance_periodical_group.php?fdate='.$_REQUEST["fdate"].'&tdate='.$_REQUEST["tdate"].'&cc_code=&show=Show&com_id='.$com_id.'">'.number_format($amount,2).'</a>';?></td>
                    </tr>
                    <tr bgcolor="#FFCCFF">
                      <td><strong>TOTAL  CURRENT LIABILITIES </strong></td>
                      <td>&nbsp;</td>
                      <td><div align="right"><strong>
					  <? $currentLiabilityCurrent = $accPayableCurrent+$interComPayCurrent+$shortlongTermLoanCurrent+$liabilityExpCurrent; echo number_format($currentLiabilityCurrent,2);?></strong></div></td>
                    </tr>
                    <tr>
                      <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
                    </tr>
                    <tr>
                      <td bgcolor="#66FFFF"><strong>TOTAL EQUITY AND LIABILITIES </strong></td>
                      <td align="right" bgcolor="#66FFFF">&nbsp;</td>
                      <td align="right" bgcolor="#66FFFF"><strong><? echo number_format(($longTermLoanCurrent+$currentLiabilityCurrent),2);?></strong></td>
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
