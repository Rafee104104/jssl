<?php
require_once "../../../assets/template/layout.top.php";
$title='New Direct Sales';
$page_for = 'Direct Sales';

//$din = find_a_field('menu_warehouse','local_purchase','id="'.$_SESSION['user']['group'].'"');
//if($din>0){$din=$din;}else{$din=60;}

do_calander('#oi_date'/*,'-"'.$din.'"','0'*/);


$table_master='warehouse_other_issue';
$table_details='warehouse_other_issue_detail';
$unique='oi_no';

if($_REQUEST['pal']>0){ unset($_SESSION['oi_no2']);}

if($_REQUEST['old_do_no']>0){
    $_SESSION['oi_no2']=$_REQUEST['old_do_no'];
    $check_manual=find1("select status from warehouse_other_issue where oi_no='".$_REQUEST['old_do_no']."'");
    if($check_manual!='MANUAL') { redirect('direct_sales.php');}
}
if($_GET['del']>0){
    $_SESSION['oi_no2']=find_a_field('warehouse_other_issue_detail','oi_no','id='.$_GET['del']); $del = $_GET['del'];
}



if(isset($_POST['new']))
{
		$crud   = new crud($table_master);

		if(!isset($_SESSION['oi_no2'])) {
		$_POST['entry_by']=$_SESSION['user']['id'];
		$_POST['entry_at']=date('Y-m-d H:i:s');
		$_POST['edit_by']=$_SESSION['user']['id'];
		$_POST['edit_at']=date('Y-m-d H:i:s');
		$_POST['warehouse_id'] =  $_SESSION['user']['depot'];
		$_POST['issue_type'] =  'Direct Sales';
		$$unique=$_SESSION['oi_no2']=$crud->insert();
		unset($$unique);
		$type=1;
		$msg=$title.'  No Created. (No :-'.$_SESSION['oi_no2'].')';
		}
		else {
		$_POST['issue_type'] =  'Direct Sales';
		$_POST['edit_by']=$_SESSION['user']['id'];
		$_POST['edit_at']=date('Y-m-d H:i:s');
		$_POST['warehouse_id'] =  $_SESSION['user']['depot'];
		$crud->update($unique);
		$type=1;
		$msg='Successfully Updated.';
		}
}

$$unique=$_SESSION['oi_no2'];

if(isset($_POST['delete']))
{
		$crud   = new crud($table_master);
		$condition=$unique."=".$$unique;		
		$crud->delete($condition);
		$crud   = new crud($table_details);
		$condition=$unique."=".$$unique;		
		$crud->delete_all($condition);
		unset($$unique);
		unset($_SESSION['oi_no2']);
		$type=1;
		$msg='Successfully Deleted.';
}

if($_GET['del']>0){
    
		$crud   = new crud($table_details);
		$condition="id=".$_GET['del'];		
		$crud->delete_all($condition);
		
		$type=1;
		$msg='Successfully Deleted.';
		?><script>window.location.href = "direct_sales.php?old_do_no=<?=$_SESSION['oi_no2']?>";</script><?
		
}


if(isset($_POST['hold'])){
    
		unset($$unique);
		unset($_SESSION['oi_no2']);
		$type=1;
		$msg='Successfully Forwarded.';
		redirect('direct_sales.php');
		
}



