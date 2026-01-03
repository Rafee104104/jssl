<?php



session_start();



ob_start();



require_once "../../../assets/support/inc.all.php";







// ::::: Start Edit Section ::::: 



$title='Purchase Order Status change';			// Page Name and Page Title



$page="task_assign.php";			// PHP File Name



$root='mis';







$table1='purchase_master';					// Database Table Name Mainly related to this page

$table2='purchase_master_local';	

$unique='id';						// Primary Key of this Database table



$shown='po_date';				// For a New or Edit Data a must have data field







// ::::: End Edit Section :::::



do_calander('#po_date');







$po_no = $_REQUEST['po_no'];



$crud      =new crud($table);







$$unique = $_GET[$unique];







	$po_no = $_REQUEST['po_no'];



	$status = $_REQUEST['status'];







if(isset($_REQUEST['po_no'])!='')



{




	 		$sql1 = "update purchase_master set status = '".$status."' where po_no='".$po_no."'";
			mysql_query($sql1);
			
				
				
	

	 }





	







?><title>Status Change</title>



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



   

    <td bgcolor="#33CCFF"><strong>

 <label>PO NO </label>

      



      <input name="po_no" type="text" id="po_no" maxlength="16" value="<?=$po_no?>" required / class="form-control"> 



       



    </strong></td>








 



  <?php /*?><tr>



    <td height="35" bgcolor="#FFCCCC"><strong>New Ledger ID: </strong></td>



    <td bgcolor="#FFCCCC"><input name="new_ledger" type="text" id="new_ledger" maxlength="16" value="<?=$new_ledger?>" required /></td>



    </tr><?php */?>







  



   



  



    <td height="35" colspan="3" align="center" valign="middle" bgcolor="#33CCCC"><label>



<?php /*?>     <input name="po_no" type="text" id="po_no" value="<?=find_a_field('purchase_master','po_no','po_no='.$po_no);?>" />

<?php */?>

      Return to 

	  <select name="status" id="status" style="width:auto" class="form-control">

	  

	   <option value=""></option>

	  <option value="MANUAL">MANUAL</option>


	  

	  

	  </select>

	

     <?php /*?> <input name="status" type="text" id="status" value="<?=find_a_field('purchase_master','status','ledger_id='.$new_ledger);?>" /><?php */?>



    </label></td>



      <td rowspan="" align="center" valign="middle" bgcolor="#33CCCC"><strong>



      <label>



      <input name="search" type="submit" id="search" value="CONFIRM" / class="form-control">



        </label>



    </strong></td>



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



$main_content=ob_get_contents();



ob_end_clean();



include ("../../template/main_layout.php");



?>