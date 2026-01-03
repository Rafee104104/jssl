<?php
function auto_insert_sales_return_cogs_secoundary_toriqul($chalan_no)
{
$sql = 'select sr_no, sr_date, do_no, group_for, sum(cost_amt) as total_amt from sale_return_details
where sr_no="'.$chalan_no.'" GROUP by sr_no';
$query = mysql_query($sql);
$data=mysql_fetch_object($query);
$group_for = $_SESSION['user']['group'];
$cc_code = 0;
$tr_from = 'GoodsReturnCOGS';
$proj_id='clouderp';
$config = find_all_field('config_group_class','',"group_for=".$group_for);
$jv_no=find_a_field('secondary_journal','jv_no','tr_no="'.$chalan_no.'" and tr_from="Goods Return"');
//next_journal_sec_voucher_id('','COGS',$_SESSION['user']['depot']);
$tr_no = $data->sr_no;
$tr_id = $data->do_no;
$jv_date = $data->sr_date;
$narration = 'SR# '.$chalan_no.' (SO# '.$data->do_no.')';
add_to_sec_journal($proj_id, $jv_no, $jv_date, $config->cogs_ledger, $narration,   $data->total_amt, '0',  $tr_from, $tr_no,'',$tr_id, $cc_code, $group_for);
$sql2 = 'select s.cogs_ledger as item_ledger, sum(c.cost_amt) as item_amt from sale_return_details c, item_info i, item_sub_group s 
where c.item_id=i.item_id and i.sub_group_id=s.sub_group_id and c.sr_no="'.$chalan_no.'" group by s.sub_group_id order by s.sub_group_id';
$query2 = mysql_query ($sql2);
while($data2=mysql_fetch_object($query2)){
//$narration_dr ='PR# '.$data2->pr_no.' (PO# '.$data2->po_no.')';
add_to_sec_journal($proj_id, $jv_no, $jv_date, $data2->item_ledger, $narration,   '0', ($data2->item_amt), $tr_from, $tr_no,'',$tr_id, $cc_code, $group_for);
}
$trr_from='Goods Return';
$sa_config = find_a_field('voucher_config','secondary_approval','voucher_type="'.$trr_from.'"');
$time_now = date('Y-m-d H:i:s');
if($sa_config=="Yes"){
$sa_up='update secondary_journal set secondary_approval="Yes", om_checked_at="'.$time_now.'", om_checked="'.$_SESSION['user']['id'].'" where jv_no="'.$jv_no.'" and tr_from="'.$trr_from.'"';
mysql_query($sa_up);
$jv_config = find_a_field('voucher_config','direct_journal','voucher_type="'.$trr_from.'"');
if($jv_config=="Yes"){
sec_journal_journal($jv_no,$jv_no,$trr_from);
$time_now = date('Y-m-d H:i:s');
$up2='update secondary_journal set checked="YES",checked_at="'.$time_now.'", checked_by="'.$_SESSION['user']['id'].'" where jv_no="'.$jv_no.'" and tr_from="'.$trr_from.'"';
mysql_query($up2);
$sa_up2='update journal set secondary_approval="Yes", checked="YES", checked_by="'.$_SESSION['user']['id'].'", checked_at="'.$time_now.'", om_checked_at="'.$time_now.'" ,om_checked="'.$_SESSION['user']['id'].'" where jv_no="'.$jv_no.'" and tr_from="'.$trr_from.'"';
mysql_query($sa_up2);
}
} else {
$sa_up='update secondary_journal set secondary_approval="No" where jv_no="'.$jv_no.'" and tr_from="'.$trr_from.'"';
mysql_query($sa_up);
}
}
function auto_insert_bulksales_return_cogs_secoundary_toriqul($chalan_no)
{
$group_for = $_SESSION['user']['group'];
$cc_code = 0;
$tr_from = 'GoodsReturnCOGS';
$proj_id='clouderp';
$config = find_all_field('config_group_class','',"group_for=".$group_for);
$jv_no=find_a_field('secondary_journal','jv_no','tr_no="'.$chalan_no.'" and tr_from="Goods Return"');
//next_journal_sec_voucher_id('','COGS',$_SESSION['user']['depot']);
$cogSql='select item_price,final_price from journal_item where tr_from in ("Purchase","Opening","Production Receive") order by id desc group by item_id';
$sql = 'select item_id,sr_no, sr_date, do_no, group_for,total_unit from sale_return_details where sr_no="'.$chalan_no.'" GROUP by item_id';
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$tr_no = $data->sr_no;
$tr_id = $data->do_no;
$jv_date = $data->sr_date;
$narration = 'SR# '.$chalan_no.' (SO# '.$data->do_no.')';
$cost_price=find_a_field('journal_item','final_price','item_id="'.$data->item_id.'" and tr_from in ("Purchase","Opening","Production Receive") order by id desc ');
$cost_amt+= ($data->total_unit*$cost_price); 
}
add_to_sec_journal($proj_id, $jv_no, $jv_date, $config->cogs_ledger, $narration,   $cost_amt, '0',  $tr_from, $tr_no,'',$tr_id, $cc_code, $group_for);
echo $sql2 = 'select s.cogs_ledger as item_ledger, c.item_id,c.total_unit from sale_return_details c, item_info i, item_sub_group s 
where c.item_id=i.item_id and i.sub_group_id=s.sub_group_id and c.sr_no="'.$chalan_no.'" group by s.sub_group_id order by s.sub_group_id';
$query2 = mysql_query ($sql2);
while($data2=mysql_fetch_object($query2)){
$cost_price1=find_a_field('journal_item','final_price','item_id="'.$data2->item_id.'" and tr_from in ("Purchase","Opening","Production Receive") order by id desc ');
$cost_amt1= ($data2->total_unit*$cost_price1); 
//$narration_dr ='PR# '.$data2->pr_no.' (PO# '.$data2->po_no.')';
add_to_sec_journal($proj_id, $jv_no, $jv_date, $data2->item_ledger, $narration,   '0', ($cost_amt1), $tr_from, $tr_no,'',$tr_id, $cc_code, $group_for);
}
$sa_config = find_a_field('voucher_config','secondary_approval','voucher_type="'.$tr_from.'"');
$time_now = date('Y-m-d H:i:s');
if($sa_config=="Yes"){
$sa_up='update secondary_journal set secondary_approval="Yes", om_checked_at="'.$time_now.'", om_checked="'.$_SESSION['user']['id'].'" where jv_no="'.$jv_no.'" and tr_from="'.$tr_from.'"';
mysql_query($sa_up);
$jv_config = find_a_field('voucher_config','direct_journal','voucher_type="'.$tr_from.'"');
if($jv_config=="Yes"){
sec_journal_journal($jv_no,$jv_no,$tr_from);
$time_now = date('Y-m-d H:i:s');
$up2='update secondary_journal set checked="YES", checked_at="'.$time_now.'", checked_by="'.$_SESSION['user']['id'].'" where jv_no="'.$jv_no.'" and tr_from="'.$tr_from.'"';
mysql_query($up2);
$sa_up2='update journal set secondary_approval="Yes", checked="YES", checked_by="'.$_SESSION['user']['id'].'", checked_at="'.$time_now.'", om_checked_at="'.$time_now.'" ,om_checked="'.$_SESSION['user']['id'].'" where jv_no="'.$jv_no.'" and tr_from="'.$tr_from.'"';
mysql_query($sa_up2);
}
} else {
$sa_up='update secondary_journal set secondary_approval="No" where jv_no="'.$jv_no.'" and tr_from="'.$tr_from.'"';
mysql_query($sa_up);
}
}
function auto_insert_sales_return_secoundary_toriqul($chalan_no)
{
$proj_id = 'clouderp';
$group_for =  $_SESSION['user']['group'];
$do_master = find_all_field('sale_return_master','','sr_no='.$chalan_no);
$dealer = find_all_field('dealer_info','',"dealer_code=".$do_master->dealer_code);
$sale_master=find_all_field('sale_do_master','','do_no='.$do_master->do_no);
$return_type = find_a_field('sales_return_type','sales_return_type','id="'.$do_master->do_type.'"');
$jv_no=next_journal_sec_voucher_id('',$return_type,$group_for);
$tr_id = $do_master->sr_no;
$tr_no = $chalan_no;
$tr_from = $return_type;
$narration = 'SR No# '.$chalan_no.' (SO# '.$do_master->do_no.')';
$sql = "select sum(total_amt) as total_amt from sale_return_details c where  sr_no=".$do_master->sr_no;
$ch = find_all_field_sql($sql);
$sales_amt = $ch->total_amt;
$jv_date = $do_master->sr_date;
$invoice_amt = ($sales_amt);
if($sale_master->vat>0){
$vat=$sale_master->vat;
$vat_amt=$invoice_amt*$vat/100;
}
if($sale_master->discount>0){
$dis=$sale_master->discount;
$dis_amt=$invoice_amt*$dis/100;
}
$totAmt=$invoice_amt+$vat_amt-$dis_amt;
//$config_ledger = find_all_field('config_group_class','sales_ledger',"group_for=".$group_for);
$config_ledger = find_all_field('config_group_class','sales_ledger',"group_for=".$_SESSION['user']['group']);
$dealer_ledger= $dealer->account_code;
$cc_code = $do_master->depot_id;
//debit	
$ssql='select sum(d.total_amt) as total_amt,s.item_ledger from sale_return_details d,item_info i,item_sub_group s where d.item_id=i.item_id and i.sub_group_id=s.sub_group_id and d.sr_no='.$chalan_no.' group by s.sub_group_id';
$squery=mysql_query($ssql);
while($sdata=mysql_fetch_object($squery)){
if($invoice_amt>0)
add_to_sec_journal($proj_id, $jv_no, $jv_date, $sdata->item_ledger, $narration,$sdata->total_amt, '0',  $tr_from, $tr_no,'',$tr_id,$cc_code,$group_for); 
}
if($sale_master->vat>0){
add_to_sec_journal($proj_id, $jv_no, $jv_date, $config_ledger->sales_vat, $narration, ($vat_amt),'0', $tr_from, $tr_no,'',$tr_id,$cc_code,$group_for);
}
if($sale_master->discount>0){
add_to_sec_journal($proj_id, $jv_no, $jv_date, $config_ledger->sales_discount, $narration,'0', ($dis_amt), $tr_from, $tr_no,'',$tr_id,$cc_code,$group_for);
}
if($invoice_amt>0)
add_to_sec_journal($proj_id, $jv_no, $jv_date, $dealer_ledger, $narration, '0', ($totAmt) , $tr_from, $tr_no,'',$tr_id,$cc_code,$group_for);
auto_insert_sales_return_cogs_secoundary_toriqul($chalan_no);
$sa_config = find_a_field('voucher_config','secondary_approval','voucher_type="'.$tr_from.'"');
$time_now = date('Y-m-d H:i:s');
if($sa_config=="Yes"){
$sa_up='update secondary_journal set secondary_approval="Yes", om_checked_at="'.$time_now.'", om_checked="'.$_SESSION['user']['id'].'" where jv_no="'.$jv_no.'" and tr_from="'.$tr_from.'"';
mysql_query($sa_up);
$jv_config = find_a_field('voucher_config','direct_journal','voucher_type="'.$tr_from.'"');
if($jv_config=="Yes"){
sec_journal_journal($jv_no,$jv_no,$tr_from);
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
}
function auto_insert_bulksales_return_secoundary_toriqul($chalan_no)
{
$proj_id = 'clouderp';
$group_for =  $_SESSION['user']['group'];
$do_master = find_all_field('sale_return_master','','sr_no='.$chalan_no);
$dealer = find_all_field('dealer_info','',"dealer_code=".$do_master->dealer_code);
$sale_master=find_all_field('sale_do_master','','do_no='.$do_master->do_no);
$return_type = find_a_field('sales_return_type','sales_return_type','id="'.$do_master->do_type.'"');
$jv_no=next_journal_sec_voucher_id('',$return_type,$group_for);
$tr_id = $do_master->sr_no;
$tr_no = $chalan_no;
$tr_from = $return_type;
$narration = 'SR No# '.$chalan_no;
$sql = "select sum(total_amt) as total_amt from sale_return_details c where  sr_no=".$do_master->sr_no;
$ch = find_all_field_sql($sql);
$sales_amt = $ch->total_amt;
$jv_date = $do_master->sr_date;
$invoice_amt = ($sales_amt);
if($sale_master->vat>0){
$vat=$sale_master->vat;
$vat_amt=$invoice_amt*$vat/100;
}
if($sale_master->discount>0){
$dis=$sale_master->discount;
$dis_amt=$invoice_amt*$dis/100;
}
$totAmt=$invoice_amt+$vat_amt-$dis_amt;
//$config_ledger = find_all_field('config_group_class','sales_ledger',"group_for=".$group_for);
$config_ledger = find_all_field('config_group_class','sales_ledger',"group_for=".$_SESSION['user']['group']);
$dealer_ledger= $dealer->account_code;
$cc_code = $do_master->depot_id;
//debit	
if($invoice_amt>0)
add_to_sec_journal($proj_id, $jv_no, $jv_date, $config_ledger->sales_return, $narration,($invoice_amt), '0',  $tr_from, $tr_no,'',$tr_id,$cc_code,$group_for); 
if($invoice_amt>0)
add_to_sec_journal($proj_id, $jv_no, $jv_date, $dealer_ledger, $narration, '0', ($totAmt) , $tr_from, $tr_no,'',$tr_id,$cc_code,$group_for);
auto_insert_bulksales_return_cogs_secoundary_toriqul($chalan_no);
$sa_config = find_a_field('voucher_config','secondary_approval','voucher_type="'.$tr_from.'"');
$time_now = date('Y-m-d H:i:s');
if($sa_config=="Yes"){
$sa_up='update secondary_journal set secondary_approval="Yes", om_checked_at="'.$time_now.'", om_checked="'.$_SESSION['user']['id'].'" where jv_no="'.$jv_no.'" and tr_from="'.$tr_from.'"';
mysql_query($sa_up);
$jv_config = find_a_field('voucher_config','direct_journal','voucher_type="'.$tr_from.'"');
if($jv_config=="Yes"){
sec_journal_journal($jv_no,$jv_no,$tr_from);
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
}
function auto_insert_purchase_secoundary_local_purchase($pr_no){
$pm = find_all_field('warehouse_other_receive','','or_no='.$pr_no);
$sql = 'select id,vendor_name,or_date as rec_date, sum(amount) as amount, sum(qty) qty, warehouse_id from warehouse_other_receive_detail where or_no = '.$pr_no;
$query = mysql_query($sql);
$data=mysql_fetch_object($query);
$vendor = find_all_field('vendor','ledger_id',"vendor_id=".$data->vendor_name);
$vendor_ledger = 4020100022;
$group_for = $vendor->group_for;
$jv=next_journal_sec_voucher_id();
$narration = 'Ch#'.$pm->chalan_no.'/ LP#'.$pr_no;
$cc_code = find_a_field('warehouse','acc_code','warehouse_id='.$data->warehouse_id);
$sql_all = 'select pr.*,s.ledger_id_2 as item_ledger,i.item_name from warehouse_other_receive_detail pr, item_info i, item_sub_group s where i.sub_group_id=s.sub_group_id and pr.item_id=i.item_id and pr.or_no="'.$pr_no.'"';
$qrr_all = mysql_query($sql_all);
while($pr_data = mysql_fetch_object($qrr_all)){
$narration_dr = 'LP#'.$pr_no.' (LP#'.$pr_no.')';
$narration_cr = 'LP#'.$pr_no.' (LP#'.$pr_no.'), Vendor Name : '.$pr_data->vendor_name;
//debit	
add_to_sec_journal('CloudERP', $jv,$pr_data->or_date, $pr_data->item_ledger, $narration_dr, ($pr_data->amount), '0', 'Local Purchase', $pr_no,'', $pr_no,$cc_code,'2','','','','','','','','NO');
//credit
add_to_sec_journal('CloudERP', $jv, $pr_data->or_date, $vendor_ledger, $narration_cr, '0', ($pr_data->amount), 'Local Purchase', $pr_no,'', $pr_no,$cc_code,'2','','','','','','','','NO');
}
//add_to_sec_journal('', $jv, strtotime($data->rec_date), $purchase_ledger, $narration, $data->amount, 0, 'Local Purchase', $pr_no,'','',$cc_code);
//add_to_sec_journal('',$jv,strtotime($data->rec_date),$vendor_ledger,$narration,0,($data->amount+$ait_amount+$pm->labor_bill+$vat_amount),'Local Purchase', $pr_no,'','',$cc_code);
}
///////////////Report function/////////////////
function link_report1($sql,$link=''){
if($sql==NULL) return NULL;
$str.='
<table id="grp" class="table1  table-striped table-bordered table-hover table-sm"  >';
$str .='<thead class="thead1"><tr class="bgc-info">';
$res=mysql_query($sql);
$cols = mysql_num_fields($res);
for($i=1;$i<$cols;$i++)
{
$name = mysql_field_name($res,$i);
$str .='<th>'.ucwords(str_replace('_', ' ',$name)).'</th>';
}
$str .='</tr></thead>';
$c=0;
$str .='<tbody class="tbody1">';
while($row=mysql_fetch_array($res))
{ if($link!='') $link= ' onclick="DoNav('.$row[0].');"';
$c++;
if($c%2==0)	$class=' class="alt"'; else $class=''; 
$str .='<tr'.$class.$link.'>';
for($i=1;$i<$cols;$i++) {$str .='<td>'.$row[$i]."</td>";}
$str .='</tr>';
}
$str .='</tbody></table>';
return $str;
}
function upload_file($folder,$field_name,$file_name=''){

$module_name = find_a_field('user_module_manage','module_file','id='.$_SESSION['mod']);
$file_name2= $_FILES[$field_name]['name'];
$file_tmp2= $_FILES[$field_name]['tmp_name'];
$file_size= $filesize = $_FILES["photo"]["size"];
$ext2=end(explode('.',$file_name2));
$ext2=strtolower($ext2);
$dir='../../../../../media/'.$_SESSION['proj_id'].'/';

if(!is_dir( $dir)) {
mkdir( $dir );
}
$dirr ='../../../../../media/'.$_SESSION['proj_id'].'/'.$module_name.'/';
if(!is_dir( $dirr)) {
mkdir( $dirr );
}
$dirrr ='../../../../../media/'.$_SESSION['proj_id'].'/'.$module_name.'/'.$folder;
if(!is_dir( $dirrr)) {
mkdir( $dirrr );
}
$path = $dirrr.'/';
$file_data = $file_name.'.'.$ext2;
$rand=rand();
if(($ext2=='jpg' || $ext2=='jpeg' || $ext2=='pdf' || $ext2=='png') && $file_size < 500000 ){
if($file_name !=''){
$file_data = $file_name.'.'.$ext2;
}else{
$file_data = $folder.'-'.$rand.'.'.$ext2;
}
$uploaded_file2 = $path.$file_name.'.'.$ext2;
move_uploaded_file($file_tmp2,$uploaded_file2);
return  $file_data;
}
}
////Purchase Return 
function auto_insert_purchase_return_secoundary_toriqul($pr_no)
{
$proj_id = 'clouderp';
$group_for =  $_SESSION['user']['group'];
$po_master = find_all_field('purchase_return_master','','pr_no='.$pr_no);
$vendor = find_all_field('vendor','',"vendor_id=".$po_master->vendor_id);
$return_type = find_a_field('purchase_return_type','return_type','id="'.$po_master->return_type.'"');
$jv_no=next_journal_sec_voucher_id('',$return_type,$group_for);
$tr_id = $po_master->pr_no;
$tr_no = $pr_no;
$tr_from = $return_type;
$narration = 'PurchaseReturn# '.$pr_no;
$sql = "select sum(total_amt) as total_amt from purchase_return_details  where  pr_no=".$po_master->pr_no;
$ch = find_all_field_sql($sql);
$return_amt = $ch->total_amt;
$jv_date = $po_master->pr_date;
$invoice_amt = ($return_amt);
if($po_master->vat>0){
$vat=$po_master->vat;
$vat_amt=$invoice_amt*$vat/100;
}
//	if($sale_master->discount>0){
//	$dis=$sale_master->discount;
//	$dis_amt=$invoice_amt*$dis/100;
//	}
$totAmt=$invoice_amt+$vat_amt;
//$config_ledger = find_all_field('config_group_class','sales_ledger',"group_for=".$group_for);
$config_ledger = find_all_field('config_group_class','sales_ledger',"group_for=".$_SESSION['user']['group']);
$vendor_ledger= $vendor->ledger_id;
$cc_code = $po_master->depot_id;
//debit	
$rql='select sum(d.total_amt) as total_amt,s.item_ledger from purchase_return_details d,item_info i,item_sub_group s where d.item_id=i.item_id and i.sub_group_id=s.sub_group_id and d.pr_no='.$pr_no.' group by s.sub_group_id';
$rquery=mysql_query($rql);
while($rdata=mysql_fetch_object($rquery)){
if($invoice_amt>0)
add_to_sec_journal($proj_id, $jv_no, $jv_date, $rdata->item_ledger, $narration, '0',$rdata->total_amt,  $tr_from, $tr_no,'',$tr_id,$cc_code,$group_for); 
}
if($po_master->vat>0){
add_to_sec_journal($proj_id, $jv_no, $jv_date, $config_ledger->purchase_vat, $narration, '0',($vat_amt), $tr_from, $tr_no,'',$tr_id,$cc_code,$group_for);
}
if($invoice_amt>0)
add_to_sec_journal($proj_id, $jv_no, $jv_date, $vendor_ledger, $narration, ($totAmt) ,'0', $tr_from, $tr_no,'',$tr_id,$cc_code,$group_for);
$sa_config = find_a_field('voucher_config','secondary_approval','voucher_type="'.$tr_from.'"');
$time_now = date('Y-m-d H:i:s');
if($sa_config=="Yes"){
$sa_up='update secondary_journal set secondary_approval="Yes", om_checked_at="'.$time_now.'", om_checked="'.$_SESSION['user']['id'].'" where jv_no="'.$jv_no.'" and tr_from="'.$tr_from.'"';
mysql_query($sa_up);
$jv_config = find_a_field('voucher_config','direct_journal','voucher_type="'.$tr_from.'"');
if($jv_config=="Yes"){
sec_journal_journal($jv_no,$jv_no,$tr_from);
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
}
function auto_insert_purchase_secoundary_journal_gm($pr_no)
{
$proj_id = 'clouderp'; 
$po_no =    find_a_field('purchase_receive','po_no','pr_no='.$pr_no);
$group_for =  $_SESSION['user']['group'];
$po_master = find_all_field('purchase_master','','po_no='.$po_no);
$vendor = find_all_field('vendor','',"vendor_id=".$po_master->vendor_id);
$sql = "select sum(amount) as amount, rec_date, transport_charge, other_charge from purchase_receive  where  pr_no=".$pr_no;
$pr = find_all_field_sql($sql);
$tr_id = $po_no;
$tr_no = $pr_no;
$jv_date = $pr->rec_date;
$tr_from = 'Purchase';
$jv_no=next_journal_sec_voucher_id('','Purchase',$_SESSION['user']['group']);
$narration = 'PR#'.$pr_no.' (PO#'.$po_no.')';
$pr_amount = $pr->amount;
$vat_on_purchase = ($pr_amount*$po_master->tax)/100;
//$jv_date = strtotime($do->chalan_date);
$invoice_amt = ($pr_amount + $vat_on_purchase + $pr->transport_charge + $pr->other_charge);
$config_ledger = find_all_field('config_group_class','',"group_for=".$_SESSION['user']['group']);
$vendor_ledger= $vendor->ledger_id;
$cc_code = 0;
//debit	 
if($pr_amount>0)
add_to_sec_journal($proj_id, $jv_no, $jv_date, $config_ledger->purchase_ledger, $narration, ($pr_amount), '0', $tr_from, $tr_no,'',$tr_id,$cc_code,$group_for);
if($vat_on_purchase>0)
add_to_sec_journal($proj_id, $jv_no, $jv_date, $config_ledger->purchase_vat, $narration, ($vat_on_purchase), '0', $tr_from, $tr_no,'',$tr_id,$cc_code,$group_for);
if($pr->transport_charge>0)
add_to_sec_journal($proj_id, $jv_no, $jv_date, $config_ledger->po_transport_charge, $narration, ($pr->transport_charge), '0', $tr_from, $tr_no,'',$tr_id,$cc_code,$group_for);
if($pr->other_charge>0)
add_to_sec_journal($proj_id, $jv_no, $jv_date, $config_ledger->po_other_charge, $narration, ($pr->other_charge), '0', $tr_from, $tr_no,'',$tr_id,$cc_code,$group_for);
//credit
if($invoice_amt>0)
add_to_sec_journal($proj_id, $jv_no, $jv_date, $vendor_ledger, $narration, '0', ($invoice_amt), $tr_from, $tr_no,'',$tr_id,$cc_code,$group_for);
$sa_config = find_a_field('voucher_config','secondary_approval','voucher_type="'.$tr_from.'"');
$time_now = date('Y-m-d H:i:s');
if($sa_config=="Yes"){
$sa_up='update secondary_journal set secondary_approval="Yes", om_checked_at="'.$time_now.'", om_checked="'.$_SESSION['user']['id'].'" where jv_no="'.$jv_no.'" and tr_from="'.$tr_from.'"';
mysql_query($sa_up);
$jv_config = find_a_field('voucher_config','direct_journal','voucher_type="'.$tr_from.'"');
if($jv_config=="Yes"){
sec_journal_journal($jv_no,$jv_no,$tr_from);
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

}



function journal_asset_item_control($item_id ,$warehouse_id,$ji_date,$item_in,$item_ex,$tr_from,$tr_no,$rate='',$r_warehouse='',$sr_no='',$c_price='',$lot_no='',$vendor_id='',$sl_no)
{
	$pre_stock=find_all_field('journal_item','final_stock','warehouse_id = "'.$warehouse_id.'" and item_id = "'.$item_id .'" and lot_no = "'.$lot_no .'" order by id desc');
	$final_stock=($pre_stock->final_stock+$item_in)-$item_ex;
	
	if(($tr_from == 'Purchase')||($tr_from == 'Other Receive')||($tr_from == 'Local Purchase')||($tr_from == 'Sample Receive'))
	{
$item_price = $rate;
$final_price = ((($pre_stock->final_price*$pre_stock->final_stock)+($item_price*$item_in))/($pre_stock->final_stock+$item_in));
	}
	else
	{
$item_price = find_a_field('item_info','cost_price','item_id='.$item_id);
$final_price = $item_price;
if($rate!=''){$item_price = $final_price = $rate;}
	}
     $sql="INSERT INTO `journal_asset_item` 
	(`ji_date`, `item_id`, `warehouse_id`, `pre_stock`, `pre_price`, `item_in`, `item_ex`, `item_price`, `final_stock`, `final_price`,`tr_from`, `tr_no`, `entry_by`, `entry_at`,relevant_warehouse,sr_no,c_price,lot_no,serial_no) 
	VALUES 
	('".$ji_date."', '".$item_id."', '".$warehouse_id."', '".$pre_stock->final_stock."', '".$item_price."', '".$item_in."', '".$item_ex."', '".$item_price."', '".$final_stock."', '".$final_price."', '".$tr_from."', '".$tr_no."', '".$_SESSION['user']['id']."', '".date('Y-m-d H:i:s')."', '".$r_warehouse."', '".$sr_no."', '".$c_price."', '".$lot_no."','".$sl_no."')";
	mysql_query($sql);
}






 ?>