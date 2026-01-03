<?php

session_start();

ob_start();

require_once "../../../assets/template/layout.top.php";


$page = 'add_edit_license.php';

$title='Add/Edit License details';			// Page Name and Page Title


$table='license_all_records';	

$crud = new crud($table);


if(isset($_POST["insert"])){
    
    $_POST['entry_by'] = $_SESSION['user']['id'];
    
    $_POST['name'] = find_a_field('license_type', 'name', 'id="'.$_POST["type"].'"').' ('.$_POST['issue_date'].')';
    
    // if(!file_exists($_FILES['attached']['tmp_name']) || !is_uploaded_file($_FILES['attached']['tmp_name'])) {
    //     $_POST['attachment'] = NULL;
    // }else{
    //     $MovedFile = $_FILES["attached"]["name"];
    //     $ext = end(explode(".", $MovedFile));
    //     $MovedFile = rand(1,9).'_'.date("d-m-Y-H-i-s").'_'.rand(11,99).'.'.$ext;
    //     move_uploaded_file($_FILES["attached"]["tmp_name"], "../attachments/" . $MovedFile);
        
    //     $_POST['attachment'] = $MovedFile;
    // }
    
    $crud->insert();
}


if(isset($_POST["update"])){
    
    $_POST['update_by'] = $_SESSION['user']['id'];
    $_POST['update_at'] = date('Y-m-d H:i:s');
    
    $_POST['name'] = find_a_field('license_type', 'name', 'id="'.$_POST["type"].'"').' ('.$_POST['issue_date'].')';
    
    // if(!file_exists($_FILES['attached']['tmp_name']) || !is_uploaded_file($_FILES['attached']['tmp_name'])) {
    //     $_POST['attachment'] = NULL;
    // }else{
    //     $MovedFile = $_FILES["attached"]["name"];
    //     $ext = end(explode(".", $MovedFile));
    //     $MovedFile = rand(1,9).'_'.date("d-m-Y-H-i-s").'_'.rand(11,99).'.'.$ext;
    //     move_uploaded_file($_FILES["attached"]["tmp_name"], "../attachments/" . $MovedFile);
        
    //     $_POST['attachment'] = $MovedFile;
    // }
    
    $crud->update('id');
}


$datas = find_all_field($table, '', 'id="'.$_GET['update'].'"')

?>


    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 text-right mb-3">
                <a href="license_list.php" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Go Back</a> 
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-12">

                <form method="post" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label>License Type: <span class="text-danger">*</span></label>
                        <select class="form-control" name="type" required>
                            <option value=""></option>
                            <?php foreign_relation('license_type', 'id', 'name', $datas->type, 'is_active=1'); ?>
                        </select>
                    </div>
                    
                    <!--<div class="form-group">-->
                    <!--    <label>License Name: <span class="text-danger">*</span></label>-->
                    <!--    <input type="hidden" value="<?//=$datas->name?>" class="form-control" name="name" required>-->
                    <!--</div>-->
                    
                    <div class="form-group">
                        <label>Date of Issue: <span class="text-danger">*</span></label>
                        <input type="date" value="<?=$datas->issue_date?>" class="form-control" name="issue_date" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Date of Expiry: <span class="text-danger">*</span></label>
                        <input type="date" value="<?=$datas->expire_date?>" class="form-control" name="expire_date" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Description: </label>
                        <textarea type="text" rows="2" style="resize:none;" class="form-control" name="description"><?=$datas->description?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Status: <span class="text-danger">*</span></label>
                        <select class="form-control" name="is_active" required>
                            <option value=""></option>
                            <option value="1" <?php if($datas->is_active==1){echo 'selected';}?>>Active</option>
                            <option value="0" <?php if($datas->is_active==0){echo 'selected';}?>>Inactive</option>
                        </select>
                    </div>
                    
                    <!--<div class="form-group">-->
                    <!--    <label><?php //if($datas->attachment!=NULL){echo 'Update ';} ?> <?php //if($datas->attachment!=NULL){echo '<a href="../attachments/'.$datas->attachment.'" target="_blank">Attachment</a>';}else{echo 'Attachment';}?> <small style="font-size:10px;">[PDF Only]</small>:</label>-->
                    <!--    <input type="file" accept=".pdf" name="attached">-->
                    <!--</div>-->
                    
                    <div class="form-group">
                        <?php if($datas->id > 0){ ?>
                        <input type="hidden" value="<?=$datas->id?>" name="id">
                        <input type="submit" class="btn btn-warning" name="update" value="Update">
                        <?php }else{ ?>
                        <input type="submit" class="btn btn-primary" name="insert" value="Insert">
                        <?php } ?>
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