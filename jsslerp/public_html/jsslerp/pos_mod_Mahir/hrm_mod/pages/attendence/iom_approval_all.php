<?php

require_once "../../../assets/template/layout.top.php";

$title=" IOM Approve"
?>    <!-- Datatables -->



        <!-- page content -->



        
        	<div class="right_col" role="main">   <!-- Must not delete it ,this is main design header-->



                  <div class="">



                <div class="clearfix"></div>

                    <div class="row">



                      <div class="col-md-12 col-sm-12 col-xs-12">



              	 <div class="openerp openerp_webclient_container">

                          <div class="x_content">



	  <!--edit form -->

<style>

.button {

  position: relative;

  background-color: #04AA6D;

  border: none;

  font-size: 28px;

  color: #FFFFFF;

  padding: 20px;

  width: 200px;

  text-align: center;

  -webkit-transition-duration: 0.4s; /* Safari */

  transition-duration: 0.4s;

  text-decoration: none;

  overflow: hidden;

  cursor: pointer;

}



.button:after {

  content: "";

  background: #90EE90;

  display: block;

  position: absolute;

  padding-top: 300%;

  padding-left: 350%;

  margin-left: -20px!important;

  margin-top: -120%;

  opacity: 0;

  transition: all 0.8s

}



.button:active:after {

  padding: 0;

  margin: 0;

  opacity: 1;

  transition: 0s

}
tr:nth-child(odd){
background-color: #fafafa !important;

}
tr:nth-child(Even){

}

</style>

                     
			 
					 
					 
					 
					 
					 
					 
					 <form action="?"  method="post">

					
					<table width="100%" border="0" class="table table-bordered table-sm">
                          <thead>
                            
                            <tr>
                              <th colspan="4" class="text-center bg-titel bold pt-2 pb-2">Select Options</th>
                            </tr>
                          </thead>
                          <tfoot>
                          </tfoot>
                          <tbody>
                            
                            
                            
                            
                            
                            
                            <tr>
                              <td align="right">&nbsp;</td>
                              <td align="right"><div align="right"><strong>Job Location : </strong></div></td>
                              <td><select name="job_location"  class="form-control" id="job_location" >
							    <option></option>
                                <? foreign_relation('project', 'PROJECT_ID', 'PROJECT_DESC',$_POST['job_location'],'1')?>
                              </select>
                              </td>
                              <td>&nbsp;</td>
                            </tr>
							
							
							<tr>
                              <td align="right">&nbsp;</td>
                              <td align="right"><div align="right"><strong>Department : </strong></div></td>
                              <td> <select name="department"  class="form-control" id="department">
							        <option></option>
						
                                   <? foreign_relation('department','DEPT_ID','DEPT_DESC',$_POST['department'],' 1 order by DEPT_DESC');?>
                                 </select></td>
                              <td>&nbsp;</td>
                            </tr>
							
							
                            
                             <br />
                             <tr>
                            <td colspan="4" align="center" style="text-align: right"><div align="center">
					
                              <input name="create" id="create" value="SHOW EMPLOYEE" type="submit" class="btn1 btn1-bg-submit">
                            </div></td>
                            </tr>
                          </tbody>
                        </table>
						</form>



						
						

                    <table   class="table1  table-striped table-bordered table-hover table-sm">

                      <thead  class="thead1">

                        <tr class="bgc-info">

                

                          <th style="text-align: center">Name</th>
                      
                          
						  
						  <th style="text-align: center">Type</th>
						  
						  <th style="text-align: center">Submit Date</th>
						
						  
						  <th style="text-align: center">Start Date</th>
						  <th style="text-align: center">End Date</th>
						  
					       <th style="text-align: center">Total Days</th>
						   
						   <th style="text-align: center">Start Time</th>
						   <th style="text-align: center">End Time</th>
						  
						  <th style="text-align: center">Reporting Authority</th>
						  
						  <th style="text-align: center">HR Approval</th>
						  
					
					
                     
						  <th style="width:50px;text-align: center"">View</th>

                        </tr>

                      </thead>
					  
					   <form action="" method="post" id="form1">

					    <tbody class="tbody1">

<?

$g_s_date=date('Y-01-01');

$g_e_date=date('Y-12-31');

