<?php
require_once "../../../assets/template/layout.top.php";
$title='Unfinished';
do_calander('#fdate');
do_calander('#tdate');

$table_master='warehouse_ds_issue';
$table_detail='warehouse_ds_issue_detail';
$unique_master='oi_no';

$unique_detail='id';


$$unique_master=$_SESSION[$unique_master];


$show='dealer_code';
$id='oi_no';
$con='status="MANUAL"';

?>

<script language="javascript">
window.onload = function() {
  document.getElementById("dealer").focus();
}

</script>




<div class="form-container_large">
 
    <form action="" method="post" name="codz" id="codz">
            
        <div class="container-fluid bg-form-titel">
            <div class="row">
                <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5">
                    <div class="form-group row m-0">
                        <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Date From:</label>
                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
                            <input type="text" name="fdate" id="fdate"  value="<?=($_POST['fdate']!='')?$_POST['fdate']:date('Y-m-01');?>" class="form-control"/>
                        </div>
                    </div>

                </div>
                <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5">
                    <div class="form-group row m-0">
                        <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Date To:</label>
                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
                            <input type="text" name="tdate" id="tdate"  value="<?=($_POST['tdate']!='')?$_POST['tdate']:date('Y-m-d');?>"  class="form-control"/>

                        </div>
                    </div>
                </div>
				

                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                    
                    <input type="submit" name="submitit" id="submitit" value="VIEW DETAIL" class="btn1 btn1-submit-input"/ >
                </div>

            </div>
        </div>






        <div class="container-fluid pt-5 p-0 ">
		
		
		

                <table class="table1  table-striped table-bordered table-hover table-sm">
                    <thead class="thead1">
                    <tr class="bgc-info">
                        <th>Sales NO</th>
						<th>Date</th>
						<th>Party Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody class="tbody1">
					
					
<? 
$ffdate=date('Y-m-01');
$ttdate=date('Y-m-d');


if($_POST['fdate']!='') { 
    $con=' and a.oi_date between "'.$_POST['fdate'].'" and "'.$_POST['tdate'].'"';
}else{
    $con=' and a.oi_date between "'.date('Y-m-01').'" and "'.date('Y-m-d').'"';
}


$res ='select a.oi_no,a.entry_by,a.oi_date,a.vendor_id,d.dealer_name_e,u.fname
from '.$table_master.' a,dealer_info d,user_activity_management u
where a.vendor_id=d.dealer_code and a.entry_by=u.user_id and a.warehouse_id="'.$_SESSION['user']['depot'].'" and a.status="MANUAL" and a.issue_type="Direct Sales"
'.$con.' 
order by a.oi_no desc';

//echo link_report($res,'po_print_view.php');


$query = mysql_query($res);
?>
					
					
					<?
					
					while($row = mysql_fetch_object($query)){
					
					?>

                        <tr>
                            <td><?=$row->oi_no?></td>
                            <td><?=$row->oi_date?></td>
                            <td><?=$row->dealer_name_e?></td>

                            <td>
						
							<a href="direct_sales.php?old_do_no=<?=$row->oi_no?>">
							<input type="button" value="Open" class="btn1 btn1-submit-input"/ >
							
							</a>
							

							</td>

                        </tr>
						<?
						}
						?>
                    </tbody>
                </table>

						



        </div>
    </form>
</div>




<?

require_once "../../../assets/template/layout.bottom.php";

?>