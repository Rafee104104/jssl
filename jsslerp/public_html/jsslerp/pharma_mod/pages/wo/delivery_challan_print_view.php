<?php

session_start();

//====================== EOF ===================

//var_dump($_SESSION);
require_once "../../../assets/support/inc.all.php";


$chalan_no 		= $_REQUEST['v_no'];
$ch_all=find_all_field('sale_do_chalan','','chalan_no='.$chalan_no);

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

    </style>
</head>

<body>

<section>
    <div class="container-fluid" >
        <h2 align="center"><button type="button" class="btn btn-success" id="pr"  onClick="print_cus()">Print</button></h2>
		<h2 align="center"><button type="button" class="btn btn-success" id="pr1"  onClick="print_pad()">Pad Print</button></h2>
        <table  width="100%"  style="font-size: 14px"  id="header3">
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
		                    <p class="m-0 p-0"  style="text-align:center; font-weight:600">Delivery Challan (Depot to Distributor)</p>
</div>


<!---->
<!--        <h2 class="row">-->
<!---->
<!--            <div class="col-6"><p style="float:right">Reporting Time: -->

        <table class="table table-bordered border-primary  text-center">
            <thead>

			 <tr style="border: none" id="header4">
                <td colspan="12" style="text-align: left; border: none;"><strong>Challan Copy:</strong>
				<?php
								
					if ($ch_all->chalan_att!=''){ $ext2 = explode(".",$ch_all->chalan_att);?>
				<a href="../../../assets/support/upload_view.php?name=<?=$ch_all->chalan_att?>&folder=chalan&ext=<?=$ext2[1]?>" target="_blank">View Attachment</a>
				<?php } ?>
				</td>
            </tr>
            <tr style="border: none">
                <td colspan="7" style="text-align: left; border: none;"><strong>Challan No:</strong><?php echo $ch_all->chalan_no;?></td>
                <td colspan="5" style="text-align: right; border: none;"><strong>Reporting Time:</strong><?=date("h:i A d-m-Y")?></td>
            </tr>

            <tr>
                <td colspan="7" style="text-align: left; border-right:none;">
                    <p class="m-0 p-0"><strong>DB ID: </strong><?php if($dealer->customer_code !='') echo $dealer->customer_code; else echo $dealer->dealer_code;?></p>
                    <p class="m-0 p-0"><strong>Prop: </strong><?php echo $dealer->dealer_name_e;?> </p>
                    <p class="m-0 p-0"><strong>Address: </strong><?php echo $dealer->address_e;?> </p>
					<p class="m-0 p-0"><strong>Contract number: </strong><?php echo $dealer->contact_no;?> </p>
                    <p class="m-0 p-0"><strong>Receiver: </strong><?php echo $ch_all->rec_name;?> </p>
                    <p class="m-0 p-0"><strong>SO : </strong> </p>
					<p class="m-0 p-0"><strong>ASM : </strong> </p>                </td>
                <td colspan="5" style="text-align: left; border-left:none;">
                    <p class="m-0 p-0"><strong>OC Date:</strong><?php echo $ch_all->do_date;?>, <?php echo $ch_all->do_no;?> </p>
                    <p class="m-0 p-0"><strong>Depot:  </strong><?php echo $ch_all->depot_id;?>, <?= find_a_field('warehouse','warehouse_name','warehouse_id='.$ch_all->depot_id);?>, <?= find_a_field('user_activity_management','username','user_id='.$ch_all->entry_by);?>, <?= find_a_field('warehouse','mobile_no','warehouse_id='.$ch_all->depot_id)?> </p>
                    <p class="m-0 p-0"><strong>Address: </strong><?= find_a_field('warehouse','address','warehouse_id='.$ch_all->depot_id);?> </p>
                    <p class="m-0 p-0"><strong>DA : </strong><?php echo $ch_all->delivery_man;?> </p>
                    <p class="m-0 p-0"><strong>DdelA : <?php echo $ch_all->driver_name;?></strong> </p>                </td>
            </tr>


            <!--<tr>
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
                    <p class="m-0 p-0"><strong>Driver Phone no: </strong><?php echo $ch_all->driver_mobile;?> </p>                </td>
            </tr>-->




            <tr>
                <th>SL</th>
                <th>Ref#</th>
                <th>Item Description</th>
				<th>Ctn</th>
                <th>Pcs</th>
                <th>TQ</th>
                <th>Q</th>
                <th>S.Qty</th>
                <th>A</th>
                <th>AAD</th>
                <th>Depot</th>
            </tr>
            </thead>
            <tbody class=" text-center table-striped">
			<tr>
			<?php 
			
			$c=1;
