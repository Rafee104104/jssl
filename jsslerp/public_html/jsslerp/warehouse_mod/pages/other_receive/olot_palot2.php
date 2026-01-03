<?php
session_start();
//====================== EOF ===================
//var_dump($_SESSION);
//require "../../support/inc.all.php";
require_once "../../../assets/support/inc.all.php";

$or_no 		= $_REQUEST['v_no'];


/*$group = find_all_field('user_group','','id="'.$_SESSION['user']['group'].'"');
*/
$datas=find_all_field('warehouse_other_receive','','or_no='.$or_no);
$data2=find_all_field('journal_item','','or_no='.$tr_no);

$sql1="select b.* from warehouse_other_receive b where b.or_no = '".$or_no."'";
$data1=mysql_query($sql1);


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
/*
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
*/
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
                                <h5>আলু পজিশন রিপোর্ট</h5>


                           

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
                        

                        <td align="center" bgcolor="#CCCCCC"><strong>এস আর  <strong>   </td>
                        <td align="center" bgcolor="#CCCCCC"><strong>বস্তা</strong></td>
                        <td align="center" bgcolor="#CCCCCC"><strong> লোডিং পজিশন</strong> </strong></td>
                        <td align="center" bgcolor="#CCCCCC"><strong> ১ম পালট </strong> </strong></td>
                        <td align="center" bgcolor="#CCCCCC"><strong> ২য় পালট </strong> </strong></td>
                        <td align="center" bgcolor="#CCCCCC"><strong> ৩য় পালট<strong> </strong></td>
                        <td align="center" bgcolor="#CCCCCC"><strong> ৪র্থ পালট </strong> </strong></td>
                        <td align="center" bgcolor="#CCCCCC"><strong> আনলোড </strong> </strong></td>
                        <td align="center" bgcolor="#CCCCCC"><strong> মন্তব্য  <strong> </td>

                    </tr>

                    <? echo $sql1="select b.barcode, b.tr_no from warehouse_other_receive a, journal_item j where a.or_no = b.tr_no";
$data=mysql_query($sql1);


while($info=mysql_fetch_object($data)){?>

                    <tr>
                       
                        <td align="right" valign="top"><?=$info-barcode;?></td>
                        <td align="right" valign="top"><?=$info-barcode;?></td>
                        <td align="right" valign="top"><?=$info-barcode;?></td>
                        <td align="right" valign="top"><?=$info-barcode;?></td>
                        <td align="right" valign="top"><?=$info-barcode;?></td>
                        <td align="right" valign="top"><?=$info-barcode;?></td>
                        <td align="right" valign="top"><?=$info-barcode;?></td>
                        <td align="right" valign="top"><?=$info-barcode;?></td>
                        <td align="right" valign="top"><?=$info-barcode;?></td>
                    </tr>

                 <? }?>
              
                    
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