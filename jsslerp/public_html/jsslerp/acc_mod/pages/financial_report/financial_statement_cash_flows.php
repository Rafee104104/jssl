<?php



require_once "../../../assets/template/layout.top.php";







$title='Statement of Cash Flows';





do_calander('#fdate');

do_calander('#tdate');

do_calander('#cfdate');

do_calander('#ctdate');



$fdate=$_REQUEST["fdate"];

$tdate=$_REQUEST['tdate'];


$cfdate=$_REQUEST["cfdate"];

$ctdate=$_REQUEST['ctdate'];


if(isset($_REQUEST['tdate'])&&$_REQUEST['tdate']!='')



$report_detail.='<br>Reporting Period: '.$_REQUEST['fdate'].' to '.$_REQUEST['tdate'].'';



?>





<style>

a:hover {

 

  color: #FF0000;

}
</style>



<table width="100%" border="0" cellspacing="0" cellpadding="0">



  <tr>



    <td><div class="left_report">



							<table width="100%" border="0" cellspacing="0" cellpadding="0">



								  <tr>



								    <td><div class="box_report"><form id="form1" name="form1" method="post" action="">



									<table width="100%" border="0" cellspacing="2" cellpadding="0">



                                      <tr>



                                        <td width="22%" align="right">From Date :  </td>

                                        <td width="23%" align="left"> <div align="right">

                                          <input name="fdate" type="text" id="fdate" size="12" maxlength="12" value="<?php echo $_REQUEST['fdate'];?>" autocomplete="off"/>

                                        </div></td>



                                        <td width="8%" align="left"> <div align="center">To Date: </div></td>

                                        <td width="50%" align="left"><input name="tdate" type="text" id="tdate" size="12" style="max-width:250px;" value="<?php echo $_REQUEST['tdate'];?>" autocomplete="off"/></td>
                                      </tr>
                                      <!--<tr>
                                        <td align="right">Comparative  Date : </td>
                                        <td align="left"><div align="right">
                                          <input name="cfdate" type="text" id="cfdate" size="12" maxlength="12" value="<?php echo $_REQUEST['cfdate'];?>" autocomplete="off"/>
                                        </div></td>
                                        <td align="left"><div align="center">To Date: </div></td>
                                        <td align="left"><input name="ctdate" type="text" id="ctdate" size="12" style="max-width:250px;" value="<?php echo $_REQUEST['ctdate'];?>" autocomplete="off"/></td>
                                      </tr>-->

									  

									  

									  

									  

									<tr>

										

                                        <td align="right"> </td>



                                        <td colspan="3" align="left">

											<br />										</td>
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



									<div id="reporting" style="overflow:hidden">

									
<?php
if(isset($_REQUEST['show']))
{
?>		

									
								
										
<?



$sql = "select a.ledger_group_id, sum(j.cr_amt-j.dr_amt) as sales_amt
 from ledger_group l, accounts_ledger a, journal j 
 where l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and j.jv_date between '".$fdate."' and '".$tdate."' and l.acc_class=3";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$sales_amt=$data->sales_amt;
}

$sql = "select a.acc_class, sum(j.dr_amt-j.cr_amt) as rm_opening 
 from cogs_configuration c, ledger_group l, accounts_ledger a, journal j 
 where c.group_id=l.group_id and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date<'".$fdate."' and c.type in ('RM','WIP','FG')";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$rm_opening=$data->rm_opening;
}


$sql = "select a.acc_class, sum(j.dr_amt) as purchase_amt 
 from cogs_configuration c, ledger_group l, accounts_ledger a, journal j 
 where c.group_id=l.group_id and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and j.jv_date between '".$fdate."' and '".$tdate."' and c.type in ('RM')";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$purchase_amt=$data->purchase_amt;
}

 $sql = "select a.acc_class, sum(j.dr_amt-j.cr_amt) as rm_closing 
 from cogs_configuration c, ledger_group l, accounts_ledger a, journal j 
 where c.group_id=l.group_id and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and j.jv_date<='".$tdate."' and c.type in ('RM','WIP','FG')";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$rm_closing=$data->rm_closing;
}

$sql = "select a.ledger_group_id, sum(j.dr_amt-j.cr_amt) as expense_amt
 from ledger_group l, accounts_ledger a, journal j 
 where l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and j.jv_date between '".$fdate."' and '".$tdate."' and l.acc_sub_class!=42 and l.acc_class=4";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$expense_amt=$data->expense_amt;
}

$material_cost=($rm_opening+$purchase_amt)-$rm_closing;
$total_cogs_amt=$material_cost+$expense_amt;

$net_profit_loss=$sales_amt-$total_cogs_amt;




//Comparative Data


