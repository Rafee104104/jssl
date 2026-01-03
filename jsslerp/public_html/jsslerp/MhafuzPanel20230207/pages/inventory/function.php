<?php 


function system_stock_error_log($check_date,$db_user,$db_pass,$db_name){





      @mysql_connect('localhost', $db_user, $db_pass);
      @mysql_select_db($db_name);
	
	
	
	$del_sql  ="delete  from system_stock_lock_master where date='".$check_date."'";
	
	mysql_query($del_sql);
	
	$del_sql_d  ="delete  from system_stock_lock_details where date='".$check_date."'";
	
	mysql_query($del_sql_d);
	
	
	$sql ="insert into system_stock_lock_master (cid,date)
	
	values ('".$_SESSION['cid']."','".$check_date."')
	";
	mysql_query($sql);
	
	
	$master_id = mysql_insert_id();
	
 $config_sql = "select sum(item_in)  as item_in,sum(item_ex) as item_ex,tr_from from journal_item where entry_at between '".date('Y-m-d 00:00:00',strtotime($check_date))."' and '".date('Y-m-d 23:59:59',strtotime($check_date))."'  group by tr_from";
	
	$query = mysql_query($config_sql);
	
	while($data=mysql_fetch_object($query)){
		
		
		if($data->item_in>0){
			$total_qty_ji_closing = $data->item_in;
		}else{
			$total_qty_ji_closing = $data->item_ex;

		}
		
		
		if($data->tr_from=="Issue"){
			$total_qty_ji_closing = $data->item_ex;
		}
		
		
	   $controller =find_all_field('system_stock_config','','tr_from="'.$data->tr_from.'"');

				
		$table_name= $controller->table_name;
		$field_name= $controller->sum_field;
		$date_name= $controller->date_field;
		$condition= $controller->table_condition;
		
		
	 $sql_sum = "select ".$field_name."  from ".$table_name." where   ".$condition." and  ".$date_name." between '".date('Y-m-d 00:00:00',strtotime($check_date))."' and '".date('Y-m-d 23:59:59',strtotime($check_date))."'";
		
		$queryy = mysql_query($sql_sum);
		
		$datas=mysql_fetch_array($queryy);
		
		
		
		$closing = $datas[0]-$total_qty_ji_closing;
		
		
 	 $sql_details= "insert into  system_stock_lock_details (master_id,date,tr_from,total_qty, total_qty_ji, total_qty_ji_closing ,total_qty_closing)
	
	values (".$master_id.",'".$_POST['fdate']."','".$data->tr_from."','".$datas[0]."','".$total_qty_ji_closing."','','".$closing."')";
		
		mysql_query($sql_details);
		
		
		
		
		 $sql_sum_master = "select sum(total_qty),sum(total_qty_ji) from system_stock_lock_details where  master_id=".$master_id."";
		
		$queryyy = mysql_query($sql_sum_master);
		
		$datass=mysql_fetch_array($queryyy);
		
		
		$tot_closing = $datass[0]-$datass[1];
		
			
	}	
		 $update_query ="update system_stock_lock_master set total_qty_ji=".$datass[1].",total_qty=".$datass[0].",difference=".$tot_closing." where id=".$master_id."";
		mysql_query($update_query);
		
		
		
		
		 @mysql_connect('localhost', 'erpengine_clouderpuser', 'clouderppassword224424');
    @mysql_select_db('erpengine_clouderpdb');

    if($tot_closing<>0){
	$del_sql  ="delete  from system_daily_error_log where date='".$check_date."'";
	
	mysql_query($del_sql);
	
	
	$ins_sql ="insert into system_daily_error_log (cid,date,total_qty,total_qty_ji,difference)
	
	values ('".$_SESSION['cid']."','".$check_date."','".$datass[0]."','".$datass[1]."','".$tot_closing."')
	";
	mysql_query($ins_sql);
	
	}











}


