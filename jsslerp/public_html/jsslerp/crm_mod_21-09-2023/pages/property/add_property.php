<?php

require_once "../../../assets/template/layout.top.php";

$title = "Add/Edit Project List";

$user_name = find_a_field('user_activity_management','username','user_id="'.$_SESSION['user']['id'].'"');

$_SESSION['employee_selected'] = find_a_field('user_activity_management','PBI_ID','user_id="'.$_SESSION['user']['id'].'"');


 $cur = '&#x9f3;';
 
 
 require "../include/custom.php";
 
 
 $table = 'crm_property_list';
 
 $crud = new crud($table);
 
 
 if(isset($_POST['insert'])){
     
     $_POST['entry_by'] = $_SESSION['employee_selected'];
     
     $crud->insert();

     
 }
 
 if(isset($_POST['update'])){
     
     $_POST['update_by'] = $_SESSION['employee_selected'];
     $_POST['update_at'] = date('Y-m-d h:s:i');
     
     $crud->update('id');
 }
 
 
 $datas = find_all_field($table, '', 'id="'.decrypTS($_GET['update']).'"');
 

?>

<style>
    .field_required{
        border-left: 3.5px solid #df5b5b!important;
    }
    .field_not_required{
        border-left: 3.5px solid #aeddf7 !important;
    }
</style>

    <script type="text/javascript" src="../../../assets/js/bootstrap.min.js"></script>
    
    
    <div class="row">
        
        <div class="col-md-12 col-xs-12">
            <div class="text-right mt-3">
                <a href="project_list.php" class="btn btn-danger text-light">Go Back</a>
                <a href="add_project.php" class="btn btn-success text-light">Refresh</a>
            </div>
            <form method="post">
            <div class="card">
                <div class="card-header"><h5>Add/Update Property</h5></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label>Property Name</label>
                                <input type="text" name="property_name" id="property_name" class="form-control field_required" value="<?=$datas->property_name?>" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label>Property Type</label>
                                <select name="property_type" id="property_type" class="selectpicker form-control field_not_required" data-live-search="true">
                                    <option value="">--Select One--</option>
                                    <option value="1" <?php if($datas->property_type=='1'){echo "selected";}?>>Commercial</option>
                                    <option value="2" <?php if($datas->property_type=='2'){echo "selected";}?>>Plot</option>
                                    <option value="3" <?php if($datas->property_type=='3'){echo "selected";}?>>Residential</option>
                                    <?//php foreign_relation('district_list','id','district_name',$datas->project_dist,'1'); ?>
                                 </select>
                                
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label>Project</label>
                                <select name="project_type" id="project_type" class="selectpicker form-control field_not_required" data-live-search="true">
                                    <option value="">--Select One--</option>
                                    <?php foreign_relation('crm_project_list','id','project_name',$datas->project_type,'1'); ?>
                                 </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label>Size/Area</label>
                                <input type="text" name="property_size" id="property_size" class="form-control field_not_required" value="<?=$datas->property_size?>">
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label>Condition</label>
                                <select name="project_con" id="project_con" class="selectpicker field_not_required form-control" data-live-search="true">
                                    <option value="">--Select One--</option>
                                        <option value="1" <?php if($datas->project_con=='1'){echo "selected";}?>>Completed</option>
                                            <option value="2" <?php if($datas->project_con=='2'){echo "selected";}?>>Under Construction</option>
                                               
                                    <?//php foreign_relation('division','division_CODE','division_name',$datas->project_div,'1'); ?>
                                </select>
                               
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label>Facing:</label>
                                <select name="property_facing" id="property_facing" class="selectpicker form-control field_not_required" data-live-search="true">
                                    <option value=""></option>
                                    <option value="1" <?php if($datas->property_facing=='1'){echo "selected";}?>>East</option>
                                    <option value="2" <?php if($datas->property_facing=='2'){echo "selected";}?>>WEST</option>
                                    <option value="3" <?php if($datas->property_facing=='3'){echo "selected";}?>>Garden</option>
                                    <option value="4" <?php if($datas->property_facing=='4'){echo "selected";}?>>Corner</option>
                                    <?//php foreign_relation('district_list','id','district_name',$datas->project_dist,'1'); ?>
                                 </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                
                                <label>Contact person</label>
                                <input type="text" name="contact_person" id="contact_person" class="form-control field_not_required" value="<?=$datas->contact_person?>">
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                
                                <label>Contact Number</label>
                                <input type="text" name="contact_number" id="contact_number" class="form-control field_not_required" value="<?=$datas->contact_number?>">
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            
                            <div class="form-group">
                                <label>Min Value</label>
                                <input type="text" name="min_price" id="min_price" class="form-control field_not_required" value="<?=$datas->min_price?>">
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            
                            <div class="form-group">
                                <label>Max Value</label>
                                <input type="text" name="max_price" id="max_price" class="form-control field_not_required" value="<?=$datas->max_price?>">
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label class="mr-2"><b>Amenities</b></label>
                                <input type="checkbox" name="have_parking" value="1" required <?php if($datas->status == '1'){echo 'checked';} ?>> Parking Facilities
                                <input type="checkbox" name="have_CC" value="1" <?php if($datas->have_CC == '1'){echo 'checked';} ?>> CC Camera
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label class="mr-2"><b>Status</b></label>
                                <input type="radio" name="status" value="1" required <?php if($datas->status == '1'){echo 'checked';} ?>> Active
                                <input type="radio" name="status" value="0" <?php if($datas->status == '0'){echo 'checked';} ?>> Inactive
                            </div>
                        </div>
                    </div>
                    <div class="row">
                             <div class="col-md-12 col-xs-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="project_des" id="project_des" class="form-control field_not_required" ><?=$datas->project_des?></textarea>
                                </div>
                            </div>
                     
                    </div>
                    <div class="row">
                         <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label>Upload Document 1</label>
                                <input type="file" name="property_file1" id="property_file3">
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label>Upload Document 2</label>
                                <input type="file" name="property_file2" id="property_file3">
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label>Upload Document 3</label>
                                <input type="file" name="property_file3" id="property_file3">
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="card-footer">
                    <?php if($datas->id > 0){ ?>
                    <input type="hidden" value="<?=$datas->id?>" name="id">
                    <input type="submit" value="Update" name="update" class="btn btn-warning mx-auto mb-3">
                    <?php }else{ ?>
                    <input type="submit" value="Insert" name="insert" class="btn btn-info mx-auto mb-3">
                    <?php } ?>
                </div>
            </div>
            </form>
        </div>
    </div>
    
    

<?



require_once "../../../assets/template/layout.bottom.php";



?>