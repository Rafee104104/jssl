<?php
require_once "../../../assets/template/layout.top.php";

// ::::: Edit This Section ::::: 
$title='Demotion  Management';			// Page Name and Page Title
$page="demotion.php";		// PHP File Name
$input_page="demotion_input.php";
$root='hrm';

$table='demotion_detail';		// Database Table Name Mainly related to this page
$unique='DEMOTION_D_ID';			// Primary Key of this Database table
$shown='DEMOTION_REASON';				// For a New or Edit Data a must have data field

// ::::: End Edit Section :::::


$crud      =new crud($table);

$$unique = $_GET[$unique];
do_datatable('grp');

?>
<script type="text/javascript"> function DoNav(lk){
	return GB_show('ggg', '../../hrm_mod/pages/<?=$root?>/<?=$input_page?>?<?=$unique?>='+lk,600,940)
	}</script>








    <form  action="" method="post" enctype="multipart/form-data">
        <? include('../../common/title_bar.php');?>
        <? include('../../common/report_bar.php');?>
        <div class="container-fluid pt-5 p-0 ">
				
				
				 <? 	$res='select '.$unique.','.$unique.','.$shown.' from '.$table.' where PBI_ID='.$_SESSION['employee_selected'];
											echo link_report1($res,$link);?>
            

        </div>

    </form>



<?
require_once "../../../assets/template/layout.bottom.php";
?>