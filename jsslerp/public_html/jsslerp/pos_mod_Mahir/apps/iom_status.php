<?php

session_start();

include 'config/db.php';

include 'config/function.php';

include 'config/access.php';

$u_id= $_SESSION['user_id']; //$_SESSION['user']['id'];
$PBI_ID = find_a_field('user_activity_management','PBI_ID','user_id='.$u_id);

$user_id	= $PBI_ID; //$_SESSION['user_id'];



$page="do_unfinished";



include "inc/header.php";



?>
<style>
    
    .table1,.thead1,.tbody1{
        font-size: 14px;
        font-family: 'Poppins', sans-serif !important;
        text-align: center;
    }


    .table1 {
        width: 100%;
        overflow:auto;
    }

    .table1{
        /*display:table;*/
    }

    .thead1, .tbody tr {
        /*display:table;*/
        width:100%;
        table-layout:fixed;
    }

    .thead1{
        position: sticky;
        top: 0px;
    }
    .table1 .btn1{
        line-height: 1 !important;
    }

    @media only screen and (max-width: 991px){

        .table1 {
            display:block;
            max-height:500px;
            max-width: fit-content;
            width: 100%;
            /*overflow-x:auto;*/
            overflow:auto;
        }

        .table1,.thead1,.tbody1{
            font-size: 12px !important;
        }


    }



    .dataTables_wrapper .dataTables_paginate .paginate_button{
        padding: 0px !important;
    }

    .dataTables_info{
        font-size: 12px !important;

    }

    .dataTables_length label{
        font-size: 12px !important;
        width: 100% !important;
    }

    .dataTables_length label select{
        width: 90%!important;
    }


    .page-link{
        background-color: #fff !important;
        border: 1px solid #dee2e6 !important;
    }
    .page-item.active .page-link{
        z-index: 1;
        color: #ffffff !important;
        background-color: #B11199 !important;
        border: 1px solid #B11199 !important;
    }
    .table-bg{
        background-color: #B11199 !important;
        color: #fff;
    }


    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active
    {

        color: #000 !important;
        cursor: pointer !important;
        /*color: #666 !important;*/
        /*border: 1px solid #0be3ff !important;*/
        background-color: #B11199 !important
    box-shadow: none;
    }

    .paginate_button a:hover{
        color: #000!important;
        font-weight: bold!important;
    }

    .paginate_button a:active{
        color: #000!important;
        font-weight: bold!important;
    }


</style>

    <!-- main page content -->

    <div class="main-container container">



        <!-- User list items  -->

        <div class="row">





            <div class="row">
                <div class="row text-center mb-2"><h4> IMO Status</h4></div>

                <div class="card pt-5 pb-5">

                    <table class="table1  table-striped table-bordered table-hover table-sm">
                        <thead class="thead1">
                        <tr class="table-bg">
                            <th>SL</th>
                            <th>Acc Code</th>
                            <th>Accounts Head</th>

                            <th>Address</th>
                            <th>Debit Amt</th>
                            <th>Credit Amt</th>

                            <th>Action</th>
                            <th>Action</th>
                            <th>Action</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody class="tbody1">

                        <tr>
                            <td>hello 1</td>
                            <td>hello 2</td>
                            <td>hello 3</td>
                            <td>hello 4</td>
                            <td>hello 5</td>
                            <td>hello 6</td>
                            <td>hello 7</td>
                            <td>hello 7</td>
                            <td>hello 7</td>
                            <td>hello 7</td>

                        </tr>


                        </tbody>
                    </table>

                </div>

            </div>





        </div>




    </div>

    <!-- main page content ends -->

    <!-- Page ends-->



<?php include "inc/footer.php"; ?>