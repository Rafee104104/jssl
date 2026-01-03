<?php

$master_user = find_a_field('user_activity_management', 'master_user', '1');

?>

<h1 style="background: #3498DB; width: 100%; color: white; text-align:center; font-size:18px; margin:0px; margin-bottom:1px; padding: 10px 0px;">Sales Module</h1>

<div class="menu_bg">



<? if($_SESSION['user']['id']==10001 || $_SESSION['user']['id']==10002 || $_SESSION['user']['id']==10004) {?>
<!--<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Admin Pannel</a></div>

<ul class="submenu">



<li>  <a href="../wh_transfer/select_unapproved_depot_transfer.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Transfer Re-Check</a></li>



</ul>-->

<? }?>


	  
<div class="silverheader"><a href="#"><i class="fas fa-cog" aria-hidden="true"></i> Configuration </a></div>

<ul class="submenu">

<li>   <a href="../setup/user_group.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Company Settings</a></li>

<li>   <a href="../setup/warehouse_info.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Warehouse Info</a></li>

<!--<li>   <a href="../setup/sub_warehouse_info.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Sub Warehouse Info</a></li>-->


<!--
<li>   <a href="../setup/cost_category.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Cost Category</a></li>

<li>   <a href="../setup/cost_center.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Cost Center</a></li>

<li>   <a href="../setup/account_ledger.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Expense Ledger</a></li>-->

</ul>



<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> User Management</a></div>

<ul class="submenu">

<li>   <a href="../setup/user_info.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
User Create</a></li>


</ul>



<? if($level==5||$level==6||$level==7){?>

<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Product Management</a></div>

<ul class="submenu">

<li> <a href="../item_info/item_group.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Product Group</a></li>

<li> <a href="../item_info/item_sub_group.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Product Category</a></li>

<li> <a href="../item_info/item_info.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Product Info</a></li>

<li> <a href="../item_info/item_formula.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Item Formula</a></li>

<li> <a href="../item_info/product_report.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Product Report</a></li>

<!--<li>   <a href="../ob/opening_balance_fg.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Opening Stock Entry</a></li>-->


</ul>



<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Vehicle Management</a></div>

<ul class="submenu">

<li> <a href="../vehicle/vehicle_type.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Vehicle Type</a></li>

<li> <a href="../vehicle/vehicle_info.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Vehicle Info</a></li>

<li> <a href="../vehicle/delivery_man.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Delivery Man</a></li>




</ul>

<? }?>


<!--<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Item Opening</a></div>

<ul class="submenu">

<li>   <a href="../ob/monthly_consumption.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Raw Material Opening</a></li>

<li>   <a href="../ob/opening_balance_fg.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Opening Balance(Finish Goods)</a></li>

<li>   <a href="../ob/monthly_consumption_fg.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Finish Goods Opening</a></li>

<li>   <a href="../ob/monthly_consumption_other.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Expense Item Opening</a></li>

<li>   <a href="../other_receive/opening_receive.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Lot Wise Item Opening</a></li>

<li>   <a href="../ob/opening_balance_adjustment.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Opening Balance (Minwal)</a></li>

<li>   <a href="../ob/opening_balance_adjustment_wojoud.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Opening Balance (Riyadh Wojoud)</a></li>

</ul>-->


<? if($level==5||$level==6||$level==7){?>

<!--<div class="silverheader"><a href="#"><i class="far fa-address-book" aria-hidden="true"></i> Supplier Management</a></div>

<ul class="submenu">
<li> <a href="../vendor/vendor_category.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Supplier Category</a></li>

<li> <a href="../vendor/vendor_info.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Supplier Info</a></li>




</ul>-->


<? }?>


<div class="silverheader"><a href="#"><i class="far fa-address-book" aria-hidden="true"></i> Basic Information</a></div>

<ul class="submenu">

<li>  <a href="../dealer/dealer_group.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Customer Group</a></li>
<li>  <a href="../dealer/dealer_info.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Customer Info</a></li>
<li>  <a href="../dealer/buyer_info.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Buyer Info</a></li>
<li>  <a href="../dealer/merchandizer_info.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Merchandiser Info</a></li>

<li>  <a href="../dealer/delivery_place.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Delivery Place</a></li>

<!--<li>  <a href="../dealer/destination_info.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Destination Info</a></li>-->

