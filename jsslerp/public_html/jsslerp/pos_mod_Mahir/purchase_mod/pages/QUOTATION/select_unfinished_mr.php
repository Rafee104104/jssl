<?php
require_once "../../../assets/template/layout.top.php";
$title='Unfinished Purchase Quotation';
$tr_type="Show";
$table = 'quotation_master';
$unique = 'quotation_no';
$status = 'MANUAL';
$target_url = '../quotation/mr_create.php';

if($_POST[$unique]>0)
{
$_SESSION[$unique] = $_POST[$unique];
header('location:'.$target_url);
}
$tr_from="Purchase";
?>





<div class="form-container_large">
    
    <form action="" method="post" name="codz" id="codz">
            
        <div class="container-fluid bg-form-titel">
            <div class="row">
                
                <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
                    <div class="form-group row m-0">
                        <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"><?=$title?>:</label>
                        <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0">
                            <select name="<?=$unique?>" id="<?=$unique?>">
       							 <? foreign_relation($table,$unique,$unique,$$unique,'1 and status="'.$status.'"');?>
     						 </select>

                        </div>
                    </div>
                </div>

                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    
                    <input type="submit" name="submitit" id="submitit" value="VIEW DETAIL" class="btn1 btn1-submit-input"/ >
                </div>

            </div>
        </div>

        
    </form>
</div>





<?
require_once "../../../assets/template/layout.bottom.php";
?>