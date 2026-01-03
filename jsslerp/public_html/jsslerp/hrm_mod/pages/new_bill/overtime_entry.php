<?php
session_start();
ob_start();
require_once "../../../assets/support/inc.all.php";
do_calander("#f_date");
do_calander("#t_date");


// ::::: Edit This Section :::::
$title = 'Overtime Entry';			// Page Name and Page Title
$page = "overtime_entry.php";		// PHP File Name
$root = 'hrm';
$table = 'hrm_overtime_golden';		// Database Table Name Mainly related to this page			
$unique ='req_no';					//Unique id





//user id
$u_id=$_SESSION['user']['id'];

$PBI_ID = find_a_field('user_activity_management','PBI_ID','user_id='.$u_id);

//$sql = 'SELECT i.PBI_ID,p.PBI_CODE, p.PBI_NAME, i.total_salary FROM salary_info i,personnel_basic_info p WHERE p.PBI_ID=i.PBI_ID';


$msg = "";
  $data = 'SELECT i.PBI_ID,p.PBI_CODE, p.PBI_NAME, i.total_salary FROM salary_info i,personnel_basic_info p WHERE p.PBI_ID=i.PBI_ID';
					$query = mysql_query($data);
					$i=1;
					while($row =mysql_fetch_object($query)){
					
						if(isset($_POST['submit_'.$row->PBI_ID])){
							 $t_date = $_POST['t_date'];
							 $basic_pbi_code = $_POST['basic_pbi_code_'.$row->PBI_ID];
							 $basic_pbi_name = $_POST['basic_pbi_name_'.$row->PBI_ID];
							 $basic_salary_total = $_POST['basic_salary_total_'.$row->PBI_ID];
							 $overtime_hours = $_POST['overtime_hours_'.$row->PBI_ID];
							 $overtime_amt = $_POST['overtime_amt_'.$row->PBI_ID];
							 $overtime_amt_paid = $_POST['overtime_amt_paid_'.$row->PBI_ID];

							 $sql= "INSERT INTO hrm_overtime_golden(PBI_ID, PBI_NAME, TOTAL_SALARY, OVERTIME_HOURS, OVERTIME_BILL, OVERTIME_BILL_PAID, OVERTIME_DATE) VALUES ('".$basic_pbi_code."','".$basic_pbi_name."','".$basic_salary_total."','".$overtime_hours."','".$overtime_amt."','".$overtime_amt_paid."','".$t_date."')";
							mysql_query($sql);
						}
						
					
						if(isset($_POST['update_'.$row->PBI_ID])){
							 $t_date = $_POST['t_date'];
							 $basic_pbi_code = $_POST['basic_pbi_code_'.$row->PBI_ID];
							 $basic_pbi_name = $_POST['basic_pbi_name_'.$row->PBI_ID];
							 $basic_salary_total = $_POST['basic_salary_total_'.$row->PBI_ID];
							 $overtime_hours = $_POST['overtime_hours_'.$row->PBI_ID];
							 $overtime_amt = $_POST['overtime_amt_'.$row->PBI_ID];
							 $overtime_amt_paid = $_POST['overtime_amt_paid_'.$row->PBI_ID];

							 $sql_data= "UPDATE hrm_overtime_golden SET PBI_ID='".$basic_pbi_code."',PBI_NAME='".$basic_pbi_name."',TOTAL_SALARY='".$basic_salary_total."',OVERTIME_HOURS='".$overtime_hours."',OVERTIME_BILL='".$overtime_amt."',OVERTIME_BILL_PAID='".$overtime_amt_paid."',OVERTIME_DATE='".$t_date."' WHERE PBI_ID='".$basic_pbi_code."' ";
							mysql_query($sql_data);
						}
					}
	
?>

