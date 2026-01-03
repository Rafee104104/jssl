<?php



require_once "../../../assets/template/layout.top.php";







$title='Statement of Changes in Equity	';





do_calander('#fdate');

do_calander('#tdate');

do_calander('#cfdate');

do_calander('#ctdate');

$fdate=$_REQUEST["fdate"];

$tdate=$_REQUEST['tdate'];

$cfdate=$_REQUEST["cfdate"];

$ctdate=$_REQUEST['ctdate'];

if(isset($_REQUEST['tdate'])&&$_REQUEST['tdate']!='')

if(isset($_REQUEST['ctdate'])&&$_REQUEST['ctdate']!='')

$report_detail.='<br>As at '.date("d F' Y",strtotime($fdate));





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
                                        <td width="22%" align="right">From Date: </td>



                                        <td width="23%" align="left"> <div align="right">

                                          <input name="fdate" type="text" id="fdate" size="12" maxlength="12" value="<?php echo $_REQUEST['fdate'];?>" autocomplete="off"/>

                                        </div></td>



                                        <td width="8%" align="left"> <div align="center">To Date: </div></td>

                                        <td width="50%" align="left"><input name="tdate" type="text" id="tdate" size="12" style="max-width:250px;" value="<?php echo $_REQUEST['tdate'];?>" autocomplete="off"/></td>

                                      </tr>
									  
									  <tr>
                                        <td width="22%" align="right">Comparative Date: </td>



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



<div id="grp" >

<table  width="100%" border="1" cellspacing="0" cellpadding="0">

										<thead>
										
										<tr>
											<th rowspan="2" bgcolor="#82D8CF" style="text-align:center">&nbsp; Particulars</th>
											<th colspan="4" bgcolor="#82D8CF"  style="text-align:center">&nbsp; Amount In Taka</th>
											</tr>
										  <tr>
											<th  bgcolor="#82D8CF" align="center"><div align="center">Share Capital</div></th>
											<th  bgcolor="#82D8CF" align="center"><div align="center">Retained Earnings</div></th>
											<th  bgcolor="#82D8CF" align="center"><div align="center">Share Memory Deposit</div></th>
											<th  bgcolor="#82D8CF" align="center"><div align="center">Total Equity</div></th>
										  </tr>

										
										</thead>

										

										
										
<?

 $sql = "select s.acc_sub_class, sum(j.cr_amt-j.dr_amt) as opening_sc_amt 
from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date<'".$fdate."' and s.acc_sub_class=21 group by s.acc_sub_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$opening_sc_amt[$data->acc_sub_class]=$data->opening_sc_amt;
}


 $sql = "select a.acc_class, sum(j.cr_amt-j.dr_amt) as sales_ope_amt 
 from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j 
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date<'".$fdate."' and a.acc_class=3 group by a.acc_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$sales_ope_amt[$data->acc_class]=$data->sales_ope_amt;
}

 $sql = "select a.acc_class, sum(j.dr_amt-j.cr_amt) as exp_ope_amt 
from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date<'".$fdate."' and a.acc_class=4 group by a.acc_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$exp_ope_amt[$data->acc_class]=$data->exp_ope_amt;
}




$sql = "select s.acc_sub_class, sum(j.cr_amt-j.dr_amt) as sc_amt 
from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date between '".$fdate."' and '".$tdate."' and s.acc_sub_class=21 group by s.acc_sub_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$sc_amt[$data->acc_sub_class]=$data->sc_amt;
}


 $sql = "select a.acc_class, sum(j.cr_amt-j.dr_amt) as sales_amt 
 from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j 
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date between '".$fdate."' and '".$tdate."' and a.acc_class=3 group by a.acc_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$sales_amt[$data->acc_class]=$data->sales_amt;
}


 $sql = "select a.acc_class, sum(j.dr_amt-j.cr_amt) as exp_amt 
from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date between '".$fdate."' and '".$tdate."' and a.acc_class=4 group by a.acc_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$exp_amt[$data->acc_class]=$data->exp_amt;
}


