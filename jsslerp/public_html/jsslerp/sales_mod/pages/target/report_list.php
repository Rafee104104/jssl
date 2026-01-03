<?php
session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";  


$today 			  = date('Y-m-d');
$company_id   = $_SESSION['company_id'];
$menu 			  = 'Report';
$sub_menu 		= 'report_list';




if(isset($_REQUEST['new']) && $_POST['randcheck']==$_SESSION['rand']){
  $_POST['group_for']=$company_id;  
  $_POST['status']='Active'; 

  @insert('user_activity_management');
  $msg="New data insert successfully";
}


if(isset($_REQUEST['delid']) && $_REQUEST['delid']>1){	
  $delid = $_REQUEST['delid'];
  mysql_query($conn, "delete from user_activity_management where user_id='".$delid."'");
  $msg="Delete successfully";
  redirect('admin_user.php');
}

if(isset($_POST['update'])){
  unset($_POST['update']);
  unset($_POST['randcheck']);
  update('user_activity_management','user_id="'.$_GET['edit_id'].'"');
  $msg= "Update successfully";
  redirect('admin_user.php');
}

$ss="select * from user_activity_management where user_id='".$_GET['edit_id']."' ";
$show2 = mysql_query($ss);
$show2=mysql_fetch_object($show2);

$title="Report List";
?>





  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">




    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">



      
<div class="row">
<div class="col-md-1"></div>

<!--1st Column --> 
  
<div class="col-md-4">
<form action="master_report.php" method="post" name="form1" target="_blank" id="form1">


<div class="form-group"><label>
<input type="radio" checked="checked" id="optionsRadios1" name="report" value="1"> SS User List (1)
</label></div>

<div class="form-group"><label>
<input type="radio"  id="optionsRadios1" name="report" value="501"> Login Report List(501)
</label></div>




<div class="form-group"><label>
<input type="radio" id="optionsRadios1" name="report" value="502"> Login Report Date wise(502)
</label></div>

<div class="form-group"><label>
<input type="radio" id="optionsRadios1" name="report" value="503"> Attendance Report(503)
</label></div>


<div class="form-group"><label>
<input type="radio" id="optionsRadios1" name="report" value="504"> Visit Report(504)
</label></div>


<br>
<div class="form-group"><label>
<input type="radio" id="optionsRadios1" name="report" value="900"> Item List(900)
</label></div>

<div class="form-group"><label>
<input type="radio" id="optionsRadios1" name="report" value="904"> Shop List(904)
</label></div>

<div class="form-group"><label>
<input type="radio" id="optionsRadios1" name="report" value="901"> Target Upload Item wise(901)
</label></div>

<div class="form-group"><label>
<input type="radio" id="optionsRadios1" name="report" value="902"> Target Upload Dealer wise(902)
</label></div>

<div class="form-group"><label>
<input type="radio" id="optionsRadios1" name="report" value="903"> Upload File(903)
</label></div>



<br>
<div><label>## Sales Report ##</lebel></div>
<div class="form-group"><label>
<input type="radio" id="optionsRadios1" name="report" value="101"> Item Wise Target/Sales (101)
</label></div>

<div class="form-group"><label>
<input type="radio" id="optionsRadios1" name="report" value="102"> Dealer Wise Target/Sales (102)
</label></div>

<div class="form-group"><label>
<input type="radio" id="optionsRadios1" name="report" value="103"> SO wise Order/Delivery Report (103)
</label></div>

<div class="form-group"><label>
<input type="radio" id="optionsRadios1" name="report" value="104"> Single Dealer Stock Report (104)
</label></div>

<div class="form-group"><label>
<input type="radio" id="optionsRadios1" name="report" value="105"> Dealer Wise Stock Report (105)
</label></div>

<div class="form-group"><label>
<input type="radio" id="optionsRadios1" name="report" value="110"> Field Officer Contribution File(110)
</label></div>











	
</div> <!-- end first part -->
    
























<!--2nd Column	-->
<div class="col-md-6">


<div class="row mb-10 form-group">
<label class="control-label col-md-4" for="product_group">Product Group</label>
<div class="col-md-8">
    <select class="form-control col-md-12" name="product_group" id="product_group">
        <option></option>
<? foreign_relation('product_group','id','group_name',$product_group,'1');?>
    </select>
</div>
</div>

  <div class="form-group row">
    <label for="inputEmail3" class="col-md-4">Item</label>
    <div class="col-md-8">
        <input list="browsers" class="form-control mb-5" name="item_id" id="item_id">
  <datalist id="browsers">
	<?php foreign_relation('item_info','item_id','item_name',$item_id,'1');?>
  </datalist>
    </div>
  </div>
 


  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label mb-10">Date</label>
    <div class="col-sm-4"><input type="date" class="form-control" id="f_date" name="f_date" autocomplete="off" value="<?=date('Y-m-01');?>"></div>
	<div class="col-sm-2"> To </div>
	<div class="col-sm-4"><input type="date" class="form-control" id="t_date" name="t_date" autocomplete="off" value="<?=date('Y-m-d');?>"></div>
  </div>  
  
  
