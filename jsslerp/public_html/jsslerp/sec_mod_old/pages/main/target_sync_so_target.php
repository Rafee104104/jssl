<?php
session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";  


$today 			  = date('Y-m-d');
$company_id   = $_SESSION['company_id'];
$menu 			  = 'Target';
$sub_menu 		= 'target_sync_so_target';



$entry_by = $_SESSION['username'];
$datetime 	= date('Y-m-d H:i:s');

if($_POST['mon']!=''){
$mon=$_POST['mon'];
}else{
$mon=date('n');
}

if($_POST['year']!=''){
$year=$_POST['year'];
}else{
$year=date('Y');
}



if($_POST['update']){

$year=$_POST['year'];
$mon=$_POST['mon'];


$del = 'delete from ss_target_upload where target_year="'.$year.'" and target_month="'.$mon.'" ';
mysql_query($del);


// Dealer Target
$tt="select dealer_code as code,sum(target_amount) as amount from sale_target_upload where target_year='".$year."' and target_month='".$mon."' 
group by dealer_code";
$query1 = mysql_query($tt);
while($info1 = mysql_fetch_object($query1)){
$dealer_target_amount[$info1->code]=$info1->amount;
}


// Target Contribution Data
$tc = "select emp_code,target_con from ss_target_ratio where target_year='".$year."' and target_month='".$mon."' group by emp_code";
$query2 = mysql_query($tc);
while($info2 = mysql_fetch_object($query2)){
$contribution[$info2->emp_code]=$info2->target_con;
}




// USER LIST
$sql='select * from ss_user where status="Active" order by username';
$query = mysql_query($sql);
while($info = mysql_fetch_object($query)){

$dealer_code = $info->dealer_code;

$target_con     =$contribution[$info->username]; if($target_con==''){ $target_con=100;}
$dealer_target  = $dealer_target_amount[$dealer_code];
$sales_target   = ($dealer_target*$target_con)/100;


// Insert data 
if($sales_target>0){
$ss="INSERT INTO ss_target_upload ( target_year,target_month,so_code,dealer_code,target_amount,entry_by,entry_at
) VALUES (
'".$year."','".$mon."','".$info->username."','".$dealer_code."','".$sales_target."','".$entry_by."','".$datetime."'
)";
mysql_query($ss);
}
		
$target_con=0;
$dealer_target=0;
$sales_target=0;
			
}	// end while user list

echo '<div class="alert alert-success p-1" role="alert"> Done </div>';
} // end submit
?>







<form action="" method="post">


<div class="container-fluid bg-form-titel">
    <div class="row">
        <div class="col-sm-1 colo-md-1 col-lg-1 col-xl-1"></div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <div class="form-group row m-0">
                <label class="col-sm-5 col-md-5 col-lg-5 col-xl-5 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Year:</label>
                <div class="col-sm-7 col-md-7 col-lg-7 col-xl-7 p-0">
                    <select name="year" style="width:160px;" id="year" required="required" >
                        <option <?=($year=='2022')?'selected':''?>>2022</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <div class="form-group row m-0">
                <label class="col-sm-5 col-md-5 col-lg-5 col-xl-5 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Month</label>
                <div class="col-sm-7 col-md-7 col-lg-7 col-xl-7 p-0">
                    <select name="mon" style="width:160px;" id="mon" required="required" >
                        <option value="1" <?=($mon=='1')?'selected':''?>>Jan</option>
                        <option value="2" <?=($mon=='2')?'selected':''?>>Feb</option>
                        <option value="3" <?=($mon=='3')?'selected':''?>>Mar</option>
                        <option value="4" <?=($mon=='4')?'selected':''?>>Apr</option>
                        <option value="5" <?=($mon=='5')?'selected':''?>>May</option>
                        <option value="6" <?=($mon=='6')?'selected':''?>>Jun</option>
                        <option value="7" <?=($mon=='7')?'selected':''?>>Jul</option>
                        <option value="8" <?=($mon=='8')?'selected':''?>>Aug</option>
                        <option value="9" <?=($mon=='9')?'selected':''?>>Sep</option>
                        <option value="10" <?=($mon=='10')?'selected':''?>>Oct</option>
                        <option value="11" <?=($mon=='11')?'selected':''?>>Nov</option>
                        <option value="12" <?=($mon=='12')?'selected':''?>>Dec</option>
                    </select>
                </div>
            </div>

        </div>

        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
            <input name="update" class="btn1 btn1-bg-submit" type="submit" id="submit" value="Update" />

        </div>

    </div>
</div>

</form>








  <?
$main_content=ob_get_contents();
ob_end_clean();
include ("../../template/main_layout.php");
?>
