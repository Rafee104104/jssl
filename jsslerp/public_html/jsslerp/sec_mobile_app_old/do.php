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


include "inc/header.php";
//if($_GET['pal']==2) { unset($$unique); unset($_SESSION['do_no2']); $type=1;}


//do_calander('#est_date');
$page = 'do.php';

$table_master='ss_do_master';
$unique_master='do_no';
$table_detail='ss_do_details';
$unique_detail='id';



$dealer = find_all_field('ss_shop','','dealer_code='.$dealer_code);



if($_REQUEST['old_do_no']>0) $$unique_master=$_REQUEST['old_do_no'];
elseif(isset($_GET['del'])) {$$unique_master=find_a_field('ss_do_details','do_no','id='.$_GET['del']); $del = $_GET['del'];}
else
$$unique_master=$_REQUEST[$unique_master];

$do_status = find_a_field('ss_do_master','status','do_no="'.$$unique_master.'"');







if(isset($_POST['delete'])){

if($do_status=='MANUAL'){

		$crud   = new crud($table_master);
		$condition=$unique_master."=".$$unique_master;		
		$crud->delete($condition);
		
		$crud   = new crud($table_detail);
		$crud->delete_all($condition);
		
		unset($$unique_master);
		unset($_POST[$unique_master]);
		$type=1;
		$msg='Successfully Deleted.';
	} 	
}


if(isset($_POST['confirm'])){

if($do_status=='MANUAL'){

		$_POST[$unique_master]=$$unique_master;
		$_POST['entry_at']  =date('Y-m-d H:i:s');
		$_POST['entry_by']  =$_SESSION['username'];
		$_POST['status']    ='CHECKED';
		$_POST['depot_id'] =$_SESSION['warehouse_id'];
		
		$crud   = new crud($table_master);
		$crud->update($unique_master);
		$crud   = new crud($table_detail);
		$crud->update($unique_master);
		
		unset($$unique_master);
		unset($_POST[$unique_master]);
		unset($_POST);
		$type=1;
		$msg='Successfully Instructed to Depot.';
		?><script>window.location.href = "home.php"</script><?
		}else{
		?><script>window.location.href = "home.php"</script><?
		}
}


if(isset($_POST['new'])){
    
		$crud   = new crud($table_master);
		$dealer = find_all_field('ss_shop','','dealer_code='.$_POST['dealer_code']);
		$_POST['status']='MANUAL';
		$_POST['do_date']=date('Y-m-d');
		$_POST['entry_at']=date('Y-m-d H:s:i');
		$_POST['entry_by']= $username;
		if($_POST['shop_status']=='Get Order') { $_POST['memo']=1; }else{$_POST['memo']=0; }

		if($_POST['flag']==0){
		$_POST['do_no'] = find_a_field($table_master,'max(do_no)','1')+1;
		$$unique_master=$crud->insert();
		unset($$unique);
		$type=1;
		$msg='Work Order Initialized. (Demand Order No-'.$$unique_master.')';
		}
		else {
		$crud->update($unique_master);
		$type=1;
		$msg='Successfully Updated.';
		}
}



