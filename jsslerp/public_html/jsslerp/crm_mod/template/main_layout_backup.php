<? 
session_start();
@include('../../template/user_access_list.php');
?>
<!DOCTYPE html>
<html style="height: 100%;">
<head>
<meta http-equiv = "Content-Type" content = "text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<title>Sajeeb ERP</title>
<script type = "text/javascript">var GB_ROOT_DIR = "../../GBox/";</script>
<script type = "text/javascript" src = "../../GBox/AJS.js"></script>
<script type = "text/javascript" src = "../../GBox/AJS_fx.js"></script>
<script type = "text/javascript" src = "../../GBox/gb_scripts.js"></script>
<link href = "../../GBox/gb_styles.css" rel = "stylesheet" type = "text/css" media = "all"/>
<script type="text/javascript" src="../../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../../js/jquery-ui-1.8.2.custom.min.js"></script>
<script type="text/javascript" src="../../js/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="../../js/jquery.autocomplete.js"></script>
<script type="text/javascript" src="../../js/jquery.validate.js"></script>
<script type="text/javascript" src="../../js/paging.js"></script>
<script type="text/javascript" src="https://mahirgrouperp.com/ddaccordion_new.js"></script>
<script type="text/javascript" src="../../js/js.js"></script>
<script type="text/javascript" src="../../js/pg.js"></script>
<link href="../../css/css.css" type="text/css" rel="stylesheet"/>
<link href="../../css/menu.css" type="text/css" rel="stylesheet"/>
<link href="../../css/jquery-ui-1.8.2.custom.css" rel="stylesheet" type="text/css" />
<link href="../../css/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
<?=$head?>
<script type="text/javascript">

  $(document).ready(function(){
    $("#codz").validate();
  });

</script>
<script type="text/javascript">
$(document).ready(function(){

$(function() {
$("#date_birth").datepicker({
changeMonth: true,
changeYear: true,
dateFormat: "yy-mm-dd"
});

});

});</script>
</head>
<body>
<!--[if lte IE 8]>
        <script src="http://ajax.googleapis.com/ajax/libs/chrome-frame/1/CFInstall.min.js"></script>
        <script>CFInstall.check({mode: "overlay"});</script>
        <![endif]-->
<div class="openerp openerp_webclient_container">
  <table class="oe_webclient">
    <tbody>
      <tr>
        <td class="oe_topbar" colspan="2"><ul style="height: auto;" class="oe_menu">
            <!--            <li style="display: block;"> <a class="oe_menu_toggler" data-action-id="" data-action-model="" data-menu="121" href="#menu_id=121&amp;action="> <span class="oe_menu_text"> Security </span> </a> </li>
            <li style="display: block;"> <a class="oe_menu_toggler" data-action-id="" data-action-model="" data-menu="75" href="#menu_id=75&amp;action="> <span class="oe_menu_text"> Payment Gateway </span> </a> </li>
            <li style="display: block;"> <a class="oe_menu_toggler" data-action-id="" data-action-model="" data-menu="212" href="#menu_id=212&amp;action="> <span class="oe_menu_text"> Accounts </span> </a> </li>
            <li style="display: block;"> <a class="oe_menu_toggler oe_active" data-action-id="" data-action-model="" data-menu="224" href="#menu_id=224&amp;action="> <span class="oe_menu_text"> HR </span> </a> </li>
            <li style="display: block;"> <a class="oe_menu_toggler" data-action-id="" data-action-model="" data-menu="467" href="#menu_id=467&amp;action="> <span class="oe_menu_text"> Payroll </span> </a> </li>
            <li style="display: block;"></li>
            <li style="display: block;"> <a class="oe_menu_toggler" data-action-id="" data-action-model="" data-menu="502" href="#menu_id=502&amp;action="> <span class="oe_menu_text"> Inventory </span> </a> </li>
            <li style="display: block;"> <a class="oe_menu_toggler" data-action-id="" data-action-model="" data-menu="160" href="#menu_id=160&amp;action="> <span class="oe_menu_text"> Purchase </span> </a> </li>
            <li style="display: block;"> <a class="oe_menu_toggler" data-action-id="" data-action-model="" data-menu="98" href="#menu_id=98&amp;action="> <span class="oe_menu_text"> Manufacturing </span> </a> </li>
            <li style="display: block;"> <a class="oe_menu_toggler" data-action-id="" data-action-model="" data-menu="141" href="#menu_id=141&amp;action="> <span class="oe_menu_text"> Medical </span> </a> </li>-->
          </ul>
          <div class="oe_systray">
            <div  original-title="" class="oe_attendance_status oe_attendance_nosigned" data-tipsy="true">
              <div class="oe_attendance_signin"></div>
              <div class="oe_attendance_signout"></div>
            </div>
            <div class="oe_topbar_item oe_topbar_compose_full_email" title="Compose new Message"> Welcome..
