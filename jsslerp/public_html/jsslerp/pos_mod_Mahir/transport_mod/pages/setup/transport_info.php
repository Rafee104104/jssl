<?php
require_once "../../../assets/template/layout.top.php";
do_calander('#issue_date');
do_calander('#exp_date');
do_calander('#rec_date');
do_calander('#ins_start_date');
do_calander('#ins_end_date');



// ::::: Edit This Section ::::: 
$title='Transport Information' ; 		// Page Name and Page Title
$page="transport_info.php";		// PHP File Name

//$table='vehicle_info';		// Database Table Name Mainly related to this page
//$unique='vehicle_id';			// Primary Key of this Database table
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-7">

            <div class="container n-form1">
			
			<table id="table_head" class="table1 table-striped table-bordered table-hover table-sm dataTable no-footer" role="grid" aria-describedby="table_head_info">
				<thead class="thead1">
					<tr class="bgc-info" role="row">
						<th>Driver Name </th>
						<th>Driver Address </th>
						<th>Driver Mobile </th>
						<th>Driver Code </th>
						<th>Driver Type </th>
						<th>status </th>
					</tr>
				</thead>

				<tbody class="tbody1">
					<tr>
						<td>hello1</td>
					</tr>
				</tbody>
			</table>
				
				

            </div>

        </div>


        <div class="col-sm-5">
		<form class="n-form" action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check()">
			
                <h4 align="center" class="n-form-titel1"> Transport Information</h4>

                <div class="form-group row m-0 pl-3 pr-3 p-1">
                    <label for="group_name" class="req-input col-sm-5 pl-0 pr-0 col-form-label ">  Driver Name: </label>
                    <div class="col-sm-7 p-0">
									
                        				<input name="driver_name" required="" type="text" id="driver_name" tabindex="1" value="" >	
										
										
						
                    </div>
                </div>
				


                <div class="form-group row m-0 pl-3 pr-3 p-1">
                    <label for="group_name" class="req-input col-sm-5 pl-0 pr-0 col-form-label "> Driver Address : </label>
                    <div class="col-sm-7 p-0">
						
						<input name="driver_address" required="" type="text" id="driver_address" tabindex="1" value="" >	
                    </div>
                </div>
				

                <div class="form-group row m-0 pl-3 pr-3 p-1">
                    <label for="group_name" class="req-input col-sm-5 pl-0 pr-0 col-form-label "> Driver Mobile: </label>
                    <div class="col-sm-7 p-0">
						<input name="driver_mobile" required="" type="text" id="driver_mobile" tabindex="1" value="" >	
                    </div>
                </div>
				

                <div class="form-group row m-0 pl-3 pr-3 p-1">
                    <label for="group_name" class="req-input col-sm-5 pl-0 pr-0 col-form-label ">Driver Code: </label>
                    <div class="col-sm-7 p-0">
						<input name="driver_code" required="" type="text" id="driver_code" tabindex="1" value="" >	
                    </div>
                </div>
				

                <div class="form-group row m-0 pl-3 pr-3 p-1">
                    <label for="group_name" class="req-input col-sm-5 pl-0 pr-0 col-form-label "> Driver Type: </label>
                    <div class="col-sm-7 p-0">
						<input name="driver_type" required="" type="text" id="driver_type" tabindex="1" value="" >	
                    </div>
                </div>
				

                <div class="form-group row m-0 pl-3 pr-3 p-1">
                    <label for="group_name" class="req-input col-sm-5 pl-0 pr-0 col-form-label "> status: </label>
                    <div class="col-sm-7 p-0">
					
					<select name="status" required="" id="status" tabindex="7">
                      <option value="ACTIVE">ACTIVE</option>    
					    <option value="INACTIVE">INACTIVE</option>                    
					  </select>
                    </div>
                </div>
				




                <div class="n-form-btn-class">

                     <input name="insert" type="submit" id="insert" value="SAVE" class="btn1 btn1-bg-submit">
                      <input name="reset" type="button" class="btn1 btn1-bg-cancel" id="reset" value="RESET" onclick="parent.location='transport_info.php'">
                    

                 
                </div>


            </form>
        </div>



</div>




<?
require_once "../../../assets/template/layout.bottom.php";
?>
