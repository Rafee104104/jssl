<?php

session_start();

ob_start();

require_once "../../../assets/template/layout.top.php";

$title='Sales Invoice Wise Receipt Voucher';

do_calander("#cheque_date");
 //create_combobox('do_no');

do_calander('#invoice_date');
//do_calander('#ldbc_no_date');
do_calander('#realization_date');

 $data_found = $_POST['account_code'];

if ($data_found==0) {
 create_combobox('account_code');
  }



if(prevent_multi_submit()){

if(isset($_REQUEST['confirmit']))

{


		$receipt_date=$_POST['invoice_date'];
		
		$dr_ledger_id=$_POST['dr_ledger_id'];
		
		
 if($_POST['account_code']!='')
  $account_code_con=" and d.account_code=".$_POST['account_code'];
  
 if($_POST['do_no']!='')
  $do_no_con=" and j.tr_id=".$_POST['do_no'];
  


		$group_for= $_SESSION['user']['group'];

		$entry_by= $_SESSION['user']['id'];
		$entry_at = date('Y-m-d H:i:s');
		
		
		//$YR = date('Y',strtotime($ch_date));
//  		$yer = date('y',strtotime($ch_date));
//  		$month = date('m',strtotime($ch_date));
//
//  		$ch_cy_id = find_a_field('sale_do_chalan','max(ch_id)','year="'.$YR.'"')+1;
//   		$cy_id = sprintf("%07d", $ch_cy_id);
//   		$chalan_no=''.$yer.''.$month.''.$cy_id;


		
		$receipt_no = next_transection_no($group_for,$receipt_date,'receipt_from_customer','receipt_no');


		 $sql = "SELECT d.dealer_code, d.account_code, d.dealer_name_e, j.jv_no, j.tr_no, j.jv_date, sum(j.dr_amt) as invoice_amt, j.tr_id FROM journal j, dealer_info d WHERE j.ledger_id=d.account_code and j.tr_from in ('Sales') ".$account_code_con.$do_no_con."  group by j.tr_no";

		$query = mysql_query($sql);

	


		while($data=mysql_fetch_object($query))

		{
	

			if($_POST['receipt_amt_'.$data->tr_no]>0)

			{
			
	

				$receipt_amt=$_POST['receipt_amt_'.$data->tr_no];
				$account_code=$_POST['account_code_'.$data->tr_no];
				$tr_no=$_POST['tr_no_'.$data->tr_no];



   $so_invoice = 'INSERT INTO receipt_from_customer (receipt_no, receipt_date, do_no, chalan_no, dealer_code, ledger_id, dr_ledger_id, receipt_amt, status, entry_at, entry_by, chalan_date, sales_jv_no)
  
  VALUES("'.$receipt_no.'", "'.$receipt_date.'", "'.$data->tr_id.'", "'.$tr_no.'", "'.$data->dealer_code.'", "'.$account_code.'", "'.$dr_ledger_id.'", "'.$receipt_amt.'", "COMPLETE", "'.$entry_at.'", "'.$entry_by.'", "'.$data->jv_date.'", "'.$data->jv_no.'")';

mysql_query($so_invoice);


}

}


if($receipt_no>0)
{
auto_insert_sales_receipt_secoundary($receipt_no);

}

?>

<script language="javascript">
window.location.href = "invoice_wise_receipt_update.php";
</script>

<?	

}

}

else

{

	$type=0;

	$msg='Data Re-Submit Warning!';

}






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



	function update_value(pi_id)



	{



var pi_id=pi_id; // Rent


var lc_no=(document.getElementById('lc_no').value);


var flag=(document.getElementById('flag_'+pi_id).value); 

var strURL="lc_update_ajax.php?pi_id="+pi_id+"&lc_no="+lc_no+"&flag="+flag;



		var req = getXMLHTTP();



		if (req) {



			req.onreadystatechange = function() {

				if (req.readyState == 4) {

					// only if "OK"

					if (req.status == 200) {						

						document.getElementById('divi_'+pi_id).style.display='inline';

						document.getElementById('divi_'+pi_id).innerHTML=req.responseText;						

					} else {

						alert("There was a problem while using XMLHTTP:\n" + req.statusText);

					}

				}				

			}

			req.open("GET", strURL, true);

			req.send(null);

		}	



}


