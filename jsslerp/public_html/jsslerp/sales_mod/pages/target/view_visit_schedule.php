<?php
session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";  


$today 			  = date('Y-m-d');
$company_id   = $_SESSION['company_id'];
$menu 			  = 'Visit';
$sub_menu 		= 'view_visit_schedule';



?>






  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  



    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">






<form  method="post" action="">
<table width="100%" border="0" cellspacing="0" cellpadding="0">


<tr>
<td style="width: 100px;">Date : </td>
<td><input class="form-control" name="visit_date" type="date" value="<?=$_POST['visit_date']?>" required/></td>

<td>SO List : </td> 
<td>
<select class="form-control" name="PBI_ID" required>
  <option value=""></option>
  <? foreign_relation('ss_user','username','concat(username,"-",fname) as fname',$_POST['PBI_ID'],'1 and status="Active"'); ?>
</select>  
</td>

<td>&nbsp;&nbsp;</td>
<td><input name="search" type="submit" id="search" value="Search" class="btn btn-warning" /></td>

</tr> 
</table>
</form>















<? if(isset($_POST['search'])){
  
  
  $apiKey = find_a_field('ss_config','map_api','id=1');
  
  ?>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?=$apiKey?>&sensor=false"></script>

Map View  

<div id="dvMap" style="width: 100%; height: 500px"></div>

 
<script type="text/javascript">
    var markers = [
          
<?
$route_id = find_a_field('ss_schedule','route_id','date="'.$_POST['visit_date'].'" and PBI_ID="'.$_POST['PBI_ID'].'"');

$sel = 'select * from ss_shop where route_id="'.$route_id.'"  order by dealer_code';
$qur = mysql_query($sel);
while($row = mysql_fetch_object($qur)){
  // echo $row->do_no;
  // echo $row->lati;
  // echo $row->longi;
  // echo $row->shop_name;
  // echo $row->entry_at;
  // echo $row->entry_by;
  echo "{";
    echo '"title" :'."'".$row->shop_name."', ";
    echo '"lat" :'."'".$row->latitude."', ";
    echo '"lng" :'."'".$row->longitude."', ";
    echo '"description" :'."'".$row->shop_name."'";
    echo "},";
}
?>
];
        
        
        window.onload = function () {
            var mapOptions = {
                center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
                zoom: 10,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
            var infoWindow = new google.maps.InfoWindow();
            var lat_lng = new Array();
            var latlngbounds = new google.maps.LatLngBounds();
            for (i = 0; i < markers.length; i++) {
                var data = markers[i]
                var myLatlng = new google.maps.LatLng(data.lat, data.lng);
                lat_lng.push(myLatlng);
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map,
                    title: data.title
                });
                latlngbounds.extend(marker.position);
                (function (marker, data) {
                    google.maps.event.addListener(marker, "click", function (e) {
                        infoWindow.setContent(data.description);
                        infoWindow.open(map, marker);
                    });
                })(marker, data);
            }
            map.setCenter(latlngbounds.getCenter());
            map.fitBounds(latlngbounds);




//***********ROUTING****************//
 
//Initialize the Direction Service
var service =new google.maps.DirectionsService();
 
//Loop and Draw Path Route between the Points on MAP
for (var i = 0; i < lat_lng.length; i++) {
    if ((i + 1) < lat_lng.length) {
      var src = lat_lng[i];
      var des = lat_lng[i + 1];   
      console.log(src);     
      service.route({
        origin: src,
        destination: des,
        travelMode: google.maps.DirectionsTravelMode.WALKING
        },function (result, status) {
            if (status == google.maps.DirectionsStatus.OK) {           
            //Initialize the Path Array
            var path =new google.maps.MVCArray();
            //Set the Path Stroke Color
            var poly =new google.maps.Polyline({ map: map, strokeColor:'#00FF00',strokeOpacity: 1.0,
          strokeWeight: 4 });
             
            poly.setPath(path);
             
                for (var i = 0, len = result.routes[0].overview_path.length; i < len; i++) {
                    path.push(result.routes[0].overview_path[i]);
                }
            }
        });
    }
}


var markers2 = [
          
<?

$route_id = find_a_field('ss_schedule','route_id','date="'.$_POST['visit_date'].'" and PBI_ID="'.$_POST['PBI_ID'].'"');

$sels = 'select d.latitude,d.longitude,s.shop_name,d.do_no,d.do_date,d.entry_by,d.entry_at 
from ss_do_master d, ss_shop s 
where d.dealer_code=s.dealer_code and s.route_id="'.$route_id.'" and d.entry_by="'.$_POST['PBI_ID'].'" and d.do_date="'.$_POST['visit_date'].'"
order by d.do_no';

$qurs = mysql_query($conn,$sels);
while($rows = mysql_fetch_object($qurs)){
 // echo $row->do_no;
 // echo $row->lati;
 // echo $row->longi;
 // echo $row->shop_name;
 // echo $row->entry_at;
 // echo $row->entry_by;
 echo "{";
   echo '"title" :'."'".$rows->shop_name."', ";
   echo '"lat" :'."'".$rows->latitude."', ";
   echo '"lng" :'."'".$rows->longitude."', ";
   echo '"description" :'."' Shop Name : ".$rows->shop_name." <br> DO No : ".$rows->do_no.
   " <br> DO Date : ".$rows->do_date.
   " <br> Entry By : ".$rows->entry_by." <br> Entry At : ".$rows->entry_at."  '";
   echo "},";
}
?>
];

var mapOptions = {
                center: new google.maps.LatLng(markers2[0].lat, markers2[0].lng),
                zoom: 10,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var infoWindow2 = new google.maps.InfoWindow();
            var lat_lng2 = new Array();
            var latlngbounds = new google.maps.LatLngBounds();
            for (i = 0; i < markers2.length; i++) {
                var data2 = markers2[i]
                var myLatlng2 = new google.maps.LatLng(data2.lat, data2.lng);
                lat_lng2.push(myLatlng2);
                var marker2 = new google.maps.Marker({
                    position: myLatlng2,
                    icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
                    map: map,
                    title: data2.title,
                });
                latlngbounds.extend(marker2.position);
                (function (marker2, data2) {
                    google.maps.event.addListener(marker2, "click", function (e) {
                        infoWindow2.setContent(data2.description);
                        infoWindow2.open(map, marker2);
                    });
                })(marker2, data2);
            }
            map.setCenter(latlngbounds.getCenter());
            map.fitBounds(latlngbounds);

 
 
 //***********ROUTING****************//

            //Intialize the Path Array
            var path = new google.maps.MVCArray();

            //Intialize the Direction Service
            var service = new google.maps.DirectionsService();

            //Set the Path Stroke Color
            //var poly = new google.maps.Polyline({ map: map, strokeColor: '#FF0000',strokeOpacity: 1.0, strokeWeight: 7  });

            //Loop and Draw Path Route between the Points on MAP
            for (var i = 0; i < lat_lng2.length; i++) {
                if ((i + 1) < lat_lng2.length) {
                    var src = lat_lng2[i];
                    var des = lat_lng2[i + 1];
                    path.push(src);
                    poly.setPath(path);
                    service.route({
                        origin: src,
                        destination: des,
                        travelMode: google.maps.DirectionsTravelMode.DRIVING
                    }, function (result, status) {
                        if (status == google.maps.DirectionsStatus.OK) {
                            for (var i = 0, len = result.routes[0].overview_path.length; i < len; i++) {
                                path.push(result.routes[0].overview_path[i]);
                            }
                        }
                    });
                }
            }

        }
    </script>
    

<? } ?>









      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 

  <?



$main_content=ob_get_contents();



ob_end_clean();



include ("../../template/main_layout.php");



?>
