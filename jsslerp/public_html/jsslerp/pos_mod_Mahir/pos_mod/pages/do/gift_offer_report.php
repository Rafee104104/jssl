<?php
require_once "../../../assets/template/layout.top.php";
$title='Gift Offer';

do_calander('#fdate');
do_calander('#tdate');

$table_master='sale_gift_offer';
$unique_master='id';
$page = $target_url = 'gift_offer.php';

?>


<div class="form-container_large">
<form action="" method="post" name="codz" id="codz">
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><fieldset style="width:700px;">
	      

<?php 
auto_complete_from_db('item_info','item_name','finish_goods_code','product_nature="Salable"','item_id');
?>	  
<div>
<label style="width:150px;">Item : </label>
<input style="width:355px;"  name="item_id" type="text" id="item_id" value="<? if($_POST['item_id']!='') echo $_POST['item_id'];?>"/>
</div>
      
	  
	  <div>
        <label style="width:150px;">Offer Date : </label>
		
<input style="width:155px;"  name="fdate" type="text" id="fdate" value="<? if($_POST['fdate']!=''){echo $_POST['fdate'];}else{echo date('Y-m-01');}?>"/> 
   
<input style="width:155px;"  name="tdate" type="text" id="tdate" value="<? if($_POST['tdate']!='') echo $_POST['tdate']; else echo date('Y-m-d');?>"/>
</div>
      
      </fieldset></td>
    </tr>
  <tr>
    <td><div class="buttonrow" style="margin-left:240px;">
    <? if($$unique_master>0) {?>
<!--<input name="new" type="submit" class="btn1" value="Update Demand Order" style="width:200px; font-weight:bold; font-size:12px;" tabindex="12" />-->
<input name="flag" id="flag" type="hidden" value="1" />
<? }else{?>
<input name="new" type="submit" class="btn1" value="Report" style="width:200px; font-weight:bold; font-size:12px;" tabindex="12" />
<input name="flag" id="flag" type="hidden" value="0" />
<? }?>
    </div></td>
    </tr>
</table>

<? 
if($_POST['fdate']!='')
$con .= ' and a.start_date >= "'.$_POST['fdate'].'" and a.end_date <= "'.$_POST['tdate'].'" ';

if($_POST['group_for']!='')
$con .= ' and a.group_for="'.$_POST['group_for'].'"';

if($_POST['item_id']!='')
$con .= ' and b.finish_goods_code="'.$_POST['item_id'].'"';

if($_POST['gpn']!='')
$con .= ' and a.offer_name="'.$_POST['gpn'].'"';

if($_POST['new']){
$res='select a.id,a.id,a.offer_name as offer,a.start_date as Start,a.end_date as End,
b.item_name as main_item,a.item_qty, c.item_name as gift_item,a.gift_qty
from sale_gift_offer a,item_info b,item_info c 
where b.item_id=a.item_id and c.item_id=a.gift_id 
'.$con.'
order by id desc';
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">

    <tr>
      <td><div class="tabledesign2">
        <? 
echo link_report($res,$page);
		?>

      </div></td>
    </tr>
	    	
	

				
    <tr>
     <td>

 </td>
    </tr>
  </table></form>

</div>

<?
require_once "../../../assets/template/layout.bottom.php";
?>