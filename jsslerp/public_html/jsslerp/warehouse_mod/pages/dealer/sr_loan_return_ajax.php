<?php


session_start();


require_once "../../../assets/template/layout.top.php";


@ini_set('error_reporting', E_ALL);


@ini_set('display_errors', 'Off');


$str = $_POST['data'];


$data=explode('##',$str);

  $booking_number_eng=$data[0];
 $sr_all = find_all_field('paid_booking','*','booking_number_eng="'.$data[0].'"');
 
 $booking_type = $data[1];
 
$dealerAll = find_all_field('dealer_info','*','dealer_code_eng="'.$sr_all->agent_id.'"');
$ars = find_all_field('sr_loan','*','booking_number="'.$data[0].'"');

$loanCount = find_a_field('sr_loan','count(sr_loan_id)','booking_number="'.$data[0].'"');

$lastPyamentDate = find_a_field('sr_loan_return','recdate','booking_number="'.$data[0].'"');
$totalPaid = find_a_field('sr_loan_return','sum(total_paid)','booking_number="'.$data[0].'"');
$intPercentage = find_a_field('sr_loan_return','avg(interest_per)','booking_number="'.$data[0].'"');

?>

<div class="row"  id="agent_info">

		<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Booking Number:</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="booking_number" type="text" id="booking_number" list="serial_numbers" tabindex="2" onblur="getData2('sr_loan_return_ajax.php', 'agent_info', this.value,  document.getElementById('dealer_code_eng').value);" value="<?=$sr_all->booking_number_eng ;?>" />
			 <datalist id="serial_numbers">
			 	<option></option>
                <? foreign_relation('paid_booking','booking_number_eng', 'concat(booking_number_eng,"[",name,"]")',$booking_number_eng,'1');?>
              </datalist>

          </div>
        </div>
      </div>
	  
	    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Agent ID:</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
		  
		<input   name="sr_loan_id" type="hidden" class="form-control" id="sr_loan_id" value="<? if($$unique>0) echo $$unique; else echo (find_a_field('sr_loan_return','max(sr_loan_id)','1')+1);?>" readonly/>
		
		  
       <input name="dealer_code_eng" required="required" id="dealer_code_eng" value="<?=$dealerAll->dealer_code_eng;?>" style="width:95%; font-size:12px;"  />
                
			
          </div>
        </div>
      </div>
	  
	  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Loan Date:</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
		     <?
			  
			   //$dealer_code=find_a_field('sale_do_details','dealer_code','do_no='.$$unique);
//			   
//			   $acc_ledger=find_a_field('dealer_info','account_code','dealer_code='.$dealer_code);
//			   
//			   
//			   $booking=find_a_field('sale_do_details','booking_no','do_no='.$$unique);
			    	$sr_sql='select date as sr_date,amount from sr_loan where booking_number="'.$sr_all->booking_number_eng.'"  ';
					$r_query=mysql_query($sr_sql);
			  
			   ?>
			  	
				<select name="loan_date" id="loan_date" value="<?=$loan_date?>" onchange="calculateDays()">
					<option>select Date</option>
					<?php
				
					while($r=mysql_fetch_object($r_query))
					{
					
					
					
					 $selected = ($r->sr_date == $loan_date) ? 'selected' : ''; 
        
        echo "<option value='{$r->sr_date}' $selected>{$r->sr_date}   #> {$r->amount}&#2547;</option>";
					
					}
					?>
				</select>
			 
				
			
          </div>
        </div>
      </div>
      
	 
	<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Loan Paid Date:</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="paid_date" type="date" id="paid_date" tabindex="2" value="<?=$paid_date?>" onchange="calculateDays()"/>
          </div>
        </div>
      </div>
		
		 
      <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Agent Name (Bengali):</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="farmer_name" type="text" id="farmer_name" tabindex="2" value="<?=$sr_all->name?>" />
          </div>
        </div>
      </div>
	  
	        
      <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Village (Bengali):</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="village" type="text" id="village" tabindex="4" value="<?=$sr_all->village?>" />
          </div>
        </div>
      </div>
	  
	   <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Amount:(eng)</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="amount" type="text" id="amount" onkeyup="cal(this.value)" tabindex="4" value=" <? $amt=find_a_field('sr_loan','sum(amount)','booking_number="'.$sr_all->booking_number_eng.'"'); echo $amt;?>" />
          </div>
        </div>
      </div>

	  
	  
	  
	  
	  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Balance</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="already_paid" type="text" id="already_paid" tabindex="4" value="<?=($amt - $totalPaid);?>" />
          </div>
        </div>
      </div>

  
     <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Payment Date:</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
                <input name="recdate" type="date" id="recdate" tabindex="2" value="<?=$recdate;?>"   required/>
            </div>
        </div>
    </div>
	
	<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Loan Paid</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="total_paid" type="text" id="total_paid" tabindex="4" value="<?=$total_paid?>" onkeyup="cal()" />
          </div>
        </div>
      </div>
	
	
	<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Total Days</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
                <input name="total_days" type="text" id="total_days" tabindex="4" value="<?=$total_days?>" />
            </div>
        </div>
    </div>
	  
	      <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Total Interest</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="interest_amt" type="text" id="interest_amt" tabindex="4" value="<?=$interest_amt?>" />
          </div>
        </div>
      </div>
	  
	  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Total Paid</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="total_amount" type="text" id="total_amount" tabindex="4" value="<?=$total_amount?>" />
          </div>
        </div>
      </div>
	  
	  
	   
	  
	  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
          <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text ">Bank/Cash:</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
              <select name="cash_ledger" id="cash_ledger" tabindex="14"    >
			  
				<? foreign_relation('accounts_ledger','ledger_id','ledger_name',$cash_ledger,'ledger_id=12260010003');?>
			  </select>
            </div>
          </div>
        </div>
	  
    </div>
	<p id="result" style="font-weight: bold; color: green;"></p>
<script>
const startInput = document.getElementById('loan_date');
const endInput = document.getElementById('paid_date');
const result = document.getElementById('result');

// Add event listeners to both inputs
startInput.addEventListener('change', calculateDays);
endInput.addEventListener('change', calculateDays);

function calculateDays() {
  const startDate = new Date(startInput.value);
  const endDate = new Date(endInput.value);

  if (!isNaN(startDate) && !isNaN(endDate)) {
    const diffTime = endDate - startDate;
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
    result.innerText = `Total Days: ${diffDays}`;
  } else {
    result.innerText = '';
  }
}
</script>