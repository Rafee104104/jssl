<?php
session_start();
ob_start();
require_once "../../../assets/support/inc.all.php";
$title='Trial Balance';
$proj_id=$_SESSION['proj_id'];
$active='transdetrep';

do_calander('#fdate');
do_calander('#tdate');

create_combobox('group_id');
create_combobox('acc_sub_sub_class');
create_combobox('cc_code');

if($_REQUEST['tdate']!='' )
{
$tdate=$_REQUEST['tdate'];
//fdate-------------------
$fdate=$_REQUEST["fdate"];
$ledger_id=$_REQUEST["ledger_id"];

if(isset($_REQUEST['tdate'])&&$_REQUEST['tdate']!='')
$report_detail.='<br>Period: '.$_REQUEST["fdate"].' to '.$_REQUEST['tdate'];
if(isset($_REQUEST['cc_code'])&&$_REQUEST['cc_code']!='')
$report_detail.='<br>CC Code : '.find_a_field('cost_center','center_name','id='.$_REQUEST["cc_code"]);

$j=0;
for($i=0;$i<strlen($fdate);$i++)
{
if(is_numeric($fdate[$i]))
$time1[$j]=$time1[$j].$fdate[$i];

else $j++;
}

//$fdate=mktime(0,0,0,$time1[1],$time1[0],$time1[2]);

//tdate-------------------


$j=0;
for($i=0;$i<strlen($tdate);$i++)
{
if(is_numeric($tdate[$i]))
$time[$j]=$time[$j].$tdate[$i];
else $j++;
}
//$tdate=mktime(23,59,59,$time[1],$time[0],$time[2]);


}
?>

<script type="text/javascript">

//$(document).ready(function(){
//
//    function formatItem(row) {
//		//return row[0] + " " + row[1] + " ";
//	}
//	function formatResult(row) {
//		return row[0].replace(/(<.+?>)/gi, '');
//	}
//	
//  });
</script>
<!--<script type="text/javascript">
$(document).ready(function(){
	
	$(function() {
		$("#fdate").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});
	});
		$(function() {
		$("#tdate").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});
	});

});
</script>-->
<style type="text/css">


.box_report{
	border:3px solid cadetblue;
	background:aliceblue;
}

</style>







    <div class="form-container_large">

        <form  id="form1" name="form1" method="post" action="">
            <div class="d-flex  justify-content-center">

                <div class="n-form1 fo-short pt-2">
                    <div class="container">
                        <div class="form-group row  m-0 mb-1 pl-3 pr-3">
                            <label for="group_for" class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">From Date :</label>
                            <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0 pr-2">

                                <input name="fdate" type="text" id="fdate" size="12" class="form-control" value="<?php echo $_REQUEST['fdate'];?>" autocomplete="off"/>

                            </div>
                        </div>

                        <div class="form-group row  m-0 mb-1 pl-3 pr-3">
                            <label for="group_for" class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Date To :</label>
                            <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0 pr-2">

                                <input name="tdate" type="text" id="tdate" size="12" class="form-control" value="<?php echo $_REQUEST['tdate'];?>" autocomplete="off"/>


                            </div>
                        </div>
						<div class="form-group row  m-0 mb-1 pl-3 pr-3">
                            <label for="group_for" class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Sub Sub Class :	</label>
                            <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0 pr-2">


                                <select name="acc_sub_sub_class" id="acc_sub_sub_class" class="form-control">
                                    <option></option>
                                    <? foreign_relation('acc_sub_sub_class','id','sub_sub_class_name',$_REQUEST['acc_sub_sub_class'],'1');?>
                                </select>

                            </div>
                        </div>
						

                        <div class="form-group row  m-0 mb-1 pl-3 pr-3">
                            <label for="group_for" class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Ledger Group :	</label>
                            <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0 pr-2">


                                <select name="group_id" id="group_id" class="form-control">
                                    <option></option>
                                    <? foreign_relation('ledger_group','group_id','group_name',$_REQUEST['group_id'],"group_for='".$_SESSION['user']['group']."'");?>
                                </select>

                            </div>
                        </div>
						
						
						
						<div class="form-group row  m-0 mb-1 pl-3 pr-3">
                            <label for="group_for" class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Opening Show :	</label>
                            <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0 pr-2">


                                <select name="opening_show" id="opening_show" class="form-control">
									<option><?=$opening_show?></option>	
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>

                            </div>
                        </div>


                    </div>

                    <div class="n-form-btn-class">
                        <input class="btn1 btn1-bg-submit" name="show" type="submit" id="show" value="Show" />
                    </div>

                </div>

            </div>

        </form>


