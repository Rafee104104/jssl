<?php
session_start();
require_once "../../../assets/support/inc.all.php";
@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');


$str = $_POST['data'];


$data=explode('##',$str);

 $sr=find_all_field('warehouse_other_receive','receipt_number','receipt_number="'.$data[0].'" ');



?>

			<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 ">
          <div class="container n-form2" id="receipt_number">
            <fieldset>
            
            <div class="form-group row m-0 pb-1">
              <label for="" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Receipt No :</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input  name="receipt_number" type="text" id="receipt_number" onkeyup="bagMark(this.value)" value="<?=find_a_field('warehouse_other_receive','receipt_number','1 order by receipt_number desc')+1;?>" required/>
              </div>
            </div>
         
			<div class="form-group row m-0 pb-1">
              <label for="" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Bag Mark:</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input  name="bag_mark" type="text" id="bag_mark" value="<?=$bag_mark?>" required/>
              </div>
            </div>

            <div class="form-group row m-0 pb-1">
              <label for=" " class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Labour Charge:</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input  name=" labour_charge" type="text" id="labour_charge " value="<?=$labour_charge?>" required/>
              </div>
            </div>
            
            <div class="form-group row m-0 pb-1">
              <label for=""class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Date:</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input  name="or_date" type="text" id="or_date" value="<?=$or_date?>" readonly="readonly" required/>
              </div>
            </div>
            
            </fieldset>
          </div>
        </div>
			
<script>
	function bagMark(val){
		var qty = document.getElementById('qty').value*1;
		var bagM = val+'/'+qty;
		document.getElementById('bag_mark').value = bagM;
		
	}
	</script>
			
			
            