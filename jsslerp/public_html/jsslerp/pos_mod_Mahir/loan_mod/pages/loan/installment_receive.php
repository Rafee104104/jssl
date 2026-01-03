<?php

session_start();

ob_start();

require_once "../../../assets/template/layout.top.php";


// ::::: Edit This Section ::::: 



$title='Loan Installment Receive';			// Page Name and Page Title

do_datatable('table_head');

$page="installment_receive.php";		// PHP File Name

$table='loan_details';		// Database Table Name Mainly related to this page

$unique='id';			// Primary Key of this Database table

$shown='PBI_ID';				// For a New or Edit Data a must have data field

$loan_no = $_GET['loan_no'];
$loan_info = find_all_field('loan_master','','loan_no="'.$loan_no.'"');
$crud      =new crud($table);


if($_GET[$unique]>0)
$$unique = $_GET[$unique];

if(isset($_POST[$shown]))

{

$$unique = $_POST[$unique];

//for Insert..................................

if(isset($_POST['receive']))

{		

$proj_id= $_SESSION['proj_id'];
$_POST['entry_by']=$_SESSION['user']['id'];
$_POST['entry_at']=date('Y-m-d h:i:s');
$_POST['tr_from'] = "Installment Receive";
$_POST['loan_amt'] = $loan_info->loan_amt;
$_POST['type'] = $loan_info->type;
$_POST['total_installment'] = $loan_info->total_installment;
$mon_year = explode("-",$_POST['installment_no']);
$_POST['current_mon'] = $mon_year[1];
$_POST['current_year'] = $mon_year[2];
$_POST['installment_no'] = $mon_year[0];
$_POST['installment_no'] = "RECEIVED";
$crud->insert();
$type=1;
$msg='New Entry Successfully Inserted.';
unset($_POST);
unset($$unique);

}





//for Modify..................................



if(isset($_POST['update']))

{

$_POST['edit_by'] = $_SESSION['user']['id'];
$_POST['edit_at'] = $now=date('Y-m-d H:i:s');
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











<div class="container-fluid">
    <div class="row">
        <div class="col-sm-7">

            <div class="container n-form1">
			<table id="table_head" class="table1  table-striped table-bordered table-hover table-sm">
				<thead class="thead1">
				<tr class="bgc-info">
					<th>Loan No</th>
					<th>Employee</th>
					<th>Loan Amount</th>
					<th>Installment Amt</th>
					<th>Installment</th>
					<th>status</th>
				</tr>
				</thead>

				<tbody class="tbody1">

<?php

$res='select l.loan_no,p.PBI_NAME,l.loan_amt,l.payable_amt,l.current_mon,l.current_year,l.tr_from from loan_details l, personnel_basic_info p where l.tr_from="Installment Receive" and p.PBI_ID=l.PBI_ID and l.loan_no="'.$_GET['loan_no'].'"';

$qry=mysql_query($res);

while($rp=mysql_fetch_object($qry)){$i++; if($i%2==0)$cls=' class="alt"'; else $cls='';
$monthNum  = $rp->current_mon;
$dateObj   = DateTime::createFromFormat('!m', $monthNum);
$monthName = $dateObj->format('F');
?>
<tr>
  <td><?=$rp->loan_no;?></td>
  <td><?=$rp->PBI_NAME;?></td>
  <td><?=$rp->loan_amt;?></td>
  <td><?=$rp->payable_amt;?></td>
  <td><?=$monthName.'-'.$rp->current_year;?></td>
  <td><?=$rp->tr_from;?></td>
</tr>

<?php }?>


				
				</tbody>
			</table>
                <div id="pageNavPosition"></div>
				
				

            </div>

        </div>


        <div class="col-sm-5">
		<form class="n-form" action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check()">
			
                <h4 align="center" class="n-form-titel1"> <?=$title?></h4>

                <div class="form-group row m-0 pl-3 pr-3">
                    <label for="group_name" class="req-input col-sm-4 pl-0 pr-0 col-form-label "> Employee:</label>
                    <div class="col-sm-8 p-0">
										
										<input name="id" required type="hidden" id="id" tabindex="1" value="<?=$$unique?>" >	
                        				<select name="PBI_ID" id="PBI_ID" class="form-control">
										
										<? foreign_relation('personnel_basic_info','PBI_ID','PBI_NAME',$PBI_ID,'PBI_ID="'.$loan_info->PBI_ID.'"')?>
										</select>
										

                    </div>
                </div>
				
				<div class="form-group row m-0 pl-3 pr-3">
                    <label for="group_name" class="req-input col-sm-4 pl-0 pr-0 col-form-label "> Loan No.:</label>
                    <div class="col-sm-8 p-0">
										
											
                        				<input type="text" name="loan_no" id="loan_no" value="<?=$loan_info->loan_no?>" readonly="readonly" class="form-control">
										
										

                    </div>
                </div>
				
				<div class="form-group row m-0 pl-3 pr-3">
                    <label for="group_name" class="req-input col-sm-4 pl-0 pr-0 col-form-label "> Installment No.:</label>
                    <div class="col-sm-8 p-0">
										
											
                        				<select name="installment_no" id="installment_no" class="form-control">
										<option></option>
										<? foreign_relation('loan_details','concat(id,"-",current_mon,"-",current_year)','concat(current_mon,"-",current_year)',$installment_no,'loan_no='.$loan_no)?>
										</select>
										

                    </div>
                </div>
				
				<div class="form-group row m-0 pl-3 pr-3">
                    <label for="group_name" class="req-input col-sm-4 pl-0 pr-0 col-form-label "> Instl. Amount:</label>
                     <div class="col-sm-8 p-0"><input type="text" name="installment_amt" id="installment_amt" class="form-control">
					</div>
                </div>
				
				<div class="form-group row m-0 pl-3 pr-3">
                    <label for="group_name" class="req-input col-sm-4 pl-0 pr-0 col-form-label "> Receive Amount:</label>
                     <div class="col-sm-8 p-0"><input type="text" name="payable_amt" id="payable_amt" class="form-control">
					</div>
                </div>
				
				
                <div class="n-form-btn-class">
			
                     
                      <input name="receive" type="submit" id="receive" value="Receive" class="btn1 btn1-bg-submit" />
                      
                      <input name="reset" type="button" class="btn1 btn1-bg-cancel" id="reset" value="RESET" onclick="parent.location='<?=$page?>'" />
                 
                </div>


            </form>

        </div>

    </div>




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

$main_content=ob_get_contents();

ob_end_clean();

include ("../../template/main_layout.php");

?>