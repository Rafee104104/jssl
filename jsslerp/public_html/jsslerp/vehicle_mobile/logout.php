<?php

session_start();
session_unset();
session_destroy();



// 				setcookie('user_cash',$_COOKIE['user_cash'],time()-3600);

// 				setcookie('pass_cash',$_COOKIE['pass_cash'],time()-3600);

// 				setcookie('cashfullname',$_COOKIE['cashfullname'],time()-3600);



// unset($_COOKIE['user_cash']);
// unset($_COOKIE['pass_cash']);
// unset($_COOKIE['cashfullname']);

//header("location:index.php");

?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>

		<meta charset="utf-8">

		<meta name="viewport" content="width=device-width,initial-scale=1">

		<title>Logout</title>

		<link rel="stylesheet" href="themes/Bootstrap.css">

		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.0/jquery.mobile.structure-1.4.0.min.css" />

		<link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />

		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>

		<script src="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.js"></script>



</head>



<body>







<script>

setTimeout(function() {

  window.location.href = "index.php";

}, 2);

</script>





</body>

</html>



