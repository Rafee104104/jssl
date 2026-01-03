<?php

//$master_user = find_a_field('user_activity_management', 'master_user', '1');

?>



<h1 id="title_text" style="background: #3498DB; width: 100%; color: white; text-align:center; font-size:18px; margin:0px; margin-bottom:1px; padding: 10px 0px;">Accounts Module</h1>




<div class="menu_bg">






<!--
    <div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> <span> Product Management</a></div>

    <ul class="submenu">

        <li>   <a href="../files/item_sub_group.php"<?php if($active=='productsub') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Product Sub Group </span></a></li>

       <li>   <a href="../files/item_info.php"<?php if($active=='item') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Product Info</span></a></li>

       <li>   <a href="../files/unit_management.php"<?php if($active=='unit') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Unit Manage</span></a></li>

       <li>   <a href="../files/item_report.php"<?php if($active=='search') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Product Search</span></a></li>

    </ul>-->





<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> <span> Admin Panel</a></div>



    <ul class="submenu">



        <li>   <a href="../files/project_info.php"<?php if($active=='projin') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Project Info</span></a></li>

      

        <li>  <a href="../files/user_manage.php"<?php if($active=='usmanag') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> User Manage</span></a></li>

        



    </ul>
	
	
	<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Vendor Status</a></div>


    <ul class="submenu">
	
		   <li><a href="../files/vendor_info.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span>Vendor Info</span></a></li>
		   
		  
		   
		   
    </ul>

    

    

    <div class="silverheader"><a href="../files/dash_project.php"><i class="fa fa-cubes" aria-hidden="true"></i> <span> Ledger Setup</a></div>



    <ul class="submenu">



        <!--<li>   <a href="../files/ledger_sub_class.php"<?php if($active=='subclass') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Sub Class</span></a></li>-->

      

        <li>   <a href="../files/ledger_group.php"<?php if($active=='lggroup') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Ledger Group</span></a></li>

        <li>   <a href="../files/account_ledger.php"<?php if($active=='acledg') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> A/C Ledger</span></a></li>

        <li>   <a href="../files/account_sub_ledger.php"<?php if($active=='acsubl') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Sub Ledger</span></a></li>

		

 <li>   <a href="../files/account_sub_sub_ledger.php"<?php if($active=='subsubl') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Sub Sub Ledger</span></a></li>

<!-- <li>   <a href="../files/opening_balance.php"<?php if($active=='opbal') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Openning Balance</span></a></li>

 <li>   <a href="../files/opening_balance_reset.php"<?php if($active=='opbalres') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Openning Balance Reset</span></a></li>

  <li>   <a href="../files/opening_balance_manual.php"<?php if($active=='opbalman') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Openning Balance(Manual)</span></a></li>

-->



    </ul>
	
	
	





 <div class="silverheader"><a href="../files/dash_voucher.php"><i class="fa fa-cubes" aria-hidden="true"></i> <span> General Voucher</a></div>



    <ul class="submenu">
	


        <li>   <a href="../files/credit_note.php?mhafuz=2"<?php if($active=='recvou') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Receipt Voucher</span></a></li>

		  <li>   <a href="../files/debit_note.php?mhafuz=2"<?php if($active=='dabit') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Payment Voucher</span></a></li>

		    <li>   <a href="../files/journal_note_new.php?mhafuz=2" <?php if($active=='jourvo') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Journal Voucher</span></a></li>

			  <li>   <a href="../files/coutra_note_new.php?mhafuz=2" <?php if($active=='contravou') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Contra Voucher</span></a></li>
			  
			   <li>   <a href="../files/select_unfinished_voucher.php"<?php if($active=='vouview') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span>Unfinished Voucher List</span></a></li>
		<li>   <a href="../files/unchecked_voucher_view.php" <?php if($active=='unvou') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Unapproved General Vouchers</span></a></li>

			    <li>   <a href="../files/voucher_view.php"<?php if($active=='vouview') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span>Approved General Voucher List</span></a></li>

				  

      
</ul>
       

    
	
	
	<div class="silverheader"><a href="../files/dash_voucher.php"><i class="fa fa-cubes" aria-hidden="true"></i> <span> Payment Request</a></div>



    <ul class="submenu">
	
	
	  <li>   <a href="../files/debit_note_request.php?mhafuz=2"<?php if($active=='dabit') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> New Payment Request</span></a></li>