if(isset($_POST['confirmm'])){
        
		$oi_no = $_POST['oi_no'];

		$page_for       = 'Direct Sales';
		$jv_no          = next_journal_sec_voucher_id();
        $jv_date        = $_POST['oi_date'];
        $proj_id        = 'mep'; 
        $_POST['warehouse_id'] =  $_SESSION['user']['depot'];
        $group_for      =  $_POST['group_for'];
        $cc_code        = '1';
        $tr_no          = $oi_no;
        $tr_from        = 'Direct Sales';
        $narration      = 'Direct Sales#'.$oi_no;
        
        // dr. head
        $party_ledger_id = find1("select account_code from dealer_info where dealer_code='".$_POST['vendor_id']."'");
        // cr. head
        $dsLedger = find_a_field('config_group_class','directSales','group_for="'.$group_for.'"');
		
    $sql = 'select w.*
    from warehouse_other_issue_detail w, item_info i 
    where i.item_id=w.item_id and w.oi_no="'.$oi_no.'"';
	$qry = mysql_query($sql);
	
	while($data=mysql_fetch_object($qry)){
		$tr_id = $data->id;
		
		journal_item_control($data->item_id,$_SESSION['user']['depot'],$data->oi_date,0,$data->qty,$page_for,$tr_id,$data->rate,'',$_SESSION['oi_no2']);
        $total_amt +=$data->amount;
	}
		
// Company wise journal system

		// dr direct sales
		//add_to_sec_journal2($proj_id, $jv_no, $jv_date, $party_ledger_id, $narration, $total_amt,'0',  $tr_from, $tr_no,'',$tr_id,$cc_code,$group_for);
		
		// cr party
		//add_to_sec_journal2($proj_id, $jv_no, $jv_date, $dsLedger,        $narration, '0',$total_amt,  $tr_from, $tr_no,'',$tr_id,$cc_code,$group_for);
	
	$check_auto_journal_verify=find1("select secondary_approval from voucher_config where voucher_type='Direct Sales'");
	if($check_auto_journal_verify=='Yes'){
	    //sec_journal_journal2($jv_no,$jv_no,$tr_from);
	}
// end journal hit	
	
	
		unset($_POST);
		$_POST[$unique]         =$$unique;
		$_POST['entry_by']      =$_SESSION['user']['id'];
		$_POST['entry_at']      =date('Y-m-d H:i:s');
		$_POST['status']        ='CHECKED';
		
		$crud = new crud($table_master);
		$crud->update($unique);
		unset($$unique);
		unset($_SESSION['oi_no2']);
		$type=1;
		$msg='Successfully Forwarded.';
}



if(isset($_POST['add'])&&($_POST[$unique]>0)){
    
		$crud = new crud($table_details);
		//$iii=explode('#>',$_POST['item_id']);
		
		//$_POST['item_id']=$_POST['item_id'];
		$_POST['rate']=$_POST['rate'];
		$_POST['qty']=$_POST['qty'];
		$_POST['amount']=$_POST['amount'];
		
		$_POST['entry_by']=$_SESSION['user']['id'];
		$_POST['entry_at']=date('Y-m-d H:i:s');
		$_POST['warehouse_id'] =  $_SESSION['user']['depot'];
		$_POST['issue_type'] = 'Direct Sales';
		
		$xid = $crud->insert();

}

if($$unique>0)
{
		$condition=$unique."=".$$unique;
		$data=db_fetch_object($table_master,$condition);
		while (list($key, $value)=each($data))
		{ $$key=$value;}
		
}
if($$unique>0) $btn_name='Update'; else $btn_name='Initiate';
if($_SESSION['oi_no2']<1)
$$unique=db_last_insert_id($table_master,$unique);

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
</script>










<!--Mr create 2 form with table-->
<div class="form-container_large">
    <form action="" method="post" name="codz" id="codz">
<!--        top form start hear-->
        <div class="container-fluid">
            <div class="row">
                <!--left form-->
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="container n-form2">
                        <div class="form-group row m-0 pb-1">
						<? $field='oi_no';?>
                            <label for="<?=$field?>" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">NO</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>"/>
                            </div>
                        </div>

                        <div class="form-group row m-0 pb-1">
								 <? $field='oi_date'; if($oi_date=='') $oi_date =date('Y-m-d'); ?>
                            <label for="<?=$field?>" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Date</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
             
       						 <input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>" readonly="readonly" required/>
	  
                            </div>
                        </div>
                        
                        <div class="form-group row m-0 pb-1">
						    <? $field='vendor_id';?>
                            <label for="<?=$field?>" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Party</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
