<?php
session_start();
ob_start();
require "../../config/inc.all.php";
$head='<link href="../../css/report_selection.css" type="text/css" rel="stylesheet"/>';
do_calander('#ijdb');
do_calander('#ijda');
do_calander('#ppjdb');
do_calander('#ppjda');
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
?><style type="text/css">
<!--
.style1 {
	font-size: 16px;
	color: #C00;
}
-->
</style>

<form action="../report/master_report.php" target="_blank" method="post">
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
  <th colspan="4"><center><span style="text-align: center; font-size:18px; color:#09F">Advance Reporting</span></center></th>
  </tr>
<tr class="oe_list_header_columns">
  <th colspan="4"><span style="text-align: center; font-size:16px; color:#C00">Select Options</span></th>
  </tr>
</thead><tfoot>
</tfoot><tbody>
  <tr>
    <td align="right" class="alt"><strong>Company :</strong></td>
    <td align="left" class="alt"><span class="oe_form_group_cell">
      <select name="PBI_ORG" style="width:160px;" id="PBI_ORG">
        <? foreign_relation('user_group','id','group_name',$PBI_ORG);?>
      </select>
    </span></td>
    <td width="40%" align="right" class="alt"><strong>Department :</strong></td>
    <td width="10%"><span class="oe_form_group_cell">
      <select name="department" style="width:160px;" id="department">
        <? foreign_relation('department','DEPT_SHORT_NAME','DEPT_DESC',$PBI_DEPARTMENT,' 1 order by DEPT_DESC');?>
      </select>
    </span></td>
  </tr>
  <tr  class="alt">
    <td align="right"><strong>Group  :</strong></td>
    <td align="left"><span class="oe_form_group_cell">
      <select name="PBI_GROUP" style="width:160px;" id="PBI_GROUP">
        <? foreign_relation('product_group','group_name','group_name',$PBI_GROUP);?>
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
    <td align="right"><strong>Region :</strong></td>
    <td><span class="oe_form_group_cell">
      <select name="branch" style="width:160px;" id="branch">
        <? foreign_relation('branch','BRANCH_ID','BRANCH_NAME',$PBI_BRANCH);?>
      </select>
    </span></td>
    <td align="right"><strong>Job Location  :</strong></td>
    <td><span class="oe_form_group_cell">
      <select name="JOB_LOCATION" id="JOB_LOCATION">
        <? foreign_relation('office_location','ID','LOCATION_NAME',$_POST['JOB_LOCATION'],'1');?>
      </select>
    </span></td>
  </tr>
  <tr >
    <td align="right"><strong>Zone :</strong></td>
    <td align="left"><span class="oe_form_group_cell">
      <select name="zone" style="width:160px;" id="zone">
        <? foreign_relation('zon','ZONE_CODE','ZONE_NAME',$PBI_ZONE);?>
      </select>
    </span></td>
    <td align="right"><strong>Job Status :</strong></td>
    <td><span class="oe_form_group_cell">
      <select name="job_status" style="width:160px;">
        <option></option>
        <option>IN SERVICE</option>
        <option>NOT IN SERVICE</option>
      </select>
    </span></td>
  </tr>
  <tr >
    <td align="right"><strong>Area:</strong></td>
    <td align="left"><strong><span class="oe_form_group_cell">
      <select name="area" style="width:160px;" id="area">
        <? foreign_relation('area','AREA_CODE','AREA_NAME',$PBI_AREA);?>
      </select>
      </span></strong></td>
    <td align="right"><strong> Joining Date(From) :</strong></td>
    <td align="left"><input name="ijda" type="text" id="ijda" size="30" style="width:160px;" /></td>
  </tr>
  <tr >
    <td align="right" class="alt"><strong>Designation :</strong></td>
    <td align="left" class="alt"><span class="oe_form_group_cell">
      <select name="designation" style="width:160px;" id="designation">
        <? foreign_relation('designation','DESG_SHORT_NAME','DESG_DESC',$designation,' 1 order by DESG_DESC');?>
      </select>
    </span></td>
    <td align="right"><strong> Joining Date(To) :</strong></td>
    <td><input name="ijdb" type="text" id="ijdb" size="30" style="width:160px;" /></td>
  </tr>

  <tr >
    <td align="right"><strong>Bonus Type  : </strong></td>
    <td align="left"><strong>
      <select name="bonus_type">
	  <option></option>
        <option value="1">Eid-Ul-Fitre</option>
		<option value="2">Eid-Ul-Adha</option>
      </select>
    </strong></td>
    <td align="right"><strong>Employee Code IN:</strong></td>
    <td><input name="pbi_id_in" type="text" id="pbi_id_in" /></td>
  </tr>
  <tr >
    <td align="right">&nbsp;</td>
    <td align="left">&nbsp;</td>
    <td align="right"><strong>Bank Name   :</strong></td>
    <td><span class="oe_form_group_cell">
      <select name="cash_bank">
        <option selected="selected"> <?=$cash_bank?></option>
        <option <?=($cash_bank=='DBBL')?'selected':'';?>>DBBL</option>
        <option <?=($cash_bank=='ROCKET')?'selected':'';?>>ROCKET</option>
        <option <?=($cash_bank=='NCC')?'selected':'';?>>NCC</option>
        <option <?=($cash_bank=='EBL')?'selected':'';?>>EBL</option>
      </select>
    </span></td>
  </tr>
  <tr >
    <td align="right" bgcolor="#FF99FF">(For Payroll) Month  :</td>
    <td align="left" bgcolor="#FF99FF"><span class="oe_form_group_cell">
      <select name="mon" style="width:160px;" id="mon" required="required">
        <option value="1" <?=($mon=='1')?'selected':''?>>Jan</option>
        <option value="2" <?=($mon=='2')?'selected':''?>>Feb</option>
        <option value="3" <?=($mon=='3')?'selected':''?>>Mar</option>
        <option value="4" <?=($mon=='4')?'selected':''?>>Apr</option>
        <option value="5" <?=($mon=='5')?'selected':''?>>May</option>
        <option value="6" <?=($mon=='6')?'selected':''?>>Jun</option>
        <option value="7" <?=($mon=='7')?'selected':''?>>Jul</option>
        <option value="8" <?=($mon=='8')?'selected':''?>>Aug</option>
        <option value="9" <?=($mon=='9')?'selected':''?>>Sep</option>
        <option value="10" <?=($mon=='10')?'selected':''?>>Oct</option>
        <option value="11" <?=($mon=='11')?'selected':''?>>Nov</option>
        <option value="12" <?=($mon=='12')?'selected':''?>>Dec</option>
      </select>
    </span></td>
    <td align="right" bgcolor="#FF99FF">(For Payroll) Year  :</td>
    <td bgcolor="#FF99FF"><select name="year" style="width:160px;" id="year" required="required">
      
      <option <?=($year=='2016')?'selected':''?>>2016</option>
	  <option <?=($year=='2017')?'selected':''?>>2017</option>
      <option <?=($year=='2018')?'selected':''?>>2018</option>
      <option <?=($year=='2019')?'selected':''?>>2019</option>
	  <option <?=($year=='2020')?'selected':''?>>2020</option>
	  <option <?=($year=='2021')?'selected':''?>>2021</option>
    </select></td>
  </tr>
  </tbody></table>
