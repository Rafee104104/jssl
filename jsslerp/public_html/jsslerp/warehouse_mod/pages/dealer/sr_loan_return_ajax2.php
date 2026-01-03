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
        <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">
            
        </label>

        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <!-- Button to Open the Modal -->
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#loanDetailsModal">
                Show Details
            </button>
        </div>
    </div>
</div>






<!-- Bootstrap Modal -->
<style>
    /* Gradient Header */
    .modal-header-gradient {
        background: linear-gradient(to right, #007bff, #6610f2);
        color: white;
    }

    /* Section Headings */
    .section-heading {
        background: linear-gradient(to right, #ff9f43, #ff6f61);
        color: white;
        padding: 8px;
        border-radius: 10px;
        text-align: center;
        font-weight: bold;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .section-heading-green {
        background: linear-gradient(to right, #28a745, #20c997);
    }

    /* Table Styling */
    .table thead {
        background: #343a40;
        color: white;
        text-align: center;
    }

    .table-hover tbody tr:hover {
        background: #f8f9fa;
        transition: 0.3s;
    }

    /* Footer Background */
    .modal-footer {
        background: #444;
    }

    /* Custom Buttons */
    .btn-custom {
        background: linear-gradient(to right, #ff416c, #ff4b2b);
        color: white;
        border: none;
        transition: 0.3s;
    }

    .btn-custom:hover {
        background: linear-gradient(to right, #ff4b2b, #ff416c);
    }
</style>

<div class="modal fade" id="loanDetailsModal" tabindex="-1" aria-labelledby="loanDetailsModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content shadow-lg rounded">
				
							<!-- Modal Header -->
							<div class="modal-header bg-warning">
								<h5 class="modal-title" id="loanDetailsModalLabel"><i class="bi bi-cash-coin"></i> Loan & Payment Details</h5>
								<button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
				
							<!-- Loan Details Section -->
							<div class="modal-body bg-light">
								<h5 class="section-heading"><i class="bi bi-journal-text"></i> Loan Details</h5>
				
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>Loan Date</th>
												<th>Loan Amount (TK)</th>
												<!--<th>Yearly Interest (TK)</th>
												<th>Per Day Interest (TK)</th>
												<th>Days Till Today</th>-->
												<th>Total Interest (TK)</th>
											</tr>
										</thead>
										<tbody>
											<?php
											
											$booking=find_a_field('sale_do_details','booking_no','do_no='.$$unique);
											$sqlDate = 'SELECT date, interest_amt, amount FROM sr_loan WHERE booking_number ="' . $data[0] . '" ORDER BY date ASC';
											$sqlQuery = mysql_query($sqlDate);
											$tot_interest = 0;
				
											while ($sqlResult = mysql_fetch_object($sqlQuery)) {
												$loanDate = $sqlResult->date;
												$interestAmt = $sqlResult->interest_amt;
				
												// Calculate the difference in days between the loan date and today
												$date1 = new DateTime($loanDate);
												$date2 = new DateTime(date('Y-m-d'));
												$diff = $date1->diff($date2)->days;
				
												// Interest calculations
												$perDayInterest = $interestAmt / 360;
												$currentInterest = $diff * $perDayInterest;
												$tot_interest += $currentInterest;
												
												$tot_amt+=$sqlResult->amount;
												$yearly_interest+=$interestAmt;
				
												echo "<tr class='text-center'>";
												echo "<td><i class='bi bi-calendar'></i> " . $loanDate . "</td>";
												echo "<td><i class='bi bi-currency-dollar'></i> " . number_format($sqlResult->amount, 2) . "</td>";
												//echo "<td>" . number_format($interestAmt, 2) . "</td>";
				//                                echo "<td class='text-success'>" . number_format($perDayInterest, 2) . "</td>";
				//                                echo "<td class='text-warning'>" . $diff . " days</td>";
												echo "<td class='text-danger fw-bold'>" . number_format($currentInterest, 2) . "</td>";
												echo "</tr>";
											}
											
											
											 echo "<tr class='text-center'>";
												echo "<th><strong>Total Amount</strong></th>";
												echo "<th>" . number_format($tot_amt, 2) . "</th>";
												//echo "<th>" . number_format($yearly_interest, 2) . "</th>";
				//                                echo "<th></th>";
				//                                echo "<th></th>";
												echo "<th>" . number_format($tot_interest, 2) . "</th>";
												echo "</tr>";
											?>
										</tbody>
									</table>
								</div>
							   
							</div>
				
							<!-- Payment Details Section -->
							<div class="modal-body bg-light">
								<h5 class="section-heading"><i class="bi bi-credit-card"></i> Payment Details</h5>
				
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>Paid Date</th>
												<th>Paid Amount (TK)</th>
												<!--<th>Total Paid Days</th>
												 <th>Per Day Interest (TK)</th>-->
												
												<th>Total Interest (TK)</th>
											</tr>
										</thead>
										<tbody>
											<?php
										   $sqlDate = 'SELECT recdate, total_paid FROM sr_loan_return WHERE booking_number ="' . $data[0] . '" ORDER BY recdate ASC';
													$sqlQuery = mysql_query($sqlDate);
													$tot_paid_amt = 0;
													$tot_paid_interest = 0; // Track total paid interest
													
													while ($sqlResult = mysql_fetch_object($sqlQuery)) {
														$paid_date = $sqlResult->recdate;
														$paid_amt = $sqlResult->total_paid;
														
														// Calculate the number of days from the paid date until today
														$date11 = new DateTime($paid_date);
														$date22 = new DateTime(date('Y-m-d'));
														$diff2 = $date11->diff($date22)->days;
													
														// Interest calculations (assuming 18% yearly interest rate)
														$paid_interest = ($paid_amt * 18) / 100; // 18% per year
														$perDayInterest = $paid_interest / 360;  // Daily interest
														$currentInterest = $diff2 * $perDayInterest; // Total interest for this payment
														$tot_paid_interest += $currentInterest; // Accumulate total paid interest
														$tot_paid_amt += $paid_amt; // Accumulate total paid amount
													if($paid_amt!='')
													{
														echo "<tr class='text-center'>";
														echo "<td><i class='bi bi-calendar'></i> " . $paid_date . "</td>";
														echo "<td class='text-primary'><i class='bi bi-currency-dollar'></i> " . number_format($paid_amt, 2) . "</td>";
														//echo "<td class='text-warning'>" . $diff2 . " days</td>";  // Corrected column placement
				//										echo "<td class='text-success'>" . number_format($perDayInterest, 2) . "</td>";
														echo "<td class='text-danger fw-bold'>" . number_format($currentInterest, 2) . "</td>";
														echo "</tr>";
														
														}
													}
													
														echo "<tr class='text-center'>";
														echo "<th>Total Amount</th>";
														echo "<th class='text-primary'><i class='bi bi-currency-dollar'></i> " . number_format($tot_paid_amt, 2) . "</th>";
														//echo "<th class='text-warning'></th>";  // Corrected column placement
				//										echo "<th class='text-success'></th>";
														echo "<th class='text-danger fw-bold'>" . number_format($tot_paid_interest, 2) . "</th>";
														echo "</tr>";
											
											?>
										</tbody>
									</table>
								</div>
								
							</div>
							
							
							<div class="modal-body bg-light">
								<h5 class="section-heading"><i class="bi bi-credit-card"></i> Due Balance </h5>
				
								
								
							</div>
							
							<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>Due Loan Amount</th>
												<th>Due Interest</th>
												<th>Due Total Amount</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$loan_due = $tot_amt - $tot_paid_amt;
												$interest_due = ($tot_amt+$tot_interest - $tot_paid_interest)- $tot_paid_amt; 
											
												echo "<tr class='text-center'>";
												echo "<td><i class='bi bi-calendar'></i> ";
											
												if ($loan_due > 0) {
													echo $loan_due;
												}
											
												echo "</td>";
												echo "<td class='text-danger fw-bold'>" . number_format($interest_due,2) . "</td>";
												
												echo "<td><i class='bi bi-calendar'></i> ";
													
													if($loan_due>0)
													{
												
													echo number_format($loan_due+$interest_due,2);
													}
													else
													{
													
													echo number_format(0+$interest_due,2);
													}
											
												echo "</td>";
												
												echo "</tr>";
											?>

										</tbody>
									</table>
								</div>
				
							<!-- Modal Footer -->
							<div class="modal-footer">
								<button type="button" class="btn btn-custom" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Close</button>
							</div>
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
            <input name="interest_amt" type="text" id="interest_amt" tabindex="4" value="<?=$tot_interest-$tot_paid_interest;//$per=find_a_field('sr_loan','sum(interest_amt)','booking_number="'.$sr_all->booking_number_eng.'"'); echo $per;?>" />
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
            <input name="already_paid" type="text" id="already_paid" tabindex="4" value="<?=($tot_interest+$amt - $totalPaid-$tot_paid_interest);?>" />
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




