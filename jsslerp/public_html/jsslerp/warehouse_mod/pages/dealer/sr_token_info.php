<?php

session_start();

ob_start();

require_once "../../../assets/template/layout.top.php";

// ::::: Edit This Section ::::: 

$title='SR Token';			// Page Name and Page Title

do_datatable('sr_token');
$page="sr_token_info.php";		// PHP File Name
$table='sr_token';		// Database Table Name Mainly related to this page
$unique='sr_id';			// Primary Key of this Database table
$shown='sr_id';				// For a New or Edit Data a must have data field

// ::::: End Edit Section :::::



//if(isset($_GET['proj_code'])) $proj_code=$_GET[$proj_code];


$crud      =new crud($table);
$$unique = $_GET[$unique];
if(isset($_POST[$shown]))

{

$$unique = $_POST[$unique];

//for Insert..................................

if(isset($_POST['insert']))

{	

//if ($_POST['dealer_found']==0) {}

$proj_id			= $_SESSION['proj_id'];

$_POST['entry_by']=$_SESSION['user']['id'];

$_POST['entry_at']=date('Y-m-d h:i:s');
$_POST['token_year']=date('Y');
$_SESSION['date'] = $_POST['date'];
//$wh_data = find_all_field('warehouse','','warehouse_id='.$_POST['depot']); 
$crud->insert();
$token_nos = $_POST['serial_number'];
$type=1;
$msg='Successfully Updated.';

unset($_POST);

unset($$unique);


}



//for Modify..................................
if(isset($_POST['update']))
{
		$crud->update($unique);
		$type=1;
		$msg='Successfully Updated.';
}

//for Delete..................................
if(isset($_POST['delete']))
{		$condition=$unique."=".$$unique;		$crud->delete($condition);

		unset($$unique);
		$type=1;
		$msg='Successfully Deleted.';
}
}

if(isset($$unique))

{
$condition=$unique."=".$$unique;
$data=db_fetch_object($table,$condition);

while (list($key, $value)=each($data))

{ $$key=$value;}

}

if(!isset($$unique)) $$unique=db_last_insert_id($table,$unique);

?>


<!--<script>
  window.onload = function() {
    document.getElementById('date').focus();
  };
</script>-->


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
	var URL = 'sr_token_info.php';
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



</script>


<style type="text/css">

.style1 {color: #FF0000}

.style2 {
	font-weight: bold;
	color: #000000;
	font-size: 14px;
}

.style3 {color: #FFFFFF}

label{

font-weight:bold !important;

}

#insert:focus {
  background-color: #ffcc00; /* Change to any color you like */
  color: #000; /* Optional: change text color */
  outline: none; /* Optional: remove default focus outline */
}

#recive:focus {
  background-color: #ffcc00; /* Change to any color you like */
  color: #000; /* Optional: change text color */
  outline: none; /* Optional: remove default focus outline */
}

</style>
<!--dealer info-->
<div class="form-container_large">
<p class="text-center bg-titel  pt-2 pb-2" style="color:#6666FF; font-weight:bold; font-size:20px !important;">
  <?=$title?>
</p>

