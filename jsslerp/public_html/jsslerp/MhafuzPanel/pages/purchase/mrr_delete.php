<?php

session_start();

ob_start();



require "../../../warehouse_mod/support/inc.all.php";

// ::::: Start Edit Section ::::: 

$title='MRR Entry Delete';			// Page Name and Page Title







$pr_no = $_REQUEST['pr_no'];







if($pr_no>0 && $_POST['type']=="head")

{




$found = find_a_field('secondary_journal','checked','1 and tr_no = "'.$pr_no.'" and tr_from = "Purchase" ');


$pr_no = find_a_field('purchase_receive','pr_no','pr_no='.$pr_no);
$po_no = find_a_field('purchase_receive','po_no','pr_no='.$pr_no);

if($found=="NO"){

	

	$sql = "DELETE FROM `purchase_receive` WHERE pr_no=".$pr_no."";

	mysql_query($sql);

	$sql2 = "DELETE FROM `journal_item` WHERE tr_from ='Purchase' and  sr_no=".$pr_no."";

	mysql_query($sql2);

	
	$sql3 = "DELETE FROM `secondary_journal` WHERE tr_no=".$pr_no." and tr_from ='Purchase'";

	mysql_query($sql3);
	
	$sql4 = "DELETE FROM `journal` WHERE tr_no=".$pr_no." and tr_from ='Purchase'";

	mysql_query($sql4);
	
	
	
	$sql5 = "UPDATE  `purchase_master` set status='CHECKED' WHERE po_no=".$po_no."";

	mysql_query($sql5);

}




}
else {
	
	


$found = find_a_field('secondary_journal','checked','1 and tr_no = "'.$pr_no.'" and tr_from = "Local Purchase" ');


$pr_no = find_a_field('purchase_receive_local','pr_no','pr_no='.$pr_no);
$po_no = find_a_field('purchase_receive_local','po_no','pr_no='.$pr_no);

if($found=="NO"){

	

	$sql = "DELETE FROM `purchase_receive_local` WHERE pr_no=".$pr_no."";

	mysql_query($sql);

	$sql2 = "DELETE FROM `journal_item` WHERE tr_from ='Local Purchase' and  sr_no=".$pr_no."";

	mysql_query($sql2);

	
	$sql3 = "DELETE FROM `secondary_journal` WHERE tr_no=".$pr_no." and tr_from ='Local Purchase'";

	mysql_query($sql3);
	
	$sql4 = "DELETE FROM `journal` WHERE tr_no=".$pr_no." and tr_from ='Local Purchase'";

	mysql_query($sql4);
	
	$sql5 = "UPDATE  `purchase_master_local` set status='CHECKED' WHERE po_no=".$po_no."";

	mysql_query($sql5);

}

	
}



	?>

<style type="text/css">

<!--

.style1 {

	color: #FF0000;

	font-weight: bold;

}

.style2 {

	color: #006600;

	font-weight: bold;

}

-->

</style>

<? 

if($found=="YES"){

?>

		<title>MRR Delete</title><table width="50%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FF0000">

      <tr>

        <td><div align="center" class="style2">Sorry Journal Exists! </div></td>

      </tr>

    </table>

<? 

}

elseif($pr_no>0)

{



?>

		<table width="50%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#99FF66">

      <tr>

        <td><div align="center" class="style2">MRR Deleted Successfull </div></td>

      </tr>

    </table>

<? }?>



<form action="" method="post">

<div class="oe_view_manager oe_view_manager_current">

        

    <? include('../../common/title_bar.php');?>

        <div class="oe_view_manager_body">

            

                <div  class="oe_view_manager_view_list"></div>

            

                <div class="oe_view_manager_view_form"><div style="opacity: 1;" class="oe_formview oe_view oe_form_editable">

        <div class="oe_form_buttons"></div>

        <div class="oe_form_sidebar"></div>

        <div class="oe_form_pager"></div>

        <div class="oe_form_container"><div class="oe_form">

          <div class="">

<div class="oe_form_sheetbg" style="min-height:10px;">

        <div class="oe_form_sheet oe_form_sheet_width">



          <div  class="oe_view_manager_view_list"><div  class="oe_list oe_view">

           	 <table width="85%" border="0" align="center" cellpadding="5" cellspacing="0">

  <tr>
  
  	 <td height="35" bgcolor="#33CCFF"><strong>MRR Type: </strong></td>

    <td bgcolor="#33CCFF">
	<select name="type" id="type">
	
	<option value="head">Head Office</option>
	<option value="local">Factory</option>
	
	</select>
	</td>

    <td height="35" bgcolor="#33CCFF"><strong>MRR NO: </strong></td>

    <td bgcolor="#33CCFF"><input name="pr_no" type="text" id="pr_no" maxlength="16" value="<?=$pr_no?>" required /></td>

    <td align="center" valign="middle" bgcolor="#33CCCC"><input name="search" type="submit" id="search" value="Delete MRR" /></td>

  </tr>

  



</table>



		

		  

          </div></div>

          </div>

    </div>

    <div class="oe_chatter"><div class="oe_followers oe_form_invisible">

      <div class="oe_follower_list"></div>

    </div></div></div></div></div>

    </div></div>

            

        </div>

  </div>

</form>

<?

require_once "../../../assets/template/layout.bottom.php";

?>