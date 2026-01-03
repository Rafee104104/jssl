
	<?
 
 
if(isset($_GET['error_id'])){
$entry_by=$_SESSION['user']['id'];
						$get_error_id=$_GET['error_id'];
					   $get_page_id=$_GET['page_id'];
								$check_entry = find_a_field('error_check_details', 'count(id)', 'page_id="' . $get_page_id . '"  and error_type="'.$get_error_id.'" ');
								if($check_entry<1){
						echo $insert_sql="insert into error_check_details(page_id,error_type,entry_by)values('".$get_page_id."','".$get_error_id."','".$entry_by."')";
						mysql_query($insert_sql);
						}
						}

?>

<!--<h2 style="background-color:red;color:blue;">Page Id:  </h2>-->
<form action="" method="post">
	<table class="table table-bordered table-sm table-stripped">
		<thead>
			<tr>
				<th>Error Type</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$sql='select * from error_type';
		$query=mysql_query($sql);
		while($row=mysql_fetch_object($query)){
		 $check_entry = find_a_field('error_check_details', 'count(id)', 'page_id="'.$page_id.'"  and error_type="'.$row->error_id.'" ');
		//echo 'select count(id) from error_check_details where page_id="'.$g_page_id.'"  and error_type="'.$row->error_type.'"';
		?>
			<tr>
				<td>
 				 <?=$row->error_name; ?> 
				</td>
				<td>
				<?php 
				if($check_entry>0){
				echo '<span style="font-weight:bold;color:green;">Check Complete</span>';
				?>
				
			<!--	<a href="?update_error_id=<?php echo $row->error_id;?>&page_id=<?php echo $page_id;?>"><input type="button" class="btn btn-success" value="Update" /></a>-->
				<?php } else{?>
				<a href="?error_id=<?php echo $row->error_id;?>&page_id=<?php echo $page_id;?>"><input type="button" class="btn btn-primary" value="Done" /></a>
				<?php } ?></td>		
			</tr>
			<?php } ?>
	 
		</tbody>
	
	</table>

</form>








