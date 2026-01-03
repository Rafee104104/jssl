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
      <? if($_REQUEST['report']==404) {?>
      <table width="100%" class="tabledesign" border="1" bordercolor="#000000" cellspacing="0" cellpadding="5">
        <tr>
          <td align="center" bgcolor="#CCCCCC"><strong>এস আর <strong> </td>
          <td align="center" bgcolor="#CCCCCC"><strong>বস্তা</strong></td>
          <td align="center" bgcolor="#CCCCCC"><strong> লোডিং পজিশন</strong> </strong></td>
          <td align="center" bgcolor="#CCCCCC"><strong> ১ম পালট </strong> </strong></td>
          <td align="center" bgcolor="#CCCCCC"><strong> ২য় পালট </strong> </strong></td>
          <td align="center" bgcolor="#CCCCCC"><strong> ৩য় পালট<strong> </strong></td>
          <td align="center" bgcolor="#CCCCCC"><strong> ৪র্থ পালট </strong> </strong></td>
          <td align="center" bgcolor="#CCCCCC"><strong>৫ম পালট </strong> </strong></td>
          <td align="center" bgcolor="#CCCCCC"><strong> আনলোড </strong> </strong></td>
          <td align="center" bgcolor="#CCCCCC"><strong> মন্তব্য <strong> </td>
        </tr>
        <?
      
/*if($_POST['f_date']!=''&&$_POST['t_date']!='')
$con .= ' and b.ji_date between "'.$_POST['f_date'].'" and "'.$_POST['t_date'].'"';
if($_POST['vendor_id']>0)
$con .= 'and a.vendor_id="'.$_POST['vendor_id'].'"';*/
if($_POST['bag_mark']>0)
$con.= 'and a.bag_mark="'.$_POST['bag_mark'].'"';

 $res = "SELECT a.bag_mark, a.or_no, a.qty, b.bag_size
        FROM warehouse_other_receive a, journal_item b  
        WHERE a.or_no = b.tr_no ".$con." AND  b.tr_from IN ('Other Receive', 'Olot Palot')
        GROUP BY a.bag_mark
        ORDER BY a.or_no ASC";


$query = mysql_query($res);
while($data=mysql_fetch_object($query))
{
'concat(item_name,"#>",item_description,"#>",item_id)'

 ?>
        <tr>
          <td align="right" valign="top"><?=$data->bag_mark?></td>
          <td align="right" valign="top"><?=$data->qty?></td>
          <td align="right" valign="top"><? $wr  = 'select concat(b.warehouse_id,"-",round(b.item_in)) data from journal_item b, warehouse_other_receive a where b.barcode="' . $data->bag_mark . '" AND b.bag_size=0 AND a.or_no = b.tr_no';
			$wr_query = mysql_query($wr);
			while($wr_result = mysql_fetch_object($wr_query)){
			  echo $wr_result->data.'<br>';
			}
		   //find_a_field('journal_item b, warehouse_other_receive a', 'concat(b.warehouse_id,"-",a.qty)', 'b.barcode="' . $data->bag_mark . '" AND b.bag_size=0 AND a.or_no = b.tr_no') ?></td>
          <td align="right" valign="top"><?= find_a_field('journal_item b', 'concat(b.warehouse_id,"-",round(sum(b.item_in-b.item_ex)))', 'b.barcode="' . $data->bag_mark . '" AND b.bag_size=1') ?></td>
         <td align="right" valign="top"><?= find_a_field('journal_item b', 'concat(b.warehouse_id,"-",round(sum(b.item_in-b.item_ex)))', 'b.barcode="' . $data->bag_mark . '" AND b.bag_size=2') ?></td>
          <td align="right" valign="top"><?= find_a_field('journal_item b', 'concat(b.warehouse_id,"-",round(sum(b.item_in-b.item_ex)))', 'b.barcode="' . $data->bag_mark . '" AND b.bag_size=3') ?></td>
       <td align="right" valign="top"><?= find_a_field('journal_item b', 'concat(b.warehouse_id,"-",round(sum(b.item_in-b.item_ex)))', 'b.barcode="' . $data->bag_mark . '" AND b.bag_size=4') ?></td>
       <td align="right" valign="top"><?= find_a_field('journal_item b', 'concat(b.warehouse_id,"-",round(sum(b.item_in-b.item_ex)))', 'b.barcode="' . $data->bag_mark . '" AND b.bag_size=5') ?></td>
          <td align="right" valign="top"><?= find_a_field('journal_item b, warehouse_other_receive a', 'concat(b.warehouse_id,"-",a.qty)', 'b.barcode="' . $data->bag_mark . '" AND b.bag_size=(SELECT MAX(bag_size) FROM journal_item WHERE barcode="' . $data->bag_mark . '") AND a.or_no = b.tr_no') ?>
          </td>
          <td align="right" valign="top"><?=$data->barcode?></td>
        </tr>
        <? }?>
        <td colspan="4" align="center" valign="top"><div align="right"><strong>Total Amount: </strong></div></td>
          <td align="right" valign="top"><span class="style1">
            <?=number_format($t_amount,4)?>
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
<? }?>
</body>
</html>
