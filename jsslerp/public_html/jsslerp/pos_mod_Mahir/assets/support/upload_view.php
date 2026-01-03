<?php
	
     $file = '../../../../media/'.htmlspecialchars($_GET["proj_id"]).'/'.htmlspecialchars($_GET["mod"]).'/'.htmlspecialchars($_GET["folder"]).'/'. htmlspecialchars($_GET["name"]);


	$check  =explode('.',$_GET['name']);
	$ch = strtolower($check[1]);
	
	if($ch=='pdf'){
		header("Content-type:application/pdf");
	}else{
	header('Content-Type: image/jpeg');
	}
	
    readfile($file);
?>
