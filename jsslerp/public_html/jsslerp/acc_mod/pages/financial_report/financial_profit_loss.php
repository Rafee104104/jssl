<?php
session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";

$title='Statement of Profit or Loss & Other Comprehensive Income';


do_calander('#fdate');

do_calander('#tdate');

do_calander('#cfdate');

do_calander('#ctdate');

$fdate=$_REQUEST["fdate"];

$tdate=$_REQUEST['tdate'];

$cfdate=$_REQUEST["cfdate"];

$ctdate=$_REQUEST['ctdate'];



if(isset($_REQUEST['tdate'])&&$_REQUEST['tdate']!='')




$report_detail.='<br>Period: '.date("d F' Y",strtotime($fdate)).' To '.date("d F' Y",strtotime($tdate));



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



                                        <td width="22%" align="right">



		    From Date :                                       </td>



                                        <td width="23%" align="left"> <div align="right">

                                          <input name="fdate" type="text" id="fdate" size="12" maxlength="12" value="<?php echo $_REQUEST['fdate'];?>" autocomplete="off"/>

                                        </div></td>



                                        <td width="8%" align="left"> <div align="center">To Date: </div></td>

                                        <td width="50%" align="left"><input name="tdate" type="text" id="tdate" size="12" style="max-width:250px;" value="<?php echo $_REQUEST['tdate'];?>" autocomplete="off"/></td>

                                      </tr>

									  
										<tr>



                                        <td width="22%" align="right">



		    Comparative Date :                                       </td>



                                        <td width="23%" align="left"> <div align="right">

                                          <input name="cfdate" type="text" id="cfdate" size="12" maxlength="12" value="<?php echo $_REQUEST['cfdate'];?>" autocomplete="off"/>

                                        </div></td>



                                        <td width="8%" align="left"> <div align="center">To Date: </div></td>

                                        <td width="50%" align="left"><input name="ctdate" type="text" id="ctdate" size="12" style="max-width:250px;" value="<?php echo $_REQUEST['ctdate'];?>" autocomplete="off"/></td>

                                      </tr>
									  

									  

									  

									<tr>

										

                                        <td align="right"> </td>



                                        <td colspan="3" align="left">

											<br />										</td>

                                      </tr>

                                      



                                      



                                      <tr>



                                        <td align="center">&nbsp;</td>

                                        <td align="center">&nbsp;</td>

                                        <td align="center"><input class="btn" name="show" type="submit" id="show" value="Show" /></td>

                                        <td align="center">&nbsp;</td>

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
    
         if($_REQUEST['cfdate']==''){
$show_compa='style="display:none;"';
}
?>									
<div id="grp">
<table width="100%"  border="1" cellspacing="0" cellpadding="0">

										<thead>

										<tr>

											<th width="40%" rowspan="2" bgcolor="#82D8CF"  style="color:#000000;">&nbsp; Particular</th>
											<th width="10%" rowspan="2" bgcolor="#82D8CF"  style="color:#000000; text-align:center">&nbsp; Notes</th>

											<th width="25%" bgcolor="#82D8CF"  style="color:#000000;">
										      <div align="center">
										        Amount In Taka
								            </div></th>
										    <th width="25%" bgcolor="#82D8CF" <?php echo $show_compa;?>   style="color:#000000;"><div align="center">
										     Amount In Taka
										    </div>
									        </th>
										</tr>
										<tr>
										  <th bgcolor="#82D8CF"  style="color:#000000;"><div align="center"><?=date("d M' y",strtotime($_REQUEST['tdate']))?></div></th>
										  <th width="22%" bgcolor="#82D8CF" <?php echo $show_compa;?>  style="color:#000000;"><div align="center"> <?=date("d M' y",strtotime($_REQUEST['ctdate']))?></div></th>
										</tr>
										</thead>

										

										
										
<?

 $sql = "select l.acc_sub_sub_class, sum(j.cr_amt-j.dr_amt) as sales_amt from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date between '".$fdate."' and '".$tdate."' and a.acc_class=3 and s.id=311  group by l.acc_sub_sub_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$sales_amt[$data->acc_sub_sub_class]=$data->sales_amt;

}


