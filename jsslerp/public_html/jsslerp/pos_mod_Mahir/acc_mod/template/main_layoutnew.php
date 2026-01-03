<?php
if(!isset($_SESSION))
session_start();
require_once "../../../engine/configure/default_values.php";
require_once "../../../engine/configure/db_connect.php";
require_once "../../../engine/tools/my.php";
$level=$_SESSION['user']['level'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!--<title><?=PAGE_TITLE?></title>--->
<title>Sales ERP <?=PROJECT?></title>
<link href="../../css/style.css" type="text/css" rel="stylesheet"/>
<link href="../../css/menu.css" type="text/css" rel="stylesheet"/>
<link href="../../css/table.css" type="text/css" rel="stylesheet"/>
<link href="../../css/input.css" type="text/css" rel="stylesheet"/>
<link href="../../css/form.css" type="text/css" rel="stylesheet"/>
<link href="../../css/bootstrap.min.css" type="text/css" rel="stylesheet"/>

<link href="../../css/pagination.css" rel="stylesheet" type="text/css" />
<link href="../../css/jquery-ui-1.8.2.custom.css" rel="stylesheet" type="text/css" />
<meta name="Developer" content="Md. Mhafuzur Rahman Cell:01815-224424 email:mhafuz@yahoo.com" />
<link href="../../css/jquery.autocomplete.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

<script type="text/javascript" src="../../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../../js/jquery-ui-1.8.2.custom.min.js"></script>
<script type="text/javascript" src="../../js/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="../../js/jquery.autocomplete.js"></script>
<script type="text/javascript" src="../../js/jquery.validate.js"></script>
<script type="text/javascript" src="../../js/paging.js"></script>
<script type="text/javascript" src="https://mahirgrouperp.com/ddaccordion_new.js"></script>
<script type="text/javascript" src="../../js/js.js"></script>








<style type="text/css">

body{
background: #F7F7F7;
}

<!--
.style1 {font-size: 20px}
-->

a.hover{
 color:#fff!important;
}
.navbar-brand:hover{
    color:#1f1f1f!important;
}
::-webkit-scrollbar { 
    display: none; 
}
</style>
</head>
<body>





<div class="wrapper">
			
			
  
  
			<div class="body_box">
					    <div class="body_middlebox_bar">
						
						
						<div class="sidebar" style="position: fixed; height:100%; overflow:scroll">
						<div class="title-image" style="padding: 5px;">
						<img src="../../../logo/new_cloud_erp.png" style="width:100%;" />
						</div>
						<? include("../../template/main_layout_menu.php");?>
						</div>
						<div class="main_content">
						<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-fixed-top" >
    <div class="container-fluid">
      <div class="navbar-header"><a class="navbar-brand" href="#">Reverie Power & Automation Engineering Ltd.</a></div>
      <!--<div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="../../../sales_mod/pages/main/home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      
     
    </ul>
  </div>-->
        <ul class="nav justify-content-end">
		 <li class="nav-item dropdown pull-right">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?=$_SESSION['user']['fname']?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

<!--          <div class="dropdown-divider"></div>-->
          <a class="dropdown-item" href="../main/logout.php"><i class="fa fa-sign-out"></i>Logout</a>
        </div>
      </li>
		 
  	      
        </ul>
	    </div>
		  </nav>
		  <div class="sr-main-content">
		  
		  <div class="sr-main-content-padding">
		  <h2 style="font-size:18px; font-weight: bold ; color: #73879C; border-bottom: 2px solid #E6E9ED; padding-bottom: 10px;"><?=$title?></h2>
		
		  
						<?=$main_content?>
						</div>
						</div>
</div>						
						</div>

					
						
						
						</div>		
			</div>



</body>
</html>
