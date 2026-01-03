<?php
session_start();
include 'config/db.php';
include 'config/function.php';
include 'config/access.php';
$user_id	=$_SESSION['user_id'];
$today 		= date('Y-m-d');

$title='Sales Return List';


$unique 		= 'po_no';
$status 		= 'CHECKED';
$target_url 	= 'receive_view.php';


include "inc/header.php";

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

<!-- main page content -->
<div class="form-container_large">
<form action="" method="post" name="codz" id="codz">

<div class="row">
        
            <div class="col-3"><label>Date Form</label></div>  
            <div class="col-6"><input type="date" class="form-control" name="fdate" id="fdate" value="<?=date('Y-m-01')?>" /></div>
</div>           
       
	   
<div class="row">	    
            <div class="col-3"><label>Date To</label></div> 
            <div class="col-6"><input type="date" class="form-control" name="tdate" id="tdate" value="<?=date('Y-m-d')?>" />
        </div> 
</div> 	

<div class="row">	
        <div class="col-12 form-group position-relative">
            <button type="submit" name="submitit" id="submitit" class="btn btn-success position-absolute top-50 end-0 translate-middle">View</button>
        </div> 
    </div>
  </form>
  
<p><br>  
  
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><div class="tabledesign2">



<? 
if(isset($_POST['submitit'])){

    if($_POST['fdate']!=''&&$_POST['tdate']!='')
    $con .= 'and a.or_date between "'.$_POST['fdate'].'" and "'.$_POST['tdate'].'"';
    
        $res='select  a.or_no,a.or_no as no,a.or_date as return_date, a.vendor_name as party,
		FORMAT(sum(amount),2) as Total
        from ss_receive_master a,ss_receive_details b 
        where a.or_no=b.or_no
        and a.receive_type = "Sales Return"  and a.status="Checked"
        '.$con.' and a.entry_by="'.$emp_code.'"
        group by a.or_no order by a.or_no desc';
        echo link_report($res,'po_print_view.php');
    
	}else{
    
        $res='select  a.or_no,a.or_no as no,a.or_date as return_date, a.vendor_name as party,
		FORMAT(sum(amount),2) as Total
        from ss_receive_master a,ss_receive_details b 
        where a.or_no=b.or_no
        and a.receive_type = "Sales Return"  and a.status="Checked"
        and a.or_date between "'.date('Y-m-01').'" and "'.date('Y-m-d').'"
		and a.entry_by="'.$emp_code.'"
        group by a.or_no order by a.or_no desc';
        echo link_report($res,'po_print_view.php');
}
?>
</div></td>
</tr>
</table>
</div>
        <!-- main page content ends -->


    </main>
    <!-- Page ends-->

<?php include "inc/footer.php"; ?>