function sum_sum(id){
var tot_due_amt = (document.getElementById('tot_due_amt_'+id).value)*1;

document.getElementById('receipt_amt_'+id).value = tot_due_amt;

}







</script>






<style>
/*
.ui-state-default a, .ui-state-default a:link, .ui-state-default a:visited, a.ui-button, a:link.ui-button, a:visited.ui-button, .ui-button {
    color: #454545;
    text-decoration: none;
    display: none;
}*/


div.form-container_large input {
    width: 200px;
    height: 38px;
    border-radius: 0px !important;
}



</style>






	<!--DO create 2 form with table-->
	<div class="form-container_large">
	
<form action="" method="post" name="codz" id="codz">

<? if ($data_found==0) { ?>
		<div class="container-fluid bg-form-titel">
            <div class="row">
                
                <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
                    <div class="form-group row m-0">
                        <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Customer Name</label>
                        <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0">
                           <select name="account_code" id="account_code">
								  <option></option>
								  <?
							
							foreign_relation('dealer_info','account_code','dealer_name_e',$_POST['account_code'],'1');
							
							?>
								</select>

                        </div>
                    </div>
                </div>

                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    
                    <input type="submit" name="submit" id="submit"  class="btn1 btn1-submit-input"value="View Invoice"/>
                </div>

            </div>
        </div>
		<? } ?>
	
	
	
		<? if(isset($_POST['submit'])){ ?>
			<!--        top form start hear-->
			<div class="container-fluid bg-form-titel">
				<div class="row">
					<!--left form-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
						<div class="container n-form2">
							<div class="form-group row m-0 pb-1">
								<label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Date</label>
								<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
									<input name="invoice_date" type="text" id="invoice_date"  value="<?=($invoice_date!='')?$invoice_date:date('Y-m-d')?>"   required />
								</div>
							</div>

							<div class="form-group row m-0 pb-1">

								<label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Job No</label>
								<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
									<select name="do_no" id="do_no">
	
										<option></option>
									
											<? foreign_relation('sale_do_master','do_no','job_no',$_POST['do_no'],'status!="MANUAL"'); ?>
									
										</select>
								</div>
							</div>

							<div class="form-group row m-0 pb-1">
								<label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Check No</label>
								<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
									<input  name="cheque_no" type="text" id="cheque_no"  value="<?=$_POST['cheque_no']?>"    />

								</div>
							</div>

						</div>



					</div>

					<!--Right form-->
					<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
						<div class="container n-form2">
							<div class="form-group row m-0 pb-1">
								<label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Rec From</label>
								<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
									<input name="account_code" type="hidden" id="account_code"  readonly="" value="<?=$_POST['account_code'];?>"  required tabindex="105" />
									
									<? $dealer_data = find_all_field('dealer_info','','account_code='.$_POST['account_code']); 
									$dealer_closing = find_a_field_sql("select sum(dr_amt-cr_amt) from journal where ledger_id = '".$_POST['account_code']."'");
	
									$closing_balance=$dealer_closing;
									?>
																		
         <input name="received_from" type="text" id="received_from"  readonly=""  value="<?=$dealer_data->dealer_name_e;?>"  required tabindex="105" />
								</div>
							</div>

							<div class="form-group row m-0 pb-1">

								<label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">PMT Method</label>
								<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
									<select name="payment_method" id="payment_method" required onchange="getData2('cash_bank_ajax.php', 'cash_bank_filter',        this.value,  document.getElementById('payment_method').value);">
									<option></option>
	
								
										<? foreign_relation('payment_method','payment_method','payment_method',$_POST['payment_method'],'1');?>
									</select>
								</div>
							</div>

							<div class="form-group row m-0 pb-1">
								<label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Cheque Date</label>
								<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
									<input  name="cheque_date" type="text" id="cheque_date"  value="<?=$_POST['cheque_date']?>"    />

								</div>
							</div>

						</div>



					</div>
					<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
						<div class="container n-form2">
							<div class="form-group row m-0 pb-1">
								<label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Cus Balance</label>
								<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
									<input name="custemer_balance" type="text" id="custemer_balance" required readonly="" autocomplete="off"  
				 value="<? if ($dealer_closing>0) { echo  number_format($closing_balance,2). ""; } else { echo number_format($closing_balance*(-1),2). ""; }?>"/>
								</div>
							</div>

							<div class="form-group row m-0 pb-1">

								<label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Cash/Bank</label>
								<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
									<select name="dr_ledger_id" id="dr_ledger_id" required="required">
									  <option></option>
									  <?php /*?><? foreign_relation('accounts_ledger','ledger_id','ledger_name',$_POST['dr_ledger_id'],'ledger_group_id in (10201,10202)');?><?php */?>
									  <? foreign_relation('accounts_ledger','ledger_id','ledger_name',$receive_acc_head,' acc_sub_sub_class=126 order by ledger_id');?>
									</select>
								</div>
							</div>

							<div class="form-group row m-0 pb-1">
								<label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Name of Bank</label>
								<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
									<input  name="of_bank" type="text" id="of_bank"  value="<?=$_POST['of_bank']?>"    />

								</div>
							</div>

						</div>



					</div>


				</div>

				

			</div>
			
			<? } ?>

		
			<? if(isset($_POST['submit'])){ ?>
			
			<div class="container-fluid pt-5 p-0 ">

				<table class="table1  table-striped table-bordered table-hover table-sm">
					<thead class="thead1">
					<tr class="bgc-info">
						<th>JOb No </th>

						<th>Invoice No </th>
					
						<th>Invoice Date </th>
						<th>Invoice Amt </th>
						<th>Total Pay  Amt </th>
						<th>Due Amt </th>
						<th>Receipt Amt </th>
						<th>Action</th>
					</tr>
					</thead>

					<tbody class="tbody1">
					
					<?
  
  
					  if($_POST['fdate']!=''&&$_POST['tdate']!='') $date_con .= ' and c.chalan_date between "'.$_POST['fdate'].'" and "'.$_POST['tdate'].'"';
					  
					  
						
					 if($_POST['account_code']!='')
					  $account_code_con=" and d.account_code=".$_POST['account_code'];
					  
					 if($_POST['do_no']!='')
					  $do_no_con=" and j.tr_id=".$_POST['do_no'];
					  
					
					
					
					
					  
					 $sql = "select sum(cr_amt) as receipt_amt, ledger_id, tr_id  from journal where tr_from='Receipt' group by tr_id ";
					$query = mysql_query($sql);
					while($data=mysql_fetch_object($query)){
					$receipt_amt[$data->ledger_id][$data->tr_id]=$data->receipt_amt;
					
					}
					  
					  
					  
					 $sql = "select sum(cr_amt) as return_amt, ledger_id, tr_id  from journal where tr_from='Sales Return'  group by tr_id";
					$query = mysql_query($sql);
					while($data=mysql_fetch_object($query)){
					$return_amt[$data->ledger_id][$data->tr_id]=$data->return_amt;
					
					}
					 
					  
					
					
					   
						$sql = "SELECT d.account_code, d.dealer_name_e, j.tr_no, j.jv_date, sum(j.dr_amt) as invoice_amt, j.tr_id FROM journal j, dealer_info d WHERE j.ledger_id=d.account_code and j.tr_from in ('Sales')  ".$account_code_con.$do_no_con."  group by j.tr_no";
					
					
					
					  $query = mysql_query($sql);
					
					
					
					  while($data=mysql_fetch_object($query)){$i++;
					
					
					  ?>
					
					
					
					<? if ($due_amt=$data->invoice_amt-$receipt_amt[$data->account_code][$data->tr_no]+$return_amt[$data->account_code][$data->tr_no]>0) {?>
					
					  <tr>
						<td><a href="../../../sales_mod/pages/wo/sales_order_print_view.php?v_no=<?=$data->tr_id?>" target="_blank"><span class="style13" >
						  <?=find_a_field('sale_do_master','job_no','do_no='.$data->tr_id);?>
						</span></a></td>
					
						<td><a href="../../../warehouse_mod/pages/wo/sales_invoice_print_view.php?v_no=<?=$data->tr_no?>" target="_blank"><span class="style13" >
						  <?=$data->tr_no?>
						</span></a><a title="WO Preview" target="_blank" href="../../../sales_mod/pages/wo/work_order_print_view.php?v_no=<?=$data->do_no?>"></a></td>
					
						<td><?php echo $data->jv_date;?></td>
						<td><strong>
						  <?=number_format($data->invoice_amt,2);?>
						</strong></td>
						<td><strong>
						  <?=number_format($receipt_amt[$data->account_code][$data->tr_no]+$return_amt[$data->account_code][$data->tr_no],2);?>
						</strong></td>
						<td><strong><? echo number_format($due_amt=$data->invoice_amt-$receipt_amt[$data->account_code][$data->tr_no]+$return_amt[$data->account_code][$data->tr_no],2);?></strong>
						<input name="tot_due_amt_<?=$data->tr_no?>" id="tot_due_amt_<?=$data->tr_no?>" type="hidden"  value="<?=$due_amt?>" />
						</td>
						<td>
						<input name="account_code_<?=$data->tr_no?>" id="account_code_<?=$data->tr_no?>" type="hidden"  value="<?=$data->account_code?>" style="width:80px;" />
					 <input name="tr_no_<?=$data->tr_no?>" id="tr_no_<?=$data->tr_no?>" type="hidden"  value="<?=$data->tr_no?>"  />
					 <input name="receipt_amt_<?=$data->tr_no?>" id="receipt_amt_<?=$data->tr_no?>" type="text"  value=""  />	</td>
						<td align="center"><center><button onclick="sum_sum(<?=$data->tr_no ?>)" type="button" class="btn1 btn1-bg-submit" >Full</button></center></td>
					  </tr>
					
					  <? } }?>
					

					

					</tbody>
				</table>

			</div>
			
			
	

		<!--button design start-->
		
			<div class="container-fluid p-0 ">

				<div class="n-form-btn-class">
					<input name="confirmit" type="submit" class="btn1 btn1-submit-input" value="SAVE & NEW"  />
				</div>

			</div>
		
		
		<? } ?>
			</form>
	</div>






