<?
session_start();
require_once "../../../assets/support/inc.all.php";

//add_user_activity_log($_SESSION['user']['id'],1,1,'LogOut Page','Successfully LogOut In SCB',$_SESSION['user']['level']);
session_destroy();
header("Location: ../../index.php");
?>
