<?php
session_start();
require_once "../../../assets/support/inc.all.php";
@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');


$str = $_POST['data'];


$data=explode('##',$str);

 $booking_number_eng=$data[0];
 $booking_no = $data[1];
 
 
 
   
$dealerAll = find_all_field('paid-booking','*','booking_number_eng="'.$data[0].'" ');


?>
<input name="stk" type="text" class="input3" id="stk" style="width:50px;" readonly="readonly" required="required" value="<?=$stock?>" onfocus="focuson('rate')"/>
<input name="unit_name" type="text" class="input3" id="unit_name" style="width:50px;" value="<?=$item_all->unit_name?>" readonly required onfocus="focuson('rate')"/>
<input name="rate" type="text" class="input3" id="rate"  maxlength="100" style="width:50px;" onchange="count()" value="<?=$item_all->cost_price?>"   required/>

<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6" >
          <div class="container n-form2" id="agent_name_find">
            <fieldset>
            
            <div class="form-group row m-0 pb-1">
              <label for=" " class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Booking No:</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input name="booking_no" type="text" list="booking_nos" id="booking_no" value="<?=$booking_number_eng?>"  onblur="getData2('or_receive_ajax.php', 'agent_name_find', this.value,  document.getElementById('booking_no').value);" />
                <datalist id="booking_nos">
                  <? foreign_relation('paid_booking','booking_number_eng',$booking_number_eng,'status like "Active"');?>
                </datalist>
              </div>
            </div> 
            <div class="form-group row m-0 pb-1">
              <label for=" " class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Name :</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input name="agent_name" type="text"  id="agent_name" value="<?=$dealerAll->dealer_name_e?>"  />
              </div>
            </div> 
            <div class="form-group row m-0 pb-1">
              <label for=" " class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Father/Husband :</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input  name=" father_name" type="text" id="father_name " value="<?=$dealerAll->father_name?>" required/>
              </div>
            </div> 
            <div class="form-group row m-0 pb-1">
              <label for=" " class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">District:</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input  name="district " type="text" id="district " value="<?=$district?>" required/>
              </div>
            </div> 
            <div class="form-group row m-0 pb-1">
              <label for=" " class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Thana:</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input  name="thana " type="text" id="thana " value="<?=$thana?>" required/>
              </div>
            </div> 
            <div class="form-group row m-0 pb-1">
              <label for=" " class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Post:</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input  name="post " type="text" id="post " value="<?=$post?>" required/>
              </div>
            </div> 
            <div class="form-group row m-0 pb-1">
              <label for=" " class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Villege:</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input  name=" village" type="text" id="village " value="<?=$village?>" required/>
              </div>
            </div>
            <input  name="warehouse_id" type="hidden" id="warehouse_id" value="<?=$_SESSION['user']['depot']?>"  required/>
            <input  name="receive_type" type="hidden" id="receive_type" value="<?=$page_for?>"  required="required"/>
            </fieldset>
          </div>
        </div>