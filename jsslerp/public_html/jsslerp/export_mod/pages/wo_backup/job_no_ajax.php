<?php


session_start();


require_once "../../../assets/template/layout.top.php";


@ini_set('error_reporting', E_ALL);


@ini_set('display_errors', 'Off');


$str = $_POST['data'];


$data=explode('##',$str);


  $do_date=$data[0];
  $do_no=$data[1];
  
  $date_exp=explode('-',$do_date);
  
  $year=$date_exp[0];
  $month=$date_exp[1];

 $job_no_generate='NPL-'.$year.'-'.$month.'-'.$do_no;


?>

<input name="job_no" type="text" id="job_no" style="width:220px;" value="<?=$job_no_generate?>" readonly="" tabindex="105" />





