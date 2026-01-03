<?php
session_start();
//====================== EOF ===================
//var_dump($_SESSION);
require "../../damage_mod/support/inc.all.acc.php";

if($_REQUEST['req_no']>0)
$oi_no 		= $_REQUEST['req_no'];

elseif($_REQUEST['v_no']>0)
$oi_no 		= $_REQUEST['v_no'];

$datas=find_all_field('warehouse_other_issue','s','oi_no='.$oi_no);


$vendor = find_all_field('vendor','s','vendor_id='.$datas->issued_to);

$sql1="select b.* from warehouse_other_issue_detail b where b.oi_no = '".$oi_no."'";
$data1=mysql_query($sql1);

$pi=0;
$total=0;
while($info=mysql_fetch_object($data1)){ 
$pi++;
$ch_no=$info->ch_no;
$po_no = $info->po_no;
$id[]=$info->id;
$qc_by=$info->qc_by;
$receive_type[]=$info->receive_type;
$item_id[] = $info->item_id;
$rate[] = $info->rate;
$amount[] = $info->amount;
$rec_date=$info->rec_date;
$unit_qty[] = $info->qty;
$unit_name[] = $info->unit_name;
$entry_at=$info->entry_at;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.: Sales Return  Report :.</title>
<link href="../../damage_mod/pages/css/invoice.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript">
function hide()
{
    document.getElementById("pr").style.display="none";
}
function reloadPage() {
location.reload();
}

</script>
<script type="text/javascript" src="../js/paging.js"></script>
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>
</head>
<body style="font-family:Tahoma, Geneva, sans-serif"><form action="" method="post">
<table width="800" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><div class="header">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
	    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>
				<table width="60%" border="0" align="center" cellpadding="5" cellspacing="0">
      <tr>
        <td bgcolor="#666666" style="text-align:center; color:#FFF; font-size:18px; font-weight:bold;">REPROCESS ISSUE REPORT</td>
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
		    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3"  style="font-size:13px">
              
              <tr>
                <td align="right" valign="middle">Issued To: </td>
                <td><table width="100%" border="1" cellspacing="0" cellpadding="3">
                  <tr>
                    <td><?php echo $datas->issued_to;?></td>
                  </tr>
                  
                </table></td>
              </tr>
              <tr>
                <td align="right" valign="middle">Issued From: </td>
                <td><table width="100%" border="1" cellspacing="0" cellpadding="3">
                  <tr>
                    <td><?php echo find_a_field('warehouse','warehouse_name','warehouse_id='.$datas->warehouse_id);?></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td width="40%" align="right" valign="middle"> Note:</td>
                <td><table width="100%" border="1" cellspacing="0" cellpadding="3">
                    <tr>
                      <td><?php echo $datas->oi_subject;?></td>
                    </tr>
                </table></td>
              </tr>
              
              <tr>
                <td align="right" valign="middle"> Entry By:</td>
                <td><table width="100%" border="1" cellspacing="0" cellpadding="3">
                    <tr>
                      <td width="45%"><?=find_a_field('user_activity_management','fname','user_id='.$datas->entry_by);?></td>
                      <td width="55%"> Time: <?php echo $datas->entry_at;?></td>
                    </tr>
                </table></td>
              </tr>
            </table></td>
			<td width="30%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3"  style="font-size:13px">
              <tr>
                <td width="47%" align="right" valign="middle">Return No :</td>
                <td width="53%"><table width="100%" border="1" cellspacing="0" cellpadding="3">
                    <tr>
                      <td>&nbsp;<strong><?php echo $datas->oi_no;?></strong></td>
                    </tr>
                </table></td>
              </tr>
			  <tr>
                <td align="right" valign="middle">Return Date : </td>
			    <td><table width="100%" border="1" cellspacing="0" cellpadding="3">
                    <tr>
                      <td>&nbsp;
                          <?=date("d M, Y",strtotime($datas->oi_date))?></td>
                    </tr>
                </table></td>
			    </tr>
              <tr>
                <td align="right" valign="middle">Store Serial No :</td>
                <td><table width="100%" border="1" cellspacing="0" cellpadding="3">
                    <tr>
                      <td>&nbsp;<?php echo $datas->requisition_from;?></td>
                    </tr>
                </table></td>
              </tr>
            </table></td>
		  </tr>
		</table>		</td>
	  </tr>
    </table>
    </div></td>
  </tr>
  <tr>
    
	<td>	</td>
  </tr>
  
  <tr>
    <td>
      <div id="pr">
  <div align="left">
<input name="button" type="button" onclick="hide();window.print();" value="Print" />
  </div>
</div>
<table width="100%" class="tabledesign" border="1" bordercolor="#000000" cellspacing="0" cellpadding="5">
       <tr style="font-size:13px;">
        <td align="center" bgcolor="#CCCCCC"><strong>SL</strong></td>
        <td align="center" bgcolor="#CCCCCC"><strong>Code</strong></td>
        <td align="center" bgcolor="#CCCCCC"><div align="center"><strong>Product Name</strong></div></td>

        <td align="center" bgcolor="#CCCCCC"><strong>Unit</strong></td>
        <td align="center" bgcolor="#CCCCCC"><strong>Rate</strong></td>
        <td align="center" bgcolor="#CCCCCC"><strong> Qty</strong></td>
        <td align="center" bgcolor="#CCCCCC"><strong>Total Amt</strong></td>
		<td align="center" bgcolor="#CCCCCC">&nbsp;</td>
        </tr>
       
<? for($i=0;$i<$pi;$i++){
$item_info = find_all_field('item_info','item_name','item_id='.$item_id[$i]);
$damage_cause = find_all_field('damage_cause','damage_cause','id='.$receive_type[$i]);
?>
      
      <tr style="font-size:12px; height:40px;" <?=($i%2)?'bgcolor="#F7F7F7"':'';?>>
        <td align="center" valign="top"><?=$i+1?></td>
        <td align="left" valign="top"><?=$item_info->item_id;?></td>
        <td align="left" valign="top"><?=$item_info->item_name;?></td>
        <td align="right" valign="top"><?=$unit_name[$i]?></td>
        <td align="right" valign="top">
          <!--<input type="hidden" name="id_<?=$id[$i]?>" id="id_<?=$id[$i]?>" style="width:70px; text-align:right; color:#FF3300" value="<?=$rate[$i]?>" />-->
		  <? //=$rate[$i]?> 
		  
		  <input type="hidden" name="id_<?=$id[$i]?>" id="id_<?=$id[$i]?>" style="width:70px; text-align:right; color:#FF3300" value="<?=$rate[$i]?>" />
		  <input type="text" name="rate_<?=$id[$i]?>" id="rate_<?=$id[$i]?>" style="width:70px; text-align:right; color:#FF3300" value="<?=$rate[$i]?>" /> 
		  
		</td>
        <td align="right" valign="top"><?=$unit_qty[$i]?></td>
        <td align="right" valign="top"><strong><?=number_format($amount[$i],2);$t_amount = $t_amount + $amount[$i];?>
        </strong></td>
		<td align="right" valign="top">
		<span id="po<?=$id[$i]?>"><input type="button" name="Submit" value="RESET" style="font-size:11px; color:#FF0000;" 
		onclick="getData2('reprocess_view_print_ajax.php', 'po<?=$id[$i]?>','<?=$id[$i]?>',document.getElementById('rate_<?=$id[$i]?>').value);" /></span></td>
		
        </tr>
		
<? }?>
  <tr style="font-size:14px;"><td colspan="6" align="center" valign="top"><div align="right"><strong>Total Amount: </strong></div></td>
        <td align="right" valign="top"><span class="style1">
          <?=number_format($t_amount,2)?>
        </span></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" style="font-size:12px"><em>All goods are checked and confirmed as per Terms.</em></td>
    </tr>
  <tr>
    <td width="50%">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
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
          <td><div align="center">Received By </div></td>
          <td><div align="center">Quality Controller </div></td>
          <td><div align="center">Store Incharge </div></td>
          </tr>
      </table></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    </table>
    <div class="footer1"> </div>
    </td>
  </tr>
</table></form>
</body>
</html>
