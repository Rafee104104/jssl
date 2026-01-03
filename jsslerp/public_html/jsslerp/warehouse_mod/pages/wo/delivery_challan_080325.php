<?php

require_once "../../../assets/template/layout.top.php";
$title='Delivery Challan Create';

$tr_type="Show";

do_calander('#so_date');

do_calander('#chalan_date');

$table_master='sale_do_master';

$table_details='sale_do_details';

$unique='do_no';




if($_SESSION[$unique]>0)
$$unique=$_SESSION[$unique];


if($_REQUEST[$unique]>0){
$$unique=$_REQUEST[$unique];
$_SESSION[$unique]=$$unique;}

else

 $$unique = $_SESSION[$unique];




if(isset($_POST['confirmm'])){

		unset($_POST);
		$_POST[$unique]=$$unique;
		$_POST['edit_by']=$_SESSION['user']['id'];
		$_POST['edit_at']=date('Y-m-d h:i:s');
		$_POST['status']='PROCESSING';
		$crud   = new crud($table_master);
		$crud->update($unique);
		unset($$unique);
		unset($_SESSION[$unique]);

		$type=1;

		$msg='Successfully Completed All Purchase Order.';


		echo '<script>window.location.replace("select_unfinished_do.php")</script>';

		$tr_type="Complete";

}



if(isset($_POST['return'])){
		$remarks = $_POST['return_remarks'];

        unset($_POST);

		$_POST[$unique]=$$unique;

        $_POST['status']='MANUAL';

		$_POST['checked_at'] = date('Y-m-d H:i:s');

		$_POST['checked_by'] = $_SESSION['user']['id'];

		$crud   = new crud($table_master);

		$crud->update($unique);

		$note_sql = 'insert into approver_notes(`master_id`,`type`,`note`,`entry_at`,`entry_by`) value("'.$$unique.'","CHALAN","'.$remarks.'","'.date('Y-m-d H:i:s').'","'.$_SESSION['user']['id'].'")';

		mysql_query($note_sql);
		unset($$unique);
		unset($_SESSION[$unique]);

		$type=1;

        echo $msg='<span style="color:green;">Successfully Returned</span>';

		echo '<script>window.location.replace("select_wo_for_challan.php")</script>';

}









if(isset($_POST['delete'])){

		unset($_POST);

		$_POST[$unique]=$$unique;

		$_POST['edit_by']=$_SESSION['user']['id'];

		$_POST['edit_at']=date('Y-m-d H:i:s');

		$_POST['status']='CHECKED';

		$crud   = new crud($table_master);

		$crud->update($unique);

		unset($$unique);

		unset($_SESSION[$unique]);

		$type=1;

		$msg='Order Returned.';
}