<?=find_a_field('user_activity_management','fname','user_id='.$_SESSION['user']['id']);
			
			?><a href="../main/logout.php"><img src="../../img/LogOut.png" height="20" alt="log Out"></a></div>
          </div></td>
      </tr>
      <tr>
        <td style="display: table-cell;" class="oe_leftbar" valign="top"><img src="../../../logo/title.png" width="200px"> 
          <div class="oe_secondary_menus_container">
            <div class="menu_bg">
              <table width="200" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr>
                  <td><div class="smartmenu">

<?php /*?><? if( $_SESSION['user']['level']=='5' || $_SESSION['user']['level']=='2' ){ ?>      <?php */?>                
					  
					  <div class="silverheader"><a href="#" >Staff Information</a></div>
                      <div class="submenu">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><a href="../hrm/employee_basic_information.php">Basic Info</a></td>
                          </tr>
                          <tr>
                            <td><a href="../hrm/employee_essential_information.php">Essential Info</a></td>
                          </tr>
                          <tr>
                            <td><a href="../hrm/edcation.php">Education</a></td>
                          </tr>
                          <tr>
                            <td><a href="../hrm/course_diploma.php">Course/Diploma</a></td>
                          </tr>
                          <tr>
                            <td><a href="../hrm/experience.php">Experience</a></td>
                          </tr>
                          <!--<tr>
                            <td><a href="../hrm/posting_entey.php">Posting</a></td>
                          </tr>-->
                          <tr>
                            <td><a href="../hrm/training.php">Training</a></td>
                          </tr>
                          <tr>
                            <td><a href="../hrm/transfer.php">Transfer</a></td>
                          </tr>
                          <tr>
                            <td><a href="../hrm/promotion.php">Promotion</a></td>
                          </tr>
                          <tr>
                            <td><a href="../hrm/domotion.php">Demotion</a></td>
                          </tr>
                          <tr>
                            <td><a href="../hrm/increment_entry.php">Increment</a></td>
                          </tr>
