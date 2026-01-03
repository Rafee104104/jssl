<?php

session_start();

ob_start();

require_once "../../../assets/template/layout.top.php";

//require "../../../engine/tools/class.numbertoword.php";

$sr_id = $_REQUEST['sr_id'];

$sql1="select * from sr_token where sr_id='$sr_id'";



$data=mysql_fetch_object(mysql_query($sql1));




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"   />
<title>.: Other Receive Report :.</title>
<link href="../css/invoice.css" type="text/css" rel="stylesheet"/>
<?php include("../../../assets/css/theme_responsib_new_table_report.php");?>
<script type="text/javascript">
function hide()
{
    document.getElementById("pr").style.display="none";
}
</script>
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>
</head>
<body style="font-family:Tahoma, Geneva, sans-serif">
<table width="800" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td> <div id="pr">
  <div align="center">
<input name="button" type="button" onclick="hide();window.print();" value="Print" />
  </div>
</div>	
	<div class="header">
        <table class="table1">
          <tr>
            <td class="logo"><img src="../../../logo/1.png" class="logo-img"/> </td>
            <td style="text-align:center"><h4 id="company_name" >যমুনা সীডস্ স্টোরেজ (প্রাঃ) লিঃ </h4>
              <h5>কালুপাড়া, পবা, রাজশাহী</h5>
              <h5>আলু সংরক্ষণ রশিদ</h5>
              <h5>(হস্তান্তর-নিষিদ্ধ)</h5></td>
            <td class="Qrl_code">
              <p class="qrl-text"></p></td>
          </tr>
        </table>
      </div></td>
  </tr>
  <tr>
    <td><hr /></td>
  </tr>
  
  
  <tr>
    <td>
	
	
	<div class="header">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><table width="100%" border="0" align="center" cellpadding="5" cellspacing="">
                            <tr>
                              <td bgcolor="#666666" style="text-align:center; color:#FFF; font-size:18px; font-weight:bold;"><?=$datas->receive_type;?>
                                Report </td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
		 <tr>
    <td><hr /></td>
  </tr>
		  
		  
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3"  style="font-size:13px">
                      <tr>
                        <td width="40%" align="right"valign="middle"><strong>ক্রমিক নং:</strong></td>
                        <td><table width="80%" border="1" cellspacing="0" cellpadding="3">
                            <tr>
                              <td><?=$data->sr_id?>
                                &nbsp;</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                      <tr>
                        <td width="40%" align="right"valign="middle"><strong>নাম:</strong></td>
                        <td><table width="80%" border="1" cellspacing="0" cellpadding="3">
                            <tr>
                              <td><?=$data->farmer_name?>&nbsp;</td>
                            </tr>
                          </table></td>
                      </tr>
                     
                      <tr>
                        <td align="right"valign="top"><strong>গ্রাম:</strong> </td>
                        <td><table width="80%" border="1" cellspacing="0" cellpadding="3">
                            <tr>
                              <td><?=$data->area?>&nbsp;</td>
                            </tr>
                          </table></td>
                      </tr>
                     
                      </tr>
                    </table></td>
                  <td width="50%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3"  style="font-size:13px">
                   
                       <tr>
                        <td align="right"valign="middle"><strong> বুকিং নং:</strong></td>
                        <td><table width="80%" border="1" cellspacing="0" cellpadding="3">
                            <tr>
                              <td><?=$data->booking_number?> &nbsp;</td>
                            </tr>
                          </table></td>
                      </tr>
					  
					     <tr>
                        <td align="right"valign="middle"> <strong>এস আর নং:</strong></td>
                        <td><table width="80%" border="1" cellspacing="0" cellpadding="3">
                            <tr>
                              <td><?=$data->sr_number?>
                                &nbsp;</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td align="right"valign="middle"><strong>পরিমাণ:</strong></td>
                        <td><table width="80%" border="1" cellspacing="0" cellpadding="3">
                            <tr>
                              <td><?=$data->quantity?>&nbsp;</td>
                            </tr>
                          </table></td>
                    </table></td>
					
		
                </tr>
              </table></td>
          </tr>
        </table>
      </div></td>
  </tr>
  			 <tr>
    <td ><hr /></td>
  </tr>
  <tr>
    <td></td>
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
          <td colspan="2" align="center"><strong><br />
            </strong>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><div align="center">গ্রহীতা/জমাদানকারীর স্বাক্ষর</div></td>
                <td><div align="center"> প্রস্তুতকারীর স্বাক্ষর</div></td>
                <td><div align="center">স্টোর অফিসার/সহঃ স্টোর অফিসার </div></td>
                <td><div align="center">ম্যানেজার</div></td>
              </tr>
            </table></td>
        </tr>
        <tr>                 <td>&nbsp;</td>
</tr>
             <tr>                 <td>&nbsp;</td>
</tr>
          <td><p align="center"> <strong>বিঃ দ্রঃ</strong> নিজ দায়িত্বে বস্তার নাম্বার করিয়ে নিন। আলুর বস্তার নাম্বার না করার জনা আলু হারিয়ে গেলে কর্তৃপক্ষ দ্বায়ী নহে। </p></td>
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
