<?php

if (isset($_SERVER['HTTP_BEARER'])) {
    $token = mysql_real_escape_string($_SERVER['HTTP_BEARER']);
    $sql = 'select * from user_cookie_log where token="'.$token.'"';
    $query = mysql_query($sql);
    $num_rows = mysql_num_rows($query);
    $row = mysql_fetch_object($query);
    
    if($num_rows>0){ 
        $userql = 'select * from user_activity_management where username="'.$row->user_name.'" and password="'.$row->user_pass.'"';
        $userquery = mysql_query($userql);
        $userrow = mysql_fetch_object($userquery);
        $usernum_rows = mysql_num_rows($userquery);

    if ($usernum_rows>0) {
        $_SESSION['user_id'] = $userrow->user_id;
        $_SESSION['group_for'] = $userrow->group_for;
    }else{
        $msg = array("code" => 401, "msg" => "Invalid token");
        exit;
    }
    }else{
        $msg = array("code" => 401, "msg" => "Invalid token");
        echo json_encode($msg);
        exit;
    }
    }else {
        $msg= array("msg" => "Baerer token not found");
        echo json_encode($msg);
        exit;
}
?>











