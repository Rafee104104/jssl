<?php

$db_name = "clouderp_developmentdb";
$db_user = "clouderp_apiUser";
$db_pass = "clouderp_apiUser";
$db_host = "localhost";

$connection = mysql_connect($db_host, $db_user,$db_pass)
 or die("Could not connect to database server.");

mysql_select_db($db_name, $connection) or die("Could not select database.");

function find_a_field($table,$field,$condition)
{
    $sql="select ".$field." from ".$table." where ".$condition;
    $numRows = mysql_num_rows(mysql_query($sql));
    if($numRows > 0)
    {
        $query=mysql_fetch_row(mysql_query($sql));
        return $query[0];
    }
    else
    {
        return 0;
    }
}


function find_all_field($table,$field,$condition)
{
    $sql="select * from ".$table." where ".$condition;
    $numRows = mysql_num_rows(mysql_query($sql));
    if($numRows > 0)
    {
        $query=mysql_fetch_row(mysql_query($sql));
        return $query;
    }
    else
    {
        return 0;
    }
    
}

?>











