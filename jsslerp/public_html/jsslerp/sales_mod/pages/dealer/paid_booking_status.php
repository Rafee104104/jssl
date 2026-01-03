<?php

session_start();

ob_start();

require_once "../../../assets/template/layout.top.php";

do_calander('#fdate');

do_calander('#tdate');
// ::::: Edit This Section ::::: 

$title='Paid Booking Status';			// Page Name and Page Title

do_datatable('paid_booking');
$page="paid_booking.php";		// PHP File Name
$table='paid_booking';		// Database Table Name Mainly related to this page
$unique='booking_id';			// Primary Key of this Database table
$shown='name';	

$target_url = '../dealer/paid_booking_print_view.php';
			// For a New or Edit Data a must have data field

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

//$wh_data = find_all_field('warehouse','','warehouse_id='.$_POST['depot']); 
$crud->insert();
	$type=1;
		$msg='Successfully Updated.';

unset($_POST);

unset($$unique);


}



//for Modify..................................
if(isset($_POST['update']))
{
		$crud->update($unique);
		 $dealer_code =$_POST['dealer_code'];
		 $account_code = $_POST['account_code'];
	  $sql1 = 'update accounts_ledger set ledger_name="'.$_POST['dealer_name_e'].'" 
	  where ledger_id = '.$account_code;

		mysql_query($sql1);
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
<script language="javascript">
function custom(theUrl)
{
	window.open('<?=$target_url?>?<?=$unique?>='+theUrl);
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


</style>
<!--dealer info-->
 <form action="" method="post" name="codz" id="codz">
<div class="container-fluid bg-form-titel">
        <div class="row">
          <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5">
            <div class="form-group row m-0">
              <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">From Date:</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
                <input type="text" name="fdate" id="fdate" value="<?=($_POST['fdate']!='')?$_POST['fdate']:date('Y-m-01');?>" class="form-control"/>
              </div>
            </div>

          </div>
          <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5">
            <div class="form-group row m-0">
              <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">To Date:</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
                <input type="text" name="tdate" id="tdate"  value="<?=($_POST['tdate']!='')?$_POST['tdate']:date('Y-m-d');?>"  class="form-control"/>


              </div>
            </div>
          </div>

          <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
            <input type="submit" name="submitit" id="submitit" value="VIEW DETAIL"  class="btn1 btn1-submit-input"/>
          </div>

        </div>
      </div>
<div class="container-fluid pt-5 p-0 ">
  <table id="vendor_table" class="table1  table-striped table-bordered table-hover table-sm">
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
				
				$td='select * from paid_booking where 1 and booking_date between "'.$_POST['fdate'].'" and "'.$_POST['tdate'].'"  ';
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
        <td><button type="button" onclick="custom(<?=$data->sr_id?>)" class="btn1 btn1-bg-submit">View</button></td>
      </tr>
   
      <?php }?>
    </tbody>
  </table>
</div>
</form>
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
