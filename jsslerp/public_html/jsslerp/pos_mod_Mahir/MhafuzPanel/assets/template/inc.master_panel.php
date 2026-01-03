<?
if($_GET[mod_id]>0)
$_SESSION['mod'] = $_GET[mod_id];
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<title><?=$module_name.' '.PROJECTS?></title>
<meta name="Developer" content="Md. Mhafuzur Rahman Cell:01815-224424 email:mhafuz@yahoo.com" />

<?
require_once "../../assets/support/inc.all.js_1.php";
require_once "../../assets/support/inc.all.css_1.php";
echo $header_add;
?>


</head>
<body>

<div class="wrapper">
			<div class="body_box">

<? include("../../template/main_panel_menu.php");?>




<div class="main_content"  style="position: relative; width:82.5%; float: right;">


<?

require_once "../../assets/template/inc.header_master_panel.php";

?>		  











<div class="sr-main-content">
<div class="sr-main-content-padding titel-text">
<div class="sr-main-content-heading"> <i class="fa fa-database" style="padding-right:10px;"></i><?=$title?>

<? if($add_button_bar=='Mhafuz'){?>

<div style="float:right; margin-top: -14px;">

		<!--<a href="<?=$input_page?>" rel = "gb_page_center[940, 600]"><button name="insert" accesskey="S" class="btn" value="Add New" type="button">Add New</button></a>-->

		<a href="<?=$input_page?>"><button name="insert" accesskey="S" class="btn btn-primary" value="Add New" type="button">Add New</button></a>

		<button name="reset" class="btn btn-info" type="button" onClick="parent.location='<?=$page?>'" value="Clear">Refresh</button>

		</div>

		<? }?>



</div>

</div>



<div class="sr-main-content-padding">
<br>

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