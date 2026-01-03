<?php

session_start();


require_once('../../../../../../erpengine/controller/MainEngine/controller/configure/db_connect_acc_main.php');

require_once('../../../../../../erpengine/controller/MainEngine/controller/tools/inc.log.php');

require_once('../../../../../../erpengine/controller/MainEngine/controller/tools/inc.database.php');

require_once('../../../../../../erpengine/controller/MainEngine/controller/tools/crud.php');

$table = "company_info";
$crud   = new crud($table);

if (isset($_POST['submit'])) {

  $_SESSION['cid'] = $_POST['cid'];
}
if (isset($_POST['clear'])) {
  $_SESSION['cid'] = '';
}
if (isset($_POST['insert'])) {

  $crud->insert();
}

if (isset($_POST['update'])) {

  $crud->update('id');
}

$data = find_all_field('company_info', '', 'id="' . $_SESSION["cid"] . '" ');


//require_once "../../../assets/support/inc.panel.all.php";

ob_start();

//====================== EOF ===================



$title = "Master Panel Dashboard";





$today = date('Y-m-d');

$lastdays =   date("Y-m-d", strtotime("-7 days", strtotime($today)));

$cur = '&#x9f3;';

?>



<div class="container">

  <?php require_once('top.php');

  ?>

</div>
<form action="" method="post" class="p-3" style="background-color:#f7f7f7;">
  <div class="row">
    <div class="col-md-3 form-group">
      <label class="label success bmd-label-static" for="PBI_ID">CID Name : </label>

      <input type="hidden" name="id" value="<?= $data->id; ?>">

      <input name="cid" type="text" id="cid" value="<?= $data->cid; ?>" class="form-control" required />
    </div>
    <div class="col-md-3 form-group">

      <label class="label success bmd-label-static" for="PBI_ID">Project Name : </label>

      <input name="company_name" type="text" id="company_name" value="<?= $data->company_name; ?>" class="form-control" required />
    </div>

    <div class="col-md-3 form-group">
      <label class="label success bmd-label-static" for="PBI_ID">Contact Person: </label>

      <input name="contact_person" type="text" id="contact_person" value="<?= $data->contact_person ?>" class="form-control" />
    </div>

    <div class="col-md-3 form-group">
      <label class="label success bmd-label-static" for="PBI_ID">Sign Up date: </label>

      <input name="signup_date" type="date" id="signup_date" value="<?= $data->signup_date; ?>" class="form-control" />
    </div>

    <div class="col-md-3 form-group">
      <label class="label success bmd-label-static" for="PBI_ID">Register date: </label>

      <input name="register_date" type="date" id="register_date" value="<?= $data->register_date; ?>" class="form-control" />
    </div>

    <div class="col-md-3 form-group">
      <label class="label success bmd-label-static" for="PBI_ID">Email: </label>

      <input name="email" type="text" id="email" value="<?= $data->email; ?>" class="form-control" />
    </div>
    <div class="col-md-3 form-group">
      <label class="label success bmd-label-static" for="PBI_ID">Website: </label>

      <input name="website" type="text" id="website" value="<?= $data->website; ?>" class="form-control" />
    </div>

    <div class="col-md-3 form-group">
      <label class="label success bmd-label-static" for="PBI_ID">Contact No: </label>

      <input name="contact_no" type="text" id="contact_no" value="<?= $data->contact_no; ?>" class="form-control" />
    </div>

    <div class="col-md-3 form-group">
      <label class="label success bmd-label-static" for="PBI_ID">Address: </label>

      <input name="address" type="text" id="address" value="<?= $data->address; ?>" class="form-control" />
    </div>

    <div class="col-md-3 form-group">
      <label class="label success bmd-label-static" for="PBI_ID">Country: </label>

      <input name="country" type="text" id="country" value="<?= $data->country; ?>" class="form-control" />
    </div>

    <div class="col-md-3 form-group">
      <label class="label success bmd-label-static" for="PBI_ID">Type: </label>

      <select name="type" type="text" id="type" class="form-control">
        <option value="<?= $data->type; ?>"><?= $data->type; ?></option>
        <option value="LIVE">LIVE</option>
        <option value="DEV-DEMO">DEV-DEMO</option>
        <option value="DEMO">DEMO</option>
        <option value="SAMPLE">SAMPLE</option>
      </select>
    </div>
	
	
	<div class="col-md-3 form-group">
      <label class="label success bmd-label-static" for="PBI_ID">Server Name: </label>

      <input name="server_name" type="text" id="server_name" value="<?= $data->server_name; ?>" class="form-control" />
    </div>

    <div class="col-md-3 form-group">
      <label class="label success bmd-label-static" for="PBI_ID">Status: </label>

      <select type="text" name="status" id="status" class="form-control" required>
        <option value="<?= $data->status; ?>"><?= $data->status; ?></option>
        <option value="ON">ON</option>
        <option value="OFF">OFF</option>
      </select>
    </div>
    <div class="col-md-3 form-group">
      <label class="label success bmd-label-static" for="PBI_ID">Active Status: </label>
      <select type="text" name="active" id="active" class="form-control" required>
        <option value="<?= $data->active; ?>"><?= $data->active; ?></option>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
      </select>
    </div>
  </div>
  
  
  
  <div class="container-fluid p-0 ">

				<div class="n-form-btn-class">
					<input type="hidden" name="lastId">
					<? if ($_SESSION['cid'] == '') { ?>
					  <input type="submit" name="insert" value="Save" class="btn btn-success">
					<? }
					if ($_SESSION['cid'] != '') { ?>
					  <input type="submit" name="update" value="Update" class="btn btn-warning">
					<? } ?>
					<input type="submit" name="clear" value="clear" class="btn btn-danger">

				</div>

</div>
			
  
  
  
</form>


</div>







<!--   Core JS Files   -->

<script src="../../../dashboard_assets/js/core/jquery.min.js"></script>

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



<?



require_once "../../../assets/template/layout.bottom.php";


?>