<?php

session_start();

//====================== EOF ===================

//var_dump($_SESSION);
require_once "../../../assets/support/inc.all.php";


$chalan_no 		= $_REQUEST['v_no'];
$ch_all=find_all_field('sale_do_chalan','','chalan_no='.$chalan_no);

$do_all=find_all_field('sale_do_master','','do_no='.$ch_all->do_no);
$dealer=find_all_field('dealer_info','','dealer_code='.$do_all->dealer_code);
$item_all=find_all_field('item_info','','item_id="'.$row->item_id.'"');

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>.: Delivery Chalan Bill Report :.</title>
    <script>
        function print_cus(){
            document.getElementById('pr').style.display='none';
            window.print();
        }
    </script>
    <style>
        /*.mb-3{*/
            /*margin-bottom:4px!important;*/
        /*}*/
        /*.input-group-text{*/
            /*font-size:12px;*/
        /*}*/
        /** {*/
            /*margin: 0;*/
            /*padding: 0;*/
            /*font-size:13px;*/
        /*}*/
        /*p {*/
            /*margin: 0;*/
            /*padding: 0;*/
        /*}*/
        /*h1,*/
        /*h2,*/
        /*h3,*/
        /*h4,*/
        /*h5,*/
        /*h6*/
        /*{*/
            /*margin: 0 !important;*/
            /*padding: 0 !important;*/
        /*}*/

        /*th,tr,th,td{*/
            /*border:1px solid;*/
        /*}*/
        /*label{*/

        /*}*/
        table{
            font-size: 12px;
        }

    </style>
</head>

<body>

<section>
    <div class="container-fluid">
        <h2 align="center"><button type="button" class="btn btn-success" id="pr"  onClick="print_cus()">Print</button></h2>
        <table width="100%"  style="font-size: 14px">
            <tr>
                <td colspan="2" style="width: 20%"> <img src="../../../logo/<?=$_SESSION['user']['group']?>.png" width="120px" height="80px" /></td>
                <td colspan="7" style="width: 60%" class="text-center">
                    <h3 class="m-0 p-0"><?php echo find_a_field('project_info','proj_name','1')?></h3>
                        <p class="m-0  p-0" style="letter-spacing:1px; font-weight: bold;">Quality product at affordable cost</p>
                    <p class="m-0 p-0">
                        <?php echo find_a_field('project_info','warehouse_address','1')?>
                        <strong>Cell:</strong> <?php echo find_a_field('project_info','proj_phone','1')?>.
                        <strong>Email: </strong><?php echo find_a_field('project_info','proj_email','1')?>
                        <br> <strong><?php echo find_a_field('project_info','website','1')?></strong>
                    </p>

                    <b class="m-0 p-0 text-center">Delivery Challan (Depot to Distributor)</b>


                </td>
                <td colspan="2" style="width: 20%">
                    <div class="bold text-center">
                        <p class="m-0 p-0" style="border: 1px solid black;"> QR code <br/>(DO ID, Distributor<br/> ID and Product info)</p>
                    </div>
                </td>
            </tr>
        </table>


