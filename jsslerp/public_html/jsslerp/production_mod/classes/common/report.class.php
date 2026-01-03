<?php

function link_report($sql,$link=''){

	if($sql==NULL) return NULL;

		$str.='
		<table id="grp" cellspacing="0" cellpadding="0" width="100%">';
		$str .='<tr>';
		$res=mysql_query($sql);
		$cols = mysql_num_fields($res);
		for($i=1;$i<$cols;$i++)
			{
				$name = mysql_field_name($res,$i);
				$str .='<th>'.ucwords(str_replace('_', ' ',$name)).'</th>';
			}
		$str .='</tr>';
		$c=0;
		while($row=mysql_fetch_array($res))
			{ if($link!='') $link= ' onclick="custom('.$row[0].');"';
				$c++;
				if($c%2==0)	$class=' class="alt"'; else $class=''; 
				
				$str .='<tr'.$class.$link.'>';
				for($i=1;$i<$cols;$i++) {$str .='<td>'.$row[$i]."</td>";}
				$str .='</tr>';
			}
	$str .='</table>';
	return $str;

}


function link_report_add($sql,$link=''){

	if($sql==NULL) return NULL;
		$str.='
		<table id="grp" cellspacing="0" cellpadding="0" width="100%">';
		$str .='<tr>';
		$res=mysql_query($sql);
		$cols = mysql_num_fields($res);
		for($i=1;$i<$cols;$i++)
			{
				$name = mysql_field_name($res,$i);
				$str .='<th>'.ucwords(str_replace('_', ' ',$name)).'</th>';
			}
		$str .='</tr>';
		$c=0;
		while($row=mysql_fetch_array($res))
			{ 
			$total=$total+$row[7];
			$total_qty=$total_qty+$row[5];
			if($link!='') $link= ' onclick="custom('.$row[0].');"';
				$c++;
				if($c%2==0)	$class=' class="alt"'; else $class=''; 
				$str .='<tr'.$class.$link.'>';
				for($i=1;$i<$cols;$i++) {$str .='<td>&nbsp;'.$row[$i]."</td>"; }
				$str .='</tr>';
			}
	$str .='<tr'.$class.$link.'>';
	$str .="<td colspan='".($cols-5)."'><span style='text-align:right;'> Total: </span></td>";
	$str .="<td colspan='2'>".$total_qty."</td>";
	$str .="<td colspan='2'>".$total."</td>";
	$str .='</tr>';
	$str .='</table>';
	return $str;

}



function link_report_add_del($sql,$link=''){

	if($sql==NULL) return NULL;
		$str.='
		<table id="grp" cellspacing="0" cellpadding="0" width="100%">';
		$str .='<tr>';
		$res=mysql_query($sql);
		$cols = mysql_num_fields($res);
		for($i=1;$i<$cols;$i++)
			{
				$name = mysql_field_name($res,$i);
				$str .='<th>'.ucwords(str_replace('_', ' ',$name)).'</th>';
			}
		$str .='</tr>';
		$c=0;
		while($row=mysql_fetch_array($res))
			{ 
			$total=$total+$row[7];
			$total_qty=$total_qty+$row[5];
			if($link!='') $link= ' onclick="custom('.$row[0].');"';
				$c++;
				if($c%2==0)	$class=' class="alt"'; else $class=''; 
				$str .='<tr'.$class.$link.'>';
				for($i=1;$i<($cols-1);$i++) {$str .='<td>&nbsp;'.$row[$i]."</td>"; }
				$str .='<td><a href="?del='.$row[0].'">&nbsp;X&nbsp;</a></td>';
				$str .='</tr>';
			}
	$str .='<tr'.$class.$link.'>';
	$str .="<td colspan='".($cols-5)."'><span style='text-align:right;'> Total: </span></td>";
	$str .="<td colspan='2'>".$total_qty."</td>";
	$str .="<td colspan='2'>".$total."</td>";
	$str .='</tr>';
	$str .='</table>';
	return $str;

}


function link_report_del($sql,$link=''){

	if($sql==NULL) return NULL;
		$str.='
		<table id="grp" cellspacing="0" cellpadding="0" width="100%">';
		$str .='<tr>';
		$res=mysql_query($sql);
		$cols = mysql_num_fields($res);
		for($i=1;$i<$cols;$i++)
			{
				$name = mysql_field_name($res,$i);
				$str .='<th>'.ucwords(str_replace('_', ' ',$name)).'</th>';
			}
		$str .='</tr>';
		$c=0;
		while($row=mysql_fetch_array($res))
			{ 
			if($link!='') $link= ' onclick="custom('.$row[0].');"';
				$c++;
				if($c%2==0)	$class=' class="alt"'; else $class=''; 
				$str .='<tr'.$class.$link.'>';
				for($i=1;$i<($cols-1);$i++) {$str .='<td>&nbsp;'.$row[$i]."</td>"; }
				$str .='<td><a onclick="if(!confirm(\'Are You Sure Execute this?\')){return false;}" href="?del='.$row[0].'">&nbsp;X&nbsp;</a></td>';
				$str .='</tr>';
			}
	$str .='</table>';
	return $str;

}

