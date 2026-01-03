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
<td style="width: 100px;">Date : </td>
<td><input class="form-control" name="visit_date" type="date" value="<?=$_POST['visit_date']?$_POST['visit_date']:date('Y-m-d');?>" required/></td>

<td>Zone : </td> 
<td>
<select class="form-control" name="zon_id" required>
  <option value=""></option>
  <? foreign_relation('zon','ZONE_CODE','ZONE_NAME',$_POST['zon_id'],'1'); ?>
</select>  
</td>

<td>&nbsp;&nbsp;</td>
<td><input name="search" type="submit" id="search" value="Search" class="btn btn-warning" /></td>

</tr> 
</table>
</form>








<? if(isset($_POST['search'])){ 

if($_POST['zon_id']>0){ $zone_id = $_POST['zon_id']; $zone_con = ' and u.zone_id="'.$zone_id.'"';} 
if($_POST['visit_date']>0){ $visit_date = $_POST['visit_date']; $date_con = ' and m.do_date="'.$visit_date.'"';}

$sel = 'select u.username,u.fname,m.do_no,m.latitude,m.longitude,m.do_date,m.do_no,m.entry_at
from ss_do_master m, ss_user u
where m.entry_by=u.username 
'.$zone_con.$date_con.'
group by m.entry_by order by m.entry_at desc';
$apiKey = find_a_field('ss_config','map_api','id=1');
?>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?=$apiKey?>&sensor=false"></script>

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
    echo '"description" :'."'Name : ".$row->username.'-'.$row->fname." <br> DO No : ".$row->do_no.
   " <br> DO Date : ".$row->do_date.
   " <br> Entry At : ".$row->entry_at."  '";
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
