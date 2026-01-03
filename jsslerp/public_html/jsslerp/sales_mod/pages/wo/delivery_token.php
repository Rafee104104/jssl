<?php
require_once "../../../assets/template/layout.top.php";
date_default_timezone_set('Asia/Dhaka');
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
<?
	require_once "../../../assets/support/inc.exporttable.php";
	?>
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
              <h5>আলু পজিশন রিপোর্ট</h5>
          </tr>
        </table>
      </div></td>
  </tr>
  <tr>
    <td><hr />
    </td>
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
      <? if($_REQUEST['report']==405) {?>
     
        <?
      
/*if($_POST['f_date']!=''&&$_POST['t_date']!='')
$con .= ' and b.ji_date between "'.$_POST['f_date'].'" and "'.$_POST['t_date'].'"';
if($_POST['vendor_id']>0)
$con .= 'and a.vendor_id="'.$_POST['vendor_id'].'"';*/
if($_POST['bag_mark']>0)
$con.= 'and a.bag_mark="'.$_POST['bag_mark'].'"';

$res = "SELECT a.bag_mark, a.or_no, a.qty, b.bag_size
        FROM warehouse_other_receive a, journal_item b  
        WHERE a.or_no = b.tr_no AND b.tr_from IN ('Other Receive', 'Olot Palot')
        GROUP BY a.bag_mark
        ORDER BY a.or_no ASC";


$query = mysql_query($res);
while($data=mysql_fetch_object($query))
{


 ?>
<div class="card-container row">
    <?php while($data = mysql_fetch_object($query)): ?>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><strong>এস আর </strong>: <?php echo $data->bag_mark; ?></h5>
                    <p class="card-text"><strong>বস্তা</strong>:<?php echo $data->qty; ?></p>
                    <p class="card-text"><strong> আনলোড </strong> : <?php echo find_a_field('journal_item b, warehouse_other_receive a', 'b.warehouse_id', 'b.barcode="' . $data->bag_mark . '" AND b.bag_size=(SELECT MAX(bag_size) FROM journal_item WHERE barcode="' . $data->bag_mark . '") AND a.or_no = b.tr_no'); ?></p>
                    <p class="card-text"><strong> মন্তব্য </strong>: <?php echo $data->barcode; ?></p>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>
        <? }?>
        <?php /*?><td colspan="4" align="center" valign="top"><div align="right"><strong>Total Amount: </strong></div></td>
          <td align="right" valign="top"><span class="style1">
            <?=number_format($t_amount,4)?>
            </span></td><?php */?>
     </td>
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
<? }?>
</body>
</html>
