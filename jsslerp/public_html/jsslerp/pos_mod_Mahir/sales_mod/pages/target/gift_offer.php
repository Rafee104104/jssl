<?php
session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";



$today 			= date('Y-m-d');
$company_id     = $_SESSION['company_id'];
$menu 			= 'Product';
$sub_menu 		= 'gift_offer';



if(isset($_REQUEST['new'])){

$insert = 'insert into ss_gift_offer set 
offer_name="'.$_POST['offer_name'].'",
group_for="'.$_POST['group_for'].'",
dealer_type="'.$_POST['dealer_type'].'",
item_id="'.$_POST['item_id'].'",
item_qty="'.$_POST['item_qty'].'",
min_qty="'.$_POST['min_qty'].'",
max_qty="'.$_POST['max_qty'].'",
gift_id="'.$_POST['gift_id'].'",
gift_qty="'.$_POST['gift_qty'].'",
start_date="'.$_POST['start_date'].'",
end_date="'.$_POST['end_date'].'",
status="'.$_POST['status'].'",
calculation="'.$_POST['calculation'].'",
gift_type="'.$_POST['gift_type'].'",
entry_by="'.$_SESSION['user']['id'].'",
no_return="'.$_POST['gift_type'].'",
dealer_code="'.$_POST['dealer_code'].'",
region_id="'.$_POST['region_id'].'",
zone_id="'.$_POST['zone_id'].'",
area_id="'.$_POST['	area_id'].'"';

mysql_query($insert);

  $msg="New data insert successfully";
}


if(isset($_REQUEST['delid'])){
  mysql_query('delete from ss_gift_offer where id="'.$_GET['delid'].'"');	
  $msg="Delete successfully";
}

if(isset($_POST['update'])){
  unset($_POST['update']);
  unset($_POST['randcheck']);

  $update = 'update ss_gift_offer set 
offer_name="'.$_POST['offer_name'].'",
group_for="'.$_POST['group_for'].'",
dealer_type="'.$_POST['dealer_type'].'",
item_id="'.$_POST['item_id'].'",
item_qty="'.$_POST['item_qty'].'",
min_qty="'.$_POST['min_qty'].'",
max_qty="'.$_POST['max_qty'].'",
gift_id="'.$_POST['gift_id'].'",
gift_qty="'.$_POST['gift_qty'].'",
start_date="'.$_POST['start_date'].'",
end_date="'.$_POST['end_date'].'",
status="'.$_POST['status'].'",
calculation="'.$_POST['calculation'].'",
gift_type="'.$_POST['gift_type'].'",
entry_by="'.$_SESSION['user']['id'].'",
no_return="'.$_POST['gift_type'].'",
dealer_code="'.$_POST['dealer_code'].'",
region_id="'.$_POST['region_id'].'",
zone_id="'.$_POST['zone_id'].'",
area_id="'.$_POST['	area_id'].'" where id="'.$_GET['edit_id'].'"';

mysql_query($update);
  $msg= "Update successfully";
}

if($_GET['edit_id']>0){
$ss="select * from ss_gift_offer where id='".$_GET['edit_id']."'";
$show2 = mysql_query($ss);
$show2 = mysql_fetch_object($show2);
}
?>







