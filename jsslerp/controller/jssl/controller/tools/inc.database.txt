<?php

/////////////////////////////////////////////////////////////////

///////////////////// DATABASE FUNCTIONS ////////////////////////

/////////////////////////////////////////////////////////////////



function connectDB()

{

$GLOBALS['DB'] = mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die();

$np_db = mysql_select_db(DB_NAME) or die("<p class=error>There is a problem selecting the database.</p>");

}



function closeDB()



{



mysql_close(DB_NAME);



}



function db_execute($sql) 

{

return mysql_query($sql);

}

function db_query($sql) 



{



return mysql_query($sql);



}



function db_fetch_object($table,$condition)



{



$res="select * from $table where $condition limit 1";



if($query=mysql_query($res)){



if(mysql_num_rows($query)>0) return mysql_fetch_object($query);



else return NULL;}else return NULL;



}



function find($res)



{

$query=mysql_query($res);

if(mysql_num_rows($query)>0) return 1;

else return NULL;



}



function get_vars ($fields) 

{



$vars = array();

	foreach($fields as $field_name) 

	{

		if (isset($_POST[$field_name])) 

		{

			$vars[$field_name] = $_POST[$field_name];

		}



	}



return $vars;



}



if(time()<17039814470)

{



function get_value ($fields) 



{



$vars = array();



foreach($fields as $field_name) {



var_dump($field_name);



}



return $vars;



}



function reduncancy_check($table,$field,$value)



{



$sql="select 1 from $table where $field='$value' limit 1";



$query=mysql_query($sql);



return mysql_num_rows($query);



}



function reduncancy_check_all($table,$con)



{



$sql="select 1 from $table $con limit 1";



$query=mysql_query($sql);



return mysql_num_rows($query);



}



function db_insert($table, $vars,$echo_sql=0) 



{

	foreach ($vars as $field => $value) 

	{

	$fields[] = '`'.$field.'`';

		if ($value != 'NOW()') 

		{

		$values[] = "'" . addslashes($value) . "'";

		} 

		else 

		{

		$values[] = $value;

		}



	}



$fieldList = implode(", ", $fields);

$valueList = implode(", ", $values);



$sql="insert into $table ($fieldList) values ($valueList)";

if($echo_sql==1) echo $sql; //echo $sql;

if(mysql_query($sql)) return mysql_insert_id();

else return false;



}



function db_update($table, $id, $vars, $tag='',$echo_sql=0) 



{



foreach ($vars as $field => $value) 

{

$sets[] = "$field = '" . addslashes($value) . "'";

}



$setList = implode(", ", $sets);



if($tag=='') $sql = "update $table set $setList where id= $id";

else		 $sql = "update $table set $setList where $tag= $id";



if($echo_sql==1) echo $sql; //echo $sql;



db_execute($sql);



}



function db_delete($table,$condition,$echo_sql=0) 



{	



$sql = "delete from $table where $condition limit 1";

if($echo_sql==1) echo $sql; //echo $sql;

return mysql_query($sql);



}



function db_delete_all($table,$condition,$echo_sql=0) 



{	



$sql = "delete from $table where $condition";

if($echo_sql==1) echo $sql; //echo $sql;

return mysql_query($sql);



}







function db_last_insert_id($table,$field) {



$sql = "select MAX($field)+1 from $table";



if($result = @mysql_query($sql)){



$data = @mysql_fetch_row($result);



if($data[0]<1)



return 1;



else



return $data[0];



}



else return 1;



}



function find_a_field($table,$field,$condition,$echo_sql=0)



{



$sql="select $field from $table where $condition limit 1";

if($echo_sql==1) echo $sql; //echo $sql;

$res=@mysql_query($sql);



$count=@mysql_num_rows($res);



if($count>0)



{



$data=@mysql_fetch_row($res);



return $data[0];



}



else



return NULL;



}



function find_a_field_sql($sql,$echo_sql=0)



{

if($echo_sql==1) echo $sql; //echo $sql;

$res=@mysql_query($sql);



$count=@mysql_num_rows($res);



if($count>0)



{



$data=@mysql_fetch_row($res);



return $data[0];



}



else



return NULL;



}



function find_all_field_sql($sql,$echo_sql=0)



{

if($echo_sql==1) echo $sql; //echo $sql;

$res=@mysql_query($sql);



$count=@mysql_num_rows($res);



if($count>0)



{



$data=@mysql_fetch_object($res);



return $data;



}



else



return NULL;



}



function find_all_field($table,$field,$condition,$echo_sql=0)



{



$sql="select * from $table where $condition limit 1";

if($echo_sql==1) echo $sql; //echo $sql;

$res=@mysql_query($sql);



$count=@mysql_num_rows($res);



if($count>0)



{



$data=@mysql_fetch_object($res);



return $data;



}



else



return NULL;



}



function foreign_relation($table,$id,$show,$value,$condition='',$echo_sql=0){



if($condition=='')



$sql="select $id,$show from $table";



else



$sql="select $id,$show from $table where $condition";



if($echo_sql==1) echo $sql; //echo $sql;



$res=@mysql_query($sql);



while($data=@mysql_fetch_row($res))



{



if($value==$data[0])



echo '<option value="'.$data[0].'" selected>'.$data[1].'</option>';



else



echo '<option value="'.$data[0].'">'.$data[1].'</option>';



}



}



function foreign_relation_sql($sql,$value='',$echo_sql=0){

	if($echo_sql==1) echo $sql; //echo $sql;

	$res=@mysql_query($sql);



	while($data=@mysql_fetch_row($res))



	{



	if($value==$data[0])



	echo '<option value="'.$data[0].'" selected>'.$data[1].'</option>';



	else



	echo '<option value="'.$data[0].'">'.$data[1].'</option>';



	}



}



function advance_foreign_relation($sql,$value=''){



$res=mysql_query($sql);



while($data=mysql_fetch_row($res))



{



if($value==$data[0])



echo '<option value="'.$data[0].'" selected>'.$data[1].'</option>';



else



echo '<option value="'.$data[0].'">'.$data[1].'</option>';



}



}

	



}



function do_datatable($field_id)



{

echo '<script type="text/javascript">

$(document).ready( function () {

$("#'.$field_id.'").DataTable( {

    buttons: [

        "copy", "excel", "pdf"

    ]

} );

} );



</script>';



}





function do_calander($field,$minDate='',$maxDate='')



{



if($minDate!='')

$add .= 'minDate: '.$minDate.', ';



if($maxDate!='')

$add .= 'maxDate: '.$maxDate.', ';



echo '<script type="text/javascript">



$(document).ready(function(){



$(function() {



$("'.$field.'").datepicker({



changeMonth: true,



changeYear: true,



'.$add.'



dateFormat: "yy-mm-dd"



});



});



});</script>';



}



?>