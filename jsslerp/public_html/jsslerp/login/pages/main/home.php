<?php
echo "ERP Working";
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php
echo "ERP Working";
session_save_path("I:/xampp/tmp");
session_start();

require_once "../../../assets/support/inc.all.php";

$cid = explode('.', $_SERVER['HTTP_HOST'])[0];
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<title>Jamuna Seeds Storage LTD || ERP Software</title>

<link rel="icon" type="image/x-icon" href="../../../assets/images/login/erp_favicon-32x32.png">
<script src="../../../home/files/jquery-1.js"></script>

<link href="../../../home/files/stylesheet.css" rel="stylesheet">
<link href="../../../home/files/css.css" rel="stylesheet">
<link rel="stylesheet" href="../../../home/files/normalize.css">
<link rel="stylesheet" href="../../../home/files/common.css">
<link rel="stylesheet" href="../../../home/files/website.css">
<link rel="stylesheet" href="../../../home/files/font-awesome.css">

</head>

<body class="oe_styling_v8">

<div class="oe_website_contents">

<header class="oe_website_header">

<div class="oe_row oe_fit">

<div style="float:left">

<?php

$cloud_logo = "../../../logo/clouderplogo.png";
$project_logo = "../../../logo/".$cid.".png";

if(is_file($project_logo)){
    $show_logo = $project_logo;
}else{
    $show_logo = $cloud_logo;
}

?>

<img src="<?= $show_logo ?>" style="height:60px">

</div>

<div style="float:right">
<img src="../../../logo/erp1.png" height="40px">
</div>

</div>

</header>

<article class="oe_page">

<section class="oe_container">

<h4 class="oe_slogan">Choose Your Department</h4>

<div class="oe_row oe_appstore">

<?php

$u_id = $_SESSION['user']['id'] ?? 0;

$sql22 = "SELECT 
a.module_name,
a.module_link,
a.module_icon_img,
a.module_description,
a.id

FROM user_module_manage a
JOIN user_module_define b ON b.module_id = a.id

WHERE b.user_id='$u_id'
AND b.status='enable'";

$query22 = db_query($sql22);

if($query22){

while($data22 = db_fetch_object($query22)){

?>

<a href="../../../<?= $data22->module_link ?>?mod_id=<?= $data22->id ?>" class="oe_app">

<div class="oe_app_icon">
<img src="../../../home/<?= $data22->module_icon_img ?>">
</div>

<div class="oe_app_name">
<?= $data22->module_name ?>
</div>

<div class="oe_app_descr">
<?= $data22->module_description ?>
</div>

</a>

<?php
}
}
?>

</div>

</section>


<section class="oe_container">

<h4 class="oe_slogan">Download Our Apps</h4>

<div class="oe_row oe_appstore">

<a href="../../../all_module_apk/SecondarySales.apk" class="oe_app">

<div class="oe_app_icon">
<img src="../../../home/SecondarySales.png">
</div>

<div class="oe_app_name">Secondary Sales Apps</div>

</a>

<a href="../../../all_module_apk/EmployeePortal.apk" class="oe_app">

<div class="oe_app_icon">
<img src="../../../home/user_portal.png">
</div>

<div class="oe_app_name">Employee Portal Apps</div>

</a>

</div>

</section>

</article>

</div>

</body>
</html>