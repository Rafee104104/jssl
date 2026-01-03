<?php

session_start();

include 'config/db.php';

include 'config/function.php';

include 'config/access.php';

$user_id	=$_SESSION['user_id'];

$today 		= date('Y-m-d');


function getAddress($latitude, $longitude)
{
        //google map api url
       $url = "https://maps.google.com/maps/api/geocode/json?key=AIzaSyCPfrXFXYtJA_xSPSP4mZcE-qlGSSQzu-0&latlng=$latitude,$longitude";

        // send http request
        $geocode = file_get_contents($url);
        $json = json_decode($geocode);
        $address = $json->results[0]->formatted_address;
        return $address;
}


$title='DO Status';





$unique 		= 'do_no';

$target_url 	= 'do_view.php';





include "inc/header.php";



if($_REQUEST[$unique]>0)

{

$_SESSION[$unique] = $_REQUEST[$unique];

header('location:'.$target_url);

}



?>

<script language="javascript">

function custom(theUrl)

{

	window.open('<?=$target_url?>?do='+theUrl);

}

</script>



<!-- main page content -->

<div class="form-container_large">

<h3>Tracking Report</h3>

<form action="" method="post" name="codz" id="codz">



<div class="row">

        

            <div class="col-3"><label>Date Form</label></div>  

            <div class="col-6"><input type="date" class="form-control" name="fdate" id="fdate" 

			value="<?=$_POST['fdate']?$_POST['fdate']:date('Y-m-01')?>" /></div>

</div>           

       

	   

<div class="row">	    

            <div class="col-3"><label>Date To</label></div> 

            <div class="col-6"><input type="date" class="form-control" name="tdate" id="tdate" 

			value="<?=$_POST['tdate']?$_POST['tdate']:date('Y-m-d')?>" />

        </div> 

</div> 	



<div class="row">	

        <div class="col-12 form-group position-relative">

            <button type="submit" name="submitit" id="submitit" class="btn btn-success position-absolute top-50 end-0 translate-middle">View</button>

        </div> 

    </div>

  </form>

  

<p><br>  

  

  <table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr>

<td><div class="tabledesign2">







<? 

if(isset($_POST['submitit'])){



    if($_POST['fdate']!=''&&$_POST['tdate']!='')

    $con .= 'and m.date between "'.$_POST['fdate'].'" and "'.$_POST['tdate'].'"';

    ?>
<table class="table table-striped table-bordered table-sm" id="grp" cellspacing="0" cellpadding="3" width="100%" style="font-size: 12px;">
<thead><tr><th>User </th><th>Date</th><th>Latitude</th><th>Longitude</th><th>Time</th><th>Address</th></tr></thead>
    <tbody>
    <?

     $res='select  * 	from user_location_tracking m   where 1    '.$con.' ';

        $result = $conn->query($res);


        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {

?>



        
    <tr>
        
    <td><?=find1("select fname from ss_user where user_id='".$row["user_id"]."'"); ?></td>
    <td><?=$row["date"]?></td>
    <td><?=$row["latitude"]?></td>
    <td><?=$row["longitude"]?></td>
    <td><?=$row["script_time"]?></td>
    <td style="width: 30%;"><?
    
    echo getAddress($row["latitude"],$row["longitude"]);
    
    ?></td>
    
    </tr>

<?  } ?>


</tbody>


</table>
<?
          } else {
            echo "0 results";
          }
?>
        

    

<? } ?>

</div></td>

</tr>

</table>

</div>

        <!-- main page content ends -->





    </main>

    <!-- Page ends-->



<?php include "inc/footer.php"; ?>