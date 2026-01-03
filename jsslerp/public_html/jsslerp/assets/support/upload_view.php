<?php
	
     $file = '../../../../media/'.htmlspecialchars($_GET["proj_id"]).'/'.htmlspecialchars($_GET["mod"]).'/'.htmlspecialchars($_GET["folder"]).'/'. htmlspecialchars($_GET["name"]);


	$check  =explode('.',$_GET['name']);
	$ch = strtolower($check[1]);
	
	
	if($ch=='pdf'){
		header("Content-type:application/pdf");
	}elseif($ch=='png'){
	header('Content-Type: image/png');
	}
	elseif($ch=='jpg'){
	header('Content-Type: image/jpg');
	}
	elseif($ch=='jfif'){
	header('Content-Type: image/jfif');
	}
	elseif($ch=='pjpeg'){
	header('Content-Type: image/pjpeg');
	}
	elseif($ch=='pjp'){
	header('Content-Type: image/pjp');
	}
	else{
	header('Content-Type: image/jpeg');
	}
	
	
	//if($ch=='pdf'){
//		header("Content-type:application/pdf");
//	}else{
//	header('Content-Type: image/jpeg');
//	}
	
    readfile($file);
?>
