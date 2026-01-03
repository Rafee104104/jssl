<?php
session_start();
require_once "../../../assets/support/inc.all.php";
require_once ('../../common/class.numbertoword.php');
$proj_id=$_SESSION['proj_id'];
$vtype=$_REQUEST['v_type'];
$no=$vtype."_no";
$vdate=$vtype."_date";

	$sql_new="SELECT proj_address FROM project_info LIMIT 1";
	//echo $sql_new;
	$sql1_new=mysql_query($sql_new);
	if($data_new=mysql_fetch_row($sql1_new))
	{
		$address	= $data_new[0];
	}
if($vtype=='receipt')$voucher_name='RECEIPT VOUCHER';
elseif($vtype=='payment')$voucher_name='PAYMENT VOUCHER';
elseif($vtype=='coutra')$voucher_name='CONTRA VOUCHER';
else $voucher_name='JOURNAL VOUCHER';
if(isset($_REQUEST['vo_no']))
{
$vo_no=$_REQUEST['vo_no'];
$sql1=strtolower("select $no,$vdate from $vtype where $no=$vo_no limit 1");
$data1=mysql_fetch_row(mysql_query($sql1));
$vo_no=$data1[0];
$vo_date=$data1[1];
}

$pi=0;
$cr_amt=0;
$dr_amt=0;
$sql2=strtolower("SELECT a.ledger_name,b.* FROM accounts_ledger a, $vtype b where b.$no='$vo_no' and a.ledger_id=b.ledger_id order by b.dr_amt desc");
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.: Voucher :.</title>
<link href="../../../assets/css/voucher_print.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript">
function hide()
{
    document.getElementById("pr").style.display="none";
}
</script>
<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-weight: bold;
}
-->
</style>
</head>
<body>
<table width="820" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><div class="header">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
	    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="1%">
			<? $path='../logo/'.$_SESSION['proj_id'].'.jpg';
			if(is_file($path)) echo '<img src="'.$path.'" height="80" />';?>
			
			</td>
            <td width="83%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" class="title"><?=$_SESSION['proj_name']?></td>
              </tr>
              <tr>
                <td align="center"><?=$address?></td>
              </tr>
              <tr>
                <td align="center"><table  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td>&nbsp;</td>
                      <td width="325"><div align="center" class="style1"><?=$voucher_name?></div></td>
                      <td>&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
          </tr>

        </table></td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	  </tr>
    </table>
    </div></td>
  </tr>
  <tr>
    
	<td>	</td>
  </tr>
  
  <tr>

    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="2" class="tabledesign_text">

<div id="pr">
<div align="left">
<input name="button" type="button" onclick="hide();window.print();" value="Print" />
</div>
</div></td>
        </tr>
      <tr>
        <td class="tabledesign_text"> Voucher No  : <?=$vo_no?></td>
        <td class="tabledesign_text">Voucher Date : <?=date('d-m-Y',$vo_date)?></td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#000000" class="tabledesign">
      <tr>
        <td width="25%" rowspan="2" align="center">A/C Ledger Head</td>
        <td width="15%" rowspan="2" align="center">Folio No.</td>
        <td width="35%" rowspan="2" align="center">Particulars</td>
        <td colspan="2">Amount (Taka) </td>
      </tr>
      <tr>
        <td width="13%">Debit </td>
        <td width="13%">Credit</td>
      </tr>
	  <?

$data2=mysql_query($sql2);
			  while($info=mysql_fetch_object($data2)){ $pi++;
			  $cr_amt=$cr_amt+$info->cr_amt;
			  $dr_amt=$dr_amt+$info->dr_amt;
			  if($info->bank==''&&$info->cheq_no!='')
			  $narration=$info->narration.':: Cheq # '.$info->cheq_no.'; dt= '.date("d.m.Y",$info->cheq_date);
			  elseif($info->cheq_no=='')
			  $narration=$info->narration;
			  else
			  $narration=$info->narration.':: Cheq # '.$info->cheq_no.'; dt= '.date("d.m.Y",$info->cheq_date).'; Bank # '.$info->bank;
			  
	  ?>
      <tr>
        <td align="left"><?=$info->ledger_name?></td>
        <td align="left">&nbsp;</td>
        <td align="left"><?=$narration?></td>
        <td><?=$info->dr_amt?></td>
        <td><?=$info->cr_amt?></td>
      </tr>
<?php }?>
      <tr>
        <td colspan="3" align="right">Total Taka: </td>
        <td><?=$dr_amt?></td>
        <td><?=$cr_amt?></td>
      </tr>
      
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Amount in Word : (Taka <?=convertNumberMhafuz($cr_amt)?> Only) </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="tabledesign_text"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" valign="bottom">..........................................</td>
        <td align="center" valign="bottom">..........................................</td>
        <td align="center" valign="bottom">..........................................</td>
      </tr>
      <tr>
        <td width="33%"><div align="center">Prepared by </div></td>
        <td width="33%"><div align="center">Checked By </div></td>
        <td width="34%"><div align="center">Approved By </div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
