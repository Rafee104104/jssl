<?php

session_start();
include 'config/db.php';
include 'config/function.php';
include 'config/access.php';
$user_id	=$_SESSION['user_id'];

$page="home";

include "inc/header.php";

?>
<!-- main page content -->
<div class="main-container container">

<!-- summary blocks -->
<!--<div class="row">-->
<!--                <div class="col-12 px-0">-->
<!--                    <div class="swiper-container summayswiper">-->
<!--                        <div class="swiper-wrapper">-->
<!--                            <div class="swiper-slide">-->
<!--                                <div class="card shadow-sm mb-2">-->
<!--                                    <div class="card-body">-->
<!--                                        <div class="row">-->
<!--                                            <div class="col-auto">-->
<!--                                                <div class="avatar avatar-50 bg-warning text-white shadow-sm rounded-15">-->
<!--                                                    <i class="bi bi-star"></i>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                            <div class="col px-0 align-self-center">-->
<!--                                                <p class="text-secondary size-12 mb-0">Bonus Points</p>-->
<!--                                                <p>48546 pts</p>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="swiper-slide">-->
<!--                                <div class="card shadow-sm mb-2">-->
<!--                                    <div class="card-body">-->
<!--                                        <div class="row">-->
<!--                                            <div class="col-auto">-->
<!--                                                <div class="avatar avatar-50 bg-success text-white shadow-sm rounded-15">-->
<!--                                                    <i class="bi bi-cash-stack"></i>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                            <div class="col px-0 align-self-center">-->
<!--                                                <p class="text-secondary size-12 mb-0">Cashback</p>-->
<!--                                                <p>15 BDT</p>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            <!--<div class="swiper-slide">-->
                            <!--    <div class="card shadow-sm mb-2">-->
                            <!--        <div class="card-body">-->
                            <!--            <div class="row">-->
                            <!--                <div class="col-auto">-->
                            <!--                    <div class="avatar avatar-50 bg-primary text-white shadow-sm rounded-15">-->
                            <!--                        <i class="bi bi-controller"></i>-->
                            <!--                    </div>-->
                            <!--                </div>-->
                            <!--                <div class="col px-0 align-self-center">-->
                            <!--                    <p class="text-secondary size-12 mb-0">Gameplay</p>-->
                            <!--                    <p>105 coins</p>-->
                            <!--                </div>-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--<div class="swiper-slide">-->
                            <!--    <div class="card shadow-sm mb-2">-->
                            <!--        <div class="card-body">-->
                            <!--            <div class="row">-->
                            <!--                <div class="col-auto">-->
                            <!--                    <div class="avatar avatar-50 bg-info text-white shadow-sm rounded-15">-->
                            <!--                        <i class="bi bi-droplet"></i>-->
                            <!--                    </div>-->
                            <!--                </div>-->
                            <!--                <div class="col px-0 align-self-center">-->
                            <!--                    <p class="text-secondary size-12 mb-0">Fuel</p>-->
                            <!--                    <p>3 ltr</p>-->
                            <!--                </div>-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->

<?


$visit=15;
$total_order = 35;
$total_delivery=50;

?>


<!-- Top Baner info -->
<div class="row bg-theme text-white mb-3">
                <div class="col align-self-center">
                    <div class="text-center py-4">
                        <h4 class="mb-0"><span class="countertext"><?=(int)$total_delivery?></span></h4>
                        <p class="small">Total Punch</p>
                    </div>
                </div>
                <div class="col align-self-center">
                    <div class="text-center py-4">
                        <h4 class="mb-0"><span class="countertext"><?=(int)$visit?></span></h4>
                        <p class="small">Total Absent This Month</p>
                    </div>
                </div>
                <div class="col align-self-center">
                    <div class="text-center py-4">
                        <h4 class="mb-0"><span class="countertext"><?=(int)$total_order?></span></h4>
                        <p class="small">Total Late</p>
                    </div>
                </div>   
            </div>
        </div>
        <!-- main page content ends -->


    </main>
    <!-- Page ends-->

<?php include "inc/footer.php"; ?>