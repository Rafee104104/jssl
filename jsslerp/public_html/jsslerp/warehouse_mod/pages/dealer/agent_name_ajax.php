<?php


session_start();


require_once "../../../assets/template/layout.top.php";


@ini_set('error_reporting', E_ALL);


@ini_set('display_errors', 'Off');


$str = $_POST['data'];


$data=explode('##',$str);

 $dealer_code_eng=$data[0];
 $booking_type = $data[1];
 
 $data[0];
$dealerAll = find_all_field('dealer_info','*','dealer_code_eng="'.$data[0].'"');


?>

<div class="row"  id="agent_info">

	
	  
	  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Date:</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
       <input name="date" type="date" id="date" required="required"   value="<? if($date !='') echo $date; else echo $_SESSION['date'];?>" />
			
          </div>
        </div>
      </div>
	  
	  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Agent ID:</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
		  <input   name="sr_id" type="hidden" class="form-control" id="sr_id" value="<? if($$unique>0) echo $$unique;?>" readonly/>
       <input name="dealer_code_eng"   required="required" list="agent_ids" id="dealer_code_eng" value="<?=$dealerAll->dealer_code_eng?>" style="width:95%; font-size:12px;" onblur="getData2('agent_name_ajax.php', 'agent_info', this.value,  document.getElementById('dealer_code_eng').value);" />
                <datalist id="agent_ids" >
                <? foreign_relation('dealer_info','dealer_code_eng', 'concat(dealer_code_eng,"[",dealer_name_e,"]")',$dealerAll->dealer_code,'1');?>
              </datalist>
			
          </div>
        </div>
      </div>

   <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Serial No(eng):</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
		  <?
		  $user=$_SESSION['user']['id'];
			$currentYear = date("Y"); // Full year (e.g., 2025)
			
			// Check the highest token number for the current year
			$existingToken = find_a_field('sr_token','MAX(serial_number)','token_year = '.$currentYear.' and entry_by='.$user.' ');
			
			// If exists, increment; otherwise start from 1
			$nextToken = ($existingToken) ? $existingToken + 1 : 1;
			
			$token_no = $nextToken;
			
			
			?>

			
			

            <input name="serial_number" style="color:#6666FF; font-weight:bold; font-size:20px !important;" type="text" id="serial_number" tabindex="2" value="<?=$token_no?>" />

          </div>
        </div>
      </div>
	  
	  
        
	  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
          <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Booking No:</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
              <!--<input name="booking_number" style="color:#6666FF; font-weight:bold; font-size:20px !important;" type="text" list="bookings" required="required" id="booking_number" tabindex="2" value="<?=$booking_number?>" />-->
			  <select name="booking_number" id="booking_number" style="color:#6666FF; font-weight:bold; font-size:20px !important;" tabindex="3">
			  	<? foreign_relation('paid_booking','booking_number_eng','booking_number_eng',$booking_number,'booking_year='.$currentYear.' and agent_id='.$dealer_code_eng);?>
			  </select>
            </div>
          </div>
        </div>
      <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Agent Name (Bengali):</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="agent_name" type="text" id="agent_name" required="required" readonly="readonly" tabindex="4" value="<?=$dealerAll->dealer_name_e?>" />
          </div>
        </div>
      </div>
	  
	        
      <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Agent Village (Bengali):</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="area" type="text" id="area"  readonly="readonly" value="<?=$dealerAll->address_e?>" tabindex="5" />
          </div>
        </div>
      </div>
	  
	   <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Quantity:(eng)</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="quantity" type="text" required="required" id="quantity" tabindex="6"  value="<?=$quantity?>" />
          </div>
        </div>
      </div>
     <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Farmer Name (Bengali):</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="farmer_name" type="text" id="farmer_name" tabindex="7" value="<?=$farmer_name?>" />
          </div>
        </div>
      </div>
	  
	        
      <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Farmer Village (Bengali):</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="village" type="text" id="village" tabindex="8" value="<?=$village?>" />
          </div>
        </div>
      </div>
      
    </div>
