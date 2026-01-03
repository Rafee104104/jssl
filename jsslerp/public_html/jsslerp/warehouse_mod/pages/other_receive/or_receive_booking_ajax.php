<?php
session_start();
require_once "../../../assets/support/inc.all.php";
@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');


$str = $_POST['data'];


$data=explode('##',$str);

 $sr=find_all_field('sr_token','booking_number','serial_number="'.$data[0].'" and token_year="'.$data[1].'"');
 $receipt_no = $data[2];
 
$bookingAll = find_all_field('paid_booking','*','booking_number_eng like "'.$sr->booking_number.'" ');


?>

			<div class="form-group row m-0 pb-1">
              <label for=" " class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Booking No:</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input name="booking_number" style="color:#6666FF; font-weight:bold; font-size:20px !important;" type="text"  id="booking_number" value="<?=$bookingAll->booking_number_eng;?>"   />
				
				<input name="token_id" type="hidden"  id="token_id" value="<?=$sr->serial_number;?>"   />
                
              </div>
            </div>
			
			<div class="form-group row m-0 pb-1">
              <label for=" " class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Date:</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input name="or_date" type="text"  id="or_date" value="<?=$sr->date;?>"   />
                
              </div>
            </div>
			 <?
		  
			$currentYear = date("Y"); // Full year (e.g., 2025)
			
			// Check the highest token number for the current year
			$existingToken = find_a_field('sr_token','MAX(serial_number)','token_year = '.$currentYear.' ');
			
			// If exists, increment; otherwise start from 1
			$nextToken = ($existingToken) ? $existingToken + 1 : 1;
			
			$token_no = $nextToken;
			
			
			?>
			<div class="form-group row m-0 pb-1">
              <label for="" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Bag Mark:</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input  name="bag_mark" type="text" style="color:#6666FF; font-weight:bold; font-size:20px !important;" id="bag_mark" value="<?=$receipt_no.'/'.$sr->quantity;?>" required/>
				<input  name="rec_year" type="hidden" id="rec_year" value="<?=$data[1];?>" />
              </div>
            </div>
			
			<div class="form-group row m-0 pb-1">
              <label for=" " class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Qty:</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input name="qty" type="text"  id="qty"  onkeyup="counts()"  value="<?=$sr->quantity?>"   />
				<input name="rate" type="hidden" value="<?=$sr->quantity?>" />
				
                
              </div>
            </div>
			
			<div class="form-group row m-0 pb-1">
              <label for=" " class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Farmer Name :</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
			   <input name="farmer_name" type="text"  id="farmer_name" value="<?=$sr->farmer_name?>"  />

                <input name="agent_name" type="hidden"  id="agent_name" value="<?=$bookingAll->name?>"  />
              </div>
            </div> 
			
            <div class="form-group row m-0 pb-1">
<!--              <label for=" " class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Father/Husband :</label>
-->              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input  name=" father_name" type="hidden" id="father_name " value="<?=$bookingAll->father_name?>" required/>
              </div>
            </div> 
            <div class="form-group row m-0 pb-1">
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input  name="district" type="hidden" id="district" value="<?=$bookingAll->district?>" required/>
              </div>
            </div> 
            <div class="form-group row m-0 pb-1">
             <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input  name="thana" type="hidden" id="thana" value="<?=$bookingAll->thana?>" required/>
              </div>
            </div> 
            <div class="form-group row m-0 pb-1">
             <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input  name="post" type="hidden" id="post" value="<?=$bookingAll->post?>" required/>
              </div>
            </div> 
            <div class="form-group row m-0 pb-1">
              <label for=" " class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Villege:</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
			      <input  name="farmer_village" type="text" id="farmer_village" value="<?=$sr->village?>" required/>
                <input  name="village" type="hidden" id="village" value="<?=$bookingAll->village?>" required/>
              </div>
            </div>
		<?php /*?>	
			<div class="form-group row m-0 pb-1">
              <label for=" " class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Receive Quantity:</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input name="rec_qty" type="text"  id="rec_qty"  onkeyup="counts()"  value="<?=$bookingAll->rec_qty?>"   />
                
              </div>
            </div><div class="form-group row m-0 pb-1">
              <label for=" " class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Due Quantity:</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
              <input name="due_qty" type="text" id="due_qty" tabindex="14" maxlength="100"   />
                
              </div>
            </div><?php */?>
			

			
			
            