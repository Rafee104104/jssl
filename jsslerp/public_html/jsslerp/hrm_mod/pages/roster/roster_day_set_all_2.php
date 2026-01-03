<?php
session_start();
ob_start();
require_once "../../../assets/support/inc.all.php";

$head='<link href="../../css/report_selection.css" type="text/css" rel="stylesheet"/>';

do_calander('#roster_date');

$title='Roster Day Set For 7 Days'; 

if(isset($_POST['save']))
{		
		//if($_POST['designation']>0) $con .=' and a.PBI_DESIGNATION='.$_POST['designation'];
		if($_POST['department']>0) 		$con .=' and a.DEPT_ID='.$_POST['department'];
		if($_POST['job_location']>0) 	$con .=' and a.JOB_LOCATION='.$_POST['job_location'];
		if($_POST['group_for']>0) 		$con .=' and a.PBI_ORG='.$_POST['group_for'];
		if($_POST['PBI_DOMAIN']!='')	$con .=' and a.PBI_DOMAIN="'.$_POST['PBI_DOMAIN'].'"';
		
		 $sql = "select a.PBI_NAME,a.PBI_ID,a.PBI_DESIGNATION,d.DEPT_DESC as PBI_DEPARTMENT from 
		personnel_basic_info a,department d
		where  1 ".$con." and d.DEPT_ID=a.DEPT_ID  and a.PBI_JOB_STATUS='In Service' order by a.PBI_ID ";
		
		$query = mysql_query($sql);
		while($info=mysql_fetch_object($query))
		{
		
$r_date = $rp1_date = $rp2_date = $rp3_date = $_POST['roster_date'];
$re_date = date('Y-m-d',strtotime($r_date)+(6*86400));
		
		$roster_date = $_POST['roster_date'];
		$entry_by = $_SESSION['user']['id'];
		
		while(strtotime($rp3_date) <= strtotime($re_date)){ 

		$point = $_POST['p_'.$info->PBI_ID];
		$shedule = $_POST['s_'.$info->PBI_ID.'_'.$rp3_date];
		
		if($shedule>0){
		$del_sql = "delete from hrm_roster_allocation where PBI_ID='".$info->PBI_ID."' and roster_date = '".$rp3_date."'";
		mysql_query($del_sql);
		 $insSql = 'INSERT INTO hrm_roster_allocation( PBI_ID, roster_date, point_1, shedule_1, job_location,group_for, entry_by) VALUES ("'.$info->PBI_ID.'", "'.$rp3_date.'", "'.$point.'", "'.$shedule.'", "'.$_POST['job_location'].'", "'.$_POST['group_for'].'", "'.$entry_by.'")';
		mysql_query($insSql);
		}
 $rp3_date = date ("Y-m-d", strtotime("+1 day", strtotime($rp3_date)));} 
			}
		}

?>
<script>

function getXMLHTTP() { //fuction to return the xml http object

		var xmlhttp=false;	

		try{

			xmlhttp=new XMLHttpRequest();

		}

		catch(e)	{		

			try{			

				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){

				try{

				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");

				}

				catch(e1){

					xmlhttp=false;

				}

			}

		}

		 	

		return xmlhttp;

    }

	function update_value(id,rdate)
	{
var PBI_ID=id; // Rent
var rdate = rdate;
var sdate=document.getElementById('sdate').value;
var tdate=document.getElementById('tdate').value;
var type =document.getElementById('s_'+id+"_"+rdate).value;
var strURL="roster_ajax.php?PBI_ID="+PBI_ID+"&sdate="+sdate+"&tdate="+tdate+"&type="+type;

		var req = getXMLHTTP();

		if (req) {
			req.onreadystatechange = function() {

				if (req.readyState == 4) {

					// only if "OK"

					if (req.status == 200) {						

						document.getElementById('divi_'+id).style.display='inline';

						document.getElementById('divi_'+id).innerHTML=req.responseText;						

					} else {

						alert("There was a problem while using XMLHTTP:\n" + req.statusText);

					}

				}				

			}			

			req.open("GET", strURL, true);

			req.send(null);

		}	

}


