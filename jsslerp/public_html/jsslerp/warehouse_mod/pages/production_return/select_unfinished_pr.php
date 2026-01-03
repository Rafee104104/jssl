<?php


session_start();


ob_start();


require_once "../../../assets/template/layout.top.php";


$title='Unfinished CMR List';

$table = 'production_floor_return_master';


$unique = 'pr_no';


$status = "RECEIVED";


$target_url = '../production_return/production_receive.php';



 if(prevent_multi_submit()){
if(isset($_POST['confirm']))

{


$select = "update production_floor_return_master set received_by=".$_SESSION['user']['id'].",received_at='".date('Y-m-d H:i:s')."',status='COMPLETE' where pr_no=".$_POST['pr_no'];
//$select = "update production_floor_return_master set status='RECEIVED' where pr_no=".$_POST['pr_no'];


//$sql = "select * from production_floor_return_detail where pr_no=".$_POST['pr_no'];

$sql ='SELECT r.id,rr.pr_no,r.item_id ,rr.warehouse_from,rr.warehouse_to,i.item_name,s.group_id,s.sub_group_name,s.status,r.total_unit,rr.pr_date FROM production_floor_return_detail r,production_floor_return_master rr,item_info i,item_sub_group s  WHERE r.pr_no="'.$_POST['pr_no'].'" and  rr.pr_no=r.pr_no and i.item_id=r.item_id and i.sub_group_id=s.sub_group_id';

$result = mysql_query($sql);

//$jv=next_journal_journal_voucher_id();

While($data=mysql_fetch_object($result)){

$found =find_a_field('journal_item','count(tr_no)','tr_from="Production Return" and tr_no='.$data->id);

	if($found==0){
	if(($data->status==0) && ($data->ledger_id_1 !=0)){
	$wip_ledger = $data->ledger_id_1;
		
	}elseif( ($data->status==1 || $data->ledger_id_1==0) && ($data->group_id !=1100000000) ) {
		$wip_ledger = 4002007500020000;
	}
	
	
	
$final_price=find_a_field('journal_item','final_price',' 1 and final_price>0 and item_id="'.$data->item_id.'" order by id desc');



$final_amt = $final_price * $data->total_unit;



$pr_date = strtotime($data->pr_date);


	
//if($data->group_id!=1100000000){	
//	
//if($final_amt>0){
//
//$test="INSERT INTO `journal` (`id`, `proj_id`, `jv_no`, `jv_date`,`jvi_date` ,`ledger_id`, `narration`, `dr_amt`, `cr_amt`, `tr_from`, `tr_no`, `sub_ledger`, `cc_code`, `user_id`, `tr_id`, `group_for`, `entry_at`) VALUES ( NULL, 'Alinfoods', '".$jv."', '".$pr_date."', '".$data->pr_date."','".$data->ledger_id."', 'PR#".$_POST['pr_no']."item id-".$data->item_id."', '".$final_amt."', '0.00', 'production_return', '".$_POST['pr_no']."', '', '0', '".$_SESSION['user']['id']."', '', '2', '".date('Y-m-d H:i:s')."')";
//
//
//
//mysql_query($test);
//
//
//
//mysql_query("INSERT INTO `journal` (`id`, `proj_id`, `jv_no`, `jv_date`,`jvi_date` ,`ledger_id`, `narration`, `dr_amt`, `cr_amt`, `tr_from`, `tr_no`, `sub_ledger`, `cc_code`, `user_id`, `tr_id`, `group_for`, `entry_at`) VALUES ( NULL, 'Alinfoods', '".$jv."', '".$pr_date."','".$data->pr_date."' ,'".$wip_ledger."', 'REQ#".$_POST['pr_no']."item id-".$data->item_id."', '0.00','".$final_amt."',  'production_return', '".$_POST['pr_no']."', '', '0', '".$_SESSION['user']['id']."', '', '2', '".date('Y-m-d H:i:s')."')");
//
//$final_amt =0;
//}
//	
//}
	

journal_item_control($data->item_id,$data->warehouse_from,$data->pr_date,0,$data->total_unit,'Production Return',$data->id,$data->unit_price,'',$data->pr_no);
journal_item_control($data->item_id,$data->warehouse_to,$data->pr_date,$data->total_unit,0,'Production Return',$data->id,$data->unit_price,'',$data->pr_no);

}

}

mysql_query($select);




}
}


if(isset($_POST['return']))

{


$select = "update production_floor_return_master set status='MANUAL' where pr_no=".$_POST['pr_no'];
//$select = "update production_floor_return_master set status='RECEIVED' where pr_no=".$_POST['pr_no'];

mysql_query($select);




}
/*if($_POST[$unique]>0)


{


$_SESSION[$unique] = $_POST[$unique];


header('location:'.$target_url);


}*/





?>
<div class="form-container_large">


<form action="<?=$target_url?>" method="post" name="codz" id="codz">


<table width="80%" border="0" align="center">


  <tr>


    <td>&nbsp;</td>


    <td>&nbsp;</td>


    <td>&nbsp;</td>
  </tr>


  <tr>


    <td>&nbsp;</td>


    <td>&nbsp;</td>


    <td>&nbsp;</td>
  </tr>


  <tr>


    <td align="right" bgcolor="#FF9966"><strong><?=$title?>: </strong></td>


    <td bgcolor="#FF9966"><strong>


      <select name="old_pr_no" id="old_pr_no">
    <?
        $sql = 'select pr_no from production_floor_return_master where  status="CHECKED" ';
        $rs = mysql_query($sql);
        while($row=mysql_fetch_object($rs)){
            echo '<option value="'.$row->pr_no.'">'.$row->pr_no.'</option>';
        }
        ?>
      </select>


    </strong></td>


    <td bgcolor="#FF9966"><strong>
      <input type="submit" name="submitit" id="submitit" value="VIEW DETAIL" style="width:170px; font-weight:bold; font-size:12px; height:30px; color:#090"/>
    </strong></td>
  </tr>
</table>





</form>


</div>





<?


$main_content=ob_get_contents();


ob_end_clean();


include ("../../template/main_layout.php");


?>