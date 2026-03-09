<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "jsslerp";

$conn = mysqli_connect($host,$user,$pass,$db);

if(!$conn){
    die("Database Connection Failed: " . mysqli_connect_error());
}

/* mysql compatibility */
function mysql_query($query){
    global $conn;
    return mysqli_query($conn,$query);
}

function mysql_fetch_object($result){
    return mysqli_fetch_object($result);
}

function mysql_fetch_array($result){
    return mysqli_fetch_array($result);
}

function mysql_num_rows($result){
    return mysqli_num_rows($result);
}

?>