<?php

require_once "../../../assets/template/layout.top.php";


$tr_type="Show";
$title='New Other Issue';

$page = "other_issue.php";

$ajax_page = "other_issue_ajax.php";

$page_for = 'Other Issue';

//do_calander('#oi_date','-40','0');

do_calander('#oi_date');

$table_master='warehouse_other_issue';

$table_details='warehouse_other_issue_detail';

$unique='oi_no';


//if($_GET['mhafuz'] >0 ){
//	unset($_SESSION[$unique]);
//}


if(isset($_POST['new']))

{

		$crud   = new crud($table_master);



		if(!isset($_SESSION[$unique])) {

		$_POST['entry_by']=$_SESSION['user']['id'];

		$_POST['entry_at']=date('Y-m-d H:i:s');
		
		$_POST['issue_type'] = $page_for;

		$_POST['edit_by']=$_SESSION['user']['id'];

		$_POST['edit_at']=date('Y-m-d H:i:s');

		$$unique=$_SESSION[$unique]=$crud->insert();

		unset($$unique);

		$type=1;

		$msg=$title.'  No Created. (No :-'.$_SESSION[$unique].')';
		$tr_type="Initiate";

		}

		else {

		$_POST['edit_by']=$_SESSION['user']['id'];

		$_POST['edit_at']=date('Y-m-d H:i:s');

		$crud->update($unique);

		$type=1;

		$msg='Successfully Updated.';
		$tr_type="Add";

		}

}



$$unique=$_SESSION[$unique];



if(isset($_POST['delete']))

{

		$crud   = new crud($table_master);

		$condition=$unique."=".$$unique;		

		$crud->delete($condition);

		$crud   = new crud($table_details);

		$condition=$unique."=".$$unique;		

		$crud->delete_all($condition);

		unset($$unique);

		unset($_SESSION[$unique]);

		$type=1;

		$msg='Successfully Deleted.';
		$tr_type="Complete";

}



if($_GET['del']>0)

{

		$crud   = new crud($table_details);

		$condition="id=".$_GET['del'];		

		$crud->delete_all($condition);

		

		$sql = "delete from journal_item where tr_from = '".$page_for."' and tr_no = '".$_GET['del']."'";

		mysql_query($sql);

		$type=1;

		$msg='Successfully Deleted.';
		$tr_type="Remove";
		

}

if(isset($_GET['oi_no'])){
	$oi_no= $_GET['oi_no'];

}

if(isset($_POST['confirmm']))

{

		unset($_POST);

		$_POST[$unique]=$$unique;

		$_POST['entry_by']=$_SESSION['user']['id'];

		$_POST['entry_at']=date('Y-m-d H:i:s');

		$_POST['status']='UNCHECKED';

		$crud   = new crud($table_master);

		$crud->update($unique);

		unset($$unique);

		unset($_SESSION[$unique]);

		$type=1;

		$msg='Successfully Forwarded.';
		$tr_type="Complete";

}



if(isset($_POST['add'])&&($_POST[$unique]>0))

{

		$crud   = new crud($table_details);

		$iii=explode('#>',$_POST['item_id']);

		$_POST['item_id']=$iii[1];

		$_POST['entry_by']=$_SESSION['user']['id'];

		$_POST['entry_at']=date('Y-m-d H:i:s');

		$_POST['edit_by']=$_SESSION['user']['id'];

		$_POST['edit_at']=date('Y-m-d H:i:s');

		$xid = $crud->insert();

		journal_item_control($_POST['item_id'] ,$_SESSION['user']['depot'],$_POST['oi_date'],0,$_POST['qty'],$page_for,$xid,$_POST['rate'],'',$$unique);
		$tr_type="Add";

}



if($$unique>0)

{

		$condition=$unique."=".$$unique;

		$data=db_fetch_object($table_master,$condition);

		while (list($key, $value)=each($data))

		{ $$key=$value;}

		

}

if($$unique>0) $btn_name='Update OI Information'; else $btn_name='Initiate OI Information';