<br /><br />

<?php /*?><div class="form-container_large">

<form action="" method="post" name="codz" id="codz">

<? if ($data_found==0) { ?>

<div class="box" style="width:100%;">


<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>

    <td align="right" ><strong>Customer Name : </strong></td>



    <td ><select name="account_code" id="account_code" style="width:220px;">
      <option></option>
      <?

foreign_relation('dealer_info','account_code','dealer_name_e',$_POST['account_code'],'1');

?>
    </select></td>



    <td rowspan="4" ><strong>

      <input type="submit" name="submit" id="submit"  class="btn1 btn1-submit-input"value="View Invoice"/>

    </strong></td>
    </tr>
								  
					  
								  
								</table>

    </div>

<? }?>


<? if(isset($_POST['submit'])){ ?>


<div class="box" style="width:100%;">

								
 <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:12px;">

	 <tr>
	 <td width="7%"> <strong>DATE:</strong></td>
	 
	 <td width="24%">							
	 <input style="width:220px; height:32px;"  name="invoice_date" type="text" id="invoice_date"  value="<?=($invoice_date!='')?$invoice_date:date('Y-m-d')?>"   required />									     </td>
	 
   	<td width="14%"><strong>RECEIVED FROM :</strong>R</td>
	 <td width="21%">						
	<input name="account_code" type="hidden" id="account_code"  readonly="" style="width:220px; height:32px;" value="<?=$_POST['account_code'];?>"  required tabindex="105" />
									
									<? $dealer_data = find_all_field('dealer_info','','account_code='.$_POST['account_code']); 
									$dealer_closing = find_a_field_sql("select sum(dr_amt-cr_amt) from journal where ledger_id = '".$_POST['account_code']."'");
	
									$closing_balance=$dealer_closing;
									?>
																		
         <input name="received_from" type="text" id="received_from"  readonly="" style="width:220px; height:32px;" value="<?=$dealer_data->dealer_name_e;?>"  required tabindex="105" />										    </td>
									
									
									
			<td width="14%"><strong>CUSTOMER BALANCE :</strong></td>
			<td width="20%">
									
			<table>
		  	<tr>
				<td><input name="custemer_balance" type="text" id="custemer_balance" required readonly="" style="width:120px; height:32px; " autocomplete="off"  
				 value="<? if ($dealer_closing>0) { echo  number_format($closing_balance,2). ""; } else { echo number_format($closing_balance*(-1),2). ""; }?>"/>				</td>
				<td><? 	if ($dealer_closing>0) { echo  "<b>(DR)</b>"; } else { echo  "<b>(CR)</b>"; } ?></td>
			</tr>
		   </table>
		   </td>						
		  </tr>
								  
								  
  
			  <tr>
			  <td> <strong>JOB NO:</strong></td>
			 <td>

	<select name="do_no" id="do_no" style="width:220px;">
	
	<option></option>

        <? foreign_relation('sale_do_master','do_no','job_no',$_POST['do_no'],'status!="MANUAL"'); ?>

    </select>								</td>
									<td><strong>PMT. METHOD:</strong></td>
									<td>
								
									<select name="payment_method" id="payment_method" required style="width:220px;" onchange="getData2('cash_bank_ajax.php', 'cash_bank_filter',        this.value,  document.getElementById('payment_method').value);">
									<option></option>
	
								
										<? foreign_relation('payment_method','payment_method','payment_method',$_POST['payment_method'],'1');?>
									</select>
																											</td>
									<td><strong>CASH/BANK:</strong></td>
									<td><span id="cash_bank_filter">
									
									
									<select name="dr_ledger_id" id="dr_ledger_id" required="required" style="width:220px;">
									  <option></option>
									  <? foreign_relation('accounts_ledger','ledger_id','ledger_name',$_POST['dr_ledger_id'],'ledger_group_id in (10201,10202)');?>
									</select>
									</span>										</td>
								  </tr>
								  <tr>
								    <td> <strong>CHEQUE NO:</strong></td>
								    <td>
									<input style="width:220px; height:32px;"  name="cheque_no" type="text" id="cheque_no"  value="<?=$_POST['cheque_no']?>"    />									</td>
								    <td><strong>CHEQUE DATE:</strong></td>
								    <td><input style="width:220px; height:32px;"  name="cheque_date" type="text" id="cheque_date"  value="<?=$_POST['cheque_date']?>"    />		</td>
								    <td><strong>OF BANK: </strong></td>
								    <td>
									<input style="width:220px; height:32px;"  name="of_bank" type="text" id="of_bank"  value="<?=$_POST['of_bank']?>"    />	
									</span>									</td>
							      </tr>
								  
								  
								  
								</table>

    </div>
	
	<? }?>



<? if(isset($_POST['submit'])){ ?>

<div class="tabledesign2" style="width:100%">

<table width="100%" border="0" align="center" id="grp" cellpadding="0" cellspacing="0" style="font-size:12px; text-transform:uppercase;">

  <tr>
    <th width="12%">JOb No </th>

    <th width="15%">Invoice No </th>

    <th width="19%">Invoice Date </th>
    <th width="12%">Invoice Amt </th>
    <th width="11%">Total Pay  Amt </th>
    <th width="9%">Due Amt </th>
    <th width="11%">Receipt Amt </th>
    <th width="11%">Action</th>
  </tr>
  

  <?
  
  
  if($_POST['fdate']!=''&&$_POST['tdate']!='') $date_con .= ' and c.chalan_date between "'.$_POST['fdate'].'" and "'.$_POST['tdate'].'"';
  
  
	
 if($_POST['account_code']!='')
  $account_code_con=" and d.account_code=".$_POST['account_code'];
  
 if($_POST['do_no']!='')
  $do_no_con=" and j.tr_id=".$_POST['do_no'];
  




  
 $sql = "select sum(cr_amt) as receipt_amt, ledger_id, tr_id  from journal where tr_from='Receipt' group by tr_id ";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$receipt_amt[$data->ledger_id][$data->tr_id]=$data->receipt_amt;

}
  
  
  
 $sql = "select sum(cr_amt) as return_amt, ledger_id, tr_id  from journal where tr_from='Sales Return'  group by tr_id";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$return_amt[$data->ledger_id][$data->tr_id]=$data->return_amt;

}
 
  


   
    $sql = "SELECT d.account_code, d.dealer_name_e, j.tr_no, j.jv_date, sum(j.dr_amt) as invoice_amt, j.tr_id FROM journal j, dealer_info d WHERE j.ledger_id=d.account_code and j.tr_from in ('Sales')  ".$account_code_con.$do_no_con."  group by j.tr_no";



  $query = mysql_query($sql);



  while($data=mysql_fetch_object($query)){$i++;


  ?>



<? if ($due_amt=$data->invoice_amt-$receipt_amt[$data->account_code][$data->tr_no]+$return_amt[$data->account_code][$data->tr_no]>0) {?>

  <tr bgcolor="<?=($i%2)?'#E8F3FF':'#fff';?>">
    <td><a href="../../../sales_mod/pages/wo/sales_order_print_view.php?v_no=<?=$data->tr_id?>" target="_blank"><span class="style13" style="color:#000000; font-weight:700;">
      <?=find_a_field('sale_do_master','job_no','do_no='.$data->tr_id);?>
    </span></a></td>

    <td><a href="../../../warehouse_mod/pages/wo/sales_invoice_print_view.php?v_no=<?=$data->tr_no?>" target="_blank"><span class="style13" style="color:#000000; font-weight:700;">
      <?=$data->tr_no?>
    </span></a><a title="WO Preview" target="_blank" href="../../../sales_mod/pages/wo/work_order_print_view.php?v_no=<?=$data->do_no?>"></a></td>

    <td><?php echo date('d-m-Y',strtotime($data->jv_date));?></td>
    <td><strong>
      <?=number_format($data->invoice_amt,2);?>
    </strong></td>
    <td><strong>
      <?=number_format($receipt_amt[$data->account_code][$data->tr_no]+$return_amt[$data->account_code][$data->tr_no],2);?>
    </strong></td>
    <td><strong><? echo number_format($due_amt=$data->invoice_amt-$receipt_amt[$data->account_code][$data->tr_no]+$return_amt[$data->account_code][$data->tr_no],2);?></strong>
	<input name="tot_due_amt_<?=$data->tr_no?>" id="tot_due_amt_<?=$data->tr_no?>" type="hidden" size="10"  value="<?=$due_amt?>" style="width:80px;" />
	</td>
    <td>
	<input name="account_code_<?=$data->tr_no?>" id="account_code_<?=$data->tr_no?>" type="hidden" size="10"  value="<?=$data->account_code?>" style="width:80px;" />
 <input name="tr_no_<?=$data->tr_no?>" id="tr_no_<?=$data->tr_no?>" type="hidden" size="10"  value="<?=$data->tr_no?>" style="width:80px;" />
 <input name="receipt_amt_<?=$data->tr_no?>" id="receipt_amt_<?=$data->tr_no?>" type="text" size="10"  value="" style="width:120px; height:25px;"  />	</td>
    <td align="center"><center><button onclick="sum_sum(<?=$data->tr_no ?>)" type="button" class="btn1 btn1-bg-submit" >Full</button></center></td>
  </tr>

  <? } }?>
</table>



</div>
<br /><br />

<table width="100%" border="0">






<tr>

<td align="center">&nbsp;

</td>

<td align="center">
<!--<input  name="do_no" type="hidden" id="do_no" value="<?=$_POST['do_no'];?>"/>-->
<input name="confirmit" type="submit" class="btn1 btn1-submit-input" value="SAVE & NEW"  /></td>

</tr>



</table>
<?php */?>

<?php /*?><table width="100%" border="0">

<? 

 		$pi_status = find_a_field('pi_master','status','id="'.$_POST['pi_id'].'"');
		 // $issue_qty = find_a_field('sale_do_production_issue','sum(total_unit)','do_no='.$_POST['do_no']);


if($pi_status!="MANUAL"){




?>

<tr>

<td colspan="2" align="center" bgcolor="#FF3333"><strong> Master PI Data Entry Completed</strong></td>

</tr>

<? }else{?>

<tr>

<td align="center">&nbsp;

</td>

<td align="center">
<!--<input  name="do_no" type="hidden" id="do_no" value="<?=$_POST['do_no'];?>"/>-->
<input name="confirm" type="submit" class="btn1" value="COMPLETE" style="width:270px; font-weight:bold; float:right; font-size:12px; height:30px; color:#090" /></td>

</tr>

<? }?>

</table><?php */?>




<?php /*?><? }?>








<p>&nbsp;</p>

</form>

</div>
<?php */?>


<?

$main_content=ob_get_contents();

ob_end_clean();

include ("../../template/main_layout.php");

?>