function link_report_add_report($sql,$link=''){

	if($sql==NULL) return NULL;
		$str.='
		<table id="grp" cellspacing="0" cellpadding="0" width="100%">';
		$str .='<tr>';
		$res=mysql_query($sql);
		$cols = mysql_num_fields($res);
		for($i=1;$i<$cols;$i++)
			{
				$name = mysql_field_name($res,$i);
				$str .='<th>'.ucwords(str_replace('_', ' ',$name)).'</th>';
			}
		$str .='</tr>';
		$c=0;
		while($row=mysql_fetch_array($res))
			{ 
			$total=$total+$row[7];
			$total_qty=$total_qty+$row[6];
			if($link!='') $link= ' onclick="custom('.$row[0].');"';
				$c++;
				if($c%2==0)	$class=' class="alt"'; else $class=''; 
				$str .='<tr'.$class.$link.'>';
				for($i=1;$i<($cols-1);$i++) {$str .='<td>&nbsp;'.$row[$i]."</td>"; }
				$str .='<td><a href="../report/invoice_print_new.php?v_no='.$row[0].'" target="_blank">&nbsp;Click&nbsp;</a></td>';
				$str .='</tr>';
			}
	$str .='<tr'.$class.$link.'>';
	$str .="<td colspan='".($cols-3)."'><span style='text-align:right;'> Total: </span></td>";
	$str .="<td colspan='2'>".$total_qty."</td>";
	$str .='</tr>';
	$str .='</table>';
	return $str;

}

function link_report_single($sql,$link=''){

	if($sql==NULL) return NULL;
		$str.='
		<table id="grp" cellspacing="0" cellpadding="0" width="100%">';
		$str .='<tr>';
		$res=mysql_query($sql);
		$cols = mysql_num_fields($res);
		for($i=1;$i<$cols;$i++)
			{
				$name = mysql_field_name($res,$i);
				$str .='<th>'.ucwords(str_replace('_', ' ',$name)).'</th>';
			}
		$str .='</tr>';
		$c=0;
		while($row=mysql_fetch_array($res))
			{ 
			$total=$total+$row[7];
			$total_qty=$total_qty+$row[5];
			if($link!='') $link= ' onclick="custom('.$row[0].');"';
				$c++;
				if($c%2==0)	$class=' class="alt"'; else $class=''; 
				$str .='<tr'.$class.$link.'>';
				for($i=1;$i<$cols;$i++) {$str .='<td>&nbsp;'.$row[$i]."</td>"; }
				$str .='</tr>';
			}
	$str .='<tr'.$class.$link.'>';
	$str .="<td colspan='".($cols-4)."'><span style='text-align:right;'> Total: </span></td>";
	$str .="<td colspan='2'>".$total_qty."</td>";
	$str .="<td colspan='2'>".$total."</td>";
	$str .='</tr>';
	$str .='</table>';
	return $str;

}


function ajax_report($sql,$url,$div){

	if($sql==NULL) return NULL;

		$str.='
		<table id="grp" cellspacing="0" cellpadding="0" width="100%">';
		$str .='<tr>';
		$res=mysql_query($sql);
		$cols = mysql_num_fields($res);
		for($i=1;$i<$cols;$i++)
			{
				$name = mysql_field_name($res,$i);
				$str .='<th>'.ucwords(str_replace('_', ' ',$name)).'</th>';
			}
		$str .='</tr>';
		$c=0;
		while($row=mysql_fetch_array($res))
			{
				$c++;
				if($c%2==0)	$class=' class="alt"'; else $class=''; 
				
				$str .='<tr'.$class.' onclick="getData(\''.$url.'\',\''.$div.'\','.$row[0].');">';
				for($i=1;$i<$cols;$i++) {$str .='<td>'.$row[$i]."</td>";}
				$str .='</tr>';
			}
	$str .='</table>';
	return $str;

}
function report_create($sql,$s='',$head=''){
if($s!='') $sl=$s;
	if($sql==NULL) return NULL;
		$res	 = mysql_query($sql);
		$cols 	 = mysql_num_fields($res);
		if(isset($sl)) $total_cols=$cols+1; else $total_cols=$cols;
		$str	.= '<table width="100%" border="0" cellpadding="2" cellspacing="0">';
		$str 	.= '<thead>';
		$str 	.= '<tr><td colspan="'.$total_cols.'" style="border:0px;">';
		$str 	.= $head;
		$str 	.= '</td></tr>';
		$str 	.= '<tr>';
		if(isset($sl))$str .='<th>S/L</th>';
		for($i=0;$i<$cols;$i++)
			{
				$name = mysql_field_name($res,$i);
				$str .='<th>'.ucwords(str_replace('_', ' ',$name)).'</th>';
			}
		$str .='</tr></thead><tbody>';

		while($row=mysql_fetch_array($res))
			{				
				$str .='<tr>';
				if(isset($sl)){$str .='<td>'.$sl.'</td>';$sl++;}
				for($i=0;$i<$cols;$i++) 
{
if($show[$i]!=1&&(is_numeric($row[$i])&&strpos($row[$i],'.')||$row[$i]=='')){$sum[$i]=$sum[$i]+$row[$i]; $str .='<td style="text-align:right">'.@number_format($row[$i],2).'</td>';}
else {$show[$i]=1; $str .='<td>'.$row[$i].'</td>';}}
				$str .='</tr>';
			}
		$str .='<tr class="footer">';
		if(isset($sl))$str .='<td>&nbsp;</td>';
		for($i=0;$i<$cols;$i++)
			{
				if($show[$i]!=1&&$sum[$i]!=0)$str .='<td style="text-align:right">'.number_format($sum[$i],2).'</td>';
				else $str .='<td>&nbsp;</td>';;
			}
		$str .='</tr></tbody>';
	$str .='</table>';
	return $str;

}
?>