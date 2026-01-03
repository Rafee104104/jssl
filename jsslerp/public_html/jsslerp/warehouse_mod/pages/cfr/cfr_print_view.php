<?php
session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";



$req_no 		= $_REQUEST['req_no'];

$sql="select * from requisition_master_cfr where  req_no='$req_no'";
$data=mysql_query($sql);
$all=mysql_fetch_object($data);
$all->entry_by;

$emp = find_all_field('personnel_basic_info','PBI_NAME','PBI_ID='.$all->entry_by);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Cash Fund Requsition Copy</title>
<link href="../../css/invoice.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript">
function hide()
{
    document.getElementById("pr").style.display="none";
}

function company_info(val){
  if(val=='Natura'){
    document.getElementById("company_name").innerHTML="Natura Agro Processing Ltd.";
  }else{ 
    document.getElementById("company_name").innerHTML="Jamuna Edible Oil Industries Ltd.";
  }
}
</script>
<style>
.header2_left{
	float:left;
}
.header2_right{
	float:right;
}


</style>
</head>
<body>
<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><div class="header">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
	    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
			
			   <tr>
                <td style="text-align:center">
			<h1 id="company_name" >Jamuna Seeds Storage (Pvt.) Ltd.</h1>
			
			<b><?=find_a_field('user_group','address','1')?></b>
			<?php echo "<br/>"; ?>
			<?=find_a_field('user_group','factory_address','1')?>
			 <!--<h4 style="line-height: 0px !important;">Corporate Office Address : Rosabella Tower , House # 18, Road # 05, Sector # 01, Uttara, Dhaka-1230</h4>-->
			<!-- <p>Factory Address : Kalupara, Daukandi, Paba, Rajshahi, Bangladesh</p>-->
			   </td>
               </tr>
	
               <tr>
                <td>
				<div class="header_title" style="text-align:center">
			   <h2> Cash Fund Requisition Form</h2>
				<div class=""
				</div>
	
				</div></td>
              </tr>
			  
	
            </table></td>
          </tr>

        </table></td>
	    </tr>
	  <tr>
	    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
		    <td align="center" valign="bottom"><strong>
		     
		    </strong></td>
			</tr>
		</table>		</td>
	  </tr>
    </table>
    </div></td>
  </tr>
  <tr>
    
	<td>	</td>
  </tr>
  <tr>
    <td><div class="line"></div></td>
  </tr>
  <tr>
    <td><div class="header_title">
        <div class="header2_left">
		<p> <strong>Req No:</strong> <?= $all->req_no;?></p>
        <p><strong></strong>
          <strong>Name:</strong> <?=find_a_field('user_activity_management','fname','user_id='.$all->entry_by)?><br /><br />
          <strong>Designation:</strong> <?php echo $emp->PBI_DESIGNATION;?><br /><br />
          <?php /*?><strong>Sister Concern:</strong> <?php echo find_a_field('user_group','group_name','id='.$emp->PBI_ORG);?><br /><br /><?php */?>
		  
<?php /*?>		  <?php echo find_a_field('user_group','group_name','id='.$emp->PBI_ORG);?><br /><br />
<?php */?>
        </p>
      </div>
      <div class="header2_right">
        <p>
	      <p><strong>Date: <?php echo $all->req_date;?></strong></p>

          
          
		  <strong>Cell Phone:</strong> <?php echo $emp->PBI_MOBILE;?><br /><br />
          <strong>Department:</strong> <?php echo $emp->PBI_DEPARTMENT;?><br /><br />
          <?php /*?><strong>Stuff ID:</strong> <?php echo $emp->PBI_ID;?><br /><?php */?>

        </p>
      </div>
    </div></td>
  </tr>
  <tr>
    <td>
	<div id="pr">
<div align="left">
<form action="" method="get">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="1"><input name="button" type="button" onclick="hide();window.print();" value="Print" /></td>
	<!--<td><div><select onchange="company_info(this.value)" name="company" id="company">
            <option value="Natura">Natura</option>
            <option value="Jamuna">Jamuna</option>
          </select></div></td>-->
	
  </tr>
</table>

</form>
</div>
</div>
<table width="100%" style="text-align:center" class="tabledesign" border="1px"; bordercolor="#000000" cellspacing="0" cellpadding="0">
       
       <tr>
         <td width="6%"><strong>SL.</strong></td>
         <td width="27%"><strong>Particulars</strong></td>
		 <td width="11%"><strong>Need Amount</strong></td>
         <td width="11%"><strong>Actual Amount</strong></td>
		 <td width="11%"><strong>Estimate Value</strong></td>
         <td width="22%"><strong>Last Receive Date </strong></td>
    
         <td width="14%">Remarks</td>
       </tr>
	  <?php
