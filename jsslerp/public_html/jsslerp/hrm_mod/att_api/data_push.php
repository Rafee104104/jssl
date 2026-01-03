<?php

session_start();

ob_start();



//error_reporting(E_ALL);

//ini_set('display_errors', '1');



//require_once "../../config/inc.all.php";



//$mysqli = new mysqli("localhost","user","password","database");



$mysqli = new mysqli("localhost","clouderp_robi_mamun_att","robi_mamun_att","clouderp_robi_mamundb");



if ($mysqli -> connect_errno) {

  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;

  exit();

}



 $ztime = $_REQUEST['ztime'];

 $bizid = $_REQUEST['bizid'];

 $xaction =$_REQUEST['xaction'];

 $xlocationid = $_REQUEST['xlocationid'];

 $xenrollid = $_REQUEST['EMP_CODE'];

 $xmechineid = $_REQUEST['xmechineid'];

 $xdate = $_REQUEST['xdate'];

 $xtime =$_REQUEST['xtime'];

 $time = $_REQUEST['time'];

 

 //$EMP_CODE = $_REQUEST['EMP_CODE'];

 //$_REQUEST['EMP_CODE'] = 12;


 
 $sql2 = "SELECT PBI_ID  FROM personnel_basic_info WHERE MACHINE_ID='".$_REQUEST['EMP_CODE']."'";
$result2 = $mysqli->query($sql2); 

while($row = mysqli_fetch_object($result2)) {
     $EMP_CODE = $row->PBI_ID;
  }
  

 

 if($ztime!=''){

     $sql = 'INSERT INTO hrm_attdump(bizid,xenrollid,xlocationid,xmechineid,xdate,xtime,time,EMP_CODE) VALUES

	

	 ( "'.$bizid.'", "'.$xenrollid.'", "'.$xlocationid.'",  "'.$xmechineid.'", "'.$xdate.'", "'.$xtime.'", "'.$time.'",  "'.$EMP_CODE.'" )';

	

    $result = $mysqli->query($sql); 

    echo 'successfully inserted  :'.$bizid.' : '.$ztime;

    

 }

?>