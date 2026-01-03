<?php


require_once "../../../assets/template/layout.top.php";
require_once ('../../common/class.numbertoword.php');


$jv_no=$_REQUEST['jv_no'];
$config_ledger = find_all_field('config_group_class','sales_ledger',"group_for=".$_SESSION['user']['group']);

$jv_no=$_REQUEST['jv_no'];
if($_POST['check']=='CHECK')
{
	$time_now = date('Y-m-d H:s:i');
	$voucher_date = strtotime($_POST['voucher_date']);

	$jv=next_journal_voucher_id();
	
	 $ssql='update secondary_journal set jv_date="'.$voucher_date.'", checked_at="'.$time_now.'", checked_by="'.$_SESSION['user']['id'].'", checked="YES"  where jv_no="'.$jv_no.'"';
	mysql_query($ssql);
	
	sec_journal_journal($jv_no,$jv,'Consumption');
}

if(prevent_multi_submit()){ 

if($_POST['calculate']=='RE-CALCULATE')
{
$jv = find_all_field('secondary_journal','jv_date','jv_no='.$jv_no);
$ch = find_all_field('warehouse_other_issue','pr_no','oi_no='.$jv->tr_no);
$receive_date = $_POST['calculate_date'];
$ssql='update warehouse_other_issue set receive_date="'.$receive_date.'" where oi_no="'.$jv->tr_no.'"';
mysql_query($ssql);
$ssql='delete from secondary_journal where  tr_from="Consumption" and tr_no="'.$jv->tr_no.'" ';
mysql_query($ssql);
$ssql='delete from journal where  tr_from="Consumption" and tr_no="'.$jv->tr_no.'" ';
mysql_query($ssql);
auto_insert_sales_return_secoundary($jv->tr_no);
	$jv_no = find_a_field('secondary_journal','jv_no','tr_from="Consumption" and tr_no="'.$jv->tr_no.'" ');

}
}

$address=find_a_field('project_info','proj_address',"1");

$jv = find_all_field('secondary_journal','jv_date','jv_no='.$jv_no);
$ch = find_all_field('warehouse_other_issue','pr_no','oi_no='.$jv->tr_no);


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.: Voucher :.</title>
<link href="../../../assets/css/voucher_print.css" type="text/css" rel="stylesheet"/>

<link href="../../css_js/css/pagination.css" rel="stylesheet" type="text/css" />
<link href="../../css_js/css/jquery-ui-1.8.2.custom.css" rel="stylesheet" type="text/css" />
<link href="../../css_js/css/jquery.autocomplete.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="../../css_js/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../../css_js/js/jquery-ui-1.8.2.custom.min.js"></script>

<script type="text/javascript" src="../../css_js/js/jquery.autocomplete.js"></script>
<script type="text/javascript" src="../../css_js/js/jquery.validate.js"></script>
<script type="text/javascript" src="../../css_js/js/paging.js"></script>
<script type="text/javascript" src="https://mahirgrouperp.com/ddaccordion_new.js"></script>
<script type="text/javascript" src="../../css_js/js/js.js"></script>
<script type="text/javascript" src="../../css_js/js/jquery.ui.datepicker.js"></script>
<script type="text/javascript">
function hide()
{
    document.getElementById("pr").style.display="none";
}
function DoNav(theUrl)
{
	var URL = 'unchecked_voucher_view_popup_purchase.php?'+theUrl;
	popUp(URL);
}