</ul>



<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i>  Unapproved Payment Request </a></div>


    <ul class="submenu">


		   <li>  <a href="../files/payment_request_pending_ca.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span>Chief Accountant Approval</span></a></li>
		   
		   <li>  <a href="../files/payment_request_pending_fc.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span>Financial Controller Approval</span></a></li>
		   
		   <li>  <a href="../files/payment_request_pending_om.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span>Operation Manager Approval</span></a></li>
		   
		   <li>  <a href="../files/payment_request_pending_ceo.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span>CEO Approval</span></a></li>


    </ul>
	
	
	
<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Payment Status</a></div>


    <ul class="submenu">
	
		   <li><a href="../files/payment_request_status.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span>Payment Request Status</span></a></li>
		   
		   <li><a href="../files/payment_letter_status.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span>Payment Letter Status</span></a></li>
		   
		   
    </ul>







	
 <div class="silverheader"><a href="../files/dash_voucher.php"><i class="fa fa-cubes" aria-hidden="true"></i> <span> Special Voucher</a></div>



    <ul class="submenu">



        <li>   <a href="../files/receipt_voucher_dealer_selection.php"<?php if($active=='recvou') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span>Chalan Wise Receipt Voucher</span></a></li>

		  <li>   <a href="../files/payment_voucher_vendor_selection.php"<?php if($active=='dabit') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span>MRR Wise Payment Voucher</span></a></li>

		   

      

       

    </ul>


	<div class="silverheader"><a href="../files/dash_voucher.php"><i class="fa fa-cubes" aria-hidden="true"></i> <span> Manual Vouchers</a></div>



    <ul class="submenu">



	<li>   <a href="../files/bill_create.php"<?php if($active=='recvou') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Bill Create</span></a></li>

	<li>   <a href="../files/select_bill.php"<?php if($active=='dabit') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Bill Payment</span></a></li>

	<li>   <a href="../files/invoice_create.php"<?php if($active=='dabit') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Invoice Create</span></a></li>

	<li>   <a href="../files/invoice_select.php"<?php if($active=='dabit') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Invoice Receipt</span></a></li>


       

    </ul>


	

	

    <div class="silverheader"><a href="../files/dash_inventory.php"><i class="fa fa-cubes" aria-hidden="true"></i> <span> Inventory Setup</a></div>



    <ul class="submenu">



		<li>   <a href="../files/cost_category.php" <?php if($active=='unvou') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Cost Category</span></a></li>

		<li>   <a href="../files/cost_center.php"<?php if($active=='unvou') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Cost Center</span></a></li>

		<li>   <a href="../files/inventory_warehouse.php"<?php if($active=='unvou') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span>   Warehouse Info</span></a></li>



       

    </ul>

	

	

    

    

    <div class="silverheader"><a href="../files/dash_report.php"><i class="fa fa-cubes" aria-hidden="true"></i> <span> Report</a></div>



    <ul class="submenu">



        <li>  <a href="../files/chart_of_accounts2.php" <?php if($active=='treere') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Chart of Accounts</span></a></li>

        <li>  <a href="../files/ledger_account1_report.php"<?php if($active=='legna') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Ledger Group Name</span></a></li>

      <li>  <a href="../files/transaction_listledger.php"<?php if($active=='transstle') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Transaction Statement (Ledger)</span></a></li>

      <li> <a href="../files/sale_proceeds_received_and_deposited.php" <?php if($active=='saleproceeds') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Sale Proceeds Received and Deposited Report</span></a></li>

	   <li> <a href="../files/receipt&amp;paymant.php"<?php if($active=='recpay') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Receipt &amp; Payment Statement(Ledger)</span></a></li>

	    <li> <a href="../files/receipt&amp;paymant_ledger.php"<?php if($active=='recpaymst') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Receipt &amp; Payment Statement</span></a></li>

      

       

    </ul>

    

	

	

     <div class="silverheader"><a href="../files/dash_report.php"><i class="fa fa-cubes" aria-hidden="true"></i> <span> Advanced Report</a></div>



    <ul class="submenu">

   

		   <li>  <a href="../files/cash_book.php"<?php if($active=='cashbo') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Cash Book</span></a></li>

		      <li>  <a href="../files/bank_book.php" <?php if($active=='bankbo') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Bank Book</span></a></li>

			     <li>  <a href="../files/trial_balance_detail_new.php"<?php if($active=='transdetrep') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Transection Detail Report</span></a></li>

				 <li>  <a href="../files/consolidated_trial_balance.php"<?php if($active=='consolidtrailbal') {  ?> style="color:white;"<?php } ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Consolidated Trial Balance</span></a></li>


    </ul>