$sql = "select a.ledger_group_id, sum(j.cr_amt-j.dr_amt) as sales_amt
 from ledger_group l, accounts_ledger a, journal j 
 where l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and j.jv_date between '".$cfdate."' and '".$ctdate."' and l.acc_class=3";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$sales_amt_cm=$data->sales_amt;
}

$sql = "select a.acc_class, sum(j.dr_amt-j.cr_amt) as rm_opening 
 from cogs_configuration c, ledger_group l, accounts_ledger a, journal j 
 where c.group_id=l.group_id and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date<'".$cfdate."' and c.type in ('RM','WIP','FG')";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$rm_opening_cm=$data->rm_opening;
}


$sql = "select a.acc_class, sum(j.dr_amt) as purchase_amt 
 from cogs_configuration c, ledger_group l, accounts_ledger a, journal j 
 where c.group_id=l.group_id and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and j.jv_date between '".$cfdate."' and '".$ctdate."' and c.type in ('RM')";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$purchase_amt_cm=$data->purchase_amt;
}

 $sql = "select a.acc_class, sum(j.dr_amt-j.cr_amt) as rm_closing 
 from cogs_configuration c, ledger_group l, accounts_ledger a, journal j 
 where c.group_id=l.group_id and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and j.jv_date<='".$ctdate."' and c.type in ('RM','WIP','FG')";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$rm_closing_cm=$data->rm_closing;
}

$sql = "select a.ledger_group_id, sum(j.dr_amt-j.cr_amt) as expense_amt
 from ledger_group l, accounts_ledger a, journal j 
 where l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and j.jv_date between '".$cfdate."' and '".$ctdate."' and l.acc_sub_class!=42 and l.acc_class=4";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$expense_amt_cm=$data->expense_amt;
}

$material_cost_cm=($rm_opening_cm+$purchase_amt_cm)-$rm_closing_cm;
$total_cogs_amt_cm=$material_cost_cm+$expense_amt_cm;

$net_profit_loss_cm=$sales_amt_cm-$total_cogs_amt_cm;





// echo  $sql = "select l.acc_sub_sub_class, sum(j.dr_amt-j.cr_amt) as asset_amt from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
// where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and j.jv_date<='".$tdate."' group by l.acc_sub_sub_class";
//$query = mysql_query($sql);
//while($data=mysql_fetch_object($query)){
//$asset_amt[$data->acc_sub_sub_class]=$data->asset_amt;
//
//}


$sql = "select l.acc_sub_sub_class, sum(j.cr_amt-j.dr_amt) as liability_amt from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date<='".$tdate."' group by l.acc_sub_sub_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$liability_amt[$data->acc_sub_sub_class]=$data->liability_amt;

}



//Comparative Data

 $sql = "select l.acc_sub_sub_class, sum(j.dr_amt-j.cr_amt) as asset_amt from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and j.jv_date<='".$ctdate."' group by l.acc_sub_sub_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$asset_amt_cm[$data->acc_sub_sub_class]=$data->asset_amt;

}

$sql = "select l.acc_sub_sub_class, sum(j.cr_amt-j.dr_amt) as liability_amt from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date<='".$ctdate."' group by l.acc_sub_sub_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$liability_amt_cm[$data->acc_sub_sub_class]=$data->liability_amt;

}




//Cash Bank Balance


 $sql = "select l.acc_sub_sub_class, sum(j.dr_amt-j.cr_amt) as cash_opening from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date<'".$fdate."' and s.id=127 ";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$cash_opening=$data->cash_opening;

}



///New Code

 $sql = "select l.acc_sub_sub_class, sum(j.dr_amt-j.cr_amt) as asset_amt from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and j.jv_date<'".$fdate."' group by l.acc_sub_sub_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$asset_amt[$data->acc_sub_sub_class]=$data->asset_amt;

}

 $sql = "select l.acc_sub_sub_class, sum(j.dr_amt-j.cr_amt) as asset_amt from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and j.jv_date <= '".$tdate."' group by l.acc_sub_sub_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$asset_amt25[$data->acc_sub_sub_class]=$data->asset_amt;

}
	  
	  
	  $sql = "select l.acc_sub_sub_class, sum(j.cr_amt-j.dr_amt) as liability_amt from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date<'".$fdate."' group by l.acc_sub_sub_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$liability_amt25[$data->acc_sub_sub_class]=$data->liability_amt;

}


