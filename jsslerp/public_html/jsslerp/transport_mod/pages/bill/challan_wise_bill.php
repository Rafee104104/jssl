<?php
require_once "../../../assets/template/layout.top.php";
do_calander("#f_date");
do_calander("#t_date");




// ::::: Edit This Section ::::: 
$unique='t_id';  		// Primary Key of this Database table
$title='Challan Wise Bill' ; 	// Page Name and Page Title
$page="bill_entry.php";		// PHP File Name
$table='transport_bill_issue';		// Database Table Name Mainly related to this page

$crud      =new crud($table);
$$unique = $_GET[$unique];
//user id
$u_id=$_SESSION['user']['id'];

$PBI_ID = find_a_field('user_activity_management','PBI_ID','user_id='.$u_id);

//for submit..................................
  $data = 'SELECT * FROM transport_info WHERE 1';
					$query = mysql_query($data);
					$i=1;
					while($row =mysql_fetch_object($query)){
					
						if(isset($_POST['submit_'.$row->transport_id])){
							 $t_date = $_POST['t_date'];
							 $t_id = $_POST['t_id_'.$row->transport_id];
							 $fuel_cost = $_POST['fuel_cost_'.$row->transport_id];
							 $repair_cost = $_POST['repair_cost_'.$row->transport_id];
							 $other_cost = $_POST['other_cost_'.$row->transport_id];
							 $totel_cost = $_POST['totel_cost_'.$row->transport_id];
							 
							 $sql =" INSERT INTO transport_bill_issue(t_id, issue_date, fuel_cost, repair_cost, other_cost, totel_cost) VALUES ('".$t_id."', '".$t_date."', '".$fuel_cost."', '".$repair_cost."', '".$other_cost."', '".$totel_cost."')";
							mysql_query($sql);
						}

//for update..................................
					
						if(isset($_POST['update_'.$row->transport_id])){
							 $t_date = $_POST['t_date'];
							 $t_id = $_POST['t_id_'.$row->transport_id];
							 $fuel_cost = $_POST['fuel_cost_'.$row->transport_id];
							 $repair_cost = $_POST['repair_cost_'.$row->transport_id];
							 $other_cost = $_POST['other_cost_'.$row->transport_id];
							 $totel_cost = $_POST['totel_cost_'.$row->transport_id];

							 $sql_data = "UPDATE transport_bill_issue SET t_id='".$t_id."', issue_date='".$t_date."', fuel_cost='".$fuel_cost."', repair_cost='".$repair_cost."', other_cost='".$other_cost."', totel_cost='".$totel_cost."' WHERE t_id='".$t_id."' ";
							mysql_query($sql_data);
						}
					}




	
if(isset($$unique))
{
$condition=$unique."=".$$unique;	
$data=db_fetch_object($table,$condition);
while (list($key, $value)=each($data))

{ $$key=$value;}

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
	  function cus_bill(id){
	  	var fuel_cost=(document.getElementById("fuel_cost_"+id).value)*1;
	  	var repair_cost=(document.getElementById("repair_cost_"+id).value)*1;
	  	var other_cost=(document.getElementById("other_cost_"+id).value)*1;

		var totel=fuel_cost+repair_cost+other_cost;
		document.getElementById("totel_cost_"+id).value=totel.toFixed(2);
	  }
	  </script>
	  
	  <table class="table1  table-striped table-bordered table-hover table-sm">
                    <thead class="thead1">
                    <tr class="bgc-info">
						<th>SL No</th>
                        <th>Transport ID</th>
						<th>Transport Number</th>
                        <th>transport Name</th>
						<th>Fuel Cost</th>
						<th>Repair Cost</th>
                        <th>Other Cost</th>
                        <th>Totel Cost</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody class="tbody1">
					<?  $data = "SELECT * FROM transport_info WHERE 1"; 
						$query = mysql_query($data);
						$i=1;
						while($row =mysql_fetch_object($query)){
						$all_bill_info=find_all_field('transport_bill_issue','*',' t_id="'.$row->transport_id.'" and issue_date="'.$_POST['t_date'].'"');
					?>
						<tr>
							<td><?=$i++;?></td>
							<td>
							<input type="hidden" id="t_id_<?=$row->transport_id;?>" name="t_id_<?=$row->transport_id;?>" value="<?=$row->transport_id;?>"/>
							<?=$row->transport_id;?>
							</td>
							<td><?=$row->transport_number;?></td>
							<td><?=$row->transport_name;?></td>
							<td><input type="text" id="fuel_cost_<?=$row->transport_id;?>" name="fuel_cost_<?=$row->transport_id;?>" value="<?=$all_bill_info->fuel_cost?>" onchange="cus_bill(<?=$row->transport_id?>)"/></td>
							<td><input type="text" id="repair_cost_<?=$row->transport_id;?>" name="repair_cost_<?=$row->transport_id;?>" value="<?=$all_bill_info->repair_cost?>" onchange="cus_bill(<?=$row->transport_id?>)"/></td>
							<td><input type="text" id="other_cost_<?=$row->transport_id;?>" name="other_cost_<?=$row->transport_id;?>" value="<?=$all_bill_info->other_cost?>" onchange="cus_bill(<?=$row->transport_id?>)"/></td>
							<td><input type="text" id="totel_cost_<?=$row->transport_id;?>" name="totel_cost_<?=$row->transport_id;?>" value="<?=$all_bill_info->totel_cost?>"/></td>
							<td>
							
							<?php 
								if($all_bill_info->totel_cost>0){
								?>
							<button name="update_<?=$row->transport_id?>" id="update_<?=$row->transport_id?>" type="submit" class="btn2 btn1-bg-update"><i class="fa-solid fa-pen-to-square"></i></button>
									<?php } else { ?>
											<input name="submit_<?=$row->transport_id;?>" type="submit" id="submit_<?=$row->transport_id;?>" class="btn2 btn1-bg-submit" value="Submit">
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
require_once "../../../assets/template/layout.bottom.php";
?>

