<?php
session_start();

ob_start();

require_once "../../../assets/template/layout.top.php";
$title='Select Unchecked Consumption';




?>
<script language="javascript">
window.onload = function() {
  document.getElementById("dealer").focus();
}
</script>
<div class="form-container_large">
<form action="packing_issue2.php" method="post" name="codz" id="codz">
<table width="70%" border="0" align="center">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#FF9966"><strong>Unfinished Consumption  List: </strong></td>
    <td bgcolor="#FF9966"><strong>

     <select name="old_oi_no" id="old_oi_no" required>
	 <option></option>
	 	<? foreign_relation('warehouse_other_issue','oi_no','oi_no',$oi_no,' status = "MANUAL" and issue_type = "Consumption" and warehouse_id='.$_SESSION['user']['depot'].' ');?>
	  </select>
    </strong></td>
    <td bgcolor="#FF9966"><strong>
      <input type="submit" name="submitit" id="submitit" value="Complete " style="width:170px; font-weight:bold; font-size:12px; height:30px; color:#090"/>
    </strong></td>
  </tr>
</table>

</form>
</div>

<?
$main_content=ob_get_contents();
ob_end_clean();
include ("../../template/main_layout.php");
?>