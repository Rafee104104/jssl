<?php

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


function find_a_field($table,$field,$condition){
    $sql="select $field from $table where $condition limit 1";
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


function find1($sql){
    
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
    


function findall($sql){
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
    
    function find_all_field($table,$field,$condition)
    {
    $sql="select * from $table where $condition limit 1";
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
    
    
function foreign_relation($table,$id,$show,$value,$condition=''){
if($condition=='')
$sql="select $id,$show from $table";
else
$sql="select $id,$show from $table where $condition";
//echo $sql;
$res=mysql_query($sql);
while($data=mysql_fetch_row($res))
{
if($value==$data[0])
echo '<option value="'.$data[0].'" selected>'.$data[1].'</option>';
else
echo '<option value="'.$data[0].'">'.$data[1].'</option>';
}
}


function auto_option($sql){

$res=mysql_query($sql);
while($data=mysql_fetch_row($res))
{
if($value==$data[0])
echo '<option value="'.$data[0].'" selected>'.$data[1].'</option>';
else
echo '<option value="'.$data[0].'">'.$data[1].'</option>';
}
}    


function auto_complete_from_db($table,$show,$id,$con,$text_field_id)
{
if($con!='') $condition = " where ".$con;
$query="Select ".$id.", ".$show." from ".$table.$condition;

$led=mysql_query($query);
    if(mysql_num_rows($led) > 0)
    {
        $ledger = '[';
        while($ledg = mysql_fetch_row($led)){
          $ledger .= '{ name: "'.$ledg[1].'", id: "'.$ledg[0].'" },';
        }
        $ledger = substr($ledger, 0, -1);
        $ledger .= ']';
    }
    else
    {
        $ledger = '[{ name: "empty", id: "" }]';
    }

echo '<script type="text/javascript">
$(document).ready(function(){
    var data = '.$ledger.';
    $("#'.$text_field_id.'").autocomplete(data, {
        matchContains: true,
        minChars: 0,
        scroll: true,
        scrollHeight: 300,
        formatItem: function(row, i, max, term) {
            return row.name + " [" + row.id + "]";
        },
        formatResult: function(row) {
            return row.id;
        }
    });
  });
</script>';
}
function auto_complete_from_db_sql($query,$text_field_id)
{


$led=mysql_query($query);
    if(mysql_num_rows($led) > 0)
    {
        $ledger = '[';
        while($ledg = mysql_fetch_row($led)){
          $ledger .= '{ name: "'.$ledg[1].'", id: "'.$ledg[0].'" },';
        }
        $ledger = substr($ledger, 0, -1);
        $ledger .= ']';
    }
    else
    {
        $ledger = '[{ name: "empty", id: "" }]';
    }

echo '<script type="text/javascript">
$(document).ready(function(){
    var data = '.$ledger.';
    $("#'.$text_field_id.'").autocomplete(data, {
        matchContains: true,
        minChars: 0,
        scroll: true,
        scrollHeight: 300,
        formatItem: function(row, i, max, term) {
            return row.name + " [" + row.id + "]";
        },
        formatResult: function(row) {
            return row.id;
        }
    });
  });
</script>';
}

// IN FUNCTION    
function find_in($table,$field,$condition){    

  $sql="select $field as ch from $table where $condition";
  $res = @mysql_query($sql);
    
    $count=@mysql_num_rows($res);
     if($count>0){
            $mi = 0;    
            while($info=@mysql_fetch_object($res)){
            if($mi==0)
            $ch = '"'.$info->ch.'"';
            else
            $ch .= ',"'.$info->ch.'"'; $mi++;
            }
        return $ch;
            
    }else return NULL;
 
} // example: $valuein=find_in('warehouse_other_receive_detail','id',' 1 and or_no ="'.$pi1.'"');    


?>