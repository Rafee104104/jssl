<?php
session_start();
//====================== EOF ===================
//var_dump($_SESSION);
//require "../../support/inc.all.php";
require_once "../../../assets/support/inc.all.php";

$or_no 		= $_REQUEST['v_no'];


$barcode_content = $or_no;
		  $barcodeText = $barcode_content;
          $barcodeType='code128';
		  $barcodeDisplay='horizontal';
          $barcodeSize=40;
          $printText='';

$group = find_all_field('user_group','','id="'.$_SESSION['user']['group'].'"');
$datas=find_all_field('warehouse_other_receive','','or_no='.$or_no);

$sql1="select b.* from warehouse_other_receive b where b.or_no = '".$or_no."'";
$data1=mysql_query($sql1);

$pi=0;
$total=0;
while($info=mysql_fetch_object($data1)){ 
$rec_frm=$info->vendor_name;
$requisition_from=$info->requisition_from;
$or_subject=$info->or_subject;
$or_date=$info->or_date;
$booking_number=$info->booking_number;
$bag_mark=$info->bag_mark;
$name=$info->agent_name;
$village=$info->village;
$thana=$info->thana;
$district=$info->district;
$father_name=$info->father_name;
$district=$info->district;
$district=$info->district;
$posts=$info->post;
$receipt_number=$info->receipt_number;
$labour_charge=$info->labour_charge;
$qty=$info->qty;
$total_labo=$info->labour_charge*$info->qty;







}

$sql1="select b.* from warehouse_other_receive_detail b where b.or_no = '".$or_no."'";
$data1=mysql_query($sql1);

$pi=0;
$total=0;
while($info=mysql_fetch_object($data1)){ 
$pi++;

$order_no[]=$info->order_no;
$qc_by=$info->qc_by;

$item_id[] = $info->item_id;
$rate[] = $info->rate;
$amount[] = $info->amount;




$unit_qty[] = $info->qty;
$unit_name[] = $info->unit_name;
}

