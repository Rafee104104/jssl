<?php







require_once "../../../assets/template/layout.top.php";

$title="Machine Data Sync (General)";



do_calander('#m_date');



$head='<link href="../../css/report_selection.css" type="text/css" rel="stylesheet"/>';







$table='hrm_inout';



$unique='id';







if($_POST['mon']!=''){



$mon=$_POST['mon'];}



else{



$mon=date('n');



}











if(isset($_POST["upload"]))



{



$year = $_POST['year'];



$mon = $_POST['mon'];



if($mon == 1)



{



$syear = $year - 1;



$smon = 12;



}



else



{



$syear = $year;



$smon =  $mon - 1;



}







$datetime = date('Y-m-d H:i:s');







$start_date = $syear.'-'.($mon).'-01';



//$start_date = '2018-02-26';







$startTime = $days1 = strtotime($start_date);



$days_mon = date('t',$startTime);







$end_date   = $year.'-'.($mon).'-31';



//$end_date   = '2018-03-25';











$endTime = $days2=mktime(0,0,0,$mon,26,$year);







for ($i = $startTime; $i <= $endTime; $i = $i + 86400) {



$day   = date('l',$i);



${'day'.date('N',$i)}++;} 



$r_count=${'day5'};







if($_POST['emp_id']>0) 	$emp_id=$_POST['emp_id'];



$PBI_ORG = $_POST['PBI_ORG'];



if($PBI_ORG>0) $ORG_con = " and p.PBI_ORG='".$PBI_ORG."'";







if(isset($emp_id)){$emp_id_con=" and EMP_CODE IN (".$_POST['emp_id'].")";}



if($_POST['s_date']!='' && $_POST['e_date']!=''){







$start_date = date('Y-m-d',strtotime($_POST['s_date']));



$end_date = date('Y-m-d',strtotime($_POST['e_date']));



$date_con = " and h.xdate BETWEEN '".$start_date."' AND '".$end_date."'";



}





 $sql = "SELECT h.EMP_CODE , h.xdate , min(h.xtime) in_time, max(h.xtime) out_time



FROM hrm_attdump h, personnel_basic_info p



WHERE  h.EMP_CODE = p.PBI_ID ".$date_con.$emp_id_con." ".$ORG_con."



GROUP BY h.EMP_CODE , h.xdate";







	$query = mysql_query($sql);



	while($data = mysql_fetch_object($query))



	{



	//$office_in_times = find_a_field('employee_type','in_time','employee_type="'.$data->employee_type.'"');



	//$office_out_times = find_a_field('employee_type','out_time','employee_type="'.$data->employee_type.'"');

	//$office_in_times = find_a_field('office_timing','in_time','employee_type="'.$data->employee_type.'" and section_id="'.$data->SECTION_ID.'"');



	//$office_out_times = find_a_field('office_timing','out_time','employee_type="'.$data->employee_type.'" and section_id="'.$data->SECTION_ID.'"');

	

	//New office time settings
	
	//$office_in_times = find_a_field('office_timing','in_time','employee_type="'.$data->employee_type.'"');

	$office_in_times = find_a_field('office_timing','in_time','1');



	$office_out_times = find_a_field('office_timing','out_time','1');

	

	

	$sl++;



	$value[$sl]['emp_id'] = $data->EMP_CODE;



	$value[$sl]['att_date'] = $data->xdate;



	$value[$sl]['in_time'] = $data->in_time;



	$value[$sl]['out_time'] = $data->out_time;



	$value[$sl]['sch_in_time'] = $office_in_times;



	$value[$sl]['sch_out_time'] = $office_out_times;



	}







for($x=1;$x<=$sl;$x++)



{



			$found = find_a_field('hrm_att_summary','1','emp_id="'.$value[$x]['emp_id'].'" and att_date="'.$value[$x]['att_date'].'"');



		



			if($found==0)



			{



				 $sql="INSERT INTO hrm_att_summary 



				(emp_id, att_date, in_time, out_time, iom_entry_at, iom_entry_by, dayname,sch_in_time,sch_out_time)



				VALUES 



('".$value[$x]['emp_id']."','".$value[$x]['att_date']."', '".$value[$x]['in_time']."', '".$value[$x]['out_time']."', '".$datetime."', '".$_SESSION['user']['id']."', 





dayname('".$value[$x]['att_date']."'), '".$value[$x]['sch_in_time']."','".$value[$x]['sch_out_time']."')";



				$query=mysql_query($sql);



			}



			else



			{



				$sql='update hrm_att_summary set 



in_time="'.$value[$x]['in_time'].'", out_time="'.$value[$x]['out_time'].'", iom_entry_by="'.$value[$x]['emp_id'].'", iom_entry_at="'.$datetime.'",sch_in_time="'.$value[$x]['sch_in_time'].'",sch_out_time="'.$value[$x]['sch_out_time'].'" where  emp_id="'.$value[$x]['emp_id'].'" and att_date="'.$value[$x]['att_date'].'" ';



				$query=mysql_query($sql);



			}



}











echo 'Complete';



}



