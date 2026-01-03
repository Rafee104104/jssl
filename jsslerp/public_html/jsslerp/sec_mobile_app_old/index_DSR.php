<?php
session_start();
include 'config/db.php';
include 'config/function.php';

$ip = $_SERVER['REMOTE_ADDR'];  

$emsg='';

if(isset($_COOKIE['user_2sales']) && isset($_COOKIE['pass_2sales'])){
	
	$_SESSION['user_2sales']=$_COOKIE['user_2sales'];
	setcookie('user_2sales',$_COOKIE['user_2sales'],time()+60*60*360);
	setcookie('pass_2sales',$_COOKIE['pass_2sales'],time()+60*60*360);

}



if ($_POST['username'] && $_POST['password']){

$username = validation($_POST['username']);
$password = validation($_POST['password']);


//$ip  		= $_POST['ipss'];
$latitude  	= $_POST['latitude'];
$longitude  = $_POST['longitude'];

$country  = $_POST['country'];
$state  = $_POST['state'];
$city  = $_POST['city'];
					
		
$sql2="SELECT u.*,p.region_id as region,p.zone_id as zone,p.area_code as area,p.product_group as p_group
FROM ss_user_dsr u, dealer_info p 
WHERE p.dealer_code=u.username and u.username='$username' and u.status='Active' and p.canceled='Yes'";
		
		$query = mysqli_query($conn, $sql2);
		$numrows = mysqli_num_rows ($query);
		if($numrows !=0){
		
		while ($row = mysqli_fetch_assoc($query))
			{
			
			$dbuser_id  = $row['id'];
			$dbusername = $row['username'];
			$dbpassword = $row['password'];
			$dbfullname = $row['fname'];
			//$dblevel    = $row['level'];
			//$dbcom      = $row['group_for'];
			$dbpg      		= $row['p_group'];
			$dbregion_id    = $row['region'];
			$dbzone_id      = $row['zone'];
			$dbarea_id      = $row['area'];
			
			}
		
				if ($username==$dbusername && $password==$dbpassword)
			{
			
// 	ss_location_log
$type='DSR Login';
location_save($type,$username,$ip,$latitude,$longitude,$country,$state,$city);
				
				
				$_SESSION['user_id']        =$dbuser_id;
				$_SESSION['username']       =$dbusername;	
				$_SESSION['name']           =$dbfullname;
				//$_SESSION['level']          =$dblevel;
				//$_SESSION['company_id']     =$dbcom;
				$_SESSION['product_group']  =$dbpg;
				$_SESSION['region_id']  	=$dbregion_id;
				$_SESSION['zone_id']  		=$dbzone_id;
				$_SESSION['area_id']  		=$dbarea_id;
				
				$_SESSION['warehouse_id'] = $dbusername;			
				
				$_SESSION['palkey']         ='my2ndSales22';
				$_SESSION['dsr_login']      ='YES';

setcookie('user_2sales',$dbusername,time()+60*60*360);
setcookie('pass_2sales',$dbpassword,time()+60*60*360);
				
/*			$log_sql="INSERT INTO user_activity_app_log(
			user_id,access_date,access_time,page_name,access_detail,ip,latitude,longitude)
			VALUES(
			'".$dbusername."',NOW(),NOW(),'Login_Page','APP-2Sales','".$ip."','".$latitude."','".$longitude."')";
			
			mysqli_query($conn,$log_sql);	*/                
				
				header("Location: home_DSR.php"); 			
				
				
			}
			else 
				$emsg= "Incorrect password";
			}
			
			else
				$emsg= "Incorrect Dealer Code";



}
?>

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

<body class="body-scroll d-flex flex-column h-100 theme-pink" data-page="signin">

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
                <h2 class="mb-4"><span class="text-secondary fw-light">Sign in to SAJEEB</span><br />DSR SALES</h2>
                <div class="form-group form-floating mb-3 is-valid">
                    <input type="number" class="form-control" name="username" 
					value="<?php echo $_COOKIE['user_2sales'];?>" id="username" placeholder="Dealer Code">
                    <label class="form-control-label" for="email">Dealer Code</label>
                </div>

                <div class="form-group form-floating is-invalid mb-3">
                    <input type="password" pattern="[0-9]*" inputmode="numeric" class="form-control" name="password" id="password" 
					value="<?php echo $_COOKIE['pass_2sales'];?>" placeholder="Password">
                    <label class="form-control-label" for="password">Password</label>
                    <button type="button" class="text-danger tooltip-btn" data-bs-toggle="tooltip" data-bs-placement="left" title="Enter valid Password" id="passworderror">
                        <i class="bi bi-info-circle"></i>
                    </button>
                </div>
                <p class="mb-3 text-end">
                    <a href="index.php" class="">
                        Back to Sales Officer Login Page
                    </a>
                </p>
            </div>

<? if($emsg!=''){ ?><div class="alert alert-danger text-center" role="alert"><strong><?=$emsg;?></strong></div> <? } ?>
			
            <div class="col-11 col-sm-11 mt-auto mx-auto py-4">
                <div class="row ">
                    <div class="col-12 d-grid">
                        <button type="submit" class="btn btn-default btn-lg btn-rounded shadow-sm">DSR Sign In</button>
                    </div>
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
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/vendor/bootstrap-5/js/bootstrap.bundle.min.js"></script>

    <!-- Customized jquery file  -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/color-scheme.js"></script>

    <!-- PWA app service registration and works -->
    <!--<script src="assets/js/pwa-services.js"></script>-->

    <!-- page level custom script -->
    <script src="assets/js/app.js"></script>
    

	<script>
	$.ajax({
		url: "https://geolocation-db.com/jsonp",
		jsonpCallback: "callback",
		dataType: "jsonp",
		success: function( location ) {	
			jQuery('#country').val(location.country_name);
			jQuery('#state').val(location.state);
			jQuery('#city').val(location.city);
			jQuery('#latitude').val(location.latitude);
			jQuery('#longitude').val(location.longitude);
			 
		}
	});		
    </script>

</body>

</html>