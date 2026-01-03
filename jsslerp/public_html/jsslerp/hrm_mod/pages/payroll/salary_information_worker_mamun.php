<?php
require_once "../../../assets/template/layout.top.php";



if (isset($_POST['button'])) {
	//$pbi = find_a_field('personnel_basic_info','PBI_ID','PBI_CODE="'.$_POST['employee_selected'].'"');
	$_SESSION['employee_selected'] = find_a_field('personnel_basic_info', 'PBI_ID', 'PBI_CODE="' . $_POST['employee_selected'] . '"');
}


if (isset($_POST['reset'])) {
	//$pbi = find_a_field('personnel_basic_info','PBI_ID','PBI_CODE="'.$_POST['employee_selected'].'"');
	unset($_SESSION['employee_selected']);
}





$title = 'Salary Information Worker';

$page = "salary_information_worker_mamun.php";

$input_page = "employee_essential_information_input.php";

$root = 'payroll';

$table = 'salary_info_worker';    // Database Table Name Mainly related to this page

$unique = 'id';            // Primary Key of this Database table

$shown = 'hourly_rate';    // For a New or Edit Data a must have data field

$crud = new crud($table);

$image_path = find_all_field('personnel_basic_info', '', 'PBI_ID="' . $_SESSION['employee_selected'] . '"');

$required_id = find_a_field($table, $unique, 'PBI_ID=' . $_SESSION['employee_selected'], ' order by id desc limit 1');




if ($required_id > 0)
	$$unique = $_GET[$unique] = $required_id;





if (isset($_POST[$shown])) {

	if (isset($_POST['insert'])) {
	
		
		 $hourly_rate=$_POST['hourly_rate'];
		$att_allowance=$_POST['att_allowance'];
		$night_allowance=$_POST['night_allowance'];

		$_POST['PBI_ID'] = $_SESSION['employee_selected'];

		$crud->insert();

		$type = 1;

		$msg = 'New Entry Successfully Inserted.';
		header('Location: salary_information_worker_mamun.php');

		unset($_POST);

		unset($$unique);

		$required_id = find_a_field($table, $unique, 'PBI_ID=' . $_SESSION['employee_selected'], ' order by id desc limit 1');

		if ($required_id > 0)
			$$unique = $_GET[$unique] = $required_id;
	}


	//for Modify..................................

	if (isset($_POST['update'])) {
		
				$_POST['PBI_ID'] = $_SESSION['employee_selected'];

		$crud->update($unique);

		$type = 1;
	}

	//for update..................................
	
	
	if (isset($_POST['update'])) {
		
		$hourly_rate=$_POST['hourly_rate'];
		$att_allowance=$_POST['att_allowance'];
		$night_allowance=$_POST['night_allowance'];
		
		
		 $sql_update="update salary_info_worker set hourly_rate='".$hourly_rate."',att_allowance='".$att_allowance."',night_allowance='".$night_allowance."'
		where PBI_ID='".$_SESSION['employee_selected']."'";
		
		mysql_query($sql_update);
	}
	
	

	if (isset($_POST['delete'])) {

		$condition = $unique . "=" . $$unique;

		$crud->delete($condition);

		unset($$unique);

		echo '<script type="text/javascript">

					parent.parent.document.location.href = "../' . $root . '/' . $page . '";

				</script>';

		$type = 1;
		$msg = 'Successfully Deleted.';
	}
}



if (isset($$unique)) {

	$condition = $unique . "=" . $$unique;

	$data = db_fetch_object($table, $condition);

	while (list($key, $value) = each($data)) {

		$$key = $value;
	}
}

?>





<!--	Body Starts From Here	-->



<form action="" method="post" id="form" enctype="multipart/form-data">
	<div class="form-container_large">

		<? include('../../common/title_bar.php');
		do_calander('#comm_till_date'); ?>



		<header class="pb-4">

			<? if (!isset($_GET[$unique])) { ?>
				<span class="oe_form_buttons_edit" style="display: inline;">
					<button name="insert" accesskey="S" class="btn1 btn1-bg-submit" type="submit">
						Save
					</button>
				</span>
			<? } ?>



			<? if (isset($_GET[$unique])) { ?>
				<span class="oe_form_buttons_edit" style="display: inline;">
					<button name="update" accesskey="S" class=" btn1 btn1-bg-submit" type="submit">
						Update
					</button>
				</span>
			<? } ?>

			<!--<span class="oe_form_buttons_edit" style="display: inline;">
				<button 
						name="reset" style="background-color: #aa5629 !important;" class="btn1 btn1-bg-cancel" type="submit" onclick="parent.parent.GB_hide();">
					Reset
				</button>
			</span>-->



			<? if (isset($_GET[$unique])) { ?>
				<span class="oe_form_buttons_edit" style="display: inline;">
					<button name="delete" accesskey="S" class="btn1 btn1-bg-cancel" type="submit">
						Delete
					</button>
				</span>
			<? } ?>
			<div class="oe_clear"></div>

		</header>




		<h4 class="text-center bg-titel bold pt-2 pb-2">
			Salary Setup Worker
		</h4>

		<div class="container-fluid bg-form-titel">
			<div class="row">


				<!--left form-->

				<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
					<div class="container n-form2">



						<div class="form-group row m-0 pb-1">
							<label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">
								Hourly Rate :
							</label>
							<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
								<input name="hourly_rate" type="text" id="hourly_rate" class="form-control"  value="<?=$hourly_rate ?>" />
							</div>
						</div>

						<div class="form-group row m-0 pb-1">
							<label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">
								Att. Allowance:
							</label>
							<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
								<input name="att_allowance" type="text" id="att_allowance" class="form-control"  value="<?=$att_allowance ?>" />
							</div>
						</div>



					</div>
				</div>







				<!--Right form-->

				<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
					<div class="container n-form2">


						<div class="form-group row m-0 pb-1">
							<label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">
								Night Allowance :
							</label>

							<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
								<input name="night_allowance" type="text" id="night_allowance" value="<?=$night_allowance ?>" class="form-control" />
							</div>
						</div>



						


						


						<!--<div class="form-group row m-0 pb-1">
							<label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">
								Bank Paid :
							</label>

							<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
								<input name="bank_amt" type="text" id="bank_amt" value="<?= $bank_amt ?>" />
							</div>
						</div>-->

					</div>
				</div>
			</div>
		</div>

		<br>
		<br>

	</div>
</form>




<? require_once "../../../assets/template/layout.bottom.php"; ?>


<!--	Thanks for visiting my codes `RAHUL`	-->