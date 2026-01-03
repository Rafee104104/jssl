<?php
session_start();

ob_start();

require_once "../../../assets/template/layout.top.php";

$title='New Consumption';
$page = "other_issue2.php";
$ajax_page = "packing_issue_ajax.php";
$page_for = 'Consumption';
//do_calander('#oi_date','-250','0');
do_calander('#oi_date');

$table_master='warehouse_other_issue';
$table_details='warehouse_other_issue_detail';
$unique='oi_no';


if($_GET['mhafuz']>0){
	unset($_SESSION[$unique]);
}

if($_POST['old_oi_no']>0){
	$_SESSION[$unique] = $_POST['old_oi_no'];
}



if (isset($_POST['new'])) {

    $crud = new crud($table_master);

    if (!isset($_SESSION[$unique])) {
        $_POST['oi_date'] = find_a_field('requisition_master_stationary','req_date','req_no="'.$_POST['req_no'].'"');
        $_POST['entry_by'] = $_SESSION['user']['id'];
        $_POST['entry_at'] = date('Y-m-d H:i:s');
        $_POST['edit_by']  = $_SESSION['user']['id'];
        $_POST['edit_at']  = date('Y-m-d H:i:s');
	

        $$unique = $_SESSION[$unique] = $crud->insert();

       
        if (!empty($_POST['req_no']) && $_POST['req_no'] > 0) {

            $sql5 = 'SELECT * FROM requisition_order_stationary WHERE req_no=' . intval($_POST['req_no']);
            $query = mysql_query($sql5);

            while ($row = mysql_fetch_object($query)) {
              
               $item_price = find_a_field(
				'journal_item',
				'final_price',
				'warehouse_id="'.$_SESSION['user']['depot'].'" and tr_from in ("Opening","Purchase")
				 AND item_id="'.$row->item_id.'" order by id desc'
			);


                if ($item_price === null || $item_price === '') {
                    $item_price = 0;
                }

                $amt = $item_price * $row->qty;

                
                $sql_insert = 'INSERT INTO warehouse_other_issue_detail 
                    (oi_no, item_id, issued_to, issue_type, oi_date, warehouse_id, rate, qty, amount)
                    VALUES (
                        "' . $$unique . '",
                        "' . $row->item_id . '",
                        "' . $_POST['issued_to'] . '",
                        "' . $page_for . '",
                        "' . $_POST['oi_date'] . '",
                        "' . $_POST['warehouse_id'] . '",
                        "' . $item_price . '",
                        "' . $row->qty . '",
                        "' . $amt . '"
                    )';

                if (!mysql_query($sql_insert)) {
                    die("Insert Error: " . mysql_error() . "<br>SQL: " . $sql_insert);
                }

               
                $sql3 = 'UPDATE requisition_order_stationary SET req_status=1 WHERE id=' . $row->id;
                mysql_query($sql3);
            }
        }

        
        unset($$unique);

        $type = 1;
        $msg  = $title . ' No Created. (No :-' . $_SESSION[$unique] . ')';

    } else {
       
        $_POST['edit_by'] = $_SESSION['user']['id'];
        $_POST['edit_at'] = date('Y-m-d H:i:s');
        $crud->update($unique);

        $type = 1;

        if (!empty($_POST['oi_date'])) {
            $sql = "UPDATE " . $table_details . " 
                    SET oi_date = '" . $_POST['oi_date'] . "' 
                    WHERE " . $unique . " = " . intval($_POST['oi_no']);
            mysql_query($sql);
        }

        $msg = 'Successfully Updated.';
    }

    header('Location: packing_issue2.php');
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
		
}


