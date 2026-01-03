<?php
session_start();
ob_start();
require "../../config/inc.all.php";

// ::::: Edit This Section ::::: 
$title='Employee Basic Info';		// Page Name and Page Title
$page="employee_basic_information.php";		// PHP File Name
$input_page="employee_basic_information_input.php";
$root='hrm';

$table='personnel_basic_info';		// Database Table Name Mainly related to this page
$unique='PBI_ID';			// Primary Key of this Database table
$shown='PBI_FATHER_NAME';	

do_calander('#PBI_DUE_DOJ');
do_calander('#PBI_DOB');
do_calander('#PBI_DOJ_PP');
do_calander('#PBI_DOC');
do_calander('#PBI_DOC2');
do_calander('#PBI_DOJ');
do_calander('#PBI_APPOINTMENT_LETTER_DATE');
do_calander('#JOB_STATUS_DATE');

// ::::: End Edit Section :::::


$crud      =new crud($table);

$required_id=find_a_field($table,$unique,'PBI_ID='.$_SESSION['employee_selected']);
if($required_id>0)
$$unique = $_GET[$unique] = $required_id;
if(isset($_POST[$shown]))
{	if(isset($_POST['insert']))
		{		
				$due_date = date("Y-m-d", strtotime($_POST['PBI_DOJ']."+".$_POST['PBI_CON_TYPE']." months"));
				$_REQUEST['PBI_DUE_DOJ']=$due_date;
				$_REQUEST['PBI_DEPARTMENT'] = find_a_field('department','DEPT_SHORT_NAME','DEPT_ID='.$_REQUEST['DEPT_ID']);
				$_REQUEST['PBI_DESIGNATION'] = find_a_field('designation','DESG_SHORT_NAME','DESG_ID='.$_REQUEST['DESG_ID']);
				$path='../../pic/staff';
				$_POST['pic']=image_upload($path,$_FILES['pic']);
				$_POST['PBI_ID']=$_SESSION['employee_selected'];
				$crud->insert();
				$type=1;
				$msg='New Entry Successfully Inserted.';
				unset($_POST);
				unset($$unique);
$required_id=find_a_field($table,$unique,'PBI_ID='.$_SESSION['employee_selected']);
if($required_id>0)
$$unique = $_GET[$unique] = $required_id;
		}
	//for Modify..................................
	if(isset($_POST['update']))
	{			$_REQUEST['PBI_DEPARTMENT'] = find_a_field('department','DEPT_SHORT_NAME','DEPT_ID='.$_REQUEST['DEPT_ID']);
				$_REQUEST['PBI_DESIGNATION'] = find_a_field('designation','DESG_SHORT_NAME','DESG_ID='.$_REQUEST['DESG_ID']);
				//$due_date_d=$_POST['PBI_CON_TYPE']-1;
				$due_date = date("Y-m-d", strtotime($_POST['PBI_DOJ']."+".$_POST['PBI_CON_TYPE']." months"));
				$_REQUEST['PBI_DUE_DOJ']=$due_date;
    			//echo $due_date .'<br>'. $_POST['PBI_CON_TYPE'];
				$path='../../pic/staff';
				$_POST['pic']=image_upload($path,$_FILES['pic']);
				$crud->update($unique);
				$type=1;
	}
}

if(isset($$unique))
{
$condition=$unique."=".$$unique;
$data=db_fetch_object($table,$condition);
while (list($key, $value)=each($data))
{ $$key=$value;}
}
?>
<script type="text/javascript"> function DoNav(lk){
	return GB_show('ggg', '../pages/<?=$root?>/<?=$input_page?>?<?=$unique?>='+lk,600,940)
	}
    function add_date(cd)
	{
		var arr=cd.split('-');
		var mon = (arr[1]*1)+6;
		var day = (arr[2]*1);
		var yr =  (arr[0]*1);
		if(mon>12)
		{
			mon = mon-12;
			yr  = yr+1;
		}
		var con_date = yr+'-'+mon+'-'+day;
		document.getElementById('PBI_DOC').value=con_date;
	}
    </script>
    <style type="text/css">
