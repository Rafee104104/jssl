<?php
require_once "../../../assets/template/layout.top.php";
$title='Account Sub Ledger';
$proj_id=$_SESSION['proj_id'];
$input_page="account_sub_ledger_input.php"; $add_button_bar = 'Mhafuz';
do_datatable('ac_ledger');
$now=time();
function add_separator(){}
$separator	= $_SESSION['separator'];

if(isset($_REQUEST['name'])||isset($_REQUEST['id']))
{
	//common part.............
	
	$id=$_REQUEST['id'];
	//echo $ledger_id;
	$name		= mysql_real_escape_string($_REQUEST['name']);
	$name		= str_replace("'","",$name);
	$name		= str_replace("&","",$name);
	$name		= str_replace('"','',$name);
	$under		= mysql_real_escape_string($_REQUEST['under']);
	$balance	= mysql_real_escape_string($_REQUEST['balance']);
	
	
	
	
	//end
	if(isset($_POST['nledger']))
	{
			$sql_check="select ledger_group_id, balance_type, budget_enable from accounts_ledger where ledger_id='".$under."' limit 1";
			$sql_query=mysql_query($sql_check);
			if(mysql_num_rows($sql_query)>0){
			$ledger_data=mysql_fetch_row($sql_query);
				if(!ledger_redundancy($name))
				{
					$type=0;
					$msg='Given Name('.$name.') is already exists as Ledger.';
				}
			else
			{				
			$sub_ledger_id=number_format(next_sub_ledger_id($under), 0, '.', '');
			$group_for=$_SESSION['user']['group'];
			$ledger_layer=2;
			//sub_ledger_create($sub_ledger_id,$name, $under, $balance, $now, $proj_id);
			ledger_create($sub_ledger_id,$name,$ledger_data[0],$group_for,$under,$ledger_data[1],'','4', time(),$ledger_layer,$ledger_data[2]);
			 $sql = 'update accounts_ledger set ledger_layer = 2 where ledger_id = '.$sub_ledger_id.' ';
			 mysql_query($sql);
					$type=1;
					$msg='New Entry Successfully Inserted.';
						
			}

		}
		else
		{
		$type=0;
		$msg='Invalid Accounts Ledger!!!';
		}
		
	}

//for Modify..................................

	if(isset($_POST['mledger']))
	{
$search_sql="select 1 from accounts_ledger where `ledger_id`!='$id' and `ledger_name` = '$name' limit 1";
if(mysql_num_rows(mysql_query($search_sql))==0)
	{
		$sql_check="select ledger_id from accounts_ledger where ledger_id=".$under;
		$sql_query=mysql_query($sql_check);
		if(mysql_num_rows($sql_query)==1){
		$id=$_REQUEST['id'];
		$sql2="UPDATE `accounts_ledger` SET 
		`ledger_name` 		= '$name', balance_type = $under	
			WHERE `ledger_id` 		='$id' LIMIT 1";
		//$sql="UPDATE `sub_ledger` SET `sub_ledger` = '$name' WHERE `sub_ledger_id` =$id LIMIT 1";
		//$query=mysql_query($sql);
		$query=mysql_query($sql2);
		$type=1;
		$msg='Successfully Updated.';
		}
		else
		{
		$type=0;
		$msg='Invalid Accounts Ledger!!!';
		}
		//echo $sql;
	}
	else
	{
	$type=0;
	$msg='Given Name('.$name.') is already exists.';
	}
	}

	if(isset($_POST['dledger']))
{
$id=$_REQUEST['id'];
$sql="delete from `sub_ledger` where `sub_ledger_id`='$id' limit 1";
$query=mysql_query($sql);
$sql="delete from `accounts_ledger` where `ledger_id`='$id' limit 1";
$query=mysql_query($sql);
		$type=1;
		$msg='Successfully Deleted.';
}

    $ddd="select * from accounts_ledger where ledger_id='$id'";
	$data=mysql_fetch_object(mysql_query($ddd));
}

auto_complete_from_db('accounts_ledger','ledger_name','ledger_id','ledger_id like "%00000000"','under');
?>
<style type="text/css">
<!--
.style3 {color: #FFFFFF; font-weight: bold; }
-->
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
								  
								  
								  <tr>
									<td>
						<table id="ac_ledger" class="table table-striped table-bordered" cellspacing="0">
						<thead>
							  <tr>
								<th bgcolor="#45777B"><span class="style3">Sub Ledger Id</span></th>
								<th bgcolor="#45777B"><span class="style3">Sub Ledger</span></th>
								<th bgcolor="#45777B"><span class="style3">A/C Ledger</span></th>
							  </tr>
						</thead><tbody>
<?php 
		
if($_SESSION['user']['group']>1)
 echo $rrr="select b.ledger_id, b.ledger_name, b.balance_type FROM accounts_ledger b,ledger_group c where  b.ledger_group_id=c.group_id and b.balance_type>0";
else
 $rrr="select b.ledger_id, b.ledger_name, c.group_name FROM accounts_ledger b,ledger_group c where  b.ledger_group_id=c.group_id and b.balance_type>0";

	
	if(isset($_REQUEST['search']))
	{
		$ladger_group	= mysql_real_escape_string($_REQUEST['ladger_group']);
		$ladger_name	= mysql_real_escape_string($_REQUEST['ladger_name']) ;
	
		$rrr .= " AND b.ledger_name LIKE '%$ladger_name%'";
		$rrr .= " AND c.group_name LIKE '%$ladger_group%'";	
		
if($_REQUEST['sub_ladger']!='')
{
if(is_numeric($_REQUEST['sub_ladger']))
$rrr.=' and a.sub_ledger_id='.$_REQUEST['sub_ladger'];
else
$rrr.=' and a.sub_ledger like "%'.$_REQUEST['sub_ladger'].'%"';
}
	} 
	$rrr .= "  order by ledger_id";

	$report=mysql_query($rrr);

	while($rp=mysql_fetch_row($report))
	{$i++; if($i%2==0)$cls=' class="alt"'; else $cls='';?>
							   <tr<?=$cls?> onclick="DoNav('<?php echo $rp[0];?>');">
				 				<td><nobr><?=$rp[0];?></nobr></td>
								<td><?=$rp[1];?></td>
								<td><?=find_a_field('accounts_ledger','ledger_name','ledger_id='.$rp[2]);?></td>
							  </tr>
	<?php }?></tbody>
							</table>								</td>
								  
<script type="text/javascript">







function Do_Nav()



{



	var URL = 'pop_ledger_selecting_list.php';



	popUp(URL);



}







function DoNav(theUrl)



{



	document.location.href = 'account_sub_ledger_input.php?id='+theUrl;



}



function popUp(URL) 



{



	day = new Date();



	id = day.getTime();



	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=1,menubar=0,resizable=1,width=800,height=800,left = 383,top = -16');");



}



</script>
<script type="text/javascript">


	document.onkeypress=function(e){
	var e=window.event || e
	var keyunicode=e.charCode || e.keyCode
	if (keyunicode==13)
	{
		return false;
	}
}
</script>
<?
require_once "../../../assets/template/layout.bottom.php";
?>