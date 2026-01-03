<?php

session_start();

ob_start();

require_once "../../../assets/support/inc.all.php";

$head='<link href="../../css/report_selection.css" type="text/css" rel="stylesheet"/>';

$title='Attendance Management Report';

do_calander('#ijdb');

do_calander('#ijda');

do_calander('#ppjdb');

do_calander('#ppjda');

do_calander('#PBI_DOB');

do_calander('#fdate');

do_calander('#tdate');

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

?>




<form action="../report/master_report_att_management.php" target="_blank" method="post">
    <div class="form-container_large">
        <h4 class="text-center bg-titel bold pt-2 pb-2"> Select Options </h4>
        <div class="container-fluid bg-form-titel">
            <div class="row">
                <!--left form-->
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="container n-form2">
       
                        <div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Employee</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <input list="pbi" type="text" name="PBI_ID" class="form-control" autocomplete="off">
                            </div>
                        </div>
						<div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Company</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <select name="PBI_ORG"  class="form-control" id="PBI_ORG">

								<option></option>
								
								<? foreign_relation('user_group','id','group_name',$PBI_ORG);?>
								
								</select>
                            </div>
                        </div>
						<div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Department</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <select name="department" class="form-control" id="department">
								
								<option></option>
								
								<? foreign_relation('department','DEPT_ID','DEPT_DESC',$PBI_DEPARTMENT,' 1 order by DEPT_DESC');?>
								
								</select>
                            </div>
                        </div>
						<div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Bank Or Cash </label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <select name="bank_or_cash" id="bank_or_cash">

									<option></option>
									
									<option>Bank</option>
									
									<option>Cash</option>
									
								</select>
                            </div>
                        </div>
						<div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Employee Type </label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <select name="EMPLOYMENT_TYPE"  id="EMPLOYMENT_TYPE"  class="form-control">

									<option></option>
									
									<option>Permanent</option>
									
									<option>Contructual</option>
									
									<option>Probation</option>
									
									<option>6 Months</option>
									
									<option>Trainee</option>
								
								</select>
                            </div>
                        </div>
						<div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">For Bonus(Eid) </label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <select name="bonus_type"  class="form-control">

									<option></option>
									
									<option value="1">Eid-Ul-Fitre</option>
									
									<option value="2">Eid-Ul-Adha</option>
									
								</select>
                            </div>
                        </div>
						<div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">For Payroll (Month) </label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <select name="mon" class="form-control" id="mon">

										<option></option>
										
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
                            </div>
                        </div>
						




                    </div>
                </div>

                <!--Right form-->
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="container n-form2">
                       

                        <div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Service Length</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <select name="service_length"  id="service_length" class="form-control">
									
									<option  value="<?=$_POST['service_length']?>"></option>
									
									<option value="1">1 Years</option>
									
									<option value="2">2 Years</option>
									
									<option value="3">3 Years</option>
									
									<option value="4">4 Years</option>
									
									<option value="5">5 Years</option>
									
									<option value="6">6 Years</option>
									
									<option value="7">7 Years</option>
									
									<option value="8">8 Years</option>
									
									<option value="9">9 Years</option>
									
									<option value="10">10 Years</option>
									
								</select>
                            </div>
                        </div>
						<div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Designation</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <select name="designation"  class="form-control" id="designation">

									<option></option>
									
									<? foreign_relation('designation','DESG_ID','DESG_DESC',$designation,' 1 order by DESG_DESC');?>
								
								</select>
                            </div>
                        </div>
						<div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Job Location</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <select name="JOB_LOCATION"  id="JOB_LOCATION"  class="form-control"  >

									<option>
									
									<?=$JOB_LOCATION?>
									
									</option>
									
									<option value="1">Head Office</option>
									
									<option value="2">Factory</option>
								
								</select>
                            </div>
                        </div>
						<div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Job Status</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <select name="job_status"  class="form-control">

									<option></option>
									
									<option>In Service</option>
									
									<option>Not In Service</option>
									
								</select>
                            </div>
                        </div>
						<div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Education</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <select name="PBI_EDU_QUALIFICATION" id="PBI_EDU_QUALIFICATION"  class="form-control">

									<option></option>
									
									<? foreign_relation('education_detail','EDUCATION_D_ID','EDUCATION_NOE',$PBI_EDU_QUALIFICATION) ;?>
								
								</select>
                            </div>
                        </div>
						<div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">For payslip (PBI ID)</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <input name="pbi_id_in"  type="text" id="pbi_id_in" class="form-control" />
                            </div>
                        </div>
						<div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">For Payroll(Year)</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <select name="year" style="width:160px;" class="form-control" id="year" required="required">
									
									<option <?=($year=='2020')?'selected':''?>>2020</option>
									
									<option <?=($year=='2021')?'selected':''?>>2021</option>
									
									<option <?=($year=='2022')?'selected':''?>>2022</option>
									
									<option <?=($year=='2023')?'selected':''?>>2023</option>
									
									<option <?=($year=='2024')?'selected':''?>>2024</option>
									
									<option <?=($year=='2025')?'selected':''?>>2025</option>
									
									<option <?=($year=='2026')?'selected':''?>>2026</option>
									
									<option <?=($year=='2027')?'selected':''?>>2027</option>
									
									<option <?=($year=='2028')?'selected':''?>>2028</option>
									
									<option <?=($year=='2029')?'selected':''?>>2029</option>
									
									<option <?=($year=='2030')?'selected':''?>>2030</option>
									
								</select>
                            </div>
                        </div>





                    </div>
                </div>


            </div>

        </div>
		<br />
		<div class="container-fluid bg-form-titel">
            <div class="row">
                
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group row m-0">
                        <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">From Date</label>
                        <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0">
                            <input type="text"  id="fdate" name="fdate" class="form-control" placeholder="Start Date" value="<?=date('Y-m-01')?>" />

                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group row m-0">
                        <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">To Date</label>
                        <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0">
                            <input type="text" id="tdate"  name="tdate" class="form-control" placeholder=" End Date" value="<?=date('Y-m-d')?>" />

                        </div>
                    </div>
                </div>

            </div>
        </div>
		<br/>

        <h4 class="text-center bg-titel bold pt-2 pb-2">
            Select report
        </h4>

        <div class="container-fluid p-0 ">
