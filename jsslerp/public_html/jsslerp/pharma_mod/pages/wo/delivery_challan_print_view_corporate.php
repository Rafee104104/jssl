<?php

session_start();

//====================== EOF ===================

//var_dump($_SESSION);
require_once "../../../assets/support/inc.all.php";


$chalan_no 		= $_REQUEST['v_no'];
$ch_all=find_all_field('sale_do_chalan','','chalan_no='.$chalan_no);
$entry_by = find_a_field('user_activity_management','fname','user_id="'.$ch_all->entry_by.'"');
$depot_name = find_a_field('warehouse','warehouse_name','warehouse_id="'.$ch_all->depot_id.'"');

$do_all=find_all_field('sale_do_master','','do_no='.$ch_all->do_no);
$dealer=find_all_field('dealer_info','','dealer_code='.$do_all->dealer_code);
$dealer_type = find_a_field('dealer_type','dealer_type','id="'.$dealer->dealer_type.'"');
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
			document.getElementById('pr1').style.display='none';
			document.getElementById('header4').style.display='none';
            window.print();
        }
		function print_pad(){
	document.getElementById('pr').style.display='none';
	document.getElementById('pr1').style.display='none';
	document.getElementById('header3').style.display='none';
	document.getElementById('header4').style.display='none';
	document.getElementById('marginTop').style.marginTop = "80px";
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
        .form-control,.input-group-text{
            font-size: 12px!important;
        }

    </style>
</head>

<body>

<section>
    <div class="container-fluid">
        <h2 align="center"><button type="button" class="btn btn-success" id="pr"  onClick="print_cus()">Print</button></h2>
		<h2 align="center"><button type="button" class="btn btn-success" id="pr1"  onClick="print_pad()">Pad Print</button></h2>
        <table width="100%"  style="font-size: 14px" id="header3">
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
					
                </td>
                <td colspan="2" style="width: 20%">
                    <div class="bold text-center">
                        <p class="m-0 p-0" style="border: 1px solid black;"> QR code <br/>(DO ID, Distributor<br/> ID and Product info)</p>
                    </div>
                </td>
            </tr>
        </table>
		
		<div id="marginTop">
		                    <p class="m-0 p-0"  style="text-align:center; font-weight:600">Delivery Challan</p>
		</div>


<!---->
<!--        <h2 class="row">-->
<!---->
<!--            <div class="col-6"><p style="float:right">Reporting Time: -->

        <table class="table table-bordered border-primary  text-center">
            <thead>
			 <tr style="border: none" id="header4">
                <td colspan="11" style="text-align: left; border: none;"><strong>Challan Copy:</strong>
				
				<?php
								
					if ($ch_all->chalan_att!=''){ $ext3 = explode(".",$ch_all->chalan_att);?>
				<a href="../../../assets/support/upload_view.php?name=<?=$ch_all->chalan_att?>&folder=chalan&ext=<?=$ext3[1]?>" target="_blank">View Attachment</a>
				<?php } ?>
				
				</td>
            </tr>
            <tr style="border: none">
                <td colspan="9" style="text-align: left; border: none;"><strong>Challan No:</strong><?php echo $ch_all->chalan_no;?></td>
                <td colspan="4" style="text-align: right; border: none;"><strong>Reporting Time:</strong><?=date("h:i A d-m-Y")?></td>
            </tr>

            <tr width="100%">
                <td width="50%" colspan="9" style="text-align: left; border-right:none;">

                    <div class="input-group mb-1 input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="font-weight:bold;">DO ID</span>
                        </div>
                        <input type="text" class="form-control" readonly="readonly" value="<?php echo $ch_all->do_no;?>">
                    </div>

                    <div class="input-group mb-1 input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="font-weight:bold;">Receiver Name</span>
                        </div>
                        <input type="text" class="form-control" readonly="readonly" value="<?php echo $dealer->dealer_name_e;?> ">
                    </div>


                    <div class="input-group mb-1 input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="font-weight:bold;">Receiver Address</span>
                        </div>
                        <input type="text" class="form-control" readonly="readonly" value="<?php echo $dealer->address_e;?>">
                    </div>
					
					<div class="input-group mb-1 input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="font-weight:bold;">Delivery Address</span>
                        </div>
                        <input type="text" class="form-control" readonly="readonly" value="<?php echo $dealer->delivery_address;?>">
                    </div>
					
					
					<div class="input-group mb-1 input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="font-weight:bold;">Manual PO No</span>
                        </div>
                        <input type="text" class="form-control" readonly="readonly" value="<?php echo $ch_all->manual_po_no;?>">
                    </div>


                    <!--<div class="input-group mb-1 input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="font-weight:bold;">Product receiver name</span>
                        </div>
                        <input type="text" class="form-control" readonly="readonly" value="<?php echo $ch_all->rec_name;?>">
                    </div>-->
                </td>
                <td  width="50%" colspan="5" style="text-align: left; border-left:none;">

                    <div class="input-group mb-1 input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="font-weight:bold;"> DO Date</span>
                        </div>
                        <input type="text" class="form-control" readonly="readonly" value="<?php echo $ch_all->do_date;?>">
                    </div>


                    <div class="input-group mb-1 input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="font-weight:bold;">Distributor ID:</span>
                        </div>
                        <input type="text" class="form-control" readonly="readonly" value="<?php if($dealer->customer_code !='') echo $dealer->customer_code; else echo $dealer->dealer_code;?>">
                    </div>

                    <div class="input-group mb-1 input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="font-weight:bold;"> Distributor Phone no:</span>
                        </div>
                        <input type="text" class="form-control" readonly="readonly" value="<?php echo $dealer->contact_no;?>">
                    </div>
					
					

                    <div class="input-group mb-1 input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="font-weight:bold;">Product Receiver Phone no:</span>
                        </div>
                        <input type="text" class="form-control" readonly="readonly" value="<?php echo $ch_all->rec_mob;?>">
                    </div>
					
					</br>
					</br>
                </td>
            </tr>


            <tr>
                <td class="col-sm-6" colspan="9" style="text-align: left; border-right:none;">

                    <div class="input-group mb-1 input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="font-weight:bold;"> Depot ID:</span>
                        </div>
                        <input type="text" class="form-control" readonly="readonly" value="<?php echo $ch_all->depot_id;?>, <?= find_a_field('warehouse','warehouse_name','warehouse_id='.$ch_all->depot_id);?>, <?= find_a_field('user_activity_management','username','user_id='.$ch_all->entry_by);?> ">
                    </div>

                    <div class="input-group mb-1 input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="font-weight:bold;"> In charge Name:</span>
                        </div>
                        <input type="text" class="form-control" readonly="readonly" value="<?= find_a_field('warehouse','contact_persone','warehouse_id='.$ch_all->depot_id);?>">
                    </div>

                    <div class="input-group mb-1 input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="font-weight:bold;"> Address</span>
                        </div>
                        <textarea class="form-control" spellcheck="false" style="min-height: 70px;"> <?= find_a_field('warehouse','address','warehouse_id='.$ch_all->depot_id);?> </textarea>
                    </div>

                    <div class="input-group mb-1 input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="font-weight:bold;">DA Name</span>
                        </div>
                        <input type="text" class="form-control" readonly="readonly" value="<?php echo $ch_all->delivery_man;?>">
                    </div>

                    <div class="input-group mb-1 input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="font-weight:bold;"> DdelA Name</span>
                        </div>
                        <input type="text" class="form-control" readonly="readonly" value="<?php echo $ch_all->driver_name;?>">
                    </div>

                </td>
                <td class="col-sm-6" colspan="4" style="text-align: left; border-left:none;">

                    <div class="input-group mb-1 input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="font-weight:bold;"> Delivery Challan no</span>
                        </div>
                        <input type="text" class="form-control" readonly="readonly" value="<?php echo $ch_all->chalan_no;?>">
                    </div>

                    <div class="input-group mb-1 input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="font-weight:bold;"> In charge ID no</span>
                        </div>
                        <input type="text" class="form-control" readonly="readonly" value="<?= find_a_field('warehouse','in_charge_id','warehouse_id='.$ch_all->depot_id)?>">
                    </div>

                    <div class="input-group mb-1 input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="font-weight:bold;"> Depot Phone no</span>
                        </div>
                        <input type="text" class="form-control" readonly="readonly" value="<?= find_a_field('warehouse','mobile_no','warehouse_id='.$ch_all->depot_id)?>">
                    </div>

                    <div class="input-group mb-1 input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="font-weight:bold;">DA Phone no</span>
                        </div>
                        <input type="text" class="form-control" readonly="readonly" value="<?php echo $ch_all->delivery_man_mobile;?> ">
                    </div>

                    <div class="input-group mb-1 input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="font-weight:bold;"> Vehicle no</span>
                        </div>
                        <input type="text" class="form-control" readonly="readonly" value="<?php echo find_a_field('vehicle_info','concat(vehicle_name,"#",vech_reg_no)','vehicle_id="'.$ch_all->vehicle_no.'"');?>">
                    </div>

                    <div class="input-group mb-1 input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="font-weight:bold;"> DdelA Phone no</span>
                        </div>
                        <input type="text" class="form-control" readonly="readonly" value="<?php echo $ch_all->driver_mobile;?>">
                    </div>

                </td>
            </tr>




            <tr>
                <th>SL</th>
                <th>DO ID</th>
                <th>DO Date</th>
                <th>S Product Name</th>
				<th>S Company</th>
				<th>Product Name</th>
                <th>Product ID</th>
                <th>Order Quantity </th>
                <th>Delivered Quantity </th>
                <th> Sample Product Name</th>
                <th> Sample Product ID</th>
                <th> Sample Quantity</th>
                <th> Undelivered Sample Quantity</th>

            </tr>
            </thead>
            <tbody class=" text-center table-striped">
			
		 
				  

            <tr>
			<?php 


$sql='select c.*,sum(c.total_unit) as chalan_qty,o.item_name as c_item,o.company,offer.gift_id as gift_item_id,offer.id as gift_id from sale_do_chalan c,sale_do_details s left join item_info_other o on o.item_id=s.c_item_id left join sale_gift_offer offer on offer.item_id=s.item_id and offer.start_date<="'.$do_all->do_date.'" and offer.end_date>="'.$do_all->do_date.'" and offer.dealer_type="'.$dealer_type.'" where s.do_no=c.do_no and s.id=c.order_no and s.item_id=c.item_id and c.chalan_no="'.$chalan_no.'" and s.gift_id=0 group by c.item_id';
$query=mysql_query($sql);
while($row=mysql_fetch_object($query)){
$item_all=find_all_field('item_info','','item_id="'.$row->item_id.'"');
$details=find_all_field('sale_do_details','','item_id="'.$row->item_id.'" and do_no="'.$row->do_no.'"');
$entry_by=find_a_field('user_activity_management','fname','user_id="'.$row->entry_by.'"'); 
$approve_by=find_a_field('user_activity_management','fname','user_id="'.$row->approve_by.'"'); 
$gift_sql = 'select s.*,i.item_name,i.finish_goods_code from sale_do_details s, item_info i where s.item_id=i.item_id and s.do_no="'.$row->do_no.'" and s.item_id="'.$row->gift_item_id.'" and s.gift_id>0';
$gift_qry = mysql_query($gift_sql);
$gift_info = mysql_fetch_object($gift_qry);
$gift_delivered = find_a_field('sale_do_chalan','sum(total_unit)','do_no="'.$row->do_no.'" and item_id="'.$row->gift_item_id.'" and gift_id="'.$row->gift_id.'"');

?>
                <td><?=++$i?></td>
                <td><?php echo $ch_all->do_no;?></td>
                <td><?php echo $ch_all->do_date;?></td>
                <td><?php echo $row->c_item;?></td>
				<td><?php echo $row->company;?></td>
                <td><?=$item_all->item_name?></td>
                <td><?=$item_all->finish_goods_code?></td>
                <td><?=$details->total_unit?></td>

                <td><?=$row->chalan_qty;?></td>
                <td><?=$gift_info->item_name?></td>
                <td><?=$gift_info->finish_goods_code?></td>

                <td><?=$gift_info->total_unit?></td>
                <td><?=$gift_info->total_unit-$gift_delivered?></td>
            </tr>
				<?php
				  
				   } ?>

            <tr>
                <td colspan="11" rowspan="2" style="text-align:left ;font-weight:bold;">Receiver Sign and Date </td>
                <td colspan="2" style="text-align:left ;font-weight:bold;">
                        Remarks
                </td>
            </tr>
            <tr>
                <td colspan="2">If any mismatch, Please inform your concern person.</td>
            </tr>

            <!--<tr>
                <td colspan="13"><h5 style="text-align: center; font-weight: bold;">Undelivered Information</h5></td>
            </tr>-->

           


            <tr>
                <td colspan="13">
                    <p class="m-0 p-0"><b>This is automated Generated Challan of RCL ERP System.</b></p>
                    <p class="m-0 p-0">This Challan Generated by <strong><?=$entry_by?></strong> date is <strong><?=date('M-d-Y',strtotime($ch_all->entry_at))?></strong> and time <strong><?=date('H:i:s',strtotime($ch_all->entry_at))?></strong> at place is <strong><?=$depot_name?></strong>.</p>
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