<!-- Main content -->
<section class="content">

    <h4 class="text-center bg-titel bold pt-2 pb-2">Fill Up Below Information</h4>

    <form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
    <div class="container-fluid bg-form-titel">
            <div class="row">
            <?php $rand=rand(); $_SESSION['rand']=$rand; ?>
            <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />


                <!--left form-->
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="container n-form2">

                        <div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Offer Name</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <input class="form-control" type="text" name="offer_name" required="required" value="<?=$show2->offer_name?>" >
                            </div>
                        </div>
						<div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Item</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                   <input list="browsers" class="form-control" name="item_id" id="item_id" autocomplete="off" value="<?=$show2->item_id?>">
                                  <datalist id="browsers">
                                    <?php  foreign_relation('item_info','item_id','item_name',$item_id,'status=1 ');?>
                                  </datalist>
                            </div>
                        </div>
						<div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Item Qty</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <input class="form-control" type="number" name="item_qty" required="required" value="<?=$show2->item_qty?>" >
                            </div>
                        </div>


						<div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">MIN Qty </label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <input class="form-control" type="number" name="min_qty" required="required" value="<?=$show2->min_qty?>" >
                            </div>
                        </div>


						<div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">MAX Qty </label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <input class="form-control" type="number" name="max_qty" required="required" value="<?=$show2->max_qty?>" >
                            </div>
                        </div>


						<div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Gift Item </label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                   <input list="browsers2" class="form-control" name="gift_id" id="gift_id" autocomplete="off" value="<?=$show2->gift_id?>">
                                  <datalist id="browsers2">
                                    <?php foreign_relation('item_info','item_id','item_name',$gift_id,'status=1 ');?>
                                  </datalist>

                            </div>
                        </div>






                    </div>
                </div>

                <!--Right form-->
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="container n-form2">


                        <div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Gift Qty</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <input class="form-control" type="number" name="gift_qty" required="required" value="<?=$show2->gift_qty?>" >
                            </div>
                        </div>
						<div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Gift Calculation</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                    <select class="form-control" name="calculation" required="required">
                                        <option value="<?=$show2->calculation?>"><?=$show2->calculation?></option>
                                        <option>Auto</option>
                                        <option>Manual</option>
                                    </select>
                            </div>
                        </div>
						<div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Gift Type</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                    <select class="form-control" name="gift_type" required="required">
                                        <option value="<?=$show2->gift_type?>"><?=$show2->gift_type?></option>
                                        <option>Cash</option>
                                        <option>Non-Cash</option>
                                    </select>
                            </div>
                        </div>


						<div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Start Date</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <input class="form-control" type="date" name="start_date" required="required" value="<?=$show2->start_date?>" >
                            </div>
                        </div>

						<div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">End Date</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <input class="form-control" type="date" name="end_date" required="required" value="<?=$show2->end_date?>" >
                            </div>
                        </div>


						<div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Status</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                    <select class="form-control" name="status" required="required">
                                        <option value="<?=$show2->status?>"><?=$show2->status?></option>
                                        <option>Active</option>
                                        <option>Inactive</option>
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
                    <table class="table1  table-striped table-bordered table-hover table-sm">
                        <thead class="thead1">
                        <tr class="bgc-info">

                          <th>ID</th>
                          <th>Offer Name</th>
                          <th>Item</th>
                          <th>Item Qty</th>
                          <th>Min Qty</th>
                          <th>Max Qty</th>
                          <th>Gift Item</th>
                          <th>Gift Qty</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th>Calculate</th>
                          <th>Gift Type</th>
                          <th>Status</th>
                          <th>Action</th>

                        </tr>
                        </thead>
                        <tbody class="tbody">

                            <?php
                            $sql = "select * from ss_gift_offer where 1 ";
                            $query=mysql_query($sql);
                            while($data=mysql_fetch_object($query)){
                            ?>
                                                <tr>
                                                  <td><?=++$a;?></td>
                                                  <td><?=$data->offer_name?></td>
                                                  <td><?=$data->item_id?></td>
                                                  <td><?=$data->item_qty?></td>
                                                  <td><?=$data->min_qty?></td>
                                                  <td><?=$data->max_qty?></td>
                                                  <td><?=$data->gift_id?></td>
                                                  <td><?=$data->gift_qty?></td>
                                                  <td><?=$data->start_date?></td>
                                                  <td><?=$data->end_date?></td>
                                                  <td><?=$data->calculation?></td>
                                                  <td><?=$data->gift_type?></td>
                                                  <td><?=$data->status?></td>
                                                  <td>
                                <a href="gift_offer.php?edit_id=<?=$data->id;?>" class="btn1 btn1-bg-update">Edit</a>
                                <a href="gift_offer.php?delid=<?=$data->id;?>" class="btn1 btn1-bg-cancel" onClick="return confirm('Do you want to delete')">Delete</a>
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