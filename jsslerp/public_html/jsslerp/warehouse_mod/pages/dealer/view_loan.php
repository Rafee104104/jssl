<?php
session_start();

// Force UTF-8 output
header("Content-Type: text/html; charset=UTF-8");

require_once "../../../assets/support/inc.all.php";
require_once ('../../../acc_mod/common/class.numbertoword.php');

$oi_no = $_REQUEST['id'];
$all_data = find_all_field('sr_loan_return', '*', 'sr_loan_id='.$oi_no);
$booking  = find_all_field('paid_booking', '*', 'booking_number_eng="'.$all_data->booking_number.'"');
$group    = find_all_field('user_group', '', 'id="'.$_SESSION['user']['group'].'"');

// ====================
// Fetch paid_booking data ONLY
// ====================
$pi = 0;
$tot_qty = 0;
$tot_amt = 0;

// Arrays to store row data
$order_no = [];
$item_id  = [];
$rate     = [];
$amount   = [];
$unit_qty = [];
$unit_name= [];
$receive_from = [];
$receive_no   = [];
$entry_by     = [];
$entry_at     = [];
$oi_date      = [];

// Fetch all rows from paid_booking
$sql1 = "SELECT * FROM paid_booking";
$data1 = mysql_query($sql1);

while($info = mysql_fetch_object($data1)) {
    $pi++;

    $order_no[]  = $info->booking_number;
    $item_id[]   = $info->booking_id; // using booking_id as code
    $rate[]      = $info->booking_rate;
    $amount[]    = $info->total_amount;
    $unit_qty[]  = $info->bag_quantity;
    $unit_name[] = 'Bag'; // default unit

    $receive_from[] = $info->name;
    $receive_no[]   = $info->booking_id;
    $entry_by[]     = $info->entry_by;
    $entry_at[]     = $info->entry_at;
    $oi_date[]      = $info->booking_date;
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Voucher</title>

<!-- Google Bengali Font -->
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali&display=swap" rel="stylesheet">

<style>
  body {
    font-family: "Noto Sans Bengali", Arial, sans-serif;
    margin: 20px;
    background: #f9f9f9;
  }
  .voucher {
    width: 800px;
    border: 2px solid #000;
    padding: 20px;
    background: #fff;
    margin: auto;
  }
  .header {
    text-align: center;
    font-size: 20px;
    font-weight: bold;
  }
  .sub-header {
    text-align: center;
    font-size: 16px;
    margin-bottom: 10px;
  }
  .title {
    text-align: center;
    font-size: 18px;
    font-weight: bold;
    margin: 10px 0;
  }
  .row {
    margin: 10px 0;
    font-size: 16px;
  }
  .row span {
    display: inline-block;
    min-width: 150px;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    margin: 15px 0;
  }
  table, th, td {
    border: 1px solid #000;
  }
  th, td {
    padding: 8px;
    text-align: center;
  }
  .footer {
    margin-top: 30px;
    font-size: 14px;
  }
  .footer div {
    display: inline-block;
    width: 32%;
    text-align: center;
  }
  
  .title {
  display: grid;
  grid-template-columns: 1fr auto;
  align-items: center;
  margin: 10px 0;
  font-weight: bold;
}
.title .main {
  text-align: center;
  font-size: 18px;
  
}
.title .copy {
  font-size: 14px;
}
}
</style>
</head>
<body>
<input id="printBtn" type="button" value="Print" onClick="hideAndPrint();" />

<script>
function hideAndPrint() {
    document.getElementById('printBtn').style.display = 'none'; // hide button
    window.print();
    document.getElementById('printBtn').style.display = 'block'; // show again after print
}
</script>


<style>
.voucher {
    width: 700px;
    margin: 20px auto;
    font-family: Arial, sans-serif;
    border: 1px solid #000;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    background: #fff;
}

.voucher .header {
    text-align: center;
    font-size: 22px;
    font-weight: bold;
    margin-bottom: 5px;
}

.voucher .sub-header {
    text-align: center;
    font-size: 14px;
    margin-bottom: 15px;
}

.voucher .title {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    font-size: 18px;
}

.voucher .title .main {
    font-weight: bold;
}

.voucher .title .copy {
    font-style: italic;
    color: #555;
}

.voucher .row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    font-size: 14px;
}

.voucher table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 15px;
}

.voucher table, .voucher th, .voucher td {
    border: 1px solid #000;
}

.voucher th, .voucher td {
    padding: 8px;
    text-align: left;
    vertical-align: top;
    font-size: 13px;
}

.voucher td.amount {
    text-align: right;
    font-weight: bold;
}

.voucher td p {
    margin: 0;
}

.voucher .in-word {
    margin-top: 10px;
    font-style: italic;
    font-size: 13px;
}

.voucher .footer {
    display: flex;
    justify-content: space-between;
    margin-top: 40px;
    font-size: 12px;
}

.voucher .footer .signature {
    width: 200px;
    text-align: center;
    border-bottom: 1px solid #000;
    height: 60px;
    line-height: 60px;
}

.voucher .footer-prepared {
    display: flex;
    justify-content: space-between;
    margin-top: 30px;
    font-size: 10px;
}

.voucher .footer-prepared div {
    width: 100px;
    text-align: center;
    border-top: 1px solid #000;
    padding: 2px 0;
}
<style>
.voucher {
    width: 800px;
    margin: 0 auto;
    font-family: Arial, sans-serif;
    border: 1px solid #000;
    padding: 15px;
}

.header {
    display: flex;
    align-items: center;
    justify-content: space-between; 
	padding-bottom: 10px;
    margin-bottom: 10px;
}

