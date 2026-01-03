<?php
session_start();
include 'config/db.php';
include 'config/crud.php';
include 'config/function.php';
include 'config/access.php';

$user_id	=$_SESSION['user_id'];
$product_group	=$_SESSION['product_group'];
$region_id	=$_SESSION['region_id'];
$zone_id	=$_SESSION['zone_id'];
$area_id	=$_SESSION['area_id'];



$page="do";

include "inc/header.php";

if($_GET['pal']==2) { unset($$unique); unset($_SESSION['do_no2']); $type=1;}


$page_for           ='Sec Sales';
$table_master       ='ss_do_master';
$table_details      ='ss_do_details';
$unique             ='do_no';


if($_GET['do_no']>0) {
$check_status = find1("select status from ss_do_master where do_no='".$_GET['do_no']."'");
	if($check_status=='MANUAL'){ $_SESSION['do_no2']=$_GET['do_no'];}else{ redirect('home.php');}
}



if(isset($_POST['new'])){

		$crud   = new crud($table_master);

		if(!isset($_SESSION['do_no2'])) {
		$_POST['entry_by']	=$_SESSION['username'];
		$_POST['entry_at']	=date('Y-m-d H:i:s');
		//$_POST['edit_by']	=$_SESSION['username'];
		//$_POST['edit_at']	=date('Y-m-d H:i:s');
        
        if($_POST['shop_status']=='Get Order') { $_POST['memo']=1; }else{$_POST['memo']=0; }
	
	//  $_POST['warehouse_id']  = $_SESSION['warehouse_id'];
		
	//	$_POST['vendor_name']	= find1('select name from ledger_head where id="'.$_POST['dealer_code'].'"');
	
    		$$unique=$_SESSION['do_no2'] = $crud->insert();
    		//unset($$unique);
    		$type=1;
    		$msg = $title.'  No Created. (No :-'.$_SESSION['do_no2'].')';
			?><script>window.location.href = "do.php?do_no=<?=$$unique;?>";</script><?
		    
		} else {
		 
		//$_POST['edit_by']	    =$_SESSION['username'];
		//$_POST['edit_at']	    =date('Y-m-d H:i:s');
		$_POST['do_no']		    =$_SESSION['do_no2'];
		if($_POST['shop_status']=='Get Order') { $_POST['memo']=1; }else{$_POST['memo']=0; }
		
		
mysqli_query($conn, "update ss_do_master set do_date='".$_POST['do_date']."' where do_no='".$_POST['do_no']."'");		
		
		$crud->update($unique);
		$type=1;
		$msg='Successfully Updated.';
		}

    
} // end initiate

$$unique=$_SESSION['do_no2'];



if(isset($_POST['delete'])){

		$crud   = new crud($table_master);
		$condition=$unique."=".$$unique;		
		$crud->delete($condition);
		$crud   = new crud($table_details);
		$condition=$unique."=".$$unique;		
		$crud->delete_all($condition);
		unset($$unique);
		unset($_SESSION['do_no2']);
		$type=1;
		$msg='Successfully Deleted.';
}

if(isset($_POST['hold'])){
		unset($$unique);
		unset($_SESSION['do_no2']);
		$type=1;
		$msg='Successfully Holded.';
		?><script>window.location.href='do.php?pal=2';</script><?php 
}




if($_GET['del']>0){

		$crud   = new crud($table_details);
		$condition="id=".$_GET['del'];		
		$crud->delete_all($condition);
		
		$type=1;
		$msg='Successfully Deleted.';
		
}



if(isset($_POST['confirmm']) && $_POST['randcheck']==$_SESSION['rand']){
		//unset($_POST);
		$_POST[$unique]=$$unique;
		$_POST['entry_by']=$_SESSION['username'];
		$_POST['entry_at']=date('Y-m-d H:i:s');
		$_POST['status']='CHECKED';
		$crud   = new crud($table_master);
		$crud->update($unique);


    $pp=$$unique;
		unset($$unique);
		unset($_SESSION['do_no2']);
		$type=1;

$msg='Successfully Forwarded.';

?><script>window.location.href='home.php';</script><?  
} // End confirm




if(isset($_POST['add'])&&($_POST[$unique]>0)){
		$crud   = new crud($table_details);
		//$iii=explode('##',$_POST['id']);
		//$_POST['item_id']=$iii[0];
		
		//$_POST['unit_name']     =$_POST['unit'];
		//$_POST['rate']          =$_POST['price'];
		//$_POST['warehouse_id']  =$_SESSION['warehouse_id'];
        

    if($_POST['item_id']>0) {
		unset($_POST['id']);
        $xid = $crud->insert();
    }


}


