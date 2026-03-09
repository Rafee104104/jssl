<?php
require_once __DIR__ . '/mysql_compat.php';

$host = "localhost";
$user = "root";
$pass = "";
$db   = "jsslerp";

$GLOBALS['conn'] = mysqli_connect($host, $user, $pass, $db);

if (!$GLOBALS['conn']) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

/* Optional: set charset */
mysqli_set_charset($GLOBALS['conn'], "utf8");

?>