<meta charset="UTF-8">
<form action="" method="post" enctype="multipart/form-data" accept-charset="UTF-8" name="form1" id="form1" onsubmit="return check()">
  <div class="container-fluid bg-form-titel">
    <div class="row" id="agent_info">
	
	
	
	  
	  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Date:</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
       <input name="date" type="date"  id="date"  required="required"  value="<? if($date !='') echo $date; else echo $_SESSION['date'];?>"/>
			
          </div>
        </div>
      </div>
      
	  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Agent ID:</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
		  
		<input   name="sr_id" type="hidden"  class="form-control" id="sr_id" value="<? if($$unique>0) echo $$unique;?>" readonly/>
		
		  
       <input name="dealer_code_eng"     value="<?=$dealer_code_eng?>" list="agent_ids" id="dealer_code_eng" style="width:95%; font-size:12px;" onblur="getData2('agent_name_ajax.php', 'agent_info', this.value,  document.getElementById('dealer_code_eng').value);" />
                <datalist id="agent_ids" >
				
                <? foreign_relation('dealer_info','dealer_code_eng', 'concat(dealer_code_eng,"[",dealer_name_e,"]")',$dealerAll->dealer_code,'1');?>
              </datalist>
			
          </div>
        </div>
      </div>
	  
	  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Token No(eng):</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="serial_number" type="text" style="color:#6666FF; font-weight:bold; font-size:20px !important;" id="serial_number" tabindex="2" value="<?=$serial_number?>" />

          </div>
        </div>
      </div>
        
	  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
          <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Booking No:</label>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
              <input name="booking_number" type="text" style="color:#6666FF; font-weight:bold; font-size:20px !important;" required="required" id="booking_number" tabindex="3" value="<?=$booking_number?>" />
            </div>
          </div>
        </div>
      <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Agent Name (Bengali):</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="agent_name" type="text" id="agent_name" readonly="readonly" value="<?=$agent_name?>" tabindex="4" />
          </div>
        </div>
      </div>
	  
	        
      <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Agent Village (Bengali):</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="area" type="text" id="area" readonly="readonly" value="<?=$area?>" tabindex="5" />
          </div>
        </div>
      </div>
	  
	   <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Quantity:(eng)</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="quantity" type="text" required="required" id="quantity"  value="<?=$quantity?>" tabindex="6" />
          </div>
        </div>
      </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Farmer Name (Bengali):</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="farmer_name" type="text" id="farmer_name"  value="<?=$farmer_name?>" tabindex="7" />
          </div>
        </div>
      </div>
	  
	        
      <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 pt-1 pb-1">
        <div class="form-group row m-0">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 vendor_label_text d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Farmer Village (Bengali):</label>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
            <input name="village" type="text" id="village" tabindex="8" value="<?=$village?>" />
          </div>
        </div>
      </div>
      
    </div>
	
  </div>
  <hr>
  <div class="n-form-btn-class">
    <? if($token_nos>0){ ?>
	<!--  <a href="../other_receive/or_receive.php?token_no=<?=$token_nos?>&token_year=<?=date('Y');?>"  ><input type="submit" tabindex="8" class="btn1 btn1-bg-submit"  value="Store Receive" /></a>-->
	<button type="button" id="recive"
        class="btn1 btn1-bg-submit" 
        tabindex="1"
        onclick="window.location.href='../other_receive/or_receive.php?token_no=<?= $token_nos ?>&token_year=<?= date('Y') ?>'">
   Store Receive
</button>

	<? }else{ ?>
		
    <? if(!isset($_GET[$unique])){?>
    <input name="insert" type="submit" id="insert" value="SAVE &amp; NEW" class="btn1 btn1-bg-submit" tabindex="9"/>
    <? }?>
   <?php /*?> <? if(isset($_GET[$unique])){?>
    <input name="update" type="submit" id="update" value="UPDATE" class="btn1 btn1-bg-update" />
    <? }?><?php */?>
	<? if(isset($_GET[$unique])){?>
    <input name="delete" type="submit" id="delete" value="DELETE" class="btn1 btn1-bg-update" />
    <? } } ?>
    <input name="reset" type="button" class="btn1 btn1-bg-cancel" id="reset" value="RESET" onclick="parent.location='<?=$page?>'" />
  </div>
</form>
  </div>

<?







		//if(isset($_POST['search'])){







		?>
<div class="container-fluid pt-5 p-0 ">
  <table id="" class="table1  table-striped table-bordered table-hover table-sm">
    <thead class="thead1">
      <tr class="bgc-info">
        <th>Serial No</th>
		<th>Date</th>
		<th>Booking No</th>
        <th>Name</th>
        <th>Village</th>
        <th>Booking No</th>
        <th>Token Number </th>
        <th style="background:#FF9933">Sr No </th>
        <th>Year</th>
        <th>Quantity </th>
	    <th>Action</th>
      </tr>
    </thead>
    <tbody class="tbody1">
      <?php
				
				$td='select * from sr_token where 1 and token_year=2025 order by sr_id desc limit 50  ';
				$report=mysql_query($td);
			    while($data=mysql_fetch_object($report)){
						?>
					<tr>
						<td><?=$data->sr_id;?></td>
						<td><?=$data->date;?></td>
						<td><?=$data->booking_number;?></td>
						<td><?=$data->farmer_name;?></td>
						<td><?=$data->village;?></td>
						<td><?=$data->booking_number;?></td>
						<td><?=$data->serial_number;?></td>
						<td style="background:#FF9933"><?=$data->sr_number;?></td>
						<td><?=$data->token_year;?></td>
						<td><?=$data->quantity;?></td>
					    <td><!--<button type="button" onclick="DoNav('<?=$data->sr_id?>')" class="btn1 btn1-bg-primary">Edit</button>--> 
		<a target="_blank" href="../dealer/sr_token_print_view.php?sr_id=<?=$data->sr_id?>"><button type="button"  class="btn1 btn1-bg-submit">View</button></a></td>
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

<?php /*?>function duplicate(){

var dealer_code_2 = ((document.getElementById('dealer_code_2').value)*1);

var customer_id = ((document.getElementById('customer_id').value)*1);

   if(dealer_code_2>0)

  {

alert('This customer code already exists.');
document.getElementById('customer_id').value='';
document.getElementById('customer_id').focus();
  } 
}<?php */?>

</script>
<?

$main_content=ob_get_contents();


ob_end_clean();


include ("../../template/main_layout.php");


?>