if($_SESSION[$unique]<1)

$$unique=db_last_insert_id($table_master,$unique);



//auto_complete_from_db($table,$show,$id,$con,$text_field_id);

$depot_type = find_a_field('warehouse','use_type','warehouse_id="'.$_SESSION['user']['depot'].'"');

//if($depot_type =='SD')

auto_complete_from_db('item_info','concat(item_name,"#>",item_id)','concat(item_name,"#>",item_id)','product_nature="Salable"','item_id');

//else

//auto_complete_from_db('item_info','finish_goods_code','concat(item_name,"#>",item_id)','1','item_id');
$tr_from="Warehouse";
?>

<script language="javascript">


function count()
{


if(document.getElementById('unit_price').value!=''){



var unit_price = ((document.getElementById('unit_price').value)*1);

var qty = ((document.getElementById('qty_').value)*1);

var total_unit = (document.getElementById('total_unit').value)=qty;

var total_amt = (document.getElementById('total_amt').value) = total_unit*unit_price;

var stk = ((document.getElementById('stk_').value)*1);
if(qty>stk){
	alert("Stock Overflow");
	document.getElementById('qty_').value=0;
}else{


var total_amt = (document.getElementById('total_amt').value) = qty*unit_price;

}

}

}



function focuson(id) {

  if(document.getElementById('item_id').value=='')

  document.getElementById('item_id').focus();

  else

  document.getElementById(id).focus();

}

window.onload = function() {

if(document.getElementById("warehouse_id").value>0)

  document.getElementById("item_id").focus();

  else

  document.getElementById("req_date").focus();

}

</script>

<script language="javascript">

function count()

{

var num=((document.getElementById('qty').value)*1)*((document.getElementById('rate').value)*1);

document.getElementById('amount').value = num.toFixed(2);	

}




function calculation(){



var qty=((document.getElementById('qty').value)*1);


var stk=((document.getElementById('stk').value)*1);



if(qty>stk)
 {

alert('Can not issue more than Stock quantity');

document.getElementById('qty').value='';



  }

}

</script>





	<div class="form-container_large">
		<form action="" method="post" name="codz" id="codz" onSubmit="if(!confirm('Are You Sure Execute this?')){return false;}">
			<div class="container-fluid bg-form-titel">
				<div class="row">
					<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<div class="container n-form2">


							<div class="form-group row m-0 pb-1">
								<label for="req_note" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">OI No :</label>
								<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
									<input   name="oi_no" type="text" class="form-control" id="oi_no" value="<? if($$unique_master>0) echo $$unique_master; else echo (find_a_field($table_master,'max('.$unique.')','1')+1);?>" readonly/>


								</div>
							</div>


							<div class="form-group row m-0 pb-1">
								<label for="req_note" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">OI Date :</label>
								<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
									<input type="text"  id="oi_date" class="form-control" value="<?=$oi_date;?>" name="oi_date">

								</div>
							</div>


							<div class="form-group row m-0 pb-1">
								<label for="req_note" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Requisition From :</label>
								<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
									<input   name="requisition_from" class="form-control"  type="text" id="requisition_from" value="<?=$requisition_from?>" />

								</div>
							</div>





						</div>



					</div>


					<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 ">
						<div class="container n-form2">

							<div class="form-group row m-0 pb-1">
								<label for="req_note" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Note :</label>
								<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
									<input   name="oi_details" class="form-control"  type="text" id="oi_details" value="<?=$oi_details?>" />
									<input type="hidden" name="warehouse_id" id="warehouse_id" value="<?=$_SESSION['user']['depot'];?>"  />

								</div>
							</div>

							<div class="form-group row m-0 pb-1">
								<label for="req_note" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Issue To :</label>
								<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
									<input  name="issued_to" class="form-control"  type="text" id="issued_to" value="<?=$issued_to?>" />
								</div>
							</div>

							<div class="form-group row m-0 pb-1">
								<label for="req_note" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Approved by :</label>
								<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
									<input type="text" name="approved_by" id="approved_by" value="<?=$approved_by?>"  />
									<!--<input style="width:155px;"  name="wo_detail" type="text" id="wo_detail" value="<?=$depot_id?>" readonly="readonly"/>-->
								</div>
							</div>

						</div>


					</div>

				</div>

				<div class="n-form-btn-class">
					<input name="new" type="submit" class="btn1 btn1-bg-submit" value="<?=$btn_name?>">
				</div>
			</div>

			<!--return Table design start-->
