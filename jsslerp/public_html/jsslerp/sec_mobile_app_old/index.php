<!DOCTYPE html>
<html lang="en" class="h-200">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Secondary Sales</title>

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

    <!-- style css for this template -->
    <link href="assets/scss/style.css" rel="stylesheet" id="style">
</head>


<?php
session_start();
include 'config/db.php';
include 'config/function.php';

$ip = $_SERVER['REMOTE_ADDR'];  

$app = findall("select * from ss_config where id=1");
if($app->app_status==0){ die($app->app_status_notice);}

$emsg='';


if ($_POST['username'] && $_POST['password']){

$username = validation($_POST['username']);
$password = validation($_POST['password']);


//$ip  		= $_POST['ipss'];
$latitude  	= $_POST['latitude'];
$longitude  = $_POST['longitude'];

$country    = $_POST['country'];
$state      = $_POST['state'];
$city       = $_POST['city'];
					
		
$sql2="SELECT * FROM ss_user WHERE username='$username' and status='Active' ";
		
		$query = mysqli_query($conn, $sql2);
		$numrows = mysqli_num_rows ($query);
		if($numrows !=0){
		
		while ($row = mysqli_fetch_assoc($query))
			{
			
			$dbuser_id          = $row['user_id'];
			$dbusername         = $row['username'];
			$dbpassword         = $row['password'];
			$dbfullname         = $row['fname'];

			$dbpg      		    = $row['product_group'];
			$dbregion_id        = $row['region_id'];
			$dbzone_id          = $row['zone_id'];
			$dbarea_id          = $row['area_id'];
			$dbdealer_code      = $row['dealer_code'];
			
			}
		
		if ($username==$dbusername && $password==$dbpassword){
			
// 	ss_location_log
$type='SO Login';
location_save($type,$username,$ip,$latitude,$longitude,$country,$state,$city);
				
				
				$_SESSION['user_id']        =$dbuser_id;
				$_SESSION['username']       =$dbusername;	
				$_SESSION['name']           =$dbfullname;
				$_SESSION['product_group']  =$dbpg;
				$_SESSION['region_id']  	=$dbregion_id;
				$_SESSION['zone_id']  		=$dbzone_id;
				$_SESSION['area_id']  		=$dbarea_id;
				$_SESSION['warehouse_id']   =$dbdealer_code;
				$_SESSION['palkey']	        ='mep2ndsales22';
				

setcookie('user_2sales',$dbusername,time()+60*60*360);
setcookie('pass_2sales',$dbpassword,time()+60*60*360);

?><script>window.location.href = "home.php";</script><?
				
				
			}
			else 
				$emsg= "Incorrect password";
			}
			
			else
				$emsg= "Employee Code Missing";



}
?>


<body class="body-scroll d-flex flex-column h-100 theme-pink" data-page="signin" onload="getLocation()">

    <!-- Header -->
    <header class="header position-fixed header-filled">
        <div class="row">
            <div class="col">
                <div class="logo-small">
                    <img src="assets/img/logo.png" alt="" class="rounded-circle" />
                    <h5>Secondary<br /><span class="text-secondary fw-light">Sales</span></h5>
                </div>
            </div>
            <div class="col-auto">
                <a href="#signup.php" target="_self">
                    <!--Sign up-->
                </a>
            </div>
        </div>
    </header>
    <!-- Header ends -->

<!-- Begin page content -->
<main class="container-fluid h-100 ">

<form action="" method="POST" class="form-fill">
        <div class="row h-100">
            <div class="col-11 col-sm-11 col-md-6 col-lg-5 col-xl-3 mx-auto align-self-center py-4">
                <h2 align="center" class="mb-4"><span class="text-secondary fw-light">Sign in to </span><br />Secondary Sales</h2>
                <div class="form-group form-floating mb-3 is-valid">
                    <input type="number" class="form-control" name="username" 
					value="<?php echo $_COOKIE['user_2sales'];?>" id="username" placeholder="Employee Code">
                    <label class="form-control-label" for="email">Employee Code</label>
                </div>

                <div class="form-group form-floating is-invalid mb-3">
                    <input type="password" pattern="[0-9]*" inputmode="numeric" class="form-control" name="password" id="password" 
					value="<?php echo $_COOKIE['pass_2sales'];?>" placeholder="Password">
                    <label class="form-control-label" for="password">Password</label>
                    <button type="button" class="text-danger tooltip-btn" data-bs-toggle="tooltip" data-bs-placement="left" title="Enter valid Password" id="passworderror">
                        <i class="bi bi-info-circle"></i>
                    </button>
                </div>
     <!--           <p class="mb-3 text-end">-->
     <!--               <a href="forgot-password.php" class="">Forgot your password?</a><br>-->
					<!--<a href="index_DSR.php" class="">DSR Login</a>-->
     <!--           </p>-->
            </div>

<? if($emsg!=''){ ?><div class="alert alert-danger text-center" role="alert"><strong><?=$emsg;?></strong></div> <? } ?>
			
            <div class="col-11 col-sm-11 mt-auto mx-auto  py-4">
                <div class="row ">
                    <div class="col-12 d-grid">
                        <button type="submit" class="btn btn-primary  btn-lg btn-rounded shadow-sm" id="login">Sign In</button>
                    </div>
                </div>
<div class="row">
<center>
    <br>
    <br>
    <span style="color:#0d6efd"><strong style="color:#999">Developed BY:</strong> ERP.COM.BD</span>
    <p style="margin: 0px;padding: 0px; padding-top: 10px; color: #ff1930; font-weight: 600;font-size: 20px;"><strong>Help Line</strong></p>
    <p style="margin: 0px;padding: 0px;"><a style="color:#0d6efd"  href="mailto:ceo@erp.com.bd"><i class="bi bi-envelope"></i> ceo@erp.com.bd</a> </p>
    <p style="margin: 0px;padding: 0px;"><a style="color:#0d6efd" href="tel:+8801815224424"><i class="bi bi-telephone"> </i> +880 1815224424</a> </p>


</center>
</div>
</div>
			
			
        </div>


<p>
				<!--<input type="text" name="ipss" id="ipss" value="">-->
				<input type="hidden" name="country" id="country"  value="" readonly="">
				<input type="hidden" name="state" id="state"  value="" readonly="">
				<input type="hidden" name="city" id="city"  value="" readonly="">
				
				<input type="hidden" name="latitude" id="latitude"  value="" readonly="">
				<input type="hidden" name="longitude" id="longitude"  value="" readonly="">        
</form>





</main>


    <!-- Required jquery and libraries -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
<!--    <script src="assets/js/popper.min.js"></script>-->
<!--    <script src="assets/vendor/bootstrap-5/js/bootstrap.bundle.min.js"></script>-->

    <!-- Customized jquery file  -->
    <script src="assets/js/main.js"></script>
<!--    <script src="assets/js/color-scheme.js"></script>-->

    <!-- PWA app service registration and works -->
    <!--<script src="assets/js/pwa-services.js"></script>-->

    <!-- page level custom script -->
<!--    <script src="assets/js/app.js"></script>-->
    





<script>
// var x = document.getElementById("demo");
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}
function showPosition(position) {
//   x.innerHTML = "Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude;
  
  document.getElementById("latitude").value = position.coords.latitude;
  document.getElementById("longitude").value = position.coords.longitude;
  
}
</script>

<!--Software developed by Faysal-->

<!--https://www.w3schools.com/html/tryit.asp?filename=tryhtml5_geolocation-->

</body>
</html>