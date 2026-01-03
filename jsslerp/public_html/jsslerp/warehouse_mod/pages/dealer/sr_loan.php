<?php

session_start();

ob_start();

require_once "../../../assets/template/layout.top.php";

// ::::: Edit This Section ::::: 

$title='SR Loan';			// Page Name and Page Title

do_datatable('sr_loan');
$page="sr_loan.php";		// PHP File Name
$table='sr_loan';		// Database Table Name Mainly related to this page
$unique='sr_loan_id';			// Primary Key of this Database table
$shown='sr_loan_id';				// For a New or Edit Data a must have data field

// ::::: End Edit Section :::::



//if(isset($_GET['proj_code'])) $proj_code=$_GET[$proj_code];


$crud      =new crud($table);
$$unique = $_GET[$unique];
if(isset($_POST[$shown]))

{

$$unique = $_POST[$unique];

//for Insert..................................

if(isset($_POST['insert']))

{	
//if ($_POST['dealer_found']==0) {}

$proj_id = $_SESSION['proj_id'];

$_POST['entry_by']=$_SESSION['user']['id'];

$_POST['entry_at']=date('Y-m-d h:i:s');

//$wh_data = find_all_field('warehouse','','warehouse_id='.$_POST['depot']); 
$crud->insert();
	$type=1;
		$msg='Successfully Updated.';

unset($_POST);

unset($$unique);


}



//for Modify..................................
if(isset($_POST['update']))
{
		$crud->update($unique);
		 $dealer_code =$_POST['dealer_code'];
		 $account_code = $_POST['account_code'];
	  $sql1 = 'update accounts_ledger set ledger_name="'.$_POST['dealer_name_e'].'" 
	  where ledger_id = '.$account_code;

		//mysql_query($sql1);
		$type=1;
		$msg='Successfully Updated.';
		
	if($_POST['amount'] >0){  
  $master_id = $$unique;
  $reference_id = $master_id;
  
  //////////////////////
  
  
  $user_id = $_SESSION['user']['id'];
  $jv_date = $_POST['date'];
  $amount = $_POST['amount'];
  $user_id = $_SESSION['user']['id'];
  
  $dnarr = 'Booking No'.$_POST['booking_number'].', Interest Rate: '.$_POST['interest_per'].', Interest Amt:'.$_POST['interest_amt'];
  
      $tr_from='SR Loan';
      
	  $cr_ledger = $_POST['cash_ledger']; 
	  $dr_ledger = find_a_field('dealer_info','account_code','dealer_code_eng="'.$_POST['dealer_code_eng'].'" '); 
	  
   
  /// delete old data
  $delQl = 'delete from secondary_journal where tr_from like "SR Loan" and tr_no='.$master_id;
  mysql_query($delQl);
  
  $jv_no =  next_journal_sec_voucher_id($tr_from,'Journal');

  $tr_no = $master_id;
  $checked='NO';
 
  
  //DR
	add_to_sec_journal($proj_id, $jv_no, $jv_date, $dr_ledger, $dnarr, $amount, '0', $tr_from, $tr_no,'','',$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_from_ac,$checked,$type,$employee,$remarks,$reference_id);
	
	//CR
	add_to_sec_journal($proj_id, $jv_no, $jv_date, $cr_ledger, $dnarr, '0', $amount, $tr_from, $tr_no,'','',$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_to_ac,$checked,$type,$employee,$remarks,$reference_id);
	
}
///////////////////////////////////////////
	
}

//for Delete..................................
if(isset($_POST['delete']))
{		$condition=$unique."=".$$unique;		$crud->delete($condition);

		unset($$unique);
		$type=1;
		$msg='Successfully Deleted.';
}
}

if(isset($$unique))

{
$condition=$unique."=".$$unique;
$data=db_fetch_object($table,$condition);

while (list($key, $value)=each($data))

{ $$key=$value;}

}

if(!isset($$unique)) $$unique=db_last_insert_id($table,$unique);

?>
<script type="text/javascript">

$(function() {
		$("#fdate").datepicker({

			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'

		});

});
function Do_Nav()

{
	var URL = 'sr_loan_info.php';
	popUp(URL);
}

function DoNav(theUrl)

{
	document.location.href = '<?=$page?>?<?=$unique?>='+theUrl;
}

function popUp(URL) 

{
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=1,menubar=0,resizable=1,width=800,height=800,left = 383,top = -16');");

}

</script>
<style type="text/css">

