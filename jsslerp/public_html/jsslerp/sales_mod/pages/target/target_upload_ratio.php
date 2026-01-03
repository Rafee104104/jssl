<?php
session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";  

$title="Target Ratio File Upload";
$today 			  = date('Y-m-d');
$company_id   = $_SESSION['company_id'];
$menu 			  = 'Target';
$sub_menu 		= 'target_upload_ratio';
$tr_type="Show";

if($_POST['target_month']!=''){
$target_month=$_POST['target_month'];}
else{
$target_month=date('n');
}

if($_POST['target_year']!=''){
$target_year=$_POST['target_year'];}
else{
$target_year=date('Y');
}




if(isset($_POST["upload"])){

$product_group 		= $_POST['product_group'];    
$target_year 		= $_POST['target_year'];
$target_month 		= sprintf('%02d', $_POST['target_month']);
$now = date('Y-m-d H:i:s');


// delete old upload if exists
$del = "DELETE FROM ss_target_ratio WHERE target_year='".$_POST['target_year']."' and target_month='".$_POST['target_month']."' 
and product_group='".$_POST['product_group']."'
";
mysql_query($del); 
// end delete


$filename=$_FILES["upload_file"]["tmp_name"];
	if($_FILES["upload_file"]["tmp_name"]!=""){
	//echo '<span style="color: red;">Excel File Successfully Imported</span>';
	$file = fopen($filename, "r");

while (($excelData = fgetcsv($file, 50000, ",")) !== FALSE){
    

if($excelData[1]>0){
        $sql = "INSERT IGNORE INTO ss_target_ratio (target_year,target_month, product_group,emp_code,emp_name,dealer_code,dealer_name, target_con, entry_by, entry_at)
        VALUES ('".$_POST['target_year']."', '".$_POST['target_month']."','".$_POST['product_group']."', '".$excelData[1]."', 
          '".$excelData[2]."', '".$excelData[3]."','".$excelData[4]."'
		,'".$excelData[5]."','".$entry_by."', '".$entry_at."'   )";	
        
  mysql_query($sql);
}		


} // end while loop
} // end upload file
fclose($file);
$msg =  "Target Ratio Upload Complete";

} // END Upload File




if(isset($_POST["replace"])){

$product_group 		 = $_POST['product_group'];    
$target_year 		   = $_POST['target_year'];
$target_month 		 = sprintf('%02d', $_POST['target_month']);
$now               = date('Y-m-d H:i:s');



$filename=$_FILES["upload_file"]["tmp_name"];
	if($_FILES["upload_file"]["tmp_name"]!=""){
	//echo '<span style="color: red;">Excel File Successfully Imported</span>';
	$file = fopen($filename, "r");

while (($excelData = fgetcsv($file, 50000, ",")) !== FALSE){
  
  
// delete single file if exist
$del = "DELETE FROM ss_target_ratio WHERE target_year='".$_POST['target_year']."' and target_month='".$_POST['target_month']."' 
and product_group='".$_POST['product_group']."' and emp_code='".$excelData[1]."'
";
mysql_query($del); 
// end delete
    

if($excelData[1]>0){
        $sql = "INSERT IGNORE INTO ss_target_ratio (target_year,target_month, product_group,emp_code,emp_name,dealer_code,dealer_name, target_con, entry_by, entry_at)
        VALUES ('".$_POST['target_year']."', '".$_POST['target_month']."','".$_POST['product_group']."', '".$excelData[1]."', '".$excelData[2]."', '".$excelData[3]."','".$excelData[4]."'
		,'".$excelData[5]."','".$entry_by."', '".$entry_at."'   )";	
        
        mysql_query($sql);
}		


} // end while loop
} // end upload file


fclose($file);
$msg =  "Target Ratio Added Ok";

} // END Replce File



