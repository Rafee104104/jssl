<?
session_start();
require_once "../../../assets/support/inc.all.php";
date_default_timezone_set('Asia/Dhaka');

if(isset($_POST['submit'])&&isset($_POST['report'])&&$_POST['report']>0)
{
	if((strlen($_POST['t_date'])==10)&&(strlen($_POST['f_date'])==10))
	{
		$t_date=$_POST['t_date'];
		$f_date=$_POST['f_date'];
	}
	
	if($_POST['by']>0) 			$by=$_POST['by'];
	if($_POST['vendor_id']>0) 	$vendor_id=$_POST['vendor_id'];
	if($_POST['cat_id']>0) 		$cat_id=$_POST['cat_id'];
	if($_POST['item_id']>0) 	$item_id=$_POST['item_id'];
	if($_POST['sub_group_id']>0)$sub_group_id=$_POST['sub_group_id'];
	if($_POST['status']!='') 	$status=$_POST['status'];

switch ($_POST['report']) {
    case 1:
		$report="Purchase Order Report";
		if(isset($by)) 			{$by_con=' and a.entry_by='.$by;}
		if(isset($vendor_id)) 	{$vendor_con=' and a.vendor_id='.$vendor_id;}
		if(isset($sub_group_id)) 		{$sub_group_id=' and e.sub_group_id='.$sub_group_id;}
		if(isset($item_id)) 	{$item_con=' and b.item_id='.$item_id;}
		
		if(isset($status)) 		{$status_con=' and a.status="'.$status.'"';}
		
		if($_POST['warehouse_id']>0)		{$wh_con=' and a.warehouse_id="'.$_POST['warehouse_id'].'"';}
		
if(isset($t_date)) 
{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.po_date between \''.$fr_date.'\' and \''.$to_date.'\'';}

		
		  $sql='select a.po_date,c.vendor_name as vendor_name,a.status,f.fname as entry_by, a.entry_at,a.po_no as po_no,b.id as order_id,d.sub_group_name,e.item_name,b.qty,b.rate,b.amount 
		   
		   from purchase_master a, purchase_invoice b, vendor c, item_sub_group d, item_info e, user_activity_management f 
		   where a.po_no=b.po_no and c.vendor_id=a.vendor_id and d.sub_group_id=e.sub_group_id and b.item_id=e.item_id and f.user_id=a.entry_by and a.status!="MANUAL" '.$date_con.$by_con.$vendor_con.$sub_group_id.$item_con.$status_con.$wh_con.' order by a.po_date,b.id';
	break;
    case 2:
		$report=" Purchase Received report";

		if(isset($by)) 			{$by_con=' and a.entry_by='.$by;}

	

		if(isset($cat_id)) 		{$cat_con=' and d.id='.$cat_id;}

		if(isset($item_id)) 	{$item_con=' and b.item_id='.$item_id;}
		
		if(isset($vendor_id)) 	{$vendor_con=' and a.vendor_id='.$vendor_id;}
		
		if(isset($ctg_warehouse)) 	{$ctg_warehouse_con=' and b.shed_id='.$ctg_warehouse;}

		if(isset($garden_id)) 	{$garden_id_con=' and b.garden_id='.$garden_id;}
		
		if($_POST['warehouse_id']>0)		{$wh_con=' and a.warehouse_id="'.$_POST['warehouse_id'].'"';}

		

		if(isset($status)) 		{$status_con=' and a.status="'.$status.'"';}
		if($_POST['sub_group_id']>0){$sub_con=' and e.sub_group_id="'.$_POST['sub_group_id'].'"';}

		

if(isset($t_date)) 

{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.po_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



		

		 $sql='select a.po_no as po_no, DATE_FORMAT(a.po_date, "%d-%m-%Y") as po_date, r.serial_no, r.pr_no, r.rec_date, r.rec_date,  b.invoice_no as inv_no, e.item_name, r.qty as received,r.rate,r.amount
		
		 from purchase_master a, purchase_invoice b, purchase_receive r, vendor c, item_sub_group d, item_info e, user_activity_management f 
		 
		 where a.po_no=b.po_no and b.id=r.order_no and c.vendor_id=a.vendor_id and d.sub_group_id=e.sub_group_id and b.item_id=e.item_id  and f.user_id=a.entry_by and (a.status="CHECKED" or a.status="COMPLETED") '.$wh_con.$date_con.$by_con.$vendor_con.$cat_con.$item_con.$status_con.$sub_con.$garden_id_con.' order by r.rec_date';
	break;
	
	case 3:
		$report="Chalan Report (Chalan Date Wise)";
		if(isset($by)) 			{$by_con=' and a.prepared_by='.$by;} 
		if(isset($vendor_id)) 	{$vendor_con=' and a.vendor_id='.$vendor_id;} 
		if(isset($cat_id)) 		{$cat_con=' and d.id='.$cat_id;} 
		if(isset($item_id)) 	{$item_con=' and b.item_id='.$item_id;} 
		if(isset($status)) 		{$status_con=' and a.status="'.$status.'"';} 
if(isset($t_date)) 
{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.po_date between \''.$fr_date.'\' and \''.$to_date.'\'';}

		
		  echo $sql='select a.po_date,c.vendor_name as vendor_name,a.status,f.fname as prepared_by, a.prepared_at,a.id as po_no,b.id as order_id,d.category_name,e.item_name,(b.qty*1.00) as qty,b.rate,b.amount,
((select sum(qty) from purchase_master_chalan where b.id=specification_id)*1.00) as chalan_qty, 
((select b.qty-sum(qty) from purchase_master_chalan where b.id=specification_id)) as balance_qty from purchase_master a, 
purchase_invoice b, vendor c, item_sub_group d, item_info e, user_activity_management f where a.id=b.po_no and c.id=a.vendor_id and d.id=e.product_category_id and b.item_id=e.id and f.user_id=a.prepared_by and a.status!="MANUAL" '.$date_con.$by_con.$vendor_con.$cat_con.$item_con.$status_con.' order by a.id,b.id';
	break;
	case 4:
	if($_REQUEST['po_no']>0)
header("Location:work_order_print.php?po_no=".$_REQUEST['po_no']);
	break;
	case 5:
		$report="Purchase History Report";
		if(isset($warehouse_id)) 				{$warehouse_con=' and a.relevant_warehouse='.$warehouse_id;} 
		if(isset($sub_group_id)) 				{$item_sub_con=' and i.sub_group_id='.$sub_group_id;} 
		elseif(isset($item_id)) 				{$item_con=' and a.item_id='.$item_id;} 
		if(isset($vendor_id)) 	{$vendor_con=' and v.vendor_id='.$vendor_id;} 
		$status_con=' and a.tr_from = "Purchase" ';
		
		if(isset($t_date)) 
		{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.ji_date between \''.$fr_date.'\' and \''.$to_date.'\'';}

		
	echo	$sql='select ji_date as GR_Date,a.sr_no as GR_no,pm.po_date,pm.po_no,i.item_name,s.sub_group_name as Category,i.unit_name as unit,a.item_in as `RQ`,a.item_price as rate,((a.item_in+a.item_ex)*a.item_price) as amount,v.vendor_name,a.entry_at,c.fname as User 
		   
		   from journal_item a, item_info i, user_activity_management c , item_sub_group s , purchase_receive pr,purchase_master pm,vendor v
		   where pm.vendor_id=v.vendor_id and c.user_id=a.entry_by and s.sub_group_id=i.sub_group_id and a.item_id=i.item_id and a.warehouse_id="5" and a.tr_no=pr.id and pr.po_no=pm.po_no '.$date_con.$warehouse_con.$item_con.$status_con.$item_sub_con.$vendor_con.' order by a.id';
	break;
}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?=$report?></title>
<link href="../../../assets/css/report.css" type="text/css" rel="stylesheet" />
<script language="javascript">
function hide()
{
document.getElementById('pr').style.display='none';
}
</script>
</head>
<body>
<div align="center" id="pr">
<input type="button" value="Print" onclick="hide();window.print();"/>
</div>
<div class="main">
<?
		$str 	.= '<div class="header" align="center">';
		if(isset($_SESSION['company_name'])) 
		$str 	.= '<h1>'.$_SESSION['company_name'].'</h1>';
		if(isset($report)) 
		$str 	.= '<h2>'.$report.'</h2>';
		if(isset($to_date)) 
		$str 	.= '<h2>'.$fr_date.' To '.$to_date.'</h2>';
		if(isset($vendor_id)) 
		$str 	.= '<h2>Vendor Name: '.find_a_field('vendor','vendor_name','vendor_id="'.$vendor_id.'"').'</h2>';
		$str 	.= '</div>';
		if(isset($_SESSION['company_logo'])) 
		//$str 	.= '<div class="logo"><img height="60" src="'.$_SESSION['company_logo'].'"</div>';
		$str 	.= '<div class="left">';
		if(isset($project_name)) 
		$str 	.= '<p>Project Name: '.$project_name.'</p>';
		if($_POST['warehouse_id']>0)
		$str 	.= '<p style="text-align:center;">Branch.: '.find_a_field('warehouse','warehouse_name','warehouse_id="'.$_POST['warehouse_id'].'"').'</p>';
		$str 	.= '</div><div class="center">';
		
		$str 	.= '</div><div class="date">Reporting Time: '.date("h:i A d-m-Y").'</div>';
if($_POST['report']==6)
{
$report="Purchase Receive Report";
?>
	<table width="100%" border="0" cellpadding="2" cellspacing="0">
		
		<thead>
		<tr><td colspan="19" style="border:0px;">
		<?
		echo '<div class="header">';
		echo '<h1>'.find_a_field('warehouse','warehouse_name','warehouse_id='.$_SESSION['user']['depot']).'</h1>';
		if(isset($report)) 
		echo '<h2>'.$report.'</h2>';

if(isset($t_date)) 
		echo '<h2>Date Interval : '.$f_date.' To '.$t_date.'</h2>';
		echo '</div>';

		echo '<div class="date" style=" text-align:left; float:right;">Reporting Time: '.date("h:i A d-m-Y").'</div>';
		?>
		</td></tr>
<tbody>

	<tr>
		<th>Po No</th>
		<th>Po Date</th>
		<th>Vendor Name</th>
		<th>Item Name </th>
		<th>Rate</th>
		<th>OQ</th>
		<th>RQ</th>
		<th>DQ</th>
	    <th>Amt</th>
	</tr>
<? 


if($_POST['f_date']!=''&&$_POST['t_date']!='')
$con .= 'and a.po_date between "'.$_POST['f_date'].'" and "'.$_POST['t_date'].'"';
if($_POST['vendor_id']>0)
$con .= 'and a.vendor_id="'.$_POST['vendor_id'].'"';

$res='select  a.po_no, a.po_date, v.vendor_name,u.fname as entry_by
from 
purchase_master a,warehouse b, vendor v,user_activity_management u where u.user_id=a.entry_by and a.warehouse_id=b.warehouse_id and  a.vendor_id=v.vendor_id and  a.warehouse_id = "'.$_SESSION['user']['depot'].'" '.$con.' order by a.po_no desc';

$query = mysql_query($res);
while($data=mysql_fetch_object($query))
{

?>

	<tr>
      <td valign="top"><?=$data->po_no;?></td>
	  <td valign="top"><?=$data->po_date;?></td>
	  <td valign="top"><?=$data->vendor_name;?></td>
	  <td colspan="6">
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:9px; border:0;">
<? 
$sql = 'select a.*,b.item_name from purchase_invoice a,item_info b where a.item_id=b.item_id and a.po_no="'.$data->po_no.'"';
$sqlq = mysql_query($sql);
while($info=mysql_fetch_object($sqlq)){
?>
	<tr>
	  <td width="32%"><?=$info->item_name.'('.$info->unit_name.')';?></td>
	  <td width="17%"><?=number_format($info->rate,2)?></td>
	  <td width="12%"><?=number_format($info->qty,0)?></td>
	  <td width="12%"><? $rq = find_a_field('purchase_receive','sum(qty)','order_no="'.$info->id.'"'); echo number_format($rq,0);?></td>
	  <td width="12%"><? $dq = $info->qty - $rq; if($dq>0) echo number_format($dq,0); $tot = $rq*$info->rate; $total = $total + $tot;?></td>
	  <td width="15%"><?=number_format(($tot),2);?></td>
	</tr>
<? }?>
</table>	  </td>
	</tr>
<? }?>
	<tr>
	  <td colspan="8" valign="top"><div align="right"><strong>Total:</strong></div></td>
	  <td><div align="right">
	    <?=number_format(($total),2);?></div></td>
	</tr>
</tbody></table>
<?
}

if($_POST['report']==44)
{
$report="Daily Progress Report";
?>
	<table width="100%" class="tabledesign" border="1" bordercolor="#000000" cellspacing="0" cellpadding="0">
		<thead>
		<tr><td colspan="19" style="border:0px;">
		<?
		echo '<div class="header">';
		//echo '<h1>'.find_a_field('warehouse','warehouse_name','warehouse_id='.$_SESSION['user']['depot']).'</h1>';
		if(isset($report)) 
		echo '<h2>'.$report.'</h2>';

if($_POST['t_date']!='') 
		echo '<h2>Date Interval : '.$_POST['f_date'].' To '.$_POST['t_date'].'</h2>';
		echo '</div>';

		echo '<div class="date" style=" text-align:left; float:right;">Reporting Time: '.date("h:i A d-m-Y").'</div>';
		?>
		</td></tr>
		</thead>
       <tr>
        <td width="4%" align="center"><strong>SL</strong></td>
        <td width="30%" align="center" ><strong>Department</strong></td>
		<td width="11%" align="center" ><strong>Progress Details</strong></td>
		
      </tr>
	  <?php

$sql1="select * from daily_progress_master where d_id='$d_id'";
$data=mysql_fetch_object(mysql_query($sql1));

//echo  $sql2=;'select a.id, a.date,m.progress_for, m.progress_date, a.day, a.customer_name, a.sales_order as "order", a.sales, a.delivery, a.gap_analysis, a.collection, a.outstanding
// from daily_progress_details a, daily_progress_master m where m.d_id=a.d_id and m.progress_date = "2022-06-27" '
$sql2 = 'select type, id from daily_progress_setup where tr_from = "progress for"';
$data2=mysql_query($sql2);
$tot_sl = mysql_num_rows($data2);
while($info=mysql_fetch_object($data2)){ 
	
	
if($info->id==1){

?>
	<tr>
        <td valign="top" align="center"><?=++$sl?></td>
        <td align="left" valign="top" style="padding:5px;"><?=$info->type;?></td>
        <td valign="top" style="padding:5px;">
			<table border="1" style="width:100%; border-collapse:collapse">
				<tr>
				
				
						<td>Date</td>
                        <td>Day</td>
                        <td>Name</td>
                        <td>Section</td>
                        <td>Action Plan</td>
                        <td>Target Amount</td>
						<td>Challenges</td>
						<td>Progress</td>
						<td>Follow Up</td>
				</tr>
				
<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by
 from daily_progress_details a, daily_progress_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<tr > 
						<td><?=$info3->date;?></td>
                        <td><?=$info3->day;?></td>
                        <td><?=$info3->customer_name;?></td>
                        <td><?=$info3->sales_order; $total_sales_order +=$info3->sales_order; ?></td>
                        <td><?=$info3->sales; $total_sales +=$info3->sales;?></td>
                        <td><?=$info3->delivery; $total_delivery +=$info3->delivery;  ?></td>
						<td><?=$info3->gap_analysis;?></td>
						<td><?=$info3->collection; $total_collection +=$info3->collection;?></td>
						<td><?=$info3->outstanding; $total_outstanding +=$info3->outstanding; ?></td>
				</tr>
		<? } ?>	
				<tr>
					<td style="text-align:right" colspan="3">Total:</td>
					<td><?=number_format($total_sales_order,2); $gtotal_sales_order = $gtotal_sales_order+$total_sales_order; ?></td>
					<td><?=number_format($total_sales,2); $gtotal_sales = $gtotal_sales+$total_sales; ?></td>
					<td><?=number_format($total_delivery,2); $gtotal_delivery = $gtotal_delivery+$total_delivery; ?></td>
					<td></td>
					<td><?=number_format($total_collection,2); $gtotal_collection = $gtotal_collection+$total_collection;?></td>
					<td><?=number_format($total_outstanding,2); $gtotal_outstanding = $gtotal_outstanding + $total_sales;?></td>
					
				
				</tr>
				
					
			</table>
		</td>
        
     </tr>
<? } elseif($info->id==2){ ?>
		
<tr>
        <td valign="top" align="center"><?=++$sl?></td>
        <td align="left" valign="top" style="padding:5px;"><?=$info->type;?></td>
        <td valign="top" style="padding:5px;">
			<table border="1" style="width:100%; border-collapse:collapse">
				<tr>
				
				
						<td>Category</td>
                        <td>Particulars</td>
                        <td>Amount</td>
                        <td>Plan</td>
                        <td>Progress</td>
                        <td>Problem</td>
				</tr>
				
<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by
 from daily_progress_details a, daily_progress_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<tr>
						<td><?=find_a_field('daily_progress_setup','category','id='.$info3->category);?></td>
                        <td><?=find_a_field('daily_progress_setup','particulars','id='.$info3->particular);?></td>
                        <td><?=$info3->amount; $total_amount += $info3->amount;?></td>
                        <td><?=$info3->plan;?></td>
                        <td><?=$info3->progress;?></td>
                        <td><?=$info3->problem; ?></td>
				</tr>
		<? } ?>	
				<tr>
					<td style="text-align:right" colspan="2">Total:</td>
					<td><?=number_format($total_amount,2); $gtotal_amount += $total_amount;?></td>
					<td colspan="3"></td>
					
				
				</tr>
				
				
			</table>
		</td>
        
     </tr>
		
	
<? } elseif($info->id==3) { ?>
		
		<tr>
        <td valign="top" align="center"><?=++$sl?></td>
        <td align="left" valign="top" style="padding:5px;"><?=$info->type;?></td>
        <td valign="top" style="padding:5px;">
			<table border="1" style="width:100%; border-collapse:collapse">
				<tr>
				
				
						<td>Category</td>
                        <td>Particulars</td>
                        <td>Amount</td>
                        <td>Plan</td>
                        <td>Progress</td>
                        <td>Problem</td>
				</tr>
				
<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by
 from daily_progress_details a, daily_progress_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<tr>
						<td><?=$info3->category;?></td>
                        <td><?=find_a_field('daily_progress_setup','particulars','id='.$info3->particular);?></td>
                        <td><?=$info3->amount; $total_amount += $info3->amount;?></td>
                        <td><?=$info3->plan;?></td>
                        <td><?=$info3->progress;?></td>
                        <td><?=$info3->problem; ?></td>
				</tr>
		<? } ?>	
				<tr>
					<td style="text-align:right" colspan="2">Total:</td>
					<td><?=number_format($total_amount,2); $gtotal_amount += $total_amount;?></td>
					<td colspan="3"></td>
					
				
				</tr>
				
				
			</table>
		</td>
        
     </tr>
		
<? } elseif($info->id==4){ ?>
		
		<tr>
        <td valign="top" align="center"><?=++$sl?></td>
        <td align="left" valign="top" style="padding:5px;"><?=$info->type;?></td>
        <td valign="top" style="padding:5px;">
			<table border="1" style="width:100%; border-collapse:collapse">
				<tr>
				
				
						<td>Date</td>
						<td>Engr. Name</td>
						<td>Time Schedule</td>
						<td>Customer Name</td>
                        <td>Action Plan</td>
                        <td>Progress</td>
                        <td>Follow Up</td>
                        <td>Remarks</td>
				</tr>
				
<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by
 from daily_progress_details a, daily_progress_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<tr>	
                        <td><?=$info3->date;?></td>
                        <td><?=$info3->man_power;?></td>
                        <td><?=$info3->time_schedule;?></td>
                        <td><?=$info3->customer_name;?></td>
                        <td><?=$info3->plan; ?></td>
                        <td><?=$info3->progress; ?></td>
                        <td><?=$info3->findings; ?></td>
                        <td><?=$info3->problem; ?></td>
				</tr>
		<? } ?>	
				
				
				
			</table>
		</td>
        
     </tr>
		
<? }elseif($info->id==5){ ?>
		
		<tr>
        <td valign="top" align="center"><?=++$sl?></td>
        <td align="left" valign="top" style="padding:5px;"><?=$info->type;?></td>
        <td valign="top" style="padding:5px;">
			<table border="1" style="width:100%; border-collapse:collapse">
				<tr>
				
				
						<td>Particulars</td>
						<td>Customers</td>
						<td>Project Name</td>
						<td>Man power</td>
						<td>Target</td>
						<td>Plan</td>
                        <td>Progress</td>
                        <td>Problem</td>
						<td>Requisition</td>
				</tr>
				
<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by
 from daily_progress_details a, daily_progress_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<tr>
						<td><?=find_a_field('daily_progress_setup','particulars','id='.$info3->particular);?></td>
                        <td><?=$info3->customer_name;?></td>
                        <td><?=$info3->project_name;?></td>
                        <td><?=$info3->man_power;?></td>
                        <td><?=$info3->target;?></td>
                        <td><?=$info3->plan; ?></td>
                        <td><?=$info3->progress; ?></td>
                        <td><?=$info3->problem; ?></td>
                        <td><?=$info3->requisition; ?></td>
				</tr>
		<? } ?>	
				
				
				
			</table>
		</td>
        
     </tr>	
		
		
