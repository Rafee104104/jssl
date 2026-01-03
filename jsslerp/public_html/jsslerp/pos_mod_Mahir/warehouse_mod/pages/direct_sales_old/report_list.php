<?php
require_once "../../../assets/template/layout.top.php";
$title='Direct Sales Report';

do_calander("#f_date");
do_calander("#t_date");
?>

<div class="d-flex justify-content-center">
    <form class="n-form1 pt-4" action="master_report.php" method="post" name="form1" target="_blank" id="form1">
        <div class="row m-0 p-0">
            <div class="col-sm-5">
                <div align="left">Select Report </div>
                
                
                
                <div class="form-check">
                    <input name="report" type="radio" class="radio1" id="report1-btn" value="101" checked="checked" />
                    <label class="form-check-label p-0" for="report1-btn">
                        Direct Sales Chalan List(101)
                    </label>
                </div>
                
                <div class="form-check">
                    <input name="report" type="radio" class="radio1" id="report1-btn" value="102" />
                    <label class="form-check-label p-0" for="report1-btn">
                        Item Wise Report(102)
                    </label>
                </div>
                
                
               




</div>

           
         
           
            <div class="col-sm-7">
                
                <div class="form-group row m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">Product name:</label>
                    <div class="col-sm-8 p-0">
                        <select name="item_id" id="item_id" class="form-control">
                        	<option></option>
                      
							<? foreign_relation('item_info','item_id','item_name',$item_id);?>
                   		 </select>
                    </div>
                </div>


                <div class="form-group row m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">From:</label>
                    <div class="col-sm-8 p-0">
                      <span class="oe_form_group_cell">
                        	<input  name="f_date" type="text" id="f_date" value="<?=date('Y-m-01')?>" required autocomplete="off" / class="form-control">
                      </span>

                    </div>
                </div>

                <div class="form-group row m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">To:</label>
                    <div class="col-sm-8 p-0">

                        <span class="oe_form_group_cell">
                            <input  name="t_date" type="text" id="t_date" value="<?=date('Y-m-d')?>" required autocomplete="off" / class="form-control">

                        </span>


                    </div>
                </div>
                
                
                <div class="form-group row m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">Warehouse:</label>
                    <div class="col-sm-8 p-0">

                        <span class="oe_form_group_cell">
                            <select name="warehouse_id" id="warehouse_id">
                      <option></option>
					  <? foreign_relation('warehouse','warehouse_id','warehouse_name','','use_type=!"PL"');?>
                      
                      <option value="68">HFML</option>
                      <option value="5">HFL</option>
                    </select>

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



 </tr>

<?
require_once "../../../assets/template/layout.bottom.php";
?>