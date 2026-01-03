<?php
require_once "api_dbc.php";

@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');

$username = mysql_real_escape_string($_POST['username']);
$password = mysql_real_escape_string($_POST['password']);

if($username == "" || $password == ""){
    $msg = "Please fill all the fields";
    echo json_encode($msg);
    exit;
}else{
    $sql = 'select user_id, username from user_activity_management where username="'.$username.'" and password="'.$password.'"';
    $query = mysql_query($sql);
    $row = mysql_fetch_assoc($query);
    $num_rows = mysql_num_rows($query);
    if($num_rows == 1){
        // generate token using hash_hmac function
        $token = hash_hmac('sha256', $row->user_name.time(), '_sadf45%kamrul');

        $insql = "INSERT INTO user_cookie_log(token, user_name, user_pass, entry_at) 
            values('$token', '$username', '$password', '".date('Y-m-d H:i:s')."')";
        $inquery = mysql_query($insql);

        $msg = array("code" => 200, "msg" => "Login Successful", "token" => $token);
        echo json_encode($msg);
        exit;
    }else{
        $msg = array("code" => 401, "msg" => "Invalid username or password");
        echo json_encode($msg);
        exit;
    }
}
?>