<? } elseif($info->id==31){ ?>
		
		<tr>
        <td valign="top" align="center"><?=++$sl?></td>
        <td align="left" valign="top" style="padding:5px;"><?=$info->type;?></td>
        <td valign="top" style="padding:5px;">
			<table border="1" style="width:100%; border-collapse:collapse">
				<tr>
				
				
						<td>Date</td>
                        <td>Day</td>
                        <td>Customer Name</td>
                        <td>Action Plan</td>
                        <td>Assigned Person</td>
                        <td>Progress Report</td>
						<td>Gap Analysis</td>
				</tr>
				
<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by
 from daily_progress_details a, daily_progress_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<tr>
						<td><?=$info3->date;?></td>
                        <td><?=$info3->day;?></td>
                        <td><?=$info3->customer_name;?></td>
                        <td><?=$info3->sales_order; $total_sales_order +=$info3->sales_order; ?></td>
                        <td><?=$info3->sales; $total_sales +=$info3->sales;?></td>
                        <td><?=$info3->delivery; $total_delivery +=$info3->delivery;  ?></td>
						<td><?=$info3->gap_analysis;?></td>
						<td><?=$info3->collection; $total_collection +=$info3->collection;?></td>
						<td><?=$info3->outstanding; $total_outstanding +=$info3->outstanding; ?></td>
				</tr>
		<? } ?>	
				<tr>
					<td style="text-align:right" colspan="3">Total:</td>
					<td><?=number_format($total_sales_order,2); $gtotal_sales_order = $gtotal_sales_order+$total_sales_order; ?></td>
					<td><?=number_format($total_sales,2); $gtotal_sales = $gtotal_sales+$total_sales; ?></td>
					<td><?=number_format($total_delivery,2); $gtotal_delivery = $gtotal_delivery+$total_delivery; ?></td>
					<td></td>
					<td><?=number_format($total_collection,2); $gtotal_collection = $gtotal_collection+$total_collection;?></td>
					<td><?=number_format($total_outstanding,2); $gtotal_outstanding = $gtotal_outstanding + $total_sales;?></td>
					
				
				</tr>
				
					
			</table>
		</td>
        
     </tr>
		
