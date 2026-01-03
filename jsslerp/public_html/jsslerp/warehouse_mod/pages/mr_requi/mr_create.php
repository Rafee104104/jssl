<?php



require_once "../../../assets/template/layout.top.php";





$title='New Material Requisition Create';

$tr_type="Show";

do_calander('#req_date');
do_calander('#need_by');



$table_master='requisition_master_stationary';

$table_details='requisition_order_stationary';

$unique='req_no';



if($_GET['mhafuz']>0)

unset($_SESSION[$unique]);



if(isset($_POST['new']))

{

		$crud   = new crud($table_master);



		if(!isset($_SESSION[$unique])) {

		$_POST['status']='MANUAL';

		$_POST['entry_by']=$_SESSION['user']['id'];

		$_POST['entry_at']=date('Y-m-d h:s:i');

		$_POST['edit_by']=$_SESSION['user']['id'];

		$_POST['edit_at']=date('Y-m-d h:s:i');

		$$unique=$_SESSION[$unique]=$crud->insert();

		unset($$unique);

		$type=1;

		$msg='Requisition No Created. (Req No : '.$_SESSION[$unique].')';
		$tr_type="Initiate";

		}

		else {

		$_POST['edit_by']=$_SESSION['user']['id'];

		$_POST['edit_at']=date('Y-m-d h:s:i');

		$crud->update($unique);

		$type=1;

		$msg='Successfully Updated.';
		$tr_type="Initiate";

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
		$tr_type="Delete";

}



if($_GET['del']>0)

{

		$crud   = new crud($table_details);

		$condition="id=".$_GET['del'];		

		$crud->delete_all($condition);

		$type=1;

		$msg='Successfully Deleted.';
		$tr_type="Delete";

}

if(isset($_POST['confirmm']))

{

		unset($_POST);

		$_POST[$unique]=$$unique;

		$_POST['entry_by']=$_SESSION['user']['id'];

		$_POST['entry_at']=date('Y-m-d h:s:i');
		$tr_type="Complete";


if($_SESSION['user']['group']==5){ 

$_POST['status']='UNCHECKED-BOQ'; 

}else{ 

	if($_SESSION['user']['depot']==71){$_POST['status']='PRE-CHECKED'; }else{$_POST['status']='UNCHECKED';}

}







		$crud   = new crud($table_master);

		$crud->update($unique);

		unset($$unique);

		unset($_SESSION[$unique]);

		$type=1;

		$msg='Successfully Forwarded for Approval.';

}



if(isset($_POST['add'])&&($_POST[$unique]>0))

{

		$crud   = new crud($table_details);

		$iii=explode('#>',$_POST['item_id']);

		$_POST['item_id']=$iii[2];

		$_POST['entry_by']=$_SESSION['user']['id'];

		$_POST['entry_at']=date('Y-m-d h:s:i');

		$_POST['edit_by']=$_SESSION['user']['id'];

		$_POST['edit_at']=date('Y-m-d h:s:i');

		$crud->insert();
		$tr_type="Add";

}



if($$unique>0)

{

		$condition=$unique."=".$$unique;

		$data=db_fetch_object($table_master,$condition);

		while (list($key, $value)=each($data))

		{ $$key=$value;}

		

}

if($$unique>0) $btn_name='Update Requsition Information'; else $btn_name='Initiate Requsition Information';

if($_SESSION[$unique]<1)

$$unique=db_last_insert_id($table_master,$unique);



//auto_complete_from_db($table,$show,$id,$con,$text_field_id);

// auto_complete_from_db('item_info','item_name','item_id','1','item_id');



//auto_complete_from_db('item_info','concat(item_name,"#>",item_description,"#>",item_id)','concat(item_name,"#>",item_description,"#>",item_id)', '1 order by item_id asc', 'item_id');



$tr_from="Warehouse";

?>

<script language="javascript">

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









	<div class="form-container_large">

		<form action="mr_create.php" method="post" name="codz" id="codz" onSubmit="if(!confirm('Are You Sure Execute this?')){return false;}">
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><fieldset>
    <? $field='req_no';?>
      <div>
        <label for="<?=$field?>">Requisition No: </label>
        <input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>"/>
		<input  name="warehouse_id" type="hidden" id="warehouse_id" value="<?=$_SESSION['user']['depot']?>"/>
      </div>
    <? $field='req_date'; if($req_date=='') $req_date =date('Y-m-d');?>
      <div>
        <label for="<?=$field?>">Requisition Date:</label>
        <input  name="<?=$field?>" type="date" id="<?=$field?>" value="<?=$$field?>" />
      </div>
    <? $field='warehouse_id'; $table='warehouse';$get_field='warehouse_id';$show_field='warehouse_name';?>
      <div>
        <label for="<?=$field?>">Organization: </label>
		<select name="organization"  id="organization" required>
			<? foreign_relation('user_group','id','group_name',$warehouse_id,'1');?>
		</select>
		<!--<input name="warehouse_id2" type="text" id="warehouse_id2" value="<?=find_a_field('user_group','group_name','id='.$emp->PBI_ORG)?>" readonly="" />-->
      </div>
    </fieldset></td>
    <td>
			<fieldset>
			
    <? $field='req_for';?>
      <div>
        <label for="<?=$field?>">Requisition For:</label>
       	<input  name="req_for" type="text" id="req_for" value=" " />
		
		<?php /*?><select name="req_for"  id="req_for" required>
		     <option></option>
			 
			<? foreign_relation('personnel_basic_info','PBI_ID','PBI_NAME','1');?>
		</select><?php */?>

      </div>
     <? $field='need_by'; if($need_by=='') $need_by =date('Y-m-d');?>
      <div>
        <label for="<?=$field?>">Required Date:</label>
        <input  name="<?=$field?>" type="date" id="<?=$field?>" value="<?=$$field?>" />
      </div>
    <? $field='req_note';?>
      <div>
        <label for="<?=$field?>">Additional Note:</label>
        <input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>"/>
      </div>
	      
			</fieldset>	</td>
  </tr>
  <tr>
    <td colspan="2"><div class="buttonrow" style="margin: 10px 390px;">
      <input name="new" type="submit" class="btn1" value="<?=$btn_name?>" style="width:250px; font-weight:bold; font-size:12px;" />
    </div></td>
    </tr>
</table>
</form>



		<? if($_SESSION[$unique]>0){?>



		<form action="?<?=$unique?>=<?=$$unique?>" method="post" name="cloud" id="cloud">

			<!--Table input one design-->

			<div class="container-fluid pt-5 p-0 ">







				<table class="table1  table-striped table-bordered table-hover table-sm">

					<thead class="thead1">

					<tr class="bgc-info">

						

						<th>Item Name</th>
						<th>Stk Qty</th>

						<th>LPQ</th>

						<th>LPD</th>
						
						<th>LPR</th>

<!--						<th>3MRatio</th>
-->						<th>Unit</th>



						<th>Req Qty</th>

						<th>Remraks</th>

						<th>Action</th>
					</tr>
					</thead>



					<tbody class="tbody1">
					<tr>
						<td>

							<input  name="<?=$unique?>"i="i" type="hidden" id="<?=$unique?>" value="<?=$$unique?>"/>

							<input  name="warehouse_id" type="hidden" id="warehouse_id" value="<?=$warehouse_id?>"/>

							<input  name="req_date" type="hidden" id="req_date" value="<?=$req_date?>"/>

							<input  name="item_id" list="item_ids" type="text" id="item_id" value="<?=$item_id?>" required="required" onblur="getData2('mr_ajax.php', 'mr', this.value, document.getElementById('warehouse_id').value+'##'+document.getElementById('req_date').value);"/>
							
							<datalist id="item_ids">
								<? foreign_relation('item_info','concat(item_name,"#>",item_description,"#>",item_id)','item_name',$item_id,'1 order by item_id asc');
								//sub_group_id in (1096000200010000, 1096000700010000) ?>
							</datalist>
							</td>

						<td colspan="5">

							<div align="right">

								  <span id="mr">

						<table style="width:100%;" border="1">

							<tr>



								<td width="10%"><input name="qoh" type="text"  id="qoh" class="form-control" onfocus="focuson('qty')" /></td>



								<td width="10%"><input name="last_p_qty" type="text"  id="last_p_qty" class="form-control" onfocus="focuson('qty')" /></td>



								<td width="10%"><input name="last_p_date" type="text" id=" 	last_p_date" class="form-control" onfocus="focuson('qty')" /></td>
								
								<td width="10%"><input name="last_pur_rate" type="text" id=" 	last_pur_rate" class="form-control" onfocus="focuson('qty')" /></td>

<?php /*?>								<td width="10%"><input name="ratio3m" type="text" id="ratio3m" readonly maxlength="100" class="form-control" onfocus="focuson('qty')" /></td>
<?php */?>
								<td width="10%"><input name="unit_name" type="text" id="unit_name"  maxlength="100" class="form-control" onfocus="focuson('qty')" /></td>
							</tr>
						</table>
						</span>							</div>						</td>



						<td><input name="qty" type="text" class="input3" id="qty" required /></td>



						<td>

							<input name="remarks" id="remarks" type="text" />						</td>

						<td><input name="add" type="submit" id="add" class="btn1 btn1-bg-submit" value="ADD" /></td>
					</tr>
					</tbody>
				</table>











			</div>









			<!--Data multi Table design start-->

			<div class="container-fluid pt-5 p-0 ">

				<?

				$res='select a.id,b.item_name as item_name,a.qoh as stock_qty,a.last_p_qty as last_pur_qty,a.last_p_date as last_pur_date,a.qty, a.ratio3m,"x" from requisition_order_stationary a,item_info b where b.item_id=a.item_id and a.req_no='.$req_no;

				?>



				<table class="table1  table-striped table-bordered table-hover table-sm">

					<thead class="thead1">

					<tr class="bgc-info">

						<th>SL</th>

						<th>Item Name</th>

						<th>Stock Qty</th>

						<th>Last Pur Qty</th>



						<th>Last Pur Date</th>
						<th>3M Ratio</th>

						<th>Unit</th>

						<th>Qty</th>

						<th>Action</th>

					</tr>

					</thead>



					<tbody class="tbody1">

						<?

						$s=0;

						$res='select a.id,b.item_name as item_name,a.qoh as stock_qty,a.last_p_qty as last_pur_qty,a.last_p_date as last_pur_date,a.qty,a.unit_name from requisition_order_stationary a,item_info b where b.item_id=a.item_id and a.req_no='.$req_no;

                        $qry = mysql_query($res);

						while($data=mysql_fetch_object($qry)){

						?>



					<tr>

						<td><?=++$s?></td>

						<td style="text-align:left"><?=$data->item_name?></td>

						<td><?=$data->stock_qty?></td>

						<td><?=$data->last_pur_qty?></td>



						<td><?=$data->last_pur_date?></td>

						<td><?=$data->unit_name?></td>
						<td><?=$data->ratio3m;?></td>

						<td><?=$data->qty?></td>

						<td><a href="?del=<?=$data->id?>"> <button type="button" class="btn2 btn1-bg-cancel"><i class="fa-solid fa-trash"></i></button> </a></td>



					</tr>

                    <? } ?>

					</tbody>

				</table>



			</div>

		</form>







		<!--button design start-->

		<form action="" method="post" name="cz" id="cz" onSubmit="if(!confirm('Are You Sure Execute this?')){return false;}">

			<div class="container-fluid p-0 ">



				<div class="n-form-btn-class">

					<input name="delete" type="submit" class="btn1 btn1-bg-cancel" value="DELETE AND CANCEL REQUSITION" />

					<input name="confirmm" type="submit" class="btn1 btn1-bg-submit" value="CONFIRM AND FORWARD REQUSITION" />

				</div>



			</div>

		</form>



		<? }?>

	</div>

	<script>$("#codz").validate();$("#cloud").validate();</script>


<br>

<br>

<br>

<br>






<?



require_once "../../../assets/template/layout.bottom.php";



?>