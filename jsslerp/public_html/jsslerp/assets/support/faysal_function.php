<?php


function pal_taka_show($grand_total){

$credit_amt = explode('.',$grand_total);

	 if($credit_amt[0]>0){
	 echo convertNumberToWordsForIndia($credit_amt[0]);}

	 if($credit_amt[1]>0){

	 if($credit_amt[1]<10) $credit_amt[1] = $credit_amt[1]*10;
	 echo  ' & '.convertNumberToWordsForIndia($credit_amt[1]).' paisa ';}
	 echo ' Only.';
}



function mis_log($tr_date,$sr_no, $module_name, $access_detail, $user_id='', $access_date='' ,$access_time='')
{
	if($access_date=='') $access_date = date('Y-m-d');
	if($access_time=='') $access_time = date('Y-m-d H:i:s');
	if($user_id=='') $user_id = $_SESSION['user']['id']; 
	
$sql="INSERT INTO user_mis_support ( user_id, access_date, access_time, module_name,tr_date,sr_no, access_detail
)VALUES(
'$user_id', '$access_date', '$access_time', '$module_name', '$tr_date', '$sr_no', '$access_detail'
)";
	
mysql_query($sql);
}	





function redirect($link){
?>
<script>window.location.href = "<?php echo $link;?>";</script>
<?php }


function redirect2($link){
?>
<script>
setTimeout(function(){ window.location = "<?php echo $link;?>"; },1000);
</script>
<?php }


function find1($sql){
	
		if ($res=mysql_query($sql)){
		  while ($row=mysql_fetch_row($res))
			{
			return ($row[0]);
			} 
		} else return NULL;
	}


function findall($sql){
		if ($res=mysql_query($sql)){
		  while ($data=mysql_fetch_object($res))
			{
			return $data;
			}
		}
	}


function optionlist($sql){

	$res=mysql_query($sql);
		while($data=mysql_fetch_row($res))
		{ $value="";
			if($value==$data[0])
			echo '<option value="'.$data[0].'" selected>'.$data[1].'</option>';
			else
			echo '<option value="'.$data[0].'">'.$data[1].'</option>';
			}
}


function find_in_sql($sql){	
  $res = @mysql_query($sql);	
	$count=@mysql_num_rows($res);
	 if($count>0){
	        $mi = 0;	
			while($data=@mysql_fetch_row($res)){
			if($mi==0)
			$ch = $data[0];
			else
			$ch .= ','.$data[0]; $mi++;
			}
		return $ch;	
	}else return NULL;
}



function validation($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = mysql_real_escape_string($data);
  return $data;
}


// --------------- INSERT -------------
function insert($table){

$result = mysql_query("SHOW COLUMNS FROM $table") or   die(mysql_error());
$columns = array();
while ($row = mysql_fetch_array($result)) {
			$columns[] = $row[0];
		}

$keys = array();
$values = array();
unset($columns[0]);
foreach ($columns as $column) {

    $value      = trim($_POST[$column]);
    $value      = validation($value);
    $keys[]     = "`{$column}`";
    $values[]   = "'{$value}'";
	}
$query = "insert ignore into $table (" . implode(',', $keys) . ") 
          VALUES (" . implode(',', $values). ")";
mysql_query($query);
//echo $query;
}
// --------------- EXAMPLE -----------
/*if(isset($_POST['record'])){	
@insert('admin');
echo "New data insert successfully";
}*/


function insert2($table){

$result = mysql_query("SHOW COLUMNS FROM $table") or   die(mysql_error());
$columns = array();
while ($row = mysql_fetch_array($result)) {
			$columns[] = $row[0];
		}

$keys = array();
$values = array();
foreach ($columns as $column) {

    $value      = trim($_POST[$column]);
    $value      = validation($value);
    $keys[]     = "`{$column}`";
    $values[]   = "'{$value}'";
	}
$query = "insert ignore into $table (" . implode(',', $keys) . ") 
          VALUES (" . implode(',', $values). ")";
mysql_query($query);
//echo $query;
}


