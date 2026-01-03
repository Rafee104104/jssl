<?php
session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";

//require_once ('../../../acc_mod/common/class.numbertoword.php');
$title='Token and Store Receive Delete';



?>

  
  <?
		if(isset($_POST['challan_view']))
		
		{
		
		header("Location:token_delete.php?chalan_no=".$_POST['challan_no']." ");
		
		
		}


?>
<script language="javascript">
window.onload = function() {
  document.getElementById("dealer").focus();
}
</script>
<script language="javascript">
function custom(theUrl)
{
	window.open('<?=$target_url?>?v_no='+theUrl);
}

function hide()



{



    document.getElementById("pr").style.display="none";



}
</script>


<style type="text/css">

<!--

.style1 {color: #FF0000}
.style2 {
	font-weight: bold;
	color: #000000;
	font-size: 14px;
}
.style3 {color: #FFFFFF}

-->





/*.ui-state-default a, .ui-state-default a:link, .ui-state-default a:visited, a.ui-button, a:link.ui-button, a:visited.ui-button, .ui-button {
    color: #454545;
    text-decoration: none;
    display: none;
}*/

<!--
.header table tr td table tr td table tr td table tr td {
	color: #000;
}




@font-face {
  font-family: 'Andina Demo';
  src: url('Andina Demo.otf'); /* IE9 Compat Modes */

}





/*@media print{
.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;

   color: white;
   text-align: center;
}
}*/
-->
div.page_brack
{
    page-break-after:always;
}

div.form-container_large input {
    width: 280px;
    height: 38px;
    border-radius: 0px !important;
}

tr:nth-child(odd){
    
    
    color:white;
}

</style>
<?




if(isset($_POST['wo_delete']))
{
    	$all_data=find_all_field('sr_token','*','sr_id="'.$_GET['chalan_no'].'" ');
    	
    	
        if($all_data->sr_id==$_GET['chalan_no'])
        
        {
    
			$rec_no=find_a_field('warehouse_other_receive','or_no','token_number='.$all_data->serial_number.' and rec_year='.$all_data->token_year.' and bag_mark="'.$all_data->sr_number.'"');
				
				
			if($rec_no>0)	
			{
			$delete_user=$_SESSION['user']['id'];
	 		$delete_time=date('Y-m-d  h:i:sa');
		  $in_back_query='insert into journal_item_delete_log select * from journal_item where sr_no="'.$rec_no.'" and tr_from="Other Receive" and barcode="'.$all_data->sr_number.'"';
		 mysql_query($in_back_query);
		 
		 $up_sql='update journal_item_delete_log  set delete_by="'.$delete_user.'",delete_at="'.$delete_time.'" where sr_no="'.$rec_no.'" and tr_from="Other Receive" and barcode="'.$all_data->sr_number.'" ';
	 	mysql_query($up_sql);
		 
		 
		   $challan_queyr='insert into warehouse_other_receive_delete_log select * from warehouse_other_receive where or_no="'.$rec_no.'" ';
		 mysql_query($challan_queyr);
	
		 $challan_queyr2='insert into warehouse_other_receive_detail_delete_log select * from warehouse_other_receive_detail where or_no="'.$rec_no.'" ';
		 mysql_query($challan_queyr2);
		 
		 $challan_queyr2='insert into sr_token_delete_log select * from sr_token where sr_id="'.$_GET['chalan_no'].'" ';
		 mysql_query($challan_queyr2);
		   
	 
			}
		 
		 
		 
		 
		
		 $delete_sec_journal="delete from journal_item where sr_no='".$rec_no."' and tr_from='Other Receive' and barcode='".$all_data->sr_number."' ";
		 mysql_query($delete_sec_journal);
		
		 $delete_joural_item2="delete from warehouse_other_receive_detail where or_no='".$rec_no."' ";
		 mysql_query($delete_joural_item2);
		 
		 $delete_joural_item3="delete from warehouse_other_receive where or_no='".$rec_no."' ";
		 mysql_query($delete_joural_item3);
		
		
		 $delete_challan="delete from sr_token where sr_id='".$_GET['chalan_no']."' ";
		
		 $result=mysql_query($delete_challan);
		 
 		
		     
 		     echo "<h2 style='color:white;background-color:green;font-weight:bold;text-align:center;'>Token & Store Receive Delete Successfully!!!!</h2>";
 		

        }
		
		else{
            
             echo "<h2 style='color:white;background-color:red;font-weight:bold;text-align:center;'>Invalid Serial NO !!!!</h2>";
            
        }

}

?>






<div class="form-container_large">
  <form action="" method="post" name="codz" id="codz">
    <table width="80%" border="0" align="center">
      
      
      <tr>
        <td align="right" bgcolor="#FF9966"><strong>Token Serial No:</strong></td>
        <td colspan="3" bgcolor="#FF9966">
		<input type="text" name="challan_no" id="challan_no" required class="form-control" value="<?=$_POST['challan_no']?>" />		</td>
		<td><input type="submit" name="challan_view" id="challan_view" value="Token View"  class="btn1 btn1-bg-submit" /></td>
      </tr>
      
      
      
    </table>
  </form>
  
<br /><br />
  
  <? 
    $count= find_a_field('sr_token','count(sr_id)','sr_id="'.$_GET['chalan_no'].'" ');
  	if($count>0){
  
  ?>
  
  
  
  
  
  <? 
  
  $sr_id 		= $_GET['chalan_no'];


$token=find_all_field('sr_token','','sr_id='.$_GET['chalan_no']);




  
  ?>

<table width="1000" border="0" cellspacing="0" cellpadding="0" align="center">
  <tbody>
  <tr>
    <td><div class="header">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="15%">
                      <?php /*?>  <img src="../../../logo/<?=$master->group_for?>.png" width="100%" /><?php */?>
                        <td width="60%"><table  width="80%" border="0" align="center" cellpadding="3" cellspacing="0">
                            <tr>
                              <td style="text-align:center; color:#000; font-size:14px; font-weight:bold;">
						
								<p style="font-size:20px; color:#000000; margin:0; padding:0; text-transform:uppercase;"><?=find_a_field('user_group','group_name','id='.$master->group_for)?></p>
								<p style="font-size:14px; font-weight:300; color:#000000; margin:0; padding:0;"><?=find_a_field('user_group','address','id='.$master->group_for)?></p>                              </td>
                            </tr>
                            <tr>


        <!--<td bgcolor="#666666" style="text-align:center; color:#FFF; font-size:18px; font-weight:bold;">WORK ORDER </td>-->
      </tr>
                          </table>
                        <td width="20%"> 
						
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					
					<tr>
					  
					  <td align="center"><h4 style="font-size:16px;">Customer's Copy</h4></td>
					  
					  </tr>
                      
					  
					  <tr>
					  
					  <td><?='<img class="barcode" alt="'.$barcodeText.'" src="barcode.php?text='.$barcodeText.'&codetype='.$barcodeType.'&orientation='.$barcodeDisplay.'&size='.$barcodeSize.'&print='.$printText.'"/>' ?></td>
					  
					  </tr>
					  
					  <tr>
					  
					  <td><span style="font-size:14px; padding: 3px 0 0 10px; letter-spacing:7px;"><?=$chalan_no?></span></td>
					  
					  </tr>
					  </table>
							
						</td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            
          </tr>
        </table>
      </div></td>
  </tr>
  

 
 
 
 
 
 

 
  <tr> <td><hr /></td></tr>
 
  
  
  <tr> <td>
  <table width="100%" border="0" cellspacing="0" cellpadding="0"  style="font-size:12px">
  
  	<tr height="30">
  	  <td valign="top"></td>
  	  <td  style="text-align:center; color:#FFF; font-size:18px; padding:0px 0px 10px 0px; color:#000000; font-weight:bold;">Token &amp; Store Receive </td>
  	  <td valign="right" align="right">&nbsp;</td>
	  </tr>
  	<tr>
		<td width="25%" valign="top"></td>
			<td width="50%" valign="middle" align="center"><strong><!--FSC CERTIFICATE CODE: SCS-COC-007014--> </strong></td>
		<td width="25%" valign="right" align="right"><?php /*?><strong>Challan Date: <?=date("d M, Y",strtotime($ch_data->chalan_date))?><?php */?></strong></td>
	</tr>
	
	
	
  </table>
  
  </td></tr>
  
  
  <tr> <td>&nbsp;</td></tr>
  
  
  
 <tr> <td><table width="100%" border="0" cellspacing="0" cellpadding="0">


		  <tr>


		    <td width="100%" valign="top">


		      <table width="100%" border="0" cellspacing="0" cellpadding="3"  style="font-size:12px">


		        <tr>
		          
	              <td >Token No </td>
	              <td >: &nbsp;<?=$token->serial_number;?></td>
				  <td  align="left" valign="middle">Token Serial No  </td>
		          <td>:	&nbsp;
	              <?=$token->sr_id;?></td>
	              <td>Receive No  </td>
	              <td>: &nbsp;<?=find_a_field('warehouse_other_receive','receipt_number','token_number="'.$token->serial_number.'" and rec_year="'.$token->token_year.'"');?></td>
	              <td>Booking No </td>
	              <td>: &nbsp;<?=$token->booking_number;?></td>
		        </tr>
		        <tr>
		          <td align="left" valign="middle">Bag Mark </td>
		          <td>:	&nbsp;
                    <?=$token->sr_number;?></td>
	              <td>Qty</td>
	              <td>: &nbsp;<?=$token->quantity;?></td>
	              <td>Token Date </td>
	              <td>: &nbsp;<?php echo date('d-m-Y',strtotime($token->date));?></td>
	              <td>Year</td>
	              <td>: &nbsp;<?=$token->token_year;?></td>
		        </tr>
		        <tr>
		          <td align="left" valign="middle">Agent Name</td>
		          <td>:	&nbsp;
	             <?=$token->agent_name;?></td>
	              <td>Farmer Name</td>
	              <td>: &nbsp;<?= $token->farmer_name;?></td>
	              <td>Village</td>
	              <td>: &nbsp;<?=$token->area;?></td>
	              <td>Status </td>
	              <td>: &nbsp;<?=$token->status;?></td>
		        </tr>
		        
		        <tr>
				<td colspan="8" align="center">
				
				</td>
				
				<tr>
				<td colspan="8" align="center">
				<form  method="post"><input type="submit" name="wo_delete" id="wo_delete" value="Delete Token & Store Rec" class="btn1 btn1-bg-cancel"  /></form>
				</td>
				</tr>
				
		        
		        </table>		      </td>


			
		  </tr>


		</table>		</td></tr>
  
  
 
  
  
  
  
  
  <tr>
  
  	<td>&nbsp;</td>
  
  </tr>
  

  
  
  
	
	
	

	
  
  </tbody>
</table>


</div>

<? } 
  




$main_content=ob_get_contents();
ob_end_clean();
include ("../../template/main_layout.php");
?>