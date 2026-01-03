<?php
session_start();
include 'config/db.php';
include 'config/crud.php';
include 'config/function.php';
include 'config/access.php';


$group_for 	    =$_SESSION['company_id']=1;
$user_id	    =$_SESSION['user_id'];
$username	    =$_SESSION['username'];
$pg	            =$_SESSION['product_group'];
$region_id	    =$_SESSION['region_id'];
$zone_id	    =$_SESSION['zone_id'];
$area_id	    =$_SESSION['area_id'];


$page="do";

include "inc/header.php";
        

$page_for           ='Sales Return';
$table_master       ='ss_receive_master';
$table_details      ='ss_receive_details';
$unique='or_no';


if($_GET['pal']==2){
		unset($$unique);
		unset($_SESSION['or_no2']);
}

if($_GET['or_no']>0) $_SESSION['or_no2']=$_GET['or_no'];




if(isset($_POST['new'])){

		$crud   = new crud($table_master);

		if(!isset($_SESSION['or_no2'])) {
		$_POST['entry_by']	=$_SESSION['username'];
		$_POST['entry_at']	=date('Y-m-d H:i:s');
		$_POST['edit_by']	=$_SESSION['username'];
		$_POST['edit_at']	=date('Y-m-d H:i:s');
		$_POST['warehouse_id']=$_SESSION['warehouse_id'];
		$_POST['vendor_name']	=find1('select shop_name from ss_shop where dealer_code="'.$_POST['vendor_id'].'"');
		

		$$unique=$_SESSION['or_no2']=$crud->insert();
		//unset($$unique);
		$type=1;
		$msg=$title.'  No Created. (No :-'.$_SESSION['or_no2'].')';	
		?><script>window.location.href = "return_sales.php?or_no=<?=$$unique;?>";</script><?
    	
		    
		} else {
		    
		$_POST['edit_by']	=$_SESSION['username'];
		$_POST['edit_at']	=date('Y-m-d H:i:s');
		$_POST['or_no']		=$_SESSION['or_no2'];
		$_POST['vendor_name']	=find1('select shop_name from ss_shop where dealer_code="'.$_POST['vendor_id'].'"');
		
		$crud->update($unique);
		$type=1;
		$msg='Successfully Updated.';
		}
} // end new

$$unique=$_SESSION['or_no2'];




if(isset($_POST['delete'])){

		$crud   = new crud($table_master);
		$condition=$unique."=".$$unique;		
		$crud->delete($condition);
		$crud   = new crud($table_details);
		$condition=$unique."=".$$unique;		
		$crud->delete_all($condition);
		unset($$unique);
		unset($_SESSION['or_no2']);
		$type=1;
		$msg='Successfully Deleted.';
		?><script>window.location.href='return_sales.php?pal=2';</script><?php 
}

if(isset($_POST['hold'])){
		unset($$unique);
		unset($_SESSION['or_no2']);
		$type=1;
		$msg='Successfully Holded.';
		?><script>window.location.href='return_sales.php?pal=2';</script><?php 
}





if(isset($_POST['confirmm'])){
		unset($_POST);
		$_POST[$unique]=$$unique;
		$_POST['entry_by']=$_SESSION['username'];
		$_POST['entry_at']=date('Y-m-d H:i:s');
		$_POST['status']='CHECKED';
		$crud   = new crud($table_master);
		$crud->update($unique);
		
// bin card entry		
 $sql = 'select a.id,a.item_id,a.qty,a.or_date,a.rate,a.or_no
		from ss_receive_details a
		where a.or_no='.$$unique.' order by a.id';
		
		$query = mysqli_query($conn, $sql);
		while($data=mysqli_fetch_object($query)){

journal_item_ss($data->item_id ,$_SESSION['warehouse_id'],$data->or_date,$data->qty,0,$page_for,$data->id,$data->rate,'',$data->or_no);


} // end bin card hit			




		
		unset($$unique);
		unset($_SESSION['or_no2']);
		$type=1;
		$msg='Successfully Forwarded.';

?><script>window.location.href='return_sales.php?pal=2';</script><?php  
} // End confirm