<!--                          <tr>
                            <td><a href="../hrm/leave.php">Leave</a></td>
                          </tr>-->
                          <tr>
                            <td><a href="../hrm/administration_action.php">Admin Action</a></td>
                          </tr>
                          <tr>
                            <td><a href="../hrm/pf_status.php">PF Check List</a></td>
                          </tr>
                        </table>
                      </div><?php /*?><? } ?><?php */?>
                      <!--<div class="silverheader"><a href="">Attendence Basic Information</a></div>
                      <div class="submenu">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr><td><a href="../attendence/upload_attendance.php">Upload Attendance</a></td></tr>
                          <tr><td><a href="../attendence/manual_attendance.php">Manual Attendance</a></td></tr>
						 
                          <tr><td><a href="../attendence/individual_attendance_report.php">Individual Attendance Report</a></td></tr>
                          <tr><td><a href="../attendence/summary_attendance_report.php">Summary Attendance Report</a></td></tr>
                          <tr><td><a href="../attendence/brief_attendance_report.php">Brief Attendance Report</a></td></tr>
                         <tr><td><a href="../hrm/roster_day_set.php">Set Roster Day</a></td></tr>
                        </table>
                      </div>-->
                      <?php /*?><? if(
						$_SESSION['user']['username']=='faysal' ||
						$_SESSION['user']['username']=='9999' ||
						$_SESSION['user']['username']=='r.sales'
						){ ?><?php */?>
                      <div class="silverheader"><a href="">Upload</a></div>
                      <div class="submenu">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          
                          <tr> <td><a href="../attendence/upload_attendence_store.php">Upload Attendence(Others)</a></td></tr>
                          <tr>  <td><a href="../attendence/upload_mobile_bill_csv.php">Upload Mobile Bill</a></td></tr>
						   <!--<tr>   <td><a href="../attendence/upload_attendence_sales.php">Upload Attendence(Sales)</a></td></tr>-->
                          <tr>  <td><a href="../attendence/edit_mobile_bill.php">Edit Mobile Bill</a></td></tr>
						 <tr> <td><a href="../admin/salary_bonus.php">Bonus Calculation</a></td></tr>
                        </table>
                      </div><?php /*?><? } ?>
                     
					  <? if( $_SESSION['user']['level']=='5' || $_SESSION['user']['level']=='2' ){ ?><?php */?>
					  <div class="silverheader"><a href="">Attendance Final Process</a></div>
                      <div class="submenu">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><a href="../attendence/monthly_attendence.php">Monthly Attendance</a></td>
                          </tr>
                        </table>
                      </div><?php /*?><? } ?>



<? if( $_SESSION['user']['level']=='5' || $_SESSION['user']['level']=='55' ){ ?><?php */?>					  
<div class="silverheader"><a href="">Portal RSM</a></div>
<div class="submenu">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td><a href="../attendence/monthly_attendence_rsm.php">Monthly Attendance</a></td></tr>
<tr><td><a href="../attendence/monthly_attendence_rsm1.php">RSM Attendance</a></td></tr>
<tr><td><a href="../report/advance_report_rsm.php">Salary Reports</a></td></tr>
</table>
</div>
<?php /*?><? } ?>

<? if( $_SESSION['user']['level']=='5' || $_SESSION['user']['level']=='56' ){ ?><?php */?>					  
<div class="silverheader"><a href="">Portal Store</a></div>
<div class="submenu">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td><a href="../attendence/monthly_attendence_store.php">Monthly Attendance</a></td></tr>
<tr><td><a href="../report/advance_report_store.php">Salary Reports</a></td></tr>
</table>
</div>
<?php /*?><? } ?>


<? if( $_SESSION['user']['level']=='5' || $_SESSION['user']['level']=='57' ){ ?><?php */?>					  
<div class="silverheader"><a href="">Portal Mkt Audit</a></div>
<div class="submenu">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td><a href="../attendence/monthly_attendence_ma.php">Monthly Attendance</a></td></tr>
</table>
</div>
<?php /*?><? } ?>

<? if( $_SESSION['user']['level']=='5' || $_SESSION['user']['level']=='58' ){ ?><?php */?>					  
<div class="silverheader"><a href="">Portal Modern Trade</a></div>
<div class="submenu">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td><a href="../attendence/monthly_attendence_mt.php">Monthly Attendance</a></td></tr>
</table>
</div>
<?php /*?><? } ?>	

<? if( $_SESSION['user']['level']=='5' || $_SESSION['user']['level']=='59' ){ ?><?php */?>					  
<div class="silverheader"><a href="">Portal Sales Manager</a></div>
<div class="submenu">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td><a href="../attendence/monthly_attendence_sales.php">Monthly Attendance</a></td></tr>
<tr><td><a href="../attendence/monthly_attendence_sales_rsm.php">RSM</a></td></tr>
<tr><td><a href="../report/advance_report_sales.php">Salary Reports</a></td></tr>
</table>
</div>
<?php /*?><? } ?>



				  
					  <? if( $_SESSION['user']['level']=='5' || $_SESSION['user']['level']=='2' ){ ?><?php */?>
                      <div class="silverheader"><a href="#" >Payroll Basic Information</a></div>
                      <div class="submenu">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><a href="../payroll/salary_information.php">Basic Salary & Allowance</a></td>
                          </tr>
                          <tr>
                            <td><a href="../payroll/advance_payment.php">Advance Salary</a></td>
                          </tr>
                          <tr>
                            <td><a href="../payroll/motorcycle_install.php">Motor-Cycle Install</a></td>
                          </tr>
                        </table>
                      </div><?php /*?><? } ?>
                      
					  <? if( $_SESSION['user']['level']=='5' || $_SESSION['user']['level']=='2' ){ ?><?php */?>
					  <div class="silverheader"><a href="">Payroll Monthly Process</a></div>
                      <div class="submenu">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><a href="../payroll/monthly_attendence.php">Final Payroll Process</a></td>
                          </tr>
                        </table>
                      </div><?php /*?><? } ?>
                      

<? if( $_SESSION['user']['level']=='5' || $_SESSION['user']['level']=='2' ){ ?><?php */?>
<div class="silverheader"><a href="">Leave And IOM Management</a></div>
          <div class="submenu">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php /*?><?
$lv_per=find_a_field('mis_user_control','setup','module_name="HRM" and menu="Leave and IOM"');

if($lv_per==1){
	if(
	$_SESSION['user']['username']=='faysal'	||
	$_SESSION['user']['username']=='9999'	||		// firoz	
	$_SESSION['user']['username']=='6919'	||		// preti
	$_SESSION['user']['username']=='8554'	||		// imran
	$_SESSION['user']['username']=='8713'	||		// sazzad
	$_SESSION['user']['username']=='12205'	||		// shoaib
	$_SESSION['user']['username']=='3630'			// razzak
	){ 
?><?php */?>
	<tr><td><a href="../leave/leave_entry.php">Leave Entry</a></td></tr>
	<tr><td><a href="../leave/leave_entry_half.php">Half Day Leave Entry</a></td></tr>
	<tr><td><a href="../leave/leave_report.php">Leave Report</a></td></tr>
	<tr><td><a href="../attendence/iom_entry.php">IOM Entry</a></td></tr>
