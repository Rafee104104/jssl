<?php
session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";
$title='New Other Receive';
$page_for = 'Other Receive';

/*if($_SESSION['user']['group']=='4'){
do_calander('#or_date','-360','0');
}
do_calander('#or_date','-5','0');
do_calander('#quotation_date');*/

$din = find_a_field('menu_warehouse','other_receive','id="'.$_SESSION['user']['group'].'"'); 
if($din>0){$din=$din;}else{$din=60;}
do_calander('#or_date');

//$receiptNo = (find_a_field('warehouse_other_receive','max(receipt_number)','1 and entry_by="'.$_SESSION['user']['id'].'" and and rec_year='.date('Y').' ')+1);

$receiptNo = (find_a_field('warehouse_other_receive','max(receipt_number)',' entry_by="'.$_SESSION['user']['id'].'" and  rec_year='.date('Y').' ')+1);
$table_master='warehouse_other_receive';
$table_details='warehouse_other_receive_detail';
$unique='or_no';
$tr_type="Show";

if($_GET['token_no']>0){
 $sr=find_all_field('sr_token','booking_number','serial_number="'.$_GET['token_no'].'" and token_year="'.$_GET['token_year'].'" ');
 $receipt_no = $data[1]; 
 $bookingAll = find_all_field('paid_booking','*','booking_number_eng like "'.$sr->booking_number.'" ');
}
$token=explode("##",$_POST['token_numberss']);
if(isset($_POST['new']))
{



		$crud   = new crud($table_master);
		if(!isset($_SESSION[$unique])) {
		
$tokenCount = find_a_field('sr_token','serial_number','status != "Completed" and serial_number="'.$_GET['token_no'].'"');
if($tokenCount==$_GET['token_no']){ 

		//$upql = 'update sr_token set status = "Completed" where serial_number="'.$_POST['token_numberss'].'"';
		mysql_query($upql); 
		
		
		$_POST['token_number']=$token[0];
		if($_GET['token_year']>0)
		{
		$_POST['rec_year']=$_GET['token_year'];
		}
		else
		{
		$_POST['rec_year']=$token[1];
		}
		$_POST['entry_by']=$_SESSION['user']['id'];
		$_POST['entry_at']=date('Y-m-d h:s:i');
		$_POST['edit_by']=$_SESSION['user']['id'];
		$_POST['edit_at']=date('Y-m-d h:s:i');
		$$unique=$_SESSION[$unique]=$crud->insert();
		unset($$unique);
		$type=1;
		$msg=$title.'  No Created. (No :-'.$_SESSION[$unique].')';
		$tr_type="Initiate";
		header('Location:or_receive.php?token_no="'.$_GET['token_no'].'"&token_year="'.$_GET['token_year'].'"');
	////////////////////////////////////////////////// Detail Entry ///////////////////////////////		
		  $crud   = new crud($table_details);
		  $_POST['or_no'] = $_SESSION[$unique];
		  $_POST['receive_type']= 'SR';
		  $_POST['item_id']=100010001;
		  $_POST['unit_name']='Bag';
		  $_POST['rate'];
		  $_POST['qty'];
		  $_POST['amount']=($_POST['rate']*$_POST['qty']);
		  $_POST['entry_by']=$_SESSION['user']['id'];
		$_POST['entry_at']=date('Y-m-d h:s:i');
		$_POST['edit_by']=$_SESSION['user']['id'];
		$_POST['edit_at']=date('Y-m-d h:s:i');
		$xid = $crud->insert();
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
		header('Location:or_receive.php');
 		}else{
			$msg = '<strong>Warning!! </strong>Token Not Found.' ;
		}	
		}else {
		
		$_POST['edit_by']=$_SESSION['user']['id'];
		$_POST['edit_at']=date('Y-m-d h:s:i');
		$crud->update($unique);
		$type=1;
		$msg='Successfully Updated.';
		$tr_type="Add";
		}
		
		$upql = 'update sr_token set status = "Completed" where serial_number='.$_POST['token_numberss'];
		mysql_query($upql); 
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
		     	header('location:../dealer/sr_token_info.php');

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
		header('location:../dealer/sr_token_info.php');

}
if(isset($_POST['confirmm']))
{		$rec_year=find_a_field('warehouse_other_receive','rec_year','or_no='.$$unique);
		$sql = 'update sr_token set sr_number="'.$_POST['bag_mark'].'" where serial_number="'.$_POST['token_number'].'" and token_year="'.$rec_year.'"'; 
		mysql_query($sql);
		
		unset($_POST);
		$_POST[$unique]=$$unique;
		$_POST['entry_by']=$_SESSION['user']['id'];
		$_POST['entry_at']=date('Y-m-d h:s:i');
		$_POST['status']='UNCHECKED';
		$crud   = new crud($table_master);
		$crud->update($unique);
		
		
		
		unset($$unique);
		unset($_SESSION[$unique]);
		$type=1;
		$msg='Successfully Forwarded.';
		$tr_type="Complete";
     	header('location:../dealer/sr_token_info.php');
}

