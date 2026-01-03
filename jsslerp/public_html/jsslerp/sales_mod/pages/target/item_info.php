<?php
session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";





$today 			= date('Y-m-d');
// $company_id   	= $_SESSION['company_id'];
$menu 			= 'Product';
$sub_menu 		= 'item_info';




if(isset($_REQUEST['delid']) && $_REQUEST['delid']>1){	
  $delid = $_REQUEST['delid'];
  mysql_query($conn, "delete from item_info where item_id='".$delid."'");
  $msg="Delete successfully";
  redirect('item_info.php');
}


?>






<!-- Main content -->
<section class="content">
<div class="container-fluid">

<div class="card mb-4">

<div class="card-body">
	<div class="col-md-12 col-sm-12 col-xs-12 pt-4 pb-4 text-center">
		<button type="button" class="btn1 btn1-bg-submit btn-md"><a href='item_manage.php'><span style="color:#FFFFFF">Add Product</span></a></button>
	</div>

<form action="" method="post">


	<div class="d-flex justify-content-center">

		<div class="n-form1 fo-short pt-3 pb-2">

			<div class="row m-0 p-0">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<div class="form-group row m-0 pl-3 pr-3">
						<label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label">Group</label>
						<div class="col-sm-9 p-0">

							<select name="item_group" required id="item_group" onchange="FetchItemCategory(this.value)">
								<option value=""></option>
								<?php foreign_relation('product_group','id','group_name',$item_group,'1'); ?>
							</select>

						</div>
					</div>


					<div class="form-group  row m-0 pl-3 pr-3">
						<label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label">Category</label>
						<div class="col-sm-9 p-0">

							<select name="category_id" id="category_id" onchange="FetchItemSubcategory(this.value)">
								<option value=""></option>
								<?php  foreign_relation('item_category','id','category_name',$category_id,'1'); ?>
							</select>

						</div>
					</div>

					<div class="form-group row m-0 pl-3 pr-3">
						<label for="group_name" class="col-sm-3 pl-0 pr-0 col-form-label">Sub Category</label>
						<div class="col-sm-9 p-0">
							<select name="subcategory_id" id="subcategory_id">
								<option value=""></option>
								<?php  foreign_relation('item_subcategory','id','subcategory_name',$subcategory_id,'1'); ?>
							</select>
						</div>
					</div>
				</div>
			</div>

			<div class="n-form-btn-class">
				<button type="submit" name="view" id="view" class="btn1 btn1-bg-submit">Search</button>

			</div>

		</div>

	</div>


</form>



<div class="content pt-4">
                     

<?php
$condition='';
$condition1='';
if($_SESSION['level']==1){
	$condition=" and product.added_by='".$_SESSION['username']."'";
	$condition1=" and added_by='".$_SESSION['username']."'";
}

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($conn,$_GET['type']);
	if($type=='status'){
		$operation=get_safe_value($conn,$_GET['operation']);
		$id=get_safe_value($conn,$_GET['id']);
		if($operation=='active'){
			$status='1';
		}else{
			$status='0';
		}
		$update_status_sql="update product set status='$status' $condition1 where id='$id'";
		mysql_query($conn,$update_status_sql);
	}
	
	if($type=='delete'){
		$id=get_safe_value($conn,$_GET['id']);
		$delete_sql="delete from product where id='$id' $condition1";
		mysql_query($conn,$delete_sql);
		// image delete pending
	}
}


$sql_cat="select id,categories from categories where 1";
$query=mysql_query($conn,$sql_cat);
while($info=mysql_fetch_object($query)){
    $cat_name[$info->id]=$info->categories;
}



if(isset($_POST['view'])){
    
    
if($_POST['item_group']!=''){ $item_group = $_POST['item_group'];
    $item_group_con=" and item_group='".$item_group."'";
}

if($_POST['category_id']!=''){ $category_id = $_POST['category_id'];
    $category_id_con=" and category_id='".$category_id."'";
}

if($_POST['subcategory_id']!=''){ $subcategory_id = $_POST['subcategory_id'];
    $subcategory_id_con=" and subcategory_id='".$subcategory_id."'";
}



$sql="select p.* from item_info p where 1 ".$item_group_con.$category_id_con.$subcategory_id_con." order by p.item_name";
}else{
$sql="select p.* from item_info p where 1 order by item_id desc limit 20";   
}

?>



<table id="example1" class="table1  table-striped table-bordered table-hover table-sm" cellspacing="0" width="100%">
	  <thead class="thead1">
							<tr class="bgc-info">
							   <th>ID</th>
							   <th>Product Code</th>
							   <th>Name</th>
							   <th>MRP</th><th>T Price</th>
							   <th></th>
							</tr>
	  </thead>
	  <tbody class="tbody1">
			<?php 
			$i=1;
            $res=mysql_query($sql);
			while($row=mysql_fetch_assoc($res)){
			    
			?>
			<tr>
			   <td><?php echo $row['item_id']?></td>
			   <td><?php echo $row['finish_goods_code']?></td>
			   <td><?php echo $row['item_name']?></td>
			   <td><?php echo $row['m_price']?></td>
			   <td><?php echo $row['t_price']?></td>
<td>
    
    
<?php if($row['status']==1){ ?>

<!-- <span id="item_status_<?=$row['id']?>">
<input name="status" type="button" value="Active" class="btn btn-success"  onclick="update_itemstatus(<?=$row['id']?>)">
</span> -->

<? }else{ ?>
<!-- <span id="item_status_<?=$row['id']?>">
<input name="status" type="button" value="Deactive" class="btn btn-warning"  onclick="update_itemstatus(<?=$row['id']?>)">
</span> -->

<? } ?>
&nbsp;<a class="btn1 btn1-bg-update" href='item_manage.php?id=<?php echo $row['item_id'];?>'>Edit</a>
&nbsp;<a class="btn1 btn1-bg-cancel" href='?type=delete&delid=<?php echo $row['item_id'];?>' onclick="return confirm('Are you sure you want to delete?')">Delete</a>


</td>
</tr>
<?php } ?>
  </tbody>

</table>


</div>




</div>

</div>
<!-- /end Body page -->

      </div><!-- /.container-fluid -->
    </section>






  <?
$main_content=ob_get_contents();
ob_end_clean();
include ("../../template/main_layout.php");
?>


<script type="text/javascript">
  function FetchItemCategory(id){
    $('#category_id').html('');
    $('#subcategory_id').html('');
    $.ajax({
      type:'post',
      url: 'get_data.php',
      data : { item_group : id},
      success : function(data){
         $('#category_id').html(data);
      }

    })
  }

  function FetchItemSubcategory(id){
    $('#subcategory_id').html('');
    $.ajax({
      type:'post',
      url: 'get_data.php',
      data : { category_id : id},
      success : function(data){
         $('#subcategory_id').html(data);
      }

    })
  }

</script>



