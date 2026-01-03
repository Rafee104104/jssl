<?
$_SESSION['notify'][178]=find_a_field('sale_do_master','count(do_no)','status="MANUAL"');
$_SESSION['notify'][179]=find_a_field('sale_do_master','count(do_no)','status="PROCESSING"');
$_SESSION['notify'][181]=find_a_field('warehouse_other_receive','count(or_no)','status="MANUAL"');
$_SESSION['notify'][182]=find_a_field('warehouse_other_receive','count(or_no)','status="UNCHECKED"');
$_SESSION['notify'][185]=find_a_field('requisition_fg_master','count(req_no)','status="MANUAL" and warehouse_id="'.$_SESSION['user']['depot'].'"');

?>