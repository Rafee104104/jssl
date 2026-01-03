<?php
require_once "../../../assets/template/layout.top.php";
$title='Account Sub Sub Ledger';
$proj_id=$_SESSION['proj_id'];
do_datatable('ac_ledger');
$now=time();
$separator	= $_SESSION['separator'];
if(isset($_REQUEST['name'])||isset($_REQUEST['id']))
{
	//common part.............
	
	$id=$_REQUEST['id'];
	//echo $ledger_id;
	$name		= mysql_real_escape_string($_REQUEST['name']);
	$name			= str_replace("'","",$name);
	$name			= str_replace("&","",$name);
	$name			= str_replace('"','',$name);
	$under		= mysql_real_escape_string($_REQUEST['under']);
	$balance	= mysql_real_escape_string($_REQUEST['balance']);
	//end
	if(isset($_POST['nledger']))
	{
			$sql_check="select ledger_group_id,balance_type,budget_enable from accounts_ledger where ledger_id='".$under."' limit 1";
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
			 		$sub_ledger_id=next_sub_sub_ledger_id($under);
					//sub_sub_ledger_create($sub_ledger_id,$name, $under, $balance, $now, $proj_id);
					$group_for=$_SESSION['user']['group'];
					$ledger_layer=3;

					ledger_create($sub_ledger_id,$name,$ledger_data[0],$group_for,$under,$ledger_data[1],'','', time(),$ledger_layer,$ledger_data[2]);
					$sql = 'update accounts_ledger set ledger_layer = 3 where ledger_id = '.$sub_ledger_id.' ';
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
$search_sql="select 1 from sub_sub_ledger where `sub_sub_ledger_id`!='$id' and `sub_sub_ledger` = '$name' limit 1";
if(mysql_num_rows(mysql_query($search_sql))==0)
	{
		$sql_check="select ledger_id from accounts_ledger where ledger_id=".$under;
		$sql_query=mysql_query($sql_check);
		if(mysql_num_rows($sql_query)==1){
		$id=$_REQUEST['id'];
		$sql2="UPDATE `accounts_ledger` SET 
		`ledger_name`= '$name'	, balance_type = $under	
			WHERE `ledger_id` 		='$id' LIMIT 1";
		//$sql="UPDATE `sub_sub_ledger` SET `sub_sub_ledger` = '$name' WHERE `sub_sub_ledger_id` =$id LIMIT 1";
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
$sql="delete from `sub_sub_ledger` where `sub_sub_ledger_id`='$id' limit 1";
$query=mysql_query($sql);
$sql="delete from `accounts_ledger` where `ledger_id`='$id' limit 1";
$query=mysql_query($sql);
		$type=1;
		$msg='Successfully Deleted.';
}

	$ddd="select * from accounts_ledger where ledger_id='$id'";
	$data=mysql_fetch_row(mysql_query($ddd));
}

auto_complete_from_db('accounts_ledger','ledger_name','ledger_id','ledger_layer=2','under');
?>
<style type="text/css">
<!--
.style3 {color: #FFFFFF; font-weight: bold; }
-->
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>    <td width="66%" style="padding-right:5%">
	<div class="left">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
								    <td><div class="box"><form id="form1" name="form1" method="post" action=""><table width="100%" border="0" cellspacing="2" cellpadding="0">
                                      <tr>
                                        <td align="right">Sub Sub Ledger   : </td>
                                        <td width="60%" align="right">
                <input name="search_u_s_s_l" type="text" id="search_u_s_s_l" value="<?php echo $_REQUEST['search_u_s_s_l']; ?>" /></td>
                                      </tr>
                                      <tr>
                                        <td align="right">Under Sub Ledger  : </td>
                                        <td align="right">
                <input name="search_u_s_l" type="text" id="search_u_s_l" value="<?php echo $_REQUEST['search_u_s_l']; ?>" /></td>
                                      </tr>
                                      <tr>
                                        <td colspan="2"><input class="btn" name="search" type="submit" id="search" value="Show" /></td>
                                      </tr>
                                    </table>
								    </form></div></td>
						      </tr>
								  <tr>
									<td>&nbsp;</td>
								  </tr>
								  <tr>
									<td>
									<table id="ac_ledger" class="table table-striped table-bordered" cellspacing="0">
									<thead>
							  <tr>
								<th bgcolor="#45777B"><span class="style3">Sub Sub Ledger ID</span></th>
								<th bgcolor="#45777B"><span class="style3">Sub Sub Ledger</span></th>
								<th bgcolor="#45777B"><span class="style3">Under Sub Ledger</span></th>
							  </tr>
							  </thead><tbody>
<?php 

if($_SESSION['user']['group']>1)
$rrr="select b.ledger_id, b.ledger_name, b.balance_type  FROM accounts_ledger b,ledger_group c where  b.ledger_group_id=c.group_id and b.ledger_layer=3 and c.group_for=".$_SESSION['user']['group'];
else
$rrr="select z.* FROM sub_sub_ledger z,sub_ledger a,accounts_ledger b,ledger_group c where a.ledger_id=b.ledger_id and b.ledger_group_id=c.group_id and z.sub_ledger_id=a.sub_ledger_id";

if($_REQUEST['search_u_s_s_l']!='')
{
if(is_numeric($_REQUEST['search_u_s_s_l']))
$rrr.=' and z.sub_sub_ledger_id='.$_REQUEST['search_u_s_s_l'];
else
$rrr.=' and z.sub_sub_ledger like "%'.$_REQUEST['search_u_s_s_l'].'%"';
}

if($_REQUEST['search_u_s_l']>0)
$rrr.=' and z.sub_ledger_id='.$_REQUEST['search_u_s_l'];
	
	$report=mysql_query($rrr);
//echo $rrr;
	while($rp=@mysql_fetch_row($report))
	{$i++; if($i%2==0)$cls=' class="alt"'; else $cls='';?>
							   <tr<?=$cls?> onclick="DoNav('<?php echo $rp[0];?>');">
								<td><nobr><?=$rp[0];?></nobr></td>
								<td><?=$rp[1];?></td>
								<td><?=find_a_field('accounts_ledger','ledger_name','ledger_id='.$rp[2]);?></td>
							  </tr>
	<?php }?></tbody>
							</table>									</td>
								  </tr>
								</table>

							</div></td>    <td valign="top" width="34%" >
	<div class="rights"><form id="form2" name="form2" method="post" action="?id=<?php echo $id;?>">
							  <table width="100%" border="0" cellspacing="0" cellpadding="0">
							  
							  <tr>
								
								
								

                                  <td width="100%" colspan="2"><div class="box style2" style="width:400px;">

                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">

									  


                                      <tr>

                                        <th style="font-size:16px; padding:5px; color:#FFFFFF" bgcolor="#45777B"> <div align="center">
                                          <?=$title?>
                                        </div></th>
                                      </tr></table>

                                  </div></td>
                                </tr>
							  
							  
							  
							  
                                <tr>
                                  <td><div class="box">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td>Sub Sub Ledger: </td>
                                        <td><input name="name" required type="text" id="name" value="<?php echo $data[1];?>" class="required"  style="width:250px;"/></td>
									  </tr>

                                      <tr>
                                        <td>Under Sub Ledger  : </td>
                                        <td><input type="text" required name="under" id="under" value="<?php echo $data[4];?>" class="required" style="width:250px;" /></td>
									  </tr>
                                    </table>
                                  </div></td>
                                </tr>
                                
                                
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>
								  <div class="box1">
								  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td><? if($data[0]==""){?><input name="nledger" type="submit" id="nledger" value="Record" class="btn" /><? }?></td>
                                      <td><? if($data[0]!=""){?><input name="mledger" type="submit" id="mledger" value="Modify" class="btn" /><? }?></td>
                                      <td><input name="Button" type="button" class="btn" value="Clear" onClick="parent.location='account_sub_sub_ledger.php'"/></td>
                                      <td><? if($_SESSION['user']['level']==10){?><input class="btn" name="dledger" type="submit" id="dledger" value="Delete"/><? }?></td>
                                    </tr>
                                  </table>
								  </div>								  </td>
                                </tr>
                              </table>
    </form>
							</div></td>
  </tr>
</table>
<script type="text/javascript">







function Do_Nav()



{



	var URL = 'pop_ledger_selecting_list.php';



	popUp(URL);



}







function DoNav(theUrl)



{



	document.location.href = 'account_sub_sub_ledger.php?id='+theUrl;



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