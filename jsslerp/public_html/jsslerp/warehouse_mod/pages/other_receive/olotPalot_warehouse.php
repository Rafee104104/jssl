<?php
session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";

$title = 'Olot Palot';

create_combobox('do_no');
do_calander('#invoice_date');
do_calander('#fdate');
do_calander('#tdate');

$data_found = $_POST['account_code'];

if ($data_found == 0) {
    create_combobox('account_code');
}

if (prevent_multi_submit()) {
    if (isset($_REQUEST['confirmit'])) { }
} else {
    $type = 0;
    $msg = 'Data Re-Submit Warning!';
}
?>
<style>
div.form-container_large input {
    width: 200px;
    height: 38px;
    border-radius: 0px !important;
}
.alert {
    margin: 0;
    padding: 4px 10px;
    border-radius: 4px;
}
</style>

<form action="" method="post" name="codz" id="codz">
<?php if ($data_found == 0) { ?>
<div class="container-fluid bg-form-titel">
    <div class="row">
        <div class="col-md-4">
            <label>Date:</label>
            <input type="text" name="fdate" id="fdate" value="<?= $_POST['fdate'] ?>" />
        </div>

        <div class="col-md-4">
            <label>Palot NO:</label>
            <select class="form-control" name="palot_no" id="palot_no">
                <?php for ($i = 0; $i <= 4; $i++) { ?>
                    <option value="<?= $i ?>" <?= $_POST['palot_no'] == $i ? 'selected' : '' ?>><?= $i + 1 ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="col-md-4">
            <label>SR NO:</label>
            <?php $current_year = date('Y'); ?>
            <input type="text" name="bag_mark" list="bag" id="bag_mark" value="<?= $_POST['bag_mark'] ?>" />
            <datalist id="bag">
                <option value="">All</option>
                <?php foreign_relation('warehouse_other_receive', 'bag_mark', 'bag_mark', $_POST['bag_mark'], '1 and rec_year="' . $current_year . '"'); ?>
            </datalist>
        </div>
    </div>

    <div class="row">
        <div class="col-md-7">
            <input type="submit" value="Show" class="form-control" style="width:80px; float:right; margin-top:5px" />
        </div>
    </div>
</div>
</form>
<?php } ?>

<div class="container-fluid pt-5 p-0" id="assign_warehouse">
<table class="table1 table-striped table-bordered table-hover table-sm">
<thead class="thead1">
<tr class="bgc-info">
    <th>Bag Mark</th>
    <th>Warehouse Name</th>
    <th>Palot No</th>
    <th>Stock Qty</th>
    <th>Qty</th>
    <th>New Warehouse</th>
    <th>Action</th>
</tr>
</thead>
<tbody class="tbody1">
<?php
if ($_POST['fdate'] != '') {
    $con = '';
    if ($_POST['bag_mark'] != "") {
        $con = "AND j.barcode = '" . $_POST['bag_mark'] . "'";
    }

    $sql = "SELECT j.id, w.warehouse_name, j.barcode, w.warehouse_id, SUM(j.item_in - j.item_ex) AS stock, j.bag_size
            FROM warehouse w, journal_item j 
            WHERE w.warehouse_name = j.warehouse_id 
            AND j.item_id = 100010001 and bag_size='".$_POST['palot_no']."'
            $con
            GROUP BY j.barcode, j.warehouse_id 
            HAVING SUM(j.item_in - j.item_ex) > 0";

    $query = mysql_query($sql);

    while ($data = mysql_fetch_object($query)) {
?>
<tr id="row_<?= $data->id ?>">
    <td><strong><?= $data->barcode; ?></strong></td>
    <td><?= $data->warehouse_name; ?></td>
    <td><?= $data->bag_size ?></td>
    <td><strong><?= $data->stock ?></strong></td>

    <td>
        <input name="qty_<?= $data->id ?>" required id="qty_<?= $data->id ?>" type="text" value="" />
        <input type="hidden" id="primary_id_<?= $data->id ?>" value="<?= $data->id ?>" />
    </td>

    <td>
        <input name="warehouse_<?= $data->id ?>" required  id="warehouse_<?= $data->id ?>" type="text" />
        
    </td>

    <td align="center">
        <button type="button" class="btn1 btn1-bg-submit" onclick="moveBarcode('<?= $data->id ?>')">Add</button>
    </td>
</tr>
<?php
    } // end while
} // end if
?>
</tbody>
</table>
</div>

<script>
function moveBarcode(id) {
    const warehouse = document.getElementById('warehouse_' + id).value;
    const primary_id = document.getElementById('primary_id_' + id).value;
    const qty = document.getElementById('qty_' + id).value;
    const palot_no = document.getElementById('palot_no').value;
    const fdate = document.getElementById('fdate').value;
    const bag_mark = document.getElementById('bag_mark').value;

    const dataString = warehouse + '##' + primary_id + '##' + qty + '##' + palot_no + '##' + fdate + '##' + bag_mark;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'olotPalot_warehouse_ajax.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('row_' + id).innerHTML = `<td colspan="7" class="text-center">${xhr.responseText}</td>`;
        }
    };
    xhr.send('data=' + encodeURIComponent(dataString));
}
</script>

<?php
$main_content = ob_get_contents();
ob_end_clean();
include("../../template/main_layout.php");
?>
