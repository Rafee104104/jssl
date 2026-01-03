<?php



require_once "../../../assets/template/layout.top.php";



auto_complete_from_db('personnel_basic_info','concat(PBI_NAME,"-",PBI_ID)','PBI_ID','','EMP_ID');







do_calander('#s_date');



do_calander('#e_date');











if(isset($_REQUEST['view']))



{



$s_date=$_REQUEST['s_date'];



$e_date=$_REQUEST['e_date'];







$emp_id=$_REQUEST["EMP_ID"];



$department=$_REQUEST["department"];



$designation=$_REQUEST["designation"];



$gender=$_REQUEST["PBI_SEX"];



$location=$_REQUEST["JOB_LOCATION"];



}













do_datatable('grp');

// ::::: Edit This Section ::::: 



$title='Leave Report';			// Page Name and Page Title



$page="leave_report.php";		// PHP File Name







$root='leave';







$table='hrm_leave_info';		// Database Table Name Mainly related to this page



$unique='id';			// Primary Key of this Database table



$shown='type';				// For a New or Edit Data a must have data field







// ::::: End Edit Section :::::







$crud      =new crud($table);



$$unique = $_GET[$unique];



?>


<script type="text/javascript"> 



function DoNav(theUrl)



{

	window.open('detail_leave_report.php?PBI_ID='+theUrl);


}


</script>


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







.style1 {







	color: #0066CC;







	font-weight: bold;







}



-->



</style>










    <form action="" method="post" name="search" enctype="multipart/form-data">




        <div class="d-flex justify-content-center">
            <div class="n-form1 fo-width pt-0">
                <h4 class="text-center bg-titel bold pt-2 pb-2"> Leave Report  </h4>
                <div class="container-fluid pt-3">
                    <div class="row m-0 p-0">
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">


                            <div class="form-group row m-0 mb-1 pl-3 pr-3">
                                <label for="group_for" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Date For :</label>
                                <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                                    <input type="text" name="s_date" id="s_date" placeholder="From" value="<?=$s_date?>" required/>
                                </div>
                            </div>


                            <div class="form-group row m-0 mb-1 pl-3 pr-3">
                                <label for="group_for" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Date To :</label>
                                <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                                    <input type="text" name="e_date" id="e_date" placeholder="To" value="<?=$e_date?>" required/>
                                </div>
                            </div>


                            <div class="form-group row m-0 mb-1 pl-3 pr-3">
                                <label for="group_for" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Employee Name / Code :</label>
                                <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                                    <input name="EMP_ID"  type="text" id="EMP_ID" value="<?=$emp_id?>" size="10" onblur="" tabindex="1"/>
                                </div>
                            </div>


                        </div>




                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group row m-0 mb-1 pl-3 pr-3">
                                <label for="group_for" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Company :</label>
                                <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">

                                    <select name="user_group">

                                        <? foreign_relation('user_group','id','group_name',$_POST['user_group'],' 1 order by group_name asc');?>

                                    </select>
                                </div>
                            </div>



                            <div class="form-group row m-0 mb-1 pl-3 pr-3">
                                <label for="group_for" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Department :</label>
                                <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">

                                    <select name="department">
                                        <option></option>
                                        <? foreign_relation('department','DEPT_id','DEPT_DESC',$_POST['department'],' 1 order by DEPT_DESC');?>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row m-0 mb-1 pl-3 pr-3">
                                <label for="group_for" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Location :</label>
                                <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
                                    <select name="JOB_LOCATION" id="JOB_LOCATION">

                                        <option></option>

                                        <? foreign_relation('office_location','ID','LOCATION_NAME',$_POST['JOB_LOCATION'],' 1 order by LOCATION_NAME');?>
                                    </select>

                                </div>
                            </div>

                        </div>






                    </div>

                    <div class="n-form-btn-class">
                        <input type="submit" value="Show" id="submit" name="view"  class="btn1 btn1-bg-submit">
                    </div>

                </div>
            </div>
        </div>

        <div class="container-fluid pt-5">


            <?
            if(isset($_POST['view'])){




                $res = "select a.PBI_ID,a.PBI_ID as ID,a.PBI_NAME as Staff_Name, a.PBI_SEX as Gender, c.DESG_DESC as Designation,d.DEPT_DESC as Department,
(select sum(total_days) from hrm_leave_info  where type='LWP (Leave Without Pay)' and s_date between '".$s_date."' and '".$e_date."' and PBI_ID=o.PBI_ID) as LWP,
(select sum(total_days) from hrm_leave_info  where type!='LWP (Leave Without Pay)' and s_date between '".$s_date."' and '".$e_date."' and PBI_ID=o.PBI_ID) as Total_Leave

from personnel_basic_info a,designation c, department d,hrm_leave_info o

where 1 and a.DESG_ID=c.DESG_ID and a.DEPT_ID=d.DEPT_ID

and a.PBI_ID=o.PBI_ID ";


                if($designation!="") $res.="and a.PBI_DESIGNATION='".$designation."' ";

                if($department!="") $res.="and a.PBI_DEPARTMENT='".$department."' ";

                if($emp_id!="") $res.="and a.PBI_ID='".$emp_id."' ";

                if($_POST['user_group']!="") $res.="and a.PBI_ORG='".$_POST['user_group']."' ";

                if($location!="") $res.="and a.JOB_LOCATION='".$location."' ";

                $res.="group by o.PBI_ID  order by o.id desc";


//echo $res;


                echo link_report1($res,$link);

                $query=mysql_query($res);

                $count=mysql_num_rows($query);

            }

            ?>

            <h4 class="text-center bg-titel bold pt-2 pb-2">Total Employee Found: <?=$count?></h4>

        </div>

    </form>






