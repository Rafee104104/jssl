<?php
require_once "../../../assets/template/layout.top.php";

// ::::: Edit This Section ::::: 
$title='Daily Progress Entry';			// Page Name and Page Title
$page="daily_task.php";		// PHP File Name
$input_page="daily_task_input.php";
$root='attendence';

$table='daily_progress';		// Database Table Name Mainly related to this page
$unique='id';			// Primary Key of this Database table
$shown='task';				// For a New or Edit Data a must have data field

do_datatable('grp');
// ::::: End Edit Section :::::


$crud      =new crud($table);

$$unique = $_GET[$unique];

?>
<script type="text/javascript"> function DoNav(lk){
	return GB_show('ggg', '../../user_mod/pages/<?=$root?>/<?=$input_page?>?<?=$unique?>='+lk,600,940)
	}</script>







<form  action="" method="post" enctype="multipart/form-data">
        <? include('../../common/title_bar.php');?>
        <? include('../../common/report_bar.php');?>
        <div class="container-fluid pt-5 p-0 ">

           <? $res='select p.id,proj.PROJECT_NAME,m.module_name,f.feature_name,p.task,p.request_by,p.request_date,p.status from daily_progress p left join user_module_manage m on m.id=p.module_id left join user_feature_manage f on f.id=p.feature_id left join project proj on proj.PROJECT_ID=p.project where p.entry_by="'.$_SESSION['employee_selected'].'"';
			echo link_report1($res,$link);?>

        </div>

    </form>


<?php /*?><form action="" method="post" enctype="multipart/form-data">
<div class="oe_view_manager oe_view_manager_current">
        
    <? include('../../common/title_bar.php');?>
        <div class="oe_view_manager_body">
            
                <div  class="oe_view_manager_view_list"></div>
            
                <div class="oe_view_manager_view_form"><div style="opacity: 1;" class="oe_formview oe_view oe_form_editable">
        <div class="oe_form_buttons"></div>
        <div class="oe_form_sidebar"></div>
        <div class="oe_form_pager"></div>
        <div class="oe_form_container"><div class="oe_form">
          <div class="">
    <? include('../../common/report_bar.php');?>
<div class="oe_form_sheetbg">
        <div class="oe_form_sheet oe_form_sheet_width">

          <div  class="oe_view_manager_view_list"><div  class="oe_list oe_view">
          <? $res='select p.id,proj.PROJECT_NAME,m.module_name,f.feature_name,p.task,p.request_by,p.request_date,p.status from daily_progress p left join user_module_manage m on m.id=p.module_id left join user_feature_manage f on f.id=p.feature_id left join project proj on proj.PROJECT_ID=p.project where p.entry_by="'.$_SESSION['employee_selected'].'"';
			echo link_report1($res,$link);?>
          </div></div>
          </div>
    </div>
    <div class="oe_chatter"><div class="oe_followers oe_form_invisible">
      <div class="oe_follower_list"></div>
    </div></div></div></div></div>
    </div></div>
            
        </div>
    </div>
</form><?php */?>
<?
require_once "../../../assets/template/layout.bottom.php";
?>