<?php
session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";  


$table='dealer_info';
$unique = 'dealer_code';
$crud      =new crud($table);



$today 			  = date('Y-m-d');
$company_id   = $_SESSION['company_id'];
$menu 			  = 'Setup';
$sub_menu 		= 'dealer_info';



if(isset($_REQUEST['new'])){
  $_POST['group_for']=$company_id;  
  $_POST['status']			='Active';
  $_POST['dealer_type']		='Distributor';

  $crud->insert();
  $msg="New data insert successfully";
}


if(isset($_REQUEST['delid'])){	
  $delid = $_REQUEST['delid'];
  mysql_query("delete from dealer_info where dealer_code='".$delid."'");
  $msg="Delete successfully";
}

if(isset($_POST['update'])){
  unset($_POST['update']);
  unset($_POST['randcheck']);

  $_POST['region_code']=$_POST['region_id'];
  $_POST['zone_code']=$_POST['zone_id'];

  $_POST['dealer_code']=$_GET['edit_id'];
  $crud->update($unique);
  $msg= "Update successfully";
}

if($_GET['edit_id']){
$ss="select * from dealer_info where dealer_code='".$_GET['edit_id']."' ";
$show2 = mysql_query($ss);
$show2 = mysql_fetch_object($show2);
}
?>















<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-5">
                <form  action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left n-form1 pt-0" >
                    <h4 align="center" class="n-form-titel1"> Fill Up Below Information</h4>

                    <?php $rand=rand(); $_SESSION['rand']=$rand; ?>
                    <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />

                    <? if($_GET['edit_id']>0){ ?>
                        <input type="hidden" name="dealer_code" value="<?=$show2->dealer_code; ?>" />
                    <? } ?>

                    <div class="form-group row m-0 pl-3 pr-3">
                        <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label"> Dealer Code</label>
                        <div class="col-sm-9 p-0">
                            <input class="col-md-12" type="text" name="dealer_code2" required="required" value="<?=$show2->dealer_code2;?>">
                        </div>
                    </div>



                    <div class="form-group row m-0 pl-3 pr-3">
                        <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label"> Dealer Name</label>
                        <div class="col-sm-9 p-0">
                            <input type="text" name="dealer_name_e" required="required" value="<?=$show2->dealer_name_e?>" autocomplete="off">
                        </div>
                    </div>



                    <div class="form-group row m-0 pl-3 pr-3">
                        <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label"> Mobile</label>
                        <div class="col-sm-9 p-0">
                            <input type="text" name="mobile_no" required="required" value="<?=$show2->mobile_no?$show2->mobile_no:8801?>">
                        </div>
                    </div>



                    <!--<div class="row mb-10 form-group">-->
                    <!--  <label class="control-label col-md-6 col-sm-6" for="first-name">Product Group<span class="required"></span></label>-->
                    <!--  <div class="col-md-6 col-sm-6 col-xs-12">-->
                    <!--    <select class="form-control col-md-6" name="product_group">-->
                    <!--    <option><?=$show2->product_group?></option>-->
                    <!--    <?php //optionlist("select group_name,group_name from product_group where 1 order by group_name"); ?>-->
                    <!--    </select>-->
                    <!--  </div>-->
                    <!--</div>-->

                    <div class="form-group row m-0 pl-3 pr-3">
                        <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label"> Address</label>
                        <div class="col-sm-9 p-0">
                            <input type="text" name="address_e" required="required" value="<?=$show2->address_e?>">
                        </div>
                    </div>




                    <div class="form-group row m-0 pl-3 pr-3">
                        <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label"> Region</label>
                        <div class="col-sm-9 p-0">
                            <select class="form-control col-md-12" name="region_id" required id="region" onchange="FetchZone(this.value)">
                                <option value="<?=$show2->region_code?>"><?=find_a_field('branch','BRANCH_NAME',"BRANCH_ID='".$show2->region_code."'");?></option>
                                <? foreign_relation('branch','BRANCH_ID','BRANCH_NAME',$region_id,'1');?>
                            </select>
                        </div>
                    </div>



                    <div class="form-group row m-0 pl-3 pr-3">
                        <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label"> Zone</label>
                        <div class="col-sm-9 p-0">
                            <select class="form-control col-md-12" name="zone_id" required id="zone" onchange="FetchArea(this.value)">
                                <option value="<?=$show2->zone_code?>"><?=find_a_field('zon','ZONE_NAME',"ZONE_CODE='".$show2->zone_code."'");?></option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group row m-0 pl-3 pr-3">
                        <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label"> Area</label>
                        <div class="col-sm-9 p-0">
                            <select class="form-control col-md-12" name="area_code" required id="area">
                                <option value="<?=$show2->area_code?>"><?=find_a_field('area','AREA_NAME',"AREA_CODE='".$show2->area_code."'"); ?></option>

                            </select>
                        </div>
                    </div>


                    <div class="form-group row m-0 pl-3 pr-3">
                        <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label"> Status</label>
                        <div class="col-sm-9 p-0">
                            <select  name="canceled" required>
                                <option value="<?=$show2->canceled?>"><? if($show2->canceled=='No'){ echo 'Yes';}else{ echo 'No';}?></option>
                                <option value="No">Active</option>
                                <option value="Yes">Inactive</option>
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

                <form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                </form>

            </div>


            <div class="col-sm-7">
                <div class="container n-form1">
                    <h3 class="card-title">Dealer Information</h3>

                    <table class="table1  table-striped table-bordered table-hover table-sm">
                        <thead class="thead1">
                        <tr class="bgc-info">

                            <th>Code</th>
                            <th>Dealer Name</th>
                            <th>Mobile</th>
                            <th>Product Group</th>
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


                        $sql = "select * from dealer_info where 1";
                        $query=mysql_query($sql);
                        while($data=mysql_fetch_object($query)){
                            ?>
                            <tr>
                                <td><?=$data->dealer_code?></td>
                                <td><?=$data->dealer_name_e?></td>
                                <td><?=$data->mobile_no?></td>
                                <td><?=$data->product_group?><br>
                                    <? echo $region_info[$data->region_id];?>-<? echo $zone_info[$data->zone_id];?>-<? echo $area_info[$data->area_code];?>
                                </td>
                                <td>
                                    <a href="dealer_info.php?edit_id=<?=$data->dealer_code;?>" class="btn1 btn1-bg-update">Edit</a>
                                    <a href="dealer_info.php?delid=<?=$data->dealer_code;?>" class="btn1 btn1-bg-cancel" onClick="return confirm('Do you want to delete')">Delete</a>
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