<?php

require_once "../../../assets/template/layout.top.php";



// ::::: Edit This Section ::::: 



$title='Add Zone Information';			// Page Name and Page Title

$page="zone.php";		// PHP File Name



$table='zon';		// Database Table Name Mainly related to this page

$unique='ZONE_CODE';			// Primary Key of this Database table

$shown='ZONE_NAME';				// For a New or Edit Data a must have data field

$tr_type="show";

$tr_from="Sales";

// ::::: End Edit Section :::::



//if(isset($_GET['proj_code'])) $proj_code=$_GET[$proj_code];

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



$crud->insert();

$tr_type="Add";
$id = $_POST['dealer_code'];
		
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



// for update

if(isset($_POST['update']))
{

 $sql="update zon set ZONE_NAME='".$_POST['ZONE_NAME']."', REGION_ID='".$_POST['REGION_ID']."' where ZONE_CODE='".$_POST['ZONE_CODE']."' ";

mysql_query($sql);
$tr_type="Add";
}


//for Modify..................................



if(isset($_POST['update']))

{

    

		$crud->update($unique);

		//$tr_type="Add";

$id = $_POST['dealer_code'];
		
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

?>
<script type="text/javascript"> function DoNav(lk){document.location.href = '<?=$page?>?<?=$unique?>='+lk;}



function popUp(URL) 

{

day = new Date();

id = day.getTime();

eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=1,menubar=0,resizable=1,width=800,height=800,left = 383,top = -16');");

}

</script>



<div class="container-fluid">
    <div class="row">
        <div class="col-sm-7">
            <div class="container p-0">
                <!--<form id="form1" name="form1" class="n-form1" method="post" action="">


                    <div class="form-group row m-0 pl-3 pr-3">
                        <label for="group_for" class="col-sm-3 pl-0 pr-0 col-form-label">Input field Name</label>
                        <div class="col-sm-9 p-0">
                             input field PhP code type hear

                        </div>
                    </div>

                    <div class="n-form-btn-class">
                        <input class="btn1 btn1-bg-submit" name="search" type="submit" id="search" value="Show" />
                        <input class="btn1 btn1-bg-cancel" name="cancel" type="submit" id="cancel" value="Clear" />
                    </div>

                </form>-->
            </div>


            <div class="container n-form1">
             	<table width="100%" border="0" cellspacing="0" cellpadding="0">

					<tr>
					  <td >
						  <? 	$res='select '.$unique.','.$unique.','.$shown.'  from '.$table;
		
													echo $crud->link_report($res,$link);?>
						
						 </td>
					</tr>
          </table>

            </div>

        </div>


        <div class="col-sm-5">
            
            <form id="form1" name="form1" class="n-form" method="post" action="">
                <h4 align="center" class="n-form-titel1 text-uppercase"> <?=$title?></h4>

                <div class="form-group row m-0 pl-3 pr-3 p-1">
                    <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label"> Thana Code:</label>
                    <div class="col-sm-9 p-0">
                        <input name="<?=$unique?>" id="<?=$unique?>" value="<?=$$unique?>" type="text"  readonly/>


                    </div>
                </div>

                <div class="form-group row m-0 pl-3 pr-3 p-1">
                    <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label">Thana Name: </label>
                    <div class="col-sm-9 p-0">
                        <input name="ZONE_NAME" type="text" id="ZONE_NAME" tabindex="2" value="<?=$ZONE_NAME?>">

                    </div>
                </div>

                <div class="form-group row m-0 pl-3 pr-3 p-1">
                    <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label">District: </label>
                    <div class="col-sm-9 p-0">

                        <select id="REGION_ID" name="REGION_ID">
						<option></option>
                         <?php foreign_relation('branch', 'BRANCH_ID', 'BRANCH_NAME', $REGION_ID); ?>
					    </select>

                    </div>
                </div>

                <div class="n-form-btn-class">
                   <? if(!isset($_GET[$unique])){?>
                        <input name="insert" type="submit" id="insert" value="Save" class="btn1 btn1-bg-submit" />
                        <? }?>
                      
                    
                        <? if(isset($_GET[$unique])){?>
                        <input name="update" type="submit" id="update" value="Update" class="btn1 btn1-bg-update" />
                        <? }?>
                   
                    
                        <input name="reset" type="button" class="btn1 btn1-bg-cancel " id="reset" value="Reset" onclick="parent.location='<?=$page?>'" />

                </div>


            </form>

        </div>

    </div>

</div>






<?php /*?><div class="form-container_large">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td valign="top"><div class="left">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><div class="tabledesign" style="height:787px;">
                  <? 	$res='select '.$unique.','.$unique.','.$shown.'  from '.$table;

											echo $crud->link_report($res,$link);?>
                </div>
                 </td>
            </tr>
          </table>
        </div></td>
      <td valign="top"><form action="" method="post"  enctype="multipart/form-data" >
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td colspan="2"><fieldset style="width:362px;">
                      <legend>
                      <?=$title?>
                      </legend>
                      <div class="buttonrow"></div>
                      <div>
                        <label> ZONE CODE:</label>
                        <input name="<?=$unique?>" id="<?=$unique?>" value="<?=$$unique?>" type="text"  readonly/>
                      </div>
                      <div>
                        <label> ZONE NAME:</label>
                        <input name="ZONE_NAME" type="text" id="ZONE_NAME" tabindex="2" value="<?=$ZONE_NAME?>">
                      </div>
                      <div></div>
					  <div>
                        <label>Under Region</label>
						<select id="REGION_ID" name="REGION_ID">
						<option></option>
                         <?php foreign_relation('branch', 'BRANCH_ID', 'BRANCH_NAME', $REGION_ID); ?>
					    </select>
                      </div>
                      <!--<div>
                        <label>ZSM</label>
						<select id="area_asm_name" name="area_asm_name">
						<option></option>
                         <?php foreign_relation('personnel_basic_info', 'PBI_ID', 'PBI_NAME', $area_asm_name,' PBI_DESIGNATION=5'); ?>
					    </select>
                      </div>-->
                      </fieldset></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><div>
                        <? if(!isset($_GET[$unique])){?>
                        <input name="insert" type="submit" id="insert" value="Save" class="btn1 btn1-bg-submit" />
                        <? }?>
                      </div></td>
                    <td><div>
                        <? if(isset($_GET[$unique])){?>
                        <input name="update" type="submit" id="update" value="Update" class="btn1 btn1-bg-update" />
                        <? }?>
                      </div></td>
                    <td><div>
                        <input name="reset" type="button" class="btn1 btn1-bg-cancel " id="reset" value="Reset" onclick="parent.location='<?=$page?>'" />
                      </div></td>
                    <td><!--<div class="button">
                      <input class="btn" name="delete" type="submit" id="delete" value="Delete"/>
                    </div>-->
                    </td>
                  </tr>
                </table></td>
            </tr>
          </table>
        </form></td>
    </tr>
  </table>
</div><?php */?>
<?

require_once "../../../assets/template/layout.bottom.php";

?>