// ------------------- UPDATE ------------------
function update($table,$condition){

if($condition!=''){
//array_pop($_POST);
foreach($_POST as $field_name => $field_value) {
	$field_name     = validation($field_name);
	$field_value    = validation($field_value);
	$sql_str[]      = "$field_name = '$field_value'";
	}
	
$query = "UPDATE $table SET ".implode(',', $sql_str)." WHERE $condition";
mysql_query($query);
//echo $query;

}
}
//--example
/*if(isset($_POST['update'])){

@update('item_info','item_id="'.$_GET['edit_id'].'"');
echo "Update successfully";
}*/











function add_to_sec_journal2($proj_id, $jv_no, $jv_date, $ledger_id, $narration, $dr_amt, $cr_amt, $tr_from, $tr_no,$sub_ledger='',$tr_id='',$cc_code='',
$group='',$entry_by='',$entry_at='',$received_from='', $bank='', $cheq_no='',$cheq_date='',$relavent_cash_head='',$type='',$employee='',$remarks='',$reference_id='')

{
    
    if($type=='') $type='NO';
	if($group>0) $group_id = $group; else $group_id = $_SESSION['user']['group'];
	if($entry_at=='') $entry_at = date('Y-m-d H:i:s');
	if($entry_by=='') $entry_by = $_SESSION['user']['id']; 
  $journal="INSERT INTO `secondary_journal` (
	proj_id ,
	jv_no,
	jv_date ,
	ledger_id ,
	narration ,
	dr_amt ,
	cr_amt ,
	tr_from ,
	received_from,
	tr_no ,
	sub_ledger,
	entry_by,
	entry_at,
	group_for,
	tr_id,
	cc_code,
	bank,
	cheq_no,
	cheq_date,
	relavent_cash_head,
	type,
	employee_id,
	remarks,
	reference_id
	
	)VALUES ('$proj_id', '$jv_no', '$jv_date', '$ledger_id', '$narration', '$dr_amt', '$cr_amt', '$tr_from', '$received_from', '$tr_no','$sub_ledger','$entry_by','$entry_at','$group_id','$tr_id','$cc_code'
	,'$bank','$cheq_no','$cheq_date','$relavent_cash_head','$type','$employee','$remarks','$reference_id')";
	$query_journal=mysql_query($journal);
}










function add_to_journal2($proj_id, $jv_no, $jv_date, $ledger_id, $narration, $dr_amt, $cr_amt, $tr_from, $tr_no,$sub_ledger='',$tr_id='',$cc_code=''){
	
$journal="INSERT INTO journal (proj_id ,jv_no,jv_date,ledger_id,narration,dr_amt,cr_amt,tr_from,tr_no,sub_ledger,entry_by,entry_at,group_for,tr_id,cc_code
	)VALUES ('$proj_id', '$jv_no', '$jv_date', '$ledger_id', '$narration', '$dr_amt', '$cr_amt', '$tr_from', '$tr_no','$sub_ledger','".$_SESSION['user']['id']."','".date('Y-m-d H:i:s')."','".$_SESSION['user']['group']."','$tr_id','$cc_code')";
	$query_journal=mysql_query($journal);
}



function add_to_journal_collection($proj_id, $jv_no, $jv_date, $ledger_id, $narration, $dr_amt, $cr_amt, $tr_from, $tr_no,$sub_ledger='',$tr_id='',$cc_code='',$group_for=''){
	
$journal="INSERT INTO journal (proj_id ,jv_no,jv_date,ledger_id,narration,dr_amt,cr_amt,tr_from,tr_no,sub_ledger,checked_by,checked_at,group_for,tr_id,cc_code
	)VALUES ('$proj_id', '$jv_no', '$jv_date', '$ledger_id', '$narration', '$dr_amt', '$cr_amt', '$tr_from', '$tr_no','$sub_ledger','".$_SESSION['user']['id']."','".date('Y-m-d H:i:s')."','".$group_for."','$tr_id','$cc_code')";
	$query_journal=mysql_query($journal);
}




