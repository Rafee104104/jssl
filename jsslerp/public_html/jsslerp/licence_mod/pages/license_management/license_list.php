<?php

session_start();

ob_start();

require_once "../../../assets/template/layout.top.php";


$page = 'license_list.php';
$inputPage = 'add_edit_license.php'; 

$title='All Enlisted License List';			// Page Name and Page Title


$table='license_all_records';		


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
				            <th>Issue Date</th>
				            <th>Expiry Date</th>
				            <th>Status</th>
				            <th>Details</th>
				            <!--<th>Attachment</th>-->
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
				                
				        ?>
				        
				        <tr>
				            <td><?=$sn?></td>
				            <td><?=$data->name?></td>
				            <td><?=$data->issue_date?></td>
				            <td><?php $eD=$data->expire_date; echo $eD; ?></td>
				            <td>
				                <?php 
				                    
				                    if($data->is_active==1){
    				                    $dt1 = new DateTime("now");
                                        $dt2 = new DateTime($eD);
                                        $diffval = $dt1->diff($dt2);
    				                    if($dt1 >= $dt2){
    				                        echo 'Expired';
    				                        if(intval($diffval->format('%y')) > 0){
    				                            echo $diffval->format(' %y year(s)');
    				                        }
    				                        if(intval($diffval->format('%m')) > 0){
    				                            echo $diffval->format(' %m month(s)');
    				                        }
    				                        if(intval($diffval->format('%d')) > 0){
    				                            echo $diffval->format(' %d day(s)');
    				                        }
    				                        echo ' ago';
    				                    }else{
    				                        if(intval($diffval->format('%y')) > 0){
    				                            echo $diffval->format(' %y year(s)');
    				                        }
    				                        if(intval($diffval->format('%m')) > 0){
    				                            echo $diffval->format(' %m month(s)');
    				                        }
    				                        if(intval($diffval->format('%d')) > 0){
    				                            echo $diffval->format(' %d day(s)');
    				                        }
    				                        echo ' remaining';
    				                    }
				                    }else{
				                        echo 'Inactive';
				                    }
				                    
				                    
				                ?>
				            </td>
				            <td><?=$data->description?></td>
				            <!--<td><?php //if($data->attachment!=NULL){echo '<a href="../attachments/'.$data->attachment.'" target="_blank">View</a>';}else{echo 'None';}?></td>-->
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