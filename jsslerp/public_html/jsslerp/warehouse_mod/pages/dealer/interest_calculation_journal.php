<?php
require_once "../../../assets/template/layout.top.php";
$title='Delivery Challan';
do_calander('#fdate');
do_calander('#tdate');
$table_master='sale_do_master';
$unique='do_no';

create_combobox('do_no');
create_combobox('dealer_code');

$table_details='sale_do_details';
//$unique_chalan='id';

$$unique=$_POST[$unique];
$tr_type="Show";
//if(isset($_POST['delete']))
//{
//		$crud   = new crud($table_master);
//		$condition=$unique_master."=".$$unique_master;		
//		$crud->delete($condition);
//		$crud   = new crud($table_detail);
//		$crud->delete_all($condition);
//		$crud   = new crud($table_chalan);
//		$crud->delete_all($condition);
//		unset($$unique_master);
//		unset($_SESSION[$unique_master]);
//		$type=1;
//		$msg='Successfully Deleted.';
//}
if(isset($_POST['confirm']))
{
		unset($_POST);
		$_POST[$unique_master]=$$unique_master;
		$_POST['entry_at']=date('Y-m-d h:s:i');
		//$_POST['do_date']=date('Y-m-d');
		$_POST['status']='COMPLETED';
		$crud   = new crud($table_master);
		$crud->update($unique_master);
		$crud   = new crud($table_detail);
		$crud->update($unique_master);
		$crud   = new crud($table_chalan);
		$crud->update($unique_master);
		unset($$unique_master);
		unset($_SESSION[$unique_master]);
		$type=1;
		$msg='Successfully Instructed to Depot.';
		$tr_type="Complete";
}


$table='sale_do_master';
$do_no='do_no';
$text_field_id='do_no';

$target_url = '../wo/delivery_challan.php';

$tr_from="Warehouse";


if(isset($_POST['create_journal'])){
  $user_id = $_SESSION['user']['id'];
  $jv_date = $_POST['tdates'];
  $amount = $_POST['interest_amt'];
  
  $dnarr = 'Booking No'.$_POST['booking_number'];
  
      $tr_from='Journal';
      
	  $dr_ledger = find_a_field('dealer_info','account_code','dealer_code_eng="'.$_POST['dealer_code_eng'].'" '); 
	  $cr_ledger =  '3120020001';
	  

  
  $jv_no =  next_journal_sec_voucher_id($tr_from,'Journal');

  $tr_no = next_tr_no($tr_from);
  $checked='NO';
 
  
  //DR
	add_to_sec_journal($proj_id, $jv_no, $jv_date, $dr_ledger, $dnarr, $amount, '0', $tr_from, $tr_no,'','',$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_from_ac,$checked,$type,$employee,$remarks,$reference_id);
	
  //CR
	add_to_sec_journal($proj_id, $jv_no, $jv_date, $cr_ledger, $dnarr, '0', $amount, $tr_from, $tr_no,'','',$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_to_ac,$checked,$type,$employee,$remarks,$reference_id);
}


?>
<script language="javascript">
window.onload = function() {
  document.getElementById("dealer").focus();
}
</script>
<script language="javascript">
function custom(theUrl)
{
	window.open('<?=$target_url?>?do_no='+theUrl);
}
</script>
<div class="form-container_large">
<style>
/*
.ui-state-default a, .ui-state-default a:link, .ui-state-default a:visited, a.ui-button, a:link.ui-button, a:visited.ui-button, .ui-button {
    color: #454545;
    text-decoration: none;
    display: none;
}*/


/*div.form-container_large input {*/
    /*width: 250px;*/
    /*height: 38px;*/
    /*border-radius: 0px !important;*/
/*}*/