<br /><div style="text-align:center">
<table width="100%" class="oe_list_content">
  <thead>
<tr class="oe_list_header_columns">
  <th colspan="4"><center><span style="text-align: center; font-size:16px; color:#C00">Select Report</span></center></th>
  </tr>
  </thead>
  <tfoot>
  </tfoot>
  <tbody>
    <tr>
      <td align="center">&nbsp;</td>
      <td><span class="style1">Personnel Information </span></td>
      <td align="center">&nbsp;</td>
      <td><span style="text-align: center; font-size:16px; color:#C00">Salary</span></td>
    </tr>
    <tr>
      <td width="4%" align="center"><input name="report" type="radio" class="radio" value="1" checked="checked" /></td>
      <td width="44%"><strong>Basic Information(1)</strong></td>
      <td align="center" class="alt"><input name="report" type="radio" class="radio" value="78" /></td>
      <td class="alt"><strong>Salary Payroll Report Final(78)</strong></td>
    </tr>
	      <tr  class="alt">
	        <td align="center"><input name="report" type="radio" class="radio" value="22"></td>
	        <td><strong>Employee  Information For Recruitment(22)</strong></td>
	        <td align="center"><input name="report" type="radio" class="radio" value="77" /></td>
	        <td><strong>Salary Payroll Report Final (Sales)(77)</strong></td>
	      </tr>
	      <tr  class="alt">
	        <td align="center"><input name="report" type="radio" class="radio" value="10001"  /></td>
	        <td><strong>Employee Details Information(10001)</strong></td>
	        <td align="center"><input name="report" type="radio" class="radio" value="82" /></td>
	        <td><strong>Group Salary Payroll Report(82)--(Check Please) </strong></td>
	      </tr>
	      <tr  class="alt">
      <td align="center"><input name="report" type="radio" class="radio" value="8" /></td>
      <td><strong>Staff Mobile Information(Changable)(8)</strong></td>
      <td align="center">&nbsp;</td>
      <td>&nbsp;</td>
	      </tr>
