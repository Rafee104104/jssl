<?php
require_once "../../../assets/template/layout.top.php";
$title='Debit Voucher';
$proj_id=$_SESSION['proj_id'];
$user_id=$_SESSION['user']['id'];

$chk_voucher_mode = mysql_query("SELECT voucher_mode,voucher_entry_mode FROM project_info LIMIT 1");
$old_voucher_mode = mysql_result($chk_voucher_mode,0,'voucher_mode');
$voucher_type = mysql_result($chk_voucher_mode,0,'voucher_entry_mode');
//step 1
if(!isset($_GET['v_d'])&&!isset($_GET['v_type']))
	{
		$voucher_mode = $_POST['voucher_mode'];
	if($voucher_mode==0&&$_POST['receipt_no']>0)
			{
				$receipt_no		   = $_POST['receipt_no'];
				$manual_payment_no = $_POST['receipt_no'];
			}
			
		else
			{
		$receiptno=next_value('payment_no','payment');
		$receipt_no		   = $receiptno;
		$manual_payment_no = '';
			}
		
		$v_d=time();
		if( $voucher_mode != $old_voucher_mode )
			mysql_query("UPDATE project_info SET voucher_mode=$voucher_mode WHERE 1");			
	}
else
{
	$receipt_no	= $_GET['v_no'];
	$v_d		= $_GET['v_d'];
	$v_no		= $_GET['v_no'];
	$v_type		= $_GET['v_type'];
}
///////////////////
if($_POST['Payment_varify'])
{
	if($_GET['action'] == 'EDITING')
	{
		$vv 	= $_GET['v_type']."_no";
		$del1 	= "delete from journal where tr_no='$v_no' and tr_from='$v_type'";
		$dell 	= "delete from $v_type where $vv='$v_no'";
		$ddl 	= mysql_query($del1);
		$dd1 	= mysql_query($dell);
	}
	$date		= $_REQUEST["date"];
	$ledger_id	= $_REQUEST["ledger_id"];
	$bank		= $_REQUEST["bank"];
	$r_from		= $_REQUEST['r_from'];
	$c_no		= $_REQUEST['c_no'];
	$c_date		= $_REQUEST['c_date'];
	$c_id		= $_REQUEST['c_id'];
	$t_amount	= $_REQUEST['t_amount'];
	//voucher date decode
	$j=0;
	for($i=0;$i<strlen($date);$i++)
	{
		if(is_numeric($date[$i]))
		{
			$time[$j]=$time[$j].$date[$i];
		}
		else 
		{
			$j++;
		}
	}
	$date=mktime(0,0,0,$time[1],$time[0],$time[2]);
	//////////////////////
	//check date decode
	$j=0;
	for($i=0;$i<strlen($c_date);$i++)
	{
	if(is_numeric($c_date[$i]))
	$ptime[$j]=$ptime[$j].$c_date[$i];
	else $j++;
	}
	$c_date=mktime(0,0,0,$ptime[1],$ptime[0],$ptime[2]);
	//////////////////////////
	$c = $_REQUEST['count'];
	for($i=1; $i <= $c; $i++)  //data insert loop
	{
		if($_REQUEST['deleted'.$i] == 'no')
		{
		$ledger_id=$_REQUEST['ledger_id'.$i];
		if( preg_match("/:/",$ledger_id))
				{
				    $exploded 		= explode(':',$ledger_id);
					$ledger_id		=trim($exploded[0]);
					if(is_numeric(trim($exploded[1])))
					$sub_ledger=trim($exploded[1]);
				}
			

			
			$detail_status = $_REQUEST['detail'.$i];		
			$cur_bal= $_REQUEST['cur_bal'.$i];
			$detail = $_REQUEST['detail'.$i];
			$amount = $_REQUEST['amount'.$i];
			$cc_code = $_REQUEST['cc_code'.$i];
			
			//invoice number create
		$jv=next_journal_voucher_id();
			
		$recept="INSERT INTO `payment` (
									`payment_no`,
									`payment_date`,
									`proj_id`,
									`narration`,
									`ledger_id`,
									`dr_amt`,
									`cr_amt`,
									`type`,
									`cur_bal`,
									`received_from`,
									`cheq_no`,
									`cheq_date`,
									`bank`,
									`manual_payment_no`,
									`cc_code`
									)
					VALUES ('$receipt_no', '$date', '$proj_id', '$detail', '$ledger_id', '$amount','0', 'Debit', '$cur_bal','$r_from','$c_no','$c_date','$bank','$manual_payment_no', '$cc_code')";
		
		if($bank=='')
		{
			$dnarr=$detail;
		}
		else
		{
			$dnarr=$detail.':: Cheq# '.$c_no.':: Date= '.date("d.m.Y",$c_date);
		}
		
		$journal="INSERT INTO `journal` (
									`proj_id` ,
									`jv_no` ,
									`jv_date` ,
									`ledger_id` ,
									`narration` ,
									`dr_amt` ,
									`cr_amt` ,
									`tr_from` ,
									`sub_ledger` ,
									`tr_no`,
									`cc_code` 
									,user_id
									)
					VALUES ('$proj_id', '$jv', '$date', '$ledger_id', '$dnarr', '$amount','0', 'Payment','$sub_ledger', '$receipt_no', '$cc_code','$user_id')";
		
			if($_REQUEST['count'] > 0)
			{			
				$query_receipt = mysql_query($recept);
				$query_journal = mysql_query($journal);	
			}
		//echo $recept."<br>";
		//echo $journal."<br>";
		}
	}
		//invoice number create
	$jv=next_journal_voucher_id();
	
	$detail="Paid to ".$r_from;
	
	$recept="INSERT INTO `payment` (
							payment_no ,
							payment_date ,
							proj_id ,
							narration ,
							ledger_id ,
							dr_amt ,
							cr_amt ,
							type ,
							cur_bal ,
							received_from,
							cheq_no,
							cheq_date,
							bank,
							manual_payment_no,
							cc_code
							)
			VALUES ('$receipt_no', '$date', '$proj_id', '$detail', '$c_id', '0','$t_amount', 'Credit', '$cur_bal','$r_from','$c_no','$c_date','$bank','$manual_payment_no','$cc_code')";
	
	$journal="INSERT INTO `journal` (
							`proj_id` ,
							`jv_no` ,
							`jv_date` ,
							`ledger_id` ,
							`narration` ,
							`dr_amt` ,
							`cr_amt` ,
							`tr_from` ,
							`tr_no`,
							`cc_code` 
							,user_id
							)
			VALUES ('$proj_id', '$jv', '$date', '$c_id', '$detail', '0','$t_amount', 'Payment', '$receipt_no', '$cc_code','$user_id')";
	
	if($_REQUEST['count'] > 0)
	{			
		$query_receipt = mysql_query($recept);
		$query_journal = mysql_query($journal);	
	}
}




