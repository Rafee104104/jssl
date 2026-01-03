<?php
session_start();
include 'config/db.php';
include 'config/function.php';
include 'config/access.php';
$user_id	=$_SESSION['user_id'];
$today 		= date('Y-m-d');

$title='Order Status';


$unique 		= 'do_no';
$target_url 	= 'do_view.php';


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
	window.open('<?=$target_url?>?do='+theUrl);
}
</script>

<!-- main page content -->
<div class="form-container_large">

<div class="container">
<h3 align="center">Order List</h3>
<form action="" method="post" name="codz" id="codz">

<div class="row container-fluid p-0">
        
            <div class="col-4"><label>Date Form :</label></div>
            <div class="col-8 p-0"><input type="date" class="form-control" name="fdate" id="fdate"
			value="<?=$_POST['fdate']?$_POST['fdate']:date('Y-m-01')?>" /></div>
</div>           
       
	   
<div class="row container-fluid p-0 pt-1">
            <div class="col-4"><label>Date To :</label></div>
            <div class="col-8 p-0"><input type="date" class="form-control" name="tdate" id="tdate"
			value="<?=$_POST['tdate']?$_POST['tdate']:date('Y-m-d')?>" />
        </div> 
</div> 	

<div class="row container-fluid pt-2">
        <div class="col-12 form-group" align="center">
            <button type="submit" name="submitit" id="submitit" class="btn btn-success ">View</button>
        </div> 
    </div>
  </form>
  
<p><br>  
  
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
<div class="tabledesign2" style="font-size: 12px">



<? 
if(isset($_POST['submitit'])){

    if($_POST['fdate']!=''&&$_POST['tdate']!='')
    $con .= 'and m.do_date between "'.$_POST['fdate'].'" and "'.$_POST['tdate'].'"';
    
     $res='select  m.do_no,m.do_no as do_no,m.do_date, s.shop_name as party, FORMAT(sum(d.total_amt),2) as Total
        
		from ss_do_master m, ss_do_details d , ss_shop s
        where m.do_no=d.do_no and m.dealer_code=s.dealer_code and m.status in("Checked","COMPLETED")
        '.$con.' and m.entry_by="'.$emp_code.'"
        group by m.do_no order by m.do_no desc';
        echo link_report($res,'do_view.php');
    
}
?>
</div>
</td>
</tr>
</table>
</div>
</div>
        <!-- main page content ends -->


    </main>
    <!-- Page ends-->

<?php include "inc/footer.php"; ?>