function sec_journal_journal2($sec_jv_no,$jv_no,$tr_froms)
{

    $sql = 'select * from secondary_journal where jv_no = "'.$sec_jv_no.'" and tr_from = "'.$tr_froms.'"';
    $query = mysql_query($sql);
    while($data = mysql_fetch_object($query))
    {	
        
    if($jv_no==0)  {$jv_no = $data->jv_no;}
    
    $journal="INSERT INTO `journal` (
    	`proj_id` ,
    	`jv_no` ,
    	`jv_date` ,
    	`ledger_id` ,
    	`narration` ,
    	`dr_amt` ,
    	`cr_amt` ,
    	`tr_from` ,
    	`tr_no` ,
    	`tr_id` ,
    	`sub_ledger`,
    	user_id,
    	entry_at,
    	group_for,
    	cc_code
    	)VALUES 
            ('$data->proj_id', '$jv_no', '$data->jv_date', '$data->ledger_id', '$data->narration', '$data->dr_amt', '$data->cr_amt', '$data->tr_from', '$data->tr_no', 
            '$data->tr_id','$data->sub_ledger','".$_SESSION['user']['id']."','".date('Y-m-d H:i:s')."', '$data->group_for', '".$data->cc_code."')";
    	
    	$query_journal=mysql_query($journal);
    }

}


function auto_insert_sales_chalan_secoundary2($chalan_no){
	
	$proj_id = 'clouderp'; 
	$do_ch =    find_all_field('sale_do_chalan','','chalan_no='.$chalan_no);
	$group_for =  $do_ch->group_for;
	$do_master = find_all_field('sale_do_master','','do_no='.$do_ch->do_no);
    $dealer = find_all_field('dealer_info','',"dealer_code=".$do_ch->dealer_code);
	
	$jv_no=next_journal_sec_voucher_id('','Sales',$group_for);
    $tr_id = $do_ch->do_no;
	$tr_no = $chalan_no;
	$tr_from = 'Sales';
	$jv_date = $do_ch->chalan_date;
	$narration = 'CH# '.$chalan_no.' (SO# '.$do_ch->do_no.')';
    
	$sql = "select sum(total_amt) as total_amt from sale_do_chalan c where  chalan_no=".$chalan_no;
	$ch = find_all_field_sql($sql);


$sales_amt = $ch->total_amt;
$discount_amt = ($sales_amt*$do_master->discount)/100;
$amount_after_discount = $sales_amt-$discount_amt;

$vat_on_sales = ($amount_after_discount*$do_master->vat_ait)/100;
$invoice_amt = ($amount_after_discount + $vat_on_sales);

	
	$config_ledger = find_all_field('config_group_class','',"group_for=".$group_for);
	$dealer_ledger= $dealer->account_code;
	$cc_code = 0;

//debit	 
if($invoice_amt>0)
add_to_sec_journal2($proj_id, $jv_no, $jv_date, $dealer_ledger, $narration, $invoice_amt, '0', $tr_from, $tr_no,'',$tr_id,$cc_code,$group_for);

if($discount_amt>0)
add_to_sec_journal2($proj_id, $jv_no, $jv_date, $config_ledger->sales_discount, $narration, $discount_amt, '0', $tr_from, $tr_no,'',$tr_id,$cc_code,$group_for);


//credit
if($sales_amt>0)
add_to_sec_journal2($proj_id, $jv_no, $jv_date, $config_ledger->sales_ledger, $narration, '0', $sales_amt, $tr_from, $tr_no,'',$tr_id,$cc_code,$group_for);

if($vat_on_sales>0)
add_to_sec_journal2($proj_id, $jv_no, $jv_date, $config_ledger->sales_vat, $narration, '0', $vat_on_sales, $tr_from, $tr_no,'',$tr_id,$cc_code,$group_for);




//-------- COGS journal
// if($chalan_no>0){
// auto_insert_sales_cogs_secoundary($chalan_no);
// }


$sa_config = find_a_field('voucher_config','secondary_approval','voucher_type="'.$tr_from.'"');

$time_now = date('Y-m-d H:i:s');

if($sa_config=="Yes"){

            $sa_up='update secondary_journal set secondary_approval="Yes", om_checked_at="'.$time_now.'", om_checked="'.$_SESSION['user']['id'].'" where jv_no="'.$jv_no.'" and tr_from="'.$tr_from.'"';
            mysql_query($sa_up);
            
            
            $jv_config = find_a_field('voucher_config','direct_journal','voucher_type="'.$tr_from.'"');
            
            if($jv_config=="Yes"){
            
                sec_journal_journal2($jv_no,$jv_no,$tr_from);
                
                $time_now = date('Y-m-d H:i:s');
                
                $up2='update secondary_journal set checked="YES",checked_at="'.$time_now.'", checked_by="'.$_SESSION['user']['id'].'" where jv_no="'.$jv_no.'" and tr_from="'.$tr_from.'"';
                mysql_query($up2);
                
                $sa_up2='update journal set secondary_approval="Yes", checked="YES", checked_by="'.$_SESSION['user']['id'].'", checked_at="'.$time_now.'", om_checked_at="'.$time_now.'" ,om_checked="'.$_SESSION['user']['id'].'" where jv_no="'.$jv_no.'" and tr_from="'.$tr_from.'"';
                mysql_query($sa_up2);
            }

} else {

        $sa_up='update secondary_journal set secondary_approval="No" where jv_no="'.$jv_no.'" and tr_from="'.$tr_from.'"';
        mysql_query($sa_up);
        
        }


} // end



