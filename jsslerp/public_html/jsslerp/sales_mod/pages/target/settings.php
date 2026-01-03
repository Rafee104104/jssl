<?php
session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";  


$table='ss_config';
$unique = 'id';
$crud      =new crud($table);

$today 			  = date('Y-m-d');
$company_id   = $_SESSION['company_id'];
$menu 			  = 'Setup';
$sub_menu 		= 'settings';


if(isset($_REQUEST['update_config'])){
    
    unset($_POST['update_config']);
    $_POST['update_by']=$_SESSION['username'];
    $_POST['update_at']=date('Y-m-d H:i:s');
    $_POST['id']=1;
    $crud->update($unique);
    
    $msg="Update Success";
}



?>










<?
$data = mysql_query('select * from ss_config where id=1');
$data = mysql_fetch_object($data );
?>
    <form class="" method="post" action="">

        <div class="d-flex justify-content-center">

            <div class="n-form1 fo-width pt-0">
                <h4 class="text-center bg-titel bold pt-2 pb-2">      General Settings  </h4>

                <div class="container">
                    <div class="form-group row  m-0 mb-1 pl-3 pr-3">
                        <label for="group_for" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Mobile App Running </label>
                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">

                            <select class="form-select form-control" name="app_status" id="app_status">
                                <option value="<?=$data->app_status?>"><? if($data->app_status==1) echo 'Yes'; else echo 'No';?></option>
                                <option value="1">Yes</option value="0"><option>No</option>
                            </select>

                        </div>
                    </div>
                    <div class="form-group row  m-0 mb-1 pl-3 pr-3">
                        <label for="group_for" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">App Status Notice</label>
                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">

                            <input type="text" class="form-control" name="app_status_notice" id="app_status_notice"  value="<?=$data->app_status_notice?>" required>

                        </div>
                    </div>
                    <div class="form-group row  m-0 mb-1 pl-3 pr-3">
                        <label for="group_for" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Mobile User Report Status </label>
                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">


                            <select class="form-select form-control" name="report_status" id="report_status">
                                <option value="<?=$data->report_status?>"><? if($data->report_status==1) echo 'Yes'; else echo 'No';?></option>
                                <option value="1">Yes</option value="0"><option>No</option>
                            </select>


                        </div>
                    </div>

                    <div class="form-group row  m-0 mb-1 pl-3 pr-3">
                        <label for="group_for" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Google Map API </label>
                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">


                            <input type="text" class="form-control" name="map_api" id="map_api"  value="<?=$data->map_api?>" required>


                        </div>
                    </div>

                    <div class="form-group row  m-0 mb-1 pl-3 pr-3">
                        <label for="group_for" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Mobile User Geofence Lock</label>
                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">


                            <select class="form-select form-control" name="geo_lock" id="geo_lock">
                                <option value="<?=$data->geo_lock?>"><? if($data->geo_lock==1) echo 'Yes'; else echo 'No';?></option>
                                <option value="1">Yes</option value="0"><option>No</option>
                            </select>


                        </div>
                    </div>


                    <div class="form-group row  m-0 mb-1 pl-3 pr-3">
                        <label for="group_for" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Order Distance (Kilometer)</label>
                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">


                            <input type="text" class="form-control" name="order_km" id="order_km"  value="<?=$data->order_km?>" required>


                        </div>
                    </div>

                </div>

                <div class="n-form-btn-class">
                    <input type="submit" name="update_config" class="btn1 btn1-bg-update" value="Update"/>
                </div>

            </div>

        </div>



    </form>










 
  <?
$main_content=ob_get_contents();
ob_end_clean();
include ("../../template/main_layout.php");
?>