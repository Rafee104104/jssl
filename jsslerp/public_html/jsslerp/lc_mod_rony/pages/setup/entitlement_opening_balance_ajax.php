<?
session_start();
require_once "../../../assets/support/inc.all.php";


$odate = $_REQUEST['odate'];
$item_id = $_REQUEST['item_id'];
$entitlement_value = $_REQUEST['entitlement_value'];

$flag = $_REQUEST['flag'];



$entry_by=$_SESSION['user']['id'];
$entry_at=date('Y-m-d H:i:s');




if($_REQUEST['flag']!=0)
{
$del_sql = "DELETE from lc_entitlement where item_id='".$item_id."' and status = 'Opening' ";
mysql_query($del_sql);
}


   $entitlement = 'INSERT INTO lc_entitlement (entitlement_date, item_id, entitlement_value, status, entry_at, entry_by)
  
  VALUES("'.$odate.'", "'.$item_id.'", "'.$entitlement_value.'", "Opening", "'.$entry_at.'", "'.$entry_by.'")';

mysql_query($entitlement);




echo 'Success!';
?>