if(isset($_POST['add'])&&($_POST[$unique_master]>0)){
		$table		=$table_detail;
		$crud      	=new crud($table);

    if($_POST['item_id']>0){
		$_POST['total_unit'] = ($_POST['pkt_unit'] * $_POST['pkt_size']) + $_POST['dist_unit'];
		
		$_POST['total_amt'] = ($_POST['total_unit'] * $_POST['unit_price']);
		$item_info = find_all_field('item_info','*','item_id ='.$_POST['item_id']);
		
		$_POST['t_price'] = $item_info->t_price;
		$_POST['dp_price'] = $item_info->t_price;
		$_POST['fp_price'] = $item_info->f_price;

		$_POST['entry_by'] =$_SESSION['username'];
		$_POST['depot_id'] =$_SESSION['warehouse_id'];
		$_POST['gift_on_order'] = $crud->insert();
		$do_date = date('Y-m-d');
		$_POST['gift_on_item'] = $_POST['item_id'];

		$total_unit = $_POST['total_unit'];

$_SESSION['category_id']=$_POST['category_id'];
$_SESSION['subcategory_id']=$_POST['subcategory_id'];

$sss = "select * from ss_gift_offer where item_id='".$_POST['item_id']."' 
and ((max_qty>='".$total_unit."' and  min_qty<='".$total_unit."') or (max_qty=0 and  min_qty=0)) and start_date<='".$do_date."' and end_date>='".$do_date."'  ";

		$qqq = mysqli_query($conn,$sss);

		while($gift=mysqli_fetch_object($qqq)){
		
		if($gift->item_qty>0)
		{
			$_POST['gift_id'] = $gift->id;
			$gift_item = find_all_field('item_info','','item_id="'.$gift->gift_id.'"');
			$_POST['item_id'] = $gift->gift_id;
			
		$_POST['dp_price'] = $gift_item->t_price;
		$_POST['fp_price'] = $gift_item->f_price;
			
			if($gift->gift_id== 1096000100010239)
			{
			$_POST['unit_price'] = (-1)*($gift->gift_qty);
			$_POST['total_amt']  = (((int)($total_unit/$gift->item_qty))*($_POST['unit_price']));
			$_POST['total_unit'] = (((int)($total_unit/$gift->item_qty)));
			
			$_POST['dist_unit'] = $_POST['total_unit'];
			$_POST['pkt_unit']  = '0.00';
			$_POST['pkt_size']  = '1.00';
			$_POST['t_price']   = '-1.00';
			$_POST['entry_by'] =$username;
			$crud->insert();
			}
			elseif($gift->gift_id== 1096000100010312)
			{
			$_POST['unit_price'] = (-1)*($gift->gift_qty);
			$_POST['total_amt']  = (((int)($total_unit/$gift->item_qty))*($_POST['unit_price']));
			$_POST['total_unit'] = (((int)($total_unit/$gift->item_qty)));
			
			$_POST['dist_unit'] = $_POST['total_unit'];
			$_POST['pkt_unit']  = '0.00';
			$_POST['pkt_size']  = '1.00';
			$_POST['t_price']   = '-1.00';
			$_POST['entry_by'] =$username;
			$crud->insert();
			}
			else
			{
			$_POST['unit_price'] = '0.00';
			$_POST['total_amt'] = '0.00';
			$_POST['total_unit'] = (((int)($total_unit/$gift->item_qty))*($gift->gift_qty));
			
			$_POST['dist_unit'] = ($_POST['total_unit']%$gift_item->pack_size);
			$_POST['pkt_unit'] = (int)($_POST['total_unit']/$gift_item->pack_size);
			$_POST['pkt_size'] = $gift_item->pack_size;
			$_POST['t_price'] = '0.00';
			if($_POST['unit_price']==0&&$_POST['total_unit']==0)
			{echo '';
			}
			else
			$_POST['entry_by'] =$username;
			$crud->insert();
			}//
//		unset($_POST['gift_id']);
//		unset($_POST['gift_on_order']);
//		unset($_POST['gift_on_item']);
		}
}
} // end if item id >0
}



if($del>0){	

		$main_del = find_a_field($table_detail,'gift_on_order','id = '.$del);
		$crud   = new crud($table_detail);
		if($del>0)
		{
			$condition=$unique_detail."=".$del;		
			$crud->delete_all($condition);
			
			$condition="gift_on_order=".$del;		
			$crud->delete_all($condition);
			
			if($main_del>0){
			$condition=$unique_detail."=".$main_del;		
			$crud->delete_all($condition);
			$condition="gift_on_order=".$main_del;		
			$crud->delete_all($condition);}
		}
		$type=1;
		$msg='Successfully Deleted.';
}


if($$unique_master>0)
{
		$condition=$unique_master."=".$$unique_master;
		$data=db_fetch_object($table_master,$condition);
		while (list($key, $value)=@each($data))
		{ $$key=$value;}
		
}



$dealer = find_all_field('ss_shop','','dealer_code='.$dealer_code);

auto_complete_from_db('item_info','concat(finish_goods_code,"#>",item_name)','finish_goods_code','product_nature="Salable" and status="Active" order by finish_goods_code','item');
?>



<script language="javascript">