$sql='select c.*,sum(c.pkt_unit) as chalan_qty_ctn,sum(c.total_unit) as chalan_qty_pcs,o.item_name as c_item,o.company,offer.id as s_gift_id,offer.gift_id as gift_item_id,s.do_price from sale_do_chalan c,sale_do_details s left join item_info_other o on o.item_id=s.c_item_id left join sale_gift_offer offer on offer.item_id=s.item_id and offer.start_date<="'.$do_all->do_date.'" and offer.end_date>="'.$do_all->do_date.'" and offer.dealer_type="'.$dealer_type.'" where s.do_no=c.do_no and s.item_id=c.item_id and c.chalan_no="'.$chalan_no.'" and s.gift_id=0 and s.id=c.order_no group by c.item_id';
$query=mysql_query($sql);
while($row=mysql_fetch_object($query)){


$sql3 = 'select * from sale_do_details where do_no="'.$row->do_no.'" order by id asc';
			$qry3 = mysql_query($sql3);
			
			while($getRow = mysql_fetch_object($qry3)){
               $row_num[$getRow->do_no][$getRow->item_id] = $c;
			   $c++;	
			}
			$c = 1;
			
$depo_code = find_a_field('warehouse','warehouse_code','warehouse_id="'.$row->depot_id.'"');
$item_all=find_all_field('item_info','','item_id="'.$row->item_id.'"');
$details=find_all_field('sale_do_details','','item_id="'.$row->item_id.'" and do_no="'.$row->do_no.'"');
$entry_by=find_a_field('user_activity_management','fname','user_id="'.$row->entry_by.'"'); 
$approve_by=find_a_field('user_activity_management','fname','user_id="'.$row->approve_by.'"'); 
$gift_sql = 'select s.*,i.item_name,i.finish_goods_code from sale_do_details s, item_info i where s.item_id=i.item_id and s.do_no="'.$row->do_no.'" and s.item_id="'.$row->gift_item_id.'" and s.gift_id>0';
$gift_qry = mysql_query($gift_sql);
$gift_info = mysql_fetch_object($gift_qry);
$gift_delivered = find_a_field('sale_do_chalan','sum(total_unit)','do_no="'.$row->do_no.'" and item_id="'.$row->gift_item_id.'" and gift_id="'.$row->s_gift_id.'"');

?>
                <td><?=++$i?></td>
                <td><?php echo $row->do_no.'+'.$ch_all->do_date.'+'.$row_num[$row->do_no][$row->item_id]?></td>
                <td><?=$item_all->finish_goods_code.'-'.$item_all->item_name?></td>
				<td><?=$row->chalan_qty_ctn?></td>
                <td><?=$gift_delivered?></td>
                <td><?=$row->chalan_qty_pcs+$gift_delivered?></td>
				<td><?=$row->chalan_qty_pcs;?></td>
                <td><?=$gift_delivered?></td>
				<td><?=number_format($row->do_price*$row->chalan_qty_pcs,2)?></td>
                <td><?=number_format($row->total_amt,2)?></td>
                <td><?=$depo_code?></td>
            </tr>
				<?php
				  
				   } ?>

            <tr>
                <td colspan="8" rowspan="2" style="text-align:left ;font-weight:bold;">Receiver Sign and Date </td>
                <td colspan="3" style="text-align:left ;font-weight:bold;">
                        Remarks                </td>
            </tr>
            <tr>
                <td colspan="3">If any mismatch, Please inform your SR/ASM/DSM.</td>
            </tr>

            <tr>
                <td colspan="11"><h5 style="text-align: center; font-weight: bold;">Undelivered Information</h5></td>
            </tr>

            
            <tr>
                <td colspan="11">
                    <table class="table table-bordered border-primary  text-center">
                        <thead>
                      <tr>
                <th>SL</th>
                <th>Ref#</th>
                <th colspan="2">Item Description</th>
				<th>TQ</th>
                <th>Q</th>
                <th>S.Qty</th>
                <th>A</th>
                <th>AAD</th>
                <th>Depot</th>
				<th>Note</th>
            </tr>
                        </thead>
                        <tbody class=" text-center table-striped">
						<? 
						
			 $sql2='select a.id,m.do_no,m.do_date,m.depot_id, m.do_type,m.dealer_type, a.item_id,a.pkt_unit,  a.unit_price, b.item_name,b.finish_goods_code, b.unit_name,  a.total_unit as qty,o.item_name as c_item,o.company,a.total_amt,a.do_price from sale_do_master m,sale_do_details a left join item_info_other o on o.item_id=a.c_item_id,item_info b, item_sub_group s where m.do_no=a.do_no and m.status="CHECKED" and b.item_id=a.item_id and b.sub_group_id=s.sub_group_id and ( m.dealer_code="'.$ch_all->dealer_code.'" OR  m.distributor_id="'.$ch_all->dealer_code.'") and a.gift_id=0 and m.depot_id="'.$do_all->depot_id.'"';
						 $qry2 = mysql_query($sql2);
						 while($undel=mysql_fetch_object($qry2)){
						 
						 $depo_code = find_a_field('warehouse','warehouse_code','warehouse_id="'.$undel->depot_id.'"');
						 $d_qty = find_a_field('sale_do_details','sum(total_unit)','id="'.$undel->id.'" and do_no="'.$undel->do_no.'"');
				         $c_qty = find_a_field('sale_do_chalan','sum(total_unit)','order_no="'.$undel->id.'" and do_no="'.$undel->do_no.'" ');
						 $undel_qty = $d_qty-$c_qty;
						 $gift_item_id = find_all_field('sale_gift_offer','gift_id','item_id="'.$undel->item_id.'" and start_date<="'.$undel->do_date.'" and end_date>="'.$undel-> do_date.'" and dealer_type="'.$dealer_type.'"');
						 $gift_sql = 'select s.*,i.item_name,i.finish_goods_code from sale_do_details s, item_info i where s.item_id=i.item_id and s.do_no="'.$undel->do_no.'" and  s.item_id="'.$gift_item_id->gift_id.'" and s.gift_id>0';
                         $gift_qry = mysql_query($gift_sql);
                         $gift_info = mysql_fetch_object($gift_qry);
                         $gift_delivered = find_a_field('sale_do_chalan','sum(total_unit)','do_no="'.$undel->do_no.'" and item_id="'.$gift_item_id->gift_id.'" and gift_id="'.$gift_item_id->id.'"');
                         
						 if($d_qty>$c_qty){
						 $rest_pcs = $d_qty-$c_qty;
						 
						 $sql = 'select * from sale_do_details where do_no="'.$undel->do_no.'" order by id asc';
			             $qry = mysql_query($sql);
			             $c=1;
			             while($getRow = mysql_fetch_object($qry)){
                         $row_num[$getRow->do_no][$getRow->item_id] = $c;
			             $c++;
						
						 
			             }
						 
						?>
                            <tr>
                                <td><?=++$n?></td>
                                <td><?=$undel->do_no.'+'.$undel->do_date.'+'.$row_num[$undel->do_no][$undel->item_id]?></td>
                                <td colspan="2"><?=$undel->finish_goods_code.'-'.$undel->item_name?></td>
								<td><?=$rest_pcs+$gift_info->total_unit?></td>
                                <td><?=$rest_pcs?> </td>
                                <td><?=$gift_info->total_unit?> </td>
								<? if($undel->dealer_type=='Official'){?>
								<td></td>
                                <td></td>
								<? }else{?>
								<td><?=$undel->do_price*$rest_pcs?> </td>
                                <td><?=$undel->unit_price*$rest_pcs?></td>
								<? } ?>
                                <td><?=$depo_code?></td>
								<td><?=$undel->do_type?></td>
                            </tr>
							<? } } ?>
							
						
                        </tbody>
                </table>                </td>
            </tr>


            <tr>
                <td colspan="12">
                    <p class="m-0 p-0"><b>This is automated Generated Challan of RCL ERP System.</b></p>
                    <p class="m-0 p-0">This Challan Generated by <strong><?=$entry_by?></strong> date is <strong><?=date('M-d-Y',strtotime($ch_all->entry_at))?></strong> and time   <strong><?=date('H:i:s',strtotime($ch_all->entry_at))?></strong> at place is <strong><?=$depot_name?></strong>.</p>                </td>
            </tr>
            </tbody>
        </table>
    </div>



</section>




<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>