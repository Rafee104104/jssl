<?
session_start();
require_once "../../../assets/template/layout.top.php";
$entry_at = date('Y-m-d H:i:s');
if($_REQUEST['item_id']>0){
$sqql2="delete from budget_balance where tr_from='Opening' and ledger_id='".$_REQUEST['item_id']."'"; 
mysql_query($sqql2);
$ledger = find_all_field('accounts_ledger','','ledger_id='.$_REQUEST['item_id']);
 $cc_code = find_a_field('dealer_info','depot','account_code='.$ledger->ledger_id);
//$jv=next_journal_voucher_id();

$project = "clouderp";
$jv=next_journal_voucher_id('','Opening',$_SESSION['user']['depot']);
$narration = $_REQUEST['narration'];


if($_REQUEST['dr']>0)
{
$amount=$_REQUEST['dr'];
 $sec_journal="INSERT INTO `budget_balance` (
								`proj_id` ,
								`jv_no` ,
								`jv_date` ,
								`ledger_id` ,
								`narration` ,
								`dr_amt` ,
								`cr_amt` ,
								`tr_from` ,
								`tr_no`,
								`sub_ledger`,
								`cc_code`,
								entry_by,
								group_for,
								entry_at
								)
VALUES ('$project','$jv', '".$_REQUEST['opdate']."', '".$ledger->ledger_id."', '".$narration."',  '$amount','0', 'Opening', '','','".$cc_code."','".$_SESSION['user']['id']."','".$_SESSION['user']['group']."','".$entry_at."')";
mysql_query($sec_journal);


}echo 'Success!';}
?>