<?php /*?>
<? } } else {
	if($_SESSION['user']['username']=='faysal' // faysal
	|| $_SESSION['user']['username']=='9999'		// firoz		
	){ 
	
?><?php */?>
	<tr><td><a href="../leave/leave_entry.php">Leave Entry(SP)</a></td></tr>
	<tr><td><a href="../leave/leave_entry_half.php">Half Day Leave Entry(SP)</a></td></tr>
	<tr><td><a href="../leave/leave_report.php">Leave Report(SP)</a></td></tr>
	<tr><td><a href="../attendence/iom_entry.php">IOM Entry(SP)</a></td></tr>
						  
<?php /*?><? } }?><?php */?>
                          <!-- <tr><td><a href="../leave/tour_entry.php">Official Tour Entry</a></td></tr>
                          <tr><td><a href="../leave/leave_report_2016.php">Leave Report 2016</a></td></tr>-->
                        </table>
                      </div>

<?php /*?><? }?><?php */?>



<div class="silverheader"><a href="#" >APR and Promotion</a></div>
                      <div class="submenu">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr><td><a href="../hrm/apr.php">APR</a></td></tr>
                        </table>
						 </div>
   <?php /*?>                  
<? if(
$_SESSION['user']['username']=='faysal' ||
$_SESSION['user']['username']=='m.sales'
){ ?><?php */?>
                      <div class="silverheader"><a href="">MIS Sync For View</a></div>
                      <div class="submenu">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr><td><a href="../attendence/get_atten.php">1. Get Attn to View</a></td></tr>		  
                          <tr><td><a href="../attendence/sync_office_time_view.php">2. Office Time Update</a></td></tr>
						  <tr><td><a href="../attendence/late_calculation_view.php">3. Late Calculation</a></td></tr> 
						  <tr><td><a href="../attendence/sync_attendence_roster_sync.php">4. Roster view sync</a></td></tr>
                        </table>
                      </div>
