<?php
session_start();
$host	='localhost';
date_default_timezone_set('Asia/Dhaka');
$user 	= 'root';
$pass 	= '';
$db 	= 'db_sajeeb';

$link 	= mysql_connect($host, $user, $pass);
mysql_select_db($db);
if (!$link) die('Could not connect: ' . mysql_error());
$sql = 'select * from accounts_ledger where 1';
$query = mysql_query($sql);
echo $count = mysql_num_rows($query);
while($data=mysql_fetch_object($query)){
	$sql1 = 'select * from sub_ledger s where ledger_id = '.$data->ledger_id;
	$query1 = mysql_query($sql1);
	$count1 = mysql_num_rows($query1);
	$t_count1 = $t_count1 + $count1;
	if($count1>0)
	{
	$update1 = 'update accounts_ledger set parent = 1 where ledger_id = '.$data->ledger_id;
	mysql_query($update1);
	}else{
	
	$sql2 = 'select * from sub_sub_ledger where sub_ledger_id = '.$data->ledger_id;
	$query2 = mysql_query($sql2);

	$count2 = mysql_num_rows($query2);
	$t_count2 = $t_count2 + $count2;
	if($count2>0)
	{
	$update2 = 'update accounts_ledger set parent = 2 where ledger_id = '.$data->ledger_id;
	mysql_query($update2);
	}else $t_count3++;}
}
echo '<br>';
echo $t_count1;
echo '<br>';
echo $t_count2;
echo '<br>';
echo $t_count3;
echo '<br>';
	$sql1 = 'select ledger_id, ledger_name from accounts_ledger where parent=0 and group_for =2 order by ledger_id';
	$query1 = mysql_query($sql1);
echo $count1 = mysql_num_rows($query1);
	echo '<br>';
	$sql1 = 'select ledger_id, ledger_name from accounts_ledger where ledger_id not in (select ledger_id from sub_ledger) and ledger_id not in (select sub_ledger_id from sub_sub_ledger) and group_for =2 order by ledger_id';
	$query1 = mysql_query($sql1);
echo $count1 = mysql_num_rows($query1);

	
?>