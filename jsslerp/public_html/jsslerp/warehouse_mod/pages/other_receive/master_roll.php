<?php
session_start();
require_once "../../../assets/support/inc.all.php";

$or_no = $_REQUEST['v_no'];
$booking_number = $_POST['booking_number'];

$barcode_content = $or_no;
$barcodeText = $barcode_content;
$barcodeType = 'code128';
$barcodeDisplay = 'horizontal';
$barcodeSize = 40;
$printText = '';

$group = find_all_field('user_group', '', 'id="' . $_SESSION['user']['group'] . '"');
$datas = find_all_field('warehouse_other_receive', '', 'or_no=' . $or_no);

$sql1 = "SELECT b.* FROM warehouse_other_receive b WHERE b.or_no = '$or_no'";
$data1 = mysql_query($sql1);

if (!$data1) {
    die("Error: " . mysql_error());
}

$pi = 0;
$total = 0;
while ($info = mysql_fetch_object($data1)) { 
    $farmer_name = $info->farmer_name;
    $farmer_village = $info->farmer_village;
    $bag_mark = $info->bag_mark;
}

$sql1 = "SELECT b.* FROM warehouse_other_receive_detail b WHERE b.or_no = '$or_no'";
$data1 = mysql_query($sql1);

if (!$data1) {
    die("Error: " . mysql_error());
}

