<?php

require_once "../../../assets/template/layout.top.php";

$head='<link href="../../css/report_selection.css" type="text/css" rel="stylesheet"/>';



$title='Asset Register';



do_calander('#reg_date');

do_calander('#ijda');

do_datatable('grp');

$table='asset_register';

$crud= new crud($table);

if(isset($_POST['submit'])){



$exist=find_a_field('asset_register','sl_no','sl_no="'.$_POST['sl_no'].'"');

if($_POST['sl_no']!=$exist){

$_POST['warehouse_id']=$_SESSION['user']['depot'];

$_POST['entry_by']=$_SESSION['user']['id'];

$itemId=explode("#",$_POST['item_ids']);

$_POST['item_id']=$itemId[0];

$id=$crud->insert();

journal_asset_item_control($_POST['item_id'] ,$_POST['warehouse_id'],date('Y-m-d'),1,0,'Registed',$id,$_POST['price'],0,$id,$_POST['price'],0,0,$_POST['sl_no']);

redirect('asset_register.php');

}else{

    echo '<div class="alert alert-danger" role="alert">

    Serial Number Already Exist

  </div>';

}

}

if(isset($_POST['update'])){

    $_POST['id']=$_GET['assetId'];

	$crud->update('id');

    redirect('asset_register.php');

}





if($_GET['assetId']>0){



        $condition="id=".$_GET['assetId'];

        $data=db_fetch_object($table,$condition);

        while (list($key, $value)=each($data))

        { $$key=$value;}





}





?>









<form action="" method="post" autocomplete="off">

    <div class="form-container_large">

        <h4 class="text-center bg-titel bold pt-2 pb-2"> Asset Register Form </h4>

        <div class="container-fluid bg-form-titel">

            <div class="row">

                <!--left form-->

                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">

                    <div class="container n-form2">

						

						<div class="form-group row m-0 pb-1">

                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Registation Date	 </label>

                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">

                                <input name="reg_date" type="text" id="reg_date" value="<?=$reg_date?>"  class="form-control">

                            </div>

                        </div>

						<div class="form-group row m-0 pb-1">

                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Item Name </label>

                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">

                                <input list="items" name="item_ids" type="text" id="item_ids" value="<?=$item_id?>"  class="form-control">

								<datalist id="items">

								<? foreign_relation('item_info','concat(item_id,"#",item_name)','concat(item_id,"#",item_name)',$item_id,'1')?>

								</datalist>

                            </div>

                        </div>



                        <div class="form-group row m-0 pb-1">

                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Item Price</label>

                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">

							 <input name="price" type="text" id="price" value="<?=$price?>" class="form-control">

							  

                            </div>

                        </div>

						<div class="form-group row m-0 pb-1">

                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Serial No </label>

                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">

							 <input name="sl_no" type="text" id="sl_no" value="<?=$sl_no?>" class="form-control">

							  

                            </div>

                        </div>









                    </div>

                </div>



                <!--Right form-->

                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">

                    <div class="container n-form2">

                       



                        <div class="form-group row m-0 pb-1">

                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Quality</label>

                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">

                                <select name="quality" id="quality" class="form-control" required>

									<option></option>

									<option value="Good" <?=($quality=="Good")?'Selected': ''?>>Good</option>

									<option value="Moderate" <?=($quality=="Moderate")?'Selected': ''?>>Moderate</option>

									<option value="Serviceable" <?=($quality=="Serviceable")?'Selected': ''?>>Serviceable</option>

									<option value="Unserviceable" <?=($quality=="Unserviceable")?'Selected': ''?>>Unserviceable</option>

									<option value="Obsolete" <?=($quality=="Obsolete")?'Selected': ''?>>Obsolete</option>

									

								  </select>

                            </div>

                        </div>

                        <div class="form-group row m-0 pb-1">

                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Item Brand</label>

                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">

                               <input name="item_brand" type="text" id="item_brand" value="<?=$item_brand?>"  class="form-control">  

                            </div>

                        </div>
						
						<div class="form-group row m-0 pb-1">

                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Item Model</label>

                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">

                               <input name="item_model" type="text" id="item_model" value="<?=$item_model?>"  class="form-control">  

                            </div>

                        </div>

						

						<div class="form-group row m-0 pb-1">

                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Area</label>

                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">

                              <select name="area_code" id="area_code" class="form-control" required>

							  <option></option>

							  <? foreign_relation('asset_area','id','area_name',$area_code,'1');?>

							  

							  

							  </select>

                            </div>

                        </div>

						<div class="form-group row m-0 pb-1">

                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Note</label>

                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">

                               <input name="note" type="text" id="note" value="<?=$note?>"  class="form-control">  

                            </div>

                        </div>

                    </div>

                </div>





            </div>



        </div>

        <div class="container-fluid p-0 ">

            <div class="n-form-btn-class">

                <!--            button code hear-->

                <? if($_GET['assetId']>0){?>

                <input name="update" type="submit" class="btn1 btn1-bg-submit" id="update" value="Update    " />

                <span class="btn btn-danger" onclick=" window.location= 'asset_register.php';">Reset</span>



                <? }else{?>

                    <input name="submit" type="submit" class="btn1 btn1-bg-submit" id="submit" value="Register" />



                    <? }?>

                   

            </div>



        </div>

        </form>

		

	<div class="col-12 tabledesign2">

    <table class="table table-striped" id="grp">

  <thead>

    <tr>

      <th scope="col">S/L</th>

      <th scope="col">Item Name</th>

      <th scope="col">Date</th>

      <th scope="col">Item Brand</th>
	  
	  <th scope="col">Model</th>

      <th scope="col">Price</th>

      <th scope="col">Serial No</th>

      <th scope="col">Quality</th>

	<th scope="col">Status</th>



    </tr>

  </thead>

  <tbody>

    <?php

     $sql='select r.*,i.item_name from asset_register r,item_info i where r.item_id=i.item_id';

     $query=mysql_query($sql);

     $i=1;

     while($data=mysql_fetch_object($query)){



     

     ?>

   <tr onclick="window.location='?assetId=<?=$data->id?>';" style="cursor:pointer">

      <th scope="row"><?=$i++?></th>

      <td><?=$data->item_name?></td>

      <td><?=date("d-m-Y",strtotime($data->reg_date))?></td>

      <td><?=$data->item_brand?></td>
	  
	  <td><?=$data->item_model?></td>

      <td><?=$data->price?></td>

      <td><?=$data->sl_no?></td>

      <td><?=$data->quality?></td>

	  <td><?=$data->item_status?></td>

    </tr>

  <? }?>

  </tbody>

</table>

    </div>	

		

    </div>



    <script>







<?

require_once "../../../assets/template/layout.bottom.php";

?>