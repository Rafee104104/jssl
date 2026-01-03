<?php
// ------------------------------------------------------------ 

header('Content-Type: text/html; charset=UTF-8');

mb_internal_encoding('UTF-8'); 
mb_http_output('UTF-8'); 
mb_http_input('UTF-8'); 
mb_regex_encoding('UTF-8'); 

// ------------------------------------------------------------ 
?>
<?php
session_start();
ob_start();

require_once "../../../assets/template/layout.top.php";
// ::::: Edit This Section ::::: 

$title='Booking Information ';			// Page Name and Page Title
do_datatable('paid_booking');
$page="paid_booking_entry.php";		// PHP File Name

$table='paid_booking';		// Database Table Name Mainly related to this page
$unique='booking_id';			// Primary Key of this Database table
$shown='booking_id';				// For a New or Edit Data a must have data field
// ::::: End Edit Section :::::
$tr_type="show";
//if(isset($_GET['proj_code'])) $proj_code=$_GET[$proj_code];


$crud =new crud($table);
$$unique = $_GET[$unique];

if(isset($_POST['insert']))
{	
//if ($_POST['dealer_found']==0) {}
$proj_id= $_SESSION['proj_id'];
$_POST['booking_year']=2026;
$_POST['entry_by']=$_SESSION['user']['id'];
$_POST['entry_at']=date('Y-m-d h:i:s');

$crud->insert();

//////////////////////////////////////////

$master_id = mysql_insert_id();

$now =  date('Y-m-d H:i:s');
$booking_type = $_POST['booking_type'];
$amount = $_POST['total_amount'];


if($_POST['booking_type'] !=''){  
  $reference_id = $master_id;
  
  //////////////////////
  
  
  $user_id = $_SESSION['user']['id'];
  $jv_date = $_POST['booking_date'];
 
   if($booking_type=='Paid Booking'){
      $tr_from='Paid Booking';
      
	  $dr_ledger = $_POST['cash_ledger']; 
	  $cr_ledger = find_a_field('dealer_info','account_code','dealer_code_eng="'.$_POST['agent_id'].'" '); 
	  /*$dr_ledger = find_a_field('config_group_class','mon_discount','group_for='.$_SESSION['user']['group']);
	  $cr_ledger = find_a_field('dealer_info','account_code','dealer_code='.$dealer_code);*/
   }else{
      $tr_from=$booking_type;
      $dr_ledger = find_a_field('dealer_info','account_code','dealer_code_eng="'.$_POST['agent_id'].'" ');
	  $cr_ledger = '22300010001'; 
   }
  
  
  $jv_no =  next_journal_sec_voucher_id($tr_from,'Journal');

  $tr_no = $master_id;
  $checked='NO';
  $dnarr='Booking No: '.$_POST['booking_number_eng']."  Rate: ".$_POST['booking_rate']." Bag Qty: ".$_POST['bag_quantity'];
  
  //DR
	add_to_sec_journal($proj_id, $jv_no, $jv_date, $dr_ledger, $dnarr, $amount, '0', $tr_from, $tr_no,'','',$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_from_ac,$checked,$type,$employee,$remarks,$reference_id);
	
	//CR
	add_to_sec_journal($proj_id, $jv_no, $jv_date, $cr_ledger, $dnarr, '0', $amount, $tr_from, $tr_no,'','',$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_to_ac,$checked,$type,$employee,$remarks,$reference_id);
	
}
///////////////////////////////////////////


$type=1;
$msg='New Entry Successfully Inserted.';
unset($_POST);
unset($$unique);
}




