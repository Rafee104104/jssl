<?
require_once "../../../assets/template/layout.top.php";

date_default_timezone_set('Asia/Dhaka');
//echo $_REQUEST['report'];
if(isset($_REQUEST['submit'])&&isset($_REQUEST['report'])&&$_REQUEST['report']>0)
{
	if((strlen($_REQUEST['t_date'])==10))
	{
		$t_date=$_REQUEST['t_date'];
		$f_date=$_REQUEST['f_date'];
	}
	
if($_REQUEST['product_group']!='')  $product_group=$_REQUEST['product_group'];
if($_REQUEST['item_brand']!='') 	$item_brand=$_REQUEST['item_brand'];
if($_REQUEST['item_id']>0) 		    $item_id=$_REQUEST['item_id'];

if($_REQUEST['status']!='') 		$status=$_REQUEST['status'];


$item_info = find_all_field('item_info','','item_id='.$item_id);

if(isset($item_brand)) 			{$item_brand_con=' and i.item_brand="'.$item_brand.'"';} 
if(isset($dealer_code)) 		{$dealer_con=' and a.dealer_code="'.$dealer_code.'"';} 
 
if(isset($t_date)) 				{$to_date=$t_date; $fr_date=$f_date; $date_con=' and m.do_date between \''.$fr_date.'\' and \''.$to_date.'\'';}

if(isset($product_group)) {
if($product_group=='ABCDE') 
$pg_con=' and d.product_group!="M" and d.product_group!=""';
else $pg_con=' and d.product_group="'.$product_group.'"';
}


if($dealer_type!=''){
if($dealer_type=='MordernTrade')		{$dtype_con=$dealer_type_con = ' and ( d.dealer_type="Corporate" or  d.dealer_type="SuperShop" or  d.product_group="M") ';}
else 									{$dtype_con=$dealer_type_con = ' and d.dealer_type="'.$dealer_type.'"';}}
		
if(isset($dealer_code)) 		{$dealer_con=' and m.dealer_code='.$dealer_code;} 
if(isset($item_id))				{$item_con=' and i.item_id='.$item_id;} 
if(isset($depot_id)) 			{$depot_con=' and d.depot="'.$depot_id.'"';} 


switch ($_REQUEST['report']) {
    
    
case 101:
	$report="Direct Sales Chalan Report";
    if(isset($t_date)) {
        $date_con=' and m.oi_date between "'.$f_date.'" and "'.$t_date.'"';
    }	
	
break;


case 102:
	$report="Direct Sales Item wise Brief Report";
    if(isset($t_date)) {
        $date_con=' and m.oi_date between "'.$f_date.'" and "'.$t_date.'"';
    }
    
$sql='select i.item_id,i.finish_goods_code as fg_code,i.item_name,sum(qty) as total_qty,sum(amount) as amount
from item_info i, warehouse w, warehouse_ds_issue m, warehouse_ds_issue_detail d  
where d.oi_no=m.oi_no and d.item_id=i.item_id and w.warehouse_id=d.warehouse_id  and m.issue_type="Direct Sales"
and d.warehouse_id="'.$_SESSION['user']['depot'].'" 
'.$con.$date_con.' 
group by i.item_id order by i.item_name';    
	
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
    <style type="text/css" media="print">
      div.page
      {
        page-break-after: always;
        page-break-inside: avoid;
      }
    </style>
    <style type="text/css">
<!--
.style3 {color: #FFFFFF; font-weight: bold; }
.style5 {color: #FFFFFF}
-->
    </style>
</head>
<body>
<!--<div align="center" id="pr">
<input type="button" value="Print" onclick="hide();window.print();"/>
</div>-->
<div class="main">
<?
		$str 	.= '<div class="header">';
		if(isset($_SESSION['company_name'])) $str 	.= '<h1>MEP Group</h1>';
		//$str 	.= '<h1>'.$_SESSION['company_name'].'</h1>';
		if(isset($report)) 
		$str 	.= '<h2>'.$report.'</h2>';
		if(isset($dealer_code)) 
		$str 	.= '<h2>Dealer Name : '.$dealer_code.' - '.find_a_field('dealer_info','dealer_name_e','dealer_code='.$dealer_code).'</h2>';
		if(isset($depot_id)) 
		$str 	.= '<h2>Depot Name : '.find_a_field('warehouse','warehouse_name','warehouse_id='.$depot_id).'</h2>';
		if(isset($item_brand)) 
		$str 	.= '<h2>Item Brand : '.$item_brand.'</h2>';
		if(isset($item_info->item_id)) 
		$str 	.= '<h2>Item Name : '.$item_info->item_name.'('.$item_info->finish_goods_code.')'.'('.$item_info->sales_item_type.')'.'('.$item_info->item_brand.')'.'</h2>';
		if(isset($to_date)) 
		$str 	.= '<h2>Date Interval : '.$fr_date.' To '.$to_date.'</h2>';
		if(isset($product_group)) 
		$str 	.= '<h2>Product Group : '.$product_group.'</h2>';
		if(isset($region_id)) 
		$str 	.= '<h2>Region Name : '.find_a_field('branch','BRANCH_NAME','BRANCH_ID='.$region_id).'</h2>';
		if(isset($zone_id)) 
		$str 	.= '<h2>Zone Name: '.find_a_field('zon','ZONE_NAME','ZONE_CODE='.$zone_id).'</h2>';
		if(isset($area_id)) 
		$str 	.= '<h3>Area Name: '.find_a_field('area','AREA_NAME','AREA_CODE='.$area_id).'</h3>';		
		if(isset($dealer_type)) 
		$str 	.= '<h2>Dealer Type : '.$dealer_type.'</h2>';
		$str 	.= '</div>';
		$str 	.= '<div class="left" style="width:100%">';



if($_REQUEST['report']==101) { // do summery report modify jan 24 2018


 ?>
<table width="100%" cellspacing="0" cellpadding="2" border="0">
<thead><tr><td style="border:0px;" colspan="11"><?=$str?></td></tr>
<tr>
<th>S/L</th>
<th>Date</th>
<th>Sales No</th>
<th>Party</th><th>Mobile</th><th>Address</th>
<th>BIN</th><th>NID</th>
<th>Total Amt</th>
</tr>
</thead><tbody>

<?
$res='select m.oi_date,m.oi_no,m.vendor_id,sum(amount) as amount,m.customer_name,m.customer_mobile,m.customer_address,m.customer_bin,m.customer_nid
from item_info i, warehouse w, warehouse_ds_issue m, warehouse_ds_issue_detail d  
where d.oi_no=m.oi_no and d.item_id=i.item_id and w.warehouse_id=d.warehouse_id  and m.issue_type="Direct Sales"
and d.warehouse_id="'.$_SESSION['user']['depot'].'" and m.status in ("CHECKED")
'.$con.$date_con.' 
group by d.oi_no order by m.oi_date';
$query = mysql_query($res);
while($data=mysql_fetch_object($query)){
$s++;
?>
<tr>
    <td><?=$s?></td>
    <td><?=$data->oi_date?></td>
    <td><a href="chalan_view.php?v_no=<?=$data->oi_no?>" target="_blank"><?=$data->oi_no?></a></td>
    <td><?=$data->customer_name?></td>
    <td><?=$data->customer_mobile?></td>
    <td><?=$data->customer_address?></td>
    <td><?=$data->customer_bin?></td>
    <td><?=$data->customer_nid?></td>
    <td><?=$data->amount; $gamt+=$data->amount;?></td>
</tr>
<? } ?>
<tr class="footer">
<td style="text-align:right" colspan='8'>Total</td>
<td style="text-align:left"><?=number_format($gamt,2)?></td>
</tr>
</tbody>
</table>
<? }





elseif($_REQUEST['report']==2012) 
{ 
if(isset($dealer_code)) 
$sqlbranch 	= "select * from dealer_info where dealer_type like 'Distributor' and dealer_code = ".$dealer_code;
else
$sqlbranch 	= "select * from dealer_info where dealer_type like 'Distributor' ";
$querybranch = mysql_query($sqlbranch);
while($branch=mysql_fetch_object($querybranch)){
	$rp=0;
	echo '<div>';
	
$op_sql = "select sum(item_in-item_ex) as stock , warehouse_id, item_id from journal_item where warehouse_id = ".$branch->dealer_depo." group by item_id ";
$op_query= mysql_query($op_sql);
while($opqr = mysql_fetch_object($op_query)){
	$depo_op[$opqr->warehouse_id][$opqr->item_id] = $opqr->stock;
}

$op_sql1 = "select sum(total_unit) as stock , dealer_code, item_id from sale_do_chalan where dealer_code = ".$branch->dealer_code." and chalan_date<'".$_POST['f_date']."' group by item_id ";
$op_query1= mysql_query($op_sql1);
while($opqr1 = mysql_fetch_object($op_query1)){
	$depo_chalan[$opqr1->dealer_code][$opqr1->item_id] = $opqr1->stock;
}

 $op_sql2 = "select sum(total_unit) as stock , dealer_code, item_id from sale_do_chalan where dealer_code = ".$branch->dealer_code." and chalan_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' group by item_id ";
$op_query2= mysql_query($op_sql2);
while($opqr2 = mysql_fetch_object($op_query2)){
	 $chalan[$opqr2->dealer_code][$opqr2->item_id] = $opqr2->stock;
}
//if(isset($zone_id)) 
//$sqlzone 	= "select * from zon where REGION_ID=".$branch->BRANCH_ID." and ZONE_CODE=".$zone_id;
//else
// $sqlzone 	= "select * from zon where REGION_ID=".$branch->BRANCH_ID;
//
//	$queryzone = mysql_query($sqlzone);
//	while($zone=mysql_fetch_object($queryzone)){
if($area_id>0) 
$area_con = "and a.AREA_CODE=".$area_id;

$sql = "select i.item_id,i.finish_goods_code as code,i.item_name,i.item_brand,i.sales_item_type as `group`,
floor(sum(o.total_unit)/i.pack_size) as crt,
mod(sum(o.total_unit),i.pack_size) as pcs, 
sum(o.total_unit) as total_unit,
sum(o.total_amt) as DP,
sum(o.total_unit*o.t_price) as TP
from 
ss_do_master m,ss_do_details o, item_info i, warehouse w, dealer_info d, area a
where m.do_no=o.do_no and m.dealer_code=d.dealer_code and w.warehouse_id=d.depot and i.item_id=o.item_id and a.AREA_CODE=d.area_code 
and m.status in ('CHECKED','COMPLETED') and m.dealer_code=".$branch->dealer_code." and o.unit_price>0
".$date_con.$item_con.$item_brand_con.$pg_con.$area_con.' 
group by i.finish_goods_code';

 $sqlt="select sum(o.t_price*o.total_unit) as total,sum(total_amt) as dp_total, sum(total_unit) as unit_total
from 
ss_do_master m,ss_do_details o, item_info i, warehouse w, dealer_info d, area a
where m.do_no=o.do_no and m.dealer_code=d.dealer_code and w.warehouse_id=d.depot 
and i.item_id=o.item_id and a.AREA_CODE=d.area_code  and m.status in ('CHECKED','COMPLETED') 
and o.unit_price>0
and m.dealer_code=".$branch->dealer_code." ".$date_con.$item_con.$item_brand_con.$pg_con.$area_con.'';

		$queryt = mysql_query($sqlt);
		$t= mysql_fetch_object($queryt);
		if($t->dp_total>0)
		{
			if($rp==0) {$reg_total=0;$dp_total=0; 
			$str .= '<p style="width:100%"><strong>Dealer Name: '.$branch->dealer_name_e.' Dealer Code: '.$branch->dealer_code.' </strong></p>';$rp++;}
			$str .= '<p style="width:100%">Address: '.$branch->address_e. ' <strong>Mobile: </strong>'.$branch->mobile_no.' </p>';
		?>	
		
		<table width="100%" border="0" cellpadding="2" cellspacing="0">
		<thead>
			<tr>
				<td colspan="10" style="border:0px;"><div class="header">
				 <?=$str;?>
				</td>
			</tr>
			<tr>
				<th>S/L</th>
				<th>Code</th>
				<th>Item Name</th>
				<th>Item Brand</th>
				<th>Group</th>
				<th>Opening Stock</th>
				<th>Chalan Qty</th>
				<th>Total Stock</th>
				<th>Sales Qty</th>
				<th>Present Stock</th>
				<th>DP</th>
				<th>TP</th>
			</tr>
		</thead>
		<tbody>
		<?
		
			$unit_total1 = 0;
			$reg_total1  = 0;
			$dp_total1   = 0;
		
		 $squery=mysql_query($sql);
			$sl =1;
			while($res = mysql_fetch_object($squery)){ ?>
			<tr>
				<td><?=$sl++;?></td>
				<td align="center"><?=$res->code;?></td>
				<td><?=$res->item_name;?></td>
				<td><?=$res->item_brand;?></td>
				<td><?=$res->group;?></td>
				<td align="right"><?=$op_stock = ($depo_op[$branch->dealer_depo][$res->item_id]+$depo_chalan[$branch->dealer_code][$res->item_id]);?></td>
				<td align="right"><?=$chalan1 = $chalan[$branch->dealer_code][$res->item_id];?></td>
				<td align="right"><?=$stock=($op_stock+$chalan1);?></td>
				<td align="right"><?=$res->total_unit;?></td>
				<td align="right"><?=$present_stock = ($stock - $res->total_unit);?></td>
				<td align="right"><?=$res->DP;?></td>
				<td align="right"><?=$res->TP;?></td>
			</tr>
		 
		<?
		}
			//echo report_create($sql,1,$str);
			$str = '';
			
			$unit_total1 = $unit_total1+$t->unit_total;
			$reg_total1  = $reg_total1+$t->total;
			$dp_total1   = $dp_total1+$t->dp_total;
			
		}

	//}
?>
			<tr>
				<td></td>
				<td colspan="7" align="right">Total:</td>
				<td align="right"><strong><?=number_format($unit_total1,2);?></strong></td>
				<td align="right"></td>
				<td align="right"><strong><?=number_format($dp_total1,2);?></strong></td>
				<td align="right"><strong><?=number_format($reg_total1,2);?></strong></td>
			</tr>
		  </tbody>
</table>
<?	
}
}


elseif(isset($sql)&&$sql!='') {echo report_create($sql,1,$str);}
?>
</div>
</body>
</html>