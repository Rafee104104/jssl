<?php

session_start();

ob_start();

require_once "../../../assets/template/layout.top.php";


$page = 'license_document_list.php';
$inputPage = 'add_documents.php'; 

$title='All Enlisted License Documents List';			// Page Name and Page Title


$table='license_documents';		


do_datatable('example');

?>


    <div class="container-fluid">
        
        <div class="row">
            <div class="col-sm-12 text-right mb-3">
                <a href="<?=$inputPage?>" class="btn btn-success"><i class="fa fa-plus"></i> Add</a> 
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-12">
                
                <table id="example" class="table1 table-striped table-bordered table-hover table-sm">
                    <thead class="thead1">
				        <tr class="bgc-info">
				            <th>SN</th>
				            <th>Name</th>
				            <th>Expiry Date</th>
				            <th>Attachment</th>
				            <th>Entry By</th>
				            <th>Entry At</th>
				            <th>Action</th>
				        </tr>
				    </thead>
				    <tbody class="tbody1">
				        
				        <?php
				        
				            $sn=1;
				            $sql = "SELECT * FROM $table";
				            $rslt = mysql_query($sql);
				            while($data = mysql_fetch_object($rslt)){
				                
				                $lInf = find_all_field('license_all_records', '', 'id="'.$data->license_no.'"');
				                
				        ?>
				        
				        <tr>
				            <td><?=$sn?></td>
				            <td><?=$lInf->name?></td>
				            <td><?=$lInf->expire_date?></td>
				            <td><a href="../attachments/<?=$data->attachment?>" class="btn btn-md btn-info" target="_blank">View</a></td>
				            <td><?=find_a_field('user_activity_management', 'fname', 'user_id="'.$data->entry_by.'"')?></td>
				            <td><?=$data->entry_at?></td>
				            <td><a class="btn btn-xs <?php if($data->is_active==1){echo 'btn-warning';}else{echo 'btn-danger';}?>" href="<?=$inputPage?>?update=<?=$data->id?>"><i class="fa fa-pencil"></i></a></td>
				        </tr>
				        
				        <?php $sn++; } ?>
				        
				    </tbody>
                </table>
                
            </div>
        </div>
    </div>


<?

$main_content=ob_get_contents();

ob_end_clean();

include ("../../template/main_layout.php");

?>