<div class="silverheader"><a href=" ../files/dash_control.php"><i class="fa fa-cubes" aria-hidden="true"></i> <span> Financial Report</a></div>



    <ul class="submenu">

   

		   <li>  <a href="../files/financial_statement.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Financial Statement</span></a></li>

		      <li>  <a href="../files/financial_appropriation_accounts_new.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> PL Appropriation Accounts</span></a></li>

			     <li>  <a href="../files/financial_profit_loss.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Profit & Loss Statement</span></a></li>

				

    </ul>


 
<div class="silverheader"><a href="  ../files/dash_support.php"><i class="fa fa-cubes" aria-hidden="true"></i> <span> Chalan Verification</a></div>



    <ul class="submenu">

   

		   <li>  <a href="../files/ch_received_amt.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span>Chalan Verify</span></a></li>

		      <li>  <a href="../files/ch_received_list.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span>Chalan Report</span></a></li>
		

    </ul>


<div class="silverheader"><a href="  ../files/dash_support.php"><i class="fa fa-cubes" aria-hidden="true"></i> <span> Sales Return Verification</a></div>


    <ul class="submenu">


		   <li>  <a href="../files/sr_received_amt.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span>Sales Return Verify</span></a></li>


    </ul>


<div class="silverheader"><a href="  ../files/dash_support.php"><i class="fa fa-cubes" aria-hidden="true"></i> <span> Purchased Order Verification</a></div>


    <ul class="submenu">

<li>  <a href="../files/gr_received_amt.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span>Purchased Verify </span></a></li>

<!--
		   <li>  <a href="../files/purchased_verify_black_tea.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span>Purchased Verify (Black Tea)</span></a></li>
 <li>  <a href="../files/purchased_verify_packing_materials.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span>Purchased Verify (Packing Materials)</span></a></li>
 <li>  <a href="../files/purchased_verify_local_purchase.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span>Purchased Verify (Local Purchase)</span></a></li>
  <li>  <a href="../files/purchased_verify_black_tea.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span>Purchased Verify (Black Tea)</span></a></li>
    </ul>
-->

<?php
 $sql = "SELECT  user_roll_manage.id,user_feature_manage.feature_icon ,user_feature_manage.feature_name, user_feature_manage.id as f_id from user_roll_manage left join user_roll_activity on user_roll_activity.user_id = user_roll_manage.id left join user_page_manage on user_page_manage.id = user_roll_activity.page_id left join user_feature_manage on user_feature_manage.id = user_page_manage.feature_id LEFT JOIN user_module_manage on user_module_manage.id = user_feature_manage.module_id where user_roll_activity.user_id = 3 and user_module_manage.module_name like '%acc%' GROUP BY user_feature_manage.id ";
$query = mysql_query($sql);
while($data = mysql_fetch_assoc($query)){
extract($data);
    ?>
    <div class="silverheader"><a href="#" ><i class="<?=$feature_icon?>"></i> <span> <?=$feature_name?></a></div>
    <ul class="submenu">
<?php
$sql1 = "SELECT user_page_manage.folder_name,user_page_manage.page_icon ,user_page_manage.page_link,user_page_manage.page_name  FROM `user_page_manage` left join user_roll_activity on user_roll_activity.page_id = user_page_manage.id where user_roll_activity.user_id = 3 and user_page_manage.feature_id='".$f_id."'";
$query1 = mysql_query($sql1);
while($data2 = mysql_fetch_assoc($query1)){
    extract($data2)
?>
    
        <li><a href="../<?=$folder_name?>/<?=$page_link?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> <?=$page_name?></span></a></li>
    
    <?php
}
?>
</ul>
<?php
}
?>




    <div class="silverheader"><a href="#" ><i class="fas fa-sign-in-alt"></i> <span> Exit Program</a></div>



    <ul class="submenu">

        <li>

            <a href="../files/logout.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span> Log Out</span></a></li>
    </ul>



</div>





<div class="copyright" style="text-align:center">

   <img class="oe_logo_img" src="../../../logo/logo.png" height="40px;" >

</div>