function system_finance_error_log($check_date,$db_user,$db_pass,$db_name){





      @mysql_connect('localhost', $db_user, $db_pass);
      @mysql_select_db($db_name);
	
	
	
	$del_sql  ="delete  from system_finance_lock_master where date='".$check_date."'";
	
	mysql_query($del_sql);
	
	$del_sql_d  ="delete  from system_finance_lock_details where date='".$check_date."'";
	
	mysql_query($del_sql_d);
	
	
	$sql ="insert into system_finance_lock_master (cid,date)
	
	values ('".$_SESSION['cid']."','".$check_date."')
	";
	mysql_query($sql);
	
	
	$master_id = mysql_insert_id();
	
  $config_sql = "select sum(item_in*item_price)  as item_in,sum(item_ex*item_price) as item_ex,tr_from from journal_item where entry_at between '".date('Y-m-d 00:00:00',strtotime($check_date))."' and '".date('Y-m-d 23:59:59',strtotime($check_date))."'  group by tr_from";
	
	$query = mysql_query($config_sql);
	
	while($data=mysql_fetch_object($query)){
		
		
		if($data->item_in>0){
			$total_qty_ji_closing = $data->item_in;
		}else{
			$total_qty_ji_closing = $data->item_ex;

		}
		
		
		if($data->tr_from=="Issue"){
			$total_qty_ji_closing = $data->item_ex;
		}
		
		
	   $controller =find_all_field('system_finance_config','','tr_from="'.$data->tr_from.'"');

				
		$table_name= $controller->table_name;
		$field_name= $controller->sum_field;
		$date_name= $controller->date_field;
		$condition= $controller->table_condition;
		
		
	 $sql_sum = "select ".$field_name."  from ".$table_name." where   ".$condition." and  ".$date_name." between '".date('Y-m-d 00:00:00',strtotime($check_date))."' and '".date('Y-m-d 23:59:59',strtotime($check_date))."'";
		
		$queryy = mysql_query($sql_sum);
		
		$datas=mysql_fetch_array($queryy);
		
		
		
		$closing = $datas[0]-$total_qty_ji_closing;
		
		
 	 $sql_details= "insert into  system_finance_lock_details (master_id,date,tr_from,total_qty, total_qty_ji, total_qty_ji_closing ,total_qty_closing)
	
	values (".$master_id.",'".$_POST['fdate']."','".$data->tr_from."','".$datas[0]."','".$total_qty_ji_closing."','','".$closing."')";
		
		mysql_query($sql_details);
		
		
		
		
		 $sql_sum_master = "select sum(total_qty),sum(total_qty_ji) from system_finance_lock_details where  master_id=".$master_id."";
		
		$queryyy = mysql_query($sql_sum_master);
		
		$datass=mysql_fetch_array($queryyy);
		
		
		$tot_closing = $datass[0]-$datass[1];
		
			
	}	
		 $update_query ="update system_finance_lock_master set total_qty_ji=".$datass[1].",total_qty=".$datass[0].",difference=".$tot_closing." where id=".$master_id."";
		mysql_query($update_query);
		
		
		
		
		 @mysql_connect('localhost', 'erpengine_clouderpuser', 'clouderppassword224424');
    @mysql_select_db('erpengine_clouderpdb');

    if($tot_closing<>0){
	$del_sql  ="delete  from system_daily_error_log_finance where date='".$check_date."'";
	
	mysql_query($del_sql);
	
	
	$ins_sql ="insert into system_daily_error_log_finance (cid,date,total_qty,total_qty_ji,difference)
	
	values ('".$_SESSION['cid']."','".$check_date."','".$datass[0]."','".$datass[1]."','".$tot_closing."')
	";
	mysql_query($ins_sql);
	
	}











}