$sql = "select l.acc_sub_sub_class, sum(j.cr_amt-j.dr_amt) as liability_amt from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date <= '".$tdate."' group by l.acc_sub_sub_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$liability_amt225[$data->acc_sub_sub_class]=$data->liability_amt;

}
	   
	   ?>

					<div id="grp">

							<table width="100%" border="1" cellspacing="0" cellpadding="0">

										<thead >

										<tr>

											<th width="53%" rowspan="2" bgcolor="#82D8CF" style="color:#000000;">&nbsp; Particular</th>

											<th width="23%" bgcolor="#82D8CF" align="center" style="color:#000000;"><div align="center"><?=date("d M, Y",strtotime($_REQUEST['tdate']))?></div></th>
									      </tr>
										<tr>
										  <th bgcolor="#82D8CF" align="center" style="color:#000000;"><div align="center">Amount</div></th>
										  </tr>
										</thead>
										
			<tr>
									  <td bgcolor="#E0FFFF" style="color:#000000;">&nbsp; <strong>	A. Cash flows from operating activities				
</strong></td>
									  <td bgcolor="#E0FFFF" style="color:#000000;">&nbsp;</td>
		                      </tr>
					
					
					<tr>

							 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Net (Loss)/Profit after tax
</td>

										  <td align="right">
										  
		 <a href="financial_profit_loss.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>" target="_blank"><? $formatted_number_x = $net_profit_loss;//number_format(abs($net_profit_loss), 2); 
		  if ($net_profit_loss < 0) {
    echo "(".$formatted_number_x*(-1).")";
} else {
    echo $formatted_number_x;
} ?>	</a></td>
						      </tr>	
							  
							  <tr>

							 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Adjustment with Retained Earnings

</td>

										  <td align="right">
										  
		 <a href="financial_profit_loss.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>" target="_blank"><? $retains_x=find_a_field('journal','sum(dr_amt-cr_amt)','jv_date between "$fdate" and "$tdate" and ledger_id=2160010001 '); echo  ($retains_x > 0) ? '(' . number_format($retains_x, 2) . ')' : number_format(abs($retains_x), 2);  ?>	</a></td>
						     
							  <tr>

							 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Increase/(Decrease) in Inventories

</td>

										  <td align="right"><?
										  	$sql1="select ss.id, ss.sub_sub_class_name from acc_sub_sub_class ss where ss.id in (121)  order by ss.id";

											$query1=mysql_query($sql1);
											
											while($data1=mysql_fetch_object($query1)){ 
											
											$asset_amortization_x=$asset_amt[$data1->id]-$asset_amt25[$data1->id];
											echo ($asset_amortization_x < 0) ? '(' . number_format(abs($asset_amortization_x), 2) . ')' : number_format($asset_amortization_x, 2); 
											}
											?>	</td>
						      </tr>
							  <tr>

							 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Increase/(Decrease) in Account Receivables

</td>

										  <td align="right"><?
										  	$sql2="select ss.id, ss.sub_sub_class_name from acc_sub_sub_class ss where ss.id in (1213)  order by ss.id";

											$query12=mysql_query($sql2);
											
											while($data122=mysql_fetch_object($query12)){ 
											
										
											$asset_receivable_x=$asset_amt[$data122->id]-$asset_amt25[$data122->id];
											echo ($asset_receivable_x < 0) ? '(' . number_format(abs($asset_receivable_x), 2) . ')' : number_format($asset_receivable_x, 2);
											}
											?>	</td>
						      </tr>
							  
							  
							  <tr>

							 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Increase/(Decrease) in Advance, Deposits & Prepayments

</td>

										  <td align="right"><?
										  	$sql2="select ss.id, ss.sub_sub_class_name from acc_sub_sub_class ss where ss.id in (1215)  order by ss.id";

											$query12=mysql_query($sql2);
											
											while($data122=mysql_fetch_object($query12)){ 
											
										
											$asset_advance_deposit_x=$asset_amt25[$data122->id]-$asset_amt[$data122->id];
											echo ($asset_advance_deposit_x < 0) ? '(' . number_format(abs($asset_advance_deposit_x), 2) . ')' : number_format($asset_advance_deposit_x, 2);
											}
											?>		</td>
						      </tr>
							  
							  <tr>

							 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Increase/(Decrease) in Advance Received From Customers


</td>

										  <td align="right"><?
										  	$sql2="select ss.id, ss.sub_sub_class_name from acc_sub_sub_class ss where ss.id in (2229)  order by ss.id";

											$query12=mysql_query($sql2);
											
											while($data122=mysql_fetch_object($query12)){ 
											
										
											$asset_advance_deposit5_x=$liability_amt225[$data122->id]-$liability_amt25[$data122->id];
											echo ($asset_advance_deposit5_x < 0) ? '(' . number_format(abs($asset_advance_deposit5_x), 2) . ')' : number_format($asset_advance_deposit5_x, 2);
											}
											?>		</td>
						      </tr>
							  <tr>

							 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Increase/(Decrease) in Liabilities for Expenses

