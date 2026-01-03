<?
session_start();
require_once "../../../assets/support/inc.all.php";


$page_id=$_REQUEST['page_id']; 
$user_id=$_REQUEST['user_id']; 
$access=$_REQUEST['access']; 
$add=$_REQUEST['add']; 
$edit=$_REQUEST['edit']; 
$delete=$_REQUEST['delete']; 

db_delete('user_roll_activity'," 1 and user_id='".$user_id."' and page_id='".$page_id."'");
$sql = "INSERT INTO user_roll_activity (`user_id`, `page_id`, `add`, `edit`, `delete`, `access`) VALUES ('$user_id', '$page_id', '$add', '$edit', '$delete','$access')";
mysql_query($sql);
echo 'DONE';
?>