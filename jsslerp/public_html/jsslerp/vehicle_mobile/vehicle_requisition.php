<?php
session_start();
include 'config/db.php';
include 'config/crud.php';
include 'config/function.php';
include 'config/access.php';
$user_id	=$_SESSION['user_id'];

$page="do";

include "inc/header.php";

if($_GET['pal']==2) { unset($$unique); unset($_SESSION['req_no']); $type=1;}
//$dealer_code2 = $_GET['ss'];


$page_for           ='Vehicle Requisition';
$table_master       ='vehicle_requisition';
$table_details      ='vehicle_requisition';
$unique             ='req_no';


if($_GET['req_no']>0) $_SESSION['req_no']=$_GET['req_no'];



if(isset($_POST['new'])){

		$crud   = new crud($table_master);
		
		if(!isset($_SESSION['req_no'])) {
		
		$_POST['entry_by']	=$_SESSION['user_id'];
		$_POST['entry_at']	=date('Y-m-d H:i:s');

    		$$unique=$_SESSION['req_no'] = $crud->insert();
    		unset($$unique);
			unset($_SESSION['req_no']);
    		$type=1;
    		$_SESSION['msg'] = '<span style="color:green;">Request Forwarded Successfully</span>';
			?>
			<script>window.location.href='vehicle_req_status.php';</script>
			
			<?php

		    
		} else {

		$_POST['req_no'] =$_SESSION['req_no'];	
		
		$crud->update($unique);
		$type=1;
		unset($$unique);
		unset($_SESSION['req_no']);
		$_SESSION['msg'] = '<span style="color:green;">Request Updated Successfully</span>';
			?>
			<script>window.location.href='vehicle_req_status.php';</script>
			
			<?php
		}

    
} // end initiate

$$unique=$_SESSION['req_no'];



if(isset($_POST['delete'])){

		$crud   = new crud($table_master);
		$condition=$unique."=".$$unique;		
		$crud->delete($condition);
		$crud   = new crud($table_details);
		$condition=$unique."=".$$unique;		
		$crud->delete_all($condition);
		unset($$unique);
		unset($_SESSION['req_no']);
		unset($_SESSION['req_no']);
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
		unset($_SESSION['req_no']);
		unset($_SESSION['req_no']);
		$type=1;
		$msg='Successfully Drafted.';
		?><script>window.location.href='do.php?pal=2';</script><?php 
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
		$_POST['status']='UNCHECKED';
		$crud   = new crud($table_master);
		$crud->update($unique);


        $pp=$$unique;
		unset($$unique);
		unset($_SESSION['req_no']);
		$type=1;

        $_SESSION['msg']='<span style="color:green; font-weight:bold">Bill Claimed Successfully.</span>';

?><script>window.location.href='home.php';</script><?  
} // End confirm









if($$unique>0){
		$condition=$unique."=".$$unique;
		$data=db_fetch_object($table_master,$condition);
		while (list($key, $value)=each($data))
		{ $$key=$value;}
		
}


if($$unique>0) $btn_name='Update Request'; else $btn_name='Confirm Request';

if($_SESSION['req_no']<1)
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
<form action="" method="post" name="codz" id="codz" onSubmit="if(!confirm('Are You Sure Execute this?')){return false;}">


<div class="form-group row">
            <div class="col-4"><label for="req_no" class="col-form-label">Request No.</label></div> <!--sk-->
            <div class="col-8 mb-1"><div class="col-sm-3"><? $field='req_no';?><input  class="form-control border border-info" name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>" disabled="disabled"/></div></div>

            <div class="col-4"><label for="req_date" class="col-form-label">Need By</label></div> 
            <div class="col-8"><? $field='req_date'; if($req_date=='') $req_date =date('Y-m-d'); ?><input  class="form-control border border-info" name="<?=$field?>" type="date" id="<?=$field?>" value="<?=$$field?>" required/></div>
</div>    

</br>
 
<div class="form-group row mb-2">
    
			<div class="col-2"><label for="shop" class="col-sm-2 col-form-label size-12">Total Person:</label></div> 
            <div class="col-10">
				<input class="form-control border border-info" name="person" id="person" value="<?=$person?>" tabindex="1" autocomplete="off" required/>
            </div>
			
			<div class="col-2"><label for="shop" class="col-sm-2 col-form-label size-12">Note:</label></div> 
            <div class="col-10">
				<input class="form-control border border-info" name="note" id="note" value="<?=$note?>" tabindex="1" autocomplete="off" required/>
            </div>
			
			

            <div class="col-5">
                     <!--<input  name="issue_type" type="hidden" id="issue_type" value="<?=$page_for?>" required="required"/>  -->
                      <div class="form-group row">
                        <div class="col-sm-10 text-center" align="center">
                          <button name="new" type="submit" class="btn btn-info mt-1"><?=$btn_name?></button>
                        </div>
                      </div>
                
            </div>

</div> <!--Row end-->


<!--end-->
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