</td>

										  <td align="right"><?
										  	$sql2="select ss.id, ss.sub_sub_class_name from acc_sub_sub_class ss where ss.id in (226)  order by ss.id";

											$query12=mysql_query($sql2);
											
											while($data122=mysql_fetch_object($query12)){ 
											
										
										$liablity_trade_payable_x=$liability_amt225[$data122->id]-$liability_amt25[$data122->id];
											echo ($liablity_trade_payable_x < 0) ? '(' . number_format(abs($liablity_trade_payable_x), 2) . ')' : number_format($liablity_trade_payable_x, 2);
											}
											?>		</td>
						      </tr>
							  
							 
							  
							  


<tr>

										  <td align="left">&nbsp; <strong>Net cash provided / (used) by operating activities
:</strong></td>

										  <td align="right"><strong>
									      <?
										  
										  
										
										  
										  $tot_payable_receible2=$liablity_trade_payable_x+$asset_advance_deposit5_x+$asset_advance_deposit_x+$asset_receivable_x+$asset_amortization_x+$formatted_number_x+$retains_x; 
										
										echo ($tot_payable_receible2 < 0) ? '(' . number_format(abs($tot_payable_receible2), 2) . ')' : number_format($tot_payable_receible2, 2); ?>
										  </strong></td>
						      </tr>			
										
										

										

										
	
									
									
									  
									  

<?php


 $sql1="select ss.id, ss.sub_sub_class_name from cashflow_configuration c, acc_sub_sub_class ss 
where  ss.id=c.acc_sub_sub_class and c.type='Working Capital' group by c.acc_sub_sub_class order by ss.id";

$query1=mysql_query($sql1);

while($data1=mysql_fetch_object($query1)){ 
//echo $asset_amt_cm[$data1->id]."comp".$asset_amt[$data1->id]." name ".$data1->id."<br>";
$pi++;
$sl=$pi;
?>


									  
									  
									  <tr>

										  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Increase)/ Decrease in <?=$data1->sub_sub_class_name;?></td>
<td align="right"></td>
									  </tr>
									  
									  
									  
<? }?>	

						<tr>
									  <td align="center">&nbsp;</td>
									  <td align="right">&nbsp;</td>
									  </tr>

 						<tr>

										  <td align="left">&nbsp; <strong>B. Cash flows from investing activities : </strong></td>

										  <td align="right"><strong>
									      
										  </strong></td>
						      </tr>
							  <?
							  
							  $sql1="select ss.id, ss.sub_sub_class_name from acc_sub_sub_class ss where ss.id in (2231)  order by ss.id";

$query1=mysql_query($sql1);

while($data1=mysql_fetch_object($query1)){ 
$pi++;
$sl=$pi;
 $asset_amortization=$asset_amt[$data1->id];

}
?>
										  <?
										   $sql1="select ss.id, ss.sub_sub_class_name from acc_sub_sub_class ss where ss.id in (119)  order by ss.id";

$query1=mysql_query($sql1);

while($data1=mysql_fetch_object($query1)){ 
$pi++;
$sl=$pi;
 $asset_intangile=$asset_amt[$data1->id]+$asset_amortization;
 
}


$sql1="select ss.id, ss.sub_sub_class_name from acc_sub_sub_class ss where ss.id in (119)  order by ss.id";

$query1=mysql_query($sql1);

while($data1=mysql_fetch_object($query1)){ 
$pi++;
$sl=$pi;
 $asset_intangile2=$asset_amt25[$data1->id]+$asset_amortization;
 
}
?>

<?
										   


			   $sql1="select ss.id, ss.sub_sub_class_name from acc_sub_sub_class ss where ss.id in (228)  order by ss.id";

$query1=mysql_query($sql1);

while($data1=mysql_fetch_object($query1)){ 
$pi++;
$sl=$pi;
 $tot_asset_amt_depre=$asset_amt[$data1->id];
}
?>

	<?
										   $sql1="select ss.id, ss.sub_sub_class_name from acc_sub_sub_class ss where ss.id in (1119)  order by ss.id";

$query1=mysql_query($sql1);

while($data1=mysql_fetch_object($query1)){ 
$pi++;
$sl=$pi;
 $asset_plant=$asset_amt[$data1->id]+$tot_asset_amt_depre;

}


										   $sql1="select ss.id, ss.sub_sub_class_name from acc_sub_sub_class ss where ss.id in (1119)  order by ss.id";

$query1=mysql_query($sql1);

while($data1=mysql_fetch_object($query1)){ 
$pi++;
$sl=$pi;
 $asset_plant2=$asset_amt25[$data1->id]+$tot_asset_amt_depre;

}   $tot_property=$asset_plant+$asset_intangile; 


 $tot_property2=$asset_plant2+$asset_intangile2;
 
 $tot_property=$tot_property-$tot_property2;
 
 if($tot_property>0)
 {
 
 $sales=$tot_property;
 }
 else
 {
 $purchase=$tot_property*(-1);
 
 }
