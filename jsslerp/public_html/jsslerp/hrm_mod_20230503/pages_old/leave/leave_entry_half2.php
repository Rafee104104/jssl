<?php
session_start();
ob_start();
require_once "../../config/inc.all.php";
do_calander('#s_date');
do_calander('#e_date');

//auto_complete_from_db('personnel_basic_info','concat(PBI_NAME,"-",PBI_ID)','PBI_ID','1 and PBI_ORG="'.$_SESSION["user"]["group"].'" 
//and PBI_JOB_STATUS = "In Service" and JOB_LOCATION not in("1","") ','PBI_ID');

function auto_dropdown($sql){
$res=mysql_query($sql);
while($data=mysql_fetch_row($res)){
if($value==$data[0])
echo '<option value="'.$data[0].'" selected>'.$data[1].'</option>';
else
echo '<option value="'.$data[0].'">'.$data[1].'</option>';
}}

if(isset($_POST['view_data']))
{		
$emp_id=$_POST['PBI_ID'];
$_SESSION['employee_selected'] = $emp_id;
}
$emp_id = $_SESSION['employee_selected'];

$head='<link href="../../css/report_selection.css" type="text/css" rel="stylesheet"/>';
if($_SESSION['employee_selected']>0)
$emp = find_all_field('personnel_basic_info','concat(PBI_NAME,"-",PBI_ID),PBI_NAME','PBI_ID='.$_SESSION['employee_selected']);
// ::::: Edit This Section ::::: 
$title='Leave Information';			// Page Name and Page Title

$page="leave_entry_half2.php";		// PHP File Name
$input_page="leave_entry_input.php";
$root='leave';

$table='hrm_leave_info';
$unique='id';
$shown='s_date';

// ::::: End Edit Section :::::

$crud      =new crud($table);

if(prevent_multi_submit()){
if(isset($_POST[$shown]))
{
$s_date= strtotime($_REQUEST['s_date']);
$e_date= strtotime($_REQUEST['s_date']);

for($i=$s_date; $i<=$e_date; $i+=86400){
$att_date=date('Y-m-d',$i);
$prev_lv=mysql_num_rows(mysql_query("select * from hrm_att_summary where emp_id='".$_SESSION['employee_selected']."' and att_date='".$att_date."' and leave_id >0"));}
if($prev_lv>0){
echo "<script>alert('You Can\'t Add Same Leave Twice')</script>";
}else{
$$unique = $_POST[$unique];
$_REQUEST['leave_status']='GRANTED';
$_REQUEST['e_date']=$_REQUEST['s_date'];

$_REQUEST['entry_at']=date('Y-m-d H:i:s');

$crud->insert();

$_GET['leave_id'] =  mysql_insert_id();
$full_leave = find_all_field('hrm_leave_info','','id='.$_GET['leave_id']);



for($i=$s_date; $i<=$e_date; $i+=86400){
$leave_duration = '0.5';
 $att_date=date('Y-m-d',$i);
$sql="select id from hrm_att_summary where emp_id='".$_POST['PBI_ID']."' and att_date='".$att_date."'";
$query=mysql_query($sql);
$num_rows=mysql_num_rows($query);
$data=mysql_fetch_object($query);

	if($num_rows>0){
$up_query="update hrm_att_summary set final_status='Leave',leave_id='".$full_leave->id."', leave_type='".$full_leave->type."', leave_reason='".$full_leave->reason."',leave_duration='".$leave_duration."', leave_approved_by='".$_SESSION['user']['id']."', leave_entry_at='".$full_leave->entry_at."', leave_entry_by='".$full_leave->PBI_ID."' where id=".$data->id;
	mysql_query($up_query);
	}else{
$ins_query="INSERT INTO hrm_att_summary( final_status,att_date, emp_id, leave_id, leave_type, leave_reason,leave_duration, leave_approved_by, leave_entry_at, leave_entry_by) VALUES ('Leave','".$att_date."','".$full_leave->PBI_ID."', '".$full_leave->id."', '".$full_leave->type."', '".$full_leave->reason."','".$leave_duration."',  '".$_SESSION['user']['id']."', '".$full_leave->entry_at."', '".$full_leave->PBI_ID."')";
	mysql_query($ins_query);
	}
}
}
}
}




?>
<script type="text/javascript"> function DoNav(lk){
return GB_show('ggg', '../pages/<?=$root?>/<?=$input_page?>?<?=$unique?>='+lk,600,940)
}</script>
<script type="text/javascript">
$(document).ready(function(){

  $("#e_date").change(function (){
     var from_leave = $("#s_date").datepicker('getDate');
     var to_leave = $("#e_date").datepicker('getDate');
    var days   = ((to_leave - from_leave)/1000/60/60/24)+1;

	if(days>0&&days<100){
	$("#total_days").val(days);}
  });
      $("#s_date").change(function (){
     var from_leave = $("#s_date").datepicker('getDate');
     var to_leave = $("#e_date").datepicker('getDate');
    var days   = ((to_leave - from_leave)/1000/60/60/24)+1;
	if(days>0&&days<100){
	$("#total_days").val(days);}
  });
    
  
});
 
</script>

<style type="text/css">
<!--
.style1 {font-size: 24px}
.style2 {
	color: #FFFFFF;
	font-size: 24px;
	font-weight: bold;
}
-->
</style>


