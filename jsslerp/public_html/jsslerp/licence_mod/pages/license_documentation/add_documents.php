<?php

session_start();

ob_start();

require_once "../../../assets/template/layout.top.php";


$page = 'add_documents.php';

$title='Add/Edit License details';			// Page Name and Page Title

$table='license_documents';
$table2='license_all_records';	

$crud = new crud($table);

if(isset($_POST["insert"])){
    
    $_POST['entry_by'] = $_SESSION['user']['id'];
    
    if(!file_exists($_FILES['attached']['tmp_name']) || !is_uploaded_file($_FILES['attached']['tmp_name'])) {
        $_POST['attachment'] = NULL;
    }else{
        $MovedFile = $_FILES["attached"]["name"];
        $ext = end(explode(".", $MovedFile));
        $MovedFile = rand(1,9).'_'.date("d-m-Y-H-i-s").'_'.rand(11,99).'.'.$ext;
        move_uploaded_file($_FILES["attached"]["tmp_name"], "../attachments/" . $MovedFile);
        
        $_POST['attachment'] = $MovedFile;
    }
    
    $crud->insert();
}


if(isset($_POST["update"])){
    
    $_POST['update_by'] = $_SESSION['user']['id'];
    $_POST['update_at'] = date('Y-m-d H:i:s');
    
    $_POST['name'] = find_a_field('license_type', 'name', 'id="'.$_POST["type"].'"').' ('.$_POST['issue_date'].')';
    
    if(!file_exists($_FILES['attached']['tmp_name']) || !is_uploaded_file($_FILES['attached']['tmp_name'])) {
        $_POST['attachment'] = NULL;
    }else{
        $MovedFile = $_FILES["attached"]["name"];
        $ext = end(explode(".", $MovedFile));
        $MovedFile = rand(1,9).'_'.date("d-m-Y-H-i-s").'_'.rand(11,99).'.'.$ext;
        move_uploaded_file($_FILES["attached"]["tmp_name"], "../attachments/" . $MovedFile);
        
        $_POST['attachment'] = $MovedFile;
    }
    
    $crud->update('id');
}


$datas = find_all_field($table, '', 'id="'.$_GET['update'].'"')

?>


    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 text-right mb-3">
                <a href="license_document_list.php" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Go Back</a> 
            </div>
        </div>
        
        <?php if($datas->id > 0){ ?>
        
        <div class="row" style="display:flex;margin-top:20px;margin-bottom:32px;">
            <div class="col-sm-12" style="margin:0 auto;">
              
              <iframe src="../attachments/<?=$datas->attachment?>" style="width:95%;height:425px;border:1px solid gray;"></iframe>
                
            </div>
        </div>
        
        <?php } ?>
        
        <div class="row">
            <div class="col-sm-12">

                <form method="post" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label>License: <span class="text-danger">*</span></label>
                        <select class="form-control" name="license_no" required>
                            <option value=""></option>
                            <?php foreign_relation($table2, 'id', 'name', $datas->license_no, 'is_active=1'); ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label><?php if($datas->attachment!=NULL){echo 'Update ';} ?> Attachment <small style="font-size:10px;">[PDF Only]</small>: <span class="text-danger">*</span></label>
                        <input type="file" accept=".pdf" name="attached" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Status: <span class="text-danger">*</span></label>
                        <select class="form-control" name="is_active" required>
                            <option value=""></option>
                            <option value="1" <?php if($datas->is_active==1){echo 'selected';}?>>Active</option>
                            <option value="0" <?php if($datas->is_active==0){echo 'selected';}?>>Inactive</option>
                        </select>
                    </div>
                    
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