<!--    <tr  class="alt">
      <td align="center"><input name="report" type="radio" class="radio" value="7" /></td>
      <td><strong>Payroll  </strong> <strong>Information(New)(7)</strong></td>
      <td align="center">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr  class="alt">
      <td align="center"><input name="report" type="radio" class="radio" value="23" /></td>
      <td><strong>Payroll </strong> <strong>Information(23)</strong></td>
      <td align="center">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>-->
    <tr  class="alt">
      <td align="center"><input name="report" type="radio" class="radio" value="2" /></td>
      <td><strong>Employee Salary and Benefits Information(2)</strong></td>
      <td align="center"><input name="report" type="radio" class="radio" value="7841" /></td>
      <td><strong>Department Wise  Salary Brief Report for HRM(HO)(7841)</strong></td>
    </tr>
    <tr >
      <td align="center" class="alt"><input name="report" type="radio" class="radio" value="3" /></td>
      <td class="alt"><strong>Monthly Attendence Report(3)</strong></td>
      <td align="center" class="alt"><input name="report" type="radio" class="radio" value="7842" /></td>
      <td class="alt"><strong>Department Wise  Salary Brief Report for HRM(SG)(7842)</strong></td>
    </tr>
    <tr >
      <td align="center" class="alt">&nbsp;</td>
      <td class="alt">&nbsp;</td>
      <td align="center" class="alt"><input name="report" type="radio" class="radio" value="78411" /></td>
      <td class="alt"><strong>Department Wise  Salary Brief Report for HRM(Other)(78411)</strong></td>
    </tr>
    <tr >
      <td align="center" class="alt">&nbsp;</td>
      <td class="alt"><span class="style1">Bonus Report </span></td>
      <td align="center" class="alt"><input name="report" type="radio" class="radio" value="7840" /></td>
      <td class="alt"><strong>Section Wise  Salary Brief Report(7840)</strong></td>
    </tr>
    <tr >
      <td align="center" class="alt"><input name="report" type="radio" class="radio" value="777" /></td>
      <td class="alt"><strong>Employee Bonus Report(777)</strong></td>
      <td align="center" class="alt"><input name="report" type="radio" class="radio" value="7801" /></td>
      <td class="alt"><strong>Region Wise Sales Salary Brief Report(Without HO)(7801)</strong></td>
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
    <tr >
      <td align="center" class="alt"><input name="report" type="radio" class="radio" value="778" /></td>
      <td class="alt"><strong>Employee Bonus Report (Sales)(778)</strong></td>
      <td align="center" class="alt"><input name="report" type="radio" class="radio" value="78412" /></td>
      <td class="alt"><strong>Location Wise  Salary Brief Report for HRM(Other)(78412)</strong></td>
    </tr>
    <tr >
      <td align="center" class="alt"><input name="report" type="radio" class="radio" value="64" /></td>
      <td class="alt"><strong> Bonus Summary Report(64)</strong></td>
      <td align="center" class="alt"><input name="report" type="radio" class="radio" value="780" /></td>
      <td class="alt"><strong>Region Wise Sales Salary Brief Report(780)</strong></td>
    </tr>
    <tr >
      <td align="center" class="alt">&nbsp;</td>
      <td class="alt">&nbsp;</td>
      <td align="center" class="alt"><input name="report" type="radio" class="radio" value="783" /></td>
      <td class="alt"><strong>Zone Wise Sales Salary Brief Report(783)</strong></td>
    </tr>
    <tr >
      <td align="center" class="alt"><input name="report" type="radio" class="radio" value="65" /></td>
      <td class="alt"><strong> Bonus Sales Summary Report-Without HO(65)</strong></td>
      <td align="center" class="alt"><input name="report" type="radio" class="radio" value="7804" /></td>
      <td class="alt">Group Wise HO Sales Report(7804)</td>
    </tr>
	<tr >
	  <td align="center" class="alt"><input name="report" type="radio" class="radio" value="785" /></td>
	  <td class="alt"><strong> Bonus Bank Summary(Select Bank)(785)</strong></td>
	  <td align="center" class="alt"><input name="report" type="radio" class="radio" value="7800" /></td>
	  <td class="alt">Store Wise Salary Report(7800)</td>
	</tr>
	  <tr >
	    <td align="center" class="alt"><input name="report" type="radio" class="radio" value="786" /></td>
	    <td class="alt"><strong>Bonus IBBL Bank  Summary Report(786)</strong></td>
	    <td align="center" class="alt"><input name="report" type="radio" class="radio" value="784" /></td>
	    <td class="alt"><strong>Department Wise  Salary Brief Report(SC)(784)</strong></td>
	  </tr>
	  <tr >
	    <td align="center" class="alt">&nbsp;</td>
	    <td class="alt">&nbsp;</td>
	    <td align="center" class="alt"><input name="report" type="radio" class="radio" value="7809" /></td>
	    <td class="alt"><strong>Group Salary Summary Report(7809)</strong></td>
	  </tr>
	  <tr >
	    <td align="center" class="alt">&nbsp;</td>
	    <td class="alt">&nbsp;</td>
	    <td align="center">&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td align="center" class="alt">&nbsp;</td>
	    <td class="alt"><span class="style1">Attendance Related Reports </span></td>
	    <td align="center" class="alt">&nbsp;</td>
	    <td class="alt"><span class="style1">Bank Reports </span></td>
	  </tr>
	  <tr>
	    <td align="center" class="alt"><input name="report" type="radio" class="radio" value="80" /></td>
	    <td class="alt"><strong>Attendance Summary Portal-Remarks(80)</strong></td>
	    <td align="center" class="alt"><input name="report" type="radio" class="radio" value="781" /></td>
	    <td class="alt"><strong>Other Bank  Summary Report(781)</strong></td>
	  </tr>
	  <tr>
	    <td align="center" class="alt"><input name="report" type="radio" class="radio" value="81" /></td>
	    <td class="alt"><strong>Attendance Summary Portal(81)</strong></td>
	    <td align="center" class="alt"><input name="report" type="radio" class="radio" value="782" /></td>
	    <td class="alt"><strong>IBBL Bank  Summary Report(782)</strong></td>
	  </tr>
	<tr >
	  <td align="center" class="alt"><input name="report" type="radio" class="radio" value="60" /></td>
	  <td class="alt"><strong>IOM Report(60)</strong></td>
	  <td align="center">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
	<tr >
	  <td align="center" class="alt"><input name="report" type="radio" class="radio" value="61" /></td>
	  <td class="alt"><strong>Leave Report(61)</strong></td>
	  <td align="center">&nbsp;</td>
	  <td><span class="style1">Others Report</span></td>
	</tr>
	<tr >
	  <td align="center" class="alt"><input name="report" type="radio" class="radio" value="22222" /></td>
	  <td class="alt"><strong>Roster Routine(22222)</strong></td>
	  <td align="center" class="alt"><input name="report" type="radio" class="radio" value="7811" /></td>
	  <td class="alt"><strong>Co-Operative Subscription Report(7811)</strong></td>
	</tr>
	<tr >
	  <td align="center" class="alt"><input name="report" type="radio" class="radio" value="4" /></td>
	  <td class="alt"><strong>Over Time Amount Report(4)</strong></td>
	  <td align="center" class="alt"><input name="report" type="radio" class="radio" value="79" /></td>
	  <td class="alt"><strong>Salary Information Pay Slip(79)</strong></td>
	</tr>
	<tr >
	  <td align="center" class="alt">&nbsp;</td>
	  <td class="alt">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td>&nbsp;</td>
	  </tr>
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