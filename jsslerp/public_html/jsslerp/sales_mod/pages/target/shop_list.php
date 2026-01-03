<?php
session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";  



$table='ss_shop';
$unique = 'dealer_code';
$crud      =new crud($table);


$today 			  = date('Y-m-d');
$company_id   = $_SESSION['company_id'];
$menu 			  = 'Setup';
$sub_menu 		= 'shop_list';



if(isset($_REQUEST['new'])){  

$_POST['master_dealer_code']= $_SESSION['warehouse_id']; 

$crud->insert();
  $msg="New data insert successfully";
}


if(isset($_REQUEST['delid'])){	
  $delid = $_REQUEST['delid'];
  mysql_query("delete from ss_shop where dealer_code='".$delid."'");
  $msg="Delete successfully";
}

if(isset($_POST['update'])){
  unset($_POST['update']);
  unset($_POST['randcheck']);
  $_POST['dealer_code']=$_GET['edit_id'];
  $crud->update($unique);
  $msg= "Update successfully";
}

if($_GET['edit_id']){
$ss="select * from ss_shop where dealer_code='".$_GET['edit_id']."' ";
$show2 = mysql_query($ss);
$show2 = mysql_fetch_object($show2);
}
?>






<!-- Main content -->
<section class="content">

    <h4 class="text-center bg-titel bold pt-2 pb-2">Shop Information</h4>
    <? if ($_SESSION['username']=='faysal'){?> <a href="shop_pic_compress.php" target="_blank">Pic Compress</a> <? } ?>

    <div class="n-form-btn-class">
        <button name="new" type="button" class="btn1 btn1-bg-submit"><a href='shop_list.php'><span style="color:#FFFFFF">Add New</span></a></button>
    </div>

    <form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
        <div class="container-fluid bg-form-titel">
            <div class="row">
                    <?php $rand=rand(); $_SESSION['rand']=$rand; ?>
                    <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />


                <!--left form-->
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="container n-form2">


                        <div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Shop Name</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <input type="text" name="shop_name" required="required" value="<?=$show2->shop_name?>"  autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Address</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <input type="text" name="shop_address" required="required" value="<?=$show2->shop_address?>">
                            </div>
                        </div>

                        <div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Owner Name</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <input type="text" name="shop_owner_name" required="required" value="<?=$show2->shop_owner_name?>" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Mobile</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <input type="text" name="mobile" required="required" value="<?=$show2->mobile?$show2->mobile:8801?>">
                            </div>
                        </div>

                        <div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Manager Name</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <input type="text" name="manager_name" required="required" value="<?=$show2->manager_name?>" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Manager Mobile</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <input type="text" name="manager_name" required="required" value="<?=$show2->manager_name?>"  autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Zone</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <select name="region_id" required id="region" onchange="FetchZone(this.value)">
                                    <option value="<?=$show2->region_id?>"><?=find_a_field('branch','BRANCH_NAME',"BRANCH_ID='".$show2->region_id."'");?></option>
                                    <? foreign_relation('branch','BRANCH_ID','BRANCH_NAME',$region_id,'1');?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Division</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <select name="zone_id" required id="zone" onchange="FetchArea(this.value)">
                                    <option value="<?=$show2->zone_id?>"><?=find_a_field('zon','ZONE_NAME',"ZONE_CODE='".$show2->zone_id."'");?></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Territory</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <select  name="area_id" required id="area" onchange="FetchRoute(this.value)">
                                    <option value="<?=$show2->area_id?>"><?=find_a_field('area','AREA_NAME',"AREA_CODE='".$show2->area_id."'");?></option>
                                </select>
                            </div>
                        </div>


                    </div>
                </div>



                <!--Right form-->
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="container n-form2">


                        <div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Route</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <select name="route_id" required id="route">
                                    <option value="<?=$show2->route_id?>"><?=find_a_field('ss_route','route_name',"route_id='".$show2->route_id."'");?></option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Shop Identity</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <select name="shop_identity">
                                    <option><?=$show2->shop_identity?$show2->shop_identity:'Other'?></option>
                                    <option>MEP</option><option>Other</option>

                                </select>
                            </div>
                        </div>



                        <div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Shop Class</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <select name="shop_class">
                                    <option><?=$show2->shop_class?></option>
                                    <option>Gold 50000 to 100000</option>
                                    <option>Diamond 100000 to 150000</option>
                                    <option>Silver 25000 to 50000</option>
                                    <option>Platinum Plus 200000 to above</option>
                                    <option>Bronze 1 to 25000</option>
                                    <option>Platinum 150000 to 200000</option>
                                </select>
                            </div>
                        </div>



                        <div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Shop Type</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <select name="shop_type">
                                    <option><?=$show2->shop_type?></option>
                                    <option>Retailer</option>
                                    <option>WholeSale</option>
                                    <option>Semi WholeSaler</option>
                                </select>
                            </div>
                        </div>



                        <div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Shop Channel</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <select name="shop_channel">
                                    <option><?=$show2->shop_channel?></option>
                                    <option>Electric</option>
                                    <option>Electronics</option>
                                    <option>Stationary</option>
                                    <option>Departmental Store</option>
                                    <option>Grosary </option>
                                    <option>Hardware</option>
                                    <option>Library</option>
                                    <option>Pharmacy</option>
                                </select>
                            </div>
                        </div>



                        <div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Shop Route Type</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <select name="shop_route_type">
                                    <option><?=$show2->shop_route_type?></option>
                                    <option>Bazar</option>
                                    <option>Outsite  Bazar</option>
                                </select>
                            </div>
                        </div>



                        <div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">GPS Location</label>

                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 p-0 pr-2 ">
                                <input type="text" name="latitude" value="<?=$show2->latitude?>">
                            </div>

                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 p-0 pr-2 ">
                                <input type="text" name="longitude" value="<?=$show2->longitude?>">
                            </div>
                        </div>



                        <div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">SO CODE</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <input type="text" name="emp_code" required="required" value="<?=$show2->emp_code?>" autocomplete="off">
                            </div>
                        </div>



                        <div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Status</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <select  name="status" required>
                                    <option value="<?=$show2->status?>"><? if($show2->status==1) echo 'Active'; else echo 'Inactive';?></option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>


                    </div>
                </div>

            </div>


            <div class="n-form-btn-class">
                <? if($_GET['edit_id']>0){?>
                    <button name="update" type="submit"  class="btn1 btn1-bg-update">Update</button>
                <? }else{ ?>
                    <button name="new" type="submit"  class="btn1 btn1-bg-submit">Create</button>
                <? } ?>

            </div>

        </div>
    </form>

    <div class="container-fluid pt-3 p-0">
        <?
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

        // route list
        $sql='select route_id,route_name from ss_route';
        $query = mysql_query($sql);
        while($info = mysql_fetch_object($query)){$route_info[$info->route_id] = $info->route_name;}

        ?>

        <form action="" method="post">
            <div class="row">

                <div class="col-md-1 col-sm-1 col-lg-1 m-0"> </div>

                <div class="col-md-3 col-sm-3 col-lg-3"><label>Division</label>
                    <select class="col-md-12 col-sm-12 col-lg-12 m-0" name="zone_id" required id="zone2" onchange="FetchArea2(this.value)">
                        <option value="<?=$_POST['zone_id'];?>"><?=$zone_info[$_POST['zone_id']];?></option>
                        <? foreign_relation('zon','ZONE_CODE','ZONE_NAME',$zone_id,'1'); ?></option>
                    </select>
                </div>


                <div class="col-md-3 col-sm-3 col-lg-3"><label>Territory</label>
                    <select class="col-sm-12 col-lg-12 col-md-12" name="area_id"  id="area2" onchange="FetchRoute2(this.value)">
                        <option value="<?=$_POST['area_id'];?>"><?=$area_info[$_POST['area_id']];?></option>
                        <? foreign_relation('area','AREA_CODE','AREA_NAME',$area_id,'1'); ?></option>
                    </select>
                </div>

                <div class="col-md-3 col-sm-3 col-lg-3 "><label>Route</label>
                    <select class="col-sm-12 col-lg-12 col-md-12" name="route_id"  id="route2">
                        <option value="<?=$_POST['route_id'];?>"><?=$route_info[$_POST['route_id']];?></option>
                        <? foreign_relation('ss_route','route_id','route_name',$route_id,'1');?></option>
                    </select>
                </div>


                <div class="col-md-2 col-sm-2 col-lg-2 m-0">
                    <div style="padding-top: 17%;">
                        <button type="submit" name="view" id="view" class="btn1 btn1-bg-submit ">Search</button>
                    </div>

                </div>


            </div><!--END ROW-->

        </form>


        <table class="table1  table-striped table-bordered table-hover table-sm">
            <thead class="thead1">
            <tr class="bgc-info">

                <th>Code</th>
                <th>Shop Name</th>
                <th>Mobile</th>
                <th>Area</th>
                <th>Image</th>
                <th>Action</th>

            </tr>
            </thead>
            <tbody class="tbody">
            <?php


            $location='';
            if($_POST['zone_id']!='') $location.=' and zone_id="'.$_POST['zone_id'].'"';
            if($_POST['area_id']!='') $location.=' and area_id="'.$_POST['area_id'].'"';
            if($_POST['route_id']!='') $location.=' and route_id="'.$_POST['route_id'].'"';



            if(isset($_POST['view'])){
                $sql = "select * from ss_shop where 1 ".$location." order by dealer_code";
            }else{
                $sql = "select * from ss_shop where 1 order by dealer_code desc limit 20";
            }
            $query=mysql_query($sql);
            while($data=mysql_fetch_object($query)){
                ?>
                <tr>
                    <td><?=$data->dealer_code?></td>
                    <td><?=$data->shop_name?></td>
                    <td><?=$data->mobile?></td>
                    <td>SO CODE: <? echo $data->emp_code;?><br><? echo $region_info[$data->region_id];?>-<? echo $zone_info[$data->zone_id];?>-<? echo $area_info[$data->area_id];?>
                    </td>
                    <td>
                        <? if($data->picture!=''){ ?>
                            <a href="shop_pic_view.php?pic=<?=$data->picture?>" target="_blank" class="btn1 btn1-bg-help">View</a>
                        <? } ?>
                        <br>
                        <a href="shop_pic_update.php?id=<?=$data->dealer_code?>" target="_blank" class="btn1 btn1-bg-update">Update</a>
                    </td>
                    <td>
                        <a href="shop_list.php?edit_id=<?=$data->dealer_code;?>" class="btn1 btn1-bg-submit">Edit</a>
                        <br>
                        <a href="shop_list.php?delid=<?=$data->dealer_code;?>" class="btn1 btn1-bg-cancel" onClick="return confirm('Do you want to delete')">Delete</a>
                    </td>
                </tr>
            <? } ?>
            </tbody>


        </table>



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
  
  
  function FetchArea2(id){
    $('#area2').html('');
    $('#route2').html('');
    $.ajax({
      type:'post',
      url: 'get_data.php',
      data : { zone_id : id},
      success : function(data){
         $('#area2').html(data);
      }

    })
  }  
  
    function FetchRoute2(id){
    $('#route2').html('');
    $.ajax({
      type:'post',
      url: 'get_data.php',
      data : { area_id : id},
      success : function(data){
         $('#route2').html(data);
      }

    })
  }  
  
  
  
  

</script>