<?php /*?><? } ?>

<? if(
$_SESSION['user']['username']=='faysal' ||
$_SESSION['user']['username']=='9999' ||
$_SESSION['user']['username']=='r.sales111'
){ ?><?php */?>
                      <div class="silverheader"><a href="">MIS Sync System</a></div>
                      <div class="submenu">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr><td><a href="../attendence/delete_iom.php"># IOM Delete</a></td></tr>
						  <tr><td><a href="../setup/payroll_setup.php"># Payroll Setup</a></td></tr>
                          <tr><td><a href="../attendence/upload_attendence_from_dump.php">1. Machine Data Syn</a></td></tr>
                          <tr><td><a href="../attendence/sync_office_time.php">2. Office Time Update</a></td></tr>
                          <tr><td><a href="../attendence/delete_earlyout.php">3. Delete Early Out</a></td></tr>
						  <tr><td><a href="../attendence/sync_attendence_final.php">4. Late Calculation</a></td></tr>
                          <tr><td><a href="../attendence/upload_attendence_final_hq.php">5. Salary Process </a></td></tr>
						  
                        </table>
                      </div>
<?php /*?><? } ?>

<? if(
$_SESSION['user']['username']=='faysal' ||
$_SESSION['user']['username']=='r.sales'
){ ?><?php */?>
                      <div class="silverheader"><a href="">MIS Sync System(Roster)</a></div>
                      <div class="submenu">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
<!--						  <tr><td><a href="../attendence/sync_attendence_roster_in.php">1.2 Roster IN</a></td></tr>
						  <tr><td><a href="../attendence/sync_attendence_roster_out.php">1.3 Roster Out</a></td></tr>-->	
						  <tr><td><a href="../attendence/roster_view_sync_ho.php">1. Roster IN OUT</a></td></tr>  
						  <tr><td><a href="../attendence/view_roster_query.php">2. Roster Query</a></td></tr> 
						  
						  <tr><td><a href="../attendence/upload_attendence_final_roster.php">3. Salary Process(Roster)</a></td></tr>
                        </table>
                      </div>
