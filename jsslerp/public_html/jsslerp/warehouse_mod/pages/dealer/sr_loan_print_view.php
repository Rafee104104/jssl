<?php

session_start();

ob_start();

require_once "../../../assets/template/layout.top.php";

//require "../../../engine/tools/class.numbertoword.php";

$sr_id = $_REQUEST['sr_id'];

$sql1="select * from sr_token where booking_number='$booking_number'";



$data=mysql_fetch_object(mysql_query($sql1));




?>
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
<body style="font-family: Poppins, Helvetica, sans-serif, sutonnymj;">
<form action="" method="post">
  <table width="800" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td style="text-align:center"><h1 id="company_name" >যমুনা সীডস্ স্টোরেজ (প্রাঃ) লিঃ </h1>
        <h4>কালুপাড়া, পবা, রাজশাহী</h4>
        <h4>এস আর গ্রহণ টোকেন</h4>
        <h4> ধরণঃ খাওয়ার আলু/বীজ আলু</h4></td>
    </tr>
    <tr>
      <td colspan="0" align="center"><hr /></td>
    </tr>
    <tr>
      <td><div id="pr">
          <div align="left">
            <table width="60%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><input name="button" type="button" onclick="hide();window.print();" value="Print" /></td>
                <!--<td><span class="style3">Special Cash Discount: </span></td>
          <td><label>
            <input name="cash_discount" type="text" id="cash_discount" value="<?=$cash_discount?>" />
            </label>
            <input type="hidden" name="po_no" id="po_no" value="<?=$po_no?>" /></td>
          <td><label>
            <input type="submit" name="Update" value="Update" />
          </label></td>-->
              </tr>
            </table>
          </div>
        </div></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="3"  style="font-size:12px">
	  
	
          <tr >
            <td><strong>ক্রমিক নং:</strong> </td>
            <td><?=$data->sr_id?>&nbsp;</td>
          </tr>
          <tr>
            <td><strong>নাম:</strong></td>
            <td><?=$data->name?>&nbsp;</td>
          </tr>
          <tr>
            <td><strong>গ্রাম:</strong> </td>
            <td><?=$data->area?>&nbsp;</td>
          </tr>
          <tr>
            <td><strong>বুকিং নং:</strong> </td>
            <td><?=$data->booking_number?>&nbsp;</td>
          </tr>
          <tr>
            <td><strong>এস আর নং:</strong> </td>
            <td><?=$data->sr_number?>&nbsp;</td>
          </tr>
          <tr>
            <td><strong>পরিমাণ:</strong> </td>
            <td><?=$data->quantity?>&nbsp;</td>
          </tr>
		  
		  
        </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
    <td align="center"><div class="footer1"></div>
      <div class="footer1">
        <table width="100%" border="0">
          <tr>
            <td align="center"><?=$emp->PBI_NAME;?></td>
            <td align="center"><?php echo find_a_field(' hrm_user_access','user_name','emp_id='.$all->checked_by);?></td>
            <td align="center"><?php echo find_a_field(' hrm_user_access','user_name','emp_id='.$all->operation_manager);?></td>
            <td align="center"><?=find_a_field('user_activity_management','fname','user_id='.$all->approve_by)?></td>
            <?php /*?><td><?=find_a_field('user_activity_management','fname','user_id='.$all->checked_by)?></td><?php */?>
            <td align="center"></td>
          </tr>
          <tr>
            <td align="center">Prepared By</td>
            <td align="center">Recommanded By </td>
            <td align="center">Operation Manager</td>
            <td  align="center">Checked By </td>
            <td align="center">Approved By </td>
          </tr>
        </table>
        <tr>
            <td><p align="center"> <strong>বিঃ দ্রঃ</strong> নিজ দায়িত্বে বস্তার নাম্বার করিয়ে নিন। আলুর বস্তার নাম্বার না করার জনা আলু হারিয়ে গেলে কর্তৃপক্ষ দ্বায়ী নহে। </p></td>
          </tr>
      </div></td>
  </tr>
    
    
  </table>
</form>
</body>
</html>
