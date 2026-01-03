
<?
session_start();
$mod_id = 99;
$mod_name = 'Super Panel';
?>

                    <style type="text/css">
                        .page_title{
                            border: solid .1rem #dfdfdf;
                            border-radius: 5px;
                            margin-bottom: 10px;
                            background: transparent;
                            border: none;
                            float: left;
                            top: 3px;
                            margin-bottom: 15px;
                        }

                        .breadcrumb {
                            background-color: transparent;
                            border: none;
                            padding: 9px 13px;
                            margin-bottom: 0px;
                            padding-left: 0;
                            padding-bottom: 0;
                        }

                        .ol {
                            list-style-position: outside;
                            padding-left: 22px;
                        }


                        ol, ul {
                            margin-top: 0;
                            margin-bottom: 10px;
                        }


                        * {
                            -webkit-box-sizing: border-box;
                            -moz-box-sizing: border-box;
                            box-sizing: border-box;
                        }

                        ol {
                            display: block;
                            list-style-type: decimal;
                            margin-block-start: 1em;
                            margin-block-end: 1em;
                            margin-inline-start: 0px;
                            margin-inline-end: 0px;
                            padding-inline-start: 40px;
                        }

                        .sidebar::before, .off-canvas-sidebar nav .navbar-collapse::before{
                            height:auto!important;
                        }

                        @media only screen and  (max-width: 1023px) {
                            .main_content
                            {
                                position: relative;
                                float: left;
                                width: 100%;
                            }
                            .sidebar{width:50%;}
                        }



                        @media only screen and  (max-width: 3000px) {
                            .main_content{
                                position: relative;
                                float:right;
                                width: 82%;
                            }
                            .sidebar{width:18%;}
                        }

                        .sidebar::-webkit-scrollbar {
                            width: .2em;
                            height: .0em;
                        }


                        .sidebar::-webkit-scrollbar-track {
                            box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
                        }

                        /*.sidebar::-webkit-scrollbar-thumb {*/
                        /*background-color: green;*/
                        /*outline: 1px solid slategrey;*/
                        /*}*/


                        .sidebar{
                            height:100%;
                            overflow:scroll;
                            scrollbar-width: none;
                        }

                        .main_content{
                            position: relative; float: right;
                        }

                        #collapse_sidebar{
                            display: none;
                        }

                        @media only screen and (max-width: 991px)  {
                            .main_content{
                                width: 100% !important;
                            }
                            .navbar-brand{
                                margin-left: 50px !important;
                            }
                            .navbar .navbar-toggler{
                                margin-top:7px;
                                z-index: 1000;
                                background: #c5c5d2;
                                color: white;
                                padding: 5px;
                            }
                        }

                        @media only screen and (max-width: 700px)  {
                            #user-settings-overlay{
                                display: none !important;
                            }
                            #clock{
                                display: none !important;
                            }

                            #avatar-upload{
                                display: none !important;
                            }
                            .help_tooltip{
                                display: none !important;
                            }

                            .sidebar{
                                /*width: 18% !important;*/
                                width: 260px !important;
                            }
                        }

                        @media only screen and (min-width: 992px)  {
                            .sidebar{
                                width: 18% !important;
                            }

                            .main_content{
                                width: 82% !important;
                            }
                        }

                        .nav-open .sidebar{
                            left:0px !important;
                            z-index: 10;
                        }

                        .sidebar{
                            background: white !important;
                        }
                    </style>
                    <!--full menu start-->
<div class="sidebar p-0">
                        <!--menu left side start-->
                        <div class="left1 theme_color_bg" align="center">
