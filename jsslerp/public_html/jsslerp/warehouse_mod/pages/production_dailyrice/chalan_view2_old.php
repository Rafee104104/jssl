<?php
session_start();
//====================== EOF ===================
//var_dump($_SESSION);
require_once "../../../assets/support/inc.all.php";

$pr_no 		= $_REQUEST['v_no'];
$group_data = find_all_field('user_group','group_name','id='.$_SESSION['user']['group']);

$datas=find_all_field('purchase_receive','s','pr_no='.$pr_no);
$module_name = find_a_field('user_module_manage','module_file','id='.$_SESSION["mod"]);

$batch_status=find_a_field('rm_consumption','status','batch_no="'.$pr_no.'"');
echo $batch_status;


  $issue_sql='SELECT rm.item_id, rm.issue_qty, rm.batch_no, rm.avg_price, sum(rm.total_amt) issue_amt, i.item_id ,i.item_name, i.unit_name FROM rm_consumption rm, item_info i WHERE rm.item_id=i.item_id and rm.batch_no="'.$pr_no.'"';

//echo $sql;
$issue_query=mysql_query($issue_sql);


while($issue_data= mysql_fetch_object($issue_query)){

		$issue_amount[$issue_data->batch_no] = $issue_data->issue_amt;


}

$fg_sql='SELECT fg.item_id, fg.receive_qty, fg.batch_no, fg.cost_price, sum(fg.total_amt) as fg_amt, i.item_id ,i.item_name, i.unit_name FROM fg_production fg, item_info i WHERE fg.item_id=i.item_id and fg.batch_no="'.$pr_no.'"';


$fg_query=mysql_query($fg_sql);


while($fg_data= mysql_fetch_object($fg_query)){

		$fg_amount[$fg_data->batch_no] = $fg_data->fg_amt;


}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.: Cash Memo :.</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
<script type="text/javascript">
	function hide()
	{
		document.getElementById("pr").style.display="none";
		document.getElementById("pr1").style.display="none";
	}
</script>

<style>

table.table-bordered > thead > tr > th{
  border:1px solid black;
  font-size:12px;
}
table.table-bordered > tbody > tr > td{
  border:1px solid black;
    font-size:12px;
}

   .mb-3{
margin-bottom:4px!important;
}
.input-group-text{
font-size:12px;
}
      * {
    margin: 0;
    padding: 0;
	font-size:13px;
  }
  p {
    margin: 0;
    padding: 0;
  }
  h1,
  h2,
  h3,
  h4,
  h5,
  h6
   {
    margin: 0 !important;
    padding: 0 !important;
  }
  

#pr input[type="button"] {
	width: 70px;
	height: 25px;
	background-color: #6cff36;
	color: #333;
	font-weight: bolder;
	border-radius: 5px;
	border: 1px solid #333;
	cursor: pointer;
}
tr td, tr th{
border: 1px solid #333!important;
}
    </style>
</head>

<body style="font-family:Tahoma, Geneva, sans-serif">

<div class="container">


<?

$com_name=find_a_field('project_info','proj_name','1');
 $date = $_POST['f_date'];
 $date1 = $_POST['t_date'];
 
// echo $date;
// echo $date1;
?>
<style>
    
    table th {
    position:sticky;
    top:0;
    z-index:1;
    border-top:1;
    background: #ededed;
}
h2, h4{
	margin:0px;
}
</style>
<h1 style="text-align:center; padding: 5px;">
					
<?=find_a_field('user_group','group_name','id='.$_SESSION['user']['group'])?>
</h1>
<?

		 $str3 	.= '<h4 style="text-align:center;">'.find_a_field('warehouse','warehouse_name','warehouse_id='.$_SESSION['user']['depot']).'</h4>';
		// echo $str3;
		
	
?>

<?php 

