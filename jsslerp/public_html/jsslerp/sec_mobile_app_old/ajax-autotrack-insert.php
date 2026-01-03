<?
session_start();

include 'config/db.php';

include 'config/function.php';

include 'config/access.php';



$now_stamp    = date("Y-m-d H:i:s");
$expStap = $_SESSION['expStap'];
$nowStap = strtotime($now_stamp);
$totalStap = ($expStap-$nowStap);
if($totalStap<0){
	$_SESSION['expStapDate'] = date('Y-m-d H:i:s', strtotime("+5 min"));
	$_SESSION['expStap'] = strtotime($_SESSION['expStapDate']);
	if(abs($_POST['lat'])>0 and abs($_POST['long'])>0){
		echo $insert = 'insert into user_location_tracking set 
		user_id="'.$_SESSION['user_id'].'",
		date="'.date('Y-m-d').'",
		latitude="'.$_POST['lat'].'",
		longitude="'.$_POST['long'].'",
		script_time="'.$_SESSION['expStapDate'].'"
		 ';
		 $conn->query($insert);
	}
	
}




echo $totalStap;
 ?>


