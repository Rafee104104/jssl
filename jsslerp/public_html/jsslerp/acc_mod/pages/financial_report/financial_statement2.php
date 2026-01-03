<?php



require_once "../../../assets/template/layout.top.php";







$title='Statement of Financial Position';





do_calander('#fdate');

do_calander('#tdate');

do_calander('#cfdate');

do_calander('#ctdate');



$fdate=$_REQUEST["fdate"];

$tdate=$_REQUEST['tdate'];

$cfdate=$_REQUEST["cfdate"];

$ctdate=$_REQUEST['ctdate'];

if(isset($_REQUEST['tdate'])&&$_REQUEST['tdate']!='')



$report_detail.='<br>As at Date: '.date("d F' Y",strtotime($tdate));



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

									  

									  <tr>



                                        <td width="22%" align="right">Comparative Date :  </td>

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
								<table  width="100%" border="1" cellspacing="0" cellpadding="0">

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

		<!--<tr>
									  <td bgcolor="#E0FFFF">&nbsp; <strong>ASSETS</strong></td>
									  <td bgcolor="#E0FFFF">&nbsp;</td>
									  <td bgcolor="#E0FFFF">&nbsp;</td>
				  </tr>-->								

										
										
<?

 $sql = "select l.acc_sub_sub_class, sum(j.dr_amt-j.cr_amt) as asset_amt from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and j.jv_date<='".$tdate."' group by l.acc_sub_sub_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$asset_amt[$data->acc_sub_sub_class]=$data->asset_amt;

}

$sql = "select l.acc_sub_sub_class, sum(j.dr_amt-j.cr_amt) as asset_amt from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and j.jv_date <= '".$ctdate."' group by l.acc_sub_sub_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
 $asset_amt2[$data->acc_sub_sub_class]=$data->asset_amt;

}


 $sql = "select l.acc_sub_sub_class, sum(j.cr_amt-j.dr_amt) as liability_amt from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date<='".$tdate."' group by l.acc_sub_sub_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$liability_amt[$data->acc_sub_sub_class]=$data->liability_amt;

}


$sql = "select l.acc_sub_sub_class, sum(j.cr_amt-j.dr_amt) as liability_amt from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date <= '".$ctdate."' group by l.acc_sub_sub_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$liability_amt2[$data->acc_sub_sub_class]=$data->liability_amt;

}

	   
 $sql_sub1="select s.id, s.sub_class_name from acc_sub_class s where s.id=11
group by s.id";
$query_sub1=mysql_query($sql_sub1);

