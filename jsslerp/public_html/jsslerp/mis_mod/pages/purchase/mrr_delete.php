<?php

session_start();

ob_start();



require_once "../../../assets/support/inc.all.php";

// ::::: Start Edit Section ::::: 

$title='MRR Entry Delete';			// Page Name and Page Title







$pr_no = $_REQUEST['pr_no'];







if($pr_no>0)

{




$found = find_a_field('journal','tr_no','1 and tr_no = "'.$pr_no.'" and tr_from = "Purchase" ');


$pr_no = find_a_field('purchase_receive','pr_no','pr_no='.$pr_no);
$po_no = find_a_field('purchase_receive','po_no','pr_no='.$pr_no);

if($found<1){

	
	$insert_sql = "INSERT INTO journal_item_del select * from journal_item where tr_from ='Purchase' and  sr_no=".$pr_no."";
	mysql_query($insert_sql);
	
	
	

	$sql = "DELETE FROM `purchase_receive` WHERE pr_no=".$pr_no."";

	mysql_query($sql);

	$sql2 = "DELETE FROM `journal_item` WHERE tr_from ='Purchase' and  sr_no=".$pr_no."";

	mysql_query($sql2);

	
	$sql3 = "DELETE FROM `secondary_journal` WHERE tr_no=".$pr_no." and tr_from ='Purchase'";

	mysql_query($sql3);
	
//	$sql4 = "DELETE FROM `journal` WHERE tr_no=".$pr_no." and tr_from ='Purchase'";
//
//	mysql_query($sql4);
//	
	
	
	$sql5 = "UPDATE  `purchase_master` set status='CHECKED' WHERE po_no=".$po_no."";

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

		
		<div class="alert alert-danger p-2" role="alert">
  			Sorry Journal Exists!
		</div>


		<!--<table width="50%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FF0000">

      <tr>

        <td><div align="center" class="style2">Sorry Journal Exists! </div></td>

      </tr>

    </table>-->

<? 

}

elseif($pr_no>0)

{



?>

		<div class="alert alert-success p-2" role="alert">
  			MRR Deleted Successfull
		</div>



		<!--<table width="50%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#99FF66">

      <tr>

        <td><div align="center" class="style2">MRR Deleted Successfull </div></td>

      </tr>

    </table>-->

<? }?>




<form action="" method="post">
	<div class="container-fluid bg-form-titel">
				<div class="row">
				<div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
						
					  
					   
					</div>
					<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<div class="form-group row m-0">
							<label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">MRR No</label>
							<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
								<input name="pr_no" type="text" id="pr_no" maxlength="16" value="<?=$pr_no?>" required />
							</div>
						</div>
	
					</div>
					
	
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
						<input name="search" class="btn1 btn1-submit-input" type="submit" id="search" value="Delete MRR" />
					  
					   
					</div>
	
				</div>
			</div>
	</form>



<!--<form action="" method="post">

<div class="oe_view_manager oe_view_manager_current">

        


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
  

    <td height="35" bgcolor="#33CCFF"><strong>MRR NO: </strong></td>

    <td bgcolor="#33CCFF"><input name="pr_no" type="text" id="pr_no" maxlength="16" value="<?=$pr_no?>" required /></td>

    <td align="center" valign="middle"><input name="search" class="btn1 btn1-submit-input" type="submit" id="search" value="Delete MRR" /></td>

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

</form>-->

<?
$main_content=ob_get_contents();



ob_end_clean();


include ("../../template/main_layout.php");

?>