//$sql = "select l.acc_sub_sub_class, sum(j.dr_amt-j.cr_amt) as expenses_amt from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
// where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date between '".$fdate."' and '".$tdate."' group by l.acc_sub_sub_class";
//$query = mysql_query($sql);
//while($data=mysql_fetch_object($query)){
//$expenses_amt[$data->acc_sub_sub_class]=$data->expenses_amt;
//
//}


 //$opening_sc="SELECT sum(j.cr_amt-j.dr_amt) as opening_sc_amt
// FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j  
// WHERE s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date<'".$fdate."' and s.acc_sub_class=21 group by s.acc_sub_class";
//$opening_sc_amt = find_a_field_sql($opening_sc);

$net_opening_sc_amt=$opening_sc_amt[21];
$net_sales_ope_amt=$sales_ope_amt[3];
$net_exp_ope_amt=$exp_ope_amt[4];
$retained_earnings_ope=$sales_ope_amt[3]-$exp_ope_amt[4];
$net_retained_earnings_ope=$retained_earnings_ope;
$total_equity_ope=$opening_sc_amt[21]+$retained_earnings_ope;
$net_total_equity_ope=$total_equity_ope;


$net_sc_amt=$sc_amt[21];
$retained_earnings=$sales_amt[3]-$exp_amt[4];
$net_retained_earnings=$retained_earnings;
$total_equity=$sc_amt[21]+$retained_earnings;
$net_total_equity=$total_equity;


$grand_sc_amt=$opening_sc_amt[21]+$sc_amt[21];
$grand_retained_earnings=$retained_earnings_ope+$retained_earnings;
$grand_total_equity=$total_equity_ope+$total_equity;

   
	   ?>
			<tr>
					  <td bgcolor="#E0FFFF">&nbsp; Balance as at <strong><?=date("d F' Y",strtotime($fdate))?></strong></td>

										  <td bgcolor="#E0FFFF" align="right">  
	<?=($net_opening_sc_amt>0)?number_format($net_opening_sc_amt,2):'('.number_format($net_opening_sc_amt*(-1),2).')';?>										  </td>
										  <td bgcolor="#E0FFFF" align="right">
    <?=($net_retained_earnings_ope>0)?number_format($net_retained_earnings_ope,2):'('.number_format($net_retained_earnings_ope*(-1),2).')';?>										  </td>
	<td></td>
										  <td bgcolor="#E0FFFF" align="right">
	 <?=($net_total_equity_ope>0)?number_format($net_total_equity_ope,2):'('.number_format($net_total_equity_ope*(-1),2).')';?>										  </td>
			    </tr>
									  
									  
							  
									  
									  <tr>

										  <td>&nbsp;Net Profit/(Loss) for the year</td>
                                          <td align="right">
	<?=($net_sc_amt>0)?number_format($net_sc_amt,2):'('.number_format($net_sc_amt*(-1),2).')';?>										  </td>
                                          <td align="right">
	 <?=($net_retained_earnings>0)?number_format($net_retained_earnings,2):'('.number_format($net_retained_earnings*(-1),2).')';?>										  </td>
	 <td></td>
                                        <td align="right">
    <?=($net_total_equity>0)?number_format($net_total_equity,2):'('.number_format($net_total_equity*(-1),2).')';?></td>
									  </tr>
									  
									  
	

 						<tr>

										  <td align="left">&nbsp;<strong>Balance as at <?=date("d F' Y",strtotime($tdate))?></strong></td>

										  <td align="right"><strong>
			<?=($grand_sc_amt>0)?number_format($grand_sc_amt,2):'('.number_format($grand_sc_amt*(-1),2).')';?>	</strong>										  </td>
										  <td align="right"><strong>
			 <?=($grand_retained_earnings>0)?number_format($grand_retained_earnings,2):'('.number_format($grand_retained_earnings*(-1),2).')';?></strong>										  </td>
										  <td></td><td align="right"><strong>
			<?=($grand_total_equity>0)?number_format($grand_total_equity,2):'('.number_format($grand_total_equity*(-1),2).')';?></strong>										  </td>
			    </tr>


		
									
										

										
										
								
			
										
									  
									  
						</table>

			
			<br /><br /><br />
			
			
			<table    width="100%" border="1" cellspacing="0" cellpadding="0" <?php echo $show_compa;?>>

										<thead>
										
										<tr>
											<th rowspan="2" bgcolor="#82D8CF" style="text-align:center">&nbsp; Particulars</th>
											<th colspan="4" bgcolor="#82D8CF"  style="text-align:center">&nbsp; Amount In Taka</th>
											</tr>
										  <tr>
											<th  bgcolor="#82D8CF" align="center"><div align="center">Share Capital</div></th>
											<th  bgcolor="#82D8CF" align="center"><div align="center">Retained Earnings</div></th>
											<th  bgcolor="#82D8CF" align="center"><div align="center">Share Memory Deposit</div></th>
											<th  bgcolor="#82D8CF" align="center"><div align="center">Total Equity</div></th>
										  </tr>

										
										</thead>

										

										
										
