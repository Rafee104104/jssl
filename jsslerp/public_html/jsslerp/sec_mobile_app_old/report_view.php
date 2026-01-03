<?php
session_start();
include 'config/access.php';
include 'config/db.php';
include 'config/function.php';

$user_id	=$_SESSION['user_id'];
$emp_code	=$_SESSION['username'];
$product_group =$_SESSION['product_group'];
$page       ="report_list";
?>




<?		
if(isset($_REQUEST['submit'])&&isset($_REQUEST['report'])&&$_REQUEST['report']>0){

		
	$f_date=$_REQUEST['f_date'];
	$t_date=$_REQUEST['t_date'];

	
	if($_POST['warehouse_id']>0) 		$warehouse_id   =$_POST['warehouse_id'];
	if($_REQUEST['item_id']>0) 			$item_id        =$_REQUEST['item_id'];
	
	
	if($_POST['order_type']!='') 		$order_type     =$_POST['order_type'];
	
	if($_POST['issue_status']!='') 		$issue_status   =$_POST['issue_status'];
	if($_POST['item_sub_group']>0) 		$sub_group_id   =$_POST['item_sub_group'];
	if($_POST['item_brand']>0) 			$item_brand     =$_POST['item_brand'];



switch ($_POST['report']) {


case 101:
$report='Target Vs Sales Report';
break;

case 104:
$report='Dealer Stock Report';
break;


case 105:
$report='Shop List';
break;


case 201:
$report="Opening Stock Entry Report";
break;





}}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Report</title>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 4px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<script src="assets/js/vendors/jquery-3.6.0.min.js"></script>
<script src="assets/js/vendors/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  
</head>

<body>

<div class="row">
    <div class="col-12">
        <!--<div class="card">-->
        <!--    <div class="card-body">-->


<?php
		$str 	.= '<div class="header">';
// 		$str 	.= '<h1>'.find_a_field('warehouse','warehouse_name','warehouse_id='.$_SESSION['user']['depot']).'</h1>';
		
		if(isset($report)) $str 	.= '<center><h3>'.$report.'</h3>';
		
		if(isset($t_date)) $str 	.= '<h6>Date Interval: '.$f_date.' To '.$t_date.'</h6>';
		
		
		
		if(isset($item_id)) { $item_name = find1("select name from product where id='".$item_id."'");
		$str 	.= '<p>Item Name: '.$item_id.'-'.$item_name.'</p>';
		}
		
		$str.='<div align="right">Reporting Time: '.date("h:i A d-m-Y").'</div>';
		
?>
<a href="report_list.php">Report List</a> <a href="home.php">Home Page</a>



<?


if($_REQUEST['report']==101) {
$report="Sales Report";

if($_POST['source']!=''){$source = $_POST['source'];}
if($_POST['dealer_code']!=''){$shop_con = "and c.dealer_code='".$_POST['dealer_code']."'"; }

if(isset($t_date)) {
$date_con=' and c.chalan_date between \''.$f_date.'\' and \''.$t_date.'\'';

$year = date("Y",strtotime($t_date));
$mon = date("m",strtotime($t_date));
}
//if($_POST['offer_name']) {$offer_con=" and a.offer_name='".$_POST['offer_name']."'";}


// item wise target
$tc = "select target_con from ss_target_ratio where emp_code='".$emp_code."' and target_year='".$year."' and target_month='".$mon."' ";
$target_con = find1($tc);
if($target_con<1){ $target_con=100;}


//$dealer_code = find1("select master_dealer_code from ss_shop where emp_code='".$emp_code."' and status=1");
$dealer_code	=$_SESSION['warehouse_id'];



// item wise target
$sql_target="select t.item_id,t.target_ctn,target_amount,i.pack_size 
from sale_target_upload t, item_info i where i.item_id=t.item_id 
and target_year='".$year."' and target_month='".$mon."' and dealer_code='".$dealer_code."'";
$query1 = mysqli_query($conn, $sql_target);
while($info=mysqli_fetch_object($query1)){
$target_qty[$info->item_id]=(($info->target_ctn*$info->pack_size)*$target_con)/100;
$target_amt[$info->item_id]=($info->target_amount*$target_con)/100;
}





// item wise sales
$sql_item='select i.item_id,i.finish_goods_code as code,i.item_name,sum(c.total_unit) as qty,sum(c.total_amt) as amount
from item_info i, ss_do_chalan c
where c.item_id=i.item_id
'.$date_con.' and c.entry_by="'.$emp_code.'"
'.$shop_con.'
group by i.item_id
order by i.finish_goods_code,i.item_name';
$query2 = mysqli_query($conn, $sql_item);
while($info2=mysqli_fetch_object($query2)){
$sales_qty[$info2->item_id]=$info2->qty;
$sales_amt[$info2->item_id]=$info2->amount;
}



$res="select i.* from item_info i where 1 order by finish_goods_code";
$query = mysqli_query($conn, $res);
?>
<?=$str?>
<table width="100%" cellspacing="0" cellpadding="2"  border="0">
<tr>
<th>S/L</th>
<th>FG Code</th>
<th>Item Name</th>
<th>Target Qty</th>
<th>Target Amount</th>
<th>Sales Qty</th>
<th>Sales Amount</th>
<th>ShortFall</th>
<th>Achivement</th>
</tr>
<? 
while($data=mysqli_fetch_object($query)){
if($target_qty[$data->item_id]>0 || $sales_qty[$data->item_id]>0){
$s++;
?>
<tr>
  <td><?=$s?></td>
  <td><?=$data->finish_goods_code?></td>
  <td><?=$data->item_name?></td>
  <td><?=(int)$target_qty[$data->item_id];?></td>
  <td><?=(int)$target_amt[$data->item_id]; $gtarget +=$target_amt[$data->item_id];?></td>
  <td><?=(int)$sales_qty[$data->item_id];?></td>
  <td><?=(int)$sales_amt[$data->item_id]; $gsales +=$sales_amt[$data->item_id];?></td>
  <td><? $sfall=(int)($sales_qty[$data->item_id]-$target_qty[$data->item_id]); $gsfall+=$sfall;
  	if($sfall<0){ ?> <span style="color:red; font-weight: bold;"><?=$sfall;?> <? }else{ echo $sfall;} ?>
</td>
  <td><?
$ratio = (($sales_amt[$data->item_id]*100)/$target_amt[$data->item_id]);
if($ratio<>0) {echo number_format($ratio,2); } 
  ?></td>
  </tr>
<? }} ?>
<tr>
<td></td><td></td><td>Total</td><td><? //=$gqty?></td><td><?=(int)$gtarget?></td>
<td></td><td><?=(int)$gsales?></td>
<td><?=number_format($gsfall,0);?></td>
<?
$gratio = (($gsales*100)/$gtarget);
?>
<td><?=number_format($gratio,2);?></td>
</tr>
</table>
<? 
} // end report 101




