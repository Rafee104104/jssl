<?php
session_start();
include 'config/db.php';
include 'config/function.php';

$number='8801711763169';
$text='Hello, this is text sms from gp';

gpsms($number,$text);

echo 'sms send Done';
?>