<?php
require_once "../../../assets/template/layout.top.php";
$title='Sales Quotation Status';

do_calander('#fdate');
do_calander('#tdate');

$table = 'sale_requisition_master';
$unique = 'do_no';
$status = 'CHECKED';
$target_url = '../mrsp/mr_print_view.php';



if(isset($_POST['return'])){


	$sql = "update sale_requisition_master set status='MANUAL' where do_no=".$_POST['do_no']."";
	mysql_query($sql);

	$type=1;

	$msg='Quotation Is Been Returned.';

}





auto_complete_from_db('dealer_info','concat(dealer_name_e)','dealer_code','1','dealer');



?>
<script language="javascript">
function custom(theUrl)
{
	window.open('<?=$target_url?>?<?=$unique?>='+theUrl);
}
</script>
<div class="form-container_large">
<form action="" method="post" name="codz" id="codz">
<table width="80%" border="0" align="center">



  <tr>
  <td align="right"  bgcolor="#FF9966">Group</td>
		  
<td bgcolor="#FF9966">
    
    
<input list="dealer_groups" name="dealer_group" type="text" id="dealer_group" style="background-color:white;" autocomplete="off"/>
<datalist  id="dealer_groups">
<?  foreign_relation('dealer_type','id','dealer_type','','1');?>
</datalist>	
		 </td>
<td align="right"  bgcolor="#FF9966">Customer List</td>
		<td  bgcolor="#FF9966">
		  <input name="dealer" type="text" id="dealer" style="background-color:white;" autocomplete="off"/></td>
		  
		  
</tr>
<tr>
		  <td align="right" bgcolor="#FF9966"><strong>Quo No:</strong></td>
		  <td  bgcolor="#FF9966">
		  <input name="do_no" type="text" id="do_no" style="background-color:white;" autocomplete="off"/></td>
    <td align="right" bgcolor="#FF9966"><strong>Date:</strong></td>
    <td  bgcolor="#FF9966"><strong>
      <input type="text" name="fdate" id="fdate" style="width:120px;" value="<?=$_POST['fdate']?>" autocomplete="off" />
    </strong></td>
    <td align="center" bgcolor="#FF9966"><strong> -to- </strong></td>
    <td  bgcolor="#FF9966"><strong>
      <input type="text" name="tdate" id="tdate" style="width:120px;" value="<?=$_POST['tdate']?>" autocomplete="off" />
    </strong></td>
    <td  bgcolor="#FF9966"><strong>
      <input type="submit" name="submitit" id="submitit" value="VIEW DETAIL" style="font-weight:bold; font-size:12px; height:30px; color:#090"/>
    </strong></td>
</tr>
  
</table>

</form>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><div class="tabledesign2">
<? 
if($_POST['dealer_group']!='') 
$con .= ' and d.dealer_type='.$_POST['dealer_group'].' ';

if($_POST['status']!=''&&$_POST['status']!='ALL')
$con .= 'and a.status="'.$_POST['status'].'"';

if($_POST['fdate']!=''&&$_POST['tdate']!='')
$con .= 'and a.do_date between "'.$_POST['fdate'].'" and "'.$_POST['tdate'].'"';

if($_POST['dealer']!='') 
$con .= ' and a.dealer_code='.$_POST['dealer'].' ';

if($_POST['do_no']!='') 
$con .= ' and a.do_no='.$_POST['do_no'].' ';

 $res='select  	a.do_no,concat("Q-000",a.do_no) as Quotation_no, DATE_FORMAT(a.do_date, "%d-%m-%Y") as Qutation_date, a.status,u.fname,sum(b.total_amt) total ,concat(d.dealer_code,"-",d.dealer_name_e) as dealer_name,  a.entry_at from sale_requisition_master a,sale_requisition_details b,dealer_info d,user_activity_management u where 
  a.dealer_code=d.dealer_code and a.do_no=b.do_no '.$con.' and a.status in ("CHECKED", "COMPLETED") and u.user_id=a.entry_by group by a.do_no order by a.do_no desc';
  
  $query = mysql_query($res);
  
  

  
  
//echo link_report($res,'mr_print_view.php');



?>
<table id="grp" cellspacing="0" cellpadding="0" width="100%">

		

		<tr>

		<th >Quo No</th>

		<th >Qutation_date</th>

		<th >Status</th>

		<th >Customer Name</th>

        <th >Amount</th>

		<th>Entry info </th>
		<th>Action</th>
		</tr>

<?
 	while($data = mysql_fetch_object($query)){
	
?>
	<tr>
			<td><?=$data->Quotation_no;?></td>

			<td><?=$data->Qutation_date;?></td>

			<td><?=$data->status;?></td>

			<td><?=$data->dealer_name;?></td>
			
				<td><?=number_format($data->total,2);?></td>

			<td><?=$data->fname;?><br><?=$data->entry_at;?></td>
			<td>
				


<form action="" method="post" name="cz" id="cz" onSubmit="if(!confirm('Are You Sure Execute this?')){return false;}">
      <input  name="do_no" type="hidden" id="do_no" value="<?=$data->do_no;?>"/>
        <a href="mr_print_pdf_new.php?do_no=<?=$data->do_no?>" class="btn btn-sm btn-success" target="_blank">Pdf</a><br>
		<a href="mr_print_pdf_new_no_pad.php?do_no=<?=$data->do_no?>" class="btn btn-sm btn-info" target="_blank">Pdf Without Pad</a><br>
      <input name="return" type="submit" value="Return for Edit" style="font-weight:bold; font-size:12px; color:red;" />

	</form>

			</td>
			
	
	</tr>
<? } ?>

</div></td>
</tr>
</table>

<?
require_once "../../../assets/template/layout.bottom.php";
?>