if(isset($_POST['add'])&&($_POST[$unique]>0))
{
		$crud   = new crud($table_details);
		$iii=explode('#>',$_POST['item_id']);
		$_POST['item_id']=$iii[1];
		$_POST['entry_by']=$_SESSION['user']['id'];
		$_POST['entry_at']=date('Y-m-d h:s:i');
		$_POST['edit_by']=$_SESSION['user']['id'];
		$_POST['edit_at']=date('Y-m-d h:s:i');
		$xid = $crud->insert();
		//journal_item_control($_POST['item_id'] ,$_SESSION['user']['depot'],$_POST['or_date'],$_POST['qty'],0,$page_for,$xid,$_POST['rate']);
		$tr_type="Add";
}

if($$unique>0)
{
		$condition=$unique."=".$$unique;
		$data=db_fetch_object($table_master,$condition);
		while (list($key, $value)=each($data))
		{ $$key=$value;}
		
}
if($$unique>0) $btn_name='Update PO Information'; else $btn_name='Initiate PO Information';
if($_SESSION[$unique]<1)
$$unique=db_last_insert_id($table_master,$unique);

//auto_complete_from_db($table,$show,$id,$con,$text_field_id);
$depot_type = find_a_field('warehouse','use_type','warehouse_id="'.$_SESSION['user']['depot'].'"');


auto_complete_from_db('item_info','concat(item_name,"#>",item_id)','concat(item_name,"#>",item_id)','1','item_id');
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
<script language="javascript">
function count()
{
var num=((document.getElementById('qty').value)*1)*((document.getElementById('rate').value)*1);
document.getElementById('amount').value = num.toFixed(2);	
}


function counts()
{

var qty=(document.getElementById('qty').value)*1;

var rec_qty=(document.getElementById('rec_qty').value)*1;

document.getElementById('due_qty').value=(qty-rec_qty);

//var num=((document.getElementById('qty').value)*1)*((document.getElementById('rate').value)*1);
//document.getElementById('amount').value = num.toFixed(2);	
}


</script>

<style>
	#new:focus {
  background-color: #ffcc00; /* Change to any color you like */
  color: #000; /* Optional: change text color */
  outline: none; /* Optional: remove default focus outline */
}
	#confirmm:focus {
  background-color: #ffcc00; /* Change to any color you like */
  color: #000; /* Optional: change text color */
  outline: none; /* Optional: remove default focus outline */
}
</style>
<div class="form-container_large">
  <form action="" method="post" name="codz" id="codz" onSubmit="if(!confirm('Are You Sure Execute this?')){return false;}">
    <div class="container-fluid bg-form-titel">
	<? if($msg !=''){?>
	<div class="alert alert-warning">
		   <?=$msg;?>
	</div>
	<? } ?> 
      <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6" >
          <div class="container n-form2" >
            <fieldset>
			
            
             <div class="form-group row m-0 pb-1">
				  <label for="" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Token No:</label>
				  <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
					<input  name="token_numberss" onblur="getData2('or_receive_booking_ajax.php', 'agent_name_find', this.value,  document.getElementById('receipt_number').value);"  list="token_numbers" type="text" id="token_numberss" value="<?=($_POST['token_numberss'] ? $token[0] : $_GET['token_no'])?>" required="required"/>
					<datalist id="token_numbers">
						<? foreign_relation('sr_token','concat(serial_number,"##",token_year)','serial_number',$_POST['token_numberss'],'1 and status like "Processing" ');?>
					</datalist>
				  </div>
				</div>
			<?=$tokenCount = find_a_field('sr_token','serial_number','status != "Completed" and serial_number='.$_POST['token_id']);?>
		<span id="agent_name_find">
		
			<div class="form-group row m-0 pb-1">
              <label for=" " class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Booking No:</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input name="booking_number" style="color:#6666FF; font-weight:bold; font-size:20px !important;" type="text" list="booking_nos" id="booking_number" value="<?=($booking_number ? $booking_number:$bookingAll->booking_number_eng)?>"   />
                <datalist id="booking_nos">
                  <? foreign_relation('paid_booking','booking_number_eng','status like "Active"');?>
                </datalist>
              </div>
            </div>
			<div class="form-group row m-0 pb-1">
              <label for=""class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Date:</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input  name="or_date" type="text" id="or_date" value="<?=($or_date ? $or_date:$sr->date)?>" readonly="readonly" required/>
              </div>
            </div>
			<? $bagMark = $receiptNo.'/'.$sr->quantity;?>
			<div class="form-group row m-0 pb-1">
              <label for="" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Bag Mark:</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input  name="bag_mark" type="text" readonly="readonly" id="bag_mark" style="color:#6666FF; font-weight:bold; font-size:20px !important;" value="<?=($bag_mark ? $bag_mark:$bagMark)?>" required/>
              </div>
            </div>
			
			<div class="form-group row m-0 pb-1">
              <label for=" " class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Quantity:</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input name="qty" type="text"  id="qty"  onkeyup="counts()"  value="<?=($qty ? $qty:$sr->quantity)?>"   />
                
              </div>
            </div>
		
            <div class="form-group row m-0 pb-1">
              <label for=" " class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Farmer Name :</label>
                  <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
			   <input name="farmer_name" type="text"  id="farmer_name" value="<?=($farmer_name ? $farmer_name:$sr->farmer_name)?>"  />

                <input name="agent_name" type="hidden"  id="agent_name" value="<?=$bookingAll->name?>"  />
              </div>
            </div> 
            <div class="form-group row m-0 pb-1">
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input  name=" father_name" type="hidden" id="father_name " value="<?=($father_name ? $father_name:$bookingAll->father_name)?>" required/>
              </div>
            </div> 
            <div class="form-group row m-0 pb-1">
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input  name="district " type="hidden" id="district " value="<?=($district ? $district:$bookingAll->district)?>" required/>
              </div>
            </div> 
            <div class="form-group row m-0 pb-1">
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input  name="thana " type="hidden" id="thana " value="<?=($thana ? $thana:$bookingAll->thana)?>" required/>
              </div>
            </div> 
            <div class="form-group row m-0 pb-1">
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input  name="post " type="hidden" id="post " value="<?=($post ? $post:$bookingAll->post)?>" required/>
              </div>
            </div> 
            <div class="form-group row m-0 pb-1">
              <label for=" " class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Village:</label>
           <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
			      <input  name="farmer_village" type="text" id="farmer_village" value="<?=($village ? $village:$sr->village)?>" required/>

               <!-- <input  name="village" type="hidden" id="village" value="<?=$bookingAll->village?>" required/>-->
              </div>
            </div>