<? }elseif($info->id==32){ ?>
		
		
		<tr>
        <td valign="top" align="center"><?=++$sl?></td>
        <td align="left" valign="top" style="padding:5px;"><?=$info->type;?></td>
        <td valign="top" style="padding:5px;">
			<table border="1" style="width:100%; border-collapse:collapse">
				<tr>
				
				
						<td>Owner</td>
                        <td>Address</td>
                        <td>Pet Name</td>
                        <td>Pet Type</td>
                        <td>Patient Category</td>
                        <td>Service type</td>
						<td>Mobile</td>
						<td>Email</td>
						<td>Next Visit</td>
						<td>Total</td>
						<td>Remarks</td>
				</tr>
				
<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by
 from daily_progress_details a, daily_progress_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<tr>
						<td><?=$info3->customer_name;?></td>
                        <td><?=$info3->address;?></td>
                        <td><?=$info3->man_power;?></td>
                        <td><?=$info3->pet_type; ?></td>
                        <td><?=$info3->pet_category; ?></td>
                        <td><?=$info3->service_type;   ?></td>
						<td><?=$info3->mobile;?></td>
						<td><?=$info3->email;?></td>
						<td><?=$info3->next_visit;  ?></td>
						<td><?=$info3->amount; $total_amount+=$info3->amount;  ?></td>
						<td><?=$info3->findings;  ?></td>
				</tr>
		<? } ?>	
				<tr>
					<td style="text-align:right" colspan="9">Total:</td>
					<td><?=number_format($total_amount,2); ?></td>
					<td></td>
					
				
				</tr>
				
					
			</table>
		</td>
        
     </tr>
		
