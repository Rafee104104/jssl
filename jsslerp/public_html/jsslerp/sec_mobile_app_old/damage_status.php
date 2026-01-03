<?php
session_start();
include 'config/db.php';
include 'config/function.php';
include 'config/access.php';
$user_id	=$_SESSION['user_id'];
$today 		= date('Y-m-d');

$title='Damage List';


$status 		= 'CHECKED';
$target_url 	= 'issue_view.php';


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
    $con .= 'and a.oi_date between "'.$_POST['fdate'].'" and "'.$_POST['tdate'].'"';
    
  $res='select  a.oi_no,a.oi_no as no,a.oi_date as return_date, a.vendor_name as party,
		FORMAT(sum(amount),2) as Total
        from ss_issue_master a,ss_issue_details b 
        where a.oi_no=b.oi_no
        and a.issue_type = "Damage"  and a.status="Checked"
        '.$con.' and a.entry_by="'.$emp_code.'"
        group by a.oi_no order by a.oi_no desc';
        echo link_report($res,'po_print_view.php');
    
	}else{
    
        $res='select  a.oi_no,a.oi_no as no,a.oi_date as return_date, a.vendor_name as party,
		FORMAT(sum(amount),2) as Total
        from ss_issue_master a,ss_issue_details b 
        where a.oi_no=b.oi_no
        and a.issue_type = "Sales Return"  and a.status="Checked"
        and a.oi_date between "'.date('Y-m-01').'" and "'.date('Y-m-d').'"
		and a.entry_by="'.$emp_code.'"
        group by a.oi_no order by a.oi_no desc';
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