// GP SMS API
function gpsms($masking, $dest_addr, $sms_text) {
	//$masking = "MEP GROUP";

$get_2ch = substr($dest_addr, 0, 2);
if($get_2ch==88) {$dest_addr = substr($dest_addr, 2, 11);}

		
	$data = array(
		"username"		=> "gpuser",
		"password"		=> "gppass",
		"apicode"		=> "1",
		"msisdn"		=> $dest_addr,
		"countrycode"	=> "880",
		"cli"			=> $masking,
		"messagetype"	=> "1",
		"message"		=> $sms_text,
		"messageid"		=> "0"
	);
	
	$url = "https://gpcmp.grameenphone.com/ecmapigw/webresources/ecmapigw.v2";
	$ch = curl_init( $url );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($data) );
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json') );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	
	try {
		$output = curl_exec($ch); //print_r($output);	
        $json = $output;
        $obj = json_decode($json);
        $statusCode = $obj->statusCode;	
        if($statusCode==200){
        }else{ echo '<h1 style="color:red;">Error: SMS Not Send</h1>'; }
	} catch(Exception $ex) {
		$output = "-100";}
	
	return $output;	

}



function auto_insert_sales_return_secoundary2($return_no){

	
	$proj_id = 'clouderp';
	
	//$group_for =  $_SESSION['user']['group'];
	$do_master  = find_all_field('sale_return_master','','do_no='.$return_no);
    $dealer     = find_all_field('dealer_info','',"dealer_code=".$do_master->dealer_code);
	$group_for = $do_master->group_for;
	$return_type = find_a_field('sales_return_type','sales_return_type','id="'.$do_master->sales_type.'"');
	
	$jv_no      =next_journal_sec_voucher_id('',$return_type,$group_for);
    $tr_id      = $do_master->do_no;
	$tr_no      = $return_no;
	$tr_from    = $return_type;
	$narration  = 'SR No# '.$return_no;
    
	$sql = "select sum(total_amt) as total_amt from sale_return_details c where  do_no=".$do_master->do_no;
	$ch = find_all_field_sql($sql);

	$sales_amt = $ch->total_amt;

	$jv_date = $do_master->do_date;

	$invoice_amt = ($sales_amt);
	
	$config_ledger = find_all_field('config_group_class','sales_return','group_for=1'); // group for
	$dealer_ledger= $dealer->account_code;
	$cc_code = $do_master->depot_id;



if($invoice_amt>0)
add_to_sec_journal2('MEP', $jv_no, $jv_date, $config_ledger->sales_return, $narration, ($invoice_amt), '0',   $tr_from, $tr_no,'',$tr_id,$cc_code,$group_for,'','','','','','','','NO');

if($invoice_amt>0)
add_to_sec_journal2('MEP', $jv_no, $jv_date, $dealer_ledger, $narration, 0, ($invoice_amt),$tr_from, $tr_no,'',$tr_id, $cc_code,$group_for,'','','','','','','','NO');



$sa_config = find_a_field('voucher_config','secondary_approval','voucher_type="'.$tr_from.'"');

$time_now = date('Y-m-d H:i:s');

if($sa_config=="Yes"){
$sa_up='update secondary_journal set secondary_approval="Yes", om_checked_at="'.$time_now.'", om_checked="'.$_SESSION['user']['id'].'" where jv_no="'.$jv_no.'" and tr_from="'.$tr_from.'"';
mysql_query($sa_up);

$jv_config = find_a_field('voucher_config','direct_journal','voucher_type="'.$tr_from.'"');


if($jv_config=="Yes"){
    sec_journal_journal2($jv_no,$jv_no,$tr_from);
    $time_now = date('Y-m-d H:i:s');
    
    $up2='update secondary_journal set checked="YES",checked_at="'.$time_now.'", checked_by="'.$_SESSION['user']['id'].'" 
        where jv_no="'.$jv_no.'" and tr_from="'.$tr_from.'"';
    
    mysql_query($up2);
    
    $sa_up2='update journal set secondary_approval="Yes", checked="YES", checked_by="'.$_SESSION['user']['id'].'", checked_at="'.$time_now.'", om_checked_at="'.$time_now.'" ,om_checked="'.$_SESSION['user']['id'].'" 
        where jv_no="'.$jv_no.'" and tr_from="'.$tr_from.'"';
    mysql_query($sa_up2);
}

} else {

$sa_up='update secondary_journal set secondary_approval="No" where jv_no="'.$jv_no.'" and tr_from="'.$tr_from.'"';

mysql_query($sa_up);

}


}




