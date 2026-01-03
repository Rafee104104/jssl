<?php
session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";  

$table='ss_route';
$unique = 'route_id';
$crud      =new crud($table);

$today 			    = date('Y-m-d');
$company_id         = $_SESSION['company_id'];
$menu 			    = 'Setup Location';
$sub_menu 		    = 'setup_route';




if(isset($_REQUEST['new'])){

  $crud->insert();
  $msg="New data insert successfully";
}


if(isset($_REQUEST['delid'])){	
  $delid = $_REQUEST['delid'];
  mysql_query("delete from ss_route where route_id='".$delid."'");
  
  $msg="Delete successfully";
}



if(isset($_POST['update'])){

  $_POST['route_id']=$_GET['edit_id'];
  $crud->update($unique);
  unset($_POST['update']);
  unset($_POST['randcheck']);
  
  
  $msg= "Update successfully";
  //redirect('setup_route.php');
}

if($_GET['edit_id']>0){
$ss="select * from ss_route where route_id='".$_GET['edit_id']."'";
$show2 = mysql_query($ss);
$show2 = mysql_fetch_object($show2);

$zone_id    =find_a_field('area','ZONE_ID','AREA_CODE="'.$show2->area_id.'"');
$region_id = find_a_field('zon','REGION_ID','ZONE_CODE="'.$zone_id.'"');

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
                        <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label"> Region</label>
                        <div class="col-sm-9 p-0">
                            <select  required id="region" onchange="FetchZone(this.value)">
                                <option value="<?=$region_id?>"><?=find_a_field('branch','BRANCH_NAME',"BRANCH_ID='".$region_id."'")?></option>
                                <? foreign_relation('branch','BRANCH_ID','BRANCH_NAME',$region,''); ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group row m-0 pl-3 pr-3">
                        <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label"> Zone</label>
                        <div class="col-sm-9 p-0">
                            <select required id="zone" onchange="FetchArea(this.value)">
                                <option value="<?=$zone_id?>"><?=find_a_field('zon','ZONE_NAME',"ZONE_CODE='".$zone_id."'");?></option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group row m-0 pl-3 pr-3">
                        <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label"> Area</label>
                        <div class="col-sm-9 p-0">
                            <select name="area_id" required id="area" onchange="FetchRoute(this.value)">
                                <option value="<?=$show2->area_id?>"><?=find_a_field('area','AREA_NAME',"AREA_CODE='".$show2->area_id."'");?></option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group row m-0 pl-3 pr-3">
                        <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label"> Route name</label>
                        <div class="col-sm-9 p-0">
                            <input type="text" name="route_name" required="required" value="<?=$show2->route_name?>">
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
                    <h3 class="card-title">Route List</h3>

                    <table id="table_head_wrapper" class="table1  table-striped table-bordered table-hover table-sm">
                        <thead class="thead1">
                        <tr class="bgc-info">
                            <th> ID</th>
                            <th>Route Name</th>
                            <th>Area</th>
                            <th>Zone</th>
                            <th>Region</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody class="tbody">
                        <?php
                        $sql = "select ss_route.*,area.AREA_NAME as area_name,area.AREA_CODE from ss_route
LEFT JOIN area ON ss_route.area_id=area.AREA_CODE
where 1 order by area_id,route_name";

                        $query=mysql_query($sql);
                        while($data=mysql_fetch_object($query)){
                            ?>
                            <tr>
                                <td><?=$data->route_id?></td>
                                <td><?=$data->route_name?></td>
                                <td><?=$data->area_name?></td>
                                <td><?=$data->zone_name?></td>
                                <td><?=find_a_field('branch','BRANCH_NAME','BRANCH_ID="'.$data->REGION_ID.'"');?></td>
                                <td>
                                    <a href="setup_route.php?edit_id=<?=$data->route_id;?>" class="btn1 btn1-bg-update">Edit</a>
                                    <a href="setup_route.php?delid=<?=$data->route_id;?>" class="btn1 btn1-bg-cancel" onClick="return confirm('Do you want to delete')">Delete</a>
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