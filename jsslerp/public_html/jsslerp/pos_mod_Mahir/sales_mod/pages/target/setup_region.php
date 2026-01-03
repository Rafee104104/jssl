<?php
session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";  


$table='branch';
$unique = 'BRANCH_ID';
$crud      =new crud($table);



$today 			    = date('Y-m-d');
$company_id         = $_SESSION['company_id'];
$menu 			    = 'Setup Location';
$sub_menu 		    = 'setup_region';




if(isset($_REQUEST['new']) && $_POST['randcheck']==$_SESSION['rand']){
  $crud->insert();
  $msg="New data insert successfully";
}


if(isset($_REQUEST['delid']) && $_REQUEST['delid']>1){	
  $delid = $_REQUEST['delid'];
  mysql_query("delete from branch where BRANCH_ID='".$delid."'");
  
  $msg="Delete successfully";
}

if(isset($_POST['update'])){

  $_POST['BRANCH_ID']=$_GET['edit_id'];
  $crud->update($unique);
  unset($_POST['update']);
  unset($_POST['randcheck']);
  
  $msg= "Update successfully";
}

if($_GET['edit_id']>0){
$ss="select * from branch where BRANCH_ID='".$_GET['edit_id']."'";
// $show2 = findall($ss);
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
                            <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label"> Region name</label>
                            <div class="col-sm-9 p-0">
                                <input type="text" name="BRANCH_NAME" required="required" value="<?=$show2->BRANCH_NAME?>">
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
                        <h3 class="card-title">Region List</h3>

                        <table class="table1  table-striped table-bordered table-hover table-sm">
                            <thead class="thead1">
                            <tr class="bgc-info">
                                <th>Region ID</th>
                                <th>Region Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="tbody">

                            <?php
                            $sql = "select * from branch where 1 order by BRANCH_NAME";
                            $query=mysql_query($sql);
                            while($data=mysql_fetch_object($query)){
                                ?>
                                <tr>
                                    <td><?=$data->BRANCH_ID?></td>
                                    <td><?=$data->BRANCH_NAME?></td>
                                    <td>
                                        <a href="setup_region.php?edit_id=<?=$data->BRANCH_ID;?>" class="btn1 btn1-bg-update">Edit</a>
                                        <a href="setup_region.php?delid=<?=$data->BRANCH_ID;?>" class="btn1 btn1-bg-cancel" onClick="return confirm('Do you want to delete')">Delete</a>
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