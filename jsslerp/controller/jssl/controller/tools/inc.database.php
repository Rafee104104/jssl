<?php

/////////////////////////////////////////////////////////////////
///////////////////// DATABASE FUNCTIONS ////////////////////////
/////////////////////////////////////////////////////////////////

function connectDB()
{
    $GLOBALS['DB'] = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

    if(!$GLOBALS['DB']){
        die("Database Connection Failed: " . mysqli_connect_error());
    }
}

function closeDB()
{
    mysqli_close($GLOBALS['DB']);
}

function db_execute($sql)
{
    return mysqli_query($GLOBALS['DB'], $sql);
}

function db_query($sql)
{
    return mysqli_query($GLOBALS['DB'], $sql);
}

function db_fetch_object($table,$condition)
{
    $res="select * from $table where $condition limit 1";
    $query=mysqli_query($GLOBALS['DB'],$res);

    if($query && mysqli_num_rows($query)>0)
        return mysqli_fetch_object($query);
    else
        return NULL;
}

function find($res)
{
    $query=mysqli_query($GLOBALS['DB'],$res);

    if(mysqli_num_rows($query)>0)
        return 1;
    else
        return NULL;
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

function reduncancy_check($table,$field,$value)
{
    $sql="select 1 from $table where $field='$value' limit 1";
    $query=mysqli_query($GLOBALS['DB'],$sql);

    return mysqli_num_rows($query);
}

function reduncancy_check_all($table,$con)
{
    $sql="select 1 from $table $con limit 1";
    $query=mysqli_query($GLOBALS['DB'],$sql);

    return mysqli_num_rows($query);
}

function db_insert($table, $vars,$echo_sql=0)
{
    foreach ($vars as $field => $value)
    {
        $fields[] = '`'.$field.'`';

        if ($value != 'NOW()')
        {
            $values[] = "'" . mysqli_real_escape_string($GLOBALS['DB'],$value) . "'";
        }
        else
        {
            $values[] = $value;
        }
    }

    $fieldList = implode(", ", $fields);
    $valueList = implode(", ", $values);

    $sql="insert into $table ($fieldList) values ($valueList)";

    if($echo_sql==1) echo $sql;

    if(mysqli_query($GLOBALS['DB'],$sql))
        return mysqli_insert_id($GLOBALS['DB']);
    else
        return false;
}

function db_update($table, $id, $vars, $tag='',$echo_sql=0)
{
    foreach ($vars as $field => $value)
    {
        $sets[] = "$field = '" . mysqli_real_escape_string($GLOBALS['DB'],$value) . "'";
    }

    $setList = implode(", ", $sets);

    if($tag=='')
        $sql = "update $table set $setList where id= $id";
    else
        $sql = "update $table set $setList where $tag= $id";

    if($echo_sql==1) echo $sql;

    return mysqli_query($GLOBALS['DB'],$sql);
}

function db_delete($table,$condition,$echo_sql=0)
{
    $sql = "delete from $table where $condition limit 1";

    if($echo_sql==1) echo $sql;

    return mysqli_query($GLOBALS['DB'],$sql);
}

function db_delete_all($table,$condition,$echo_sql=0)
{
    $sql = "delete from $table where $condition";

    if($echo_sql==1) echo $sql;

    return mysqli_query($GLOBALS['DB'],$sql);
}

function db_last_insert_id()
{
    return mysqli_insert_id($GLOBALS['DB']);
}

function find_a_field($table,$field,$condition,$echo_sql=0)
{
    $sql="select $field from $table where $condition limit 1";

    if($echo_sql==1) echo $sql;

    $res=mysqli_query($GLOBALS['DB'],$sql);

    if(mysqli_num_rows($res)>0)
    {
        $data=mysqli_fetch_row($res);
        return $data[0];
    }
    else
        return NULL;
}

function find_a_field_sql($sql,$echo_sql=0)
{
    if($echo_sql==1) echo $sql;

    $res=mysqli_query($GLOBALS['DB'],$sql);

    if(mysqli_num_rows($res)>0)
    {
        $data=mysqli_fetch_row($res);
        return $data[0];
    }
    else
        return NULL;
}

function find_all_field_sql($sql,$echo_sql=0)
{
    if($echo_sql==1) echo $sql;

    $res=mysqli_query($GLOBALS['DB'],$sql);

    if(mysqli_num_rows($res)>0)
        return mysqli_fetch_object($res);
    else
        return NULL;
}

function find_all_field($table,$field,$condition,$echo_sql=0)
{
    $sql="select * from $table where $condition limit 1";

    if($echo_sql==1) echo $sql;

    $res=mysqli_query($GLOBALS['DB'],$sql);

    if(mysqli_num_rows($res)>0)
        return mysqli_fetch_object($res);
    else
        return NULL;
}

/////////////////////////////////////////////////////////////////
///////////////////// UI FUNCTIONS //////////////////////////////
/////////////////////////////////////////////////////////////////

function do_datatable($field_id)
{
echo '<script>
$(document).ready(function(){
$("#'.$field_id.'").DataTable({
buttons:["copy","excel","pdf"]
});
});
</script>';
}

function do_calander($field,$minDate='',$maxDate='')
{
$add='';

if($minDate!='')
$add .= 'minDate: '.$minDate.', ';

if($maxDate!='')
$add .= 'maxDate: '.$maxDate.', ';

echo '<script>
$(document).ready(function(){
$("'.$field.'").datepicker({
changeMonth:true,
changeYear:true,
'.$add.'
dateFormat:"yy-mm-dd"
});
});
</script>';
}

?>