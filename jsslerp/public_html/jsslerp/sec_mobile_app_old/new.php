<?php
session_start();
include 'config/db.php';
include 'config/function.php';
include 'config/access.php';

$today = date('Y-m-d');

$user_id	=$_SESSION['user_id'];
$username	=$_SESSION['username'];

$page="page";
include "inc/header.php";
?>
<!-- main page content -->
<div class="main-container container">
           
<!-- body  -->
<div class="row">
<div class="row text-center mb-2"><h4>Title</h4></div>    
    






</div>           
</div>
<!-- main page content ends -->


</main>
<!-- Page ends-->
<?php include "inc/footer.php"; ?>