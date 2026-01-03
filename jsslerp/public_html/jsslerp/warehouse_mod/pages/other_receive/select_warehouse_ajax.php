<?php


session_start();
require_once "../../../assets/template/layout.top.php";
@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');


$str = $_POST['data'];


$data=explode('##',$str);

$page_for = 'Other Receive';

 
 $warehouse = $data[0];
 $or_no=$data[1];
 $qty=$data[2];
 $qty=$data[2];
 
 $booking_no = $data[3];
 $bag_mark = $data[4] ;
 
 $fc = substr($booking_type,0,1);
 
   
$orAll = find_all_field('warehouse_other_receive','*','or_no='.$or_no);
$orDetail = find_all_field('warehouse_other_receive_detail','*','or_no='.$or_no);
if( $warehouse>0 && $qty>0){
	journal_item_control($orDetail->item_id ,$warehouse,$orAll->or_date,$qty,0,$page_for,$orDetail->id,$orDetail->rate,'',$or_no,'','','','',$orAll->bag_mark);
	
	header('Location: select_warehouse.php');
	 //10
	//journal_item_control($item_id, $warehouse_id,$ji_date,$item_in,$item_ex,$tr_from,$tr_no,$rate='',$r_warehouse='',$sr_no='',$bag_size='',$bag_unit='',$group_for='',$final_price='',$barcode='' )
}else{
	echo '<div class="alert-primary">Please Select Warehouse</div>';
}
//journal_item_control($item_id, $warehouse_id, $rec_date, $qty, 0, 'Purchase', $xid, $rate, '', $pr_no, '', '',$group_for, $final_avg_price, '' );



?>

 <table class="table1  table-striped table-bordered table-hover table-sm">
      <thead class="thead1">
        <tr class="bgc-info">
		  <th>Name </th>
		  <th>Village </th>
		  <th>Token No </th>
          <th>Receipt No </th>
          <th>Date </th>
          <th>Bag Mark </th>
          <th>Total Qty </th>
          <th>Due Qty </th>
          <th>Qty</th>
          <th>Warehouse</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="tbody1">
	  

 <?
						 $sql = "SELECT m.*, sum(d.qty) as total_qty FROM warehouse_other_receive m, warehouse_other_receive_detail d
							  WHERE m.or_no=d.or_no and m.bag_mark='".$bag_mark."'  group by d.or_no ";
						
						
						
						  $query = mysql_query($sql);
						  while($data=mysql_fetch_object($query)){ $i++;
						  
						 $alreadyRcv = find_a_field('journal_item','sum(item_in-item_ex)','sr_no='.$data->or_no);
						 $due_qty = ($data->total_qty-$alreadyRcv);
						
						
						  ?>
        <? if ($due_qty>0) {
		
		
	
		?>
        <tr>
          <td><span class="style13" >
            <?=$data->agent_name;?>
            </span></td>
          <td><span class="style13" ><?=$data->village;?></span></td>
          <td><?php echo $data->token_number;?></td> 
          <td><strong><?=$data->receipt_number;?></strong></td>
		  <td><strong><?php echo date('d-m-Y',strtotime($data->or_date));?></strong></td>
		  <td><?php echo $data->bag_mark;?></td> 
		  
          <td><strong><?php echo $data->total_qty;?></strong></td>
          <td><strong><? echo $due_qty;?></strong></td>
		  
          <td><input name="qty_<?=$data->or_no?>" id="qty_<?=$data->or_no?>" required type="text"  value=""  />
		  		<input name="booking_number_<?=$data->or_no?>" id="booking_number_<?=$data->or_no?>" type="hidden" value="<?=$data->booking_number?>" />
		  </td>
		  
          <td><input name="warehouse_<?=$data->or_no?>" required list="warehouses<?=$data->or_no?>" id="warehouse_<?=$data->or_no?>" type="text"  value="<?=$data->ledger_id?>"  />
		  		
			<datalist id="warehouses<?=$data->or_no?>">
			<? foreign_relation('warehouse','warehouse_name','warehouse_name',$warehouse_id,'1')?>
			</datalist>
           
			<input name="or_no_<?=$data->or_no?>" id="or_no_<?=$data->or_no?>" type="hidden"  value="<?=$data->or_no?>"  /> 
            <input name="payment_amt_<?=$data->or_no?>" id="payment_amt_<?=$data->or_no?>" type="hidden" size="10"  value=""   />          </td>
          <td align="center"><center>
              <button id="but_<?=$data->or_no?>" onclick="getData2('select_warehouse_ajax.php', 'assign_warehouse', document.getElementById('warehouse_<?=$data->or_no?>').value,  document.getElementById('or_no_<?=$data->or_no?>').value+'##'+document.getElementById('qty_<?=$data->or_no?>').value+'##'+document.getElementById('booking_number_<?=$data->or_no?>').value+'##'+document.getElementById('bag_mark').value); hide(<?=$data->or_no?>)" type="button" class="btn1 btn1-bg-submit" >Add</button>
            </center></td>
        </tr>
        <? } }?>
		
		</tbody>
    </table>


