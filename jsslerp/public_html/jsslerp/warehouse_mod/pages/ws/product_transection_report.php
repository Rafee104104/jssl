<?php
require_once "../../../assets/template/layout.top.php";
$title='BIN Card Reports';

do_calander("#f_date");
do_calander("#t_date");
create_combobox('item_id');

$tr_type="Show";

$tr_from="Warehouse";

?>


<div class="d-flex justify-content-center">
    <form class="n-form1 fo-width pt-4" action="product_transection_report_master.php" method="post" name="form1" target="_blank" id="form1">
        <div class="row m-0 p-0">
            <div class="col-sm-5">
                <div align="left">Select Report </div>
                <div class="form-check">
                    <input name="report" type="radio" class="radio1" id="report1-btn" value="3" checked="checked" tabindex="1"/>
                    <label class="form-check-label p-0" for="report1-btn">
                        BIN Card Detail (Date Wise)(3)
                    </label>
                </div>
				<div class="form-check">
                    <input name="report" type="radio" class="radio1" id="report1-btn1" value="5" tabindex="1"/>
                    <label class="form-check-label p-0" for="report1-btn1">
                        BIN Card(Finish Goods)(5)
                    </label>
                </div>
				<div class="form-check">
                    <input name="report" type="radio" class="radio1" id="report1-btn2" value="1"  tabindex="1"/>
                    <label class="form-check-label p-0" for="report1-btn2">
                        BIN Card (Posting Wise)(1)
                    </label>
                </div>
				<div class="form-check">
                    <input name="report" type="radio" class="radio1" id="report1-btn3" value="4"  tabindex="1"/>
                    <label class="form-check-label p-0" for="report1-btn3">
                        BIN Card With SR NO(4)
                    </label>
                </div>
				<div class="form-check">
                    <input name="report" type="radio" class="radio1" id="report1-btn4" value="2"  tabindex="1"/>
                    <label class="form-check-label p-0" for="report1-btn4">
                        Product Transection Report Summary(2)
                    </label>
                </div>
               

            </div>

            <div class="col-sm-7">
                

                <div class="form-group row m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">Product Name:</label>
                    <div class="col-sm-8 p-0">
                        <select  name="item_id" id="item_id" class="form-control"/>
						
                        	<option></option>
                      
							<? foreign_relation('item_info','item_id','item_name',$item_id,'1');?>
                   		 </select>
                    </div>
                </div>


                <div class="form-group row m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">From Date:</label>
                    <div class="col-sm-8 p-0">
                      <span class="oe_form_group_cell">
                        	<input  name="f_date" type="text" id="f_date" value="<?=date('Y-m-01')?>" required autocomplete="off" / class="form-control">
                      </span>

                    </div>
                </div>

                <div class="form-group row m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">To Date:</label>
                    <div class="col-sm-8 p-0">

                        <span class="oe_form_group_cell">
                            <input  name="t_date" type="text" id="t_date" value="<?=date('Y-m-d')?>" required autocomplete="off" / class="form-control">

                        </span>


                    </div>
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