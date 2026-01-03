<?php

session_start();

ob_start();



require_once "../../../assets/template/layout.top.php";

// ::::: Start Edit Section ::::: 

$title='Sales Return Delete';			// Page Name and Page Title







$chalan_no = $_REQUEST['chalan_no'];


$type = find_a_field('sale_return_master s,sales_return_type t','t.sales_return_type','1 and s.do_no = "'.$chalan_no.'" and s.sales_type=t.id');


if($chalan_no>0)

{

$found = find_a_field('journal','tr_no','1 and tr_no = "'.$chalan_no.'" and tr_from = "'.$type.'" ');

if($found<1){


	$insert_sql = "INSERT INTO journal_item_del select * from journal_item where tr_from ='".$type."' and  sr_no=".$chalan_no."";
	mysql_query($insert_sql);
	

	$sql1 = "DELETE FROM `sale_return_master` WHERE  do_no=".$chalan_no."";

	mysql_query($sql1);
	
	$sql4 = "DELETE FROM `sale_return_details` WHERE  do_no=".$chalan_no."";

	mysql_query($sql4);

	$sql2 = "DELETE FROM `journal_item` WHERE tr_from ='".$type."' and  sr_no=".$chalan_no."";

	mysql_query($sql2);

	$sql3 = "DELETE FROM `secondary_journal` WHERE tr_from ='".$type."' and  tr_no=".$chalan_no."";

	mysql_query($sql3);



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

if($found>0){

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

elseif($chalan_no>0)

{



?>


		<div class="alert alert-success p-2" role="alert">
  			Successfull
		</div>
		

		<!--<table width="50%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#99FF66">

      <tr>

        <td><div align="center" class="style2">SR Deleted Successfull </div></td>

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
							<label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">SR No</label>
							<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
								<input name="chalan_no" type="text" id="chalan_no" value="<?=$chalan_no?>" required />
							</div>
						</div>
	
					</div>
					
	
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
						<input name="search" type="submit" class="btn1 btn1-submit-input" id="search" value="Delete Chalan" />
					  
					   
					</div>
	
				</div>
			</div>
	</form>



<?php /*?><form action="" method="post">

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

    <td height="35" bgcolor="#33CCFF"><strong>Sr No: </strong></td>

    <td bgcolor="#33CCFF"><input name="chalan_no" type="text" id="chalan_no" maxlength="16" value="<?=$chalan_no?>" required /></td>

    <td align="center" valign="middle" bgcolor="#33CCCC"><input name="search" type="submit" class="btn1 btn1-submit-input" id="search" value="Delete Chalan" /></td>

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

</form><?php */?>

<?

require_once "../../../assets/template/layout.bottom.php";

?>