if(isset($_POST[$shown]))
{
$$unique = $_POST[$unique];
//for Insert..................................



//for Modify..................................
if(isset($_POST['update']))
{ echo 'ok';
		$crud->update($unique);
		$type=1;
		$msg='Successfully Updated.';
		$tr_type="Add";
		
			//////////////////////////////////////////

$master_id = $$unique;

$now =  date('Y-m-d H:i:s');
$booking_type = $_POST['booking_type'];
$amount = $_POST['total_amount'];


if($_POST['booking_type'] !=''){  
  $reference_id = $master_id;
  
  //////////////////////
  $delQl = 'DELETE FROM `secondary_journal` WHERE tr_from like "Paid Booking" and tr_no='.$master_id;
  mysql_query($delQl);
  
  $delQl = 'DELETE FROM `journal` WHERE tr_from like "Paid Booking" and tr_no='.$master_id;
  mysql_query($delQl);
  
  $user_id = $_SESSION['user']['id'];
  $jv_date = $_POST['booking_date'];
 
   if($booking_type=='Paid Booking'){
      $tr_from='Paid Booking';
      
	  $dr_ledger = $_POST['cash_ledger']; 
	  $cr_ledger = find_a_field('dealer_info','advance_acc_code','dealer_code_eng="'.$_POST['agent_id'].'" '); 
	  /*$dr_ledger = find_a_field('config_group_class','mon_discount','group_for='.$_SESSION['user']['group']);
	  $cr_ledger = find_a_field('dealer_info','account_code','dealer_code='.$dealer_code);*/
   }else{
      $tr_from=$booking_type;
      $dr_ledger = find_a_field('dealer_info','account_code','dealer_code_eng="'.$_POST['agent_id'].'" ');
	  $cr_ledger = '22300010001'; 
   }
  
  
  $jv_no =  next_journal_sec_voucher_id($tr_from,'Journal');

  $tr_no = $master_id;
  $checked='NO';
 
  
  //DR
	add_to_sec_journal($proj_id, $jv_no, $jv_date, $dr_ledger, $dnarr, $amount, '0', $tr_from, $tr_no,'','',$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_from_ac,$checked,$type,$employee,$remarks,$reference_id);
	
	//CR
	add_to_sec_journal($proj_id, $jv_no, $jv_date, $cr_ledger, $dnarr, '0', $amount, $tr_from, $tr_no,'','',$cc_code,'',$user_id,'',$r_from, $bank,$c_no,$cheq_date,$issue_to_ac,$checked,$type,$employee,$remarks,$reference_id);
	
}
///////////////////////////////////////////
}
//for Delete..................................
if(isset($_POST['delete']))
{		
	$condition=$unique."=".$$unique;
	$crud->delete($condition);
	unset($$unique);
	$type=1;
	$msg='Successfully Deleted.';
}
}

if(isset($$unique)){
$condition=$unique."=".$$unique;
$data=db_fetch_object($table,$condition);
while (list($key, $value)=each($data))
{ $$key=$value;}

}


if(!isset($$unique)) $$unique=db_last_insert_id($table,$unique);

$tr_from="Sales";
?>
<script type="text/javascript">
$(function() {
		$("#fdate").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});

});
function Do_Nav()

{
	var URL = 'pop_ledger_selecting_list.php';
	popUp(URL);
}

function DoNav(theUrl)
{
	document.location.href = '<?=$page?>?<?=$unique?>='+theUrl;
}
function popUp(URL) 
{
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=1,menubar=0,resizable=1,width=800,height=800,left = 383,top = -16');");

}

