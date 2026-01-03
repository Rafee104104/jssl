<?php
session_start();
ob_start();
require_once "../../../assets/support/inc.all.php";

$title='Cost of Goods Sold';


do_calander('#fdate');

do_calander('#tdate');



$fdate=$_REQUEST["fdate"];

$tdate=$_REQUEST['tdate'];



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



                                        <td width="22%" align="right">



		    From Date :                                       </td>



                                        <td width="23%" align="left"> <div align="right">

                                          <input name="fdate" type="text" id="fdate" size="12" maxlength="12" value="<?php echo $_REQUEST['fdate'];?>" autocomplete="off"/>

                                        </div></td>



                                        <td width="8%" align="left"> <div align="center">To Date: </div></td>

                                        <td width="50%" align="left"><input name="tdate" type="text" id="tdate" size="12" style="max-width:250px;" value="<?php echo $_REQUEST['tdate'];?>" autocomplete="off"/></td>

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
?>									<table width="100%" id="grp" border="1" cellspacing="0" cellpadding="0">

										<thead>

										<tr>

											<th width="53%" bgcolor="#82D8CF">&nbsp; Particular</th>

											<th width="23%" bgcolor="#82D8CF">&nbsp; Amount</th>
										    <th width="24%" bgcolor="#82D8CF">Amount</th>
										</tr>
										</thead>

										

										
										
<?


$sql = "select a.ledger_group_id, sum(j.dr_amt-j.cr_amt) as opening_rm 
 from ledger_group l, accounts_ledger a, journal j 
 where l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date<='".$tdate."'  group by a.ledger_group_id";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$opening_rm[$data->ledger_group_id]=$data->opening_rm;
}


$sql = "select a.ledger_group_id, sum(j.dr_amt) as dr_amt 
 from ledger_group l, accounts_ledger a, journal j 
 where l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and j.jv_date between '".$fdate."' and '".$tdate."' group by a.ledger_group_id";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$dr_amt[$data->ledger_group_id]=$data->dr_amt;
}


$sql = "select a.ledger_group_id, sum(j.dr_amt-j.cr_amt) as closing_rm 
 from ledger_group l, accounts_ledger a, journal j 
 where l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date<='".$tdate."' group by a.ledger_group_id";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$closing_rm[$data->ledger_group_id]=$data->closing_rm;
}


	   
	   
	   ?>
									
	<tr>
									  <td bgcolor="#E0FFFF">&nbsp; <strong>Add: Opening Inventory</strong></td>
									  <td bgcolor="#E0FFFF">&nbsp;</td>
				                      <td bgcolor="#E0FFFF">&nbsp;</td>
	</tr>								  
									  

<?php


 $sql="select l.group_id, l.group_name from cogs_configuration c, ledger_group l where c.group_id=l.group_id and c.type='RM' order by l.group_id";

$query=mysql_query($sql);

while($data=mysql_fetch_object($query)){ 
$pi++;
$sl=$pi;
?>


									  
									  
									  <tr>

										  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$data->group_name;?></td>
<td align="right">
<?=number_format($opening_rm[$data->group_id],2); $total_opening_rm+=$opening_rm[$data->group_id];?></td>
									  <td align="right">&nbsp;</td>
									  </tr>
									  
									  
									  
<? }?>	



		<tr>
									  <td bgcolor="#E0FFFF" align="right">&nbsp; <strong>Total </strong></td>
									  <td bgcolor="#E0FFFF" align="right"><strong><?=number_format($total_opening_rm,2); ?></strong></td>
				                      <td bgcolor="#E0FFFF" align="right">&nbsp;</td>
		</tr>		
				  
				  
				  
				  
				  <tr>
									  <td bgcolor="#E0FFFF">&nbsp; <strong>Add: Purchase</strong></td>
									  <td bgcolor="#E0FFFF">&nbsp;</td>
				                      <td bgcolor="#E0FFFF">&nbsp;</td>
				  </tr>								  
									  