if(isset($_POST['add'])&&($_POST[$unique]>0)){

$crud   = new crud($table_details);

$_POST['unit_name']=$_POST['unit'];
$_POST['rate']          =$_POST['price'];
$_POST['warehouse_id']  =$_SESSION['warehouse_id'];

$_SESSION['category_id']=$_POST['category_id'];
$_SESSION['subcategory_id']=$_POST['subcategory_id'];

if($_POST['item_id']>0) { 
if($_POST['rate']>0){            	
	unset($_POST['id']);
	$xid = $crud->insert();
} }           
} // end add




if($_GET['del']>0){

		$crud   = new crud($table_details);
		$condition="id=".$_GET['del'];		
		$crud->delete_all($condition);
		$type=1;
		$msg='Successfully Deleted.';
		
}



if($$unique>0)
{
		$condition=$unique."=".$$unique;
		$data=db_fetch_object($table_master,$condition);
		while (list($key, $value)=each($data))
		{ $$key=$value; }
		
}


if($$unique>0) $btn_name='Update'; else $btn_name='Start';

if($_SESSION['or_no2']<1)
$$unique=db_last_insert_id($table_master,$unique);



?>
<script language="javascript">
function focuson(id) {
  if(document.getElementById('id').value=='')
  document.getElementById('id').focus();
  else
  document.getElementById(id).focus();
}

window.onload = function() {
if(document.getElementById("warehouse_id").value>0)
  document.getElementById("id").focus();
  else
  document.getElementById("req_date").focus();
}
</script>

<script language="javascript">
function count(){
var num=((document.getElementById('qty').value)*1)*((document.getElementById('price').value)*1);
document.getElementById('amount').value = num.toFixed(2);	
}
</script>


<section class="content-main">
                <div class="content-header">
					<div>
						<center><h4 class="content-title card-title">Sales Return</h4></center>
					</div>
            	</div>

<div class="card mb-4">
<div class="card-body">
<!--BODY Start	-->
				
<div class="form-container_large">




<form action="" method="post" name="codz" id="codz">
<div class="form-group row">
            <div class="col-1"><label for="or_no" class="col-form-label">NO:</label></div>
            <div class="col-3 mb-1"><div class="col-sm-2"><? $field='or_no';?><input  class="form-control border border-info" name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>" disabled="disabled"/></div></div>

            <div class="col-1"><label for="or_date" class="col-form-label">Date</label></div> 
            <div class="col-5">
			<? $field='or_date'; if($or_date=='') $or_date =date('Y-m-d'); ?>
			<input  class="form-control border border-info" name="<?=$field?>" type="date" id="<?=$field?>" value="<?=$$field?>" required
			<? if($or_date!=''){?> readonly="readonly" <? } ?>
			/></div>
</div>    

<!--hello-->
 
<div class="form-group row mb-2">
    
  <div class="col-2"><label for="shop" class="col-sm-3 col-form-label">Party:</label></div> 
	<div class="col-6"><? $field='vendor_id';?>
