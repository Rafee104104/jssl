<?php


require_once "../../../assets/template/layout.top.php";




$title='PO File Upload';			// Page Name and Page Title

$page="ref_info_input.php"; 		// PHP File Name



$table='purchase_master';		// Database Table Name Mainly related to this page

$unique='po_no';			// Primary Key of this Database table

$shown='po_no';				// For a New or Edit Data a must have data field



// ::::: End Edit Section :::::


$crud      =new crud($table);



$$unique = $_GET[$unique];

if(isset($_POST[$shown]))

{

$$unique = $_POST[$unique];



if(isset($_POST['insert']))

{		

$proj_id			= $_SESSION['proj_id'];

$now				= time();

$entry_by = $_SESSION['user'];



$id = $_POST['RPERSON_ID'];
		
		if($_FILES['pp']['tmp_name']!=''){ 
		$file_temp = $_FILES['pp']['tmp_name'];
		$folder = "../../pp_pic/pp/";
		move_uploaded_file($file_temp, $folder.$id.'.jpg');}
		
		if($_FILES['np']['tmp_name']!=''){ 
		$file_temp = $_FILES['np']['tmp_name'];
		$folder = "../../np_pic/np/";
		move_uploaded_file($file_temp, $folder.$id.'.jpg');}
		
		if($_FILES['spp']['tmp_name']!=''){ 
		$file_temp = $_FILES['spp']['tmp_name'];
		$folder = "../../spp_pic/spp/";
		move_uploaded_file($file_temp, $folder.$id.'.jpg');}
		
		if($_FILES['nsp']['tmp_name']!=''){ 
		$file_temp = $_FILES['nsp']['tmp_name'];
		$folder = "../../nsp_pic/nsp/";
		move_uploaded_file($file_temp, $folder.$id.'.jpg');}
$type=1;

$msg='New Entry Successfully Inserted.';

unset($_POST);

unset($$unique);

}





//for Modify..................................



if(isset($_POST['update']))

{



		$crud->update($unique);

$id = $_POST['RPERSON_ID'];
		
		if($_FILES['pp']['tmp_name']!=''){ 
		$file_temp = $_FILES['pp']['tmp_name'];
		$folder = "../../pp_pic/pp/";
		move_uploaded_file($file_temp, $folder.$id.'.jpg');}
		
		if($_FILES['np']['tmp_name']!=''){ 
		$file_temp = $_FILES['np']['tmp_name'];
		$folder = "../../np_pic/np/";
		move_uploaded_file($file_temp, $folder.$id.'.jpg');}
		
		if($_FILES['spp']['tmp_name']!=''){ 
		$file_temp = $_FILES['spp']['tmp_name'];
		$folder = "../../spp_pic/spp/";
		move_uploaded_file($file_temp, $folder.$id.'.jpg');}
		
		if($_FILES['nsp']['tmp_name']!=''){ 
		$file_temp = $_FILES['nsp']['tmp_name'];
		$folder = "../../nsp_pic/nsp/";
		move_uploaded_file($file_temp, $folder.$id.'.jpg');}

		$type=1;

		$msg='Successfully Updated.';

}

//for Delete..................................



if(isset($_POST['delete']))

{		$condition=$unique."=".$$unique;		$crud->delete($condition);

		unset($$unique);

		$type=1;

		$msg='Successfully Deleted.';

}

}



if(isset($$unique))

{

$condition=$unique."=".$$unique;

$data=db_fetch_object($table,$condition);

while (list($key, $value)=each($data))

{ $$key=$value;}

}

if(!isset($$unique)) $$unique=db_last_insert_id($table,$unique);


