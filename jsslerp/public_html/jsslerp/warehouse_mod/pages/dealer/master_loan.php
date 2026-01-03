<?php
session_start();
//====================== EOF ===================
//var_dump($_SESSION);
//require "../../support/inc.all.php";
require_once "../../../assets/support/inc.all.php";

$or_no 		= $_REQUEST['v_no'];

?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.: Other Receive Report :.</title>
<link href="../css/invoice.css" type="text/css" rel="stylesheet" />
<?php include("../../../assets/css/theme_responsib_new_table_report.php");?>
<script type="text/javascript">
    function hide() {
        document.getElementById("pr").style.display = "none";
    }
    </script>
<style type="text/css">
    <!--
    .style1 {
        font-weight: bold
    }
    -->
    </style>
</head>
<body style="font-family:Tahoma, Geneva, sans-serif">
<table width="800" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><div class="header">
        <table class="table1">
          <tr>
            <td class="logo"><img src="../../../logo/1.png" class="logo-img" /> </td>
            <td style="text-align:center"><h4 id="company_name">যমুনা সীডস্ স্টোরেজ (প্রাঃ) লিঃ </h4>
              <h5>কালুপাড়া, পবা, রাজশাহী</h5>
              <?php /*?>                                <h5>বুকিং এর ধরণঃ</h5>
<?php */?>
          </tr>
        </table>
      </div></td>
  </tr>
  <tr>
    <td><hr />
    </td>
  </tr>
  <tr>
    <td><div id="pr">
        <div align="left">
          <input name="button" type="button" onclick="hide();window.print();" value="Print" />
        </div>
      </div>
      <table width="100%" class="tabledesign" border="1" bordercolor="#000000" cellspacing="0"
                    cellpadding="5">
        <tr>
          <td align="center" bgcolor="#CCCCCC"><strong>SL</strong></td>
          <td align="center" bgcolor="#CCCCCC"><strong>বুকিং নং.</strong></td>
          <td align="center" bgcolor="#CCCCCC"><strong>&#2468;&#2494;&#2480;&#2495;&#2454;</strong></td>
          <td align="center" bgcolor="#CCCCCC"><strong>নাম</strong></td>
          <td align="center" bgcolor="#CCCCCC"><strong>Bag Mark No</strong></td>
          <td align="center" bgcolor="#CCCCCC"><div align="center"><strong>গ্রাম</strong></div></td>
          <td align="center" bgcolor="#CCCCCC"><strong>খালি বস্তা </strong></td>
          <td align="center" bgcolor="#CCCCCC"><strong>বস্তার দাম</strong></td>
          <td align="center" bgcolor="#CCCCCC"><strong>বীজ বস্তা </strong></td>
          <td align="center" bgcolor="#CCCCCC"><strong>বীজের দাম</strong></td>
          <td align="center" bgcolor="#CCCCCC"><strong> চাষী ঋণ </strong> </strong></td>
          <td align="center" bgcolor="#CCCCCC"><strong> এস আর ঋণ </strong> </strong></td>
          <td align="center" bgcolor="#CCCCCC"><strong>Ex Interest</strong></td>
          <td align="center" bgcolor="#CCCCCC"><strong>সর্বমোট</strong></td>
          <td align="center" bgcolor="#CCCCCC"><strong> আলু </strong> </strong></td>
          <td align="center" bgcolor="#CCCCCC"><strong> গড় </strong> </strong></td>
        </tr>
        <?php
		
		$booking=explode("[",$_POST['booking_number']);
		
		if($booking[0]!='')
		{
			$booing_no=" and b.booking_number='".$booking[0]."'";
		
		}
		
////////////// warehouse other receive/////////////
$sql='select sum(qty) as tot_qty,booking_number,agent_name,village from warehouse_other_receive where 1 group by booking_number';
$query=mysql_query($sql);
while($row=mysql_fetch_object($query)){
	$get_tot_qty[$row->booking_number]=$row->tot_qty;
	$village_name[$row->booking_number]=$row->village;
	$agent_name_get[$row->booking_number]=$row->agent_name;
}

////////////// Loan Assign/////////////
// $sql2='select bag_loan as tot_bag_loan,booking_no,bag_mark from loan_assign where 1 ';
//$query2=mysql_query($sql2);
//while($row2=mysql_fetch_object($query2)){
//	$get_tot_bag_loan[$row2->booking_no]=$row2->tot_bag_loan;
//	
//}