if(prevent_multi_submit()){

if(isset($_POST['confirm'])){
        
        $do_sl_no=$_POST['do_sl_no'];
        $or_sl_no=$_POST['or_sl_no'];

		$ch_date=$_POST['chalan_date'];

		$rec_name=$_POST['rec_name'];

		$rec_mob=$_POST['rec_mob'];

		$vehicle_no=$_POST['vehicle_no'];

		$driver_name=$_POST['driver_name'];

		$driver_mobile=$_POST['driver_mobile'];

		$delivery_point=$_POST['delivery_point'];

		$delivery_man=$_POST['delivery_man'];

		$delivery_man_mobile=$_POST['delivery_man_mobile'];

		$entry_by= $_SESSION['user']['id'];

		$entry_at = date('Y-m-d H:i:s');


		$YR = date('Y',strtotime($ch_date));

  		$yer = date('y',strtotime($ch_date));

  		$month = date('m',strtotime($ch_date));



  		$ch_cy_id = find_a_field('sale_do_chalan','max(ch_id)','year="'.$YR.'"')+1;

   		$cy_id = sprintf("%07d", $ch_cy_id);

   		$chalan_no=''.$yer.''.$month.''.$cy_id;


		//$chalan_no = next_transection_no($group_for,$ch_date,'sale_do_chalan','chalan_no');
		//$gate_pass = next_transection_no('0',$ch_date,'sale_do_chalan','gate_pass');


		  $ms_data = find_all_field('sale_do_master','','do_no='.$do_no);
		  
		  $sql = 'select d.* from sale_do_details d, item_info i where  d.item_id=i.item_id and d.do_no = '.$do_no;
		  $query = mysql_query($sql);



		//$pr_no = next_pr_no($warehouse_id,$rec_date);




		$total_sales_amt = 0;
		$tot_labour_charge=0;
		while($data=mysql_fetch_object($query)){
			$booking_no = $data->booking_no;
			$dist_unit = $data->dist_unit;

			if($_POST['chalan_'.$data->id]>=0 && $_POST['chalan_'.$data->id] <= $_POST['stk_qty_'.$data->id]){
				$qty=$_POST['chalan_'.$data->id];
				$depot_id=$_POST['depot_id_'.$data->id];
				$rate=$_POST['rate_'.$data->id];
				$item_id =$_POST['item_id_'.$data->id];
				$store_rent =$_POST['store_rent_'.$data->id];
				$labour_charge =$_POST['labour_charge_'.$data->id];
				$seeds_loan =$_POST['seeds_loan_'.$data->id];
				$bag_loan =$_POST['bag_loan_'.$data->id];
				$farmer_loan =$_POST['farmer_loan_'.$data->id];
				$sr_loan =$_POST['sr_loan_'.$data->id];
				$others_loan =$_POST['others_loan_'.$data->id];
				$loan_days =$_POST['loan_days_'.$data->id];
				$total_interest =$_POST['total_interest_'.$data->id];
				
				$total_amt =$_POST['total_amt_'.$data->id];
				$booking_no =$_POST['booking_no_'.$data->id];
				$sr_no =$_POST['sr_no_'.$data->id];
				//$amount = ($qty*$rate); 
				$total_loan=$seeds_loan+$bag_loan+$farmer_loan+$sr_loan+$others_loan;
				$total_loan_actual+=$total_loan;
				//$total_rent+=$store_rent;
				$total_store_rent_actual+=$store_rent;
				$total_rent_and_loan=$total_store_rent_actual+$total_loan_actual;
				
				$total_sales_amt = $total_rent_and_loan;
				
				$tot_labour_charge+=$labour_charge;
				$tot_interest+=$total_interest;
				$cash=$total_loan_actual+$tot_labour_charge+$tot_interest+$total_store_rent_actual;
				$total_cash=$cash;
				$dealer_code = $data->dealer_code;
				
				
	$cost_price=find_a_field('journal_item','final_price','item_id="'.$item_id.'" and tr_from in ("Purchase","Opening","Production Receive","Receive","fg_transfer") order by id desc ');
				
	$cost_amt = ($qty*$cost_price); 

 


   $so_invoice = 'INSERT INTO sale_do_chalan (year, ch_id, chalan_no, chalan_date, order_no, do_no, job_no, do_date, item_id, dealer_code, unit_price, pkt_size, pkt_unit, dist_unit, total_unit, total_amt, discount, depot_id, group_for, rec_name, rec_mob, vehicle_no, driver_name, driver_mobile, delivery_point, delivery_man, delivery_man_mobile, entry_by, entry_at, status, cost_price, cost_amt,store_rent,labour_charge,seeds_loan,bag_loan,farmer_loan,sr_loan,others_loan,loan_days,total_interest,booking_no,sr_no)


  

  VALUES("'.$YR.'","'.$ch_cy_id.'","'.$chalan_no.'","'.$ch_date.'","'.$data->id.'","'.$data->do_no.'","'.$data->job_no.'","'.$data->do_date.'","'.$item_id.'","'.$data->dealer_code.'","'.$rate.'","'.$pkt_size.'","'.$pkt_unit.'","'.$qty.'","'.$qty.'","'.$total_amt.'","'.$discount.'","'.$depot_id.'","'.$ms_data->group_for.'","'.$rec_name.'","'.$rec_mob.'","'.$vehicle_no.'","'.$driver_name.'","'.$driver_mobile.'","'.$delivery_point.'","'.$delivery_man.'","'.$delivery_man_mobile.'","'.$entry_by.'","'.$entry_at.'","CHECKED", "'.$cost_price.'", "'.$cost_amt.'","'.$store_rent.'","'.$labour_charge.'","'.$seeds_loan.'","'.$bag_loan.'","'.$farmer_loan.'","'.$sr_loan.'","'.$others_loan.'","'.$loan_days.'","'.$total_interest.'","'.$booking_no.'","'.$sr_no.'")';



mysql_query($so_invoice);


	journal_item_control($item_id, $depot_id, $ch_date,  0, $qty, 'Sales', $data->id, $rate, '', $chalan_no, '', '',$ms_data->group_for, $rate->unit_price, $data->sr_no);
//  journal_item_control($orDetail->item_id ,$warehouse,$orAll->or_date,$qty,0,$page_for,$orDetail->id,$orDetail->rate,'',$or_no,'','','','',$orAll->bag_mark); //10

	//////////// Loan Return
	$loan_paid_amt=$_POST['loan_paid_'.$data->id];
	$total_interest=$_POST['total_interest_'.$data->id];
	
	$loan_date=$_POST['loan_date_'.$data->id];
	$payment_date=$ch_date;
	$interest_per=$_POST['interest_per_'.$data->id];
	$cash_ledger=$_POST['cash_ledger_'.$data->id];
	$loan_interest_sum = ($loan_paid_amt+$total_interest);
	
		if($loan_paid_amt>0){
			
			///
			echo  $loan_return = "INSERT INTO `sr_loan_return`
			(`date`, `recdate`,  `dealer_code_eng`, `booking_number`, `sr_number`,  `amount`, `interest_per`, `interest_amt`,
			 `total_paid`, `total_payable`,  `entry_by`, `cash_ledger`, chalan_no) 
				VALUES 
			 ('".$loan_date."', '".$payment_date."','".$dealer_code."','".$data->booking_no."','".$data->sr_no."','".$loan_paid_amt."','".$interest_per."','".$total_interest."',
			 '".($loan_paid_amt+$total_interest)."', '".($loan_paid_amt+$total_interest)."', '".$_SESSION['user']['id']."', '".$cash_ledger."', '".$chalan_no."')";
			 $query = mysql_query($loan_return);
			// $master_id = mysql_insert_id($query );
			$master_id = find_a_field('sr_loan_return','sr_loan_id','chalan_no='.$chalan_no);
			///
		
			$sqlin = "INSERT INTO `loan_assign`(`booking_no`, `token_number`, `bag_mark`, `amount_out`, `entry_by`, chalan_no, total_interest) 
					 VALUES ('".$data->booking_no."','','".$data->sr_no."','".$loan_paid_amt."','".$_SESSION['user']['id']."','".$chalan_no."' ,'".$total_interest."')";
			 mysql_query($sqlin);
			
			
			/////////===========================================\\\\\\\\\\\\\\\\\\\\\\\\\\\\
			  $user_id = $_SESSION['user']['id'];
			  $jv_date = $payment_date;
			  $amount = $loan_interest_sum;
			  
			  $dnarr = 'Booking No'.$data->booking_no.', Interest Rate: '.$interest_per.', Interest Amt:'.$total_interest.', Chalan No: '.$chalan_no;
			  
			  $tr_from='SR Loan Return';
			  
			  $dr_ledger = $cash_ledger; 
			  $cr_ledger = find_a_field('dealer_info','account_code','dealer_code_eng="'.$dealer_code.'" '); 
				  
			  $reference_id =  $chalan_no;
			  // delete old data
			  $delQl = 'delete from secondary_journal where tr_from like "SR Loan Return" and tr_no='.$master_id;
			  mysql_query($delQl);
			  
			  $jv_no =  next_journal_sec_voucher_id($tr_from,'Journal');
			
			  $tr_no = $master_id;
			  $checked='NO';
			 
			  
			  //DR
				add_to_sec_journal($proj_id, $jv_no, $jv_date, $dr_ledger, $dnarr, $amount, '0', $tr_from, $tr_no,'','',$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_from_ac,$checked,$type,$employee,$remarks,$reference_id);
				
				//CR
				add_to_sec_journal($proj_id, $jv_no, $jv_date, $cr_ledger, $dnarr, '0', $amount, $tr_from, $tr_no,'','',$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_to_ac,$checked,$type,$employee,$remarks,$reference_id);
				
				
			///////////=========================================\\\\\\\\\\\\\\\\\\\\\\\\\\\\
		}
	////////////// End

$tr_no=$chalan_no;

$tr_id=$data->id;

$tr_type="Add";

if($dist_unit==$qty || $qty==0)
{

			$vars['status']='COMPLETED';
			db_update($table_master, $data->do_no, $vars, 'do_no');
}
}

else
{
	echo "<srcipt> Challan is more Than Stock </script>";

}

header('Location: select_wo_for_challan.php');
}







	



}



}