function count(){

if(document.getElementById('pkt_unit').value!=''){
var pkt_unit = ((document.getElementById('pkt_unit').value)*1);
var dist_unit = ((document.getElementById('dist_unit').value)*1);
var pkt_size = ((document.getElementById('pkt_size').value)*1);
var total_unit = (pkt_unit*pkt_size)+dist_unit;

var unit_price = ((document.getElementById('unit_price').value)*1);
var total_amt  = (total_unit*unit_price);
document.getElementById('total_unit').value=total_unit;
document.getElementById('total_amt').value	= total_amt.toFixed(2);
var do_total = ((document.getElementById('do_total').value)*1);
var do_ordering	= total_amt+do_total;
document.getElementById('do_ordering').value =do_ordering.toFixed(2);
}
else
document.getElementById('pkt_unit').focus();
}
</script>



<script language="javascript">
function focuson(id) {
  if(document.getElementById('item').value=='')
  document.getElementById('item').focus();
  else
  document.getElementById(id).focus();
}

window.onload = function() {
if(document.getElementById("flag").value=='0')
  document.getElementById("rcv_amt").focus();
  else
  document.getElementById("item_id").focus();
}
</script>



<script language="javascript">
function grp_check(id){
    
if(document.getElementById("item_id").value!=''){
var myCars=new Array();
myCars[0]="01815224424";
<?
$item_i = 1;
$sql_i='select finish_goods_code from item_info where sales_item_type like "%'.$dgp.'%" and product_nature="Salable" and status="Active"';
$query_i=mysqli_query($conn,$sql_i);
while($is=mysqli_fetch_object($query_i))
{
	echo 'myCars['.$item_i.']="'.$is->finish_goods_code.'";';
	$item_i++;
}
?>
var item_check=id;
var f=myCars.indexOf(item_check);
if(f>0)
getData2('do_ajax_grp_check.php', 'do',document.getElementById("item").value,'<?=$dealer->dealer_code;?>');
else
{
alert('Item is not Accessable');
document.getElementById("item").value='';
document.getElementById("item").focus();
}}
}
</script>






<div class="page-wrapper">

<div class="separator-small"></div>
<div class="container">
<div class="form-wrapper">

<?php
// $app_entry_status = find_a_field('config_group_class','zi_do','group_for=3');
// if($app_entry_status==0){ die('<p><h2>Right now DO Off From Head Office</h2>
// <h3>So try Later..</h3>
// <br><p>
// <h4><a href="home.php">Click Here: Go to Home Page</a></h4>
// ');
// }

?>










<form action="" method="post" name="codz2" id="codz2">
<input  class="form-control" name="visit" type="hidden" id="visit" value="1" required readonly="readonly"/>

<div class="input-wrap row well">

