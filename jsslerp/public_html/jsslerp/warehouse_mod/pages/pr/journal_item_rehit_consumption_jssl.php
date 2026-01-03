<?
session_start();
require_once "../../../assets/support/inc.all.php";
$page_for = 'Consumption';
//
// echo   $ch_sql='select * from warehouse_other_issue where issue_type="Consumption" and oi_no=3';

	$sql="select * from item_info where 1 and item_id=400010018";
	$query=mysql_query($sql);
	while($row=mysql_fetch_object($query))
 	{
 echo   $ch_sql = '
  SELECT *
    FROM journal_item
   WHERE ji_date BETWEEN "2023-01-01" AND "2025-09-01"
     AND item_id = "'.$row->item_id.'"
     AND tr_from IN ("Opening","Purchase","Consumption")
order by ji_date asc';
 
$ch_query=mysql_query($ch_sql);
while($data=mysql_fetch_object($ch_query)){
	
	$item_price = find_a_field_sql(
    'select (sum((item_in*item_price)-(item_ex*item_price))/sum(item_in-item_ex)) as avg_rate 
     from journal_item 
     where tr_from in ("Purchase","Opening") 
       and item_id="'.$data->item_id.'" 
       and ji_date <= "'.$data->ji_date.'"'
);

	
	if($data->tr_from=='Purchase' || $data->tr_from=='Opening')
	{
	journal_item_control_monir2($data->item_id, $data->warehouse_id,$data->ji_date,$data->item_in,0,$data->tr_from,$data->id,$data->item_price,'',$data->sr_no,'','','','','',$data->id);
	}
	else
	{
	journal_item_control_monir2($data->item_id, $data->warehouse_id,$data->ji_date,0,$data->item_ex,$data->tr_from,$data->id,$item_price,'',$data->sr_no,'','','','','',$data->id);
	
	}
}

}
 

 
?>