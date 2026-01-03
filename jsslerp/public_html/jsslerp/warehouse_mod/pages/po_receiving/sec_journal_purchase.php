<?php
session_start();
require_once "../../../assets/support/inc.all.php";
$page_for = 'Purchase';

$pr_no = $_GET['pr_no'];
$rec = find_a_field('purchase_receive', 'po_no', 'pr_no=' . $pr_no);
$master = find_all_field('purchase_master', '', 'po_no=' . $rec);

$ch_sql = 'SELECT * FROM purchase_receive WHERE pr_no="' . $pr_no . '"';
$ch_query = mysql_query($ch_sql);

$processed_prs = []; // Track processed PR numbers

while ($data = mysql_fetch_object($ch_query)) {
    if (in_array($data->pr_no, $processed_prs)) {
        continue; // Skip duplicate PR entries
    }
    $processed_prs[] = $data->pr_no; // Mark PR as processed

    $proj_id = 'clouderp';
    $vendor_ledger = find_a_field('vendor', 'ledger_id', 'vendor_id="' . $data->vendor_id . '"');
    $config = find_all_field('config_group_class', '*', '1');

    $details_sql = 'SELECT SUM(d.amount) AS total_amt,sum(d.real_amt) as real_amount, i.item_id, s.item_ledger, s.cogs_ledger, 
                           d.po_no, d.pr_no, d.transport_charge 
                    FROM purchase_receive d
                    JOIN item_info i ON d.item_id = i.item_id
                    JOIN item_sub_group s ON s.sub_group_id = i.sub_group_id
                    WHERE d.pr_no = "' . $pr_no . '" 
                    GROUP BY s.item_ledger';

    $details_query = mysql_query($details_sql);

    $tot_cogs_amt = 0; // Reset for each PR
    $jv_date = $data->rec_date;
    $jv_no = next_journal_sec_voucher_id('', $page_for);

    $cc_code = find_a_field_sql("SELECT w.cc_code FROM warehouse w WHERE w.warehouse_id=" . $_SESSION['user']['depot']);

    while ($det_row = mysql_fetch_object($details_query)) {
        $item_sql = 'SELECT i.item_id, s.item_ledger, s.cogs_ledger, i.item_name, d.rate, d.qty, 
                            d.po_no, d.pr_no, d.transport_charge
                     FROM purchase_receive d
                     JOIN item_info i ON d.item_id = i.item_id
                     JOIN item_sub_group s ON s.sub_group_id = i.sub_group_id
                     WHERE d.pr_no = "' . $pr_no . '"
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

        

        $cogs_amt = $det_row->total_amt;
        $tot_cogs_amt += $cogs_amt;
		
		$vendor_amt=$det_row->real_amount;
		$tot_vendor_amt+=$vendor_amt;
			
	$narration_parts = [];
for ($i = 0; $i < count($item_names); $i++) {
    $narration_parts[] = $item_names[$i] . " (Rate: " . $rates[$i] . ", Qty: " . $qtys[$i] . ")";
}

// Main Purchase Narration (for Item Ledger)
$item_narration = 'Purchase, PO# ' . $data->po_no . ' PR# ' . $data->pr_no . '<br>' . implode(',<br>', $narration_parts);

		

        add_to_sec_journal($proj_id, $jv_no, $jv_date, $det_row->item_ledger, $item_narration, $cogs_amt, '0', 'Purchase', $data->pr_no, '', $data->pr_no, $cc_code);
    }

    // Calculate VAT & Tax only once per PR
    $vat =  $master->vat;
    $tax = $master->tax;
    $sub_total = $tot_cogs_amt-$master->vat-$master->tax;

// Individual Narrations
$transport_narration = 'Transport Charge for PO# ' . $data->po_no . ', PR# ' . $data->pr_no;
$vat_narration = 'VAT for PO# ' . $data->po_no . ', PR# ' . $data->pr_no . ' ' . $master->vat . '';
$tax_narration = 'Tax for PO# ' . $data->po_no . ', PR# ' . $data->pr_no . ' ' . $master->tax . '';
$vendor_narration = 'Vendor Payment for PO# ' . $data->po_no . ', PR# ' . $data->pr_no;


		
		

    // 1. Item Ledger Entry (COGS)
	
	if($det_row->item_ledger>0)
	{
add_to_sec_journal($proj_id, $jv_no, $jv_date, $det_row->item_ledger, $item_narration, $cogs_amt, '0', 'Purchase', $data->pr_no, '', $data->pr_no, $cc_code);

}

// 2. Transport Charge (if applicable)
if ($data->transport_charge > 0) {
    add_to_sec_journal($proj_id, $jv_no, $jv_date, $config->po_transport_charge, $transport_narration, $data->transport_charge, '0', 'Purchase', $data->pr_no, '', $data->pr_no, $cc_code);
}

// 3. VAT Charge (if applicable)
if ($vat > 0) {
    add_to_sec_journal($proj_id, $jv_no, $jv_date, $config->purchase_vat, $vat_narration,'0', $vat,  'Purchase', $data->pr_no, '', $data->pr_no, $cc_code);
}

// 4. Tax Charge (if applicable)
if ($tax > 0) {
    add_to_sec_journal($proj_id, $jv_no, $jv_date, $config->purchase_tax, $tax_narration,'0', $tax,  'Purchase', $data->pr_no, '', $data->pr_no, $cc_code);
}

// 5. Vendor Ledger Entry
add_to_sec_journal($proj_id, $jv_no, $jv_date, $vendor_ledger, $vendor_narration, '0', $sub_total, 'Purchase', $data->pr_no, '', $data->pr_no, $cc_code);

}

// Redirect after processing
header('Location: select_upcoming_po.php');
?>