</style>
<div class="form-container_large">
  <form action="" method="post" name="codz" id="codz">
    <div class="container-fluid bg-form-titel">
      <div class="row">
      
      
		  <div class="col-md-6">
          <label>From Date:</label>
          <input type="text" name="fdate" id="fdate" class="from-control" value="<?=($_POST['fdate']!='')?$_POST['fdate']:date('Y-m-01')?>" autocomplete="off"/>
        </div>
        <div class="col-md-6">
          <label>To Date</label>
          <input type="text" name="tdate" id="tdate"  class="from-control" value="<?=($_POST['tdate']!='')?$_POST['tdate']:date('Y-m-d')?>" autocomplete="off"/>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-12 pt-2" align="center">
          <input type="submit" name="submitit" id="submitit" value="VIEW DETAIL" class="btn1 btn1-submit-input"/ >
        </div>
      </div>
    </div>
   
    <div class="container-fluid pt-5 p-0 ">
      <table class="table1  table-striped table-bordered table-hover table-sm">
        <thead class="thead1">
          <tr class="bgc-info">
            <th>SL No</th>
            <th>Loan Date</th>
			<th>Booking NO</th>
			<th>SR NO</th>
            <th>Name</th>
            <th>Loan Amount</th>
			<th>Return Amount</th>
			<th>Balance</th>
			<th>Interest per.</th>
			<th>Days</th>
			<th>Int. Amount</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody class="tbody1">
          <? 
if(isset($_POST['submitit'])){

if($_POST['fdate']!=''&&$_POST['tdate']!='') $con .= ' and date < "'.$_POST['tdate'].'"';

 $res="select  date, dealer_code_eng, booking_number, farmer_name, sum(amount) as amount, interest_per, interest_rate 
  from sr_loan 
 where 1 ".$con." group by booking_number order by date desc  ";
//echo link_report($res,'po_print_view.php');

		$query = mysql_query($res);
		?>
          <?		
		  			 
					
					$sl=1;
					while($row = mysql_fetch_object($query)){
					$loan_return = 0;
					$loan_return = find_a_field('sr_loan_return','sum(total_paid)','booking_number="'.$row->booking_number.'"');
					$balance = ($row->amount-$loan_return);
					
					///
					if($_POST['fdate']<$row->date){
						$fdate = $row->date;
					}else{
						$fdate = $_POST['fdate'];
					}
					$earlier = new DateTime($fdate);
					$later = new DateTime($_POST['tdate']);
					$total_days = $later->diff($earlier)->format("%a")+1;
					
					$intAmt = (($balance*$row->interest_per)/100);
					$intRate = ($intAmt/360);
					$total_interest = ($intRate*$total_days);
					
					?>
          <tr>
            <td><?=$sl++?></td>
            <td><?=$row->date?></td>
			<td><?=$row->booking_number?></td>
            <td><?=$row->sr_no?></td>
            <td><?=$row->farmer_name?></td>
            <td><?=number_format($row->amount,2)?></td>
			<td><?=number_format($loan_return,2)?></td>
			<td><?=number_format($balance,2);?></td>
            <td><?=$row->interest_per?></td>
			<td><?=$total_days;?></td>
			<td><?=number_format($total_interest,2);?></td>
            <td><!--<input type="button" value="Create Journal" onClick="custom(<?=$row->do_no;?>);" class="btn1 btn1-bg-submit" / >-->
            </td>
          </tr>
          <?	$grand_total_int += $total_interest;
				}		}
						?>
						
		<form action="" method="post">
		  <tr>
		  	<td colspan="10" style="text-align:right">Total Interest:</td>
		  	<td><?=number_format($grand_total_int,2);?>
				<input type="hidden" name="interest_amt"  value="<?=$grand_total_int?>"  />
				<input type="hidden" name="tdates"  value="<?=$_POST['tdate']?>"  />
			</td>
		  </tr>	
		  <tr>
		  	<td colspan="12"><input type="submit" class="btn1 btn1-bg-submit" value="Create Journal" name="create_journal" /></td> 
		  </tr>	
		  </form>		
        </tbody>
      </table>
    </div>
  </form>