?>	
							  <tr>

							 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Purchase of property, plant and equipment


</td>

										  <td align="right"><?= ($purchase < 0) ? '(' . number_format(abs($purchase), 2) . ')' : number_format($purchase, 2); ?>

	</td>
						      </tr>
							  <tr>

							 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sales of property, plant and equipment


</td>

										  <td align="right"><?=number_format($sales,2);?>	</td>
						      </tr>
							  


		
		
									
									  
									  <tr>
									  <td align="center">&nbsp;</td>
									  <td align="right">&nbsp;</td>
									  </tr>
										

				<tr>

										  <td bgcolor="#E0FFFF">&nbsp; <strong>Net cash provided / (used) by investing activities
 </strong></td>

										  <td bgcolor="#E0FFFF" style="text-align:right"><? $tot_sales_purchase=$sales+$purchase;
										  
										   echo ($tot_sales_purchase < 0) ? '(' . number_format(abs($tot_sales_purchase), 2) . ')' : number_format($tot_sales_purchase, 2); ?></td>
							        </tr>
									  
									  

<?php


 $sql1="select ss.id, ss.sub_sub_class_name from cashflow_configuration c, acc_sub_sub_class ss 
where  ss.id=c.acc_sub_sub_class and c.type='Investing Activities' group by c.acc_sub_sub_class order by ss.id";

$query1=mysql_query($sql1);

while($data1=mysql_fetch_object($query1)){ 
$pi++;
$sl=$pi;
?>


									  
									  
									  <tr>

										  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$data1->sub_sub_class_name;?></td>
<td align="right"><?=number_format($investing_activities=$asset_amt_cm[$data1->id]-$asset_amt[$data1->id],2); $total_investing_activities +=$investing_activities;?></td>
									  </tr>
									  
									  
									  
<? }?>	



<tr>
									  <td align="center">&nbsp;</td>
									  <td align="right">&nbsp;</td>
									  </tr>

 						<tr>

										  <td align="left">&nbsp; <strong>C. Cash flows from financing activities
:</strong></td>

										  <td align="right"><strong>
									     
										  </strong></td>
						      </tr>
							  
							  
							  <tr>

							 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Increase/(Decrease) in short term loan Others Source



</td>

										  <td align="right"><?
										  	$sql2="select ss.id, ss.sub_sub_class_name from acc_sub_sub_class ss where ss.id in (223)  order by ss.id";

											$query12=mysql_query($sql2);
											
											while($data122=mysql_fetch_object($query12)){ 
											
										
											$liablity_loan_recive_from_others=$liability_amt225[$data122->id]-$liability_amt25[$data122->id];
											echo ($liablity_loan_recive_from_others < 0) ? '(' . number_format(abs($liablity_loan_recive_from_others), 2) . ')' : number_format($liablity_loan_recive_from_others, 2);
											}
											?>		</td>
						      </tr>
							  
							  
							  <tr>
							  <? 
										  $sql_sub1="select s.id, s.sub_class_name from acc_sub_class s where s.id=12
group by s.id";
$query_sub1=mysql_query($sql_sub1);