<!--            table start hear-->
            <table class="table1  table-striped table-bordered table-hover table-sm">
                <thead class="thead1">
                <tr class="bgc-info">
                    <th  width="5%"></th>
                    <th class="text-left"></th>
					<th  width="5%"></th>
                    <th class="text-left"></th>
                </tr>
                </thead>
                <tbody class="tbody1">

                <tr>
                    <td><input type="radio" placeholder="test 2" id="1" id="report" name="report" checked="checked" value="240322"/></td>
                    <td class="bold" align="left"> <label for="1">Monthly Attendence Sheet</label> </td>
					
					<td><input type="radio" placeholder="test 2" id="2" id="report" name="report" value="20220522"/></td>
                    <td class="bold" align="left"> <label for="2">Monthly Attendence Sheet (New)</label> </td>
                </tr>
				
				 <tr>
                    <td><input type="radio"  placeholder="test 2" id="3" id="report" name="report" value="81"/></td>
                    <td class="bold" align="left"> <label for="3">Attendance Summary</label> </td>
					 <td><input type="radio"  placeholder="test 2" id="4" id="report" name="report" value="994"/></td>
                   <td class="bold" align="left"> <label for="4">Department Wise Attendance Summary</label></td>
                </tr>
				
				 <tr>
                    <td><input type="radio" placeholder="test 2" id="5" id="report" name="report" value="20220524"/></td>
                   <td class="bold" align="left"> <label for="5">Roster Wise Attendance Summary</label></td>
					<td><input type="radio" id="6" placeholder="test 2" id="report" name="report" value="20220519"/></td>
                   <td class="bold" align="left"> <label for="6">IOM Report</label></td>
                </tr>
				<tr>
                    <td><input type="radio" id="7" placeholder="test 2" id="report" name="report" value="991"/></td>
                  <td class="bold" align="left"> <label for="7">Late Report</label></td>
					<td><input type="radio" id="8" placeholder="test 2" id="report" name="report" value="992"/></td>
                  <td class="bold" align="left"> <label for="8">Early Report</label></td>
                </tr>
				<tr>
                    <td><input type="radio" id="10" placeholder="test 2" id="report" name="report" value="993"/></td>
                  <td class="bold" align="left"> <label for="10">Punch Report</label></td>
					<td><input type="radio" id="11" placeholder="test 2" id="report" name="report" value="611111"/></td>
                  <td class="bold" align="left"> <label for="11">Full Leave Report Details</label></td>
                </tr>
				<tr>
                    <td><input type="radio" id="12" placeholder="test 2" id="report" name="report" value="62222"/></td>
                  <td class="bold" align="left"> <label for="12">Half Leave Report Details</label></td>
					<td><input type="radio" id="13" placeholder="test 2" id="report" name="report" value="61"/></td>
                    <td class="bold" align="left"> <label for="13">Leave Report Summary(Yearly)</label> </td>
                </tr>
				<tr>
                    <td><input type="radio" id="14" placeholder="test 2" id="report" name="report" value="995"/></td>
                  <td class="bold" align="left"> <label for="14">Leave Report Summary (Monthly)</label></td>
					<td><input type="radio" id="15" placeholder="test 2" id="report" name="report" value="9193"/></td>
                  <td class="bold" align="left"> <label for="15">Job Card</label></td>
                </tr>
				<tr>
                    
			     <tr>
			       <td><input type="radio" id="14" placeholder="test 2" id="report" name="report" value="285186"/></td>  
			       <td class="bold" align="left"> <label for="14">Out Punch Missing Report</label></td>
			         
			     </tr>
			     
                </tr>
				






                </tbody>
            </table>


            <div class="n-form-btn-class">
                <!--            button code hear-->
                <input name="submit" type="submit" class="btn1 btn1-bg-submit" id="submit" value="SHOW" />
            </div>

        </div>
    </div>

