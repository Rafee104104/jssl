<?
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
session_start();
require_once "../../../assets/support/inc.all.php";

date_default_timezone_set('Asia/Dhaka');
		function ssd($qty,$pk,$colour='')
		{
		if($colour!='') $c = 'bgcolor="'.$colour.'" ';
		echo '
		<td '.$c.'>'.(int)($qty/$pk).'</td>
		<td '.$c.'>'.($qty%$pk).'</td>
		<td '.$c.'>'.(int)$qty.'</td>
			';
		}
if(isset($_POST['submit'])&&isset($_POST['report'])&&$_POST['report']>0)
{
	if((strlen($_POST['t_date'])==10)&&(strlen($_POST['f_date'])==10))
	{
		$t_date=$_POST['t_date'];
		$f_date=$_POST['f_date'];
		
		$to_date=$_POST['t_date'];
		$fr_date=$_POST['f_date'];
	}
	if($_POST['booking_type']>0) 				$booking_type=$_POST['booking_type'];
	if($_POST['warehouse_id']>0) 				$warehouse_id=$_POST['warehouse_id'];
	if($_POST['item_id']>0) 					$item_id=$_POST['item_id'];
	if($_POST['receive_status']!='') 			$receive_status=$_POST['receive_status'];
	if($_POST['issue_status']!='') 				$issue_status=$_POST['issue_status'];
	if($_POST['item_sub_group']>0) 				$sub_group_id=$_POST['item_sub_group'];
	if($_POST['item_brand']>0) 				    $item_brand=$_POST['item_brand'];
	if($_POST['vendor_id']>0) 				    $vendor_id=$_POST['vendor_id'];
	
	if($_POST['ctg_warehouse']>0) 				$ctg_warehouse=$_POST['ctg_warehouse'];
	if($_POST['garden_id']>0) 				    $garden_id=$_POST['garden_id'];
	
	
switch ($_POST['report']) {
    case 1:
		 $report="Warehouse Item Transection Report";
		if(isset($warehouse_id)) 				{$warehouse_con=' and a.warehouse_id='.$warehouse_id;} 
		if(isset($sub_group_id)) 				{$item_sub_con=' and i.sub_group_id='.$sub_group_id;} 
		elseif(isset($item_id)) 				{$item_con=' and a.item_id='.$item_id;} 
		
		if(isset($receive_status)){	
			if($receive_status=='All_Purchase')
			{$status_con=' and a.tr_from in ("Purchase","Local Purchase","Import")';}
			else
			{$status_con=' and a.tr_from="'.$receive_status.'"';}
		}
		
		elseif(isset($issue_status)) 		{$status_con=' and a.tr_from="'.$issue_status.'"';} 
		
		if(isset($t_date)) 
		{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.ji_date between \''.$fr_date.'\' and \''.$to_date.'\'';}

		if($_SESSION['user']['level']==5 || $_SESSION['user']['level']==4 || $_SESSION['user']['level']==1){
		  $sql='select ji_date,i.item_id,i.finish_goods_code as fg_code,i.item_name,s.sub_group_name as Category,i.unit_name as unit,a.item_in as `IN`,a.item_ex as `OUT`,a.item_price as rate,((a.item_in+a.item_ex)*a.item_price) as amount,a.tr_from as tr_type,a.tr_no,sr_no,(select lc_number from lc_purchase_closing where id=a.tr_no and a.tr_from="Import Purchase") as LC_number,(select warehouse_name from warehouse where warehouse_id=a.relevant_warehouse) as warehouse,a.tr_no,a.entry_at,c.fname as User 
		   
		   from journal_item a, item_info i, user_activity_management c , item_sub_group s where c.user_id=a.entry_by and s.sub_group_id=i.sub_group_id and
		    a.item_id=i.item_id '.$date_con.$warehouse_con.$item_con.$status_con.$item_sub_con.' order by a.ji_date';
		}else{
		 $sql='select ji_date,i.item_id,i.finish_goods_code as fg_code,i.item_name,s.sub_group_name as Category,i.unit_name as unit,a.item_in as `IN`,a.item_ex as `OUT`,a.item_price as rate,((a.item_in+a.item_ex)*a.item_price) as amount,a.tr_from as tr_type,a.tr_no,sr_no,(select lc_number from lc_purchase_closing where id=a.tr_no and a.tr_from="Import Purchase") as LC_number,(select warehouse_name from warehouse where warehouse_id=a.relevant_warehouse) as warehouse,a.tr_no,a.entry_at,c.fname as User 
		   
		   from journal_item a, item_info i, user_activity_management c , item_sub_group s where c.user_id=a.entry_by and s.sub_group_id=i.sub_group_id and
		    a.item_id=i.item_id and a.warehouse_id="'.$_SESSION['user']['depot'].'" '.$date_con.$item_con.$status_con.$item_sub_con.' order by a.ji_date';}
			
			 $sql;
	break;
	
	
	case 113:
		$report="Item Opening Report";
		if(isset($warehouse_id)) 				{$warehouse_con=' and a.warehouse_id='.$warehouse_id;} 
		if(isset($sub_group_id)) 				{$item_sub_con=' and i.sub_group_id='.$sub_group_id;} 
		elseif(isset($item_id)) 				{$item_con=' and a.item_id='.$item_id;} 
		
		
		
		if(isset($t_date)) 
		{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.ji_date between \''.$fr_date.'\' and \''.$to_date.'\'';}

		
		$sql='select ji_date,i.item_id,i.finish_goods_code as fg_code,i.item_name,(select group_name from item_group where group_id=s.group_id) as group_name,s.sub_group_name as Category,i.unit_name as unit,a.item_in as `Opening Qty`,a.item_price as Opening_rate,sum(a.item_in*a.item_price) as amount,(select warehouse_name from warehouse where warehouse_id=a.warehouse_id) as warehouse,a.entry_at,c.fname as User 
		   
		   from journal_item a, item_info i, user_activity_management c , item_sub_group s where a.tr_from="Opening" and c.user_id=a.entry_by and s.sub_group_id=i.sub_group_id and
		    a.item_id=i.item_id '.$date_con.$warehouse_con.$item_con.$status_con.$item_sub_con.' group by s.sub_group_id ';
		
			
			 $sql;
	break;
	
	
	case 1133:
		$report="Item Opening Report All";
		if(isset($warehouse_id)) 				{$warehouse_con=' and a.warehouse_id='.$warehouse_id;} 
		if(isset($sub_group_id)) 				{$item_sub_con=' and i.sub_group_id='.$sub_group_id;} 
		elseif(isset($item_id)) 				{$item_con=' and a.item_id='.$item_id;} 
		
		
		
		if(isset($t_date)) 
		{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.ji_date between \''.$fr_date.'\' and \''.$to_date.'\'';}

		
		$sql='select ji_date,i.item_id,i.finish_goods_code as fg_code,i.item_name,(select group_name from item_group where group_id=s.group_id) as group_name,s.sub_group_name as Category,i.unit_name as unit,a.item_in as `Opening Qty`,a.item_price as Opening_rate,sum(a.item_in*a.item_price) as amount,(select warehouse_name from warehouse where warehouse_id=a.warehouse_id) as warehouse,a.entry_at,c.fname as User 
		   
		   from journal_item a, item_info i, user_activity_management c , item_sub_group s where a.tr_from="Opening" and a.item_in>0 and c.user_id=a.entry_by and s.sub_group_id=i.sub_group_id and
		    a.item_id=i.item_id '.$date_con.$warehouse_con.$item_con.$status_con.$item_sub_con.' group by a.item_id ';
		
			
			 $sql;
	break;
	 
    case 1008:
		$report="Warehouse Advance Purchase Report";
		
		if(isset($warehouse_id)) 				{$warehouse_con=' and a.relevant_warehouse='.$warehouse_id;} 
		if(isset($sub_group_id)) 				{$item_sub_con=' and i.sub_group_id='.$sub_group_id;} 
		elseif(isset($item_id)) 				{$item_con=' and a.item_id='.$item_id;} 
		

		$status_con=' and a.tr_from in ("Purchase","Local Purchase","Import")';

		
		
		if(isset($t_date)) 
		{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.ji_date between \''.$fr_date.'\' and \''.$to_date.'\'';}

		
		 $sql='select 
	 a.item_id,
	 i.item_name,
	 s.sub_group_name as Category,
	 i.unit_name as unit,
	 sum(a.item_in) as `total_qty`,
	 (sum(a.item_in*a.item_price)/sum(a.item_in)) as rate,
	 sum(a.item_in*a.item_price) as amount
		   
		   from journal_item a, item_info i, user_activity_management c , item_sub_group s where c.user_id=a.entry_by and s.sub_group_id=i.sub_group_id and
		    a.item_id=i.item_id and a.warehouse_id="'.$_SESSION['user']['depot'].'" '.$date_con.$warehouse_con.$item_con.$status_con.$item_sub_con.' group by a.item_id order by a.id';
	break;
    case 2:
		$report="Warehouse Stock Position Report(Closing)";
		if(isset($warehouse_id)) 			{$warehouse_con=' and a.warehouse_id='.$warehouse_id;} 
		if(isset($sub_group_id)) 			{$item_sub_con=' and i.sub_group_id='.$sub_group_id;} 
		elseif(isset($item_id)) 			{$item_con=' and a.item_id='.$item_id;} 
		if(isset($receive_status)) 			{$status_con=' and a.tr_from="'.$receive_status.'"';} 
		elseif(isset($issue_status)) 		{$status_con=' and a.tr_from="'.$issue_status.'"';} 
		
		if(isset($t_date)) 
		{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.ji_date <="'.$to_date.'"';}
		
		
	break;
	
	case 20025:
		$report="FG Cost Alert Report";
		if(isset($warehouse_id)) 			{$warehouse_con=' and a.warehouse_id='.$warehouse_id;} 
		if(isset($sub_group_id)) 			{$item_sub_con=' and i.sub_group_id='.$sub_group_id;} 
		elseif(isset($item_id)) 			{$item_con=' and a.item_id='.$item_id;} 
		if(isset($receive_status)) 			{$status_con=' and a.tr_from="'.$receive_status.'"';} 
		elseif(isset($issue_status)) 		{$status_con=' and a.tr_from="'.$issue_status.'"';} 
		
		if(isset($t_date)) 
		{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.ji_date <="'.$to_date.'"';}
		
		
	break;
    case 22:
		$report="Warehouse Present Stock ";
		if(isset($warehouse_id)) 			{$warehouse_con=' and a.warehouse_id='.$warehouse_id;} 
		if(isset($sub_group_id)) 			{$item_sub_con=' and i.sub_group_id='.$sub_group_id;} 
		elseif(isset($item_id)) 			{$item_con=' and a.item_id='.$item_id;} 
		if(isset($receive_status)) 			{$status_con=' and a.tr_from="'.$receive_status.'"';} 
		elseif(isset($issue_status)) 		{$status_con=' and a.tr_from="'.$issue_status.'"';} 
		
		if(isset($t_date)) 
		{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.ji_date <="'.$to_date.'"';}
		
		

	break;
	    case 3:
		$report="Warehouse Present Stock";
		if(isset($warehouse_id)) 				{$warehouse_con=' and a.warehouse_id='.$warehouse_id;} 
		if(isset($sub_group_id)) 				{$item_sub_con=' and i.sub_group_id='.$sub_group_id;} 
		elseif(isset($item_id)) 				{$item_con=' and a.item_id='.$item_id;} 
		if(isset($receive_status)) 				{$status_con=' and a.tr_from="'.$receive_status.'"';} 
		elseif(isset($issue_status)) 			{$status_con=' and a.tr_from="'.$issue_status.'"';} 
		
		if(isset($t_date)) 
		{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.journal_item between \''.$fr_date.'\' and \''.$to_date.'\'';}
		

		break;
	
    	case 4:
		$report="Warehouse Present Stock (Finish Goods)";
				if(isset($warehouse_id)) 			{$warehouse_con=' and a.warehouse_id='.$warehouse_id;} 
		if(isset($sub_group_id)) 				{$item_sub_con=' and i.sub_group_id='.$sub_group_id;} 
		elseif(isset($item_id)) 				{$item_con=' and a.item_id='.$item_id;} 
		if(isset($receive_status)) 			{$status_con=' and a.tr_from="'.$receive_status.'"';} 
		elseif(isset($issue_status)) 		{$status_con=' and a.tr_from="'.$issue_status.'"';} 
		
		if(isset($t_date)) 
		{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.ji_date <="'.$to_date.'"';}
		break;
		
		
		
		case 444:
		$report="Stock In vs Stock Out Comparison Report";
				if(isset($warehouse_id)) 			{$warehouse_con=' and a.warehouse_id='.$warehouse_id;} 
		if(isset($sub_group_id)) 				{$item_sub_con=' and i.sub_group_id='.$sub_group_id;} 
		elseif(isset($item_id)) 				{$item_con=' and a.item_id='.$item_id;} 
		if(isset($receive_status)) 			{$status_con=' and a.tr_from="'.$receive_status.'"';} 
		elseif(isset($issue_status)) 		{$status_con=' and a.tr_from="'.$issue_status.'"';} 
		
		if(isset($t_date)) 
		{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.ji_date <="'.$to_date.'"';}
		break;
		
		
	
		case 5:
		$report="Depot Transfer Report (Details)";
		if(isset($warehouse_id)) 			{$warehouse_con=' and w.warehouse_id='.$warehouse_id;} 
		if(isset($item_brand)) 				{$item_brand_con=' and i.item_brand='.$item_brand;} 
		if(isset($item_id)) 			    {$item_con=' and a.item_id='.$item_id;} 

		if(isset($t_date)) 
		{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.ji_date between "'.$fr_date.'" and "'.$to_date.'"';}

		
//$sql='select 
//m.pi_no,
//a.ji_date,
//w.warehouse_name  as warehouse,
//i.item_brand as brand,
//a.sr_no,
//i.finish_goods_code as fg,
//i.item_name,
//
//i.unit_name as unit,
//a.item_in as qty,
//a.item_price as rate,
//(a.item_in*a.item_price) as amt
//from journal_item a, item_info i, user_activity_management c,warehouse w,production_issue_master m,production_issue_detail d  where w.use_type="SD" and a.item_in>0 and a.relevant_warehouse='.$_SESSION['user']['depot'].' and 
//d.id=a.tr_no and d.pi_no=m.pi_no and w.warehouse_id=a.warehouse_id and (a.tr_from="Issue" OR a.tr_from="Transfered" OR a.tr_from="Transit") and c.user_id=a.entry_by and a.item_id=i.item_id'.$date_con.$warehouse_con.$item_con.$item_brand_con.' group by d.id order by a.id';
		
		$sql='select 
		m.pi_no,
		a.ji_date as date,
		w.warehouse_name  as warehouse,
		
		a.sr_no,
		i.finish_goods_code as fg,
		i.item_name,
		
		i.unit_name as unit,
		a.item_ex as qty,
		i.p_price as Cost_Price,
		(a.item_ex*i.p_price) as Cost_Amt,
		i.d_price as Distributor_Price,
		(a.item_ex*i.d_price) as Distributor_Amt
		from journal_item a, item_info i, user_activity_management c, warehouse w, production_issue_master m, production_issue_detail d  where 

		w.use_type!="PL" and a.item_ex>0 and a.warehouse_id='.$_SESSION['user']['depot'].' and 
		d.id=a.tr_no and d.pi_no=m.pi_no and w.warehouse_id=a.relevant_warehouse and (a.tr_from="Issue" OR a.tr_from="Transfered" OR a.tr_from="Transit") and 
		c.user_id=a.entry_by and a.item_id=i.item_id '.$date_con.$warehouse_con.$item_con.$item_brand_con.' group by d.id order by a.ji_date';
		
		break;
		
		case 6:
		$report="Depot Transfer Report (Brief)";
		if(isset($warehouse_id)) 			{$warehouse_con=' and a.relevant_warehouse='.$warehouse_id;}  
		if(isset($item_brand)) 				{$item_brand_con=' and i.item_brand='.$item_brand;} 
		if(isset($item_id)) 			    {$item_con=' and a.item_id='.$item_id;} 

		
		if(isset($t_date)) 
		{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.ji_date between "'.$fr_date.'" and "'.$to_date.'"';}

		
		$sql='select 
		
		i.finish_goods_code as fg,
		i.item_name,
		i.unit_name as unit,
		
		sum(a.item_ex) as qty,
		
		i.p_price as Cost_Price,
		sum(a.item_ex*p_price) as cost_Amt,
		i.d_price as Distributor_Price,
		sum(a.item_ex*i.d_price) as Distributor_Amt
		from journal_item a, item_info i, user_activity_management c,warehouse w  where w.use_type!="PL" and a.item_ex>0 and a.warehouse_id='.$_SESSION['user']['depot'].' and 
		w.warehouse_id=a.warehouse_id and (a.tr_from="Issue" OR a.tr_from="Transfered" OR a.tr_from="Transit") and c.user_id=a.entry_by and a.item_id=i.item_id'.$date_con.$warehouse_con.$item_con.$item_brand_con.' group by  a.item_id order by i.finish_goods_code';
		break;
		
		
		case 7:
		$report="Entry Wise Transfer Report";
		if(isset($warehouse_id)) 			{$con.=' and m.warehouse_to='.$warehouse_id;}

		
		if(isset($t_date)) 
		{$to_date=$t_date; $fr_date=$f_date; $con.=' and m.pi_date between "'.$fr_date.'" and "'.$to_date.'"';}

		$sql='select 
m.pi_no, m.invoice_no, m.pi_date,  w.warehouse_name as Depot,  
		sum(a.item_in*i.p_price) as cost_amt,sum(a.item_in*i.d_price) as DP_amt,m.carried_by
		from journal_item a, item_info i, user_activity_management c,warehouse w,production_issue_master m,production_issue_detail d  where w.use_type="SD" and a.item_in>0 and a.relevant_warehouse='.$_SESSION['user']['depot'].' and 
		d.id=a.tr_no and d.pi_no=m.pi_no and w.warehouse_id=a.warehouse_id and (a.tr_from="Issue" OR a.tr_from="Transfered" OR a.tr_from="Transit") and c.user_id=a.entry_by and a.item_id=i.item_id'.$con.' group by d.pi_no order by m.pi_date';
				
		//$sql='select  	a.pi_no, a.pi_date,  b.warehouse_name as Depot, a.remarks as sl_no, a.carried_by,sum(total_amt) as total_amt from production_issue_master a,production_issue_detail c,warehouse b where   a.warehouse_from='.$_SESSION['user']['depot'].' and a.pi_no=c.pi_no and a.warehouse_to=b.warehouse_id and b.use_type!="PL" '.$con.' group by c.pi_no order by a.pi_no desc';
		
		break;
		
		
		 case 10:

		$report="Purchased report";

		if(isset($by)) 			{$by_con=' and a.entry_by='.$by;}

		

		if(isset($cat_id)) 		{$cat_con=' and d.id='.$cat_id;}

		if(isset($item_id)) 	{$item_con=' and e.item_id='.$item_id;}
		
		if(isset($vendor_id)) 	{$vendor_con=' and a.vendor_id='.$vendor_id;}
		
		if(isset($ctg_warehouse)) 	{$ctg_warehouse_con=' and b.shed_id='.$ctg_warehouse;}

		if(isset($garden_id)) 	{$garden_id_con=' and b.garden_id='.$garden_id;}

		if(isset($status)) 		{$status_con=' and a.status="'.$status.'"';}

		

if(isset($t_date)) 

{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.po_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



		

		$sql='select a.po_no as po_no, b.lot_no, b.invoice_no as inv_no, e.item_name as item_grade, b.quality as mark, CONVERT(b.pkgs,  DECIMAL(20,2)) as pkgs, b.qty as total_Pcs,b.rate,b.amount
		   

		   from purchase_master a, purchase_invoice b, vendor c, item_sub_group d, item_info e, user_activity_management f

		   where a.po_no=b.po_no and c.vendor_id=a.vendor_id and b.item_id=e.item_id and d.sub_group_id=e.sub_group_id   and f.user_id=a.entry_by  and (a.status="CHECKED" or a.status="COMPLETED") '.$date_con.$by_con.$vendor_con.$cat_con.$item_con.$status_con.$ctg_warehouse_con.$garden_id_con.' group by b.id order by a.po_no,b.id';

	break;
	
	
	 case 15:

		$report="Black Tea Purchased Report (Pkgs Wise)";

		if(isset($by)) 			{$by_con=' and a.entry_by='.$by;}

		

		if(isset($cat_id)) 		{$cat_con=' and d.id='.$cat_id;}

		if(isset($item_id)) 	{$item_con=' and e.item_id='.$item_id;}
		
		if(isset($vendor_id)) 	{$vendor_con=' and a.vendor_id='.$vendor_id;}
		
		if(isset($ctg_warehouse)) 	{$ctg_warehouse_con=' and b.shed_id='.$ctg_warehouse;}

		if(isset($garden_id)) 	{$garden_id_con=' and b.garden_id='.$garden_id;}

		if(isset($status)) 		{$status_con=' and a.status="'.$status.'"';}

		

if(isset($t_date)) 

{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.po_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



		

		  $sql='select a.po_no as po_no,  DATE_FORMAT(a.po_date, "%d-%m-%Y") as po_date, a.sale_no, DATE_FORMAT(a.sale_date, "%d-%m-%Y") as Sale_date, (select sum(pkgs) from purchase_invoice where po_no=a.po_no group by po_no) as total_pkgs,  (select sum(qty) from purchase_invoice where po_no=a.po_no group by po_no) as total_qty,(select sum(amount) from purchase_invoice where po_no=a.po_no group by po_no) as amount, ((select sum(amount) from purchase_invoice where po_no=a.po_no group by po_no) / (select sum(qty) from purchase_invoice where po_no=a.po_no group by po_no)) as average, v.vendor_name as broker_name
		   

		   from purchase_master a, purchase_invoice b, item_sub_group d, item_info e, user_activity_management f  , tea_warehouse t, vendor v

		   where a.po_no=b.po_no and  d.sub_group_id=e.sub_group_id and b.item_id=e.item_id and b.garden_id=g.garden_id and b.shed_id=t.warehouse_id and f.user_id=a.entry_by and a.vendor_id=v.vendor_id   and (a.status="CHECKED" or a.status="COMPLETED") '.$by_con.$vendor_con.$cat_con.$item_con.$status_con.$ctg_warehouse_con.$garden_id_con.$date_con.' group by a.po_no order by a.po_no ';

	break;
		
		
		case 12:

		$report=" Purchase Received report (PO Wise)";

		if(isset($by)) 			{$by_con=' and a.entry_by='.$by;}

	

		if(isset($cat_id)) 		{$cat_con=' and d.id='.$cat_id;}

		if(isset($item_id)) 	{$item_con=' and b.item_id='.$item_id;}
		
		if(isset($vendor_id)) 	{$vendor_con=' and a.vendor_id='.$vendor_id;}
		
		if(isset($ctg_warehouse)) 	{$ctg_warehouse_con=' and b.shed_id='.$ctg_warehouse;}

		if(isset($garden_id)) 	{$garden_id_con=' and b.garden_id='.$garden_id;}

		

		if(isset($status)) 		{$status_con=' and a.status="'.$status.'"';}

		

if(isset($t_date)) 

{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.po_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



		

		 $sql='select a.po_no as po_no, DATE_FORMAT(a.po_date, "%d-%m-%Y") as po_date, a.sale_no, r.pr_no, r.rec_date, b.lot_no, r.rec_date,  b.invoice_no as inv_no, e.item_name as item_grade, b.quality as mark, CONVERT(b.pkgs, DECIMAL(20,2)) as pkgs, b.qty as received,b.rate,b.amount
		
		 from purchase_master a, purchase_invoice b, purchase_receive r, vendor c, item_sub_group d, item_info e, user_activity_management f 
		 
		 where a.po_no=b.po_no and b.id=r.order_no and c.vendor_id=a.vendor_id and d.sub_group_id=e.sub_group_id and b.item_id=e.item_id  and f.user_id=a.entry_by and (a.status="CHECKED" or a.status="COMPLETED") '.$date_con.$by_con.$vendor_con.$cat_con.$item_con.$status_con.$ctg_warehouse_con.$garden_id_con.' order by r.rec_date';

	break;
		
		case 304:

		$report="Material Requisition Report";

		if(isset($by)) 			{$by_con=' and a.entry_by='.$by;}

	

		if(isset($cat_id)) 		{$cat_con=' and d.id='.$cat_id;}

		if(isset($item_id)) 	{$item_con=' and b.item_id='.$item_id;}
		
		if(isset($vendor_id)) 	{$vendor_con=' and a.vendor_id='.$vendor_id;}
		
		if(isset($ctg_warehouse)) 	{$ctg_warehouse_con=' and b.shed_id='.$ctg_warehouse;}

		if(isset($garden_id)) 	{$garden_id_con=' and b.garden_id='.$garden_id;}

		

		if(isset($status)) 		{$status_con=' and a.status="'.$status.'"';}

		

if(isset($t_date)) 

{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.po_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



		

		 $sql='select a.po_no as po_no, DATE_FORMAT(a.po_date, "%d-%m-%Y") as po_date, a.sale_no, r.pr_no, r.rec_date, b.lot_no, r.rec_date,  b.invoice_no as inv_no, e.item_name as item_grade, b.quality as mark, CONVERT(b.pkgs, DECIMAL(20,2)) as pkgs, b.qty as received,b.rate,b.amount
		
		 from purchase_master a, purchase_invoice b, purchase_receive r, vendor c, item_sub_group d, item_info e, user_activity_management f 
		 
		 where a.po_no=b.po_no and b.id=r.order_no and c.vendor_id=a.vendor_id and d.sub_group_id=e.sub_group_id and b.item_id=e.item_id  and f.user_id=a.entry_by and (a.status="CHECKED" or a.status="COMPLETED") '.$date_con.$by_con.$vendor_con.$cat_con.$item_con.$status_con.$ctg_warehouse_con.$garden_id_con.' order by r.rec_date';

	break;
		
		
		
		case 13:

		$report="Purchase Received report (Rec. Date Wise)";

		if(isset($by)) 			{$by_con=' and a.entry_by='.$by;}

		

		if(isset($cat_id)) 		{$cat_con=' and d.id='.$cat_id;}

		if(isset($item_id)) 	{$item_con=' and b.item_id='.$item_id;}
		
		if(isset($vendor_id)) 	{$vendor_con=' and a.vendor_id='.$vendor_id;}
		
		if(isset($ctg_warehouse)) 	{$ctg_warehouse_con=' and b.shed_id='.$ctg_warehouse;}

		if(isset($garden_id)) 	{$garden_id_con=' and b.garden_id='.$garden_id;}

		

		if(isset($status)) 		{$status_con=' and a.status="'.$status.'"';}

		

if(isset($t_date)) 

{$to_date=$t_date; $fr_date=$f_date; $date_con=' and r.rec_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



		

		 $sql='select  r.pr_no,  DATE_FORMAT(r.rec_date, "%d-%m-%Y") as rec_date, r.po_no as po_no,  DATE_FORMAT(a.po_date, "%d-%m-%Y") as po_date,  r.lot_no,  r.invoice_no as inv_no, e.item_name as item_grade, r.quality as mark, CONVERT(r.pkgs, DECIMAL(20,2)) as pkgs, r.qty as received_Pcs,r.rate,r.amount
		
		 from purchase_master a, purchase_invoice b, purchase_receive r, vendor c, item_sub_group d, item_info e, user_activity_management f 
		 
		 where a.po_no=b.po_no and b.id=r.order_no and c.vendor_id=a.vendor_id and d.sub_group_id=e.sub_group_id and b.item_id=e.item_id  and f.user_id=a.entry_by and (a.status="CHECKED" or a.status="COMPLETED") '.$date_con.$by_con.$vendor_con.$cat_con.$item_con.$status_con.$ctg_warehouse_con.$garden_id_con.' order by a.po_no,b.id';

	break;
	
	
	
	case 130000:

		$report="Black Tea Purchase Received report (Rec. Date Wise)";

		if(isset($by)) 			{$by_con=' and a.entry_by='.$by;}

		

		if(isset($cat_id)) 		{$cat_con=' and d.id='.$cat_id;}

		if(isset($item_id)) 	{$item_con=' and b.item_id='.$item_id;}
		
		if(isset($vendor_id)) 	{$vendor_con=' and a.vendor_id='.$vendor_id;}
		
		if(isset($ctg_warehouse)) 	{$ctg_warehouse_con=' and b.shed_id='.$ctg_warehouse;}

		if(isset($garden_id)) 	{$garden_id_con=' and b.garden_id='.$garden_id;}

		

		if(isset($status)) 		{$status_con=' and a.status="'.$status.'"';}

		

if(isset($t_date)) 

{$to_date=$t_date; $fr_date=$f_date; $date_con=' and r.rec_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



		

		 $sql='select  r.pr_no,  DATE_FORMAT(r.rec_date, "%d-%m-%Y") as rec_date,  r.truck_no, r.po_no as po_no,  DATE_FORMAT(a.po_date, "%d-%m-%Y") as po_date, r.sale_no, DATE_FORMAT(a.sale_date, "%d-%m-%Y") as Sale_date, r.lot_no,    r.invoice_no as inv_no, e.item_name as item_grade, r.quality as mark, CONVERT(r.pkgs, DECIMAL(20,2)) as pkgs, r.qty as received_pcs,r.rate,r.amount
		
		 from purchase_master a, purchase_invoice b, purchase_receive r, vendor c, item_sub_group d, item_info e, user_activity_management f  
		 
		 where a.po_no=b.po_no and b.id=r.order_no and c.vendor_id=a.vendor_id and d.sub_group_id=e.sub_group_id and b.item_id=e.item_id and b.garden_id=g.garden_id and f.user_id=a.entry_by and (a.status="CHECKED" or a.status="COMPLETED") '.$date_con.$by_con.$vendor_con.$cat_con.$item_con.$status_con.$ctg_warehouse_con.$garden_id_con.' order by r.rec_date';

	break;
	
	
	
	
	 case 14:

		$report="Black Tea Issue Report (Blend Sheet)";

		if(isset($by)) 			{$by_con=' and a.entry_by='.$by;}

		

		if(isset($cat_id)) 		{$cat_con=' and d.id='.$cat_id;}

		if(isset($item_id)) 	{$item_con=' and e.item_id='.$item_id;}
		
		if(isset($vendor_id)) 	{$vendor_con=' and a.vendor_id='.$vendor_id;}
		
		if(isset($ctg_warehouse)) 	{$ctg_warehouse_con=' and b.shed_id='.$ctg_warehouse;}

		if(isset($garden_id)) 	{$garden_id_con=' and b.garden_id='.$garden_id;}

		if(isset($status)) 		{$status_con=' and a.status="'.$status.'"';}

		

if(isset($t_date)) 

{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.blend_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



		

		echo $sql='select b.id, a.blend_id, DATE_FORMAT(a.blend_date, "%d-%m-%Y") as blend_date, w.warehouse_name as Blend_name, b.sale_no, b.lot_no,    b.invoice_no as inv_no, e.item_name as item_grade,  CONVERT(b.pkgs,  DECIMAL(20,2)) as pkgs, b.sam_pay, b.sam_qty, b.qty as total_pcs,b.rate,b.amount
		   

		   from blend_sheet_master a, blend_sheet_details b,  item_sub_group d, item_info e, user_activity_management f  , warehouse w

		   where a.blend_id=b.blend_id and  d.sub_group_id=e.sub_group_id and b.item_id=e.item_id and b.garden_id=g.garden_id and a.line_id=w.warehouse_id and f.user_id=a.entry_by  and (a.status="CHECKED" or a.status="COMPLETED") '.$date_con.$by_con.$vendor_con.$cat_con.$item_con.$status_con.$ctg_warehouse_con.$garden_id_con.' order by a.blend_id,b.id';

	break;
		
		
case 8:
		$report="Warehouse Item Transection Report(Entry Wise)";
		if(isset($warehouse_id)) 				{$warehouse_con=' and a.relevant_warehouse='.$warehouse_id;} 
		if(isset($sub_group_id)) 				{$item_sub_con=' and i.sub_group_id='.$sub_group_id;} 
		elseif(isset($item_id)) 				{$item_con=' and a.item_id='.$item_id;} 
		
		if(isset($receive_status)){	
			if($receive_status=='All_Purchase')
			{$status_con=' and a.tr_from in ("Purchase","Local Purchase","Import")';}
			else
			{$status_con=' and a.tr_from="'.$receive_status.'"';}
		}
		
		elseif(isset($issue_status)) 		{$status_con=' and a.tr_from="'.$issue_status.'"';} 
		
		if(isset($t_date)) 
		{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.entry_at between \''.$fr_date.'\' and \''.date('Y-m-d',strtotime($_POST['t_date'])+24*60*60).'\'';}
		

		
		 $sql='select a.entry_at,ji_date,i.item_id,i.finish_goods_code as fg_code,i.item_name,s.sub_group_name as Category,i.unit_name as unit,a.item_in as `IN`,a.item_ex as `OUT`,a.item_price as rate,((a.item_in+a.item_ex)*a.item_price) as amount,a.tr_from as tr_type,sr_no,(select warehouse_name from warehouse where warehouse_id=a.relevant_warehouse) as warehouse,a.tr_no,c.fname as User ," " as Line_Manager
		   
		   from journal_item a, item_info i, user_activity_management c , item_sub_group s where c.user_id=a.entry_by and s.sub_group_id=i.sub_group_id and
		    a.item_id=i.item_id and a.warehouse_id="'.$_SESSION['user']['depot'].'" '.$date_con.$warehouse_con.$item_con.$status_con.$item_sub_con.' order by warehouse';
	break;
		case 1001:
		$report="Chalan Wise Sales Report";
		if(isset($warehouse_id)) 			{$con.=' and m.warehouse_to='.$warehouse_id;}

		
		if(isset($t_date)) 
		{$con.=' and m.pi_date between "'.$fr_date.'" and "'.$to_date.'"';}


		break;
		case 90725:
		$report="Product Transaction Report";
		break;
		case 10011:
		$report="Chalan Wise Sales Report";
		if(isset($warehouse_id)) 			{$con.=' and m.warehouse_to='.$warehouse_id;}

		
		if(isset($t_date)) 
		{$con.=' and m.pi_date between "'.$fr_date.'" and "'.$to_date.'"';}


		break;
		
		
		case 501:
		$report="Details Receive Report";
		if(isset($warehouse_id)) 			{$warehouse_con=' and a.relevant_warehouse='.$warehouse_id;} 
		if(isset($item_brand)) 				{$item_brand_con=' and i.item_brand='.$item_brand;} 
		if(isset($item_id)) 			    {$item_con=' and a.item_id='.$item_id;} 

		if(isset($t_date)) 
		{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.ji_date between "'.$fr_date.'" and "'.$to_date.'"';}

		
		$sql='select 
		m.pi_no,
		a.ji_date as date,
		w.warehouse_name  as warehouse,
		
		a.sr_no,
		i.finish_goods_code as fg,
		i.item_name,
		
		i.unit_name as unit,
		a.item_in as qty,
		d.unit_price as Cost_Price,
		(a.item_in*d.unit_price) as Cost_Amt,
		i.d_price as DP_Price,
		(a.item_in*i.d_price) as DP_Amt
		from journal_item a, item_info i, user_activity_management c,warehouse w,production_issue_master m,production_issue_detail d  where a.item_in>0 and a.warehouse_id='.$_SESSION['user']['depot'].' and 
		d.id=a.tr_no and d.pi_no=m.pi_no and w.warehouse_id=a.relevant_warehouse and (a.tr_from="Issue" or a.tr_from="Transfered" or a.tr_from="Transit") and c.user_id=a.entry_by and a.item_id=i.item_id'.$date_con.$warehouse_con.$item_con.$item_brand_con.' group by d.id order by a.ji_date';
		
		break;
		
		case 502:
		$report="Receive Report(Brief)";
		if(isset($warehouse_id)) 			{$warehouse_con=' and a.relevant_warehouse='.$warehouse_id;} 
		if(isset($item_brand)) 				{$item_brand_con=' and i.item_brand='.$item_brand;} 
		if(isset($item_id)) 			    {$item_con=' and a.item_id='.$item_id;} 

		
		if(isset($t_date)) 
		{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.ji_date between "'.$fr_date.'" and "'.$to_date.'"';}

		
		$sql='select 
		
		i.finish_goods_code as fg,
		i.item_name,
		i.unit_name as unit,
		
		sum(a.item_in) as qty,
		
		
		i.p_price as Cost_Price,
		sum(a.item_in*p_price) as cost_Amt,
		i.d_price as DP_Price,
		sum(a.item_in*i.d_price) as DP_Amt
		
		from journal_item a, item_info i, user_activity_management c,warehouse w  where a.item_in>0 and a.warehouse_id='.$_SESSION['user']['depot'].' and 
		w.warehouse_id=a.relevant_warehouse and (a.tr_from="Issue" or a.tr_from="Transfered" or a.tr_from="Transit") and c.user_id=a.entry_by and a.item_id=i.item_id'.$date_con.$warehouse_con.$item_con.$item_brand_con.' group by  a.item_id order by i.finish_goods_code';
		break;
		
		
		case 503:
		$report="Entry Wise Receive Report";
		if(isset($warehouse_id)) 			{$con.=' and a.relevant_warehouse='.$warehouse_id;} 

		
		if(isset($t_date)) 
		{$to_date=$t_date; $fr_date=$f_date; $con.=' and m.pi_date between "'.$fr_date.'" and "'.$to_date.'"';}

		$sql='select 
m.pi_no as TR_no, m.invoice_no, m.pi_date as TR_date,  w.warehouse_name as Depot,  sum(a.item_in) as quantity,
		sum(a.item_in*d.unit_price) as cost_amt, sum(a.item_in*i.d_price) as DP_amt, m.carried_by
		
	from journal_item a, item_info i, user_activity_management c,warehouse w,production_issue_master m,production_issue_detail d 
	 
		where a.item_in>0 and a.warehouse_id='.$_SESSION['user']['depot'].' and 
		d.id=a.tr_no and d.pi_no=m.pi_no and w.warehouse_id=a.relevant_warehouse and (a.tr_from="Issue" or a.tr_from="Transfered" or a.tr_from="Transit") and c.user_id=a.entry_by and a.item_id=i.item_id'.$con.' group by d.pi_no order by m.pi_date';
				
		//$sql='select  	a.pi_no, a.pi_date,  b.warehouse_name as Depot, a.remarks as sl_no, a.carried_by,sum(total_amt) as total_amt from production_issue_master a,production_issue_detail c,warehouse b where   a.warehouse_from='.$_SESSION['user']['depot'].' and a.pi_no=c.pi_no and a.warehouse_to=b.warehouse_id and b.use_type!="PL" '.$con.' group by c.pi_no order by a.pi_no desc';
		break;
		

}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?=$report?></title>
<link href="../../../assets/css/report.css" type="text/css" rel="stylesheet" />
<style>
*{
	font-size:
	}
h2, h3, h4 {
	text-align:center;
	}
</style>


<script type="text/javascript">

function hide()

{

    document.getElementById("pr").style.display="none";

}

</script>



<style type="text/css">
.vertical-text {
	transform: rotate(270deg);
	transform-origin: left top 1;
	float:left;
	width:2px;
	padding:1px;
	font-size:10px;
	font-family:Arial, Helvetica, sans-serif;
}
.style1 {font-weight: bold}
.style2 {font-weight: bold}
.style3 {font-weight: bold}

h3 { margin:0; padding:0; font-weight: 700;}
.style4 {font-weight: bold}
.style5 {font-weight: bold}
.style6 {font-weight: bold}
.style7 {font-weight: bold}
</style>

	<?
	require_once "../../../assets/support/inc.exporttable.php";
	?>

</head>
<body>
<!--<div align="center" id="pr">-->
<!--<input name="button" type="button" onclick="hide();window.print();" value="Print" />-->
<!--</div>-->
<div class="main">
<?

$str 	.= '<tr style="border: 0px">';
$str 	.= '<th style="border: 0px" colspan="2" width="25%" align="center" >';
if(isset($_SESSION['user']['group']))
	$str 	.= '<img width="50%" src="../../../logo/'.$_SESSION['proj_id'].'.png'.'">';
$str 	.= '</th>';

$str 	.= '<th style="border: 0px" colspan="6" width="50%" align="center" >';
$str 	.= '<h1 style="font-weight: bolder; text-align: center;">'.find_a_field('user_group','group_name','id='.$_SESSION['user']['group']).'</h1>';

if(isset($report))
	$str 	.= '<h2 style="margin: 1px; font-size:14px; font-weight: bold;">'.$report.'</h2>';

if(isset($vendor_id))
	$str 	.= '<h2 style="margin: 1px; font-size:12px;"><strong>Broker Name:</strong>'.find_a_field('vendor','vendor_name','vendor_id='.$vendor_id).'</h2>';

if(isset($ctg_warehouse))
	$str 	.= '<h3 style="margin: 1px; font-size:12px;"><strong>Ctg Warehouse:</strong> '.find_a_field('tea_warehouse','warehouse_name','warehouse_id='.$ctg_warehouse).'</h3>';

if(isset($garden_id))
	$str 	.= '<h3 style="margin: 1px; font-size:12px;"><strong>Garden Name:</strong> '.find_a_field('tea_garden','garden_name','garden_id='.$garden_id).'</h3>';


if(isset($to_date))
	$str 	.= '<h2 style="margin: 1px; font-size:12px;"><strong>For the Period of: </strong>'.date("d-m-Y",strtotime($fr_date)).' <strong>To</strong> '.date("d-m-Y",strtotime($to_date)).'</h2>';


if(isset($warehouse_id))
	$str 	.= '<h2 style="margin: 1px; font-size:12px;"><strong>PL/WH Name:</strong> '.find_a_field('warehouse','warehouse_name','warehouse_id='.$warehouse_id).'</h2>';

//	if(isset($warehouse_id))
//		$str 	.= '<h2 style="margin: 1px; font-size:12px;"><strong>PL/WH Name: </strong>'.find_a_field('warehouse','warehouse_name','warehouse_id='.$warehouse_id).'</h2>';
if(isset($allotment_no))
	$str 	.= '<h2 style="margin: 1px; font-size:12px;"><strong>Allotment No: </strong> '.$allotment_no.'</h2>';

if(isset($item_id))
	$str 	.= '<h2 style="margin: 1px; font-size:12px;"><strong>Item Name: </strong> '.find_a_field('item_info','item_name','item_id='.$item_id).'</h2>';

$str 	.= '</th>';

$str 	.= '<th style="border: 0px" colspan="2" width="25%" align="center" >';
$str 	.= '</th>';
$str 	.= '</tr>';
$str 	.= '<tr><th style="border: 0px" colspan="10">';
$str 	.= '<div class="date" style="margin: 1px; font-size:12px;"> <strong>Reporting Time:</strong> '.date("h:i A d-m-Y").'</div>';
$str 	.= '</th></tr>';





//$str 	.= '<div class="header">';
//		$str 	.= '<h1>'.find_a_field('user_group','group_name','id='.$_SESSION['user']['group']).'</h1>';
//		if(isset($report))
//		$str 	.= '<h2>'.$report.'</h2>';
//
//		if(isset($vendor_id))
//		$str 	.= '<h3>Broker Name: '.find_a_field('vendor','vendor_name','vendor_id='.$vendor_id).'</h3>';
//
//		if(isset($ctg_warehouse))
//		$str 	.= '<h3>Ctg Warehouse: '.find_a_field('tea_warehouse','warehouse_name','warehouse_id='.$ctg_warehouse).'</h3>';
//
//		if(isset($garden_id))
//		$str 	.= '<h3>Garden Name: '.find_a_field('tea_garden','garden_name','garden_id='.$garden_id).'</h3>';
//
//
//		if(isset($to_date))
//		$str 	.= '<h2>'.date("d-m-Y",strtotime($fr_date)).' To '.date("d-m-Y",strtotime($to_date)).'</h2>';
//		$str 	.= '</div>';
//		if(isset($_SESSION['company_logo']))
//		//$str 	.= '<div class="logo"><img height="60" src="'.$_SESSION['company_logo'].'"</div>';
//		$str 	.= '<div class="left">';
//		if(isset($warehouse_id))
//		$str 	.= '<p>PL/WH Name: '.find_a_field('warehouse','warehouse_name','warehouse_id='.$warehouse_id).'</p>';
//		if(isset($allotment_no))
//		$str 	.= '<p>Allotment No.: '.$allotment_no.'</p>';
//		$str 	.= '</div><div class="center">';
//		if(isset($item_id))
//		$str 	.= '<p>Item Name: '.find_a_field('item_info','item_name','item_id='.$item_id).'</p>';
//		$str 	.= '</div><div class="date">Reporting Time: '.date("h:i A d-m-Y").'</div>';
//
//
//






		
if($_POST['report']==2) 
{	
   if($item_id>0){
    $item_con = ' and i.item_id="'.$item_id.'"';
   }
  if(isset($warehouse_id)) {$warehouse_con=' and a.warehouse_id='.$warehouse_id;
  }else{
  	$warehouse_con=' and a.warehouse_id='.$_SESSION['user']['depot'];
  }

		$stockSql='select distinct i.item_id,i.unit_name,i.item_name,s.sub_group_name,i.finish_goods_code,i.d_price,a.group_name
		   from item_info i, item_sub_group s ,item_group a where  a.group_id=s.group_id and
		   i.sub_group_id=s.sub_group_id'.$item_sub_con.$item_con.' order by i.finish_goods_code,s.sub_group_name,i.item_name';
		   
		$query =mysql_query($stockSql);   
		
		if($warehouse_id>0){  
			$warehouse_name = find_a_field('warehouse','warehouse_name','warehouse_id='.$warehouse_id);
		}else{
			$warehouse_name = find_a_field('warehouse','warehouse_name','warehouse_id='.$_SESSION['user']['depot']);
		}
?>

<table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable"><thead><tr><td style="border:0px;" colspan="10"><div class="header"><h1><?=$_SESSION['company_name']?></h1><h2><?=$report?></h2>
<h2>Closing Stock of Date-<?=$to_date?></h2></div><div class="left"></div><div class="right"></div><div class="date">Reporting Time: <?=date("h:i A d-m-Y")?></div></td></tr><tr>
<th>S/L</th>
<th>Warehouse Name</th>
<th>Item ID</th>
<th>Item Group</th>
<th>Item Sub Group</th>

<th>FG</th>
<th>Item Name</th>
<th>Unit</th>
<th>Final Stock</th>
<th>Rate</th>
<th>Stock Price</th>
</tr>
</thead><tbody>
<?
$js=1;
while($data=mysql_fetch_object($query)){
if($_SESSION['user']['level']==5){ 
  $s='select FORMAT(sum(a.item_in-a.item_ex),2) as final_stock,sum((a.item_in-a.item_ex)*(a.item_price)) as Stock_price  
from journal_item a where  a.item_id="'.$data->item_id.'" '.$date_con.$status_con.$warehouse_con.' order by a.id desc limit 1';}
else{
$s='select FORMAT(sum(a.item_in-a.item_ex),2) as final_stock,sum((a.item_in-a.item_ex)*(a.item_price)) as Stock_price  
from journal_item a where  a.item_id="'.$data->item_id.'" '.$date_con.$status_con.' and a.warehouse_id="'.$_SESSION['user']['depot'].'" order by a.id desc limit 1';
}
$avg_rate = find_a_field('journal_item', '(sum(item_in*item_price)-sum(item_ex*item_price))/(sum(item_in)-sum(item_ex))', 'item_id = "'.$data->item_id.'" and warehouse_id="'.$_SESSION['user']['depot'].'"');
$q = mysql_query($s);
$i=mysql_fetch_object($q);$j++;
//$amt = $i->final_stock*$data->d_price;
$amt = $i->final_stock*$avg_rate;
$total_amt = $total_amt + $amt;
$t_stock+=$i->final_stock;
if($i->final_stock!=0)
{
		   ?>
<tr>
<td><?=$js++?></td>
<td><?=$warehouse_name?></td>
<td><?=$data->item_id?></td>
<td><?=$data->group_name?></td>

<td><?=$data->sub_group_name?></td>
<td><?=$data->finish_goods_code?></td>
<td><?=$data->item_name?></td>
<td><?=$data->unit_name?></td>
<td style="text-align:right"><?=$i->final_stock?></td>
<td style="text-align:right"><?=@number_format($avg_rate,2)?></td>
<td style="text-align:right"><?=number_format(($amt),2)?></td>
</tr>
<?
}
}
		
?>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td align="right"> <b>Total:</b></td>
<td></td>
<td></td>
<td style="text-align:right"><?=number_format(($t_stock),2)?></td>
<td></td>
<td style="text-align:right"><?=number_format(($total_amt),2)?></td>
</tr>
<?

}


if($_POST['report']==20022) 
{	
   if($item_id>0){
    $item_con = ' and i.item_id="'.$item_id.'"';
   }
  if(isset($warehouse_id)) {$warehouse_con=' and a.warehouse_id='.$warehouse_id;
  }else{
  	$warehouse_con=' and a.warehouse_id='.$_SESSION['user']['depot'];
  }

		$stockSql='select distinct i.item_id,i.unit_name,i.item_name,s.sub_group_name,i.finish_goods_code,i.d_price,i.min_stock
		   from item_info i, item_sub_group s where 
		   i.sub_group_id=s.sub_group_id'.$item_sub_con.$item_con.' order by i.finish_goods_code,s.sub_group_name,i.item_name';
		   
		$query =mysql_query($stockSql);   
		
		if($warehouse_id>0){  
			$warehouse_name = find_a_field('warehouse','warehouse_name','warehouse_id='.$warehouse_id);
		}else{
			$warehouse_name = find_a_field('warehouse','warehouse_name','warehouse_id='.$_SESSION['user']['depot']);
		}
?>

<table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable"><thead><tr><td style="border:0px;" colspan="10"><div class="header"><h1><?=$_SESSION['company_name']?></h1><h2><?=$report?></h2>
<h2>Closing Stock of Date-<?=$to_date?></h2></div><div class="left"></div><div class="right"></div><div class="date">Reporting Time: <?=date("h:i A d-m-Y")?></div></td></tr><tr>
<th>S/L</th>
<th>Warehouse Name</th>
<th>Item Code</th>
<th>Item Group</th>
<th>FG</th>
<th>Item Name</th>
<th>Unit</th>
<th>Alert Qty</th>
<th>Final Stock</th>
<!--<th>Rate</th>
<th>Stock Price</th>-->
</tr>
</thead><tbody>
<?
while($data=mysql_fetch_object($query)){
if($_SESSION['user']['level']==5){ 
  $s='select FORMAT(sum(a.item_in-a.item_ex),2) as final_stock,sum((a.item_in-a.item_ex)*(a.item_price)) as Stock_price  
from journal_item a where  a.item_id="'.$data->item_id.'" '.$date_con.$status_con.$warehouse_con.' order by a.id desc limit 1';}
else{
$s='select FORMAT(sum(a.item_in-a.item_ex),2) as final_stock,sum((a.item_in-a.item_ex)*(a.item_price)) as Stock_price  
from journal_item a where  a.item_id="'.$data->item_id.'" '.$date_con.$status_con.' and a.warehouse_id="'.$_SESSION['user']['depot'].'" order by a.id desc limit 1';
}
$avg_rate = find_a_field('journal_item', '(sum(item_in*final_price)-sum(item_ex*final_price))/(sum(item_in)-sum(item_ex))', 'item_id = "'.$data->item_id.'" and warehouse_id="'.$_SESSION['user']['depot'].'"');
$q = mysql_query($s);
$i=mysql_fetch_object($q);$j++;
//$amt = $i->final_stock*$data->d_price;
$amt = $i->final_stock*$avg_rate;
$total_amt = $total_amt + $amt;
		   ?>
<tr>
<td><?=$j?></td>
<td><?=$warehouse_name?></td>
<td><?=$data->item_id?></td>
<td><?=$data->sub_group_name?></td>
<td><?=$data->finish_goods_code?></td>
<td><?=$data->item_name?></td>
<td><?=$data->unit_name?></td>
<td><?=$data->min_stock?></td>
<?
 if ($i->final_stock<2*$data->min_stock){?>
<td  style="text-align:right; background-color:red;"><?=$i->final_stock?></td>
<? } elseif($i->final_stock == 2*$data->min_stock){?>

<td  style="text-align:right; background-color:yellow;"><?=$i->final_stock?></td>
<? } elseif($i->final_stock > 2*$data->min_stock){?>

<td  style="text-align:right; background-color:white;"><?=$i->final_stock?></td>
<? } else{?>
<td  style="text-align:right; background-color:green;"><?=$i->final_stock?></td>
<? } ?>



<!--<td style="text-align:right"><?=@number_format($avg_rate,2)?></td>
<td style="text-align:right"><?=number_format(($amt),2)?></td>-->
</tr>
<?
}
		
?>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td align="right"> <b>Total:</b></td>
<td></td>
<td></td>
</tr>
<?

}


if($_POST['report']==20025) 
{	
   if($item_id>0){
    $item_con = ' and i.item_id="'.$item_id.'"';
   }
  if(isset($warehouse_id)) {$warehouse_con=' and a.warehouse_id='.$warehouse_id;
  }else{
  	$warehouse_con=' and a.warehouse_id='.$_SESSION['user']['depot'];
  }

		$stockSql='select distinct i.item_id,i.unit_name,i.item_name,s.sub_group_name,i.finish_goods_code,i.d_price,i.cost_price, g.group_id
		   from item_info i, item_sub_group s, item_group g where  g.group_id like "1%" and g.group_id=s.group_id and
		   i.sub_group_id=s.sub_group_id'.$item_sub_con.$item_con.' order by i.finish_goods_code,s.sub_group_name,i.item_name ';
		   
		$query =mysql_query($stockSql);   
		
		if($warehouse_id>0){  
			$warehouse_name = find_a_field('warehouse','warehouse_name','warehouse_id='.$warehouse_id);
		}else{
			$warehouse_name = find_a_field('warehouse','warehouse_name','warehouse_id='.$_SESSION['user']['depot']);
		}
?>

<table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable"><thead><tr><td style="border:0px;" colspan="10"><div class="header"><h1><?=$_SESSION['company_name']?></h1><h2><?=$report?></h2>
<h2>Closing Stock of Date-<?=$to_date?></h2></div><div class="left"></div><div class="right"></div><div class="date">Reporting Time: <?=date("h:i A d-m-Y")?></div></td></tr><tr>
<th>S/L</th>
<th>Warehouse Name</th>
<th>Item Code</th>
<th>Item Group</th>
<th>FG</th>
<th>Item Name</th>
<th>Unit</th>
<th>Cost Price</th>
<th>Production Cost</th>
<!--<th>Rate</th>
<th>Stock Price</th>-->
</tr>
</thead><tbody>
<?
while($data=mysql_fetch_object($query)){
if($_SESSION['user']['level']==5){ 
  $s='select FORMAT(sum(a.item_in-a.item_ex),2) as final_stock,sum((a.item_in-a.item_ex)*(a.item_price)) as Stock_price  
from journal_item a where  a.item_id="'.$data->item_id.'" '.$date_con.$status_con.$warehouse_con.' order by a.id desc limit 1';}
else{
$s='select FORMAT(sum(a.item_in-a.item_ex),2) as final_stock,sum((a.item_in-a.item_ex)*(a.item_price)) as Stock_price  
from journal_item a where  a.item_id="'.$data->item_id.'" '.$date_con.$status_con.' and a.warehouse_id="'.$_SESSION['user']['depot'].'" order by a.id desc limit 1';
}
$avg_rate = find_a_field('journal_item', '(sum(item_in*final_price)-sum(item_ex*final_price))/(sum(item_in)-sum(item_ex))', 'item_id = "'.$data->item_id.'" and warehouse_id="'.$_SESSION['user']['depot'].'"');
$q = mysql_query($s);
$i=mysql_fetch_object($q);$j++;
//$amt = $i->final_stock*$data->d_price;
$amt = $i->final_stock*$avg_rate;
$total_amt = $total_amt + $amt;
$fg_cost_price =find_a_field ('journal_item j','j.item_price','j.item_id="'.$data->item_id.'" and tr_from like "Production Receive" order by j.ji_date desc');
		   ?>
<tr>
<td><?=$j?></td>
<td><?=$warehouse_name?></td>
<td><?=$data->item_id?></td>
<td><?=$data->sub_group_name?></td>
<td><?=$data->finish_goods_code?></td>
<td><?=$data->item_name?></td>
<td><?=$data->unit_name?></td>
<td><?=$data->cost_price?></td>
<?
 if ($fg_cost_price > $data->cost_price){?>
<td  style="text-align:right; background-color:#FF0000"><?=$fg_cost_price?></td>
<? } elseif($fg_cost_price == $data->cost_price){?>

<td  style="text-align:right; background-color:#FFFF00"><?=$fg_cost_price?></td>
<? } elseif($fg_cost_price < $data->cost_price){?>

<td  style="text-align:right; background-color:#FFFFFF"><?=$fg_cost_price?></td>
<? } else{?>
<td  style="text-align:right; background-color:#FFFFFF"><?=$fg_cost_price?></td>
<? } ?>



<!--<td style="text-align:right"><?=@number_format($avg_rate,2)?></td>
<td style="text-align:right"><?=number_format(($amt),2)?></td>-->
</tr>
<?
}
		
?>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td align="right"> <b>Total:</b></td>
<td></td>
<td></td>
</tr>
<?

}




	
if($_POST['report']==22) 
{	if(isset($warehouse_id)) 			{$warehouse_con=' and a.warehouse_id='.$warehouse_id;}

	$sql='select distinct i.item_id,i.unit_name,i.item_name,s.sub_group_name,i.finish_goods_code,i.cost_price
		   from item_info i, item_sub_group s where  1 and
		   i.sub_group_id=s.sub_group_id'.$item_sub_con.' order by i.finish_goods_code,s.sub_group_name,i.item_name';
		   
		$query =mysql_query($sql);   
		
		if($warehouse_id>0){  
		$warehouse_name = find_a_field('warehouse','warehouse_name','warehouse_id='.$_SESSION['user']['depot']);
		}else{
		$warehouse_name = find_a_field('warehouse','warehouse_name','warehouse_id='.$_SESSION['user']['depot']);
		}
		$warehouse_con = ' and a.warehouse_id='.$_SESSION['user']['depot'];
?>
<table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable"><thead><tr><td style="border:0px;" colspan="9"><div class="header"><h1>		<?

		echo $str;

		?></h2>
</td></tr><tr>
<th>S/L</th>
<th>Warehouse Name</th>
<!--<th>Item Code</th>-->
<th>Item Group</th>
<th>Item Code</th>
<th>Item Name</th>
<th>Unit</th>
<th>Final Stock</th>
<!--<th>Rate</th>
<th>Stock Price</th>-->
</tr>
</thead><tbody>
<?
while($data=mysql_fetch_object($query)){

$s='select sum(a.item_in-a.item_ex) as final_stock
from journal_item a where  a.item_id="'.$data->item_id.'" '.$date_con.$item_con.$status_con.$warehouse_con.' order by a.id desc limit 1';

$q = mysql_query($s);
$i=mysql_fetch_object($q);

 $in_transit=find_a_field_sql('select FORMAT(sum(a.item_in-a.item_ex),2) as final_stock
from journal_item a where (a.tr_from="TRANSIT" and a.item_in>0) and a.item_id="'.$data->item_id.'" '.$date_con.$item_con.$status_con.$warehouse_con.' ');
$i->final_stock = $i->final_stock - $in_transit;
$j++;
$amt = $i->final_stock*$data->cost_price;
$total_amt = $total_amt + $amt;
		   ?>
<tr>
<td><?=$j?></td>
<td><?=$warehouse_name?></td>
<!--<td><?=$data->item_id?></td>-->
<td><?=$data->sub_group_name?></td>
<td><?=$data->finish_goods_code?></td>
<td><?=$data->item_name?></td>
<td><?=$data->unit_name?></td>
<td style="text-align:right"><?=$i->final_stock?></a></td>
<!--<td style="text-align:right"><?=@number_format($data->cost_price,2)?></td>
<td style="text-align:right"><?=number_format(($amt),2)?></td>-->
</tr>
<?
$tot_qty+=$i->final_stock;
}
		
?>
<tr>
<td></td>
<td></td>
<!--<td></td>-->
<td></td>
<td></td>
<td></td>
<td align="right"><b>Total:</b></td>

<td><?=$tot_qty?></td>
<!--<td></td>
<td style="text-align:right"><?=number_format(($total_amt),2)?></td>-->
</tr>
<?

}









elseif($_POST['report']==4) 
{
if(isset($warehouse_id)) 			{$warehouse_con=' and a.warehouse_id='.$warehouse_id;}
if(isset($item_id)) 				{$item_cons=' and i.item_id='.$item_id;}
if($_SESSION['user']['depot']==5)
$sql='select distinct i.item_id,i.unit_name,i.item_name,s.sub_group_name,i.finish_goods_code,i.pack_size,i.d_price as item_price
		   from item_info i, item_sub_group s where i.product_nature = "Salable" '.$item_cons.' and 
		   i.sub_group_id=s.sub_group_id order by i.finish_goods_code,s.sub_group_name,i.item_name';
else
$sql='select distinct i.item_id,i.unit_name,i.item_name,s.sub_group_name,i.finish_goods_code,i.pack_size,i.d_price as item_price
		   from item_info i, item_sub_group s where i.product_nature = "Salable" '.$item_cons.' and 
		   i.sub_group_id=s.sub_group_id order by i.finish_goods_code,s.sub_group_name,i.item_name';
		$query =mysql_query($sql); 
		if($warehouse_id>0){  
		$warehouse_name = find_a_field('warehouse','warehouse_name','warehouse_id='.$warehouse_id);
		}else{
		$warehouse_name = find_a_field('warehouse','warehouse_name','warehouse_id='.$_SESSION['user']['depot']);
		}
?>

<table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable"><thead><tr><td style="border:0px;" colspan="10"><div class="header"><h1>ZISAN FOOD & BEVERAGE LTD</h1><h2><?=$report?></h2>
<h2>Closing Stock of Date - <b><?=date("d-m-Y",strtotime($to_date));?></b></h2></div><div class="left"></div><div class="right"></div><div class="date">Reporting Time: <?=date("h:i A d-m-Y")?></div></td></tr><tr>
<th rowspan="2">S/L</th>
<th rowspan="2">Warehouse Name</th>
<th rowspan="2">Item Code</th>
<th rowspan="2">FG</th>
<th rowspan="2">Item Name</th>
<th rowspan="2">Pack Size</th>
<th rowspan="2">Unit</th>
<th colspan="2">Final Stock</th>
<th rowspan="2">Total Kg</th>
<th rowspan="2">Rate</th>
<th rowspan="2">Stock Price</th>
</tr>
<tr>
  <th bgcolor="#CCFFFF">Kg</th>
  <th bgcolor="#FFCCFF">ctr</th>
</tr>

</thead><tbody>
<?
while($data=mysql_fetch_object($query)){
if($_SESSION['user']['level']==4 or $_SESSION['user']['level']==5){
 $s='select sum(a.item_in-a.item_ex) as final_stock
from journal_item a where  a.item_id="'.$data->item_id.'" '.$date_con.$item_con.$status_con.$warehouse_con.' order by a.id desc limit 1';
}else{
$s='select sum(a.item_in-a.item_ex) as final_stock
from journal_item a where  a.item_id="'.$data->item_id.'" '.$date_con.$item_con.$status_con.' and a.warehouse_id="'.$_SESSION['user']['depot'].'" order by a.id desc limit 1';
}
//echo $s;
$q = mysql_query($s);
$i=mysql_fetch_object($q);$j++;
		   ?>
<tr>
<td><?=$j?></td>
<td><?=$warehouse_name?></td>
<td><?=$data->item_id?></td>
<td><?=$data->finish_goods_code?></td>
<td><?=$data->item_name?></td>
<td><?=$data->pack_size?></td>
<td><?=$data->unit_name?></td>
<td style="text-align:right; background-color:#CCFFFF;"><?=number_format(($i->final_stock/$data->pack_size),2)?></td>
<td style="text-align:right;background-color:#FFCCFF;"><?=($i->final_stock%$data->pack_size)?></td>
<td style="text-align:right"><?=number_format($i->final_stock,2)?></td>
<td style="text-align:right"><?=@number_format(($data->item_price),2)?></td>
<td style="text-align:right"><? $sum =$data->item_price*$i->final_stock; echo number_format(($data->item_price*$i->final_stock),2);?></td>
</tr>
<?
$t_unit+=$i->final_stock;
$t_sum = $t_sum + $sum;
}
?>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td align="right"> <b>Total :</b></td>
<td></td>
<td style="text-align:right; background-color:#CCFFFF;"><?= number_format($t_unit,2)?></td>
<td style="text-align:right;background-color:#FFCCFF;"></td>
<td style="text-align:right"><?= number_format($t_unit,2)?></td>
<td style="text-align:right"></td>
<td style="text-align:right"><?=number_format($t_sum,2)?></td>
</tr>
<?
}


elseif($_POST['report']==8102521)
{


$f_date = $_POST['f_date'];
$t_date = $_POST['t_date'];


?>

<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    overflow-x: hidden;
  }

  /* ===== SCREEN VIEW ===== */
  @media screen {
    .table-container {
      max-height: 800px;       /* enable vertical scroll only */
      overflow-y: auto;
      overflow-x: hidden;
      border: 1px solid #aaa;
      margin: 10px auto;
      width: 98%;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      text-align: center;
      font-size: 13px;
      table-layout: fixed;
    }

    th, td {
      border: 1px solid #999;
      padding: 5px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    th {
      background: #f2f2f2;
      position: sticky;  /* fixed header */
      top: 0;
      z-index: 2;
    }
  }

  /* ===== PRINT VIEW ===== */
  @media print {
    body {
      overflow: visible !important;
    }

    .table-container {
      overflow: visible !important;
      max-height: none !important;
      border: none;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 12px;
      page-break-inside: auto;
    }

    thead {
      display: table-header-group; /* repeat header on every page */
    }

    tfoot {
      display: table-footer-group;
    }

    tr {
      page-break-inside: avoid;
      page-break-after: auto;
    }

    th {
      position: static !important;  /* disable sticky in print */
      background: #f2f2f2 !important;
    }

    /* Hide unnecessary borders/margins */
    .table-container {
      margin: 0;
    }
  }

  /* Section colors */
  .debit { background-color: #f9d5b1; }
  .credit { background-color: #d4dae6; }
  .summary { background-color: #e8f0cc; }
  .total { background-color: #c7d5f5; }

  h3 {
    text-align: center;
    margin-top: 20px;
  }

  /* Optional fixed widths */
  th:nth-child(1), td:nth-child(1) { width: 70px; }
  th:nth-child(2), td:nth-child(2) { width: 90px; }
  th:nth-child(3), td:nth-child(3) { width: 80px; }
  th:nth-child(4), td:nth-child(4) { width: 120px; }
</style>





<div class="table-container">
  <table id="ExportTable">
    <thead>
		<tr style="border:none">
			<th colspan="20" style="border:none; text-align:center; font-size:18px; ">Jamuna Seeds Storage(Pvt.)Ltd</th>
		</tr>
		<tr style="border:none">
			<th colspan="20" style="border:none; text-align:center;">For the Period Of: <?=$_POST['f_date']?> To <?=$_POST['t_date']?></th>
		</tr>
		<tr style="border:none">
			<th colspan="20" style="border:none; text-align:center;">Loan Report (Ledger Wise)</th>
		</tr>
      <tr>
        <th rowspan="2">Date</th>
        <th rowspan="2">Loan Details</th>
        <th rowspan="2">Booking No</th>
        <th rowspan="2">Booking Name</th>
        <th rowspan="2">Loan Type</th>

        <th colspan="5" class="debit" style="text-align:center;">Debit</th>
        <th colspan="7" class="credit" style="text-align:center;">Credit</th>
        <th colspan="3" class="summary" style="text-align:center;">Summary</th>
      </tr>
      <tr>
        <!-- Debit -->
        <th class="debit">Seeds Loan</th>
        <th class="debit">Farmer Loan</th>
        <th class="debit">Bag Loan</th>
        <th class="debit">S.R Loan</th>
        <th class="debit">Others Loan</th>

        <!-- Credit -->
        <th class="credit">Seeds Loan</th>
        <th class="credit">Farmer Loan</th>
        <th class="credit">Bag Loan</th>
        <th class="credit">S.R Loan</th>
        <th class="credit">Others Loan</th>
        <th class="credit">Days</th>
        <th class="credit">Interest</th>

        <!-- Summary -->
        <th class="summary">Total Received</th>
        
        <th class="total">Total Payment</th>
		<th class="total">Due Amount</th>
      </tr>
    </thead>

    <tbody>
      <?php
	  // Credit query
  $sql2 = "
SELECT  c.chalan_no AS invoice_no, c.booking_no, p.name AS booking_name,
       sum(c.sr_loan) as sr, sum(c.bag_loan) as bag, sum(c.total_interest) as interests, sum(c.loan_days) as days
FROM  paid_booking p
JOIN sale_do_chalan c ON c.booking_no = p.booking_number_eng
WHERE p.booking_year ='".$_POST['rec_year']."'
  
  AND c.chalan_date BETWEEN '$f_date' AND '$t_date' group by c.booking_no
";
$q2 = mysql_query($sql2);
while($rw=mysql_fetch_object($q2))
{
 $sr_loan[$rw->booking_no]=$rw->sr;
 $bag_loan[$rw->booking_no]=$rw->bag;
 $interest[$rw->booking_no]=$rw->interests;
 $days[$rw->booking_no]=$rw->days;
 

}
// Debit query
 $sql12 = "
SELECT sum(s.amount) as amt, s.date AS trans_date, '' AS invoice_no, s.booking_number, p.name AS booking_name,
       'S.R Loan' AS loan_type, s.amount AS sr_loan
FROM sr_loan s
JOIN paid_booking p ON p.booking_number_eng = s.booking_number
WHERE   s.date BETWEEN '$f_date' AND '$t_date' group by s.booking_number
";
$q22 = mysql_query($sql12);
while($rw2=mysql_fetch_object($q22))
{
$loan[$rw2->booking_number]=$rw2->amt;

}

 $sql121 = "
SELECT sum(s.amount) as amt, s.date AS trans_date, '' AS invoice_no, s.booking_number, p.name AS booking_name,
       'S.R Loan' AS loan_type, s.amount AS sr_loan
FROM bag_loan s
JOIN paid_booking p ON p.booking_number_eng = s.booking_number
WHERE   s.date BETWEEN '$f_date' AND '$t_date' group by s.booking_number
";
$q221 = mysql_query($sql121);
while($rw21=mysql_fetch_object($q221))
{
$bag_loan_rec[$rw21->booking_number]=$rw21->amt;

}

if($_POST['booking_number']!='')
{
$con=' and booking_number_eng="'.$_POST['booking_number'].'"';

}


// Debit query
  $sql122 = "
SELECT c.recdate, c.interest_amt,sum(c.total_days) as dayss ,sum(c.total_paid) as p_amt,c.booking_number
                                FROM sr_loan_return c, paid_booking p 
                                WHERE c.booking_number=p.booking_number_eng and p.booking_year='".$_POST['rec_year']."'
                                 
                                  and c.recdate BETWEEN '$f_date' AND '$t_date'
                                  
                                  and c.chalan_no is null
                                GROUP BY c.booking_number 
                                ORDER BY c.recdate ASC
";
$q222 = mysql_query($sql122);
while($rw22=mysql_fetch_object($q222))
{
$separate_loan[$rw22->booking_number]=$rw22->p_amt;
$separate_days[$rw22->booking_number]=$rw22->dayss;

}



  $sql1 = "
SELECT *
FROM  paid_booking 
WHERE booking_year='".$_POST['rec_year']."' ".$con." group by booking_number_eng
";

$q1 = mysql_query($sql1);


	  
	   while ($r = mysql_fetch_object($q1)) { 
	   
	   if($loan[$r->booking_number_eng]>0 || $bag_loan_rec[$r->booking_number_eng]>0)
	   {
	   ?>
	   
	   
        <tr>
          <td><?= $r->booking_date; ?></td>
          <td><a href="../wo/booking_details.php?booking_no=<?=$r->booking_number_eng?>" target="_blank">View</a></td>
          <td><?= $r->booking_number_eng; ?></td>
          <td><?= $r->name; ?></td>
          <td></td>

          <!-- Debit -->
          <td></td>
          <td></td>
          <td><?=$bag_loan_rec[$r->booking_number_eng]; $bag_rec+=$bag_loan_rec[$r->booking_number_eng];?></td>
          <td><?=$loan[$r->booking_number_eng]; $sr_rec+=$loan[$r->booking_number_eng]; ?></td>
          <td></td>
          <td></td>
		  <td></td>
		  <td><?=$bag_loan[$r->booking_number_eng]; $bag_cr+=$bag_loan[$r->booking_number_eng]; ?></td>
		  <td><?=$tot_sr=$sr_loan[$r->booking_number_eng]+$separate_loan[$r->booking_number_eng]; $sr_cr+=$tot_sr; ?></td>
		  <td></td>
		  <td><?=$days[$r->booking_number_eng]+$separate_days[$r->booking_number_eng];?></td>
		  <td><?=$interest[$r->booking_number_eng]; $interest_cr+=$interest[$r->booking_number_eng]; ?></td>
		  <td><?=$tot_paid=$bag_loan[$r->booking_number_eng]+$tot_sr; $t_paid+=$tot_paid; ?></td>
		  
		  <td><?=$tot_rec=$loan[$r->booking_number_eng]+$bag_loan_rec[$r->booking_number_eng]; $t_rec+=$tot_rec;?></td>
		  <td><?=$tot_due=$tot_rec-$tot_paid; $t_due+=$tot_due; ?></td>

          <!-- Summary -->
        </tr>
      <?php } } ?>
	  <tr>
	  	<td colspan="7">Total</td>
		<td><?=$bag_rec?></td>
		<td><?=$sr_rec?></td>
		<td colspan="3"></td>
		<td><?=$bag_cr?></td>
		<td><?=$sr_cr?></td>
		<td></td>
		<td></td>
		<td><?=$interest_cr?></td>
		<td><?=$t_paid?></td>
		<td><?=$t_rec?></td>
		<td><?=$t_due?></td>
	  </tr>
    </tbody>
  </table>
</div>






<?
}










		
elseif($_POST['report']==401) 
{

$com_name=find_a_field('project_info','proj_name','1');
?>
<style>
    
    table th {
    position:sticky;
    top:0;
    z-index:1;
    border-top:1;
    background: #ededed;
}
</style>
<h1 style="text-align:center;">

<?=find_a_field('user_group','group_name','id='.$_SESSION['user']['group'])?>
</h1>
<?

		 $str3 	.= '<h1 style="text-align:center;">'.find_a_field('warehouse','warehouse_name','warehouse_id='.$_SESSION['user']['depot']).'</h1>';
		 echo "<h2>Delivery Pending Report (ALL Chalan Wise)</h2>";
?>
<?php echo $str3;?>
<table width="100%;"  id="ExportTable" cellspacing="0" cellpadding="2" border="0" >
	<thead>
		<tr>
				<th>Sl</th>
				<th>SO No</th>
				<th>Order Date</th>
				<th>PO No</th>
				<th>PO Date</th>
				<th>SO Created By</th>
				<th>Reference By</th>
				<th>Customer ID</th>
				<th>Customer Name</th>
				<th>Delivery Location</th>
				<th>Item Code</th>
				<th>Item Name</th>
				<th>UOM</th>
				<th>Order Quantity</th>
				<th>Delivery Quantity</th>
				<th>Undelivery Quantity</th>
<!--				<th>UOM 2</th>
				<th>UOM 2 Quantity</th>-->
		
		</tr>
	</thead>
	<tbody>
	<?php 
	 $cust_id_get=$_POST['cust_id'];
	 $test=explode('--',$cust_id_get);
	 $item_name=$_POST['item_name'];
		
	
	 $cust_id=$test[1];
	 if($cust_id){
	 $con='and m.dealer_code="'.$cust_id.'"';
	 }
	 
	 if($item_name){
	 $con='and d.item_id="'.$item_name.'"';
	 }
	 
	 if($_POST['cust_id']!=''){ $dealer=' and m.dealer_code="'.$_POST['cust_id'].'"';}
	 if($do_no){
	 $con='and m.do_no="'.$do_no.'"';
	 }
	 
	 $sql='select d.*,m.do_date,m.status,m.do_no,m.po_no,m.dealer_code,m.entry_by,m.po_date from sale_do_details d,sale_do_master m where m.do_date between "'.$fr_date.'" and "'.$to_date.'" and m.status in("CHECKED","COMPLETED") and m.do_no=d.do_no '.$con.$dealer.' ';
	$query=mysql_query($sql);
	while($row=mysql_fetch_object($query)){
	 $del_qty= find_a_field('sale_do_chalan','sum(total_unit)','item_id="'.$row->item_id.'" and do_no="'.$row->do_no.'"');
$ord_qty=$row->total_unit;
$un_del_qty=$ord_qty-$del_qty;

if($un_del_qty >0){
	?>
		<tr>
			<td><?=++$i?></td>
			<td><?=$row->do_no?></td>
			<td><?=date("d-m-Y",strtotime($row->do_date))?></td>
			<td><?=$row->po_no?></td>
			<td><?=$row->po_date?></td>
			<td><?=find_a_field('user_activity_management','fname','user_id='.$row->entry_by);?></td>
			<td><?=find_a_field('dealer_info','reference','dealer_code='.$row->dealer_code);?></td>
			<td><?=$row->dealer_code?></td>
			<td><?=find_a_field('dealer_info','dealer_name_e','dealer_code='.$row->dealer_code);?></td>
			<td><?=find_a_field('dealer_info','delivery_address','dealer_code='.$row->dealer_code);?></td>
			<td><?=find_a_field('item_info','finish_goods_code','item_id='.$row->item_id);?></td>
			<td><?=find_a_field('item_info','item_name','item_id='.$row->item_id);?></td>
			<td><?=find_a_field('item_info','unit_name','item_id='.$row->item_id);?></td>
			<td><?php echo $ord_qty;?></td>
			<td><?php echo $del_qty;?></td>
			
			<!--<td><a href="master_report.php?report=219&do_no=<?=$row->do_no?>"><?php echo $un_del_qty=$ord_qty-$del_qty;?></a></td>-->
			
			<td><?php echo $un_del_qty;?></td>
			
<!--			<td><?=find_a_field('item_info','pack_unit','item_id='.$row->item_id);?></td>
			
			<td><?php $unit_two_qty=find_a_field('item_info','carton_qty','item_id='.$row->item_id);
			$total_sec_qty=$un_del_qty/$unit_two_qty;
			echo number_format($total_sec_qty,2);
			?>
			</td> -->
		
			
		</tr>
			<?php 
			
			
		$tot_or_qty+=$ord_qty;
		$tot_del_qty+=$del_qty;
		$tot_undel_qty+=$un_del_qty;
		$gr_total_sec_qty+=$total_sec_qty;
		}
		} ?>
		<tr>
			<th colspan="13" style="text-align:right;" >Total</th>
			<th><?=$tot_or_qty?></th>
			<th><?=$tot_del_qty?></th>
			<th><?=$tot_undel_qty?></th>
<!--			<th></th>
			<th><?=$gr_total_sec_qty?></th>-->
		</tr>
	</tbody>
</table>
<?

}







		
elseif($_POST['report']==402) 
{

$com_name=find_a_field('project_info','proj_name','1');
?>
<style>
    
    table th {
    position:sticky;
    top:0;
    z-index:1;
    border-top:1;
    background: #ededed;
}
</style>
<h1 style="text-align:center;">

<?=find_a_field('user_group','group_name','id='.$_SESSION['user']['group'])?>
</h1>
<?

		 $str3 	.= '<h1 style="text-align:center;">'.find_a_field('warehouse','warehouse_name','warehouse_id='.$_SESSION['user']['depot']).'</h1>';
		 echo "<h2>Undelivered PO Report</h2>";
?>
<?php echo $str3;?>
<table width="100%;"  id="ExportTable" cellspacing="0" cellpadding="2" border="0" >
	<thead>
		<tr>
				<th>Sl</th>
				<th>PO No</th>
				<th>PO Date</th>
				<th>PO Created By</th>
				
			 
				<th>vendor ID</th>
				<th>vendor Name</th>
				<th>Item Code</th>
				
				<th>Item Name</th>
				<th>UOM</th>
				<th>Order Quantity</th>
				<th>Delivery Quantity</th>
				<th>Undelivery Quantity</th>		
		</tr>
	</thead>
	<tbody>
	<?php 
	 $cust_id_get=$_POST['cust_id'];
	 $test=explode('--',$cust_id_get);
	 $item_name=$_POST['item_name'];
		
	
	 $cust_id=$test[1];
	 if($cust_id){
	 $con='and m.vendor_id="'.$cust_id.'"';
	 }
	 
	 if($item_name){
	 $con='and i.item_id="'.$item_name.'"';
	 }
	 
	 if($_POST['cust_id']!=''){ $dealer=' and m.vendor_id="'.$_POST['cust_id'].'"';}
	 if($po_no){
	 $con='and m.po_no="'.$po_no.'"';
	 }
	 
	 $sql='select i.*,m.po_date,m.status,m.po_no,m.vendor_id,m.entry_by from purchase_master m,purchase_invoice i where m.po_date between "'.$fr_date.'" and "'.$to_date.'" and m.status in("CHECKED","COMPLETED") and m.po_no=i.po_no '.$con.$dealer.' ';
	$query=mysql_query($sql);
	while($row=mysql_fetch_object($query)){
	 $del_qty= find_a_field('purchase_receive','sum(qty)','item_id="'.$row->item_id.'" and po_no="'.$row->po_no.'"');
$ord_qty=$row->qty;
$un_del_qty=$ord_qty-$del_qty;


	?>
		<tr>
			<td><?=++$i?></td>
			<td><?=$row->po_no?></td>
			<td><?=$row->po_date?></td>
			
			<td><?=find_a_field('user_activity_management','fname','user_id='.$row->entry_by);?></td>
	 
			<td><?=$row->vendor_id?></td>
			
			<td><?=find_a_field('vendor','vendor_name','vendor_id='.$row->vendor_id);?></td>
			
			
			<td><?=find_a_field('item_info','finish_goods_code','item_id='.$row->item_id);?></td>
			<td><?=find_a_field('item_info','item_name','item_id='.$row->item_id);?></td>
			<td><?=find_a_field('item_info','unit_name','item_id='.$row->item_id);?></td>
			<td><?php echo $ord_qty;?></td>
			<td><?php echo $del_qty;?></td>
						
			<td><?php echo $un_del_qty;?></td>
			

		
			
		</tr>
			<?php 
			
			
		$tot_or_qty+=$ord_qty;
		$tot_del_qty+=$del_qty;
		$tot_undel_qty+=$un_del_qty;
		$gr_total_sec_qty+=$total_sec_qty;
		
		} ?>
		<tr>
			<th colspan="9" style="text-align:right;" >Total</th>
			<th><?=$tot_or_qty?></th>
			<th><?=$tot_del_qty?></th>
			<th><?=$tot_undel_qty?></th>
<!--			<th></th>
			<th><?=$gr_total_sec_qty?></th>-->
		</tr>
	</tbody>
</table>
<?

}

elseif($_POST['report']==4002)
{

?>

  <table width="100%" cellspacing="0" cellpadding="2" border="0">

    <thead>

      <tr>

        <td style="border:0px;" colspan="9"><?=$str?>

          <center>

          </center>

          <div class="right"></div>

          <div class="date">Reporting Time:

            <?=date("h:i A d-m-Y")?>

        </div></td>

      </tr>

      <tr>

        <th>S/L</th>

       

        <th>Item Name</th>

        <th>Unit</th>
		 <th>Consumption No</th>
		  <th>Consumption Date</th>

        <th>Consumption Price </th>

        <th>Costing Price</th>
		 <th>Costing Price Percent of Consumption Price</th>

       

        

      

      </tr>

    </thead>

    <tbody>

      <?
	   $sql='select i.finish_goods_code as fg,i.item_id,i.item_name,i.unit_name,c.id,c.item_id,c.oi_no,c.oi_date,c.rate from item_info i,warehouse_other_issue_detail c where c.oi_date between "'.$_POST['f_date'].'" and "'.$_POST['t_date'].'" '.$item_con.' and c.item_id=i.item_id and issue_type="Consumption" group by c.item_id,c.oi_no ';

//$sql='select i.finish_goods_code as fg,i.item_id,i.item_name,i.unit_name as unit,i.s_price,i.c_price,i.d_price,i.pack_size,sum(m.total_unit) pcs,sum(a.total_unit) qty,sum(a.total_unit*i.d_price) as DP,sum(a.total_unit*a.unit_price)/sum(a.total_unit) as sale_price,sum(a.total_unit*a.unit_price) as actual_pricefrom dealer_info d, sale_do_details m,sale_do_chalan a, item_info i where d.dealer_code=m.dealer_code and m.id=a.order_no  and  a.unit_price>0  and a.item_id=i.item_id '.$con.$date_con.$warehouse_con.$item_con.$item_brand_con.$dtype_con.$pg_con.' group by  a.item_id order by i.finish_goods_code';

$query = mysql_query($sql);



while($data=mysql_fetch_object($query)){

$chalan_price=$data->rate;
$cogs_price=find_a_field('journal_item','sum(item_in*item_price)/sum(item_in)','item_id="'.$data->item_id.'"   ');
 
$percentage=(($cogs_price/$chalan_price)*100);



$jv_no=find_a_field('journal','jv_no','tr_no="'.$data->oi_no.'" and tr_from="Consumption"');


?>

      <tr 
	  <?php 
	  if($cogs_price>$chalan_price){
	  echo 'style="background-color:yellow"';
	  }
	  else if($cogs_price<$chalan_price){
	  echo 'style="background-color:red"';
	  }
	  ?>
	  >

        <td><?=++$s?></td>

       

        <td><?=$data->item_name?></td>

        <td><?=$data->unit_name?></td>
		  <td><a href="../../../acc_mod/pages/files/general_voucher_print_view_from_journal.php?jv_no=<?=$jv_no?>" target="_blank"><?=$data->oi_no?></a></td>
		  <td><?=$data->oi_date?></td>
		    <td><?=$chalan_price;?></td>
			  <td><?=$cogs_price;?></td>

		 <td><?php 
		echo number_format($percentage,2)." %";
		 ?></td> 

      </tr>

      <?



}



?>

       

    </tbody>

  </table>

 
  

  <? 

}
		
elseif($_POST['report']==403) 
{

$com_name=find_a_field('project_info','proj_name','1');
?>
<style>
    
    table th {
    position:sticky;
    top:0;
    z-index:1;
    border-top:1;
    background: #ededed;
}
</style>
<h1 style="text-align:center;">

<?=find_a_field('user_group','group_name','id='.$_SESSION['user']['group'])?>
</h1>
<?

		 $str3 	.= '<h1 style="text-align:center;">'.find_a_field('warehouse','warehouse_name','warehouse_id='.$_SESSION['user']['depot']).'</h1>';
		 echo "<h2>Store Receive Report</h2>";
?>
<?php echo $str3;?>
<table width="100%;"  id="ExportTable" cellspacing="0" cellpadding="2" border="0" >
	<thead>
		<tr>
		    
		    	<th>Invoice Date</th>
				<th>মূল বুকিং নাম</th>
				<th>BName</th>
				<th>Village</th>
				<th>Booking Type</th>
			 
				<th>BookingID</th>
				<th>SRID</th>
				<th>Rec Quantity</th>
				<th>Token No</th>
				
					
		</tr>
	</thead>
	<tbody>
	<?php 

  
          if($_POST['booking_type']!='')
	     $con=' and p.booking_type="'.$_POST['booking_type'].'"';
	  if($_POST['booking_number']!='')
	     $con .=' and p.booking_number_eng="'.$_POST['booking_number'].'"';
		 if($_POST['sr_number']!='')
	     $con .=' and a.bag_mark="'.$_POST['sr_number'].'"';
          if($_POST['f_date']!=''&&$_POST['t_date']!='')
            $con .= ' and a.or_date between "'.$_POST['f_date'].'" and "'.$_POST['t_date'].'"';
			if($_POST['farmer']!='')
	     $con .=' and a.farmer_name="'.$_POST['farmer'].'"';
		 if($_POST['dealer_name_e']!='')
	     $con .=' and a.agent_name="'.$_POST['dealer_name_e'].'"';
		 	 if($_POST['village']!='')
	     $con .=' and a.farmer_village="'.$_POST['village'].'"';
		 
		 if($_POST['rec_year']!='')
	     $con .=' and a.rec_year='.$_POST['rec_year'].'';

          $res='select   a.* ,sum(amount) as Total, p.booking_type
from warehouse_other_receive a, warehouse_other_receive_detail b, paid_booking p
where a.or_no=b.or_no and p.booking_number_eng=a.booking_number
'.$con.'
group by a.or_no order by a.receipt_number asc';
          //echo link_report($res,'po_print_view.php');

          $query = mysql_query($res);
          while($row = mysql_fetch_object($query)){

        ?>
		<tr>
		      <td><?=$row->or_date?></td>
			 <td><?=$row->agent_name?></td>
              <td><?=$row->farmer_name?></td>
              <td><?=$row->farmer_village?></td>
			  <td><?=$row->booking_type?></td>
              <td><?=$row->booking_number?></td>
              <td><?=$row->bag_mark?></td>
              <td><?=$row->qty; $t_qty+=$row->qty;?></td>
			   <td><?=$row->token_number?></td>
			
			
		
			

		
			
		</tr>
		
		
	
		 <? } ?>
		 
		 	<tr>
		    
		    	<th colspan="7">Total</th>
		    	<th> <?=$t_qty ?></th>	
				<th></th>
		</tr>
		
	</tbody>
</table>

<?

}
		
elseif($_POST['report']==90725) 
{
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" id="ExportTable">
<tr style="border:none;">
    <th colspan="17" style="border:none;"><?=$str;?></th>
   
    
  </tr>
  <tr>
    <th>SL</th>
    <th>Tr Date</th>
    <th>Item Code</th>
    <th>FG Code</th>
    <th>Item Name </th>
    <th>Category</th>
    <th>Unit</th>
    <th>IN</th>
	<th>OUT</th>
    <th>Rate</th>
	<th>Amount</th>
	<th>Tr Type</th>
	<th>Tr No</th>
	<th>SR No</th>
	<th>Warehouse Name</th>
	<th>Entry At</th>
	<th>User</th>
  </tr>
  <?php 
  
  if($_POST['booking_type']>0) 				$booking_type=$_POST['booking_type'];
	if($_POST['warehouse_id']>0) 				$warehouse_id=$_POST['warehouse_id'];
	if($_POST['item_id']>0) 					$item_con=' and i.item_id="'.$_POST['item_id'].'"';
	if($_POST['receive_status']!='') 			$receive_status=' and a.tr_from="'.$_POST['receive_status'].'"';
	if($_POST['issue_status']!='') 				$issue_status=$_POST['issue_status'];
	if($_POST['item_sub_group']>0) 				$sub_group_id=$_POST['item_sub_group'];
	if($_POST['item_brand']>0) 				    $item_brand=$_POST['item_brand'];
	if($_POST['vendor_id']>0) 				    $vendor_id=$_POST['vendor_id'];
	
	if($_POST['ctg_warehouse']>0) 				$ctg_warehouse=$_POST['ctg_warehouse'];
	if($_POST['garden_id']>0) 				    $garden_id=$_POST['garden_id'];
	
	
  
   $date_con=' and a.ji_date between "'.$_POST['f_date'].'" and "'.$_POST['t_date'].'" ';
  
  
  $s=1;
  $sql='select a.id,a.ji_date,i.item_id,i.finish_goods_code as fg_code,i.item_name,s.sub_group_name as Category,i.unit_name as unit,a.item_in as `IN`,a.item_ex as `OUT`,a.item_price as rate,((a.item_in+a.item_ex)*a.item_price) as amount,a.tr_from as tr_type,a.tr_no,sr_no,(select lc_number from lc_purchase_closing where id=a.tr_no and a.tr_from="Import Purchase") as LC_number,(select warehouse_name from warehouse where warehouse_id=a.warehouse_id) as warehouse,a.tr_no,a.entry_at,c.fname as User 
		   
		   from journal_item a, item_info i, user_activity_management c , item_sub_group s where c.user_id=a.entry_by and s.sub_group_id=i.sub_group_id and
		    a.item_id=i.item_id and a.item_id!=100010001 '.$date_con.$warehouse_con.$item_con.$status_con.$item_sub_con.$receive_status.' order by a.ji_date';
			$query=mysql_query($sql);
			while($row=mysql_fetch_object($query)){
			
			
  
  ?>
  <tr>
    <td><?=$s++;?></td>
    <td><?=$row->ji_date;?></td>
    <td><?=$row->item_id;?></td>
    <td><?=$row->fg_code;?></td>
    <td><?=$row->item_name;?></td>
    <td><?=$row->Category;?></td>
    <td><?=$row->unit;?></td>
    <td><?=$row->IN; $tot_in+=$row->IN;?></td>
    <td><?=$row->OUT; $tot_out+=$row->OUT;?></td>
	<td><? $purchase_rate=find_a_field('purchase_receive','rate','pr_no="'.$row->sr_no.'" and item_id="'.$row->item_id.'"');
	 if($row->tr_type=='Consumption') { echo number_format($row->rate,3); } else { echo number_format($purchase_rate,2);} ?></td>
	<td align="right"><? $purchase_amt=find_a_field('purchase_receive','amount','pr_no="'.$row->sr_no.'" and item_id="'.$row->item_id.'"');
	 if($row->tr_type=='Consumption') { echo number_format($row->amount,2); } else { echo number_format($purchase_amt,2);}
	?></td>
	<td><?=$row->tr_type;?></td>
	<td><?=$row->tr_no;?></td>
	<td><?=$row->sr_no;?></td>
	<td><?=$row->warehouse;?></td>
	<td><?=$row->entry_at;?></td>
	<td><?=$row->User;?></td>
  </tr>
  
  <? } ?>
  <tr>
  <td colspan="7" style="border:none;">Total</td>
  <td style="border:none;"><?=$tot_in?></td>
  <td style="border:none;"><?=$tot_out?></td>
  
  </tr>
</table>

<?
}



		
elseif($_POST['report']==404) 
{

?>
<style>
    
    table th {
    position:sticky;
    top:0;
    z-index:1;
    border-top:1;
    background: #ededed;
}

row{
border:hidden
}
</style>


     <h1 align="center" id="company_name" >যমুনা সীডস্ স্টোরেজ (প্রাঃ) লিঃ </h1>
        <h4>কালুপাড়া, পবা, রাজশাহী</h4>
        <h4>এস আর গ্রহণ টোকেন</h4>
        <h4> ধরণঃ খাওয়ার আলু/বীজ আলু</h4>


<body style="font-family: Poppins, Helvetica, sans-serif, sutonnymj;">
<form action="" method="post">
  
    <?php /*?><tr>
      <td colspan="0" align="center"><hr /></td>
    </tr><?php */?>
<div class="row">
      <table width="100%" border="0" cellspacing="0" cellpadding="3"  style="font-size:12px">
	  
	
          <tr >
            <td><strong>ক্রমিক নং:</strong> </td>
            <td><?=$data->sr_id?>&nbsp;</td>
          </tr>
          <tr>
            <td><strong>নাম:</strong></td>
            <td><?=$data->name?>&nbsp;</td>
          </tr>
          <tr>
            <td><strong>গ্রাম:</strong> </td>
            <td><?=$data->area?>&nbsp;</td>
          </tr>
          <tr>
            <td><strong>বুকিং নং:</strong> </td>
            <td><?=$data->booking_number?>&nbsp;</td>
          </tr>
          <tr>
            <td><strong>এস আর নং:</strong> </td>
            <td><?=$data->sr_number?>&nbsp;</td>
          </tr>
          <tr>
            <td><strong>পরিমাণ:</strong> </td>
            <td><?=$data->quantity?>&nbsp;</td>
          </tr>
		  
		  
        </table>
   </div>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
    <td align="center"><div class="footer1"></div>
      <div class="footer1">
        <table width="100%" border="0">
          <tr>
            <td align="center"><?=$emp->PBI_NAME;?></td>
            <td align="center"><?php echo find_a_field(' hrm_user_access','user_name','emp_id='.$all->checked_by);?></td>
            <td align="center"><?php echo find_a_field(' hrm_user_access','user_name','emp_id='.$all->operation_manager);?></td>
            <td align="center"><?=find_a_field('user_activity_management','fname','user_id='.$all->approve_by)?></td>
            <?php /*?><td><?=find_a_field('user_activity_management','fname','user_id='.$all->checked_by)?></td><?php */?>
            <td align="center"></td>
          </tr>
          <tr>
            <td align="center">Prepared By</td>
            <td align="center">Recommanded By </td>
            <td align="center">Operation Manager</td>
            <td  align="center">Checked By </td>
            <td align="center">Approved By </td>
          </tr>
        </table>
        <tr>
            <td><p align="center"> <strong>বিঃ দ্রঃ</strong> নিজ দায়িত্বে বস্তার নাম্বার করিয়ে নিন। আলুর বস্তার নাম্বার না করার জনা আলু হারিয়ে গেলে কর্তৃপক্ষ দ্বায়ী নহে। </p></td>
          </tr>
      </div></td>
  </tr>
    
    
  </table>
</form>
</body>

<?

}


		
elseif($_POST['report']==405) 
{

?>
<style>
    
    table th {
    position:sticky;
    top:0;
    z-index:1;
    border-top:1;
    background: #ededed;
}
</style>

 <h1 align="center" id="company_name" >যমুনা সীডস্ স্টোরেজ (প্রাঃ) লিঃ </h1>
        <h4>কালুপাড়া, পবা, রাজশাহী</h4>
        <h4>Booking Details Report</h4>
       
<?php echo $str3;?>
<table  cellpadding="0" cellspacing="0" id="ExportTable">
    <thead class="thead1">
      <tr class="bgc-info" >
        <th style="text-align:center">তারিখ</th>
        <th style="text-align:center">এজেন্ট নং</th>
	   <th style="text-align:center">ধরণ</th>
        <th style="text-align:center">বুকিং নং</th>
        <th style="text-align:center">নাম</th>
        <th style="text-align:center">পিতার নাম</th>
        <th style="text-align:center">মোবাইল</th>
        <th style="text-align:center">জেলা</th>
        <th style="text-align:center">থানা</th>
        <th style="text-align:center">পোস্ট</th>
        <th style="text-align:center">গ্রাম</th>
        <th style="text-align:center">বস্তার পরিমাণ</th>
        <th style="text-align:center"> আলুর পরিমাণ(SR)</th>
		<th style="text-align:center">দর প্রতি বস্তা</th>
		<th style="text-align:center">দর প্রতি কেজি</th>
	   <th style="text-align:center">টাকার পরিমাণ</th>
	   <th style="text-align:center">ভেলিভারী আলু</th>
	   <th style="text-align:center">অবশিষ্ট আলুর পরিমাণ</th>
	   <th style="text-align:center">প্রদানকৃত লোন</th>
	   <th style="text-align:center">আদায়কৃত লোন</th>
	   <th style="text-align:center">অবশিষ্ট লোন</th>
	   <th style="text-align:center">গড় লোন</th>
        
      </tr>
    </thead>
    <tbody class="tbody1">
      <?php
				if($_POST['booking_type']!='')
	     $con2=' and a.booking_type="'.$_POST['booking_type'].'"';
		 
		 if($_POST['rec_year']!='')
	     $con=' and b.rec_year="'.$_POST['rec_year'].'"';
		 
		 if($_POST['rec_year']!='')
	     $con5=' and a.booking_year="'.$_POST['rec_year'].'"';
		 
		 if($_POST['booking_number']!='')
	     $con3 .=' and a.booking_number_eng="'.$_POST['booking_number'].'"';
		 
		 
	
	 $bag_loans='select booking_number,sum(amount) as amt from bag_loan where  date between "'.$_POST['f_date'].'" and "'.$_POST['t_date'].'"  group by booking_number ';
				$bag_loan_sql=mysql_query($bag_loans);
			    while($bag_loan=mysql_fetch_object($bag_loan_sql)){
				$bag_loanss[$bag_loan->booking_number]=$bag_loan->amt;
				
				}	
				
		
		  $sr_loans='select booking_number,sum(amount) as amt from sr_loan where  date between "'.$_POST['f_date'].'" and "'.$_POST['t_date'].'"  group by booking_number ';
				$loan_sql=mysql_query($sr_loans);
			    while($loan=mysql_fetch_object($loan_sql)){
				$sr_loan[$loan->booking_number]=$loan->amt;
				
				}	
				
				$sr_bag='select sum(sr_loan) as sr,sum(bag_loan) as bag ,booking_no from sale_do_chalan c,paid_booking p where c.booking_no=p.booking_number_eng and  c.chalan_date between "'.$_POST['f_date'].'" and "'.$_POST['t_date'].'"  group by c.booking_no ';
				$sr_bag_sql=mysql_query($sr_bag);
			    while($sr_bag_loan=mysql_fetch_object($sr_bag_sql)){
				$sr_return[$sr_bag_loan->booking_no]=$sr_bag_loan->sr;
				$bag_return[$sr_bag_loan->booking_no]=$sr_bag_loan->bag;
				
				}	
				
		
		 $sr_loan_ret='select booking_number,sum(total_paid) as amt from sr_loan_return where chalan_no is null and  recdate between "'.$_POST['f_date'].'" and "'.$_POST['t_date'].'"  group by booking_number ';
				$sr_loan_sql=mysql_query($sr_loan_ret);
			    while($sr_loans=mysql_fetch_object($sr_loan_sql)){
				$sr_loan_returns_separately[$sr_loans->booking_number]=$sr_loans->amt;
				
				}	
		
		 
		  $delivery='select sum(j.item_ex) as qt,b.booking_no from sale_do_chalan b,journal_item j,paid_booking a where a.booking_number_eng=b.booking_no and j.tr_from="Sales" and b.chalan_no=j.sr_no and b.sr_no=j.barcode and b.chalan_date between "'.$_POST['f_date'].'" and "'.$_POST['t_date'].'" '.$con5.$con2.$con3.' group by a.booking_number_eng ';
				$deli=mysql_query($delivery);
			    while($del=mysql_fetch_object($deli)){
				$delivery2[$del->booking_no]=$del->qt;
				
				}
		 //find_a_field('warehouse_other_receive r, paid_booking p','sum(r.qty)','r.booking_number=p.booking_number_eng and p.booking_type="Paid Booking" and r.or_date between "'.$f_date.'" and "'.$t_date.'"');
		 
				 $td='select a.*,SUM(b.qty) as qts,b.booking_number from paid_booking a,warehouse_other_receive b where a.booking_number_eng=b.booking_number and b.or_date between "'.$_POST['f_date'].'" and "'.$_POST['t_date'].'" '.$con.$con2.$con3.' GROUP BY 
        b.booking_number
    ORDER BY 
        a.agent_id ASC ';
				$report=mysql_query($td);
			    while($data=mysql_fetch_object($report)){
						?>
      <tr>
        <td><?=$data->booking_date;?></td>
        <td><?=$data->agent_id;?></td>
	    <td><?=$data->booking_type;?></td>
        <td><?=$data->booking_number_eng;?></td>
        <td><?=$data->name;?></td>
        <td><?=$data->father_name;?></td>
        <td><?=$data->mobile_no;?></td>
        <td><?=$data->district;?></td>
        <td><?=$data->thana;?></td>
        <td><?=$data->post;?></td>
        <td><?=$data->village;?></td>
		 <td><?=$tqty=$data->bag_quantity; $totb+=$data->bag_quantity;?></td>
		 <td><?=$data->qts; $totc+=$data->qts;?></td>
		 <td><?=$data->booking_rate; ?></td>
		<td><?=$data->per_kg_price; ?></td>
         <td><?=$data->total_amount; $totd+=$data->total_amount;?></td>
		 <td><?=$tot_del=find_a_field(
    'sale_do_master m, sale_do_chalan s, item_info i, paid_booking p',
    'SUM(s.total_unit)',
    'm.do_no = s.do_no 
     AND m.booking_no = p.booking_number_eng  
     AND i.item_id = s.item_id 
     AND s.chalan_date BETWEEN "'.$_POST['f_date'].'" AND "'.$_POST['t_date'].'" 
     AND s.item_id = 100010001  
     AND p.booking_type = "'.$data->booking_type.'" and p.booking_number_eng= "'.$data->booking_number_eng.'"
     AND s.approved_status = "Third App" '
);  $tot_deliver+=$tot_del;  //$delivery2[$data->booking_number] ; $tot_delivery+=$delivery2[$data->booking_number] ;?></td>
         <td><?=$due=($data->qts-$tot_del) ; $tot_due+=$due ;?></td>
       <td><?=$loan=($sr_loan[$data->booking_number_eng]+$bag_loanss[$data->booking_number_eng]); $total_loan+=$loan; ?></td>
				<td><?=$return_loan=($sr_return[$data->booking_number_eng]+$bag_return[$data->booking_number_eng]+$sr_loan_returns_separately[$data->booking_number_eng]); $tot_return+=$return_loan; ?></th>
				<td><?=$due_loan=($loan-$return_loan); $total_due+=$due_loan; ?></td>
				<td><?=number_format($due_loan/$due,2); ?></td>
      </tr>
   
      <?php }?>
	  	<tr>
		    
		    	<th colspan="11" style="text-align:center">Total</th>
		    	<th> <?=$totb ?></th>	
				<th> <?=$totc ?></th>
				<th>&nbsp; </th>
			    <th>&nbsp; </th>
				<th> <?=$totd ?></th>
				<th> <?=$tot_deliver ?></th>
				<th> <?=$tot_due ?></th>
				<th><?=$total_loan ?></th>
				<th><?=$tot_return ?></th>
				<th><?=$total_due ?></th>
				<th><?=number_format($total_due/$tot_due,2);?></th>
		</tr>
	  
    </tbody>
  </table>

<?

}












elseif($_POST['report']==4005) 
{

?>
<!DOCTYPE html>
<html lang="bn">
<head>
  <meta charset="UTF-8">
  <title>বুকিং বিবরণী</title>
  <style>
    body {
      font-family: "Noto Sans Bengali", Arial, sans-serif;
      background: #fff;
      margin: 20px;
    }
    .container {
      width: 800px;
      margin: auto;
      border: 1px solid #000;
      padding: 20px;
    }
    .header {
      text-align: center;
    }
    .header h2 {
      margin: 0;
      color: green;
    }
    .header h3 {
      margin: 5px 0;
      color: orange;
    }
    .header h4 {
      margin: 5px 0;
    }
	.info-section {
	  width: 100%;
	  display: flex;              /* make it flex */
	  justify-content: space-between;
	  align-items: flex-start;
	  gap: 20px;
	}
	.info {
	  margin: 15px 0;
	  text-align: left;
	  width: 48%;                 /* left column */
	}
	.info-right {
	  margin: 15px 0;
	  text-align: left;
	  width: 48%;                 /* right column */
	}
	.info div, .info-right div {
	  margin-bottom: 5px;
	}

    .box {
      border: 1px solid #000;
      padding: 10px;
      text-align: center;
      font-weight: bold;
    }
    .flex {
      display: flex;
      justify-content: space-between;
      gap: 10px;
      margin: 10px 0;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }
    table, th, td {
      border: 1px solid #000;
    }
    th, td {
      padding: 5px;
      text-align: center;
    }
    .section-title {
      text-align: center;
      font-weight: bold;
      margin-top: 15px;
      margin-bottom: 5px;
      background: #f0f0f0;
      padding: 3px;
    }
    .footer {
      margin-top: 20px;
      font-size: 14px;
    }
  </style>
</head>
<body>
  <div class="container">
  <?
$group=find_all_field('user_group','','1');
$booking=find_all_field('paid_booking','','booking_number_eng="'.$_POST['booking_number'].'"');
$f_date=$_POST['f_date'];
$t_date=$_POST['t_date'];

?>
    <div class="header">
      <h2><?=$group->group_name?></h2>
      <h3><?=$group->address?></h3>
      <h4>বুকিং বিবরণী / <?=$booking->booking_year?></h4>
    </div>
	
	<div class="info-section">
    <div class="info">
      <div>তারিখ: <b><?=$f_date?> হতে <?=$f_date?></b></div>
      <div>বুকিং নং: <b><?=$booking->booking_number_eng?></b></div>
      <div>সংরক্ষন চুক্তি: <b></b></div>
      <div>নাম: <?=$booking->name?> </div>
      <div>পিতার নাম: <?=$booking->father_name?></div>
      
  </div>

  <div class="info-right">
      <!--<div style="font-weight:bold;">
        ঠিকানা:  </div>--> <div> গ্রাম- <?=$booking->village?>, </div>
      <div>  ডাকঘর- <?=$booking->post?>, </div>
      <div>  উপজেলা- <?=$booking->thana?>, </div>
      <div>  জেলা- <?=$booking->district?>, </div>
      <div>  মোবাইল নং: <?=$booking->mobile_no?>
      </div>
  </div>
	</div>
    <div class="flex">
      <div class="box">বুকিং টাইপ<br><?=$booking->booking_type?></div>
      <div class="box"> মোট গ্রহণকৃত আলু<br><? $rec=find_a_field('warehouse_other_receive r, paid_booking p','sum(r.qty)',' r.booking_number=p.booking_number_eng and r.booking_number="'.$_POST['booking_number'].'" and r.or_date between "'.$f_date.'" and "'.$t_date.'" '); echo number_format($rec,0);?></div>
      <div class="box">মোট ডিওকৃত আলু<br><? $del=find_a_field('sale_do_chalan c, journal_item i','sum(i.item_ex)','i.tr_from="Sales" and c.chalan_no=i.sr_no and c.sr_no=i.barcode and c.booking_no="'.$_POST['booking_number'].'" and c.chalan_date between "'.$f_date.'" and "'.$t_date.'"'); echo number_format($del,0);?></div>
      <div class="box">মোট আলুর স্থীতি<br><? $due=$rec-$del; echo number_format($due,0);?></div>
    </div>

    <div class="section-title">প্রদানকৃত লোন বিবরণ</div>
    <table>
      <tr>
        <th>অনাদায়ি লোন</th>
        <th>বীজ লোন</th>
        <th>চাষী লোন</th>
        <th>খালি বস্তা লোন</th>
        <th>এস.আর লোন</th>
        <th>সটিং চার্জ</th>
        <th>সর্বমোট</th>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <?php
list($year, $month, $day) = explode("-", $f_date);

$bag_loan = find_a_field(
    'bag_loan b, paid_booking p',
    'sum(b.amount)',
    'b.booking_number = p.booking_number_eng 
     and p.booking_year = "'.$year.'" 
     and b.booking_number = "'.$_POST['booking_number'].'"
     and b.date between "'.$f_date.'" and "'.$t_date.'"'
);

$sr_loan = find_a_field(
    'sr_loan s, paid_booking p',
    'sum(s.amount)',
    's.booking_number = p.booking_number_eng 
     and p.booking_year = "'.$year.'" 
     and s.booking_number = "'.$_POST['booking_number'].'"
     and s.date between "'.$f_date.'" and "'.$t_date.'"'
);
?>

<td><?=$bag_loan?></td>
<td><?=$sr_loan?></td>

        
        
        <td></td>
        <td><?=$total_assign=$bag_loan+$sr_loan?></td>
      </tr>
    </table>

    <div class="section-title">আদায়কৃত লোন বিবরণ</div>
    <table>
      <tr>
        <th>অনাদায়ি লোন</th>
        <th>বীজ লোন</th>
        <th>চাষী লোন</th>
        <th>খালি বস্তা লোন</th>
        <th>এস.আর লোন</th>
        <th>সটিং চার্জ</th>
        <th>সর্বমোট</th>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><?=$paid_bag_loan=find_a_field('sale_do_chalan','sum(bag_loan)','booking_no="'.$_POST['booking_number'].'" and chalan_date between "'.$f_date.'" and "'.$t_date.'"');?></td>
        <td><?
        
list($year, $month, $day) = explode("-", $f_date);

$paid_sr_loan_separately = find_a_field(
    'sr_loan_return r, paid_booking p',
    'sum(r.total_paid)',
    'r.booking_number = p.booking_number_eng 
     and p.booking_year = "'.$year.'" 
     and r.booking_number = "'.$_POST['booking_number'].'"
     and r.chalan_no is null 
     and r.recdate between "'.$f_date.'" and "'.$t_date.'"'
);


    $paid_sr_load2=find_a_field('sale_do_chalan','sum(sr_loan)','booking_no="'.$_POST['booking_number'].'" and chalan_date between "'.$f_date.'" and "'.$t_date.'"');  
    echo
    $paid_sr_loan=$paid_sr_load2+$paid_sr_loan_separately;
    ?>
    </td>
        <td></td>
        <td><?=$totalPaid=$paid_bag_loan+$paid_sr_loan ?> </td>
      </tr>
    </table>

    <div class="section-title">লোন স্থীতি</div>
    <table>
      <tr>
        <th>অনাদায়ি লোন</th>
        <th>বীজ লোন</th>
        <th>চাষী লোন</th>
        <th>খালি বস্তা লোন</th>
        <th>এস.আর লোন</th>
        <th>সটিং চার্জ</th>
        <th>সর্বমোট</th>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><?=$bag_loan_due=$bag_loan-$paid_bag_loan?></td>
        <td><?=$sr_loan_due=$sr_loan-$paid_sr_loan?></td>
        <td></td>
        <td><?=$tatal_due_loan=$bag_loan_due+$sr_loan_due?></td>
      </tr>
    </table>

    <div class="section-title">সম্ভব্য আয় বিবরণ</div>
    <table>
      <tr>
        <th>স্টোর ভাড়া </th>
        <th>লেবার চার্জ</th>
        <th>চাষী লোনের লাভ</th>
        <th>এস.আর লোনের লাভ</th>
        <th>সটিং চার্জ</th>
        <th>বিবিধ আয়</th>
        <th>সর্বমোট</th>
      </tr>
      <tr>
        <td><? if($booking->booking_type=='Paid Booking') { echo "0"; } else { echo $store_rent=$due*65*6; }?></td>
        <td><? if($booking->booking_type=='Paid Booking') { echo $labour=$due*65*0.5; } else { echo $labour=find_a_field('sale_do_chalan','sum(labour_charge)','booking_no="'.$_POST['booking_number'].'" and chalan_date between "'.$f_date.'" and "'.$t_date.'"'); } ?></td>
        <td></td>
        <td><?=$interest=find_a_field('sale_do_chalan','sum(total_interest)','sr_loan>0 and booking_no="'.$_POST['booking_number'].'" and chalan_date between "'.$f_date.'" and "'.$t_date.'"');?></td>
        <td></td>
		<td></td>
        <td><?=$total_interest=$store_rent+$labour+$interest;?></td>
      </tr>
    </table>
	
	<div class="flex">
      <div class="box">লোন গড় : <?=number_format(($tatal_due_loan/$due),2)  ?></div>
      
    </div>
    <div class="footer">
      মতামত / বিশেষ মন্তব্যঃ ..................................................
    </div>

  </div>
</body>
</html>



<?
}

elseif($_POST['report']==40005)
{
?>
<!DOCTYPE html>
<html lang="bn">
<head>
  <meta charset="UTF-8">
  <title>বুকিং বিবরণী</title>
  <style>
    body {
      font-family: "Noto Sans Bengali", Arial, sans-serif;
      background: #fff;
      margin: 20px;
    }
    .container {
      width: 800px;
      margin: auto;
      border: 1px solid #000;
      padding: 20px;
    }
    .header {
      text-align: center;
    }
    .header h2 {
      margin: 0;
      color: green;
    }
    .header h3 {
      margin: 5px 0;
      color: orange;
    }
    .header h4 {
      margin: 5px 0;
    }
	
	

    
.flex {
  display: flex;
  justify-content: space-between; /* spaces evenly */
  align-items: stretch;            /* make all boxes equal height */
  gap: 10px;                       /* space between boxes */
  margin: 10px 0;
}

.box {
  flex: 1;                         /* take equal width */
  border: 1px solid #000;
  padding: 10px;
  text-align: center;
  font-weight: bold;
  background: #fafafa;             /* optional for better look */
  box-sizing: border-box;          /* ensure padding stays inside width */
}



    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }
    table, th, td {
      border: 1px solid #000;
    }
    th, td {
      padding: 5px;
      text-align: center;
	 
    }
	
    .section-title {
      text-align: center;
      font-weight: bold;
      margin-top: 15px;
      margin-bottom: 5px;
      background: #f0f0f0;
      padding: 3px;
    }
    .footer {
      margin-top: 20px;
      font-size: 14px;
    }
	.highlight-total {
  font-size: 20px !important;
  font-weight: bold !important;
}
  </style>
</head>
<body>
  <div class="container">
  <?
$group=find_all_field('user_group','','1');
//$booking=find_all_field('paid_booking','','booking_number_eng="'.$_POST['booking_number'].'"');
$f_date=$_POST['f_date'];
$t_date=$_POST['t_date'];

?>
    <div class="header pb-3">
      <h2><?=$group->group_name?></h2>
      <h3><?=$group->address?></h3>
      <h4>অফিসিয়াল তথ্য বিবরণী</h4>
	  <h4>তারিখ <?=$f_date?> হতে <?=$t_date?></h4>
    </div>
	<br />
	<table>
  <tr>
    <th>বুকিং টাইপ</th>
    <th>মোট গ্রহণকৃত আলু</th>
    <th>মোট ডেলিভারি আলু</th>
    <th>মোট স্থিতি</th>
  </tr>
  <tr>
    <td>Paid Booking</td>
    <td><?=$paid_rec=find_a_field('warehouse_other_receive r, paid_booking p','sum(r.qty)','r.booking_number=p.booking_number_eng and p.booking_type="Paid Booking" and r.or_date between "'.$f_date.'" and "'.$t_date.'"');?></td>
    <td><?=$paid_del = find_a_field(
    'sale_do_master m, sale_do_chalan s, item_info i, paid_booking p',
    'SUM(s.total_unit)',
    'm.do_no = s.do_no 
     AND m.booking_no = p.booking_number_eng  
     AND i.item_id = s.item_id 
     AND s.chalan_date BETWEEN "'.$f_date.'" AND "'.$t_date.'" 
     AND s.item_id = 100010001  
     AND p.booking_type = "Paid Booking" 
     AND s.approved_status = "Third App" '
);
?></td>
    <td><?=$paid_due=$paid_rec-$paid_del?></td>
  </tr>
  <tr>
    <td>Normal Booking</td>
    <td><?=$normal_rec=find_a_field('warehouse_other_receive r, paid_booking p','sum(r.qty)','r.booking_number=p.booking_number_eng and p.booking_type="Normal Booking" and r.or_date between "'.$f_date.'" and "'.$t_date.'"');?></td>
    <td><?=$normal_del=find_a_field(
    'sale_do_master m, sale_do_chalan s, item_info i, paid_booking p',
    'SUM(s.total_unit)',
    'm.do_no = s.do_no 
     AND m.booking_no = p.booking_number_eng  
     AND i.item_id = s.item_id 
     AND s.chalan_date BETWEEN "'.$f_date.'" AND "'.$t_date.'" 
     AND s.item_id = 100010001  
     AND p.booking_type = "Normal Booking" 
     AND s.approved_status = "Third App" '
);?></td>
    <td><?=$normal_due=$normal_rec-$normal_del?></td>
  </tr>
  <tr>
    <td>Contract Booking</td>
    <td><?=$contract_rec=find_a_field('warehouse_other_receive r, paid_booking p','sum(r.qty)','r.booking_number=p.booking_number_eng and p.booking_type="Contract Booking" and r.or_date between "'.$f_date.'" and "'.$t_date.'"');?></td>
    <td><?=$contract_del=find_a_field(
    'sale_do_master m, sale_do_chalan s, item_info i, paid_booking p',
    'SUM(s.total_unit)',
    'm.do_no = s.do_no 
     AND m.booking_no = p.booking_number_eng  
     AND i.item_id = s.item_id 
     AND s.chalan_date BETWEEN "'.$f_date.'" AND "'.$t_date.'" 
     AND s.item_id = 100010001  
     AND p.booking_type = "Contract Booking" 
     AND s.approved_status = "Third App" '
);?></td>
    <td><?=$contact_due=$contract_rec-$contract_del?></td>
  </tr>
  <tr>
    <td>Total Potato</td>
    <td><?=$paid_rec+$normal_rec+$contract_rec?></td>
    <td><?=$paid_del+$normal_del+$contract_del?></td>
    <td><?=$due=$paid_due+$normal_due+$contract_due?></td>
  </tr>
</table>

	
    

    <div class="section-title">প্রদানকৃত লোন বিবরণ</div>
    <table>
      <tr>
        <th>অনাদায়ি লোন</th>
        <th>বীজ লোন</th>
        <th>চাষী লোন</th>
        <th>খালি বস্তা লোন</th>
        <th>এস.আর লোন</th>
        <th>সটিং চার্জ</th>
        <th>সর্বমোট</th>
      </tr>
      <tr>
        <td></td>

        <td></td>
        <td></td>
        <td><?
        list($year, $month, $day) = explode("-", $f_date);
   echo $bag_loan=find_a_field('bag_loan b,paid_booking p','sum(b.amount)','b.booking_number=p.booking_number_eng and p.booking_year="'.$year.'" and  b.date between "'.$f_date.'" and "'.$t_date.'" ');?></td>
        <td><?=$sr_loan=find_a_field('sr_loan s,paid_booking p','sum(s.amount)','s.booking_number=p.booking_number_eng and p.booking_year="'.$year.'" and  s.date between "'.$f_date.'" and "'.$t_date.'" ');?></td>
        <td></td>
        <td><?=$total_assign=$bag_loan+$sr_loan?></td>
      </tr>
    </table>

    <div class="section-title">আদায়কৃত লোন বিবরণ</div>
    <table>
      <tr>
        <th>অনাদায়ি লোন</th>
        <th>বীজ লোন</th>
        <th>চাষী লোন</th>
        <th>খালি বস্তা লোন</th>
        <th>এস.আর লোন</th>
        <th>সটিং চার্জ</th>
        <th>সর্বমোট</th>
      </tr>
	  
	<?  
//$sr_loan_ret='select booking_number,sum(total_paid) as amt from sr_loan_return where chalan_no is null and  recdate between "'.$f_date.'" and "'.$t_date.'"  group by booking_number ';
// 				$sr_loan_sql=mysql_query($sr_loan_ret);
// 			    while($sr_loans=mysql_fetch_object($sr_loan_sql)){
// 				$sr_loan_returns_separately[$sr_loans->booking_number]=$sr_loans->amt;
				
// 				}	
		?>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><?=$paid_bag_loan=find_a_field('sale_do_chalan','sum(bag_loan)','chalan_date between "'.$f_date.'" and "'.$t_date.'"');?></td>
        <td><? 
        
        list($year, $month, $day) = explode("-", $f_date);



		 $paid_sr_loan_separately=find_a_field('sr_loan_return r,paid_booking p','sum(r.total_paid)','r.booking_number=p.booking_number_eng and p.booking_year="'.$year.'" and r.chalan_no is null and  r.recdate between "'.$f_date.'" and "'.$t_date.'"'); 
		        $paid_sr_ln=find_a_field('sale_do_chalan','sum(sr_loan)','chalan_date between "'.$f_date.'" and "'.$t_date.'"');
				
				echo $paid_sr_loan=$paid_sr_loan_separately+$paid_sr_ln; ?></td>
        <td></td>
        <td><?=$totalPaid=$paid_bag_loan+$paid_sr_ln+$paid_sr_loan_separately?></td>
      </tr>
    </table>

    <div class="section-title">লোন স্থীতি</div>
    <table>
      <tr>
        <th>অনাদায়ি লোন</th>
        <th>বীজ লোন</th>
        <th>চাষী লোন</th>
        <th>খালি বস্তা লোন</th>
        <th>এস.আর লোন</th>
        <th>সটিং চার্জ</th>
        <th>সর্বমোট</th>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><?=$bag_loan_due=$bag_loan-$paid_bag_loan?></td>
        <td><?=$sr_loan_due=$sr_loan-$paid_sr_loan?></td>
        <td></td>
        <td><?=$tatal_due_loan=$bag_loan_due+$sr_loan_due?></td>
      </tr>
    </table>
	<div class="section-title">Actual আয় বিবরণী</div>
    <table>
      <tr>
        <th>স্টোর ভাড়া </th>
        <th>লেবার চার্জ</th>
        <th colspan="2">লোনের লাভ</th>
        
        <th>সটিং চার্জ</th>
        <th>বিবিধ আয়</th>
        <th>সর্বমোট</th>
      </tr>
      <tr>
        <td><?  $tot_unit=find_a_field(
    'sale_do_chalan s, paid_booking p',
    'SUM(s.challan_in_kg)',
    ' s.booking_no = p.booking_number_eng  
	 AND p.booking_type="Normal Booking"
     
     AND s.chalan_date BETWEEN "'.$f_date.'" AND "'.$t_date.'" 
     
      '
);
echo round($store_rent=$tot_unit*6,0);
// echo $store_rent=find_a_field('sale_do_chalan','sum(store_rent)','chalan_date between "'.$f_date.'" and "'.$t_date.'"'); ?></td>
        <td><?  echo $labour=find_a_field('sale_do_chalan','sum(labour_charge)','chalan_date between "'.$f_date.'" and "'.$t_date.'"');  ?></td>
        <?
		list($year, $month, $day) = explode("-", $f_date);
		 $paid_sr_loan_interest_separately=find_a_field('sr_loan_return r,paid_booking p','sum(r.interest_amt)','r.booking_number=p.booking_number_eng and p.booking_year="'.$year.'" and r.chalan_no is null and  r.recdate between "'.$f_date.'" and "'.$t_date.'"');  ?>
        <td colspan="2"><? $interest_sr=find_a_field('sale_do_chalan','sum(total_interest)','sr_loan>0  and chalan_date between "'.$f_date.'" and "'.$t_date.'"'); 
		echo $total_interest= $paid_sr_loan_interest_separately+$interest_sr; ?></td>
        <td></td>
		<td></td>
        <td><?=$total_interest=$store_rent+$labour+$total_interest;?></td>
      </tr>
    </table>

    <div class="section-title">সম্ভব্য আয় বিবরণ</div>
    <table>
      <tr>
        <th>স্টোর ভাড়া </th>
        <th>লেবার চার্জ</th>
        <th>চাষী লোনের লাভ</th>
        <th>এস.আর লোনের লাভ</th>
        <th>সটিং চার্জ</th>
        <th>বিবিধ আয়</th>
        <th>সর্বমোট</th>
      </tr>
      <tr>
        <td><? echo $store_rent=$normal_due*65*6; ?></td>
        <td><?  echo $labour=$paid_due*65*0.5;  ?></td>
        <td></td>
        <td><?=$interest=find_a_field('sale_do_chalan','sum(total_interest)','sr_loan>0  and chalan_date between "'.$f_date.'" and "'.$t_date.'"');?></td>
        <td></td>
		<td></td>
        <td><?=$total_interest=$store_rent+$labour+$interest;?></td>
      </tr>
    </table>
	
	<div class="flex">
      <div class="box">লোন গড় : <?=number_format(($tatal_due_loan/$due),2)  ?></div>
      
    </div>
    <div class="footer">
      মতামত / বিশেষ মন্তব্যঃ ..................................................
    </div>

  </div>
</body>
</html>
<?
}

elseif($_POST['report']==444) 
{
$warehouse_id = $_REQUEST['warehouse'];
if(isset($warehouse_id)) 			{$warehouse_con=' and a.warehouse_id='.$warehouse_id;}
if(isset($item_id)) 				{$item_cons=' and i.item_id='.$item_id;}
if($_SESSION['user']['depot']==5)
  $sql='select distinct i.item_id, i.unit_name,i.item_name,s.sub_group_name,i.finish_goods_code,i.pack_size, i.cost_price as item_price
		   from item_info i, item_sub_group s where i.product_nature = "Salable" '.$item_cons.' and 
		   i.sub_group_id=s.sub_group_id'.$item_sub_con.' order by i.finish_goods_code,s.sub_group_name,i.item_name';
else
 $sql='select distinct i.item_id,i.unit_name,i.item_name,s.sub_group_name,i.finish_goods_code,i.pack_size,i.cost_price as item_price
		   from item_info i, item_sub_group s where i.product_nature = "Salable" '.$item_cons.' and 
		   i.sub_group_id=s.sub_group_id'.$item_sub_con.' order by i.finish_goods_code,s.sub_group_name,i.item_name';
		$query =mysql_query($sql); 
		if($_SESSION['user']['level']==4 or $_SESSION['user']['level']==5){  
		$warehouse_name = find_a_field('warehouse','warehouse_name','warehouse_id='.$warehouse_id);
		}else{
		$warehouse_name = find_a_field('warehouse','warehouse_name','warehouse_id='.$_SESSION['user']['depot']);
		}
?>

<table width="100%" height="244" border="0" cellpadding="2" cellspacing="0" id="ExportTable">
  <thead><tr><td style="border:0px;" colspan="12"><div class="header">
<h1> <?
if($_SESSION['user']['group']>1)
echo find_a_field('user_group','group_name',"id=".$_SESSION['user']['group']);
else
echo $_SESSION['proj_name'];
?></h1>
<h2><?=$report?></h2>
<h1><? if($warehouse_id>0) echo 'Depot: '.find_a_field('warehouse','warehouse_name','warehouse_id='.$warehouse_id)?></h1>

<h2>Date Interval: <b><?=date("d-m-Y",strtotime($fr_date))?></b> <strong>to</strong> <b><?=date("d-m-Y",strtotime($to_date))?></b></h2></div><div class="left"></div><div class="right"></div><div class="date">Reporting Time: <?=date("h:i A d-m-Y")?></div></td></tr><tr>
<th width="2%" rowspan="2">S/L</th>
<th width="6%" rowspan="2">FG Code </th>
<th width="14%" rowspan="2">Item Name</th>
<th width="9%" rowspan="2">Unit Name </th>
<th colspan="2"><div align="center">Stock Out Calculation </div></th>
<th colspan="4"><div align="center">Stock Movement Calculation </div></th>
<th width="9%" rowspan="2">Stock Days</th>
</tr>
<tr>
  <th width="9%">Stock Out </th>
  <th width="12%">Average </th>
  <th width="11%" bgcolor="#66CCFF">Opening</th>
  <th width="9%" bgcolor="#CCFFFF">Stock In </th>
  <th width="9%" bgcolor="#FFCCFF">Stock Out </th>
  <th width="10%" bgcolor="#CCCCFF">Closing</th>
</tr>

</thead><tbody>
<?

//sum((a.item_in-a.item_ex)*a.unit_price)
while($data=mysql_fetch_object($query)){





$pre='select sum(item_in-item_ex) as pre_stock
from journal_item a where ji_date<"'.$_POST['f_date'].'" and  a.item_id="'.$data->item_id.'" '.$item_con.$status_con.' and a.warehouse_id="'.$warehouse_id.'" ';

$q_pre = mysql_query($pre);
$data_pre=mysql_fetch_object($q_pre);

$pre_stock = $data_pre->pre_stock;


  $s='select sum(a.item_in-a.item_ex) as final_stock , item_price
from journal_item a where  a.item_id="'.$data->item_id.'" '.$date_con.$item_con.$status_con.' and a.warehouse_id="'.$warehouse_id.'" ';

$q = mysql_query($s);
$i=mysql_fetch_object($q);

$t_stock = $i->final_stock+$ip->final_stock;



if(isset($t_date)) 
		{$to_date=$t_date; $fr_date=$f_date; $sl_date_con=' and a.ji_date BETWEEN  "'.$fr_date.'" and "'.$to_date.'"';}

   $st_sql='select sum(item_in) as stock_in,  sum(item_ex) as stock_out 
from journal_item a, warehouse w where w.warehouse_id=a.warehouse_id and a.item_id="'.$data->item_id.'" '.$sl_date_con.$item_con.$status_con.' and w.warehouse_id="'.$warehouse_id.'" ';


$st_query = mysql_query($st_sql);
$st_data=mysql_fetch_object($st_query);

$count_date = find_a_field('journal_item','count( DISTINCT `ji_date`)','ji_date BETWEEN "'.$_POST['f_date'].'" and   "'.$_POST['t_date'].'" ');

$stock_in = $st_data->stock_in;

$stock_out = $st_data->stock_out;

$average_stock_out = $stock_out/$count_date;

$stock_days = $t_stock/$average_stock_out;

$j++;

		   ?>
<tr>
<td><?=$j?></td>
<td><?=$data->finish_goods_code?></td>
<td><?=$data->item_name?></td>
<td><?=$data->unit_name?></td>
<td><?=number_format($stock_out,2);?></td>
<td><?=number_format($average_stock_out,2);?></td>
<td bgcolor="#66CCFF" style="text-align:right; background-color:#66CCFF;"><?=number_format($pre_stock,2)?></td>
<td style="text-align:right; background-color:#CCFFFF;"><?=number_format($stock_in,2)?></td>
<td style="text-align:right;background-color:#FFCCFF;"><?=number_format($stock_out,2);?></td>
<td bgcolor="#CCCCFF" style="text-align:right;background-color:#CCCCFF;"><?=number_format(($i->final_stock),2)?></td>
<td style="text-align:right"><?=number_format($stock_days,2)?></td>
</tr>
<?
$tot_stock_out +=$stock_out;
$tot_pre_stock +=$pre_stock;
$tot_stock_in += $stock_in;
$tot_final_stock +=$i->final_stock;
}
?>
<tr>
<td></td>
<td></td>
<td></td>
<td><strong>Total : </strong></td>
<td><span style="text-align:right; font-weight:700;">
  <?= number_format($tot_stock_out,2)?>
</span></td>
<td></td>
<td bgcolor="#66CCFF" ><span style="text-align:right; font-weight:700;">
  <?= number_format($tot_pre_stock,2)?>
</span></td>
<td style="text-align:right; background-color:#CCFFFF;">
<span style="text-align:right; font-weight:700;">
  <?= number_format($tot_stock_in,2)?>
</span></td>
<td style="text-align:right; background-color:#FFCCFF;">

<span style="text-align:right; font-weight:700;">
  <?= number_format($tot_stock_out,2)?>
</span></td>
<td bgcolor="#CCCCFF" style="text-align:right; background-color:#CCCCFF;">
<span style="text-align:right; font-weight:700;">
<?= number_format($tot_final_stock,2)?></span></td>
<td style="text-align:right"></td>
</tr></tbody></table>
<?
}



elseif($_POST['report']==304)

{

$report="Material Requisition Report";

?>

	<table width="100%" border="0" cellpadding="2" cellspacing="0" id="ExportTable">

		

		<thead>

		<tr><td colspan="24" style="border:0px;">

		<?

		echo $str;

		?>

		</td></tr>
<tbody>



	<tr>

		<th><div align="left">S/L</div></th>

		<th><div align="left">MR No</div></th>
		<th><div align="left">MR Date</div></th>
		<th><div align="left">Warehouse Name</div></th>
		<th><div align="left">Sub Group Name</div></th>
		<th><div align="left">Item Name</div></th>
		<th><div align="left">Total Quantity</div></th>
		<th><div align="left">Entry By </div></th>
		<th><div align="left">Entry At</div></th>
		
	</tr>

    <div align="left">
      <? 





if($_POST['f_date']!=''&&$_POST['t_date']!='')

$con .= ' and a.req_date between "'.$_POST['f_date'].'" and "'.$_POST['t_date'].'"';

if($_POST['warehouse_id']>0)

$con .= ' and a.warehouse_id="'.$_POST['warehouse_id'].'"';

if(isset($item_id)) 	{$item_con=' and i.item_id='.$item_id;}
if(isset($sub_group_id)){$sub_group_con=' and i.sub_group_id='.$sub_group_id;}

if(isset($ctg_warehouse)) 	{$ctg_warehouse_con=' and b.shed_id='.$ctg_warehouse;}

if(isset($garden_id)) 	{$garden_id_con=' and b.garden_id='.$garden_id;}



  $res='select a.req_no as req_no, a.req_date, a.entry_by, a.entry_at, b.qty as qty, i.item_name as item_name,a.warehouse_id,b.item_id,i.sub_group_id,g.sub_group_name,g.sub_group_id from requisition_master a, requisition_order b, item_info i,item_sub_group g where a.req_no=b.req_no and i.item_id=b.item_id and i.sub_group_id=g.sub_group_id '.$con.$item_con.$sub_group_con.' order by a.req_no';



$query = mysql_query($res);

while($data=mysql_fetch_object($query))

{


$j++;


?>
      
      
      

    <tr>

      <td valign="top"><?=$j?></td>

	  <td valign="top"><div align="left">
	    <?=$data->req_no;?>
      </div></td>
	  
	  
	  <td valign="top"><div align="left">
	    <?=date("d-m-Y",strtotime($data->req_date));?>
      </div></td>
	   <td valign="top"><div align="left"><?php  echo find_a_field('warehouse','warehouse_name','warehouse_id='.$data->warehouse_id);?></div></td>
	  	   <td valign="top"><div align="left"> <?php 
	    
	  echo $data->sub_group_name;?></div></td>
	  	  <td valign="top"><div align="left"><?=$data->item_name;?></div></td>
	
	 <td><div align="left"><?=$data->qty;?></div></td>
	  
	  
	  
	  <td valign="top"><div align="left">
	   <?= find_a_field('user_activity_management','username','user_id='.$data->entry_by); ?>
      </div></td>
	  <td valign="top"><div align="left">
	    <?=$data->entry_at;?>
      </div></td>
	  
	  <?php /*?><td valign="top"><div align="left">
	    <?=$data->lot_no;?>
      </div></td>

	  <td valign="top"><div align="left">
	    <?=$data->garden_name;?>
      </div></td>
	  <td valign="top"><div align="left">
	    <?=$data->inv_no;?>
      </div></td>
	  <td><div align="left">
	    <?=$data->item_grade;?>
      </div></td>
	  <td><div align="left">
	    <?=$data->mark;?>
      </div></td>
	  <td><div align="left">
	    <?=$data->pkgs; $tot_pkgs+=$data->pkgs;?>
      </div></td>
	  <td><div align="left">
	    <?=number_format(($data->qty-$data->pending_kgs),3); $tot_pending_kg+=($data->qty-$data->pending_kgs);?>
      </div></td>
	  <td><div align="left">
	    <?=$data->rate;?>
      </div></td>
	  <td><div align="left">
	    <?=$data->amount; $tot_amount+=$data->amount;?>
      </div></td><?php */?>
	</tr>

          <? 
		  
		  $total=$total+$data->qty;
		  }?>
      
    </div>
    <tr>

	 
	  <td valign="top" style="border:none; font-weight:bold; text-align:right;" colspan="6">Total Quantity</td>
	  <td valign="top" style="border:none; font-weight:bold;"><?php echo $total; ?></td>
	  <td valign="top" style="border:none;">&nbsp;</td>
	  <td valign="top" style="border:none;">&nbsp;</td>
	  </tr>
	  
	 <?php /*?> <tr>
	  <td valign="top"><div align="left"><strong>Total:</strong></div></td>
	  <td valign="top">&nbsp;</td>
	  <td valign="top">&nbsp;</td>
	  <td valign="top">&nbsp;</td>
	  <td valign="top"><div align="left"><span class="style2">
	    <?=number_format(($tot_pkgs),2);?>
      </span></div></td>
	  <td valign="top"><div align="left"><span class="style1">
	    <?=number_format(($tot_pending_kg),3);?>
      </span></div></td>
	  <td valign="top">&nbsp;</td>
	  <td>

	    <div align="left"><span class="style3">
	      <?=number_format(($tot_amount),2);?>
        </span></div></td>
	</tr><?php */?>
</tbody></table>

<?

}









/*purchase unreceive report*/

elseif($_POST['report']==11)

{

$report="Chittagong Warehouse Stock (Black Tea)";

?>

	<table width="100%" border="0" cellpadding="2" cellspacing="0" id="ExportTable">

		

		<thead>

		<tr><td colspan="24" style="border:0px;">

		<?

		echo $str;

		?>

		</td></tr>
<tbody>



	<tr>

		<th><div align="left">S/L</div></th>

		<th><div align="left">Po No</div></th>
		<th><div align="left">Po Date</div></th>

		<th><div align="left">Sale No </div></th>
		<th><div align="left">Sale Date </div></th>
		<th><div align="left">Lot No</div></th>

		<th><div align="left">Garden Name </div></th>
		<th><div align="left">Invoice No </div></th>
		<th><div align="left">Item Grade</div></th>

		<th><div align="left">Mark</div></th>

		<th><div align="left">Pkgs</div></th>

		<th><div align="left">Pending Pcs</div></th>

		<th><div align="left">Rate</div></th>

	    <th><div align="left">Amount</div></th>
	</tr>

    <div align="left">
      <? 





if($_POST['f_date']!=''&&$_POST['t_date']!='')

$con .= 'and a.po_date between "'.$_POST['f_date'].'" and "'.$_POST['t_date'].'"';

if($_POST['vendor_id']>0)

$con .= 'and a.vendor_id="'.$_POST['vendor_id'].'"';

if(isset($item_id)) 	{$item_con=' and e.item_id='.$item_id;}

if(isset($ctg_warehouse)) 	{$ctg_warehouse_con=' and b.shed_id='.$ctg_warehouse;}

if(isset($garden_id)) 	{$garden_id_con=' and b.garden_id='.$garden_id;}



$res='
select a.po_no as po_no, a.po_date, a.sale_no, a.sale_date, b.lot_no,    b.invoice_no as inv_no, e.item_name as item_grade, b.quality as mark, CONVERT(b.pkgs, DECIMAL(20,2)) as pkgs,b.qty, (select sum(r.qty) from purchase_receive r where r.order_no=b.id) as pending_pcs,b.rate,b.amount 
from
 purchase_master a, purchase_invoice b, vendor c, item_sub_group d, item_info e, user_activity_management f  where a.po_no=b.po_no and c.vendor_id=a.vendor_id and d.sub_group_id=e.sub_group_id and b.item_id=e.item_id and b.garden_id=g.garden_id and f.user_id=a.entry_by and (a.status="CHECKED" or a.status="COMPLETED") '.$con.$item_con.$ctg_warehouse_con.$garden_id_con.' order by a.po_no,b.id';



$query = mysql_query($res);

while($data=mysql_fetch_object($query))

{
if($data->qty>$data->pending_pcs){

$j++;


?>
      
      
      

    <tr>

      <td valign="top"><?=$j?></td>

	  <td valign="top"><div align="left">
	    <?=$data->po_no;?>
      </div></td>
	  
	  
	  <td valign="top"><div align="left">
	    <?=date("d-m-Y",strtotime($data->po_date));?>
      </div></td>

	  <td valign="top"><div align="left">
	    <?=$data->sale_no;?>
      </div></td>
	  
	  
	  <td valign="top"><div align="left">
	    <?=date("d-m-Y",strtotime($data->sale_date));?>
      </div></td>
	  <td valign="top"><div align="left">
	    <?=$data->lot_no;?>
      </div></td>

	  <td valign="top"><div align="left">
	    <?=$data->garden_name;?>
      </div></td>
	  <td valign="top"><div align="left">
	    <?=$data->inv_no;?>
      </div></td>
	  <td><div align="left">
	    <?=$data->item_grade;?>
      </div></td>
	  <td><div align="left">
	    <?=$data->mark;?>
      </div></td>
	  <td><div align="left">
	    <?=$data->pkgs; $tot_pkgs+=$data->pkgs;?>
      </div></td>
	  <td><div align="left">
	    <?=number_format(($data->qty-$data->pending_kgs),3); $tot_pending_kg+=($data->qty-$data->pending_kgs);?>
      </div></td>
	  <td><div align="left">
	    <?=$data->rate;?>
      </div></td>
	  <td><div align="left">
	    <?=$data->amount; $tot_amount+=$data->amount;?>
      </div></td>
	</tr>

          <? }}?>
      
    </div>
    <tr>

	  <td valign="top">&nbsp;</td>
	  <td valign="top">&nbsp;</td>
	  <td valign="top">&nbsp;</td>
	  <td valign="top">&nbsp;</td>
	  <td valign="top">&nbsp;</td>
	  <td valign="top">&nbsp;</td>
	  <td valign="top"><div align="left"><strong>Total:</strong></div></td>
	  <td valign="top">&nbsp;</td>
	  <td valign="top">&nbsp;</td>
	  <td valign="top">&nbsp;</td>
	  <td valign="top"><div align="left"><span class="style2">
	    <?=number_format(($tot_pkgs),2);?>
      </span></div></td>
	  <td valign="top"><div align="left"><span class="style1">
	    <?=number_format(($tot_pending_kg),3);?>
      </span></div></td>
	  <td valign="top">&nbsp;</td>
	  <td>

	    <div align="left"><span class="style3">
	      <?=number_format(($tot_amount),2);?>
        </span></div></td>
	</tr>
</tbody></table>

<?

}

//Local Purchase report
elseif($_POST['report']==1105)

{

$report="Lacal Purchase Report";

?>

	<table width="100%" border="0" cellpadding="2" cellspacing="0" id="ExportTable">

		

		<thead>

		<tr><td colspan="24" style="border:0px;">

		<?

		echo $str;

		?>

		</td></tr>
<tbody>



	<tr>

		<th><div align="left">S/L</div></th>

		<th><div align="left">LP No</div></th>
		<th><div align="left">LP Date</div></th>
		<th><div align="left">Item Name</div></th>

		<th><div align="left">Purchase From </div></th>
		<th><div align="left">Requision From</div></th>
		<th><div align="left">Receive_type</div></th>
		<th><div align="left">Unit Name</div></th>

		<th><div align="left">Rate</div></th>
		<th><div align="left">Total unit </div></th>
		
		<th><div align="left">Total Amount </div></th>
		<th><div align="left">Entry At </div></th>
		<th><div align="left">User</div></th>
	</tr>

    <div align="left">
      <? 





if($_POST['f_date']!=''&&$_POST['t_date']!='')

$con .= 'and a.or_date between "'.$_POST['f_date'].'" and "'.$_POST['t_date'].'"';

if($_POST['vendor_id']>0)

$con .= 'and a.vendor_id="'.$_POST['vendor_id'].'"';

if(isset($item_id)) 	{$item_con=' and e.item_id='.$item_id;}
if(isset($status))      {$status_con=' and a.status='.$status;}

if(isset($ctg_warehouse)) 	{$ctg_warehouse_con=' and b.shed_id='.$ctg_warehouse;}

if(isset($garden_id)) 	{$garden_id_con=' and b.garden_id='.$garden_id;}



 $res='
select a.or_no as or_no, a.or_date, e.item_name,a.requisition_from,a.vendor_name as Purchase_From,b.unit_name,b.rate,b.qty,b.amount,a.receive_type,u.username,a.entry_at from  
 warehouse_other_receive a, warehouse_other_receive_detail b, item_info e, user_activity_management u  where a.or_no=b.or_no and a.receive_type="Local Purchase" and b.item_id=e.item_id and u.user_id=a.entry_by '.$con.$item_con.$ctg_warehouse_con.$status_con.' order by a.or_no';



$query = mysql_query($res);

while($data=mysql_fetch_object($query))

{


$j++;


?>
      
     
      

    <tr>

      <td valign="top"><?=$j?></td>

	  <td valign="top"><div align="left">
	    <?=$data->or_no;?>
      </div></td>
	  
	 
	  <td valign="top"><div align="left">
	    <?=date("d-m-Y",strtotime($data->or_date));?>
      </div></td>
	  <td valign="top"><div align="left">
	    <?=$data->item_name;?>
      </div></td>
	 
	  <td><div align="left">
	    <?=$data->Purchase_From;?>
      </div></td>
	  <td><div align="left">
	    <?=$data->requisition_from;?>
      </div></td>
	  <td><div align="left">
	    <?=$data->receive_type;?>
      </div></td>
	 
	  <td><div align="left">
	    <?=$data->unit_name?>
      </div></td>
	  <td><div align="left">
	    <?=$data->rate;?>
      </div></td>
	  <td><div align="left">
	    <?=$data->qty; $total_qty += $data->qty;?>
      </div></td>
	  <td><div align="left">
	    <?=$data->amount; $total_amount=$total_amount+$data->amount;?>
      </div></td>
	  
	  <td><div align="left">
	    <?=$data->entry_at?>
      </div></td>
	   <td><div align="left">
	    <?=$data->username?>
      </div></td>
	</tr>

          <? }?>
      
    </div>
    <tr>

	  <td style="border:none;" valign="top">&nbsp;</td>
	  <td style="border:none;" valign="top">&nbsp;</td>
	  <td style="border:none;" valign="top">&nbsp;</td>
	  <td style="border:none;" valign="top">&nbsp;</td>
	  <td style="border:none;" valign="top"><div align="left"></div></td>
	  <td style="border:none;" valign="top">&nbsp;</td>
	  <td style="border:none;" valign="top">&nbsp;</td>
	  <td style="border:none;" valign="top">&nbsp;</td>
	  <td style="border:none;" valign="top"><strong>Total:</strong></td>
	  <td style="border:none;" valign="top">
		  <div align="left">
			  <span class="style1">
					<?=$total_qty;?>
			  </span>
		  </div>
	  </td>
	  <td style="border:none;" valign="top">
	  <div align="left">
		  <span class="style1">
				<?=$total_amount;?>
		  </span>
	  </div>
	  </td>
	  <td style="border:none;" valign="top">&nbsp;</td>
	  

	   
	</tr>
</tbody></table>

<?

}



/*/purchase unreceive report*/




/*Black tea factory stock report*/

elseif($_POST['report']==20190910)

{

$report="Damage Warehouse Stock";



{	if(isset($warehouse_id)) 			{$warehouse_con=' and a.warehouse_id='.$warehouse_id;}

	$sql='select distinct i.item_id,i.unit_name,i.item_name,s.sub_group_name,i.finish_goods_code,i.cost_price
		   from item_info i, item_sub_group s where  1 and
		   i.sub_group_id=s.sub_group_id'.$item_sub_con.' order by i.finish_goods_code,s.sub_group_name,i.item_name';
		   
		$query =mysql_query($sql);   
		
		if($warehouse_id>0){  
		$warehouse_name = find_a_field('warehouse','warehouse_name','warehouse_id='.$_SESSION['user']['depot']);
		}else{
		$warehouse_name = find_a_field('warehouse','warehouse_name','warehouse_id='.$_SESSION['user']['depot']);
		}
		$warehouse_con = ' and a.warehouse_id='.$_SESSION['user']['depot'];
?>


	<table width="100%" border="0" cellpadding="2" cellspacing="0" id="ExportTable">

		

		<thead>

		<tr><td colspan="25" style="border:0px;">

<p align="center">Damage Warehouse</p>

		</td></tr>
<tbody>

	<tr>
	  <th><div align="left">S/L</div></th>
	  <th><div align="left">Warehouse Name</div></th>
	  <th><div align="left">Item Group</div></th>
	  <th><div align="left">Item Code</div></th>
	  <th><div align="left">Item Name</div></th>
	  <th><div align="left">Unit</div></th>
	  <th><div align="left">Final Stock</div></th>

	</tr>
    <div align="left">
      <?
while($data=mysql_fetch_object($query)){

 $s='select sum(a.item_in-a.item_ex) as final_stock
from journal_item a where a.warehouse_id=8 and a.item_id="'.$data->item_id.'" '.$date_con.$item_con.$status_con.' order by a.id desc limit 1';

$q = mysql_query($s);
$i=mysql_fetch_object($q);

 $in_transit=find_a_field_sql('select FORMAT(sum(a.item_in-a.item_ex),2) as final_stock
from journal_item a where (a.tr_from="TRANSIT" and a.item_in>0) and a.item_id="'.$data->item_id.'" '.$date_con.$item_con.$status_con.$warehouse_con.' ');
$i->final_stock = $i->final_stock - $in_transit;
$j++;
$amt = $i->final_stock*$data->cost_price;
$total_amt = $total_amt + $amt;
		   ?>
      
      

    <tr>
<td><?=$j?></td>
<td><?=$warehouse_name?></td>
<!--<td><?=$data->item_id?></td>-->
<td><?=$data->sub_group_name?></td>
<td><?=$data->finish_goods_code?></td>
<td><?=$data->item_name?></td>
<td><?=$data->unit_name?></td>
<td style="text-align:right"><a href="damage_item_list.php?item_id=<?=$data->item_id?>" target="_blank"><?=$i->final_stock?></a></td>
<!--<td style="text-align:right"><?=@number_format($data->cost_price,2)?></td>
<td style="text-align:right"><?=number_format(($amt),2)?></td>-->
</tr>
<?
$tot_qty+=$i->final_stock;
}
		
?>
<tr>
<td></td>
<td></td>
<!--<td></td>-->
<td></td>
<td></td>
<td></td>
<td align="right"><b>Total:</b></td>

<td><?=$tot_qty?></td>
<!--<td></td>
<td style="text-align:right"><?=number_format(($total_amt),2)?></td>-->
</tr>
<?

}
?>
<?

}

/*/Black tea factory stock report*/






/*purchase unreceive report pkgs*/

elseif($_POST['report']==112)

{

$report="Chittagong Warehouse Stock (PKGS Wise)";

?>

	<table width="100%" border="0" cellpadding="2" cellspacing="0" id="ExportTable">

		

		<thead>

		<tr><td colspan="24" style="border:0px;">

		<?

		echo $str;

		?>

		</td></tr>
<tbody>



	<tr>

		<th><div align="left">S/L PKGS</div></th>

		<th><div align="left">Po No</div></th>
		<th><div align="left">Po Date</div></th>

		<th><div align="left">Sale No </div></th>
		<th><div align="left">Sale Date </div></th>
		<th><div align="left">Lot No</div></th>

		<th><div align="left">Garden Name </div></th>
		<th><div align="left">Invoice No </div></th>
		<th><div align="left">Item Grade</div></th>

		<th><div align="left">Mark</div></th>

		<th><div align="left">Pkgs</div></th>

		<th><div align="left">Pending Pcs</div></th>

		<th><div align="left">Rate</div></th>

	    <th><div align="left">Amount</div></th>
	</tr>

    <div align="left">
      <? 





if($_POST['f_date']!=''&&$_POST['t_date']!='')

$con .= 'and a.po_date between "'.$_POST['f_date'].'" and "'.$_POST['t_date'].'"';

if($_POST['vendor_id']>0)

$con .= 'and a.vendor_id="'.$_POST['vendor_id'].'"';

if(isset($item_id)) 	{$item_con=' and e.item_id='.$item_id;}

if(isset($ctg_warehouse)) 	{$ctg_warehouse_con=' and b.shed_id='.$ctg_warehouse;}

if(isset($garden_id)) 	{$garden_id_con=' and b.garden_id='.$garden_id;}



$res='
select a.po_no as po_no, a.po_date, a.sale_no, a.sale_date, b.lot_no,    b.invoice_no as inv_no, e.item_name as item_grade, b.quality as mark, CONVERT(b.pkgs, DECIMAL(20,2)) as pkgs,b.qty, (select sum(r.qty) from purchase_receive r where r.order_no=b.id) as pending_kgs,b.rate,b.amount 
from
 purchase_master a, purchase_invoice b, vendor c, item_sub_group d, item_info e, user_activity_management f  where a.po_no=b.po_no and c.vendor_id=a.vendor_id and d.sub_group_id=e.sub_group_id and b.item_id=e.item_id and b.garden_id=g.garden_id and f.user_id=a.entry_by and (a.status="CHECKED" or a.status="COMPLETED") '.$con.$item_con.$ctg_warehouse_con.$garden_id_con.' order by a.po_no,b.id';



$query = mysql_query($res);

while($data=mysql_fetch_object($query))

{
if($data->qty>$data->pending_kgs){

$j++;


?>
      
      
      

    <tr>

      <td valign="top"><?=$j?></td>

	  <td valign="top"><div align="left">
	    <?=$data->po_no;?>
      </div></td>
	  
	  
	  <td valign="top"><div align="left">
	    <?=date("d-m-Y",strtotime($data->po_date));?>
      </div></td>

	  <td valign="top"><div align="left">
	    <?=$data->sale_no;?>
      </div></td>
	  
	  
	  <td valign="top"><div align="left">
	    <?=date("d-m-Y",strtotime($data->sale_date));?>
      </div></td>
	  <td valign="top"><div align="left">
	    <?=$data->lot_no;?>
      </div></td>

	  <td valign="top"><div align="left">
	    <?=$data->garden_name;?>
      </div></td>
	  <td valign="top"><div align="left">
	    <?=$data->inv_no;?>
      </div></td>
	  <td><div align="left">
	    <?=$data->item_grade;?>
      </div></td>
	  <td><div align="left">
	    <?=$data->mark;?>
      </div></td>
	  <td><div align="left">
	    <?=$data->pkgs; $tot_pkgs+=$data->pkgs;?>
      </div></td>
	  <td><div align="left">
	    <?=number_format(($data->qty-$data->pending_kgs),3); $tot_pending_kg+=($data->qty-$data->pending_kgs);?>
      </div></td>
	  <td><div align="left">
	    <?=$data->rate;?>
      </div></td>
	  <td><div align="left">
	    <?=$data->amount; $tot_amount+=$data->amount;?>
      </div></td>
	</tr>

          <? }}?>
      
    </div>
    <tr>

	  <td valign="top">&nbsp;</td>
	  <td valign="top">&nbsp;</td>
	  <td valign="top">&nbsp;</td>
	  <td valign="top">&nbsp;</td>
	  <td valign="top">&nbsp;</td>
	  <td valign="top">&nbsp;</td>
	  <td valign="top"><div align="left"><strong>Total:</strong></div></td>
	  <td valign="top">&nbsp;</td>
	  <td valign="top">&nbsp;</td>
	  <td valign="top">&nbsp;</td>
	  <td valign="top"><div align="left"><span class="style2">
	    <?=number_format(($tot_pkgs),2);?>
      </span></div></td>
	  <td valign="top"><div align="left"><span class="style1">
	    <?=number_format(($tot_pending_kg),3);?>
      </span></div></td>
	  <td valign="top">&nbsp;</td>
	  <td>

	    <div align="left"><span class="style3">
	      <?=number_format(($tot_amount),2);?>
        </span></div></td>
	</tr>
</tbody></table>

<?

}

/*/purchase unreceive report pkgs wise*/





elseif($_POST['report']==71) 
{
		$sql='select i.item_id,i.unit_name,i.item_name,i.sales_item_type,i.finish_goods_code,i.item_brand,i.pack_unit,i.pack_size,i.sales_item_type from item_info i where 
		   i.product_nature = "Salable"  order by i.finish_goods_code,i.item_name';
		   
		$query =mysql_query($sql);  
?>
<table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable"><thead><tr><td style="border:0px;" colspan="12"><div class="header"><h1>ZISAN FOOD & BEVERAGE LTD</h1><h2>Warehouse Present Stock</h2></div><div class="left"></div><div class="right"></div><div class="date">Reporting Time: <?=date("h:i A d-m-Y")?></div></td></tr><tr>
<th>S/L</th>
<th>FG Code </th>
<th>Brand</th>
<th>Group</th>
<th>Item Name </th>
<th>Pack Size </th>
<th>Pcs Unit</th>
<th bgcolor="#FFCCFF">CRT</th>
<th bgcolor="#CCCCFF">PCS</th>
<th>Rate</th>
<th>Stock Price</th>
</tr>
</thead><tbody>
<?
while($data=mysql_fetch_object($query)){
$s='select a.final_stock,a.final_price as rate,(a.final_stock*a.final_price) as Stock_price from journal_item a where  a.item_id="'.$data->item_id.'"  and a.warehouse_id='.$_SESSION['user']['depot'].' order by a.id desc limit 1';
$q = mysql_query($s);
$i=mysql_fetch_object($q);$j++;
		   ?>
<tr><td><?=$j?></td>
  <td><?=$data->finish_goods_code?></td>
  <td><?=$data->item_brand?></td>
  <td><?=$data->sales_item_type?></td>
  <td><?=$data->item_name?></td>
  <td><?=$data->pack_size?></td>
  <td><?=$data->unit_name?></td>
	
<td bgcolor="#FFCCFF" style="text-align:right"><?=(int)($i->final_stock/$data->pack_size)?></td>
<td bgcolor="#CCCCFF" style="text-align:right"><?=(int)($i->final_stock%$data->pack_size)?></td>
<td style="text-align:right"><?=$i->rate?></td><td style="text-align:right"><?=$i->Stock_price?></td></tr>
		   <?
}
}

elseif($_POST['report']==1004)
{
		$report="RM Consumtion Report";
		if(isset($warehouse_id)){$con.=' and j.warehouse_id="'.$warehouse_id.'"';}
		if(isset($sub_group_id)){$s_con.=' and i.sub_group_id="'.$sub_group_id.'"';} 
		?>
		<table width="100%" border="0" cellpadding="2" cellspacing="0" id="ExportTable">
		
		<thead>
		<tr><td colspan="17" style="border:0px;">
		<?
		echo '<div class="header">';
		echo '<h1>'.find_a_field('warehouse','warehouse_name','warehouse_id='.$_SESSION['user']['depot']).'</h1>';
		if(isset($report)) 
		echo '<h2>'.$report.'</h2>';
		
?>
<h2><? if($sub_group_id>0) echo 'Sub Group: '.find_a_field('item_sub_group','sub_group_name','sub_group_id='.$sub_group_id)?></h2>
<?
if(isset($warehouse_id))
		echo '<p>PL/WH Name: '.find_a_field('warehouse','warehouse_name','warehouse_id='.$warehouse_id).'</p>';
if(isset($t_date)) 
		echo '<h2>Date Interval : '.$f_date.' To '.$t_date.'</h2>';
		echo '</div>';

		echo '<div class="date" style=" text-align:left; float:right;">Reporting Time: '.date("h:i A d-m-Y").'</div>';
		?>
		</td></tr>
		<tr>
		<th rowspan="2">S/L</th>
		<th rowspan="2">Item Code </th>
		<th rowspan="2">Item Name </th>
		<th colspan="3" bgcolor="#99CC99" style="text-align:center">OPENING BALANCE</th>
		<th colspan="3" bgcolor="#339999" style="text-align:center">PRODUCT RECEIVED</th>
		<th colspan="3" bgcolor="#FFCC66" style="text-align:center">PRODUCT ISSUED</th>
		<th colspan="3" bgcolor="#FFFF99" style="text-align:center">CLOSING BALANCE</th>
		</tr>
		<tr>
		<th bgcolor="#99CC99">Qty</th>
		<th bgcolor="#99CC99">Rate</th>		
		<th bgcolor="#99CC99">Taka</th>
		<th bgcolor="#339999">Qty</th>
		<th bgcolor="#339999">Rate</th>		
		<th bgcolor="#339999">Taka</th>
		<th bgcolor="#FFCC66">Qty</th>
		<th bgcolor="#FFCC66">Rate</th>
		<th bgcolor="#FFCC66">Taka</th>
		<th bgcolor="#FFFF99">Qty</th>
		<th bgcolor="#FFFF99">Rate</th>
		<th bgcolor="#FFFF99">Taka</th>
		</tr>
		</thead><tbody>
		<? $sl=1;
$sql="select distinct j.item_id,i.item_name from item_info i,journal_item j where i.item_id=j.item_id and product_nature='Salable' ".$con." order by i.product_nature,i.item_name";
		$res	 = mysql_query($sql);
		while($row=mysql_fetch_object($res))
		{
$pre = find_all_field_sql('select sum(item_in-item_ex) as pre_stock,sum((item_in-item_ex)*item_price) as pre_amt from journal_item j where ji_date<"'.$f_date.'" and item_id='.$row->item_id.$con);
		$pre_stock = (int)$pre->pre_stock;
		$pre_price = @($pre->pre_amt/$pre->pre_stock);
		$pre_amt   = $pre->pre_amt;

		$in = find_all_field_sql('select sum(item_in) as pre_stock, sum(item_in*item_price) as pre_amt from journal_item j where item_in>0 and ji_date between "'.$f_date.'" and "'.$t_date.'" and item_id='.$row->item_id.$con);
		$in_stock = (int)$in->pre_stock;
		$in_price = @($in->pre_amt/$in->pre_stock);
		$in_amt   = $pre->pre_amt;
		

		$out = find_all_field_sql('select sum(item_ex) as pre_stock, sum(item_ex*item_price) as pre_amt from journal_item j where item_ex>0 and ji_date between "'.$f_date.'" and "'.$t_date.'" and item_id='.$row->item_id.$con);
		$out_stock = (int)$out->pre_stock;
		$out_price = @($out->pre_amt/$out->pre_stock);
		$out_amt   = $pre->pre_amt;
		

		
		$final_stock = $pre_stock+($in_stock-$out_stock);
		$final_price = @((($pre_stock*$pre_price)+($in_stock*$in_price)-($out_stock*$out_price))/$final_stock);
		if($pre_stock>0||$in_stock>0||$out_stock>0||$out_stock>0){
		?>
		
		<tr <?=($xx%2==0)?' bgcolor="#CCCCCC"':'';$xx++;?>>
		<td><?=$sl++;?></td>
		<td><?=$row->item_id?></td>
		<td><?=$row->item_name?></td>
		<td><?=$pre_stock?></td>
		<td><?=number_format($pre_price,2)?></td>
		<td><?=number_format(($pre_stock*$pre_price),2)?></td>

		<td><?=$in_stock?></td>
		<td><?=number_format($in_price,2)?></td>
		<td><?=number_format(($in_price*$in_stock),2)?></td>


		<td><?=$out_stock?></td>
		<td><?=number_format($out_price,2)?></td>
		<td><?=number_format(($out_price*$out_stock),2)?></td>
		<td><?=$final_stock?></td>
		<td><?=number_format($final_price,2)?></td>
		<td><?=number_format(($final_stock*$final_price),2)?></td>
</tr><? }}?>
		
		</tbody>
		</table>
		<?
}
elseif($_POST['report']==1005)
{
		$report="FG Production &amp; Transferred Report";		
		if(isset($warehouse_id)){$con.=' and j.warehouse_id="'.$warehouse_id.'"';}
		?>
		<table width="100%" border="0" cellpadding="2" cellspacing="0" id="ExportTable">
		
		<thead>
		<tr><td colspan="17" style="border:0px;">
		<?
		echo '<div class="header">';
		echo '<h1>'.find_a_field('warehouse','warehouse_name','warehouse_id='.$_SESSION['user']['depot']).'</h1>';
		if(isset($report)) 
		echo '<h2>'.$report.'</h2>';
		
?>
<h2><? if($sub_group_id>0) echo 'Sub Group: '.find_a_field('item_sub_group','sub_group_name','sub_group_id='.$sub_group_id)?></h2>
<?
if(isset($warehouse_id))
		echo '<p>WH Name: '.find_a_field('warehouse','warehouse_name','warehouse_id='.$warehouse_id).'</p>';
if(isset($t_date)) 
		echo '<h2>Date Interval : '.$f_date.' To '.$t_date.'</h2>';
		echo '</div>';

		echo '<div class="date" style=" text-align:left; float:right;">Reporting Time: '.date("h:i A d-m-Y").'</div>';
		?>
		</td></tr>
		<tr>
		<th rowspan="2">S/L</th>
		<th rowspan="2">Item Code </th>
		<th rowspan="2">Item Name </th>
		<th colspan="3" bgcolor="#99CC99" style="text-align:center">OPENING BALANCE</th>
		<th colspan="3" bgcolor="#339999" style="text-align:center">PRODUCT RECEIVED</th>
		<th colspan="3" bgcolor="#FFCC66" style="text-align:center">PRODUCT TRANSFERRED</th>
		<th colspan="3" bgcolor="#FFFF99" style="text-align:center">CLOSING BALANCE</th>
		</tr>
		<tr>
		<th bgcolor="#99CC99">Qty</th>
		<th bgcolor="#99CC99">Rate</th>		
		<th bgcolor="#99CC99">Taka</th>
		<th bgcolor="#339999">Qty</th>
		<th bgcolor="#339999">Rate</th>		
		<th bgcolor="#339999">Taka</th>
		<th bgcolor="#FFCC66">Qty</th>
		<th bgcolor="#FFCC66">Rate</th>
		<th bgcolor="#FFCC66">Taka</th>
		<th bgcolor="#FFFF99">Qty</th>
		<th bgcolor="#FFFF99">Rate</th>
		<th bgcolor="#FFFF99">Taka</th>
		</tr>
		</thead><tbody>
		<? $sl=1;
		$sql="select distinct j.item_id,i.item_name from item_info i,journal_item j where i.item_id=j.item_id and product_nature='Salable' ".$con." order by i.item_id,i.item_name";
		
		$res	 = mysql_query($sql);
		while($row=mysql_fetch_object($res))
		{

		$pre = find_all_field_sql('select sum(item_in-item_ex) as pre_stock,sum((item_in-item_ex)*item_price) as pre_amt from journal_item j where ji_date<"'.$f_date.'" and item_id='.$row->item_id.$con);
		$pre_stock = (int)$pre->pre_stock;
		$pre_price = @($pre->pre_amt/$pre->pre_stock);
		$pre_amt   = $pre->pre_amt;

		$in = find_all_field_sql('select sum(item_in) as pre_stock, sum(item_in*item_price) as pre_amt from journal_item j where item_in>0 and ji_date between "'.$f_date.'" and "'.$t_date.'" and item_id='.$row->item_id.$con);
		$in_stock = (int)$in->pre_stock;
		$in_price = @($in->pre_amt/$in->pre_stock);
		$in_amt   = $pre->pre_amt;
		

		$out = find_all_field_sql('select sum(item_ex) as pre_stock, sum(item_ex*item_price) as pre_amt from journal_item j where item_ex>0 and ji_date between "'.$f_date.'" and "'.$t_date.'" and item_id='.$row->item_id.$con);
		$out_stock = (int)$out->pre_stock;
		$out_price = @($out->pre_amt/$out->pre_stock);
		$out_amt   = $pre->pre_amt;
		

		
		$final_stock = $pre_stock+($in_stock-$out_stock);
		$final_price = @((($pre_stock*$pre_price)+($in_stock*$in_price)-($out_stock*$out_price))/$final_stock);
		if($pre_stock>0||$in_stock>0||$out_stock>0||$out_stock>0){
		?>
		
		<tr <?=($xx%2==0)?' bgcolor="#CCCCCC"':'';$xx++;?>>
		<td><?=$sl++;?></td>
		<td><?=$row->item_id?></td>
		<td><?=$row->item_name?></td>
		<td><?=$pre_stock; $t_pre_stock +=$pre_stock;?></td>
		<td><?=number_format($pre_price,2)?></td>
		<td><?=number_format(($pre_stock*$pre_price),2)?></td>

		<td><?=$in_stock; $t_in_stock+=$in_stock;?></td>
		<td><?=number_format($in_price,2)?></td>
		<td><?=number_format(($in_price*$in_stock),2)?></td>


		<td><?=$out_stock; $t_out_stock+=$out_stock;?></td>
		<td><?=number_format($out_price,2)?></td>
		<td><?=number_format(($out_price*$out_stock),2)?></td>
		<td><?=$final_stock; $t_final_stock+=$final_stock;?></td>
		<td><?=number_format($final_price,2)?></td>
		<td><?=number_format(($final_stock*$final_price),2)?></td>
</tr>
<? }}?>
		<tr <?=($xx%2==0)?' bgcolor="#CCCCCC"':'';$xx++;?>>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td><div align="right"><strong>Total=</strong></div></td>
		  <td><span class="style4">
	      <?=number_format($t_pre_stock,2);?>
		  </span></td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td><span class="style5">
	      <?=number_format($t_in_stock,2);?>
		  </span></td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td><span class="style6">
	      <?=number_format($t_out_stock,2);?>
		  </span></td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td><span class="style7">
	      <?=number_format($t_final_stock,2);?>
		  </span></td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  </tr>
		
		
		</tbody>
		</table>
		<?
}



elseif($_POST['report']==2005)
{
		$report="Daily Production Report";		
		if(isset($warehouse_id)){$con.=' and j.warehouse_id="'.$warehouse_id.'"';}
		?>
		<table width="100%" border="0" cellpadding="2" cellspacing="0" id="ExportTable">
		
		<thead>
		<tr><td colspan="8" style="border:0px;">
		<?
		echo '<div class="header">';
		echo '<h1>'.find_a_field('warehouse','warehouse_name','warehouse_id='.$_SESSION['user']['depot']).'</h1>';
		if(isset($report)) 
		echo '<h2>'.$report.'</h2>';
		
?>
<h2><? if($sub_group_id>0) echo 'Sub Group: '.find_a_field('item_sub_group','sub_group_name','sub_group_id='.$sub_group_id)?></h2>
<?
if(isset($warehouse_id))
		echo '<p>WH Name: '.find_a_field('warehouse','warehouse_name','warehouse_id='.$warehouse_id).'</p>';
if(isset($t_date)) 
		echo '<h2>Date Interval : '.$f_date.' To '.$t_date.'</h2>';
		echo '</div>';

		echo '<div class="date" style=" text-align:left; float:right;">Reporting Time: '.date("h:i A d-m-Y").'</div>';
		?>
		</td></tr>
		<tr>
		<th width="9%" rowspan="2" bgcolor="#8DB4E3">S/L</th>
		<th width="21%" rowspan="2" bgcolor="#8DB4E3">Item Code </th>
		<th width="34%" rowspan="2" bgcolor="#8DB4E3">Item Name </th>
		<th width="11%" rowspan="2" bgcolor="#8DB4E3">FG Code </th>
		<th colspan="2" bgcolor="#8DB4E3" style="text-align:center">PRODUCT RECEIVED</th>
		</tr>
		<tr>
		<th width="13%" bgcolor="#8DB4E3">Unit</th>
		<th width="13%" bgcolor="#8DB4E3">Qty</th>		
		</tr>
		</thead><tbody>
		<? $sl=1;
		$sql="select distinct j.item_id, i.unit_name,i.item_name, i.finish_goods_code from item_info i,journal_item j where  i.item_id=j.item_id and product_nature='Salable' ".$con." order by i.item_id,i.item_name";
		
		$res	 = mysql_query($sql);
		while($row=mysql_fetch_object($res))
		{

		$pre = find_all_field_sql('select sum(item_in-item_ex) as pre_stock,sum((item_in-item_ex)*item_price) as pre_amt from journal_item j where ji_date<"'.$f_date.'" and item_id='.$row->item_id.$con);
		$pre_stock = (int)$pre->pre_stock;
		$pre_price = @($pre->pre_amt/$pre->pre_stock);
		$pre_amt   = $pre->pre_amt;

		$in = find_all_field_sql('select sum(item_in) as pre_stock, sum(item_in*item_price) as pre_amt from journal_item j where item_in>0 and ji_date between "'.$f_date.'" and "'.$t_date.'" and item_id='.$row->item_id.$con);
		$in_stock = $in->pre_stock;
		$in_price = @($in->pre_amt/$in->pre_stock);
		$in_amt   = $pre->pre_amt;
		

		$out = find_all_field_sql('select sum(item_ex) as pre_stock, sum(item_ex*item_price) as pre_amt from journal_item j where item_ex>0 and ji_date between "'.$f_date.'" and "'.$t_date.'" and item_id='.$row->item_id.$con);
		$out_stock = (int)$out->pre_stock;
		$out_price = @($out->pre_amt/$out->pre_stock);
		$out_amt   = $pre->pre_amt;
		

		
		$final_stock = $pre_stock+($in_stock-$out_stock);
		$final_price = @((($pre_stock*$pre_price)+($in_stock*$in_price)-($out_stock*$out_price))/$final_stock);
		if($pre_stock>0||$in_stock>0||$out_stock>0||$out_stock>0){
		?>
		
		<tr <?=($xx%2==0)?' bgcolor="#CCCCCC"':'';$xx++;?>>
		<td><?=$sl++;?></td>
		<td><?=$row->item_id?></td>
		<td><?=$row->item_name?></td>
		<td><?=$row->finish_goods_code?></td>
		<td><?=$row->unit_name?></td>
		<td><?=number_format($in_stock,2); $t_in_stock+=$in_stock;?></td>
		</tr>
<? }}?>
		<tr <?=($xx%2==0)?' bgcolor="#CCCCCC"':'';$xx++;?>>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td colspan="2"><div align="right"><strong>Total=</strong></div></td>
		  <td>&nbsp;</td>
		  <td><span class="style7">
		    <?=number_format($t_in_stock,2);?>
		  </span></td>
		  </tr>
		
		
		</tbody>
		</table>
		<?
}





/*Stock P0sition Report*/


elseif($_POST['report']==8888)

{

		if($warehouse_id>0) {

		$vendor_con = ' and  a.vendor_id= "'.$vendor_id.'" ';


		$wr = find_all_field('warehouse','warehouse_name','warehouse_id='.$warehouse_id);

		}
		
		if($t_date!="") {

		$con.= ' and  a.sale_date between "'.$f_date.'" and "'.$t_date.'" ';
		
		if($warehouse_id!='')
		$con .= ' and c.master_warehouse_id = "'.$warehouse_id.'" ';
		
		if($se_id!='')
		$con .= ' and a.se_id = "'.$se_id.'" ';
		
		if(isset($vendor_id)) 	{$vendor_con=' and a.vendor_id='.$vendor_id;}
		if(isset($status)) 		{$status_con=' and a.status="'.$status.'"';}
		
		}



		$report = 'Stock Position Status';

		?>
		
	
						<?

						  $sqlc = 'select a.sale_no, a.sale_no as sale_no,  DATE_FORMAT(a.sale_date, "%d-%m-%Y") as sale_date, c.warehouse_name as SE_Name, sum(a.today_close) as closing, a.status,  u.fname as entry_by,a.entry_at
from item_sale_issue a, warehouse c, user_activity_management u
where a.se_id=c.warehouse_id and a.entry_by=u.user_id  and c.master_warehouse_id=5  '.$con.' group by a.sale_no order by a.sale_date';
						
						$queryc = mysql_query($sqlc);

						$count = mysql_num_rows($queryc);

						if($count>0){

						?>

						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" id="ExportTable">

						<thead>
						
						<tr>

        <td  colspan="6"  style="text-align:center; color:#000; font-size:20px; font-weight:bold;border:0px;"> <strong style="font-size:22px"> <?

if($_SESSION['user']['group']>1)

echo find_a_field('user_group','group_name',"id=".$_SESSION['user']['group']);

else

echo $_SESSION['proj_name'];

				?></strong>
				<h2 style=" margin:0; padding:0; padding-top:8px;"><? if($warehouse_id>0) echo 'House: '.find_a_field('warehouse','warehouse_name','warehouse_id='.$warehouse_id)?></h2>				</td>
      </tr>

            <tr>

              <td colspan="6" style="border:0px;">
			  
			 


			  
			  
			  <?

		echo '<div class="header">';

		

		if(isset($report)) 

echo '<h2>'.$report.'</h2>';



?>

<h2>

<? if($sub_group_id>0) echo 'Sub Group: '.find_a_field('item_sub_group','sub_group_name','sub_group_id='.$sub_group_id)?>
</h2>

		<?

		echo '<h2>Date Interval: '.$f_date.' To '.$t_date.'</h2>';

		echo '</div>';

		?>              </td>
            </tr>
          </thead>

						<tr>

						  <td width="5%" bgcolor="#FFCCCC"><strong>S/L</strong></td>

						  <td width="13%" bgcolor="#FFCCCC"><strong>View Report </strong></td>

						  <td width="13%" bgcolor="#FFCCCC"><strong>Tr Date</strong></td>

						  <td width="18%" bgcolor="#FFCCCC"><strong>Stock    Name</strong></td>

						  <td width="13%" bgcolor="#FF0000"><strong>Entry By </strong></td>
						<td width="11%" bgcolor="#FF0000"><strong>Entry At </strong></td>
						</tr>
						

<?

while($data = mysql_fetch_object($queryc)){




$vat_packing=$data->tax;



$amount=$data->amount;

$vat_amount=($amount*$vat_packing)/100;

$tot_amount=($amount+$vat_amount);


?>



<tr>

  <td><span class="style5">
    <?=++$z?>
  </span></td>

  <td><a href="../raw_tea/stock_position_report.php?v_no=<?= $data->sale_no?>" target="_blank"><span class="style6">
    <?= $data->sale_no?>
  </span></a></td>

  <td><?= $data->sale_date?></td>

  <td width="18%" height="20"><?= $data->SE_Name?></td>

  <td><?= $data->entry_by?></td>
<td><?= $data->entry_at?></td>
</tr>

						<? }?>

						

<tr>

  <td>&nbsp;</td>

  <td>&nbsp;</td>

  <td>&nbsp;</td>

  <td height="20">&nbsp;</td>

  <td align="right"><span class="style7">
  
</span></td>
<td align="right"><span class="style7">
  
</span></td>
</tr>
</table>

						<br />

						<? }?>

		<?

}

elseif($_POST['report']==11125)
{
?>
<h4><?=find_a_field('user_group','group_name','1');?></h4>
<h5 style="text-align:center">SR Loan Report</h5>
<h5 style="text-align:center">Date: <?=$_POST['f_date']?> To <?=$_POST['t_date']?> </h5>
<table width="100%" border="1" cellpadding="0" cellspacing="0" id="ExportTable">
  <tr>
    <th>SL</th>
    <th>Loan No</th>
    <th>Loan Date </th>
    <th>Booking No</th>
    <th>Agent Name</th>
	<th>Loan Amount</th>
	<th>Entry By</th>
  </tr>
  <? 
 
  
   if($_POST['booking_number']!='')
  {
  
  $booking_no=' and booking_number="'.$_POST['booking_number'].'"';
  }
  
  
  	$s=1;
  	$sql="select * from sr_loan where date between '".$_POST['f_date']."' and '".$_POST['t_date']."' ".$booking_no."";
	$query=mysql_query($sql);
	while($row=mysql_fetch_object($query)){
	
  ?>
  <tr>
    <td><?=$s++;?></td>
    <td><?=$row->sr_loan_id?></td>
    <td><?=$row->date?></td>
    <td><?=$row->booking_number?></td>
    <td><?=find_a_field('dealer_info','dealer_name_e','dealer_code='.$row->dealer_code_eng);?></td>
	<td><?=$row->amount; $tot_amt+=$row->amount;?></td>
	<td><?=find_a_field('user_activity_management','username','user_id='.$row->entry_by);?></td>
	
  </tr>
  <? } ?>
  <tr>
  	<td colspan="5"><strong>Total</strong></td>
	<td><strong><?=$tot_amt?></strong></td>
	<td></td>
  </tr>
</table>


<?
}
elseif($_POST['report']==11126)
{

?>
<h4><?=find_a_field('user_group','group_name','1');?></h4>
<h5 style="text-align:center">Bag Loan Report</h5>
<h5 style="text-align:center">Date: <?=$_POST['f_date']?> To <?=$_POST['t_date']?> </h5>
<table width="100%" border="1" cellpadding="0" cellspacing="0" id="ExportTable">
  <tr>
    <th>SL</th>
    <th>Loan No</th>
    <th>Loan Date </th>
    <th>Booking No</th>
    <th>Agent Name</th>
	<th>Loan Amount</th>
	<th>Entry By</th>
  </tr>
  <? 
  	$s=1;
  	$sql="select * from bag_loan where date between '".$_POST['f_date']."' and '".$_POST['t_date']."'";
	$query=mysql_query($sql);
	while($row=mysql_fetch_object($query)){
	
  ?>
  <tr>
    <td><?=$s++;?></td>
    <td><?=$row->sr_loan_id?></td>
    <td><?=$row->date?></td>
    <td><?=$row->booking_number?></td>
    <td><?=find_a_field('dealer_info','dealer_name_e','dealer_code='.$row->dealer_code_eng);?></td>
	<td><?=$row->amount; $tot_amt+=$row->amount;?></td>
	<td><?=find_a_field('user_activity_management','username','user_id='.$row->entry_by);?></td>
	
  </tr>
  <? } ?>
  <tr>
  	<td colspan="5"><strong>Total</strong></td>
	<td><strong><?=$tot_amt?></strong></td>
	<td></td>
  </tr>
</table>


<?

}
/*Stock Ppsition Report*/



elseif($_POST['report']==2006)
{
		$report="FG Production &amp; Transferred Report";		
		if(isset($warehouse_id)){$con.=' and j.warehouse_id="'.$warehouse_id.'"';}
		?>
		<table width="100%" border="0" cellpadding="2" cellspacing="0" id="ExportTable">
		
		<thead>
		<tr><td colspan="9" style="border:0px;">
		<?
		echo '<div class="header">';
		echo '<h1>'.find_a_field('warehouse','warehouse_name','warehouse_id='.$_SESSION['user']['depot']).'</h1>';
		if(isset($report)) 
		echo '<h2>'.$report.'</h2>';
		
?>
<h2><? if($sub_group_id>0) echo 'Sub Group: '.find_a_field('item_sub_group','sub_group_name','sub_group_id='.$sub_group_id)?></h2>
<?
if(isset($warehouse_id))
		echo '<p>WH Name: '.find_a_field('warehouse','warehouse_name','warehouse_id='.$warehouse_id).'</p>';
if(isset($t_date)) 
		echo '<h2>Date Interval : '.$f_date.' To '.$t_date.'</h2>';
		echo '</div>';

		echo '<div class="date" style=" text-align:left; float:right;">Reporting Time: '.date("h:i A d-m-Y").'</div>';
		?>
		</td></tr>
		<tr>
		<th rowspan="2">S/Lll</th>
		<th rowspan="2">Item Code </th>
		<th rowspan="2">Item Name </th>
		<th bgcolor="#99CC99" style="text-align:center">OPENING BALANCE</th>
		<th bgcolor="#339999" style="text-align:center">PRODUCT RECEIVED</th>
		<th bgcolor="#FFCC66" style="text-align:center">PRODUCT TRANSFERRED</th>
		<th bgcolor="#FFFF99" style="text-align:center">CLOSING BALANCE</th>
		</tr>
		<tr>
		<th bgcolor="#99CC99">Qty</th>
		<th bgcolor="#339999">Qty</th>
		<th bgcolor="#FFCC66">Qty</th>
		<th bgcolor="#FFFF99">Qty</th>
		</tr>
		</thead><tbody>
		<? $sl=1;
		$sql="select distinct j.item_id,i.item_name from item_info i,journal_item j where i.item_id=j.item_id and product_nature='Salable' ".$con." order by i.item_id,i.item_name";
		
		$res	 = mysql_query($sql);
		while($row=mysql_fetch_object($res))
		{

		$pre = find_all_field_sql('select sum(item_in-item_ex) as pre_stock,sum((item_in-item_ex)*item_price) as pre_amt from journal_item j where ji_date<"'.$f_date.'" and item_id='.$row->item_id.$con);
		$pre_stock = $pre->pre_stock;
		$pre_price = @($pre->pre_amt/$pre->pre_stock);
		$pre_amt   = $pre->pre_amt;

		$in = find_all_field_sql('select sum(item_in) as pre_stock, sum(item_in*item_price) as pre_amt from journal_item j where item_in>0 and ji_date between "'.$f_date.'" and "'.$t_date.'" and item_id='.$row->item_id.$con);
		$in_stock = $in->pre_stock;
		$in_price = @($in->pre_amt/$in->pre_stock);
		$in_amt   = $pre->pre_amt;
		

		$out = find_all_field_sql('select sum(item_ex) as pre_stock, sum(item_ex*item_price) as pre_amt from journal_item j where item_ex>0 and ji_date between "'.$f_date.'" and "'.$t_date.'" and item_id='.$row->item_id.$con);
		$out_stock = $out->pre_stock;
		$out_price = @($out->pre_amt/$out->pre_stock);
		$out_amt   = $pre->pre_amt;
		

		
		$final_stock = $pre_stock+($in_stock-$out_stock);
		$final_price = @((($pre_stock*$pre_price)+($in_stock*$in_price)-($out_stock*$out_price))/$final_stock);
		if($pre_stock>0||$in_stock>0||$out_stock>0||$out_stock>0){
		?>
		
		<tr <?=($xx%2==0)?' bgcolor="#CCCCCC"':'';$xx++;?>>
		<td><?=$sl++;?></td>
		<td><?=$row->item_id?></td>
		<td><?=$row->item_name?></td>
		<td><?=number_format($pre_stock,2); $t_pre_stock +=$pre_stock;?></td>
		<td><?=number_format($in_stock,2); $t_in_stock+=$in_stock;?></td>
		<td><?=number_format($out_stock,2); $t_out_stock+=$out_stock;?></td>
		<td><?=number_format($final_stock,2); $t_final_stock+=$final_stock;?></td>
		</tr>
<? }}?>
		<tr <?=($xx%2==0)?' bgcolor="#CCCCCC"':'';$xx++;?>>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td><div align="right"><strong>Total=</strong></div></td>
		  <td><span class="style4">
	      <?=number_format($t_pre_stock,2);?>
		  </span></td>
		  <td><span class="style5">
	      <?=number_format($t_in_stock,2);?>
		  </span></td>
		  <td><span class="style6">
	      <?=number_format($t_out_stock,2);?>
		  </span></td>
		  <td><span class="style7">
	      <?=number_format($t_final_stock,2);?>
		  </span></td>
		  </tr>
		
		
		</tbody>
		</table>
		<?
}




elseif($_POST['report']==1001&&$sub_group_id>0) 
{
$sql='select i.item_id,i.unit_name,i.item_name  from item_info i where i.sub_group_id='.$sub_group_id.' order by i.finish_goods_code,i.item_name';
		   
		$query =mysql_query($sql);  
?>
<table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
  <thead><tr><td style="border:0px;" colspan="31"><div class="header"><h1>ZISAN FOOD & BEVERAGE LTD</h1>
<h2>Stock Valuation Report<br />
  <? if($sub_group_id>0) echo 'Sub Group: '.find_a_field('item_sub_group','sub_group_name','sub_group_id='.$sub_group_id)?></h2>
  <? if(isset($t_date)) 
	echo '<h2>Date Interval : '.$f_date.' To '.$t_date.'</h2>';?>
</div><div class="left"></div><div class="right"></div><div class="date">Reporting Time: <?=date("h:i A d-m-Y")?></div></td></tr><tr>
<th rowspan="2">S/L</th>
<th rowspan="2">Item Name </th>
<th rowspan="2">Unit</th>
<th colspan="3" bgcolor="#CC99FF"><div align="center">Opening </div></th>
<th colspan="3" bgcolor="#99FFFF"><div align="center">Purchase</div></th>
<th colspan="3" bgcolor="#FFCCFF"><div align="center">Other Receive </div></th>
<th colspan="3" bgcolor="#FFCC66"><div align="center">Total Receive </div></th>
<th colspan="3"><div align="center">Sales</div></th>
<th colspan="3"><div align="center">Consumption</div></th>
<th colspan="3"><div align="center">Other Issue </div></th>
<th colspan="3"><div align="center">Total Issue </div></th>
<th colspan="3"><div align="center">Closing</div></th>
</tr><tr>
<th bgcolor="#CC99FF">Qty</th>
<th bgcolor="#CC99FF">AVR</th>
<th bgcolor="#CC99FF">Amt </th>
<th bgcolor="#99FFFF">Qty</th>
<th bgcolor="#99FFFF">AVR</th>
<th bgcolor="#99FFFF">Amt </th>
<th bgcolor="#FFCCFF">Qty</th>
<th bgcolor="#FFCCFF">AVR</th>
<th bgcolor="#FFCCFF">Amt </th>
<th bgcolor="#FFCC66">Qty</th>
<th bgcolor="#FFCC66">AVR</th>
<th bgcolor="#FFCC66">Amt </th>
<th>Qty</th>
<th>AVR</th>
<th>Amt </th>
<th>Qty</th>
<th>AVR</th>
<th>Amt </th>
<th>Qty</th>
<th>AVR</th>
<th>Amt </th>
<th>Qty</th>
<th>AVR</th>
<th>Amt </th>
<th>Qty</th>
<th>AVR</th>
<th>Amt </th>
</tr>
</thead><tbody>
<?
while($row=mysql_fetch_object($query)){
$pre_stock = $pre_price = $pre_amt   = $in_stock = $in_price = $in_amt   = $pur_stock = $pur_price = $pur_amt   = $or_stock = $or_amt   = $or_price = $out_stock = $out_price = $out_amt   = $sale_stock = $sale_price = $sale_amt   = $pro_stock = $pro_price = $pro_amt   = $oi_stock = $oi_amt   = $oi_price = $final_stock = $final_amt   = $final_price = 0;

$pre = find_all_field_sql('select sum(item_in-item_ex) as pre_stock,sum((item_in-item_ex)*item_price) as pre_amt from journal_item where warehouse_id = "'.$_SESSION['user']['depot'].'" and ji_date<"'.$f_date.'" and item_id='.$row->item_id);
		$pre_stock = (int)$pre->pre_stock;
		$pre_price = @($pre->pre_amt/$pre->pre_stock);
		$pre_amt   = $pre->pre_amt;

		$in = find_all_field_sql('select sum(item_in) as pre_stock, sum(item_in*item_price) as pre_amt from journal_item where item_in>0 and warehouse_id = "'.$_SESSION['user']['depot'].'" and ji_date between "'.$f_date.'" and "'.$t_date.'" and item_id='.$row->item_id);
		$in_stock = (int)$in->pre_stock;
		$in_price = @($in->pre_amt/$in->pre_stock);
		$in_amt   = $in->pre_amt;
		
		$pur = find_all_field_sql('select sum(item_in) as pre_stock, sum(item_in*item_price) as pre_amt from journal_item where item_in>0 and warehouse_id = "'.$_SESSION['user']['depot'].'" and ji_date between "'.$f_date.'" and "'.$t_date.'" and tr_from="Purchase" and item_id='.$row->item_id);
		$pur_stock = (int)$pur->pre_stock;
		$pur_price = @($pur->pre_amt/$pur->pre_stock);
		$pur_amt   = $pur->pre_amt;
		
		$pur = find_all_field_sql('select sum(item_in) as pre_stock, sum(item_in*item_price) as pre_amt from journal_item where item_in>0 and warehouse_id = "'.$_SESSION['user']['depot'].'" and ji_date between "'.$f_date.'" and "'.$t_date.'" and tr_from!="Purchase" and item_id='.$row->item_id);
		$or_stock = (int)$or->pre_stock;
		$or_amt   = @($or->pre_amt/$or->pre_stock);
		$or_price = $or->pre_amt;
		
		
		$out = find_all_field_sql('select sum(item_ex) as pre_stock, sum(item_ex*item_price) as pre_amt from journal_item where item_ex>0 and warehouse_id = "'.$_SESSION['user']['depot'].'" and ji_date between "'.$f_date.'" and "'.$t_date.'" and item_id='.$row->item_id);
		$out_stock = (int)$out->pre_stock;
		$out_price = @($out->pre_amt/$out->pre_stock);
		$out_amt   = $out->pre_amt;
		
		$sale = find_all_field_sql('select sum(item_ex) as pre_stock, sum(item_ex*item_price) as pre_amt from journal_item where item_ex>0 and warehouse_id = "'.$_SESSION['user']['depot'].'" and ji_date between "'.$f_date.'" and "'.$t_date.'" and tr_from="Sales" and item_id='.$row->item_id);
		$sale_stock = (int)$sale->pre_stock;
		$sale_price = @($sale->pre_amt/$sale->pre_stock);
		$sale_amt   = $sale->pre_amt;
		
		$pro = find_all_field_sql('select sum(item_ex) as pre_stock, sum(item_ex*item_price) as pre_amt from journal_item where item_ex>0 and warehouse_id = "'.$_SESSION['user']['depot'].'" and ji_date between "'.$f_date.'" and "'.$t_date.'" and tr_from="Issue" and item_id='.$row->item_id);
		$pro_stock = (int)$pro->pre_stock;
		$pro_price = @($pro->pre_amt/$pro->pre_stock);
		$pro_amt   = $pro->pre_amt;
		

		
		
		$oi = find_all_field_sql('select sum(item_ex) as pre_stock, sum(item_ex*item_price) as pre_amt from journal_item where item_ex>0 and warehouse_id = "'.$_SESSION['user']['depot'].'" and ji_date between "'.$f_date.'" and "'.$t_date.'" and tr_from!="Sales" and tr_from!="Issue" and item_id='.$row->item_id);
		$oi_stock = (int)$oi->pre_stock;
		$oi_amt   = @($oi->pre_amt/$oi->pre_stock);
		$oi_price = $oi->pre_amt;
		
		$final_stock = $pre_stock+($in_stock-$out_stock);
		$final_amt   = @($pre_stock*$pre_price)+($in_stock*$in_price)-($out_stock*$out_price);
		$final_price = @(($final_amt)/$final_stock);
		
		
		?>
<tr><td><?=++$j?></td>
  <td><?=$row->item_name?></td>
  <td><nobr><?=$row->unit_name?></nobr></td>
  <td bgcolor="#CC99FF"><div align="right">
    <?=$pre_stock?>
  </div></td>
  <td bgcolor="#CC99FF"><div align="right">
    <?=number_format($pre_price,2)?>
  </div></td>
  <td bgcolor="#CC99FF"><div align="right">
    <?=number_format($pre_amt,2)?>
  </div></td>
  <td bgcolor="#99FFFF"><div align="right">
    <?=$pur_stock?>
  </div></td>
  <td bgcolor="#99FFFF"><div align="right">
    <?=number_format($pur_price,2)?>
  </div></td>
  <td bgcolor="#99FFFF"><div align="right">
    <?=number_format($pur_amt,2)?>
  </div></td>
  <td bgcolor="#FFCCFF"><div align="right">
    <?=$or_stock?>
  </div></td>
  <td bgcolor="#FFCCFF"><div align="right">
    <?=number_format($or_price,2)?>
  </div></td>
  <td bgcolor="#FFCCFF"><div align="right">
    <?=number_format($or_amt,2)?>
  </div></td>
  <td bgcolor="#FFCC66"><div align="right">
    <?=$in_stock?>
  </div></td>
  <td bgcolor="#FFCC66"><div align="right">
    <?=number_format($in_price,2)?>
  </div></td>
  <td bgcolor="#FFCC66"><div align="right">
    <?=number_format($in_amt,2)?>
  </div></td>
  <td><div align="right">
    <?=$sale_stock?>
  </div></td>
  <td><div align="right">
    <?=number_format($sale_price,2)?>
  </div></td>
  <td><div align="right">
    <?=number_format($sale_amt,2)?>
  </div></td>
  <td><div align="right">
    <?=$pro_stock?>
  </div></td>
  <td><div align="right">
    <?=number_format($pro_price,2)?>
  </div></td>
  <td><div align="right">
    <?=number_format($pro_amt,2)?>
  </div></td>
  <td><div align="right">
    <?=$oi_stock?>
  </div></td>
  <td><div align="right">
    <?=number_format($oi_price,2)?>
  </div></td>
  <td><div align="right">
    <?=number_format($oi_amt,2)?>
  </div></td>
  <td><div align="right">
    <?=$out_stock?>
  </div></td>
  <td><div align="right">
    <?=number_format($out_price,2)?>
  </div></td>
  <td><div align="right">
    <?=number_format($out_amt,2)?>
  </div></td>
  <td><div align="right">
    <?=$final_stock?>
  </div></td>
  <td><div align="right">
    <?=number_format($final_price,2)?>
  </div></td>
  <td><div align="right">
    <?=number_format($final_amt,2)?>
  </div></td>
</tr>
<?
}
?></tbody></table>
<?
}
elseif($_POST['report']==10011) 
{
if($item_id>0) 		{$item_con = ' and i.item_id='.$item_id;}
if($sub_group_id>0) {$sub_item_con = ' and i.sub_group_id='.$sub_group_id;}

$sql='select i.item_id,i.unit_name,i.item_name  from item_info i where 1 '.$sub_item_con.$item_con.'  order by i.finish_goods_code,i.item_name';
$query =mysql_query($sql);
?>
<table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
  <thead><tr><td style="border:0px;" colspan="35"><div class="header"><h1>ZISAN FOOD & BEVERAGE LTD</h1>
<h2>Stock Valuation Report(HFL)<br />
  <? if($sub_group_id>0) echo 'Sub Group: '.find_a_field('item_sub_group','sub_group_name','sub_group_id='.$sub_group_id)?></h2>
  <? if(isset($t_date)) 
	echo '<h2>Date Interval : '.$f_date.' To '.$t_date.'</h2>';?>
</div><div class="left"></div><div class="right"></div><div class="date">Reporting Time: <?=date("h:i A d-m-Y")?></div></td></tr><tr>
<th rowspan="2">S/L</th>
<th rowspan="2">Item Name </th>
<th rowspan="2">Unit</th>
<th colspan="5" bgcolor="#CC99FF"><div align="center">Opening </div></th>
<th colspan="3" bgcolor="#99FFFF"><div align="center">Purchase</div></th>
<th colspan="3" bgcolor="#FFCCFF"><div align="center">Other Receive </div></th>
<th colspan="3" bgcolor="#FFFF00"><div align="center">Total IN </div></th>
<th colspan="3" bgcolor="#99FFFF"><div align="center">Material Sales</div></th>
<th colspan="3" bgcolor="#FFCCFF"><div align="center">Consumption </div></th>
<th colspan="3" bgcolor="#FFCC66"><div align="center">Other Issue </div></th>
<th colspan="3" bgcolor="#FF3366"><div align="center">Total OUT </div></th>
<th colspan="5" bgcolor="#CC99FF"><div align="center">Closing</div></th>
</tr><tr>
<th bgcolor="#CC99FF">WHQty</th>
<th bgcolor="#CC99FF">PLQty</th>
<th bgcolor="#CC99FF">TQty</th>
<th bgcolor="#CC99FF">AVR</th>
<th bgcolor="#CC99FF">Amt </th>
<th bgcolor="#99FFFF">Qty</th>
<th bgcolor="#99FFFF">AVR</th>
<th bgcolor="#99FFFF">Amt </th>
<th bgcolor="#FFCCFF">Qty</th>
<th bgcolor="#FFCCFF">AVR</th>
<th bgcolor="#FFCCFF">Amt </th>
<th bgcolor="#FFFF00">Qty</th>
<th bgcolor="#FFFF00">AVR</th>
<th bgcolor="#FFFF00">Amt </th>
<th bgcolor="#99FFFF">Qty</th>
<th bgcolor="#99FFFF">AVR</th>
<th bgcolor="#99FFFF">Amt </th>
<th bgcolor="#FFCCFF">Qty</th>
<th bgcolor="#FFCCFF">AVR</th>
<th bgcolor="#FFCCFF">Amt </th>
<th bgcolor="#FFCC66">Qty</th>
<th bgcolor="#FFCC66">AVR</th>
<th bgcolor="#FFCC66">Amt </th>
<th bgcolor="#FF3366">Qty</th>
<th bgcolor="#FF3366">AVR</th>
<th bgcolor="#FF3366">Amt </th>
<th bgcolor="#CC99FF">WHQty</th>
<th bgcolor="#CC99FF">PLQty</th>
<th bgcolor="#CC99FF">TQty</th>
<th bgcolor="#CC99FF">AVR</th>
<th bgcolor="#CC99FF">Amt </th>
</tr>
</thead><tbody>
<?
while($row=mysql_fetch_object($query)){
$pre_stock = $pre_price = $pre_amt   = $in_stock = $in_price = $in_amt   = $pur_stock = $pur_price = $pur_amt   = $or_stock = $or_amt   = $or_price = $out_stock = $out_price = $out_amt   = $sale_stock = $sale_price = $sale_amt   = $pro_stock = $pro_price = $pro_amt   = $oi_stock = $oi_amt   = $oi_price = $final_stock = $final_amt   = $final_price = 0;


		$pr = find_all_field_sql('select sum(item_in) as pre_stock, sum(item_in*item_price) as pre_amt from journal_item where item_in>0 and warehouse_id = "'.$_SESSION['user']['depot'].'" and ji_date < "'.$f_date.'" and (tr_from="Purchase" or tr_from="Local Purchase" or tr_from="Import") and item_id='.$row->item_id);
		$pr_price = @($pr->pre_amt/$pr->pre_stock);
		
		$pr_end = find_all_field_sql('select sum(item_in) as pre_stock, sum(item_in*item_price) as pre_amt from journal_item where item_in>0 and warehouse_id = "'.$_SESSION['user']['depot'].'" and ji_date <= "'.$t_date.'" and (tr_from="Purchase" or tr_from="Local Purchase" or tr_from="Import") and item_id='.$row->item_id);
		$pr_end_price = @($pr->pre_amt/$pr->pre_stock);

		$pur = find_all_field_sql('select sum(item_in) as pre_stock, sum(item_in*item_price) as pre_amt from journal_item where item_in>0 and warehouse_id = "'.$_SESSION['user']['depot'].'" and ji_date between "'.$f_date.'" and "'.$t_date.'" and (tr_from="Purchase" or tr_from="Local Purchase" or tr_from="Import") and item_id='.$row->item_id);
		$pur_stock = (int)$pur->pre_stock;
		$pur_price = @($pur->pre_amt/$pur->pre_stock);
		$pur_amt   = $pur->pre_amt;



$pre = find_all_field_sql('select sum(j.item_in-j.item_ex) as pre_stock from journal_item j,warehouse w where w.warehouse_id=j.warehouse_id and (w.master_warehouse_id = "'.$_SESSION['user']['depot'].'" or  w.warehouse_id = "'.$_SESSION['user']['depot'].'") and j.ji_date<"'.$f_date.'" and j.item_id='.$row->item_id);
		$pret_stock = (int)$pre->pre_stock;
		$pret_price = $pr_price;
		$pret_amt   = $pre->pre_stock*$pr_price;

//echo 'select sum(item_in-item_ex) as pre_stock from journal_item where warehouse_id = "'.$_SESSION['user']['depot'].'" and ji_date<"'.$f_date.'" and item_id='.$row->item_id;
		$pre = find_all_field_sql('select sum(item_in-item_ex) as pre_stock from journal_item where warehouse_id = "'.$_SESSION['user']['depot'].'" and ji_date<"'.$f_date.'" and item_id='.$row->item_id);
		$pre_stock = (int)$pre->pre_stock;
		$lpre_stock = $pret_stock - $pre_stock;
		
		
		$in = find_all_field_sql('select sum(item_in) as pre_stock, sum(item_in*item_price) as pre_amt from journal_item where item_in>0 and warehouse_id = "'.$_SESSION['user']['depot'].'" and ji_date between "'.$f_date.'" and "'.$t_date.'" and item_id='.$row->item_id);
		$in_stock = (int)$in->pre_stock;
		$in_price = @($in->pre_amt/$in->pre_stock);
		$in_amt   = $in->pre_amt;
		

		$pur = find_all_field_sql('select sum(item_in) as pre_stock, sum(item_in*item_price) as pre_amt from journal_item where item_in>0 and warehouse_id = "'.$_SESSION['user']['depot'].'" and ji_date between "'.$f_date.'" and "'.$t_date.'" and tr_from!="Purchase" and tr_from!="Local Purchase" and tr_from!="Import" and item_id='.$row->item_id);
		$or_stock = (int)$or->pre_stock;
		$or_amt   = @($or->pre_amt/$or->pre_stock);
		$or_price = $or->pre_amt;
		
		
		$sale = find_all_field_sql('select sum(item_ex) as pre_stock, sum(item_ex*item_price) as pre_amt from journal_item where item_ex>0 and warehouse_id = "'.$_SESSION['user']['depot'].'" and ji_date between "'.$f_date.'" and "'.$t_date.'" and tr_from="Other Sales" and item_id='.$row->item_id);
		$sale_stock = (int)$sale->pre_stock;
		$sale_price = $pr_price;
		$sale_amt   = $sale_stock*$pr_price;
		
		
		$pro = find_all_field_sql('select sum(item_ex) as pre_stock, sum(item_ex*item_price) as pre_amt from journal_item where item_ex>0 and ji_date between "'.$f_date.'" and "'.$t_date.'" and tr_from="Consumption" and item_id='.$row->item_id);
		$pro_stock = (int)$pro->pre_stock;
		$pro_price = $pr_price;
		$pro_amt   = $pr_price*$pro_stock;
		
		$out = find_all_field_sql('select sum(item_ex) as pre_stock, sum(item_ex*item_price) as pre_amt from journal_item where item_ex>0 and warehouse_id = "'.$_SESSION['user']['depot'].'" and ji_date between "'.$f_date.'" and "'.$t_date.'" and tr_from!="issue" and item_id='.$row->item_id);
		$out_stock = (int)($out->pre_stock + $pro_stock);
		$out_price = $pr_price;
		$out_amt   = $pr_price*$out_stock;
		
		$oi = find_all_field_sql('select sum(item_ex) as pre_stock, sum(item_ex*item_price) as pre_amt from journal_item where item_ex>0 and warehouse_id = "'.$_SESSION['user']['depot'].'" and ji_date between "'.$f_date.'" and "'.$t_date.'" and tr_from!="Other Sales" and tr_from!="Issue" and item_id='.$row->item_id);
		$oi_stock = (int)$oi->pre_stock;
		$oi_amt   = @($oi->pre_amt/$oi->pre_stock);
		$oi_price = $oi->pre_amt;
		
		$final_stock = $pre_stock+($in_stock-$out_stock);
		$final_amt   = @($pre_stock*$pre_price)+($in_stock*$in_price)-($out_stock*$out_price);
		$final_price = @(($final_amt)/$final_stock);

$pre = find_all_field_sql('select sum(j.item_in-j.item_ex) as pre_stock,sum((j.item_in-j.item_ex)*j.item_price) as pre_amt from journal_item j,warehouse w where w.warehouse_id=j.warehouse_id and (w.master_warehouse_id = "'.$_SESSION['user']['depot'].'" or  w.warehouse_id = "'.$_SESSION['user']['depot'].'") and j.ji_date<="'.$t_date.'" and j.item_id='.$row->item_id);
		$final_stock = (int)$pre->pre_stock;
		$final_amt = $pr_end_price;
		$final_price   = $pre->pre_stock*$pr_end_price;

$pre = find_all_field_sql('select sum(j.item_in-j.item_ex) as pre_stock from journal_item j,warehouse w where w.warehouse_id=j.warehouse_id and w.master_warehouse_id = "'.$_SESSION['user']['depot'].'" and j.ji_date<="'.$t_date.'" and j.item_id='.$row->item_id);
		$lfinal_stock = (int)$pre->pre_stock;
		$prefinal_stock = (int)($final_stock -$pre->pre_stock);
		?>
<tr><td><?=++$j?></td>
  <td><?=$row->item_name?></td>
  <td><nobr><?=$row->unit_name?></nobr></td>
  <td bgcolor="#CC99FF"><?=$pre_stock?></td>
  <td bgcolor="#CC99FF"><?=$lpre_stock?></td>
  <td bgcolor="#CC99FF"><div align="right">
    <?=$pret_stock?>
  </div></td>
  <td bgcolor="#CC99FF"><div align="right">
    <?=number_format($pr_price,2)?>
  </div></td>
  <td bgcolor="#CC99FF"><div align="right">
    <?=number_format(($pr_price*$pret_stock),2)?>
  </div></td>
  <td bgcolor="#99FFFF"><div align="right">
    <?=$pur_stock?>
  </div></td>
  <td bgcolor="#99FFFF"><div align="right">
    <?=number_format($pur_price,2)?>
  </div></td>
  <td bgcolor="#99FFFF"><div align="right">
    <?=number_format($pur_amt,2)?>
  </div></td>
  <td bgcolor="#FFCCFF"><div align="right">
    <?=$or_stock?>
  </div></td>
  <td bgcolor="#FFCCFF"><div align="right">
    <?=number_format($or_price,2)?>
  </div></td>
  <td bgcolor="#FFCCFF"><div align="right">
    <?=number_format($or_amt,2)?>
  </div></td>
  <td bgcolor="#FFFF00"><div align="right">
    <?=$in_stock?>
  </div></td>
  <td bgcolor="#FFFF00"><div align="right">
    <?=number_format($in_price,2)?>
  </div></td>
  <td bgcolor="#FFFF00"><div align="right">
    <?=number_format($in_amt,2)?>
  </div></td>
  <td bgcolor="#99FFFF"><div align="right">
    <?=$sale_stock?>
  </div></td>
  <td bgcolor="#99FFFF"><div align="right">
    <?=number_format($sale_price,2)?>
  </div></td>
  <td bgcolor="#99FFFF"><div align="right">
    <?=number_format($sale_amt,2)?>
  </div></td>
  <td bgcolor="#FFCCFF"><div align="right">
    <?=$pro_stock?>
  </div></td>
  <td bgcolor="#FFCCFF"><div align="right">
    <?=number_format($pro_price,2)?>
  </div></td>
  <td bgcolor="#FFCCFF"><div align="right">
    <?=number_format($pro_amt,2)?>
  </div></td>
  <td bgcolor="#FFCC66"><div align="right">
    <?=$oi_stock?>
  </div></td>
  <td bgcolor="#FFCC66"><div align="right">
    <?=number_format($oi_price,2)?>
  </div></td>
  <td bgcolor="#FFCC66"><div align="right">
    <?=number_format($oi_amt,2)?>
  </div></td>
  <td bgcolor="#FF3366"><div align="right">
    <?=$out_stock?>
  </div></td>
  <td bgcolor="#FF3366"><div align="right">
    <?=number_format($out_price,2)?>
  </div></td>
  <td bgcolor="#FF3366"><div align="right">
    <?=number_format($out_amt,2)?>
  </div></td>
  <td bgcolor="#CC99FF"><?=$prefinal_stock?></td>
  <td bgcolor="#CC99FF"><?=$lfinal_stock?></td>
  <td bgcolor="#CC99FF"><div align="right">
    <?=$final_stock?>
  </div></td>
  <td bgcolor="#CC99FF"><div align="right">
    <?=number_format($final_price,2)?>
  </div></td>
  <td bgcolor="#CC99FF"><div align="right">
    <?=number_format($final_amt,2)?>
  </div></td>
</tr>
<?
}
?></tbody></table>
<?
}
elseif($_POST['report']==1003)
{
		$report="Material Consumption  Report";
		if(isset($warehouse_id)) 			{$con.=' and m.warehouse_to='.$warehouse_id;}
		
		?>
		<table width="100%" border="0" cellpadding="2" cellspacing="0" id="ExportTable">
		<thead>
		<tr><td colspan="17" style="border:0px;">
		<?
		echo '<div class="header">';
		echo '<h1>'.find_a_field('warehouse','warehouse_name','warehouse_id='.$_SESSION['user']['depot']).'</h1>';
		if(isset($report)) 
		echo '<h2>'.$report.'</h2>';
		
?>
<h2><? if($sub_group_id>0) echo 'Sub Group: '.find_a_field('item_sub_group','sub_group_name','sub_group_id='.$sub_group_id)?></h2>
<?
if(isset($t_date)) 
		echo '<h2>Date Interval : '.$f_date.' To '.$t_date.'</h2>';
		echo '</div>';

		echo '<div class="date" style=" text-align:left; float:right;">Reporting Time: '.date("h:i A d-m-Y").'</div>';
		?>
		</td></tr>
		<tr>
		<th rowspan="2">S/L</th>
		<th rowspan="2">Item Code </th>
		<th rowspan="2">Item Name </th>
		<th colspan="3" bgcolor="#99CC99" style="text-align:center">OPENING BALANCE</th>
		<th colspan="3" bgcolor="#339999" style="text-align:center">PRODUCT RECEIVED</th>
		<th colspan="3" bgcolor="#FFCC66" style="text-align:center">PRODUCT ISSUED</th>
		<th colspan="3" bgcolor="#FFFF99" style="text-align:center">CLOSING BALANCE</th>
		</tr>
		<tr>
		<th bgcolor="#99CC99">Qty</th>
		<th bgcolor="#99CC99">Rate</th>		
		<th bgcolor="#99CC99">Taka</th>
		<th bgcolor="#339999">Qty</th>
		<th bgcolor="#339999">Rate</th>		
		<th bgcolor="#339999">Taka</th>
		<th bgcolor="#FFCC66">Qty</th>
		<th bgcolor="#FFCC66">Rate</th>
		<th bgcolor="#FFCC66">Taka</th>
		<th bgcolor="#FFFF99">Qty</th>
		<th bgcolor="#FFFF99">Rate</th>
		<th bgcolor="#FFFF99">Taka</th>
		</tr>
		</thead><tbody>
		<? $sl=1;
		$sql="select i.item_id,i.item_name from item_info i where i.sub_group_id='".$sub_group_id."'	order by i.product_nature,i.item_name";
		
		$res	 = mysql_query($sql);
		while($row=mysql_fetch_object($res))
		{

		$pre = find_all_field_sql('select sum(item_in-item_ex) as pre_stock,sum((item_in-item_ex)*item_price) as pre_amt from journal_item where warehouse_id = "'.$_SESSION['user']['depot'].'" and ji_date<"'.$f_date.'" and item_id='.$row->item_id);
		$pre_stock = (int)$pre->pre_stock;
		$pre_price = @($pre->pre_amt/$pre->pre_stock);
		$pre_amt   = $pre->pre_amt;

		$in = find_all_field_sql('select sum(item_in) as pre_stock, sum(item_in*item_price) as pre_amt from journal_item where item_in>0 and warehouse_id = "'.$_SESSION['user']['depot'].'" and ji_date between "'.$f_date.'" and "'.$t_date.'" and item_id='.$row->item_id);
		$in_stock = (int)$in->pre_stock;
		$in_price = @($in->pre_amt/$in->pre_stock);
		$in_amt   = $pre->pre_amt;
		

		$out = find_all_field_sql('select sum(item_ex) as pre_stock, sum(item_ex*item_price) as pre_amt from journal_item where item_ex>0 and warehouse_id = "'.$_SESSION['user']['depot'].'" and ji_date between "'.$f_date.'" and "'.$t_date.'" and item_id='.$row->item_id);
		$out_stock = (int)$out->pre_stock;
		$out_price = @($out->pre_amt/$out->pre_stock);
		$out_amt   = $pre->pre_amt;
		

		
		$final_stock = $pre_stock+($in_stock-$out_stock);
		$final_price = @((($pre_stock*$pre_price)+($in_stock*$in_price)-($out_stock*$out_price))/$final_stock);
		?>
		
		<tr <?=($xx%2==0)?' bgcolor="#CCCCCC"':'';$xx++;?>>
		<td><?=$sl++;?></td>
		<td><a target="_blank" href="../ws/product_transection_report_master.php?item_id=<?=$row->item_id?>&f_date=<?=$f_date?>&t_date=<?=$t_date?>&submit=3&report=3"><?=$row->item_id?></a></td>
		<td><?=$row->item_name?></td>
		<td><?=$pre_stock?></td>
		<td><?=number_format($pre_price,2)?></td>
		<td><?=number_format(($pre_stock*$pre_price),2)?></td>

		<td><?=$in_stock?></td>
		<td><?=number_format($in_price,2)?></td>
		<td><?=number_format(($in_price*$in_stock),2)?></td>


		<td><?=$out_stock?></td>
		<td><?=number_format($out_price,2)?></td>
		<td><?=number_format(($out_price*$out_stock),2)?></td>
		<td><?=$final_stock?></td>
		<td><?=number_format($final_price,2)?></td>
		<td><?=number_format(($final_stock*$final_price),2)?></td>
</tr><? }?>
		
		</tbody>
		</table>
		<?
}
elseif($_POST['report']==1009)
{
		$report="Daily Stock Issue Report";
		?>
		<table width="100%" border="0" cellpadding="2" cellspacing="0" id="ExportTable">
		
		<thead>
		<tr><td colspan="8" style="border:0px;">
		<?
		echo '<div class="header">';
		echo '<h1>'.find_a_field('warehouse','warehouse_name','warehouse_id='.$_SESSION['user']['depot']).'</h1>';
		if(isset($report)) 
		echo '<h2>'.$report.'-'.$_POST['sales_item_type'].'</h2>';

if(isset($t_date)) 
		echo '<h2>Reporting Date : '.$t_date.'</h2>';
		echo '</div>';

		echo '<div class="date" style=" text-align:left; float:right;">Reporting Time: '.date("h:i A d-m-Y").'</div>';
		
		

		if($_POST['sales_item_type']!='')
		$dg = ' and i.sales_item_type like "%'.$_POST['sales_item_type'].'%"';
		$sql="select distinct i.item_id,i.item_name,i.sales_item_type,i.pack_size,i.finish_goods_code,i.sales_item_type from item_info i, journal_item c where  i.finish_goods_code>0 and c.item_ex>0 and c.item_id=i.item_id and c.ji_date='".$_POST['t_date']."' and i.finish_goods_code!=2000 and i.finish_goods_code!=2001 ".$dg." and c.warehouse_id='".$_SESSION['user']['depot']."' order by i.item_id";
		$res	 = mysql_query($sql);
		$rows = mysql_num_rows($res);
		while($row=mysql_fetch_object($res))
		{
		$item_code[] = $row->item_id;
		$item_name[] = $row->item_name;
		$sales_item_type[] = $row->sales_item_type;
		$pack_size[] = $row->pack_size;
		$finish_goods_code[] = $row->finish_goods_code;
		}
		
		$sql="select distinct c.chalan_no,c.driver_name from item_info i,sale_do_chalan c where c.chalan_type='Delivery' and i.item_id=c.item_id  and c.chalan_date='".$_POST['t_date']."' and c.depot_id='".$_SESSION['user']['depot']."'  ".$dg." order by c.chalan_no ";
		$res	 = mysql_query($sql);
		$chalan = mysql_num_rows($res);
		while($row=mysql_fetch_object($res))
		{$rsr_no[] = $row->chalan_no; $dsr_no[] = $row->driver_name;}
		
		$sql="select distinct c.sr_no from item_info i,journal_item c where i.item_id=c.item_id  and c.ji_date='".$_POST['t_date']."' and c.warehouse_id='".$_SESSION['user']['depot']."'  ".$dg." and (c.tr_from = 'Issue'||c.tr_from = 'Transit'||c.tr_from = 'Transfered') and c.item_ex>0 order by c.sr_no ";
		$res	 = mysql_query($sql);
		$store = mysql_num_rows($res);
		while($row=mysql_fetch_object($res))
		{$srsr_no[] = $row->sr_no; $sdsr_no[] = $row->sr_no;}
		
		$sql="select distinct m.oi_no from item_info i,warehouse_other_issue m, warehouse_other_issue_detail d where m.oi_no=d.oi_no and i.item_id=d.item_id  and m.oi_date='".$_POST['t_date']."' and m.warehouse_id='".$_SESSION['user']['depot']."'  ".$dg." order by m.oi_no ";
		$res	 = mysql_query($sql);
		$other = mysql_num_rows($res);
		while($row=mysql_fetch_object($res))
		{$orsr_no[] = $row->oi_no; $odsr_no[] = $row->oi_no;}
		
		$sql="select sum(item_ex-item_in) as item_ex,item_id,tr_no,sr_no,tr_from from journal_item where ji_date='".$_POST['t_date']."' and warehouse_id='".$_SESSION['user']['depot']."' group by item_id,sr_no";
		$res	 = mysql_query($sql);
		while($row=mysql_fetch_object($res))
		{
			if($row->tr_from=='Sales'||$row->tr_from=='SalesReturn')
			$citem_ex[$row->sr_no][$row->item_id] = $citem_ex[$row->sr_no][$row->item_id] + $row->item_ex;
			
elseif(($row->tr_from=='Issue')||($row->tr_from=='Transfered')||($row->tr_from=='Transit'))
$sitem_ex[$row->sr_no][$row->item_id] = $row->item_ex;
			
			else
			$oitem_ex[$row->sr_no][$row->item_id] = $row->item_ex;
		}
		?>
		</td></tr>
		<tr>
		  <th rowspan="2">S/L</th>
		  <th rowspan="2">Item Name </th>
		  <th colspan="<?=$chalan?>"><div align="center">Party Chalan</div></th>
		  <th bgcolor="#99CC99" style="text-align:center">Total</th>
		  <th colspan="<?=$store?>"><div align="center">Store Chalan</div></th>
		  <th bgcolor="#99CC99" style="text-align:center">Total</th>
		  <th colspan="<?=$other?>"><div align="center">Other Issue</div></th>
		  <th bgcolor="#99CC99" style="text-align:center">Total</th>
		  <!--<th bgcolor="#99CC99" style="text-align:center">ALL-TOTAL</th>-->
		  </tr>
		
			<tr>
				<? for($j=0;$j<$chalan;$j++){?>
				<th height="100" bgcolor="#339999" style="width:5px;"><font class="vertical-text"><?=$dsr_no[$j]?>
			  </font></th>
				<? }?>                      
				<th bgcolor="#339999" style="font-size:10px; font-weight:normal; padding:1px;">Ctn-Pcs</th>
				<? for($j=0;$j<$store;$j++){?>
			  <th height="100" bgcolor="#339999" style="width:5px;"><p><font class="vertical-text"><?=$srsr_no[$j]?></font></p></th>
				<? }?>                      
				<th bgcolor="#339999" style="font-size:10px; font-weight:normal; padding:1px;">Ctn-Pcs</th>
				<? for($j=0;$j<$other;$j++){?>
				<th height="100" bgcolor="#339999" style="width:5px;"><p><font class="vertical-text"><?=$odsr_no[$j]?></font></p></th>
				<? }?>                      
				<th bgcolor="#339999" style="font-size:10px; font-weight:normal; padding:1px;">Ctn-Pcs</th>
				<th bgcolor="#339999" style="font-size:10px; font-weight:normal; padding:1px;">Ctn-Pcs</th>
			</tr>
		</thead><tbody>
		<? for($x=0;$x<$rows;$x++){?>
				<tr <?=($xx%2==0)?' bgcolor="#CCCCCC"':'';$xx++;?>>
				<td><?=++$sl;?></td>
				<td><?=$item_name[$x]?>(<?=$finish_goods_code[$x]?>)</td>
<!--1-->
		<? for($j=0;$j<$chalan;$j++){?>
				<td style="font-family:Arial, Helvetica, sans-serif;size:11px; padding:0px;">
					<? if($citem_ex[$rsr_no[$j]][$item_code[$x]]>0)
					{
						$total[$item_code[$x]] = $total[$item_code[$x]] + $citem_ex[$rsr_no[$j]][$item_code[$x]];
						$ctotal[$item_code[$x]] = $ctotal[$item_code[$x]] + $citem_ex[$rsr_no[$j]][$item_code[$x]];
						echo (int)(($citem_ex[$rsr_no[$j]][$item_code[$x]])/$pack_size[$x]); 
						if((($citem_ex[$rsr_no[$j]][$item_code[$x]])%$pack_size[$x])>0) 
						echo '-'.(($citem_ex[$rsr_no[$j]][$item_code[$x]])%$pack_size[$x]);
					}?>
				</td>
		<? }?>
				<td>
					<?
					if($total[$item_code[$x]]>0)
					{
						echo (int)(($total[$item_code[$x]])/$pack_size[$x]); 
						if((($total[$item_code[$x]])%$pack_size[$x])>0) 
						echo '-'.(($total[$item_code[$x]])%$pack_size[$x]);
					}
					?>
				</td>
				
				
<!--2-->		
		<? for($j=0;$j<$store;$j++){?>
				<td style="font-family:Arial, Helvetica, sans-serif;size:11px; padding:0px;">
					<? if($sitem_ex[$srsr_no[$j]][$item_code[$x]]>0)
					{
						$total[$item_code[$x]] = $total[$item_code[$x]] + $sitem_ex[$srsr_no[$j]][$item_code[$x]];
						$stotal[$item_code[$x]] = $stotal[$item_code[$x]] + $sitem_ex[$srsr_no[$j]][$item_code[$x]];
						echo (int)(($sitem_ex[$srsr_no[$j]][$item_code[$x]])/$pack_size[$x]); 
						if((($sitem_ex[$srsr_no[$j]][$item_code[$x]])%$pack_size[$x])>0) 
						echo '-'.(($sitem_ex[$srsr_no[$j]][$item_code[$x]])%$pack_size[$x]);
					}?>
				</td>
		<? }?>
				<td>
					<?
					if($total[$item_code[$x]]>0)
					{
						echo (int)(($stotal[$item_code[$x]])/$pack_size[$x]); 
						if((($stotal[$item_code[$x]])%$pack_size[$x])>0) 
						echo '-'.(($stotal[$item_code[$x]])%$pack_size[$x]);
					}
					?>
				</td>
				
				
<!--3-->				
		<? for($j=0;$j<$other;$j++){?>
				<td style="font-family:Arial, Helvetica, sans-serif;size:11px; padding:0px;">
					<? if($oitem_ex[$orsr_no[$j]][$item_code[$x]]>0)
					{
						$total[$item_code[$x]] = $total[$item_code[$x]] + $oitem_ex[$orsr_no[$j]][$item_code[$x]];
						$ototal[$item_code[$x]] = $ototal[$item_code[$x]] + $oitem_ex[$orsr_no[$j]][$item_code[$x]];
						echo (int)(($oitem_ex[$orsr_no[$j]][$item_code[$x]])/$pack_size[$x]); 
						if((($oitem_ex[$orsr_no[$j]][$item_code[$x]])%$pack_size[$x])>0) 
						echo '-'.(($oitem_ex[$orsr_no[$j]][$item_code[$x]])%$pack_size[$x]);
					}?>
				</td>
		<? }?>
				<td>
					<?
					if($total[$item_code[$x]]>0)
					{
						echo (int)(($ototal[$item_code[$x]])/$pack_size[$x]); 
						if((($ototal[$item_code[$x]])%$pack_size[$x])>0) 
						echo '-'.(($ototal[$item_code[$x]])%$pack_size[$x]);
					}
					?>
				</td>
								<td>
					<?
					if($total[$item_code[$x]]>0)
					{
						echo (int)(($total[$item_code[$x]])/$pack_size[$x]); 
						if((($total[$item_code[$x]])%$pack_size[$x])>0) 
						echo '-'.(($total[$item_code[$x]])%$pack_size[$x]);
					}
					?>
				</td>
				</tr>
		<? }?>
		</tbody>
		</table>
		<?
}






elseif($_POST['report']==1006)
{
		$report="Product Movement Detail Report (Depot)";
		?>
		<table width="100%" border="0" cellpadding="2" cellspacing="0" id="ExportTable">
		
		<thead>
		<tr><td colspan="36" style="border:0px;">
		<?
		echo '<div class="header">';
		echo '<h1>'.find_a_field('warehouse','warehouse_name','warehouse_id='.$_SESSION['user']['depot']).'</h1>';
		if(isset($report)) 
		echo '<h2>'.$report.'</h2>';

if(isset($t_date)) 
		echo '<h2>Date Interval : '.$f_date.' To '.$t_date.'</h2>';
		echo '</div>';

		echo '<div class="date" style=" text-align:left; float:right;">Reporting Time: '.date("h:i A d-m-Y").'</div>';
		?>
		</td></tr>
		<tr>
		  <th rowspan="3">S/L</th>
		  <th rowspan="3">FG</th>
		  <th rowspan="3">Item Name </th>
		  <th rowspan="3">Grp</th>
		  <th colspan="3" rowspan="2"><div align="center">Opening</div></th>
		  <th colspan="12" bgcolor="#339999" style="text-align:center">Item Out </th>
		  <th colspan="12" bgcolor="#99CC99" style="text-align:center">Item In </th>
		  <th colspan="3" rowspan="2"><div align="center">Closing</div></th>
		</tr>
		<tr>
		  <th colspan="3" bgcolor="#339999" style="text-align:center">Party Chalan </th>
		  <th colspan="3" bgcolor="#339999" style="text-align:center">Store Chalan </th>
		  <th colspan="3" bgcolor="#339999" style="text-align:center">Other Issue </th>
		  <th colspan="3" bgcolor="#339999" style="text-align:center">Total Issue </th>
		  <th colspan="3" bgcolor="#339999" style="text-align:center">Sales Return </th>
		  <th colspan="3" bgcolor="#339999" style="text-align:center">Store Chalan </th>
		  <th colspan="3" bgcolor="#339999" style="text-align:center">Transfer Receive </th>
		  <th colspan="3" bgcolor="#339999" style="text-align:center">Total Receive </th>
		  </tr>
		<tr>
		  <th bgcolor="#339999">Crt</th>
		  <th bgcolor="#339999">Pcs</th>
		  <th bgcolor="#339999">TPcs</th>
		  <th bgcolor="#339999">Crt</th>
		  <th bgcolor="#339999">Pcs</th>
		  <th bgcolor="#339999">TPcs</th>
		  <th bgcolor="#339999">Crt</th>
		  <th bgcolor="#339999">Pcs</th>
		  <th bgcolor="#339999">TPcs</th>
		  <th bgcolor="#339999">Crt</th>
		  <th bgcolor="#339999">Pcs</th>
		  <th bgcolor="#339999">TPcs</th>
		  <th bgcolor="#339999">Crt</th>
		  <th bgcolor="#339999">Pcs</th>
		  <th bgcolor="#339999">TPcs</th>
		  <th bgcolor="#339999">Crt</th>
		  <th bgcolor="#339999">Pcs</th>
		  <th bgcolor="#339999">TPcs</th>
		  <th bgcolor="#339999">Crt</th>
		  <th bgcolor="#339999">Pcs</th>
		  <th bgcolor="#339999">TPcs</th>
		  <th bgcolor="#339999">Crt</th>
		  <th bgcolor="#339999">Pcs</th>
		  <th bgcolor="#339999">TPcs</th>
		  <th bgcolor="#339999">Crt</th>
		  <th bgcolor="#339999">Pcs</th>
		  <th bgcolor="#339999">TPcs</th>
		  <th bgcolor="#339999">Crt</th>
		  <th bgcolor="#339999">Pcs</th>
		  <th bgcolor="#339999">TPcs</th>
		</tr>
		</thead><tbody>
		<? $sl=1;
if($item_id>0) 				{$item_con=' and i.item_id='.$item_id;} 
		$sql="select i.item_id,i.item_name,i.sales_item_type,i.pack_size,i.finish_goods_code,i.sales_item_type from item_info i where 1  ".$item_con." order by i.item_id";
		$table = 'journal_item';
		$show_in = 'sum(item_in-item_ex)';
		$show_ex = 'sum(item_ex-item_in)';

		$res	 = mysql_query($sql);
		while($row=mysql_fetch_object($res))
		{
		echo '';
		$pre_con = 'warehouse_id="'.$_SESSION['user']['depot'].'" and item_id="'.$row->item_id.'" and ji_date < "'.$f_date.'"';
		$pro_con = 'warehouse_id="'.$_SESSION['user']['depot'].'" and item_id="'.$row->item_id.'" and ji_date <= "'.$t_date.'"';
		$con = 'warehouse_id="'.$_SESSION['user']['depot'].'" and item_id="'.$row->item_id.'" and ji_date between "'.$f_date.'" and "'.$t_date.'"';
		$open = find_a_field($table,$show_in,$pre_con);
		$issue_in = find_a_field($table,'sum(item_in)',$con.' and tr_from = "Issue"');
		$return = find_a_field($table,'sum(item_in)',$con.' and tr_from = "Return"');
		$total_in = find_a_field($table,'sum(item_in)',$con);
		$otr_in = $total_in - ($issue_in + $return);

		$sales = find_a_field($table,'sum(item_ex)',$con.' and tr_from = "Sales"');
		$issue_ex = find_a_field($table,'sum(item_ex)',$con.' and tr_from = "Issue"');
		$total_ex = find_a_field($table,'sum(item_ex)',$con);
		$otr_ex = $total_ex - ($issue_ex + $sales);
		$closing = find_a_field($table,$show_in,$pro_con);

		?>
		
		<tr <?=($xx%2==0)?' bgcolor="#CCCCCC"':'';$xx++;?>>
		<td><?=$sl++;?></td>
		<td><?=$row->finish_goods_code?></td>
		<td><?=$row->item_name?></td>
		<td><?=$row->sales_item_type?></td>
		
		<? ssd($open,$row->pack_size);?>
		<? ssd($sales,$row->pack_size);?>
		<? ssd($issue_ex,$row->pack_size);?>
		<? ssd($otr_ex,$row->pack_size);?>
		<? ssd($total_ex,$row->pack_size);?>
		<? ssd($return,$row->pack_size);?>
		<? ssd($issue_in,$row->pack_size);?>
		<? ssd($otr_in,$row->pack_size);?>
		<? ssd($total_in,$row->pack_size);?>
		<? ssd($closing,$row->pack_size);?>
		</tr><? }?>
		
		</tbody>
		</table>
		<?
}

elseif($_POST['report']==1007)
{		if($item_id>0) 				{$item_con=' and i.item_id='.$item_id;} 
		$report="Product Movement Summary Report (Depot)";
		?>
		<table width="100%" border="0" cellpadding="2" cellspacing="0" id="ExportTable">
		
		<thead>
		<tr><td colspan="17" style="border:0px;">
		<?
		echo '<div class="header">';
		echo '<h1>'.find_a_field('warehouse','warehouse_name','warehouse_id='.$_SESSION['user']['depot']).'</h1>';
		if(isset($report)) 
		echo '<h2>'.$report.'</h2>';

if(isset($t_date)) 
		echo '<h2>Date Interval : '.$f_date.' To '.$t_date.'</h2>';
		echo '</div>';

		echo '<div class="date" style=" text-align:left; float:right;">Reporting Time: '.date("h:i A d-m-Y").'</div>';
		?>
		</td></tr>
		<tr>
		  <th rowspan="2">S/L</th>
		  <th rowspan="2">Item Name </th>
		  <th rowspan="2">Grp</th>
		  <th colspan="3"><div align="center">Opening</div></th>
		  <th colspan="3" bgcolor="#339999" style="text-align:center">Item Out/Total Issue </th>
		  <th colspan="3" bgcolor="#99CC99" style="text-align:center">Item In/Total Receive </th>
		  <th colspan="3"><div align="center">Closing</div></th>
		</tr>
		
		<tr>
		  <th bgcolor="#339999">Crt</th>
		  <th bgcolor="#339999">Pcs</th>
		  <th bgcolor="#339999">TPcs</th>
		  <th bgcolor="#339999">Crt</th>
		  <th bgcolor="#339999">Pcs</th>
		  <th bgcolor="#339999">TPcs</th>
		  <th bgcolor="#339999">Crt</th>
		  <th bgcolor="#339999">Pcs</th>
		  <th bgcolor="#339999">TPcs</th>
		  <th bgcolor="#339999">Crt</th>
		  <th bgcolor="#339999">Pcs</th>
		  <th bgcolor="#339999">TPcs</th>
		</tr>
		</thead><tbody>
		<? $sl=1;
		if($item_id>0) 				{$item_con=' and i.item_id='.$item_id;} 
		$sql="select i.item_id,i.item_name,i.sales_item_type,i.pack_size,i.finish_goods_code,i.sales_item_type from item_info i where i.sub_group_id=1096000300010000 ".$item_con." order by i.item_id";
		$table = 'journal_item';
		$show_in = 'sum(item_in-item_ex)';
		$show_ex = 'sum(item_ex-item_in)';

		$res	 = mysql_query($sql);
		while($row=mysql_fetch_object($res))
		{
		echo '';
		$pre_con = 'warehouse_id="'.$_SESSION['user']['depot'].'" and item_id="'.$row->item_id.'" and ji_date < "'.$f_date.'"';
		$pro_con = 'warehouse_id="'.$_SESSION['user']['depot'].'" and item_id="'.$row->item_id.'" and ji_date <= "'.$t_date.'"';
		$con = 'warehouse_id="'.$_SESSION['user']['depot'].'" and item_id="'.$row->item_id.'" and ji_date between "'.$f_date.'" and "'.$t_date.'"';
		$open = find_a_field($table,$show_in,$pre_con);
		$total_in = find_a_field($table,'sum(item_in)',$con);
		$total_ex = find_a_field($table,'sum(item_ex)',$con);
		$closing = find_a_field($table,$show_in,$pro_con);

		?>
		
		<tr <?=($xx%2==0)?' bgcolor="#CCCCCC"':'';$xx++;?>>
		<td><?=$sl++;?></td>
		<td><?=$row->item_name?></td>
		<td><?=$row->sales_item_type?></td>
		
		<? ssd($open,$row->pack_size);?>
		<? ssd($total_ex,$row->pack_size,'#99FFFF');?>
		<? ssd($total_in,$row->pack_size,'#FFCCFF');?>
		<? ssd($closing,$row->pack_size);?>
		</tr><? }?>
		
		</tbody>
		</table>
		<?
}

elseif(isset($sql)&&$sql!='') echo report_create($sql,1,$str);

?>
</div>
</body>
</html>
</body>
</html>