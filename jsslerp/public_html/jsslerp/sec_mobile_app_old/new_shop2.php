<?php

session_start();

include 'config/db.php';

include 'config/function.php';

include 'config/access.php';



$today = date('Y-m-d');



$user_id	=$_SESSION['user_id'];

$username	=$_SESSION['username'];



$page="new_shop";

include "inc/header.php";







if(isset($_REQUEST['submit']) && $_POST['randcheck']==$_SESSION['rand']){



// check mobile number

$check_mobile=find1("select mobile from ss_shop where mobile='".$_POST['mobile']."' ");

if($check_mobile==''){





    $_POST['status']='1';

    $_POST['entry_by']=$username;

    $_POST['emp_code']=$username;

    $_POST['entry_at']=date('Y-m-d H:i:s');

    

// image upload

$ff = $username.'_'.time();

$target_dir = "uploads/";

$file_name=$target_dir.''.$ff;



$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

$uploadOk = 1;

$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));



// Check file size

if ($_FILES["fileToUpload"]["size"] > 26214400000) {

  echo "Sorry, your file is too large.<br>";

  $uploadOk = 0;

}



// Allow certain file formats

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {

  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";

  //echo "Sorry, your given file type is not allowed.<br>";

  $uploadOk = 0;

  $image_ok=0;

}



$file_name=$file_name.'.'.$imageFileType;



// Check if $uploadOk is set to 0 by an error

if ($uploadOk == 0) {

  echo "Sorry, your file was not uploaded.<br>";



// if everything is ok, try to upload file

} else {

 

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $file_name)) {

            

            

// -------------------------------------   Start image small size	------------------------------------



$file = getimagesize($file_name);



$split = explode(".",$file_name);

$new_name = $split[0];

$image_sm = $new_name.'_sm.jpg';



// Content type

header('Content-Type: image/jpeg');

			

				list($width,$height)= getimagesize($file_name);

				$nwidth=$width/4;

				$nheight=$height/4;

				$newimage = imagecreatetruecolor($nwidth,$nheight);

			

					if($file['mime']=="image/jpeg"){

						$source=imagecreatefromjpeg($file_name);

					}elseif($file['mime']=="image/png"){

						$source=imagecreatefrompng($file_name);

					}elseif($file['mime']=="image/jpg"){

						$source=imagecreatefromjpg($file_name);

					}

			

				imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);

				imagejpeg($newimage,$image_sm);

	

// end image small process	           

            

            

         

        echo "Picture has been uploaded.<br>";

        } else {

        echo "Sorry, there was an error uploading your file.<br>";

        }



    

}



// end image upload



if($uploadOk==0) { $file_name=''; }    



$_POST['picture']= $file_name;  

$_POST['picture_sm']= $image_sm; 

    
$_POST['master_dealer_code']= $_SESSION['warehouse_id']; 

    @insert('ss_shop');

    

    $msg="New Shop Registration Success";

    redirect("home.php");





    

}else{    

    echo 'Sorry your given Mobile number alerady in our Database. So, Please check';

}



}





?>

<!-- main page content -->

<div class="main-container container">

           

<!-- body  -->

<div class="row">

<div class="row text-center mb-12"><h4>Shop Information</h4></div>    

    



            <div class="row">

                <div class="col-12 col-md-12 col-lg-12 mx-auto">

                    <div class="card card-light shadow-sm mb-12">

                        <div class="card-body">



<form class="" method="post" action="" enctype="multipart/form-data">

<?php $rand=rand(); $_SESSION['rand']=$rand; ?>

