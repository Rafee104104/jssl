<?php
session_start();
ob_start();
require "../../config/inc.all.php";
$head='<link href="../../css/report_selection.css" type="text/css" rel="stylesheet"/>';
do_calander('#roster_date');do_calander('#roster_date2');
if($_POST['mon']!=''){
$mon=$_POST['mon'];}
else{
$mon=date('n');
}

if($_POST['year']!=''){
$year=$_POST['year'];}
else{
$year=date('Y');
}
?>

<form action="master_report_roster.php" target="_blank" method="post">
<div class="oe_view_manager oe_view_manager_current">
        
        <div class="oe_view_manager_body">
            
                <div  class="oe_view_manager_view_list"></div>
            
                <div class="oe_view_manager_view_form"><div style="opacity: 1;" class="oe_formview oe_view oe_form_editable">
        <div class="oe_form_buttons"></div>
        <div class="oe_form_sidebar"></div>
        <div class="oe_form_pager"></div>
        <div class="oe_form_container"><div class="oe_form">
          <div class="">
<div class="oe_form_sheetbg">
        <div class="oe_form_sheet oe_form_sheet_width">

          <div  class="oe_view_manager_view_list"><div  class="oe_list oe_view">
<table width="100%" border="0" class="oe_list_content"><thead>
<tr class="oe_list_header_columns">
  <th colspan="4"><span style="text-align: center; font-size:18px; color:#09F"> Roster Reporting</span></th>
  </tr>
<tr class="oe_list_header_columns">
  <th colspan="4"><span style="text-align: center; font-size:16px; color:#C00">Select Options</span></th>
  </tr>
</thead><tfoot>
</tfoot><tbody>
  <tr>
    <td align="right" class="alt"><strong>Company :</strong></td>
    <td align="left" class="alt"><span class="oe_form_group_cell">
      <select name="PBI_ORG" style="width:160px;" id="PBI_ORG" required="required">
        <? foreign_relation('user_group','id','group_name','"'.$PBI_ORG.'"','1 and id="'.$_SESSION['user']['group'].'"');?>
      </select>
    </span></td>
    <td width="40%" align="right" class="alt"><strong>Department :</strong></td>
    <td width="10%"><select name="department" style="width:160px;" id="department">
        <? foreign_relation('department','DEPT_SHORT_NAME','DEPT_DESC',$PBI_DEPARTMENT,' 1 order by DEPT_DESC');?>
      </select></td>
  </tr>

  <tr  class="alt">
    <td align="right"><strong>Job Location:</strong></td>
    <td><span class="oe_form_group_cell">
      <select name="JOB_LOCATION" id="JOB_LOCATION">
        <? foreign_relation('office_location','ID','LOCATION_NAME',$_POST['JOB_LOCATION'],'1');?>
      </select>
    </span></td>
    <td align="right"><strong>Section :</strong></td>
    <td><strong>
      <select name="PBI_DOMAIN">
        <? foreign_relation('domai','DOMAIN_DESC','DOMAIN_DESC',$_POST['PBI_DOMAIN']);?>
      </select>
    </strong></td>
  </tr>
  
  <tr >
    <td align="right">PBI IN </td>
    <td align="left"><span class="oe_form_group_cell">
      <input name="pbi_in" type="text" id="pbi_in" value="<?=$_POST['pbi_in']?>"  />
    </span></td>
    <td align="right" class="alt"><strong>Schedule :</strong></td>
    <td class="alt"><strong>
      <select name="schedule">
        <? foreign_relation('hrm_schedule_info','office_start_time','schedule_name',$_POST['schedule'],'group_for="'.$_SESSION['user']['group'].'" and office_start_time > 0');?>
      </select>
    </strong></td>
  </tr>
  <tr >
    <td align="right"><strong>Start Date:</strong></td>
    <td align="left"><span class="oe_form_group_cell">
      <input name="roster_date" type="text" id="roster_date" value="<?=$_POST['roster_date']?>" required="required" />
    </span></td>
    <td align="right"><strong>End  Date:</strong></td>
    <td><span class="oe_form_group_cell">
      <input name="roster_date2" type="text" id="roster_date2" value="<?=$_POST['roster_date2']?>" required="required" />
    </span></td>
  </tr>
  
  
  </tbody></table>
<br /><div style="text-align:center">
<table width="100%" class="oe_list_content">
  <thead>
<tr class="oe_list_header_columns">
  <th colspan="4"><span style="text-align: center; font-size:16px; color:#C00">Select Report</span></th>
  </tr>
  </thead>
  <tfoot>
  </tfoot>
  <tbody>
    <tr>
      <td align="center"><input name="report" type="radio" class="radio" value="1"  /></td>
      <td><strong>Roster Schedule Report (1) </strong></td>
      <td align="center">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><input name="report" type="radio" class="radio" value="2"></td>
      <td><strong>Schedule Vs Attendance  Report (2) </strong></td>
      <td align="center">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><input name="report" type="radio" class="radio" value="3" /></td>
      <td><strong>OverTime Report  (3)</strong></td>
      <td align="center">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    <tr>
      <td align="center"><input name="report" type="radio" class="radio" value="4" /></td>
      <td><strong>Preset Count  Report  (4)</strong></td>
      <td width="4%" align="center">&nbsp;</td>
      <td width="44%">&nbsp;</td>
      </tr>
<!--    <tr >
      <td align="center" class="alt"><input name="report" type="radio" class="radio" value="5" /></td>
      <td class="alt"><strong>Salary Payroll Report (Detail)</strong><strong></strong></td>
      <td align="center">&nbsp;</td>
      <td>&nbsp;</td>
      </tr>
    <tr >
      <td align="center" class="alt"><input name="report" type="radio" class="radio" value="6" /></td>
      <td class="alt"><strong>Salary Payroll Report (Summary)</strong><strong></strong></td>
      <td align="center">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>-->
  </tbody>
</table>
<input name="submit" type="submit" id="submit" value="SHOW" />
          </div></div></div>
          </div>
    </div>
    <div class="oe_chatter"><div class="oe_followers oe_form_invisible">
      <div class="oe_follower_list"></div>
    </div></div></div></div></div>
    </div></div>
            
        </div>
  </div>
</form>
<?
$main_content=ob_get_contents();
ob_end_clean();
include ("../../template/main_layout.php");
?>