elseif($_REQUEST['report']==105) {
$report="Shop List";

$shop_code=$_GET['code'];
if($_GET['code']!=''){
    $shop_con=' and dealer_code="'.$shop_code.'"';
}

?>
<?=$str?>
<table width="100%" cellspacing="0" cellpadding="2"  border="0">
<tr>
<th>S/L</th>
<th>Shop Code</th>
<th>Shop Name</th>
<th>Address</th>
<th>SO Code</th>

<th>Owner Name</th>
<th>Owner Mobile</th>
<th>Manager Name</th>
<th>Manager Mobile</th>

<th>Class</th>
<th>Type</th>
<th>Channel</th>
<th>Route Type</th>
<th>Shop Identity</th>

<th>Image</th>
</tr>
<? 
$res="select * from ss_shop where entry_by='".$_SESSION['username']."' order by dealer_code desc";
$query = mysqli_query($conn, $res);
while($data=mysqli_fetch_object($query)){
$s++;
?>
<tr>
<td><?=$s?></td>
<td><?=$data->dealer_code?></td>
<td><?=$data->shop_name?></td>
<td><?=$data->shop_address?></td>
<td><?=$data->emp_code?></td>
  
<td><?=$data->shop_owner_name?></td>  
<td><?=$data->mobile?></td>
<td><?=$data->manager_name?></td>  
<td><?=$data->manager_mobile?></td>  

<td><?=$data->shop_class?></td>
<td><?=$data->shop_type?></td>
<td><?=$data->shop_channel?></td>
<td><?=$data->shop_route_type?></td>
<td><?=$data->shop_identity?></td>
<td><? if($data->picture!=''){ ?><a href="../sec_mobile_app/<?=$data->picture?>" target="_blank">View</a><? } ?></td>
</tr>
<? } ?>
</table>
<? 
} // 




// dealer stock report
elseif($_REQUEST['report']==104) {

//$dealer_code = find1("select master_dealer_code from ss_shop where emp_code='".$emp_code."' and status=1");
$dealer_code	=$_SESSION['warehouse_id'];

if(isset($t_date)) {
$date_con=' and c.chalan_date between \''.$f_date.'\' and \''.$t_date.'\'';

$year = date("Y",strtotime($t_date));
$mon = date("m",strtotime($t_date));
}


$sql="select * from item_category where 1";
$query=mysqli_query($conn,$sql);
while($info1=mysqli_fetch_object($query)){
    $cat_name[$info1->id]=$info1->category_name;
}


$sql2="select * from item_subcategory where 1";
$query2=mysqli_query($conn,$sql2);
while($info2=mysqli_fetch_object($query2)){
    $subcat_name[$info2->id]=$info2->subcategory_name;
}




//$opening_date = find1("select max(ji_date) from ss_journal_item where tr_from='".Opening."' and warehouse_id='".$dealer_code."' ");
//if($opening_date=='') {
    $opening_date='2021-08-01';
//}

$sql_in="select item_id, sum(total_unit) as qty 
from sale_do_chalan 
where chalan_date>='".$opening_date."' and dealer_code='".$dealer_code."' group by item_id";
$query1 = mysqli_query($conn,$sql_in);
while($info1=mysqli_fetch_object($query1)){
$item_in[$info1->item_id]=$info1->qty;
}


$sql2="select item_id,sum(item_in-item_ex) as qty
from ss_journal_item
where warehouse_id='".$dealer_code."' and ji_date>='".$opening_date."'
group by item_id";
$query2 = mysqli_query($conn,$sql2);
while($info2=mysqli_fetch_object($query2)){
$item_ss[$info2->item_id]=$info2->qty;
}


?>
<?=$str?>
<table width="100%" cellspacing="0" cellpadding="2"  border="0">
<tr>
<th>S/L</th>
<th>Category</th>
<th>SubCat</th>
<th>FG Code</th>
<th>Item Name</th>
<th>Stock Qty(Pcs)</th>
<th>Stock Amount</th>
</tr>
<? 
 $sql_list="select category_id,subcategory_id,item_id,finish_goods_code as code,item_name,pack_size,t_price from item_info where 1 order by category_id,subcategory_id";
$query = mysqli_query($conn,$sql_list);
while($data=mysqli_fetch_object($query)){


$qty = ($item_ss[$data->item_id]+$item_in[$data->item_id]);
if($qty<>0){
$s++;
?>
<tr>
  <td><?=$s?></td>
  <td><?=$cat_name[$data->category_id]?></td>
  <td><?=$subcat_name[$data->subcategory_id]?></td>
  <td><?=$data->code?></td>
  <td><?=$data->item_name?></td>
  <td><? $qty= (int)$qty;
  if($qty<0){ ?> <span style="color:red; font-weight: bold;"><?=$qty;?> <? }else{ echo $qty;} ?>
</td>
<td><?=(int)$amt=($qty*$data->t_price); $gamt +=$amt;?></td>
</tr>
<? 
$qty=0;
}} ?>
<tr>
<td></td><td></td><td></td><td></td><td></td><td>Total</td>
<td><?=number_format($gamt,2);?></td>
</tr>
</table>
<? 
} // end report 104



