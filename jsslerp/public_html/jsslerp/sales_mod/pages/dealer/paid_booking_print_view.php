<?php

session_start();

ob_start();

require_once "../../../assets/template/layout.top.php";


// ::::: Edit This Section ::::: 

$title='Paid Booking Status';			// Page Name and Page Title

do_datatable('paid_booking');
$page="paid_booking.php";		// PHP File Name
$table='paid_booking';		// Database Table Name Mainly related to this page
$unique='booking_id';			// Primary Key of this Database table
$shown='name';	

$target_url = '../dealer/paid_booking_print_view.php';
			// For a New or Edit Data a must have data field

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

$proj_id			= $_SESSION['proj_id'];

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

		mysql_query($sql1);
		$type=1;
		$msg='Successfully Updated.';
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



function amountToBanglaWords($number)
{
    $bn = [
        0 => 'শূন্য', 1 => 'এক', 2 => 'দুই', 3 => 'তিন', 4 => 'চার', 5 => 'পাঁচ',
        6 => 'ছয়', 7 => 'সাত', 8 => 'আট', 9 => 'নয়', 10 => 'দশ',
        11 => 'এগারো', 12 => 'বারো', 13 => 'তেরো', 14 => 'চৌদ্দ', 15 => 'পনেরো',
        16 => 'ষোল', 17 => 'সতেরো', 18 => 'আঠারো', 19 => 'উনিশ', 20 => 'বিশ',
        21 => 'একুশ', 22 => 'বাইশ', 23 => 'তেইশ', 24 => 'চব্বিশ', 25 => 'পঁচিশ',
        26 => 'ছাব্বিশ', 27 => 'সাতাশ', 28 => 'আটাশ', 29 => 'ঊনত্রিশ',
        30 => 'ত্রিশ', 31 => 'একত্রিশ', 32 => 'বত্রিশ', 33 => 'তেত্রিশ',
        34 => 'চৌত্রিশ', 35 => 'পঁয়ত্রিশ', 36 => 'ছত্রিশ',
        37 => 'সাঁইত্রিশ', 38 => 'আটত্রিশ', 39 => 'ঊনচল্লিশ',
        40 => 'চল্লিশ', 41 => 'একচল্লিশ', 42 => 'বিয়াল্লিশ',
        43 => 'তেতাল্লিশ', 44 => 'চুয়াল্লিশ', 45 => 'পঁয়তাল্লিশ',
        46 => 'ছেচল্লিশ', 47 => 'সাতচল্লিশ', 48 => 'আটচল্লিশ',
        49 => 'ঊনপঞ্চাশ', 50 => 'পঞ্চাশ',
        60 => 'ষাট', 70 => 'সত্তর', 80 => 'আশি', 90 => 'নব্বই'
    ];

    $units = [
        10000000 => 'কোটি',
        100000 => 'লাখ',
        1000 => 'হাজার',
        100 => 'শত'
    ];

    $convert = function ($num) use (&$convert, $bn, $units) {
        if ($num == 0) return '';
        if ($num < 100) return $bn[$num];

        foreach ($units as $value => $name) {
            if ($num >= $value) {
                return trim(
                    $convert(intval($num / $value)) . ' ' .
                    $name . ' ' .
                    $convert($num % $value)
                );
            }
        }
    };

    return trim($convert((int)$number)) . ' টাকা মাত্র';
}
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>.: Purchase Order :.</title>
<link href="../../../assets/css/invoice.css" type="text/css" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Parisienne&family=Roboto:wght@300&display=swap" rel="stylesheet">
<script type="text/javascript">



function hide()



{



    document.getElementById("pr").style.display="none";



}



</script>
</head>
<body style="font-family: Poppins, Helvetica, sans-serif;">
<form action="" method="post">

	  <?php
				
				
				
				$data=find_all_field('paid_booking','*','booking_id='.$_GET['booking_id']);
						?>
  <table width="800" border="0" cellspacing="0" cellpadding="0" align="center" style="font-family:Arial; font-size:13px; line-height:20px;">
    
   <!-- HEADER -->
