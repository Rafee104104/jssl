<?php







require_once "../../../assets/template/layout.top.php";

$title="User Portal Login Access";

do_datatable('grp');



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



<!--<style>-->

<!---->

<!--.button {-->

<!---->

<!--  position: relative;-->

<!---->

<!--  background-color: #04AA6D;-->

<!---->

<!--  border: none;-->

<!---->

<!--  font-size: 28px;-->

<!---->

<!--  color: #FFFFFF;-->

<!---->

<!--  padding: 20px;-->

<!---->

<!--  width: 200px;-->

<!---->

<!--  text-align: center;-->

<!---->

<!--  -webkit-transition-duration: 0.4s; /* Safari */-->

<!---->

<!--  transition-duration: 0.4s;-->

<!---->

<!--  text-decoration: none;-->

<!---->

<!--  overflow: hidden;-->

<!---->

<!--  cursor: pointer;-->

<!---->

<!--}-->

<!---->

<!---->

<!---->

<!--.button:after {-->

<!---->

<!--  content: "";-->

<!---->

<!--  background: #90EE90;-->

<!---->

<!--  display: block;-->

<!---->

<!--  position: absolute;-->

<!---->

<!--  padding-top: 300%;-->

<!---->

<!--  padding-left: 350%;-->

<!---->

<!--  margin-left: -20px!important;-->

<!---->

<!--  margin-top: -120%;-->

<!---->

<!--  opacity: 0;-->

<!---->

<!--  transition: all 0.8s-->

<!---->

<!--}-->

<!---->

<!---->

<!---->

<!--.button:active:after {-->

<!---->

<!--  padding: 0;-->

<!---->

<!--  margin: 0;-->

<!---->

<!--  opacity: 1;-->

<!---->

<!--  transition: 0s-->

<!---->

<!--}-->

<!---->

<!--</style>-->











<?



if($_GET['cancel_id']>0){ 



 $update_cancel = "update user_activity_management set level='0',status='deactive' where id='".$_GET['cancel_id']."'";



$queryy=mysql_query($update_cancel);



}