$pi = 0;
$total = 0;
while ($info = mysql_fetch_object($data1)) { 
    $pi++;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>.: Other Receive Report :.</title>
<link href="../css/invoice.css" type="text/css" rel="stylesheet" />
<?php include("../../../assets/css/theme_responsib_new_table_report.php"); ?>
<script type="text/javascript">
    function hide() {
        document.getElementById("pr").style.display = "none";
    }
    </script>
<style type="text/css">
    .style1 {
        font-weight: bold
    }
    </style>
</head>
<body style="font-family:Tahoma, Geneva, sans-serif">

<? if ($_POST['booking_number'] != '') { ?>
<table width="800" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><div class="header">
        <table class="table1">
          <tr>
            <td class="logo"><img src="../../../logo/1.png" class="logo-img" /> </td>
            <td style="text-align:center"><h4 id="company_name">যমুনা সীডস্ স্টোরেজ (প্রাঃ) লিঃ </h4>
              <h5>কালুপাড়া, পবা, রাজশাহী</h5>
              <h5>বুকিং এর ধরণঃ
                <?=find_a_field('paid_booking', 'booking_type', 'booking_number_eng="' . $booking_number . '"');?>
              </h5></td>
            <td style="border: 1px solid black;"><h6>বীজ ঋণঃ </h6>
              <h6>বস্তা ঋণঃ</h6>
              <h6>চাষী ঋণঃ</h6>
              <h6>এস আর ঋণঃ
                <?=find_a_field('loan_assign','round(sum(amount_in))','booking_no="'.$_POST['booking_number'] .'"');?>
              </h6>
              <h6>বিবিধ ঋণঃ</h6>
              <h6>মোটঃ
                <?=find_a_field('loan_assign','round(sum(amount_in))','booking_no="'.$_POST['booking_number'] .'"');?>
              </h6></td>
          </tr>
        </table>
      </div></td>
  </tr>
  <tr>
    <td><hr />
    </td>
  </tr>
  <tr>
    <td><div class="header">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><table width="60%" border="0" align="center" cellpadding="5" cellspacing="0">
                            <tr>
                              <td bgcolor="#666666" style="text-align:center; color:#FFF; font-size:18px; font-weight:bold;"><?=$datas->receive_type;?>
                                এজেন্ট বা পার্টির ঋণের মার্স্টাররোল ফরম-২০২৪ </td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3" style="font-size:13px">
                      <tr>
                        <td width="40%" align="right" valign="middle">বুকিং নাম্বারঃ</td>
                        <td><table width="100%" border="1" cellspacing="0" cellpadding="3">
                            <tr>
                              <td><?=find_a_field('warehouse_other_receive', 'booking_number', 'booking_number="' . $booking_number . '"');?></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td width="40%" align="right" valign="middle">জনাব/বেগমঃ</td>
                        <td><table width="100%" border="1" cellspacing="0" cellpadding="3">
                            <tr>
                              <td><?=find_a_field('warehouse_other_receive', 'agent_name', 'booking_number="' . $booking_number . '"');?></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td align="right" valign="top">গ্রামঃ</td>
                        <td><table width="100%" border="1" cellspacing="0" cellpadding="3">
                            <tr>
                              <td><?=find_a_field('warehouse_other_receive', 'village', 'booking_number="' . $booking_number . '"');?></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td align="right" valign="middle">আলু গ্রহণের পরিমাণঃ</td>
                        <td><table width="100%" border="1" cellspacing="0" cellpadding="3">
                            <tr>
                              <td><?=find_a_field('warehouse_other_receive', 'sum(qty)', 'booking_number="' . $booking_number . '"');?></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                  <td width="30%" valign="top"></td>
                </tr>
              </table></td>
          </tr>
        </table>
      </div></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td><div id="pr">
        <div align="left">
          <input name="button" type="button" onclick="hide();window.print();" value="Print" />
        </div>
      </div>
	  <style>
	  .tabledesign {
		width: 100%;
		border-collapse: collapse;
	}
	
	.tabledesign thead {
		position: sticky;
		top: 0;
		z-index: 10;
	}
	

	  </style>
      <table width="100%"  border="1" bordercolor="#000000" cellspacing="0" cellpadding="5">
	  <thead>
        <tr>
          <th align="center" bgcolor="#CCCCCC"><strong>ক্র.নং.</strong></th>
          <th align="center" bgcolor="#CCCCCC" ><strong>নাম </strong></th>
          <th align="center" bgcolor="#CCCCCC"><div align="center"><strong>গ্রাম</strong></div></th>
          <th align="center" bgcolor="#CCCCCC"><strong>তারিখ</strong></th>
          <th align="center" bgcolor="#CCCCCC"><strong>এস।আর </strong></th>
          <th align="center" bgcolor="#CCCCCC"><strong>সংখ্যা</strong></th>
          <th align="center" bgcolor="#CCCCCC"><strong>ভাড়া </strong></th>
          <th align="center" bgcolor="#CCCCCC"><strong>লেবার চার্জ</strong></th>
          <th align="center" bgcolor="#CCCCCC"><strong>বীজ ঋণ</strong></th>
          <th align="center" bgcolor="#CCCCCC"><strong>বস্তা ঋণ</strong></th>
          <th align="center" bgcolor="#CCCCCC"><strong>চাষী ঋণ</strong></th>
          <th align="center" bgcolor="#CCCCCC"><strong>এস আর ঋণ</strong></th>
          <th align="center" bgcolor="#CCCCCC"><strong>বিবিধ ঋণ</strong></th>
          <th align="center" bgcolor="#CCCCCC"><strong>মোট</strong></th>
          <th align="center" bgcolor="#CCCCCC"><strong> AVG</strong></th>
          <th align="center" bgcolor="#CCCCCC"><strong>মন্তব্য</strong></th>
        </tr>
		</thead>
		<tbody>
        <?php
$type=find_a_field('paid_booking', 'booking_type', 'booking_number_eng="' . $booking_number . '"');
if ($_POST['booking_number'] != '') {
    $con .= ' and a.booking_number="' . $_POST['booking_number'] . '"';
	 if($_POST['sr_number']!='')
	     $con .=' and a.bag_mark="'.$_POST['sr_number'].'"';
}

$sql = 'SELECT a.*, sum(amount) as Total
        FROM warehouse_other_receive a, warehouse_other_receive_detail b
        WHERE a.or_no = b.or_no AND  a.booking_number="' . $_POST['booking_number'] . '"
        ' . $con . '
        GROUP BY a.or_no';

$query = mysql_query($sql);
if (!$query) {
    die("Error: " . mysql_error());
}
$sl = 0;
while ($data = mysql_fetch_object($query)) { 
    $sl++;
?>
        <tr>
          <td align="center" valign="top"><?=$sl;?></td>
          <td align="left" width="20%" valign="top" style="white-space: nowrap; "><?=$data->farmer_name?></td>
          <td align="left" valign="top"><?=$data->farmer_village?></td>
          <td align="left" valign="top" style="white-space: nowrap; "><?=$data->or_date?></td>
          <td align="left" valign="top"><?=$data->bag_mark?></td>
          <td align="left" valign="top"><? echo $qty=$data->qty?></td>
          <td align="left" valign="top"><?  if($type=="Paid Booking"){ echo "";} else{ $rate=find_a_field('paid_booking', 'booking_rate', 'booking_number_eng="' . $booking_number . '"'); 
					$ratetot=$rate* $data->qty; echo $ratetot;}?></td>
          <td align="right" valign="top"><?php $lchar = $data->labour_charge * $data->qty; echo $lchar; ?></td>
          <td align="left" valign="top">&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          <td align="left" valign="top">&nbsp;</td>
          <td align="left" valign="top"><?php  if($type=="Paid Booking"){ echo "";} else{
    $tot = find_a_field('loan_assign', 'amount_in', 'bag_mark="' . $data->bag_mark . '"');
    $total += $tot; 
    echo $tot;}; 
    ?></td>
          <td align="center" valign="top">&nbsp;</td>
          <td align="right" valign="top"><?  $all=$tot+$lchar+$ratetot; echo $all; $totall+=$all?></td>
          <td align="center" valign="top"><?= number_format($tot / $qty, 4) ?>
          </td>
          <td align="left" valign="top">&nbsp;</td>
        </tr>
        <?php

    }
?>
        <tr>
          <td colspan="13" align="right" valign="top"><strong>Total Amount: </strong></td>
          <td colspan="1" align="right" valign="top"><span class="style1">
            <?=number_format($totall, 4)?>
            </span></td>
        </tr>
		</tbody>
      </table></td>
  </tr>
  <tr>
    <td align="center"><table width="90%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" style="font-size:12px"><em><strong>পক্ষেঃ-যমুনা সীডস্ স্টোরেজ (প্রাঃ) লিঃ-১ </strong></em></td>
        </tr>
      </table>
      <div class="footer1"></div></td>
  </tr>
</table>
<?php 
} 
else
{
?>
<table width="800" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><div class="header">
        <table class="table1">
          <tr>
            <td class="logo"><img src="../../../logo/1.png" class="logo-img" /> </td>
            <td style="text-align:center"><h4 id="company_name">যমুনা সীডস্ স্টোরেজ (প্রাঃ) লিঃ </h4>
              <h5>কালুপাড়া, পবা, রাজশাহী</h5>
              <h5>বুকিং এর ধরণঃ
                <?=$_POST['booking_type'];?>
              </h5></td>
            <!--<td style="border: 1px solid black;"><h6>বীজ ঋণঃ </h6>
              <h6>বস্তা ঋণঃ</h6>
              <h6>চাষী ঋণঃ</h6>
              <h6>এস আর ঋণঃ
                <?=find_a_field('loan_assign','round(sum(amount_in))','booking_no="'.$_POST['booking_number'] .'"');?>
              </h6>
              <h6>বিবিধ ঋণঃ</h6>
              <h6>মোটঃ
                <?=find_a_field('loan_assign','round(sum(amount_in))','booking_no="'.$_POST['booking_number'] .'"');?>
              </h6></td>-->
          </tr>
        </table>
      </div></td>
  </tr>
  <tr>
    <td><hr />
    </td>
  </tr>
  <tr>
    <td><div class="header">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><table width="60%" border="0" align="center" cellpadding="5" cellspacing="0">
                            <tr>
                              <td bgcolor="#666666" style="text-align:center; color:#FFF; font-size:18px; font-weight:bold;"><?=$_POST['booking_type'];?>
                                এজেন্ট বা পার্টির ঋণের মার্স্টাররোল রিপোর্ট</td>
                            </tr>
							<tr>
                              <td bgcolor="#666666" style="text-align:center; color:#FFF; font-size:11px; font-weight:bold;">তারিখ: <?=$_POST['f_date'] ;?> হতে <?=$_POST['t_date'] ;?>
                               </td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td><!--<table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3" style="font-size:13px">
                      <tr>
                        <td width="40%" align="right" valign="middle">বুকিং নাম্বারঃ</td>
                        <td><table width="100%" border="1" cellspacing="0" cellpadding="3">
                            <tr>
                              <td><?=find_a_field('warehouse_other_receive', 'booking_number', 'booking_number="' . $booking_number . '"');?></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td width="40%" align="right" valign="middle">জনাব/বেগমঃ</td>
                        <td><table width="100%" border="1" cellspacing="0" cellpadding="3">
                            <tr>
                              <td><?=find_a_field('warehouse_other_receive', 'agent_name', 'booking_number="' . $booking_number . '"');?></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td align="right" valign="top">গ্রামঃ</td>
                        <td><table width="100%" border="1" cellspacing="0" cellpadding="3">
                            <tr>
                              <td><?=find_a_field('warehouse_other_receive', 'village', 'booking_number="' . $booking_number . '"');?></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td align="right" valign="middle">আলু গ্রহণের পরিমাণঃ</td>
                        <td><table width="100%" border="1" cellspacing="0" cellpadding="3">
                            <tr>
                              <td><?=find_a_field('warehouse_other_receive', 'sum(qty)', 'booking_number="' . $booking_number . '"');?></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                  <td width="30%" valign="top"></td>
                </tr>
              </table>--></td>
          </tr>
        </table>
      </div></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td><div id="pr">
        <div align="left">
          <input name="button" type="button" onclick="hide();window.print();" value="Print" />
        </div>
      </div>
	  <style>
	  .tabledesign {
		width: 100%;
		border-collapse: collapse;
	}
	
	.tabledesign thead {
		position: sticky;
		top: 0;
		z-index: 10;
	}
	

	  </style>
      <table width="100%"  border="1" bordercolor="#000000" cellspacing="0" cellpadding="5">
	  <thead>
        <tr>
          <th align="center" bgcolor="#CCCCCC"><strong>ক্র.নং.</strong></th>
          <th align="center" bgcolor="#CCCCCC" ><strong>নাম </strong></th>
          <th align="center" bgcolor="#CCCCCC"><div align="center"><strong>গ্রাম</strong></div></th>
          <th align="center" bgcolor="#CCCCCC"><strong>তারিখ</strong></th>
          <th align="center" bgcolor="#CCCCCC"><strong>এস।আর </strong></th>
          <th align="center" bgcolor="#CCCCCC"><strong>সংখ্যা</strong></th>
          <th align="center" bgcolor="#CCCCCC"><strong>ভাড়া </strong></th>
          <th align="center" bgcolor="#CCCCCC"><strong>লেবার চার্জ</strong></th>
          <th align="center" bgcolor="#CCCCCC"><strong>বীজ ঋণ</strong></th>
          <th align="center" bgcolor="#CCCCCC"><strong>বস্তা ঋণ</strong></th>
          <th align="center" bgcolor="#CCCCCC"><strong>চাষী ঋণ</strong></th>
          <th align="center" bgcolor="#CCCCCC"><strong>এস আর ঋণ</strong></th>
          <th align="center" bgcolor="#CCCCCC"><strong>বিবিধ ঋণ</strong></th>
          <th align="center" bgcolor="#CCCCCC"><strong>মোট</strong></th>
          <th align="center" bgcolor="#CCCCCC"><strong> AVG</strong></th>
          <th align="center" bgcolor="#CCCCCC"><strong>মন্তব্য</strong></th>
        </tr>
		</thead>
		<tbody>
        <?php
//$type=find_a_field('paid_booking', 'booking_type', 'booking_number_eng="' . $booking_number . '"');
//if ($_POST['booking_number'] != '') {
//    $con .= ' and a.booking_number="' . $_POST['booking_number'] . '"';
//	 if($_POST['sr_number']!='')
//	     $con .=' and a.bag_mark="'.$_POST['sr_number'].'"';
//}


	 if($_POST['booking_type']!='')
	{
	     $con =' and p.booking_type="'.$_POST['booking_type'].'"';
}

 $sql = 'SELECT a.*, sum(amount) as Total,p.booking_type
        FROM warehouse_other_receive a, warehouse_other_receive_detail b,paid_booking p
        WHERE p.booking_number_eng= a.booking_number and a.or_no = b.or_no and a.or_date between "'.$_POST['f_date'].'" and "'.$_POST['t_date'].'"
        ' . $con . '
        GROUP BY a.or_no';

$query = mysql_query($sql);
if (!$query) {
    die("Error: " . mysql_error());
}
$sl = 0;
while ($data = mysql_fetch_object($query)) { 
    $sl++;
?>
        <tr>
          <td align="center" valign="top"><?=$sl;?></td>
          <td align="left" width="20%" valign="top" style="white-space: nowrap; "><?=$data->farmer_name?></td>
          <td align="left" valign="top"><?=$data->farmer_village?></td>
          <td align="left" valign="top" style="white-space: nowrap; "><?=$data->or_date?></td>
          <td align="left" valign="top"><?=$data->bag_mark?></td>
          <td align="left" valign="top"><? echo $qty=$data->qty?></td>
          <td align="left" valign="top"><?  if($type=="Paid Booking"){ echo "";} else{ $rate=find_a_field('paid_booking', 'booking_rate', 'booking_number_eng="' . $booking_number . '"'); 
					$ratetot=$rate* $data->qty; echo $ratetot;}?></td>
          <td align="right" valign="top"><?php $lchar = $data->labour_charge * $data->qty; echo $lchar; ?></td>
          <td align="left" valign="top">&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          <td align="left" valign="top">&nbsp;</td>
          <td align="left" valign="top"><?php  if($type=="Paid Booking"){ echo "";} else{
    $tot = find_a_field('loan_assign', 'amount_in', 'bag_mark="' . $data->bag_mark . '"');
    $total += $tot; 
    echo $tot;}; 
    ?></td>
          <td align="center" valign="top">&nbsp;</td>
          <td align="right" valign="top"><?  $all=$tot+$lchar+$ratetot; echo $all; $totall+=$all?></td>
          <td align="center" valign="top"><?= number_format($tot / $qty, 4) ?>
          </td>
          <td align="left" valign="top">&nbsp;</td>
        </tr>
        <?php

    }
?>
        <tr>
          <td colspan="13" align="right" valign="top"><strong>Total Amount: </strong></td>
          <td colspan="1" align="right" valign="top"><span class="style1">
            <?=number_format($totall, 4)?>
            </span></td>
        </tr>
		</tbody>
      </table></td>
  </tr>
  <tr>
    <td align="center"><table width="90%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" style="font-size:12px"><em><strong>পক্ষেঃ-যমুনা সীডস্ স্টোরেজ (প্রাঃ) লিঃ-১ </strong></em></td>
        </tr>
      </table>
      <div class="footer1"></div></td>
  </tr>
</table>
<? } ?>
</body>
</html>
