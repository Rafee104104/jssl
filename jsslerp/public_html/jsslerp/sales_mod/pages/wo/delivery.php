<?php

require_once "../../../assets/template/layout.top.php";
$title='Warehouse Advence Reports';
$ip=$_SESSION['user']['ip'];

$php_ip=substr($_SESSION['php_ip'],0,11);

if($php_ip=='115.127.35.' || $php_ip=='115.127.24.' || $php_ip=='192.168.191'){ 
	do_calander('#f_date'/*,'-1900','0'*/);
	do_calander('#t_date'/*,'-1900','30'*/);
} else {
	do_calander('#f_date'/*,'-60','0'*/);
	do_calander('#t_date'/*,'-60','30'*/);		
}

auto_complete_from_db('item_info','item_name','item_id','1','item_id');

$tr_type="Show";

$tr_from="Warehouse";

create_combobox(item_id);
create_combobox(vendor_id);
create_combobox(dealer_code);
create_combobox(warehouse_id);
create_combobox(issue_status);
create_combobox(receive_status);
?>



<div class="d-flex justify-content-center">
    <form class="n-form1 fo-width pt-4" action="delivery_token.php" method="post" name="form1" target="_blank" id="form1">
        <div class="row m-0 p-0">
            <div class="col-sm-5">
                <div align="left">Select Report </div>
              
					<div class="form-check">
                    <input name="report" type="radio" class="radio1" id="report5-btn" value="405"  tabindex="1"/>
                    <label class="form-check-label p-0" for="report6-btn">
                       Delivery Token Report (405)
                    </label>
                </div>

            </div>

            <div class="col-sm-7">
                <div class="form-group row m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">Product Group:</label>
                    <div class="col-sm-8 p-0">
                       <select name="sales_item_type" id="sales_item_type">
                      		<option>All</option>
							<? foreign_relation('item_group','group_id','group_name');?>
                    	</select>
                    </div>
                </div>

      			<div class="form-group row m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">Item Sub Group:</label>
                    <div class="col-sm-8 p-0">
                       <select name="item_sub_group" id="item_sub_group">
                     		 <option>All</option>
                      		<? foreign_relation('item_sub_group','sub_group_id','sub_group_name');?>
                    	</select>
                    </div>
                </div>


                <div class="form-group row m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">Product Name:</label>
                    <div class="col-sm-8 p-0">
                      <span class="oe_form_group_cell">
					  <select name="item_id" id="item_id">
					  <option>All</option>
					  <? foreign_relation('item_info','item_id','item_name');?>
					  
					  </select>
                        	
                      </span>

                    </div>
                </div>
				<div class="form-group row m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">From Date :</label>
                    <div class="col-sm-8 p-0">

                        <span class="oe_form_group_cell">
                            
							<input  name="f_date" type="text" id="f_date" value="<?=date('Y-m-d')?>" class="form-control" />
                        </span>


                    </div>
                </div>
				<div class="form-group row m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">To Date:</label>
                    <div class="col-sm-8 p-0">

                        <span class="oe_form_group_cell">
                            
							<input  name="t_date" type="text" id="t_date" value="<?=date('Y-m-d')?>" class="form-control" />
                        </span>


                    </div>
                </div>
				
				
				  <div class="form-group row m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">Booking Type:</label>
                    <div class="col-sm-8 p-0">

                        <span class="oe_form_group_cell">
                            
							<select name="booking_type" id="booking_type">
								<option value=""></option>
								<option value='Paid Booking'>Paid Booking</option>
								<option value='Normal Booking'>Normal Booking</option>
								<option value='Contract Booking'>Contract Booking</option>
								
                   			 </select>
                        </span>


                    </div>
                </div>

                <div class="form-group row m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">Issue Status:</label>
                    <div class="col-sm-8 p-0">

                        <span class="oe_form_group_cell">
                            
							<select name="issue_status" id="issue_status">
								<option value=""></option>
								<option value='Sales'>Sales</option>
								<option value='Bulk Sales'>Bulk Sales</option>
								<option value='Issue'>Issue</option>
								<option value='Sample Issue'>Sample Issue</option>
								<option value='Gift Issue'>Gift Issue</option>
								<option value='Entertainment Issue'>Entertainment Issue</option>
								<option value='R & D Issue'>R & D Issue</option>
								<option value='Other Issue'>Other Issue</option>
								<option value='Staff Sales'>Staff Sales</option>
								<option value='Export'>Export Sales</option>
								<option value='Other Sales'>Other Sales</option>
								<option value='Consumption'>Consumption</option>
								<option value='Reprocess Issue'>Reprocess Issue</option>
								<option value='Claim Item Issue'>Claim Item Issue</option>
								<option value='Direct Sales'>Direct Sales</option>
                   			 </select>
                        </span>


                    </div>
                </div>

				
				<div class="form-group row m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">Receive Status :</label>
                    <div class="col-sm-8 p-0">

                        <span class="oe_form_group_cell">
                            <select name="receive_status" id="receive_status">
								<option value=""></option>
								<option value='All_Purchase'>All Purchase</option>
								<option value='Purchase'>Purchase</option>
								<option value='Receive'>Receive</option>
								<option value='Return'>Return</option>
								<option value='Opening'>Opening</option>
								<option value='Other Receive'>Other Receive</option>
								<option value='Local Purchase'>Local Purchase</option>
								<option value='Sample Receive'>Sample Receive</option>
								<option value='Import'>Import</option>
								<option value='Production'>Production</option>
								<option value='Reprocess Receive'>Reprocess Receive</option>
								<option value='Claim Item Receive'>Claim Item Receive</option>
			      		  </select>
                        </span>


                    </div>
                </div>
				<div class="form-group row m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">Inventory Name:</label>
                    <div class="col-sm-8 p-0">

                        <span class="oe_form_group_cell">
                            
							<select name="warehouse_id" id="warehouse_id">
                      			<option selected="selected"></option>
                      			<? foreign_relation('warehouse','warehouse_id','warehouse_name',
									$_POST['warehouse_id'],'group_for="'.$_SESSION['user']['group'].'" and status="Active" order by warehouse_name');?>
                  		    </select>
                        </span>


                    </div>
                </div>
				
				<div class="form-group row m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">Requisition No:</label>
                    <div class="col-sm-8 p-0">

                        <span class="oe_form_group_cell">
                            
							<input type="text" name="req_no" />
                        </span>


                    </div>
                </div>
				
				<div class="form-group row m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">Sales Party:</label>
                    <div class="col-sm-8 p-0">

                        <span class="oe_form_group_cell">
                            
								<select name="dealer_code" id="dealer_code">
									<option></option>
									
