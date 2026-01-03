<?php

$master_user = find_a_field('user_activity_management', 'master_user', '1');

?>

<h1 style="background: #3498DB; width: 100%; color: white; text-align:center; font-size:18px; margin:0px; margin-bottom:1px; padding: 10px 0px;">Inventory</h1>

<div class="menu_bg">




	  
<div class="silverheader"><a href="#"><i class="fas fa-cog" aria-hidden="true"></i> Configuration </a></div>

<ul class="submenu">
<!--
<li>   <a href="../setup/user_group.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Company Settings</a></li>

<li>   <a href="../setup/warehouse_info.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Warehouse Info</a></li>

<li>   <a href="../setup/sub_warehouse_info.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Sub Warehouse Info</a></li>-->

<li>   <a href="../setup/user_info.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
User Manage</a></li>


<li>   <a href="../setup/scaleman.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
 Scaleman Info</a></li>
<!--
<li>   <a href="../setup/cost_category.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Cost Category</a></li>

<li>   <a href="../setup/cost_center.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Cost Center</a></li>


<li>   <a href="../setup/machine_type.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
 Machine Type</a></li>

<li>   <a href="../setup/machine_info.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
 Machine Info</a></li>
 

 <li>   <a href="../setup/production_bonus_setup.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
 Production Bonus</a></li>
 
 
 <li>   <a href="../setup/machine_work.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
 Machine Work Type</a></li>-->
 
  <li>   <a href="../setup/work_order_report.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
 Machine Info Report</a></li>
 

</ul>




	  
<!--<div class="silverheader"><a href="#"><i class="fas fa-cog" aria-hidden="true"></i> Vehicle Registration</a></div>

<ul class="submenu">

<li>   <a href="../vehicle/vehicle_type.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
 Vehicle Type</a></li>

<li>   <a href="../vehicle/vehicle_info.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
 Vehicle Registration</a></li>


</ul>-->


<? if($level==5||$level==6||$level==1){?>

<!--<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Product Management</a></div>

<ul class="submenu">

<li> <a href="../item_info/item_group.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Product Group</a></li>

<li> <a href="../item_info/item_sub_group.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Product Category</a></li>

<li> <a href="../item_info/item_info.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Product Info</a></li>

<li> <a href="../item_info/product_report.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Product Report</a></li>

<li>   <a href="../ob/opening_balance_fg.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Opening Stock Entry</a></li>


</ul>-->


<? }?>


<? if($level==5||$level==6||$level==1){?>

<!--<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Log Sheet Manage</a></div>

<ul class="submenu">

<li> <a href="../log_sheet/log_sheet_entry_fn.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Log Sheet Entry</a></li>

<li> <a href="../log_sheet/log_sheet_status_fn.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Log Sheet Status</a></li>

</ul>-->


<? }?>


<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i>  Production Receive</a></div>






<ul class="submenu">

<? if($_SESSION['user']['id']==10002){?>
<li> <a href="../production_receive_fn/select_unfinished_pr_for_check.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Production Receive Check</a></li>



<li> <a href="../production_receive_fn/select_unfinished_pr_dynamics.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Production Receive</a></li>
<? }?>





<li> <a href="../production_receive_fn/select_unfinished_pr.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Production Receive</a></li>
<li> <a href="../production_receive_fn/production_receive_status.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Production Receive Report</a></li>



</ul>



<?php /*?><? if($_SESSION['user']['id']==10002){?><? }?><?php */?>

<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i>  PR (Manual Entry)</a></div>

<ul class="submenu">

<li> <a href="../production_receive_manual/select_unfinished_pr.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Production Receive</a></li>

</ul>







<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i>   Production Re-Check</a></div>

<ul class="submenu">

<li> <a href="../pr_edit/pr_barcode_update.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>  Production Re-Check</a></li>

</ul>




<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i>   Warehouse Transfer</a></div>

<ul class="submenu">

<li> <a href="../wh_transfer/depot_transfer_entry.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>  New Transfer Entry</a></li>


<li> <a href="../wh_transfer/select_unfinished_depot_transfer.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>  Unfinished Entry </a></li>
<li> <a href="../wh_transfer/wh_transfer_status.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Product Transfer Status</a></li>

</ul>





<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Sales Order </a></div>

<ul class="submenu">


<li><a href="../sales_order/do.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
New Sales Order</a></li>

<!--<li><a href="../sales_order/select_unfinished_do.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Unfinished SO</a></li>-->



<!--<li><a href="../sales_order/select_unapproved_so.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Unapproved SO</a></li>
-->

<li><a href="../sales_order/select_check_invoice.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Sales Order Status</a></li>


</ul>




<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Pending Sales Order</a></div>

<ul class="submenu">



<li><a href="../sales_order/select_upcoming_wo.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Pending Sales Order</a></li>



</ul>


<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Advanced Reports</a></div>

<ul class="submenu">



<li><a href="../report/advanced_reports.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Advanced Reports</a></li>



</ul>










<div class="silverheader"><a href="#" ><i class="fas fa-sign-in-alt"></i> Exit Program</a></div>

<ul class="submenu">

<li>

<a href="../main/logout.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Log Out</a>

</li>

</ul>


</div>
<div class="copyright">

<img class="oe_logo_img" alt="SajeebERP: Open Source Business" src="../../../logo/logo.png" height="31px;" >

</div>



