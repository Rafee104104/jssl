<?php
session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";
require_once "../../../assets/support/inc.all.php";
$title='Accounts Ledger Delete';

$ledger_id 		= $_REQUEST['ledger_id'];


$datas=find_all_field('accounts_ledger','s','ledger_id='.$ledger_id);


?>
<script language="javascript">
window.onload = function() {
  document.getElementById("dealer").focus();
}
</script>
<script language="javascript">
function custom(theUrl)
{
	window.open('<?=$target_url?>?v_no='+theUrl);
}
</script>





<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
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


</style>

<?
	if(isset($_POST['delete']))
	{
		$user=$_SESSION['user']['id'];
		$today=date("Y-m-d h:i:sa");
		
		$count=find_a_field('secondary_journal','count(ledger_id)','ledger_id='.$_GET['ledger_id']);
		$journal=find_a_field('journal','count(ledger_id)','ledger_id='.$_GET['ledger_id']);
		
		if($count>0 || $journal>0)
		{
			echo "<h1 style='background:red; text-align:center; color:white'>This Ledger has Transaction</h1>";
		
		}
		else
		{
		
		 $insert_account="insert into accounts_ledger_delete_log select * from accounts_ledger where ledger_id='".$_GET['ledger_id']."'";
		mysql_query($insert_account);
	 	$update="update accounts_ledger_delete_log set delete_by='".$user."',delete_at='".$today."' where ledger_id='".$_GET['ledger_id']."'";
		mysql_query($update);
			
		$ledger_delete="delete from accounts_ledger where ledger_id='".$_GET['ledger_id']."'";
		mysql_query($ledger_delete);
		
		echo "<h1 style='background:green; text-align:center; color:white'>This Ledger Deleted Successfully</h1>";
		}
	
	}





?>

<?
		if(isset($_POST['po_no_view']))
		{
		
			header("Location: ledger_view_delete.php?ledger_id=".$_POST['ledger_id']." ");
		
		}

?>



<div class="form-container_large">
  <form action="" method="post" name="codz" id="codz">
    <table width="80%" border="0" align="center">
      
      
      <tr>
        <td align="right" bgcolor="#FF9966"><strong>Ledger ID:</strong></td>
        <td colspan="3" bgcolor="#FF9966">
		<input type="text" name="ledger_id" id="ledger_id" class="form-control" />		</td>
		<td><input type="submit" name="po_no_view" id="po_no_view" value="Ledger View"  class="btn1 btn1-bg-submit" /></td>
      </tr>
      
      
      
    </table>
	
	
	
	
  </form>
  
  <br /><br />
  <?
	//$count=find_a_field('purchase_master','count(po_no)','po_no="'.$po_no .'"');
//
//	if($count>0)
//	{
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.: Cash Memo :.</title>
<link href="../css/invoice.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript">
function hide()
{
    document.getElementById("pr").style.display="none";
}
</script>
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
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


</style>
</head>
<body style="font-family:Tahoma, Geneva, sans-serif">




<table width="80%"  border="0" cellspacing="0" cellpadding="0" align="center">
  
  
  
   <tr>
    <td style="text-align:center">Accounts Ledger</td>
  </tr>
</table>

<table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">
  
  <tr>
  	<td><strong>Ledger Name</strong></td>
    <td>:<strong> <?php echo $datas->ledger_name;?></strong></td>
  </tr>
  <tr>
    <td><strong>Ledger Id </strong></td>
    <td>:<strong> <?php echo  $datas->ledger_id;?></strong></td>
    
  </tr>
  <tr>
  	<td><strong>Acc. Class: </strong></td>
    <td>:<strong><?php echo find_a_field('acc_class','class_name','id='.$datas->acc_class);?></strong></td>
  </tr>
  <tr>
  	<td><strong>Acc. Sub Class: </strong></td>
    <td>:<strong><?php echo find_a_field('acc_sub_class','sub_class_name','id='.$datas->acc_sub_class);?></strong></td>
  </tr>
  <tr>
  	<td><strong>Acc. Sub Sub Class: </strong></td>
    <td>:<strong><?php echo find_a_field('acc_sub_sub_class','sub_sub_class_name','id='.$datas->acc_sub_sub_class);?></strong></td>
  </tr>
  <tr>
  	<td><strong>GL Group: </strong></td>
    <td>:<strong><?php echo find_a_field('ledger_group','group_name','group_id='.$datas->ledger_group_id);?></strong></td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
  	<td colspan="2" style="text-align: center;">
	<form method="post">
	<input type="submit" name="delete" value="Delete" class="btn1 btn1-bg-cancel"  /></td>
	</form>
  </tr>
  
</table>









</body>
</html>

<? //} ?>


<?
$main_content=ob_get_contents();
ob_end_clean();
include ("../../template/main_layout.php");
?>