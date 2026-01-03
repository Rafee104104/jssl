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
?>



<div class="d-flex justify-content-center">
    <form class="n-form1 fo-width pt-4" action="../report/do_master.php" method="post" name="form1" target="_blank" id="form1">
        <div class="row m-0 p-0">
            <div class="col-sm-5">
                <div align="left">Select Report </div>
              
					<div class="form-check">
                    <input name="report" type="radio" class="radio1" id="report5-btn" value="404" checked="checked"  tabindex="1"/>
                    <label class="form-check-label p-0" for="report6-btn">
                        Olot Palot Report 
                    </label>
                </div>
				<div class="form-check">
                     <input name="report" type="radio" class="radio1" id="report1-btn" value="81025"  tabindex="1"/>
                    <label class="form-check-label p-0" for="report1-btn">
                        Chamber Wise Loading  Report
                    </label>
                </div>
				<div class="form-check">
                    <input name="report" type="radio" class="radio1" id="report1-btn" value="810252"  tabindex="1"/>
                    <label class="form-check-label p-0" for="report1-btn">
                       Chamber Wise Unloading Report
                    </label>
                </div>
				
				<div class="form-check">
                    <input name="report" type="radio" class="radio1" id="report1-btn" value="8102522"  tabindex="1"/>
                    <label class="form-check-label p-0" for="report1-btn">
                      Chamber Wise Palot Report
                    </label>
                </div>
				<!--<div class="form-check">
                    <input name="report" type="radio" class="radio1" id="report1-btn" value="8102521"  tabindex="1"/>
                    <label class="form-check-label p-0" for="report1-btn">
                        Loan Report(Ledger Wise)
                    </label>
                </div>-->
            </div>

            <div class="col-sm-7">
                

      			


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
				<!--<div class="form-group row m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">Palot No:</label>
                    <div class="col-sm-8 p-0">

                        <span class="oe_form_group_cell">
                            
							<select name="palot_no" id="palot_no">
								<option value=""></option>
								<option value='1'>1</option>
								<option value='2'>2</option>
								<option value='3'>3</option>
								<option value='4'>4</option>
								<option value='5'>5</option>
								
                   			 </select>
                        </span>


                    </div>
                </div>-->
				
				
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
                    <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">Year:</label>
                    <div class="col-sm-8 p-0">
                       
					   <select id="rec_year" name="rec_year" onchange="getData2('acc_sub_class_ajax.php', 'sub_class', this.value, document.getElementById('rec_year').value);" >
                     		 <option>All</option>
                      		<option value="2024">2024</option>
							<option value="2025">2025</option>
                    	</select>
                    </div>
                </div>
				
				
				<div class="form-group row m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">SR NO:</label>
                    <div class="col-sm-8 p-0">
					<span id="sub_class">
                       <input list="bag" name="bag_mark" id="bag_mark" type="text">
					   <datalist id="bag">
                     		 <option>All</option>
                      		<? foreign_relation('warehouse_other_receive','bag_mark','bag_mark');?>
                    	</datalist>
						
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