<?php


 $sql="select l.group_id, l.group_name from cogs_configuration c, ledger_group l where c.group_id=l.group_id and c.type='RM' order by l.group_id";

$query=mysql_query($sql);

while($data=mysql_fetch_object($query)){ 
$pi++;
$sl=$pi;
?>


									  
									  
									  <tr>

										  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$data->group_name;?></td>
<td align="right">
<?=number_format($dr_amt[$data->group_id],2); $total_purchase_rm+=$dr_amt[$data->group_id];?></td>
									  <td align="right">&nbsp;</td>
									  </tr>
									  
									  
									  
<? }?>	



		<tr>
									  <td bgcolor="#E0FFFF" align="right">&nbsp; <strong>Total </strong></td>
									  <td bgcolor="#E0FFFF" align="right"><strong><?=number_format($total_purchase_rm,2); ?></strong></td>
				                      <td bgcolor="#E0FFFF" align="right">&nbsp;</td>
		</tr>							
									  


 						
						
						 <tr>
									  <td bgcolor="#E0FFFF">&nbsp; <strong>Less: Closing Inventory</strong></td>
									  <td bgcolor="#E0FFFF">&nbsp;</td>
				                      <td bgcolor="#E0FFFF">&nbsp;</td>
				  </tr>								  
									  

<?php


 $sql="select l.group_id, l.group_name from cogs_configuration c, ledger_group l where c.group_id=l.group_id and c.type='RM' order by l.group_id";

$query=mysql_query($sql);

while($data=mysql_fetch_object($query)){ 
$pi++;
$sl=$pi;
?>


									  
									  
									  <tr>

										  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$data->group_name;?></td>
<td align="right">
<?=number_format($closing_rm[$data->group_id],2); $total_closing_rm+=$closing_rm[$data->group_id];?></td>
									  <td align="right">&nbsp;</td>
									  </tr>
									  
									  
									  
<? }?>	



		<tr>
									  <td bgcolor="#E0FFFF" align="right">&nbsp; <strong>Total </strong></td>
									  <td bgcolor="#E0FFFF" align="right"><strong><?=number_format($total_closing_rm,2); ?></strong></td>
				                      <td bgcolor="#E0FFFF" align="right">&nbsp;</td>
		</tr>	
		
		
		
		
		<tr>
									  <td bgcolor="#E0FFFF" align="right"> <strong>Material Cost  </strong></td>
									  <td bgcolor="#E0FFFF" align="right">&nbsp;</td>
				                      <td bgcolor="#E0FFFF" align="right"><strong><?=number_format($material_cost=($total_opening_rm+$total_purchase_rm)-$total_closing_rm,2); ?></strong></td>
		</tr>	
		
		
		
		<tr>
									  <td bgcolor="#E0FFFF">&nbsp; <strong>Add: Factory Overhead</strong></td>
									  <td bgcolor="#E0FFFF">&nbsp;</td>
				                      <td bgcolor="#E0FFFF">&nbsp;</td>
				  </tr>								  
									  

<?php


 $sql="select l.group_id, l.group_name from ledger_group l where l.acc_sub_sub_class=315 order by l.group_id";

$query=mysql_query($sql);

while($data=mysql_fetch_object($query)){ 
$pi++;
$sl=$pi;
?>


									  
									  
									  <tr>

										  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$data->group_name;?></td>
<td align="right">
<?=number_format($dr_amt[$data->group_id],2); $total_factory_overhead+=$dr_amt[$data->group_id];?></td>
									  <td align="right">&nbsp;</td>
									  </tr>
									  
									  
									  
<? }?>	



		<tr>
									  <td bgcolor="#E0FFFF" align="right">&nbsp; <strong>Total </strong></td>
									  <td bgcolor="#E0FFFF" align="right"><strong><?=number_format($total_factory_overhead,2); ?></strong></td>
				                      <td bgcolor="#E0FFFF" align="right">&nbsp;</td>
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