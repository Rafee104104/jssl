<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<title><?=$module_name.' '.PROJECTS?></title>
<meta name="Developer" content="Md. Mhafuzur Rahman Cell:01815-224424 email:mhafuz@yahoo.com" />

<?
require_once "../../../assets/support/inc.all.js_1.php";
require_once "../../../assets/support/inc.all.css_1.php";
echo $header_add;
?>


</head>
<body>

<div class="wrapper">
			<div class="body_box">
                <?php
                $sql = "SELECT * FROM config_template WHERE status=1";
                $template = mysql_query($sql);
                $temp = mysql_fetch_object($template);

                if($temp->template_id==1){?>

                    <style type="text/css">

                        .silverheader,.submenu{
                            text-align: left !important;
                        }
                        .menu_bg{
                            margin-top:0px !important;
                        }
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

                        .ol{
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
                        /*user agent stylesheet*/
                        ol {
                            display: block;
                            list-style-type: decimal;
                            margin-block-start: 1em;
                            margin-block-end: 1em;
                            margin-inline-start: 0px;
                            margin-inline-end: 0px;
                            padding-inline-start: 40px;
                        }

                        #clock {
                            display:block;
                            font-family: 'Share Tech Mono', monospace;
                            color: #000000 !important;
                            text-align: center;
                            padding-left:10px;
                            text-shadow: 0 0 10px rgba(10, 175, 230, 1),  0 0 10px rgba(10, 175, 230, 0);
                            line-height: 1;
                        }

                        #clock .time {
                            font-size: 28px;
                            padding: 1px 0;
                            font-weight:800;

                        }

                        #clock .date {
                            font-size: 9px !important;

                        }

                        #clock .text {
                            font-size: 12px;
                            padding: 1px 0;

                        }


                        #clock span{
                            display: block;
                        }

                        .sidebar::before, .off-canvas-sidebar nav .navbar-collapse::before{
                            height:auto!important;
                        }

                        @media only screen and (max-width: 1023px) {
                            .main_content {
                                position: relative;
                                float: left;
                                width: 100%;
                            }
                            .sidebar{width:50%;}
                        }


                        @media only screen and (max-width: 3000px) {
                            .main_content{
                                position: relative;
                                float:right;
                                width: 83%;
                            }

                            .sidebar{width:17%;}
                        }

                        .sidebar::-webkit-scrollbar {
                            width: .2em;
                            height: .0em;
                        }

                        .sidebar::-webkit-scrollbar-track {
                            box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
                        }

                        .sidebar::-webkit-scrollbar-thumb {
                            background-color: green;
                            outline: 1px solid slategrey;
                        }

                        .sidebar{
                            height:100%; overflow:scroll;scrollbar-width: none;
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
                                width: 260px !important;
                            }

                        }

                        @media only screen and (min-width: 992px)  {
                            .sidebar{
                                width: 17% !important;
                            }

                            .main_content{
                                width: 83% !important;
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

                    <div class="sidebar" style=" height:100%; overflow:scroll; scrollbar-width: none;" >
                        <div class="title-image text-center" style="padding: 5px;">
                            <span class="title-image text-center" style="padding: 5px;">
                                <img src="../../../logo/<?=$_SESSION['user']['group']?>.png" style="width:65%;"></span>
                            <? include("../../template/main_layout_menu.php");?>
                        </div>
                    </div>


                <?php
                }


                elseif($temp->template_id==2){?>


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
                                width: 18% !important;
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


                    //<!--full menu start-->
                    <div class="sidebar p-0">
                        <!--menu left side start-->
                        <div class="left1 theme_color_bg" align="center">
                            <br/>
                            <br/>
                            <ul class="ul1 pt-2">
                                <li class="li1 active-icon">
                                    <b></b>
                                    <b></b>
                                    <a href="#"><i class="fas fa-store"></i></a>
                                </li>
                                <li class="li1 mt-3">
                                    <a href="#"><i class="fas fa-users"></i></a>
                                    <ul class="ul2">
                                        <li class="li2">Purchase Module</li>
                                    </ul>
                                </li>
                                <li class="li1 mt-1">
                                    <a href="#"><i class="fas fa-calculator"></i></a>

                                    <ul class="ul2">
                                        <li class="li2">Account Module</li>
                                    </ul>


                                </li>

                                <li class="li1 mt-1"><a href="#"><i class="fas fa-wallet"></i></a>

                                    <ul class="ul2">
                                        <li class="li2"> Warehouse Module</li>
                                    </ul>

                                </li>

                                <li class="li1 mt-1"> <a href="#"><i class="fa fa-cubes"></i></a>

                                    <ul class="ul2">
                                        <li class="li2">HRM Module</li>
                                    </ul>

                                </li>
                                <li class="li1 mt-1"><a href="#"><i class="fas fa-briefcase"></i></a>
                                    <ul class="ul2">
                                        <li class="li2">MIS  Module</li>
                                    </ul>
                                </li>

                                <li class="li1 mt-1"><a href="#"><i class="fa fa-cubes"></i></a>

                                    <ul class="ul2">
                                        <li class="li2">Production Module</li>
                                    </ul>


                                </li>
                            </ul>

                            <br/>
                            <br/>

                            <footer>
                                <a href="../../../" class="help_tooltip" data-toggle="tooltip" data-placement="bottom" data-original-title="Signout">
                                    <i class="fas fa-power-off"></i>
                                </a>
                            </footer>
                        </div>


                        <!--menu right side start-->
                        <div class="right1" align="right">
                            <!--image start-->
                            <p class="title-image ">
                                <img src="../../../logo/<?=$_SESSION['user']['group']?>.png" style="width:65%;height: 40px;">
                            </p>

                            <!--menu and dropdown menu start-->
                            <h1 id="title_text" class="module-title" >Sales Module</h1>
                            <div class="menu_bg" align="center">

                                <div class="dashboard1-nav-dropdown">
                                    <a href="#" class="dashboard1-nav-item "><i class="fas fa-tachometer-alt"></i> Dashboard </a>
                                </div>


                                <div class="dashboard1-nav-dropdown">
                                    <a class="dashboard1-nav-item  dashboard1-nav-dropdown-toggle">
                                        <i class="fas fa-clipboard-list"></i>  Quotation </a>
                                    <div class="dashboard1-nav-dropdown-menu">
                                        <a href="#" class="dashboard1-nav-dropdown-item"> Quotation Create</a>
                                        <a href="#" class="dashboard1-nav-dropdown-item"> Draft Quotation</a>
                                        <a href="#" class="dashboard1-nav-dropdown-item"> Unapprove Quotation</a>
                                        <a href="#" class="dashboard1-nav-dropdown-item"> Quotation List</a>
                                    </div>
                                </div>



                                <div class="dashboard1-nav-dropdown">
                                    <a class="dashboard1-nav-item dashboard1-nav-dropdown-toggle">
                                        <i class="fas fa-user-tie"></i> Customer Info </a>
                                    <div class="dashboard1-nav-dropdown-menu">
                                        <a href="#" class="dashboard1-nav-dropdown-item">Add Customer</a>
                                        <a href="#" class="dashboard1-nav-dropdown-item">Opening Balance</a>
                                        <a href="#" class="dashboard1-nav-dropdown-item">Customer Report</a>
                                    </div>
                                </div>



                                <div class="dashboard1-nav-dropdown">
                                    <a class="dashboard1-nav-item dashboard1-nav-dropdown-toggle">
                                        <i class="fas fa-users"></i> Customer Statement </a>
                                    <div class="dashboard1-nav-dropdown-menu">
                                        <a href="#" class="dashboard1-nav-dropdown-item">Customer Statement</a>
                                    </div>
                                </div>



                                <div class="dashboard1-nav-dropdown">
                                    <a class="dashboard1-nav-item dashboard1-nav-dropdown-toggle">
                                        <i class="fas fa-location-arrow"></i>  Area Setup </a>
                                    <div class="dashboard1-nav-dropdown-menu">
                                        <a href="#" class="dashboard1-nav-dropdown-item"> Region</a>
                                        <a href="#" class="dashboard1-nav-dropdown-item"> Zone</a>
                                        <a href="#" class="dashboard1-nav-dropdown-item"> Territory</a>
                                    </div>
                                </div>



                                <div class="dashboard1-nav-dropdown">
                                    <a class="dashboard1-nav-item dashboard1-nav-dropdown-toggle">
                                        <i class="fas fa-gift"></i> Promotional Offer</a>
                                    <div class="dashboard1-nav-dropdown-menu">
                                        <a href="#" class="dashboard1-nav-dropdown-item"> Gift Offer</a>
                                        <a href="#" class="dashboard1-nav-dropdown-item"> Gift Offer Report</a>
                                    </div>
                                </div>


                                <div class="dashboard1-nav-dropdown">
                                    <a class="dashboard1-nav-item dashboard1-nav-dropdown-toggle">
                                        <i class="fas fa-luggage-cart"></i> Sales Order</a>
                                    <div class="dashboard1-nav-dropdown-menu">
                                        <a href="#" class="dashboard1-nav-dropdown-item"> New Sales Order</a>
                                        <a href="#" class="dashboard1-nav-dropdown-item"> Unfinished Sales Order</a>
                                        <a href="#" class="dashboard1-nav-dropdown-item"> Sales Order Status</a>
                                        <a href="#" class="dashboard1-nav-dropdown-item"> Unapproved SO List</a>
                                        <a href="#" class="dashboard1-nav-dropdown-item"> Sales Report</a>
                                        <a href="#" class="dashboard1-nav-dropdown-item"> Convert quotation to sales</a>
                                    </div>
                                </div>


                                <div class="dashboard1-nav-dropdown">
                                    <a class="dashboard1-nav-item dashboard1-nav-dropdown-toggle">
                                        <i class="fas fa-store"></i> Super Shop Sales</a>
                                    <div class="dashboard1-nav-dropdown-menu">
                                        <a href="#" class="dashboard1-nav-dropdown-item"> New Sales Order</a>
                                        <a href="#" class="dashboard1-nav-dropdown-item"> Unfinished Sales Order</a>
                                        <a href="#" class="dashboard1-nav-dropdown-item"> Sales Order Status</a>
                                        <a href="#" class="dashboard1-nav-dropdown-item"> Unapproved SO List</a>
                                        <a href="#" class="dashboard1-nav-dropdown-item"> Sales Report</a>

                                    </div>
                                </div>



                                <div class="dashboard1-nav-dropdown">
                                    <a class="dashboard1-nav-item dashboard1-nav-dropdown-toggle">
                                        <i class="fas fa-luggage-cart"></i> Modern Trade Sales</a>
                                    <div class="dashboard1-nav-dropdown-menu">
                                        <a href="#" class="dashboard1-nav-dropdown-item"> New Sales Order</a>
                                        <a href="#" class="dashboard1-nav-dropdown-item"> Unfinished Sales Order</a>
                                        <a href="#" class="dashboard1-nav-dropdown-item"> Sales Order Status</a>
                                        <a href="#" class="dashboard1-nav-dropdown-item"> Unapproved SO List</a>
                                        <a href="#" class="dashboard1-nav-dropdown-item"> Sales Report</a>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--full End start-->



                <?php
                }

                else{

                        echo "No records matching.";
                    }
                ?>


						<div class="main_content"  style="position: relative; width:82.5%; float: right;">


<?

require_once "../../../assets/template/inc.header.php";

?>		  











<div class="sr-main-content">

		  

<div class="sr-main-content-padding"><div class="sr-main-content-heading"><i class="fa fa-server" style="padding-right:10px;"></i><?=$title?>

<? if($add_button_bar=='Mhafuz'){?>

<div style="float:right; margin-top: -14px;">

		<!--<a href="<?=$input_page?>" rel = "gb_page_center[940, 600]"><button name="insert" accesskey="S" class="btn" value="Add New" type="button">Add New</button></a>-->

		<a href="<?=$input_page?>"><button name="insert" accesskey="S" class="btn btn-primary" value="Add New" type="button">Add New</button></a>

		<button name="reset" class="btn btn-info" type="button" onClick="parent.location='<?=$page?>'" value="Clear">Refresh</button>

		</div>

		<? }?>



</div></div>



<div class="sr-main-content-padding">

 <!--<h2 style="font-size:18px; font-weight: bold ; color: #73879C;  padding-bottom: 10px;"></h2>-->

 <?=$main_content?>

 

 <!-- Navbar -->

	  

	  

      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">

	  

	  

        

<div class="container-fluid">

        

		  

		  

          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">

            <span class="sr-only">Toggle navigation</span>

            <span class="navbar-toggler-icon icon-bar"></span>

            <span class="navbar-toggler-icon icon-bar"></span>

            <span class="navbar-toggler-icon icon-bar"></span>

          </button>

          

        </div>

      </nav>

      <!-- End Navbar -->

						</div>
</div>
                        </div>
            </div>
</div>
</div>
</div>




<!--   Core JS Files   -->
<!--  <script src="../../../dashboard_assets/js/core/jquery.min.js"></script>-->
  <script src="../../../dashboard_assets/js/core/popper.min.js"></script>
<!--<script src="../../../dashboard_assets/js/core/bootstrap-material-design.min.js"></script> -->
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
 <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>-->
  <!-- Chartist JS -->
  <script src="../../../dashboard_assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../../../dashboard_assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
 <script src="../../../dashboard_assets/js/material-dashboard-accounts.js?v=2.1.2" type="text/javascript"></script>  




  <!--///////////////////////////////////////////chart start values ////////////////////////////////////////////////////////////////-->

  <script language="javascript">
var clock = new Vue({
    el: '#clock',
    data: {
        time: '',
        date: ''
    }
});

var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];
var week = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
var timerID = setInterval(updateTime, 1000);
updateTime();
function updateTime() {
    var cd = new Date();
    clock.time =  zeroPadding(cd.getHours(), 2) + ' : ' + zeroPadding(cd.getMinutes(), 2) + ' : ' + zeroPadding(cd.getSeconds(), 2);
//    clock.date = zeroPadding(cd.getFullYear(), 4) + '-' + months[cd.getMonth()] + '-' + zeroPadding(cd.getDate(), 2) + ' ' + week[cd.getDay()];
    clock.date = week[cd.getDay()] + ','+' '+ zeroPadding(cd.getDate(), 2)+'.' + ' ' + months[cd.getMonth()] + ' ' + zeroPadding(cd.getFullYear(), 4);
};