<?

 $sql = "select s.acc_sub_class, sum(j.cr_amt-j.dr_amt) as opening_sc_amt 
from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date<'".$cfdate."' and s.acc_sub_class=21 group by s.acc_sub_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$opening_sc_amt2[$data->acc_sub_class]=$data->opening_sc_amt;
}


 $sql = "select a.acc_class, sum(j.cr_amt-j.dr_amt) as sales_ope_amt 
 from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j 
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date<'".$cfdate."' and a.acc_class=3 group by a.acc_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$sales_ope_amt2[$data->acc_class]=$data->sales_ope_amt;
}

 $sql = "select a.acc_class, sum(j.dr_amt-j.cr_amt) as exp_ope_amt 
from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date<'".$cfdate."' and a.acc_class=4 group by a.acc_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$exp_ope_amt2[$data->acc_class]=$data->exp_ope_amt;
}




$sql = "select s.acc_sub_class, sum(j.cr_amt-j.dr_amt) as sc_amt 
from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date between '".$cfdate."' and '".$ctdate."' and s.acc_sub_class=21 group by s.acc_sub_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$sc_amt2[$data->acc_sub_class]=$data->sc_amt;
}


 $sql = "select a.acc_class, sum(j.cr_amt-j.dr_amt) as sales_amt 
 from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j 
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date between '".$cfdate."' and '".$ctdate."' and a.acc_class=3 group by a.acc_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$sales_amt2[$data->acc_class]=$data->sales_amt;
}


 $sql = "select a.acc_class, sum(j.dr_amt-j.cr_amt) as exp_amt 
from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date between '".$cfdate."' and '".$ctdate."' and a.acc_class=4 group by a.acc_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$exp_amt2[$data->acc_class]=$data->exp_amt;
}


//$sql = "select l.acc_sub_sub_class, sum(j.dr_amt-j.cr_amt) as expenses_amt from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
// where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date between '".$fdate."' and '".$tdate."' group by l.acc_sub_sub_class";
//$query = mysql_query($sql);
//while($data=mysql_fetch_object($query)){
//$expenses_amt[$data->acc_sub_sub_class]=$data->expenses_amt;
//
//}


 //$opening_sc="SELECT sum(j.cr_amt-j.dr_amt) as opening_sc_amt
// FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j  
// WHERE s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date<'".$fdate."' and s.acc_sub_class=21 group by s.acc_sub_class";
//$opening_sc_amt = find_a_field_sql($opening_sc);

$net_opening_sc_amt2=$opening_sc_amt2[21];
$net_sales_ope_amt2=$sales_ope_amt2[3];
$net_exp_ope_amt2=$exp_ope_amt2[4];
$retained_earnings_ope2=$sales_ope_amt2[3]-$exp_ope_amt2[4];
$net_retained_earnings_ope2=$retained_earnings_ope2;
$total_equity_ope2=$opening_sc_amt2[21]+$retained_earnings_ope2;
$net_total_equity_ope2=$total_equity_ope2;


$net_sc_amt2=$sc_amt2[21];
$retained_earnings2=$sales_amt2[3]-$exp_amt2[4];
$net_retained_earnings2=$retained_earnings2;
$total_equity2=$sc_amt2[21]+$retained_earnings2;
$net_total_equity2=$total_equity2;


