<?php
session_start();
include 'config/db.php';
include 'config/crud.php';
include 'config/function.php';
include 'config/access.php';
$user_id	=$_SESSION['user_id'];

$page="do";

include "inc/header.php";

if($_GET['pal']==2) { unset($$unique); unset($_SESSION['log_no']); $type=1;}
//$dealer_code2 = $_GET['ss'];


$page_for           ='Log Book Entry';
$table_master       ='vehicle_log_book';
$table_details      ='vehicle_log_book';
$unique             ='log_no';


if($_GET['log_no']>0) $_SESSION['log_no']=$_GET['log_no'];



if(isset($_POST['new'])){

		$crud   = new crud($table_details);
		if($_SESSION['log_no']==''){
		$max_log_no=$$unique=$_SESSION['log_no'] = find_a_field('vehicle_log_book','max(log_no)+1','1');
		if($max_log_no==0){
		$max_log_no=$$unique=$_SESSION['log_no'] = 1;
		}
		}
		
	
    		//$$unique=$_SESSION['log_no'] = $crud->insert();
			$crud   = new crud($table_details);
		    $max_id = rand(1000,1000000);
		
		if($_FILES['att_file']['tmp_name']!=''){
		
						$file_name= $_FILES['att_file']['name'];
			
						$file_tmp= $_FILES['att_file']['tmp_name'];
			
						$ext=end(explode('.',$file_name));
			
						$path='../vehicle_mod/files/vehicle_log/';
						$path2 = 'files/vehicle_log/';
						
						$uploaded_file = $path.$max_id.'.'.$ext;
						$uploaded_file2 = $path2.$max_id.'.'.$ext;
						
						$_POST['att_file'] = $uploaded_file2;
			
						move_uploaded_file($file_tmp, $uploaded_file);
		
					}
		  $_POST['entry_at']  = date('Y-m-d H:i:s');
		  $_POST['entry_by']  = $_SESSION['user_id'];
		  $_POST['log_no']  =$_SESSION['log_no'];
		  $_POST['log_date']  =$_POST['log_date'];
		  $_POST['net_km'] = $_POST['end_meter_reading']-$_POST['start_meter_reading'];
		  
            $crud->insert();
    		$type=1;
    		$msg = $title.'  No Created. (No :-'.$_SESSION['log_no'].')';

		    
		
} // end initiate

$$unique=$_SESSION['log_no'];



if(isset($_POST['delete'])){

		$crud   = new crud($table_master);
		$condition=$unique."=".$$unique;		
		$crud->delete($condition);
		$crud   = new crud($table_details);
		$condition=$unique."=".$$unique;		
		$crud->delete_all($condition);
		unset($$unique);
		unset($_SESSION['log_no']);
		unset($_SESSION['log_no']);
		$type=1;
		$msg='Successfully Deleted.';
}

if(isset($_POST['hold'])){
        $_POST['status'] = 'MANUAL';
        $crud   = new crud($table_master);
		$crud->update($unique);
		$crud   = new crud($table_details);
		$crud->update($unique);
		unset($$unique);
		unset($_SESSION['log_no']);
		unset($_SESSION['log_no']);
		$type=1;
		$msg='Successfully Drafted.';
		?><script>window.location.href='unfinished_log.php';</script><?php 
}




if($_GET['del']>0){

		$crud   = new crud($table_details);
		$condition="id=".$_GET['del'];		
		$crud->delete_all($condition);
		
		$type=1;
		$msg='Successfully Deleted.';
		
}




if(isset($_POST['confirmm'])){
		unset($_POST);
		$_POST[$unique]=$$unique;
		$_POST['entry_by']=$_SESSION['user_id'];
		$_POST['entry_at']=date('Y-m-d H:i:s');
		$_POST['status']='CHECKED';
		$crud   = new crud($table_details);
		$crud->update($unique);


        $pp=$$unique;
		unset($$unique);
		unset($_SESSION['log_no']);
		$type=1;

        $_SESSION['msg']='<span style="color:green; font-weight:bold">Log Recorded Successfully.</span>';

?><script>window.location.href='movement_status.php';</script><?  
} // End confirm




