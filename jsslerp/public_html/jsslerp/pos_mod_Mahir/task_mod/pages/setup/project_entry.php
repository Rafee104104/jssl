<?php

require_once "../../../assets/template/layout.top.php";

$title='Project Issue Entry';


do_calander('#issue_date');
do_calander('#deadline_date');

$crud = new crud('task_issue');

if(isset($_POST['submit'])){

$_POST['entry_by']=$_SESSION['user']['id'];
$_POST['entry_at']=date('Y-m-d H:i:s');
$_POST['status']="Pending";
$crud->insert();

echo "<script>window.top.location='project_entry.php'</script>";

}

?>



<div class="modal-body">

        <form action="" method="post" style="text-align:left">
		
		<div class="form-group">

            <label for="recipient-name" class="col-form-label">Project: </label>

            <select class="form-control " name="project" value="" id="recipient-name" required>
			<option> </option>

				<?  foreign_relation('crm_project_org','id','name',$project,' 1');?>

			</select>

          </div>

          

		  <div class="form-group">

            <label for="recipient-name" class="col-form-label">Issue Name:</label>

            <input type="text" class="form-control" name="issue_name"  id="issue_name" required>

          </div>
		  
		  <div class="form-group">

            <label for="message-text" class="col-form-label">Description:</label>

            <textarea class="form-control" name="issue_des" ></textarea>

          </div>

		 		  <div class="form-group">

            <label for="message-text" class="col-form-label">Issue Arriving Date:</label>

            <input type="text" class="form-control" name="issue_date"  id="issue_date" required>

          </div> 

		  
		 
		 <div class="form-group">

            <label for="message-text" class="col-form-label">Deadline Date:</label>

            <input type="text" class="form-control" name="deadline_date"  id="deadline_date" required>

          </div>

		  

		  
		  
		  <div class="form-group">
		   <input type="submit" class="form-control btn btn-success"  name="submit" value="Confirm" >
		  </div>

        </form>

      </div>
	  
<?



require_once "../../../assets/template/layout.bottom.php";




?>