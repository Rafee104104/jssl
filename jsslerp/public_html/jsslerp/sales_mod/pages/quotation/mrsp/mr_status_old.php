<?php
require_once "../../../assets/template/layout.top.php";

$title='Sales Quotation Status';

do_calander('#fdate');
do_calander('#tdate');

$table = 'sale_requisition_master';
$unique = 'do_no';
$status = 'CHECKED';
$target_url = '../mrsp/mr_print_view.php';

?>
<script language="javascript">
function custom(theUrl)
{
	window.open('<?=$target_url?>?<?=$unique?>='+theUrl);
}
</script>
<div class="form-container_large">
<form action="" method="post" name="codz" id="codz">
<table width="80%" border="0" align="center">
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#FF9966"><strong>Date:</strong></td>
    <td width="1" bgcolor="#FF9966"><strong>
      <input type="text" name="fdate" id="fdate" style="width:120px;" value="<?=$_POST['fdate']?>" />
    </strong></td>
    <td align="center" bgcolor="#FF9966"><strong> -to- </strong></td>
    <td width="1" bgcolor="#FF9966"><strong>
      <input type="text" name="tdate" id="tdate" style="width:120px;" value="<?=$_POST['tdate']?>" />
    </strong></td>
    <td rowspan="2" bgcolor="#FF9966"><strong>
      <input type="submit" name="submitit" id="submitit" value="VIEW DETAIL" style="width:120px; font-weight:bold; font-size:12px; height:30px; color:#090"/>
    </strong></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#FF9966"><strong><?=$title?>: </strong></td>
    <td colspan="3" bgcolor="#FF9966"><strong>
<select name="status" id="status" style="width:200px;">
<option><?=$_POST['status']?></option>
<option>UNCHECKED</option>
<option>CHECKED</option>
<option>ALL</option>
</select>
    </strong></td>
    </tr>
</table>

</form>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><div class="tabledesign2">
<? 
if($_POST['status']!=''&&$_POST['status']!='ALL')
$con .= 'and a.status="'.$_POST['status'].'"';

if($_POST['fdate']!=''&&$_POST['tdate']!='')
$con .= 'and a.do_date between "'.$_POST['fdate'].'" and "'.$_POST['tdate'].'"';


 $res='select  	a.do_no,concat("Q-000",a.do_no) as Quotation_no, DATE_FORMAT(a.do_date, "%d-%m-%Y") as Qutation_date, a.status,concat(d.dealer_code,"-",d.dealer_name_e) as dealer_name,  a.entry_at from sale_requisition_master a,dealer_info d where 
  a.dealer_code=d.dealer_code '.$con.' and a.status in ("CHECKED", "COMPLETED") group by a.do_no order by a.do_no desc';
echo link_report($res,'mr_print_view.php');



?>
</div></td>
</tr>
</table>

<?
require_once "../../../assets/template/layout.bottom.php";
?>