<div class="oe_view_manager oe_view_manager_current">
      <form action="" method="post" enctype="multipart/form-data">  
    <? //include('../../common/title_bar.php');?>
    </form>

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
            <table width="80%" border="1" align="center">
              <tr>
                <td height="40" colspan="3" bgcolor="#00FF00"><div align="center" class="style1">Half Day Leave Entry</div></td>
                </tr>
<form action=""  method="post">	
              <tr>
                <td width="20%" ><div align="right">Employee Code : </div></td>
<td><select name="PBI_ID" id="PBI_ID" required="required">
  <option>
  <? if(isset($_POST['PBI_ID'])){ echo $_POST['PBI_ID']; }else{echo''; } ?>
  </option>
  <?php 
	auto_dropdown("select PBI_ID,concat(PBI_ID,'-',PBI_NAME) from personnel_basic_info 
	where PBI_ORG='".$_SESSION['user']['group']."' and PBI_JOB_STATUS = 'In Service' and JOB_LOCATION not in('1','','70')"); ?>
</select></td>
                <td><input name="view_data" type="submit" id="view_data" value="VIEW" /></td>
              </tr>
</form>             


<form action=""  method="post">		 
			  <tr>
                <td width="20%" ><div align="right">Employee Name : </div></td>
                <td><input name="PBI_ID"  type="hidden" id="PBI_ID" size="10" onblur="" tabindex="1" style="width:400px;" required="required" value="<?=$_SESSION['employee_selected']?>" readonly="readonly" />
                  <?=$_SESSION['employee_selected']?> - <?=$emp->PBI_NAME?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td align="right" bgcolor="#EBEBEB"><div align="right"> Type : </div></td>
                <td bgcolor="#EBEBEB"><select name="type" id="type">
                    <option></option>
                    <option selected="selected">Annual </option>
                    <option>LWP (Leave Without Pay)</option>
                    <!--			<option>Casual Leave</option>
				  <option>Sick Leave</option>
				  <option>Maternity Leave</option>  
				  <option>Compensatory Off</option>
				  <option>Special Leave (Leave With Pay)</option>-->
                  </select>                </td>
                <td bgcolor="#EBEBEB">&nbsp;</td>
              </tr>
			  
              <tr>
                <td align="right"><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;Leave Slot: </span></td>
                <td><span class="oe_form_group_cell">
                  <select name="half_or_full" id="half_or_full" required="required">
                    <option></option>
                    <option <?=($half_or_full=='First Half')?'Selected':'';?> >First Half</option>
                    <option <?=($half_or_full=='Last Half')?'Selected':'';?> >Last Half</option>
                  </select>
                </span></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td align="right"><div align="right">  Date :</div></td>
                <td><input type="hidden" name="total_days" id="total_days" style="width:100px;"  value=".5"/>
                    <input type="text" name="s_date" id="s_date" style="width:100px;" required="required"/>                </td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td bgcolor="#EBEBEB"><div align="right">Reason :</div></td>
                <td bgcolor="#EBEBEB"><label>
                  <input name="reason" type="text" id="reason" required="required"/>
                </label></td>
                <td bgcolor="#EBEBEB">&nbsp;</td>
              </tr>
              <tr>
                <td><div align="right">Paid Status : </div></td>
                <td><label>
                  <select name="paid_status" id="paid_status">
                    <option>Paid</option>
                    <option>Unpaid</option>
                  </select>
                </label></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3">
                    <div align="center">
                      <input name="search" type="submit" id="search" value="add" />
                    </div></td>
              </tr>
            </table>
			<? if($emp->PBI_DOC<date('Y-m-d')){?>
            <table width="60%" border="0" align="center">
              <tr>
                <td align="center">&nbsp;</td>
                </tr>
              <tr>
                <td align="center">&nbsp;</td>
                </tr>
            </table>
            <? }?>
            <br /><div style="text-align:center">
              <div class="oe_form_sheetbg">
        <div class="oe_form_sheet oe_form_sheet_width">

          <div class="oe_view_manager_view_list"><div class="oe_list oe_view">
<? if($_SESSION['employee_selected']>0){
$res = "select o.id,a.PBI_ID,a.PBI_ID,a.PBI_NAME,o.leave_status as status,o.type,o.s_date as start_date, o.e_date as end_date,o.half_or_full as slot,o.total_days from personnel_basic_info a,hrm_leave_info o where  a.PBI_ID=o.PBI_ID and  a.PBI_ID='".$_SESSION['employee_selected']."' 
and s_date >= '2017-12-26'
order by o.id desc";

echo $crud->link_report($res,$link='');

//a.PBI_DESIGNATION=c.DESG_ID and a.PBI_DEPARTMENT=d.DEPT_ID  and ;   
}         
 ?>
</div></div>
          </div>
    </div>

  </div></div></div>
          </div>
    </div>
    <div class="oe_chatter"><div class="oe_followers oe_form_invisible">
      <div class="oe_follower_list"></div>
    </div></div></div></div></div>
    </div></div>
            
        </div>
 </form>   </div>

<?
$main_content=ob_get_contents();
ob_end_clean();
include ("../../template/main_layout.php");
?>