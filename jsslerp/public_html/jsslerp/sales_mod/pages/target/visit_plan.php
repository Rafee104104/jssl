<?php
session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";  


$today 			    = date('Y-m-d');
$company_id         = $_SESSION['company_id'];
$entry_by           = $_SESSION['username'];
$menu 			    = 'Visit';
$sub_menu 		    = 'visit_plan';


if(isset($_POST['confimr_schedule'])){		



for($i=0;$i<count($_POST['dates']);$i++){

$user_id = find_a_field('ss_user','user_id','username="'.$_POST['PBI_ID'][$i].'"');

$delete = 'delete from ss_schedule where user_id="'.$user_id.'" and date="'.$_POST['dates'][$i].'" ';
mysql_query($delete);


$insert = 'insert into ss_schedule set 
    user_id="'.$user_id.'", 
    date="'.$_POST['dates'][$i].'", 
    dealer_code="'.$rr->dealer_code.'",
    route_id="'.$_POST['route'][$i].'",
    PBI_ID="'.$_POST['PBI_ID'][$i].'",
    entry_by="'.$entry_by.'"
';

mysql_query($insert);


}


}





//for Delete..................................

if(isset($_POST['delete'])){		
    
    $condition=$unique."=".$$unique;		
		$crud->delete($condition);
		unset($$unique);
		$type=1;
		$msg='Successfully Deleted.';
}

?>






  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">




    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">





<form  method="post" action="">

<table width="100%" border="0" cellspacing="0" cellpadding="0">



<tr>

<td>
<div class="row mb-10 form-group">
<label class="control-label col-md-4" for="zone_id">Zone<span class="required"></span></label>
<div class="col-md-8">
    <select class="form-control col-md-12" name="zone_id" required id="zone" onchange="FetchArea(this.value)">
        
<? if($_SESSION['level']==103){ ?>
        <option value="<?=$_SESSION['zone_id']?>"><?=find_a_field('zon','ZONE_NAME',"ZONE_CODE='".$_SESSION['zone_id']."'");?></option>
<? }else{ ?>
<option value="<?=$_POST['zone_id']?>"><?=find_a_field('zon','ZONE_NAME'," ZONE_CODE='".$_POST['zone_id']."'");?></option>
        <? foreign_relation('zon','ZONE_CODE','ZONE_NAME',$zone_id,'1');?>
<? } ?>
    </select>
</div>
</div>


<div class="row mb-10 form-group">
<label class="control-label col-md-4" for="area_id">Area<span class="required"></span></label>
<div class="col-md-8">
    <select class="form-control col-md-12" name="area_id" required id="area">
<? if($_SESSION['level']==103){ ?> 
    <option value="<?=$_SESSION['area_id']?>"><?=find_a_field('area','AREA_NAME',"AREA_CODE='".$_SESSION['area_id']."'");?></option>
<? }else{ ?>
        <option value="<?=$_POST['area_id']?>"><?=find_a_field('area','AREA_NAME'," AREA_CODE='".$_POST['area_id']."'");?></option>
        <option value="<?=$show2->area_id?>"><?=find_a_field('area','AREA_NAME',"AREA_CODE='".$show2->area_id."'");?></option>
<? } ?>
    </select>
</div>
</div> 
</td>

<td style="width: 100px;">From : </td>
<td><input class="form-control" name="from_date" type="date" value="<?=$_POST['from_date']?$_POST['from_date']:date('Y-m-d');?>" required/></td>

<td style="width: 100px;">To : </td>

<td><input class="form-control" name="to_date" type="date" value="<?=$_POST['to_date']?$_POST['to_date']:date('Y-m-d');?>" required/></td>


<td>&nbsp;&nbsp;</td>

<td><input name="search" type="submit" id="search" value="Search" class="btn btn btn-warning" /></td>

</tr> 
</table>
</form>















<? if(isset($_POST['search'])){ 

$start    = new DateTime($_POST['from_date']);
$end      = (new DateTime($_POST['to_date']))->modify('+1 day');
$interval = new DateInterval('P1D');
$period   = new DatePeriod($start, $interval, $end);


?>
<br><p>
<form action="" method="post">
  <table class="table" width="100%" border="1" cellspacing="0">
    <thead>
      <tr>
        <th style="text-align: left;">SO ID</th>
        <th  style="text-align: left;">SO Name</th>
        <?
        foreach ($period as $dt) {
        ?>
        <th  style="text-align: center;"><?=$dt->format("Y-m-d")?></th>
        <?  } ?>
      </tr>
    </thead>
    <tbody>

<?
$select = 'select * from ss_user where status="Active" and zone_id="'.$_POST['zone_id'].'" and area_id="'.$_POST['area_id'].'"
';
$query = mysql_query($select);
while($row = mysql_fetch_object($query)){

?>
    <tr>
        <td style="text-align: left;"><?=$row->username?></td>
        <td style="text-align: left;"><?=$row->fname?>
      </td>
        <?
        foreach ($period as $dt) {
        ?>
        <td>

    <input type="hidden" name="dates[]" value="<?=$dt->format("Y-m-d")?>">
      <input type="hidden" name="PBI_ID[]" value="<?=$row->username?>">
      <select name="route[]" required>
      <option value=""></option>
      <?
      $seleR = 'select  * from ss_route where 1';
      $quR = mysql_query($seleR);
      while($rrQ = mysql_fetch_object($quR)){

        $existanceOfRoute = find_a_field('ss_schedule','route_id','date="'.$dt->format("Y-m-d").'" and PBI_ID="'.$row->username.'"');
      ?>
      
<option value="<?=$rrQ->route_id?>"  <? if($existanceOfRoute==$rrQ->route_id){ echo 'selected'; } ?> ><?=$rrQ->route_name?></option>
      <? } ?>
      </select>
      </td>
        <?  } ?>
      </tr>
<? } ?>


    </tbody>
</table>

<div class="row">
<div class="col-md-12">
  <input type="submit" value="Confirm Schedule" name="confimr_schedule" class="btn btn-primary" >
</div>
</div>
  
</form>
<? } ?>










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


<script type="text/javascript">
  function FetchZone(id){
    $('#zone').html('');
    $('#area').html('');
    $.ajax({
      type:'post',
      url: 'get_data.php',
      data : { region_id : id},
      success : function(data){
         $('#zone').html(data);
      }

    })
  }

  function FetchArea(id){ 
    $('#area').html('');
    $.ajax({
      type:'post',
      url: 'get_data.php',
      data : { zone_id : id},
      success : function(data){
         $('#area').html(data);
      }

    })
  }
</script>