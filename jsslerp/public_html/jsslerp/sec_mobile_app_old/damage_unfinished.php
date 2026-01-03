<?php
session_start();
include 'config/db.php';
include 'config/function.php';
include 'config/access.php';
$user_id	=$_SESSION['user_id'];

$page="damage_unfinished";

include "inc/header.php";

?>
<!-- main page content -->
<div class="main-container container">
           
<!-- User list items  -->
<div class="row">
<div class="row text-center mb-2"><h4>Damage Hold List</h4></div>    
    


<? 
$sql='select  a.oi_no,a.oi_no as no,a.oi_date, a.vendor_name as party
from ss_issue_master a
where a.status="MANUAL" and a.issue_type = "Damage" 
'.$con.' 
group by a.oi_no order by a.oi_no desc';
$query=mysqli_query($conn, $sql);
while($data=mysqli_fetch_object($query)){
?>                            
<div class="col-12">
    <div class="card shadow-sm mb-2">        
            <ul class="list-group list-group-flush bg-none">
        <a href="damage_entry.php?oi_no=<?=$data->oi_no?>">   
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
                        <p>No: <?=$data->oi_no?>-<?=$data->party?><br><small class="text-secondary">Date: <?=$data->oi_date?></small></p>
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