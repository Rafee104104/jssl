<?php


session_start();


require_once "../../../assets/template/layout.top.php";


@ini_set('error_reporting', E_ALL);


@ini_set('display_errors', 'Off');


$str = $_POST['data'];


$data=explode('##',$str);


  $data_id=$data[0];




?>

<!--onchange="getData2('agent_ajax.php', 'sub_class2', this.value, document.getElementById('booking_number').value);"-->
<input list="booking_numbers" name="booking_number" id="booking_number" type="text" >
	  <datalist id="booking_numbers" >
	<option></option>
      <? foreign_relation('paid_booking','booking_number_eng','booking_number_eng',$booking_number_eng,'booking_year="'.$data_id.'"');?>
</datalist>

