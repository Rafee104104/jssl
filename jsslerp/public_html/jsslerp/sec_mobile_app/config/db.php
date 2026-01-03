<?php
error_reporting(0);

date_default_timezone_set('Asia/Dhaka');

$servername = "localhost";

$username = "root";
$password = "";
$dbname = "jsslerp";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



define("DEVELOPER", "ERP.COM.BD");
?>