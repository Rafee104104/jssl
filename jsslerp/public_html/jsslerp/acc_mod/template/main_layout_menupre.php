<? session_start();



$user_level='level'.$_SESSION['user']['level'];



?>

<? 



if($_SESSION['user']['group']==3) // HFL



{if(



$_SESSION['user']['id']==10059|| // MIS Team



$_SESSION['user']['id']==10142|| // new item



$_SESSION['user']['id']==10212||



$_SESSION['user']['id']==10112||



$_SESSION['user']['id']==10132||



$_SESSION['user']['id']==10083||



$_SESSION['user']['id']==10086||



$_SESSION['user']['id']==10066||



$_SESSION['user']['id']==10227||



$_SESSION['user']['id']==10226||



$_SESSION['user']['id']==10228)



{echo ' ';}



else



{



	echo $_SESSION['user']['group']; 



	echo $_SESSION['user']['id'];



	die('Access Limited');



}}



if($_SESSION['user']['level']==5){?>

<table cellspacing="0" cellpadding="0" border="0" class="menu">

  <tbody>

    <tr>

      <td><div class="smartmenu">

          <div class="silverheader" headerindex="0h"> <a href="#">Product Management</a></div>

          <div class="submenu" contentindex="0c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/item_group.php">Product Group</a></td>

                </tr>

				

				<tr>

                  <td><a href="../pages/item_sub_group.php">Product Sub Group</a></td>

                </tr>

				

                <tr>

                  <td><a href="../pages/item_info.php">Product Info</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/unit_management.php">Unit Manage</a></td>

                </tr>

                

                <tr>

                  <td><a href="../pages/item_report.php">Product Search</a></td>

                </tr>

              </tbody>

            </table>

          </div>

         <div class="silverheader" headerindex="1h"><a href="">Admin Panel</a></div>

			

			<div class="submenu" contentindex="1c" style="display: none;">



	<table width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td><a href="../pages/project_info.php">Project Info</a></td></tr><tr><td><a href="../pages/user_manage.php">User Manage</a></td></tr>



	</tbody></table>



	</div>

          <div class="silverheader" headerindex="2h"><a href="../pages/dash_project.php">Ledger Setup</a> </div>

          <div class="submenu" contentindex="2c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/ledger_sub_class.php">Sub Class</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/ledger_group.php">Ledger Group</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/account_ledger.php">A/C Ledger</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/account_sub_ledger.php">Sub Ledger</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/account_sub_sub_ledger.php">Sub Sub Ledger</a></td>

                </tr>

               

                <tr>

                  <td><a href="../pages/opening_balance.php">Openning Balance</a></td>

                </tr>

				

				<tr>

                  <td><a href="../pages/opening_balance_reset.php">Openning Balance Reset</a></td>

                </tr>

				

                <tr>

                  <td><a href="../pages/opening_balance_manual.php">Openning Balance(Manual)</a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <!--<div class="silverheader" headerindex="3h"><a href="../pages/dash_budget.php">Budget</a> </div>

          <div class="submenu" contentindex="3c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/budget_create.php">Budget Format</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/budget_monthly.php">Assign Budget</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/access_deny.php">Fiscal Year Assign</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/access_deny.php">Fiscal Year Generate</a></td>

                </tr>

              </tbody>

            </table>

          </div>-->

          <div class="silverheader selected" headerindex="4h"><a href="../pages/dash_voucher.php">Voucher</a> </div>

          <div class="submenu" contentindex="4c" style="display: block;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/credit_note.php">Receipt Voucher</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/debit_note.php">Payment Voucher</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/journal_note_new.php">Journal Voucher</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/coutra_note_new.php">Contra Voucher</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/voucher_view.php">Voucher View</a></td>

                </tr>

                <!--<tr>

                  <td><a href="../pages/purchase_view.php">Purchase View</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/sales_view.php">Sales View</a></td>

                </tr>-->

                <tr>

                  <td><a href="../pages/unchecked_voucher_view.php">Unchecked Voucher View</a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <div class="silverheader" headerindex="6h"><a href="../pages/dash_inventory.php">Inventory Setup </a> </div>

          <div class="submenu" contentindex="6c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <!--<tr>

                  <td><a href="../pages/customer_info.php">Customer Info</a></td>

                </tr>-->

				

				 <tr>

                  <td><a href="../pages/cost_category.php">Cost Category</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/cost_center.php">Cost Center</a></td>

                </tr>

				

                <tr>

                  <td><a href="../pages/inventory_warehouse.php">Warehouse Info</a></td>

                </tr>

                <!--<tr>

                  <td><a href="../pages/inventory_stock_transfer.php">Product Transfer</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/sales_invoice.php">Sales Invoice</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/invoice_view.php">Invoice View</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/item_requisition_report.php">Item Requisition Report</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/stock_position_report.php">Stock Position Report </a></td>

                </tr>-->

              </tbody>

            </table>

          </div>

          <div class="silverheader" headerindex="8h"><a href="../pages/dash_report.php">Report</a> </div>

          <div class="submenu" contentindex="8c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/tree_report.php">Chart of Accounts</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/ledger_account1_report.php">Ledger Group Name</a></td>

                </tr>

                <!--<tr>

                  <td><a href="../pages/transaction_list.php">Journal Book (Detail)</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/transaction_listgroup.php">Journal Book (Group)</a></td>

                </tr>-->

                <tr>

                  <td><a href="../pages/transaction_listledger.php">Transaction Statement (Ledger)</a></td>

                </tr>

				

				<tr>

                  <td><a href="../pages/sale_proceeds_received_and_deposited.php">Sale Proceeds Received and Deposited Report</a></td>

                </tr>

				

				<!--<tr>

                  <td><a href="../pages/monthly_sales_report.php">Monthly Sales Report</a></td>

                </tr>

				

				<tr>

                  <td><a href="../pages/depot_wise_statement.php">Depot Wise Sales Statment</a></td>

                </tr>-->

				

				

                <tr>

                  <td><a href="../pages/receipt&amp;paymant.php">Receipt &amp; Payment Statement(Ledger)</a></td>

                </tr>

               <!-- <tr>

                  <td><a href="../pages/layer_by_layer_report.php">Ledger Layer By Layer Report</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/layer_by_layer-sales_report.php">Layer By Layer Sales Report</a></td>

                </tr>-->

                <tr>

                  <td><a href="../pages/receipt&amp;paymant_ledger.php">Receipt &amp; Payment Statement</a></td>

                </tr>

                <!--<tr>

                  <td><a href="../pages/trial_balance.php">Trial Balance</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/trial_balance_periodical.php">Trial Balance Periodical(Detail)</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/trial_balance_summary.php">Trial Balance(At a Glance)</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/cash_book.php">Cash Book</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/bank_book.php">Bank Book</a></td>

                </tr>

               <tr><td><a href="../pages/bank_book_special.php">Bank Book</a></td></tr>

                <tr>

                  <td><a href="../pages/balance_sheet.php">Balance Sheet</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/trial_balance_periodical_group.php">Trail Balance (Group)</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/trial_balance_periodical_ledger.php">Trail Balance (Ledger)</a></td>

                </tr>-->

              </tbody>

            </table>

          </div>

		  

		  

		  <!--Trial Balance-->

		  

		  <div class="silverheader" headerindex="8h"><a href="../pages/dash_report.php">Advanced Report</a> </div>

          <div class="submenu" contentindex="8c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

               

                

				  <!--<tr>

                  <td><a href="../pages/trial_balance.php">Trial Balance</a></td>

                </tr>

				<tr>

                  <td><a href="../pages/trial_balance_detail.php">Trial Balance Detail</a></td>

                </tr>

				

              <tr>

                  <td><a href="../pages/trial_balance_old.php">Trial Balance Old</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/trial_balance_periodical.php">Trial Balance Periodical(Detail)</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/trial_balance_summary.php">Trial Balance(At a Glance)</a></td>

                </tr>-->

				<tr>

                  <td><a href="../pages/tree_report.php">Chart of Accounts</a></td>

                </tr>

				

                <tr>

                  <td><a href="../pages/cash_book.php">Cash Book</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/bank_book.php">Bank Book</a></td>

                </tr>

				

			
			  

			  <tr>

                  <td><a href="../pages/trial_balance_detail_new.php">Transection Detail Report</a></td>

                </tr>

				

               <tr><td><a href="../pages/consolidated_trial_balance.php">Consolidated Trial Balance</a></td></tr>

                <!--<tr>

                  <td><a href="../pages/balance_sheet.php">Balance Sheet</a></td>

                </tr>-->

				

				

                <!--<tr>

                  <td><a href="../pages/trial_balance_periodical_group.php">Trail Balance (Group)</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/trial_balance_periodical_ledger.php">Trail Balance (Ledger)</a></td>

                </tr>-->

              </tbody>

            </table>

          </div>

		  

		  <!--/Trial Balance-->

		  

		  

		  

         <div class="silverheader" headerindex="9h"><a href=" ../pages/dash_control.php">Financial Report</a></div>

          <div class="submenu" contentindex="9c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

			  

			   <!--<tr>

                  <td><a href="../pages/Cash_flow_statement.php">Cash Flow Statement</a></td>

                </tr>-->

			  

                <tr>

                  <td><a href="../pages/financial_statement.php">Financial Statement</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/financial_appropriation_accounts_new.php">PL Appropriation Accounts</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/financial_profit_loss.php">Profit & Loss Statement</a></td>

                </tr>

              </tbody>

            </table>

          </div>

		  
<!--
          <div class="silverheader" headerindex="9h"><a href=" ../pages/dash_control.php">Control</a></div>

          <div class="submenu" contentindex="9c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/set_config.php">Set Configaration</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/set_config_report.php">Set Report Configaration</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/set_group_class.php">Set Module Syn Config</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/access_deny.php">User Access</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/access_deny.php">Data Back Up</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/access_deny.php">Voucher Error</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/access_deny.php">Delete Record</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/rpt_user_activity.php">User Activity</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/rpt_user_transaction.php">User wise Transaction</a></td>

                </tr>

              </tbody>

            </table>

          </div>-->

          <!--<div class="silverheader" headerindex="10h"><a href="  ../pages/dash_support.php">Support</a> </div>

          <div class="submenu" contentindex="10c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/opening_balance.php">Openning Balance</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/super_shop_price_report.php">Super Shop Price Report</a></td>

                </tr>

              </tbody>

            </table>

          </div>-->

         <!-- <div class="silverheader" headerindex="10h"><a href="  ../pages/dash_support.php">Party Cash Collection</a> </div>

          <div class="submenu" contentindex="10c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/do_received_amt.php">Collection Verification</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/collection_list.php">Collection List Report</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/do_received_amt_cancel.php">Collection Cancel</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/do_received_amt_edit.php">Verified Collection Edit</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/do_status_report.php">DO Status Report</a></td>

                </tr>

              </tbody>

            </table>

          </div>-->

          <div class="silverheader" headerindex="10h"><a href="  ../pages/dash_support.php">Chalan Verification</a> </div>

          <div class="submenu" contentindex="10c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/ch_received_amt.php">Chalan Verify</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/ch_received_list.php">Chalan Report</a></td>

                </tr>

              </tbody>

            </table>

          </div>

		  

		

		  

		  

          <div class="silverheader" headerindex="10h"><a href="  ../pages/dash_support.php">Sales Return Verification</a> </div>

          <div class="submenu" contentindex="10c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/sr_received_amt.php">Sales Return Verify</a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <div class="silverheader" headerindex="10h"><a href="  ../pages/dash_support.php">Damage Receive Verification</a> </div>

          <div class="submenu" contentindex="10c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/dr_received_amt.php">Damage Receive Verify</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/corporate_price.php">Corporate Price List</a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <div class="silverheader" headerindex="10h"><a href="  ../pages/dash_support.php">Purchased Order Verification</a> </div>

          <div class="submenu" contentindex="10c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/purchased_verify_black_tea.php">Purchased Verify (Black Tea)</a></td>

                </tr>

				

				<tr>

                  <td><a href="../pages/purchased_verify_packing_materials.php">Purchased Verify (Packing Materials)</a></td>

                </tr>

				

				<tr>

                  <td><a href="../pages/purchased_verify_local_purchase.php">Purchased Verify (Local Purchase)</a></td>

                </tr>

              </tbody>

            </table>

          </div>
		  
		  
		  <div class="silverheader" headerindex="10h"><a href="  ../pages/dash_support.php">FG Despatch Journal Verification</a> </div>

          <div class="submenu" contentindex="10c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/depot_sales_received_amt.php">Despatch Journal Verify</a></td>

                </tr>

                  <tr>

                  <td><a href="../pages/store_received_journal_verify.php">Depot Received Journal Verify</a></td>

                </tr>

              </tbody>

            </table>

          </div>
		  
		   <div class="silverheader" headerindex="10h"><a href="  ../pages/dash_support.php">Raw Materials Stock Journal</a> </div>

          <div class="submenu" contentindex="10c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/black_tea_stock_verify.php">Black Tea Stock Journal</a></td>

                </tr>

                  <tr>

                  <td><a href="../pages/packing_materials_stock_verify.php">Packing Materials Received Journal</a></td>

                </tr>

              </tbody>

            </table>

          </div>

         <!-- <div class="silverheader" headerindex="10h"><a href="  ../pages/dash_support.php">HFL Chalan Verification</a> </div>

          <div class="submenu" contentindex="10c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/sc_ch_received_amt.php">HFL Chalan Verify</a></td>

                </tr>

              </tbody>

            </table>

          </div>-->

         <!-- <div class="silverheader" headerindex="10h"><a href="  ../pages/dash_support.php">Store to Store Issue Report</a> </div>

          <div class="submenu" contentindex="10c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/store_ch_issued_amt.php">Store Issue Verify</a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <div class="silverheader" headerindex="10h"><a href="  ../pages/dash_support.php">Store to Store Receive Report</a> </div>

          <div class="submenu" contentindex="10c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/store_ch_received_amt.php">Store Receive Verify</a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <div class="silverheader" headerindex="11h"><a href=" ../pages/dash_office.php">Office</a> </div>

          <div class="submenu" contentindex="11c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/access_deny.php">Communication</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/access_deny.php">Comm. Report</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/access_deny.php">List Group Report</a></td>

                </tr>

              </tbody>

            </table>

          </div>-->

        </div></td>

    </tr>

  </tbody>

</table>

<? }?>

