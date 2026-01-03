<?php

session_start();

ob_start();

require_once "../../../assets/template/layout.top.php";




// ::::: Edit This Section ::::: 



$title='Terms & Condition';			// Page Name and Page Title

do_datatable('table_head');

$page="terms_condition_setup.php";		// PHP File Name



$table='terms_condition_setup';		// Database Table Name Mainly related to this page

$unique='id';			// Primary Key of this Database table

$shown='terms_condition';				// For a New or Edit Data a must have data field



// ::::: End Edit Section :::::



//if(isset($_GET['proj_code'])) $proj_code=$_GET[$proj_code];

$crud      =new crud($table);



$$unique = $_GET[$unique];

if(isset($_POST[$shown]))

{

$$unique = $_POST[$unique];

//for Insert..................................

if(isset($_POST['insert']))

{		

$proj_id			= $_SESSION['proj_id'];

$now				= time();

$entry_by = $_SESSION['user'];

$_POST['ply'] = find_a_field('paper_grade_type','ply',"id=".$_POST['paper_grade_type']);


$crud->insert();

		$id = $_POST['dealer_code'];
		
		if($_FILES['cr_upload']['tmp_name']!=''){ 
		$file_temp = $_FILES['cr_upload']['tmp_name'];
		$folder = "../../images/cr_pic/";
		move_uploaded_file($file_temp, $folder.$id.'.jpg');}


		
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


		$_POST['edit_by'] = $_SESSION['user']['id'];
		 
		 $_POST['edit_at'] = $now=date('Y-m-d H:i:s');
		 
		 $_POST['ply'] = find_a_field('paper_grade_type','ply',"id=".$_POST['paper_grade_type']);


		$crud->update($unique);

		$id = $_POST['dealer_code'];



		if($_FILES['cr_upload']['tmp_name']!=''){ 
		$file_temp = $_FILES['cr_upload']['tmp_name'];
		$folder = "../../images/cr_pic/";
		move_uploaded_file($file_temp, $folder.$id.'.jpg');}


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

<script type="text/javascript">

$(function() {

		$("#fdate").datepicker({

			changeMonth: true,

			changeYear: true,

			dateFormat: 'yy-mm-dd'

		});

});

function Do_Nav()

{

	var URL = 'pop_ledger_selecting_list.php';

	popUp(URL);

}




function DoNav(theUrl)

{

	document.location.href = '<?=$page?>?<?=$unique?>='+theUrl;

}

function popUp(URL) 

{

	day = new Date();

	id = day.getTime();

	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=1,menubar=0,resizable=1,width=800,height=800,left = 383,top = -16');");

}

</script>

<style type="text/css">

<!--

.style1 {color: #FF0000}
.style2 {
	font-weight: bold;
	color: #000000;
	font-size: 14px;
}
.style3 {color: #FFFFFF}

-->

</style>









  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-7">
        <div class="container p-0">
          <form id="form1" name="form1" class="n-form1" method="post" action="">


            <div class="form-group row m-0 pl-3 pr-3">
              <label for="group_for" class="col-sm-3 pl-0 pr-0 col-form-label">Company: </label>
              <div class="col-sm-9 p-0">
                	<select name="group_for" required id="group_for" style="width:250px; float:left;">
						<option></option>
						<? foreign_relation('user_group','id','group_name',$_POST['group_for'],'1');?>
					</select>

              </div>
            </div>

            <div class="n-form-btn-class">
              <input class="btn1 btn1-bg-submit" name="search" type="submit" id="search" value="Show" />
              <input class="btn1 btn1-bg-cancel" name="cancel" type="submit" id="cancel" value="Cancel" />
            </div>

          </form>
        </div>


        <div class="container n-form1">
         
          <table id="table_head" class="table1  table-striped table-bordered table-hover table-sm">
            <thead class="thead1">
            <tr class="bgc-info">
              <th>ID</th>
              <th>Terms & Condition:</th>
              <th style="width: 9%;">Sl No </th>
			  <th>Type</th>
              <th>Status</th>
            </tr>
			
            </thead>

            <tbody class="tbody1">
					<?php
					if($_POST['group_for']!="")
					$con .= 'and a.group_for="'.$_POST['group_for'].'"';				
					if($_POST['warehouse_name']!="")					
					$con .='and a.warehouse_name like "%'.$_POST['warehouse_name'].'%" ';					
					$td='select a.'.$unique.',  a.'.$shown.',  a.sl_no, a.status, a.type from '.$table.' a	where 1  '.$con.' order by a.sl_no  ';					
					$report=mysql_query($td);					
					while($rp=mysql_fetch_row($report)){$i++; if($i%2==0)$cls=' class="alt"'; else $cls='';?>					
					<tr<?=$cls?> onclick="DoNav('<?php echo $rp[0];?>');">
					  	<td><?=$rp[0];?></td>					
						<td><?=$rp[1];?></td>					
						<td><?=$rp[2];?></td>
						<td><?=$rp[4];?></td>
						<td><?=$rp[3];?></td>
					</tr>					
					<?php }?>
            </tbody>
          </table>
				<div id="pageNavPosition"></div>
        </div>

      </div>


      <div class="col-sm-5">
		<form action="" method="post" enctype="multipart/form-data" class="n-form" name="form1" id="form1" onsubmit="return check()">
          <h4 align="center" class="n-form-titel1"> <?=$title?></h4>

									  
          <div class="form-group row m-0 pl-3 pr-3">
            <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label"> Terms & Condition:</label>
            <div class="col-sm-9 p-0">
              	<input name="<?=$unique?>" id="<?=$unique?>" value="<?=$$unique?>" type="hidden" />
                <input name="id" type="hidden" id="id" tabindex="1" value="<?=$id?>" readonly>
                <input name="terms_condition" required type="text" id="terms_condition" tabindex="1" value="<?=$terms_condition?>">	
            </div>
          </div>
	
          <div class="form-group row m-0 pl-3 pr-3">
            <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label">Sl No: </label>
            <div class="col-sm-9 p-0">
             	<input name="sl_no" required type="text" id="sl_no" tabindex="1" value="<?=$sl_no?>" >

            </div>
          </div>

          <div class="form-group row m-0 pl-3 pr-3">
            <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label">Type:  </label>
            <div class="col-sm-9 p-0">

              <select name="type" required id="type"  tabindex="1" style="width:220px;">
                    <option value="<?=$type?>"><?=$type?></option>
					<option value="PO">PO</option>
					<option value="SO">SO</option>
             </select>

            </div>
          </div>
		  
		  <div class="form-group row m-0 pl-3 pr-3">
            <label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label">Status: </label>
            <div class="col-sm-9 p-0">
              <select name="status" required id="status" >
                    <? foreign_relation('activation','id','activation',$status,'1');?>
              </select>

            </div>
          </div>
		  

          <div class="n-form-btn-class">
		  
                      <? if(!isset($_GET[$unique])){?>
                      	<input name="insert" type="submit" class="btn1 btn1-bg-submit" id="insert" value="SAVE" class="btn" />
                      <? }?>
					  
                      <? if(isset($_GET[$unique])){?>
                      	<input name="update" type="submit" class="btn1 btn1-bg-update" id="update" value="UPDATE" class="btn" />
                      <? }?>
                      	<input name="reset" type="button" class="btn1 btn1-bg-cancel" id="reset" value="RESET" onclick="parent.location='<?=$page?>'" />

          </div>
		  
        </form>
		
      </div>
    </div>
  </div>






<script type="text/javascript"><!--

    var pager = new Pager('grp', 10000);

    pager.init();

    pager.showPageNav('pager', 'pageNavPosition');

    pager.showPage(1);

//-->

	document.onkeypress=function(e){

	var e=window.event || e

	var keyunicode=e.charCode || e.keyCode

	if (keyunicode==13)

	{

		return false;

	}

}

</script>




<script>


function duplicate(){

var dealer_code_2 = ((document.getElementById('dealer_code_2').value)*1);

var customer_id = ((document.getElementById('customer_id').value)*1);



   if(dealer_code_2>0)
  {
  
alert('This customer code already exists.');
document.getElementById('customer_id').value='';


document.getElementById('customer_id').focus();

  } 



}

</script>

<?

$main_content=ob_get_contents();

ob_end_clean();

include ("../../template/main_layout.php");

?>