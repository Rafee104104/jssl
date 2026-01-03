<?php

session_start();

ob_start();

require_once "../../../assets/template/layout.top.php";

$title='PO Wise Payment Voucher';


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

{}

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
      <?php /*?>  <div class="form-group row m-0">
          <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Booking Number</label>
          <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0">
            <input name="booking_number" id="booking_number" list="booking_numbers" value="<?=$_POST['booking_number'];?>"  autocomplete="off"  >
			  
			       <datalist id="booking_numbers">
						<? foreign_relation('paid_booking','booking_number_eng','booking_number_eng','1');?>
              </datalist>
			
             
            </input>
          </div>
        </div><?php */?>
		
		
		<?  $year=date('Y');?>
		<div class="form-group row m-0">
          <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">SR Number</label>
          <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0">
            <input name="bag_mark" id="bag_mark" list="bag_marks" value="<?=$_POST['bag_mark'];?>"  autocomplete="off"  >
			  
			       <datalist id="bag_marks">
						<? foreign_relation('warehouse_other_receive','bag_mark','bag_mark',$bag_mark,'rec_year="'.$year.'"');?>
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
  <div class="container-fluid pt-5 p-0 " id="assign_warehouse">
    <table class="table1  table-striped table-bordered table-hover table-sm">
      <thead class="thead1">
        <tr class="bgc-info">
		  <th>Name </th>
		  <th>Village </th>
		  <th>Token No </th>
          <th>Receipt No </th>
          <th>Date </th>
          <th>Bag Mark </th>
          <th>Total Qty </th>
          <th>Due Qty </th>
          <th>Qty</th>
          <th>Warehouse</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="tbody1">
        <?
		$year=date('Y');
						 $sql = "SELECT m.*, sum(d.qty)  FROM warehouse_other_receive m, warehouse_other_receive_detail d
							  WHERE m.or_no=d.or_no and m.bag_mark='".$_POST['bag_mark']."' and m.rec_year=".$year." group by d.or_no ";
						
						
						
						  $query = mysql_query($sql);
						  while($data=mysql_fetch_object($query)){ $i++;
						  
						 $alreadyRcv = find_a_field('journal_item','sum(item_in)','tr_from in ("Other Receive") and sr_no='.$data->or_no);
						 $due_qty = $data->qty-$alreadyRcv;
						
						 
						  ?>
        <? if ($due_qty>0) {
		
		
	
		?>
        <tr>
          <td><span class="style13" >
            <?=$data->agent_name;?>
            </span></td>
          <td><span class="style13" ><?=$data->village;?></span></td>
          <td><?php echo $data->token_number;?></td> 
          <td><strong><?=$data->receipt_number;?></strong></td>
		  <td><strong><?php echo date('d-m-Y',strtotime($data->or_date));?></strong></td>
		  <td><?php echo $data->bag_mark;?></td> 
		  
          <td><strong><?php echo $data->total_qty;?></strong></td>
          <td><strong><? echo $due_qty;?></strong></td>
		  
          <td><input name="qty_<?=$data->or_no?>" required id="qty_<?=$data->or_no?>" type="text"  value="<?=$qty?>"  />
		  	  <input name="booking_number_<?=$data->or_no?>" id="booking_number_<?=$data->or_no?>" type="hidden" value="<?=$data->booking_number?>" />
		  </td>
		  
          <td><input name="warehouse_<?=$data->or_no?>" required list="warehouses<?=$data->or_no?>" id="warehouse_<?=$data->or_no?>" type="text"  value="<?=$data->ledger_id?>"  />
		  		
			<datalist id="warehouses<?=$data->or_no?>">
			<? foreign_relation('warehouse','warehouse_name','warehouse_name',$warehouse_id,'1')?>
			</datalist>
           
			<input name="or_no_<?=$data->or_no?>" id="or_no_<?=$data->or_no?>" type="hidden"  value="<?=$data->or_no?>"  /> 
            <input name="payment_amt_<?=$data->or_no?>" id="payment_amt_<?=$data->or_no?>" type="hidden" size="10"  value=""   />          </td>
          <td align="center"><center>
              <button id="but_<?=$data->or_no?>" onclick="getData2('select_warehouse_ajax.php', 'assign_warehouse', document.getElementById('warehouse_<?=$data->or_no?>').value,  document.getElementById('or_no_<?=$data->or_no?>').value+'##'+document.getElementById('qty_<?=$data->or_no?>').value+'##'+document.getElementById('booking_number_<?=$data->or_no?>').value+'##'+document.getElementById('bag_mark').value); hide(<?=$data->or_no?>)" type="button" class="btn1 btn1-bg-submit" >Add</button>
            </center></td>
        </tr>
        <? } }?>
      </tbody>
    </table>
  </div>
  <!--button design start-->
  <div class="container-fluid p-0 ">
    <div class="n-form-btn-class">
      <!--<input name="confirmit" type="submit" class="btn1 btn1-submit-input" value="SAVE & NEW" />-->
      </td>
    </div>
  </div>
  <? } ?>
</form>
</div>
<br />
<br />

<script>
	function hide(value){
		document.getElementById("but_"+value).style.display="none";
	}
</script>

<?

$main_content=ob_get_contents();

ob_end_clean();

include ("../../template/main_layout.php");

?>
