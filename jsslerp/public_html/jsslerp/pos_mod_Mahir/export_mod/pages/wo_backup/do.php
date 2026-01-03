<?php

session_start();

ob_start();


require_once "../../../assets/template/layout.top.php";

$title='Sales Order Entry';

do_calander('#do_date');
do_calander('#delivery_date');

//create_combobox('dealer_code');

$now = date('Y-m-d H:s:i');

if($_GET['cbm_no']>0)
$cbm_no =$_SESSION['cbm_no'] = $_GET['cbm_no'];

$cdm_data = find_all_field('raw_input_sheet','','cbm_no='.$cbm_no);

do_calander('#est_date');

$page = 'do.php';

$table_master='sale_do_master';

$unique_master='do_no';

$table_detail='sale_do_details';

$unique_detail='id';


$table_chalan='sale_do_chalan';

$unique_chalan='id';


if($_REQUEST['old_do_no']>0)

$$unique_master=$_REQUEST['old_do_no'];

elseif(isset($_GET['del']))

{$$unique_master=find_a_field('sale_do_details','do_no','id='.$_GET['del']); $del = $_GET['del'];}

else

$$unique_master=$_REQUEST[$unique_master];

if(prevent_multi_submit()){





if(isset($_POST['new']))



{



		$crud   = new crud($table_master);



		$_POST['entry_at']=date('Y-m-d H:s:i');



		$_POST['entry_by']=$_SESSION['user']['id'];



		if($_POST['flag']<1){



		$_POST['do_no'] = find_a_field($table_master,'max(do_no)','1')+1;



		$$unique_master=$crud->insert();



		unset($$unique);



		$type=1;



		$msg='Sales Return Initialized. (Sales Return No-'.$$unique_master.')';



		}



		else {



		$crud->update($unique_master);



		$type=1;



		$msg='Successfully Updated.';



		}



}




if(isset($_POST['add'])&&($_POST[$unique_master]>0))

{


//$crud   = new crud($table_master);
//
//$_POST['edit_at']=date('Y-m-d H:i:s');
//$_POST['edit_at']=$_SESSION['user']['id'];
//$dealer = explode('-',$_POST['dealer_code']);
//$dealer_code = $_POST['dealer_code'] = $dealer[0];
//
//
// $dealer_ledger =  find_a_field('dealer_info','account_code','dealer_code="'.$dealer_code.'"');
// $dealer_balance = find_a_field('journal','sum(dr_amt-cr_amt)','ledger_id="'.$dealer_ledger.'"');
//
//
// if($dealer_balance<0) {
//  $closing_balance =  $dealer_balance*(-1); 
// }else {
//  $closing_balance = $dealer_balance;
// }
// 
// $dealer_total_sale = find_a_field('journal','sum(dr_amt)','ledger_id="'.$dealer_ledger.'"');
// 
//  $sales_percentage = ($closing_balance/$dealer_total_sale)*100;
// 		
	
 
 
// if($sales_percentage<20){
// 	$_POST['order_create'] = 'Yes';
// }else {
//  $_POST['order_create'] = 'No';
// }
 
 //
//  if($dealer_balance<0 ) {
//  	$_POST['order_create'] = 'Yes';
//	} elseif($dealer_balance==0) {
//	$_POST['order_create'] = 'Yes';
//	}elseif ($dealer_balance>0 & $sales_percentage<20 ) {
//	$_POST['sales_percentage'] = $sales_percentage;
//	$_POST['order_create'] = 'Yes';
//	}else {
//	$_POST['sales_percentage'] = $sales_percentage;
// 	$_POST['order_create'] = 'No';
// 	}
//	
//	


//
//$customer = explode('-',$_POST['via_customer']);
//$via_customer = $_POST['via_customer'] = $customer[0];
//
//if($_POST['flag']<1){
//$_POST['entry_at']=date('Y-m-d H:i:s');
//$_POST['entry_by']=$_SESSION['user']['id'];
//$_POST['do_no'] = find_a_field($table_master,'max(do_no)','1')+1;
//$$unique_master=$crud->insert();
//unset($$unique);
//$type=1;
//$msg='Work Order Initialized. (Demand Order No-'.$$unique_master.')';
//}

$table		=$table_detail;

if($_POST['sub_group_id']!=0){
$_SESSION['sub_group'] = $_POST['sub_group_id'];
$_SESSION['dealer_code'] = $_POST['dealer_code'];
$_SESSION['group_for'] = $_POST['group_for'];
}

$crud      	=new crud($table);


$_POST['entry_at']=date('Y-m-d H:i:s');
$_POST['entry_by']=$_SESSION['user']['id'];


if($_REQUEST['init_bag_unit']<1){

$_POST['init_bag_unit'] = $_REQUEST['bag_unit'];
$_POST['init_dist_unit'] = $_REQUEST['total_unit'];
$_POST['init_total_unit'] = $_REQUEST['total_unit'];
$_POST['init_total_amt'] = $_REQUEST['total_amt'];

}




$xid = $crud->insert();
if($_REQUEST['bag_unit']>0){
$item_id = $_POST['item_id'];
 $r_sql = "select i.item_id,g.gunny_bag as gunny,g.poly_bag as poly from item_info i,item_sub_group g where  i.sub_group_id=g.sub_group_id and i.item_id=".$item_id;
$r1=mysql_query($r_sql);
while($rs1=mysql_fetch_object($r1))
{
			$item_id = $rs1->item_id;
			$item_gunny=$rs1->gunny;
			$item_poly=$rs1->poly;
if($item_gunny>0){
$gunny_price =find_a_field('item_info','d_price',' item_id='.$item_gunny);
$_REQUEST['total_amt'] = $gunny_price*$_REQUEST['bag_unit']; 

$gunny_sql = "INSERT INTO `sale_do_details` 
(`do_no`,  `do_date`, dealer_code,  via_customer, `item_id`, depot_id,`unit_price`, `bag_unit`, dist_unit, total_unit, `total_amt`,   entry_by, entry_at) VALUES
('".$do_no."',  '".$_POST['do_date']."', '".$_POST['dealer_code']."',  '".$_POST['via_customer']."',  '".$item_gunny."', 
 '".$_POST['depot_id']."', '".$gunny_price."', '".$_REQUEST['bag_unit']."', '".$_REQUEST['bag_unit']."', '".$_REQUEST['bag_unit']."',
  '".$_REQUEST['total_amt']."', '".$_SESSION['user']['id']."', '".$now."')";

mysql_query($gunny_sql);

			}
			
			
if($item_poly>0){
$poly_price=find_a_field('item_info','d_price',' item_id='.$item_poly);

$_REQUEST['total_amt'] = $poly_price*$_REQUEST['bag_unit'];

$gunny_sql = "INSERT INTO `sale_do_details` 
(`do_no`,  `do_date`, dealer_code,  via_customer,  `item_id`, depot_id, `unit_price`, `bag_unit`, dist_unit, total_unit, `total_amt`,   entry_by, entry_at) VALUES
('".$do_no."',  '".$_POST['do_date']."', '".$_POST['dealer_code']."',  '".$_POST['via_customer']."',  '".$item_poly."',  
 '".$_POST['depot_id']."',  '".$poly_price."', '".$_REQUEST['bag_unit']."',  '".$_REQUEST['bag_unit']."', '".$_REQUEST['bag_unit']."', 
 '".$_REQUEST['total_amt']."',   '".$_SESSION['user']['id']."', '".$now."')";

mysql_query($gunny_sql);



}
}

//if($_POST['group_for']==5){
//
//$gunny =find_all_field('item_info','',' item_id="900120001" ');
//
//$_REQUEST['init_total_amt'] = $gunny->d_price*$_REQUEST['init_bag_unit'];
//
//  $gunny_sql = "INSERT INTO `sale_do_details` 
//(`do_no`, `do_date`, dealer_code, `item_id`, `unit_price`, `init_bag_unit`,`init_total_amt`) VALUES
//('".$do_no."', '".$do_date."', '".$dealer_code."', '".$gunny->item_id."',  '".$gunny->d_price."', '".$_REQUEST['init_bag_unit']."',  '".$_REQUEST['init_total_amt']."')";
//
//mysql_query($gunny_sql);
//
//}



}



//$table_ch		=$table_chalan;


//$crud      	=new crud($table_ch);


//$cid = $crud->insert();

  //$challan_sql = "INSERT INTO `sale_do_chalan` 
// (`chalan_no`, `order_no`, do_no, `item_id`, `dealer_code`, `unit_price`,`pkt_unit`, bag_unit, dist_unit, total_unit, total_amt, chalan_date, depot_id, group_for, entry_by, entry_at) VALUES
//('".$_POST['chalan_no']."', '".$xid."', '".$_POST['do_no']."', '".$_POST['item_id']."',  '".$_POST['dealer_code']."', '".$_POST['unit_price']."',  '".$_POST['pkt_unit']."', '".$_POST['bag_unit']."', '".$_POST['dist_unit']."' , '".$_POST['total_unit']."' , '".$_POST['total_amt']."' , '".$_POST['do_date']."' ,'4', '".$_POST['group_for']."', '".$_SESSION['user']['id']."', '".$now."' )";
//
//mysql_query($challan_sql);


   










//$_POST['init_total_unit'] = $_POST['init_dist_unit'];

//$_POST['in_stock_kg']=$_POST['in_stock'];

//$_POST['init_total_amt'] = ($_POST['init_total_unit'] * $_POST['unit_price']);

//$_POST['t_price'] = 0;

//$_POST['gift_on_order'] = $crud->insert();

}

}