if ($batch_status == "COMPLETED"){?>


<? } else{?>
<div class="form-group row m-0 pl-3 pr-3">
	<label for="group_name" class="col-sm-1 pl-0 pr-0 col-form-label" style="text-align:right; padding-right: 0px;"> Status : </label>
	<div class="col-sm-2 col-form-label pl-0" style=" padding-left: 0px; ">
		<select name="status" id="status" style="width: 100%;">
			<option value="<?=$status?>"><?=$status?></option>
			<option value="Active">COMPLETED</option>
			<option value="Inactive">PROCESSING</option>
		</select>
	</div>
	<div class="col-sm-9 col-form-label pl-0" style=" padding-left: 0px; ">
		<input name="record" type="submit" id="record" value="Save" onclick="return checkUserName()" style=" padding: 0px 15px; border: 1px solid #333; border-radius: 3px; background-color: #09a52b; color: #fff; "/>
	</div>
					
</div>
<? } ?>

<h1 style="text-align:center; padding: 5px;"> Raw Material Comsumption</h1>


					
					
					
<table width="100%;"  id="ExportTable" cellspacing="0" cellpadding="2" border="0" >
	<thead>
		<tr>
				
				<th style="text-align:center">Item id</th>
				<th style="text-align:center">Item Name</th>
				<th style="text-align:center">Unit</th>
				<th style="text-align:center">RM Issue Qty</th>
				<th style="text-align:center">RM Issue Rate</th>
				<th style="text-align:center">Total Issue Amount</th>

		</tr>
	</thead>
	<tbody>
	<?php
	





		
		  $sql='SELECT rm.item_id, rm.issue_qty, rm.batch_no, rm.avg_price, rm.total_amt, i.item_id ,i.item_name, i.unit_name FROM rm_consumption rm, item_info i WHERE rm.item_id=i.item_id and rm.batch_no="'.$pr_no.'"';

//echo $sql;
$query=mysql_query($sql);


	
	while($row=mysql_fetch_object($query)){
	
	$opening = $open_new[$row->item_id];
	
	$item_in = $item_in_new[$row->item_id];
	$item_out = $item_out_new[$row->item_id];
	
	$open_sum = $opening + $item_in;
	
	$Balance = $open_sum - $item_out;
	$total_issue = $total_issue+$row->issue_qty;
	$total_issue_amt = $total_issue_amt+$row->total_amt;
	
	?>
	
		<tr>
			<td><?=$row->item_id?></td>
			<td><?=$row->item_name?></td>
			<td><?=$row->unit_name?></td>
			
						
			<!--<td><?=$row->item_in?></td>-->
			<!--<td><?=$row->item_out?></td>-->
			
			
			<?php /*?><td align="right"><? echo $open_new[$row->item_id];?> </td><?php */?>

			<?php /*?><td align="right"><? echo $item_in_new[$row->item_id]; $item_in_total +=$item_in_new[$row->item_id]; ?></td><?php */?>			
			<td align="center"><?=$row->issue_qty?></td>
			<?php /*?><td align="right"><?php echo $Balance;?> </td><?php */?>
			<td align="center"><?=$row->avg_price?></td>
			<td align="center"><?=$row->total_amt?></td>
			


		</tr>
		<? }?>
		<tr align="right" style="font-weight:bold;">
			<td colspan="3">TOTAL</td>
			<td align="center"><?=number_format( $total_issue,2)?></td>
			<td></td>
			<td align="center"><?=number_format( $total_issue_amt,2)?></td>
		</tr>
	</tbody>
</table>
<?

$com_name=find_a_field('project_info','proj_name','1');
 $date = $_POST['f_date'];
 $date1 = $_POST['t_date'];
 
// echo $date;
// echo $date1;
?>
<style>
    
    table th {
    position:sticky;
    top:0;
    z-index:1;
    border-top:1;
    background: #ededed;
}
h2, h4{
	margin:0px;
}
</style>
<br />
<h1 style="text-align:center;"> Finish Goods Receive</h1>