<div class="form-container_large">
  <form id="form1" name="form1" method="post" action="">
	  <div class="container-fluid pt-0 p-0">
	   <div class="n-form-btn-class d-flex justify-content-center">
	   <div class="container p-0" style="width:40%; background-color: #e9e9e9;">
	   			<p align="center" class="bold  bg-titel "> Please Select Date</p>
            <div class="form-group row m-0 d-dlx p-3">

              <label class="col-sm-8 col-md-8 col-lg-8 col-xl-8  m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> 
			  
				<input  name="t_date" type="text" id="t_date" value="<?php if($_POST['t_date']!=''){echo $_POST['t_date'];}else { }?>" autocomplete="off" required/>
			  
			  </label>
              <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 p-0">               
				             <input name="submit1" type="submit" class="btn2 btn1-bg-update" value="Select">

              </div>
            </div>
		</div>

      </div>
	  
	  
	  <script>
	  function cus_overtime(id){
	  var basic_salary=(document.getElementById("basic_salary_"+id).value)*1;
	  var overtime_hours=(document.getElementById("overtime_hours_"+id).value)*1;
		var one_day_salary=basic_salary/30;
		var per_hour_salary=one_day_salary/10;
		var over_time_value=per_hour_salary*overtime_hours;
		document.getElementById("overtime_amt_"+id).value=over_time_value.toFixed(2);
		
	  var overtime_amt_paid =(document.getElementById("overtime_amt_paid_"+id).value)*1;
	  var overtime_paid = over_time_value - overtime_amt_paid;
	  document.getElementById("overtime_amt_due_"+id).value=overtime_paid.toFixed(2);
	  
	  
	  }
	  </script>
	  
	  
	  
	  <table class="table1  table-striped table-bordered table-hover table-sm">
                    <thead class="thead1">
                    <tr class="bgc-info">
						<th>SL No</th>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
						<th>Salary</th>
						<th width="13%">Overtime Hours</th>
                        <th>Overtime Bill </th>
						<!--<th>Breakfast Bill </th>-->
                        <th>Bill Paid</th>
                        <th>Due Bill</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody class="tbody1">
					
				<?  $data = 'SELECT i.PBI_ID,p.PBI_CODE, p.PBI_NAME, i.total_salary FROM salary_info i,personnel_basic_info p WHERE p.PBI_ID=i.PBI_ID';
					$query = mysql_query($data);
					$i=1;
					while($row =mysql_fetch_object($query)){
					 $all_overtime_info=find_all_field('hrm_overtime_golden','*',' PBI_ID="'.$row->PBI_CODE.'" and OVERTIME_DATE="'.$_POST['t_date'].'"');
					// echo 'select * from hrm_overtime_golden where PBI_ID="'.$row->PBI_CODE.'" and OVERTIME_DATE="'.$_POST['t_date'].'"';
					
				?>
					<tr>
					    <td><?=$i++;?></td>
						<td><input type="hidden" name="basic_pbi_code_<?=$row->PBI_ID;?>"  id="basic_pbi_code_<?=$row->PBI_ID;?>" value="<?=$row->PBI_CODE;?>" />
						<?=$row->PBI_CODE;?></td>
						<td>
						<input type="hidden" name="basic_pbi_name_<?=$row->PBI_ID;?>"  id="basic_pbi_name_<?=$row->PBI_ID;?>" value="<?=$row->PBI_NAME;?>" />
						<?=$row->PBI_NAME;?></td>
						<td>
						<input type="hidden" name="basic_salary_total_<?=$row->PBI_ID;?>"  id="basic_salary_total_<?=$row->PBI_ID;?>" value="<?=$row->total_salary;?>" />
						<?=$row->total_salary;?>						
						</td>
						
						<td> 
						
								<input type="hidden" name="basic_salary_<?=$row->PBI_ID?>"  id="basic_salary_<?=$row->PBI_ID?>" value="<?=$row->total_salary;?>" />		
								<select id="overtime_hours_<?=$row->PBI_ID?>" name="overtime_hours_<?=$row->PBI_ID?>" onchange="cus_overtime(<?=$row->PBI_ID?>)">
								<?php 
								if($all_overtime_info->OVERTIME_HOURS>0){
								?>
									<option value="<?=$all_overtime_info->OVERTIME_HOURS?>"><?=$all_overtime_info->OVERTIME_HOURS?></option>
									<?php } else { ?>
									<option >-- select please --</option>
									<?php } ?>
									<option value="1">1 hour</option>
									<option value="2" >2 hour</option>
									<option value="3">3 hour</option>
									<option value="4">4 hour</option>
									<option value="5">5 hour</option>
									<option value="6">6 hour</option>
									<option value="7">7 hour</option>
									<option value="8">8 hour</option>
									<option value="9">9 hour</option>
									<option value="10">10 hour</option>
									<option value="11">11 hour</option>
									<option value="12">12 hour</option>
								</select>					  </td>
					  <td><input type="text" name="overtime_amt_<?=$row->PBI_ID?>" id="overtime_amt_<?=$row->PBI_ID?>" value="<?=$all_overtime_info->OVERTIME_BILL?>" /></td>
					  
<?php /*?>						<td> 
						
						<?php
							$total_salary = $row->total_salary;
							
							if($total_salary >= 50000){
							  $total_breakfast = 100;
							 }	
							 elseif($total_salary >= 16000 || $total_salary >= 18000  ){
							  $total_breakfast = 30;
							 }
							 elseif($total_salary >= 11000){
							  $total_breakfast = 20;
							 }
							 
							?>
							
							<?php
		
						
						 ?>
						
						<input type="text" name="breakfast_amt_<?=$row->PBI_ID?>" id="breakfast_amt_<?=$row->PBI_ID?>" value="<?=$total_breakfast;?>" />
						
						
						</td><?php */?>
						
						
							<td> <input type="text" name="overtime_amt_paid_<?=$row->PBI_ID?>" onkeyup="cus_overtime(<?=$row->PBI_ID?>)" id="overtime_amt_paid_<?=$row->PBI_ID?>" value="<?=$all_overtime_info->OVERTIME_BILL_PAID?>" /> </td>

							<td> 							
							<?php 
							$total = $all_overtime_info->OVERTIME_BILL;
							$paid = $all_overtime_info->OVERTIME_BILL_PAID;
							$due = $total-$paid;
							?>
							<input type="text" name="overtime_amt_due_<?=$row->PBI_ID?>" id="overtime_amt_due_<?=$row->PBI_ID?>" value="<?=$due?>" /> </td>
							<td>
															<?php 
								if($all_overtime_info->OVERTIME_HOURS>0){
								?>
								<button name="update_<?=$row->PBI_ID?>" id="update_<?=$row->PBI_ID?>" type="submit" class="btn2 btn1-bg-update"><i class="fa-solid fa-pen-to-square"></i></button>
									<?php } else { ?>
											<input name="submit_<?=$row->PBI_ID?>" type="submit"  id="submit_<?=$row->PBI_ID?>" class="btn2 btn1-bg-submit" value="Submit"/>
									<?php } ?>
									

								
															</td>
					</tr>
					
					<?php
					}	
					?>
                    </tbody>
                </table>
	  
	  
	  
	  
	  
	  
	  
	
	  </div>
  </form>
</div>



<?

$main_content=ob_get_contents();

ob_end_clean();

include ("../../template/main_layout.php");
?>