<!--                            <br/>
                            <br/>-->
                            <ul class="ul1 pt-2">
                                <li class="li1 active-icon">
                                    <b></b>
                                    <b></b>
                                    <a href="#"><i class="fas fa-store"></i></a>
                                </li>
                                <div style="height: 14px;"></div>

                                 <li class="li1">

                                         <a href="#" class="menu-moule-icon" style="padding: 0px;    line-height: 0.0em !important;">

                                             <i class=""></i>

                                         </a>



                                     <ul class="ul2">
                                         <li class="li2"></li>
                                     </ul>
                                 </li>


                            </ul>

                            <br/>
                            <br/>

                        </div>


                        <!--menu right side start-->
                        <div class="right1" align="right">
                            <!--image start-->
							<a href="../../../login/pages/main/index.php">
								<div  class="title-image " style="padding-top: 5px !important;">
									<img src="../../../logo/clouderplogo.png" style="width:65%;" height="45px">
								</div>
							</a>

                            <!--menu and dropdown menu start-->
                            <h1 id="title_text" class="module-title pt-2">Super Panel</h1>
                            <div class="menu_bg" align="center">
            

                        <div class="dashboard1-nav-dropdown">
                           <a class="dashboard1-nav-item  dashboard1-nav-dropdown-toggle"><i class="fas fa-clipboard-list"></i> Dashboard </a>
                                 <div class="dashboard1-nav-dropdown-menu">
								   <a href="home.php" class="dashboard1-nav-dropdown-item">Dashboard</a>
								</div>
						</div>
						
						
                        <div class="dashboard1-nav-dropdown">
                           <a class="dashboard1-nav-item  dashboard1-nav-dropdown-toggle"><i class="fas fa-clipboard-list"></i> General Section </a>
                                 <div class="dashboard1-nav-dropdown-menu">
								   <a href="company.php" class="dashboard1-nav-dropdown-item">Company Info</a>
								   <a href="database.php" class="dashboard1-nav-dropdown-item">Database Info</a>								   
								   <a href="create_database.php" class="dashboard1-nav-dropdown-item">Add Database</a>
								   <a href="module.php" class="dashboard1-nav-dropdown-item">Module Access</a>							
								</div>
						</div>
						
						
                        <div class="dashboard1-nav-dropdown">
                           <a class="dashboard1-nav-item  dashboard1-nav-dropdown-toggle"><i class="fas fa-clipboard-list"></i> Company Audit Info </a>
                                 <div class="dashboard1-nav-dropdown-menu">
								   <a href="template.php" class="dashboard1-nav-dropdown-item">Template Config </a>
								   <a href="system_check.php" class="dashboard1-nav-dropdown-item">Stock Check</a>
								   <a href="system_check_finance.php" class="dashboard1-nav-dropdown-item">Stock Value Check</a>
								   <a href="system_check_acc.php" class="dashboard1-nav-dropdown-item">Stock Check Account</a>
								   <a href="system_cr_dr_check.php" class="dashboard1-nav-dropdown-item">System Cr Dr Check</a>
								   <a href="system_stock_error_log.php" class="dashboard1-nav-dropdown-item">System Daily Error Log Stock </a>
								   <a href="system_finance_error_log.php" class="dashboard1-nav-dropdown-item"> System Daily Error Log Stock Value</a>
								   <a href="system_acc_error_log.php" class="dashboard1-nav-dropdown-item">System Daily Error Log Account </a>
								   <a href="system_cr_dr_error_log.php" class="dashboard1-nav-dropdown-item">System Daily Error Log Cr Dr </a>
								</div>
						</div>
						
						<div class="dashboard1-nav-dropdown">
                           <a class="dashboard1-nav-item  dashboard1-nav-dropdown-toggle"><i class="fas fa-clipboard-list"></i> All Report </a>
                                 <div class="dashboard1-nav-dropdown-menu">
								   <a href="report.php" class="dashboard1-nav-dropdown-item">Information Report </a>
								</div>
								 <div class="dashboard1-nav-dropdown-menu">
								   <a href="stockCheck.php" class="dashboard1-nav-dropdown-item">Mastesr Report </a>
								</div>
						</div>
						
						<div class="dashboard1-nav-dropdown">
                           <a class="dashboard1-nav-item  dashboard1-nav-dropdown-toggle"><i class="fas fa-clipboard-list"></i> Exit Program </a>
                                 <div class="dashboard1-nav-dropdown-menu">
								   <a href="../main/logout.php" class="dashboard1-nav-dropdown-item">Log Out</a>
								</div>
						</div>
						
						
						
						
</div>
</div>
</div>


<script>
    const currentLocation = location.href;
    const menuItem = document.querySelectorAll('.dashboard1-nav-dropdown-menu a');

    const menuLength = menuItem.length
    var element = document.querySelector('.dashboard1-nav-dropdown');


    for (let i=0; i<menuLength; i++){
        if(menuItem[i].href === currentLocation){
            menuItem[i].classList.add('active1')

            var parentDiv = menuItem[i].parentNode;
            var parentDiv2 = parentDiv.parentNode;
            parentDiv2.classList.add('show')

        }
    }


</script>






