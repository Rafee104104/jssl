<?php

session_start();

ob_start();

require_once "../../../assets/template/layout.top.php";

$title='Booking Wise Loan Manage';


  create_combobox('do_no');

do_calander('#invoice_date');
//do_calander('#ldbc_no_date');
do_calander('#realization_date');

do_calander('#cheque_date');

 $data_found = $_POST['account_code'];

if ($data_found==0) {
 create_combobox('account_code');
  }



if(prevent_multi_submit()){

if(isset($_REQUEST['confirmit']))

{


		$payment_date=$_POST['invoice_date'];
		
		$cr_ledger_id=$_POST['cr_ledger_id'];
		
		
 if($_POST['account_code']!='')
  $account_code_con=" and d.ledger_id=".$_POST['account_code'];
  
 if($_POST['po_no']!='')
  $po_no_con=" and j.tr_id=".$_POST['po_no'];
  


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


		
		$payment_no = next_transection_no($group_for,$payment_date,'payment_vendor','payment_no');


		 $sql = "SELECT d.vendor_id, d.ledger_id, d.vendor_name, j.tr_no, j.jv_date, sum(j.cr_amt) as invoice_amt, j.tr_id FROM journal j, vendor d WHERE j.ledger_id=d.ledger_id and j.tr_from in ('Purchase') ".$account_code_con.$do_no_con."  group by j.tr_no";

		$query = mysql_query($sql);

	


		while($data=mysql_fetch_object($query))

		{
	

			if($_POST['payment_amt_'.$data->tr_no]>0)

			{
			
	

				$payment_amt=$_POST['payment_amt_'.$data->tr_no];
				$account_code=$_POST['account_code_'.$data->tr_no];
				$tr_no=$_POST['tr_no_'.$data->tr_no];



   $so_invoice = 'INSERT INTO payment_vendor (payment_no, payment_date, po_no, pr_no, vendor_id, ledger_id, cr_ledger_id, payment_amt, status, entry_at, entry_by)
  
  VALUES("'.$payment_no.'", "'.$payment_date.'", "'.$data->tr_id.'", "'.$tr_no.'", "'.$data->vendor_id.'", "'.$account_code.'", "'.$cr_ledger_id.'", "'.$payment_amt.'", "COMPLETE", "'.$entry_at.'", "'.$entry_by.'")';

mysql_query($so_invoice);


}

}


if($payment_no>0)
{
auto_insert_po_payment_secoundary($payment_no);

}

?>
<script language="javascript">
window.location.href = "po_wise_payment_update.php";
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



/*	function update_value(pi_id){

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



}*/


function sum_sum(id){
var tot_due_amt = (document.getElementById('tot_due_amt_'+id).value)*1;

document.getElementById('payment_amt_'+id).value = tot_due_amt;

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
<form action="" method="post" name="codz" id="codz">
  <? if ($data_found==0) { ?>
  <div class="container-fluid bg-form-titel">
    <div class="row">
      <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
        <div class="form-group row m-0">
          <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Booking Number</label>
          <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0">
            <input name="booking_number" id="booking_number" list="booking_numbers" value="<?=$_POST['booking_number'];?>"  autocomplete="off"  >
			  
			       <datalist id="booking_numbers">
						<? foreign_relation('paid_booking','booking_number_eng','booking_number_eng','1');?>
              </datalist>
			
             
            </input>
          </div>
		  
        </div>
		
		
		
		
      </div>
      <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
        <input type="submit" name="submit" id="submit" value="View " class="btn1 btn1-submit-input" />
      </div>
    </div>
  </div>
  <? } ?>
  <? if(isset($_POST['submit'])){ ?>
  <!--        top form start hear-->
  
  <? } ?>
  <? if(isset($_POST['submit'])){ ?>
  
  <div class="row">
  	<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 p-1">
            <p  class="text-center"><strong>Total Loan Amount: </strong> <?=find_a_field('sr_loan','sum(amount)','booking_number like "'.$_POST['booking_number'].'" ');?>
				<br />
				<strong>Alreary Assigned: </strong> <?=$amount_assigned = find_a_field('loan_assign','sum(amount_in)','booking_no like "'.$_POST['booking_number'].'" '); ?> 
			</p>
          </div>
  </div>
  
  <div class="container-fluid pt-5 p-0 " >
    <table class="table1  table-striped table-bordered table-hover table-sm">
      <thead class="thead1">
        <tr class="bgc-info">
		  <th>Agent Name </th>
		  <th>Farmer Name </th>
		  <th>Village </th>
		  <th>Token No </th>
          <th>Receipt No </th>
          <th>Date </th>
          <th>Bag Mark </th>
          <th>Total Bag </th>
          <th>SR Loan</th>
          <th>Seed  Loan</th>
          <th>Bag Loan</th>
          <th>Farmer Loan</th>

          <th>Action</th>
        </tr>
      </thead>
      <tbody class="tbody1">
        <?         
		
						 $amount_in = 0;
						 $sql = "SELECT m.*, sum(d.qty) as total_qty FROM warehouse_other_receive m, warehouse_other_receive_detail d
							  WHERE m.or_no=d.or_no and m.booking_number='".$_POST['booking_number']."'  group by d.or_no ";
						
						
						
						  $query = mysql_query($sql);
						   
						  while($data=mysql_fetch_object($query)){ $i++;
						  
						  ?>
        <? if ($data->total_qty> 0) {
		
		       $amount_in = find_a_field('loan_assign','sum(amount_in)','bag_mark like "'.$data->bag_mark.'" ');  
	
		?>
        <tr>
          <td><span class="style13" >
            <?=$data->agent_name;?>
            </span></td>
			 <td><span class="style13" >
            <?=$data->farmer_name;?>
            </span></td>
          <td><span class="style13" ><?=$data->farmer_village;?></span></td>
          <td><?php echo $data->token_number;?></td> 
          <td><strong><?=$data->receipt_number;?></strong></td>
		  <td><strong><?php echo date('d-m-Y',strtotime($data->or_date));?></strong></td>
		  <td><?php echo $data->bag_mark;?></td> 
		  
          <td><strong><?php echo $data->total_qty; /*$tot_qty += $data->total_qty;*/ ?></strong></td>
<?php /*?>          <td><strong><? echo $due_qty; ?></strong></td>
<?php */?>		  
          <td><input name="qty_<?=$data->or_no?>"  id="qty_sr_<?=$data->or_no?>" type="text"  value="<?=$amount_in?>"  />
		  		<input type="hidden" id="or_no_<?=$data->or_no?>" value="<?=$data->or_no?>"  />
				<input type="hidden" id="token_number<?=$data->or_no?>" value="<?=$data->token_number?>"  />
				<input type="hidden" id="bag_mark<?=$data->or_no?>" value="<?=$data->bag_mark?>"  />
		  </td>
		        <td><input name="qty_<?=$data->or_no?>"  id="qty_<?=$data->or_no?>" type="text"  value="<?=$qty?>" readonly /></td> 
				<td><input name="qty_<?=$data->or_no?>"  id="qty_<?=$data->or_no?>" type="text"  value="<?=$qty?>"  readonly/></td>    
				<td><input name="qty_<?=$data->or_no?>"  id="qty_<?=$data->or_no?>" type="text"  value="<?=$qty?>"  readonly/></td>
        
          <td align="center"><center id="assign_warehouse<?=$data->or_no?>">
		   <? if($amount_in>0){ ?>
		   
		   	<button onclick="getData2('select_loan_ajax.php', 'assign_warehouse<?=$data->or_no?>', document.getElementById('qty_sr_<?=$data->or_no?>').value,  document.getElementById('or_no_<?=$data->or_no?>').value+'##'+document.getElementById('booking_number').value+'##'+document.getElementById('token_number<?=$data->or_no?>').value+'##'+document.getElementById('bag_mark<?=$data->or_no?>').value+'##1');" type="button" class="btn1 btn1-bg-update" >Edit</button>
			
		   <? }else{?>
              <button onclick="getData2('select_loan_ajax.php', 'assign_warehouse<?=$data->or_no?>', document.getElementById('qty_sr_<?=$data->or_no?>').value,  document.getElementById('or_no_<?=$data->or_no?>').value+'##'+document.getElementById('booking_number').value+'##'+document.getElementById('token_number<?=$data->or_no?>').value+'##'+document.getElementById('bag_mark<?=$data->or_no?>').value+'##0');" type="button" class="btn1 btn1-bg-submit" >Add</button>
			 <? } ?>
            </center></td>
        </tr>
		
		
		
        <?  } } 
 ?>
		
		  <tr >
		           <td colspan="7"><strong>Total</strong></td>
				   <td ><strong><?=$tot_qty?></strong></td>
			       <td ><strong><?=$tot_due?></strong></td>


        </tr>
      </tbody>
    </table>
  </div>
  <!--button design start-->
  <div class="container-fluid p-0 ">
    <div class="n-form-btn-class">
      <input name="confirmit" type="submit" class="btn1 btn1-submit-input" value="SAVE & NEW" />
      </td>
    </div>
  </div>
  <? } ?>
</form>
</div>
<br />
<br />

<?

$main_content=ob_get_contents();

ob_end_clean();

include ("../../template/main_layout.php");

?>
