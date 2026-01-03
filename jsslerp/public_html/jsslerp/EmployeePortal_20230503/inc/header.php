<!doctype html>

<html lang="en">

<?
$u_id= $_SESSION['user_id']; //$_SESSION['user']['id'];
if($_SESSION['user_id'] >0){  }else{ echo '<script>location.href="logout.php";</script>'; }
$PBI_ID = find_a_field('user_activity_management','PBI_ID','user_id='.$u_id);
?>

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<meta name="description" content="">

<meta name="author" content="">

<meta name="generator" content="">

<title>Attendance Management

<?=$ms;?>

</title>

<!-- manifest meta -->

<meta name="apple-mobile-web-app-capable" content="yes">

<!--<link rel="manifest" href="manifest.json" />-->

<!-- Favicons -->

<link rel="apple-touch-icon" href="assets/img/favicon180.png" sizes="180x180">

<link rel="icon" href="assets/img/favicon32.png" sizes="32x32" type="image/png">

<link rel="icon" href="assets/img/favicon16.png" sizes="16x16" type="image/png">

<!-- Google fonts-->

<link rel="preconnect" href="https://fonts.googleapis.com">

<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

<!-- bootstrap icons -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<!-- nouislider CSS -->

<link href="assets/vendor/nouislider/nouislider.min.css" rel="stylesheet">

<!-- date rage picker -->

<link rel="stylesheet" href="assets/vendor/daterangepicker/daterangepicker.css">

<!-- swiper carousel css -->

<link rel="stylesheet" href="assets/vendor/swiperjs-6.6.2/swiper-bundle.min.css">

<!-- style css for this template -->

<link href="assets/scss/custom.css" rel="stylesheet" id="style">
<link href="assets/scss/style.css" rel="stylesheet" id="style">

</head>

<body class="body-scroll theme-pink" data-page="shop">

<!-- Sidebar main menu -->

