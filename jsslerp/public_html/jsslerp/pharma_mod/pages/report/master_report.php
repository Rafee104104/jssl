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

if($_POST['report']==404)

{

$report="Customer Report";

?>

	<table width="100%" border="0" cellpadding="2" cellspacing="0" style="font-size:12px !important">

		

		<thead>

		<tr><td colspan="7" style="border:0px;">

		<?

		echo '<div class="header">';

		echo '<h1>'.find_a_field('user_group','group_name','id='.$_SESSION['user']['group']).'</h1>';

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

		<th>S/L</th>

		<th>Customer Name</th>

		<th>Short Name</th>

		<th>Phone </th>

		<th>Email</th>

		<th>Address</th>

		<th>Bin</th>

	</tr>

<? 

if($_POST['customer_id']>0)
$con = 'and customer_id="'.$_POST['customer_id'].'"';

$res='select  * from service_customer where 1 '.$con.'';
$query = mysql_query($res);
$i=1;
while($data=mysql_fetch_object($query))

{

?>
	<tr>

	   <td><?=$i++?></td>
	   <td><?=$data->customer_name?></td>
	   <td><?=$data->short_name?></td>
	   <td><?=$data->phone_no?></td>
	   <td><?=$data->email?></td>
	   <td><?=$data->address?></td>
	   <td><?=$data->bin?></td>
	</tr>

<? }?>

	

</tbody></table>

<?

}
if($_POST['report']==505)

{

$report="Loan Statement";

?>

	<table width="100%" border="0" cellpadding="2" cellspacing="0" style="font-size:12px !important">

		

		<thead>

		<tr><td colspan="7" style="border:0px;">

		<?

		echo '<div class="header">';

		echo '<h1>'.find_a_field('user_group','group_name','id='.$_SESSION['user']['group']).'</h1>';

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

		<th>S/L</th>

		<th>Employee Name</th>

		<th>Loan No </th>

		<th>Loan Amount</th>
		
		<th>Total Installment</th>
		
		<th>Installment</th>
		
		<th>Installment Amount</th>
		
		<th>Installment Received</th>
		
		

	</tr>

<? 

$res='select l.*,p.PBI_NAME from loan_details l, personnel_basic_info p where l.PBI_ID=p.PBI_ID and l.PBI_ID="'.$_POST['PBI_ID'].'" order by l.loan_no asc';
$query = mysql_query($res);
$i=1;
while($data=mysql_fetch_object($query))
{
$monthNum  = $data->current_mon;
$dateObj   = DateTime::createFromFormat('!m', $monthNum);
$monthName = $dateObj->format('F'); 

if($data->tr_from=='Loan Issued'){
$loan_issued = $data->payable_amt;
$loan_receive = '';
$total_loan +=$data->payable_amt;
}elseif($data->tr_from=='Installment Receive'){
$loan_receive = $data->payable_amt;
$total_receive +=$data->payable_amt;
$loan_issued = '';
}
?>
	<tr>

	   <td><?=$i++?></td>
	   <td><?=$data->PBI_NAME?></td>
	   <td><?=$data->loan_no?></td>
	   <td><?=$data->loan_amt?></td>
	   <td><?=$data->total_installment?></td>
	   <td><?=$monthName.'-'.$data->current_year?></td>
	   <td><?=$loan_issued?></td>
	   <td><?=$loan_receive?></td>
	</tr>

<? }?>

	
<tr>
 <td colspan="6" align="right"><strong>Total</strong></td>
 <td><strong><?=number_format($total_loan,2);?></strong></td>
 <td><strong><?=number_format($total_receive,2);?></strong></td>
</tr>
</tbody></table>

<?

}


if($_POST['report']==606)

{

$report="Bill Collection Report";

?>

	<table width="100%" border="0" cellpadding="2" cellspacing="0" style="font-size:12px !important">

		

		<thead>

		<tr><td colspan="12" style="border:0px;">

		<?

		echo '<div class="header">';

		echo '<h1>'.find_a_field('user_group','group_name','id='.$_SESSION['user']['group']).'</h1>';

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

		<th>S/L</th>

		<th>Customer Name</th>

		<th>Bill No </th>

		<th>Bill Submit Date</th>
		
		<th>Month/Year</th>
		
		<th>Submit By</th>
		
		<th>Discount</th>
		
		<th>Total Amount</th>
		
		<th>Status</th>
		
		<th>Receive Date</th>
		
		<th>Receive Amount</th>
		
		<th>Due Amount</th>
		
		<th>Receive By</th>

	</tr>

<? 
$rec='select j.tr_no,sum(j.cr_amt) as amt,j.jv_date,u.fname from journal j,user_activity_management u where j.entry_by=u.user_id and j.tr_from="BillReceive" group by j.tr_no';
$rquery=mysql_query($rec);
while($rRow=mysql_fetch_object($rquery)){

$ramt[$rRow->tr_no]=$rRow->amt;
$rentry[$rRow->tr_no]=$rRow->fname;
$rdate[$rRow->tr_no]=$rRow->jv_date;
}



if($_POST['f_date']!='' && $_POST['t_date']){

$con=' and b.bill_date between "'.$_POST['f_date'].'" and "'.$_POST['t_date'].'" ';

}
if($_POST['customer_id']>0){
$con .= ' and b.customer="'.$_POST['customer_id'].'"';
}
if($_POST['status']!=''){
$con .= ' and b.status="'.$_POST['status'].'"';
}







  $res='select  b.*,c.customer_name,u.fname from bill_info b,service_customer c,user_activity_management u where b.customer=c.customer_id and b.entry_by=u.user_id  '.$con.' group by b.bill_no';
$query = mysql_query($res);
$i=1;
while($data=mysql_fetch_object($query))

{

?>
	<tr>

	   <td><?=$i++?></td>
	   <td><?=$data->customer_name?></td>
	   <td><?=$data->manual_bill_no?></td>
	   <td><?=$data->bill_date?></td>
	   <td><?=date("F", strtotime('00-'.$data->mon.'-00'))."-".$data->year?></td>
	   <td><?=$data->fname?></td>
	   <td><?=$data->discount_amt?></td>
	   <td><?=$data->net_receivable_amt?></td>
	   <td><?=$data->status?></td>
	    <td><?=($ramt[$data->bill_no]!='')? $rdate[$data->bill_no] : ''?></td>
	   <td><?=$ramt[$data->bill_no]?></td>
	   <td><?=($ramt[$data->bill_no]!='')? $data->net_receivable_amt-$ramt[$data->bill_no] : ''?></td>
	   <td><?=($ramt[$data->bill_no]!='')? $rentry[$data->bill_no] : ''?></td>
	</tr>

<? }?>

	

</tbody></table>

<?

}




elseif(isset($sql)&&$sql!='') echo report_create($sql,1,$str);

?></div>

</body>

</html>