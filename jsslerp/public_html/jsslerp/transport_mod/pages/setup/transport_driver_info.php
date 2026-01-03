
<?php
require_once "../../../assets/template/layout.top.php";
do_calander('#issue_date');
do_calander('#exp_date');
do_calander('#rec_date');
do_calander('#ins_start_date');
do_calander('#ins_end_date');



// ::::: Edit This Section ::::: 
$unique='driver_id';  		// Primary Key of this Database table
$title='Driver Information' ; 	// Page Name and Page Title
$page="transport_driver_info.php";		// PHP File Name
$table='transport_driver_info';		// Database Table Name Mainly related to this page


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
						<th>Driver Name </th>
						<th>Driver Address </th>
						<th>Driver Mobile </th>
						<th>Driver Code </th>
						<th>Driver Type </th>
						<th>status </th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody class="tbody1">
				<?  $data = "SELECT driver_id,driver_name,driver_address,driver_mobile,driver_code,driver_type,status FROM  transport_driver_info WHERE 1"; 
					$query = mysql_query($data);
					$i=1;
					while($row =mysql_fetch_object($query)){
				?>
					<tr>
					    <td><?=$i++;?></td>
						<td><?=$row->driver_name;?></td>
						<td><?=$row->driver_address;?></td>
						<td><?=$row->driver_mobile;?></td>
						<td><?=$row->driver_code;?></td>
						<td><?=$row->driver_type;?></td>
						<td><?=$row->status;?></td>
						<td><button type="button" onclick="nav('<?=$row->driver_id;?>');" class="btn2 btn1-bg-update"><i class="fa-solid fa-pen-to-square"></i></button></td>
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
			
                <h4 align="center" class="n-form-titel1"> Driver Information</h4>

                <div class="form-group row m-0 pl-3 pr-3 p-1">
                    <label for="group_name" class="req-input col-sm-5 pl-0 pr-0 col-form-label ">  Driver Name: </label>
                    <div class="col-sm-7 p-0">			
						<input name="<?=$unique?>" required="" type="hidden" id="<?=$unique?>" value="<?=$$unique;?>" >							
                        <input name="driver_name" required="" type="text" id="driver_name" tabindex="1" value="<?=$driver_name;?>" >	
		
						
                    </div>
                </div>
				


                <div class="form-group row m-0 pl-3 pr-3 p-1">
                    <label for="group_name" class="req-input col-sm-5 pl-0 pr-0 col-form-label "> Driver Address : </label>
                    <div class="col-sm-7 p-0">
						
						<input name="driver_address" required="" type="text" id="driver_address" tabindex="1" value="<?=$driver_address;?>" >	
                    </div>
                </div>
				

                <div class="form-group row m-0 pl-3 pr-3 p-1">
                    <label for="group_name" class="req-input col-sm-5 pl-0 pr-0 col-form-label "> Driver Mobile: </label>
                    <div class="col-sm-7 p-0">
						<input name="driver_mobile" required="" type="text" id="driver_mobile" tabindex="1" value="<?=$driver_mobile;?>" >	
                    </div>
                </div>
				

                <div class="form-group row m-0 pl-3 pr-3 p-1">
                    <label for="group_name" class="req-input col-sm-5 pl-0 pr-0 col-form-label ">Driver Code: </label>
                    <div class="col-sm-7 p-0">
						<input name="driver_code" required="" type="text" id="driver_code" tabindex="1" value="<?=$driver_code;?>" >	
                    </div>
                </div>
				

			<div class="form-group row m-0 pl-3 pr-3 p-1">
                    <label for="group_name" class="req-input col-sm-5 pl-0 pr-0 col-form-label "> Driver Type: </label>
                    <div class="col-sm-7 p-0">						
						<select name="driver_type" required="" id="driver_type" value="<?=$driver_type?>" tabindex="7">
						<option><?=$driver_type?></option> 
                      	<option value="PERMANENT DRIVER">PERMANENT DRIVER</option>    
					    <option value="RENT DRIVER">RENT DRIVER</option>                    
					  </select>
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

                      <input name="reset" type="button" class="btn1 btn1-bg-cancel" id="reset" value="RESET" onclick="parent.location='transport_driver_info.php'">
                    

                 
                </div>


            </form>
        </div>



</div>



<?
require_once "../../../assets/template/layout.bottom.php";
?>
