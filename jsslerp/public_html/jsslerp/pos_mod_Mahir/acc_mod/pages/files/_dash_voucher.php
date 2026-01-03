<?php
require_once "../../../assets/template/layout.top.php";
$title='Voucher Dashboard';
$proj_id=$_SESSION['proj_id'];
$now=time();
?>
<link rel="stylesheet" type="text/css" href="../css/dash_board.css"/>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>     
	 <div class="dashboard">
		    <!-- Dashboard icons -->
            <div class="grid_7">
            	<a href="../pages/credit_note.php" class="dashboard-module"><img src="../dash_images/12.gif" width="40" height="40" /><span>Credit Voucher</span></a>
                
                <a href="../pages/debit_note.php" class="dashboard-module"><img src="../dash_images/12.gif" width="40" height="40" /><span>Debit Voucher</span></a>
                
                <a href="../pages/journal_note_new.php" class="dashboard-module"><img src="../dash_images/12.gif" width="40" height="40" /><span>Journal Voucher</span></a>
                
                <a href="../pages/coutra_note_new.php" class="dashboard-module"><img src="../dash_images/12.gif" width="40" height="40" /><span>Contra Voucher</span></a>
				 <a href="../pages/voucher_view.php" class="dashboard-module"><img src="../dash_images/12.gif" width="40" height="40" /><span>Voucher View</span></a>
				 
				
                <div style="clear: both"></div>
</div> <!-- End .grid_7 -->
		</div></td></tr>
</table>
<?
$main_content=ob_get_contents();
ob_end_clean();
require_once "../../template/main_layout.php";
?>
