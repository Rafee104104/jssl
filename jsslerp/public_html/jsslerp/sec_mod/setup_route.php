<?php
session_start ();
include ("config/access_admin.php");
include ("config/db.php");
include 'config/function.php';


$today 			    = date('Y-m-d');
$company_id         = $_SESSION['company_id'];
$menu 			    = 'Setup Location';
$sub_menu 		    = 'setup_route';




if(isset($_REQUEST['new']) && $_POST['randcheck']==$_SESSION['rand']){

  @insert('ss_route');
  $msg="New data insert successfully";
}


if(isset($_REQUEST['delid']) && $_REQUEST['delid']>0){	
  $delid = $_REQUEST['delid'];
  mysqli_query($conn, "delete from ss_route where route_id='".$delid."'");
  
  $msg="Delete successfully";
  redirect('setup_route.php');
}



if(isset($_POST['update'])){
  unset($_POST['update']);
  unset($_POST['randcheck']);
  
  update('ss_route','route_id="'.$_GET['edit_id'].'"');
  
  $msg= "Update successfully";
  //redirect('setup_route.php');
}

if($_GET['edit_id']>0){
$ss="select * from ss_route where route_id='".$_GET['edit_id']."'";
$show2 = findall($ss);

$zone_id    =find1('select ZONE_ID from area where AREA_CODE="'.$show2->area_id.'"');
$region_id = find1('select REGION_ID from zon where ZONE_CODE="'.$zone_id.'"');

}
?>



<?php
include 'inc/header.php';
include 'inc/sidebar.php';
?>  



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Route Setup</h1>
          </div>
<!--           <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div> -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->



    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">



        <div class="row">
          <!-- left column -->
          <div class="col-md-5">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Fill Up Below Information</h3>
              </div>
              <!-- /.card-header -->



<!-- form start -->
<div class="card-body">              
<form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
<?php $rand=rand(); $_SESSION['rand']=$rand; ?>
<input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />


<div class="row mb-10 form-group">
<label class="control-label col-md-4" for="">Region<span class="required"></span></label>
<div class="col-md-8">
    <select class="form-control col-md-12" required id="region" onchange="FetchZone(this.value)">
        <option value="<?=$region_id?>"><?=find1("select BRANCH_NAME from branch where BRANCH_ID='".$region_id."'");?></option>
<? optionlist('select BRANCH_ID,BRANCH_NAME from branch where 1 order by BRANCH_NAME');?>
    </select>
</div></div>


<div class="row mb-10 form-group">
<label class="control-label col-md-4" for="zone_id">Zone<span class="required"></span></label>
<div class="col-md-8">
    <select class="form-control col-md-12" required id="zone" onchange="FetchArea(this.value)">
        <option value="<?=$zone_id?>"><?=find1("select ZONE_NAME from zon where ZONE_CODE='".$zone_id."'");?></option>
    </select>
</div></div>


<div class="row mb-10 form-group">
<label class="control-label col-md-4" for="area_id">Area<span class="required"></span></label>
<div class="col-md-8">
    <select class="form-control col-md-12" name="area_id" required id="area" onchange="FetchRoute(this.value)">
        <option value="<?=$show2->area_id?>"><?=find1("select AREA_NAME from area where AREA_CODE='".$show2->area_id."'");?></option>
    </select>
</div></div>


<div class="row mb-10 form-group">
	<label class="control-label col-md-4" for="">Route name<span class="required"></span></label>
	<div class="col-md-8">
	<input type="text" name="route_name" required="required" value="<?=$show2->route_name?>" class="form-control col-md-12">
	</div>
</div>

			
						

					  
<div class="ln_solid mt-5"></div>
<div class="form-group">
<div class="col-md-6 col-sm-6 col-md-offset-3">
<!--<button class="btn btn-primary" type="reset">Reset</button>-->
<? if($_GET['edit_id']>0){?>
<button name="update" type="submit"  class="btn btn-success">Update</button>
<? }else{ ?>
<button name="new" type="submit"  class="btn btn-success">Create</button>
<? } ?>
</div>
</div>



</form>
</div>


</div>
</div>







     <div class="col-md-7">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Route List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-2">
                    <table id="examplefull" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Route ID</th>
                      <th>Route Name</th>
                      <th>Area</th>
                      <th>Zone</th>
                      <th>Region</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
<?php 
$sql = "select ss_route.*,area.AREA_NAME as area_name,area.AREA_CODE from ss_route 
LEFT JOIN area ON ss_route.area_id=area.AREA_CODE
where 1 order by area_id,route_name";

$query=mysqli_query($conn, $sql);
while($data=mysqli_fetch_object($query)){
?>                  	
                    <tr>
                      <td><?=$data->route_id?></td>
                      <td><?=$data->route_name?></td>
                      <td><?=$data->area_name?></td>
                      <td><?=$data->zone_name?></td>
                      <td><?=find1('select BRANCH_NAME from branch where BRANCH_ID="'.$data->REGION_ID.'"');?></td>
                      <td>
	<a href="setup_route.php?edit_id=<?=$data->route_id;?>">Edit</a> || 
	<a href="setup_route.php?delid=<?=$data->route_id;?>" onClick="return confirm('Do you want to delete')">Delete</a>
					</td>
                    </tr>
<? } ?>                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>









          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->








      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 


<?php include 'inc/footer.php'; ?>  



<script type="text/javascript">
  function FetchZone(id){
    $('#zone').html('');
    $('#area').html('');
    $.ajax({
      type:'post',
      url: 'get_data.php',
      data : { region_id : id},
      success : function(data){
         $('#zone').html(data);
      }

    })
  }

  function FetchArea(id){ 
    $('#area').html('');
    $.ajax({
      type:'post',
      url: 'get_data.php',
      data : { zone_id : id},
      success : function(data){
         $('#area').html(data);
      }

    })
  }
  
    function FetchRoute(id){
    $('#route').html('');
    $.ajax({
      type:'post',
      url: 'get_data.php',
      data : { area_id : id},
      success : function(data){
         $('#route').html(data);
      }

    })
  }  
</script>