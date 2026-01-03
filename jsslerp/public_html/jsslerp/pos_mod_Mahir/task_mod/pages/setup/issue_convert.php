<?php

require_once "../../../assets/template/layout.top.php";

$title='Daily Task Entry';

$crud = new crud('task_manage');

$issueAll=find_all_field('task_issue','','id="'.$_GET['id'].'"');

$unique='id';

if(isset($_POST['insert'])){

$_POST['entry_by']=$_SESSION['user']['id'];

$crud->insert();


$sql='update task_issue set status="Task Assign" where id="'.$_GET['id'].'"';
mysql_query($sql);

echo "<script>window.top.location='project_issue_list.php'</script>";
}


?>



<div class="modal-body">

        <form action="" method="post" style="text-align:left">



  <input type="hidden" class="form-control" name="project" value="<?=$issueAll->project?>"  id="recipient-name">
       
<div class="form-group">

            <label for="recipient-name" class="col-form-label">Assign Person::</label>

                 <select class="form-control " name="assign_person" value="" id="recipient-name" required>
			<option> </option>

				<?  foreign_relation('personnel_basic_info','PBI_ID','PBI_NAME','',' 1');?>

			</select>

          </div>
		  <div class="form-group">

            <label for="recipient-name" class="col-form-label">Task Name:</label>

            <input type="text" class="form-control" name="task_name" value="<?=$issueAll->issue_name;?> from (<?=find_a_field('crm_project_org','name','id="'.$issueAll->project.'"')?>)"  id="recipient-name">

          </div>
		  
		  <div class="form-group">

            <label for="message-text" class="col-form-label">Description:</label>

            <textarea class="form-control" name="task_des" ><?=$issueAll->issue_des;?></textarea>

          </div>

		  

		  <div class="row">
		  <div class="col-6">
		  <div class="form-group">

            <label for="recipient-name" class="col-form-label">Task Start Date:</label>

            <input type="date" class="form-control" name="task_start"  value="<?=$task_data->task_date?>" id="recipient-name" required>

          </div>
		  </div>
<div class="col-6">
		  <div class="form-group">

            <label for="recipient-name" class="col-form-label">Task End Date:</label>

            <input type="date" class="form-control" name="task_end" value="<?=$task_data->task_end_date?>" id="recipient-name" required>

          </div>
		  </div>
		  </div>

		  <div class="row">
		  <div class="col-6">
		  <div class="form-group">

            <span>Start Time:</span>

            <input type="time" class="form-control" name="task_start_time" value="<?=$task_data->start_time?>" id="recipient-name">

          </div>
		  </div>
		  <div class="col-6">
		  <div class="form-group">
			<span>End Time:</span>

            <input type="time" class="form-control" name="task_end_time" value="<?=$task_data->end_time?>" id="recipient-name">

          </div>
		  </div>
		  </div>

          
		  
		  <div class="form-group">
		  
		  <label for="message-text" class="col-form-label">Priority Level:</label>
		  <select type="time" class="form-control" style="width:30%" name="task_priority" value="<?=$taskAll->task_priority;?>" id="recipient-name" readonly>
		  <option></option>
		  <?  foreign_relation('mis_task_priority','id','priority',$taskAll->task_priority,' 1');?>
		  </select>
		  
		  </div>

		  

		  <div class="form-group">

            <label for="recipient-name" class="col-form-label">Status:</label>

            <select name="status" id="status" class="custom-select custom-select-sm">
			<option value="<?=$taskAll->status?>"><?=$taskAll->status?></option>

				<option value="Pending">Pending</option>

				<option value="Started" >Started</option>

				<option value="On-Progress" >On-Progress</option>

				<option value="On-Hold" >On-Hold</option>

				<option value="Over Due" >Over Due</option>

				<option value="Done" >Done</option>

			</select>

          </div>
		  
		  <div class="form-group">
		   <input type="submit" class="form-control btn btn-success"  name="insert" value="Confirm" >
		  </div>

        </form>

      </div>
	  
<?



require_once "../../../assets/template/layout.bottom.php";




?>