function auto_insert_sales_return_secoundary3($or_no){

$tr_from = 'Sales Return';

$or             = find_all_field('sale_return_master','',"do_no=".$or_no);
$group_for      = $or->group_for;
$narration      = 'Sales Return SR#'.$or_no;
$chalan_date    = $or->party_do_date;
$jv_date        = $or->do_date;

$dealer         = find_all_field('dealer_info','account_code',"dealer_code=".$or->dealer_code);
$dealer_ledger  = $dealer->account_code;

$jv_no          = next_journal_sec_voucher_id('','SalesReturn',$group_for);

$acc_code       = find_all_field_sql("select c.id,w.ledger_id from warehouse w, cost_center c where w.acc_code=c.cc_code and w.warehouse_id=".$or->warehouse_id);
$cc_code        = ($acc_code->id>0)?$acc_code->id:'0';

$return_ledger  = find_all_field('config_group_class','sales_return',"group_for=1");


$COGR_price         = find_a_field_sql("select  sum(i.f_price*c.total_unit) as price from sale_return_details c,item_info i where c.item_id=i.item_id and c.unit_price>0 and  i.item_brand!='Memo' and c.do_no=".$or_no);
$COGR_gift_price    = find_a_field_sql("select  sum(i.f_price*c.total_unit) as price from sale_return_details c,item_info i where c.item_id=i.item_id and c.unit_price=0 and  i.item_brand='Promotional' and c.do_no=".$or_no);
$sold_price         = find_a_field_sql("select  sum(c.unit_price*c.total_unit) as price from sale_return_details c,item_info i where c.item_id=i.item_id and c.unit_price>0 and  i.item_brand!='Memo' and c.do_no=".$or_no);
$memo_price         = find_a_field_sql("select  sum(i.f_price*c.total_unit) as price from sale_return_details c,item_info i where c.item_id=i.item_id and c.unit_price>0 and  i.item_brand='Memo' and c.do_no=".$or_no);


$sql ="select a.total_amt,a.id,a.do_no,a.do_date,a.dealer_code,item_id,total_unit,bonus_qty 
from sale_return_details a where do_no=".$or_no;
$query = mysql_query($sql);
$i==0;
while($data = mysql_fetch_object($query)){

$total_unit = $data->total_unit;
    
    
    
    if($dealer->dealer_type==1){ // Distributor
    
            $sss = "select * from sale_gift_offer where item_id='".$data->item_id."' 
            and ((max_qty>='".$total_unit."' and  min_qty<='".$total_unit."') or (max_qty=0 and  min_qty=0)) 
            and start_date<='".$chalan_date."' and end_date>='".$chalan_date."' 
            ";
            
            //and (region_id=0 or region_id='".$dealer->region_id."') and (zone_id=0 or zone_id='".$dealer->zone_id."') 
            //and (area_id=0 or area_id='".$dealer->area_code."')
            // and group_for like '%".$dealer->product_group."%'
            
            $qqq = mysql_query($sss);
            while($gift=mysql_fetch_object($qqq)){
            		$total_free = 0;
            		$total_cash = 0;
            		
            		if($gift->item_qty>0)
            		{
            			$gift_item = find_all_field('item_info','','item_id="'.$gift->gift_id.'"');
            			$main_item = find_all_field('item_info','','item_id="'.$gift->item_id.'"');
            			$main_item_price = find_a_field('sale_return_details','unit_price','item_id="'.$main_item->item_id.'" and do_no='.$or_no);
            			//echo 'item_id="'.$main_item->item_id.'" and or_no'.$or_no;
            			if($gift->gift_id== 1096000100010239)
            			{
            			$free_per_pcs = number_format((($gift->gift_qty/$gift->item_qty)),2,'.','');
            			$total_cash = number_format((($gift->gift_qty/$gift->item_qty)*$total_unit),2,'.','');
            			$narrations = $narration.'(IC#'.$main_item->finish_goods_code.')(Offer#'.$gift->offer_name.')(Discount for '.(int)$total_unit.'pcs@'.$free_per_pcs.'/pcs)';
            			add_to_sec_journal($proj_id, $jv_no, $jv_date, $dealer_ledger, $narrations, $total_cash,'0', $tr_from, $or_no,'',$or_no,$cc_code);
            			}
            			elseif($gift->gift_id== 1096000100010312)
            			{
            			$free_per_pcs = number_format((($gift->gift_qty/$gift->item_qty)),2,'.','');
            			$total_cash = number_format((($gift->gift_qty/$gift->item_qty)*$total_unit),2,'.','');
            			$narrations = $narration.'(IC#'.$main_item->finish_goods_code.')(Offer#'.$gift->offer_name.')(Discount for '.(int)$total_unit.'pcs@'.$free_per_pcs.'/pcs)';
            			add_to_sec_journal($proj_id, $jv_no, $jv_date, $dealer_ledger, $narrations, $total_cash,'0', $tr_from, $or_no,'',$or_no,$cc_code);
            			}
            			elseif($gift->gift_id== 1096000100010967)
            			{
            			$free_per_pcs = number_format((($gift->gift_qty/$gift->item_qty)),2,'.','');
            			$total_cash = number_format((($gift->gift_qty/$gift->item_qty)*$total_unit),2,'.','');
            			$narrations = $narration.'(IC#'.$main_item->finish_goods_code.')(Offer#'.$gift->offer_name.')(Discount for '.(int)$total_unit.'pcs@'.$free_per_pcs.'/pcs)';
            			add_to_sec_journal($proj_id, $jv_no, $jv_date, $dealer_ledger, $narrations, $total_cash,'0', $tr_from, $or_no,'',$or_no,$cc_code);
            			}
            			elseif($gift->gift_id==$data->item_id)
            			{
            			if($main_item_price>0)
            			$free_item_price = $main_item_price;
            			elseif($gift_item->d_price>0)
            			$free_item_price = $gift_item->d_price;
            			//else
            			//$free_item_price = $gift_item->f_price;
            			
            			
                            $bonus_qty              = floor(($gift->gift_qty/($gift->item_qty+$gift->gift_qty))*$total_unit);
                            $free_per_pcs           = number_format((($gift->gift_qty/$gift->item_qty)*$free_item_price),2,'.','');
                            $total_free             = number_format((($bonus_qty*$free_item_price)),2,'.','');
                            $free_unrealised_price  = number_format((($bonus_qty*$gift_item->f_price)),2,'.','');
                            $narrations             = $narration.'(IC#'.$main_item->finish_goods_code.')(Offer#'.$gift->offer_name.')(Discount for '.(int)$total_unit.'pcs@'.$free_per_pcs.'/pcs)';
                            
                            $pal_bonus_qty[$data->item_id] =$pal_bonus_qty[$data->item_id]+ $bonus_qty;
                            
                            if($pal_bonus_qty[$data->item_id]!=$data->bonus_qty){
                                $pal_sql = 'update sale_return_details set bonus_qty="'.$pal_bonus_qty[$data->item_id].'" where do_no="'.$or_no.'" and item_id = "'.$data->item_id.'"';
                                mysql_query($pal_sql);
                            }
        
            			
            			//echo $gift->item_id.'-'.$total_free.'-'.$free_item_price.'<br>';
            			}
            			
            			
            			$total_free_price = $total_free_price + $total_free;
            			$free_unrealised_total = $free_unrealised_total + $free_unrealised_price;
            			
            			$total_cash_price += $total_cash;
            			$total_free = 0;$total_cash = 0;$free_unrealised_price=0;$free_item_price = 0;
            		
            
            		} // end gift item qty
            		
            } // end gift while
    	
    } // end if distributor
}


if($total_cash_price>0){
    add_to_sec_journal2($proj_id, $jv_no, $jv_date, '1111', $narration, '0',$total_cash_price, $tr_from, $or_no,'',$or_no,$cc_code,$group_for,'','','','','','','','NO');
}


$gap = $total_free_price - $free_unrealised_total;
if($total_free_price>0){
    add_to_sec_journal2($proj_id, $jv_no, $jv_date, '2222', $narration, '0',$total_free_price, $tr_from, $or_no,'',$or_no,$cc_code,$group_for,'','','','','','','','NO');
}

if($sold_price!=0){
    add_to_sec_journal2($proj_id, $jv_no, $jv_date, $dealer_ledger, $narration, '0',($sold_price - $total_free_price), $tr_from, $or_no,'',$or_no,$cc_code,$group_for,'','','','','','','','NO');
    add_to_sec_journal2($proj_id, $jv_no, $jv_date, $return_ledger->sales_return, $narration,  $sold_price - $total_free_price,'0', $tr_from, $or_no,'',$or_no,$cc_code,$group_for,'','','','','','','','NO');
}

if($COGR_price!=0){
    add_to_sec_journal2($proj_id, $jv_no, $jv_date, '3333', $narration, '0',$COGR_price-$free_unrealised_total, $tr_from, $or_no,'',$or_no,$cc_code,$group_for,'','','','','','','','NO');
    add_to_sec_journal2($proj_id, $jv_no, $jv_date, $acc_code->ledger_id, $narration,  $COGR_price,'0', $tr_from, $or_no,'',$or_no,$cc_code,$group_for,'','','','','','','','NO');
    if($free_unrealised_total>0){
        add_to_sec_journal2($proj_id, $jv_no, $jv_date, '4444', $narration,  $gap,'0', $tr_from, $or_no,'',$or_no,$cc_code,$group_for,'','','','','','','','NO');
    }
}

if($COGR_gift_price!=0){
    add_to_sec_journal2($proj_id, $jv_no, $jv_date, '5555', $narration,     $COGR_gift_price,'0', $tr_from, $or_no,'',$or_no,$cc_code,$group_for,'','','','','','','','NO');
    add_to_sec_journal2($proj_id, $jv_no, $jv_date, '6666', $narration,   '0',$COGR_gift_price, $tr_from, $or_no,'',$or_no,$cc_code,$group_for,'','','','','','','','NO');
}



} // end function














?>