<input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />                                



                                <div class="form-floating mb-3">

                                    <select class="form-select form-control" name="region_id" id="region_id">

                                        <option value="<?=$_SESSION['region_id']?>"><?=find1("select BRANCH_NAME from branch where BRANCH_ID='".$_SESSION['region_id']."' ");?></option>

                                    </select>

                                    <label for="select">Region</label>

                                </div>

                                

                                <div class="form-floating mb-3">

                                    <select class="form-select form-control" name="zone_id" id="zone_id">

                                        <option value="<?=$_SESSION['zone_id']?>"><?=find1("select ZONE_NAME from zon where ZONE_CODE='".$_SESSION['zone_id']."' ");?></option>

                                    </select>

                                    <label for="select">Zone</label>

                                </div> 

                                

                                <div class="form-floating mb-3">

                                    <select class="form-select form-control" name="area_id" id="area_id">

                                        <option value="<?=$_SESSION['area_id']?>"><?=find1("select AREA_NAME from area where AREA_CODE='".$_SESSION['area_id']."' ");?></option>

                                    </select>

                                    <label for="select">Area</label>

                                </div>                                 



                                <div class="form-floating mb-3">

                                    <select class="form-select form-control" name="route_id" id="route_id" required>

                                        <option></option>

                                        <? optionlist("select route_id,route_name from ss_route where area_id='".$_SESSION['area_id']."' order by route_name"); ?>

                                    </select>

                                    <label for="select">Route</label>

                                </div> 

                                

                                





                                <div class="form-floating mb-3">

                                    <input type="text" class="form-control" name="shop_name" id="shop_name"  value="" required>

                                    <label for="city">Shop Name</label>

                                </div>

                                <div class="form-floating mb-3">

                                    <input type="text" class="form-control" name="shop_address" id="shop_address"  value="" required>

                                    <label for="city">Full Address</label>

                                </div>                                

                                <div class="form-floating mb-3">

                                    <input type="text" class="form-control" name="shop_owner_name" id="shop_owner_name"  value="" required>

                                    <label for="city">Owner Name</label>

                                </div>



                                <div class="form-floating mb-3">

                                    <input type="number" min="8800000000000" max="8899999999999" step="1" class="form-control" name="mobile" id="mobile" value="8801" required>

                                    <label for="city">Owner Mobile <span style="color:red;">(Must be Unique)</span></label>

                                </div>

                                

                                <div class="form-floating mb-3">

                                    <input type="text" class="form-control" name="manager_name" id="manager_name"  value="" required>

                                    <label for="city">Manager Name</label>

                                </div>



                                <div class="form-floating mb-3">

                                    <input type="number" class="form-control" name="manager_mobile" id="manager_mobile" value="8801" >

                                    <label for="city">Manager Mobile</label>

                                </div>   
                                
                                
                                <div class="form-floating mb-3">

                                <select class="form-control col-md-12" name="shop_identity" required>

<option><?=$show2->shop_identity?$show2->shop_identity:'Other'?></option>

<option>MEP</option><option>Other</option>



</select>

                                    <label for="city">Shop Identity</label>

                                </div>  



                                <div class="form-floating mb-3">

                                <select class="form-control col-md-12" name="shop_class" required>

<option><?=$show2->shop_class?></option>

<option>Gold 50000 to 100000</option>

<option>Diamond 100000 to 150000</option>

<option>Silver 25000 to 50000</option>

<option>Platinum Plus 200000 to above</option>

<option>Bronze 1 to 25000</option>

<option>Platinum 150000 to 200000</option>

</select>

<label for="city">Shop Class<span class="required"></span></label>

</div> 

                                

                                




<div class="form-floating mb-3">

<select class="form-control col-md-12" name="shop_type" required>

<option><?=$show2->shop_type?></option>

<option>Retailer</option>

<option>WholeSale</option>

<option>Semi WholeSaler</option>

</select>

                                    <label for="city">Shop Type<span class="required"></span></label>

                                </div> 






<div class="form-floating mb-3">

<select class="form-control col-md-12" name="shop_channel" required>

<option><?=$show2->shop_channel?></option>

<option>Electric</option>

<option>Electronics</option>

<option>Stationary</option>

<option>Departmental Store</option>

<option>Grosary </option>

<option>Hardware</option>

<option>Library</option>

<option>Pharmacy</option>

</select>

                                    <label for="city">Shop Channel<span class="required"></span></label>

                                </div> 









<div class="form-floating mb-3">

<select class="form-control col-md-12" name="shop_route_type" required>

<option><?=$show2->shop_route_type?></option>

<option>Bazar</option>

<option>Outsite  Bazar</option>

</select>

                                    <label for="city">Shop Route Type<span class="required"></span></label>

                                </div> 



                                

          
<div class="form-floating mb-3">
<input type="text" class="form-control" name="latitude" id="latitude" onkeydown="return false;" required>
<label for="Latitude">Latitude</label>
</div>                       

                         
<div class="form-floating mb-3">
<input type="text" class="form-control" name="longitude" id="longitude"  onkeydown="return false;" required>
<label for="Longitude">Longitude</label>
</div>                   

                          

<div class="form-floating mb-3">
<textarea id="adress" class="form-control"></textarea>