////////////// Loan Assign/////////////
 $sql22='select sum(b.amount) as tot_amount,b.interest_amt,b.booking_number,b.date as loan_date from  sr_loan b where 1 '.$booing_no.' group by b.sr_loan_id ';
$query22=mysql_query($sql22);
while($row22=mysql_fetch_object($query22)){
	$get_tot_amt[$row22->booking_number]=$row22->tot_amount;
	$get_loan_date[$row22->booking_number]=$row22->loan_date;
	
}

$sql222='select sum(b.amount) as tot_amount,b.interest_amt,b.booking_number,b.date as loan_date from  sr_loan b where 1 '.$booing_no.' group by b.date,b.booking_number ';
$query222=mysql_query($sql222);
while($row222=mysql_fetch_object($query222)){
	$in_total[$row222->booking_number]=$row222->tot_amount;
	$get_loan_date[$row222->booking_number]=$row222->loan_date;
	
}



	   $td='select * from  loan_assign b where 1 and b.booking_no= "'.$booking[0].'" group by b.bag_mark';
$report = mysql_query($td);

$sl = 1; 
while ($data = mysql_fetch_object($report)) {
//$amt+=$data->amount;
$avg=($get_tot_amt[$data->booking_no]/$get_tot_qty[$data->booking_no]);

    ?>
        <tr>
          <td><?= $sl++; ?></td>
          <td><?=$data->booking_no;?> </td>
          <td><?=$get_loan_date[$data->booking_no];?></td>
          <td><?= $agent_name_get[$data->booking_no];?></td>
          <td><?=$data->bag_mark;?></td>
          <td><?=$village_name[$data->booking_no]?></td>
          <td></td>
          <td><?= $data->bag_loan; $t_bag_loan+=$data->bag_loan;?> </td>
          <td></td>
          <td></td>
          <td></td>
          <td><?=$get_tot_amt[$data->booking_no]; $tot_amt=$in_total[$data->booking_no];?></td>
          <td></td>
          <td><?=$get_tot_amt[$data->booking_no];   $t_amount=$in_total[$data->booking_no]; ?></td>
          <td><?php echo  $get_tot_qty[$data->booking_no];   $t_qty=$get_tot_qty[$data->booking_no];?></td>
          <td><?php echo number_format($avg,2); $tot_avg+=$avg;?></td>
        </tr>
        <?php } ?>
        <td colspan="6" align="center" valign="top"><div align="right"><strong>Total Amount: </strong></div></td>
		<td></td>
          <td align="right" valign="top"><span class="style1">
            <?=number_format($t_bag_loan,0)?>
            </span></td>
			<td></td>
			<td></td>
          <td align="right" valign="top"><span class="style1">
            
            </span></td>
			    <td align="right" valign="top"><span class="style1">
            <?=number_format($tot_amt,0)?>
            </span></td>
			<td></td>
          <td align="right" valign="top"><span class="style1">
            <?=number_format($t_amount,0)?>
            </span></td>
			<td align="right" valign="top"><span class="style1">
            <?=number_format($t_qty,0)?>
            </span></td>
			<td align="right" valign="top"><span class="style1">
            <?=number_format($tot_avg,2)?>
            </span></td>
      
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
        <?php /*?><tr>
                        <td colspan="2" align="center"><strong><br />
                            </strong>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td>
                                        <div align="center">গ্রহীতা/জমাদানকারীর স্বাক্ষর</div>
                                    </td>
                                    <td>
                                        <div align="center"> প্রস্তুতকারীর স্বাক্ষর</div>
                                    </td>
                                    <td>
                                        <div align="center">স্টোর অফিসার/সহঃ স্টোর অফিসার </div>
                                    </td>
                                    <td>
                                        <div align="center">ম্যানেজার</div>
                                    </td>

                                </tr>
                            </table>
                        </td>
                    </tr><?php */?>
        <tr>
          <td colspan="2" style="font-size:12px"><em> <strong>পক্ষেঃ-যমুনা সীডস্ স্টোরেজ (প্রাঃ) লিঃ-১ </strong></em></td>
        </tr>
        <!--<tr>-->
        <!--  <td colspan="3"><?php include("../../../assets/template/report_print_buttom_content.php");?></td>-->
        <!--</tr>-->
      </table>
      <div class="footer1"> </div></td>
  </tr>
</table>
</body>
</html>
