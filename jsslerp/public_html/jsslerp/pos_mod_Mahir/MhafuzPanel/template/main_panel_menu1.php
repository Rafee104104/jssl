<?
session_start();
$mod_id = 99;
$mod_name = 'Super Panel';
?>
<?php /*?><h6 style="background-color:#4f64a5;color:white;padding:10px;text-align:center;"><a href="../../../MhafuzPanel/pages/inventory/home.php?cid=<?= $data->id ?>" style="color:white!important;">
<?= $_SESSION['proj_id']; ?>
</a>
</h6><?php */?>
<h1 style="background: #3498DB; width: 100%; color: white; text-align:center; font-size:18px; margin:0px; margin-bottom:1px; padding: 10px 0px;">Super Panel</h1>
<div class="menu_bg">
<div class="silverheader mhafuz1" headerindex="1h"><a href="#"><i class="fas fa-cogs" aria-hidden="true"></i> Dashboard<span></span></a></div>
<ul class="submenu mhafuz1" contentindex="1c" style="display: none;">
<li><a href="home.php"><span>Dashboard</span></a></li>
</ul>
<?php /*?>    <div class="silverheader mhafuz2" headerindex="1h"><a href="#"><i class="fas fa-cogs" aria-hidden="true"></i> Company Setup<span></span></a></div>
<ul class="submenu mhafuz2" contentindex="1c" style="display: none;">
<li><a href="company.php"><span>Company Info</span></a></li>
<li><a href="create_database.php"><span>Add Database</span></a></li>
</ul>
<?php */?>
<div class="silverheader mhafuz3" headerindex="1h"><a href="#"><i class="fas fa-cogs" aria-hidden="true"></i> General Section<span></span></a></div>
<ul class="submenu mhafuz3" contentindex="1c" style="display: none;">
<li><a href="company.php"><span>Company Info</span></a></li>
<li><a href="database.php"><span>Database Info</span></a></li>
<li><a href="create_database.php"><span>Add Database</span></a></li>
<li><a href="module.php"><span>Module Access</span></a></li>
</ul>
<div class="silverheader mhafuz4" headerindex="1h"><a href="#"><i class="fas fa-cogs" aria-hidden="true"></i> Company Audit Info<span></span></a></div>
<ul class="submenu mhafuz4" contentindex="1c" style="display: none;">
<li><a href="template.php"><span>Template Config</span></a></li>
<li><a href="system_check.php"><span>Stock Check</span></a></li>

<li><a href="system_check_finance.php"><span>Stock Check Finance</span></a></li>
<li><a href="system_check_acc.php"><span>Stock Check Account</span></a></li>

<li><a href="system_cr_dr_check.php"><span>System Cr Dr Check</span></a></li>
<li><a href="system_stock_error_log.php"><span>System Daily Error Log Stock</span></a></li>

<li><a href="system_finance_error_log.php"><span>System Daily Error Log Finance</span></a></li>
<li><a href="system_acc_error_log.php"><span>System Daily Error Log Account</span></a></li>

<li><a href="system_cr_dr_error_log.php"><span>System Daily Error Log Cr Dr</span></a></li>
</ul>

<div class="silverheader mhafuz3" headerindex="1h"><a href="#"><i class="fas fa-cogs" aria-hidden="true"></i>All Report<span></span></a></div>
<ul class="submenu mhafuz3" contentindex="1c" style="display: none;">
<li><a href="report.php"><span>Systems Report</span></a></li>
</ul>
<?php /*?>
<?
require_once('../../../../../../erpengine/controller/MainEngine/controller/configure/db_connect_acc_main.php');
require_once('../../../../../../erpengine/controller/MainEngine/controller/tools/inc.log.php');
require_once('../../../../../../erpengine/controller/MainEngine/controller/tools/inc.database.php');
$sql = "SELECT b.db_user,b.db_pass,b.db_name,a.cid,a.id,a.company_name,a.address,a.register_date FROM 
company_info a,database_info b WHERE a.id=b.company_id and a.status='ON' ";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
?>
<h6 style="background-color:#4f64a5;color:white;padding:10px;text-align:center;"><a href="../../../MhafuzPanel/pages/inventory/home.php?cid=<?=$data->id?>" style="color:white!important;" ><?=$data->cid?></a></h6>
<? }?><?php */ ?>
<div class="silverheader mhafuz1" headerindex="3h">
<a href="#"><i class="fa fa-sign-out-alt" aria-hidden="true"></i> Exit Program<span></span></a></div>
<ul class="submenu mhafuz1" contentindex="3c" style="display: none;">
<li><a href="../main/logout.php"><span> Log Out</span></a></li>
</ul>


</div>