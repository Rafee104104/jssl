<?php
session_start();
ob_start();
require_once "../../../assets/support/inc.all.php";
$title = 'TA/DA REPORT';
do_calander("#f_date");
do_calander("#t_date");

?>
<div class="d-flex justify-content-center">
    <form class="n-form1 pt-4" action="master_report.php" method="post" name="form1" target="_blank" id="form1">
        <div class="row m-0 p-0">
            <div class="col-sm-5">
                <div align="left">Select Report </div>
                <div class="form-check">
                    <input name="report" type="radio" class="radio1" id="report1-btn" value="404" checked="checked" tabindex="1">
                    <label class="form-check-label p-0" for="report1-btn">
                        Single Report
                    </label>
                </div>
                <? if ($_SESSION['user']['id'] == 10001) { ?>
                    <div class="form-check">
                        <input name="report" type="radio" class="radio1" id="report1-btn" value="505" tabindex="1">
                        <label class="form-check-label p-0" for="report1-btn">
                            Full Report
                        </label>
                    </div> <? } ?>


            </div>

            <div class="col-sm-7">
                <div class="form-group row m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">Employee Name:</label>
                    <div class="col-sm-8 p-0">
                        <select name="PBI_ID" id="PBI_ID">

                            <?
                            if ($_SESSION['user']['id'] == 10001) {
                                foreign_relation('user_activity_management', 'user_id', 'username', $_POST['user_id'], '1');
                            } else {
                                foreign_relation('user_activity_management', 'user_id', 'username', $_POST['user_id'], 'user_id="' . $_SESSION['user']['id'] . '"');
                            }
                            ?>

                        </select>
                    </div>
                </div>

                <div class="form-group row m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">Start Date:</label>
                    <div class="col-sm-8 p-0">
                        <input name="f_date" type="text" id="f_date" value="<?= date('Y-m-01') ?>" />
                    </div>
                </div>


                <div class="form-group row m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-4 m-0 p-0 d-flex align-items-center">End Date:</label>
                    <div class="col-sm-8 p-0">
                        <span class="oe_form_group_cell">
                            <input name="t_date" type="text" id="t_date" value="<?= date('Y-m-d') ?>" />
                        </span>

                    </div>
                </div>





            </div>

        </div>
        <div class="n-form-btn-class">
            <input name="submit" type="submit" class="btn1 btn1-bg-submit" value="Report" tabindex="6">
        </div>
    </form>
</div>

<br /><br />
<?


$main_content = ob_get_contents();


ob_end_clean();


include("../../template/main_layout.php");


?>