<!--
.style1 {color: #FF0000}
-->
    </style>
    

<form action="" method="post" enctype="multipart/form-data">
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
                      <? include('../../common/input_bar.php');?>
                      <div class="oe_form_sheetbg">
                        <div class="oe_form_sheet oe_form_sheet_width">
        <h1><label for="oe-field-input-27" title="" class=" oe_form_label oe_align_right">
        <a href="home2.php" rel = "gb_page_center[940, 600]"><?=$title?></a>
    </label>
          </h1><table width="801" border="0" cellpadding="0" cellspacing="0" class="oe_form_group ">
            <tbody><tr class="oe_form_group_row">
            <td colspan="1" class="oe_form_group_cell" width="100%"><table width="794" border="0" cellpadding="0" cellspacing="0" class="oe_form_group ">
              <tbody>
                <tr class="oe_form_group_row">
                  <td bgcolor="#E8E8E8" width="23%" colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;<span class="style1">Code :</span></strong></td>
                  <td bgcolor="#E8E8E8" width="23" colspan="2" class="oe_form_group_cell">
                    <input name="<?=$unique?>" id="<?=$unique?>" value="<?=$$unique?>" type="hidden" />
                    <input name="PBI_ID" type="text" id="PBI_ID" value="<?=$PBI_ID?>"/></td>
                  <td bgcolor="#E8E8E8" width="23%" class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label"><span class="style1">Organization:</span></span></strong></td>
                  <td bgcolor="#E8E8E8" width="31%" class="oe_form_group_cell"><select name="PBI_ORG">
                    <? foreign_relation('user_group','id','group_name',$PBI_ORG,' 1');?>
                    </select></td>
                </tr>
                <tr class="oe_form_group_row">
                  <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>
                    <label>&nbsp; <span class="style1">Name :</span></label>
                  </strong></td>
                  <td colspan="2" class="oe_form_group_cell"><input name="PBI_NAME" type="text" id="PBI_NAME" value="<?=$PBI_NAME?>"/></td>
                  <td bgcolor="#FFFFFF" class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label"><span class="style1">Department:</span></span></strong></td>
                  <td bgcolor="#FFFFFF" class="oe_form_group_cell"><select name="DEPT_ID">
                    <? foreign_relation('department','DEPT_ID','DEPT_DESC',$DEPT_ID,' 1 order by DEPT_DESC');?>
                    </select></td>
                </tr>
                <tr class="oe_form_group_row">
                  <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Father's Name : </strong></td>
                  <td colspan="2" bgcolor="#E8E8E8" class="oe_form_group_cell">
                    
                    <input name="PBI_FATHER_NAME" type="text" id="PBI_FATHER_NAME" value="<?=$PBI_FATHER_NAME?>"/>                  </td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label"><span class="style1">Section:</span></span></strong></td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><select name="PBI_DOMAIN">
                    <? foreign_relation('domai','DOMAIN_DESC','DOMAIN_DESC',$PBI_DOMAIN,' 1 order by DOMAIN_DESC');?>
                  </select></td>
                  </tr>
                <tr class="oe_form_group_row">
                  <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp; Mother's Name :</strong></td>
                  <td colspan="2" class="oe_form_group_cell"><input name="PBI_MOTHER_NAME" type="text" id="PBI_MOTHER_NAME" value="<?=$PBI_MOTHER_NAME?>"/></td>
                  <td bgcolor="#FFFFFF" class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label"><span class="style1">Region: </span></span></strong></td>
                  <td bgcolor="#FFFFFF" class="oe_form_group_cell"><select name="PBI_BRANCH" id="PBI_BRANCH" onchange="getData2('ajax_zone.php', 'zone', this.value,  this.value)">
                    <? foreign_relation('branch','BRANCH_ID','BRANCH_NAME',$PBI_BRANCH,' 1 order by BRANCH_NAME');?>
                    </select></td>
                </tr>
                <tr class="oe_form_group_row">
                  <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Designation :</strong></td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><select name="DESG_ID">
                    <? foreign_relation('designation','DESG_ID','DESG_DESC',$DESG_ID,'1 order by DESG_DESC');?>
                  </select></td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell">
                    <input name="PBI_DESG_GRADE" type="text" id="PBI_DESG_GRADE" value="<?=find_a_field("designation","DESG_GRADE","DESG_SHORT_NAME='".$PBI_DESIGNATION."'",'1 order by DESG_DESC');?>" style="width:30px;" /></td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label"><span class="style1">Zone:</span> <br />
                  </span></strong></td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><span id="zone">
                    <select name="PBI_ZONE" id="PBI_ZONE"  onchange="getData2('ajax_area.php', 'area', this.value,  this.value)">
                      <? foreign_relation('zon','ZONE_CODE','ZONE_NAME',$PBI_ZONE,' 1 order by ZONE_NAME');?>
                    </select>
                  </span></td>
                  </tr>
                <tr class="oe_form_group_row">
                  <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Date of Birth :</strong></td>
                  <td colspan="2" class="oe_form_group_cell"><input name="PBI_DOB" type="text" id="PBI_DOB" value="<?=$PBI_DOB?>"/></td>
                  <td class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label"><span class="style1">Area:</span> </span></strong></td>
                  <td class="oe_form_group_cell"><span id="area">
                    <select name="PBI_AREA" id="PBI_AREA">
                      <? foreign_relation('area','AREA_CODE','AREA_NAME',$PBI_AREA,' 1 order by AREA_NAME');?>
                      </select>
                    </span></td>
                </tr>
                <tr class="oe_form_group_row">
                  <td colspan="1" bgcolor="#E8E8E8" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Place of Birth (District) :</strong></td>
                  <td colspan="2" bgcolor="#E8E8E8" class="oe_form_group_cell"><select name="PBI_POB">
                    <option value="<?=$PBI_POB?>">
                      <?=$PBI_POB?>
                      </option>
                    <? foreign_relation('district_list','district_name','district_name',$PBI_POB,' 1 order by district_name');?>
                  </select></td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label"><span class="style1">Group: </span></span></strong></td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><select name="PBI_GROUP" id="PBI_GROUP">
                    <? foreign_relation('product_group','group_name','group_name',$PBI_GROUP,'1 order by group_name');?>
                  </select></td>
                </tr>
                <tr class="oe_form_group_row">
                  <td colspan="1" bgcolor="#FFFFFF" class="oe_form_group_cell oe_form_group_cell_label"><strong>Service Length:</strong></td>
                  <td colspan="2" bgcolor="#FFFFFF" class="oe_form_group_cell"><input name="PBI_SERVICE_LENGTH" type="text" id="PBI_SERVICE_LENGTH" 
value="<? 
if($JOB_STATUS_DATE>0){ $date2 = $JOB_STATUS_DATE; } else {
$date2 = date('Y-m-d'); }

echo $servicel=find_a_field('personnel_basic_info','CONCAT( TIMESTAMPDIFF(YEAR, PBI_DOJ, "'.$date2.'")," Year,",
TIMESTAMPDIFF(MONTH, PBI_DOJ, "'.$date2.'") % 12," mon")','1 and PBI_ID="'.$PBI_ID.'"');
?>" readonly="readonly"
/></td>
                  <td bgcolor="#FFFFFF" class="oe_form_group_cell">Sales Grade: </td>
                  <td bgcolor="#FFFFFF" class="oe_form_group_cell">
<select name="sales_grade" id="sales_grade">
<option value="<?=$sales_grade;?>"><?=$sales_grade;?></option>
					<option>A</option><option>B</option><option>C</option><option>D</option><option>N</option>
                  </select></td>
                </tr>
                <tr class="oe_form_group_row">
                  <td colspan="1" bgcolor="#FFFFFF" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp; <span class="style1">Joining Date :</span></strong></td>
                  <td colspan="2" bgcolor="#FFFFFF" class="oe_form_group_cell"><input name="PBI_DOJ" type="text" id="PBI_DOJ" value="<?=$PBI_DOJ?>"  onchange="add_date(this.value)"/></td>

<td bgcolor="#FFFFFF" class="oe_form_group_cell">Dealer Code: </td>
<td bgcolor="#FFFFFF" class="oe_form_group_cell">
<input name="dealer_code" type="text" id="dealer_code" value="<?=$dealer_code?>"/></td>
</tr>




<tr class="oe_form_group_row">
                  <td colspan="1" bgcolor="#E8E8E8" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp; Confirm Duration:</strong></td>

<td colspan="2" bgcolor="#E8E8E8" class="oe_form_group_cell">
<select name="PBI_CON_TYPE" id="PBI_CON_TYPE">
                    <option value="6" <?= ($PBI_CON_TYPE==6)?'selected':''?>>6 Monthes</option>
					<option value="3" <?= ($PBI_CON_TYPE==3)?'selected':''?>>3 Monthes</option>
					
					
                   <!-- <option value="0" <?= ($PBI_CON_TYPE==0)?'selected':''?>>Confirmed Position</option>-->
</select></td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><strong> Due Confirm Date </strong></td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="PBI_DUE_DOJ" type="text" id="PBI_DUE_DOJ" value="<?=$PBI_DUE_DOJ?>" /></td>
                </tr>
                <tr class="oe_form_group_row">
                  <td colspan="1" bgcolor="#FFFFFF" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Extended Upto :</strong></td>
                  <td colspan="2" bgcolor="#FFFFFF" class="oe_form_group_cell"><input name="extended_upto" type="text" id="extended_upto" value="<?=$extended_upto?>" />
                    Days</td>
                  <td bgcolor="#FFFFFF" class="oe_form_group_cell"><strong>Confirm Type:</strong></td>
                  <td bgcolor="#FFFFFF" class="oe_form_group_cell">
				  <select name="PBI_CON_POLICY" id="PBI_CON_POLICY">
                    <option ></option>
                    <option value="ACR" <?= ($PBI_CON_POLICY=='ACR')?'selected':''?>>ACR</option>
                    <option value="Policy" <?= ($PBI_CON_POLICY=='Policy')?'selected':''?>>Policy</option>
                  </select></td>
                </tr>
                <tr class="oe_form_group_row">
                  <td colspan="1" bgcolor="#E8E8E8" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp; Confirm Date :</strong></td>
                  <td colspan="2" bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="PBI_DOC2" type="text" id="PBI_DOC2" value="<?=$PBI_DOC2?>" /></td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label">Edu Qualification:</span></strong></td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><select name="PBI_EDU_QUALIFICATION">
                    <? foreign_relation('edu_qua','EDU_QUA_SHORT_NAME','EDU_QUA_SHORT_NAME',$PBI_EDU_QUALIFICATION,' 1 order by EDU_QUA_SHORT_NAME');?>
                  </select></td>
                </tr>
<!--                <tr class="oe_form_group_row">
                  <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp; Joining Date(PP):</strong></td>
                  <td colspan="2" class="oe_form_group_cell"><input name="PBI_DOJ_PP" type="text" id="PBI_DOJ_PP" value="<?=$PBI_DOJ_PP?>" /></td>
                  <td class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;&nbsp;Service Length (PP) :</span></strong></td>
                  <td class="oe_form_group_cell"><input name="PBI_SERVICE_LENGTH_PP" type="text" id="PBI_SERVICE_LENGTH_PP" value="<?=$PBI_SERVICE_LENGTH_PP?>" /></td>
                </tr>-->
<!--<tr class="oe_form_group_row">
                  <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp; Appointment Letter :</strong></td>
                  <td colspan="2" bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="PBI_APPOINTMENT_LETTER_NO" type="text" id="PBI_APPOINTMENT_LETTER_NO" value="<?=$PBI_APPOINTMENT_LETTER_NO?>" /></td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp; Appointment Date :</span></strong></td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="PBI_APPOINTMENT_LETTER_DATE" type="text" id="PBI_APPOINTMENT_LETTER_DATE" value="<?=$PBI_APPOINTMENT_LETTER_DATE?>" /></td>
</tr>-->
                
				<tr class="oe_form_group_row">
				  <td colspan="1" bgcolor="#FFFFFF" class="oe_form_group_cell oe_form_group_cell_label">&nbsp;</td>
				  <td colspan="2" bgcolor="#FFFFFF" class="oe_form_group_cell">&nbsp;</td>
				  <td bgcolor="#FFFFFF" class="oe_form_group_cell">&nbsp;</td>
				  <td bgcolor="#FFFFFF" class="oe_form_group_cell">&nbsp;</td>
				  </tr>
				<tr class="oe_form_group_row">
                  <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp; <span class="style1">Gender :</span></strong></td>
                  <td colspan="2" bgcolor="#E8E8E8" class="oe_form_group_cell"><select name="PBI_SEX">
                    <option selected><?=(isset($PBI_SEX))?$PBI_SEX:'Male';?></option>
                    <option>Male</option>
                    <option>Female</option>
                    </select></td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label">Marital Status :</span></strong></td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><select name="PBI_MARITAL_STA">
                    <option selected="selected">
                      <?=$PBI_MARITAL_STA?>
                      </option>
                    <option>Married</option>
                    <option>Unmarried</option>
                    </select></td>
                </tr>
                <tr class="oe_form_group_row">
                  <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Religion : </strong></td>
                  <td colspan="2" class="oe_form_group_cell"><select name="PBI_RELIGION">
                    <option selected><?=(isset($PBI_RELIGION))?$PBI_RELIGION:'Islam';?></option>
                    <option>Islam</option>
                    <option>Bahai</option>
                    <option>Buddhism</option>
                    <option>Christianity</option>
                    <option>Confucianism </option>
                    <option>Druze</option>
                    <option>Hinduism</option>
                    <option>Jainism</option>
                    <option>Judaism</option>
                    <option>Shinto</option>
                    <option>Sikhism</option>
                    <option>Taoism</option>
                    <option>Zoroastrianism</option>
                    <option>Others</option>
                  </select></td>
                  <td class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label">Nationality : </span></strong></td>
                  <td class="oe_form_group_cell"><select name="PBI_NATIONALITY">
                    <option selected="selected"><?=(isset($PBI_NATIONALITY))?$PBI_NATIONALITY:'Bangladeshi';?></option>
                    <option>Bangladeshi</option>
                    <option>Canadian</option>
                    <option>English</option>
                    <option>Indian</option>
                    <option>Pakistani</option>
                    <option>Nepali</option>
                    
                  </select></td>
                </tr>
                <tr class="oe_form_group_row">
                  <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Permanent Add :</strong></td>
                  <td colspan="2" bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="PBI_PERMANENT_ADD" type="text" id="PBI_PERMANENT_ADD" value="<?=$PBI_PERMANENT_ADD?>"/></td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label">Area of expertise :</span></strong></td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><span class="oe_form_field oe_datepicker_root oe_form_field_date">
                    <input name="PBI_SPECIALTY" type="text" id="PBI_SPECIALTY" value="<?=$PBI_SPECIALTY?>" />
                  </span></td>
                </tr>
                <tr class="oe_form_group_row">
                  <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Present Add :</strong></td>
                  <td colspan="2" class="oe_form_group_cell"><input name="PBI_PRESENT_ADD" type="text" id="PBI_PRESENT_ADD" value="<?=$PBI_PRESENT_ADD?>"/></td>
                  <td class="oe_form_group_cell"><strong>Institutes :</strong></td>
                  <td class="oe_form_group_cell"><select name="institute_id" id="institute_id">
                    <? foreign_relation('institute','institute_id','institute_name',$institute_id);?>
                  </select></td>
                </tr>
                <tr class="oe_form_group_row">
                  <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;<span class="style1">Mobile :</span></strong></td>
                  <td colspan="2" bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="PBI_MOBILE" type="text" id="PBI_MOBILE" value="<?=$PBI_MOBILE?>"/></td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><strong>Present file Status :</strong></td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><select name="personal_file_status" id="personal_file_status">
                    <option selected="selected">
                      <?=$personal_file_status?>
                      </option>
                      <option></option>
                    <option>Disciplinary Action</option>
                    <option>Separation</option>
                  </select></td>
                </tr>
                <tr class="oe_form_group_row">
                  <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Phone :</strong></td>
                  <td colspan="2" class="oe_form_group_cell"><input name="PBI_PHONE" type="text" id="PBI_PHONE" value="<?=$PBI_PHONE?>" /></td>
                  <td bgcolor="#FFFFFF" class="oe_form_group_cell"><strong><span class="style1">Job Location :</span></strong></td>
                  <td bgcolor="#FFFFFF" class="oe_form_group_cell">
				  <select name="JOB_LOCATION" id="JOB_LOCATION">
				  <? foreign_relation('office_location','ID','LOCATION_NAME',$JOB_LOCATION,'1');?>
                  </select>                  </tr>
                <tr class="oe_form_group_row">
                  <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;E-mail :</strong></td>
                  <td colspan="2" bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="PBI_EMAIL" type="text" id="PBI_EMAIL" value="<?=$PBI_EMAIL?>" /></td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label"><span class="style1">Job Status :</span></span></strong></td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell">
                  <select name="PBI_JOB_STATUS">
                    <option <?=($PBI_JOB_STATUS=='In Service')?'selected':'';?>>In Service</option>
                    <option <?=($PBI_JOB_STATUS=='Not In Service')?'selected':'';?>>Not In Service</option>
                  </select></td>
                  </tr>
                <tr class="oe_form_group_row">
                  <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label">&nbsp;</td>
                  <td colspan="2" class="oe_form_group_cell">&nbsp;</td>
                  <td class="oe_form_group_cell"><strong>Resign Type :</strong></td>
                  <td class="oe_form_group_cell">
				  <select name="resign_type" id="resign_type">
                    <option ></option>
                    <option value="Voluntary" <?= ($resign_type=='Voluntary')?'selected':''?>>Voluntary</option>
                    <option value="Without Information" <?= ($resign_type=='Without Information')?'selected':''?>>Without Information</option>
					<option value="Ask to Resign" <?= ($resign_type=='Ask to Resign')?'selected':''?>>Ask to Resign</option>
                  </select></td>
                </tr>
                <tr class="oe_form_group_row">
                  <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;National ID :</strong></td>
                  <td colspan="2" class="oe_form_group_cell"><input name="nid" type="text" id="nid" value="<?=$nid?>" /></td>
                  <td class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label"><span class="style1">Resign Date :</span></span></strong></td>
                  <td class="oe_form_group_cell"><input name="JOB_STATUS_DATE" type="text" id="JOB_STATUS_DATE" value="<?=$JOB_STATUS_DATE?>" /></td>
                </tr>
                <tr class="oe_form_group_row">
                  <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Held Up  :<?=$help_up_status?></strong></td>
                  <td colspan="2" bgcolor="#E8E8E8" class="oe_form_group_cell"><select name="held_up_status" id="held_up_status">
                    <option <?=($held_up_status=='0')?'Selected':'';?> value="0">No</option>
					<option <?=($held_up_status=='1')?'Selected':'';?> value="1">Yes</option>
                  </select></td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><strong>Held Up  Reason:</strong></td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="held_up_reason" type="text" id="held_up_reason" value="<?=$held_up_reason?>" /></td>
                </tr>
                <tr class="oe_form_group_row">
                  <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><span class="style1"><strong> Incharge ID: </strong></span></td>
                  <td colspan="2" bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="incharge_id" type="number" id="incharge_id" value="<?=$incharge_id?>"/></td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><strong>Department Head ID : </strong></td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="head_id" type="number" id="head_id" value="<?=$head_id?>"/></td>
                </tr>
                <tr class="oe_form_group_row">
                  <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label">&nbsp;</td>
                  <td colspan="2" bgcolor="#E8E8E8" class="oe_form_group_cell">&nbsp;</td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell">&nbsp;</td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell">&nbsp;</td>
                </tr>
                <tr class="oe_form_group_row">
                  <td colspan="1" bgcolor="#E8E8E8" class="oe_form_group_cell oe_form_group_cell_label style1">Roster Type :</td>
                  <td colspan="2" bgcolor="#E8E8E8" class="oe_form_group_cell">
				  
				  <select name="employee_type" id="employee_type">
                    <option selected="selected"><?=$employee_type?></option>
                    <option>Roster</option>
					<option>General Roster</option>
                    <option>Non Roster</option>
                    <option>Direct Portal</option>
                  </select></td>
				  
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell">Define Schedule: </td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><select name="define_schedule" id="define_schedule">
                      <? foreign_relation('hrm_schedule_info','id','schedule_name',$define_schedule,'id = "51"');?>
                  </select></td>
                </tr>
                <tr class="oe_form_group_row">
                  <td colspan="1" bgcolor="#E8E8E8" class="oe_form_group_cell oe_form_group_cell_label style1">Grace Type :</td>
                  <td colspan="2" bgcolor="#E8E8E8" class="oe_form_group_cell"><select name="grace_type" id="grace_type">
                      <option selected="selected">
                      <?=$grace_type?>
                      </option>
                      <option>No Grace</option>
					  <option>Single Punch Grace</option>
                      <option>General Grace</option>
                      <option>Production Grace</option>
                  </select></td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell">Define Offday: </td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell">
				  
				  <select name="define_offday" id="define_offday"> 
					  <option selected="selected"><?=$define_offday?></option>
                      <option>Friday</option>
                      <option>Saterday</option>
                      <option>Sunday</option>
                      <option>Monday</option>
                      <option>Tuesday</option>
                      <option>Wednesday</option>
                      <option>Thursday</option>
                  </select></td>
                </tr>
                <tr class="oe_form_group_row">
                  <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label">&nbsp;</td>
                  <td colspan="2" bgcolor="#E8E8E8" class="oe_form_group_cell">&nbsp;</td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell">Incentive Status: </td>
                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><select name="incentive_status" id="incentive_status">
				  <option><?=$incentive_status?></option>
                    <option>No</option>
                    <option>Yes</option>
                  </select></td>
                </tr>
                <tr class="oe_form_group_row">
                  <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong><span class="style1">Initial Job Type :</span></strong></td>
                  <td colspan="2" bgcolor="#E8E8E8" class="oe_form_group_cell"><select name="PBI_PRIMARY_JOB_STATUS">
                    <option selected>
                      <?=$PBI_PRIMARY_JOB_STATUS?>
                      </option>
                    <option <?=($PBI_PRIMARY_JOB_STATUS=='')? 'selected' : '' ?>>Provisional</option>
                    <option>Permanent</option>
                    <option>Project Staff</option>
                    <option>Contract Based</option>
                    <option>Work Based</option>
                    <option>Bigenner</option>
                    <option>Entry Level</option>
                    <option>Mid Level</option>
                    <option>Top Level</option>
                  </select></td>
<td bgcolor="#E8E8E8" class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label">Note:</span></strong></td>
<td bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="note" type="text" id="note" value="<?=$note?>"/></td>
 </tr>
                
				<tr class="oe_form_group_row">

<!--<td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;<strong>Staff Picture :</strong></strong></td>
<td colspan="2" bgcolor="#E8E8E8" class="oe_form_group_cell"><input type="file" name="pic" id="pic" accept="image/jpeg" /></td>-->
<!--<td bgcolor="#E8E8E8" class="oe_form_group_cell">&nbsp;</td>
<td bgcolor="#E8E8E8" class="oe_form_group_cell">&nbsp;</td>-->
                </tr>
                </tbody></table>
              <input name="PBI_DOC" type="hidden" id="PBI_DOC" value="<?=$PBI_DOC?>" /></td>
            <td colspan="1" class="oe_form_group_cell oe_group_right" width="100%">&nbsp;</td>
            </tr></tbody></table></div>
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