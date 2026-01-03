<?php
session_start();
ob_start();
require_once "../../../assets/support/inc.all.php";
$title="Auto Payroll";


do_calander("#m_date");


$head =
'<link href="../../css/report_selection.css" type="text/css" rel="stylesheet"/>';
$table = "hrm_inout";
$unique = "id";
$fix_intime = "05:00:00";

$fix_outtime = "11:59:00";
if (isset($_POST["upload"])) {

$year_mon = $_POST['salary_month'];

$data =explode("-",$_POST['salary_month']);

$year =$data[0];

$mon = $data[1];

$mon_type = find_a_field('salary_months','month_type','salary_month="'.$_POST['salary_month'].'"');

$mon_date = find_all_field('month_type','','1 and id='.$mon_type);





if($mon_type==1){

	$start_mon =date('m', strtotime(date(''.$year.'-'.$mon.'')." -1 month"));

	$start_year =date('Y', strtotime(date(''.$year.'-'.$mon.'')." -1 month"));

	

	$start_date = $start_year."-".$start_mon."-".$mon_date->month_start;

	$end_date  = $year."-".$mon."-".$mon_date->month_end;

}

else{



	$start_date = $year."-".$mon."-".$mon_date->month_start;

	$end_date  = $year."-".$mon."-".$mon_date->month_end;



}








$emp_id = find_a_field('personnel_basic_info','PBI_ID','PBI_CODE="'.$_POST['emp_id'].'"');
$PBI_ORG = $_POST["PBI_ORG"];

if($_POST['JOB_LOCATION']>0) $job_location_con = " and p.JOB_LOC_ID='".$_POST['JOB_LOCATION']."'";
$datetime = date("Y-m-d H:i:s");
$startTime = $days1 = strtotime($start_date);
$days_in_month = date('t',$startTime);
$days_mon = date("t", $startTime);
$endTime = $days2 = mktime(23, 59, 59, $mon, $days_in_month, $year);

$m_s_date = $year . "-" . $mon . "-01";
$m_e_date = $year . "-" . $mon . "-" . $days_mon;









$sql ="SELECT h.*,s.*,p.DESG_ID,p.DEPT_ID,p.PBI_ORG
 
 
FROM `hrm_attendence_final` h,personnel_basic_info p ,salary_info s
 
 WHERE p.PBI_ID=h.PBI_ID and h.PBI_ID=s.PBI_ID and h.mon='" .$mon ."' and h.year='" .$year ."' " .$emp_con .$ORG_con .$job_location_con.

"  group by h.PBI_ID";

$query = mysql_query($sql);

while ($data = mysql_fetch_object($query)) {
$pi++;

//___________Attendance__________	
$values[$pi]["PBI_ID"] = $data->PBI_ID;
$values[$pi]['designation'] = $data->DESG_ID;
$values[$pi]['department'] = $data->DEPT_ID;
$values[$pi]['job_location'] = $data->job_location;
$values[$pi]['pbi_organization'] = $data->PBI_ORG;


$values[$pi]["td"] = $data->td;
$values[$pi]['od'] = $data->od;
$values[$pi]["hd"] = $data->hd;
$values[$pi]['lt'] = $data->lt;
$values[$pi]["ab"] = $data->ab;
$values[$pi]['lwp'] = $data->lwp;
$values[$pi]["lv"] = $data->lv;
$values[$pi]['pre'] = $data->pre;
$values[$pi]["pay"] = $data->pay;
$values[$pi]["ot"] = $data->overtime_hour;
//___________Salary Information__________
$values[$pi]["gross_salary"] = $data->gross_salary;
$values[$pi]['basic_salary'] = $data->basic_salary;
$values[$pi]["house_rent"] = $data->house_rent;
$values[$pi]['medical_allowance'] = $data->medical_allowance;
$values[$pi]["ta_da_data"] = $data->ta;
$values[$pi]['mobile_allowance'] = $data->mobile_allowance;
$values[$pi]["bank_or_cash"] = $data->cash_bank;
$values[$pi]["over_time_amount"] = round(((($data->gross_salary)/240)*($data->overtime_hour)));



//________DEDUCTIONS_________
$values[$pi]['income_tax'] = $data->income_tax;
$values[$pi]["pf"] = $data->pf;

//_______ JOINING DEDUCTION _____
$joining_data = find_all_field_sql("SELECT PBI_ID, PBI_DOJ FROM personnel_basic_info WHERE PBI_ID='".$data->PBI_ID."' and PBI_DOJ BETWEEN '".$start_date."' AND '".$end_date."' ");
if ($joining_data->PBI_ID>0) {
$joining_date = strtotime($joining_data->PBI_DOJ);
$month_first_date = strtotime($start_date);
$datediff = $joining_date - $month_first_date;
$joining_ab_days =  round($datediff / (60 * 60 * 24));
$values[$pi]["joining_deduction"]=((($data->gross_salary)/(30))*($joining_ab_days));

}

//____________LATE __________
$late_deduct_day = ((int) $data->lt /3);
$late_deduct_days = floor($late_deduct_day);
if($late_deduct_days>0)
$values[$pi]["late_deduction"] = round(((($data->basic_salary)/($data->td))*($late_deduct_days)));

$values[$pi]["absent_deduction"] = round(((($data->gross_salary)/($data->td))*(($data->lwp+$data->ab))+$values[$pi]["joining_deduction"]));

$values[$pi]["administrative_deduction"]= find_a_field('hrm_admin_action_detail','sum(ADMIN_ACTION_AMT)','ADMIN_ACTION_DATE between "'.$start_date.'" and "'.$end_date.'" and PBI_ID="'.$data->PBI_ID.'" ');

//________ ADVANCE ______
$values[$pi]["advance_install"] = find_a_field('salary_advance','sum(payable_amt)','PBI_ID="'.$data->PBI_ID.'" and current_mon="'.$mon.'" and  	current_year="'.$year.'" and  	
 advance_type="Advance Cash" ');

$values[$pi]["motorcycle_install"] = find_a_field('motorcycle_install','sum(payable_amt)','PBI_ID="'.$data->PBI_ID.'" and current_mon="'.$mon.'" and  	current_year="'.$year.'" and  	
advance_type="Advance Cash" ');

$values[$pi]["other_install"] = find_a_field('salary_advance','sum(payable_amt)','PBI_ID="'.$data->PBI_ID.'" and current_mon="'.$mon.'" and  	current_year="'.$year.'" and  	
advance_type="Other Advance" ');

//_______SALARY______
$values[$pi]["total_salary"] = $data->gross_salary;
$values[$pi]["total_deduction"] = $values[$pi]["advance_install"]+$values[$pi]["other_install"]+$values[$pi]['income_tax']+$values[$pi]["late_deduction"]+$values[$pi]["absent_deduction"]+$values[$pi]["pf"];

$values[$pi]["total_benefits"] = $values[$pi]["over_time_amount"];
$values[$pi]["total_payable"]= round((($data->gross_salary) - $values[$pi]["total_deduction"]))+$values[$pi]["total_benefits"];

//__________CASH BANK SALARY _________

if($data->cash_bank=="Both"){
$values[$pi]["cash_amt"] = $data->cash_amt;
$values[$pi]["bank_amt"] = $data->bank_amt-$values[$pi]["total_deduction"];
}elseif($data->cash_bank=="Bank"){
$values[$pi]["cash_amt"]=0;
$values[$pi]["bank_amt"] = $values[$pi]["total_payable"];
}elseif($data->cash_bank=="Cash"){
$values[$pi]["bank_amt"] = 0;
$values[$pi]["cash_amt"] = $values[$pi]["total_payable"];
}else{
$values[$pi]["bank_amt"] = 0;
$values[$pi]["cash_amt"]  = 0;
}


$pf_date   = $year.'-'.($mon).'-'.$days_mon;


}





//***************** INSERT & UPDATE DATA *******************////////

for ($y = 1; $y <= $pi; $y++) {
$found = find_a_field("salary_attendence","1",'PBI_ID="' .$values[$y]["PBI_ID"] .'" and mon="' .$mon .'" and year="' .$year .'"');

if ($found == 0) {

 $sql ="INSERT INTO `salary_attendence` 

(`mon`, `year`, `PBI_ID`, designation,department,`td`, `od`, `hd`, `lt`,`ab`, `lv`,`lwp`, `pre`, `pay`,`ot`, `entry_at`, `entry_by`,
gross_salary,basic_salary,house_rent,medical_allowance,ta_da_data,mobile_allowance,income_tax,bank_or_cash,pf,pbi_organization,

over_time_amount,absent_deduction,joining_deduction,late_deduction,advance_install,other_install,total_deduction,total_salary,
cash_amt,bank_amt,total_payable,hr_action_amt


) 

values ('" .$mon."','".$year."','" .$values[$y]["PBI_ID"] ."','" .$values[$y]["designation"] ."','" .$values[$y]["department"] ."','" .$values[$y]["td"] ."','" .$values[$y]["od"] ."', 
'" .$values[$y]["hd"] ."','" .$values[$y]["lt"] ."','" .$values[$y]["ab"] ."','" .$values[$y]["lv"] ."','" .$values[$y]["lwp"] ."',
'" .$values[$y]["pre"] ."','" .$values[$y]["pay"] ."','" .$values[$y]["ot"] ."','" .date("Y-m-d H:i:s")."', '".$_SESSION["user"]["id"]."',
'" .$values[$y]["gross_salary"] ."','" .$values[$y]["basic_salary"] ."','" .$values[$y]["house_rent"] ."','" .$values[$y]["medical_allowance"] ."','" .$values[$y]["ta_da_data"] ."',
'" .$values[$y]["mobile_allowance"] ."','" .$values[$y]["income_tax"] ."','" .$values[$y]["bank_or_cash"] ."','" .$values[$y]["pf"] ."','" .$values[$y]["pbi_organization"] ."',

'" .$values[$y]["over_time_amount"] ."','" .$values[$y]["absent_deduction"] ."','" .$values[$y]["joining_deduction"] ."','" .$values[$y]["late_deduction"] ."','" .$values[$y]["advance_install"] ."',
'" .$values[$y]["other_install"] ."','" .$values[$y]["total_deduction"] ."','" .$values[$y]["total_salary"] ."','" .$values[$y]["cash_amt"]."','" .$values[$y]["bank_amt"] ."',
'" .$values[$y]["total_payable"] ."','" .$values[$y]["administrative_deduction"] ."')";

mysql_query($sql);

//______________ FOR PROVIDENT FUND  INSERET_______/////
if($values[$y]["pf"]>0){
$pf_insert="INSERT INTO provident_fund (PBI_ID,year,mon,pf_amount,date,entry_by) 
VALUES ('".$values[$y]["PBI_ID"]."','".$year."', '".$mon."', '".$values[$y]["pf"]."','".$start_date."','".$_SESSION["user"]["id"]."' ) ";
$pf_query=mysql_query($pf_insert);
}


} else {

  $sql = "Update `salary_attendence` set td='" .$values[$y]["td"] ."', od='" .$values[$y]["od"] ."',hd='" .$values[$y]["hd"] ."', lt='" .$values[$y]["lt"] ."',ab='" .$values[$y]["ab"] ."',
lv='" .$values[$y]["lv"] ."',lwp='" .$values[$y]["lwp"] ."',pre='" .$values[$y]["pre"] ."',pay='" .$values[$y]["pay"] ."',

gross_salary='" .$values[$y]["gross_salary"] ."', basic_salary='" .$values[$y]["basic_salary"] ."',bank_or_cash='" .$values[$y]["bank_or_cash"] ."',

pf='" .$values[$y]["pf"] ."', pbi_organization='" .$values[$y]["pbi_organization"] ."' , over_time_amount='" .$values[$y]["over_time_amount"] ."',

absent_deduction='" .$values[$y]["absent_deduction"] ."',joining_deduction='" .$values[$y]["joining_deduction"] ."',late_deduction='" .$values[$y]["late_deduction"] ."',

advance_install='" .$values[$y]["advance_install"] ."',other_install='" .$values[$y]["other_install"] ."',total_deduction='" .$values[$y]["total_deduction"] ."',

total_salary='" .$values[$y]["total_salary"] ."',cash_amt='" .$values[$y]["cash_amt"] ."',bank_amt='" .$values[$y]["bank_amt"] ."',

total_payable='" .$values[$y]["total_payable"] ."',hr_action_amt='" .$values[$y]["administrative_deduction"] ."', ot='" .$values[$y]["ot"] ."',

entry_at='" .date("Y-m-d H:i:s") ."',
entry_by='" .$_SESSION["user"]["id"] ."' where mon='" .$mon ."' and year='" .$year ."' and PBI_ID='" .$values[$y]["PBI_ID"] ."'";

mysql_query($sql);

//______________ FOR PROVIDENT FUND  UPDATE ________/////
$pf_update = "UPDATE provident_fund SET year='".$year."',mon='".$mon."',pf_amount='".$values[$y]["pf"]."',date='".$start_date."',entry_by='".$_SESSION["user"]["id"]."' 
WHERE mon='".$mon."' and PBI_ID='".$values[$y]["PBI_ID"]."' and year='".$year."'";
$pf_update_query=mysql_query($pf_update);




}

}

echo "Complete";

//echo $sql;

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



            <h4 class="text-center bg-titel bold pt-2 pb-2">Salary Process HRM Attendance Final</h4>



            <div class="container-fluid p-0">



                <div class="row">



                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">



                        <div class="form-group row  m-0 mb-1 pl-3 pr-3">



                            <label for="group_for" class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Employee Code :  </label>



                            <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0 pr-2">



                          
							  
							  
    <input type="text"  list='eip_ids' name="emp_id" id="emp_id" value="<?=$_POST['emp_id']?>" />
                <datalist id='eip_ids'>
                  <option></option>
                  <?
			foreign_relation('personnel_basic_info','PBI_CODE','concat(PBI_CODE," - ",PBI_NAME)',$emp_id,'1');
			?>
                </datalist>



                            </div>



                        </div>



                    </div>







                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">







                        <div class="form-group row m-0 mb-1 pl-3 pr-3">



                            <label for="group_for" class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Company :    </label>



                            <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0 pr-2">



                              <select name="PBI_ORG" id="PBI_ORG">







								<? foreign_relation('user_group','id','group_name',$PBI_ORG);?>



								



								</select>



                            </div>



                        </div>







                    </div>



					



					<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">







                        <div class="form-group row m-0 mb-1 pl-3 pr-3">



                            <label for="group_for" class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Job Location :    </label>



                            <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0 pr-2">



                              







								<select name="JOB_LOCATION" id="JOB_LOCATION"  class="form-control" required  >



								<!--	  <option><?=$JOB_LOCATION?></option>-->



									 <option value="1">Head Office</option>



									 <option value="2">Factory</option>



									 



                  				</select>



                            </div>



                        </div>



						



                    </div>







                    











                    















                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">



                                

							<div class="form-group row m-0 mb-1 pl-3 pr-3">



                                    <label for="group_for" class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Month :    </label>



                                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0 pr-2">







                                       <select name="salary_month"  id="salary_month" required>

	

												  <option></option>

	

												  <?=foreign_relation('salary_months','salary_month','salary_month',$_POST['salary_month'],'1 and status="Active"');?>

											  </select>







                                    </div>



                                </div>

								



                            </div>







                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">



                                



								



                            </div>















                </div>











                <div class="n-form-btn-class">



                    <input name="upload" type="submit" class="btn1 btn1-bg-submit" id="upload" value="Sync All Data" />



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







<tr>







<td height="40" colspan="4" bgcolor="#00FF00"><div align="center" class="style1">Salary Process - hrm_attendence_final</div></td>







</tr>







<tr>







<td>Employee ID</td>







<td colspan="3"><label>







<input type="text" name="emp_id" id="emp_id" value="<?= $_POST[







"emp_id"







] ?>" />







</label></td>







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







<? foreign_relation('job_location_type','id','job_location_name',$JOB_LOCATION);?>







</select>







</span></td>







</tr>







<tr>







<td width="20%">Month :</td>







<td colspan="3"><span class="oe_form_group_cell">







<select name="mon" style="width:160px;" id="mon" required="required">







<option value="1" <?= $mon == "01" ? "selected" : "" ?>>Jan</option>







<option value="2" <?= $mon == "02" ? "selected" : "" ?>>Feb</option>







<option value="3" <?= $mon == "03" ? "selected" : "" ?>>Mar</option>







<option value="4" <?= $mon == "04" ? "selected" : "" ?>>Apr</option>







<option value="5" <?= $mon == "05" ? "selected" : "" ?>>May</option>







<option value="6" <?= $mon == "06" ? "selected" : "" ?>>Jun</option>







<option value="7" <?= $mon == "07" ? "selected" : "" ?>>Jul</option>







<option value="8" <?= $mon == "08" ? "selected" : "" ?>>Aug</option>







<option value="9" <?= $mon == "09" ? "selected" : "" ?>>Sep</option>







<option value="10" <?= $mon == "10" ? "selected" : "" ?>>Oct</option>







<option value="11" <?= $mon == "11" ? "selected" : "" ?>>Nov</option>







<option value="12" <?= $mon == "12" ? "selected" : "" ?>>Dec</option>







</select>







</span></td>







</tr>







<tr>







<td>Year :</td>







<td colspan="3"><select name="year" style="width:160px;" id="year" required="required">







<option <?= $year == "2022" ? "selected" : "" ?>>2022</option>







<option <?= $year == "2023" ? "selected" : "" ?>>2023</option>







<option <?= $year == "2021" ? "selected" : "" ?>>2021</option>







</select></td>







</tr>







<tr>







<td colspan="4">







<div align="center">







<input name="upload" type="submit" class="btn1 btn1-bg-submit" id="upload" value="Sync All Data" />







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







</form>   </div><?php */?>







<?







$main_content=ob_get_contents();







ob_end_clean();







include ("../../template/main_layout.php");







?>