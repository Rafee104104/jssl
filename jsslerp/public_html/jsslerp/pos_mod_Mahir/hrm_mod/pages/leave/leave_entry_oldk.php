<?php



require_once "../../../assets/template/layout.top.php";



do_calander('#s_date');



do_calander('#e_date');



$head='<link href="../../css/report_selection.css" type="text/css" rel="stylesheet"/>';



if($_SESSION['employee_selected']>0)



$emp = find_all_field('personnel_basic_info','concat(PBI_NAME,"-",PBI_ID)','PBI_ID='.$_POST['employee_selected']);


$essentialInfo = find_all_field('personnel_basic_info','','PBI_ID='.$_POST['employee_selected']);




// ::::: Edit This Section ::::: 



$title='Leave Information';			// Page Name and Page Title



$page="leave_entry.php";		// PHP File Name



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



$$unique = $_POST[$unique];



$_POST['entry_at']=date('Y-m-d H:i:s');



$_POST['leave_status']='GRANTED';



$s_date= strtotime($_REQUEST['s_date']);



$e_date= strtotime($_REQUEST['e_date']);



$_POST['leave_apply_date'] = date('Y-m-d');



$old_leave = find_a_field('hrm_att_summary','leave_id',' att_date between "'.$_REQUEST['s_date'].'" and  "'.$_REQUEST['e_date'].'" and  emp_id="'.$_SESSION['employee_selected'].'" and leave_id>0');







if($old_leave == 0)



{







$crud->insert();



$_GET['leave_id'] =  mysql_insert_id();



$full_leave = find_all_field('hrm_leave_info','','id='.$_GET['leave_id']);















for($i=$s_date; $i<=$e_date; $i+=86400){



if($full_leave->half_or_full=="half")



$leave_duration = '0.5';



else



$leave_duration = '1.0';







$att_date=date('Y-m-d',$i);



$sql="select id from hrm_att_summary where emp_id='".$_POST['PBI_ID']."' and att_date='".$att_date."'";



$query=mysql_query($sql);



$num_rows=mysql_num_rows($query);



$data=mysql_fetch_object($query);



	if($num_rows>0){



	$up_query="update hrm_att_summary set leave_id='".$full_leave->id."', leave_type='".$full_leave->half_or_full."', leave_reason='".$full_leave->reason."',leave_duration='".$leave_duration."', leave_approved_by='".$_SESSION['user']['id']."', leave_entry_at='".$full_leave->entry_at."', leave_entry_by='".$full_leave->PBI_ID."' where id=".$data->id;



	mysql_query($up_query);



	}else{



 $ins_query="INSERT INTO hrm_att_summary( att_date, emp_id, leave_id, leave_type, leave_reason, leave_duration,leave_approved_by, leave_entry_at, leave_entry_by) VALUES ('".$att_date."','".$full_leave->PBI_ID."', '".$full_leave->id."', '".$full_leave->half_or_full."', '".$full_leave->reason."','".$leave_duration."', '".$_SESSION['user']['id']."', '".$full_leave->entry_at."', '".$full_leave->PBI_ID."')";



	mysql_query($ins_query);



	}



}



}



else echo $msggg= "<h2 style='color:#FF0000'>You Can't Add Duplicate Leave</h2>";;



}



}























