<?php

require_once "../../../assets/template/layout.top.php";

$title = "Add/Edit Project List";

$user_name = find_a_field('user_activity_management','username','user_id="'.$_SESSION['user']['id'].'"');

$_SESSION['employee_selected'] = find_a_field('user_activity_management','PBI_ID','user_id="'.$_SESSION['user']['id'].'"');


 $cur = '&#x9f3;';
 
 
 require "../include/custom.php";
 
 
 $table = 'crm_project_list';
 
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
                <a href="add_project.php" class="btn btn-success text-light">+ Refresh</a>
            </div>
            <form method="post">
            <div class="card">
                <div class="card-header"><h5>Add/Update Products</h5></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label>Project Name</label>
                                <input type="text" name="project_name" id="project_name" class="form-control field_required" value="<?=$datas->project_name?>" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label>Area</label>
                                <input type="text" name="project_area" id="project_area" class="form-control field_not_required" value="<?=$datas->project_area?>">
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label>Budget</label>
                                <input type="text" name="project_budget" id="project_budget" class="form-control field_not_required" value="<?=$datas->project_budget?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label>Adress</label>
                                <input type="text" name="project_add" id="project_add" class="form-control field_required" value="<?=$datas->project_add?>" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label>Division</label>
                                <select name="project_div" id="project_div" class="selectpicker field_not_required form-control" data-live-search="true">
                                    <option value="">--Select One--</option>
                                    <?php foreign_relation('division','division_CODE','division_name',$datas->project_div,'1'); ?>
                                </select>
                               
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label>District</label>
                                <select name="project_dist" id="project_dist" class="selectpicker form-control field_not_required" data-live-search="true">
                                    <option value="">--Select One--</option>
                                    <?php foreign_relation('district_list','id','district_name',$datas->project_dist,'1'); ?>
                                 </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="form-group">
                                <label class="mr-2"><b>Status</b></label>
                                <input type="radio" name="status" value="1" required <?php if($datas->status == '1'){echo 'checked';} ?>> Active
                                <input type="radio" name="status" value="0" <?php if($datas->status == '0'){echo 'checked';} ?>> Inactive
                            </div>
                        </div>
                    </div>
                    <div class="row">
                             <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="project_des" id="project_des" class="form-control field_not_required" ><?=$datas->project_des?></textarea>
                                </div>
                            </div>
                       
                       
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label>Upload Documents</label>
                                <input type="file" name="project_file" id="project_file">
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