<?php/*>
<br>
<br>
<br>
<br>
<br>



<form action="" method="post" name="search" enctype="multipart/form-data">
<div class="oe_view_manager oe_view_manager_current">
    <?// include('../../common/title_bar.php');?>
        <div class="oe_view_manager_body">
                <div  class="oe_view_manager_view_list"></div>
                <div class="oe_view_manager_view_form"><div style="opacity: 1;" class="oe_formview oe_view oe_form_editable">
        <div class="oe_form_buttons"></div>

        <div class="oe_form_sidebar"></div>

        <div class="oe_form_pager"></div>

        <div class="oe_form_container"><div class="oe_form">

          <div class="">

    <? //include('../../common/report_bar.php');?>

<div class="oe_form_sheetbg">
        <div class="oe_form_sheet oe_form_sheet_width">

          <div  class="oe_view_manager_view_list"><div  class="oe_list oe_view">

	  <div class="card">
          				  <div style="font-weight:bold; font-size:16px;" class="card-header bg-info "><center>Leave Report</center></div>
				  <div class="card-body">
		 
		 <table  border="0" cellpadding="0" cellspacing="0"  class="table table-bordered">


 <tr class="oe_form_group_row">

<td width="86"  class="oe_form_group_cell" style="width:60px"><div align="left"><span class="oe_form_group_cell oe_form_group_cell_label">Date :</div></td>

                            <td  colspan=""  class="oe_form_group_cell">
							<div align="left">
                                <input type="text" name="s_date" id="s_date" placeholder="From" value="<?=$s_date?>"   class="form-control" required/>
						    <td  colspan=""  class="oe_form_group_cell" >
							<div align="left">
                              <input type="text" name="e_date" id="e_date" placeholder="To" value="<?=$e_date?>" required/ class="form-control">

                            </div>
                            </td>



                           






			<td width="157"class="oe_form_group_cell" style="width:60px">
                <span class="oe_form_group_cell oe_form_group_cell_label">Employee Name / Code : </td>

                <td width="121" colspan=""  class="oe_form_group_cell" style="width:60px">

				<div align="left">



                  <input name="EMP_ID"  type="text" id="EMP_ID" value="<?=$emp_id?>" size="10" onblur="" tabindex="1"  class="form-control">



                </div></td>





                    <td width="72"  class="oe_form_group_cell" style="width:60px">Company</td>
                  <td width="216" colspan="" class="oe_form_group_cell" style="width:60px">

                      <select name="user_group" style="width:130px" class="form-control">



                    <? foreign_relation('user_group','id','group_name',$_POST['user_group'],' 1 order by group_name asc');?>



                  </select>

                  </td>

				   </tr>


						<tr>
						<td  class="oe_form_group_cell" style="width:60px"><div align="center">
						  <div align="center"><span class="oe_form_group_cell oe_form_group_cell_label">Department</span></div>
						</div>
                        </td>


                  <td class="oe_form_group_cell" style="width:60px" >
				    <div align="center">
				         <select name="department" style="width:130px" class="form-control">
					     <option></option>
                         <? foreign_relation('department','DEPT_id','DEPT_DESC',$_POST['department'],' 1 order by DEPT_DESC');?>
                      </select>

				   </div>
                  </td>

				  <td class="oe_form_group_cell" style="width:60px">
                      <div align="center"><span class="oe_form_group_cell oe_form_group_cell_label">Location</span></div></td>
                  <td  class="oe_form_group_cell" style="width:60px" >


				    <div align="center">

				      <select name="JOB_LOCATION" id="JOB_LOCATION" style="width:130px" class="form-control">

					   <option></option>

				        <? foreign_relation('office_location','ID','LOCATION_NAME',$_POST['JOB_LOCATION'],' 1 order by LOCATION_NAME');?>
				 		</select>
				        </div>
                  </td>


				     <td  class="oe_form_group_cell">
				     <div align="center">
				       <input type="submit" value="Show" id="submit" name="view"  class="btn1 btn1-bg-submit">
				          </div></td>


                </tr>



          </table>

		  

		  </div></div>



		  <hr/>







<?
if(isset($_POST['view'])){




  $res = "select a.PBI_ID,a.PBI_ID as ID,a.PBI_NAME as Staff_Name, a.PBI_SEX as Gender, c.DESG_DESC as Designation,d.DEPT_DESC as Department,
(select sum(total_days) from hrm_leave_info  where type='LWP (Leave Without Pay)' and s_date between '".$s_date."' and '".$e_date."' and PBI_ID=o.PBI_ID) as LWP,
(select sum(total_days) from hrm_leave_info  where type!='LWP (Leave Without Pay)' and s_date between '".$s_date."' and '".$e_date."' and PBI_ID=o.PBI_ID) as Total_Leave

from personnel_basic_info a,designation c, department d,hrm_leave_info o 

where 1 and a.DESG_ID=c.DESG_ID and a.DEPT_ID=d.DEPT_ID 

and a.PBI_ID=o.PBI_ID ";









if($designation!="") $res.="and a.PBI_DESIGNATION='".$designation."' ";







if($department!="") $res.="and a.PBI_DEPARTMENT='".$department."' ";







if($emp_id!="") $res.="and a.PBI_ID='".$emp_id."' ";







if($_POST['user_group']!="") $res.="and a.PBI_ORG='".$_POST['user_group']."' ";







if($location!="") $res.="and a.JOB_LOCATION='".$location."' ";











$res.="group by o.PBI_ID  order by o.id desc";



//echo $res;







echo $crud->link_report($res,$link);







$query=mysql_query($res);



$count=mysql_num_rows($query);



}



?>



 



<table width="50%" border="0" cellspacing="0" cellpadding="0">

            <tr>


              <td><div align="center" class="style1">


                <div align="left">Total Employee Found: 


                  <?=$count?>


                  </div>


              </div>
              </td>


            </tr>

          </table>




          </div></div>


          </div>





    </div>



    </div>
            </div>




        </div>



  </div>







</form> 

<*/?>





<?
require_once "../../../assets/template/layout.bottom.php";
?>