while($info_sub1=mysql_fetch_object($query_sub1)){ 
	   
	   
	   ?>
									
									<tr>

										  <td bgcolor="#E0FFFF">&nbsp; <strong><?=$info_sub1->sub_class_name;?></strong></td>

										  <td bgcolor="#E0FFFF">&nbsp;</td><?
										  $sql1="select ss.id, ss.sub_sub_class_name from acc_sub_sub_class ss where ss.id in (2231)  order by ss.id";

$query1=mysql_query($sql1);

while($data1=mysql_fetch_object($query1)){ 
$pi++;
$sl=$pi;
  $asset_amortization=$asset_amt[$data1->id];

}

 $sql1="select ss.id, ss.sub_sub_class_name from acc_sub_sub_class ss where ss.id in (2231)  order by ss.id";

$query1=mysql_query($sql1);

while($data1=mysql_fetch_object($query1)){ 
$pi++;
$sl=$pi;
  $asset_amortization2=$asset_amt2[$data1->id];

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
 $asset_intangile2=$asset_amt2[$data1->id]+$asset_amortization2;
 
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

$sql1="select ss.id, ss.sub_sub_class_name from acc_sub_sub_class ss where ss.id in (228)  order by ss.id";

$query1=mysql_query($sql1);

while($data1=mysql_fetch_object($query1)){ 
$pi++;
$sl=$pi;
 $tot_asset_amt_depre2=$asset_amt2[$data1->id];
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
 $asset_plant2=$asset_amt2[$data1->id]+$tot_asset_amt_depre2;

}
?>



<?
  
$sql1="select ss.id, ss.sub_sub_class_name from acc_sub_sub_class ss where ss.id in (121,1213,1215,1225,1229)  order by ss.id";
$query1=mysql_query($sql1);

while($data1=mysql_fetch_object($query1)){ 

 $tot_asset_amt222+=$asset_amt2[$data1->id];
 }

?>


	

<?
  $sql1="select ss.id, ss.sub_sub_class_name from acc_sub_sub_class ss where ss.id in (1119,119)  order by ss.id";

$query1=mysql_query($sql1);

while($data1=mysql_fetch_object($query1)){ 
$pi++;
$sl=$pi;
 $tot_asset_amt+=$asset_amt[$data1->id];
 $tot_asset_amt2+=$asset_amt2[$data1->id];
?>


									  
									 
									  
									  
									  
									  
<? }?>	
										  
										  
										<td bgcolor="#E0FFFF" align="right"><?=number_format($tot_cur_asset5=$asset_plant+$asset_intangile,2);  ?></td>   
										<td bgcolor="#E0FFFF" align="right" <?php echo $show_compa;?> ><?=number_format($tot_cur_asset2=$asset_plant2+$asset_intangile2,2).'<br>'; //echo $tot_asset_amt2.'<br>'; echo $tot_asset_amt_depre; ?></td>   
									  </tr>
									  
									  

<?php


$sql1="select ss.id, ss.sub_sub_class_name,notes from acc_sub_sub_class ss where ss.id in (1119)  order by ss.id";

$query1=mysql_query($sql1);

while($data1=mysql_fetch_object($query1)){ 
$pi++;
$sl=$pi;
?>


									  
									  
									  <tr>

										  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$data1->sub_sub_class_name;?></td>
                                          <td align="center"><a href="financial_statement_notes.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&cfdate=<?=$_REQUEST['cfdate']?>&ctdate=<?=$_REQUEST['ctdate']?>" target="_blank"><?=find_a_field('accounts_notes','name','id='.$data1->notes);?></a></td>
                                        <td align="right"><a href="financial_transaction_group_closing.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&acc_sub_sub_class=<?=$data1->id?>,228" target="_blank">
<?=number_format($asset_plant=$asset_amt[$data1->id]+$tot_asset_amt_depre,2).'<br>'; $tot_asset_amt +=$asset_amt[$data1->id]; // echo $asset_amt[$data1->id].'<br>'; echo $tot_asset_amt_depre;?></a></td>

<td align="right" <?php echo $show_compa;?>><a href="financial_transaction_group_closing.php?show=show&fdate=<?=$_REQUEST['cfdate']?>&tdate=<?=$_REQUEST['ctdate']?>&acc_sub_sub_class=<?=$data1->id?>,228" target="_blank">
<?=number_format($tot_asset=$asset_amt2[$data1->id]+$tot_asset_amt_depre2,2).'<br>'; $tot_asset_amt2 +=$tot_asset; //echo $asset_amt[$data1->id].'<br>'; echo $tot_asset_amt_depre;?></a></td>
									  </tr>
									  
									  
									  
<? }?>	

<?
$sql1="select ss.id, ss.sub_sub_class_name,notes from acc_sub_sub_class ss where ss.id in (119)  order by ss.id";

$query1=mysql_query($sql1);

while($data1=mysql_fetch_object($query1)){ 
$pi++;
$sl=$pi;
?>


									  
									  
									  <tr>

										  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$data1->sub_sub_class_name;?></td>
                                          <td align="center"><a href="financial_statement_notes.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&cfdate=<?=$_REQUEST['cfdate']?>&ctdate=<?=$_REQUEST['ctdate']?>" target="_blank"><?=find_a_field('accounts_notes','name','id='.$data1->notes);?></a></td>
                                        <td align="right"><a href="financial_transaction_group_closing.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&acc_sub_sub_class=<?=$data1->id?>,2231" target="_blank">
<?=number_format($asset_intangile=$asset_amt[$data1->id]+$asset_amortization,2); $tot_asset_amt +=$asset_amt[$data1->id];?></a></td>

<td align="right" <?php echo $show_compa;?>><a href="financial_transaction_group_closing.php?show=show&fdate=<?=$_REQUEST['cfdate']?>&tdate=<?=$_REQUEST['ctdate']?>&acc_sub_sub_class=<?=$data1->id?>,2231" target="_blank">
<?=number_format($asset_amt2[$data1->id]+$asset_amortization2,2); $tot_asset_amt2 +=$asset_amt2[$data1->id];?></a></td>
									  </tr>
									  
									  
									  
<? }?>	

 						<tr>

										  <td align="center"><strong></strong></td>

										  <td align="right">&nbsp;</td>
										  <td align="right"><strong>
									      
										  </strong></td>
										  <td align="right" <?php echo $show_compa;?>><strong>
									      
										  </strong></td>
									  </tr>


							  
		<? 
		$tot_asset_amt=0;
		}?>
		
	<?	
		$sql_sub1="select s.id, s.sub_class_name from acc_sub_class s where s.id=12
group by s.id";
$query_sub1=mysql_query($sql_sub1);

while($info_sub1=mysql_fetch_object($query_sub1)){ 
	   
	   
	   ?>
				
				
				<?php


$sql1="select ss.id, ss.sub_sub_class_name,ss.notes from acc_sub_sub_class ss where ss.id in (121,1213,1215,1225,1229)  order by ss.id";

$query1=mysql_query($sql1);

while($data1=mysql_fetch_object($query1)){ 
$pi++;
$sl=$pi;
?>


									  
									  
									  
<?  number_format($asset_amt[$data1->id],2); $tot_asset_amt +=$asset_amt[$data1->id];?>
									  
									  
									  
									  
<? }?>		

<?php


$sql1="select ss.id, ss.sub_sub_class_name ,ss.notes from acc_sub_sub_class ss where ss.id in (121,1213,1215,1225,1229)  order by ss.id";

$query1=mysql_query($sql1);

while($data1=mysql_fetch_object($query1)){ 
$pi++;
$sl=$pi;
?>


									  
									  
									  
<? number_format($asset_amt2[$data1->id],2); $tot_asset_amt2 +=$asset_amt2[$data1->id];?>
									  
									  
									  
									  
<? }?>						

<? 
										  
										  
									 $gg = "SELECT SUM(b.dr_amt - b.cr_amt) AS opening, b.ledger_id FROM accounts_ledger a, journal b WHERE  a.ledger_group_id =1214001 and a.ledger_id = b.ledger_id AND b.jv_date < '$fdate' GROUP BY a.ledger_id";
												$ggs = mysql_query($gg);
												while ($gs = mysql_fetch_object($ggs)) {
													$opening_balnace[$gs->ledger_id] = $gs->opening;
												}
												
												$gg = "SELECT SUM(b.dr_amt - b.cr_amt) AS opening, b.ledger_id FROM accounts_ledger a, journal b WHERE  a.ledger_group_id =1214001 and a.ledger_id = b.ledger_id AND b.jv_date < '$cfdate' GROUP BY a.ledger_id";
												$ggs = mysql_query($gg);
												while ($gs = mysql_fetch_object($ggs)) {
													$opening_balnace2[$gs->ledger_id] = $gs->opening;
												}
											
												
												$balnce = "SELECT SUM(b.dr_amt) AS debit, SUM(b.cr_amt) AS credit, b.ledger_id FROM accounts_ledger a, journal b WHERE a.ledger_id = b.ledger_id AND b.jv_date BETWEEN '$fdate' AND '$tdate' and a.ledger_group_id =1214001  GROUP BY a.ledger_id";
												$bal_query = mysql_query($balnce);
												while ($bal = mysql_fetch_object($bal_query)) {
													$dr_balnace[$bal->ledger_id] = $bal->debit;
													$cr_balnace[$bal->ledger_id] = $bal->credit;
												}
												$balnce = "SELECT SUM(b.dr_amt) AS debit, SUM(b.cr_amt) AS credit, b.ledger_id FROM accounts_ledger a, journal b WHERE a.ledger_id = b.ledger_id AND b.jv_date BETWEEN '$cfdate' AND '$ctdate' and a.ledger_group_id =1214001  GROUP BY a.ledger_id";
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
										   $tot_dr_closing124 += $closing > 0 ? $closing : 0;
										   $tot_cr_closing124 += $closing < 0 ? abs($closing) : 0;
										   
										  
										   $closing2 = ($opening_balnace2[$p->ledger_id] + $dr_balnace2[$p->ledger_id]) - $cr_balnace2[$p->ledger_id];
								
										 $closing2 > 0 ? number_format($dr_closing2 = $closing2, 2) : ''.'<br>';
										 $closing2 < 0 ? number_format($cr_closing2 = $closing2 * -1, 2) : ''.'<br>';
										   $tot_dr_closing1244 += $closing2 > 0 ? $closing2 : 0;
										   $tot_cr_closing1244 += $closing2 < 0 ? abs($closing2) : 0;
										   
										  
												  
									}								
									  
										
										
										//Account Payable
										
										 $ggs = "SELECT SUM(b.dr_amt - b.cr_amt) AS opening, b.ledger_id FROM accounts_ledger a, journal b WHERE  a.ledger_group_id =225001 and a.ledger_id = b.ledger_id AND b.jv_date < '$fdate' GROUP BY a.ledger_id";
												$ggss = mysql_query($ggs);
												while ($gs = mysql_fetch_object($ggss)) {
													$opening_balnace[$gs->ledger_id] = $gs->opening;
												}
												
												$ggts = "SELECT SUM(b.dr_amt - b.cr_amt) AS opening, b.ledger_id FROM accounts_ledger a, journal b WHERE  a.ledger_group_id =225001 and a.ledger_id = b.ledger_id AND b.jv_date < '$cfdate' GROUP BY a.ledger_id";
												$ggse= mysql_query($ggts);
												while ($gs = mysql_fetch_object($ggse)) {
													$opening_balnace2[$gs->ledger_id] = $gs->opening;
												}
											
												
												$balnced = "SELECT SUM(b.dr_amt) AS debit, SUM(b.cr_amt) AS credit, b.ledger_id FROM accounts_ledger a, journal b WHERE a.ledger_id = b.ledger_id AND b.jv_date BETWEEN '$fdate' AND '$tdate' and a.ledger_group_id =225001  GROUP BY a.ledger_id";
												$bal_querys = mysql_query($balnced);
												while ($bal = mysql_fetch_object($bal_querys)) {
													$dr_balnace[$bal->ledger_id] = $bal->debit;
													$cr_balnace[$bal->ledger_id] = $bal->credit;
												}
												$balncecd = "SELECT SUM(b.dr_amt) AS debit, SUM(b.cr_amt) AS credit, b.ledger_id FROM accounts_ledger a, journal b WHERE a.ledger_id = b.ledger_id AND b.jv_date BETWEEN '$cfdate' AND '$ctdate' and a.ledger_group_id =225001  GROUP BY a.ledger_id";
												$bal_queryee = mysql_query($balncecd);
												while ($bal = mysql_fetch_object($bal_queryee)) {
													$dr_balnace2[$bal->ledger_id] = $bal->debit;
													$cr_balnace2[$bal->ledger_id] = $bal->credit;
												}
									$p22 = "SELECT DISTINCT a.ledger_name, a.ledger_id FROM accounts_ledger a WHERE  a.ledger_group_id = 225001   ORDER BY a.ledger_name";
									$sql2 = mysql_query($p22);
								   
									$tot_dr_closing = 0;
									$tot_cr_closing = 0;
									while ($p2 = mysql_fetch_object($sql2)) {
									   
									 $closing = ($opening_balnace[$p2->ledger_id] + $dr_balnace[$p2->ledger_id]) - $cr_balnace[$p2->ledger_id];
								
										 $closing > 0 ? number_format($dr_closing = $closing, 2) : ''.'<br>';
										 $closing < 0 ? number_format($cr_closing = $closing * -1, 2) : ''.'<br>';
										  // $tot_dr_closing125 += $closing > 0 ? $closing : 0;
										   $tot_cr_closing125 += $closing < 0 ? abs($closing) : 0;
										   
										   
										   $closing22 = ($opening_balnace2[$p2->ledger_id] + $dr_balnace2[$p2->ledger_id]) - $cr_balnace2[$p2->ledger_id];
								
										 $closing22 > 0 ? number_format($dr_closing2 = $closing22, 2) : ''.'<br>';
										 $closing22 < 0 ? number_format($cr_closing2 = $closing22 * -1, 2) : ''.'<br>';
										   //$tot_dr_closing1255 += $closing22 > 0 ? $closing22 : 0;
										   $tot_cr_closing1255 += $closing22 < 0 ? abs($closing22) : 0;
												  
									}	
									
									
									
?>
														  
										 
										  
										  

										  
										  
										  
									<tr>

										  <td bgcolor="#E0FFFF">&nbsp; <strong><?=$info_sub1->sub_class_name;?></strong></td>
										
										 
										  <td bgcolor="#E0FFFF">&nbsp;</td>
									  <td bgcolor="#E0FFFF" align="right"><?=number_format($tot_non_current=$tot_asset_amt+$tot_dr_closing124,2);?></td>
										  <td bgcolor="#E0FFFF" align="right" <?php echo $show_compa;?>><?=number_format($tot_non_current2=$tot_asset_amt222+$tot_dr_closing1244,2); ?></td>
									  </tr>
									  <tr>

										  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=find_a_field('acc_sub_sub_class','sub_sub_class_name','id=1214');?> Receivable</td>
                                          <td align="center"><a href="financial_statement_notes.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&cfdate=<?=$_REQUEST['cfdate']?>&ctdate=<?=$_REQUEST['ctdate']?>" target="_blank"><?
										 $rec_note= find_all_field('acc_sub_sub_class','id','id=1214');
										 echo find_a_field('accounts_notes','name','id='.$rec_note->notes);?></a></td>
										  
										  
                                        <td align="right"><a href="financial_transaction_group_closing.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&acc_sub_sub_class=1214" target="_blank">
<?=$tot_dr_closing124 ?></a></td>

<td align="right" <?php echo $show_compa;?>><a href="financial_transaction_group_closing.php?show=show&fdate=<?=$_REQUEST['cfdate']?>&tdate=<?=$_REQUEST['ctdate']?>&acc_sub_sub_class=1214" target="_blank"><? echo $tot_dr_closing1244; ?>
</a></td>
									  </tr>
									  
									  <!--<tr>

										  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Advance Paid to Supplier <? //find_a_field('acc_sub_sub_class','sub_sub_class_name','id=225');?> </td>
                                          <td align="right">&nbsp;</td>
										  
										  
                                        <td align="right"><a href="financial_transaction_group_closing.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&acc_sub_sub_class=225" target="_blank">
<?=$tot_dr_closing125 ?></a></td>

<td align="right" <?php echo $show_compa;?>><a href="financial_transaction_group_closing.php?show=show&fdate=<?=$_REQUEST['cfdate']?>&tdate=<?=$_REQUEST['ctdate']?>&acc_sub_sub_class=225" target="_blank"><? echo $tot_dr_closing1255; ?>
</a></td>
									  </tr>-->

<?php


 $sql1="select ss.id, ss.sub_sub_class_name,ss.notes from acc_sub_sub_class ss where ss.id in (121,1213,1215)  order by ss.id";

$query1=mysql_query($sql1);

while($data1=mysql_fetch_object($query1)){ 
$pi++;
$sl=$pi;
?>


									  
									  
									  
									  <tr>

										  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$data1->sub_sub_class_name;?></td>
                                          <td align="center"><a href="financial_statement_notes.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&cfdate=<?=$_REQUEST['cfdate']?>&ctdate=<?=$_REQUEST['ctdate']?>" target="_blank"><?=find_a_field('accounts_notes','name','id='.$data1->notes);?></a></td>
                                        <td align="right"><a href="financial_transaction_group_closing.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&acc_sub_sub_class=<?=$data1->id?>" target="_blank">
<?  echo ($asset_amt[$data1->id]>0)?number_format($asset_amt[$data1->id],2):'('.number_format($asset_amt[$data1->id]*(-1),2).')';   $tot_asset_amt +=$asset_amt[$data1->id];?></a></td>

<td align="right" <?php echo $show_compa;?>><a href="financial_transaction_group_closing.php?show=show&fdate=<?=$_REQUEST['cfdate']?>&tdate=<?=$_REQUEST['ctdate']?>&acc_sub_sub_class=<?=$data1->id?>" target="_blank">
<?=number_format($asset_amt2[$data1->id],2);   $tot_asset_amt2 +=$asset_amt2[$data1->id];?></a></td>
									  </tr>
									  
									  
									  
<? }  ?>

<?php


 $sql1="select ss.id, ss.sub_sub_class_name,ss.notes from acc_sub_sub_class ss where ss.id in (1229)  order by ss.id";

$query1=mysql_query($sql1);

while($data1=mysql_fetch_object($query1)){ 
$pi++;
$sl=$pi;

$bank=$asset_amt[$data1->id];
$bank2=$asset_amt2[$data1->id];

}
?>



<?php


 $sql1="select ss.id, ss.sub_sub_class_name,ss.notes from acc_sub_sub_class ss where ss.id in (1225)  order by ss.id";

$query1=mysql_query($sql1);

while($data1=mysql_fetch_object($query1)){ 
$pi++;
$sl=$pi;
?>


									  
									  
									  
									  <tr>

										  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$data1->sub_sub_class_name;?></td>
                                          <td align="center"><a href="financial_statement_notes.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&cfdate=<?=$_REQUEST['cfdate']?>&ctdate=<?=$_REQUEST['ctdate']?>" target="_blank"><?=find_a_field('accounts_notes','name','id='.$data1->notes);?></a></td>
                                        <td align="right"><a href="financial_transaction_group_closing.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&acc_sub_sub_class=<?=$data1->id?>" target="_blank">
<? $tot_cash_bank=$asset_amt[$data1->id]+$bank; echo ($tot_cash_bank>0)?number_format($tot_cash_bank,2):'('.number_format(($tot_cash_bank)*(-1),2).')';   $tot_asset_amt +=$tot_cash_bank;?></a></td>

<td align="right" <?php echo $show_compa;?>><a href="financial_transaction_group_closing.php?show=show&fdate=<?=$_REQUEST['cfdate']?>&tdate=<?=$_REQUEST['ctdate']?>&acc_sub_sub_class=<?=$data1->id?>" target="_blank">
<? $tot_cash_bank2=$asset_amt2[$data1->id]+$bank2; echo number_format($tot_cash_bank2,2);   $tot_asset_amt2 +=$tot_cash_bank2;?></a></td>
									  </tr>
									  
									  
									  
<? }  ?>

 						<tr>

										  <td align="center"><strong>:</strong></td>

										  <td align="right">&nbsp;</td>
										  <td align="right"><strong>
									      
										  </strong></td>
										  <td align="right" <?php echo $show_compa;?>><strong>
									      
										  </strong></td>
									  </tr>


							  
		<? 
		$tot_asset_amt=0;
		$tot_asset_amt2=0;
		}?>
									<tr>

										  <td align="center"><strong>Total Assets:</strong></td>

										  <td align="right">&nbsp;</td>
										  <td align="right"><strong>
									      <?=number_format($tot_cur_asset5+$tot_non_current,2);?>
										  </strong></td>
										  <td align="right" <?php echo $show_compa;?>><strong>
									      <?=number_format($tot_cur_asset2+$tot_non_current2,2);?>
										  </strong></td>
									  </tr>
									  
									  <tr>
									  <td align="center">&nbsp;</td>
									  <td align="right">&nbsp;</td>
									  <td align="right">&nbsp;</td>
									   <td align="right" <?php echo $show_compa;?>>&nbsp;</td>
									  </tr>
										

			<!--<tr>
										  <td bgcolor="#D8BFD8">&nbsp;<strong>EQUITY & LIABILITIES</strong></td>
										  <td bgcolor="#D8BFD8">&nbsp;</td>
										  <td bgcolor="#D8BFD8">&nbsp;</td>
				  </tr>-->	
				  
				  							
	<?php

