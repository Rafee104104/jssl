<?php

session_start();


require_once('../../../../../../erpengine/controller/MainEngine/controller/configure/db_connect_acc_main.php');

require_once('../../../../../../erpengine/controller/MainEngine/controller/tools/inc.log.php');

require_once('../../../../../../erpengine/controller/MainEngine/controller/tools/inc.database.php');

require_once('../../../../../../erpengine/controller/MainEngine/controller/tools/crud.php');

if (isset($_POST['submit'])) {

  $_SESSION['cid'] = $_POST['cid'];
}
    ////////////////////////////////*****Last Active time, row count and active module check select cid********** *//////////////////////////////////
$selectDatabase=find_all_field('database_info', '', 'company_id="' . $_SESSION['cid'] . '"');
@mysql_connect('localhost', $selectDatabase->db_user, $selectDatabase->db_pass);
@mysql_select_db($selectDatabase->db_name);
$msql='select id,core_table,table_column from user_module_manage where core_table!=""';
$mquery=mysql_query($msql);
while($mrow=mysql_fetch_object($mquery)){
     $lastuse[$mrow->id]=find_a_field($mrow->core_table,'max('.$mrow->table_column.')','1');
     $rowcount[$mrow->id]=find_a_field($mrow->core_table,'count(*)','1');
}
$accsql='select id from user_module_manage';
$accquery=mysql_query($accsql);
while($accrow=mysql_fetch_object($accquery)){
   $acon[$accrow->id]=1;
}
 /////////////////////////******Back to current Database******** *////////////////////
@mysql_connect('localhost', 'erpengine_clouderpuser', 'clouderppassword224424');
@mysql_select_db('erpengine_clouderpdb');

if (isset($_POST['acSave'])) {

  if ($_SESSION['cid'] != '') {

    //////////////////////////////////*********module array************ *///////////////////////////////////////////
    $pSql = 'select * from module_list';
    $pQuery = mysql_query($pSql);
    while ($pRow = mysql_fetch_object($pQuery)) {

      $nameData[$pRow->id] = $pRow->module_name;
      $fileData[$pRow->id] = $pRow->module_file;
      $linkData[$pRow->id] = $pRow->module_link;
      $descData[$pRow->id] = $pRow->module_description;
      $imgData[$pRow->id]  = $pRow->module_icon_img;
      $mIconData[$pRow->id]  = $pRow->module_menu_icon;
      $staData[$pRow->id]  = $pRow->status;
      $tableData[$pRow->id]  = $pRow->core_table;
      $columnData[$pRow->id]  = $pRow->table_column;
    }

    ////////////////////////////////*****Insert into select database********** *//////////////////////////////////

    $pushData = find_all_field('database_info', '', 'id="' . $_POST['database'] . '"');

    if ($pushData->db_user != '') {

      /////////////////////////******Jump selected Database******** *////////////////////

      @mysql_connect('localhost', $pushData->db_user, $pushData->db_pass);
      @mysql_select_db($pushData->db_name);

      mysql_query('delete from user_module_manage ');

      foreach ($_POST['chkSelect'] as $value) {

        $_POST['id'] = $value;
        $_POST['module_name']       =  $nameData[$value];
        $_POST['module_file']       =  $fileData[$value];
        $_POST['module_link']       =  $linkData[$value];
        $_POST['module_description'] = $descData[$value];
        $_POST['module_icon_img']   =   $imgData[$value];
        $_POST['module_menu_icon']  = $mIconData[$value];
        $_POST['status']            =   $staData[$value];
        $_POST['core_table']        = $tableData[$value];
        $_POST['table_column']      =$columnData[$value];
        $crud = new crud('user_module_manage');
        $crud->insert();
      }


    }
    /////////////////////////******Back to current Database******** *////////////////////

    @mysql_connect('localhost', 'erpengine_clouderpuser', 'clouderppassword224424');
    @mysql_select_db('erpengine_clouderpdb');

    // $msg = $pushData->db_pass;
  } else {
    $msg = "<h3><b class='text-danger'>Select A Company</b></h3>";
  }
  echo "<script>window.top.location='module.php'</script>";
}

ob_start();

//====================== EOF ===================
$title = "Module Access";

?>


<?php require_once('top.php'); ?>





<div class="row justify-content-md-center">
<div class="col-sm-8 drophere ui-droppable mt-2 mb-2">
    <?= $msg; ?>
	<div class="col-12 shadow1 draghere ui-draggable ui-draggable-handle" style="position: relative;">
		<div class="row add">
			<div class="col-9 new_left p-2" align="left">
			<p class="bold m-0"> Access for: <b><u><?= find_a_field('company_info', 'company_name', 'id="' . $_SESSION['cid'] . '"');  ?></u></b></p></div>
			<div class="col-3 new_right p-2">
			
			</div>
		</div>
				
		<div class="pt-3 pb-3">
		


    <form action="" method="post">
      <select name="database" id="database" class="form-control">
        <? foreign_relation('database_info', 'id', 'db_name', '', '  company_id="' . $_SESSION['cid'] . '"'); ?>
      </select>
      <table class="table1  table-striped table-bordered table-hover table-sm">
        <thead class="thead1">
          <tr class="bgc-info">
            <th width="12%">Module ID</th>
            <th>Module Name</th>
            <th>Row Count</th>
            <th>Last Active</th>
            <th><input type="checkbox" id="parent2" /> Access</th>
          </tr>
        </thead>
        <tbody class="tbody1">
          <?php
          $query = mysql_query('select * from module_list group by id');
          while ($data = mysql_fetch_object($query)) {
          ?>
            <tr>
              <td ><?= $data->id ?></td>
              <td align="left"><?= $data->module_name ?></td>
              <td><?=$rowcount[$data->id]?></td>
              <td><?=($lastuse[$data->id]!='')?date('d-m-Y', strtotime($lastuse[$data->id])) : ''?></td>
              <td><input type="checkbox" class="child" name="chkSelect[]" value="<?= $data->id; ?>" <?= ( $acon[$data->id] == 1) ? "checked='checked'" : ""; ?>></td>
            </tr>
          <? } ?>
        </tbody>

      </table>
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