if(isset($_POST['add'])&&($_POST[$unique]>0)){
		$crud   = new crud($table_details);
		$max_id = find_a_field('vehicle_log_book','max(id)+1','1');
		
		if($_FILES['att_file']['tmp_name']!=''){
		
						$file_name= $_FILES['att_file']['name'];
			
						$file_tmp= $_FILES['att_file']['tmp_name'];
			
						$ext=end(explode('.',$file_name));
			
						$path='files/fuel/';
						
						$uploaded_file = $path.$max_id.'.'.$ext;
						
						$_POST['att_file'] = $uploaded_file;
			
						move_uploaded_file($file_tmp, $uploaded_file);
		
					}
		  $_POST['entry_at']  = date('Y-m-d H:i:s');
		  $_POST['entry_by']  = $_SESSION['user_id'];
        

		//$_POST['item_id'] = find_a_field('item_info','item_id','finish_goods_code='.$_POST['item_id2']);
        $xid = $crud->insert();
    }




if($$unique>0){
		$condition=$unique."=".$$unique;
		$data=db_fetch_object($table_master,$condition);
		while (list($key, $value)=each($data))
		{ $$key=$value;}
		
}


if($$unique>0) $btn_name='Add More Items'; else $btn_name='Add Items';

if($_SESSION['log_no']<1)
$$unique=db_last_insert_id($table_master,$unique);

?>
<script language="javascript">
function focuson(id) {
  if(document.getElementById('id').value=='')
  document.getElementById('id').focus();
  else
  document.getElementById(id).focus();
}
</script>


<script language="javascript">
function count(){
                    var num=((document.getElementById('total_unit').value)*1)*((document.getElementById('unit_price').value)*1);
                    document.getElementById('total_amt').value = num.toFixed(2);
                    $("#add").show();
                    $('#total_unit').next().focus();
      
}
</script>







<!-- --------------- main page content ----------------- -->
<style>
body{
font-size: 14px;   
}    
</style>

<div class="main-container container">
<!--<?php if(isset($msg)){ ?><div class="alert alert-primary msg" role="alert"><?php echo @$msg; ?></div><?php } ?>-->
<!--<?php if(isset($emsg)){ ?><div class="alert alert-danger emsg" role="alert"><?php echo @$emsg; ?></div><?php } ?>-->
            


<div class="form-container_large">
<form action="vehicle_movement.php" method="post" name="codz" id="codz" onSubmit="if(!confirm('Are You Sure Execute this?')){return false;}" enctype="multipart/form-data">


<div class="form-group row">
            <div class="col-4"><label for="log_no" class="col-form-label">Log No:</label></div> <!--sk-->
            <div class="col-8 mb-1"><div class="col-sm-3"><? $field='log_no';?><input  class="form-control border border-info" name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>" disabled="disabled"/></div></div>

           <div class="col-4"><label for="log_no" class="col-form-label">Log Date:</label></div> <!--sk-->
            <div class="col-8 mb-1"><div class="col-sm-3"><? $field='log_date';?><input  class="form-control border border-info" name="<?=$field?>" type="date" id="<?=$field?>" value="<?=$$field?>"/></div></div>
			
			<div class="col-4"><label for="log_no" class="col-form-label">Vehicle:</label></div> <!--sk-->
            <div class="col-8 mb-1"><div class="col-sm-3"><? $field='vehicle';?><select  class="form-control border border-info" name="<?=$field?>" id="<?=$field?>">
			<option></option>
			<? foreign_relation('vehicle_info','vehicle_id','vehicle_name',$_POST['vehicle'],'1')?>
			</select></div></div>
			
			<div class="col-4"><label for="log_no" class="col-form-label">Journey:</label></div> <!--sk-->
            <div class="col-8 mb-1"><div class="col-sm-3"><? $field='journey';?><input  class="form-control border border-info" name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>"/>
			</div></div>
			
			<div class="col-4"><label for="log_no" class="col-form-label">Start Meter Reading:</label></div> <!--sk-->
            <div class="col-8 mb-1"><div class="col-sm-3"><? $field='start_meter_reading';?><input  class="form-control border border-info" name="<?=$field?>" type="number" id="<?=$field?>" value="<?=$$field?>"/>
			</div></div>
			
			<div class="col-4"><label for="log_no" class="col-form-label">End Meter Reading:</label></div> <!--sk-->
            <div class="col-8 mb-1"><div class="col-sm-3"><? $field='end_meter_reading';?><input  class="form-control border border-info" name="<?=$field?>" type="number" id="<?=$field?>" value="<?=$$field?>"/>
			</div></div>
			
			
			<div class="col-4"><label for="log_no" class="col-form-label">Fuel/Gasoline:</label></div> <!--sk-->
            <div class="col-8 mb-1"><div class="col-sm-3"><? $field='fuel_gasoline';?><input  class="form-control border border-info" name="<?=$field?>" type="number" id="<?=$field?>" value="<?=$$field?>"/></div></div>
			
			<div class="col-4"><label for="log_no" class="col-form-label">User:</label></div> <!--sk-->
            <div class="col-8 mb-1"><div class="col-sm-3"><? $field='vehicle_user';?><select  class="form-control border border-info" name="<?=$field?>" id="<?=$field?>">
			<option></option>
			<? foreign_relation('user_activity_management','user_id','fname',$_POST['vehicle_user'],'1')?>
			</select>
			</div></div>
			
			
			
			<div class="col-4"><label for="log_no" class="col-form-label">Attach:</label></div> <!--sk-->
            <div class="col-8 mb-1"><div class="col-sm-3"><input  class="form-control border border-info" name="att_file" type="file" id="att_file"/></div></div>
