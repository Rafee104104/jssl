<?
session_start();
require "../../config/inc.all.php";

$crud      =new crud('salary_attendence');
$unique = 'id';
$mon=$_GET['mon'];
$year=$_GET['year'];

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
$s_date = $syear.'-'.($smon).'-26';
$startTime = $days1 = strtotime($s_date);
//$days_mon = date('t',$s_date);
//$days_mon = 31;    // ------------------------------- Total Days of Month
//$days_mon = find_a_field('hrm_payroll_setup','value','type="daysofmonth"');
$da =  find_all_field('hrm_payroll_setup','',' `year` = "'.$year.'" and `mon` = "'.$mon.'" ');
$days_mon = $da->days_of_month;
//echo $days_mon;
$e_date   = $year.'-'.($mon).'-25';
$endTime = $days2=mktime(0,0,0,$mon,26,$year);


$basic_info = find_all_field('personnel_basic_info','','PBI_ID='.$_REQUEST['PBI_ID']);

//$_REQUEST['fd'] = 5; // -----------------------------------TOTAL FRIDAY
//$_REQUEST['fd'] = find_a_field('hrm_payroll_setup','value','type="friday"');
$_REQUEST['fd'] = $da->friday_of_month;


$_REQUEST['pbi_department'] = $basic_info->PBI_DEPARTMENT;
$_REQUEST['pbi_designation'] = $basic_info->DESG_ID;
$_REQUEST['pbi_organization'] = $basic_info->PBI_ORG;
$_REQUEST['pbi_job_location'] = $basic_info->JOB_LOCATION;

$_REQUEST['pbi_region'] = $basic_info->PBI_BRANCH;
$_REQUEST['pbi_zone'] = $basic_info->PBI_ZONE;
$_REQUEST['pbi_area'] = $basic_info->PBI_AREA;
$_REQUEST['pbi_group'] = $basic_info->PBI_GROUP;


//echo 'PBI_ID="'.$_REQUEST['PBI_ID'].'" and mon="'.$_REQUEST['mon'].'" and year="'.$_REQUEST['year'].'" ';
$_POST[$unique] = $$unique = find_a_field('salary_attendence','id','PBI_ID="'.$_REQUEST['PBI_ID'].'" and mon="'.$_REQUEST['mon'].'" and year="'.$_REQUEST['year'].'" ');

$salary = find_all_field('salary_info','','PBI_ID='.$_REQUEST['PBI_ID']);
$_REQUEST['basic_salary'] = $salary->basic_salary;
$_REQUEST['basic_salary_payable'] = round((($salary->basic_salary/$days_mon)*$_REQUEST['pay']));
$_REQUEST['ta_da_data'] = $salary->ta;


//$salary_date=date('Y-m-d',mktime(0,0,0,$_REQUEST['mon'],1,$_REQUEST['year']));

$_REQUEST['house_rent']=$salary->house_rent;

if($_REQUEST['td']<$days_mon)
$_REQUEST['house_rent']=$salary->house_rent = ($salary->house_rent/$days_mon)*$_REQUEST['pay'];
else
$_REQUEST['house_rent']=$salary->house_rent;

$_REQUEST['medical_allowance']=$salary->medical_allowance;
$_REQUEST['other_allowance']=$salary->others;

$_REQUEST['spl_alw_data'] = $salary->special_allowance+$salary->incentive_allowance;

$_REQUEST['special_allowance']=$salary->special_allowance = round((($_REQUEST['spl_alw_data']/$days_mon)*($_REQUEST['pay']+$_REQUEST['lt'])));

$_REQUEST['mobile_allowance']=$salary->mobile_allowance;

$nnjoin_date  = strtotime($basic_info->PBI_DOJ);
$nnstart_date = strtotime($s_date);
$nnend_date = strtotime($e_date);
$datediff =  $nnjoin_date - $nnstart_date;



// ----------------------------------------------------- extra 2000 taka
$join_days = round($datediff / (60 * 60 * 24));
$ins_days = 90 + round($datediff / (60 * 60 * 24));


if($basic_info->PBI_DOJ>'2018-12-25'&&$basic_info->DESG_ID==185&&($basic_info->incentive_status=='YES')){
		if($join_days>0){
		$days_count =$_REQUEST['pay'];
				
		}elseif($ins_days>$days_mon){
		$days_count = $_REQUEST['pay'];

		} else {
			if($_REQUEST['pay']>$ins_days)
			$days_count =$ins_days;
			else
			$days_count =$_REQUEST['pay'];
			}

if ($days_count<0) {$days_count=0;}
$_REQUEST['incentive_days'] = $days_count;
$_REQUEST['special_allowance']=$salary->special_allowance = round(((2000/$days_mon)*$days_count)+$salary->incentive_allowance);
if($salary->special_allowance>0)
$_REQUEST['spl_alw_data'] = 2000+$salary->incentive_allowance;

}
else $_REQUEST['incentive_days'] = 0;
// ---------------------------------------------END Extra 2000 taka

