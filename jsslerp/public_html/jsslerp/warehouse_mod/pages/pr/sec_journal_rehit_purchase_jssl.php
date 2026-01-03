<?
session_start();
require_once "../../../assets/support/inc.all.php";
$page_for = 'Purchase';
//
// echo   $ch_sql='select * from purchase_receive where pr_no=25012400001';
 
 echo   $ch_sql='select * from purchase_receive where pr_no in (25070100002,24102400002) ';
 
$ch_query=mysql_query($ch_sql);
while($data=mysql_fetch_object($ch_query)){
	 
	$proj_id = 'clouderp'; 
	$sec_journal_all=find_all_field('secondary_journal','*','tr_no="'.$data->pr_no.'" and tr_from="Purchase"');
	///////delete secjournal//////////
	echo $del_sql_sec='delete from secondary_journal where tr_no="'.$data->pr_no.'" and tr_from="Purchase" ';
	mysql_query($del_sql_sec);
		///////delete journal//////////
	echo $del_sql_jour='delete from journal where tr_no="'.$data->pr_no.'" and tr_from="Purchase" ';
	mysql_query($del_sql_jour);

	/////////cogs_amount////////
	
	$vendor_ledger=find_a_field('vendor','ledger_id','vendor_id="'.$data->vendor_id.'"');
	$transport_charge=find_a_field('config_group_class','po_transport_charge','1');
	
	
	$details_sql = 'select sum(d.amount) as total_amt, i.item_id, s.item_ledger, s.cogs_ledger, d.po_no,d.pr_no,d.transport_charge 
                from purchase_receive d, item_info i, item_sub_group s 
                where s.sub_group_id = i.sub_group_id 
                and d.item_id = i.item_id  
                and d.pr_no = "' . $data->pr_no . '" 
                group by s.item_ledger';
$details_query = mysql_query($details_sql);

$tot_cogs_amt = 0;
$cogs_amt = 0;
$jv_date = $data->rec_date;
$jv_no=next_journal_sec_voucher_id('',$page_for);

$cc_code = find_a_field_sql("select w.cc_code from warehouse w where w.warehouse_id=" . $_SESSION['user']['depot']);

while ($det_row = mysql_fetch_object($details_query)) {
   $item_sql = 'SELECT i.item_id, s.item_ledger, s.cogs_ledger, i.item_name, d.rate, d.qty,d.po_no,d.pr_no,d.transport_charge
             FROM purchase_receive d
             JOIN item_info i ON d.item_id = i.item_id
             JOIN item_sub_group s ON s.sub_group_id = i.sub_group_id
             WHERE  d.pr_no = "' . $data->pr_no . '"
             AND s.item_ledger = "' . $det_row->item_ledger . '"
             GROUP BY i.item_id';
$item_query = mysql_query($item_sql);

$item_names = [];
$rates = [];
$qtys = [];

while ($row = mysql_fetch_object($item_query)) {
    $item_names[] = $row->item_name;
    $rates[] = $row->rate;
    $qtys[] = $row->qty;
	$transport[] = $row->transport_charge;
}

// Construct the narration with items, rates, and quantities
$narration_parts = [];
for ($i = 0; $i < count($item_names); $i++) {
    $narration_parts[] = $item_names[$i] . " (Rate: " . $rates[$i] . ", Qty: " . $qtys[$i] . ")";
}

if($data->transport_charge>0)
{

$narration = 'Purchase, PO# ' . $data->po_no . ' PR# ' . $data->pr_no . '<br>' .'Transport Charge-'.$data->transport_charge;
}
else
{

$narration = 'Purchase, PO# ' . $data->po_no . ' PR# ' . $data->pr_no . '<br>' . implode(',<br>', $narration_parts);

}


    
    echo $cogs_amt = $det_row->total_amt;
    $tot_cogs_amt += $cogs_amt;
	$sub_total=$tot_cogs_amt+$data->transport_charge;

    add_to_sec_journal($proj_id, $sec_journal_all->jv_no, $sec_journal_all->jv_date, $det_row->item_ledger, $narration,  $cogs_amt,'0', 'Purchase', $data->pr_no, '', $data->pr_no, $cc_code);
	
	
}

if($data->transport_charge>0)
	{
	
	add_to_sec_journal($proj_id, $sec_journal_all->jv_no, $sec_journal_all->jv_date, $transport_charge, $narration,  $data->transport_charge,'0', 'Purchase', $data->pr_no, '', $data->pr_no, $cc_code);
    
	}

 add_to_sec_journal($proj_id, $sec_journal_all->jv_no, $sec_journal_all->jv_date, $vendor_ledger, $narration, '0',$tot_cogs_amt,  'Purchase', $data->pr_no, '', $data->pr_no, $cc_code);
	
		
		
		
	
	
	//sec_journal_journal($sec_journal_all->jv_no,$sec_journal_all->jv_no,'Sample Issue');
}

 

 
?>