else

{

$type=0;

$msg='Data Re-Submit Error!';

}

if($del>0)

{	

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


 $sql1 = "delete from journal_item where tr_from = 'Sales' and tr_no = '".$del."'";


		mysql_query($sql1);




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

$dealer = find_all_field('dealer_info','','dealer_code='.$dealer_code);

auto_complete_from_db('dealer_info','item_name','concat(item_name,"#>",finish_goods_code)','','vai_cutomer');

auto_complete_from_db('area','area_name','area_code','','district');

auto_complete_from_db('customer_info','customer_name_e ','customer_code',' dealer_code='.$dealer_code,'via_customer1');

?>

<script language="javascript">

function count(){

//var unit_price=(document.getElementById('unit_price').value)*1; 
//var bag_size=(document.getElementById('bag_size').value)*1;
//var init_bag_unit=(document.getElementById('init_bag_unit').value)*1;  
//var init_dist_unit=(document.getElementById('init_dist_unit').value)=(bag_size*init_bag_unit);
//document.getElementById('init_total_unit').value=(init_dist_unit*1);
//document.getElementById('init_total_amt').value=(unit_price*init_dist_unit);
//var dist_unit=(document.getElementById('dist_unit').value)*1; 
//document.getElementById('total_unit').value=(dist_unit*1);
//document.getElementById('total_amt').value=(unit_price*dist_unit);



var unit_price=(document.getElementById('unit_price').value)*1; 

var total_unit=(document.getElementById('total_unit').value)*1; 

document.getElementById('total_amt').value=(unit_price*total_unit);

}



function comm_cal() {

var init_total_amt=(document.getElementById('init_total_amt').value*1);

var comm_amount=(document.getElementById('commission2').value*1);

var ctn=(document.getElementById('init_pkt_unit').value*1);

document.getElementById('commission').value=(ctn*comm_amount);

var tot_comm=(document.getElementById('commission').value*1);

document.getElementById('net_amount').value=(init_total_amt-tot_comm);

}



window.onload = function() {
  document.getElementById("itemin").focus();
};






</script>

<script language="javascript">



function wait1sec() {
    setTimeout(function () {}, 1000);
}


window.onload = function() {
if(document.getElementById("flag").value=='0')
document.getElementById("dealer_code").focus();
else
document.getElementById("itemin").focus();
}


function avail_amount(){

var received_amt=(document.getElementById('received_amt').value*1);

var net_amount=(document.getElementById('net_amount').value*1);

var available_amt=received_amt-net_amount;

document.getElementById('received_amt2').value=available_amt.toFixed(2);

if(available_amt<0){

document.getElementById("add").disabled = true;

document.getElementById("confirm").disabled = true;

alert('You Can\'t make order more then received amount from this Dealer!');

}else{document.getElementById("add").disabled = false;

document.getElementById("confirm").disabled = false;

}

}

</script>

<script language="javascript">

function grp_check(id)

{

if(document.getElementById("itemin").value!=''){

var itemin = document.getElementById("itemin").value;
var item_id = itemin.split(' #',1);
document.getElementById("item").value = item_id;
getData2('do_ajax.php', 'do',document.getElementById("item").value,'<?=$do_no;?>');

}

}


</script>
<style type="text/css">



.onhover:focus{
background-color:#66CBEA;

}


<!--
.style2 {
	color: #FFFFFF;
	font-weight: bold;
}
.style3 {font-weight: bold}
.style4 {font-weight: bold}
-->
</style>


<div class="form-container_large">

<form action="<?=$page?>" method="post" name="codz2" id="codz2">

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">

<tr>

<td width="58%">

<fieldset style="width:450px;">

<div>
<div>

<label style="width:100px;">Order No: </label>

<input style="width:250px;"  name="do_no" type="text" id="do_no" value="<? if($$unique_master>0) echo $$unique_master; else echo (find_a_field($table_master,'max('.$unique_master.')','1')+1);?>" readonly/>

<? if($cbm_no<1) {?>
<input   name="cbm_no" id="cbm_no" readonly  type="hidden" value="<?=$cdm_data->cbm_no?>"/>

<? }?>

<? if($cbm_no>0) {?>
<input   name="cbm_no" id="cbm_no" readonly  type="hidden" value="<?=$cbm_no?>"/>
<? }?>

</div>




<? if($group_for<1) {?>

<div>

<label style="width:100px;">Concern:</label>
<input   name="group_for" id="group_for" readonly  type="hidden" value="<?=$cdm_data->group_for?>"/>
<input  style="width:250px;" name="group_for2" id="group_for2" readonly  type="text" value="<?=find_a_field('user_group','group_name','id='.$cdm_data->group_for)?>"/>

</div>


<? }?>

<? if($group_for>0) {?>

<div>

<label style="width:100px;">Concern:</label>

<input   name="group_for" id="group_for" readonly  type="hidden" value="<?=$group_for?>"/>
<input  style="width:250px;" name="group_for2" id="group_for2" readonly  type="text" value="<?=find_a_field('user_group','group_name','id='.$group_for)?>"/>
</div>
<? }?>



<? if($dealer_code<1) {?>
<div>

<label style="width:100px;">Customer:</label>
<input   name="dealer_code" id="dealer_code" readonly  type="hidden" value="<?=$cdm_data->dealer_code?>"/>
<input  style="width:250px;" name="group_for2" id="group_for2" readonly  type="text" value="<?=find_a_field('dealer_info','dealer_name_e','dealer_code='.$cdm_data->dealer_code)?>"/>

</div>


<? }?>

<? if($dealer_code>0) {?>

<div>

<label style="width:100px;">Customer:</label>
<input   name="dealer_code" id="dealer_code" readonly  type="hidden" value="<?=$dealer_code?>"/>
<input  style="width:250px;" name="group_for2" id="group_for2" readonly  type="text" value="<?=find_a_field('dealer_info','dealer_name_e','dealer_code='.$dealer_code)?>"/>

</div>


<? }?>



<? if($buyer_code<1) {?>

<div>

<label style="width:100px;">Buyer:</label>
<input   name="buyer_code" id="buyer_code" readonly  type="hidden" value="<?=$cdm_data->buyer_code?>"/>
<input  style="width:250px;" name="group_for2" id="group_for2" readonly  type="text" value="<?=find_a_field('buyer_info','buyer_name','buyer_code='.$cdm_data->buyer_code)?>"/>

</div>

<? }?>

<? if($buyer_code>0) {?>

<div>

<label style="width:100px;">Buyer:</label>
<input   name="buyer_code" id="buyer_code" readonly  type="hidden" value="<?=$buyer_code?>"/>
<input  style="width:250px;" name="group_for2" id="group_for2" readonly  type="text" value="<?=find_a_field('buyer_info','buyer_name','buyer_code='.$buyer_code)?>"/>

</div>

<? }?>

<? if($merchandizer_code<1) {?>

<div>

<label style="width:100px;">Merchandizer:</label>
<input   name="merchandizer_code" id="merchandizer_code" readonly  type="hidden" value="<?=$cdm_data->merchandizer_code?>"/>
<input  style="width:250px;" name="group_for2" id="group_for2" readonly  type="text" value="<?=find_a_field('merchandizer_info','merchandizer_name','merchandizer_code='.$cdm_data->merchandizer_code)?>"/>

</div>


<? }?>

<? if($merchandizer_code>0) {?>

<div>

<label style="width:100px;">Merchandizer:</label>
<input   name="merchandizer_code" id="merchandizer_code" readonly  type="hidden" value="<?=$merchandizer_code?>"/>
<input  style="width:250px;" name="group_for2" id="group_for2" readonly  type="text" value="<?=find_a_field('merchandizer_info','merchandizer_name','merchandizer_code='.$merchandizer_code)?>"/>

</div>

<? }?>




</div>




</fieldset></td>

<td width="42%"><fieldset style="width:450px;">


<? if($do_date=="") {?>
<div>

<label style="width:140px;">Order Date: </label>

<input style="width:220px;"  name="do_date" type="text" id="do_date" value="<?=($do_date!='')?$do_date:date('Y-m-d')?>"  required
onchange="getData2('job_no_ajax.php', 'job_no', this.value,document.getElementById('do_no').value);"/>

</div>
<? }?>


<? if($do_date!="") {?>
<div>
<label style="width:140px;">Order Date: </label>
<input style="width:220px;"  name="do_date" type="hidden" id="do_date" value="<?=$do_date;?>"  required/>

<input style="width:220px;"  name="do_date2" type="text" id="do_date2" value="<?=$do_date;?>" readonly="" required/>
</div>
<? }?>


<? if($job_no=="") {?>
<div>
<label style="width:140px;">Job No: </label>
<span id="job_no">
<?
 	 $year=date('Y');
	 $month=date('m');
	 $do_menual = find_a_field($table_master,'max('.$unique_master.')','1')+1;
	 $job_no_generate='NPL-'.$year.'-'.$month.'-'.$do_menual;
?>
<input name="job_no" type="text" id="job_no" style="width:220px;" value="<?=$job_no_generate?>" readonly="" tabindex="105" />
</span>

</div>

<? }?>


<? if($job_no!="") {?>
<div>
<label style="width:140px;">Job No: </label>
<input name="job_no" type="text" id="job_no" style="width:220px;" value="<?=$job_no?>" readonly="" tabindex="105" />
</div>

<? }?>



<div>

<label style="width:140px;">Delivery Date: </label>

<input style="width:220px;"  name="delivery_date" type="text" id="delivery_date" value="<?=$delivery_date;?>"  required/>

</div>




<div>

<label style="width:140px;">PO/Style: </label>

 
		 <input name="po_no" type="text" id="po_no" required style="width:220px;" value="<?=$po_no?>" tabindex="105" />

</div>






<? if($delivery_place<1) {?>
<div>

<label style="width:140px;">Delivery Place: </label>

<select  name="delivery_place" id="delivery_place"  style="width:220px;" required>

	<option></option>	
      <? foreign_relation('delivery_place_info','id','delivery_place',$delivery_place,'dealer_code="'.$cdm_data->dealer_code.'" ');?>
		 </select>

</div>

<? }?>

<? if($delivery_place>0) {?>
<div>

<label style="width:140px;">Delivery Place: </label>

		 <input name="debit_head2" type="text" id="debit_head2" required readonly="" style="width:220px;" 
		 value="<?=find_a_field('delivery_place_info','delivery_place','id='.$delivery_place);?>" tabindex="105" />

 
		 <input name="delivery_place" type="hidden" id="delivery_place" required readonly="" style="width:220px;" value="<?=$delivery_place?>" tabindex="105" />

</div>
<? }?>




<div>

<label style="width:140px;">Remarks: </label>

<input name="remarks" type="text" id="remarks" style="width:220px;" value="<?=$remarks?>" tabindex="105" />
<input name="depot_id" type="hidden" id="depot_id" style="width:220px;" value="<?=$_SESSION['user']['depot']?>" tabindex="105" />

</div>


</fieldset></td>

</tr>

<td colspan="3">



	



		<div class="buttonrow" style="margin-left:320px;">



		<? if($$unique_master>0) {?>



		<input name="new" type="submit" class="btn1" value="Update Work Order" style="width:250px; font-weight:bold; font-size:12px;" tabindex="12" />



		<input name="flag" id="flag" type="hidden" value="1" />



		<? }else{?>



		<input name="new" type="submit" class="btn1" value="Initiate Work Order" style="width:250px; font-weight:bold; font-size:12px;" tabindex="12" />



		<input name="flag" id="flag" type="hidden" value="0" />



		<? }?>



		</div>



</td>

<tr>

<td colspan="3">

<!--<div class="buttonrow" style="margin-left:240px;">

<? if($$unique_master>0) {?>

<input name="flag" id="flag" type="hidden" value="1" />

<? }else{?>

<input name="flag" id="flag" type="hidden" value="0" />

<? }?>

</div>-->

<!--<a target="_blank" href="../report/invoice_view.php?v_no=<?=$$unique_master?>"><img src="../../images/print.png" alt="" width="26" height="26" /></a>--></td>

</tr>

</table>


</form>

<? if($$unique_master>0) {?>

<form action="<?=$page?>" method="post" name="codz2" id="codz2">

<table  width="100%" border="1" align="left"  style="border-collapse:collapse; border:1px solid #caf5a5;" cellpadding="0" cellspacing="2">






<tr>

<td width="30%" align="center" bgcolor="#0073AA"><span class="style2">Product Name </span></td>

<td width="60%" align="center" bgcolor="#0073AA"><table width="100%" border="1" cellspacing="0" cellpadding="0">

<tr>
  <td width="9%" rowspan="2" align="center" bgcolor="#0073AA"><span class="style2">Ply</span></td>


<td width="25%" rowspan="2" align="center" bgcolor="#0073AA"><span class="style2"> Paper Combination </span></td>

<td colspan="3" align="center" bgcolor="#0073AA"><span class="style2"> Measurement in (CM) </span></td>

<td width="11%" rowspan="2" align="center" bgcolor="#0073AA"><span class="style2">Sqm Rate </span></td>
<td width="11%" rowspan="2" align="center" bgcolor="#0073AA"><span class="style2"> Pcs Rate </span></td>
<td width="14%" rowspan="2" align="center" bgcolor="#0073AA"><span class="style2">Order Qty </span></td>
</tr>
<tr>
  <td width="10%" align="center" bgcolor="#0073AA"><span class="style2">Length</span></td>
  <td width="9%" align="center" bgcolor="#0073AA"><span class="style2">Width</span></td>
  <td width="11%" align="center" bgcolor="#0073AA"><span class="style2">Height</span></td>
</tr>


</table></td>
</tr>

<tr>

<td align="center" bgcolor="#CCCCCC">

<span id="sub">
<?


//auto_complete_from_db('item_info','concat(item_id,"- ",item_name)','concat(item_id,"- ",item_name)',' group_for = "'.$group_for.'" and product_nature="Salable"','itemin');

auto_complete_from_db('item_info i, raw_input_data r','concat(r.reference_no," # ",i.item_name)','concat(r.reference_no," # ",i.item_name)',
' r.dealer_code = "'.$dealer_code.'" and r.buyer_code = "'.$buyer_code.'" and r.merchandizer_code = "'.$buyer_code.'" and i.item_id=r.item_id','itemin');


?>


<input type="text" id="itemin" name="itemin"  style="width:300px; height:30px;"  required onblur="grp_check(this.value)" />
<input type="hidden" id="item" name="item"  />
<input type="hidden" id="<?=$unique_master?>" name="<?=$unique_master?>" value="<?=$$unique_master?>"  />
<input type="hidden" id="do_date" name="do_date" value="<?=$do_date?>"  />
<input type="hidden" id="delivery_date" name="delivery_date" value="<?=$delivery_date?>"  />
<input type="hidden" id="group_for" name="group_for" value="<?=$group_for?>"  />
<input type="hidden" id="depot_id" name="depot_id" value="<?=$depot_id?>"  />
<input type="hidden" id="cbm_no" name="cbm_no" value="<?=$cbm_no?>"  />
<input type="hidden" id="dealer_code" name="dealer_code" value="<?=$dealer_code?>"  />
<input type="hidden" id="buyer_code" name="buyer_code" value="<?=$buyer_code?>"  />
<input type="hidden" id="merchandizer_code" name="merchandizer_code" value="<?=$merchandizer_code?>"  />
<input type="hidden" id="delivery_place" name="delivery_place" value="<?=$delivery_place?>"  />
<input type="hidden" id="po_no" name="po_no" value="<?=$po_no?>"  />
</span></td>

<td bgcolor="#CCCCCC">

<table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr>

<td bgcolor="#CCCCCC"><span id="do"><table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr>

<td width="12%"><input  name="ply" type="text" class="input3" id="ply" style="width:60px; height:30px;" required="required"  tabindex="0"/></td>

<td width="16%"><input   name="paper_combination" type="text" class="input3" id="paper_combination" style="width:180px; height:30px;"   tabindex="0"/></td>

<td width="13%"><input   name="L_cm" type="text" class="input3" id="L_cm" style="width:70px; height:30px;" required="required"  tabindex="0"/></td>
<td width="13%"><input  name="W_cm" type="text" class="input3" id="W_cm" style="width:70px; height:30px;" required="required"  tabindex="0"/></td>
<td width="13%"><input name="H_cm" type="text" class="input3" id="H_cm" style="width:70px; height:30px;" required="required"  tabindex="0"/></td>

<td width="13%"><input  name="sqm_rate" type="text" class="input3" id="sqm_rate" style="width:80px; height:30px;"  required="required"  tabindex="0"/></td>

<td width="20%">

<input name="unit_price" type="text" class="input3" id="unit_price" style="width:80px; height:30px;" onKeyUp="count()" readonly/></td>

</tr>

</table></span></td>

<td bgcolor="#CCCCCC">
<input placeholder="Quantity" name="total_unit" type="text" class="input3" id="total_unit" style="width:100px; height:30px;" onKeyUp="count()" />

<input placeholder="Total Amt" name="total_amt" type="hidden" class="input3" id="total_amt" style="width:100px; height:30px;" />
</td>
</tr>
</table></td>
</tr>

<tr><td></td>

  <td width="59%"  align="center" bgcolor="#FF0000"><div class="button">

<input name="add" type="submit" id="add" value="ADD" onClick="count()" class="update" tabindex="5"/>

</div></td></tr>
</table>

<? if($$unique_master>0){?>

<br /><br /><br /><br />

<? 

//, (a.init_pkt_unit*a.unit_price) as Total,(a.init_pkt_unit-a.inStock_ctn) as Shortage

  $res='select a.id, a.item_id, s.sub_group_name, a.reference_no, b.item_name, a.ply, a.paper_combination, a.L_cm, a.W_cm, a.H_cm, a.unit_price, a.total_unit, a.total_amt from sale_do_details a, item_info b, item_sub_group s where b.item_id=a.item_id  and b.sub_group_id=s.sub_group_id and a.do_no='.$$unique_master.' order by a.id';

?>

<div  class="tabledesign2">

<table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr>

<th width="2%">SL</th>

<th width="13%">Reference No</th>
<th width="19%">Item Name</th>
<th width="3%">Ply</th>
<th width="27%">Paper Combination</th>
<th width="14%">Measurement</th>
<th width="7%"> Pcs Rate </th>
<th width="5%">Quantity</th>
<th width="9%">Amount</th>
<th width="1%">X</th>
</tr>


<?

$i=1;

$query = mysql_query($res);

while($data=mysql_fetch_object($query)){ ?>

<tr>

<td><?=$i++?></td>

<td><?=$data->reference_no?></td>
<td><?=$data->item_name?></td>

<td><?=$data->ply?></td>
<td><?=$data->paper_combination?></td>
<td><? if($data->L_cm>0) {?><?=$data->L_cm?><? }?><? if($data->W_cm>0) {?>X<?=$data->W_cm?><? }?><? if($data->H_cm>0) {?>X<?=$data->H_cm?><? }?> cm</td>
<td><?=$data->unit_price?></td>
<td><?=$data->total_unit?></td>
<td><?=$data->total_amt?></td>
<td><a href="?del=<?=$data->id?>">X</a></td>
</tr>

<? 

$total_quantity = $total_quantity + $data->total_unit;

$total_amount = $total_amount + $data->total_amt;


} ?>

<tr>

<td colspan="4"><div align="right"><strong> Grand Total:</strong></div></td>

<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><strong><?=number_format($total_quantity,2);?></strong></td>
<td><strong><?=number_format($total_amount,2);?></strong></td>
<td>&nbsp;</td>
</tr>





<? }?>
</table>

</div>

</form>

<br />


<form action="select_dealer_do.php" method="post" name="cz" id="cz" onSubmit="if(!confirm('Are You Sure Execute this?')){return false;}">

<table width="100%" border="0">
<?php /*?>
<?php if($order_create=='Yes') {?>

<? } ?><?php */?>

<tr>

<td align="center">

<input name="delete"  type="submit" class="btn1" value="DELETE WO" style="width:100px; font-weight:bold; font-size:12px;color:#F00; height:30px" />

<input  name="do_no" type="hidden" id="do_no" value="<?=$$unique_master?>"/>
<input  name="do_date" type="hidden" id="do_date" value="<?=$do_date?>"/></td><td align="right" style="text-align:right">

<input name="confirm" type="submit" class="btn1" value="CONFIRM THIS WO" style="width:270px; font-weight:bold; font-size:12px; height:30px; color:#090; float:right" />

</td>

</tr>




</table>

<? }?>

</form>

</div>

<script>$("#cz").validate();$("#cloud").validate();</script>

<?

$main_content=ob_get_contents();

ob_end_clean();

include ("../../template/main_layout.php");




?>