?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
            <td>

                <div class="header">
                    <table class="table1">
                        <tr>
                            <td class="logo">
                                <img src="../../../logo/1.png" class="logo-img" />
                            </td>

                            <td style="text-align:center">
                                <h4 id="company_name">যমুনা সীডস্ স্টোরেজ (প্রাঃ) লিঃ </h4>
                                <h5>কালুপাড়া, পবা, রাজশাহী</h5>
                                <h5>বুকিং এর ধরণঃ</h5>


                            <td style="border: 1px solid black;">
                                <h6>বীজ ঋণঃ</h6>
                                <h6>বস্তা ঋণঃ</h6>
                                <h6>চাষী ঋণঃ</h6>
                                <h6>এস আর ঋণঃ</h6>
                                <h6>বিবিধ ঋণঃ</h6>
                                <h6>মোটঃ</h6>
                            </td>

                        </tr>

                    </table>
                </div>


            </td>
        </tr>
        <tr>
            <td>
                <hr />
            </td>
        </tr>
        <tr>
            <td>
                <div class="header">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td>
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td>
                                                        <table width="60%" border="0" align="center" cellpadding="5"
                                                            cellspacing="0">
                                                            <tr>
                                                                <td bgcolor="#666666"
                                                                    style="text-align:center; color:#FFF; font-size:18px; font-weight:bold;">
                                                                    <?=$datas->receive_type;?> এজেন্ট বা পার্টির ঋণের
                                                                    মার্স্টাররোল ফরম-২০২৪ </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>

                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td valign="top">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="3"
                                                style="font-size:13px">
                                                <tr>
                                                    <td width="40%" align="right" valign="middle">বুকিং নাম্বারঃ</td>
                                                    <td>
                                                        <table width="100%" border="1" cellspacing="0" cellpadding="3">
                                                            <tr>
                                                                <td><?= $booking_number;?>&nbsp;</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                              
                                                <tr>
                                                <tr>
                                                    <td width="40%" align="right" valign="middle">জনাব/বেগমঃ</td>
                                                    <td>
                                                        <table width="100%" border="1" cellspacing="0" cellpadding="3">
                                                            <tr>
                                                                <td><?php echo $name;?>&nbsp;</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="right" valign="top">গ্রামঃ</td>
                                                    <td>
                                                        <table width="100%" border="1" cellspacing="0" cellpadding="3">
                                                            <tr>
                                                                <td><?php echo $village;?>&nbsp;</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td align="right" valign="middle">আলু গ্রহণের পরিমাণঃ</td>
                                                    <td>
                                                        <table width="100%" border="1" cellspacing="0" cellpadding="3">
                                                            <tr>
                                                                <td><?php echo $thana;?>&nbsp;</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td width="30%" valign="top">
                                            
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        <tr>

            <td> </td>
        </tr>

        <tr>
            <td>
                <div id="pr">
                    <div align="left">
                        <input name="button" type="button" onclick="hide();window.print();" value="Print" />
                    </div>
                </div>
                <table width="100%" class="tabledesign" border="1" bordercolor="#000000" cellspacing="0"
                    cellpadding="5">
                    <tr>
                        <td align="center" bgcolor="#CCCCCC"><strong>ক্র.নং.</strong></td>
                        <td align="center" bgcolor="#CCCCCC"><strong>নাম</strong></td>
                        <td align="center" bgcolor="#CCCCCC">
                            <div align="center"><strong>গ্রাম</strong></div>
                        </td>

                        <td align="center" bgcolor="#CCCCCC"><strong>এস।আর </strong></td>
                        <td align="center" bgcolor="#CCCCCC"><strong>সংখ্যা</strong></td>
                        <td align="center" bgcolor="#CCCCCC"><strong> বীজ ঋণ </strong> </strong></td>
                        <td align="center" bgcolor="#CCCCCC"><strong> বস্তা ঋণ </strong> </strong></td>
                        <td align="center" bgcolor="#CCCCCC"><strong> চাষী ঋণ </strong> </strong></td>
                        <td align="center" bgcolor="#CCCCCC"><strong> এস আর ঋণ </strong> </strong></td>
                        <td align="center" bgcolor="#CCCCCC"><strong> বিবিধ ঋণ </strong> </strong></td>
                        <td align="center" bgcolor="#CCCCCC"><strong> মোট </strong> </strong></td>

                        <td align="center" bgcolor="#CCCCCC"><strong>মন্তব্য <strong></td>

                    </tr>

<?php /*?>                    <? for($i=0;$i<$pi;$i++){?>
<?php */?>
                    <tr>
                        <td align="center" valign="top">1</td>
                        <td align="left" valign="top">2</td>
                        <td align="left" valign="top">3</td>
                        <td align="right" valign="top">4</td>
                        <td align="right" valign="top">5</td>
                        <td align="right" valign="top">6</td>
                        <td align="right" valign="top">7</td>
                        <td align="right" valign="top">8</td>
                        <td align="right" valign="top">9</td>
                        <td align="right" valign="top">1</td>
                        <td align="right" valign="top">2</td>
                        <td align="right" valign="top">3</td>
                    </tr>

<?php /*?>                 <? }?>
<?php */?>              
                    
                    <td colspan="4" align="center" valign="top">
                        <div align="right"><strong>Total Amount: </strong></div>
                    </td>
                    <td align="right" valign="top"><span class="style1">
                            <?=number_format($t_amount,4)?>
                        </span></td>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center">
                <table width="90%" border="0" cellspacing="0" cellpadding="0">
                   

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
                    <td colspan="2" style="font-size:12px"><em> <strong>পক্ষেঃ-যমুনা সীডস্ স্টোরেজ (প্রাঃ) লিঃ-১ </strong></em></td>                    </tr>
                    <!--<tr>-->
                    <!--  <td colspan="3"><?php include("../../../assets/template/report_print_buttom_content.php");?></td>-->

                    <!--</tr>-->
                </table>
                <div class="footer1"> </div>
            </td>
        </tr>
    </table>
</body>

</html>