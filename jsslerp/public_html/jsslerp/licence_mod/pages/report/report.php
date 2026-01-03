<?php

session_start();


require_once "../../../assets/support/inc.all.php";


$table='license_all_records';		


do_datatable('example');

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Master Report</title>
<link href="../../../assets/css/report.css" type="text/css" rel="stylesheet" />
<style>
*{
	font-size:
	}
h2, h3, h4 {
	text-align:center;
	}
</style>


<script type="text/javascript">

function hide()

{

    document.getElementById("pr").style.display="none";

}

</script>



<style type="text/css">
#ExportTable th, td {
    text-align: center;
}
.vertical-text {
	transform: rotate(270deg);
	transform-origin: left top 1;
	float:left;
	width:2px;
	padding:1px;
	font-size:10px;
	font-family:Arial, Helvetica, sans-serif;
}
.style1 {font-weight: bold}
.style2 {font-weight: bold}
.style3 {font-weight: bold}

h3 { margin:0; padding:0; font-weight: 700;}
.style4 {font-weight: bold}
.style5 {font-weight: bold}
.style6 {font-weight: bold}
.style7 {font-weight: bold}
</style>

	<?
	require_once "../../../assets/support/inc.exporttable.php";
	?>

</head>
<body>
<!--<div align="center" id="pr">-->
<!--<input name="button" type="button" onclick="hide();window.print();" value="Print" />-->
<!--</div>-->
<div class="main">

<?php

    if(isset($_SESSION['user']['group'])){
        $str 	 = '<img width="12%" style="padding:12px;margin-top:15px;margin-bottom:15px;" src="../../../logo/'.$_SESSION['proj_id'].'.png'.'">';
    }else{
        $str = '';
    }

?>


    <table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
        <thead>
            <tr>
                <td style="border:0px;" colspan="12">
                    <div class="header">
                        <?php if($str != ''){echo $str;} ?>
                        <h1 style="text-align:center;"><?=$_SESSION['company_name']?></h1>
                        <h2>License Management Report</h2>
                    </div>
                </td>
            </tr>
            
            <tr>
                <th>S/L</th>
                <th>License Name</th>
                <th>License Type</th>
                <th>Issue Date</th>
                <th>Expire Date</th>
                <th>Activity Status</th>
                <th>Description</th>
                <th>Total Attachment(s)</th>
                <th>Entry By</th>
                <th>Entry At</th>
                <th>Update By</th>
                <th>Update At</th>
            </tr>
        </thead>
        
        <tbody>
            
            <?php 
            
                $sn=1;
                $qry = "SELECT * FROM license_all_records ORDER BY issue_date DESC";
                $rslt = mysql_query($qry);
                while($data = mysql_fetch_object($rslt)){
            
            ?>
            
            <tr>
                <td><?=$sn?></td>
                <td><?=$data->name?></td>
                <td><?=find_a_field('license_type', 'name', 'id="'.$data->type.'"')?></td>
                <td><?=$data->issue_date?></td>
                <td><?=$data->expire_date?></td>
                <td><?=$data->is_active=='1'?'Active':'Inactive'?></td>
                <td><?=$data->description?></td>
                <td><?=find_a_field('license_documents', 'count(id)', 'license_no="'.$data->id.'" AND is_active=1')?></td>
                <td><?=find_a_field('user_activity_management', 'fname', 'user_id="'.$data->entry_by.'"')?></td>
                <td><?=$data->entry_at?></td>
                <td><?=find_a_field('user_activity_management', 'fname', 'user_id="'.$data->update_by.'"')?></td>
                <td><?=$data->update_at?></td>
            </tr>
            
            <?php $sn++; } ?>
            
        </tbody>
    </table>


