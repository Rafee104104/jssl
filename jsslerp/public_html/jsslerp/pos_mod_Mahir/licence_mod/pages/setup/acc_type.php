<?php

session_start();

ob_start();

require_once "../../../assets/template/layout.top.php";


// ::::: Edit This Section ::::: 


$page = 'acc_type.php';

$title='Document Type List';			// Page Name and Page Title


$table='license_type';		

$unique='id';		

$shown='name';

do_datatable('example');

$crud = new crud($table);

if(isset($_POST['insert'])){
    $_POST['entry_by'] = $_SESSION['user']['id'];
    
    $crud->insert();
    
}

if(isset($_POST['update'])){
    $_POST['update_by'] = $_SESSION['user']['id'];
    $_POST['update_by'] = date('Y-m-d H:i:s');
    
    $crud->update('id');
}

$datas = find_all_field($table, '', 'id="'.$_GET['update'].'"');

?>

<script type="text/javascript">

$(function() {

		$("#fdate").datepicker({

			changeMonth: true,

			changeYear: true,

			dateFormat: 'yy-mm-dd'

		});

});





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

            <div class="container n-form1">
			<table id="example" class="table1 table-striped table-bordered table-hover table-sm">
				<thead class="thead1">
				<tr class="bgc-info">
					<th>SN</th>
					<th>Name</th>
					<th>Entry By</th>
					<th>Entry At</th>
					<th>Action</th>
				</tr>
				</thead>

				<tbody class="tbody1">

                <?php
                
                
                
                $td='SELECT *  FROM '.$table;
                
                $report=mysql_query($td);
                
                while($rp=mysql_fetch_object($report)){$i++; if($i%2==0)$cls=' class="alt"'; else $cls='';?>
                
                <tr<?=$cls?>>
                    <td><?=$i?></td>
                    <td align="left"><?=$rp->name?></td>
                    <td align="left"><?=find_a_field('user_activity_management','fname','user_id='.$rp->entry_by)?></td>
                    <td align="left"><?=$rp->entry_at?></td>
                    <td align="left"><a class="btn btn-xs <?php if($rp->is_active==1){echo 'btn-warning';}else{echo 'btn-danger';}?>" href="<?=$page.'?update='.$rp->id?>"><i class="fa fa-pencil"></i></a></td>
                </tr>
                
                <?php } ?>


				
				</tbody>
			</table>
			
			
                <div id="pageNavPosition"></div>
				
				

            </div>

        </div>


        <div class="col-sm-5">
		<form class="n-form" action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check()">
			
                <h4 align="center" class="n-form-titel1"> <?php if($datas->id > 0){echo 'Update';}else{echo 'Add';} ?> Document Type</h4>

                <div class="form-group row m-0 pl-3 pr-3">
                    <label for="name" class="req-input col-sm-4 pl-0 pr-0 col-form-label ">Type Name:</label>
                    <div class="col-sm-8 p-0">
                        <input name="name" required type="text" id="name" tabindex="1" value="<?=$datas->name?>" >	
                    </div>
                </div>
				
				<div class="form-group row m-0 pl-3 pr-3">
                    <label for="is_active" class="req-input col-sm-4 pl-0 pr-0 col-form-label">Status:</label>
                    <div class="col-sm-8 p-0">
					
							<select name="is_active" required id="is_active" tabindex="2">
										
                      			<option value=""></option>
                      			<option value="1" <?php if($datas->is_active==1){echo 'selected';} ?>>Active</option>
                      			<option value="0" <?php if($datas->is_active==0){echo 'selected';} ?>>Inactive</option>
                    		</select>

                    </div>
                </div>


                <div class="n-form-btn-class">
			
                      <? if($datas->id > 0){?>
                      <input type="hidden" name="id" value="<?=$datas->id?>">
                      <input name="update" type="submit" id="update" value="UPDATE" class="btn1 btn1-bg-update" />
                      <? }else{?>
                      <input name="insert" type="submit" id="insert" value="SAVE" class="btn1 btn1-bg-submit" />
                      <? }?>
                      <input name="reset" type="button" class="btn1 btn1-bg-cancel" id="reset" value="RESET" onclick="location.href='<?=$page?>'" />
                 
                </div>


            </form>

        </div>

    </div>




</div>





<?

$main_content=ob_get_contents();

ob_end_clean();

include ("../../template/main_layout.php");

?>