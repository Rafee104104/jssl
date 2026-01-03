<?
session_start();
require_once "../../../assets/template/layout.top.php";


$crud = new crud('salary_attendence');

$unique = 'id';

$mon=$_GET['mon'];


$_POST['PBI_ID'] = $_GET['PBI_ID'];

$_POST['mon'] 	 = $_GET['mon'];

$_POST['year']   = $_GET['year'];

$_POST['week']    = $_GET['week'];

$_POST['wh_sat']     = $_GET['wh_sat'];
$_POST['wh_sun']     = $_GET['wh_sun'];
$_POST['wh_mon']     = $_GET['wh_mon'];
$_POST['wh_tue']     = $_GET['wh_tue'];
$_POST['wh_wed']     = $_GET['wh_wed'];
$_POST['wh_thu']    = $_GET['wh_thu'];
$_POST['wh_fri']    = $_GET['wh_fri'];


$_POST['eot_sat']     = $_GET['eot_sat'];
$_POST['eot_sun']     = $_GET['eot_sun'];
$_POST['eot_mon']     = $_GET['eot_mon'];
$_POST['eot_tue']     = $_GET['eot_tue'];
$_POST['eot_wed']     = $_GET['eot_wed'];
$_POST['eot_thu']    = $_GET['eot_thu'];
$_POST['eot_fri']    = $_GET['eot_fri'];


$year=$_GET['year'];



$da =  find_all_field('hrm_payroll_setup','',' `year` = "'.$year.'" and `mon` = "'.$mon.'" ');




$basic_info = find_all_field('personnel_basic_info','','PBI_ID='.$_GET['PBI_ID']);

$joining_data = find_all_field_sql("SELECT PBI_ID, PBI_DOJ FROM personnel_basic_info WHERE PBI_ID='".$_GET['PBI_ID']."' and PBI_DOJ BETWEEN '".$s_date."' AND '".$e_date."' ");



//$_POST['fd'] = 5; // -----------------------------------TOTAL FRIDAY





$_POST[$unique] = $$unique = find_a_field('salary_attendence','id','PBI_ID="'.$_GET['PBI_ID'].'" and mon="'.$_GET['mon'].'" and year="'.$_GET['year'].'" ');

$salary = find_all_field('salary_info','','PBI_ID='.$_GET['PBI_ID']);

$_POST['basic_salary'] = $salary->basic_salary;

$_POST['basic_salary_payable'] = round((($salary->gross_salary/$days_mon)*$_GET['pay']));

$_POST['ta_da_data'] = $salary->ta;

$_POST['pf'] = $salary->pf;

$_POST['cpf'] = $salary->cpf;


//$salary_date=date('Y-m-d',mktime(0,0,0,$_POST['mon'],1,$_POST['year']));

$_POST['house_rent']=$salary->house_rent;

if($_POST['td']<$days_mon)

$_POST['house_rent']=$salary->house_rent = ($salary->house_rent/$days_mon)*$_GET['pay'];

else

$_POST['house_rent']=$salary->house_rent;

$_POST['medical_allowance']=$salary->medical_allowance;

$_POST['other_allowance']=$salary->others;

$_POST['mobile_allowance']=$salary->mobile_allowance;

$nnjoin_date  = strtotime($basic_info->PBI_DOJ);

$nnstart_date = strtotime($s_date);

$nnend_date = strtotime($e_date);

$datediff =  $nnjoin_date - $nnstart_date;


// ----------------------------------------------------- extra 2000 taka

$join_days = round($datediff / (60 * 60 * 24));

$ins_days = 90 + round($datediff / (60 * 60 * 24));


// ---------------------------------------------END Extra 2000 taka


$_POST['ta_da']=$salary->ta;

$_POST['food_allowance']=$salary->food_allowance;

$_POST['income_tax']=$salary->income_tax;

$_POST['total_salary']=$salary->total_salary;

$_POST['gross_salary']=$salary->gross_salary;

$_POST['account_no']=$salary->cash;

$_POST['bank_or_cash']=$salary->cash_bank;

$_POST['entertainment']=$salary->entertainment;

// JOINING DEDUCTION



if ($joining_data->PBI_ID>0) {

$joining_date = strtotime($joining_data->PBI_DOJ);

$month_first_date = strtotime($s_date);

$datediff = $joining_date - $month_first_date;

$joining_ab_days =  round($datediff / (60 * 60 * 24));

$_POST['joining_ab']=$joining_ab_days;

$_POST['joining_deduction']=((($salary->gross_salary)/(30))*($_POST['joining_ab']));

// OLD SYSTEM BEFORE AUDIT $_POST['joining_ab_deduction']=((($salary->basic_salary)/(30))*($_POST['joining_ab']));

}

$late_deduct_day = ((int) $_GET['lt'] /3);

$late_deduct_days = floor($late_deduct_day);


$_POST['over_time_amount']=round(((($salary->gross_salary)/360)*($_GET['ot'])));

if($salary->basic_salary>0){
$_POST['absent_deduction']=round(((($salary->basic_salary)/($days_mon))*(($_GET['lwp']+$_GET['ab']))+$_POST['joining_deduction']));
}else{
$_POST['absent_deduction']=round(((($salary->total_salary)/($days_mon))*(($_GET['lwp']+$_GET['ab']))+$_POST['joining_deduction']));
}


if($$unique>0){
$_POST['edit_by']=$_SESSION['user']['id'];



$_POST['edit_at']=date('Y-m-d H:i:s');



echo 'Updated!';

$pf_date   = $year.'-'.($mon).'-'.$days_mon;

$pf_update = "UPDATE provident_fund SET year='".$year."',mon='".$mon."',pf_amount='".$_POST['pf']."',date='".$pf_date."',entry_by='".$_POST['entry_by']."' 
WHERE mon='".$mon."' and PBI_ID='".$_POST['PBI_ID']."' and year='".$year."'";
$pf_update_query=mysql_query($pf_update);

$crud->update($unique);

}else{

$_POST['entry_by']=$_SESSION['user']['id'];
$_POST['entry_at']=date('Y-m-d H:i:s');
echo 'Saved!';

$pf_date   = $year.'-'.($mon).'-'.$days_mon;

if($_POST['pf']>0){
$pf_insert="INSERT INTO provident_fund (PBI_ID,year,mon,pf_amount,date,entry_by) VALUES ('".$_POST['PBI_ID']."','".$year."', '".$mon."', '".$_POST['pf']."','".$pf_date."','".$_POST['entry_by']."' ) ";
$pf_query=mysql_query($pf_insert);
}

$crud->insert();

}



?>