<select class="form-control border border-info" name="<?=$field?>" id="<?=$field?>" required/>
<option value="<?=$$field?>"><?=find1("select concat(dealer_code,'-',shop_name) from ss_shop where dealer_code='".$$field."' ");?></option>
<?php optionlist('select s.dealer_code,concat(r.route_name,"-",s.shop_name) as shop_name 
    from ss_shop s, ss_route r 
    where s.route_id=r.route_id and s.status="1" and s.emp_code="'.$_SESSION['username'].'" 
    order by r.route_id,s.shop_name');?>
</select>
</div>
<input  name="receive_type" type="hidden" id="receive_type" value="<?=$page_for?>"  required="required"/>  			  

<div class="col-4">
<button name="new" type="submit" class="btn btn-info"><?=$btn_name?></button>
</div>

		 
<!--<div class="form-group row">		 

		             <div class="col-5">
                      <div class="form-group row">
                        <div class="col-sm-10 text-center mt-3">
                          
                        </div>
                      </div>
			</div>
</div>-->		 				  
                
            

</div> <!--Row end-->


<!--end-->
</form>






















<?php 
//echo 'or_no2='.$_SESSION['or_no2'];
if($_SESSION['or_no2']>0){ ?>

<form action="?<?=$unique?>=<?=$$unique?>" method="post" name="cloud" id="cloud">





<div class="row">

	
	<div class="row form-group col-md-4 mt-3">
		<div class="col-3"><label for="" class=" form-control-label">Category</label></div>
		<div class="col-7">
		<select class=" form-control border border-info" name="category_id" id="category_id" onchange="FetchItemSubcategory(this.value)">
			<option value="<?=$_SESSION['category_id'];?>"><?=find1("select category_name from item_category where id='".$_SESSION['category_id']."'");?></option>
			<?php optionlist("select id,category_name from item_category where 1 order by category_name"); ?>
			<?php //optionlist("select c.id,concat(g.group_name,'>>',c.category_name) as name from item_category c, product_group g where g.id=c.group_id order by c.group_id,c.category_name"); ?>
		</select>
		</div>
	</div>	
	
	
	<div class="row form-group col-md-4">
		<div class="col-3"><label for="" class=" form-control-label">SubCategory</label></div>
		<div class="col-7">
		    <select class=" form-control border border-info" name="subcategory_id" id="subcategory_id" onchange="FetchItem(this.value)">
				    <option value="<?=$_SESSION['subcategory_id'];?>"><?=find1("select subcategory_name from item_subcategory where id='".$_SESSION['subcategory_id']."'");?></option>
				    <?php 
				    if($_SESSION['category_id']>0){$cat_group=" and category_id='".$_SESSION['category_id']."' ";}
				    optionlist("select id,subcategory_name from item_subcategory where 1 ".$cat_group." order by subcategory_name"); ?>
		</select>
		</div>
	</div>	
	

</div>







<table  width="100%" border="1" align="left"  style="border-collapse:collapse; border:1px solid #caf5a5;" cellpadding="2" cellspacing="2">

<tr>
<td>Item:</td>    
<td colspan="3">
<input list="browsers" class="form-control" name="item_id" id="item_id" tabindex="1" onChange="getData()" autocomplete="off" autofocus/>
<datalist id="browsers">
	<?php 
if($_SESSION['subcategory_id']>0){	
	optionlist('select item_id,concat(finish_goods_code,"#",item_name) from item_info where subcategory_id="'.$_SESSION['subcategory_id'].'" and status="Active" order by item_name');
}
	?>
</datalist>
</td>
</tr>

<tr>
<!--<td align="center" bgcolor="#0099FF"><span class="style1">Item Name</span></td>
<td align="center" bgcolor="#0099FF"><span class="style1"><strong>Unit</strong></span></td>-->
<td align="center" bgcolor="#0099FF"><span class="style1"><strong>Rate</strong></span></td>
<td align="center" bgcolor="#0099FF"><span class="style1"><strong>Qty</strong></span></td>
<td align="center" bgcolor="#0099FF"><span class="style1"><strong>Amount</strong></span></td>
<td  rowspan="2" align="center" >
<div class="button">
<!--<input name="add" type="submit" id="add" value="ADD" tabindex="12" class="update"/>-->
<button name="add" type="submit" id="add" class="btn btn-warning" tabindex="12">ADD</button>
</div>

</td>
</tr>

<tr>
<!--<td align="center" bgcolor="#CCCCCC"></td>-->
<input  name="receive_type" type="hidden" id="receive_type" value="<?=$page_for?>"  required="required"/>
<input  name="<?=$unique?>" type="hidden" id="<?=$unique?>" value="<?=$$unique?>"/>
<input  name="warehouse_id" type="hidden" id="warehouse_id" value="<?=$warehouse_id?>"/>
<input  name="or_date" type="hidden" id="or_date" value="<?=$or_date?>"/>
<input  name="vendor_id" type="hidden" id="vendor_id" value="<?=$vendor_id?>"/>
<input  name="vendor_name" type="hidden" id="vendor_name" value="<?=$vendor_name?>"/>



<!--<td align="center" bgcolor="#CCCCCC">
<input name="unit" type="text" class="input3" id="unit" style="width:50px;" value="" readonly="readonly"/>
</td>-->
<td align="center" bgcolor="#CCCCCC">

<input name="price" type="text" class="input3" id="price" style="width:90px;"  onChange="count()" autocomplete="off" />
</td>


<td align="center" bgcolor="#CCCCCC"><input name="qty" type="number" class="input3" id="qty"  maxlength="100" style="width:60px;" onChange="count()" required autocomplete="off"/></td>
<td align="center" bgcolor="#CCCCCC"><input name="amount" type="text" class="input3" id="amount" style="width:90px;" readonly="readonly" required/></td>
      </tr>
</table>
<br /><br /><br /><br />


<table width="100%" border="0" cellspacing="0" cellpadding="0">

    <tr>
      <td>
<div class="tabledesign2">
<? 
$res='select a.id,i.item_name,a.rate,a.qty ,a.amount,"x" 
from ss_receive_details a,item_info i 
where i.item_id=a.item_id and a.or_no='.$or_no.' order by a.id desc';
echo link_report_add_del_auto($res,'',4,5);
?>
</div>
</td>
    </tr>
		
<tr>
<td>
</td>
</tr>
</table>
</form>



<form action="" method="post" name="cz" id="cz">
  <table width="100%" border="0">
    <tr>
      <td align="center"><button name="delete" type="submit" value="delete" class="btn btn-danger">Full Delete</button></td>
	  <td align="center"><button name="hold" type="submit" value="hold" class="btn btn-info">Hold</button></td>
      <td align="center"><button name="confirmm" type="submit" value="CONFIRM" class="btn btn-primary">CONFIRM</button></td>
    </tr>
  </table>
</form>
<? } ?>
</div>				

				

</div>
<!-- main page content ends -->
</main>
<!-- Page ends-->

<?php include "inc/footer.php"; ?>
 
 
<script>
function getData(){
    
var id          = document.getElementById("item_id").value;
var vendor_id = document.getElementById("vendor_id").value;

		jQuery.ajax({
			url:'ajax_return_price.php',
			type:'post',
			data: {id: id, vendor_id: vendor_id},
			success:function(result){
				var json_data=jQuery.parseJSON(result);

				jQuery('#unit').val(json_data.unit);
				jQuery('#price').val(json_data.price);

			}

		})
$( "#qty" ).focus();	
}
</script>  
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<script>
jQuery('.party_list').chosen();
jQuery('.item_list').chosen();
</script>

<script type="text/javascript">
  function FetchItemCategory(id){
    $('#category_id').html('');
    $('#subcategory_id').html('');
    $.ajax({
      type:'post',
      url: 'get_data.php',
      data : { item_group : id},
      success : function(data){
         $('#category_id').html(data);
      }

    })
  }

  function FetchItemSubcategory(id){
    $('#subcategory_id').html('');
    $('#item_id').html('');
    $.ajax({
      type:'post',
      url: 'get_data.php',
      data : { category_id : id},
      success : function(data){
         $('#subcategory_id').html(data);
      }

    })
  }


  function FetchItem(id){
    $('#item_id').html('');
    $.ajax({
      type:'post',
      url: 'get_data.php',
      data : { subcategory_id : id},
      success : function(data){
         $('#browsers').html(data);
      }

    })
  }


</script>