.header img {
    max-width: 150px;   
    height: auto;
}

.header .group-name {
    font-size: 20px;
    font-weight: bold;
    text-align: center;
    flex-grow: 1;
    
}

.sub-header {
    text-align: center;
    font-size: 14px;
    margin-bottom: 15px;
	
}

@media print {
    .voucher {
        page-break-inside: avoid;  /* don’t break inside a voucher */
        margin-bottom: 20px;
    }

    .voucher + .voucher {
        page-break-before: always; /* each new voucher starts on a new page */
    }
}



</style>

<div class="voucher">
    <div class="header">
        <div><img src="../../../logo/1.png" alt="Logo"></div>
        <div class="group-name"><?=$group->group_name?></div>
    </div>
    <div class="sub-header" style="line-height: 0px !important;"><?=$group->address?></div>
	<div class="sub-header" style="line-height: 0px !important;"><?=$group->factory_address?></div>

    <div class="title">
        <div class="main">Receipt Voucher</div>
        <div class="copy">Customer Copy</div>
    </div>

    <div class="row">
        <div>Name: <?=$booking->name?></div>
        <div>Date: <?=date("d M, Y", strtotime($all_data->recdate))?></div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <p>
					
					<?php
						$booking_number = $booking->booking_number_eng; 
						$loan_parts = explode('/', $booking_number);
						
						?>



                        Loan Type: SR Loan , S.R Loan/<?=$loan_parts[1]?><br>
                        Loan Return No: <?=$all_data->sr_loan_id?>, Booking No: <?=$booking->booking_number_eng?><br>
                        Total Days: <?=$all_data->total_days?>, Loan Paid: <?=$all_data->total_paid?><br>
                        Interest Paid: <?=$all_data->interest_amt?>
                    </p>
                </td>
                <td class="amount">
                    <?=$total_amt = $all_data->interest_amt + $all_data->total_paid;?>
                </td>
            </tr>
            <tr>
                <td class="amount">Total =</td>
                <td class="amount"><?=$total_amt;?></td>
            </tr>
        </tbody>
    </table>

    <div class="in-word">
        In Words: 
        <?php
        $scs = round($total_amt);
        $credit_amt = explode('.', $scs);
        if($credit_amt[0]>0){
            echo convertNumberToWordsForIndia($credit_amt[0]);
        }
        if($credit_amt[1]>0){
            if($credit_amt[1]<10) $credit_amt[1] = $credit_amt[1]*10;
            echo ' & '.convertNumberToWordsForIndia($credit_amt[1]).' paisa ';
        }
        echo 'Taka Only';
        ?>
    </div>

    <!-- Customer Signature Section -->
    <div class="footer">
        <div>Customer Signature</div>
        <div></div>
        <div></div>
    </div>

    <!-- Prepared By Section -->
    <div class="footer-prepared">
        <div>Prepared By</div>
        <div>Executive A/C</div>
        <div>Manager Admin</div>
        <div>Manager Operation</div>
        <div>Manager A/C</div>
        <div>General Manager</div>
    </div>
</div>


<br><br>

<div class="voucher">
    <div class="header">
        <div><img src="../../../logo/1.png" alt="Logo"></div>
        <div class="group-name"><?=$group->group_name?></div>
    </div>
      <div class="sub-header" style="line-height: 0px !important;"><?=$group->address?></div>
	<div class="sub-header" style="line-height: 0px !important;"><?=$group->factory_address?></div>

    <div class="title">
        <div class="main">Receipt Voucher</div>
        <div class="copy">Office Copy</div>
    </div>

    <div class="row">
        <div>Name: <?=$booking->name?></div>
        <div>Date: <?=date("d M, Y", strtotime($all_data->recdate))?></div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <p>
					
					<?php
						$booking_number = $booking->booking_number_eng; 
						$loan_parts = explode('/', $booking_number);
						
						?>



                        Loan Type: SR Loan , S.R Loan/<?=$loan_parts[1]?><br>
                        Loan Return No: <?=$all_data->sr_loan_id?>, Booking No: <?=$booking->booking_number_eng?><br>
                        Total Days: <?=$all_data->total_days?>, Loan Paid: <?=$all_data->total_paid?><br>
                        Interest Paid: <?=$all_data->interest_amt?>
                    </p>
                </td>
                <td class="amount">
                    <?=$total_amt = $all_data->interest_amt + $all_data->total_paid;?>
                </td>
            </tr>
            <tr>
                <td class="amount">Total =</td>
                <td class="amount"><?=$total_amt;?></td>
            </tr>
        </tbody>
    </table>

    <div class="in-word">
        In Words: 
        <?php
        $scs = round($total_amt);
        $credit_amt = explode('.', $scs);
        if($credit_amt[0]>0){
            echo convertNumberToWordsForIndia($credit_amt[0]);
        }
        if($credit_amt[1]>0){
            if($credit_amt[1]<10) $credit_amt[1] = $credit_amt[1]*10;
            echo ' & '.convertNumberToWordsForIndia($credit_amt[1]).' paisa ';
        }
        echo 'Taka Only';
        ?>
    </div>

    <!-- Customer Signature Section -->
    <div class="footer">
        <div>Customer Signature</div>
        <div></div>
        <div></div>
    </div>

    <!-- Prepared By Section -->
    <div class="footer-prepared">
        <div>Prepared By</div>
        <div>Executive A/C</div>
        <div>Manager Admin</div>
        <div>Manager Operation</div>
        <div>Manager A/C</div>
        <div>General Manager</div>
    </div>
</div>
</body>
</html>
