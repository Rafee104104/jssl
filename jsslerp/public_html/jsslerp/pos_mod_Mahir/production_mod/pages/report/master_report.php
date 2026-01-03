<?



session_start();



//require "../../../engine/tools/check.php";

//

//require "../../../engine/configure/db_connect.php";

//

//require "../../../engine/tools/my.php";

//

//require "../../../engine/tools/report.class.php";



require_once "../../../assets/support/inc.all.php";







date_default_timezone_set('Asia/Dhaka');







if(isset($_POST['submit'])&&isset($_POST['report'])&&$_POST['report']>0)



{



	if((strlen($_POST['t_date'])==10)&&(strlen($_POST['f_date'])==10))



	{



		$t_date=$_POST['t_date'];



		$f_date=$_POST['f_date'];



	}



	



if($_POST['product_group']!='') $product_group=$_POST['product_group'];



if($_POST['item_brand']!='') 	$item_brand=$_POST['item_brand'];



if($_POST['item_id']>0) 		$item_id=$_POST['item_id'];



if($_POST['dealer_code']>0) 	$dealer_code=$_POST['dealer_code'];

if($_POST['item_sub_group']>0) 	$sub_group_id=$_POST['item_sub_group'];






if($_POST['status']!='') 		$status=$_POST['status'];



if($_POST['or_no']!='') 		$or_no=$_POST['or_no'];



if($_POST['area_id']!='') 		$area_id=$_POST['area_id'];



if($_POST['zone_id']!='') 		$zone_id=$_POST['zone_id'];



if($_POST['region_id']>0) 		$region_id=$_POST['region_id'];



if($_POST['depot_id']!='') 		$depot_id=$_POST['depot_id'];



if($_POST['dealer_type']!='') 		$dealer_type=$_POST['dealer_type'];

if($_POST['warehouse_id']!='') 		$warehouse_id=$_POST['warehouse_id'];

if($_POST['item_id']!='') 		$item_con=$_POST['item_id'];







if($_POST['receive_type']!='') 		$receive_type=$_POST['receive_type'];







if(isset($receive_type)) 			{$receive_type_con=' and o.receive_type="'.$receive_type.'"';} 











if(isset($item_brand)) 			{$item_brand_con=' and i.brand_category="'.$item_brand.'"';} 



if(isset($dealer_code)) 		{$dealer_con=' and m.vendor_id="'.$dealer_code.'"';} 



if(isset($dealer_type)) 		{$dtype_con=' and d.dealer_type="'.$dealer_type.'"';} 



if(isset($t_date)) 				{$to_date=$t_date; $fr_date=$f_date; $date_con=' and m.or_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



if(isset($product_group)) 		{$pg_con=' and d.product_group="'.$product_group.'"';} 











if(isset($dealer_code)) 		{$dealer_con=' and m.vendor_id='.$dealer_code;} 



//if(isset($item_id))				{$item_con=' and o.item_id='.$item_id;} 



if(isset($depot_id)) 			{$depot_con=' and d.depot="'.$depot_id.'"';} 







switch ($_POST['report']) {







	    case 1000:



		$report="Damage Report Item Wise";





	break;



	



	case 2:



$report="Damage Report Date Wise";







	break;


case 12823:



		$report="Warehouse Item Transection Report";



		if(isset($warehouse_id)) 				{$warehouse_con=' and a.warehouse_id='.$warehouse_id;} 



		if(isset($sub_group_id)) 				{$item_sub_con=' and i.sub_group_id='.$sub_group_id;} 

		

		if(isset($enty_con)) 				{$con=' and a.entry_by='.$enty_con;} 



		if(isset($item_con)) 				{$item_con=' and i.item_id='.$item_con;} 



		



		if(isset($receive_status)){	



			if($receive_status=='All_Purchase')



			{$status_con=' and a.tr_from in ("Purchase","Local Purchase","Import")';}



			else



			{$status_con=' and a.tr_from="'.$receive_status.'"';}



		}



		



		elseif(isset($issue_status)) 		{$status_con=' and a.tr_from="'.$issue_status.'"';} 



		



		if(isset($t_date)) 



		{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.ji_date between \''.$fr_date.'\' and \''.$to_date.'\'';}







		



  $sql='select ji_date,i.item_id,i.finish_goods_code as fg_code,i.item_name,s.sub_group_name as Category,i.pack_size,i.unit_name as unit,a.item_in as `IN`,a.item_ex as `OUT`,a.item_price as rate,((a.item_in+a.item_ex)*a.item_price) as amount, (a.item_in-a.item_ex) as current_stock,a.tr_from as tr_type,sr_no,



(select warehouse_name from warehouse where warehouse_id=a.relevant_warehouse) as warehouse,a.tr_no,a.entry_at,c.fname as User 



		   



from journal_item a, item_info i, user_activity_management c , item_sub_group s 



where c.user_id=a.entry_by and s.sub_group_id=i.sub_group_id and a.item_id=i.item_id 



 '.$date_con.$warehouse_con.$item_con.$status_con.$item_sub_con.$con.' 



order by a.id, a.ji_date';



	break;





		case 3:



		$report="Damage Report Summary";







		break;



}



}



?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml">



<head>



<meta http-equiv="content-type" content="text/html; charset=utf-8" />



<title><?=$report?></title>



<link href="../../css/report.css" type="text/css" rel="stylesheet" />



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



</head>



<body>



<div align="center" id="pr">



<input type="button" value="Print" onclick="hide();window.print();"/>



</div>



<div class="main" style="text-align:center; ">



<?



		$str 	.= '<div class="header" >';



		if(isset($_SESSION['company_name'])) 



		$str 	.= '<h1>'.$_SESSION['company_name'].'</h1>';



		if(isset($report)) 



		$str 	.= '<h2>'.$report.'</h2>';



		if(isset($to_date)) 



		$str 	.= '<h2>Date Interval : '.$fr_date.' To '.$to_date.'</h2>';



		if(isset($product_group)) 



		$str 	.= '<h2>Product Group : '.$product_group.'</h2>';



		



		if(isset($item_brand)) 



		$str 	.= '<h2>Item Brand : '.$item_brand.'</h2>';



		



		if(isset($item_id)) 



		$str 	.= '<h2>Item Name : '.find_a_field('item_info','item_name','item_id='.$item_id).'</h2>';



		



		if(isset($receive_type)) 



		$str 	.= '<h2>Damage Type : '.find_a_field('damage_cause','damage_cause','id='.$receive_type).'</h2>';



		



		if(isset($dealer_type)) 



		$str 	.= '<h2>Dealer Type : '.$dealer_type.'</h2>';



		if(isset($dealer_code)) 



		$str 	.= '<h2>Dealer Name : '.find_a_field('dealer_info','dealer_name_e','dealer_code='.$dealer_code).'</h2>';

		



		$str 	.= '</div>';



		$str 	.= '<div class="left" style="width:100%">';













//Damage Report Summary modify on 13 Nov 2019 by Payer Rony



if($_POST['report']==3){



	

//

//if(isset($receive_type)) 	{$receive_type_con=' and m.receive_type="'.$receive_type.'"';} 

//

//if(isset($dealer_code)) 		{$dealer_con=' and m.vendor_id='.$dealer_code;}

//

//if(isset($t_date)) 				{$to_date=$t_date; $fr_date=$f_date; $date_con=' and m.or_date between \''.$fr_date.'\' and \''.$to_date.'\'';}

//

//if(isset($product_group)) 		{$pg_con=' and d.product_group="'.$product_group.'"';} 

//

//if(isset($item_id)) 		{$item_con=' and o.item_id="'.$item_id.'"';} 

//

//if(isset($dealer_type)) 		{$dtype_con=' and d.dealer_type="'.$dealer_type.'"';}





if($_REQUEST['receive_type'] != '') 			{$receive_type_con=' and m.receive_type="'.$receive_type.'"';} 



if($_REQUEST['dealer_code'] != '') 		{$dealer_con=' and m.vendor_id='.$dealer_code;}



if($_REQUEST['$t_date'] != '') 				{$to_date=$t_date; $fr_date=$f_date; $date_con=' and m.or_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



if($_REQUEST['$product_group']!= '') 		{$pg_con=' and d.product_group="'.$product_group.'"';} 



if($_REQUEST['$item_id']!='') 		{$item_con=' and o.item_id="'.$item_id.'"';} 



if($_REQUEST['$dealer_type']!='') 		{$dtype_con=' and d.dealer_type="'.$dealer_type.'"';}



//concat('<a href="',case 1,'" target="_blank" >',sum(c.qty) as total_qty,'</a>')



  $sql="select m.vendor_id, concat(d.dealer_code,'- ',d.dealer_name_e)  as party_name,sum(c.qty) as total_qty,sum(c.amount) as amount

 





from dealer_info d  , warehouse w, item_info i, sales_damage_receive_detail c,sales_damage_receive_master m







where i.item_id=c.item_id and c.vendor_id=d.dealer_code and m.or_no=c.or_no and m.vendor_id=c.vendor_id and m.status='UNCHECKED' and c.warehouse_id=w.warehouse_id ".$date_con.$item_con.$pg_con.$item_brand_con.$dtype_con.$dealer_con." group by c.vendor_id";







$query = mysql_query($sql);



	







echo '<table width="100%" cellspacing="0" cellpadding="2" border="0">



	

<thead>



	

<tr>







<td style="border:0px;text-align:center;" colspan="20" >'.$str.'</td>



	

</tr>





<tr>





<th>S/L</th>





<th style=" text-align:center;" >Dealer Name</th>



<th style=" text-align:center;">Toral Quantity</th>

	

<th style=" text-align:center;">Total Amount</th>





</tr>



	







</thead>



	







<tbody>';



	







while($data=mysql_fetch_object($query)){$s++;







?>



	







<tr>



	







<td><?=$s?></td>

<?php /*?>&item_id=<?=$data->item_id;?>&dealer_type=<?=$_REQUEST['dealer_type']?>&brand_category=<?=$_REQUEST['item_brand']?><?php */?>

<td>

<a href="master_report.php?report=1000&dealer_code=<?=$data->vendor_id;?>&f_date=<?=$_POST['f_date']?>&t_date=<?=$_POST['t_date']?>" target="_blank"><?=($data->party_name)?></a>

</td>



	

<td style="text-align:center"><?=$data->total_qty?></td>



<td style="text-align:center"><?=$data->amount?></td>





</tr>



	







<?



	







$tot_qty = $tot_qty+$data->total_qty;



	

$tot_amt = $tot_amt+$data->amount;









	







}



	







echo '<tr class="footer">



	





<td style="text-align:right">&nbsp;</td>



	

<td style="text-align:right">&nbsp;</td>







<td style="text-align:center">'.number_format($tot_qty,2).'</td>



	

<td style="text-align:center">'.number_format($tot_amt,2).'</td>



	







</tr>



	







</tbody>



	







</table>';







}







else if($_REQUEST['report']==2)



{





if($_REQUEST['receive_type'] != '') 			{$receive_type_con=' and m.receive_type="'.$_REQUEST['receive_type'].'"';} 



if($_REQUEST['dealer_code'] != '') 		{$dealer_con=' and m.vendor_id='.$_REQUEST['dealer_code'];}



if($_REQUEST['t_date'] != '') 				{$to_date=$_REQUEST['t_date']; $fr_date=$_REQUEST['f_date']; $date_con=' and m.or_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



if($_REQUEST['product_group']!= '') 		{$pg_con=' and d.product_group="'.$_REQUEST['product_group'].'"';} 



if($_REQUEST['item_id']!='') 		{$item_con=' and o.item_id="'.$_REQUEST['item_id'].'"';} 



if($_REQUEST['dealer_type']!='') 		{$dtype_con=' and d.dealer_type="'.$_REQUEST['dealer_type'].'"';}



//concat('<a href="',case 1,'" target="_blank" >',sum(c.qty) as total_qty,'</a>')



 $sql = "select distinct concat(i.finish_goods_code,'- ',item_name) as item_name,m.vendor_id,m.or_no,m.or_date,i.brand_category,concat(d.dealer_code,'- ',d.dealer_name_e)  as party_name,



o.qty as total_qty, 





o.amount as amount



from 



sales_damage_receive_master m,sales_damage_receive_detail o, item_info i,dealer_info d, warehouse w



where m.or_no=o.or_no and m.vendor_id=d.dealer_code and i.item_id=o.item_id and m.status='UNCHECKED' and o.warehouse_id=w.warehouse_id   ".$date_con.$item_con.$item_brand_con.$depot_con.$receive_type_con.$dealer_con.' order by i.finish_goods_code,m.or_no,m.or_date';







$query = mysql_query($sql);



	







echo '<table width="100%" cellspacing="0" cellpadding="2" border="0">



	

<thead>



	

<tr>







<td style="border:0px;text-align:center;" colspan="20" >'.$str.'</td>



	

</tr>





<tr>





<th>S/L</th>



<th style=" text-align:center;">Item Name</th>

<th style=" text-align:center;">Item Brand</th>

<th style=" text-align:center;" >DR NO</th>

<th style=" text-align:center;" >DR DATE</th>

<th style=" text-align:center;">Dealer Name</th>



<th style=" text-align:center;">Toral Quantity</th>

	

<th style=" text-align:center;">Total Amount</th>





</tr>



	







</thead>



	







<tbody>';



	







while($data=mysql_fetch_object($query)){$s++;







?>



	







<tr>





<td><?=$s?></td>



<td><?=($data->item_name)?></a></td>



<td style="text-align:center"><?=($data->brand_category)?></td>



<td style="text-align:center"><?=($data->or_no)?></td>



<td style="text-align:center"><?=($data->or_date)?></td>



<td><?=($data->party_name)?></td>



	

<td style="text-align:center"><?=$data->total_qty?></td>



<td style="text-align:center"><?=$data->amount?></td>





</tr>



	







<?



$tot_qty = $tot_qty+$data->total_qty;



	

$tot_amt = $tot_amt+$data->amount;



}



	







echo '<tr class="footer">



	





<td style="text-align:right">&nbsp;</td>



	

<td style="text-align:right">&nbsp;</td>



<td style="text-align:right">&nbsp;</td>



	

<td style="text-align:right">&nbsp;</td>



<td style="text-align:right">&nbsp;</td>



	

<td style="text-align:right">&nbsp;</td>







<td style="text-align:center">'.number_format($tot_qty,2).'</td>



	

<td style="text-align:center">'.number_format($tot_amt,2).'</td>



	







</tr>



	







</tbody>



	







</table>';





}







else if($_REQUEST['report']==1000){





if($_REQUEST['receive_type'] != '') 			{$receive_type_con=' and m.receive_type="'.$_REQUEST['receive_type'].'"';} 



if($_REQUEST['dealer_code'] != '') 		{$dealer_con=' and m.vendor_id='.$_REQUEST['dealer_code'];}



if($_REQUEST['t_date']!= '') 				{$to_date=$_REQUEST['t_date']; $fr_date=$_REQUEST['f_date']; $date_con=' and m.or_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



if($_REQUEST['product_group']!= '') 		{$pg_con=' and d.product_group="'.$_REQUEST['product_group'].'"';} 



if($_REQUEST['item_id']!='') 		{$item_con=' and o.item_id="'.$_REQUEST['item_id'].'"';} 



if($_REQUEST['dealer_type']!='') 		{$dtype_con=' and d.dealer_type="'.$_REQUEST['dealer_type'].'"';}



//concat('<a href="',case 1,'" target="_blank" >',sum(c.qty) as total_qty,'</a>')



 $sql = "select concat(i.finish_goods_code,'- ',item_name) as item_name,m.vendor_id,i.brand_category,concat(d.dealer_code,'- ',d.dealer_name_e)  as party_name,



sum(o.qty) as total_qty, 



sum(o.qty*i.d_price) as Cost_Price,



sum(o.amount)as amount



from 



sales_damage_receive_master m,sales_damage_receive_detail o, item_info i,dealer_info d, warehouse w



where m.or_no=o.or_no and m.vendor_id=d.dealer_code and i.item_id=o.item_id and m.status='UNCHECKED' and o.warehouse_id=w.warehouse_id   ".$date_con.$item_con.$item_brand_con.$depot_con.$receive_type_con.$dealer_con.$dtype_con.' group by i.finish_goods_code';







$query = mysql_query($sql);



	







echo '<table width="100%" cellspacing="0" cellpadding="2" border="0">



	

<thead>



	

<tr>







<td style="border:0px;text-align:center;" colspan="20" >'.$str.'</td>



	

</tr>





<tr>





<th>S/L</th>



<th style=" text-align:center;">Item Name</th>

<th style=" text-align:center;">Item Brand</th>



<th style=" text-align:center;">Dealer Name</th>



<th style=" text-align:center;">Toral Quantity</th>

	

<th style=" text-align:center;">Total Amount</th>





</tr>



	







</thead>



	







<tbody>';



	







while($data=mysql_fetch_object($query)){$s++;







?>



	







<tr>



<td><?=$s?></td>



<td><a href="master_report.php?report=2&dealer_code=<?=$data->vendor_id;?>&f_date=<?=$_REQUEST['f_date']?>&t_date=<?=$_REQUEST['t_date']?>&item_id=<?=$_REQUEST['item_id']?>&dealer_type=<?=$_REQUEST['dealer_type']?>&brand_category=<?=$_REQUEST['item_brand']?>" target="_blank"><?=($data->item_name)?></a></td>



<td><?=($data->brand_category)?></td>



<td><?=($data->party_name)?></td>



	

<td style="text-align:center"><?=$data->total_qty?></td>



<td style="text-align:center"><?=$data->amount?></td>





</tr>



	







<?



	







$tot_qty = $tot_qty+$data->total_qty;



	

$tot_amt = $tot_amt+$data->amount;









	







}



	







echo '<tr class="footer">



	





<td style="text-align:right">&nbsp;</td>



	

<td style="text-align:right">&nbsp;</td>



<td style="text-align:right">&nbsp;</td>



	

<td style="text-align:right">&nbsp;</td>







<td style="text-align:center">'.number_format($tot_qty,2).'</td>



	

<td style="text-align:center">'.number_format($tot_amt,2).'</td>



	







</tr>



	







</tbody>



	







</table>';











}









else if($_POST['report']==211111) 



{















$sql2 	= "select distinct o.or_no, d.dealer_code,d.dealer_name_e,w.warehouse_name,m.or_date,d.address_e,d.mobile_no,d.product_group from 



sales_damage_receive_master m,sales_damage_receive_detail o, item_info i,dealer_info d , warehouse w



where m.or_no=o.or_no and i.item_id=o.item_id and m.vendor_id=d.dealer_code  and w.warehouse_id=d.depot ".$receive_type_con.$date_con.$item_con.$depot_con.$dealer_con;



$query2 = mysql_query($sql2);







while($data=mysql_fetch_object($query2)){



echo '<div style="position:relative;display:block; width:100%; page-break-after:always; page-break-inside:avoid">';



	$dealer_code = $data->dealer_code;



	$dealer_name = $data->dealer_name_e;



	$warehouse_name = $data->warehouse_name;



	$or_date = $data->or_date;



	$or_no = $data->or_no;



		if($dealer_code>0) 



{



$str 	.= '<p style="width:100%;text-align:center;">Dealer Name: '.$dealer_name.' - '.$dealer_code.'('.$data->product_group.')</p>';



$str 	.= '<p style="width:100%,text-align:center;">DI NO: '.$or_no.' 



&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Depot:'.$warehouse_name.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:'.$or_date.'</p>



<p style="width:100%,text-align:center;">Destination:'.$data->address_e.'('.$data->mobile_no.')</p>';







$dealer_con = ' and m.vendor_id='.$dealer_code;



$do_con = ' and m.or_no='.$or_no;



$item_con = ' and o.item_con='.$item_con;







$sql = "select concat(i.finish_goods_code,'- ',item_name) as item_name,dd.damage_cause,o.qty as pcs,(i.d_price*o.qty) as Cost_price,o.amount as Dealer_Price from 



sales_damage_receive_master m,sales_damage_receive_detail o, item_info i,dealer_info d , warehouse w, damage_cause dd



where o.receive_type=dd.id and m.or_no=o.or_no and i.item_id=o.item_id and m.vendor_id=d.dealer_code  ".$receive_type_con.$date_con.$item_con.$depot_con.$do_con." order by m.or_date,o.item_id asc";



}







echo report_create($sql,1,$str);



		$str = '';



		echo '</div>';



}



}



elseif(isset($sql)&&$sql!='') echo report_create($sql,1,$str);



?></div>



</body>



</html>