<?php
session_start();
include 'config/db.php';
include 'config/function.php';
include 'config/access.php';

$today = date('Y-m-d');

$user_id	=$_SESSION['user_id'];
$username	=$_SESSION['username'];

$page="do_unfinished";

include "inc/header.php";

?>
<!-- main page content -->
<div class="main-container container">
           
<!-- User list items  -->
<div class="row">
<div class="row text-center mb-2"><h4>Demand Order Hold List</h4></div>    
    


<?
$sql = "select s.*,m.* from ss_shop s, ss_do_master m
where m.dealer_code=s.dealer_code
and m.entry_by='".$username."' and m.do_date>='2022-06-01'
and m.status='MANUAL' order by m.do_no";

$query=mysqli_query($conn, $sql);
while($data=mysqli_fetch_object($query)){
?>                            
<div class="col-12">
    <div class="card shadow-sm mb-2">        
            <ul class="list-group list-group-flush bg-none">
        <a href="do.php?do_no=<?=$data->do_no?>">   
            <li class="list-group-item border-0">
                <div class="row">
                    <div class="col-auto">
                        <div class="card">
                            <div class="card-body p-0">
                                <figure class="avatar avatar-50 rounded-15">
                                    <img src="assets/img/user1.jpg" alt="">
                                </figure>
                            </div>
                        </div>
                    </div>
                    <div class="col px-0">
                        <p>Order No: <?=$data->do_no?>-<?=$data->shop_name?><br><small class="text-secondary">Date: <?=$data->do_date?></small></p>
                    </div>
                    <!--<div class="col-auto text-end">-->
                    <!--    <p class="text-secondary text-muted size-10 mb-0">Order</p>-->
                    <!--    <p class="text-info">-->
                    <!--        <strong>2500</strong>-->
                    <!--    </p>-->
                    <!--</div>-->
                </div>
            </li></a> 
    
        </ul>
         
    </div>
</div>
           <? } ?> 
           </div>           
            
            


        </div>
        <!-- main page content ends -->


    </main>
    <!-- Page ends-->

<?php include "inc/footer.php"; ?>