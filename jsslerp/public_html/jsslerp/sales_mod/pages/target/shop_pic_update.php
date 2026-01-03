<?php
session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";  


$today 			  = date('Y-m-d');
$company_id   = $_SESSION['company_id'];
$menu 			  = 'Setup';
$sub_menu 		= 'admin_user';
$username	=$_SESSION['username'];


$id=$_GET['id'];
$pic=find_a_field('ss_shop','picture',"dealer_code='".$id."'");


if(isset($_REQUEST['update']) ){

// image upload

$ff = $username.'_'.time();
$target_dir = "../../../../";
$target_dir2 = "shopImage/";
$file_name=$target_dir2.''.$ff;


$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

$uploadOk = 1;

$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


// Check file size
if ($_FILES["fileToUpload"]["size"] > 26214400000) {
  echo "Sorry, your file is too large.<br>";
  $uploadOk = 0;
}



// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";

  //echo "Sorry, your given file type is not allowed.<br>";

  $uploadOk = 0;
  $image_ok=0;
}



$file_name=$file_name.'.'.$imageFileType;


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.<br>";


// if everything is ok, try to upload file
} else {

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], '../../../../shopImage/'.$file_name)) {


        echo "Picture has been uploaded.<br>";

        } else {

        echo "Sorry, there was an error uploading your file.<br>";

        }

   

}

// end image upload


$sql="update ss_shop set picture='".$file_name."' where dealer_code='".$_POST['dealer_code']."'";
mysqli_query($sql);

redirect("shop_pic_update.php?id='".$_POST['dealer_code']."'");

} // end update
?>


<a href="../../../../shopImage/">test</a>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  



    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">








<form action="" method="post" enctype="multipart/form-data">
<?php $rand=rand(); $_SESSION['rand']=$rand; ?>
<input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />


<div class="form-floating mb-3">
<input type="text" class="form-control" name="dealer_code" id="dealer_code"  value="<?=$id?>" required readonly="readonly">
<label for="Shop Code">Shop Code</label>
</div> 


<div class="form-floating mb-3">
<input type="file" name="fileToUpload" id="fileToUpload" autocomplete="off" value="<?=$show->picture?>" class="form-control" required>
<label class="control-label" for="picture">Image<span class="required"></span></label>
</div> 


<div class="d-grid"><input type="submit" name="update" class="btn btn-lg btn-default shadow-sm btn-rounded" value="Update Image"/></div>

</form>



<br>
<div class="row mt-5">
    <img src="../../../../shopImage/<?=$pic?>" width="400px">
</div>






      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
  <?



$main_content=ob_get_contents();



ob_end_clean();



include ("../../template/main_layout.php");



?> 