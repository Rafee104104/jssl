<?php
session_start();
include 'config/db.php';
include 'config/crud.php';
include 'config/function.php';
include 'config/access.php';
$user_id		=$_SESSION['user_id'];
$emp_code		=$_SESSION['username'];

$dealer_code	=$_SESSION['warehouse_id'];
$dinfo=findall("select * from dealer_info where dealer_code='".$dealer_code."' ");

$dealer_code = $dinfo->dealer_code;
$dealer_name = $dinfo->dealer_name_e;


$page="do";

include "inc/header.php";
        

$page_for           ='Sales Return';
$table_master       ='ss_receive_master';
$table_details      ='ss_receive_details';
$unique='or_no';
?>
<script>

function getXMLHTTP() { //fuction to return the xml http object

		var xmlhttp=false;	

		try{

			xmlhttp=new XMLHttpRequest();

		}

		catch(e)	{		

			try{			

				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){

				try{

				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");

				}

				catch(e1){

					xmlhttp=false;

				}

			}

		}

		 	

		return xmlhttp;

    }

	function update_value(id)

	{

var item_id=id; // Rent

//var orate=(document.getElementById('orate_'+id).value)*1;  
var odate=(document.getElementById('odate').value); 
var flag=(document.getElementById('flag_'+id).value); 

var cqty=(document.getElementById('cqty_'+id).value)*1; 
//var pqty=(document.getElementById('pqty_'+id).value)*1; 


//var strURL="ajax_setup_opening.php?item_id="+item_id+"&cqty="+cqty+"&orate="+orate+"&pqty="+pqty+"&odate="+odate+"&flag="+flag;
var strURL="ajax_setup_opening.php?item_id="+item_id+"&cqty="+cqty+"&odate="+odate+"&flag="+flag;

		var req = getXMLHTTP();

		if (req) {

			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('divi_'+id).style.display='inline';
						document.getElementById('divi_'+id).innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}
			req.open("GET", strURL, true);
			req.send(null);
		}	

}

</script>


<section class="content-main">
                <div class="content-header">
					<div>
						<center><h4 class="content-title card-title">Dealer Stock Opening</h4></center>
					</div>
            	</div>

<div class="card mb-4">
<div class="card-body">
<!--BODY Start	-->


				
<div class="form-container_large">
<form action="" method="post">

  <?

  ?>
  
  


<div class="row">
 
	<div class="row form-group col-md-4 mt-3">
		<div class="col-3"><label for="" class=" form-control-label">Party</label></div>
		<div class="col-7">
		    <?=$dealer_code;?>-<?=$dealer_name;?>
		</div>
	</div> 
    
    
	<div class="row form-group col-md-4 mt-3">
		<div class="col-3"><label for="" class=" form-control-label">Date</label></div>
		<div class="col-7">
            <input class="form-control" name="odate" type="date" id="odate" value="<?=$_POST['odate']?$_POST['odate']:date('Y-m-d');?>"/>
		</div>
	</div>
	
	
</div>

  
<div class="row">
	
	<div class="row form-group col-md-4 mt-3">
		<div class="col-3"><label for="" class=" form-control-label">Category</label></div>
		<div class="col-7">
		<select class=" form-control border border-info" name="category_id" id="category_id" onchange="FetchItemSubcategory(this.value)">
			<option value="<?=$_POST['category_id'];?>"><?=find1("select category_name from item_category where id='".$_POST['category_id']."'");?></option>
			<?php optionlist("select id,category_name from item_category where 1 order by category_name"); ?>
		</select>
		</div>
	</div>	
	
	
	<div class="row form-group col-md-4">
		<div class="col-3"><label for="" class=" form-control-label">SubCategory</label></div>
		<div class="col-7">
		    <select class=" form-control border border-info" name="subcategory_id" id="subcategory_id" onchange="FetchItem(this.value)">
				    <option value="<?=$_POST['subcategory_id'];?>"><?=find1("select subcategory_name from item_subcategory where id='".$_POST['subcategory_id']."'");?></option>
				    <?php optionlist("select id,subcategory_name from item_subcategory where 1 order by subcategory_name"); ?>
				    <option></option>
		</select>
		</div>
	</div>	
	

</div>  

