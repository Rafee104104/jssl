<?php
require_once "../../../assets/template/layout.top.php";

// ::::: Edit This Section ::::: 
$title='Promotion Management';			// Page Name and Page Title
$page="promotion.php";		// PHP File Name
$input_page="promotion_input.php";
$root='hrm';

$table='promotion_detail';		// Database Table Name Mainly related to this page
$unique='PROMOTION_D_ID';			// Primary Key of this Database table
$shown='PROMOTION_TYPE';				// For a New or Edit Data a must have data field

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



			<? 	
 $res='select '.$unique.',PROMOTION_D_ID as id, PROMOTION_DATE as Date, PROMOTION_TYPE as Promotion_Type, 
(select DESG_DESC from designation where DESG_ID=PROMOTION_PAST_DESG) as Past_Desg, 
(select DESG_DESC from designation where DESG_ID=PROMOTION_PRESENT_DESG) as Present_Desg, report_to 
from '.$table.' 
where PBI_ID='.$_SESSION['employee_selected'].'
order by PROMOTION_D_ID desc
';

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
<? 	
 $res='select '.$unique.',PROMOTION_D_ID as id, PROMOTION_DATE as Date, PROMOTION_TYPE as Promotion_Type, 
(select DESG_DESC from designation where DESG_ID=PROMOTION_PAST_DESG) as Past_Desg, 
(select DESG_DESC from designation where DESG_ID=PROMOTION_PRESENT_DESG) as Present_Desg, report_to 
from '.$table.' 
where PBI_ID='.$_SESSION['employee_selected'].'
order by PROMOTION_D_ID desc
';

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