<? if($_SESSION['user']['level']==6){?>

<table cellspacing="0" cellpadding="0" border="0" class="menu">

  <tbody>

    <tr>

      <td><div class="smartmenu">

          <div class="silverheader" headerindex="0h"> <a href="#">Product Management</a></div>

          <div class="submenu" contentindex="0c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/item_group.php">Product Group</a></td>

                </tr>

				

				<tr>

                  <td><a href="../pages/item_sub_group.php">Product Sub Group</a></td>

                </tr>

				

                <tr>

                  <td><a href="../pages/item_info.php">Product Info</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/unit_management.php">Unit Manage</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/item_sub_group.php">Product Sub Group</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/item_report.php">Product Search</a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <div class="silverheader" headerindex="1h"><a href="">Admin Panel</a> </div>

          <div class="submenu" contentindex="1c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/project_info.php">Project Info</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/user_manage.php">User Manage</a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <div class="silverheader" headerindex="2h"><a href="../pages/dash_project.php">Ledger Setup</a> </div>

          <div class="submenu" contentindex="2c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/ledger_sub_class.php">Sub Class</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/ledger_group.php">Ledger Group</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/account_ledger.php">A/C Ledger</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/account_sub_ledger.php">Sub Ledger</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/account_sub_sub_ledger.php">Sub Sub Ledger</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/cost_category.php">Cost Category</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/cost_center.php">Cost Center</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/opening_balance.php">Openning Balance</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/opening_balance_manual.php">Openning Balance(Manual)</a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <div class="silverheader" headerindex="3h"><a href="../pages/dash_budget.php">Budget</a> </div>

          <div class="submenu" contentindex="3c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/budget_create.php">Budget Format</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/budget_monthly.php">Assign Budget</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/access_deny.php">Fiscal Year Assign</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/access_deny.php">Fiscal Year Generate</a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <div class="silverheader selected" headerindex="4h"><a href="../pages/dash_voucher.php">Voucher</a> </div>

          <div class="submenu" contentindex="4c" style="display: block;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/credit_note.php">Receipt Voucher</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/debit_note.php">Payment Voucher</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/journal_note_new.php">Journal Voucher</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/coutra_note_new.php">Contra Voucher</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/voucher_view.php">Voucher View</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/purchase_view.php">Purchase View</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/sales_view.php">Sales View</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/unchecked_voucher_view.php">Unchecked Voucher View</a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <div class="silverheader" headerindex="6h"><a href="../pages/dash_inventory.php">Inventory </a> </div>

          <div class="submenu" contentindex="6c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/customer_info.php">Customer Info</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/inventory_warehouse.php">Ware House Info</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/inventory_stock_transfer.php">Product Transfer</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/sales_invoice.php">Sales Invoice</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/invoice_view.php">Invoice View</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/item_requisition_report.php">Item Requisition Report</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/stock_position_report.php">Stock Position Report </a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <div class="silverheader" headerindex="8h"><a href="../pages/dash_report.php">Report</a> </div>

          <div class="submenu" contentindex="8c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/tree_report.php">Chart of Accounts</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/ledger_account1_report.php">Ledger Group Name</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/transaction_list.php">Journal Book (Detail)</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/transaction_listgroup.php">Journal Book (Group)</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/transaction_listledger.php">Transaction Statement (Ledger)</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/receipt&amp;paymant.php">Receipt &amp; Payment Statement(Ledger)</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/layer_by_layer_report.php">Ledger Layer By Layer Report</a></td>

                </tr>

				

				 <tr>

                  <td><a href="../pages/layer_by_layer_sales_report.php">Layer By Layer Sales Report</a></td>

                </tr>

				

                <tr>

                  <td><a href="../pages/receipt&amp;paymant_ledger.php">Receipt &amp; Payment Statement</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/trial_balance.php">Trial Balance</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/trial_balance_periodical.php">Trial Balance Periodical(Detail)</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/trial_balance_summary.php">Trial Balance(At a Glance)</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/cash_book.php">Cash Book</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/bank_book.php">Bank Book</a></td>

                </tr>

                <!--<tr><td><a href="../pages/bank_book_special.php">Bank Book</a></td></tr>-->

                <tr>

                  <td><a href="../pages/balance_sheet.php">Balance Sheet</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/trial_balance_periodical_group.php">Trail Balance (Group)</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/trial_balance_periodical_ledger.php">Trail Balance (Ledger)</a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <div class="silverheader" headerindex="9h"><a href=" ../pages/dash_control.php">Financial Report</a></div>

          <div class="submenu" contentindex="9c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/financial_statement.php">Financial Statement</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/financial_trading_statement.php">Trading Account Statement</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/financial_profit_loss.php">Profit & Loss Statement</a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <div class="silverheader" headerindex="9h"><a href=" ../pages/dash_control.php">Control</a></div>

          <div class="submenu" contentindex="9c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/set_config.php">Set Configaration</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/set_config_report.php">Set Report Configaration</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/set_group_class.php">Set Module Syn Config</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/access_deny.php">User Access</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/access_deny.php">Data Back Up</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/access_deny.php">Voucher Error</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/access_deny.php">Delete Record</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/rpt_user_activity.php">User Activity</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/rpt_user_transaction.php">User wise Transaction</a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <div class="silverheader" headerindex="10h"><a href="  ../pages/dash_support.php">Support</a> </div>

          <div class="submenu" contentindex="10c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/opening_balance.php">Openning Balance</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/super_shop_price_report.php">Super Shop Price Report</a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <div class="silverheader" headerindex="10h"><a href="  ../pages/dash_support.php">Party Cash Collection</a> </div>

          <div class="submenu" contentindex="10c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/do_received_amt.php">Collection Verification</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/collection_list.php">Collection List Report</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/do_received_amt_cancel.php">Collection Cancel</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/do_received_amt_edit.php">Verified Collection Edit</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/do_status_report.php">DO Status Report</a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <div class="silverheader" headerindex="10h"><a href="  ../pages/dash_support.php">Chalan Verification</a> </div>

          <div class="submenu" contentindex="10c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/ch_received_amt.php">Chalan Verify</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/ch_received_list.php">Chalan Report</a></td>

                </tr>

              </tbody>

            </table>

          </div>

		  <div class="silverheader" headerindex="10h"><a href="  ../pages/dash_support.php">Depot Sales Verification</a> </div>

          <div class="submenu" contentindex="10c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/depot_sales_received_amt.php">Depot Sales Verify</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/depot_sales_received_list.php">Depot Sales Report</a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <div class="silverheader" headerindex="10h"><a href="  ../pages/dash_support.php">Sales Return Verification</a> </div>

          <div class="submenu" contentindex="10c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/sr_received_amt.php">Sales Return Verify</a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <div class="silverheader" headerindex="10h"><a href="  ../pages/dash_support.php">Damage Receive Verification</a> </div>

          <div class="submenu" contentindex="10c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/dr_received_amt.php">Damage Receive Verify</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/corporate_price.php">Corporate Price List</a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <div class="silverheader" headerindex="10h"><a href="  ../pages/dash_support.php">Purchased Order Verification</a> </div>

          <div class="submenu" contentindex="10c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/purchased_verify_black_tea.php">Purchased Verify (Black Tea)</a></td>

                </tr>

				

				<tr>

                  <td><a href="../pages/purchased_verify_packing_materials.php">Purchased Verify (Packing Materials)</a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <!--<div class="silverheader" headerindex="10h"><a href="  ../pages/dash_support.php">HFL Chalan Verification</a> </div>

          <div class="submenu" contentindex="10c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/sc_ch_received_amt.php">HFL Chalan Verify</a></td>

                </tr>

              </tbody>

            </table>

          </div>-->

          <div class="silverheader" headerindex="10h"><a href="  ../pages/dash_support.php">Store to Store Issue Report</a> </div>

          <div class="submenu" contentindex="10c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/store_ch_issued_amt.php">Store Issue Verify</a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <div class="silverheader" headerindex="10h"><a href="  ../pages/dash_support.php">Store to Store Receive Report</a> </div>

          <div class="submenu" contentindex="10c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/store_ch_received_amt.php">Store Receive Verify</a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <div class="silverheader" headerindex="11h"><a href=" ../pages/dash_office.php">Office</a> </div>

          <div class="submenu" contentindex="11c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/access_deny.php">Communication</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/access_deny.php">Comm. Report</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/access_deny.php">List Group Report</a></td>

                </tr>

              </tbody>

            </table>

          </div>

        </div></td>

    </tr>

  </tbody>

</table>

<? }?>