<?php /*?><? } ?>
					  
					  
					 <? if($_SESSION['user']['username']=='9999'){ ?><?php */?>
                      <div class="silverheader"><a href="">Bonus Calculation</a></div>
                      <div class="submenu">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
						 <tr> <td><a href="../admin/salary_bonus.php">Bonus Calculation</a></td> </tr>
                        </table>
                      </div><?php /*?><? } ?>
					  
					  
					   <? if(
						$_SESSION['user']['username']=='faysal' ||
						$_SESSION['user']['username']=='9999' ||
						$_SESSION['user']['username']=='r.sales'
						){ ?><?php */?>
                      <div class="silverheader"><a href="#" >Setup</a></div>
                      <div class="submenu">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
						 <tr><td><a href="../hrm/hrm_user_access.php">User Panel</a></td></tr>
						 <tr><td><a href="../setup/portal_setup.php">Portal Control</a></td></tr>
                          <tr>
                            <td><a href="../setup/action_type.php">Action Type</a></td>
                          </tr>
                          <tr>
                            <td><a href="../setup/bank_type.php">Bank Type</a></td>
                          </tr>
                          <tr>
                            <td><a href="../setup/department_type.php">Department Type</a></td>
                          </tr>
                          <tr>
                            <td><a href="../setup/designation_type.php">Designation Type</a></td>
                          </tr>
                          <tr>
                            <td><a href="../setup/domain_type.php">Section Name</a></td>
                          </tr>
                          <tr>
                            <td><a href="../setup/edu_subject_type.php">Education Subject Type</a></td>
                          </tr>
                          <tr>
                            <td><a href="../setup/edu_qua_type.php">Education Qualification Type</a></td>
                          </tr>
                          <tr>
                            <td><a href="../setup/project_type.php">Project Type</a></td>
                          </tr>
                          <tr>
                            <td><a href="../setup/relation_type.php">Relation Type</a></td>
                          </tr>
                          <tr>
                            <td><a href="../setup/university_type.php">University Type</a></td>
                          </tr>
						  <tr>
                            <td><a href="../setup/increment_type.php">Increment Type</a></td>
                          </tr>
                          <tr>
                            <td><a href="../setup/demotion_reason.php">Demotion Reason</a></td>
                          </tr>
                          <tr>
                            <td><a href="../setup/profession_type.php">Profession Type</a></td>
                          </tr>
                          <tr>
                            <td><a href="../setup/institute_type.php">Institute Type(Location)</a></td>
                          </tr>
                          <tr>
                            <td><a href="../setup/holy_day.php">Holy Day</a></td>
                          </tr>
                          <tr>
                            <td><a href="../setup/cooperative_rate.php">Co-Operative Installment</a></td>
                          </tr>
                          <tr>
                            <td><a href="../setup/office_location_type.php">Job Location</a></td>
                          </tr>
						  
                         <tr>
                            <td><a href="../setup/schedule_type.php">Roaster Schedule Type</a></td>
                          </tr>
						  
                         <tr>
                            <td><a href="../setup/roaster_point.php">Roaster Schedule Point</a></td>
                          </tr>
                        </table>
                      </div><?php /*?><? } ?>
					  
<? if(
$_SESSION['user']['username']=='faysal' ||
$_SESSION['user']['username']=='9999' ||
$_SESSION['user']['username']=='6919' ||
$_SESSION['user']['username']=='r.sales'
){ ?>	<?php */?>				  
					  <div class="silverheader"><a href="">Roaster Schedule(ALL)</a></div>
                      <div class="submenu">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          
                          <tr><td><a href="../roster/roster_day_set.php">Roaster Schedule</a></td></tr>
						  <tr><td><a href="../roster/roster_day_set_all.php">Roaster 7 Days</a></td></tr>
						  <tr><td><a href="../roster/advance_report_roster.php">Roster Report</a></td></tr>
                        </table>
                      </div><?php /*?><? } ?>
					  
					  
<? if(
$_SESSION['user']['username']=='faysal' ||
$_SESSION['user']['username']=='hfml' ||
$_SESSION['user']['username']=='hrml' ||
$_SESSION['user']['username']=='9138' || 		// savvy food konika
$_SESSION['user']['username']=='9236' || 		// savvy food fahim
$_SESSION['user']['username']=='13005' || 		// HFML kawser
$_SESSION['user']['username']=='hfl' || 		// Faysal hfl
$_SESSION['user']['username']=='8616' || 		// HFL Anik
$_SESSION['user']['username']=='13150' || 		// rice mondol


$_SESSION['user']['username']=='test'  			// test
){ ?>	<?php */?>				  
<div class="silverheader"><a href="">Roaster Schedule(Concern)</a></div>
                      <div class="submenu">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          
                          <tr><td><a href="../roster/roster_day_set_2.php">Roaster Schedule</a></td></tr>
						  <tr><td><a href="../roster/roster_day_set_all_2.php">Roaster 7 Days</a></td></tr>
						  <tr><td><a href="../roster/advance_report_roster_2.php">Roster Report</a></td></tr>
     </table>
</div>


<div class="silverheader"><a href="">Attendance Report(Concern)</a></div>
<div class="submenu">
<table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr><td><a href="../attendence/roster_view_sync.php">Collect Attendance(IN OUT)</a></td></tr>
<tr><td><a href="../attendence/single_view.php">Single Attn. Report</a></td></tr>
</table>
</div>