function system_acc_error_log($check_date,$db_user,$db_pass,$db_name){





      @mysql_connect('localhost', $db_user, $db_pass);
      @mysql_select_db($db_name);
	
	
	
	$del_sql  ="delete  from system_acc_lock_master where date='".$check_date."'";
	
	mysql_query($del_sql);
	
	$del_sql_d  ="delete  from system_acc_lock_details where date='".$check_date."'";
	
	mysql_query($del_sql_d);
	
	
	$sql ="insert into system_acc_lock_master (cid,date)
	
	values ('".$_SESSION['cid']."','".$check_date."')
	";
	mysql_query($sql);
	
	
	$master_id = mysql_insert_id();
	
  $config_sql = "select sum(cr_amt)  as cr_amt,sum(dr_amt) as dr_amt,tr_from from secondary_journal where entry_at between '".date('Y-m-d 00:00:00',strtotime($check_date))."' and '".date('Y-m-d 23:59:59',strtotime($check_date))."'  group by tr_from";
	
	$query = mysql_query($config_sql);
	
	while($data=mysql_fetch_object($query)){
		
		
		
		
		
	   $controller =find_all_field('system_acc_config','','tr_from="'.$data->tr_from.'"');

				
		$table_name= $controller->table_name;
		$cr= $controller->sum_field_cr;
		$tr_from= $controller->tr_from;
		
		$dr= $controller->sum_field_dr;
		$date_name= $controller->date_field;
		$condition= $controller->table_condition;
		
		
	 $sql_sum = "select ".$cr.", ".$dr."  from ".$table_name." where     ".$condition." and tr_from='".$tr_from."'  and  ".$date_name." between '".date('Y-m-d 00:00:00',strtotime($check_date))."' and '".date('Y-m-d 23:59:59',strtotime($check_date))."'";
		
		$queryy = mysql_query($sql_sum);
		
		$datas=mysql_fetch_array($queryy);
		
		
		
		$diff_cr = $data->cr_amt-$datas[0];
		$diff_dr = $data->cr_amt-$datas[1];
		
		
 	 $sql_details= "insert into  system_acc_lock_details (master_id,date,tr_from,sec_cr,sec_dr,journal_cr,journal_dr,difference_cr,difference_dr)
	
	values (".$master_id.",'".$_POST['fdate']."','".$data->tr_from."','".$data->cr_amt."','".$data->dr_amt."','".$datas[0]."','".$datas[1]."','".$diff_cr."','".$diff_dr."')";
		
		mysql_query($sql_details);
		
		
		
		
		 $sql_sum_master = "select sum(sec_cr),sum(sec_dr),sum(journal_cr),sum(journal_dr) from system_acc_lock_details where  master_id=".$master_id."";
		
		$queryyy = mysql_query($sql_sum_master);
		
		$datass=mysql_fetch_array($queryyy);
		
		
		$d_cr = $datass[0]-$datass[2];
		$d_dr = $datass[1]-$datass[3];
		
			
	}	
	
	
		 $update_query ="update system_acc_lock_master set sec_cr=".$datass[0].",sec_dr=".$datass[1].",journal_cr=".$datass[2].",journal_dr=".$datass[3].",difference_cr=".$d_cr.",difference_dr=".$d_dr." where id=".$master_id."";
		mysql_query($update_query);
		
		
		
		
	@mysql_connect('localhost', 'erpengine_clouderpuser', 'clouderppassword224424');
    @mysql_select_db('erpengine_clouderpdb');

    if(($d_cr<>0) || ($d_dr<>0) ){
	$del_sql  ="delete  from system_daily_error_log_acc where date='".$check_date."'";
	
	mysql_query($del_sql);
	
	
	 $ins_sql ="insert into system_daily_error_log_acc (cid,date,diff_cr,diff_dr)
	
	values ('".$_SESSION['cid']."','".$check_date."','".$d_cr."','".$d_dr."')
	";
	mysql_query($ins_sql);
	
	}











}



function system_cr_dr_error_log($check_date,$db_user,$db_pass,$db_name){



	$del_sql  ="delete  from system_cr_dr_check_details where date='".$check_date."'";
	
	mysql_query($del_sql);




      @mysql_connect('localhost', $db_user, $db_pass);
      @mysql_select_db($db_name);
	
	
	
	$del_sql  ="delete  from system_cr_dr_check_master where date='".$check_date."'";
	
	mysql_query($del_sql);
	
	$del_sql_d  ="delete  from system_cr_dr_check_details where date='".$check_date."'";
	
	mysql_query($del_sql_d);
	
	
	$sql ="insert into system_cr_dr_check_master (cid,date)
	
	values ('".$_SESSION['cid']."','".$check_date."')
	";
	mysql_query($sql);
	$master_id = mysql_insert_id();
	
  $config_sql ="SELECT tr_from,jv_no,tr_no,sum(cr_amt-dr_amt) as diff FROM `secondary_journal` where 1 and entry_at between '".date('Y-m-d 00:00:00',strtotime($check_date))."' and '".date('Y-m-d 23:59:59',strtotime($check_date))."'  GROUP by tr_no,tr_from HAVING diff<>0 ";
	
	$query = mysql_query($config_sql);
	
	while($data=mysql_fetch_object($query)){
		
	
		
 	 $sql_details= "insert into  system_cr_dr_check_details (cid,master_id,date,tr_from,tr_no,difference)
	values ('".$_SESSION['cid']."',".$master_id.",'".$_POST['fdate']."','".$data->tr_from."','".$data->tr_no."','".$data->diff."')";
		
	mysql_query($sql_details);
			




	@mysql_connect('localhost', 'erpengine_clouderpuser', 'clouderppassword224424');
    @mysql_select_db('erpengine_clouderpdb');
	
	

	$ins_details="insert into  system_cr_dr_check_details (cid,master_id,date,tr_from,tr_no,difference)
	values ('".$_SESSION['cid']."',".$master_id.",'".$_POST['fdate']."','".$data->tr_from."','".$data->tr_no."','".$data->diff."')";
		
	mysql_query($ins_details);
	
			
	}	
	
	
	











}






?>