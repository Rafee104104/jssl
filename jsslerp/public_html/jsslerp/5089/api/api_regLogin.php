<?php
require_once "api_dbc.php";

@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');

$json = file_get_contents('php://input');

// Decode JSON data
$data = json_decode($json, true);
$username = $data['username'];
$password = $data['password'];


    $sql = 'select id, username from regUser where username="'.$username.'" and password="'.$password.'"';
    $query = mysql_query($sql);
    $row = mysql_fetch_assoc($query);
    $num_rows = mysql_num_rows($query);
    if($num_rows == 1){
        // generate token using hash_hmac function
        $token = hash_hmac('sha256', $row->user_name.time(), '_sadf45%kamrul');

        $insql = "UPDATE regUser set token='$token' where id=".$row->id."";
        $inquery = mysql_query($insql);

        $msg = array("code" => 200, "msg" => "Login Successful", "token" => $token);
        echo json_encode($msg, JSON_PRETTY_PRINT);
        exit;
    }else{
        $msg = array("code" => 401, "msg" =>$username.$password."Invalid username or password");
        echo json_encode($msg, JSON_PRETTY_PRINT);
        exit;
    }

?>











