<div class="menu_bg">
<table width="205" border="0" cellspacing="0" cellpadding="0" align="center" style="line-height:13px;">
								  <tr>
									<td>
					  <div class="smartmenu">
					  
                      <!--<div class="silverheader"><a href="#">Administrator</a></div>
					  <div class="submenu">
						  <table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr><td><a href="../admin/create_user.php">User Manage</a></td></tr>
                            <tr><td><a href="#">User Access Log Report</a></td></tr>
                            <tr><td><a href="#">User Action Log Report</a></td></tr>
						  </table>
					  </div>
					  
					  
					  <div class="silverheader"><a href="#">My Account</a></div>
					  <div class="submenu">
						  <table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr><td><a href="../admin/create_user.php">Account Profile</a></td></tr>
							<tr><td><a href="../admin/change_password.php">Change Password</a></td></tr>
						  </table>
					  </div>-->
                     
					 
					 <div class="silverheader"><a href="#">Inventory Requisition(MR)</a></div>
					  <div class="submenu">
						  <table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr><td><a href="../mr/mr_pending.php">MR Pending</a></td></tr>
							<tr><td><a href="../mr/mr_status.php">MR Status</a></td></tr>
                            
						  </table>
					  </div>
                     
					
					 <div class="silverheader"><a href="#">Vendor Management</a></div>
					  <div class="submenu">
						  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          	<tr><td><a href="../vendor/vendor_type.php">Vendor Type</a></td></tr>
							<tr><td><a href="../vendor/vendor_category.php">Vendor Category</a></td></tr>
							<tr><td><a href="../vendor/vendor_info.php">Vendor Information</a></td></tr>
                            
						  </table>
					  </div>
                     
					 
					 <div class="silverheader"><a href="#">Purchase Order</a></div>
					  <div class="submenu">
						  <table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr><td><a href="../po/po_create.php">New Purchase Order</a></td></tr>
							<tr><td><a href="../po/select_unfinished_po.php">Unfinished Purchase Order</a></td></tr>
							<tr><td><a href="../po/po_status.php">Approved Purchase Order List</a></td></tr>
						  </table>
					  </div>
                      
					  <? if($level==5){?>
					  <div class="silverheader"><a href="#">Approve Purchase Order</a></div>
					  <div class="submenu">
						  <table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr><td><a href="../po/select_unapproved_po.php">Unapprove Purchase Order</a></td></tr>
							<tr><td><a href="../po/po_status.php">Approved Purchase Order List</a></td></tr>
						  </table>
					  </div><? }?>
					  
					  
					  <div class="silverheader"><a href="#" >Report</a></div>
					  <div class="submenu">
						  <table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
							  <td><a href="../report/purchase_order_report.php">Purchase Order Reports</a></td>
							</tr>
						</table>
					  </div>
					  
					  
					  <div class="silverheader"><a href="#" >Exit Program</a></div>
					  <div class="submenu">
						  <table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							  <td><a href="../main/logout.php">Log Out</a></td>
						  </tr>
						  </table>
					  </div>
					  
					  </div>                             
									</td>
								  </tr>
								</table>

							</div>
