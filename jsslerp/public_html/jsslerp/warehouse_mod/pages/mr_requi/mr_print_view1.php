<?php
session_start();


require_once "../../../assets/template/layout.top.php";



$req_no 		= $_REQUEST['req_no'];

$sql="select * from requisition_master_stationary where  req_no='$req_no'";
$data=mysql_query($sql);
$all=mysql_fetch_object($data);

$emp = find_all_field('personnel_basic_info','PBI_NAME','PBI_ID='.$all->entry_by);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Requsition Copy</title>
<link href="../../../assets/css/invoice.css" type="text/css" rel="stylesheet"/>
	<?php include("../../../assets/css/theme_responsib_new_table_report.php");?>
<script type="text/javascript">
function hide()
{
    document.getElementById("pr").style.display="none";
}
</script>
    <style type="text/css">
        #pr input[type="button"] {
            width: 70px;
            height: 25px;
            background-color: #6cff36;
            color: #333;
            font-weight: bolder;
            border-radius: 5px;
            border: 1px solid #333;
            cursor: pointer;
        }
    </style>
</head>
<body>



<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
      <td>
	  
	  <div class="header">
		<table class="table1">
		<tr>
		<td class="logo">
			<img src="../../../logo/1.png" class="logo-img"/>
		</td>
		
		<td class="titel">
				<h2 class="text-titel"> <?=$group->group_name?> </h2>			
						</td>
		
		
		<td class="Qrl_code">
				<?php /*?>	<?='<img class="barcode Qrl_code_barcode" alt="'.$barcodeText.'" src="barcode.php?text='.$barcodeText.'&codetype='.$barcodeType.'&orientation='.$barcodeDisplay.'&size='.$barcodeSize.'&print='.$printText.'"/>' ?>
			<p class="qrl-text"><?=$all->req_no;?></p><?php */?>
		</td>
		
		</tr>
		 
		</table>
	</div>
	
 
      </td>
  </tr>
  <tr>
    
	<td>	</td>
  </tr>
  <tr>
    <td><div class="line"></div></td>
  </tr>
<tr>
        <td><div class="header2">
                <div class="header2_left">
                    <p><span style="font-weight:bold;">Purchase Requisition</span><br/><strong>Date:</strong> <?php echo $all->req_date;?><br />
                        <strong>Requisition  No :</strong>  <?php echo $all->req_no;?><br />
                        <strong>Requisition For :</strong>  <?php echo $all->req_for;?><br />
                    </p>
                </div>
                <div class="header2_right">
                    <p>
                        <strong>Note : </strong> <?php echo $all->req_note;?><br />
                        <strong>Need Before :</strong> <?php echo $all->need_by;?><br />
                    </p>
                </div>
            </div></td>
    </tr>  <tr>
    <td>
	<div id="pr">
<div align="left">
<form action="" method="get">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="1"><input name="button" type="button" onclick="hide();window.print();" value="Print" /></td>
	
	
  </tr>
</table>

</form>
</div>
</div>
<table width="100%" style="text-align:center" class="tabledesign" border="1" bordercolor="#000000" cellspacing="0" cellpadding="0">
       <tr>
        <td width="6%" rowspan="2"><strong>SL.</strong></td>
        <td width="27%" rowspan="2"><strong>Particulars</strong></td>
		<td width="11%" rowspan="2"><strong>Quantity</strong></td>
        <td width="22%" rowspan="2"><strong>Last Receive Date </strong></td>
        <td colspan="2"><strong>Office Use Only </strong></td>
        </tr>
       <tr>
         <td width="20%">Rate Approx </td>
         <td width="14%">Remarks</td>
       </tr>
	  <?php
$final_amt=(int)$data1[0];
$pi=0;
$total=0;
$sql2="select * from requisition_order_stationary where  req_no='$req_no'";
$data2=mysql_query($sql2);
//echo $sql2;
while($info=mysql_fetch_object($data2)){ 
$pi++;
$amount=$info->qty*$info->rate;
$total=$total+($info->qty*$info->rate);
$sl=$pi;
$item=find_all_field('item_info','concat(item_name," : ",	item_description)','item_id='.$info->item_id);
$qty=$info->qty;
$qoh=$info->qoh;
$last_p_date=$info->last_p_date;
$last_p_qty=$info->last_p_qty;
$item_for=$info->item_for;
?>
      <tr>
        <td valign="top"><?=$sl?></td>
        <td align="left" valign="top">Code:<?=$info->item_id?><br><?=$item->item_name.' : '.$item->item_description?></td>
        <td valign="top"><?=$qty.' '.$item->unit_name?></td>
		<td valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
        <td valign="top"><?=$info->item_for?></td>
        </tr>
<? }?>
    </table></td>
  </tr>
  <tr><td>&nbsp;</td></tr>
  <tr><td>&nbsp;</td></tr>
  <tr><td>&nbsp;</td></tr>
  <tr><td>&nbsp;</td></tr>
  <tr><td>&nbsp;</td></tr>
  <tr>
    <td align="center">
	<div class="footer1">
            <table width="551" border="0">

                <tr>
                    <td colspan="2" align="right">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2" align="right">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2" align="right">&nbsp;</td>
                </tr>


                <tr>
                    <td align="center"><?=find_a_field('user_activity_management','fname','user_id='.$all->entry_by)?></td>
                    <td align="center"><?=find_a_field('user_activity_management','fname','user_id='.$all->dept_head_id)?></td>
                    <td align="center"><?=find_a_field('user_activity_management','fname','user_id='.$all->checked_by)?></td>
                    <td align="center"><?=find_a_field('user_activity_management','fname','user_id='.$all->approve_by)?></td>
		            <td align="center">&nbsp;</td>
		            <td align="center">&nbsp;</td>
                </tr>

                <tr>
  					<td align="center">----------------</td>
  					<td align="center">----------------</td>
  					<td align="center">----------------</td>
  					<td align="center">----------------</td>
  					<td align="center">----------------</td>
  					<td align="center">----------------</td>
                </tr>
                <tr>
			     	<td align="center"><strong>Prepared By</strong></td>
                    <td align="center"><strong>Manager</strong></td>
                    <td align="center"><strong>GM</strong></td>
                    <td align="center"><strong>Accounts</strong></td>
                    <td align="center"><strong>CFO</strong></td>
                    <td align="center"><strong>MD/DMD</strong></td>
                    <!--<td align="center"><strong>Checked By:</strong></td>-->
                </tr>

            </table>
			

        </div></td>
  </tr>
</table>
</body>
</html>
