<html>
<head>
  <title>Something</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

<br>
<br>
<br>
Latitude : <br>
<input type="text" name="latitude" id="latitude" style="width: 100%;">
<br>
<br>
<br>
<br>
Longitude : <br>
<input type="text" name="longitude" id="longitude" style="width: 100%;">
<!-- <input type="text" name="time" id="time"> -->
<!-- <textarea name="return_values" id="return_values" style="height: 100px;"></textarea> -->

<p id="return_values"></p>



<script>

    getLocation();
    setInterval(function(){getLocation()},5000);
    
    
      function getLocation() {
       if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
       } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
       }
     }
    
     function showPosition(position) {
       var lat = position.coords.latitude;
       var long = position.coords.longitude;

//        var today = new Date();
// var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
// var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
// var dateTime = date+' '+time;
       
       document.getElementById("latitude").value=lat;
        document.getElementById("longitude").value=long;

        // document.getElementById("time").value=dateTime;


    
      
    }
    </script>
</body>

</html>