<? } elseif($info->id==33){ ?>
	
			<tr>
        <td valign="top" align="center"><?=++$sl?></td>
        <td align="left" valign="top" style="padding:5px;"><?=$info->type;?></td>
        <td valign="top" style="padding:5px;">
			<table border="1" style="width:100%; border-collapse:collapse">
				<tr>
				
				

						<td>Office Visit</td>
                        <td>Office Name</td>
                        <td>Report</td>
				</tr>
				
<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by
 from daily_progress_details a, daily_progress_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<tr>
						
                        <td><?=find_a_field('daily_progress_setup','particulars','id='.$info3->particular);?></td>
                        <td><?=$info3->customer_name;?></td>
                        <td><?=$info3->findings; ?></td>
				</tr>
		<? } ?>	
				
				
				
			</table>
		</td>
        
     </tr>
		
		
<? } ?>
<? } ?>	
		<?php /*?><? if($tot_sl==$sl){?>
				<tr>
					<td style="text-align:right" colspan="2">Grand Total:</td>
					<td><?=number_format($gtotal_sales_order,2);?></td>
					<td><?=number_format($gtotal_sales,2);?></td>
					<td><?=number_format($gtotal_delivery,2);?></td>
					<td><?=number_format($gtotal_collection,2);?></td>
					<td><?=number_format($gtotal_outstanding,2);?></td>
					<td></td>
					<td><?=number_format($gtotal_amount,2);?></td>
					
				</tr>	
				<? } ?>
	<?php */?>
    </table>
<?
}
	