<tr>
    <td colspan="3" style="padding-bottom:10px;">
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr>

                <!-- Logo -->
                <td width="120" style="text-align:left;">
                    <img src="../../../logo/1.png" style="width:120px;">
                </td>

                <!-- Center Heading -->
                <td style="text-align:center; line-height:22px;">

                    <div style="font-size:15px;">বিসমিল্লাহির রহমানির রাহমানির রাহীম</div>

                    <div style="font-size:20px; font-weight:bold;">
                        যমুনা সীডস্ স্টোরেজ (প্রাঃ) লিঃ
                    </div>

                    <div style="font-size:15px;">কালুপাড়া, পবা, রাজশাহী</div>

                    <div style="margin-top:5px;">
                        <span style="font-size:17px; font-weight:bold; text-decoration:underline;">
                            বুকিং রশিদ
                        </span><br>
                        <span style="font-size:14px;">(হস্তান্তর নিষেধ)</span>
                    </div>

                </td>

                <!-- Right Side: Mobile Number + Office Copy -->
                <td width="160" style="text-align:right; vertical-align:top;">

                    <!-- Mobile Number -->
                    <div style="font-size:13px; line-height:18px; margin-bottom:10px;">
                        মোবাইল: 01713-109102 <br>
                        01733-301393
                    </div>

                    <!-- Office Copy Box -->
                    <div style="font-size:14px; font-weight:bold; border:1px solid #000; padding:3px 8px; display:inline-block;">
                       গ্রাহক কপি 
                    </div>

                </td>

            </tr>
        </table>
    </td>