$sql = "SELECT l.acc_sub_sub_class, SUM(j.cr_amt - j.dr_amt) AS sales_amt 
        FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
        WHERE s.id = l.acc_sub_sub_class 
          AND l.group_id = a.ledger_group_id 
          AND a.ledger_id = j.ledger_id 
          AND j.jv_date BETWEEN '".$fdate."' AND '".$tdate."' 
          AND a.acc_class = 3 
          AND s.id = 311  
        GROUP BY l.acc_sub_sub_class";
$query = mysql_query($sql);
while ($data = mysql_fetch_object($query)) {
    $sales_amt[$data->acc_sub_sub_class] = $data->sales_amt;
}

$sql = "SELECT l.acc_sub_sub_class, SUM(j.cr_amt - j.dr_amt) AS sales_amt 
        FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
        WHERE s.id = l.acc_sub_sub_class 
          AND l.group_id = a.ledger_group_id 
          AND a.ledger_id = j.ledger_id 
          AND j.jv_date BETWEEN '".$cfdate."' AND '".$ctdate."' 
          AND a.acc_class = 3 
          AND s.id = 311  
        GROUP BY l.acc_sub_sub_class";
$query = mysql_query($sql);
while ($data = mysql_fetch_object($query)) {
    $sales_amt2[$data->acc_sub_sub_class] = $data->sales_amt;
}

