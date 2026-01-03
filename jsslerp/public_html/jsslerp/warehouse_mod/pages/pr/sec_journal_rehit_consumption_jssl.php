<?
session_start();
require_once "../../../assets/support/inc.all.php";
$page_for = 'Consumption';
//
// echo   $ch_sql='select * from warehouse_other_issue where issue_type="Consumption" and oi_no=3';
 
 echo   $ch_sql='select * from warehouse_other_issue where issue_type="Consumption" and oi_date between "2025-09-02" and "2025-11-18" and status="CHECKED" ';
 
$ch_query=mysql_query($ch_sql);
while($data=mysql_fetch_object($ch_query)){
	 
	$proj_id = 'clouderp'; 
	$sec_journal_all=find_all_field('secondary_journal','*','tr_no="'.$data->oi_no.'" and tr_from="Consumption"');
	///////delete secjournal//////////
	echo $del_sql_sec='delete from secondary_journal where tr_no="'.$data->oi_no.'" and tr_from="Consumption" ';
	mysql_query($del_sql_sec);
		///////delete journal//////////
	echo $del_sql_jour='delete from journal where tr_no="'.$data->oi_no.'" and tr_from="Consumption" ';
	mysql_query($del_sql_jour);

	/////////cogs_amount////////
	
	
	$details_sql = 'select sum(d.amount) as total_amt, i.item_id, s.item_ledger, s.cogs_ledger, d.oi_no 
                from warehouse_other_issue_detail d, item_info i, item_sub_group s 
                where s.sub_group_id = i.sub_group_id 
                and d.item_id = i.item_id 
                and d.issue_type = "Consumption" 
                and d.oi_no = "' . $data->oi_no . '" 
                group by s.item_ledger';
$details_query = mysql_query($details_sql);

$tot_cogs_amt = 0;
$cogs_amt = 0;
$jv_date = $data->oi_date;
$jv_no=next_journal_sec_voucher_id('',$page_for);

$cc_code = find_a_field_sql("select w.cc_code from warehouse w where w.warehouse_id=" . $_SESSION['user']['depot']);

while ($det_row = mysql_fetch_object($details_query)) {
   $item_sql = 'SELECT i.item_id, s.item_ledger, s.cogs_ledger, i.item_name, d.rate, d.qty
             FROM warehouse_other_issue_detail d
             JOIN item_info i ON d.item_id = i.item_id
             JOIN item_sub_group s ON s.sub_group_id = i.sub_group_id
             WHERE d.issue_type = "Consumption"
             AND d.oi_no = "' . $data->oi_no . '"
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
}

// Construct the narration with items, rates, and quantities
$narration_parts = [];
for ($i = 0; $i < count($item_names); $i++) {
    $narration_parts[] = $item_names[$i] . " (Rate: " . $rates[$i] . ", Qty: " . $qtys[$i] . ")";
}

$narration = implode(',<br>', $narration_parts);



    
    echo $cogs_amt = $det_row->total_amt;
    $tot_cogs_amt += $cogs_amt;

    add_to_sec_journal($proj_id, $sec_journal_all->jv_no, $sec_journal_all->jv_date, $det_row->item_ledger, $narration, '0', $cogs_amt, 'Consumption', $data->oi_no, '', $data->oi_no, $cc_code);
    add_to_sec_journal($proj_id, $sec_journal_all->jv_no, $sec_journal_all->jv_date, $det_row->cogs_ledger, $narration, $cogs_amt, '0', 'Consumption', $data->oi_no, '', $data->oi_no, $cc_code);
}


 
	
		
		
		
	
	
	sec_journal_journal($sec_journal_all->jv_no,$sec_journal_all->jv_no,'Consumption');
}

 

 
?>