</tr>

    <tr>
        <td>
            <div id="pr" style="padding:5px 0;">
                <input type="button" onClick="hide();window.print();" value="Print" 
                       style="padding:4px 10px; font-size:13px;">
            </div>
        </td>
    </tr>


    <!-- CUSTOMER INFO -->
    <tr>
        <td>
            <table width="100%" cellpadding="4" cellspacing="0" style="font-size:13px;">
                <tr>
                    <td width="120"><strong>বুকিং নং:</strong></td>
                    <td style="font-weight:bold; font-size:16px"><strong><?=$data->booking_number_eng?></strong></td>
					 <td><strong>বুকিং টাইপ:</strong></td>
                    <td><?=$data->booking_type?></td>
					<td><strong>বুকিং তারিখ:</strong></td>
                    <td><?=$data->booking_date?></td>
                </tr>

                <tr>
                    <td><strong>জনাব/বেগম:</strong></td>
                    <td><?=$data->name?></td>

                    <td><strong>পিতা/স্বামী:</strong></td>
                    <td><?=$data->father_name?></td>

                     <td><strong>মোবাইল নং: </strong></td>
                    <td><?=$data->mobile_no?></td>
                </tr>

                <tr>
                    
					<td><strong>গ্রামঃ</strong></td>
                    <td><?=$data->village?></td>
					
                    <td><strong>ডাকঃ</strong></td>
                    <td><?=$data->post?></td>

                    <td><strong>থানাঃ</strong></td>
                    <td><?=$data->thana?></td>
					
					
                </tr>
				<tr>
                    
					<td><strong>জেলাঃ </strong></td>
                    <td><?=$data->district?></td>
					
                    <td><strong></strong></td>
                    <td></td>

                    <td><strong></strong></td>
                    <td></td>
					
					
                </tr>
            </table>
        </td>
    </tr>
	</tr>
	<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	</tr>
	<tr>
                    <td colspan="3">
                        <p style="margin:0; font-size:14px; text-align:justify;">
                            বস্তার পরিমাণ :
                            <span style="
                                border:1px solid #000;
                                padding:2px 8px;
                                display:inline-block;
                                min-width:40px;
                                font-weight:bold;
                                text-align:center;
                            ">
                                <?= $data->bag_quantity ?>
                            </span>

                            বস্তা আলু কোল্ড ষ্টোরেজে সংরক্ষণের অগ্রিম ভাড়া হিসাবে

                            <span style="
                                border:1px solid #000;
                                padding:2px 8px;
                                display:inline-block;
                                min-width:70px;
                                font-weight:bold;
                                text-align:center;
                            ">
                                <?= number_format($data->total_amount, 0) ?>/- 
                            </span>

                            টাকা মাত্র ধন্যবাদ এর সহিত গৃহীত হইল।
                        </p>
                    </td>
                </tr>
				
    <!-- CONDITIONS + FOOTER -->
    <tr>
        <td style="padding-top:10px;">
            <table width="100%" border="0" cellpadding="5" style="font-size:13px;">

                <!-- Names row -->
                <tr>
                    <td align="center"><?= $emp->PBI_NAME; ?></td>
                    <td align="center"><?= find_a_field('hrm_user_access','user_name','emp_id='.$all->checked_by); ?></td>
                    <td>&nbsp;</td>
                </tr>
				
				<tr>
                    <td colspan="3">
                        <p style="margin:0; font-size:14px; text-align:center; font-weight:bold; text-decoration:underline;">
                           কেবলমাত্র <?=$data->booking_year?> সালের জন্য প্রযোজ্য।
                        </p>
                    </td>
                </tr>
				<tr>
				</tr>
                <!-- Conditions -->
                <tr>
                    <td colspan="3">
                        <table width="100%" style="border:1px solid #000; font-size:11px; padding:10px;">
                            <tr>
                                    
                                    <td colspan="2" style="text-align:center; font-weight:bold; text-decoration:underline">শর্তাবলী</td>
                                </tr>

                            <?php
                                $s = 1;
                                $sql = "SELECT * FROM booking_condition_setup 
                                        WHERE year='".$data->booking_year."' 
                                        AND status='Active'
                                        ORDER BY id ASC";

                                $q = mysql_query($sql);
                                while ($r = mysql_fetch_object($q)) {
                            ?>
                                <tr>
                                    <td width="30"><?=$s++?>.</td>
                                    <td><?=$r->booking_condition?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </td>
                </tr>
				
				<tr>
                    <td colspan="3"><strong>কথায়: <?php 
				
				echo amountToBanglaWords($data->total_amount);
				?></strong></td>
					
                </tr>

                <tr>
                    <td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
                </tr>
				
				
                <!-- Signatures -->
                <tr>
                    <td align="center" style="padding-top:25px;font-weight:bold;">জমাদানকারীর স্বাক্ষর</td>
					<td align="center" style="padding-top:25px; font-weight:bold;">
                        নিন্ম শর্তাবলী পড়িয়া শুনিয়া মানিয়া লইয়া স্বাক্ষর করিলাম
                    </td>
					 <td align="center" style="padding-top:25px; font-weight:bold;">
                        পক্ষে - যমুনা সীডস্ স্টোরেজ (প্রাঃ) লিঃ
                    </td>
                </tr>

                

            </table>
        </td>
    </tr>

</table>
<div style="page-break-after: always;"></div>

  <br />
  <br />
  <table width="800" border="0" cellspacing="0" cellpadding="0" align="center" style="font-family:Arial; font-size:13px; line-height:20px;">
    
   <!-- HEADER -->
<tr>
    <td colspan="3" style="padding-bottom:10px;">
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr>

                <!-- Logo -->
                <td width="120" style="text-align:left;">
                    <img src="../../../logo/1.png" style="width:120px;">
                </td>

                <!-- Center Heading -->
                <td style="text-align:center; line-height:22px;">

                    <div style="font-size:15px;">বিসমিল্লাহির রহমানির রাহমানির রাহীম</div>

                    <div style="font-size:20px; font-weight:bold;">
                        যমুনা সীডস্ স্টোরেজ (প্রাঃ) লিঃ
                    </div>

                    <div style="font-size:15px;">কালুপাড়া, পবা, রাজশাহী</div>

                    <div style="margin-top:5px;">
                        <span style="font-size:17px; font-weight:bold; text-decoration:underline;">
                            বুকিং রশিদ
                        </span><br>
                        <span style="font-size:14px;">(হস্তান্তর নিষেধ)</span>
                    </div>

                </td>

                <!-- Right Side: Mobile Number + Office Copy -->
                <td width="160" style="text-align:right; vertical-align:top;">

                    <!-- Mobile Number -->
                    <div style="font-size:13px; line-height:18px; margin-bottom:10px;">
                        মোবাইল: 01713-109102 <br>
                        01733-301393
                    </div>

                    <!-- Office Copy Box -->
                    <div style="font-size:14px; font-weight:bold; border:1px solid #000; padding:3px 8px; display:inline-block;">
                      অফিস কপি
                    </div>

                </td>

            </tr>
        </table>
    </td>
</tr>

    


    <!-- CUSTOMER INFO -->
    <tr>
        <td>
            <table width="100%" cellpadding="4" cellspacing="0" style="font-size:13px;">
                <tr>
                    <td width="120"><strong>বুকিং নং:</strong></td>
                    <td style="font-weight:bold; font-size:16px"><strong><?=$data->booking_number_eng?></strong></td>
					 <td><strong>বুকিং টাইপ:</strong></td>
                    <td><?=$data->booking_type?></td>
					<td><strong>বুকিং তারিখ:</strong></td>
                    <td><?=$data->booking_date?></td>
                </tr>

                <tr>
                    <td><strong>জনাব/বেগম:</strong></td>
                    <td><?=$data->name?></td>

                    <td><strong>পিতা/স্বামী:</strong></td>
                    <td><?=$data->father_name?></td>

                     <td><strong>মোবাইল নং: </strong></td>
                    <td><?=$data->mobile_no?></td>
                </tr>

                <tr>
                    
					<td><strong>গ্রামঃ</strong></td>
                    <td><?=$data->village?></td>
					
                    <td><strong>ডাকঃ</strong></td>
                    <td><?=$data->post?></td>

                    <td><strong>থানাঃ</strong></td>
                    <td><?=$data->thana?></td>
					
					
                </tr>
				<tr>
                    
					<td><strong>জেলাঃ </strong></td>
                    <td><?=$data->district?></td>
					
                    <td><strong></strong></td>
                    <td></td>

                    <td><strong></strong></td>
                    <td></td>
					
					
                </tr>
            </table>
        </td>
    </tr>
	<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	</tr>
	<tr>
                    <td colspan="3">
                        <p style="margin:0; font-size:14px; text-align:justify;">
                            বস্তার পরিমাণ :
                            <span style="
                                border:1px solid #000;
                                padding:2px 8px;
                                display:inline-block;
                                min-width:40px;
                                font-weight:bold;
                                text-align:center;
                            ">
                                <?= $data->bag_quantity ?>
                            </span>

                            বস্তা আলু কোল্ড ষ্টোরেজে সংরক্ষণের অগ্রিম ভাড়া হিসাবে

                            <span style="
                                border:1px solid #000;
                                padding:2px 8px;
                                display:inline-block;
                                min-width:70px;
                                font-weight:bold;
                                text-align:center;
                            ">
                                <?= number_format($data->total_amount, 0) ?>/-                            </span>

                            টাকা মাত্র ধন্যবাদ এর সহিত গৃহীত হইল।                        </p>
      </td>
    </tr>
    <!-- CONDITIONS + FOOTER -->
	
	
    <tr>
        <td style="padding-top:10px;">
            <table width="100%" border="0" cellpadding="5" style="font-size:13px;">

                <!-- Names row -->
                <tr>
                    <td align="center"><?= $emp->PBI_NAME; ?></td>
                    <td align="center"><?= find_a_field('hrm_user_access','user_name','emp_id='.$all->checked_by); ?></td>
                    <td>&nbsp;</td>
                </tr>
				
				
				<tr>
				<tr>
                    <td colspan="3">
                        <p style="margin:0; font-size:14px; text-align:center; font-weight:bold; text-decoration:underline;">
                           কেবলমাত্র <?=$data->booking_year?> সালের জন্য প্রযোজ্য।
                        </p>
                    </td>
                </tr>
				</tr>
                <!-- Conditions -->
                <tr>
                    <td colspan="3">
                        <table width="100%" style="border:1px solid #000; font-size:11px; padding:10px;">
                            
							<tr>
                                    
                                    <td colspan="2" style="text-align:center; font-weight:bold; text-decoration:underline">শর্তাবলী</td>
                                </tr>
                            <?php
                                $s = 1;
                                $sql = "SELECT * FROM booking_condition_setup 
                                        WHERE year='".$data->booking_year."' 
                                        AND status='Active'
                                        ORDER BY id ASC";

                                $q = mysql_query($sql);
                                while ($r = mysql_fetch_object($q)) {
                            ?>
                                <tr>
                                    <td width="30"><?=$s++?>.</td>
                                    <td><?=$r->booking_condition?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </td>
                </tr>
				
				<tr>
                    <td colspan="3"><strong>কথায়: <?php 
				
				echo amountToBanglaWords($data->total_amount);
				?></strong></td>
					
                </tr>

                <tr>
                    <td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
                </tr>
				
				
                <!-- Signatures -->
                <tr>
                    <td align="center" style="padding-top:25px;font-weight:bold;">জমাদানকারীর স্বাক্ষর</td>
					<td align="center" style="padding-top:25px; font-weight:bold;">
                        নিন্ম শর্তাবলী পড়িয়া শুনিয়া মানিয়া লইয়া স্বাক্ষর করিলাম
                    </td>
					 <td align="center" style="padding-top:25px; font-weight:bold;">
                        পক্ষে - যমুনা সীডস্ স্টোরেজ (প্রাঃ) লিঃ
                    </td>
                </tr>

                

            </table>
        </td>
    </tr>

</table>

 
</form>
</body>
</html>