</form>


<?php /*?>
<form action="../report/master_report_att_management.php" target="_blank" method="post">

<div class="oe_view_manager oe_view_manager_current">

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

<table width="100%" border="0" class="table table-bordered table-sm">

<thead>

<tr class="table-info">

<th colspan="6"><span style="text-align: center; font-size:16px; color:#C00">Select Options</span></th>

</tr>

</thead>

<tbody>

<tr>

<td align="right" ><strong>Employee : </strong></td>

<td align="left" ><input list="pbi" type="text" style="width:160px;" name="PBI_ID" class="form-control" autocomplete="off">

<datalist  id="pbi" >

<option></option>

<? foreign_relation('personnel_basic_info','PBI_ID','concat(PBI_CODE,"-",PBI_NAME)',$PBI_ID , '1') ;?>

</datalist>

</td>

<td align="right" >&nbsp;</td>

<td align="right" ><strong>Service Length : </strong></td>

<td><select name="service_length" style="width:160px;" id="service_length" class="form-control">

<option  value="<?=$_POST['service_length']?>"></option>

<option value="1">1 Years</option>

<option value="2">2 Years</option>

<option value="3">3 Years</option>

<option value="4">4 Years</option>

<option value="5">5 Years</option>

<option value="6">6 Years</option>

<option value="7">7 Years</option>

<option value="8">8 Years</option>

<option value="9">9 Years</option>

<option value="10">10 Years</option>

</select>

</td>

</tr>

<tr>

<td width="17%" align="right" ><strong>Company : </strong></td>

<td width="25%" align="left" ><span class="oe_form_group_cell">

<select name="PBI_ORG" style="width:160px;" class="form-control" id="PBI_ORG">

<option></option>

<? foreign_relation('user_group','id','group_name',$PBI_ORG);?>

</select>

</span></td>

<td width="9%" align="right" >&nbsp;</td>

<td align="right"><strong>Designation : </strong></td>

<td align="left"><span class="oe_form_group_cell">

<select name="designation" style="width:160px;" class="form-control" id="designation">

<option></option>

<? foreign_relation('designation','DESG_ID','DESG_DESC',$designation,' 1 order by DESG_DESC');?>

</select>

</span></td>

</tr>

<tr>

<td width="23%" align="right" ><strong>Department : </strong></td>

<td width="26%"><span class="oe_form_group_cell">

<select name="department" style="width:160px;" class="form-control" id="department">

<option></option>

<? foreign_relation('department','DEPT_ID','DEPT_DESC',$PBI_DEPARTMENT,' 1 order by DEPT_DESC');?>

</select>

</span></td>

<td width="9%" align="right" >&nbsp;</td>

<td width="23%" align="right" ><strong>Job Location : </strong></td>

<td width="26%"><span class="oe_form_group_cell">

<select name="JOB_LOCATION" style="width:160px;" id="JOB_LOCATION"  class="form-control"  >

<option>

<?=$JOB_LOCATION?>

</option>

<option value="1">Head Office</option>

<option value="2">Factory</option>

</select>

</span></td>

</tr>

<tr >

<td align="right"><strong> Bank Or Cash: </strong></td>

<td><select style="width:160px;" name="bank_or_cash" id="bank_or_cash">

<option></option>

<option>Bank</option>

<option>Cash</option>

</select>

</td>

<td align="right">&nbsp;</td>

<td align="right"><strong>Job Status : </strong></td>

<td><span class="oe_form_group_cell">

<select name="job_status" style="width:160px;" class="form-control">

<option></option>

<option>In Service</option>

<option>Not In Service</option>

</select>

</span></td>

</tr>

<tr >

<td align="right"><strong>Employee Type : </strong></td>

<td align="left"><select name="EMPLOYMENT_TYPE" style="width:160px;" id="EMPLOYMENT_TYPE"  class="form-control">

<option></option>

<option>Permanent</option>

<option>Contructual</option>

<option>Probation</option>

<option>6 Months</option>

<option>Trainee</option>

</select>

</td>

<td align="right">&nbsp;</td>

<td align="right"><strong>Education : </strong></td>

<td><select name="PBI_EDU_QUALIFICATION" style="width:160px;" id="PBI_EDU_QUALIFICATION"  class="form-control">

<option></option>

<? foreign_relation('education_detail','EDUCATION_D_ID','EDUCATION_NOE',$PBI_EDU_QUALIFICATION) ;?>

</select>

</select></td>

</tr>

<tr >

<td align="right">(For Bonus)<strong>Eid : </strong></td>

<td align="left"><strong>

<select name="bonus_type" style="width:160px;" class="form-control">

<option></option>

<option value="1">Eid-Ul-Fitre</option>

<option value="2">Eid-Ul-Adha</option>

</select>

</strong></td>

<td align="right">&nbsp;</td>

<td align="right">(For Payslip)<strong>PBI ID : </strong></td>

<td><input name="pbi_id_in" style="width:160px;" type="text" id="pbi_id_in" class="form-control" /></td>

</tr>

<tr>

<td align="right">(For Payroll) <strong> Month : </strong></td>

<td align="left"><span class="oe_form_group_cell">

<select name="mon" style="width:160px;" class="form-control" id="mon">

<option></option>

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

<td align="right" >&nbsp;</td>

<td align="right" >(For Payroll)<strong> Year : </strong></td>

<td ><select name="year" style="width:160px;" class="form-control" id="year" required="required">

<option <?=($year=='2020')?'selected':''?>>2020</option>

<option <?=($year=='2021')?'selected':''?>>2021</option>

<option <?=($year=='2022')?'selected':''?>>2022</option>

<option <?=($year=='2023')?'selected':''?>>2023</option>

<option <?=($year=='2024')?'selected':''?>>2024</option>

<option <?=($year=='2025')?'selected':''?>>2025</option>

<option <?=($year=='2026')?'selected':''?>>2026</option>

<option <?=($year=='2027')?'selected':''?>>2027</option>

<option <?=($year=='2028')?'selected':''?>>2028</option>

<option <?=($year=='2029')?'selected':''?>>2029</option>

<option <?=($year=='2030')?'selected':''?>>2030</option>

</select></td>

</tr>

<tr>

<td align="right" style="background-color:#3d6485; color:#FFFFFF; font-size:16px;"><strong> Start Date : </strong></td>

<td align="left" style="background-color:#3d6485; font-size:16px;padding-top:4px"><input type="text" style="width:160px;" id="fdate" name="fdate" class="form-control" placeholder="Start Date" value="<?=date('Y-m-01')?>" /></td>

<td align="right" style="background-color:#3d6485; font-size:16px;padding-top:4px">&nbsp;</td>

<td align="right" style="background-color:#3d6485; color:#FFFFFF; font-size:16px; "><strong> End date : </strong></td>

<td style="background-color:#3d6485; font-size:16px;padding-top:4px"><input type="text" id="tdate" style="width:160px;" name="tdate" class="form-control" placeholder=" End Date" value="<?=date('Y-m-d')?>" /></td>

</tr>

</tbody>

</table>

<div style="text-align:center">

<table width="100%" class="table table-bordered table-sm">

<thead>

<tr class="">

<th colspan="4"><span style="text-align: center; font-size:16px; color:#C00">Select Report</span></th>

</tr>

</thead>

<tfoot>

</tfoot>

<tbody align="left">

<tr>

<td width="4%" align="center"><input name="report" type="radio" class="radio" value="240322" checked="checked" /></td>

<td width="44%" align="left"><strong>Monthly Attendence Sheet</strong></td>

<td align="center"><input name="report" type="radio" class="radio" value="20220522" /></td>

<td align="left"><strong>Monthly Attendence Sheet (New)</strong></td>

</tr>

<tr>

<td align="center"><input name="report" type="radio" class="radio" value="81" /></td>

<td align="left"><strong>Attendance Summary</strong></td>

<td align="center"><input name="report" type="radio" class="radio" value="994" /></td>

<td align="left"><strong>Department Wise Attendance Summary</strong></td>

</tr>

<tr>

<td align="center"><input name="report" type="radio" class="radio" value="20220524" /></td>

<td align="left"><strong>Roster Wise Attendance Summary</strong></td>

<td align="center"><input name="report" type="radio" class="radio" value="20220519" /></td>

<td align="left"><strong>IOM Report</strong></td>

</tr>

<tr>

<td align="center"><input name="report" type="radio" class="radio" value="991" /></td>

<td align="left"><strong>Late Report</strong></td>

<td align="center"><input name="report" type="radio" class="radio" value="992" /></td>

<td align="left"><strong>Early Report</strong></td>

</tr>

<tr>

<td align="center"><input name="report" type="radio" class="radio" value="993" /></td>

<td align="left"><strong>Punch Report</strong></td>

<td align="center"><input name="report" type="radio" class="radio" value="611111" /></td>

<td align="left"><strong>Full Leave Report Details</strong></td>

</tr>

<tr>

<td align="center"><input name="report" type="radio" class="radio" value="62222" /></td>

<td align="left"><strong>Half Leave Report Details</strong></td>

<td align="center"><input name="report" type="radio" class="radio" value="61" /></td>

<td align="left"><strong>Leave Report Summary(Yearly)</strong></td>

</tr>

<tr>

<td align="center"><input name="report" type="radio" class="radio" value="995" /></td>

<td align="left"><strong>Leave Report Summary (Monthly)</strong></td>

<td align="center"><input name="report" type="radio" class="radio" value="61" /></td>

<td align="left"><strong>Leave Report Summary(Yearly)</strong></td>

</tr>

<tr>

<td align="center"><input name="report" type="radio" class="radio" value="9193" /></td>

<td align="left"><strong>Job Card</strong></td>

</tr>

<!--<tr >

<td align="center" ><input name="report" type="radio" class="radio" value="97" /></td>

<td ><strong>User Access Info(97)</strong></td>

<td align="center">&nbsp;</td>

<td>&nbsp;</td>

</tr>-->

<!--<tr >

<td align="center" ><input name="report" type="radio" class="radio" value="979" /></td>

<td ><strong>Vehicle Report(979)</strong></td>

<td align="center">&nbsp;</td>

<td>&nbsp;</td>

</tr>-->

<!--<tr>

<td align="center" ><input name="report" type="radio" class="radio" value="2454" /></td>

<td><strong>Member Birthday Report (2454)</strong></td>

<td align="center">&nbsp;</td>

<td>&nbsp;</td>

</tr>

<tr>

<td align="center" ><input name="report" type="radio" class="radio" value="922" /></td>

<td><strong>Provident Fund Report(922)</strong></td>

<td align="center">&nbsp;</td>

<td>&nbsp;</td>

</tr>

<tr>

<td align="center" ><input name="report" type="radio" class="radio" value="6655" /></td>

<td><strong>Member PF Report (6655)</strong></td>

<td align="center">&nbsp;</td>

<td>&nbsp;</td>

</tr>-->

</tbody>

</table>

<input name="submit" type="submit" id="submit" value="&emsp;SHOW&emsp;" class="btn1 btn1-bg-submit" />

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

</div>

</form><?php */?>

<?

$main_content=ob_get_contents();

ob_end_clean();

include ("../../template/main_layout.php");

?>

