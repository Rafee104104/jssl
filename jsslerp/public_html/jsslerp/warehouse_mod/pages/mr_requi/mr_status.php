<?php
session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";

$title='Requisition Status';

do_calander('#fdate');
do_calander('#tdate');

$table = 'requisition_master_stationary';
$unique = 'req_no';
$status = 'UNCHECKED';
$target_url = '../mr_requi/mr_print_view.php';

?>
<script language="javascript">
function custom(theUrl)
{
	window.open('<?=$target_url?>?<?=$unique?>='+theUrl);
}
</script>
<style>
.tabledesign2 {
    width: 100%;
    padding: 0;
    margin: 0px auto 1px auto;
    background-color: #ffffff;
    border-left: 1px solid #417216;
    text-align: left;
}
.tabledesign2 th {
    font: bold 11px Verdana, Arial, Helvetica, sans-serif;
    background-color: #cbde72;
    color: #000;
    border-right: 1px solid #417216;
    border-bottom: 1px solid #417216;
    border-top: 1px solid #417216;
    text-align: left;
    padding: 3px 3px 3px 12px;
}
.tabledesign2 td {
    border-right: 1px solid #417216;
    border-bottom: 1px solid #417216;
    padding: 3px 3px 3px 3px;
    color: #000;
    text-align: left;
}
</style>


<div class="form-container_large">
 
    <form action="" method="post" name="codz" id="codz">
            
        <div class="container-fluid bg-form-titel">
            <div class="row">
                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <div class="form-group row m-0">
                        <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Date From:</label>
                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
                            <input type="text" name="fdate" id="fdate"  value="<? if($_POST['fdate']!='') echo $_POST['fdate']; else echo date('Y-m-01')?>" />
                        </div>
                    </div>

                </div>
                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <div class="form-group row m-0">
                        <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Date To:</label>
                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
                           <input type="text" name="tdate" id="tdate"  value="<? if($_POST['tdate']!='') echo $_POST['tdate']; else echo date('Y-m-d')?>" />

                        </div>
                    </div>
                </div>
				<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group row m-0">
                        <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Req Status:</label>
                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
						  <select name="status" id="status" >
							<option></option>
							<option <?=($_POST['status']=='UNCHECKED')?'selected':''?>>UNCHECKED</option>
							<option <?=($_POST['status']=='PRE-CHECKED')?'selected':''?>>PRE-CHECKED</option>
							<option <?=($_POST['status']=='PRE-CHECKED2')?'selected':''?>>PRE-CHECKED2</option>
							<option <?=($_POST['status']=='CHECKED')?'selected':''?>>CHECKED</option>
						    <option <?=($_POST['status']=='MANUAL')?'selected':''?>>MANUAL</option>
							<option <?=($_POST['status']=='APPROVAL1')?'selected':''?>>APPROVAL1</option>
							<option <?=($_POST['status']=='APPROVAL2')?'selected':''?>>APPROVAL2</option>

						 </select>

                        </div>
                    </div>
                </div>

                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                    
                    <input type="submit" name="submitit" id="submitit" value="View Product" class="btn1 btn1-submit-input"/ >
                </div>

            </div>
        </div>



<div class="container-fluid pt-5 p-0 ">
		
		
		

                <table class="table1  table-striped table-bordered table-hover table-sm">
                    <thead class="thead1">
                    <tr class="bgc-info">
                        <th>Req No</th>
						<th>Req Date</th>
						<th>Req For</th>
						<th>Warehouse</th>
						<th>Note</th>
						<th>Need By</th>
						<th>Entry By</th>
						<th>Entry At</th>
						<th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody class="tbody1">
					
		<? 
					if($_POST['status']!=''&&$_POST['status']!='ALL')
					$con .= 'and a.status="'.$_POST['status'].'"';
					
					if($_POST['fdate']!=''&&$_POST['tdate']!=''){
					$con .= 'and a.req_date between "'.$_POST['fdate'].'" and "'.$_POST['tdate'].'"';
					
					$res='select  a.req_no, a.req_date, a.req_for, b.warehouse_name as warehouse, a.req_note as note, a.need_by, c.fname as entry_by, a.entry_at,a.status from requisition_master_stationary a,warehouse b,user_activity_management c where  a.warehouse_id=b.warehouse_id and a.entry_by=c.user_id '.$con.' and a.status in ("UNCHECKED1","UNCHECKED","PRE-CHECKED","PRE-CHECKED2","CHECKED","MANUAL","APPROVAL0","APPROVAL1","APPROVAL2","APPROVED","COMPLETE") order by a.req_date desc';
		//echo link_report($res,'mr_print_view.php');
		$query = mysql_query($res);
		?>
					
					
					<?
					
					while($row = mysql_fetch_object($query)){
					
					?>

                        <tr>
                            <td><?=$row->req_no?></td>
                            <td><?=$row->req_date?></td>
                            <td><? $row->req_for?></td>

                            <td><?= $row->warehouse?></td>
                            <td><?= $row->note?></td>
                            <td><?= $row->need_by?></td>

                            <td><?= $row->entry_by?></td>
                            <td><?= $row->entry_at?></td>
							<td><?= $row->status?></td>
                            <td>
							<button type="button" name="submitit" id="submitit" value="VIEW" onclick="custom(<?= $row->req_no?>)" class="btn2 btn1-bg-submit">
							<i class="fa-solid fa-eye"></i>
							</button>
							
							</td>

                        </tr>
						<?
						}
						?>
                    </tbody>
                </table>

						<?
						}
						?>



        </div>
</form>
</div>

<?
$main_content=ob_get_contents();
ob_end_clean();
include ("../../template/main_layout.php");
?>