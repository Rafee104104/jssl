<?php

require_once "../../../assets/template/layout.top.php";
$title='Unload Entry';
$ip=$_SESSION['user']['ip'];

$php_ip=substr($_SESSION['php_ip'],0,11);

if($php_ip=='115.127.35.' || $php_ip=='115.127.24.' || $php_ip=='192.168.191'){ 
	do_calander('#f_date'/*,'-1900','0'*/);
	do_calander('#t_date'/*,'-1900','30'*/);
} else {
	do_calander('#f_date'/*,'-60','0'*/);
	do_calander('#t_date'/*,'-60','30'*/);		
}
$table_master='sale_do_master';

$unique_master='do_no';
$master = find_all_field('sale_do_master','','do_no='. $_GET['do_no']);
auto_complete_from_db('item_info','item_name','item_id','1','item_id');

$tr_type="Show";

$tr_from="Warehouse";
?>

<div class="form-container_large">
<form action="<?=$page?>" method="post" name="codz2" id="codz2">
  <!--        top form start hear-->
  <div class="container-fluid bg-form-titel">
    <div class="row">
      <!--left form-->
      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <div class="container n-form2">
          <div class="form-group row m-0 pb-1">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Order No</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
              <input name="do_no" type="text" id="do_no" value="<? if($$unique_master>0) echo $$unique_master; else echo (find_a_field($table_master,'max('.$unique_master.')','1')+1);?>" readonly/>
              <input name="group_for" type="hidden" id="group_for" required readonly="" value="<?=$_SESSION['user']['group']?>" tabindex="105" />
            </div>
          </div>
          <? if($do_date=="") {?>
          <div class="form-group row m-0 pb-1">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Order Date</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
              <input name="do_date" type="text" id="do_date" value="<?=($do_date!='')?$do_date:date('Y-m-d')?>"  required />
            </div>
          </div>
          <? }?>
          <? if($do_date!="") {?>
          <div class="form-group row m-0 pb-1">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Order Date</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
              <input name="do_date" type="hidden" id="do_date" value="<?=$do_date;?>"  required/>
              <input name="do_date2" type="text" id="do_date2" value="<?=$do_date;?>" readonly="" required/>
            </div>
          </div>
          <? }?>
          <?php /*?>   <div class="form-group row m-0 pb-1">
              <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Warehouse</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <select  id="depot_id" name="depot_id" class="form-control">
                  <? foreign_relation('warehouse','warehouse_id','warehouse_name',$depot_id,'warehouse_id="'.$_SESSION['user']['depot'].'"');?>
                </select>
              </div>
            </div><?php */?>
          <div class="form-group row m-0 pb-1">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Remarks</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
              <input  name="remarks" type="text" id="remarks" value="<?=$remarks;?>" />
            </div>
          </div>
        </div>
      </div>
      <!--Right form-->
      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <div class="form-group row m-0 pb-1">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Booking No</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
            <select name="booking_no" id="booking_no" onchange="getData2('arAjax.php', 'Shuvo', this.value)">
              <option>
              <?=$master->booking_no;?>
              </option>
              <? foreign_relation('paid_booking','booking_number_eng','booking_number_eng', $master->booking_no,'1');?>
            </select>
          </div>
        </div>
        <span id="Shuvo">
        <div class="form-group row m-0 pb-1">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text ">Customer</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
            <select  id="dealer_code" name="dealer_code" class="form-control"   >
              <?
				
				 if ($master->dealer_code>0)  { 

    
                        preg_match('/([^\/]*)\//',$master->dealer_code, $matches);
                      $master->dealer_code = $matches[1];
    
				?>
              <? foreign_relation('dealer_info','dealer_code','dealer_name_e',$dealer_code,'1');?>
              <? }else{?>
              <option></option>
              <?php } ?>
            </select>
           </div>
        </div>
		
		<div class="form-group row m-0 pb-1">
        
			     <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text ">SR NO</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
               
                <select  name="sr_number" id="sr_number"  onblur="" >
            
                <? foreign_relation('sr_token','sr_number','sr_number',$sr_no,'booking_number="'.$booking_no.'"');?>
				  
                </select>
              </div>
          </div>
        </div>
		</span>
      </div>
    </div>
  </div>
  </div>
</form>
</div>

<?

require_once "../../../assets/template/layout.bottom.php";

?>