if($_POST['report']==4444)
{
$report="Daily Progress Report";
?>
	<table width="100%" class="tabledesign" border="1" bordercolor="#000000" cellspacing="0" cellpadding="0">
		<thead>
		<tr><td colspan="19" style="border:0px;">
		<?
		echo '<div class="header">';
		//echo '<h1>'.find_a_field('warehouse','warehouse_name','warehouse_id='.$_SESSION['user']['depot']).'</h1>';
		if(isset($report)) 
		echo '<h2>'.$report.'</h2>';

if($_POST['t_date']!='') 
		echo '<h2>Date Interval : '.$_POST['f_date'].' To '.$_POST['t_date'].'</h2>';
		echo '</div>';

		echo '<div class="date" style=" text-align:left; float:right;">Reporting Time: '.date("h:i A d-m-Y").'</div>';
		?>
		</td></tr>
		</thead>
		
	</table>

	  <?php

$sql1="select * from daily_progress_master where d_id='$d_id'";
$data=mysql_fetch_object(mysql_query($sql1));

//echo  $sql2=;'select a.id, a.date,m.progress_for, m.progress_date, a.day, a.customer_name, a.sales_order as "order", a.sales, a.delivery, a.gap_analysis, a.collection, a.outstanding
// from daily_progress_details a, daily_progress_master m where m.d_id=a.d_id and m.progress_date = "2022-06-27" '
$sql2 = 'select type, id from daily_progress_setup where tr_from = "progress for"';
$data2=mysql_query($sql2);
$tot_sl = mysql_num_rows($data2);
while($info=mysql_fetch_object($data2)){ 
	
	
if($info->id==1){

?><table width="100%" class="tabledesign" border="1" bordercolor="#000000" cellspacing="0" cellpadding="0">
	 <tr>
        <td width="" align="center" ><strong>Department</strong></td>
		<td width="" align="center" ><strong>Plan Details</strong></td>
		
      </tr>
	
	
	<tr>
        <td align="center" valign="middle" style="padding:5px; width:248px;"><?=$info->type;?></td>
        <td valign="top" style="padding:5px;">
			<table border="1" style="width:100%; border-collapse:collapse">
				<tr>
				
				
						<td><strong>Date</strong></td>
                        <td><strong>Day</strong></td>
                        <td><strong>Name</strong></td>
                        <td><strong>Section</strong></td>
                        <td><strong>Action Plan</strong></td>
                        <td><strong>Target Amount</strong></td>
						<td><strong>Challenges</strong></td>
						<td><strong>Progress</strong></td>
						<td><strong>Follow Up</strong></td>
				</tr>
				
<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by
 from daily_progress_details a, daily_progress_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<tr style=" <? if($info3->sales_order==$info3->sales){echo 'background-color:#19ad195e'; } elseif(($info3->sales_order/2)>=$info3->sales){echo 'background-color:#d736368f'; } elseif(($info3->sales_order/2)<$info3->sales){echo 'background-color:#e3e33980'; }?>">
						<td><?=$info3->date;?></td>
                        <td><?=$info3->day;?></td>
                        <td><?=$info3->customer_name;?></td>
                        <td><?=$info3->address; ?></td>
                        <td><?=$info3->pet_type;?></td>
                        <td><?=$info3->delivery;  ?></td>
						<td><?=$info3->gap_analysis;?></td>
						<td><?=$info3->collection;?></td>
						<td><?=$info3->man_power; ?></td>
				</tr>
		<? } ?>	
				<!--<tr>
					<td style="text-align:right" colspan="3"><strong>Total:</strong></td>
					<td><?=number_format($total_sales_order,2); $gtotal_sales_order = $gtotal_sales_order+$total_sales_order; ?></td>
					<td><?=number_format($total_sales,2); $gtotal_sales = $gtotal_sales+$total_sales; ?></td>
					<td><?=number_format($total_delivery,2); $gtotal_delivery = $gtotal_delivery+$total_delivery; ?></td>
					<td></td>
					<td><?=number_format($total_collection,2); $gtotal_collection = $gtotal_collection+$total_collection;?></td>
					<td><?=number_format($total_outstanding,2); $gtotal_outstanding = $gtotal_outstanding + $total_sales;?></td>
					
				
				</tr>-->
				
				
				<!--<tr ><th colspan="9" style="text-align: center">Progress Details</th></tr>-->
				
				<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by from daily_plan_details a, daily_plan_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<!--<tr>
						<td><?=$info3->date;?></td>
                        <td><?=$info3->day;?></td>
                        <td><?=$info3->customer_name;?></td>
                        <td><?=$info3->sales_order; $total_sales_order +=$info3->sales_order; ?></td>
                        <td><?=$info3->sales; $total_sales +=$info3->sales;?></td>
                        <td><?=$info3->delivery; $total_delivery +=$info3->delivery;  ?></td>
						<td><?=$info3->gap_analysis;?></td>
						<td><?=$info3->collection; $total_collection +=$info3->collection;?></td>
						<td><?=$info3->outstanding; $total_outstanding +=$info3->outstanding; ?></td>
				</tr>-->
		<? } ?>	
				<!--<tr>
					<td style="text-align:right" colspan="3"><strong>Total:</strong></td>
					<td><?=number_format($total_sales_order,2); $gtotal_sales_order = $gtotal_sales_order+$total_sales_order; ?></td>
					<td><?=number_format($total_sales,2); $gtotal_sales = $gtotal_sales+$total_sales; ?></td>
					<td><?=number_format($total_delivery,2); $gtotal_delivery = $gtotal_delivery+$total_delivery; ?></td>
					<td></td>
					<td><?=number_format($total_collection,2); $gtotal_collection = $gtotal_collection+$total_collection;?></td>
					<td><?=number_format($total_outstanding,2); $gtotal_outstanding = $gtotal_outstanding + $total_sales;?></td>
					
				
				</tr>-->
				
					
			</table>
		</td>
        
     </tr>
	</table>
	<br><br>
<? } 
elseif($info->id==2){ ?>
	
	
	
	<table width="100%" class="tabledesign" border="1" bordercolor="#000000" cellspacing="0" cellpadding="0">
	 <tr>
        <td width="" align="center" ><strong>Department</strong></td>
		<td width="" align="center" ><strong>Plan Details</strong></td>
		
      </tr>
		
<tr>
        <td align="center" valign="middle" style="padding:5px; width:248px;"><?=$info->type;?></td>
        <td valign="top" style="padding:5px;">
			<table border="1" style="width:100%; border-collapse:collapse">
				<tr >
				
				
						
                        <td><strong>Particulars</strong></td>
						<td><strong>Customer Name</strong></td>
                        <td><strong>Amount</strong></td>
                        <td><strong>Plan</strong></td>
                        <td><strong>Progress</strong></td>
                        <td><strong>Problem</strong></td>
                        <td><strong>Requisition</strong></td>
				</tr>
				
<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by
 from daily_progress_details a, daily_progress_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<tr style=" <? if($info3->progress=='done'||$info3->progress=='Done'||$info3->progress=='100%'||$info3->progress=='ok'||$info3->progress=='yes'){echo 'background-color:#19ad195e'; } else{echo 'background-color:#e3e33980'; }?>">
                        <td><?=find_a_field('daily_progress_setup','particulars','id='.$info3->particular);?></td>
					<td><?=$info3->customer_name?></td>
                        <td><?=$info3->amount; $total_amount += $info3->amount;?></td>
                        <td><?=$info3->plan;?></td>
                        <td><?=$info3->progress;?></td>
                        <td><?=$info3->problem; ?></td>
                        <td><?=$info3->requisition; ?></td>
				</tr>
		<? } ?>	
				<tr>
					<td style="text-align:right" colspan="2"><strong>Total:</strong></td>
					<td><?=number_format($total_amount,2); $gtotal_amount += $total_amount;?></td>
					<td colspan="4"></td>
					
				
				</tr>
				
								<!--<tr ><th colspan="7" style="text-align: center">Progress Details</th></tr>-->

				
				<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by
 from daily_plan_details a, daily_plan_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<!--<tr>
                        <td><?=find_a_field('daily_progress_setup','particulars','id='.$info3->particular);?></td>
					<td><?=$info3->customer_name?></td>
                        <td><?=$info3->amount; $total_amount += $info3->amount;?></td>
                        <td><?=$info3->plan;?></td>
                        <td><?=$info3->progress;?></td>
                        <td><?=$info3->problem; ?></td>
                        <td><?=$info3->requisition; ?></td>
				</tr>-->
		<? } ?>	
				<!--<tr>
					<td style="text-align:right" colspan="2"><strong>Total:</strong></td>
					<td><?=number_format($total_amount,2); $gtotal_amount += $total_amount;?></td>
					<td colspan="4"></td>
					
				
				</tr>-->
				
			</table>
		</td>
        
     </tr>
	</table>
	<br><br>
<? }
elseif($info->id==52){ ?>
	
	
	
	<table width="100%" class="tabledesign" border="1" bordercolor="#000000" cellspacing="0" cellpadding="0">
	 <tr>
        <td width="" align="center" ><strong>Department</strong></td>
		<td width="" align="center" ><strong>Plan Details</strong></td>
		
      </tr>
		
<tr>
        <td align="center" valign="middle" style="padding:5px; width:248px;"><?=$info->type;?></td>
        <td valign="top" style="padding:5px;">
			<table border="1" style="width:100%; border-collapse:collapse">
				<tr >
				
				
						
                        <td><strong>Date</strong></td>
						<td><strong>Customer Name</strong></td>
                        <td><strong>Lot No</strong></td>
                        <td><strong>Product Name</strong></td>
                        <td><strong>Unit Price</strong></td>
                        <td><strong>Production Target</strong></td>
                        <td><strong>Production Achieved</strong></td>
						<td><strong>Delivery Target</strong></td>
						<td><strong>Delivery Achieved</strong></td>
				</tr>
				
<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by
 from daily_progress_details a, daily_progress_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<tr style=" <? if($info3->progress=='done'||$info3->progress=='Done'||$info3->progress=='100%'||$info3->progress=='ok'||$info3->progress=='yes'){echo 'background-color:#19ad195e'; } else{echo 'background-color:#e3e33980'; }?>">
                        <td><?=$info3->date?></td>
						<td><?=$info3->customer_name;?></td>
                        <td><?=$info3->man_power;?></td>
                        <td><?=$info3->plan;?></td>
                        <td><?=$info3->amount;?></td>
                        <td><?=$info3->collection; ?></td>
                        <td><?=$info3->outstanding; ?></td>
						<td><?=$info3->category; ?></td>
						<td><?=$info3->pet_type; ?></td>
				</tr>
		<? } ?>	
				<!--<tr>
					<td style="text-align:right" colspan="2"><strong>Total:</strong></td>
					<td><?=number_format($total_amount,2); $gtotal_amount += $total_amount;?></td>
					<td colspan="4"></td>
					
				
				</tr>-->
				
								<!--<tr ><th colspan="7" style="text-align: center">Progress Details</th></tr>-->

				
				<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by
 from daily_plan_details a, daily_plan_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<!--<tr>
                        <td><?=find_a_field('daily_progress_setup','particulars','id='.$info3->particular);?></td>
					<td><?=$info3->customer_name?></td>
                        <td><?=$info3->amount; $total_amount += $info3->amount;?></td>
                        <td><?=$info3->plan;?></td>
                        <td><?=$info3->progress;?></td>
                        <td><?=$info3->problem; ?></td>
                        <td><?=$info3->requisition; ?></td>
				</tr>-->
		<? } ?>	
				<!--<tr>
					<td style="text-align:right" colspan="2"><strong>Total:</strong></td>
					<td><?=number_format($total_amount,2); $gtotal_amount += $total_amount;?></td>
					<td colspan="4"></td>
					
				
				</tr>-->
				
			</table>
		</td>
        
     </tr>
	</table>
	<br><br>