$sql = "select l.acc_sub_sub_class, sum(j.cr_amt-j.dr_amt) as sales_amt from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date between '".$cfdate."' and '".$ctdate."' and a.acc_class=3 and s.id=311  group by l.acc_sub_sub_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$sales_amt2[$data->acc_sub_sub_class]=$data->sales_amt;

}


 $sql = "select l.acc_sub_sub_class, sum(j.dr_amt-j.cr_amt) as expenses_amt from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date between '".$fdate."' and '".$tdate."' and a.acc_class=4 and s.id in (417,418) group by l.acc_sub_sub_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$expenses_amt[$data->acc_sub_sub_class]=$data->expenses_amt;

}

 $sql = "select l.acc_sub_sub_class, sum(j.dr_amt-j.cr_amt) as expenses_amt from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date between '".$cfdate."' and '".$ctdate."' and a.acc_class=4 and s.id in (417,418) group by l.acc_sub_sub_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$expenses_amt2[$data->acc_sub_sub_class]=$data->expenses_amt;

}


	   
 $sql_sub1="select s.id, s.sub_class_name from acc_sub_class s where s.acc_class=3 
group by s.id";
$query_sub1=mysql_query($sql_sub1);

while($info_sub1=mysql_fetch_object($query_sub1)){ 
	   
	   
	   ?>
									<!--<tr>

										  <td bgcolor="#E0FFFF">&nbsp; <strong><?=$info_sub1->sub_class_name;?></strong></td>

										  <td bgcolor="#E0FFFF">&nbsp;</td>
									  </tr>-->
									  
									  

<?php


 $sql1="select ss.id, ss.sub_sub_class_name from acc_sub_sub_class ss where ss.acc_sub_class='".$info_sub1->id."' and ss.id not in (312,313)   order by ss.id";

$query1=mysql_query($sql1);

while($data1=mysql_fetch_object($query1)){ 
$pi++;
$sl=$pi;
?>


									  
									  
									  <tr>

										  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Service Revenue</td>
										  <td align="center">NOTE-15.00</td>
<td align="right"><a href="financial_transaction_group.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&acc_sub_sub_class=<?=$data1->id?>" target="_blank">
<?=number_format($sales_amt[$data1->id],2); $tot_sales_amt +=$sales_amt[$data1->id];?></a></td>
<td align="right" <?php echo $show_compa;?>><a href="financial_transaction_group.php?show=show&fdate=<?=$_REQUEST['cfdate']?>&tdate=<?=$_REQUEST['ctdate']?>&acc_sub_sub_class=<?=$data1->id?>" target="_blank">
<?=number_format($sales_amt2[$data1->id],2); $tot_sales_amt2 +=$sales_amt2[$data1->id];?></a></td>
									  </tr>
									  
									  <tr>

										  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Less: <?=find_a_field('acc_sub_sub_class','sub_sub_class_name','id=4113');?></td>
										  <td align="center"><?
										 $notes_id=find_a_field('acc_sub_sub_class','notes','id=4113');
										echo  find_a_field('accounts_notes','name','id='.$notes_id);?></td>
<td align="right"><a href="financial_transaction_group.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&acc_sub_sub_class=4113" target="_blank">
<?=number_format($cost_service=find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j','sum(j.dr_amt-j.cr_amt)','s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date between "'.$fdate.'" and "'.$tdate.'" and a.acc_class=4 and s.id=4113 group by l.acc_sub_sub_class'),2); $tot_exp_amt +=$cost_service;?></a></td>
<td align="right" <?php echo $show_compa;?>><a href="financial_transaction_group.php?show=show&fdate=<?=$_REQUEST['cfdate']?>&tdate=<?=$_REQUEST['ctdate']?>&acc_sub_sub_class=4113" target="_blank">
<?=number_format($cost_service2=find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j','sum(j.dr_amt-j.cr_amt)','s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date between "'.$cfdate.'" and "'.$ctdate.'" and a.acc_class=4 and s.id=4113 group by l.acc_sub_sub_class'),2); $tot_exp_amt2 +=$cost_service2;?></a></td>
									  </tr>
									  
									  
									  
<? }?>	
<tr>

										  <td align="left" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><b style="font-size:14px;">Gross Profit/(Loss):</b></strong></td>
											<td></td>
										  <td align="right"><strong>
									      <? number_format($gross_p_l=$tot_sales_amt-$cost_service,2); echo ($gross_p_l>0)?number_format($gross_p_l,2):'('.number_format($gross_p_l*(-1),2).')'; ?>
										  </strong></td>
										  <td align="right" <?php echo $show_compa;?>><strong>
									      <? number_format($gross_p_l2=$tot_sales_amt2-$cost_service2,2); echo ($gross_p_l2>0)?number_format($gross_p_l2,2):'('.number_format($gross_p_l2*(-1),2).')'; ?>
										  </strong></td>
									  </tr>
 						


							  
		<? 
		
		}?>
		
		
									

										
										
								
										
<?
	   
  $sql_sub2="select s.id, s.sub_class_name from acc_sub_class s where s.acc_class=4
group by s.id";
$query_sub2=mysql_query($sql_sub2);

while($info_sub2=mysql_fetch_object($query_sub2)){ 
	   
	   
	   ?>


<?php


 $sql2="select ss.id, ss.sub_sub_class_name from acc_sub_sub_class ss where ss.id in (417,418)  order by ss.id";

$query2=mysql_query($sql2);

while($data2=mysql_fetch_object($query2)){ 
$pi++;
$sl=$pi;

number_format($expenses_amt[$data2->id],2); $tot_expenses_amt +=$expenses_amt[$data2->id];

}



 $sql2="select ss.id, ss.sub_sub_class_name from acc_sub_sub_class ss where ss.id in (417,418)  order by ss.id";

$query2=mysql_query($sql2);

while($data2=mysql_fetch_object($query2)){ 
$pi++;
$sl=$pi;

number_format($expenses_amt2[$data2->id],2); $tot_expenses_amt2 +=$expenses_amt2[$data2->id];

}

?>



										<tr>

										  <td bgcolor="#D8BFD8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><b style="font-size:14px;">Less: Operating Expenses </b>
</strong></td>
											<td bgcolor="#D8BFD8"></td>
										  <td bgcolor="#D8BFD8" align="right"><?=number_format($tot_expenses_amt,2);?></td>
										  <td bgcolor="#D8BFD8" align="right" <?php echo $show_compa;?>><?=number_format($tot_expenses_amt2,2);?></td>
									  </tr>
									  
									  

<?php


 $sql2="select ss.id, ss.sub_sub_class_name,notes from acc_sub_sub_class ss where ss.id in (417,418)  order by ss.id";

$query2=mysql_query($sql2);

while($data2=mysql_fetch_object($query2)){ 
$pi++;
$sl=$pi;
?>


									  
									  
									  <tr>

										  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$data2->sub_sub_class_name;?></td>
											<td align="center"><?=find_a_field('accounts_notes','name','id='.$data2->notes);?></td>
										  <td align="right">
										  
		 <a href="financial_transaction_group.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&acc_sub_sub_class=<?=$data2->id?>" target="_blank">
		 <?=number_format($expenses_amt[$data2->id],2); //$tot_expenses_amt +=$expenses_amt[$data2->id];?></a></td>
		 <td align="right" <?php echo $show_compa;?>>
										  
		 <a href="financial_transaction_group.php?show=show&fdate=<?=$_REQUEST['cfdate']?>&tdate=<?=$_REQUEST['ctdate']?>&acc_sub_sub_class=<?=$data2->id?>" target="_blank">
		 <?=number_format($expenses_amt2[$data2->id],2); //$tot_expenses_amt2 +=$expenses_amt2[$data2->id];?></a></td>
									  </tr>
									  
									  
									  
<? }?>	

 						<tr>

										  <td align="left"><strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size:14px;">Operating Profit/(Loss) 
:</b></strong></td>
											<td></td>
										  <td align="right"><strong>
									      <? number_format($operating_p_l=$gross_p_l-$tot_expenses_amt,2);  echo ($operating_p_l>0)?number_format($operating_p_l,2):'('.number_format($operating_p_l*(-1),2).')';?>
										  </strong></td>
										  <td align="right" <?php echo $show_compa;?>><strong>
									      <? number_format($operating_p_l2=$gross_p_l2-$tot_expenses_amt2,2); echo ($operating_p_l2>0)?number_format($operating_p_l2,2):'('.number_format($operating_p_l2*(-1),2).')';?>
										  </strong></td>
 						</tr>


							  
		<? 
		//$tot_expenses_amt=0;
		}?>
		
		
									
									<tr>
									  <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add: <?=find_a_field('acc_sub_sub_class','sub_sub_class_name','id=312');?></td>
									  <td align="center"> <? $notes_id=find_a_field('acc_sub_sub_class','notes','id=312');
										echo  find_a_field('accounts_notes','name','id='.$notes_id); ?></td>
									  <td align="right"><a href="financial_transaction_group.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&acc_sub_sub_class=312" target="_blank"><?=number_format($non_op_income=find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j','sum(j.cr_amt-j.dr_amt)','s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date between "'.$fdate.'" and "'.$tdate.'" and a.acc_class=3 and s.id=312 group by l.acc_sub_sub_class'),2);?></a></td>
									  <td align="right" <?php echo $show_compa;?>><a href="financial_transaction_group.php?show=show&fdate=<?=$_REQUEST['cfdate']?>&tdate=<?=$_REQUEST['ctdate']?>&acc_sub_sub_class=312" target="_blank"><?=number_format($non_op_income2=find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j','sum(j.cr_amt-j.dr_amt)','s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date between "'.$cfdate.'" and "'.$ctdate.'" and a.acc_class=3 and s.id=312 group by l.acc_sub_sub_class'),2);?></a></td>
									  </tr>
									  <tr>
									  <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Less: <?=find_a_field('acc_sub_sub_class','sub_sub_class_name','id=412');?></td>
									  <td align="center"><? $notes_id=find_a_field('acc_sub_sub_class','notes','id=412');
										echo  find_a_field('accounts_notes','name','id='.$notes_id); ?> </td>
									  <td align="right"><a href="financial_transaction_group.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&acc_sub_sub_class=412" target="_blank"><?=number_format($non_op_expense=find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j','sum(j.dr_amt-j.cr_amt)','s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date between "'.$fdate.'" and "'.$tdate.'" and a.acc_class=4 and s.id=412 group by l.acc_sub_sub_class'),2);?></a></td>
									  <td align="right" <?php echo $show_compa;?>><a href="financial_transaction_group.php?show=show&fdate=<?=$_REQUEST['cfdate']?>&tdate=<?=$_REQUEST['ctdate']?>&acc_sub_sub_class=412" target="_blank"><?=number_format($non_op_expense2=find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j','sum(j.dr_amt-j.cr_amt)','s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date between "'.$cfdate.'" and "'.$ctdate.'" and a.acc_class=4 and s.id=412 group by l.acc_sub_sub_class'),2);?></a></td>
									  </tr>
									<tr>
									  <td align="left" bgcolor="#D8BFD8"><strong><b style="font-size:14px;">&nbsp;&nbsp;&nbsp; Profit/(Loss) Before Interest and Tax  (EBIT) 
:</b></strong></td>             <td bgcolor="#D8BFD8"></td>
									  <td align="right" bgcolor="#D8BFD8"><strong>
									  <? number_format($ebit =$operating_p_l+$non_op_income-$non_op_expense,2); echo ($ebit>0)?number_format($ebit,2):'('.number_format($ebit*(-1),2).')'; ?>
									  
									  
	 <? //($net_profit>0)?number_format($net_profit,2):'('.number_format($net_profit*(-1),2).')';?>
									  </strong></td>
									  
									  <td align="right" bgcolor="#D8BFD8" <?php echo $show_compa;?>><strong>
									  <? number_format($ebit2 =$operating_p_l2+$non_op_income2-$non_op_expense2,2); echo ($ebit2>0)?number_format($ebit2,2):'('.number_format($ebit2*(-1),2).')'; ?>
									  
									  
	 <? //($net_profit>0)?number_format($net_profit,2):'('.number_format($net_profit*(-1),2).')';?>
									  </strong></td>
									  </tr>
									  
									  <tr>
									  <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Less: <?=find_a_field('acc_sub_sub_class','sub_sub_class_name','id=4111');?></td>
									  <td align="center"><? $notes_id=find_a_field('acc_sub_sub_class','notes','id=4111');
										echo  find_a_field('accounts_notes','name','id='.$notes_id); ?> </td>
									  <td align="right"><a href="financial_transaction_group.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&acc_sub_sub_class=4111" target="_blank"><?=number_format($fin_expense=find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j','sum(j.dr_amt-j.cr_amt)','s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date between "'.$fdate.'" and "'.$tdate.'" and a.acc_class=4 and s.id=4111 group by l.acc_sub_sub_class'),2);?></a></td>
									  <td align="right" <?php echo $show_compa;?>><a href="financial_transaction_group.php?show=show&fdate=<?=$_REQUEST['cfdate']?>&tdate=<?=$_REQUEST['ctdate']?>&acc_sub_sub_class=4111" target="_blank"><?=number_format($fin_expense2=find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j','sum(j.dr_amt-j.cr_amt)','s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date between "'.$cfdate.'" and "'.$ctdate.'" and a.acc_class=4 and s.id=4111 group by l.acc_sub_sub_class'),2);?></a></td>
									  </tr>
									  <tr>
									  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size:14px;"> Profit/(Loss) before tax (EBT) </b> </td>
									  <td></td>
									  <td align="right"><? number_format($ebt=$ebit-$fin_expense,2); echo ($ebt>0)?number_format($ebt,2):'('.number_format($ebt*(-1),2).')';?></td>
									  <td align="right" <?php echo $show_compa;?>><? number_format($ebt2=$ebit2-$fin_expense2,2); echo ($ebt2>0)?number_format($ebt2,2):'('.number_format($ebt2*(-1),2).')';?></td>
									  </tr>
									  <tr>
									  <? 
									  $def_tax_expense=find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j','sum(j.dr_amt-j.cr_amt)','s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date between "'.$fdate.'" and "'.$tdate.'" and a.acc_class=4 and s.id=4117 group by l.acc_sub_sub_class');
									  $def_tax_expense2=find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j','sum(j.dr_amt-j.cr_amt)','s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date between "'.$cfdate.'" and "'.$ctdate.'" and a.acc_class=4 and s.id=4117 group by l.acc_sub_sub_class');
									  
									  $current_tax_expense=find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j','sum(j.dr_amt-j.cr_amt)','s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date between "'.$fdate.'" and "'.$tdate.'" and a.acc_class=4 and s.id=4116 group by l.acc_sub_sub_class');
									  
									  $current_tax_expense2=find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j','sum(j.dr_amt-j.cr_amt)','s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date between "'.$cfdate.'" and "'.$ctdate.'" and a.acc_class=4 and s.id=4116 group by l.acc_sub_sub_class');
									  $def_tax_income2=find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j','sum(j.dr_amt-j.cr_amt)','s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date between "'.$cfdate.'" and "'.$ctdate.'" and a.acc_class=3 and s.id=313 group by l.acc_sub_sub_class');
									  
									  $def_tax_income=find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j','sum(j.dr_amt-j.cr_amt)','s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date between "'.$fdate.'" and "'.$tdate.'" and a.acc_class=3 and s.id=313 group by l.acc_sub_sub_class');
									  
									  ?>
									  
									  
									  <td > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><b style="font-size:14px;"> Less: Income Tax Expenses </b></strong>
</td>									<td></td>
									  <td align="right"><? number_format($def_expense_income=$def_tax_expense+$current_tax_expense-$def_tax_income,2); echo ($def_expense_income>0)?number_format($def_expense_income,2):'('.number_format($def_expense_income*(-1),2).')';?></td>
									  <td align="right" <?php echo $show_compa;?>><? number_format($def_expense_income2=$def_tax_expense2+$current_tax_expense2-$def_tax_income2,2); echo ($def_expense_income2>0)?number_format($def_expense_income2,2):'('.number_format($def_expense_income2*(-1),2).')';?></td>
									  </tr>
									  
									  <tr>
									  <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?=find_a_field('acc_sub_sub_class','sub_sub_class_name','id=4116');?></td>
									  <td align="center"><? $notes_id=find_a_field('acc_sub_sub_class','notes','id=4116');
										echo  find_a_field('accounts_notes','name','id='.$notes_id); ?> </td>
									  <td align="right"><a href="financial_transaction_group.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&acc_sub_sub_class=4117" target="_blank"><?=number_format($current_tax_expense,2);?></a></td>
									   <td align="right" <?php echo $show_compa;?>><a href="financial_transaction_group.php?show=show&fdate=<?=$_REQUEST['cfdate']?>&tdate=<?=$_REQUEST['ctdate']?>&acc_sub_sub_class=4117" target="_blank"><?=number_format($current_tax_expense2,2);?></a></td>
									  </tr>
									  
									  <tr>
									  <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=find_a_field('acc_sub_sub_class','sub_sub_class_name','id=4117');?></td>
									  <td align="center"><? $notes_id=find_a_field('acc_sub_sub_class','notes','id=4117');
										echo  find_a_field('accounts_notes','name','id='.$notes_id); ?></td>
									  <td align="right"><a href="financial_transaction_group.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&acc_sub_sub_class=4117" target="_blank"><?=number_format($def_tax_expense,2);?></a></td>
									   <td align="right" <?php echo $show_compa;?>><a href="financial_transaction_group.php?show=show&fdate=<?=$_REQUEST['cfdate']?>&tdate=<?=$_REQUEST['ctdate']?>&acc_sub_sub_class=4117" target="_blank"><?=number_format($def_tax_expense2,2);?></a></td>
									  </tr>
									  
									  
									  <tr>
									  <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?=find_a_field('acc_sub_sub_class','sub_sub_class_name','id=313');?></td>
									  <td align="center"><? $notes_id=find_a_field('acc_sub_sub_class','notes','id=313');
										echo  find_a_field('accounts_notes','name','id='.$notes_id); ?></td>
									  <td align="right"><a href="financial_transaction_group.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&acc_sub_sub_class=313" target="_blank"><?=number_format($def_tax_income,2);?></a></td>
									  <td align="right" <?php echo $show_compa;?>><a href="financial_transaction_group.php?show=show&fdate=<?=$_REQUEST['cfdate']?>&tdate=<?=$_REQUEST['ctdate']?>&acc_sub_sub_class=313" target="_blank"><?=number_format($def_tax_income,2);?></a></td>
									  </tr>
									<tr>
									  <td align="left"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><b style="font-size:14px;"> Profit/(Loss) after tax </b></strong>
</td>
										<td></td>
									  <td align="right"><? number_format($p_l_after_tax=$ebt-$def_expense_income,2); echo ($p_l_after_tax>0)?number_format($p_l_after_tax,2):'('.number_format($p_l_after_tax*(-1),2).')';?></td>
									  <td align="right" <?php echo $show_compa;?>><? number_format($p_l_after_tax2=$ebt2-$def_expense_income2,2); echo ($p_l_after_tax2>0)?number_format($p_l_after_tax2,2):'('.number_format($p_l_after_tax2*(-1),2).')';?></td>
									  </tr>
									  <tr>
									  <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Other Comprehensive Income 
</td>
									  <td align="right">&nbsp;</td>
									  <td align="right">&nbsp;</td>
									  <td align="right" <?php echo $show_compa;?>>&nbsp;</td>
									  </tr>
									<tr>
									  <td align="center" bgcolor="#FF6347"><b style="font-size:14px;"> Total Comprehensive Income(Loss) for the Year 
:</b></td>						<td bgcolor="#FF6347"></td>
									  <td align="right" bgcolor="#FF6347"><strong>
									 
									  
									  
	 <? number_format($yearly_income=$p_l_after_tax,2); echo ($yearly_income>0)?number_format($yearly_income,2):'('.number_format($yearly_income*(-1),2).')';?>
									  </strong></td>
									  <td align="right" bgcolor="#FF6347" <?php echo $show_compa;?>><strong>
									 
									  
									  
	 <? number_format($yearly_income2=$p_l_after_tax2,2); echo ($yearly_income2>0)?number_format($yearly_income2,2):'('.number_format($yearly_income2*(-1),2).')';?>
									  </strong></td>
									  
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
									  	<td colspan="4"> Statement of Profit or  Loss and Other Comprehensive Income 			
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
									  
									  
									  



									</div>







									</td>



								</tr>
								 



						</table>

<? }?>

		</div></td>    



  </tr>
						<tr>
									  	<td>&nbsp; </td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									  </tr>
									  
									  
									 


</table>



<?



require_once "../../../assets/template/layout.bottom.php";



?>