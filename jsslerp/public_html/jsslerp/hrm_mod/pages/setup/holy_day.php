<?php
require_once "../../../assets/template/layout.top.php";

// ::::: Edit This Section ::::: 
		  $title='Holiday Information';			// Page Name and Page Title
$page="holy_day.php";		// PHP File Name
$input_page="holy_day_input.php";
$root='setup';

$table='salary_holy_day';		// Database Table Name Mainly related to this page
$unique='id';			// Primary Key of this Database table
$shown='holy_day';				// For a New or Edit Data a must have data field

// ::::: End Edit Section :::::


$crud      =new crud($table);

$$unique = $_GET[$unique];
do_datatable('grp');
?>
<script type="text/javascript"> function DoNav(lk){
	return GB_show(' ', '../../hrm_mod/pages/<?=$root?>/<?=$input_page?>?<?=$unique?>='+lk,600,940)
	}</script>


  <form  action="" method="post" enctype="multipart/form-data">
      	 <? include('../../common/title_bar.php');?>
        <? include('../../common/report_bar.php');?>
        <div class="container-fluid pt-5 p-0 ">
		
		
		 <?  $res='select h.'.$unique.', h.holy_day,h.reason as event_name,j.job_location_name from '.$table.' h,  job_location_type j where  j.id=h.job_loc_id order by holy_day asc';
											echo link_report1($res,$link);?>
				
           

        </div>

  </form>



<?php /*?><form action="" method="post">
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
          <? 	 $res='select '.$unique.', holy_day,reason from '.$table.' order by holy_day desc';
											echo $crud->link_report($res,$link);?>
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