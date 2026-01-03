<?php
require_once "../../../assets/template/layout.top.php";
$title='Inventory Dashboard';
$proj_id=$_SESSION['proj_id'];
$now=time();
?>
<link rel="stylesheet" type="text/css" href="../css/dash_board.css"/>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>    <div class="dashboard">
		    <!-- Dashboard icons -->
            <div class="grid_7">
            	<a href="../pages/customer_info.php" class="dashboard-module"><img src="../dash_images/4.gif" width="40" height="40" /><span>Sundry Debtors</span></a>
                
                <a href="../pages/vendor_info.php" class="dashboard-module"><img src="../dash_images/4.gif" width="40" height="40" /><span>Sundry Creditors</span></a>
                
                <a href="../pages/item_group.php" class="dashboard-module"><img src="../dash_images/4.gif" width="40" height="40" /><span>Item Group</span></a>
                
                <a href="../pages/item_info.php" class="dashboard-module"><img src="../dash_images/4.gif" width="40" height="40" /><span>Item Info</span></a>
                
                <a href="../pages/purchase_invoice.php" class="dashboard-module"><img src="../dash_images/4.gif" width="40" height="40" /><span>Purchase Invoice </span></a>
                
                <a href="../pages/sales_invoice.php" class="dashboard-module"><img src="../dash_images/4.gif" width="40" height="40" /><span>Sales Invoice</span></a>
                
                <a href="../pages/issue_invoice.php" class="dashboard-module"><img src="../dash_images/4.gif" width="40" height="40" /><span>Issue Register</span></a>
				
				<a href="../pages/return_invoice.php" class="dashboard-module"><img src="../dash_images/4.gif" width="40" height="40" /><span>Return Invoice</span></a>

				<a href="../pages/invoice_view.php" class="dashboard-module"><img src="../dash_images/4.gif" width="40" height="40" /><span>Invoice View</span></a>
				
				<a href="../pages/inventory_report.php" class="dashboard-module"><img src="../dash_images/4.gif" width="40" height="40" /><span>Inventory Report</span></a>
				
				<a href="../pages/issue_report.php" class="dashboard-module"><img src="../dash_images/4.gif" width="40" height="40" /><span>Issue Report</span></a>
				
				<a href="../pages/return_report.php" class="dashboard-module"><img src="../dash_images/4.gif" width="40" height="40" /><span>Return Report</span></a>
				
				<a href="../pages/itemwise_issue_report.php" class="dashboard-module"><img src="../dash_images/4.gif" width="40" height="40" /><span>Item Wise Issue Report</span></a>
                
                <a href="../pages/itemwise_return_report.php" class="dashboard-module"><img src="../dash_images/4.gif" width="40" height="40" /><span>Item Wise Return Report</span></a>
				
				<a href="../pages/item_requisition_report.php" class="dashboard-module"><img src="../dash_images/4.gif" width="40" height="40" /><span>Item Requisition Report</span></a>

				<a href="../pages/stock_position_report.php" class="dashboard-module"><img src="../dash_images/4.gif" width="40" height="40" /><span>Stock Position Report</span></a>

				<div style="clear: both"></div>
</div> <!-- End .grid_7 -->
		</div>
		</td></tr>
</table>
<?
$main_content=ob_get_contents();
ob_end_clean();
require_once "../../template/main_layout.php";
?>
