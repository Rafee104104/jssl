<?php

session_start();

ob_start();

require_once "../../../assets/template/layout.top.php";

$title='L/C Number Update';


  //create_combobox('bank_ledger');
  
   $pi_reference_no 		= $_REQUEST['pi_reference'];

do_calander('#invoice_date');
do_calander('#lc_expiry_date');
do_calander('#shipment_date');
do_calander('#shipment_expiry_date');
do_calander('#cover_note_date');
do_calander('#ammendment_date');


 $data_found = $lc_no;

if ($data_found==0) {
 create_combobox('lc_no');
  }



if(prevent_multi_submit()){

if(isset($_REQUEST['confirmit']))

{		
		
		$lc_issue_date=$_POST['invoice_date'];
		$group_for=$_POST['group_for'];
		$lc_no=$_POST['pi_reference_no'];
	
		$lc_number=$_POST['lc_number'];
		$po_no=$_POST['po_no'];
		$bank_lc_no=$_POST['bank_lc_no'];
		$pi_no=$_POST['pi_no'];
$lc_expiry_date=$_POST['lc_expiry_date'];
		$tolerance=$_POST['tolerance'];
		$insurance_cover_note_no=$_POST['insurance_cover_note_no'];
		$shipment_date=$_POST['shipment_date'];
		$shipment_expiry_date=$_POST['shipment_expiry_date'];
		$lc_af_no=$_POST['lc_af_no'];
		$shipment_expiry_date=$_POST['shipment_expiry_date'];
		$bank_name=$_POST['bank_name'];
		$mode_of_transport=$_POST['mode_of_transport'];
		$cover_note_date=$_POST['cover_note_date'];
		$ammendment_date=$_POST['ammendment_date'];
		$lc_type=$_POST['lc_type'];
		$bank_ledger=$_POST['bank_ledger'];
		$lc_ledger=$_POST['lc_ledger'];
		$_POST['ledger_name'] = 'Goods in Transit - L/C No. '.$bank_lc_no;
		$under_ledger=find_a_field('lc_type','lc_accounts_ledger','id="'.$lc_type.'"');
		
		$lc_value=$_POST['lc_value'];
		$ud_amount=$_POST['ud_amount'];

		$remarks=$_POST['remarks'];
		
		$tr_unique=55;
		
		$tr_no = next_transection_no($tr_unique,$lc_issue_date,'lc_bank_entry','tr_no');


		$entry_by= $_SESSION['user']['id'];
		$entry_at = date('Y-m-d H:i:s');
		
	//////////////////Accounts Ledger Create////////////////
$cy_id  = find_a_field('accounts_ledger','max(ledger_sl)','ledger_group_id='.$_POST['ledger_group_id'])+1;
$_POST['ledger_sl'] = sprintf("%04d", $cy_id);
$_POST['ledger_id'] = $_POST['ledger_group_id'].''.$_POST['ledger_sl'];
$gl_group = find_all_field('ledger_group','','group_id='.$_POST['ledger_group_id']); 
$ledger_gl_found = find_a_field('accounts_ledger','ledger_id','ledger_name='.$_POST['ledger_name']);

if ($ledger_gl_found==0) {
    $acc_ins_led = 'INSERT INTO accounts_ledger (ledger_id, ledger_sl, ledger_name, ledger_group_id,  balance_type,  proj_id,  acc_class, acc_sub_class, acc_sub_sub_class, group_for, entry_by, entry_at)
  
  VALUES("'.$_POST['ledger_id'].'", "'.$_POST['ledger_sl'].'", "'.$_POST['ledger_name'].'", "'.$_POST['ledger_group_id'].'", "Both", "'.$proj_id.'",  "'.$gl_group->acc_class.'", 
  "'.$gl_group->acc_sub_class.'", "'.$gl_group->acc_sub_sub_class.'", "'.$gl_group->group_for.'", "'.$_POST['entry_by'].'", "'.$_POST['entry_at'].'")';

mysql_query($acc_ins_led);
}

/////////////Accounts Ledger Create End/////////////




		
    $lc_num_ins = 'INSERT INTO lc_number_setup (id,lc_number, ledger_group_id, ledger_id, pi_reference, po_no,bank_ledger, group_for, lc_type, status, entry_at, entry_by)
  
  VALUES("'.$pi_reference_no .'","'.$_POST['ledger_name'].'", "'.$_POST['ledger_group_id'].'", "'.$_POST['ledger_id'].'", "'.$pi_reference.'", "'.$po_no.'", "'.$bank_ledger.'","'.$group_for.'", "'.$lc_type.'", "CHECKED", "'.$entry_at.'", "'.$entry_by.'")';

mysql_query($lc_num_ins);

		  $ins_invoice = 'INSERT INTO lc_bank_entry (tr_no, lc_issue_date, lc_no, lc_number, po_no, bank_ledger, group_for, bank_lc_no, pi_no,  lc_type, lc_value, ud_amount, 
		remarks, status, entry_at, entry_by,lc_expiry_date,tolerance,insurance_cover_note_no,shipment_date,shipment_expiry_date,lc_af_no,bank_name,mode_of_transport,cover_note_date,ammendment_date,pi_reference_no)
  
  VALUES("'.$tr_no.'", "'.$lc_issue_date.'", "'.$lc_no.'", "'.$_POST['ledger_name'] .'", "'.$po_no.'","'.$bank_ledger.'", "'.$group_for.'", "'.$bank_lc_no.'", "'.$pi_no.'",  "'.$lc_type.'", "'.$lc_value.'", "'.$ud_amount.'", 
  "'.$remarks.'", "CHECKED", "'.$entry_at.'", "'.$entry_by.'",  "'.$lc_expiry_date.'", "'.$tolerance.'", "'.$insurance_cover_note_no.'", "'.$shipment_date.'", "'.$shipment_expiry_date.'", "'.$lc_af_no.'", "'.$bank_name.'", "'.$mode_of_transport.'", "'.$cover_note_date.'", "'.$ammendment_date.'","'.$_POST['pi_reference_no'].'")';
  
 

mysql_query($ins_invoice);



//$up_sql1 = "update lc_number_setup set lc_type='".$lc_type."' where id='".$lc_no."'";
//mysql_query($up_sql1);
//
//$up_sql2 = "update accounts_ledger set under_ledger='".$under_ledger."' where ledger_id='".$lc_ledger."'";
//mysql_query($up_sql2);
//
//$up_sql3 = "update lc_purchase_master set lc_type='".$lc_type."' where lc_no='".$lc_no."'";
//mysql_query($up_sql3);
		


//if($payment_no>0)
//{
//auto_insert_po_payment_secoundary($payment_no)
//}

?>

<script language="javascript">
window.location.href = "pending_pi_for_lc.php";
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

document.getElementById('payment_amt_'+id).value = tot_due_amt;

}