if($$unique>0){
		$condition=$unique."=".$$unique;
		$data=db_fetch_object($table_master,$condition);
		while (list($key, $value)=each($data))
		{ $$key=$value;}
		
}


if($$unique>0) $btn_name='Update'; else $btn_name='Start';

if($_SESSION['do_no2']<1)
$$unique=db_last_insert_id($table_master,$unique);

?>
<script>
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		return xmlhttp;
    }

function update_value(id){

var item_id=id; 

//var orate=(document.getElementById('orate_'+id).value)*1; 
var do_no		=(document.getElementById('do_no').value); 
var dealer_code	=(document.getElementById('dealer_code').value); 
var do_date		=(document.getElementById('do_date').value); 
var flag		=(document.getElementById('flag_'+id).value); 

//var cqty=(document.getElementById('cqty_'+id).value)*1; 
var item_qty=(document.getElementById('item_qty_'+id).value)*1; 



var strURL="do_item_ajax.php?item_id="+item_id+"&item_qty="+item_qty+"&do_no="+do_no+"&dealer_code="+dealer_code+"&do_date="+do_date+"&flag="+flag;

		var req = getXMLHTTP();

		if (req) {

			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('divi_'+id).style.display='inline';
						document.getElementById('divi_'+id).innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}
			req.open("GET", strURL, true);
			req.send(null);
		}	

}

</script>
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

<div class="main-container container" onload="getLocation()">
<!--<?php if(isset($msg)){ ?><div class="alert alert-primary msg" role="alert"><?php echo @$msg; ?></div><?php } ?>-->
<!--<?php if(isset($emsg)){ ?><div class="alert alert-danger emsg" role="alert"><?php echo @$emsg; ?></div><?php } ?>-->
            


<div class="form-container_large">
<form action="" method="post" name="codz" id="codz">


<div class="form-group row">
            <div class="col-1"><label for="do_no" class="col-form-label">DO:</label></div>
            <div class="col-3 mb-1"><div class="col-sm-3 col-md-4"><? $field='do_no';?>
			<input  class="form-control border border-info" name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>" disabled="disabled"/>
			</div></div>

            <div class="col-1"><label for="do_date" class="col-form-label">Date</label></div> 
            <div class="col-5">
			<? $field='do_date'; if($do_date=='') $do_date =date('Y-m-d'); ?>
			<input  class="form-control border border-info" name="<?=$field?>" type="date" id="<?=$field?>" value="<?=$$field?>" required
			<? if($do_date!=''){?>  <? } ?>
			/></div>
</div>    


 
<div class="form-group row mb-2">
  
  
 
    
  <div class="col-1"><label for="shop" class="col-sm-2 col-form-label">Party:</label></div> 
	<div class="col-5"><? $field='dealer_code';?>

