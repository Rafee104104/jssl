<?php
require_once "api_dbc.php";

@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');

$json = file_get_contents('php://input');
$obj = json_decode($json, true);

$name = $obj['name'];
$username = $obj['username'];
$password = $obj['password'];

$name = mysql_real_escape_string($name);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);

if($name == "" || $username == "" || $password == ""){
    $msg = "Please fill all the fields";
    echo json_encode($msg, JSON_PRETTY_PRINT);
    exit;
}else{
    
        $insql = "INSERT INTO regUser(name, username, password) 
            values('$name', '$username', '$password')";
        $inquery = mysql_query($insql);

        $msg = array("code" => 200, "msg" => "Registration Successful");
        echo json_encode($msg, JSON_PRETTY_PRINT);
        exit;
   
    }
?>