?>











<style type="text/css">



<!--



.style1 {font-size: 24px}



.style2 {



	color: #FF66CC;



	font-weight: bold;



}



-->



</style>







<form action=""  method="post" enctype="multipart/form-data">



    <div class="d-flex justify-content-center">



        <div class="n-form1 fo-width pt-0">

            <h4 class="text-center bg-titel bold pt-2 pb-2"> Collect Machine Data Factory  </h4>

            <div class="container-fluid p-0">

                <div class="row">

                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">

                        <div class="form-group row  m-0 mb-1 pl-3 pr-3">

                            <label for="group_for" class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Employee Code :  </label>

                            <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0 pr-2">

                                <input type="text" name="emp_id" id="emp_id" value="<?=$_POST['emp_id']?>" />

                            </div>

                        </div>

                    </div>



                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">



                        <div class="form-group row m-0 mb-1 pl-3 pr-3">

                            <label for="group_for" class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Company :    </label>

                            <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0 pr-2">

                                <select name="PBI_ORG"  id="PBI_ORG">



							  <? foreign_relation('user_group','id','group_name',$PBI_ORG);?>

						

							</select>

                            </div>

                        </div>



                    </div>





                    





                    







                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">

                                <div class="form-group row m-0 mb-1 pl-3 pr-3">

                                    <label for="group_for" class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Start Date :    </label>

                                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0 pr-2">

                                        <input type="date" name="s_date" id="s_date" value="<?=$_POST['s_date']?>" />



                                    </div>

                                </div>

                            </div>



                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">

                                <div class="form-group row m-0 mb-1 pl-3 pr-3">

                                    <label for="group_for" class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">End Date :    </label>

                                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0 pr-2">



                                        <input type="date" name="e_date" id="e_date" value="<?=$_POST['e_date']?>" />



                                    </div>

                                </div>

                            </div>







                </div>





                <div class="n-form-btn-class">

                    <input name="upload" class="btn1 btn1-bg-submit" type="submit" id="upload" value="Sync All Data" />

                </div>



            </div>



        </div>



    </div>





    





</form>











<?php /*?><div class="oe_view_manager oe_view_manager_current">



<form action=""  method="post" enctype="multipart/form-data">



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



<tr><td height="40" colspan="4" bgcolor="#00FF00"><div align="center" class="style1">Collect Machine Data </div></td></tr>







<tr>



  <td>Employee Code </td>



  <td colspan="3"><input type="text" name="emp_id" id="emp_id" value="<?=$_POST['emp_id']?>" /></td>



</tr>



<tr>



 <td>Company:</td>



  <td colspan="3"><span class="oe_form_group_cell">



    <select name="PBI_ORG" style="width:160px;" id="PBI_ORG">



      <? foreign_relation('user_group','id','group_name',$PBI_ORG);?>



    </select>



  </span></td>



</tr>



<!--<tr>



<td width="20%">Month :</td>



<td colspan="3"><span class="oe_form_group_cell">



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



                </tr>-->



              <!--<tr>



                <td>Year :</td>



                <td colspan="3"><select name="year" style="width:160px;" id="year" required="required">



				  <option <?=($year=='2021')?'selected':''?>>2021</option>



                </select></td>



                </tr>-->



				



				<tr>



                <td>Start Date:</td>



                <td colspan="3"><input type="date" name="s_date" id="s_date" value="<?=$_POST['s_date']?>" /></td>



                </tr>



				



				<tr>



                <td>End Date:</td>



                <td colspan="3"><input type="date" name="e_date" id="e_date" value="<?=$_POST['e_date']?>" /></td>



                </tr>



              



              <tr>







                <td colspan="4">



                  <div align="center">



                    <input name="upload" class="btn1 btn1-bg-submit" type="submit" id="upload" value="Sync All Data" />



                  </div></td>



                </tr>











              <tr>







                <td colspan="4"><label>







                    <div align="center">



                      <p>&nbsp;</p>



                      </div>







                    </label></td>



              </tr>



            </table>







            <br />



          </div>



          </div>







          </div>







    </div>







<div class="oe_chatter"><div class="oe_followers oe_form_invisible">



<div class="oe_follower_list"></div>



</div></div></div></div></div>



</div></div>



</div>



</form></div><?php */?>















<?



require_once "../../../assets/template/layout.bottom.php";



?>