//and a.entry_by='.$_SESSION['employee_selected'].'


        if($_POST['department']>0)			$con .=' and p.DEPT_ID='.$_POST['department'];
		if($_POST['job_location']>0)		$con .=' and p.JOB_LOCATION='.$_POST['job_location'];
		if($_POST['group_for']>0)			$con .=' and p.PBI_ORG='.$_POST['group_for'];
		if($_POST['PBI_DOMAIN']!='')		$con .=' and p.PBI_DOMAIN="'.$_POST['PBI_DOMAIN'].'"';

  
  $sql = 'select o.id,p.PBI_NAME,p.PBI_ID,p.PBI_DEPARTMENT,o.s_time,o.e_time,o.s_date as start_date,o.e_date as end_date,o.type,o.iom_apply_date,o.total_days,o.dept_head_status,o.iom_status
  
	
	from personnel_basic_info p,hrm_iom_info o
	
	where p.PBI_ID=o.PBI_ID and  o.iom_status="Pending" and o.s_date between "'.$g_s_date.'" and "'.$g_e_date.'" '.$con.' order by o.s_date desc';

$query=mysql_query($sql);
while($data = mysql_fetch_object($query)){






?>
                 


                        <tr>

                    

                          <td style="width:180px"><?=$data->PBI_NAME?></td>
                          <td style="width:130px"><?=$data->type;?></td>
						  
						  
                          <td style="width:130px"><?=date('d-M-Y',strtotime($data->iom_apply_date))?></td>
						  
						 
						  
						  <td style="width:110px"><?=date('d-M-Y',strtotime($data->start_date))?></td>
						  <td style="width:110px"><?=date('d-M-Y',strtotime($data->end_date))?></td>
						  
						
						  <td style="width:80px;text-align:center"><?=$data->total_days?></td> 
						  
						  <td style="width:110px"><?=date('h:i a',strtotime($data->s_time))?></td>
						  <td style="width:110px"><?=date('h:i a',strtotime($data->e_time))?></td>
						  
						  <td  style="text-align:center"><?=$data->dept_head_status?></td>
						  <td  style="text-align:center"><?=$data->iom_status?></td>
					

						
						<td style="width:50px"> 
						
							
						  <div class="btn-group"><a href="iom_approval_all.php?asign_id=<?=$data->id;?>" class="buttonn btn btn-primary">Approve</a></div>
						  
				
						
						
						</td>
						
				         </tr>

                 
						  <? } ?>
						  
						  
						  
						  
						  
	<?  
	if($_GET['asign_id']>0){

$update = "update hrm_iom_info set iom_status='GRANTED',dept_head_status='Approve' where id='".$_GET['asign_id']."'";

$query=mysql_query($update);

 $ss = mysql_query("select * from hrm_iom_info  where id='".$_GET['asign_id']."'");
$dataa = mysql_fetch_object($ss);


$from_date = strtotime($dataa->s_date);
$to_date= strtotime($dataa->e_date);
$emp_id = $dataa->PBI_ID;
$iom_type =  $dataa->type;
$iom_sl_no =  $dataa->id;
$iom_entry_at= $dataa->entry_at;
$iom_entry_by= $dataa->entry_by;
$s_time = $dataa->s_time; 
$e_time =  $dataa->e_time;





for($i=$from_date; $i<=$to_date; $i=$i+86400)
{
$att_date=date('Y-m-d',$i);

$found = find_a_field('hrm_att_summary','1','emp_id="'.$emp_id.'" and att_date="'.$att_date.'"');
if($found==0)
{
 $sql="INSERT INTO hrm_att_summary (emp_id, iom_type, iom_id, att_date,iom_start_time,iom_end_time,iom_entry_at,iom_entry_by,iom_category, dayname)
VALUES ('$emp_id', '$iom_type', '$iom_sl_no','$att_date','$s_time','$e_time','$iom_entry_at','$iom_entry_by','$iom_category', dayname('".$att_date."'))";
$query=mysql_query($sql);
}

else{
 $sql='update hrm_att_summary set iom_type="'.$iom_type.'", iom_id="'.$iom_sl_no.'",iom_start_time="'.$s_time.'",iom_end_time="'.$e_time.'",dayname=dayname("'.$att_date.'"),

iom_entry_at="'.$iom_entry_at.'", iom_entry_by="'.$iom_entry_by.'",iom_category="'.$iom_category.'"

where  emp_id="'.$emp_id.'" and att_date="'.$att_date.'" ';

$query=mysql_query($sql);

}



} 




header('location:iom_approval_all.php');
	
	
	}
	
	
	?>				 
								  
						  
						

                    </tbody>
					
					   </form>
					   
					 

                    </table>
					
					
					


		

                             </div>



                  		   </div>                  		   </div>



                  		    </div>



                              </div>



                  			</div>



                  			</div>



                  			 </div>



                                </div>

                            </div>



                          </div>



                        </div>



                      </div>



                    </div>                      </div>





<?

$main_content=ob_get_contents();



ob_end_clean();







include ("../../template/main_layout.php");







?>