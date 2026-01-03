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
system_stock_error_log($_POST['fdate'],$pushData->db_user,$pushData->db_pass,$pushData->db_name);


}
} else {
$msg = "<h3><b class='text-danger'>Select A Company</b></h3>";
}
}
ob_start();
//====================== EOF ===================
$title = "Stock Check";

?>


<div class="d-flex justify-content-center">
    <form class="n-form1 fo-width pt-4" action="master_report.php" method="post" name="form1" target="_blank" id="form1">
        <div class="row m-0 p-0">
            <div class="col-sm-5">
                <div align="left">Select Report </div>
                <div class="form-check">
                    <input name="report" type="radio" class="radio1" id="report1-btn" value="1" checked="checked" tabindex="1"/>
                    <label class="form-check-label p-0" for="report1-btn">
                        Stock Check Report
                    </label>
                </div>
				
				<div class="form-check">
                    <input name="report" type="radio" class="radio1" id="report1-btn" value="2"  tabindex="1"/>
                    <label class="form-check-label p-0" for="report1-btn">
                        Stock Value Check Report
                    </label>
                </div>
				
<div class="form-check">
                    <input name="report" type="radio" class="radio1" id="report1-btn" value="3"  tabindex="1"/>
                    <label class="form-check-label p-0" for="report1-btn">
                        Finance Check Report
                    </label>
                </div>
				
               

            </div>

            <div class="col-sm-7">
              
				
				<div class="form-group row m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">Company:</label>
                    <div class="col-sm-8 p-0">

                        <span class="oe_form_group_cell">
                            
							<input list="ids" type="text" name="cid" />
							<datalist id="ids">
							<?php
					
							$sql = "SELECT * from company_info";
					
							$query = @mysql_query($sql);
							while ($datarow = mysql_fetch_object($query)) { ?>
							  <option value="<?= $datarow->id ?>"><?= $datarow->company_name ?></option>
							<?php } ?>
						  </datalist>
                        </span>


                    </div>
                </div>
				
				
				
			
                <div class="form-group row m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">Start Date :</label>
                    <div class="col-sm-8 p-0">

                        <span class="oe_form_group_cell">
                 		  <input class="form-control" type="date" name="f_date" id="f_date" />
                        </span>
                    </div>
                </div>
				                <div class="form-group row m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">End Date :</label>
                    <div class="col-sm-8 p-0">

                        <span class="oe_form_group_cell">
                 		  <input class="form-control" type="date" name="t_date" id="t_date" />
                        </span>
                    </div>
                </div>




            </div>

        </div>
        <div class="n-form-btn-class">
            <input name="submit" type="submit" class="btn1 btn1-bg-submit" value="Report" tabindex="6" />
        </div>
    </form>
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