<?php /*?>			<div class="form-group row m-0 pb-1">
              <label for=" " class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Receive Quantity:</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input name="rec_qty" type="text"  id="rec_qty"  onkeyup="counts()"  value="<?=$rec_qty?>"   />
                
              </div>
            </div><div class="form-group row m-0 pb-1">
              <label for=" " class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Due Quantity:</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
              <input name="due_qty" type="text" id="due_qty" value="<?=$due_qty;?>" tabindex="14"  onchange="counts()"   />
                
              </div>
            </div>
<?php */?>			
            
            <input  name="warehouse_id" type="hidden" id="warehouse_id" value="<?=$_SESSION['user']['depot']?>"  required/>
            <input  name="receive_type" type="hidden" id="receive_type" value="<?=$page_for?>"  required="required"/>
            </fieldset>
          </div>
        </div>
		</span>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 ">
          <div class="container n-form2">
            <fieldset>
            
            <div class="form-group row m-0 pb-1">
              <label for="" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Receipt No :</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input  name="receipt_number" type="text" style="color:#6666FF; font-weight:bold; font-size:20px !important;"  id="receipt_number" onkeyup="bagMark(this.value)" value="<?  echo $receiptNo;?>" required/>
              </div>
            </div>
         
			

            <div class="form-group row m-0 pb-1">
              <label for=" " class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Labour Charge:</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <input  name=" labour_charge" type="text" id="labour_charge " value="25" required readonly="readonly"/>
              </div>
            </div>
            
            </fieldset>
          </div>
        </div>
      </div>
      <div class="n-form-btn-class">
        <input name="new" id="new" type="submit" tabindex="1" class="btn1 btn1-bg-submit" value="<?=$btn_name?>">
      </div>
    </div>
    <!--return Table design start-->
    <div class="container-fluid pt-5 p-0 "> </div>
  </form>
  <? if($_SESSION[$unique]>0){?>
  <form action="?<?=$unique?>=<?=$$unique?>" method="post" name="cloud" id="cloud">
    <!--Table input one design-->
    
    <!--Data multi Table design start-->
   
      <div class="tabledesign2 border-0">
        <? 
                   $res='select a.id,b.item_name,a.rate as unit_price,a.qty,a.unit_name,a.amount,"x" from warehouse_other_receive_detail a,item_info b where b.item_id=a.item_id and a.or_no='.$or_no;
                    echo link_report_add_del_auto($res,'',4,7);
                    ?>
      </div>
  
  </form>
  <!--button design start-->
  <form action="" method="post" name="cz" id="cz" onSubmit="if(!confirm('Are You Sure Execute this?')){return false;}">
    <div class="container-fluid p-0 ">
      <div class="n-form-btn-class">
        <input name="confirmm" id="confirmm" type="submit" tabindex="1" class="btn1 btn1-bg-submit" value="CONFIRM AND FORWARD OR"/>
		<input name="bag_mark" type="hidden" value="<?=$bag_mark;?>"  />
		<input name="token_number" type="hidden" value="<?=$token_number;?>"  />
      </div>
    </div>
  </form>
  <?}?>
</div>
<script>
	function bagMark(val){
		var qty = document.getElementById('qty').value*1;
		var bagM = val+'/'+qty;
		document.getElementById('bag_mark').value = bagM;
		
	}
</script>
<script>$("#codz").validate();$("#cloud").validate();</script>
<?
require_once "../../../assets/template/layout.bottom.php";
?>
