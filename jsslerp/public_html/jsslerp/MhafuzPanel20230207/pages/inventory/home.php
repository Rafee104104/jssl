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



<div class="content">

    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-6 col-md-12">
                <div class="card card-chart" style="height: 290px;">
                    <div class="card-header">
                        <h4 class="card-title text-center bold"> <u>System Daily Error Log Stock Status</u> </h4>

                        <table class="table1  table-striped table-bordered table-hover table-sm">
                            <thead class="thead1">
                                <tr class="bgc-info">
                                    <th>Sl</th>
                                    <th>Company</th>
                                    <th>Date</th>
                                    <th>Total Qty</th>
                                    <th>Total Qty Ji</th>
                                    <th>Difference</th>
                                </tr>
                            </thead>
                            <tbody class="tbody1">
                                <?php

                                $sQuery = mysql_query('select s.*,c.company_name from system_daily_error_log s,company_info c where s.cid=c.id and s.date="' . date("Y-m-d") . '"');
                                $sQ = 1;
                                while ($sqRow = mysql_fetch_object($sQuery)) {
                                ?>
                                    <tr>
                                        <td><?= $sQ++ ?></td>
                                        <td><?= $sqRow->company_name ?></td>
                                        <td><?= $sqRow->date ?></td>
                                        <td><?= $sqRow->total_qty ?></td>
                                        <td><?= $sqRow->total_qty_ji ?></td>
                                        <td><?= $sqRow->difference ?></td>
                                    </tr>
                                <? } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12">
                <div class="card card-chart" style="height: 290px;">
                    <div class="card-header">
                        <h4 class="card-title text-center bold"> <u>System Daily Error Log Finance Status</u> </h4>

                        <table class="table1  table-striped table-bordered table-hover table-sm">
                            <thead class="thead1">
                                <tr class="bgc-info">
                                    <th>Sl</th>
                                    <th>Company</th>
                                    <th>Date</th>
                                    <th>Total Amount</th>
                                    <th>Total ji Amount</th>
                                    <th>Difference</th>
                                </tr>
                            </thead>
                            <tbody class="tbody1">
                                <?php
                                $fQuery = mysql_query('select s.*,c.company_name from system_daily_error_log_finance s,company_info c where s.cid=c.id and s.date="' . date("Y-m-d") . '"');
                                $fq = 1;
                                while ($fqRow = mysql_fetch_object($fQuery)) {
                                ?>
                                    <tr>
                                        <td><?= $fq++; ?></td>
                                        <td><?= $fqRow->company_name ?></td>
                                        <td><?= $fqRow->date ?></td>
                                        <td><?= $fqRow->total_qty ?></td>
                                        <td><?= $fqRow->total_qty_ji ?></td>
                                        <td><?= $fqRow->difference ?></td>
                                    </tr>
                                    </tr>
                                <? } ?>




                            </tbody>
                        </table>

                    </div>
                </div>
            </div>







        </div>

    </div>











    <div class="container-fluid">
        <h4 class="text-center bg-titel bold pt-2 pb-2">System Daily Error Log Account Status</h4>
        <table class="table1  table-striped table-bordered table-hover table-sm">
            <thead class="thead1">
                <tr class="bgc-info">
                    <th>Sl</th>
                    <th>Company</th>
                    <th>Date</th>
                    <th>Diff Cr</th>
                    <th>Diff Dr</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody class="tbody1">
                <?php
                $acQuery = mysql_query('select s.*,c.company_name from system_daily_error_log_acc s,company_info c where s.cid=c.id and s.date="' . date("Y-m-d") . '"');
                $ac = 1;
                while ($acRow = mysql_fetch_object($acQuery)) {


                ?>

                    <tr>
                        <td><?= $ac++; ?></td>
                        <td><?= $acRow->company_name; ?></td>
                        <td><?= $acRow->date; ?></td>
                        <td><?= $acRow->diff_cr; ?></td>
                        <td><?= $acRow->diff_dr; ?></td>
                        <td><?= $acRow->diff_cr == 0 || $acRow->diff_dr == 0 ? 'OK' : 'Problem'; ?></td>
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