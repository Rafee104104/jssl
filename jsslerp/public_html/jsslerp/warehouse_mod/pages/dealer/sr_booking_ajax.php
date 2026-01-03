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

<div class="row"  id="sr_booking">

	
	 
	  
	  
        
	  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
          <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Booking No:</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
              <input name="booking_number" type="text" list="bookings" id="booking_number" tabindex="2" value="<?=$booking_number?>" autocomplete="off" onblur="getData2('sr_booking_ajax.php', 'agent_info', this.value,  document.getElementById('sr_number').value);"/>
			  <datalist id="bookings">
			  	<? foreign_relation('paid_booking','booking_number_eng','booking_number_eng',$booking_number,'agent_id='.$dealer_code_eng);?>
			  </datalist>
            </div>
          </div>
        </div>
		
		
		
		<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">SR Number:</label>
  <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
    <input name="sr_number" type="text" id="sr_number" list="sr_numbers" tabindex="2" value="<?=$sr_number?>" autocomplete="off"/>
	  <datalist id="sr_numbers">
	<? foreign_relation('sr_token','sr_number','sr_number',$sr_number,'dealer_code_eng='.$dealer_code_eng);?>
              </datalist>
			
    </div>
        </div></div>
		
		
		
     
  
      
    </div>
