<?php
require_once "../../../assets/template/layout.top.php";
$title = "TASK Dashboard";

require_once "../../template/inc.notify.php";
 $today = date('Y-m-d');
 $lastdays = 	date("Y-m-d", strtotime("-7 days", strtotime($today)));
?>


<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from designreset.com/cork/ltr/demo3/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Mar 2020 08:10:15 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>TASK</title>
   <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../../../dashboard_assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  
  <style>
  	.small-box h3{
		color: #000000 !important;
	}
	.small-box p{
		color: #000000 !important;
	}
  </style>
</head>

<!-- <h3>Task Management Module</h3> -->


<div class="content">
  <div class="container-fluid">
  <?php 

// $where = "";
// if($_SESSION['login_type'] == 2){
//   $where = " where manager_id = '{$_SESSION['login_id']}' ";
// }elseif($_SESSION['login_type'] == 3){
//   $where = " where concat('[',REPLACE(user_ids,',','],['),']') LIKE '%[{$_SESSION['login_id']}]%' ";
// }
//  $where2 = "";
// if($_SESSION['login_type'] == 2){
//   $where2 = " where p.manager_id = '{$_SESSION['login_id']}' ";
// }elseif($_SESSION['login_type'] == 3){
//   $where2 = " where concat('[',REPLACE(p.user_ids,',','],['),']') LIKE '%[{$_SESSION['login_id']}]%' ";
// }
?>
    
  <div class="row">
    <div class="col-md-8">
    <div class="card card-outline card-success">
      <div class="card-header">
        <b>Today's task pending list</b>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table1  table-striped table-bordered table-hover table-sm">
            <thead class="thead1">
            <tr class="bgc-info">
                <th>SL</th>
                <th>Department</th>
                <th>Task</th>
                <th>Assign To</th>
                <th>status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody class="tbody1">
            <?php
            $i = 1;
           	$sql="select t.*, p.name as pname, t.task_date,p.status as pstatus, t.task_end_date,t.start_time, t.end_time ,p.id as pid,i.PBI_NAME 
					from task_list t , project_list p, personnel_basic_info i 
					  where  p.id = t.project_id and i.PBI_ID=t.assign_person and t.status !='Done' and t.task_end_date='".date('Y-m-d')."' order by p.name asc ";
					$query = mysql_query($sql);
					while($data=mysql_fetch_object($query)){
              ?>
              <tr>
                  <td><?php echo $i++ ?></td>
                  <td><?php echo ucwords($data->pname)?>
                      <br><small>Date: <?php echo date("Y-m-d",strtotime($data->task_end_date)).' Time: '.$data->end_time;?></small>
                  </td>
				  <td> <?php echo ucwords($data->task) ?> </td>
                  <td> <?php echo $data->PBI_NAME;?> </td>
				  <td>
                        	<?php 
                        	if($data->status == 'Pending'){
						  		echo "<span class='badge badge-secondary'>Pending</span>";
                        	}elseif($data->status == 'On-Progress'){
						  		echo "<span class='badge badge-primary'>On-Progress</span>";
                        	}elseif($data->status == 'Done'){
						  		echo "<span class='badge badge-success'>Done</span>";
                        	}else{
								echo "<span class='badge badge-primary'>".$data->status."</span>";
							}
                        	?>
                        </td>
                  <td>
                    <a class="btn btn-primary btn-sm" href="../setup/view_task.php?task_id=<?=$data->id?>">
                          <i class="fas fa-folder">
                          </i>
                          View
                    </a>
                  </td>
              </tr>
            <?php } ?>
            </tbody>  
          </table>
        </div>
      </div>
    </div>
	
	
	<div class="card card-outline card-success">
      <div class="card-header">
        <b>Overdue</b>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table1  table-striped table-bordered table-hover table-sm">
            <thead class="thead1">
            <tr  class="bgc-info">
                <th>SL</th>
                <th>Department</th>
                <th>Task</th>
                <th>Assign To</th>
                <th>status</th>
                <th>Action</th>
            </tr>

            </thead>
            <tbody class="tbody1">
            <?php
            $i = 1;
           	$sql="select t.*, p.name as pname, t.task_date,p.status as pstatus, t.task_end_date,t.start_time, t.end_time ,p.id as pid,i.PBI_NAME 
					from task_list t , project_list p, personnel_basic_info i 
					  where  p.id = t.project_id and i.PBI_ID=t.assign_person and t.status !='Done' and t.task_end_date < '".date('Y-m-d')."' order by p.name asc ";
					$query = mysql_query($sql);
					while($data=mysql_fetch_object($query)){
              ?>
              <tr>
                  <td><?php echo $i++ ?></td>
                  <td><?php echo ucwords($data->pname)?>
                      <br><small>Date: <?php echo date("Y-m-d",strtotime($data->task_end_date)).' Time: '.$data->end_time;?></small>
                  </td>
				  <td> <?php echo ucwords($data->task) ?> </td>
                  <td> <?php echo $data->PBI_NAME;?> </td>
				  <td>
                        	<?php 
                        	if($data->status == 'Pending'){
						  		echo "<span class='badge badge-secondary'>Pending</span>";
                        	}elseif($data->status == 'On-Progress'){
						  		echo "<span class='badge badge-primary'>On-Progress</span>";
                        	}elseif($data->status == 'Done'){
						  		echo "<span class='badge badge-success'>Done</span>";
                        	}else{
								echo "<span class='badge badge-primary'>".$data->status."</span>";
							}
                        	?>
                        </td>
                  <td>
                    <a class="btn btn-primary btn-sm" href="../setup/view_task.php?task_id=<?=$data->id?>">
                          <i class="fas fa-folder">
                          </i>
                          View
                    </a>
                  </td>
              </tr>
            <?php } ?>
            </tbody>  
          </table>
        </div>
      </div>
    </div>
	
	<div class="card card-outline card-success">
      <div class="card-header">
        <b>Today's Progress Reports</b>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table1  table-striped table-bordered table-hover table-sm">
            <thead class="thead1">
            <tr class="bgc-info">
                <th>SL</th>
                <th>Department</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = 1;
           	 $sql='select  a.d_id,a.d_id, DATE_FORMAT(a.progress_date, "%d-%m-%Y") as progress_date, s.type, c.fname as entry_by, a.entry_at, a.status
	 from daily_progress_master a, daily_progress_setup s,user_activity_management c
	  where  a.progress_for=s.id and a.entry_by=c.user_id and a.status !="MANUAL" and progress_date = "'.date('Y-m-d').'" order by a.d_id desc';
					$query = mysql_query($sql);
					while($data=mysql_fetch_object($query)){
              ?>
              <tr>
                  <td><?php echo $i++ ?></td>
                  <td><?php echo $data->type?></td>
				  <td><small>Entry Time: <?php echo date("Y-m-d",strtotime($data->entry_at));?></small></td>
                  <td>
                    <a class="btn btn-primary btn-sm" href="../po/po_print_view.php?d_id=<?=$data->d_id?>">
                          <i class="fas fa-folder"></i>
                          View
                    </a>
                  </td>
              </tr>
            <?php } ?>
            </tbody>  
          </table>
        </div>
      </div>
    </div>
	
    </div>
    <div class="col-md-4">
      <div class="row">
	  
	  
      <div class="col-12 col-sm-6 col-md-12">
        <div class="small-box  shadow-sm border" style="height:600px; overflow-y:scroll;">
          <div class="inner pr-0">
            <h5 class="text-center bg-warning bold pt-2 pb-2">
                <?php //echo $conn->query("SELECT * FROM project_list $where")->num_rows; ?>
                Notifications
            </h5>
			
			<?php  $sq = 'select c.comment,c.entry_at,u.fname ,t.task
						  from comment_list c, user_activity_management u,task_list t 
						  where u.user_id=c.entry_by and c.tr_from like "task" and t.id=c.m_id  order by c.id desc';
					$qu = mysql_query($sq);	
					while($re=mysql_fetch_object($qu)){   
			 ?>
		     <small><b style="color: #298f17;"><?=$re->task;?> : </b> <br> <?=$re->fname;?>: <?=$re->comment;?> [<?=$re->entry_at;?>]</small><br>
			<? } ?>
          </div>
          <div class="icon">
             
          </div>
        </div>
      </div>
	  
	  
	  
       <!--<div class="col-12 col-sm-6 col-md-12">
        <div class="small-box shadow-sm border">
          <div class="inner">
            <h3><?php //echo $conn->query("SELECT t.*,p.name as pname,p.start_date,p.status as pstatus, p.end_date,p.id as pid FROM task_list t inner join project_list p on p.id = t.project_id $where2")->num_rows; ?></h3>
            <h3>Total Tasks</h3>
          </div>
          <div class="icon">
             <i class="fa fa-tasks"></i> 
          </div>
        </div>
      </div>-->
  </div>
    </div>
  </div>

  </div>
</div>    










   
<?

require_once "../../../assets/template/layout.bottom.php";

?>