<li>  <a href="../dealer/marketing_team.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Marketing Team</a></li>

<li>  <a href="../dealer/marketing_person.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Marketing Person</a></li>

<!--<li>  <a href="../dealer/opening_balance.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Opening Balance</a></li>-->



</ul>



<div class="silverheader"><a href="#"><i class="far fa-address-book" aria-hidden="true"></i> Raw Input Setup</a></div>

<ul class="submenu">

<li>  <a href="../raw_input/paper_combination.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Paper Combination</a></li>

<li>  <a href="../raw_input/additional_information.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Additional Info</a></li>

<li>  <a href="../raw_input/decimal_numbers.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Decimal Numbers</a></li>

<li>  <a href="../raw_input/pending_approval.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 


<?  
	$paper_comb_count = find_a_field('paper_combination','count(id)','approval="No"');
	$addi_info = find_a_field('additional_information','count(id)','approval="No"');
	$num_decimal = find_a_field('decimal_numbers','count(id)','approval="No"');
	
	$total_pending = ($paper_comb_count+$addi_info+$num_decimal);
?>

Pending Approval 

<? if($total_pending>0) {?><span style="color:#FF0000; font-weight:700;">(<?=$total_pending;?>)</span><? }?>
</a></li>


</ul>


<!--
<div class="silverheader"><a href="#"><i class="far fa-address-book" aria-hidden="true"></i> Raw Input Sheet</a></div>

<ul class="submenu">

<li>  <a href="../raw_input/raw_input_sheet.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Raw Input Sheet</a></li>

<li>  <a href="../raw_input/raw_input_data_report.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Raw Input Data Report</a></li>

</ul>-->






<? if($level==5||$level==6||$level==7){?>

<!--<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Purchase Order</a></div>

<ul class="submenu">

<li> <a href="../pof/po_create.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> New Purchase</a></li>

<li> <a href="../pof/select_unapproved_po_fg.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Unapprove Purchase</a></li>

<li> <a href="../pof/po_status.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Approved Purchase</a></li>

<li> <a href="../pof/select_pr_for_bill_create.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Purchase Bill Create</a></li>


</ul>-->


<? }?>




	  
<!--<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Product Requisition  </a></div>

<ul class="submenu">

<li>   <a href="../fr/select_store.php?mhafuz=2"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
New Requisition</a></li>

<li>   <a href="../fr/select_unfinished_mr.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Unfinished Requisition</a></li>

<li>  <a href="../fr/mr_precheck_list.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Unapproved Requisition</a></li>

<li> <a href="../fr/mr_status.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Approved Requisition</a></li>

<li><a href="../fr/select_despatch_no.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Despatch Re Order Entry</a></li>


</ul>-->



<!--
<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Warehouse Transfer</a></div>

<ul class="submenu">

<li>  <a href="../wh_fr/pending_mr_status.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Pending Requisition</a></li>

<li>  <a href="../wh_transfer/select_depot.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Product Transfer</a></li>

<li><a href="../wh_transfer/select_unfinished_depot_transfer.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Unfinished Entry</a></li>

<li><a href="../wh_transfer/wh_transfer_status.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Product Transfer Status</a></li>

<li>  <a href="../wh_transfer/select_unfinished_depot_transfer.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Unfinished Warehouse Transfer</a></li>



<li>  <a href="../wh_transfer/fg_chalan_report.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Product Send Status</a></li>

<li>  <a href="../wh_transfer/fg_receive_report.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Product Receive Status</a></li>


</ul>-->













		
					  
					  
<?php /*?><? if($level==5){?>

<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Super Admin</a></div>

<ul class="submenu">

<li>   <a href="../edit_wo/select_work_order.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Edit WO</a></li>

</ul>

 <? }?><?php */?>

<!--   <div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Black Tea Transection</a></div>

<ul class="submenu">

<li>   <a href="../raw_tea/black_tea_transection.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Black Tea Transection</a></li>

<li>   <a href="../raw_tea/black_tea_transection_status.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Black Tea Transection Status</a></li>

<li>   <a href="../raw_tea/stock_position_status.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Stock Position Status</a></li>

</ul>

-->

<!--<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Create Blend Sheet</a></div>

<ul class="submenu">

<li>   <a href="../blend_sheet/black_tea_transection.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Create New Blend Sheet</a></li>