function lc_value_cal()
{

var pi_value=(document.getElementById('pi_value').value)*1;

var lc_value=(document.getElementById('lc_value').value)*1;

document.getElementById('ud_amount').value=(pi_value-lc_value);


//var num=((document.getElementById('qty').value)*1)*((document.getElementById('rate').value)*1);
//document.getElementById('amount').value = num.toFixed(2);	
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


table thead  {
  / Important /
  background-color: red;
  position: sticky;
  z-index: 100;
  top: 0;
}


</style>



<div class="form-container_large">

<form action="" method="post" name="codz" id="codz">


<? if($pi_reference_no>0){ ?>


<div class="box" style="width:100%;">

								<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:12px; text-transform:uppercase;">

								  <tr>

								 <td width="18%">LC ISSUE DATE:</td>

									<td width="18%">
									
									<?php /*?><?=($invoice_date!='')?$invoice_date:date('Y-m-d')?><?php */?>
									
			<input style="width:220px; height:32px;"  name="invoice_date" type="text" id="invoice_date"  value="<?=$_POST['invoice_date']?>"   required />									</td>
									<td width="16%">PI Reference  NO:</td>
									<td width="17%">
									
									<? $pi_data = find_all_field('lc_pi_reference_setup','','id='.$pi_reference_no); 
								
									$pi_no=find_a_field('lc_purchase_master','pi_no','pi_reference='.$pi_data->id); 
									
									$po_no=find_a_field('lc_purchase_master','po_no','pi_reference='.$pi_data->id); 
									
									$pi_value=find_a_field('lc_purchase_invoice','sum(amount_usd)','po_no='.$po_no); 
	
									?>
									
					<input name="po_no" type="hidden" id="po_no"  readonly="" style="width:220px; height:32px;" value="<?=$po_no;?>"  required tabindex="105" />
									
					<input name="group_for" type="hidden" id="group_for"  readonly="" style="width:220px; height:32px;" value="<?=$pi_data->group_for;?>"  required tabindex="105" />
									
					<input name="pi_reference_no" type="hidden" id="pi_reference_no"  readonly="" style="width:220px; height:32px;" value="<?=$pi_data->id;?>"  required tabindex="105" />
															
			<input name="lc_number" type="text" id="lc_number"  readonly="" style="width:220px; height:32px;" value="<?=$pi_data->pi_number;?>"  required tabindex="105" />	
				<!--<input name="lc_ledger" type="hidden" id="lc_ledger"  readonly="" style="width:220px; height:32px;" value="<?=$lc_data->ledger_id;?>"  required tabindex="105" />-->									</td>
									<td width="13%">L/C Type:</td>
									<td width="18%">
									
									<table>
		  	<tr>
				<td>
				 
				
				<select name="lc_type" required id="lc_type" style="width:220px;"  tabindex="4">
										
				<option></option>

					 <? foreign_relation('lc_type','id','lc_type',$lc_type,'1');?>
				</select>
					</td>
			</tr>
		  </table>									</td>
								  </tr>
								  
								
								  <tr>

								 <td>Bank L/C NO:</td>

									<td>

									<input name="bank_lc_no" type="text" id="bank_lc_no"   style="width:220px; height:32px;" value=""  required tabindex="105" />									</td>
									<td>PI NO:</td>
									<td>
							
									<input name="pi_no" type="text" id="pi_no"   style="width:220px; height:32px;" value="<?=$pi_no;?>" readonly=""  required tabindex="105" />									</td>
									<td>l/C Bank Ledger: </td>
									<td>
									
										
									
									
									<select name="bank_ledger" id="bank_ledger" required="required" style="width:220px;">
									  <option></option>
									  <? foreign_relation('accounts_ledger','ledger_id','ledger_name',$lc_data->bank_ledger,'ledger_group_id in (126002)');?>
									</select>
									
									
									</td>
								  </tr>
								  
								  
								  
								  
								  <tr>

								 <td>PI value (usd$):</td>

									<td><input name="pi_value" type="text" id="pi_value"  style="width:220px; height:32px;" value="<?=$pi_value;?>"  readonly="" onkeyup="lc_value_cal()" required  /></td>
									<td>l/c value (usd$):</td>
									<td>
							
									<input name="lc_value" type="text" id="lc_value"  style="width:220px; height:32px;" value=""  required onkeyup="lc_value_cal()"   />									</td>
									<td>UD Amount (usd$):</td>
									<td>
									
									<input name="ud_amount" type="text" id="ud_amount"  style="width:220px; height:32px;" value=""  readonly="" required tabindex="105" />									</td>
								  </tr>
								  
								  <tr>
								    <td>LC EXPIRY DATE:</td>
								    <td><input name="lc_expiry_date" type="text" id="lc_expiry_date"   style="width:220px; height:32px;" value=""  required tabindex="105" /></td>
								    <td>lc af no:</td>
								    <td><input name="lc_af_no" type="text" id="lc_af_no"  style="width:220px; height:32px;" value=""  required tabindex="105" /></td>
								    <td>mode of transport: </td>
								    <td>
									<select name="mode_of_transport" id="mode_of_transport" required="required" style="width:220px;">
									<option></option>
									  
									  <? foreign_relation('mode_of_transport','id','mode_of_transport',$_POST['mode_of_transport'],'1');?>
									</select>
									</td>
							      </tr>
								  <tr>
								    <td>tolerance:</td>
								    <td><input name="tolerance" type="text" id="tolerance"   style="width:220px; height:32px;" value=""  required tabindex="105" /></td>
								    <td>bank name:</td>
								    <td><input name="bank_name" type="text" id="bank_name"  style="width:220px; height:32px;" value=""  required tabindex="105" /></td>
								    <td>ammendment date: </td>
								    <td><input name="ammendment_date" type="text" id="ammendment_date"  style="width:220px; height:32px;" value=""   tabindex="105" /></td>
							      </tr>
								  <tr>
								    <td>insurance cover note no: </td>
								    <td><input name="insurance_cover_note_no" type="text" id="insurance_cover_note_no"   style="width:220px; height:32px;" value=""  required tabindex="105" /></td>
								    <td>cover note date: </td>
								    <td><input name="cover_note_date" type="text" id="cover_note_date"  style="width:220px; height:32px;" value=""  required tabindex="105" /></td>
								    <td>REMARKS:</td>
								    <td><input name="remarks" type="text" id="remarks"  style="width:220px; height:32px;" value=""   tabindex="105" /></td>
							      </tr>
								  <tr>

								 
									<td>shipment date:</td>
									<td>
							
									<input name="shipment_date" type="text" id="shipment_date"  style="width:220px; height:32px;" value=""  required tabindex="105" />									</td>
									<td>shipment expiry date:</td>
									<td>
							
									<input name="shipment_expiry_date" type="text" id="shipment_expiry_date"  style="width:220px; height:32px;" value=""  required tabindex="105" />									</td> 
									 <td>GL Configuration:</td>

									<td>
<select name="ledger_group_id" required id="ledger_group_id" style="width:200px;"  tabindex="3">
										
										<option></option>

										  <? foreign_relation('ledger_group','group_id','group_name',$ledger_group_id,'acc_sub_sub_class=124 order by group_id');?>
										</select>
									 								</td>
								  </tr>
								</table>

    </div>
	
	<? }?>



<? if($pi_reference_no>0){ ?>


<br /> <br />

<table width="100%" border="0">






<tr>

<td align="center">&nbsp;

</td>

<td align="center">
<!--<input  name="do_no" type="hidden" id="do_no" value="<?=$_POST['do_no'];?>"/>-->
<input name="confirmit" type="submit" class="btn1" value="SAVE & NEW" style="width:220px; font-weight:bold; float:right; background:#6699FF; font-size:12px; height:30px; color: #000000;" /></td>

</tr>



</table>




<? }?>








<p>&nbsp;</p>

</form>

</div>



<?

$main_content=ob_get_contents();

ob_end_clean();

include ("../../template/main_layout.php");

?>