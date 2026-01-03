<?php
require_once "../../../assets/template/layout.top.php";// ::::: Edit This Section ::::: 
if(isset($_POST['button'])){

$pbi = find_a_field('personnel_basic_info','PBI_ID','PBI_CODE="'.$_POST['employee_selected'].'"');
$_SESSION['employee_selected'] = $pbi;

}



$title='Loan Payments';			// Page Name and Page Title



$page="advance_payment.php";		// PHP File Name



$input_page="advance_payment.php";



$root='payroll';


$table_master='loan_master';		// Database Table Name Mainly related to this page
$table_details = 'loan_details';


$unique='loan_no';			// Primary Key of this Database table



$shown='loan_amt';				// For a New or Edit Data a must have data field


do_datatable('grp');
// ::::: End Edit Section :::::



// ::::: End Edit Section :::::

$crud      =new crud($table_master);


$$unique = $_GET[$unique];



if(isset($_POST[$shown]))



{

$$unique = $_POST[$unique];


if(isset($_POST['add_loan']))



{		



$now				= time();


//$_POST['PBI_ID']=$_SESSION['employee_selected'];


$_POST['loan_amt'] = $_POST['loan_amt'];
$_POST['loan_date'] = date('Y-m-d');
$_POST['status'] = 'ISSUED';
$_POST['entry_at'] = date('Y-m-d H:i:s');
$_POST['entry_by'] = $_SESSION['user']['id'];
$loan_no=$crud->insert();

$crud      =new crud($table_details);
$_POST['loan_no'] = $loan_no;
for($i=0;$i<$_POST['total_installment'];$i++)



{


$smon=$_POST['start_mon'] + $i;



$syear=$_POST['start_year'];



$_POST['current_mon'] = date('m',mktime(1,1,1,$smon,1,$syear));



$_POST['current_year'] = date('Y',mktime(1,1,1,$smon,1,$syear));



$_POST['installment_no'] = $i+1;



$crud->insert();



}


$type=1;



$_SESSION['msg']='<span style="color:green;font-weight:bold;">New Loan Issued..</span>';


unset($_POST);



unset($$unique);

header('location:loan_status.php');

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



while (list($key, $value)=@each($data))



{ $$key=$value;}



}



if(!isset($$unique)) $$unique=db_last_insert_id($table,$unique);


$$unique = $_GET[$unique];


?>



<script type="text/javascript"> function DoNav(lk){



	document.location.href = '<?=$page?>?<?=$unique?>='+lk;



	}

	


function install_amnt_auto_cal(){



var tot_amnt=document.getElementById('loan_amt').value;



var tot_istl=document.getElementById('total_installment').value;



var istl_amnt=tot_amnt/tot_istl;



document.getElementById('payable_amt').value = istl_amnt;


}



</script>

<div class="oe_view_manager oe_view_manager_current">



      <form action="" method="post" enctype="multipart/form-data">  



     <? //include('../../common/title_bar.php');?>



    </form>



    <form action="" method="post" enctype="multipart/form-data">



        <div class="oe_view_manager_body">



            



                <div  class="oe_view_manager_view_list"></div>



            



                <div class="oe_view_manager_view_form"><div style="opacity: 1;" class="oe_formview oe_view oe_form_editable">



        <div class="oe_form_buttons"></div>



        <div class="oe_form_sidebar"></div>



        <div class="oe_form_pager"></div>



        <div class="oe_form_container"><div class="oe_form">



          <div class="">



    <? //include('../../common/input_bar.php');?>

	

	<div class="card">
		<h4 class="text-center bg-titel bold pt-2 pb-2">Loan Payment</h4>


				  <div class="card-body">

					

					<div class="row"> 
					
					<div class="col-md-3 form-group">

	

						<label for="PBI_REF2">Employee :</label>			

	

						<select name="PBI_ID" id="PBI_ID" class="form-control">
						 <option></option>
						 <? foreign_relation('personnel_basic_info','PBI_ID','PBI_NAME',$PBI_ID,'1')?>
						</select>

	

					</div>

					<div class="col-md-3 form-group">

						<label for="PBI_REF1">Loan Amount :</label>			

						<input name="loan_amt" type="text" id="loan_amt" value="<?=$loan_amt?>" required class="form-control" />

						<input type="hidden" name="<?=$unique?>" id="<?=$unique?>" value="<?=$$unique?>" />


                    <label for="textfield"></label>


                   

	

					</div>

					

					

					<div class="col-md-3 form-group">

	

						<label for="PBI_REF2">Total Install :</label>			

	

						<input name="total_installment" type="text" id="total_installment" onkeyup="install_amnt_auto_cal()" value="<?=$total_installment?>" class="form-control" />

	

					</div>	
					
					

	

					<div class="col-md-3 form-group">

	

						<label for="PBI_REF3">Start Month :</label>			

	

						<select name="start_mon"  id="start_mon" required class="form-control">

						

								<option value="1" <?=($start_mon=='1')?'selected':''?>>Jan</option>

						

								<option value="2" <?=($start_mon=='2')?'selected':''?>>Feb</option>

						

								<option value="3" <?=($start_mon=='3')?'selected':''?>>Mar</option>

						

								<option value="4" <?=($start_mon=='4')?'selected':''?>>Apr</option>

						

								<option value="5" <?=($start_mon=='5')?'selected':''?>>May</option>

						

								<option value="6" <?=($start_mon=='6')?'selected':''?>>Jun</option>

						

								<option value="7" <?=($start_mon=='7')?'selected':''?>>Jul</option>

						

								<option value="8" <?=($start_mon=='8')?'selected':''?>>Aug</option>

						

								<option value="9" <?=($start_mon=='9')?'selected':''?>>Sep</option>

						

								<option value="10" <?=($start_mon=='10')?'selected':''?>>Oct</option>

						

								<option value="11" <?=($start_mon=='11')?'selected':''?>>Nov</option>

						

								<option value="12" <?=($start_mon=='12')?'selected':''?>>Dec</option>

						

					  </select>

							

					</div>	
                   
					<div class="col-md-3 form-group">

	

						<label for="PBI_REF3">Start Year :</label>			

	

						<select name="start_year" id="start_year" required class="form-control">
							

							<?php 

							

							for($i=date("Y")-1;$i<date("Y")+10;$i++){

							

							?>

							

							<option <?=($start_year==$i)?'selected':''?>><?php echo $i?></option>

							

							<?php }?>

							

							</select>

							

							

							<? if($$unique>0){?>

							

							<tr class="oe_form_group_row">

							

							<td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Current Month :</strong></td>

							

							<td colspan="1" class="oe_form_group_cell">      <select name="current_mon" style="width:160px;" id="current_mon" required class="form-control">

							

									<option value="1" <?=($current_mon=='1')?'selected':''?>>Jan</option>

							

									<option value="2" <?=($current_mon=='2')?'selected':''?>>Feb</option>

							

									<option value="3" <?=($current_mon=='3')?'selected':''?>>Mar</option>

							

									<option value="4" <?=($current_mon=='4')?'selected':''?>>Apr</option>

							

									<option value="5" <?=($current_mon=='5')?'selected':''?>>May</option>

							

									<option value="6" <?=($current_mon=='6')?'selected':''?>>Jun</option>

							

									<option value="7" <?=($current_mon=='7')?'selected':''?>>Jul</option>

							

									<option value="8" <?=($current_mon=='8')?'selected':''?>>Aug</option>

							

									<option value="9" <?=($current_mon=='9')?'selected':''?>>Sep</option>

							

									<option value="10" <?=($current_mon=='10')?'selected':''?>>Oct</option>

							

									<option value="11" <?=($current_mon=='11')?'selected':''?>>Nov</option>

							

									<option value="12" <?=($current_mon=='12')?'selected':''?>>Dec</option>

							

								  </select></td>

							

							<td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Current Year :</strong></td>

							

							<td class="oe_form_group_cell">

							

							

							

							<select name="current_year" style="width:160px;" id="current_year" required class="form-control">

							

							

							

							<?php 

							

							for($i=date("Y")-5;$i<date("Y")+10;$i++){

							

							?>

							

							<option <?=($current_year==$i)?'selected':''?>><?php echo $i?></option>

							

							<?php }?>

							

							</select></td>

							

							</tr>

							

							<? }?>

	

					</div>

					<div class="col-md-3 form-group">

	

						<label for="PBI_REF3">Monthly Payable Amt:</label>			

	

						<input name="payable_amt" type="text" id="payable_amt" value="<?=$payable_amt?>" required class="form-control" />

	

					</div>

					<div class="col-md-3 form-group">

	

						<label for="PBI_REF3">Loan Type :</label>			

	

						 <select name="type" id="type" required class="form-control">



                    <option></option>

                    <? foreign_relation('loan_type','id','type',$type,'1')?>

                    </select>

	

					</div>
					
					<div class="col-md-2 form-group">
					<input type="submit" name="add_loan" id="add_loan" value="Add Loan" class="btn btn-info" />
					</div>

	

									

	

					</div>

					

					

					</div>

					</div>

	
    <div class="oe_chatter"><div class="oe_followers oe_form_invisible">



      <div class="oe_follower_list"></div>



    </div></div></div></div></div>



    </div></div>



            



        </div>



  </form>



</div>

<?


require_once "../../../assets/template/layout.bottom.php";


?>