</div>    

</br>
 
<div class="form-group row mb-12">
    
            
			
			
			

            <div class="col-12">
                     <!--<input  name="issue_type" type="hidden" id="issue_type" value="<?=$page_for?>" required="required"/>  -->
                      <div class="form-group row">
                        <div class="col-sm-12 text-center">
                          <button name="new" type="submit" class="btn btn-info mt-1"><?=$btn_name?></button>
                        </div>
                      </div>
                
            </div>

</div> <!--Row end-->


<!--end-->
</form>




<? 
$res='select a.id,a.log_no,a.journey,v.vehicle_name,a.net_km,"x" 
from '.$table_details.' a, vehicle_info v
where v.vehicle_id=a.vehicle and a.log_no='.$_SESSION['log_no'].' order by a.id asc';
//echo link_report_add_del_auto($res,'',3,5);
?>


<table class="table table-striped" id="grp" cellspacing="0" cellpadding="0" width="100%">
	<tr>
		<th>Vehicle</th>
		<th>Journey</th>
		<th>Net KM</th>
		<th>X</th>
	</tr>
<?
$sl=1;
$query=mysqli_query($conn, $res);
while($info=mysqli_fetch_object($query)){ ?>
<tr>
    <td><span class="ccc"><?=$info->vehicle_name?></span></td>
	<td><?=$info->journey?></td>
    <td><?=$info->net_km?></td>
    <td><a href="?del=<?=$info->id;?>" target="">X</a></td>
</tr>
<? 
$gamt +=$info->net_km;
} ?>
<tr>
	<td colspan="2"><strong>Total KM</strong></td>
    <td><strong><?=number_format($gamt,2)?></strong></td>
	<td><strong></strong></td> 
	<td><strong></strong></td>
</tr>    
</table>
<form action="" method="post" name="cz" id="cz" onSubmit="if(!confirm('Are You Sure Execute this?')){return false;}">
  <table width="100%" border="0">
    <tr>
      <td align="center"><button name="delete" type="submit" value="delete" class="btn btn-danger">Full Delete</button></td>
	  <td align="center"><button name="hold" type="submit" value="hold" class="btn btn-info">Draft</button></td>
      <td align="center"><button name="confirmm" type="submit" value="Bill Claim" class="btn btn-primary">Confirm</button></td>
    </tr>
  </table>
</form>

</div>



        
</div>
<!-- main page content ends -->
</main>
<!-- Page ends-->

<?php include "inc/footer.php"; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
 
<script>
function getData(){
    
var id = document.getElementById("item_id").value;

		jQuery.ajax({
			url:'ajax_json_price.php',
			type:'post',
			data:'id='+id,
			success:function(result){
				var json_data=jQuery.parseJSON(result);

				jQuery('#unit_name').val(json_data.unit);
				//jQuery('#stock').val(json_data.stock);
				//jQuery('#cost_rate').val(json_data.cost_rate);
				jQuery('#unit_price').val(json_data.price);

			}

		})
	
}
</script> 
 

<!--https://harvesthq.github.io/chosen/-->
<script>
jQuery('.party_list').chosen();
jQuery('.item_list').chosen();
</script>