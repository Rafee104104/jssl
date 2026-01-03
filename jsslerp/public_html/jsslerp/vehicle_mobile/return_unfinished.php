<?php
session_start();
include 'config/db.php';
include 'config/function.php';
include 'config/access.php';
$user_id	=$_SESSION['user_id'];

$page="return_unfinished";

include "inc/header.php";

?>
<!-- main page content -->
<div class="main-container container">
           
<!-- User list items  -->
<div class="row">
<div class="row text-center mb-2">
  <h4>Sales Return Hold List</h4>
</div>    
    
<div class="row">
	<div class="card">
		<form action="" method="post" style="padding:10px">
			<div class="form-group" >
				<label for="date">From Date</label>
				<input type="date" name="fdate" class="form-control" value="<?=$_POST['fdate'];?>" />
				<label for="date">To Date</label>
				<input type="date" name="tdate" class="form-control"  value="<?=$_POST['tdate'];?>" />
			</div>
			
			<div class="form-group" >
				<label for="date">Dealer</label>
				<input class="form-control border border-info" list="browsers" name="dealer_code" id="dealer_code" value="<?=$_POST['dealer_code'];?>" tabindex="1" autocomplete="off"/>
    			<datalist id="browsers">
					<? foreign_relation('dealer_info','dealer_code','concat(dealer_name_e,"[",address_e,"]","[",mobile_no,"]")',$dealer_code,'dealer_type="Distributor" and canceled="Yes" and account_code>0');?>
    			</datalist>
				
			</div>
			
			<div class="form-group" >
				<label for="date">SO</label>
				<input class="form-control border border-info" list="pbi" name="PBI_ID" id="PBI_ID" value="<?=$_POST['PBI_ID'];?>" tabindex="1" autocomplete="off"/>
    			<datalist id="pbi">
					<? foreign_relation('personnel_basic_info','PBI_ID','PBI_NAME',$PBI_ID,'PBI_DESIGNATION="SO"');?>
    			</datalist>
				
			</div>
			
			
			<div class="form-group" >
				<input type="submit" name="show" class="btn btn-info" style="margin-left:20%" value="Show" />
			</div>
		</form>
	</div>
</div>

<? 
$sql = "select s.*,m.* from ss_shop s,ss_return_master m  where m.dealer_code=s.dealer_code and m.status='MANUAL' order by m.do_no";
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
                        <p>Order No: <?=$data->do_no?>-<?=$data->shop_name?><br><small class="text-secondary"><?=$data->shop_owner_name?> ,<?=$data->mobile?></small></p>
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
            <div class="col-md-8 text-end">
					<table align="center">
						<tr class="col-auto text-end">
							<td class="text-primary text-muted size-12 mb-0" style="text-align:center; padding-left:20px; padding-right:20px;"><strong>SR Date.</strong></td>
							
							<td class="text-primary text-muted size-12 mb-0" style="text-align:center; padding-left:20px; padding-right:20px;"><strong>SR No.</strong></td>
							
							<td class="text-primary text-muted size-12 mb-0" style="text-align:center; padding-left:20px; padding-right:20px;"><strong>SO ID.</strong></td>
							<td class="text-primary text-muted size-12 mb-0" style="text-align:center; padding-left:20px; padding-right:20px;"><strong>SO Name.</strong></td>
							
							<td class="text-primary text-muted size-12 mb-0" style="text-align:center; padding-right:20px;"><strong>Dealer Code.</strong></td>
							<td class="text-primary text-muted size-12 mb-0" style="text-align:center"><strong>Dealer Name.</strong></td>
							<td class="text-primary text-muted size-12 mb-0" style="text-align:center"><strong>Address.</strong></td>
							<td class="text-primary text-muted size-12 mb-0" style="text-align:center"><strong>Mobile No.</strong></td>
							
							<td class="text-primary text-muted size-12 mb-0" style="text-align:center; padding-left:20px;"><strong>Order Qty</strong></td>
							
							<td class="text-primary text-muted size-12 mb-0" style="text-align:center; padding-left:20px; padding-right:20px;"><strong>Amount</strong></td>
							
							<td class="text-primary text-muted size-12 mb-0" style="text-align:center; padding-right:20px;"><strong>Status</strong></td>
							
							<td class="text-primary text-muted size-12 mb-0" style="text-align:center"><strong>X</strong></td>
						</tr>
			<? 
if(isset($_POST['show'])){
	if($_POST['fdate'] !='' && $_POST['tdate'] !='') $con = ' and m.do_date between "'.$_POST['fdate'].'" and "'.$_POST['tdate'].'" ' ;
	if($_POST['dealer_code'] !='' ) $con2 = ' and m.dealer_code ="'.$_POST['dealer_code'].'" ' ;
	if($_POST['PBI_ID'] !='' ) $con2 = ' and m.employee_id ="'.$_POST['PBI_ID'].'" ' ;
}			
			
   $sql1 = "select  m.dealer_code, m.do_date,  m.do_no, m.status, m.employee_id , (select PBI_NAME from personnel_basic_info where PBI_ID = m.employee_id) as PBI_NAME
from ss_return_master m
where 1 ".$con.$con2."
group by m.do_no order by m.do_date asc";
//and m.do_date='".date('Y-m-d')."'
//and m.entry_by = '".$data->entry_by."'
$query1=mysqli_query($conn, $sql1);
while($data1=mysqli_fetch_object($query1)){
$dealer = find_all_field('dealer_info','','dealer_code='.$data1->dealer_code);
?>  			
						<tr class="col-auto text-end">
							<td class="text-primary text-muted size-12 mb-0 " style="text-align:center"><?=$data1->do_date;?></td>
							<td class="text-primary text-muted size-12 mb-0 " style="text-align:center"><?=$data1->do_no;?></td>
							
							<td class="text-primary text-muted size-12 mb-0 " style="text-align:center"><?=$data1->employee_id;?></td>
							<td class="text-primary text-muted size-12 mb-0 " style="text-align:center"><?=$data1->PBI_NAME;?></td>
							
							<td class="text-primary text-muted size-12 mb-0 " style="text-align:center"><?=$dealer->dealer_code;?></td>
							<td class="text-primary text-muted size-12 mb-0 " style="text-align:center"><?=$dealer->dealer_name_e;?></td>
							<td class="text-primary text-muted size-12 mb-0 " style="text-align:center"><?=$dealer->address_e;?></td>
							<td class="text-primary text-muted size-12 mb-0 " style="text-align:center"><?=$dealer->mobile_no;?></td>
							
							<td class="text-primary text-muted size-12 mb-0 " style="text-align:center"><?=find_a_field('ss_return_details','sum(total_unit)','do_no='.$data1->do_no);?></td>
							
							<td class="text-primary text-muted size-12 mb-0" style="text-align:right; padding-left:20px; padding-right:20px;"><?=find_a_field('ss_return_details','sum(total_amt)','do_no='.$data1->do_no);?></td>
							
							<td class="text-primary text-muted size-12 mb-0" style="text-align:right; padding-right:20px;"><?=$data1->status;?></td>
							
							<td class="text-primary text-muted size-12 mb-0" style="text-align:right"><a target="_blank" href="sales_return.php?do_no=<?=$data1->do_no?>">
								<i class="nav-icon bi bi-pencil-square" style="color:blue; font-size:20px;"></i></a>
							</td>
						</tr>
		<? } ?>				
					</table>
					</div>
            


        </div>
        <!-- main page content ends -->


    </main>
    <!-- Page ends-->

<?php include "inc/footer.php"; ?>