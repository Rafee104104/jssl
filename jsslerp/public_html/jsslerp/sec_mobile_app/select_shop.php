<?php
session_start();
include 'config/db.php';
include 'config/function.php';
include 'config/access.php';

$today = date('Y-m-d');

$user_id	=$_SESSION['user_id'];
$username	=$_SESSION['username'];
$product_group	=$_SESSION['product_group'];
$region_id	=$_SESSION['region_id'];
$zone_id	=$_SESSION['zone_id'];
$area_id	=$_SESSION['area_id'];


$page="page";
include "inc/header.php";







if(isset($_REQUEST['check_shop']) && $_POST['randcheck']==$_SESSION['rand']){

// from
$lat1= $_POST['latitude'];
$long1=$_POST['longitude'];

// to
$lat2=$_POST['latitude2'];
$long2=$_POST['longitude2'];   


$distance = getDistance($lat1,$long1,$lat2,$long2);


}













?>
<!-- main page content -->
<div class="main-container container">
           
<!-- body  -->
<div class="row">
<div class="row text-center mb-2"><h4>Select Shop</h4></div>    
    

<? 
if(isset($_REQUEST['check_shop'])){
    $order_km = find1('select order_km from ss_config where id=1');
echo 'Rules: Order distance must be: '.$order_km.' km';    

echo '<br><br>Shop Distance from you '.$distance.' km';

echo '<br>';
    if($distance<=$order_km) {
        echo 'Ok, you can take order';
        redirect('do.php?pal=2&party='.$_POST['dealer_code']);
        
    }else{ 
        echo 'Sorry, you are out of range.';
        
    }


}
?>



<div class="row">
                <div class="col-12 col-md-6 col-lg-4 mx-auto">
                    <div class="card card-light shadow-sm mb-4">
                        <div class="card-body">
                            
                            <form class="" method="post" action="">
<?php $rand=rand(); $_SESSION['rand']=$rand; ?>
<input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />                                

                                <div class="form-floating mb-3">
                                    <select class="form-select form-control" name="dealer_code" id="dealer_code" reqired onChange="getData()">
                                        <option></option>
<? 
optionlist('select dealer_code,shop_name from ss_shop where status="1" and region_id="'.$region_id.'" and zone_id="'.$zone_id.'" and area_id="'.$area_id.'" order by shop_name');
?>
                                    </select>
                                    <label for="select">Shop</label>
                                </div>
                                


                            <div class="row">
                                <div class="col-sm-6 form-floating mb-3">
                                    <input type="text" class="form-control" name="latitude2" id="latitude2" value="" readonly="" required>
                                    <label for="Latitude">Shop Latitude</label>
                                </div>
                                <div class="col-sm-6 form-floating mb-3">
                                    <input type="text" class="form-control" name="longitude2" id="longitude2" value="" readonly="" required>
                                    <label for="Longitude">Shop Longitude</label>
                                </div>                                
                            </div>


                                
                            <div class="row">
                                <div class="col-sm-6 form-floating mb-3">
                                    <input type="text" class="form-control" name="latitude" id="latitude" value="" readonly="" required>
                                    <label for="Latitude">Latitude</label>
                                </div>
                                <div class="col-sm-6 form-floating mb-3">
                                    <input type="text" class="form-control" name="longitude" id="longitude" value="" readonly="" required>
                                    <label for="Longitude">Longitude</label>
                                </div>                                
                            </div>
                                
                                

                            
                            <div class="d-grid"><input type="submit" name="check_shop" class="btn btn-lg btn-default shadow-sm btn-rounded" value="Submit"/></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>











</div>           
</div>
<!-- main page content ends -->
<script>
// var x = document.getElementById("demo");
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}
function showPosition(position) {
//   x.innerHTML = "Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude;
  
  document.getElementById("latitude").value = position.coords.latitude;
  document.getElementById("longitude").value = position.coords.longitude;
  
}

getLocation();
</script>

</main>
<!-- Page ends-->
<?php include "inc/footer.php"; ?>



<script>
function getData(){
    
var id = document.getElementById("dealer_code").value;

		jQuery.ajax({
			url:'ajax_location.php',
			type:'post',
			data:'id='+id,
			success:function(result){
				var json_data=jQuery.parseJSON(result);

				jQuery('#latitude2').val(json_data.lat2);
				jQuery('#longitude2').val(json_data.long2);

			}

		})
	
}
</script> 