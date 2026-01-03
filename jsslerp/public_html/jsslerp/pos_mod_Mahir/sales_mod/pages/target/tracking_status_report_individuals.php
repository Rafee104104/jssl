<?php

session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";  


$apiKey = find_a_field('ss_config','map_api','id=1');


$today 			= date('Y-m-d');

$company_id   	= $_SESSION['company_id'];

$menu 			= 'Product';

$sub_menu 		= 'item_info';

$title = 'Individually Tracking Report.';



function getAddress($latitude, $longitude)
{
        //google map api url
       $url = "https://maps.google.com/maps/api/geocode/json?key=".$apiKey."&latlng=$latitude,$longitude";

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

  redirect('item_info.php');

}





?>








<style>
     
     .stepper .line {
   width: 2px;
   background-color: lightgrey !important;
 }
 .stepper .lead {
   font-size: 1.1rem;
 }

 .px-3, .py-2{
   padding-top: 1px !important;
   padding-bottom: 1px !important;
   padding-left: 5px !important;
   padding-right: 5px !important;
   background: #77F7B3 !important;
   border: 1px solid #CDD0D6;
 }


 </style>




  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    





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

				    <?php foreign_relation('ss_user','user_id','fname',$user_id,'1'); ?>

		</select>

</div>

    



<div class="col-md-2 form-group"><label>From : </label>

		<input type="date" name="fdate" id="fdate" value="<?=$_POST['fdate']?>" class="form-control">

</div>



<div class="col-md-2 form-group"><label>To :</label>

<input type="date" name="tdate" id="tdate" value="<?=$_POST['tdate']?>"  class="form-control">
		

</div>



    

    <div class="col-md-2 form-group position-relative text-center">
    <label style="width: 100%">&ensp;</label>
        <button type="submit" name="view" id="view" class="btn btn-success ">Search</button>

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

    $user_id=" and p.user_id='".$_POST['user_id']."' ";

}



if($_POST['fdate']!='' && $_POST['tdate']!=''){ 

    $date_con =" and s.do_date between '".$_POST['fdate']."' and '".$_POST['tdate']."' ";

}





if($_POST['fdate']!='' && $_POST['tdate']!=''){ 
?>
   <p style="text-align: center; font-size: 16px; font-weight: bold;">Date Interval <?=$_POST['fdate']?> To <?=$_POST['tdate']?></p>  
<?
}

?>



<div class="stepper d-flex flex-column mt-5 ml-2">



<?

 $sql="select p.region_id,p.zone_id,p.area_id,s.do_date,s.entry_at,s.entry_by as so_code,p.fname as so_name, s.latitude,s.longitude, sp.shop_name

from ss_user p, ss_do_master s, ss_shop sp

where s.entry_by = p.username and sp.dealer_code=s.dealer_code



".$date_con.$pg_con.$location.$user_id." 

and s.status in('CHECKED','COMPLETED')



order by p.region_id,p.zone_id,p.area_id,so_code,entry_at desc";



// group by s.user_id



$query = mysql_query($sql);

while($data=mysql_fetch_object($query)){

$s++;

?>
    <div class="d-flex mb-1">
      <div class="d-flex flex-column pr-4 align-items-center">
        <div class="rounded-circle py-2 px-3 bg-primary text-white mb-1">&emsp;</div>
        <div class="line h-100"></div>
      </div>
      <div>
        <h5 class="text-dark" style="margin-bottom: 0px;"><?=$data->shop_name?> , <span class="lead text-muted pb-3" style="padding-bottom: 0px !important; margin-bottom: 0px;color: #DC5BB4 !important; font-weight: bold; font-size: 15px; text-transform: uppercase"><?=date('M d, Y h:i a',strtotime($data->entry_at))?></span></h5>
    
        <p class="lead text-muted pb-3" style="padding: 0px; margin: 0px; margin-bottom: 20px;  color: #7F1AF9 !important; font-size: 17px;"><?=getAddress($data->latitude,$data->longitude)?></p>

        
      </div>
    </div>
 <? } ?>
   
  </div>


<? } ?>






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