//print code
if(!isset($_GET['v_d']))
{

	$receiptno=next_value('payment_no','payment');
	$v_d=time();
}
?>
<?php js_ledger_subledger_autocomplete_new('payment',$proj_id,$voucher_type); ?>
<?php
	$led1=mysql_query("select id, center_name FROM cost_center WHERE 1 ORDER BY center_name ASC");
	if(mysql_num_rows($led1) > 0)
	{
      $data1 = '[';
	  while($ledg1 = mysql_fetch_row($led1)){
          $data1 .= '{ name: "'.$ledg1[1].'", id: "'.$ledg1[0].'" },';
	  }
      $data1 = substr($data1, 0, -1);
      $data1 .= ']';
	}
	else
	{
		$data1 = '[{name:"empty", id:""}]';
	}
	
    $led2=mysql_query("select ledger_id, ledger_name from accounts_ledger where ledger_group_id='$cash_and_bank_balance' and 1 order by ledger_name");
	if(mysql_num_rows($led2) > 0)
	{
      $data2 = '[';
	  while($ledg2 = mysql_fetch_row($led2)){
          $data2 .= '{ name: "'.$ledg2[1].'", id: "'.$ledg2[0].'" },';
	  }
      $data2 = substr($data2, 0, -1);
      $data2 .= ']';
	}
	else
	{
		$data2 = '[{name:"empty", id:""}]';
	}
/*
	  $led3=mysql_query("select taskmngr.member.id, taskmngr.member.name from taskmngr.member");
      $data3 = '[';
	  while($ledg3 = mysql_fetch_row($led3)){
          $data3 .= '{ name: "'.$ledg3[1].'", id: "'.$ledg3[0].'" },';
	  }
      $data3 = substr($data3, 0, -1);
      $data3 .= ']';
	  */
?>
<script type="text/javascript">

