<?php

session_start();


require_once('../../../../../../erpengine/controller/MainEngine/controller/configure/db_connect_acc_main.php');

require_once('../../../../../../erpengine/controller/MainEngine/controller/tools/inc.log.php');

require_once('../../../../../../erpengine/controller/MainEngine/controller/tools/inc.database.php');

require_once('../../../../../../erpengine/controller/MainEngine/controller/tools/crud.php');

$table = "database_info";
$crud   = new crud($table);
$unique = 'id';
if (isset($_POST['add'])) {

  $crud->insert();

  unset($_POST);
}

if (($_GET['del_id'] != '')) {

  $crud->delete('id="' . $_GET["del_id"] . '"');
}


//$data = find_all_field('database_info', '', 'id="' . $_SESSION["cid"] . '" ');

//require_once "../../../assets/support/inc.panel.all.php";

ob_start();

//====================== EOF ===================
$title = "Add Database";

?>

<style>
.bmd-label-static{
	color:#333;
	font-weight: bold;
}
.sr-main-content-padding{
background-color:#fff !important;


}
</style>


<div class="container">



  <form action="" method="post" >
    <div class="row bg-form-titel">

      <div class="col-md-4 form-group m-0">
        <label class="label success bmd-label-static" for="PBI_ID">DB Name: </label>

        <input name="db_name" type="text" id="db_name" class="form-control" />
      </div>

      <div class="col-md-4 form-group m-0">
        <label class="label success bmd-label-static" for="PBI_ID">DB User: </label>

        <input name="db_user" type="text" id="db_user" class="form-control" />
      </div>

      <div class="col-md-4 form-group m-0">
        <label class="label success bmd-label-static" for="PBI_ID">DB Password: </label>

        <input name="db_pass" type="text" id="db_pass" class="form-control" />
      </div>

    </div>
	
	<div class="container-fluid p-0 ">
	<div class="n-form-btn-class">
      <input type="submit" name="add" value="Save" class="btn btn-success">

	</div>

</div>
  </form>
  <hr />
  <h3 class="text-center">List Of Not Assign Database</h3>

  <table class="table1  table-striped table-bordered table-hover table-sm">
    <thead class="thead1">
      <tr class="bgc-info">
        <th>Database Name</th>
        <th>Database User</th>
        <th>Database Password</th>
        <th>Assign Company</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody class="tbody1">
	<?php

            $query = mysql_query('select * from database_info where company_id=0');
            while ($data = mysql_fetch_object($query)) {


            ?>
        <tr>
          <td><?= $data->db_name ?></td>
          <td><?= $data->db_user ?></td>
          <td><?= $data->db_pass ?></td>
          <td><a target="blank" href="assign_database.php?db_id=<?= $data->id ?>">Assign Company</a></td>
          <td><a href="?del_id=<?= $data->id ?>">Delete</a></td>
        </tr>
      <? } ?>
    </tbody>
  </table>

</div>

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