<div class="form-group">
<label>Shop</label>
<select class="form-control" name="dealer_code" required="required" id="dealer_code">
    <option value="<?=$dealer_code?>"><?=find1("select concat(dealer_code,'-',shop_name) from ss_shop where dealer_code='".$dealer_code."' ");?></option>
    <? if($dealer_code==''){
    optionlist('select s.dealer_code,concat(r.route_name,"-",s.shop_name) as shop_name 
    from ss_shop s, ss_route r 
    where s.route_id=r.route_id and s.status="1" 
    order by r.route_id,s.shop_name');
    } ?>
    </select> 
</div>



<div class="form-group">
<label for="inputName" class="col-form-label">Order</label>
<input class="form-control" name="do_no" id="do_no" placeholder="do_no" 
value="<? if($$unique_master>0) echo $$unique_master; else echo (find_a_field($table_master,'max('.$unique_master.')','1')+1);?>" readonly="readonly">
</div>



<div class="form-group">
<label>Date : </label>

			<? $field='do_date'; if($do_date=='') $do_date =date('Y-m-d'); ?>
			<input  class="form-control border border-info" name="<?=$field?>" type="date" id="<?=$field?>" value="<?=$$field?>" required
			<? if($do_date!=''){?>  <? } ?> />
</div>



<div class="form-group">
<label>Status</label>
<? $field='shop_status';?>
<select class="form-control" name="<?=$field?>" id="<?=$field?>" required>
    <option><? echo $$field?$$field:'Get Order'; $shop_status=$$field;?></option>
    <option>Get Order</option>
    <option>No Order</option>
    <option>Close</option>
</select>
</div>


<div class="form-group">
<label>Note</label>
<input class="form-control" name="remarks" id="remarks" placeholder="remarks" 
value="<?=$remarks?>">
</div>

<br>
<br>
<br>
<div class="form-group text-center">
<a href="do_view.php?do=<?php echo $$unique_master;?>" class="btn btn-warning" role="button">View</a>
&emsp;
&emsp;
&emsp;
<? if($$unique_master>0) {?>
          <input name="new" type="submit" class="btn btn-primary" value="Update" />
          <input name="flag" id="flag" type="hidden" value="1" />
	
		  <? }else{?>
		  <input name="new" type="submit" class="btn btn-success" value="Initiate"/>
          <input name="flag" id="flag" type="hidden" value="0" />
	
		  <? }?>


</div>

</div>
<!--End ROW -->

</form>






<div class="separator-small"></div>
<form action="?<?=$unique_master?>=<?=$$unique_master?>" method="post" name="codz2" id="codz2">
<? if($$unique_master>0){ ?>



<div class="row">

<div class="form-group">
<label for="" class=" form-control-label">Category</label>
		<select class=" form-control border border-info" name="category_id" id="category_id" onchange="FetchItemSubcategory(this.value)">
			<option value="<?=$_SESSION['category_id'];?>"><?=find1("select category_name from item_category where id='".$_SESSION['category_id']."'");?></option>
			<?php optionlist("select id,category_name from item_category where 1 order by category_name"); ?>
			<?php //optionlist("select c.id,concat(g.group_name,'>>',c.category_name) as name from item_category c, product_group g where g.id=c.group_id order by c.group_id,c.category_name"); ?>
		</select>
</div>


<div class="form-group">
<label for="" class=" form-control-label">SubCategory</label>
		    <select class=" form-control border border-info" name="subcategory_id" id="subcategory_id" onchange="FetchItem(this.value)">
				    <option value="<?=$_SESSION['subcategory_id'];?>"><?=find1("select subcategory_name from item_subcategory where id='".$_SESSION['subcategory_id']."'");?></option>
				    <?php 
				    if($_SESSION['category_id']>0){$cat_group=" and category_id='".$_SESSION['category_id']."' ";}
				    optionlist("select id,subcategory_name from item_subcategory where 1 ".$cat_group." order by subcategory_name"); ?>
		</select>
</div>

<div class="form-group">
<label>Item Code</label>
<input list="browsers" class="form-control" name="item_id" id="item_id" tabindex="1" onChange="getData()" autocomplete="off" autofocus/>
<datalist id="browsers">
	<?php 
if($_SESSION['subcategory_id']>0){	
	optionlist('select item_id,concat(finish_goods_code,"#",item_name) from item_info where subcategory_id="'.$_SESSION['subcategory_id'].'" and status="Active" order by item_name');
}
	?>
</datalist>
</div>




<div class="form-group">
<label>TP</label>

<input name="do_date" type="hidden" id="do_date" value="<?=$do_date;?>" readonly="readonly"/>
<input name="do_no" type="hidden" id="do_no" value="<?=$do_no;?>" readonly="readonly"/>
<input name="group_for" type="hidden" id="group_for" value="<?=$dealer->product_group;?>" readonly="readonly"/>
<input name="dealer_code" type="hidden" id="dealer_code" value="<?=$dealer->dealer_code;?>"/>
<input name="depot_id" type="hidden" id="depot_id" value="<?=$dealer->depot;?>"/>
<input name="flag" id="flag" type="hidden" value="1" />
<input style="width:10px;"  name="group_for" type="hidden" id="group_for" value="<?=$dealer->product_group;?>" readonly="readonly"/>

<input name="unit_price2" type="number" step="0.01" class="form-control input3" id="unit_price2"  value="<?=$item_all->t_price?>" />
</div>






<div class="form-group">
<label>%</label>
<input type="hidden" id="nsp_per2"  value="<?=$item_all->nsp_per?>" />
    <input name="nsp_per" type="number" min="0" max="0" step="0.01" class="form-control input3" id="nsp_per" onChange="update_nsp_amt()" value="<?=$item_all->nsp_per?>" />

</div>






<div class="form-group">
<label>Rate</label>
<input name="unit_price" type="number"  class="form-control " id="unit_price"  value="<?=$item_all->t_price?>" readonly="readonly"/>
<input name="pkt_size" type="hidden" class="form-control input3" id="pkt_size"    value="<?=$item_all->pack_size?>" readonly="readonly"/>
</div>




<div class="form-group">
<label>Pcs</label>
<input name="pkt_unit" type="number" class="form-control" id="pkt_unit" onKeyUp="count()" required="required"  tabindex="4"/>
<input name="total_unit" type="hidden" class="input3" id="total_unit"   readonly="readonly"/>
<input name="total_amt" type="hidden" class="input3" id="total_amt"  readonly="readonly"/>
</div>

<br><br>
<div class="form-group text-center">
<input name="add" type="submit" id="add" value="ADD" onClick="count()" class="btn btn-success" tabindex="5"/>
</div>
	
	
	

</div>




				  
<div class="separator-small"></div>
<table class="table table-sm" border="0" cellspacing="0" cellpadding="0" align="left">

<tr>
<td>

<div class="tabledesign2">
<? 
$res='select a.id,concat(b.finish_goods_code,"-",b.item_name) as Item,a.t_price,a.nsp_per as "%",a.unit_price as rate,a.pkt_unit as Pcs,a.total_amt,"X" 
from ss_do_details a,item_info b 
where b.item_id=a.item_id and a.do_no='.$$unique_master.' order by a.id';
echo link_report_add_del_auto($res,'',6,7);
?>

</div>
</td>
</tr>
	    	
	

				
</table>

</form>


<form action="" method="post" name="cz" id="cz" onSubmit="if(!confirm('Are You Sure Execute this?')){return false;}">
<div class="row" >

<div class="col-6">
<input  name="do_no" type="hidden" id="do_no" value="<?=$$unique_master?>"/>    
<input name="delete"  type="submit" class="btn1" value="DELETE DO" style="width:100px; font-weight:bold; font-size:12px;color:#F00; height:30px" />
</div>

<div class="col-6"> 
<? 
$check_item = find1("select count(*) from ss_do_details where do_no='".$$unique_master."'");
if($shop_status=='Get Order' && $check_item>0){ ?>
<input name="confirm" type="submit" class="btn1" value="CONFIRM" style="width:100px; font-weight:bold; font-size:12px; height:30px; color:#090; float:right" />
<? }elseif($shop_status!='Get Order'){ ?>
<input name="confirm" type="submit" class="btn1" value="CONFIRM" style="width:100px; font-weight:bold; font-size:12px; height:30px; color:#090; float:right" />
<? } ?>
</div>

</div><!--end row-->

<input type="hidden" name="latitude" id="latitude"  value="" readonly="">
<input type="hidden" name="longitude" id="longitude"  value="" readonly=""> 

</form>

<? } ?>

</div></div>
<script>
    // $("#cz").validate();$("#cloud").validate();
</script>

</div>
<?php include "inc/footer.php"; ?>

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

<script>

function update_nsp_amt(){


var tp_id = document.getElementById("unit_price2").value;
var nsp_per_id = document.getElementById("nsp_per").value; 


var final_amt =  tp_id-((nsp_per_id/100)*tp_id);

jQuery('#unit_price').val(final_amt);
    
}    

function getData(){
    
var id = document.getElementById("item_id").value;

		jQuery.ajax({
			url:'do_ajax.php',
			type:'post',
			data:'id='+id,
			success:function(result){
				var json_data=jQuery.parseJSON(result);

				jQuery('#unit_price2').val(json_data.price);
				jQuery('#unit_name').val(json_data.unit);
				jQuery('#pkt_size').val(json_data.pkt_size);
				jQuery('#nsp_per').val(json_data.nsp_per);
				jQuery('#nsp_per2').val(json_data.nsp_per);
				jQuery('#unit_price').val(json_data.nsp_amt);
				jQuery('#nsp_per').attr('max',json_data.nsp_per );

			}

		})
	
}
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
