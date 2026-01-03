<?php
session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";  

$table='user_activity_management';
$unique = 'user_id';
$crud      =new crud($table);


$today 			    = date('Y-m-d');
$company_id         = $_SESSION['company_id'];
$menu 			    = 'Target';
$sub_menu 		    = 'target_upload';

$entry_by=$_SESSION['username'];


if($_POST['target_month']!=''){
$target_month=$_POST['target_month'];
}else{
$target_month=date('n');
}

if($_POST['target_year']!=''){
$target_year=$_POST['target_year'];
}else{
$target_year=date('Y');
}







if(isset($_POST["upload"])){
    
$target_year 		= $_POST['target_year'];
$target_month 		= sprintf('%02d', $_POST['target_month']);
//$grp 				= $_POST['grp'];
$entry_at           = date('Y-m-d H:i:s');
$target_period      = $target_year.$target_month;



// delete old upload if exists
$del = "DELETE FROM sale_target_upload WHERE target_year='".$_POST['target_year']."' and target_month='".$_POST['target_month']."' ";
mysql_query($conn,$del); 
// end delete


// 
$sql="SELECT * from item_info where 1";
$res = mysql_query($conn,$sql);
	while($row=mysql_fetch_object($res))
	{
		$fg_code[$row->item_id]     = $row->finish_goods_code;
		$price[$row->item_id]       = $row->t_price;
		$size[$row->item_id]        = $row->pack_size;
	}




$sql="SELECT dealer_code,area_code,zone_id,region_id FROM  dealer_info where 1 order by dealer_code";
$res = mysql_query($conn,$sql);
	while($row=mysql_fetch_object($res))
	{
		$ac[$row->dealer_code] = $row->area_code;
		$zc[$row->dealer_code] = $row->zone_id;
		$rc[$row->dealer_code] = $row->region_id;
	}



$filename=$_FILES["upload_file"]["tmp_name"];
if($_FILES["upload_file"]["tmp_name"]!=""){	
	$file = fopen($filename, "r");

while (($excelData = fgetcsv($file, 500000, ",")) !== FALSE){

if($excelData[5]>0){
    
$dealer_code=$excelData[3];
$item_id    =$excelData[4];
$target_qty =$excelData[5];
			
$sql = "INSERT INTO sale_target_upload (target_year,target_month,target_period,region_id,zone_id,area_id,dealer_code,fg_code,item_id, target_ctn, d_price,target_amount, entry_by, entry_at) 

VALUES('".$target_year."','".$target_month."','".$target_period."',
'".$rc[$dealer_code]."','".$zc[$dealer_code]."','".$ac[$dealer_code]."','".$dealer_code."',
'".$fg_code[$item_id]."', '".$item_id."', '".$target_qty."',
'".$price[$item_id]."','".($excelData[5]*$price[$item_id])."'
,'".$entry_by."', '".$entry_at."'
)";	

mysql_query($sql);
} // end if qty>0



} // end while loop
} // end upload file


fclose($file);
echo "Upload Complete";

    
} // end submit

?>












<form action=""  method="post" enctype="multipart/form-data">
    <div class="d-flex justify-content-center">

        <div class="n-form1 fo-white pt-0">
            <h4 class="text-center bg-titel bold pt-2 pb-2">  Upload Target   </h4>

            <div class="container">

                <div class="form-group row  m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">year :  </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0 pr-2">
                            <span class="oe_form_group_cell">

                    <select name="target_year" style="width:160px;" id="target_year" required="required">
                        <option <?=($target_year=='2021')?'selected':''?>>2021</option>
                        <option <?=($target_year=='2022')?'selected':''?>>2022</option>
                    </select>
                            </span>
                    </div>
                </div>



                <div class="form-group row  m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Month :  </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0 pr-2">

                        <select name="target_month" style="width:160px;" id="target_month" required="required">
                            <option value="1" <?=($target_month=='1')?'selected':''?>>Jan</option>
                            <option value="2" <?=($target_month=='2')?'selected':''?>>Feb</option>
                            <option value="3" <?=($target_month=='3')?'selected':''?>>Mar</option>
                            <option value="4" <?=($target_month=='4')?'selected':''?>>Apr</option>
                            <option value="5" <?=($target_month=='5')?'selected':''?>>May</option>
                            <option value="6" <?=($target_month=='6')?'selected':''?>>Jun</option>
                            <option value="7" <?=($target_month=='7')?'selected':''?>>Jul</option>
                            <option value="8" <?=($target_month=='8')?'selected':''?>>Aug</option>
                            <option value="9" <?=($target_month=='9')?'selected':''?>>Sep</option>
                            <option value="10" <?=($target_month=='10')?'selected':''?>>Oct</option>
                            <option value="11" <?=($target_month=='11')?'selected':''?>>Nov</option>
                            <option value="12" <?=($target_month=='12')?'selected':''?>>Dec</option>
                        </select>

                    </div>
                </div>



                <div class="form-group row  m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Upload File :  </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0 pr-2">
                        <input name="upload_file"  type="file" id="upload_file" required="required"/>
                    </div>
                </div>





            </div>

            <div class="n-form-btn-class">
                <input name="upload"  class="btn1 btn1-bg-submit" type="submit" id="upload" value="Upload File" />
            </div>

        </div>

    </div>






    <div class="container-fluid pt-4">
        <div class="alert alert-warning p-1 m-0 pl-2 pr-2" role="alert">
            CSV File Example:
        </div>

        <table class="table1  table-striped table-bordered table-hover table-sm">
            <thead class="thead1">
            <tr class="bgc-info">
                <td>SL</td>
                <td>Year</td>
                <td>Month</td>
                <td>Dealer Code</td>
                <td>item id</td>
                <td>target pcs</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td >1</td>
                <td>2022</td>
                <td>9</td>
                <td>10003</td>
                <td >100001</td>
                <td >200</td>
            </tr>
            </tbody>
        </table>

    </div>

</form>




















  <?

$main_content=ob_get_contents();

ob_end_clean();
include ("../../template/main_layout.php");
?>