$(document).ready(function(){

    function formatItem(row) {
		//return row[0] + " " + row[1] + " ";
	}
	function formatResult(row) {
		return row[0].replace(/(<.+?>)/gi, '');
	}

    var data1 = <?php echo $data1; ?>;
    $("#cc_code").autocomplete(data1, {
		matchContains: true,
		minChars: 0,
		scroll: true,
		scrollHeight: 300,
        formatItem: function(row, i, max, term) {
            return row.name; // + " [" + row.id + "]";
		},
		formatResult: function(row) {
			return row.id;
		}
	});

    var data2 = <?php echo $data2; ?>;
    $("#c_id").autocomplete(data2, {
		matchContains: true,
		minChars: 0,
		scroll: true,
		scrollHeight: 300,
        formatItem: function(row, i, max, term) {
            return row.name; /// + " [" + row.id + "]";
		},
		formatResult: function(row) {
			return row.id;
		}
	});
/*
	var data3 = <?php echo $data3; ?>;
    $("#emp_name").autocomplete(data3, {
		matchContains: true,
		minChars: 0,
		scroll: true,
		scrollHeight: 300,
        formatItem: function(row, i, max, term) {
            return row.name + " [" + row.id + "]";
		},
		formatResult: function(row) {
			return row.id;
		}
	});
	*/
  });
</script>
<script type="text/javascript">
function voucher_no(val)
	{
		var voucher_mode = val;
		
		if( voucher_mode == 0 )
			{
				document.getElementById('receipt_no').value		= "";
				document.getElementById('receipt_no').readOnly	= false;
				document.getElementById('receipt_no').select();
				document.getElementById('receipt_no').focus();
			}
		else if( voucher_mode == 1 )
			{
				document.getElementById('receipt_no').value		= "<?php echo $receipt_no;?>";
				document.getElementById('receipt_no').readOnly	= true;
			}
	}
	
function DoNav(theUrl)
{
	var URL = 'voucher_view_popup.php?'+theUrl;
	popUp(URL);
}
function popUp(URL) 
{
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=1,menubar=0,resizable=1,width=800,height=800,left = 383,top = -16');");
}
</script>
<script type="text/javascript" src="../common/js/check_balance.js"></script>
<script type="text/javascript" src="../common/receipt_check.js"></script>
<style type="text/css">
<!--
.style1 {font-size: 18px}
.style2 {font-size: 10px}
-->
</style>


<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  
  <tr>
    <td><div align="left">
      <form id="form1" name="form1" method="post" action="debit_note.php<?php if($_GET['action']=='edit') echo "?action=EDITING&v_no=".$_GET['v_no']."&v_type=".$_GET['v_type'];?>" onsubmit="return checking()">
     <table border="2" style="border:1px solid #C1DAD7; border-collapse:collapse"  align="center">
        <tr>
          <td>
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td><div align="right">Voucher Mode:</div></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><input type="radio" name="voucher_mode" id="voucher_mode_manual" class="radio" value="0" <?php if($old_voucher_mode==0){ ?>checked="checked"<?php } ?> onclick="voucher_no(this.value)"/> Manual</td>
            <td><input class="radio" type="radio" name="voucher_mode" id="voucher_mode_auto" value="1" <?php if($old_voucher_mode==1){ ?>checked="checked"<?php } ?> onclick="voucher_no(this.value)"/> Auto</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><div align="right">Voucher No:</div></td>
        <td><? 
$receipt_no=next_value('payment_no','payment');

if($v_d>10000)
$v_d=date("d-m-y",$v_d);


if($_GET['action']=='edit') {$v_no_show='value="'.$v_no.'" readonly'; } 
elseif($old_voucher_mode==1){$v_no_show='value="'.$receiptno.'" readonly'; } 
else $v_no_show='';
?>            
			  	<input name="receipt_no" type="text" id="receipt_no" size="10" <?=$v_no_show?> tabindex="1"/>
				
              <?php if($_GET['action']=='edit') echo "<font color='#FF0000'>EDITING</font>";?> </td>
      </tr>
      <tr>
        <td><div align="right">Voucher Date:</div></td>
