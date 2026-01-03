<?php



require_once "../../../assets/template/layout.top.php";



$head='<link href="../../css/report_selection.css" type="text/css" rel="stylesheet"/>';



$title='Final Payroll Proccess worker';	


do_calander('#fdate');
do_calander('#tdate');







	//if(isset($_POST['create']))
//	{
//		echo $insert_data="Insert into monthly_attendance_worker(PBI_ORG,PBI_DEPARTMENT) values('".$_POST['PBI_ORG']."','".$_POST['dept']."') ";
//		
//		mysql_query($insert_data);
//		$last_id=mysql_insert_id();
//		header("Location: monthly_attendence_worker.php?id=".$last_id."&depart=".$_POST['dept']."&org=".$_POST['PBI_ORG']." ");
//	
//	
//	
//	}



//if(isset($_POST['update'])){
//
//			
//					echo $update="update monthly_attendance_worker set PBI_ORG='".$_POST['PBI_ORG']."', PBI_DEPARTMENT='".$_POST['dept']."', year='".$_POST['year']."', 
//					month='".$_POST['month']."', week='".$_POST['week']."'  where id='".$_GET['id']."' ";
//				
//				mysql_query($update);
// 
//				header("Location: monthly_attendence_worker.php?id=".$_GET['id']);




				
//}

				if(isset($_POST['save']))
				{
					
					$crud= new crud('monthly_attendance_worker');
				$crud->insert();
				header('Location: monthly_attendence_worker.php');
				
				}


			?>


	<!--DO create 2 form with table-->

	