</div>
<?php /*?><div class="form-container_large">
  <form action="" method="post" name="codz" id="codz">
    <table width="80%" border="0" align="center">
      <tr>
        <td width="153">&nbsp;</td>
        <td colspan="3">&nbsp;</td>
        <td width="141">&nbsp;</td>
      </tr>
      <tr>
        <td align="right" bgcolor="#FF9966"><strong>Customer Name:</strong></td>
        <td bgcolor="#FF9966">
		<select name="dealer_code" id="dealer_code" style="width:250px;">
		
		<option></option>

        <?
		
		foreign_relation('dealer_info','dealer_code','dealer_name_e',$_POST['dealer_code'],'1 order by dealer_code');

		?>
    </select>		</td>
	<td></td>
        <td rowspan="3" bgcolor="#FF9966"><strong>
          <input type="submit" name="submitit" id="submitit" value="VIEW DETAIL" class="btn1 btn1-submit-input" />
        </strong></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#FF9966"><strong>Job No: </strong></td>
        <td bgcolor="#FF9966">
		<select name="do_no" id="do_no" style="width:250px;">
		
		<option></option>

        <? foreign_relation('sale_do_master','do_no','job_no',$_POST['do_no'],'status  in ("CHECKED")');?>
    </select>
		
		</td>
      </tr>
    </table>
  </form>
  
  
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><div class="tabledesign2">
<table width="100%" cellspacing="0" cellpadding="0" id="grp"><tbody>
<tr>
  <th width="10%">SO No </th>
  <th width="18%">SO Date </th>
  <th width="20%">Job No </th>
  <th width="36%">Customer Name </th>
  <th width="16%">Status</th>
</tr>


<? 

if(isset($_POST['submitit'])){

}

//if($_POST['fdate']!=''&&$_POST['tdate']!='') $con .= ' and m.do_date between "'.$_POST['fdate'].'" and "'.$_POST['tdate'].'"';

if($_POST['dealer_code']!='') 
$con .= ' and m.dealer_code in ('.$_POST['dealer_code'].') ';

if($_POST['do_no']!='') 
$con .= ' and m.do_no in ('.$_POST['do_no'].') ';



 		$sql = "select   c.do_no, sum(c.total_unit) as ch_qty  from sale_do_master m, sale_do_chalan c where m.do_no=c.do_no  group by c.do_no ";
		 $query = mysql_query($sql);
		 while($info=mysql_fetch_object($query)){
  		 $ch_qty[$info->do_no]=$info->ch_qty;
		
		
		}



 $res="select  m.do_no, m.job_no, m.dealer_code, m.do_date,  m.status, sum(d.total_unit) as wo_qty,m.status
 
 
  from sale_do_master m, sale_do_details d 
  
 
 where m.do_no=d.do_no and  m.status  in ('CHECKED') ".$con." group by m.do_no order by m.do_date, m.do_no ";

$query = mysql_query($res);
while($data = mysql_fetch_object($query))
{
?>
<!--edit by-->
<? if($data->wo_qty>$ch_qty[$data->do_no]) { ?>
<!--edit by-->
<tr <?=($data->RCV_AMT>0)?'style="background-color:#FFCCFF"':'';?>>
  <td onClick="custom(<?=$data->do_no;?>);" <?=(++$z%2)?'':'class="alt"';?>><?=$data->do_no;?></td>
<td onClick="custom(<?=$data->do_no;?>);" <?=(++$z%2)?'':'class="alt"';?>><?php echo date('d-m-Y',strtotime($data->do_date));?></td>
<td onClick="custom(<?=$data->do_no;?>);" <?=(++$z%2)?'':'class="alt"';?>><?=$data->job_no;?></td>
<td onClick="custom(<?=$data->do_no;?>);" <?=(++$z%2)?'':'class="alt"';?>><?= find_a_field('dealer_info','dealer_name_e','dealer_code="'.$data->dealer_code.'"');?>

<?=//$data->wo_qty?>||  <?=//$ch_qty[$data->do_no]; ?>

</td>
<td onClick="custom(<?=$data->do_no;?>);" <?=(++$z%2)?'':'class="alt"';?>><?=$data->status;?></td>
</tr>


<?
$total_send_amt = $total_send_amt + $data->SEND_AMT;
$total_rcv_amt = $total_rcv_amt + $data->RCV_AMT;

 } }
?>


</tbody></table>
</div></td>
</tr>
</table>
</div><?php */?>
<?
require_once "../../../assets/template/layout.bottom.php";
?>