<?php /*?><? } ?>	


<? if(
$_SESSION['user']['username']=='13119.hr' || // HFL kamruzzaman
$_SESSION['user']['username']=='6385.hr' || // HFL Mohsin
$_SESSION['user']['username']=='10070.hr' || // HFL Azad
$_SESSION['user']['username']=='10063.hr' || // HFL Hannan
$_SESSION['user']['username']=='5906.hr' || // HFL Shahajan
$_SESSION['user']['username']=='9565.hr' || // HFL Hasebul
$_SESSION['user']['username']=='12319.hr' || // HFL Mahabur
$_SESSION['user']['username']=='12268.hr' || // HFL Ajoy
$_SESSION['user']['username']=='10028.hr' || // HFL Haranur
$_SESSION['user']['username']=='10229.hr' || // HFL Nazmul
$_SESSION['user']['username']=='10109.hr' || // HFL Noor
$_SESSION['user']['username']=='12350.hr' || // HFL Monowar mec 1
$_SESSION['user']['username']=='12350.hr2' || // HFL Monowar mec 2

$_SESSION['user']['username']=='4475.hr' || // HFL Ranabir

$_SESSION['user']['username']=='test'  			// test
){ ?>	<?php */?>				  
<div class="silverheader"><a href="">Roaster Schedule(Concern)</a></div>
<div class="submenu">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td><a href="../roster/roster_day_set_all_3.php">Roaster 7 Days</a></td></tr>
<tr><td><a href="../attendence/single_view3.php">Single Attn. Report</a></td></tr>
<tr><td><a href="../roster/advance_report_roster_3.php">Roster Report</a></td></tr>
</table>
</div>




<?php /*?>
<? } ?>	

				  
					  
					  
                      <? if( $_SESSION['user']['level']=='5' || $_SESSION['user']['level']=='1' ||$_SESSION['user']['level']=='2' ){ ?><?php */?>
					  <div class="silverheader"><a href="#">HRM Report</a></div>
                      <div class="submenu">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><a href="../report/delail_report_selection.php">Detail Staff Information</a></td>
                          </tr>
                          <tr>
                            <td><a href="../report/advance_report_apr.php">APR Reports</a></td>
                          </tr>
                          <tr>
                            <td><a href="../attendence/individual_attendance_report.php">Individual Monthly Attendance</a></td>
                          </tr>
			       <tr>
                            <td><a href="../attendence/pending_lv_iom_report.php">Pending Leave IOM</a></td>
                          </tr>
						<tr>
                            <td><a href="../report/advance_report_leave.php">Leave Encashment Report</a></td>
                          </tr>
                          <tr><td><a href="../report/advance_report.php">Advance Reports</a></td></tr>
                          <!--<tr>
                            <td><a href="../report/roster_report.php">Roster Reports</a></td>
                          </tr>-->
                        </table>
                      </div><?php /*?><? } ?>
					  

<? if( $_SESSION['user']['level']=='5' || $_SESSION['user']['level']=='9' ){ ?>
<? if( $_SESSION['user']['username']=='faysal' || $_SESSION['user']['username']=='5061' || $_SESSION['user']['username']=='211' ){ ?><?php */?>
					  <div class="silverheader"><a href="#">Admin Section</a></div>
                      <div class="submenu">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">

                          <tr>
                            <td><a href="../report/advance_report2.php">Mobile NO Update</a></td>
                          </tr>
                          <!--<tr>
                            <td><a href="../report/roster_report.php">Roster Reports</a></td>
                          </tr>-->
                        </table>
                      </div><?php /*?><? } } ?>
					  


<? if( $_SESSION['user']['level']=='5' || $_SESSION['user']['level']=='102' ){ ?><?php */?>					  
<div class="silverheader"><a href="">Recruitment Report</a></div>
<div class="submenu">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td><a href="../report/advance_report3.php">Report List</a></td></tr>
</table>
</div>
<?php /*?><? } ?>	 <?php */?>
					  
					  
					  
                      <br>
                    </div></td>
                </tr>
              </table>
            </div>
          </div>
          <div class="oe_footer"> Powered by <a href="http://www.erp.com.bd/" target="_top"><span>ERP COM BD</span></a> </div></td>
        <td class="oe_application"><div>
            <?=$main_content;?>
          </div></td>
      </tr>
    </tbody>
  </table>
</div>
</body>
</html>