<? if($_SESSION['user']['level']==2){?>

<table cellspacing="0" cellpadding="0" border="0" class="menu">

  <tbody>

    <tr>

      <td><div class="smartmenu">

          <div class="silverheader" headerindex="0h"><a href="../pages/dash_project.php">Ledger Setup</a> </div>

          <div class="submenu" contentindex="0c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/ledger_group.php">Ledger Group</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/account_ledger.php">A/C Ledger</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/account_sub_ledger.php">Sub Ledger</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/account_sub_sub_ledger.php">Sub Sub Ledger</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/cost_category.php">Cost Category</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/cost_center.php">Cost Center</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/opening_balance.php">Openning Balance</a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <!--<div class="silverheader" headerindex="1h"><a href="../pages/dash_budget.php">Budget</a>



			</div><div class="submenu" contentindex="1c" style="display: none;">



	<table width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td><a href="../pages/budget_create.php">Budget Format</a></td></tr><tr><td><a href="../pages/budget_monthly.php">Assign Budget</a></td></tr><tr><td><a href="../pages/access_deny.php">Fiscal Year Assign</a></td></tr><tr><td><a href="../pages/access_deny.php">Fiscal Year Generate</a></td></tr>



	</tbody></table></div>-->

          <div class="silverheader selected" headerindex="2h"><a href="../pages/dash_voucher.php">Voucher</a> </div>

          <div class="submenu" contentindex="2c" style="display: block;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/credit_note.php">Receipt Voucher</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/debit_note.php">Payment Voucher</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/journal_note_new.php">Journal Voucher</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/coutra_note_new.php">Contra Voucher</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/voucher_view.php">Voucher View</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/purchase_view.php">Purchase View</a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <!--	<div class="silverheader" headerindex="3h"><a href="../pages/dash_inventory.php">Inventory</a>



			</div><div class="submenu" contentindex="3c" style="display: none;">



	<table width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td><a href="../pages/customer_info.php">Customer Info</a></td></tr><tr><td><a href="../pages/inventory_warehouse.php">Ware House Info</a></td></tr><tr><td><a href="../pages/inventory_stock_transfer.php">Product Transfer</a></td></tr><tr><td><a href="../pages/sales_invoice.php">Sales Invoice</a></td></tr><tr><td><a href="../pages/invoice_view.php">Invoice View</a></td></tr><tr><td><a href="../pages/item_requisition_report.php">Item Requisition Report</a></td></tr><tr><td><a href="../pages/stock_position_report.php">Stock Position Report



</a></td></tr>



	</tbody></table>-->

          <div class="silverheader" headerindex="5h"><a href="../pages/dash_report.php">Report</a> </div>

          <div class="submenu" contentindex="5c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/tree_report.php">Chart of Accounts</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/ledger_account1_report.php">Ledger Group Name</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/transaction_list.php">Journal Book (Detail)</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/transaction_listgroup.php">Journal Book (Group)</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/transaction_listledger.php">Transaction Statement (Ledger)</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/receipt&amp;paymant.php">Receipt &amp; Payment Statement</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/trial_balance.php">Trial Balance</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/trial_balance_periodical.php">Trial Balance Periodical(Detail)</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/trial_balance_summary.php">Trial Balance(At a Glance)</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/cash_book.php">Cash Book</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/bank_book.php">Bank Book</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/bank_book_special.php">Bank Book(Special)</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/balance_sheet.php">Balance Sheet</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/trial_balance_periodical_group.php">Trail Balance (Group)</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/trial_balance_periodical_ledger.php">Trail Balance (Ledger)</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/layer_by_layer_report.php">Ledger Layer By Layer Report</a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <div class="silverheader" headerindex="10h"><a href="  ../pages/dash_support.php">Party Cash Collection</a> </div>

          <div class="submenu" contentindex="10c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/do_received_amt.php">Collection Verification</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/collection_list.php">Collection List Report</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/do_received_amt_cancel.php">Collection Cancel</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/do_received_amt_edit.php">Verified Collection Edit</a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <div class="silverheader" headerindex="10h"><a href="  ../pages/dash_support.php">Chalan Verification</a> </div>

          <div class="submenu" contentindex="10c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/ch_received_amt.php">Chalan Verify</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/ch_received_list.php">Chalan Report</a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <div class="silverheader" headerindex="10h"><a href="  ../pages/dash_support.php">Sales Return Verification</a> </div>

          <div class="submenu" contentindex="10c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/sr_received_amt.php">Sales Return Verify</a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <div class="silverheader" headerindex="10h"><a href="  ../pages/dash_support.php">Damage Receive Verification</a> </div>

          <div class="submenu" contentindex="10c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/dr_received_amt.php">Damage Receive Verify</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/corporate_price.php">Corporate Price List</a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <div class="silverheader" headerindex="10h"><a href="  ../pages/dash_support.php">Purchased Order Verification</a> </div>

          <div class="submenu" contentindex="10c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/purchased_verify_black_tea.php">Purchased Verify (Black Tea)</a></td>

                </tr>

				

				<tr>

                  <td><a href="../pages/purchased_verify_packing_materials.php">Purchased Verify (Packing Materials)</a></td>

                </tr>

              </tbody>

            </table>

          </div>

         <!-- <div class="silverheader" headerindex="10h"><a href="  ../pages/dash_support.php">HFL Chalan Verification</a> </div>

          <div class="submenu" contentindex="10c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/sc_ch_received_amt.php">HFL Chalan Verify</a></td>

                </tr>

              </tbody>

            </table>

          </div>-->

          <div class="silverheader" headerindex="10h"><a href="  ../pages/dash_support.php">Store to Store Issue Report</a> </div>

          <div class="submenu" contentindex="10c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/store_ch_issued_amt.php">Store Issue Verify</a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <div class="silverheader" headerindex="10h"><a href="  ../pages/dash_support.php">Store to Store Receive Report</a> </div>

          <div class="submenu" contentindex="10c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/store_ch_received_amt.php">Store Receive Verify</a></td>

                </tr>

              </tbody>

            </table>

          </div>

        </div></td>

    </tr>

  </tbody>

</table>

<? }?>