<script >
	function update_value(id){

				var PBI_ID=id; // Rent
				var mon = (document.getElementById('month').value)*1;
				var year = (document.getElementById('year').value)*1;
				var week = (document.getElementById('week').value)*1;
					
				var wh_sat=(document.getElementById('wh_sat_'+id).value)*1;
				var wh_sun=(document.getElementById('wh_sun_'+id).value)*1;
				var wh_mon=(document.getElementById('wh_mon_'+id).value)*1;
				var wh_tue=(document.getElementById('wh_tue_'+id).value)*1;
				var wh_wed=(document.getElementById('wh_wed_'+id).value)*1;
				var wh_thu=(document.getElementById('wh_thu_'+id).value)*1;
				var wh_fri=(document.getElementById('wh_fri_'+id).value)*1;
				var eot_sat=(document.getElementById('eot_sat_'+id).value)*1;
				var eot_sun=(document.getElementById('eot_sun_'+id).value)*1;
				var eot_mon=(document.getElementById('eot_mon_'+id).value)*1;
				var eot_tue=(document.getElementById('eot_tue_'+id).value)*1;
				var eot_wed=(document.getElementById('eot_wed_'+id).value)*1;
				var eot_thu=(document.getElementById('eot_thu_'+id).value)*1;
				var eot_fri=(document.getElementById('eot_fri_'+id).value)*1;


var strURL="monthly_attendence_ajax.php?PBI_ID="+PBI_ID+"&mon="+mon+"&year="+year+"&week="+week+"&wh_sat="+wh_sat+"&wh_sun="+wh_sun+"&wh_mon="+wh_mon+"&wh_tue="+wh_tue+"&wh_wed="+wh_wed+"&wh_thu="+wh_thu+"&wh_fri="+wh_fri+"&eot_sat="+eot_sat+"&eot_sun="+eot_sun+"&eot_mon="+eot_mon+"&eot_tue="+eot_tue+"&eot_wed="+eot_wed+"&eot_thu="+eot_thu+"&eot_fri="+eot_fri;


		var req = getXMLHTTP();

		if (req) {
			req.onreadystatechange = function() {

				if (req.readyState == 4) {
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


	<form action=""  method="post">



		<div class="d-flex justify-content-center">

			<div class="n-form1 fo-width pt-4">

				<div class="container-fluid p-0">

					<div class="row">


						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">

							<div class="form-group row m-0 mb-1 pl-3 pr-3">

								<label for="group_for" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Concern Company :   </label>

								<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">

									<span class="oe_form_group_cell">



										  <select name="PBI_ORG" id="PBI_ORG" class="form-control" required>



											  <?=foreign_relation('user_group','id','group_name',$_POST['PBI_ORG']);?>



										  </select>



									</span>

								</div>

							</div>

						</div>
						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">

							<div class="form-group row m-0 mb-1 pl-3 pr-3">

								<label for="group_for" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Month :   </label>

								<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">

									<select type="text" name="month" id="month">
										<option><?=$_POST['month']?></option>
										<option value="1">January</option>
										<option value="2">February</option>
										<option value="3">March</option>
										<option value="4">April</option>
										<option value="5">May</option>
										<option value="6">June</option>
										<option value="7">July</option>
										<option value="8">August</option>
										<option value="9">September</option>
										<option value="10">October</option>
										<option value="11">November</option>
										<option value="12">December</option>
										
									</select>



									</span>

								</div>

							</div>

						</div>
						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">

							<div class="form-group row m-0 mb-1 pl-3 pr-3">

								<label for="group_for" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Department :   </label>

								<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">

									<select name="PBI_DEPARTMENT" id="PBI_DEPARTMENT" class="form-control">

										<option></option>

										<?=foreign_relation('department','DEPT_ID','DEPT_DESC',$_POST['PBI_DEPARTMENT'],' 1 order by DEPT_DESC asc');?>

									</select>



									</span>

								</div>

							</div>

						</div>
						

						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">

							<div class="form-group row m-0 mb-1 pl-3 pr-3">

								<label for="group_for" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Week :   </label>

								<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">

									<select type="text" name="week" id="week">
										<option><?=$_POST['week']?></option>
										<option value="1st">1st Week</option>
										<option value="2nd">2nd Week</option>
										<option value="3rd">3rd Week</option>
										<option value="4th">4th Week</option>
										<option value="5th">5th Week</option>
									</select>



									</span>

								</div>

							</div>

						</div>



						

						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">



							<div class="form-group row m-0 mb-1 pl-3 pr-3">

									<label for="group_for" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Year :   </label>

									<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">

										<span class="oe_form_group_cell">

	                           			 <select type="text" name="year" id="year" >
										 
										 	<option><?=$_POST['year'];?></option>
											<option value="2023">2023</option>
											<option value="2024">2024</option>
											<option value="2025">2025</option>
											<option value="2026">2026</option>
										 </select>
						        
										</span>

									</div>

						  </div>



						</div>

						


					</div>





					<div class="n-form-btn-class">
					  <button name="create" type="submit" id="create" class="btn1 btn1-bg-submit">Initiate</button>
					  
					
					</div>



				</div>



			</div>



		</div>



		<div class="container-fluid pt-5 p-0">



			

			
			<table width="100%" class="table1  table-striped table-bordered table-hover table-sm" border="1" >
			
			<thead class="thead1">
			  <tr class="bgc-info">
				<td colspan="4">&nbsp;</td>
				<td colspan="7"><div align="center">WH</div></td>
				<td colspan="7"><div align="center">EOT</div></td>
				<td>&nbsp;</td>
				
			  </tr>
			  
			 
			  <tr class="bgc-info">
				<td>PBI ID </td>
				<td>Name</td>
				<td>Department</td>
				<td>Designation</td>
				<td>Sat</td>
				<td>Sun</td>
				<td>Mon</td>
				<td>Tue</td>
				<td>Wed</td>
				<td>Thu</td>
				<td>Fri</td>
				<td>Sat</td>
				<td>Sun</td>
				<td>Mon</td>
				<td>Tue</td>
				<td>Wed</td>
				<td>Thu</td>
				<td>Fri</td>
				<td>Action</td>
			  </tr>
		 </thead>
			  
			  <?
			  
				echo  $sql = "select p.* from personnel_basic_info p, salary_info_worker s where p.PBI_ID=s.PBI_ID and p.PBI_JOB_STATUS='In Service'  and p.PBI_ORG='".$_POST['PBI_ORG']."' and p.DEPT_ID='".$_POST['PBI_DEPARTMENT']."'";

				$query=mysql_query($sql);
				while($row=mysql_fetch_object($query))
				{
			  
			  ?>
			  
		 <tbody class="tbody1">
			  <tr class="bgc-info">
				<th><input type="text" name="PBI_ID" id="PBI_ID" value="<?=$row->PBI_ID?>" style="width:50px !important; text-align:center" readonly="readonly">
					<input type="hidden" name="month" value="<?=$_POST['month'];?>" />
					<input type="hidden" name="year" value="<?=$_POST['year'];?>" />
					<input type="hidden" name="week" value="<?=$_POST['week'];?>" />
				</th>
				<th><?=$row->PBI_NAME?></th>
				<th><input type="text" name="dept" id="dept" style="width:100px !important; text-align:center" value="<?=find_a_field('department','DEPT_DESC','DEPT_ID='.$row->DEPT_ID);?>" /></th>
				<th><?=$row->PBI_DESIGNATION?></th>
				<th><input type="text" name="wh_sat_<?=$row->PBI_ID;?>" id="wh_sat_<?=$row->PBI_ID;?>"></th>
				<th><input type="text" name="wh_sun_<?=$row->PBI_ID;?>" id="wh_sun_<?=$row->PBI_ID;?>"></th>
				<th><input type="text" name="wh_mon_<?=$row->PBI_ID;?>" id="wh_mon_<?=$row->PBI_ID;?>"></th>
				<th><input type="text" name="wh_tue_<?=$row->PBI_ID;?>" id="wh_tue_<?=$row->PBI_ID;?>"></th>
				<th><input type="text" name="wh_wed_<?=$row->PBI_ID;?>" id="wh_wed_<?=$row->PBI_ID;?>"></th>
				<th><input type="text" name="wh_thu_<?=$row->PBI_ID;?>" id="wh_thu_<?=$row->PBI_ID;?>"></th>
				<th><input type="text" name="wh_fri_<?=$row->PBI_ID;?>" id="wh_fri_<?=$row->PBI_ID;?>"></th>
				<th><input type="text" name="eot_sat_<?=$row->PBI_ID;?>" id="eot_sat_<?=$row->PBI_ID;?>"></th>
				<th><input type="text" name="eot_sun_<?=$row->PBI_ID;?>" id="eot_sun_<?=$row->PBI_ID;?>"></th>
				<th><input type="text" name="eot_mon_<?=$row->PBI_ID;?>" id="eot_mon_<?=$row->PBI_ID;?>"></th>
				<th><input type="text" name="eot_tue_<?=$row->PBI_ID;?>" id="eot_tue_<?=$row->PBI_ID;?>"></th>
				<th><input type="text" name="eot_wed_<?=$row->PBI_ID;?>" id="eot_wed_<?=$row->PBI_ID;?>"></th>
				<th><input type="text" name="eot_thu_<?=$row->PBI_ID;?>" id="eot_thu_<?=$row->PBI_ID;?>"></th>
				<th><input type="text" name="eot_fri_<?=$row->PBI_ID;?>" id="eot_fri_<?=$row->PBI_ID;?>"></th>
				<th><input type="submit" onclick="update_value(<?=$row->PBI_ID;?>)" name="save" class="btn1 btn1-bg-submit" value="Save" /></th>
				
			  </tr>
			  
		</tbody>
		
		<? } ?>
		</table>


		</div>

	</form>


<?php/*>



	<br>

<br>

<br>

<br>


<form action=""  method="post">



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

          <div  class="oe_view_manager_view_list"><div  class="oe_list oe_view">



<table width="100%" border="0" class="table table-bordered table-sm"><thead>

</thead><tbody>



<tr  class="table-primary">



    <td align="right"><strong>Year:</strong></td>



    <td>

		<select name="year"  id="year" required="required" class="form-control">



        <option <?=($year=='2020')?'selected':''?>>2020</option>



		<option <?=($year=='2021')?'selected':''?>>2021</option>



		<option <?=($year=='2022')?'selected':''?>>2022</option>



		 <option <?=($year=='2023')?'selected':''?>>2023</option>



		<option <?=($year=='2024')?'selected':''?>>2024</option>



		<option <?=($year=='2025')?'selected':''?>>2025</option>



    </select>

	</td>



	 <td align="right"><strong>Month:&nbsp;</strong></td>



    <td>



     <select name="mon"  id="mon" required="required" class="form-control">



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



    </td>







  </tr>



  <tr >



    <td align="right" class="alt">Concern Company :</td>



    <td align="left" class="alt">

		<span class="oe_form_group_cell">



      <select name="PBI_ORG" style="width:160px;" id="PBI_ORG" class="form-control" required>



        <?=foreign_relation('user_group','id','group_name',$_POST['PBI_ORG']);?>



      </select>



    </span>

	</td>





   <td align="right"><strong>Department:</strong></td>



    <td colspan="3">

		<span class="oe_form_group_cell">



      <select name="dept" style="width:160px;" id="dept" class="form-control">



	    <option></option>



        <?=foreign_relation('department','DEPT_ID','DEPT_DESC',$_POST['dept'],' 1 order by DEPT_DESC asc');?>



      </select>



    </span>



	</td>

    </tr>



	<tr >



    <td align="right" class="alt">Branch :</td>



    <td align="left" class="alt">

		<span class="oe_form_group_cell">



      <select name="PBI_BRANCH" style="width:160px;" id="PBI_BRANCH" class="form-control">



	  <option></option>



        <?=foreign_relation('branch','BRANCH_ID','BRANCH_NAME',$_POST['PBI_BRANCH']);?>



      </select>



    </span>

	</td>



    <td align="right"><strong>&nbsp;</strong></td>



    <td colspan="3">&nbsp;</td>



    </tr>



  <!--<tr>



    <td align="right" class="alt">&nbsp;</td>



    <td align="left" class="alt">&nbsp;</td>



    <td align="right"><strong>Region: </strong></td>



    <td><span class="oe_form_group_cell">



      <select name="PBI_BRANCH" id="PBI_BRANCH">



	  	<option></option>



        <?



		foreign_relation('branch','BRANCH_ID','BRANCH_NAME',$_POST['PBI_BRANCH'],' 1 order by BRANCH_NAME');?>



      </select>



    </span></td>



    <td><div align="right"><strong>Zone: </strong></div></td>



    <td><span class="oe_form_group_cell">



      <select name="PBI_ZONE" id="PBI_ZONE">



	  <option></option>



        <?



		foreign_relation('zon','ZONE_CODE','ZONE_NAME',$_POST['PBI_ZONE'],' 1 order by ZONE_NAME');?>



      </select>



    </span></td>



  </tr>-->



  <!--<tr>



    <td align="right"><strong>Bonus Month (?):</strong></td>



    <td align="left"><span class="oe_form_group_cell">



      <select name="bonus" style="width:160px;" id="bonus" required="required">



        <option <?=($bonus=='No')?'selected':''?>>No</option>



        <option <?=($bonus=='Yes')?'selected':''?>>Yes</option>



      </select>



    </span></td>



    <td align="right"><strong>Job Location: </strong></td>



    <td><span class="oe_form_group_cell">



      <select name="JOB_LOCATION" id="JOB_LOCATION">



	  <option></option>



        <? foreign_relation('office_location','ID','LOCATION_NAME',$_POST['JOB_LOCATION'],'1');?>



      </select>



    </span></td>



    <td><div align="right"><strong>Group</strong>:</div></td>



    <td><span class="oe_form_group_cell">



      <select name="PBI_GROUP" id="PBI_GROUP" style="">



	  <option></option>



        <? foreign_relation('product_group','group_name','group_name',$_POST['PBI_GROUP']);?>



      </select>



    </span></td>



  </tr>-->



  <!--<tr>



    <td align="right">&nbsp;</td>



    <td align="left">&nbsp;</td>



    <td align="right">&nbsp;</td>



    <td>&nbsp;</td>



    <td align="right"><strong>PBI ID IN:</strong></td>



    <td><input name="pbi_id_in" type="text" id="pbi_id_in" value="<?=$_POST['pbi_id_in']?>" /></td>



  </tr>-->







  </tbody></table>

<div style="text-align:center">



<table width="100%" class="oe_list_content">

<thead>

<tr class="oe_list_header_columns">

<th colspan="4"><input name="create" type="submit" id="create" value="Attendence Sheet" class="btn1 btn1-bg-submit" /></th>

</tr>

</thead>

</table>

<br />

<div class="oe_form_sheetbg">



        <div class="oe_form_sheet oe_form_sheet_width">







          <div class="oe_view_manager_view_list">







			  <div class="oe_list oe_view">



          <? if($_GET['id']>0){?>



		<table class="table1  table-striped table-bordered table-hover table-sm" border="1">



			<thead class="thead1">



				<tr class="bgc-info">



				<th>S/L</th>



				<th>Code</th>



				<th>Full Name</th>



				<th>Designation</th>



				<th>Department</th>



				<th>TD</th>



				<th>OD</th>



				<th>HD</th>



				<th>LT</th>



				<th>AB</th>



				<th>LWP</th>



				<th>LV</th>



				<th>Pre</th>



				<th>Pay</th>



				<th>Arrear</th>



				<th>&nbsp;</th>



				</tr>



			</thead>



        <tbody  class="tbody1">



        <?



//$startTime = $days1=mktime(0,0,0,($mon-1),26,$year);



//$endTime = $days2=mktime(0,0,0,$mon,25,$year);







$startTime = $days1=mktime(0,0,0,($mon),01,$year);



$endTime = $days2=mktime(0,0,0,$mon,$days_mon,$year);



$days_in_month = $days_mon = date('t',$startTime);



$startTime1 = $days1=mktime(0,0,0,($mon),01,$year);



$endTime1 = $days2=mktime(0,0,0,$mon,$days_mon,$year);



$start_date =$starting_date = $startday = date('Y-m-d',$startTime);



$end_date =$ending_date = $endday = date('Y-m-d',$endTime);





for ($i = $startTime1; $i <= $endTime1; $i = $i + 86400) {



$day   = date('l',$i);



${'day'.date('N',$i)}++;







//if(isset($$day))



//$$day .= ',"'.date('Y-m-d', $i).'"';



//else



//$$day .= '"'.date('Y-m-d', $i).'"';



}



$r_count=${'day5'};



?>



<input name="fd" type="hidden" id="fd" value="<?=$r_count;?>" />



<?

		$holy_day=find_a_field('salary_holy_day','count(holy_day)','holy_day between "'.$year.'-'.$mon.'-'.'01'.'" and "'.$year.'-'.$mon.'-'.$days_mon.'"');



		if($_POST['PBI_BRANCH']!='')	$con .= " and p.PBI_BRANCH = '".$_POST['PBI_BRANCH']."'";

		if($_POST['PBI_ZONE']!='')		$con .= " and PBI_ZONE = '".$_POST['PBI_ZONE']."'";
		if($_POST['PBI_GROUP']!='')		$con .= " and PBI_GROUP = '".$_POST['PBI_GROUP']."'";
		if($_POST['PBI_DOMAIN']!='')	$con .= " and PBI_DOMAIN = '".$_POST['PBI_DOMAIN']."'";
		if($_POST['JOB_LOCATION']!='')  $con .= " and JOB_LOCATION = '".$_POST['JOB_LOCATION']."'";
		if($_POST['pbi_id_in']!='')     $con .= " and p.PBI_ID in (".$_POST['pbi_id_in'].")";
		if($_POST['dept']!='')          $con .= " and p.DEPT_ID = '".$_POST['dept']."'";



		//echo $jday=date('d').' <br>';



		//$j_date=date('Y-m-d',mktime(0,0,0,$_POST['mon'],31,$_POST['year']));











//$//sql = "select p.* from personnel_basic_info p, salary_info s where p.PBI_ID=s.PBI_ID and p.PBI_JOB_STATUS='In Service'  and p.PBI_ORG='".$_POST['PBI_ORG']."' ".$con."



order by (s.basic_salary+s.consolidated_salary) desc";







  $sql = "select p.* from personnel_basic_info p, salary_info s where p.PBI_ID=s.PBI_ID and p.PBI_JOB_STATUS='In Service'  and p.PBI_ORG='".$_POST['PBI_ORG']."' ".$con."



order by p.PBI_DEPARTMENT,p.PBI_ID";







		$query = mysql_query($sql);



		while($info=mysql_fetch_object($query))



		{



$leave_days_lv = 0;



$leave_days_lwp = 0;



		$new_emp_days = 0;



		$new_emp_off = 0;



		$new_emp_holy_day = 0;



		if(strtotime($info->PBI_DOJ)>strtotime($starting_date))



		{



		$new_emp_days =ceil(($endTime - strtotime($info->PBI_DOJ))/(3600*24))+1;



		$new_emp_holy_day=find_a_field('salary_holy_day','count(holy_day)','holy_day between "'.$info->PBI_DOJ.'" and "'.$year.'-'.$mon.'-'.$days_mon.'"');



		${'day5'} = 0 ; for ($i = strtotime($info->PBI_DOJ); $i <= $endTime1; $i = $i + 86400) {$day   = date('l',$i);${'day'.date('N',$i)}++;}



		$new_emp_off=${'day5'};



		}















if(strtotime($info->PBI_DOJ) > strtotime($startday)){$startday=date('Y-m-d',strtotime($info->PBI_DOJ));}



else $startday = date('Y-m-d',$startTime);



$leave_days = 0;







$lsql = 'select * from hrm_leave_info where PBI_ID="'.$info->PBI_ID.'" and



((s_date<="'.$startday.'" and e_date>="'.$startday.'" and e_date!="0000-00-00") or



(s_date>="'.$startday.'" and e_date<="'.$endday.'" and e_date!="0000-00-00" ) or



(s_date between "'.$startday.'" and "'.$endday.'" and total_days="0.5") or



(s_date<="'.$endday.'" and e_date>="'.$endday.'" and e_date!="0000-00-00"))';



$qquery = mysql_query($lsql);



while($le = mysql_fetch_object($qquery))



{



$leave_day = 0;



if(($le->s_date<=$startday)&&($le->e_date>=$startday))



{



$start_date = $startday;



if($le->e_date>=$endday) $end_date = $endday;



else $end_date = $le->e_date;











$date1=date_create($start_date);



$date2=date_create($end_date);



$diff=date_diff($date1,$date2);



 $leave_day = $diff->d +1 ;







$leave_days = $leave_days + $leave_day;



}



elseif(($le->s_date>=$startday)&&($le->e_date<=$endday))



{



$start_date = $le->s_date;



$end_date = $le->e_date;











$date1=date_create($start_date);



$date2=date_create($end_date);



$diff=date_diff($date1,$date2);







if($le->total_days=='0.5')



$leave_day = .5 ;



else $leave_day = $diff->d + 1 ;



$leave_days = $leave_days + $leave_day;



			}



			elseif(($le->s_date<=$startday)&&($le->e_date>=$endday))



			{



				$start_date = $startday;



				$end_date = $endday;



$date1=date_create($start_date);



$date2=date_create($end_date);



$diff=date_diff($date1,$date2);







$leave_day = $diff->d +1 ;



$leave_days = $leave_days + $leave_day;



			}



			elseif(($le->s_date<=$endday)&&($le->e_date>=$endday))



			{



$start_date = $le->s_date;



$end_date = $endday;



$date1=date_create($start_date);



$date2=date_create($end_date);



$diff=date_diff($date1,$date2);







$leave_day = $diff->d +1 ;



$leave_days = $leave_days + $leave_day;



			}



			else



			echo 'doom';



			}







$leave_days_lwp = 0;



$leave_days_lv =  0;



//echo '<br>'.$info->PBI_ID.' - ';



//echo $startday.' - ';



//echo $info->PBI_DUE_DOJ;



if($startday>$info->PBI_DUE_DOJ)



{



$leave_days_lwp = 0;



$leave_days_lv = $leave_days;}



else



{



$leave_days_lwp = $leave_days;



$leave_days_lv = 0;}











$mobile_bills = find_a_field('hrm_moblie_bill','mobile_bill','emp_id="'.$info->PBI_ID.'" and `month`="'.$mon.'" and `year`="'.$year.'" ');



$other_bill = find_a_field('hrm_other_bill','other_bill','emp_id="'.$info->PBI_ID.'" and `month`="'.$mon.'" and `year`="'.$year.'" ');







if(@$att->od=='') @$att->od = $r_count;











		$data = find_all_field('salary_attendence','','PBI_ID="'.$info->PBI_ID.'" and mon="'.$mon.'" and year="'.$year.'" ');



		if($data->td>0)



		{



			$status='Edit';



			$att->status = 0;



			$att->remarks = '';



		}



		else



		{



			if($info->special_attendence==0)



			{



			$att = find_all_field('hrm_attendence_final','','PBI_ID="'.$info->PBI_ID.'" and mon="'.$mon.'" and year="'.$year.'" ');







			}



			else



			{



			$att->lt = 0;



			$att->ab = 0;



			$att->lv = 0;



			$att->ot = 0;







			$att->pay = $days_mon;



			$att->pre = $days_mon - ($holy_day + $r_count);



			}



			$status='Save';



			$pay = $days_mon;



			$pre = $days_mon - ($holy_day + $r_count);



		}















?>



        <tr style="font-size:10px; padding:3px; "><td><?=++$S?></td>



          <td><strong><?=$info->PBI_CODE?></strong>



            <input name="dept_<?=$info->PBI_ID?>" type="hidden" id="dept_<?=$info->PBI_ID?>"  value="<?=$info->PBI_DEPARTMENT;?>" />



            <input type="hidden" name="PBI_ID" id="PBI_ID" value="<?=$info->PBI_ID?>" /></td>







<? if ($att->ab > '6' || $data->ab > '6') { ?>



<td style="color: #FF0000"><b><strong><?=$info->PBI_NAME?></strong></b></td>



<? }else{ ?>



<td><strong><?=$info->PBI_NAME?></strong></td>



<? } ?>



















<td><? ($data->pbi_designation!='')?$desg_id=$data->pbi_designation:$desg_id=$info->DESG_ID; echo find_a_field('designation','DESG_SHORT_NAME','DESG_ID='.$desg_id)?></td><td><?=$info->PBI_DEPARTMENT; ?> </td>



          <!--<td align="center"><?



          $res = "select concat(a.AREA_NAME,'-',d.dealer_name_e) dealer from area a, dealer_info d where a.AREA_CODE=d.area_code and d.dealer_code=".$data->dealer_code;



		  $resq = @mysql_query($res);



		  $res_data = @mysql_fetch_object($resq); echo $res_data->dealer; ?></td>-->



          <td align="center"><input name="td_<?=$info->PBI_ID?>" type="text" id="td_<?=$info->PBI_ID?>" style="font-size:10px; width:20px; min-width:20px;border: 1px solid blue;"



value="<? if($data->td==0){if($att->td>0) echo $att->td; else {if($new_emp_days>0) echo $new_emp_days; else echo $days_mon;}} else echo $data->td;?>" size="2" maxlength="2" readonly="readonly" /></td>



<td align="center"><input name="od_<?=$info->PBI_ID?>" type="text" id="od_<?=$info->PBI_ID?>" style="font-size:10px; width:20px; min-width:20px;border: 1px solid blue;" size="2" maxlength="2" value="<?=($data->od=='')?$att->od:$data->od;?>" /></td>



<td align="center"><input name="hd_<?=$info->PBI_ID?>" type="text" id="hd_<?=$info->PBI_ID?>" style="font-size:10px; width:20px; min-width:20px;border: 1px solid blue;" size="2" maxlength="2" value="<?=($data->hd=='')?$att->hd:$data->hd;?>" /></td>



<td align="center"><input name="lt_<?=$info->PBI_ID?>" type="text" id="lt_<?=$info->PBI_ID?>" style="font-size:10px; width:40px; min-width:40px;border: 1px solid blue;" value="<?=($data->lt=='')?$att->lt:$data->lt;?>" size="2" maxlength="2" onchange="cal_all(<?=$info->PBI_ID?>)" /></td>







<td align="center">



<input name="ab_<?=$info->PBI_ID?>" type="text" id="ab_<?=$info->PBI_ID?>" style="font-size:10px; width:40px; min-width:40px;border: 1px solid blue;"



value="<?=($data->ab=='')?$att->ab:$data->ab;?>" size="2" maxlength="2"  onchange="cal_all(<?=$info->PBI_ID?>)"/></td>











<td align="center"><input name="lwp_<?=$info->PBI_ID?>" type="text" id="lwp_<?=$info->PBI_ID?>" style="font-size:10px; width:35px; min-width:28px;border: 1px solid blue;" value="<?=($data->lwp=='')?$att->lwp:$data->lwp;?>" size="4" maxlength="4"  onchange="cal_all(<?=$info->PBI_ID?>)"/></td>



<td align="center"><input name="lv_<?=$info->PBI_ID?>" type="text" id="lv_<?=$info->PBI_ID?>" style="font-size:10px; width:35px; min-width:28px;border: 1px solid blue;" value="<?=($data->lv=='')?$att->lv:$data->lv;?>" size="4" maxlength="4"  onchange="cal_all(<?=$info->PBI_ID?>)"/></td>



<td align="center"><input name="pre_<?=$info->PBI_ID?>" type="text" id="pre_<?=$info->PBI_ID?>" style="font-size:10px; width:35px; min-width:20px;border: 1px solid blue;" onchange="cal_all(<?=$info->PBI_ID?>)" value="<?=($data->pre=='')?$att->pre:$data->pre;?>" size="2" maxlength="2" readonly="readonly" /></td>



<td align="center"><input name="pay_<?=$info->PBI_ID?>" type="text" id="pay_<?=$info->PBI_ID?>" style="font-size:10px; width:35px; min-width:20px;border: 1px solid blue;" value="<?=($data->pay=='')?$att->pay:$data->pay;?>" size="2" maxlength="2" readonly="readonly" onchange="cal_all(<?=$info->PBI_ID?>)" /></td>







<!--<td align="center"><input type="checkbox" name="pbi_held_up_<?=$info->PBI_ID?>" id="pbi_held_up_<?=$info->PBI_ID?>"







<? if($data->pbi_held_up==0){if($att->status>0) echo 'CHECKED="CHECKED"';}



else echo 'CHECKED="CHECKED"'; ?> value="1"/></td>-->







<!--<td align="center"><input name="remarks_<?=$info->PBI_ID?>" type="text" id="remarks_<?=$info->PBI_ID?>" style="font-size:10px; width:100px; min-width:20px;"



value="<?=($data->remarks=='')?$att->remarks:$data->remarks;?>" size="10" maxlength="50" /></td>-->







          <td align="center"><input name="benefits_<?=$info->PBI_ID?>" type="text" id="benefits_<?=$info->PBI_ID?>" style="font-size:10px; width:35px; min-width:20px;border: 1px solid blue;" value="<?=$data->salary_arrear?>" size="8" maxlength="8" /></td>







          <td align="center"><span id="divi_<?=$info->PBI_ID?>">



            <?







			  if($status=='Edit')



			  {



			  if($_SESSION['user']['level']==5||$_SESSION['user']['level']==2)



			  {?><input type="button" class="btn1 btn1-bg-submit" name="Button" value="<?=$status?>"  onclick="cal_all(<?=$info->PBI_ID?>), update_value(<?=$info->PBI_ID?>)"/>



			    <input type="button" class="btn1 btn1-bg-cancel" name="Button" value="Delete"  onclick="delete_value(<?=$info->PBI_ID?>)"/><?



			  }



			  else echo 'Saved';



			  }



			  else



			  {



			  ?><input type="button" class="btn1 btn1-bg-submit"  name="Button" value="<?=$status?>"  onclick="cal_all(<?=$info->PBI_ID?>), update_value(<?=$info->PBI_ID?>)"/><? }?>



          </span>&nbsp;</td>



          </tr>



        <?



		}



		?>



        </tbody>







        <tfoot>



        <tr>



		<td colspan="16" style="background:#ccc;">&nbsp;</td>



        </tr>



        </tfoot>



        </table>



		</div>

		  </div>



          </div>



    </div>



<p>



  <!--<input name="save" type="submit" id="save" value="SAVE" />-->



</p>



		<? }?>



  </div>

			  </div></div>



          </div>



    </div>



    <div class="oe_chatter"><div class="oe_followers oe_form_invisible">



      <div class="oe_follower_list"></div>



    </div></div></div></div></div>



    </div></div>







        </div>



  </div>



</form>





	<*/?>







<?



require_once "../../../assets/template/layout.bottom.php";



?>