<div class="form-group row">
    <label for="inputEmail3" class="col-md-4 col-form-label">Dealer</label>
    <div class="col-md-8 mt-10">
          <input class="form-control" list="party" name="dealer_code" id="dealer_code" value="" autocomplete="off"/>
          <datalist id="party">
        	<option></option>
        	<?php  foreign_relation('dealer_info','dealer_code','dealer_name_e',$dealer_code,'1'); ?>
          </datalist>   
    </div>  
</div>

<div class="row mb-10 form-group">
<label class="control-label col-md-4" for="region_id">Zone</label>
<div class="col-md-8">
<select class="form-control col-md-12" name="region_id" id="region" onchange="FetchZone(this.value)">
<?  foreign_relation('branch','BRANCH_ID','BRANCH_NAME',$region_id,'1');  ?> 
</select>
</div>
</div>

<div class="row mb-10 form-group">
<label class="control-label col-md-4" for="zone_id">Division</label>
<div class="col-md-8">
    <select class="form-control col-md-12" name="zone_id" id="zone" onchange="FetchArea(this.value)">
<? if($_SESSION['level']==103){ ?>
<option value="<?=$_SESSION['zone_id']?>"><?=find_a_field('zon','ZONE_NAME',"ZONE_CODE='".$_SESSION['zone_id']."'")?></option>
<? }else{ ?>
<option value="<?=$show2->zone_id?>"><?=find_a_field('zon','ZONE_NAME',"ZONE_CODE='".$show2->zone_id."'")?></option>
<? } ?>
    </select>
</div>
</div>


<div class="row mb-10 form-group">
<label class="control-label col-md-4" for="area_id">Territory</label>
<div class="col-md-8">
<select class="form-control col-md-12" name="area_id"  id="area">
<? if($_SESSION['level']==103){ ?>        
        <option value="<?=$_SESSION['area_id']?>"><?=find_a_field('area','AREA_NAME',"AREA_CODE='".$_SESSION['area_id']."'");?></option>
<? }else{ ?>
        <option value="<?=$show2->area_id?>"><?=find_a_field('area','AREA_NAME',"AREA_CODE='".$show2->area_id."'");?></option>
<? } ?>
</select>
</div>
</div>


<div class="row mb-10 form-group">
<label class="control-label col-md-4" for="year">Target Year</label>
<div class="col-md-8">
<select class="form-control col-md-12" name="year" id="year">
      <option></option>
      <option <?=($year=='2022')?'selected':''?>>2022</option>
      <option <?=($year=='2023')?'selected':''?>>2023</option>
      <option <?=($year=='2024')?'selected':''?>>2024</option>
      <option <?=($year=='2025')?'selected':''?>>2025</option>
      </select>
</div>
</div>


<div class="row mb-10 form-group">
<label class="control-label col-md-4" for="year">Target Month</label>
<div class="col-md-8">
<select class="form-control col-md-12" name="mon" id="mon">
          <option></option>
          <option value="1" <?=($mon=='1')?'selected':''?>>Jan</option>
          <option value="2" <?=($mon=='2')?'selected':''?>>Feb</option>
          <option value="3" <?=($mon=='3')?'selected':''?>>Mar</option>
          <option value="4" <?=($mon=='4')?'selected':''?>>Apr</option>
          <option value="5" <?=($mon=='5')?'selected':''?>>May</option>
          <option value="6" <?=($mon=='6')?'selected':''?>>Jun</option>
          <option value="7" <?=($mon=='7')?'selected':''?>>Jul</option>
          <option value="8" <?=($mon=='8')?'selected':''?>>Aug</option>
          <option value="9" <?=($mon=='9')?'selected':''?>>Sep</option>
          <option value="10" <?=($mon=='10')?'selected':''?>>Oct</option>
          <option value="11" <?=($mon=='11')?'selected':''?>>Nov</option>
          <option value="12" <?=($mon=='12')?'selected':''?>>Dec</option>
        </select>
</div>
</div>



  <div class="form-group row">
    <label for="" class="col-md-4">Field Officer</label>
    <div class="col-md-8">
        <input list="browsers2" class="form-control mb-5" name="so_code" id="so_code">
  <datalist id="browsers2">
	<?php  foreign_relation('ss_user','','concat(username," ",fname)',$so_code,'status=1'); ?>
  </datalist>
    </div>
  </div>












</div>

</div>  
<p></p><br>

<div class="row mt-5">
<div class="col-md-12">
<input name="submit" type="submit" class="btn btn-block btn-lg btn-success" value="Report Show" />
</div>
</div>
</form>	














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