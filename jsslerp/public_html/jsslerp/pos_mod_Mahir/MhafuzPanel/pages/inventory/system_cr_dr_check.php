<?php

session_start();

require_once('../../../../../../erpengine/controller/MainEngine/controller/configure/db_connect_acc_main.php');

require_once('../../../../../../erpengine/controller/MainEngine/controller/tools/inc.log.php');

require_once('../../../../../../erpengine/controller/MainEngine/controller/tools/inc.database.php');

require_once('../../../../../../erpengine/controller/MainEngine/controller/tools/crud.php');

require_once('function.php');

if (isset($_POST['submit'])) {

$_SESSION['cid'] = $_POST['cid'];

}

if (isset($_POST['acSave'])) {

if ($_SESSION['cid'] != '') {

//////////////////////////////////*********module array************ *///////////////////////////////////////////

////////////////////////////////*****Insert into select database********** *//////////////////////////////////

$pushData = find_all_field('database_info', '', 'company_id="' . $_POST['database'] . '"');

if ($pushData->db_user != '') {

/////////////////////////******Jump selected Database******** *////////////////////

system_cr_dr_error_log($_POST['fdate'],$pushData->db_user,$pushData->db_pass,$pushData->db_name);

}

} else {

$msg = "<h3><b class='text-danger'>Select A Company</b></h3>";

}

}

ob_start();

//====================== EOF ===================

$title = "Cr Dr Check";

?>

<?php require_once('top.php'); ?>


<div class="row justify-content-md-center">
<?= $msg; ?>
<div class="col-sm-6 drophere ui-droppable mt-2 mb-2">
	<div class="col-12 shadow1 draghere ui-draggable ui-draggable-handle" style="position: relative;">
		<div class="row add">
			<div class="col-9 new_left p-2" align="left">
			<p class="bold m-0"> Stock Check  for: <b><u><?= find_a_field('company_info', 'company_name', 'id="' . $_SESSION['cid'] . '"');  ?></u></b></p>
			</div>
			<div class="col-3 new_right p-2">

			</div>
		</div>
				
		<div class="pt-3 pb-3">

<form action="" method="post">

<div class="from-group row">

<label for="" class="col-sm-1 col-form-label" style="font-weight: 600;">Date</label>

<div class="col-sm-11">

<input type="date" name="fdate" id="fdate" class="form-control req"   value="<?=$_POST['fdate']?>" />

</div>

</div>	

<div class="from-group row pt-2">

<label for="inputPassword" class="col-sm-1 col-form-label" style="font-weight: 600;">DB</label>

<div class="col-sm-11">

<select name="database" id="database" class="form-control req" >

<? foreign_relation('database_info', 'company_id', 'db_name', '', '  company_id="' . $_SESSION['cid'] . '"'); ?>

</select>

</div>

</div>

<div class="container-fluid p-0 ">

<div class="n-form-btn-class">

<input class="btn1 btn1-bg-submit" type="submit" value="Save" name="acSave">

</div>

</div>

</form>
	</div>
</div>
</div>
</div>


<div class="drophere ui-droppable mt-2 mb-2">
	<div class="col-12 shadow1 draghere ui-draggable ui-draggable-handle" style="position: relative;">
		<div class="row add">
			<div class="col-9 new_left p-2" align="left"><p class="bold m-0"> View system Cr Dr Position </p></div>
			<div class="col-3 new_right p-2">

			</div>
		</div>
				
		<div class="pt-3 pb-3">

<? 

@mysql_connect('localhost', $pushData->db_user, $pushData->db_pass);

@mysql_select_db($pushData->db_name);

?>

<table class="table1  table-striped table-bordered table-hover table-sm">

<thead class="thead1">

<tr class="bgc-info">

<th>Sl</th>

<th>Date</th>

<th>Tr Form</th>

<th>Tr No</th>

<th>Difference</th>

</tr>

</thead>

<tbody class="tbody1">

<?  $sql="select * from system_cr_dr_check_details where 1 and cid=".$_SESSION['cid']." ";

$query=mysql_query($sql);

$sl=0;

while($data=mysql_fetch_object($query)){

?>	

<tr>

<td><?=++$sl;?></td>

<td><?=$data->date;?></td>

<td><?=$data->tr_from;?></td>

<td><?=$data->tr_no;?></td>

<td><?=$data->difference;?> </td>

</tr>

<? } ?>

</tbody>

</table>

						
		</div>
		<? 

@mysql_connect('localhost', 'erpengine_clouderpuser', 'clouderppassword224424');

@mysql_select_db('erpengine_clouderpdb');

?>
	</div>
</div>






<!--   Core JS Files   -->

<script src=" ../../../dashboard_assets/js/core/jquery.min.js"></script>

<script src="../../../dashboard_assets/js/core/popper.min.js"></script>

<script src="../../../dashboard_assets/js/core/bootstrap-material-design.min.js"></script>

<script src="../../../dashboard_assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>

<!-- Plugin for the momentJs  -->

<script src="../../../dashboard_assets/js/plugins/moment.min.js"></script>

<!--  Plugin for Sweet Alert -->

<script src="../../../dashboard_assets/js/plugins/sweetalert2.js"></script>

<!-- Forms Validations Plugin -->

<script src="../../../dashboard_assets/js/plugins/jquery.validate.min.js"></script>

<!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->

<script src="../../../dashboard_assets/js/plugins/jquery.bootstrap-wizard.js"></script>

<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->

<script src="../../../dashboard_assets/js/plugins/bootstrap-selectpicker.js"></script>

<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->

<script src="../../../dashboard_assets/js/plugins/bootstrap-datetimepicker.min.js"></script>

<!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->

<script src="../../../dashboard_assets/js/plugins/jquery.dataTables.min.js"></script>

<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->

<script src="../../../dashboard_assets/js/plugins/bootstrap-tagsinput.js"></script>

<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->

<script src="../../../dashboard_assets/js/plugins/jasny-bootstrap.min.js"></script>

<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->

<script src="../../../dashboard_assets/js/plugins/fullcalendar.min.js"></script>

<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->

<script src="../../../dashboard_assets/js/plugins/jquery-jvectormap.js"></script>

<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->

<script src="../../../dashboard_assets/js/plugins/nouislider.min.js"></script>

<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

<!-- Library for adding dinamically elements -->

<script src="../../../dashboard_assets/js/plugins/arrive.min.js"></script>

<!--  Google Maps Plugin    -->

<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

<!-- Chartist JS -->

<script src="../../../dashboard_assets/js/plugins/chartist.min.js"></script>

<!--  Notifications Plugin    -->

<script src="../../../dashboard_assets/js/plugins/bootstrap-notify.js"></script>

<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->

<script src="../../../dashboard_assets/js/material-dashboard-mis.js?v=2.1.2" type="text/javascript"></script>

<!-- Material Dashboard DEMO methods, don't include it in your project! -->

<script>

$('#parent2').click(function(event) {

if (this.checked) {

// Iterate each checkbox

$(':checkbox').each(function() {

this.checked = true;

});

} else {

$(':checkbox').each(function() {

this.checked = false;

});

}

});

</script>

<?

require_once "../../../assets/template/layout.bottom.php";



?>