$sql = "SELECT l.acc_sub_sub_class, SUM(j.dr_amt - j.cr_amt) AS expenses_amt 
        FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
        WHERE s.id = l.acc_sub_sub_class 
          AND l.group_id = a.ledger_group_id 
          AND a.ledger_id = j.ledger_id 
          AND j.jv_date BETWEEN '".$fdate."' AND '".$tdate."' 
          AND a.acc_class = 4 
          AND s.id IN (417,418) 
        GROUP BY l.acc_sub_sub_class";
$query = mysql_query($sql);
while ($data = mysql_fetch_object($query)) {
    $expenses_amt[$data->acc_sub_sub_class] = $data->expenses_amt;
}

$sql = "SELECT l.acc_sub_sub_class, SUM(j.dr_amt - j.cr_amt) AS expenses_amt 
        FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
        WHERE s.id = l.acc_sub_sub_class 
          AND l.group_id = a.ledger_group_id 
          AND a.ledger_id = j.ledger_id 
          AND j.jv_date BETWEEN '".$cfdate."' AND '".$ctdate."' 
          AND a.acc_class = 4 
          AND s.id IN (417,418) 
        GROUP BY l.acc_sub_sub_class";
$query = mysql_query($sql);
while ($data = mysql_fetch_object($query)) {
    $expenses_amt2[$data->acc_sub_sub_class] = $data->expenses_amt;
}

$sql_sub1 = "SELECT s.id, s.sub_class_name 
             FROM acc_sub_class s 
             WHERE s.acc_class = 3 
             GROUP BY s.id";
$query_sub1 = mysql_query($sql_sub1);

while ($info_sub1 = mysql_fetch_object($query_sub1)) {

    $sql1 = "SELECT ss.id, ss.sub_sub_class_name 
             FROM acc_sub_sub_class ss 
             WHERE ss.acc_sub_class = '".$info_sub1->id."' 
               AND ss.id NOT IN (312,313) 
             ORDER BY ss.id";
    $query1 = mysql_query($sql1);

    while ($data1 = mysql_fetch_object($query1)) {
        $pi++;
        $sl = $pi;

        $tot_sales_amt += $sales_amt[$data1->id];
        $tot_sales_amt2 += $sales_amt2[$data1->id];

        $cost_service = find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j',
            'SUM(j.dr_amt - j.cr_amt)',
            's.id = l.acc_sub_sub_class AND l.group_id = a.ledger_group_id AND a.ledger_id = j.ledger_id AND j.jv_date BETWEEN "'.$fdate.'" AND "'.$tdate.'" AND a.acc_class = 4 AND s.id = 4113 GROUP BY l.acc_sub_sub_class');
        $tot_exp_amt += $cost_service;

        $cost_service2 = find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j',
            'SUM(j.dr_amt - j.cr_amt)',
            's.id = l.acc_sub_sub_class AND l.group_id = a.ledger_group_id AND a.ledger_id = j.ledger_id AND j.jv_date BETWEEN "'.$cfdate.'" AND "'.$ctdate.'" AND a.acc_class = 4 AND s.id = 4113 GROUP BY l.acc_sub_sub_class');
        $tot_exp_amt2 += $cost_service2;
    }

    $gross_p_l = $tot_sales_amt - $cost_service;
    $gross_p_l2 = $tot_sales_amt2 - $cost_service2;
}

$sql_sub2 = "SELECT s.id, s.sub_class_name 
             FROM acc_sub_class s 
             WHERE s.acc_class = 4 
             GROUP BY s.id";
$query_sub2 = mysql_query($sql_sub2);

while ($info_sub2 = mysql_fetch_object($query_sub2)) {

    $sql2 = "SELECT ss.id, ss.sub_sub_class_name 
             FROM acc_sub_sub_class ss 
             WHERE ss.id IN (417,418)  
             ORDER BY ss.id";
    $query2 = mysql_query($sql2);

    while ($data2 = mysql_fetch_object($query2)) {
        $pi++;
        $sl = $pi;
        $tot_expenses_amt += $expenses_amt[$data2->id];
        $tot_expenses_amt2 += $expenses_amt2[$data2->id];
    }

    $operating_p_l = $gross_p_l - $tot_expenses_amt;
    $operating_p_l2 = $gross_p_l2 - $tot_expenses_amt2;
}

$non_op_income = find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j',
    'SUM(j.cr_amt - j.dr_amt)',
    's.id = l.acc_sub_sub_class AND l.group_id = a.ledger_group_id AND a.ledger_id = j.ledger_id AND j.jv_date BETWEEN "'.$fdate.'" AND "'.$tdate.'" AND a.acc_class = 3 AND s.id = 312 GROUP BY l.acc_sub_sub_class');
$non_op_income2 = find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j',
    'SUM(j.cr_amt - j.dr_amt)',
    's.id = l.acc_sub_sub_class AND l.group_id = a.ledger_group_id AND a.ledger_id = j.ledger_id AND j.jv_date BETWEEN "'.$cfdate.'" AND "'.$ctdate.'" AND a.acc_class = 3 AND s.id = 312 GROUP BY l.acc_sub_sub_class');

$non_op_expense = find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j',
    'SUM(j.dr_amt - j.cr_amt)',
    's.id = l.acc_sub_sub_class AND l.group_id = a.ledger_group_id AND a.ledger_id = j.ledger_id AND j.jv_date BETWEEN "'.$fdate.'" AND "'.$tdate.'" AND a.acc_class = 4 AND s.id = 412 GROUP BY l.acc_sub_sub_class');
$non_op_expense2 = find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j',
    'SUM(j.dr_amt - j.cr_amt)',
    's.id = l.acc_sub_sub_class AND l.group_id = a.ledger_group_id AND a.ledger_id = j.ledger_id AND j.jv_date BETWEEN "'.$cfdate.'" AND "'.$ctdate.'" AND a.acc_class = 4 AND s.id = 412 GROUP BY l.acc_sub_sub_class');

$ebit = $operating_p_l + $non_op_income - $non_op_expense;
$ebit2 = $operating_p_l2 + $non_op_income2 - $non_op_expense2;

