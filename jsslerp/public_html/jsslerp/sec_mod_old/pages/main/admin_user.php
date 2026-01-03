<?php
session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";  


$table='user_activity_management';
$unique = 'user_id';
$crud      =new crud($table);


$today 			  = date('Y-m-d');
$company_id   = $_SESSION['company_id'];
$menu 			  = 'Setup';
$sub_menu 		= 'admin_user';




if(isset($_REQUEST['new']) && $_POST['randcheck']==$_SESSION['rand']){
  $_POST['group_for']=$company_id;  
  $_POST['status']='Active'; 

  $crud->insert();
  $msg="New data insert successfully";
}


if(isset($_REQUEST['delid'])){	
  $delid = $_REQUEST['delid'];
  mysql_query("delete from user_activity_management where user_id='".$delid."'");
  $msg="Delete successfully";
}

if(isset($_POST['update'])){

  $_POST['user_id']=$_GET['edit_id'];
  $crud->update($unique);
  unset($_POST['update']);
  unset($_POST['randcheck']);
  //update('user_activity_management','user_id="'.$_GET['edit_id'].'"');
  $msg= "Update successfully";
}

$ss="select * from user_activity_management where user_id='".$_GET['edit_id']."' ";
$show2 = mysql_query($ss);
$show2 = mysql_fetch_object($show2);
?>


 










<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-5">
                <form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left n-form1 pt-0">
                    <h4 align="center" class="n-form-titel1"> Fill Up Below Information</h4>
						<?php $rand=rand(); $_SESSION['rand']=$rand; ?>
							<input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
                    <div class="form-group row m-0 pl-3 pr-3">
                        <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label"> User Login Name</label>
                        <div class="col-sm-9 p-0">
                            <input type="text" name="username" required="required" value="<?=$show2->username?>">
                        </div>
                    </div>
					
					<div class="form-group row m-0 pl-3 pr-3">
                        <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label"> Password</label>
                        <div class="col-sm-9 p-0">
                           <input type="text" name="password" required="required" value="<?=$show2->password?>" >
                        </div>
                    </div>
					
					<div class="form-group row m-0 pl-3 pr-3">
                        <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label"> User Full Name</label>
                        <div class="col-sm-9 p-0">
                            <input type="text" name="fname" required="required" value="<?=$show2->fname?>" >
                        </div>
                    </div>
					
					<div class="form-group row m-0 pl-3 pr-3">
                        <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label"> Zone</label>
                        <div class="col-sm-9 p-0">
                            <select class="form-control col-md-12" name="region_id"  id="region" onchange="FetchZone(this.value)">
								<option value="<?=$show2->region_id?>"><?=find_a_field('branch','BRANCH_NAME',"BRANCH_ID='".$show2->region_id."'")?></option>
						<? foreign_relation('branch','BRANCH_ID','BRANCH_NAME',$region_id,'1');?>
							</select>
                        </div>
                    </div>
					
					<div class="form-group row m-0 pl-3 pr-3">
                        <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label"> Division</label>
                        <div class="col-sm-9 p-0">
                            <select class="form-control col-md-12" name="zone_id"  id="zone" onchange="FetchArea(this.value)">
								<option value="<?=$show2->zone_id?>"><?=find_a_field('zon','ZONE_NAME',"ZONE_CODE='".$show2->zone_id."'");?></option>
							</select>
                        </div>
                    </div>
					
					<div class="form-group row m-0 pl-3 pr-3">
                        <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label"> Territory</label>
                        <div class="col-sm-9 p-0">
                            <select class="form-control col-md-12" name="area_id"  id="area" onchange="FetchRoute(this.value)">
								<option value="<?=$show2->area_id?>"><?=find_a_field('area','AREA_NAME',"AREA_CODE='".$show2->area_id."'");?></option>
							</select>
                        </div>
                    </div>
					
					<div class="form-group row m-0 pl-3 pr-3">
                        <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label"> Level</label>
                        <div class="col-sm-9 p-0">
                            <select name="level"  required>
							  <? if($_GET['edit_id']>0){ ?><option><?=$show2->level;?></option> <? } ?>
							  <option value="1">1 Read</option>
							  <option value="2">2 Entry</option>
							  <option value="5">5 Super Admin</option>
							  
							  <option value="101">101 AM</option>
							  <option value="102">102 DSM</option>
							  <option value="103">103 TSM</option>
							</select>
                        </div>
                    </div>


                    <div class="n-form-btn-class">
                        <? if($_GET['edit_id']>0){?>
							<button name="update" type="submit"  class="btn1 btn1-bg-update">Update</button>
							<? }else{ ?>
							<button name="new" type="submit"  class="btn1- btn1-bg-submit">Create</button>
							<? } ?>
                    </div>


                </form>

            </div>


            <div class="col-sm-7">
                <div class="container n-form1">
                    <h3 class="card-title">Admin User List</h3>

                    <table class="table1  table-striped table-bordered table-hover table-sm">
                        <thead class="thead1">
                        <tr class="bgc-info">
							<th>ID</th>
							<th>Username</th>
							<th>Full Name</th>
							<th>Label</th>
							<th>Action</th>
                        </tr>
                        </thead>
                        <tbody class="tbody">

							<?php 
							$sql = "select * from user_activity_management where 1";
							$query=mysql_query($sql);
							while($data=mysql_fetch_object($query)){
							?>                  	
												<tr>
												  <td><?=$data->user_id?></td>
												  <td><?=$data->username?></td>
												  <td><?=$data->fname?></td>
												  <td><span class="badge btn1-bg-cancel"><?=$data->level?></span></td>
												  <td>
								<a href="admin_user.php?edit_id=<?=$data->user_id;?>" class="btn1 btn1-bg-update">Edit</a> 
								<a href="admin_user.php?delid=<?=$data->user_id;?>" class="btn1 btn1-bg-cancel" onClick="return confirm('Do you want to delete')">Delete</a>
												</td>
												</tr>
							<? } ?>                    
                  </tbody>
                    </table>
  

                </div>

            </div>

        </div>

    </div>

</section>







  <?
$main_content=ob_get_contents();
ob_end_clean();
include ("../../template/main_layout.php");
?>

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