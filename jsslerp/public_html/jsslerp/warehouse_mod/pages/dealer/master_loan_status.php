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
  <form class="n-form1 fo-width pt-4" action="master_loan.php" method="post" name="form1" target="_blank" id="form1">
    <div class="row m-0 p-0">
      <div class="col-sm-5">
        <div align="left">Select Report </div>
        <div class="form-check">
          <input name="report" type="radio" class="radio1" id="report5-btn" value="11"  tabindex="1"/>
          <label class="form-check-label p-0" for="report6-btn">Agent Loan Report(11) </label>
        </div>
      </div>
      <div class="col-sm-7">
        <?php /*?> <div class="form-group row m-0 mb-1 pl-3 pr-3">
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
                </div><?php */?>
        <div class="form-group row m-0 mb-1 pl-3 pr-3">
          <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">From Date :</label>
          <div class="col-sm-8 p-0"> <span class="oe_form_group_cell">
            <input  name="f_date" type="text" id="f_date" value="<?=date('Y-m-d')?>" class="form-control" />
            </span> </div>
        </div>
        <div class="form-group row m-0 mb-1 pl-3 pr-3">
          <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">To Date:</label>
          <div class="col-sm-8 p-0"> <span class="oe_form_group_cell">
            <input  name="t_date" type="text" id="t_date" value="<?=date('Y-m-d')?>" class="form-control" />
            </span> </div>
        </div>
        <!--<div class="form-group row m-0 mb-1 pl-3 pr-3">
          <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">Booking Type:</label>
          <div class="col-sm-8 p-0"> <span class="oe_form_group_cell">
            <select name="booking_type" id="booking_type">
              <option value=""></option>
              <option value='Paid Booking'>Paid Booking</option>
              <option value='Normal Booking'>Normal Booking</option>
              <option value='Contract Booking'>Contract Booking</option>
            </select>
            </span> </div>
        </div>-->
		<div class="form-group row m-0 mb-1 pl-3 pr-3">
          <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">Booking Number:</label>
          <div class="col-sm-8 p-0"> <span class="oe_form_group_cell">
            <input name="booking_number" id="booking_number" list="booking_numbers" value="<?=$_POST['booking_number'];?>"  autocomplete="off"  >
            <datalist id="booking_numbers">
              <? foreign_relation('paid_booking','concat(booking_number_eng,"[",name,"]")','booking_number_eng','1');?>
            </datalist>
            </input>
            </span> </div>
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