if($_GET['asign_id']>0){



//$update = "update performance_appraisal set report_approval=1 where id='".$_GET['asign_id']."'";

//$query=mysql_query($update);







$sqll = 'select PBI_NAME,PBI_ID from personnel_basic_info  where PBI_ID="'.$_GET['asign_id'].'"  group by PBI_ID';

$queryy=mysql_query($sqll);

while($datas = mysql_fetch_object($queryy)){



$id = $datas->PBI_ID;

$name = $datas->PBI_NAME;



}





$check_id =find_a_field('user_activity_management','PBI_ID','PBI_ID="'.$datas->PBI_ID.'"');



if($check_id>0){

header('location:auto_user_create.php');

}else{



//User Id Create

$sql="INSERT INTO user_activity_management (username, password, level,fname,status,group_for,PBI_ID,user_type,entry_date,expire_date)

VALUES ('".$id."', '".$id."', '5', '".$name."', 'Active', '1', '".$id."','User','".date("Y-m-d")."','2030-12-31')";

$query=mysql_query($sql);



//User Module Define 

$user_id =find_a_field('user_activity_management','user_id','PBI_ID="'.$id.'"');

echo $sql_m="INSERT INTO user_module_define (user_id,module_id,status)

VALUES ('".$user_id."', '17','enable')";

$queryy=mysql_query($sql_m);



//User Page Define 

/*echo $sql_m="INSERT INTO user_roll_activity (user_id,page_id,access)

VALUES ('".$user_id."', '17','enable')";

$queryy=mysql_query($sql_m);*/









header('location:auto_user_create.php');



}



//$to = 'nrain798@gmail.com';



/*$to = 'saud@aksidcorp.com';



$subject = 'Performance Appraisal Summary';



$str = 'AKSID Human Resources';



$cc='';



$str ="<span style='font-weight:bold; font-size:16px;'>Performance Appraisal Summary</span><br>";



$str.='<table width="100%" border="1" cellspacing="1" cellpadding="1">



  <tr style="background:#abc4d6;">    



    <td width="5%"><div align="center" style="font-weight:bold; background:#abc4d6;">ID</div></td> 



    <td width="11%"><div align="center" style="font-weight:bold;">Name</div></td>



	<td width="10%"><div align="center" style="font-weight:bold;">Designation</div></td>

	

	<td width="15%"><div align="center" style="font-weight:bold;">Department/Job Location</div></td>



	<td width="10%"><div align="center" style="font-weight:bold;">Joining Date</div></td>



    <td width="20%"><div align="center" style="font-weight:bold;">Job Period</div></td>



	<td width="5%"><div align="center" style="font-weight:bold;">Total Mark</div></td>



    <td width="5%"><div align="center" style="font-weight:bold;">Category</div></td>



	<td width="15%"><div align="center" style="font-weight:bold;">Recommendation</div></td>



  </tr>';  



  $test = "select a.*,p.PBI_NAME,p.PBI_DOJ from performance_appraisal a, personnel_basic_info p where a.PBI_ID=p.PBI_ID and a.id='".$_GET['asign_id']."'";



  $ss = mysql_query("select a.*,p.PBI_NAME,p.PBI_DOJ from performance_appraisal a, personnel_basic_info p where a.PBI_ID=p.PBI_ID and a.id='".$_GET['asign_id']."'");



	 $data = mysql_fetch_object($ss);

	 

	 

	



	 



	 $str.= '<tr align="center">';



     $str.= '<td>'.$data->PBI_ID.'</td>';



     $str.= '<td>'.$data->PBI_NAME.'</td>';



     $str.= '<td>'.$data->designation.'</td>';

	 

	 $str.= '<td>'.$data->PBI_DEPARTMENT.''.$data->JOB_LOCATION.'</td>';



     $str.= '<td>'.date('d-M-Y',strtotime($data->PBI_DOJ)).'</td>';



     $str.= '<td>'.$data->job_period.'</td>';



	 $str.= '<td>'.$data->total_score.'</td>';



     $str.= '<td>'.$data->category.'</td>';



	 $str.= '<td>'.$data->recommendation.'</td>';



	 $str.= '</tr>';







     smtp_mailer($to,$subject,$str,$cc);



	 header('location:report_approval_layer.php');*/



}; ?>







                  <?php /*?><div class="x_content">



                    <p class="text-muted font-13 m-b-30">  </p>



                    <table id="datatable-buttons" class="table table-bordered table-sm">



                      <thead>



                        <tr style="background-color:#3C7AB7; color:#F8F9FA">



                          <th>SL</th>



                          <th>Employee Name</th>



                          <th>Employee Id</th>



                          <th>Department</th>

                           <th>Company Name</th>

                          <th>Status</th>

						  <th>Access</th>



                        </tr>



                      </thead>



					    <tbody>



<?



//and a.entry_by='.$_SESSION['employee_selected'].'



  

$sql = 'select p.PBI_NAME,p.PBI_ID,p.DEPT_ID



from personnel_basic_info p



where  1 order by p.PBI_ID desc';



$query=mysql_query($sql);

while($data = mysql_fetch_object($query)){







?>







                        <tr>



                          <td><?=++$s?></td>



                          <td><?=$data->PBI_NAME?></td>



                          <td><?=$data->PBI_ID?></td>



                          <td><?=find_a_field('department','DEPT_DESC','DEPT_ID="'.$data->DEPT_ID.'"');?></td>







                          <td><?=$data->total_score?></td>



                          <td class="text-center">



		                    <div class="btn-group">

							

							<? $check_id =find_a_field('user_activity_management','PBI_ID','PBI_ID="'.$data->PBI_ID.'"');

							    

								if($check_id>0){

							

							

							 ?>

							 <button class="btn1 btn1-bg-submit">DONE</button>

							 

							 <? }else{ ?>

							

							<a href="auto_user_create.php?asign_id=<?=$data->PBI_ID;?>" class="btn1 btn1-bg-submit">Activate</a>

							

							<? } ?>

							

							</div>&nbsp;&nbsp;

							

							

							

					        <div class="btn-group"><a href="auto_user_create.php?cancel_id=<?=$data->PBI_ID;?>" class="btn1 btn1-bg-cancel">Deactivate</a></div>

					

					



						</td>

						

						<td><input type="checkbox" name="vehicle3" value="Basic Leave" checked></td>

						  <? } ?>



                    </tbody>



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

<?php */?>





  









        <div class="container-fluid pt-5 p-0 ">

           

            <table id="grp" class="table1  table-striped table-bordered table-hover table-sm">

                <thead class="thead1">

                <tr class="bgc-info">

                    <th>SL</th>

                    <th>Employee Name</th>

                    <th>Employee ID</th>



                    <th>Department</th>

                    <th>Company</th>

                    <th>Status</th>



                    <th>Access</th>

                    

                </tr>

                </thead>



                <tbody class="tbody1">

					<?



//and a.entry_by='.$_SESSION['employee_selected'].'

					$s=1;

					  

					$sql = 'select p.PBI_NAME,p.PBI_ID,p.DEPT_ID

					

					from personnel_basic_info p

					

					where  1 order by p.PBI_ID desc';

					

					$query=mysql_query($sql);

					while($data = mysql_fetch_object($query)){

					

					

					

					?>

                <tr>

                    <td><?=$s++;?></td>

                    <td><?=$data->PBI_NAME;?></td>

                   <td><?=$data->PBI_ID;?></td>

				    <td><?=find_a_field('department','DEPT_DESC','DEPT_ID="'.$data->DEPT_ID.'"');?></td>

					 <td><?=find_a_field('user_group','group_name','Id='.$data->DEPT_ID);?></td>

					  <td>

					  

					  		

							

							<? $check_id =find_a_field('user_activity_management','PBI_ID','PBI_ID="'.$data->PBI_ID.'"');

							    

								if($check_id>0){

							

							

							 ?>

							 <button class="btn1 btn1-bg-submit">Done</button>

							 

							 <? }else{ ?>

							

							<a href="auto_user_create.php?asign_id=<?=$data->PBI_ID;?>" class="btn1 btn1-bg-update">Activate</a>

							

							<? } ?>

							

							<a href="auto_user_create.php?cancel_id=<?=$data->PBI_ID;?>" class="btn1 btn1-bg-cancel">Deactivate</a>

							

					  </td>



                    

					<td><input type="checkbox" name="vehicle3" value="Basic Leave" checked></td>

                </tr>

				

				<? } ?>

				

                </tbody>

            </table>





        </div>

















<?



require_once "../../../assets/template/layout.bottom.php";



?>

