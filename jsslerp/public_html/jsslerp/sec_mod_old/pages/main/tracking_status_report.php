<?php

session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";  


$apiKey = find_a_field('ss_config','map_api','id=1');


$today 			= date('Y-m-d');

$company_id   	= $_SESSION['company_id'];

$menu 			= 'Product';

$sub_menu 		= 'item_info';

$title = 'Tracking Report';


function getAddress($latitude, $longitude)
{
        //google map api url
       $url = "https://maps.google.com/maps/api/geocode/json?key=".$apiKey ."&latlng=$latitude,$longitude";

        // send http request
        $geocode = file_get_contents($url);
        $json = json_decode($geocode);
        $address = $json->results[0]->formatted_address;
        return $address;
}




if(isset($_REQUEST['delid']) && $_REQUEST['delid']>1){	

  $delid = $_REQUEST['delid'];

  mysql_query($conn, "delete from item_info where item_id='".$delid."'");

  $msg="Delete successfully";


}





?>












  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-12">

            <h5 class="m-0"></h5>

          </div>

     



        </div><!-- /.row -->

      </div><!-- /.container-fluid -->

    </div>

    <!-- /.content-header -->





<!-- Main content -->

<section class="content">

<div class="container-fluid">









            

             



<div class="card mb-4">

<div class="card-body">





<form action="" method="post"> 

<div class="row">

    

<div class="col-md-4 form-group"><label>FO Name</label>

		<select class=" form-control border border-info" name="user_id" required id="item_group" onchange="FetchItemCategory(this.value)">

		<? if($_POST['user_id']>0){ ?>		    

				    <option value="<?php echo $_POST['user_id']?>"><?=find_a_field('ss_user','fname',"user_id='".$_POST['user_id']."'")?></option>

		<? }else{ ?>		    

				    <option></option> 

		<? } ?>		  

				    <?php foreign_relation('ss_user','user_id','fname',$user_id,'1');  ?>

		</select>

</div>

    



<div class="col-md-2 form-group"><label>From : </label>

		<input type="date" name="fdate" id="fdate" value="<?=$_POST['fdate']?>" class="form-control">

</div>



<div class="col-md-2 form-group"><label>To :</label>

<input type="date" name="tdate" id="tdate" value="<?=$_POST['tdate']?>"  class="form-control">
		

</div>



    

    <div class="col-md-2 form-group position-relative">

        <button type="submit" name="view" id="view" class="btn btn-success position-absolute top-50 end-0 translate-middle">Search</button>

    </div> 





</div><!--END ROW-->



</form>













<div class="row">

<div class="col-md-12 col-xs-12">

<div class="x_panel">

<div class="x_title"><div class="clearfix"></div></div>

<div class="x_content">

                     



<?php

$condition='';

$condition1='';














if(isset($_POST['view'])){

    

    

if($_POST['user_id']!=''){ 

    $user_id=" and user_id='".$_POST['user_id']."'";

}



if($_POST['fdate']!='' && $_POST['tdate']!=''){ 

    $date_con =" and date between '".$_POST['fdate']."' and '".$_POST['tdate']."' ";

}










 echo $sql="select p.* from user_location_tracking p where 1 ".$user_id.$date_con;

}

if($_POST['fdate']!='' && $_POST['tdate']!=''){ 
?>
   <p style="text-align: center; font-size: 16px; font-weight: bold;">Date Interval <?=$_POST['fdate']?> To <?=$_POST['tdate']?></p>  
<?
}

?>







<table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">

	  <thead>

							<tr>
							   <th>FO Name</th>
							   <th>Latitude</th>
							   <th>Longitude</th>
							   <th>Date Time</th>
							   <th>Address</th>
							   <th>Location View</th>
							</tr>

	  </thead>

	  <tbody>

			<?php 

			$i=1;

            $res=mysql_query($sql);

			while($row=mysql_fetch_assoc($res)){

			   
			?>

			<tr>

			   <td><?php echo $row['user_id']." - "; echo find_a_field('ss_user','fname','user_id="'.$row['user_id'].'"');  ?></td>

			   <td><?php echo $row['latitude']?></td>

			   <td><?php echo $row['longitude']?></td>

			   <td><?php echo $row['script_time']?></td>

			   <td style="max-width: 30%;"><?php echo getAddress($row["latitude"],$row["longitude"]); ?></td>
<td><a href="https://maps.google.com/?q=<?php echo $row['latitude']?>+<?php echo $row['longitude']?>" class="btn btn-success btn-xs" target="_blank">View</a></td>

</tr>

<?php } ?>

  </tbody>

</table>





</div></div></div></div>





</div></div>			

<!-- /end Body page -->

			

			

















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



<script type="text/javascript">

  function FetchItemCategory(id){

    $('#category_id').html('');

    $('#subcategory_id').html('');

    $.ajax({

      type:'post',

      url: 'get_data.php',

      data : { item_group : id},

      success : function(data){

         $('#category_id').html(data);

      }



    })

  }



  function FetchItemSubcategory(id){

    $('#subcategory_id').html('');

    $.ajax({

      type:'post',

      url: 'get_data.php',

      data : { category_id : id},

      success : function(data){

         $('#subcategory_id').html(data);

      }



    })

  }



</script>