$fin_expense = find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j',
    'SUM(j.dr_amt - j.cr_amt)',
    's.id = l.acc_sub_sub_class AND l.group_id = a.ledger_group_id AND a.ledger_id = j.ledger_id AND j.jv_date BETWEEN "'.$fdate.'" AND "'.$tdate.'" AND a.acc_class = 4 AND s.id = 4111 GROUP BY l.acc_sub_sub_class');
$fin_expense2 = find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j',
    'SUM(j.dr_amt - j.cr_amt)',
    's.id = l.acc_sub_sub_class AND l.group_id = a.ledger_group_id AND a.ledger_id = j.ledger_id AND j.jv_date BETWEEN "'.$cfdate.'" AND "'.$ctdate.'" AND a.acc_class = 4 AND s.id = 4111 GROUP BY l.acc_sub_sub_class');

$ebt = $ebit - $fin_expense;
$ebt2 = $ebit2 - $fin_expense2;

$def_tax_expense = find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j',
    'SUM(j.dr_amt - j.cr_amt)',
    's.id = l.acc_sub_sub_class AND l.group_id = a.ledger_group_id AND a.ledger_id = j.ledger_id AND j.jv_date BETWEEN "'.$fdate.'" AND "'.$tdate.'" AND a.acc_class = 4 AND s.id = 4117 GROUP BY l.acc_sub_sub_class');
$def_tax_expense2 = find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j',
    'SUM(j.dr_amt - j.cr_amt)',
    's.id = l.acc_sub_sub_class AND l.group_id = a.ledger_group_id AND a.ledger_id = j.ledger_id AND j.jv_date BETWEEN "'.$cfdate.'" AND "'.$ctdate.'" AND a.acc_class = 4 AND s.id = 4117 GROUP BY l.acc_sub_sub_class');

$current_tax_expense = find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j',
    'SUM(j.dr_amt - j.cr_amt)',
    's.id = l.acc_sub_sub_class AND l.group_id = a.ledger_group_id AND a.ledger_id = j.ledger_id AND j.jv_date BETWEEN "'.$fdate.'" AND "'.$tdate.'" AND a.acc_class = 4 AND s.id = 4116 GROUP BY l.acc_sub_sub_class');
$current_tax_expense2 = find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j',
    'SUM(j.dr_amt - j.cr_amt)',
    's.id = l.acc_sub_sub_class AND l.group_id = a.ledger_group_id AND a.ledger_id = j.ledger_id AND j.jv_date BETWEEN "'.$cfdate.'" AND "'.$ctdate.'" AND a.acc_class = 4 AND s.id = 4116 GROUP BY l.acc_sub_sub_class');

$def_tax_income = find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j',
    'SUM(j.dr_amt - j.cr_amt)',
    's.id = l.acc_sub_sub_class AND l.group_id = a.ledger_group_id AND a.ledger_id = j.ledger_id AND j.jv_date BETWEEN "'.$fdate.'" AND "'.$tdate.'" AND a.acc_class = 3 AND s.id = 313 GROUP BY l.acc_sub_sub_class');
$def_tax_income2 = find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j',
    'SUM(j.dr_amt - j.cr_amt)',
    's.id = l.acc_sub_sub_class AND l.group_id = a.ledger_group_id AND a.ledger_id = j.ledger_id AND j.jv_date BETWEEN "'.$cfdate.'" AND "'.$ctdate.'" AND a.acc_class = 3 AND s.id = 313 GROUP BY l.acc_sub_sub_class');

$def_expense_income = $def_tax_expense + $current_tax_expense - $def_tax_income;
$def_expense_income2 = $def_tax_expense2 + $current_tax_expense2 - $def_tax_income2;

$p_l_after_tax = $ebt - $def_expense_income;
$p_l_after_tax2 = $ebt2 - $def_expense_income2;

 $yearly_income = $p_l_after_tax;
$yearly_income2 = $p_l_after_tax2;

?>										
								
										
<?


 $sql = "select a.acc_class, sum(j.cr_amt-j.dr_amt) as sales_amt 
 from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j 
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date<='".$tdate."' and a.acc_class=3 group by a.acc_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$sales_amt[$data->acc_class]=$data->sales_amt;
}

 $sql = "select a.acc_class, sum(j.cr_amt-j.dr_amt) as sales_amt 
 from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j 
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date <= '".$ctdate."' and a.acc_class=3 group by a.acc_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$sales_amt2[$data->acc_class]=$data->sales_amt;
}

 $sql = "select a.acc_class, sum(j.dr_amt-j.cr_amt) as exp_amt 
from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date<='".$tdate."' and a.acc_class=4 group by a.acc_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$exp_amt[$data->acc_class]=$data->exp_amt;
}

$sql = "select a.acc_class, sum(j.dr_amt-j.cr_amt) as exp_amt 
from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date <= '".$ctdate."' and a.acc_class=4 group by a.acc_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$exp_amt2[$data->acc_class]=$data->exp_amt;
}

$retained_earnings=$sales_amt[3]-$exp_amt[4];
$net_retained_earnings=$retained_earnings;

$retained_earnings2=$sales_amt2[3]-$exp_amt2[4];
$net_retained_earnings2=$retained_earnings2;



$tot_cr_balance = 0;
    $tot_dr_balance = 0;
    $tot_cr_opening = 0;
    $tot_dr_opening = 0;
    $tot_dr_closing = 0;
    $tot_cr_closing = 0;

    $sub_tot_opeing_dr = $sub_tot_opeing_cr = $sub_tot_dr_balance = $sub_tot_cr_balance = $sub_tot_closing_dr = $sub_tot_closing_cr = 0;

    // Fetching opening balances
    $gg = "SELECT SUM(b.dr_amt - b.cr_amt) AS opening, b.ledger_id FROM accounts_ledger a, journal b,ledger_group g WHERE a.ledger_group_id = g.group_id AND g.group_class NOT IN (3000, 4000) and a.ledger_id = b.ledger_id AND b.jv_date < '$fdate' GROUP BY a.ledger_id";
    $ggs = mysql_query($gg);
    while ($gs = mysql_fetch_object($ggs)) {
        $opening_balnace[$gs->ledger_id] = $gs->opening;
    }

    // Fetching debit and credit balances
    $balnce = "SELECT SUM(b.dr_amt) AS debit, SUM(b.cr_amt) AS credit, b.ledger_id FROM accounts_ledger a, journal b WHERE a.ledger_id = b.ledger_id AND b.jv_date BETWEEN '$fdate' AND '$tdate' GROUP BY a.ledger_id";
    $bal_query = mysql_query($balnce);
    while ($bal = mysql_fetch_object($bal_query)) {
        $dr_balnace[$bal->ledger_id] = $bal->debit;
        $cr_balnace[$bal->ledger_id] = $bal->credit;
    }

    
?>

