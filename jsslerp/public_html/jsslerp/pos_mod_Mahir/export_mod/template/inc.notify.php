<?php

 
	$paper_comb_count = find_a_field('paper_combination','count(id)','approval="No"');
	$addi_info = find_a_field('additional_information','count(id)','approval="No"');
	$num_decimal = find_a_field('decimal_numbers','count(id)','approval="No"');
	
	$total_pending = ($paper_comb_count+$addi_info+$num_decimal);

 $_SESSION['notify'][443]=$total_pending;
$_SESSION['notify'][446]= find_a_field('sale_do_master','count(do_no)','status="MANUAL"');
$_SESSION['notify'][447]=find_a_field('sale_do_master','count(do_no)','status="UNCHECKED"');
$_SESSION['notify'][450]=find_a_field('sale_do_master','count(do_no)','status="HOLD REQUEST"');
$_SESSION['notify'][449]=find_a_field('sale_do_master','count(do_no)','status="HOLD"');
$_SESSION['notify'][453]=find_a_field('sale_do_master','count(do_no)','status="CANCEL REQUEST"');

?>