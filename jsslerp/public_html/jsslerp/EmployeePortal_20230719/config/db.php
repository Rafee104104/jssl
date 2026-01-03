<?php

//define('SERVER_ENGINE','../../../../../../controller/clouderp/controller/');
//
//require_once SERVER_ENGINE."tools/mod.php"; 

if($_SESSION['dbName']==''){
$ser=explode(".cl",$_SERVER['HTTP_HOST']) ;
$cid=$ser[0];

//echo $name=find_a_field('user_activity_management','username','user_id="10001"');

@mysql_connect('localhost', 'root', '');
@mysql_select_db('jsslerp');
$sql='select id from company_info where cid="'.$cid.'"';
$query=mysql_query($sql);
$row=mysql_fetch_row($query);
if($row[0]!=''){
    
  $dsql='select db_name,db_user,db_pass from database_info where company_id='.$row[0].'';
 $dquery=mysql_query($dsql);
 $data=mysql_fetch_object($dquery);
    $_SESSION['dbName']=$data->db_name;
    $_SESSION['dbuser']=$data->db_user;
    $_SESSION['dbPass']=$data->db_pass;
 
}else{
    
    die();
}
}
date_default_timezone_set('Asia/Dhaka');



//$conn = mysqli_connect("localhost","jahirgrouperp_erp_mobile_apps","jahir224424","jahirgrouperp_masterbd");



//$conn = mysqli_connect("localhost", $_SESSION['dbuser'], $_SESSION['dbPass'], $_SESSION['dbName']);
$conn = mysqli_connect("localhost", "root", "", "jsslerp");



// Check connection

if (mysqli_connect_errno()) {

  echo "Failed to connect to MySQL: " . mysqli_connect_error();

  exit();
}
