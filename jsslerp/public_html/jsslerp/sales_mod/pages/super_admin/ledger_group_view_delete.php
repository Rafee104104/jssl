<?php
session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";
require_once "../../../assets/support/inc.all.php";
$title=' Ledger Group Delete';

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
		
		 $insert_account="insert into ledger_group_delete_log select * from ledger_group where group_id='".$_GET['ledger_group']."'";
		mysql_query($insert_account);
	 	$update="update ledger_group_delete_log set delete_by='".$user."',delete_at='".$today."' where group_id='".$_GET['ledger_group']."'";
		mysql_query($update);
			
		 $ledger_delete="delete from ledger_group where group_id='".$_GET['ledger_group']."'";
		mysql_query($ledger_delete);
		
		echo "<h1 style='background:green; text-align:center; color:white'>This Ledger Group Deleted Successfully</h1>";
		
	
	}





?>

<?
		if(isset($_POST['po_no_view']))
		{
		
			header("Location: ledger_group_view_delete.php?ledger_group=".$_POST['ledger_group']." ");
		
		}

?>



<div class="form-container_large">
  <form action="" method="post" name="codz" id="codz">
    <table width="80%" border="0" align="center">
      
      
      <tr>
        <td align="right" bgcolor="#FF9966"><strong>ledger group ID:</strong></td>
        <td colspan="3" bgcolor="#FF9966">
		<input type="text" name="ledger_group" id="ledger_group" class="form-control" required />		</td>
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






<table width="100%" border="1">
<tr>
  <th colspan="3" style="background:#0099FF; color:white; text-align:center; font-size:20px;">
    <?= find_a_field('ledger_group', 'group_name', 'group_id=' . $_GET['ledger_group']); ?>
  </th>
</tr>
<tr>
  <th>SL</th>
  <th>Ledger ID</th>
  <th>Ledger Name</th>
</tr>

<?php
$sl = 1;
$group_id = (int) $_GET['ledger_group'];

$sql = "SELECT * FROM accounts_ledger WHERE ledger_group_id='$group_id'";
$q = mysql_query($sql);
$row_count = mysql_num_rows($q);

if ($row_count > 0) {
  // ? Ledgers exist — show them
  while ($r = mysql_fetch_object($q)) {
?>
    <tr>
      <td><?= $sl++; ?></td>
      <td><?= $r->ledger_id; ?></td>
      <td><?= $r->ledger_name; ?></td>
    </tr>
<?php
  }
} else {
  // ? No ledgers found — show delete button (only if valid group_id)
  if ($group_id > 0) {
?>
  <tr>
    <td colspan="3" style="text-align:center; border:none !important;">
      <form method="post">
        <input type="submit" name="delete" value="Delete Ledger Group <?= $group_id; ?>" 
               class="btn1 btn1-bg-cancel"
               onclick="return confirm('Are you sure you want to delete this ledger group?');"/>
      </form>
    </td>
  </tr>
<?php
  }
}
?>
</table>



  
  










</body>
</html>

<? //} ?>


<?
$main_content=ob_get_contents();
ob_end_clean();
include ("../../template/main_layout.php");
?>