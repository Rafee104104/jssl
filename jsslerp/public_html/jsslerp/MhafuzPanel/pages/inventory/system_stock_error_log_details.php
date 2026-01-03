<?php

session_start();

require_once('../../../../../../erpengine/controller/MainEngine/controller/configure/db_connect_acc_main.php');



require_once('../../../../../../erpengine/controller/MainEngine/controller/tools/inc.log.php');



require_once('../../../../../../erpengine/controller/MainEngine/controller/tools/inc.database.php');



require_once('../../../../../../erpengine/controller/MainEngine/controller/tools/crud.php');

ob_start();



//====================== EOF ===================



$title = "System Stock Error Log Details";





$pushData = find_all_field('database_info', '', 'company_id="' . $_GET['cid'] . '"');



@mysql_connect('localhost', $pushData->db_user, $pushData->db_pass);



@mysql_select_db($pushData->db_name);

?>

<div class="container">



	<div class="text-center">

		<h3>Daily Stock Details</h3>

		<h4>Date:<?= $_GET['date'] ?></h4>



	</div>

	<table class="table table-bordered">

		<thead>

			<tr>

				<th>Tr From</th>

				<th>Total Qty</th>

				<th>Ji Qty</th>

				<th>Total Qty Different</th>

				<th>Result</th>

			</tr>

		</thead>

		<tbody>

			<?php

			$query = mysql_query('select * from system_stock_lock_details where date="' . $_GET['date'] . '"');

			while ($data = mysql_fetch_object($query)) {

			?>

				<tr>

					<td><?= $data->tr_from ?></td>

					<td><?= $data->total_qty ?></td>

					<td><?= $data->total_qty_ji ?></td>

					<td><?= $data->total_qty_closing ?></td>

					<td><?= $data->total_qty == $data->total_qty_ji ? 'OK' : 'Problem'; ?></td>

				</tr>

			<? } ?>

		</tbody>

	</table>



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





<?

require_once "../../../assets/template/layout.bottom.php";

?>