if (isset($_POST['updates'])) {
    $now = time();
    $so_file = "quotation-" . $now;

    if (!empty($_FILES['doc_file']['tmp_name'])) {
        $file_exten = explode(".", $_FILES['doc_file']['name']);
        $extension = count($file_exten) > 1 ? end($file_exten) : '';
        $img_file_name = $extension ? $so_file . "." . $extension : $so_file;
        $img_file_name_temp = $_FILES['doc_file']['tmp_name'];

        $upload_dir = "../../../../../media/jssl/purchase_mod/quotation/";
        $upload_path = $upload_dir . $img_file_name;

        // Ensure directory ends with / and exists
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        if (move_uploaded_file($img_file_name_temp, $upload_path)) {
            // File uploaded successfully, now update DB
            $po_no = $_POST['po_no'];  // No need for intval; it's not a number (it's a string like PO123)
            $file_name_for_db = $img_file_name;

            $sql = "UPDATE purchase_master SET quotation_pic = '$file_name_for_db' WHERE po_no = '$po_no'";
            if (mysql_query($sql)) {
                echo "<script>alert('File uploaded and database updated successfully.');</script>";
            } else {
                echo "<script>alert('Database update failed!');</script>";
            }
        } else {
            echo "<script>alert('File upload failed!');</script>";
        }
    } else {
        echo "<script>alert('No file selected.');</script>";
    }
}


?>

<script type="text/javascript"> function DoNav(lk){
	window.open('../../pages/dealer<?=$root?>/<?=$input_page?>?<?=$unique?>='+lk);
	}</script>


<form action="" method="post"  enctype="multipart/form-data" >
	
					<div class="p-2">
                        <label> PO No:</label>
						<input type="text" required list="dealer" name="po_no"  id="po_no" />
                        <datalist id="dealer" >
						
						<?=foreign_relation('purchase_master','po_no','po_no',$po_no,'1');?>
						</datalist>
                      </div>
					  
					  <div class="p-2">
                        <label> File Upload : <p style="color:red;">(Max Size 400KB) </p></label>
						
                        <input name="doc_file" required type="file" id="doc_file" tabindex="2" style=" position: unset; opacity: unset; border: 1px solid #cbc8c8; border-radius: 5px; padding: 5px; " >
                      </div>
					  
					  
					  <div class="button">
                    
                      <input name="updates" type="submit" id="updates" value="Update" class="btn btn-info" />
                    
                     </div>
