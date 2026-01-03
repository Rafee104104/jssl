<?php
session_start();
require_once('../../../../../../erpengine/controller/MainEngine/controller/configure/db_connect_acc_main.php');
require_once('../../../../../../erpengine/controller/MainEngine/controller/tools/inc.log.php');
require_once('../../../../../../erpengine/controller/MainEngine/controller/tools/inc.database.php');
require_once('../../../../../../erpengine/controller/MainEngine/controller/tools/crud.php');
require_once('function.php');

date_default_timezone_set('Asia/Dhaka');
		function ssd($qty,$pk,$colour='')
		{
		if($colour!='') $c = 'bgcolor="'.$colour.'" ';
		echo '
		<td '.$c.'>'.(int)($qty/$pk).'</td>
		<td '.$c.'>'.($qty%$pk).'</td>
		<td '.$c.'>'.(int)$qty.'</td>
			';
		}
if(isset($_POST['submit'])&&isset($_POST['report'])&&$_POST['report']>0)
{
	if((strlen($_POST['t_date'])==10)&&(strlen($_POST['f_date'])==10))
	{
		$t_date=$_POST['t_date'];
		$f_date=$_POST['f_date'];
		
		$to_date=$_POST['t_date'];
		$fr_date=$_POST['f_date'];
	}
	
	if($_POST['ctg_warehouse']>0) 				$ctg_warehouse=$_POST['ctg_warehouse'];
	if($_POST['garden_id']>0) 				    $garden_id=$_POST['garden_id'];
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?=$report?></title>
<link href="../../../assets/css/report.css" type="text/css" rel="stylesheet" />
<style>
*{
	font-size:
	}
h2, h3, h4 {
	text-align:center;
	}
</style>


<script type="text/javascript">

function hide()

{

    document.getElementById("pr").style.display="none";

}

</script>



<style type="text/css">
.vertical-text {
	transform: rotate(270deg);
	transform-origin: left top 1;
	float:left;
	width:2px;
	padding:1px;
	font-size:10px;
	font-family:Arial, Helvetica, sans-serif;
}
.style1 {font-weight: bold}
.style2 {font-weight: bold}
.style3 {font-weight: bold}

h3 { margin:0; padding:0; font-weight: 700;}
.style4 {font-weight: bold}
.style5 {font-weight: bold}
.style6 {font-weight: bold}
.style7 {font-weight: bold}
</style>

	<?
	require_once "../../../assets/support/inc.exporttable.php";
	?>

</head>
<body>
<!--<div align="center" id="pr">-->
<!--<input name="button" type="button" onclick="hide();window.print();" value="Print" />-->
<!--</div>-->
<div class="main">
<?

		
if($_POST['report']==1) 
{

 $pushData = find_all_field('database_info', '', 'company_id="' . $_POST['cid'] . '"');
 

if ($pushData->db_user != '') {
	@mysql_connect('localhost', $pushData->db_user, $pushData->db_pass);
	@mysql_select_db($pushData->db_name);

 
//echo find_a_field('system_stock_lock_master','total_qty','id=40');  

?>

<table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable"><thead><tr><td style="border:0px;" colspan="10"><div class="header"><h1><?=$_SESSION['company_name']?></h1><h2>Stock Check Report</h2>
<h2>Date-<?=$f_date." TO ".$t_date;?></h2></div><div class="left"></div><div class="right"></div><div class="date">Reporting Time: <?=date("h:i A d-m-Y")?></div></td></tr><tr>
<th>S/L</th>
<th>TR FROM</th>
<th>Date</th>
<th>Quantity</th>
<th>Journal Qty</th>
<th>Status</th>

</tr>
</thead><tbody>
<?

 $cdd='select * from system_stock_lock_details where date between "'.$f_date.'" and "'.$t_date.'"';
$query=mysql_query($cdd);
$i=1;
while($data=mysql_fetch_object($query)){

?>
<tr>
<td><?=$i++?></td>
<td><?=$data->tr_from?></td>
<td><?=$data->date?></td>
<td><?=$data->total_qty?></td>
<td><?=$data->total_qty_ji?></td>
<td><?=($data->total_qty==$data->total_qty_ji)? "OK": "<span style='color: white;background: rebeccapurple;'>Problem</span>"?></td>

</tr>
<?
}
		
?>

<?
}
}

if($_POST['report']==2) 
{

 $pushData = find_all_field('database_info', '', 'company_id="' . $_POST['cid'] . '"');
 

if ($pushData->db_user != '') {
	@mysql_connect('localhost', $pushData->db_user, $pushData->db_pass);
	@mysql_select_db($pushData->db_name);

 
//echo find_a_field('system_stock_lock_master','total_qty','id=40');  

?>

<table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable"><thead><tr><td style="border:0px;" colspan="10"><div class="header"><h1><?=$_SESSION['company_name']?></h1><h2>Finance Check Report</h2>
<h2>Date-<?=$f_date." TO ".$t_date;?></h2></div><div class="left"></div><div class="right"></div><div class="date">Reporting Time: <?=date("h:i A d-m-Y")?></div></td></tr><tr>
<th>S/L</th>
<th>TR FROM</th>
<th>Date</th>
<th>Amount</th>
<th>Journal Amount</th>
<th>Status</th>

</tr>
</thead><tbody>
<?

 $cdd='select * from system_finance_lock_details where date between "'.$f_date.'" and "'.$t_date.'"';
$query=mysql_query($cdd);
$i=1;
while($data=mysql_fetch_object($query)){

?>
<tr>
<td><?=$i++?></td>
<td><?=$data->tr_from?></td>
<td><?=$data->date?></td>
<td><?=$data->total_qty?></td>
<td><?=$data->total_qty_ji?></td>
<td><?=($data->total_qty==$data->total_qty_ji)? "OK": "<span style='color: white;background: rebeccapurple;'>Problem</span>"?></td>

</tr>
<?
}
		
?>

<?
}
}
if($_POST['report']==3) 
{

 $pushData = find_all_field('database_info', '', 'company_id="' . $_POST['cid'] . '"');
 

if ($pushData->db_user != '') {
	@mysql_connect('localhost', $pushData->db_user, $pushData->db_pass);
	@mysql_select_db($pushData->db_name);

 
//echo find_a_field('system_stock_lock_master','total_qty','id=40');  

?>

<table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable"><thead><tr><td style="border:0px;" colspan="10"><div class="header"><h1><?=$_SESSION['company_name']?></h1><h2>Finance Check Report</h2>
<h2>Date-<?=$f_date." TO ".$t_date;?></h2></div><div class="left"></div><div class="right"></div><div class="date">Reporting Time: <?=date("h:i A d-m-Y")?></div></td></tr><tr>
<th>S/L</th>
<th>TR FROM</th>
<th>Date</th>
<th>Sec Journal Dr</th>
<th>Sec Journal Cr</th>
<th>Journal Dr</th>
<th>Journal Cr</th>
<th>Status</th>

</tr>
</thead><tbody>
<?

 $cdd='select * from system_acc_lock_details where date between "'.$f_date.'" and "'.$t_date.'"';
$query=mysql_query($cdd);
$i=1;
while($data=mysql_fetch_object($query)){

?>
<tr>
<td><?=$i++?></td>
<td><?=$data->tr_from?></td>
<td><?=$data->date?></td>
<td><?=$data->sec_dr?></td>
<td><?=$data->sec_cr?></td>
<td><?=$data->journal_dr?></td>
<td><?=$data->journal_cr?></td>
<td><?=($data->sec_dr==$data->journal_dr && $data->sec_cr==$data->journal_cr)? "OK": "<span style='color: white;background: rebeccapurple;'>Problem</span>"?></td>

</tr>
<?
}
		
?>

<?
}
}



elseif(isset($sql)&&$sql!='') echo report_create($sql,1,$str);

?>
</div>
</body>
</html>