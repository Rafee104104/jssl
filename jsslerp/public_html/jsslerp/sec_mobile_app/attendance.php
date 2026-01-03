<?php
session_start();
include 'config/access.php';
include 'config/db.php';
include 'config/function.php';
$page       ="attendance";
include "inc/header.php";

$username	=$_SESSION['username'];
$show       =findall('select username,fname from ss_user where username="'.$username.'"');
$ip = $_SERVER['REMOTE_ADDR'];



$in_info = findall("select * from ss_location_log where access_date='".date('Y-m-d')."' and user_id='".$username."' and attendance_type='IN TIME'");
$out_info = findall("select * from ss_location_log where access_date='".date('Y-m-d')."' and user_id='".$username."' and attendance_type='OUT TIME'");

$check_intime = $in_info->access_time;
$check_outtime= $out_info->access_time;

if(isset($_REQUEST['in_time'])){
    $_POST['type']='Attendance';
    $_POST['attendance_type']='IN TIME';
    $_POST['shop_name']=find1("select shop_name from ss_shop where dealer_code='".$_POST['shop_id']."'");
    
    @insert('ss_location_log');
    
    $msg="Attendance In time insert successfully";
    redirect2("attendance.php");
}





if(isset($_REQUEST['out_time'])){
$_POST['type']='Attendance';
$_POST['attendance_type']='OUT TIME';
$shop_info =findall("select * from ss_shop where dealer_code='".$_POST['shop_id']."'");
$_POST['shop_name']     =$shop_info->shop_name;
$_POST['shop_address']  =$shop_info->shop_address;

@insert('ss_location_log');

$msg="Attendance Out time insert successfully";
redirect2("attendance.php");
}




?>
<!-- main page content -->
<div class="main-container container">
            

<div class="row text-center mb-3"><h3>Submit Attendance</h3></div>
<?php if(isset($_GET['edit_id'])){ ?> <a class="btn btn-primary" href="?" role="button">New Entry</a> <? } ?>
<?php if(isset($msg)){ ?><div class="alert alert-primary msg" role="alert"><?php echo @$msg; ?></div><?php } ?>
<?php if(isset($emsg)){ ?><div class="alert alert-danger emsg" role="alert"><?php echo @$emsg; ?></div><?php } ?>



<form action="" method="post" id="demo" data-parsley-validate class="form-horizontal form-label-left">					


<div class="row mb-10 mb-2">
	<div class="col-4"><label class="control-label" for="fname">User Name<span class="required"></span></label></div>
	<div class="col-8 pl-0"><input type="text" name="fname" required="required" disable autocomplete="off" value="<?=$show->fname?>" class="form-control"></div>
</div>

<div class="row mb-10 mb-2">
	<div class="col-4"><label class="control-label" for="fname">Shop<span class="required"></span></label></div>
	<div class="col-8 pl-0">
        <select class="form-control" name="shop_id" required="required" id="shop_id">
        <option></option>
        <?
        optionlist('select s.dealer_code,concat(r.route_name,"-",s.shop_name) as shop_name 
        from ss_shop s, ss_route r 
        where s.route_id=r.route_id and s.status="1" and s.emp_code="'.$_SESSION['username'].'" 
        order by r.route_id,s.shop_name');
        ?>
        </select> 
	</div>
</div>

				<input type="hidden" name="access_date" id="access_date"  value="<?=date('Y-m-d')?>">
				<input type="hidden" name="access_time" id="access_time"  value="<?=date('Y-m-d H:i:s')?>">
				
				<input type="hidden" name="user_id" id="user_id"  value="<?=$username;?>">
				<input type="hidden" name="ip" id="ip"  value="<?=$ip;?>">
				
				<input type="hidden" name="latitude" id="latitude"  value="">
				<input type="hidden" name="longitude" id="longitude"  value="">
			
											  
<div class="ln_solid mt-2"></div>
<div class="form-group">
    <div class="col-md-12 col-sm-12 col-md-offset-3" align="center">
    <?php if($_GET['edit_id']>0){ ?>
        <button name="update" type="submit"  class="btn btn-info">Update</button>
    <?php }else{ ?>
            <div class="col-12 col-sm-12 mt-auto mx-auto py-4">
                <div class="row " align="center">
<? if($check_intime!=''){ }else{ ?>
                    <div class="col-12 d-grid"><button type="submit" name="in_time" class="btn btn-default btn-rounded shadow-sm">IN PUNCH</button></div>
<? } ?>

<? if($check_outtime=='' && $check_intime!=''){ ?>
                    <div class="col-12 d-grid"><button type="submit" name="out_time" class="btn btn-warning btn-rounded shadow-sm">OUT PUNCH</button></div>
<? } ?>                  
                </div>
            </div>
        
        <?php } ?>
    </div>
</div>
</form>	


<div class="container row">
IN TIME: <?=$check_intime;?> , Shop Name: <?=$in_info->shop_name?>
<br>
OUT TIME: <?=$check_outtime;?>, Shop Name: <?=$out_info->shop_name?>
</div>




<!-- User list items  -->


           
           
           

</div>
<!-- main page content ends -->
</main>
<!-- Page ends-->


<script>
        // var x=document.getElementById("demo");
        
        function getLocation(){
            
            if (navigator.geolocation)
            {
            navigator.geolocation.getCurrentPosition(showPosition);
            // }else{x.innerHTML="Geolocation is not supported by this browser.";
                
            }
        }
        
        
        function showPosition(position){
        // x.innerHTML="Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude;  
        
        var latitude  = position.coords.latitude;
        var longitude  = position.coords.longitude;
        
        document.getElementById("latitude").value = latitude; 
        document.getElementById("longitude").value = longitude; 
            
        }
        document.body.onload = function(){
        getLocation();
        };
        

</script>


<?php include "inc/footer.php"; ?>
