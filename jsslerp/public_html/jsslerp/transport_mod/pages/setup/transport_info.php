<?php
require_once "../../../assets/template/layout.top.php";
do_calander('#issue_date');
do_calander('#exp_date');
do_calander('#rec_date');
do_calander('#ins_start_date');
do_calander('#ins_end_date');



// ::::: Edit This Section ::::: 
$unique='transport_id';  		// Primary Key of this Database table
$title='Transport Information' ; 	// Page Name and Page Title
$page="transport_info.php";		// PHP File Name
$table='transport_info';		// Database Table Name Mainly related to this page


$crud      =new crud($table);
$$unique = $_GET[$unique];

//for submit..................................
if(isset($_POST['submit']))
{		
$_POST['entry_at']=time();
$_POST['entry_by']=$_SESSION['user']['id'];
		$crud->insert();
		$type=1;
		$msg='New Entry Successfully Inserted.';
}

//for update..................................
if(isset($_POST['update']))
{
$_POST['edit_at']=time();
$_POST['edit_by']=$_SESSION['user']['id'];
		$crud->update($unique);
		$type=1;
		$msg='Successfully Updated.';
}
	
	
if(isset($$unique))
{
$condition=$unique."=".$$unique;	

$data=db_fetch_object($table,$condition);

while (list($key, $value)=each($data))

{ $$key=$value;}

}	
	
	
	
?>


<script type="text/javascript">

function nav(lkf){document.location.href = '<?=$page?>?<?=$unique?>='+lkf;}

</script>


<div class="container-fluid">
    <div class="row">
        <div class="col-sm-7">

            <div class="container n-form1">
			
			<table id="table_head" class="table1 table-striped table-bordered table-hover table-sm dataTable no-footer" role="grid" aria-describedby="table_head_info">
				<thead class="thead1">
					<tr class="bgc-info" role="row">
						<th>Sl No </th>
						<th>Transport Category </th>
						<th>Transport Type</th>
						<th>Transport Name  </th>
						<th>Transport Number </th>
						<th>Transport Engin No </th>
						<th>Transport Reg No </th>
						<th>status </th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody class="tbody1">
				<?  $data = "SELECT transport_id,transport_category,transport_type,transport_name,transport_number,transport_engin_no,transport_registation_no,status FROM  transport_info WHERE 1"; 
					$query = mysql_query($data);
					$i=1;
					while($row =mysql_fetch_object($query)){
				?>
					<tr>
					    <td><?=$i++;?></td>
						<td><?=$row->transport_category;?></td>
						<td><?=$row->transport_type;?></td>
						<td><?=$row->transport_name;?></td>
						<td><?=$row->transport_number;?></td>
						<td><?=$row->transport_engin_no;?></td>
						<td><?=$row->transport_registation_no;?></td>
						<td><?=$row->status;?></td>
						<td><button type="button" onclick="nav('<?=$row->transport_id;?>');" class="btn2 btn1-bg-update"><i class="fa-solid fa-pen-to-square"></i></button></td>
					</tr>
					
					<?php
					}	
					?>
				</tbody>
			</table>
				
				

            </div>

        </div>


        <div class="col-sm-5">
		<form class="n-form" action="<?=$page?>?<?=$unique?>=<?=$$unique?>" method="post" enctype="multipart/form-data">
			
                <h4 align="center" class="n-form-titel1"> Transport Information</h4>

                <div class="form-group row m-0 pl-3 pr-3 p-1">
                    <label for="group_name" class="req-input col-sm-5 pl-0 pr-0 col-form-label ">  Transport Category: </label>
                    <div class="col-sm-7 p-0">									
					<input name="<?=$unique?>" required="" type="hidden" id="<?=$unique?>" value="<?=$$unique;?>" >	
                    <!--<input name="transport_category" required="" type="text" id="transport_category" tabindex="1" value="<?=$transport_category;?>" >-->
					
					<select name="transport_category" required="" id="transport_category" value="<?=$transport_category?>" >
						<option><?=$transport_category?></option> 
                      	<option value="AC">AC</option>    
					    <option value="PICK UP">PICK UP</option>
						<option value="COVER VAN">COVER VAN</option>  
						<option value="TRACK">TRACK</option>                 
					 </select>	
                    </div>
                </div>
				
				
                <div class="form-group row m-0 pl-3 pr-3 p-1">
                    <label for="group_name" class="req-input col-sm-5 pl-0 pr-0 col-form-label ">  Transport Type: </label>
                    <div class="col-sm-7 p-0">														
					<select name="transport_type" required="" id="transport_type" value="<?=$transport_type?>" >
						<option><?=$transport_type?></option> 
                      	<option value="PERMANENT CAR">Permanent Car</option>    
					    <option value="RENT CAR">Rent Car</option>                
					 </select>	
                    </div>
                </div>
			
                <div class="form-group row m-0 pl-3 pr-3 p-1">
                    <label for="group_name" class="req-input col-sm-5 pl-0 pr-0 col-form-label "> Transport Name : </label>
                    <div class="col-sm-7 p-0">
						
						<input name="transport_name" required="" type="text" id="transport_name" tabindex="1" value="<?=$transport_name;?>" >	
                    </div>
                </div>
				
                <div class="form-group row m-0 pl-3 pr-3 p-1">
                    <label for="group_name" class="req-input col-sm-5 pl-0 pr-0 col-form-label "> Transport Number: </label>
                    <div class="col-sm-7 p-0">
						<input name="transport_number" required="" type="text" id="transport_number" tabindex="1" value="<?=$transport_number;?>" >	
                    </div>
                </div>
				
                <div class="form-group row m-0 pl-3 pr-3 p-1">
                    <label for="group_name" class="req-input col-sm-5 pl-0 pr-0 col-form-label ">Transport Engin No: </label>
                    <div class="col-sm-7 p-0">
						<input name="transport_engin_no"  type="text" id="transport_engin_no" tabindex="1" value="<?=$transport_engin_no;?>" >	
                    </div>
                </div>
				
                <div class="form-group row m-0 pl-3 pr-3 p-1">
                    <label for="group_name" class="req-input col-sm-5 pl-0 pr-0 col-form-label "> Transport Reg No: </label>
                    <div class="col-sm-7 p-0">
						<input name="transport_registation_no"  type="text" id="transport_registation_no" tabindex="1" value="<?=$transport_registation_no;?>" >	
                    </div>
                </div>
				
                <div class="form-group row m-0 pl-3 pr-3 p-1">
                    <label for="group_name" class="req-input col-sm-5 pl-0 pr-0 col-form-label "> status: </label>
                    <div class="col-sm-7 p-0">
					<select name="status" required="" id="status" value="<?=$status?>" tabindex="7">
						<option><?=$status?></option> 
                      	<option value="ACTIVE">ACTIVE</option>    
					    <option value="INACTIVE">INACTIVE</option>                    
					  </select>
                    </div>
                </div>
				




                <div class="n-form-btn-class">
					<? if(!isset($_POST[$unique])&&!isset($_GET[$unique])) {?>
					<input name="submit" type="submit" id="submit" value="SAVE" class="btn1 btn1-bg-submit">
					
					<? }?>
                     
					 <? if(isset($_POST[$unique])||isset($_GET[$unique])) {?>
					 <input name="update" type="submit" id="update" value="Update" class="btn1 btn1-bg-update">

					<? }?>

                      <input name="reset" type="button" class="btn1 btn1-bg-cancel" id="reset" value="RESET" onclick="parent.location='transport_info.php'">
                    

                 
                </div>


            </form>
        </div>



</div>



<?
require_once "../../../assets/template/layout.bottom.php";
?>