<!---->
<!--        <h2 class="row">-->
<!---->
<!--            <div class="col-6"><p style="float:right">Reporting Time: -->

        <table class="table table-bordered border-primary  text-center">
            <thead>
			 <tr style="border: none">
                <td colspan="11" style="text-align: left; border: none;"><strong>Challan Copy:</strong><a href="../../../assets/support/upload_view.php?name=<?=$ch_all->chalan_att?>&folder=chalan" target="_blank">View Attachment</a></td>
            </tr>
            <tr style="border: none">
                <td colspan="7" style="text-align: left; border: none;"><strong>Challan No:</strong><?php echo $ch_all->chalan_no;?></td>
                <td colspan="4" style="text-align: right; border: none;"><strong>Reporting Time:</strong><?=date("h:i A d-m-Y")?></td>
            </tr>

            <tr>
                <td colspan="7" style="text-align: left; border-right:none;">
                    <p class="m-0 p-0"><strong>DO ID:</strong><?php echo $ch_all->do_no;?> </p>
                    <p class="m-0 p-0"><strong>Distributor Name: </strong><?php echo $dealer->dealer_name_e;?> </p>
                    <p class="m-0 p-0"><strong>Distributor Address: </strong><?php echo $dealer->address_e;?> </p>
                    <p class="m-0 p-0"><strong>Product receiver name: </strong><?php echo $ch_all->rec_name;?> </p>
                    <p class="m-0 p-0"><strong>SR phone number: </strong> </p>
                </td>
                <td colspan="4" style="text-align: left; border-left:none;">
                    <p class="m-0 p-0"><strong>DO Date:</strong><?php echo $ch_all->do_date;?> </p>
                    <p class="m-0 p-0"><strong>Distributor ID:  </strong><?php echo $dealer->dealer_code;?> </p>
                    <p class="m-0 p-0"><strong>Distributor Phone no:  </strong><?php echo $dealer->contact_no;?> </p>
                    <p class="m-0 p-0"><strong>Product receiver Phone no: </strong><?php echo $ch_all->rec_mob;?> </p>
                    <p class="m-0 p-0"><strong> TSM phone number: </strong> </p>
                </td>
            </tr>


            <tr>
                <td colspan="7" style="text-align: left; border-right:none;">
                    <p class="m-0 p-0"><strong>Depot ID:</strong><?php echo $ch_all->depot_id;?> </p>
                    <p class="m-0 p-0"><strong>In charge Name: </strong><?= find_a_field('warehouse','contact_persone','warehouse_id='.$ch_all->depot_id)?> </p>
                    <p class="m-0 p-0"><strong>Address: </strong><?= find_a_field('warehouse','address','warehouse_id='.$ch_all->depot_id);?> </p>
                    <p class="m-0 p-0"><strong>Deliveryman Name: </strong><?php echo $ch_all->delivery_man;?> </p>
                    <p class="m-0 p-0"><strong>Driver Name: </strong> <?php echo $ch_all->driver_name;?></p>
                </td>
                <td colspan="4" style="text-align: left; border-left:none;">
                    <p class="m-0 p-0"><strong>Delivery Challan no:</strong><?php echo $ch_all->chalan_no;?> </p>
                    <p class="m-0 p-0"><strong>In charge ID no: </strong><?= find_a_field('warehouse','in_charge_id','warehouse_id='.$ch_all->depot_id)?> </p>
                    <p class="m-0 p-0"><strong>Depot Phone no: </strong><?= find_a_field('warehouse','mobile_no','warehouse_id='.$ch_all->depot_id)?> </p>
                    <p class="m-0 p-0"><strong>Deliveryman Phone no: </strong><?php echo $ch_all->delivery_man_mobile;?> </p>
                    <p class="m-0 p-0"><strong>Vehicle no: </strong><?php echo find_a_field('vehicle_info','concat(vehicle_name,"#",vech_reg_no)','vehicle_id="'.$ch_all->vehicle_no.'"');?> </p>
                    <p class="m-0 p-0"><strong>Driver Phone no: </strong><?php echo $ch_all->driver_mobile;?> </p>
                </td>
            </tr>




            <tr>
                <th>SL</th>
                <th>DO ID</th>
                <th>DO Date</th>
                <th>Product Name</th>
                <th>Product ID</th>
                <th>Order Quantity </th>
                <th> Undelivered Product Quantity </th>
                <th> Sample Product Name</th>
                <th> Sample Product ID</th>
                <th> Sample Quantity</th>
                <th> Undelivered Sample Quantity</th>

            </tr>
            </thead>
            <tbody class=" text-center table-striped">
			
		 
				  

            <tr>
			<?php 
 $sql='select c.*,sum(c.total_unit) as chalan_qty from sale_do_chalan c where c.chalan_no="'.$chalan_no.'" group by c.item_id';