<?php


        $p2 = "SELECT DISTINCT a.ledger_name, a.ledger_id FROM accounts_ledger a, ledger_group g WHERE a.ledger_group_id = g.group_id  AND a.ledger_group_id = 216001 ".$group_con.$sub_con." GROUP BY a.ledger_id ORDER BY a.ledger_name";
        $sql = mysql_query($p2);
        $pi = 1;

        while ($p = mysql_fetch_object($sql)) {
            $dr_opening = $cr_opening = $dr_closing = $cr_closing = 0;

            $closing = ($opening_balnace[$p->ledger_id] + $dr_balnace[$p->ledger_id]) - $cr_balnace[$p->ledger_id];
			
			if($cr_balnace[$p->ledger_id]!=0 || $dr_balnace[$p->ledger_id]!=0 || $closing!=0 )
			{
			
			

?>
			
				
            
                <?php  $opening_balnace[$p->ledger_id] > 0 ? number_format($dr_opening = $opening_balnace[$p->ledger_id], 2) : ''; ?>
                <?php  $opening_balnace[$p->ledger_id] < 0 ? number_format($cr_opening = $opening_balnace[$p->ledger_id] * -1, 2) : ''; ?>
             
                <?php  $closing > 0 ? number_format($dr_closing = $closing, 2) : ''; ?>
                <?php  $closing < 0 ? number_format($cr_closing = $closing * -1, 2) : ''; ?>
            
			<?
			if($p->ledger_id==2160010001){
			
			?>
			 
               <? if($net_retained_earnings<0) { echo $return_opening=$net_retained_earnings+$closing*(-1);} ?>
                <? if($net_retained_earnings>0) { echo $return_opening=$net_retained_earnings+$closing;} ?>
                
                <? if($net_retained_earnings<0) { echo $return_opening2=$net_retained_earnings+$closing*(-1);} ?>
                <? if($net_retained_earnings>0) { echo $return_opening2=$net_retained_earnings+$closing;} ?>
           
			
			
			<?
			}

           // Subtotals for each group
		   
		   	if($p->ledger_id==2160010001 && $net_retained_earnings<0)
			{
            $tot_dr_opening += $dr_opening-$net_retained_earnings;
			}
			else
			{
			$tot_dr_opening += $dr_opening;
			}
			
			if($p->ledger_id==2160010001 && $net_retained_earnings>0)
			{
			
            $tot_cr_opening += $cr_opening-$net_retained_earnings;
			
			}
			else
			{
			
			$tot_cr_opening += $cr_opening;
			}
            $tot_dr_balance += $dr_balnace[$p->ledger_id];
            $tot_cr_balance += $cr_balnace[$p->ledger_id];
			
			if($p->ledger_id==2160010001 && $net_retained_earnings<0)
			{
			
            $tot_dr_closing += $dr_closing-$net_retained_earnings;
			}
			else
			{
			$tot_dr_closing += $dr_closing;
			
			}
			
			if($p->ledger_id==2160010001 && $net_retained_earnings>0)
			{
            $tot_cr_closing += $cr_closing-$net_retained_earnings;
			}
			else
			{
			
			$tot_cr_closing += $cr_closing;
			}
			
			}
        }
		
	
echo $sql_sub1 = "SELECT s.id, s.sub_sub_class_name, s.notes 
             FROM acc_sub_sub_class s
             JOIN accounts_notes n ON s.notes = n.id
             WHERE s.acc_class != 4 AND s.notes IN (10)
             ORDER BY n.order_no ASC";
$query_sub1 = mysql_query($sql_sub1);

while ($info_sub1 = mysql_fetch_object($query_sub1)) {

    $sql1 = "SELECT ledger_id, ledger_name 
             FROM accounts_ledger 
             WHERE acc_sub_sub_class='" . $info_sub1->id . "' 
             ORDER BY ledger_id";
    $query1 = mysql_query($sql1);

    $tot_asset_amt123  = 0;
    $tot_asset_amt1232 = 0;
    $ledger_rows = [];

    while ($data1 = mysql_fetch_object($query1)) {
        $val1 = isset($asset_amt10[$data1->ledger_id]) ? $asset_amt10[$data1->ledger_id] : 0;
        $val2 = isset($asset_amt210[$data1->ledger_id]) ? $asset_amt210[$data1->ledger_id] : 0;

        if ($return_opening != 0) {
             $tot_asset_amt123  += $return_opening;
            $tot_asset_amt1232 += $return_opening2;
            ?>
            
                <? number_format(round(abs($return_opening))) ?>
                <? number_format(round(abs($return_opening))) ?>
           
            <?php
        }
    }
    ?>
    
        <?= number_format(round(abs($yearly_income))) ?>
      <?= number_format(round(abs($yearly_income2))) ?>
   

    <?php if ($tot_asset_amt123 != 0 || $tot_asset_amt1232 != 0) { ?>
       
           
           
            
           
       

        <?php
        $tot_asset_amt1231  = $tot_asset_amt123+$yearly_income;
	  
        $tot_asset_amt12322 = $tot_asset_amt1232+ $yearly_income2;
        ?>

        
        <? number_format(round(abs($tot_asset_amt1231))) ;
			number_format(round(abs($tot_asset_amt12322))); ?>
			
			
       
        <?php
        $grand_total123  += $tot_asset_amt123;
        $grand_total1232333 += $tot_asset_amt1232;
    }
}




	   
  $sql_sub2="select s.id, s.sub_class_name from acc_sub_class s where s.acc_class=2 and s.id=21
group by s.id";
$query_sub2=mysql_query($sql_sub2);