</script>




<div class="form-container_large">
		<h4 class="text-center bg-titel bold pt-2 pb-2">
                    Select Option
                </h4>
    
    <form action="?"  method="post">
          
        <div class="container-fluid bg-form-titel">
            <div class="row">
                <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5">
                    <div class="form-group row m-0">
                        <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Start Date Form:</label>
                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
                            <input name="roster_date" type="text"  class="form-control" id="roster_date" autocomplete="off" value="<?=$_POST['roster_date']?>" required="required" />
                        </div>
                    </div>

                </div>
                <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5">
                    <div class="form-group row m-0">
                        <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Department/Section</label>
                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
                            <select name="department"  class="form-control" id="department">
                                   <? foreign_relation('department','DEPT_ID','DEPT_DESC',$_POST['department'],' 1 order by DEPT_DESC');?>
                            </select>
                        </div>
                    </div>

                </div>
				

                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                   
                   
					<input name="create" id="create" value="SHOW EMPLOYEE" type="submit" class="btn1 btn1-submit-input">
                </div>

            </div>
        </div>
		
		 <? 
						
$r_date = $rp1_date = $rp2_date = $rp3_date = $_POST['roster_date'];
$re_date = date('Y-m-d',strtotime($r_date)+(6*86400));

						?>
		
<br />

				<table class="table1  table-striped table-bordered table-hover table-sm">
					<thead class="thead1">
					<tr class="bgc-info">
                                        <th rowspan="2">Code</th>
                                        <th rowspan="2">Full Name</th>
                                        <th rowspan="2">Desg</th>
                                        <th rowspan="2">Dept</th>
                                        <th rowspan="2">LOC</th>
									<? while(strtotime($rp1_date) <= strtotime($re_date)){ ?>
                                        <th><?=$rp1_date?></th>
                                        <? $rp1_date = date ("Y-m-d", strtotime("+1 day", strtotime($rp1_date)));} ?>
                                  </tr>
									  
									

                                       
                                      <tr>
									  <? while(strtotime($rp3_date) <= strtotime($re_date)){ ?>
                                        <th class="bgc-info">SCH</th>
										<? $rp3_date = date ("Y-m-d", strtotime("+1 day", strtotime($rp3_date)));} ?>
                                   </tr>
					</thead>

					<tbody class="tbody1">

					 <?
	     if(isset($_POST['create'])){
		//if($_POST['designation']>0) 		$con .=' and a.PBI_DESIGNATION='.$_POST['designation'];
		if($_POST['department']>0)			$con .=' and a.DEPT_ID='.$_POST['department'];
		if($_POST['job_location']>0)		$con .=' and a.JOB_LOCATION='.$_POST['job_location'];
		if($_POST['group_for']>0)			$con .=' and a.PBI_ORG='.$_POST['group_for'];
		if($_POST['PBI_DOMAIN']!='')		$con .=' and a.PBI_DOMAIN="'.$_POST['PBI_DOMAIN'].'"';
		
		$show=1;
		
		 $sql = "select a.PBI_NAME,a.PBI_ID,a.PBI_CODE,g.DESG_DESC as PBI_DESIGNATION,d.DEPT_DESC as PBI_DEPARTMENT from personnel_basic_info a,department d,designation g
		where  1 ".$con." and a.DEPT_ID=d.DEPT_ID and a.DESG_ID=g.DESG_ID and a.PBI_JOB_STATUS='In Service' order by a.PBI_ID ";
		
		$query = mysql_query($sql);
		
		while($info=mysql_fetch_object($query))
		{
		$rp2_date = $r_date;
		
		$ros = "select * from hrm_roster_allocation where PBI_ID='".$info->PBI_ID."' and roster_date between '".$r_date."' and '".$re_date."' ";
		$ros_r = mysql_query($ros);
		while($roster = mysql_fetch_object($ros_r)){
		$point[$roster->PBI_ID]=$roster->point_1;

		$shedule[$roster->PBI_ID][$roster->roster_date]=$roster->shedule_1;

		
		}
		?>
                                      <tr>
                                        <td><?=$info->PBI_CODE?><input type="hidden" name="PBI_ID" id="PBI_ID" value="<?=$info->PBI_ID?>" /><input type="hidden" name="sdate" id="sdate" value="<?=$r_date?>" /><input type="hidden" name="tdate" id="tdate" value="<?=$re_date?>" /></td>
                                        <td><?=$info->PBI_NAME?></td>
                                        <td><?=$info->PBI_DESIGNATION?></td>
                                        <td><?=$info->PBI_DEPARTMENT?></td>
                                        <td>
										<!--<select name="p_<?=$info->PBI_ID?>" id="p_<?=$info->PBI_ID?>" style="width:70px; font-size:12px;">
                                          <? foreign_relation('hrm_roster_point','id','point_short_name',$point[$info->PBI_ID],'group_for = "'.$_POST['group_for'].'"');?>
                                        </select>-->                                        </td>



<td>
<select name="s_<?=$info->PBI_ID?>_<?=$rp2_date?>" id="s_<?=$info->PBI_ID?>_<?=$rp2_date?>" onchange="update_value(<?=$info->PBI_ID?>,'<?=$r_date?>')">
<option></option>
<? foreign_relation('hrm_schedule_info','id','schedule_name',$shedule[$info->PBI_ID][$rp2_date]);?></select>
<? $rp2_date = date ("Y-m-d", strtotime("+1 day", strtotime($rp2_date)));?>
</td>
<td colspan="6"><span id="divi_<?=$info->PBI_ID?>">
<table>
<tr>
<? while (strtotime($rp2_date) <= strtotime($re_date)){ ?>
 <td>
<select name="s_<?=$info->PBI_ID?>_<?=$rp2_date?>" id="s_<?=$info->PBI_ID?>_<?=$rp2_date?>">
<option></option>
<? foreign_relation('hrm_schedule_info','id','schedule_name',$shedule[$info->PBI_ID][$rp2_date]);?></select></td>
<? $rp2_date = date ("Y-m-d", strtotime("+1 day", strtotime($rp2_date)));   } ?>

</tr></table></span></td>
                           </tr>
<?	} }?>

					</tbody>
				</table>
				
				
				
				<div class="n-form-btn-class">
						<? if($show>0){?> <input name="save" type="submit" id="save" value="SET SCHEDULE" class="btn1 btn1-submit-input"/><? } ?>
				</div>
        
    