<td><input name="date" value="<?=$v_d;?>" type="text" id="date" size="10" <?php if($_GET['action']=='edit') echo "readonly='readonly'";?> tabindex="2"/><?php if($_GET['action']=='edit') echo "<font color='#FF0000'>EDITING</font>";?></td>
      </tr>
      <tr>
        <td><div align="right">Paid to:</div></td>
        <td><input name="r_from" class="input1" type="text" id="r_from" value="" tabindex="3"/></td>
      </tr>
      <tr>
        <td><div align="right">Paid Mode:</div></td>
        <td><input type="text" name="c_id" id="c_id" tabindex="4" class="input1" onBlur="open_limit(this.value)" /></td>
      </tr>
      <tr>
        <td><div align="right">Bank:</div></td>
        <td><input name="bank" type="text" id="bank" value="" class="input1"  tabindex="5"/></td>
      </tr>
      <tr>
        <td><div align="right"><span>Cheque No</span></div></td>
        <td><input name="c_no" type="text" id="c_no" value="" tabindex="6"/></td>
      </tr>
      <tr>
        <td><div align="right"><span>Cheque</span> Date: </div></td>
        <td><input name="c_date" type="text" id="c_date" tabindex="7" value="<?php echo date("d-m-y",time());?>" size="12" maxlength="10" /></td>
      </tr>
    </table></td>
    <td align="right" valign="top"><div class="box2">
      <table  class="tabledesign" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <th>Voucher No </th>
                      <th>Amount</th>
                      <th colspan="3">Narration</th>
                      </tr>
					<? 
$sql2="select payment_no, cr_amt, narration,payment_date from  payment  where cr_amt>0 order by payment_no desc limit 5";
$data2=mysql_query($sql2);
if(mysql_num_rows($data2)>0){
while($dataa=mysql_fetch_row($data2))
{$dataa[2]=substr($dataa[2],0,20).'...';
					?>
                    <tr class="alt">
                      <td><?=$dataa[0]?></td>
                      <td><?=$dataa[1]?></td>
                      <td><?=$dataa[2]?></td>
					  
                      <td style="padding:1px;" onclick="DoNav('<?php echo 'v_type=payment&vdate='.date("Y-m-d",$dataa[3]).'&v_no='.$dataa[0].'&view=Show&in=payment' ?>');"><img src="../images/copy_hover.png" width="16" height="16" border="0"></td>
					  
                      <td style="padding:1px;" ><a href="voucher_print.php?v_type=payment&vo_no=<?php echo $dataa[0];?>" target="_blank"><img src="../images/print.png" width="16" height="16" border="0"></a></td>
                    </tr>
<? }}?>
                  </table>
    </div></td>
  </tr>
 </table>

		  </td>
        </tr>
        <tr>
          <td height="35">
          <table width="100%" border="1" align="center"  style="border-collapse:collapse; border:1px solid #C1DAD7;" cellpadding="2" cellspacing="2">
            <tr>
              <td align="center">A/C Head </td>
              <td align="center">Cur Bal </td>
              <td align="center">CC Code</td>
              <td align="center">Narration</td>
              <td align="center">Amount</td>
              <td width="7%" rowspan="2" align="center">
                <input name="add" type="button" id="add" value="ADD" tabindex="12" class="btn1" onclick="checkhead('accounts_ledger');" onblur="goto_tab();"/>              </td>
            </tr>
            <tr>
              <td align="center">
			  <input type="text" id="ledger_id" name="ledger_id" class="input1" onBlur = "getBalance('../../common/cur_bal.php', 'cur', this.value);" tabindex="8" />
              </td>
              <td align="center">
			  	<span id="cur">
			  		<input name="cur_bal" type="text" id="cur_bal" maxlength="100" readonly/>
			  	</span>
			  </td>
              <td align="center"><input name="cc_code" type="text" id="cc_code"  tabindex="9" /></td>
              <td align="center"><label>
                <input name="detail" type="text" id="detail"  tabindex="10" onfocus="getBalance('../../common/cur_bal.php', 'cur', document.getElementById('ledger_id').value);" class="input1"/>
              </label></td>
              <td align="center"><input name="amount" type="text" id="amount" tabindex="11"/></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td height="138" valign="top">
          <span id="tbl"></span></td>
        </tr>
        <tr>
          <td height="20">
            <table width="100%" border="0" align="right" cellpadding="2" cellspacing="2">
            <tr>
              <td align="right"><input name="Payment_varify" type="submit" id="Payment_varify" class="btn" value="Payment Verified" /></td>
              <td width="30%" align="right">
			  <span id="limit">
			 
              </span>
			  </td>
              <td width="29%" align="right">Total Amount:</td>
              <td width="22%"><input name="t_amount" type="text" id="t_amount" size="15" readonly/></td>
              </tr>
          </table></td>
        </tr>
      </table>
      <input name="count" id="count" type="hidden" value="" />
    </form>
  </div></td>
  </tr>
</table>
<?
$main_content=ob_get_contents();
ob_end_clean();
require_once "../../template/main_layout.php";
?>