<div class="sidebar-wrap  sidebar-overlay">

  <!-- Add pushcontent or fullmenu instead overlay -->

  <div class="closemenu text-secondary">Close Menu</div>

  <div class="sidebar ">

    <!-- user information -->

    <div class="row">

      <div class="col-12 profile-sidebar">

        <div class="row">

          <div class="col-auto">
		  
		        <? 

		   //$sql =  @mysql_query("select PBI_NAME,PBI_PICTURE_ATT_PATH,DEPT_ID,DESG_ID,PBI_NID_ATT_PATH from  personnel_basic_info where PBI_ID = ".$PBI_ID ."");

		   //$row = @mysql_fetch_object($sql);
		   
		   
		   $image_path = find_a_field('personnel_basic_info','PBI_PICTURE_ATT_PATH','PBI_ID="'.$PBI_ID.'"');
		   
		   if($image_path!==""){ 

		  ?>
		  
		  <figure class="avatar avatar-100 rounded-20 shadow-sm"><img src="../../../CloudERP/assets/support/upload_view.php?name=<?=$image_path?>&folder=hrm_emp_pic" alt="#">   </figure>
		  
	
		  
		    <? }else{?>

            <figure class="avatar avatar-100 rounded-20 shadow-sm"> <img src="assets/img/user1.jpg" alt=""> </figure>
			
			<? }?>

          </div>

          <div class="col px-0 align-self-center">

            <p class="mb-2" style="font-size:13px"><?=find_a_field('user_activity_management','concat(fname," - ",PBI_ID)','PBI_ID='.$PBI_ID);?></p>

            <p class="text-muted size-12"> <?=find_a_field('personnel_basic_info','PBI_DESIGNATION','PBI_ID="'.$PBI_ID.'"');?><br />

             <?php /*?>Dep: <?=find_a_field('personnel_basic_info','PBI_DEPARTMENT','PBI_ID="'.$PBI_ID.'"');?><?php */?></p>

          </div>

        </div>

      </div>

    </div>

    <!-- user emnu navigation -->

    <div class="row">

      <div class="col-12">

        <ul class="nav nav-pills">

          <li class="nav-item"> <a class="nav-link active" aria-current="page" href="home.php">

            <div class="avatar avatar-40 icon"><i class="bi bi-house-door"></i></div>

            <div class="col">Dashboard</div>

            <div class="arrow"><i class="bi bi-chevron-right"></i></div>

            </a> </li>

          <!-- SETUP -->

          <?php /*?><li class="nav-item dropdown">







                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">







                                <div class="avatar avatar-40 icon"><i class="bi bi-palette"></i></div>







                                <div class="col">Setup</div>







                                <div class="arrow"><i class="bi bi-chevron-down plus"></i> <i class="bi bi-chevron-up minus"></i>







                                </div>







                            </a>







                            <ul class="dropdown-menu">







                                <li><a class="dropdown-item nav-link" href="setup_shop.php">







                                        <div class="avatar avatar-40 icon"><i class="bi bi-box-seam"></i></div>







                                        <div class="col align-self-center">New Shop</div>







                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                                </a></li>







                                







     







                            </ul>







                        </li><?php */?>

          <!--Delivery-->

          <?php /*?><li class="nav-item dropdown">







                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">







                                <div class="avatar avatar-40 icon"><i class="bi bi-cart"></i></div>







                                <div class="col">Fuel Management</div>







                                <div class="arrow"><i class="bi bi-chevron-down plus"></i><i class="bi bi-chevron-up minus"></i>







                                </div>







                            </a>







                            <ul class="dropdown-menu">







                                <li>







                                    <a class="dropdown-item nav-link" href="do.php?pal=2">







                                        <div class="avatar avatar-40 icon"><!--<i class="bi bi-box-seam"></i>--></div>







                                        <div class="col align-self-center">Entry Fuel Expenses</div>







                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                                    </a>







                                </li>







                                <li>







                                    <a class="dropdown-item nav-link" href="do_unfinished.php">







                                        <div class="avatar avatar-40 icon"><i class="bi bi-box-seam"></i></div>







                                        <div class="col align-self-center">Draft List</div>







                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                                    </a>







                                </li>







								







								<li>







                                    <a class="dropdown-item nav-link" href="unchecked_fuel.php">







                                        <div class="avatar avatar-40 icon"><i class="bi bi-box-seam"></i></div>







                                        <div class="col align-self-center">Check Fuel Expense</div>







                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                                    </a>







                                </li>







								







								<li>







                                    <a class="dropdown-item nav-link" href="unapproved_fuel.php">







                                        <div class="avatar avatar-40 icon"><i class="bi bi-box-seam"></i></div>







                                        <div class="col align-self-center">Approve Fuel Expense</div>







                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                                    </a>







                                </li>







								







								<li>







                                    <a class="dropdown-item nav-link" href="fuel_status.php">







                                        <div class="avatar avatar-40 icon"><i class="bi bi-box-seam"></i></div>







                                        <div class="col align-self-center">Fuel Claim Status</div>







                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                                    </a>







                                </li>







 







                            </ul>







                        </li><?php */?>

          <?php /*?><li class="nav-item dropdown">







                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">







                                <div class="avatar avatar-40 icon"><i class="bi bi-cart"></i></div>







                                <div class="col">Office Expenses</div>







                                <div class="arrow"><i class="bi bi-chevron-down plus"></i><i class="bi bi-chevron-up minus"></i>







                                </div>







                            </a>







                            <ul class="dropdown-menu">







                                <li>







                                    <a class="dropdown-item nav-link" href="office_expense.php?pal=2">







                                        <div class="avatar avatar-40 icon"><!--<i class="bi bi-box-seam"></i>--></div>







                                        <div class="col align-self-center">Entry Office Expenses</div>







                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                                    </a>







                                </li>







                                <li>







                                    <a class="dropdown-item nav-link" href="office_expense_unfinished.php">







                                        <div class="avatar avatar-40 icon"><i class="bi bi-box-seam"></i></div>







                                        <div class="col align-self-center">Draft List</div>







                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                                    </a>







                                </li>







								







								<li>







                                    <a class="dropdown-item nav-link" href="unchecked_office_expense.php">







                                        <div class="avatar avatar-40 icon"><i class="bi bi-box-seam"></i></div>







                                        <div class="col align-self-center">Check Office Expense</div>







                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                                    </a>







                                </li>







								







								<li>







                                    <a class="dropdown-item nav-link" href="unapproved_office_expense.php">







                                        <div class="avatar avatar-40 icon"><i class="bi bi-box-seam"></i></div>







                                        <div class="col align-self-center">Approve Office Expense</div>







                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                                    </a>







                                </li>







								







								<li>







                                    <a class="dropdown-item nav-link" href="office_expense_status.php">







                                        <div class="avatar avatar-40 icon"><i class="bi bi-box-seam"></i></div>







                                        <div class="col align-self-center">Expense Status</div>







                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                                    </a>







                                </li>







 







                            </ul>







                        </li><?php */?>

          <?php /*?><li class="nav-item dropdown">







                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">







                                <div class="avatar avatar-40 icon"><i class="bi bi-cart"></i></div>







                                <div class="col">Car Movement</div>







                                <div class="arrow"><i class="bi bi-chevron-down plus"></i><i class="bi bi-chevron-up minus"></i>







                                </div>







                            </a>







                            <ul class="dropdown-menu">







                                <li>







                                    <a class="dropdown-item nav-link" href="vehicle_movement.php?pal=2">







                                        <div class="avatar avatar-40 icon"><!--<i class="bi bi-box-seam"></i>--></div>







                                        <div class="col align-self-center">Log Entry</div>







                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                                    </a>







                                </li>







								







								<li>







                                    <a class="dropdown-item nav-link" href="unfinished_log.php?pal=2">







                                        <div class="avatar avatar-40 icon"><!--<i class="bi bi-box-seam"></i>--></div>







                                        <div class="col align-self-center">Draft Log</div>







                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                                    </a>







                                </li>







								







                                <li>







                                    <a class="dropdown-item nav-link" href="movement_status.php">







                                        <div class="avatar avatar-40 icon"><i class="bi bi-box-seam"></i></div>







                                        <div class="col align-self-center">Log Book</div>







                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                                    </a>







                                </li>







								







                            </ul>







                        </li><?php */?>

          <?php /*?><li class="nav-item dropdown">







                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">







                                <div class="avatar avatar-40 icon"><i class="bi bi-cart"></i></div>







                                <div class="col">Maintenance Management</div>







                                <div class="arrow"><i class="bi bi-chevron-down plus"></i><i class="bi bi-chevron-up minus"></i>







                                </div>







                            </a>







                            <ul class="dropdown-menu">







                                <li>







                                    <a class="dropdown-item nav-link" href="maintenance_expense.php?pal=2">







                                        <div class="avatar avatar-40 icon"><!--<i class="bi bi-box-seam"></i>--></div>







                                        <div class="col align-self-center">Maintenance Expenses</div>







                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                                    </a>







                                </li>







                                <li>







                                    <a class="dropdown-item nav-link" href="maintenance_unfinished.php">







                                        <div class="avatar avatar-40 icon"><i class="bi bi-box-seam"></i></div>







                                        <div class="col align-self-center">Draft List</div>







                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                                    </a>







                                </li>







								







								<li>







                                    <a class="dropdown-item nav-link" href="unchecked_maintenance.php">







                                        <div class="avatar avatar-40 icon"><i class="bi bi-box-seam"></i></div>







                                        <div class="col align-self-center">Check Expense</div>







                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                                    </a>







                                </li>







								







								<li>







                                    <a class="dropdown-item nav-link" href="unapproved_maintenance.php">







                                        <div class="avatar avatar-40 icon"><i class="bi bi-box-seam"></i></div>







                                        <div class="col align-self-center">Approve Expense</div>







                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                                    </a>







                                </li>







								







								<li>







                                    <a class="dropdown-item nav-link" href="maintenance_status.php">







                                        <div class="avatar avatar-40 icon"><i class="bi bi-box-seam"></i></div>







                                        <div class="col align-self-center">Claim Status</div>







                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                                    </a>







                                </li>







 







                            </ul>







                        </li><?php */?>

          <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">

            <div class="avatar avatar-40 icon"><i class="bi bi-receipt"></i></div>

            <div class="col">Attendance</div>

            <div class="arrow"><i class="bi bi-chevron-down plus"></i><i class="bi bi-chevron-up minus"></i> </div>

            </a>

            <ul class="dropdown-menu">

              <li> <a class="dropdown-item nav-link" href="daily_attendance2.php">

                <div class="avatar avatar-40 icon"><i class="bi bi-bell"></i></div>

                <div class="col align-self-center">Daily Attendance</div>

                <div class="arrow"><i class="bi bi-chevron-right"></i></div>

                </a> </li>
				
				
				 <li> <a class="dropdown-item nav-link" href="attendance.php">

                <div class="avatar avatar-40 icon"><i class="bi bi-bell"></i></div>

                <div class="col align-self-center">Daily Attendance (Pic)</div>

                <div class="arrow"><i class="bi bi-chevron-right"></i></div>

                </a> </li>
				
				
				 <!--<li> <a class="dropdown-item nav-link" href="attendance_pic.php">

                <div class="avatar avatar-40 icon"><i class="bi bi-bell"></i></div>

                <div class="col align-self-center">Daily Attendance (Pic+Loc)</div>

                <div class="arrow"><i class="bi bi-chevron-right"></i></div>

                </a> </li>-->
				
				

              <li> <a class="dropdown-item nav-link" href="att_report.php">

                <div class="avatar avatar-40 icon"><i class="bi bi-box-seam"></i></div>

                <div class="col align-self-center">Attendance Report</div>

                <div class="arrow"><i class="bi bi-chevron-right"></i></div>

                </a> </li>

              <li> <a class="dropdown-item nav-link" href="att_location_report.php">

                <div class="avatar avatar-40 icon"><i class="bi bi-box-seam"></i></div>

                <div class="col align-self-center">Attendance Location</div>

                <div class="arrow"><i class="bi bi-chevron-right"></i></div>

                </a> </li>

            </ul>

          </li>

          <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">

            <div class="avatar avatar-40 icon"><i class="bi bi-receipt"></i></div>

            <div class="col">Leave & IOM</div>

            <div class="arrow"><i class="bi bi-chevron-down plus"></i><i class="bi bi-chevron-up minus"></i> </div>

            </a>

            <ul class="dropdown-menu">

              <li> <a class="dropdown-item nav-link" href="leave.php">

                <div class="avatar avatar-40 icon"><i class="bi bi-bell"></i></div>

                <div class="col align-self-center">Leave Entry</div>

                <div class="arrow"><i class="bi bi-chevron-right"></i></div>

                </a> </li>

              <li> <a class="dropdown-item nav-link" href="short_leave.php">

                <div class="avatar avatar-40 icon"><i class="bi bi-box-seam"></i></div>

                <div class="col align-self-center">Half Day Leave</div>

                <div class="arrow"><i class="bi bi-chevron-right"></i></div>

                </a> </li>

              <li> <a class="dropdown-item nav-link" href="iom_entry.php">

                <div class="avatar avatar-40 icon"><i class="bi bi-box-seam"></i></div>

                <div class="col align-self-center">IOM Entry</div>

                <div class="arrow"><i class="bi bi-chevron-right"></i></div>

                </a> </li>

            </ul>

          </li>

          <!--SALES RETURN-->

          <?php /*?><li class="nav-item dropdown">







                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">







                                <div class="avatar avatar-40 icon"><i class="bi bi-cart"></i></div>







                                <div class="col">Vehicle Requisition</div>







                                <div class="arrow"><i class="bi bi-chevron-down plus"></i><i class="bi bi-chevron-up minus"></i>







                                </div>







                            </a>







                            <ul class="dropdown-menu">







                                <li>







                                    <a class="dropdown-item nav-link" href="vehicle_requisition.php">







                                        <div class="avatar avatar-40 icon"><!--<i class="bi bi-box-seam"></i>--></div>







                                        <div class="col align-self-center">Request For Vehicle</div>







                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                                    </a>







                                </li>







                                <li>







                                    <a class="dropdown-item nav-link" href="vehicle_req_status.php">







                                        <div class="avatar avatar-40 icon"><!--<i class="bi bi-box-seam"></i>--></div>







                                        <div class="col align-self-center">My Request Status</div>







                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                                    </a>







                                </li>







								







								<li>







                                    <a class="dropdown-item nav-link" href="vehicle_assign.php">







                                        <div class="avatar avatar-40 icon"><!--<i class="bi bi-box-seam"></i>--></div>







                                        <div class="col align-self-center">Vehicle Assign</div>







                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                                    </a>







                                </li>







 







                            </ul>







                        </li><?php */?>

          <!--Reports-->

          <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">

            <div class="avatar avatar-40 icon"><i class="bi bi-cart"></i></div>

            <div class="col">Leave & Iom Status</div>

            <div class="arrow"><i class="bi bi-chevron-down plus"></i><i class="bi bi-chevron-up minus"></i> </div>

            </a>

            <ul class="dropdown-menu">

              <li> <a class="dropdown-item nav-link" href="leave_status.php">

                <div class="avatar avatar-40 icon"><i class="bi bi-box-seam"></i></div>

                <div class="col align-self-center">Leave Status</div>

                <div class="arrow"><i class="bi bi-chevron-right"></i></div>

                </a> </li>

				

				

				  <li> <a class="dropdown-item nav-link" href="iom_status.php">

                <div class="avatar avatar-40 icon"><i class="bi bi-box-seam"></i></div>

                <div class="col align-self-center">Iom Status</div>

                <div class="arrow"><i class="bi bi-chevron-right"></i></div>

                </a> </li>

				

				

            </ul>

			

          </li>

          <?php /*?><li class="nav-item dropdown">







                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">







                                <div class="avatar avatar-40 icon"><i class="bi bi-cart"></i></div>







                                <div class="col">Shop pages</div>







                                <div class="arrow"><i class="bi bi-chevron-down plus"></i> <i class="bi bi-chevron-up minus"></i>







                                </div>







                            </a>







                            <ul class="dropdown-menu">







                                <li>







                                    <a class="dropdown-item nav-link" href="products.php">







                                        <div class="avatar avatar-40 icon"><i class="bi bi-box-seam"></i>







                                        </div>







                                        <div class="col align-self-center">All Products</div>







                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                                    </a>







                                </li>







                                <li>







                                    <a class="dropdown-item nav-link" href="product.php">







                                        <div class="avatar avatar-40 icon"><i class="bi bi-box-seam"></i>







                                        </div>







                                        <div class="col align-self-center">Product</div>







                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                                    </a>







                                </li>







                                <li>







                                    <a class="dropdown-item nav-link" href="cart.php">







                                        <div class="avatar avatar-40 icon"><i class="bi bi-bag"></i>







                                        </div>







                                        <div class="col align-self-center">Cart</div>







                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                                    </a>







                                </li>







                                <li>







                                    <a class="dropdown-item nav-link" href="myorders.php">







                                        <div class="avatar avatar-40 icon"><i class="bi bi-view-list"></i>







                                        </div>







                                        <div class="col align-self-center">My Orders</div>







                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                                    </a>







                                </li>







                                <li>







                                    <a class="dropdown-item nav-link" href="payment.php">







                                        <div class="avatar avatar-40 icon"><i class="bi bi-cash-stack"></i>







                                        </div>







                                        <div class="col align-self-center">Payment</div>







                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                                    </a>







                                </li>







                                <li>







                                    <a class="dropdown-item nav-link" href="invoice.php">







                                        <div class="avatar avatar-40 icon"><i class="bi bi-receipt"></i>







                                        </div>







                                        <div class="col align-self-center">Invoice</div>







                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                                    </a>







                                </li>







                            </ul>







                        </li>







                        <?php */?>

          <!--<li class="nav-item">







                            <a class="nav-link" href="chat.php" tabindex="-1">







                                <div class="avatar avatar-40 icon"><i class="bi bi-chat-text"></i></div>







                                <div class="col">Messages</div>







                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                            </a>







                        </li>-->

          <!--<li class="nav-item">







                            <a class="nav-link" href="notifications.php" tabindex="-1">







                                <div class="avatar avatar-40 icon"><i class="bi bi-bell"></i></div>







                                <div class="col">Notification</div>







                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                            </a>







                        </li>-->

          <?php /*?><li class="nav-item">







                            <a class="nav-link" href="blog.php" tabindex="-1">







                                <div class="avatar avatar-40 icon"><i class="bi bi-newspaper"></i></div>







                                <div class="col">Blogs</div>







                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                            </a>







                        </li>















                        <li class="nav-item">







                            <a class="nav-link" href="style.php" tabindex="-1">







                                <div class="avatar avatar-40 icon"><i class="bi bi-palette"></i></div>







                                <div class="col">Style <i class="bi bi-star-fill text-warning small"></i></div>







                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                            </a>







                        </li>















                        <li class="nav-item">







                            <a class="nav-link" href="pages.php" tabindex="-1">







                                <div class="avatar avatar-40 icon"><i class="bi bi-file-earmark-text"></i></div>







                                <div class="col">Pages <span class="badge bg-info fw-light">new</span></div>







                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>







                            </a>







                        </li><?php */?>

          <li class="nav-item"> <a class="nav-link" href="logout.php" tabindex="-1">

            <div class="avatar avatar-40 icon"><i class="bi bi-box-arrow-right"></i></div>

            <div class="col">Logout</div>

            <div class="arrow"><i class="bi bi-chevron-right"></i></div>

            </a> </li>

        </ul>

      </div>

    </div>

  </div>

</div>

<!-- Sidebar main menu ends -->

<!-- Begin page -->

<main class="h-100">

<!-- Header -->

<header class="header position-fixed header-filled">

  <div class="row">

    <div class="col-auto">

      <button type="button" class="btn btn-light btn-44 btn-rounded menu-btn"> <i class="bi bi-list"></i> </button>

    </div>

    <div class="col" style="padding-left: 0px;">

      <div class="logo-small">
        <h5>Employee<br />
          <span class="text-secondary fw-light">Portal</span></h5>

      </div>

    </div>

    <div class="col-auto">
<!--        <a href="" target="_self" class="btn btn-light btn-44 btn-rounded"> <i class="bi bi-bell"></i> <span class="count-indicator"></span> </a>-->
        <div class="logo-small">
            <img src="assets/img/logo.png" alt="" />
        </div>
<!--        <a href="attendance.php" target="_self" class="btn btn-light btn-44 btn-rounded ms-2"> <i class="bi bi-person-circle"></i> </a>-->
    </div>

  </div>

</header>

<!-- Header ends -->