<? if ($vendor_id<1) {?>
    <input class="form-control" list="party_list" name="vendor_id" id="vendor_id" required="required" autocomplete="off">
    <datalist id="party_list">
    <option></option>
    <? 
    $sql_party='select dealer_code,concat(dealer_code,"-",dealer_name_e) from dealer_info where 1 and dealer_type=3 and account_code>0 '.$party_con;
    foreign_relation_sql($sql_party);
    ?>
    </datalist>

<? }else{?>
    
    <select class="form-control" id="dealer_code" name="dealer_code" class="form-control"  required  >
     <? foreign_relation('dealer_info','dealer_code','dealer_name_e',$vendor_id,'dealer_code="'.$vendor_id.'"');?>
    </select>
<? }?>
                            </div>
                        </div>
                        

          <!--              <div class="form-group row m-0 pb-1">-->
						    <!--<? $field='chalan_no';?>-->
          <!--                  <label for="<?=$field?>" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Chalan No</label>-->
          <!--                  <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">-->
      
          <!--						<input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>" required/>-->
        
          <!--                  </div>-->
          <!--              </div>-->
                        
                        
						<!--<div class="form-group row m-0 pb-1">-->
						<!-- <? $field='requisition_from';?>-->
      <!--                      <label for="<?=$field?>" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Requisitioin From</label>-->
      <!--                      <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">-->
      <!--                            <input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>" required/>-->

      <!--                      </div>-->
      <!--                  </div>-->

                    </div>



                </div>

                <!--Right form-->
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="container n-form2">
                        
                        
           <!--             <div class="form-group row m-0 pb-1">-->
						     <!--<? $field='vendor_name'; ?>-->
           <!--                 <label  for="<?=$field?>" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Purchase From</label>-->
           <!--                 <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">-->
        
        			<!--		<input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>" required="required"/>-->
    
           <!--                 </div>-->
           <!--             </div>-->

         <!--               <div class="form-group row m-0 pb-1">-->
								 <!--<? $field='qc_by';?>-->
         <!--                   <label for="<?=$field?>" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">QC By</label>-->
         <!--                   <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">-->
         <!-- 						<input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>" required/>-->
		       <!--          </div>-->
         <!--               </div>-->
						
						
						<div class="form-group row m-0 pb-1">
							<? $field='approved_by';?>
                            <label for="<?=$field?>" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Approved By</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                                
        
         						 <input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>" required/>
       
                            </div>
                        </div>

                        <div class="form-group row m-0 pb-1">
						<? $field='oi_details';?>
                            <label for="<?=$field?>" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Note</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
      
       						 <input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>" />
      
                            </div>
                        </div>
                        
                        
                        <!--<div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Company</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                                <select  id="group_for" name="group_for" required>
			   						<? if($group_for>0){ foreign_relation('user_group','id','company_short_code',$group_for,'1 and id="'.$group_for.'"'); }
			   						else{ ?><option></option><? 
			   						    foreign_relation('user_group','id','company_short_code',$group_for,'1 and status=1');}
			   						?>
            					</select>
                            </div>
                        </div>-->                         
                        
                        
                        
                        
                        

                    </div>



                </div>


            </div>

            <div class="n-form-btn-class">
                <input name="new" type="submit" value="<?=$btn_name?>" class="btn1 btn1-bg-submit"  tabindex="6">
				
				
				
            </div>
        </div>

		
        
    </form>




    <? if($_SESSION['oi_no2']>0){?>
	<form action="?<?=$unique?>=<?=$$unique?>" method="post" name="cloud" id="cloud">
        <!--Table input one design-->
        <div class="container-fluid">


            <table class="table1  table-striped table-bordered table-hover table-sm">
                <thead class="thead1">
                <tr class="bgc-info">
                    <th>Item Code</th>
                    <th width="30%">Item Description</th>
                    <th>Unit</th>
                    <th>Rate</th><th>Dis%</th>
					<th>Qty</th>
                    <th>Value</th>
					<th>Action</th>
                </tr>
                </thead>

                <tbody class="tbody1">

<tr>
<td>
<input list="items" name="item_id" type="text" class="input3"  value="" id="item_id" style="width:90%; height:30px;" onChange="getData()" autocomplete="off" autofocus/>
 <datalist id="items">
  <?php optionlist('select item_id,concat(finish_goods_code," # ",item_name) from item_info where 1 order by item_name');?>
 </datalist>

<input type="hidden" id="<?=$unique?>" name="<?=$unique?>" value="<?=$$unique?>"  />
<input type="hidden" id="oi_date" name="oi_date" value="<?=$oi_date?>"  />
<input type="hidden" id="vendor_id" name="vendor_id" value="<?=$vendor_id?>"  />
</td>


<td><input name="item_name" type="text" class="input3"  readonly=""  autocomplete="off"  value="" id="item_name"  /></td>
<td><input  name="unit_name" type="text"  id="unit_name" value="" readonly="readonly"/></td>
<td><input  name="rate" type="text"  id="rate" value="" onkeyup="count()" required/></td>

<td><input type="number" min="0" max="0" step="0.01" name="dis_per" id="dis_per" value="" onkeyup="count()"/></td>

<td><input  name="qty" type="text"  id="qty" value="" onkeyup="count()" required/></td>

<td><input name="amount" type="text"  id="amount" readonly/></td>
<td><input name="add" type="submit" id="add" value="ADD" class="btn1 btn1-bg-submit" /></td>

</tr>

</tbody>
</table>

</div>











<!--Data multi Table design start-->
        <div class="container-fluid pt-5 p-0 ">

			<table class="table1  table-striped table-bordered table-hover table-sm">
                <thead class="thead1">
                <tr class="bgc-info">
                    <th>S/L</th>
                    <th>Item Code</th>
                    <th>Item Name</th>
                    <th>Unit Price</th>

                    <th>Qty</th>
                    <th>Unit Name</th>
					<th>Amount</th>
                    <th>X</th>
                </tr>
                </thead>

                <tbody class="tbody1">

                <? 
$res='select a.id,b.item_name,a.rate as unit_price,a.qty ,a.unit_name,a.amount,"x" , b.finish_goods_code
from warehouse_other_issue_detail a,item_info b where b.item_id=a.item_id and a.oi_no='.$oi_no;
//echo link_report_add_del_auto($res,'2','5');
$qry = mysql_query($res);
$s=1;
while($data=mysql_fetch_object($qry)){
						?>
				<tr>
				    <td><?=$s++?></td>
                    <td><?=$data->finish_goods_code?></td>
                    <td><?=$data->item_name?></td>
                    <td><?=$data->unit_price?></td>

                    <td><?=$data->qty; $gqty+=$data->qty;?></td>
					<td><?=$data->unit_name?></td>
                    <td><?=$data->amount; $gtotal+=$data->amount;?></td>
                    <td><a href="?del=<?=$data->id?>"> X </a></td>

                </tr>
				<? } ?>
				<tr style="font-weight:bold;">
				    <td colspan="4" style="text-align:right;">Total</td>
				    <td><?=$gqty?></td>
				    <td></td>
				    <td><?=$gtotal?></td>
				</tr>

                </tbody>
            </table>

        </div>
    </form>







<!--button design start-->
    <form action="" method="post" name="cz" id="cz" onSubmit="if(!confirm('Are You Sure Execute this?')){return false;}">
        <div class="container-fluid p-0 ">

            <div class="n-form-btn-class">
				<input type="hidden" id="<?=$unique?>" name="<?=$unique?>" value="<?=$$unique?>"  />
                <input type="hidden" id="oi_date" name="oi_date" value="<?=$oi_date?>"  />
                <input type="hidden" id="vendor_id" name="vendor_id" value="<?=$vendor_id?>"  />
                <input type="hidden" id="group_for" name="group_for" value="<?=$group_for?>"  />
                
                <input name="delete" type="submit" class="btn1 btn-danger" value="DELETE" />
                <input name="hold" type="submit" class="btn1 btn-info" value="HOLD" />
                <input name="confirmm" type="submit" class="btn1 btn1-bg-submit" value="CONFIRM" />
            </div>

        </div>
    </form>
<? }?>
</div>








<script>$("#codz").validate();$("#cloud").validate();</script>

<script language="javascript">
function count(){

    if(document.getElementById('rate').value!=''){
    var rate = ((document.getElementById('rate').value)*1);
    var dis_per = ((document.getElementById('dis_per').value));
    var qty = ((document.getElementById('qty').value)*1);
        if(dis_per>0){
        var amount = (document.getElementById('amount').value) = qty*(((100-dis_per)/100)*rate);
        }else {
        var amount = (document.getElementById('amount').value) = qty*rate;   
        }
    }
}
</script>
<script>
function getData(){
    
var id = document.getElementById("item_id").value;

		jQuery.ajax({
			url:'ajax_price.php',
			type:'post',
			data:'id='+id,
			success:function(result){
				var json_data=jQuery.parseJSON(result);

				jQuery('#item_name').val(json_data.item_name);
				jQuery('#unit_name').val(json_data.unit);
				jQuery('#rate').val(json_data.price);
				jQuery('#dis_per').attr('max',json_data.direct_per);
				jQuery('#dis_per').val(json_data.direct_per);

			}

		})
	
}
</script>  




<?
require_once "../../../assets/template/layout.bottom.php";
?>