<li>  <a href="../blend_sheet/black_tea_transection_status.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Black Tea Transection Status</a></li>

<li>   <a href="../blend_sheet/stock_position_status.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Stock Position Status</a></li>

</ul>

-->




<?php /*?>
<? if($level==5){?>
<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Dealer Info  </a></div>

<ul class="submenu">

<li>  <a href="../dealer/dealer_info.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Dealer Info</a></li>


<li>  <a href="../cdo/item_price.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Customer Price </a></li>
<li>  <a href="../ido/item_price_report.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Price Report</a></li>

<li>  <a href="../dealer/dealer_report.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Dealer Report</a></li>

</ul>

<? }?><?php */?>



<!--<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Dealer Area Setup  </a></div>

<ul class="submenu">

<li>  <a href="../dealer/setup_Region.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Setup Region</a></li>

<li>  <a href="../dealer/setup_Zone.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Setup Zone</a></li>

<li>  <a href="../dealer/setup_Territory.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Setup Area</a></li>
<li>  <a href="../dealer/area_report.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Area Setup Report</a></li>



</ul>-->







<? if($level==5||$level==23||$level==25){?>

<!--<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Delivery Order  </a></div>

<ul class="submenu">

<li>  <a href="../cdo/select_dealer_do.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>New Demand Order</a></li>
<li>  <a href="../cdo/pos/index.php" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i>POS Order</a></li>

<li>  <a href="../cdo/select_unfinished_do.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Unfinished Demand Order</a></li>

<li>  <a href="../cdo/item_price.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Customer Price Setup</a></li>
<li>  <a href="../ido/item_price_report.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Price Report</a></li>

<li>  <a href="../cdo/select_uncheck_do.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Unapproved DO List</a></li>



<li>  <a href="../ido/select_checked_do.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Approved Order</a></li>

<li>   <a href="../pr_packing_mat/purchase_receive_status_gr.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>PO Receive Status(GR Wise)</a></li>

<li>  <a href="../pr_packing_mat/purchase_receive_status_party.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>PO Receive Status(Party Wise)</a></li>

</ul>--><? }?>




<!--<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Work Order</a></div>

<ul class="submenu">

<li><a href="../wo/select_cbm_no_wo.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
New Work Order</a></li>



<li><a href="../wo/select_unfinished_do.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Unfinished WO</a></li>

<li><a href="../wo/select_check_invoice.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Work Order Status</a></li>

<li><a href="../wo/proforma_invoice_status.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
 Proforma Invoice Status</a></li>


</ul>-->







<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Work Order</a></div>

<ul class="submenu">


<li><a href="../wo/do.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
New Work Order</a></li>

<li><a href="../wo/select_unfinished_do.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Unfinished WO</a></li>

<li><a href="../wo/select_draft_wo.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 


<?  
	$wo_draft = find_a_field('sale_do_master','count(do_no)','status="MANUAL"');

?>


Draft Work Order 

<? if($wo_draft>0) {?><span style="color:#FF0000; font-weight:700;">(<?=$wo_draft;?>)</span><? }?>
</a></li>



<!--<li><a href="../wo/proforma_invoice_status.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
 Proforma Invoice Status</a></li>-->


</ul>





<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> WO Approval</a></div>

<ul class="submenu">


<li><a href="../wo/select_unapproved_wo.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 

<? $wo_unapproved = find_a_field('sale_do_master','count(do_no)','status="UNCHECKED"');?>
Unapproved WO
<? if($wo_unapproved>0) {?><span style="color:#FF0000; font-weight:700;">(<?=$wo_unapproved;?>)</span><? }?>
</a></li>

<li><a href="../wo/select_check_invoice.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 



Work Order Status


</a></li>

<!--<li><a href="../wo/proforma_invoice_status.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
 Proforma Invoice Status</a></li>-->


</ul>



<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> WO Hold Request</a></div>

<ul class="submenu">

<li><a href="../wo/wo_hold_request.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
WO Hold Request</a></li>

<li><a href="../wo/wo_hold_unapproved.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
<? $hold_request = find_a_field('sale_do_master','count(do_no)','status="HOLD REQUEST"');?>
WO Hold Approval
<? if($hold_request>0) {?><span style="color:#FF0000; font-weight:700;">(<?=$hold_request;?>)</span><? }?>
</a></li>

