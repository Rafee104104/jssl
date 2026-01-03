<?php
require_once "../../../assets/template/layout.top.php";
do_calander('#issue_date');
do_calander('#exp_date');
do_calander('#rec_date');
do_calander('#ins_start_date');
do_calander('#ins_end_date');


// ::::: Edit This Section ::::: 
$unique='ts_id';  		// Primary Key of this Database table
$title='Transport Setup' ; 	// Page Name and Page Title
$page="transport_setup.php";		// PHP File Name
$table='transport_setup';		// Database Table Name Mainly related to this page


$crud      =new crud($table);
$$unique = $_GET[$unique];

//for submit..................................
if(isset($_POST['submit']))
{		
$get_tid=$_POST['transport_id'];
$t_id_arr=explode("#",$get_tid);
echo $_POST['transport_id']=$t_id_arr[1];
$_POST['entry_at']=time();
$_POST['entry_by']=$_SESSION['user']['id'];
		$crud->insert();
		$type=1;
		$msg='New Entry Successfully Inserted.';
}

//for update..................................
if(isset($_POST['update']))
{
$get_tid=$_POST['transport_id'];
$t_id_arr=explode("#",$get_tid);
echo $_POST['transport_id']=$t_id_arr[1];

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
						<th>Sl No</th>
						<th>Transport ID</th>
						<th>Transport Number</th>
						<th>Driver ID</th>
						<th>Driver Name</th>
						<th>status</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody class="tbody1">
				<?  $data = "SELECT ts_id, transport_id, driver_id, status FROM transport_setup WHERE 1 "; 
					$query = mysql_query($data);
					$i=1;
					while($row =mysql_fetch_object($query)){
				?>
					<tr>
					    <td><?=$i++;?></td>
						<td><?=$row->transport_id;?></td>
						<td><?=find_a_field('transport_info','transport_number','transport_id="'.$row->transport_id.'"');?></td>
						<td><?=$row->driver_id;?></td>
						<td><?=find_a_field('transport_driver_info','driver_name','driver_id="'.$row->driver_id.'"');?></td>
						<td><?=$row->status;?></td>
						<td><button type="button" onclick="nav('<?=$row->ts_id;?>');" class="btn2 btn1-bg-update"><i class="fa-solid fa-pen-to-square"></i></button></td>
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
                    <label for="group_name" class="req-input col-sm-5 pl-0 pr-0 col-form-label ">  Transport Id: </label>
                    <div class="col-sm-7 p-0">									
					<input name="<?=$unique?>" required="" type="hidden" id="<?=$unique?>" value="<?=$$unique;?>" >
					
<?php /*?>			<select name="" id="">
					<?php 
					$t_sql='select * from transport_info';
					$t_query=mysql_query($t_sql);
					while($t_row=mysql_fetch_object($t_query)){
					?>
						<option value="<?=$t_row->transport_id?>"><?=$t_row->transport_name?></option>
					<?php } ?>
					</select><?php */?>
					
					<input class="form-control" list="browsers" name="transport_id" id="transport_id" value="<?=find_a_field('transport_info','transport_name','transport_id="'.$transport_id.'"')."#".$transport_id;?>">

					<datalist id="browsers">
					  <? foreign_relation('transport_info','concat(transport_name,"#",transport_id)','concat(transport_name,"#",transport_id)',$transport_id,'1');?>
										<?php 
										$t_sql='select * from transport_info';
										$t_query=mysql_query($t_sql);
										while($t_row=mysql_fetch_object($t_query)){
										?>
											<option value="<?=$t_row->transport_name."#".$t_row->transport_id?>">
										<?php } ?>
					</datalist>
						
                   
                    </div>
                </div>
			
                <div class="form-group row m-0 pl-3 pr-3 p-1">
                    <label for="group_name" class="req-input col-sm-5 pl-0 pr-0 col-form-label "> Driver Id : </label>
                    <div class="col-sm-7 p-0">
						
						<!--<input name="driver_id" required="" type="text" id="driver_id" tabindex="1" value="<?=$driver_id;?>" >-->
					<select name="driver_id" id="driver_id"  value="<?=$driver_id;?>">
					<option value="<?=$driver_id;?>"><?=$driver_id;?></option>
					<?php 
						echo $d_sql='select * from transport_driver_info';
					$d_query=mysql_query($d_sql);
					while($d_row=mysql_fetch_object($d_query)){
					?>
						<option value="<?=$d_row->driver_id?>"><?=$d_row->driver_name?></option>
					<?php } ?>
					</select>	
                    </div>
                </div>
				
                <div class="form-group row m-0 pl-3 pr-3 p-1">
                    <label for="group_name" class="req-input col-sm-5 pl-0 pr-0 col-form-label "> Comments: </label>
                    <div class="col-sm-7 p-0">
						<!--<input name="comments" required="" type="text" id="comments" tabindex="1" value="<?=$comments;?>" >	-->
						<textarea id="comments" name="comments" rows="1" cols="1"><?=$comments;?></textarea>
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

                      <input name="reset" type="button" class="btn1 btn1-bg-cancel" id="reset" value="RESET" onclick="parent.location='transport_setup.php'">
                    

                 
                </div>


            </form>
        </div>



</div>



<?
require_once "../../../assets/template/layout.bottom.php";
?>
