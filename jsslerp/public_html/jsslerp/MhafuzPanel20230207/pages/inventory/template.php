<?php

session_start();

require_once('../../../../../../erpengine/controller/MainEngine/controller/configure/db_connect_acc_main.php');

require_once('../../../../../../erpengine/controller/MainEngine/controller/tools/inc.log.php');

require_once('../../../../../../erpengine/controller/MainEngine/controller/tools/inc.database.php');

require_once('../../../../../../erpengine/controller/MainEngine/controller/tools/crud.php');

$table = "template_access";
$crud   = new crud($table);

if (isset($_POST['submit'])) {

  $_SESSION['cid'] = $_POST['cid'];
}

if (isset($_POST['add'])) {


  //////////////////////////////////////////////////////////////////////////////////////////////////////




  $pushData = find_all_field('database_info', '', 'company_id="' . $_SESSION['cid'] . '"');


  if ($pushData->db_user != '') {
    @mysql_connect('localhost', $pushData->db_user, $pushData->db_pass);
    @mysql_select_db($pushData->db_name);
    mysql_query('delete from config_template ');

    if ($_POST['template_id'] == 1) {
      $_POST['template_name'] = 'Classical';
    } else {
      $_POST['template_name'] = 'Advanced';
    }
    $_POST['id'] = $_POST['template_id'];
    $_POST['status'] = 1;

    $crud   = new crud("config_template");
    $crud->insert();
    echo "<script>window.top.location='template.php'</script>";
  }
  @mysql_connect('localhost', 'erpengine_clouderpuser', 'clouderppassword224424');
  @mysql_select_db('erpengine_clouderpdb');
}


ob_start();

//====================== EOF ===================



$title = "Master Panel Dashboard";





$today = date('Y-m-d');

$lastdays =   date("Y-m-d", strtotime("-7 days", strtotime($today)));

$cur = '&#x9f3;';

?>


<div class="container">


  <?php require_once('top.php'); ?>

</div>
<form action="" method="post">
  <div class="col-md-12 d-flex justify-content-center">
    <h3 class="bg-warning">Choose a Template</h3>
  </div>


  <div class="row">

    <div class="col-md-6">
      <label class="btn btn-outline-secondary active custom-control custom-radio">
        <input type="radio" name="template_id" value="1"><br>
        <img src="../../../assets/images/template1.png" style="width: 70%;" alt="No Image">
    </div>

    <div class="col-md-6">
      <label class="btn btn-outline-success active custom-control custom-radio">
        <input type="radio" name="template_id" value="2"><br>
        <img src="../../../assets/images/template2.png" style="width: 70%;" alt="No Image">
    </div>


    <div class="col-md-2">
      <label class="btn btn-outline-info active custom-control custom-radio">Template Base Color
        <input type="color" name="base_color" class="form-control">
      </label>
    </div>
    <div class="col-md-2">
      <label class="btn btn-outline-warning active custom-control custom-radio">Table top BG Color
        <input type="color" name="table_top_bg_color" class="form-control">
      </label>
    </div>
    <div class="col-md-2">
      <label class="btn btn-outline-primary active custom-control custom-radio">Table top Text Color
        <input type="color" name="table_top_text_color" class="form-control">
      </label>
    </div>
    <div class="col-md-2">
      <label class="btn btn-outline-danger active custom-control custom-radio">Table Footer Color
        <input type="color" name="table_footer_color" class="form-control">
      </label>
    </div>
    <div class="col-md-2">
      <label class="btn btn-outline-success active custom-control custom-radio">Table Row Even Color
        <input type="color" name="table_row_even_color" class="form-control">
      </label>
    </div>

    <div class="col-md-2">
      <label class="btn btn-outline-info active custom-control custom-radio">Table Row odd Color
        <input type="color" name="table_row_odd_color" class="form-control">
      </label>
    </div>
    <div class="col-md-2">
      <label class="btn btn-outline-warning active custom-control custom-radio">Table Row Hover Color
        <input type="color" name="table_row_hover_color" class="form-control">
      </label>
    </div>


  </div>
  <br>


  <center><button class="btn btn-success btn-sm" type="submit" name="add">Submit</button></center>
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