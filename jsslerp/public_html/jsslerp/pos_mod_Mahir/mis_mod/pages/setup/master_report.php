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
	
	if($_REQUEST['report']==1) $reportName="User Action Log";
	if($_REQUEST['report']==2) $reportName="User Transaction Report";
}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?=$report?></title>
<link href="../../css/report.css" type="text/css" rel="stylesheet" />
<script type="text/javascript">

function hide()

{

    document.getElementById("pr").style.display="none";

}

</script>

<?
	require_once "../../../assets/support/inc.exporttable.php";

?>

<center><h1><?=$_SESSION['company_name']?></h1></center>
<h2><center><u><?=$reportName?></u></center></h2>
<? if($_POST['user_id']!=''){?><center><h3>User Name: <b><?=find_a_field('user_activity_management','fname','user_id='.$_POST['user_id']);?></b></h3></center><? }?>
<? if($_POST['mod_id']!=''){?><center><h3>Module Name: <b><?=find_a_field('user_module_manage','module_name','id='.$_POST['mod_id']);?></b></h3></center><? }?>
<center><h3>Date:<b><?=$f_date?></b> To <b><?=$t_date?></b> </h3></center><br /><br />




<?
if($_REQUEST['report']==1) 
{
?>
<table id="ExportTable" width="100%" cellspacing="0" cellpadding="2" border="0"><thead><tr><td style="border:0px;" colspan="10"><div class="header">





	<thead>
		<tr>
			<th>S/L</th>
			<th>User Name</th>
			<th>Module</th>
			<th>Page Name</th>
			<th>Link</th>
			<th>IP Address</th>
			<th>Access Date</th>
			<th>Execution Time</th>
		</tr>
		
	</thead>
	<tbody>
	<?
if($_POST['user_id']!=''){
$conn=' and l.user_id="'.$_POST['user_id'].'"';
}	
if($_POST['mod_id']!=''){
$conn=' and l.mod_id="'.$_POST['mod_id'].'"';
}

 $sql='select l.*,m.module_name from user_action_log l, user_module_manage m 

where l.mod_id=m.id and l.access_date between "'.$_REQUEST['f_date'].'" and "'.$_REQUEST['t_date'].'"'.$conn;
	$query=mysql_query($sql);
		$sl = 1;
		while($info = mysql_fetch_object($query)){
	?>
		<tr>
			<td><?=$sl++;?></td>
			<td><?=$info->user_fname;?></td>
			<td><?=$info->module_name;?></td>
			<td><?=$info->page_name?></td>
			<td><?=$info->page_link?></td>
			<td><?=$info->ip_address?></td>
			<td><?=$info->access_date?></td>
			<td><?=$info->execution_time?></td>
		
		</tr>
	<? } ?>	
	</tbody>
</table>
<?

}	
if($_REQUEST['report']==2) 
{
?>
<table id="ExportTable" width="100%" cellspacing="0" cellpadding="2" border="0"><thead><tr><td style="border:0px;" colspan="10"><div class="header">


	<thead>
		<tr>
			<th>S/L</th>
			<th>User Name</th>
			<th>Date</th>
			<th>Tr From</th>
			<th>Entry Count</th>
			<th>Initiate</th>
			<th>Add</th>
			<th>Remove</th>
			<th>Delete</th>
			<th>Show</th>
		</tr>
		
	</thead>
	<tbody>
	<?
if($_POST['user_id']!=''){
$conn=' and user_id="'.$_POST['user_id'].'"';
}

 $trCount='select user_id,tr_from,access_date,tr_type,count(tr_type) as trcount from user_action_log where access_date between "'.$_REQUEST['f_date'].'" and "'.$_REQUEST['t_date'].'" group by user_id,access_date,tr_from,tr_type';

$trQuery=mysql_query($trCount);
while($trData=mysql_fetch_object($trQuery)){

$trEntry[$trData->user_id][$trData->tr_from][$trData->access_date][$trData->tr_type]=$trData->trcount;
}


	
  $sql='select user_id,user_fname,access_date,tr_from,count(tr_from) as trdata from user_action_log where access_date between "'.$_REQUEST['f_date'].'" and "'.$_REQUEST['t_date'].'" and tr_from!=""'.$conn.' group by tr_from,access_date ';
	$query=mysql_query($sql);
		$sl = 1;
		while($info = mysql_fetch_object($query)){
	?>
		<tr>
			<td><?=$sl++;?></td>
			<td><?=$info->user_fname;?></td>
			<td><?=$info->access_date?></td>
			<td><?=$info->tr_from;?></td>
			<td><?=$info->trdata;?></td>
			<td><?=$trEntry[$info->user_id][$info->tr_from][$info->access_date]['Initiate']?></td>
			<td><?=$trEntry[$info->user_id][$info->tr_from][$info->access_date]['Add']?></td>
			<td><?=$trEntry[$info->user_id][$info->tr_from][$info->access_date]['Remove']?></td>
			<td><?=$trEntry[$info->user_id][$info->tr_from][$info->access_date]['Delete']?></td>
			<td><?=$trEntry[$info->user_id][$info->tr_from][$info->access_date]['Show']?></td>
		</tr>
	<? } ?>	
	</tbody>
</table>
<?

}
	
elseif(isset($sqla)&&$sqla!='') {echo report_create($sqla,1,$str);}
?>
</div>
</body>
</html>