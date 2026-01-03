<?php


session_start();


require_once "../../../assets/template/layout.top.php";


@ini_set('error_reporting', E_ALL);


@ini_set('display_errors', 'Off');


$str = $_POST['data'];


$data=explode('##',$str);

 $booking_number_eng=$data[0];
 $sr_all = find_all_field('paid_booking','*','booking_number_eng="'.$data[0].'"');
 
 $booking_type = $data[1];
 
$dealerAll = find_all_field('dealer_info','*','dealer_code_eng="'.$sr_all->agent_id.'"');
 

?>

<div class="row"  id="agent_info">

		<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Booking Number:</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="booking_number" type="text" id="booking_number" list="serial_numbers" tabindex="2" onblur="getData2('bag_loan_ajax.php', 'agent_info', this.value,  document.getElementById('dealer_code_eng').value);" value="<?=$sr_all->booking_number_eng?>" />
			 <datalist id="serial_numbers">
                <? foreign_relation('paid_booking','booking_number_eng', 'concat(booking_number_eng,"[",name,"]")',$booking_number_eng,'1');?>
              </datalist>

          </div>
        </div>
      </div>
	  
	    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Agent ID:</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
		  
		<input   name="sr_loan_id" type="hidden" class="form-control" id="sr_loan_id" value="<? if($$unique>0) echo $$unique; else echo (find_a_field('bag_loan','max(sr_loan_id)','1')+1);?>" readonly/>
		
		  
       <input name="dealer_code_eng" required="required" id="dealer_code_eng" value="<?=$dealerAll->dealer_code_eng;?>" style="width:95%; font-size:12px;"  />
                
			
          </div>
        </div>
      </div>
	  
	  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Date:</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
       <input name="date" type="date" id="date" required="required" tabindex="2" value="<?=$date?>" />
			
          </div>
        </div>
      </div>
      
	 

		
		 
      <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Agent Name (Bengali):</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="farmer_name" type="text" id="farmer_name" tabindex="2" value="<?=$sr_all->name?>" />
          </div>
        </div>
      </div>
	  
	        
      <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Village (Bengali):</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="village" type="text" id="village" tabindex="4" value="<?=$sr_all->village?>" />
          </div>
        </div>
      </div>
	  
	   <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Bag Stock Qty :</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="stock" type="text" id="stock" tabindex="4" value="<?=(int)find_a_field('journal_item','sum(item_in-item_ex)','item_id=500070001');?>" />
          </div>
        </div>
      </div>
	  
	  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Bag Issue Qty :</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="qty" type="text" id="qty" onkeyup="cal(this.value)" tabindex="4" value="<?=$qty?>" />
          </div>
        </div>
      </div>
	  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Rate :</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="rate" type="text" id="rate"  onkeyup="cal(this.value)"  tabindex="4" value="<?=$rate?>" />
          </div>
        </div>
      </div>
	  
	  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Amount :</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="amount" type="text" id="amount" tabindex="4" value="<?=$amount?>" />
          </div>
        </div>
      </div>
	  
	  
	  
  
  
      
    </div>