if($salary->ta>1000)
$_REQUEST['ta_da']=number_format((($salary->ta/($days_mon-$_REQUEST['fd']))*($_REQUEST['pre'])),0,'.','');
else
$_REQUEST['ta_da']=number_format(($salary->ta*($_REQUEST['pre']+$_REQUEST['hd'])),0,'.','');

$_REQUEST['food_allowance']=$salary->food_allowance;
$_REQUEST['cooperative_share']=$salary->cooperative_share;
$_REQUEST['income_tax']=$salary->income_tax;
$_REQUEST['vehicle_allowance']=($salary->vehicle_allowance/$days_mon)*$_REQUEST['pay'];

$_REQUEST['over_time_amount']=(($salary->basic_salary+$salary->consolidated_salary+$salary->special_allowance)/208)*($_REQUEST['ot']);
$_REQUEST['absent_deduction']=round(((($salary->basic_salary+$salary->consolidated_salary+$_REQUEST['spl_alw_data'])/($days_mon))*(($_REQUEST['lwp']+$_REQUEST['ab']))));
$_REQUEST['late_deduction']=round(((($salary->basic_salary+$salary->consolidated_salary)/($days_mon))*($_REQUEST['lt'])));

if($salary->food_allowance>0)
$_REQUEST['food_allowance'] = (($salary->food_allowance)*($_REQUEST['pre']));




//if($salary->commission_type=="Conditional" && $salary->fixed_commission>0 && $salary->comm_till_date>$salary_date)
//$_REQUEST['fixed_commission'] = (int)($salary->fixed_commission);


/*if($salary->ta_type=="DA"&&$salary->ta>0)
{
$_REQUEST['ta_da'] = (int)(@($salary->ta/25)*($_REQUEST['pre']+$_REQUEST['od']));
}*/

$_REQUEST['advance_install'] = find_a_field('salary_advance','sum(payable_amt)','PBI_ID="'.$_REQUEST['PBI_ID'].'" and current_mon="'.$_REQUEST['mon'].'" and  	current_year="'.$_REQUEST['year'].'" and  	advance_type="Advance Cash" ');

$_REQUEST['motorcycle_install'] = find_a_field('motorcycle_install','sum(payable_amt)','PBI_ID="'.$_REQUEST['PBI_ID'].'" and current_mon="'.$_REQUEST['mon'].'" and  	current_year="'.$_REQUEST['year'].'" and  	advance_type="Advance Cash" ');

$_REQUEST['other_install'] = find_a_field('salary_advance','sum(payable_amt)','PBI_ID="'.$_REQUEST['PBI_ID'].'" and current_mon="'.$_REQUEST['mon'].'" and  	current_year="'.$_REQUEST['year'].'" and  	advance_type="Other Advance" ');


if($_REQUEST['bonus']=='No')
$_REQUEST['bonus_amount']=0;
else
$_REQUEST['bonus_amount'] = ($salary->consolidated_salary/2);
$_REQUEST['administrative_deduction'] = find_a_field('hrm_admin_action_detail','sum(ADMIN_ACTION_AMT)','ADMIN_ACTION_DATE between "'.$s_date.'" and "'.$e_date.'" and PBI_ID="'.$_REQUEST['PBI_ID'].'" ');

$_REQUEST['total_salary'] = $_REQUEST['basic_salary_payable']+ $salary->consolidated_salary + $salary->special_allowance;

$_REQUEST['total_deduction'] = $_REQUEST['advance_install']+$_REQUEST['other_install']+$_REQUEST['deduction']+$_REQUEST['cooperative_share']+$_REQUEST['motorcycle_install']+$_REQUEST['income_tax']+$_REQUEST['administrative_deduction'];

$_REQUEST['total_benefits'] = $_REQUEST['house_rent'] +$_REQUEST['bonus_amount'] + $_REQUEST['over_time_amount'] + $_REQUEST['other_benefits']+$_REQUEST['benefits']+$_REQUEST['ta_da']+$_REQUEST['food_allowance']+$_REQUEST['vehicle_allowance']+$_REQUEST['mobile_allowance'];

$_REQUEST['total_payable'] = round((($_REQUEST['total_salary'] + $_REQUEST['total_benefits']) - $_REQUEST['total_deduction']));


$d_bank = $_REQUEST['total_payable'] - $salary->bank_paid;

if($d_bank>=0){
$_REQUEST['cash_paid'] = $d_bank;
$_REQUEST['bank_paid'] = $salary->bank_paid;
}
else
{
$_REQUEST['cash_paid'] = 0;
$_REQUEST['bank_paid'] = $_REQUEST['total_payable'];
}

if($_REQUEST['bank_paid']>0)
$_REQUEST['bank_name'] = $salary->cash_bank;

if($$unique>0)
{
$_REQUEST['edit_by']=$_SESSION['user']['id'];
$_REQUEST['edit_at']=date('Y-m-d H:i:s');
echo 'Updated!';
$crud->update($unique);
}
else
{
$_REQUEST['entry_by']=$_SESSION['user']['id'];
$_REQUEST['entry_at']=date('Y-m-d H:i:s');
echo 'Saved!';
$crud->insert();
}
?>