$query=mysql_query($sql);
while($row=mysql_fetch_object($query)){
$item_all=find_all_field('item_info','','item_id="'.$row->item_id.'"');
$details=find_all_field('sale_do_details','','item_id="'.$row->item_id.'" and do_no="'.$row->do_no.'"');
$entry_by=find_a_field('user_activity_management','fname','user_id="'. $row->entry_by.'"'); 
$approve_by=find_a_field('user_activity_management','fname','user_id="'. $row->approve_by.'"'); 

?>
                <td><?=++$i?></td>
                <td><?php echo $ch_all->do_no;?></td>
                <td><?php echo $ch_all->do_date;?></td>

                <td><?=$item_all->item_name?></td>
                <td><?=$item_all->finish_goods_code?></td>
                <td><?=$details->total_unit?></td>

                <td><?=$details->total_unit-$row->chalan_qty;?></td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
            </tr>
				<?php
				  
				   } ?>

            <tr>
                <td colspan="9" rowspan="2" style="text-align:left ;font-weight:bold;">Receiver Sign and Date </td>
                <td colspan="2" style="text-align:left ;font-weight:bold;">
                        Remarks
                </td>
            </tr>
            <tr>
                <td colspan="2">If any mismatch, Please inform your SR/ASM/DSM.</td>
            </tr>

            <tr>
                <td colspan="11"><h5 style="text-align: center; font-weight: bold;">Undelivered Information</h5></td>
            </tr>

            <?
			$sql='select a.id,m.do_no,m.do_date, a.item_id,  a.unit_price, b.item_name,b.finish_goods_code, b.unit_name,  a.total_unit as qty from sale_do_master m,sale_do_details a,item_info b, item_sub_group s where m.do_no=a.do_no and m.status="CHECKED" and b.item_id=a.item_id and b.sub_group_id=s.sub_group_id and m.dealer_code="'.$ch_all->dealer_code.'" and m.depot_id="'.$_SESSION['user']['depot'].'" and a.do_no!='.$ch_all->do_no;
			?>

            <tr>
                <td colspan="11">
                    <table class="table table-bordered border-primary  text-center">
                        <thead>
                        <tr>
                            <th>SI</th>
                            <th>DO ID</th>
                            <th>DO Date </th>
                            <th>Product Name </th>
                            <th>Product ID </th>
                            <th>Undelivered Product quantity </th>
                            <th>Sample product Name </th>
                            <th>Sample Product ID </th>
                            <th>Undelivered Sample quantity </th>
                        </tr>
                        </thead>
                        <tbody class=" text-center table-striped">
						<? 
						 $qry = mysql_query($sql);
						 while($undel=mysql_fetch_object($qry)){
						 $d_qty = find_a_field('sale_do_details','sum(total_unit)','id="'.$undel->id.'" and do_no="'.$undel->do_no.'"');
				         $c_qty = find_a_field('sale_do_chalan','sum(total_unit)','order_no="'.$undel->id.'" and do_no="'.$undel->do_no.'" ');
						 $undel_qty = $d_qty-$c_qty;
						 if($d_qty>$c_qty){
						?>
                            <tr>
                                <td><?=++$n?></td>
                                <td><?=$undel->do_no?></td>
                                <td><?=$undel->do_date?></td>
                                <td><?=$undel->item_name?></td>
                                <td><?=$undel->finish_goods_code?> </td>
                                <td><?=$undel_qty?> </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
							<? } } ?>
                        </tbody>
                    </table>

                </td>
            </tr>


            <tr>
                <td colspan="11">
                    <p class="m-0 p-0"><b>This is automated Generated Challan of RCL ERP System.</b></p>
                    <p class="m-0 p-0">This Challan Generated by _____________ date is _____________ and time _____________ at place is _____________.</p>
                </td>
            </tr>







            </tbody>
        </table>
    </div>



</section>




<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>