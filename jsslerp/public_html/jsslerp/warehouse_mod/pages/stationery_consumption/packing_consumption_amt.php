<?php
session_start();
ob_start();
require "../support/inc.all.php";
$title='Packing Consumption Varification';
$now=time();
do_calander('#do_date_fr');
do_calander('#do_date_to');
$depot_id = $_POST['depot_id'];
?>
<script>

function getXMLHTTP() {

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
var ra=(document.getElementById('ra_'+id).value)*1;
var flag=(document.getElementById('flag_'+id).value); 
if(ra>0){
var strURL="received_amt_ajax.php?item_id="+item_id+"&ra="+ra+"&flag="+flag;}
else
{
alert('Receive Amount Must be Greater Than Zero.');
document.getElementById('ra_'+id).value = '';
document.getElementById('ra_'+id).focus();
return false;
}

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
				<form id="form2" name="form2" method="post" action="">	

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>
    <td>      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
			<td><table width="75%" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FF9999">
              <tr>
                <td><div align="right"><strong>Return Date :</strong></div></td>
                <td><input name="do_date_fr" type="text" id="do_date_fr" value="<?=$_POST['do_date_fr']?>" style="width:150px;"/>
                  <label>                  </label></td>
                <td>-to-</td>
                <td><input name="do_date_to" type="text" id="do_date_to" value="<?=$_POST['do_date_to']?>" style="width:150px;"/></td>
                <td rowspan="4"><label>
                  <input type="submit" name="submitit" id="submitit" value="View Return" style="width:170px; font-weight:bold; font-size:12px; height:30px; color:#090"/>
                </label></td>
              </tr>
              <tr>
                <td><div align="right"><strong>Checked : </strong></div></td>
                <td colspan="3"><div align="left"><span class="oe_form_group_cell" style="padding: 2px 0 2px 2px;">
                    <select name="checked" id="checked" style="width:250px;">
                      <option></option>
					  <option <?=($_POST['checked']=='NO')?'Selected':'';?>>NO</option>
					  <option <?=($_POST['checked']=='YES')?'Selected':'';?>>YES</option>
					  <option <?=($_POST['checked']=='PROBLEM')?'Selected':'';?>>PROBLEM</option>
                    </select>
                </span></div></td>
                </tr>
              
              <tr>
                <td><div align="right"><strong> Party Name : </strong></div></td>
                <td colspan="3"><div align="left"><select name="ledger_id" id="ledger_id" style="width:150px;">
                      <option><?=$_POST['ledger_id']?></option>
                      
			          </select></div></td>
                </tr>
              <tr>
                <td><div align="right"><strong> Depot : </strong></div></td>
                <td colspan="3"><div align="left"><span class="oe_form_group_cell" style="padding: 2px 0 2px 2px;">
                  <select name="depot_id" id="depot_id" style="width:250px;">
                    <? foreign_relation('warehouse','warehouse_id','warehouse_name',$depot_id,'use_type="SD" order by warehouse_name');?>
                  </select>
                </span></div></td>
                </tr>
              
            </table></td>
	    </tr>
		<tr><td>&nbsp;</td></tr>
        <tr>
          <td>
      <table width="98%" align="center" cellspacing="0" class="tabledesign">
      <tbody>
      <tr>
      <th>SL</th>
	  
      <th>PR#</th>
      <th>Party Name</th>
      <th>PR Date</th>
      <th>Return By </th>
      <th>Return Amt</th>
      <th>&nbsp;</th>
      <th>Checked?</th>
      </tr>
	  <?
	if($_POST['do_date_fr']!=''){
	  $i=0;
$datefr = strtotime($_POST['do_date_fr']);
$dateto = strtotime($_POST['do_date_to']);
$day_from = mktime(0,0,0,date('m',$datefr),date('d',$datefr),date('y',$datefr));
$day_end =  mktime(23,59,59,date('m',$dateto),date('d',$dateto),date('y',$dateto));

	if($_SESSION['user']['group']>1) $group_s='AND j.group_for='.$_SESSION['user']['group'];
	if($_POST['dealer_type']!='') 	 $depot_con .= ' AND d.dealer_type="'.$_POST['dealer_type'].'"';
	if($depot_id>0) 				 $depot_con .= 'and d.depot='.$depot_id;
	$sql="SELECT
				  j.tr_no,
				  sum(1) as co,
				  sum(j.dr_amt) as dr_amts,
				  j.jv_date,
				  j.jv_no,
				  l.ledger_name,
				  j.tr_id,
				  u.fname,
				  j.entry_at,
				  j.checked,
				  j.jv_no,
				  j.dr_amt
				FROM
				  secondary_journal j,
				  accounts_ledger l,
				  user_activity_management u
				WHERE
				  j.user_id = u.user_id and 
				  j.tr_from = 'Consumption' AND 
				  j.dr_amt >0 AND 
				  j.jv_date  between '".$day_from."' AND '".$day_end."' AND 
				  j.ledger_id = l.ledger_id ".$group_s." ".$depot_con."
				group by  j.tr_no";
	  $query=mysql_query($sql);
	  
	  while($data=mysql_fetch_object($query)){
	  $received = $received + $data->cr_amt;
	  ?>

      <tr <?=($i%2==0)?'class="alt"':'';?>>
      <td align="center"><div align="left"><?=++$i;?></div></td>
      <td align="center"><div align="left"><? echo $data->tr_no;?></div></td>
      <td align="center"><div align="left"><? echo $data->ledger_name;?></div></td>
      <td align="center"><div align="left"><? echo date('Y-m-d',$data->jv_date);?></div></td>
      <td align="center"><div align="left"><? echo $data->fname;?></div></td>
      <td align="right"><?=number_format($data->dr_amts,2);?></td>
      <td align="center"><a target="_blank" href="reprocess_issue_sec_print_view.php?jv_no=<?=$data->jv_no ?>"><img src="../images/print_hover.png" width="20" height="20" /></a></td>
      <td align="center"><span id="divi_<?=$data->tr_no?>">
<? 
if(($data->checked=='YES')){
?>
<input type="button" name="Button" value="YES"  onclick="window.open('reprocess_issue_sec_print_view.php?jv_no=<?=$data->jv_no;?>');" style=" font-weight:bold;width:40px; height:20px;background-color:#66CC66;"/>
<?
}elseif(($data->checked=='NO')){
?>
<input type="button" name="Button" value="NO"  onclick="window.open('reprocess_issue_sec_print_view.php?jv_no=<?=$data->jv_no;?>');" style="font-weight:bold;width:40px; height:20px;background-color:#FF0000;"/>
<? }?>
          </span></td>
      </tr>
	  <? }}?>
	        <tr class="alt">
        <td colspan="6" align="center"><div align="right"><strong>Total Amt : </strong></div>
          
            <div align="left"></div></td>
        <td align="right"><?=number_format($received,2);?></td>
        <td align="center">&nbsp;</td>
        <td align="center"><div align="left"></div></td>
      </tr>
  </tbody></table>		  
  </td>
	    </tr>
		<tr>
		<td>&nbsp;</td>
		</tr>
		<tr>
		<td>
		<div>
                    
		<table width="100%" border="0" cellspacing="0" cellpadding="0">		
		<tr>		
		<td>
		<div style="width:380px;"></div></td>
		</tr>
		</table>
	        </div>
		</td>
		</tr>
      </table></td></tr>
</table>
</form>
<?
$main_content=ob_get_contents();
ob_end_clean();
include ("../template/main_layout.php");
?>
