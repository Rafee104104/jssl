<!DOCTYPE html>
<html>
<head>
    <title>Geolocation DB - jQuery example</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>


<input type="text" name="latitude" id="latitude"  value="" readonly="">
<input type="text" name="longitude" id="longitude"  value="" readonly=""> 

    <div>Country: <span id="country"></span>
    <div>State: <span id="state"></span>
    <div>City: <span id="city"></span>
    <div>Latitude: <span id="latitude"></span>
    <div>Longitude: <span id="longitude"></span>
    <div>IP: <span id="IPv4"></span>
    
	
	
	<script>
	$.ajax({
		url: "https://geolocation-db.com/jsonp",
		jsonpCallback: "callback",
		dataType: "jsonp",
		success: function( location ) {
		
/*			$('#country').html(location.country_name);
			$('#state').html(location.state);
			$('#city').html(location.city);
			$('#latitude').html(location.latitude);
			$('#longitude').html(location.longitude);
			$('#ip').html(location.IPv4); */
			
			jQuery('#latitude').val(location.latitude);
			jQuery('#longitude').val(location.longitude);
			 
		}
	});		
    </script>
</body>
</html>