<?php

require_once "../../../assets/template/layout.top.php";

$title = "All Product List";

$user_name = find_a_field('user_activity_management','username','user_id="'.$_SESSION['user']['id'].'"');

$_SESSION['employee_selected'] = find_a_field('user_activity_management','PBI_ID','user_id="'.$_SESSION['user']['id'].'"');


 $cur = '&#x9f3;';
 
 
 require "../include/custom.php";
 
 
 $table = 'crm_property_list';
 

 
 

?>



    <script type="text/javascript" src="../../../assets/js/bootstrap.min.js"></script>
    
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="form-group text-right">
                <a href="property_list.php" class="btn btn-danger text-white">Refresh</a>
                <a href="add_property.php" class="btn btn-primary text-white">Add New</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            
            <table id="example">
                <thead>
                    <tr>
                        <th>Sn</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Project</th>
                        <th>Area</th>
                        <th>Min Budget</th>
                        <th>Max Budget</th>
                        <th>Entry by</th>
                        <th>Entry at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    
                    <?php
                    
                        $productsQry = "SELECT * FROM $table ORDER BY id";
                        $productRslt = mysql_query($productsQry);
                        $sn = 1;
                        while($products = mysql_fetch_object($productRslt)){
                        
                    ?>
                    
                    <tr>
                        <td><?=$products->id?></td>
                        <td><?=$products->property_name?></td>
                        <td><?if($products->property_type == '1'){echo "Commercial";}elseif($products->property_type == '2'){echo "Plot";}else{echo "Residential";}?></td>
                        <td><?=find_a_field('crm_project_list', 'project_name', 'id="'.$products->id.'"')?></td>
                        <td><?=$products->property_size?></td>
                        <td><?=$products->min_price?></td>
                        <td><?=$products->max_price?></td>
                        <td><?=find_a_field('user_activity_management', 'fname', 'PBI_ID="'.$products->entry_by.'"')?></td>
                        <td><?=$products->entry_at?></td>
                        <td><a class="btn btn-sm <?php if($products->status == '0'){echo 'btn-danger';}else{echo 'btn-warning';} ?>" href="add_property.php?update=<?=encrypTS($products->id)?>">view</a></td>
                    </tr>
                    
                    <?php } ?>
                    
                </tbody>
                
                <tfoot>
                    <tr>
                        <th>Sn</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Project</th>
                        <th>Area</th>
                        <th>Min Budget</th>
                        <th>Max Budget</th>
                        <th>Entry by</th>
                        <th>Entry at</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
            
        </div>
    </div>
    
    

<?



require_once "../../../assets/template/layout.bottom.php";



?>