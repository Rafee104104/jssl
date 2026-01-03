<?php
session_start();
require_once "../../../assets/template/layout.top.php";
@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');
$str = $_POST['data'];
$data=explode('##',$str);
 
$booking_no = $data[0];

preg_match('/([^\/]*)\//', $booking_no, $matches);
$dealerId = $matches[1];






?>


 <div class="form-group row m-0 pb-1">
              <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text ">Agent</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
               
                <select  name="dealer_code" id="dealer_code"  >
            
                  <? foreign_relation('dealer_info','dealer_code','dealer_name_e',$dealerId,'dealer_code_eng="'.$dealerId.'"');?>
				  
                </select>
              </div>
            </div>



