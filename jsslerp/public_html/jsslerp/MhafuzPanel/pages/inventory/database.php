<?php
session_start();
require_once('../../../../../../erpengine/controller/MainEngine/controller/configure/db_connect_acc_main.php');
require_once('../../../../../../erpengine/controller/MainEngine/controller/tools/inc.log.php');
require_once('../../../../../../erpengine/controller/MainEngine/controller/tools/inc.database.php');
require_once('../../../../../../erpengine/controller/MainEngine/controller/tools/crud.php');


$table = "database_info";

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

if (isset($_POST['delete'])) {

  $crud->delete('id="' . $_POST["id"] . '"');

}





//$data = find_all_field('database_info', '', 'id="' . $_SESSION["cid"] . '" ');



//require_once "../../../assets/support/inc.panel.all.php";



ob_start();



//====================== EOF ===================

$title = "Database Information";



if (isset($_POST['add'])) {

}



?>



<style>

.bmd-label-static{

	color:#333;

	font-weight: bold;

}
</style>







<div class="container">
<?php require_once('top.php'); ?>
</div>

<div class="drophere ui-droppable mt-2 mb-2">
	<div class="col-12 shadow1 draghere ui-draggable ui-draggable-handle" style="position: relative;">
		<div class="row add">
			<div class="col-9 new_left p-2" align="left"><p class="bold m-0"> Add Company Database Information</p></div>
			<div class="col-3 new_right p-2">

			</div>
		</div>
				
		<div class="pt-3 pb-3">
		
		

  <?php



  $query = mysql_query('select * from database_info where company_id="' . $_SESSION['cid'] . '"');

  while ($data = mysql_fetch_object($query)) {

  

 if ($_SESSION['cid'] != '') {

  ?>

    <form action="" method="post" class="m-0">

      <div class="row">

        <div class="col-md-4 form-group">

          <label class="label success" for="PBI_ID">DB Name: </label>



          <input name="db_name" type="text" id="db_name" value="<?= $data->db_name; ?>" class="form-control" />

        </div>



        <div class="col-md-4 form-group">

          <label class="label success" for="PBI_ID">DB User: </label>



          <input name="db_user" type="text" id="db_user" value="<?= $data->db_user; ?>" class="form-control" />

        </div>



        <div class="col-md-4 form-group">

          <label class="label success" for="PBI_ID">DB Password: </label>



          <input name="db_pass" type="text" id="db_pass" value="<?= $data->db_pass; ?>" class="form-control" />

        </div>





          <?php if ($_SESSION['cid'] != '') { ?>

		  

				<div class="container-fluid p-0 ">

					<div class="n-form-btn-class">

							<input type="hidden" name="id" value="<?= $data->id ?>">

							<input type="submit" name="update" value="Update" class="btn1 btn1-bg-update mt-4">

							<input type="submit" name="delete" value="Delete" class="btn1 btn1-bg-cancel mt-4">

					</div>

				</div>			

          <? } ?>

		  

      </div>



    </form>



  <? } }

  if ($_SESSION['cid'] == '') { ?>



    <form action="" method="post">

      <div class="row">

        <div class="col-md-3 form-group">

          <label class="label success" for="PBI_ID">Company: </label>



          <input list="ids" name="company_id" type="text" id="company_id" class="form-control req1" />

        </div>

        <div class="col-md-3 form-group">

          <label class="label success" for="PBI_ID">DB Name: </label>



          <input name="db_name" type="text" id="db_name" class="form-control req1" />

        </div>



        <div class="col-md-3 form-group">

          <label class="label success" for="PBI_ID">DB User: </label>



          <input name="db_user" type="text" id="db_user" class="form-control req1" />

        </div>



        <div class="col-md-3 form-group">

          <label class="label success" for="PBI_ID">DB Password: </label>



          <input name="db_pass" type="text" id="db_pass" class="form-control req1" />

        </div>



      </div>

	  

	  

	<div class="container-fluid p-0 ">

		<div class="n-form-btn-class">

	 		 <input type="submit" name="insert" value="Save" class="btn1 btn1-bg-submit">

		</div>

	</div>

	  

	  

	  

    </form>



  <? } ?>





  <? if ($_SESSION['cid'] != '') { ?>

  

  	<div class="container-fluid p-0 ">

		<div class="n-form-btn-class">

	 		     <input type="submit" name="clear" value="clear" class="btn1 btn1-bg-cancel">

		</div>

	</div>



  <? } ?>



		
		
		
						
		</div>
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