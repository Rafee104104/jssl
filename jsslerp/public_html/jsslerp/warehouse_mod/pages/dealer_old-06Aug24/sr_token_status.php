<?php

session_start();

ob_start();

require_once "../../../assets/template/layout.top.php";


// ::::: Edit This Section ::::: 

$title='SR Token  Status';			// Page Name and Page Title

do_datatable('sr_token');
$page="sr_token.php";		// PHP File Name
$table='sr_token';		// Database Table Name Mainly related to this page
$unique='sr_id';			// Primary Key of this Database table
$shown='name';	


$page1="sr_token_info.php";		// PHP File Name
$shown1='sr_id';

$target_url = '../dealer/sr_token_print_view.php';
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

function Do_Nav()

{
	var URL = 'sr_token_info.php';
	popUp(URL);
}

function DoNav(theUrl)
{
	document.location.href = '<?=$page1?>?<?=$unique?>='+theUrl;
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

<div class="container-fluid pt-5 p-0 ">
  <table id="sr_token" class="table1  table-striped table-bordered table-hover table-sm">
    <thead class="thead1">
      <tr class="bgc-info">
        <th>Serial No</th>
		<th>Date</th>
		<th>Booking No</th>
        <th>Name</th>
        <th>Village</th>
        <th>Booking No</th>
        <th>Token Number </th>
        <th>Quantity </th>
	    <th>Action</th>


      </tr>
    </thead>
    <tbody class="tbody1">
      <?php
				
				$td='select * from sr_token where 1 order by date desc,serial_number desc';
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
						<td><?=$data->quantity;?></td>
					    <td><button type="button" onclick="DoNav('<?=$data->sr_id?>')" class="btn1 btn1-bg-primary">Edit</button> 
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
