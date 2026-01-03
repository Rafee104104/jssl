<?php

require_once "../../../assets/template/layout.top.php";

$title='Daily Task Entry';

$crud = new crud('task_manage');

$taskAll=find_all_field('task_manage','','id="'.$_GET['id'].'"');

$unique='id';

if(isset($_POST['update'])){


$_POST['id']=$_GET['id'];
$crud->update($unique);


echo "<script>window.top.location='task_list.php'</script>";
}


?>



<div class="modal-body">

        <form action="" method="post" style="text-align:left">

          
<div class="form-group">

            <label for="recipient-name" class="col-form-label">Assign Person::</label>

            <input type="text" class="form-control" name="" value="<?=find_a_field('personnel_basic_info','PBI_NAME','PBI_ID="'.$taskAll->assign_person.'"')?>"  id="recipient-name">

          </div>
		  <div class="form-group">

            <label for="recipient-name" class="col-form-label">Task Name:</label>

            <input type="text" class="form-control" name="" value="<?=$taskAll->task_name;?>"  id="recipient-name">

          </div>
		  
		  <div class="form-group">

            <label for="message-text" class="col-form-label">Description:</label>

            <textarea class="form-control" name="task_des" ><?=$taskAll->task_des;?></textarea>

          </div>

		  

		  <div class="row">
		  <div class="col-6">
		  <div class="form-group">

            <label for="recipient-name" class="col-form-label">Task Start Date:</label>

            <input type="date" class="form-control" name="task_start"  value="<?=$taskAll->task_start;?>" id="recipient-name" readonly>

          </div>
		  </div>
<div class="col-6">
		  <div class="form-group">

            <label for="recipient-name" class="col-form-label">Task End Date:</label>

            <input type="date" class="form-control" name="task_end" value="<?=$taskAll->task_end;?>" id="recipient-name" readonly>

          </div>
		  </div>
		  </div>

		  <div class="form-group">

            <span>Start Time:</span>

            <input type="time" style="width:30%" class="form-control" name="task_start_time" value="<?=$taskAll->task_start_time;?>" id="recipient-name" readonly>

			<span>End Time:</span>

            <input type="time" class="form-control" style="width:30%" name="task_end_time" value="<?=$taskAll->task_end_time;?>" id="recipient-name" readonly>

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
		   <input type="submit" class="form-control btn btn-success"  name="update" value="Update" >
		  </div>

        </form>

      </div>
	  
<?



require_once "../../../assets/template/layout.bottom.php";




?>