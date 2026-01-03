<!DOCTYPE html>
<html>



<body>

<input type="text" name="latitude" id="latitude"  value="" readonly="">
<input type="text" name="longitude" id="longitude"  value="" readonly=""> 


<script>

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  //x.innerHTML = "Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude;

        var latitude  = position.coords.latitude;
        var longitude  = position.coords.longitude;
        
        document.getElementById("latitude").value = latitude; 
        document.getElementById("longitude").value = longitude;
}

document.body.onload = function(){ getLocation(); };
</script>

</body>
</html>

