<?php
require_once "../../../assets/template/layout.top.php";
$title = "License Management Dashboard";
$today = date('Y-m-d');
$lastdays = 	date("Y-m-d", strtotime("-7 days", strtotime($today)));
?>
<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from designreset.com/cork/ltr/demo3/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Mar 2020 08:10:15 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
<title>  </title>
<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
<!--     Fonts and icons     -->
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
<!-- CSS Files -->
<link href="../../../dashboard_assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
<style>
.font-siz{
font-size:20px;
font-weight:bold;
}
@media(max-width: 1200px) {
}
@media(max-width: 1400px) {
}
@media(max-width: 1500px) {
}
</style>
</head>
<div class="content">
<div class="container-fluid">
<!--new-->

<div class="row">

<div class="col-lg-12 col-sm-12 col-md-12">
<div class="row">
<div class="col-lg-6 col-md-6 col-sm-6">
<div class="card card-stats">
<div class="card-header card-header-primary card-header-icon">
<div class="card-icon p-0">
<i class="fas fa-chart-line"></i>
</div>
<p class="card-category" style="color:#BA04F9; font-weight:bold;">Total Active License(s)</p>
<h3 class="card-title"><span id="salesReturn" class="loader"><?=find_a_field('license_all_records', 'count(id)', 'is_active=1')?></span></h3>
</div>
<div class="card-footer">
<div class="stats">
<i class="material-icons">date_range</i> <?php $a=find_a_field('license_all_records', 'max(entry_at)', 'is_active=1'); if($a!=NULL){echo $a;}else{echo 'Never';}?>
</div>
</div>
</div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6">
<div class="card card-stats">
<div class="card-header card-header-success card-header-icon">
<div class="card-icon p-0">
<i class="fab fa-audible"></i>
</div>
<p class="card-category" style="color:#0CBB37; font-weight:bold;">Total Issued (This Month)</p>
<h3 class="card-title"><span id="purchaseReturn" class="loader"><?=find_a_field('license_all_records', 'count(id)', 'DATE_FORMAT(entry_at,"%Y-%m-%d")="'.date("Y-m-d").'" AND is_active=1')?></span></h3>
</div>
<div class="card-footer">
<div class="stats">
<i class="material-icons">date_range</i> <?php $b=find_a_field('license_all_records', 'max(entry_at)', 'DATE_FORMAT(entry_at,"%Y-%m-%d")="'.date("Y-m-d").'" AND is_active=1 ORDER BY entry_at DESC'); if($b!=NULL){echo $b;}else{echo 'Never';}?>
</div>
</div>
</div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6">
<div class="card card-stats">
<div class="card-header card-header-danger card-header-icon">
<div class="card-icon p-0">
<i class="far fa-calendar-times"></i>
</div>
<p class="card-category" style="color:#F00712; font-weight:bold;">Already Expired</p>
<h3 class="card-title"><span id="transferIssue" class="loader"><?=find_a_field('license_all_records', 'count(id)', 'DATE_FORMAT(expire_date,"%Y-%m-%d")<"'.date("Y-m-d").'" AND is_active=1')?></span></h3>
</div>
<div class="card-footer">
<div class="stats">
<i class="material-icons">update</i> Last <?php $d=find_a_field('license_all_records', 'max(expire_date)', 'DATE_FORMAT(expire_date,"%Y-%m-%d")<"'.date("Y-m-d").'" AND is_active=1 ORDER BY expire_date DESC'); if($d!=NULL){echo $d;}else{echo '0';}?> Days Ago
</div>
</div>
</div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6">
<div class="card card-stats">
<div class="card-header card-header-warning card-header-icon">
<div class="card-icon p-0">
<i class="fas fa-calendar-check"></i>
</div>
<p class="card-category" style="color:#F5DB01; font-weight:bold;">Expiring Within 4 Month</p>
<h3 class="card-title"><span id="transferReceive" class="loader"><?=find_a_field('license_all_records', 'count(id)', 'DATE_FORMAT(expire_date,"%Y-%m-%d")>="'.date("Y-m-d").'" AND DATE_FORMAT(expire_date,"%Y-%m-%d")<="'.date("Y-m-d", strtotime("+4 months")).'" AND is_active=1')?></span></h3>
</div>
<div class="card-footer">
<div class="stats">
<i class="material-icons">date_range</i> Least Remaining <?php $c=find_a_field('license_all_records', 'min(expire_date)', 'DATE_FORMAT(expire_date,"%Y-%m-%d")>="'.date("Y-m-d").'" AND DATE_FORMAT(expire_date,"%Y-%m-%d")<="'.date("Y-m-d", strtotime("+4 months")).'" AND is_active=1 ORDER BY expire_date DESC'); if($c!=NULL){echo $c;}else{echo '0';}?> Days
</div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>
</div>


<?
require_once "../../../assets/template/layout.bottom.php";
?>
