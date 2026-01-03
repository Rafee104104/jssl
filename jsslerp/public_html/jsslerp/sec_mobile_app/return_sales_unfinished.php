<?php
session_start();
include 'config/db.php';
include 'config/function.php';
include 'config/access.php';
$user_id	=$_SESSION['user_id'];

$page="do_unfinished";

include "inc/header.php";

?>
<!-- main page content -->
<div class="main-container container">
           
<!-- User list items  -->
<div class="row">
<div class="row text-center mb-2"><h4>Sales Return Hold List</h4></div>    
    


<? 
$sql='select  a.or_no,a.or_no as no,a.or_date, a.vendor_name as party
from ss_receive_master a
where a.status="MANUAL" and a.receive_type = "Sales Return" 
'.$con.' 
group by a.or_no order by a.or_no desc';
$query=mysqli_query($conn, $sql);
while($data=mysqli_fetch_object($query)){
?>                            
<div class="col-12">
    <div class="card shadow-sm mb-2">        
            <ul class="list-group list-group-flush bg-none">
        <a href="return_sales.php?or_no=<?=$data->or_no?>">   
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
                        <p>No: <?=$data->or_no?>-<?=$data->party?><br><small class="text-secondary">Date: <?=$data->or_date?></small></p>
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