</div>                       


                       

             
                            

                            <div class="form-floating mb-3">

                            <input type="file" name="fileToUpload" id="fileToUpload" autocomplete="off" value="<?=$show->picture?>" class="form-control" required>

<label class="control-label" for="picture">Image<span class="required"></span></label>

</div>     





<div class="row mb-12">
<style>
  #mapCanvasss {
  width: 500px;
  height: 400px;
  float: left;
}

#infoPanel {
  float: left;
  margin-left: 10px;
}

#infoPanel div {
  margin-bottom: 5px;
}
</style>
<div id="panel" class="text-center">
  <!--<input id="city_country" type="textbox" value="Berlin, Germany">-->
  <input type="button" id="locatedMe" value="Locate Me" class="btn btn-danger" onclick="initMap()" >
</div>
<div id="mapCanvasss"></div>
<div id="infoPanel" style="display: none;">
  <b>Marker status:</b>
  <div id="markerStatus"><i>Click and drag the marker.</i></div>
  <b>Current position:</b>
  <div id="info"></div>
  <b>Closest matching address:</b>
  <div id="address"></div>
</div>
<!-- Replace the value of the key parameter with your own API key. -->
<? $apiKey = find_a_field('ss_config','map_api','id=1'); ?>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?=$apiKey?>">
</script>
<script>


  // Note: This example requires that you consent to location sharing when
// prompted by your browser. If you see the error "The Geolocation service
// failed.", it means you probably did not give permission for the browser to
// locate you.
var map, infoWindow;
var geocoder;

window.initMap = function() {
  geocoder = new google.maps.Geocoder();
  map = new google.maps.Map(document.getElementById('mapCanvasss'), {
    center: {
      lat: -34.397,
      lng: 150.644
    },
    zoom: 19
  });
  infoWindow = new google.maps.InfoWindow;
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

      var marker = new google.maps.Marker({
        position: pos,
        map: map,
        draggable: true,
        title: 'Your position'
      });
      infoWindow.setPosition(pos);
      infoWindow.setContent('Your position');
      marker.addListener('click', function() {
        infoWindow.open(map, marker);
      });
      infoWindow.open(map, marker);
      map.setCenter(pos);


      updateMarkerPosition(marker.getPosition());
      geocodePosition(pos);

      // Add dragging event listeners.
      google.maps.event.addListener(marker, 'dragstart', function() {
        updateMarkerAddress('Dragging...');
      });

      google.maps.event.addListener(marker, 'drag', function() {
        updateMarkerStatus('Dragging...');
        updateMarkerPosition(marker.getPosition());
      });

      google.maps.event.addListener(marker, 'dragend', function() {
        updateMarkerStatus('Drag ended');
        geocodePosition(marker.getPosition());
        map.panTo(marker.getPosition());
      });

      google.maps.event.addListener(map, 'click', function(e) {
        updateMarkerPosition(e.latLng);
        geocodePosition(marker.getPosition());
        marker.setPosition(e.latLng);
        map.panTo(marker.getPosition());
      });

    }, function() {
      handleLocationError(true, infoWindow, map.getCenter());
    });
  } else {
    // Browser doesn't support Geolocation
    handleLocationError(false, infoWindow, map.getCenter());
  }

}

function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0].formatted_address);
    } else {
      updateMarkerAddress('Cannot determine address at this location.');
    }
  });
}

function updateMarkerStatus(str) {
  document.getElementById('markerStatus').innerHTML = str;
}

function updateMarkerPosition(latLng) {

    document.getElementById('latitude').value = latLng.lat()
    document.getElementById('longitude').value = latLng.lng()
//   document.getElementById('info').innerHTML = [
//     latLng.lat(),
//     latLng.lng()
//   ].join(', ');
}

function updateMarkerAddress(str) {
//   document.getElementById('adress').innerHTML = str;
  document.getElementById('adress').value = str;
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(browserHasGeolocation ?
    'Error: The Geolocation service failed.' :
    'Error: Your browser doesn\'t support geolocation.');
  infoWindow.open(map);
}
</script>
</div>


                            

                            <div class="d-grid"><input type="submit" name="submit" class="btn btn-lg btn-default shadow-sm btn-rounded" value="ADD New"/></div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>









</div>           

</div>




</main>

<!-- Page ends-->

<?php include "inc/footer.php"; ?>