<!--			<div class="container-fluid pt-5 p-0 ">-->
<!---->
<!--			</div>-->

		</form>





		<? if($_SESSION[$unique]>0){?>
		<form action="?<?=$unique?>=<?=$$unique?>" method="post" name="cloud" id="cloud">
			<!--Table input one design-->
			<div class="container-fluid pt-5 p-0">
				<table class="table1  table-striped table-bordered table-hover table-sm">
					<thead class="thead1">
					<tr class="bgc-info">
						<th>Item Name</th>
						<th>Stock</th>
						<th>Unit</th>
						<th>Price</th>
						<th>Qty</th>
						<th>Amount</th>

						<th>Action</th>
					</tr>
					</thead>

					<tbody class="tbody1">

					<tr>

						<td align="center">

							<input  name="issue_type" type="hidden" id="issue_type" value="<?=$page_for?>"  required="required"/>

							<input  name="<?=$unique?>" type="hidden" id="<?=$unique?>" value="<?=$$unique?>"/>

							<input  name="warehouse_id" type="hidden" id="warehouse_id" value="<?=$warehouse_id?>"/>

							<input  name="oi_date" type="hidden" id="oi_date" value="<?=$oi_date?>"/>

							<input  name="issued_to" type="hidden" id="issued_to" value="<?=$issued_to?>"/>

							<input  name="item_id" type="text" id="item_id" value="<?=$item_id?>" style="width:98%;" required onblur="getData2('<?=$ajax_page?>', 'po',this.value,document.getElementById('warehouse_id').value);"/></td>

						<td colspan="3" align="center">

<span id="po">

<table style="width:100%;">
	<tr>

		<td width="33%"><input name="stk" type="text" class="input3" id="stk" readonly="readonly"/></td>

		<td width="33%"><input name="unit" type="text" class="input3" id="unit"  readonly="readonly"/></td>

		<td width="33%"><input name="price" type="text" class="input3" id="price" readonly="readonly"/></td>
	</tr></table>

</span></td>

						<td align="center"><input name="qty" type="text" class="input3" id="qty"  maxlength="100"  onchange="count();calculation()" required/></td>

						<td align="center"><input name="amount" type="text" class="input3" id="amount" readonly="readonly" required/></td>
						<td><input name="add" type="submit" id="add" class="btn1 btn1-bg-submit" value="ADD"></td>
					</tr>


					</tbody>
				</table>





			</div>




			<!--Data multi Table design start-->
			<div class="container-fluid pt-5 p-0 ">

				<div class="tabledesign2 border-0">

					<?

					$res='select a.id,b.item_name,a.rate as unit_price,a.qty ,a.unit_name,a.amount,"x" from warehouse_other_issue_detail a,item_info b where b.item_id=a.item_id and a.oi_no='.$oi_no;

					echo link_report_add_del_auto($res,'',4,6);

					?>

				</div>

			</div>
		</form>



		<!--button design start-->
		<form action="" method="post" name="cz" id="cz" onSubmit="if(!confirm('Are You Sure Execute this?')){return false;}">
			<div class="container-fluid p-0 ">

				<div class="n-form-btn-class">
					<input name="confirmm" type="submit" class="btn1 btn1-bg-submit" value="CONFIRM AND FORWARD" />
				</div>

			</div>
		</form>
		<? }?>
	</div>






<script>$("#codz").validate();$("#cloud").validate();</script>

<?

require_once "../../../assets/template/layout.bottom.php";

?>