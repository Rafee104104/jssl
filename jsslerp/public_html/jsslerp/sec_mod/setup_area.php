<?php
session_start ();
include ("config/access_admin.php");
include ("config/db.php");
include 'config/function.php';


$today 			    = date('Y-m-d');
$company_id         = $_SESSION['company_id'];
$menu 			    = 'Setup Location';
$sub_menu 		    = 'setup_area';




if(isset($_REQUEST['new']) && $_POST['randcheck']==$_SESSION['rand']){

  @insert('area');
  $msg="New data insert successfully";
}


if(isset($_REQUEST['delid']) && $_REQUEST['delid']>1){	
  $delid = $_REQUEST['delid'];
  mysqli_query($conn, "delete from area where AREA_CODE='".$delid."'");
  
  $msg="Delete successfully";
  redirect('setup_area.php');
}

if(isset($_POST['update'])){
  unset($_POST['update']);
  unset($_POST['randcheck']);
  update('area','AREA_CODE="'.$_GET['edit_id'].'"');
  
  $msg= "Update successfully";
  redirect('setup_area.php');
}

if($_GET['edit_id']>0){
$ss="select * from area where AREA_CODE='".$_GET['edit_id']."'";
$show2 = findall($ss);

$region_id = find1('select REGION_ID from zon where ZONE_CODE="'.$show2->ZONE_ID.'"');

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
            <h1 class="m-0">Area Setup</h1>
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
    <select class="form-control col-md-12" name="ZONE_ID" required id="zone">
        <option value="<?=$show2->ZONE_ID?>"><?=find1("select ZONE_NAME from zon where ZONE_CODE='".$show2->ZONE_ID."'");?></option>
    </select>
</div></div>


<div class="row mb-10 form-group">
	<label class="control-label col-md-4" for="">Area name<span class="required"></span></label>
	<div class="col-md-8">
	<input type="text" name="AREA_NAME" required="required" value="<?=$show2->AREA_NAME?>" class="form-control col-md-12">
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
                <h3 class="card-title">Area List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-2">
                    <table id="examplefull" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Area ID</th>
                      <th>Area Name</th>
                      <th>Zone</th>
                      <th>Region</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
<?php 
$sql = "select area.*,zon.ZONE_NAME as zone_name,zon.REGION_ID from area 
LEFT JOIN zon ON area.ZONE_ID=zon.ZONE_CODE
where 1 order by ZONE_ID,AREA_NAME";

$query=mysqli_query($conn, $sql);
while($data=mysqli_fetch_object($query)){
?>                  	
                    <tr>
                      <td><?=$data->AREA_CODE?></td>
                      <td><?=$data->AREA_NAME?></td>
                      <td><?=$data->zone_name?></td>
                      <td><?=find1('select BRANCH_NAME from branch where BRANCH_ID="'.$data->REGION_ID.'"');?></td>
                      <td>
	<a href="setup_area.php?edit_id=<?=$data->AREA_CODE;?>">Edit</a> || 
	<a href="setup_area.php?delid=<?=$data->AREA_CODE;?>" onClick="return confirm('Do you want to delete')">Delete</a>
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
</script>