<li><a href="../wo/wo_unhold_request.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
<? $wo_hold = find_a_field('sale_do_master','count(do_no)','status="HOLD"');?>
WO Unhole Request
<? if($wo_hold>0) {?><span style="color:#FF0000; font-weight:700;">(<?=$wo_hold;?>)</span><? }?>
</a></li>


</ul>




<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> WO Cancel Request</a></div>

<ul class="submenu">

<li><a href="../wo/wo_cancel_request.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
WO Cancel Request</a></li>

<li><a href="../wo/wo_cancel_unapproved.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 

<? $cancel_request = find_a_field('sale_do_master','count(do_no)','status="CANCEL REQUEST"');?>
WO Cancel Approval
<? if($cancel_request>0) {?><span style="color:#FF0000; font-weight:700;">(<?=$cancel_request;?>)</span><? }?>
</a></li>


</ul>




<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> WO Edit Request</a></div>

<ul class="submenu">

<li><a href="../wo/select_do_for_edit_request.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
WO Edit Request</a></li>


</ul>



<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Pending Request</a></div>

<ul class="submenu">

<li><a href="../wo/select_do_for_accept_request.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
WO Pending Request</a></li>


</ul>


<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> WO Edit</a></div>

<ul class="submenu">

<li><a href="../wo/select_do_for_edit_wo.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
WO Edit</a></li>


</ul>


<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Bundle Card</a></div>

<ul class="submenu">

<li><a href="../wo/select_upcoming_wo.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Pending WO</a></li>

<li><a href="../wo/bundle_card_status.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Bundle Card Status</a></li>

</ul>




<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Delivery Challan</a></div>

<ul class="submenu">

<li><a href="../wo/select_wo_for_challan.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Pending WO</a></li>

<li><a href="../wo/delivery_challan_status.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Delivery Challan Status</a></li>

</ul>



<!--
<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Travel Card</a></div>

<ul class="submenu">

<li><a href="../wo/select_upcoming_wo.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Pending WO</a></li>

<li><a href="../wo/travel_card_status.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Travel Card Status</a></li>


</ul>



<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Bundle Card</a></div>

<ul class="submenu">

<li><a href="../wo/select_upcoming_tc.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Pending Travel Card</a></li>

<li><a href="../wo/bundle_card_status.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Bundle Card Status</a></li>


</ul>



<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Delivery Challan</a></div>

<ul class="submenu">

<li><a href="../wo/select_upcoming_wo_for_challan.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Pending WO</a></li>

<li><a href="../wo/delivery_challan_status.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Delivery Challan Status</a></li>


</ul>-->






<!--

<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Cash Collection</a></div>

<ul class="submenu">

<li><a href="../cash_collection/select_warehouse.php?concern=<?=$_SESSION['user']['group']?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
New Collection Entry</a></li>

<li><a href="../cash_collection/collection_status.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Collection Status</a></li>


</ul>


<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Expense Voucher</a></div>

<ul class="submenu">

<li><a href="../cash_expense/select_warehouse.php?concern=<?=$_SESSION['user']['group']?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
New Voucher Entry</a></li>

<li><a href="../cash_expense/collection_status.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Expense Status</a></li>


</ul>-->


<!--
<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Advance Report</a></div>

<ul class="submenu">

<li><a href="../report/trial_balance_detail_new.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Customer Transaction</a></li>

<li><a href="../direct_sales/work_chalan_report.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Sales Report</a></li>

<li><a href="../report/warehouse_stock_report.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Inventory Report</a></li>


<li><a href="../comparison_report/comparison_report.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
Sales Comparison Report</a></li>




</ul>-->




<?php /*?>
<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Sales Return Process</a></div>

<ul class="submenu">

<!--<li><a href="../direct_sales/select_dealer_do.php?concern=<?=$_SESSION['user']['group']?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
New Sales Invoice</a></li>-->

<li><a href="../sales_return/select_dealer_return_adjustment.php?concern=<?=$_SESSION['user']['group']?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> 
New Sales Return</a></li>

<li><a href="../sales_return/sales_return_status.php?concern=<?=$_SESSION['user']['group']?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i>
 Sales Return Status</a></li>




</ul><?php */?>