<div>
<strong><input class="btn btn-success" type="submit" name="submitit" id="submitit" value="Open Item" /></strong>
</div>





<?
if(isset($_POST['submitit'])){

  if(isset($_POST['odate'])){
  $odate = $_SESSION['odate'] = $_POST['odate'];
  $sodate = date('ymd',strtotime($odate));
  }
  
if($_POST['category_id']!=''){ $cat_con=' and category_id="'.$_POST['category_id'].'"';}
if($_POST['subcategory_id']!=''){ $subcat_con=' and subcategory_id="'.$_POST['subcategory_id'].'"';}

?>
<div class="tabledesign2" style="width:100%">
<table width="100%" border="0" align="center" id="grp" cellpadding="0" cellspacing="0">
  <tr>
    <th width="40%">Item Name</th>
    <!--<th><div align="center">Item Name </div></th>-->
<!--    <th rowspan="2">Unit</th>
    <th rowspan="2"><div align="center">Price</div></th>-->
    <th width="25%"><div align="center">Stock Qty</div></th>
    <th width="35%"><div align="center"></div></th>
  </tr>
<!--  <tr>
<th>Qty</th>
<th>PCS OUT </th>
</tr>-->
<?

$tr_from = 'Opening';

$sql = "select item_price,j.item_in,j.item_ex,i.item_id 
from ss_journal_item j, item_info i 
where i.item_id=j.item_id 
and  j.warehouse_id='".$dealer_code."'  and j.tr_from='".$tr_from."' 
".$cat_con.$subcat_con."
and j.ji_date = '".$_POST['odate']."'
group by i.item_id ";

$query = mysqli_query($conn,$sql);
while($data = mysqli_fetch_object($query)){
$item_in[$data->item_id] = $data->item_in;
$item_ex[$data->item_id] = $data->item_ex;
$flag[$data->item_id] = 1;
}


$sql = "select * from item_info where 1
".$cat_con.$subcat_con."
order by item_name";
$query = mysqli_query($conn, $sql);
while($data=mysqli_fetch_object($query)){$i++;
  ?>
  <tr bgcolor="<?=($i%2)?'#E8F3FF':'#fff';?>">
    <!--<td><?=$data->finish_goods_code?></td>-->
    <td><?=$data->finish_goods_code?><br><?=$data->item_name?></td>
<!--    <td><? //=$data->unit_name?></td>
    <td width="11%">
<input name="orate_<?=$data->item_id?>" id="orate_<?=$data->item_id?>" value="<?=$data->f_price?>" style="width:40px;"/>
<input type="hidden" name="orate_<?=$data->item_id?>2" id="orate_<?=$data->item_id?>2" value="<?=($pre_stock[$data->item_id])?>" style="width:70px;"/>
</td>-->


<td width="10%"><input class="form-control" name="cqty_<?=$data->item_id?>" id="cqty_<?=$data->item_id?>" type="number" 
value="<? if($item_in[$data->item_id]>0){ echo (int)$item_in[$data->item_id];}?>" 
style="width:100px;" /></td>

<!--<td><input name="pqty_<?=$data->item_id?>" id="pqty_<?=$data->item_id?>" type="text" value="<?=(int)($item_ex[$data->item_id])?>" style="width:40px;" /><td width="0%"></td>
-->

<td><span id="divi_<?=$data->item_id?>">
            <? if($flag[$data->item_id]>0)
			  {?>
			  <input name="flag_<?=$data->item_id?>" type="hidden" id="flag_<?=$data->item_id?>" value="1" />
			  <input type="button" name="Button" value="Edit"  onclick="update_value(<?=$data->item_id?>)" style="width:50px; height:30px; background-color:#FF3366"/><?
			  }
			  else
			  {
			  ?>
			  <input name="flag_<?=$data->item_id?>" type="hidden" id="flag_<?=$data->item_id?>" value="0" />
			  <input type="button" name="Button" value="Save"  onclick="update_value(<?=$data->item_id?>)" style="width:50px; height:30px;background-color:#66CC66"/><? }?>
          </span>&nbsp;</td>
  </tr>
  <? }?>
</table>
</div>
<? }?>
<p>&nbsp;</p>
</form>
</div>				

				

</div>
<!-- main page content ends -->
</main>
<!-- Page ends-->

<?php include "inc/footer.php"; ?>


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