</form>

       
   
 <!--   <td valign="top"><form action="" method="post"  enctype="multipart/form-data" >
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td colspan="2"><fieldset>
                      <legend>
                      <?=$title?>
                      </legend>
                      <div> </div>
                      <div class="buttonrow"></div>
                      <div>
                        <label> Dealer Code:</label>
                        <input name="<?=$unique?>" id="<?=$unique?>" value="<?=$$unique?>" type="hidden" />
                        <input name="dealer_code" type="text" id="dealer_code" tabindex="1" value="<?=$dealer_code?>"  required>
                      </div>
					  
					   
					  
                      <div>
                        <label> Dealer Name :</label>
                        <input name="dealer_name_e" type="text" id="dealer_name_e" tabindex="2" value="<?=$dealer_name_e?>">
                      </div>
                      <div>
                      <label>Propritor's name</label>
                      <input name="propritor_name_e" type="text" id="propritor_name_e" tabindex="2" value="<?=$propritor_name_e?>">
                      </div>
                      <div></div>
                      <div>
                        <label>Dealer Type:</label>
                        <select name="dealer_type"  id="dealer_type" style="width:150px;"  required >
                          <option></option>
                          <? foreign_relation('dealer_type','id','dealer_type',$dealer_type);?>
                          
                        </select>
                      </div>
                      <div>
                        <label> Address:</label>
                        <input name="address_e" type="text" id="dealer_name_e" tabindex="4" value="<?=$address_e?>">
                      </div>
                      <div>
                        <label> National ID:</label>
                        <input name="national_id" type="text" id="national_id" tabindex="6" value="<?=$national_id?>">
                      </div>
                      <div>
                      <label>Depot Name:</label>
                      <select name="depot" required id="depot" style="width:200px;" tabindex="7">

                      <? foreign_relation('warehouse','warehouse_id','warehouse_name',$depot,' warehouse_type != "Purchase"');?>
                    </select>
                      </div>
                      <div>
                        <label> Mobile No:</label>
                        <input name="mobile_no" type="text" id="mobile_no" tabindex="8" value="<?=$mobile_no?>">
                      </div>
                      <div>
                        <label> Commission:</label>
                        <input name="commission" type="text" id="commission" tabindex="9" value="<?=$commission?>">
                      </div>
					  
					  
                    
					  
					  
					  
					  <div>



                        <label>Accounts Ledger:</label>



						<?php 

						$last_id=find_a_field('dealer_info','max(dealer_code)','1')+1;

						?>



                        <input name="account_code" type="text" readonly id="account_code" value="<?php if($$unique==$last_id){



						echo $account_code=next_ledger_ids('1004');



						} else {



						echo $account_code;}?>" />

                      </div>
					  
					  
					  
					  
					  <div>
                      <label>Division:</label>
                      <select name="region_code" required id="region_code" style="width:200px;" tabindex="7">
					  <option></option>

                   	   <? foreign_relation('branch','BRANCH_ID','BRANCH_NAME',$region_code,'1');?>
                    </select>
                      </div>
					  
					  
					  <div>
                      <label>Zone:</label>
                      <select name="zone_code" required id="zone_code" style="width:200px;" tabindex="7">
					  <option></option>

                   	   <? foreign_relation('zon','ZONE_CODE','ZONE_NAME',$zone_code,'1');?>
                    </select>
                      </div>
					  
					  
                      <div>
                      <label>Territory:</label>
                      <select name="area_code" id="area_code" style="width:200px;" tabindex="11">

                      <? 

					echo  $sql = 'select a.AREA_CODE,a.AREA_NAME,z.ZONE_NAME,b.BRANCH_NAME from area a,zon z, branch b where a.ZONE_ID = z.ZONE_CODE and z.REGION_ID = b.BRANCH_ID order by a.AREA_NAME';

					  $res=mysql_query($sql);

					  echo '<option></option>';

					  while($d = mysql_fetch_row($res)){

if($area_code==$d[0])

echo '<option value="'.$d[0].'" selected>'.$d[1].' [Zone: '.$d[2].'] [Region: '.$d[3].']</option>';

else

echo '<option value="'.$d[0].'">'.$d[1].' [Zone: '.$d[2].'] [Region: '.$d[3].']</option>';

					  }

					  ?>
                      </select>
                      </div>
					  
					  
                      <div></div>
<div>
  <label>Status:</label>
                        <select name="canceled" id="canceled"  style="width:150px;" tabindex="12">

                      <option <?=($canceled=='Yes')?'Selected':'';?>>Yes</option>

                      <option <?=($canceled=='No')?'Selected':'';?> >No</option>
                    </select>
                    </div>
                      <div></div>
                    </fieldset></td>
                
                </tr>
              

                
              </table></td>
          </tr>
          <tr>
            <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><div class="button">
                      <? if(!isset($_GET[$unique])){?>
                      <input name="insert" type="submit" id="insert" value="Save" class="btn" />
                      <? }?>
                    </div></td>
                  <td><div class="button">
                      <? if(isset($_GET[$unique])){?>
                      <input name="update" type="submit" id="update" value="Update" class="btn" />
                      <? }?>
                    </div></td>
                  <td><div class="button">
                      <input name="reset" type="button" class="btn" id="reset" value="Reset" onclick="parent.location='<?=$page?>'" />
                    </div></td>
                  <td>
                  <div class="button">
                      <input class="btn" name="delete" type="submit" id="delete" value="Delete"/>
                    </div>
                    </td>
                </tr>
              </table></td>
          </tr>
        </table>
      </form></td>-->
 <script>

const uploadField = document.getElementById("doc_file");

uploadField.onchange = function() {
    if(this.files[0].size >= 409600){
       alert("File is too big!");
       this.value = "";
    }
}
</script>
<?

require_once "../../../assets/template/layout.bottom.php";

?>