.style1 {color: #FF0000}

.style2 {
	font-weight: bold;
	color: #000000;
	font-size: 14px;
}

.style3 {color: #FFFFFF}


</style>
<!--dealer info-->
<div class="form-container_large">
<h4 class="text-center bg-titel bold pt-2 pb-2">
  <?=$title?>
</h4>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check()">
  <div class="container-fluid bg-form-titel">
    <div class="row" id="agent_info">
	
		<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Booking Number:</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="booking_number" type="text" id="booking_number" value="<?=$booking_number?>" list="serial_numbers" tabindex="2" onblur="getData2('sr_loan_ajax.php', 'agent_info', this.value,  document.getElementById('dealer_code_eng').value);" value="<?=$sr_all->booking_number_eng ;?>" />
			 <datalist id="serial_numbers">
                <? foreign_relation('paid_booking','booking_number_eng', 'concat(booking_number_eng,"[",name,"]")',$booking_number_eng,'1');?>
              </datalist>

          </div>
        </div>
      </div>
	  
	  
	    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Agent ID:</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
		  
		<input   name="sr_loan_id" type="hidden" class="form-control" id="sr_loan_id" value="<? if($$unique>0) echo $$unique; else echo (find_a_field($table,'max(sr_loan_id)','1')+1);?>" readonly/>
		
		  
       <input name="dealer_code_eng" required="required" list="agent_ids" id="dealer_code_eng" value="<?=$dealer_code_eng?>" style="width:95%; font-size:12px;"  />
                <datalist id="agent_ids">
                <? //foreign_relation('dealer_info','dealer_code_eng', 'concat(dealer_code_eng,"[",dealer_name_e,"]")',$dealerAll->dealer_code,'1');?>
              </datalist>
			
          </div>
        </div>
      </div>
	  
	  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Date:</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
       <input name="date" type="date" id="date" tabindex="2" value="<?=$date?>" />
			
          </div>
        </div>
      </div>
      

		
		 
      <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Agent Name (Bengali):</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="farmer_name" type="text" id="farmer_name" tabindex="2" value="<?=$farmer_name?>" />
          </div>
        </div>
      </div>
	  
	        
      <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Village (Bengali):</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="village" type="text" id="village" tabindex="4" value="<?=$village?>" />
          </div>
        </div>
      </div>
	  
	   <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Amount:(eng)</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="amount" type="text" id="amount"  onkeyup="cal(this.value)"  tabindex="4" value="<?=$amount?>" />
          </div>
        </div>
      </div>
	  
	   <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Interest Percentage %</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="interest_per" type="text" id="interest_per" tabindex="4" value="<?=$interest_per?>" />
          </div>
        </div>
      </div>
	  
	  
	  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <!--<label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Interest Rate</label>-->
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="interest_rate" type="hidden" id="interest_rate" tabindex="4" value="<?=$interest_rate?>" />
          </div>
        </div>
      </div>
	  
	  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Interest Amount</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="interest_amt" type="text" id="interest_amt" tabindex="4" value="<?=$interest_amt?>" />
          </div>
        </div>
      </div>
	  
	  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
          <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text ">Bank/Cash:</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
              <select name="cash_ledger" id="cash_ledger" tabindex="14"    >
			  
				<? foreign_relation('accounts_ledger','ledger_id','ledger_name',$cash_ledger,'ledger_group_id in (1224001,1226001)');?>
			  </select>
            </div>
          </div>
        </div>
	  
  
      
    </div>
  </div>
  <hr>
  <div class="n-form-btn-class">
    <? if(!isset($_GET[$unique])){?>
    <input name="insert" type="submit" id="insert" value="SAVE &amp; NEW" class="btn1 btn1-bg-submit" />
    <? }?>
    <? if(isset($_GET[$unique])){?>
    <input name="update" type="submit" id="update" value="UPDATE" class="btn1 btn1-bg-update" />
    <? }?>
    <input name="reset" type="button" class="btn1 btn1-bg-cancel" id="reset" value="RESET" onclick="parent.location='<?=$page?>'" />
  </div>
</form>
  </div>

<?







		//if(isset($_POST['search'])){







		?>
<div class="container-fluid pt-5 p-0 ">
  <table id="sr_loan" class="table1  table-striped table-bordered table-hover table-sm">
    <thead class="thead1">
      <tr class="bgc-info">
        <th>Serial No</th>
		<th>Date</th>
        <th>Name</th>
        <th>Village</th>
        <th>Booking No</th>
        <th>Amount </th>
        <th>Interest Rate</th>
		<th>Action</th>

      </tr>
    </thead>
    <tbody class="tbody1">
      <?php
				
				$td='select * from sr_loan where 1 ';
				$report=mysql_query($td);
			    while($data=mysql_fetch_object($report)){
				$found = find_a_field('journal','count(id)','tr_from like "SR Loan" and tr_no='.$data->sr_loan_id);
						?>
					<tr>
						<td><?=$data->sr_loan_id;?></td>
						<td><?=$data->date;?></td>
						<td><?=$data->farmer_name;?></td>
						<td><?=$data->village;?></td>
						<td><?=$data->booking_number;?></td>
						<td><?=$data->amount;?></td>
						<td><?=$data->interest_per;?>%</td>
						<td>
						<? if($found>0){ } else{?>
						<button type="button" onclick="DoNav('<?=$data->sr_loan_id?>')" class="btn1 btn1-bg-primary">Edit</button>
						<? } ?>
						</td>
					</tr>
	  
            
            
      <?php }?>
    </tbody>
  </table>
</div>
<? //}?>
</div>
<script type="text/javascript"><!--
    var pager = new Pager('grp', 10000);
    pager.init();
    pager.showPageNav('pager', 'pageNavPosition');
    pager.showPage(1);

//-->

	document.onkeypress=function(e){
	var e=window.event || e

	var keyunicode=e.charCode || e.keyCode

	if (keyunicode==13)

	{

		return false;

	}

}

function cal(val){
    var vatRate = document.getElementById('interest_per').value*1;
	var amt = ((val*vatRate)/100);
	var rate =  ((amt/360));
	document.getElementById('interest_rate').value=rate.toFixed(2);
	document.getElementById('interest_amt').value=amt;
	
}

</script>
<script>

<?php /*?>function duplicate(){

var dealer_code_2 = ((document.getElementById('dealer_code_2').value)*1);

var customer_id = ((document.getElementById('customer_id').value)*1);

   if(dealer_code_2>0)

  {

alert('This customer code already exists.');
document.getElementById('customer_id').value='';
document.getElementById('customer_id').focus();
  } 
}<?php */?>

</script>
<?

$main_content=ob_get_contents();


ob_end_clean();


include ("../../template/main_layout.php");


?>