$final_amt=(int)$data1[0];
$pi=0;
$total=0;
$sql2="select * from requisition_order_cfr where  req_no='$req_no'";
$data2=mysql_query($sql2);
//echo $sql2;
while($info=mysql_fetch_object($data2)){ 
$pi++;
$amount=$info->qty*$info->rate;
$total=$total+($info->amount);
$need_amnt=$need_amnt+($info->need_amnt);
$est_value=$est_value+($info->est_value);


$sl=$pi;
?>
      <tr>
        <td valign="center"><?=$sl?></td>
        <td align="center" valign="center"><?=$info->particulars?></td>
		<td valign="center"><?=number_format($info->need_amnt,2)?></td>
        <td valign="center"><?=number_format($info->amount,2)?></td>
		<td valign="center"><?=number_format($info->est_value,2)?></td>
		<td valign="center"><?=$info->last_rec_date?></td>
   
		        <td valign="center"><?=$info->item_for?></td>

        </tr>
<? }?>


 <tr>    
          
         <td colspan="2" align="center">     <strong>Total:</strong>  </td>  
        <td ><?php echo"$need_amnt" ?> </td>
		<td ><?php echo"$total" ?> </td>
		<td ><?php echo"$est_value" ?> </td>
		 <td>&nbsp;</td>
         <td>&nbsp;</td>
		 

        </tr>
		
 <tr>
      <td colspan="7" align="left"> <strong>In Word:</strong> </td>
        </tr>
		

    </table></td>
  </tr>
  <tr>
    <td> </td>
  </tr>
  
  <tr>
    <td height="187" style="text-align:left; margin-left:50px;">

    <div class="footer1">
            <table width="1102" border="0">
			<tr><td height="58"></td>
			</tr>
			<tr><td></td></tr>
			<tr><td></td></tr>
				

              <tr>
 
		  <td align="center"><?=find_a_field('user_activity_management','fname','user_id='.$all->entry_by)?></td>
		   <td align="center"><?=find_a_field('user_activity_management','fname','user_id='.$all->approve0_id);?></td>
		  <td align="center"><?=find_a_field('user_activity_management','fname','user_id='.$all->approve2_id);?></td>
		  		  <td align="center"><?=find_a_field('user_activity_management','fname','user_id='.$all->approve1_id);?></td>
				  <td align="center"><?=find_a_field('user_activity_management','fname','user_id='.$all->approve3gm_id);?></td>
				  
				  <td align="center"><?=find_a_field('user_activity_management','fname','user_id='.$all->approve3_id);?></td>
        		  <td align="center"><?=find_a_field('user_activity_management','fname','user_id='.$all->approve5_id);?></td>
       		     <td align="center"><?=find_a_field('user_activity_management','fname','user_id='.$all->approve4_id);?></td>
				 <td align="center"><?=find_a_field('user_activity_management','fname','user_id='.$all->checked_by);?></td>
       </tr>

                <tr>
                    <td align="center">----------------</td>
  					<td align="center">----------------</td>
					<td align="center">----------------</td>
  					<td align="center">----------------</td>
					<td align="center">----------------</td>
  					<td align="center">----------------</td>
  					<td align="center">----------------</td>
  					<td align="center">----------------</td>
  					<td align="center">----------------</td>
                </tr>
                <tr>
                    <td align="center"><strong>Prepared By</strong></td>
					<td align="center"><strong>Operation Manager</strong></td>
                    <td align="center"><strong>Accounts Manager (Store)</strong></td>
                    <td align="center"><strong>GM Operation (Store)</strong></td>
					<td align="center"><strong>AGM (F &amp; A) Factory </strong></td>
                    <td align="center"><strong>Accounts (H/O)</strong></td>
                    <td align="center"><strong>AGM (F &amp; A H/O) </strong></td>
                    <td align="center"><strong>CFO</strong></td>
                    <td align="center"><strong>DMD (Operation) </strong></td>
                    <!--<td align="center"><strong>Checked By:</strong></td>-->
                </tr>
        </table>
			

      </div>
	

    </td>
  </tr>
  
  
  <tr><td>&nbsp;</td></tr>
  <tr><td>&nbsp;</td></tr>
  <tr><td>&nbsp;</td></tr>
  <tr><td>&nbsp;</td></tr>
 
  
</table>
</body>
</html>