$grand_sc_amt2=$opening_sc_amt2[21]+$sc_amt2[21];
$grand_retained_earnings2=$retained_earnings_ope2+$retained_earnings2;
$grand_total_equity2=$total_equity_ope2+$total_equity2;

   
	   ?>
			<tr>
					  <td bgcolor="#E0FFFF">&nbsp; Balance as at <strong><?=date("d M, Y",strtotime($cfdate))?></strong></td>

										  <td bgcolor="#E0FFFF" align="right">  
	<?=($net_opening_sc_amt2>0)?number_format($net_opening_sc_amt2,2):'('.number_format($net_opening_sc_amt2*(-1),2).')';?>										  </td>
										  <td bgcolor="#E0FFFF" align="right">
    <?=($net_retained_earnings_ope2>0)?number_format($net_retained_earnings_ope2,2):'('.number_format($net_retained_earnings_ope2*(-1),2).')';?>										  </td>
	<td></td>
										  <td bgcolor="#E0FFFF" align="right">
	 <?=($net_total_equity_ope2>0)?number_format($net_total_equity_ope2,2):'('.number_format($net_total_equity_ope2*(-1),2).')';?>										  </td>
			    </tr>
									  
									  
							  
									  
									  <tr>

										  <td>&nbsp;Net Profit/(Loss) for the year</td>
                                          <td align="right">
	<?=($net_sc_amt2>0)?number_format($net_sc_amt2,2):'('.number_format($net_sc_amt2*(-1),2).')';?>										  </td>
                                          <td align="right">
	 <?=($net_retained_earnings2>0)?number_format($net_retained_earnings2,2):'('.number_format($net_retained_earnings2*(-1),2).')';?>										  </td>
	 <td></td>
                                        <td align="right">
    <?=($net_total_equity2>0)?number_format($net_total_equity2,2):'('.number_format($net_total_equity2*(-1),2).')';?></td>
									  </tr>
									  
									  
	

 						<tr>

										  <td align="left">&nbsp;<strong>Balance as at <?=date("d F' Y",strtotime($ctdate))?></strong></td>

										  <td align="right"><strong>
			<?=($grand_sc_amt2>0)?number_format($grand_sc_amt2,2):'('.number_format($grand_sc_amt2*(-1),2).')';?>	</strong>										  </td>
										  <td align="right"><strong>
			 <?=($grand_retained_earnings2>0)?number_format($grand_retained_earnings2,2):'('.number_format($grand_retained_earnings2*(-1),2).')';?></strong>										  </td>
										  <td></td><td align="right"><strong>
			<?=($grand_total_equity2>0)?number_format($grand_total_equity2,2):'('.number_format($grand_total_equity2*(-1),2).')';?></strong>										  </td>
			    </tr>


		
									
										

										
										
								
			
										
									  
									  
						</table>	
						
						
						
						
						<table width="100%" id="report-view"  cellpadding="0" cellspacing="0">
									  <tr style="border:none">
									  	
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										
									  </tr>
									  
									  <tr style="border:none">
									  	
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										
										
									  </tr>
									  <tr style="border:none">
									  	
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										
									  </tr>
									  <tr style="border:none">
									  	<td>&nbsp;</td>
										<td>&nbsp;</td>
										
									  </tr>
									  <tr style="border:none">
									  	<td>&nbsp;</td>
										<td>&nbsp;</td>
										
									  </tr>
									  <tr style="border:none">
									  	<td>&nbsp;</td>
										<td>&nbsp;</td>
										
									  </tr>
									  <tr style="border:none">
									  	<td>&nbsp;</td>
										<td>&nbsp;</td>
										
									  </tr>
									  <tr style="border:none">
									  	<td>&nbsp;</td>
										<td>&nbsp;</td>
										
									  </tr>
									  <tr style="border:none">
									  	<td style="width:33%; text-align:center;"><strong>-------------------------------</strong></td>
										<td style="width:33%; text-align:center;"><strong>--------------------</strong></td>
										
										
									  </tr>
									  
									  <tr style="border:none">
									  	<td style="width:33%; text-align:center"><strong> Managing Director </strong></td>
										<td style="width:33%; text-align:center;"> <strong>Chairman </strong></td>
										
										
									  </tr>
									 </table>
						
						</div>					

									  
				<? }?>					  
									  



									</div>







									</td>



								</tr>



						</table>


</table>



<?



require_once "../../../assets/template/layout.bottom.php";



?>