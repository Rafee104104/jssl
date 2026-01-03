<?php


session_start();


require_once "../../../assets/template/layout.top.php";


@ini_set('error_reporting', E_ALL);


@ini_set('display_errors', 'Off');


$str = $_POST['data'];


$data=explode('##',$str);

 $dealer_code2=$data[1];
 $booking_type = $data[0];
 
 $fc = substr($booking_type,0,1);
 
   
$dealerAll = find_all_field('dealer_info','*','dealer_code_eng='.$data[1]);



?>

<div class="row" id="agent_name_find">
 
  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
    <div class="form-group row m-0">
      <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text"> Agent No:</label>
      <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
        <select name="agent_id" required="required" id="agent_id" style="width:95%; font-size:12px;" >
          <option></option>
          <? foreign_relation('dealer_info','dealer_code_eng','concat(dealer_code_eng,"[",dealer_name_e,"]")',$dealerAll->dealer_code_eng,'1');?>
        </select>
        <input type="hidden" name="agent_id_b" value="<?=$dealerAll->dealer_code2?>"  />
      </div>
    </div>
  </div>
  
   <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
    <div class="form-group row m-0">
      <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text"> Booking type:</label>
      <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
        <select name="booking_type" required="required" id="booking_type" style="width:95%; font-size:12px;" onchange="getData2('agent_name_ajax.php', 'agent_name_find', this.value,  document.getElementById('agent_id').value);" >
          <option><?=$booking_type?></option>
          <? foreign_relation('dealer_type','dealer_type','dealer_type','booking_type='.$booking_type,'1');?>
        </select>
      </div>
    </div>
  </div>
  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
    <div class="form-group row m-0">
      <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text"> Booking No:</label>
      <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
        <input name="booking_number_eng" type="text" id="booking_number_eng" readonly=""  value="<? echo $dealerAll->dealer_code_eng.'/'.'26'.'/'.$fc.'-'.(find_a_field('paid_booking','count(booking_id)','booking_type="'.$booking_type.'" and agent_id='.$dealerAll->dealer_code_eng)+1);?>" />
      </div>
    </div>
  </div>
  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
    <div class="form-group row m-0">
      <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text"> Booking Date:</label>
      <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
        <input name="booking_date" required="required" type="date" id="booking_date"   value="<?=$booking_date?>" />
      </div>
    </div>
  </div>
  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
    <div class="form-group row m-0">
      <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text req-input">Agent Name:</label>
      <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0"><span id="agent_name_find">
        <input name="name" required="required" id="name" style="width:95%; font-size:12px;" tabindex="9" type="text" value="<?=$dealerAll->dealer_name_e?>">
        </span> </div>
    </div>
  </div>
  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
    <div class="form-group row m-0">
      <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text">Father/Husband Name:</label>
      <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
        <input name="father_name" id="father_name" required type="text" value="<?=$dealerAll->father_name?>">
      </div>
    </div>
  </div>
  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
    <div class="form-group row m-0">
      <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text">Mobile:</label>
      <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
        <input name="mobile_no" required="required" id="mobile_no" style="width:95%; font-size:12px;" tabindex="9" type="text" value="<?=$dealerAll->contact_no?>">
      </div>
    </div>
  </div>
  <!--  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
          <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text">NID No: </label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
			 <input name="nid" required="required" id="nid" style="width:95%; font-size:12px;" tabindex="9" type="text" value="<?=$dealerAll->
  nid?>"> </div>
</div>
</div>
-->
<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
  <div class="form-group row m-0">
    <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex vendor_label_text justify-content-start align-items-center pr-1 bg-form-titel-text"> District:</label>
    <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
      <input  name="district" id="district" tabindex="9" type="text" value=" <?=find_a_field('branch','BRANCH_NAME','BRANCH_ID='.$dealerAll->region_code)?>" />
    </div>
  </div>
</div>
<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
  <div class="form-group row m-0">
    <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex vendor_label_text justify-content-start align-items-center pr-1 bg-form-titel-text">Thana:</label>
    <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0"> <span id="dealer_zone_find">
      <input name="thana" id="thana" type="text" value="<?=find_a_field('zon','ZONE_NAME','ZONE_CODE="'.$dealerAll->zone_code.'"');?>" >
      </span> </div>
  </div>
</div>
<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
  <div class="form-group row m-0">
    <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex vendor_label_text justify-content-start align-items-center pr-1 bg-form-titel-text">Post:</label>
    <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0"> <span id="dealer_area_find">
      <input name="post" id="post" tabindex="9" type="text" value="<?=find_a_field('area','AREA_NAME','AREA_CODE="'.$dealerAll->area_code.'"');?>">
      </span> </div>
  </div>
</div>
<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
  <div class="form-group row m-0">
    <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text req-input">Village:</label>
    <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
      <input name="village" id="village" style="width:95%; font-size:12px;" tabindex="9" type="text" value="<?=$dealerAll->address_e?>">
    </div>
  </div>
</div>
<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
  <div class="form-group row m-0">
    <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text req-input">Rate:</label>
    <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
      <input name="booking_rate" type="text" id="booking_rate" tabindex="14"   onkeyup="count()"  value="<?=$booking_rate?>" />
    </div>
  </div>
</div>
<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
  <div class="form-group row m-0">
    <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text req-input">Quantity:</label>
    <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
      <input name="bag_quantity" type="text" id="bag_quantity" tabindex="14" onkeyup="count()"  value="<?=$bag_quantity?>" />
    </div>
  </div>
</div>
<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
          <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text req-input">Total Amount:</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
              <input name="total_amount" type="text" id="total_amount" tabindex="14" maxlength="100"   />
            </div>
          </div>
        </div>
	
	<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
          <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text ">Bank/Cash:</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
              <select name="cash_ledger" id="cash_ledger" tabindex="14"    >
			  	<option></option>
				<? foreign_relation('accounts_ledger','ledger_id','ledger_name',$cash_ledger,'ledger_group_id in (1224001,1226001)');?>
			  
			  </select>
            </div>
          </div>
        </div>	
		
		<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
          <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text req-input">Labour Charge:</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
              <input name="labour_charge" type="text" id="labour_charge" tabindex="14" onkeyup="count()"  value="<?=$labour_charge?>"  />
            </div>
          </div>
        </div>
		
		
		<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
          <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text req-input">Bag Rate:</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
              <input name="bag_rate" type="text" id="bag_rate" tabindex="14"   value="<?=$bag_rate?>"   />
            </div>
          </div>
        </div>
		
		
		<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
          <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text req-input">Per Kg Price:</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
              <input name="per_kg_price" type="text" id="per_kg_price" tabindex="14"   value="<?=$per_kg_price?>"  />
            </div>
          </div>
        </div>
<?php /*?><div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
  <div class="form-group row m-0">
    <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text req-input">Status: </label>
    <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
      <select name="status" id="status" required="required">
        <option value="<?=$status?>">
        <?=$status?>
        </option>
        <option value="ACTIVE">ACTIVE</option>
        <option value="INACTIVE">INACTIVE</option>
      </select>
    </div>
  </div>
</div><?php */?>
</div>
