<?php
session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";  


$table='area';
$unique = 'AREA_CODE';
$crud      =new crud($table);


$today 			    = date('Y-m-d');
$company_id         = $_SESSION['company_id'];
$menu 			    = 'Setup Location';
$sub_menu 		    = 'setup_area';




if(isset($_REQUEST['new']) && $_POST['randcheck']==$_SESSION['rand']){
  $crud->insert();
  $msg="New data insert successfully";
}


if(isset($_REQUEST['delid'])){	
  $delid = $_REQUEST['delid'];
  mysql_query("delete from area where AREA_CODE='".$delid."'");
  $msg="Delete successfully";
}

if(isset($_POST['update'])){

  
  $_POST['AREA_CODE']=$_GET['edit_id'];
  $crud->update($unique);
  unset($_POST['update']);
  unset($_POST['randcheck']);
  
  $msg= "Update successfully";
}

if($_GET['edit_id']>0){
$ss="select * from area where AREA_CODE='".$_GET['edit_id']."'";
$show2 = mysql_query($ss);
$show2 = mysql_fetch_object($show2);

$region_id = find_a_field('zon','REGION_ID','ZONE_CODE="'.$show2->ZONE_ID.'"');

}
?>



<?php
include 'inc/header.php';
include 'inc/sidebar.php';
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
                            <select required id="region" onchange="FetchZone(this.value)">
                                <option value="<?=$region_id?>"><?=find_a_field('branch','BRANCH_NAME',"BRANCH_ID='".$region_id."'");?></option>
                                <?  foreign_relation('branch','BRANCH_ID','BRANCH_NAME',$region,'1');?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row m-0 pl-3 pr-3">
                        <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label"> Zone</label>
                        <div class="col-sm-9 p-0">
                            <select name="ZONE_ID" required id="zone">
                                <option value="<?=$show2->ZONE_ID?>"><?=find_a_field('zon','ZONE_NAME',"ZONE_CODE='".$show2->ZONE_ID."'");?></option>

                                <?  foreign_relation('zon','ZONE_CODE','ZONE_NAME',$ZONE_ID,'1');?>
                            </select>

                        </div>
                    </div>


                    <div class="form-group row m-0 pl-3 pr-3">
                        <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label"> Area name</label>
                        <div class="col-sm-9 p-0">
                            <input type="text" name="AREA_NAME" required="required" value="<?=$show2->AREA_NAME?>" >
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
                <div class="container-fluid n-form1">
                    <h3 class="card-title">Area List</h3>

                    <table id="examplefull" class="table1  table-striped table-bordered table-hover table-sm">
                        <thead class="thead1">
                        <tr class="bgc-info">
                            <th>ID</th>
                            <th>Area Name</th>
                            <th>Zone</th>
                            <th>Region</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody class="tbody1">
                        <?php
                        $sql = "select area.*,zon.ZONE_NAME as zone_name,zon.REGION_ID from area
LEFT JOIN zon ON area.ZONE_ID=zon.ZONE_CODE
where 1 order by ZONE_ID,AREA_NAME";

                        $query=mysql_query($sql);
                        while($data=mysql_fetch_object($query)){
                            ?>
                            <tr>
                                <td><?=$data->AREA_CODE?></td>
                                <td><?=$data->AREA_NAME?></td>
                                <td><?=$data->zone_name?></td>
                                <td><?=find_a_field('branch','BRANCH_NAME','BRANCH_ID="'.$data->REGION_ID.'"')?></td>
                                <td>
                                    <a href="setup_area.php?edit_id=<?=$data->AREA_CODE;?>" class="btn1 btn1-bg-update">Edit</a>
                                    <a href="setup_area.php?delid=<?=$data->AREA_CODE;?>" class="btn1 btn1-bg-cancel" onClick="return confirm('Do you want to delete')">Delete</a>
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