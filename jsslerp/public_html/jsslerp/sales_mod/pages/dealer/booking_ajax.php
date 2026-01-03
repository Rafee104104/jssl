<?php


session_start();


require_once "../../../assets/template/layout.top.php";


@ini_set('error_reporting', E_ALL);


@ini_set('display_errors', 'Off');


$str = $_POST['data'];


$data=explode('##',$str);

  $dealer_code2=$data[0];
   


?>

		<select name="dealer_code2" required="required" id="dealer_code2" style="width:95%; font-size:12px;"
											onchange="getData2('agent_name_ajax.php', 'agent_name_find', this.value,  document.getElementById('dealer_code2').value);">
		  <option></option>
                <? foreign_relation('dealer_info','dealer_name_e','dealer_code2',$dealer_code2,'1');?>
		</select>
	