<? }

elseif($info->id==3) { ?>
	<table width="100%" class="tabledesign" border="1" bordercolor="#000000" cellspacing="0" cellpadding="0">
	 <tr>
        <td width="" align="center" ><strong>Department</strong></td>
		<td width="" align="center" ><strong>Plan Details</strong></td>
		
      </tr>	
<tr>
        <td align="center" valign="middle" style="padding:5px; width:248px;"><?=$info->type;?></td>
        <td valign="top" style="padding:5px;">
			<table border="1" style="width:100%; border-collapse:collapse">
				<tr>
				
				
                        <td><strong>Particulars</strong></td>
                        <td><strong>Amount</strong></td>
                        <td><strong>Plan</strong></td>
                        <td><strong>Progress</strong></td>
                        <td><strong>Problem</strong></td>
				</tr>
				
<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by
 from daily_progress_details a, daily_progress_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<tr style=" <? if($info3->progress=='done'||$info3->progress=='Done'||$info3->progress=='100%'||$info3->progress=='ok'||$info3->progress=='yes'){echo 'background-color:#19ad195e'; } else{echo 'background-color:#e3e33980'; }?>">
                        <td><?=find_a_field('daily_progress_setup','particulars','id='.$info3->particular);?></td>
                        <td><?=$info3->amount; $total_amount += $info3->amount;?></td>
                        <td><?=$info3->plan;?></td>
                        <td><?=$info3->progress;?></td>
                        <td><?=$info3->problem; ?></td>
				</tr>
		<? } ?>	
				<tr>
					<td style="text-align:right" colspan="1"><strong>Total:</strong></td>
					<td><?=number_format($total_amount,2); $gtotal_amount += $total_amount;?></td>
					<td colspan="4"></td>
					
				
				</tr>
								<!--<tr ><th colspan="6" style="text-align: center">Progress Details</th></tr>-->
<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by
 from daily_plan_details a, daily_plan_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<!--<tr>
                        <td><?=find_a_field('daily_progress_setup','particulars','id='.$info3->particular);?></td>
                        <td><?=$info3->amount; $total_amount += $info3->amount;?></td>
                        <td><?=$info3->plan;?></td>
                        <td><?=$info3->progress;?></td>
                        <td><?=$info3->problem; ?></td>
				</tr>-->
		<? } ?>	
				<!--<tr>
					<td style="text-align:right" colspan="1"><strong>Total:</strong></td>
					<td><?=number_format($total_amount,2); $gtotal_amount += $total_amount;?></td>
					<td colspan="4"></td>
					
				
				</tr>-->
				
			</table>
		</td>
        
     </tr>
	</table>
	<br><br>	
<? } elseif($info->id==4){ ?>
	<table width="100%" class="tabledesign" border="1" bordercolor="#000000" cellspacing="0" cellpadding="0">
	 <tr>
        <td width="" align="center" ><strong>Department</strong></td>
		<td width="" align="center" ><strong>Plan Details</strong></td>
		
      </tr>	
<tr>
        <td align="center" valign="middle" style="padding:5px; width:248px;"><?=$info->type;?></td>
        <td valign="top" style="padding:5px;">
			<table border="1" style="width:100%; border-collapse:collapse">
				<tr>
				
				
						<td><strong>Date</strong></td>
						<td><strong>Customer Name</strong></td>
                        <td><strong>Amount</strong></td>
                        <td><strong>Problem</strong></td>
				</tr>
				
<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by
 from daily_progress_details a, daily_progress_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<tr>	
                        <td><?=$info3->date;?></td>
                        <td><?=$info3->customer_name;?></td>
                        <td><?=$info3->amount; $total_amount +=$info3->amount; ?></td>
                        <td><?=$info3->problem; ?></td>
				</tr>
		<? } ?>	
				
				<tr>
					<td style="text-align:right" colspan="2"><strong>Total:</strong></td>
					<td><?=number_format($total_amount,2); $gtotal_amount += $total_amount;?></td>
					<td colspan="3"></td>
					
				
				</tr>
		<!--<tr ><th colspan="6" style="text-align: center">Progress Details</th></tr>-->
				<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by
 from daily_plan_details a, daily_plan_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<!--<tr>	
                        <td><?=$info3->date;?></td>
                        <td><?=$info3->customer_name;?></td>
                        <td><?=$info3->amount; $total_amount +=$info3->amount; ?></td>
                        <td><?=$info3->problem; ?></td>
				</tr>-->
		<? } ?>	
				
				<!--<tr>
					<td style="text-align:right" colspan="2"><strong>Total:</strong></td>
					<td><?=number_format($total_amount,2); $gtotal_amount += $total_amount;?></td>
					<td colspan="3"></td>
					
				
				</tr>-->

			</table>
		</td>
        
     </tr>
	</table>
	<br><br>
<? }elseif($info->id==5){ ?>
		<table width="100%" class="tabledesign" border="1" bordercolor="#000000" cellspacing="0" cellpadding="0">
	 <tr>
        <td width="" align="center" ><strong>Department</strong></td>
		<td width="" align="center" ><strong>Plan Details</strong></td>
		
      </tr>
		<tr>
        <td align="center" valign="middle" style="padding:5px; width:248px;"><?=$info->type;?></td>
        <td valign="top" style="padding:5px;">
			<table border="1" style="width:100%; border-collapse:collapse">
				<tr>
				
				
						<td><strong>Particulars</strong></td>
						<td><strong>Customers</strong></td>
						<td><strong>Project Name</strong></td>
						<td><strong>Man power</strong></td>
						<td><strong>Target</strong></td>
						<td><strong>Plan</strong></td>
                        <td><strong>Progress</strong></td>
                        <td><strong>Problem</strong></td>
						<td><strong>Requisition</strong></td>
				</tr>
				
<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by
 from daily_progress_details a, daily_progress_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<tr style=" <? if($info3->target==$info3->progress){echo 'background-color:#19ad195e'; } elseif(($info3->target/2)>=$info3->progress){echo 'background-color:#d736368f'; } elseif(($info3->target/2)<$info3->progress){echo 'background-color:#e3e33980'; }?>">
						<td><?=find_a_field('daily_progress_setup','particulars','id='.$info3->particular);?></td>
                        <td><?=$info3->customer_name;?></td>
                        <td><?=$info3->project_name;?></td>
                        <td><?=$info3->man_power;?></td>
                        <td><?=$info3->target;?></td>
                        <td><?=$info3->plan; ?></td>
                        <td><?=$info3->progress; ?></td>
                        <td><?=$info3->problem; ?></td>
                        <td><?=$info3->requisition; ?></td>
				</tr>
		<? } ?>	
				
						<!--<tr ><th colspan="9" style="text-align: center">Progress Details</th></tr>-->

			<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by
 from daily_plan_details a, daily_plan_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<!--<tr>
						<td><?=find_a_field('daily_progress_setup','particulars','id='.$info3->particular);?></td>
                        <td><?=$info3->customer_name;?></td>
                        <td><?=$info3->project_name;?></td>
                        <td><?=$info3->man_power;?></td>
                        <td><?=$info3->target;?></td>
                        <td><?=$info3->plan; ?></td>
                        <td><?=$info3->progress; ?></td>
                        <td><?=$info3->problem; ?></td>
                        <td><?=$info3->requisition; ?></td>
				</tr>-->
		<? } ?>	
				
				
			</table>
		</td>
        
     </tr>	
	</table>	
	<br><br>	