<? if($_GET['party']>0) { ?> 

			 <select class="form-control border border-info" name="<?=$field?>" id="<?=$field?>" required/>
				<option value="<?=$_GET['party']?>"><?=find1("select shop_name from ss_shop where dealer_code='".$_GET['party']."'");?></option>';
			</select>
		
<? }else{ ?> 

		<? if($_GET['do_no']>0){ $dealer_code=$_GET['do_no'];?>
			<select class="form-control border border-info" name="<?=$field?>" id="<?=$field?>" autocomplete="off" required/>
			<option value="<?=$_GET['do_no']?>"><?=find1("select shop_name from ss_shop where dealer_code='".$_GET['do_no']."'");?></option>
			</select>
		<? }else{ $dealer_code=$$field; ?>
			
			  <select class="form-control border border-info" name="<?=$field?>" id="<?=$field?>" required/>
				<?php 
				echo '<option></option>';
				optionlist('select dealer_code,shop_name from ss_shop 
				where status="1" and region_id="'.$region_id.'" and zone_id="'.$zone_id.'" and area_id="'.$area_id.'" order by shop_name');
				?>
				</select>
		<? } ?>



<? } ?>
		
	</div>
	
	


<input  class="form-control" name="visit" type="hidden" id="visit" value="1" required readonly="readonly"/>			
			
<!--<div class="col-1"><label for="memo" class="col-form-label">Memo</label></div> -->
<!--<div class="col-2"><? $field='memo';?>-->
<!--<input  class="form-control" name="<?=$field?>" type="number" id="<?=$field?>" value="<?=$$field?>" required/>-->
<!--</div>-->


<div class="col-1"><label for="shop_status" class="col-form-label">Status</label></div> 
<div class="col-4"><? $field='shop_status';?>
<!--<input  class="form-control" name="<?=$field?>" type="number" id="<?=$field?>" value="<?=$$field?>" required/>-->
<select class="form-control" name="<?=$field?>" id="<?=$field?>" required>
    <option><? echo $$field?$$field:'Get Order'; $shop_status=$$field;?></option>
    <option>Get Order</option>
    <option>No Order</option>
    <option>Close</option>
</select>
</div>
			
			
			
			
							  
		 
<div class="form-group row">		 
<div class="col-5 mt-3">
<a href="do_view.php?do=<?php echo $$unique;?>" class="btn btn-primary" role="button">View</a>
</div>		            
		            
<div class="col-5">
    <div class="text-center mt-3">
      <button name="new" type="submit" class="btn btn-info"><?=$btn_name?></button>
    </div>
</div>
		 				  

</div> <!--Row end-->


<!--end-->
</form>














<?php 
if($_SESSION['do_no2']>0 && $shop_status=='Get Order'){ ?>



<div class="tabledesign2" style="width:100%">
<table width="100%" border="0" align="left" id="grp">
  <tr>
    <th><div align="left">Item</div></th>
    <th><div align="left">Qty Pcs</div></th>
    <th><div align="left">Action</div></th>
  </tr>
<?

$sql = "select item_id,total_unit as qty
from ss_do_details where do_no ='".$_SESSION['do_no2']."' group by item_id ";

$query = mysqli_query($conn, $sql);
while($data = mysqli_fetch_object($query)){
$qty[$data->item_id] = $data->qty;
$flag[$data->item_id] = 1;
}


$sql_dealer = 'select item_id,finish_goods_code,item_name,d_price,t_price,m_price
from item_info 
where sales_item_type="'.$product_group.'" and status="Active"
order by item_name
';


$query = mysqli_query($conn, $sql_dealer);
while($data=mysqli_fetch_object($query)){$i++;
  ?>
  <tr bgcolor="<?=($i%2)?'#E8F3FF':'#fff';?>">
    <td><?=$data->finish_goods_code?><br><?=$data->item_name?><br>Price: <?=number_format($data->d_price, 2, '.', '');?></td>
    
<td>
<input class="form-control" name="item_qty_<?=$data->item_id?>" id="item_qty_<?=$data->item_id?>" type="number" 
value="<? if($qty[$data->item_id]>0){ echo (int)($qty[$data->item_id]); }else{echo '';}?>" style="width:60px;" />

<input name="do_no" type="hidden" id="do_no" value="<?=$_SESSION['do_no2']?>"/>
<input name="dealer_code" type="hidden" id="dealer_code" value="<?=$dealer_code;?>"/>
<input name="do_date" type="hidden" id="do_date" value="<?=$do_date?>" />
</td>
    <td><span id="divi_<?=$data->item_id?>">
            <? if($flag[$data->item_id]>0)
			  {?>
			  <input name="flag_<?=$data->item_id?>" type="hidden" id="flag_<?=$data->item_id?>" value="1" />
			  <input class="btn btn-warning mt-3" type="button" name="Button" value="Edit" onClick="update_value(<?=$data->item_id?>)" /><?
			  }
			  else
			  {
			  ?>
			  <input name="flag_<?=$data->item_id?>" type="hidden" id="flag_<?=$data->item_id?>" value="0" />
			  <input class="btn btn-primary mt-3" type="button" name="Button" value="Save"  onclick="update_value(<?=$data->item_id?>)"/><? }?>
          </span>&nbsp;</td>
  </tr>
  <? }?>
</table>
</div>

<? } ?>








<? if($_SESSION['do_no2']>0){ ?>
<!--onSubmit="if(!confirm('Are You Sure Execute this?')){return false;}"-->
<form action="" method="post" name="cz" id="cz" >
<?php $rand=rand(); $_SESSION['rand']=$rand; ?>
<input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
  <table width="100%" border="0" class="mt-3">
    <tr>
      <td align="center"><button name="delete" type="submit" value="delete" class="btn btn-danger">Full Delete</button></td>
	  <td align="center"><button name="hold" type="submit" value="hold" class="btn btn-info">Hold</button></td>
      <td align="center"><button name="confirmm" type="submit" value="CONFIRM" class="btn btn-primary">CONFIRM</button></td>
    </tr>
  </table>
  
<input type="text" name="latitude" id="latitude"  value="" readonly="">
<input type="text" name="longitude" id="longitude"  value="" readonly="">   
  
</form>
<? } ?>
</div>
<div class="row mt-5 mb-5"><p></p></div>


        
</div>


<script>
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}
function showPosition(position) {
  document.getElementById("latitude").value = position.coords.latitude;
  document.getElementById("longitude").value = position.coords.longitude;
}
</script>

<script>
window.onload = function() {
  getLocation();
};
</script>



<!-- main page content ends -->
</main>
<!-- Page ends-->

<?php include "inc/footer.php"; ?>