// copy this month to next month
if(isset($_POST["setnew"])){

$product_group 		= $_POST['product_group'];    
$target_year 		= $_POST['target_year'];
$target_month 		= $_POST['target_month'];
$now          = date('Y-m-d H:i:s');



if($target_month==12){
$new_month=1;
$new_year=$target_year+1;
}else{
$new_month=$target_month+1;
$new_year=$target_year;
}

// delete old upload if exists
$del = "DELETE FROM ss_target_ratio WHERE target_year='".$new_year."' and target_month='".$new_month."' 
and product_group='".$_POST['product_group']."'
";
mysql_query($del); 
// end delete


$sql="select * from ss_target_ratio where target_year='".$target_year ."' and target_month='".$target_month."' and product_group='".$product_group."'";
$query=mysql_query($sql);
while($data=mysql_fetch_object($query)){

$ss="insert ignore into ss_target_ratio(target_year,target_month,product_group,emp_code,emp_name,dealer_code,dealer_name,target_con,entry_by,entry_at)
values
('".$new_year."','".$new_month."','".$product_group."','".$data->emp_code."','".$data->emp_name."','".$data->dealer_code."','".$data->dealer_name."','".$data->target_con."','".$entry_by."','".$entry_at."')
";
mysql_query($ss);		

} // end while
$msg =  "New Month contribution file make Complete";
} // end next month

$tr_from="Sales";
?>












<?php if(isset($msg)){  ?><div class="alert alert-primary" role="alert"><?php echo @$msg; ?></div><?php } ?>
<?php if(isset($emsg)){  ?><div class="alert alert-danger" role="alert"><?php echo @$emsg; ?></div><?php } ?>

<form  action=""  method="post" enctype="multipart/form-data">
    <div class="d-flex justify-content-center">

        <div class="n-form1 fo-white pt-0">
            <h4 class="text-center bg-titel bold pt-2 pb-2">  Target Ratio File Upload   </h4>

            <div class="container">

                <div class="form-group row  m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Year :  </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0 pr-2">
                            <span class="oe_form_group_cell">

                                <select name="target_year" id="target_year" required="required">
                                    <option <?=($target_year=='2022')?'selected':''?>>2022</option>
                                </select>

                            </span>
                    </div>
                </div>



                <div class="form-group row  m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Month :  </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0 pr-2">

                        <select name="target_month" id="target_month" required="required">
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
                    <label for="group_for" class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Group :  </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0 pr-2">
                        <select name="product_group"  id="product_group" required="required">
                            <option <?=($product_group=='A')?'selected':''?>>A</option>
                            <option <?=($product_group=='B')?'selected':''?>>B</option>
                            <option <?=($product_group=='C')?'selected':''?>>C</option>
                        </select>

                    </div>
                </div>




                <div class="form-group row  m-0 mb-1 pl-3 pr-3">
                    <label for="group_for" class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Upload File :  </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0 pr-2">
                        <input name="upload_file"  type="file" id="upload_file" <? if($_POST['upload']){ ?>required="required"<? } ?>/>

                    </div>
                </div>





            </div>

            <div class="n-form-btn-class">
                <input name="replace" type="submit" id="replace" class="btn1 btn1-bg-submit" value="Upload File(Replace DATA)" />
                <br/>
                <div class="alert alert-primary p-1 pl-2 pr-2 m-0" role="alert">
                    (Note: additional data can be use this button)
                </div>
            </div>


            <div class="n-form-btn-class">
                <input name="upload" type="submit" id="upload" class="btn1 btn1-bg-cancel" value="Upload File(Delete old full data)" />
                <br/>
                <div class="alert alert-warning p-1 pl-2 pr-2 m-0" role="alert">
                    Note: All group data delete then insert this file.
                </div>
            </div>


            <div class="n-form-btn-class">
                <input name="setnew" type="submit" id="setnew" class="btn1 btn1-bg-update" value="Copy to New Month" />
                <br/>
                <div class="alert alert-danger p-1 pl-2 pr-2 m-0" role="alert">
                    Note: This button help to make next month contribution file automatically.
                </div>
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
                <td>SO Code</td>
                <td>SO Name</td>
                <td>Dealer Code </td>
                <td>Dealer Name </td>
                <td>Target Ratio</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>26194</td>
                <td>Karim</td>
                <td>17458</td>
                <td>Ma Enterprise</td>
                <td>48</td>
            </tr>
            </tbody>
        </table>

    </div>

    <div class="alert alert-secondary" role="alert">
        Note: Some dealer point present multi Field Officer.
        <br/>
        Thats why we have to manage them to provide individual target setup.
        So use this target contribution for that.
    </div>

</form>





















  <?
require_once "../../../assets/template/layout.bottom.php";
?>