<? } elseif($info->id==31){ ?>
		<table width="100%" class="tabledesign" border="1" bordercolor="#000000" cellspacing="0" cellpadding="0">
	 <tr>
        <td width="" align="center" ><strong>Department</strong></td>
		<td width="" align="center" ><strong>Plan Details</strong></td>
		
      </tr>
		<tr>
        <td align="center" valign="middle" style="padding:5px; width:248px;"><?=$info->type;?></td>
        <td valign="top" style="padding:5px;">
			<table border="1" style="width:100%; border-collapse:collapse">
				<tr>
				
				
						<td><strong>Date</strong></td>
                        <td><strong>Day</strong></td>
                        <td><strong>Section</strong></td>
                        <td><strong>Action Plan</strong></td>
                        <td><strong>Challenges</strong></td>
						<td><strong>Amount/Qty</strong></td>
                        <td><strong>Progress</strong></td>
						<td><strong>Follow up</strong></td>
				</tr>
				
<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by
 from daily_progress_details a, daily_progress_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<tr >
						<td><?=$info3->date;?></td>
                        <td><?=$info3->day;?></td>
                        <td><?=$info3->customer_name;?></td>
                        <td><?=$info3->plan; ?></td>
                        <td><?=$info3->man_power; ?></td>
						<td><?=$info3->collection; ?></td>
						<td><?=$info3->progress;?></td>
						<td><?=$info3->gap_analysis;?></td>
				</tr>
		<? } ?>	
									<!--<tr ><th colspan="7" style="text-align: center">Progress Details</th></tr>-->
	
	<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by
 from daily_plan_details a, daily_plan_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<!--<tr>
						<td><?=$info3->date;?></td>
                        <td><?=$info3->day;?></td>
                        <td><?=$info3->customer_name;?></td>
                        <td><?=$info3->plan; ?></td>
                        <td><?=$info3->man_power; ?></td>
						<td><?=$info3->progress;?></td>
						<td><?=$info3->gap_analysis;?></td>
				</tr>-->
		<? } ?>			
					
			</table>
		</td>
        
     </tr>
	</table>
	<br><br>
<? }elseif($info->id==53){ ?>
		<table width="100%" class="tabledesign" border="1" bordercolor="#000000" cellspacing="0" cellpadding="0">
	 <tr>
        <td width="" align="center" ><strong>Department</strong></td>
		<td width="" align="center" ><strong>Plan Details</strong></td>
		
      </tr>
		<tr>
        <td align="center" valign="middle" style="padding:5px; width:248px;"><?=$info->type;?></td>
        <td valign="top" style="padding:5px;">
			<table border="1" style="width:100%; border-collapse:collapse">
				<tr>
				
				
						<td><strong>Date</strong></td>
                        <td><strong>Project Name</strong></td>
                        <td><strong>Progress</strong></td>
                        <td><strong>Action Plan</strong></td>
                        <td><strong>Time Line</strong></td>
                        <td><strong>Materials Name</strong></td>
						<td><strong>Qty</strong></td>
						<td><strong>Sub Contractor Demand</strong></td>
				</tr>
				
<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by
 from daily_progress_details a, daily_progress_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<tr >
						<td><?=$info3->date;?></td>
                        <td><?=$info3->day;?></td>
                        <td><?=$info3->customer_name;?></td>
                        <td><?=$info3->plan; ?></td>
                        <td><?=$info3->man_power; ?></td>
						<td><?=$info3->progress;?></td>
						<td><?=$info3->gap_analysis;?></td>
						<td><?=$info3->requisition;?></td>
				</tr>
		<? } ?>	
									<!--<tr ><th colspan="7" style="text-align: center">Progress Details</th></tr>-->
	
	<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by
 from daily_plan_details a, daily_plan_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<!--<tr>
						<td><?=$info3->date;?></td>
                        <td><?=$info3->day;?></td>
                        <td><?=$info3->customer_name;?></td>
                        <td><?=$info3->plan; ?></td>
                        <td><?=$info3->man_power; ?></td>
						<td><?=$info3->progress;?></td>
						<td><?=$info3->gap_analysis;?></td>
				</tr>-->
		<? } ?>			
					
			</table>
		</td>
        
     </tr>
	</table>
	<br><br>
