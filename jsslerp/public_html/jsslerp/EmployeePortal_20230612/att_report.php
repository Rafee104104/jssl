<?php

session_start();

include 'config/db.php';

include 'config/function.php';

include 'config/access.php';

$u_id= $_SESSION['user_id']; //$_SESSION['user']['id'];
$PBI_ID = find_a_field('user_activity_management','PBI_ID','user_id='.$u_id);

$user_id	= $PBI_ID; //$_SESSION['user_id'];



$page="do_unfinished";



include "inc/header.php";



?>

<style>
.avatar.avatar-100 {
    line-height: 100px;
    height: 100%;
    width: 55px;
}
.list-group-item, .form-group{
	background-color: white !important ;
}
.btn{
border-radius: 5px !important; 
}
</style>

<style>
#preloader {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: #fff;
  z-index: 9999;
}

.loading {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.loading img {
  width: 100px;
  height: 100px;
}
</style>
<script>
setTimeout(function() {
    document.getElementById("preloader").style.display = "none";
}, 2000);

</script>
<!-- main page content -->
<form action=""  enctype="multipart/form-data" method="post" name="codz" id="codz" >
<div id="preloader">
  <div class="loading">
    <img src="loading-gif.gif" alt="Loading...">
  </div>
</div>


<div class="main-container container">

<!-- User list items  -->

<div class="row">

<div class="row text-center mb-2"><h4>My Attendance Report<br /><?=$_SESSION['msg'];unset($_SESSION['msg']);?></h4></div>  

    

<div class="col-12">

	<div class="card shadow-sm mb-2">

		<form action="" method="post" style="padding:10px">

			<div class="form-group" align="center" >

				<label for="date" style=" float: left; margin-left: 20px; ">From Date</label>

				<input type="date" name="fdate" class="form-control border border-info" style=" width: 90%; border-radius: 5px;" tabindex="1" value="<?=$_POST['fdate'];?>" />

				<label for="date" style=" float: left; margin-left: 20px; ">To Date</label>

				<input type="date" name="tdate" class="form-control border border-info" style=" width: 90%; border-radius: 5px;" tabindex="1"  value="<?=$_POST['tdate'];?>" />

			</div>

			

			<div class="form-group pt-1 pb-1" align="center">

				<input type="submit" name="show" class="btn btn-info" value="Show" />

			</div>

		</form>

	</div>

</div>



<? 

if(isset($_POST['show'])){

	if($_POST['fdate'] !='' && $_POST['tdate'] !='') $con = ' and xdate between "'.$_POST['fdate'].'" and "'.$_POST['tdate'].'" ' ;

}

$sql = "select * from hrm_attdump  where 1 and EMP_CODE='".$user_id."' ".$con." group by xdate order by sl desc";

$query=mysqli_query($conn, $sql);

while($data=mysqli_fetch_object($query)){

?>  

                          

<div class="col-12">

    <div class="card shadow-sm mb-2">        

            <ul class="list-group list-group-flush bg-none">

        <!--<a href="do_checking.php?expense_no=<?=$data->expense_no?>">   -->

            <li class="list-group-item border-0">

                <div class="row">

                    <div class="col-auto">

                        <div class="card1">

                            <div class="card-body p-0">
							
								<div class="col-auto">
		  
		        <? 
		   $image_path = find_a_field('personnel_basic_info','PBI_PICTURE_ATT_PATH','PBI_ID="'.$PBI_ID.'"');
		   
		   if($image_path!==""){ 

		  ?>
		  
		  <figure class="avatar avatar-100 rounded-5">
		  
		  <img src="../../../assets/support/upload_view.php?name=<?=$image_path?>&folder=hrm_emp_pic&proj_id=<?=$cid1?>&mod=hrm_mod" alt="#">   
		  
		  </figure>
		  
	
		  
		    <? }else{?>

            <figure class="avatar avatar-100 rounded-5"> <img src="assets/img/user1.jpg" alt=""> </figure>
			
			<? }?>

          </div>

                            </div>

                        </div>

                    </div>

                    <div class="col px-0">

                        <p>Date: <?=date('Y-M-d',strtotime($data->xdate))?><br>

						<?

						$sql2 = "select m.* from hrm_attdump m where 1 and EMP_CODE='".$user_id."' and xdate='".$data->xdate."' ".$con." order by m.sl asc";

$query2=mysqli_query($conn, $sql2);

while($data2=mysqli_fetch_object($query2)){

						?>

						<small class="text-secondary">Punch Time : <?=date('H:i:s',strtotime($data2->xtime))?></small><br />

						<? } ?>

						</p>

                    </div>

                    

                </div>

            </li><!--</a>--> 

    

        </ul>

         

    </div>

</div>

           <? } ?> 

           </div>         

            <!--<div class="col-md-8 text-end">

					<table align="center">

						<tr class="col-auto text-end">

							<td class="text-primary text-muted size-12 mb-0" style="text-align:center; padding-left:20px; padding-right:20px;"><strong>Entry Date.</strong></td>

							

							<td class="text-primary text-muted size-12 mb-0" style="text-align:center; padding-left:20px; padding-right:20px;"><strong>Claim No.</strong></td>

							

							<td class="text-primary text-muted size-12 mb-0" style="text-align:center; padding-left:20px; padding-right:20px;"><strong>Entry By.</strong></td>

							

							<td class="text-primary text-muted size-12 mb-0" style="text-align:center"><strong>Action</strong></td>

						</tr>

			<? 

if(isset($_POST['show'])){

	if($_POST['fdate'] !='' && $_POST['tdate'] !='') $con = ' and m.expense_date between "'.$_POST['fdate'].'" and "'.$_POST['tdate'].'" ' ;

}			

			

   $sql1 = "select   m.expense_date,  m.expense_no, m.status, m.entry_by,m.entry_at from fuel_expense m

where 1 and m.status='MANUAL' ".$con." order by m.expense_date asc";

//and m.do_date='".date('Y-m-d')."'

//and m.entry_by = '".$data->entry_by."'

$query1=mysqli_query($conn, $sql1);

while($data1=mysqli_fetch_object($query1)){

?>  			

						<tr class="col-auto text-end">

							<td class="text-primary text-muted size-12 mb-0 " style="text-align:center"><?=$data1->expense_date;?></td>

							<td class="text-primary text-muted size-12 mb-0 " style="text-align:center"><?=$data1->expense_no;?></td>

							

							<td class="text-primary text-muted size-12 mb-0 " style="text-align:center"><?=find_a_field('user_activity_management','fname','user_id="'.$data1->entry_by.'"');?></td>

							<td class="text-primary text-muted size-12 mb-0 " style="text-align:center"><?=$data1->PBI_NAME;?></td>

						</tr>

		<? } ?>				

					</table>

					</div>-->

            





        </div>

        <!-- main page content ends -->





    </main>

    <!-- Page ends-->
</form>


<?php include "inc/footer.php"; ?>