</div>


<?php /*?><form action="?"  method="post">
  <div class="oe_view_manager oe_view_manager_current">
    <div class="oe_view_manager_body">
      <div  class="oe_view_manager_view_list"></div>
      <div class="oe_view_manager_view_form">
        <div style="opacity: 1; text-align: right;" class="oe_formview oe_view oe_form_editable">
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
                        <table  border="0" class="table table-bordered table-sm">
                          <thead>
                            
                            <tr>
                              <th colspan="4" align="center" class="p-3 mb-2 bg-primary text-white"><div align="center">Select Options</div></th>
                            </tr>
							
							
                          </thead>
                          <tfoot>
                          </tfoot>
                          <tbody>
						  
						  
					
							
							
                           
                            <tr>
							
						
                            
                            
                              <td width="30%" align="center"><div align="right"><strong>7 days starts from Date :</strong></div></td>
                              <td width="30%" align="center"><div align="center">
							  <span class="oe_form_group_cell">
							  <input name="roster_date" type="text"  class="form-control" id="roster_date" autocomplete="off" value="<?=$_POST['roster_date']?>" required="required" />
                              </span></div></td>
							
                         
                           
                            </tr>
                            
                            
                            <!--<tr>
                              <td align="center" style="text-align: right">&nbsp;</td>
                              <td align="center" style="text-align: right"><div align="right"><strong>Company : </strong></div></td>
                              <td><div align="left">
                                <select name="group_for" id="group_for"  class="form-control"   onchange="getData2('ajax_location.php', 'loc', this.value,  this.value)" required="required">
                                  <? foreign_relation('user_group', 'id', 'group_name',$_POST['group_for'],'1 and id="'.$_SESSION['user']['group'].'"')?>
                                </select>
                              </div></td>
                              <td>&nbsp;</td>
                            </tr>-->
                            
                           
                            
                            <!--<tr>
                              <td align="right">&nbsp;</td>
          <td align="right"><div align="right"><strong>Job Location : </strong></div></td>
          <td><div align="left">
            <select name="job_location" id="job_location"  class="form-control" >
              <? foreign_relation('office_location', 'ID', 'LOCATION_NAME',$_POST['job_location'],'1 and ID !=15')?>
              </select>
            <input type='hidden' name='area' id='area' value='1' />
          </div></td>
          <td>&nbsp;</td>
                            </tr>-->
                             
                             <tr>
                               
                               <td align="center" style="text-align: right"><strong>Department/Section :</strong></td>
                               <td><div align="left"><span class="oe_form_group_cell">
                                 <select name="department"  class="form-control" id="department">
                                   <? foreign_relation('department','DEPT_ID','DEPT_DESC',$_POST['department'],' 1 order by DEPT_DESC');?>
                                 </select>
                               </span></div></td>
                               <td>&nbsp;</td>
							   <td>&nbsp;</td>
							   
                             </tr>
							 
							 
							 
                            <tr>
                            <td colspan="4" align="center" style="text-align: right"><div align="center">
					
                              <input name="create" id="create" value="SHOW EMPLOYEE" type="submit" class="btn1 btn1-submit-input">
                            </div></td>
                            </tr>
							
							
                          </tbody>
                        </table>
                      
                        <? 
						
$r_date = $rp1_date = $rp2_date = $rp3_date = $_POST['roster_date'];
$re_date = date('Y-m-d',strtotime($r_date)+(6*86400));

						?>
                        <div style="text-align:center">
                          
                          <div class="oe_form_sheetbg">
                            <div class="oe_form_sheet oe_form_sheet_width">
                              <div class="oe_view_manager_view_list">
                                <div class="oe_list oe_view">
                                  <table width="100%" class="table table-striped table-sm" border="1">
                                    <thead>
                                      <tr class="bg-warning">
                                        <th rowspan="2">Code</th>
                                        <th rowspan="2">Full Name</th>
                                        <th rowspan="2">Desg</th>
                                        <th rowspan="2">Dept</th>
                                        <th rowspan="2">LOC</th>
									<? while(strtotime($rp1_date) <= strtotime($re_date)){ ?>
                                        <th><?=$rp1_date?></th>
                                        <? $rp1_date = date ("Y-m-d", strtotime("+1 day", strtotime($rp1_date)));} ?>
                                      </tr>
									  
									

                                       
                                      <tr class="oe_list_header_columns" style="font-size:10px;padding:3px;">
									  <? while(strtotime($rp3_date) <= strtotime($re_date)){ ?>
                                        <th class="bg-warning">SCH</th>
										<? $rp3_date = date ("Y-m-d", strtotime("+1 day", strtotime($rp3_date)));} ?>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?
	     if(isset($_POST['create'])){
		//if($_POST['designation']>0) 		$con .=' and a.PBI_DESIGNATION='.$_POST['designation'];
		if($_POST['department']>0)			$con .=' and a.DEPT_ID='.$_POST['department'];
		if($_POST['job_location']>0)		$con .=' and a.JOB_LOCATION='.$_POST['job_location'];
		if($_POST['group_for']>0)			$con .=' and a.PBI_ORG='.$_POST['group_for'];
		if($_POST['PBI_DOMAIN']!='')		$con .=' and a.PBI_DOMAIN="'.$_POST['PBI_DOMAIN'].'"';
		
		$show=1;
		
		 $sql = "select a.PBI_NAME,a.PBI_ID,a.PBI_CODE,g.DESG_DESC as PBI_DESIGNATION,d.DEPT_DESC as PBI_DEPARTMENT from personnel_basic_info a,department d,designation g
		where  1 ".$con." and a.DEPT_ID=d.DEPT_ID and a.DESG_ID=g.DESG_ID and a.PBI_JOB_STATUS='In Service' order by a.PBI_ID ";
		
		$query = mysql_query($sql);
		
		while($info=mysql_fetch_object($query))
		{
		$rp2_date = $r_date;
		
		$ros = "select * from hrm_roster_allocation where PBI_ID='".$info->PBI_ID."' and roster_date between '".$r_date."' and '".$re_date."' ";
		$ros_r = mysql_query($ros);
		while($roster = mysql_fetch_object($ros_r)){
		$point[$roster->PBI_ID]=$roster->point_1;

		$shedule[$roster->PBI_ID][$roster->roster_date]=$roster->shedule_1;

		
		}
		?>
                                      <tr style="font-size:10px; padding:3px; ">
                                        <td><?=$info->PBI_CODE?><input type="hidden" name="PBI_ID" id="PBI_ID" value="<?=$info->PBI_ID?>" /><input type="hidden" name="sdate" id="sdate" value="<?=$r_date?>" /><input type="hidden" name="tdate" id="tdate" value="<?=$re_date?>" /></td>
                                        <td><?=$info->PBI_NAME?></td>
                                        <td><?=$info->PBI_DESIGNATION?></td>
                                        <td><?=$info->PBI_DEPARTMENT?></td>
                                        <td>
										<!--<select name="p_<?=$info->PBI_ID?>" id="p_<?=$info->PBI_ID?>" style="width:70px; font-size:12px;">
                                          <? foreign_relation('hrm_roster_point','id','point_short_name',$point[$info->PBI_ID],'group_for = "'.$_POST['group_for'].'"');?>
                                        </select>-->                                        </td>



<td>
<select name="s_<?=$info->PBI_ID?>_<?=$rp2_date?>" id="s_<?=$info->PBI_ID?>_<?=$rp2_date?>" style="width:100%; font-size:12px" onchange="update_value(<?=$info->PBI_ID?>,'<?=$r_date?>')">
<option></option>
<? foreign_relation('hrm_schedule_info','id','schedule_name',$shedule[$info->PBI_ID][$rp2_date]);?></select>
<? $rp2_date = date ("Y-m-d", strtotime("+1 day", strtotime($rp2_date)));?>
</td>
<td colspan="6"><span id="divi_<?=$info->PBI_ID?>">
<table>
<tr>
<? while (strtotime($rp2_date) <= strtotime($re_date)){ ?>
 <td>
<select name="s_<?=$info->PBI_ID?>_<?=$rp2_date?>" id="s_<?=$info->PBI_ID?>_<?=$rp2_date?>" style="width:100%; font-size:12px">
<option></option>
<? foreign_relation('hrm_schedule_info','id','schedule_name',$shedule[$info->PBI_ID][$rp2_date]);?></select></td>
<? $rp2_date = date ("Y-m-d", strtotime("+1 day", strtotime($rp2_date)));   } ?>

</tr></table></span></td>
                           </tr>
<?	} }?>
                                    </tbody>
                                    <tfoot>
                                      <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                      </tr>
                                    </tfoot>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
						  <div align="center">
					     
						    <? if($show>0){?> <input name="save" type="submit" id="save" value="SET SCHEDULE" class="btn btn-warning"/><? } ?>
						    
					        </div>
                        </div>
                        <? ?>
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
  </div>
</form><?php */?>
<?
$main_content=ob_get_contents();
ob_end_clean();
include ("../../template/main_layout.php");
?>