while($info_sub1=mysql_fetch_object($query_sub1)){ 
	   
	 
										  $flast = date('Y-m-01', strtotime("$fdate -1 month"));
											$tlast = date('Y-m-t', strtotime("$tdate -1 month"));
									 $gg = "SELECT SUM(b.dr_amt - b.cr_amt) AS opening, b.ledger_id FROM accounts_ledger a, journal b WHERE  a.ledger_group_id =1214001 and a.ledger_id = b.ledger_id AND b.jv_date < '$flast' GROUP BY a.ledger_id";
												$ggs = mysql_query($gg);
												while ($gs = mysql_fetch_object($ggs)) {
													$opening_balnace[$gs->ledger_id] = $gs->opening;
												}
												
												$gg = "SELECT SUM(b.dr_amt - b.cr_amt) AS opening, b.ledger_id FROM accounts_ledger a, journal b WHERE  a.ledger_group_id =1214001 and a.ledger_id = b.ledger_id AND b.jv_date < '$fdate' GROUP BY a.ledger_id";
												$ggs = mysql_query($gg);
												while ($gs = mysql_fetch_object($ggs)) {
													$opening_balnace2[$gs->ledger_id] = $gs->opening;
												}
											

												
												$balnce = "SELECT SUM(b.dr_amt) AS debit, SUM(b.cr_amt) AS credit, b.ledger_id FROM accounts_ledger a, journal b WHERE a.ledger_id = b.ledger_id AND b.jv_date between '$flast' and '$tlast'  and a.ledger_group_id =1214001  GROUP BY a.ledger_id";
												$bal_query = mysql_query($balnce);
												while ($bal = mysql_fetch_object($bal_query)) {
													$dr_balnace[$bal->ledger_id] = $bal->debit.'<br>';
													$cr_balnace[$bal->ledger_id] = $bal->credit.'<br>';
												}
												$balnce = "SELECT SUM(b.dr_amt) AS debit, SUM(b.cr_amt) AS credit, b.ledger_id FROM accounts_ledger a, journal b WHERE a.ledger_id = b.ledger_id AND b.jv_date BETWEEN '$fdate' AND '$tdate' and a.ledger_group_id =1214001  GROUP BY a.ledger_id";
												$bal_query = mysql_query($balnce);
												while ($bal = mysql_fetch_object($bal_query)) {
													$dr_balnace2[$bal->ledger_id] = $bal->debit;
													$cr_balnace2[$bal->ledger_id] = $bal->credit;
												}
									$p2 = "SELECT DISTINCT a.ledger_name, a.ledger_id FROM accounts_ledger a WHERE  a.ledger_group_id = 1214001   ORDER BY a.ledger_name";
									$sql = mysql_query($p2);
								   
									$tot_dr_closing = 0;
									$tot_cr_closing = 0;
									while ($p = mysql_fetch_object($sql)) {
									   
									 $closing = ($opening_balnace[$p->ledger_id] + $dr_balnace[$p->ledger_id]) - $cr_balnace[$p->ledger_id];
								
										 $closing > 0 ? number_format($dr_closing = $closing, 2) : ''.'<br>';
										$closing < 0 ? number_format($cr_closing = $closing * -1, 2) : ''.'<br>';
										
											if($closing>0)
											{
										   $tot_dr_closing124 = $closing > 0 ? $closing : 0;
										   }
										   else
										   {
										   $tot_cr_closing124 += $closing < 0 ? abs($closing) : 0 ;
										   
										   }
										   
										   $closing2 = ($opening_balnace2[$p->ledger_id] + $dr_balnace2[$p->ledger_id]) - $cr_balnace2[$p->ledger_id];
								
										 $closing2 > 0 ? number_format($dr_closing2 = $closing2, 2) : ''.'<br>';
										 $closing2 < 0 ? number_format($cr_closing2 = $closing2 * -1, 2) : ''.'<br>';
										   $tot_dr_closing1244 += $closing2 > 0 ? $closing2 : 0;
										   $tot_cr_closing1244 += $closing2 < 0 ? abs($closing2) : 0;
												  
									}								
									  
										
										
										//Account Payable
										
										// $ggs = "SELECT SUM(b.dr_amt - b.cr_amt) AS opening, b.ledger_id FROM accounts_ledger a, journal b WHERE  a.ledger_group_id =225001 and a.ledger_id = b.ledger_id AND b.jv_date < '$fdate' GROUP BY a.ledger_id";
//												$ggss = mysql_query($ggs);
//												while ($gs = mysql_fetch_object($ggss)) {
//													$opening_balnace[$gs->ledger_id] = $gs->opening;
//												}
//												
//												$ggts = "SELECT SUM(b.dr_amt - b.cr_amt) AS opening, b.ledger_id FROM accounts_ledger a, journal b WHERE  a.ledger_group_id =225001 and a.ledger_id = b.ledger_id AND b.jv_date < '$cfdate' GROUP BY a.ledger_id";
//												$ggse= mysql_query($ggts);
//												while ($gs = mysql_fetch_object($ggse)) {
//													$opening_balnace2[$gs->ledger_id] = $gs->opening;
//												}
//											
//												
//												$balnced = "SELECT SUM(b.dr_amt) AS debit, SUM(b.cr_amt) AS credit, b.ledger_id FROM accounts_ledger a, journal b WHERE a.ledger_id = b.ledger_id AND b.jv_date BETWEEN '$fdate' AND '$tdate' and a.ledger_group_id =225001  GROUP BY a.ledger_id";
//												$bal_querys = mysql_query($balnced);
//												while ($bal = mysql_fetch_object($bal_querys)) {
//													$dr_balnace[$bal->ledger_id] = $bal->debit;
//													$cr_balnace[$bal->ledger_id] = $bal->credit;
//												}
//												$balncecd = "SELECT SUM(b.dr_amt) AS debit, SUM(b.cr_amt) AS credit, b.ledger_id FROM accounts_ledger a, journal b WHERE a.ledger_id = b.ledger_id AND b.jv_date BETWEEN '$cfdate' AND '$ctdate' and a.ledger_group_id =225001  GROUP BY a.ledger_id";
//												$bal_queryee = mysql_query($balncecd);
//												while ($bal = mysql_fetch_object($bal_queryee)) {
//													$dr_balnace2[$bal->ledger_id] = $bal->debit;
//													$cr_balnace2[$bal->ledger_id] = $bal->credit;
//												}
//									$p22 = "SELECT DISTINCT a.ledger_name, a.ledger_id FROM accounts_ledger a WHERE  a.ledger_group_id = 225001   ORDER BY a.ledger_name";
//									$sql2 = mysql_query($p22);
//								   
//									$tot_dr_closing = 0;
//									$tot_cr_closing = 0;
//									while ($p2 = mysql_fetch_object($sql2)) {
//									   
//									 $closing = ($opening_balnace[$p2->ledger_id] + $dr_balnace[$p2->ledger_id]) - $cr_balnace[$p2->ledger_id];
//								
//										 $closing > 0 ? number_format($dr_closing = $closing, 2) : ''.'<br>';
//										 $closing < 0 ? number_format($cr_closing = $closing * -1, 2) : ''.'<br>';
//										   $tot_dr_closing125 += $closing > 0 ? $closing : 0;
//										   $tot_cr_closing125 += $closing < 0 ? abs($closing) : 0;
//										   
//										   
//										   $closing22 = ($opening_balnace2[$p2->ledger_id] + $dr_balnace2[$p2->ledger_id]) - $cr_balnace2[$p2->ledger_id];
//								
//										 $closing22 > 0 ? number_format($dr_closing2 = $closing22, 2) : ''.'<br>';
//										 $closing22 < 0 ? number_format($cr_closing2 = $closing22 * -1, 2) : ''.'<br>';
//										   $tot_dr_closing1255 += $closing22 > 0 ? $closing22 : 0;
//										   $tot_cr_closing1255 += $closing22 < 0 ? abs($closing22) : 0;
//												  
//									}	
									
									
		}							