function popUp(URL) 
{
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=1,menubar=0,resizable=1,width=800,height=800,left = 383,top = -16');");
}
</script>
<? do_calander('#voucher_date');?><? do_calander('#bill_date');?>
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style3 {color: #FFFFFF; font-weight: bold; font-size: 12px; }
-->
</style>
</head>
<body><form action="" method="post">
<table width="820" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><div class="header">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
	    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="1%">
                <!--<img src="../../../logo/1.png" style=" height:70px; width:auto;" />-->
<!--			<img src="../../../logo/--><?//=$_SESSION['proj_id']?><!--.png" style="width:100px;" />		-->
            </td>
            <td width="83%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" class="title">

				<?
if($_SESSION['user']['group']>1)
echo find_a_field('user_group','group_name',"id=".$jv->group_for);
else
echo $_SESSION['proj_name'];
				?>                </td>
              </tr>
              <tr>
                <td align="center"><?=find_a_field('user_group','address','1');?></td>
              </tr>
			  
			  <tr>
                <td align="center" style="line-height: 0px !important;"><?=find_a_field('user_group','factory_address','1');?></td>
              </tr>
              <tr>
                <td align="center"></td>
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
<? if($jv->checked!='YES'){?>
<div align="left">
<form action="" method="post">
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">
  <tr>
    <td width="1" rowspan="2"><input name="button" type="button" onclick="hide();window.print();" value="Print" /></td>
    <td width="180" rowspan="2" align="right"><a target="_blank" href="packing_consumption_report.php?v_no=<?=$ch->oi_no?>">PR-
        <?=$ch->oi_no?>
    </a></td>
    <td align="right">Voucher Date :</td>
    <td><input name="jv_no" type="hidden" value="<?=$jv_no?>" />
        <input name="voucher_date" type="text" id="voucher_date" value="<?=$jv->jv_date;?>" />
        <input name="oi_no" type="hidden" value="<?=$ch->oi_no?>" />    </td>
   <td>
  <?php if ($jv->checked == 'NO' || $jv->checked == '') { ?>
    <input name="check" type="submit" id="check" value="CHECK" style="font-size:12px; color:#990000" />
  <?php } ?>
  <input type="hidden" name="req_no" id="req_no" value="<?=$jv->jv_on?>" />
</td>

  </tr>
  <tr>
    <td width="120" align="right">&nbsp;</td>
    <td width="0"><input type="button" name="Submit" value="EDIT VOUCHER"  onclick="DoNav('<?php echo '&v_type=Consumption&v_no='.$jv_no.'&view=Show' ?>');" /></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<a target="_blank" href="reprocess_issue_report.php?v_no=<?=$ch->oi_no?>"></a></div><? }else{?>
<div align="left">
<form action="" method="post">
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#339900">
  <tr>
    <td width="1"><input name="button" type="button" onclick="hide();window.print();" value="Print" /></td>
    <td width="200" align="right"><a target="_blank" href="packing_consumption_report.php?v_no=<?=$ch->oi_no?>">PR-
        <?=$ch->oi_no?>
    </a></td>
    <td width="150" align="right">&nbsp;</td>
    <td width="0"><div align="center"><span class="style1">CHECKED</span></div></td>
    <td width="120">&nbsp;</td>
    <td width="1">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<a target="_blank" href="../../warehouse_mod/pages/pr/chalan_view2.php?v_no=<?=$ch->pr_no?>"></a></div><? }?>
</div></td>
        </tr>
      <tr>
        <td class="tabledesign_text">Voucher Date :
          <?=$jv->jv_date;?></td>
        <td class="tabledesign_text">
          TR From:
          <?=$jv->tr_from;?></td>
      </tr>
      <tr>
        <td class="tabledesign_text">Voucher No  :
          <?=$jv_no?></td>
        <td class="tabledesign_text">Entry By :
          <? echo find_a_field('user_activity_management','fname','user_id='.$jv->entry_by);?></td>
      </tr>
      <tr>
        <td class="tabledesign_text">TR No  :
          <?=$jv->tr_no;?></td>
        <td class="tabledesign_text">Checked By :
          <? if($jv->checked=='YES') echo find_a_field('user_activity_management','fname','user_id='.$jv->checked_by); else echo 'Not Checked';?></td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><? if($cccode>0){?>CC CODE/PROJECT NAME: <? echo find_a_field('cost_center','center_name',"id='$cccode'")?><? }?></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#000000" class="tabledesign">
      <tr>
        <td align="center"><div align="center">SL</div></td>
        <td align="center">Control Head</td>
        <td align="center">A/C Ledger Head</td>
        <td align="center">Particulars</td>
        <td>Debit</td>
        <td>Credit</td>
      </tr>
      
	  <?
   $sql2="SELECT a.ledger_id,a.ledger_name,sum(dr_amt) as dr_amt, a.ledger_group_id, b.narration FROM accounts_ledger a, secondary_journal b where b.jv_no='$jv_no' and a.ledger_id=b.ledger_id and jv_no=$jv_no and dr_amt>0 group by b.ledger_id order by dr_amt desc";
$data2=mysql_query($sql2);
while($info=mysql_fetch_object($data2)){		  
	  ?>
      <tr>
        <td align="left"><div align="center">
          <?=++$s;
		  ?>
        </div></td>
        <td align="left"><?

       echo $grp_name=find_a_field('ledger_group','group_name','group_id='.$info->ledger_group_id);

		//$ggrp = explode('>',$grp_name );

		//echo $ggrp[1];

		?>
		
		</td>
        <td align="left"><?=$info->ledger_name?></td>
        <td align="left"><?=$info->narration?></td>
        <td align="right"><? echo number_format($info->dr_amt,2); $ttd = $ttd + $info->dr_amt;?></td>
        <td align="right"><? echo number_format($info->cr_amt,2); $ttc = $ttc + $info->cr_amt;?></td>
        </tr>
<?php }?>
<?
  $sql2="SELECT a.ledger_id,a.ledger_name,sum(cr_amt) as cr_amt, a.ledger_group_id, b.narration FROM accounts_ledger a, secondary_journal b where b.jv_no='$jv_no' and a.ledger_id=b.ledger_id and jv_no=$jv_no and cr_amt>0 group by b.ledger_id desc";
$data2=mysql_query($sql2);
while($info=mysql_fetch_object($data2)){	
 
	  ?>
      <tr>
        <td align="left"><div align="center">
          <?=++$s;?>
        </div></td>
        <td align="left"><?

       echo $grp_name=find_a_field('ledger_group','group_name','group_id='.$info->ledger_group_id);

		//$ggrp = explode('>',$grp_name );

		//echo $ggrp[1];

		?></td>
        <td align="left"><?=$info->ledger_name?></td>
        <td align="left"><?=$info->narration?></td>
        <td align="right"><? echo number_format($info->dr_amt,2); $ttd = $ttd + $info->dr_amt;?></td>
        <td align="right"><? echo number_format($info->cr_amt,2); $ttc = $ttc + $info->cr_amt;?></td>
        </tr>
<?php }?>





      <tr>
        <td colspan="4" align="right">Total Taka: </td>
        <td align="right"><?=number_format($ttd,2)?></td>
        <td align="right"><?=number_format($ttc,2)?></td>
        </tr>
      
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
     <tr>
    <td>Amount in Word : 

	 (<? echo convertNumberMhafuz($ttc)?>)	 </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="tabledesign_text"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" valign="bottom">................................</td>
        <td align="center" valign="bottom">................................</td>
        <td align="center" valign="bottom">................................</td>
        <td align="center" valign="bottom">................................</td>
      </tr>
      <tr>
        <td width="33%"><div align="center">Received by </div></td>
        <td width="33%"><div align="center">Prepared by </div></td>
        <td width="33%"><div align="center">Head of Accounts </div></td>
        <td width="34%"><div align="center">Approved By </div></td>
      </tr>
    </table></td>
	
	
	
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table></form>
</body>
</html>