function zeroPadding(num, digit) {
    var zero = '';
    for(var i = 0; i < digit; i++) {
        zero += '0';
    }
    return (zero + num).slice(-digit);
}
</script>

  

			

			

			
<!---->
<!--  <script language="javascript">-->
<!--var clock = new Vue({-->
<!--    el: '#clock',-->
<!--    data: {-->
<!--        time: '',-->
<!--        date: ''-->
<!--    }-->
<!--});-->
<!--var week = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];-->
<!--var timerID = setInterval(updateTime, 1000);-->
<!--updateTime();-->
<!--function updateTime() {-->
<!--    var cd = new Date();-->
<!--    clock.time = zeroPadding(cd.getHours(), 2) + ':' + zeroPadding(cd.getMinutes(), 2) + ':' + zeroPadding(cd.getSeconds(), 2);-->
<!--    clock.date = zeroPadding(cd.getFullYear(), 4) + '-' + zeroPadding(cd.getMonth()+1, 2) + '-' + zeroPadding(cd.getDate(), 2) + ' ' + week[cd.getDay()];-->
<!---->
<!--};-->
<!---->
<!--function zeroPadding(num, digit) {-->
<!--    var zero = '';-->
<!--    for(var i = 0; i < digit; i++) {-->
<!--        zero += '0';-->
<!--    }-->
<!--    return (zero + num).slice(-digit);-->
<!--}-->
<!--</script>-->
<!---->
<!--  -->
<!---->
<!--			-->
<!---->
<!--			-->
<!---->
<!--			-->



</body>
</html>