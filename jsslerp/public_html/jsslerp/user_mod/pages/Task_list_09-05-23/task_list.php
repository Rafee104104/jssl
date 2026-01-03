<?php

session_start();

ob_start();

require_once "../../../assets/support/inc.all.php";

$title = 'Task List';

$proj_id = $_SESSION['proj_id'];

$table = 'task_manage';

$unique = 'id';

do_datatable('ac_ledger');

$crud = new crud($table);

if (isset($_POST['upProgress'])) {

	$crud->update($unique);
	echo "<script>window.top.location='task_list.php'</script>";
}


?>

<style type="text/css">
	<!--
	.style3 {
		color: #FFFFFF;
		font-weight: bold;
	}
	-->

</style>









<center>Personal Task List</center>



<div class="text-right">
	<a href="task_entry_personal.php"><button class="btn btn-primary">Add Task</button></a>
</div>


<div class="form-container_large">

	<div class="container-fluid pt-5 p-0">



		<table class="table1  table-striped table-bordered table-hover table-sm" id="ac_ledger">

			<thead class="thead1">

				<tr class="bgc-info">

					<th>SL</th>

					<th>Task Name</th>

					<th>Start Date</th>

					<th>End Date</th>

					<th>Task Status</th>

					<th>Action</th>

				</tr>

			</thead>



			<tbody class="tbody1">



				<?php

				$uID = find_a_field('user_activity_management', 'PBI_ID', 'user_id="' . $_SESSION['user']['id'] . '"');

				$i = 1;



				$sql = "select * from task_manage where assign_person='" . $uID . "' and status!='Done'";

				$query = mysql_query($sql);

				while ($data = mysql_fetch_object($query)) {



				?>

					<tr>
						<td><?= $i++; ?></td>
						<td style="cursor:pointer" onclick="window.open('task_up.php?id=<?= $data->id ?>')"><?= $data->task_name ?></td>
						<td><?= $data->task_start ?></td>
						<td><?= $data->task_end ?></td>
						<td>
							<form method="post">
								<input type="hidden" value="<?= $data->id ?>" name="id" />
								<select name="status" width="50%">
									<option value="<?= $data->status ?>"><?= $data->status ?></option>
									<option value="Pending">Pending</option>

									<option value="Started">Started</option>

									<option value="On-Progress">On-Progress</option>

									<option value="On-Hold">On-Hold</option>

									<option value="Over Due">Over Due</option>

									<option value="Done">Done</option>

								</select>
						</td>
						<td>


							<input type="submit" class="btn btn-success" name="upProgress" value="Update" />

							</form>
						</td>


					</tr>

				<? } ?>


			</tbody>

		</table>





	</div>

</div>







<?php /*?><table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>    

  	<td width="100%" style="padding-right:5%">

		<div class="left">

		



		<div class="col-lg-12" style="width:100%">

	<div class="card card-outline card-success">

		<div class="card-header">

			<div class="card-tools">

				<!--<button class="btn btn-primary btn-sm btn-default btn-flat border-primary" href=""><i class="fa fa-plus"></i> Add New Task</button>-->

			</div>

		</div>

		<div class="card-body" style="width:100%;overflow: scroll;">

			<table class="table tabe-hover table-condensed" id="ac_ledger">

				<colgroup>

					<col width="5%">

					<col width="15%">

					<col width="20%">

					<col width="15%">

					<col width="15%">

					<col width="10%">

					<col width="10%">

					<col width="10%">

				</colgroup>

				<thead>

					<tr>

						<th class="text-center">#</th>

						<th>Department</th>

						<th>Task</th>

						<th>Date</th>

						<th>Time</th>

						<th>Assign To</th>

						<th>Task Status</th>

						<th>Action</th>

					</tr>

				</thead>

				<tbody>

					<?php

					$i = 1;

					 

					$sql="select t.*, p.name as pname, t.task_date,p.status as pstatus, t.task_end_date,t.start_time, t.end_time ,p.id as pid,i.PBI_NAME 

					from task_list t , project_list p, personnel_basic_info i 

					  where  p.id = t.project_id and i.PBI_ID=t.assign_person and t.assign_person in ('".$_SESSION['employee_selected']."',0) order by p.name asc ";

					$query = mysql_query($sql);

					while($data=mysql_fetch_object($query)){



					?>

					<tr>

						<td class="text-center"><?php echo $i++ ?></td>

						<td>

							<p><b><?php echo ucwords($data->pname) ?></b></p>

						</td>

						<td>

							<p><b><?php echo ucwords($data->task) ?></b></p>

							<p class="truncate"><?php echo strip_tags($desc) ?></p>

						</td>

						<td><b><?php echo $data->task_date .'<br> '.$data->task_end_date; ?></b></td>

						<td><b><?php echo $data->start_time .'<br> '.$data->end_time; ?></b></td>

						<td class="text-center">

							<?php echo $data->PBI_NAME;?>

						</td>

						<td>

                        	<?php 

                        	if($data->status == 'Pending'){

						  		echo "<span class='badge badge-secondary'>Pending</span>";

                        	}elseif($data->status == 'On-Progress'){

						  		echo "<span class='badge badge-primary'>On-Progress</span>";

                        	}elseif($data->status == 'Done'){

						  		echo "<span class='badge badge-success'>Done</span>";

                        	}

                        	?>

                        </td>

						<td class="text-center">

			                    <a href="view_task.php?task_id=<?=$data->id?>" class="btn btn-info btn-sm">Submit Progress</a>

						</td>

					</tr>	

				<?php } //endwhile; ?>

				</tbody>

			</table>

		</div>

	</div>

</div>

<style>

	table p{

		margin: unset !important;

	}

	table td{

		vertical-align: middle !important

	}

</style>

		

		

		</div>	

	</td>

  </tr>

</table><?php */ ?>









<script type="text/javascript">
	function Do_Nav() {

		var URL = 'pop_ledger_selecting_list.php';

		popUp(URL);

	}



	function DoNav(theUrl) {

		document.location.href = 'add_project.php?project_id=' + theUrl;

	}



	function popUp(URL)

	{

		day = new Date();

		id = day.getTime();

		eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=1,menubar=0,resizable=1,width=800,height=800,left = 383,top = -16');");

	}
</script>

<script type="text/javascript">
	document.onkeypress = function(e) {

		var e = window.event || e

		var keyunicode = e.charCode || e.keyCode

		if (keyunicode == 13)

		{

			return false;

		}

	}



	$(document).ready(function() {

		$('.select2').select2({

			placeholder: "Please select here",

			width: "100%"

		});

	})
</script>

<?

$main_content = ob_get_contents();

ob_end_clean();

include("../../template/main_layout.php");

?>