function count()
{

var rate=(document.getElementById('booking_rate').value)*1;

var qty=(document.getElementById('bag_quantity').value)*1;

document.getElementById('total_amount').value=(rate*qty).toFixed(2);

var labour_charge=(document.getElementById('labour_charge').value)*1;

$tot_rate=rate+labour_charge;

document.getElementById('bag_rate').value=$tot_rate.toFixed(2);

document.getElementById('per_kg_price').value=($tot_rate/50).toFixed(2);
//var num=((document.getElementById('qty').value)*1)*((document.getElementById('rate').value)*1);
//document.getElementById('amount').value = num.toFixed(2);	
}
</script>
</script>
<style type="text/css">
<!--
.style1 {color: #FF0000}
.style2 {
	font-weight: bold;
	color: #000000;
	font-size: 14px;
}
.style3 {color: #FFFFFF}
-->
</style>
<!--dealer info-->
<div class="form-container_large" >
  <h4 class="text-center bg-titel bold pt-2 pb-2 text-uppercase">
    <?=$title?>
  </h4>
  <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" >
    <div class="container-fluid bg-form-titel">
      <div class="row" id="agent_name_find">
 
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
          <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text">Agent No:</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
              <input name="agent_id" required="required" list="agent_ids" value="<?=$agent_id?>" id="agent_id" style="width:95%; font-size:12px;" />
                <datalist id="agent_ids">
                <? foreign_relation('dealer_info','dealer_code_eng', 'concat(dealer_code_eng,"[",dealer_name_e,"]")',$dealerAll->dealer_code,'1');?>
              </datalist>
			  
			  <input type="hidden" name="<?=$unique;?>" id="<?=$unique;?>" value="<?=$$unique;?>" />
            </div>
          </div>
        </div>
		
		   <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
    <div class="form-group row m-0">
      <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text"> Booking type:</label>
      <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
        <select name="booking_type" required="required" id="booking_type" style="width:95%; font-size:12px;" onchange="getData2('agent_name_ajax.php', 'agent_name_find', this.value,  document.getElementById('agent_id').value);" >
          <option ><?=$booking_type?></option>
          <? foreign_relation('dealer_type','dealer_type','dealer_type','booking_type='.$booking_type,'1');?>
        </select>
      </div>
    </div>
  </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
          <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text"> Booking No:</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
              <input name="booking_number_eng" type="text" id="booking_number_eng" readonly=""  value="<?=$booking_number_eng;?>" />
            </div>
          </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
          <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text"> Booking Date:</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
              <input name="booking_date" type="date" id="booking_date"   value="<?=$booking_date?>"  required="required"/>
            </div>
          </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
          <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text req-input">Agent Name:</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0"><span id="agent_name_find">
              <input name="name" required="required" id="name" style="width:95%; font-size:12px;" tabindex="9" type="text" value="<?=$name?>">
              </span> </div>
          </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
          <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text">Father/Husband Name:</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
              <input name="father_name" id="father_name" required type="text" value="<?=$father_name?>">
            </div>
          </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
          <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text">Mobile:</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
              <input name="mobile_no" required="required" id="mobile_no" style="width:95%; font-size:12px;" tabindex="9" type="text" value="<?=$mobile_no?>">
            </div>
          </div>
        </div>
        <!--<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
          <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text">NID No: </label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
              <input name="nid" required="required" id="nid" style="width:95%; font-size:12px;" tabindex="9" type="text" value="<?=$nid?>">
            </div>
          </div>
        </div>-->
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
          <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex vendor_label_text justify-content-start align-items-center pr-1 bg-form-titel-text"> District:</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
              <input  name="district" id="district" tabindex="9" type="text" value=" <?=$district?>" />
            </div>
          </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
          <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex vendor_label_text justify-content-start align-items-center pr-1 bg-form-titel-text">Thana:</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0"> <span id="dealer_zone_find">
              <input name="thana" id="thana" type="text" value="<?=$thana ?>" >
              </span> </div>
          </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
          <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex vendor_label_text justify-content-start align-items-center pr-1 bg-form-titel-text">Post:</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0"> <span id="dealer_area_find">
              <input name="post" id="post" tabindex="9" type="text" value="<?= $post?>">
              </span> </div>
          </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
          <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text req-input">Village:</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
              <input name="village" id="village" style="width:95%; font-size:12px;" tabindex="9" type="text" value="<?=$village?>">
            </div>
          </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
          <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text req-input">Rate:</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
              <input name="booking_rate" type="text" id="booking_rate" tabindex="14" onkeyup="count()" value="<?=$booking_rate?>" required="required" />
            </div>
          </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
          <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text req-input">Quantity:</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
              <input name="bag_quantity" type="text" id="bag_quantity" tabindex="14" onkeyup="count()"  value="<?=$bag_quantity?>" required="required"  />
            </div>
          </div>
        </div>
		
		<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
          <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text req-input">Total Amount:</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
              <input name="total_amount" type="text" id="total_amount" value="<?=$total_amount;?>" tabindex="14"  onchange="count()" required  />
            </div>
          </div>
        </div>
		
		<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
          <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text ">Bank/Cash:</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
              <select name="cash_ledger" id="cash_ledger" tabindex="14"    >
			  	<option></option>
				<? foreign_relation('accounts_ledger','ledger_id','ledger_name',$cash_ledger,'ledger_group_id in (1224001,1226001)');?>
			  
			  </select>
            </div>
          </div>
        </div>
		
		<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
          <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text req-input">Labour Charge:</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
              <input name="labour_charge" type="text" id="labour_charge" tabindex="14" onkeyup="count()"  value="<?=$labour_charge?>"  />
            </div>
          </div>
        </div>
		
		
		<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
          <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text req-input">Bag Rate:</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
              <input name="bag_rate" type="text" id="bag_rate" tabindex="14"   value="<?=$bag_rate?>"   />
            </div>
          </div>
        </div>
		
		
		<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
          <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text req-input">Per Kg Price:</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
              <input name="per_kg_price" type="text" id="per_kg_price" tabindex="14"   value="<?=$per_kg_price?>"   />
            </div>
          </div>
        </div>
        <?php /*?><div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
          <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-start align-items-center pr-1 bg-form-titel-text req-input">Status: </label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
              <select name="status" id="status" required="required">
                <option value="<?=$status?>">
                <?=$status?>
                </option>
                <option value="ACTIVE">ACTIVE</option>
                <option value="INACTIVE">INACTIVE</option>
              </select>
            </div>
          </div>
        </div><?php */?>
      </div>
      <hr>
      <div class="n-form-btn-class">
        <? if(!isset($_GET[$unique])){?>
        <input name="insert" type="submit" id="insert" value="SAVE &amp; NEW" class="btn1 btn1-bg-submit" />
        <? }?>
        <? if(isset($_GET[$unique])){?>
        <input name="update" type="submit" id="update" value="UPDATE" class="btn1 btn1-bg-update" />
        <? }?>
        <input name="reset" type="button" class="btn1 btn1-bg-cancel" id="reset" value="RESET" onclick="parent.location='<?=$page?>'" />
      </div>
    </div>
  </form>
  <?
		//if(isset($_POST['search'])){
		?>
  <div class="container-fluid pt-5 p-0 ">
  <table id="paid_booking" class="table1  table-striped table-bordered table-hover table-sm">
    <thead class="thead1">
      <tr class="bgc-info">
        <th>Date</th>
        <th>Agent No</th>
	   <th>Booking Type</th>
        <th>Booking No</th>
        <th>Booking Year </th>
        <th>Agent Name</th>
        <th>Father name </th>
        <th>Mobile</th>
        <th>District</th>
        <th>Thana</th>
        <th>Post</th>
        <th>Village</th>
        <th>Rate</th>
        <th>Quantity</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody class="tbody1">
      <?php
				
				$td='select * from paid_booking where 1 ';
				$report=mysql_query($td);
			    while($data=mysql_fetch_object($report)){
						?>
      <tr>
        <td><?=$data->booking_date;?></td>
        <td><?=$data->agent_id;?></td>
	    <td><?=$data->booking_type;?></td>
        <td><?=$data->booking_number_eng;?></td>
        <td><?=$data->booking_year;?></td>
        <td><?=$data->name;?></td>
        <td><?=$data->father_name;?></td>
        <td><?=$data->mobile_no;?></td>
        <td><?=$data->district;?></td>
        <td><?=$data->thana;?></td>
        <td><?=$data->post;?></td>
        <td><?=$data->village;?></td>
        <td><?=$data->booking_rate;?></td>
        <td><?=$data->bag_quantity;?></td>
        <td><button type="button" onclick="DoNav('<?=$data->booking_id?>')" class="btn1 btn1-bg-primary">Edit</button> 
		<a target="_blank" href="../dealer/paid_booking_print_view.php?booking_id=<?=$data->booking_id?>"><button type="button"  class="btn1 btn1-bg-submit">View</button></a></td>
      </tr>
   
      <?php }?>
    </tbody>
  </table>
</div>
  <? //}?>
</div>
<script type="text/javascript"><!--
    var pager = new Pager('grp', 10000);
    pager.init();
    pager.showPageNav('pager', 'pageNavPosition');
    pager.showPage(1);

//-->
	document.onkeypress=function(e){
	var e=window.event || e
	var keyunicode=e.charCode || e.keyCode
	if (keyunicode==13)

	{
		return false;
	}
}
</script>
<script>

function duplicate(){
var dealer_code_2 = ((document.getElementById('dealer_code_2').value)*1);
var customer_id = ((document.getElementById('customer_id').value)*1);
   if(dealer_code_2>0)
  {
alert('This customer code already exists.');
document.getElementById('customer_id').value='';
document.getElementById('customer_id').focus();
  } 
}

</script>
<?
//$main_content=ob_get_contents();
//ob_end_clean();
//include ("../../template/main_layout.php");
require_once "../../../assets/template/layout.bottom.php";

?>
