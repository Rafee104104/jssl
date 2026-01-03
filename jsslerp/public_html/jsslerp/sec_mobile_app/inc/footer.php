<?php



?>

    <!-- Footer -->

    <footer class="footer">

        <div class="container">

            <ul class="nav nav-pills nav-justified">

                <li class="nav-item">

				<? if($_SESSION['dsr_login']=='YES'){ ?>

                    <a class="nav-link <? if($page=='home'){ echo 'active';}?>" href="home_DSR.php">

				<? }else{ ?>

				<a class="nav-link <? if($page=='home'){ echo 'active';}?>" href="home.php">

				<? } ?>	

                        <span>

                            <i class="nav-icon bi bi-house"></i>

                            <span class="nav-text">Home</span>

                        </span>

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link <? if($page=='do_list'){ echo 'active';}?>" href="do_list.php">

                        <span>

                            <i class="nav-icon bi bi-truck"></i>

                            <span class="nav-text">Delivery</span>

                        </span>

                    </a>

                </li>

                <li class="nav-item centerbutton">

                    <a href="do.php?pal=2" class="nav-link" id="centermenubtn">

                        <span class="theme-linear-gradient">

                            <i class="bi bi-basket size-22"></i>

                        </span>

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link <? if($page=='do_unfinished'){ echo 'active';}?>" href="do_unfinished.php">

                        <span>

                            <i class="nav-icon bi bi-cart4"></i>

                            <span class="nav-text">Hold</span>

                        </span>

                    </a>

                </li>

<?

$report_status = find1("select report_status from ss_config where id=1");

if($report_status==1){

?>				

               <li class="nav-item">

                    <a class="nav-link <? if($page=='report_list'){ echo 'active';}?>" href="report_list.php">

                        <span>

                            <i class="nav-icon bi bi-star"></i>

                            <span class="nav-text">Reports</span>

                        </span>

                    </a>

                </li>

<? } ?>				

            </ul>

        </div>

    </footer>

    <!-- Footer ends-->


    <script src="assets/js/jquery-3.3.1.min.js"></script>

    <script src="assets/js/popper.min.js"></script>

    <script src="assets/vendor/bootstrap-5/js/bootstrap.bundle.min.js"></script>



    <!-- Customized jquery file  -->

    <script src="assets/js/main.js"></script>

    <script src="assets/js/color-scheme.js"></script>


    <!-- Chart js script -->

    <script src="assets/vendor/chart-js-3.3.1/chart.min.js"></script>



    <!-- Progress circle js script -->

    <script src="assets/vendor/progressbar-js/progressbar.min.js"></script>



    <!-- swiper js script -->

    <script src="assets/vendor/swiperjs-6.6.2/swiper-bundle.min.js"></script>



    <!-- daterange picker script -->

    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <script src="assets/vendor/daterangepicker/daterangepicker.js"></script>



    <!-- nouislider js -->

    <!--<script src="assets/vendor/nouislider/nouislider.min.js"></script>-->

    <!-- PWA app service registration and works -->

    <!--<script src="assets/js/pwa-services.js"></script>-->

    <!-- page level custom script -->

<script src="assets/js/app.js"></script>




</body>


</html>