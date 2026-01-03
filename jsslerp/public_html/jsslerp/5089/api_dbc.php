<?php
//$connection = mysql_connect($db_host, $db_user, $db_pass) or die("Database Connection Failed");

$servername = "localhost";
$username = "clouderp_apiUser";
$password = "clouderp_apiUser";
$dbname = "clouderp_developmentdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}







?>