if(isset($_POST['confirmm']))
{       
       // $req = $_POST['req_noo'];
//		unset($_POST);
//		$_POST[$unique]=$$unique;
//		$_POST['entry_by']=$_SESSION['user']['id'];
//		$_POST['entry_at']=date('Y-m-d h:s:i');
//		$_POST['status']='UNCHECKED';
//		$crud   = new crud($table_master);
//		$crud->update($unique);
//		$total_amt = 0;
//		
//		if($req>0){
//			echo'ar'; $sql = "update requisition_master_stationary set status = 'COMPLETE' where req_no = ".$req;
//			mysql_query($sql);
//		}
		
		
		unset($_POST);
		$_POST[$unique]=$$unique;
		$_POST['entry_by']=$_SESSION['user']['id'];
		$_POST['entry_at']=date('Y-m-d h:s:i');
		$_POST['status']='CHECKED';
		$crud   = new crud($table_master);
		$crud->update($unique);
		$total_amt = 0;
		
		$req_no_st = find_a_field('warehouse_other_issue','req_no','oi_no='.$$unique);
		if($req_no_st>0){
			$upql = 'update requisition_master_stationary set status = "COMPLETE" where req_no='.$req_no_st;
			mysql_query($upql);
		}	
		
		 $sql = 'select * from warehouse_other_issue_detail where oi_no='.$$unique;
		$query = mysql_query($sql);
		while($oii = mysql_fetch_object($query)){
		$item_name = find_a_field('item_info','item_name','item_id='.$oii->item_id);
		$item_sub_group = find_a_field('item_info','sub_group_id','item_id='.$oii->item_id);
		
		journal_item_control($oii->item_id, $_SESSION['user']['depot'],$oii->oi_date,0,$oii->qty,$page_for,$oii->id,$oii->rate,'',$$unique);
		$total_amt = $total_amt + ($oii->qty*$oii->rate);
		$oi_date = $oii->oi_date;
		$item_id = $oii->item_id;
		}
		
		
		
		
		
		$details_sql = 'select sum(d.amount) as total_amt, i.item_id, s.item_ledger, s.cogs_ledger, d.oi_no 
                from warehouse_other_issue_detail d, item_info i, item_sub_group s 
                where s.sub_group_id = i.sub_group_id 
                and d.item_id = i.item_id 
                and d.issue_type = "Consumption" 
                and d.oi_no = "' . $$unique . '" 
                group by s.item_ledger';
			$details_query = mysql_query($details_sql);
			
			$tot_cogs_amt = 0;
			$cogs_amt = 0;
			$jv_date = $oi_date;
			$jv_no=next_journal_sec_voucher_id('',$page_for);
			
			$cc_code = find_a_field_sql("select w.cc_code from warehouse w where w.warehouse_id=" . $_SESSION['user']['depot']);

				while ($det_row = mysql_fetch_object($details_query)) {
				   $item_sql = 'SELECT i.item_id, s.item_ledger, s.cogs_ledger, i.item_name, d.rate, d.qty
							 FROM warehouse_other_issue_detail d
							 JOIN item_info i ON d.item_id = i.item_id
							 JOIN item_sub_group s ON s.sub_group_id = i.sub_group_id
							 WHERE d.issue_type = "Consumption"
							 AND d.oi_no = "' . $$unique . '"
							 AND s.item_ledger = "' . $det_row->item_ledger . '"
							 GROUP BY i.item_id';
				$item_query = mysql_query($item_sql);
				
				$item_names = [];
				$rates = [];
				$qtys = [];
				
				while ($row = mysql_fetch_object($item_query)) {
					$item_names[] = $row->item_name;
					$rates[] = $row->rate;
					$qtys[] = $row->qty;
				}
				
				// Construct the narration with items, rates, and quantities
				$narration_parts = [];
				for ($i = 0; $i < count($item_names); $i++) {
					$narration_parts[] = $item_names[$i] . " (Rate: " . $rates[$i] . ", Qty: " . $qtys[$i] . ")";
				}
				
				$narration = implode(',<br>', $narration_parts);
				
				
				
					
					echo $cogs_amt = $det_row->total_amt;
					$tot_cogs_amt += $cogs_amt;
				
					add_to_sec_journal($proj_id, $jv_no, $jv_date, $det_row->item_ledger, $narration, '0', $cogs_amt, 'Consumption', $$unique, '', $$unique, $cc_code);
					add_to_sec_journal($proj_id, $jv_no, $jv_date, $det_row->cogs_ledger, $narration, $cogs_amt, '0', 'Consumption', $$unique, '', $$unique, $cc_code);
				}
		
		
		
		
		unset($$unique);
		unset($_SESSION[$unique]);
		$type=1;
		$msg='Successfully Forwarded.';

}


