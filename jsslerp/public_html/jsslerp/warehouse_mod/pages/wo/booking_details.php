<?php
require_once "../../../assets/template/layout.top.php";

$title = "Loan & Payment Report";
$booking_no = $_GET['booking_no'] ;

if (empty($booking_no)) {
    echo "<div class='alert alert-danger text-center mt-5'>?? No booking number provided!</div>";
    exit;
}

$unique = 'do_no';
?>

<!-- ================== STYLES ================== -->
<style>
/* Card styling */
.card {
    border-radius: 12px !important;
    overflow: hidden !important;
    box-shadow: 0 3px 8px rgba(0,0,0,0.1);
}

/* Header gradient */
.card-header {
    background: linear-gradient(90deg, #FFA726, #FF7043) !important;
    color: #fff !important;
    font-weight: 600 !important;
    font-size: 16px;
}

/* Table design */
.table thead {
    background: linear-gradient(90deg, #f7c948, #ffc107) !important;
    color: #fff !important;
    font-weight: 600 !important;
}

.table tbody tr {
    background-color: #fcfcfc !important;
    transition: background 0.3s !important;
}

.table tbody tr:hover {
    background-color: #f1f1f1 !important;
}

.table tfoot, .table tbody tr:last-child {
    background-color: #f5f5f5 !important;
    font-weight: 700 !important;
}

/* Amount colors */
.text-paid {
    color: #1E88E5 !important;
    font-weight: 600 !important;
}

.text-interest {
    color: #E53935 !important;
    font-weight: 600 !important;
}

/* Center text in cells */
.table th, .table td {
    text-align: center !important;
    vertical-align: middle !important;
}


@media print {

    /* Remove site elements and make full width */
    body, html {
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        height: 100% !important;
    }

    /* Hide everything outside the container */
    body * {
        visibility: hidden;
    }

    .container, .container * {
        visibility: visible;
    }

    .container {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        padding: 0;
        margin: 0;
    }

    /* Remove colors and shadows for clean B&W print */
    .card, .card-header, .table, .table thead, .table tbody tr {
        background: none !important;
        color: #000 !important;
        box-shadow: none !important;
    }

    .table th, .table td {
        border: 1px solid #000 !important;
        color: #000 !important;
        padding: 5px !important;
    }

    /* Hide buttons, icons, links */
    .btn, i, nav, header, footer, aside {
        display: none !important;
    }

    /* Page setup */
    @page {
        size: A4 portrait;
        margin: 10mm;
    }

    /* Prevent cards breaking across pages */
    .card {
        page-break-inside: avoid;
        page-break-after: auto;
    }

    /* Optional: full-width table */
    .table {
        width: 100% !important;
        border-collapse: collapse !important;
    }
}



</style>

<div class="container my-5">

    <div class="text-end mb-3">
    <button onclick="window.print()" class="btn btn-dark">
        <i class="bi bi-printer"></i> Print
    </button>
</div>


    <!-- ==================== SR LOAN DETAILS ==================== -->
    <div class="card mb-4">
        <div class="card-header text-center" style="text-align:center !important; line-height:1.6;">
    <div style="font-size:16px; font-weight:600;">
        <i class="bi bi-building"></i> Jamuna Seeds Storage (Pvt.) Ltd
    </div>
    <div style="margin-top:4px;">
        <i class="bi bi-journal-text"></i> Booking No: <?= htmlspecialchars($booking_no) ?>
    </div>
	
    <div style="margin-top:2px;">
        SR Loan Payment Details
    </div>
</div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" width="100%">
                    <thead>
                        <tr>
                            <th>Loan Date</th>
                            <th>Loan Amount (TK)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT l.date, l.amount 
                                FROM sr_loan l, journal j 
                                WHERE l.sr_loan_id=j.tr_no 
                                  AND j.tr_from='SR Loan'
                                  AND l.booking_number='$booking_no'
                                  AND j.dr_amt>0 
                                ORDER BY l.date ASC";
                        $q = mysql_query($sql);
                        $tot_amt = 0;
                        while ($res = mysql_fetch_object($q)) {
                            echo "<tr>";
                            echo "<td>{$res->date}</td>";
                            echo "<td class='text-paid'>" . number_format($res->amount, 2) . "</td>";
                            echo "</tr>";
                            $tot_amt += $res->amount;
                        }
                        echo "<tr>";
                        echo "<td>Total SR Loan</td>";
                        echo "<td>" . number_format($tot_amt, 2) . "</td>";
                        echo "</tr>";
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<br /><br />

    <!-- ==================== BAG LOAN DETAILS ==================== -->
    <div class="card mb-4">
        <div class="card-header text-center" style="text-align:center !important;">
            <i class="bi bi-journal-text"></i> Bag Loan Payment Details
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" width="100%">
                    <thead>
                        <tr>
                            <th>Loan Date</th>
                            <th>Loan Amount (TK)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT l.date, l.amount 
                                FROM bag_loan l, journal j 
                                WHERE l.sr_loan_id=j.tr_no 
                                  AND j.tr_from='Bag Sales'
                                  AND l.booking_number='$booking_no'
                                  AND j.cr_amt>0 
                                GROUP BY l.sr_loan_id 
                                ORDER BY l.date ASC";
                        $q = mysql_query($sql);
                        $tot_bag_amt = 0;
                        while ($res = mysql_fetch_object($q)) {
                            echo "<tr>";
                            echo "<td>{$res->date}</td>";
                            echo "<td class='text-paid'>" . number_format($res->amount, 2) . "</td>";
                            echo "</tr>";
                            $tot_bag_amt += $res->amount;
                        }
                        echo "<tr>";
                        echo "<td>Total Bag Loan</td>";
                        echo "<td>" . number_format($tot_bag_amt, 2) . "</td>";
                        echo "</tr>";
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<br /><br />
    <!-- ==================== PAYMENT DETAILS ==================== -->
    <div class="card mb-4">
        <div class="card-header text-center" style="text-align:center !important;">
            <i class="bi bi-credit-card"></i> Received Details
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" width="100%">
                    <thead>
                        <tr>
                            <th>Paid Date</th>
                            <th>Paid Amount (TK)</th>
                           
                            <th>Paid Interest (TK)</th>
							 <th>Total Days</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $dealer_code = find_a_field('sale_do_details', 'dealer_code', 'booking_no="' . $booking_no . '"');
                        $acc_ledger = find_a_field('dealer_info', 'account_code', 'dealer_code="' . $dealer_code . '"');

                        $sql = "SELECT c.chalan_date, j.cr_amt, total_interest ,c.loan_days
                                FROM sale_do_chalan c, journal j 
                                WHERE c.chalan_no=j.tr_no 
                                  AND j.tr_from='Sales' 
                                  AND c.booking_no='$booking_no'
                                  AND j.ledger_id='$acc_ledger'
                                  AND j.cr_amt>0 
                                GROUP BY j.tr_no 
                                ORDER BY c.chalan_date ASC";
                        $q = mysql_query($sql);
                        $tot_paid_amt = 0;
                        $tot_paid_interest = 0;
                        while ($res = mysql_fetch_object($q)) {
                            echo "<tr>";
                            echo "<td>{$res->chalan_date}</td>";
                            echo "<td class='text-paid'>" . number_format($res->cr_amt, 2) . "</td>";
                            echo "<td class='text-interest'>" . number_format($res->total_interest, 2) . "</td>";
							 echo "<td class='text-days'>" . number_format($res->loan_days, 0) . "</td>";
							 
                            echo "</tr>";
                            $tot_paid_amt += $res->cr_amt;
                            $tot_paid_interest += $res->total_interest;
                        }
                        //echo "<tr>";
//                        echo "<td>Total Payment</td>";
//                        echo "<td>" . number_format($tot_paid_amt, 2) . "</td>";
//                        echo "<td>" . number_format($tot_paid_interest, 2) . "</td>";
//                        echo "</tr>";
                       
						
						
						
						$sql = "SELECT c.recdate, j.cr_amt, c.interest_amt,c.total_days 
                                FROM sr_loan_return c, journal j 
                                WHERE c.sr_loan_id=j.tr_no 
                                  AND j.tr_from='SR Loan Return' 
                                  AND c.booking_number='$booking_no'
                                  AND j.ledger_id='$acc_ledger'
                                  AND j.cr_amt>0  and c.chalan_no is null
                                GROUP BY j.tr_no 
                                ORDER BY c.recdate ASC";
                        $q = mysql_query($sql);
                        //$tot_paid_amt = 0;
//                        $tot_paid_interest = 0;
                        while ($res = mysql_fetch_object($q)) {
                            echo "<tr>";
                            echo "<td>{$res->recdate}</td>";
                            echo "<td class='text-paid'>" . number_format($res->cr_amt, 2) . "</td>";
                            echo "<td class='text-interest'>" . number_format($res->interest_amt, 2) . "</td>";
							echo "<td class='text-days'>{$res->total_days}</td>";
                            echo "</tr>";
                            $tot_paid_amt2 += $res->cr_amt;
                            $tot_paid_interest2 += $res->interest_amt;
                        }
                        echo "<tr>";
                        echo "<td>Total Payment</td>";
                        echo "<td>" . number_format($tot_paid_amt+$tot_paid_amt2, 2) . "</td>";
                        echo "<td>" . number_format($tot_paid_interest+$tot_paid_interest2, 2) . "</td>";
						echo "<td></td>";
                        echo "</tr>";
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<br /><br />

<div class="card mb-4">
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" width="100%">
                    <thead>
						<tr>
                            <th colspan="4">Loan Details</th>
                            
                        </tr>
						
                        <tr>
                            <th></th>
                            <th>Payment Loan </th>
                           
                            <th>Received Loan</th>
							 <th>Due Loan</th>
                        </tr>
                    </thead>
                    <tbody>
					<tr>
                       <td>SR Loan</td>
					   <td><?=$payment=find_a_field('sr_loan l, journal j','sum(l.amount)','l.sr_loan_id=j.tr_no 
                                  AND j.tr_from="SR Loan"
                                  AND l.booking_number="'.$booking_no.'"
                                  AND j.dr_amt>0');
					    ?></td>
					   <td>
					   <? 
					   $dealer_code = find_a_field('sale_do_details', 'dealer_code', 'booking_no="' . $booking_no . '"');
                        $acc_ledger = find_a_field('dealer_info', 'account_code', 'dealer_code="' . $dealer_code . '"');
					   
					   $return= find_a_field('sr_loan_return c, journal j ','sum(c.total_paid)','c.sr_loan_id=j.tr_no 
                                  AND j.tr_from="SR Loan Return" 
                                  AND c.booking_number="'.$booking_no.'"
                                  AND j.ledger_id="'.$acc_ledger.'"
                                  AND j.cr_amt>0  and c.chalan_no is null
                                 ');
								
								
								$sales=find_a_field('sale_do_chalan c, journal j ','sum(c.sr_loan)','c.chalan_no=j.tr_no 
                                 AND j.tr_from="Sales"
                                AND c.booking_no="'.$booking_no.'"
                                AND j.ledger_id="'.$acc_ledger.'"
                               
                              ');
							   
							echo $rec=$return+$sales;
								
								
								
					    ?>
						
						
					   </td>
					   <td><?=$due=$payment-$rec?></td>
					 </tr>
					 <tr>
                       <td>Bag Loan</td>
					   <td><?=$bag_payment=find_a_field('bag_loan l','sum(l.amount)',' 
                                    l.booking_number="'.$booking_no.'" ');
								  
								  
					    ?> </td>
					   <td>
					   <? 
					   $dealer_code = find_a_field('sale_do_details', 'dealer_code', 'booking_no="' . $booking_no . '"');
                        $acc_ledger = find_a_field('dealer_info', 'account_code', 'dealer_code="' . $dealer_code . '"');
					   
					 
								
								
								$bagsales=find_a_field('sale_do_chalan c, journal j ','sum(c.bag_loan)','c.chalan_no=j.tr_no 
                                 AND j.tr_from="Sales"
                                AND c.booking_no="'.$booking_no.'"
                                AND j.ledger_id="'.$acc_ledger.'"
                               AND j.cr_amt>0 
                              ');
							   
							  echo $rec2=$bagsales;
								
								
								
					    ?>
					   </td>
					   <td><?=$due2=$bag_payment-$rec2?></td>
					 </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