<p class="#"> <? include('PrintFormat.php');?></p>


<table id="grp"  class="tabledesign table1  table-striped table-bordered table-hover table-sm" id="ExportTable">

                    <thead class="thead1">
                    <tr class="bgc-info">
					<th  style="text-align:center !important;">Code</th>
					<th  style="text-align:center !important;">Ledger Group</th>
					<th colspan="2" style="text-align:center !important;">Opening Balance </th>
					<th colspan="2"  style="text-align:center !important;">Transaction</th>
					<th colspan="2"  style="text-align:center !important;">Closing Balance </th>
				</tr>
				<tr>
					<th colspan="2"  style="text-align:center !important;">Accounts Head</th>
					<th  style="text-align:center !important;">Debit</th>
					<th  style="text-align:center !important;">Credit</th>
					<th  style="text-align:center !important;">Debit</th>
					<th  style="text-align:center !important;">Credit</th>
					<th  style="text-align:center !important;">Debit</th>
					<th style="text-align:center !important;">Credit</th>
				</tr>
                    </thead>
 <?php
if (isset($_REQUEST['show'])) {


if($_POST['group_id']>0)
{

$group_con=" and g.group_id='".$_POST['group_id']."'";

}
if($_POST['acc_sub_sub_class']>0)
{

$sub_con=" and g.acc_sub_sub_class='".$_POST['acc_sub_sub_class']."'";

}
		
		
		//Return Earning 
		
		$sql = "select a.acc_class, sum(j.cr_amt-j.dr_amt) as sales_amt 
 from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j 
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date<'".$fdate."' and a.acc_class=3 group by a.acc_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
 $sales_amt[$data->acc_class]=$data->sales_amt;
}

 $sql = "select a.acc_class, sum(j.dr_amt-j.cr_amt) as exp_amt 
from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date<'".$fdate."' and a.acc_class=4 group by a.acc_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
 $exp_amt[$data->acc_class]=$data->exp_amt;
}


$retained_earnings=$sales_amt[3]-$exp_amt[4];
 $net_retained_earnings=$retained_earnings;