?>
<!--<script type="text/javascript"> function DoNav(lk){



var win = window.open('leave_entry_input.php?id='+lk);



  win.focus();



}</script>-->
<script type="text/javascript"> function DoNav(lk){



	return GB_show('ggg', '../../hrm_mod/pages/leave/leave_entry_input.php?id='+lk,600,940)



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
    <? include('../../common/title_bar.php');?>
  </form>
  <form action=""  method="post">
    <div class="oe_view_manager_body">
      <div  class="oe_view_manager_view_list"></div>
      <div class="oe_view_manager_view_form">
        <div style="opacity: 1;" class="oe_formview oe_view oe_form_editable">
          <div class="oe_form_buttons"></div>
          <div class="oe_form_sidebar"></div>
          <div class="oe_form_pager"></div>
          <div class="oe_form_container">
            <div class="oe_form">
              <div class="">
                <div class="oe_form_sheetbg">
                  <div class="oe_form_sheet oe_form_sheet_width">
                    <div  class="oe_view_manager_view_list">
                      <div  class="oe_list oe_view">
                        <table   align="center" class="table table-bordered table-sm">
                          <tr>
                            <td  colspan="4" bgcolor="#00FF00"><div align="center">Leave Information  Entry </div></td>
                          </tr>
                          <tr>
                            <td width="20%" ><div align="right">Employee Name : </div></td>
                            <td><?=$emp->PBI_NAME.' - '.$emp->PBI_ID;?>
                              <input name="PBI_ID"  type="hidden" id="PBI_ID" size="10" onblur="" tabindex="1" style="width:400px;" required value="<?=$_SESSION['employee_selected']?>"                readonly="readonly" /></td>
                            <td align="right" ><div align="right"> Type : </div></td>
                            <td ><select name="type" id="type" required>
                                <option value=""></option>
                             
                                <option value="1">Casual Leave (CL)</option>
                                <option value="2">Sick Leave (SL)</option>
                                <option  value="3">Annual Leave (AL)</option>
                                <option value="4">Marriage Leave (ML)</option>
                                <option value="5">Maternity Leave (MLV)</option>
                                <option value="6">Paternity Leave (PL)</option>
                                <option value="7">Hajj Leave</option>
                                <option value="8" >Extra Ordinary Leave (EOL)</option>
                                <option value="9">Leave Without Pay (LWP)</option>
                          
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td align="right"><div align="right"> Start Date :</div></td>
                            <td><input type="text" name="s_date" id="s_date" style="width:100px;"  class="form-control"/></td>
                            <td align="right" ><div align="right"> End Date :</div></td>
                            <td ><input type="text" name="e_date" id="e_date" style="width:100px;"  class="form-control"/></td>
                          </tr>
                          <tr>
                            <td><div align="right">Total  Days : </div></td>
                            <td><input type="text" name="total_days" id="total_days" style="width:100px;" readonly="" required="required"  class="form-control"/></td>
                            <td ><div align="right">Reason :</div></td>
                            <td ><label>
                              <input name="reason" type="text" id="reason"  class="form-control"/>
                              </label></td>
                          </tr>
                          <tr>
                            <td><div align="right">Paid Status : </div></td>
                            <td><label>
                              <select name="paid_status" id="paid_status" class="form-control">
                                <option>Paid</option>
                                <option>Unpaid</option>
                              </select>
                              </label></td>
                            <td colspan="2"><div align="center">
                                <input name="search" type="submit" id="search" class="btn btn-danger" value="SUBMIT" />
                              </div></td>
                          </tr>
                        </table>
                        <br />
                        <!--LEAVE BALANCE -->
                        <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" style="border-color:#ccc">
                          <?



$g_s_date=date('Y-01-01');
$g_e_date=date('Y-12-31');

//$essentialInfo = find_all_field('personnel_basic_info','','PBI_ID='.$_POST['employee_selected']);

$emp_id = find_a_field('hrm_leave_info','PBI_ID','PBI_ID='.$_POST['employee_selected']);
$leave_days_casual=find_a_field('hrm_leave_info','sum(total_days)','type=1 and leave_status="GRANTED" and s_date>="'.$g_s_date.'" and e_date<="'.$g_e_date.'"   and PBI_ID='.$emp_id);
$leave_days_sick=find_a_field('hrm_leave_info','sum(total_days)','type=2 and leave_status="GRANTED" and s_date>="'.$g_s_date.'" and e_date<="'.$g_e_date.'"   and PBI_ID='.$emp_id);
$leave_days_annual=find_a_field('hrm_leave_info','sum(total_days)','type=3 and leave_status="GRANTED" and s_date>="'.$g_s_date.'" and e_date<="'.$g_e_date.'"   and PBI_ID='.$emp_id);
$leave_days_marrige=find_a_field('hrm_leave_info','sum(total_days)','type=4 and leave_status="GRANTED" and s_date>="'.$g_s_date.'" and e_date<="'.$g_e_date.'"   and PBI_ID='.$emp_id);
$leave_days_maternity=find_a_field('hrm_leave_info','sum(total_days)','type=5 and leave_status="GRANTED" and s_date>="'.$g_s_date.'" and e_date<="'.$g_e_date.'"   and PBI_ID='.$emp_id);
$leave_days_paternity=find_a_field('hrm_leave_info','sum(total_days)','type=6 and leave_status="GRANTED" and s_date>="'.$g_s_date.'" and e_date<="'.$g_e_date.'"   and PBI_ID='.$emp_id);
$leave_days_Hajj=find_a_field('hrm_leave_info','sum(total_days)','type=7 and leave_status="GRANTED" and s_date>="'.$g_s_date.'" and e_date<="'.$g_e_date.'"   and PBI_ID='.$emp_id);
$leave_days_half=find_a_field('hrm_leave_info','sum(total_days)','type="Short Leave (SHL)" and leave_status="Granted" and half_leave_date>="'.$g_s_date.'" and 
half_leave_date<="'.$g_e_date.'"   and PBI_ID='.$emp_id);
$leave_days_EOL=find_a_field('hrm_leave_info','sum(total_days)','type=8 and leave_status="GRANTED" and s_date>="'.$g_s_date.'" and e_date<="'.$g_e_date.'"   and PBI_ID='.$emp_id);
?>
                          <tr>
                            <td colspan="11"  bgcolor="#FFFFFF" style="background:#2299C3; color:#FFFFFF;"><div align="center" class="style1">Leave Status of
                                <?=find_a_field('personnel_basic_info','PBI_NAME','PBI_ID='.$emp_id)?>
                                for <?php echo date('Y')?></div></td>
                          </tr>
                          <tr style="background:#f1f1f0" height="60">
                            <td width="118" align="center" valign="middle"><strong><span class="style10">
                              <div align="center" style="margin-top:15px">Type</div>
                              </span></strong></td>
                            <td width="101" align="center" valign="middle"><strong><span class="style10">
                              <div align="center" style="margin-top:15px">Casual Leave (CL)</div>
                              </span></strong></td>
                            <td width="130" align="center" valign="middle"><div align="center" style="margin-top:15px"><strong><span class="style10">
                                <div align="center">Sick Leave (SL)</div>
                                </span></strong></div></td>
                            <td width="98" align="center" valign="middle"><div align="center" style="margin-top:13px"><strong><span class="style10">
                                <div align="center">Annual Leave (AL)</div>
                                </span></strong></div></td>
                            <td width="109" align="center" valign="middle"><strong><span class="style10">
                              <div align="center" style="margin-top:15px">Short Leave (SHL)</div>
                              </span></strong></td>
                            <td width="127" align="center" valign="middle"><div align="center" style="margin-top:15px"><strong><span class="style10">
                                <div align="center"><strong>Marriage Leave</strong></div>
                                </span></strong></div></td>
                            <?
if($PBI->PBI_SEX=="Female"){
 ?>
                            <td width="125" align="center" valign="middle"><div align="center" style="margin-top:15px"><strong><span class="style10">Maternity Leave (ML)</span></strong></div></td>
                            <? } else{?>
                            <td width="125" align="center" valign="middle"><div align="center" style="margin-top:15px"><strong><span class="style10">Paternity Leave (PL)</span></strong></div></td>
                            <? } ?>
                            <td width="127" align="center" valign="middle"><div align="center" style="margin-top:15px"><strong><span class="style10">Hajj Leave </span></strong></div></td>
                            <td width="103" align="center" valign="middle"><div align="center"><strong><span class="style10">
                                <div align="center">Leave <br>
                                  Without Pay (LWP)</div>
                                </span></strong></div></td>
                            <td width="125" align="center" valign="middle"><div align="center"><strong><span class="style10">
                                <div align="center" style="margin-top:10px">Extra Ordinary Leave (EOL)</div>
                                </span></strong></div></td>
                          </tr>
						  
						  
						  <tr>
                            <td width="118" height="23" align="center" valign="middle"><div align="center">Total Leave</div></td>
                            <td width="101" align="center" valign="middle"><div align="center"><span class="style9">10</span></div></td>
                            <td width="130"  ><div align="center"><span class="style9">14</span></div></td>
                            <td width="98"  ><span class="style9"></span></td>
                            <td width="109" ><span class="style9"></span></td>
                            <td width="103"  ><span class="style9"></span></td>
                            <td width="127"  >&nbsp;</td>
                            <td width="127"  >&nbsp;</td>
                            <td width="125" >&nbsp;</td>
                            <td width="125"  >&nbsp;</td>
                          </tr>
						  
						  
						  
						  
						  
						  
						  <tr>
                            <td width="118" height="25" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center" ><span class="style4"><strong>Leave Entry</strong></span></div></td>
                            <td width="101" height="25" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center" ><span class="style4">
                                <?=$leave_days_casual?>
                                </span></div></td>
                            <td width="130" height="25" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center" ><span class="style4">
                                <?=$leave_days_sick?>
                                </span></div></td>
                            <td width="98" height="25" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center" ><span class="style4">
                                <?=0-$leave_days_annual?>
                                </span></div></td>
                            <td width="109" height="25" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center" >
                                <?=0-$leave_days_half?>
                              </div></td>
                            <td width="125" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center" >
                                <?=0-$leave_days_marrige?>
                              </div></td>
                            <?
									 if($PBI->PBI_SEX=="Female"){
									
									?>
                            <td width="127" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center">
                                <?=$leave_days_maternity?>
                              </div></td>
                            <? }else{ ?>
                            <td width="127" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center">
                                <?=0-$leave_days_paternity?>
                              </div></td>
                            <? } ?>
                            <td width="125" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center">
                                <?=0-$leave_days_Hajj?>
                              </div></td>
                            <td width="103" height="25" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center">
                                <?=$leave_days_lwp?>
                              </div></td>
                            <td width="130" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center">
                                <?=$leave_days_EOL?>
                              </div></td>
                          </tr>
						  
						  
						  
						  
						  
						  
						  
                          <tr>
                            <td width="118" height="25" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center" ><span class="style4"><strong>Balance</strong></span></div></td>
                            <td width="101" height="25" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center" ><span class="style4">
                                <?=10-$leave_days_casual?>
                                </span></div></td>
                            <td width="130" height="25" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center" ><span class="style4">
                                <?=14-$leave_days_sick?>
                                </span></div></td>
                            <td width="98" height="25" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center" ><span class="style4">
                                <?=0-$leave_days_annual?>
                                </span></div></td>
                            <td width="109" height="25" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center" >
                                <?=0-$leave_days_half?>
                              </div></td>
                            <td width="125" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center" >
                                <?=0-$leave_days_marrige?>
                              </div></td>
                            <?
									 if($PBI->PBI_SEX=="Female"){
									
									?>
                            <td width="127" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center">
                                <?=180-$leave_days_maternity?>
                              </div></td>
                            <? }else{ ?>
                            <td width="127" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center">
                                <?=0-$leave_days_paternity?>
                              </div></td>
                            <? } ?>
                            <td width="125" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center">
                                <?=0-$leave_days_Hajj?>
                              </div></td>
                            <td width="103" height="25" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center">
                                <?=$leave_days_lwp?>
                              </div></td>
                            <td width="130" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center">
                                <?=$leave_days_EOL?>
                              </div></td>
                          </tr>
                          <tr bgcolor="#2299C3">
                            <td width="118" height="23" align="center" valign="middle"><div align="center"></div></td>
                            <td width="101" align="center" valign="middle"><div align="center"><span class="style9"></span></div></td>
                            <td width="130"  ><div align="center"><span class="style9"></span></div></td>
                            <td width="98"  ><span class="style9"></span></td>
                            <td width="109" ><span class="style9"></span></td>
                            <td width="103"  ><span class="style9"></span></td>
                            <td width="127"  >&nbsp;</td>
                            <td width="127"  >&nbsp;</td>
                            <td width="125" >&nbsp;</td>
                            <td width="125"  >&nbsp;</td>
                          </tr>
                        </table>
                        <div style="text-align:center">
                          <div class="oe_form_sheetbg">
                            <div class="oe_form_sheet oe_form_sheet_width">
                              <div class="oe_view_manager_view_list">
                                <div class="oe_list oe_view"> </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="oe_chatter">
                  <div class="oe_followers oe_form_invisible">
                    <div class="oe_follower_list"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<?



require_once "../../../assets/template/layout.bottom.php";



?>