else



{



	$type=0;



	$msg='Data Re-Submit Warning!';



}
if($$unique>0)



{



		$condition=$unique."=".$$unique;



		$data=db_fetch_object($table_master,$condition);



		while (list($key, $value)=each($data))



		{ $$key=$value;}



		



}









$tr_from="Warehouse";


?>
<script>









function calculation(id){



var chalan=((document.getElementById('chalan_'+id).value)*1);



var pending_qty=((document.getElementById('unso_qty_'+id).value)*1);

var stock_qty=((document.getElementById('stk_qty_'+id).value)*1);



if(chalan>stock_qty)
 {

alert('Can not issue more than Stock quantity');



document.getElementById('chalan_'+id).value='';



  }





 if(chalan>pending_qty)

  {

alert('Can not issue more than pending quantity.');



document.getElementById('chalan_'+id).value='';



  } 





}



</script>

<div class="form-container_large">

</script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
<div class="form-container_large">
  <form action="" method="post" name="codz" id="codz" onSubmit="if(!confirm('Are You Sure Execute this?')){return false;}">
  
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
												<th>Per Day Interest (TK)</th>-->
												<th>Total Days</th>
												<th>Total Interest (TK)</th>
											</tr>
										</thead>
										<tbody>
											<?php
											
											$booking=find_a_field('sale_do_details','booking_no','do_no='.$$unique);
										 	$sqlDate = 'SELECT  l.date, l.interest_amt, l.amount FROM sr_loan l, journal j WHERE l.sr_loan_id=j.tr_no and j.tr_from="SR Loan"  and l.booking_number ="' . $booking . '" and j.dr_amt>0 ORDER BY l.date ASC';
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
				
					                           echo "<td class='text-warning'>" . $diff . " days</td>";
												echo "<td class='text-danger fw-bold'>" . number_format($currentInterest, 2) . "</td>";
												echo "</tr>";
											}
											
											
											 echo "<tr class='text-center'>";
												echo "<th><strong>Total Amount</strong></th>";
												echo "<th>" . number_format($tot_amt, 2) . "</th>";
												//echo "<th>" . number_format($yearly_interest, 2) . "</th>";
				//                                echo "<th></th>";
				                               echo "<th></th>";
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
											<th>Total Paid Days</th>
													<!-- <th>Per Day Interest (TK)</th>-->
												
												<th>Total Interest (TK)</th>
											</tr>
										</thead>
										<tbody>
											<?php
																	
									 $dealer_code=find_a_field('sale_do_details','dealer_code','do_no='.$$unique);
									   
									   $acc_ledger=find_a_field('dealer_info','account_code','dealer_code='.$dealer_code);
		
										   $sqlDate = 'SELECT c.chalan_date, j.cr_amt FROM sale_do_chalan c,journal j WHERE c.chalan_no=j.tr_no and j.tr_from="Sales" and c.booking_no ="' . $booking . '" and j.ledger_id="'.$acc_ledger.'" and j.cr_amt>0 group by j.tr_no ORDER BY c.chalan_date ASC';
													$sqlQuery = mysql_query($sqlDate);
													$tot_paid_amt = 0;
													$tot_paid_interest = 0; // Track total paid interest
													
													while ($sqlResult = mysql_fetch_object($sqlQuery)) {
														$paid_date = $sqlResult->chalan_date;
														$paid_amt = $sqlResult->cr_amt;
														
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
														echo "<td class='text-warning'>" . $diff2 . " days</td>";  // Corrected column placement
				//										echo "<td class='text-success'>" . number_format($perDayInterest, 2) . "</td>";
														echo "<td class='text-danger fw-bold'>" . number_format($currentInterest, 2) . "</td>";
														echo "</tr>";
														
														}
													}
													
														echo "<tr class='text-center'>";
														echo "<th>Total Amount</th>";
														echo "<th class='text-primary'><i class='bi bi-currency-dollar'></i> " . number_format($tot_paid_amt, 2) . "</th>";
														//echo "<th class='text-warning'></th>";  // Corrected column placement
														echo "<th class='text-success'></th>";
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
																								
												echo "<td><i class='bi bi-calendar'></i> ";
													
													
												
													echo number_format($interest_due-$loan_due,2);
												
													
											echo "<td class='text-danger fw-bold'>" . number_format($interest_due,2) . "</td>";

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
  
  <form action="" method="post" name="codz" id="codz" onSubmit="if(!confirm('Are You Sure Execute this?')){return false;}">
    <!--        top form start hear-->
    <div class="container-fluid bg-form-titel">
      <div class="row">
        <!--left form-->
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
          <div class="container n-form2">
            <div class="form-group row m-0 pb-1">
              <? $field='do_no';?>
              <label for="<?=$field?>" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">SO NO </label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                <input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>" readonly="readonly"/>
              </div>
            </div>
            <div class="form-group row m-0 pb-1">
              <? $field='do_date';?>
              <label for="<?=$field?>" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">SO Date</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>" readonly="readonly"/>
              </div>
            </div>
            <div class="form-group row m-0 pb-1">
              <? $field='job_no';?>
              <label for="<?=$field?>" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Job No</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>" readonly="readonly" />
              </div>
            </div>
          </div>
        </div>
        <!--Right form-->
        <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5">
          <div class="container n-form2">
            <div class="form-group row m-0 pb-1">
              <? $field='group_for'; $table='user_group';$get_field='id';$show_field='group_name';?>
              <label for="<?=$field?>" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Company </label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                <input  name="group_for2" type="text" id="group_for2" value="<?=find_a_field($table,$show_field,$get_field.'='.$$field)?>" readonly="readonly" />
                <input  name="group_for" type="hidden" id="group_for" value="<?=$group_for?>" readonly="readonly"/>
              </div>
            </div>
            <div class="form-group row m-0 pb-1">
              <? $field='req_no'; $table='purchase_master';$get_field='req_no';$show_field='req_no';?>
              <label for="<?=$field?>" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Customer Name</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input  name="dealer_code2" type="text" id="dealer_code2" value="<?=find_a_field('dealer_info','dealer_name_e','dealer_code='.$dealer_code);?>" readonly="readonly"/>
                <input  name="dealer_code" type="hidden" id="dealer_code" value="<?=$dealer_code?>" readonly="readonly"/>
              </div>
            </div>
            <div class="form-group row m-0 pb-1">
              <label for="<?=$field?>" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Remarks</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input  name="remarks" type="text" id="remarks" value="<?=$remarks?>"  readonly="readonly"/>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
          <div class="d-flex justify-content-center ">
            <div class="n-form1 fo-white pt-0 p-0">
              <div class="container p-0">
                <table class="table1  table-striped table-bordered table-hover table-sm">
                  <thead>
                    <tr class="bgc-yellow">
                      <td><strong>Date</strong></td>
                      <td><strong>Chalan No</strong></td>
                    </tr>
                  </thead>
                  <?

 
										$sql='select distinct chalan_no, chalan_date from sale_do_chalan where do_no='.$$unique.' order by id desc';

										

										$qqq=mysql_query($sql);

										

										while($aaa=mysql_fetch_object($qqq)){

										

										?>
                  <tr>
                    <td><?php echo date('d-m-Y',strtotime($aaa->chalan_date));?></td>
                    <td ><a target="_blank" href="challan_invoice_print_view.php?v_no=<?=$aaa->chalan_no?>">
                      <?=$aaa->chalan_no?>
                      </a></td>
                  </tr>
                  <?

										

										}

										

										?>
                </table>
              </div>
			  <div class="pt-1 " align="center">
			  <button type="button" class="btn1 btn1-bg-help" data-bs-toggle="modal" data-bs-target="#loanDetailsModal">
                Loan Details
          	  </button>
			  
			  </div>
            </div>
			
			
          </div>
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-center pt-2 pb-2">
      <div class="n-form1 fo-white pt-0 p-0">
        <div class="container p-0">
          <table class="table1  table-striped table-bordered table-hover table-sm">
            <tr>
              <td colspan="3" align="center"><strong>Entry Information</strong></td>
            </tr>
            <tr>
              <td align="right" >Created By:</td>
              <td align="left" >&nbsp;&nbsp;
                <?=find_a_field('user_activity_management','fname','user_id='.$entry_by);?></td>
              <td rowspan="2" align="center" ><a title="WO Preview" target="_blank" href="../../../sales_mod/pages/wo/sales_order_print_view.php?v_no=<?=$$unique?>" ><img src="../../../images/print.png" alt="" width="30" height="30" /></a></td>
            </tr>
            <tr>
              <td align="right" >Created On:</td>
              <td align="left">&nbsp;&nbsp;
                <?=$entry_at?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <div class="container-fluid bg-form-titel">
	
      <div class="row">
	  
        <!--left form-->
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
		
          <div class="container n-form2">
		  
            <div class="form-group row m-0 pb-1">
              <?
			 
			$max_chalan_no = find_a_field('sale_do_chalan','max(chalan_no)','1')+1;
			  
			   $ch_data = find_all_field('sale_do_chalan','','chalan_no='.$_SESSION['chalan_no']);?>
              <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Chalan Date </label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
			  
			  	<? if($_POST['chalan_date']=='') { ?>
                <input name="chalan_date" type="text" id="chalan_date" required="required" value="<?=find_a_field('sale_do_chalan','chalan_date','1 order by id desc');?>"/>
				<? } else { ?>
				<input name="chalan_date" type="text" id="chalan_date" required="required" value="<?=$_POST['chalan_date'];?> ">
				
				<? } ?>
              </div>
            </div>
            
            <div class="form-group row m-0 pb-1">
              <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Order SL NO</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                <input type="text"  value="<?=$_GET['do_no']; ?>" readonly="readonly" />
              </div>
            </div>
          </div>
        </div>
        <!--Right form-->
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
          <div class="container n-form2">
            <div class="form-group row m-0 pb-1">
              <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">ক্রেতার নামঃ</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                <input  name="rec_name" type="text" value="<?=$_POST['rec_name'];?>" id="rec_name" />
              </div>
            </div>
            <!--<div class="form-group row m-0 pb-1">
              <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Driver Name</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input name="driver_name" type="text" id="driver_name" value="<?=$ch_data->driver_name;?>"  />
              </div>
            </div>
            <div class="form-group row m-0 pb-1">
              <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Delivery Man</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                <input  name="delivery_man" type="text" id="delivery_man" value="<?=$ch_data->delivery_man;?>"  />
              </div>
            </div>-->
          </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
          <div class="container n-form2">
		  
		  	<div class="form-group row m-0 pb-1">
              <label  class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">DO SL No</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input name="" type="text" id="" readonly="readonly" value="<?=$max_chalan_no?>" />
              </div>
            </div>
			
			
            <!--<div class="form-group row m-0 pb-1">
              <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Receiver Mobile </label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                <input   name="rec_mob" value="<?=$ch_data->rec_mob;?>"  type="text" id="rec_mob" />
              </div>
            </div>
            <div class="form-group row m-0 pb-1">
              <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Driver Mobile</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input  name="driver_mobile"  type="text" id="driver_mobile" value="<?=$ch_data->driver_mobile;?>" />
              </div>
            </div>
            <div class="form-group row m-0 pb-1">
              <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Delivery Man Mobile</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                <input  name="delivery_man_mobile" type="text" id="delivery_man_mobile" value="<?=$ch_data->delivery_man_mobile;?>"  />
              </div>
            </div>-->
          </div>
		  
		  
        </div>
      </div>
	  <strong style="color:red;">Notice: After set Challan Date You have to must Click in Set Challan Date</strong>
	  <div class="n-form-btn-class">
        	<input  name="deliery" type="submit" id="deliery" class="btn1 btn1-bg-help" value="Set Challan Date"  />
     		 </div>
    </div>
    <!--return Table design start-->
    <div class="container-fluid pt-5 p-0 ">
      <? if($$unique>0){


									   $sql = "SELECT j.id, w.warehouse_name, j.barcode, w.warehouse_id , sum(j.item_in-j.item_ex) stock, j.bag_size
											 from warehouse w, journal_item j , warehouse_other_receive a
											 WHERE w.warehouse_name=j.warehouse_id and j.item_id=100010001 and w.warehouse_name=j.warehouse_id
											 group by j.barcode,j.warehouse_id having sum(j.item_in-j.item_ex)>0 ";

   $sql='select a.id, a.sr_no , a.item_id,  a.unit_price, b.item_name,  b.unit_name,  a.dist_unit as qty , a.booking_no

 from sale_do_details a,item_info b, item_sub_group s where b.item_id=a.item_id 

  and b.sub_group_id=s.sub_group_id and  a.do_no='.$$unique;



$res=mysql_query($sql);



?>
      <table class="table1  table-striped table-bordered table-hover table-sm">
        <thead class="thead1">
          <tr class="bgc-info">
            <th>SL</th> 
            <th>SR No </th>
            <th>Booking No </th>
			      <th>Warehouse</th>
           <!-- <th>Loan (BDT)</th>-->
		   <th>Challan Issue</th>
           
            <th>Store Rent </th>
            <th>Labour Charge </th>
            <th>Stock Qty</th>
            <th>SO Qty </th>
            <th>Delivered</th>
            <th>Pending </th>
            <th>Seeds Loan</th>
            <th>Bag Loan</th>
            <th>Farmer Loan</th>
            <th>SR Loan</th>
            <th>Others Loan</th>
            <th>Loan Days</th>
			      <!--<th>Loan Paid</th>-->
            <th>Interest</th>
            <th>Cash Ledger </th>
            
            <!--<th>Challan Issue </th>-->
			<th>Total Amt</th>
          </tr>
        </thead>
        <tbody class="tbody1">
          <? while($row=mysql_fetch_object($res)){
		  
		  
		   $unit_price = find_a_field('paid_booking','booking_rate','booking_number_eng like "'.$row->booking_no.'"');
		   $loan_info = find_all_field('sr_loan','date','booking_number like "'.$row->booking_no.'" order by sr_loan_id asc ');
		   $all_booking = find_all_field('paid_booking','','booking_number_eng like "'.$row->booking_no.'"');
		   $loan22=find_all_field('loan_assign','','booking_no like "'.$row->booking_no.'" and bag_mark like "'.$row->sr_no.'"');
		   $startDate = $loan_info->date;
		  
		   $endDate = $_POST['chalan_date'];
		   
		  $bg++?>
		  
		 
          <tr>
            <td><?=++$ss;?></td>
            <td style="text-align:left"><?=$row->sr_no?></td>
            <td style="text-align:left"><?=$row->booking_no?>
			  <input type="hidden" id="booking_no_<?=$row->id?>" name="booking_no_<?=$row->id?>" value="<?=$row->booking_no?>"  />  
			  <input type="hidden" id="sr_no_<?=$row->id?>" name="sr_no_<?=$row->id?>" value="<?=$row->sr_no?>"  />    
              <input type="hidden" name="item_id_<?=$row->id?>" id="item_id_<?=$row->id?>" value="<?=$row->item_id?>" />
              <input type="hidden" name="rate_<?=$row->id?>" id="rate_<?=$row->id?>" value="<?=$unit_price;?>" /></td>
			  <td style="text-align:left"><?=$row->warehouse_id?>
               <select name="depot_id_<?=$row->id?>" id="depot_id_<?=$row->id?>" onchange="getData2('itemJournalAjaxList.php', 'tk47bd', this.value)" >
                
                <? //foreign_relation('journal_item','warehouse_id','warehouse_id',' barcode="'.$row->sr_no.'"');  //warehouse_id="'.$res->warehouse_id.'" and and
					 $sq = 'select warehouse_id from journal_item where barcode="'.$row->sr_no.'" HAVING sum(item_in-item_ex)>0 ';
					$qu = mysql_query($sq);
					while($re = mysql_fetch_object($qu)){
				?>
					<option><?=$re->warehouse_id;?></option>
				<? } ?>
              </select>            
			              </td>
           <!-- <td align="center"><?=$loan = find_a_field('loan_assign','sum(amount_in-amount_out)','bag_mark like "'.$row->sr_no.'" ');?>            </td>
           
           -->
		   <td align="center">
		   <? $so_qty = (find_a_field('sale_do_chalan','sum(total_unit)','order_no="'.$row->id.'" and item_id="'.$row->item_id.'"')*(1));$tot_so_qty+=$so_qty;


			  

			  $unso_qty=($row->qty-$so_qty); $tot_pening+=$unso_qty;?>
		   <? if($unso_qty>=0){ $cow++;?>
              <input name="chalan_<?=$row->id?>" type="text" id="chalan_<?=$row->id?>" value=""   onKeyUp="alldatacaculate(<?=$row->id?>);" />
			   <? } else echo 'Done';?>  
                         </td>
            <td align="center"><input type="text" name="store_rent_<?=$row->id?>" id="store_rent_<?=$row->id?>" value="<? //$all_booking->total_amount;?>" style="width:60px !important;" />
			<input type="hidden" name="store_rents_<?=$row->id?>" id="store_rents_<?=$row->id?>" value="<?=$all_booking->booking_rate;?>" style="width:60px !important;" /></td>
			<? $stock_qty=find_a_field('journal_item','sum(item_in)-sum(item_ex)','item_id="'.$row->item_id.'" and barcode="'.$row->sr_no.'"' );?>
            <td align="center"><input type="text" name="labour_charge_<?=$row->id?>" id="labour_charge_<?=$row->id?>" value="<? //$labour_char=($stock_qty*25); $tot_labour_charge+=$labour_char;?>" readonly="readonly" style="width:60px !important;" /> </td>
            <td align="center"><? echo number_format($stock_qty=find_a_field('journal_item','sum(item_in)-sum(item_ex)','item_id="'.$row->item_id.'" and barcode="'.$row->sr_no.'"' ),2); $tot_stock+=$stock_qty;?>
              <input type="hidden" name="stk_qty_<?=$row->id?>" id="stk_qty_<?=$row->id?>" value="<?=$stock_qty?>"  onKeyUp="calculation(<?=$row->id?>)" /></td>
            <td align="center"><?=number_format($row->qty,2); $tot_qtys+=$row->qty;?></td>
            <td align="center"><? echo number_format($so_qty = (find_a_field('sale_do_chalan','sum(total_unit)','order_no="'.$row->id.'" and item_id="'.$row->item_id.'"')*(1)),2);$tot_so_qty+=$so_qty;?></td>
            <td align="center"><? 



			  

			  echo number_format($unso_qty=($row->qty-$so_qty),2); $tot_pening+=$unso_qty;?>
              <input type="hidden" name="unso_qty_<?=$row->id?>" id="unso_qty_<?=$row->id?>" value="<?=$unso_qty?>"  onKeyUp="calculation(<?=$row->id?>)" /></td>
            <td align="center"><input type="text" name="seeds_loan_<?=$row->id?>" id="seeds_loan_<?=$row->id?>" onKeyUp="loan_calculate(<?=$row->id?>);" value="<? //$loan22->seeds_loan; $tot_seeds_loan+=$loan22->seeds_loan;?>"/>
			<input type="hidden" name="seeds_loans_<?=$row->id?>" id="seeds_loans_<?=$row->id?>" value="<?=$loan22->seeds_loan; $tot_seeds_loan+=$loan22->seeds_loan;?>"/>			</td>
            <td align="center"><input type="text" name="bag_loan_<?=$row->id?>" id="bag_loan_<?=$row->id?>" onKeyUp="loan_calculate(<?=$row->id?>);" />
			<input type="hidden" name="bag_loans_<?=$row->id?>" id="bag_loans_<?=$row->id?>" value="<?=$loan22->bag_loan; $tot_bag_loan+=$loan22->bag_loan;?>"/></td>
            <td align="center"><input type="text" name="farmer_loan_<?=$row->id?>" id="farmer_loan_<?=$row->id?>" onKeyUp="loan_calculate(<?=$row->id?>);" />
			<input type="hidden" name="farmer_loans_<?=$row->id?>" id="farmer_loans_<?=$row->id?>" value="<?=$loan22->farmer_loan; $tot_farmer_loan+=$loan22->farmer_loan;?>"/></td>
            <td align="center"><input type="text" name="sr_loan_<?=$row->id?>" id="sr_loan_<?=$row->id?>" onKeyUp="loan_calculate(<?=$row->id?>);" />
			<input type="hidden" name="sr_loans_<?=$row->id?>" id="sr_loans_<?=$row->id?>" value="<?=$loan22->sr_loan; $tot_sr_loan+=$loan22->sr_loan;?>"/></td>
            <td align="center"><input type="text" name="others_loan_<?=$row->id?>" id="others_loan_<?=$row->id?>" onKeyUp="loan_calculate(<?=$row->id?>);" />
			<input type="hidden" name="others_loans_<?=$row->id?>" id="others_loans_<?=$row->id?>" value="<?=$loan22->others_loan; $tot_others_loan+=$loan22->others_loan;?>"/></td>
            <td align="center"><input name="loan_days_<?=$row->id?>" type="text" id="loan_days_<?=$row->id?>" value="" readonly />
			<input name="loan_date_<?=$row->id?>" id="loan_date_<?=$row->id?>" type="hidden" value="<?=$startDate?>"  />
			  <input name="payment_date_<?=$row->id?>" id="payment_date_<?=$row->id?>" type="hidden" value="<?=$endDate?>"  />
			  
			  <input name="interest_per_<?=$row->id?>" id="interest_per_<?=$row->id?>" type="hidden" value="<?=$loan_info->interest_per?>"  />		</td>
			  
			 <!--<td align="center"><? if($unso_qty>0){ $cow++;?>
			 
              <input name="loan_paid_<?=$row->id?>" type="text" id="loan_paid_<?=$row->id?>" value=""  onkeyup="calculateDays(<?=$row->id?>)" />
			  <input name="loan_date_<?=$row->id?>" id="loan_date_<?=$row->id?>" type="hidden" value="<?=$startDate?>"  />
			  <input name="payment_date_<?=$row->id?>" id="payment_date_<?=$row->id?>" type="hidden" value="<?=$endDate?>"  />
			  <input name="interest_per_<?=$row->id?>" id="interest_per_<?=$row->id?>" type="hidden" value="<?=$loan_info->interest_per?>"  />
              <? } else echo 'Done';?>            </td>-->
          	 
			  
             <td align="center"><input type="text" name="total_interest_<?=$row->id?>" id="total_interest_<?=$row->id?>" onKeyUp="loan_calculate(<?=$row->id?>);"  /></td>
             <td align="center">
			 	<select name="cash_ledger_<?=$row->id?>" >
					<? foreign_relation('accounts_ledger','ledger_id','ledger_name',$cash_ledger,'ledger_id=12260010003'); //foreign_relation('accounts_ledger','ledger_id','ledger_name',$cash_ledger,'ledger_group_id in (1224001,1226001)'); ?>
				</select>			 </td>
             
            <!--<td align="center"><? if($unso_qty>0){ $cow++;?>
              <input name="chalan_<?=$row->id?>" type="text" id="chalan_<?=$row->id?>" value=""   onKeyUp="alldatacaculate(<?=$row->id?>);" />
              <? } else echo 'Done';?>            </td>-->
			  <td align="center"><input type="text"  name="total_amt_<?=$row->id?>" id="total_amt_<?=$row->id?>" value="" style="width:70px !important"/></td>
          </tr>
          <? }?>
		  <!--<tr>
		  	<td colspan="4">Total</td>
			
			<td><?=$all_booking->total_amount;?></td>
			<td>&nbsp;</td>
			<td><?=$tot_labour_charge;?></td>
			<td><?=$tot_stock;?></td>
			<td><?=$tot_qtys;?></td>
			<td><?=$tot_so_qty;?></td>
			<td><?=$tot_pening;?></td>
			<td><?=$tot_seeds_loan;?></td>
			<td><?=$tot_bag_loan;?></td>
			<td><?=$tot_farmer_loan;?></td>
			<td><?=$tot_sr_loan;?></td>
			<td><?=$tot_others_loan;?></td>
			<td></td>
			<!--<td></td>-->
			<td><?=$tot_interest;?></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
        </tbody>
      </table>
    </div>
    <!--button design start-->
    <div class="container-fluid p-0 ">
      <div class="n-form-btn-class">
        <? if($cow<0){
			$vars['status']='COMPLETED';
			db_update($table_master, $do_no, $vars, 'do_no');
		?>
        <div class="alert alert-success p-2" role="alert"> THIS  SALES ORDER IS COMPLETE </div>
        <? }else{

			$chalaned = find_a_field('sale_do_chalan','sum(dist_unit)','do_no="'.$do_no.'"');

			if($chalaned>0){

			?>
        <input name="confirm" type="submit" class="btn1 btn1-submit-input" value="CONFIRM CHALLAN" />
        </td>
        <? } else{?>
        <input name="return" type="submit" class="btn1 btn1-bg-cancel" value="RETURN" onclick="return_function()" />
        <input  name="do_no" type="hidden" id="do_no" value="<?=$do_no;?>"/>
        <input type="hidden" name="return_remarks" id="return_remarks">
        </td>
        <input name="confirm" type="submit" class="btn1 btn1-bg-submit" value="CONFIRM CHALLAN"  />
        <? } }?>
      </div>
    </div>
    <? } ?>
  </form>