///end return Earning
		

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

    // Fetching ledger groups
    $g = "SELECT g.group_name, g.group_id FROM accounts_ledger l, ledger_group g,journal j WHERE j.ledger_id=l.ledger_id and l.ledger_group_id = g.group_id ".$group_con.$sub_con."  GROUP BY g.group_id order by g.group_name asc";
    $gsql = mysql_query($g);

    while ($group = mysql_fetch_row($gsql)) {
        $tot_cr_balance = $tot_dr_balance = $tot_cr_opening = $tot_dr_opening = $tot_dr_closing = $tot_cr_closing = 0;
?>
        <tr>
            <th colspan="8" align="left"><?php echo $group[0]; ?></th>
        </tr>
<?php
        $p2 = "SELECT DISTINCT a.ledger_name, a.ledger_id FROM accounts_ledger a, ledger_group g WHERE a.ledger_group_id = g.group_id  AND a.ledger_group_id = '$group[1]' ".$group_con.$sub_con." GROUP BY a.ledger_id ORDER BY a.ledger_name";
        $sql = mysql_query($p2);
        $pi = 1;

        while ($p = mysql_fetch_object($sql)) {
            $dr_opening = $cr_opening = $dr_closing = $cr_closing = 0;

            $closing = ($opening_balnace[$p->ledger_id] + $dr_balnace[$p->ledger_id]) - $cr_balnace[$p->ledger_id];
			
			if($cr_balnace[$p->ledger_id]!=0 || $dr_balnace[$p->ledger_id]!=0 || $closing!=0 )
			{
			
			

?>
			
				
            <tr <?php echo $pi % 2 == 0 ? 'class="alt"' : ''; ?>>
                <td align="center"><?php echo $pi++; ?></td>
                <td align="left"><?php echo $p->ledger_name; ?></td>
                <td align="right"><?php echo $opening_balnace[$p->ledger_id] > 0 ? number_format($dr_opening = $opening_balnace[$p->ledger_id], 2) : ''; ?></td>
                <td align="right"><?php echo $opening_balnace[$p->ledger_id] < 0 ? number_format($cr_opening = $opening_balnace[$p->ledger_id] * -1, 2) : ''; ?></td>
                <td align="right"><?php echo number_format($dr_balnace[$p->ledger_id], 2); ?></td>
                <td align="right"><?php echo number_format($cr_balnace[$p->ledger_id], 2); ?></td>
                <td align="right"><?php echo $closing > 0 ? number_format($dr_closing = $closing, 2) : ''; ?></td>
                <td align="right"><?php echo $closing < 0 ? number_format($cr_closing = $closing * -1, 2) : ''; ?></td>
            </tr>
			<?
			if($p->ledger_id==2160010001){
			
			?>
			 <tr>
                <td align="center"></td>
                <td align="left">Retained Earnings (Previous Profit/(Loss))</td>
                <td align="right"><? if($net_retained_earnings<0) { echo $net_retained_earnings*(-1);} ?></td>
                <td align="right"><? if($net_retained_earnings>0) { echo $net_retained_earnings;} ?></td>
                <td align="right"></td>
                <td align="right"></td>
                <td align="right"><? if($net_retained_earnings<0) { echo $net_retained_earnings*(-1);} ?></td>
                <td align="right"><? if($net_retained_earnings>0) { echo $net_retained_earnings;} ?></td>
            </tr>
			
			
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
?>
        <tr>
            <th  align="right"></th>
			<th align="right"><strong><?php echo number_format(($tot_dr_balance-$tot_cr_balance),2); ?></strong></th>
			
			<th align="right"><strong><?php echo number_format($tot_dr_opening, 2); ?></strong></th>
			
			
			<th align="right"><strong><?php  if($tot_cr_opening<0) { echo number_format($tot_cr_opening*(-1), 2); }else { echo number_format($tot_cr_opening, 2); } ?></strong></th>
			
            <th align="right"><strong><?php echo number_format($tot_dr_balance, 2); ?></strong></th>
            <th align="right"><strong><?php echo number_format($tot_cr_balance, 2); ?></strong></th>
            <th align="right"><strong><?php echo number_format($tot_dr_closing, 2); ?></strong></th>
            <th align="right"><strong><?php if($tot_cr_closing<0) { echo number_format($tot_cr_closing*(-1), 2); }else { echo number_format($tot_cr_closing, 2); }  ?></strong></th>
        </tr>
<?php
        // Grand totals
        $sub_tot_opeing_dr += $tot_dr_opening;
        $sub_tot_opeing_cr += $tot_cr_opening;
        $sub_tot_dr_balance += $tot_dr_balance;
        $sub_tot_cr_balance += $tot_cr_balance;
        $sub_tot_closing_dr += $tot_dr_closing;
        $sub_tot_closing_cr += $tot_cr_closing;
    }
?>
    <tr>
        <th align="right">Total Balance:</th>
		<th align="right"><strong><?php echo number_format(($sub_tot_dr_balance-$sub_tot_cr_balance), 2); ?></strong></th>
        <th align="right"><strong><?php echo number_format($sub_tot_opeing_dr, 2); ?></strong></th>
        <th align="right"><strong><?php echo number_format($sub_tot_opeing_cr, 2); ?></strong></th>
        <th align="right"><strong><?php echo number_format($sub_tot_dr_balance, 2); ?></strong></th>
        <th align="right"><strong><?php echo number_format($sub_tot_cr_balance, 2); ?></strong></th>
        <th align="right"><strong><?php echo number_format($sub_tot_closing_dr, 2); ?></strong></th>
        <th align="right"><strong><?php echo number_format($sub_tot_closing_cr, 2); ?></strong></th>
    </tr>
<?php


}
?>

</table>



    </div>



<?php/*>
    <br>
<br>
<br>
<br>
<br>



<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div class="left_report">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
								    <td><div class="box_report"><form id="form1" name="form1" method="post" action="">
									<table width="100%" border="0" cellspacing="2" cellpadding="0">
                                      <tr>

                                        <td width="14%" align="right">

		    Period :                                       </td>

                                        <td width="15%" align="left">
                                          <input name="fdate" type="text" id="fdate" size="12" style="max-width:250px;" class="form-control" value="<?php echo $_REQUEST['fdate'];?>" />                                        </td>

                                          <td width="11%" align="left"><div align="center">-----</div></td>
									    <td width="49%" align="left">

                                            
                                              <input name="tdate" type="text" id="tdate" size="12" style="max-width:250px;" class="form-control" value="<?php echo $_REQUEST['tdate'];?>"/>                                       </td>
                                      </tr>
									  
									  
									   
									  
//									  <tr>
//                                         <td height="35" align="right">Accounts Class  : </td>
//                                         <td colspan="2" align="left">
//                                           <select name="group_class" id="group_class">
//										   <option></option>
//                                             <? foreign_relation('ledger_group_class','group_class','ledger_group_class',$_REQUEST['group_class'],"1");?>
//                                           </select>                                         </td>
//                                         <td align="left">&nbsp;</td>
//                                       </tr>
									  
									  <tr>
                                         <td align="right">&nbsp;</td>
                                         <td align="left">&nbsp;</td>
                                         <td align="left">&nbsp;</td>
                                         <td align="left">&nbsp;</td>
                                       </tr>
									  
                                       <tr>
                                         <td height="35" align="right">Ledger Group : </td>
                                         <td colspan="2" align="left">

                                           <select name="group_id" id="group_id" class="form-control">
										   <option></option>
                                             <? foreign_relation('ledger_group','group_id','group_name',$_REQUEST['group_id'],"1");?>
                                           </select>

                                         </td>
                                         <td align="left">&nbsp;</td>
                                       </tr>
                                       <tr>
                                         <td align="right">&nbsp;</td>
                                         <td align="left">&nbsp;</td>
                                         <td align="left">&nbsp;</td>
                                         <td align="left">&nbsp;</td>
                                       </tr>

//                                       <tr>
//                                        <td align="right">Cost Center : </td>
//                                        <td colspan="2" align="left">
//
//										<select name="cc_code" id="cc_code" class="form-control" style="float:left"  >
//
//											<option value="0"></option>
//
//											<?
//
//											foreign_relation('cost_center','id','center_name',$_REQUEST['cc_code'],"1  order by id");
//
//											?>
//										</select>										</td>
//                                        <td align="left">&nbsp;</td>
//                                      </tr>
									  
									  <tr>
                                         <td align="right">&nbsp;</td>
                                         <td align="left">&nbsp;</td>
                                         <td align="left">&nbsp;</td>
                                         <td align="left">&nbsp;</td>
                                       </tr>
                                      
                                      <tr>
                                        <td align="center">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td align="center"><input class="btn1 btn1-bg-submit" name="show" type="submit" id="show" value="Show" /></td>
                                      </tr>
                                    </table>
								    </form>
                                        </div></td>
						      </tr>
								  <tr>
									<td align="right"><? include('PrintFormat.php');?></td>
								  </tr>
								  <tr>

									<td>

                                        <div id="reporting">
									<table id="grp"  class="tabledesign" width="100%" cellspacing="0" cellpadding="2" border="0">
							  <tr>
    <th width="3%" align="center">Code</th>
    <th width="35%" height="20" align="center">Ledger Group </th>
    <th width="8%" align="center">Side</th>
    <th width="12%" align="center">Opening</th>
    <th width="11%" align="center">Debit </th>
    <th width="11%" align="center">Credit </th>
    <th width="11%" height="20" align="center">Closing</th>
    <th width="6%" align="center">Side</th>
							  </tr>
  <?php
if($_REQUEST['fdate']!='' )
{

if($_REQUEST['group_id']>0 )
$grp_con = " and  c.group_id='".$_REQUEST['group_id']."'";

if($_REQUEST['group_class']>0 )
$group_class_con = " and  c.group_class='".$_REQUEST['group_class']."'";



	$total_dr=0;
	$total_cr=0;
	if($_REQUEST['cc_code']>0){
	$cc_code = $_REQUEST['cc_code'];
	$cc_con = " and b.cc_code = '".$cc_code."'";
	}
	
   $g="select a.ledger_id, c.group_id,c.group_name,a.ledger_name 
  FROM accounts_ledger a, ledger_group c 
  where a.ledger_group_id=c.group_id ".$grp_con.$group_class_con."  ";

  $gsql=mysql_query($g);
  while($ledger=mysql_fetch_row($gsql))
  {
  	$data[$ledger->ledger_id]['ledger_id'] = $ledger->ledger_id;
	$data[$ledger->ledger_id]['ledger_name'] = $ledger->ledger_name;
	$group[$ledger->ledger_id]['group_id'] = $ledger->group_id;
  	$group[$ledger->ledger_id]['group_name'] =  $ledger->group_name;
  }
	
  $g="select a.ledger_id,c.group_id,SUM(dr_amt) dr_amt,SUM(cr_amt) cr_amt
  FROM accounts_ledger a, journal b,ledger_group c 
  where a.ledger_id=b.ledger_id and a.ledger_group_id=c.group_id and b.jv_date < '$fdate' ".$grp_con.$cc_con.$group_class_con."   group by a.ledger_id ";

  $gsql=mysql_query($g);
  while($open=mysql_fetch_object($gsql))
  {
  	$cr_open[$open->ledger_id] = $open->cr_amt;
  	$dr_open[$open->ledger_id] = $open->dr_amt;
  }
	
   $g="select a.ledger_id,SUM(dr_amt) dr_amt,SUM(cr_amt) cr_amt,c.group_id 
  FROM accounts_ledger a, journal b,ledger_group c 
  where a.ledger_id=b.ledger_id and a.ledger_group_id=c.group_id and b.jv_date BETWEEN '$fdate' AND '$tdate' ".$grp_con.$cc_con.$group_class_con." group by ledger_id ";


  $gsql=mysql_query($g);
  while($info=mysql_fetch_object($gsql))
  {
  	$cr_amt[$info->ledger_id] = $info->cr_amt;
  	$dr_amt[$info->ledger_id] = $info->dr_amt;
  }
  
  $g="select c.group_name,c.group_id FROM ledger_group c where 1 ".$grp_con.$group_class_con."   group by  c.group_id";
  $gsql=mysql_query($g);
  while($g=mysql_fetch_row($gsql))
  {

  ?>
  <tr>
    <th colspan="8" align="left"><?php echo $g[0];?></th>
    </tr>

<?php
	$cc_code = (int) $_REQUEST['cc_code'];

		$p="select a.ledger_name,a.ledger_id from accounts_ledger a where a.parent=0 and a.ledger_group_id='$g[1]' order by a.ledger_id";

$pi=0;
  $sql=mysql_query($p);
  while($p=mysql_fetch_row($sql))
  {
$dr=$dr_amt[$p[1]];
$cr=$cr_amt[$p[1]];

$opening = $topening = $dr_open[$p[1]] - $cr_open[$p[1]];
$closing = $tclosing = $opening + $dr - $cr;

if($opening>0)
{ $tag='(Dr)';}
elseif($opening<0)
{ $tag='(Cr)'; $opening=$opening*(-1);}

if($closing>0)
{ $tagc='(Dr)';}
elseif($closing<0)
{ $tagc='(Cr)'; $closing=$closing*(-1);}

if($opening<>0 || $closing<>0  || $dr<>0 || $cr<>0){

  ?>
<tr <? $i++; if($i%2==0)$cls=' class="alt"'; else $cls=''; echo $cls;?>>
    <td align="center"><?=$p[1]?></td>
    <td align="left"><a href="transaction_listledger.php?show=show&fdate=<?=$_REQUEST['fdate']?>&tdate=<?=$_REQUEST['tdate']?>&ledger_id=<?=$p[1]?>" target="_blank"><?php echo $p[0];?></a></td>
    <td align="right"><div align="center">
      <? if ($opening>0) {?><?=$tag;?><? }?>
    </div></td>
    <td align="right"><?=number_format($opening,2);?></td>
    <td align="right"><?php echo number_format($dr_amt[$p[1]],2);?></td>
    <td align="right"><?php echo number_format($cr_amt[$p[1]],2);?></td>
    <td align="right"><?=number_format($closing,2);?></td>
    <td align="right"><div align="center">
      <? if ($closing>0) {?><?=$tagc;?><? }?>
    </div></td>
</tr>
  <?php
  $total_dr=$total_dr+$dr;
  $total_cr=$total_cr+$cr;
  $t_dr=$t_dr+$dr;
  $t_cr=$t_cr+$cr;
 // $t_cr=$t_cr+$cr;
  
  $topening_total=$topening_total+$topening;
  $totalopening_total=$totalopening_total+$topening;
  
  $tclosing_total=$tclosing_total+$tclosing;
  $totalclosing_total=$totalclosing_total+$tclosing;
  }
  }
  
  if($topening_total>0)
{ $tag='(Dr)';}
  elseif($topening_total<0)
{ $tag='(Cr)'; $topening_total=$topening_total*(-1);}

  if($tclosing_total>0)
{ $tagc='(Dr)';}
  elseif($tclosing_total<0)
{ $tagc='(Cr)'; $tclosing_total=$tclosing_total*(-1);}



  ?>
  <tr bgcolor="#99CCFF">
    <td colspan="2" align="center" bgcolor="#82D8CF"><strong>Total</strong></td>
    <td align="right" bgcolor="#82D8CF"><div align="center">
      <? if ($topening_total>0) {?><?=$tag;?><? }?>
    </div></td>
    <td align="right" bgcolor="#82D8CF"><strong>
      <?=number_format($topening_total,2);?>
    </strong></td>
    <td align="right" bgcolor="#82D8CF"><strong>
      <?=number_format($t_dr,2);?>
    </strong></td>
    <td align="right" bgcolor="#82D8CF"><strong>
      <?=number_format($t_cr,2);?>
    </strong></td>
    <td align="right" bgcolor="#82D8CF"><strong>
      <?=number_format($tclosing_total,2);?>
    </strong></td>
    <td align="right" bgcolor="#82D8CF"><div align="center"><strong>
     <? if ($tclosing_total>0) {?> <?=$tagc;?> <? }?>
    </strong></div></td>
  </tr>
  <?php 
  $t_dr=0;
  $t_cr=0;
  $topening_total = 0;
  $tclosing_total = 0;
  }
    if($totalopening_total>0)
{ $tag='(Dr)';}
  elseif($totalopening_total<0)
{ $tag='(Cr)'; $totalopening_total=$totalopening_total*(-1);}

  if($totalclosing_total>0)
{ $tagc='(Dr)';}
  elseif($totalclosing_total<0)
{ $tagc='(Cr)'; $totalclosing_total=$totalclosing_total*(-1);}
  ?>
<tr>
    <th colspan="2" align="right">Total Balance : <?php echo number_format(($t_dr-$t_cr),2);?></th>
    <th align="right"><div align="center">
     <? if ($totalopening_total>0) {?> <?=$tag;?> <? }?>
    </div></th>
    <th align="right"><?=number_format($totalopening_total,2);?></th>
    <th align="right"><strong><?php echo number_format($total_dr,2);?></strong></th>
    <th align="right"><strong><?php echo number_format($total_cr,2)?></strong></th>
    <th align="right"><?=number_format($totalclosing_total,2);?></th>
    <th align="right"><div align="center">
      <? if ($totalclosing_total>0) {?><?=$tagc;?><? }?>
    </div></th>
</tr>

<?php }?>
</table> 
									</div>

                                    </td>
								  </tr>
		</table>

							</div></td>
    
  </tr>
</table>


    <*/?>





<?
$main_content=ob_get_contents();
ob_end_clean();
require_once "../../template/main_layout.php";
?>