<script src="alert.js"></script>
<?php
session_start();
ob_start();
require_once "../../../assets/support/inc.all.php";
$title = 'TA/DA Entry ';
do_calander('#date');

$crud = new crud('tada');
if (isset($_POST['submit'])) {

    $cDate = date('Y-m-d');
    $pDate = date("Y-m-d", time() - 86400);
    if ($_POST['date'] == $cDate || $_POST['date'] == $pDate) {

        $_POST['user_id'] = $_SESSION['user']['id'];
        $_POST['entry_at'] = date('Y-m-d H:i:s');
        $crud->insert();
        echo "<script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Your TA/DA Submitted',
            showConfirmButton: false,
            timer: 1500
        })
    </script>";
    } else {
        echo "<script>Swal.fire({
            icon: 'error',
            title: 'Date Expired',
            text: 'Something went wrong!',
            showConfirmButton: false
          })</script>";
    }
}

?>

<form method="post" autocomplete="off">

    <div class="row">
        <div class="col-md-3 col-sm-12">
            <label for="project_id" class="form-label">Project</label>
            <select type="email" class="form-control" id="project_id" name="project_id" required>
                <option value=""></option>
                <? foreign_relation('project', 'PROJECT_ID', 'PROJECT_NAME', $project, ' 1'); ?>
            </select>
        </div>
        <div class="col-md-3 col-sm-12">
            <label for="date" class="form-label">Date</label>
            <input type="text" class="form-control" id="date" name="date" required>
        </div>
        <div class="col-md-3 col-sm-12">
            <label for="note" class="form-label">Note</label>
            <input type="text" class="form-control" id="note" name="note">
        </div>
        <div class="col-md-3 col-sm-12">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" class="form-control" id="amount" name="amount" required>
        </div>

        <div class="col-md-2 col-sm-12">
            <label for="amount" class="form-label"></label>
            <button type="submit" class="form-control btn btn-success btn-sm" id="submit" name="submit">Submit</button>
        </div>
    </div>



</form>


<?

$main_content = ob_get_contents();

ob_end_clean();

include("../../template/main_layout.php");

?>