<? }elseif($info->id==32){ ?>
		<table width="100%" class="tabledesign" border="1" bordercolor="#000000" cellspacing="0" cellpadding="0">
	 <tr>
        <td width="" align="center" ><strong>Department</strong></td>
		<td width="" align="center" ><strong>Plan Details</strong></td>
		
      </tr>
		
		<tr>
        <td align="center" valign="middle" style="padding:5px; width:248px;"><?=$info->type;?></td>
        <td valign="top" style="padding:5px;">
			<table border="1" style="width:100%; border-collapse:collapse">
				<tr>
				
				
						<td><strong>Owner</strong></td>
                        <td><strong>Address</strong></td>
                        <td><strong>Pet Name</strong></td>
                        <td><strong>Pet Type</strong></td>
                        <td><strong>Patient Category</strong></td>
                        <td><strong>Service type</strong></td>
						<td><strong>Mobile</strong></td>
						<td><strong>Email</strong></td>
						<td><strong>Next Visit</strong></td>
						<td><strong>Total</strong></td>
						<td><strong>Remarks</strong></td>
				</tr>
				
<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by
 from daily_progress_details a, daily_progress_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<tr>
						<td><?=$info3->customer_name;?></td>
                        <td><?=$info3->address;?></td>
                        <td><?=$info3->man_power;?></td>
                        <td><?=$info3->pet_type; ?></td>
                        <td><?=$info3->pet_category; ?></td>
                        <td><?=$info3->service_type;   ?></td>
						<td><?=$info3->mobile;?></td>
						<td><?=$info3->email;?></td>
						<td><?=$info3->next_visit;  ?></td>
						<td><?=$info3->amount; $total_amount+=$info3->amount;  ?></td>
						<td><?=$info3->findings;  ?></td>
				</tr>
		<? } ?>	
				<tr>
					<td style="text-align:right" colspan="9"><strong>Total:</strong></td>
					<td><?=number_format($total_amount,2); ?></td>
					<td></td>
					
				
				</tr>
													<!--<tr ><th colspan="11" style="text-align: center">Progress Details</th></tr>-->
				
				
				
		<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by
 from daily_plan_details a, daily_plan_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<!--<tr>
						<td><?=$info3->customer_name;?></td>
                        <td><?=$info3->address;?></td>
                        <td><?=$info3->man_power;?></td>
                        <td><?=$info3->pet_type; ?></td>
                        <td><?=$info3->pet_category; ?></td>
                        <td><?=$info3->service_type;   ?></td>
						<td><?=$info3->mobile;?></td>
						<td><?=$info3->email;?></td>
						<td><?=$info3->next_visit;  ?></td>
						<td><?=$info3->amount; $total_amount+=$info3->amount;  ?></td>
						<td><?=$info3->findings;  ?></td>
				</tr>-->
		<? } ?>	
				<!--<tr>
					<td style="text-align:right" colspan="9"><strong>Total:</strong></td>
					<td><?=number_format($total_amount,2); ?></td>
					<td></td>
					
				
				</tr>-->

					
			</table>
		</td>
        
     </tr>
	</table>
	<br><br>
	<? }elseif($info->id==35){ ?>
		<table width="100%" class="tabledesign" border="1" bordercolor="#000000" cellspacing="0" cellpadding="0">
	 <tr>
        <td width="" align="center" ><strong>Department</strong></td>
		<td width="" align="center" ><strong>Plan Details</strong></td>
		
      </tr>
		
		<tr>
        <td align="center" valign="middle" style="padding:5px; width:248px;"><?=$info->type;?></td>
        <td valign="top" style="padding:5px;">
			<table border="1" style="width:100%; border-collapse:collapse">
				<tr>
				
				
						<td><strong>Particular</strong></td>
                        <td><strong>H/O</strong></td>
                        <td><strong>Showroom</strong></td>
                        <td><strong>LD Hospital</strong></td>
                        <td><strong>Factory</strong></td>
                        <!--<td>Service type</td>
						<td>Mobile</td>
						<td>Email</td>
						<td>Next Visit</td>
						<td>Total</td>
						<td>Remarks</td>-->
				</tr>
				
<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by
 from daily_progress_details a, daily_progress_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<tr>
						<td><?=find_a_field('daily_progress_setup','particulars','id='.$info3->particular);?></td>
                        <td><?=$info3->head_office;?></td>
                        <td><?=$info3->showroom;?></td>
                        <td><?=$info3->ld_hospital; ?></td>
                        <td><?=$info3->factory; ?></td>
                        <!--<td><?=$info3->service_type;   ?></td>
						<td><?=$info3->mobile;?></td>
						<td><?=$info3->email;?></td>
						<td><?=$info3->next_visit;  ?></td>
						<td><?=$info3->amount; $total_amount+=$info3->amount;  ?></td>
						<td><?=$info3->findings;  ?></td>-->
				</tr>
		<? } ?>	
				<!--<tr>
					<td style="text-align:right" colspan="9">Total:</td>
					<td><?=number_format($total_amount,2); ?></td>
					<td></td>
					
				
				</tr>-->
													<!--<tr ><th colspan="11" style="text-align: center">Progress Details</th></tr>-->
				
				
				
		<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by
 from daily_plan_details a, daily_plan_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<!--<tr>
						<td><?=$info3->particular;?></td>
                        <td><?=$info3->head_office;?></td>
                        <td><?=$info3->showroom;?></td>
                        <td><?=$info3->ld_hospital; ?></td>
                        <td><?=$info3->factory; ?></td>
                        <!--<td><?=$info3->service_type;   ?></td>
						<td><?=$info3->mobile;?></td>
						<td><?=$info3->email;?></td>
						<td><?=$info3->next_visit;  ?></td>
						<td><?=$info3->amount; $total_amount+=$info3->amount;  ?></td>
						<td><?=$info3->findings;  ?></td>-->
				</tr>-->
		<? } ?>	
				<!--<tr>
					<td style="text-align:right" colspan="9">Total:</td>
					<td><?=number_format($total_amount,2); ?></td>
					<td></td>
					
				
				</tr>-->

					
			</table>
		</td>
        
     </tr>
	</table>
	<br><br>
	
	<? } elseif($info->id==51){ ?>
		<table width="100%" class="tabledesign" border="1" bordercolor="#000000" cellspacing="0" cellpadding="0">
	 <tr>
        <td width="" align="center" ><strong>Department</strong></td>
		<td width="" align="center" ><strong>Plan Details</strong></td>
		
      </tr>
		<tr>
        <td align="center" valign="middle" style="padding:5px; width:248px;"><?=$info->type;?></td>
        <td valign="top" style="padding:5px;">
			<table border="1" style="width:100%; border-collapse:collapse">
				<tr>
				
				
						<td><strong>Date</strong></td>
                        <td><strong>Time</strong></td>
                        <td><strong>Address</strong></td>
                        <td><strong>Work Details</strong></td>
                        <td><strong>Progress</strong></td>
						<td><strong>Problem</strong></td>
				</tr>
				
<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by
 from daily_progress_details a, daily_progress_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<tr style=" <? if($info3->progress=='done'||$info3->progress=='Done'||$info3->progress=='100%'||$info3->progress=='ok'||$info3->progress=='yes'){echo 'background-color:#19ad195e'; } else{echo 'background-color:#e3e33980'; }?>">
						<td><?=$info3->date;?></td>
                        <td><?=$info3->day;?></td>
                        <td><?=$info3->customer_name;?></td>
                        <td><?=$info3->plan; ?></td>
						<td><?=$info3->progress;?></td>
						<td><?=$info3->gap_analysis;?></td>
				</tr>
		<? } ?>	
									<!--<tr ><th colspan="7" style="text-align: center">Progress Details</th></tr>-->
	
	<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by
 from daily_plan_details a, daily_plan_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<!--<tr>
						<td><?=$info3->date;?></td>
                        <td><?=$info3->day;?></td>
                        <td><?=$info3->customer_name;?></td>
                        <td><?=$info3->plan; ?></td>
						<td><?=$info3->progress;?></td>
						<td><?=$info3->gap_analysis;?></td>
				</tr>-->
		<? } ?>			
					
			</table>
		</td>
        
     </tr>
	</table>
	<br><br>

<? } elseif($info->id==33){ ?>
	<table width="100%" class="tabledesign" border="1" bordercolor="#000000" cellspacing="0" cellpadding="0">
	 <tr>
        
        <td width="" align="center" ><strong>Department</strong></td>
		<td width="" align="center" ><strong>Plan Details</strong></td>
		
      </tr>
		<tr>
        <td align="center" valign="middle" style="padding:5px; width:248px;"><?=$info->type;?></td>
        <td valign="top" style="padding:5px;">
			<table border="1" style="width:100%; border-collapse:collapse">
				<tr>
				
				

						<td><strong>Office Visit</strong></td>
                        <td><strong>Time Schedule</strong></td>
                        <td><strong>Action Plan</strong></td>
						<td><strong>Progress Report</strong></td>
						<td><strong>Pending</strong></td>
						<td><strong>Follow Up</strong></td>
						<td><strong>Negligency</strong></td>
				</tr>
				
<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by
 from daily_progress_details a, daily_progress_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<tr>
						
                        <td><?=find_a_field('daily_progress_setup','particulars','id='.$info3->particular);?></td>
                        <td><?=$info3->customer_name;?></td>
                        <td><?=$info3->findings; ?></td>
						<td><?=$info3->plan; ?></td>
						<td><?=$info3->progress; ?></td>
						<td><?=$info3->problem; ?></td>
						<td><?=$info3->neg; ?></td>
				</tr>
		<? } ?>	
				
	<!--<tr ><th colspan="7" style="text-align: center">Progress Details</th></tr>-->
	
		<?
$sq3 = 'select a.*,m.progress_for, m.progress_date,m.entry_by
 from daily_plan_details a, daily_plan_master m where m.d_id=a.d_id and m.progress_date="'.$_POST['t_date'].'" and m.progress_for='.$info->id.' ';
$data3=mysql_query($sq3);
$total_sales=0;$total_collection=0;$total_outstanding=0;$total_amount=0;$total_sales_order=0;$total_delivery=0;
while($info3=mysql_fetch_object($data3)){ 
?>				
				<!--<tr>
						
                        <td><?=find_a_field('daily_progress_setup','particulars','id='.$info3->particular);?></td>
                        <td><?=$info3->customer_name;?></td>
                        <td><?=$info3->findings; ?></td>
						<td><?=$info3->plan; ?></td>
						<td><?=$info3->progress; ?></td>
						<td><?=$info3->problem; ?></td>
						<td><?=$info3->neg; ?></td>
				</tr>-->
		<? } ?>			
			</table>
		</td>
        
     </tr>
	</table>
	<br><br>
		
<? } ?>
<? } ?>	
</table>
<?
}

elseif(isset($sql)&&$sql!='') echo report_create($sql,1,$str);
?></div>
</body>
</html>