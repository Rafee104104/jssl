<?php

session_start();

ob_start();

require_once "../../../assets/support/inc.all.php";

$title='Task List';

$proj_id=$_SESSION['proj_id'];

$table = 'project_list';

$unique = 'id';

$shown = 'name';

do_datatable('ac_ledger');

$now=time();

if($_GET['did']!=''){

$sql='update task_issue set status="Done" where id="'.$_GET['did'].'"';
mysql_query($sql);

}


if(isset($_REQUEST['name']))

{


	$id=$_REQUEST['project_id'];

	$name		= mysql_real_escape_string($_REQUEST['name']);

	$name		= str_replace("'","",$name);

	$name		= str_replace("&","",$name);

	$name		= str_replace('"','',$name);

	//end

	if(isset($_POST['nledger']))

	{

		$crud   = new crud($table);

		$_POST['user_ids'] = implode(',',$_POST['user_ids']);

		$_POST['manager_id'] = $_POST['manager_ids'];

		$_POST['entry_by'] = $_SESSION['user']['id'];

		$_POST['entry_at'] = date('Y-m-d H:i:s');

		$$unique=$_SESSION[$unique]=$crud->insert();

        unset($$unique); 	

	}



//for Modify..................................



	if(isset($_POST['mledger']))

	{

	 $crud   = new crud($table);

	 $_POST['udate_by']=$_SESSION['user']['id'];

     $_POST['update_at']=date('Y-m-d H:s:i');

	 $crud->update($unique);



	}



}

	 $sql="select * from task_project where project_id='".$_REQUEST['project_id']."'";

	$query = mysql_query($sql);

	$data=mysql_fetch_object($query);



auto_complete_from_db('accounts_ledger','concat(ledger_name,"#>",ledger_id)','concat(ledger_name,"#>",ledger_id)','ledger_id like "%00000000"','under');

?>

<style type="text/css">

<!--

.style3 {color: #FFFFFF; font-weight: bold; }

-->

</style>

<link href="summer/summernote-lite.min.css" rel="stylesheet">

<script src="summer/summernote-lite.min.js"></script>

<link rel="stylesheet" href="summer/select2.min.css">

<link rel="stylesheet" href="summer/select2-bootstrap4.min.css">

<script src="summer/select2.full.min.js"></script>



<table width="100%" border="0" cellspacing="0" cellpadding="0">

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

					<col width="13%">

				</colgroup>

				<thead>

					<tr>

						<th class="text-center">#</th>

						<th>Project</th>

						<th>Issue Name</th>

						<th>Issue Date</th>

						<th>Deadline Date</th>
						
						<th>status</th>
						
						<th >Action</th>

					</tr>

				</thead>

				<tbody>

					<?php

					$i = 1;

					$sql="select i.*,o.name from task_issue i,crm_project_org o where i.project=o.id order by i.id DESC";

					$query = mysql_query($sql);

					while($data=mysql_fetch_object($query)){

					?>

					<tr>

						<td class="text-center"><?php echo $i++ ?></td>

						<td><?=$data->name?></td>
						
						<td><?=$data->issue_name?></td>

						<td><b><?=$data->issue_date ?></b></td>
						
						<td><b><?=$data->deadline_date ?></b></td>
						<td>
						<?php
						if($data->status =="Done"){

						  		echo "<span class='badge badge-success'>Done</span>";

                        	}elseif($data->status =="Task Assign"){

						  		echo "<span class='badge badge-warning'>Task Assign</span>";

                        	}else{

						  		echo "<span class='badge badge-primary'>Pending</span>";

                        	}
						?>
						</td>

						

						<td class="text-center">
						
						<? if($data->status =="Pending"){?>
			                    <a href="issue_convert.php?id=<?=$data->id?>" class="btn btn-info btn-sm">Convert Task</a>
								
								<? }else if($data->status =="Done"){?>
								Done
								<? }else{?>
								<a href="?did=<?=$data->id?>" class="btn btn-warning btn-sm">Confirm Done</a>
								
								<? }?>

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

</table>









<script type="text/javascript">

function Do_Nav(){

	var URL = 'pop_ledger_selecting_list.php';

	popUp(URL);

}



function DoNav(theUrl){

	document.location.href = 'add_project.php?project_id='+theUrl;

}



function popUp(URL) 

{

	day = new Date();

	id = day.getTime();

	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=1,menubar=0,resizable=1,width=800,height=800,left = 383,top = -16');");

}

</script>

<script type="text/javascript">

	document.onkeypress=function(e){

	var e=window.event || e

	var keyunicode=e.charCode || e.keyCode

	if (keyunicode==13)

	{

		return false;

	}

}



$(document).ready(function(){

	  $('.select2').select2({

	    placeholder:"Please select here",

	    width: "100%"

	  });

  })

</script>

<?

$main_content=ob_get_contents();

ob_end_clean();

include ("../../template/main_layout.php");

?>