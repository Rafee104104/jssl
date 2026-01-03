<?php
$ser=explode(".c",$_SERVER['HTTP_HOST']) ;
$cid=$ser[0];
@mysql_connect('localhost', 'erpengine_clouderpuser', 'clouderppassword224424');
@mysql_select_db('erpengine_clouderpdb');
$sql='select id from company_info where cid="'.$cid.'"';
$query=mysql_query($sql);
$row=mysql_fetch_row($query);
if($row[0]!=''){
    
  $dsql='select db_name,db_user,db_pass from database_info where company_id='.$row[0].'';
 $dquery=mysql_query($dsql);
 $data=mysql_fetch_object($dquery);
 $_SESSION['dbName']=$data->db_name;
 $_SESSION['dbuser']=$data->db_user;
  $_SESSION['dbPass']=$data->db_pass;
 


 	echo "<script>window.top.location='index.php'</script>";
}else{
    
    die();
}
?>