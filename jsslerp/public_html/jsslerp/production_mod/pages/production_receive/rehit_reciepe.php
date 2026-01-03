<?php
session_start();
require "../../support/inc.all.php";


	$sql = 'select pr_no from production_floor_receive_master';
	$query = mysql_query($sql);
	while($data=mysql_fetch_object($query))
	{auto_insert_recipe_pr_id($data->pr_no);}
?>