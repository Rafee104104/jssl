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
            <input name="booking_number" type="text" id="booking_number" list="serial_numbers" tabindex="2" onblur="getData2('sr_loan_return_ajax.php', 'agent_info', this.value,  document.getElementById('dealer_code_eng').value);" value="<?=$sr_all->booking_number_eng?>" />
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
		  
		<input   name="sr_loan_id" type="hidden" class="form-control" id="sr_loan_id" value="<? if($$unique>0) echo $$unique; else echo (find_a_field('sr_loan_return','max(sr_loan_id)','1')+1);?>" readonly/>
		
		  
       <input name="dealer_code_eng" required="required" id="dealer_code_eng" value="<?=$dealerAll->dealer_code_eng;?>" style="width:95%; font-size:12px;"  />
                
			
          </div>
        </div>
      </div>
	  
	  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Loan Date:</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
		     
			 <? $sqlDate = 'select date, interest_amt from sr_loan where booking_number ="'.$data[0].'" order by date asc';
			 	$sqlQuery = mysql_query($sqlDate);
				while($sqlResult = mysql_fetch_object($sqlQuery)){
				echo $sqlResult->date."<br>";
			 ?>
			 	<input name="rec_dates[]" type="hidden" id="rec_dates[]" tabindex="2" value="<?=$sqlResult->date;?>" />
				<input name="interest_amts[]" type="hidden" id="interest_amts[]" tabindex="2" value="<?=$sqlResult->interest_amt;?>" />
				
			 <? } ?>
       			<input name="date" type="date" id="date" tabindex="2" value="<?=$ars->date;?>" />
				<input name="intPercentage" id="intPercentage" type="hidden" value="<?=$intPercentage?>"  />
				
			
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
<? if($interest_per >0)  $interest_per; else $interest_per=18; ?>	  
	  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Interest Percentage %</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="interest_per" type="text" id="interest_per" tabindex="4" value="<?=$ars->interest_per;?>" />
          </div>
        </div>
      </div>
	  
	    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Interest Amount</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="interest_amt" type="text" id="interest_amt" tabindex="4" value="<? $per=find_a_field('sr_loan','sum(interest_amt)','booking_number="'.$sr_all->booking_number_eng.'"'); echo $per;?>" />
          </div>
        </div>
      </div>
	  
	  
	  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Interest Per Day</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="interest_rate" type="text" id="interest_rate" tabindex="4" value="<?=($per/360);?>" />
          </div>
        </div>
      </div>
	  
	
	  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Already Paid</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="already_paid" type="text" id="already_paid" tabindex="4" value="<?=$totalPaid;?>" />
			<input name="last_payment_date" type="hidden" id="last_payment_date" value="<?=$lastPyamentDate?>"  />
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
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Total Paid</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="total_paid" type="text" id="total_paid" tabindex="4" value="<?=$total_paid?>" onblur="calculateDays()" />
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
            <input name="total_interest" type="text" id="total_interest" tabindex="4" value="<?=$total_interest?>" />
          </div>
        </div>
      </div>
	  
	  
	  
	  
	   <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Total payable</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="total_payable" type="text" id="total_payable" tabindex="4" value="<?=$total_payable;?>" />
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
