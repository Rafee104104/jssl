<?php


session_start();


require_once "../../../assets/template/layout.top.php";


@ini_set('error_reporting', E_ALL);


@ini_set('display_errors', 'Off');


$str = $_POST['data'];


$data=explode('##',$str);


  $data_id=$data[0];




?>


<input list="bag" name="sr_number" id="sr_number" type="text">
	  <datalist id="bag">
	<option></option>
      <? foreign_relation('warehouse_other_receive','bag_mark','bag_mark',$bag_mark,'booking_number="'.$data_id.'"');?>
</datalist>

