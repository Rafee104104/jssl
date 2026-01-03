<?php
session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";


$today 			  = date('Y-m-d');
$company_id   = $_SESSION['company_id'];
$menu 			  = 'Product';
$sub_menu 		= 'product_brand';



if(isset($_REQUEST['new'])){

   mysql_query('insert into item_brand set brand_name="'.$_POST['brand_name'].'" ');
  $msg="New data insert successfully";
}


if(isset($_REQUEST['delid'])){	
  $delid = $_REQUEST['delid'];
  mysql_query("delete from item_brand where id='".$delid."'");
  $msg="Delete successfully";
}

if(isset($_POST['update'])){
  unset($_POST['update']);
  unset($_POST['randcheck']);
  mysql_query('update item_brand set brand_name="'.$_POST['brand_name'].'" where id="'.$_GET['edit_id'].'" ');
  $msg= "Update successfully";
}

if($_GET['edit_id']>0){
$ss="select * from item_brand where id='".$_GET['edit_id']."'";
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
                            <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label"> Product Brand</label>
                            <div class="col-sm-9 p-0">
                                	<input type="text" name="brand_name" required="required" value="<?=$show2->brand_name?>">
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
                        <h3 class="card-title">List</h3>

                        <table class="table1  table-striped table-bordered table-hover table-sm">
                            <thead class="thead1">
                            <tr class="bgc-info">
                              <th>ID</th>
                              <th>Group Name</th>
                              <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="tbody">
                                <?php
                                $sql = "select * from item_brand where 1";
                                $query=mysql_query($sql);
                                while($data=mysql_fetch_object($query)){
                                ?>
                                 <tr>
                                    <td><?=++$a;?></td>
                                    <td><?=$data->brand_name?></td>
                                    <td>
                                            <a href="product_brand.php?edit_id=<?=$data->id;?>" class="btn1 btn1-bg-update">Edit</a>
                                            <a href="product_brand.php?delid=<?=$data->id;?>" class="btn1 btn1-bg-cancel" onClick="return confirm('Do you want to delete')">Delete</a>
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