while($info_sub2=mysql_fetch_object($query_sub2)){ 
	   
	   
	   ?>
<?php


$sql2="select ss.id, ss.sub_sub_class_name from acc_sub_sub_class ss where ss.acc_sub_class='".$info_sub2->id."' and ss.id!=211  order by ss.id";

$query2=mysql_query($sql2);

while($data2=mysql_fetch_object($query2)){ 
$pi++;
$sl=$pi;
?>


									  
									  
		 <? number_format($liability_amt[$data2->id],2); $tot_equity_amt +=$liability_amt[$data2->id];?>
									
									  
									  
									  
									  
									  
									  
<? }

$paid_up_capital=find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j','sum(j.dr_amt-j.cr_amt)','s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and j.jv_date<="'.$tdate.'" and l.group_id=211002');  

$paid_up_capital2=find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j','sum(j.dr_amt-j.cr_amt)','s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and j.jv_date<="'.$ctdate.'" and l.group_id=211002');  
$equity_amt=$tot_equity_amt-$yearly_income-$paid_up_capital;




$equity_amt4=$tot_equity_amt-$yearly_income2-$paid_up_capital2;


?>	

<?php


$sql2="select ss.id, ss.sub_sub_class_name from acc_sub_sub_class ss where ss.acc_sub_class='".$info_sub2->id."' and ss.id!=211   order by ss.id";

$query2=mysql_query($sql2);

while($data2=mysql_fetch_object($query2)){ 
$pi++;
$sl=$pi;
?>


									  
									  
		 <? number_format($liability_amt2[$data2->id],2); $equity_amt2 +=$liability_amt2[$data2->id];?>
									
									  
									  
									  
									  
									  
									  
<? }?>

<tr>
									
										<tr>

										  <td bgcolor="#D8BFD8">&nbsp; <strong>Shareholders <?=$info_sub2->sub_class_name;?></strong></td>

										  <td bgcolor="#D8BFD8">&nbsp;</td>
										  <td bgcolor="#D8BFD8" align="right"><? echo ($equity_amt > 0) ? number_format($equity_amt, 2) : '(' . number_format($equity_amt * -1, 2) . ')';
?></td>  <td bgcolor="#D8BFD8" align="right" <?php echo $show_compa;?>><? echo ($equity_amt4 > 0) ? number_format($equity_amt4, 2) : '(' . number_format($equity_amt4 * -1, 2) . ')';
?></td>
									  </tr>
									  
									  <tr>

										  <td style="font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Share Captial</td>

										   <td align="center"></td>
										  <td align="right">
										  
		 
		 </td>
		 <td align="right" <?php echo $show_compa;?>>
										  
		
		 <? //=number_format($liability_amt2[$data2->id],2); ?></td>
									  </tr>
									  
									  
									  <tr>

										  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Authorized Capital</td>

										  <td align="right">&nbsp;</td>
										  <td align="right" style=" position: relative; text-decoration: underline; text-decoration-thickness: 1px; text-underline-offset: 1px; padding-bottom: 1px;" >
										  
		 
		 <?=number_format(100000000,2); ?></td>
		 <td align="right" <?php echo $show_compa;?>>
										  
		 
		 <?=number_format(100000000,2); ?></td>
									  </tr>
									  
									  <tr>

										  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Paid Up Capital</td>

										  <td align="center">NOTE-9.00</td>
										  <td align="right">
										  
		 
		 <? echo ($paid_up_capital>0)?number_format($paid_up_capital,2):''.number_format($paid_up_capital*(-1),2).''   ?></td>
		 <td align="right" <?php echo $show_compa;?>>
										  
		 
		 <? echo ($paid_up_capital2>0)?number_format($paid_up_capital2,2):''.number_format($paid_up_capital2*(-1),2).''   ?></td>
									  </tr>
									  

<?php


$sql2="select ss.id, ss.sub_sub_class_name,ss.notes from acc_sub_sub_class ss where ss.acc_sub_class='".$info_sub2->id."'  and ss.id not in(211,216) order by ss.id";

$query2=mysql_query($sql2);

while($data2=mysql_fetch_object($query2)){ 
$pi++;
$sl=$pi;

		
?>

									
									  
									  
									  <tr>

										  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$data2->sub_sub_class_name;?></td>

										  <td align="center"><a href="financial_statement_notes.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&cfdate=<?=$_REQUEST['cfdate']?>&ctdate=<?=$_REQUEST['ctdate']?>" target="_blank"><?=find_a_field('accounts_notes','name','id='.$data2->notes);?></a></td>
										  <td align="right">
										  
		 <a href="financial_transaction_group_closing.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&acc_sub_sub_class=<?=$data2->id?>" target="_blank">
		 <?  echo ($liability_amt[$data2->id]>0)?number_format($liability_amt[$data2->id],2):'('.number_format($liability_amt[$data2->id]*(-1),2).')'; ?></a></td>
		 <td align="right" <?php echo $show_compa;?>>
										  
		 <a href="financial_transaction_group_closing.php?show=show&fdate=<?=$_REQUEST['cfdate']?>&tdate=<?=$_REQUEST['ctdate']?>&acc_sub_sub_class=<?=$data2->id?>" target="_blank">
		 <?=number_format($liability_amt2[$data2->id],2); ?></a></td>
									  </tr>
									  
									  
									  
									  
									  
									  
									  
									  
<? }?>	




	
	<?php


$sql2="select ss.id, ss.sub_sub_class_name,ss.notes from acc_sub_sub_class ss where ss.acc_sub_class='".$info_sub2->id."'  and ss.id  in(216) order by ss.id";

$query2=mysql_query($sql2);

while($data2=mysql_fetch_object($query2)){ 
$pi++;
$sl=$pi;

		
?>

									
									  
									  
									  <tr>

										  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$data2->sub_sub_class_name;?></td>

										  <td align="center"><a href="financial_statement_notes.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&cfdate=<?=$_REQUEST['cfdate']?>&ctdate=<?=$_REQUEST['ctdate']?>" target="_blank"><?=find_a_field('accounts_notes','name','id='.$data2->notes);?></a></td>
										  <td align="right">
										  
		 <a href="financial_transaction_group_closing.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&acc_sub_sub_class=<?=$data2->id?>" target="_blank">
		 <? //$tot_retian=$liability_amt[$data2->id]-$yearly_income;
		  $tot_retian=$grand_total123; echo ($tot_retian>0)?number_format(round($tot_retian,0),0):'('.number_format(round($tot_retian*(-1),0),0).')'; ?></a></td>
		 <td align="right" <?php echo $show_compa;?>>
										  
		 <a href="financial_transaction_group_closing.php?show=show&fdate=<?=$_REQUEST['cfdate']?>&tdate=<?=$_REQUEST['ctdate']?>&acc_sub_sub_class=<?=$data2->id?>" target="_blank">
		 <? //$tot_retian2=$liability_amt2[$data2->id]-$yearly_income2; 
		 $tot_retian2=$grand_total1232; 
		 echo ($tot_retian2>0)?number_format(round($tot_retian2,0),0):'('.number_format(round($tot_retian2*(-1),0),0).')';  ?></a></td>
									  </tr>
									  
									  
									  
									  
									  
									  
									  
									  
<? }?>	
								  
									  
<tr>

										  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

										  <td align="right">&nbsp;</td>
										  <td align="right">
										  
		 <a href="financial_changes_equity.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>" target="_blank">
		<? //=($net_retained_earnings>0)?number_format($net_retained_earnings,2):'('.number_format($net_retained_earnings*(-1),2).')';?>	</a></td>
		
		<td align="right" <?php echo $show_compa;?>>
										  
		 <a href="financial_changes_equity.php?show=show&fdate=<?=$_REQUEST['cfdate']?>&tdate=<?=$_REQUEST['ctdate']?>" target="_blank">
		<? //=($net_retained_earnings2>0)?number_format($net_retained_earnings2,2):'('.number_format($net_retained_earnings2*(-1),2).')';?>	</a></td>
									  </tr>

 						<tr>

										  <td align="center"><strong></strong></td>

										  <td align="right">&nbsp;</td>
										  <td align="right"><strong>
									      
										  </strong></td>
										  <td align="right" <?php echo $show_compa;?>><strong>
									      
										  </strong></td>
 						</tr>


							  
		<? }?>
		
		
		<?
	   
  $sql_sub3="select s.id, s.sub_class_name from acc_sub_class s where s.acc_class=2 and s.id=23
group by s.id";
$query_sub3=mysql_query($sql_sub3);

while($info_sub3=mysql_fetch_object($query_sub3)){ 
	   
	   
	   ?>


<?php


$sql3="select ss.id, ss.sub_sub_class_name from acc_sub_sub_class ss where ss.id in (231,232)  order by ss.id";

$query3=mysql_query($sql3);

while($data3=mysql_fetch_object($query3)){ 
$pi++;
$sl=$pi;
?>


									  
									  
		 <? number_format($liability_amt[$data3->id],2); $tot_liability_amt2 +=$liability_amt[$data3->id];?>
									 
									  
									  
<? }?>	

<?php


$sql3="select ss.id, ss.sub_sub_class_name from acc_sub_sub_class ss where ss.id in (231,232)  order by ss.id";

$query3=mysql_query($sql3);

while($data3=mysql_fetch_object($query3)){ 
$pi++;
$sl=$pi;
?>


									  
									  
		 <? number_format($liability_amt2[$data3->id],2); $tot_liability_amt22 +=$liability_amt2[$data3->id];?>
									 
									  
									  
<? }?>	
									
										<tr>

										  <td bgcolor="#D8BFD8">&nbsp; <strong><?=$info_sub3->sub_class_name;?></strong></td>

										  <td bgcolor="#D8BFD8">&nbsp;</td>
										  <td bgcolor="#D8BFD8" align="right"><? echo ($tot_liability_amt2 > 0) ? number_format($tot_liability_amt2, 2) : '(' . number_format($tot_liability_amt2 * -1, 2) . ')';
?></td>
<td bgcolor="#D8BFD8" align="right" <?php echo $show_compa;?>><? echo ($tot_liability_amt22 > 0) ? number_format($tot_liability_amt22, 2) : '(' . number_format($tot_liability_amt22 * -1, 2) . ')';
?></td>
									  </tr>
									  
									  

<?php


$sql3="select ss.id, ss.sub_sub_class_name,ss.notes from acc_sub_sub_class ss where ss.id in (231,232)  order by ss.id";

$query3=mysql_query($sql3);

while($data3=mysql_fetch_object($query3)){ 
$pi++;
$sl=$pi;
?>


									  
									  
									  <tr>

										  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$data3->sub_sub_class_name;?></td>

										  <td align="center"><a href="financial_statement_notes.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&cfdate=<?=$_REQUEST['cfdate']?>&ctdate=<?=$_REQUEST['ctdate']?>" target="_blank"><?=find_a_field('accounts_notes','name','id='.$data3->notes);?></a></td>
										  <td align="right">
										  
		 <a href="financial_transaction_group_closing.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&acc_sub_sub_class=<?=$data3->id?>" target="_blank">
		 <?=number_format($liability_amt[$data3->id],2); ?></a></td>
		 <td align="right" <?php echo $show_compa;?>>
										  
		 <a href="financial_transaction_group_closing.php?show=show&fdate=<?=$_REQUEST['cfdate']?>&tdate=<?=$_REQUEST['ctdate']?>&acc_sub_sub_class=<?=$data3->id?>" target="_blank">
		 <?=number_format($liability_amt2[$data3->id],2); ?></a></td>
									  </tr>
									  
									  
									  
<? }?>	

 						<tr>

										  <td align="center"><strong></strong></td>

										  <td align="right">&nbsp;</td>
										  <td align="right"><strong>
									      
										  </strong></td>
										  <td align="right" <?php echo $show_compa;?>><strong>
									      
										  </strong></td>
 						</tr>


							  
		<? 
		//$tot_liability_amt=0;
		}?>
		
		
		
		
		
		<?
	   
  $sql_sub3="select s.id, s.sub_class_name from acc_sub_class s where s.acc_class=2 and s.id=22