<table width="100%;"  id="ExportTable" cellspacing="0" cellpadding="2" border="0" >
	<thead>
		<tr>
				
				<th style="text-align:center"> Item id</th>
				<th style="text-align:center">Item Name</th>
				<th style="text-align:center">Unit</th>
				<th style="text-align:center">FG Received Qty </th>
				<th style="text-align:center">FG Received Rate</th>
				<th style="text-align:center">Total Received Amount</th>
			

		</tr>
	</thead>
	<tbody>
	<?php
	

		 $sql='SELECT fg.item_id, fg.receive_qty, fg.batch_no, fg.cost_price, fg.total_amt, i.item_id ,i.item_name, i.unit_name FROM fg_production fg, item_info i WHERE fg.item_id=i.item_id and fg.batch_no="'.$pr_no.'"';

//echo $sql;
$query=mysql_query($sql);


	
	while($row=mysql_fetch_object($query)){
	
	$opening = $open_new[$row->item_id];
	
	$item_in = $item_in_new[$row->item_id];
	$item_out = $item_out_new[$row->item_id];
	
	$open_sum = $opening + $item_in;
	
	$Balance = $open_sum - $item_out;
	$total_receive = $total_receive+$row->receive_qty;
	$total_receive_amt = $total_receive_amt+$row->total_amt;
	?>
	
		<tr>
			<td><?=$row->item_id?></td>
			<td><?=$row->item_name?></td>
			<td><?=$row->unit_name?></td>
						
			
			<?php /*?><td><? echo $open_new[$row->item_id];?> </td><?php */?>

			<td align="center"><?=$row->receive_qty?></td>			
			<?php /*?><td align="right"><? echo $item_out_new[$row->item_id]; $item_out_fg += $item_out_new[$row->item_id]; ?></td>
			<td align="right"><?php echo $Balance;?> </td><?php */?>
			<td align="center"><?=$row->cost_price?></td>
			<td align="center"><?=$row->total_amt?></td>
			


		</tr>
		<? }?>
		
		<tr align="center" style="font-weight:bold;">
			<td colspan="3">TOTAL</td>
			<td align="center"><?=number_format( $total_receive,2)?></td>
			<td></td>
			<td align="center"><?=number_format( $total_receive_amt,2)?></td>
		</tr>
	</tbody>
</table>


<style>
    
    table th {
    position:sticky;
    top:0;
    z-index:1;
    border-top:1;
    background: #ededed;
}
h2, h4{
	margin:0px;
}
</style>
<br />
<h1 style="text-align:center;">Finish Goods Costing Ratio</h1>



<table width="100%;"  id="ExportTable" cellspacing="0" cellpadding="2" border="0" >
	<thead>
		<tr>
				
				<th style="text-align:center">BATCH NO</th>
				<th style="text-align:center">Total Issue Amount </th>
				<th style="text-align:center">Total Received Amount</th>
				<th style="text-align:center">Ratio (%)</th>
			

		</tr>
	</thead>
	<tbody>
		
		<?php
	

		 $sql1='SELECT fg.batch_no FROM fg_production fg WHERE  fg.batch_no="'.$pr_no.'"';

//echo $sql;
$query1=mysql_query($sql1);


	
	while($row1=mysql_fetch_object($query1)){
	
	$total_issue_amt = $issue_amount[$row1->batch_no];
	$total_receive_amt = $fg_amount[$row1->batch_no];
	$ratio_cost = ($total_issue_amt/$total_receive_amt)*100;
	?>
	
	
		<? }?>
		
		
		<tr>
			<td><?=$row->batch_no?></td>
			<td align="center"><?=$total_issue_amt?></td>
			<td align="center"><?=$total_receive_amt?></td>
			<td align="center"><?=$ratio_cost?></td>
		</tr>
		
		
	</tbody> 
</table>



		


	

</div>
</body>

</html>

