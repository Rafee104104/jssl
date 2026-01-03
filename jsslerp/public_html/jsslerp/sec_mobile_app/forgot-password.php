<?php
session_start();
include 'config/db.php';
include 'config/function.php';


$problem=0;
$msg=0; $emsg=0;


if ($_POST['username'] && $_POST['mobile'] && $_POST['rsm']){

$username		=$_POST['username'];
$mobile			=$_POST['mobile'];
$rsm			=$_POST['rsm'];


$user_info=findall('select * from personnel_basic_info where PBI_ID="'.$username.'" and PBI_JOB_STATUS="In Service"');
$check_mobile=$user_info->PBI_MOBILE;
if($check_mobile!=$mobile) $problem=1;

$sql_rsm='select PBI_ID from personnel_basic_info 
where PBI_DESIGNATION="RSM" and PBI_GROUP="'.$user_info->PBI_GROUP.'" and PBI_BRANCH="'.$user_info->PBI_BRANCH.'" and PBI_JOB_STATUS="In Service" ';
$check_rsm=find1($sql_rsm);
if($check_rsm!=$rsm) $problem=1;


/*$last_request=find1('select last_recovery from ss_user where username="'.$username.'" ');
$t_date = date('Y-m-d');
$datetime1 = new DateTime($t_date);
$datetime2 = new DateTime($last_request);
$interval = $datetime1->diff($datetime2);
echo 'Last day='.$last_date= $interval->format('%y years<br>%m mon <br>%d days');
if($last_date<30) $problem=1;*/


	if($problem==0){
		$pass=find1('select password from ss_user where username="'.$username.'"');
		$text='Your 2nd Sales App P_a_s_s_word is: '.$pass.'. Thanks Sajeeb Group';
		
		gpsms($mobile,$text);
		//echo 'sms send ok';
		$msg='Your Pssword will send to your mobile. Please Check';
		
		$sql_update='update ss_user set last_recovery="'.date('Y-m-d').'" where username="'.$username.'"  ';
		mysqli_query($conn, $sql_update);
	}

if($problem==1){
$msg='Your given information is not match to our system.
<br>Plz Contact Head Office MIS TEAM.
<br><br><a href="index.php">Go To Login Page</a>
';
}


//echo 'reset submit ok. problem='.$problem;
} // end reset submit
?>




<!doctype html>
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
                <h2 class="mb-4"><span class="text-secondary fw-light">Forget your</span><br />Password?</h2>
<p class="text-secondary mb-4">Provide below information and submit reset button.</p>
                
				
				<div class="form-group form-floating mb-3 is-valid">
                    <input type="number" class="form-control" name="username" value="<?php echo $_COOKIE['user_2sales'];?>" id="username" >
                    <label class="form-control-label" for="email">Your Employee Code</label>
                </div>

                <div class="form-group form-floating is-valid mb-3">
                    <input type="number" class="form-control" name="mobile" id="mobile" value="8801" >
                    <label class="form-control-label" for="mobile">Your Mobile Number</label>
                </div>
				
				
                <div class="form-group form-floating is-valid mb-3">
                    <input type="number" class="form-control" name="rsm" id="rsm" value="" >
                    <label class="form-control-label" for="rsm">Your RSM Employee Code</label>
                </div>				

     </div>
	 
<? if($msg!=''){ ?>
            <div class="col-11 col-sm-11 mt-auto mx-auto py-4">
                <div class="row ">
                    <div class="col-12 d-grid">
                        <!--<button type="submit" name="reset" class="btn btn-default btn-lg btn-rounded shadow-sm">RESET PASSWORD</button>-->
						<?=$msg?>
                    </div>
                </div>
            </div>	 
<? }?>	 
	 
	 
	 
<? if($msg==''){ ?>	 
            <div class="col-11 col-sm-11 mt-auto mx-auto py-4">
                <div class="row ">
                    <div class="col-12 d-grid">
                        <button type="submit" name="recovery" id="recovery" class="btn btn-default btn-lg btn-rounded shadow-sm">RESET PASSWORD</button>
                    </div>
                </div>
            </div>
			
			
        </div>


            <div class="col-11 col-sm-11 mt-auto mx-auto py-4">
                <div class="row ">
                    <div class="col-12 d-grid">
                        <center>Developed BY: Sajeeb Group</center>
                    </div>
                </div>
            </div>
<? }?>


       
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
    


</body>

</html>