<?php /*?>									<? foreign_relation('dealer_info','dealer_code','concat(dealer_code," : ",dealer_name_e)',$dealer_code,' 1 AND `dealer_type`="BulkBuyer"
AND  `direct_sales`=  "YES" AND  `group_for` ="'.$_SESSION['user']['group'].'"');?><?php */?>

<? foreign_relation('dealer_info','dealer_code','concat(dealer_code," : ",dealer_name_e)',$dealer_code,' 1 AND  `group_for` ="'.$_SESSION['user']['group'].'"');?>
                   			    </select>
                        </span>


                    </div>
                </div>
				<div class="form-group row m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">Purchase Party :</label>
                    <div class="col-sm-8 p-0">

                        <span class="oe_form_group_cell">
                            <select name="vendor_id" id="vendor_id">
								<option></option>
								<? foreign_relation('vendor','vendor_id','concat(vendor_id," : ",vendor_name)',$vendor_id,' 1 AND  `group_for` ="'.$_SESSION['user']['group'].'"');?>
							</select>

                        </span>


                    </div>
                </div>
			
                <div class="form-group row m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">Other Issue Type :</label>
                    <div class="col-sm-8 p-0">

                        <span class="oe_form_group_cell">
                            <select name="issued_to" id="issued_to">
					           <option></option>
                                 <? foreign_relation('warehouse_other_issue_type','issue_type','issue_type',$issued_to,'1 and group_for="'.$_SESSION['user']['group'].'" order by issue_type');?>
                          </select>

                        </span>


                    </div>
                </div>




            </div>

        </div>
        <div class="n-form-btn-class">
            <input name="submit" type="submit" class="btn1 btn1-bg-submit" value="Report" tabindex="6" />
        </div>
    </form>
</div>



<?

require_once "../../../assets/template/layout.bottom.php";

?>