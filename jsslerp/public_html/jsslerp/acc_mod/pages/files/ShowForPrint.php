<?php

session_start();

require_once "../../../assets/support/inc.all.php";

$datatodisplay=$_REQUEST['datatodisplay1'];

$datatodisplay=str_replace('tr style="display: none;"','tr',$datatodisplay);

$project_all=find_all_field('project_info','*','1');

$datatodisplay=str_replace('\"','',$datatodisplay);

?>

<html>

<head>

<link href="../../../assets/css/report.css" type="text/css" rel="stylesheet"/>

<style type="text/css">

<!--

.style1 {

	font-size: 18px;

	font-weight: bold;

}

.no-border td{
	border: none !important;
}




-->
@media print {
  @page {
    margin: none !important;
  }
  body {
    margin: 0;
  }
  
}

</style>

</head>

<body onLoad="window.print()">

<table class="no-border" width="90%" align="center" cellpadding="0" cellspacing="0">

          <tr>

            <td style="border:0px" width="1%">

			<?php /*?><? $path='../logo/'.$_SESSION['proj_id'].'.jpg';

			if(is_file($path)) echo '<img src="'.$path.'" height="80" />';?>	<?php */?>	
			
			<!--<img  src="logo.png" style=" height:50px; width:auto;" />-->
            </td>

            <td style="border:0px" width="99%" >
                <table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td style="border:0px; font-size: 15px; font-weight: bold; line-height: 30px;"  align="center" class="title">&nbsp;

								<?

if($_SESSION['user']['group']>1)

echo find_a_field('user_group','group_name',"id=".$_SESSION['user']['group']);

else

echo $_SESSION['proj_name'];

				?>

                &nbsp;</td>

              </tr>

              <tr>

                <td align="center" style="border:1px; padding-left:25px; text-align:center"><?=find_a_field('user_group','address',"id=".$_SESSION['user']['group'])?></td>

              </tr>

              

            </table></td>

          </tr>

          <tr>

            <td colspan="2" align="center" style="border:0px; text-align:center;">

           <strong> <?=$_REQUEST['page_title']?></strong>

            </span>

			<span class="style1"><?=$_REQUEST['report_detail']?> </span></td>
			
			
			

			

          </tr>

</table>

<br>

<?=$datatodisplay?></body>

</html>

