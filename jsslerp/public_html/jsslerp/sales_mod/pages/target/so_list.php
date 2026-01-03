<?php
session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";  


$table='ss_user';
$unique = 'user_id';
$crud      =new crud($table);


$today 			  = date('Y-m-d');
$company_id   = $_SESSION['company_id'];
$menu 			  = 'Setup';
$sub_menu 		= 'so_list';



if(isset($_REQUEST['new'])){
  $_POST['group_for']=$company_id;  
  $_POST['status']='Active'; 

  $crud->insert();
  $msg="New data insert successfully";
}


if(isset($_REQUEST['delid'])>0){	
  $delid = $_REQUEST['delid'];
  mysql_query("delete from ss_user where user_id='".$delid."'");
  $msg="Delete successfully";
}

if(isset($_POST['update'])){
  unset($_POST['update']);
  unset($_POST['randcheck']);
  $_POST['user_id']=$_GET['edit_id'];
  $crud->update($unique);
  //update('ss_user','user_id="'.$_GET['edit_id'].'"');
  $msg= "Update successfully";
}

if($_GET['edit_id']>0){
$ss="select * from ss_user where user_id='".$_GET['edit_id']."' ";
$show2 = mysql_query($ss);
$show2 = mysql_fetch_object($show2);
}
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
                        <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label">Employee Code</label>
                        <div class="col-sm-9 p-0">
                            <input class="col-md-12" type="text" name="username" required="required" value="<?=$show2->username?>">
                        </div>
                    </div>

                    <div class="form-group row m-0 pl-3 pr-3">
                        <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label">Password</label>
                        <div class="col-sm-9 p-0">
                            <input type="text" name="password" required="required" value="<?=$show2->password?>">
                        </div>
                    </div>

                    <div class="form-group row m-0 pl-3 pr-3">
                        <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label">Full Name</label>
                        <div class="col-sm-9 p-0">
                            <input type="text" name="fname" required="required" value="<?=$show2->fname?>">
                        </div>
                    </div>


                    <div class="form-group row m-0 pl-3 pr-3">
                        <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label">Mobile</label>
                        <div class="col-sm-9 p-0">
                            <input type="text" name="mobile" required="required" value="<?=$show2->mobile?>">
                        </div>
                    </div>


                    <!--<div class="row mb-10 form-group">-->
                    <!--<label class="control-label col-md-6 col-sm-6" for="first-name">Product Group<span class="required"></span></label>-->
                    <!--<div class="col-md-6 col-sm-6 col-xs-12">-->
                    <!--<select class="form-control col-md-6" name="product_group">-->
                    <!--<option><?=$show2->product_group?></option>-->
                    <!--<?php foreign_relation('product_group','id','group_name',$product_group,'1');  ?>-->
                    <!--</select>-->
                    <!--</div></div>-->

                    <div class="form-group row m-0 pl-3 pr-3">
                        <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label">Region</label>
                        <div class="col-sm-9 p-0">
                            <select class="form-control col-md-12" name="region_id" required id="region" onchange="FetchZone(this.value)">
                                <option value="<?=$show2->region_id?>"><?=find_a_field('branch','BRANCH_NAME',"BRANCH_ID='".$show2->region_id."'");?></option>
                                <? foreign_relation('branch','BRANCH_ID','BRANCH_NAME',$region_id,'1'); ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row m-0 pl-3 pr-3">
                        <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label">Zone</label>
                        <div class="col-sm-9 p-0">
                            <select class="form-control col-md-12" name="zone_id" required id="zone" onchange="FetchArea(this.value)">
                                <option value="<?=$show2->zone_id?>"><?=find_a_field('zon','ZONE_NAME',"ZONE_CODE='".$show2->zone_id."'");?></option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group row m-0 pl-3 pr-3">
                        <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label">Area</label>
                        <div class="col-sm-9 p-0">
                            <select class="form-control col-md-12" name="area_id" required id="area">
                                <option value="<?=$show2->area_id?>"><?=find_a_field('area','AREA_NAME',"AREA_CODE='".$show2->area_id."'"); ?></option>

                            </select>
                        </div>
                    </div>

                    <div class="form-group row m-0 pl-3 pr-3">
                        <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label">Dealer</label>
                        <div class="col-sm-9 p-0">
                            <input type="number" name="dealer_code" required="required" value="<?=$show2->dealer_code?>">
                        </div>
                    </div>

                    <div class="form-group row m-0 pl-3 pr-3">
                        <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label">Status</label>
                        <div class="col-sm-9 p-0">
                            <select name="status" required>
                                <option><?=$show2->status?$show2->status:'Active'?></option>
                                <option>Active</option>
                                <option>Inactive</option>
                            </select>
                        </div>
                    </div>







                    <div class="n-form-btn-class">
                            <? if($_GET['edit_id']>0){?>
                                <button name="update" type="submit"  class="btn1 btn1-bg-update">Update</button>
                            <? }else{ ?>
                                <button name="new" type="submit"  class="btn1 btn1-bg-submit">Create</button>
                            <? } ?>
                    </div>



                </form>

            </div>


            <div class="col-sm-7">
                <div class="container n-form1">
                    <h3 class="card-title">Information</h3>

                    <table class="table1  table-striped table-bordered table-hover table-sm">
                        <thead class="thead1">
                        <tr class="bgc-info">
                            <th>ID</th>
                            <th>Username</th>
                            <th>Full Name</th>
                            <th>Area</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody class="tbody">
                        <?php
                        // region list
                        $sql='select BRANCH_ID  as region_id,BRANCH_NAME as region_name from branch';
                        $query = mysql_query($sql);
                        while($info = mysql_fetch_object($query)){$region_info[$info->region_id] = $info->region_name;}

                        // zone list
                        $sql='select ZONE_CODE as zone_id,ZONE_NAME as zone_name from zon';
                        $query = mysql_query($sql);
                        while($info = mysql_fetch_object($query)){$zone_info[$info->zone_id] = $info->zone_name;}

                        // area list
                        $sql='select AREA_CODE as area_id,AREA_NAME as area_name from area';
                        $query = mysql_query($sql);
                        while($info = mysql_fetch_object($query)){$area_info[$info->area_id] = $info->area_name;}


                        $sql = "select * from ss_user where 1 ";
                        $query=mysql_query($sql);
                        while($data=mysql_fetch_object($query)){
                            ?>
                            <tr>
                                <td><?=$data->user_id?></td>
                                <td><?=$data->username?></td>
                                <td><?=$data->fname?></td>
                                <td>Dealer: <?=$data->dealer_code?><br><? echo $region_info[$data->region_id];?>-<? echo $zone_info[$data->zone_id];?>-<? echo $area_info[$data->area_id];?>
                                </td>
                                <td>
                                    <a href="so_list.php?edit_id=<?=$data->user_id;?>" class="btn1 btn1-bg-update">Edit</a>
                                    <a href="so_list.php?delid=<?=$data->user_id;?>" class="btn1 btn1-bg-cancel" onClick="return confirm('Do you want to delete')">Delete</a>
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
</script>