<?php /*?><? if($level==5){?>

<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> POS Order </a></div>

<ul class="submenu">

<li>  <a href="../pos/do_minwal.php" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i>POS Order</a></li>

<li> <a href="../pos/pos_status.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Sales Status</a></li>

</ul>

<? }?>
<?php */?>

 <?php /*?><? if($level==5 || $level==8|| $level==10|| $level==14|| $level==333333|| $level==111111){?>


	<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Pending Purchase Order</a></div>



    <ul class="submenu">



      <li>   <a href="../pof/po_status.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Pending Purchase Order List</a></li>

      		
    </ul><? }?><?php */?>



<?php /*?><? if($level==5||$level==23||$level==25){?>

<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Demand Order </a></div>

<ul class="submenu">

<li>  <a href="../wojoud_do/select_dealer_do.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> New Demand Order</a></li>

<li>  <a href="../wojoud_do/select_unfinished_do.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Unfinished Demand Order</a></li>

<!--<li>  <a href="../wojoud_do/item_price.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Customer Price Setup</a></li>
<li>  <a href="../ido/item_price_report.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Price Report</a></li>-->

<!--<li>  <a href="../wojoud_do/select_uncheck_do.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Unapproved DO List</a></li>



<li>  <a href="../wojoud_do/select_checked_do.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Approved Order</a></li>-->

<!--<li>   <a href="../pr_packing_mat/purchase_receive_status_gr.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>PO Receive Status(GR Wise)</a></li>

<li>  <a href="../pr_packing_mat/purchase_receive_status_party.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>PO Receive Status(Party Wise)</a></li>-->

</ul><? }?><?php */?>
			
<!--
<div class="silverheader"> <a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Demand Order Approval</a></div>

<ul class="submenu">

<li> <a href="../wojoud_do/select_uncheck_do_approved.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Unapproved Demand Order</a></li>

</ul>
-->
<? if($level==5){?>

<!--<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Promotional Offer</a></div>

<ul class="submenu">

<li>  <a href="../do/gift_offer.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Gift Offer</a></li>

<li>  <a href="../ido/gift_offer.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Gift Offer(SuperShop)</a></li>		

<li>  <a href="../cdo/gift_offer.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Gift Offer(Corporate)</a></li>

<li>  <a href="../do/gift_offer_report.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Gift Offer Report</a></li>	

</ul>-->

<? }?>
					  
				  <? if($level==5||$level==21){?> 

<!--<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Staff Sales(SS) Order</a></div>

<ul class="submenu">

<li>  <a href="../ss/select_dealer_do.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>New SS Order</a></li>

<li>  <a href="../ss/select_unfinished_do.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Unfinished SS Order</a></li>		
<li>  <a href="../ss/select_uncheck_do.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Unapproved SS Order</a></li>

<li>  <a href="../ss/select_checked_do.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Approved SS Order</a></li>	
</ul>-->

<? }?>
					  
					  					  
					  <? if($level==5||$level==21 ||$level==30){?>

<!--<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Other Sales(OS)Order</a></div>

<ul class="submenu">

<li><a href="../os/select_dealer_do.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>New OS Order</a></li>

<li> <a href="../os/select_unfinished_do.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Unfinished OS Order</a></li>		
<li><a href="../os/select_uncheck_do.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Unapproved OS Order</a></li>

<li> <a href="../os/select_checked_do.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Approved OS Order</a></li>	
</ul>-->

 <? }?>
					 
					  
 <? if($level==5||$level==11){?>					  
					  
<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Advanced Reports</a></div>

<ul class="submenu">

<li><a href="../report/work_order_report.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Work Order Reports</a></li>

<!--<li><a href="../report/work_chalan_report.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Delivery Chalan Reports</a></li>-->
<!--<li><a href="../report/dealer_report.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Dealer Info</a></li>-->




</ul>

	<? }?>  
					
<!--<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Management Report</a></div>

<ul class="submenu">

<li> <a href="../report/comparison_report.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Comparison Report</a></li>

</ul>

<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Management Report 2</a></div>

<ul class="submenu">

<li><a href="../report/advance_report_do.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Management Report 2</a></li>

</ul>
	-->				  
					 

<?php /*?> <? if($level==5||$level==11){?>

<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Product Management</a></div>

<ul class="submenu">

<li> <a href="../product/product_report.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Product Advance Reports</a></li>


</ul>
<? }?>  <?php */?>

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