?>
							  
							  

							 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Increase/(Decrease) in Inter Concern loan Receivable 




</td>

										  <td align="right">
											<?
										 	
										 $inter_loan_receive=($tot_cr_closing1244-$tot_cr_closing124);
										 
										 echo ($inter_loan_receive < 0) ? '(' . number_format(abs($inter_loan_receive), 2) . ')' : number_format($inter_loan_receive, 2);
											?>		</td>
						      </tr>
							  <tr>

							 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Increase/(Decrease) in Inter Concern loan Payable 





</td>

										  <td align="right"><?
										  	$sql2="select ss.id, ss.sub_sub_class_name from acc_sub_sub_class ss where ss.id in (2229)  order by ss.id";

											$query12=mysql_query($sql2);
											
											while($data122=mysql_fetch_object($query12)){ 
											
										
											$liablity_inter_concern_loan_payable=$liability_amt225[$data122->id]-$liability_amt25[$data122->id];
											echo ($liablity_inter_concern_loan_payable < 0) ? '(' . number_format(abs($liablity_inter_concern_loan_payable), 2) . ')' : number_format($liablity_inter_concern_loan_payable, 2);
											}
											?>		</td>
						      </tr>
							  <tr>

							 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Increase /(Decrease) in long term loan 





</td>

										  <td align="right"><? $sql2="select ss.id, ss.sub_sub_class_name from acc_sub_sub_class ss where ss.id in (231)  order by ss.id";

											$query12=mysql_query($sql2);
											
											while($data122=mysql_fetch_object($query12)){ 
											
										
											$liablity_long_term_loan=$liability_amt225[$data122->id]-$liability_amt25[$data122->id];
											echo ($liablity_long_term_loan < 0) ? '(' . number_format(abs($liablity_long_term_loan), 2) . ')' : number_format($liablity_long_term_loan, 2);
											} ?>	</td>
						      </tr>
							  <tr>

							 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Net cash provided / (used) by financing activities



</td>

										  <td align="right"><?
										  $tot_net_cash_loan=$liablity_long_term_loan+$liablity_inter_concern_loan_payable+$inter_loan_receive+$liablity_loan_recive_from_others;
										
										  echo ($tot_net_cash_loan < 0) ? '(' . number_format(abs($tot_net_cash_loan), 2) . ')' : number_format($tot_net_cash_loan, 2);
										  
										  ?>	</td>
						      </tr>
							
							
									
									  
									  <tr>
									  <td align="center">&nbsp;</td>
									  <td align="right">&nbsp;</td>
									  </tr>
										

				<tr>

										  <td bgcolor="#E0FFFF">&nbsp; <strong>D. Net increase / (Decrease) in cash and cash equivalents
