<?php
session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";  


$today 			  = date('Y-m-d');
$company_id   = $_SESSION['company_id'];
$menu 			  = 'Tracking';
$sub_menu 		= 'track_last_location';






?>






  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   



    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">



<form  method="post" action="">
<table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr>

<td>Route : </td> 
<td>
<select class="form-control" name="route_id" required>
  <option value=""></option>
  <? foreign_relation('ss_route','route_id','route_name',$_POST['route_id'],'1'); ?>
</select>   
</td>

<td>&nbsp;&nbsp;</td>
<td><input name="search" type="submit" id="search" value="Search" class="btn btn-warning" /></td>

</tr> 
</table>
</form>






<div class="card-body">

<? if(isset($_POST['search'])){ 

if($_POST['route_id']>0){ $route_id = $_POST['route_id']; $route_con = ' and  route_id="'.$route_id.'"';$route_con2 = '  route_id="'.$route_id.'"';} 

$sel = 'select *
from ss_shop
where 1
'.$route_con.'
order by region_id,zone_id,area_id';

$count = find_a_field('ss_shop','count(*)',$route_con2);

echo 'Result: '.$count;



$apiKey = find_a_field('ss_config','map_api','id=1');
?>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?=$apiKey?>&sensor=true"></script>

<div id="dvMap" style="width: 100%; height: 550px"></div>

<script type="text/javascript">
    var markers = [
          
<?

$qur = mysql_query($sel);
while($row = mysql_fetch_object($qur)){

  echo "{";
    echo '"title" :'."'".$row->fname."', ";
    echo '"lat" :'."'".$row->latitude."', ";
    echo '"lng" :'."'".$row->longitude."', ";
    echo '"description" :'."'".$row->shop_name.'-'.$row->dealer_code."', ";
    echo "},";
}
?>,
];
        
        
window.onload = function () {
            
            
            var mapOptions = {
                center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
                zoom: 15,
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
                    google.maps.event.addListener(marker, "mouseover", function (e) {
                        infoWindow.setContent(data.description);
                        infoWindow.open(map, marker);
                    });
                })(marker, data);
            }
            map.setCenter(latlngbounds.getCenter());
            map.fitBounds(latlngbounds);


}
</script>






<? } ?>







</div>








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
