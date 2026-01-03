<?php
require_once "../../../assets/template/layout.top.php";
$title='Direct Sales List';

do_calander('#fdate');
do_calander('#tdate');

if($_GET['bill_no']>0){ $bill_no=$_GET['bill_no'];
    ?><script>window.location.href = "chalan_view.php?v_no=<?=$bill_no?>"</script><?
}



$target_url = 'chalan_view.php';

if($_REQUEST[$unique]>0)
{
$_SESSION[$unique] = $_REQUEST[$unique];
header('location:'.$target_url);
}

?>
<script language="javascript">
function custom(theUrl)
{
	window.open('<?=$target_url?>?v_no='+theUrl);
}
</script>



<div class="form-container_large">
    
    <form action="" method="post" name="codz" id="codz">
         
        <div class="container-fluid bg-form-titel">
            <div class="row">
                <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5">
                    <div class="form-group row m-0">
                        <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Date:</label>
                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
                            <input type="text" name="fdate" id="fdate"  value="<?=date('Y-m-01')?>" />
                        </div>
                    </div>

                </div>
                <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5">
                    <div class="form-group row m-0">
                        <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">-To-</label>
                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
                            <input type="text" name="tdate" id="tdate"  value="<?=date('Y-m-d')?>" />
                        </div>
                    </div>
                </div>

                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                    
                    <input type="submit" name="submitit" id="submitit" value="VIEW" class="btn1 btn1-submit-input"/ >
                </div>

            </div>
        </div>






<div class="container-fluid pt-5 p-0 ">
<?
if(isset($_POST['submitit'])){

if($_POST['fdate']!='' && $_POST['tdate']!='') 
$con.= 'and a.oi_date between "'.$_POST['fdate'].'" and "'.$_POST['tdate'].'"';

?>

<table class="table1  table-striped table-bordered table-hover table-sm">
    <thead class="thead1">
    <tr class="bgc-info">
        <th>Bill No</th>
        <th>Bill Date</th>
        <th>Party</th>
        <th>Total</th>
        <th>Action</th>
    </tr>
    </thead>

<tbody class="tbody1">

<?
$res='select  a.oi_no,a.oi_no,a.oi_date, a.customer_name,a.payable_amt as amount,a.status 
from warehouse_ds_issue a,warehouse_ds_issue_detail b
            
        where a.oi_no=b.oi_no and a.warehouse_id = "'.$_SESSION['user']['depot'].'" 
            and a.issue_type = "Direct Sales" '.$con.' and a.status="CHECKED"
            group by a.oi_no order by a.oi_no desc';
                
//echo link_report($res,'po_print_view.php');
$query = mysql_query($res);                    
while($data = mysql_fetch_object($query)){
?>
        <tr>
            <td><?=$data->oi_no?></td>
            <td><?=$data->oi_date?></td>
            <td><?=$data->customer_name?></td>
            <td><?=$data->amount?></td>
            <td><input type="submit" name="submitit" id="submitit" value="View" class="btn1 btn1-submit-input" onclick="custom(<?=$data->oi_no?>);" /></td>

        </tr>
<?}?>

                    </tbody>
                </table>
            <?}?>

        </div>
    </form>
</div>



<?
require_once "../../../assets/template/layout.bottom.php";
?>