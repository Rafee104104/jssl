<?php
require_once "../../../assets/template/layout.top.php";
$title = "Customer Relationship Management Dashboard";
$user_name = find_a_field('user_activity_management','username','user_id="'.$_SESSION['user']['id'].'"');
$_SESSION['employee_selected'] = find_a_field('user_activity_management','PBI_ID','user_id="'.$_SESSION['user']['id'].'"');
/*if($_SESSION['employee_selected']==0 || $_SESSION['employee_selected']==''){
header('location:../../../crm_mod/pages/home/index.php');
}*/
 $today = date('Y-m-d');
 $lastdays = 	date("Y-m-d", strtotime("-7 days", strtotime($today)));
 $cur = '&#x9f3;';
?>


<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from designreset.com/cork/ltr/demo3/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Mar 2020 08:10:15 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>  </title>
   <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../../../dashboard_assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
</head>



<div class="content">
        <div class="container-fluid">





          <div class="row">

            <div class="col-lg-3 col-md-6 col-sm-6">

              <div class="card card-stats" style="border: 1px solid orange;">

                <div class="card-header card-header-warning card-header-icon">

                  <div class="card-icon p-0">

                    <i class="fab fa-avianex"></i>

                  </div>

                  <p class="card-category"> LifeTime</p>

                  <h3 class="card-title font-siz">00</h3>

                </div>

                <div class="card-footer" style="border-top:1px solid orange">

                  <div class="stats m-0">
                    <h5 class="m-0 font-weight-bold"> TOTAL CUSTOMER</h5>

                  </div>

                </div>

              </div>

            </div>





            <div class="col-lg-3 col-md-6 col-sm-6">

              <div class="card card-stats" style="border: 1px solid green;">

                <div class="card-header card-header-success card-header-icon">

                  <div class="card-icon p-0">

                    <i class="fas fa-donate"></i>

                  </div>

                  <p class="card-category">LifeTime </p>

                  <h3 class="card-title font-siz">00</h3>

                </div>

                <div class="card-footer" style="border-top:1px solid green">

                  <div class="stats m-0"><h5 class="m-0 font-weight-bold">TOTAL DEALS</h5></div>

                </div>
              </div>
            </div>




            <div class="col-lg-3 col-md-6 col-sm-6">

              <div class="card card-stats" style="border: 1px solid red;">

                <div class="card-header card-header-danger card-header-icon">

                  <div class="card-icon p-0">

                    <i class="fas fa-hand-holding-usd"></i>

                  </div>

                  <p class="card-category"> Last 7 Days </p>

                  <h3 class="card-title font-siz">
                    $ 00
                  </h3>

                </div>

                <div class="card-footer" style="border-top:1px solid red">

                  <div class="stats m-0">
                    <h5 class="m-0 font-weight-bold">TOTAL COMMISSION</h5>
                  </div>
                </div>
              </div>
            </div>





            <div class="col-lg-3 col-md-6 col-sm-6">

              <div class="card card-stats" style="border: 1px solid #1ec1d5;">

                <div class="card-header card-header-info card-header-icon">

                  <div class="card-icon p-0">

                    <i class="fas fa-chart-pie"></i>

                  </div>

                  <p class="card-category">Last 7 Days</p>

                  <h3 class="card-title font-siz">00</h3>

                </div>

                <div class="card-footer" style="border-top:1px solid #1ec1d5">

                  <div class="stats m-0">
                    <h5 class="m-0 font-weight-bold"> DEALS IN PIPELINE</h5>

                  </div>
                </div>
              </div>
            </div>


          </div>


		  
          
        </div>
      </div>




<?

require_once "../../../assets/template/layout.bottom.php";

?>