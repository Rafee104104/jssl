<?php
session_start();
require_once "../../../assets/template/layout.top.php";

@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 'Off');

$data = explode('##', $_POST['data']);

$warehouse = $data[0];
$id = $data[1];
$qty = $data[2];
$palot = $data[3] + 1;
$fdate = $data[4];
$bagMark = $data[5];
$page_for = 'Olot Palot';

$orAll = find_all_field('journal_item', '*', 'id=' . $id);

if ($warehouse && $qty > 0) {
    // Move logic (insert into journal or inventory control)
    journal_item_control($orAll->item_id, $warehouse, $fdate, $qty, 0, $page_for, $orAll->id, $orAll->rate, $orAll->warehouse_id, $id, $palot, '', '', '', $orAll->barcode);
    journal_item_control($orAll->item_id, $orAll->warehouse_id, $fdate, 0, $qty, $page_for, $orAll->id, $orAll->rate, '', $id, $data[3], '', '', '', $orAll->barcode);

    echo '<div class="alert alert-success">? Barcode <strong>' . $orAll->barcode . '</strong> moved successfully!</div>';
} else {
    echo '<div class="alert alert-danger">?? Please select a valid warehouse and quantity.</div>';
}
?>
