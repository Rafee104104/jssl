<?php
session_start();
include 'config/db.php';
include 'config/function.php';
include 'config/access.php';
$user_id	=$_SESSION['user_id'];

$page="home";

include "inc/header.php";

?>
<!-- main page content -->
<div class="main-container container">

<!-- summary blocks -->
<!--<div class="row">-->
<!--                <div class="col-12 px-0">-->
<!--                    <div class="swiper-container summayswiper">-->
<!--                        <div class="swiper-wrapper">-->
<!--                            <div class="swiper-slide">-->
<!--                                <div class="card shadow-sm mb-2">-->
<!--                                    <div class="card-body">-->
<!--                                        <div class="row">-->
<!--                                            <div class="col-auto">-->
<!--                                                <div class="avatar avatar-50 bg-warning text-white shadow-sm rounded-15">-->
<!--                                                    <i class="bi bi-star"></i>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                            <div class="col px-0 align-self-center">-->
<!--                                                <p class="text-secondary size-12 mb-0">Bonus Points</p>-->
<!--                                                <p>48546 pts</p>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="swiper-slide">-->
<!--                                <div class="card shadow-sm mb-2">-->
<!--                                    <div class="card-body">-->
<!--                                        <div class="row">-->
<!--                                            <div class="col-auto">-->
<!--                                                <div class="avatar avatar-50 bg-success text-white shadow-sm rounded-15">-->
<!--                                                    <i class="bi bi-cash-stack"></i>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                            <div class="col px-0 align-self-center">-->
<!--                                                <p class="text-secondary size-12 mb-0">Cashback</p>-->
<!--                                                <p>15 BDT</p>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            <!--<div class="swiper-slide">-->
                            <!--    <div class="card shadow-sm mb-2">-->
                            <!--        <div class="card-body">-->
                            <!--            <div class="row">-->
                            <!--                <div class="col-auto">-->
                            <!--                    <div class="avatar avatar-50 bg-primary text-white shadow-sm rounded-15">-->
                            <!--                        <i class="bi bi-controller"></i>-->
                            <!--                    </div>-->
                            <!--                </div>-->
                            <!--                <div class="col px-0 align-self-center">-->
                            <!--                    <p class="text-secondary size-12 mb-0">Gameplay</p>-->
                            <!--                    <p>105 coins</p>-->
                            <!--                </div>-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--<div class="swiper-slide">-->
                            <!--    <div class="card shadow-sm mb-2">-->
                            <!--        <div class="card-body">-->
                            <!--            <div class="row">-->
                            <!--                <div class="col-auto">-->
                            <!--                    <div class="avatar avatar-50 bg-info text-white shadow-sm rounded-15">-->
                            <!--                        <i class="bi bi-droplet"></i>-->
                            <!--                    </div>-->
                            <!--                </div>-->
                            <!--                <div class="col px-0 align-self-center">-->
                            <!--                    <p class="text-secondary size-12 mb-0">Fuel</p>-->
                            <!--                    <p>3 ltr</p>-->
                            <!--                </div>-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->

<?

$total_shop = find1("select count(dealer_code) from ss_shop where 1");
$visit=15;
$total_order = 35;
$total_delivery=50;

?>


<!-- Top Baner info -->
<div class="row bg-theme text-white mb-3">
                <div class="col align-self-center">
                    <div class="text-center py-4">
                        <h4 class="mb-0"><span class="countertext"><?=(int)$total_delivery?></span></h4>
                        <p class="small">Total Vehicle</p>
                    </div>
                </div>
                <div class="col align-self-center">
                    <div class="text-center py-4">
                        <h4 class="mb-0"><span class="countertext"><?=(int)$visit?></span></h4>
                        <p class="small">On The Way</p>
                    </div>
                </div>
                <div class="col align-self-center">
                    <div class="text-center py-4">
                        <h4 class="mb-0"><span class="countertext"><?=(int)$total_order?></span></h4>
                        <p class="small">Available</p>
                    </div>
                </div>
                <!--<div class="col align-self-center">
                    <div class="text-center py-4">
                        <h4 class="mb-0"><span class="countertext"><?=(int)$total_delivery?></span></h4>
                        <p class="small">Delivery</p>
                    </div>
                </div>-->
            </div>
            





            <?php /*?><div class="row mt-5">
 <div class="row text-center mb-2"><h4>Todays Order List</h4></div>    
    

                        
                            
<? 
 $sql = "select count(m.do_no) as total_do, sum(m.dealer_code) as outlet, m.do_no, u.fname, u.mobile, u.designation , sum(d.total_unit) as total_unit 
from ss_do_master m,ss_do_details d, ss_user u 
where  m.do_no=d.do_no and m.entry_by = u.username
and m.status='CHECKED' and m.do_date='".date('Y-m-d')."'
group by m.do_no order by m.do_no";
$query=mysqli_query($conn, $sql);
while($data=mysqli_fetch_object($query)){
?>                            
<div class="col-12">
    <div class="card shadow-sm mb-2">        
            <ul class="list-group list-group-flush bg-none">
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
                        <p class="mb-0">Total Outlet: <?=$data->outlet?>  (<?=$data->total_do?>)<br>
                        <small class="text-secondary"><?=$data->fname?> <br><?=$data->mobile?></small></p>
                        <p><small class="text-secondary"><?=$data->designation;?> </small></p>
                    </div>
                    <div class="col-auto text-end">
                        <p class="text-secondary text-muted size-10 mb-0">Order QTY</p>
                        <p class="text-info">
                            <strong><?=$data->total_unit;?></strong>
                        </p>
                    </div>
                </div>
            </li>
    
        </ul>
         
    </div>
</div>
           <? } ?> 
</div> <?php */?> 



