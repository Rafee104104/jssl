<?php

//ini_set('display_errors', '1');

//ini_set('display_startup_errors', '1');

//error_reporting(E_ALL);

?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">



<title><?=$module_name.' '.PROJECTS?></title>

<meta name="Developer" content="Md. Mhafuzur Rahman Cell:01815-224424 email:mhafuz@yahoo.com" />

<?



require_once "../../../assets/support/inc.all.js.php";

require_once "../../../assets/support/inc.all.css.php";

echo $header_add;

?>





<style type="text/css">







.sidebar::before{

height: auto !important;

}



@media screen (max-width: 1023px) {



.main_content



{



position: relative;



float: left;



width: 100%;



}



.sidebar{width:50%;}



}















@media screen (max-width: 3000px) {



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











@media only screen and (max-width: 991px) {







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





.main_content{

      overflow-x: auto;

}





















}











@media only screen and (max-width: 700px) {











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















}











@media only screen and (min-width: 992px) {







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

</head>



<body>

<div class="wrapper">

			<div class="body_box">



					    <div class="body_middlebox_bar">













						<div class="sidebar" style=" height:100%; overflow:scroll;scrollbar-width: none;" >



						<div class="title-image text-center" style="padding: 5px;">

						<!--<img src="../../../logo/<?$_SESSION['proj_id']?>.jpg" style="width:67%;" />-->

						<img src="../../../logo/demo7.png" style="width:67%;">



						</div>



						<? include("../../template/main_layout_menu.php");?>



						</div>



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







var week = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];



var timerID = setInterval(updateTime, 1000);



updateTime();



function updateTime() {



    var cd = new Date();



    clock.time = zeroPadding(cd.getHours(), 2) + ':' + zeroPadding(cd.getMinutes(), 2) + ':' + zeroPadding(cd.getSeconds(), 2);



    clock.date = zeroPadding(cd.getFullYear(), 4) + '-' + zeroPadding(cd.getMonth()+1, 2) + '-' + zeroPadding(cd.getDate(), 2) + ' ' + week[cd.getDay()];



};







function zeroPadding(num, digit) {



    var zero = '';



    for(var i = 0; i < digit; i++) {



        zero += '0';



    }



    return (zero + num).slice(-digit);



}



</script>

  <script>

  

  new Morris.Line({

  // ID of the element in which to draw the chart.

  element: 'myfirstchart',

  // Chart data records -- each entry in this array corresponds to a point on

  // the chart.

  data: [

    { year: '2016', value:<?=find_a_field('journal','sum(dr_amt-cr_amt)','1 and ledger_id like "1086%"');?> },

    { year: '2017', value: <?=find_a_field('journal','sum(cr_amt)','1 '); ?> },
    { year: '2018', value: <?=find_a_field('journal','sum(dr_amt-cr_amt)','1 and ledger_id like "1086000100010000"'); ?> },

    { year: '2019', value: 5 },

    { year: '2020', value: 20 }

  ],

  // The name of the data record attribute that contains x-values.

  xkey: 'year',

  // A list of names of data record attributes that contain y-values.

  ykeys: ['value'],

  // Labels for the ykeys -- will be displayed when you hover over the

  // chart.

  labels: ['Value']

});





<!--/////////////2nd chart//////////////////-->


//
// new Morris.Donut({
//
//  // ID of the element in which to draw the chart.
//
//  element: 'myfirstchart2',
//
//  // Chart data records -- each entry in this array corresponds to a point on
//
//  // the chart.
//
//  data:  [
//
//
//
//
//
//            {
//
//            label: "<?php //echo Incomes .' '. Tk;?>//",
//
//            value: <?//=($IncomeOverall>0)?$IncomeOverall:0;?>//},
//
//            {
//
//            label: "<?php //echo Expenses .' '. Tk;?>//",
//
//            value: <?//=($IncomeOverall>0)?$BillsOverall:0;?>//}
//
//       ],
//
//  // The name of the data record attribute that contains x-values.
//
//  xkey: 'year',
//
//  // A list of names of data record attributes that contain y-values.
//
//  ykeys: ['value'],
//
//  // Labels for the ykeys -- will be displayed when you hover over the
//
//  // chart.
//
//  labels: ['Value']
//
//});





<!--/////////////3rd chart//////////////////-->


//
// new Morris.Area({
//
//  // ID of the element in which to draw the chart.
//
//  element: 'myfirstchart3',
//
//  // Chart data records -- each entry in this array corresponds to a point on
//
//  // the chart.
//
//  data: [
//
//    { year: '2016', value: <?php //echo 500; ?>// },
//
//    { year: '2017', value: 300 },
//
//    { year: '2018', value: 5 },
//
//    { year: '2019', value: 5 },
//
//    { year: '2020', value: 200 }
//
//  ],
//
//  // The name of the data record attribute that contains x-values.
//
//  xkey: 'year',
//
//  // A list of names of data record attributes that contain y-values.
//
//  ykeys: ['value'],
//
//  // Labels for the ykeys -- will be displayed when you hover over the
//
//  // chart.
//
//  labels: ['Value']
//
//});





//<!--/////////////4TH chart//////////////////-->
//
//
//
// new Morris.Bar({
//
//  // ID of the element in which to draw the chart.
//
//  element: 'myfirstchart4',
//
//  // Chart data records -- each entry in this array corresponds to a point on
//
//  // the chart.
//
//  data: [
//
//    { year: '2016', value: <?php //echo 500; ?>// },
//
//    { year: '2017', value: 300 },
//
//    { year: '2018', value: 523 },
//
//    { year: '2019', value: 680 },
//
//    { year: '2020', value: 201 }
//
//  ],
//
//  // The name of the data record attribute that contains x-values.
//
//  xkey: 'year',
//
//  // A list of names of data record attributes that contain y-values.
//
//  ykeys: ['value'],
//
//  // Labels for the ykeys -- will be displayed when you hover over the
//
//  // chart.
//
//  labels: ['Value']
//
//});











</script>

			

			

			















</body>

</html>