group by s.id";
$query_sub3=mysql_query($sql_sub3);

while($info_sub3=mysql_fetch_object($query_sub3)){ 
	   
	   
	   ?>

			
			<?php


$sql3="select ss.id, ss.sub_sub_class_name from acc_sub_sub_class ss where ss.id in (2229,221,222,226,2217,223)  order by ss.id";

$query3=mysql_query($sql3);

while($data3=mysql_fetch_object($query3)){ 
$pi++;
$sl=$pi;
	
?>


							  
									  
									  
		 <? number_format($liability_amt[$data3->id],2); $tot_liability_current +=$liability_amt[$data3->id]  ?>
									 
									  
									  
									  
<? }

$tot_liability_cur=$tot_liability_current+$tot_cr_closing124+$tot_cr_closing125;		
?>		
<?php


$sql3="select ss.id, ss.sub_sub_class_name from acc_sub_sub_class ss where ss.id in (2229,221,222,226,2217,223)  order by ss.id";

$query3=mysql_query($sql3);

while($data3=mysql_fetch_object($query3)){ 
$pi++;
$sl=$pi;
?>


									  
									  
									  
		 <? number_format($liability_amt2[$data3->id],2); $tot_liability_current2 +=$liability_amt2[$data3->id] ; //$tot_liability_cur2 +=$liability_amt2[$data3->id]+$tot_cr_closing2;?>
									  
									  
									  
									  
<? }
$tot_liability_cur2=$tot_liability_current2+$tot_cr_closing1244+$tot_cr_closing1255;	
?>							
										<tr>

										  <td bgcolor="#D8BFD8">&nbsp; <strong><?=$info_sub3->sub_class_name;?></strong></td>

										  <td bgcolor="#D8BFD8">&nbsp;</td>
										  <td bgcolor="#D8BFD8" align="right"><? echo ($tot_liability_cur > 0) ? number_format($tot_liability_cur, 2) : '(' . number_format($tot_liability_cur * -1, 2) . ')'; 
?></td>

<td bgcolor="#D8BFD8" align="right" <?php echo $show_compa;?>><? echo ($tot_liability_cur2 > 0) ? number_format($tot_liability_cur2, 2) : '(' . number_format($tot_liability_cur2 * -1, 2) . ')';
?></td>
									  </tr>
									  
									  <tr>

										  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=find_a_field('acc_sub_sub_class','sub_sub_class_name','id=1214');?> Payable </td>
                                          <td align="center"><a href="financial_statement_notes.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&cfdate=<?=$_REQUEST['cfdate']?>&ctdate=<?=$_REQUEST['ctdate']?>" target="_blank"><?
										  $notes=find_all_field('acc_sub_sub_class','*','id=1214');
										  echo find_a_field('accounts_notes','name','id='.$notes->notes);?></a></td>
										  
										  
                                        <td align="right"><a href="financial_transaction_group_closing.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&acc_sub_sub_class=1214" target="_blank">
<?    echo number_format($tot_cr_closing124,2)  ?></a></td>

<td align="right" <?php echo $show_compa;?>><a href="financial_transaction_group_closing.php?show=show&fdate=<?=$_REQUEST['cfdate']?>&tdate=<?=$_REQUEST['ctdate']?>&acc_sub_sub_class=1214" target="_blank"><?=number_format($tot_cr_closing1244,2); ?>
</a></td>
									  </tr>
									  
									  <tr>

										  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=find_a_field('acc_sub_sub_class','sub_sub_class_name','id=225');?> </td>
                                          <td align="center"><a href="financial_statement_notes.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&cfdate=<?=$_REQUEST['cfdate']?>&ctdate=<?=$_REQUEST['ctdate']?>" target="_blank"><?
										  
										  $notes=find_all_field('acc_sub_sub_class','*','id=225');
										  echo find_a_field('accounts_notes','name','id='.$notes->notes);
										  ?></a></td>
										  
										  
                                        <td align="right"><a href="financial_transaction_group_closing.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&acc_sub_sub_class=225" target="_blank">
<?    echo number_format($tot_cr_closing125,2)  ?></a></td>

<td align="right" <?php echo $show_compa;?>><a href="financial_transaction_group_closing.php?show=show&fdate=<?=$_REQUEST['cfdate']?>&tdate=<?=$_REQUEST['ctdate']?>&acc_sub_sub_class=225" target="_blank"><?=number_format($tot_cr_closing1255,2); ?>
</a></td>
									  </tr>

<?php


$sql3="select ss.id, ss.sub_sub_class_name,ss.notes from acc_sub_sub_class ss where ss.id in (2229,221,222,226,2217,223)  order by ss.id";

$query3=mysql_query($sql3);

while($data3=mysql_fetch_object($query3)){ 
$pi++;
$sl=$pi;
?>


									  
									  
									  <tr>

										  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?  if( $data3->sub_sub_class_name=='Accrual & Provisions') { echo 'Liabilities For Expenses';} else { echo $data3->sub_sub_class_name;} ?></td>

										  <td align="center"><a href="financial_statement_notes.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&cfdate=<?=$_REQUEST['cfdate']?>&ctdate=<?=$_REQUEST['ctdate']?>" target="_blank"><?=find_a_field('accounts_notes','name','id='.$data3->notes);?></a></td>
										  <td align="right">
										  
		 <a href="financial_transaction_group_closing.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&acc_sub_sub_class=<?=$data3->id?>" target="_blank">
		 <?  echo number_format($liability_amt[$data3->id],2); ?></a></td>
		 <td align="right" <?php echo $show_compa;?>>
										  
		 <a href="financial_transaction_group_closing.php?show=show&cfdate=<?=$_REQUEST['fdate']?>&ctdate=<?=$_REQUEST['tdate']?>&acc_sub_sub_class=<?=$data3->id?>" target="_blank">
		 <?=number_format($liability_amt2[$data3->id],2); ?></a></td>
									  </tr>
									  
									  
									  
<? }?>	

 						<tr>

										  <td align="center"><strong></strong></td>

										  <td align="right">&nbsp;</td>
										  <td align="right"><strong>
									     
										  </strong></td>
										  <td align="right" <?php echo $show_compa;?>><strong>
									     
										  </strong></td>
 						</tr>


							  
		<? 
		//$tot_liability_amt=0;
		}?>
		
									<tr>

										  <td align="center"><strong>  TOTAL LIABILITIES & SHAREHOLDERS' EQUITY  
:</strong></td>

										  <td align="right">&nbsp;</td>
										  <td align="right"><strong>
									      <?=number_format($total_equity_liabilities=$equity_amt+$tot_liability_amt2+$tot_liability_cur ,2); ?>
										  </strong></td>
										  
										  <td align="right" <?php echo $show_compa;?>><strong>
									      <?=number_format($total_equity_liabilities2=$equity_amt4+$tot_liability_amt22+$tot_liability_cur2 ,2); //echo $equity_amt4.'<br>';echo  $tot_liability_amt22.'<br>'; echo $tot_liability_cur2; ?>
										  </strong></td>
									</tr>
		
		
									
									
									<tr>
									  <td align="center">&nbsp;</td>
									  <td align="right">&nbsp;</td>
									  <td align="right">&nbsp;</td>
									   <td align="right" <?php echo $show_compa;?>>&nbsp;</td>
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
									  	<td colspan="4"> The accounting policies and explanatory notes form an integral part of the Financial Statements.
			
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



</table>



<?



require_once "../../../assets/template/layout.bottom.php";



?>