<div class="row mt-5">
 <div class="row text-center mb-2"><h4><?=$_SESSION['msg'];unset($_SESSION['msg'])?></h4></div>    
    

                        
                            
<? 
  $sql = "select count(m.do_no) as total_do, m.entry_by, sum(m.dealer_code) as outlet, m.do_no, u.fname, u.mobile, u.designation , sum(d.total_unit) as total_unit 
from ss_do_master m,ss_do_details d, ss_user u 
where  m.do_no=d.do_no and m.entry_by = u.username 
and m.status='CHECKED' 
group by m.entry_by order by m.do_no";
//and m.do_date='".date('Y-m-d')."'
$query=mysqli_query($conn, $sql);
while($data=mysqli_fetch_object($query)){
?>                            
<div class="col-12">
    <div class="card shadow-sm mb-2">        
            <ul class="list-group list-group-flush bg-none">
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
                        <p class="mb-0">Total Outlet: <?=$data->outlet?></p>
						<p class="mb-0">Total DO: <?=$data->total_do?></p>
                        <p class="mb-0"><small class="text-secondary"><?=$data->fname?> <br><?=$data->mobile?></small></p>
                        <p><small class="text-secondary"><?=$data->designation;?> </small></p>
                    </div>
					<div class="col-auto text-end">
                        <p class="text-secondary text-muted size-12 mb-0" align="center">Item Name</p>
                        <p class="text-info" align="center">
                            <strong><?=$data->item_name;?></strong>
                        </p>
                    </div>
                    <div class="col-auto text-end">
                        <p class="text-secondary text-muted size-12 mb-0" align="center">Order QTY</p>
                        <p class="text-info" align="center">
                            <strong><?=$data->total_unit;?></strong>
                        </p>
                    </div>
					<div class="col-auto text-end">
                        <p class="text-secondary text-muted size-12 mb-0" align="center">Total Amount</p>
                        <p class="text-info" align="center">
                            <strong><?=$data->total_amt;?></strong>
                        </p>
                    </div>
                </div>
            </li>
    
        </ul>
         
    </div>
</div>
           <? } ?> 
</div> 

<!--sk-->

           <? //} ?> 
</div> 





            
 <!-- Latest Transection  -->
    
            <!--<div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush bg-none">
<?php 
$sql_t = "select s.* from ss_shop s where 1 order by market_id";
$query2=mysqli_query($conn, $sql_t);
while($data2=mysqli_fetch_object($query2)){
?>                                
                                <a href="do.php?ss=<?=$data2->dealer_code?>">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="avatar avatar-50 border rounded-15">
                                                <img src="assets/img/user1.jpg" alt="" />
                                            </div>
                                        </div>
                                        <div class="col align-self-center ps-0">
                                            <p class="mb-0"><?=$data2->shop_name?>(<?=$data2->dealer_code?>)</p>
                                            <p class="text-info size-10 mb-0">Farmgate->Indira Road->Tejgaon Road</p>
                                            <p class="text-secondary size-10 mb-0"><?=$data2->shop_owner_name?> - <?=$data2->mobile?></p>
                                        </div>
                                        <div class="col align-self-center text-end">
                                            <p class="text-secondary text-muted size-10 mb-0">Order</p>
                                        </div>
                                    </div>
                                </li></a>
<?php } ?>                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>-->
            
            
            <!-- User list items  -->
         
            
            


        </div>
        <!-- main page content ends -->


    </main>
    <!-- Page ends-->

<?php include "inc/footer.php"; ?>