

<?php



session_start();

ob_start();

require_once "../../../assets/support/inc.all.php";



$title="Machine Data Syn (General)";





do_calander('#m_date');





if($_POST['mon']!='')	$mon=$_POST['mon'];

else					$mon=date('n');













if(isset($_POST["upload"]))

{

if($_POST['s_date']!='' && $_POST['e_date']!=''){



$start_date = date('Y-m-d',strtotime($_POST['s_date']));

$end_date = date('Y-m-d',strtotime($_POST['e_date']));



$date_con = " and h.xdate BETWEEN '".$start_date."' AND '".$end_date."'";

}



// Schedule Info Fetch All



 $sql = 'select * from hrm_schedule_info';

$query  =mysql_query($sql);

while($data=mysql_fetch_object($query)){

    $sch_start[$data->id] = $data->office_start_time;

    $sch_end[$data->id] = $data->office_end_time;

    $sch_mid[$data->id] = $data->office_mid_time;

}



// Roster Schedule Fetch All

 $sql = "select * from hrm_roster_allocation where roster_date  BETWEEN '".$start_date."' AND '".$end_date."' ";

$query  =mysql_query($sql);

while($data=mysql_fetch_object($query)){

    $roster_assign[$data->PBI_ID][$data->roster_date] = $data->shedule_1;

}



$datetime = date('Y-m-d H:i:s');









$_POST['emp_id'] = find_a_field('personnel_basic_info','PBI_ID','PBI_CODE="'.$_POST['emp_id'].'"');







if($_POST['emp_id']>0) 	$emp_id=$_POST['emp_id'];



$PBI_ORG = $_POST['PBI_ORG'];



if($_POST['JOB_LOCATION']>0) $job_location_con = " and p.JOB_LOC_ID='".$_POST['JOB_LOCATION']."'";



$PBI_ORG = $_POST['PBI_ORG'];



if($PBI_ORG>0) $ORG_con = " and p.PBI_ORG='".$PBI_ORG."'";







if(isset($emp_id)){$emp_id_con=" and EMP_CODE IN (".$_POST['emp_id'].")";}



$sql = "delete h.* FROM hrm_att_summary h, personnel_basic_info p

WHERE p.PBI_ID=h.emp_id 

and iom_sl_no = 0 and leave_id = 0

and h.att_date BETWEEN '".$start_date."' AND '".$end_date."' 

".$emp_id_con.$job_location_con.$ORG_con;

$query = mysql_query($sql);







 $sql = "SELECT h.EMP_CODE , h.xdate , min(h.xtime) in_time, max(h.xtime) out_time,p.schedule_type,p.PBI_ID

FROM hrm_attdump h, personnel_basic_info p

WHERE  h.EMP_CODE = p.PBI_ID ".$date_con.$emp_id_con.$job_location_con.$ORG_con."

GROUP BY h.EMP_CODE , h.xdate";

	$query = mysql_query($sql);



	while($data = mysql_fetch_object($query))



	{

	if($roster_assign[$data->PBI_ID][$data->xdate]<1)

	$value[$sl]['sch_in_time']  = $office_in_times  = $sch_start[$data->schedule_type];

	else  $value[$sl]['sch_in_time']  = $office_in_times  = $sch_start[$roster_assign[$data->PBI_ID][$data->xdate]];

	

	if($roster_assign[$data->PBI_ID][$data->xdate]<1)

	$value[$sl]['sch_out_time'] = $office_out_times = $sch_end[$data->schedule_type];

	else echo $value[$sl]['sch_out_time']  = $office_in_times  = $sch_end[$roster_assign[$data->PBI_ID][$data->xdate]];

	

	

	$sl++;



	$value[$sl]['emp_id'] = $data->EMP_CODE;



	$value[$sl]['att_date'] = $data->xdate;







	 $value[$sl]['in_time'] = $data->in_time;

	if($data->in_time!=$data->out_time)

	 $value[$sl]['out_time'] = $data->out_time;

	

	



	}







for($x=1;$x<=$sl;$x++)



{



			$found = find_a_field('hrm_att_summary','1','emp_id="'.$value[$x]['emp_id'].'" and att_date="'.$value[$x]['att_date'].'"');



		



			if($found==0)



			{



				 $sql="INSERT INTO hrm_att_summary 



				(emp_id, att_date, in_time, out_time, dayname,sch_in_time,sch_out_time)



				VALUES 



('".$value[$x]['emp_id']."','".$value[$x]['att_date']."','".$value[$x]['in_time']."','".$value[$x]['out_time']."', dayname('".$value[$x]['att_date']."'), 
'".$value[$x]['sch_in_time']."','".$value[$x]['sch_out_time']."')";



				$query=mysql_query($sql);



			}



			else



			{



				$sql='update hrm_att_summary set 



in_time="'.$value[$x]['in_time'].'", out_time="'.$value[$x]['out_time'].'", sch_in_time="'.$value[$x]['sch_in_time'].'",sch_out_time="'.$value[$x]['sch_out_time'].'" 
where  emp_id="'.$value[$x]['emp_id'].'" and att_date="'.$value[$x]['att_date'].'" ';



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







<div class="oe_view_manager oe_view_manager_current">



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



<tr>



 <td>Location:</td>



  <td colspan="3"><span class="oe_form_group_cell">



    <select name="JOB_LOCATION" style="width:160px;" id="JOB_LOCATION">

	 <option></option>



      <? foreign_relation('job_location_type','id','job_location_name',$JOB_LOCATION,'id=1');?>



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



                    <input name="upload" class="btn btn-success" type="submit" id="upload" value="Sync All Data" />



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



</form></div>





<?



$main_content=ob_get_contents();

ob_end_clean();

include ("../../template/main_layout.php");



?>









