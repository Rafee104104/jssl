<?
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

session_start();
require_once "../../../assets/support/inc.all.php";
//
//require "../../../assets/engine/tools/check.php";
//
//
//
//require "../../../assets/engine/configure/db_connect.php";
//
//
//
//
//require "../../../assets/engine/tools/my.php";
//
//
//
//
//
//
//
//require "../../../assets/engine/tools/report.class.php";
//

date_default_timezone_set('Asia/Dhaka');

if(isset($_REQUEST['submit'])&&isset($_REQUEST['report'])&&$_REQUEST['report']>0)


{


	if((strlen($_REQUEST['t_date'])==10))


	{


		$t_date=$_REQUEST['t_date'];

		$f_date=$_REQUEST['f_date'];


	}


if($_REQUEST['product_group']!='')  $product_group=$_REQUEST['product_group'];



if($_REQUEST['item_brand']!='') 	$item_brand=$_REQUEST['item_brand'];



if($_REQUEST['item_id']>0) 		    $item_id=$_REQUEST['item_id'];



if($_REQUEST['dealer_code']>0) 	    $dealer_code=$_REQUEST['dealer_code'];



if($_REQUEST['dealer_type']!='') 	$dealer_type=$_REQUEST['dealer_type'];

if($_REQUEST['status']!='') 		$status=$_REQUEST['status'];



if($_REQUEST['do_no']!='') 		    $do_no=$_REQUEST['do_no'];



if($_REQUEST['area_id']!='') 		$area_id=$_REQUEST['area_id'];



if($_REQUEST['zone_id']!='') 		$zone_id=$_REQUEST['zone_id'];



if($_REQUEST['region_id']>0) 		$region_id=$_REQUEST['region_id'];



if($_REQUEST['depot_id']!='') 		$depot_id=$_REQUEST['depot_id'];







$item_info = find_all_field('item_info','','item_id='.$item_id);







if(isset($item_brand)) 			{$item_brand_con=' and i.item_brand="'.$item_brand.'"';} 



if(isset($dealer_code)) 		{$dealer_con=' and a.dealer_code="'.$dealer_code.'"';} 



 



if(isset($t_date)) 				{$to_date=$t_date; $fr_date=$f_date; $date_con=' and m.do_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



if(isset($product_group)) 		



{



if($product_group=='ABCD')



$pg_con=' and d.product_group!="M"';



else



$pg_con=' and d.product_group="'.$product_group.'"';



} 



if(isset($dealer_type)) 		{$dtype_con=' and d.dealer_type="'.$dealer_type.'" ';}



 







if(isset($dealer_code)) 		{$dealer_con=' and m.dealer_code='.$dealer_code;} 



if(isset($item_id))				{$item_con=' and i.item_id='.$item_id;} 



if(isset($depot_id)) 			{$depot_con=' and d.depot="'.$depot_id.'"';} 



//if(isset($dealer_code)) 		{$dealer_con=' and a.dealer_code="'.$dealer_code.'"';} 



//if(isset($product_group)) 	{$pg_con=' and d.product_group="'.$product_group.'"';} 



//if(isset($zone_id)) 			{$zone_con=' and a.buyer_id='.$zone_id;}



//if(isset($region_id)) 		{$region_con=' and d.id='.$region_id;}



//if(isset($item_id)) 			{$item_con=' and b.item_id='.$item_id;} 



//if(isset($status)) 			{$status_con=' and a.status="'.$status.'"';} 



//if(isset($do_no)) 			{$do_no_con=' and a.do_no="'.$do_no.'"';} 



//if(isset($t_date)) 			{$to_date=$t_date; $fr_date=$f_date; $order_con=' and o.order_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



//if(isset($t_date)) 			{$to_date=$t_date; $fr_date=$f_date; $chalan_con=' and c.chalan_date between \''.$fr_date.'\' and \''.$to_date.'\'';}







switch ($_REQUEST['report']) {



    case 1:



	$report="Delivery Order Summary Brief";



	break;

    case 8102521:

	$report="Loan Report (Ledger Wise)";
	break;



	case 2001:



	$report="Sales Commission Report";



	break;

	case 81025:
		$report='Loading Report';
		break;
		
		case 810252:
		$report='Unloading Report';
		break;
		case 8102522:
		$report='Plot Report';
		break;

	case 404:



	$report="Olot Palot Report";



	break;

    case 1999:


















	$report="DO Report for Scratch Card";



	$product_group = 'A';



	break;



case 2002:



		$report="Last Year Vs This Year Item Wise Sales Report (Periodical)";



		if(isset($t_date)) {



		$to_date=$t_date; $fr_date=$f_date; 



		$yfr_date=(date(('Y'),strtotime($f_date))-1).date(('-m-d'),strtotime($f_date));



		$yto_date=(date(('Y'),strtotime($f_date))-1).date(('-m-d'),strtotime($t_date));



		$date_con=' and a.chalan_date between \''.$fr_date.'\' and \''.$to_date.'\'';



		$ydate_con=' and a.chalan_date between \''.$yfr_date.'\' and \''.$yto_date.'\'';



		}



		if(isset($depot_id)) 			{$con.=' and d.depot="'.$depot_id.'"';}



		if(isset($dealer_code)) 		{$con.=' and d.dealer_code="'.$dealer_code.'"';} 



		if(isset($dealer_type)) 		{$con.=' and d.dealer_type="'.$dealer_type.'"';}



		if(isset($product_group)) 		{$pg_con=' and i.sales_item_type like "%'.$product_group.'%"';}



		



		$sql='select 



		i.finish_goods_code as fg,



		i.item_id,



		i.item_name,



		i.unit_name as unit,



		i.sales_item_type ,



		i.item_brand as brand,



		i.pack_size pkt



		from item_info i where  i.finish_goods_code>0 and i.status="Active" and i.item_brand!="Promotional" and finish_goods_code!=2000 and finish_goods_code!=2001 and finish_goods_code!=2002 and i.item_brand!="Memo" and finish_goods_code not between 9000 and 10000 and i.item_brand!=""  '.$item_brand_con.$pg_con.' 



	 order by i.finish_goods_code';



if(isset($area_id)) 		{$acon.=' and a.AREA_CODE="'.$area_id.'"';}



if(isset($zone_id)) 		{$acon.=' and z.ZONE_CODE="'.$zone_id.'"';}



if(isset($region_id)) 		{$acon.=' and b.BRANCH_ID="'.$region_id.'"';}



 



		$sql2='select 



		i.item_id,



		i.pack_size as pkt,



		sum(a.total_unit) mod i.pack_size as pcs,



		sum(a.total_unit) qty,		



		sum(a.total_unit*a.unit_price) as sale_price



		from dealer_info d, sale_do_details m,sale_do_chalan a, item_info i, area ar, branch b, zon z where ar.ZONE_ID=z.ZONE_CODE and d.area_code=ar.AREA_CODE and z.REGION_ID=b.BRANCH_ID and d.dealer_code=m.dealer_code and m.id=a.order_no  and i.item_brand!="" and  



	a.unit_price>0 and a.item_id=i.item_id '.$acon.$con.$date_con.$warehouse_con.$item_con.$item_brand_con.$dtype_con.' 



	group by  a.item_id';



	$query2 = mysql_query($sql2);



	while($data2 = mysql_fetch_object($query2))



	{



	$this_year_sale_amt[$data2->item_id] = $data2->sale_price;



	$this_year_sale_qty[$data2->item_id] = $data2->qty;



	}







	



			$sql2='select 



		i.item_id,



		i.pack_size as pkt,



		sum(a.total_unit) mod i.pack_size as pcs,



		sum(a.total_unit) qty,		



		sum(a.total_unit*a.unit_price) as sale_price



		from dealer_info d, sale_do_details m,sale_do_chalan a, item_info i, area ar, branch b, zon z where ar.ZONE_ID=z.ZONE_CODE and d.area_code=ar.AREA_CODE and z.REGION_ID=b.BRANCH_ID and d.dealer_code=m.dealer_code and m.id=a.order_no  and i.item_brand!="" and  



	a.unit_price>0 and a.item_id=i.item_id '.$acon.$con.$ydate_con.$warehouse_con.$item_con.$item_brand_con.$dtype_con.' 



	group by  a.item_id';



	



	$query2 = mysql_query($sql2);



	while($data2 = mysql_fetch_object($query2))



	{



	$last_year_sale_amt[$data2->item_id] = $data2->sale_price;



	$last_year_sale_qty[$data2->item_id] = $data2->qty;



	}



	break;



	



		case 2003:



		$report="Last Year Vs This Year Single Item Dealer Wise Sales Report (Periodical)";



		if(isset($t_date)) {



		$to_date=$t_date; $fr_date=$f_date; 



		$yfr_date=(date(('Y'),strtotime($f_date))-1).date(('-m-d'),strtotime($f_date));



		$yto_date=(date(('Y'),strtotime($f_date))-1).date(('-m-d'),strtotime($t_date));



		



		$date_con=' and a.chalan_date between \''.$fr_date.'\' and \''.$to_date.'\'';



		$ydate_con=' and a.chalan_date between \''.$yfr_date.'\' and \''.$yto_date.'\'';



		}



		if(isset($product_group)) 			{$product_group_con.=' and d.product_group="'.$product_group.'"';}



		if(isset($depot_id)) 				{$con.=' and d.depot="'.$depot_id.'"';}



		if(isset($dealer_code)) 			{$con.=' and d.dealer_code="'.$dealer_code.'"';} 



		if(isset($dealer_type)) 			{$con.=' and d.dealer_type="'.$dealer_type.'"';}



		if(isset($item_id))		 			{$con.=' and a.item_id="'.$item_id.'"';}



		



if(isset($area_id)) 		{$acon.=' and a.AREA_CODE="'.$area_id.'"';}



if(isset($zone_id)) 		{$acon.=' and z.ZONE_CODE="'.$zone_id.'"';}



if(isset($region_id)) 		{$acon.=' and b.BRANCH_ID="'.$region_id.'"';}



		$sql='select 



		dealer_name_e dealer_name,



		dealer_code,



		AREA_NAME area_name,



		ZONE_NAME zone_name,



		BRANCH_NAME region_name



		from dealer_info d, area a, branch b, zon z where a.ZONE_ID=z.ZONE_CODE and z.REGION_ID=b.BRANCH_ID and d.dealer_type="Distributor" and d.area_code=a.AREA_CODE  '.$product_group_con.$acon.' 



	    order by dealer_name_e';







		$sql2='select 



		d.dealer_code,



		sum(a.total_unit) div i.pack_size as pkt,



		sum(a.total_unit) qty,		



		sum(a.total_unit*a.unit_price) as sale_price



		from dealer_info d, sale_do_details m, sale_do_chalan a, item_info i where 



		d.dealer_code=m.dealer_code and a.item_id=i.item_id and m.id=a.order_no  and i.item_brand!="" and  



	a.unit_price>0 '.$con.$date_con.$product_group_con.$item_con.' 



	group by  d.dealer_code';



	$query2 = mysql_query($sql2);



	while($data2 = mysql_fetch_object($query2))



	{



	$this_year_sale_amt[$data2->dealer_code] = $data2->sale_price;



	$this_year_sale_qty[$data2->dealer_code] = $data2->qty;



	$this_year_sale_pkt[$data2->dealer_code] = $data2->pkt;



	}



	$sql2='select 



		i.item_id,



		sum(a.total_unit) div i.pack_size as pkt,



		sum(a.total_unit) qty,		



		sum(a.total_unit*a.unit_price) as sale_price



		from dealer_info d, sale_do_details m,sale_do_chalan a, item_info i where 



		d.dealer_code=m.dealer_code and m.id=a.order_no  and i.item_brand!="" and  



	a.unit_price>0  and a.item_id=i.item_id '.$con.$ydate_con.$warehouse_con.$item_con.$item_brand_con.$dtype_con.' 



	group by  a.item_id';



	$sql2='select 



		d.dealer_code,



		sum(a.total_unit) div i.pack_size as pkt,



		sum(a.total_unit) qty,		



		sum(a.total_unit*a.unit_price) as sale_price



		from dealer_info d, sale_do_details m, sale_do_chalan a, item_info i where 



		d.dealer_code=m.dealer_code and a.item_id=i.item_id and m.id=a.order_no  and i.item_brand!="" and  



	a.unit_price>0 '.$con.$ydate_con.$product_group_con.$item_con.' 



	group by  d.dealer_code';



	$query2 = mysql_query($sql2);



	while($data2 = mysql_fetch_object($query2))



	{



	$last_year_sale_amt[$data2->dealer_code] = $data2->sale_price;



	$last_year_sale_qty[$data2->dealer_code] = $data2->qty;



	$last_year_sale_pkt[$data2->dealer_code] = $data2->pkt;



	}



	break;



	



		case 20031:



		$report="Last Year Vs This Year Single Item Region Wise Sales Report (Periodical)";



		if(isset($t_date)) 



		{



		$to_date=$t_date; $fr_date=$f_date; 



		$yfr_date=(date(('Y'),strtotime($f_date))-1).date(('-m-d'),strtotime($f_date));



		$yto_date=(date(('Y'),strtotime($f_date))-1).date(('-m-d'),strtotime($t_date));



		



		$date_con=' and a.chalan_date between \''.$fr_date.'\' and \''.$to_date.'\'';



		$ydate_con=' and a.chalan_date between \''.$yfr_date.'\' and \''.$yto_date.'\'';



		}



		if(isset($product_group)) 			{$product_group_con.=' and d.product_group="'.$product_group.'"';}



		if(isset($depot_id)) 				{$con.=' and d.depot="'.$depot_id.'"';}



		if(isset($dealer_code)) 			{$con.=' and d.dealer_code="'.$dealer_code.'"';} 



		if(isset($dealer_type)) 			{$con.=' and d.dealer_type="'.$dealer_type.'"';}



		if(isset($item_id))		 			{$con.=' and a.item_id="'.$item_id.'"';}



		



if(isset($area_id)) 		{$acon.=' and a.AREA_CODE="'.$area_id.'"';}



if(isset($zone_id)) 		{$acon.=' and z.ZONE_CODE="'.$zone_id.'"';}



if(isset($region_id)) 		{$acon.=' and b.BRANCH_ID="'.$region_id.'"';}



		$sql='select 







		BRANCH_NAME region_name,



		BRANCH_ID



		from dealer_info d, area a, branch b, zon z 



		where a.ZONE_ID=z.ZONE_CODE and z.REGION_ID=b.BRANCH_ID and d.dealer_type="Distributor" and d.area_code=a.AREA_CODE  '.$product_group_con.$acon.' 



	    group by BRANCH_NAME';







		$sql2='select 



		BRANCH_ID,



		sum(a.total_unit) div i.pack_size as pkt,



		sum(a.total_unit) qty,		



		sum(a.total_unit*a.unit_price) as sale_price



		from dealer_info d, sale_do_details m, sale_do_chalan a, item_info i, area ar, branch b, zon z 



		where 



		d.dealer_code=m.dealer_code and a.item_id=i.item_id and m.id=a.order_no  and i.item_brand!="" and  



		ar.ZONE_ID=z.ZONE_CODE and z.REGION_ID=b.BRANCH_ID and d.dealer_type="Distributor" and d.area_code=ar.AREA_CODE and 



	a.unit_price>0 '.$con.$date_con.$product_group_con.$item_con.' 



	group by BRANCH_NAME';



	$query2 = mysql_query($sql2);



	while($data2 = mysql_fetch_object($query2))



	{



	$this_year_sale_amt[$data2->BRANCH_ID] = $data2->sale_price;



	$this_year_sale_qty[$data2->BRANCH_ID] = $data2->qty;



	$this_year_sale_pkt[$data2->BRANCH_ID] = $data2->pkt;



	}







	$sql2='select 



		BRANCH_ID,



		sum(a.total_unit) div i.pack_size as pkt,



		sum(a.total_unit) qty,		



		sum(a.total_unit*a.unit_price) as sale_price



		from dealer_info d, sale_do_details m, sale_do_chalan a, item_info i , area ar, branch b, zon z  where 



		d.dealer_code=m.dealer_code and a.item_id=i.item_id and m.id=a.order_no  and i.item_brand!="" and  



		ar.ZONE_ID=z.ZONE_CODE and z.REGION_ID=b.BRANCH_ID and d.dealer_type="Distributor" and d.area_code=ar.AREA_CODE and 



	a.unit_price>0 '.$con.$ydate_con.$product_group_con.$item_con.' 



	group by  BRANCH_NAME';



	$query2 = mysql_query($sql2);



	while($data2 = mysql_fetch_object($query2))



	{



	$last_year_sale_amt[$data2->BRANCH_ID] = $data2->sale_price;



	$last_year_sale_qty[$data2->BRANCH_ID] = $data2->qty;



	$last_year_sale_pkt[$data2->BRANCH_ID] = $data2->pkt;



	}



	break;



    case 1991:







$report="Delivery Order Brief Report with Chalan Amount";



	break;



case 191:



$report="Delivery Order  Report (At A Glance)";



break;



	



    case 2:



		$report="Undelivered Do Details Report";







$sql = "select m.do_no,m.do_date,concat(d.dealer_code,'- ',d.dealer_name_e)  as dealer_name,d.product_group as grp,w.warehouse_name as depot,concat(i.finish_goods_code,'- ',item_name) as item_name,o.pkt_unit as crt,o.dist_unit as pcs,o.total_amt,m.rcv_amt,m.payment_by as PB from 



sale_do_master m,sale_do_details o, item_info i,dealer_info d , warehouse w



where m.do_no=o.do_no and i.item_id=o.item_id and m.dealer_code=d.dealer_code and m.status in ('CHECKED','COMPLETED') and w.warehouse_id=d.depot ".$date_con.$item_con.$depot_con.$dtype_con.$dealer_con.$item_brand_con;



	break;



	case 3:



$report="Undelivered Do Report Dealer Wise";



if(isset($t_date)) {$to_date=$t_date; $fr_date=$f_date; $date_con=' and m.do_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



if(isset($dealer_code)) {$dealer_con=' and m.dealer_code='.$dealer_code;} 



if(isset($item_id)){$item_con=' and i.item_id='.$item_id;} 



if(isset($depot_id)) {$depot_con=' and d.depot="'.$depot_id.'"';} 



	break;



	case 4:



	if($_REQUEST['do_no']>0)



header("Location:work_order_print.php?wo_id=".$_REQUEST['wo_id']);



	break;

	

	

	

	

	

	

	

	

	

	

case 1003:





$report="Corporate Customer Information";

if($_POST['dealer_name_e']!='')

$con.=' and a.dealer_name_e like "%'.$_POST['dealer_name_e'].'%"';

if($_POST['dealer_code']!='')



$con.=' and a.dealer_code = "'.$_POST['dealer_code'].'"';



if($_POST['division_code']!='')



$con.=' and a.division_code = "'.$_POST['division_code'].'"';



elseif($_POST['district_code']!='')



$con.=' and a.district_code = "'.$_POST['district_code'].'"';



elseif($_POST['thana_code']!='')



$con.=' and a.thana_code = "'.$_POST['thana_code'].'"';



if($_POST['region_code']!='')

$con.=' and a.area_code in (select p.AREA_CODE from area p,zon z where p.ZONE_ID=z.ZONE_CODE and z.REGION_ID="'.$_POST['zone_code'].'") ';

elseif($_POST['zone_code']!='')



$con.=' and a.area_code in (select AREA_CODE from area where ZONE_ID="'.$_POST['zone_code'].'") ';



elseif($_POST['area_code']!='')



$con.=' and a.area_code = "'.$_POST['area_code'].'"';



if($_POST['canceled']!='')



$con.=' and a.canceled = "'.$_POST['canceled'].'"';



if($_POST['depot']!='')



$con.=' and a.depot = "'.$_POST['depot'].'"';

if($_POST['product_group']!='')



$con.=' and a.product_group = "'.$_POST['product_group'].'"';

if($_POST['depot']!='')



$con.=' and a.mobile_no = "'.$_POST['mobile_no'].'"';



if($_POST['team_name']!='')



$con.=' and a.team_name = "'.$_POST['team_name'].'"';



		 		  $sql="select a.dealer_code as code,a.account_code as ledger_code,a.dealer_name_e as customer_name ,(select ledger_name from accounts_ledger where ledger_id=a.account_code) as ledger_name,(select sum(dr_amt-cr_amt) from journal where ledger_id=a.account_code) as closing_balance,a.mobile_no as mobile_no,a.dealer_name_b as designation , a.propritor_name_b as contact_person , a.address_e as address, a.canceled as active, a.commission from dealer_info a



		 where a.dealer_type='Corporate'  ".$con."  order by a.dealer_code asc";



		// , area ar, zon z, branch r;

		 //,a.team_name as team, ar.AREA_NAME as area, z.ZONE_NAME as zone, r.BRANCH_NAME as region;





		 //ar.AREA_CODE=a.area_code and z.ZONE_CODE=ar.ZONE_ID and r.BRANCH_ID=z.REGION_ID;



		break;

		

		

		

		

		



	case 5:



if(isset($t_date)) {$to_date=$t_date; $fr_date=$f_date; $date_con=' and m.do_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



if(isset($product_group)) 	{$pg_con=' and d.product_group="'.$product_group.'"';} 



$report="Delivery Order Brief Report (Region Wise)";



	break;



		case 6:



	if($_REQUEST['do_no']>0)



header("Location:../report/do_view.php?v_no=".$_REQUEST['do_no']);



	break;



	    case 7:



		$report="Item wise DO Report";



		if(isset($t_date)) 	{$to_date=$t_date; $fr_date=$f_date; $date_con=' and m.do_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



		if(isset($product_group)) 		{$pg_con=' and d.product_group="'.$product_group.'"';} 



		



		$sql = "select 



		i.finish_goods_code as code, 



		i.item_name, i.item_brand, 



		i.sales_item_type as `group`,



		floor(sum(o.total_unit)/o.pkt_size) as crt,



		mod(sum(o.total_unit),o.pkt_size) as pcs, 



		sum(o.total_amt)as dP,



		sum(o.total_unit*o.t_price)as tP



		from 



		sale_do_master m,sale_do_details o, item_info i,dealer_info d



		where m.do_no=o.do_no and m.dealer_code=d.dealer_code and i.item_id=o.item_id  and m.status in ('CHECKED','COMPLETED') and  i.item_brand!='Promotional'  ".$date_con.$item_con.$item_brand_con.$pg_con.' 



		group by i.finish_goods_code';



		break;



		



		case 701:



		$report="Item wise Undelivered DO Report(With Gift)";



		break;



		



		case 7011:



		$report="Item wise Undelivered DO Report(Without Gift)";



		break;
		
		case 7111:



		$report="Undelivery Report";



		break;



		



		case 8:



if(isset($t_date)) {$to_date=$t_date; $fr_date=$f_date; $date_con=' and m.do_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



if(isset($product_group)) 	{$pg_con=' and d.product_group="'.$product_group.'"';} 



$report="Dealer Performance Report";



	    case 9:



		$report="Item Report (Region + Zone)";



if(isset($t_date)) 	{$to_date=$t_date; $fr_date=$f_date; $date_con=' and m.do_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



if(isset($product_group)) 		{$pg_con=' and d.product_group="'.$product_group.'"';} 



		break;



			    case 14:



		$report="Item Report (Region)";



if(isset($t_date)) 	{$to_date=$t_date; $fr_date=$f_date; $date_con=' and m.do_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



if(isset($product_group)) 		{$pg_con=' and d.product_group="'.$product_group.'"';} 



		break;



		



		case 10:



		$report="Daily Collection Summary";



		



$sql="select m.do_no,m.do_date,concat(d.dealer_code,'- ',d.dealer_name_e)  as party_name,(SELECT AREA_NAME FROM area where AREA_CODE=d.area_code) as area  ,d.product_group as grp, m.bank as bank_name,m.branch as branch_name,m.payment_by as payment_mode, m.rcv_amt as amount,m.remarks,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' as Varification_Sign,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' as DO_Section_sign from 



sale_do_master m,dealer_info d  , warehouse w



where m.status in ('CHECKED','COMPLETED') and  m.dealer_code=d.dealer_code and w.warehouse_id=d.depot".$date_con.$pg_con." order by m.entry_at";



		break;



		



		case 11:



		$report="Daily Collection &amp; Order Summary";



		



$sql="select m.do_no, m.do_date, concat(d.dealer_code,'- ',d.dealer_name_e)  as party_name,(SELECT AREA_NAME FROM area where AREA_CODE=d.area_code) as area  ,d.product_group as grp, m.bank as bank_name, m.payment_by as payment_mode,m.remarks, m.rcv_amt as collection_amount,(select sum(total_amt) from sale_do_details where do_no=m.do_no) as DP_Total,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' from 



sale_do_master m,dealer_info d  , warehouse w 



where m.status in ('CHECKED','COMPLETED') and  m.dealer_code=d.dealer_code and w.warehouse_id=d.depot".$date_con.$pg_con." order by m.entry_at";



		break;



				case 13:



		$report="Daily Collection Summary(EXT)";



		



$sql="select m.do_no,m.do_date,m.entry_at,concat(d.dealer_code,'- ',d.dealer_name_e)  as party_name,(SELECT AREA_NAME FROM area where AREA_CODE=d.area_code) as area  ,d.product_group as grp, m.bank as bank_name,m.branch as branch_name,m.payment_by as payment_mode, m.rcv_amt as amount,m.remarks,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' as Varification_Sign,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' as DO_Section_sign from 



sale_do_master m,dealer_info d  , warehouse w



where m.status in ('CHECKED','COMPLETED') and  m.dealer_code=d.dealer_code and w.warehouse_id=d.depot".$date_con.$pg_con." order by m.entry_at";



		break;



		case 100:



		if(isset($t_date)) {$to_date=$t_date; $fr_date=$f_date; $date_con=' and m.do_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



		if(isset($product_group)) 	{$pg_con=' and d.product_group="'.$product_group.'"';} 



		$report="Dealer Performance Report";



		break;



		case 101:



		$report="Four(4) Months Comparison Report(CRT)";



		if(isset($t_date)) 	{$to_date=$t_date; $fr_date=$f_date; $date_con=' and m.do_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



		if(isset($product_group)) 		{$pg_con=' and d.product_group="'.$product_group.'"';} 



		



		$sql = "select i.finish_goods_code as code,i.item_name,i.item_brand,i.sales_item_type as `group`,



		floor(sum(o.total_unit)/o.pkt_size) as crt,



		mod(sum(o.total_unit),o.pkt_size) as pcs, 



		sum(o.total_amt)as dP,



		sum(o.total_unit*o.t_price)as tP



		from 



		sale_do_master m,sale_do_details o, item_info i,dealer_info d



		where m.do_no=o.do_no and m.dealer_code=d.dealer_code and i.item_id=o.item_id  and m.status in ('CHECKED','COMPLETED') ".$date_con.$item_con.$item_brand_con.$pg_con.' group by i.finish_goods_code';



		break;



				case 102:



		$report="Four(4) Months Comparison Report(TK)";



		if(isset($t_date)) 	{$to_date=$t_date; $fr_date=$f_date; $date_con=' and m.do_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



		if(isset($product_group)) 		{$pg_con=' and d.product_group="'.$product_group.'"';} 



		



		$sql = "select i.finish_goods_code as code,i.item_name,i.item_brand,i.sales_item_type as `group`,



		floor(sum(o.total_unit)/o.pkt_size) as crt,



		mod(sum(o.total_unit),o.pkt_size) as pcs, 



		sum(o.total_amt)as dP,



		sum(o.total_unit*o.t_price)as tP



		from 



		sale_do_master m,sale_do_details o, item_info i,dealer_info d



		where m.do_no=o.do_no and m.dealer_code=d.dealer_code and i.item_id=o.item_id  and m.status in ('CHECKED','COMPLETED') ".$date_con.$item_con.$item_brand_con.$pg_con.' group by i.finish_goods_code';



		break;



						case 103:



		$report="Four(4) Months Regioanl Report(CTR)";



		



		if($_REQUEST['region_id']!='') {$region_id = $_REQUEST['region_id'];$region_name = find_a_field('branch','BRANCH_NAME','BRANCH_ID='.$region_id);}







		$sql = "select i.finish_goods_code as code,i.item_name,i.item_brand,i.sales_item_type as `group`,



		floor(sum(o.total_unit)/o.pkt_size) as crt,



		mod(sum(o.total_unit),o.pkt_size) as pcs, 



		sum(o.total_amt)as dP,



		sum(o.total_unit*o.t_price)as tP



		from 



		sale_do_master m,sale_do_details o, item_info i,dealer_info d



		where m.do_no=o.do_no and m.dealer_code=d.dealer_code and i.item_id=o.item_id  and m.status in ('CHECKED','COMPLETED') ".$date_con.$item_con.$item_brand_con.$pg_con.' group by i.finish_goods_code';



		break;



						case 104:



		$report="Four(4) Months Regional Report(TK)";







		if($_REQUEST['region_id']!='') {$region_id = $_REQUEST['region_id'];$region_name = find_a_field('branch','BRANCH_NAME','BRANCH_ID='.$region_id);}



		



		$sql = "select i.finish_goods_code as code,i.item_name,i.item_brand,i.sales_item_type as `group`,



		floor(sum(o.total_unit)/o.pkt_size) as crt,



		mod(sum(o.total_unit),o.pkt_size) as pcs, 



		sum(o.total_amt)as dP,



		sum(o.total_unit*o.t_price)as tP



		from 



		sale_do_master m,sale_do_details o, item_info i,dealer_info d



		where m.do_no=o.do_no and m.dealer_code=d.dealer_code and i.item_id=o.item_id  and m.status in ('CHECKED','COMPLETED') ".$date_con.$item_con.$item_brand_con.$pg_con.' group by i.finish_goods_code';



		break;				case 105:



		$report="Four(4) Months Zonal Report(CTR)";







		if($_REQUEST['zone_id']!='') {$zone_id = $_REQUEST['zone_id'];$zone_name = find_a_field('zon','ZONE_NAME','ZONE_CODE='.$zone_id);}







		$sql = "select i.finish_goods_code as code,i.item_name,i.item_brand,i.sales_item_type as `group`,



		floor(sum(o.total_unit)/o.pkt_size) as crt,



		mod(sum(o.total_unit),o.pkt_size) as pcs, 



		sum(o.total_amt)as dP,



		sum(o.total_unit*o.t_price)as tP



		from 



		sale_do_master m,sale_do_details o, item_info i,dealer_info d



		where m.do_no=o.do_no and m.dealer_code=d.dealer_code and i.item_id=o.item_id  and m.status in ('CHECKED','COMPLETED') ".$date_con.$item_con.$item_brand_con.$pg_con.' group by i.finish_goods_code';



		break;



						case 106:



		$report="Four(4) Months Area Report(TK)";







		



		if($_REQUEST['zone_id']!='') {$zone_id = $_REQUEST['zone_id'];$zone_name = find_a_field('zon','ZONE_NAME','ZONE_CODE='.$zone_id);}



				



		$sql = "select i.finish_goods_code as code,i.item_name,i.item_brand,i.sales_item_type as `group`,



		floor(sum(o.total_unit)/o.pkt_size) as crt,



		mod(sum(o.total_unit),o.pkt_size) as pcs, 



		sum(o.total_amt)as dP,



		sum(o.total_unit*o.t_price)as tP



		from 



		sale_do_master m,sale_do_details o, item_info i,dealer_info d



		where m.do_no=o.do_no and m.dealer_code=d.dealer_code and i.item_id=o.item_id  and m.status in ('CHECKED','COMPLETED') ".$date_con.$item_con.$item_brand_con.$pg_con.' group by i.finish_goods_code';



		break;



		



								case 107:



		$report="Yearly Regional Sales Report(TK)";



if($t_date=='') $t_date = date('Y-m-d');



$t_array = explode('-',$t_date);



$t_stamp = strtotime($t_date);







for($i=12;$i>0;$i--)



{



	$m = $t_array[1]-($i-1);



	$t_stampq = strtotime(date('Y-m-15',strtotime($t_date)))-(60*60*24*30*($i-1));



	${'f_mos'.$i} = date('Y-m-15',$t_stampq);



	${'f_mons'.$i} = date('Y-m-01',$t_stampq);



	${'f_mone'.$i} = date('Y-m-'.date('t',$t_stampq),$t_stampq);



}



$f_date=${'f_mons'.$i};







		break;



case 108:



$report="Yearly Regional Sales Report(Per Item)(CTN)";



if($t_date=='') $t_date = date('Y-m-d');



$t_array = explode('-',$t_date);



$t_stamp = strtotime($t_date);







for($i=12;$i>0;$i--)



{



$m = $t_array[1]-($i-1);



$t_stampq = strtotime(date('Y-m-01',strtotime($t_date)))-(60*60*24*30*($i-1));







${'f_mons'.$i} = date('Y-m-01',$t_stampq);



${'f_mone'.$i} = date('Y-m-'.date('t',$t_stampq),$t_stampq);



}



		break;



case 109:



$report="Yearly Regional Sales Report(Per Item)(TK)";



if($t_date=='') $t_date = date('Y-m-d');



$t_array = explode('-',$t_date);



$t_stamp = strtotime($t_date);







for($i=12;$i>0;$i--)



{



$m = $t_array[1]-($i-1);



$t_stampq = strtotime(date('Y-m-01',strtotime($t_date)))-(60*60*24*30*($i-1));







${'f_mons'.$i} = date('Y-m-01',$t_stampq);



${'f_mone'.$i} = date('Y-m-'.date('t',$t_stampq),$t_stampq);



}



break;									











case 110:



$report="Yearly Zone Wise Sales Report(Per Item)(Tk)";



if($t_date=='') $t_date = date('Y-m-d');



$t_array = explode('-',$t_date);



$t_stamp = strtotime($t_date);







for($i=12;$i>0;$i--)



{



$m = $t_array[1]-($i-1);



$t_stampq = strtotime(date('Y-m-01',strtotime($t_date)))-(60*60*24*30*($i-1));







${'f_mons'.$i} = date('Y-m-01',$t_stampq);



${'f_mone'.$i} = date('Y-m-'.date('t',$t_stampq),$t_stampq);



}



break;



case 111:



$report="Yearly Zone Wise Sales Report(Per Item)(CTN)";



if($t_date=='') $t_date = date('Y-m-d');



$t_array = explode('-',$t_date);



$t_stamp = strtotime($t_date);







for($i=12;$i>0;$i--)



{



$m = $t_array[1]-($i-1);



$t_stampq = strtotime(date('Y-m-01',strtotime($t_date)))-(60*60*24*30*($i-1));







${'f_mons'.$i} = date('Y-m-01',$t_stampq);



${'f_mone'.$i} = date('Y-m-'.date('t',$t_stampq),$t_stampq);



}



break;



case 112:



$report="Yearly Zone Wise Sales Report(Per Item)(Tk)";



if($t_date=='') $t_date = date('Y-m-d');



$t_array = explode('-',$t_date);



$t_stamp = strtotime($t_date);







for($i=12;$i>0;$i--)



{



$m = $t_array[1]-($i-1);



$t_stampq = strtotime(date('Y-m-01',strtotime($t_date)))-(60*60*24*30*($i-1));







${'f_mons'.$i} = date('Y-m-01',$t_stampq);



${'f_mone'.$i} = date('Y-m-'.date('t',$t_stampq),$t_stampq);



}



break;



case 1130:



$report="Corporate Party Wise Sales Report YEARLY";



if($t_date=='') $t_date = date('Y-m-d');



$t_array = explode('-',$t_date);



$t_stamp = strtotime($t_date);



$dealer_type = 'Corporate';



unset($to_date);



for($i=12;$i>0;$i--)



{



$m = $t_array[1]-($i-1);



$t_stampq = strtotime(date('Y-m-01',strtotime($t_date)))-(60*60*24*30*($i-1));







${'f_mons'.$i} = date('Y-m-01',$t_stampq);



${'f_mone'.$i} = date('Y-m-'.date('t',$t_stampq),$t_stampq);



}



break;



case 11301:



$report="SuperShop Party Wise Sales Report YEARLY";



if($t_date=='') $t_date = date('Y-m-d');



$t_array = explode('-',$t_date);



$t_stamp = strtotime($t_date);



$dealer_type = 'SuperShop';



unset($to_date);



for($i=12;$i>0;$i--)



{



$m = $t_array[1]-($i-1);



$t_stampq = strtotime(date('Y-m-01',strtotime($t_date)))-(60*60*24*30*($i-1));







${'f_mons'.$i} = date('Y-m-01',$t_stampq);



${'f_mone'.$i} = date('Y-m-'.date('t',$t_stampq),$t_stampq);



}



break;







case 113:



$report="Yearly Dealer Wise Sales Report(Per Item)(Tk)";



if($t_date=='') $t_date = date('Y-m-d');



$t_array = explode('-',$t_date);



$t_stamp = strtotime($t_date);







for($i=12;$i>0;$i--)



{



$m = $t_array[1]-($i-1);



$t_stampq = strtotime(date('Y-m-01',strtotime($t_date)))-(60*60*24*30*($i-1));







${'f_mons'.$i} = date('Y-m-01',$t_stampq);



${'f_mone'.$i} = date('Y-m-'.date('t',$t_stampq),$t_stampq);



}



break;


case 2506025:
$report='Date Wise Potato Stock Report';
break;




case 114:



$report="Yearly Dealer Wise Sales Report(Per Item)(CTN)";



if($t_date=='') $t_date = date('Y-m-d');



$t_array = explode('-',$t_date);



$t_stamp = strtotime($t_date);







for($i=12;$i>0;$i--)



{



$m = $t_array[1]-($i-1);



$t_stampq = strtotime(date('Y-m-01',strtotime($t_date)))-(60*60*24*30*($i-1));







${'f_mons'.$i} = date('Y-m-01',$t_stampq);



${'f_mone'.$i} = date('Y-m-'.date('t',$t_stampq),$t_stampq);



}



break;







case 115:



$report="Yearly Dealer Wise Sales Report(Per Item)(Tk)";



if($t_date=='') $t_date = date('Y-m-d');



$t_array = explode('-',$t_date);



$t_stamp = strtotime($t_date);







for($i=12;$i>0;$i--)



{



$m = $t_array[1]-($i-1);



$t_stampq = strtotime(date('Y-m-01',strtotime($t_date)))-(60*60*24*30*($i-1));







${'f_mons'.$i} = date('Y-m-01',$t_stampq);



${'f_mone'.$i} = date('Y-m-'.date('t',$t_stampq),$t_stampq);



}



break;



case 116:



$report="Single Item Sales Report(Zone Wise)";







break;



case 1992:



$report="Sales Statement(As Per DO)";







break;



}



}



?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml">



<head>



<meta http-equiv="content-type" content="text/html; charset=utf-8" />



<title>



<?=$report?>



</title>



<link href="../../../assets/css/report.css" type="text/css" rel="stylesheet" />



<script language="javascript">



function hide()



{



document.getElementById('pr').style.display='none';



}



</script>



<style type="text/css" media="print">



      div.page



      {



        page-break-after: always;



        page-break-inside: avoid;



      }



    </style>
	<?
	require_once "../../../assets/support/inc.exporttable.php";
	?>


<style type="text/css">



<!--



.style3 {color: #FFFFFF; font-weight: bold; }



.style5 {color: #FFFFFF}



-->



    </style>



</head>



<body>


<!---->
<!--<div align="center" id="pr">-->
<!--  <input type="button" style="text-align:center" value="Print" onclick="hide();window.print();"/>-->
<!--</div>-->



<div class="main">



<?



		$str 	.= '<div class="header">';



		if(isset($_SESSION['company_name'])) 



		$str 	.= '<h1>'.$_SESSION['company_name'].'</h1>';



		if(isset($report)) 



		$str 	.= '<h2>'.$report.'</h2>';



		if(isset($dealer_code)) 



		$str 	.= '<h2>Dealer Name : '.$dealer_code.' - '.find_a_field('dealer_info','dealer_name_e','dealer_code='.$dealer_code).'</h2>';



		if(isset($depot_id)) 



		$str 	.= '<h2>Depot Name : '.find_a_field('warehouse','warehouse_name','warehouse_id='.$depot_id).'</h2>';



		if(isset($item_brand)) 



		$str 	.= '<h2>Item Brand : '.$item_brand.'</h2>';



		if(isset($item_info->item_id)) 



		$str 	.= '<h2>Item Name : '.$item_info->item_name.'('.$item_info->finish_goods_code.')'.'('.$item_info->sales_item_type.')'.'('.$item_info->item_brand.')'.'</h2>';



		if(isset($to_date)) 



		$str 	.= '<h2>Date Interval : '.$fr_date.' To '.$to_date.'</h2>';



		if(isset($product_group)) 



		$str 	.= '<h2>Product Group : '.$product_group.'</h2>';



		if(isset($region_id)) 



		$str 	.= '<h2>Region Name : '.find_a_field('branch','BRANCH_NAME','BRANCH_ID='.$region_id).'</h2>';



		if(isset($zone_id)) 



		$str 	.= '<h2>Zone Name: '.find_a_field('zon','ZONE_NAME','ZONE_CODE='.$zone_id).'</h2>';



		if(isset($dealer_type)) 



		$str 	.= '<h2>Dealer Type : '.$dealer_type.'</h2>';



		$str 	.= '</div>';



		$str 	.= '<div class="left" style="width:100%">';







//		if(isset($allotment_no)) 



//		$str 	.= '<p>Allotment No.: '.$allotment_no.'</p>';



//		$str 	.= '</div><div class="right">';



//		if(isset($client_name)) 



//		$str 	.= '<p>Dealer Name: '.$dealer_name.'</p>';



//		$str 	.= '</div><div class="date">Reporting Time: '.date("h:i A d-m-Y").'</div>';



if($_REQUEST['report']==1) 
{



if($_POST['status']=='ALL'){



$status_con = ' and m.status in ("DONE","UNCHECKED","CHECKED","COMPLETED","PROCESSING","Pending","MANUAL","CANCELED") ';



}else{

$status_con = ' and m.status="'.$_POST['status'].'"';

}

if($_POST['marketing_person']!=''){
  $m_con = ' and m.marketing_person="'.$_POST['marketing_person'].'"';
}



 $sql="select m.do_no,m.status as do_status,m.ref_no,i.item_id,m.do_date,m.marketing_person,concat(d.dealer_code,'- ',d.dealer_name_e) as dealer_name,m.status as status,w.warehouse_name as depot, m.rcv_amt,concat(m.payment_by,m.bank,m.remarks) as Payment_Details,i.unit_price from 



sale_do_master m,dealer_info d  , warehouse w,sale_do_details i



where m.do_no=i.do_no  and m.dealer_code=d.dealer_code and w.warehouse_id=m.depot_id".$depot_con.$item_con.$date_con.$pg_con.$dealer_con.$dtype_con.$status_con. $m_con." group by i.do_no";



$query = mysql_query($sql);



?>



<table width="100%" style="text-align:center" cellspacing="0" cellpadding="2" border="0" id="ExportTable">



  <thead>



    <tr>



      <td style="border:0px; text-align:center" colspan="16"><?=$str?></td>
    </tr>



    <tr style="text-align:center">



      <th>S/L</th>



      <th>Do No</th>

	 



      <th>Status</th>

	  <th>Date</th>



	  <th>Item Name</th>



      <th style="text-align:center">Client Name</th>

	   <th style="text-align:center;">Marketing Person</th>

	  <th style="text-align:center">Payment Details</th>



      <th>Unit Price</th>

	  <th>KG/LTR</th>

	



      <th>Rcvd Amt</th>
	  
	   <th>Commission</th>



      



      <th>Order Value</th>
    </tr>
  </thead>



  <tbody>



    <?



while($data=mysql_fetch_object($query)){$s++;



$sqld = 'select sum(total_amt),sum(t_price*total_unit),sum(total_unit) from sale_do_details where do_no='.$data->do_no;



$info = mysql_fetch_row(mysql_query($sqld));



$rcv_t = $rcv_t+$data->rcv_amt;



$dp_t = $dp_t+$info[0];



$tp_t = $tp_t+$info[2];


if($data->do_no==1790){

 $total_rcvd = 78000;

}elseif($data->do_no==1851){

$total_rcvd = 15625;

}elseif($data->do_no==1901){

$total_rcvd = 28000;

}elseif($data->do_no==1777){

$total_rcvd = 10990;

}elseif($data->do_no==1816){

$total_rcvd = 14050;

}elseif($data->do_no==1840){

$total_rcvd = 650;

}elseif($data->do_no==1849){

$total_rcvd = 1600;

}elseif($data->do_no==1854){

$total_rcvd = 1950;

}elseif($data->do_no==1855){

$total_rcvd = 1800;

}elseif($data->do_no==1872){

$total_rcvd = 5400;

}elseif($data->do_no==1883){

$total_rcvd = 1800;

}elseif($data->do_no==1886){

$total_rcvd = 178200;

}elseif($data->do_no==1926){

$total_rcvd = 700;

}elseif($data->do_no==1928){

$total_rcvd = 28000;

}elseif($data->do_no==1946){

$total_rcvd = 15625;

}elseif($data->do_no==2002){

$total_rcvd = 28000;

}elseif($data->do_no==1971){

$total_rcvd = 107800;

}elseif($data->do_no==1996){

$total_rcvd = 560;

}elseif($data->do_no==1997){

$total_rcvd = 52500;

}elseif($data->do_no==2006){

$total_rcvd = 28000;

}elseif($data->do_no==2007){

$total_rcvd = 48000;

}elseif($data->do_no==2032){

$total_rcvd = 52500;

}elseif($data->do_no==2034){

$total_rcvd = 73500;

}elseif($data->do_no==2037){

$total_rcvd = 52500;

}elseif($data->do_no==2126){

$total_rcvd = 96000;

}elseif($data->do_no==2094){

$total_rcvd = 99800;

}elseif($data->do_no==2109){

$total_rcvd = 10800;

}elseif($data->do_no==2110){

$total_rcvd = 10800;

}elseif($data->do_no==2111){

$total_rcvd = 3600;

}elseif($data->do_no==2113){

$total_rcvd = 21000;

}elseif($data->do_no==2115){

$total_rcvd = 1675;

}elseif($data->do_no==2187){

$total_rcvd = 25000;

}elseif($data->do_no==2251){

$total_rcvd = 708000;

}elseif($data->do_no==2264){

$total_rcvd = 354000;

}elseif($data->do_no==1913){

$total_rcvd = 115170;

}else{


$total_rcvd=find_a_field('secondary_journal','sum(dr_amt)','tr_from="Receipt" and ref_no='.$data->do_no);

}

$com = $total_rcvd*1/100;
$tot_com = $tot_com+$com;


?>



    <tr>



      <td><?=$s?></td>



      <td><a href="delivery_challan_print_view.php?v_no=<?=find_a_field('sale_do_chalan','chalan_no','do_no='.$data->do_no); ?>" target="_blank">



        <?=$data->do_no?>



        </a></td>



      <td><?=$data->do_status?></td>

	  <td><?=$data->do_date?></td>



	  <td><?=find_a_field('item_info','item_name','item_id='.$data->item_id);?></td>



      <td><?=$data->dealer_name?></td>

	   <td><?=find_a_field('personnel_basic_info','PBI_NAME','PBI_ID='.$data->marketing_person);?></td>

	  <td><?=$data->Payment_Details?></td>



      <td><?=$data->unit_price?></td>

	  

	  <td><?=number_format($info[2],0)?></td>

	



      <td style="text-align:right"><?=$data->rcv_amt/*($total_rcvd>0)? number_format($total_rcvd,0):''*/?></td>
	  
	  <td style="text-align:right"><?=$data->commission/*($com>0)? number_format($com,0):''*/?></td>



      



      <td><?=number_format($info[0],0)?></td>
    </tr>



    <?



$toatl_acc_rcv = $toatl_acc_rcv+$total_rcvd;



}



?>



    <tr class="footer">



      <td>&nbsp;</td>



      <td>&nbsp;</td>



      <td>&nbsp;</td>



      <td>&nbsp;</td>



      <td>&nbsp;</td>



      <td>&nbsp;</td>

	  <td>&nbsp;</td>



      <td>&nbsp;</td>

	  <td>&nbsp;</td>

	  <td><?= number_format($tp_t,2,'.',',') ?></td>

	  <td><?= number_format($rcv_t,0,'.',',') ?></td>
	  
	  <td><?= number_format($tot_com,0,'.',',') ?></td>

      <td><?= number_format($dp_t,0,'.',',') ?></td>
    </tr>
  </tbody>
</table>



<? 



}

elseif($_REQUEST['report']==150){

if($_REQUEST['status']!='' ){

$con.= ' and m.status="'.$_POST['status'].'" ';
}

if($_POST['f_date'] !='') $con.=' and m.pos_date between "'.$_POST['f_date'].'" and "'.$_POST['t_date'].'" ';
if($_POST['item_id'] !='') $con.=' and m.item_id = "'.$_POST['item_id'].'" ';
if($_POST['dealer_code'] !='') $con.=' and m.dealer_id = "'.$_POST['dealer_code'].'" ';
if($_POST['pos_id'] !='') $con.=' and m.pos_id = "'.$_POST['pos_id'].'" ';
if($_POST['depot_id'] !='') $con.=' and m.warehouse_id = "'.$_POST['depot_id'].'" ';  

 $sql="select m.*,sum(d.total_amt) as sale,sum(d.discount) as discount from sale_pos_master m , sale_pos_details d where m.pos_id = d.pos_id ".$con." group by m.pos_id order by m.status asc";



$query = mysql_query($sql);
?>



<table width="100%" style="text-align:center" cellspacing="0" cellpadding="2" border="0" id="ExportTable">



  <thead>
    <tr>
      <td style="border:0px; text-align:center" colspan="7"><?=$str?></td>
    </tr>
    <tr style="text-align:center">
      <th>S/L</th>
      <th>Pos No</th>
      <th>Status</th>
	  
      <th>Date</th>
      <th style="text-align:center">Client Name</th>
	  <th style="text-align:center;">Warehouse</th>
	  <th style="text-align:center">Payment Details</th>
      <th>Total Sale</th>
	  <th>Discount(%)</th>
      <th>Rceived Amount</th>
	  <th>Bill Submitted By</th>
    </tr>
  </thead>
  <tbody>

    <?
while($data=mysql_fetch_object($query)){$s++;

?>
    <tr>
      <td><?=$s?></td>
      <td><?=$data->pos_id;?></a></td>
      <td><?=$data->status?></td>
      <td><?=$data->pos_date?></td>
      <td><?=find_a_field('dealer_info','dealer_name_e','dealer_code='.$data->dealer_id);?></td>
	  <td><?=find_a_field('warehouse','warehouse_name','warehouse_id='.$data->warehouse_id);?></td>
	  <td><?=find_a_field('pos_payment','payment_method','pos_id='.$data->pos_id);?></td>
      <td><?=number_format($data->sale,0);$total_sale+=$data->sale;?></td>
	  <td><?=number_format($data->discount,0);$total_disc+=$data->discount;?></td>
      <td style="text-align:right"><?=number_format($rcv=find_a_field('pos_payment','sum(paid_amt)','pos_id='.$data->pos_id),0);$total_rcv+=$rcv;?></td>
	  <td><div align="center"><?=find_a_field('user_activity_management','fname','USER_ID='.$data->entry_by);?></div></td>
    </tr>
    <?

}
?>
    <tr class="footer">
      <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td> <td>&nbsp;</td><td>&nbsp;</td>
	  <td><?= number_format($total_sale,2,'.',',') ?></td>
	  <td><?= number_format($total_disc,0,'.',',') ?></td>
	  <td><?= number_format($total_rcv,0,'.',',') ?></td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>


<? 
}
elseif($_REQUEST['report']==2000) 
{

  if($_POST['status']!='' && $_POST['status']!='ALL')

  $status_concat = ' and m.status="'.$_POST['status'].'"';



  $sql="select m.do_no,m.status as do_status,m.marketing_person,i.item_id,m.do_date,i.total_amt,concat(d.dealer_code,'- ',d.dealer_name_e) as dealer_name,w.warehouse_name as depot, m.rcv_amt,concat(m.payment_by,':',m.bank,':',m.remarks) as Payment_Details from 


sale_do_master m,dealer_info d  , warehouse w,sale_do_details i



where m.marketing_person='".$_POST['marketing_person']."'  and m.do_no=i.do_no  and m.dealer_code=d.dealer_code and w.warehouse_id=m.depot_id".$item_con.$date_con.$dealer_con.$status_concat." order by m.do_no,m.do_date";


$query = mysql_query($sql);



?>



<table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">



  <thead>



    <tr>



      <td style="border:0px;" colspan="7"><?=$str?></td>



    </tr>



    <tr>



      <th>S/L</th>



      <th>No</th>



      <th>Status</th>



      <th>Date</th>



	  <th>Item Name</th>



	  <th>Marketing Person</th>



      <th>Client Name</th>



      <th>Depot</th>



      <th>Rcv Amt</th>

	  

	  <th>Commission</th>



      <th>Payment Details</th>



      <th>DO Value</th>



    </tr>



  </thead>



  <tbody>



    <?



while($data=mysql_fetch_object($query)){$s++;



$sqld = 'select sum(total_amt),sum(t_price*total_unit) from sale_do_details where do_no='.$data->do_no;



$info = mysql_fetch_row(mysql_query($sqld));



$rcv_t = $rcv_t+$data->rcv_amt;



$dp_t = $dp_t+$info[0];



$tp_t = $tp_t+$info[1];




$total_rcvdd=find_a_field('secondary_journal','sum(dr_amt)','tr_from="Receipt" and ref_no='.$data->do_no);




$tot_rcvd  = $tot_rcvd +$total_rcvdd;

$cmsn = $total_rcvdd*1/100;

$tot_cmsn = $tot_cmsn+$cmsn;

?>



    <tr>



      <td><?=$s?></td>



      <td><a href="work_order_bill_corporate.php?v_no=<?=$data->do_no?>" target="_blank">



        <?=$data->do_no?>



        </a></td>



      <td><?=$data->do_status?></td>



      <td><?=$data->do_date?></td>



	  <td><?=find_a_field('item_info','item_name','item_id='.$data->item_id);?></td>



	   <td><?=find_a_field('personnel_basic_info','PBI_NAME','PBI_ID='.$data->marketing_person);?></td>



      <td><?=$data->dealer_name?></td>



      <td><?=$data->depot?></td>



      <td style="text-align:right"><?=$total_rcvdd?></td>

	  

	   <td style="text-align:right"><?=$cmsn?></td>



      <td><?=$data->Payment_Details?></td>



      <td><?=$data->total_amt?></td>



    </tr>



    <?



}



?>



    <tr class="footer">



      <td>&nbsp;</td>



      <td>&nbsp;</td>



      <td>&nbsp;</td>



      <td>&nbsp;</td>



	  <td>&nbsp;</td>



	  <td>&nbsp;</td>



      <td>&nbsp;</td>



      <td>&nbsp;</td>



      <td><?= number_format($tot_rcvd,0,'.',',') ?></td>

	  

	  <td><?= number_format($tot_cmsn,0,'.',',') ?></td>



      <td>&nbsp;</td>



      <td><?= number_format($dp_t,0,'.',',') ?></td>



    </tr>



  </tbody>



</table>



<? 







}
elseif($_REQUEST['report']==404) 

{
?>

<table  border="1" cellpadding="0" cellspacing="0" width="100%">
<tr>

      <td style="border:0px;" colspan="11"><?=$str?></td>

  </tr>
  <tr>
  
    <th>SR No</th>
	<th>Year</th>
    <th>Bag Quantity</th>
    <th>Loading Position</th>
    <th>1st Plot</th>
    <th>2nd Plot</th>
	 <th>3rd Plot</th>
	  <th>4th Plot</th>
	  <th>5th Plot</th>
	  <th>Unload</th>
	   <th>Comments</th>
  </tr>
  
  <? 
  
   if($_POST['bag_mark']!='')
  {
  
  $bag_mark='and t.sr_number="'.$_POST['bag_mark'].'"';
  
  }
  if($_POST['rec_year']!='')
  {
  
  $rec_year='and t.token_year="'.$_POST['rec_year'].'"';
  
  }

$receive = [];
$receive_date = [];
$sql = "SELECT item_in AS rec, warehouse_id, barcode, ji_date 
        FROM journal_item 
        WHERE ji_date BETWEEN '".$_POST['f_date']."' AND '".$_POST['t_date']."' 
        AND tr_from='Other Receive' 
        AND item_id=100010001";
$q = mysql_query($sql);

while ($r = mysql_fetch_object($q)) {
   
    $receive_entry =  $r->warehouse_id . "-" .number_format( $r->rec,0);
    
    // Concatenate receiving data for the same barcode with warehouse information
    if (isset($receive_date[$r->barcode])) {
        $receive_date[$r->barcode] .= ",<br> " . $receive_entry;
    } else {
        $receive_date[$r->barcode] = $receive_entry;
    }


	$tot_rec+=$r->rec;
    // Store warehouse ID for future reference (if needed)
    $receive_loading[$r->barcode] = $r->warehouse_id;
}




//Olat Palot

  
 
 $sql2 = " SELECT item_in AS olot, barcode, warehouse_id  FROM journal_item  WHERE bag_size = 1 AND ji_date BETWEEN '{$_POST['f_date']}' AND '{$_POST['t_date']}'
      AND item_in > 0  AND tr_from = 'Olot Palot' AND item_id = 100010001";
$q2 = mysql_query($sql2);
$olot1 = [];
while ($r2 = mysql_fetch_object($q2)) {
    $entry = $r2->warehouse_id . "-" . number_format($r2->olot, 0);
    // Append with comma if barcode already exists
    if (isset($olot1[$r2->barcode])) {
        $olot1[$r2->barcode] .= ",<br> " . $entry;
    } else {
        $olot1[$r2->barcode] = $entry;
    }
}

 $sql2 = " SELECT item_in AS olot, barcode, warehouse_id  FROM journal_item  WHERE bag_size = 2 AND ji_date BETWEEN '{$_POST['f_date']}' AND '{$_POST['t_date']}'
      AND item_in > 0  AND tr_from = 'Olot Palot' AND item_id = 100010001";
$q2 = mysql_query($sql2);
$olot2 = [];
while ($r2 = mysql_fetch_object($q2)) {
    $entry = $r2->warehouse_id . "-" . number_format($r2->olot, 0);
    // Append with comma if barcode already exists
    if (isset($olot2[$r2->barcode])) {
        $olot2[$r2->barcode] .= ",<br> " . $entry;
    } else {
        $olot2[$r2->barcode] = $entry;
    }
}
 $sql2 = " SELECT item_in AS olot, barcode, warehouse_id  FROM journal_item  WHERE bag_size = 3 AND ji_date BETWEEN '{$_POST['f_date']}' AND '{$_POST['t_date']}'
      AND item_in > 0  AND tr_from = 'Olot Palot' AND item_id = 100010001";
$q2 = mysql_query($sql2);
$olot3 = [];
while ($r2 = mysql_fetch_object($q2)) {
    $entry = $r2->warehouse_id . "-" . number_format($r2->olot, 0);
    // Append with comma if barcode already exists
    if (isset($olot3[$r2->barcode])) {
        $olot3[$r2->barcode] .= ",<br> ". $entry;
    } else {
        $olot3[$r2->barcode] = $entry;
    }
}
 $sql2 = " SELECT item_in AS olot, barcode, warehouse_id  FROM journal_item  WHERE bag_size = 4 AND ji_date BETWEEN '{$_POST['f_date']}' AND '{$_POST['t_date']}'
      AND item_in > 0  AND tr_from = 'Olot Palot' AND item_id = 100010001";
$q2 = mysql_query($sql2);
$olot4 = [];
while ($r2 = mysql_fetch_object($q2)) {
    $entry = $r2->warehouse_id . "-" . number_format($r2->olot, 0);
    // Append with comma if barcode already exists
    if (isset($olot4[$r2->barcode])) {
        $olot4[$r2->barcode] .= ",<br> " . $entry;
    } else {
        $olot4[$r2->barcode] = $entry;
    }
}
 $sql2 = " SELECT item_in AS olot, barcode, warehouse_id  FROM journal_item  WHERE bag_size = 5 AND ji_date BETWEEN '{$_POST['f_date']}' AND '{$_POST['t_date']}'
      AND item_in > 0  AND tr_from = 'Olot Palot' AND item_id = 100010001";
$q2 = mysql_query($sql2);
$olot5 = [];
while ($r2 = mysql_fetch_object($q2)) {
    $entry = $r2->warehouse_id . "-" . number_format($r2->olot, 0);
    // Append with comma if barcode already exists
    if (isset($olot5[$r2->barcode])) {
        $olot5[$r2->barcode] .= ",<br> " . $entry;
    } else {
        $olot5[$r2->barcode] = $entry;
    }
}



  
  
$sales = [];
$sales_date = [];
$sql3 = "SELECT item_ex AS saless, barcode, ji_date 
         FROM journal_item 
         WHERE ji_date BETWEEN '".$_POST['f_date']."' AND '".$_POST['t_date']."' 
         AND tr_from='Sales' 
         AND item_id=100010001";
$q3 = mysql_query($sql3);
while ($r3 = mysql_fetch_object($q3)) {
    $formatted_date = date("d M", strtotime($r3->ji_date)); // Format: 10 Jan
    $sale_entry = $formatted_date . " - " . number_format($r3->saless, 0);
    
	
	$summation+=$r3->saless;
    // Concatenate sales if barcode already exists
    if (isset($sales_date[$r3->barcode])) {
        $sales_date[$r3->barcode] .= ",<br> " . $sale_entry;
    } else {
        $sales_date[$r3->barcode] = $sale_entry;
    }
}



  
   $sql5="select sum(item_in-item_ex) as unload,barcode from journal_item where ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."'  and item_id=100010001 group by barcode ";
  $q5=mysql_query($sql5);
  while($r5=mysql_fetch_object($q5))
  
  {
  $unloading[$r5->barcode]=$r5->unload;
  
  
  }
  
  
 
  
  
  // $sql4="select t.quantity,j.barcode from journal_item j, sr_token t where t.sr_number=j.barcode and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' ".$bag_mark." and j.item_id=100010001 group by  j.barcode order by j.barcode asc";
   
   $s=1;
   $sql4="select t.quantity,t.sr_number,t.token_year from  sr_token t where 1 ".$bag_mark.$rec_year."  group by  t.sr_number order by CAST(SUBSTRING_INDEX(t.sr_number, '/', 1) AS UNSIGNED) asc";
  $q4=mysql_query($sql4);
  while($r4=mysql_fetch_object($q4))
  
  {
  
  
  
  
  
  
  ?>
  <tr>
  
    <td><?=$r4->sr_number;?></td>
	<td><?=$r4->token_year;?></td>
    <td><?=$r4->quantity; $tot_qty+=$r4->quantity;?></td>
   <td><?php echo $receive_date[$r4->sr_number];  ?></td>
    <td><?=$olot1[$r4->sr_number];?></td>
    <td><?=$olot2[$r4->sr_number];?></td>
    <td><?$olot3[$r4->sr_number];?></td>
    <td><?=$olot4[$r4->sr_number];?></td>
    <td><?=$olot5[$r4->sr_number];?></td>
    <td><?php echo $sales_date[$r4->sr_number]; ?></td>
    <td>&nbsp;</td>
  </tr>
  
  <? } ?>
  <tr>
  
  	<td>Total</td>
	<td></td>
	<td><?=$tot_qty?></td>
	<td><?=$tot_rec;?></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td><?=$summation?></td>
	<td></td>
  </tr>
</table>


<?
}


elseif($_REQUEST['report']==2001) 



{



if($_POST['f_date']!='' && $_POST['t_date']!=''){



 $startDate = $_POST['f_date'];

$endDate = $_POST['t_date'];

  

 $d_con = " and  j.jv_date between '$startDate' and '$endDate'";

}



 echo $sql="select j.tr_id as do_no,sum(j.dr_amt) as total_receive,m.marketing_person from secondary_journal j, sale_do_master m where j.tr_from='Receipt' ".$d_con." and j.tr_id=m.do_no group by m.marketing_person";
 
$query = mysql_query($sql);



?>



<table width="100%" cellspacing="0" cellpadding="2" border="0" align="center" id="ExportTable">



  <thead>



    <tr>

      

      <td style="border:0px;" colspan="4" align="center"><h1>AKSID CORPORATION LIMITED</h1></td>

 

    </tr>

	 <tr>

      

      <td style="border:0px;" colspan="4" align="center"><h2>Sales Commission Report<br />Date Interval : <?=$_POST['f_date']?> To <?=$_POST['t_date']?> </h2></td>

 

    </tr>



    <tr>



      <th>S/L</th>



	  <th>Marketing Person</th>



      <th>Total sales on received</th>

	  

	 



      <th>Sales Commission</th>



      



      



    </tr>



  </thead>



  <tbody>



    <?



while($data3=mysql_fetch_object($query)){$s++;



  //$sqld = 'select m.marketing_person from sale_do_master m where m.do_no='.$data3->do_no.'';



//$info = mysql_fetch_row(mysql_query($sqld));



$rcv_t = $rcv_t+$data3->rcv_amt;



$dp_t = $dp_t+$data3->total_amt;



$total_rcv = $total_rcv+$data3->total_receive;



$tp_t = $tp_t+$info[1];



$commission =$data3->total_receive * 1/100;



$total_commission = $total_commission+$commission;



if($data3->marketing_person>0){

   

   $emp_name = find_a_field('personnel_basic_info','PBI_NAME','PBI_ID='.$data3->marketing_person);



}else{

  

  $emp_name = 'Unknown';



}



?>



    <tr>



      <td><?=$s?></td>



	   <td><?=$emp_name?></td>



      <td><?=number_format($data3->total_receive,0);//number_format($total_sale = find_a_field('sale_do_details s,sale_do_master a','sum(s.total_amt)','s.do_no=a.do_no and a.do_date between "'.$_POST['f_date'].'" and "'.$_POST['t_date'].'" and a.status="COMPLETED"  and a.marketing_person='.$data3->marketing_person))?></td>

	  

	   



      <td><?=number_format($commission,0)?></td>



    </tr>



    <?

	

	$tot_sale = $tot_sale+$total_sale;



}



?>



    <tr class="footer">



      



	  <td>&nbsp;</td>



	  <td>&nbsp;</td>

      <td><?= number_format($total_rcv,0,'.',',') ?></td>

	  

	  

	  



      



      <td><?= number_format($total_commission,0,'.',',') ?></td>



    </tr>



  </tbody>



</table>



<? 



}



elseif($_REQUEST['report']==321) 

{

?>



<table width="70%" cellspacing="0" cellpadding="2" border="0" align="center" id="ExportTable">



  <thead>



    <tr>

      

      <td style="border:0px;" colspan="4" align="center"><h1><?=find_a_field('user_group','group_name','id="'.$_SESSION['user']['group'].'"')?></h1></td>

 

    </tr>

	 <tr>

      

      <td style="border:0px;" colspan="4" align="center"><h2>Sales Report At a Glance<br />Date Interval : <?=$_POST['f_date']?> To <?=$_POST['t_date']?> </h2></td>

 

    </tr>



    <tr>



      <th><div align="center">S/L</div></th>



	  <th>Marketing Person</th>

	  

      <th><div align="center">Total DO</div></th>

		 

      <th>Total Sale amount</th>
	  
	 <!-- <th>Total Collection</th>
	  
	  <th>Total Commission</th>-->

	 

    </tr>



  </thead>



  <tbody>

    <?

	if($_POST['f_date']!='' && $_POST['t_date']!=''){


   $startDate = $_POST['f_date'];

   $endDate = $_POST['t_date'];
 
   $d_con = " and  m.do_date between '$startDate' and '$endDate'";

  }

 $sql="select sum(d.total_amt) as total_amt,count(m.do_no) as total_do,m.marketing_person from sale_do_master m,sale_do_details d where m.do_no=d.do_no ".$d_con." group by m.marketing_person";

 $query = mysql_query($sql);


while($data3=mysql_fetch_object($query)){$s++;

$name = find_a_field('personnel_basic_info','PBI_NAME','PBI_ID='.$data3->marketing_person);

if($name==''){

 $emp_name= 'Unknown';

}else{

 $emp_name=$name;



}

 /*$csql = 'select m.do_no,m.marketing_person from sale_do_master m where 1'.$d_con.' and m.marketing_person="'.$data3->marketing_person.'"';

$cquery = mysql_query($csql);
$total_collection = 0;
while($cdata = mysql_fetch_object($cquery)){

 $total_collection = $total_collection+find_a_field('secondary_journal','dr_amt','ref_no="'.$cdata->do_no.'" and tr_from="Receipt"');

}*/
?>



    <tr>



      <td><div align="center"><?=++$j?></div></td>



	   <td><?=$emp_name?></td>



      <td><div align="center"><?=$data3->total_do?></div></td>

	  

	   



    <td><?=number_format($data3->total_amt,0)?></td>
	  
	   <!-- <td><?=number_format($total_collection,0)?></td>
	  
	  <td></td>
-->


    </tr>



    <?

	

	$tot_sale = $tot_sale+$data3->total_amt;



}



?>



    <tr class="footer">



      



	  <td>&nbsp;</td>



	  <td>&nbsp;</td>

      <td>&nbsp;</td>

	  

	  

	  



      



      <td><?= number_format($tot_sale,0,'.',',') ?></td>



    </tr>



  </tbody>



</table>



<? 



}





elseif($_REQUEST['report']==1999) 



{



if(isset($area_id)) 		{$acon.=' and a.AREA_CODE="'.$area_id.'"';}



if(isset($zone_id)) 		{$acon.=' and z.ZONE_CODE="'.$zone_id.'"';}



$sql="select concat(d.dealer_code,'- ',d.dealer_name_e) as dealer_name,AREA_NAME as area,ZONE_NAME zone,w.warehouse_name as depot, sum(i.t_price*sd.total_unit) do_amt from 



sale_do_master m,dealer_info d  , warehouse w,area a,sale_do_details sd,item_info i, zon z



where a.ZONE_ID=z.ZONE_CODE and m.status in ('CHECKED','COMPLETED') and a.AREA_CODE=d.area_code and m.do_no=sd.do_no and sd.item_id=i.item_id and m.dealer_code=d.dealer_code and w.warehouse_id=d.depot and i.finish_goods_code in (102 ,105 ,106 ,109 ,120 ,121 ,123 ,124 ,126 ,127 ,128 ,129 ,130 ,137 ,138 ,139 ,140 ,141 ,142 ,143)".$depot_con.$date_con.$pg_con.$dealer_con.$dtype_con.$acon." group by d.dealer_code order by d.dealer_name_e";



$query = mysql_query($sql);



echo '<table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">



<thead><tr><td style="border:0px;" colspan="9">'.$str.'</td></tr><tr><th>S/L</th><th>Dealer Name</th><th>Zone</th><th>Area</th><th>Depot</th><th>TP Amt</th><th>80%-TP</th><th>SC QTY</th></tr></thead>



<tbody>';



while($data=mysql_fetch_object($query)){$s++;



//$sqld = 'select sum(total_amt),sum(t_price*total_unit) from sale_do_details where do_no='.$data->do_no;



//$info = mysql_fetch_row(mysql_query($sqld));



$do_tot = $do_tot+$data->do_amt;



$do_80  = (int)($data->do_amt*.8);



$do_80t = $do_80t+$do_80;



$do_sc  = (int)($do_80*.001);



$do_sct = $do_sct+$do_sc;



?>



<tr>



  <td><?=$s?></td>



  <td><?=$data->dealer_name?></td>



  <td><?=$data->zone?></td>



  <td><?=$data->area?></td>



  <td><?=$data->depot?></td>



  <td style="text-align:right"><?=$data->do_amt?></td>



  <td style="text-align:right"><?=$do_80?></td>



  <td style="text-align:right"><?=$do_sc?></td>



</tr>



<?



}



echo '<tr class="footer"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td style="text-align:right">'.number_format($do_tot,2).'</td><td style="text-align:right">'.number_format($do_80t,2).'</td><td style="text-align:right">'.number_format($do_sct,2).'</td></tr></tbody></table>';



}



elseif($_REQUEST['report']==1991) 



{
if((strlen($_REQUEST['cut_date'])==10)) $cut_date=$_REQUEST['cut_date'];



if(isset($cut_date)) 					{$cut_date_con=' and c.chalan_date <="'.$cut_date.'"';}
 $sqld = 'select m.do_no, sum(c.total_amt) as ch_amt from sale_do_chalan c, sale_do_master m where c.unit_price>0 and m.do_no=c.do_no '.$date_con.$cut_date_con.' group by m.do_no';



$queryd = mysql_query($sqld);
while($info = mysql_fetch_object($queryd)){
$do_ch_amt[$info->do_no] = $info->ch_amt;
}
 $sql="select m.do_no,m.do_date,concat(d.dealer_code,'- ',d.dealer_name_e) as dealer_name,d.area_code,w.warehouse_name as depot, sum(ds.total_amt) as do_amt,m.rcv_amt,concat(m.payment_by,':',m.bank,':',m.remarks) as Payment_Details from sale_do_master m,dealer_info d  , warehouse w,sale_do_details ds where m.do_no=ds.do_no and m.status in ('CHECKED','COMPLETED')  and m.dealer_code=d.dealer_code and w.warehouse_id=d.depot and ds.total_amt>0 ".$depot_con.$date_con.$pg_con.$dealer_con.$dtype_con." group by m.do_no order by m.do_date,m.do_no";
$query = mysql_query($sql);
?>
<table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">



<thead>



  <tr>



    <td style="border:0px;" colspan="9"><?=$str?></td>



  </tr>



  <tr>



    <th>S/L</th>



    <th>Do No</th>



    <th>Do Date</th>



    <th>Dealer Name</th>



    <th>Area</th>



    <th>Depot</th>



    <th>Grp</th>



    <th>Rcv Amt</th>



    <th>Payment Details</th>



    <th>DO Amt</th>



    <th>Sale Amt</th>



    <th>Due Amt</th>



  </tr>



</thead>



<tbody>



  <?



while($data=mysql_fetch_object($query)){$s++;



$due_amt = ($data->do_amt-$do_ch_amt[$data->do_no]);



$rcv_t = $rcv_t+$data->rcv_amt;



$dp_t = $dp_t+$data->do_amt;



$tp_t = $tp_t+$do_ch_amt[$data->do_no];



$due_t = $due_t+$due_amt;



?>



  <tr>



    <td><?=$s?></td>



    <td><?=$data->do_no?></td>



    <td><?=$data->do_date?></td>



    <td><?=$data->dealer_name?></td>



    <td><?=find_a_field('area','AREA_NAME','AREA_CODE='.$data->area_code);?></td>



    <td><?=$data->depot?></td>



    <td><?=$data->grp?></td>



    <td style="text-align:right"><?=$data->rcv_amt?></td>



    <td><?=$data->Payment_Details?></td>



    <td style="text-align:right"><?=number_format($data->do_amt,2);?></td>



    <td><?=number_format($do_ch_amt[$data->do_no],2)?></td>



    <td><?=number_format($due_amt,2);?></td>



  </tr>



  <?



}



echo '<tr class="footer"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td style="text-align:right">'.number_format($rcv_t,2).'</td><td>&nbsp;</td><td>'.number_format($dp_t,2).'</td><td>'.number_format($tp_t,2).'</td><td>'.number_format($due_t,2).'</td></tr></tbody></table>';



}



elseif($_REQUEST['report']==191) 


{

if($_POST['f_date']!='' && $_POST['t_date']!=''){



 $d_con = " and  m.do_date between '".$_POST['f_date']."' and '".$_POST['t_date']."'";

}



 


?>



<table width="100%" cellspacing="0" cellpadding="2" border="0" align="center" id="ExportTable">



  <thead>



    <tr>

      

      <td style="border:0px;" colspan="4" align="center"><h1><?=find_a_field('user_group','group_name','id="'.$_SESSION['user']['group'].'"')?></h1></td>

 

    </tr>

	 <tr>

      

      <td style="border:0px;" colspan="4" align="center"><h2>Item Report (At a glance)<br />Date Interval : <?=$_POST['f_date']?> To <?=$_POST['t_date']?> </h2></td>

 

    </tr>



    <tr>



      <th>S/L</th>



	  <th>Item Name</th>



      <th>Unit</th>

	  

	 



      <th>Total Qty</th>



      



      



    </tr>



  </thead>



  <tbody>



    <?
	
 $sql="select i.item_name,i.unit_name,sum(s.total_unit) as total_qty from sale_do_details s,sale_do_master m,item_info i where m.do_no=s.do_no and i.item_id=s.item_id ".$d_con." and m.status!='CANCELED' group by s.item_id";

$query = mysql_query($sql);




while($data3=mysql_fetch_object($query)){$s++;


?>



    <tr>



      <td><?=$s?></td>



	   <td><?=$data3->item_name?></td>
	   
	   <td><?=$data3->unit_name?></td>
	   
	   <td><?=$data3->total_qty?></td>

    </tr>



    <?

	

	$tot_sale = $tot_sale+$total_sale;



}



?>



    <tr class="footer">



      



	  <td>&nbsp;</td>



	  <td>&nbsp;</td>

      <td></td>

	  


      <td></td>



    </tr>



  </tbody>



</table>



<? 



}
elseif($_REQUEST['report']==2109025)
{


		if(isset($dealer_type)){
		if($dealer_type=='MordernTrade')		{$dealer_type_con = ' and ( d.dealer_type="Corporate" or  d.dealer_type="SuperShop" or  d.product_group="M") ';}
		else 	{$dealer_type_con = ' and d.dealer_type="'.$dealer_type.'"';}
		}
if(isset($depot_id)) 	{$depot_con=' and c.depot_id="'.$depot_id.'"';} 
if(isset($region_id)) 	{$region_con=' and d.region_id='.$region_id;}
if(isset($zone_id)) 	{$zone_con=' and d.zone_id='.$zone_id;}
if(isset($dealer_code)) 	{$dealer_con=' and d.dealer_code='.$dealer_code;}

$date_con=" and c.chalan_date between '".$_POST['f_date']."' and '".$_POST['t_date']."'";

if($_POST['booking_type']!='')
{
$booking_type='and c.booking_type="'.$_POST['booking_type'].'"';
}

if($_POST['rec_year']!='')
{
$rec_year='and p.booking_year="'.$_POST['rec_year'].'"';
}

if($_POST['booking_number']!='')
{
$booking_number='and c.booking_no="'.$_POST['booking_number'].'"';
}
if($_POST['sr_number']!='')
{
$sr_number='and c.sr_no="'.$_POST['sr_number'].'"';
}

?>

 <div id="ExportTable">
<table width="100%" cellspacing="0" cellpadding="2" border="0" >
<thead><tr><td style="border:0px;" colspan="15"><?=$str?></td></tr>
	
	
  <tr>
    <th rowspan="2">ক্রমিক নং</th>
    <th rowspan="2"> রিটান লোন নং </th>
    <th rowspan="2"  style="white-space: nowrap;" >তারিখ</th>
    <th rowspan="2"  style="white-space: nowrap;" >নাম</th>
    <th rowspan="2">বুকিং নং</th>
    <th rowspan="2">বীজলোন</th>
    <th colspan="3">চাষীলোন</th>
    <th rowspan="2">বস্তালোন</th>
    <th colspan="3">এস.আর লোন</th>
    <th rowspan="2">অন্যান্য লোন</th>
    <th rowspan="2">মোট টাকা </th>
  </tr>
  
  <tr>
<th>প্রদানকৃত</th>
<th>দিন</th>
<th>লাভ</th>
<th>প্রদানকৃত</th>
<th>দিন</th>
<th>লাভ</th>
</tr>
<tr style="border:none;">
    <th colspan="15" align="left" style="text-align:left">Contract Booking</th>
	</tr></thead><tbody>
<?



$s=1;
  $sql_loan="select c.*,p.name
from sr_loan_return c, paid_booking p
where c.booking_number=p.booking_number_eng and c.chalan_no is null and p.booking_type='Contract Booking' and  c.recdate between '".$_POST['f_date']."' and '".$_POST['t_date']."'  ".$rec_year.$booking_number.$sr_number."
";
$loan_query = mysql_query($sql_loan);
while($data=mysql_fetch_object($loan_query)){


?>
<tr>

<td><?=$s++?></td>
<td><?=$data->sr_loan_id?></td>
<td><?=$data->recdate?></td>
<td><?=$data->name; ?></td>
<td><?=$data->booking_number?></td>
<td align="right"></td>
<td align="right"></td>
<td  align="right"></td>
<td  align="right"></td>
<td  align="right"></td>
<td  align="right"><?=$data->total_paid; $t_paid+=$data->total_paid; ?></td>
<td  align="right"><?=$data->total_days;   ?></td>
<td align="right"><?=$data->interest_amt; $tot_interest+=$data->interest_amt; ?></td>
<td align="right"></td>
<td align="right"> <?=$data->total_amount; $t_contact_amt+=$data->total_amount; ?></td>

</tr>
<?
}
?><tr class="footer"><td>&nbsp;</td><td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td><td>&nbsp;</td><td></td><td></td>
<td></td>
<td></td>
<td></td>
<td><?=number_format($t_paid,2);?></td>
<td></td>
<td><?=number_format($tot_interest,2);?></td>
<td></td>
<td><?=number_format(ceil($t_contact_amt),2);?></td>


</tr></tbody></table>

<br /><br />
<table width="100%" cellspacing="0" cellpadding="2" border="0">
<thead><tr><td style="border:0px;" colspan="16"></td></tr>

  <tr>
    <th rowspan="2">ক্রমিক নং</th>
    <th rowspan="2">রিটান লোন নং</th>
    <th rowspan="2"  style="white-space: nowrap;">তারিখ</th>
    <th rowspan="2"  style="white-space: nowrap;">নাম</th>
    <th rowspan="2">বুকিং নং</th>
    <th rowspan="2">বীজলোন</th>
    <th colspan="3" style="text-align:center;">চাষীলোন</th>
    <th rowspan="2">বস্তালোন</th>
    <th colspan="3" style="text-align:center;">এস.আর লোন</th>
    <th rowspan="2">অন্যান্য লোন</th>
    <th rowspan="2">মোট টাকা </th>
  </tr>
  
  <tr>
<th >প্রদানকৃত</th>
<th>দিন</th>
<th>লাভ</th>
<th style="text-align:center;">প্রদানকৃত</th>

<th>দিন</th>
<th>লাভ</th>
</tr> <tr style="border:none;">
    <th colspan="15" align="left" style="text-align:left">Normal Booking</th>
	
	</tr></thead><tbody>
<?


  
$sql_loan="select count(c.booking_no) as booking,c.booking_no
from sale_do_chalan c, paid_booking p
where c.booking_no=p.booking_number_eng and p.booking_type='Normal Booking'  and 1  ".$date_con.$rec_year.$booking_number.$sr_number."
group by c.booking_no order by c.booking_no";
$loan_query = mysql_query($sql_loan);
while($data=mysql_fetch_object($loan_query)){
$booking_total[$data->booking_no]=$data->booking;
}



$s=1;
  $sql_loan="select c.*,p.name
from sr_loan_return c, paid_booking p
where c.booking_number=p.booking_number_eng and c.chalan_no is null and p.booking_type='Normal Booking' and  c.recdate between '".$_POST['f_date']."' and '".$_POST['t_date']."'  ".$rec_year.$booking_number.$sr_number."
";
$loan_query = mysql_query($sql_loan);
while($data=mysql_fetch_object($loan_query)){


?>
<tr>

<td><?=$s++?></td>
<td><?=$data->sr_loan_id?></td>
<td><?=$data->recdate?></td>
<td><?=$data->name; ?></td>
<td><?=$data->booking_number?></td>
<td align="right"></td>
<td align="right"></td>
<td  align="right"></td>
<td  align="right"></td>
<td  align="right"></td>
<td  align="right"><?=$data->total_paid; $t_paid2+=$data->total_paid; ?></td>
<td  align="right"><?=$data->total_days;  ?></td>
<td align="right"><?=$data->interest_amt; $t_interest2+=$data->interest_amt; ?></td>
<td align="right"></td>
<td align="right"> <?=$data->total_amount; $tot_amt2+=$data->total_amount; ?></td>

</tr>
<?
}
?><tr class="footer"><td>&nbsp;</td><td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td><td>&nbsp;</td><td></td><td></td>
<td></td>
<td></td>
<td></td>
<td><?=number_format($t_paid2,2);?></td>
<td></td>
<td><?=number_format($t_interest2,2);?></td>
<td></td>
<td><?=number_format(ceil($tot_amt2),2);?></td>


</tr></tbody></table>

<br /><br />
<table width="100%" cellspacing="0" cellpadding="2" border="0" >
<thead><tr><td style="border:0px;" colspan="15"></td></tr>

  <tr>
    <th rowspan="2">ক্রমিক নং</th>
    <th rowspan="2">রিটান লোন নং</th>
    <th rowspan="2" style="white-space: nowrap;">তারিখ</th>
    <th rowspan="2" style="white-space: nowrap;">নাম</th>
    <th rowspan="2">বুকিং নং</th>
    <th rowspan="2">বীজলোন</th>
    <th colspan="3">চাষীলোন</th>
    <th rowspan="2">বস্তালোন</th>
    <th colspan="3">এস.আর লোন</th>
    <th rowspan="2">অন্যান্য লোন</th>
    <th rowspan="2">মোট টাকা </th>
  </tr>
  
  <tr>
<th>প্রদানকৃত</th>
<th>দিন</th>
<th>লাভ</th>
<th>প্রদানকৃত</th>
<th>দিন</th>
<th>লাভ</th>
</tr> <tr style="border:none;">
    <th colspan="15" align="left" style="text-align:left">Paid Booking</th>
	
	</tr></thead><tbody>
<?

$s=1;
  $sql_loan="select c.*,p.name
from sr_loan_return c, paid_booking p
where c.booking_number=p.booking_number_eng and c.chalan_no is null and p.booking_type='Paid Booking' and  c.recdate between '".$_POST['f_date']."' and '".$_POST['t_date']."'  ".$rec_year.$booking_number.$sr_number."
";
$loan_query = mysql_query($sql_loan);
while($data=mysql_fetch_object($loan_query)){


?>
<tr>

<td><?=$s++?></td>
<td><?=$data->sr_loan_id?></td>
<td><?=$data->recdate?></td>
<td><?=$data->name; ?></td>
<td><?=$data->booking_number?></td>
<td align="right"></td>
<td align="right"></td>
<td  align="right"></td>
<td  align="right"></td>
<td  align="right"></td>
<td  align="right"><?=$data->total_paid; $tp_paid+=$data->total_paid; ?></td>
<td  align="right"><?=$data->total_days;  ?></td>
<td align="right"><?=$data->interest_amt; $tp_interst+=$data->interest_amt; ?></td>
<td align="right"></td>
<td align="right"> <?=$data->total_amount; $tp_total+=$data->total_amount; ?></td>

</tr>

<?
}
?>

<tr class="footer"><td>&nbsp;</td><td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td><td>&nbsp;</td><td></td><td></td>
<td></td>
<td></td>
<td></td>
<td><?=number_format($tp_paid,2);?></td>
<td></td>
<td><?=number_format($tp_interst,2);?></td>
<td></td>
<td><?=number_format(ceil($sub_total_paid=$tp_total),2);?></td>
</tr>
<tr style="border:none;">
    <th colspan="15"  style="text-align:center">Total </th>
	</tr>
<tr style="font-weight:bold;"><td colspan="5">&nbsp;</td><td></td><td></td>
<td></td>
<td></td>
<td></td>
<td align="right"> <?=number_format($tp_total+$t_paid2+$tp_paid,2);?></td>
<td></td>
<td align="right"><?=number_format($tp_interst+$tot_interest+$t_interest2,2);?></td>
<td></td>
<td align="right"><?=number_format(ceil($sub_total_paid+$t_contact_amt+$tot_amt2),2);?></td>
</tr>
</tbody></table>

<table width="100%" cellpadding="0" cellspacing="0">
<thead>

</thead>
</table>

</div>
<?



}
elseif($_REQUEST['report']==81025)
{

?>
<!--<style>

.table-container {
  max-height: 400px; /* Adjust as needed */
  overflow: auto;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th {
  position: sticky;
  top: 0;
  background: #fff; /* Or any background to cover content behind */
  z-index: 2;
  border: 1px solid #ccc;
  padding: 8px;
  text-align: center;
}

</style>-->
<div class="table-container">
<table width="95%" border="1" cellpadding="0" cellspacing="0" id="ExportTable" style="margin:0px auto;">
<thead>
<tr>
    <th colspan="32" align="center" style="border:none;"><?=$str;?></th>
  </tr>
  
  <tr>
    <th rowspan="2" style="text-align:center; width:200px !important;"><strong>Date</strong></th>
    <th colspan="5" style="text-align:center;"><strong>1st Chamber </strong></th>
    <th>&nbsp;</th>
    <th colspan="5" style="text-align:center;"><strong>2nd Chamber </strong></th>
    <th><strong>Total</strong></th>
    <th colspan="5" style="text-align:center;"><strong>3rd Chamber   </strong>  </th>
    <th><strong>Total</strong></th>
    <th colspan="5" style="text-align:center;"><strong>4th Chamber </strong></th>
    <th><strong>Total</strong></th>
    <th colspan="5" style="text-align:center;"><strong>5th Chamber </strong></th>
   
    <th rowspan="2"><strong>Total</strong></th>
	 <th rowspan="2"><strong>Sub Total</strong></th>
  </tr>
  
  <tr>
  <th><strong>1st Floor</strong></th>
  <th><strong>2nd Floor</strong></th>
  <th><strong>3rd Floor</strong></th>
  <th><strong>4th Floor</strong></th>
  <th><strong>5th Floor</strong></th>
  <th><strong>Total</strong></th>
  
  <th><strong>1st Floor</strong></th>
  <th><strong>2nd Floor</strong></th>
  <th><strong>3rd Floor</strong></th>
  <th><strong>4th Floor</strong></th>
  <th><strong>5th Floor</strong></th>
  <th><strong>Total</strong></th>
  
  <th><strong>1st Floor</strong></th>
  <th><strong>2nd Floor</strong></th>
  <th><strong>3rd Floor</strong></th>
  <th><strong>4th Floor</strong></th>
  <th><strong>5th Floor</strong></th>
  <th><strong>Total</strong></th>
  
  <th><strong>1st Floor</strong></th>
  <th><strong>2nd Floor</strong></th>
  <th><strong>3rd Floor</strong></th>
  <th><strong>4th Floor</strong></th>
  <th><strong>5th Floor</strong></th>
  <th><strong>Total</strong></th>
  
  <th><strong>1st Floor</strong></th>
  <th><strong>2nd Floor</strong></th>
  <th><strong>3rd Floor</strong></th>
  <th><strong>4th Floor</strong></th>
  <th><strong>5th Floor</strong></th>
 
  
</tr>
</thead>
  
  <? 

		
// 1st Chamber start
  
  $sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Other Receive' and w.chamber=1 and w.floor=1 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c1_first_floor[$rw->ji_date]=$rw->in_qty;
  	}
	$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Other Receive' and w.chamber=1 and w.floor=2 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c1_sec_floor[$rw->ji_date]=$rw->in_qty;
  	}
	$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Other Receive' and w.chamber=1 and w.floor=3 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c1_third_floor[$rw->ji_date]=$rw->in_qty;
  	}
	
	$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Other Receive' and w.chamber=1 and w.floor=4 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c1_forth_floor[$rw->ji_date]=$rw->in_qty;
  	}
	
	$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Other Receive' and w.chamber=1 and w.floor=5 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c1_fifth_floor[$rw->ji_date]=$rw->in_qty;
  	}
	
	
	// 1st Chamber end
	
	// 2nd Chamber start
	
	$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Other Receive' and w.chamber=2 and w.floor=1 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c2_first_floor[$rw->ji_date]=$rw->in_qty;
  	}
	$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Other Receive' and w.chamber=2 and w.floor=2 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c2_sec_floor[$rw->ji_date]=$rw->in_qty;
  	}
	$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Other Receive' and w.chamber=2 and w.floor=3 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c2_third_floor[$rw->ji_date]=$rw->in_qty;
  	}
	
	$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Other Receive' and w.chamber=2 and w.floor=4 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c2_forth_floor[$rw->ji_date]=$rw->in_qty;
  	}
	
	$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Other Receive' and w.chamber=2 and w.floor=5 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c2_fifth_floor[$rw->ji_date]=$rw->in_qty;
  	}
	
	//2nd chamber end
	
	
	
	// 3rd Chamber start
	
	$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Other Receive' and w.chamber=3 and w.floor=1 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c3_first_floor[$rw->ji_date]=$rw->in_qty;
  	}
	$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Other Receive' and w.chamber=3 and w.floor=2 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c3_sec_floor[$rw->ji_date]=$rw->in_qty;
  	}
	$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Other Receive' and w.chamber=3 and w.floor=3 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c3_third_floor[$rw->ji_date]=$rw->in_qty;
  	}
	
	$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Other Receive' and w.chamber=3 and w.floor=4 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c3_forth_floor[$rw->ji_date]=$rw->in_qty;
  	}
	
	$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Other Receive' and w.chamber=3 and w.floor=5 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c3_fifth_floor[$rw->ji_date]=$rw->in_qty;
  	}
	
	//3rd chamber end
	
	
	// 4th Chamber start
	
	$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Other Receive' and w.chamber=4 and w.floor=1 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c4_first_floor[$rw->ji_date]=$rw->in_qty;
  	}
	$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Other Receive' and w.chamber=4 and w.floor=2 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c4_sec_floor[$rw->ji_date]=$rw->in_qty;
  	}
	$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Other Receive' and w.chamber=4 and w.floor=3 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c4_third_floor[$rw->ji_date]=$rw->in_qty;
  	}
	
	$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Other Receive' and w.chamber=4 and w.floor=4 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c4_forth_floor[$rw->ji_date]=$rw->in_qty;
  	}
	
	$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Other Receive' and w.chamber=4 and w.floor=5 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c4_fifth_floor[$rw->ji_date]=$rw->in_qty;
  	}
	
	//4th chamber end
	
	// 5th Chamber start
	
	$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Other Receive' and w.chamber=5 and w.floor=1 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c5_first_floor[$rw->ji_date]=$rw->in_qty;
  	}
	$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Other Receive' and w.chamber=5 and w.floor=2 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c5_sec_floor[$rw->ji_date]=$rw->in_qty;
  	}
	$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Other Receive' and w.chamber=5 and w.floor=3 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c5_third_floor[$rw->ji_date]=$rw->in_qty;
  	}
	
	$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Other Receive' and w.chamber=5 and w.floor=4 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c5_forth_floor[$rw->ji_date]=$rw->in_qty;
  	}
	
	$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Other Receive' and w.chamber=5 and w.floor=5 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c5_fifth_floor[$rw->ji_date]=$rw->in_qty;
  	}
	
	//5th chamber end
	
	$sql="select ji_date,warehouse_id from  journal_item  where tr_from='Other Receive' and ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."'  group by ji_date ";
  $q=mysql_query($sql);
  while($r=mysql_fetch_object($q))
	{
  
  	
  ?>
  <tbody>
  <tr>
    <td style="text-align:center; width:200px !important;"><?=$r->ji_date?></td>
    <td><?=number_format($c1_first_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c1_sec_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c1_third_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c1_forth_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c1_fifth_floor[$r->ji_date],0); ?></td>
    <td><?=$c1=$c1_first_floor[$r->ji_date]+$c1_sec_floor[$r->ji_date]+$c1_third_floor[$r->ji_date]+$c1_forth_floor[$r->ji_date]+$c1_fifth_floor[$r->ji_date]; ?></td>
    <td><?=number_format($c2_first_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c2_sec_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c2_third_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c2_forth_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c2_fifth_floor[$r->ji_date],0); ?></td>
    <td><?=$c2=$c2_first_floor[$r->ji_date]+$c2_sec_floor[$r->ji_date]+$c2_third_floor[$r->ji_date]+$c2_forth_floor[$r->ji_date]+$c2_fifth_floor[$r->ji_date]; ?></td>
    <td><?=number_format($c3_first_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c3_sec_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c3_third_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c3_forth_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c3_fifth_floor[$r->ji_date],0); ?></td>
    <td><?=$c3=$c3_first_floor[$r->ji_date]+$c3_sec_floor[$r->ji_date]+$c3_third_floor[$r->ji_date]+$c3_forth_floor[$r->ji_date]+$c3_fifth_floor[$r->ji_date]; ?></td>
    <td><?=number_format($c4_first_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c4_sec_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c4_third_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c4_forth_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c4_fifth_floor[$r->ji_date],0); ?></td>
    <td><?=$c4=$c4_first_floor[$r->ji_date]+$c4_sec_floor[$r->ji_date]+$c4_third_floor[$r->ji_date]+$c4_forth_floor[$r->ji_date]+$c4_fifth_floor[$r->ji_date]; ?></td>
    <td><?=number_format($c5_first_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c5_sec_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c5_third_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c5_forth_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c5_fifth_floor[$r->ji_date],0); ?></td>
    
    <td><?=$c5=$c5_first_floor[$r->ji_date]+$c5_sec_floor[$r->ji_date]+$c5_third_floor[$r->ji_date]+$c5_forth_floor[$r->ji_date]+$c5_fifth_floor[$r->ji_date];  ?></td>
 	<td><?=$sub_total=$c1+$c2+$c3+$c4+$c5; $intotal+=$sub_total; ?></td>
  </tr>
  
  <?
  
  $tot_f_c1+=$c1_first_floor[$r->ji_date]; 
  $tot_f_c2+=$c2_first_floor[$r->ji_date]; 
  $tot_f_c3+=$c3_first_floor[$r->ji_date]; 
  $tot_f_c4+=$c4_first_floor[$r->ji_date]; 
  $tot_f_c5+=$c5_first_floor[$r->ji_date];
  
  $tot_s_c1+=$c1_sec_floor[$r->ji_date]; 
  $tot_s_c2+=$c2_sec_floor[$r->ji_date]; 
  $tot_s_c3+=$c3_sec_floor[$r->ji_date]; 
  $tot_s_c4+=$c4_sec_floor[$r->ji_date]; 
  $tot_s_c5+=$c5_sec_floor[$r->ji_date]; 
  
  $tot_t_c1+=$c1_third_floor[$r->ji_date];
  $tot_t_c2+=$c2_third_floor[$r->ji_date];
  $tot_t_c3+=$c3_third_floor[$r->ji_date];
  $tot_t_c4+=$c4_third_floor[$r->ji_date];
  $tot_t_c5+=$c5_third_floor[$r->ji_date];
  
  $tot_fourth_c1+=$c1_forth_floor[$r->ji_date];
  $tot_fourth_c2+=$c2_forth_floor[$r->ji_date];
  $tot_fourth_c3+=$c3_forth_floor[$r->ji_date];
  $tot_fourth_c4+=$c4_forth_floor[$r->ji_date];
  $tot_fourth_c5+=$c5_forth_floor[$r->ji_date];
  
  
  $tot_fifth_c1+=$c1_fifth_floor[$r->ji_date];
  $tot_fifth_c2+=$c2_fifth_floor[$r->ji_date];
  $tot_fifth_c3+=$c3_fifth_floor[$r->ji_date];
  $tot_fifth_c4+=$c4_fifth_floor[$r->ji_date];
  $tot_fifth_c5+=$c5_fifth_floor[$r->ji_date];
  
  $total_chamber1+=$c1;
  $total_chamber2+=$c2;
  $total_chamber3+=$c3;
  $total_chamber4+=$c4;
  $total_chamber5+=$c5;
  
  
  } ?>
  
  
  <tr>
  <td align="center"><strong>Total</strong></td>
  <td><strong><?=$tot_f_c1;?></strong></td>
  <td><strong><?=$tot_s_c1;?></strong></td>
  <td><strong><?=$tot_t_c1;?></strong></td>
  <td><strong><?=$tot_fourth_c1;?></strong></td>
  <td><strong><?=$tot_fifth_c1;?></strong></td>
  
  <td><strong><?=$total_chamber1;?></strong></td>
  <td><strong><?=$tot_f_c2;?></strong></td>
  <td><strong><?=$tot_s_c2;?></strong></td>
  <td><strong><?=$tot_t_c2;?></strong></td>
  <td><strong><?=$tot_fourth_c2;?></strong></td>
  <td><strong><?=$tot_fifth_c2;?></strong></td>
  
  <td><strong><?=$total_chamber2;?></strong></td>
  
  
  <td><strong><?=$tot_f_c3;?></strong></td>
  <td><strong><?=$tot_s_c3;?></strong></td>
  <td><strong><?=$tot_t_c3;?></strong></td>
  <td><strong><?=$tot_fourth_c3;?></strong></td>
  <td><strong><?=$tot_fifth_c3;?></strong></td>
  
  <td><strong><?=$total_chamber3;?></strong></td>
 
  <td><strong><?=$tot_f_c4;?></strong></td>
  <td><strong><?=$tot_s_c4;?></strong></td>
  <td><strong><?=$tot_t_c4;?></strong></td>
  <td><strong><?=$tot_fourth_c4;?></strong></td>
  <td><strong><?=$tot_fifth_c4;?></strong></td>
  
  <td><strong><?=$total_chamber4;?></strong></td>
  
 
  <td><strong><?=$tot_f_c5;?></strong></td>
  <td><strong><?=$tot_s_c5;?></strong></td>
  <td><strong><?=$tot_t_c5;?></strong></td>
  <td><strong><?=$tot_fourth_c5;?></strong></td>
  <td><strong><?=$tot_fifth_c5;?></strong></td>
  
  
  <td><strong><?=$total_chamber5;?></strong></td>
  <td><strong><?=$intotal?></strong></td>
  </tr>
</tbody>
</table>
</div>

<?
}
elseif($_REQUEST['report']==8102522)
{


?>
<!--<style>

.table-container {
  max-height: 400px; /* Adjust as needed */
  overflow: auto;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th {
  position: sticky;
  top: 0;
  background: #fff; /* Or any background to cover content behind */
  z-index: 2;
  border: 1px solid #ccc;
  padding: 8px;
  text-align: center;
}

</style>-->
<!--<div class="table-container">
<table width="95%" border="1" cellpadding="0" cellspacing="0" id="ExportTable" style="margin:0px auto;">
<thead>
<tr>
    <th colspan="32" align="center" style="border:none;"><?=$str;?></th>
  </tr>
  
  <tr>
    <th rowspan="3" style="text-align:center; width:200px !important;"><strong>Date</strong></th>
    <th colspan="29" style="text-align:center;">Plot No </th>
    <th rowspan="3"><strong>Total</strong></th>
    <th rowspan="3"><strong>Sub Total</strong></th>
  </tr>
  <tr>
    <th colspan="5" style="text-align:center;"><strong>1st Chamber </strong></th>
    <th>&nbsp;</th>
    <th colspan="5" style="text-align:center;"><strong>2nd Chamber </strong></th>
    <th><strong>Total</strong></th>
    <th colspan="5" style="text-align:center;"><strong>3rd Chamber   </strong>  </th>
    <th><strong>Total</strong></th>
    <th colspan="5" style="text-align:center;"><strong>4th Chamber </strong></th>
    <th><strong>Total</strong></th>
    <th colspan="5" style="text-align:center;"><strong>5th Chamber </strong></th>
    </tr>
  
  <tr>
  <th><strong>1st Floor</strong></th>
  <th><strong>2nd Floor</strong></th>
  <th><strong>3rd Floor</strong></th>
  <th><strong>4th Floor</strong></th>
  <th><strong>5th Floor</strong></th>
  <th><strong>Total</strong></th>
  
  <th><strong>1st Floor</strong></th>
  <th><strong>2nd Floor</strong></th>
  <th><strong>3rd Floor</strong></th>
  <th><strong>4th Floor</strong></th>
  <th><strong>5th Floor</strong></th>
  <th><strong>Total</strong></th>
  
  <th><strong>1st Floor</strong></th>
  <th><strong>2nd Floor</strong></th>
  <th><strong>3rd Floor</strong></th>
  <th><strong>4th Floor</strong></th>
  <th><strong>5th Floor</strong></th>
  <th><strong>Total</strong></th>
  
  <th><strong>1st Floor</strong></th>
  <th><strong>2nd Floor</strong></th>
  <th><strong>3rd Floor</strong></th>
  <th><strong>4th Floor</strong></th>
  <th><strong>5th Floor</strong></th>
  <th><strong>Total</strong></th>
  
  <th><strong>1st Floor</strong></th>
  <th><strong>2nd Floor</strong></th>
  <th><strong>3rd Floor</strong></th>
  <th><strong>4th Floor</strong></th>
  <th><strong>5th Floor</strong></th>
</tr>
</thead>
  
  <?php
  if($_POST['palot_no']!='')
  {
  $plot_con=' and j.bag_size='.$_POST['palot_no'].'';
  
  }
  
// 1st Chamber start
  
echo $sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id 
from  journal_item j, warehouse w 
where w.warehouse_name=j.warehouse_id 
and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' 
and j.tr_from='Olot Palot' and w.chamber=1 and w.floor=1 ".$plot_con."
group by j.ji_date";
$q=mysql_query($sql);
while($rw=mysql_fetch_object($q)) {
    $c1_first_floor[$rw->ji_date]=$rw->in_qty;
}

$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id 
from  journal_item j, warehouse w 
where w.warehouse_name=j.warehouse_id 
and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' 
and j.tr_from='Olot Palot' and w.chamber=1 and w.floor=2 ".$plot_con."
group by j.ji_date";
$q=mysql_query($sql);
while($rw=mysql_fetch_object($q)) {
    $c1_sec_floor[$rw->ji_date]=$rw->in_qty;
}

$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id 
from  journal_item j, warehouse w 
where w.warehouse_name=j.warehouse_id 
and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' 
and j.tr_from='Olot Palot' and w.chamber=1 and w.floor=3 ".$plot_con."
group by j.ji_date";
$q=mysql_query($sql);
while($rw=mysql_fetch_object($q)) {
    $c1_third_floor[$rw->ji_date]=$rw->in_qty;
}

$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id 
from  journal_item j, warehouse w 
where w.warehouse_name=j.warehouse_id 
and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' 
and j.tr_from='Olot Palot' and w.chamber=1 and w.floor=4 ".$plot_con."
group by j.ji_date";
$q=mysql_query($sql);
while($rw=mysql_fetch_object($q)) {
    $c1_forth_floor[$rw->ji_date]=$rw->in_qty;
}

$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id 
from  journal_item j, warehouse w 
where w.warehouse_name=j.warehouse_id 
and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' 
and j.tr_from='Olot Palot' and w.chamber=1 and w.floor=5 ".$plot_con."
group by j.ji_date";
$q=mysql_query($sql);
while($rw=mysql_fetch_object($q)) {
    $c1_fifth_floor[$rw->ji_date]=$rw->in_qty;
}

// 1st Chamber end


// 2nd Chamber start

$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id 
from  journal_item j, warehouse w 
where w.warehouse_name=j.warehouse_id 
and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' 
and j.tr_from='Olot Palot' and w.chamber=2 and w.floor=1 ".$plot_con."
group by j.ji_date";
$q=mysql_query($sql);
while($rw=mysql_fetch_object($q)) {
    $c2_first_floor[$rw->ji_date]=$rw->in_qty;
}

$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id 
from  journal_item j, warehouse w 
where w.warehouse_name=j.warehouse_id 
and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' 
and j.tr_from='Olot Palot' and w.chamber=2 and w.floor=2 
group by j.ji_date";
$q=mysql_query($sql);
while($rw=mysql_fetch_object($q)) {
    $c2_sec_floor[$rw->ji_date]=$rw->in_qty;
}

$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id 
from  journal_item j, warehouse w 
where w.warehouse_name=j.warehouse_id 
and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' 
and j.tr_from='Olot Palot' and w.chamber=2 and w.floor=3 ".$plot_con."
group by j.ji_date";
$q=mysql_query($sql);
while($rw=mysql_fetch_object($q)) {
    $c2_third_floor[$rw->ji_date]=$rw->in_qty;
}

$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id 
from  journal_item j, warehouse w 
where w.warehouse_name=j.warehouse_id 
and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' 
and j.tr_from='Olot Palot' and w.chamber=2 and w.floor=4 ".$plot_con."
group by j.ji_date";
$q=mysql_query($sql);
while($rw=mysql_fetch_object($q)) {
    $c2_forth_floor[$rw->ji_date]=$rw->in_qty;
}

$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id 
from  journal_item j, warehouse w 
where w.warehouse_name=j.warehouse_id 
and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' 
and j.tr_from='Olot Palot' and w.chamber=2 and w.floor=5 ".$plot_con."
group by j.ji_date";
$q=mysql_query($sql);
while($rw=mysql_fetch_object($q)) {
    $c2_fifth_floor[$rw->ji_date]=$rw->in_qty;
}

// 2nd Chamber end


// 3rd Chamber start

$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id 
from  journal_item j, warehouse w 
where w.warehouse_name=j.warehouse_id 
and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' 
and j.tr_from='Olot Palot' and w.chamber=3 and w.floor=1 ".$plot_con."
group by j.ji_date";
$q=mysql_query($sql);
while($rw=mysql_fetch_object($q)) {
    $c3_first_floor[$rw->ji_date]=$rw->in_qty;
}

$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id 
from  journal_item j, warehouse w 
where w.warehouse_name=j.warehouse_id 
and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' 
and j.tr_from='Olot Palot' and w.chamber=3 and w.floor=2 ".$plot_con."
group by j.ji_date";
$q=mysql_query($sql);
while($rw=mysql_fetch_object($q)) {
    $c3_sec_floor[$rw->ji_date]=$rw->in_qty;
}

$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id 
from  journal_item j, warehouse w 
where w.warehouse_name=j.warehouse_id 
and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' 
and j.tr_from='Olot Palot' and w.chamber=3 and w.floor=3 ".$plot_con."
group by j.ji_date";
$q=mysql_query($sql);
while($rw=mysql_fetch_object($q)) {
    $c3_third_floor[$rw->ji_date]=$rw->in_qty;
}

$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id 
from  journal_item j, warehouse w 
where w.warehouse_name=j.warehouse_id 
and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' 
and j.tr_from='Olot Palot' and w.chamber=3 and w.floor=4 ".$plot_con."
group by j.ji_date";
$q=mysql_query($sql);
while($rw=mysql_fetch_object($q)) {
    $c3_forth_floor[$rw->ji_date]=$rw->in_qty;
}

$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id 
from  journal_item j, warehouse w 
where w.warehouse_name=j.warehouse_id 
and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' 
and j.tr_from='Olot Palot' and w.chamber=3 and w.floor=5 ".$plot_con."
group by j.ji_date";
$q=mysql_query($sql);
while($rw=mysql_fetch_object($q)) {
    $c3_fifth_floor[$rw->ji_date]=$rw->in_qty;
}

// 3rd Chamber end


// 4th Chamber start

$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id 
from  journal_item j, warehouse w 
where w.warehouse_name=j.warehouse_id 
and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' 
and j.tr_from='Olot Palot' and w.chamber=4 and w.floor=1 ".$plot_con."
group by j.ji_date";
$q=mysql_query($sql);
while($rw=mysql_fetch_object($q)) {
    $c4_first_floor[$rw->ji_date]=$rw->in_qty;
}

$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id 
from  journal_item j, warehouse w 
where w.warehouse_name=j.warehouse_id 
and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' 
and j.tr_from='Olot Palot' and w.chamber=4 and w.floor=2 ".$plot_con."
group by j.ji_date";
$q=mysql_query($sql);
while($rw=mysql_fetch_object($q)) {
    $c4_sec_floor[$rw->ji_date]=$rw->in_qty;
}

$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id 
from  journal_item j, warehouse w 
where w.warehouse_name=j.warehouse_id 
and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' 
and j.tr_from='Olot Palot' and w.chamber=4 and w.floor=3 ".$plot_con."
group by j.ji_date";
$q=mysql_query($sql);
while($rw=mysql_fetch_object($q)) {
    $c4_third_floor[$rw->ji_date]=$rw->in_qty;
}

$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id 
from  journal_item j, warehouse w 
where w.warehouse_name=j.warehouse_id 
and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' 
and j.tr_from='Olot Palot' and w.chamber=4 and w.floor=4 ".$plot_con."
group by j.ji_date";
$q=mysql_query($sql);
while($rw=mysql_fetch_object($q)) {
    $c4_forth_floor[$rw->ji_date]=$rw->in_qty;
}

$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id 
from  journal_item j, warehouse w 
where w.warehouse_name=j.warehouse_id 
and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' 
and j.tr_from='Olot Palot' and w.chamber=4 and w.floor=5 ".$plot_con."
group by j.ji_date";
$q=mysql_query($sql);
while($rw=mysql_fetch_object($q)) {
    $c4_fifth_floor[$rw->ji_date]=$rw->in_qty;
}

// 4th Chamber end


// 5th Chamber start

$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id 
from  journal_item j, warehouse w 
where w.warehouse_name=j.warehouse_id 
and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' 
and j.tr_from='Olot Palot' and w.chamber=5 and w.floor=1 ".$plot_con."
group by j.ji_date";
$q=mysql_query($sql);
while($rw=mysql_fetch_object($q)) {
    $c5_first_floor[$rw->ji_date]=$rw->in_qty;
}

$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id 
from  journal_item j, warehouse w 
where w.warehouse_name=j.warehouse_id 
and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' 
and j.tr_from='Olot Palot' and w.chamber=5 and w.floor=2 ".$plot_con."
group by j.ji_date";
$q=mysql_query($sql);
while($rw=mysql_fetch_object($q)) {
    $c5_sec_floor[$rw->ji_date]=$rw->in_qty;
}

$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id 
from  journal_item j, warehouse w 
where w.warehouse_name=j.warehouse_id 
and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' 
and j.tr_from='Olot Palot' and w.chamber=5 and w.floor=3 ".$plot_con."
group by j.ji_date";
$q=mysql_query($sql);
while($rw=mysql_fetch_object($q)) {
    $c5_third_floor[$rw->ji_date]=$rw->in_qty;
}

$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id 
from  journal_item j, warehouse w 
where w.warehouse_name=j.warehouse_id 
and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' 
and j.tr_from='Olot Palot' and w.chamber=5 and w.floor=4 ".$plot_con."
group by j.ji_date";
$q=mysql_query($sql);
while($rw=mysql_fetch_object($q)) {
    $c5_forth_floor[$rw->ji_date]=$rw->in_qty;
}

$sql="select sum(j.item_in) as in_qty,j.ji_date,j.warehouse_id 
from  journal_item j, warehouse w 
where w.warehouse_name=j.warehouse_id 
and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' 
and j.tr_from='Olot Palot' and w.chamber=5 and w.floor=5 ".$plot_con."
group by j.ji_date";
$q=mysql_query($sql);
while($rw=mysql_fetch_object($q)) {
    $c5_fifth_floor[$rw->ji_date]=$rw->in_qty;
}

// 5th Chamber end


// Final query
$sql="select ji_date,warehouse_id from journal_item 
where tr_from='Olot Palot' 
and ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."'  
group by ji_date";
$q=mysql_query($sql);
while($r=mysql_fetch_object($q)) {


  
  	
  ?>
  <tbody>
  <tr>
    <td style="text-align:center; width:200px !important;"><?=$r->ji_date?></td>
    <td><?=number_format($c1_first_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c1_sec_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c1_third_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c1_forth_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c1_fifth_floor[$r->ji_date],0); ?></td>
    <td><?=$c1=$c1_first_floor[$r->ji_date]+$c1_sec_floor[$r->ji_date]+$c1_third_floor[$r->ji_date]+$c1_forth_floor[$r->ji_date]+$c1_fifth_floor[$r->ji_date]; ?></td>
    <td><?=number_format($c2_first_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c2_sec_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c2_third_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c2_forth_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c2_fifth_floor[$r->ji_date],0); ?></td>
    <td><?=$c2=$c2_first_floor[$r->ji_date]+$c2_sec_floor[$r->ji_date]+$c2_third_floor[$r->ji_date]+$c2_forth_floor[$r->ji_date]+$c2_fifth_floor[$r->ji_date]; ?></td>
    <td><?=number_format($c3_first_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c3_sec_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c3_third_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c3_forth_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c3_fifth_floor[$r->ji_date],0); ?></td>
    <td><?=$c3=$c3_first_floor[$r->ji_date]+$c3_sec_floor[$r->ji_date]+$c3_third_floor[$r->ji_date]+$c3_forth_floor[$r->ji_date]+$c3_fifth_floor[$r->ji_date]; ?></td>
    <td><?=number_format($c4_first_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c4_sec_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c4_third_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c4_forth_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c4_fifth_floor[$r->ji_date],0); ?></td>
    <td><?=$c4=$c4_first_floor[$r->ji_date]+$c4_sec_floor[$r->ji_date]+$c4_third_floor[$r->ji_date]+$c4_forth_floor[$r->ji_date]+$c4_fifth_floor[$r->ji_date]; ?></td>
    <td><?=number_format($c5_first_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c5_sec_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c5_third_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c5_forth_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c5_fifth_floor[$r->ji_date],0); ?></td>
    
    <td><?=$c5=$c5_first_floor[$r->ji_date]+$c5_sec_floor[$r->ji_date]+$c5_third_floor[$r->ji_date]+$c5_forth_floor[$r->ji_date]+$c5_fifth_floor[$r->ji_date];  ?></td>
 	<td><?=$sub_total=$c1+$c2+$c3+$c4+$c5; $intotal+=$sub_total; ?></td>
  </tr>
  
  <?
  
  $tot_f_c1+=$c1_first_floor[$r->ji_date]; 
  $tot_f_c2+=$c2_first_floor[$r->ji_date]; 
  $tot_f_c3+=$c3_first_floor[$r->ji_date]; 
  $tot_f_c4+=$c4_first_floor[$r->ji_date]; 
  $tot_f_c5+=$c5_first_floor[$r->ji_date];
  
  $tot_s_c1+=$c1_sec_floor[$r->ji_date]; 
  $tot_s_c2+=$c2_sec_floor[$r->ji_date]; 
  $tot_s_c3+=$c3_sec_floor[$r->ji_date]; 
  $tot_s_c4+=$c4_sec_floor[$r->ji_date]; 
  $tot_s_c5+=$c5_sec_floor[$r->ji_date]; 
  
  $tot_t_c1+=$c1_third_floor[$r->ji_date];
  $tot_t_c2+=$c2_third_floor[$r->ji_date];
  $tot_t_c3+=$c3_third_floor[$r->ji_date];
  $tot_t_c4+=$c4_third_floor[$r->ji_date];
  $tot_t_c5+=$c5_third_floor[$r->ji_date];
  
  $tot_fourth_c1+=$c1_forth_floor[$r->ji_date];
  $tot_fourth_c2+=$c2_forth_floor[$r->ji_date];
  $tot_fourth_c3+=$c3_forth_floor[$r->ji_date];
  $tot_fourth_c4+=$c4_forth_floor[$r->ji_date];
  $tot_fourth_c5+=$c5_forth_floor[$r->ji_date];
  
  
  $tot_fifth_c1+=$c1_fifth_floor[$r->ji_date];
  $tot_fifth_c2+=$c2_fifth_floor[$r->ji_date];
  $tot_fifth_c3+=$c3_fifth_floor[$r->ji_date];
  $tot_fifth_c4+=$c4_fifth_floor[$r->ji_date];
  $tot_fifth_c5+=$c5_fifth_floor[$r->ji_date];
  
  $total_chamber1+=$c1;
  $total_chamber2+=$c2;
  $total_chamber3+=$c3;
  $total_chamber4+=$c4;
  $total_chamber5+=$c5;
  
  
  } ?>
  
  
  <tr>
  <td align="center"><strong>Total</strong></td>
  <td><strong><?=$tot_f_c1;?></strong></td>
  <td><strong><?=$tot_s_c1;?></strong></td>
  <td><strong><?=$tot_t_c1;?></strong></td>
  <td><strong><?=$tot_fourth_c1;?></strong></td>
  <td><strong><?=$tot_fifth_c1;?></strong></td>
  
  <td><strong><?=$total_chamber1;?></strong></td>
  <td><strong><?=$tot_f_c2;?></strong></td>
  <td><strong><?=$tot_s_c2;?></strong></td>
  <td><strong><?=$tot_t_c2;?></strong></td>
  <td><strong><?=$tot_fourth_c2;?></strong></td>
  <td><strong><?=$tot_fifth_c2;?></strong></td>
  
  <td><strong><?=$total_chamber2;?></strong></td>
  
  
  <td><strong><?=$tot_f_c3;?></strong></td>
  <td><strong><?=$tot_s_c3;?></strong></td>
  <td><strong><?=$tot_t_c3;?></strong></td>
  <td><strong><?=$tot_fourth_c3;?></strong></td>
  <td><strong><?=$tot_fifth_c3;?></strong></td>
  
  <td><strong><?=$total_chamber3;?></strong></td>
 
  <td><strong><?=$tot_f_c4;?></strong></td>
  <td><strong><?=$tot_s_c4;?></strong></td>
  <td><strong><?=$tot_t_c4;?></strong></td>
  <td><strong><?=$tot_fourth_c4;?></strong></td>
  <td><strong><?=$tot_fifth_c4;?></strong></td>
  
  <td><strong><?=$total_chamber4;?></strong></td>
  
 
  <td><strong><?=$tot_f_c5;?></strong></td>
  <td><strong><?=$tot_s_c5;?></strong></td>
  <td><strong><?=$tot_t_c5;?></strong></td>
  <td><strong><?=$tot_fourth_c5;?></strong></td>
  <td><strong><?=$tot_fifth_c5;?></strong></td>
  
  
  <td><strong><?=$total_chamber5;?></strong></td>
  <td><strong><?=$intotal?></strong></td>
  </tr>
</tbody>
</table>
</div>-->
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 10px;
  }

  .table-container {
    margin-bottom: 40px;
    border: 1px solid #aaa;
    overflow-y: auto;
    max-height: 550px;
  }

  table {
    border-collapse: collapse;
    width: 100%;
    font-size: 13px;
    text-align: center;
  }

  th, td {
    border: 1px solid #999;
    padding: 4px;
  }

  thead th {
    position: sticky;
    top: 0;
    background: #f7f7f7;
    z-index: 2;
  }

  h3 {
    text-align: center;
    margin: 25px 0 10px 0;
    background: #eaeaea;
    padding: 6px;
    border-radius: 6px;
  }

  /* Print adjustments */
  @media print {
    body {
      overflow: visible;
    }
    .table-container {
      overflow: visible !important;
      max-height: none;
      border: none;
    }
    thead th {
      position: static !important;
      background: #f2f2f2 !important;
    }
   /* h3 {
      page-break-before: always;
    }*/
  }
</style>
<div id="ExportTable">
<p><?=$str;?></p>
<?php
$plots = [1, 2, 3, 4, 5];



foreach ($plots as $plot_no) {
    echo "<h3 style='text-align:center;'>Plot No - {$plot_no}</h3>";
    echo '<div style="text-align:center;">';
    echo '<table border="1"  cellspacing="0" cellpadding="4" style="width:100%; border-collapse:collapse; text-align:center;">
    <thead>
	   
      <tr>
        <th rowspan="3" style="width:120px; text-align:center;">Date</th>
        <th colspan="30" >Plot No ' . $plot_no . '</th>
        <th rowspan="3">Sub Total</th>
      </tr>
      <tr>
        <th colspan="6" style="text-align:center;">1st Chamber</th>
        <th colspan="6" style="text-align:center;">2nd Chamber</th>
        <th colspan="6" style="text-align:center;">3rd Chamber</th>
        <th colspan="6" style="text-align:center;">4th Chamber</th>
        <th colspan="6" style="text-align:center;">5th Chamber</th>
      </tr>
      <tr>
        <th>1st</th><th>2nd</th><th>3rd</th><th>4th</th><th>5th</th><th>Total</th>
        <th>1st</th><th>2nd</th><th>3rd</th><th>4th</th><th>5th</th><th>Total</th>
        <th>1st</th><th>2nd</th><th>3rd</th><th>4th</th><th>5th</th><th>Total</th>
        <th>1st</th><th>2nd</th><th>3rd</th><th>4th</th><th>5th</th><th>Total</th>
        <th>1st</th><th>2nd</th><th>3rd</th><th>4th</th><th>5th</th><th>Total</th>
      </tr>
    </thead>
    <tbody>';

    $plot_con = "AND j.bag_size = {$plot_no}";

    $sql = "
        SELECT 
            j.ji_date,
            w.chamber,
            w.floor,
            SUM(j.item_in) AS in_qty
        FROM journal_item j
        JOIN warehouse w ON w.warehouse_name = j.warehouse_id
        WHERE j.tr_from = 'Olot Palot'
        AND j.ji_date BETWEEN '{$_POST['f_date']}' AND '{$_POST['t_date']}'
        {$plot_con}
        GROUP BY j.ji_date, w.chamber, w.floor
    ";
    $q = mysql_query($sql);

    $data = [];
    while ($r = mysql_fetch_object($q)) {
        $data[$r->ji_date][$r->chamber][$r->floor] = $r->in_qty;
    }

    $dates = array_keys($data);
    sort($dates);

    // Initialize totals
    $grand_total = 0;
    $total_per_chamber = [];
    $total_per_floor = [];

    foreach ($dates as $date) {
        echo "<tr><td>{$date}</td>";
        $date_total = 0;

        for ($ch = 1; $ch <= 5; $ch++) {
            $ch_total = 0;

            for ($fl = 1; $fl <= 5; $fl++) {
                $val = isset($data[$date][$ch][$fl]) ? $data[$date][$ch][$fl] : 0;
                echo "<td>" . number_format($val, 0) . "</td>";

                $ch_total += $val;
                $total_per_floor[$ch][$fl] = ($total_per_floor[$ch][$fl]) + $val;
            }

            echo "<td><strong>" . number_format($ch_total, 0) . "</strong></td>";

            $date_total += $ch_total;
            $total_per_chamber[$ch] = ($total_per_chamber[$ch]) + $ch_total;
        }

        echo "<td><strong>" . number_format($date_total, 0) . "</strong></td></tr>";

        $grand_total += $date_total;
    }

    // Bottom TOTAL row (red boxed section)
    echo "<tr style='font-weight:bold; background:#ffeaea; color:#c00;'>
      <td>Total</td>";

    for ($ch = 1; $ch <= 5; $ch++) {
        $ch_total = 0;
        for ($fl = 1; $fl <= 5; $fl++) {
            $val = isset($total_per_floor[$ch][$fl]) ? $total_per_floor[$ch][$fl] : 0;
            echo "<td>" . number_format($val, 0) . "</td>";
            $ch_total += $val;
        }
        echo "<td>" . number_format($ch_total, 0) . "</td>";
    }

    echo "<td>" . number_format($grand_total, 0) . "</td></tr>";

    echo '</tbody></table></div>';
}

?>
</div>

<?

}
elseif($_REQUEST['report']==810252)
{

?>
<!--<style>

.table-container {
  max-height: 400px; /* Adjust as needed */
  overflow: auto;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th {
  position: sticky;
  top: 0;
  background: #fff; /* Or any background to cover content behind */
  z-index: 2;
  border: 1px solid #ccc;
  padding: 8px;
  text-align: center;
}

</style>-->
<div class="table-container">
<table width="100%" border="1" cellpadding="0" cellspacing="0" id="ExportTable" style="margin:0px auto;">
<thead>
<tr>
    <th colspan="32" align="center" style="border:none;"><?=$str;?></th>
  </tr>
  
  <tr>
    <th rowspan="2" style="text-align:center; width:100px !important;"><strong>Date</strong></th>
    <th colspan="5" style="text-align:center;"><strong>1st Chamber </strong></th>
    <th>&nbsp;</th>
    <th colspan="5" style="text-align:center;"><strong>2nd Chamber </strong></th>
    <th><strong>Total</strong></th>
    <th colspan="5" style="text-align:center;"><strong>3rd Chamber   </strong>  </th>
    <th><strong>Total</strong></th>
    <th colspan="5" style="text-align:center;"><strong>4th Chamber </strong></th>
    <th><strong>Total</strong></th>
    <th colspan="5" style="text-align:center;"><strong>5th Chamber </strong></th>
   
    <th rowspan="2"><strong>Total</strong></th>
	 <th rowspan="2"><strong>Sub Total</strong></th>
  </tr>
  
  <tr>
  <th><strong>1st Floor</strong></th>
  <th><strong>2nd Floor</strong></th>
  <th><strong>3rd Floor</strong></th>
  <th><strong>4th Floor</strong></th>
  <th><strong>5th Floor</strong></th>
  <th><strong>Total</strong></th>
  
  <th><strong>1st Floor</strong></th>
  <th><strong>2nd Floor</strong></th>
  <th><strong>3rd Floor</strong></th>
  <th><strong>4th Floor</strong></th>
  <th><strong>5th Floor</strong></th>
  <th><strong>Total</strong></th>
  
  <th><strong>1st Floor</strong></th>
  <th><strong>2nd Floor</strong></th>
  <th><strong>3rd Floor</strong></th>
  <th><strong>4th Floor</strong></th>
  <th><strong>5th Floor</strong></th>
  <th><strong>Total</strong></th>
  
  <th><strong>1st Floor</strong></th>
  <th><strong>2nd Floor</strong></th>
  <th><strong>3rd Floor</strong></th>
  <th><strong>4th Floor</strong></th>
  <th><strong>5th Floor</strong></th>
  <th><strong>Total</strong></th>
  
  <th><strong>1st Floor</strong></th>
  <th><strong>2nd Floor</strong></th>
  <th><strong>3rd Floor</strong></th>
  <th><strong>4th Floor</strong></th>
  <th><strong>5th Floor</strong></th>
 
  
</tr>
</thead>
  
  <? 

		
// 1st Chamber start
  
  $sql="select sum(j.item_ex) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Sales' and w.chamber=1 and w.floor=1 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c1_first_floor[$rw->ji_date]=$rw->in_qty;
  	}
	$sql="select sum(j.item_ex) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Sales' and w.chamber=1 and w.floor=2 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c1_sec_floor[$rw->ji_date]=$rw->in_qty;
  	}
	$sql="select sum(j.item_ex) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Sales' and w.chamber=1 and w.floor=3 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c1_third_floor[$rw->ji_date]=$rw->in_qty;
  	}
	
	$sql="select sum(j.item_ex) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Sales' and w.chamber=1 and w.floor=4 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c1_forth_floor[$rw->ji_date]=$rw->in_qty;
  	}
	
	$sql="select sum(j.item_ex) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Sales' and w.chamber=1 and w.floor=5 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c1_fifth_floor[$rw->ji_date]=$rw->in_qty;
  	}
	
	
	// 1st Chamber end
	
	// 2nd Chamber start
	
	$sql="select sum(j.item_ex) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Sales' and w.chamber=2 and w.floor=1 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c2_first_floor[$rw->ji_date]=$rw->in_qty;
  	}
	$sql="select sum(j.item_ex) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Sales' and w.chamber=2 and w.floor=2 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c2_sec_floor[$rw->ji_date]=$rw->in_qty;
  	}
	$sql="select sum(j.item_ex) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Sales' and w.chamber=2 and w.floor=3 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c2_third_floor[$rw->ji_date]=$rw->in_qty;
  	}
	
	$sql="select sum(j.item_ex) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Sales' and w.chamber=2 and w.floor=4 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c2_forth_floor[$rw->ji_date]=$rw->in_qty;
  	}
	
	$sql="select sum(j.item_ex) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Sales' and w.chamber=2 and w.floor=5 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c2_fifth_floor[$rw->ji_date]=$rw->in_qty;
  	}
	
	//2nd chamber end
	
	
	
	// 3rd Chamber start
	
	$sql="select sum(j.item_ex) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Sales' and w.chamber=3 and w.floor=1 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c3_first_floor[$rw->ji_date]=$rw->in_qty;
  	}
	$sql="select sum(j.item_ex) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Sales' and w.chamber=3 and w.floor=2 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c3_sec_floor[$rw->ji_date]=$rw->in_qty;
  	}
	$sql="select sum(j.item_ex) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Sales' and w.chamber=3 and w.floor=3 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c3_third_floor[$rw->ji_date]=$rw->in_qty;
  	}
	
	$sql="select sum(j.item_ex) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Sales' and w.chamber=3 and w.floor=4 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c3_forth_floor[$rw->ji_date]=$rw->in_qty;
  	}
	
	$sql="select sum(j.item_ex) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Sales' and w.chamber=3 and w.floor=5 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c3_fifth_floor[$rw->ji_date]=$rw->in_qty;
  	}
	
	//3rd chamber end
	
	
	// 4th Chamber start
	
	$sql="select sum(j.item_ex) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Sales' and w.chamber=4 and w.floor=1 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c4_first_floor[$rw->ji_date]=$rw->in_qty;
  	}
	$sql="select sum(j.item_ex) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Sales' and w.chamber=4 and w.floor=2 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c4_sec_floor[$rw->ji_date]=$rw->in_qty;
  	}
	$sql="select sum(j.item_ex) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Sales' and w.chamber=4 and w.floor=3 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c4_third_floor[$rw->ji_date]=$rw->in_qty;
  	}
	
	$sql="select sum(j.item_ex) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Sales' and w.chamber=4 and w.floor=4 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c4_forth_floor[$rw->ji_date]=$rw->in_qty;
  	}
	
	$sql="select sum(j.item_ex) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Sales' and w.chamber=4 and w.floor=5 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c4_fifth_floor[$rw->ji_date]=$rw->in_qty;
  	}
	
	//4th chamber end
	
	// 5th Chamber start
	
	$sql="select sum(j.item_ex) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Sales' and w.chamber=5 and w.floor=1 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c5_first_floor[$rw->ji_date]=$rw->in_qty;
  	}
	$sql="select sum(j.item_ex) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Sales' and w.chamber=5 and w.floor=2 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c5_sec_floor[$rw->ji_date]=$rw->in_qty;
  	}
	$sql="select sum(j.item_ex) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Sales' and w.chamber=5 and w.floor=3 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c5_third_floor[$rw->ji_date]=$rw->in_qty;
  	}
	
	$sql="select sum(j.item_ex) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Sales' and w.chamber=5 and w.floor=4 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c5_forth_floor[$rw->ji_date]=$rw->in_qty;
  	}
	
	$sql="select sum(j.item_ex) as in_qty,j.ji_date,j.warehouse_id from  journal_item j, warehouse w where w.warehouse_name=j.warehouse_id and j.ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."' and j.tr_from='Sales' and w.chamber=5 and w.floor=5 group by j.ji_date";
  $q=mysql_query($sql);
  while($rw=mysql_fetch_object($q))
	{
  	$c5_fifth_floor[$rw->ji_date]=$rw->in_qty;
  	}
	
	//5th chamber end
	
	$sql="select ji_date,warehouse_id from  journal_item  where tr_from='Sales' and ji_date between '".$_POST['f_date']."' and '".$_POST['t_date']."'  group by ji_date ";
  $q=mysql_query($sql);
  while($r=mysql_fetch_object($q))
	{
  
  	
  ?>
  <tbody>
  <tr>
    <td style="text-align:center; width:100px !important;"><?=$r->ji_date?></td>
    <td><?=number_format($c1_first_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c1_sec_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c1_third_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c1_forth_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c1_fifth_floor[$r->ji_date],0); ?></td>
    <td><?=$c1=$c1_first_floor[$r->ji_date]+$c1_sec_floor[$r->ji_date]+$c1_third_floor[$r->ji_date]+$c1_forth_floor[$r->ji_date]+$c1_fifth_floor[$r->ji_date]; ?></td>
    <td><?=number_format($c2_first_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c2_sec_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c2_third_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c2_forth_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c2_fifth_floor[$r->ji_date],0); ?></td>
    <td><?=$c2=$c2_first_floor[$r->ji_date]+$c2_sec_floor[$r->ji_date]+$c2_third_floor[$r->ji_date]+$c2_forth_floor[$r->ji_date]+$c2_fifth_floor[$r->ji_date]; ?></td>
    <td><?=number_format($c3_first_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c3_sec_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c3_third_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c3_forth_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c3_fifth_floor[$r->ji_date],0); ?></td>
    <td><?=$c3=$c3_first_floor[$r->ji_date]+$c3_sec_floor[$r->ji_date]+$c3_third_floor[$r->ji_date]+$c3_forth_floor[$r->ji_date]+$c3_fifth_floor[$r->ji_date]; ?></td>
    <td><?=number_format($c4_first_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c4_sec_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c4_third_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c4_forth_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c4_fifth_floor[$r->ji_date],0); ?></td>
    <td><?=$c4=$c4_first_floor[$r->ji_date]+$c4_sec_floor[$r->ji_date]+$c4_third_floor[$r->ji_date]+$c4_forth_floor[$r->ji_date]+$c4_fifth_floor[$r->ji_date]; ?></td>
    <td><?=number_format($c5_first_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c5_sec_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c5_third_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c5_forth_floor[$r->ji_date],0); ?></td>
    <td><?=number_format($c5_fifth_floor[$r->ji_date],0); ?></td>
    
    <td><?=$c5=$c5_first_floor[$r->ji_date]+$c5_sec_floor[$r->ji_date]+$c5_third_floor[$r->ji_date]+$c5_forth_floor[$r->ji_date]+$c5_fifth_floor[$r->ji_date];  ?></td>
 	<td><?=$sub_total=$c1+$c2+$c3+$c4+$c5; $intotal+=$sub_total; ?></td>
  </tr>
  
  <?
  
  $tot_f_c1+=$c1_first_floor[$r->ji_date]; 
  $tot_f_c2+=$c2_first_floor[$r->ji_date]; 
  $tot_f_c3+=$c3_first_floor[$r->ji_date]; 
  $tot_f_c4+=$c4_first_floor[$r->ji_date]; 
  $tot_f_c5+=$c5_first_floor[$r->ji_date];
  
  $tot_s_c1+=$c1_sec_floor[$r->ji_date]; 
  $tot_s_c2+=$c2_sec_floor[$r->ji_date]; 
  $tot_s_c3+=$c3_sec_floor[$r->ji_date]; 
  $tot_s_c4+=$c4_sec_floor[$r->ji_date]; 
  $tot_s_c5+=$c5_sec_floor[$r->ji_date]; 
  
  $tot_t_c1+=$c1_third_floor[$r->ji_date];
  $tot_t_c2+=$c2_third_floor[$r->ji_date];
  $tot_t_c3+=$c3_third_floor[$r->ji_date];
  $tot_t_c4+=$c4_third_floor[$r->ji_date];
  $tot_t_c5+=$c5_third_floor[$r->ji_date];
  
  $tot_fourth_c1+=$c1_forth_floor[$r->ji_date];
  $tot_fourth_c2+=$c2_forth_floor[$r->ji_date];
  $tot_fourth_c3+=$c3_forth_floor[$r->ji_date];
  $tot_fourth_c4+=$c4_forth_floor[$r->ji_date];
  $tot_fourth_c5+=$c5_forth_floor[$r->ji_date];
  
  
  $tot_fifth_c1+=$c1_fifth_floor[$r->ji_date];
  $tot_fifth_c2+=$c2_fifth_floor[$r->ji_date];
  $tot_fifth_c3+=$c3_fifth_floor[$r->ji_date];
  $tot_fifth_c4+=$c4_fifth_floor[$r->ji_date];
  $tot_fifth_c5+=$c5_fifth_floor[$r->ji_date];
  
  $total_chamber1+=$c1;
  $total_chamber2+=$c2;
  $total_chamber3+=$c3;
  $total_chamber4+=$c4;
  $total_chamber5+=$c5;
  
  
  } ?>
  
  
  <tr>
  <td align="center"><strong>Total</strong></td>
  <td><strong><?=$tot_f_c1;?></strong></td>
  <td><strong><?=$tot_s_c1;?></strong></td>
  <td><strong><?=$tot_t_c1;?></strong></td>
  <td><strong><?=$tot_fourth_c1;?></strong></td>
  <td><strong><?=$tot_fifth_c1;?></strong></td>
  
  <td><strong><?=$total_chamber1;?></strong></td>
  <td><strong><?=$tot_f_c2;?></strong></td>
  <td><strong><?=$tot_s_c2;?></strong></td>
  <td><strong><?=$tot_t_c2;?></strong></td>
  <td><strong><?=$tot_fourth_c2;?></strong></td>
  <td><strong><?=$tot_fifth_c2;?></strong></td>
  
  <td><strong><?=$total_chamber2;?></strong></td>
  
  
  <td><strong><?=$tot_f_c3;?></strong></td>
  <td><strong><?=$tot_s_c3;?></strong></td>
  <td><strong><?=$tot_t_c3;?></strong></td>
  <td><strong><?=$tot_fourth_c3;?></strong></td>
  <td><strong><?=$tot_fifth_c3;?></strong></td>
  
  <td><strong><?=$total_chamber3;?></strong></td>
 
  <td><strong><?=$tot_f_c4;?></strong></td>
  <td><strong><?=$tot_s_c4;?></strong></td>
  <td><strong><?=$tot_t_c4;?></strong></td>
  <td><strong><?=$tot_fourth_c4;?></strong></td>
  <td><strong><?=$tot_fifth_c4;?></strong></td>
  
  <td><strong><?=$total_chamber4;?></strong></td>
  
 
  <td><strong><?=$tot_f_c5;?></strong></td>
  <td><strong><?=$tot_s_c5;?></strong></td>
  <td><strong><?=$tot_t_c5;?></strong></td>
  <td><strong><?=$tot_fourth_c5;?></strong></td>
  <td><strong><?=$tot_fifth_c5;?></strong></td>
  
  
  <td><strong><?=$total_chamber5;?></strong></td>
  <td><strong><?=$intotal?></strong></td>
  </tr>
</tbody>
</table>
</div>

<?
}
elseif($_REQUEST['report']==8102521)
{
?>

<?php
// Database connection here

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
			<th colspan="20" style="border:none"><?=$str;?></th>
		</tr>
      <tr>
        <th rowspan="2">Date</th>
        <th rowspan="2">Invoice No</th>
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
WHERE p.booking_year = 2025
  
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


 $sql1 = "
SELECT *
FROM  paid_booking 
WHERE booking_year=2025 group by booking_number_eng
";

$q1 = mysql_query($sql1);


	  
	   while ($r = mysql_fetch_object($q1)) { 
	   
	   if($loan[$r->booking_number_eng]>0 || $bag_loan_rec[$r->booking_number_eng]>0)
	   {
	   ?>
	   
	   
        <tr>
          <td><?= $r->booking_date; ?></td>
          <td></td>
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
		  <td><?=$sr_loan[$r->booking_number_eng]; $sr_cr+=$sr_loan[$r->booking_number_eng]; ?></td>
		  <td></td>
		  <td><?=$days[$r->booking_number_eng]?></td>
		  <td><?=$interest[$r->booking_number_eng]; $interest_cr+=$interest[$r->booking_number_eng]; ?></td>
		  <td><?=$tot_paid=$bag_loan[$r->booking_number_eng]+$sr_loan[$r->booking_number_eng]; $t_paid+=$tot_paid; ?></td>
		  
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
elseif($_REQUEST['report']==250625)
{

		if(isset($dealer_type)){
		if($dealer_type=='MordernTrade')		{$dealer_type_con = ' and ( d.dealer_type="Corporate" or  d.dealer_type="SuperShop" or  d.product_group="M") ';}
		else 	{$dealer_type_con = ' and d.dealer_type="'.$dealer_type.'"';}
		}
if(isset($depot_id)) 	{$depot_con=' and c.depot_id="'.$depot_id.'"';} 
if(isset($region_id)) 	{$region_con=' and d.region_id='.$region_id;}
if(isset($zone_id)) 	{$zone_con=' and d.zone_id='.$zone_id;}
if(isset($dealer_code)) 	{$dealer_con=' and d.dealer_code='.$dealer_code;}

$date_con=" and c.chalan_date between '".$_POST['f_date']."' and '".$_POST['t_date']."'";

if($_POST['booking_type']!='')
{
$booking_type='and c.booking_type="'.$_POST['booking_type'].'"';
}

if($_POST['rec_year']!='')
{
$rec_year='and p.booking_year="'.$_POST['rec_year'].'"';
}

if($_POST['booking_number']!='')
{
$booking_number='and c.booking_no="'.$_POST['booking_number'].'"';
}
if($_POST['sr_number']!='')
{
$sr_number='and c.sr_no="'.$_POST['sr_number'].'"';
}

?>

 <div id="ExportTable">
<table width="100%" cellspacing="0" cellpadding="2" border="0" >
<thead><tr><td style="border:0px;" colspan="21"><?=$str?></td></tr>
	
	
  <tr>
    <th rowspan="2">ক্রমিক নং</th>
    <th rowspan="2">ডিও নং</th>
    <th rowspan="2"  style="white-space: nowrap;" >তারিখ</th>
    <th rowspan="2"  style="white-space: nowrap;" >নাম</th>
    <th rowspan="2">বুকিং নং</th>
    <th rowspan="2">এস.আর নং</th>
    <th rowspan="2">বস্তার সংখ্যা</th>
    <th rowspan="2">ইউনিট মূল্য</th>
    <th rowspan="2">কেজি</th>
    <th rowspan="2">ভাড়া</th>
    <th rowspan="2">লেবার চার্জ</th>
    <th rowspan="2">বীজলোন</th>
    <th colspan="3">চাষীলোন</th>
    <th rowspan="2">বস্তালোন</th>
    <th colspan="3">এস.আর লোন</th>
    <th rowspan="2">অন্যান্য লোন</th>
    <th rowspan="2">মোট টাকা </th>
  </tr>
  
  <tr>
<th>প্রদানকৃত</th>
<th>দিন</th>
<th>লাভ</th>
<th>প্রদানকৃত</th>
<th>দিন</th>
<th>লাভ</th>
</tr>
<tr style="border:none;">
    <th colspan="21" align="left" style="text-align:left">Contract Booking</th>
	</tr></thead><tbody>
<?



$s=1;
  $sql_loan="select c.*
from sale_do_chalan c, paid_booking p
where c.booking_no=p.booking_number_eng and p.booking_type='Contract Booking'  and
1  ".$date_con.$rec_year.$booking_number.$sr_number."
order by c.chalan_no";
$loan_query = mysql_query($sql_loan);
while($data=mysql_fetch_object($loan_query)){


?>
<tr>

<td><?=$s++?></td>
<td><a href="../../../warehouse_mod/pages/wo/challan_invoice_print_view.php?v_no=<?=$data->chalan_no?>" target="_blank"><?=$data->chalan_no?></a></td>
<td style="white-space: nowrap;" ><?=$data->chalan_date?></td>
<td style="white-space: nowrap;" >ক্রেতা: <?=$data->rec_name.'<br>';
	echo find_a_field('dealer_info','dealer_name_e','dealer_code='.$data->dealer_code);
?></td>
<td><?=$data->booking_no?></td>
<td><?=$data->sr_no?></td>
<td><?=$data->total_unit; $tot_con_unit+=$data->total_unit;?></td>
<td><?=$data->unit_price?></td>
<td><?=$data->challan_in_kg; $tot_con_kg+=$data->challan_in_kg;?></td>
<td><?=ceil($data->store_rent); $tot_con_rent+=$data->store_rent;?></td>
<td><?=ceil($data->labour_charge); $tot_con_labour+=$data->labour_charge;?></td>
<td><?=$data->seeds_loan; $tot_con_seeds+=$data->seeds_loan;?></td>
<td><?=$data->farmer_loan; $tot_con_farmer+=$data->farmer_loan;?></td>
<td><? if($data->farmer_loan>0) { echo $data->loan_days; } ?></td>
<td><? if($data->farmer_loan>0) { echo $data->total_interest; $tot_con_interest+=$data->total_interest; } ?></td>
<td><?=$data->bag_loan; $tot_con_bag+=$data->bag_loan;?></td>
<td><?=$data->sr_loan; $tot_con_sr+=$data->sr_loan;?></td>
<td><?  if($data->sr_loan>0) { echo $data->loan_days; } ?></td>
<td><? if($data->sr_loan>0) { echo $data->total_interest; $tot_con_sr_interest+=$data->total_interest;}  ?></td>
<td><?=$data->others_loan; $tot_con_others+=$data->others_loan;?></td>
<td><?=$tot_con_amount=round($data->total_amt); $tot_con_amt+=ceil($tot_con_amount);?></td>
</tr>
<?
}
?><tr class="footer"><td>&nbsp;</td><td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td><?=number_format($tot_con_unit,2);?></td>
  <td>&nbsp;</td>
  <td><?=number_format($tot_con_kg,2);?></td>
  <td><?=number_format(ceil($tot_con_rent),2);?></td>
  <td><?=number_format(ceil($tot_con_labour),2);?></td><td><?=number_format($tot_con_seeds,2);?></td><td><?=number_format($tot_con_farmer,2);?></td>
<td></td>
<td><?=number_format($tot_con_interest,2);?></td>
<td><?=number_format($tot_con_bag,2);?></td>
<td><?=number_format($tot_con_sr,2);?></td>
<td></td>
<td><?=number_format($tot_con_sr_interest,2);?></td>
<td><?=number_format($tot_con_others,2);?></td>
<td><?=number_format(round($tot_con_amt,0),2);?></td>


</tr></tbody></table>

<br /><br />
<table width="100%" cellspacing="0" cellpadding="2" border="0">
<thead><tr><td style="border:0px;" colspan="22"></td></tr>

  <tr>
    <th rowspan="2">ক্রমিক নং</th>
    <th rowspan="2">ডিও নং</th>
    <th rowspan="2"  style="white-space: nowrap;">তারিখ</th>
    <th rowspan="2"  style="white-space: nowrap;">নাম</th>
    <th rowspan="2">বুকিং নং</th>
    <th rowspan="2">এস.আর নং</th>
    <th rowspan="2">বস্তার সংখ্যা</th>
    <th rowspan="2">ইউনিট মূল্য </th>
    <th rowspan="2">কেজি</th>
    <th rowspan="2">ভাড়া</th>
    <th rowspan="2">লেবার চার্জ</th>
    <th rowspan="2">বীজলোন</th>
    <th colspan="3" style="text-align:center;">চাষীলোন</th>
    <th rowspan="2">বস্তালোন</th>
    <th colspan="3" style="text-align:center;">এস.আর লোন</th>
    <th rowspan="2">অন্যান্য লোন</th>
    <th rowspan="2">মোট টাকা </th>
  </tr>
  
  <tr>
<th >প্রদানকৃত</th>
<th>দিন</th>
<th>লাভ</th>
<th style="text-align:center;">প্রদানকৃত</th>

<th>দিন</th>
<th>লাভ</th>
</tr> <tr style="border:none;">
    <th colspan="21" align="left" style="text-align:left">Normal Booking</th>
	
	</tr></thead><tbody>
<?


  $sr_loan_paid3="select sum(r.total_paid) as paid,r.booking_number,recdate
from sr_loan_return r, paid_booking p
where r.booking_number=p.booking_number_eng  and r.chalan_no is null and  r.recdate between '".$_POST['f_date']."' and '".$_POST['t_date']."' and  p.booking_type='Normal Booking'   ".$rec_year.$booking_number.$sr_number." group by r.booking_number
order by r.chalan_no";
$sr_loan_query = mysql_query($sr_loan_paid3);
$sr_loan_paid = [];
while($data2 = mysql_fetch_object($sr_loan_query)){
    $sr_loan_paid[$data2->booking_number] = $data2->paid;
}
$sql_loan="select count(c.booking_no) as booking,c.booking_no
from sale_do_chalan c, paid_booking p
where c.booking_no=p.booking_number_eng and p.booking_type='Normal Booking'  and 1  ".$date_con.$rec_year.$booking_number.$sr_number."
group by c.booking_no order by c.booking_no";
$loan_query = mysql_query($sql_loan);
while($data=mysql_fetch_object($loan_query)){
$booking_total[$data->booking_no]=$data->booking;
}


 $sql_loan="select count(c.chalan_no) as chalan,sum(c.store_rent) as s_rent,sum(c.seeds_loan) as seeds_rent,sum(c.farmer_loan) as f_rent,sum(c.total_interest) as t_interest,sum(c.bag_loan) as b_loan,sum(c.sr_loan) as s_loan,sum(c.others_loan) as o_loan,sum(c.challan_in_kg) as kg,c.chalan_no
from sale_do_chalan c, paid_booking p
where c.booking_no=p.booking_number_eng and p.booking_type='Normal Booking'  and 1  ".$date_con.$rec_year.$booking_number.$sr_number."
group by c.chalan_no order by c.chalan_no";
$loan_query = mysql_query($sql_loan);
while($data=mysql_fetch_object($loan_query)){
$chalan_total[$data->chalan_no]=$data->chalan;
$chalan_s_rent[$data->chalan_no]=$data->s_rent;
$chalan_seeds_rent[$data->chalan_no]=$data->seeds_rent;
$chalan_f_rent[$data->chalan_no]=$data->f_rent;
$chalan_t_interest[$data->chalan_no]=$data->t_interest;
$chalan_b_loan[$data->chalan_no]=$data->b_loan;
$chalan_s_loan[$data->chalan_no]=$data->s_loan;
$chalan_o_loan[$data->chalan_no]=$data->o_loan;
$chalan_kg[$data->chalan_no]=$data->kg;
$chalan_ss_rent[$data->chalan_no]=$data->s_rent;
}

$s=1;
  $sql_loan="select c.*
from sale_do_chalan c, paid_booking p
where c.booking_no=p.booking_number_eng and p.booking_type='Normal Booking'  and 1  ".$date_con.$rec_year.$booking_number.$sr_number."
order by c.chalan_no";
$loan_query = mysql_query($sql_loan);
while($data=mysql_fetch_object($loan_query)){


?>
<tr>
<? $old_chalan =$data->chalan_no;  if($old_chalan!=$old_mac){?>
<td rowspan="<?=$chalan_total[$data->chalan_no]?>"><?=$s++?></td>
<?  } $old_mac = $old_chalan;?>
<? $old_chalan_no =$data->chalan_no;  if($old_chalan_no!=$old_machine){?>
<td rowspan="<?=$chalan_total[$data->chalan_no]?>"><a href="../../../warehouse_mod/pages/wo/challan_invoice_print_view.php?v_no=<?=$data->chalan_no?>" target="_blank"><?=$data->chalan_no?></a></td>
<?  } $old_machine = $old_chalan_no;?>
<? $old_chalan_nooo =$data->chalan_no;  if($old_chalan_nooo!=$old_machinesss){?>
<td style="white-space: nowrap;" rowspan="<?=$chalan_total[$data->chalan_no]?>" ><?=$data->chalan_date?></td>
<?  } $old_machinesss = $old_chalan_nooo;?>
<? $old_chalan_noooo =$data->chalan_no;  if($old_chalan_noooo!=$old_machiness){?>
<td style="white-space: nowrap;" rowspan="<?=$chalan_total[$data->chalan_no]?>" >ক্রেতা: <?=$data->rec_name.'<br>';
	echo find_a_field('dealer_info','dealer_name_e','dealer_code='.$data->dealer_code);?></td>
	<?  } $old_machiness = $old_chalan_noooo;?>
	
<? $old_chalan_noooss =$data->chalan_no;  if($old_chalan_noooss!=$old_machined){?>
<td rowspan="<?=$chalan_total[$data->chalan_no]?>"><?=$data->booking_no?></td>

<?  } $old_machined = $old_chalan_noooss;?>
<td><?=$data->sr_no?></td>
<td><?=$data->total_unit; $tot_paid_unit2+=$data->total_unit;?></td>
<td align="right"><?=$data->unit_price?></td>
<td align="right"><?=$data->challan_in_kg; $discount=$data->challan_in_kg*0.75; $tot_paid_kg2+=$data->challan_in_kg;?></td>
<td align="right"><?=$tot_store_rent=round($data->store_rent-($data->challan_in_kg*0.75),2); $tot_paid_rent2+=$tot_store_rent;?></td>
<td align="right"><?=$data->labour_charge; $tot_paid_labour2+=$data->labour_charge;?></td>
<td align="right"><?=$data->seeds_loan; $tot_paid_seeds2+=$data->seeds_loan;?></td>
<td align="right"><?=$data->farmer_loan; $tot_paid_farmer2+=$data->farmer_loan;?></td>
<td  align="right"><? if($data->farmer_loan>0) { echo $data->loan_days; } ?></td>
<td  align="right"><? if($data->farmer_loan>0) { echo $data->total_interest; $tot_paid_interest2+=$data->total_interest; } ?></td>
<td  align="right"><?=$data->bag_loan; $tot_paid_bag2+=$data->bag_loan;?></td>
<td  align="right"><?=$data->sr_loan; $tot_paid_sr2+=$data->sr_loan;?></td>
<? //$old_booking =$data->booking_no;  if($old_booking!=$old_machine){?>
<!--<td rowspan="<? //=$booking_total[$data->booking_no]?>"
 align="right"><?=isset($sr_loan_paid[$data->booking_no]) ? $sr_loan_paid[$data->booking_no] : 0; $tot_sr_loan_paid+=$sr_loan_paid[$data->booking_no] ?></td>-->

	<? //} $old_machine = $old_booking;?>
<td  align="right"><?  if($data->sr_loan>0) { echo $data->loan_days; } ?></td>
<td align="right"><? if($data->sr_loan>0) { echo $data->total_interest; $tot_paid_sr_interest2+=$data->total_interest;}  ?></td>
<td align="right"><?=$data->others_loan; $tot_paid_others2+=$data->others_loan;?></td>
<?php if ($data->chalan_no != $old_machines) { ?>
    <td align="right" rowspan="<?=$chalan_total[$data->chalan_no]?>">
        <?php
        $tot_amt22 = round( 
            $chalan_seeds_rent[$data->chalan_no] +
            $chalan_f_rent[$data->chalan_no] +
            $chalan_t_interest[$data->chalan_no] +
            $chalan_b_loan[$data->chalan_no] +
            $chalan_s_loan[$data->chalan_no] +
            $chalan_o_loan[$data->chalan_no] +
            $chalan_s_rent[$data->chalan_no] -
            ($chalan_kg[$data->chalan_no] * 0.75),0
        );

        $tot_paid_amt22 += $tot_amt22;

        $t_srent += $chalan_s_rent[$data->chalan_no] - round(($chalan_kg[$data->chalan_no] * 0.75),0);

        echo $tot_amt22;
        ?>
    </td>
<?php } $old_machines = $data->chalan_no; ?>


</tr>
<?
}
?><tr class="footer"><td>&nbsp;</td><td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td><?=number_format($tot_paid_unit2,2);?></td>
  <td>&nbsp;</td>
  <td><?=number_format($tot_paid_kg2,2);?></td>
  <td><?=number_format(ceil($t_srent),2);?></td>
  <td><?=number_format(ceil($tot_paid_labour2),2);?></td><td><?=number_format($tot_paid_seeds2,2);?></td><td><?=number_format($tot_paid_farmer2,2);?></td>
<td></td>
<td><?=number_format($tot_paid_interest2,2);?></td>
<td><?=number_format($tot_paid_bag2,2);?></td>
<td><?=number_format($tot_paid_sr2,2);?></td>
<!--<td><?=number_format($tot_sr_loan_paid,2);?></td>-->
<td></td>
<td><?=number_format($tot_paid_sr_interest2,2);?></td>
<td><?=number_format($tot_paid_others2,2);?></td>
<td><?=number_format(round($tot_paid_amt22,0),2);?></td>


</tr></tbody></table>

<br /><br />

<table width="100%" cellspacing="0" cellpadding="2" border="0">
<thead><tr><td style="border:0px;" colspan="16"></td></tr>

  <tr>
    <th rowspan="2">ক্রমিক নং</th>
    <th rowspan="2">রিটান লোন নং</th>
    <th rowspan="2"  style="white-space: nowrap;">তারিখ</th>
    <th rowspan="2"  style="white-space: nowrap;">নাম</th>
    <th rowspan="2">বুকিং নং</th>
    <th rowspan="2">বীজলোন</th>
    <th colspan="3" style="text-align:center;">চাষীলোন</th>
    <th rowspan="2">বস্তালোন</th>
    <th colspan="3" style="text-align:center;">এস.আর লোন</th>
    <th rowspan="2">অন্যান্য লোন</th>
    <th rowspan="2">মোট টাকা </th>
  </tr>
  
  <tr>
<th >প্রদানকৃত</th>
<th>দিন</th>
<th>লাভ</th>
<th style="text-align:center;">প্রদানকৃত</th>

<th>দিন</th>
<th>লাভ</th>
</tr> <tr style="border:none;">
    <th colspan="15" align="left" style="text-align:left">Normal Booking</th>
	
	</tr></thead><tbody>
<?


  
$sql_loan="select count(c.booking_no) as booking,c.booking_no
from sale_do_chalan c, paid_booking p
where c.booking_no=p.booking_number_eng and p.booking_type='Normal Booking'  and 1  ".$date_con.$rec_year.$booking_number.$sr_number."
group by c.booking_no order by c.booking_no";
$loan_query = mysql_query($sql_loan);
while($data=mysql_fetch_object($loan_query)){
$booking_total[$data->booking_no]=$data->booking;
}



$s=1;
  $sql_loan="select c.*,p.name
from sr_loan_return c, paid_booking p
where c.booking_number=p.booking_number_eng and c.chalan_no is null and p.booking_type='Normal Booking' and  c.recdate between '".$_POST['f_date']."' and '".$_POST['t_date']."'  ".$rec_year.$booking_number.$sr_number."
";
$loan_query = mysql_query($sql_loan);
while($data=mysql_fetch_object($loan_query)){


?>
<tr>

<td><?=$s++?></td>
<td><?=$data->sr_loan_id?></td>
<td><?=$data->recdate?></td>
<td><?=$data->name; ?></td>
<td><?=$data->booking_number?></td>
<td align="right"></td>
<td align="right"></td>
<td  align="right"></td>
<td  align="right"></td>
<td  align="right"></td>
<td  align="right"><?=$data->total_paid; $t_paid2+=$data->total_paid; ?></td>
<td  align="right"><?=$data->total_days;  ?></td>
<td align="right"><?=$data->interest_amt; $t_interest2+=$data->interest_amt; ?></td>
<td align="right"></td>
<td align="right"> <?=$data->total_amount; $tot_amt2+=$data->total_amount; ?></td>

</tr>
<?
}
?><tr class="footer"><td>&nbsp;</td><td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td><td>&nbsp;</td><td></td><td></td>
<td></td>
<td></td>
<td></td>
<td><?=number_format($t_paid2,2);?></td>
<td></td>
<td><?=number_format($t_interest2,2);?></td>
<td></td>
<td><?=number_format(round($tot_amt2,0),2);?></td>


</tr></tbody></table>

<br /><br />
<table width="100%" cellspacing="0" cellpadding="2" border="0" >
<thead><tr><td style="border:0px;" colspan="21"></td></tr>

  <tr>
    <th rowspan="2">ক্রমিক নং</th>
    <th rowspan="2">ডিও নং</th>
    <th rowspan="2" style="white-space: nowrap;">তারিখ</th>
    <th rowspan="2" style="white-space: nowrap;">নাম</th>
    <th rowspan="2">বুকিং নং</th>
    <th rowspan="2">এস.আর নং</th>
    <th rowspan="2">বস্তার সংখ্যা</th>
    <th rowspan="2">ইউনিট মূল্য</th>
    <th rowspan="2">কেজি</th>
    <th rowspan="2">অগ্রিম ভাড়া</th>
    <th rowspan="2">লেবার চার্জ</th>
    <th rowspan="2">বীজলোন</th>
    <th colspan="3">চাষীলোন</th>
    <th rowspan="2">বস্তালোন</th>
    <th colspan="3">এস.আর লোন</th>
    <th rowspan="2">অন্যান্য লোন</th>
    <th rowspan="2">মোট টাকা </th>
  </tr>
  
  <tr>
<th>প্রদানকৃত</th>
<th>দিন</th>
<th>লাভ</th>
<th>প্রদানকৃত</th>
<th>দিন</th>
<th>লাভ</th>
</tr> <tr style="border:none;">
    <th colspan="21" align="left" style="text-align:left">Paid Booking</th>
	
	</tr></thead><tbody>
<?

 $sql_loans="select count(c.chalan_no) as chalan,sum(c.labour_charge) as charge,sum(c.bag_loan) as bag, c.chalan_no
from sale_do_chalan c, paid_booking p
where c.booking_no=p.booking_number_eng and p.booking_type='Paid Booking'  and 1  ".$date_con.$rec_year.$booking_number.$sr_number."
group by c.chalan_no order by c.chalan_no";
$loan_querys = mysql_query($sql_loans);
while($datas=mysql_fetch_object($loan_querys)){
$booking_totals[$datas->chalan_no]=$datas->chalan;
$labour_charge_total[$datas->chalan_no]=$datas->charge;
$bag_total[$datas->chalan_no]=$datas->bag;
}

$s=1;
  $sql_loan="select c.*
from sale_do_chalan c, paid_booking p
where c.booking_no=p.booking_number_eng and p.booking_type='Paid Booking'  and 1  ".$date_con.$rec_year.$booking_number.$sr_number."
order by c.chalan_no";
$loan_query = mysql_query($sql_loan);
while($data=mysql_fetch_object($loan_query)){


?>
<tr>
<? $old_id =$data->chalan_no;  if($old_id!=$old_no){?>
<td rowspan="<?=$booking_totals[$data->chalan_no]?>"><?=$s++?></td>
<?  } $old_no = $old_id;?>
<? $old_chalan_noo =$data->chalan_no;  if($old_chalan_noo!=$old_machinee){?>
<td rowspan="<?=$booking_totals[$data->chalan_no]?>"><a href="../../../warehouse_mod/pages/wo/challan_invoice_print_view.php?v_no=<?=$data->chalan_no?>" target="_blank"><?=$data->chalan_no?></a></td>
<?  } $old_machinee = $old_chalan_noo;?>


<!--<td><a href="../../../warehouse_mod/pages/wo/challan_invoice_print_view.php?v_no=<?=$data->chalan_no?>" target="_blank"><?=$data->chalan_no?></a></td>-->
<? $old_id2 =$data->chalan_no;  if($old_id2!=$old_no2){?>
<td style="white-space: nowrap;" rowspan="<?=$booking_totals[$data->chalan_no]?>"><?=$data->chalan_date?></td>
<?  } $old_no2 = $old_id2;?>

<? $old_id3 =$data->chalan_no;  if($old_id3!=$old_no3){?>
<td style="white-space: nowrap;" rowspan="<?=$booking_totals[$data->chalan_no]?>">ক্রেতা: <?=$data->rec_name.'<br>';
	echo find_a_field('dealer_info','dealer_name_e','dealer_code='.$data->dealer_code);?></td>
	<?  } $old_no3 = $old_id3;?>
	<? $old_id4 =$data->chalan_no;  if($old_id4!=$old_no4){?>
<td rowspan="<?=$booking_totals[$data->chalan_no]?>"><?=$data->booking_no?></td>
<?  } $old_no4 = $old_id4;?>
<td><?=$data->sr_no?></td>
<td><?=$data->total_unit; $tot_paid_unit+=$data->total_unit;?></td>
<td><?=$data->unit_price?></td>
<td><?=$data->challan_in_kg; $tot_paid_kg+=$data->challan_in_kg;?></td>
<td><?=$store_rent3=ceil($data->store_rent); $tot_paid_rent+=$store_rent3;?></td>
<td><?=$tot_labour3=ceil($data->labour_charge); $tot_paid_labour+=$tot_labour3;?></td>
<td><?=$data->seeds_loan; $tot_paid_seeds+=$data->seeds_loan;?></td>
<td><?=$data->farmer_loan; $tot_paid_farmer+=$data->farmer_loan;?></td>
<td><? if($data->farmer_loan>0) { echo $data->loan_days; } ?></td>
<td><? if($data->farmer_loan>0) { echo $data->total_interest; $tot_paid_interest+=$data->total_interest; } ?></td>
<td><?=$data->bag_loan; $tot_paid_bag+=$data->bag_loan;?></td>
<td><?=$data->sr_loan; $tot_paid_sr+=$data->sr_loan;?></td>
<td><?  if($data->sr_loan>0) { echo $data->loan_days; } ?></td>
<td><? if($data->sr_loan>0) { echo $data->total_interest; $tot_paid_sr_interest+=$data->total_interest;}  ?></td>
<td><?=$data->others_loan; $tot_paid_others+=$data->others_loan;?></td>

<? $old_chalan_nos =$data->chalan_no;  if($old_chalan_nos!=$old_machinees){?>
<td rowspan="<?=$booking_totals[$data->chalan_no]?>"><?=$total3=$labour_charge_total[$data->chalan_no]+$bag_total[$data->chalan_no]; $tot_paid_amt+=$total3;?></td>

<?  } $old_machinees = $old_chalan_nos;?>

</tr>

<?
}
?>

<tr class="footer"><td>&nbsp;</td><td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td><?=number_format($tot_paid_unit,2);?></td>
  <td>&nbsp;</td>
  <td><?=number_format($tot_paid_kg,2);?></td>
  <td><?=number_format(ceil($tot_paid_rent),2);?></td>
  <td><?=number_format(ceil($tot_paid_labour),2);?></td><td><?=number_format($tot_paid_seeds,2);?></td><td><?=number_format($tot_paid_farmer,2);?></td>
<td></td>
<td><?=number_format($tot_paid_interest,2);?></td>
<td><?=number_format($tot_paid_bag,2);?></td>
<td><?=number_format($tot_paid_sr,2);?></td>
<td></td>
<td><?=number_format($tot_paid_sr_interest,2);?></td>
<td><?=number_format($tot_paid_others,2);?></td>
<td><?=number_format(round($sub_total_paid=$tot_paid_amt,0),2);?></td>
</tr>
<tr style="border:none;">
    <th colspan="21"  style="text-align:center">Total </th>
	</tr>
<tr style="font-weight:bold;"><td colspan="6">&nbsp;</td><td><?=number_format($tot_paid_unit+$tot_paid_unit2+$tot_con_unit,2);?></td>
  <td>&nbsp;</td>
  <td><?=number_format($tot_paid_kg+$tot_paid_kg2+$tot_con_kg,2);?></td>
  <td><?=number_format(ceil($tot_rent=$tot_paid_rent+$tot_paid_rent2+$tot_con_rent),2);?></td>
  <td><?=number_format(ceil($tot_p_labour=$tot_paid_labour+$tot_paid_labour2+$tot_con_labour),2);?></td>
  <td><?=number_format($tot_p_seeds=$tot_paid_seeds+$tot_paid_seeds2+$tot_con_seeds,2);?></td>
  <td><?=number_format($tot_p_fermer=$tot_paid_farmer+$tot_paid_farmer2+$tot_con_farmer,2);?></td>
<td></td>
<td><?=number_format($tot_interest=$tot_paid_interest+$tot_paid_interest2+$tot_con_interest,2);?></td>
<td><?=number_format($tot_p_bag=$tot_paid_bag+$tot_paid_bag2+$tot_con_bag,2);?></td>
<td><?=number_format($tot_p_sr=$tot_paid_sr+$tot_paid_sr2+$tot_con_sr+$t_paid2,2);?></td>
<td></td>
<td><?=number_format($tot_p_sr_interest=$tot_paid_sr_interest+$tot_paid_sr_interest2+$tot_con_sr_interest+$t_interest2,2);?></td>
<td><?=number_format($tot_p_others=$tot_paid_others+$tot_paid_others2+$tot_con_others,2);?></td>
<td><?=number_format(ceil($total=$tot_con_amt+$tot_paid_amt22+$tot_amt2+$sub_total_paid),2); //$tot_p_labour+$tot_p_seeds+$tot_p_fermer+$tot_interest+$tot_p_sr+$tot_p_sr_interest+$tot_p_others+$tot_paid_amt22),2);?></td>
</tr>
</tbody></table>

<table width="100%" cellpadding="0" cellspacing="0">
<thead>

</thead>
</table>

</div>
<?


}
elseif($_REQUEST['report']==2506025) 
{
$start_date = $_POST['f_date'];
$end_date   = $_POST['t_date'];


//Receive Start
  $sql9 = "SELECT  SUM(s.qty) as unit, i.item_id, m.or_date FROM warehouse_other_receive m, warehouse_other_receive_detail s, item_info i,paid_booking p 
         WHERE  m.or_no = s.or_no and m.booking_number=p.booking_number_eng and m.status = 'UNCHECKED' 
            AND i.item_id = s.item_id 
            AND m.or_date BETWEEN '$start_date' AND '$end_date' 
            AND s.item_id = 100010001  and 
			p.booking_type='Normal Booking'
         GROUP BY 
            s.or_date";

$query = mysql_query($sql9);
$rec_nor = [];
while ($data = mysql_fetch_object($query)) {
    $rec_normal[$data->item_id][$data->or_date] = $data->unit;
}


 $sql5 = "SELECT  SUM(s.qty) as unit, i.item_id, m.or_date FROM warehouse_other_receive m,warehouse_other_receive_detail s, item_info i,paid_booking p 
         WHERE m.or_no = s.or_no and m.booking_number=p.booking_number_eng and  m.status = 'UNCHECKED' 
            AND i.item_id = s.item_id 
            AND m.or_date BETWEEN '$start_date' AND '$end_date' 
            AND s.item_id = 100010001  and 
			p.booking_type='Paid Booking'
         GROUP BY  s.or_date";

$query5 = mysql_query($sql5);
$rec_paid = [];
while ($data5 = mysql_fetch_object($query5)) {
    $received_paid[$data5->item_id][$data5->or_date] = $data5->unit;
}

$sql6 = "SELECT SUM(s.qty) as unit, i.item_id, m.or_date FROM warehouse_other_receive m, warehouse_other_receive_detail s, item_info i,paid_booking p 
         WHERE 
            m.or_no = s.or_no and m.booking_number=p.booking_number_eng and m.status = 'UNCHECKED' AND i.item_id = s.item_id 
            AND m.or_date BETWEEN '$start_date' AND '$end_date' 
            AND s.item_id = 100010001  and 
			p.booking_type='Contact Booking'
         GROUP BY  s.or_date";

$query6 = mysql_query($sql6);
$rec_con = [];
while ($data6 = mysql_fetch_object($query6)) {
    $received_con[$data6->item_id][$data6->or_date] = $data6->unit;
}

// Receive End



// Delivery Start

 $sql1 = "SELECT  SUM(s.total_unit) as unit, i.item_id, s.chalan_date FROM sale_do_master m, sale_do_chalan s, item_info i,paid_booking p 
         WHERE  m.do_no = s.do_no and m.booking_no=p.booking_number_eng  
            AND i.item_id = s.item_id 
            AND s.chalan_date BETWEEN '$start_date' AND '$end_date' 
            AND s.item_id = 100010001  and 
			p.booking_type='Normal Booking' and approved_status='Third App'
         GROUP BY 
            s.chalan_date";

$query1 = mysql_query($sql1);
$del_nor = [];
while ($data1 = mysql_fetch_object($query1)) {
    $del_normal[$data1->item_id][$data1->chalan_date] = $data1->unit;
}

$sql2 = "SELECT  SUM(s.total_unit) as unit, i.item_id, s.chalan_date FROM sale_do_master m, sale_do_chalan s, item_info i,paid_booking p 
         WHERE  m.do_no = s.do_no and m.booking_no=p.booking_number_eng  
            AND i.item_id = s.item_id 
            AND s.chalan_date BETWEEN '$start_date' AND '$end_date' 
            AND s.item_id = 100010001  and 
			p.booking_type='Paid Booking' and approved_status='Third App'
         GROUP BY 
            s.chalan_date";

$query2 = mysql_query($sql2);
$del_paid = [];
while ($data2 = mysql_fetch_object($query2)) {
    $delivery_paid[$data2->item_id][$data2->chalan_date] = $data2->unit;
}

$sql3 = "SELECT  SUM(s.total_unit) as unit, i.item_id, s.chalan_date FROM sale_do_master m, sale_do_chalan s, item_info i,paid_booking p 
         WHERE  m.do_no = s.do_no and m.booking_no=p.booking_number_eng  
            AND i.item_id = s.item_id 
            AND s.chalan_date BETWEEN '$start_date' AND '$end_date' 
            AND s.item_id = 100010001  and 
			p.booking_type='Contact Booking' and approved_status='Third App'
         GROUP BY 
            s.chalan_date";

$query3 = mysql_query($sql3);
$del_con = [];
while ($data3 = mysql_fetch_object($query3)) {
    $delivery_con[$data3->item_id][$data3->chalan_date] = $data3->unit;
}

// Delivery End
?>
<style>
th {
text-align:center;
}
</style>
<div id="ExportTable">
<h3><?=$str?></h3>

<?
// Begin Table
echo '<table width="100%" border="1" cellpadding="0" cellspacing="0">


<tr>
  <th>Date</th>
  <th colspan="4">Received Potato </th>
  <th colspan="4">Delivery Potato </th>
  <th colspan="4">Total Remaining Potato </th>
</tr>
<tr>
  <th>&nbsp;</th>
  <th>Normal</th>
  <th>Contact</th>
  <th>Paid</th>
  <th>Total</th>
  <th>Normal</th>
  <th>Contact</th>
  <th>Paid</th>
  <th>Total</th>
  <th>Normal</th>
  <th>Contact</th>
  <th>Paid</th>
  <th>Total</th>
</tr>';

// Loop through each date
$current = strtotime($start_date);
$end = strtotime($end_date);
$item_id = 100010001;

while ($current <= $end) {
    $date = date('Y-m-d', $current);
	//Received
    $received_normal = isset($rec_normal[$item_id][$date]) ? $rec_normal[$item_id][$date] : 0;
	$tot_rec_nor+=$received_normal;
	$received_paids = isset($received_paid[$item_id][$date]) ? $received_paid[$item_id][$date] : 0;
	$tot_rec_paid+=$received_paids;
	$received_contact = isset($received_con[$item_id][$date]) ? $received_con[$item_id][$date] : 0;
	$tot_rec_con+=$received_contact;
	$tot_rec=$received_normal+$received_paids+$received_contact;
	$total_rec+=$tot_rec;
	
	//Delivery
	 $delivery_normal = isset($del_normal[$item_id][$date]) ? $del_normal[$item_id][$date] : 0;
	 $tot_del_nor+=$delivery_normal;
	 $delivery_paids = isset($delivery_paid[$item_id][$date]) ? $delivery_paid[$item_id][$date] : 0;
	 $tot_del_paid+=$delivery_paids;
	 $delivery_contact = isset($delivery_con[$item_id][$date]) ? $delivery_con[$item_id][$date] : 0;
	 $tot_del_contact+=$delivery_contact;
	 $tot_delivery=$delivery_normal+$delivery_paids+$delivery_contact;
	 $total_del+=$tot_delivery;
	 
	 //Remaining 
	 $remain_nornal+=$received_normal-$delivery_normal ;
	 $remain_paid+=$received_paids-$delivery_paids ;
	 $remain_contact+=$received_contact- $delivery_contact ;
	 $tot_remaining=$remain_nornal+$remain_paid+$remain_contact;
	 
	 if($remain_nornal<1)
	 {
	 $remain_nornal=$remain_nornal*(-1);
	 $tot_remain_nornal+=$remain_nornal;
	 }
	 if($remain_paid<1)
	 {
	 $remain_paid=$remain_paid*(-1);
	 $tot_remain_paid+=$remain_paid;
	 }
	 if($remain_contact<1)
	 {
	 $remain_contact=$remain_contact*(-1);
	 $tot_remain_contact+=$remain_contact;
	 }
	 if($tot_remaining<1)
	 {
	 $tot_remaining=$tot_remaining*(-1);
	 $total_remain+=$tot_remaining;
	 }
	
    echo "<tr>
        <td>$date</td>
        <td>$received_normal</td>
        <td>$received_contact</td>
        <td>$received_paids</td>
        <td>$tot_rec</td>
        <td>$delivery_normal</td>
        <td>$delivery_contact</td>
        <td>$delivery_paids</td> 
        <td>$tot_delivery</td>
        <td>$remain_nornal</td>
        <td>$remain_contact</td>
        <td>$remain_paid</td>
        <td>$tot_remaining</td>
    </tr>";

    $current = strtotime('+1 day', $current);
}
echo "<tr>
        <td><strong>Total</strong></td>
        <td><strong>$tot_rec_nor</strong></td>
        <td><strong>$tot_rec_con</strong></td>
        <td><strong>$tot_rec_paid</strong></td>
        <td><strong>$total_rec</strong></td>
        <td><strong>$tot_del_nor</strong></td>
        <td><strong>$tot_del_contact</strong></td>
        <td><strong>$tot_del_paid</strong></td> 
        <td><strong>$total_del</strong></td>
        <td><strong>$tot_remain_nornal</strong></td>
        <td><strong>$tot_remain_contact</strong></td>
        <td><strong>$tot_remain_paid</strong></td>
        <td><strong>$total_remain</strong></td>
    </tr>";
echo '</table>';

?>
</div>
<? }
elseif($_REQUEST['report']==3) 



{



$sql2 	= "select distinct o.do_no, d.dealer_code,d.dealer_name_e,w.warehouse_name,m.do_date,d.address_e,d.mobile_no,d.product_group from 



sale_do_master m,sale_do_details o, item_info i,dealer_info d , warehouse w



where m.do_no=o.do_no and i.item_id=o.item_id and m.dealer_code=d.dealer_code and m.status in ('CHECKED','COMPLETED') and w.warehouse_id=d.depot ".$date_con.$item_con.$depot_con.$dtype_con.$pg_con.$dealer_con;



$query2 = mysql_query($sql2);







while($data=mysql_fetch_object($query2)){



echo '<div style="position:relative;display:block; width:100%; page-break-after:always; page-break-inside:avoid">';



	$dealer_code = $data->dealer_code;



	$dealer_name = $data->dealer_name_e;



	$warehouse_name = $data->warehouse_name;



	$do_date = $data->do_date;



	$do_no = $data->do_no;



		if($dealer_code>0) 



{



$str 	.= '<p style="width:100%">Dealer Name: '.$dealer_name.' - '.$dealer_code.'('.$data->product_group.')</p>';



$str 	.= '<p style="width:100%">DO NO: '.$do_no.' 



&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Depot:'.$warehouse_name.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:'.$do_date.'</p>



<p style="width:100%">Destination:'.$data->address_e.'('.$data->mobile_no.')</p>';







$dealer_con = ' and m.dealer_code='.$dealer_code;



$do_con = ' and m.do_no='.$do_no;



$sql = "select concat(i.finish_goods_code,'- ',item_name) as item_name,o.pkt_unit as crt,o.dist_unit as pcs,o.total_amt as DP_Total,(o.t_price*o.total_unit) as TP_Total from 



sale_do_master m,sale_do_details o, item_info i,dealer_info d , warehouse w



where m.do_no=o.do_no and i.item_id=o.item_id and m.dealer_code=d.dealer_code and m.status in ('CHECKED','COMPLETED') and w.warehouse_id=d.depot ".$date_con.$item_con.$depot_con.$dtype_con.$do_con." order by m.do_date desc";



}







	//echo report_create($sql,1,$str);



?>



<table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">



  <thead>



    <tr>



      <td style="border:0px;" colspan="8"><?=$str?></td>



    </tr>



    <tr>



      <th>S/L</th>



      <th>Item Name</th>



      <th>Crt</th>



      <th>Pcs</th>



      <th>TP Total</th>



      <th>DP Total</th>



      <th>Discount</th>



      <th>Actual Amt </th>



    </tr>



  </thead>



  <tbody>



    <?







$tp_t = 0;



$dp_t = 0;



$dis_t = 0;



$act_t = 0;$crt_t = 0;$pcs_t = 0;







$query = mysql_query($sql);



while($info = mysql_fetch_object($query)){



$discount =0;



$actual_amt = $info->DP_Total;



if($info->DP_Total<0)



{$discount =$info->DP_Total*(-1); $info->DP_Total = 0; $info->TP_Total = 0;}



?>



    <tr>



      <td><?=++$i;?></td>



      <td><?=$info->item_name;?></td>



      <td style="text-align:right"><?=$info->crt;?></td>



      <td style="text-align:right"><?=$info->pcs;?></td>



      <td style="text-align:right"><?=$info->TP_Total;?></td>



      <td style="text-align:right"><?=$info->DP_Total;?></td>



      <td style="text-align:right"><?=$discount;?></td>



      <td style="text-align:right"><?=$actual_amt;?></td>



    </tr>



    <?



$crt_t = $crt_t + $info->crt;



$pcs_t = $pcs_t + $info->pcs;







$tp_t = $tp_t + $info->TP_Total;



$dp_t = $dp_t + $info->DP_Total;



$dis_t = $dis_t + $discount;



$act_t = $act_t + $actual_amt;



}



?>



    <tr class="footer">



      <td>&nbsp;</td>



      <td><?=$tp_t?></td>



      <td style="text-align:right"><?=$crt_t?></td>



      <td style="text-align:right"><?=$pcs_t?></td>



      <td style="text-align:right"><?=$tp_t?></td>



      <td style="text-align:right"><?=$dp_t?></td>



      <td style="text-align:right"><?=$dis_t?></td>



      <td style="text-align:right"><?=$act_t?></td>



    </tr>



  </tbody>



</table>



<?



		$str = '';



		echo '</div>';



}



}



elseif($_REQUEST['report']==701) 



{



if(isset($t_date)) 	



{$to_date=$t_date; $fr_date=$f_date; $date_con=' and m.do_date between \''.$fr_date.'\' and \''.$to_date.'\'';$cdate_con=' and do_date between \''.$fr_date.'\' and \''.$to_date.'\'';}







if(isset($product_group)) 		{$pg_con=' and i.sales_item_type="'.$product_group.'"';} 



if($depot_id>0) {$dpt_con=' and d.depot="'.$depot_id.'"';} 







$sql = "select 



i.finish_goods_code as code,



sum(o.total_unit) as total_unit



from 



sale_do_master m,sale_do_details o, item_info i,dealer_info d



where m.do_no=o.do_no and m.dealer_code=d.dealer_code and i.item_id=o.item_id  and m.status in ('CHECKED','COMPLETED') ".$date_con.$item_con.$item_brand_con.$pg_con.$dpt_con.' 



group by i.finish_goods_code';



$query = mysql_query($sql);



while($info = mysql_fetch_object($query)){



$do_qty[$info->code] = $info->total_unit;



}



$sql = "select 



i.finish_goods_code as code,



sum(c.total_unit) as total_unit



from 



sale_do_master m, item_info i,dealer_info d,sale_do_chalan c



where m.do_no=c.do_no and m.dealer_code=d.dealer_code and i.item_id=c.item_id  and m.status in ('CHECKED','COMPLETED') ".$date_con.$item_con.$item_brand_con.$pg_con.$dpt_con.' 



group by i.finish_goods_code';



$query = mysql_query($sql);



while($info = mysql_fetch_object($query)){



$ch_qty[$info->code] = $info->total_unit;



}



		$sql = "select 



		i.finish_goods_code as code, 



		i.item_name, i.item_brand, 



		i.sales_item_type as `group`,i.pack_size,i.d_price



		from 



		sale_do_master m,sale_do_details o, item_info i,dealer_info d



		where m.do_no=o.do_no and m.dealer_code=d.dealer_code and i.item_id=o.item_id  and m.status in ('CHECKED','COMPLETED') ".$date_con.$item_con.$item_brand_con.$pg_con.$dpt_con.' 



		group by i.finish_goods_code';



?>



<table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">



  <thead>



    <tr>



      <td style="border:0px;" colspan="11"><?=$str?></td>



    </tr>



    <tr>



      <th>S/L</th>



      <th>Code</th>



      <th>Item Name</th>



      <th>Grp</th>



      <th>Brand</th>



      <th>Pack Size </th>



      <th>Price Rate </th>



      <th>DO Qty</th>



      <th>CH Qty</th>



      <th>DUE Qty</th>



      <th>DUE Amt </th>



    </tr>



  </thead>



  <tbody>



    <?







$tp_t = 0;



$dp_t = 0;



$dis_t = 0;



$act_t = 0;$crt_t = 0;$pcs_t = 0;







$query = mysql_query($sql);



while($info = mysql_fetch_object($query)){







$discount =0;







$actual_amt = $info->DP_Total;



$crt = (int)($do_qty[$info->code]/$info->pack_size);



$pcs = (int)($do_qty[$info->code]%$info->pack_size);



$do_total = $do_total + $do_qty[$info->code];







$ccrt = (int)($ch_qty[$info->code]/$info->pack_size);



$cpcs = (int)($ch_qty[$info->code]%$info->pack_size);



$ch_total = $ch_total + $ch_qty[$info->code];







$due_qty[$info->code] = ($do_qty[$info->code] - $ch_qty[$info->code]);



$dcrt = (int)($due_qty[$info->code]/$info->pack_size);



$dpcs = (int)($due_qty[$info->code]%$info->pack_size);



$due_total = $due_total + $due_qty[$info->code];



$amt_total = $amt_total + (int)($info->d_price*$due_qty[$info->code]);



?>



    <tr>



      <td><?=++$i;?></td>



      <td><?=$info->code;?></td>



      <td><?=$info->item_name;?></td>



      <td><?=$info->group?></td>



      <td><?=$info->item_brand?></td>



      <td style="text-align:center"><?=$info->pack_size?></td>



      <td style="text-align:right"><?=number_format($info->d_price,2);?></td>



      <td style="text-align:right"><?=(($crt>0)?$crt:'0');?>



        /



      <?=$pcs?></td>



      <td style="text-align:right"><?=(($ccrt>0)?$ccrt:'0');?>



        /



      <?=$cpcs?></td>



      <td style="text-align:right"><?=(($dcrt>0)?$dcrt:'0');?>



        /



      <?=$dpcs?></td>



      <td style="text-align:right"><?=number_format((int)(($info->d_price*$due_qty[$info->code])),2);?></td>



    </tr>



    <?



}



?>



    <tr class="footer">



      <td>&nbsp;</td>



      <td>&nbsp;</td>



      <td>&nbsp;</td>



      <td>&nbsp;</td>



      <td>&nbsp;</td>



      <td style="text-align:right">&nbsp;</td>



      <td style="text-align:right">&nbsp;</td>



      <td style="text-align:right"><?=$do_total;?></td>



      <td style="text-align:right"><?=$ch_total?></td>



      <td style="text-align:right"><?=$due_total?></td>



      <td style="text-align:right"><?=number_format($amt_total,2)?></td>



    </tr>



  </tbody>



</table>



<?



		$str = '';



		echo '</div>';







}



elseif($_REQUEST['report']==7011) 



{



if(isset($t_date)) 	



{$to_date=$t_date; $fr_date=$f_date; $date_con=' and m.do_date between \''.$fr_date.'\' and \''.$to_date.'\'';$cdate_con=' and do_date between \''.$fr_date.'\' and \''.$to_date.'\'';}







if(isset($product_group)) 		{$pg_con=' and i.sales_item_type="'.$product_group.'"';} 



if($depot_id>0) {$dpt_con=' and d.depot="'.$depot_id.'"';} 







$sql = "select 



i.finish_goods_code as code,



sum(o.total_unit) as total_unit



from 



sale_do_master m,sale_do_details o, item_info i,dealer_info d



where o.unit_price>0 and m.do_no=o.do_no and m.dealer_code=d.dealer_code and i.item_id=o.item_id  and m.status in ('CHECKED','COMPLETED') ".$dtype_con.$date_con.$item_con.$item_brand_con.$pg_con.$dpt_con.' 



group by i.finish_goods_code';



$query = mysql_query($sql);



while($info = mysql_fetch_object($query)){



$do_qty[$info->code] = $info->total_unit;



}



$sql = "select 



i.finish_goods_code as code,



sum(c.total_unit) as total_unit



from 



sale_do_master m, item_info i,dealer_info d,sale_do_chalan c



where c.unit_price>0 and m.do_no=c.do_no and m.dealer_code=d.dealer_code and i.item_id=c.item_id  and m.status in ('CHECKED','COMPLETED') ".$dtype_con.$date_con.$item_con.$item_brand_con.$pg_con.$dpt_con.' 



group by i.finish_goods_code';



$query = mysql_query($sql);



while($info = mysql_fetch_object($query)){



$ch_qty[$info->code] = $info->total_unit;



}



		$sql = "select 



		i.finish_goods_code as code, 



		i.item_name, i.item_brand, 



		i.sales_item_type as `group`,i.pack_size,i.d_price



		from 



		sale_do_master m,sale_do_details o, item_info i,dealer_info d



		where i.finish_goods_code not between 5000 and 6000 and i.finish_goods_code not between 2000 and 3000 and   m.do_no=o.do_no and m.dealer_code=d.dealer_code and i.item_id=o.item_id  and m.status in ('CHECKED','COMPLETED') ".$date_con.$item_con.$item_brand_con.$pg_con.$dpt_con.' 



		group by i.finish_goods_code';



?>



<table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">



  <thead>



    <tr>



      <td style="border:0px;" colspan="11"><?=$str?></td>



    </tr>



    <tr>



      <th>S/L</th>



      <th>Code</th>



      <th>Item Name</th>



      <th>Grp</th>



      <th>Brand</th>



      <th>Pack Size </th>



      <th>Price Rate </th>



      <th>DO Qty</th>



      <th>CH Qty</th>



      <th>DUE Qty</th>



      <th>DUE Amt </th>



    </tr>



  </thead>



  <tbody>



    <?







$tp_t = 0;



$dp_t = 0;



$dis_t = 0;



$act_t = 0;$crt_t = 0;$pcs_t = 0;







$query = mysql_query($sql);



while($info = mysql_fetch_object($query)){







$discount =0;







$actual_amt = $info->DP_Total;



$crt = (int)($do_qty[$info->code]/$info->pack_size);



$pcs = (int)($do_qty[$info->code]%$info->pack_size);



$do_total = $do_total + $do_qty[$info->code];







$ccrt = (int)($ch_qty[$info->code]/$info->pack_size);



$cpcs = (int)($ch_qty[$info->code]%$info->pack_size);



$ch_total = $ch_total + $ch_qty[$info->code];







$due_qty[$info->code] = ($do_qty[$info->code] - $ch_qty[$info->code]);



$dcrt = (int)($due_qty[$info->code]/$info->pack_size);



$dpcs = (int)($due_qty[$info->code]%$info->pack_size);



$due_total = $due_total + $due_qty[$info->code];



$amt_total = $amt_total + (int)($info->d_price*$due_qty[$info->code]);



?>



    <tr>



      <td><?=++$i;?></td>



      <td><?=$info->code;?></td>



      <td><?=$info->item_name;?></td>



      <td><?=$info->group?></td>



      <td><?=$info->item_brand?></td>



      <td style="text-align:center"><?=$info->pack_size?></td>



      <td style="text-align:right"><?=number_format($info->d_price,2);?></td>



      <td style="text-align:right"><?=(($crt>0)?$crt:'0');?>



        /



      <?=$pcs?></td>



      <td style="text-align:right"><?=(($ccrt>0)?$ccrt:'0');?>



        /



      <?=$cpcs?></td>



      <td style="text-align:right"><?=(($dcrt>0)?$dcrt:'0');?>



        /



      <?=$dpcs?></td>



      <td style="text-align:right"><?=number_format((int)(($info->d_price*$due_qty[$info->code])),2);?></td>



    </tr>



    <?



}



?>



    <tr class="footer">



      <td>&nbsp;</td>



      <td>&nbsp;</td>



      <td>&nbsp;</td>



      <td>&nbsp;</td>



      <td>&nbsp;</td>



      <td style="text-align:right">&nbsp;</td>



      <td style="text-align:right">&nbsp;</td>



      <td style="text-align:right"><?=$do_total;?></td>



      <td style="text-align:right"><?=$ch_total?></td>



      <td style="text-align:right"><?=$due_total?></td>



      <td style="text-align:right"><?=number_format($amt_total,2)?></td>



    </tr>



  </tbody>



</table>



<?



		$str = '';



		echo '</div>';







}


elseif($_REQUEST['report']==7111) 



{



if(isset($t_date)) 	



{$to_date=$t_date; $fr_date=$f_date; $date_con=' and m.do_date between \''.$fr_date.'\' and \''.$to_date.'\'';$cdate_con=' and do_date between \''.$fr_date.'\' and \''.$to_date.'\'';}







if(isset($product_group)) 		{$pg_con=' and i.sales_item_type="'.$product_group.'"';} 



if($depot_id>0) {$dpt_con=' and d.depot="'.$depot_id.'"';} 
if($_POST['booking_number']!='') {$booking_number=' and p.booking_number_eng="'.$_POST['booking_number'].'"';} 





// Receiving quantities
 $sql_rec = "
    SELECT booking_number, bag_mark, SUM(qty) AS total_unit
    FROM warehouse_other_receive
    WHERE rec_year ='".$_POST['rec_year']."' and or_date between '".$_POST['f_date']."' and '".$_POST['t_date']."'
    GROUP BY booking_number, bag_mark
";
$query_rec = mysql_query($sql_rec);
while ($info_rec = mysql_fetch_object($query_rec)) {
    $rec_qty[$info_rec->booking_number][$info_rec->bag_mark] = $info_rec->total_unit;
}

// Delivery quantities
 $sql_del = "
    SELECT s.booking_no, s.sr_no, SUM(s.total_unit) AS t_unit,s.chalan_no
    FROM sale_do_chalan s,paid_booking p
    WHERE 1 and s.booking_no=p.booking_number_eng and booking_year='".$_POST['rec_year']."' and s.chalan_date between '".$_POST['f_date']."' and '".$_POST['t_date']."'
    GROUP BY s.booking_no, s.sr_no
";
$query_del = mysql_query($sql_del);
while ($info_del = mysql_fetch_object($query_del)) {
    $del_qty[$info_del->booking_no][$info_del->sr_no] = $info_del->t_unit;
	$chalan[$info_del->booking_no][$info_del->sr_no] = $info_del->chalan_no;
	
}




   $sql = "select  t.*,p.*,p.village as p_village,t.village as t_village,t.farmer_name as s_name,t.sr_number,p.name as b_name from 



sr_token t,paid_booking p



where t.booking_number=p.booking_number_eng and p.booking_year='".$_POST['rec_year']."'   ".$booking_number.$depot_con.$dtype_con.$dealer_con.$item_brand_con;



$query = mysql_query($sql);



while($info = mysql_fetch_object($query)){







}






		




?>



<table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">



  <thead>



    <tr>



      <td style="border:0px;" colspan="12"><?=$str?></td>
    </tr>



    <tr style="position: sticky; top: 0; background-color: whitesmoke; text-align:center !important">



      <th style="text-align:center">S/L</th>



      <th style="text-align:center">Booking Type </th>
	  
	  <th style="text-align:center">Booking No </th>
	  
	  
	  <th style="text-align:center">Booking Name </th>
	  <th style="text-align:center">Booking Village </th>
	  
	  
	  <th style="text-align:center">S.R Name </th>
	  
	  
	  <th style="text-align:center">S.R Village </th>



      <th style="text-align:center">SR No </th>



	  <th style="text-align:center">Rec Qty </th>
      

      <th style="text-align:center">Delivery Qty </th>



      <th style="text-align:center">Undel Qty </th>


      <th style="text-align:center">Challan View</th>
    </tr>
  </thead>



  <tbody>

<?


$query = mysql_query($sql);

while($info = mysql_fetch_object($query)){



?>

    <tr>
      <td style="text-align:center"><?=++$i;?></td>
      <td style="text-align:center"><?=$info->booking_type;?></td>
	  <td style="text-align:center"><?=$info->booking_number_eng;?></td>
	  <td style="text-align:center"><?=$info->b_name;?></td>
	  <td style="text-align:center"><?=$info->p_village;?></td>
	  <td style="text-align:center"><?=$info->s_name;;?></td>
	  <td style="text-align:center"><?=$info->t_village?></td>
      <td style="text-align:center"><?=$info->sr_number;?></td>
	  <td style="text-align:right"><?=$rec_qty[$info->booking_number_eng][$info->sr_number]; $tot_rec+=$rec_qty[$info->booking_number_eng][$info->sr_number]; ?></td>
      
      <td style="text-align:right"><?=$del_qty[$info->booking_number_eng][$info->sr_number]; $tot_del+=$del_qty[$info->booking_number_eng][$info->sr_number]; ?></td>
      <td style="text-align:right"><?=$due=$rec_qty[$info->booking_number_eng][$info->sr_number]-$del_qty[$info->booking_number_eng][$info->sr_number]; $tot_due+=$due;?></td>

		<td style="text-align:center;"> <a href="../wo/challan_invoice_print_view2.php?v_no=<?=$chalan[$info->booking_number_eng][$info->sr_number]?>" target="_blank">
		<? if($chalan[$info->booking_number_eng][$info->sr_number]>0) { echo $chalan[$info->booking_number_eng][$info->sr_number]; } else { echo '';}?></a>		</td>
    </tr>

<? } ?>

    <tr>
      <td colspan="8" style="text-align:right"><strong>Totel</strong></td>
      <td style="text-align:right"><strong><?=$tot_rec;?></strong></td>
      <td style="text-align:right"><strong><?=$tot_del;?></strong></td>
	  <td style="text-align:right"><strong><?=$tot_due;?></strong></td>
	  <td></td>
    </tr>
  </tbody>
</table>



<?



		$str = '';



		echo '</div>';







}



elseif($_REQUEST['report']==5) 



{



if(isset($region_id)) 



$sqlbranch 	= "select * from branch where BRANCH_ID=".$region_id;



else



$sqlbranch 	= "select * from branch";



$querybranch = mysql_query($sqlbranch);



while($branch=mysql_fetch_object($querybranch)){



	$rp=0;



	echo '<div>';



if(isset($zone_id)) 



$sqlzone 	= "select * from zon where REGION_ID=".$branch->BRANCH_ID." and ZONE_CODE=".$zone_id;



else



$sqlzone 	= "select * from zon where REGION_ID=".$branch->BRANCH_ID;







	$queryzone = mysql_query($sqlzone);



	while($zone=mysql_fetch_object($queryzone)){



if($area_id>0) 



$area_con = "and a.AREA_CODE=".$area_id;



$sql="select m.do_no,m.do_date,concat(d.dealer_code,'- ',d.dealer_name_e)  as dealer_name,w.warehouse_name as depot,a.AREA_NAME as area,d.product_group as grp,(select sum(total_amt) from sale_do_details where do_no=m.do_no) as DP_Total,(select sum(t_price*total_unit) from sale_do_details where do_no=m.do_no)  as TP_Total from 



sale_do_master m,dealer_info d  , warehouse w,area a



where  m.status in ('CHECKED','COMPLETED') and m.dealer_code=d.dealer_code and w.warehouse_id=d.depot and a.AREA_CODE=d.area_code and a.ZONE_ID=".$zone->ZONE_CODE." ".$date_con.$pg_con.$area_con." order by do_no";



$sqlt="select sum(s.t_price*s.total_unit) as total,sum(total_amt) as dp_total from 



sale_do_master m,dealer_info d  , warehouse w,area a,sale_do_details s



where  m.status in ('CHECKED','COMPLETED') and m.dealer_code=d.dealer_code and w.warehouse_id=d.depot and a.AREA_CODE=d.area_code and s.do_no=m.do_no and a.ZONE_ID=".$zone->ZONE_CODE." ".$date_con.$pg_con.$area_con;







		$queryt = mysql_query($sqlt);



		$t= mysql_fetch_object($queryt);



		if($t->total>0)



		{



			if($rp==0) {$reg_total=0;$dp_total=0; $str .= '<p style="width:100%">Region Name: '.$branch->BRANCH_NAME.' Region</p>';$rp++;}



			$str .= '<p style="width:100%">Zone Name: '.$zone->ZONE_NAME.' Zone</p>';



			echo report_create($sql,1,$str);



			$str = '';



			



			$reg_total= $reg_total+$t->total;



			$dp_total= $dp_total+$t->dp_total;



		}







	}



	



			if($rp>0){



?>



<table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">



  <thead>



    <tr>



      <td style="border:0px;"></td>



    </tr>



  </thead>



  <tbody>



    <tr class="footer">



      <td align="right"><?=$branch->BRANCH_NAME?>



        Region  DP Total:



        <?=number_format($dp_total,2)?>



        ||| TP Total:



        <?=number_format($reg_total,2)?></td>



    </tr>



  </tbody>



</table>



<br />



<br />



<br />



<?  }



	echo '</div>';



}



?>



<?







}







elseif($_REQUEST['report']==501) 



{



if(isset($region_id)) 



$sqlbranch 	= "select * from branch where BRANCH_ID=".$region_id;



else



$sqlbranch 	= "select * from branch";



$querybranch = mysql_query($sqlbranch);



while($branch=mysql_fetch_object($querybranch)){



	$rp=0;



	echo '<div>';



if(isset($zone_id)) 



$sqlzone 	= "select * from zon where REGION_ID=".$branch->BRANCH_ID." and ZONE_CODE=".$zone_id;



else



$sqlzone 	= "select * from zon where REGION_ID=".$branch->BRANCH_ID;







	$queryzone = mysql_query($sqlzone);



	while($zone=mysql_fetch_object($queryzone)){



if($area_id>0) 



$area_con = "and a.AREA_CODE=".$area_id;



$sql="select m.do_no,m.do_date,concat(d.dealer_code,'- ',d.dealer_name_e)  as dealer_name,w.warehouse_name as depot,a.AREA_NAME as area,d.product_group as grp,(select sum(total_amt) from sale_do_details where do_no=m.do_no) as DP_Total,(select sum(t_price*total_unit) from sale_do_details where do_no=m.do_no)  as TP_Total from 



sale_do_master m,dealer_info d  , warehouse w,area a



where  m.status in ('CHECKED','COMPLETED') and m.dealer_code=d.dealer_code and w.warehouse_id=d.depot and a.AREA_CODE=d.area_code and a.ZONE_ID=".$zone->ZONE_CODE." ".$date_con.$pg_con.$area_con." order by do_no";



$sqlt="select sum(s.t_price*s.total_unit) as total,sum(total_amt) as dp_total from 



sale_do_master m,dealer_info d  , warehouse w,area a,sale_do_details s



where  m.status in ('CHECKED','COMPLETED') and m.dealer_code=d.dealer_code and w.warehouse_id=d.depot and a.AREA_CODE=d.area_code and s.do_no=m.do_no and a.ZONE_ID=".$zone->ZONE_CODE." ".$date_con.$pg_con.$area_con;







		$queryt = mysql_query($sqlt);



		$t= mysql_fetch_object($queryt);



		if($t->total>0)



		{



			if($rp==0) {$reg_total=0;$dp_total=0; $str .= '<p style="width:100%">Region Name: '.$branch->BRANCH_NAME.' Region</p>';$rp++;}



			$str .= '<p style="width:100%">Zone Name: '.$zone->ZONE_NAME.' Zone</p>';



			echo report_create($sql,1,$str);



			$str = '';



			



			$reg_total= $reg_total+$t->total;



			$dp_total= $dp_total+$t->dp_total;



		}







	}



	



			if($rp>0){



?>



<table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">



  <thead>



    <tr>



      <td style="border:0px;"></td>



    </tr>



  </thead>



  <tbody>



    <tr class="footer">



      <td align="right"><?=$branch->BRANCH_NAME?>



        Region  DP Total:



        <?=number_format($dp_total,2)?>



        ||| TP Total:



        <?=number_format($reg_total,2)?></td>



    </tr>



  </tbody>



</table>



<br />



<br />



<br />



<?  }



	echo '</div>';



}



?>



<?







}







elseif($_REQUEST['report']==9) 



{



if(isset($region_id)) 



$sqlbranch 	= "select * from branch where BRANCH_ID=".$region_id;



else



$sqlbranch 	= "select * from branch";



$querybranch = mysql_query($sqlbranch);



while($branch=mysql_fetch_object($querybranch)){



	$rp=0;



	echo '<div>';



if(isset($zone_id)) 



$sqlzone 	= "select * from zon where REGION_ID=".$branch->BRANCH_ID." and ZONE_CODE=".$zone_id;



else



$sqlzone 	= "select * from zon where REGION_ID=".$branch->BRANCH_ID;







	$queryzone = mysql_query($sqlzone);



	while($zone=mysql_fetch_object($queryzone)){



if($area_id>0) 



$area_con = "and a.AREA_CODE=".$area_id;







$sql = "select i.finish_goods_code as code,i.item_name,i.item_brand,i.sales_item_type as `group`,



floor(sum(o.total_unit)/o.pkt_size) as crt,



mod(sum(o.total_unit),o.pkt_size) as pcs, 



sum(o.total_amt) as DP,



sum(o.total_unit*o.t_price) as TP



from 



sale_do_master m,sale_do_details o, item_info i, warehouse w, dealer_info d, area a



where m.do_no=o.do_no and m.dealer_code=d.dealer_code and w.warehouse_id=d.depot and i.item_id=o.item_id and a.AREA_CODE=d.area_code  and m.status in ('CHECKED','COMPLETED') and a.ZONE_ID=".$zone->ZONE_CODE." ".$date_con.$item_con.$item_brand_con.$pg_con.$area_con.' group by i.finish_goods_code';







$sqlt="select sum(o.t_price*o.total_unit) as total,sum(total_amt) as dp_total



from 



sale_do_master m,sale_do_details o, item_info i, warehouse w, dealer_info d, area a



where m.do_no=o.do_no and m.dealer_code=d.dealer_code and w.warehouse_id=d.depot and i.item_id=o.item_id and a.AREA_CODE=d.area_code  and m.status in ('CHECKED','COMPLETED') and a.ZONE_ID=".$zone->ZONE_CODE." ".$date_con.$item_con.$item_brand_con.$pg_con.$area_con.'';







		$queryt = mysql_query($sqlt);



		$t= mysql_fetch_object($queryt);



		if($t->total>0)



		{



			if($rp==0) {$reg_total=0;$dp_total=0; 



			$str .= '<p style="width:100%">Region Name: '.$branch->BRANCH_NAME.' Region</p>';$rp++;}



			$str .= '<p style="width:100%">Zone Name: '.$zone->ZONE_NAME.' Zone</p>';



			echo report_create($sql,1,$str);



			$str = '';



			



			$reg_total= $reg_total+$t->total;



			$dp_total= $dp_total+$t->dp_total;



		}







	}



	



			if($rp>0){



?>



<table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">



  <thead>



    <tr>



      <td style="border:0px;"></td>



    </tr>



  </thead>



  <tbody>



    <tr class="footer">



      <td align="right"><?=$branch->BRANCH_NAME?>



        Region  DP Total:



        <?=number_format($dp_total,2)?>



        ||| TP Total:



        <?=number_format($reg_total,2)?></td>



    </tr>



  </tbody>



</table>



<br />



<br />



<br />



<?  }



	echo '</div>';



}



}



elseif($_REQUEST['report']==14) 



{



if(isset($region_id)) 



$sqlbranch 	= "select * from branch where BRANCH_ID=".$region_id;



else $sqlbranch 	= "select * from branch";



$querybranch = mysql_query($sqlbranch);



while($branch=mysql_fetch_object($querybranch)){



	$rp=0;



	echo '<div>';







$sql = "select i.finish_goods_code as code,i.item_name,i.item_brand,i.sales_item_type as `group`,



floor(sum(o.total_unit)/o.pkt_size) as crt,



mod(sum(o.total_unit),o.pkt_size) as pcs, 



sum(o.total_amt) as DP,



sum(o.total_unit*o.t_price) as TP



from 



sale_do_master m,sale_do_details o, item_info i, warehouse w, dealer_info d, area a, zon z



where m.do_no=o.do_no and m.dealer_code=d.dealer_code and w.warehouse_id=d.depot and i.item_id=o.item_id and a.AREA_CODE=d.area_code  and m.status in ('CHECKED','COMPLETED') and a.ZONE_ID=z.ZONE_CODE and z.REGION_ID=".$region_id." ".$date_con.$item_con.$item_brand_con.$pg_con.$area_con.' group by i.finish_goods_code';







 $sqlt="select sum(o.t_price*o.total_unit) as total,sum(total_amt) as dp_total from 



sale_do_master m,sale_do_details o, item_info i, warehouse w, dealer_info d, area a, zon z



where m.do_no=o.do_no and m.dealer_code=d.dealer_code and w.warehouse_id=d.depot and i.item_id=o.item_id and a.AREA_CODE=d.area_code  and m.status in ('CHECKED','COMPLETED') and a.ZONE_ID=z.ZONE_CODE and z.REGION_ID=".$region_id." ".$date_con.$item_con.$item_brand_con.$pg_con.$area_con.'';







		$queryt = mysql_query($sqlt);



		$t= mysql_fetch_object($queryt);



		if($t->total>0)



		{



			if($rp==0) {$reg_total=0;$dp_total=0; 



			$str .= '<p style="width:100%">Region Name: '.$branch->BRANCH_NAME.' Region</p>';$rp++;



		}



			echo report_create($sql,1,$str);



			$str = '';



			



			$reg_total= $reg_total+$t->total;



			$dp_total= $dp_total+$t->dp_total;



		}







	



	



			if($rp>0){



?>



<table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">



  <thead>



    <tr>



      <td style="border:0px;"></td>



    </tr>



  </thead>



  <tbody>



    <tr class="footer">



      <td align="right"><?=$branch->BRANCH_NAME?>



        Region  DP Total:



        <?=number_format($dp_total,2)?>



        ||| TP Total:



        <?=number_format($reg_total,2)?></td>



    </tr>



  </tbody>



</table>



<br />



<br />



<br />



<?  }



	echo '</div>';



}







}



elseif($_REQUEST['report']==8) 



{



if(isset($region_id)) 



$sqlbranch 	= "select * from branch where BRANCH_ID=".$region_id;



else



$sqlbranch 	= "select * from branch";



$querybranch = mysql_query($sqlbranch);



while($branch=mysql_fetch_object($querybranch)){



	$rp=0;



	echo '<div>';



if(isset($zone_id)) 



$sqlzone 	= "select * from zon where REGION_ID=".$branch->BRANCH_ID." and ZONE_CODE=".$zone_id;



else



$sqlzone 	= "select * from zon where REGION_ID=".$branch->BRANCH_ID;







	$queryzone = mysql_query($sqlzone);



	while($zone=mysql_fetch_object($queryzone)){



if(isset($area_id)) 



{



$sql="select concat(d.dealer_code,'- ',d.dealer_name_e)  as dealer_name,w.warehouse_name as depot,a.AREA_NAME as area,d.product_group as grp,(select sum(total_amt) from sale_do_details where do_no=m.do_no) as DP_Total,(select sum(t_price*total_unit) from sale_do_details where do_no=m.do_no)  as TP_Total from 



sale_do_master m,dealer_info d  , warehouse w,area a



where  m.status in ('CHECKED','COMPLETED') and m.dealer_code=d.dealer_code and w.warehouse_id=d.depot and a.AREA_CODE=d.area_code and a.ZONE_ID=".$zone->ZONE_CODE." and a.AREA_CODE=".$area_id." ".$date_con.$pg_con." order by do_no";



$sqlt="select sum(s.t_price*s.total_unit) as total,sum(total_amt) as dp_total from 



sale_do_master m,dealer_info d  , warehouse w,area a,sale_do_details s



where  m.status in ('CHECKED','COMPLETED') and m.dealer_code=d.dealer_code and w.warehouse_id=d.depot and a.AREA_CODE=d.area_code and s.do_no=m.do_no and a.AREA_CODE=".$area_id." and a.ZONE_ID=".$zone->ZONE_CODE." ".$date_con.$pg_con;



}



else



{



$sql="select concat(d.dealer_code,'- ',d.dealer_name_e)  as dealer_name,w.warehouse_name as depot,a.AREA_NAME as area,d.product_group as grp,(select sum(total_amt) from sale_do_details where do_no=m.do_no) as DP_Total,(select sum(t_price*total_unit) from sale_do_details where do_no=m.do_no)  as TP_Total from 



sale_do_master m,dealer_info d  , warehouse w,area a



where  m.status in ('CHECKED','COMPLETED') and m.dealer_code=d.dealer_code and w.warehouse_id=d.depot and a.AREA_CODE=d.area_code and a.ZONE_ID=".$zone->ZONE_CODE." ".$date_con.$pg_con." order by do_no";



$sqlt="select sum(s.t_price*s.total_unit) as total,sum(total_amt) as dp_total from 



sale_do_master m,dealer_info d  , warehouse w,area a,sale_do_details s



where  m.status in ('CHECKED','COMPLETED') and m.dealer_code=d.dealer_code and w.warehouse_id=d.depot and a.AREA_CODE=d.area_code and s.do_no=m.do_no and a.ZONE_ID=".$zone->ZONE_CODE." ".$date_con.$pg_con;



}



		$queryt = mysql_query($sqlt);



		$t= mysql_fetch_object($queryt);



		if($t->total>0)



		{



			if($rp==0) {$reg_total=0;$dp_total=0; $str .= '<p style="width:100%">Region Name: '.$branch->BRANCH_NAME.' Region</p>';$rp++;}



			$str .= '<p style="width:100%">Zone Name: '.$zone->ZONE_NAME.' Zone</p>';



			echo report_create($sql,1,$str);



			$str = '';



			



			$reg_total= $reg_total+$t->total;



			$dp_total= $dp_total+$t->dp_total;



		}







	}



	



			if($rp>0){



?>



<table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">



  <thead>



    <tr>



      <td style="border:0px;"></td>



    </tr>



  </thead>



  <tbody>



    <tr class="footer">



      <td align="right"><?=$branch->BRANCH_NAME?>



        Region  DP Total:



        <?=number_format($dp_total,2)?>



        ||| TP Total:



        <?=number_format($reg_total,2)?></td>



    </tr>



  </tbody>



</table>



<br />



<br />



<br />



<?  }



	echo '</div>';



}







}elseif($_REQUEST['report']==100) 



{



if(isset($dealer_code)) 		{$dealer_con=' and d.dealer_code='.$dealer_code;} 







if(isset($region_id))			{$con .= " and z.REGION_ID=".$region_id;



								 $str .= '<p style="width:100%">Region Name: '.find_a_field('branch','BRANCH_NAME','BRANCH_ID='.$region_id).' Region</p>';}



								 



if(isset($zone_id))				{$con .= " and a.ZONE_ID=".$zone_id;



								 $str .= '<p style="width:100%">Zone Name: '.find_a_field('zon','ZONE_NAME','ZONE_CODE='.$zone_id).' Zone</p>';}



								 



if(isset($area_id)) 			{$con .= " and a.AREA_CODE=".$area_id;



								 $str .= '<p style="width:100%">Area Name: '.find_a_field('area','AREA_NAME','AREA_CODE='.$area_id).' Area</p>';}



?>



<table width="100%" border="0" cellspacing="0" cellpadding="2" id="ExportTable">



  <thead>



    <tr>



      <td style="border:0px;" colspan="11"><?=$str;?></td>



    </tr>



    <tr>



      <th>S/L</th>



      <th>CODE</th>



      <th>Dealer Name</th>



      <th>Grp</th>



      <th>Depot</th>



      <th>Region</th>



      <th>Zone</th>



      <th>Area</th>



      <th>Damage</th>



      <th>DO Total</th>



      <th>CH Delivery</th>



      <th>DO Delivery </th>



      <th>Sales Rtn </th>



      <th>Actual Sales </th>



    </tr>



  </thead>



  <tbody>



    <?



$sql="select d.dealer_code, d.dealer_name_e, w.warehouse_name, a.AREA_NAME as area,z.ZONE_NAME as zone,b.BRANCH_NAME as region, d.product_group as grp from 



dealer_info d  , warehouse w,area a,zon z,branch b



where a.ZONE_ID=z.ZONE_CODE and z.REGION_ID=b.BRANCH_ID and w.warehouse_id=d.depot and a.AREA_CODE=d.area_code ".$pg_con.$con.$dealer_con." ";







$query = mysql_query($sql);



while($data= mysql_fetch_object($query)){



$sql_o = 'select sum(o.total_amt) from sale_do_master m, sale_do_details o where m.dealer_code="'.$data->dealer_code.'" and m.do_no=o.do_no and m.status in ("COMPLETED","CHECKED") and m.do_date between "'.$fr_date.'" and "'.$to_date.'"';



$data_o = find_a_field_sql($sql_o);



$sql_d = 'select sum(o.total_amt) from sale_do_master m, sale_do_chalan o where m.dealer_code="'.$data->dealer_code.'" and m.do_no=o.do_no and m.status in ("COMPLETED","CHECKED") and m.do_date between "'.$fr_date.'" and "'.$to_date.'"';



$data_d = find_a_field_sql($sql_d);



$sql_c = 'select sum(o.total_amt) from sale_do_master m, sale_do_chalan o where m.dealer_code="'.$data->dealer_code.'" and m.do_no=o.do_no and m.status in ("COMPLETED","CHECKED") and o.chalan_date between "'.$fr_date.'" and "'.$to_date.'"';



$data_c = find_a_field_sql($sql_c);



$sql_sr = 'select sum(o.amount) from warehouse_other_receive_detail o where o.vendor_id="'.$data->dealer_code.'" and o.receive_type ="Return" and o.or_date between "'.$fr_date.'" and "'.$to_date.'"';



$data_sr = find_a_field_sql($sql_sr);







$sql_dr = 'select sum(o.amount) from warehouse_damage_receive_detail o,damage_cause d where o.vendor_id="'.$data->dealer_code.'" and o.receive_type =d.id and d.payable="Yes" and o.or_date between "'.$fr_date.'" and "'.$to_date.'"';



$data_dr = find_a_field_sql($sql_dr);







?>



    <tr>



      <td><?=++$op;?></td>



      <td><?=$data->dealer_code?></td>



      <td><?=$data->dealer_name_e?></td>



      <td><?=$data->grp?></td>



      <td><?=$data->warehouse_name?></td>



      <td><?=$data->region?></td>



      <td><?=$data->zone?></td>



      <td><?=$data->area?></td>



      <td><div align="right">



          <?=number_format($data_dr,2)?>



      </div></td>



      <td><div align="right">



          <?=number_format($data_o,2)?>



      </div></td>



      <td><div align="right">



          <?=number_format($data_c,2)?>



      </div></td>



      <td><div align="right">



          <?=number_format($data_d,2)?>



      </div></td>



      <td><div align="right">



          <?=number_format($data_sr,2)?>



      </div></td>



      <td><div align="right">



          <? $diff = ($data_d-$data_sr);echo number_format(($data_d-$data_sr),2)?>



      </div></td>



      <?



$ct = $ct + $data_c;



$ot = $ot + $data_o;



$dt = $dt + $data_d;



$srt = $srt + $data_sr;



$drt = $drt + $data_dr;



$ddiff = $ddiff + $diff;



}



?>



    </tr>



    <tr class="footer">



      <td>&nbsp;</td>



      <td>&nbsp;</td>



      <td>&nbsp;</td>



      <td>&nbsp;</td>



      <td>&nbsp;</td>



      <td>&nbsp;</td>



      <td>&nbsp;</td>



      <td>&nbsp;</td>



      <td style="text-align:right"><?=number_format($drt,2)?></td>



      <td style="text-align:right"><div align="right">



          <?=number_format($ot,2)?>



      </div></td>



      <td style="text-align:right"><div align="right">



          <?=number_format($ct,2)?>



      </div></td>



      <td style="text-align:right"><div align="right">



          <?=number_format($dt,2)?>



      </div></td>



      <td style="text-align:right"><div align="right">



          <?=number_format($srt,2)?>



      </div></td>



      <td style="text-align:right"><div align="right">



          <?=number_format($ddiff,2)?>



      </div></td>



    </tr>



  </tbody>



</table>



<?







}elseif($_REQUEST['report']==101) 



{



echo $str;



 if($t_date=='') $t_date = date('Y-m-d');



$t_array = explode('-',$t_date);



$t_stamp = strtotime($t_date);







$f_mons0 = date('Y-m-01',$t_stamp);



$f_mone0 = date('Y-m-'.date('t',$t_stamp),$t_stamp);







$f_mons1 = date('Y-'.($t_array[1]-1).'-01',$t_stamp);



$f_mone1 = date('Y-'.($t_array[1]-1).'-'.date('t',strtotime($f_mons1)),strtotime($f_mons1));







$f_mons2 = date('Y-'.($t_array[1]-2).'-01',$t_stamp);



$f_mone2 = date('Y-'.($t_array[1]-2).'-'.date('t',strtotime($f_mons2)),strtotime($f_mons2));







$f_mons3 = date('Y-'.($t_array[1]-3).'-01',$t_stamp);



$f_mone3 = date('Y-'.($t_array[1]-3).'-'.date('t',strtotime($f_mons3)),strtotime($f_mons3));







?>



<table width="100%" border="0" cellspacing="0" cellpadding="0" id="ExportTable">



  <tr>



    <td bgcolor="#333333"><span class="style3">S/L</span></td>



    <td bgcolor="#333333"><span class="style3">Item Code </span></td>



    <td bgcolor="#333333"><span class="style3">Item Name </span></td>



    <td bgcolor="#333333"><span class="style3">Grp</span></td>



    <td bgcolor="#333333"><span class="style3">Brand</span></td>



    <td bgcolor="#333333"><span class="style3">



      <?=date('M\'y',strtotime($f_mons3))?>



      </span></td>



    <td bgcolor="#333333"><span class="style3">



      <?=date('M\'y',strtotime($f_mons2))?>



      </span></td>



    <td bgcolor="#333333"><span class="style3">



      <?=date('M\'y',strtotime($f_mons1))?>



      </span></td>



    <td bgcolor="#333333"><span class="style3">



      <?=date('jS-M\'y',strtotime($t_date))?>



      </span></td>



    <td bgcolor="#333333"><span class="style3">



      <?=date('M\'y',strtotime($f_mons0))?>



      (Apx.)</span></td>



    <td bgcolor="#333333"><span class="style3">Growth</span></td>



  </tr>



  <?



if(isset($product_group)) 		{$pg_con=' and i.sales_item_type like "%'.$product_group.'%"';}



$sql = "select i.item_id, i.finish_goods_code as code,i.item_name,i.item_brand,i.sales_item_type as `group`



from item_info i



where i.item_brand!='Promotional' and i.sales_item_type!='' ".$item_con.$item_brand_con.$pg_con.' group by i.finish_goods_code';



if(isset($product_group)) 		{$pg_con=' and d.product_group="'.$product_group.'"';}



$query = mysql_query($sql);



while($item=mysql_fetch_object($query)){







$sqlmon0 = mysql_fetch_row(mysql_query("select sum(c.pkt_unit) from sale_do_chalan c, dealer_info d where d.dealer_code=c.dealer_code and c.chalan_date between '".$f_mons0."' and '".$t_date."' and c.item_id=".$item->item_id.$pg_con));







$sqlmon1 = mysql_fetch_row(mysql_query("select sum(c.pkt_unit) from sale_do_chalan c, dealer_info d where d.dealer_code=c.dealer_code and c.chalan_date between '".$f_mons1."' and '".$f_mone1."' and c.item_id=".$item->item_id.$pg_con));







$sqlmon2 = mysql_fetch_row(mysql_query("select sum(c.pkt_unit) from sale_do_chalan c, dealer_info d where d.dealer_code=c.dealer_code and c.chalan_date between '".$f_mons2."' and '".$f_mone2."' and c.item_id=".$item->item_id.$pg_con));







$sqlmon3 = mysql_fetch_row(mysql_query("select sum(c.pkt_unit) from sale_do_chalan c, dealer_info d where d.dealer_code=c.dealer_code and c.chalan_date between '".$f_mons3."' and '".$f_mone3."' and c.item_id=".$item->item_id.$pg_con));







$sqlmon = ((($sqlmon0[0])*date('t'))/$t_array[2]);



$diff = ($sqlmon-$sqlmon1[0]);







 ?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td><?=++$i?></td>



    <td><?=$item->code?></td>



    <td><?=$item->item_name?></td>



    <td><?=$item->group?></td>



    <td><?=$item->item_brand?></td>



    <td bgcolor="#99CCFF"><?=$sqlmon3[0]?></td>



    <td bgcolor="#66CC99"><?=$sqlmon2[0]?></td>



    <td bgcolor="#FFFF99"><?=$sqlmon1[0]?></td>



    <td><?=$sqlmon0[0]?></td>



    <td><?=$sqlmon?></td>



    <td style="color:<?=($diff>0)?'#009900;':'#FF0000;'?>"><?=$diff?></td>



  </tr>



  <? }?>



</table>



<?







}



elseif($_REQUEST['report']==102) 



{



echo $str;



 if($t_date=='') $t_date = date('Y-m-d');



$t_array = explode('-',$t_date);



$t_stamp = strtotime($t_date);







$f_mons0 = date('Y-m-01',$t_stamp);



$f_mone0 = date('Y-m-'.date('t',$t_stamp),$t_stamp);







$f_mons1 = date('Y-'.($t_array[1]-1).'-01',$t_stamp);



$f_mone1 = date('Y-'.($t_array[1]-1).'-'.date('t',strtotime($f_mons1)),strtotime($f_mons1));







$f_mons2 = date('Y-'.($t_array[1]-2).'-01',$t_stamp);



$f_mone2 = date('Y-'.($t_array[1]-2).'-'.date('t',strtotime($f_mons2)),strtotime($f_mons2));







$f_mons3 = date('Y-'.($t_array[1]-3).'-01',$t_stamp);



$f_mone3 = date('Y-'.($t_array[1]-3).'-'.date('t',strtotime($f_mons3)),strtotime($f_mons3));







?>



<table width="100%" border="0" cellspacing="0" cellpadding="0" id="ExportTable">



  <tr>



    <td bgcolor="#333333"><span class="style3">S/L</span></td>



    <td bgcolor="#333333"><span class="style3">Item Code </span></td>



    <td bgcolor="#333333"><span class="style3">Item Name </span></td>



    <td bgcolor="#333333"><span class="style3">Grp</span></td>



    <td bgcolor="#333333"><span class="style3">Brand</span></td>



    <td bgcolor="#333333"><span class="style3">



      <?=date('M\'y',strtotime($f_mons3))?>



      </span></td>



    <td bgcolor="#333333"><span class="style3">



      <?=date('M\'y',strtotime($f_mons2))?>



      </span></td>



    <td bgcolor="#333333"><span class="style3">



      <?=date('M\'y',strtotime($f_mons1))?>



      </span></td>



    <td bgcolor="#333333"><span class="style3">



      <?=date('jS-M\'y',strtotime($t_date))?>



      </span></td>



    <td bgcolor="#333333"><span class="style3">



      <?=date('M\'y',strtotime($f_mons0))?>



      (Apx.)</span></td>



    <td bgcolor="#333333"><span class="style3">Growth</span></td>



  </tr>



  <?



if(isset($product_group)) 		{$pg_con=' and i.sales_item_type like "%'.$product_group.'%"';}



$sql = "select i.item_id, i.finish_goods_code as code,i.item_name,i.item_brand,i.sales_item_type as `group`



from item_info i



where i.item_brand!='Promotional' and i.sales_item_type!='' ".$item_con.$item_brand_con.$pg_con.' group by i.finish_goods_code';



if(isset($product_group)) 		{$pg_con=' and d.product_group="'.$product_group.'"';}



	$query = mysql_query($sql);



	while($item=mysql_fetch_object($query)){



$sqlmon0 = mysql_fetch_row(mysql_query("select sum(c.total_amt) from sale_do_chalan c, dealer_info d where d.dealer_code=c.dealer_code and c.chalan_date between '".$f_mons0."' and '".$t_date."' and c.item_id=".$item->item_id.$pg_con));



$sqlmon1 = mysql_fetch_row(mysql_query("select sum(c.total_amt) from sale_do_chalan c, dealer_info d where d.dealer_code=c.dealer_code and c.chalan_date between '".$f_mons1."' and '".$f_mone1."' and c.item_id=".$item->item_id.$pg_con));



$sqlmon2 = mysql_fetch_row(mysql_query("select sum(c.total_amt) from sale_do_chalan c, dealer_info d where d.dealer_code=c.dealer_code and c.chalan_date between '".$f_mons2."' and '".$f_mone2."' and c.item_id=".$item->item_id.$pg_con));



$sqlmon3 = mysql_fetch_row(mysql_query("select sum(c.total_amt) from sale_do_chalan c, dealer_info d where d.dealer_code=c.dealer_code and c.chalan_date between '".$f_mons3."' and '".$f_mone3."' and c.item_id=".$item->item_id.$pg_con));







$sqlmon = ((($sqlmon0[0])*date('t'))/$t_array[2]);



$diff = ($sqlmon-$sqlmon1[0]);







$sqlmont3 = $sqlmont3 + $sqlmon3[0];



$sqlmont2 = $sqlmont2 + $sqlmon2[0];



$sqlmont1 = $sqlmont1 + $sqlmon1[0];







$sqlmont = $sqlmont + $sqlmon;



$sqlmont0 = $sqlmont0 + $sqlmon0[0];



 ?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td><?=++$i?></td>



    <td><?=$item->code?></td>



    <td><?=$item->item_name?></td>



    <td><?=$item->group?></td>



    <td><?=$item->item_brand?></td>



    <td bgcolor="#99CCFF"><?=number_format($sqlmon3[0],2);?></td>



    <td bgcolor="#66CC99"><?=number_format($sqlmon2[0],2);?></td>



    <td bgcolor="#FFFF99"><?=number_format($sqlmon1[0],2);?></td>



    <td><?=number_format($sqlmon0[0],2);?></td>



    <td><?=number_format($sqlmon,2);?></td>



    <td style="color:<?=($diff>0)?'#009900;':'#FF0000;'?>"><?=number_format($diff,2);?></td>



  </tr>



  <? }?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td colspan="5" bgcolor="#FFFFFF"><strong>Total</strong></td>



    <td bgcolor="#FFFFFF"><strong>&nbsp;



      <?=number_format($sqlmont3,2);?>



      </strong></td>



    <td bgcolor="#FFFFFF"><strong>&nbsp;



      <?=number_format($sqlmont2,2);?>



      </strong></td>



    <td bgcolor="#FFFFFF"><strong>&nbsp;



      <?=number_format($sqlmont1,2);?>



      </strong></td>



    <td bgcolor="#FFFFFF"><strong>



      <?=number_format($sqlmont0,2);?>



      </strong></td>



    <td bgcolor="#FFFFFF"><strong>



      <?=number_format($sqlmont,2);?>



      </strong></td>



    <td bgcolor="#FFFFFF" style="color:<?=($diff>0)?'#009900;':'#FF0000;'?>">&nbsp;</td>



  </tr>



</table>



<?







}







elseif($_REQUEST['report']==103) 



{



echo $str;



 if($t_date=='') $t_date = date('Y-m-d');



$t_array = explode('-',$t_date);



$t_stamp = strtotime($t_date);







$f_mons0 = date('Y-m-01',$t_stamp);



$f_mone0 = date('Y-m-'.date('t',$t_stamp),$t_stamp);







$f_mons1 = date('Y-'.($t_array[1]-1).'-01',$t_stamp);



$f_mone1 = date('Y-'.($t_array[1]-1).'-'.date('t',strtotime($f_mons1)),strtotime($f_mons1));







$f_mons2 = date('Y-'.($t_array[1]-2).'-01',$t_stamp);



$f_mone2 = date('Y-'.($t_array[1]-2).'-'.date('t',strtotime($f_mons2)),strtotime($f_mons2));







$f_mons3 = date('Y-'.($t_array[1]-3).'-01',$t_stamp);



$f_mone3 = date('Y-'.($t_array[1]-3).'-'.date('t',strtotime($f_mons3)),strtotime($f_mons3));







?>



<table width="100%" border="0" cellspacing="0" cellpadding="0" id="ExportTable">



  <tr>



    <td bgcolor="#333333"><span class="style3">S/L</span></td>



    <td bgcolor="#333333"><span class="style3">ZONE NAME </span></td>



    <td bgcolor="#333333"><span class="style3">



      <?=date('M\'y',strtotime($f_mons3))?>



      </span></td>



    <td bgcolor="#333333"><span class="style3">



      <?=date('M\'y',strtotime($f_mons2))?>



      </span></td>



    <td bgcolor="#333333"><span class="style3">



      <?=date('M\'y',strtotime($f_mons1))?>



      </span></td>



    <td bgcolor="#333333"><span class="style3">



      <?=date('jS-M\'y',strtotime($t_date))?>



      </span></td>



    <td bgcolor="#333333"><span class="style3">



      <?=date('M\'y',strtotime($f_mons0))?>



      (Apx.)</span></td>



    <td bgcolor="#333333"><span class="style3">Growth</span></td>



  </tr>



  <?



 







$sql = "select * from zon where REGION_ID='".$region_id."' order by ZONE_NAME";



	$query = mysql_query($sql);



	while($item=mysql_fetch_object($query)){



 $zone_code = $item->ZONE_CODE;



if(isset($product_group)) 		{$pg_con=' and d.product_group="'.$product_group.'"';}







echo "select sum(c.pkt_unit) from sale_do_chalan c,dealer_info d, area a where c.chalan_date between '".$f_mons0."' and '".$t_date."' and c.dealer_code=d.dealer_code and d.area_code=a.AREA_CODE and a.ZONE_ID='".$zone_code."' and c.item_id=".$item_info->item_id.$pg_con;



$sqlmon0 = mysql_fetch_row(mysql_query("select sum(c.pkt_unit) from sale_do_chalan c,dealer_info d, area a where c.chalan_date between '".$f_mons0."' and '".$t_date."' and c.dealer_code=d.dealer_code and d.area_code=a.AREA_CODE and a.ZONE_ID='".$zone_code."' and c.item_id=".$item_info->item_id.$pg_con));







$sqlmon1 = mysql_fetch_row(mysql_query("select sum(c.pkt_unit) from sale_do_chalan c,dealer_info d, area a where c.chalan_date between '".$f_mons1."' and '".$f_mone1."' and c.dealer_code=d.dealer_code and d.area_code=a.AREA_CODE and a.ZONE_ID='".$zone_code."' and c.item_id=".$item_info->item_id.$pg_con));







$sqlmon2 = mysql_fetch_row(mysql_query("select sum(c.pkt_unit) from sale_do_chalan c,dealer_info d, area a where c.chalan_date between '".$f_mons2."' and '".$f_mone2."' and c.dealer_code=d.dealer_code and d.area_code=a.AREA_CODE and a.ZONE_ID='".$zone_code."' and c.item_id=".$item_info->item_id.$pg_con));







$sqlmon3 = mysql_fetch_row(mysql_query("select sum(c.pkt_unit) from sale_do_chalan c,dealer_info d, area a where c.chalan_date between '".$f_mons3."' and '".$f_mone3."' and c.dealer_code=d.dealer_code and d.area_code=a.AREA_CODE and a.ZONE_ID='".$zone_code."' and c.item_id=".$item_info->item_id.$pg_con));











$sqlmon = ((($sqlmon0[0])*date('t'))/$t_array[2]);



$diff = ($sqlmon-$sqlmon1[0]);







 ?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td><?=++$i?></td>



    <td><a href="master_report.php?submit=105&report=105&item_id=<?=$_REQUEST['item_id']?>&zone_id=<?=$zone_code?>&t_date=<?=$_REQUEST['t_date']?>" target="_blank">



      <?=find_a_field('zon','ZONE_NAME','ZONE_CODE='.$zone_code)?>



    </a></td>



    <td bgcolor="#99CCFF"><?=number_format($sqlmon3[0],2);?></td>



    <td bgcolor="#66CC99"><?=number_format($sqlmon2[0],2);?></td>



    <td bgcolor="#FFFF99"><?=number_format($sqlmon1[0],2);?></td>



    <td><?=number_format($sqlmon0[0],2);?></td>



    <td><?=number_format($sqlmon,2);?></td>



    <td style="color:<?=($diff>0)?'#009900;':'#FF0000;'?>"><?=number_format($diff,2);?></td>



  </tr>



  <? }?>



</table>



<?







}







elseif($_POST['report']==2002) 



{



?>



<table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">



  <thead>



    <tr>



      <td style="border:0px;" colspan="9"><?=$str?>



        <div class="left"></div>



        <div class="right"></div>



        <div class="date">Reporting Time:



          <?=date("h:i A d-m-Y")?>



      </div></td>



    </tr>



    <tr>



      <th rowspan="2">S/L</th>



      <th rowspan="2">Fg</th>



      <th rowspan="2">Item Name</th>



      <th rowspan="2">Unit</th>



      <th rowspan="2">Brand</th>



      <th rowspan="2">Pack Size</th>



      <th rowspan="2">GRP</th>



      <th colspan="3" bgcolor="#FFCCFF"><div align="center">Last Year </div></th>



      <th colspan="3" bgcolor="#FFFF99"><div align="center">This Year </div></th>



      <th>Growth</th>



    </tr>



    <tr>



      <th>Sale Pkt</th>



      <th>Sale Qty </th>



      <th>Sale Amt </th>



      <th>Sale Pkt </th>



      <th>Sale Qty </th>



      <th>Sale Amt </th>



      <th>in % </th>



    </tr>



  </thead>



  <tbody>



    <?



$query = mysql_query($sql);



while($data=mysql_fetch_object($query)){







if($this_year_sale_qty[$data->item_id]>$last_year_sale_qty[$data->item_id])



{



$growth = @((($this_year_sale_qty[$data->item_id])/$last_year_sale_qty[$data->item_id]));



$bg = '; background-color:#99FFFF';



}else



{



$growth = @(($this_year_sale_qty[$data->item_id])/$last_year_sale_qty[$data->item_id]);



$bg = '; background-color:#FFCCCC';



}



$growth = ($growth*100)-100;



?>



    <tr>



      <td><?=++$s?></td>



      <td><?=$data->fg?></td>



      <td><?=$data->item_name?></td>



      <td><?=$data->unit?></td>



      <td><?=$data->brand?></td>



      <td><?=$data->pkt?></td>



      <td><?=$data->sales_item_type?></td>



      <td style="text-align:right"><?=(int)($last_year_sale_qty[$data->item_id]/$data->pkt)?></td>



      <td style="text-align:right"><?=number_format($last_year_sale_qty[$data->item_id],0,'',',')?></td>



      <td style="text-align:right"><?=number_format($last_year_sale_amt[$data->item_id],0,'',',')?></td>



      <td style="text-align:right"><?=(int)($this_year_sale_qty[$data->item_id]/$data->pkt)?></td>



      <td style="text-align:right"><?=number_format($this_year_sale_qty[$data->item_id],0,'',',')?></td>



      <td style="text-align:right"><?=number_format($this_year_sale_amt[$data->item_id],0,'',',')?></td>



      <td style="text-align:right<?=$bg?>"><? if($growth!=-100) echo number_format((($growth)),2)?></td>



    </tr>



    <?



}



?>



  </tbody>



</table>



<?



}







elseif($_POST['report']==2003) 



{



?>



<table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">



  <thead>



    <tr>



      <td style="border:0px;" colspan="9"><?=$str?>



        <div class="left"></div>



        <div class="right"></div>



        <div class="date">Reporting Time:



          <?=date("h:i A d-m-Y")?>



      </div></td>



    </tr>



    <tr>



      <th rowspan="2">S/L</th>



      <th rowspan="2">Code</th>



      <th rowspan="2">Dealer Name</th>



      <th rowspan="2">Area</th>



      <th rowspan="2">Zone</th>



      <th rowspan="2">Region</th>



      <th colspan="3" bgcolor="#FFCCFF"><div align="center">Last Year </div></th>



      <th colspan="3" bgcolor="#FFFF99"><div align="center">This Year </div></th>



      <th>Growth</th>



    </tr>



    <tr>



      <th>Sale Ctn</th>



      <th>Sale Total Pcs</th>



      <th>Sale Amt </th>



      <th>Sale Ctn </th>



      <th>Sale Total Pcs</th>



      <th>Sale Amt </th>



      <th>in % </th>



    </tr>



  </thead>



  <tbody>



    <?



$query = mysql_query($sql);



while($data=mysql_fetch_object($query)){







if($this_year_sale_qty[$data->dealer_code]>$last_year_sale_qty[$data->dealer_code])



{



$growth = @((($this_year_sale_qty[$data->dealer_code])/$last_year_sale_qty[$data->dealer_code]));



$bg = '; background-color:#99FFFF';



}else



{



$growth = @(($this_year_sale_qty[$data->dealer_code])/$last_year_sale_qty[$data->dealer_code]);



$bg = '; background-color:#FFCCCC';



}



$growth = ($growth*100)-100;



$ytotal_sale_pkt = $ytotal_sale_pkt + (int)($last_year_sale_pkt[$data->dealer_code]);



$ytotal_sale_amt = $ytotal_sale_amt + (int)($last_year_sale_amt[$data->dealer_code]);



$ytotal_sale_qty = $ytotal_sale_qty + (int)($last_year_sale_qty[$data->dealer_code]);



$total_sale_pkt = $total_sale_pkt + (int)($this_year_sale_pkt[$data->dealer_code]);



$total_sale_amt = $total_sale_amt + (int)($this_year_sale_amt[$data->dealer_code]);



$total_sale_qty = $total_sale_qty + (int)($this_year_sale_qty[$data->dealer_code]);



?>



    <tr>



      <td><?=++$s?></td>



      <td><?=$data->dealer_code?></td>



      <td><?=$data->dealer_name?></td>



      <td><?=$data->area_name?></td>



      <td><?=$data->zone_name?></td>



      <td><?=$data->region_name?></td>



      <td style="text-align:right"><?=(int)@($last_year_sale_pkt[$data->dealer_code])?></td>



      <td style="text-align:right"><?=number_format($last_year_sale_qty[$data->dealer_code],0,'',',')?></td>



      <td style="text-align:right"><?=number_format($last_year_sale_amt[$data->dealer_code],0,'',',')?></td>



      <td style="text-align:right"><?=(int)@($this_year_sale_pkt[$data->dealer_code])?></td>



      <td style="text-align:right"><?=number_format($this_year_sale_qty[$data->dealer_code],0,'',',')?></td>



      <td style="text-align:right"><?=number_format($this_year_sale_amt[$data->dealer_code],0,'',',')?></td>



      <td style="text-align:right<?=$bg?>"><? if($growth!=-100) echo number_format((($growth)),2)?></td>



    </tr>



    <?



}



?>



    <tr>



      <td colspan="6">&nbsp;</td>



      <td style="text-align:right"><?=(int)($ytotal_sale_pkt)?></td>



      <td style="text-align:right"><?=(int)($ytotal_sale_qty)?></td>



      <td style="text-align:right"><?=(int)($ytotal_sale_amt)?></td>



      <td style="text-align:right"><?=(int)($total_sale_pkt)?></td>



      <td style="text-align:right"><?=(int)($total_sale_qty)?></td>



      <td style="text-align:right"><?=(int)($total_sale_amt)?></td>



      <td>&nbsp;</td>



    </tr>



  </tbody>



</table>



<?



}







elseif($_POST['report']==20031) 



{



?>



<table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">



  <thead>



    <tr>



      <td style="border:0px;" colspan="6"><?=$str?>



        <div class="left"></div>



        <div class="right"></div>



        <div class="date">Reporting Time:



          <?=date("h:i A d-m-Y")?>



      </div></td>



    </tr>



    <tr>



      <th rowspan="2">S/L</th>



      <th rowspan="2">Code</th>



      <th rowspan="2">Region</th>



      <th colspan="3" bgcolor="#FFCCFF"><div align="center">Last Year </div></th>



      <th colspan="3" bgcolor="#FFFF99"><div align="center">This Year </div></th>



      <th>Growth</th>



    </tr>



    <tr>



      <th>Sale Ctnss</th>



      <th>Sale Total Pcs</th>



      <th>Sale Amt </th>



      <th>Sale Ctn </th>



      <th>Sale Total Pcs</th>



      <th>Sale Amt </th>



      <th>in % </th>



    </tr>



  </thead>



  <tbody>



    <?



$query = mysql_query($sql);



while($data=mysql_fetch_object($query)){







if($this_year_sale_qty[$data->BRANCH_ID]>$last_year_sale_qty[$data->BRANCH_ID])



{



$growth = @((($this_year_sale_qty[$data->BRANCH_ID])/$last_year_sale_qty[$data->BRANCH_ID]));



$bg = '; background-color:#99FFFF';



}else



{



$growth = @(($this_year_sale_qty[$data->BRANCH_ID])/$last_year_sale_qty[$data->BRANCH_ID]);



$bg = '; background-color:#FFCCCC';



}



$growth = ($growth*100)-100;



$ytotal_sale_pkt = $ytotal_sale_pkt + (int)($last_year_sale_pkt[$data->BRANCH_ID]);



$ytotal_sale_amt = $ytotal_sale_amt + (int)($last_year_sale_amt[$data->BRANCH_ID]);



$ytotal_sale_qty = $ytotal_sale_qty + (int)($last_year_sale_qty[$data->BRANCH_ID]);



$total_sale_pkt = $total_sale_pkt + (int)($this_year_sale_pkt[$data->BRANCH_ID]);



$total_sale_amt = $total_sale_amt + (int)($this_year_sale_amt[$data->BRANCH_ID]);



$total_sale_qty = $total_sale_qty + (int)($this_year_sale_qty[$data->BRANCH_ID]);



?>



    <tr>



      <td><?=++$s?></td>



      <td><?=$data->BRANCH_ID?></td>



      <td><?=$data->region_name?></td>



      <td style="text-align:right"><?=(int)@($last_year_sale_pkt[$data->BRANCH_ID])?></td>



      <td style="text-align:right"><?=number_format($last_year_sale_qty[$data->BRANCH_ID],0,'',',')?></td>



      <td style="text-align:right"><?=number_format($last_year_sale_amt[$data->BRANCH_ID],0,'',',')?></td>



      <td style="text-align:right"><?=(int)@($this_year_sale_pkt[$data->BRANCH_ID])?></td>



      <td style="text-align:right"><?=number_format($this_year_sale_qty[$data->BRANCH_ID],0,'',',')?></td>



      <td style="text-align:right"><?=number_format($this_year_sale_amt[$data->BRANCH_ID],0,'',',')?></td>



      <td style="text-align:right<?=$bg?>"><? if($growth!=-100) echo number_format((($growth)),2)?></td>



    </tr>



    <?



}



?>



    <tr>



      <td colspan="3" bgcolor="#EAEAEA">&nbsp;</td>



      <td bgcolor="#EAEAEA" style="text-align:right"><strong>



        <?=(int)($ytotal_sale_pkt)?>



        </strong></td>



      <td bgcolor="#EAEAEA" style="text-align:right"><strong>



        <?=(int)($ytotal_sale_qty)?>



        </strong></td>



      <td bgcolor="#EAEAEA" style="text-align:right"><strong>



        <?=(int)($ytotal_sale_amt)?>



        </strong></td>



      <td bgcolor="#EAEAEA" style="text-align:right"><strong>



        <?=(int)($total_sale_pkt)?>



        </strong></td>



      <td bgcolor="#EAEAEA" style="text-align:right"><strong>



        <?=(int)($total_sale_qty)?>



        </strong></td>



      <td bgcolor="#EAEAEA" style="text-align:right"><strong>



        <?=(int)($total_sale_amt)?>



        </strong></td>



      <td bgcolor="#EAEAEA">&nbsp;</td>



    </tr>



  </tbody>



</table>



<?



}







elseif($_REQUEST['report']==104) 



{



echo $str;



 if($t_date=='') $t_date = date('Y-m-d');



$t_array = explode('-',$t_date);



$t_stamp = strtotime($t_date);







$f_mons0 = date('Y-m-01',$t_stamp);



$f_mone0 = date('Y-m-'.date('t',$t_stamp),$t_stamp);







$f_mons1 = date('Y-'.($t_array[1]-1).'-01',$t_stamp);



$f_mone1 = date('Y-'.($t_array[1]-1).'-'.date('t',strtotime($f_mons1)),strtotime($f_mons1));







$f_mons2 = date('Y-'.($t_array[1]-2).'-01',$t_stamp);



$f_mone2 = date('Y-'.($t_array[1]-2).'-'.date('t',strtotime($f_mons2)),strtotime($f_mons2));







$f_mons3 = date('Y-'.($t_array[1]-3).'-01',$t_stamp);



$f_mone3 = date('Y-'.($t_array[1]-3).'-'.date('t',strtotime($f_mons3)),strtotime($f_mons3));







?>



<table width="100%" border="0" cellspacing="0" cellpadding="0" id="ExportTable">



  <tr>



    <td bgcolor="#333333"><span class="style3">S/L</span></td>



    <td bgcolor="#333333"><span class="style3">ZONE NAME </span></td>



    <td bgcolor="#333333"><span class="style3">



      <?=date('M\'y',strtotime($f_mons3))?>



      </span></td>



    <td bgcolor="#333333"><span class="style3">



      <?=date('M\'y',strtotime($f_mons2))?>



      </span></td>



    <td bgcolor="#333333"><span class="style3">



      <?=date('M\'y',strtotime($f_mons1))?>



      </span></td>



    <td bgcolor="#333333"><span class="style3">



      <?=date('jS-M\'y',strtotime($t_date))?>



      </span></td>



    <td bgcolor="#333333"><span class="style3">



      <?=date('M\'y',strtotime($f_mons0))?>



      (Apx.)</span></td>



    <td bgcolor="#333333"><span class="style3">Growth</span></td>



  </tr>



  <?



 







$sql = "select * from zon where REGION_ID='".$region_id."' order by ZONE_NAME";



if(isset($product_group)) 		{$pg_con=' and d.product_group="'.$product_group.'"';}



	$query = mysql_query($sql);



	while($item=mysql_fetch_object($query)){



 $zone_code = $item->ZONE_CODE;



$sqlmon0 = mysql_fetch_row(mysql_query("select sum(c.total_amt) from sale_do_chalan c,dealer_info d, area a where c.chalan_date between '".$f_mons0."' and '".$t_date."' and c.dealer_code=d.dealer_code and d.area_code=a.AREA_CODE and a.ZONE_ID='".$zone_code."' and c.item_id=".$item_info->item_id.$pg_con));







$sqlmon1 = mysql_fetch_row(mysql_query("select sum(c.total_amt) from sale_do_chalan c,dealer_info d, area a where c.chalan_date between '".$f_mons1."' and '".$f_mone1."' and c.dealer_code=d.dealer_code and d.area_code=a.AREA_CODE and a.ZONE_ID='".$zone_code."' and c.item_id=".$item_info->item_id.$pg_con));







$sqlmon2 = mysql_fetch_row(mysql_query("select sum(c.total_amt) from sale_do_chalan c,dealer_info d, area a where c.chalan_date between '".$f_mons2."' and '".$f_mone2."' and c.dealer_code=d.dealer_code and d.area_code=a.AREA_CODE and a.ZONE_ID='".$zone_code."' and c.item_id=".$item_info->item_id.$pg_con));







$sqlmon3 = mysql_fetch_row(mysql_query("select sum(c.total_amt) from sale_do_chalan c,dealer_info d, area a where c.chalan_date between '".$f_mons3."' and '".$f_mone3."' and c.dealer_code=d.dealer_code and d.area_code=a.AREA_CODE and a.ZONE_ID='".$zone_code."' and c.item_id=".$item_info->item_id.$pg_con));











$sqlmon = ((($sqlmon0[0])*date('t'))/$t_array[2]);



$diff = ($sqlmon-$sqlmon1[0]);







 ?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td><?=++$i?></td>



    <td><a href="master_report.php?submit=105&report=106&item_id=<?=$_REQUEST['item_id']?>&zone_id=<?=$zone_code?>&t_date=<?=$_REQUEST['t_date']?>" target="_blank" style="text-decoration:none">



      <?=find_a_field('zon','ZONE_NAME','ZONE_CODE='.$zone_code)?>



      </a></td>



    <td bgcolor="#99CCFF"><?=number_format($sqlmon3[0],2);?></td>



    <td bgcolor="#66CC99"><?=number_format($sqlmon2[0],2);?></td>



    <td bgcolor="#FFFF99"><?=number_format($sqlmon1[0],2);?></td>



    <td><?=number_format($sqlmon0[0],2);?></td>



    <td><?=number_format($sqlmon,2);?></td>



    <td style="color:<?=($diff>0)?'#009900;':'#FF0000;'?>"><?=number_format($diff,2);?></td>



  </tr>



  <? }?>



</table>



<?







}







elseif($_REQUEST['report']==105) 



{



echo $str;



 if($t_date=='') $t_date = date('Y-m-d');



$t_array = explode('-',$t_date);



$t_stamp = strtotime($t_date);







$f_mons0 = date('Y-m-01',$t_stamp);



$f_mone0 = date('Y-m-'.date('t',$t_stamp),$t_stamp);







$f_mons1 = date('Y-'.($t_array[1]-1).'-01',$t_stamp);



$f_mone1 = date('Y-'.($t_array[1]-1).'-'.date('t',strtotime($f_mons1)),strtotime($f_mons1));







$f_mons2 = date('Y-'.($t_array[1]-2).'-01',$t_stamp);



$f_mone2 = date('Y-'.($t_array[1]-2).'-'.date('t',strtotime($f_mons2)),strtotime($f_mons2));







$f_mons3 = date('Y-'.($t_array[1]-3).'-01',$t_stamp);



$f_mone3 = date('Y-'.($t_array[1]-3).'-'.date('t',strtotime($f_mons3)),strtotime($f_mons3));







?>



<table width="100%" border="0" cellspacing="0" cellpadding="0" id="ExportTable">



  <tr>



    <td bgcolor="#333333"><span class="style3">S/L</span></td>



    <td bgcolor="#333333"><span class="style3">DEALER NAME </span></td>



    <td bgcolor="#333333"><span class="style3">AREA NAME </span></td>



    <td bgcolor="#333333"><span class="style3">



      <?=date('M\'y',strtotime($f_mons3))?>



      </span></td>



    <td bgcolor="#333333"><span class="style3">



      <?=date('M\'y',strtotime($f_mons2))?>



      </span></td>



    <td bgcolor="#333333"><span class="style3">



      <?=date('M\'y',strtotime($f_mons1))?>



      </span></td>



    <td bgcolor="#333333"><span class="style3">



      <?=date('jS-M\'y',strtotime($t_date))?>



      </span></td>



    <td bgcolor="#333333"><span class="style3">



      <?=date('M\'y',strtotime($f_mons0))?>



      (Apx.)</span></td>



    <td bgcolor="#333333"><span class="style3">Growth</span></td>



  </tr>



  <?



 







$sql = "select d.dealer_code, d.dealer_name_e, a.area_name from dealer_info d, area a where d.area_code=a.AREA_CODE and ZONE_ID='".$zone_id."' order by d.dealer_name_e";



if(isset($product_group)) 		{$pg_con=' and d.product_group="'.$product_group.'"';}



	$query = mysql_query($sql);



	while($item=mysql_fetch_object($query)){



 $zone_code = $item->ZONE_CODE;



$sqlmon0 = mysql_fetch_row(mysql_query("select sum(c.pkt_unit) from sale_do_chalan c,dealer_info d where c.chalan_date between '".$f_mons0."' and '".$t_date."' and c.dealer_code=d.dealer_code and d.dealer_code='".$item->dealer_code."' and c.item_id=".$item_info->item_id.$pg_con));







$sqlmon1 = mysql_fetch_row(mysql_query("select sum(c.pkt_unit) from sale_do_chalan c,dealer_info d where c.chalan_date between '".$f_mons1."' and '".$f_mone1."' and c.dealer_code=d.dealer_code and d.dealer_code='".$item->dealer_code."' and c.item_id=".$item_info->item_id.$pg_con));







$sqlmon2 = mysql_fetch_row(mysql_query("select sum(c.pkt_unit) from sale_do_chalan c,dealer_info d where c.chalan_date between '".$f_mons2."' and '".$f_mone2."' and c.dealer_code=d.dealer_code and d.dealer_code='".$item->dealer_code."' and c.item_id=".$item_info->item_id.$pg_con));







$sqlmon3 = mysql_fetch_row(mysql_query("select sum(c.pkt_unit) from sale_do_chalan c,dealer_info d where c.chalan_date between '".$f_mons3."' and '".$f_mone3."' and c.dealer_code=d.dealer_code and d.dealer_code='".$item->dealer_code."' and c.item_id=".$item_info->item_id.$pg_con));











$sqlmon = ((($sqlmon0[0])*date('t'))/$t_array[2]);



$diff = ($sqlmon-$sqlmon1[0]);







 ?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td><?=++$i?></td>



    <td><?=$item->dealer_name_e?></td>



    <td><?=$item->area_name?></td>



    <td bgcolor="#99CCFF"><?=number_format($sqlmon3[0],2);?></td>



    <td bgcolor="#66CC99"><?=number_format($sqlmon2[0],2);?></td>



    <td bgcolor="#FFFF99"><?=number_format($sqlmon1[0],2);?></td>



    <td><?=number_format($sqlmon0[0],2);?></td>



    <td><?=number_format($sqlmon,2);?></td>



    <td style="color:<?=($diff>0)?'#009900;':'#FF0000;'?>"><?=number_format($diff,2);?></td>



  </tr>



  <? }?>



</table>



<?







}







elseif($_REQUEST['report']==106) 



{



echo $str;



 if($t_date=='') $t_date = date('Y-m-d');



$t_array = explode('-',$t_date);



$t_stamp = strtotime($t_date);







$f_mons0 = date('Y-m-01',$t_stamp);



$f_mone0 = date('Y-m-'.date('t',$t_stamp),$t_stamp);







$f_mons1 = date('Y-'.($t_array[1]-1).'-01',$t_stamp);



$f_mone1 = date('Y-'.($t_array[1]-1).'-'.date('t',strtotime($f_mons1)),strtotime($f_mons1));







$f_mons2 = date('Y-'.($t_array[1]-2).'-01',$t_stamp);



$f_mone2 = date('Y-'.($t_array[1]-2).'-'.date('t',strtotime($f_mons2)),strtotime($f_mons2));







$f_mons3 = date('Y-'.($t_array[1]-3).'-01',$t_stamp);



$f_mone3 = date('Y-'.($t_array[1]-3).'-'.date('t',strtotime($f_mons3)),strtotime($f_mons3));







?>



<table width="100%" border="0" cellspacing="0" cellpadding="0" id="ExportTable">



  <tr>



    <td bgcolor="#333333"><span class="style3">S/L</span></td>



    <td bgcolor="#333333"><span class="style3">DEALER NAME </span></td>



    <td bgcolor="#333333"><span class="style3">AREA NAME </span></td>



    <td bgcolor="#333333"><span class="style3">



      <?=date('M\'y',strtotime($f_mons3))?>



      </span></td>



    <td bgcolor="#333333"><span class="style3">



      <?=date('M\'y',strtotime($f_mons2))?>



      </span></td>



    <td bgcolor="#333333"><span class="style3">



      <?=date('M\'y',strtotime($f_mons1))?>



      </span></td>



    <td bgcolor="#333333"><span class="style3">



      <?=date('jS-M\'y',strtotime($t_date))?>



      </span></td>



    <td bgcolor="#333333"><span class="style3">



      <?=date('M\'y',strtotime($f_mons0))?>



      (Apx.)</span></td>



    <td bgcolor="#333333"><span class="style3">Growth</span></td>



  </tr>



  <?



 







$sql = "select d.dealer_code, d.dealer_name_e, a.area_name from dealer_info d, area a where d.area_code=a.AREA_CODE and ZONE_ID='".$zone_id."' order by d.dealer_name_e";



if(isset($product_group)) 		{$pg_con=' and d.product_group="'.$product_group.'"';}



$query = mysql_query($sql);



while($item=mysql_fetch_object($query)){







$zone_code = $item->ZONE_CODE;



$sqlmon0 = mysql_fetch_row(mysql_query("select sum(c.total_amt) from sale_do_chalan c,dealer_info d where c.chalan_date between '".$f_mons0."' and '".$t_date."' and c.dealer_code=d.dealer_code and d.dealer_code='".$item->dealer_code."' and c.item_id=".$item_info->item_id.$pg_con));







$sqlmon1 = mysql_fetch_row(mysql_query("select sum(c.total_amt) from sale_do_chalan c,dealer_info d where c.chalan_date between '".$f_mons1."' and '".$f_mone1."' and c.dealer_code=d.dealer_code and d.dealer_code='".$item->dealer_code."' and c.item_id=".$item_info->item_id.$pg_con));







$sqlmon2 = mysql_fetch_row(mysql_query("select sum(c.total_amt) from sale_do_chalan c,dealer_info d where c.chalan_date between '".$f_mons2."' and '".$f_mone2."' and c.dealer_code=d.dealer_code and d.dealer_code='".$item->dealer_code."' and c.item_id=".$item_info->item_id.$pg_con));







$sqlmon3 = mysql_fetch_row(mysql_query("select sum(c.total_amt) from sale_do_chalan c,dealer_info d where c.chalan_date between '".$f_mons3."' and '".$f_mone3."' and c.dealer_code=d.dealer_code and d.dealer_code='".$item->dealer_code."' and c.item_id=".$item_info->item_id.$pg_con));











$sqlmon = (int)((($sqlmon0[0])*date('t'))/$t_array[2]);



$diff = ($sqlmon-$sqlmon1[0]);







 ?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td><?=++$i?></td>



    <td><?=$item->dealer_name_e?></td>



    <td><?=$item->area_name?></td>



    <td bgcolor="#99CCFF"><?=number_format($sqlmon3[0],2);?></td>



    <td bgcolor="#66CC99"><?=number_format($sqlmon2[0],2);?></td>



    <td bgcolor="#FFFF99"><?=number_format($sqlmon1[0],2);?></td>



    <td><?=number_format($sqlmon0[0],2);?></td>



    <td><?=number_format($sqlmon,2);?></td>



    <td style="color:<?=($diff>0)?'#009900;':'#FF0000;'?>"><?=number_format($diff,2);?></td>



  </tr>



  <? }?>



</table>



<?



}



elseif($_REQUEST['report']==107) 



{



echo $str;



?>



<table width="100%" border="0" cellspacing="0" cellpadding="0" id="ExportTable">



  <tr>



    <td bgcolor="#333333"><span class="style3">S/L</span></td>



    <td bgcolor="#333333"><span class="style3">REGION NAME </span></td>



    <?



for($i=12;$i>0;$i--)



{



?>



    <td bgcolor="#333333"><div align="center"><span class="style3">



        <?=date('M\'y',strtotime(${'f_mos'.$i}))?>



    </span></div></td>



    <?



}



?>



    <td bgcolor="#333333"><div align="center"><strong><span class="style5">Total</span></strong></div></td>



  </tr>



  <?



 







$sql = "select BRANCH_ID,BRANCH_NAME from branch  order by BRANCH_NAME";



if(isset($product_group)) 		{$con=' and d.product_group="'.$product_group.'"';}



$query = @mysql_query($sql);



while($item=@mysql_fetch_object($query)){







$BRANCH_ID = $item->BRANCH_ID;



for($i=12;$i>0;$i--)



{



$m = ($i-1);







$sqql = "select sum(c.total_amt) from sale_do_chalan c,dealer_info d,area a, zon z where c.chalan_date between '".${'f_mons'.$i}."' and '".${'f_mone'.$i}."' and c.dealer_code=d.dealer_code and d.dealer_type='Distributor' and d.area_code=a.AREA_CODE and z.ZONE_CODE=a.ZONE_ID and z.REGION_ID='".$BRANCH_ID."'".$con;











${'sqlmon'.$i} = mysql_fetch_row(mysql_query($sqql));







${'totalc'.$i} = ${'totalc'.$i} + ${'sqlmon'.$i}[0];



${'totalr'.$BRANCH_ID} = ${'totalr'.$BRANCH_ID} + ${'sqlmon'.$i}[0];



}











 ?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td><?=++$j?></td>



    <td><?=$item->BRANCH_NAME?></td>



    <?



for($i=12;$i>0;$i--)



{



?>



    <td bgcolor="#99CCFF"><div align="right">



        <?=number_format(${'sqlmon'.$i}[0],2);?>



    </div></td>



    <?



}



?>



    <td bgcolor="#FFFF99"><div align="right"><strong>



        <? $totalallr= $totalallr + ${'totalr'.$BRANCH_ID};echo number_format(${'totalr'.$BRANCH_ID},2)?>



        </strong></div></td>



  </tr>



  <? }







for($i=12;$i>0;$i--)



{



$m = ($i-1);







$sqql = "select sum(c.total_amt) from sale_do_chalan c,dealer_info d where c.chalan_date between '".${'f_mons'.$i}."' and '".${'f_mone'.$i}."' and c.dealer_code=d.dealer_code and d.dealer_type='Corporate'".$con;







${'sqlmonc'.$i} = mysql_fetch_row(mysql_query($sqql));



${'totalco'.$i} = ${'totalco'.$i} + ${'sqlmonc'.$i}[0];



${'totalrc1'} = ${'totalrc1'} + ${'sqlmonc'.$i}[0];



}







  ?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td>&nbsp;</td>



    <td><strong>D Total</strong></td>



    <?



for($i=12;$i>0;$i--)



{



${'totald'} = ${'totald'} + ${'totalc'.$i};



?>



    <td bgcolor="#FFFF66"><div align="right">



        <?=number_format(${'totalc'.$i},2);?>



    </div></td>



    <?



}



?>



    <td bgcolor="#FFFF99"><div align="right">



        <?=number_format($totalallr,2);?>



      </div></td>



  </tr>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td><?=++$j?></td>



    <td>Corporate</td>



    <?



for($i=12;$i>0;$i--)



{



?>



    <td bgcolor="#99CCFF"><div align="right">



        <?=number_format(${'sqlmonc'.$i}[0],2);?>



    </div></td>



    <?



}



?>



    <td bgcolor="#FFFF99"><div align="right"><strong>



        <?=number_format($totalrc1,2)?>



        </strong></div></td>



  </tr>



  <?



	  for($i=12;$i>0;$i--)



{



$m = ($i-1);







$sqql = "select sum(c.total_amt) from sale_do_chalan c,dealer_info d where c.chalan_date between '".${'f_mons'.$i}."' and '".${'f_mone'.$i}."' and c.dealer_code=d.dealer_code and d.dealer_type='SuperShop'".$con;



${'sqlmons'.$i} = mysql_fetch_row(mysql_query($sqql));



${'totals'.$i} = ${'totals'.$i} + ${'sqlmons'.$i}[0];



${'totalrc'} = ${'totalrc'} + ${'sqlmons'.$i}[0];



}



	?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td><?=++$j?></td>



    <td>SuperShop</td>



    <?



for($i=12;$i>0;$i--)



{



?>



    <td bgcolor="#99CCFF"><div align="right">



        <?=number_format(${'sqlmons'.$i}[0],2);?>



    </div></td>



    <?



}



?>



    <td bgcolor="#FFFF99"><div align="right"><strong>



        <?=number_format($totalrc,2)?>



        </strong></div></td>



  </tr>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td>&nbsp;</td>



    <td><strong>Corporate+SuperShop</strong></td>



    <?



for($i=12;$i>0;$i--)



{



${'totalall'} = ${'totalall'} + (${'totals'.$i}+${'totalco'.$i});



?>



    <td bgcolor="#FFFF66"><div align="right">



        <?=number_format((${'totals'.$i}+${'totalco'.$i}),2)?>



    </div></td>



    <?



}



?>



    <td bgcolor="#FFFF99"><div align="right"><strong>



        <?=number_format(${'totalall'},2)?>



    </strong></div></td>



  </tr>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td>&nbsp;</td>



    <td><strong>N Total</strong></td>



    <?



for($i=12;$i>0;$i--)



{



${'totalallall'} = ${'totalallall'} + (${'totalc'.$i}+${'totals'.$i}+${'totalco'.$i});



?>



    <td bgcolor="#FF9999"><div align="right">



        <?=number_format((${'totalc'.$i}+${'totals'.$i}+${'totalco'.$i}),2)?>



    </div></td>



    <?



}



?>



    <td bgcolor="#FF3333"><div align="right"><strong>



        <?=number_format(${'totalallall'},2)?>



        </strong></div></td>



  </tr>



</table>



<?



}



elseif($_REQUEST['report']==108) 



{



echo $str;



?>



<table width="100%" border="0" cellspacing="0" cellpadding="0" id="ExportTable">



  <tr>



    <td bgcolor="#333333"><span class="style3">S/L</span></td>



    <td bgcolor="#333333"><span class="style3">REGION NAME </span></td>



    <?



for($i=12;$i>0;$i--)



{



?>



    <td bgcolor="#333333"><div align="center"><span class="style3">



        <?=date('M\'y',strtotime(${'f_mons'.$i}))?>



    </span></div></td>



    <?



}



?>



    <td bgcolor="#333333"><div align="center"><strong><span class="style5">Total</span></strong></div></td>



  </tr>



  <?



 







$sql = "select BRANCH_ID,BRANCH_NAME from branch  order by BRANCH_NAME";



if(isset($product_group)) 		{$con=' and d.product_group="'.$product_group.'"';}



if(isset($item_id)) 		{$con=' and c.item_id="'.$item_id.'"';}



$query = @mysql_query($sql);



while($item=@mysql_fetch_object($query)){







$BRANCH_ID = $item->BRANCH_ID;



for($i=12;$i>0;$i--)



{



$m = ($i-1);



$sqql = "select sum(c.pkt_unit) from sale_do_chalan c,dealer_info d,area a, zon z where c.chalan_date between '".${'f_mons'.$i}."' and '".${'f_mone'.$i}."' and c.dealer_code=d.dealer_code and d.dealer_type='Distributor' and d.area_code=a.AREA_CODE and z.ZONE_CODE=a.ZONE_ID and z.REGION_ID='".$BRANCH_ID."'".$con;



${'sqlmon'.$i} = mysql_fetch_row(mysql_query($sqql));







${'totalc'.$i} = ${'totalc'.$i} + ${'sqlmon'.$i}[0];



${'totalr'.$BRANCH_ID} = ${'totalr'.$BRANCH_ID} + ${'sqlmon'.$i}[0];



}











 ?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td><?=++$j?></td>



    <td><?=$item->BRANCH_NAME?></td>



    <?



for($i=12;$i>0;$i--)



{



?>



    <td bgcolor="#99CCFF"><div align="right">



        <?=number_format(${'sqlmon'.$i}[0],0);?>



    </div></td>



    <?



}



?>



    <td bgcolor="#FFFF99"><div align="right"><strong>



        <?=number_format(${'totalr'.$BRANCH_ID},0)?>



        </strong></div></td>



  </tr>



  <? }



  



  for($i=12;$i>0;$i--)



{



$m = ($i-1);



$sqql = "select sum(c.pkt_unit) from sale_do_chalan c,dealer_info d where c.chalan_date between '".${'f_mons'.$i}."' and '".${'f_mone'.$i}."' and c.dealer_code=d.dealer_code and d.dealer_type='Corporate'".$con;



${'sqlmonc'.$i} = mysql_fetch_row(mysql_query($sqql));



${'totalco'.$i} = ${'totalco'.$i} + ${'sqlmonc'.$i}[0];



${'totalrc1'} = ${'totalrc1'} + ${'sqlmonc'.$i}[0];



}







  ?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td>&nbsp;</td>



    <td><strong>D Total</strong></td>



    <?



for($i=12;$i>0;$i--)



{



${'totald'} = ${'totald'} + ${'totalc'.$i};



?>



    <td bgcolor="#FFFF66"><div align="right">



        <?=number_format(${'totalc'.$i},0);?>



    </div></td>



    <?



}



?>



    <td bgcolor="#FFFF99"><div align="right">



        <?=number_format(${'totald'},0);?>



    </div></td>



  </tr>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td><?=++$j?></td>



    <td>Corporate</td>



    <?



for($i=12;$i>0;$i--)



{



?>



    <td bgcolor="#99CCFF"><div align="right">



        <?=number_format(${'sqlmonc'.$i}[0],0);?>



    </div></td>



    <?



}



?>



    <td bgcolor="#FFFF99"><div align="right"><strong>



        <?=number_format($totalrc1,0)?>



        </strong></div></td>



  </tr>



  <?



	  for($i=12;$i>0;$i--)



{



$m = ($i-1);



$sqql = "select sum(c.pkt_unit) from sale_do_chalan c,dealer_info d where c.chalan_date between '".${'f_mons'.$i}."' and '".${'f_mone'.$i}."' and c.dealer_code=d.dealer_code and d.dealer_type='SuperShop'".$con;;



${'sqlmons'.$i} = mysql_fetch_row(mysql_query($sqql));



${'totals'.$i} = ${'totals'.$i} + ${'sqlmons'.$i}[0];



${'totalrc'} = ${'totalrc'} + ${'sqlmons'.$i}[0];



}



	?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td><?=++$j?></td>



    <td>SuperShop</td>



    <?



for($i=12;$i>0;$i--)



{



?>



    <td bgcolor="#99CCFF"><div align="right">



        <?=number_format(${'sqlmons'.$i}[0],0);?>



    </div></td>



    <?



}



?>



    <td bgcolor="#FFFF99"><div align="right"><strong>



        <?=number_format($totalrc,0)?>



    </strong></div></td>



  </tr>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td>&nbsp;</td>



    <td><strong>Corporate+SuperShop</strong></td>



    <?



for($i=12;$i>0;$i--)



{



${'totalall'} = ${'totalall'} + (${'totals'.$i}+${'totalco'.$i});



?>



    <td bgcolor="#FFFF66"><div align="right">



        <?=number_format((${'totals'.$i}+${'totalco'.$i}),0)?>



    </div></td>



    <?



}



?>



    <td bgcolor="#FFFF99"><div align="right"><strong>



        <?=number_format(${'totalall'},0)?>



    </strong></div></td>



  </tr>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td>&nbsp;</td>



    <td><strong>N Total</strong></td>



    <?



for($i=12;$i>0;$i--)



{



${'totalallall'} = ${'totalallall'} + (${'totalc'.$i}+${'totals'.$i}+${'totalco'.$i});



?>



    <td bgcolor="#FF9999"><div align="right">



        <?=number_format((${'totalc'.$i}+${'totals'.$i}+${'totalco'.$i}),0)?>



    </div></td>



    <?



}



?>



    <td bgcolor="#FF3333"><div align="right"><strong>



        <?=number_format(${'totalallall'},0)?>



    </strong></div></td>



  </tr>



</table>



<?



}



elseif($_REQUEST['report']==109) 



{



echo $str;



?>



<table width="100%" border="0" cellspacing="0" cellpadding="0" id="ExportTable">



  <tr>



    <td bgcolor="#333333"><span class="style3">S/L</span></td>



    <td bgcolor="#333333"><span class="style3">REGION NAME </span></td>



    <?



for($i=12;$i>0;$i--)



{



?>



    <td bgcolor="#333333"><div align="center"><span class="style3">



        <?=date('M\'y',strtotime(${'f_mons'.$i}))?>



        </span></div></td>



    <?



}



?>



    <td bgcolor="#333333"><div align="center"><strong><span class="style5">Total</span></strong></div></td>



  </tr>



  <?



 







$sql = "select BRANCH_ID,BRANCH_NAME from branch  order by BRANCH_NAME";



if(isset($product_group)) 		{$con=' and d.product_group="'.$product_group.'"';}



if(isset($item_id)) 		{$con=' and c.item_id="'.$item_id.'"';}



$query = @mysql_query($sql);



while($item=@mysql_fetch_object($query)){







$BRANCH_ID = $item->BRANCH_ID;



for($i=12;$i>0;$i--)



{



$m = ($i-1);







$sqql = "select sum(c.total_amt) from sale_do_chalan c,dealer_info d,area a, zon z where c.chalan_date between '".${'f_mons'.$i}."' and '".${'f_mone'.$i}."' and c.dealer_code=d.dealer_code and d.dealer_type='Distributor' and d.area_code=a.AREA_CODE and z.ZONE_CODE=a.ZONE_ID and z.REGION_ID='".$BRANCH_ID."'".$con;











${'sqlmon'.$i} = mysql_fetch_row(mysql_query($sqql));







${'totalc'.$i} = ${'totalc'.$i} + ${'sqlmon'.$i}[0];



${'totalr'.$BRANCH_ID} = ${'totalr'.$BRANCH_ID} + ${'sqlmon'.$i}[0];



}











 ?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td><?=++$j?></td>



    <td><?=$item->BRANCH_NAME?></td>



    <?



for($i=12;$i>0;$i--)



{



?>



    <td bgcolor="#99CCFF"><div align="right">



        <?=number_format(${'sqlmon'.$i}[0],2);?>



      </div></td>



    <?



}



?>



    <td bgcolor="#FFFF99"><div align="right"><strong>



        <? 



$totalallr= $totalallr + ${'totalr'.$BRANCH_ID};



echo number_format(${'totalr'.$BRANCH_ID},2);



	  ?>



        </strong></div></td>



  </tr>



  <? }







for($i=12;$i>0;$i--)



{



$m = ($i-1);







$sqql = "select sum(c.total_amt) from sale_do_chalan c,dealer_info d where c.chalan_date between '".${'f_mons'.$i}."' and '".${'f_mone'.$i}."' and c.dealer_code=d.dealer_code and d.dealer_type='Corporate'".$con;







${'sqlmonc'.$i} = mysql_fetch_row(mysql_query($sqql));



${'totalco'.$i} = ${'totalco'.$i} + ${'sqlmonc'.$i}[0];



${'totalrc1'} = ${'totalrc1'} + ${'sqlmonc'.$i}[0];



}







  ?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td>&nbsp;</td>



    <td><strong>D Total</strong></td>



    <?



for($i=12;$i>0;$i--)



{



${'totald'} = ${'totald'} + ${'totalc'.$i};



?>



    <td bgcolor="#FFFF66"><div align="right">



        <?=number_format(${'totalc'.$i},2);?>



      </div></td>



    <?



}



?>



    <td bgcolor="#FFFF99"><div align="right">



        <?=number_format($totalallr,2);?>



      </div></td>



  </tr>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td><?=++$j?></td>



    <td>Corporate</td>



    <?



for($i=12;$i>0;$i--)



{



?>



    <td bgcolor="#99CCFF"><div align="right">



        <?=number_format(${'sqlmonc'.$i}[0],2);?>



      </div></td>



    <?



}



?>



    <td bgcolor="#FFFF99"><div align="right"><strong>



        <?=number_format($totalrc1,2)?>



        </strong></div></td>



  </tr>



  <?



	  for($i=12;$i>0;$i--)



{



$m = ($i-1);







$sqql = "select sum(c.total_amt) from sale_do_chalan c,dealer_info d where c.chalan_date between '".${'f_mons'.$i}."' and '".${'f_mone'.$i}."' and c.dealer_code=d.dealer_code and d.dealer_type='SuperShop'".$con;



${'sqlmons'.$i} = mysql_fetch_row(mysql_query($sqql));



${'totals'.$i} = ${'totals'.$i} + ${'sqlmons'.$i}[0];



${'totalrc'} = ${'totalrc'} + ${'sqlmons'.$i}[0];



}



	?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td><?=++$j?></td>



    <td>SuperShop</td>



    <?



for($i=12;$i>0;$i--)



{



?>



    <td bgcolor="#99CCFF"><div align="right">



        <?=number_format(${'sqlmons'.$i}[0],2);?>



      </div></td>



    <?



}



?>



    <td bgcolor="#FFFF99"><div align="right"><strong>



        <?=number_format($totalrc,2)?>



        </strong></div></td>



  </tr>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td>&nbsp;</td>



    <td><strong>Corporate+SuperShop</strong></td>



    <?



for($i=12;$i>0;$i--)



{



${'totalall'} = ${'totalall'} + (${'totals'.$i}+${'totalco'.$i});



?>



    <td bgcolor="#FFFF66"><div align="right">



        <?=number_format((${'totals'.$i}+${'totalco'.$i}),2)?>



      </div></td>



    <?



}



?>



    <td bgcolor="#FFFF99"><div align="right"><strong>



        <?=number_format(${'totalall'},2)?>



        </strong></div></td>



  </tr>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td>&nbsp;</td>



    <td><strong>N Total</strong></td>



    <?



for($i=12;$i>0;$i--)



{



${'totalallall'} = ${'totalallall'} + (${'totalc'.$i}+${'totals'.$i}+${'totalco'.$i});



?>



    <td bgcolor="#FF9999"><div align="right">



        <?=number_format((${'totalc'.$i}+${'totals'.$i}+${'totalco'.$i}),2)?>



      </div></td>



    <?



}



?>



    <td bgcolor="#FF3333"><div align="right"><strong>



        <?=number_format(${'totalallall'},2)?>



        </strong></div></td>



  </tr>



</table>



<?



}



















elseif($_REQUEST['report']==110) 



{echo $str;



?>



<table width="100%" border="0" cellspacing="0" cellpadding="0" id="ExportTable">



  <tr>



    <td bgcolor="#333333"><span class="style3">S/L</span></td>



    <td bgcolor="#333333"><span class="style3">ZONE NAME</span></td>



    <?



for($i=12;$i>0;$i--)



{



?>



    <td bgcolor="#333333"><div align="center"><span class="style3">



        <?=date('M\'y',strtotime(${'f_mons'.$i}))?>



    </span></div></td>



    <?



}



?>



    <td bgcolor="#333333"><div align="center"><strong><span class="style5">Total</span></strong></div></td>



  </tr>



  <?



 







$sql = "select ZONE_CODE,ZONE_NAME from zon where REGION_ID=".$_REQUEST['region_id']." order by ZONE_NAME";



if(isset($product_group)) 		{$con=' and d.product_group="'.$product_group.'"';}



$query = @mysql_query($sql);



while($item=@mysql_fetch_object($query)){







$ZONE_CODE = $item->ZONE_CODE;



for($i=12;$i>0;$i--)



{



$m = ($i-1);







$sqql = "select sum(c.total_amt) from sale_do_chalan c,dealer_info d,area a where c.chalan_date between '".${'f_mons'.$i}."' and '".${'f_mone'.$i}."' and c.dealer_code=d.dealer_code and d.dealer_type='Distributor' and d.area_code=a.AREA_CODE and a.ZONE_ID ='".$ZONE_CODE."'".$con;











${'sqlmon'.$i} = mysql_fetch_row(mysql_query($sqql));







${'totalc'.$i} = ${'totalc'.$i} + ${'sqlmon'.$i}[0];



${'totalr'.$ZONE_CODE} = ${'totalr'.$ZONE_CODE} + ${'sqlmon'.$i}[0];



}











 ?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td><?=++$j?></td>



    <td><?=$item->ZONE_NAME?></td>



    <?



for($i=12;$i>0;$i--)



{



?>



    <td bgcolor="#99CCFF"><div align="right">



        <?=number_format(${'sqlmon'.$i}[0],2);?>



    </div></td>



    <?



}



?>



    <td bgcolor="#FFFF99"><div align="right"><strong>



        <? $totalallr= $totalallr + ${'totalr'.$ZONE_CODE};echo number_format(${'totalr'.$ZONE_CODE},2)?>



        </strong></div></td>



  </tr>



  <? }











  ?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td>&nbsp;</td>



    <td><strong>D Total</strong></td>



    <?



for($i=12;$i>0;$i--)



{



${'totald'} = ${'totald'} + ${'totalc'.$i};



?>



    <td bgcolor="#FFFF66"><div align="right">



        <?=number_format(${'totalc'.$i},2);?>



    </div></td>



    <?



}



?>



    <td bgcolor="#FFFF99"><div align="right">



        <?=number_format($totalallr,2);?>



      </div></td>



  </tr>



</table>



<?



}



elseif($_REQUEST['report']==111) 



{echo $str;



?>



<table width="100%" border="0" cellspacing="0" cellpadding="0" id="ExportTable">



  <tr>



    <td bgcolor="#333333"><span class="style3">S/L</span></td>



    <td bgcolor="#333333"><span class="style3">ZONE NAME </span></td>



    <?



for($i=12;$i>0;$i--)



{



?>



    <td bgcolor="#333333"><div align="center"><span class="style3">



        <?=date('M\'y',strtotime(${'f_mons'.$i}))?>



    </span></div></td>



    <?



}



?>



    <td bgcolor="#333333"><div align="center"><strong><span class="style5">Total</span></strong></div></td>



  </tr>



  <?



 







$sql = "select ZONE_CODE,ZONE_NAME from zon where REGION_ID=".$_REQUEST['region_id']." order by ZONE_NAME";



if(isset($product_group)) 		{$con=' and d.product_group="'.$product_group.'"';}



if(isset($item_id)) 		{$con=' and c.item_id="'.$item_id.'"';}



$query = @mysql_query($sql);



while($item=@mysql_fetch_object($query)){







$ZONE_CODE = $item->ZONE_CODE;



for($i=12;$i>0;$i--)



{



$m = ($i-1);



$sqql = "select sum(c.pkt_unit) from sale_do_chalan c,dealer_info d,area a where c.chalan_date between '".${'f_mons'.$i}."' and '".${'f_mone'.$i}."' and c.dealer_code=d.dealer_code and d.dealer_type='Distributor' and d.area_code=a.AREA_CODE and a.ZONE_ID ='".$ZONE_CODE."'".$con;



${'sqlmon'.$i} = mysql_fetch_row(mysql_query($sqql));







${'totalc'.$i} = ${'totalc'.$i} + ${'sqlmon'.$i}[0];



${'totalr'.$ZONE_CODE} = ${'totalr'.$ZONE_CODE} + ${'sqlmon'.$i}[0];



}











 ?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td><?=++$j?></td>



    <td><?=$item->ZONE_NAME?></td>



    <?



for($i=12;$i>0;$i--)



{



?>



    <td bgcolor="#99CCFF"><div align="right">



        <?=number_format(${'sqlmon'.$i}[0],0);?>



    </div></td>



    <?



}



?>



    <td bgcolor="#FFFF99"><div align="right"><strong>



        <?=number_format(${'totalr'.$ZONE_CODE},0)?>



        </strong></div></td>



  </tr>



  <? }



  







  ?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td>&nbsp;</td>



    <td><strong>D Total</strong></td>



    <?



for($i=12;$i>0;$i--)



{



${'totald'} = ${'totald'} + ${'totalc'.$i};



?>



    <td bgcolor="#FFFF66"><div align="right">



        <?=number_format(${'totalc'.$i},0);?>



    </div></td>



    <?



}



?>



    <td bgcolor="#FFFF99"><div align="right">



        <?=number_format(${'totald'},0);?>



    </div></td>



  </tr>



</table>



<?



}



elseif($_REQUEST['report']==112) 



{echo $str;



?>



<table width="100%" border="0" cellspacing="0" cellpadding="0" id="ExportTable">



  <tr>



    <td bgcolor="#333333"><span class="style3">S/L</span></td>



    <td bgcolor="#333333"><span class="style3">ZONE NAME </span></td>



    <?



for($i=12;$i>0;$i--)



{



?>



    <td bgcolor="#333333"><div align="center"><span class="style3">



        <?=date('M\'y',strtotime(${'f_mons'.$i}))?>



        </span></div></td>



    <?



}



?>



    <td bgcolor="#333333"><div align="center"><strong><span class="style5">Total</span></strong></div></td>



  </tr>



  <?



 







$sql = "select ZONE_CODE,ZONE_NAME from zon where REGION_ID=".$_REQUEST['region_id']." order by ZONE_NAME";



if(isset($product_group)) 		{$con=' and d.product_group="'.$product_group.'"';}



if(isset($item_id)) 		{$con=' and c.item_id="'.$item_id.'"';}



$query = @mysql_query($sql);



while($item=@mysql_fetch_object($query)){







$ZONE_CODE = $item->ZONE_CODE;



for($i=12;$i>0;$i--)



{



$m = ($i-1);







$sqql = "select sum(c.total_amt) from sale_do_chalan c,dealer_info d,area a where c.chalan_date between '".${'f_mons'.$i}."' and '".${'f_mone'.$i}."' and c.dealer_code=d.dealer_code and d.dealer_type='Distributor' and d.area_code=a.AREA_CODE and a.ZONE_ID ='".$ZONE_CODE."'".$con;











${'sqlmon'.$i} = mysql_fetch_row(mysql_query($sqql));







${'totalc'.$i} = ${'totalc'.$i} + ${'sqlmon'.$i}[0];



${'totalr'.$ZONE_CODE} = ${'totalr'.$ZONE_CODE} + ${'sqlmon'.$i}[0];



}











 ?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td><?=++$j?></td>



    <td><?=$item->ZONE_NAME?></td>



    <?



for($i=12;$i>0;$i--)



{



?>



    <td bgcolor="#99CCFF"><div align="right">



        <?=number_format(${'sqlmon'.$i}[0],2);?>



      </div></td>



    <?



}



?>



    <td bgcolor="#FFFF99"><div align="right"><strong>



        <? 



$totalallr= $totalallr + ${'totalr'.$ZONE_CODE};



echo number_format(${'totalr'.$ZONE_CODE},2);



	  ?>



        </strong></div></td>



  </tr>



  <? }







  ?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td>&nbsp;</td>



    <td><strong>D Total</strong></td>



    <?



for($i=12;$i>0;$i--)



{



${'totald'} = ${'totald'} + ${'totalc'.$i};



?>



    <td bgcolor="#FFFF66"><div align="right">



        <?=number_format(${'totalc'.$i},2);?>



      </div></td>



    <?



}



?>



    <td bgcolor="#FFFF99"><div align="right">



        <?=number_format($totalallr,2);?>



      </div></td>



  </tr>



</table>



<?



}







elseif($_REQUEST['report']==1130) 



{echo $str;



?>



<table width="100%" border="0" cellspacing="0" cellpadding="0" id="ExportTable">



  <tr>



    <td bgcolor="#333333"><span class="style3">S/L</span></td>



    <td bgcolor="#333333"><span class="style3">CODE</span></td>



    <td bgcolor="#333333"><span class="style3">DEALER NAME </span></td>



    <?



for($i=12;$i>0;$i--)



{



?>



    <td bgcolor="#333333"><div align="center"><span class="style3">



        <?=date('M\'y',strtotime(${'f_mons'.$i}))?>



    </span></div></td>



    <?



}



?>



    <td bgcolor="#333333"><div align="center"><strong><span class="style5">Total</span></strong></div></td>



  </tr>



  <?



 







$sql = "select dealer_code,dealer_name_e as dealer_name from dealer_info m where dealer_type = 'Corporate' ".$dealer_con." order by dealer_name_e";



if(isset($product_group)) 		{$con=' and d.product_group="'.$product_group.'"';}



$query = @mysql_query($sql);



while($item=@mysql_fetch_object($query)){







$dealer_code = $item->dealer_code;



for($i=12;$i>0;$i--)



{



$m = ($i-1);







$sqql = "select sum(c.total_amt) from sale_do_chalan c,dealer_info d,item_info i where i.item_id=c.item_id and c.chalan_date between '".${'f_mons'.$i}."' and '".${'f_mone'.$i}."' and c.dealer_code=d.dealer_code and d.dealer_type = 'Corporate' and d.dealer_code='".$dealer_code."'".$item_brand_con.$item_con.$con;











${'sqlmon'.$i} = mysql_fetch_row(mysql_query($sqql));







${'totalc'.$i} = ${'totalc'.$i} + ${'sqlmon'.$i}[0];



${'totalr'.$dealer_code} = ${'totalr'.$dealer_code} + ${'sqlmon'.$i}[0];



}











 ?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td><?=++$j?></td>



    <td><?=$item->dealer_code?></td>



    <td><?=$item->dealer_name?></td>



    <?



for($i=12;$i>0;$i--)



{



?>



    <td bgcolor="#99CCFF"><div align="right">



        <?=number_format(${'sqlmon'.$i}[0],2);?>



    </div></td>



    <?



}



?>



    <td bgcolor="#FFFF99"><div align="right"><strong>



        <? $totalallr= $totalallr + ${'totalr'.$dealer_code};echo number_format(${'totalr'.$dealer_code},2)?>



        </strong></div></td>



  </tr>



  <? }







  ?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td colspan="2">&nbsp;</td>



    <td><strong>D Total</strong></td>



    <?



for($i=12;$i>0;$i--)



{



${'totald'} = ${'totald'} + ${'totalc'.$i};



?>



    <td bgcolor="#FFFF66"><div align="right">



        <?=number_format(${'totalc'.$i},2);?>



    </div></td>



    <?



}



?>



    <td bgcolor="#FFFF99"><div align="right">



        <?=number_format($totalallr,2);?>



      </div></td>



  </tr>



</table>



<?



}



elseif($_REQUEST['report']==11301) 



{echo $str;



?>



<table width="100%" border="0" cellspacing="0" cellpadding="0" id="ExportTable">



  <tr>



    <td bgcolor="#333333"><span class="style3">S/L</span></td>



    <td bgcolor="#333333"><span class="style3">CODE</span></td>



    <td bgcolor="#333333"><span class="style3">DEALER NAME </span></td>



    <?



for($i=12;$i>0;$i--)



{



?>



    <td bgcolor="#333333"><div align="center"><span class="style3">



        <?=date('M\'y',strtotime(${'f_mons'.$i}))?>



    </span></div></td>



    <?



}



?>



    <td bgcolor="#333333"><div align="center"><strong><span class="style5">Total</span></strong></div></td>



  </tr>



  <?



 







$sql = "select dealer_code,dealer_name_e as dealer_name from dealer_info m where dealer_type = 'SuperShop' ".$dealer_con." order by dealer_name_e";



if(isset($product_group)) 		{$con=' and d.product_group="'.$product_group.'"';}



$query = @mysql_query($sql);



while($item=@mysql_fetch_object($query)){







$dealer_code = $item->dealer_code;



for($i=12;$i>0;$i--)



{



$m = ($i-1);







$sqql = "select sum(c.total_amt) from sale_do_chalan c,dealer_info d,item_info i where i.item_id=c.item_id and c.chalan_date between '".${'f_mons'.$i}."' and '".${'f_mone'.$i}."' and c.dealer_code=d.dealer_code and d.dealer_type = 'SuperShop' and d.dealer_code='".$dealer_code."'".$item_brand_con.$item_con.$con;











${'sqlmon'.$i} = @mysql_fetch_row(mysql_query($sqql));







${'totalc'.$i} = ${'totalc'.$i} + ${'sqlmon'.$i}[0];



${'totalr'.$dealer_code} = ${'totalr'.$dealer_code} + ${'sqlmon'.$i}[0];



}











 ?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td><?=++$j?></td>



    <td><?=$item->dealer_code?></td>



    <td><?=$item->dealer_name?></td>



    <?



for($i=12;$i>0;$i--)



{



?>



    <td bgcolor="#99CCFF"><div align="right">



        <?=number_format(${'sqlmon'.$i}[0],2);?>



    </div></td>



    <?



}



?>



    <td bgcolor="#FFFF99"><div align="right"><strong>



        <? $totalallr= $totalallr + ${'totalr'.$dealer_code};echo number_format(${'totalr'.$dealer_code},2)?>



        </strong></div></td>



  </tr>



  <? }







  ?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td colspan="2">&nbsp;</td>



    <td><strong>D Total</strong></td>



    <?



for($i=12;$i>0;$i--)



{



${'totald'} = ${'totald'} + ${'totalc'.$i};



?>



    <td bgcolor="#FFFF66"><div align="right">



        <?=number_format(${'totalc'.$i},2);?>



    </div></td>



    <?



}



?>



    <td bgcolor="#FFFF99"><div align="right">



        <?=number_format($totalallr,2);?>



      </div></td>



  </tr>



</table>



<?



}



elseif($_REQUEST['report']==113) 



{echo $str;



?>



<table width="100%" border="0" cellspacing="0" cellpadding="0" id="ExportTable" >



  <tr>



    <td bgcolor="#333333"><span class="style3">S/L</span></td>



    <td bgcolor="#333333"><span class="style3">CODE</span></td>



    <td bgcolor="#333333"><span class="style3">DEALER NAME </span></td>



    <?



for($i=12;$i>0;$i--)



{



?>



    <td bgcolor="#333333"><div align="center"><span class="style3">



        <?=date('M\'y',strtotime(${'f_mons'.$i}))?>



    </span></div></td>



    <?



}



?>



    <td bgcolor="#333333"><div align="center"><strong><span class="style5">Total</span></strong></div></td>



  </tr>



  <?



 







$sql = "select dealer_code,dealer_name_e as dealer_name from dealer_info d, area a where d.area_code=a.AREA_CODE and a.ZONE_ID=".$_REQUEST['zone_id']."  order by dealer_name_e";



if(isset($product_group)) 		{$con=' and d.product_group="'.$product_group.'"';}



$query = @mysql_query($sql);



while($item=@mysql_fetch_object($query)){







$dealer_code = $item->dealer_code;



for($i=12;$i>0;$i--)



{



$m = ($i-1);







$sqql = "select sum(c.total_amt) from sale_do_chalan c,dealer_info d where c.chalan_date between '".${'f_mons'.$i}."' and '".${'f_mone'.$i}."' and c.dealer_code=d.dealer_code and d.dealer_type='Distributor' and d.dealer_code='".$dealer_code."'".$con;











${'sqlmon'.$i} = mysql_fetch_row(mysql_query($sqql));







${'totalc'.$i} = ${'totalc'.$i} + ${'sqlmon'.$i}[0];



${'totalr'.$dealer_code} = ${'totalr'.$dealer_code} + ${'sqlmon'.$i}[0];



}











 ?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td><?=++$j?></td>



    <td><?=$item->dealer_code?></td>



    <td><?=$item->dealer_name?></td>



    <?



for($i=12;$i>0;$i--)



{



?>



    <td bgcolor="#99CCFF"><div align="right">



        <?=number_format(${'sqlmon'.$i}[0],2);?>



    </div></td>



    <?



}



?>



    <td bgcolor="#FFFF99"><div align="right"><strong>



        <? $totalallr= $totalallr + ${'totalr'.$dealer_code};echo number_format(${'totalr'.$dealer_code},2)?>



        </strong></div></td>



  </tr>



  <? }







for($i=12;$i>0;$i--)



{



$m = ($i-1);







$sqql = "select sum(c.total_amt) from sale_do_chalan c,dealer_info d where c.chalan_date between '".${'f_mons'.$i}."' and '".${'f_mone'.$i}."' and c.dealer_code=d.dealer_code and d.dealer_type='Corporate'".$con;







${'sqlmonc'.$i} = mysql_fetch_row(mysql_query($sqql));



${'totalco'.$i} = ${'totalco'.$i} + ${'sqlmonc'.$i}[0];



${'totalrc1'} = ${'totalrc1'} + ${'sqlmonc'.$i}[0];



}







  ?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td colspan="2">&nbsp;</td>



    <td><strong>D Total</strong></td>



    <?



for($i=12;$i>0;$i--)



{



${'totald'} = ${'totald'} + ${'totalc'.$i};



?>



    <td bgcolor="#FFFF66"><div align="right">



        <?=number_format(${'totalc'.$i},2);?>



    </div></td>



    <?



}



?>



    <td bgcolor="#FFFF99"><div align="right">



        <?=number_format($totalallr,2);?>



      </div></td>



  </tr>



  <?



	  for($i=12;$i>0;$i--)



{



$m = ($i-1);







$sqql = "select sum(c.total_amt) from sale_do_chalan c,dealer_info d where c.chalan_date between '".${'f_mons'.$i}."' and '".${'f_mone'.$i}."' and c.dealer_code=d.dealer_code and d.dealer_type='SuperShop'".$con;



${'sqlmons'.$i} = mysql_fetch_row(mysql_query($sqql));



${'totals'.$i} = ${'totals'.$i} + ${'sqlmons'.$i}[0];



${'totalrc'} = ${'totalrc'} + ${'sqlmons'.$i}[0];



}



	?>



</table>



<?



}



elseif($_REQUEST['report']==116) 



{echo $str;



?>



<table width="100%" border="0" cellspacing="0" cellpadding="0" id="ExportTable">



  <tr>



    <td bgcolor="#333333"><span class="style3">S/L</span></td>



    <td bgcolor="#333333"><span class="style3">REGION NAME</span></td>



    <td bgcolor="#333333"><span class="style3">ZONE NAME </span></td>



    <td bgcolor="#333333"><span class="style3">CTN</span></td>



    <td bgcolor="#333333"><span class="style3">TAKA(DP)</span></td>



  </tr>



  <?



 



//$region_name = find_a_field('branch','BRANCH_NAME','BRANCH_ID='.$region_id);



if($region_id>0) $region_con = ' and REGION_ID="'.$region_id.'"';



$sql = "select z.*,b.BRANCH_NAME from zon z,branch b where 1 and BRANCH_ID=REGION_ID ".$region_con." order by BRANCH_NAME,ZONE_NAME";



//if(isset($product_group)) 		{$pg_con=' and d.product_group="'.$product_group.'"';}



	$query = mysql_query($sql);



	while($item=mysql_fetch_object($query)){



 $zone_code = $item->ZONE_CODE;



$sqlmon = mysql_fetch_row(mysql_query("select sum(c.total_amt),sum(c.total_unit),c.pkt_size from sale_do_chalan c,dealer_info d, area a where c.chalan_date between '".$f_date."' and '".$t_date."' and d.dealer_type='Distributor' and c.dealer_code=d.dealer_code and d.area_code=a.AREA_CODE and a.ZONE_ID='".$zone_code."' and c.item_id=".$item_id));







//echo "select sum(c.total_amt),sum(c.total_unit),i.pack_size from sale_do_chalan c,dealer_info d, area a where c.chalan_date between '".$f_date."' and '".$t_date."' and d.dealer_type='Distributor' and c.dealer_code=d.dealer_code and d.area_code=a.AREA_CODE and a.ZONE_ID='".$zone_code."' and c.item_id=".$item_id;



$totalq = $totalq + (int)@($sqlmon[1]/$sqlmon[2]);



$totalt = $totalt + $sqlmon[0];



 ?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td><?=++$i?></td>



    <td><?=$item->BRANCH_NAME?></td>



    <td><?=find_a_field('zon','ZONE_NAME','ZONE_CODE='.$zone_code)?>



    </td>



    <td bgcolor="#99CCFF"><?=(int)@($sqlmon[1]/$sqlmon[2]);?></td>



    <td bgcolor="#66CC99"><?=number_format($sqlmon[0],2);?></td>



  </tr>



  <? }



  



  ?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td colspan="3">TOTAL :</td>



    <td><?=(int)@($totalq);?></td>



    <td><?=number_format($totalt,2);?></td>



  </tr>



</table>



<?



}



elseif($_REQUEST['report']==114) 



{echo $str;



?>



<table width="100%" border="0" cellspacing="0" cellpadding="0" id="ExportTable">



  <tr>



    <td bgcolor="#333333"><span class="style3">S/L</span></td>



    <td bgcolor="#333333"><span class="style3">DEALER NAME </span></td>



    <?



for($i=12;$i>0;$i--)



{



?>



    <td bgcolor="#333333"><div align="center"><span class="style3">



        <?=date('M\'y',strtotime(${'f_mons'.$i}))?>



    </span></div></td>



    <?



}



?>



    <td bgcolor="#333333"><div align="center"><strong><span class="style5">Total</span></strong></div></td>



  </tr>



  <?



 







$sql = "select dealer_code,dealer_name_e as dealer_name from dealer_info d, area a where d.area_code=a.AREA_CODE and a.ZONE_ID=".$_REQUEST['zone_id']."  order by dealer_name_e";



if(isset($product_group)) 		{$con=' and d.product_group="'.$product_group.'"';}



if(isset($item_id)) 		{$con=' and c.item_id="'.$item_id.'"';}



$query = @mysql_query($sql);



while($item=@mysql_fetch_object($query)){







$dealer_code = $item->dealer_code;



for($i=12;$i>0;$i--)



{



$m = ($i-1);



$sqql = "select sum(c.pkt_unit) from sale_do_chalan c,dealer_info d where c.chalan_date between '".${'f_mons'.$i}."' and '".${'f_mone'.$i}."' and c.dealer_code=d.dealer_code and d.dealer_type='Distributor' and d.dealer_code='".$dealer_code."'".$con;



${'sqlmon'.$i} = mysql_fetch_row(mysql_query($sqql));







${'totalc'.$i} = ${'totalc'.$i} + ${'sqlmon'.$i}[0];



${'totalr'.$dealer_code} = ${'totalr'.$dealer_code} + ${'sqlmon'.$i}[0];



}











 ?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td><?=++$j?></td>



    <td><?=$item->dealer_name?></td>



    <?



for($i=12;$i>0;$i--)



{



?>



    <td bgcolor="#99CCFF"><div align="right">



        <?=number_format(${'sqlmon'.$i}[0],0);?>



    </div></td>



    <?



}



?>



    <td bgcolor="#FFFF99"><div align="right"><strong>



        <?=number_format(${'totalr'.$dealer_code},0)?>



        </strong></div></td>



  </tr>



  <? }



  



  for($i=12;$i>0;$i--)



{



$m = ($i-1);



$sqql = "select sum(c.pkt_unit) from sale_do_chalan c,dealer_info d where c.chalan_date between '".${'f_mons'.$i}."' and '".${'f_mone'.$i}."' and c.dealer_code=d.dealer_code and d.dealer_type='Corporate'".$con;



${'sqlmonc'.$i} = mysql_fetch_row(mysql_query($sqql));



${'totalco'.$i} = ${'totalco'.$i} + ${'sqlmonc'.$i}[0];



${'totalrc1'} = ${'totalrc1'} + ${'sqlmonc'.$i}[0];



}







  ?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td>&nbsp;</td>



    <td><strong>D Total</strong></td>



    <?



for($i=12;$i>0;$i--)



{



${'totald'} = ${'totald'} + ${'totalc'.$i};



?>



    <td bgcolor="#FFFF66"><div align="right">



        <?=number_format(${'totalc'.$i},0);?>



    </div></td>



    <?



}



?>



    <td bgcolor="#FFFF99"><div align="right">



        <?=number_format(${'totald'},0);?>



    </div></td>



  </tr>



  <?



	  for($i=12;$i>0;$i--)



{



$m = ($i-1);



$sqql = "select sum(c.pkt_unit) from sale_do_chalan c,dealer_info d where c.chalan_date between '".${'f_mons'.$i}."' and '".${'f_mone'.$i}."' and c.dealer_code=d.dealer_code and d.dealer_type='SuperShop'".$con;;



${'sqlmons'.$i} = mysql_fetch_row(mysql_query($sqql));



${'totals'.$i} = ${'totals'.$i} + ${'sqlmons'.$i}[0];



${'totalrc'} = ${'totalrc'} + ${'sqlmons'.$i}[0];



}



	?>



</table>



<?



}



elseif($_REQUEST['report']==115) 



{echo $str;



?>



<table width="100%" border="0" cellspacing="0" cellpadding="0" id="ExportTable">



  <tr>



    <td bgcolor="#333333"><span class="style3">S/L</span></td>



    <td bgcolor="#333333"><span class="style3">DEALER NAME </span></td>



    <?



for($i=12;$i>0;$i--)



{



?>



    <td bgcolor="#333333"><div align="center"><span class="style3">



        <?=date('M\'y',strtotime(${'f_mons'.$i}))?>



        </span></div></td>



    <?



}



?>



    <td bgcolor="#333333"><div align="center"><strong><span class="style5">Total</span></strong></div></td>



  </tr>



  <?



 







$sql = "select dealer_code,dealer_name_e as dealer_name from dealer_info d, area a where d.area_code=a.AREA_CODE and a.ZONE_ID=".$_REQUEST['zone_id']."  order by dealer_name_e";



if(isset($product_group)) 		{$con=' and d.product_group="'.$product_group.'"';}



if(isset($item_id)) 		{$con=' and c.item_id="'.$item_id.'"';}



$query = @mysql_query($sql);



while($item=@mysql_fetch_object($query)){







$dealer_code = $item->dealer_code;



for($i=12;$i>0;$i--)



{



$m = ($i-1);







$sqql = "select sum(c.total_amt) from sale_do_chalan c,dealer_info d where c.chalan_date between '".${'f_mons'.$i}."' and '".${'f_mone'.$i}."' and c.dealer_code=d.dealer_code and d.dealer_type='Distributor' and d.dealer_code='".$dealer_code."'".$con;











${'sqlmon'.$i} = mysql_fetch_row(mysql_query($sqql));







${'totalc'.$i} = ${'totalc'.$i} + ${'sqlmon'.$i}[0];



${'totalr'.$dealer_code} = ${'totalr'.$dealer_code} + ${'sqlmon'.$i}[0];



}











 ?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td><?=++$j?></td>



    <td><?=$item->dealer_name?></td>



    <?



for($i=12;$i>0;$i--)



{



?>



    <td bgcolor="#99CCFF"><div align="right">



        <?=number_format(${'sqlmon'.$i}[0],2);?>



      </div></td>



    <?



}



?>



    <td bgcolor="#FFFF99"><div align="right"><strong>



        <? 



$totalallr= $totalallr + ${'totalr'.$dealer_code};



echo number_format(${'totalr'.$dealer_code},2);



	  ?>



        </strong></div></td>



  </tr>



  <? }







for($i=12;$i>0;$i--)



{



$m = ($i-1);







$sqql = "select sum(c.total_amt) from sale_do_chalan c,dealer_info d where c.chalan_date between '".${'f_mons'.$i}."' and '".${'f_mone'.$i}."' and c.dealer_code=d.dealer_code and d.dealer_type='Corporate'".$con;







${'sqlmonc'.$i} = mysql_fetch_row(mysql_query($sqql));



${'totalco'.$i} = ${'totalco'.$i} + ${'sqlmonc'.$i}[0];



${'totalrc1'} = ${'totalrc1'} + ${'sqlmonc'.$i}[0];



}







  ?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td>&nbsp;</td>



    <td><strong>D Total</strong></td>



    <?



for($i=12;$i>0;$i--)



{



${'totald'} = ${'totald'} + ${'totalc'.$i};



?>



    <td bgcolor="#FFFF66"><div align="right">



        <?=number_format(${'totalc'.$i},2);?>



      </div></td>



    <?



}



?>



    <td bgcolor="#FFFF99"><div align="right">



        <?=number_format($totalallr,2);?>



      </div></td>



  </tr>



  <?



	  for($i=12;$i>0;$i--)



{



$m = ($i-1);







$sqql = "select sum(c.total_amt) from sale_do_chalan c,dealer_info d where c.chalan_date between '".${'f_mons'.$i}."' and '".${'f_mone'.$i}."' and c.dealer_code=d.dealer_code and d.dealer_type='SuperShop'".$con;



${'sqlmons'.$i} = mysql_fetch_row(mysql_query($sqql));



${'totals'.$i} = ${'totals'.$i} + ${'sqlmons'.$i}[0];



${'totalrc'} = ${'totalrc'} + ${'sqlmons'.$i}[0];



}



	?>



</table>



<?



}



elseif($_REQUEST['report']==1992) 



{echo $str;



$t_date2 = date('Y-m-d',strtotime($t_date . "+1 days"));



$begin = new DateTime($f_date);



$end = new DateTime($t_date2);







$interval = DateInterval::createFromDateString('1 day');



$period = new DatePeriod($begin, $interval, $end);







$sql = "select sum(c.total_amt) as total_amt,c.do_date from sale_do_details c,dealer_info d where c.do_date between '".$f_date."' and '".$t_date."' and c.dealer_code=d.dealer_code and d.dealer_type='Distributor' and d.product_group='A' and c.total_amt>0 group by c.do_date";



$query = mysql_query($sql);



while($data=mysql_fetch_object($query)){



${'A'.$data->do_date} = $data->total_amt;



}



$sql = "select sum(c.total_amt) as total_amt,c.do_date from sale_do_details c,dealer_info d where c.do_date between '".$f_date."' and '".$t_date."' and c.dealer_code=d.dealer_code and d.dealer_type='Distributor' and d.product_group='B' and c.total_amt>0 group by c.do_date";



$query = mysql_query($sql);



while($data=mysql_fetch_object($query)){



${'B'.$data->do_date} = $data->total_amt;



}



$sql = "select sum(c.total_amt) as total_amt,c.do_date from sale_do_details c,dealer_info d where c.do_date between '".$f_date."' and '".$t_date."' and c.dealer_code=d.dealer_code and d.dealer_type='Distributor' and d.product_group='C' and c.total_amt>0 group by c.do_date";



$query = mysql_query($sql);



while($data=mysql_fetch_object($query)){



${'C'.$data->do_date} = $data->total_amt;



}



$sql = "select sum(c.total_amt) as total_amt,c.do_date from sale_do_details c,dealer_info d where c.do_date between '".$f_date."' and '".$t_date."' and c.dealer_code=d.dealer_code and d.dealer_type='Distributor' and d.product_group='D' and c.total_amt>0 group by c.do_date";



$query = mysql_query($sql);



while($data=mysql_fetch_object($query)){${'D'.$data->do_date} = $data->total_amt;}



$sql = "select sum(c.total_amt) as total_amt,c.do_date from sale_do_details c,dealer_info d where c.do_date between '".$f_date."' and '".$t_date."' and c.dealer_code=d.dealer_code and d.dealer_type!='Distributor' and c.total_amt>0 group by c.do_date";



$query = mysql_query($sql);



while($data=mysql_fetch_object($query)){${'X'.$data->do_date} = $data->total_amt;}



?>



<table width="100%" border="0" cellspacing="0" cellpadding="0" id="ExportTable">



  <tr>



    <td bgcolor="#333333"><span class="style3">S/L</span></td>



    <td bgcolor="#333333"><span class="style3">Date</span></td>



    <td bgcolor="#333333"><span class="style3">Group-A</span></td>



    <td bgcolor="#333333"><span class="style3">Group-B</span></td>



    <td bgcolor="#333333"><span class="style3">Group-C</span></td>



    <td bgcolor="#333333"><span class="style3">Group-D</span></td>



    <td width="1" bgcolor="#333333"><div align="right"><strong><span class="style5">Total DO<br />



        (A+B+C+D)</span></strong></div></td>



    <td width="1" bgcolor="#333333"><span class="style3">Mordern Trade</span></td>



    <td width="1" bgcolor="#333333"><span class="style3">ALL DO</span></td>



  </tr>



  <? foreach ( $period as $dt ){ $today_date = $dt->format("Y-m-d");



$day_total = ${'A'.$today_date} + ${'B'.$today_date} + ${'C'.$today_date} + ${'D'.$today_date};



$do_all = ${'A'.$today_date} + ${'B'.$today_date} + ${'C'.$today_date} + ${'D'.$today_date} + ${'X'.$today_date};



$do_total = $do_total + $do_all;



$mon_total = $mon_total + ${'A'.$today_date} + ${'B'.$today_date} + ${'C'.$today_date} + ${'D'.$today_date};



$A_total = $A_total + ${'A'.$today_date};



$B_total = $B_total + ${'B'.$today_date};



$C_total = $C_total + ${'C'.$today_date};



$D_total = $D_total + ${'D'.$today_date};



$X_total = $X_total + ${'X'.$today_date};



?>



  <tr bgcolor="#<?=(($i%2)==0)?'fff':'EBEBEB';?>">



    <td><?=++$j?></td>



    <td><?=$today_date;?></td>



    <td><div align="right">



        <?=number_format(${'A'.$today_date},2);?>



    </div></td>



    <td><div align="right">



        <?=number_format(${'B'.$today_date},2);?>



    </div></td>



    <td><div align="right">



        <?=number_format(${'C'.$today_date},2);?>



    </div></td>



    <td><div align="right">



        <?=number_format(${'D'.$today_date},2);?>



    </div></td>



    <td bgcolor="#FFFF99"><div align="right">



        <?=number_format($day_total,2);?>



    </div></td>



    <td><div align="right">



        <?=number_format(${'X'.$today_date},2);?>



    </div></td>



    <td bgcolor="#FFFF99"><div align="right">



        <?=number_format($do_all,2);?>



    </div></td>



  </tr>



  <? }?>



  <tr bgcolor="#<? echo (($i%2)==0)?'fff':'EBEBEB';?>">



    <td>&nbsp;</td>



    <td>&nbsp;</td>



    <td><div align="right">



        <?=number_format($A_total,2);?>



      </div></td>



    <td><div align="right">



        <?=number_format($B_total,2);?>



      </div></td>



    <td><div align="right">



        <?=number_format($C_total,2);?>



      </div></td>



    <td><div align="right">



        <?=number_format($D_total,2);?>



      </div></td>



    <td bgcolor="#FFFF99"><div align="right">



        <?=number_format($mon_total,2);?>



      </div></td>



    <td><div align="right">



        <?=number_format($X_total,2);?>



      </div></td>



    <td bgcolor="#FFFF99"><div align="right">



        <?=number_format($do_total,2);?>



      </div></td>



  </tr>



</table>



<?
}
elseif(isset($sql)&&$sql!='') {echo report_create($sql,1,$str);}
?>
</div>

</body>
</html>