if(isset($_POST['add'])&&($_POST[$unique]>0))
{

	if($_POST['stock'] >= $_POST['qty'])
	{
		$crud   = new crud($table_details);
		$iii=explode('#>',$_POST['item_id']);
		$_POST['item_id']=$iii[1];
		$_POST['entry_by']=$_SESSION['user']['id'];
		$_POST['entry_at']=date('Y-m-d h:s:i');
		$_POST['edit_by']=$_SESSION['user']['id'];
		$_POST['edit_at']=date('Y-m-d h:s:i');
		$xid = $crud->insert();
		
		}
		else
		{
		echo "<script>alert('Not Engough Stock!!!');</script>";
		//echo "<script>alert(" . json_encode($_POST['qty']) . ");</script>";

		
		}
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

auto_complete_from_db('item_info','item_id','concat(item_name,"#>",item_id)','1','item_id');
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
<div class="form-container_large">
<form action="" method="post" name="codz" id="codz" onSubmit="if(!confirm('Are You Sure Execute this?')){return false;}">


<form action="<?=$page?>" method="post" name="codz2" id="codz2">
    <!--        top form start hear-->
    <div class="container-fluid bg-form-titel">
      <div class="row">
        <!--left form-->
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="container n-form2">
            <div class="form-group row m-0 pb-1">
              <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">OI No</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                <? $field='oi_no';?>
				  <div>
					
					<input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>"/>
				  </div>
              </div>
            </div>
          
            <div class="form-group row m-0 pb-1">
              <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">OI Date</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
               <? $field='oi_date';  ?>
			  <div>
				
				<input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>"  required="required" />
			  </div>
              </div>
            </div>
          
          
            <div class="form-group row m-0 pb-1">
              <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Req No</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                
				<select name="req_no" id="req_no"  onchange="getData2('organization_ajax.php', 'org',this.value,document.getElementById('warehouse_id').value);">
					<option></option>
					<? foreign_relation('requisition_master_stationary','req_no','concat(req_no,"-",req_date)',$req_no,' status="APPROVED"');?>
				</select>
              </div>
            </div>
            
           
            <div class="form-group row m-0 pb-1">
              <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Note </label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                <? $field='oi_subject';?>
			  
				
				<input  name="<?=$field?>" type="text" id="<?=$field?>" value="<?=$$field?>" />
			 
			  
				<input  name="warehouse_id" type="hidden" id="warehouse_id" value="<?=$_SESSION['user']['depot']?>"  required/>
		
				<input  name="issue_type" type="hidden" id="issue_type" value="<?=$page_for?>"  required="required"/>
              </div>
            </div>
			
          </div>
        </div>
        <!--Right form-->
        <!-- Right form -->
<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
  <div class="container n-form2">

    <!-- Organization -->
    <div class="form-group row m-0 pb-1">
      <label class="col-sm-4 col-form-label bg-form-titel-text text-end">Organization</label>
      <div class="col-sm-8">
        <? $field='organization'; ?>
        <select name="organization" id="organization" value="<?=$organization2?>" class="form-control" required>
          <? foreign_relation('user_group','id','group_name',$organization,'1'); ?>
        </select>
      </div>
    </div>

    <!-- Approved By -->
    <div class="form-group row m-0 pb-1">
      <label class="col-sm-4 col-form-label bg-form-titel-text text-end">Approved By</label>
      <div class="col-sm-8">
        <? $field='approved_by'; ?>
        <input type="text" name="<?=$field?>" id="<?=$field?>" value="<?=$$field?>" class="form-control">
      </div>
    </div>

    <!-- Requisition From -->
    <div class="form-group row m-0 pb-1">
      <label class="col-sm-4 col-form-label bg-form-titel-text text-end">Requisition From</label>
      <div class="col-sm-8">
        <? $field='requisition_from'; ?>
        <input type="text" name="<?=$field?>" id="<?=$field?>" value="<?=$$field?>" class="form-control" required>
      </div>
    </div>

    <!-- Issued To -->
    <div class="form-group row m-0 pb-1">
      <label class="col-sm-4 col-form-label bg-form-titel-text text-end">Issued To</label>
      <div class="col-sm-8">
        <? $field='issued_to'; ?>
        <input type="text" name="<?=$field?>" id="<?=$field?>" value="<?=$$field?>" class="form-control" required>
      </div>
    </div>

    <!-- SR No -->
    <div class="form-group row m-0 pb-1">
      <label class="col-sm-4 col-form-label bg-form-titel-text text-end">SR No</label>
      <div class="col-sm-8">
        <? $field='manual_oi_no'; ?>
        <input type="text" name="<?=$field?>" id="<?=$field?>" 
          value="<?
            if($manual_oi_no>0){
              echo $manual_oi_no;
            }else{
              echo find_a_field('warehouse_other_issue','manual_oi_no',' issue_type = "Consumption" and warehouse_id='.$_SESSION['user']['depot'].' order by manual_oi_no desc')+1;
            }
          ?>" 
          class="form-control" required>
      </div>
    </div>

  </div><!-- end container n-form2 -->
</div><!-- end col -->

 </div>       
      <div class="n-form-btn-class text-center mt-3">
	  <? if($$unique_master>0) { ?>
		<input name="new" type="submit" class="btn1 btn1-bg-submit" value="<?=$btn_name?>" />
	  <? } else { ?>
		<input name="new" type="submit" class="btn1 btn1-bg-submit" value="<?=$btn_name?>" />
	  <? } ?>
	</div>

    
    
  </form>
  
  </div>

</form>
<? if($_SESSION[$unique]>0){?>
<form action="?<?=$unique?>=<?=$$unique?>" method="post" name="cloud" id="cloud">



<table class="table1  table-striped table-bordered table-hover table-sm">
		<thead class="thead1">
          <tr class="bgc-info">
			
				<th>S/L</th>
				<th>Item Code</th>
				<th>Item Description</th>
				<th>Stock</th>
				<th>Quantity</th>
				<th>Unit</th>
				<th>Unit Price</th>
				<th>Amount</th>
				
			</tr>
			</thead>
			<tbody>
	<?php

  $sql9='select a.id,b.finish_goods_code as Item_code,b.item_id, b.item_name as item_description , a.qty as Quantity ,a.unit_name, a.rate as unit_price,a.amount
 from warehouse_other_issue_detail a,item_info b
 
  where b.item_id=a.item_id and a.oi_no='.$oi_no;
$query=mysql_query($sql9);

 while($data=mysql_fetch_object($query)){
  $stock = find_a_field('journal_item', 'sum(item_in - item_ex)', 'item_id="'.$data->item_id.'"'); 
?>
		
			
			<tr <?php if($stock < $data->Quantity) { echo 'style="background-color:red!important"'; 
				$stock_alert+=1;
				} ?>>
				<td><?=++$i?></td>
				<td><?=$data->item_id ?></td>
				<td><?=$data->item_description ?></td>
				<td><input type="text"  readonly="readonly" name="stock<?=$data->id?>" id="stock<?=$data->id?>" value="<?=find_a_field('journal_item','sum(item_in-item_ex)','item_id='.$data->item_id);?>"/> </td>
				<td>
				<input type="text" readonly="readonly" onkeyup="count_1(<?=$data->id?>)" onblur="update_item(<?=$data->id?>)" name="qty<?=$data->id?>" id="qty<?=$data->id?>" value="<?=$data->Quantity?>"/></td>
				<td><?=find_a_field('item_info','unit_name','item_id='.$data->item_id); ?></td>
				<td>
				<input type="hidden" required name="details_id<?=$data->id?>"  value="<?  echo $data->id; ?>" />
				
				<input type="text" readonly="readonly" onkeyup="count_1(<?=$data->id?>)" onblur="update_item(<?=$data->id?>)" required name="unit_price<?=$data->id?>" id="unit_price<?=$data->id?>" value="<? if($data->unit_price>0) echo $data->unit_price; ?>" />
				</td>
				<td><input type="text" readonly readonly="readonly" required name="amount<?=$data->id?>" id="amount<?=$data->id?>" value="<? if($data->amount>0) echo $data->amount; ?>" /></td>
				
				
				
			</tr>
			<?php } ?>
		</tbody>
	</table>
</form>

<form action="" method="post" name="cz" id="cz" onSubmit="if(!confirm('Are You Sure Execute this?')){return false;}">
  <table width="100%" border="0">
    <tr>
      <td align="center"><input name="delete" type="submit" class="btn1 btn1-bg-cancel" value="Delete"  /></td>
      <td align="center">
	  <?  if($stock_alert<1) { ?>
	  <input name="req_noo" id="req_noo" type="hidden" value="<?=$req_no;?>" />	
      <input name="confirmm" type="submit" class="btn1 btn1-bg-submit" value="CONFIRM AND FORWARD RD"  />
<? }?>
      </td>
    </tr>
  </table>
</form>

<? }?>

  </div>
        </div>
      
<script>$("#codz").validate();$("#cloud").validate();</script>
<?
$main_content=ob_get_contents();
ob_end_clean();
include ("../../template/main_layout.php");
?>