</div>
</tr>
<tr>
  <td colspan="5" valign="top"><script>$("#codz").validate();$("#cloud").validate();</script>
    <script>

function count()
{


if(document.getElementById('unit_price').value!=''){



var unit_price = ((document.getElementById('unit_price').value)*1);

var dist_unit = ((document.getElementById('dist_unit').value)*1);

var total_unit = (document.getElementById('total_unit').value)=dist_unit;

var total_amt = (document.getElementById('total_amt').value) = total_unit*unit_price;

var pcs_stock = ((document.getElementById('pcs_stock').value)*1);
if(dist_unit>pcs_stock){
	alert("Stock Overflow");
	document.getElementById('dist_unit').value = 0;
}else{


var total_amt = (document.getElementById('total_amt').value) = dist_unit*unit_price;

}

}

}

function return_function() {

  var notes = prompt("Why Return This?","");

  if (notes!=null) {

    document.getElementById("return_remarks").value =notes;

	document.getElementById("cz").submit();

  }

  return false;

}



function calculateDays(val) {
        var loanDate = new Date(document.getElementById('loan_date_'+val).value);

        var paymentDate = new Date(document.getElementById('payment_date_'+val).value);

        var difference = Math.abs(paymentDate - loanDate);

        var daysDifference = Math.ceil(difference / (1000 * 60 * 60 * 24));

	var challan_qty = parseFloat(document.getElementById('chalan_'+val).value)*1;
	var intPercent = parseFloat(document.getElementById('interest_per_'+val).value);
	var intAmt = ((paidAmount*intPercent)/100);
	var interestRate = (intAmt/360);

    var totalInterest = daysDifference * interestRate;
	
    document.getElementById('total_interest_'+val).value = totalInterest;
    document.getElementById('loan_days_'+val).value = daysDifference;
	
	 //var amt = parseFloat(document.getElementById('amount').value);
      
    var totalPayable = paidAmount + totalInterest;
    //document.getElementById('total_payable').value = totalPayable;
	
    }
	
	
	function alldatacaculate(val) {
        
	var stk_qty = (document.getElementById('stk_qty_'+val).value)*1;
	var seeds_loan = (document.getElementById('seeds_loans_'+val).value)*1;
	var bag_loan = (document.getElementById('bag_loans_'+val).value)*1;
	var farmer_loan = (document.getElementById('farmer_loans_'+val).value)*1;
	var sr_loan = (document.getElementById('sr_loans_'+val).value)*1;
	var others_loan = (document.getElementById('others_loans_'+val).value)*1;
	var challan_qty = (document.getElementById('chalan_'+val).value)*1;
	var store_rent = (document.getElementById('store_rents_'+val).value)*1;
	
	
 
	 	
		
		var tot_seeds_loan = parseFloat(((seeds_loan / stk_qty) * challan_qty).toFixed(2)) || 0;
    var tot_bag_loan = parseFloat(((bag_loan / stk_qty) * challan_qty).toFixed(2)) || 0;
    var tot_farmer_loan = parseFloat(((farmer_loan / stk_qty) * challan_qty).toFixed(2)) || 0;
    var tot_sr_loan = parseFloat(((sr_loan / stk_qty) * challan_qty).toFixed(2)) || 0;
    var tot_others_loan = parseFloat(((others_loan / stk_qty) * challan_qty).toFixed(2)) || 0;

    var tot_labour_charge = parseFloat(((challan_qty * 25)).toFixed(2)) || 0;
    var tot_store_rent = parseFloat((store_rent * challan_qty).toFixed(2)) || 0;
	
	
	 
	 
	 var loanDate = new Date(document.getElementById('loan_date_'+val).value);

        var paymentDate = new Date(document.getElementById('payment_date_'+val).value);

        var difference = Math.abs(paymentDate - loanDate);

        var daysDifference = Math.ceil(difference / (1000 * 60 * 60 * 24)) || 0;
		
		var intPercent = parseFloat(document.getElementById('interest_per_'+val).value);
		var intAmt = ((tot_sr_loan*intPercent)/100);
		var interestRate = (intAmt/360);
    	var totalSRInterest = daysDifference * interestRate;
	
	
		var intAmount = ((tot_farmer_loan*intPercent)/100);
		var interestRates = (intAmount/360);
		var totalFRInterest = daysDifference * interestRates;
		var totinterest=totalFRInterest+totalSRInterest || 0;
		
	
	document.getElementById('loan_days_'+val).value = daysDifference;
	
	
	document.getElementById('seeds_loan_'+val).value=tot_seeds_loan;
	document.getElementById('bag_loan_'+val).value=tot_bag_loan;
	document.getElementById('farmer_loan_'+val).value=tot_farmer_loan;
	document.getElementById('sr_loan_'+val).value=tot_sr_loan;
	document.getElementById('others_loan_'+val).value=tot_others_loan;
	 document.getElementById('loan_days_'+val).value = daysDifference;
	 document.getElementById('labour_charge_'+val).value=tot_labour_charge;
	 document.getElementById('store_rent_'+val).value=tot_store_rent;
	  document.getElementById('total_interest_'+val).value=Math.floor(totinterest);
	  
	var totAmount = totinterest + tot_seeds_loan + tot_bag_loan + tot_farmer_loan + tot_sr_loan + tot_others_loan + tot_labour_charge + tot_store_rent;
	
    document.getElementById('total_amt_' + val).value =(totAmount % 1 >= 0.50) ? Math.ceil(totAmount) : Math.floor(totAmount);
	   
	
    }
	
	function loan_calculate(val)
	{
	
	var seeds_loan_x = (document.getElementById('seeds_loan_'+val).value)*1;
	var bag_loan_x = (document.getElementById('bag_loan_'+val).value)*1;
	var farmer_loan_x = (document.getElementById('farmer_loan_'+val).value)*1;
	var sr_loan_x = (document.getElementById('sr_loan_'+val).value)*1;
	var others_loan_x = (document.getElementById('others_loan_'+val).value)*1;
	
	
	var stk_qty = (document.getElementById('stk_qty_'+val).value)*1;
	var seeds_loan = (document.getElementById('seeds_loans_'+val).value)*1;
	var bag_loan = (document.getElementById('bag_loans_'+val).value)*1;
	var farmer_loan = (document.getElementById('farmer_loans_'+val).value)*1;
	var sr_loan = (document.getElementById('sr_loans_'+val).value)*1;
	var others_loan = (document.getElementById('others_loans_'+val).value)*1;
	
	var challan_qty = (document.getElementById('chalan_'+val).value)*1;
	var store_rent = (document.getElementById('store_rents_'+val).value)*1;
	
	
	var tot_seeds_loan = parseFloat(((seeds_loan / stk_qty) * challan_qty).toFixed(2)) || 0;
	var tot_bag_loan = parseFloat(((bag_loan / stk_qty) * challan_qty).toFixed(2)) || 0;
    var tot_farmer_loan = parseFloat(((farmer_loan / stk_qty) * challan_qty).toFixed(2)) || 0;
    var tot_sr_loan = parseFloat(((sr_loan / stk_qty) * challan_qty).toFixed(2)) || 0;
    var tot_others_loan = parseFloat(((others_loan / stk_qty) * challan_qty).toFixed(2)) || 0;
	
	var tot_labour_charge = parseFloat(((challan_qty * 25)).toFixed(2)) || 0;
    var tot_store_rent = parseFloat((store_rent * challan_qty).toFixed(2)) || 0;
	
	
	var loanDate = new Date(document.getElementById('loan_date_'+val).value);

        var paymentDate = new Date(document.getElementById('payment_date_'+val).value);

        var difference = Math.abs(paymentDate - loanDate);

        var daysDifference = Math.ceil(difference / (1000 * 60 * 60 * 24)) || 0;
		
		var intPercent = parseFloat(document.getElementById('interest_per_'+val).value);
		
		if(sr_loan_x>0)
		{
		var intAmt = ((sr_loan_x*intPercent)/100);
		var interestRate = (intAmt/360);
    	var totalSRInterest = daysDifference * interestRate;
		
		}
		else
		{
		
		var intAmt = ((tot_sr_loan*intPercent)/100);
		var interestRate = (intAmt/360);
    	var totalSRInterest = daysDifference * interestRate;
		}
			
			
	
		if(farmer_loan_x>0)
		{
		var intAmount = ((farmer_loan_x*intPercent)/100);
		var interestRates = (intAmount/360);
		var totalFRInterest = daysDifference * interestRates;
	
		}
		else
		{
		var intAmount = ((tot_farmer_loan*intPercent)/100);
		var interestRates = (intAmount/360);
		var totalFRInterest = daysDifference * interestRates;
		}
		
		
		
		var totinterest=totalFRInterest+totalSRInterest || 0;
		
		
		document.getElementById('total_interest_'+val).value=(totinterest % 1 >= 0.50) ? Math.ceil(totinterest) : Math.floor(totinterest);
	
	if(seeds_loan_x>0)
	{
	
	var seeeds_laon=seeds_loan_x;
	}
	else
	{
	var seeeds_laon=tot_seeds_loan;
	}
	
	if(bag_loan_x>0)
	{
	
	var baag_loan=bag_loan_x;
	}
	else
	{
	var baag_loan=tot_bag_loan;
	}
	
	if(farmer_loan_x>0)
	{
	
	var farmeer_loan=farmer_loan_x;
	}
	else
	{
	var farmeer_loan=tot_farmer_loan;
	}
	
	if(sr_loan_x>0)
	{
	
	var srr_loan=sr_loan_x;
	}
	else
	{
	var srr_loan=tot_sr_loan;
	}
	
	if(others_loan_x>0)
	{
	
	var otherss_loan=others_loan_x;
	}
	else
	{
	var otherss_loan=tot_others_loan;
	}
	
	var total=seeeds_laon+baag_loan+farmeer_loan+srr_loan+otherss_loan+tot_store_rent+tot_labour_charge+totinterest;
	
    document.getElementById('total_amt_' + val).value =(total % 1 >= 0.50) ? Math.ceil(total) : Math.floor(total);
	   
	
    
	
	}
	
	
	$(document).ready(function () {
    $('#chalan_date').on('change', function () {
        var chalanDate = $(this).val(); // Get the selected chalan date

        // AJAX request to update the payment_date field
        $.ajax({
            url: 'chalan_ajax.php', // Server-side script to handle the request
            type: 'POST',
            data: { chalan_date: chalanDate },
            success: function (response) {
                // Update the payment_date field
                $('#payment').val(response);
            },
            error: function () {
                alert('Failed to fetch the payment date. Please try again.');
            }
        });
    });
});





	
</script>




    <?



require_once "../../../assets/template/layout.bottom.php";




?>
