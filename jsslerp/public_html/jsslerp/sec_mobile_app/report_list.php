<?php
session_start();
include 'config/access.php';
include 'config/db.php';
include 'config/function.php';

$user_id	=$_SESSION['user_id'];
$emp_code	=$_SESSION['username'];
$dealer_code=$_SESSION['warehouse_id'];
$page       ="report_list";

include "inc/header.php";

?>
<!-- main page content -->
<div class="main-container container">
            
<div class="row text-center mb-3"><h3>Report List</h3></div>

<form action="report_view.php" method="post" id="demo" data-parsley-validate class="form-horizontal form-label-left">					


<div class="row mb-2">

	<div class="radio"><label>
	<input type="radio" checked="checked" id="optionsRadios1" name="report" value="101">Target Vs Sales Report(101)
	</label></div>
	
	<div class="radio"><label>
	<input type="radio" id="optionsRadios1" name="report" value="102">Target/Pri DO Report (102)
	</label></div>
	
	<div class="radio"><label>
	<input type="radio" id="optionsRadios1" name="report" value="103">Target/Pri Chalan Report (103)
	</label></div>	
	
	<div class="radio"><label>
	<input type="radio" id="optionsRadios1" name="report" value="104">Dealer Stock Report (104)
	</label></div>
	
	<div class="radio"><label><input type="radio" id="optionsRadios1" name="report" value="105">Shop List (105)</label></div>
	
	<div class="radio"><label><input type="radio" id="optionsRadios1" name="report" value="201">Opening Qty Entry Report (201)</label></div>
	<div class="radio"><label><input type="radio" id="optionsRadios1" name="report" value="202">Product List (202)</label></div>


<div class="mt-2"></div>

	<div class="radio"><label><input type="radio" id="optionsRadios1" name="report" value="51">Order List (51)</label></div>
	<div class="radio"><label><input type="radio" id="optionsRadios1" name="report" value="54">Party wise Order List (54)</label></div>
	<div class="radio"><label><input type="radio" id="optionsRadios1" name="report" value="52">Delivery Report (52)</label></div>
	<div class="radio"><label><input type="radio" id="optionsRadios1" name="report" value="55">Party wise Delivery Report (55)</label></div>
	<div class="radio"><label><input type="radio" id="optionsRadios1" name="report" value="57">Pending Order List (57)</label></div>
	
	
	<div class="radio"><label><input type="radio" id="optionsRadios1" name="report" value="53">Target Vs Order Vs Delivery(Item wise) (53)</label></div>
	
	<div class="radio"><label><input type="radio" id="optionsRadios1" name="report" value="56">Monthly Product Group wise Report (56)</label></div>
	<div class="radio"><label><input type="radio" id="optionsRadios1" name="report" value="58">Target Progress Status (58)</label></div>






<br><p></p>
</div> <!--end row-->











<br>


<div><strong>Report Filter</strong></div>

<div class="row mt-2 mb-10 mb-2">
	<div class="col-4"><label class="control-label" for="">Company<span class="required"></span></label></div>
	<div class="col-7">
                <select class="form-control" name="group_for" id="group_for">
                      <option></option>
                        <? foreign_relation('user_group','id','company_short_code',$group_for,'1 order by company_short_code');?>
                </select>
	</div>
</div>

<div class="row mt-2 mb-10 mb-2">
	<div class="col-4"><label class="control-label" for="">Group<span class="required"></span></label></div>
	<div class="col-7">
                <select class="form-control" name="item_group" id="item_group" onchange="FetchItemCategory(this.value)">
                      <option></option>
                        <? foreign_relation('product_group','id','group_name',$product_group,'1 order by group_name');?>
                </select>
	</div>
</div>



<div class="row mt-2 mb-10 mb-2">
	<div class="col-4"><label class="control-label" for="">Category<span class="required"></span></label></div>
	<div class="col-7">
                       <select class="form-control" name="category_id" id="category_id" onchange="FetchItemSubcategory(this.value)">
                      		<option></option>
							<? foreign_relation('item_category','id','category_name',$category_name,'1 order by category_name');?>
                    	</select>
	</div>
</div>


<div class="row mt-2 mb-10 mb-2">
	<div class="col-4"><label class="control-label" for="">SubCategory<span class="required"></span></label></div>
	<div class="col-7">
                       <!--onchange="FetchItem(this.value)"-->
                       <select class="form-control" name="subcategory_id" id="subcategory_id" >
                      		<option></option>
							<? foreign_relation('item_subcategory','id','subcategory_name',$subcategory_name,'1 order by subcategory_name');?>
                    	</select>
	</div>
</div>


<div class="row mt-2 mb-10 mb-2">
	<div class="col-4"><label class="control-label" for="market_id">Shop<span class="required"></span></label></div>
	<div class="col-7"><select type="text" name="dealer_code" autocomplete="off" value="<?=$show->dealer_code?>" class="form-control">
	        <option></option>
            <? optionlist("select dealer_code,shop_name from ss_shop 
			where region_id='".$_SESSION['region_id']."' 
			and zone_id='".$_SESSION['zone_id']."' 
			and area_id='".$_SESSION['area_id']."' 
			order by region_id,zone_id,area_id,shop_name");
			?>
	    </select></div>
</div>


<div class="row mb-10 mb-2">
	<div class="col-4"><label class="control-label" for="shop_name">From Date<span class="required"></span></label></div>
	<div class="col-7"><input type="date" name="f_date" required="required" autocomplete="off" value="<?=date('Y-m-01')?>" class="form-control"></div>
</div>

<div class="row mb-10 mb-2">
	<div class="col-4"><label class="control-label" for="shop_name">To Date<span class="required"></span></label></div>
	<div class="col-7"><input type="date" name="t_date" required="required" autocomplete="off" value="<?=date('Y-m-d')?>" class="form-control"></div>
</div>




			
											  
<div class="ln_solid mt-2"></div>
<div class="form-group">
    <div class="col-md-6 col-sm-6 col-md-offset-3">

            <div class="col-11 col-sm-11 mt-auto mx-auto py-4">
                <div class="row ">
                    <div class="col-12 d-grid">
                        <button type="submit" name="submit" class="btn btn-default btn-lg btn-rounded shadow-sm">Report View</button>
                    </div>
                </div>
            </div>

    </div>
</div>
</form>	






<!-- User list items  -->


           
           
           

</div>
<!-- main page content ends -->
</main>
<!-- Page ends-->


<?php include "inc/footer.php"; ?>


<script type="text/javascript">
  function FetchItemCategory(id){
    $('#category_id').html('');
    $('#subcategory_id').html('');
    $('#item_id').html('');
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
    $('#item_id').html('');
    $.ajax({
      type:'post',
      url: 'get_data.php',
      data : { category_id : id},
      success : function(data){
         $('#subcategory_id').html(data);
      }

    })
  }


  function FetchItem(id){
    $('#item_id').html('');
    $.ajax({
      type:'post',
      url: 'get_data.php',
      data : { subcategory_id : id},
      success : function(data){
         $('#browsers').html(data);
      }

    })
  }


</script>