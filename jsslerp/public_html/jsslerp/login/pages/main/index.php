<?php
session_start();

$msg = "";
$cid = 'jssl';

/* error show for debug */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/* include login function */
$loginFile = "../../../assets/support/inc.login.php";

if(file_exists($loginFile)){
    require_once $loginFile;
}else{
    die("Login support file not found!");
}


/* LOGIN PROCESS */
if(isset($_POST['ibssignin'])){

    $uid = isset($_POST['uid']) ? trim($_POST['uid']) : '';
    $pass = isset($_POST['pass']) ? $_POST['pass'] : '';

    if($uid == "" || $pass == ""){
        $msg = "User ID and Password required!";
    }else{

        $password = md5($pass); // existing system using md5

        if(function_exists('check_for_login')){

            if(check_for_login($cid,$uid,$password,1)){

                header("Location: ../../../login/pages/main/home.php");
                exit();

            }else{

                session_destroy();
                $msg = "Invalid Login Information!!!";

            }

        }else{

            die("Function check_for_login() not found in inc.login.php");

        }

    }

}


/* TEMPLATE LOAD */

$template = "../../../assets/template/login_interface.php";

if($cid == 'robi' || $cid == 'mark' || $cid == 'mamun' || $cid == 'dailyrice' || $cid == 'uniocean' || $cid == 'vcon' || $cid == 'visiontouch' || $cid == 'visionfin'){
    
    $template = "../../../assets/template/login_interface1.php";

}elseif($cid == 'rahimgroup'){

    $template = "../../../assets/template/login_interface_rahimgroup.php";

}elseif($cid == 'starline'){

    $template = "../../../assets/template/login_interface_starline.php";

}elseif($cid == 'radisson'){

    $template = "../../../assets/template/login_interface_radisson.php";

}


include $template;

?>