<?php
session_start ();
include "config/access_admin.php";
include "config/db.php";
include 'config/function.php';

function img_compress($input_image,$output_image,$ratio){
    
    $img=imagecreatefromjpeg($input_image);
    imagejpeg($img,$output_image,$ratio);    
}


echo 'New Picture '.find1("select count(*) from ss_shop where image_compress=0");




if(isset($_POST['Start'])){
$v=0;
$ratio=30;

    $sql="select * from ss_shop where image_compress=0 and dealer_code not in (1000001)";
    $query = mysqli_query($conn,$sql);
    while($info = mysqli_fetch_object($query)){
    
    $input_image='../sec_mobile_app/'.$info->picture;
    $output_image='../sec_mobile_app/'.$info->picture;
    
    img_compress($input_image,$output_image,$ratio);
    
    mysqli_query($conn, "update ss_shop set image_compress=1 where dealer_code='".$info->dealer_code."'");
    $v++;   
    }

echo '<br>Total Image process '.$v.'. Done';
}

?>
<center>
<form method="post" action="">
    
	<input type="submit" name="Start" value="Start Image Compress"/>
</form>