<? if($_SESSION['user']['level']==1){?>

<table cellspacing="0" cellpadding="0" border="0" class="menu">

  <tbody>

    <tr>

      <td><div class="smartmenu">

          <div class="silverheader" headerindex="5h"><a href="../pages/dash_report.php">Report</a> </div>

          <div class="submenu" contentindex="5c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/tree_report.php">Chart of Accounts</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/ledger_account1_report.php">Ledger Group Name</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/transaction_list.php">Journal Book (Detail)</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/transaction_listgroup.php">Journal Book (Group)</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/transaction_listledger.php">Transaction Statement (Ledger)</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/receipt&amp;paymant.php">Receipt &amp; Payment Statement</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/trial_balance.php">Trial Balance</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/trial_balance_periodical.php">Trial Balance Periodical(Detail)</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/trial_balance_summary.php">Trial Balance(At a Glance)</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/cash_book.php">Cash Book</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/bank_book.php">Bank Book</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/balance_sheet.php">Balance Sheet</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/trial_balance_periodical_group.php">Trail Balance (Group)</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/trial_balance_periodical_ledger.php">Trail Balance (Ledger)</a></td>

                </tr>

              </tbody>

            </table>

          </div>

          <div class="silverheader" headerindex="10h"><a href="../pages/dash_support.php">Support</a></div>

          <div class="submenu" contentindex="10c" style="display: none;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">

              <tbody>

                <tr>

                  <td><a href="../pages/do_received_amt.php">Collection Varification</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/collection_list.php">Collection List Report</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/gr_received_amt.php">GR Verify</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/ch_received_amt.php">Chalan Verify</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/sr_received_amt.php">Sales Return Verify</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/dr_received_amt.php">Damage Return Verify</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/sc_ch_received_amt.php">HFL Chalan Verify</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/do_received_amt_cancel.php">Collection Cancel</a></td>

                </tr>

                <tr>

                  <td><a href="../pages/opening_balance.php">Openning Balance</a></td>

                </tr>

              </tbody>

            </table>

          </div>

        </div></td>

    </tr>

  </tbody>

</table>

<? }?>

