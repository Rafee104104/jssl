<?php

session_start();

//====================== EOF ===================

//var_dump($_SESSION);
require_once "../../../assets/support/inc.all.php";

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>.: Delivery Chalan Bill Report :.</title>
    <script>
        function print_cus(){
            document.getElementById('pr').style.display='none';
            window.print();
        }
    </script>
    <style>
        /*.mb-3{*/
        /*margin-bottom:4px!important;*/
        /*}*/
        /*.input-group-text{*/
        /*font-size:12px;*/
        /*}*/
        /** {*/
        /*margin: 0;*/
        /*padding: 0;*/
        /*font-size:13px;*/
        /*}*/
        /*p {*/
        /*margin: 0;*/
        /*padding: 0;*/
        /*}*/
        /*h1,*/
        /*h2,*/
        /*h3,*/
        /*h4,*/
        /*h5,*/
        /*h6*/
        /*{*/
        /*margin: 0 !important;*/
        /*padding: 0 !important;*/
        /*}*/

        /*th,tr,th,td{*/
        /*border:1px solid;*/
        /*}*/
        /*label{*/

        /*}*/
        table{
            font-size: 12px;
        }

    </style>
</head>

<body>

<section>
    <div class="container-fluid">
        <h2 align="center"><button type="button" class="btn btn-success" id="pr"  onClick="print_cus()">Print</button></h2>
        <table width="100%"  style="font-size: 14px">
            <tr>
                <td colspan="2" style="width: 20%"> <img src="../../../logo/<?=$_SESSION['user']['group']?>.png" width="120px" height="80px" /></td>
                <td colspan="8" style="width: 60%" class="text-center">
                    <h3 class="m-0 p-0"><?php echo find_a_field('project_info','proj_name','1')?></h3>
                    <p class="m-0  p-0" style="letter-spacing:1px; font-weight: bold;">Quality product at affordable cost</p>
                    <p class="m-0 p-0">
                        <?php echo find_a_field('project_info','warehouse_address','1')?>
                        <strong>Cell:</strong> <?php echo find_a_field('project_info','proj_phone','1')?>.
                        <strong>Email: </strong><?php echo find_a_field('project_info','proj_email','1')?>
                        <br> <strong><?php echo find_a_field('project_info','website','1')?></strong>
                    </p>

                    <b class="m-0 p-0 text-center">Delivery Challan (Hub/Centerl warehouse/Factory)</b>


                </td>
                <td colspan="2" style="width: 20%">
                    <div class="bold text-center">
                        <p class="m-0 p-0" style="border: 1px solid black;"> QR code <br/>(DO ID, Distributor<br/> ID and Product info)</p>
                    </div>
                </td>
            </tr>
        </table>


        <!---->
        <!--        <h2 class="row">-->
        <!---->
        <!--            <div class="col-6"><p style="float:right">Reporting Time: --><?//=date("h:i A d-m-Y")?><!--</p></div>-->
        <!--        </div>-->


        <table class="table table-bordered border-primary  text-center">
            <thead>
            <tr style="border: none">
                <td colspan="8" style="text-align: left; border: none;"><strong>Challan No:</strong> </td>
                <td colspan="4" style="text-align: right; border: none;"><strong>Reporting Time:</strong> <?=date("h:i A d-m-Y")?></td>
            </tr>

            <tr>
                <td colspan="8" style="text-align: left; border-right:none;">
                    <p class="m-0 p-0"><strong>Demand ID:</strong> </p>
                    <p class="m-0 p-0"><strong>Depot Name: </strong> </p>
                    <p class="m-0 p-0"><strong>Depot Address: </strong> </p>
                    <p class="m-0 p-0"><strong>Product receiver name: </strong> </p>
                </td>
                <td colspan="4" style="text-align: left; border-left:none;">
                    <p class="m-0 p-0"><strong>Demand Date:</strong> </p>
                    <p class="m-0 p-0"><strong>Depot ID:  </strong> </p>
                    <p class="m-0 p-0"><strong>Depot Phone no:  </strong> </p>
                    <p class="m-0 p-0"><strong>Product receiver Phone no: </strong> </p>
                </td>
            </tr>


            <tr>
                <td colspan="8" style="text-align: left; border-right:none;">
                    <p class="m-0 p-0"><strong>Factory ID:</strong> </p>
                    <p class="m-0 p-0"><strong>In charge Name: </strong> </p>
                    <p class="m-0 p-0"><strong>Address: </strong> </p>
                    <p class="m-0 p-0"><strong>Deliveryman Name: </strong> </p>
                    <p class="m-0 p-0"><strong>Deliveryman Staff ID: </strong> </p>
                    <p class="m-0 p-0"><strong>Driver Name: </strong> </p>
                </td>
                <td colspan="4" style="text-align: left; border-left:none;">
                    <p class="m-0 p-0"><strong>Delivery Challan no:</strong> </p>
                    <p class="m-0 p-0"><strong>In charge ID no: </strong> </p>
                    <p class="m-0 p-0"><strong>Factory Phone no: </strong> </p>
                    <p class="m-0 p-0"><strong>Deliveryman Phone no: </strong> </p>
                    <p class="m-0 p-0"><strong>Vehicle no: </strong> </p>
                    <p class="m-0 p-0"><strong>Driver Phone no: </strong> </p>
                </td>
            </tr>




            <tr>
                <th>SL</th>
                <th>DO ID</th>
                <th>DO Date</th>
                <th>Distribut or ID</th>
                <th>Product Name</th>
                <th>Product ID</th>
                <th>Order Quantity </th>
                <th> Undelivered Product Quantity </th>
                <th> Sample Product Name</th>
                <th> Sample Product ID</th>
                <th> Sample Quantity</th>
                <th> Undelivered Sample Quantity</th>

            </tr>
            </thead>
            <tbody class=" text-center table-striped">

            <tr>
                <td>0</td>
                <td>00</td>
                <td>00-00-000</td>

                <td>test Data</td>
                <td>test Data</td>
                <td>test Data</td>

                <td>test Data</td>
                <td>test Data</td>
                <td>test Data</td>

                <td>test Data</td>
                <td>test Data</td>
                <td>test Data</td>
            </tr>
            <tr>
                <td colspan="6" style="text-align: left; font-weight: bold;">Total</td>
                <td></td>
                <td></td>

                <td colspan="2"></td>
                <td></td>
                <td></td>
            </tr>


            <tr>
                <td colspan="10" rowspan="2" style="text-align:left ;font-weight:bold;">Receiver Sign and Date </td>
                <td colspan="2" style="text-align:left ;font-weight:bold;">
                    Remarks
                </td>
            </tr>
            <tr>
                <td colspan="2">If any mismatch, Please inform to concern person.</td>
            </tr>




            <tr>
                <td colspan="12">
                    <p class="m-0 p-0"><b>This is automated Generated Challan of RCL ERP System.</b></p>
                    <p class="m-0 p-0">This Challan Generated by _____________ date is _____________ and time _____________ at place is _____________.</p>
                    <p class="m-0 p-0">(Like Challan generated by (User name) at 31 July, 9:30 at Dorikandi, Sonargaon, Narayangong)</p>
                </td>
            </tr>







            </tbody>
        </table>
    </div>



</section>




<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>