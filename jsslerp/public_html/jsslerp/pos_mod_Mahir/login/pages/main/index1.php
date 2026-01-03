<? session_start();
require_once "../../../assets/support/inc.login.php";
$cid = explode('.', $_SERVER['HTTP_HOST'])[0];




if(isset($_COOKIE['clouderp'])){

	 $token=$_COOKIE['clouderp'];
	
	
if(check_for_login_cookie($cid,$token)){


header("Location:../../../login/pages/main/home.php");
exit;

	}else

	{
	

session_destroy();

$msg="Invalid Login Information!!!";

	}
	
}

if(isset($_POST['ibssignin']))
{

	$passward 	= $_POST['pass'];
	$uid  		= $_POST['uid'];
	 $cid  		= $_POST['cid'];

	if($cid=='sencillo'){
		die();
	}

if(check_for_login($cid,$uid,$passward,1)){

  //header("Location:index_varify.php");



header("Location:../../../login/pages/main/home.php");
exit;






}else

{

session_destroy();

$msg="Invalid Login Information!!!";

}
}


// if($cid == 'robi'){
// include '../../../assets/template/login_interface.php';
// }
// else{
// include '../../../assets/template/login_interface.php';
// }
 
include '../../../assets/template/login_interface1.php';

?>