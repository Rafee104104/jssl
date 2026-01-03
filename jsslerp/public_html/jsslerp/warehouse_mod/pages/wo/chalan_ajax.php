<?php
session_start();
require_once "../../../assets/template/layout.top.php";
@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
   echo  $chalan_date = $_POST['chalan_date'];
   //$endDate = date('Y-m-d', strtotime($chalan_date . ' +7 days')); 

   // echo $endDate;
	
}



?>


 