elseif($_REQUEST['report']==102) {
$report="Target/Primary DO Report";

if($_POST['source']!=''){$source = $_POST['source'];}


if(isset($t_date)) {
$date_con=' and c.chalan_date between \''.$f_date.'\' and \''.$t_date.'\'';

$year = date("Y",strtotime($t_date));
$mon = date("m",strtotime($t_date));
}
//if($_POST['offer_name']) {$offer_con=" and a.offer_name='".$_POST['offer_name']."'";}


// item wise target
if($source=='SO'){
$tc = "select target_con from ss_target_ratio where emp_code='".$emp_code."' and target_year='".$year."' and target_month='".$mon."' ";
$target_con = find1($tc);
if($target_con<1){ $target_con=100;}

if($_SESSION['dsr_login']=='YES'){
$dealer_code = $emp_code;
}else{
$dealer_code = find1("select master_dealer_code from ss_shop where emp_code='".$emp_code."' and status=1");
}

$sql_target="select t.item_id,t.target_ctn,target_amount,i.pack_size 
from sale_target_upload t, item_info i where i.item_id=t.item_id 
and target_year='".$year."' and target_month='".$mon."' and dealer_code='".$dealer_code."'";
$query1 = mysqli_query($conn, $sql_target);
	while($info=mysqli_fetch_object($query1)){
	$target_qty[$info->item_id]=(($info->target_ctn)*$target_con)/100;
	$target_amt[$info->item_id]=($info->target_amount*$target_con)/100;
	}
}else{
if($_SESSION['dsr_login']=='YES'){
$dealer_code = $emp_code;
}else{
$dealer_code = find1("select master_dealer_code from ss_shop where emp_code='".$emp_code."' and status=1");
}
$sql_target="select t.item_id,t.target_ctn,target_amount,i.pack_size 
from sale_target_upload t, item_info i 
where i.item_id=t.item_id 
and target_year='".$year."' and target_month='".$mon."' and dealer_code='".$dealer_code."'";
$query1 = mysqli_query($conn, $sql_target);
	while($info=mysqli_fetch_object($query1)){
	$target_qty[$info->item_id]=$info->target_ctn;
	$target_amt[$info->item_id]=$info->target_amount;
	}
}


// find out dealer info
if($source=='SO'){

if($_SESSION['dsr_login']=='YES'){
$dealer_code = $emp_code;
}else{
$dealer_code = find1("select master_dealer_code from ss_shop where emp_code='".$emp_code."' and status=1");
}

echo '<br>dealer_code='.$dealer_code;

echo '<br>ss_dealer_delivery='.$dealer_delivery = find1("select sum(d.total_amt) from ss_do_chalan d, ss_shop s 
where s.dealer_code=d.dealer_code and d.chalan_date between '".$f_date."' and '".$t_date."' and master_dealer_code='".$dealer_code."' and s.status=1");

echo '<br>ss_emp_delivery='.$emp_delivery = find1("select sum(d.total_amt) from ss_do_chalan d, ss_shop s 
where s.dealer_code=d.dealer_code and d.chalan_date between '".$f_date."' and '".$t_date."' and emp_code='".$emp_code."'  and s.status=1");
echo '<br>con_per='.$con_per = number_format(($emp_delivery/$dealer_delivery)*100,2,'.','');
echo '<br>';
}


// item wise Primary DO
if($source=='SO'){
$sql_item='select i.item_id,i.finish_goods_code as code,i.item_name,sum(d.total_unit/i.pack_size) as qty,sum(d.total_amt) as amount
from item_info i, sale_do_details d, sale_do_master m
where d.item_id=i.item_id and m.do_no=d.do_no
and m.do_date between "'.$f_date.'" and "'.$t_date.'" 
and m.dealer_code="'.$dealer_code.'"
and m.status in("CHECKED","COMPLETED") and d.unit_price>0
group by i.item_id
order by i.finish_goods_code,i.item_name';
$query2 = mysqli_query($conn, $sql_item);
while($info2=mysqli_fetch_object($query2)){
	$do_qty[$info2->item_id]=(int)($info2->qty*$con_per)/100;
	$do_amt[$info2->item_id]=(int)($info2->amount*$con_per)/100;
	}
}else{ // party
$sql_item='select i.item_id,i.finish_goods_code as code,i.item_name,sum(d.total_unit/i.pack_size) as qty,sum(d.total_amt) as amount
from item_info i, sale_do_details d, sale_do_master m
where d.item_id=i.item_id and m.do_no=d.do_no
and m.do_date between "'.$f_date.'" and "'.$t_date.'" 
and m.dealer_code="'.$dealer_code.'"
and m.status in("CHECKED","COMPLETED") and d.unit_price>0
group by i.item_id
order by i.finish_goods_code,i.item_name';
$query2 = mysqli_query($conn, $sql_item);
while($info2=mysqli_fetch_object($query2)){
	$do_qty[$info2->item_id]=(int)$info2->qty;
	$do_amt[$info2->item_id]=(int)$info2->amount;
	}
}


$res="select i.* from item_info i where 1 order by finish_goods_code";
$query = mysqli_query($conn, $res);
?>
<?=$str?>
<table width="100%" cellspacing="0" cellpadding="2"  border="0">
<tr>
<th>S/L</th>
<th>FG Code</th>
<th>Item Name</th>
<th>Target Qty</th>
<th>Target Amount</th>
<th>DO Qty</th>
<th>DO Amount</th>
<th>ShortFall Qty</th>
<th>Achivement</th>
</tr>
<? 
while($data=mysqli_fetch_object($query)){
if($target_qty[$data->item_id]>0 || $do_qty[$data->item_id]>0){
$s++;
?>
<tr>
  <td><?=$s?></td>
  <td><?=$data->finish_goods_code?></td>
  <td><?=$data->item_name?></td>
  <td><?=(int)$target_qty[$data->item_id];?></td>
  <td><?=(int)$target_amt[$data->item_id]; $gtarget +=$target_amt[$data->item_id];?></td>
  <td><?=(int)$do_qty[$data->item_id];?></td>
  <td><?=(int)$do_amt[$data->item_id]; $gdo_amt +=$do_amt[$data->item_id];?></td>
  <td><? $sfall=(int)($target_qty[$data->item_id]-$do_qty[$data->item_id]); 
  if($sfall<0){ ?> <span style="color:red; font-weight: bold;"><?=$sfall;?> <? }else{ echo $sfall;}
  ?>
 
</td>
  <td><?
$ratio = (($do_amt[$data->item_id]*100)/$target_amt[$data->item_id]);
if($ratio<>0) {echo number_format($ratio,2); } 
  ?></td>
  </tr>
<? }} ?>
<tr>
<td></td><td></td><td><strong>Total</strong></td><td><? //=$gqty?></td>
<td><strong><?=(int)$gtarget?></strong></td>
<td></td>
<td><strong><?=(int)$gdo_amt?></strong></td>
<td><span style="color:red"><strong><?=(int)($gdo_amt-$gtarget);?></strong></span></td>

<? $gratio = (($gdo_amt*100)/$gtarget);?>
<td><strong><?=number_format($gratio,2);?>%</strong></td>
</tr>
</table>
<? 
} // end report 102







elseif($_REQUEST['report']==103) {
$report="Target/Primary Chalan Report";

if($_POST['source']!=''){$source = $_POST['source'];}


if(isset($t_date)) {
$date_con=' and c.chalan_date between \''.$f_date.'\' and \''.$t_date.'\'';

$year = date("Y",strtotime($t_date));
$mon = date("m",strtotime($t_date));
}
//if($_POST['offer_name']) {$offer_con=" and a.offer_name='".$_POST['offer_name']."'";}

// item wise target
if($source=='SO'){
$tc = "select target_con from ss_target_ratio where emp_code='".$emp_code."' and target_year='".$year."' and target_month='".$mon."' ";
$target_con = find1($tc);
if($target_con<1){ $target_con=100;}

if($_SESSION['dsr_login']=='YES'){
$dealer_code = $emp_code;
}else{
$dealer_code = find1("select master_dealer_code from ss_shop where emp_code='".$emp_code."' and status=1");
}


$sql_target="select t.item_id,t.target_ctn,target_amount,i.pack_size 
from sale_target_upload t, item_info i where i.item_id=t.item_id 
and target_year='".$year."' and target_month='".$mon."' and dealer_code='".$dealer_code."'";
$query1 = mysqli_query($conn, $sql_target);
	while($info=mysqli_fetch_object($query1)){
	$target_qty[$info->item_id]=(($info->target_ctn)*$target_con)/100;
	$target_amt[$info->item_id]=($info->target_amount*$target_con)/100;
	}
}else{

if($_SESSION['dsr_login']=='YES'){
$dealer_code = $emp_code;
}else{
$dealer_code = find1("select master_dealer_code from ss_shop where emp_code='".$emp_code."' and status=1");
}

$sql_target="select t.item_id,t.target_ctn,target_amount,i.pack_size 
from sale_target_upload t, item_info i where i.item_id=t.item_id 
and target_year='".$year."' and target_month='".$mon."' and dealer_code='".$dealer_code."'";
$query1 = mysqli_query($conn, $sql_target);
	while($info=mysqli_fetch_object($query1)){
	$target_qty[$info->item_id]=$info->target_ctn;
	$target_amt[$info->item_id]=$info->target_amount;
	}
}

// find out dealer info
if($source=='SO'){

if($_SESSION['dsr_login']=='YES'){
$dealer_code = $emp_code;
}else{
$dealer_code = find1("select master_dealer_code from ss_shop where emp_code='".$emp_code."' and status=1");
}

echo '<br>dealer_code='.$dealer_code;

echo '<br>ss_dealer_delivery='.$dealer_delivery = find1("select sum(d.total_amt) from ss_do_chalan d, ss_shop s 
where s.dealer_code=d.dealer_code and d.chalan_date between '".$f_date."' and '".$t_date."' and master_dealer_code='".$dealer_code."' and s.status=1");

echo '<br>ss_emp_delivery='.$emp_delivery = find1("select sum(d.total_amt) from ss_do_chalan d, ss_shop s 
where s.dealer_code=d.dealer_code and d.chalan_date between '".$f_date."' and '".$t_date."' and emp_code='".$emp_code."'  and s.status=1");
echo '<br>con_per='.$con_per = number_format(($emp_delivery/$dealer_delivery)*100,2,'.','');
echo '<br>';
}

// item wise Primary Chalan
if($source=='SO'){
$sql_item='select i.item_id,i.finish_goods_code as code,i.item_name,sum(c.total_unit/i.pack_size) as qty,sum(c.total_amt) as amount
from item_info i, sale_do_chalan c
where c.item_id=i.item_id
and c.chalan_date between "'.$f_date.'" and "'.$t_date.'" and c.unit_price>0
and c.dealer_code="'.$dealer_code.'"
group by i.item_id
order by i.finish_goods_code,i.item_name';
$query2 = mysqli_query($conn, $sql_item);
	while($info2=mysqli_fetch_object($query2)){
	$do_qty[$info2->item_id]=(int)($info2->qty*$con_per)/100;
	$do_amt[$info2->item_id]=(int)($info2->amount*$con_per)/100;
	}
}else{
$sql_item='select i.item_id,i.finish_goods_code as code,i.item_name,sum(c.total_unit/i.pack_size) as qty,sum(c.total_amt) as amount
from item_info i, sale_do_chalan c
where c.item_id=i.item_id
and c.chalan_date between "'.$f_date.'" and "'.$t_date.'" and c.unit_price>0
and c.dealer_code="'.$dealer_code.'"
group by i.item_id
order by i.finish_goods_code,i.item_name';
$query2 = mysqli_query($conn, $sql_item);
	while($info2=mysqli_fetch_object($query2)){
	$do_qty[$info2->item_id]=(int)($info2->qty);
	$do_amt[$info2->item_id]=(int)($info2->amount);
	}
}	


$res="select i.* from item_info i where 1 order by finish_goods_code";
$query = mysqli_query($conn, $res);
?>
<?=$str?>
<table width="100%" cellspacing="0" cellpadding="2"  border="0">
<tr>
<th>S/L</th>
<th>FG Code</th>
<th>Item Name</th>
<th>Target Qty</th>
<th>Target Amount</th>
<th>Chalan Qty</th>
<th>Chalan Amount</th>
<th>ShortFall Qty</th>
<th>Achivement</th>
</tr>
<? 
while($data=mysqli_fetch_object($query)){
if($target_qty[$data->item_id]>0 || $do_qty[$data->item_id]>0){
$s++;
?>
<tr>
  <td><?=$s?></td>
  <td><?=$data->finish_goods_code?></td>
  <td><?=$data->item_name?></td>
  <td><?=(int)$target_qty[$data->item_id];?></td>
  <td><?=(int)$target_amt[$data->item_id]; $gtarget +=$target_amt[$data->item_id];?></td>
  <td><?=(int)$do_qty[$data->item_id];?></td>
  <td><?=(int)$do_amt[$data->item_id]; $gdo_amt +=$do_amt[$data->item_id];?></td>
  <td><? $sfall=(int)($target_qty[$data->item_id]-$do_qty[$data->item_id]); 
  if($sfall<0){ ?> <span style="color:red; font-weight: bold;"><?=$sfall;?> <? }else{ echo $sfall;}
  ?></td>
  <td><?
$ratio = (($do_amt[$data->item_id]*100)/$target_amt[$data->item_id]);
if($ratio<>0) {echo number_format($ratio,2); } 
  ?></td>
  </tr>
<? }} ?>
<tr>
<td></td><td></td><td>Total</td><td><? //=$gqty?></td><td><?=(int)$gtarget?></td>
<td></td><td><?=(int)$gdo_amt?></td>
<td><span style="color:red"><?=(int)($gdo_amt-$gtarget);?></span></td>
<?
$gratio = (($gdo_amt*100)/$gtarget);
?>
<td><?=number_format($gratio,2);?>%</td>
</tr>
</table>
<? 
} // end report 103




elseif($_REQUEST['report']==201){
    
?>
<?=$str?>
<table width="100%" cellspacing="0" cellpadding="2"  border="0">
<tr>
<th>S/L</th>
<th>Date</th>
<th>FG Code</th>
<th>Item Name</th>
<th>Qty(Pcs)</th>
<th>TP Amount</th>
</tr>
<? 
$sql_list="select i.finish_goods_code as code,i.item_id,i.item_name,i.t_price,j.*
from item_info i, ss_journal_item j 
where i.item_id=j.item_id and j.ji_date between '".$f_date."' and  '".$t_date."' and warehouse_id='".$_SESSION['warehouse_id']."' and tr_from='Opening'
";
$query = mysqli_query($conn,$sql_list);
while($data=mysqli_fetch_object($query)){
$s++;
?>
<tr>
  <td><?=$s?></td>
  <td><?=$data->ji_date?></td>
  <td><?=$data->code?></td>
  <td><?=$data->item_name?></td>
  <td><?=$data->item_in?></td>
  <td><?=(int)$amt=($data->item_in*$data->t_price); $gamt +=$amt;?></td>
  </tr>
<?  } ?>
<tr>
<td></td><td></td><td></td><td></td><td>Total</td>
<td><?=number_format($gamt,2);?></td>
</tr>
</table>
<? 
} // end



elseif($_POST['report']==201) {
$report ='Item Stock Report';

if($_REQUEST['item_id']>0){ 
$item_id = $_REQUEST['item_id'];
$item_con = ' and i.id="'.$item_id.'"';
}
if($_POST['warehouse_id']) {$w_con=" and j.warehouse_id='".$warehouse_id."'";}


?>
<center><h3 class="card-title"><?=$report?></h3></center><div align="right">Reporting Time:<?=date("h:i A d-m-Y")?></div>

<table class="table table-striped table_report_all2">
<thead>
    <tr>
      <th>S/L</th>
      <th>Item Company</th>
      <th>Code</th>
      <th>Name</th>
      <th>Stock Qty</th>
      <th>Price</th>
      <th>Stock Amount</th>
    </tr>
  </thead>
  <tbody>
<?php
$sql2='select i.item_company,i.id as code, i.name,sum(j.item_in-j.item_ex) as stock,i.cost as price
FROM product i, journal_item j
where i.id=j.item_id and i.type not in ("Discount")
'.$item_con.$w_con.'
group by i.id
order by i.name';
$query= mysqli_query($conn, $sql2);
while($data=mysqli_fetch_object($query)){
$j++;
?>
    <tr>
      <td><?=$j?></td>
      <td><?=$data->item_company?></td>
      <td><?=$data->code?></td>
      <td><?=$data->name?></td>
      <td><?php echo $stock = (int)$data->stock; $gstock+=$data->stock;?></td>
      <td><?=$data->price;?></td>
      <td><? echo $amount = ($data->price*$data->stock); $gamount +=$amount;?></td>
    </tr>
<?php
} // end while
		
?>
    <tr>
      <td></td><td></td><td></td>
      <td><strong>Total</strong></td>
      <td><strong><?=$gstock;?></strong></td><td></td>
      <td><strong><?=$gamount;?></strong></td>
    </tr>
  </tbody>
</table>

<?php
}


elseif($_REQUEST['report']==204) {
$report ='Item Transection Report';

if($_REQUEST['item_id']!=''){ 
    
$item_id = $_REQUEST['item_id'];

if(isset($t_date)) {$to_date=$t_date; $fr_date=$f_date;  
$date_con=' and j.ji_date between \''.$fr_date.'\' and \''.$to_date.'\'';
}
if($_POST['warehouse_id']) { $w_con=" and j.warehouse_id='".$warehouse_id."'";}

?>
<center>
<h2><?=$company_name;?></h2>
<h3>Item Transection Report</h3>
<h5>Date Interval: <?=$_REQUEST['f_date'];?> to <?=$_REQUEST['t_date'];?></h5>
<h6>Item Name: <?php echo $item_id?>-<?php echo find1("select name from product where id='".$item_id."'");?></h6>
<div align="right">Reporting Time:<?=date("h:i A d-m-Y")?></div>
<div class="table-responsive">
<table class="table table-striped table-bordered">
<thead>
    <tr>
      <th>S/L</th>
      <th>Date</th>
      <th>Code </th>
      <th>Name</th><th>Tr NO</th><th>Type</th>
      <th>IN</th>
      <th>OUT</th>
      <th>Rate</th><th>Amount</th>
      <th>Entry At</th>
    </tr>
  </thead>
  <tbody>

<?php
$sql='SELECT j.ji_date,i.id,i.name,j.tr_from as type,j.item_in as item_in,j.item_ex as item_out,j.entry_at,j.sr_no,j.item_price
FROM journal_item j, product i
where j.item_id=i.id and i.id="'.$item_id.'"
'.$date_con.$w_con.'
order by j.ji_date';
$query= mysqli_query($conn, $sql);
while($data=mysqli_fetch_object($query)){
$j++;
?>
    <tr>
      <td><?=$j?></td>
      <td><?=$data->ji_date?></td>
      <td><?=$data->id?></td><td><?=$data->name?></td>
      <td><?=$data->sr_no?></td>
      <td><?=$data->type?></td>
      <td><?=(int)$data->item_in?></td>
      <td><?=(int)$data->item_out?></td>
      <td><?=$data->item_price?></td>
      <td><?=($data->item_price*($data->item_in+$data->item_out));?></td>
      <td><?=$data->entry_at?></td>
      
    </tr>
<?php
$g_in += $data->item_in;
$g_out += $data->item_out;
} // end while
?>
    <tr>
      <td></td><td></td>
      <td></td><td></td>
      <td></td><td><b>Total</b></td>
      <td><b><?=(int)$g_in?></b></td><td><b><?=(int)$g_out?></b></td>
      <td></td>
    </tr>
  </tbody>
</table></div>

<?php
}else{ die('Please select item for this report. Thanks');}
}




elseif($_POST['report']==205) {
//$str='Item wise Profit Report';

if(isset($t_date)) { $date_con=' and w.oi_date between "'.$f_date.'" and "'.$t_date.'"';}
if(isset($item_id)) { $item_id_con=' and i.id="'.$item_id.'"'; }
if($_POST['warehouse_id']) {$w_con=" and w.warehouse_id='".$warehouse_id."'";}

?>
<center>
<?=$str?>  
<!--<h3 class="card-title"><?=$str?></h3>-->
<!--<div align="right">Reporting Time:<?=date("h:i A d-m-Y")?></div>-->
<div class="table-responsive">
<table class="table table-striped table-bordered" id="table_report2">
<thead>
    <tr>
      <th>S/L</th><th>Date</th><th>Sales NO</th>
      <th>Item Company </th>
      <th>Code </th>
      <th>Name</th>
      <th>Sales Qty</th><th>Cost rate</th><th>Cost amount</th><th>Sales price</th><th>Sales amount</th><th>Profit</th>
    </tr>
  </thead>
  <tbody>
<?php
$sql='SELECT w.oi_date,w.oi_no,i.item_company, i.id as code, i.name, w.qty as sales_qty, w.cost_rate, 
(w.qty*w.cost_rate) as cost_amount, w.rate as sales_price,(w.qty*w.rate) as sales_amount,
((w.qty*w.rate) - (w.qty*w.cost_rate)) as profit

FROM product i, warehouse_other_issue_detail w
where i.id=w.item_id and w.issue_type="Sales"
'.$item_id_con.$date_con.$w_con.'
order by w.oi_date';

$query= mysqli_query($conn, $sql);
while($data=mysqli_fetch_object($query)){
$j++;
?>
    <tr>
      <td><?=$j?></td>
      <td><?=$data->oi_date?></td>
      <td><?=$data->oi_no?></td>
      <td><?=$data->item_company?></td>
      <td><?=$data->code?></td>
      <td><?=$data->name?></td>
      <td><?php echo $data->sales_qty?></td>
      <td><?php echo $data->cost_rate?></td>
      <td><?php echo round($data->cost_amount,2); $gcost +=$data->cost_amount;?></td>
      <td><?php echo $data->sales_price?></td>
      <td><?php echo round($data->sales_amount,2); $gsales += $data->sales_amount;?></td>
      <td><?php echo round($data->profit,2); $gprofit += $data->profit;?></td>
      
    </tr>
<?php
} // end while
		
?>
    <tr>
      <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
      <td><strong>Total</strong></td>
      <td><strong><?=round($gcost,2)?></strong></td>
      <td></td>
      <td><strong><?=round($gsales,2)?></strong></td>
      <td><strong><?=round($gprofit,2)?></strong></td>
    </tr>
  </tbody>
</table></div>

<?php
}




elseif($_POST['report']==206) {

if(isset($t_date)) { $date_con=' and w.oi_date between "'.$f_date.'" and "'.$t_date.'"';}
if(isset($item_id)) { $item_id_con=' and i.id="'.$item_id.'"'; }
if($_POST['warehouse_id']) {$w_con=" and w.warehouse_id='".$warehouse_id."'";}

?>
<center>
<?=$str?>  
<!--<h3 class="card-title"><?=$str?></h3>-->
<!--<div align="right">Reporting Time:<?=date("h:i A d-m-Y")?></div>-->
<div class="table-responsive">
<table class="table table-striped table-bordered" id="table_report2">
<thead>
    <tr>
      <th>S/L</th>
      <th>Item Company</th><th>Cost amount</th><th>Sales amount</th><th>Profit</th>
    </tr>
  </thead>
  <tbody>
<?php
$sql='SELECT w.vendor_id,i.item_company, sum(w.qty*w.cost_rate) as cost_amount, sum(w.qty*w.rate) as sales_amount
FROM product i, warehouse_other_issue_detail w
where i.id=w.item_id and w.issue_type="Sales"
'.$item_id_con.$date_con.$w_con.'
group by i.item_company order by i.item_company';

$query= mysqli_query($conn, $sql);
while($data=mysqli_fetch_object($query)){
$j++;
?>
    <tr>
      <td><?=$j?></td>
      <td><?=$data->item_company?></td>
      <td><?php echo round($data->cost_amount,2); $gcost += $data->cost_amount;?></td>
      <td><?php echo round($data->sales_amount,2); $gsales += $data->sales_amount;?></td>
      <td><?php echo $profit=round(($data->sales_amount-$data->cost_amount),2); $gprofit += $profit;?></td>
      
    </tr>
<?php
} // end while
?>
    <tr>
      <td></td><td><strong>Total</strong></td>
      <td><strong><?=round($gcost,2);?></strong></td>
      <td><strong><?=round($gsales,2);?></strong></td>
      <td><strong><?=round($gprofit,2);?></strong></td>
    </tr>
  </tbody>
</table></div>

<?php
}






elseif($_POST['report']==203){

$f_date = $_REQUEST['f_date'];
$t_date = $_REQUEST['t_date'];

 
if($_POST['item_sub_group']>0) 	$sub_group_id   =$_POST['item_sub_group'];
if($_POST['item_id']>0)         $item_id        =$_POST['item_id'];

$date_con = ' and j.ji_date between "'.$f_date.'" and "'.$t_date.'" ';
if(isset($sub_group_id)) 	{$item_sub_con=' and i.sub_group_id='.$sub_group_id;} 
if(isset($item_id)) 		{$item_con=' and i.id='.$item_id;} 

if($_POST['warehouse_id']) { $w_con=" and j.warehouse_id='".$warehouse_id."'";}


// opening
$sql="select j.item_id as code,sum(j.item_in - j.item_ex) balance
from journal_item j, product i 
where j.item_id=i.id
and ji_date < '".$f_date."' and warehouse_id = '1' 
".$item_con.$item_sub_con.$w_con." group by i.id";
	
$res = mysqli_query($conn, $sql);
	while($row=mysqli_fetch_object($res))
	{
		$opening[$row->code] = (int)$row->balance;
	}
	
// Closing
$sql="select j.item_id as code,sum(j.item_in - j.item_ex) balance
from journal_item j, product i 
where j.item_id=i.id
and ji_date <= '".$t_date."' and warehouse_id = '1' ".$item_con.$item_sub_con.$w_con." group by i.id";
	
$res = mysqli_query($conn, $sql);
	while($row=mysqli_fetch_object($res))
	{
		$bin_closing[$row->code] = (int)$row->balance;
	}	



// ----------- ALL purchase	
$sql="select j.item_id as code,i.unit_name,sum(j.item_in) balance
from journal_item j, product i 
where j.item_id=i.id 
and j.ji_date between '".$f_date."' and '".$t_date."' and warehouse_id = '1' ".$item_con.$item_sub_con.$w_con." 
AND  j.tr_from IN ('Local Purchase') group by i.id";
$res = mysqli_query($conn, $sql);
	while($row=mysqli_fetch_object($res))
	{
		$purchase[$row->code] = (int)$row->balance;
	}



// ------------------ Other receive	
$sql="select j.item_id as code,i.unit_name,sum(j.item_in) balance
from journal_item j, product i 
where j.item_id=i.id 
and j.ji_date between '".$f_date."' and '".$t_date."' and warehouse_id = '1' ".$item_con.$item_sub_con.$w_con." 
AND  j.tr_from NOT IN ('Local Purchase') group by i.id";
	
$res = mysqli_query($conn, $sql);
	while($row=mysqli_fetch_object($res))
	{
		$other_receive[$row->code] = (int)$row->balance;
	}	

// ----------------- Delivery -------------	
$sql="select j.item_id as code,i.unit_name,sum(j.item_ex) balance
from journal_item j, product i 
where j.item_id=i.id 
and j.ji_date between '".$f_date."' and '".$t_date."' and warehouse_id = '1' ".$item_con.$item_sub_con.$w_con." 
AND  j.tr_from IN ('Other Issue') group by i.id";
	
$res = mysqli_query($conn, $sql);
	while($row=mysqli_fetch_object($res))
	{
		$delivery[$row->code] = (int)$row->balance;
	}



// ----------------- Others issue	
$sql="select j.item_id as code,i.unit_name,sum(j.item_ex) balance
from journal_item j, product i 
where j.item_id=i.id 
and j.ji_date between '".$f_date."' and '".$t_date."' and warehouse_id = '1' ".$item_con.$item_sub_con.$w_con." 
AND  j.tr_from NOT IN ('Other Issue') group by i.id";
	
$res = mysqli_query($conn, $sql);
	while($row=mysqli_fetch_object($res))
	{
		$other_issue[$row->code] = (int)$row->balance;
	}		
		

?>
<center>
<h1><?=$company_name;?></h1>
<h2>Stock Movement Report</h2>
<h3>Date Interval: <?=$_REQUEST['f_date'];?> to <?=$_REQUEST['t_date'];?></h3>
<table class="table table-striped table-bordered">
<thead>
<tr>
  <th>S/L</th>
  <th>Code</th>
  <th>Item Name</th>
  <th bgcolor="#009999">Opening</th>
  <th bgcolor="#009999">Purchase</th>

  <th bgcolor="#009999">Other Receive</th>
  <th bgcolor="#009999">Total</th>

  <th bgcolor="#FF6699">Delivery</th>
  <th bgcolor="#FF6699">Other Issue</th>
  <th bgcolor="#FF6699">Total</th>
  <th>Closing</th>
  </tr>
</thead>
<tbody>

<?php
$sql="SELECT i.id as code,i.name,i.type
FROM  product i
where 1 and status=1 and i.price>0
".$item_con.$item_sub_con."
order by i.name";

$query = mysqli_query($conn, $sql);
while($data= mysqli_fetch_object($query)){ 
    
$in_total   = $opening[$data->code] + $purchase[$data->code] + $other_receive[$data->code];
$out_total  = $delivery[$data->code] + $other_issue[$data->code];
if($in_total<>0||$out_total<>0||$opening[$data->code]<>0){
?>

<tr>
  <td><?=++$op;?></td>
  <td><a href="master_report.php?report=204&submit=1&item_id=<?php echo $data->code;?>&f_date=<?php echo $f_date;?>&t_date=<?php echo $t_date;?>" target="_blank"><?=$data->code?></a></td>
  <td><?=$data->name?></td>
  <td><?=$opening[$data->code]?></td>
  <td><?=$purchase[$data->code]?></td>

  <td><?=$other_receive[$data->code]?></td>
  <td><?=$in_total?></td>

  <td><?=$delivery[$data->code]?></td>
  <td><?=$other_issue[$data->code]?></td>
  
  <td><?=$out_total?></td>
  
  <?php $closing = $in_total - $out_total; ?>  
  <td><?=$closing?></td>
  </tr>
<? 
$total_opening += $opening[$data->code];
$total_purchase += $purchase[$data->code];
$total_other_receive += $other_receive[$data->code];
$total_in_total += $in_total;

$total_delivery += $delivery[$data->code];
$total_other_issue += $other_issue[$data->code];
$total_out_total += $out_total[$data->code];
$total_closing += $closing;

}
} 
?>
<tr>
  <td bgcolor="#99CC99">&nbsp;</td>
  <td bgcolor="#99CC99">&nbsp;</td>
  <td bgcolor="#99CC99"><strong>Total</strong></td>
  <td bgcolor="#99CC99"><strong><?=$total_opening;?></strong></td>
  <td bgcolor="#99CC99"><strong><?=$total_purchase;?></strong></td>
  <td bgcolor="#99CC99"><strong><?=$total_other_receive;?></strong></td>
  <td bgcolor="#99CC99"><strong><?=$total_in_total;?></strong></td>
  

  <td bgcolor="#99CC99"><strong><?=$total_delivery;?></strong></td>
  <td bgcolor="#99CC99"><strong><?=$total_other_issue;?></strong></td>
  <td bgcolor="#99CC99"><strong><?=$total_out_total;?></strong></td>
  <td bgcolor="#99CC99"><strong><?=$total_closing;?></strong></td>
  </tr>
</tbody></table>

<?php
}
// end stock movement report







elseif(isset($sql)&&$sql!='') echo autoreport2($sql,$str);
?>




</div>
</div>
<!--    </div>	-->
<!--</div>-->


    
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>	

<script>
$(document).ready(function() {
    $('#example').DataTable( {
        "paging":   false,
        "ordering": true,
        "info":     true
    } );
} );

$(document).ready(function() {
    $('.table_report_all').DataTable( {
        "paging":   false,
        "ordering": true,
        "info":     false
    } );
} );
</script>
    
  
    
    
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/vendor/bootstrap-5/js/bootstrap.bundle.min.js"></script>

    <!-- Customized jquery file  -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/color-scheme.js"></script>

    <!-- Chart js script -->
    <script src="assets/vendor/chart-js-3.3.1/chart.min.js"></script>

    <!-- Progress circle js script -->
    <script src="assets/vendor/progressbar-js/progressbar.min.js"></script>

    <!-- swiper js script -->
    <script src="assets/vendor/swiperjs-6.6.2/swiper-bundle.min.js"></script>

    <!-- daterange picker script -->
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="assets/vendor/daterangepicker/daterangepicker.js"></script>

    <!-- nouislider js -->
    <script src="assets/vendor/nouislider/nouislider.min.js"></script>

    <!-- PWA app service registration and works -->
    <!--<script src="assets/js/pwa-services.js"></script>-->

    <!-- page level custom script -->
    <script src="assets/js/app.js"></script>

</body>

</html>