:</strong></td>

										  <td bgcolor="#E0FFFF" style="text-align:right"><? $sql2="select ss.id, ss.sub_sub_class_name from acc_sub_sub_class ss where ss.id in (1225)  order by ss.id";

											$query12=mysql_query($sql2);
											
											while($data122=mysql_fetch_object($query12)){ 
											
										
											$cash_and_cash_equvalant=$asset_amt25[$data122->id]-$asset_amt[$data122->id];
											
											echo ($cash_and_cash_equvalant < 0) ? '(' . number_format(abs($cash_and_cash_equvalant), 2) . ')' : number_format($cash_and_cash_equvalant, 2);
											
											} ?></td>
							        </tr>
									  <tr>

										  <td bgcolor="#E0FFFF">&nbsp; <strong>E.Cash and cash equivalents at the begaining of the period :
</strong></td>

										  <td bgcolor="#E0FFFF" style="text-align:right"><? $sql2="select ss.id, ss.sub_sub_class_name from acc_sub_sub_class ss where ss.id in (1225)  order by ss.id";

											$query12=mysql_query($sql2);
											
											while($data122=mysql_fetch_object($query12)){ 
											
										
											$cash_and_cash_begining_period=$asset_amt[$data122->id];
											
											echo ($cash_and_cash_begining_period < 0) ? '(' . number_format(abs($cash_and_cash_begining_period), 2) . ')' : number_format($cash_and_cash_begining_period, 2);
											
											} ?> </td>
							        </tr>
									<tr>

										  <td bgcolor="#E0FFFF">&nbsp; <strong>F. Cash and cash equivalents at the end of the period
:</strong></td>

										  <td bgcolor="#E0FFFF" style="text-align:right"><? $sql2="select ss.id, ss.sub_sub_class_name from acc_sub_sub_class ss where ss.id in (1225)  order by ss.id";

											$query12=mysql_query($sql2);
											
											while($data122=mysql_fetch_object($query12)){ 
											
										
											$cash_and_cash_ending_period=$asset_amt25[$data122->id];
											echo ($cash_and_cash_ending_period < 0) ? '(' . number_format(abs($cash_and_cash_ending_period), 2) . ')' : number_format($cash_and_cash_ending_period, 2);
											} ?></td>
							        </tr>
									  

<?php


 $sql1="select ss.id, ss.sub_sub_class_name from cashflow_configuration c, acc_sub_sub_class ss 
where  ss.id=c.acc_sub_sub_class and c.type='Financing Activities' group by c.acc_sub_sub_class order by ss.id";

$query1=mysql_query($sql1);

while($data1=mysql_fetch_object($query1)){ 
$pi++;
$sl=$pi;
?>


									  
									  
									  <tr>

										  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$data1->sub_sub_class_name;?></td>
<td align="right"><?=number_format($financing_activities=$asset_amt_cm[$data1->id]-$asset_amt[$data1->id],2); $total_financing_activities +=$financing_activities;?></td>
									  </tr>
									  
									  
									  
<? }?>	



						<tr>
									  <td align="center">&nbsp;</td>
									  <td align="right">&nbsp;</td>
									  </tr>

 						
						 
						 
						 <tr>
									  <td align="center">&nbsp;</td>
									  <td align="right">&nbsp;</td>
									  </tr>
							
							
 						
							  
							  
									</table>

									<table width="100%" id="report-view"  cellpadding="0" cellspacing="0">
									  <tr style="border:none">
									  	
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									  </tr>
									  <tr style="border:none">
									  	<td colspan="4"> 	These financial statements should be read in conjunction with the annexed notes. 				
 			
</td>
										
										
									  </tr>
									  <tr style="border:none">
									  	
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										
									  </tr>
									  <tr style="border:none">
									  	
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									  </tr>
									  <tr style="border:none">
									  	<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									  </tr>
									  <tr style="border:none">
									  	<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									  </tr>
									  <tr style="border:none">
									  	<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									  </tr>
									  <tr style="border:none">
									  	<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									  </tr>
									  <tr style="border:none">
									  	<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									  </tr>
									  <tr style="border:none">
									  	<td style="width:33%; text-align:center;">-------------------------------</td>
										<td style="width:33%; text-align:center;">--------------------</td>
										<td colspan="2" style="width:33%; text-align:center;">--------------------------------</td>
										
									  </tr>
									  
									  <tr style="border:none">
									  	<td style="width:33%; text-align:center"> Asst. Manager- A&F </td>
										<td style="width:33%; text-align:center;"> CFO </td>
										<td colspan="2" style="width:33%; text-align:center;">Chairman/MD/DMD</td>
										
									  </tr>
									 </table>

									  
									  
									  



									</div>







									</td>



								</tr>



						</table>

<? }?>

		</div></td>    



  </tr>



</table>



<?



require_once "../../../assets/template/layout.bottom.php";



?>